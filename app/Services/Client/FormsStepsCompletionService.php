<?php

namespace App\Services\Client;

use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AttorneySubscription;

class FormsStepsCompletionService
{
    public static function getTab1CompletionData($response, $clientId, $clientType)
    {
        $percent = 0;

        $BIData = CacheBasicInfo::getBasicInformationData($clientId, true, false);
        $sofaData = CacheSOFA::getSOFAData($clientId);

        // Step 1 Data
        $step1Data = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $step1ExtraData = Helper::validate_key_value('BasicInfo_AnyOtherName', $BIData, 'array');

        // Step 2 Data
        $step2Data = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        // Step 3 Data
        $step3Data = Helper::validate_key_value('BasicInfo_PartC', $BIData, 'array');
        $step3ExtraData = Helper::validate_key_value('BasicInfo_PartRest', $BIData, 'array');

        // Initialize step percentage containers
        $step1PercentageData = [
                'percentDone' => 0,
                'percentTotal' => 0
            ];
        $step2PercentageData = [
                'percentDone' => 0,
                'percentTotal' => 0
            ];
        $step3PercentageData = [
                'percentDone' => 0,
                'percentTotal' => 0
            ];

        if (!empty($step1Data)) {
            $data = is_array($step1Data) ? $step1Data : $step1Data->toArray();
            $conditions = [
                'name', 'last_name', 'any_other_name', 'has_security_number',
                'Address', 'City', 'state', 'zip', 'country', 'lived_address_from_180'
            ];

            // Adjust conditionally
            if (Helper::validate_key_value('has_security_number', $data, 'radio') == 0) {
                $conditions[] = 'security_number';
            } else {
                $conditions[] = 'itin';
            }

            $maxPercent = ($clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) ? 22.92 : 34.37;

            $totalCount = count($conditions) + 2;
            $percentagePerCount = $maxPercent / $totalCount;
            $step1PercentageSingleStep = $percentagePerCount * count($conditions);
            $step1PercentageSingleStepFA = $percentagePerCount * 2;


            $stepPercent = self::getPerStepQuestionPercentage($data, $conditions, $step1PercentageSingleStep);
            $stepPercentFA = self::getPerStepQuestionPercentage($sofaData, ['list_every_address', 'living_domestic_partner'], $step1PercentageSingleStepFA);
            $stepPercent = $stepPercent + $stepPercentFA;

            $percent += $stepPercent;

            $step1PercentageData = [
                'percentDone' => $stepPercent,
                'percentTotal' => $maxPercent
            ];
        }

        if (!empty($step1ExtraData)) {
            $data = is_array($step1ExtraData) ? $step1ExtraData : $step1ExtraData->toArray();
            $conditions = ['home', 'cell', 'work', 'date_of_birth', 'email'];
            $maxPercent = ($clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) ? 10.41 : 15.63;
            $stepExtraPercent = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
            $percent += $stepExtraPercent;

            // Combine with previous
            $step1PercentageData['percentDone'] = round($step1PercentageData['percentDone'] + $stepExtraPercent);
            $step1PercentageData['percentTotal'] = round($step1PercentageData['percentTotal'] + $maxPercent);
        }

        // STEP 2
        if (!empty($step2Data) && $clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) {
            $data = is_array($step2Data) ? $step2Data : $step2Data->toArray();
            $conditions = [
                'name', 'last_name', 'spouse_any_other_name', 'part2_driving_license',
                'part2_dob', 'part2_phone', 'has_security_number', 'lived_address_from_180', 'spouse_different_address'
            ];

            if (Helper::validate_key_value('has_security_number', $data, 'radio') == 0) {
                $conditions[] = 'social_security_number';
            } else {
                $conditions[] = 'itin';
            }

            $maxPercent = 33.33;
            $stepPercent = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
            $percent += $stepPercent;

            $step2PercentageData = [
                'percentDone' => round($stepPercent),
                'percentTotal' => round($maxPercent)
            ];
        }

        // STEP 3
        if (!empty($step3Data)) {
            $data = is_array($step3Data) ? $step3Data : $step3Data->toArray();
            $conditions = ['pending_pior_cases'];
            $maxPercent = ($clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) ? 11.11 : 16.66;
            $stepPercent = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
            $percent += $stepPercent;

            $step3PercentageData = [
                'percentDone' => $stepPercent,
                'percentTotal' => $maxPercent
            ];
        }

        if (!empty($step3ExtraData)) {
            $data = is_array($step3ExtraData) ? $step3ExtraData : $step3ExtraData->toArray();
            $conditions = ['used_business_ein'];
            $maxPercent = ($clientType == Helper::CLIENT_TYPE_JOINT_MARRIED) ? 22.22 : 33.33;
            $stepExtraPercent = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
            $percent += $stepExtraPercent;

            $step3PercentageData['percentDone'] = round($step3PercentageData['percentDone'] + $stepExtraPercent);
            $step3PercentageData['percentTotal'] = round($step3PercentageData['percentTotal'] + $maxPercent);
        }

        $response['tab1_percentage'] = round($percent);
        $stepPercentages = [
            'step1' => $step1PercentageData,
            'step2' => $step2PercentageData,
            'step3' => $step3PercentageData,
        ];
        $response['tab1_percentage_by_steps'] = self::addStepCompletionClass($stepPercentages);

        return $response;
    }

