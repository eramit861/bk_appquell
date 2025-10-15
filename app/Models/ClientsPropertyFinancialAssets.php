<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ClientHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheProperty;

class ClientsPropertyFinancialAssets extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_property_financial_assets';
    public $timestamps = false;


    public static function formatDocumentNames($data)
    {
        $documentNames = [];
        $accountTypes = Helper::validate_key_value('type_of_account', $data) ?? [];
        $description = Helper::validate_key_value('description', $data) ?? [];

        if (!empty($accountTypes)) {
            foreach ($accountTypes as $index => $accType) {
                if (!empty($data['property_value'][$index])) {
                    //$descriptionstring = Helper::validate_doc_type(strtolower(Helper::validate_key_value($index, $description)));
                    $displayDesc = ucfirst(Helper::validate_key_value($index, $description));
                    $documentType = $accType;
                    $selectString = ClientHelper::accountTypeArrayForDoc($documentType);
                    //$documentName = strtolower(Helper::validate_doc_type($selectString).'_'.$descriptionstring.'_'.$type_for);
                    $documentNames[] = ucfirst($selectString.': '.$displayDesc.': Retirement Statement');
                }
            }
        }

        return $documentNames;
    }

    public static function updateDocumentTypes($clientId, $savedNamesArray, $newNamesArray)
    {

        foreach ($savedNamesArray as $index => $oldName) {
            if (!empty($newNamesArray[$index])) {
                $oldNameFormatted = Helper::validate_doc_type(str_replace(' ', '_', $oldName));
                $newNameFormatted = Helper::validate_doc_type(str_replace(' ', '_', $newNamesArray[$index]), true);
                \App\Models\ClientDocumentUploaded::where(['client_id' => $clientId, 'document_type' => $oldNameFormatted])
                    ->update(['document_type' => ucfirst($newNameFormatted)]);
            }
        }
    }

    public static function insertNewDocuments($clientId, $data, $type_for)
    {
        $description = Helper::validate_key_value('description', $data) ?? [];
        $typeofAccount = Helper::validate_key_value('type_of_account', $data) ?? [];
        if (!empty($typeofAccount) && is_array($typeofAccount)) {
            foreach ($typeofAccount as $index => $actype) {
                $descriptionstring = Helper::validate_doc_type(strtolower(Helper::validate_key_value($index, $description)), true);
                $displayDesc = ucfirst(Helper::validate_key_value($index, $description));
                $documentType = $actype;
                $selectString = ClientHelper::accountTypeArrayForDoc($documentType);
                $documentName = strtolower(Helper::validate_doc_type($selectString, true).'_'.$descriptionstring.'_'.$type_for);
                $dataToUpdate = [
                    'client_id' => $clientId,
                    'document_name' => $documentName,
                    'document_type' => ucfirst($selectString.': '.$displayDesc.': Retirement Statement'),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'type' => $type_for
                ];
                \App\Models\ClientDocuments::updateOrCreate(['client_id' => $clientId, 'document_name' => $documentName], $dataToUpdate);
            }
        }
    }

    public static function getTradedStocksData($client_id)
    {
        $propertyData = CacheProperty::getPropertyData($client_id, true, false);
        $financialassets = Helper::validate_key_value('financialassets', $propertyData, 'array');

        $final = [];

        foreach ($financialassets as $financial) {
            if ($financial['type'] == "traded_stocks") {
                $f_type_data = json_decode($financial['type_data'], true) ?? [];
                $financial = array_merge($financial, [
                    'type_of_account' => $f_type_data['type_of_account'] ?? '',
                    'description' => $f_type_data['description'] ?? '',
                    'last_4_digits' => $f_type_data['last_4_digits'] ?? '',
                    'property_value' => $f_type_data['property_value'] ?? '',
                    'account_type' => $f_type_data['account_type'] ?? '',
                    'owned_by' => $f_type_data['owned_by'] ?? '',
                    'property_value_unknown' => $f_type_data['property_value_unknown'] ?? ''
                ]);
                unset($financial['type_data']);
                $final[$financial['type']] = $financial;
            }
        }

        return $final['traded_stocks'] ?? [];
    }

    public static function getDataByAssetType($pFA, $assetType)
    {
        if (empty($pFA) || empty($assetType)) {
            return [];
        }

        $dataToReturn = [];
        foreach ($pFA as $data) {
            if (!empty($data) && isset($data['type']) && $data['type'] == $assetType) {
                $dataToReturn = $data;
                break;
            }
        }

        return $dataToReturn;

    }

}
