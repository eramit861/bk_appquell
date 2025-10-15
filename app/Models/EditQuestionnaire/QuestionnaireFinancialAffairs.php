<?php

namespace App\Models\EditQuestionnaire;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use App\Models\FinancialAffairs;
use App\Services\Client\CacheSOFA;

class QuestionnaireFinancialAffairs extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_financial_affairs';
    public $timestamps = false;

    public static function updateFinancialAffairsFromPropertyVehicle($save_request_by_attorney, $user, $propertyVehicleFinal, $client_id)
    {
        // determine which Financial Affair model to use
        $modelFinanciaAffairs = $save_request_by_attorney ? (QuestionnaireFinancialAffairs::class) : (FinancialAffairs::class);

        $finacialAffairs = $user->getFinancialAffairs($save_request_by_attorney)->first();
        $finacialAffairsFinal = Helper::getFinacialAffairsUpdateArray($finacialAffairs);

        $dataToSave = [
            'primarily_consumer_debets' => Helper::validate_key_value('primarily_consumer_debets', $finacialAffairsFinal) ?? null,
            'primarily_consumer_debets_data' => Helper::validate_key_value('primarily_consumer_debets_data', $finacialAffairsFinal) ?? '',
        ];

        $debtsData = self::getDebtsData($dataToSave, $propertyVehicleFinal);

        $dataToSave['primarily_consumer_debets'] = 1;
        $dataToSave['primarily_consumer_debets_data'] = json_encode($debtsData);
        $dataToSave['client_id'] = $client_id;

        $modelFinanciaAffairs::updateOrCreate(
            ["client_id" => $client_id],
            $dataToSave
        );

        // clear cache for client SOFA
        CacheSOFA::forgetSOFACache($client_id);

    }

    private static function getDebtsData($filteredData, $propertyVehicleFinal)
    {
        $debtsData = Helper::validate_key_value('primarily_consumer_debets_data', $filteredData) ?? [];

        $keysToDelete = [2];
        $debtsData = Helper::updateAllLoanPayments($debtsData, $keysToDelete);
        $debtsData = Helper::updatePaymentsInDebtsData($debtsData);

        if (!empty($propertyVehicleFinal)) {
            foreach ($propertyVehicleFinal as $data) {
                $i = 0;
                $ownAnyProperty = Helper::validate_key_value('own_any_property', $data, 'radio');
                $hasAnyLoan = Helper::validate_key_value('loan_own_type_property', $data, 'radio');
                if (isset($ownAnyProperty) && $ownAnyProperty == 1 && isset($hasAnyLoan) && $hasAnyLoan == 1) {
                    $vehicleCarLoan = Helper::validate_key_value('vehicle_car_loan', $data);
                    $valueData = json_decode($vehicleCarLoan, 1);
                    if (Helper::validate_key_value('is_vehicle_three_months', $valueData, 'radio') == 1 && Helper::validate_key_value('total_amount_paid', $valueData) >= 600) {
                        $debtsData['creditor_address'][] = Helper::validate_key_value('creditor_name', $valueData);
                        $debtsData['creditor_street'][] = Helper::validate_key_value('creditor_name_addresss', $valueData);
                        $debtsData['creditor_city'][] = Helper::validate_key_value('creditor_city', $valueData);
                        $debtsData['creditor_state'][] = Helper::validate_key_value('creditor_state', $valueData);
                        $debtsData['creditor_zip'][] = Helper::validate_key_value('creditor_zip', $valueData);
                        $debtsData['payment_1'][] = Helper::validate_key_value('payment_1', $valueData);
                        $debtsData['payment_2'][] = Helper::validate_key_value('payment_2', $valueData);
                        $debtsData['payment_3'][] = Helper::validate_key_value('payment_3', $valueData);
                        $debtsData['payment_dates'][] = Helper::validate_key_value('payment_dates_1', $valueData);
                        $debtsData['payment_dates2'][] = Helper::validate_key_value('payment_dates_2', $valueData);
                        $debtsData['payment_dates3'][] = Helper::validate_key_value('payment_dates_3', $valueData);
                        $debtsData['total_amount_paid'][] = Helper::validate_key_value('total_amount_paid', $valueData);
                        $debtsData['amount_still_owed'][] = Helper::validate_key_value('amount_own', $valueData);
                        $debtsData['creditor_payment_for'][] = "2";
                        $i++;
                    }
                }
            }
        }

        return $debtsData;
    }

    public static function updateFinancialAffairsFromPropertyFinancialAssets($input, $client_id, $save_request_by_attorney)
    {

        $dataToUpdate = [
            'client_id' => $client_id,
            'list_all_financial_accounts' => Helper::validate_key_value('list_all_financial_accounts', $input, 'radio'),
            'list_all_financial_accounts_data' => json_encode(Helper::validate_key_value('list_all_financial_accounts_data', $input, 'array')),
            'all_property_transfer_10_year' => Helper::validate_key_value('all_property_transfer_10_year', $input, 'radio'),
            'all_property_transfer_10_year_data' => json_encode(Helper::validate_key_value('all_property_transfer_10_year_data', $input, 'array')),
            'updated_on' => date("Y-m-d H:i:s")
        ];

        // determine which Financial Affair model to use
        $modelFinanciaAffairs = $save_request_by_attorney ? (QuestionnaireFinancialAffairs::class) : (FinancialAffairs::class);

        $modelFinanciaAffairs::updateOrCreate(['client_id' => $client_id], $dataToUpdate);

        // clear cache for client SOFA
        CacheSOFA::forgetSOFACache($client_id);

    }
}