    public static function getTab2CompletionData($response, $clientId)
    {
        $percent = 0;
        $totalSteps = 5;
        $enableBusinessProperty = false;
        $enableFarmProperty = false;

        $propertyData = CacheProperty::getPropertyData($clientId);
        $sofaData = CacheSOFA::getSOFAData($clientId);

        $step4Data = Helper::validate_key_value('financialassets', $propertyData, 'array');
        $step6Data = Helper::validate_key_value('businessassets', $propertyData, 'array');
        $step7Data = Helper::validate_key_value('farmcommercial', $propertyData, 'array');

        if (!empty($step6Data) && is_array($step6Data)) {
            foreach ($step6Data as $asset) {
                if ((isset($asset['type']) && isset($asset['type_value'])) && $asset['type'] == 'is_business_property') {
                    array_push($step4Data, $asset);
                    if ($asset['type_value'] == 1) {
                        $totalSteps = $totalSteps + 1;
                        $enableBusinessProperty = true;
                    }
                    break;
                }
            }
        }

        if (!empty($step7Data) && is_array($step7Data)) {
            foreach ($step7Data as $asset) {
                if ((isset($asset['type']) && isset($asset['type_value'])) && $asset['type'] == 'is_farm_property') {
                    array_push($step4Data, $asset);
                    if ($asset['type_value'] == 1) {
                        $totalSteps = $totalSteps + 1;
                        $enableFarmProperty = true;
                    }
                    break;
                }
            }
        }

        $singleStepPercent = 100 / $totalSteps;

        $stepPercentages = [
            'step1' => ['percentDone' => 0, 'percentTotal' => round($singleStepPercent)],
            'step2' => ['percentDone' => 0, 'percentTotal' => round($singleStepPercent)],
            'step3' => ['percentDone' => 0, 'percentTotal' => round($singleStepPercent)],
            'step4' => ['percentDone' => 0, 'percentTotal' => round($singleStepPercent)],
            'step5' => ['percentDone' => 0, 'percentTotal' => round($singleStepPercent)],
            'step6' => ['percentDone' => 0, 'percentTotal' => $enableBusinessProperty ? round($singleStepPercent) : 0],
            'step7' => ['percentDone' => 0, 'percentTotal' => $enableFarmProperty ? round($singleStepPercent) : 0],
        ];


        // Step 1: Residence
        $step1Data = Helper::validate_key_value('propertyresident', $propertyData, 'array');
        if ($step1Data->isNotEmpty()) {
            $percent += $singleStepPercent;
            $stepPercentages['step1']['percentDone'] = round($singleStepPercent);
        }
        // Step 2: Vehicles
        $step2Data = Helper::validate_key_value('propertyvehicle', $propertyData, 'array');
        if ($step2Data->isNotEmpty()) {
            $percent += $singleStepPercent;
            $stepPercentages['step2']['percentDone'] = round($singleStepPercent);
        }
        // Step 3: Household Items
        $step3Data = Helper::validate_key_value('propertyhousehold', $propertyData, 'array');
        $step3Conditions = [
            'household_goods_furnishings', 'electronics', 'collectibles', 'sports', 'firearms',
            'clothing', 'jewelry', 'pets', 'health_aids'
        ];
        $step3Percent = self::getPerStepQuestionPercentageProperty($step3Data, $step3Conditions, $singleStepPercent);
        $percent += $step3Percent;
        $stepPercentages['step3']['percentDone'] = round($step3Percent);
        // Step 4: Financial Assets
        $step4Conditions = Helper::PROPERTY_FINANCIAL_ASSETS_QUE_KEYS;

        $totalCount = count($step4Conditions) + 2;
        $percentagePerCount = $singleStepPercent / $totalCount;

        $step4PercentageSingleStep = $percentagePerCount * count($step4Conditions);
        $step4PercentageSingleStepFA = $percentagePerCount * 2;

        $step4Percent = self::getPerStepQuestionPercentageProperty($step4Data, $step4Conditions, $step4PercentageSingleStep);
        $step4PercentFA = self::getPerStepQuestionPercentage($sofaData, ['list_all_financial_accounts', 'all_property_transfer_10_year'], $step4PercentageSingleStepFA);
        $step4Percent = $step4Percent + $step4PercentFA;
        $percent += $step4Percent;
        $stepPercentages['step4']['percentDone'] = round($step4Percent);
        // Step 5: Continued Financial Assets
        $step5Conditions = Helper::PROPERTY_FINANCIAL_ASSETS_CONTINUTED_QUE_KEYS;
        $step5Percent = self::getPerStepQuestionPercentageProperty($step4Data, $step5Conditions, $singleStepPercent);
        $percent += $step5Percent;
        $stepPercentages['step5']['percentDone'] = round($step5Percent);
        // Step 6: Business Assets
        if ($enableBusinessProperty) {
            $step6Conditions = [
                'commissions', 'office_equipment', 'machinery_fixtures',
                'business_inventory', 'interests', 'customer_mailing', 'other_business'
            ];
            $step6Percent = self::getPerStepQuestionPercentageProperty($step6Data, $step6Conditions, $singleStepPercent);
            $percent += $step6Percent;
            $stepPercentages['step6']['percentDone'] = round($step6Percent);
        }
        // Step 7: Farm Assets
        if ($enableFarmProperty) {
            $step7Conditions = [
                'farm_animals', 'crops', 'fishing_equipment',
                'fishing_supplies', 'fishing_property'
            ];
            $step7Percent = self::getPerStepQuestionPercentageProperty($step7Data, $step7Conditions, $singleStepPercent);
            $percent += $step7Percent;
            $stepPercentages['step7']['percentDone'] = round($step7Percent);
        }
        $response['tab2_percentage'] = round($percent);
        $response['tab2_percentage_by_steps'] = self::addStepCompletionClass($stepPercentages);

        return $response;
    }

