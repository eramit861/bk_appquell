<?php

namespace App\Services\Client;

use App\Models\Expenses;
use App\Models\SpouseExpenses;
use App\Models\FormsStepsCompleted;
use App\Helpers\ClientHelper;
use App\Helpers\Helper;

class ExpenseManagementService
{
    /**
     * Setup expense data for debtor
     */
    public function setupExpense(array $input, int $clientId): void
    {
        $finalInput = ClientHelper::formatInputJson($input);
        $finalInput['client_id'] = $clientId;

        Expenses::updateOrCreate(['client_id' => $clientId], $finalInput);
        CacheExpense::forgetExpenseCache($clientId);
    }

    /**
     * Create or update spouse expense data
     */
    public function createOrUpdateSpouseExpense(int $clientId, array $input): void
    {
        unset($input['_token']);
        $finalInput = ClientHelper::formatInputJson($input);
        $finalInput['client_id'] = $clientId;

        SpouseExpenses::updateOrCreate(['client_id' => $clientId], $finalInput);
        CacheExpense::forgetExpenseCache($clientId);

        // Mark step as completed
        FormsStepsCompleted::updateOrCreate(["client_id" => $clientId], ['client_id' => $clientId, 'step5' => 1]);
    }

    /**
     * Get rental flag based on property data
     */
    public function getRentalFlag(int $clientId): bool
    {
        $rentedFlag = false;

        $propertyData = CacheProperty::getPropertyData($clientId);
        $clientProperty = Helper::validate_key_value('propertyresident', $propertyData, 'array');
        $checkRented = !empty($clientProperty) ? $clientProperty->first() : [];

        if (isset($checkRented->currently_lived) && $checkRented->currently_lived == 0) {
            $rentedFlag = true;
        }

        return $rentedFlag;
    }

}
