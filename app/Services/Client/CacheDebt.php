<?php

namespace App\Services\Client;

use App\Models\DebtsTax;
use App\Services\CreditorsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheDebt
{
    public static function getDebtData($client_id)
    {
        return Cache::remember("client:{$client_id}:debt", now()->addHours(24), function () use ($client_id) {
            Log::info("Fetching debt for client ID: {$client_id}");

            return self::getData($client_id);
        });
    }

    private static function getData($client_id)
    {
        $tax = DebtsTax::where('client_id', $client_id)->first();

        $data = CreditorsService::calculateTax($tax);
        if (!empty($data['debt_tax'])) {
            $data = self::modifyDebtTax($data);
        }

        return $data;
    }

    private static function modifyDebtTax($data)
    {
        if (isset($data['debt_tax']) && is_array($data['debt_tax'])) {
            $data['debt_tax'] = array_values(array_filter($data['debt_tax'], function ($item) {
                return !empty($item['cards_collections']);
            }));
        }

        return $data;
    }

    public static function forgetDebtCache($client_id)
    {
        Log::info("Forgetting debt cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:debt");
    }
}
