<?php

namespace App\Services\Client;

use App\Models\User;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheProperty
{
    public static function getPropertyData($client_id, $forClientSide = false, $forAttorneySide = false)
    {
        $context = $forClientSide ? 'client' : 'attorney';

        return Cache::remember("client:{$client_id}:property:{$context}", now()->addHours(24), function () use ($client_id, $forClientSide, $forAttorneySide) {
            Log::info("Fetching property for client ID: {$client_id}, forClientSide: {$forClientSide}, forAttorneySide: {$forAttorneySide}");
            if ($forClientSide) {
                return self::getDataClientSide($client_id);
            } else {
                return self::getDataAttorneySide($client_id, $forAttorneySide);
            }
        });
    }

    private static function getDataClientSide($client_id)
    {
        $client = User::find($client_id);

        if (!$client) {
            Log::warning("Client not found for ID: {$client_id}");

            return [];
        }

        $enable_free_bank_statements = $client->ClientsAttorneybyclient->getuserattorney->enable_free_bank_statements;
        $propertyresident = $client->clientsPropertyResident;
        $propertyvehicle = $client->clientsPropertyVehicle;
        $propertyhousehold = $client->clientsPropertyHousehold->toArray();
        $financialassets = $client->clientsPropertyFinancialAssets->toArray();
        $isBusinessProperty = $client->clientsPropertyBusinessAssets->where('type', 'is_business_property')->first();
        $businessassets = $client->clientsPropertyBusinessAssets->toArray();
        $isFarmProperty = $client->clientsPropertyFarmCommercial->where('type', 'is_farm_property')->first();
        $farmcommercial = $client->clientsPropertyFarmCommercial->toArray();
        $miscellaneous = $client->clientsPropertyMiscellaneous->toArray();
        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        return [
            'propertyresident' => $propertyresident,
            'propertyvehicle' => $propertyvehicle,
            'propertyhousehold' => $propertyhousehold,
            'financialassets' => $financialassets,
            'isBusinessProperty' => $isBusinessProperty,
            'businessassets' => $businessassets,
            'isFarmProperty' => $isFarmProperty,
            'farmcommercial' => $farmcommercial,
            'miscellaneous' => $miscellaneous,
            'district_names' => $district_names,
            'enable_free_bank_statements' => $enable_free_bank_statements
        ];

    }

    private static function getDataAttorneySide($client_id, $forAttorneySide = false): array
    {
        $client = User::find($client_id);

        if (!$client) {
            Log::warning("Client not found for ID: {$client_id}");

            return [];
        }

        return [
              'propertyresident' => $client->getPropertyResident($forAttorneySide),
              'propertyvehicle' => $client->getPropertyVehicle($forAttorneySide),
              'propertyhousehold' => $client->getPropertyHousehold($forAttorneySide)->toArray(),
              'financialassets' => $client->getPropertyFinancialAssets($forAttorneySide)->toArray(),
              'businessassets' => $client->getPropertyBusinessAssets($forAttorneySide)->toArray(),
              'farmcommercial' => $client->getPropertyFarmCommercial($forAttorneySide)->toArray(),
              'miscellaneous' => $client->getPropertyMiscellaneous($forAttorneySide)->toArray()
        ];

    }

    public static function forgetPropertyCache($client_id)
    {
        Log::info("Forgetting property cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:property:client");
        Cache::forget("client:{$client_id}:property:attorney");
    }
}
