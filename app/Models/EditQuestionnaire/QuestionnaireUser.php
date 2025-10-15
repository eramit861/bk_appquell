<?php

namespace App\Models\EditQuestionnaire;

use App\Helpers\Helper;
use App\Models\User;

class QuestionnaireUser extends User
{
    public static function getQuestionnaireFunction($key)
    {
        $arr = [
            // Basic Info Keys
            'DebtorInfo' => 'questionnaireBasicInfoPartA',
            'CoDebtorInfo' => 'questionnaireBasicInfoPartB',
            'BusinessInfo' => 'questionnaireBasicInfoPartC',
            // Property Keys
            'PropertyResidenceInfo' => 'questionnairePropertyResident',
            'PropertyVehicleInfo' => 'questionnairePropertyVehicle',
            'PropertyHouseholdInfo' => 'questionnairePropertyHousehold',
            'PropertyFinancialAssetInfo' => 'questionnairePropertyFinancialAssets',
            'PropertyFinancialAssetContinuedInfo' => 'questionnairePropertyFinancialAssets',
            'PropertyBusinessAssetInfo' => 'questionnairePropertyBusinessAssets',
            'PropertyFarmCommercialInfo' => 'questionnairePropertyFarmCommercial',
            'PropertyMiscellaneousInfo' => 'questionnairePropertyMiscellaneous',
            // Expense Keys
            'ExpenseDebtor' => 'questionnaireExpenses',
            'ExpenseSpouse' => 'questionnaireSpouseExpenses',
            // Sofa Keys
            'FinancialAffairs' => 'questionnaireFinancialAffairs',

        ];

        return Helper::returnArrValue($arr, $key);
    }

    public static function get_AB_FORM_LINE_NUMBERS($key)
    {
        $arr = [
            'resident_property' => 1,
            'vehicle_property' => 3,
            'household_property' => 6,
            'financial_assets' => 29,
            'financial_assets_continue' => 16,
            'business_related_assets' => 37,
            'farm_and_commercial_fishing_related_property' => 46,
            'miscellaneous' => 53

        ];

        return Helper::returnArrValue($arr, $key);
    }

    public static function isAddedByAttorney($key, $user)
    {
        $function = self::getQuestionnaireFunction($key);
        if (method_exists($user, $function)) {

            $queKeys = [];

            switch ($key) {
                case 'PropertyFinancialAssetInfo':
                    $queKeys = Helper::PROPERTY_FINANCIAL_ASSETS_QUE_KEYS;
                    break;
                case 'PropertyFinancialAssetContinuedInfo':
                    $queKeys = Helper::PROPERTY_FINANCIAL_ASSETS_CONTINUTED_QUE_KEYS;
                    break;
            }

            $query = $user->$function()
                        ->whereNotNull('reviewed_by')
                        ->whereNotNull('reviewed_on')
                        ->where('reviewed_by', '!=', '')
                        ->where('reviewed_on', '!=', '');

            if (!empty($queKeys)) {
                $query = $query->whereIn('type', $queKeys);
            }

            $data = $query->select('reviewed_by', 'reviewed_on')->first();

            if ($data && !empty($data->reviewed_by) && !empty($data->reviewed_on)) {
                $attorneyUser = User::where('id', $data->reviewed_by)->select('name')->first();
                if ($attorneyUser) {
                    return [
                        'reviewed_by_name' => $attorneyUser->name,
                        'reviewed_by' => $data->reviewed_by,
                        'reviewed_on' => $data->reviewed_on,
                    ];
                }
            }
        }

        return false;
    }

}
