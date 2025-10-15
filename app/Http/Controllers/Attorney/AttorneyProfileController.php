<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Models\AttorneyCompany;
use App\Models\ClientsAttorney;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Helpers\VideoHelper;
use Storage;

class AttorneyProfileController extends AttorneyController
{
    public function logout()
    {
        $user = Auth::user();
        User::whereId($user->id)->update(['device_type' => 'None' , 'device_token' => null]);
        Auth::logout();
        Session::flush();

        return redirect()->route('login')->with('success', 'User has been logout successfully.');
    }

    public function admin_login_dashboard_via_attorney($adminId)
    {
        $query = $_GET['q'] ?? '';
        Auth::loginUsingId($adminId);

        return redirect()->route('admin_attorney_list', ['q' => $query])->with('success', 'You are successfully logged into your dashboard!');

    }
    public function admin_login_dashboard_via_paralegal($adminId)
    {
        $query = $_GET['q'] ?? '';
        Auth::loginUsingId($adminId);

        return redirect()->route('admin_paralegal_list', ['q' => $query])->with('success', 'You are successfully logged into your dashboard!');

    }



    public function update_password(Request $request)
    {
        $id = Helper::getCurrentAttorneyId();
        $user = User::findOrFail($id);
        if (empty($user->id)) {
            return redirect()->route('attorney_profile', ['tab' => 2])->with('active', 2)->with('error', 'User does not exist.');
        }
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'new_password' => 'max:8|different:password',
            'confirm_password' => 'required|same:new_password'
        ]);

        if ($validator->fails()) {
            return redirect()->route('attorney_profile', ['tab' => 2])->with(['active' => 2,'error' => $validator->errors()->first()]);
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->route('attorney_profile', ['tab' => 2])->with('active', 2)->with('error', 'old Password does not match.');
        }
        $user->fill([
            'password' => Hash::make($request->new_password)
        ])->save();

        return redirect()->route('attorney_profile', ['tab' => 2])->with('active', 2)->with('success', 'User password has been updated successfully.');
    }

    public function company_profile(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();

        $this->validate($request, [
            'attorney_name' => 'required|alpha_dash_space',
            'attorney_email' => 'required|email|unique:App\Models\User,email,'.$attorney_id,
            'company_name' => 'required|alpha_dash_space',
            'attorney_phone' => 'required|max:12'
            ]);

        $companySlugByName = '';

        if (isset($request->enable_custom_login_page_slug) && $request->enable_custom_login_page_slug == 1) {
            $companySlugByName = Helper::validate_slug_name($request->company_name);
            if (!empty($companySlugByName)) {
                $exists = \App\Models\AttorneySettings::where('custom_login_slug', $companySlugByName)
                    ->where('attorney_id', '!=', $attorney_id)
                    ->exists();

                if ($exists) {
                    $companySlugByName = $companySlugByName.'-1';
                }
            }
        }


        $attorney_info = [
            'name' => $request->attorney_name,
            'email' => $request->attorney_email,
            'attorney_notice_email_1' => $request->attorney_notice_email_1,
            'attorney_notice_email_2' => $request->attorney_notice_email_2,
        ];
        User::where('id', $attorney_id)->update($attorney_info);
        $company_logo = "";
        if ($request->hasFile('company_logo')) {
            $this->validate($request, [
                'company_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if (!empty($request->cropCompanyLogoImage)) {
                $imageParts = explode(";base64,", $request->cropCompanyLogoImage);
                $imageTypeAux = explode("image/", $imageParts[0]);
                $imageType = $imageTypeAux[1];
                $imageBase64 = base64_decode($imageParts[1]);
                $imageName = uniqid() . '.' . $imageType;

                $store_path = public_path(). "/attorney/".$attorney_id."/company";
                $this->checkOrCreateDir($store_path);
                $store_path = $store_path.'/'.$imageName;
                file_put_contents($store_path, $imageBase64);
                $company_logo = "/attorney/". $attorney_id ."/company/". $imageName;
            }
        }

        $company_info = [
            'company_name' => $request->company_name,
            'state_bar' => $request->state_bar,
            'attorney_address' => $request->attorney_address,
            'attorney_address2' => $request->attorney_address2,
            'attorney_city' => $request->attorney_city,
            'attorney_state' => $request->attorney_state,
            'attorney_zip' => $request->attorney_zip,
            'attorney_phone' => $request->attorney_phone,
            'attorney_fax' => $request->attorney_fax,
            'attorney_appointment_url' => $request->attorney_appointment_url,
            'attorney_welcome_video_url' => $request->attorney_welcome_video_url,
            'attorney_id' => $attorney_id,
            'attorney_review_url' => $request->attorney_review_url,
            'attorney_privacy_policy_url' => $request->attorney_privacy_policy_url
        ];


        if (isset($companySlugByName)) {
            \App\Models\AttorneySettings::updateOrCreate(
                ['attorney_id' => $attorney_id, 'is_associate' => 0],
                [
                    'attorney_id' => $attorney_id,
                    'custom_login_slug' => $companySlugByName
                ]
            );
        }

        if ($request->hasFile('attorney_welcome_mobile_video_url')) {
            if (!empty($request->attorney_welcome_mobile_video_url)) {

                $store_path = "attorney/". $attorney_id. "/company_video";
                $file = $request->file('attorney_welcome_mobile_video_url');
                $imageName = $file->getClientOriginalName();
                $path = $file->storeAs($store_path, $imageName, 's3');
                $company_info['attorney_welcome_mobile_video_url'] = $path;
            }
        }


        $this->saveUpdateAttorney($request, $company_info, $company_logo);

        return redirect()->route('attorney_profile', ['tab' => 1])->with('active', 1)->with('success', 'Profile has been updated successfully.');
    }

    private function saveUpdateAttorney($request, $company_info, $company_logo)
    {
        if (!empty($company_logo)) {
            $company_info['company_logo'] = $company_logo;
        }
        if (!empty($request->company_id)) {
            AttorneyCompany::where('id', $request->company_id)->update($company_info);
        } else {
            AttorneyCompany::create($company_info);
        }
    }

    public function delete(Request $request)
    {
        $client_id = $request->input('client_id');
        $attornyId = Helper::getCurrentAttorneyId();
        $this->validClient($client_id);
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $user = User::where('id', $client_id)->first();

        if (!empty($user)) {
            Message::where('from_user_id', $client_id)->orWhere('to_user_id', $client_id)->delete();
            ClientsAttorney::where(['client_id' => $client_id,"attorney_id" => $attornyId])->delete();
            $user->clientAnyOtherNameData()->delete();
            $user->clientBasicInfoPartA()->delete();
            $user->clientBasicInfoPartB()->delete();
            $user->clientBasicInfoPartC()->delete();
            $user->clientLivedAddressFrom730Data()->delete();
            $user->clientBasicInfoPartRest()->delete();
            $user->clientsPropertyResident()->delete();
            $user->clientsPropertyVehicle()->delete();
            $user->clientsPropertyHousehold()->delete();
            $user->clientsPropertyFinancialAssets()->delete();
            $user->clientsPropertyBusinessAssets()->delete();
            $user->ClientsPropertyFarmCommercial()->delete();
            $user->clientsPropertyMiscellaneous()->delete();

            /* Debts Model Section */
            $user->debts()->delete();
            $user->debtsTax()->delete();

            /* Income Model Section */
            $user->incomeDebtorEmployer()->delete();
            $user->incomeDebtorSpouseEmployer()->delete();
            $user->incomeDebtorMonthlyIncome()->delete();
            $user->incomeDebtorSpouseMonthlyIncome()->delete();

            $user->expenses()->delete();
            $user->spouseExpenses()->delete();

            $user->financialAffairs()->delete();

            $user->clientDocumentUploaded()->delete();
            $user->clientsApplicationPayment()->delete();
            $user->debtsDocuments()->delete();
            $user->signedDocuments()->delete();

            $user->formsStepsCompleted()->delete();
            User::where('id', $client_id)->delete();
        }

        return response()->json(Helper::renderJsonSuccess('Client Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function profile($tab = '')
    {
        $tab = isset($_GET['tab']) ? $_GET['tab'] : 1;
        $attorney_id = Helper::getCurrentAttorneyId();
        $attorneycards = \App\Models\AttorneyCards::where('attorney_id', $attorney_id)->first();
        $attorneycards = (!empty($attorneycards)) ? $attorneycards : [];

        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];

        $attorney_settings = \App\Models\AttorneySettings::where('attorney_id', $attorney_id)->first();
        $attorney_settings = (!empty($attorney_settings)) ? $attorney_settings : [];

        $retainer_documents = \App\Models\RetainerDocuments::where('attorney_id', $attorney_id)->first();
        $retainer_documents = (!empty($retainer_documents)) ? $retainer_documents : [];

        $petition_preparation = \App\Models\AttorneySubscription::where(['attorney_id' => $attorney_id,'type' => '1'])->first();
        $petition_preparation = (!empty($petition_preparation)) ? $petition_preparation : [];

        $video_subscription = \App\Models\AttorneySubscription::where(['attorney_id' => $attorney_id,'type' => '2'])->first();
        $video_subscription = (!empty($video_subscription)) ? $video_subscription : [];

        $attorneyActiveSubscription = $this->getAttorneyActivePlan();

        $subscription_package_array = \App\Models\AttorneySubscription::packageNameAttorneySettingPageArray();
        $subscription_price_array = \App\Models\AttorneySubscription::packagePriceArray();

        $package_array = \App\Models\AttorneySubscription::settingsPageAllPackageNameArray();

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_SETTINGS);
        $petitionPrice = \App\Models\AttorneySubscription::getPetitionPricePackageWise($attorneyActiveSubscription);
        $paralegelprice = \App\Models\AttorneySubscription::getParalegalPricePackageWise($attorneyActiveSubscription);

        return view('attorney.myprofile', ['petitionPrice' => $petitionPrice, 'attorneyActiveSubscription' => $attorneyActiveSubscription,'paralegelprice' => $paralegelprice,'pralegel_price' => $paralegelprice,'video' => $video, 'attorneycards' => $attorneycards,'attorney_company' => $attorney_company,
                                             'retainer_documents' => $retainer_documents,'petition_preparation' => $petition_preparation,
                                             'video_subscription' => $video_subscription,
                                             'subscription_package_array' => $subscription_package_array,
                                             'package_array' => $package_array,
                                             'attorney_settings' => $attorney_settings,
                                             'subscription_price_array' => $subscription_price_array])->with(
                                                 'active',
                                                 $tab
                                             );
    }

    private function getAttorneyActivePlan()
    {
        $attorneyActiveSubscription = \App\Models\AttorneySubscription::where(['attorney_id' => Helper::getCurrentAttorneyId()])->whereIn('type', \App\Models\AttorneySubscription::PACKAGE_IDS)->where(['is_signup_subscription' => 1])->first();
        $attorneyActiveSubscription = !empty($attorneyActiveSubscription) ? $attorneyActiveSubscription->toArray() : [];

        return  $attorneyActiveSubscription['type'] ?? '';
    }

    public function settingsPopupSubPackageArray(Request $request)
    {
        $input = $request->all();
        $sub_package_array = \App\Models\AttorneySubscription::settingsPageAllPackageNameArray($input["packageId"]);
        $sub_package_class_array = \App\Models\AttorneySubscription::settingsPageAllPackageClassArray($input["packageId"]);

        unset($sub_package_array[$input["packageId"]]);
        unset($sub_package_class_array[$input["packageId"]]);

        $sub_package_array = array_filter($sub_package_array, function ($a) { return ($a !== 0.0); });
        $sub_package_class_array = array_filter($sub_package_class_array, function ($a) { return ($a !== 0.0); });
        $returnHTML = view('attorney.subscription_addon_subpackage')->with(['sub_package_class_array' => $sub_package_class_array,'sub_package_array' => $sub_package_array])->render();

        return response()->json(['success' => true, 'returnHTML' => $returnHTML]);
    }

    public function delete_attorney_mobile_video(Request $request)
    {
        if ($request->isMethod('post')) {
            $attorneyId = $request->attorney_id;
            $attorney_welcome_mobile_video_url = AttorneyCompany::where('attorney_id', $attorneyId)->value('attorney_welcome_mobile_video_url');
            if (Storage::disk('s3')->exists($attorney_welcome_mobile_video_url)) {
                Storage::disk('s3')->delete($attorney_welcome_mobile_video_url);
            }
            AttorneyCompany::where('attorney_id', $attorneyId)->update(['attorney_welcome_mobile_video_url' => null]);

            return response()->json(Helper::renderJsonSuccess('Video Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }


}
