<?php

namespace App\Services\Client;

use App\Helpers\ClientHelper;
use App\Helpers\Helper;
use App\Models\FinancialAffairs;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheSOFA
{
    public static function getSOFAData($client_id, $modal = FinancialAffairs::class)
    {
        $content = ($modal == FinancialAffairs::class) ? 'FinancialAffairs' : 'QuestionnaireFinancialAffairs';

        return Cache::remember("client:{$client_id}:sofa:{$content}", now()->addHours(24), function () use ($client_id, $modal) {
            Log::info("Fetching SOFA for client ID: {$client_id}, modal: {$modal}");

            return self::getData($client_id, $modal);
        });
    }

    private static function getData($client_id, $modal)
    {
        $data = $modal::where('client_id', $client_id)
            ->select(ClientHelper::getFinancialFoields())
            ->first();

        return Helper::getFinacialAffairsUpdateArray($data);
    }

    public static function forgetSOFACache($client_id)
    {
        Log::info("Forgetting SOFA cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:sofa:FinancialAffairs");
        Cache::forget("client:{$client_id}:sofa:QuestionnaireFinancialAffairs");
    }
}
