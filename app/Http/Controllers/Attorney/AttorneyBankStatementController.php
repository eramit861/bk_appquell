<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\Helper;
use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use App\Helpers\DateTimeHelper;
use App\Helpers\DocumentHelper;
use ZipArchive;
use App\Helpers\VideoHelper;
use App\Models\AttorneyEmployerInformationToClient;
use App\Models\AttorneySettings;
use App\Models\ClientsAssociate;
use App\Models\PayStubs;
use App\Services\Client\CacheIncome;

class AttorneyBankStatementController extends AttorneyController
{
    public function bank_statement_index($client_type, $id, $monthNo, $subscription)
    {
        $client_type = $client_type ?? 'debtor';
        if ($client_type == 'debtor') {
            $client_type = 'Debtor';
        }
        if ($client_type == 'codebtor') {
            $client_type = 'spouse';
        }
        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $lastMonth = ltrim(date('m-Y', strtotime("-1 month")), "0");
        $secondLastMonth = ltrim(date('m-Y', strtotime("-3 month")), "0");

        // $downloadedStatements=  \App\Models\MasterCardStatements::select('id', 'client_id', 'client_type', 'account_id', 'month_year')
        //                         ->where(['client_id' => $id, 'client_type' => $client_type])
        //                         ->whereIn('month_year', [$lastMonth, $secondLastMonth])
        //                         ->orderBy('month_year', 'desc');
        $downloadedStatements = \App\Models\MasterCardStatements::where('client_id', $id)
                                    ->where('client_type', $client_type)
                                    // ->groupBy('institute_name')
                                    ->orderBy('institute_name', 'asc')
                                    ->orderBy('month_year', 'desc');
        $downloadedStatements = $downloadedStatements->paginate(10);
        $orderedStatementList = self::getOrderedStatementList($downloadedStatements->toArray(), $subscription);

        $client = $this->getClientData($id);
        $total = $this->getClientCompletedStepsCount($id);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_PAYROLL_ASSISTANT_VIDEO);


        $ClientsAssociateId = ClientsAssociate::getAssociateId($id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        $payStubAIStatus = PayStubs::getAIStatusBasedArray($id);

        return view('attorney.client.bank_statement_index', ['payStubAIStatus' => $payStubAIStatus,'attProfitLossMonths' => $attProfitLossMonths, 'video' => $video, 'totals' => $total, 'User' => $client, 'type' => 'bank-statement','orderedStatementList' => $orderedStatementList, 'downloadedStatements' => $downloadedStatements, 'monthNo' => $monthNo, 'client_type' => $client_type,'lastMonth' => $lastMonth, 'secondLastMonth' => $secondLastMonth]);
    }

    public function getOrderedStatementList($statements = [], $subscription = '')
    {
        $groupedList = [];
        if (!empty($statements)) {
            $mainList = Helper::validate_key_value('data', $statements) ?? [];
            if (!empty($mainList)) {
                foreach ($mainList as $transaction) {
                    $instituteName = $transaction['institute_name'];
                    if (!isset($groupedList[$instituteName])) {
                        $groupedList[$instituteName] = [];
                    }
                    $transaction['client_subscription'] = $subscription;
                    $groupedList[$instituteName][] = $transaction;
                }
            }
        }

        return $groupedList;
    }

    public function bank_statement($client_type, $id, $monthNo, $key, Request $request)
    {
        $insituteId = $request->institute_id;
        $monthYear = $request->monthYear ?? $key;
        $account_no = $request->account_no;
        $client_type = $client_type ?? 'debtor';
        if ($client_type == 'debtor') {
            $client_type = 'debtor';
        }
        if ($client_type == 'codebtor') {
            $client_type = 'codebtor';
        }

        $monthAndYear = explode("-", $monthYear);

        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }

        $banks = \App\Models\MasterCardTransactions::select('institute_id', 'institute_name', 'account_no')
                ->where(['client_id' => $id, 'client_type' => $client_type])
                ->groupBy('institute_id', 'institute_name', 'account_no')
                ->get()->toArray();

        $statements = \App\Models\MasterCardTransactions::where('client_id', '=', $id)
                        ->where(['client_id' => $id, 'client_type' => $client_type ])
                        ->whereMonth('transaction_date', '=', $monthAndYear[0])
                        ->whereYear('transaction_date', '=', $monthAndYear[1]);

        if (empty($insituteId) && isset($banks) && count($banks) > 0) {
            $firstBankObj = collect($banks)->first();
            $insituteId = Helper::validate_key_value('institute_id', $firstBankObj);
            $account_no = Helper::validate_key_value('account_no', $firstBankObj);
        }

        $isImported = self::getisImportedStatus($id, $client_type);

        if ($insituteId != '') {
            $statements->where('institute_id', $insituteId);
        }

        if ($account_no != '') {
            $statements->where('account_no', $account_no);
        }

