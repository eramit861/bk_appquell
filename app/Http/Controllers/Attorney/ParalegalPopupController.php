<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\ClientHelper;
use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Models\User;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;
use Illuminate\Http\Request;

class ParalegalPopupController extends AttorneyController
{
    public function paralegal_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $any_other_name = $input['any_other_name'];
        $ssn1 = $input['ssn1'];
        $hasssn2 = $input['hasssn2'];
        $hasssn = $input['hasssn'];
        $itin_full = $input['itin_full'];
        $income_q4_d1 = $input['income_q4_d1'];
        $income_q4_d2 = $input['income_q4_d2'];
        $income_q5_d1 = $input['income_q5_d1'];
        $income_q5_d2 = $input['income_q5_d2'];
        $usedbizdata = $input['usedbizdata'];

        if ($client_id == 0) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $incomeData = CacheIncome::getIncomeData($client_id);

        $debtorIncome = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
        $debtorIncome = User::getSelectedColumnsFromArray($debtorIncome, ["social_security",
                "social_security_month",
                "retirement_income",
                "retirement_income_month",
                "unemployment_compensation",
                "unemployment_compensation_month",
                "government_assistance",
                "government_assistance_specify",
                "operation_business",
                "otherDeductions11",
                "other_deduction_specify",
                "other_deduction",
                "automatically_deduction_insurance",
                "paycheck_mandatory_contribution",
                "paycheck_voluntary_contribution","union_dues_deducted"
            ]);

        $spouseIncome = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        $spouseIncome = User::getSelectedColumnsFromArray($spouseIncome, ["joints_union_dues_deducted",
                "joints_paycheck_mandatory_contribution",
                "joints_paycheck_voluntary_contribution",
                "joints_social_security",
                "joints_social_security_month",
                "joints_retirement_income",
                "joints_retirement_income_month",
                "joints_unemployment_compensation",
                "joints_unemployment_compensation_month",
                "government_assistance",
                "government_assistance_specify",
                "joints_operation_business",
                "otherDeductions22",
                "other_deduction_specify",
                "joints_other_deduction"
            ]);

        $property = CacheProperty::getPropertyData($client_id, false, true);

        $resident = Helper::validate_key_value('propertyresident', $property, 'array');
        $resident = !empty($resident) ? $resident->toArray() : [];

        $vehicle = Helper::validate_key_value('propertyvehicle', $property, 'array');
        $recretional = $vehicle;

        $vehicle = !empty($vehicle) ? $vehicle->where("property_type", "!=", Helper::VEHICLE_RECREATINAL_VEHICLE)->toArray() : [];
        $vehicle = array_values($vehicle);
        $recretional = !empty($recretional) ? $recretional->where('property_type', Helper::VEHICLE_RECREATINAL_VEHICLE)->toArray() : [];
        $recretional = array_values($recretional);

        $householdExists = !empty(Helper::validate_key_value('propertyhousehold', $property, 'array'));
        $financialExists = !empty(Helper::validate_key_value('financialassets', $property, 'array'));
        $businessExists = !empty(Helper::validate_key_value('businessassets', $property, 'array'));
        $farmExists = !empty(Helper::validate_key_value('farmcommercial', $property, 'array'));
        $miscExists = !empty(Helper::validate_key_value('miscellaneous', $property, 'array'));

        $quest27bizname = [];
        $quest27einNum = [];

        $sofaData = CacheSOFA::getSOFAData($client_id);
        $sofaData = User::getSelectedColumnsFromArray($sofaData, [
            "total_amount_income",
            "total_amount_income_spouse",
            "other_income_received_income",
            "other_income_received_income_spouse",
            "primarily_consumer_debets",
            "employer_identification",
            "list_financial_institutions",
            "list_nature_business_data",

            "total_amount_this_year_income",
            "total_amount_last_year_income",
            "total_amount_lastbefore_year_income",

            "total_amount_spouse_this_year_income",
            "total_amount_spouse_last_year_income",
            "total_amount_spouse_lastbefore_year_income",
            "primarily_consumer_debets_data",
            "payment_past_one_year",
            "other_amount_this_year_income",
            "other_amount_last_year_income",
            "other_amount_lastbefore_year_income",

            "other_amount_spouse_this_year_income",
            "other_amount_spouse_last_year_income",
            "other_amount_spouse_lastbefore_year_income"
            ]);

        $finaanical27Aff = Helper::validate_key_value('list_nature_business_data', $sofaData, 'array');
        if (!empty($finaanical27Aff['name'])) {
            for ($i = 0;$i < count($finaanical27Aff['name']);$i++) {
                $finacial_affairs_nature = $finaanical27Aff;
                $quest27bizname[] = Helper::validate_key_loop_value('name', $finacial_affairs_nature, $i);
                $quest27einNum[] = Helper::validate_key_loop_value('eiin', $finacial_affairs_nature, $i);
            }
        }

        return view('attorney.official_form.paralegal_popup', [
                'client_id' => $client_id,
                'debtorIncome' => $debtorIncome,
                'spouseIncome' => $spouseIncome,
                'resident' => $resident,
                'vehicle' => $vehicle,
                'partRest' => $usedbizdata,
                'recretional' => $recretional,
                'quest27bizname' => $quest27bizname,
                'quest27einNum' => $quest27einNum,
                'householdExists' => $householdExists,
                'financialExists' => $financialExists,
                'businessExists' => $businessExists,
                'farmExists' => $farmExists,
                'miscExists' => $miscExists,
                'financialAffairs' => ClientHelper::formatInputJson($sofaData),
                'any_other_name' => $any_other_name,
                'ssn1' => $ssn1,
                'itin_full' => $itin_full,
                'income_q4_d1' => $income_q4_d1,
                'income_q4_d2' => $income_q4_d2,
                'income_q5_d1' => $income_q5_d1,
                'income_q5_d2' => $income_q5_d2,
                'hasssn' => $hasssn,
                'hasssn2' => $hasssn2
            ]);
    }

}
