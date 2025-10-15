<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\ArrayHelper;
use App\Models\IncomeDebtorMonthlyIncome;
use App\Models\IncomeDebtorSpouseMonthlyIncome;
use App\Services\Client\CacheIncome;

class StatementProfitLossController extends AttorneyController
{
    public function updateExpenseType(Request $request)
    {
        $input = $request->all();

        $transactionTblId = $input['id'];
        $selectValue = $input['value'];
        $monthYear = $input['monthYear'];
        $none = 0;

        $transactionData = $this->getTransactionData($transactionTblId) ?? [];
        $client_id = $transactionData['client_id'] ?? '';
        $transactionId = $transactionData['transaction_id'] ?? '';
        $amount = $transactionData['amount'] ?? '';
        $isImported = $transactionData['is_imported'] ?? '';
        $isImportedFor = $transactionData['is_imported_for'] ?? '';
        $client_type = $transactionData['client_type'];
        if ($selectValue == "none") {
            $none = 1;
            $selectValue = $isImportedFor;
        }

        if ($isImported == 1 && $none == 0) {
            return response()->json(Helper::renderJsonError('This transaction is Already Imported.'));
        } elseif ($isImported == 0 && $none == 0) {
            $this->updateData($client_id, $amount, $selectValue, $monthYear, $none, $isImportedFor, $client_type);
            \App\Models\MasterCardTransactions::updateOrCreate(["id" => $transactionTblId,'transaction_id' => $transactionId], [ 'is_imported' => 1, 'is_imported_for' => $selectValue]);

            return response()->json(Helper::renderJsonSuccess('Expense updated Successfully!'));
        } elseif ($isImported == 1 && $none == 1) {
            $this->updateData($client_id, $amount, $selectValue, $monthYear, $none, $isImportedFor, $client_type);
            \App\Models\MasterCardTransactions::updateOrCreate(["id" => $transactionTblId,'transaction_id' => $transactionId], [ 'is_imported' => 0, 'is_imported_for' => '']);

            return response()->json(Helper::renderJsonSuccess('Expense updated Successfully!'));
        }
    }

    private function updateData($client_id, $amount, $selectValue, $monthYear, $none, $isImportedFor, $client_type)
    {
        if ($client_type == 'debtor') {
            $profitLossIncomeData = IncomeDebtorMonthlyIncome::getProfitLossIncome($client_id);
        }
        if ($client_type == 'codebtor') {
            $profitLossIncomeData = IncomeDebtorSpouseMonthlyIncome::getProfitLossIncome($client_id);
        }
        $profitLossJson = !empty($profitLossIncomeData['income_profit_loss']) ? json_decode($profitLossIncomeData['income_profit_loss'], 1) : [];



        $profitLossJsonUpdated = IncomeDebtorMonthlyIncome::updateProfitLossJson($profitLossJson, $amount, $selectValue, $monthYear, $none, $isImportedFor, $client_type);
        $profitLossJsonUpdated = self::reCalculateJson($profitLossJsonUpdated);
        $profitLossJsonUpdated = json_encode($profitLossJsonUpdated);

        if ($client_type == 'debtor') {
            IncomeDebtorMonthlyIncome::updateOrCreate(['client_id' => $client_id], ['income_profit_loss' => $profitLossJsonUpdated]);
        }
        if ($client_type == 'codebtor') {
            IncomeDebtorSpouseMonthlyIncome::updateOrCreate(['client_id' => $client_id], ['income_profit_loss' => $profitLossJsonUpdated]);
        }

        CacheIncome::forgetIncomeCache($client_id);
    }

    private function getTransactionData($transactionTblId)
    {
        $transactionData = \App\Models\MasterCardTransactions::select('id', 'client_id', 'transaction_id', 'amount', 'client_type', 'is_imported', 'is_imported_for')
                                                              ->where('id', '=', $transactionTblId)
                                                              ->first();

        return $transactionData;
    }

    private static function reCalculateJson($json)
    {
        $proftlosskeys = array_keys(ArrayHelper::getExpenseTypeArray());
        unset($proftlosskeys[0]);
        $updateJson = [];
        foreach ($json as $key => $pjson) {
            $expenses = 0;
            foreach ($pjson as $k => $v) {
                if (in_array($k, $proftlosskeys)) {
                    $expenses = $expenses + (float)$v;
                }
            }
            $pjson['total_expense'] = $expenses;
            $pjson['total_profit_loss'] = (float)$pjson['gross_business_income'] - $expenses;
            array_push($updateJson, $pjson);
        }

        return $updateJson;

    }

}
