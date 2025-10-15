<?php

namespace App\Http\Controllers;

use App\Helpers\AuthHelper;
use App\Helpers\ClientHelper;
use App\Models\WebsiteVideo;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Models\LoginToken;
use App\View\Components\input;
use Illuminate\Support\Facades\Route;

class ClientController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $slug = Route::current()->parameter('attorney');
        $logourl = '';
        if (trim($slug) != '') {
            $attorneyId = \App\Models\AttorneySettings::where('custom_login_slug', $slug)->value('attorney_id');
            if ($attorneyId > 0) {
                $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorneyId)->select('company_logo')->first();
                if (isset($attorney_company->company_logo) && !empty($attorney_company->company_logo) && file_exists(public_path() . '/' .$attorney_company->company_logo)) {
                    $logourl = url($attorney_company->company_logo);
                }
            }
        }

        return view('client.login', ['client' => true, 'logourl' => $logourl]);
    }
    public function index(Request $request)
    {
        // Trim email and password
        $request->merge([
            'email' => trim($request->email),
            'password' => trim($request->password),
        ]);

        // Validate input
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        //  Check if the email exists and belongs to a client
        $user = User::where(['email' => $credentials['email'], 'role' => User::CLIENT])->first();
        Session::flush();
        if ($user) {
            //  If email exists, attempt login
            if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => User::CLIENT])) {
                //  Login successful

                AuthHelper::attemptLogin($request);


                //  Check attorney
                $attorney = \App\Models\ClientsAttorney::where("client_id", auth()->user()->id)->first();
                if (!isset($attorney->attorney_id) || empty($attorney)) {
                    Auth::logout();

                    return redirect()->route('client_login')->with('error', "Your attorney's account is no more with us, please contact your attorney.");
                }

                //  First-time login check
                if (auth()->user()->logged_in_ever == 0) {
                    session(['userJustLogin' => true]);
                    $route = (Auth::user()->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                        ? 'client_payroll_landing'
                        : 'client_landing';

                    return redirect()->route($route)->with('success', 'You are logged in.');
                } else {
                    return redirect()->route('client_dashboard')->with('success', 'You are logged in.');
                }
            } else {
                //  If email exists but password is wrong
                return redirect()->route('client_login')->with('error', 'Password is Incorrect.');
            }
        }

        //  If email does not exist or does not belong to a client
        return redirect()->route('client_login')->with('error', 'Email-Address And Password Are Wrong.');
    }

    public function verifyLogin(Request $request, $token)
    {

        $type = $request->type ?? '';
        $token = LoginToken::whereToken($token)->firstOrFail();
        Auth::login($token->user);
        session(['web_view' => true]);

        if (Auth::user()->hide_questionnaire && empty(Auth::user()->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire_mobile')->with('success', 'You are Logged in successfully');
        }
        if ($type == 'debtor') {
            return redirect()->route('client_income');
        }
        if ($type == 'codebtor') {
            return redirect()->route('client_income_step1');
        }
        if ($type == 'bank_debtor') {
            return redirect()->route('client_property_step3', ['fetch_bank' => 'debtor']);
        }
        if ($type == 'bank_codebtor') {
            return redirect()->route('client_property_step3', ['fetch_bank' => 'codebtor']);
        }

        return redirect()->route('pre_client_dashboard');
    }
    public function landing()
    {
        if (!Auth::check()) {
            return redirect()->route('client_login')->with('error', 'Email-Address And Password Are Wrong.');
        }
        if (Auth::user()->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_payroll_landing')->with('success', 'You are logged in.');
        }

        $attorney_id = self::getClientAttorneyId(Auth::user()->id);
        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->select('attorney_welcome_video_url', 'attorney_welcome_mobile_video_url')->first();
        $attorneyGuide = isset($attorney_company->attorney_welcome_video_url) && !empty($attorney_company->attorney_welcome_video_url) ? $attorney_company->attorney_welcome_video_url : '';

        $attorney_welcome_mobile_video_url = isset($attorney_company->attorney_welcome_mobile_video_url) && !empty($attorney_company->attorney_welcome_mobile_video_url) ? Storage::disk('s3')->temporaryUrl($attorney_company->attorney_welcome_mobile_video_url, now()->addDays(2), ['ResponseContentDisposition' => 'attachment;filename= '.rawurlencode('mp4')]) : '';

        return view('client.landing', ['attorneyGuide' => $attorneyGuide, 'attorney_welcome_mobile_video_url' => $attorney_welcome_mobile_video_url]);
    }

    public static function getClientAttorneyId($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    public function no_client_questionnaire()
    {
        if (!Auth::check()) {
            return redirect()->route('client_login')->with('error', 'Email-Address And Password Are Wrong.');
        }

        return view('client.noquestionnaire');
    }

    public function no_client_questionnaire_mobile()
    {
        if (!Auth::check()) {
            return redirect()->route('client_login')->with('error', 'Email-Address And Password Are Wrong.');
        }
        if (Auth::user()->hide_questionnaire && !empty(Auth::user()->client_payroll_assistant)) {
            return redirect()->route('pre_client_dashboard')->with('success', 'You are Logged in successfully');
        }

        return view('client.noquestionnaire_mobile');
    }

    public function guide_webview_mobile()
    {
        if (!Auth::check()) {
            return redirect()->route('client_login')->with('error', 'Email-Address And Password Are Wrong.');
        }
        $docsUploadInfo = ClientHelper::documentUploadInfo();

        return view('client.guide_mobile')->with(['docsUploadInfo' => $docsUploadInfo]);
    }

    public function client_payroll_landing()
    {
        if (!Auth::check()) {
            return redirect()->route('client_login')->with('error', 'Email-Address And Password Are Wrong.');
        }
        $websiteVideos = WebsiteVideo::where('section', 'client-landing-page')->first();

        return view('client.payrolllanding', compact('websiteVideos'));
    }

    public function logout()
    {
        $user = Auth::user();
        User::whereId($user->id)->update(['device_type' => 'None', 'device_token' => null]);
        Auth::logout();
        Session::flush();

        return redirect()->route('client_login')->with('success', 'User has been logout successfully.');
    }
    public function changePassword(Request $request)
    {
        $client_id = Auth::user()->id;
        $user = User::findOrFail($client_id);
        if (!empty($user->id)) {
            $this->validate($request, ['password' => 'required', 'new_password' => 'min:8|max:24|different:password', 'confirm_password' => 'required|same:new_password']);
            if (Hash::check($request->password, $user->password)) {
                $user->fill(['password' => Hash::make($request->new_password) ])->save();

                return response()->json(Helper::renderApiSuccess('User password has been updated successfully.', ['data' => null]), 200);
            } else {
                return response()->json(Helper::renderApiError('Old Password does not match.', ['data' => null]), 200);
            }
        } else {
            return response()->json(Helper::renderApiError('User does not exist.', ['data' => null]), 200);
        }
    }
    public function tax_paying_popup()
    {
        return view('client.taxpopup');
    }
    public function get_loan_data_to_import(Request $request)
    {
        $input = $request->all();
        $selectedOption = $input['selectedOption'] ?? '';
        $allLoans = json_decode($input['allLoans']) ?? '';

        $creditor_name = $allLoans[$selectedOption]->creditor_name ?? '';
        $creditor_name_addresss = $allLoans[$selectedOption]->creditor_name_addresss ?? '';
        $creditor_city = $allLoans[$selectedOption]->creditor_city ?? '';
        $creditor_state = $allLoans[$selectedOption]->creditor_state ?? '';
        $creditor_zip = $allLoans[$selectedOption]->creditor_zip ?? '';
        $amount_own = $allLoans[$selectedOption]->amount_own ?? '';

        return response()->json(Helper::renderApiSuccess('', ['creditor_name' => $creditor_name,'creditor_name_addresss' => $creditor_name_addresss,'creditor_city' => $creditor_city,'creditor_state' => $creditor_state,'creditor_zip' => $creditor_zip,'amount_own' => $amount_own]));
    }
    public function show_vehicle_popup()
    {
        return view('client.vin');
    }
    public function change_password_popup()
    {
        return view('client.change_password');
    }
    public function setup_new_password(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = Auth::user()->id;
            $user = User::findOrFail($client_id);
            if (!empty($user->id)) {
                $validator = Validator::make($request->all(), ['new_password' => 'required|min:8|max:24', 'confirm_password' => 'required|same:new_password']);
                if ($validator->fails()) {
                    return response()->json(Helper::renderApiError($validator->errors()->first(), ['data' => null]), 200);
                }
                $saveData = ['password' => Hash::make($request->new_password), 'logged_in_ever' => 1, 'recommned_password_update' => 0];
                User::where('id', $client_id)->update($saveData);

                return response()->json(Helper::renderApiSuccess('User password has been updated successfully.', ['data' => null]), 200);
            }
        }
    }
    public function request_edit_access(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = Auth::user()->id;
            $input = $request->all();
            $requested_types = $input['requested'] ?? [];
            if (empty($requested_types)) {
                return redirect()->back()->with('error', 'No type is selected.');
            }

            $types = Helper::getRequestedTabByName();

            $new_array = [];
            foreach ($types as $type => $name) {
                if (isset($requested_types[$type]) && $requested_types[$type] == '1') {
                    $new_array[$type] = 1;
                } else {
                    $new_array[$type] = 0;
                }
            }

            $requested_types_json = json_encode($new_array);

            \App\Models\FormsStepsCompleted::updateOrCreate(
                ['client_id' => $client_id],
                [
                    'client_id' => $client_id,
                    'request_edit_access' => 1,
                    'request_edit_access_types' => $requested_types_json,
                    'request_edit_access_time' => date('Y-m-d H:i:s'),
                ]
            );

            return redirect()->back()->with('success', 'Edit request sent successfully.');
        }
    }
}
