<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use App\Helpers\DateTimeHelper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;

class ProfitLoss extends Model
{
    use HasFactory;
    public static function openBankStatementImportPopup($input, $forMonth = "")
    {
        $type = $input['user_type'] ?? '';
        $type = strtolower($type);
        $client_id = $input['client_id'];
        $data = [];

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
        // last month default
        $monthYear = !empty($forMonth) ? $forMonth : key($months);
        $descriptionAmountData = [];
        if (in_array($type, ['debtor', 'codebtor'])) {
            $descriptionAmountData = self::getStatementsData($client_id, $type, $monthYear);
        }
        $categories = self::getCategoriesArray();
        $data = [
            'client_id' => $client_id,
            'client_type' => $type,
            'monthYear' => $monthYear,
            'months' => $months,
            'descriptionAmountData' => $descriptionAmountData,
            'categories' => $categories
        ];

        return $data;
    }

    public static function bankStatementImportSave($input)
    {
        $clientId = Helper::validate_key_value('client_id', $input);
        $clientType = Helper::validate_key_value('client_type', $input);
        $selectedMonthYear = Helper::validate_key_value('monthYear', $input);
        $expenseType = Helper::validate_key_value('expense_type', $input);
        $expenseType = !empty($expenseType) ? $expenseType : [];
        $descriptionAmountData = self::getStatementsData($clientId, $clientType, $selectedMonthYear);
        $grossBusinessIncome = self::getGrossBusinessIncome($clientId, $clientType, $selectedMonthYear);
        $debtorName = self::getName($clientId, 1);
        $codebtorName = self::getName($clientId, 2);
        $new_date = date('m/d/Y');
        $otherExpenses = [];
        $arrayPartA = [
                            'profit_loss_type' => 2,
                            'name_of_business' => '',
                            'profit_loss_month' => $selectedMonthYear,
                            'gross_business_income' => $grossBusinessIncome
                        ];
        $arrayPartB = [];
        foreach ($expenseType as $description => $type) {
            $amount = $descriptionAmountData[$description] ?? 0;
            if (!isset($arrayPartB[$type])) {
                $arrayPartB[$type] = 0;
            }
            $arrayPartB[$type] += $amount;
            if (strpos($type, 'other_') === 0) {
                $index = intval(substr($type, strlen('other_')));
                if (!isset($otherExpenses[$index])) {
                    $otherExpenses[$index] = [];
                }
                $otherExpenses[$index][] = $description;
            }
        }
        $totalExpense = array_sum($arrayPartB);
        $totalProfitLoss = $grossBusinessIncome - $totalExpense;
        foreach ($otherExpenses as $index => $descriptions) {
            $expenseKey = "other_$index";
            $descriptionKey = "other_expense_name$index";
            $arrayPartB[$descriptionKey] = implode(', ', $descriptions);
            $arrayPartB[$expenseKey] = array_sum(array_map(function ($desc) use ($descriptionAmountData) {
                return $descriptionAmountData[$desc];
            }, $descriptions));
        }
        $arrayPartC = [
            'total_expense' => $totalExpense,
            'total_profit_loss' => $totalProfitLoss
        ];
        $arrayPartD = [
            'debtor1_sign' => $debtorName,
            'debtor1_sign_date' => $new_date,
            'debtor2_sign' => $codebtorName,
            'debtor2_sign_date' => $new_date
        ];
        $dataToSave = array_merge($arrayPartA, $arrayPartB, $arrayPartC, $arrayPartD);

        $existingData = self::getClientProfitLossData($clientId);
        $existingData = $existingData['income_profit_loss'] ?? [];

        $profitLossMainData = self::getProfitLossOfMonthData($existingData, $dataToSave);
        $encodedJson = json_encode($profitLossMainData);

        return $encodedJson;
    }

    public static function getCategoriesArray()
    {
        return  [
                    'cost_of_goods_sold' => 'Cost of goods sold',
                    'advertising_expense' => 'Marketing and Advertising',
                    'subcontractor_pay' => 'Subcontractor Pay',
                    'professional_service' => 'Professional Services',
                    'cc_expense' => 'Credit/Debit Card',
                    'equipment_rental_expense' => 'Equipment Rental/Lease',
                    'insurance_expense' => 'Insurance Expense(s)',
                    'licenses_expense' => 'Licenses/Permits',
                    'office_supplies_expense' => 'Office Supplies',
                    'postage_expense' => 'Postage and Delivery',
                    'rent_office_expense' => 'Repairs and Maintenance',
                    'bank_fee_and_interest' => 'Bank Fees and Interest',
                    'software_and_subscription' => 'Software and Subscriptions',
                    'supplies_material_expense' => 'Supplies/Materials Expense',
                    'travel_expense' => 'Travel/Entertainment',
                    'utility_expense' => 'Utilities Expense',
                    'vehicle_expense' => 'Vehicle Expense',
                    'other_1' => 'Other Business Expense 1',
                    'other_2' => 'Other Business Expense 2',
                    'other_3' => 'Other Business Expense 3',
                    'other_4' => 'Other Business Expense 4',
                ];
    }

