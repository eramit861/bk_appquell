<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Helpers\LocalFormHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Helpers\AddressHelper;
use App\Models\Districts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Helpers\VideoHelper;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\ClientSettings;
use App\Models\StateTrustee;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;

class OfficialFormController extends AttorneyController
{
    public function official_form($client_id, Request $request)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        App::setLocale(Session::get('locale') !== null ? Session::get('locale') : "en");

        $attorney_id = Helper::getCurrentAttorneyId();
        $user = \App\Models\User::where('id', $client_id)->first();
        $basic_info = CacheBasicInfo::getBasicInformationData($client_id, false, true);

        $clentData = $user->toArray();

        $savedData = \App\Models\AttorneyEditorData::where('client_id', $client_id)->first();
        $dynamicHtmlData = \App\Models\AttorneyClientHtml::where('client_id', $client_id)->select(['form_id','data'])->get()->pluck('data', 'form_id');

        $distritId = isset($savedData->data) && !empty(json_decode($savedData->data)->district_id) ? json_decode($savedData->data)->district_id : 69;
        $statename = isset($savedData->data) && !empty(json_decode($savedData->data)->district_name) ? json_decode($savedData->data)->district_name : "Alabama";

        $tabData = \App\Models\Form::where(['zipcode' => $distritId])->get();
        if (!LocalFormHelper::isChapterThirteenEnabled($distritId)) {
            $tabData = \App\Models\Form::where(['zipcode' => $distritId])->where('chapter_type', '!=', 13)->get();
        }
        $tabData = $tabData->toArray() ? $tabData->toArray() : [];
        $BasicInfoPartA = $basic_info['BasicInfoPartA'];
        $zip = Helper::validate_key_value('zip', $BasicInfoPartA);
        $attornyUserData = \App\Models\User::where('id', $attorney_id)->first()->toArray();
        $client_attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->select('attorney_id')->first();
        $client_attorney = (!empty($client_attorney)) ? $client_attorney : [];
        $attorney_id = $client_attorney->attorney_id;

        $debts = \App\Models\Debts::where('client_id', $client_id)->first();
        $debts = (!empty($debts)) ? $debts->toArray() : [];
        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company->toArray() : [];
        if (empty($attorney_company)) {
            return redirect()->route('attorney_profile', ['tab' => 1])->with('error', 'Please complete your profile details.');
        }
        $debtstax = CacheDebt::getDebtData($client_id);

        $propertyInfo = CacheProperty::getPropertyData($client_id, false, true);
        $pMisc = Helper::validate_key_value('miscellaneous', $propertyInfo, 'array');

        $creditors = $this->getCreditors($user, $attorney_company, $basic_info, $propertyInfo);
        $reqlient = !empty($savedData) ? $savedData->toArray() : [];
        $inQueue = 0;
        if (isset($reqlient['request_for_combined']) && $reqlient['request_for_combined'] == 1) {
            $inQueue = \App\Models\AttorneyEditorData::where('request_for_combined', 1)->where('pdf_request_placed_on', '<=', $reqlient['pdf_request_placed_on'])->count();
        }

        $district_names = Districts::orderBy('sort_order', "asc")->where("short_name", "!=", null)->get();
        $districtData = Districts::where('id', $distritId)->select('region_id')->first();
        $tranportationExpense = self::getTransportExpenses($districtData, $propertyInfo);

        $ownership = \App\Models\TransportationIncome::orderby('id', 'asc')->take(2)->get();
        $ownership = !empty($ownership) ? $ownership->toArray() : [];
        $nationalPublic = $ownership[0] ?? [];
        $nationalownership = $ownership[1] ?? [];

        $vcount = self::vehicleCount($propertyInfo);
        $ownershipCost1 = self::getOwnershipCost($vcount, $nationalownership, 1);
        $ownershipCost2 = self::getOwnershipCost($vcount, $nationalownership, 2);

        $detailed_property = \App\Models\User::where("id", $client_id)->value('detailed_property');
        // Means Test Calculation
        $countCreditors = count($creditors);
        $countyId = isset($savedData->data) && !empty(json_decode($savedData->data)->selected_county) ? json_decode($savedData->data)->selected_county : 0;
        $fips = \App\Models\CountyFipsData::where('id', $countyId)->first();
        $county = Helper::validate_key_value('county_name', $fips);
        $divisionId = Helper::validate_key_value('fips_division', $fips);
        $division = \App\Models\StateDivisions::where('id', $divisionId)->first();

