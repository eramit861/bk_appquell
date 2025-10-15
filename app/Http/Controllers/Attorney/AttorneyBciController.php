<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\AddressHelper;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\AttorneySettings;
use App\Services\Attorney\BciService;
use App\Helpers\Helper;
use App\Helpers\DocumentHelper;
use App\Models\PayStubs;
use App\Helpers\DateTimeHelper;
use App\Helpers\ArrayHelper;
use App\Helpers\VideoHelper;
use App\Models\ClientsAssociate;
use App\Models\Debts;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheSOFA;
use Illuminate\Http\Request;

class AttorneyBciController extends AttorneyController
{
    protected static $ANPCreditors = [];
    protected static $SchHCodebtors = [];


    // anp only for unsecured and domestic
    public static function addDataToANPCreditorsArray($data)
    {
        self::$ANPCreditors[] = $data;
    }

    public static function addDataToSchHCodebtorsArray($data)
    {
        self::$SchHCodebtors[] = $data;
    }


    public function attorney_bci_popup(Request $request)
    {
        $client_id = $request->client_id;

        return view('modal.common.creditor_select_for_import_popup')
            ->with([
                'client_id' => $client_id,
                'formRoute' => route('download_attorney_bci', ['id' => $client_id]),
                'formLabel' => 'Select Creditors to Import Into - CSV (BCI)',
                'invite_video' => VideoHelper::getAttorneyVideos(Helper::CREDITOR_SELECT_VIDEO),
                'creditors' => Debts::getAllDebtCreditorsByType($client_id),
                'submitLabel' => 'Import All Creditors To BCI',
                'submitWithBalanceLabel' => 'Import Only Creditors with Balances To BCI'
            ]);
    }

    public function download_attorney_bci(Request $request, $client_id)
    {
        if (empty($client_id)) {
            return redirect()->back()->with('error', 'Please download later, something going wrong.');
        }
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->back()->with('error', 'Invalid request.');
        }
        $clientObj = \App\Models\User::where('id', $client_id)->first();

        $basic_info = CacheBasicInfo::getBasicInformationData($client_id, false, true);
        $BasicInfoPartA = empty(Helper::validate_key_value('BasicInfoPartA', $basic_info)) ? [] : Helper::validate_key_value('BasicInfoPartA', $basic_info);
        $basicInfo_AnyOtherName = (!empty($basic_info['BasicInfo_AnyOtherName'])) ? $basic_info['BasicInfo_AnyOtherName']->toArray() : [];

        $authUserName = $clientObj->name;
        $authUserName = str_replace(' ', '_', $authUserName);
        $fileName = !empty($BasicInfoPartA) ? Helper::validate_key_value('name', $BasicInfoPartA) . '_' . Helper::validate_key_value('last_name', $BasicInfoPartA) : $authUserName;

        // Sanitize the filename to handle special characters like apostrophes
        $fileName = \App\Helpers\DocumentHelper::sanitizePdfFilename($fileName);
        $fileName = 'bci-files/client/' . $client_id . '/' . $fileName . '.bci';

        $pre_path = "/bci-files/client/" . $client_id;
        $main_path = public_path() . $pre_path;
        $this->checkOrCreateDir($main_path);

        $baseContent = $this->createNewBaseFile($fileName);
        $BasicInfoPartB = (!empty($basic_info['BasicInfoPartB'])) ? $basic_info['BasicInfoPartB']->toArray() : [];

        $basicInfo_PartC = (!empty($basic_info['BasicInfo_PartC'])) ? $basic_info['BasicInfo_PartC']->toArray() : [];
        $income_info = CacheIncome::getIncomeData($client_id);
        $expenses_info = CacheExpense::getExpenseData($client_id);
        $financialaffairs_info = CacheSOFA::getSOFAData($client_id);

        // Property Resident
        $propertyresident = $clientObj->getPropertyResident(true);
        // Property Vehicle
        $propertyvehicle = $clientObj->getPropertyVehicle(true);
        // Property Household
        $propertyhousehold = $clientObj->getPropertyHousehold(true);
        $propertyhousehold = (!empty($propertyhousehold)) ? $propertyhousehold->toArray() : [];
        // Property Financial Assets
        $financialassets = $clientObj->getPropertyFinancialAssets(true);
        $financialassets = (!empty($financialassets)) ? $financialassets->toArray() : [];
        // Property Farm and Commercial
        $farmAndCommercial = $clientObj->getPropertyFarmCommercial(true);
        // Property Business Assets
        $businessassets = $clientObj->getPropertyBusinessAssets(true)->where('type', '!=', 'is_business_property');
        $businessassets = (!empty($businessassets)) ? $businessassets->toArray() : [];
        $businessassets = (!empty($businessassets)) ? array_values($businessassets) : []; // reseting array index
        // Property Miscellaneous
        $miscellaneous = $clientObj->getPropertyMiscellaneous(true);
        $miscellaneous = (!empty($miscellaneous)) ? $miscellaneous->toArray() : [];

        // deb tax
        $debtstax = CacheDebt::getDebtData($client_id);

        $baseContent = $this->getClientCasedata($baseContent, $basicInfo_PartC, $clientObj);
        $baseContent = $this->getClientDebtordata($baseContent, $BasicInfoPartA, $basicInfo_AnyOtherName);

        $baseContent = $this->getClientJointAccountdata($baseContent, $BasicInfoPartB, $BasicInfoPartA);
        $baseContent = $this->getClientOtherAccountdata($baseContent, $BasicInfoPartA, $basicInfo_AnyOtherName, $BasicInfoPartB);
        $baseContent = $this->getClientDependantdata($baseContent, $expenses_info);
        $baseContent = $this->getClientpriorCasesdata($baseContent, $basicInfo_PartC);
        $baseContent = $this->getClientrelatedCasesdata($baseContent, $basicInfo_PartC);
        $baseContent = $this->getClientAbSchduledata($baseContent, $propertyresident, $propertyvehicle, $propertyhousehold, $financialassets, $BasicInfoPartA, $businessassets, $miscellaneous, $farmAndCommercial, $client_id, $income_info);
        $baseContent = $this->getClientDefSchduledata($baseContent, $propertyresident, $propertyvehicle, $debtstax, $BasicInfoPartA, $request);
        $baseContent = $this->getClientanpSchduledata($baseContent);
        $baseContent = $this->getClientHSchduledata($baseContent);

        $baseContent = $this->getClientGSchduledata($baseContent);
        $baseContent = $this->getClientpriorSpousesdata($baseContent, $financialaffairs_info);
        $baseContent = $this->getClientSfaSchduleData($baseContent, $financialaffairs_info);

        // [Income]
        $origionalAttorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $d1Employer = $this->getAllClientEmployer($client_id, $origionalAttorneyId, 1);
        $d1Employer = $d1Employer->first();
        $d1Employer = !empty($d1Employer) ? $d1Employer->toArray() : [];

        $d2Employer = $this->getAllClientEmployer($client_id, $origionalAttorneyId, 2);
        $d2Employer = $d2Employer->first();
        $d2Employer = !empty($d2Employer) ? $d2Employer->toArray() : [];

        $baseContent = $this->getClientIncomeData($baseContent, $income_info, $attProfitLossMonths, $d1Employer, $d2Employer);
        // [Employers]
        $employersAll = $this->getAllClientEmployer($client_id, $origionalAttorneyId, '', true);
        $employersAll = $employersAll->get();
        $employersAll = !empty($employersAll) ? $employersAll->toArray() : [];

        $baseContent = $this->getClientEmployersData($baseContent, $employersAll);
        $baseContent = $this->getClientExpenseData($baseContent, $expenses_info);
        $baseContent = $this->getClientMtincData($baseContent, $client_id, $income_info);