    public static function getTab3CompletionData($response, $clientId)
    {
        $debtstax = CacheDebt::getDebtData($clientId);

        $percent = 0;
        $singleStepPercent = 25;

        $stepConditions = [
            'step1' => ['does_not_have_additional_creditor'],
            'step2' => ['tax_owned_state', 'tax_owned_irs'], // 12.5% each
            'step3' => ['domestic_support'],
            'step4' => ['additional_liens'],
        ];

        $stepPercentages = [];

        foreach ($stepConditions as $step => $conditions) {
            $completed = 0;
            $perFieldPercent = $singleStepPercent / count($conditions);

            foreach ($conditions as $field) {
                if (isset($debtstax[$field]) && $debtstax[$field] !== null && $debtstax[$field] !== '') {
                    $completed += $perFieldPercent;
                }
            }

            $percent += $completed;
            $stepPercentages[$step] = [
                'percentDone' => $completed,
                'percentTotal' => $singleStepPercent,
            ];
        }

        $response['tab3_percentage'] = round($percent);
        $response['tab3_percentage_by_steps'] = self::addStepCompletionClass($stepPercentages);

        return $response;
    }

    public static function getTab4CompletionData($response, $clientId, $clientType)
    {

        $percent = 0;

        $isJoint = ($clientType != Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED);

        // Initialize step percentage containers
        $stepPercentages = [
            'step1' => ['percentDone' => 0, 'percentTotal' => 0],
            'step2' => ['percentDone' => 0, 'percentTotal' => 0],
            'step3' => ['percentDone' => 0, 'percentTotal' => 0],
            'step4' => ['percentDone' => 0, 'percentTotal' => 0],
        ];

        $incomeData = CacheIncome::getIncomeData($clientId);

        // Step 1: Debtor Employer Info
        $step1Data = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        if (!empty($step1Data)) {
            $conditions = ['current_employed', 'recieved_any_income'];
            $maxPercent = $isJoint ? 25 : 50;
            $done = self::getPerStepQuestionPercentage($step1Data, $conditions, $maxPercent);
            $percent += $done;
            $stepPercentages['step1'] = [
                'percentDone' => $done,
                'percentTotal' => $maxPercent,
            ];
        }
        // Step 2: Debtor Monthly Income
        $step2Data = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
        if (!empty($step2Data)) {
            $conditions = [
                'debtor_gross_wages', 'operation_business', 'rent_real_property', 'royalties',
                'retirement_income', 'regular_contributions', 'unemployment_compensation',
                'social_security', 'government_assistance', 'other_sources'
            ];
            $maxPercent = $isJoint ? 25 : 50;
            $done = self::getPerStepQuestionPercentage($step2Data, $conditions, $maxPercent);
            $percent += $done;
            $stepPercentages['step2'] = [
                'percentDone' => $done,
                'percentTotal' => $maxPercent,
            ];
        }
        // Step 3: Spouse Employer Info (only for joint)
        $step3Data = Helper::validate_key_value('debtorspouseemployer', $incomeData, 'array');
        if ($isJoint && !empty($step3Data)) {
            $conditions = ['current_employed', 'recieved_any_income'];
            $done = self::getPerStepQuestionPercentage($step3Data, $conditions, 25);
            $percent += $done;
            $stepPercentages['step3'] = [
                'percentDone' => $done,
                'percentTotal' => 25,
            ];
        }
        // Step 4: Spouse Monthly Income (only for joint)
        $step4Data = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
        if ($isJoint && !empty($step4Data)) {
            $conditions = [
                'joints_debtor_gross_wages', 'joints_operation_business', 'joints_rent_real_property',
                'joints_royalties', 'joints_retirement_income', 'joints_regular_contributions',
                'joints_unemployment_compensation', 'joints_social_security',
                'government_assistance', 'joints_other_sources'
            ];
            $done = self::getPerStepQuestionPercentage($step4Data, $conditions, 25);
            $percent += $done;
            $stepPercentages['step4'] = [
                'percentDone' => $done,
                'percentTotal' => 25,
            ];
        }

        $response['tab4_percentage'] = round($percent);
        $response['tab4_percentage_by_steps'] = self::addStepCompletionClass($stepPercentages);

        return $response;
    }

