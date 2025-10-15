<?php

namespace App\Services\Client;

use App\Models\FinancialAffairs;
use App\Models\MasterCardTransactions;
use App\Models\PayStubs;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\AttorneyEmployerInformationToClient;
use App\Helpers\Helper;
use App\Helpers\DateTimeHelper;

class IncomeCalculationService
{
    /**
     * Import debtor income to SOFA
     */
    public function importDebtorIncomeToSofa(int $clientId): void
    {
        $incomeData = CacheIncome::getIncomeData($clientId);
        $debtorMonthlyIncome = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');

        $otherIncomeData = $this->calculateOtherIncomeData($debtorMonthlyIncome);

        if (!empty($otherIncomeData['otherIncomeThisYear'])) {
            $sofa = [
                'client_id' => $clientId,
                'other_income_received_income' => 1,
                'other_income_received_this_year' => json_encode($otherIncomeData['otherIncomeThisYear']),
                'other_amount_this_year_income' => json_encode($otherIncomeData['otherIncomeThisYearAmount']),
                'other_income_received_this_year_text' => json_encode($otherIncomeData['otherIncomeThisYearText'])
            ];

            FinancialAffairs::updateOrCreate(['client_id' => $clientId], $sofa);
            CacheSOFA::forgetSOFACache($clientId);
        }
    }

    /**
     * Import spouse income to SOFA
     */
    public function importSpouseIncomeToSofa(int $clientId): void
    {
        $incomeData = CacheIncome::getIncomeData($clientId);
        $debtorSpouseMonthlyIncome = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');

        $otherIncomeData = $this->calculateSpouseOtherIncomeData($debtorSpouseMonthlyIncome);

        if (!empty($otherIncomeData['otherIncomeThisYear'])) {
            $sofa = [
                'client_id' => $clientId,
                'other_income_received_income_spouse' => 1,
                'other_income_received_spouse_this_year' => json_encode($otherIncomeData['otherIncomeThisYear']),
                'other_amount_spouse_this_year_income' => json_encode($otherIncomeData['otherIncomeThisYearAmount']),
                'other_income_received_spouse_this_year_text' => json_encode($otherIncomeData['otherIncomeThisYearText'])
            ];

            FinancialAffairs::updateOrCreate(['client_id' => $clientId], $sofa);
            CacheSOFA::forgetSOFACache($clientId);
        }
    }

