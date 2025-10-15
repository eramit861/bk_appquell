<?php

namespace App\Models;

use App\Helpers\ClientHelper;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Helpers\DocumentHelper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use App\Traits\Common; // Trait
use Storage;
use Illuminate\Support\Facades\DB;

class ClientDocumentUploadedData extends Model
{
    use Common;

    public function getClientUploadDocData($id, $attorneyId, $viewed_doc_type = '')
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $id)->first();

        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorneyId = $attorney->attorney_id;
        }
        $clientBankDocs = \App\Models\ClientDocuments::getClientDocs($id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->first();
        $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];

        $attorneyDocs = self::getAttorneyDocumentTypes($id, $attorneyId, $excludeDocs);

        $attorneySettings = AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['bank_statement_months', 'attorney_enabled_bank_statment','is_car_title_enabled','is_rental_agreement_enabled'])->first();
        $bank_statement_months = !empty($attorneySettings) ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';
        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings) : 1;
        //$documentuploaded_data = ClientDocumentUploaded::where("client_id", $id)->select('id', 'relate_to_document', 'document_file', 'document_month', 'is_uploaded_to_s3', 'file_s3_url', 'document_type', 'document_status', 'mime_type', 'updated_name', 'document_decline_reason', 'added_by_attorney', 'sort_order', 'creditor_value','is_viewed_by_attorney')->orderBy('sort_order', 'asc')->orderBy('id', 'DESC')->get();
        $documentuploaded_data = ClientDocumentUploaded::where("client_id", $id)->select('id', 'relate_to_document', 'document_file', 'document_month', 'is_uploaded_to_s3', 'file_s3_url', 'document_type', 'document_status', 'mime_type', 'updated_name', 'document_decline_reason', 'added_by_attorney', 'sort_order', 'creditor_value', 'is_viewed_by_attorney', 'is_generated_thumbnails')->orderBy('sort_order', 'asc')->orderByRaw("CASE WHEN document_type IN ('Last_Year_Tax_Returns', 'Prior_Year_Tax_Returns', 'Prior_Year_Two_Tax_Returns', 'Prior_Year_Three_Tax_Returns', 'Miscellaneous_Documents') THEN id ELSE NULL END ASC")->orderBy('id', 'DESC')->get();
        $documentuploaded_data = !empty($documentuploaded_data) ? $documentuploaded_data->toArray() : [];
        $propertyValueDocType = $this->getValuetype($documentuploaded_data, 'document_type', ['Autoloan_property_value', 'Mortgage_property_value']);

        $user = \App\Models\User::where('id', $id)->first();
        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $id)->pluck('document_name', 'document_type')->all();
        $editable = \App\Models\FormsStepsCompleted::select('can_edit')->where('client_id', $id)->first();
        $total = $this->getClientCompletedStepsCount($id);

        $documentTypes = Helper::getDocumentsForAttorneySide($user->client_type, $attorneyId);
        $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
        if (!empty($unpaid_wages)) {
            $documentTypes = self::addClientOtherIncomeDocumentToList($documentTypes, $unpaid_wages);
        }

        $documentTypes = $documentTypes + ClientDocumentUploaded::getCommonDocumentForAttorney($attorneyId);
        $settings = new \App\Models\ClientSettings();
        $clientSettings = $settings->getclientSettings($id, ['post_submission_documents_enabled']);
        $post_submission_documents_enabled = $clientSettings->post_submission_documents_enabled ?? 0;
        if ($post_submission_documents_enabled) {
            $documentTypes = [ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"] + $documentTypes;
        }
        $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
        if (!empty($retirement_pension)) {
            $documentTypes = self::addRetirementPensionIncomeDocumentToList($documentTypes, $retirement_pension);
        }
        $documentTypes = $documentTypes + ["misc_attorney_docs" => "Additional or Unlisted/Attorney Documents", ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS => "Additional or Unlisted Documents"];
        $documentkeys = array_column($documentuploaded_data, 'document_type');

        $BIData = CacheBasicInfo::getBasicInformationData($id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($user->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $clientPropertyData = CacheProperty::getPropertyData($id);
        $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty);
        $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
        $documentTypes = array_merge($documentTypes, $mortgageUpdatedNames);

        $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($id);
        $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
        $documentTypes = array_merge($documentTypes, $vehicleUpdatedNames);

        $documentTypes = $this->setPaystuAccordintToDebtor($documentTypes, $user->client_payroll_assistant, $user->client_type, $user->client_subscription, 1);
        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;


        $vehicle_title = $is_car_title_enabled ? ($clientBankDocs['vehicle_title'] ?? []) : [];
        $rental_agreement = $is_rental_agreement_enabled ? ($clientBankDocs['rental_agreement'] ?? []) : [];
        if (!empty($vehicle_title)) {
            $attorneyDocs = array_merge($attorneyDocs, array_keys($vehicle_title));
        }
        if (!empty($rental_agreement)) {
            $attorneyDocs = array_merge($attorneyDocs, array_keys($rental_agreement));
        }
        $documentTypes = self::addAttorneyDocumenttolist($documentTypes, $attorneyDocs);
        if ($attorney_enabled_bank_statment == 1) {
            $documentTypes = self::addClientDocumentToList($documentTypes, $clientBankDocs);
        }

        if ($attorney_enabled_bank_statment == 1) {
            $documentTypes = self::addClientPaypalBankToList($documentTypes, $clientBankDocs);
            $documentTypes = self::addClientBrokregeBankToList($documentTypes, $clientBankDocs);
        }

        $documentTypes = self::addAdminRequestedDocumentToList($documentTypes, $clientBankDocs, $adminDocuments);
        $adminDocs = \App\Models\ClientDocuments::getAdminRequestedDocumentList($adminDocuments, $clientBankDocs);
        //$unpaid_wages = \App\Models\ClientDocuments::getClientDocumentList($id,'unpaid_wages');

        $lifeInsuDocs = $clientBankDocs['life_insurance'] ?? [];

        $unpaid_wages = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages);
        if (!empty($lifeInsuDocs)) {
            $adminDocs = array_merge($adminDocs, array_keys($lifeInsuDocs));
        }
        $documentTypes = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $documentTypes);

        $documents = $this->getClientDocumentArray($documentTypes, $documentkeys, $documentuploaded_data, $id, $adminDocuments, $clientBankDocs, $attorneyDocs);

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_UPLOAD_CLIENT_DOCUMENT_VIDEO);

        $clientDocs = $clientBankDocs['bank'] ?? [];

        $venmoPaypalCash = $attorney_enabled_bank_statment == 1 ? ($clientBankDocs['venmo_paypal_cash'] ?? []) : [];
        $venmoPaypalCash = Helper::getUpdatedPayPalName($venmoPaypalCash);

        $brokerageAccount = $attorney_enabled_bank_statment == 1 ? ($clientBankDocs['brokerage_account'] ?? []) : [];

        $notOwned = \App\Models\NotOwnDocuments::where('client_id', $id)->select('document_type')->get();
        $notOwned = !empty($notOwned) ? array_column($notOwned->toArray(), 'document_type') : [];


        $final_debts = $this->getDebtsArray($id);

        if (!empty($final_debts['debt_tax'])) {
            usort($final_debts['debt_tax'], function ($a, $b) {
                $aName = isset($a['creditor_name']) ? $a['creditor_name'] : '';
                $bName = isset($b['creditor_name']) ? $b['creditor_name'] : '';

                return strcmp($aName, $bName);
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

        $AttorneyExcludeDocsPerClient = \App\Models\AttorneyExcludeDocsPerClient::where(['attorney_id' => $attorneyId, 'client_id' => $id])->first();
        $AttorneyExcludeDocsPerClient = !empty($AttorneyExcludeDocsPerClient) ? $AttorneyExcludeDocsPerClient->toArray() : [];
        $docJsonPerClient = Helper::validate_key_value('doc_type_json', $AttorneyExcludeDocsPerClient);
        $docJsonPerClient = json_decode($docJsonPerClient) ?? [];


        if (!empty($vehicleUpdatedNames)) {
            $autoloanKeys = array_keys(array: ClientDocumentUploaded::getAutoloanKeyValue(1));
            $docJsonPerClient = array_diff($docJsonPerClient, $autoloanKeys);
        }
        if (!empty($mortgageUpdatedNames)) {
            $mortgageKeys = array_keys(ClientDocumentUploaded::getResidenceKeyValue(1));
            $docJsonPerClient = array_diff($docJsonPerClient, $mortgageKeys);
        }
        $mergedArray = array_merge($excludeDocs, $docJsonPerClient);
        $excludeDocs = array_unique($mergedArray);

        \Log::info('json='.json_encode($excludeDocs));
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

        $updatedList = [];
        if (!empty($excludeDocs)) {
            foreach ($documents as $key => $doc) {
                if (!in_array($doc['document_type'], ['Current_Auto_Loan_Statement','Current_Mortgage_Statement']) && in_array($doc['document_type'], $excludeDocs)) {
                } else {
                    array_push($updatedList, $doc);
                }
            }
        } else {
            $updatedList = $documents;
        }

        $vehicleRegistration = self::getVehicleRegistrations($id);
        $encryptedid = base64_encode($attorneyId);
        $encryptedClientId = base64_encode($id);
        $linkinput['link'] = route('questionnaire') . "?token=" . $encryptedid;
        $linkinput['manual_link'] = route('manual_upload') . "?token=" . $encryptedid . "&clientToken=" . $encryptedClientId;
        $linkinput['attorney_id'] = $attorneyId;
        $linkinput['link_for'] = 'manual';
        $manual_doc_url = \App\Models\ShortLink::getSetLink($linkinput, $attorneyId);
        $notIn = ['document_sign', 'signed_document'];

        $unreadDocuments = ClientDocumentUploaded::where(['client_id' => $id, 'is_viewed_by_attorney' => 0])
        ->whereIn('document_type', array_keys($documentTypes))
        ->whereNotIn('document_type', $notIn)
        ->pluck('document_type')
        ->toArray();

        $zip_download_status = \App\Models\DoctoZipFileScheduler::where(['client_id' => $id])->first();

        $bank_account_documents = $attorney_enabled_bank_statment == 1 ? \App\Models\ClientDocuments::getClientBankDocumentList($id) : [];

        $debtorPaystubStatus = \App\Models\AttorneyEmployerInformationToClient::getMissingPaystubList($id, 'debtor');
        $coDebtorPaystubStatus = \App\Models\AttorneyEmployerInformationToClient::getMissingPaystubList($id, 'codebtor');

        $savedRequestedDocs = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $id])->select('requested_documents')->first();
        $requestedDocuments = Helper::validate_key_value('requested_documents', $savedRequestedDocs);
        $requestedDocuments = !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];
        $paystubAssignedDocIdsSelf = self::getAssignedPaystubDocIds('self', $id);
        $paystubAssignedDocIdsSpouse = self::getAssignedPaystubDocIds('spouse', $id);
        $documentTypes = Helper::getUpdatedPayPalName($documentTypes);
        $updatedList = self::getUpdatedPayPalNameFromUploadedList($updatedList);

        $d1HasEmployers = \App\Models\AttorneyEmployerInformationToClient::hasAnyEmployer($id, $attorneyId, 1);
        $d2HasEmployers = \App\Models\AttorneyEmployerInformationToClient::hasAnyEmployer($id, $attorneyId, 2);
        if (!empty($viewed_doc_type)) {
            ClientDocumentUploaded::where(["client_id" => $id,'document_type' => $viewed_doc_type])->update(['is_viewed_by_attorney' => 1]);
        }

        return ['d1HasEmployers' => $d1HasEmployers, 'd2HasEmployers' => $d2HasEmployers,'unpaid_wages' => $unpaid_wages, 'paystubAssignedDocIdsSelf' => $paystubAssignedDocIdsSelf, 'paystubAssignedDocIdsSpouse' => $paystubAssignedDocIdsSpouse, 'post_submission_documents_enabled' => $post_submission_documents_enabled, 'venmoPaypalCash' => $venmoPaypalCash, 'brokerageAccount' => $brokerageAccount, 'debtorPaystubStatus' => $debtorPaystubStatus, 'coDebtorPaystubStatus' => $coDebtorPaystubStatus, 'zip_download_status' => $zip_download_status, 'vehicleRegistration' => $vehicleRegistration, 'unreadDocuments' => $unreadDocuments, 'final_debts' => $final_debts, 'manual_doc_url' => $manual_doc_url, 'notOwned' => $notOwned, 'attorneyDocs' => $attorneyDocs, 'clientDocs' => $clientDocs, 'adminDocs' => $adminDocs, 'video' => $video, 'client_id' => $id, 'client' => true, 'documentuploaded' => $updatedList, 'propertyValueDocType' => $propertyValueDocType, 'client_type' => ($user->client_type), 'User' => $user, 'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0), 'type' => 'documents', 'totals' => $total, 'bank_statement_months' => $bank_statement_months, 'bank_account_documents' => $bank_account_documents, 'requestedDocuments' => $requestedDocuments,'retirement_pension' => $retirement_pension];

    }

    public static function getUnreadDocumentsData($user, $id, $attorneyId)
    {
        $clientBankDocs = \App\Models\ClientDocuments::getClientDocs($id);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($id);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorneyId;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $excludeDocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->first();
        $excludeDocs = !empty(json_decode($excludeDocs)) && !empty($excludeDocs->doc_type_json) ? json_decode($excludeDocs->doc_type_json, 1) : [];

        $attorneyDocs = self::getAttorneyDocumentTypes($id, $attorneyId, $excludeDocs);

        $attorneySettings = AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['bank_statement_months', 'attorney_enabled_bank_statment','is_car_title_enabled','is_rental_agreement_enabled'])->first();
        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings) : 1;


        $documentTypes = Helper::getDocumentsForAttorneySide($user->client_type, $attorneyId);
        $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
        if (!empty($unpaid_wages)) {
            $documentTypes = self::addClientOtherIncomeDocumentToList($documentTypes, $unpaid_wages);
        }

        $documentTypes = $documentTypes + ClientDocumentUploaded::getCommonDocumentForAttorney($attorneyId);
        $settings = new \App\Models\ClientSettings();
        $clientSettings = $settings->getclientSettings($id, ['post_submission_documents_enabled']);
        $post_submission_documents_enabled = $clientSettings->post_submission_documents_enabled ?? 0;
        if ($post_submission_documents_enabled) {
            $documentTypes = [ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS => "Post submission documents"] + $documentTypes;
        }
        $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
        if (!empty($retirement_pension)) {
            $documentTypes = self::addRetirementPensionIncomeDocumentToList($documentTypes, $retirement_pension);
        }
        $documentTypes = $documentTypes + ["misc_attorney_docs" => "Additional or Unlisted/Attorney Documents", ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS => "Additional or Unlisted Documents"];
        $BIData = CacheBasicInfo::getBasicInformationData($id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($user->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $clientPropertyData = CacheProperty::getPropertyData($id);
        $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty);
        $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
        $documentTypes = array_merge($documentTypes, $mortgageUpdatedNames);

        $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($id);
        $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
        $documentTypes = array_merge($documentTypes, $vehicleUpdatedNames);

        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;


        $vehicle_title = $is_car_title_enabled ? ($clientBankDocs['vehicle_title'] ?? []) : [];
        $rental_agreement = $is_rental_agreement_enabled ? ($clientBankDocs['rental_agreement'] ?? []) : [];
        if (!empty($vehicle_title)) {
            $attorneyDocs = array_merge($attorneyDocs, array_keys($vehicle_title));
        }
        if (!empty($rental_agreement)) {
            $attorneyDocs = array_merge($attorneyDocs, array_keys($rental_agreement));
        }

        $documentTypes = self::addAttorneyDocumenttolist($documentTypes, $attorneyDocs);
        if ($attorney_enabled_bank_statment == 1) {
            $documentTypes = self::addClientDocumentToList($documentTypes, $clientBankDocs);
        }

        if ($attorney_enabled_bank_statment == 1) {
            $documentTypes = self::addClientPaypalBankToList($documentTypes, $clientBankDocs);
            $documentTypes = self::addClientBrokregeBankToList($documentTypes, $clientBankDocs);
        }

        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $id)->pluck('document_name', 'document_type')->all();
        $documentTypes = self::addAdminRequestedDocumentToList($documentTypes, $clientBankDocs, $adminDocuments);
        $documentTypes = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $documentTypes);

        $notIn = ['document_sign', 'signed_document'];

        $documentTypes = Helper::getUpdatedPayPalName($documentTypes);

        $unreadDocuments = ClientDocumentUploaded::where(['client_id' => $id, 'is_viewed_by_attorney' => 0])
        ->whereIn('document_type', array_keys($documentTypes))
        ->whereNotIn('document_type', $notIn)
        ->pluck('document_type')
        ->toArray();


        return $unreadDocuments;

    }

    private static function getAttorneyDocumentTypes($client_id, $attorneyId, $excludeDocs)
    {
        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $queryCondition = [ 'attorney_id' => $attorneyId, 'is_associate' => 0 ];

        if (!empty($ClientsAssociateId)) {
            $attorneyId = $ClientsAssociateId;
            $queryCondition = [ 'attorney_id' => $attorneyId, 'is_associate' => 1 ];
        }

        $attorneyDocuments = \App\Models\AttorneyDocuments::orderBy('id', 'DESC')->where($queryCondition)->get();
        $attorneyCommonDocuments = ClientDocuments::getClientDocs($client_id, 'attorney_common_doc');
        $attorneyDocuments = !empty($attorneyDocuments) ? $attorneyDocuments->toArray() : [];
        $attorneyDocuments = array_column($attorneyDocuments, 'document_type');
        $attorneyCommonDocuments = !empty($attorneyCommonDocuments) ? array_keys($attorneyCommonDocuments) : [];
        $attorneyDocuments = array_merge($attorneyDocuments, $attorneyCommonDocuments);

        return  $attorneyDocuments ;
    }

    private function getValuetype($array, $column, $value)
    {
        return array_filter($array, function ($element) use ($column, $value) {
            return isset($element[$column]) && in_array($element[$column], $value);
        });
    }
    protected function getClientCompletedStepsCount($id)
    {
        $form_completed_clients = \App\Models\FormsStepsCompleted::where('client_id', $id)->select('client_id', DB::raw('SUM(step1+step2+step3+step4+step5+step6) as Total'))->groupBy('client_id')->get()->pluck('Total', 'client_id')->toArray();
        $total = isset($form_completed_clients[$id]) ? $form_completed_clients[$id] : 0;

        return $total;
    }

    private static function addAttorneyDocumenttolist($documentTypes, $attorneyDocuments)
    {
        $attorneyDocumentArray = [];
        if (!empty($attorneyDocuments)) {
            foreach ($attorneyDocuments as $val) {
                $doc_type = Helper::validate_doc_type($val);
                $attorneyDocumentArray[$doc_type] = $val;
            }
        }

        return !empty($attorneyDocuments) ? $documentTypes + $attorneyDocumentArray : $documentTypes;
    }

    private static function addClientDocumentToList($documentList, $clientBankDocs)
    {
        $clientDocumentArray = $clientBankDocs['bank'] ?? [];
        $bankstatement = [
            'bank_statements' => 'Bank Statements'
        ];

        return !empty($clientDocumentArray) ? $documentList + $bankstatement + $clientDocumentArray : $documentList;
    }

    private static function addClientOtherIncomeDocumentToList($documentList, $clientDocumentArray)
    {
        $bankstatement = [
            'other_income' => 'Other Incomes'
        ];

        return !empty($clientDocumentArray) ? $documentList + $bankstatement + $clientDocumentArray : $documentList;
    }

    private static function addRetirementPensionIncomeDocumentToList($documentList, $clientDocumentArray)
    {
        $bankstatement = [
            'retirement_docs' => 'Retirement Docs'
        ];

        return !empty($clientDocumentArray) ? $documentList + $bankstatement + $clientDocumentArray : $documentList;
    }

    private static function addClientPaypalBankToList($documentList, $clientBankDocs)
    {
        $clientDocumentArray = $clientBankDocs['venmo_paypal_cash'] ?? [];
        $bankstatement = [
            'type_venmo_paypal_cash' => 'PayPal, Cash App, Venmo Account Statements'
        ];

        return !empty($clientDocumentArray) ? $documentList + $bankstatement + $clientDocumentArray : $documentList;
    }

    private static function addClientBrokregeBankToList($documentList, $clientBankDocs)
    {
        $clientDocumentArray = $clientBankDocs['brokerage_account'] ?? [];
        $bankstatement = [
            'type_brokerage_account' => 'Brokerage Account Statements'
        ];

        return !empty($clientDocumentArray) ? $documentList + $bankstatement + $clientDocumentArray : $documentList;
    }



    private static function addAdminRequestedDocumentToList($documentList, $clientBankDocs, $adminDocuments)
    {
        $bankstatement = [
            'requested_documents' => 'Requested Documents'
        ];
        $lifeInsuDocs = $clientBankDocs['life_insurance'] ?? [];

        if (!empty($lifeInsuDocs)) {
            $adminDocuments = array_merge($adminDocuments, $lifeInsuDocs);
        }


        return !empty($adminDocuments) ? $documentList + $bankstatement + $adminDocuments : $documentList;
    }





    private function getClientDocumentArray($documentTypes, $documentkeys, $documentuploaded_data, $id, $adminDocuments, $clientBankDocs, $attorneyDocs)
    {
        $clientDocs = [];
        foreach ($clientBankDocs as $key => $doc) {
            if (!in_array($key, ['life_insurance'])) {
                $clientDocs = array_merge($clientDocs, array_keys($doc));
            }
        }


        $adminDocs = \App\Models\ClientDocuments::getAdminRequestedDocumentList($adminDocuments, $clientBankDocs);
        $flag1 = $flag2 = false;
        $documents = [];

        foreach ($documentTypes as $key => $name) {
            $updatedname = '';
            $documentmonth = '';
            foreach ($documentuploaded_data as $doc) {
                if ($doc['document_type'] == $key) {
                    $updatedname = $doc['updated_name'] ?? '';
                    $documentmonth = $doc['document_month'] ?? '';
                }
            }
            $sample = [
                'id' => 0,
                'document_file' => '',
                'document_status' => 0,
                'document_decline_reason' => '',
                'added_by_attorney' => 0,
                'updated_name' => $updatedname,
                'document_type' => $key,
                'document_name' => $name,
                'document_month' => $documentmonth,
                'relate_to_document' => 0
            ];
            if (in_array($name, array_values(ClientDocumentUploaded::getResidenceKeyValue(0)))) {
                continue;
            } elseif (in_array($name, array_values(ClientDocumentUploaded::getAutoloanKeyValue(0)))) {
                continue;
            } else {
                $flag1 = $flag2 = false;
            }
            $documents[] = $this->getDocumentFiles($key, $documentkeys, $documentuploaded_data, $sample, $name, $attorneyDocs, $clientDocs, $adminDocs);
        }

        return $documents;
    }

    private function returnFlag($key, $documentkeys)
    {
        if (!in_array($key, $documentkeys)) {
            return true;
        }
    }

    private function getDocumentFiles($key, $documentkeys, $documentuploaded_data, $sample, $name, $attorneyDocs, $clientDocs, $adminDocs)
    {
        if (in_array($key, $documentkeys)) {
            $images = Helper::getArrayByKeyArray($key, $documentuploaded_data, $name, $attorneyDocs, $clientDocs, $adminDocs);
            $sample['document_name'] = $name;
            $sample['document_status'] = Helper::validate_key_value('document_status', $images);
            $sample['document_decline_reason'] = Helper::validate_key_value('document_decline_reason', $images);
            $sample['added_by_attorney'] = $images['added_by_attorney'] ?? 0;
            $sample['relate_to_document'] = $images['relate_to_document'] ?? 0;
            $sample['id'] = Helper::validate_key_value('id', $images);
            $sample['document_file'] = Helper::validate_key_value('document_file', $images);
            $sample['is_uploaded_to_s3'] = Helper::validate_key_value('is_uploaded_to_s3', $images);
            $sample['file_s3_url'] = Helper::validate_key_value('file_s3_url', $images);
            $sample['multiple'] = is_array($images) && !isset($images['id']) ? $images : [];
        }

        return $sample;
    }

    private function getDebtsArray($client_id)
    {
        return CacheDebt::getDebtData($client_id);
    }

    public static function getVehicleRegistrations($client_id)
    {
        $vehicleRegistartion = ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => ClientDocumentUploaded::VEHICLE_REGISTRATION])->get();

        return !empty($vehicleRegistartion) ? $vehicleRegistartion->toArray() : [];
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

    private function getUpdatedPayPalNameFromUploadedList($updatedList)
    {

        if (empty($updatedList)) {
            return $updatedList;
        }

        foreach ($updatedList as $index => $data) {
            $name = $data['document_name'];
            $key = $data['document_type'];
            if (in_array($key, ['paypal_account_1', 'paypal_account_2', 'paypal_account_3'])) {
                $newName = str_replace('Pay Pal', 'PayPal', $name);
                $newName = str_replace('Paypal', 'PayPal', $newName);
                $data['document_name'] = $newName;
                $updatedList[$index] = $data;
            }
        }

        return $updatedList;
    }

    public static function uploadCcCertificate($client_id, $fileresponse, $statusResponse)
    {


        $newname = Helper::validate_doc_type($statusResponse['FirstName'])."_Pre_Filing_Bankruptcy_Certificate_CCC.pdf";
        $fileContents = $fileresponse->body();
        $s3_path = 'documents/'.$client_id.'/'.$newname;
        if (!empty($fileContents)) {
            Storage::disk('s3')->put($s3_path, $fileContents);

            $mime_type = 'application/pdf';
            $url = Storage::disk('s3')->url($s3_path);
            $upload_documents = [
                'client_id' => $client_id,
                'updated_name' => $newname,
                'document_file' => $s3_path,
                'is_uploaded_to_s3' => 1,
                'file_s3_url' => $url,
                'mime_type' => $mime_type,
                'document_type' => 'Pre_Filing_Bankruptcy_Certificate_CCC',
                'added_by_attorney' => 1,
                'document_status' => 1,
                'sort_order' => 0
            ];
            ClientDocumentUploaded::create($upload_documents);

        }

    }
}
