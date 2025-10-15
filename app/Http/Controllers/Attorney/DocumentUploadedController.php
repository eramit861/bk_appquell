<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\ClientHelper;
use App\Http\Controllers\AttorneyController;
use App\Models\ClientDocumentUploaded;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\VideoHelper;
use App\Helpers\DocumentHelper;
use App\Models\AttorneyCommonDocuments;
use App\Models\AttorneyEditorData;
use App\Models\AttorneySettings;
use App\Models\ClientDocuments;
use App\Models\DocumentUploadedData;
use App\Models\Form;
use App\Models\PayStubs;
use App\Models\StateTrustee;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;
use App\Traits\Common; // Trait

class DocumentUploadedController extends AttorneyController
{
    use Common;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function client_uploaded_documents(Request $request, $id)
    {
        $attorneyId = Helper::getCurrentAttorneyId();
        if (!Helper::isClientBelongsToAttorney($id, $attorneyId)) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $attorney = \App\Models\ClientsAttorney::where("client_id", $id)->first();

        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorneyId = $attorney->attorney_id;
        }
        $clientBankDocs = \App\Models\ClientDocuments::getClientDocs($id);
        $attorneyDocs = DocumentUploadedData::getAttorneyDocumentTypes($attorneyId);
        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $attorneyId])->select(['is_rental_agreement_enabled','bank_statement_months', 'attorney_enabled_bank_statment', 'is_car_title_enabled', 'brokerage_months'])->first();
        $bank_statement_months = !empty($attorneySettings) ? Helper::validate_key_value('bank_statement_months', $attorneySettings) : '';
        $brokerage_months = !empty($attorneySettings) ? Helper::validate_key_value('brokerage_months', $attorneySettings) : '';
        $attorney_enabled_bank_statment = !empty($attorneySettings) ? Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings) : 1;
        $documentuploaded_data = ClientDocumentUploaded::where("client_id", $id)->select('id', 'relate_to_document', 'document_file', 'document_month', 'is_uploaded_to_s3', 'file_s3_url', 'document_type', 'document_status', 'mime_type', 'updated_name', 'document_decline_reason', 'added_by_attorney', 'sort_order', 'creditor_value')->orderBy('sort_order', 'asc')->orderBy('id', 'DESC')->get();
        $documentuploaded_data = !empty($documentuploaded_data) ? $documentuploaded_data->toArray() : [];
        $propertyValueDocType = $this->getValuetype($documentuploaded_data, 'document_type', ['Autoloan_property_value', 'Mortgage_property_value']);

        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;
        $rental_agreement = $is_rental_agreement_enabled ? ($clientBankDocs['rental_agreement'] ?? []) : [];
        if (!empty($rental_agreement)) {
            $attorneyDocs = array_merge($attorneyDocs, array_keys($rental_agreement));
        }

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
        $documentTypes = $documentTypes + ["misc_attorney_docs" => "Additional or Unlisted/Attorney Documents", \App\Models\ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS => "Additional or Unlisted Documents"];
        $documentkeys = array_column($documentuploaded_data, 'document_type');


        $BIData = CacheBasicInfo::getBasicInformationData($id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($user->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }

        $excludeDocs = DocumentUploadedData::getExcludedDocs($attorneyId, $id, $user);
        \Log::info('Document Types', [
            'excludeDocs' => $excludeDocs
        ]);

        $clientPropertyData = CacheProperty::getPropertyData($id);
        $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];
        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentListWithHeading($clientProperty, false, false, $id);
        $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
        $documentTypes = array_merge($documentTypes, $mortgageUpdatedNames);
        $propertyData = $clientDebtorResidentDocumentList['propertyData'] ?? [];

        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $vehicle_title = $is_car_title_enabled ? ($clientBankDocs['vehicle_title'] ?? []) : [];

        $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentListWithHeading($id, false, !empty($vehicle_title), !in_array('Vehicle_Registration', $excludeDocs));
        $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
        $documentTypes = array_merge($documentTypes, $vehicleUpdatedNames);
        $vehicleData = $clientDebtorVehiclesDocumentList['vehicleData'] ?? [];

        // for auto insurance documents Insurance_Documents , Proof of Auto Insurance
        if (!in_array('Insurance_Documents', $excludeDocs)) {
            $vehicleData['Insurance_Documents'] = 'Proof of Auto Insurance';
            $vehicleUpdatedNames['Insurance_Documents'] = 'Proof of Auto Insurance';
        }

        $documentTypes = $this->setPaystuAccordintToDebtor($documentTypes, $user->client_payroll_assistant, $user->client_type, $user->client_subscription, 1);
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


        $notOwned = DocumentUploadedData::getNotOwnDocs($id);
        $final_debts = DocumentUploadedData::getDebtsList($id);

        $updatedList = array_filter($documents, function ($doc) use ($excludeDocs) {
            return empty($excludeDocs) || !in_array($doc['document_type'], $excludeDocs);
        });


        $vehicleRegistration = self::getVehicleRegistrations($id);

        $notIn = ['document_sign', 'signed_document'];
        $unreadDocuments = \App\Models\ClientDocumentUploaded::where(['client_id' => $id, 'is_viewed_by_attorney' => 0])->whereNotIn('document_type', $notIn)->get()->toArray();

        $zip_download_status = \App\Models\DoctoZipFileScheduler::where(['client_id' => $id])->first();

        $bank_account_documents = $attorney_enabled_bank_statment == 1 ? \App\Models\ClientDocuments::getClientBankDocumentList($id) : [];

        $debtorPaystubStatus = \App\Models\AttorneyEmployerInformationToClient::getMissingPaystubList($id, 'debtor');
        $coDebtorPaystubStatus = \App\Models\AttorneyEmployerInformationToClient::getMissingPaystubList($id, 'codebtor');

        $savedRequestedDocs = \App\Models\AdminClientRequestedDocuments::where(['client_id' => $id])->select('requested_documents')->first();
        $requestedDocuments = Helper::validate_key_value('requested_documents', $savedRequestedDocs);
        $requestedDocuments = !empty($requestedDocuments) ? json_decode($requestedDocuments, true) : [];
        $paystubAssignedDocIdsSelf = DocumentUploadedData::getAssignedPaystubDocIds('self', $id);
        $paystubAssignedDocIdsSpouse = DocumentUploadedData::getAssignedPaystubDocIds('spouse', $id);
        $documentTypes = Helper::getUpdatedPayPalName($documentTypes);
        $updatedList = self::getUpdatedPayPalNameFromUploadedList($updatedList);
        $d1HasEmployers = \App\Models\AttorneyEmployerInformationToClient::hasAnyEmployer($id, $attorneyId, 1);
        $d2HasEmployers = \App\Models\AttorneyEmployerInformationToClient::hasAnyEmployer($id, $attorneyId, 2);
        $manual_doc_url = self::getManualUrl($attorneyId, $id);

        $post_submission_documents_enabled = $clientSettings->post_submission_documents_enabled ?? 0;

        $savedData = AttorneyEditorData::where('client_id', $id)->first();
        $input = $request->all();
        $selected_trustee = Helper::validate_key_value('selected_trustee', $input, 'radio');
        $localForms = self::getLocalForms('local', $savedData, $selected_trustee);
        $trusteeForms = self::getLocalForms('trustee', $savedData, $selected_trustee);


        $clientPSDocuments = ClientDocuments::getClientPostSubmissionDocumentList($id);

        $mainDocumentTypeStructure = DocumentUploadedData::getMainDocumentTypeStructure($user, $attorneyId, $clientBankDocs, $attorneyDocs, $adminDocuments, $post_submission_documents_enabled, $propertyData, $vehicleData, $localForms, $trusteeForms, $clientPSDocuments);
        $allDocNames = DocumentUploadedData::getDocTypeNameForUploadedScreen($debtorname, $spousename, $attorneyId, $clientBankDocs, $attorneyDocs, $adminDocuments, $mortgageUpdatedNames, $vehicleUpdatedNames, $post_submission_documents_enabled, $clientPSDocuments);

        if (array_key_exists('Current_Mortgage_Statement', $allDocNames)) {
            $allDocNames['Current_Mortgage_Statement'] = 'Real Property';
        }
        if (array_key_exists('Current_Auto_Loan_Statement', $allDocNames)) {
            $allDocNames['Current_Auto_Loan_Statement'] = 'Vehicle(s)';
        }

        $mainDocumentTypeStructure = self::mainDocumentTypeStructureAfterExcludingDocs($mainDocumentTypeStructure, $excludeDocs);
        $allDocNames = self::allDocNamesAfterExcludingDocs($allDocNames, $excludeDocs);

        $documentMoveToList = DocumentUploadedData::getDocumentMoveToList($user->client_type, $id, $mainDocumentTypeStructure, $allDocNames);
        $trustees = StateTrustee::getTrustee(Helper::validate_key_value('state', $clientBasicInfoPartA));
        $payStubAIStatus = PayStubs::getAIStatusBasedArray($id);
        $addCurrentMonthToDate = AttorneySettings::isCurrentPartialMonthEnabled($attorneyId);

        $allAttorneyPSDocNames = AttorneyCommonDocuments::getPostSubmissionDocList($attorneyId);

        $allClientPSDocuments = [];
        if ($clientPSDocuments) {
            foreach ($clientPSDocuments as $key => $document) {
                $allClientPSDocuments[Helper::validate_key_value('document_name', $document)] = Helper::validate_key_value('document_type', $document);
            }
        }

        return view('attorney.uploaded_document_view', [

                'mainDocumentTypeStructure' => $mainDocumentTypeStructure,
                'allDocNames' => $allDocNames,
                'documentMoveToList' => $documentMoveToList,
                'trustees' => $trustees,
                'savedData' => $savedData,
                'selected_trustee' => $selected_trustee,
                'parentAttorneyId' => $attorneyId,
                'd1HasEmployers' => $d1HasEmployers,
                'd2HasEmployers' => $d2HasEmployers,
                'unpaid_wages' => $unpaid_wages,
                'paystubAssignedDocIdsSelf' => $paystubAssignedDocIdsSelf,
                'paystubAssignedDocIdsSpouse' => $paystubAssignedDocIdsSpouse,
                'post_submission_documents_enabled' => $post_submission_documents_enabled,
                'venmoPaypalCash' => $venmoPaypalCash,
                'brokerageAccount' => $brokerageAccount,
                'debtorPaystubStatus' => $debtorPaystubStatus,
                'coDebtorPaystubStatus' => $coDebtorPaystubStatus,
                'zip_download_status' => $zip_download_status,
                'vehicleRegistration' => $vehicleRegistration,
                'unreadDocuments' => $unreadDocuments,
                'final_debts' => $final_debts,
                'manual_doc_url' => $manual_doc_url,
                'notOwned' => $notOwned,
                'attorneyDocs' => $attorneyDocs,
                'clientDocs' => $clientDocs,
                'adminDocs' => $adminDocs,
                'video' => $video,
                'client_id' => $id,
                'client' => true,
                'documentuploaded' => $updatedList,
                'propertyValueDocType' => $propertyValueDocType,
                'client_type' => $user->client_type,
                'User' => $user,
                'editable' => isset($editable->can_edit) ? $editable->can_edit : 0,
                'type' => 'documents',
                'totals' => $total,
                'bank_statement_months' => $bank_statement_months,
                'bank_account_documents' => $bank_account_documents,
                'requestedDocuments' => $requestedDocuments,
                'retirement_pension' => $retirement_pension,
                'payStubAIStatus' => $payStubAIStatus,
                'addCurrentMonthToDate' => $addCurrentMonthToDate,
                'brokerage_months' => $brokerage_months,
                'allAttorneyPSDocNames' => $allAttorneyPSDocNames,
                'allClientPSDocuments' => $allClientPSDocuments,
            ]);
    }

    private static function allDocNamesAfterExcludingDocs($allDocNames, $excludeDocs)
    {
        if (empty($excludeDocs)) {
            return $allDocNames;
        }
        if (is_array($excludeDocs) && !empty($excludeDocs)) {
            foreach ($excludeDocs as $key) {
                if (isset($allDocNames[$key])) {
                    unset($allDocNames[$key]);
                }
            }
        }

        return $allDocNames;
    }

    private static function mainDocumentTypeStructureAfterExcludingDocs($mainDocumentTypeStructure, $excludeDocs)
    {
        if (empty($excludeDocs)) {
            return $mainDocumentTypeStructure;
        }
        if (is_array($mainDocumentTypeStructure) && !empty($mainDocumentTypeStructure)) {
            $flatGroups = [
                'parentIdDocuments', 'parentIncomeDocuments', 'parentOtherIncomeDocuments',
                'parentTaxesDocuments', 'parentRetirementDocuments', 'parentMiscAttorneyDocuments',
                'parentBankDocuments', 'parentPaypalVenmoCashDocuments', 'parentBrokerageDocuments',
                'parentRequestedDocuments'
            ];

            foreach ($mainDocumentTypeStructure as $parentKey => $parentData) {
                if (is_array($parentData) && !empty($parentData)) {
                    if (in_array($parentKey, $flatGroups)) {
                        foreach ($parentData as $key => $data) {
                            if (in_array($key, $excludeDocs)) {
                                unset($mainDocumentTypeStructure[$parentKey][$key]);
                            }
                        }
                    }
                    if (in_array($parentKey, ['parentUnsecuredDocuments'])) {
                        foreach ($parentData as $key => $data) {
                            foreach ($data as $subkey => $subdata) {
                                if (in_array($subkey, $excludeDocs)) {
                                    unset($mainDocumentTypeStructure[$parentKey][$key][$subkey]);
                                }
                            }
                        }
                    }
                    if (in_array($parentKey, ['parentSecuredDocuments'])) {
                        foreach ($parentData as $key => $data) {
                            foreach ($data as $subkey => $subdata) {
                                foreach ($subdata as $subdatakey => $subdataobj) {
                                    if (in_array($subdatakey, $excludeDocs)) {
                                        unset($mainDocumentTypeStructure[$parentKey][$key][$subkey][$subdatakey]);
                                    }
                                }
                            }
                        }
                    }
                }

            }
        }

        return $mainDocumentTypeStructure;
    }

    private static function getLocalForms($type, $savedData, $selected_trustee)
    {
        $forms = [];

        $distritId = isset($savedData->data) && !empty(json_decode($savedData->data)->district_id) ? json_decode($savedData->data)->district_id : 69;
        $selectedTrusteeId = isset($savedData->data) && !empty(json_decode($savedData->data)->trustee) ? json_decode($savedData->data)->trustee : '';

        $selectedTrusteeId = !empty($selected_trustee) ? $selected_trustee : $selectedTrusteeId;

        $condition = ['zipcode' => $distritId];
        if ($type == 'local') {
            $condition['type'] = 'local';
            $condition['trustee'] = null;
        }
        if ($type == 'trustee') {
            unset($condition['zipcode']);
            $condition['type'] = 'local';
            $condition['trustee'] = $selectedTrusteeId;
        }

        $forms = Form::where($condition)->get();
        $forms = $forms->toArray() ? $forms->toArray() : [];

        return $forms;
    }

    private static function getManualUrl($attorneyId, $id)
    {
        $encryptedid = base64_encode($attorneyId);
        $encryptedClientId = base64_encode($id);
        $linkinput['link'] = route('questionnaire') . "?token=" . $encryptedid;
        $linkinput['manual_link'] = route('manual_upload') . "?token=" . $encryptedid . "&clientToken=" . $encryptedClientId;
        $linkinput['attorney_id'] = $attorneyId;
        $linkinput['link_for'] = 'manual';

        return  \App\Models\ShortLink::getSetLink($linkinput, $attorneyId);
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

    private function getValuetype($array, $column, $value)
    {
        return array_filter($array, function ($element) use ($column, $value) {
            return isset($element[$column]) && in_array($element[$column], $value);
        });
    }

    private static function getVehicleRegistrations($client_id)
    {
        $vehicleRegistartion = \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id, 'document_type' => \App\Models\ClientDocumentUploaded::VEHICLE_REGISTRATION])->get();

        return !empty($vehicleRegistartion) ? $vehicleRegistartion->toArray() : [];
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
        return !empty($clientDocumentArray) ? $documentList + ['other_income' => $clientDocumentArray] : $documentList;
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
        // Extract client documents excluding 'life_insurance'
        $clientDocs = $this->extractClientDocs($clientBankDocs);

        // Get admin-requested documents
        $adminDocs = \App\Models\ClientDocuments::getAdminRequestedDocumentList($adminDocuments, $clientBankDocs);

        $documents = [];
        foreach ($documentTypes as $key => $name) {
            // Skip if the document is in excluded categories
            if ($this->isDocumentExcluded($name)) {
                continue;
            }

            // Prepare document data
            $documentData = $this->prepareDocumentData($key, $name, $documentuploaded_data);

            // Merge document data with additional details
            $documents[] = $this->getDocumentFiles(
                $key,
                $documentkeys,
                $documentuploaded_data,
                $documentData,
                $name,
                $attorneyDocs,
                $clientDocs,
                $adminDocs
            );
        }

        return $documents;
    }

    /**
     * Extracts client documents excluding 'life_insurance'.
     */
    private function extractClientDocs($clientBankDocs)
    {
        $clientDocs = [];
        foreach ($clientBankDocs as $key => $doc) {
            if ($key !== 'life_insurance') {
                $clientDocs = array_merge($clientDocs, array_keys($doc));
            }
        }

        return $clientDocs;
    }

    /**
     * Checks if a document should be excluded based on its name.
     */
    private function isDocumentExcluded($name)
    {
        $residenceKeys = ClientDocumentUploaded::getResidenceKeyValue(0);
        $autoloanKeys = ClientDocumentUploaded::getAutoloanKeyValue(0);

        return in_array($name, array_values($residenceKeys)) || in_array($name, array_values($autoloanKeys));
    }

    /**
     * Prepares the base document data structure.
     */
    private function prepareDocumentData($key, $name, $documentuploaded_data)
    {
        $updatedname = '';
        $documentmonth = '';

        foreach ($documentuploaded_data as $doc) {
            if ($doc['document_type'] == $key) {
                $updatedname = $doc['updated_name'] ?? '';
                $documentmonth = $doc['document_month'] ?? '';
                break; // Exit loop once the document is found
            }
        }

        return [
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
}