    public static function getPerStepQuestionPercentage($data, $conditions, $maxTabPercentage)
    {
        $percent = 0;
        if (!empty($conditions)) {
            $totalQuestions = count($conditions);
            $percentPerQuestion = $maxTabPercentage / $totalQuestions;
            foreach ($conditions as $condition) {
                if (isset($data[$condition]) && $data[$condition] !== null && $data[$condition] !== '') {
                    $percent += $percentPerQuestion;
                }
            }
        }

        return $percent;
    }

    public static function getPerStepQuestionPercentageProperty($data, $conditions, $singleStepPercentage)
    {
        $totalQuestions = count($conditions);
        $percent = 0;
        $percentPerQuestion = $singleStepPercentage / $totalQuestions;

        foreach ($conditions as $condition) {
            foreach ($data as $item) {
                if (isset($item['type']) && $item['type'] === $condition) {
                    if (isset($item['type_value']) && (Helper::validate_key_value('type_value', $item, 'radio') == 1 || Helper::validate_key_value('type_value', $item, 'radio') == 0)) {
                        $percent += $percentPerQuestion;
                    }
                    break;
                }
            }
        }

        return $percent;
    }

    public static function getTab5CompletionData($response, $clientId, $clientType)
    {
        $percent = 0;
        $stepPercentages = [
            'step1' => ['percentDone' => 0, 'percentTotal' => 0],
            'step2' => ['percentDone' => 0, 'percentTotal' => 0],
        ];

        $expensesData = CacheExpense::getExpenseData($clientId);

        $showSpouseExpense = Helper::validate_key_value('live_separately', $expensesData, 'radio') == 1;

        $mainConditions = [
            'any_dependents', 'live_separately', 'rent_home_mortage', 'real_estate_taxes', 'amount_include_property',
            'amount_include_home', 'amount_include_homeowner', 'mortgage_payments', 'utility_bills',
            'food_housekeeping_price', 'childcare_price', 'laundry_price', 'personal_care_price',
            'medical_dental_price', 'transportation_price', 'entertainment_price', 'charitablet_price',
            'life_insurance_price', 'health_insurance_price', 'auto_insurance_price', 'otherInsurance_notListed',
            'taxbills_not_deducted', 'installment_payment_for_car', 'alimony_maintenance',
            'paymentforsupport_dependents_n', 'mortgage_property1', 'other_expense_available',
            'increase_decrease_expenses_option'
        ];

        $utilityConditions = [
            'electricity_heating_price', 'water_sewerl_price', 'telephone_service_price'
        ];

        if ($clientType == '1') {
            $mainConditions = array_diff($mainConditions, ['live_separately']);
        }

        $maxMainPercent = $showSpouseExpense ? 50 : 100;
        $mainPercentValue = $maxMainPercent / (count($mainConditions) + count($utilityConditions));
        $mainPercent = 0;

        if (!empty($expensesData)) {
            foreach ($mainConditions as $condition) {
                if (isset($expensesData[$condition]) && $expensesData[$condition] !== null) {
                    $mainPercent += $mainPercentValue;
                }
            }

            $utilities = Helper::validate_key_value('utilities', $expensesData, 'array');
            foreach ($utilityConditions as $uKey) {
                if (isset($utilities[$uKey]) && $utilities[$uKey] !== null) {
                    $mainPercent += $mainPercentValue;
                }
            }
        }

        $stepPercentages['step1']['percentDone'] = round($mainPercent, 2);
        $stepPercentages['step1']['percentTotal'] = $maxMainPercent;
        $percent += $mainPercent;

        // Spouse expenses (step 2)
        if ($showSpouseExpense) {
            $spouseConditions = [
                'any_dependents', 'rent_home_mortage', 'real_estate_taxes', 'amount_include_property',
                'amount_include_home', 'amount_include_homeowner', 'mortgage_payments', 'utility_bills',
                'food_housekeeping_price', 'childcare_price', 'laundry_price', 'personal_care_price',
                'medical_dental_price', 'transportation_price', 'entertainment_price', 'charitablet_price',
                'life_insurance_price', 'health_insurance_price', 'auto_insurance_price', 'otherInsNotListedSpouse',
                'taxbills_not_deducted', 'installment_payment_for_car', 'alimony_maintenance',
                'PaymentsforadditionaldepSpouse', 'otherRealPropertyNotAddedSpouse', 'other_expense_available',
                'increase_decrease_expenses_option'
            ];

            $spouseUtilities = [
                'electricity_heating_price', 'water_sewerl_price', 'telephone_service_price'
            ];

            if ($clientType == '1') {
                $spouseConditions = array_diff($spouseConditions, ['live_separately']);
            }

            $spouseMaxPercent = 50;
            $spousePercentValue = $spouseMaxPercent / (count($spouseConditions) + count($spouseUtilities));
            $spousePercent = 0;

            $spouseExpensesData = CacheExpense::getExpenseData($clientId, true);

            if (!empty($spouseExpensesData)) {
                foreach ($spouseConditions as $condition) {
                    if (isset($spouseExpensesData[$condition]) && $spouseExpensesData[$condition] !== null) {
                        $spousePercent += $spousePercentValue;
                    }
                }

                $spouseUtilityValues = Helper::validate_key_value('utilities', $spouseExpensesData);
                foreach ($spouseUtilities as $uKey) {
                    if (isset($spouseUtilityValues[$uKey]) && $spouseUtilityValues[$uKey] !== null) {
                        $spousePercent += $spousePercentValue;
                    }
                }
            }

            $stepPercentages['step2']['percentDone'] = round($spousePercent, 2);
            $stepPercentages['step2']['percentTotal'] = $spouseMaxPercent;
            $percent += $spousePercent;
        }

        $response['tab5_percentage'] = round($percent);
        $response['tab5_percentage_by_steps'] = self::addStepCompletionClass($stepPercentages);

        return $response;
    }