    /**
     * Calculate other income data for debtor
     */
    private function calculateOtherIncomeData(array $debtorMonthlyIncome): array
    {
        $otherIncomeThisYear = [];
        $otherIncomeThisYearAmount = [];
        $otherIncomeThisYearText = [];

        // Retirement Income
        $this->processIncomeType($debtorMonthlyIncome, [
            'income' => 'retirement_income',
            'same' => 'same_retirement_income',
            'month' => 'retirement_income_month',
            'type' => 8,
            'text' => null
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Regular Contributions
        $this->processIncomeType($debtorMonthlyIncome, [
            'income' => 'regular_contributions',
            'same' => 'same_regular_contributions_income',
            'month' => 'regular_contributions_month',
            'type' => 5,
            'text' => null
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Unemployment Compensation
        $this->processIncomeType($debtorMonthlyIncome, [
            'income' => 'unemployment_compensation',
            'same' => 'same_unemployement_compensation_income',
            'month' => 'unemployment_compensation_month',
            'type' => -1,
            'text' => 'Unemployment Compensation'
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Social Security
        $this->processIncomeType($debtorMonthlyIncome, [
            'income' => 'social_security',
            'same' => 'same_social_security_income',
            'month' => 'social_security_month',
            'type' => 9,
            'text' => null
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Government Assistance
        $this->processIncomeType($debtorMonthlyIncome, [
            'income' => 'government_assistance',
            'same' => 'same_government_assistance_income',
            'month' => 'government_assistance_month',
            'type' => -1,
            'text' => 'Government Assistance: ' . Helper::validate_key_value('government_assistance_specify', $debtorMonthlyIncome)
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Other Sources
        $this->processIncomeType($debtorMonthlyIncome, [
            'income' => 'other_sources',
            'same' => 'same_other_sources_income',
            'month' => 'other_sources_month',
            'type' => -1,
            'text' => 'Other Sources of Income: ' . Helper::validate_key_value('other_options_income', $debtorMonthlyIncome)
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        return [
            'otherIncomeThisYear' => $otherIncomeThisYear,
            'otherIncomeThisYearAmount' => $otherIncomeThisYearAmount,
            'otherIncomeThisYearText' => $otherIncomeThisYearText
        ];
    }

    /**
     * Calculate other income data for spouse
     */
    private function calculateSpouseOtherIncomeData(array $debtorSpouseMonthlyIncome): array
    {
        $otherIncomeThisYear = [];
        $otherIncomeThisYearAmount = [];
        $otherIncomeThisYearText = [];

        // Retirement Income
        $this->processIncomeType($debtorSpouseMonthlyIncome, [
            'income' => 'joints_retirement_income',
            'same' => 'joints_same_retirement_income',
            'month' => 'joints_retirement_income_month',
            'type' => 8,
            'text' => null
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Regular Contributions
        $this->processIncomeType($debtorSpouseMonthlyIncome, [
            'income' => 'joints_regular_contributions',
            'same' => 'joints_same_regular_contributions',
            'month' => 'joints_regular_contributions_month',
            'type' => 5,
            'text' => null
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Unemployment Compensation
        $this->processIncomeType($debtorSpouseMonthlyIncome, [
            'income' => 'joints_unemployment_compensation',
            'same' => 'joints_same_unemployement_compensation_income',
            'month' => 'joints_unemployment_compensation_month',
            'type' => -1,
            'text' => 'Unemployment Compensation'
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Social Security
        $this->processIncomeType($debtorSpouseMonthlyIncome, [
            'income' => 'joints_social_security',
            'same' => 'joints_same_social_security_income',
            'month' => 'joints_social_security_month',
            'type' => 9,
            'text' => null
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Government Assistance
        $this->processIncomeType($debtorSpouseMonthlyIncome, [
            'income' => 'government_assistance',
            'same' => 'joints_same_government_assistance_income',
            'month' => 'government_assistance_month',
            'type' => -1,
            'text' => 'Government Assistance: ' . Helper::validate_key_value('government_assistance_specify', $debtorSpouseMonthlyIncome)
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        // Other Sources
        $this->processIncomeType($debtorSpouseMonthlyIncome, [
            'income' => 'joints_other_sources',
            'same' => 'joints_same_other_sources_income',
            'month' => 'joints_other_sources_month',
            'type' => -1,
            'text' => 'Other Sources of Income: ' . Helper::validate_key_value('joints_other_options_income', $debtorSpouseMonthlyIncome)
        ], $otherIncomeThisYear, $otherIncomeThisYearAmount, $otherIncomeThisYearText);

        return [
            'otherIncomeThisYear' => $otherIncomeThisYear,
            'otherIncomeThisYearAmount' => $otherIncomeThisYearAmount,
            'otherIncomeThisYearText' => $otherIncomeThisYearText
        ];
    }

    /**
     * Process individual income type
     */
    private function processIncomeType(array $incomeData, array $config, array &$otherIncomeThisYear, array &$otherIncomeThisYearAmount, array &$otherIncomeThisYearText): void
    {
        $income = Helper::validate_key_value($config['income'], $incomeData);
        $sameIncome = Helper::validate_key_value($config['same'], $incomeData);
        $incomeMonth = Helper::validate_key_value($config['month'], $incomeData);

        $avgPrice = $this->getPriceForMonth($income, $sameIncome, $incomeMonth);

        if ($avgPrice !== null) {
            $otherIncomeThisYear[] = $config['type'];
            $otherIncomeThisYearAmount[] = $avgPrice;
            $otherIncomeThisYearText[] = $config['text'];
        }
    }

    /**
     * Calculate price for month
     */
    private function getPriceForMonth($income, $sameIncome, $incomeMonth): ?float
    {
        $currentMonth = (int)date('n');
        $avgPrice = null;

        if ($income == 1) {
            if ($sameIncome == 1) {
                $data = $incomeMonth;
                if (is_array($data)) {
                    $thisPrice = $data[1] ?? 0;
                    $avgPrice = round((float)$thisPrice, 2) * $currentMonth;
                }
            } else {
                $data = $incomeMonth;
                $totalPrice = 0;

                if (is_array($data)) {
                    foreach ($data as $price) {
                        $totalPrice += (float)$price;
                    }
                    $avgPrice = round($totalPrice / 6, 2) * $currentMonth;
                }
            }
        }

        return $avgPrice;
    }

    /**
     * Check pay stubs status
     */
    public function checkPayStubsStatus(int $clientId, string $type = "self"): int
    {
        $tillDate = date('Y-m-d', strtotime('last day of previous month'));
        $fromDate = date("Y-m-d", strtotime("-6 months", strtotime($tillDate)));

        $paystub = PayStubs::where([
            "client_id" => $clientId,
            'pinwheel_account_type' => $type,
            'is_mapped' => 0
        ])
        ->where('pay_date', '>=', $fromDate)
        ->where('pay_date', '<=', $tillDate)
        ->exists();

        return $paystub ? 1 : 0;
    }

    /**
     * Get imported status by month
     */
    public function getImportedStatusByMonth(int $clientId, int $type, string $forMonth = ""): bool
    {
        $clientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $attorneyId = !empty($clientsAssociateId)
            ? $clientsAssociateId
            : AttorneyEmployerInformationToClient::getClientAttorneyId($clientId);
        $isAssociate = !empty($clientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorneyId, $isAssociate);

        $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
        $monthYear = !empty($forMonth) ? $forMonth : key($months);
        $monthAndYear = explode("-", $monthYear);

        $statements = MasterCardTransactions::where([
            'client_id' => $clientId,
            'client_type' => $type
        ])
        ->whereMonth('transaction_date', '=', $monthAndYear[0])
        ->whereYear('transaction_date', '=', $monthAndYear[1])
        ->get();

        foreach ($statements as $transaction) {
            if ($transaction['is_imported'] == 0) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get imported status for all months
     */
    public function getImportedStatus(int $clientId, int $type): int
    {
        $clientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $attorneyId = !empty($clientsAssociateId)
            ? $clientsAssociateId
            : AttorneyEmployerInformationToClient::getClientAttorneyId($clientId);
        $isAssociate = !empty($clientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorneyId, $isAssociate);

        $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);

        foreach ($months as $monthYear => $value) {
            $monthAndYear = explode("-", $monthYear);
            $debtorStatements = MasterCardTransactions::where([
                'client_id' => $clientId,
                'client_type' => $type
            ])
            ->whereMonth('transaction_date', '=', $monthAndYear[0])
            ->whereYear('transaction_date', '=', $monthAndYear[1])
            ->get();

            foreach ($debtorStatements as $transaction) {
                if ($transaction['is_imported'] == 0) {
                    return 1;
                }
            }
        }

        return 0;
    }

    /**
     * Build final input data
     */
    public function buildFinalInput(array $input, int $clientId): array
    {
        $finalInput = [];

        foreach ($input as $k => $v) {
            $finalInput[$k] = is_array($v) ? json_encode($v) : $v;
        }

        $finalInput['client_id'] = $clientId;

        return $finalInput;
    }
}
