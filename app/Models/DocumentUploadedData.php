<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use App\Helpers\DateTimeHelper;
use App\Helpers\DocumentHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class DocumentUploadedData extends Model
{
    public static function getDocumentScreenAjaxData($type, $user, $attorney_id, $document_type, $employer_id)
    {

        $data = [];
        $mainDocumentTypeStructure = [];

        $clientBankDocs = [];
        $attorneyDocs = [];
        $adminDocuments = [];
        $mortgageUpdatedNames = [];
        $vehicleUpdatedNames = [];

        $client_type = $user->client_type;
        $client_id = $user->id;

        $uploadedDocumentsData = self::getDocumentUploadedData($client_id);
        $attorneySettings = AttorneySettings::where(['attorney_id' => $attorney_id])->select(['bank_statement_months', 'attorney_enabled_bank_statment', 'is_car_title_enabled', 'brokerage_months'])->first();
        $clientBankDocs = ClientDocuments::getClientDocs($client_id);
        $attorneyDocs = self::getAttorneyDocumentTypes($attorney_id);
        $adminDocuments = AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $client_id)->pluck('document_name', 'document_type')->all();


        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $vehicle_title = $is_car_title_enabled ? ($clientBankDocs['vehicle_title'] ?? []) : [];


        $clientPSDocuments = ClientDocuments::getClientPostSubmissionDocumentList($client_id);

        //  Post Submission Documents
        if ($type == 'Post_submission_documents') {
            $mainDocumentTypeStructure = self::getParentPostSubmissionDocuments($uploadedDocumentsData, $clientPSDocuments);
            $mainDocumentTypeStructure = Helper::validate_key_value($document_type, $mainDocumentTypeStructure, 'array');
        }

        //  ID Information:
        if ($type == 'parentIdDocuments') {
            $mainDocumentTypeStructure = self::getParentIdDocuments($uploadedDocumentsData, $client_type);
        }
        //  Secured Debts:
        if ($type == 'parentSecuredDocuments') {
            $clientPropertyData = CacheProperty::getPropertyData($client_id);
            $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
            $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

            $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentListWithHeading($clientProperty, false, false, $client_id);
            $propertyData = $clientDebtorResidentDocumentList['propertyData'] ?? [];
            $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];

            $excludeDocs = self::getExcludedDocs($attorney_id, $client_id, $user);

            $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentListWithHeading($client_id, false, !empty($vehicle_title), !in_array('Vehicle_Registration', $excludeDocs));
            $vehicleData = $clientDebtorVehiclesDocumentList['vehicleData'] ?? [];
            $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
            // for auto insurance documents Insurance_Documents , Proof of Auto Insurance
            if (!in_array('Insurance_Documents', $excludeDocs)) {
                $vehicleData['Insurance_Documents'] = 'Proof of Auto Insurance';
                $vehicleUpdatedNames['Insurance_Documents'] = 'Proof of Auto Insurance';
            }

            $mainDocumentTypeStructure = self::getSecuredDocuments($uploadedDocumentsData, $propertyData, $vehicleData);

            if ($document_type == 'Insurance_Documents' && is_array($mainDocumentTypeStructure) && array_key_exists('Current_Auto_Loan_Statement', $mainDocumentTypeStructure)) {
                $mainDocumentTypeStructure = Helper::validate_key_value('Current_Auto_Loan_Statement', $mainDocumentTypeStructure, 'array');
                $mainDocumentTypeStructure = Helper::validate_key_value('Insurance_Documents', $mainDocumentTypeStructure, 'array');
            }

            if ((str_starts_with($document_type, 'Primary_Residence') || str_starts_with($document_type, 'Non_Primary_Residence')) && !empty($mainDocumentTypeStructure) && is_array($mainDocumentTypeStructure)) {
                $mainDocumentTypeStructure = Helper::validate_key_value('Current_Mortgage_Statement', $mainDocumentTypeStructure, 'array');
            }

            if ((str_starts_with($document_type, 'vehicle_statement') || str_starts_with($document_type, 'recreational_statement')) && !empty($mainDocumentTypeStructure) && is_array($mainDocumentTypeStructure)) {
                $mainDocumentTypeStructure = Helper::validate_key_value('Current_Auto_Loan_Statement', $mainDocumentTypeStructure, 'array');
            }

        }

        //  Unsecured Debts:
        if ($type == 'parentUnsecuredDocuments') {
            $mainDocumentTypeStructure = self::getUnsecuredDocuments($uploadedDocumentsData);
            $mainDocumentTypeStructure = reset($mainDocumentTypeStructure);
        }
        //  Income Docs for Debtor(s):
        if ($type == 'parentIncomeDocuments') {
            $mainDocumentTypeStructure = self::getIncomeDocuments($uploadedDocumentsData);
        }
        //  Other Income Docs:
        if ($type == 'parentOtherIncomeDocuments') {
            $mainDocumentTypeStructure = self::getOtherIncomeDocuments($uploadedDocumentsData, $clientBankDocs);
        }
        //  Debtor(s) Taxes:
        if ($type == 'parentTaxesDocuments') {
            $mainDocumentTypeStructure = self::getTaxesDocuments($uploadedDocumentsData);
        }
        //  Retirement Docs:
        if ($type == 'parentRetirementDocuments') {
            $mainDocumentTypeStructure = self::getRetirementDocuments($uploadedDocumentsData, $clientBankDocs);
        }
        //  Additional or Unlisted/Attorney Documents
        if ($type == 'parentMiscAttorneyDocuments') {
            $mainDocumentTypeStructure = self::getMiscAttorneyDocuments($uploadedDocumentsData, $attorneyDocs);
            $mainDocumentTypeStructure = Helper::validate_key_value('Miscellaneous_Documents', $mainDocumentTypeStructure, 'array');
        }
        //  Bank Statements
        if ($type == 'parentBankDocuments') {
            $mainDocumentTypeStructure = self::getBankDocuments($uploadedDocumentsData, $clientBankDocs);
        }
        //  PayPal, Cash App, Venmo Account Statements
        if ($type == 'parentPaypalVenmoCashDocuments') {
            $mainDocumentTypeStructure = self::getPaypalVenmoCashDocuments($uploadedDocumentsData, $clientBankDocs);
        }
        //  Brokerage Account Statements
        if ($type == 'parentBrokerageDocuments') {
            $mainDocumentTypeStructure = self::getBrokerageDocuments($uploadedDocumentsData, $clientBankDocs);
        }
        //  Requested Documents
        if ($type == 'parentRequestedDocuments') {
            $mainDocumentTypeStructure = self::getRequestedDocuments($uploadedDocumentsData, $clientBankDocs, $adminDocuments);
        }

        if (in_array($type, ['parentIdDocuments', 'parentSecuredDocuments', 'parentIncomeDocuments', 'parentUnsecuredDocuments', 'parentOtherIncomeDocuments', 'parentTaxesDocuments', 'parentRetirementDocuments', 'parentMiscAttorneyDocuments', 'parentBankDocuments', 'parentPaypalVenmoCashDocuments', 'parentBrokerageDocuments', 'parentRequestedDocuments'])) {
            $mainDocumentTypeStructure = Helper::validate_key_value($document_type, $mainDocumentTypeStructure, 'array');
        }

        $settings = new \App\Models\ClientSettings();
        $clientSettings = $settings->getclientSettings($client_id, ['post_submission_documents_enabled']);
        $post_submission_documents_enabled = $clientSettings->post_submission_documents_enabled ?? 0;

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($user->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $data['allDocNames'] = self::getDocTypeNameForUploadedScreen($debtorname, $spousename, $attorney_id, $clientBankDocs, $attorneyDocs, $adminDocuments, $mortgageUpdatedNames, $vehicleUpdatedNames, $post_submission_documents_enabled, $clientPSDocuments);

        $data['mainDocumentTypeStructure'] = $mainDocumentTypeStructure;
        $savedRequestedDocs = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $client_id])->select('requested_documents')->first();
        $requestedDocuments = Helper::validate_key_value('requested_documents', $savedRequestedDocs);
        $data['requestedDocuments'] = !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];

        $bank_statement_months = !empty($attorneySettings) ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';

        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings) : 1;
        $bank_account_documents = $attorney_enabled_bank_statment == 1 ? ClientDocuments::getClientBankDocumentList($client_id) : [];
        $clientDocs = $clientBankDocs['bank'] ?? [];
        $venmoPaypalCash = $attorney_enabled_bank_statment == 1 ? ($clientBankDocs['venmo_paypal_cash'] ?? []) : [];
        $venmoPaypalCash = Helper::getUpdatedPayPalName($venmoPaypalCash);
        $brokerageAccount = $attorney_enabled_bank_statment == 1 ? ($clientBankDocs['brokerage_account'] ?? []) : [];

        $adminDocs = \App\Models\ClientDocuments::getAdminRequestedDocumentList($adminDocuments, $clientBankDocs);

        $lifeInsuDocs = $clientBankDocs['life_insurance'] ?? [];
        if (!empty($lifeInsuDocs)) {
            $adminDocs = array_merge($adminDocs, array_keys($lifeInsuDocs));
        }

        $docsMisc = $attorneyDocs;
        array_push($docsMisc, 'Miscellaneous_Doucments');
        if ($type == 'parentSecuredDocuments' && $document_type !== 'Insurance_Documents') {
            $data['adminDocs'] = $adminDocs;
        } else {
            $otherData = self::getOtherDataForViewFile($client_id, $attorney_id, $type, $mainDocumentTypeStructure, $bank_statement_months, $document_type, $bank_account_documents, $clientDocs, $venmoPaypalCash, $brokerageAccount, $adminDocs, $docsMisc, $attorneySettings);
            $data += $otherData;
        }

        $data['docsMisc'] = $docsMisc;

        return $data;
    }
    public static function getOtherDataForViewFile($client_id, $attorney_id, $type, $docs, $bank_statement_months, $objKey, $bank_account_documents, $clientDocs, $venmoPaypalCash, $brokerageAccount, $adminDocs, $docsMisc, $attorneySettings)
    {
        $docsCount = isset($docs) && is_array($docs) ? count($docs) : 0;
        $bank_statement_month_nos = $bank_statement_months;
        $banktypeString = '';
        $documentAndMissingText = '';
        $missing_months = '';
        $notOwnedproperty = '';
        $allbankUploaded = true;
        $notOwned = self::getNotOwnDocs($client_id);
        if (in_array($objKey, $notOwned)) {
            $notOwnedproperty = "Client selected no document available";
        }
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        $brokerage_months = '';
        if (in_array($type, ['parentPaypalVenmoCashDocuments', 'parentBankDocuments', 'parentBrokerageDocuments'])) {


            foreach ($bank_account_documents as $bnksacc) {
                if ($bnksacc['document_name'] == $objKey && $bnksacc['bank_account_type'] == 1) {
                    $banktypeString = "<small class='ms-1 absolute-tick font-weight-bold text-c-light-blue'>(Personal)</small>";
                }
                if ($bnksacc['document_name'] == $objKey && $bnksacc['bank_account_type'] == 2) {
                    $bank_statement_month_nos = ($bnksacc['bank_account_type'] == 2) ? $attProfitLossMonths : $bank_statement_months;
                    $banktypeString = "<small class='ms-1 absolute-tick font-weight-bold text-c-blue'>(Business)</small>";
                }
            }

            $addCurrentMonthToDate = AttorneySettings::isCurrentPartialMonthEnabled($attorney_id);
            if ($type == 'parentBrokerageDocuments') {
                $addCurrentMonthToDate = false;
                $brokerage_months = !empty($attorneySettings) ? Helper::validate_key_value('brokerage_months', $attorneySettings) : '';
            }

            $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos, null, $addCurrentMonthToDate, $brokerage_months);

            foreach ($statement_month_array as $month_key => $month_value) {
                $found = false;
                foreach ($docs as $object) {
                    if ($object['document_month'] === $month_key) {
                        $found = true;
                        $missing_months .= '<span class="text-success">' . $month_value . '</span>, ';
                        break;
                    }
                }
                if (!$found) {
                    $allbankUploaded = false;
                    $missing_months .= '<span class="text-danger">' . $month_value . '</span>, ';
                }
            }
            $missing_months = rtrim($missing_months, ', ');
            if (!empty($missing_months)) {
                $documentAndMissingText = !empty($banktypeString) ? $missing_months : '' . $missing_months;
            } else {
                $successString = "<span class='text-c-green font-weight-bold ml-2'>All Uploaded</span>";
                $documentAndMissingText = !empty($banktypeString) ? $successString : '' . $successString;
            }
        }

        $acceptedCount = 0;
        $declinedCount = 0;
        $checkbox = false;
        $parentIndicator = "d-none";
        if (isset($docs) && is_array($docs)) {
            foreach ($docs as $doc) {
                if ((isset($doc['document_status']) && $doc['document_status'] == 1) || (isset($doc['document_status']) && $doc['document_status'] !== 2 && isset($doc['added_by_attorney']) && ($doc['added_by_attorney'] == 1))) {
                    $acceptedCount++;
                }
                if (isset($doc['document_status']) && $doc['document_status'] == 2) {
                    $declinedCount++;
                }
                if (
                    !$checkbox &&
                    (in_array($objKey, ['Co_Debtor_Pay_Stubs', 'Debtor_Pay_Stubs', 'W2_Last_Year', 'W2_Year_Before', 'Insurance_Documents'])
                        || in_array($objKey, ['Miscellaneous_Documents', 'Other_Misc_Documents', 'Vehicle_Registration', 'Debtor_Creditor_Report'])
                        || in_array($objKey, array_keys($clientDocs))
                        || in_array($objKey, array_keys($venmoPaypalCash))
                        || in_array($objKey, array_keys($brokerageAccount))
                        || in_array($objKey, $adminDocs)
                        || in_array($objKey, $docsMisc)
                        || in_array($objKey, ClientDocumentUploaded::getTaxDocumentById())
                        || ($type == 'parentRetirementDocuments')
                        || ($type == 'parentOtherIncomeDocuments'))
                ) {
                    $checkbox = true;
                }
                if (Helper::validate_key_value('is_viewed_by_attorney', $doc, 'radio') == 0) {
                    $parentIndicator = "";
                }
            }
        }
        $isIdSection = in_array($objKey, ['Drivers_License', 'Social_Security_Card', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card']);
        $final_debts = self::getDebtsList($client_id);

        return [
            'banktypeString' => $banktypeString,
            'parentIndicator' => $parentIndicator,
            'documentAndMissingText' => $documentAndMissingText,
            'docsCount' => $docsCount,
            'checkbox' => $checkbox,
            'clientDocs' => $clientDocs,
            'venmoPaypalCash' => $venmoPaypalCash,
            'brokerageAccount' => $brokerageAccount,
            'adminDocs' => $adminDocs,
            'isIdSection' => $isIdSection,
            'final_debts' => $final_debts,
            'acceptedCount' => $acceptedCount,
            'declinedCount' => $declinedCount,
            'bank_statement_months' => $bank_statement_months,
            'bank_account_documents' => $bank_account_documents,
            'notOwnedproperty' => $notOwnedproperty,
            'attProfitLossMonths' => $attProfitLossMonths,
            'brokerage_months' => $brokerage_months,
        ];
    }

    public static function getMainDocumentTypeStructure($user, $attorneyId, $clientBankDocs, $attorneyDocs, $adminDocuments, $post_submission_documents_enabled, $propertyData, $vehicleData, $localForms, $trusteeForms, $clientPSDocuments)
    {

        $documentuploaded_data = self::getDocumentUploadedData($user->id);

        // ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents;
        $obj = [];
        if ($post_submission_documents_enabled) {
            $obj = [
                // Post Submission Docs
                ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => self::getParentPostSubmissionDocuments($documentuploaded_data, $clientPSDocuments),
            ];
        }

        $structure = [
            //  ID Information:
            'parentIdDocuments' => self::getParentIdDocuments($documentuploaded_data, $user->client_type),
            //  Secured Debts:
            'parentSecuredDocuments' => self::getSecuredDocuments($documentuploaded_data, $propertyData, $vehicleData),
            //  Unsecured Debts:
            'parentUnsecuredDocuments' => self::getUnsecuredDocuments($documentuploaded_data),
            //  Income Docs for Debtor(s):
            'parentIncomeDocuments' => self::getIncomeDocuments($documentuploaded_data),
            //  Other Income Docs:
            'parentOtherIncomeDocuments' => self::getOtherIncomeDocuments($documentuploaded_data, $clientBankDocs),
            //  Debtor(s) Taxes:
            'parentTaxesDocuments' => self::getTaxesDocuments($documentuploaded_data),
            //  Retirement Docs:
            'parentRetirementDocuments' => self::getRetirementDocuments($documentuploaded_data, $clientBankDocs),
            //  Additional or Unlisted/Attorney Documents
            'parentMiscAttorneyDocuments' => self::getMiscAttorneyDocuments($documentuploaded_data, $attorneyDocs),
            //  Bank Statements
            'parentBankDocuments' => self::getBankDocuments($documentuploaded_data, $clientBankDocs),
            //  PayPal, Cash App, Venmo Account Statements
            'parentPaypalVenmoCashDocuments' => self::getPaypalVenmoCashDocuments($documentuploaded_data, $clientBankDocs),
            //  Brokerage Account Statements
            'parentBrokerageDocuments' => self::getBrokerageDocuments($documentuploaded_data, $clientBankDocs),
            //  Requested Documents
            'parentRequestedDocuments' => self::getRequestedDocuments($documentuploaded_data, $clientBankDocs, $adminDocuments),
        ];
        // dd($trusteeForms);
        if (in_array($attorneyId, [54695, 53145, 55270]) || in_array(env('APP_ENV'), ['local', 'development'])) {
            //  Petition/Trustee Forms
            $structure['parentFormDocuments'] = self::getFormDocuments($localForms, $trusteeForms);
        }

        return $obj + $structure;
    }

    public static function getDocTypeNameForUploadedScreen($debtorname, $spousename, $attorney_id, $clientBankDocs, $attorneyDocs, $adminDocuments, $mortgageUpdatedNames, $vehicleUpdatedNames, $post_submission_documents_enabled, $clientPSDocuments)
    {
        $arr = [

            ClientDocumentUploaded::DRIVING_LIC => "Debtor’s Drivers Lic./Gov. ID",
            ClientDocumentUploaded::SOCIAL_SECURITY_CARD => "Debtor’s Social Security Card/ITIN",
            ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC => "Co-Debtor’s Drivers Lic./Gov. ID",
            ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD => "Co-Debtor’s Social Security Card/ITIN",

            ClientDocumentUploaded::VEHICLE_REGISTRATION => "Vehicle Registration",
            ClientDocumentUploaded::INSURANCE_DOCUMENTS => "Proof of Auto Insurance",

            "Debtor_Creditor_Report" => "Debtor(s) Credit Reports",
            "Other_Misc_Documents" => "Debt(s)/Collection Statements",

            ClientDocumentUploaded::DEBTOR_PAY_STUB => "Debtor Pay Stubs (Past 7 Months)",
            ClientDocumentUploaded::CO_DEBTOR_PAY_STUB => "Co-Debtor Pay Stubs (Past 7 Months)",

            "Miscellaneous_Documents" => "Additional or Unlisted Documents",
        ];

        $taxDocs = ClientDocumentUploaded::getCommonDocumentForAttorney($attorney_id);
        unset($taxDocs['Debtor_Taxes']);

        $ResidenceKeyValue = ClientDocumentUploaded::getResidenceKeyValue(1);
        if (!empty($mortgageUpdatedNames)) {
            foreach ($mortgageUpdatedNames as $key => $name) {
                $ResidenceKeyValue[$key] = $name;
            }
        }

        $AutoloanKeyValue = ClientDocumentUploaded::getAutoloanKeyValue(1);
        if (!empty($vehicleUpdatedNames)) {
            foreach ($vehicleUpdatedNames as $key => $name) {
                $AutoloanKeyValue[$key] = $name;
            }
        }
        $arr = $arr + $taxDocs + $ResidenceKeyValue + $AutoloanKeyValue;

        $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
        if (!empty($unpaid_wages)) {
            $arr = $arr + $unpaid_wages;
        }

        $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
        if (!empty($retirement_pension)) {
            $arr = $arr + $retirement_pension;
        }

        $bank = $clientBankDocs['bank'] ?? [];
        if (!empty($bank)) {
            $arr = $arr + $bank;
        }

        $venmo_paypal_cash = $clientBankDocs['venmo_paypal_cash'] ?? [];
        if (!empty($venmo_paypal_cash)) {
            $arr = $arr + $venmo_paypal_cash;
        }

        $brokerage_account = $clientBankDocs['brokerage_account'] ?? [];
        if (!empty($brokerage_account)) {
            $arr = $arr + $brokerage_account;
        }

        if (!empty($adminDocuments)) {
            $arr = $arr + $adminDocuments;
        }

        $life_insurance = $clientBankDocs['life_insurance'] ?? [];
        if (!empty($life_insurance)) {
            $arr = $arr + $life_insurance;
        }

        $attDoc = [];
        $vehicle_title = $clientBankDocs['vehicle_title'] ?? [];
        foreach ($attorneyDocs as $key) {
            if (!empty($vehicle_title) && array_key_exists($key, $vehicle_title)) {
                $attDoc[$key] = $vehicle_title[$key];
            } else {
                $attDoc[$key] = $key;
            }
        }

        $arr = $arr + $attDoc;

        $arr = Helper::getUpdatedPayPalName($arr);
        $arr = ClientHelper::getUpdatedLabelName($debtorname, $spousename, $arr);

        $parentLabels = [
            "parentIdDocuments" => "Debtor(s) ID Information",
            "parentSecuredDocuments" => "Secured Debts",
            "parentUnsecuredDocuments" => "Unsecured Debts",
            "parentIncomeDocuments" => "Income Docs for Debtor(s)",
            "parentOtherIncomeDocuments" => "Other Incomes",
            "parentTaxesDocuments" => "Debtor(s) Taxes",
            "parentRetirementDocuments" => "Retirement Docs",
            "parentMiscAttorneyDocuments" => "Additional or Unlisted/Attorney Documents",
            "parentBankDocuments" => "Bank Statements",
            "parentPaypalVenmoCashDocuments" => "PayPal, Cash App, Venmo Account Statements",
            "parentBrokerageDocuments" => "Brokerage Account Statements",
            "parentRequestedDocuments" => "Requested Documents",
            "parentFormDocuments" => "Petition/Trustee Forms",
        ];

        if ($post_submission_documents_enabled) {
            $parentLabels[ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS] = "Post submission documents";
            if ($clientPSDocuments) {
                foreach ($clientPSDocuments as $key => $document) {
                    $parentLabels[Helper::validate_key_value('document_name', $document)] = Helper::validate_key_value('document_type', $document);
                }
            }
        }

        $formArr = [
            "LocalForms" => "Local Forms",
            "TrusteeForms" => "Trustee Forms",
        ];

        $finalList = $parentLabels + $arr + $formArr;

        return self::cleanDocumentLabels($finalList);
    }

    public static function getDocumentUploadedData($client_id)
    {
        return ClientDocumentUploaded::where("client_id", $client_id)
            ->select(
                'id',
                'relate_to_document',
                'document_file',
                'document_month',
                'is_uploaded_to_s3',
                'file_s3_url',
                'document_type',
                'document_status',
                'mime_type',
                'updated_name',
                'document_decline_reason',
                'added_by_attorney',
                'is_viewed_by_attorney',
                'sort_order',
                'creditor_value',
                'created_on'
            )
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'DESC');
    }

    public static function getParentPostSubmissionDocuments($docs, $clientPSDocuments)
    {

        $sample = [
            ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => self::getDocumentObject(clone $docs, ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS),
        ];

        if ($clientPSDocuments) {
            foreach ($clientPSDocuments as $key => $document) {
                $dType = Helper::validate_key_value('document_name', $document);
                $sample[$dType] = self::getDocumentObject(clone $docs, $dType);
            }
        }

        return $sample;
    }

    public static function getParentIdDocuments($docs, $clientType)
    {
        $sample = [
            ClientDocumentUploaded::DRIVING_LIC => self::getDocumentObject(clone $docs, ClientDocumentUploaded::DRIVING_LIC, true),
            ClientDocumentUploaded::SOCIAL_SECURITY_CARD => self::getDocumentObject(clone $docs, ClientDocumentUploaded::SOCIAL_SECURITY_CARD, true),
        ];

        if ($clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
            $sample[ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC] = self::getDocumentObject(clone $docs, ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC, true);
            $sample[ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD] = self::getDocumentObject(clone $docs, ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD, true);
        }

        return $sample;
    }

    public static function getSecuredDocuments($docs, $propertyData, $vehicleData)
    {


        $mortgageObject = [];
        if (!empty($propertyData)) {
            foreach ($propertyData as $parentKey => $parentObject) {
                $parentKeyData = [];
                if (!empty($parentObject) && is_array($parentObject)) {
                    foreach ($parentObject as $key => $name) {
                        $parentKeyData[$key] = self::getDocumentObject(clone $docs, $key, true);
                    }
                    $mortgageObject[$parentKey] = $parentKeyData;
                }
            }
        }

        $vehicleObject = [];
        if (!empty($vehicleData)) {
            foreach ($vehicleData as $parentKey => $parentObject) {
                $parentKeyData = [];
                if (!empty($parentObject) && is_array($parentObject)) {
                    foreach ($parentObject as $key => $name) {
                        $parentKeyData[$key] = self::getDocumentObject(clone $docs, $key, true);
                    }
                    $vehicleObject[$parentKey] = $parentKeyData;
                }
                if ($parentKey == 'Insurance_Documents') {
                    $vehicleObject[$parentKey]['Insurance_Documents'] = self::getDocumentObject(clone $docs, 'Insurance_Documents');
                }
            }
        }

        $sample = [
            'Current_Mortgage_Statement' => $mortgageObject,
            'Current_Auto_Loan_Statement' => $vehicleObject,
        ];

        return $sample;
    }

    public static function getUnsecuredDocuments($docs)
    {
        $sample = [
            [
                'Debtor_Creditor_Report' => self::getDocumentObject(clone $docs, 'Debtor_Creditor_Report'),
                'Other_Misc_Documents' => self::getDocumentObject(clone $docs, 'Other_Misc_Documents'),
            ]
        ];

        return $sample;
    }


    public static function getIncomeDocuments($docs)
    {
        $sample = [
            ClientDocumentUploaded::DEBTOR_PAY_STUB => self::getDocumentObject(clone $docs, ClientDocumentUploaded::DEBTOR_PAY_STUB),
            ClientDocumentUploaded::CO_DEBTOR_PAY_STUB => self::getDocumentObject(clone $docs, ClientDocumentUploaded::CO_DEBTOR_PAY_STUB),
        ];

        return $sample;
    }

    public static function getOtherIncomeDocuments($docs, $clientBankDocs)
    {

        $sample = [];

        $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
        if (!empty($unpaid_wages)) {
            foreach ($unpaid_wages as $key => $object) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        return $sample;
    }

    public static function getTaxesDocuments($docs)
    {
        $sample = [
            ClientDocumentUploaded::LAST_YR_TAX_RETURNS => self::getDocumentObject(clone $docs, ClientDocumentUploaded::LAST_YR_TAX_RETURNS),
            ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS => self::getDocumentObject(clone $docs, ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS),
            ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS => self::getDocumentObject(clone $docs, ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS),
            ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS => self::getDocumentObject(clone $docs, ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS),
            ClientDocumentUploaded::W2_LAST_YEAR => self::getDocumentObject(clone $docs, ClientDocumentUploaded::W2_LAST_YEAR),
            ClientDocumentUploaded::W2_YEAR_BEFORE => self::getDocumentObject(clone $docs, ClientDocumentUploaded::W2_YEAR_BEFORE),
        ];

        return $sample;
    }

    public static function getRetirementDocuments($docs, $clientBankDocs)
    {
        $sample = [];
        $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
        if (!empty($retirement_pension)) {

            $retirement_pension = array_keys($retirement_pension);

            foreach ($retirement_pension as $key) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        return $sample;
    }

    public static function getMiscAttorneyDocuments($docs, $attorneyDocs)
    {
        $miscObj = [];
        $miscObj['Miscellaneous_Documents'] = self::getDocumentObject(clone $docs, 'Miscellaneous_Documents');
        foreach ($attorneyDocs as $key) {
            $miscObj[$key] = self::getDocumentObject(clone $docs, $key);
        }

        $sample = [
            'Miscellaneous_Documents' => $miscObj,
        ];

        return $sample;
    }

    public static function getBankDocuments($docs, $clientBankDocs)
    {
        $sample = [];
        $bank = $clientBankDocs['bank'] ?? [];
        if (!empty($bank)) {

            $bank = array_keys($bank);

            foreach ($bank as $key) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        return $sample;
    }

    public static function getPaypalVenmoCashDocuments($docs, $clientBankDocs)
    {
        $sample = [];
        $venmo_paypal_cash = $clientBankDocs['venmo_paypal_cash'] ?? [];
        if (!empty($venmo_paypal_cash)) {

            $venmo_paypal_cash = array_keys($venmo_paypal_cash);

            foreach ($venmo_paypal_cash as $key) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        return $sample;
    }

    public static function getBrokerageDocuments($docs, $clientBankDocs)
    {
        $sample = [];
        $brokerage_account = $clientBankDocs['brokerage_account'] ?? [];
        if (!empty($brokerage_account)) {

            $brokerage_account = array_keys($brokerage_account);

            foreach ($brokerage_account as $key) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        return $sample;
    }


    public static function getRequestedDocuments($docs, $clientBankDocs, $adminDocuments)
    {
        $sample = [];

        if (!empty($adminDocuments)) {

            $adminDocuments = array_keys($adminDocuments);

            foreach ($adminDocuments as $key) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        $life_insurance = $clientBankDocs['life_insurance'] ?? [];
        if (!empty($life_insurance)) {

            $life_insurance = array_keys($life_insurance);

            foreach ($life_insurance as $key) {
                $sample[$key] = self::getDocumentObject(clone $docs, $key);
            }
        }

        return $sample;
    }

    public static function getDocumentObject($docs, $key, $first = false)
    {

        $docs = $docs->where('document_type', $key);

        if ($first) {
            $docs = $docs->first();
            $docs = isset($docs) && !empty($docs) ? $docs->toArray() : [];

            return !empty($docs) ? [$docs] : [];
        } else {
            $docs = $docs->get();
            $docs = isset($docs) && !empty($docs) ? $docs->toArray() : [];

            return $docs;
        }
    }

    public static function getFormDocuments($localForms, $trusteeForms)
    {
        $sample = [];
        if (!empty($localForms)) {
            $sample['LocalForms'] = $localForms;
        }


        $sample['TrusteeForms'] = $trusteeForms;


        return $sample;
    }

    public static function getAttorneyDocumentTypes($attorneyId)
    {
        $attorneyDocuments = \App\Models\AttorneyDocuments::orderBy('id', 'DESC')->where('attorney_id', $attorneyId)->get();
        $attorneyDocuments = !empty($attorneyDocuments) ? $attorneyDocuments->toArray() : [];

        return  array_column($attorneyDocuments, 'document_type');
    }

    public static function getExcludedDocs($attorneyId, $id, $user)
    {
        $excludeDocs = \App\Models\AttorneyExcludeDocs::where('attorney_id', $attorneyId)->first();
        $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];

        $AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where(['attorney_id' => $attorneyId, 'client_id' => $id])->first();
        $AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient) ? $AttorneyExcludeDocsPerClient->toArray() : [];
        $docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
        $docJsonPerClient = json_decode($docJsonPerClient) ?? [];
        if (!empty($vehicleUpdatedNames)) {
            $autoloanKeys = array_keys(\App\Models\ClientDocumentUploaded::getAutoloanKeyValue(1));
            $docJsonPerClient = array_diff($docJsonPerClient, $autoloanKeys);
        }
        if (!empty($mortgageUpdatedNames)) {
            $mortgageKeys = array_keys(\App\Models\ClientDocumentUploaded::getResidenceKeyValue(1));
            $docJsonPerClient = array_diff($docJsonPerClient, $mortgageKeys);
        }
        $mergedArray = array_merge($excludeDocs, $docJsonPerClient);
        $excludeDocs = array_unique($mergedArray);

        $incomeData = CacheIncome::getIncomeData($id);
        $D1Data = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        $D2Data = Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');

        $hasDebtorEmployer = ClientHelper::getEmployerStatus($D1Data, 1);
        $hasCodebtorEmployer = ClientHelper::getEmployerStatus($D2Data, 2);

        if ($hasDebtorEmployer) {
            $excludeDocs = array_filter($excludeDocs, function ($item) {
                return $item !== "Debtor_Pay_Stubs";
            });
            $excludeDocs = array_values($excludeDocs);
        }
        if ($hasCodebtorEmployer) {
            $excludeDocs = array_filter($excludeDocs, function ($item) {
                return $item !== "Co_Debtor_Pay_Stubs";
            });
            $excludeDocs = array_values($excludeDocs);
        }

        return $excludeDocs;
    }

    public static function cleanDocumentLabels($allDocs)
    {

        foreach ($allDocs as $key => $value) {
            if (strpos($value, '<span') === 0) {
                $pos = strpos($value, '&nbsp;');
                if ($pos !== false) {
                    $value = substr_replace($value, '', $pos, strlen('&nbsp;'));
                }
            }

            $allDocs[$key] = $value;
        }

        return $allDocs;
    }

    public static function getNotOwnDocs($id)
    {
        $notOwned = \App\Models\NotOwnDocuments::where('client_id', $id)->select('document_type')->get();

        return  !empty($notOwned) ? array_column($notOwned->toArray(), 'document_type') : [];
    }

    public static function getDocumentMoveToList($client_type, $client_id, $structure, $allNames)
    {
        $list['disabled'] = '<p class="dropdown-item mb-1">Move Document to...</p>';

        foreach ($structure as $parentKey => $parentObject) {
            if (in_array($parentKey, [ 'parentOtherIncomeDocuments', 'parentTaxesDocuments', 'parentRetirementDocuments', 'parentMiscAttorneyDocuments', 'parentBankDocuments', 'parentPaypalVenmoCashDocuments', 'parentBrokerageDocuments', 'parentRequestedDocuments'])) {
                $list[$parentKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">'.Helper::validate_key_value($parentKey, $allNames).':</p>';
            }
            if ($parentKey == 'parentUnsecuredDocuments') {
                $list[$parentKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">Debts:</p>';
            }
            if (is_array($parentObject)) {
                foreach ($parentObject as $childKey => $childObject) {

                    if (in_array($parentKey, ['parentIdDocuments','parentIncomeDocuments'])) {
                        switch ($childKey) {
                            case 'Drivers_License':
                                $list['Drivers_License_option'] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">Debtor DL/SSN Docs:</p>';
                                break;
                            case 'Co_Debtor_Drivers_License':
                                $list['Co_Debtor_Drivers_License_option'] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">Co-Debtor DL/SSN Docs:</p>';
                                break;
                            case 'Debtor_Pay_Stubs':
                                $list[$childKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">Employer(s) for Debtor:</p>';
                                break;
                            case 'Co_Debtor_Pay_Stubs':
                                $list[$childKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">Employer(s) for Co-Debtor:</p>';
                                if ($client_type == 2) {
                                    $list[$childKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">Employer(s) for Non-Filing Spouse:</p>';
                                }
                                break;
                            default:
                                $list[$childKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">'.Helper::validate_key_value($childKey, $allNames).':</p>';
                                break;
                        }
                    }
                    if (
                        (in_array($parentKey, ['parentSecuredDocuments', 'parentUnsecuredDocuments', 'parentMiscAttorneyDocuments']))
                        && is_array($childObject)
                    ) {
                        foreach ($childObject as $subChildKey => $subChildObject) {
                            if (in_array($parentKey, ['parentUnsecuredDocuments', 'parentMiscAttorneyDocuments'])) {
                                $list[$subChildKey] = '<p class="dropdown-item mb-1" onclick="move_this_document_to(this)" data-value="'.$subChildKey.'">'.Helper::validate_key_value($subChildKey, $allNames).'</p>';
                            } else {
                                $list[$subChildKey] = '<p class="dropdown-item text-bold mb-1 font-italic bg-gray text-black-i">'.Helper::validate_key_value($subChildKey, $allNames).':</p>';
                            }
                            if (is_array($subChildObject) && !in_array($parentKey, ['parentUnsecuredDocuments', 'parentMiscAttorneyDocuments'])) {
                                foreach ($subChildObject as $docKey => $docs) {
                                    $list[$docKey] = '<p class="dropdown-item mb-1" onclick="move_this_document_to(this)" data-value="'.$docKey.'">'.Helper::validate_key_value($docKey, $allNames).'</p>';
                                }
                            }
                        }
                    }

                    if (in_array($parentKey, ['parentIdDocuments', 'parentTaxesDocuments', 'parentOtherIncomeDocuments', 'parentRetirementDocuments', 'parentBankDocuments', 'parentPaypalVenmoCashDocuments', 'parentBrokerageDocuments', 'parentRequestedDocuments'])) {
                        $list[$childKey] = '<p class="dropdown-item mb-1" onclick="move_this_document_to(this)" data-value="'.$childKey.'">'.Helper::validate_key_value($childKey, $allNames).'</p>';
                    }

                    if (in_array($parentKey, ['parentIncomeDocuments'])) {
                        $getBothEmployerList = \App\Models\ClientDocuments::getBothEmployerList($client_id);
                        $debtorEmployerList = !empty(Helper::validate_key_value('debtorEmployerList', $getBothEmployerList)) ? Helper::validate_key_value('debtorEmployerList', $getBothEmployerList) : [];
                        $codebtorEmployerList = !empty(Helper::validate_key_value('codebtorEmployerList', $getBothEmployerList)) ? Helper::validate_key_value('codebtorEmployerList', $getBothEmployerList) : [];

                        if ($childKey == 'Debtor_Pay_Stubs' && !empty($debtorEmployerList)) {
                            foreach ($debtorEmployerList as $index => $employer) {
                                $list[$childKey.$index] = "<p class='dropdown-item mb-1 text-bold' onclick='move_this_document_to(this)' data-value='".$childKey."' data-empid='".Helper::validate_key_value('id', $employer, 'radio')."'>".Helper::validate_key_value('employer_name', $employer)."</p>";
                            }
                        }

                        if ($childKey == 'Co_Debtor_Pay_Stubs' && !empty($codebtorEmployerList)) {
                            foreach ($codebtorEmployerList as $index => $employer) {
                                $list[$childKey.$index] = "<p class='dropdown-item mb-1 text-bold' onclick='move_this_document_to(this)' data-value='".$childKey."' data-empid='".Helper::validate_key_value('id', $employer, 'radio')."'>".Helper::validate_key_value('employer_name', $employer)."</p>";
                            }
                        }
                    }
                }
            }
        }

        return $list;
    }

    public static function getDebtsList($id)
    {
        $final_debts = self::getDebtsArray($id);

        if (!empty($final_debts['debt_tax'])) {
            usort($final_debts['debt_tax'], function ($a, $b) {
                return strcmp($a['creditor_name'], $b['creditor_name']);
            });
        }
        if (!empty($final_debts['back_tax_own'])) {
            usort($final_debts['back_tax_own'], function ($a, $b) {
                return strcmp($a['debt_state'], $b['debt_state']);
            });
        }
        if (!empty($final_debts['domestic_tax'])) {
            usort($final_debts['domestic_tax'], function ($a, $b) {
                return strcmp($a['domestic_support_name'], $b['domestic_support_name']);
            });
        }
        if (!empty($final_debts['additional_liens_data'])) {
            usort($final_debts['additional_liens_data'], function ($a, $b) {
                return strcmp($a['domestic_support_name'], $b['domestic_support_name']);
            });
        }

        return $final_debts;
    }

    public static function getDebtsArray($client_id)
    {
        return CacheDebt::getDebtData($client_id);
    }

    public static function getAssignedPaystubDocIds($type, $client_id)
    {
        $docIds = \App\Models\PayStubs::where(['pinwheel_account_type' => $type, 'client_id' => $client_id])->whereNotNull('document_id')->where('document_id', '!=', '')->select(['document_id'])->get();
        $docIds = !empty($docIds) ? $docIds->toArray() : [];
        if (!empty($docIds)) {
            return array_column($docIds, 'document_id');
        }

        return [];
    }

    public static function uploadVehiclePropertyValueDocument($vehicle_property_value_document, $dataID)
    {
        foreach ($vehicle_property_value_document as $index => $document) {

            // Validate that document is a valid uploaded file
            if (!$document || !$document->isValid()) {
                Log::warning("Invalid file upload for vehicle document at index {$index}");
                continue;
            }

            try {
                // Generate filename with original extension
                $filename = time() . '_' . $document->getClientOriginalName();

                // Define directory path (without filename)
                $directory = "intakeForm/{$dataID}/vehicle/{$index}/";

                // Store file to S3 bucket - storeAs returns the full path
                $document->storeAs($directory, $filename, 's3');

                Log::info("Vehicle document uploaded successfully", [
                    'client_id' => $dataID,
                    'index' => $index,
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to upload vehicle document at index {$index}", [
                    'client_id' => $dataID,
                    'error' => $e->getMessage()
                ]);
                // Continue with next file instead of stopping entire process
                continue;
            }
        }

    }
}
