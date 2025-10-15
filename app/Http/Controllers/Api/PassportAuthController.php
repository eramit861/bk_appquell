<?php

namespace App\Http\Controllers\Api;

use App\Helpers\AddressHelper;
use App\Helpers\DocumentHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ClientsAttorney;
use App\Models\AttorneyCompany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Helpers\ArrayHelper;

class PassportAuthController extends Controller
{
    /**
    * Registration Req
    */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'socket_token' => Str::random(32).time(),
            'device_type' => $request->device_type,
            'device_token' => $request->device_token,
        ]);

        $token = $user->createToken('Laravel8PassportAuth')->accessToken;
        $user['token'] = $token;

        return response()->json(['data' => $user], 200);
    }

    /**
     * Login Req
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'role' => User::CLIENT
        ];


        if (empty($data['email'])) {
            return response()->json(Helper::renderApiError('Email is required'), 401);
        }
        if (empty($data['password'])) {
            return response()->json(Helper::renderApiError('Password is required'), 401);
        }
        $user = User::where(['email' => $request->email, 'role' => User::CLIENT])->first();
        if ($user) {
            if (auth()->attempt($data)) {
                $user = Auth::user();
                // $get_oauth_token  = DB::table('oauth_access_tokens')->whereUserId($user->id)->where("revoked","=",0)->update(["revoked" => 1]);
                User::whereId($user->id)->update(['device_type' => $request->device_type, 'device_token' => $request->device_token,'logged_in_ever' => 1,'last_login_at' => now()]);
                $user = Auth::user();
                $attorney = ClientsAttorney::where("client_id", $user->id)->first();

                if (!isset($attorney->attorney_id) || empty($attorney->attorney_id)) {
                    Auth::logout();

                    return response()->json(Helper::renderApiError("Your attorney's account is no more with us, please contact your attorney."), 401);
                }
                if ($user->socket_token == null) {
                    User::whereId($user->id)->update(['socket_token' => Str::random(32).time()]);
                }
                $token = auth()->user()->createToken('Laravel8PassportAuth')->accessToken;
                $userObj = new User();
                $link = $userObj->createLoginLink($user->id);
                $user_details = $user->only(User::USER_DETAILS);

                $user_details['token'] = $token;
                $user_details['link'] = $link;
                $user_details['device_type'] = $request->device_type;
                $user_details['device_token'] = $request->device_token;
                $find_attorney = ClientsAttorney::with('getuserattorney')->whereClientId($user->id)->first();
                if (!empty($find_attorney)) {
                    $user_details['attorney_username'] = $find_attorney->getuserattorney->name;
                    $user_details['attorney_id'] = $find_attorney->attorney_id;
                }
                $data = ['data' => $user_details];

                return response()->json([ 'data' => $user_details,'success' => true,'status' => true, 'message' => 'Logged in successfully',]);
                //return response()->json(Helper::renderApiSuccess('Logged in successfully',$data), 200);
            } else {
                return response()->json(Helper::renderApiError('Password is Incorrect.'), 401);
            }
        }

        return response()->json(Helper::renderApiError('Email-Address And Password Are Wrong.'), 401);
    }

    public function Logout()
    {
        $user = Auth::user();
        DB::table('oauth_access_tokens')->whereUserId($user->id)->where("revoked", "=", 0)->update(["revoked" => 1]);
        User::whereId($user->id)->update(['device_type' => 'None' , 'device_token' => null]);

        return response()->json(Helper::renderApiSuccess('Logout successfully'), 200);
    }

    public function userInfo()
    {

        $data = ['data' => ['name' => Auth::user()->name,'email' => Auth::user()->email, 'created_at' => Auth::user()->created_at,'updated_at' => Auth::user()->updated_at]];

        return response()->json(Helper::renderApiSuccess('User Profile', $data), 200);

    }

    public function configuration()
    {
        $suffix = ArrayHelper::getSuffixArray();
        $array = [];
        foreach ($suffix as $key => $s) {
            array_push($array, ['id' => $key, 'value' => $s]);
        }
        $marital_status = [
            ['id' => 1, 'value' => 'Single, Divorced or Widowed'],
            ['id' => 2, 'value' => 'Married & living together'],
            ['id' => 3, 'value' => 'Married & living in separate households'],
        ];

        $documentStatus = [
            '' => "Not Uploaded",
            0 => "Uploaded",
            1 => "Accepted",
            2 => "Declined"
        ];
        $client_id = Auth::user()->id;
        $find_attorney = ClientsAttorney::with('getuserattorney')->whereClientId(Auth::user()->id)->first();
        $attorney_company = AttorneyCompany::where('attorney_id', $find_attorney->attorney_id)->select('company_logo')->first();
        $logourl = url('assets/img/attorney-logo.png');
        if (isset($attorney_company->company_logo) && !empty($attorney_company->company_logo) && file_exists(public_path() . '/' .$attorney_company->company_logo)) {
            $logourl = url($attorney_company->company_logo);
        }
        $videos = VideoHelper::getAdminVideos();
        $mainscreentutorials = $videos[Helper::MAIN_MOBILE_APP_VIDEO] ?? [];

        $tutorialIphone = $videos[Helper::DOCUMENT_PAGE_IPHONE_VIDEO_GUIDE] ?? [];
        $videoiPhone = VideoHelper::getVideos($tutorialIphone, true);
        $tutorialAndroid = $videos[Helper::DOCUMENT_PAGE_ANDROID_VIDEO_GUIDE] ?? [];
        $videoAndroid = VideoHelper::getVideos($tutorialAndroid, true);

        $mainscreenvideo = ['en' => $mainscreentutorials['english_video'] ?? '', 'sp' => $mainscreentutorials['spanish_video'] ?? '','ios_en' => $mainscreentutorials['iphone_english_video'] ?? '', 'ios_sp' => $mainscreentutorials['iphone_spanish_video'] ?? ''];
        $attorneyId = $find_attorney->attorney_id;
        $encryptedid = base64_encode($attorneyId);
        $linkinput['link'] = route('questionnaire')."?token=".$encryptedid;
        $linkinput['manual_link'] = route('manual_upload')."?token=".$encryptedid;
        $linkinput['attorney_id'] = $attorneyId;
        $linkinput['link_for'] = 'manual';
        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorneyId)->select('attorney_welcome_video_url', 'attorney_welcome_mobile_video_url')->first();
        $guideArray = ArrayHelper::getHelpDocumentUrls();


        $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
        $attorney_id = $ClientsAssociateId ?: $attorneyId;
        $is_associate = $ClientsAssociateId ? 1 : 0;
        $attorneySettings = \App\Models\AttorneySettings::where([
            'attorney_id' => $attorney_id,
            'is_associate' => $is_associate
        ])->first();

        $counseling_agency = isset($attorneySettings->counseling_agency) && !empty($attorneySettings->counseling_agency) ? $attorneySettings->counseling_agency : '';
        $counseling_agency_site = isset($attorneySettings->counseling_agency_site) && !empty($attorneySettings->counseling_agency_site) ? $attorneySettings->counseling_agency_site : '';
        $attorney_code = isset($attorneySettings->attorney_code) && !empty($attorneySettings->attorney_code) ? $attorneySettings->attorney_code : '';
        $guideArray = ArrayHelper::getHelpDocumentUrls(null, $counseling_agency, $counseling_agency_site, $attorney_code);

        $manual_doc_url = DocumentHelper::getManualDocUrl($client_id);
        $data = [
            'scanner_guide_images' => $guideArray,
            "states" => AddressHelper::getStateArray(),
            'suffix' => $array,
            'attorney_id' => $find_attorney->attorney_id,
            'client_id' => $client_id,
            'attorney_logo' => $logourl,
            'marital_status' => $marital_status,
            'privacy_page' => "https://bkassistant.net/privacy",
            'client_type' => Auth::user()->client_type,
            'document_status_list' => $documentStatus,
            'forgot_password_page' => route('password.request'),
            'manual_doc_upload_link' => $manual_doc_url,
            'iphone_share_video' => $videoiPhone['en'] ?? '',
            'android_share_video' => $videoAndroid['en'] ?? '',
            'attorney_welcome_mobile_video_url' => $mainscreenvideo['en'],
            'ios_attorney_welcome_mobile_video_url' => $mainscreenvideo['ios_en'],
            'drop_box_link' => 'https://www.dropbox.com/scl/fo/hqkk34as5jao47zi227j7/h?rlkey=e1pm4c3fjjr95g1rbk7edetfi&dl=0'
        ];

        return response()->json(Helper::renderApiSuccess('Configuration', $data), 200);
    }

    public function help_support()
    {
        $client_id = Auth::user()->id;


        $find_attorney = ClientsAttorney::with('getuserattorney')->whereClientId($client_id)->first();
        $attorney = User::where('id', $find_attorney->attorney_id)->first();
        $attorney_company = AttorneyCompany::where('attorney_id', $find_attorney->attorney_id)->first();
        $adminUrl = \App\Models\AdminSettings::first();
        $adminUrl = Helper::validate_key_value('appointment_url', $adminUrl);
        $attorneyUrl = Helper::validate_key_value('attorney_appointment_url', $attorney_company);

        $data = [
            'bk_data' => [
                'phone_no_call' => '1-888-356-5777',
                'phone_no_text' => '(949) 994-4190',
                'email' => 'info@bkassistant.net',
                'appointment_link' => 'https://calendly.com/bkquestionnaire/process-overview-call',
            ],
            'attorney_data' => [
                'phone_no_call' => $attorney_company->attorney_phone,
                'email' => $attorney->email,
                'name' => $attorney->name,
                'appointment_link' => $attorneyUrl,
            ],
        ];

        return response()->json(Helper::renderApiSuccess('help_support', $data), 200);
    }

    public function document_setting(Request $request)
    {
        $client_id = Auth::user()->id;
        if ($request->isMethod('post')) {
            $document_type = $request->input('document_type');
            $not_own = $request->input('not_own');
            if ($not_own == 1) {
                $post = [
                    'document_type' => $document_type,
                    'created_at' => date("Y-m-d H:i:s"),
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                \App\Models\NotOwnDocuments::updateOrCreate(['client_id' => $client_id,'document_type' => $document_type], $post);
            }
            if ($not_own == 0) {
                \App\Models\NotOwnDocuments::where(['client_id' => $client_id,'document_type' => $document_type])->delete();
            }

            return response()->json(Helper::renderApiSuccess('Setting has been updated successfully.', ['data' => null]), 200);
        } else {
            $docData = \App\Models\NotOwnDocuments::where(['client_id' => $client_id])->select(['document_type'])->get();
            $docData = !empty($docData) ? array_column($docData->toArray(), 'document_type') : [];

            return response()->json(Helper::renderApiSuccess('Documents not Owned', ['data' => $docData]), 200);
        }
    }

    public function find_statement_month_option(Request $request)
    {
        if ($request->isMethod('post')) {
            $clientId = Auth::user()->id;
            $documentType = $request->document_type;

            $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($clientId);
            $attorney_id = $ClientsAssociateId ?: \App\Models\ClientDocuments::getClientAttorneyId($clientId);
            $is_associate = $ClientsAssociateId ? 1 : 0;
            $attorneySettings = \App\Models\AttorneySettings::where([
                'attorney_id' => $attorney_id,
                'is_associate' => $is_associate
            ])->select(['bank_statement_months'])->first();
            $attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
            $bank_statement_months = $attorneySettings ? (int) Helper::validate_key_value('bank_statement_months', $attorneySettings) : 0;
            $bank_account_documents = \App\Models\ClientDocuments::getClientBankDocumentList($clientId);
            $bank_statement_month_nos = $bank_statement_months;
            if (isset($bank_account_documents) && !empty($bank_account_documents)) {
                foreach ($bank_account_documents as $docu) {
                    if ($docu['document_name'] === $documentType) {
                        $bank_statement_month_nos = ($docu['bank_account_type'] == 2) ? $attProfitLossMonths : $bank_statement_months;
                        break;
                    }
                }
            }

            $addCurrentMonthToDate = \App\Models\AttorneySettings::isCurrentPartialMonthEnabled($attorney_id);
            $statementMonths = \App\Models\ClientDocuments::getAvailableStatementMonths($clientId, $documentType, $bank_statement_month_nos, $addCurrentMonthToDate);

            return response()->json([
                'message' => 'success',
                'data' => $statementMonths,
            ], 200);
        }
    }

}