    public static function getTab6CompletionData($response, $clientId)
    {
        $percent = 0;
        $hasStep3 = false;
        // Initialize step percentage containers
        $stepPercentages = [
            'step1' => ['percentDone' => 0, 'percentTotal' => 0],
            'step2' => ['percentDone' => 0, 'percentTotal' => 0],
        ];

        $BIData = CacheBasicInfo::getBasicInformationData($clientId, true, false);
        $soleProprietor = Helper::validate_key_value('BasicInfo_PartRest', $BIData, 'array');

        if (!empty($soleProprietor) && !empty($soleProprietor->used_business_ein)) {
            $stepPercentages['step3'] = ['percentDone' => 0, 'percentTotal' => 0];
            $hasStep3 = true;
        }

        $data = CacheSOFA::getSOFAData($clientId);

        // Step 1: SOFA
        $conditions = [
            'list_lawsuits', 'property_repossessed', 'setoffs_creditor', 'court_appointed',
            'total_amount_income', 'other_income_received_income', 'payment_past_one_year'
        ];

        $maxPercent = $hasStep3 ? 33.33 : 50;
        $done = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
        $percent += $done;
        $stepPercentages['step1'] = [
            'percentDone' => $done,
            'percentTotal' => $maxPercent,
        ];

        // Step 2: SOFA
        $conditions = [
            'list_any_gifts', 'gifts_charity', 'losses_from_fire',
            'property_transferred', 'property_transferred_creditors', 'Property_all',
            'list_safe_deposit', 'other_storage_unit', 'list_property_you_hold'
        ];

        $maxPercent = $hasStep3 ? 33.33 : 50;
        $done = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
        $percent += $done;
        $stepPercentages['step2'] = [
            'percentDone' => $done,
            'percentTotal' => $maxPercent,
        ];

        // Step 3: SOFA (only for hasStep3)
        if ($hasStep3) {
            $conditions = [];
            if (isset($soleProprietor->hazardous_property) && $soleProprietor->hazardous_property == 1) {
                $conditions[] = 'list_noticeby_gov';
                $conditions[] = 'list_environment_law';
                $conditions[] = 'list_judicial_proceedings';
            }
            if (isset($soleProprietor->used_business_ein) && $soleProprietor->used_business_ein == 1) {
                $conditions[] = 'list_nature_business_data';
                $conditions[] = 'list_financial_institutions';
            }
            $maxPercent = 33.33;
            $done = self::getPerStepQuestionPercentage($data, $conditions, $maxPercent);
            $percent += $done;
            $stepPercentages['step3'] = [
                'percentDone' => $done,
                'percentTotal' => $maxPercent,
            ];
        }

        $response['tab6_percentage'] = round($percent);
        $response['tab6_percentage_by_steps'] = self::addStepCompletionClass($stepPercentages);

        return $response;
    }

