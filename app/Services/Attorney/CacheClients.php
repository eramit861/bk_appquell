<?php

namespace App\Services\Client;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheClients
{
    public static function storeAttorneyClientsData($attorneyId)
    {
        return Cache::remember("client:{$client_id}:basic_info:{$context}", now()->addHours(24), function () use ($client_id, $forClientSide, $forAttorneySide) {
            Log::info("Fetching basic information for client ID: {$client_id}, forClientSide: {$forClientSide}, forAttorneySide: {$forAttorneySide}");
        });
    }

    public static function forgetAttorneyClientsCache($client_id)
    {
        Log::info("Forgetting basic information cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:basic_info:client");
    }
}
