<?php

namespace App\Services\Client;

use App\Models\User;
use App\Services\CreditorsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheIncome
{
    public static function getIncomeData($client_id, $forClientSide = false)
    {
        $context = $forClientSide ? 'client' : 'attorney';

        return Cache::remember("client:{$client_id}:income:{$context}", now()->addHours(24), function () use ($client_id, $forClientSide) {
            Log::info("Fetching income for client ID: {$client_id}, forClientSide: {$forClientSide}");

            return self::getData($client_id, $forClientSide);
        });
    }

    private static function getData($client_id, $forClientSide)
    {
        $client = User::find($client_id);

        if (!$client) {
            Log::warning("Client not found for ID: {$client_id}");

            return [];
        }

        $d1Employer = $client->incomeDebtorEmployer;
        $d1Employer = $d1Employer ? $d1Employer->toArray() : [];

        $d2Employer = $client->incomeDebtorSpouseEmployer;
        $d2Employer = $d2Employer ? $d2Employer->toArray() : [];

        $d1MI = $client->incomeDebtorMonthlyIncome;
        $d1MIFinal = CreditorsService::calculateTax($d1MI);
        $d1MIFinal['recieved_any_income'] = $d1Employer['recieved_any_income'] ?? '';

        $d2MI = $client->incomeDebtorSpouseMonthlyIncome;
        $d2MIFinal = CreditorsService::calculateTax($d2MI);
        $d2MIFinal['recieved_any_income'] = $d2Employer['recieved_any_income'] ?? '';

        $data = [
            'incomedebtoremployer' => $d1Employer,
            'debtorspouseemployer' => $d2Employer,
            'debtormonthlyincome' => $d1MIFinal,
            'debtorspousemonthlyincome' => $d2MIFinal,
        ];

        if ($forClientSide) {
            $data['plIsImportedDebtor'] = true;
            $data['plIsImportedCodebtor'] = true;
        }

        return $data;
    }

    public static function forgetIncomeCache($client_id)
    {
        Log::info("Forgetting income cache for client ID: {$client_id}");
        Cache::forget("client:{$client_id}:income:client");
        Cache::forget("client:{$client_id}:income:attorney");
    }
}
