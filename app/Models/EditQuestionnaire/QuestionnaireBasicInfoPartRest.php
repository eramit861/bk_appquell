<?php

namespace App\Models\EditQuestionnaire;

use Illuminate\Database\Eloquent\Model;
use App\Models\ClientBasicInfoPartRest;
use App\Models\IncomeDebtorMonthlyIncome;
use App\Models\IncomeDebtorSpouseMonthlyIncome;
use App\Helpers\Helper;
use App\Models\FinancialAffairs;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheSOFA;
use stdClass;

class QuestionnaireBasicInfoPartRest extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_basic_info_part_rest';
    public $timestamps = false;

    public static function saveBasicInfoPartRestFromBasicInfoStep3($client_id, $input, $fromAttorney = false)
    {

        $model = $fromAttorney ? (QuestionnaireBasicInfoPartRest::class) : (ClientBasicInfoPartRest::class);

        $dateTime = date('Y-m-d H:i:s');

        $inputData = Helper::validate_key_value('part_rest', $input);
        $evictionPendingData = Helper::validate_key_value('eviction_pending_data', $input);
        $usedBusinessEinData = Helper::validate_key_value('used_business_ein_data', $input);

        $hazardousProperty = Helper::validate_key_value('hazardous_property', $inputData, 'radio');

        $dataToSave = [
            'client_id' => $client_id,
            'eviction_pending' => Helper::validate_key_value('eviction_pending', $inputData, 'radio'),
            'rented_residence' => Helper::validate_key_value('rented_residence', $inputData, 'radio'),
            'used_business_ein' => Helper::validate_key_value('used_business_ein', $inputData, 'radio'),
            'used_business_ein_data' => '',
            'hazardous_property' => $hazardousProperty,
            'hazardous_property_data' => '',
            'status' => 1,
            'updated_on' => $dateTime,
        ];

        if (!empty($evictionPendingData) && array_filter($evictionPendingData)) {
            $dataToSave['eviction_pending_data'] = json_encode($evictionPendingData);
        }

        if (!empty($usedBusinessEinData) && array_filter($usedBusinessEinData)) {
            $usedBusinessEin = Helper::validate_key_value('used_business_ein', $inputData, 'radio');
            $dataToSave['used_business_ein_data'] = ($usedBusinessEin == 1) ? json_encode($usedBusinessEinData) : '';
            if (isset($dataToSave['used_business_ein_data']) && !empty($dataToSave['used_business_ein_data'])) {
                self::updateBussinessNamesToIncomeFromBasicInfoStep3($client_id, $usedBusinessEinData, $fromAttorney);
            }
        }

        $hazardousPropertyData = Helper::validate_key_value('hazardous_property_data', $inputData);
        if ($hazardousProperty == 1 && !empty($hazardousPropertyData)) {
            $dataToSave['hazardous_property_data'] = json_encode($hazardousPropertyData);
        }

        $condtion = [ 'client_id' => $client_id ];
        $insertedId = '';
        if ($model::where($condtion)->exists()) {
            $saveData = $model::where($condtion);
            $insertedId = $saveData->first()->id;
            $saveData->update($dataToSave);
        } else {
            $dataToSave['created_on'] = $dateTime;
            $saveData = $model::create($dataToSave);
            $insertedId = $saveData->id;
        }

        if (!empty($dataToSave['used_business_ein_data']) && !empty($insertedId)) {
            self::updateFinancialOwnBusiness($client_id, $dataToSave['used_business_ein_data'], $fromAttorney);

            // clear cache for client SOFA
            CacheSOFA::forgetSOFACache($client_id);
        }

        // clear cache for client basic information
        CacheBasicInfo::forgetBasicInformationCache($client_id);

        return true;
    }

    public static function updateBussinessNamesToIncomeFromBasicInfoStep3($client_id, $data, $fromAttorney)
    {
        $condtion = [ 'client_id' => $client_id ];
        $modelD1Income = $fromAttorney ? (QuestionnaireIncomeDebtorMonthlyIncome::class) : (IncomeDebtorMonthlyIncome::class);
        $modelD2Income = $fromAttorney ? (QuestionnaireIncomeDebtorSpouseMonthlyIncome::class) : (IncomeDebtorSpouseMonthlyIncome::class);

        $names = $data['own_business_name'];
        $types = $data['own_business_selection'];
        $stillOpens = Helper::validate_key_value('business_still_open', $data) ?? [];
        $D1TypeArray = [];
        $D2TypeArray = [];

        $profitLossKeys = [
            'profit_loss_business_name',
            'profit_loss_business_name_2',
            'profit_loss_business_name_3',
            'profit_loss_business_name_4',
            'profit_loss_business_name_5',
            'profit_loss_business_name_6'
        ];

        $d1Count = 0;
        $d2Count = 0;

        if (!empty($stillOpens)) {
            $dateTime = date('Y-m-d H:i:s');

            foreach ($types as $key => $type) {
                if ($type == 0 && $d1Count < 4 && Helper::validate_key_value($key, $stillOpens, 'radio') == 1) {
                    $D1TypeArray[$profitLossKeys[$d1Count]] = $names[$key];
                    $d1Count++;
                }

                if ($type == 1 && $d2Count < 4 && Helper::validate_key_value($key, $stillOpens, 'radio') == 1) {
                    $D2TypeArray[$profitLossKeys[$d2Count]] = $names[$key];
                    $d2Count++;
                }
            }

            $d1DataToSave = [
                "profit_loss_business_name" => Helper::validate_key_value('profit_loss_business_name', $D1TypeArray),
                "profit_loss_business_name_2" => Helper::validate_key_value('profit_loss_business_name_2', $D1TypeArray),
                "profit_loss_business_name_3" => Helper::validate_key_value('profit_loss_business_name_3', $D1TypeArray),
                "profit_loss_business_name_4" => Helper::validate_key_value('profit_loss_business_name_4', $D1TypeArray),
                "profit_loss_business_name_5" => Helper::validate_key_value('profit_loss_business_name_5', $D1TypeArray),
                "profit_loss_business_name_6" => Helper::validate_key_value('profit_loss_business_name_6', $D1TypeArray),
            ];

            $d1DataToSave['operation_business'] = empty($D1TypeArray) ? 0 : 1;
            $d1DataToSave['updated_on'] = $dateTime;

            if (!$modelD1Income::where($condtion)->exists()) {
                $d1DataToSave['created_on'] = $dateTime;
            }

            $modelD1Income::updateOrCreate($condtion, $d1DataToSave);

            $d2DataToSave = [
                "profit_loss_business_name" => Helper::validate_key_value('profit_loss_business_name', $D2TypeArray),
                "profit_loss_business_name_2" => Helper::validate_key_value('profit_loss_business_name_2', $D2TypeArray),
                "profit_loss_business_name_3" => Helper::validate_key_value('profit_loss_business_name_3', $D2TypeArray),
                "profit_loss_business_name_4" => Helper::validate_key_value('profit_loss_business_name_4', $D2TypeArray),
                "profit_loss_business_name_5" => Helper::validate_key_value('profit_loss_business_name_5', $D2TypeArray),
                "profit_loss_business_name_6" => Helper::validate_key_value('profit_loss_business_name_6', $D2TypeArray),
            ];

            $d2DataToSave['joints_operation_business'] = empty($D2TypeArray) ? 0 : 1;
            $d2DataToSave['updated_on'] = $dateTime;

            if (!$modelD2Income::where($condtion)->exists()) {
                $d2DataToSave['created_on'] = $dateTime;
            }

            $modelD2Income::updateOrCreate($condtion, $d2DataToSave);

            CacheIncome::forgetIncomeCache($client_id);
        }
    }

    public static function convertToArrayIfObject($data, $property)
    {
        if (property_exists($data, $property)) {
            $data->$property = is_object($data->$property) ? (array) $data->$property : $data->$property;
        }
    }

    public static function updateFinancialOwnBusiness($clientId, $businessData, $fromAttorney = false)
    {

        $modelFinancialAffair = $fromAttorney ? (QuestionnaireFinancialAffairs::class) : (FinancialAffairs::class);


        if ($modelFinancialAffair == QuestionnaireFinancialAffairs::class && $modelFinancialAffair::where('client_id', $clientId)->exists()) {
            $faModel = QuestionnaireFinancialAffairs::class;
        } else {
            $faModel = FinancialAffairs::class;
        }

        $financialAffairs = $faModel::select('list_nature_business_data')->where("client_id", $clientId)->first();
        $natureBusinessData = new stdClass();
        if (!empty($financialAffairs->list_nature_business_data)) {
            $natureBusinessData = json_decode($financialAffairs->list_nature_business_data);

            $properties = [
                'name', 'street_number', 'city', 'state', 'zip',
                'doesntHaveEin', 'eiin', 'operation_date',
                'business_still_open', 'operation_date2','type','businessDescription','own_business_selection','nature_of_business'
            ];
            $postedBusiness = json_decode($businessData, 1);
            $businessData = $postedBusiness ?? [];

            foreach ($properties as $property) {
                self::convertToArrayIfObject($natureBusinessData, $property);
            }
        }

        if (!is_array($businessData)) {
            $businessData = json_decode($businessData, true);  // Decode as associative array
        }

        if (!empty($businessData) && !empty($businessData['own_business_name'])) {
            $ownEinNo = [];
            if (!empty($businessData['own_ein_no'])) {
                $ownEinNo = isset($businessData['own_ein_no']) ? (array) $businessData['own_ein_no'] : $businessData['own_ein_no'];
            }

            $operationDate2 = [];
            if (!empty($businessData['operation_date2'])) {
                $operationDate2 = isset($businessData['operation_date2']) ? (array) $businessData['operation_date2'] : $businessData['operation_date2'];
            }

            $doesntHaveEin = [];
            if (!empty($businessData['doesntHaveEin'])) {
                $doesntHaveEin = isset($businessData['doesntHaveEin']) ? (array) $businessData['doesntHaveEin'] : $businessData['doesntHaveEin'];
            }

            $businessStillOpen = [];
            if (!empty($businessData['business_still_open'])) {
                $businessStillOpen = isset($businessData['business_still_open']) ? (array) $businessData['business_still_open'] : $businessData['business_still_open'];
            }

            $dataToSave = [];
            foreach ($businessData['own_business_name'] as $key => $data) {

                $dataToSave['name'][$key] = $data ?? "";
                $dataToSave['street_number'][$key] = $businessData['street_number'][$key] ?? "";
                $dataToSave['city'][$key] = $businessData['city'][$key] ?? "";
                $dataToSave['state'][$key] = $businessData['state'][$key] ?? "";
                $dataToSave['zip'][$key] = $businessData['zip'][$key] ?? "";
                $dataToSave['doesntHaveEin'][$key] = $doesntHaveEin[$key] ?? "";
                $dataToSave['eiin'][$key] = $ownEinNo[$key] ?? "";
                $dataToSave['operation_date'][$key] = $businessData['operation_date'][$key] ?? "";
                $dataToSave['business_still_open'][$key] = $businessStillOpen[$key] ?? "";
                $dataToSave['operation_date2'][$key] = $operationDate2[$key] ?? "";
                $dataToSave['type'][$key] = $businessData['type'][$key] ?? "";
                $dataToSave['businessDescription'][$key] = $businessData['businessDescription'][$key] ?? "";
                $dataToSave['own_business_selection'][$key] = $businessData['own_business_selection'][$key] ?? "";
                $dataToSave['business_nature'][$key] = $businessData['nature_of_business'][$key] ?? "";

            }

            $dataToSave = json_encode($dataToSave);

            $modelFinancialAffair::updateOrCreate(
                ['client_id' => $clientId],
                [
                    'client_id' => $clientId,
                    'list_nature_business_data' => $dataToSave
                ]
            );
        }
    }

}
