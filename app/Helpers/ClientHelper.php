<?php

namespace App\Helpers;

use App\Models\AttorneyDocuments;
use App\Models\FormsStepsCompleted;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use App\Traits\Common; // Trait
use App\Models\AttorneyExcludeDocs;
use App\Models\AttorneySettings;
use App\Models\ClientDocuments;
use App\Models\ClientDocumentUploaded;
use App\Models\ClientsAssociate;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheExpense;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheSOFA;

class ClientHelper
{
    use Common;
    public static function documentUploadInfo($client = '', $clId = '', $atId = '', $clientdocscreen = false, $fromApi = false)
    {
        $client = !empty($client) ? $client : Auth::user();
        $client_id = !empty($clId) ? $clId : $client->id;
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = self::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = self::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($client->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $client_attorney_id = !empty($atId) ? $atId : (isset($client->ClientsAttorneybyclient) && $client->ClientsAttorneybyclient->exists() ? $client->ClientsAttorneybyclient->attorney_id : 0);
        $attIdToReturn = $client_attorney_id;
        $queryCondition = [ 'attorney_id' => $client_attorney_id, 'is_associate' => 0 ];

        if (!empty($ClientsAssociateId)) {
            $client_attorney_id = $ClientsAssociateId;
            $queryCondition = [ 'attorney_id' => $client_attorney_id, 'is_associate' => 1 ];
        }

        $attorneySettings = AttorneySettings::where($queryCondition)->select(['attorney_enabled_bank_statment','is_car_title_enabled','is_rental_agreement_enabled'])->first();

        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings, 'radio') : 0;
        $isBankStatementEnabled = ($attorney_enabled_bank_statment == 1) ? true : false;

        $documentuploaded_list = ClientDocumentUploaded::where('client_id', $client_id)->orderBy('id', 'DESC')->get()->toArray();
        $documentuploaded = array_column($documentuploaded_list, 'document_type');
        $fdata = FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit')->get()->toArray();
        $hidebtn = !empty($fdata) && $fdata[0]['step6'] == 1 && $fdata[0]['can_edit'] == 2 ? 1 : 0;

        $attorneydocuments = AttorneyDocuments::where($queryCondition)->pluck('document_name', 'document_type')->all();
        $attorneydocuments = self::getUpdatedLabelName($debtorname, $spousename, $attorneydocuments);

        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $client_id)->pluck('document_name', 'document_type')->all();
        $adminDocuments = self::getUpdatedLabelName($debtorname, $spousename, $adminDocuments);
        $requestedDocuments = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->select('requested_documents')->first();

