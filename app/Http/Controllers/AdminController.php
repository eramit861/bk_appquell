<?php

namespace App\Http\Controllers;

use App\Helpers\AdminHelper;
use App\Helpers\AuthHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminPaymentSettings;
use App\Notifications\TwoFactorCode;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('admin.login');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function index(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password'],'role' => 1])) {
            /* if(auth()->user()->two_factor_code !=''){
                 return redirect()->route('verify.index')->with('success','Verification code sent to your email.');
             }else{
                 $this->authenticated($request,auth()->user());
                 return redirect()->route('verify.index')->with('success','Verification code sent to your email.');
             }*/
            AuthHelper::attemptLogin($request);

            return redirect()->route('admin_dashboard')->with('success', 'Logged in successfully.');
        } else {
            return redirect()->route('admin_login')->with('error', 'Email-Address And Password Are Wrong.');
        }
    }


    public function dashboard(Request $request)
    {
        $details = AdminHelper::dashboardEntityCount();

        $input = $request->all();
        $fromDate = date("Y-m-d", strtotime(now()->subDays(5))) ;
        $toDate = date("Y-m-d", strtotime(now())) ;
        $selectedAttorney = '';
        if (!empty($input)) {
            $fromDate = $input['fromDate'] ?? $fromDate;
            $toDate = $input['toDate'] ?? $toDate;
        }
        $all_attorney = \App\Models\User::where(['role' => \App\Models\User::ATTORNEY])->where('parent_attorney_id', '=', 0)->pluck('name', 'id')->all();



        if (!empty($input) && !empty($input['allAttorney'])) {
            $selectedAttorney = $input['allAttorney'];
        }

        $listing = \App\Models\SubscriptionToclient::where('tbl_subscription_to_client.created_at', '>=', $fromDate)->where('tbl_subscription_to_client.created_at', '<=', $toDate)->join("users", "users.id", "=", "tbl_subscription_to_client.client_id")->select('users.name', 'tbl_subscription_to_client.client_id', 'tbl_subscription_to_client.package_id', 'tbl_subscription_to_client.quantity', 'tbl_subscription_to_client.attorney_id', 'tbl_subscription_to_client.created_at')->orderBy('created_at', 'DESC');
        if (!empty($selectedAttorney)) {
            $listing = $listing->where(['attorney_id' => $selectedAttorney]);
        }
        if (!empty($request->query('q'))) {
            $listing->orWhere(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->query('q') . '%');
            });
        }
        $all_transactions = $listing->paginate(10);

        return view('admin.dashboard', ['details' => $details, 'listing' => $all_transactions, 'fromDate' => $fromDate, 'toDate' => $toDate, 'all_attorney' => $all_attorney , 'selectedAttorney' => $selectedAttorney ]);
    }

    public function settings(Request $request)
    {
        $payment_settings = AdminPaymentSettings::where('id', 1)->first();
        $payment_settings = (!empty($payment_settings)) ? $payment_settings : [];

        if ($request->isMethod('post')) {
            $input = $request->all();

            $this->validate($request, [
                'payment_charge' => 'required',
                'discount_percentage' => 'required',
            ]);
            if (!empty($input['setting_id'])) {
                $id = $input['setting_id'];
                unset($input['_token'],$input['setting_id']);
                AdminPaymentSettings::where('id', $id)->update($input);
            } else {
                AdminPaymentSettings::create($input);
            }

            return redirect()->back()->with('success', 'Information has been saved successfully.');
        }

        return view('admin.settings', ['payment_settings' => $payment_settings]);
    }
    public function logout()
    {
        $user = Auth::user();
        User::whereId($user->id)->update(['device_type' => 'None' , 'device_token' => null]);
        Auth::logout();

        return redirect()->route('admin_login')->with('success', 'User has been logout successfully.');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->generateTwoFactorCode();
        try {
            $user->notify(new TwoFactorCode());
        } catch (\Exception $e) {

        }

    }



}