        $statements = $statements->paginate(10)->appends($request->query());
        $client = $this->getClientData($id);
        $total = $this->getClientCompletedStepsCount($id);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_PAYROLL_ASSISTANT_VIDEO);

        $ClientsAssociateId = ClientsAssociate::getAssociateId($id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
        $payStubAIStatus = PayStubs::getAIStatusBasedArray($id);

        return view('attorney.client.bank_statement', ['payStubAIStatus' => $payStubAIStatus,'attProfitLossMonths' => $attProfitLossMonths, 'monthYear' => $monthYear, 'video' => $video, 'totals' => $total, 'User' => $client, 'type' => 'bank-statement', 'statements' => $statements, 'monthNo' => $monthNo,'month_key' => $key, 'client_type' => $client_type,'banks' => $banks,'account_no' => $account_no,'institute_id' => $insituteId, 'isImported' => $isImported]);
    }

    public function download_pdf($client_id, $statement_id)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        // return($statement_id);
        $statement = \App\Models\MasterCardStatements::find($statement_id);
        // return($statement->file_path);
        $filename = $statement->PDF_name.'.pdf';
        if (!\File::exists($statement->file_path)) {
            return redirect()->back()->with('error', 'File not available.');
        }

        return redirect(\Storage::disk('s3')->temporaryUrl(
            $statement->file_path,
            now()->addDays(2),
            ['ResponseContentDisposition' => 'attachment;filename= '.$filename]
        ));
    }

    public function download_pdf_all($client_id)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $statements = \App\Models\MasterCardStatements::where('client_id', $client_id)->where('is_success', true)->get();
        $zip = new ZipArchive();
        $fileName = public_path().'/BankStatements/zips/'.Helper::getCurrentAttorneyId().'/Bank_Statements_downloads.zip';

        if ($zip->open($fileName, ZipArchive::CREATE) === true) {
            foreach ($statements as $file) {
                if (!\File::exists($file->file_path)) {
                    continue;
                }
                $relativeName = basename($file->file_path);
                $filepath = DocumentHelper::s3toTemp($client_id, $file->file_path);
                if (\File::exists($filepath)) {
                    $zip->addFile($filepath, $relativeName);
                }
            }
            $zip->close();
        }
        DocumentHelper::flushS3Temp($client_id);
        DocumentHelper::generateZipFile(urlencode('Bank_Statements_downloads.zip'), $fileName);
    }

    public function getisImportedStatus($client_id, $type)
    {
        $isImported = 0;

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
        // last month default
        foreach ($months as $monthYear => $value) {
            $monthAndYear = explode("-", $monthYear);
            $statements = \App\Models\MasterCardTransactions::where(['client_id' => $client_id, 'client_type' => $type ])
                            ->whereMonth('transaction_date', '=', $monthAndYear[0])
                            ->whereYear('transaction_date', '=', $monthAndYear[1]);
            $statements = $statements->get()->toArray();
            foreach ($statements as $transaction) {
                if ($transaction['is_imported'] == 0) {
                    $isImported = 1;
                    break;
                }
            }
        }

        return $isImported;
    }

    public function getisImportedStatusByMonth($client_id, $type, $forMonth = "")
    {
        $isImported = true;

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        $months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
        // last month default
        $monthYear = !empty($forMonth) ? $forMonth : key($months);
        $monthAndYear = explode("-", $monthYear);
        $monthAndYear = explode("-", $monthYear);
        $statements = \App\Models\MasterCardTransactions::where(['client_id' => $client_id, 'client_type' => $type ])
                        ->whereMonth('transaction_date', '=', $monthAndYear[0])
                        ->whereYear('transaction_date', '=', $monthAndYear[1]);
        $statements = $statements->get()->toArray();
        foreach ($statements as $transaction) {
            if ($transaction['is_imported'] == 0) {
                $isImported = false;
                break;
            }
        }

        return $isImported;
    }

    public function import_client_bank_statement_popup(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $type = Helper::validate_key_value('user_type', $input);
            $type = strtolower($type);
            $client_id = Helper::validate_key_value('client_id', $input);
            $selectedMonth = Helper::validate_key_value('selectedMonth', $input);
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
            }
            $data = \App\Models\ProfitLoss::openBankStatementImportPopup($input, $selectedMonth);
            $data['isImportedForThisMonth'] = self::getisImportedStatusByMonth($client_id, $type, $selectedMonth);

            return view('attorney.bank_statement_to_client_import_popup', [ 'client_id' => $client_id, 'type' => $type, 'data' => $data, 'isClient' => 0]);
        }
    }

    public function import_client_bank_statement_save(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = Helper::validate_key_value('client_id', $input);
            $client_type = Helper::validate_key_value('client_type', $input);
            $monthYear = Helper::validate_key_value('monthYear', $input);
            $monthAndYear = explode("-", $monthYear);
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
            }
            $data = \App\Models\ProfitLoss::bankStatementImportSave($input);
            $user = \App\Models\User::whereId($client_id)->first();
            if ($client_type == 'debtor') {
                $user->incomeDebtorMonthlyIncome()->updateOrCreate(['client_id' => $client_id], ['operation_business' => 1, 'income_profit_loss' => $data]);
            }
            if ($client_type == 'codebtor') {
                $user->incomeDebtorSpouseMonthlyIncome()->updateOrCreate(['client_id' => $client_id], ['joints_operation_business' => 1, 'income_profit_loss' => $data]);
            }
            CacheIncome::forgetIncomeCache($client_id);
            \App\Models\MasterCardTransactions::where([
                        'client_id' => $client_id,
                        'client_type' => $client_type
                    ])
                    ->whereMonth('transaction_date', '=', $monthAndYear[0])
                    ->whereYear('transaction_date', '=', $monthAndYear[1])
                    ->update([ 'is_imported' => 1, 'is_imported_for' => '']);

            return redirect()->back()->with('success', 'Profit Loss data successfully imported to client questionnaire.');
        }
    }
}