        $baseContent = preg_replace("/(?<=[^\r]|^)\n/", "\r\n", $baseContent);
        DocumentHelper::generateFile($baseContent, $fileName);

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('download_url', url('/' . $fileName));
    }

    private function getAllClientEmployer($client_id, $attorney_id, $client_type = '', $addAdditional = false)
    {
        $condition = [
            "client_id" => $client_id,
            "attorney_id" => $attorney_id,
        ];
        $typesArray = $addAdditional ? [1, 99] : [1];

        if (!empty($client_type)) {
            $condition['client_type'] = $client_type;
        }

        return AttorneyEmployerInformationToClient::where($condition)->where("employer_name", "!=", null)
            ->whereIn('employer_type', $typesArray)
            ->orderBy('tbl_payroll_assistant_employer_to_client.client_type', 'asc')
            ->orderByRaw("CASE WHEN employer_type = 0 THEN 100 ELSE employer_type END ASC")
            ->orderBy('tbl_payroll_assistant_employer_to_client.employer_type', 'asc');
    }

    private function getClientCasedata($baseContent, $basicInfo_PartC, $user)
    {
        $marital_status = $user->client_type;
        $typeOfDebtor = 2;
        if (in_array($marital_status, ['1', '2'])) {
            $typeOfDebtor = 1;
        }
        $caseContent = "CaseNotes= \r\nNatureOfDebt=1\r\nTypeOfDebtor=" . $typeOfDebtor . "\r\nChapter=1\r\nStatus=" . Helper::validate_key_value('status', $basicInfo_PartC) . "\r\n";

        return str_replace('caseContent', $caseContent, $baseContent);
    }

    private function getClientDebtordata($baseContent, $BasicInfoPartA, $basicInfo_AnyOtherName)
    {
        $debtorContent = "FirstName=" . Helper::validate_key_value('name', $BasicInfoPartA) . "\n";
        $debtorContent = $debtorContent . "MiddleName=" . Helper::validate_key_value('middle_name', $BasicInfoPartA) . "\r\n";
        $debtorContent = $debtorContent . "LastName=" . Helper::validate_key_value('last_name', $BasicInfoPartA) . "\r\n";
        $suffixArray = ArrayHelper::getSuffixArray();
        $suffix = isset($BasicInfoPartA['suffix']) && $BasicInfoPartA['suffix'] > 0 ? $suffixArray[$BasicInfoPartA['suffix']] : '';
        $debtorContent = $debtorContent . "Generation=" . $suffix . "\r\n";
        $debtorContent = $debtorContent . "Addr=" . Helper::validate_key_value('Address', $BasicInfoPartA) . "\r\n";
        $debtorContent = $debtorContent . "City=" . Helper::validate_key_value('City', $BasicInfoPartA) . "\r\n";
        $debtorContent = $debtorContent . "State=" . Helper::validate_key_value('state', $BasicInfoPartA) . "\r\n";
        $debtorContent = $debtorContent . "Zip=" . self::formatZipCode(Helper::validate_key_value('zip', $BasicInfoPartA)) . "\r\n";
        $debtorContent = $debtorContent . "MailAddr=\r\nMailCity=\r\nMailSt=\r\nMailZip=\r\n";
        $debtorContent = $debtorContent . "HomePhone=" . Helper::validate_key_value('home', $basicInfo_AnyOtherName, "phone") . "\r\n";
        $debtorContent = $debtorContent . "WorkPhone=" . Helper::validate_key_value('cell', $basicInfo_AnyOtherName, "phone") . "\r\n";
        $debtorContent = $debtorContent . "County=" . \App\Models\CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $BasicInfoPartA)) . "\r\n";
        $debtorContent = $debtorContent . "EMail=" . Helper::validate_key_value('email', $basicInfo_AnyOtherName) . "\r\n";
        $debtorContent = $debtorContent . "ContactNotes=\r\n";
        $number = Helper::validate_key_value('security_number', $BasicInfoPartA);
        if (ctype_digit($number) && strlen($number) == 9) {
            $number = substr($number, 0, 3) . '-' .
                substr($number, 3, 2) . '-' .
                substr($number, 5);
        }
        $debtorContent = $debtorContent . "SocSecNo=" . $number . "\r\n";

        return str_replace('debtorContent', $debtorContent, $baseContent);
    }

    private function getClientJointAccountdata($baseContent, $BasicInfoPartB, $BasicInfoPartA)
    {
        $suffixArray = ArrayHelper::getSuffixArray();
        $number = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
        if (ctype_digit($number) && strlen($number) == 9) {
            $number = substr($number, 0, 3) . '-' .
                substr($number, 3, 2) . '-' .
                substr($number, 5);
        }
        $suffix = isset($BasicInfoPartB['suffix']) && $BasicInfoPartB['suffix'] > 0 ? $suffixArray[$BasicInfoPartB['suffix']] : '';
        $address = Helper::validate_key_value('Address', $BasicInfoPartB);
        $city = Helper::validate_key_value('City', $BasicInfoPartB);
        $state = Helper::validate_key_value('state', $BasicInfoPartB);
        $zip = self::formatZipCode(Helper::validate_key_value('zip', $BasicInfoPartB));
        $county = \App\Models\CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $BasicInfoPartB));

        if (isset($BasicInfoPartB['spouse_different_address']) && $BasicInfoPartB['spouse_different_address'] != 1) {
            $address = Helper::validate_key_value('Address', $BasicInfoPartA);
            $city = Helper::validate_key_value('City', $BasicInfoPartA);
            $state = Helper::validate_key_value('state', $BasicInfoPartA);
            $zip = self::formatZipCode(Helper::validate_key_value('zip', $BasicInfoPartA));
            $county = \App\Models\CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $BasicInfoPartA));
        }


        $jointContent = "FirstName=" . Helper::validate_key_value('name', $BasicInfoPartB) . "\r\nMiddleName=" . Helper::validate_key_value('middle_name', $BasicInfoPartB) . "\r\nLastName=" . Helper::validate_key_value('last_name', $BasicInfoPartB) . "\r\nGeneration=" . $suffix . "\r\nAddr=" . $address . "\r\nCity=" . $city . "\r\nState=" . $state . "\r\nZip=" . $zip . "\r\nMailAddr=\r\nMailCity=\r\nMailSt=\r\nMailZip=\r\nHomePhone=\r\nWorkPhone=\r\nEMail=\r\nCounty=" . $county . "\r\nSocSecNo=" . $number . "\r\n";

        return str_replace('jointContent', $jointContent, $baseContent);
    }

    private function getClientOtherAccountdata($baseContent, $BasicInfoPartA, $basicInfo_AnyOtherName, $BasicInfo_PartB)
    {
        $otherContent = '';
        if (!empty(Helper::validate_key_value('any_other_name', $BasicInfoPartA))) {
            if (!empty($basicInfo_AnyOtherName['name']) && is_array(json_decode($basicInfo_AnyOtherName['name'])) && count(json_decode($basicInfo_AnyOtherName['name'])) > 0) {
                $basicInfo_AnyOtherName['name'] = json_decode($basicInfo_AnyOtherName['name']);
                $basicInfo_AnyOtherName['middle_name'] = json_decode($basicInfo_AnyOtherName['middle_name']);
                $basicInfo_AnyOtherName['last_name'] = json_decode($basicInfo_AnyOtherName['last_name']);
                $basicInfo_AnyOtherName['suffix'] = json_decode($basicInfo_AnyOtherName['suffix']);
                $otherContent = self::getBasicInfoOtherNames($basicInfo_AnyOtherName);
            }
        }
        $otherContent = self::getSpouseOtherName($BasicInfo_PartB, $otherContent);

        return str_replace('otherContent', $otherContent, $baseContent);
    }

    private function getBasicInfoOtherNames($basicInfo_AnyOtherName)
    {
        $otherContent = "";
        $suffixArray = ArrayHelper::getSuffixArray();
        if (isset($basicInfo_AnyOtherName['name']) && !empty($basicInfo_AnyOtherName['name']) && is_array($basicInfo_AnyOtherName['name'])) {
            $basicInfoAnyOtherNameCount = count($basicInfo_AnyOtherName['name']);
            for ($k = 0; $k < $basicInfoAnyOtherNameCount; $k++) {
                $suffix = isset($basicInfo_AnyOtherName['suffix'][$k]) && $basicInfo_AnyOtherName['suffix'][$k] > 0 ? $suffixArray[$basicInfo_AnyOtherName['suffix'][$k]] : '';
                $firstname = Helper::validate_key_loop_value('name', $basicInfo_AnyOtherName, $k);
                $middlename = Helper::validate_key_loop_value('middle_name', $basicInfo_AnyOtherName, $k);
                $lastname = Helper::validate_key_loop_value('last_name', $basicInfo_AnyOtherName, $k);
                $otherContent = $otherContent . '1,aka,' . $lastname . "," . $firstname . "," . $middlename . "," . $suffix . "\r\n";
            }
        }

        return $otherContent;
    }

    private static function getSpouseOtherName($BasicInfo_PartB, $otherContent)
    {
        if (!empty(Helper::validate_key_value('spouse_any_other_name', $BasicInfo_PartB))) {
            $BasicInfo_PartB_AnyOtherName['spouse_other_name'] = json_decode($BasicInfo_PartB['spouse_other_name']);
            $BasicInfo_PartB_AnyOtherName['spouse_other_middle_name'] = json_decode($BasicInfo_PartB['spouse_other_middle_name']);
            $BasicInfo_PartB_AnyOtherName['spouse_other_last_name'] = json_decode($BasicInfo_PartB['spouse_other_last_name']);
            $BasicInfo_PartB_AnyOtherName['spouse_other_suffix'] = json_decode($BasicInfo_PartB['spouse_other_suffix']);

            $suffixArray = ArrayHelper::getSuffixArray();
            if (isset($BasicInfo_PartB_AnyOtherName['spouse_other_name']) && !empty($BasicInfo_PartB_AnyOtherName['spouse_other_name']) && is_array($BasicInfo_PartB_AnyOtherName['spouse_other_name'])) {
                $basicInfoPartBAnyOtherNameCount = count($BasicInfo_PartB_AnyOtherName['spouse_other_name']);
                for ($k = 0; $k < $basicInfoPartBAnyOtherNameCount; $k++) {
                    $suffix = isset($BasicInfo_PartB_AnyOtherName['spouse_other_suffix'][$k]) && $BasicInfo_PartB_AnyOtherName['spouse_other_suffix'][$k] > 0 ? $suffixArray[$BasicInfo_PartB_AnyOtherName['spouse_other_suffix'][$k]] : '';
                    $firstname = Helper::validate_key_loop_value('spouse_other_name', $BasicInfo_PartB_AnyOtherName, $k);
                    $middlename = Helper::validate_key_loop_value('spouse_other_middle_name', $BasicInfo_PartB_AnyOtherName, $k);
                    $lastname = Helper::validate_key_loop_value('spouse_other_last_name', $BasicInfo_PartB_AnyOtherName, $k);
                    $otherContent = $otherContent . '2,aka,' . $lastname . "," . $firstname . "," . $middlename . "," . $suffix . "\r\n";
                }
            }
        }

        return $otherContent;
    }

    private function getClientDependantdata($baseContent, $expenses_info)
    {
        $dependantContent = "";
        if (isset($expenses_info['any_dependents']) && $expenses_info['any_dependents'] == 1) {
            $dependent_relationship = $expenses_info['dependent_relationship'] ?? [];
            foreach ($dependent_relationship as $key => $relationship) {
                $age = $expenses_info['dependent_age'][$key] ?? '';
                $dependantContent .= $relationship . "," . $age . ",,,\r\n";
            }
        }

        return str_replace('dependantContent', $dependantContent, $baseContent);
    }

    private function getClientpriorCasesdata($baseContent, $basicInfo_PartC)
    {
        $priorCasesContent = "";
        if (!empty(Helper::validate_key_value('filed_bankruptcy_case_last_8years', $basicInfo_PartC))) {
            if (!empty($basicInfo_PartC['case_filed_state']) && is_array($basicInfo_PartC['case_filed_state']) && count($basicInfo_PartC['case_filed_state']) > 0) {
                $basicInfoPartCCaseFiledCount = count($basicInfo_PartC['case_filed_state']);
                for ($k = 0; $k < $basicInfoPartCCaseFiledCount; $k++) {
                    $priorCasesContent = $priorCasesContent . date("m/d/Y", strtotime(Helper::validate_key_loop_value('date_filed', $basicInfo_PartC, $k))) . "," . Helper::validate_key_loop_value('case_filed_state', $basicInfo_PartC, $k) . "," . Helper::validate_key_loop_value('case_number', $basicInfo_PartC, $k) . "\r\n";
                }
            }
        }

        return str_replace('priorCasesContent', $priorCasesContent, $baseContent);
    }

    private function getClientrelatedCasesdata($baseContent, $basicInfo_PartC)
    {
        $relatedCasesContent = "";
        if (!empty(Helper::validate_key_value('any_bankruptcy_cases_pending', $basicInfo_PartC))) {
            if (!empty($basicInfo_PartC['any_bankruptcy_cases_pending_data']) && is_object($basicInfo_PartC['any_bankruptcy_cases_pending_data'])) {
                $any_bankruptcy_cases_pending_data = $basicInfo_PartC['any_bankruptcy_cases_pending_data'];
                $relatedDebatorNames = $any_bankruptcy_cases_pending_data->debator_name;
                $totalCounts = count($relatedDebatorNames);
                for ($key = 0; $key <= $totalCounts; $key++) {
                    $relatedCasesContent = $relatedCasesContent . Helper::valueFromObjectArray('partner_date_filed', $any_bankruptcy_cases_pending_data, $key) . "," . Helper::valueFromObjectArray('partner_case_number', $any_bankruptcy_cases_pending_data, $key) . "," . Helper::valueFromObjectArray('debator_name', $any_bankruptcy_cases_pending_data, $key) . "," . Helper::valueFromObjectArray('your_relationship', $any_bankruptcy_cases_pending_data, $key) . "," . Helper::valueFromObjectArray('district', $any_bankruptcy_cases_pending_data, $key) . "\r\n";
                }
            }
        }

        return str_replace('relatedCasesContent', $relatedCasesContent, $baseContent);
    }

    /** need to fix */

    private function getClientAbSchduledata($baseContent, $propertyresident, $propertyvehicle, $propertyhousehold, $financialassets, $BasicInfoPartA, $businessassets, $miscellaneous, $farmCommercialAssets, $client_id)
    {
        //schdule AB content
        $schAbContent = "";
        $schAbContent = self::getSchAbResidentData($propertyresident, $schAbContent, $BasicInfoPartA);
        // paystub data

        $schAbContent = self::getSchAbVehicleData($propertyvehicle, $schAbContent, $BasicInfoPartA);
        //Personal and Household Items  property
        $schAbContent = self::getSchAbPropertyHouseHold($propertyhousehold, $schAbContent, $client_id);
        //Financial Assets property
        $schAbContent = self::getSchAbFinancialAsstes($financialassets, $schAbContent);
        //Business assets
        $schAbContent = self::getSchAbBusinessAssets($businessassets, $schAbContent);
        //Farm and Commercial Fishing-Related Property
        $schAbContent = self::getSchAbFarmCommercial($farmCommercialAssets, $schAbContent);
        //miscellaneous  property
        $schAbContent = self::getSchAbMiscProperty($miscellaneous, $schAbContent);

        return str_replace('schAbContent', $schAbContent, $baseContent);
    }

    private static function getDebtorPaystubData($client_id, $schAbContent, $income_info)
    {
        $debtorPayString = self::getPaystubString(1, $client_id, $income_info);
        $spousePayString = self::getPaystubString(2, $client_id, $income_info);
        $schAbContent = $debtorPayString . $spousePayString;

        return $schAbContent;
    }

    private static function getPaystubString($debtorType, $client_id, $income_info)
    {
        $content = "";
        $paystub = new PayStubs();
        $for = ($debtorType == 1) ? 'self' : 'spouse';

        $payData = $paystub->getPaystubByType($client_id, $for);
        $payData = self::formatDebtorStubs($payData);
        if (empty($payData)) {
            return $content;
        }
        $empColName = ($debtorType == 1) ? $income_info['incomedebtoremployer'] : $income_info['debtorspouseemployer'];
        $empColNameKey = ($debtorType == 1) ? 'employer_name' : 'spouse_employer_name';

        $employerName = Helper::bciString(Helper::validate_key_value($empColNameKey, $empColName));

        $thruDate = Helper::bciString(Helper::validate_key_value('payment_date', $payData[5]));
        // $thruDate = '';
        $thruDate = !empty($thruDate) ? $thruDate : date("m/t/Y");
        $paydate = date("m/t/Y", strtotime($thruDate));

        $first = Helper::bciString(Helper::validate_key_value('gross_pay_amount', $payData[5]));
        $second = Helper::bciString(Helper::validate_key_value('gross_pay_amount', $payData[4]));
        $third = Helper::bciString(Helper::validate_key_value('gross_pay_amount', $payData[3]));
        $fourth = Helper::bciString(Helper::validate_key_value('gross_pay_amount', $payData[2]));
        $fifth = Helper::bciString(Helper::validate_key_value('gross_pay_amount', $payData[1]));
        $sixth = Helper::bciString(Helper::validate_key_value('gross_pay_amount', $payData[0]));

        $content = "1," . $debtorType . "," . $paydate . ",1,0," . $employerName . "," . $first . "," . $second . "," . $third . "," . $fourth . "," . $fifth . "," . $sixth . ",0,0,0,0,0,0,0,0,0,\r\n";

        return $content;
    }

    private static function formatDebtorStubs($debtorpaysData)
    {
        if (!empty($debtorpaysData[0])) {
            $debtorpaysData = $debtorpaysData->toArray();
            $montYears = DateTimeHelper::getMonthYearArray();
            foreach ($montYears as $m => $v) {
                if (!in_array($m, array_column($debtorpaysData, 'pay_period_end'))) {
                    array_push($debtorpaysData, ['pay_period_end' => $m, 'gross_pay_amount' => 0, 'total_taxes' => 0, 'total_deductions' => 0]);
                }
            }
            usort($debtorpaysData, function ($a, $b) {
                $dateA = \Carbon\Carbon::createFromFormat('m-Y', $a['pay_period_end']);
                $dateB = \Carbon\Carbon::createFromFormat('m-Y', $b['pay_period_end']);

                return $dateA->lt($dateB) ? -1 : ($dateA->eq($dateB) ? 0 : 1);
            });

            return $debtorpaysData;
        }
    }

    private static function getSchAbResidentData($propertyresident, $schAbContent, $BasicInfoPartA)
    {
        $pLinkId = "0000001";
        if (empty($propertyresident)) {
            return $schAbContent;
        }
        foreach ($propertyresident as $house) {
            if (Helper::validate_key_value('currently_lived', $house, 'radio') == 1) {
                $propertyDescription = Helper::validate_key_value('property_description', $house) ?? '';
                $propertyDescription = json_decode($propertyDescription, 1) ?? [];
                $propertyDetails = "";
                $propertyAddress = "";
                $SingleFamilyHome = Helper::validate_key_value_match('property', $house, 1) !== 0 ? Helper::validate_key_value_match('property', $house, 1) : '';
                $DuplexMultiUnit = Helper::validate_key_value_match('property', $house, 2) !== 0 ? Helper::validate_key_value_match('property', $house, 2) : '';
                $CondoCoop = Helper::validate_key_value_match('property', $house, 3) !== 0 ? Helper::validate_key_value_match('property', $house, 3) : '';
                $Mobile = Helper::validate_key_value_match('property', $house, 4) !== 0 ? Helper::validate_key_value_match('property', $house, 4) : '';
                $Land = Helper::validate_key_value_match('property', $house, 5) !== 0 ? Helper::validate_key_value_match('property', $house, 5) : '';
                $Investment = Helper::validate_key_value_match('property', $house, 6) !== 0 ? Helper::validate_key_value_match('property', $house, 6) : '';
                $Timeshare = Helper::validate_key_value_match('property', $house, 7) !== 0 ? Helper::validate_key_value_match('property', $house, 7) : '';
                $Other = Helper::validate_key_value_match('property', $house, 8) !== 0 ? Helper::validate_key_value_match('property', $house, 8) : '';
                $OtherType = '';
                $interest = 'Fee Simple';
                $address = $city = $state = $zip = "";
                $bedroom = '';
                $bathroom = '';
                $sqfthome = '';
                $lot_size_acres = '';
                $propertyAddress = self::schAbPropertyAddress($house, $BasicInfoPartA, $propertyDetails);

                if ($SingleFamilyHome || $DuplexMultiUnit || $CondoCoop || $Mobile) {
                    $bedroom = Helper::validate_key_value('bedroom', $propertyDescription);
                    $bathroom = Helper::validate_key_value('bathroom', $propertyDescription);
                    $sqfthome = Helper::validate_key_value('home_sq_ft', $propertyDescription);
                    $propertyDetails = "Bedrooms:" . $bedroom . " Bathrooms:" . $bathroom . " Square Feet of home:" . Helper::bciString($sqfthome);
                }
                if ($Land || $Investment) {
                    $lot_size_acres = Helper::validate_key_value('lot_size_acres', $propertyDescription);
                    $propertyDetails = " Lot size in Acres:" . $lot_size_acres;
                }

                $loanamount = 0;
                if (!empty($house->home_car_loan)) {
                    $home_car_loan = json_decode($house->home_car_loan);
                    if (!empty($home_car_loan) && isset($home_car_loan->amount_own)) {
                        $loanamount = $loanamount + (float) $home_car_loan->amount_own;
                        $interest = Helper::bciString(Helper::valueFromObject('payment_remaining', $home_car_loan));
                        $address = Helper::bciString(Helper::valueFromObject('creditor_name_addresss', $home_car_loan));
                        $city = Helper::bciString(Helper::valueFromObject('creditor_city', $home_car_loan));
                        $state = Helper::bciString(Helper::valueFromObject('creditor_state', $home_car_loan));
                        $zip = Helper::bciString(Helper::valueFromObject('creditor_zip', $home_car_loan));
                    }
                }

                $loanamount = self::getSchAbAddPropertyLoanAmount($house, $loanamount);
                $loanamount = number_format((float) $loanamount, 2, '.', '');
                $schAbContent = $schAbContent .
                    str_pad($pLinkId, 7, "0", STR_PAD_LEFT) .
                    ",1," .
                    $house->property_owned_by .
                    "," .
                    $house->estimated_property_value .
                    "," .
                    $loanamount .
                    "," .
                    $interest .
                    "," .
                    $propertyDetails .
                    $propertyAddress .
                    "," .
                    $SingleFamilyHome .
                    "," .
                    $DuplexMultiUnit .
                    "," .
                    $CondoCoop .
                    "," .
                    $Mobile .
                    "," .
                    $Land .
                    "," .
                    $Investment .
                    "," .
                    $Timeshare .
                    "," .
                    $Other .
                    "," .
                    $OtherType .
                    ",,,,,0,0,,\r\n";
                $pLinkId = ($pLinkId + 1);
            }

        }

        return $schAbContent;
    }

    private static function getSchAbAddPropertyLoanAmount($house, $loanamount)
    {
        if (!empty($house->home_car_loan2)) {
            $home_car_loan2 = json_decode($house->home_car_loan2);
            $loanamount = intval($loanamount) + intval($home_car_loan2->amount_own);
        }

        if (!empty($house->home_car_loan3)) {
            $home_car_loan3 = json_decode($house->home_car_loan3);
            $loanamount = intval($loanamount) + intval($home_car_loan3->amount_own);
        }

        return $loanamount;
    }

    private static function schAbPropertyAddress($house, $BasicInfoPartA, $propertyDetails)
    {
        if ($house->not_primary_address == 1) {
            $propertyDetails .= '';
            $propertyDetails .= ',' . Helper::bciString($house->mortgage_address);
            $propertyDetails .= ',,,' . Helper::bciString($house->mortgage_city);
            $propertyDetails .= ',' . Helper::bciString($house->mortgage_state);
            $propertyDetails .= ',' . self::formatZipCode($house->mortgage_zip);
        }

        if ($house->not_primary_address == 0) {
            $propertyDetails .= '';
            $propertyDetails .= ',' . Helper::bciString($BasicInfoPartA->Address ?? '');
            $propertyDetails .= ',,,' . Helper::bciString($BasicInfoPartA->City ?? '');
            $propertyDetails .= ',' . Helper::bciString($BasicInfoPartA->state ?? '');
            $propertyDetails .= ',' . self::formatZipCode($BasicInfoPartA->zip ?? '');
        }

        return $propertyDetails;
    }

    private static function getSchAbVehicleData($propertyvehicle, $schAbContent, $BasicInfoPartA)
    {
        $pLinkId = "3295843";
        //cars property
        if (empty($propertyvehicle)) {
            $schAbContent;
        }
        foreach ($propertyvehicle as $property) {
            $make = $model = $year = $mileage = $pLinkIdShow = $vehicleClaimAmount = "";
            if (!empty($property->loan_own_type_property)) {
                $pLinkIdShow = $pLinkId;
                $vehicle_loan_data = json_decode($property->vehicle_car_loan);
                $vehicleClaimAmount = isset($vehicle_loan_data->amount_own) ? $vehicle_loan_data->amount_own : '';
            }
            $make = Helper::bciString($property->property_make);
            $model = Helper::bciString($property->property_model);
            $year = Helper::bciString(Helper::bciString($property->property_year));
            $mileage = Helper::bciString($property->property_mileage);
            $vehicleType = self::getVehicleType($property->property_type);
            $address = 'Location:' . Helper::bciString($BasicInfoPartA->Address ?? '');
            $city = Helper::bciString($BasicInfoPartA->City ?? '');
            $state = Helper::bciString($BasicInfoPartA->state ?? '');
            $zip = $BasicInfoPartA->zip ?? '';
            //added as discussed with mike
            $ownByProperty = $property->own_by_property;
            if (!empty($property->own_by_property) && $property->own_by_property > 3) {
                $ownByProperty = 3;
            }
            $schAbContent = $schAbContent . $pLinkIdShow . "," . $vehicleType . "," . $ownByProperty . "," . $property->property_estimated_value . "," . $vehicleClaimAmount . ",," . $address . " " . $city . " " . $state . " " . $zip . "," . ",0,,,,,,,,0,0,0,0,0,," . $make . "," . $model . "," . $year . "," . $mileage . ",,,,,,,,,,\r\n";
            $pLinkId = ($pLinkId + 1);
        }

        return $schAbContent;
    }

    private static function getVehicleType($property_type)
    {
        $vehicleType = '';
        if (in_array($property_type, [1, 2])) {
            $vehicleType = 3;
        }
        if (in_array($property_type, [3, 4, 5, 6])) {
            $vehicleType = 4;
        }

        return $vehicleType;
    }

    private static function getSchAbPropertyHouseHold($propertyhousehold, $schAbContent, $client_id)
    {
        if (empty($propertyhousehold)) {
            $schAbContent;
        }
        foreach ($propertyhousehold as $property) {
            $estimated_value = $SingleFamilyHome = $DuplexMultiUnit = $CondoCoop = $Mobile = $Land = $Investment = $Timeshare = $Other = $OtherType = $interest = 0;
            $property_type = $own_by_property = 1;
            $address = $city = $state = $zip = $description = "";
            $make = $model = $year = $mileage = $style = "";
            if (!empty($property['type_value'])) {
                $property_type = AddressHelper::getHouseHoldTypes($property['type']);
                $property_type_data = json_decode($property['type_data'], 1);
                $description = isset($property_type_data[0]) ? Helper::bciString($description . $property_type_data[0]) : Helper::bciString($description);
                $estimated_value = $property_type_data[1] ?? 0;
                $schAbContent = $schAbContent . "," . $property_type . "," . $own_by_property . "," . $estimated_value . ",," . $interest . "," . $description . "," . $address . ",,," . $city . "," . $state . "," . $zip . "," . $SingleFamilyHome . "," . $DuplexMultiUnit . "," . $CondoCoop . "," . $Mobile . "," . $Land . "," . $Investment . "," . $Timeshare . "," . $Other . "," . $OtherType . "," . $make . "," . $model . "," . $year . "," . $mileage . ",0,0,," . $style . "\r\n";
            }
        }

        return $schAbContent;
    }

    private static function getSchAbFinancialAsstes($financialassets, $schAbContent)
    {
        if (empty($financialassets)) {
            $schAbContent;
        }
        foreach ($financialassets as $property) {
            $property_type = 1;
            if (!empty($property['type_value'])) {
                $property_type = ArrayHelper::getPropertyType($property['type']);
                $type_data = json_decode($property['type_data']);
                $schAbContent = self::SchAbFinancialSchPart1($type_data, $property_type, $schAbContent);
                $schAbContent = self::SchAbFinancialSchPart2($type_data, $property_type, $schAbContent, $property['type']);
            }
        }

        return $schAbContent;
    }

    private static function SchAbFinancialSchPart1($type_data, $property_type, $schAbContent)
    {
        if ($property_type == 16 && !empty($type_data)) {
            foreach ($type_data->property_value as $property_value) {
                $description = 'Cash';
                $schAbContent = $schAbContent . "," . $property_type . ",1," . $property_value . ",,0," . $description . ",,,,,,,0,0,0,0,0,0,0,0,0,,,,,0,0,,\r\n";
            }
        }

        return $schAbContent;
    }

    private static function SchAbFinancialSchPart2($type_data, $property_type, $schAbContent, $type = '')
    {
        if ($property_type == 30) {
            if (!empty($type_data) && !empty($type_data->owed_type) && is_array($type_data->owed_type)) {
                foreach ($type_data->owed_type as $key => $itemDescription) {
                    $description = Helper::bciString(ArrayHelper::getPropertyFinancialOwedTypeArray($itemDescription));
                    $estimated_value = isset($type_data->property_value) ? (array) $type_data->property_value : [];
                    $estimated_value = $estimated_value[$key] ?? '';

                    $owedType = isset($type_data->owed_type) ? (array) $type_data->owed_type : [];
                    $owedType = $owedType[$key] ?? '';

                    $owedTypeName = ArrayHelper::getPropertyFinancialOwedTypeArray($owedType);

                    $monthlyAmount = isset($type_data->monthly_amount) ? (array) $type_data->monthly_amount : [];
                    $monthlyAmount = $monthlyAmount[$key] ?? '';

                    $description = '';
                    $description = !empty($owedTypeName) ? Helper::bciString($owedTypeName . ';') : '';
                    $description = $description . (!empty($monthlyAmount) ? Helper::bciString(' Amount paid monthly: $' . $monthlyAmount . ';') : $description);

                    $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,0," . $description . ",,,,,,,0,0,0,0,0,0,0,0,0,,,,,0,0,,\r\n";
                }
            }
        } else {
            if (!empty($type_data) && !empty($type_data->description) && is_array($type_data->description)) {
                foreach ($type_data->description as $key => $itemDescription) {
                    $description = Helper::bciString($itemDescription);
                    $estimated_value = isset($type_data->property_value) ? (array) $type_data->property_value : [];
                    $estimated_value = $estimated_value[$key] ?? '';
                    if ($property_type == 17) {
                        // Bank Account One Personal Acct Ending In 1234
                        $bankNameArray = $type_data->description;
                        $bankName = $bankNameArray[$key] ?? '';

                        $pBAccountType = $type_data->personal_business_account ?? [];
                        $pBAccountType = $pBAccountType[$key] ?? '';
                        $pBAccount = '';
                        if ($pBAccountType == 1) {
                            $pBAccount = " Personal";
                        }
                        if ($pBAccountType == 2) {
                            $pBAccount = " Business";
                        }

                        $accountNoArray = $type_data->last_4_digits ?? '';
                        $accountNo = $accountNoArray[$key] ?? '';

                        if (!empty($type) && ($type == 'bank')) {
                            $description = !empty($bankName) ? Helper::bciString($bankName) : '';
                            $description = $description . (!empty($pBAccount) ? Helper::bciString($pBAccount) : $description);
                            $description = $description . (!empty($accountNo) ? Helper::bciString(' Acct Ending In ' . $accountNo) : $description);
                        }
                        if (!empty($type) && ($type == 'venmo_paypal_cash')) {
                            $accountType = $type_data->account_type ?? [];
                            $accountType = $accountType[$key] ?? '';
                            $accountName = '';
                            if (in_array($accountType, ['paypal_account_1', 'paypal_account_2', 'paypal_account_3'])) {
                                $accountName = Helper::bciString('Paypal ');
                            }
                            if (in_array($accountType, ['cash_account_1', 'cash_account_2', 'cash_account_3'])) {
                                $accountName = Helper::bciString('Cash App ');
                            }
                            if (in_array($accountType, ['venmo_account_1', 'venmo_account_2', 'venmo_account_3'])) {
                                $accountName = Helper::bciString('Venmo ');
                            }

                            $description = !empty($bankName) ? Helper::bciString($bankName) : '';
                            $description = (!empty($accountName) ? Helper::bciString($accountName . $description) : $description);


                        }
                        if (!empty($type) && ($type == 'brokerage_account')) {
                            $description = !empty($bankName) ? Helper::bciString($bankName) : '';
                            $description = $description . (!empty($accountNo) ? Helper::bciString(' Acct Ending In ' . $accountNo) : $description);
                        }

                        $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . $description . ",\r\n";
                    } elseif ($property_type == 29) {

                        $state = isset($type_data->state) ? (array) $type_data->state : [];
                        $state = $state[$key] ?? '';
                        $stateName = AddressHelper::getStateNameByCode($state);

                        $amountPerMonth = isset($type_data->description) ? (array) $type_data->description : [];
                        $amountPerMonth = $amountPerMonth[$key] ?? '';

                        $unknown = isset($type_data->property_value_unknown) ? (array) $type_data->property_value_unknown : [];
                        $unknown = $unknown[$key] ?? 0;

                        $description = '';
                        $description = !empty($stateName) ? Helper::bciString('State Court Order: ' . $stateName . ';') : '';
                        $description = $description . (!empty($amountPerMonth) ? Helper::bciString(' Amount per month: $' . $amountPerMonth . ';') : $description);
                        if ($unknown) {
                            $description = $description . (!empty($unknown) ? Helper::bciString(' Arrears/Past due: Unknown;') : $description);
                        } else {
                            $description = $description . (!empty($estimated_value) ? Helper::bciString(' Arrears/Past due: $' . $estimated_value . ';') : $description);
                        }
                        $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,0," . $description . ",,,,,,,0,0,0,0,0,0,0,0,0,,,,,0,0,,\r\n";

                    } elseif ($property_type == 31) {
                        $companyName = $type_data->type_of_account ?? [];
                        $companyName = (!empty($companyName[$key])) ? $companyName[$key] : '';

                        $accountType = $type_data->account_type ?? [];
                        $accountType = (!empty($accountType[$key])) ? $accountType[$key] : '';
                        if (!empty($type) && ($type == 'life_insurance')) {
                            $beneficiaryName = $type_data->description ?? [];
                            $beneficiaryName = (!empty($beneficiaryName[$key])) ? $beneficiaryName[$key] : '';

                            $description = '';
                            $description = !empty($accountType) ? Helper::bciString($accountType . ' Life Policy') : '';
                            $description = $description . (!empty($companyName) ? Helper::bciString(' - ' . $companyName) : $description);
                            $description = $description . (!empty($beneficiaryName) ? Helper::bciString(' - ' . $beneficiaryName) : $description);
                        }
                        if (!empty($type) && ($type == 'insurance_policies')) {
                            $description = '';
                            $description = !empty($accountType) ? Helper::bciString($accountType) : '';
                            $description = $description . (!empty($companyName) ? Helper::bciString(' - ' . $companyName) : $description);
                        }
                        $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,0," . $description . ",,,,,,,0,0,0,0,0,0,0,0,0,,,,,0,0,,\r\n";
                    } else {
                        $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,0," . $description . ",,,,,,,0,0,0,0,0,0,0,0,0,,,,,0,0,,\r\n";
                    }
                }
            }
        }

        return $schAbContent;
    }

    private static function getSchAbBusinessAssets($businessassets, $schAbContent)
    {
        if (!empty($businessassets)) {
            foreach ($businessassets as $property) {
                $property_type = 1;
                if (!empty($property['type_value'])) {
                    $property_type = AddressHelper::getSchAbPropertyType($property['type']);
                    $type_data = json_decode($property['type_data']);
                    $schAbContent = self::schAbcommissionToBi($property_type, $type_data, $schAbContent);
                    $schAbContent = self::schAbInterest($property_type, $type_data, $schAbContent);
                    $schAbContent = self::schAbMailing($property_type, $type_data, $schAbContent);
                    $schAbContent = self::schAbOtherBiz($property_type, $type_data, $schAbContent);
                }
            }
        }

        return $schAbContent;
    }

    private static function schAbOtherBiz($property_type, $type_data, $schAbContent)
    {
        if ($property_type == 44) {
            if (!empty($type_data) && !empty($type_data->description) && is_array($type_data->description)) {
                foreach ($type_data->description as $key => $itemDescription) {
                    $estimated_value = $type_data->property_value[$key];
                    $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . Helper::bciString($itemDescription) . "\r\n";
                }
            }
        }

        return $schAbContent;
    }

    private static function schAbMailing($property_type, $type_data, $schAbContent)
    {
        if ($property_type == 43) {
            if (!empty($type_data) && !empty($type_data->description)) {
                $estimated_value = $type_data->property_value;
                $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . Helper::bciString($type_data->description) . "\r\n";
            }
        }

        return $schAbContent;
    }

    private static function schAbInterest($property_type, $type_data, $schAbContent)
    {
        if ($property_type == 42) {
            if (!empty($type_data) && !empty($type_data->description) && is_array($type_data->description)) {
                foreach ($type_data->description as $key => $itemDescription) {
                    $description = Helper::bciString($itemDescription);
                    $estimated_value = $type_data->property_value[$key];
                    $ownershipPercentage = $type_data->type_of_account[$key];
                    $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . $description . ",,,,,,,,,,,,,,,,,,,,,," . $ownershipPercentage . "\r\n";
                }
            }
        }

        return $schAbContent;
    }

    private static function schAbcommissionToBi($property_type, $type_data, $schAbContent)
    {
        if (in_array($property_type, [38, 39, 40, 41])) {
            if (!empty($type_data) && !empty($type_data->description)) {
                $estimated_value = $type_data->property_value;
                $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . Helper::bciString($type_data->description) . "\r\n";
            }
        }

        return $schAbContent;
    }

    private static function getSchAbFarmCommercial($farmCommercialAssets, $schAbContent)
    {
        if (empty($farmCommercialAssets)) {
            return $schAbContent;
        }
        foreach ($farmCommercialAssets as $property) {
            $estimated_value = 0;
            $property_type = 1;
            $description = "";
            if (!empty($property['type_value'])) {
                $property_type = AddressHelper::getCommercialAsstesArray($property['type']);
                $type_data = json_decode($property['type_data']);
                if (!empty($type_data)) {
                    $estimated_value = $type_data->property_value ?? "";
                    $description = $type_data->description ?? "";
                    $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . $description . "\r\n";
                }
            }
        }

        return $schAbContent;
    }

    private static function getSchAbMiscProperty($miscellaneous, $schAbContent)
    {
        if (empty($miscellaneous)) {
            return $schAbContent;
        }
        foreach ($miscellaneous as $key => $property) {
            if (!empty($property['type_value']) && $property['type'] == 'miscellaneous') {
                $property_type = 53;
                $type_data = json_decode($property['type_data']);
                if (!empty($type_data) && !empty($type_data->description) && is_array($type_data->description)) {
                    foreach ($type_data->description as $key => $itemDescription) {
                        $description = Helper::bciString($itemDescription);
                        $estimated_value = $type_data->property_value[$key] ?? 0;
                        $schAbContent = $schAbContent . "," . $property_type . ",1," . $estimated_value . ",,," . $description . "\r\n";
                    }
                }
            }
        }

        return $schAbContent;
    }

    /** Sch Ab end here */

    /** Sch Def start from here */
    private function getClientDefSchduledata($baseContent, $propertyresident, $propertyvehicle, $debtstax, $BasicInfoPartA, $request)
    {
        $schDefContent = ""; // intailizing empty variable
        // Home loan data populating in Bci file
        $propertyresident = $propertyresident->toArray();
        $creditors = self::getDefResidentCreditors($propertyresident);

        $schDefContent = self::getDefResidentData($propertyresident, $creditors, $schDefContent);
        $CLinkID = "2926864";
        // vehicle loan data populating in Bci file
        $schDefContent = self::getDefVehicleData($propertyvehicle, $schDefContent, $CLinkID);

        // Debts data populate in bci file
        $debtstax = Debts::removeSelectedCreditorDebts($request, $debtstax, true);
        $schDefContent = self::getDefDebtTaxes($debtstax, $schDefContent, $request);

        /** Do you have any back taxes owned to the State? */
        $schDefContent = $this->getDefBackTaxes($debtstax, $schDefContent, $BasicInfoPartA);

        $schDefContent = $this->getDefIrsData($debtstax, $schDefContent);
        $domesticAddressList = [];
        $domesticArray = isset($debtstax['domestic_tax']) ? json_decode($debtstax['domestic_tax'], true) : [];
        if (
            Helper::validate_key_value('domestic_support', $debtstax) == 1
            && !empty($domesticArray) && count($domesticArray) > 0
        ) {
            $CLinkID = "000058";
            $domesticSupportCheckedNp = $request->input('domestic_support_np', []);
            foreach ($domesticArray as $debtKey => $domestic) {
                $statecode = Helper::validate_key_value('domestic_address_state', $domestic);
                $domesticAddresses = AddressHelper::getDomesticAddressStatesList($statecode, false);
                $domesticAddressList = self::getDomasticAddressList($domesticAddresses, $domestic);
                $owned_by = isset($domestic['owned_by']) && in_array($domestic['owned_by'], [1, 2, 3]) ? $domestic['owned_by'] : '';
                $domestic["CLinkID"] = str_pad($CLinkID, 6, "0", STR_PAD_LEFT);

                $schDefContent = BciService::buildSchDefContent(
                    $schDefContent,
                    $domestic,
                    'domestic_support_name',
                    'domestic_support_address',
                    'domestic_support_city',
                    'creditor_state',
                    'domestic_support_zipcode',
                    'domestic_support_account',
                    'domestic_support_past_due',
                    $owned_by
                );

                $domesticSupportCheckedNpData = Helper::validate_key_value($debtKey, $domesticSupportCheckedNp, 'array');
                foreach ($domesticAddressList as $domAddress) {
                    // add domestic address to anp array
                    // Name,Address1,Address2,Address3,City,State,Zip,Phone,AccountNo,CLinkID
                    if (is_array($domesticSupportCheckedNpData) && array_key_exists(0, $domesticSupportCheckedNpData)) {
                        $anpArray = [
                            'Name' => Helper::bciString(Helper::validate_key_value('address_name', $domAddress)),
                            'Address1' => Helper::bciString(Helper::validate_key_value('address_street', $domAddress)),
                            'Address2' => Helper::bciString(Helper::validate_key_value('address_line2', $domAddress)),
                            'Address3' => '',
                            'City' => Helper::bciString(Helper::validate_key_value('address_city', $domAddress)),
                            'State' => Helper::bciString(Helper::validate_key_value('address_state', $domAddress)),
                            'Zip' => Helper::bciString(Helper::validate_key_value('address_zip', $domAddress)),
                            'Phone' => '',
                            'AccountNo' => Helper::bciString(Helper::validate_key_value('domestic_support_account', $domAddress)),
                            'CLinkID' => str_pad($CLinkID, 6, "0", STR_PAD_LEFT),
                        ];
                        self::addDataToANPCreditorsArray($anpArray);
                    }
                    // add bk service address to anp array
                    // Name,Address1,Address2,Address3,City,State,Zip,Phone,AccountNo,CLinkID
                    if (is_array($domesticSupportCheckedNpData) && array_key_exists(1, $domesticSupportCheckedNpData)) {
                        $anpArray = [
                            'Name' => Helper::bciString(Helper::validate_key_value('notify_address_name', $domAddress)),
                            'Address1' => Helper::bciString(Helper::validate_key_value('notify_address_street', $domAddress)),
                            'Address2' => Helper::bciString(Helper::validate_key_value('notify_address_line2', $domAddress)),
                            'Address3' => '',
                            'City' => Helper::bciString(Helper::validate_key_value('notify_address_city', $domAddress)),
                            'State' => Helper::bciString(Helper::validate_key_value('address_state', $domAddress)),
                            'Zip' => Helper::bciString(Helper::validate_key_value('notify_address_zip', $domAddress)),
                            'Phone' => '',
                            'AccountNo' => Helper::bciString(Helper::validate_key_value('domestic_support_account', $domAddress)),
                            'CLinkID' => str_pad($CLinkID, 6, "0", STR_PAD_LEFT),
                        ];
                        self::addDataToANPCreditorsArray($anpArray);
                    }
                }
                $CLinkID = ($CLinkID + 1);
                $schDefContent = self::getDefDsoAddressList($domesticAddressList, $schDefContent);
            }
        }

        $schDefContent = self::getDefAdditionlLiens($debtstax, $schDefContent);

        return str_replace('schDefContent', $schDefContent, $baseContent);
    }



    private static function getDomasticAddressList($domesticAddresses, $domestic)
    {

        foreach ($domesticAddresses as $item) {
            $item['domestic_support_account'] = Helper::validate_key_value('domestic_support_account', $domestic);
            $item['domestic_support_past_due'] = Helper::validate_key_value('domestic_support_past_due', $domestic);
            $domesticAddressList[] = $item;
        }

        return $domesticAddressList;

    }

    private static function getDefResidentCreditors($propertyresident)
    {
        $creditors = [];
        $pLinkId = 0000001;
        foreach ($propertyresident as $property) {
            $currentlyLived = Helper::validate_key_value('currently_lived', $property, 'radio');
            $anyLoan = Helper::validate_key_value('loan_own_type_property', $property, 'radio');
            if ($currentlyLived == 1) {
                if (($anyLoan == 1)) {
                    $thisloan = json_decode($property['home_car_loan'], 1);
                    $thisloan['debt_owned_by'] = $property['property_owned_by'];
                    $thisloan['loan_type'] = "Deed of Trust";
                    $thisloan['pLinkId'] = str_pad($pLinkId, 7, "0", STR_PAD_LEFT);
                    $thisloan['id'] = $property['id'];
                    $creditors[] = $thisloan;
                    $creditors = self::pushLoan2Object($property, $creditors, str_pad($pLinkId, 7, "0", STR_PAD_LEFT), $property['id']);
                    $creditors = self::pushLoan3Object($property, $creditors, str_pad($pLinkId, 7, "0", STR_PAD_LEFT), $property['id']);
                }
                $pLinkId = ($pLinkId + 1);
            }
        }

        return $creditors;
    }

    private static function pushLoan2Object($val, $creditors, $pLinkId, $propertyId)
    {
        if (!empty($val['home_car_loan2'])) {
            $thisloan = json_decode($val['home_car_loan2'], 1);
            $thisloan['debt_owned_by'] = $val['property_owned_by'];
            $thisloan['loan_type'] = "Second Mortgage";
            $thisloan['pLinkId'] = $pLinkId;
            $thisloan['id'] = $propertyId;
            if (!empty($thisloan['creditor_name']) && isset($thisloan['additional_loan1']) && $thisloan['additional_loan1'] == 1) {
                $creditors[] = $thisloan;
            }
        }

        return $creditors;
    }

    private static function pushLoan3Object($val, $creditors, $pLinkId, $propertyId)
    {
        if (!empty($val['home_car_loan3'])) {
            $thisloan = json_decode($val['home_car_loan3'], 1);
            $thisloan['debt_owned_by'] = $val['property_owned_by'];
            $thisloan['loan_type'] = "Third Mortgage";
            $thisloan['pLinkId'] = $pLinkId;
            $thisloan['id'] = $propertyId;
            if (!empty($thisloan['creditor_name']) && isset($thisloan['additional_loan2']) && $thisloan['additional_loan2'] == 1) {
                $creditors[] = $thisloan;
            }
        }

        return $creditors;
    }

    private static function getDefResidentData($propertyresident, $creditors, $schDefContent)
    {
        $CLinkID = 2000001;
        if (isset($creditors) && !empty($creditors)) {
            foreach ($creditors as $creditor) {
                foreach ($propertyresident as $key => $property) {
                    $creditorID = Helper::validate_key_value('id', $creditor);
                    $propertyID = Helper::validate_key_value('id', $property);
                    if ($creditorID == $propertyID) {
                        $currentlyLived = Helper::validate_key_value('currently_lived', $property, 'radio');
                        $anyLoan = Helper::validate_key_value('loan_own_type_property', $property, 'radio');
                        if ($currentlyLived && ($anyLoan == 1)) {
                            $prop_creditor_name = Helper::validate_key_value_exclude_comma('creditor_name', $creditor);
                            $prop_creditor_address1 = Helper::validate_key_value_exclude_comma('creditor_name_addresss', $creditor);
                            $prop_creditor_address2 = "";
                            $prop_creditor_address3 = "";
                            $prop_creditor_city = Helper::validate_key_value_exclude_comma('creditor_city', $creditor);
                            $prop_creditor_state = Helper::validate_key_value_exclude_comma('creditor_state', $creditor);
                            $prop_creditor_zip = self::formatZipCode(Helper::validate_key_value_exclude_comma('creditor_zip', $creditor));
                            $prop_acc_no = Helper::validate_key_value_exclude_comma('account_number', $creditor);
                            $prop_debt_incurred_date = Helper::validate_key_value_exclude_comma('debt_incurred_date', $creditor);
                            $prop_estimated_property_value = Helper::validate_key_value('estimated_property_value', $property);
                            $prop_claim_amt = Helper::validate_key_value_exclude_comma('amount_own', $creditor);
                            $property_owned_by = Helper::validate_key_value_exclude_comma('property_owned_by', $creditor);
                            $loanType = Helper::validate_key_value_exclude_comma('loan_type', $creditor);
                            $pLinkId = Helper::validate_key_value_exclude_comma('pLinkId', $creditor);

                            $schDefContent .= $CLinkID . "," . $property_owned_by . ",D," . $prop_creditor_name . "," . $prop_creditor_address1 . "," . $prop_creditor_address2 . "," . $prop_creditor_address3 . "," . $prop_creditor_city . "," . $prop_creditor_state . "," . $prop_creditor_zip . ",," . $prop_acc_no . ",," . $prop_debt_incurred_date . ",,,,," . $prop_claim_amt . ",,,,," . $pLinkId . "," . $loanType . "," . $prop_estimated_property_value . ",,,,,,,,,1,,,," . "\r\n";

                            if (in_array(Helper::validate_key_value('property_owned_by', $creditor, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                                // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
                                $codebtorArray = [
                                    'Name' => Helper::bciString($prop_creditor_name),
                                    'Address1' => Helper::bciString($prop_creditor_address1),
                                    'Address2' => Helper::bciString($prop_creditor_address2),
                                    'Address3' => Helper::bciString($prop_creditor_address3),
                                    'City' => Helper::bciString($prop_creditor_city),
                                    'State' => Helper::bciString($prop_creditor_state),
                                    'Zip' => Helper::bciString($prop_creditor_zip),
                                    'CLinkID' => $CLinkID,
                                    'LLinkID' => ''
                                ];
                                self::addDataToSchHCodebtorsArray($codebtorArray);
                            }
                        }
                    }
                }
                $CLinkID = ($CLinkID + 1);
            }
        }

        return $schDefContent;
    }

    private static function getDefVehicleData($propertyvehicle, $schDefContent, $CLinkID)
    {
        $pLinkId = "3295843";

        foreach ($propertyvehicle as $propertyvehicledbt) {
            $cLinkIdShow = '';
            if ($propertyvehicledbt->loan_own_type_property == 1) {
                $vehicle_loan_data = json_decode($propertyvehicledbt->vehicle_car_loan);
                $vehicle_creditor_name = Helper::bciString(Helper::valueFromObject('creditor_name', $vehicle_loan_data));
                $vehicle_creditor_address1 = Helper::bciString(Helper::valueFromObject('creditor_name_addresss', $vehicle_loan_data));
                $vehicle_creditor_address2 = "";
                $vehicle_creditor_address3 = "";
                $vehicle_creditor_city = Helper::bciString(Helper::valueFromObject('creditor_city', $vehicle_loan_data));
                $vehicle_creditor_state = Helper::bciString(Helper::valueFromObject('creditor_state', $vehicle_loan_data));
                $vehicle_creditor_zip = self::formatZipCode(Helper::bciString(Helper::valueFromObject('creditor_zip', $vehicle_loan_data)));
                $vehicle_acc_no = Helper::bciString(Helper::valueFromObject('account_number', $vehicle_loan_data));
                $vehicle_debt_incurred_date = Helper::bciString(Helper::valueFromObject('debt_incurred_date', $vehicle_loan_data));
                $vehicle_estimated_property_value = Helper::bciString(Helper::valueFromObject('property_estimated_value', $propertyvehicledbt));
                $vehicle_property_type = Helper::bciString(Helper::valueFromObject('property_type', $propertyvehicledbt));
                $vehicle_claim_amt = Helper::bciString(Helper::valueFromObject('amount_own', $vehicle_loan_data));
                if (!empty($propertyvehicledbt->own_by_property) && in_array($propertyvehicledbt->own_by_property, Helper::OWNBY_FORM_VALUES)) {
                    $cLinkIdShow = str_pad($CLinkID, 6, "0", STR_PAD_LEFT);
                    // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
                    $codebtorArray = [
                        'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $propertyvehicledbt)),
                        'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $propertyvehicledbt)),
                        'Address2' => '',
                        'Address3' => '',
                        'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $propertyvehicledbt)),
                        'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $propertyvehicledbt)),
                        'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $propertyvehicledbt)),
                        'CLinkID' => $cLinkIdShow,
                        'LLinkID' => ''
                    ];
                    self::addDataToSchHCodebtorsArray($codebtorArray);
                }
                $schDefContent .= $cLinkIdShow . "," . $propertyvehicledbt->own_by_property . ",D," . $vehicle_creditor_name . "," . $vehicle_creditor_address1 . "," . $vehicle_creditor_address2 . "," . $vehicle_creditor_address3 . "," . $vehicle_creditor_city . "," . $vehicle_creditor_state . "," . $vehicle_creditor_zip . ",," . $vehicle_acc_no . ",," . $vehicle_debt_incurred_date . ",,,,," . $vehicle_claim_amt . ",,,," . $vehicle_property_type . "," . $pLinkId . ",," . $vehicle_estimated_property_value . ",,,,,,,,," . "\r\n";

                $CLinkID = ($CLinkID + 1);
            }
            $pLinkId = ($pLinkId + 1);
        }

        return $schDefContent;
    }

    private static function getDefDebtTaxes($debtstax, $schDefContent, $request)
    {

        $CLinkID = "000101";
        $debtstax1 = isset($debtstax['debt_tax']) ? json_decode($debtstax['debt_tax'], true) : [];
        if (empty($debtstax1)) {
            return $schDefContent;
        }
        $unsecuredCheckedNp = $request->input('unsecured_np', []);
        foreach ($debtstax1 as $debtKey => $debtstaxrecords) {
            $cLinkIdShow = "";
            $debt_type = Helper::validate_key_value_exclude_comma('cards_collections', $debtstaxrecords);
            $debtDetails = ArrayHelper::getDebtCardSelectionsForAttorney($debt_type);
            $debt_creditor_name = Helper::validate_key_value_exclude_comma('creditor_name', $debtstaxrecords);
            $debt_creditor_address1 = Helper::validate_key_value_exclude_comma('creditor_information', $debtstaxrecords);
            $debt_creditor_address1 = $debt_creditor_address1 != '' ? str_replace(',', '', $debt_creditor_address1) : $debt_creditor_address1;
            $debt_creditor_address2 = "";
            $debt_creditor_address3 = "";
            $debt_creditor_city = Helper::validate_key_value_exclude_comma('creditor_city', $debtstaxrecords);
            $debt_creditor_state = Helper::validate_key_value_exclude_comma('creditor_state', $debtstaxrecords);
            $debt_creditor_zip = self::formatZipCode(Helper::validate_key_value_exclude_comma('creditor_zip', $debtstaxrecords));
            $debt_acc_no = Helper::validate_key_value_exclude_comma('amount_number', $debtstaxrecords);
            $property_type = $debtDetails;
            $debt_claim_amt = Helper::validate_key_value_exclude_comma('amount_owned', $debtstaxrecords);
            $debt_incurred_date = Helper::validate_key_value_exclude_comma('debt_date', $debtstaxrecords);
            $index = $debt_type == 5 ? 2 : 1;
            $owned_by = Helper::validate_key_value_exclude_comma('owned_by', $debtstaxrecords);
            $cLinkIdShow = in_array($owned_by, Helper::OWNBY_FORM_VALUES) ? str_pad($CLinkID, 6, "0", STR_PAD_LEFT) : $cLinkIdShow;
            $owned_by = in_array($owned_by, [1, 2, 3]) ? $owned_by : '';
            $schDefContent .= $CLinkID . "," . $owned_by . ",F," . $debt_creditor_name . "," . $debt_creditor_address1 . "," . $debt_creditor_address2 . "," . $debt_creditor_address3 . "," . $debt_creditor_city . "," . $debt_creditor_state . "," . $debt_creditor_zip . ",," . $debt_acc_no . ",," . $debt_incurred_date . ",,,,," . $debt_claim_amt . ",,,,,,,,,," . $property_type . ",," . $index . ",,,,,,,\r\n";
            //$schDefContent .= ($key==count($debtstax)-1) ? "" : "\r\n";

            if (Helper::validate_key_value('original_creditor', $debtstaxrecords, 'radio') == 0 && is_array($unsecuredCheckedNp) && array_key_exists($debtKey, $unsecuredCheckedNp)) {
                // Name,Address1,Address2,Address3,City,State,Zip,Phone,AccountNo,CLinkID
                $anpArray = [
                    'Name' => Helper::bciString(Helper::validate_key_value('second_creditor_name', $debtstaxrecords)),
                    'Address1' => Helper::bciString(Helper::validate_key_value('second_creditor_information', $debtstaxrecords)),
                    'Address2' => '',
                    'Address3' => '',
                    'City' => Helper::bciString(Helper::validate_key_value('second_creditor_city', $debtstaxrecords)),
                    'State' => Helper::bciString(Helper::validate_key_value('second_creditor_state', $debtstaxrecords)),
                    'Zip' => Helper::bciString(Helper::validate_key_value('second_creditor_zip', $debtstaxrecords)),
                    'Phone' => '',
                    'AccountNo' => Helper::bciString(Helper::validate_key_value('amount_number', $debtstaxrecords)),
                    'CLinkID' => $CLinkID,
                ];
                self::addDataToANPCreditorsArray($anpArray);
            }
            if (in_array(Helper::validate_key_value('owned_by', $debtstaxrecords, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
                $codebtorArray = [
                    'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $debtstaxrecords)),
                    'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $debtstaxrecords)),
                    'Address2' => '',
                    'Address3' => '',
                    'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $debtstaxrecords)),
                    'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $debtstaxrecords)),
                    'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $debtstaxrecords)),
                    'CLinkID' => $CLinkID,
                    'LLinkID' => ''
                ];
                self::addDataToSchHCodebtorsArray($codebtorArray);
            }
            $CLinkID = str_pad(($CLinkID + 1), 6, "0", STR_PAD_LEFT);
        }

        return $schDefContent;
    }

    private function getDefBackTaxes($debtstax, $schDefContent, $BasicInfoPartA)
    {
        $backownaxes = self::getDebtTaxes($debtstax, $BasicInfoPartA);
        if (!empty($backownaxes) && count($backownaxes) > 0) {
            foreach ($backownaxes as $back) {
                $owned_by = Helper::validate_key_value_exclude_comma('owned_by', $back);
                $schDefContent = BciService::buildSchDefContent(
                    $schDefContent,
                    $back,
                    'address_heading',
                    'add1',
                    'city',
                    'statecode',
                    'zip',
                    'account_number',
                    /*'tax_total_due',$owned_by,*/
                    '',
                    $owned_by,
                    /*'add2', 'add3', 'debt_date'*/
                    'add2',
                    'add3',
                    ''
                );
                if (in_array(Helper::validate_key_value('owned_by', $back, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                    // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
                    $codebtorArray = [
                        'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $back)),
                        'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $back)),
                        'Address2' => '',
                        'Address3' => '',
                        'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $back)),
                        'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $back)),
                        'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $back)),
                        'CLinkID' => Helper::bciString(Helper::validate_key_value('CLinkID', $back)),
                        'LLinkID' => ''
                    ];
                    self::addDataToSchHCodebtorsArray($codebtorArray);
                }
            }
        }

        return $schDefContent;
    }

    private static function getDebtTaxes($debtstax, $BasicInfoPartA)
    {
        $backOwnTaxes = [];
        $CLinkID = "000051";
        $backTaxArray = isset($debtstax['back_tax_own']) ? json_decode($debtstax['back_tax_own'], true) : [];
        if (
            !empty($debtstax['tax_owned_state'])
            && !empty($backTaxArray) && count($backTaxArray) > 0
        ) {
            foreach ($backTaxArray as $pastdebt) {
                $owned_by = Helper::validate_key_value_exclude_comma('owned_by', $pastdebt);
                // $cLinkIdShow = in_array($owned_by, Helper::OWNBY_FORM_VALUES)
                //     ? str_pad($CLinkID,  6, "0", STR_PAD_LEFT)
                //     : "";
                $cLinkIdShow = str_pad($CLinkID, 6, "0", STR_PAD_LEFT);
                $stateCode = $pastdebt['debt_state'] ?? '';
                $item = AddressHelper::getStateTaxAddress($stateCode);
                $item['statecode'] = $stateCode;
                $item['account_number'] = !empty(Helper::validate_key_value_exclude_comma('security_number', $BasicInfoPartA)) ? substr(Helper::validate_key_value_exclude_comma('security_number', $BasicInfoPartA), -4) : '';
                $item['tax_total_due'] = $pastdebt['tax_total_due'];
                $item['owned_by'] = in_array($owned_by, [1, 2, 3]) ? $owned_by : '';
                $item['debt_date'] = Helper::validate_key_value_exclude_comma('tax_whats_year', $pastdebt);
                $item["CLinkID"] = $cLinkIdShow;
                $item["maskAcct"] = "1";
                $item["taxesDate"] = "Back Taxes: " . Helper::validate_key_value_exclude_comma('tax_whats_year', $pastdebt);
                $item["taxesTotalDue"] = $pastdebt['tax_total_due'];
                $item['codebtor_creditor_name'] = Helper::validate_key_value_exclude_comma('codebtor_creditor_name', $pastdebt);
                $item['codebtor_creditor_name_addresss'] = Helper::validate_key_value_exclude_comma('codebtor_creditor_name_addresss', $pastdebt);
                $item['codebtor_creditor_city'] = Helper::validate_key_value_exclude_comma('codebtor_creditor_city', $pastdebt);
                $item['codebtor_creditor_state'] = Helper::validate_key_value_exclude_comma('codebtor_creditor_state', $pastdebt);
                $item['codebtor_creditor_zip'] = Helper::validate_key_value_exclude_comma('codebtor_creditor_zip', $pastdebt);
                $backOwnTaxes[] = $item;
                $CLinkID = ($CLinkID + 1);
            }
        }

        return $backOwnTaxes;
    }

    private function getDefIrsData($debtstax, $schDefContent)
    {
        $stateCode = Helper::validate_key_value('tax_irs_state', $debtstax);
        $tax_owned_irs = Helper::validate_key_value('tax_owned_irs', $debtstax);
        if ($tax_owned_irs == 1 && !empty($stateCode)) {
            $irs = Helper::irsState('PA');
            $owned_by = Helper::validate_key_value_exclude_comma('tax_irs_owned_by', $debtstax);
            // $irs["CLinkID"] = in_array($owned_by, Helper::OWNBY_FORM_VALUES) ? "000057" : "";
            $irs["CLinkID"] = "000057";

            $schDefContent = BciService::buildSchDefContent(
                $schDefContent,
                $irs,
                'address_heading',
                'add1',
                'city',
                'statecode',
                'zip',
                'account_number',
                'tax_irs_total_due',
                $owned_by,
                'add2',
                'add3',
                'tax_irs_whats_year',
                $debtstax
            );
            if (in_array(Helper::validate_key_value('tax_irs_owned_by', $debtstax, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
                $codebtorArray = [
                    'Name' => Helper::bciString(Helper::validate_key_value('tax_irs_codebtor_creditor_name', $debtstax)),
                    'Address1' => Helper::bciString(Helper::validate_key_value('tax_irs_codebtor_creditor_name_addresss', $debtstax)),
                    'Address2' => '',
                    'Address3' => '',
                    'City' => Helper::bciString(Helper::validate_key_value('tax_irs_codebtor_creditor_city', $debtstax)),
                    'State' => Helper::bciString(Helper::validate_key_value('tax_irs_codebtor_creditor_state', $debtstax)),
                    'Zip' => Helper::bciString(Helper::validate_key_value('tax_irs_codebtor_creditor_zip', $debtstax)),
                    'CLinkID' => "000057",
                    'LLinkID' => ''
                ];
                self::addDataToSchHCodebtorsArray($codebtorArray);
            }
        }

        return $schDefContent;
    }

    private function getDefDsoAddressList($domesticAddressList, $schDefContent)
    {
        if (!empty($domesticAddressList) && count($domesticAddressList) > 0) {
            foreach ($domesticAddressList as $domestic) {
                $owned_by = isset($domestic['owned_by']) && in_array($domestic['owned_by'], [1, 2, 3]) ? $domestic['owned_by'] : '';
                $schDefContent = BciService::buildSchDefContent(
                    $schDefContent,
                    $domestic,
                    'address_name',
                    'address_street',
                    'address_city',
                    'address_state',
                    'address_zip',
                    'domestic_support_account',
                    'domestic_support_past_due',
                    $owned_by,
                    'address_line2'
                );

            }
        }

        return $schDefContent;
    }

    private function getDefAdditionlLiens($debtstax, $schDefContent)
    {
        $additional_liens = isset($debtstax['additional_liens_data']) ? json_decode($debtstax['additional_liens_data'], true) : [];
        $CLinkID = "000300";
        if (Helper::validate_key_value('additional_liens', $debtstax) == 1 && !empty($additional_liens) && count($additional_liens) > 0) {
            foreach ($additional_liens as $domestic) {
                $owned_by = isset($domestic['owned_by']) && in_array($domestic['owned_by'], [1, 2, 3]) ? $domestic['owned_by'] : '';
                $cLinkIdShow = str_pad($CLinkID, 6, "0", STR_PAD_LEFT);
                $domestic['CLinkID'] = $cLinkIdShow;
                $schDefContent = BciService::buildSchDefContent(
                    $schDefContent,
                    $domestic,
                    'domestic_support_name',
                    'domestic_support_address',
                    'domestic_support_city',
                    'creditor_state',
                    'domestic_support_zipcode',
                    'additional_liens_account',
                    'additional_liens_due',
                    $owned_by,
                    '',
                    '',
                    'additional_liens_date',
                    [],
                    'D'
                );
                if (in_array(Helper::validate_key_value('owned_by', $domestic, 'radio'), Helper::OWNBY_FORM_VALUES)) {
                    // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
                    $codebtorArray = [
                        'Name' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name', $domestic)),
                        'Address1' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_name_addresss', $domestic)),
                        'Address2' => '',
                        'Address3' => '',
                        'City' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_city', $domestic)),
                        'State' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_state', $domestic)),
                        'Zip' => Helper::bciString(Helper::validate_key_value('codebtor_creditor_zip', $domestic)),
                        'CLinkID' => $cLinkIdShow,
                        'LLinkID' => ''
                    ];
                    self::addDataToSchHCodebtorsArray($codebtorArray);
                }
                $CLinkID = ($CLinkID + 1);
            }
        }

        return $schDefContent;
    }

    /** Sch Def Data start */

    private function getClientanpSchduledata($baseContent)
    {
        $anpContent = "";
        $ANPCreditorsList = self::$ANPCreditors;
        foreach ($ANPCreditorsList as $data) {
            // Name,Address1,Address2,Address3,City,State,Zip,Phone,AccountNo,CLinkID
            $Name = Helper::bciString(Helper::validate_key_value('Name', $data));
            $Address1 = Helper::bciString(Helper::validate_key_value('Address1', $data));
            $Address2 = Helper::bciString(Helper::validate_key_value('Address2', $data));
            $Address3 = Helper::bciString(Helper::validate_key_value('Address3', $data));
            $City = Helper::bciString(Helper::validate_key_value('City', $data));
            $State = Helper::bciString(Helper::validate_key_value('State', $data));
            $Zip = Helper::bciString(self::formatZipCode(Helper::validate_key_value('Zip', $data)));
            $Phone = Helper::bciString(Helper::validate_key_value('Phone', $data));
            $AccountNo = Helper::bciString(Helper::validate_key_value('AccountNo', $data));
            $CLinkID = Helper::bciString(Helper::validate_key_value('CLinkID', $data));

            $anpContent .= $Name . "," . $Address1 . "," . $Address2 . "," . $Address3 . "," . $City . "," . $State . "," . $Zip . "," . $Phone . "," . $AccountNo . "," . $CLinkID . "\r\n";
        }

        return str_replace('anpContent', $anpContent, $baseContent);
    }

    /** Sch H Data start */
    private function getClientHSchduledata($baseContent)
    {
        $schHContent = "";
        $SchHCodebtorsList = self::$SchHCodebtors;
        foreach ($SchHCodebtorsList as $data) {
            // Name,Address1,Address2,Address3,City,State,Zip,CLinkID,LLinkID
            $Name = Helper::bciString(Helper::validate_key_value('Name', $data));
            $Address1 = Helper::bciString(Helper::validate_key_value('Address1', $data));
            $Address2 = Helper::bciString(Helper::validate_key_value('Address2', $data));
            $Address3 = Helper::bciString(Helper::validate_key_value('Address3', $data));
            $City = Helper::bciString(Helper::validate_key_value('City', $data));
            $State = Helper::bciString(Helper::validate_key_value('State', $data));
            $Zip = Helper::bciString(self::formatZipCode(Helper::validate_key_value('Zip', $data)));
            $CLinkID = Helper::bciString(Helper::validate_key_value('CLinkID', $data));
            $schHContent .= $Name . "," . $Address1 . "," . $Address2 . "," . $Address3 . "," . $City . "," . $State . "," . $Zip . "," . $CLinkID . "," . "\r\n";
        }

        return str_replace('schHContent', $schHContent, $baseContent);
    }

    private function increaseCLinkID($thisloan, $CLinkID)
    {
        if (
            !empty($thisloan)
            && (!empty($thisloan['additional_loan2']) || !empty($thisloan['additional_loan1']))
        ) {
            $CLinkID = ($CLinkID + 1);
        }

        return $CLinkID;
    }

    private function getvehicleCodebtor($propertyvehicle, $debtors)
    {
        $CLinkID = "2926864";
        foreach ($propertyvehicle as $veh) {
            if (isset($veh['own_any_property']) && $veh['own_any_property'] == 1 && $veh['loan_own_type_property'] == 1) {
                if (in_array($veh['own_by_property'], Helper::OWNBY_FORM_VALUES) && !empty($veh['codebtor_creditor_name'])) {
                    $debtors = BciService::buildDebtorsData($debtors, $veh, $CLinkID);
                }
                $CLinkID = ($CLinkID + 1);
            }
        }

        return $debtors;
    }

    private function getSchHDebtTax($final_debtstax, $debtors)
    {
        $CLinkID = "000001";
        if (empty($final_debtstax['debt_tax'])) {
            return [];
        }
        foreach ($final_debtstax['debt_tax'] as $dt) {
            if (isset($dt['owned_by'])) {
                if (in_array($dt['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    $debtors = BciService::buildDebtorsData($debtors, $dt, str_pad($CLinkID, 6, "0", STR_PAD_LEFT));
                }
            }
            $CLinkID = ($CLinkID + 1);
        }

        return $debtors;
    }

    private function getSchHTaxOwned($final_debtstax, $debtors)
    {
        $CLinkID = "000051";
        if (Helper::validate_key_value('tax_owned_state', $final_debtstax) == 1) {
            foreach ($final_debtstax['back_tax_own'] as $dt) {
                if (isset($dt['owned_by']) && in_array($dt['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    $debtors = BciService::buildDebtorsData($debtors, $dt, str_pad($CLinkID, 6, "0", STR_PAD_LEFT));
                }
                $CLinkID = ($CLinkID + 1);
            }
        }

        return $debtors;
    }

    private function getSchHIrs($final_debtstax, $debtors)
    {
        if (
            Helper::validate_key_value('tax_owned_irs', $final_debtstax) == 1
            && in_array($final_debtstax['tax_irs_owned_by'], Helper::OWNBY_FORM_VALUES)
        ) {
            $debtors = BciService::buildDebtorsDataForIrs($debtors, $final_debtstax, "000057");
        }

        return $debtors;
    }

    private function getSchHLiens($final_debtstax, $debtors)
    {
        if (Helper::validate_key_value('additional_liens', $final_debtstax) == 1) {
            foreach ($final_debtstax['additional_liens_data'] as $dt) {
                if (isset($dt['owned_by']) && in_array($dt['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    $debtors = BciService::buildDebtorsData($debtors, $dt);
                }
            }
        }

        return $debtors;
    }

    private static function includeSchHCodebtors($debtors, $schHContent)
    {
        if (empty($debtors)) {
            return $schHContent;
        }
        foreach ($debtors as $debt) {
            if (isset($debt['codebtor_creditor_name']) && !empty($debt['codebtor_creditor_name'])) {
                $name = Helper::validate_key_value_exclude_comma('codebtor_creditor_name', $debt);
                $street = Helper::validate_key_value_exclude_comma('codebtor_creditor_name_addresss', $debt);
                $city = Helper::validate_key_value_exclude_comma('codebtor_creditor_city', $debt);
                $state = Helper::validate_key_value_exclude_comma('codebtor_creditor_state', $debt);
                $zip = Helper::validate_key_value_exclude_comma('codebtor_creditor_zip', $debt);
                $cLinkId = Helper::validate_key_value_exclude_comma('codebtor_cLink_id', $debt);
                $schHContent .= $name . "," . $street . ",,," . $city . "," . $state . "," . $zip . "," . $cLinkId . ",\r\n";
            }
        }

        return $schHContent;
    }

    /** Sch H end Here */

    private function getClientGSchduledata($baseContent)
    {
        $schGContent = "";

        return str_replace('schGContent', $schGContent, $baseContent);
    }

    private function getClientpriorSpousesdata($baseContent, $financialaffairs_info)
    {
        // list of spouse or domestic partner
        $priorSpousesContent = "";
        if (isset($financialaffairs_info['living_domestic_partner']) && $financialaffairs_info['living_domestic_partner'] == 1) {
            $livingCount = isset($financialaffairs_info['community_property_state']) && !is_array($financialaffairs_info['community_property_state']) ? count($financialaffairs_info['community_property_state']) : 0;
            if (!empty($livingCount)) {
                for ($key = 0; $key <= $livingCount; $key++) {
                    $spouseName = Helper::validate_key_loop_value_exclude_comma('domestic_partner', $financialaffairs_info, $key);
                    $spouseAddr = Helper::validate_key_loop_value_exclude_comma('domestic_partner_street_address', $financialaffairs_info, $key);
                    $spouseAddr2 = "";
                    $spouseCity = Helper::validate_key_loop_value_exclude_comma('domestic_partner_city', $financialaffairs_info, $key);
                    $spouseState = Helper::validate_key_loop_value_exclude_comma('domestic_partner_state', $financialaffairs_info, $key);
                    $spouseZip = self::formatZipCode(Helper::validate_key_loop_value_exclude_comma('domestic_partner_zip', $financialaffairs_info, $key));
                    $spouseMarrigeDate = "";
                    $SateReside = Helper::validate_key_loop_value_exclude_comma('community_property_state', $financialaffairs_info, $key);
                    $SpouseDS = "";
                    $comment = "";
                    $priorSpousesContent .= "," . $spouseName . "," . $spouseAddr . "," . $spouseAddr2 . "," . $spouseCity . "," . $spouseState . "," . $spouseZip . "," . $spouseMarrigeDate . "," . $SateReside . "," . $SpouseDS . "," . $comment . "\r\n";
                }
            }
        }

        return str_replace('priorSpousesContent', $priorSpousesContent, $baseContent);
    }

    /** Sofa tab question start */
    private function getClientSfaSchduleData($baseContent, $financialaffairs_info)
    {
        $sfaContent = "";
        $married = Helper::validate_key_value('current_marital_Status', $financialaffairs_info) > 0 ? Helper::validate_key_value('current_marital_Status', $financialaffairs_info) : 0;
        $sfaContent = $sfaContent . "1," . $married . "\r\n";
        $sfaContent = self::sofa2Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa3Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa4Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa5Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa6Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa7Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa8Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa9Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa10Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa11Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa12Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa13Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa14Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa15Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa16Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa17Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa18Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa19Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa20Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa21Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa22Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa23Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa24Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa25Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa26Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa27Ques($financialaffairs_info, $sfaContent);
        $sfaContent = self::sofa28Ques($financialaffairs_info, $sfaContent);

        return str_replace('sfaContent', $sfaContent, $baseContent);
    }

    private static function sofa2Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_every_address', $financialaffairs_info, 'radio') == 0) {
            if (!empty($financialaffairs_info['prev_address']['creditor_street'])) {
                $previousAddressStreetCount = count($financialaffairs_info['prev_address']['creditor_street']);
                for ($i = 0; $i < $previousAddressStreetCount; $i++) {
                    $finData = $financialaffairs_info['prev_address'];
                    $street = Helper::validate_key_loop_value_exclude_comma("creditor_street", $finData, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("creditor_city", $finData, $i);
                    $state = Helper::validate_key_loop_value("creditor_state", $finData, $i);
                    $zip = self::formatZipCode(Helper::validate_key_loop_value("creditor_zip", $finData, $i));
                    $from = Helper::validate_key_loop_value("from", $finData, $i);
                    $to = Helper::validate_key_loop_value("to", $finData, $i);
                    $sfaContent = $sfaContent . "2,," . $street . "," . $city . "," . $state . "," . $zip . ",,,,,," . $from . " - " . $to . ",,1,1\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa3Ques($financialaffairs_info, $sfaContent)
    {
        $livingPartner = Helper::validate_key_value('living_domestic_partner', $financialaffairs_info, '');
        $livingPartner = $livingPartner > 0 ? $livingPartner : 0;
        $sfaContent = $sfaContent . "3,0," . $livingPartner . "\r\n";

        return $sfaContent;
    }

    private static function sofa4Ques($financialaffairs_info, $sfaContent)
    {
        $part1 = self::sofa4DebtorPart('total_amount_this_year', 'total_amount_this_year_extra', $financialaffairs_info);
        $part2 = self::sofa4DebtorPart('total_amount_last_year', 'total_amount_last_year_extra', $financialaffairs_info);
        $part3 = self::sofa4DebtorPart('total_amount_lastbefore_year_extra', 'total_amount_lastbefore_year_extra', $financialaffairs_info);
        $spart1 = self::sofa4SpousePart('total_amount_spouse_this_year', 'total_amount_spouse_this_year_extra', $financialaffairs_info);
        $spart2 = self::sofa4SpousePart('total_amount_spouse_last_year', 'total_amount_spouse_last_year_extra', $financialaffairs_info);
        $spart3 = self::sofa4SpousePart('total_amount_spouse_lastbefore_year', 'total_amount_spouse_lastbefore_year_extra', $financialaffairs_info);
        if (Helper::validate_key_value('total_amount_income', $financialaffairs_info) == 1) {
            $stringa = self::getSOFAIncomeString($financialaffairs_info, date("Y"), 'total_amount_this_year', 'total_amount_this_year_income', $part1, 'total_amount_spouse_this_year', 'total_amount_spouse_this_year_income', $spart1);
            $stringb = self::getSOFAIncomeString($financialaffairs_info, date("Y", strtotime("-1 year")), 'total_amount_last_year', 'total_amount_last_year_income', $part2, 'total_amount_spouse_last_year', 'total_amount_spouse_last_year_income', $spart2);
            $stringc = self::getSOFAIncomeString($financialaffairs_info, date("Y", strtotime("-2 year")), 'total_amount_lastbefore_year', 'total_amount_lastbefore_year_income', $part3, 'total_amount_spouse_lastbefore_year', 'total_amount_spouse_lastbefore_year_income', $spart3);
            $sfaContent = $sfaContent . $stringa . $stringb . $stringc;
        }

        return $sfaContent;
    }

    private static function sofa4DebtorPart($keyMain, $keyExtra, $financialaffairs_info)
    {
        $one1 = Helper::validate_key_value($keyMain, $financialaffairs_info) == 1 ? 1 : 0;
        $one2 = Helper::validate_key_value($keyMain, $financialaffairs_info) != 1 ? 1 : 0;
        $one3 = Helper::validate_key_value($keyExtra, $financialaffairs_info) == 1 ? 1 : 0;
        $one4 = Helper::validate_key_value($keyExtra, $financialaffairs_info) != 1 ? 1 : 0;

        return ['one1' => $one1, 'one2' => $one2, 'one3' => $one3, 'one4' => $one4];
    }

    private static function sofa4SpousePart($keyMain, $keyExtra, $financialaffairs_info)
    {
        $one1 = Helper::validate_key_value($keyMain, $financialaffairs_info) == 1 ? 1 : 0;
        $one2 = Helper::validate_key_value($keyMain, $financialaffairs_info) != 1 ? 1 : 0;
        $one3 = Helper::validate_key_value($keyExtra, $financialaffairs_info) == 1 ? 1 : 0;
        $one4 = Helper::validate_key_value($keyExtra, $financialaffairs_info) != 1 ? 1 : 0;

        return ['sone1' => $one1, 'sone2' => $one2, 'sone3' => $one3, 'sone4' => $one4];
    }

    private static function getSOFAIncomeString($mainDataArray, $date, $incomeTypeKey = '', $amountKey = '', $partDebtor, $spouseIncomeTypeKey = '', $spouseAmountKey = '', $partSpouse)
    {
        $debtorString = "";
        $spouseString = "";
        $dataString = "";
        $dataStringExtra = "";
        $d1AddMore = false;
        $d2AddMore = false;

        if (isset($mainDataArray[$amountKey . '_extra']) && $mainDataArray[$amountKey . '_extra'] != null) {
            $typeA = $mainDataArray[$incomeTypeKey];
            $typeB = $mainDataArray[$incomeTypeKey . '_extra'];
            $amountA = number_format((float) Helper::validate_key_value($amountKey, $mainDataArray), 2, '.', '');
            $amountB = number_format((float) Helper::validate_key_value($amountKey . '_extra', $mainDataArray), 2, '.', '');
            $totalAmount = (float) $amountA + (float) $amountB;
            // case same
            if ($typeA == $typeB) {
                $debtorString = "4," . $date . "," . $partDebtor['one1'] . "," . $partDebtor['one2'] . "," . $totalAmount . ",";
            }
            if ($typeA != $typeB) {
                $d1AddMore = true;
                $debtorString = "4," . $date . "," . $partDebtor['one1'] . "," . $partDebtor['one2'] . "," . $amountA . ",";
                $debtorStringExtra = "4," . $date . "," . $partDebtor['one3'] . "," . $partDebtor['one4'] . "," . $amountB . ",";
            }
        } else {
            $debtorString = "4," . $date . "," . $partDebtor['one1'] . "," . $partDebtor['one2'] . "," . Helper::validate_key_value($amountKey, $mainDataArray) . ",";
        }

        if (isset($mainDataArray[$spouseAmountKey . '_extra']) && $mainDataArray[$spouseAmountKey . '_extra'] != null) {
            $typeA = $mainDataArray[$spouseIncomeTypeKey];
            $typeB = $mainDataArray[$spouseIncomeTypeKey . '_extra'];
            $amountA = number_format((float) Helper::validate_key_value($spouseAmountKey, $mainDataArray), 2, '.', '');
            $amountB = number_format((float) Helper::validate_key_value($spouseAmountKey . '_extra', $mainDataArray), 2, '.', '');
            $totalAmount = (float) $amountA + (float) $amountB;
            // case same
            if ($typeA == $typeB) {
                $spouseString = $partSpouse['sone1'] . "," . $partSpouse['sone2'] . "," . $totalAmount . "\r\n";
            }
            if ($typeA != $typeB) {
                $d2AddMore = true;
                $spouseString = $partSpouse['sone1'] . "," . $partSpouse['sone2'] . "," . $amountA . "\r\n";
                $spouseStringExtra = $partSpouse['sone3'] . "," . $partSpouse['sone4'] . "," . $amountB . "\r\n";
            }
        } else {
            $spouseString = $partSpouse['sone1'] . "," . $partSpouse['sone2'] . "," . Helper::validate_key_value($spouseAmountKey, $mainDataArray) . "\r\n";
        }

        $dataString = $debtorString . $spouseString;

        if ($d1AddMore && $d2AddMore) {
            $dataStringExtra = $debtorStringExtra . $spouseStringExtra;
        }

        if (!$d1AddMore && !$d2AddMore) {
            $dataStringExtra = "";
        }

        if (!$d1AddMore && $d2AddMore) {
            $dataStringExtra = "4," . $date . ",,,," . $spouseStringExtra;
        }

        if ($d1AddMore && !$d2AddMore) {
            $dataStringExtra = $debtorStringExtra . ",,\r\n";
        }

        $finalString = $dataString . $dataStringExtra;

        return $finalString;
    }

    private static function sofa5Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('other_income_received_income', $financialaffairs_info) == 1) {
            // for current year

            $currentYearArrayD1 = Helper::validate_key_value('other_income_received_this_year', $financialaffairs_info);
            $currentYearArrayD2 = Helper::validate_key_value('other_income_received_spouse_this_year', $financialaffairs_info);
            $countCurrentYearArrayD1 = is_array($currentYearArrayD1) ? count($currentYearArrayD1) : 0;
            $countCurrentYearArrayD2 = is_array($currentYearArrayD2) ? count($currentYearArrayD2) : 0;
            $maxCountCurrentYear = max($countCurrentYearArrayD1, $countCurrentYearArrayD2);

            for ($i = 0; $i < $maxCountCurrentYear; $i++) {
                $debtorString = self::generateQ5String($financialaffairs_info, $i, 'other_income_received_this_year', 'other_amount_this_year_income');
                $codebtorString = self::generateQ5String($financialaffairs_info, $i, 'other_income_received_spouse_this_year', 'other_amount_spouse_this_year_income');
                $sfaContent = $sfaContent . "5," . date("Y") . "," . $debtorString . ',' . $codebtorString . "\r\n";
            }

            // for last year
            $lastYearArrayD1 = Helper::validate_key_value('other_income_received_last_year', $financialaffairs_info);
            $lastYearArrayD2 = Helper::validate_key_value('other_income_received_spouse_last_year', $financialaffairs_info);
            $countLastYearArrayD1 = is_array($lastYearArrayD1) ? count($lastYearArrayD1) : 0;
            $countLastYearArrayD2 = is_array($lastYearArrayD2) ? count($lastYearArrayD2) : 0;
            $maxCountLastYear = max($countLastYearArrayD1, $countLastYearArrayD2);

            for ($i = 0; $i < $maxCountLastYear; $i++) {
                $debtorString = self::generateQ5String($financialaffairs_info, $i, 'other_income_received_last_year', 'other_amount_last_year_income');
                $codebtorString = self::generateQ5String($financialaffairs_info, $i, 'other_income_received_spouse_last_year', 'other_amount_spouse_last_year_income');

                $sfaContent = $sfaContent . "5," . date("Y", strtotime("-1 year")) . "," . $debtorString . ',' . $codebtorString . "\r\n";
            }

            // for last before year
            $lastBeforeYearArrayD1 = Helper::validate_key_value('other_income_received_lastbefore_year', $financialaffairs_info);
            $lastBeforeYearArrayD2 = Helper::validate_key_value('other_income_received_spouse_lastbefore_year', $financialaffairs_info);
            $countLastBeforeYearArrayD1 = is_array($lastBeforeYearArrayD1) ? count($lastBeforeYearArrayD1) : 0;
            $countLastBeforeYearArrayD2 = is_array($lastBeforeYearArrayD2) ? count($lastBeforeYearArrayD2) : 0;
            $maxCountLastBeforeYear = max($countLastBeforeYearArrayD1, $countLastBeforeYearArrayD2);

            for ($i = 0; $i < $maxCountLastBeforeYear; $i++) {
                $debtorString = self::generateQ5String($financialaffairs_info, $i, 'other_income_received_lastbefore_year', 'other_amount_lastbefore_year_income');
                $codebtorString = self::generateQ5String($financialaffairs_info, $i, 'other_income_received_spouse_lastbefore_year', 'other_amount_spouse_lastbefore_year_income');
                $sfaContent = $sfaContent . "5," . date("Y", strtotime("-2 year")) . "," . $debtorString . ',' . $codebtorString . "\r\n";
            }
        }

        return $sfaContent;
    }

    private static function generateQ5String($mainData, $index, $selectKey, $amountKey)
    {
        $price = Helper::validate_key_loop_value($amountKey, $mainData, $index);
        $price = number_format((float) $price, 2, '.', '');
        $price = ($price > 0) ? $price : '';
        $string = Helper::getSourceOfIncomeArray(Helper::validate_key_loop_value($selectKey, $mainData, $index));
        if (Helper::validate_key_loop_value($selectKey, $mainData, $index) == -1) {
            $string = Helper::validate_key_loop_value($selectKey . '_text', $mainData, $index);
        }

        return str_replace(',', '', $string) . "," . $price;
    }

    private static function sofa6Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('primarily_consumer_debets', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['primarily_consumer_debets_data']['creditor_address'])) {
                $primarilyConsumerDebetsAddressCount = count($financialaffairs_info['primarily_consumer_debets_data']['creditor_address']);
                for ($i = 0; $i < $primarilyConsumerDebetsAddressCount; $i++) {
                    $finData = $financialaffairs_info['primarily_consumer_debets_data'];
                    if (Helper::validate_key_loop_value("total_amount_paid", $finData, $i) >= 600) {
                        $name = Helper::validate_key_loop_value_exclude_comma("creditor_address", $finData, $i);
                        $address = Helper::validate_key_loop_value_exclude_comma("creditor_street", $finData, $i);
                        $city = Helper::validate_key_loop_value_exclude_comma("creditor_city", $finData, $i);
                        $state = Helper::validate_key_loop_value("creditor_state", $finData, $i);
                        $zip = Helper::validate_key_loop_value("creditor_zip", $finData, $i);
                        $payment_dates = Helper::validate_key_loop_value("payment_dates", $finData, $i);
                        $payment_dates2 = Helper::validate_key_loop_value("payment_dates2", $finData, $i);
                        $payment_dates3 = Helper::validate_key_loop_value("payment_dates3", $finData, $i);
                        $total_amount_paid = Helper::validate_key_loop_value("total_amount_paid", $finData, $i);
                        $amount_still_owed = Helper::validate_key_loop_value("amount_still_owed", $finData, $i);
                        $dates = $payment_dates . "," . $payment_dates2 . "," . $payment_dates3;
                        //$type = Helper::validate_key_loop_value('creditor_payment_for', $finData, $i);
                        $one = Helper::validate_key_loop_value_match('creditor_payment_for', $finData, $i, 1);
                        $two = Helper::validate_key_loop_value_match('creditor_payment_for', $finData, $i, 2);
                        $three = Helper::validate_key_loop_value_match('creditor_payment_for', $finData, $i, 3);
                        $four = Helper::validate_key_loop_value_match('creditor_payment_for', $finData, $i, 4);
                        $five = Helper::validate_key_loop_value_match('creditor_payment_for', $finData, $i, 5);
                        $six = Helper::validate_key_loop_value_match('creditor_payment_for', $finData, $i, 6);
                        $sfaContent = $sfaContent . "6," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . ',"' . $dates . '",' . $total_amount_paid . "," . $amount_still_owed . "," . $one . "," . $two . "," . $three . "," . $four . "," . $five . "," . $six . ",\r\n";
                    }
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa7Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('payment_past_one_year', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['past_one_year_data']['creditor_address_past_one_year'])) {
                $addressPastOneYearCount = count($financialaffairs_info['past_one_year_data']['creditor_address_past_one_year']);
                for ($i = 0; $i < $addressPastOneYearCount; $i++) {
                    $finData = $financialaffairs_info['past_one_year_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("creditor_address_past_one_year", $finData, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("creditor_street_past_one_year", $finData, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("creditor_city_past_one_year", $finData, $i);
                    $state = Helper::validate_key_loop_value("creditor_state_past_one_year", $finData, $i);
                    $zip = Helper::validate_key_loop_value("creditor_zip_past_one_year", $finData, $i);
                    $payment_dates = Helper::validate_key_loop_value("past_one_year_payment_dates", $finData, $i);
                    $payment_dates2 = Helper::validate_key_loop_value("past_one_year_payment_dates2", $finData, $i);
                    $payment_dates3 = Helper::validate_key_loop_value("past_one_year_payment_dates3", $finData, $i);
                    $total_amount_paid = Helper::validate_key_loop_value("past_one_year_total_amount_paid", $finData, $i);
                    $amount_still_owed = Helper::validate_key_loop_value("past_one_year_amount_still_owed", $finData, $i);
                    $dates = $payment_dates . "-" . $payment_dates2 . "-" . $payment_dates3;
                    $type = Helper::validate_key_loop_value('past_one_year_payment_reason', $finData, $i);
                    $sfaContent = $sfaContent . "7," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . ',"' . $dates . '",' . $total_amount_paid . "," . $amount_still_owed . "," . $type . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa8Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('transfers_property', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['transfers_property_data']['creditor_address_transfers_property'])) {
                $transfersPropertyAddressCount = count($financialaffairs_info['transfers_property_data']['creditor_address_transfers_property']);
                for ($i = 0; $i < $transfersPropertyAddressCount; $i++) {
                    $finData = $financialaffairs_info['transfers_property_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("creditor_address_transfers_property", $finData, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("creditor_street_transfers_property", $finData, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("creditor_city_transfers_property", $finData, $i);
                    $state = Helper::validate_key_loop_value("creditor_state_transfers_property", $finData, $i);
                    $zip = Helper::validate_key_loop_value("creditor_zip_transfers_property", $finData, $i);
                    $payment_dates = Helper::validate_key_loop_value("payment_dates_transfers_property", $finData, $i);
                    $payment_dates2 = Helper::validate_key_loop_value("payment_dates_transfers_property2", $finData, $i);
                    $payment_dates3 = Helper::validate_key_loop_value("payment_dates_transfers_property3", $finData, $i);
                    $total_amount_paid = Helper::validate_key_loop_value("total_amount_paid_transfers_property", $finData, $i);
                    $amount_still_owed = Helper::validate_key_loop_value("amount_still_owed_transfers_property", $finData, $i);
                    $dates = $payment_dates . "-" . $payment_dates2 . "-" . $payment_dates3;
                    $type = Helper::validate_key_loop_value('payment_reason_transfers_property', $finData, $i);
                    $sfaContent = $sfaContent . "8," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . ',"' . $dates . '",' . $total_amount_paid . "," . $amount_still_owed . "," . $type . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa9Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_lawsuits', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_lawsuits_data']['case_title'])) {
                $caseTitleCount = count($financialaffairs_info['list_lawsuits_data']['case_title']);
                for ($i = 0; $i < $caseTitleCount; $i++) {
                    $lawsuits = $financialaffairs_info['list_lawsuits_data'];
                    $case_title = Helper::validate_key_loop_value_exclude_comma("case_title", $lawsuits, $i);
                    $number = Helper::validate_key_loop_value_exclude_comma("case_number", $lawsuits, $i);
                    $nature = Helper::validate_key_loop_value_exclude_comma("case_nature", $lawsuits, $i);
                    $location = Helper::validate_key_loop_value_exclude_comma("agency_location", $lawsuits, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("agency_street", $lawsuits, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("agency_city", $lawsuits, $i);
                    $state = Helper::validate_key_loop_value("agency_state", $lawsuits, $i);
                    $zip = Helper::validate_key_loop_value("agency_zip", $lawsuits, $i);
                    $disposition = Helper::validate_key_loop_value('disposition', $lawsuits, $i);
                    $sfaContent = $sfaContent . "9," . $case_title . "," . $number . "," . $nature . "," . $location . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $disposition . ",\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa10Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('property_repossessed', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['property_repossessed_data']['creditor_address'])) {
                $creditorAddressCount = count($financialaffairs_info['property_repossessed_data']['creditor_address']);
                for ($i = 0; $i < $creditorAddressCount; $i++) {
                    $findata = $financialaffairs_info['property_repossessed_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("creditor_address", $findata, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("creditor_street", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("creditor_city", $findata, $i);
                    $state = Helper::validate_key_loop_value("creditor_state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("creditor_zip", $findata, $i);
                    $property = Helper::validate_key_loop_value_exclude_comma("creditor_Property", $findata, $i);
                    //$type = Helper::validate_key_loop_value('what_happened', $findata, $i);
                    $date = Helper::validate_key_loop_value("property_repossessed_date", $findata, $i);
                    $value = Helper::validate_key_loop_value("property_repossessed_value", $findata, $i);
                    $one = Helper::validate_key_loop_value_match('what_happened', $findata, $i, 1);
                    $two = Helper::validate_key_loop_value_match('what_happened', $findata, $i, 2);
                    $three = Helper::validate_key_loop_value_match('what_happened', $findata, $i, 3);
                    $four = Helper::validate_key_loop_value_match('what_happened', $findata, $i, 4);
                    $sfaContent = $sfaContent . "10," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $property . "," . $value . "," . $date . "," . $one . "," . $two . "," . $three . "," . $four . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa11Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('setoffs_creditor', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['setoffs_creditor_data']['creditors_address'])) {
                $creditorAddressCount = count($financialaffairs_info['setoffs_creditor_data']['creditors_address']);
                for ($i = 0; $i < $creditorAddressCount; $i++) {
                    $findata = $financialaffairs_info['setoffs_creditor_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("creditors_address", $findata, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("creditor_street", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("creditor_city", $findata, $i);
                    $state = Helper::validate_key_loop_value("creditor_state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("creditor_zip", $findata, $i);
                    $property = Helper::validate_key_loop_value_exclude_comma("creditors_action", $findata, $i);
                    $account_number = Helper::validate_key_loop_value('account_number', $findata, $i);
                    $date = Helper::validate_key_loop_value("date_action", $findata, $i);
                    $value = Helper::validate_key_loop_value("amount_data", $findata, $i);
                    $sfaContent = $sfaContent . "11," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $property . "," . $date . "," . $value . "," . $account_number . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa12Ques($financialaffairs_info, $sfaContent)
    {
        $appointed = Helper::validate_key_value('court_appointed', $financialaffairs_info, 'radio') > 0 ? Helper::validate_key_value('court_appointed', $financialaffairs_info, 'radio') : 0;
        $sfaContent = $sfaContent . "12," . $appointed . "\r\n";

        return $sfaContent;
    }

    private static function sofa13Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_any_gifts', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_any_gifts_data']['recipient_address'])) {
                $recipientAddressCount = count($financialaffairs_info['list_any_gifts_data']['recipient_address']);
                for ($i = 0; $i < $recipientAddressCount; $i++) {
                    $findata = $financialaffairs_info['list_any_gifts_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("recipient_address", $findata, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("creditor_street", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("creditor_city", $findata, $i);
                    $state = Helper::validate_key_loop_value("creditor_state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("creditor_zip", $findata, $i);
                    $relationship = Helper::validate_key_loop_value_exclude_comma("relationship", $findata, $i);
                    $gifts = Helper::validate_key_loop_value('gifts', $findata, $i);
                    $gifts_date_from = Helper::validate_key_loop_value("gifts_date_from", $findata, $i);
                    $gifts_date_to = Helper::validate_key_loop_value("gifts_date_to", $findata, $i);
                    $date = $gifts_date_from . "-" . $gifts_date_to;
                    $gifts_value = Helper::validate_key_loop_value("gifts_value", $findata, $i);
                    $gifts_value1 = Helper::validate_key_loop_value("gifts_value1", $findata, $i);
                    $giftvalue = $gifts_value + $gifts_value1;
                    $giftvalue = number_format((float) $giftvalue, 2, '.', '');
                    $sfaContent = $sfaContent . "13," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $relationship . "," . $gifts . "," . $date . "," . $giftvalue . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa14Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('gifts_charity', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['gifts_charity_data']['charity_address'])) {
                $charityAddressCount = count($financialaffairs_info['gifts_charity_data']['charity_address']);
                for ($i = 0; $i < $charityAddressCount; $i++) {
                    $findata = $financialaffairs_info['gifts_charity_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("charity_address", $findata, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("charity_street", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("charity_city", $findata, $i);
                    $state = Helper::validate_key_loop_value("charity_state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("charity_zip", $findata, $i);
                    $date_from = Helper::validate_key_loop_value("charity_contribution_date", $findata, $i);
                    $date_to = Helper::validate_key_loop_value("charity_contribution_date1", $findata, $i);
                    $date = $date_from . "-" . $date_to;
                    $contribution = Helper::validate_key_loop_value("charity_contribution", $findata, $i);
                    $value = Helper::validate_key_loop_value("charity_contribution_value", $findata, $i);
                    $value1 = Helper::validate_key_loop_value("charity_contribution_value1", $findata, $i);
                    $fvalue = $value + $value1;
                    $fvalue = number_format((float) $fvalue, 2, '.', '');
                    $sfaContent = $sfaContent . "14," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $date . "," . $contribution . "," . $fvalue . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa15Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('losses_from_fire', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['losses_from_fire_data']['loss_description'])) {
                $lossDescriptionCount = count($financialaffairs_info['losses_from_fire_data']['loss_description']);
                for ($i = 0; $i < $lossDescriptionCount; $i++) {
                    $findata = $financialaffairs_info['losses_from_fire_data'];
                    $loss_description = Helper::validate_key_loop_value_exclude_comma("loss_description", $findata, $i);
                    $transferred_description = Helper::validate_key_loop_value_exclude_comma("transferred_description", $findata, $i);
                    $loss_date_payment = Helper::validate_key_loop_value("loss_date_payment", $findata, $i);
                    $loss_amount_payment = $i == 0 ? Helper::validate_key_loop_value("loss_amount_payment", $findata, $i) : '';
                    $sfaContent = $sfaContent . "15," . $loss_description . "," . $transferred_description . "," . $loss_date_payment . "," . $loss_amount_payment . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa16Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('property_transferred', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['property_transferred_data']['person_paid'])) {
                $personPaidCount = count($financialaffairs_info['property_transferred_data']['person_paid']);
                for ($i = 0; $i < $personPaidCount; $i++) {
                    $findata = $financialaffairs_info['property_transferred_data'];
                    $person_paid = Helper::validate_key_loop_value_exclude_comma("person_paid", $findata, $i);
                    $person_paid_street = Helper::validate_key_loop_value_exclude_comma("person_paid_street", $findata, $i);
                    $person_paid_city = Helper::validate_key_loop_value_exclude_comma("person_paid_city", $findata, $i);
                    $person_paid_state = Helper::validate_key_loop_value("person_paid_state", $findata, $i);
                    $person_paid_zip = Helper::validate_key_loop_value("person_paid_zip", $findata, $i);
                    $person_email_or_website = Helper::validate_key_loop_value_exclude_comma("person_email_or_website", $findata, $i);
                    $person_made_payment = Helper::validate_key_loop_value_exclude_comma("person_made_payment", $findata, $i);
                    $property_transferred_value = Helper::validate_key_loop_value_exclude_comma("property_transferred_value", $findata, $i);
                    $property_transferred_date = Helper::validate_key_loop_value("property_transferred_date", $findata, $i);
                    $property_transferred_payment = Helper::validate_key_loop_value("property_transferred_payment", $findata, $i);
                    $sfaContent = $sfaContent . "16," . $person_paid . "," . $person_paid_street . "," . $person_paid_city . "," . $person_paid_state . "," . $person_paid_zip . "," . $person_made_payment . "," . $person_email_or_website . "," . $property_transferred_date . "," . $property_transferred_value . "," . $property_transferred_payment . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa17Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('property_transferred_creditors', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['property_transferred_creditors_data']['person_paid_address'])) {
                $personPaidAddressCount = count($financialaffairs_info['property_transferred_creditors_data']['person_paid_address']);
                for ($i = 0; $i < $personPaidAddressCount; $i++) {
                    $findata = $financialaffairs_info['property_transferred_creditors_data'];
                    $person_paid = Helper::validate_key_loop_value_exclude_comma("person_paid_address", $findata, $i);
                    $person_paid_street = Helper::validate_key_loop_value_exclude_comma("person_paid_street", $findata, $i);
                    $person_paid_city = Helper::validate_key_loop_value_exclude_comma("person_paid_city", $findata, $i);
                    $person_paid_state = Helper::validate_key_loop_value("person_paid_state", $findata, $i);
                    $person_paid_zip = Helper::validate_key_loop_value("person_paid_zip", $findata, $i);
                    $property_transfer_value = Helper::validate_key_loop_value_exclude_comma("property_transfer_value", $findata, $i);
                    $property_transfer_date = Helper::validate_key_loop_value("property_transfer_date", $findata, $i);
                    $property_transfer_date2 = Helper::validate_key_loop_value("property_transfer_date2", $findata, $i);
                    $dates = $property_transfer_date . "-" . $property_transfer_date2;
                    $property_transfer_amount_payment = Helper::validate_key_loop_value("property_transfer_amount_payment", $findata, $i);
                    $property_transfer_amount_payment2 = Helper::validate_key_loop_value("property_transfer_amount_payment2", $findata, $i);
                    $fprice = (float) $property_transfer_amount_payment + (float) $property_transfer_amount_payment2;
                    $fprice = number_format((float) $fprice, 2, '.', '');
                    $sfaContent = $sfaContent . "17," . $person_paid . "," . $person_paid_street . "," . $person_paid_city . "," . $person_paid_state . "," . $person_paid_zip . "," . $property_transfer_value . "," . $dates . "," . $fprice . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa18Ques($financialaffairs_info, $sfaContent)
    {
        $fprice = $fprice ?? "";

        if (Helper::validate_key_value('Property_all', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['Property_all_data']['name'])) {
                $propertyAllDataNameCount = count($financialaffairs_info['Property_all_data']['name']);
                for ($i = 0; $i < $propertyAllDataNameCount; $i++) {
                    $findata = $financialaffairs_info['Property_all_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $address = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("zip", $findata, $i);
                    $property_transfer_value = Helper::validate_key_loop_value_exclude_comma("property_transfer_value", $findata, $i);
                    $property_exchange = Helper::validate_key_loop_value_exclude_comma("property_exchange", $findata, $i);
                    $property_transfer_date = Helper::validate_key_loop_value("property_transfer_date", $findata, $i);
                    $sfaContent = $sfaContent . "18," . $name . "," . $address . "," . $city . "," . $state . "," . $zip . "," . $property_transfer_date . "," . $property_transfer_value . "," . $property_exchange . "," . $fprice . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa19Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('all_property_transfer_10_year', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['all_property_transfer_10_year_data']['trust_name'])) {
                $trustNameCount = count($financialaffairs_info['all_property_transfer_10_year_data']['trust_name']);
                for ($i = 0; $i < $trustNameCount; $i++) {
                    $findata = $financialaffairs_info['all_property_transfer_10_year_data'];
                    $trust_name = Helper::validate_key_loop_value_exclude_comma("trust_name", $findata, $i);
                    $year_property_transfer = Helper::validate_key_loop_value_exclude_comma("10year_property_transfer", $findata, $i);
                    $year_property_transfer_date = Helper::validate_key_loop_value("10year_property_transfer_date", $findata, $i);
                    $sfaContent = $sfaContent . "19," . $trust_name . "," . $year_property_transfer . "," . $year_property_transfer_date . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa20Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_all_financial_accounts', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_all_financial_accounts_data']['institution_name'])) {
                $institutionNameCount = count($financialaffairs_info['list_all_financial_accounts_data']['institution_name']);
                for ($i = 0; $i < $institutionNameCount; $i++) {
                    $findata = $financialaffairs_info['list_all_financial_accounts_data'];
                    $institution_name = Helper::validate_key_loop_value_exclude_comma("institution_name", $findata, $i);
                    $street_number = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("zip", $findata, $i);
                    $account_number = Helper::validate_key_loop_value("account_number", $findata, $i);
                    $type_of_account = Helper::validate_key_loop_value('type_of_account', $findata, $i);
                    $date_account_closed = Helper::validate_key_loop_value('date_account_closed', $findata, $i);
                    $last_balance = Helper::validate_key_loop_value('last_balance', $findata, $i);
                    $sfaContent = $sfaContent . "20," . $institution_name . "," . $street_number . "," . $city . "," . $state . "," . $zip . "," . $type_of_account . ",," . $date_account_closed . "," . $account_number . "," . $last_balance . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa21Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_safe_deposit', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_safe_deposit_data']['name'])) {
                $depositDataNameCount = count($financialaffairs_info['list_safe_deposit_data']['name']);
                for ($i = 0; $i < $depositDataNameCount; $i++) {
                    $findata = $financialaffairs_info['list_safe_deposit_data'];
                    $name21Ques = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number21Ques = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city21Ques = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state21Ques = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip21Ques = Helper::validate_key_loop_value("zip", $findata, $i);
                    $nameandaddrss = Helper::validate_key_loop_value_exclude_comma('bo_name', $findata, $i);
                    $nameandaddrss .= Helper::validate_key_loop_value_exclude_comma('bo_street_number', $findata, $i);
                    $have_access_of_box = Helper::validate_key_loop_value("have_access_of_box", $findata, $i);
                    $have_access_of_box = $have_access_of_box > 0 ? $have_access_of_box : 0;
                    $contents = Helper::validate_key_loop_value("contents", $findata, $i);
                    $sfaContent = $sfaContent . "21," . $name21Ques . "," . $street_number21Ques . "," . $city21Ques . "," . $state21Ques . "," . $zip21Ques . "," . $nameandaddrss . "," . $contents . "," . $have_access_of_box . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa22Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('other_storage_unit', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['other_storage_unit_data']['name'])) {
                $otherUnitDataNameCount = count($financialaffairs_info['other_storage_unit_data']['name']);
                for ($i = 0; $i < $otherUnitDataNameCount; $i++) {
                    $findata = $financialaffairs_info['other_storage_unit_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("zip", $findata, $i);
                    $nameandaddrss = Helper::validate_key_loop_value_exclude_comma('bd_name', $findata, $i);
                    $nameandaddrss .= Helper::validate_key_loop_value_exclude_comma('bd_street_number', $findata, $i);
                    $have_access_of_box = Helper::validate_key_loop_value("still_have_storage_unit", $findata, $i);
                    $have_access_of_box = $have_access_of_box > 0 ? $have_access_of_box : 0;
                    $contents = Helper::validate_key_loop_value("contents", $findata, $i);
                    $sfaContent = $sfaContent . "22," . $name . "," . $street_number . "," . $city . "," . $state . "," . $zip . "," . $nameandaddrss . "," . $contents . "," . $have_access_of_box . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa23Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_property_you_hold', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_property_you_hold_data']['name'])) {
                $propertyHoldDataCount = count($financialaffairs_info['list_property_you_hold_data']['name']);
                for ($i = 0; $i < $propertyHoldDataCount; $i++) {
                    $findata = $financialaffairs_info['list_property_you_hold_data'];
                    $name23Ques = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number23Ques = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city23Ques = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state23Ques = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip23Ques = Helper::validate_key_loop_value("zip", $findata, $i);
                    $name2 = '';
                    $street_number2 = Helper::validate_key_loop_value_exclude_comma("location_street_number", $findata, $i);
                    $city2 = Helper::validate_key_loop_value_exclude_comma("location_city", $findata, $i);
                    $state2 = Helper::validate_key_loop_value("location_state", $findata, $i);
                    $zip2 = Helper::validate_key_loop_value("location_zip", $findata, $i);
                    $desc = Helper::validate_key_loop_value_exclude_comma("property_desc", $findata, $i);
                    $value = Helper::validate_key_loop_value("property_value", $findata, $i);
                    $sfaContent = $sfaContent . "23," . $name23Ques . "," . $street_number23Ques . "," . $city23Ques . "," . $state23Ques . "," . $zip23Ques . "," . $name2 . "," . $street_number2 . "," . $city2 . "," . $state2 . "," . $zip2 . "," . $desc . "," . $value . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa24Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_noticeby_gov', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_noticeby_gov_data']['name'])) {
                $listNoticeByGovDataCount = count($financialaffairs_info['list_noticeby_gov_data']['name']);
                for ($i = 0; $i < $listNoticeByGovDataCount; $i++) {
                    $findata = $financialaffairs_info['list_noticeby_gov_data'];

                    $name24Ques = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number24Ques = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city24Ques = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state24Ques = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip24Ques = Helper::validate_key_loop_value("zip", $findata, $i);

                    $name2_24Ques = Helper::validate_key_loop_value_exclude_comma("gov_name", $findata, $i);
                    $street_number2_24Ques = Helper::validate_key_loop_value_exclude_comma("gov_street_number", $findata, $i);
                    $city2_24Ques = Helper::validate_key_loop_value_exclude_comma("gov_city", $findata, $i);
                    $state2_24Ques = Helper::validate_key_loop_value("gov_state", $findata, $i);
                    $zip2_24Ques = Helper::validate_key_loop_value("gov_zip", $findata, $i);
                    $desc_24Ques = Helper::validate_key_loop_value_exclude_comma("environmental_law", $findata, $i);
                    $value = Helper::validate_key_loop_value("notice_date", $findata, $i);
                    $sfaContent = $sfaContent . "24," . $name24Ques . "," . $street_number24Ques . "," . $city24Ques . "," . $state24Ques . "," . $zip24Ques . "," . $name2_24Ques . "," . $street_number2_24Ques . "," . $city2_24Ques . "," . $state2_24Ques . "," . $zip2_24Ques . "," . $desc_24Ques . "," . $value . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa25Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_environment_law', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_environment_law_data']['name'])) {
                $listEnvironmentLawDataCount = count($financialaffairs_info['list_environment_law_data']['name']);
                for ($i = 0; $i < $listEnvironmentLawDataCount; $i++) {
                    $findata = $financialaffairs_info['list_environment_law_data'];
                    $name25Ques = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number25Ques = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city25Ques = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state25Ques = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip25Ques = Helper::validate_key_loop_value("zip", $findata, $i);
                    $name2_25Ques = Helper::validate_key_loop_value_exclude_comma("gov_name", $findata, $i);
                    $street_number2_25Ques = Helper::validate_key_loop_value_exclude_comma("gov_street_number", $findata, $i);
                    $city2_25Ques = Helper::validate_key_loop_value_exclude_comma("gov_city", $findata, $i);
                    $state2_25Ques = Helper::validate_key_loop_value("gov_state", $findata, $i);
                    $zip2_25Ques = Helper::validate_key_loop_value("gov_zip", $findata, $i);
                    $desc = Helper::validate_key_loop_value_exclude_comma("environment_law_know", $findata, $i);
                    $date = Helper::validate_key_loop_value("notice_date", $findata, $i);
                    $sfaContent = $sfaContent . "25," . $name25Ques . "," . $street_number25Ques . "," . $city25Ques . "," . $state25Ques . "," . $zip25Ques . "," . $name2_25Ques . "," . $street_number2_25Ques . "," . $city2_25Ques . "," . $state2_25Ques . "," . $zip2_25Ques . "," . $desc . "," . $date . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa26Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_judicial_proceedings', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_judicial_proceedings_data']['name'])) {
                $listJudicialProceedingsDataCount = count($financialaffairs_info['list_judicial_proceedings_data']['name']);
                for ($i = 0; $i < $listJudicialProceedingsDataCount; $i++) {
                    $findata = $financialaffairs_info['list_judicial_proceedings_data'];
                    $case_name = Helper::validate_key_loop_value_exclude_comma("case_name", $findata, $i);
                    $case_number = Helper::validate_key_loop_value_exclude_comma("case_number", $findata, $i);
                    $name = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("zip", $findata, $i);
                    $case_nature = Helper::validate_key_loop_value_exclude_comma("case_nature", $findata, $i);
                    $case_status = Helper::validate_key_loop_value("case_status", $findata, $i);
                    $sfaContent = $sfaContent . "26," . $case_name . "," . $case_number . "," . $case_nature . "," . $name . "," . $street_number . "," . $city . "," . $state . "," . $zip . "," . $case_status . ",\r\n";
                }
            }
        }

        return $sfaContent;
    }

    private static function sofa27Ques($financialaffairs_info, $sfaContent)
    {
        if (!empty($financialaffairs_info['list_nature_business_data']['name'])) {
            $listNatureBusinessDataCount = count($financialaffairs_info['list_nature_business_data']['name']);
            for ($i = 0; $i < $listNatureBusinessDataCount; $i++) {
                $findata = $financialaffairs_info['list_nature_business_data'];
                $name = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                $street_number = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                $city = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                $state = Helper::validate_key_loop_value("state", $findata, $i);
                $zip = Helper::validate_key_loop_value("zip", $findata, $i);
                $business_nature = Helper::validate_key_loop_value_exclude_comma("business_nature", $findata, $i);
                $business_accountant = Helper::validate_key_loop_value_exclude_comma("business_accountant", $findata, $i);
                $eiin = Helper::validate_key_loop_value("eiin", $findata, $i);
                $operation_date = Helper::validate_key_loop_value("operation_date", $findata, $i);
                $operation_date2 = Helper::validate_key_loop_value("operation_date2", $findata, $i);
                $dates = $operation_date . "-" . $operation_date2;
                $sfaContent = $sfaContent . "27," . $name . "," . $street_number . "," . $city . "," . $state . "," . $zip . "," . $business_nature . "," . $business_accountant . "," . $eiin . "," . $dates . "\r\n";
            }
        }

        return $sfaContent;
    }

    private static function sofa28Ques($financialaffairs_info, $sfaContent)
    {
        if (Helper::validate_key_value('list_financial_institutions', $financialaffairs_info) == 1) {
            if (!empty($financialaffairs_info['list_financial_institutions_data']['name'])) {
                $listFinancialInstitutionsData = count($financialaffairs_info['list_financial_institutions_data']['name']);
                for ($i = 0; $i < $listFinancialInstitutionsData; $i++) {
                    $findata = $financialaffairs_info['list_financial_institutions_data'];
                    $name = Helper::validate_key_loop_value_exclude_comma("name", $findata, $i);
                    $street_number = Helper::validate_key_loop_value_exclude_comma("street_number", $findata, $i);
                    $city = Helper::validate_key_loop_value_exclude_comma("city", $findata, $i);
                    $state = Helper::validate_key_loop_value("state", $findata, $i);
                    $zip = Helper::validate_key_loop_value("zip", $findata, $i);
                    $date_issued = Helper::validate_key_loop_value("date_issued", $findata, $i);
                    $sfaContent = $sfaContent . "28," . $name . "," . $street_number . "," . $city . "," . $state . "," . $zip . "," . $date_issued . "\r\n";
                }
            }
        }

        return $sfaContent;
    }

    /** Sofa tab questions end here */


    private function getClientIncomeData($baseContent, $income_info, $attProfitLossMonths, $d1Employer, $d2Employer)
    {
        $incomeContent = "";
        $debtormonthlyincome = $income_info['debtormonthlyincome'];
        $debtorspousemonthlyincome = $income_info['debtorspousemonthlyincome'];

        $incomeContent = self::generateBCIIncomeData($debtormonthlyincome, $incomeContent, $attProfitLossMonths, $d1Employer);
        $incomeContent .= "\r\n";

        //spouse Debtor details
        if (!empty($d2Employer)) {
            $incomeContent = self::addCodebtorEmployment($debtorspousemonthlyincome, $incomeContent, $attProfitLossMonths, $d2Employer);
        } else {
            $incomeContent = $incomeContent . "sEmpAddr=||\r\n";
            $incomeContent = $incomeContent . "sPayPeriod=0\r\n";
            $incomeContent = $incomeContent . "sNotEmployed=1\r\n";
        }

        $incomeContent = self::generateBCIIncomeDeductionData($debtormonthlyincome, $incomeContent);

        return str_replace('incomeContent', $incomeContent, $baseContent);
    }

    private static function generateBCIIncomeData($debtormonthlyincome, $incomeContent, $attProfitLossMonths, $d1Employer)
    {
        if (!empty($d1Employer)) {
            $incomeContent = self::generateCurrentEmployerData($incomeContent, $d1Employer);
        }
        $incomeContent = self::getDebtorIncome($debtormonthlyincome, $incomeContent, $attProfitLossMonths);

        return $incomeContent;
    }

    private static function generateCurrentEmployerData($incomeContent, $d1Employer)
    {
        $incomeContent = $incomeContent . "dOccupation=" . Helper::validate_key_value('employer_occupation', $d1Employer) . "\r\n";
        $incomeContent = $incomeContent . "dEmployer=" . Helper::validate_key_value('employer_name', $d1Employer) . "\r\n";
        $incomeContent = $incomeContent . "dEmpAddr=" . Helper::validate_key_value('employer_address', $d1Employer) . "||\r\n";
        $incomeContent = $incomeContent . "dEmpCity=" . Helper::validate_key_value('employer_city', $d1Employer) . "\r\n";
        $incomeContent = $incomeContent . "dEmpState=" . Helper::validate_key_value('employer_state', $d1Employer) . "\r\n";
        $incomeContent = $incomeContent . "dEmpZip=" . self::formatZipCode(Helper::validate_key_value('employer_zip', $d1Employer)) . "\r\n";
        $incomeContent = $incomeContent . "dHowLong=" . Helper::validate_key_value('employment_duration', $d1Employer) . "\r\n";
        $incomeContent = $incomeContent . "dPayPeriod=" . Helper::validate_key_value('employment_duration', $d1Employer) . "\r\n";

        return $incomeContent;
    }

    private static function generateBCIIncomeDeductionData($debtormonthlyincome, $incomeContent)
    {
        if (isset($debtormonthlyincome['other_deduction']) && is_array($debtormonthlyincome['other_deduction'])) {
            $incomeContent .= "\r\n";
            $other_deduction_type_array = Helper::validate_key_value('other_deduction_type', $debtormonthlyincome, 'array');
            $other_deduction_array = Helper::validate_key_value('other_deduction', $debtormonthlyincome, 'array');

            $deductionTypeValue = Helper::getOtherDeductionsArray();
            $i = 1;
            foreach ($other_deduction_array as $key => $value) {
                if ($i > 12) {
                    break;
                }
                $typeKey = Helper::validate_key_value($key, $other_deduction_type_array);

                $incomeContent = $incomeContent . "DeductionDesc" . $i . "=" . Helper::validate_key_value($typeKey, $deductionTypeValue) . "\r\n";
                $incomeContent = $incomeContent . "DeductionAmt" . $i . "=" . Helper::validate_key_value($key, $other_deduction_array, 'float') . "\r\n";

                $i++;
            }
        }

        return $incomeContent;
    }

    private static function addCodebtorEmployment($debtorspousemonthlyincome, $incomeContent, $attProfitLossMonths, $d2Employer)
    {
        $incomeContent = $incomeContent . "sOccupation=" . Helper::validate_key_value('employer_occupation', $d2Employer) . "\r\n";
        $incomeContent = $incomeContent . "sEmployer=" . Helper::validate_key_value('employer_name', $d2Employer) . "\r\n";
        $incomeContent = $incomeContent . "sEmpAddr=" . Helper::validate_key_value('employer_address', $d2Employer) . "||\r\n";
        $incomeContent = $incomeContent . "sEmpCity=" . Helper::validate_key_value('employer_city', $d2Employer) . "\r\n";
        $incomeContent = $incomeContent . "sEmpState=" . Helper::validate_key_value('employer_state', $d2Employer) . "\r\n";
        $incomeContent = $incomeContent . "sEmpZip=" . self::formatZipCode(Helper::validate_key_value('employer_zip', $d2Employer)) . "\r\n";
        $incomeContent = $incomeContent . "sHowLong=" . Helper::validate_key_value('employment_duration', $d2Employer) . "\r\n";
        $incomeContent = $incomeContent . "sPayPeriod=" . Helper::validate_key_value('employment_duration', $d2Employer) . "\r\n";

        if (!empty(Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome))) {
            $dWages = is_array(Helper::validate_key_value('joints_debtor_gross_wages_month', $debtorspousemonthlyincome)) ? array_sum(Helper::validate_key_value('joints_debtor_gross_wages_month', $debtorspousemonthlyincome)) : Helper::validate_key_value('joints_debtor_gross_wages_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sWages=" . $dWages . "\r\n";
            $incomeContent = $incomeContent . "sOvertime=" . Helper::validate_key_value('joints_overtime_per_month', $debtorspousemonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "sTax=" . Helper::validate_key_value('joints_paycheck_for_security', $debtorspousemonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "sInsurance=" . Helper::validate_key_value('joints_automatically_deduction_insurance', $debtorspousemonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "sUnion=" . Helper::validate_key_value('joints_union_dues_deducted', $debtorspousemonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "sRetireMandatory=" . Helper::validate_key_value('joints_paycheck_mandatory_contribution', $debtorspousemonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "sRetireLoan=" . Helper::validate_key_value('joints_paycheck_required_repayment', $debtorspousemonthlyincome) . "\r\n";
            $incomeContent = self::getRetirementIncome($debtorspousemonthlyincome, $incomeContent);
            $incomeContent = $incomeContent . "sRetireVoluntary=" . Helper::validate_key_value('joints_paycheck_voluntary_contribution', $debtorspousemonthlyincome) . "\r\n";
        }

        if (Helper::validate_key_value('joints_operation_business', $debtorspousemonthlyincome, 'radio') == 1) {
            $incomeContent = self::getProfitLossIncome($incomeContent, $debtorspousemonthlyincome, 2, $attProfitLossMonths);
        }

        if (!empty(Helper::validate_key_value('joints_rent_real_property', $debtorspousemonthlyincome))) {
            $dProperty = is_array(Helper::validate_key_value('joints_rent_real_property_month', $debtorspousemonthlyincome))
                ? array_sum(Helper::validate_key_value('joints_rent_real_property_month', $debtorspousemonthlyincome))
                : Helper::validate_key_value('joints_rent_real_property_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sProperty=" . $dProperty . "\r\n";
        }

        $incomeContent = $incomeContent . "sPropertyExpense=0\r\n";

        if (!empty(Helper::validate_key_value('joints_royalties', $debtorspousemonthlyincome))) {
            $dProperty = is_array(Helper::validate_key_value('joints_royalties_month', $debtorspousemonthlyincome))
                ? array_sum(Helper::validate_key_value('joints_royalties_month', $debtorspousemonthlyincome))
                : Helper::validate_key_value('joints_royalties_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sInterest=" . $dProperty . "\r\n";
        }

        if (!empty(Helper::validate_key_value('joints_regular_contributions', $debtorspousemonthlyincome))) {
            $RegConAmt = is_array(Helper::validate_key_value('joints_regular_contributions_month', $debtorspousemonthlyincome))
                ? array_sum(Helper::validate_key_value('joints_regular_contributions_month', $debtorspousemonthlyincome))
                : Helper::validate_key_value('joints_regular_contributions_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sAlimony=" . $RegConAmt . "\r\n";
        }

        if (!empty(Helper::validate_key_value('joints_unemployment_compensation', $debtorspousemonthlyincome))) {
            $unemployment_compensation = is_array(Helper::validate_key_value('joints_unemployment_compensation_month', $debtorspousemonthlyincome))
                ? array_sum(Helper::validate_key_value('joints_unemployment_compensation_month', $debtorspousemonthlyincome))
                : Helper::validate_key_value('joints_unemployment_compensation_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sUnemployment=" . $unemployment_compensation . "\r\n";
        }

        if (!empty(Helper::validate_key_value('joints_social_security', $debtorspousemonthlyincome))) {
            $social_security = is_array(Helper::validate_key_value('joints_social_security_month', $debtorspousemonthlyincome))
                ? array_sum(Helper::validate_key_value('joints_social_security_month', $debtorspousemonthlyincome))
                : Helper::validate_key_value('joints_social_security_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sSocSecurity=" . $social_security . "\r\n";
        }

        if (!empty(Helper::validate_key_value('government_assistance', $debtorspousemonthlyincome))) {
            $specify = Helper::validate_key_value('government_assistance_specify', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "GovAssistDesc2=" . $specify . "\r\n";

            $RegConAmt = is_array(Helper::validate_key_value('government_assistance_month', $debtorspousemonthlyincome))
                ? array_sum(Helper::validate_key_value('government_assistance_month', $debtorspousemonthlyincome))
                : Helper::validate_key_value('government_assistance_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "GovAssistAmtD2=" . $RegConAmt . "\r\n";
        }

        return $incomeContent;
    }

    private static function getRetirementIncome($debtorspousemonthlyincome, $incomeContent)
    {
        if (!empty(Helper::validate_key_value('joints_retirement_income', $debtorspousemonthlyincome))) {
            $retirement_income = is_array(Helper::validate_key_value('joints_retirement_income_month', $debtorspousemonthlyincome)) ? array_sum(Helper::validate_key_value('joints_retirement_income_month', $debtorspousemonthlyincome)) : Helper::validate_key_value('joints_retirement_income_month', $debtorspousemonthlyincome);
            $incomeContent = $incomeContent . "sPension=" . $retirement_income . "\r\n";
        }

        return $incomeContent;
    }

    private static function getDebtorIncome($debtormonthlyincome, $incomeContent, $attProfitLossMonths)
    {
        if (!empty(Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome))) {
            $dWages = is_array(Helper::validate_key_value('debtor_gross_wages_month', $debtormonthlyincome)) ? array_sum(Helper::validate_key_value('debtor_gross_wages_month', $debtormonthlyincome)) : Helper::validate_key_value('debtor_gross_wages_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dWages=" . $dWages . "\r\n";
            $incomeContent = $incomeContent . "dOvertime=" . Helper::validate_key_value('overtime_per_month', $debtormonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "dTax=" . Helper::validate_key_value('paycheck_for_security', $debtormonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "dInsurance=" . Helper::validate_key_value('automatically_deduction_insurance', $debtormonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "dUnion=" . Helper::validate_key_value('union_dues_deducted', $debtormonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "dRetireMandatory=" . Helper::validate_key_value('paycheck_mandatory_contribution', $debtormonthlyincome) . "\r\n";
            $incomeContent = $incomeContent . "dRetireLoan=" . Helper::validate_key_value('paycheck_required_repayment', $debtormonthlyincome) . "\r\n";
        }

        if (!empty(Helper::validate_key_value('retirement_income', $debtormonthlyincome))) {
            $retirement_income = is_array(Helper::validate_key_value('retirement_income_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('retirement_income_month', $debtormonthlyincome))
                : Helper::validate_key_value('retirement_income_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dPension=" . $retirement_income . "\r\n";
        }
        if (!empty(Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome))) {
            $incomeContent = $incomeContent . "dRetireVoluntary=" . Helper::validate_key_value('paycheck_voluntary_contribution', $debtormonthlyincome) . "\r\n";
        }

        if (Helper::validate_key_value('operation_business', $debtormonthlyincome, 'radio') == 1) {
            $incomeContent = self::getProfitLossIncome($incomeContent, $debtormonthlyincome, 1, $attProfitLossMonths);
        }

        if (!empty(Helper::validate_key_value('rent_real_property', $debtormonthlyincome))) {
            $dProperty = is_array(Helper::validate_key_value('rent_real_property_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('rent_real_property_month', $debtormonthlyincome))
                : Helper::validate_key_value('rent_real_property_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dProperty=" . $dProperty . "\r\n";
        }

        $incomeContent = $incomeContent . "dPropertyExpense=0\r\n";

        if (!empty(Helper::validate_key_value('royalties', $debtormonthlyincome))) {
            $dProperty = is_array(Helper::validate_key_value('royalties_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('royalties_month', $debtormonthlyincome))
                : Helper::validate_key_value('royalties_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dInterest=" . $dProperty . "\r\n";
        }

        if (!empty(Helper::validate_key_value('regular_contributions', $debtormonthlyincome))) {
            $RegConAmt = is_array(Helper::validate_key_value('regular_contributions_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('regular_contributions_month', $debtormonthlyincome))
                : Helper::validate_key_value('regular_contributions_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dAlimony=" . $RegConAmt . "\r\n";
        }

        if (!empty(Helper::validate_key_value('unemployment_compensation', $debtormonthlyincome))) {
            $unemployment_compensation = is_array(Helper::validate_key_value('unemployment_compensation_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('unemployment_compensation_month', $debtormonthlyincome))
                : Helper::validate_key_value('unemployment_compensation_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dUnemployment=" . $unemployment_compensation . "\r\n";
        }

        if (!empty(Helper::validate_key_value('social_security', $debtormonthlyincome))) {
            $social_security = is_array(Helper::validate_key_value('social_security_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('social_security_month', $debtormonthlyincome))
                : Helper::validate_key_value('social_security_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "dSocSecurity=" . $social_security . "\r\n";
        }

        if (!empty(Helper::validate_key_value('government_assistance', $debtormonthlyincome))) {
            $specify = Helper::validate_key_value('government_assistance_specify', $debtormonthlyincome);
            $incomeContent = $incomeContent . "GovAssistDesc1=" . $specify . "\r\n";

            $RegConAmt = is_array(Helper::validate_key_value('government_assistance_month', $debtormonthlyincome))
                ? array_sum(Helper::validate_key_value('government_assistance_month', $debtormonthlyincome))
                : Helper::validate_key_value('government_assistance_month', $debtormonthlyincome);
            $incomeContent = $incomeContent . "GovAssistAmtD1=" . $RegConAmt . "\r\n";
        }

        // $incomeContent = $incomeContent . "ExpChangeYES=0\r\n";
        // $incomeContent = $incomeContent . "ExpChange=". Helper::validate_key_value('employer_name', $incomedebtoremployer) ." Change: |\r\n";
        // $incomeContent = self::getDebtorDeduction($debtormonthlyincome,$incomeContent);
        return $incomeContent;
    }

    private static function getProfitLossIncome($incomeContent, $income, $debtorType, $attProfitLossMonths)
    {
        $plArray = self::generateProfitLossArray($income);
        $months = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);

        $averagePL = 0.00;
        $averageExpense = 0.00;

        foreach ($plArray as $companyData) {
            $totalProfitLoss = 0.00;
            $totalExpense = 0.00;
            foreach ($companyData as $monthData) {
                if (isset($monthData['profit_loss_month']) && array_key_exists($monthData['profit_loss_month'], $months)) {
                    $totalProfitLoss += isset($monthData['total_profit_loss']) ? floatval($monthData['total_profit_loss']) : 0;
                    $totalExpense += isset($monthData['total_expense']) ? floatval($monthData['total_expense']) : 0;
                }
            }
            $averagePL += ($totalProfitLoss / 6);
            $averageExpense += ($totalExpense / 6);
        }

        $businessKey = '';
        $bizExpenseKey = '';

        if ($debtorType == 1) {
            $businessKey = 'dBusiness';
            $bizExpenseKey = 'dBizExpense';
        }
        if ($debtorType == 2) {
            $businessKey = 'sBusiness';
            $bizExpenseKey = 'sBizExpense';
        }

        $incomeContent = $incomeContent . $businessKey . "=" . $averagePL . "\r\n"; //avg_total_profit_loss
        $incomeContent = $incomeContent . $bizExpenseKey . "=" . $averageExpense . "\r\n"; //avg_total_expense

        return $incomeContent;
    }

    private static function generateProfitLossArray($income)
    {
        $profitLossArray = [];
        $company1Data = !empty(Helper::validate_key_value('income_profit_loss', $income)) ? Helper::validate_key_value('income_profit_loss', $income) : [];
        $company2Data = !empty(Helper::validate_key_value('income_profit_loss_2', $income)) ? Helper::validate_key_value('income_profit_loss_2', $income) : [];
        $company3Data = !empty(Helper::validate_key_value('income_profit_loss_3', $income)) ? Helper::validate_key_value('income_profit_loss_3', $income) : [];
        $company4Data = !empty(Helper::validate_key_value('income_profit_loss_4', $income)) ? Helper::validate_key_value('income_profit_loss_4', $income) : [];

        $c1Data = self::generateProfitLossDataObject($company1Data);
        if (!empty($c1Data)) {
            array_push($profitLossArray, $c1Data);
        }
        $c2Data = self::generateProfitLossDataObject($company2Data);
        if (!empty($c2Data)) {
            array_push($profitLossArray, $c2Data);
        }
        $c3Data = self::generateProfitLossDataObject($company3Data);
        if (!empty($c3Data)) {
            array_push($profitLossArray, $c3Data);
        }
        $c4Data = self::generateProfitLossDataObject($company4Data);
        if (!empty($c4Data)) {
            array_push($profitLossArray, $c4Data);
        }

        return $profitLossArray;
    }

    private static function generateProfitLossDataObject($companyData)
    {
        $data = [];
        if (!empty($companyData)) {
            if (isset($companyData['profit_loss_type']) && ($companyData['profit_loss_type'] == 1)) {
                $data[] = $companyData;
            } else {
                $data = $companyData;
            }
        }

        return $data;
    }

    private static function getDebtorDeduction($debtormonthlyincome, $incomeContent)
    {
        if (!empty(Helper::validate_key_value('otherDeductions11', $debtormonthlyincome))) {
            $incomeContent = $incomeContent . "DeductionDesc1=legal\r\n";
            $deduction = '';
            if (isset($debtormonthlyincome['other_deduction']) && !is_array($debtormonthlyincome['other_deduction'])) {
                $deduction = number_format((float) $debtormonthlyincome['other_deduction'], 2, '.', '');
            }
            if (isset($debtormonthlyincome['other_deduction']) && is_array($debtormonthlyincome['other_deduction'])) {
                $deduction = number_format((float) array_sum($debtormonthlyincome['other_deduction']), 2, '.', '');
                ;
            }
            $incomeContent = $incomeContent . "DeductionAmtD1=" . $deduction . "\r\n";
        }

        return $incomeContent;
    }


    private function getClientEmployersData($baseContent, $employers)
    {
        $content = "";

        if (!empty($employers)) {
            foreach ($employers as $index => $employer) {
                $content = $this->getEmployerContent($content, $employer);
            }
        }

        return str_replace('employersContent', $content, $baseContent);
    }

    private function getEmployerContent($content, $data)
    {
        $client_type = Helper::validate_key_value('client_type', $data, 'radio');
        // name
        $content = $content . $client_type . ',"' . Helper::validate_key_value('employer_name', $data) . '",';
        // address
        $content = $content . '"' . Helper::validate_key_value('employer_address', $data) . '"' . "|,";
        // city
        $content = $content . Helper::validate_key_value('employer_city', $data) . ",";
        // state
        $content = $content . Helper::validate_key_value('employer_state', $data) . ",";
        // zipcode
        $content = $content . self::formatZipCode(Helper::validate_key_value('employer_zip', $data)) . ",";
        // occupation
        $content = $content . Helper::validate_key_value('employer_occupation', $data) . ",";
        // job duration
        $content = $content . Helper::validate_key_value('employment_duration', $data) . ",1,\r\n";

        return $content;
    }

    private static function getDebtorUtilityBills($expenses_info, $expenseContent)
    {
        if (!empty($utilities = Helper::validate_key_value('utilities', $expenses_info))) {
            $expenseContent = $expenseContent . "Electricity=" . Helper::validate_key_value('electricity_heating_price', $utilities, "float") . "\r\n";
            $expenseContent = $expenseContent . "Water=" . Helper::validate_key_value('water_sewerl_price', $utilities, "float") . "\r\n";
            $expenseContent = $expenseContent . "Telephone=" . Helper::validate_key_value('telephone_service_price', $utilities, "float") . "\r\n";
        }
        if (!empty(Helper::validate_key_value('utility_bills', $expenses_info))) {
            $expenseContent = $expenseContent . "UtilityDsc1=" . Helper::validate_key_value('monthly_utilities_bills', $expenses_info) . "\r\n";
            $totalutlity = (is_array(Helper::validate_key_value('monthly_utilities_value', $expenses_info))) ? array_sum(Helper::validate_key_value('monthly_utilities_value', $expenses_info)) : 0;
            $expenseContent = $expenseContent . "UtilityAmt1=" . $totalutlity . ".00\r\n";
        }

        return $expenseContent;
    }

    private static function getDebtorOtherInsurance($expenses_info, $expenseContent)
    {
        if (!empty(Helper::validate_key_value('otherInsurance_notListed', $expenses_info))) {
            $expenseContent = $expenseContent . "InsuranceDsc1=" . Helper::validate_key_value('other_insurance_value', $expenses_info) . "\r\n";
            $expenseContent = $expenseContent . "InsuranceAmt1=" . Helper::validate_key_value('other_insurance_price', $expenses_info, "float") . "\r\n";
        } else {
            $expenseContent = $expenseContent . "InsuranceDsc1=\r\n";
            $expenseContent = $expenseContent . "InsuranceAmt1=\r\n";
        }

        return $expenseContent;
    }

    private function getClientExpenseData($baseContent, $expenses_info)
    {
        $expenseContent = "";
        $expenseContent = $expenseContent . "Rent=" . Helper::validate_key_value('rent_home_mortage', $expenses_info, "float") . "\r\n";
        $expenseContent = (empty(Helper::validate_key_value('real_estate_taxes', $expenses_info))) ? ($expenseContent . "RealEstTax=" . Helper::validate_key_value('estate_taxes_pay', $expenses_info, "float") . "\r\n") : $expenseContent . "RealEstTax=\r\n";
        $expenseContent = (!empty(Helper::validate_key_value('amount_include_property', $expenses_info))) ? ($expenseContent . "InsuranceHome=" . Helper::validate_key_value('amount_include_property_pay', $expenses_info, "float") . "\r\n") : $expenseContent . "InsuranceHome=\r\n";
        $expenseContent = (empty(Helper::validate_key_value('amount_include_property', $expenses_info))) ? ($expenseContent . "InsuranceInc=" . Helper::validate_key_value('amount_include_property_pay', $expenses_info, "float") . "\r\n") : $expenseContent . "InsuranceInc=\r\n";
        $expenseContent = (empty(Helper::validate_key_value('amount_include_home', $expenses_info))) ? ($expenseContent . "HomeMaintenance=" . Helper::validate_key_value('amount_include_home_pay', $expenses_info, "float") . "\r\n") : $expenseContent . "HomeMaintenance=\r\n";
        $expenseContent = (!empty(Helper::validate_key_value('amount_include_homeowner', $expenses_info))) ? ($expenseContent . "HOAdues=" . Helper::validate_key_value('amount_include_homeowner_pay', $expenses_info, "float") . "\r\n") : $expenseContent . "HOAdues=\r\n";
        $expenseContent = (!empty(Helper::validate_key_value('mortgage_payments', $expenses_info))) ? ($expenseContent . "HomeEquityLoan=" . Helper::validate_key_value('mortgage_payments_pay', $expenses_info, "float") . "\r\n") : $expenseContent . "HomeEquityLoan=\r\n";
        $expenseContent = self::getDebtorUtilityBills($expenses_info, $expenseContent);
        $expenseContent = $expenseContent . "Food=" . Helper::validate_key_value('food_housekeeping_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "Childcare=" . Helper::validate_key_value('childcare_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "Clothing=" . Helper::validate_key_value('laundry_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "PersonalCare=" . Helper::validate_key_value('personal_care_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "Medical=" . Helper::validate_key_value('medical_dental_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "Transportation=" . Helper::validate_key_value('transportation_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "Recreation=" . Helper::validate_key_value('entertainment_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "Charity=" . Helper::validate_key_value('charitablet_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "InsuranceLife=" . Helper::validate_key_value('life_insurance_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "InsuranceHealth=" . Helper::validate_key_value('health_insurance_price', $expenses_info, "float") . "\r\n";
        $expenseContent = $expenseContent . "InsuranceAuto=" . Helper::validate_key_value('auto_insurance_price', $expenses_info, "float") . "\r\n";
        $expenseContent = self::getDebtorOtherInsurance($expenses_info, $expenseContent);
        $expenseContent = $expenseContent . "TaxDsc1=Tax #1\r\n";
        $expenseContent = $expenseContent . "TaxAmt1=" . Helper::validate_key_value('taxbills_price', $expenses_info, "float") . "\r\n";
        $expenseContent = self::getInstallmentPayExpense($expenses_info, $expenseContent);
        $expenseContent = $this->getAlimoneyExpense($expenses_info, $expenseContent);
        $expenseContent = $this->getOtherDscExpense($expenses_info, $expenseContent);
        $expenseContent = self::getMortageAndDependentExpense($expenses_info, $expenseContent);
        $expenseContent = $expenseContent . "ExpChangeYES=" . Helper::validate_key_value('increase_decrease_expenses_option', $expenses_info) . "\r\n";
        $expenseContent = $expenseContent . "ExpChange=" . Helper::validate_key_value('increase_decrease_expenses', $expenses_info) . "\r\n";

        return str_replace('expenseContent', $expenseContent, $baseContent);
    }

    private function getAlimoneyExpense($expenses_info, $expenseContent)
    {
        if (Helper::validate_key_value('alimony_maintenance', $expenses_info) == 1) {
            $expenseContent = $expenseContent . "Alimony=" . Helper::validate_key_value('alimony_price', $expenses_info, "float") . "\r\n";
        } else {
            $expenseContent = $expenseContent . "Alimony=\r\n";
        }

        return $expenseContent;
    }

    private function getOtherDscExpense($expenses_info, $expenseContent)
    {
        if (Helper::validate_key_value('other_expense_available', $expenses_info) == 1) {
            $expenseContent = $expenseContent . "OtherDsc1=" . Helper::validate_key_value('other_expense_specify', $expenses_info) . "\r\n";
            $expenseContent = $expenseContent . "OtherAmt1=" . Helper::validate_key_value('other_expense_price', $expenses_info, "float") . "\r\n";
        }

        return $expenseContent;
    }

    private static function getMortageAndDependentExpense($expenses_info, $expenseContent)
    {
        if (!empty(Helper::validate_key_value('paymentforsupport_dependents_n', $expenses_info))) {
            $expenseContent = $expenseContent . "SupportDsc1=" . Helper::validate_key_value('payments_dependents_value', $expenses_info) . "\r\n";
            $expenseContent = $expenseContent . "SupportAmt1=" . Helper::validate_key_value('payments_dependents_price', $expenses_info, "float") . "\r\n";
        } else {
            $expenseContent = $expenseContent . "SupportDsc1=\r\n";
            $expenseContent = $expenseContent . "SupportAmt1=\r\n";
        }

        if (!empty(Helper::validate_key_value('mortgage_property1', $expenses_info))) {
            $mortgage_property = (!empty($expenses_info['mortgage_property'])) ? $expenses_info['mortgage_property'] : [];
            $expenseContent = $expenseContent . "OtherRealMortgage=" . Helper::validate_key_value('other_real_estate_price', $mortgage_property, "float") . "\r\n";
            $expenseContent = $expenseContent . "OtherRealEstTax=" . Helper::validate_key_value('tax', $mortgage_property, "float") . "\r\n";
            $expenseContent = $expenseContent . "OtherRealInsurance=" . Helper::validate_key_value('rental_insurance_price', $mortgage_property, "float") . "\r\n";
            $expenseContent = $expenseContent . "OtherRealUpkeep=" . Helper::validate_key_value('home_maintenance_price', $mortgage_property, "float") . "\r\n";
            $expenseContent = $expenseContent . "OtherRealHOA=" . Helper::validate_key_value('condominium_price', $mortgage_property, "float") . "\r\n";
        } else {
            $expenseContent = $expenseContent . "OtherRealMortgage=\r\n";
            $expenseContent = $expenseContent . "OtherRealEstTax=\r\n";
            $expenseContent = $expenseContent . "OtherRealInsurance=\r\n";
            $expenseContent = $expenseContent . "OtherRealUpkeep=\r\n";
            $expenseContent = $expenseContent . "OtherRealHOA=\r\n";
        }

        return $expenseContent;
    }

    private function getInstallmentPayExpense($expenses_info, $expenseContent)
    {
        $installmentpayments_type = Helper::validate_key_value('installmentpayments_type', $expenses_info);
        if (!empty($installmentpayments_type)) {
            $installmentpayments_price = Helper::validate_key_value('installmentpayments_price', $expenses_info);
            $installmentpayments_value = Helper::validate_key_value('installmentpayments_value', $expenses_info);
            $i = 1;
            foreach ($installmentpayments_type as $key => $value) {
                $installAutoKey = AddressHelper::checkAutoKeys($value);
                $price = Helper::validate_key_value($key, $installmentpayments_price);
                if ($value != 7) {
                    $expenseContent = $expenseContent . "InstallmentAuto" . $installAutoKey . "=" . number_format((float) $price, 2, '.', '') . "\r\n";
                } else {
                    $othervalue = Helper::validate_key_value($key, $installmentpayments_value);
                    $expenseContent = $expenseContent . "InstallmentDsc" . $i . "=" . $othervalue . "\r\n";
                    $expenseContent = $expenseContent . "InstallmentAmt" . $i . "=" . number_format((float) $price, 2, '.', '') . "\r\n";
                    $i++;
                }
            }
        }

        return $expenseContent;
    }


    private function getClientMtincData($baseContent, $client_id, $income_info)
    {
        $mtincContent = "";
        $mtincContent = self::getDebtorPaystubData($client_id, $mtincContent, $income_info);

        return str_replace('mtincContent', $mtincContent, $baseContent);
    }

    private function createNewBaseFile($fileName)
    {
        $baseFileName = 'bci-files/report-base-file.bci';
        copy(public_path($baseFileName), public_path($fileName));

        $opts = [
            'http' =>
                [
                    'method' => 'POST',
                    'header' => "Content-type: application/x-wine-extension-ini\r\n",
                    'timeout' => 60
                ]
        ];
        $contextForGet = stream_context_create($opts);

        return file_get_contents(public_path($fileName), true, $contextForGet);
    }

    private static function formatZipCode($zip)
    {
        $parts = explode('-', $zip);

        return $parts[0] . '-0000';
    }

}
