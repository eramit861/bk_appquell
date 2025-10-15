<?php

namespace App\Services\Client;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class CacheBasicInfo
{
    public static function getBasicInformationData($client_id, $forClientSide = false, $forAttorneySide = false)
    {
        $context = $forClientSide ? 'client' : 'attorney';

        return Cache::remember("client:{$client_id}:basic_info:{$context}", now()->addHours(24), function () use ($client_id, $forClientSide, $forAttorneySide) {
            Log::info("Fetching basic information for client ID: {$client_id}, forClientSide: {$forClientSide}, forAttorneySide: {$forAttorneySide}");
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

        $BasicInfoPartA = $client->getBasicInfo();
        $BasicInfoPartRest = $client->getBasicInfoPartRest();
        $BasicInfoAnyOtherNameData = $client->getBasicInfoAnyOtherName();
        $BasicInfoPartBData = $client->getBasicInfoPartB();
        $BasicInfoPartCData = $client->getBasicInfoPartC();

        return [
            'BasicInfoPartA' => $BasicInfoPartA,
            'BasicInfo_AnyOtherName' => self::getCommonData($BasicInfoAnyOtherNameData),
            'BasicInfoPartB' => self::getCommonData($BasicInfoPartBData),
            'BasicInfo_PartC' => self::getCommonData($BasicInfoPartCData),
            'BasicInfo_PartD' => self::getDataPartD($BasicInfoPartCData),
            'BasicInfo_PartRest' => $BasicInfoPartRest,
            'BasicInfo_PartRestD' => self::parseInformation($BasicInfoPartRest)
        ];
    }

    private static function getDataAttorneySide($client_id, $forAttorneySide = false): array
    {
        $client = User::find($client_id);

        if (!$client) {
            Log::warning("Client not found for ID: {$client_id}");

            return [];
        }

        $BasicInfoPartRest = $client->getBasicInfoPartRest($forAttorneySide);
        if (empty($BasicInfoPartRest)) {
            $BasicInfoPartRest = [];
        }
        $BasicInfoPartCData = $client->getBasicInfoPartC($forAttorneySide);

        return [
            'BasicInfoPartA' => $client->getBasicInfo($forAttorneySide),
            'BasicInfo_AnyOtherName' => $client->getBasicInfoAnyOtherName($forAttorneySide),
            'BasicInfoPartB' => $client->getBasicInfoPartB($forAttorneySide),
            'BasicInfo_PartC' => $BasicInfoPartCData,
            'BasicInfo_PartD' => self::getDataPartD($BasicInfoPartCData),
            'BasicInfo_PartRest' => $BasicInfoPartRest,
            'BasicInfo_PartRestD' => self::parseInformation($BasicInfoPartRest),
        ];
    }

    private static function parseInformation($basicInfo): array
    {
        $result = [];
        if (!empty($basicInfo)) {
            $info = $basicInfo->toArray();
            foreach ($info as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    $data[$k] = json_decode($v, 1);
                    if (!empty($data[$k])) {
                        foreach ($data[$k] as $key => $value) {
                            $result[$key] = $value;
                        }
                    }
                } else {
                    $result[$k] = $v;
                }
            }
        }

        return $result;
    }

    private static function getCommonData($data)
    {
        $final_data = [];
        if (!empty($data)) {
            foreach ($data->toArray() as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    $adata[$k] = json_decode($v, 1);
                    $final_data[$k] = $adata[$k];
                } else {
                    $final_data[$k] = $v;
                }
            }
        }

        return $final_data;
    }

    private static function getDataPartD($data)
    {
        $final_data = [];
        if (!empty($data)) {
            foreach ($data->toArray() as $k => $v) {
                if (is_array(json_decode($v, 1))) {
                    $data[$k] = json_decode($v, 1);
                    if (!empty($data[$k])) {
                        foreach ($data[$k] as $kkey => $vv) {
                            $final_data[$kkey] = $vv;
                        }
                    }
                } else {
                    $final_data[$k] = $v;
                }
            }
        }

        return $final_data;
    }

    public static function forgetBasicInformationCache($client_id)
    {
        Log::info("Forgetting basic information cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:basic_info:client");
        Cache::forget("client:{$client_id}:basic_info:attorney");
    }
}