        $incomeData = CacheIncome::getIncomeData($client_id);
        $incomedebtoremployer = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        $debtorspouseemployer = Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');
        $part = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');

        $debtor_operation_business = '';
        if (isset($part['operation_business'])) {
            $debtor_operation_business = $part['operation_business'];
        }

        $district_name = isset($savedData->data) && !empty(json_decode($savedData->data)->district_name) ? json_decode($savedData->data)->district_name : '';
        $state_code = AddressHelper::getStateCodeByStateNameForJubliee($district_name);
        $trustees = StateTrustee::getTrustee($state_code);
        $selectedTrusteeID = isset($savedData->data) && !empty(json_decode($savedData->data)->trustee) ? json_decode($savedData->data)->trustee : '';

        $currentEmployer = AttorneyEmployerInformationToClient::getCurrentEmployerData(1, $client_id, $attorney_id, 1);

        $clientSettings = ClientSettings::getclientSettings($client_id, ['case_no']);
        $caseNo = (isset($clientSettings) && !empty($clientSettings)) ? $clientSettings->case_no : '';

        return view('attorney.official_form', [
            'ch7video' => VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CHAPTER_7_GUIDE),
            'ch13video' => VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CHAPTER_13_GUIDE),
            'meantestData' => \App\Models\MeanTestData::where('client_id', $client_id)->first(),
            'ispetitionPackageAdded' => \App\Models\AttorneySubscription::isPetitionPackageAvailable($client_id),
            'isParalegalPackageAdded' => \App\Models\AttorneySubscription::isParalegalAvailable($client_id),
            'dynamicHtmlData' => $dynamicHtmlData,
            'attorney_name' => $attornyUserData['name'],
            'countCreditors' => $countCreditors,
            'selectedTrusteeID' => $selectedTrusteeID,
            'tabData' => $tabData,
            'inQueue' => $inQueue,
            'countVehicle' => $vcount,
            'tranportationExpense' => $tranportationExpense,
            'editorData' => $reqlient,
            'countyList' => \App\Models\CountyFipsData::get_county_by_state_name($statename),
            'editorSavedData' => $savedData,
            'attorney_email' => Auth::user()->email,
            'clentData' => $clentData,
            'nationalPublic_transport' => $nationalPublic['one_car_cost'] ?? 0,
            'nationalOwnershipCostforvehicle1' => $ownershipCost1,
            'nationalOwnershipCostforvehicle2' => $ownershipCost2,
            'client_id' => $client_id,
            'final_debtstax' => $debtstax,
            'miscellaneous' => $pMisc,
            'basic_info' => $basic_info,
            'fips_division' => Helper::validate_key_value('division_name', $division),
            'property_info' => $propertyInfo,
            'income_info' => CacheIncome::getIncomeData($client_id),
            'debts' => $debts,
            'additional_form_url' => \App\Models\AdditionalForms::getUrlByDistrictId($distritId),
            'attorney_company' => $attorney_company,
            'expenses_info' => CacheExpense::getExpenseData($client_id),
            'spouse_expenses_info' => CacheExpense::getExpenseData($client_id, true),
            'financialaffairs_info' => CacheSOFA::getSOFAData($client_id),
            "district_names" => $district_names,
            "meansTestCalculation" => \App\Models\MeanTestPopup::get_client_means_test_calculation($basic_info, $savedData, $zip, $county),
            'incomedebtoremployer' => $incomedebtoremployer,
            'debtorspouseemployer' => $debtorspouseemployer,
            'detailed_property' => $detailed_property,
            'debtor_operation_business' => $debtor_operation_business,
            'trustees' => $trustees,
            'currentEmployer' => $currentEmployer,
            'caseNo' => $caseNo
        ]);
    }

    private static function getOwnershipCost($vcount, $nationalownership, $forvehicle)
    {
        if ($vcount == 0) {
            return 0;
        }
        if ($vcount > 0 && $forvehicle == 1) {
            return $nationalownership['one_car_cost'] ?? 0;
        }
        if ($vcount > 1 && $forvehicle == 2) {
            return $nationalownership['two_car_cost'] ?? 0;
        }
    }

    private static function getTransportExpenses($region, $propertyInfo)
    {
        $regionName = '';
        if (!empty($region) && isset($region['region_id']) && !empty($region['region_id'])) {
            $regionData = \App\Models\Region::where('id', $region['region_id'])->select('region_name')->first();
            if (!empty($regionData)) {
                $regionName = $regionData['region_name'];
            }
        }
        $transportExpense = [];
        if (!empty($regionName)) {
            $transportExpense = \App\Models\TransportationIncome::where('region', $regionName)->first();
        }


        $countVehicle = self::vehicleCount($propertyInfo);
        if ($countVehicle == 0) {
            return 0;
        }
        if ($countVehicle == 1 && !empty($transportExpense)) {
            return $transportExpense['one_car_cost'];
        }
        if ($countVehicle > 1 && !empty($transportExpense)) {
            return $transportExpense['two_car_cost'];
        }
    }

    private static function vehicleCount($propertyInfo)
    {
        $countVehicle = 0;
        if (isset($propertyInfo['propertyvehicle']) && !empty($propertyInfo['propertyvehicle'])) {
            $vehicles = $propertyInfo['propertyvehicle']->toArray();

            foreach ($vehicles as $vehi) {
                if ($vehi['own_any_property'] == 1) {
                    $countVehicle = $countVehicle + 1;
                }
            }
        }

        return $countVehicle;
    }

    private static function getCounty($savedData)
    {
        $countyId = isset($savedData->data) && !empty(json_decode($savedData->data)->selected_county) ? json_decode($savedData->data)->selected_county : 0;
        if ($countyId > 0) {
            $county = \App\Models\CountyFipsData::where('id', $countyId)->first();
            $county = !empty($county) ? $county->toArray() : [];
        }

        return $county['county_name'] ?? '';
    }

    public function package_purchase_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $type = $input['type'] ?? '';
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $clentData = \App\Models\User::where('id', $client_id)->first()->toArray();
        $packageName = "Petition Preparation";
        $needPackage = \App\Models\AttorneySubscription::selectPetitionPackage($clentData['client_subscription'], 1);
        if ($type == 'paralegal') {
            $packageName = "Paralegal Check";
            $needPackage = \App\Models\AttorneySubscription::selectParalegalPackage($clentData['client_subscription'], 1);
        }

        $availableCount = \App\Models\AttorneySubscription::getAvailablePackage(Auth::user(), $needPackage);

        return view('attorney.official_form.buy_subscription_popup', ['packageName' => $packageName,'client_id' => $client_id, 'availableCount' => $availableCount, 'needPackage' => $needPackage]);
    }

    public function save_attorney_data(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            unset($input['_token']);
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $request_for_combined = $input['request_for_combined'] ?? 0;
            if ($client_id == 0) {
                return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            unset($input['client_id']);
            $dataToSave = ['client_id' => $client_id, 'data' => json_encode($input)];
            if ($request_for_combined > 0) {
                $dataToSave['pdf_request_placed_on'] = date("Y-m-d H:i:s");
                $dataToSave['request_for_combined'] = $request_for_combined;
            }
            \App\Models\AttorneyEditorData::updateOrCreate(['client_id' => $client_id], $dataToSave);

            return response()->json(Helper::renderJsonSuccess('Data Saved Successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function activate_form_tab_by_attorney(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $formId = $input['form_id'];
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $status = $input['status'];
            $supplimentForm = [];
            $savedData = \App\Models\AttorneyEditorData::where('client_id', $client_id)->select('suppliment_form')->first();
            $supplimentForm = isset($savedData['suppliment_form']) ? json_decode($savedData['suppliment_form'], 1) : [];
            if (empty($supplimentForm)) {
                array_push($supplimentForm, $formId);
            }
            $supplimentForm = $this->validateSupplimentForm($supplimentForm, $status, $formId);
            if (empty($savedData)) {
                \App\Models\AttorneyEditorData::create(['client_id' => $client_id, 'suppliment_form' => json_encode($supplimentForm)]);
            } else {
                \App\Models\AttorneyEditorData::where(['client_id' => $client_id])->update(['client_id' => $client_id, 'suppliment_form' => json_encode($supplimentForm)]);
            }

            return response()->json(Helper::renderJsonSuccess('Setting Saved Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function getExemptionListById(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $state_name = 0;
            if (isset($input['state_name']) && !empty($input['state_name'])) {
                $state = \App\Models\State::select('state_code')->where("state_name", 'like', '%'.$input['state_name'].'%')->first();
                $state_name = $state->state_code ?? '';
            }
            $exemption_type = $input['exemption_type'] ?? 0;
            $exemptions = [];
            if (!empty($state_name)) {
                $exemptions = \App\Models\ExemptionList::where(['state_name' => $state_name, 'exemption_type' => $exemption_type])->get();
                $exemptions = !empty($exemptions) ? $exemptions->toArray() : [];
            }
            $empty = [
            'id' => 99999,
            'district_id' => 0,
            'exemption_type' => $exemption_type,
            'exemption_description' => 'Select',
            'exemption_statute' => '',
            'exemption_limit' => 0,
             'state_name' => '',
            'codebtor_exemption_limit' => 0,
            'exemption_limit_individual' => null,
            'exemption_limit_joint' => null,
            'relate' => null];

            array_unshift($exemptions, $empty);

            return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!", ['list' => $exemptions]))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function validateSupplimentForm($supplimentForm, $status, $formId)
    {
        if ($status == 1) {
            array_push($supplimentForm, $formId);
        }
        if ($status == 0) {
            $supplimentForm = array_diff($supplimentForm, [$formId]);
        }

        return  array_values(array_unique($supplimentForm));
    }


    public function resetToClientQuestionnaire($client_id)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        if ($client_id < 0) {
            return redirect()->route('attorney_offical_form', $client_id)->with('error', 'Please select any client');
        }
        \App\Models\AttorneyClientHtml::where('client_id', $client_id)->delete();

        return redirect()->route('attorney_offical_form', $client_id)->with('success', 'Client questionnaire reset to default successfully');
    }


    public function deleteHtmldata(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'] ?? 0;
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if ($client_id > 0) {
                \App\Models\AttorneyClientHtml::where('client_id', $client_id)->delete();
            }
            $requestClient = \App\Models\AttorneyEditorData::where(['request_for_combined' => 1, 'client_id' => $client_id])->first();
            $requestClient = !empty($requestClient) ? $requestClient->toArray() : [];
            if (empty($requestClient)) {
                return response()->json(Helper::renderJsonSuccess("Request added Successfully!", ['queue_count' => 0]))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $inQueue = \App\Models\AttorneyEditorData::where("request_for_combined", 1)->where('pdf_request_placed_on', '<=', $requestClient['pdf_request_placed_on'])->count();

            return response()->json(Helper::renderJsonSuccess("Request added Successfully!", ['queue_count' => $inQueue]))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }


    public function confirm_html_forms(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if ($client_id < 1) {
                return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $dataToSave = [
                'client_id' => $client_id,
                'confirm_html_forms_json' => $input['confirm_html_forms_json']
            ];

            \App\Models\AttorneyEditorData::updateOrCreate(['client_id' => $client_id], $dataToSave);
        }
    }

    public function delete_last_placed_request(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if ($client_id < 1) {
                return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $isExist = \App\Models\AttorneyEditorData::where('client_id', $client_id)->count();
            if ($isExist > 0) {
                \App\Models\AttorneyEditorData::where('client_id', $client_id)->update(['request_for_combined' => 0]);
                \App\Models\AttorneyClientHtml::where('client_id', $client_id)->delete();
                $this->checkOrCreateDir(base_path('resources') . '/courts_pdf_clients/' . $client_id);
                $countclientFiles = File::allFiles(base_path('resources') . '/courts_pdf_clients/' . $client_id);
                $this->unLinkFiles($countclientFiles);
                $this->checkOrCreateDir(base_path('resources') . '/local_forms_clients/' . $client_id);
                $localFormFiles = File::allFiles(base_path('resources') . '/local_forms_clients/' . $client_id);
                $this->unLinkFiles($localFormFiles);
            }
        }
    }

    public function check_request_queue(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if ($client_id < 1) {
                return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $requestClient = \App\Models\AttorneyEditorData::where(['request_for_combined' => 1, 'client_id' => $client_id])->first();
            $requestClient = !empty($requestClient) ? $requestClient->toArray() : [];
            if (empty($requestClient)) {
                return response()->json(Helper::renderJsonSuccess("Request added Successfully!", ['queue_count' => 0]))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $queueCount = \App\Models\AttorneyEditorData::where(['request_for_combined' => 1])->where('pdf_request_placed_on', '<=', $requestClient['pdf_request_placed_on'])->count();

            return response()->json(Helper::renderJsonSuccess("Request added Successfully!", ['queue_count' => $queueCount]))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
}
