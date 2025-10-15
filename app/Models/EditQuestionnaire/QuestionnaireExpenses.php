<?php

namespace App\Models\EditQuestionnaire;

use App\Helpers\AddressHelper;
use App\Helpers\Helper;
use App\Models\Expenses;
use App\Services\Client\CacheExpense;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class QuestionnaireExpenses extends Model
{
    protected $guarded = [];
    protected $table = 'questionnaire_expenses';
    public $timestamps = false;

    public static function updateExpensesFromPropertyVehicle($save_request_by_attorney, $user, $client_id, $vehicles, $recreational)
    {

        // determine which expense model to use
        $modelExpenses = $save_request_by_attorney ? (QuestionnaireExpenses::class) : (Expenses::class);

        $expenses = $user->getExpenses($save_request_by_attorney);
        $expenses = (!empty($expenses)) ? $expenses->toArray() : [];

        $finalExpensesData = AddressHelper::getWithUtilityAndMortgage($expenses);

        $installment = self::getInstallments($vehicles, $recreational, $finalExpensesData);
        try {
            if (!empty($installment)) {
                $installment['client_id'] = $client_id;
                $installment['installment_payment_for_car'] = 1;
                $modelExpenses::updateOrCreate(['client_id' => $client_id], $installment);
            }
        } catch (\Exception $e) {
            Log::error('Error in updating/creating installment: ' . $e->getMessage(), [
                'exception' => $e,
                'client_id' => $client_id,
                'installment' => $installment ?? null,
            ]);
        }

        if (empty($installment)) {
            $installment['client_id'] = $client_id;
            $installment['installment_payment_for_car'] = 0;
            $installment['installmentpayments_type'] = json_encode([]);
            $installment['installmentpayments_value'] = null;
            $installment['installmentpayments_price'] = null;
            $modelExpenses::updateOrCreate(['client_id' => $client_id], $installment);
        }

        CacheExpense::forgetExpenseCache($client_id);

    }

    private static function getInstallments($vehicles, $recreational, $finalExpensesData)
    {
        $installmentsAfterDeleting = self::getInstallmentsAfterDeletingData($finalExpensesData);
        $installment = self::getInstallmentsFromVehicles($vehicles);
        $installment = self::getInstallmentsFromRecreational($recreational, $installment);
        $installment = self::getMergedInstallments($installmentsAfterDeleting, $installment);

        return $installment;
    }

    private static function getInstallmentsAfterDeletingData($finalExpensesData)
    {
        $installmentsAfterDeleting = [];
        if (!empty($finalExpensesData)) {
            $paymentType = Helper::validate_key_value('installmentpayments_type', $finalExpensesData);
            if (isset($paymentType) && !empty($paymentType)) {
                $inst = [
                            'installmentpayments_value' => Helper::validate_key_value('installmentpayments_value', $finalExpensesData) ?? [],
                            'installmentpayments_price' => Helper::validate_key_value('installmentpayments_price', $finalExpensesData) ?? [],
                            'installmentpayments_type' => $paymentType ?? []
                        ];
                $keysToDelete = [1, 2, 3, 4, 5, 6];
                $installmentsAfterDeleting = Helper::updateInstallmentPayments($inst, $keysToDelete);
            }
        }

        return $installmentsAfterDeleting;
    }

    private static function getInstallmentsFromVehicles($vehicles)
    {
        $installment = [];
        if (!empty($vehicles)) {
            foreach ($vehicles as $key => $value) {
                $installment['installmentpayments_value'][] = "Vehicle ".($key);
                $installment['installmentpayments_price'][] = $value;
                $installment['installmentpayments_type'][] = $key;
            }
        }

        return $installment;
    }

    private static function getInstallmentsFromRecreational($recreational, $installment = [])
    {
        if (!empty($recreational)) {
            $type = 5;
            foreach ($recreational as $key => $value) {
                $installment['installmentpayments_value'][] = "Recreational ".($key);
                $installment['installmentpayments_price'][] = $value;
                $installment['installmentpayments_type'][] = $type;
                $type++;
            }
        }

        return $installment;
    }

    private static function getMergedInstallments($installmentsAfterDeleting, $installment)
    {
        if (!empty($installmentsAfterDeleting)) {
            $installment['installmentpayments_value'] = json_encode(array_merge($installment['installmentpayments_value'] ?? [], $installmentsAfterDeleting['installmentpayments_value']));
            $installment['installmentpayments_price'] = json_encode(array_merge($installment['installmentpayments_price'] ?? [], $installmentsAfterDeleting['installmentpayments_price']));
            $installment['installmentpayments_type'] = json_encode(array_merge($installment['installmentpayments_type'] ?? [], $installmentsAfterDeleting['installmentpayments_type']));
        }

        return $installment;
    }

}