    public static function checkEligibleForSubmit($response, $clientId)
    {
        $response['eligible_for_final_submit'] = 1;
        $fdata = DB::table('tbl_forms_steps_completed')->where("client_id", $clientId)
            ->select('step1', 'step2', 'step3', 'step4', 'step5', 'step6', 'can_edit')
            ->first();

        $fdata = json_decode(json_encode($fdata), 1);
        if (empty($fdata)) {
            $response['eligible_for_final_submit'] = 1;
        }
        if (!empty($fdata) && isset($fdata['step1'])) {
            if ($fdata['step1'] == 1 && $fdata['step2'] == 1 && $fdata['step3'] == 1 && $fdata['step4'] == 1 && $fdata['step5'] == 1 && $fdata['step6'] == 1) {
                if ($fdata['can_edit'] == 1 || $fdata['can_edit'] == 2) {
                    $response['eligible_for_final_submit'] = 1;
                }
            }
        }

        return $response;
    }

    public static function getStepCompletionData($clientId, $clientType)
    {
        $response = [];
        $client = User::where('id', $clientId)->select(['client_subscription', 'client_payroll_assistant'])->first();
        $hide_questionnaire = Auth::user()->hide_questionnaire;
        $client_subscription = $client->client_subscription;

        $response = self::checkEligibleForSubmit($response, $clientId);
        if ($client_subscription != AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $hide_questionnaire == 0) {
            $response = self::getTab1CompletionData($response, $clientId, $clientType);//basic info
            $response = self::getTab2CompletionData($response, $clientId);//property
            $response = self::getTab3CompletionData($response, $clientId);//debts
            $response = self::getTab4CompletionData($response, $clientId, $clientType);//income
            $response = self::getTab5CompletionData($response, $clientId, $clientType);//expenseclientId
            $response = self::getTab6CompletionData($response, $clientId);//sofa
            $totalPercentagesAchived = $response['tab1_percentage'] + $response['tab2_percentage'] + $response['tab3_percentage'] + $response['tab4_percentage'] + $response['tab5_percentage'] + $response['tab6_percentage'];
            $totalTabNeeded = 600;
        }

        if ($client_subscription == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION || ($hide_questionnaire == 1 && !empty($client->client_payroll_assistant))) {
            $response = self::getTab4CompletionData($response, $clientId, $clientType);
            $totalPercentagesAchived = $response['tab4_percentage'];
            $totalTabNeeded = 100;
        }
        $formSubmitted = \App\Models\FormsStepsCompleted::where('client_id', '=', $clientId)->select(['submitted_to_att_at'])->first();
        $response['all_percentage'] = round(($totalPercentagesAchived / $totalTabNeeded) * 100);
        $response['submitted_to_att_at'] = $formSubmitted->submitted_to_att_at ?? '';

        return $response;
    }

