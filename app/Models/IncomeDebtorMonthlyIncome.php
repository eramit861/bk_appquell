<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DateTimeHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheIncome;

class IncomeDebtorMonthlyIncome extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_income_debtor_monthly_income';
    public $timestamps = false;

    public static function getPropertyIncome($debtormonthlyincome)
    {
        if (Helper::validate_key_value('rent_real_property', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['rent_real_property_month']) ? number_format((float)current($debtormonthlyincome['rent_real_property_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function getInterestDividends($debtormonthlyincome)
    {
        if (Helper::validate_key_value('royalties', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['royalties_month']) ? number_format((float)current($debtormonthlyincome['royalties_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function retirementPension($debtormonthlyincome)
    {
        if (Helper::validate_key_value('retirement_income', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['retirement_income_month']) ? number_format((float)current($debtormonthlyincome['retirement_income_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function regularContribution($debtormonthlyincome)
    {
        if (Helper::validate_key_value('regular_contributions', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['regular_contributions_month']) ? number_format((float)current($debtormonthlyincome['regular_contributions_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function unemploymentCompensation($debtormonthlyincome)
    {
        if (Helper::validate_key_value('unemployment_compensation', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['unemployment_compensation_month']) ? number_format((float)current($debtormonthlyincome['unemployment_compensation_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }


    public static function socialSecurity($debtormonthlyincome)
    {
        if (Helper::validate_key_value('social_security', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['social_security_month']) ? number_format((float)current($debtormonthlyincome['social_security_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function governmentAssictant($debtormonthlyincome)
    {
        if (Helper::validate_key_value('government_assistance', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['government_assistance_month']) ? number_format((float)current($debtormonthlyincome['government_assistance_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function governmentAssictantSpecify($debtormonthlyincome)
    {
        if (Helper::validate_key_value('government_assistance', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['government_assistance_specify']) ? $debtormonthlyincome['government_assistance_specify'] : '';
        }

        return '';
    }

    public static function otherSourcesSpecify($debtormonthlyincome)
    {
        if (Helper::validate_key_value('other_sources', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['other_options_income']) ? $debtormonthlyincome['other_options_income'] : '';
        }

        return '';
    }

    public static function otherSources($debtormonthlyincome)
    {
        if (Helper::validate_key_value('other_sources', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['other_sources_month']) ? number_format((float)current($debtormonthlyincome['other_sources_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function otherSourcesName($debtormonthlyincome)
    {
        if (Helper::validate_key_value('other_sources', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['other_sources_of_income']) ? $debtormonthlyincome['other_sources_of_income'] : '';
        }

        return '';
    }

    public static function otherDeduction($debtormonthlyincome)
    {
        if (Helper::validate_key_value('otherDeductions11', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['other_deduction']) ? number_format((float)current($debtormonthlyincome['other_deduction']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function otherIncomeTotal($dbin)
    {
        return self::getPropertyIncome($dbin) + self::getInterestDividends($dbin) + self::retirementPension($dbin) + self::regularContribution($dbin) + self::unemploymentCompensation($dbin) + self::socialSecurity($dbin) + self::otherSources($dbin);
    }


    /** Wages related values */

    public static function debtorGrossWagesMonth($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return is_array($debtormonthlyincome['debtor_gross_wages_month']) ? number_format((float)current($debtormonthlyincome['debtor_gross_wages_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function overTimePerMonth($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['overtime_per_month']) ? number_format((float)$debtormonthlyincome['overtime_per_month'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckSecurity($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['paycheck_for_security']) ? number_format((float)$debtormonthlyincome['paycheck_for_security'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckMandatoryContribution($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['paycheck_mandatory_contribution']) ? number_format((float)$debtormonthlyincome['paycheck_mandatory_contribution'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckVoluntaryContribution($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['paycheck_voluntary_contribution']) ? number_format((float)$debtormonthlyincome['paycheck_voluntary_contribution'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckRequiredRepayment($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['paycheck_required_repayment']) ? number_format((float)$debtormonthlyincome['paycheck_required_repayment'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function automaticallyDeductionInsurance($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['automatically_deduction_insurance']) ? number_format((float)$debtormonthlyincome['automatically_deduction_insurance'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function domesticSupportObligations($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['domestic_support_obligations']) ? number_format((float)$debtormonthlyincome['domestic_support_obligations'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function unionDuesDeducted($debtormonthlyincome)
    {
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            return isset($debtormonthlyincome['union_dues_deducted']) ? number_format((float)$debtormonthlyincome['union_dues_deducted'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function othergrossDeduction($debtormonthlyincome)
    {
        $deduction = 0.00;
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            if (isset($debtormonthlyincome['other_deduction']) && !is_array($debtormonthlyincome['other_deduction'])) {
                $deduction = number_format((float)$debtormonthlyincome['other_deduction'], 2, '.', '');
            }
            if (isset($debtormonthlyincome['other_deduction']) && is_array($debtormonthlyincome['other_deduction'])) {
                $deduction = (float)array_sum($debtormonthlyincome['other_deduction']);
            }
        }

        return $deduction;
    }

    public static function otherDeductionSpecify($debtormonthlyincome)
    {
        $deductionSpecify = '';
        if (Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome) == 1) {
            if (isset($debtormonthlyincome['other_deduction_specify']) && !is_array($debtormonthlyincome['other_deduction_specify'])) {
                $deductionSpecify = $debtormonthlyincome['other_deduction_specify'];
            }
            if (isset($debtormonthlyincome['other_deduction_specify']) && is_array($debtormonthlyincome['other_deduction_specify'])) {
                $deductionSpecify = implode(", ", $debtormonthlyincome['other_deduction_specify']);
            }
        }

        return $deductionSpecify;
    }

    public static function getWagesIncomeSum($income)
    {
        return self::payCheckSecurity($income) + self::overTimePerMonth($income) + self::payCheckMandatoryContribution($income) + self::payCheckVoluntaryContribution($income) + self::payCheckRequiredRepayment($income) + self::automaticallyDeductionInsurance($income) + self::domesticSupportObligations($income) + self::unionDuesDeducted($income) + self::otherDeduction($income);
    }

    public static function getProfitLossIncome($client_id)
    {
        $incomeData = CacheIncome::getIncomeData($client_id);
        $debtorIncomeTabData = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');

        return User::getSelectedColumnsFromArray($debtorIncomeTabData, ['income_profit_loss']);
    }

    public static function updateProfitLossJson($json, $amount, $selectValue, $monthYear, $none, $isImportedFor, $client_type)
    {
        if (!empty($json[0]) && $json[0]['profit_loss_type'] == 1) { // for type same
            $data = $json[0];
            if ($none == 0) {
                $totalAmount = abs($amount) + (float)abs($data[$selectValue]);
            } elseif ($none == 1) {
                $totalAmount = (float)abs($data[$isImportedFor]) - abs($amount);
            }
            data_set($data, $selectValue, $totalAmount);

            return [$data];
        }
        $monthsArray = !empty($json) ? array_column($json, 'profit_loss_month') : [];
        if (!empty($json[0]) && $json[0]['profit_loss_type'] == 2) {
            $monthInJson = [];
            foreach ($json as $index => $data) {
                if ($data['profit_loss_month'] == $monthYear) {
                    if ($none == 0) {
                        $totalAmount = abs($amount) + ((float)abs($data[$selectValue] ?? 0));
                    } elseif ($none == 1) {
                        $totalAmount = (float)abs($data[$isImportedFor]) - abs($amount);
                    }
                    data_set($data, $selectValue, $totalAmount);
                }
                $monthInJson[] = $data;
            }
            array_multisort(array_column($monthInJson, "profit_loss_month"), SORT_DESC, $monthInJson);
            if (!in_array($monthYear, $monthsArray) || empty($monthsArray)) {
                return IncomeDebtorMonthlyIncome::createNewObject($json, $monthYear, $selectValue, $amount, $none);
            }

            return $monthInJson;
        }
        if (empty($json)) {
            if (!in_array($monthYear, $monthsArray) || empty($monthsArray)) {
                return IncomeDebtorMonthlyIncome::createNewObject($json, $monthYear, $selectValue, $amount, $none);
            }
        }
    }

    public static function createNewObject($json, $monthYear, $selectValue, $amount)
    {
        $json = $json == null ? [] : $json;
        $data = self::returnEmptyObject();
        data_set($data, 'profit_loss_type', 2);
        data_set($data, 'profit_loss_month', $monthYear);
        data_set($data, 'name_of_business', '');
        data_set($data, $selectValue, $amount);
        array_push($json, $data);
        array_multisort(array_column($json, "profit_loss_month"), SORT_DESC, $json);

        return $json;
    }

    private static function returnEmptyObject()
    {
        return [
            "profit_loss_type" => null,
            "name_of_business" => null,
            "profit_loss_month" => null,
            "gross_business_income" => null,
            "cost_of_goods_sold" => null,
            "gross_profit" => null,
            "advertising_expense" => null,
            "subcontractor_pay" => null,
            "professional_service" => null,
            "cc_expense" => null,
            "equipment_rental_expense" => null,
            "insurance_expense" => null,
            "licenses_expense" => null,
            "office_supplies_expense" => null,
            "postage_expense" => null,
            "rent_office_expense" => null,
            "bank_fee_and_interest" => null,
            "software_and_subscription" => null,
            "supplies_material_expense" => null,
            "travel_expense" => null,
            "utility_expense" => null,
            "vehicle_expense" => null,
            "other_expense_name1" => null,
            "other_1" => null,
            "other_expense_name2" => null,
            "other_2" => null,
            "other_expense_name3" => null,
            "other_3" => null,
            "total_expense" => null,
            "total_profit_loss" => null,
            "debtor1_sign" => '',
            "debtor1_sign_date" => '',
            "debtor2_sign" => '',
            "debtor2_sign_date" => '',
        ];
    }


    public static function getNetIncome($debtormonthlyincome)
    {
        $isDWagesOn = Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome);
        $Taxes = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_for_security']) ? $debtormonthlyincome['paycheck_for_security'] : 0.00;
        $mandatory_contribution = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_mandatory_contribution']) ? $debtormonthlyincome['paycheck_mandatory_contribution'] : 0.00;
        $voluntary_contribution = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_voluntary_contribution']) ? $debtormonthlyincome['paycheck_voluntary_contribution'] : 0.00;
        $insurances = $isDWagesOn == 1 && isset($debtormonthlyincome['automatically_deduction_insurance']) ? $debtormonthlyincome['automatically_deduction_insurance'] : 0.00;
        $domestic_support = $isDWagesOn == 1 && isset($debtormonthlyincome['domestic_support_obligations']) ? $debtormonthlyincome['domestic_support_obligations'] : 0.00;
        $union_dues = $isDWagesOn == 1 && isset($debtormonthlyincome['union_dues_deducted']) ? $debtormonthlyincome['union_dues_deducted'] : 0.00;
        $required_repayment = $isDWagesOn == 1 && isset($debtormonthlyincome['paycheck_required_repayment']) ? $debtormonthlyincome['paycheck_required_repayment'] : 0.00;
        $other_deduction = $isDWagesOn == 1 && isset($debtormonthlyincome['other_deduction']) ? $debtormonthlyincome['other_deduction'] : 0.00;
        $other_deduction = is_array($other_deduction) ? array_sum($other_deduction) : $other_deduction;
        $totaldeduction = ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction);
        $avgMonthlyGross = $isDWagesOn == 1 && is_array($debtormonthlyincome['debtor_gross_wages_month']) ? number_format((float)current($debtormonthlyincome['debtor_gross_wages_month']), 2, '.', '') : 0;
        if (isset($debtormonthlyincome['operation_business']) && $debtormonthlyincome['operation_business'] == 1 && is_array($debtormonthlyincome['income_profit_loss']) && count($debtormonthlyincome['income_profit_loss']) > 0) {
            $total6month = 0;

            $debtorTotalOperatingExpense = 0;
            $totalgross = 0;

            $income_profit_loss = $debtormonthlyincome['income_profit_loss'];
            $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
            $i = 1;
            foreach ($income_profit_loss as $profit) {
                if ($i > 6) {
                    continue;
                }
                if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                    $debtorTotalOperatingExpense = $debtorTotalOperatingExpense + $profit['total_expense'];
                    $totalgross = $totalgross + Helper::validate_key_value('gross_business_income', $profit, 'float');
                    $total6month = $total6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                    $i++;
                }
            }

        }
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::getPropertyIncome($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::getInterestDividends($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::retirementPension($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::regularContribution($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::unemploymentCompensation($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::socialSecurity($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::governmentAssictant($debtormonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome);

        return number_format((float)($avgMonthlyGross - $totaldeduction), 2, '.', ',');
    }


    public function getBusinessAndPLDataArray($incomeData, $attProfitLossMonths)
    {
        $bsName = [];
        $plData = [];
        foreach ($incomeData as $key => $value) {
            if (in_array($key, ['profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3', 'profit_loss_business_name_4','profit_loss_business_name_5','profit_loss_business_name_6',]) && !empty($value)) {
                $type = str_replace(" ", "_", $value);
                $type = Helper::validate_doc_type($value, true);
                $name = ucfirst($value);
                $bsName[$type] = $name;
            }
            if (in_array($key, ['income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3', 'income_profit_loss_4','income_profit_loss_5','income_profit_loss_6',])) {
                if (!empty($value) && is_array($value)) {
                    // Check if it is a single associative array
                    if (array_keys($value) !== range(0, count($value) - 1)) {
                        $PLType = Helper::validate_key_value("profit_loss_type", $value, "radio");
                        $PLMonth = Helper::validate_key_value("profit_loss_month", $value);
                        $lastSixMonth = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
                        if (array_key_exists($PLMonth, $lastSixMonth)) {

                            $typePL = Helper::validate_key_value("name_of_business", $value);
                            $typePL = str_replace(" ", "_", $typePL);
                            $typePL = Helper::validate_doc_type($typePL, true);
                            $objectArray = [];
                            if ($PLType == 1) {
                                foreach ($lastSixMonth as $index => $Mname) {
                                    $value['profit_loss_month'] = $index;
                                    $objectArray[] = $value;
                                }
                            }
                            if ($PLType == 2) {
                                $objectArray[] = $value;
                            }
                            $plData[$typePL] = $objectArray;
                        }
                    } else {
                        $typePL = !empty($value[0]['name_of_business']) ? $value[0]['name_of_business'] : 'Business Name Not Available';
                        $typePL = str_replace(" ", "_", $typePL);
                        $typePL = Helper::validate_doc_type($typePL, true);
                        $plData[$typePL] = $value;
                    }
                }
            }
        }
        $object = ['businessData' => $bsName, 'plData' => $plData ];

        return $object;
    }

}