        $requestedDocuments = Helper::validate_key_value('requested_documents', $requestedDocuments);
        $requestedDocuments = !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];
        $requestedDocuments = is_array($requestedDocuments) ? $requestedDocuments : [];
        $requestedDocuments = self::getUpdatedLabelName($debtorname, $spousename, $requestedDocuments);
        $documentTypes = Helper::getDocuments($client->client_type, false, 1, 1, 0, 0, $client_attorney_id);
        $isPostSubmissionEnabled = \App\Models\ClientSettings::isPostSubmissionEnabled($client_id);
        if ($isPostSubmissionEnabled) {
            $documentTypes = [ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"] + $documentTypes;
        }
        $documentTypes = $documentTypes + Helper::getMiscDocs();
        if ($clientdocscreen == false) {
            $documentTypes = self::checkAndSetDefaultTypes($documentTypes, $documentuploaded, 0);
            $documentTypes = self::getDefaultAutoLoans($documentTypes, $documentuploaded, 0);
        }
        if ($documentTypes) {
            unset($documentTypes['Current_Auto_Loan_Statement']);
            unset($documentTypes['Current_Mortgage_Statement']);
        }

        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;

        $vehicle_title = $is_car_title_enabled ? \App\Models\ClientDocuments::getClientDocumentList($client_id, 'vehicle_title') : 0;
        $rental_agreement = $is_rental_agreement_enabled ? \App\Models\ClientDocuments::getClientDocumentList($client_id, 'rental_agreement') : 0;
        if (!empty($vehicle_title)) {
            $attorneydocuments = array_merge($attorneydocuments, $vehicle_title);
        }
        if (!empty($rental_agreement)) {
            $attorneydocuments = array_merge($attorneydocuments, $rental_agreement);
        }

        $documentTypes = self::getUpdatedLabelName($debtorname, $spousename, $documentTypes);
        $clientDocs = [];
        $venmoPaypalCash = [];
        $brokerageAccount = [];
        if ($isBankStatementEnabled) {
            $clientDocs = self::getClientDocument($client_id, 'bank', $fromApi);
            $clientDocs = self::getUpdatedLabelName($debtorname, $spousename, $clientDocs);
            $venmoPaypalCash = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'venmo_paypal_cash');
            $venmoPaypalCash = Helper::getUpdatedPayPalName($venmoPaypalCash);
            $venmoPaypalCash = self::getUpdatedLabelName($debtorname, $spousename, $venmoPaypalCash);
            $brokerageAccount = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'brokerage_account');
            $brokerageAccount = self::getUpdatedLabelName($debtorname, $spousename, $brokerageAccount);
        }
        $unpaid_wages = \App\Models\ClientDocuments::getClientDocumentList($client_id, 'unpaid_wages');
        $unpaid_wages = self::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages);

        $lifeInsuDocs = self::getClientLifeInsuranceDocument($client_id);
        if (!empty($lifeInsuDocs)) {
            $requestedDocuments = array_merge($requestedDocuments, $lifeInsuDocs);
        }

        $retirement_pension = self::getClientRetirementPensionDocument($client_id);
        if (!empty($retirement_pension)) {
            $requestedDocuments = array_merge($requestedDocuments, $retirement_pension);
        }

        $notOwnedDocs = self::getNotOwnedDocumentArray($client, $client_id);

        $attorneyCommonDocuments = ClientDocuments::getClientDocs($client_id, 'attorney_common_doc');
        $attorneydocuments = array_merge($attorneydocuments, $attorneyCommonDocuments);

        $vehicleRegisterationDocs = self::getVehicleRegisterationDocs($client_id);

        $excludeDocs = AttorneyExcludeDocs::where($queryCondition)->first();
        $excludeDocs = !empty($excludeDocs) ? $excludeDocs->toArray() : [];

        $AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where(['attorney_id' => $client_attorney_id, 'client_id' => $client_id])->first();
        $AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient) ? $AttorneyExcludeDocsPerClient->toArray() : [];
        $docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
        $docJsonPerClient = json_decode($docJsonPerClient) ?? [];
        $mergedArray = array_merge($excludeDocs, $docJsonPerClient);
        $excludeDocs = array_unique($mergedArray);
        $excludedDocTypes = [];
        if (isset($excludeDocs) && !empty($excludeDocs)) {
            $excludedDocTypes = Helper::validate_key_value('doc_type_json', $excludeDocs);
            $excludedDocTypes = json_decode($excludedDocTypes, true) ?: [];
        }
        if (is_array($excludedDocTypes)) {
            if (in_array('Other_Misc_Documents', $excludedDocTypes)) {
                unset($documentTypes['Other_Misc_Documents']);
            }

            if (in_array('Current_Mortgage_Statement', $excludedDocTypes)) {
                foreach ($documentTypes as $key => $value) {
                    if (str_starts_with($key, 'Current_Mortgage_Statement')) {
                        unset($documentTypes[$key]);
                    }
                }
            }
            if (in_array('Current_Auto_Loan_Statement', $excludedDocTypes)) {
                foreach ($documentTypes as $key => $value) {
                    if (str_starts_with($key, 'Current_Auto_Loan_Statement') || str_starts_with($key, 'Other_Loan_Statement')) {
                        unset($documentTypes[$key]);
                    }
                }
            }
        }

        if (!in_array('Vehicle_Registration', $excludedDocTypes)) {
            $attorneydocuments = array_merge($attorneydocuments, $vehicleRegisterationDocs);
        }
        if (!in_array('Insurance_Documents', $excludedDocTypes)) {
            $attorneydocuments = array_merge($attorneydocuments, ['Insurance_Documents' => 'Proof of Auto Insurance']);
            unset($documentTypes['Insurance_Documents']);
        }


        if (env('ENABLED_CLIENT_SIDE_CREDIT_REPORT', false) == true) {
            $creditReportEnabled = \App\Models\User::isCreditReportEnabledByClientId($client_id);
            if (isset($documentTypes['Debtor_Creditor_Report']) && (!$creditReportEnabled['debtor'])) {
                unset($documentTypes['Debtor_Creditor_Report']);
            }
            if (isset($documentTypes['Co_Debtor_Creditor_Report']) && (!$creditReportEnabled['codebtor'])) {
                unset($documentTypes['Co_Debtor_Creditor_Report']);
            }
        }

        $docsUploadInfo = ['notOwnedDocs' => $notOwnedDocs, 'retirement_pension' => $retirement_pension, 'lifeInsuDocs' => $lifeInsuDocs,'venmoPaypalCash' => $venmoPaypalCash, 'unpaidWages' => $unpaid_wages, 'brokerageAccount' => $brokerageAccount,'documentTypes' => $documentTypes, 'clientDocs' => $clientDocs, 'attorneydocuments' => $attorneydocuments,  'adminDocuments' => $adminDocuments, 'requestedDocuments' => $requestedDocuments, 'documentuploaded' => $documentuploaded, 'list' => $documentuploaded_list, 'attorney_id' => $attIdToReturn, 'hidebtn' => $hidebtn, 'client' => $client];

        return $docsUploadInfo;
    }

    public static function getVehicleRegisterationDocs($client_id)
    {
        $vehicles = DocumentHelper::CODEBTOR_VEHICLEARRAY;
        $vehicles = array_merge($vehicles, DocumentHelper::OTHERLOANARRAY);

        $vehicleUpdatedNames = [];

        $clientPropertyData = CacheProperty::getPropertyData($client_id);
        $propertyvehicle = Helper::validate_key_value('propertyvehicle', $clientPropertyData, 'array');

        // Vehicle
        $vehicleUpdatedNames = self::getVehicleUpdatedNamesData($propertyvehicle, 1, 'Current_Auto_Loan_Statement_', $vehicleUpdatedNames);

        //Recreational
        $vehicleUpdatedNames = self::getVehicleUpdatedNamesData($propertyvehicle, 6, 'Other_Loan_Statement_', $vehicleUpdatedNames);

        return $vehicleUpdatedNames;
    }

    private static function getVehicleUpdatedNamesData($proprty, $vehType, $docType, $vehicleUpdatedNames = [])
    {
        $vehicles = DocumentHelper::CODEBTOR_VEHICLEARRAY;
        $vehicles = array_merge($vehicles, DocumentHelper::OTHERLOANARRAY);
        $i = 1;
        $totalVehicleRecord = !empty($proprty) ? $proprty->where('property_type', $vehType) : [];
        foreach ($totalVehicleRecord as $item) {
            $vehicleName = "Registration For: "
                . Helper::validate_key_value('property_year', $item) . " "
                . Helper::validate_key_value('property_make', $item) . " "
                . Helper::validate_key_value('property_model', $item);
            foreach ($vehicles as $document) {
                if ($document == $docType . $i) {
                    $regKey = Helper::validate_doc_type('Vehicle_Registration_'.Helper::validate_key_value('id', $item, 'radio'));
                    $vehicleUpdatedNames[$regKey] = $vehicleName;
                }
            }
            $i++;
        }

        return $vehicleUpdatedNames;
    }

    private static function getNotOwnedDocumentArray($client, $client_id)
    {

        $incomeData = CacheIncome::getIncomeData($client_id);
        $D1Data = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        $D2Data = Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');

        $hasEmployerD1 = self::getEmployerAddedStatus($D1Data);
        $hasEmployerD2 = self::getEmployerAddedStatus($D2Data);

        $notOwnedDocs = \App\Models\NotOwnDocuments::where([ "client_id" => $client_id])->pluck('document_type')->all();

        if (!$hasEmployerD1) {
            $notOwnedDocs[] = 'Debtor_Pay_Stubs';
        }
        if (!$hasEmployerD2) {
            $notOwnedDocs[] = 'Co_Debtor_Pay_Stubs';
        }

        return $notOwnedDocs;
    }
    private static function getEmployerAddedStatus($data)
    {

        $currentEmployerStatus = Helper::validate_key_value('current_employed', $data, 'radio'); //1
        $primaryEmployerStatus = Helper::validate_key_value('recieved_any_income', $data, 'radio'); //1

        $hasEmployer = false;
        if ($currentEmployerStatus == 1 || $primaryEmployerStatus == 1) {
            $hasEmployer = true;
        }

        return $hasEmployer;
    }

    private static function getClientDocument($id, $type = null)
    {
        return ClientDocuments::getClientDocumentList($id, $type);
    }
    private static function getClientLifeInsuranceDocument($id)
    {
        return ClientDocuments::getClientDocumentList($id, 'life_insurance');
    }
    private static function getClientRetirementPensionDocument($id)
    {
        return ClientDocuments::getClientDocumentList($id, 'retirement_pension');
    }




    public static function getUpdatedLabelName($debtorname, $spousename, $arrayObject, $forApi = false)
    {
        if (empty($arrayObject)) {
            return [];
        }

        if (!$forApi) {
            $debtorname = "<span class='text-dark f-w-600'>&nbsp;".$debtorname."&nbsp;</span>";
            $spousename = "<span class='text-dark f-w-600'>&nbsp;".$spousename."&nbsp;</span>";
        }

        $searchSimple = ['%debtor%', '%codebtor%'];
        $replaceSimple = [$debtorname, $spousename];

        $searchRegex = ['/\\bCo-Debtor’s\\b/', '/\\bCo-Debtor\\b/', '/\\bDebtor’s\\b/', '/\\bDebtor\\b/'];
        $replaceRegex = [$spousename, $spousename, $debtorname, $debtorname];

        $data = [];
        $doNotConsider = ['Income_Docs_For_Debtor', 'Debtor_Taxes'];
        foreach ($arrayObject as $key => $name) {
            $updatedName = $name;
            if (!in_array($key, $doNotConsider)) {
                $updatedName = str_replace($searchSimple, $replaceSimple, $updatedName);
                $updatedName = preg_replace($searchRegex, $replaceRegex, $updatedName);
            }
            if ($forApi) {
                $updatedName = strip_tags($updatedName);
            }
            $data[$key] = $updatedName;
        }

        return $data;

    }

    public static function getUpdatedLabelNameForJubliee($debtorname, $spousename, $key, $name)
    {
        if (empty($key)) {
            return '';
        }
        $searchSimple = ['%debtor%', '%codebtor%'];
        $replaceSimple = [$debtorname, $spousename];
        $searchRegex = ['/\\bCo-Debtor’s\\b/', '/\\bCo-Debtor\\b/', '/\\bDebtor’s\\b/', '/\\bDebtor\\b/'];
        $replaceRegex = [$spousename, $spousename, $debtorname, $debtorname];
        $doNotConsider = ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report', 'Income_Docs_For_Debtor', 'Debtor_Taxes'];
        $updatedName = $name;
        if (!in_array($key, $doNotConsider)) {
            $updatedName = str_replace($searchSimple, $replaceSimple, $updatedName);
            $updatedName = preg_replace($searchRegex, $replaceRegex, $updatedName);
        }

        return $updatedName;
    }


    public static function getDebtorName($object, $default = "")
    {
        $Name = $default;
        if (!empty($object)) {
            $middleName = !empty(Helper::validate_key_value('middle_name', $object))
                                ? ' ' . Helper::validate_key_value('middle_name', $object)
                                : '';
            $Name = Helper::validate_key_value('name', $object) . $middleName
                        . ' ' . Helper::validate_key_value('last_name', $object);
        }

        return $Name;
    }


    public static function checkProgress()
    {
        $clientUser = Auth::user();
        $client_id = $clientUser->id;
        $client_type = $clientUser->client_type;

        // Data
        $biData = CacheBasicInfo::getBasicInformationData($client_id, true, false);
        $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $biData, 'array');
        $BasicInfoPartC = Helper::validate_key_value('BasicInfo_PartC', $biData, 'array');
        $BasicInfoPartRest = Helper::validate_key_value('BasicInfo_PartRest', $biData, 'array');

        $propertyData = CacheProperty::getPropertyData($client_id, true, false);
        $pResident = Helper::validate_key_value('propertyresident', $propertyData, 'array');
        $pVehicle = Helper::validate_key_value('propertyvehicle', $propertyData, 'array');
        $pHousehold = Helper::validate_key_value('propertyhousehold', $propertyData, 'array');
        $pFA = Helper::validate_key_value('financialassets', $propertyData, 'array');
        $pBA = Helper::validate_key_value('businessassets', $propertyData, 'array');
        $pFC = Helper::validate_key_value('farmcommercial', $propertyData, 'array');
        $pMisc = Helper::validate_key_value('miscellaneous', $propertyData, 'array');

        $debtData = CacheDebt::getDebtData($client_id);
        $incomeData = CacheIncome::getIncomeData($client_id, true);
        $incomeD1Employer = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        $incomeD1Monthly = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
        $incomeD2Employer = Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');
        $incomeD2Monthly = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        if (!empty($incomeD1Monthly) && isset($incomeD1Monthly['recieved_any_income'])) {
            unset($incomeD1Monthly['recieved_any_income']);
        }
        if (!empty($incomeD2Monthly) && isset($incomeD2Monthly['recieved_any_income'])) {
            unset($incomeD2Monthly['recieved_any_income']);
        }

        $expenseData = CacheExpense::getExpenseData($client_id);
        $sofaData = CacheSOFA::getSOFAData($client_id);

        $listOfModels = [
            is_object($BasicInfoPartA) && $BasicInfoPartA->exists(),
            !empty($BasicInfoPartC),
            is_object($BasicInfoPartRest) && $BasicInfoPartRest->exists(),
            is_object($pResident) && $pResident->isNotEmpty(),
            is_object($pVehicle) && $pVehicle->isNotEmpty(),
            !empty($pHousehold),
            !empty($pFA),
            !empty($pBA),
            !empty($pFC),
            !empty($pMisc),
            !empty($debtData),
            !empty($incomeD1Employer),
            !empty($incomeD1Monthly),
            !empty($expenseData),
            !empty($sofaData),
        ];

        if ($client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) {

            $BasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $biData, 'array');

            $listOfModels = array_merge($listOfModels, [
                !empty($BasicInfoPartB),
                !empty($incomeD2Employer),
                !empty($incomeD2Monthly),
            ]);
        }
        if ($client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) {
            $listOfModels = array_merge($listOfModels, [
                !empty($incomeD2Employer),
                !empty($incomeD2Monthly),
            ]);
        }

        $total = count($listOfModels);
        $dataFoundFor = 0;
        foreach ($listOfModels as $model) {
            if ($model == true) {
                $dataFoundFor = $dataFoundFor + 1;
            }
        }
        if ($dataFoundFor == $total) {
            return 100;
        }
        if ($dataFoundFor > 0) {
            return round(($dataFoundFor / $total) * 100);
        }

        return $dataFoundFor;
    }

    public static function getFinancialFoields()
    {
        return [
            "id",
            "client_id",
            "list_every_address",
            "prev_address",
            "living_domestic_partner",
            "community_property_state",
            "domestic_partner_state",
            "domestic_partner_street_address",
            "domestic_partner_city",
            "domestic_partner_zip",
            "domestic_partner",
            "total_amount_income",
            "total_amount_this_year",
            "total_amount_this_year_income",
            "total_amount_last_year",
            "total_amount_last_year_income",
            "total_amount_lastbefore_year",
            "total_amount_lastbefore_year_income",
            "total_amount_income_spouse",
            "total_amount_spouse_this_year_income",
            "total_amount_spouse_last_year_income",
            "total_amount_spouse_lastbefore_year_income",
            "total_amount_spouse_this_year",
            "total_amount_spouse_last_year",
            "total_amount_spouse_lastbefore_year",
            "other_income_received_income",
            "other_income_received_this_year",
            "other_amount_this_year_income",
            "other_income_received_last_year",
            "other_amount_last_year_income",
            "other_income_received_lastbefore_year",
            "other_amount_lastbefore_year_income",
            "other_income_received_income_spouse",
            "other_amount_spouse_this_year_income",
            "other_amount_spouse_last_year_income",
            "other_amount_spouse_lastbefore_year_income",
            "other_income_received_spouse_this_year",
            "other_income_received_spouse_last_year",
            "other_income_received_spouse_lastbefore_year",
            "primarily_consumer_debets",
            "primarily_consumer_debets_data",
            "payment_past_one_year",
            "past_one_year_data",
            "transfers_property",
            "transfers_property_data",
            "list_lawsuits",
            "list_lawsuits_data",
            "property_repossessed",
            "property_repossessed_data",
            "setoffs_creditor",
            "setoffs_creditor_data",
            "court_appointed",
            "list_any_gifts",
            "list_any_gifts_data",
            "gifts_charity",
            "gifts_charity_data",
            "losses_from_fire",
            "losses_from_fire_data",
            "property_transferred",
            "property_transferred_data",
            "property_transferred_creditors",
            "property_transferred_creditors_data",
            "Property_all",
            "Property_all_data",
            "all_property_transfer_10_year",
            "all_property_transfer_10_year_data"
            ,"list_all_financial_accounts",
            "list_all_financial_accounts_data",
            "list_safe_deposit",
            "list_safe_deposit_data",
            "still_have_safe_deposite",
            "other_storage_unit",
            "other_storage_unit_data",
            "list_property_you_hold",
            "list_property_you_hold_data",
            "list_noticeby_gov",
            "list_noticeby_gov_data",
            "list_environment_law",
            "list_environment_law_data",
            "list_judicial_proceedings",
            "list_judicial_proceedings_data",
            "employer_identification",
            "list_nature_business",
            "list_nature_business_data",
            "list_financial_institutions",
            "list_financial_institutions_data",
            "current_marital_Status",
            "created_on",
            "updated_on",
            "domestic_partner_living",
            "other_income_received_this_year_text",
            "other_income_received_last_year_text",
            "other_income_received_lastbefore_year_text",
            "other_income_received_spouse_this_year_text",
            "other_income_received_spouse_last_year_text",
            "other_income_received_spouse_lastbefore_year_text",
            'total_amount_this_year_extra',
            'total_amount_last_year_extra',
            'total_amount_lastbefore_year_extra',
            'total_amount_this_year_income_extra',
            'total_amount_last_year_income_extra',
            'total_amount_lastbefore_year_income_extra',

            'total_amount_spouse_this_year_extra',
            'total_amount_spouse_last_year_extra',
            'total_amount_spouse_lastbefore_year_extra',

            'total_amount_spouse_this_year_income_extra',
            'total_amount_spouse_last_year_income_extra',
            'total_amount_spouse_lastbefore_year_income_extra',


        ];
    }

    public static function formatInputJson($input)
    {
        $final_input = [];
        foreach ($input as $k => $v) {
            if (is_array($v)) {
                $final_input[$k] = json_encode($v);
            } else {
                $final_input[$k] = $v;
            }
        }

        return $final_input;
    }

    public static function vinFromCarmd($vinNumber): array|null
    {
        $newdata = [];

        try {
            $client = new Client();

            $response = $client->request(
                'GET',
                'https://api.auto.dev/vin/' . $vinNumber,
                [
                    'headers' => [
                        "content-type" => "application/json",
                        "Authorization" => "Bearer " . env('AUTO_DEV_API_KEY')
                    ]
                ]
            );
            $data = json_decode($response->getBody(), true);
            Log::info('Auto.dev API response:', ['response' => $data]);

            if (isset($data['vehicle']) && is_array($data['vehicle'])) {
                $newdata = [
                    'year' => $data['vehicle']['year'] ?? null,
                    'make' => $data['vehicle']['make'] ?? null,
                    'model' => $data['vehicle']['model'] ?? null,
                    'trim' => $data['style'] ?? null,
                ];
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle request-related exceptions (like 500, 404)
            \Log::error('Auto.dev API Guzzle RequestException: ' . $e->getMessage());
            if ($e->hasResponse()) {
                \Log::error('Auto.dev API Error Response: ' . $e->getResponse()->getBody());
            }
        } catch (\Exception $e) {
            // Catch any other exceptions
            \Log::error('General Exception: ' . $e->getMessage());
        }

        return !empty($newdata) ? $newdata : null;
    }

    public static function getClientNextMortgageVehicleDoc($client_id, $document_type)
    {
        if (!in_array($document_type, [ "Current_Auto_Loan_Statement", "Current_Mortgage_Statement"])) {
            return '';
        }
        $getPendingDocTypeResponse = Helper::getPendingDocType($client_id, $document_type);
        if (!empty($getPendingDocTypeResponse) && is_array($getPendingDocTypeResponse)) {
            if ($getPendingDocTypeResponse['status'] == 'success') {
                return $getPendingDocTypeResponse['firstMissingKey'];
            }
        }
    }

    public static function getTotalExpense($expenses_info, $codebtor = false)
    {
        $totalMonthlyExpensesList = [];

        $totalMonthlyExpensesList[] = self::formatAmount(Helper::validate_key_value('rent_home_mortage', $expenses_info));

        $totalMonthlyExpensesList[] = Helper::validate_key_value('real_estate_taxes', $expenses_info) == 0
            ? self::formatAmount(Helper::validate_key_value('estate_taxes_pay', $expenses_info))
            : '0.00';

        if (Helper::validate_key_value('amount_include_property', $expenses_info) == 0) {
            $totalMonthlyExpensesList[] = self::formatAmount($expenses_info['amount_include_property_pay'] ?? '0.00');
        }

        if (Helper::validate_key_value('amount_include_home', $expenses_info) == 0) {
            $totalMonthlyExpensesList[] = self::formatAmount(Helper::validate_key_value('amount_include_home_pay', $expenses_info));
        }

        if (Helper::validate_key_value('amount_include_homeowner', $expenses_info) == 0) {
            $totalMonthlyExpensesList[] = self::formatAmount($expenses_info['amount_include_homeowner_pay'] ?? '0.00');
        }

        if (Helper::validate_key_value('mortgage_payments', $expenses_info) == 1) {
            $totalMonthlyExpensesList[] = self::formatAmount(Helper::validate_key_value('mortgage_payments_pay', $expenses_info));
        }

        if (!empty($expenses_info['utilities'])) {
            foreach (Arr::flatten($expenses_info['utilities']) as $utilitval) {
                $totalMonthlyExpensesList[] = self::formatAmount($utilitval);
            }
        }

        if (Helper::validate_key_value('utility_bills', $expenses_info) == 1) {
            $totalMonthlyExpensesList[] = self::formatAmount(Helper::current(@$expenses_info['monthly_utilities_value']));
        }

        $expenseCategories = [
            "food_housekeeping" => "Food and housekeeping supplies",
            "childcare" => "Childcare and Children Education Costs",
            "laundry" => "Clothing, laundry, and dry cleaning",
            "personal_care" => "Personal care products and services",
            "medical_dental" => "Medical and dental expenses",
            "transportation" => "Transportation (do NOT include car payments)",
            "entertainment" => "Recreation, entertainment, newspapers, magazines, and books",
            "charitablet" => "Charitable contributions and religious donations",
            "life_insurance" => "Life insurance",
            "health_insurance" => "Health insurance",
            "auto_insurance" => "Auto insurance"
        ];

        foreach ($expenseCategories as $key => $housevalue) {
            $totalMonthlyExpensesList[] = self::formatAmount(Helper::validate_key_value("{$key}_price", $expenses_info));
        }

        if (Helper::validate_key_value('otherInsurance_notListed', $expenses_info) == 1 || Helper::validate_key_value('otherInsNotListedSpouse', $expenses_info) == 1) {
            $totalMonthlyExpensesList[] = self::formatAmount($expenses_info['other_insurance_price'] ?? '0.00');
        }

        if (Helper::validate_key_value('taxbills_not_deducted', $expenses_info) == 1) {
            $totalMonthlyExpensesList[] = self::formatAmount($expenses_info['taxbills_price'] ?? '0.00');
        }

        if (Helper::validate_key_value('installment_payment_for_car', $expenses_info) == 1) {
            foreach ($expenses_info['installmentpayments_price'] as $i => $price) {
                if (isset($expenses_info['installmentpayments_type'][$i])) {
                    $totalMonthlyExpensesList[] = self::formatAmount($price);
                }
            }
        }

        $additionalExpenses = [
            "alimony" => "Alimony, maintenance and support paid to others:",
            "payments_dependents" => "Payments for support of additional dependents not living at your home:"
        ];

        if (Helper::validate_key_value('alimony_maintenance', $expenses_info) != 1) {
            unset($additionalExpenses['alimony']);
        }

        if ($codebtor == false && Helper::validate_key_value('paymentforsupport_dependents_n', $expenses_info) != 1) {
            unset($additionalExpenses['payments_dependents']);
        }
        if ($codebtor && Helper::validate_key_value('PaymentsforadditionaldepSpouse', $expenses_info) != 1) {
            unset($additionalExpenses['payments_dependents']);
        }

        foreach ($additionalExpenses as $key => $housevalue) {
            $totalMonthlyExpensesList[] = self::formatAmount(Helper::validate_key_value("{$key}_price", $expenses_info));
        }

        if (Helper::validate_key_value('mortgage_property1', $expenses_info) == 1 || Helper::validate_key_value('otherRealPropertyNotAddedSpouse', $expenses_info) == 1) {
            $otherRealEstateExpenses = [
                "other_real_estate_price" => "Mortgage payment on other Real Estate Property",
                "tax" => "Taxes on other Real Estate Property",
                "rental_insurance_price" => "Other Real Property, Homeowner's, or Renter's Insurance payments",
                "home_maintenance_price" => "Home maintenance (including repairs and upkeep)",
                "condominium_price" => "Homeowner's association or condominium dues"
            ];

            foreach ($otherRealEstateExpenses as $key => $housevalue) {
                $totalMonthlyExpensesList[] = self::formatAmount(Helper::validate_key_loop_value('mortgage_property', $expenses_info, $key));
            }
        }

        if (Helper::validate_key_value('other_expense_available', $expenses_info) == 1) {
            $totalMonthlyExpensesList[] = $codebtor
                ? self::formatAmount(Helper::validate_key_value('other_expense_value', $expenses_info))
                : self::formatAmount(Helper::validate_key_value('other_expense_price', $expenses_info));
        }

        $total = array_sum(array_map(function ($amount) {
            return (float)str_replace(',', '', $amount);
        }, $totalMonthlyExpensesList));

        return number_format($total, 2, '.', ',');
    }

    private static function formatAmount($amount)
    {
        return number_format((float)$amount, 2, '.', ',');
    }

    public static function get_uploaded_docs_progress($client = '', $clId = '', $atId = '')
    {
        $client = $client ? $client : Auth::user();

        $client_id = $clId ? $clId : $client->id;
        $client_attorney_id = $atId ? $atId : (isset($client->ClientsAttorneybyclient) && $client->ClientsAttorneybyclient->exists() ? $client->ClientsAttorneybyclient->attorney_id : 0);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);

        $clientAttorneyIdOrigional = $client_attorney_id;

        $queryCondition = [ 'attorney_id' => $client_attorney_id, 'is_associate' => 0 ];
        $is_associate = 0;
        if (!empty($ClientsAssociateId)) {
            $client_attorney_id = $ClientsAssociateId;
            $queryCondition = [ 'attorney_id' => $client_attorney_id, 'is_associate' => 1 ];
            $is_associate = 1;
        }

        if (empty($client_attorney_id)) {
            \Log::info('Client Helper missing attr id: ' . $client_id);
        }

        $allDocs = ClientDocumentUploaded::getAllDocuments($client_attorney_id);

        $isPostSubmissionEnabled = \App\Models\ClientSettings::isPostSubmissionEnabled($client_id);
        if ($isPostSubmissionEnabled) {
            $allDocs = [ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"] + $allDocs;
        }

        if ($client->client_type != Helper::CLIENT_TYPE_JOINT_MARRIED) {
            unset($allDocs['Co_Debtor_Drivers_License']);
            unset($allDocs['Co_Debtor_Social_Security_Card']);
        }
        if ($client->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED) {
            unset($allDocs['Co_Debtor_Drivers_License']);
            unset($allDocs['Co_Debtor_Social_Security_Card']);
            unset($allDocs['Co_Debtor_Pay_Stubs']);
        }
        $otherMisc = ClientDocumentUploaded::getMiscDocsForAttorneyDocumentScreen($client_attorney_id);
        $allDocs = array_unique(array_merge($allDocs, $otherMisc));

        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $client_id)->pluck('document_name', 'document_type')->all();
        $attorneydocuments = self::getAttorneyDocument($client_attorney_id, $is_associate);

        $attorneySettings = AttorneySettings::where($queryCondition)->select(['attorney_enabled_bank_statment'])->first();
        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings, 'radio') : 0;
        $isBankStatementEnabled = ($attorney_enabled_bank_statment == 1) ? true : false;
        $clientDocs = [];
        if ($isBankStatementEnabled) {
            $clientDocs = self::getClientDocument($client_id);
        }


        $clientLifeInsuranceDocs = self::getClientLifeInsuranceDocument($client_id);
        $retirement_pension = self::getClientRetirementPensionDocument($client_id);
        // Get list of uploaded documents by the client
        $documentuploaded_list = $client->clientDocumentUploaded->whereNotIn('document_type', ['undefined'])->pluck('document_type')->toArray();
        $documentuploaded = array_unique($documentuploaded_list);
        // Check and modify documentuploaded array
        $documentuploaded = self::modifyDocumentUploadedArray($documentuploaded, $client_id);
        // Get requested documents
        $requestedDocuments = \App\Models\AdminClientRequestedDocuments::where('client_id', $client_id)->value('requested_documents');
        $requestedDocuments = json_decode($requestedDocuments, true) ?: [];


        /*if(is_array($allDocs) && is_array($requestedDocuments)){
            $allDocs = array_unique(array_merge($allDocs,$requestedDocuments));
        }
        if(is_array($allDocs) && is_array($adminDocuments)){
            $allDocs = array_unique(array_merge($allDocs,$adminDocuments));
        }*/

        if (is_array($allDocs) && is_array($requestedDocuments)) {
            $allDocs = array_unique(
                array_merge(
                    array_filter($allDocs, 'is_scalar'),
                    array_filter($requestedDocuments, 'is_scalar')
                )
            );
        }
        if (is_array($allDocs) && is_array($adminDocuments)) {
            $allDocs = array_unique(
                array_merge(
                    array_filter($allDocs, 'is_scalar'),
                    array_filter($adminDocuments, 'is_scalar')
                )
            );
        }

        // Merge all document lists
        unset($allDocs["Current_Auto_Loan_Statement"]);
        unset($allDocs["Current_Mortgage_Statement"]);


        $propertyData = CacheProperty::getPropertyData($client_id);
        $clientProperty = Helper::validate_key_value('propertyresident', $propertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

        $propertyVehiclesDocs = DocumentHelper::getClientDebtorVehiclesDocumentList($client_id);
        $propertyVehiclesDocs = $propertyVehiclesDocs['vehiclesDocumentList'] ?? [];
        $propertyVehiclesDocs = array_combine($propertyVehiclesDocs, $propertyVehiclesDocs);
        $allDocs = array_unique(array_merge($allDocs, $propertyVehiclesDocs));

        $propertyResidentDocs = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, false, true);
        $propertyResidentDocs = $propertyResidentDocs['clientDocumentList'] ?? [];
        $propertyResidentDocs = array_combine($propertyResidentDocs, $propertyResidentDocs);
        $allDocs = array_unique(array_merge($allDocs, $propertyResidentDocs));

        $completeList = array_unique(array_merge($allDocs, $clientDocs));

        $completeList = array_unique(array_merge($completeList, $clientLifeInsuranceDocs));
        $completeList = array_unique(array_merge($completeList, $retirement_pension));

        $completeList = array_unique($completeList + $allDocs);
        $completeList = array_unique($completeList + $attorneydocuments);

        $excludeDocs = AttorneyExcludeDocs::where($queryCondition)->first();
        $excludeDocs = !empty($excludeDocs) ? $excludeDocs->toArray() : [];

        $excludedDocTypes = [];
        if (isset($excludeDocs) && !empty($excludeDocs)) {
            $excludedDocTypes = Helper::validate_key_value('doc_type_json', $excludeDocs);
            $excludedDocTypes = json_decode($excludedDocTypes, true);
        }
        $AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where(['attorney_id' => $client_attorney_id, 'client_id' => $client_id])->first();
        $AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient) ? $AttorneyExcludeDocsPerClient->toArray() : [];
        $docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
        $docJsonPerClient = json_decode($docJsonPerClient) ?? [];
        $mergedArray = array_merge($excludedDocTypes, $docJsonPerClient);
        $excludedDocTypes = array_unique($mergedArray);
        // remove excluded docs from complete list
        if (is_array($excludedDocTypes)) {
            if (!in_array('Vehicle_Registration', $excludedDocTypes)) {
                $vehicleRegisterationDocs = self::getVehicleRegisterationDocs($client_id);
                $completeList = array_merge($completeList, $vehicleRegisterationDocs);
            }
            if (in_array('Current_Auto_Loan_Statement', $excludedDocTypes)) {
                foreach ($completeList as $key => $value) {
                    if (str_starts_with($key, 'Current_Auto_Loan_Statement') || str_starts_with($key, 'Other_Loan_Statement')) {
                        unset($completeList[$key]);
                    }
                }
            }
            $completeList = array_diff_key($completeList, array_flip($excludedDocTypes));
        }

        unset($completeList["Debtor_Creditor_Report"]);
        unset($completeList["Co_Debtor_Creditor_Report"]);

        $incomeData = CacheIncome::getIncomeData($client_id);
        $D1Data = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        $D2Data = Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');

        $hasDebtorEmployer = self::getEmployerStatus($D1Data, 1);
        $hasCodebtorEmployer = self::getEmployerStatus($D2Data, 2);

        if (!$hasDebtorEmployer) {
            unset($completeList['Debtor_Pay_Stubs']);
        }
        if (!$hasCodebtorEmployer) {
            unset($completeList['Co_Debtor_Pay_Stubs']);
        }
        $progress = self::calculateDocsProgress($documentuploaded, $completeList);
        $notUploadedDocs = array_diff_key($completeList, array_flip($documentuploaded));

        $docsUploadInfo = [
            'notUploadedDocs' => $notUploadedDocs,
            'progress' => $progress
        ];

        return $docsUploadInfo;
    }

    public static function getEmployerStatus($employerData, $debtor_type)
    {

        $currentEmployerKey = ($debtor_type == 1) ? 'current_employed' : 'current_employed' ;
        $additionalEmployerKey = ($debtor_type == 1) ? 'any_other_jobs' : 'spouse_any_other_jobs' ;
        $primaryEmployerKey = ($debtor_type == 1) ? 'recieved_any_income' : 'recieved_any_income' ;

        $currentEmployerStatus = Helper::validate_key_value($currentEmployerKey, $employerData, 'radio'); //1
        $additionalEmployerStatus = Helper::validate_key_value($additionalEmployerKey, $employerData, 'radio'); //1
        $primaryEmployerStatus = Helper::validate_key_value($primaryEmployerKey, $employerData, 'radio'); //1

        $hasEmployer = false;
        if ($currentEmployerStatus == 1 || $additionalEmployerStatus == 1 || $primaryEmployerStatus == 1) {
            $hasEmployer = true;
        }

        return $hasEmployer;
    }

    private static function modifyDocumentUploadedArray($documentuploaded, $client_id)
    {
        //$autoloanKeys = \App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1);
        //$residenseLoanKey = \App\Models\ClientDocumentUploaded::getResidenceKeyValue(1);
        $notOwnDocs = self::getNotOwnDocument($client_id);
        $documentuploaded = array_merge($documentuploaded, array_values(array_diff_key($notOwnDocs, array_flip($documentuploaded))));

        //$documentuploaded['Current_Auto_Loan_Statement_1'] = "Current_Auto_Loan_Statement_1";
        /* foreach ($documentuploaded as &$value) {
             if (isset($autoloanKeys[$value])) {
                 $value = "Current_Auto_Loan_Statement";
             } elseif (isset($residenseLoanKey[$value])) {
                 $value = "Current_Mortgage_Statement";
             }
         }*/

        if (!in_array('Current_Mortgage_Statement', $documentuploaded) && in_array('Current_Mortgage_Statement_1_1', $documentuploaded)) {
            $documentuploaded[] = 'Current_Mortgage_Statement';
        }

        if (!in_array('Current_Auto_Loan_Statement', $documentuploaded) && in_array('Current_Auto_Loan_Statement_1', $documentuploaded)) {
            $documentuploaded[] = 'Current_Auto_Loan_Statement';
        }

        return array_values(array_unique($documentuploaded));
    }


    private static function getAttorneyDocument($id, $is_associate = 0)
    {
        $data = AttorneyDocuments::where(['attorney_id' => $id, 'is_associate' => $is_associate])->pluck('document_name', 'document_type')->all();

        return $data;
    }

    private static function getNotOwnDocument($id)
    {
        $data = \App\Models\NotOwnDocuments::where(['client_id' => $id])->select(['document_type'])->get()->toArray();
        $obj = [];
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $obj[$value['document_type']] = $value['document_type'];
            }
        }

        return $obj;
    }

    private static function calculateDocsProgress($documentuploaded, $completeList)
    {
        $commonKeys = array_intersect_key($completeList, array_flip($documentuploaded));
        $uploadedDocs = count($commonKeys);
        $totalDocs = count($completeList);
        $progress = ($uploadedDocs / $totalDocs) * 100;
        $progress = round($progress);

        return ($progress > 100 ? 100 : $progress);
    }

    public static function hideBackOnEditPopup($attorney_edit = false)
    {
        if ($attorney_edit == true) {
            return 'hide-data';
        }

        return '';
    }

    public static function accountTypeArrayForDoc($key = null, $return = 0)
    {
        $arr = [
            Helper::ACT_TYPE_401K => "401(k)",
            Helper::ACT_TYPE_PENSION_PLAN => "Pension",
            Helper::ACT_TYPE_IRA => "IRA",
            Helper::ACT_TYPE_RETIREMENT => 'Retirement Account',
            Helper::ACT_TYPE_KEOGH => "Keogh",
            Helper::ACT_TYPE_ADDITIONAL => "Additional Account"
        ];
        if ($return) {
            return $arr;
        }

        return Helper::returnArrValue($arr, $key);
    }

    public static function getClientAttorneyId($client_id)
    {
        $attorney_id = 0;
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

}