    public static function getStepCompletionDataForNotificationTemplate($clientId, $clientType)
    {
        $response = [];
        $response = self::checkEligibleForSubmit($response, $clientId);
        $response = self::getTab1CompletionData($response, $clientId, $clientType);//basic info
        $response = self::getTab2CompletionData($response, $clientId);//property
        $response = self::getTab3CompletionData($response, $clientId);//debts
        $response = self::getTab4CompletionData($response, $clientId, $clientType);//income
        $response = self::getTab5CompletionData($response, $clientId, $clientType);//expenseclientId
        $response = self::getTab6CompletionData($response, $clientId);//sofa
        $totalPercentagesAchived = $response['tab1_percentage'] + $response['tab2_percentage'] + $response['tab3_percentage'] + $response['tab4_percentage'] + $response['tab5_percentage'] + $response['tab6_percentage'];
        $totalTabNeeded = 600;
        $formSubmitted = \App\Models\FormsStepsCompleted::where('client_id', '=', $clientId)->select(['submitted_to_att_at'])->first();
        $response['all_percentage'] = round(($totalPercentagesAchived / $totalTabNeeded) * 100);
        $response['submitted_to_att_at'] = $formSubmitted->submitted_to_att_at ?? '';

        return $response;
    }


    public static function getTotalProgressForScheduler($client)
    {
        $response = [];
        $clientId = $client->id;
        $clientType = $client->client_type;
        $response = self::checkEligibleForSubmit($response, $clientId);
        if ($client->client_subscription != AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION && $client->hide_questionnaire == 0) {
            $response = self::getTab1CompletionData($response, $clientId, $clientType);//basic info
            $response = self::getTab2CompletionData($response, $clientId);//property
            $response = self::getTab3CompletionData($response, $clientId);//debts
            $response = self::getTab4CompletionData($response, $clientId, $clientType);//income
            $response = self::getTab5CompletionData($response, $clientId, $clientType);//expense
            $response = self::getTab6CompletionData($response, $clientId);//sofa
            $totalPercentagesAchived = $response['tab1_percentage'] + $response['tab2_percentage'] + $response['tab3_percentage'] + $response['tab4_percentage'] + $response['tab5_percentage'] + $response['tab6_percentage'];
            $totalTabNeeded = 600;
        }
        if ($client->client_subscription == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION || ($client->hide_questionnaire == 1 && !empty($client->client_payroll_assistant))) {
            $response = self::getTab4CompletionData($response, $clientId, $clientType);
            $totalPercentagesAchived = $response['tab4_percentage'];
            $totalTabNeeded = 100;
        }

        return round(($totalPercentagesAchived / $totalTabNeeded) * 100);
    }

