<?php

namespace App\Services\Client;

use App\Models\FinancialAffairs;
use App\Helpers\ClientHelper;
use App\Helpers\Helper;

class FinancialManagementService
{
    /**
     * Update financial affairs data
     */
    public function updateFinancialData(array $input, int $clientId): void
    {
        unset($input['_token']);

        $capitalizedData = $this->capitalizeData($input);
        $finalInput = ClientHelper::formatInputJson($capitalizedData);
        $finalInput['client_id'] = $clientId;

        FinancialAffairs::updateOrCreate(
            ["client_id" => $clientId],
            $finalInput
        );

        // Clear cache for client SOFA
        CacheSOFA::forgetSOFACache($clientId);
    }

    /**
     * Update financial data for single fields
     */
    public function updateFinancialDataSingleFields(int $clientId, array $inputData, $existingAsset, string $isDelete): void
    {
        $dateTime = now();
        $updateArray = [];

        $fields = [
            'community_property_state' => !empty(Helper::validate_key_value('community_property_state', $inputData)) ? Helper::validate_key_value('community_property_state', $inputData) : [],
            'domestic_partner_living' => !empty(Helper::validate_key_value('domestic_partner_living', $inputData)) ? Helper::validate_key_value('domestic_partner_living', $inputData) : [],
            'domestic_partner' => !empty(Helper::validate_key_value('domestic_partner', $inputData)) ? Helper::validate_key_value('domestic_partner', $inputData) : [],
            'domestic_partner_street_address' => !empty(Helper::validate_key_value('domestic_partner_street_address', $inputData)) ? Helper::validate_key_value('domestic_partner_street_address', $inputData) : [],
            'domestic_partner_city' => !empty(Helper::validate_key_value('domestic_partner_city', $inputData)) ? Helper::validate_key_value('domestic_partner_city', $inputData) : [],
            'domestic_partner_state' => !empty(Helper::validate_key_value('domestic_partner_state', $inputData)) ? Helper::validate_key_value('domestic_partner_state', $inputData) : [],
            'domestic_partner_zip' => !empty(Helper::validate_key_value('domestic_partner_zip', $inputData)) ? Helper::validate_key_value('domestic_partner_zip', $inputData) : [],
        ];

        $maxLength = 0;
        foreach ($fields as $field) {
            $maxLength = max($maxLength, count($field));
        }

        foreach ($fields as $column => $newValue) {
            // Fetch existing data if available
            $existingData = [];
            if ($existingAsset && !empty($existingAsset->$column)) {
                $existingData = json_decode($existingAsset->$column, true) ?? [];
            }

            if ($isDelete == "true") {
                $existingData = $newValue;
            }

            // Fill any missing values with empty strings for fields that are smaller than the maximum length
            if (count($newValue) < $maxLength) {
                $newValue = array_pad($newValue, $maxLength, '');
            }

            // Merge the new data with the existing data
            foreach ($newValue as $index => $value) {
                $existingData[$index] = $value;
            }

            // Normalize to zero-based array if it's a numerically indexed array
            if (is_array($existingData)) {
                $existingData = array_values($existingData);
            }

            $updateArray[$column] = json_encode($existingData);
        }

        $updateArray['living_domestic_partner'] = 1;
        $updateArray['updated_on'] = $dateTime;

        if ($existingAsset) {
            $existingAsset->update($updateArray);
        } else {
            $updateArray['client_id'] = $clientId;
            $updateArray['created_on'] = $dateTime;
            FinancialAffairs::create($updateArray);
        }
    }

    /**
     * Update financial data for common asset types
     */
    public function updateFinancialDataCommon(int $clientId, string $assetType, array $assetData, $existingAsset, string $isDelete, string $radioAssetType = '', string $dataAssetType = ''): void
    {
        $dateTime = now();
        $typeData = [];

        $radioAssetType = !empty($radioAssetType) ? $radioAssetType : $assetType;
        $dataAssetType = !empty($dataAssetType) ? $dataAssetType : $assetType.'_data';

        $assetFieldsMap = [
            'list_safe_deposit' => ['name', 'street_number', 'city', 'state', 'zip', 'have_access_of_box', 'bo_name', 'bo_street_number', 'bo_city', 'bo_state', 'bo_zip', 'contents', 'still_have_safe_deposite'],
            'other_storage_unit' => ['name', 'street_number', 'city', 'state', 'zip', 'have_access_of_box', 'bd_name', 'bd_street_number', 'bd_city', 'bd_state', 'bd_zip', 'contents', 'still_have_storage_unit'],
            'list_nature_business' => ['name', 'type', 'businessDescription', 'own_business_selection', 'street_number', 'city', 'state', 'zip', 'business_nature', 'business_accountant', 'eiin', 'doesntHaveEin', 'operation_date', 'operation_date2', 'business_still_open']
        ];

        if (isset($assetFieldsMap[$radioAssetType])) {
            $fields = $assetFieldsMap[$radioAssetType];
            $cleanedAssetData = [];

            // Find all possible indexes used
            $allIndexes = [];
            foreach ($assetData as $fieldValues) {
                if (is_array($fieldValues)) {
                    $allIndexes = array_merge($allIndexes, array_keys($fieldValues));
                }
            }
            $allIndexes = array_unique($allIndexes);
            sort($allIndexes);

            // Fill all fields for all indexes
            foreach ($fields as $field) {
                $existing = Helper::validate_key_value($field, $assetData);
                $existing = is_array($existing) ? $existing : [];

                foreach ($allIndexes as $i) {
                    $cleanedAssetData[$field][$i] = isset($existing[$i]) ? $existing[$i] : '';
                }
            }

            $assetData = $this->normalizeArrayLengths($cleanedAssetData);
        }

        if (!empty($existingAsset)) {
            $typeData = json_decode(Helper::validate_key_value($dataAssetType, $existingAsset), true) ?? [];

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

            $dataToSave = [
                $dataAssetType => json_encode($typeData),
                'updated_on' => $dateTime,
            ];

            if ($radioAssetType !== 'list_nature_business') {
                $dataToSave[$radioAssetType] = 1;
            }

            $existingAsset->update($dataToSave);
        } else {
            $typeData = $assetData;
            foreach ($typeData as $key => $dataObject) {
                if (is_array($dataObject)) {
                    $typeData[$key] = array_values($dataObject);
                }
            }

            $dataToSave = [
                'client_id' => $clientId,
                $dataAssetType => json_encode($typeData),
                'created_on' => $dateTime,
                'updated_on' => $dateTime,
            ];

            if ($radioAssetType !== 'list_nature_business') {
                $dataToSave[$radioAssetType] = 1;
            }

            FinancialAffairs::create($dataToSave);
        }
    }

