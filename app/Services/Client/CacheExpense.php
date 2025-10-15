<?php

namespace App\Services\Client;

use App\Helpers\AddressHelper;
use App\Models\Expenses;
use App\Models\SpouseExpenses;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheExpense
{
    public static function getExpenseData($client_id, $forSpouse = false, $sortInstallmentPayments = false)
    {
        $context = $forSpouse ? 'spouse' : 'debtor';

        return Cache::remember("client:{$client_id}:expense:{$context}", now()->addHours(24), function () use ($client_id, $forSpouse, $sortInstallmentPayments) {
            Log::info("Fetching expense for client ID: {$client_id}, forSpouse: {$forSpouse}, sortInstallmentPayments: {$sortInstallmentPayments}");
            if ($forSpouse) {
                return self::getDataSpouse($client_id);
            } else {
                return self::getDataDebor($client_id, $sortInstallmentPayments);
            }
        });
    }

    private static function getDataDebor($client_id, $sortInstallmentPayments)
    {
        $expenses = Expenses::where('client_id', $client_id)->first();
        $expenses = (!empty($expenses)) ? $expenses->toArray() : [];
        $final_expenses = AddressHelper::getWithUtilityAndMortgage($expenses);
        if ($sortInstallmentPayments) {
            $final_expenses = self::sortInstallmentPayments($final_expenses);
        }

        return $final_expenses;
    }

    private static function getDataSpouse($client_id)
    {
        $expenses = SpouseExpenses::where('client_id', $client_id)->first();
        $expenses = (!empty($expenses)) ? $expenses->toArray() : [];

        return AddressHelper::getWithUtilityAndMortgage($expenses);
    }
    private static function sortInstallmentPayments($data)
    {
        if (isset($data['installmentpayments_value'], $data['installmentpayments_price'], $data['installmentpayments_type'])) {
            $combinedArray = array_map(function ($value, $price, $type) {
                return compact('value', 'price', 'type');
            }, $data['installmentpayments_value'], $data['installmentpayments_price'], $data['installmentpayments_type']);
            array_multisort(array_column($combinedArray, 'type'), $combinedArray);
            $data['installmentpayments_value'] = array_column($combinedArray, 'value');
            $data['installmentpayments_price'] = array_column($combinedArray, 'price');
            $data['installmentpayments_type'] = array_column($combinedArray, 'type');
        }

        return $data;
    }

    public static function forgetExpenseCache($client_id)
    {
        Log::info("Forgetting expense cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:expense:debtor");
        Cache::forget("client:{$client_id}:expense:spouse");
    }
}