    public static function getStatementsData($client_id, $client_type, $monthYear)
    {
        $monthAndYear = explode("-", $monthYear);
        $statements = \App\Models\MasterCardTransactions::where(['client_id' => $client_id, 'client_type' => $client_type ])
                ->whereMonth('transaction_date', '=', $monthAndYear[0])
                ->whereYear('transaction_date', '=', $monthAndYear[1])
                ->get()
                ->toArray();
        $descriptionAmountData = [];
        if (!empty($statements)) {
            $uniqueDescriptions = array_unique(array_column($statements, 'description'));
            sort($uniqueDescriptions);
            foreach ($uniqueDescriptions as $description) {
                $matchingValues = [];
                foreach ($statements as $statement) {
                    if ($statement['description'] === $description) {
                        $matchingValues[] = $statement['amount'];
                    }
                }
                // $sum = array_sum(array_map('abs', $matchingValues));
                $sum = array_sum(array_map(function ($val) {
                    return ($val < 0) ? abs($val) : 0;
                }, $matchingValues));
                if ($sum > 0) {
                    $descriptionAmountData[$description] = $sum;
                }
            }
        }

        return $descriptionAmountData;
    }

    public static function getGrossBusinessIncome($client_id, $client_type, $monthYear)
    {
        $monthAndYear = explode("-", $monthYear);
        $statementAmounts = \App\Models\MasterCardTransactions::where(['client_id' => $client_id, 'client_type' => $client_type ])
                ->whereMonth('transaction_date', '=', $monthAndYear[0])
                ->whereYear('transaction_date', '=', $monthAndYear[1])
                ->select('amount')
                ->get()
                ->toArray();
        $positiveSum = 0;
        foreach ($statementAmounts as $entry) {
            $amount = $entry["amount"];
            if ($amount > 0) {
                $positiveSum += $amount;
            }
        }

        return $positiveSum;
    }

    public static function getName($client_id, $client_type)
    {
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        if ($client_type == 1) {
            $data = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        }
        if ($client_type == 2) {
            $data = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        }
        $firstName = Helper::validate_key_value('name', $data);
        $middleName = Helper::validate_key_value('middle_name', $data);
        $lastName = Helper::validate_key_value('last_name', $data);

        return $firstName.(!empty($middleName) ? (' '.$middleName.' '.$lastName) : (' '.$lastName));
    }

    public static function getClientProfitLossData($client_id): array
    {
        $incomeData = CacheIncome::getIncomeData($client_id);
        $debtorIncomeTabData = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');

        return User::getSelectedColumnsFromArray($debtorIncomeTabData, ['income_profit_loss']);
    }

    public static function getProfitLossArray($debtormonthlyincome)
    {
        $debtormonthlyincome = (!empty($debtormonthlyincome)) ? $debtormonthlyincome->toArray() : [];
        $final_debtormonthlyincome = [];
        if (!empty($debtormonthlyincome)) {
            foreach ($debtormonthlyincome as $k => $v) {
                if ($k == 'income_profit_loss') {
                    if (is_array(json_decode($v, 1))) {
                        $final_debtormonthlyincome[$k] = json_decode($v, 1);
                    } else {
                        $final_debtormonthlyincome[$k] = $v;
                    }
                }
            }
        }

        return $final_debtormonthlyincome;
    }

    public static function getProfitLossOfMonthData($existingData, $postedData): array
    {
        $dataToBeSaved = [];
        if (!empty($existingData)) {
            $dataToBeSaved = self::profitLossOfMonthDataFromExistingData($postedData, $dataToBeSaved, $existingData);
        } else {
            $dataToBeSaved = $postedData;
            if ($postedData['profit_loss_type'] == 2) {
                $dataToBeSaved = [$postedData];
            }
        }

        return $dataToBeSaved;
    }

    public static function profitLossOfMonthDataFromExistingData($postedData, $dataToBeSaved, $existingData)
    {
        if ($postedData['profit_loss_type'] == 2 && isset($existingData[0]['profit_loss_type'])) {
            /** that means now they want to update or add months data */
            $new = true;
            foreach ($existingData as $month) {
                if ($month['profit_loss_month'] == $postedData['profit_loss_month']) {
                    $new = false;
                    $month = $postedData;
                }
                $dataToBeSaved[] = $month;
            }
            if ($new) {
                $dataToBeSaved[] = $postedData;
            }
        }

        return self::validateProfitLossExistingData($postedData, $dataToBeSaved, $existingData);
    }

    public static function validateProfitLossExistingData($postedData, $dataToBeSaved, $existingData)
    {
        if ($postedData['profit_loss_type'] == 1 && isset($existingData[0]['profit_loss_type']) && $existingData[0]['profit_loss_type'] == 2) {
            $dataToBeSaved = $postedData;
        }
        if ($postedData['profit_loss_type'] == 2 && isset($existingData['profit_loss_type']) && $existingData['profit_loss_type'] == 1) {
            $dataToBeSaved = [$postedData];
        }
        if ($postedData['profit_loss_type'] == 1 && isset($existingData['profit_loss_type']) && $existingData['profit_loss_type'] == 1) {
            $dataToBeSaved = $postedData;
        }

        return $dataToBeSaved;
    }
}
