<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DateTimeHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheIncome;

class IncomeDebtorSpouseMonthlyIncome extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_income_debtor_spouse_monthly_income';
    public $timestamps = false;


    public static function getPropertyIncome($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_rent_real_property', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_rent_real_property_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_rent_real_property_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function getInterestDividends($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_royalties', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_royalties_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_royalties_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function retirementPension($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_retirement_income', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_retirement_income_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_retirement_income_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function regularContribution($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_regular_contributions', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_regular_contributions_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_regular_contributions_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function unemploymentCompensation($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_unemployment_compensation', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_unemployment_compensation_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_unemployment_compensation_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function socialSecurity($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_social_security', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_social_security_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_social_security_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function governmentAssictant($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('government_assistance', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['government_assistance_month']) ? number_format((float)current($debtorspousemonthlyincome['government_assistance_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function governmentAssictantSpecify($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('government_assistance', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['government_assistance_specify']) ? $debtorspousemonthlyincome['government_assistance_specify'] : '';
        }

        return '';
    }

    public static function otherSources($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_other_sources', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_other_sources_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_other_sources_month']), 2, '.', '') : 0;
        }

        return 0.00;
    }
    public static function otherSourcesSpecify($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_other_sources', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_other_sources_of_income']) ? $debtorspousemonthlyincome['joints_other_sources_of_income'] : '';
        }

        return '';
    }



    public static function otherDeduction($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('otherDeductions22', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_other_deduction']) ? number_format((float)current($debtorspousemonthlyincome['joints_other_deduction']), 2, '.', '') : 0;
        }

        return 0.00;
    }

    public static function otherIncomeTotal($dsdbin)
    {
        return self::getPropertyIncome($dsdbin) + self::getInterestDividends($dsdbin) + self::retirementPension($dsdbin) + self::regularContribution($dsdbin) + self::unemploymentCompensation($dsdbin) + self::socialSecurity($dsdbin) + self::otherSources($dsdbin);
    }

    /** Wages related values */


    public static function debtorGrossWagesMonth($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return is_array($debtorspousemonthlyincome['joints_debtor_gross_wages_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_debtor_gross_wages_month']), 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function overTimePerMonth($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_overtime_per_month']) ? number_format((float)$debtorspousemonthlyincome['joints_overtime_per_month'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckSecurity($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_paycheck_for_security']) ? number_format((float)$debtorspousemonthlyincome['joints_paycheck_for_security'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckMandatoryContribution($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_paycheck_mandatory_contribution']) ? number_format((float)$debtorspousemonthlyincome['joints_paycheck_mandatory_contribution'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckVoluntaryContribution($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_paycheck_voluntary_contribution']) ? number_format((float)$debtorspousemonthlyincome['joints_paycheck_voluntary_contribution'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function payCheckRequiredRepayment($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_paycheck_required_repayment']) ? number_format((float)$debtorspousemonthlyincome['joints_paycheck_required_repayment'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function automaticallyDeductionInsurance($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_automatically_deduction_insurance']) ? number_format((float)$debtorspousemonthlyincome['joints_automatically_deduction_insurance'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function domesticSupportObligations($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_domestic_support_obligations']) ? number_format((float)$debtorspousemonthlyincome['joints_domestic_support_obligations'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function unionDuesDeducted($debtorspousemonthlyincome)
    {
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            return isset($debtorspousemonthlyincome['joints_union_dues_deducted']) ? number_format((float)$debtorspousemonthlyincome['joints_union_dues_deducted'], 2, '.', '') : 0.00;
        }

        return 0.00;
    }

    public static function othergrossDeduction($debtorspousemonthlyincome)
    {
        $deduction = 0.00;
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome)) {
            if (isset($debtorspousemonthlyincome['joints_other_deduction']) && !is_array($debtorspousemonthlyincome['joints_other_deduction'])) {
                $deduction = number_format((float)$debtorspousemonthlyincome['joints_other_deduction'], 2, '.', '');
            }
            if (isset($debtorspousemonthlyincome['joints_other_deduction']) && is_array($debtorspousemonthlyincome['joints_other_deduction'])) {
                $deduction = (float)array_sum($debtorspousemonthlyincome['joints_other_deduction']);
            }
        }

        return $deduction;
    }

    public static function otherDeductionSpecify($debtorspousemonthlyincome1)
    {
        $deductionSpecify = '';
        if (Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome1)) {
            if (isset($debtorspousemonthlyincome1['joints_other_deduction_specify']) && !is_array($debtorspousemonthlyincome1['joints_other_deduction_specify'])) {
                $deductionSpecify = $debtorspousemonthlyincome1['joints_other_deduction_specify'];
            }
            if (isset($debtorspousemonthlyincome1['joints_other_deduction_specify']) && is_array($debtorspousemonthlyincome1['joints_other_deduction_specify'])) {
                $deductionSpecify = implode(", ", $debtorspousemonthlyincome1['joints_other_deduction_specify']);
            }
        }

        return $deductionSpecify;
    }



    public static function getWagesIncomeSum($income1)
    {
        return self::payCheckSecurity($income1) + self::overTimePerMonth($income1) + self::payCheckMandatoryContribution($income1) + self::payCheckVoluntaryContribution($income1) + self::payCheckRequiredRepayment($income1) + self::automaticallyDeductionInsurance($income1) + self::domesticSupportObligations($income1) + self::unionDuesDeducted($income1) + self::otherDeduction($income1);
    }


    public static function getProfitLossIncome($client_id)
    {
        $incomeData = CacheIncome::getIncomeData($client_id);
        $incomeTabData = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');

        return User::getSelectedColumnsFromArray($incomeTabData, ['income_profit_loss']);
    }

    public static function getNetIncome($debtorspousemonthlyincome)
    {
        $isWagesOn = Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome);
        $gross_average_per_month = $isWagesOn == 1 && is_array($debtorspousemonthlyincome['joints_debtor_gross_wages_month']) ? current($debtorspousemonthlyincome['joints_debtor_gross_wages_month']) : 0.00;
        $Taxes = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_for_security']) ? $debtorspousemonthlyincome['joints_paycheck_for_security'] : 0.00;
        $mandatory_contribution = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_mandatory_contribution']) ? $debtorspousemonthlyincome['joints_paycheck_mandatory_contribution'] : 0.00;
        $voluntary_contribution = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_voluntary_contribution']) ? $debtorspousemonthlyincome['joints_paycheck_voluntary_contribution'] : 0.00;
        $insurances = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_automatically_deduction_insurance']) ? $debtorspousemonthlyincome['joints_automatically_deduction_insurance'] : 0.00;
        $domestic_support = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_domestic_support_obligations']) ? $debtorspousemonthlyincome['joints_domestic_support_obligations'] : 0.00;
        $union_dues = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_union_dues_deducted']) ? $debtorspousemonthlyincome['joints_union_dues_deducted'] : 0.00;
        $required_repayment = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_paycheck_required_repayment']) ? $debtorspousemonthlyincome['joints_paycheck_required_repayment'] : 0.00;
        $other_deduction = $isWagesOn == 1 && isset($debtorspousemonthlyincome['joints_other_deduction']) ? $debtorspousemonthlyincome['joints_other_deduction'] : 0.00;
        $other_deduction = is_array($other_deduction) ? array_sum($other_deduction) : $other_deduction;

        $spouse_net_average_income = number_format((float)$gross_average_per_month - ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction), 2, '.', ',');
        // dump($net_average_income);
        $totaldeduction = ((float)$Taxes + (float)$mandatory_contribution + $voluntary_contribution + $insurances + $domestic_support + $union_dues + $required_repayment + $other_deduction);

        $avgMonthlyGross = $isWagesOn == 1 && is_array($debtorspousemonthlyincome['joints_debtor_gross_wages_month']) ? number_format((float)current($debtorspousemonthlyincome['joints_debtor_gross_wages_month']), 2, '.', '') : 0;
        $average = 0;
        if (isset($debtorspousemonthlyincome['joints_operation_business']) && $debtorspousemonthlyincome['joints_operation_business'] == 1 && is_array($debtorspousemonthlyincome['income_profit_loss']) && count($debtorspousemonthlyincome['income_profit_loss']) > 0) {
            $total6month = 0;
            $totalgross = 0;
            $spouseTotalOperatingExpense = 0;
            $income_profit_loss = $debtorspousemonthlyincome['income_profit_loss'];
            $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
            $i = 1;
            foreach ($income_profit_loss as $profit) {
                if ($i > 6) {
                    continue;
                }
                if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                    $totalgross = $totalgross + Helper::validate_key_value('gross_business_income', $profit, 'float');
                    $spouseTotalOperatingExpense = $spouseTotalOperatingExpense + $profit['total_expense'];
                    $total6month = $total6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                    $i++;
                }
            }
            $average = $total6month > 0 ? number_format((float)($total6month / ($i - 1)), 2, '.', '') : 0.00;
        }

        $avgMonthlyGross = $avgMonthlyGross + $average;

        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::getPropertyIncome($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::getInterestDividends($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::retirementPension($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::regularContribution($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::unemploymentCompensation($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::socialSecurity($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::governmentAssictant($debtorspousemonthlyincome);
        $avgMonthlyGross = $avgMonthlyGross + IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome);

        return number_format((float)($avgMonthlyGross - $totaldeduction), 2, '.', ',');

    }

}