    /**
     * Capitalize data for proper formatting
     */
    private function capitalizeData(array $input): array
    {
        $capitalizedData = [];
        $checkFor = [
            // step 1 data
            'domestic_partner', 'domestic_partner_street_address', 'domestic_partner_city', 'primarily_consumer_debets_data', 'past_one_year_data', 'transfers_property_data', 'list_lawsuits_data', 'property_repossessed_data', 'setoffs_creditor_data',
            // step 2 data
            'list_any_gifts_data', 'gifts_charity_data', 'losses_from_fire_data', 'property_transferred_data', 'Property_all_data', 'all_property_transfer_10_year_data', 'list_all_financial_accounts_data', 'list_safe_deposit_data', 'other_storage_unit_data', 'list_property_you_hold_data',
            // step 3 data
            'list_noticeby_gov_data', 'list_environment_law_data', 'list_judicial_proceedings_data', 'list_nature_business_data', 'list_financial_institutions_data'
        ];

        $checkForMultiple = [
            // step 1 data
            'primarily_consumer_debets_data', 'past_one_year_data', 'transfers_property_data', 'list_lawsuits_data', 'property_repossessed_data', 'setoffs_creditor_data',
            // step 2 data
            'list_any_gifts_data', 'gifts_charity_data', 'losses_from_fire_data', 'property_transferred_data', 'Property_all_data', 'all_property_transfer_10_year_data', 'list_all_financial_accounts_data', 'list_safe_deposit_data', 'other_storage_unit_data', 'list_property_you_hold_data',
            // step 3 data
            'list_noticeby_gov_data', 'list_environment_law_data', 'list_judicial_proceedings_data', 'list_nature_business_data', 'list_financial_institutions_data'
        ];

        $subCheckFor = [
            // step 1 data
            'creditor_address', 'creditor_street', 'creditor_city', 'creditor_address_past_one_year', 'creditor_street_past_one_year', 'creditor_city_past_one_year', 'creditor_address_transfers_property', 'creditor_street_transfers_property', 'creditor_city_transfers_property', 'payment_reason_transfers_property', 'case_title', 'agency_location', 'agency_street', 'agency_city', 'creditor_Property', 'creditors_address', 'creditor_street', 'creditor_city', 'creditors_action',
            // step 2 data
            'recipient_address', 'relationship', 'gifts', 'charity_address', 'charity_street', 'charity_city', 'charity_contribution', 'loss_description', 'transferred_description', 'person_paid', 'person_paid_street', 'person_paid_address_line2', 'person_paid_city', 'person_made_payment', 'property_transferred_value', 'person_paid_address', 'property_transfer_value', 'name', 'street_number', 'city', 'property_transfer_value', 'property_exchange', 'relationship_to_you', 'trust_name', '10year_property_transfer', 'institution_name', 'bo_name', 'bo_street_number', 'bo_city', 'contents', 'bd_name', 'bd_street_number', 'bd_city', 'location_street_number', 'location_city', 'property_desc',
            // step 3 data
            'gov_name', 'gov_street_number', 'gov_city', 'environmental_law', 'environment_law_know', 'case_name', 'case_nature', 'com_print_typeinfo', 'business_nature', 'business_accountant',
        ];

        foreach ($input as $key => $data) {
            if (in_array($key, $checkFor)) {
                if (in_array($key, $checkForMultiple)) {
                    $capitalizedData[$key] = $this->capitalizePrimarilyConsumerDebetsData($data, $subCheckFor);
                } else {
                    $capitalizedData[$key] = array_map('ucwords', array_map('strtolower', $data));
                }
            } else {
                $capitalizedData[$key] = $data;
            }
        }

        return $capitalizedData;
    }

    /**
     * Capitalize primarily consumer debts data
     */
    private function capitalizePrimarilyConsumerDebetsData(array $debetsData, array $checkFor): array
    {
        foreach ($debetsData as $subKey => $subData) {
            if (in_array($subKey, $checkFor)) {
                $debetsData[$subKey] = array_map('ucwords', array_map('strtolower', $subData));
            }
        }

        return $debetsData;
    }

    /**
     * Normalize array lengths for consistent data structure
     */
    public function normalizeArrayLengths(array $data): array
    {
        $maxCount = 0;

        foreach ($data as $field => $values) {
            if (is_array($values)) {
                $maxCount = max($maxCount, count($values));
            }
        }

        foreach ($data as $field => $values) {
            if (is_array($values)) {
                $data[$field] = array_pad($values, $maxCount, "");
            }
        }

        return $data;
    }
}
