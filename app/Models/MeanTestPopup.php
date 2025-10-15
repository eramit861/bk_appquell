<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeanTestPopup extends Model
{
    use HasFactory;
    protected $table = 'mean_test_popup';
    protected $fillable = [
        'client_id','household_size','av_gross_pay_1','av_tax_1','av_deduction_1','av_net_income_1','av_gross_pay_2','av_tax_2','av_deduction_2','av_net_income_2',
        'self_av_income_1','self_av_expense_1','self_av_net_income_1','self_av_income_2','self_av_expense_2','self_av_net_income_2','taxes','involuntary_deductions','term_life_insurance','court_ordered_payments',
        'education','child_care','telecommunication','health_insurance','disability_insurance','health_savings_accounts','care_and_support','protection_against','home_energy_costs','education_expenses',
        'food_and_clothing_expense','charitable_contribution','flagstar_bank_details','vehicles_bank_details','other_secured_debts_details','claim_taxes','claim_obligations','claim_other','claim_student_loans','income_or_expenses_details'
    ];


    public static function get_client_means_test_calculation($basic_info, $savedData, $zip, $county = '')
    {
        $savedData = isset($savedData['data']) && !empty($savedData['data']) ? json_decode($savedData['data'], 1) : null;
        $state = Helper::validate_key_value('district_full_name', $savedData);
        $stateShort = Helper::validate_key_value('district_name', $savedData);
        $statename = explode("of", $state);
        $state = trim($statename[1] ?? $stateShort);
        $state = self::getStateNameMapping($stateShort, $state);
        $state = self::getValiddState($basic_info, $state);
        $meansTestCalculation = [];
        $medianFamilyIncome = \App\Models\MedianFamilyIncome::Where("state", $state)->first();
        $familymembers = Helper::validate_key_value('household_size', $savedData);
        $meansTestCalculation = self::getMeanTestCaseData($familymembers, $medianFamilyIncome);
        $outOfPocketHealthCareExpnses = \App\Models\OutOfPocketHealthCareExpnses::get()->toArray();
        $meansTestCalculation = self::getOutOfPacketHealth($outOfPocketHealthCareExpnses, $meansTestCalculation);
        $meansTestCalculation = self::getFoodUtilityData($familymembers, $meansTestCalculation);
        $hoshingWithMortgageExpnses = \App\Models\MortgageHousingUtilities::where('county', $county)->first();
        $meansTestCalculation = self::getHoushingUtilityData($familymembers, $meansTestCalculation, $hoshingWithMortgageExpnses, 'houshing_util_with_mortgage');
        $hoshingWithOutMortgageExpnses = \App\Models\NonMortgageHousingUtilities::where('county', $county)->first();
        $meansTestCalculation = self::getHoushingUtilityData($familymembers, $meansTestCalculation, $hoshingWithOutMortgageExpnses, 'houshing_util_without_mortgage');
        $meansTestCalculation['no_people_outOfPocket_under_65'] = 3; // will get from client side, now there is no field in db
        $meansTestCalculation['no_people_outOfPocket_65_and_older'] = 2; // will get from client side, now there is no field in db

        return $meansTestCalculation;
    }

    private static function getMeanTestCaseData($familymembers, $medianFamilyIncome)
    {
        $meansTestCalculation['medianFamilyIncome'] = 0;
        if (!empty($medianFamilyIncome)) {
            $array = [
                1 => Helper::validate_key_value('one_earner', $medianFamilyIncome, 'float'),
                2 => Helper::validate_key_value('two_person', $medianFamilyIncome, 'float'),
                3 => Helper::validate_key_value('three_person', $medianFamilyIncome, 'float'),
                4 => Helper::validate_key_value('four_person', $medianFamilyIncome, 'float')
            ];

            if (in_array($familymembers, array_keys($array))) {
                $meansTestCalculation['medianFamilyIncome'] = $array[$familymembers];
            }

            if ($familymembers > 4) {
                $baseincome = Helper::validate_key_value('four_person', $medianFamilyIncome, 'float');

                $aditionalMember = $familymembers - 4;
                $perAdditionalMember = Helper::validate_key_value('additional_person_amount', $medianFamilyIncome, 'float');
                $meansTestCalculation['medianFamilyIncome'] = $baseincome + ($aditionalMember * $perAdditionalMember);
            }

            return $meansTestCalculation;
        }

        return $meansTestCalculation;
    }

    private static function getHoushingUtilityData($familymembers, $meansTestCalculation, $medianFamilyIncome, $type)
    {
        $meansTestCalculation[$type] = 0;
        if (!empty($medianFamilyIncome)) {
            $array = [
                1 => Helper::validate_key_value('OnePerson_amount', $medianFamilyIncome, 'float'),
                2 => Helper::validate_key_value('TwoPerson_amount', $medianFamilyIncome, 'float'),
                3 => Helper::validate_key_value('ThreePerson_amount', $medianFamilyIncome, 'float'),
                4 => Helper::validate_key_value('FourPerson_amount', $medianFamilyIncome, 'float')
            ];

            if (in_array($familymembers, array_keys($array))) {
                $meansTestCalculation[$type] = $array[$familymembers];
            }

            if ($familymembers > 4) {
                $baseincome = Helper::validate_key_value('FiveorMorePerson_amount', $medianFamilyIncome, 'float');
                $meansTestCalculation[$type] = $baseincome;
            }

            return $meansTestCalculation;
        }

        return $meansTestCalculation;
    }

    private static function getValiddState($basic_info, $state)
    {
        if (empty($state)) {
            $state = $basic_info['BasicInfoPartA']['state'];
            $staterow = \App\Models\State::where('state_code', $state)->first();
            if (!isset($staterow['state_name']) && !empty($staterow['state_name'])) {
                $atatearray = explode('(', $staterow['state_name']);
                $state = isset($atatearray[0]) ? trim($atatearray[0]) : '';
            }
        }

        return $state;
    }

    private static function getStateNameMapping($stateShort, $state)
    {
        if ($stateShort == 'Columbia') {
            $state = "District of " . $stateShort;
        }
        if ($stateShort == 'Mariana Islands') {
            $state = "Northern " . $stateShort;
        }

        return  $state;
    }


    private static function getOutOfPacketHealth($outOfPocketHealthCareExpnses, $meansTestCalculation)
    {
        if (!empty($outOfPocketHealthCareExpnses)) {
            foreach ($outOfPocketHealthCareExpnses as $data) {
                $meansTestCalculation['outOfPocket_' . $data['Age']] = $data['Out_of_Pocket_Costs'];
            }
        }

        return $meansTestCalculation;
    }

    private static function getFoodUtilityData($familymembers, $meansTestCalculation)
    {
        $foodClothing = \App\Models\FoodClothing::Where("Expense_Type", 'Food & Clothing')->first();
        $meansTestCalculation['food_clothing_cost'] = 0;
        if (!empty($foodClothing)) {
            $array = [
                1 => Helper::validate_key_value('OnePersonCost', $foodClothing, 'float'),
                2 => Helper::validate_key_value('TwoPersonCost', $foodClothing, 'float'),
                3 => Helper::validate_key_value('ThreePersonCost', $foodClothing, 'float'),
                4 => Helper::validate_key_value('FourPersonCost', $foodClothing, 'float')
            ];

            if (in_array($familymembers, [1, 2, 3, 4])) {
                $meansTestCalculation['food_clothing_cost'] = $array[$familymembers];
            }

            if ($familymembers > 4) {
                $baseincome = Helper::validate_key_value('FourPersonCost', $foodClothing, 'float');
                $aditionalMember = $familymembers - 4;
                $perAdditionalMember = Helper::validate_key_value('AdditionalPersonCost', $foodClothing, 'float');
                $meansTestCalculation['food_clothing_cost'] = $baseincome + ($aditionalMember * $perAdditionalMember);
            }

            return $meansTestCalculation;
        }

        return $meansTestCalculation;
    }
}