    public static function getStepCompletionDataForClients($clientIds)
    {
        foreach ($clientIds as $val) {
            $clients[$val['id']] = self::getStepCompletionData($val['id'], $val['client_type']);
        }

        return $clients;
    }

    public static function addStepCompletionClass(array $stepPercentages): array
    {
        foreach ($stepPercentages as $key => $step) {
            $done = isset($step['percentDone']) ? (float)$step['percentDone'] : 0;
            $total = isset($step['percentTotal']) && $step['percentTotal'] > 0 ? (float)$step['percentTotal'] : 100;

            // Normalize to total = 100
            $normalizedDone = ($done / $total) * 100;
            $normalizedTotal = 100.0;
            $normalizedDone = round($normalizedDone, 2);

            // Determine the class
            if (round($normalizedDone, 2) == 0) {
                $tabClass = 'empty-step';
            } elseif (round($normalizedDone, 2) >= $normalizedTotal) {
                $tabClass = 'done-step';
            } else {
                $tabClass = 'progress-step';
            }

            // Update the array
            $stepPercentages[$key]['percentDone'] = $normalizedDone;
            $stepPercentages[$key]['percentTotal'] = $normalizedTotal;
            $stepPercentages[$key]['tabClass'] = $tabClass;

        }

        return $stepPercentages;
    }
}
