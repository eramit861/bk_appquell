<?php

namespace App\Services\Client;

use App\Helpers\ClientHelper;
use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Models\AttorneyDocuments;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\ClientsPropertyFinancialAssets;
use App\Models\Creditors;
use App\Models\FormsStepsCompleted;
use App\Models\PdfToJson;
use App\Models\TemplateDetailedProperty;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class PropertyDataService
{
    /**
     * Get attorney data
     */
    public function getAttorneyData(int $clientId): ?object
    {
        return \App\Models\ClientsAttorney::where("client_id", $clientId)->first();
    }

    /**
     * Get aggregated common data for property views
     */
    public function getCommonViewData(int $clientId, int $attorneyId, object $user): array
    {
        return [
            'progress' => FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type),
            'docsProgress' => $attorneyId ? ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId) : [],
            'financialAffairs' => CacheSOFA::getSOFAData($clientId),
            'codebtors' => Creditors::geCodebtors($clientId, $user->client_type),
            'listOfFiles' => $attorneyId ? AttorneyDocuments::getSignedDocuments($clientId, $attorneyId) : [],
            'docsUploadInfo' => ClientHelper::documentUploadInfo(),
            'crsReportNotCompleted' => PdfToJson::getCrsReportStatus($clientId),
            'progress_percentage' => ClientHelper::checkProgress(),
        ];
    }

    /**
     * Get property data
     */
    public function getPropertyData(int $clientId, bool $forClientSide = true, bool $forAttorneySide = false): array
    {
        return CacheProperty::getPropertyData($clientId, $forClientSide, $forAttorneySide);
    }

    /**
     * Get video data for steps
     */
    public function getVideoData(string $step): array
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$step] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    /**
     * Get payment method videos
     */
    public function getPaymentMethodVideos(string $method): array
    {
        return [
            'iphone' => $this->getVideoData(constant("Helper::{$method}_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE")),
            'android' => $this->getVideoData(constant("Helper::{$method}_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID")),
            'desktop_laptop' => $this->getVideoData(constant("Helper::{$method}_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE")),
        ];
    }

    /**
     * Process business data for user
     */
    public function processBusinessData(object $user): array
    {
        $result = ['hasAnyBusiness' => false, 'businessNames' => []];

        $biData = CacheBasicInfo::getBasicInformationData($user->id);
        $biBusinessData = Helper::validate_key_value('BasicInfo_PartRest', $biData, 'array');

        if (!$biBusinessData || Helper::validate_key_value('used_business_ein', $biBusinessData->toArray(), 'radio') != 1) {
            return $result;
        }

        $usedBusinessEinData = json_decode(Helper::validate_key_value('used_business_ein_data', $biBusinessData->toArray()), true);

        if (!empty($usedBusinessEinData)) {
            $businessStillOpen = Helper::validate_key_value('business_still_open', $usedBusinessEinData);
            $ownBusinessName = Helper::validate_key_value('own_business_name', $usedBusinessEinData);

            if (!empty($businessStillOpen)) {
                foreach ($businessStillOpen as $key => $value) {
                    if ($value == 1) {
                        $result['hasAnyBusiness'] = true;
                        $result['businessNames'][] = $ownBusinessName[$key] ?? '';
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Get steps data for step 4
     */
    public function getStepsDataForStep4(array $resident, array $steps): array
    {
        $videos = VideoHelper::getAdminVideos();

        if (isset($resident['isBusinessProperty']['type_value']) && $resident['isBusinessProperty']['type_value']) {
            $steps['step5'] = true;
            $tutorial = $videos[Helper::PROPERTY_STEP4_VIDEO] ?? [];
            $steps['video'] = VideoHelper::getVideos($tutorial);
        } elseif (isset($resident['isFarmProperty']['type_value']) && $resident['isFarmProperty']['type_value']) {
            $steps['step6'] = true;
            $tutorial = $videos[Helper::PROPERTY_STEP5_VIDEO] ?? [];
            $steps['video'] = VideoHelper::getVideos($tutorial);
        } else {
            $steps['step7'] = true;
            $tutorial = $videos[Helper::PROPERTY_STEP6_VIDEO] ?? [];
            $steps['video'] = VideoHelper::getVideos($tutorial);
        }

        return $steps;
    }

    /**
     * Get steps data for step 5
     */
    public function getStepsDataForStep5(array $resident, array $steps): array
    {
        $videos = VideoHelper::getAdminVideos();

        if (isset($resident['isFarmProperty']) && $resident['isFarmProperty']['type_value']) {
            $steps['step6'] = true;
            $tutorial = $videos[Helper::PROPERTY_STEP5_VIDEO] ?? [];
        } else {
            $steps['step7'] = true;
            $tutorial = $videos[Helper::PROPERTY_STEP6_VIDEO] ?? [];
        }

        $steps['video'] = VideoHelper::getVideos($tutorial);

        return $steps;
    }

    /**
     * Get template data for attorney
     */
    public function getTemplateData(?int $attorneyId, ?string $type): array
    {
        if (!$attorneyId) {
            return [];
        }

        $template = \App\Models\Template::where([
            'attorney_id' => $attorneyId,
            'type' => $type
        ])->first();

        return $template ? (json_decode($template->data, true) ?: []) : [];
    }

    /**
     * Get attorney settings with associate check
     */
    public function getAttorneySettings(int $clientId, ?int $attorneyId): ?object
    {
        $clientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $finalAttorneyId = $clientsAssociateId ?: $attorneyId;
        $isAssociate = $clientsAssociateId ? 1 : 0;

        return $finalAttorneyId
            ? AttorneySettings::where([
                'attorney_id' => $finalAttorneyId,
                'is_associate' => $isAssociate
            ])->first(['transaction_pdf_enabled', 'transaction_pdf_signature_enabled'])
            : null;
    }

    /**
     * Check statement existence for client
     */
    public function getStatementExistence(int $clientId): array
    {
        return [
            'statement_exist' => \App\Models\MasterCardTransactions::where('client_id', $clientId)
                ->where('client_type', 'debtor')
                ->exists() ? 1 : 0,
            'spouse_statement_exist' => \App\Models\MasterCardTransactions::where('client_id', $clientId)
                ->where('client_type', 'codebtor')
                ->exists() ? 1 : 0,
        ];
    }

    /**
     * Get detailed property popup data
     */
    public function getDetailedPropertyPopupData(string $type, string $previousData, int $clientId): array
    {
        $items = [];
        $title = "";

        switch ($type) {
            case 'household_goods_furnishings':
                $title = "Household Goods & Furnishings";
                $items = \App\Helpers\UtilityHelper::getHouseholdGoodsFurnishingsItemsArray();
                break;
            case 'electronics':
                $title = "Electronics";
                $items = \App\Helpers\UtilityHelper::getElectronicsItemsArray();
                break;
            case 'collectibles':
                $title = "Collectibles";
                $items = \App\Helpers\UtilityHelper::getCollectiblesItemsArray();
                break;
            case 'sports':
                $title = "Sports Equipment";
                $items = \App\Helpers\UtilityHelper::getSportsItemsArray();
                break;
            case 'everydayfinejqwl':
                $title = "Everyday and Fine Jewelry";
                $items = \App\Helpers\UtilityHelper::getEverydayAndFineJewelryItemsArray();
                break;
            case 'everydayclothing':
                $title = "Everyday Clothing";
                $items = \App\Helpers\UtilityHelper::getEverydayClothingArray();
                break;
            case 'firearms':
                $title = "Firearms";
                $items = \App\Helpers\UtilityHelper::getFirearmsArray();
                break;
            default:
                $items = [];
                $title = '';
                break;
        }

        $attorney = $this->getAttorneyData($clientId);
        $attorneyId = $attorney ? $attorney->attorney_id : null;

        if ($attorneyId) {
            $template = TemplateDetailedProperty::where(['attorney_id' => $attorneyId])->first();
            if ($template) {
                $columnName = \App\Helpers\UtilityHelper::getDetailedPropertyTableColumnNameForTemplate($type);
                $subData = Helper::validate_key_value($columnName, $template->toArray());
                if (!empty($subData)) {
                    $items = json_decode($subData, true);
                }
            }
        }

        return [
            'type' => $type,
            'previous_data' => $previousData,
            'items' => $items,
            'title' => $title
        ];
    }

    /**
     * Clear property cache when data is updated
     */
    public function clearPropertyCache(int $clientId): void
    {
        CacheProperty::forgetPropertyCache($clientId);
    }

    /**
     * Update property step 1
     */
    public function updatePropertyStep1($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyResident::saveStepResident($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step 2
     */
    public function updatePropertyStep2($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyVehicle::saveStepVehicle($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step 3
     */
    public function updatePropertyStep3($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyHousehold::saveStepPersonalHouseholdItems($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step continue 4
     */
    public function updatePropertyStepContinue4($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::saveStepFinancialAssets($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step 4
     */
    public function updatePropertyStep4($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::saveStepFinancialAssetsContinued($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step 5
     */
    public function updatePropertyStep5($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyBusinessAssets::saveStepBusinessAssets($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step 6
     */
    public function updatePropertyStep6($request, $clientId, $attorneyId): void
    {
        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFarmCommercial::saveStepPropertyFarmCommercial($clientId, $request, false, $attorneyId);
        }
    }

    /**
     * Update property step 7
     */
    public function updatePropertyStep7($request, $client, $clientId): void
    {
        if ($request->isMethod('post') && !\App\Helpers\Helper::isTabEditable('can_edit_property')) {
            return;
        }

        if ($request->isMethod('post') && \App\Helpers\Helper::isTabEditable('can_edit_property')) {
            $input = $request->all();
            if (!empty($input)) {
                $abFormLineStart = 53; // AB_FORM_LINE_NUMBERS['miscellaneous']
                unset($input['_token']);

                foreach ($input as $key => $val) {
                    if ($key == 'other_financial') {
                        $val['type'] = 'miscellaneous';
                        $val['client_id'] = $clientId;
                        $val['form_ab_line_no'] = $abFormLineStart;
                        $typeValue = \App\Helpers\Helper::validate_key_value('type_value', $val, 'radio');
                        $val['type_data'] = (!empty($typeValue) && $typeValue == 1) ? json_encode($val['data']) : json_encode([]);
                        unset($val['data']);

                        $part = $client->clientsPropertyMiscellaneous;
                        if ($part->isNotEmpty()) {
                            $existingRecord = $part->first();
                            unset($val['id']);
                            $client->clientsPropertyMiscellaneous()->where("id", $existingRecord->id)->update($val);
                        } else {
                            $client->clientsPropertyMiscellaneous()->create($val);
                        }

                        \App\Models\FormsStepsCompleted::updateOrCreate(["client_id" => $clientId], ['client_id' => $clientId, 'step2' => 1]);
                    }
                }

                // Clear property cache
                $this->clearPropertyCache($clientId);
            }
        }
    }

    /**
     * Add entry to docs
     */
    public function addEntryToDocs($assetType, $clientId, $assetData, $user): void
    {
        $dataForSaving['type'] = $assetType;
        $dataForSaving['client_id'] = $clientId;
        $dataForSaving['type_value'] = 1;
        $dataForSaving['data'] = $assetData;

        if (in_array($assetType, ['bank', 'venmo_paypal_cash', 'brokerage_account'])) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::updateDocsInRequestedDoc($clientId, $assetType, $dataForSaving);
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::addNewEntryInClientDocuments($clientId, $dataForSaving, $assetType);
        }

        if ($assetType == 'retirement_pension') {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::createEntryInClientDocumentsForRetirement($clientId, $dataForSaving, $assetType, $user);
        }
    }

    /**
     * Add entry to docs for unpaid wages and insurance
     */
    public function addEntryToDocsForUnpaidWagesAndInsurance($assetType, $clientId, $assetData, $user): void
    {
        $dataForSaving['type'] = $assetType;
        $dataForSaving['client_id'] = $clientId;
        $dataForSaving['type_value'] = 1;
        $dataForSaving['data'] = $assetData;

        if (($assetType === 'unpaid_wages')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::createEntryInIncomeTabData($assetData, $clientId, false);
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::createEntryInClientDocumentsForUnpaidWages($clientId, $dataForSaving, $assetType);
        }

        if (($assetType === 'life_insurance')) {
            \App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets::createEntryInClientDocumentsForLifeInsurance($clientId, $dataForSaving, $assetType, $user, false);
        }
    }

    /**
     * Get asset data to return for AJAX responses
     */
    public function getAssetDataToReturn(int $clientId, string $assetType): array
    {
        $propertyData = $this->getPropertyData($clientId, true, false);
        $pfa = Helper::validate_key_value('financialassets', $propertyData, 'array');
        $financial = ClientsPropertyFinancialAssets::getDataByAssetType($pfa, $assetType);

        $final = [];
        if (!empty($financial) && is_array($financial)) {
            $fTypeData = json_decode($financial['type_data'], 1);

            if (!empty($fTypeData)) {
                // TypeOfAccount is only used for property->retirement
                $financial['type_of_account'] = $fTypeData['type_of_account'] ?? '';
                $financial['description'] = $fTypeData['description'] ?? '';
                $financial['last_4_digits'] = $fTypeData['last_4_digits'] ?? '';
                $financial['property_value'] = $fTypeData['property_value'] ?? '';
                $financial['account_type'] = $fTypeData['account_type'] ?? '';
                $financial['owned_by'] = $fTypeData['owned_by'] ?? '';
                $financial['property_value_unknown'] = $fTypeData['property_value_unknown'] ?? '';

                $financial['state'] = Helper::validate_key_value('state', $fTypeData);
                $financial['unknown'] = $fTypeData['unknown'] ?? '';

                if ($financial['type'] == "tax_refunds") {
                    $financial['year'] = $fTypeData['year'] ?? '';
                }
                if ($financial['type'] == "bank") {
                    $financial['personal_business_account'] = $fTypeData['personal_business_account'] ?? '';
                    $financial['business_name'] = $fTypeData['business_name'] ?? '';
                    $financial['transaction'] = $fTypeData['transaction'] ?? '';
                    $financial['transaction_data'] = $fTypeData['transaction_data'] ?? '';
                }
                if ($financial['type'] == "venmo_paypal_cash") {
                    $financial['debtor_type'] = $fTypeData['debtor_type'] ?? '';
                }
                if ($financial['type'] == 'alimony_child_support') {
                    $financial['data_for'] = Helper::validate_key_value('data_for', $fTypeData);
                }
                if ($financial['type'] == 'life_insurance') {
                    $financial['current_value'] = Helper::validate_key_value('current_value', $fTypeData);
                }
                if ($financial['type'] == 'unpaid_wages') {
                    $financial['owed_type'] = Helper::validate_key_value('owed_type', $fTypeData);
                    $financial['data_for'] = Helper::validate_key_value('data_for', $fTypeData);
                    $financial['monthly_amount'] = Helper::validate_key_value('monthly_amount', $fTypeData);
                }
            }
            unset($financial['type_data']);
            $final[$financial['type']] = $financial;
        }

        return (!empty($final[$assetType])) ? $final[$assetType] : [];
    }

    /**
     * Save property asset separately
     */
    public function savePropertyAssetSeparately($request, $user): array
    {
        $inputData = $request->all();
        $fileName = \App\Helpers\Helper::validate_key_value('fileName', $inputData);
        $isDelete = \App\Helpers\Helper::validate_key_value('isDelete', $inputData);
        $assetType = \App\Helpers\Helper::validate_key_value('assetType', $inputData);
        $assetData = \App\Helpers\Helper::validate_key_value($assetType, $inputData);
        $assetData = \App\Helpers\Helper::validate_key_value('data', $assetData);

        $clientId = $user->id;

        $existingAsset = $user->clientsPropertyFinancialAssets()
            ->where('type', $assetType)
            ->first();

        $dateTime = now();
        $typeData = [];

        if (!empty($existingAsset)) {
            $typeData = json_decode($existingAsset->type_data, true) ?? [];

            // Update only the submitted index
            foreach ($assetData as $key => $fieldGroup) {
                foreach ($fieldGroup as $index => $val) {
                    $typeData[$key][$index] = $val;
                }
            }

            if ($isDelete == "true") {
                $typeData = $assetData;
            }

            foreach ($typeData as $key => $dataObject) {
                if (is_array($dataObject)) {
                    $typeData[$key] = array_values($dataObject);
                }
            }

            if (in_array($assetType, ['bank', 'venmo_paypal_cash', 'brokerage_account', 'retirement_pension'])) {
                $this->addEntryToDocs($assetType, $clientId, $typeData, $user);
            }

            if (in_array($assetType, ['unpaid_wages', 'life_insurance'])) {
                $this->addEntryToDocsForUnpaidWagesAndInsurance($assetType, $clientId, $typeData, $user);
            }

            $existingAsset->update([
                'type_value' => 1,
                'type_data' => json_encode($typeData),
                'updated_on' => $dateTime,
            ]);
        } else {
            $typeData = $assetData;
            foreach ($typeData as $key => $dataObject) {
                if (is_array($dataObject)) {
                    $typeData[$key] = array_values($dataObject);
                }
            }

            if (in_array($assetType, ['bank', 'venmo_paypal_cash', 'brokerage_account', 'retirement_pension'])) {
                $this->addEntryToDocs($assetType, $clientId, $typeData, $user);
            }

            if (in_array($assetType, ['unpaid_wages', 'life_insurance'])) {
                $this->addEntryToDocsForUnpaidWagesAndInsurance($assetType, $clientId, $typeData, $user);
            }

            \App\Models\ClientsPropertyFinancialAssets::create([
                'client_id' => $clientId,
                'type' => $assetType,
                'type_value' => 1,
                'type_data' => json_encode($typeData),
                'created_on' => $dateTime,
                'updated_on' => $dateTime,
            ]);
        }

        // Clear property cache
        $this->clearPropertyCache($clientId);

        $existingAsset = $this->getAssetDataToReturn($clientId, $assetType);

        $renderData = [
            $assetType => $existingAsset,
        ];

        if ($assetType == 'bank') {
            $attorney = $this->getAttorneyData($clientId);
            $attorneyId = $attorney->attorney_id;

            $clientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($clientId);
            $attorneyId = !empty($clientsAssociateId) ? $clientsAssociateId : $attorneyId;
            $isAssociate = !empty($clientsAssociateId) ? 1 : 0;

            $attorneySettings = \App\Models\AttorneySettings::where([ 'attorney_id' => $attorneyId, 'is_associate' => $isAssociate])->select(['transaction_pdf_enabled', 'transaction_pdf_signature_enabled'])->first();
            $attorneySettings = (!empty($attorneySettings)) ? $attorneySettings->toArray() : [];
            $transactionPdfEnabled = \App\Helpers\Helper::validate_key_value('transaction_pdf_enabled', $attorneySettings, 'radio');

            $biData = CacheBasicInfo::getBasicInformationData($user->id);
            $biBusinessData = \App\Helpers\Helper::validate_key_value('BasicInfo_PartRest', $biData, 'array');
            $biBusinessData = !empty($biBusinessData) ? $biBusinessData->toArray() : [];

            $businessNames = [];
            if (\App\Helpers\Helper::validate_key_value('used_business_ein', $biBusinessData, 'radio') == 1) {
                $usedBusinessEinData = json_decode(\App\Helpers\Helper::validate_key_value('used_business_ein_data', $biBusinessData), true);
                if (!empty($usedBusinessEinData)) {
                    $ownBusinessName = \App\Helpers\Helper::validate_key_value('own_business_name', $usedBusinessEinData);
                    $businessStillOpen = \App\Helpers\Helper::validate_key_value('business_still_open', $usedBusinessEinData);
                    if (!empty($businessStillOpen)) {
                        foreach ($businessStillOpen as $key => $value) {
                            if ($value == 1) {
                                $businessNames[] = $ownBusinessName[$key];
                            }
                        }
                    }
                }
            }

            $renderData['businessNames'] = $businessNames;
            $renderData['transaction_pdf_enabled'] = $transactionPdfEnabled;
        }

        if ($assetType == 'venmo_paypal_cash') {
            $renderData['client'] = $user;
            $renderData['paypalVideos'] = $this->getPaymentMethodVideos('PAYPAL');
            $renderData['cashAppVideos'] = $this->getPaymentMethodVideos('CASH_APP');
            $renderData['venmoVideo'] = $this->getPaymentMethodVideos('VENMO');
        }

        if (in_array($assetType, ['alimony_child_support', 'unpaid_wages'])) {
            $renderData['client'] = $user;
        }

        if ($assetType == 'life_insurance') {
            $renderData['attorney_edit'] = false;
        }

        return [
            'fileName' => $fileName,
            'renderData' => $renderData
        ];
    }

    /**
     * Get videos helper method
     */
    public function getVideos($step): array
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$step] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    /**
     * Check edit permission and return error response if not allowed
     */
    public function checkEditPermission($request): ?array
    {
        if ($request->isMethod('post') && !Helper::isTabEditable('can_edit_property')) {
            return [
                'status' => 0,
                'msg' => 'You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen.'
            ];
        }

        return null;
    }

    /**
     * Check subscription redirects
     */
    public function checkSubscriptionRedirects($user): ?string
    {
        if ($user->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return 'client_income';
        }
        if ($user->hide_questionnaire && empty($user->client_payroll_assistant)) {
            return 'no_client_questionnaire';
        }

        return null;
    }

    /**
     * Generate steps array for property views
     */
    public function generateStepsArray(int $activeStep, string $videoConstant, string $tab = 'tab2'): array
    {
        $steps = [
            'step1' => false, 'step2' => false, 'step3' => false,
            'step4' => false, 'step5' => false, 'step6' => false,
            'step7' => false, 'tab' => $tab
        ];

        $steps["step{$activeStep}"] = true;
        $steps['video'] = $this->getVideoData($videoConstant);

        return $steps;
    }

    /**
     * Get attorney with validation
     */
    public function getAttorneyWithValidation(int $clientId): array
    {
        $attorney = $this->getAttorneyData($clientId);
        if (!$attorney) {
            return ['error' => 'Attorney information not found'];
        }

        return ['attorney' => $attorney, 'attorneyId' => $attorney->attorney_id];
    }
}
