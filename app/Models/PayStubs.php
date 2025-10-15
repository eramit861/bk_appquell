<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\DateTimeHelper;
use App\Helpers\ArrayHelper;
use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Services\Client\CacheIncome;
use App\Services\Client\CacheSOFA;
use Illuminate\Support\Facades\DB;

class PayStubs extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_pinwheel_paystub';
    public $timestamps = false;

    public function getPaystubByType($id, $type)
    {
        $now = \Carbon\Carbon::now();
        $fromDate = $now->copy()->startOfMonth()->subMonths(6);
        $tillDate = $now->copy()->startOfMonth()->subDay();
        $allReport = \App\Models\PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->select([DB::raw('sum(gross_pay_amount) as gross_pay_amount'),DB::raw('sum(total_taxes) as total_taxes'),DB::raw('sum(total_deductions) as total_deductions'),DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as pay_period_end"),DB::raw("DATE_FORMAT(pay_date, '%m/%d/%Y') as payment_date")])->groupBy(DB::raw("DATE_FORMAT(pay_date, '%m-%Y')"))->orderBy('pay_date', 'DESC')->get();

        return $allReport;
    }
    public function getPaystubByTypeForJubliee($id, $type)
    {

        $tillDate = date('Y-m-d', strtotime('last day of previous month'));
        $fromDate = date("Y-m-d", strtotime("-6 months", strtotime($tillDate)));
        $allReport = \App\Models\PayStubs::leftJoin("tbl_payroll_assistant_employer_to_client", "tbl_pinwheel_paystub.employer_id", "=", "tbl_payroll_assistant_employer_to_client.id")
                        ->where(['pinwheel_account_type' => $type,'tbl_pinwheel_paystub.client_id' => $id,'tbl_payroll_assistant_employer_to_client.client_id' => $id])
                        ->where('pay_date', '>=', $fromDate)
                        ->where('pay_date', '<=', $tillDate)
                        ->select([  "tbl_payroll_assistant_employer_to_client.id as employer_id",
                                    DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as pay_period_end"),
                                    "employer_occupation",
                                    "employment_duration",
                                    "regular_pay_amount",
                                    "overtime_pay_amount",
                                    "gross_pay_amount",
                                    "taxes",
                                    "deductions",
                                    "employer_name",
                                    "employer_address",
                                    "employer_city",
                                    "employer_state",
                                    "employer_zip",
                                    "total_taxes",
                                    "total_deductions",
                                    "frequency",
                                    DB::raw("DATE_FORMAT(pay_date, '%m/%d/%Y') as payment_date")])
                        ->orderBy('pay_date', 'DESC')->get();

        return $allReport;
    }
    public static function storePaystub($client_id, $type = 'self')
    {

        $tillDate = date('Y-m-d', strtotime('last day of previous month'));
        $fromDate = date("Y-m-d", strtotime("-6 months", strtotime($tillDate)));
        $paystubs = \App\Models\PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $client_id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->select([DB::raw('sum(gross_pay_amount) as gross_pay_amount'),DB::raw('sum(total_taxes) as total_taxes'),DB::raw('sum(total_deductions) as total_deductions'),DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as pay_period_end")])->groupBy(DB::raw("DATE_FORMAT(pay_date, '%m-%Y')"))->orderBy('pay_date', 'DESC')->get();
        $paystubs = !empty($paystubs) ? $paystubs->toArray() : [];
        if (empty($paystubs)) {
            return [];
        }

        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }
        $taxList = \App\Models\DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "1")->whereIn("deduction_added_by", [$attorney_id,1])
        ->orderBy('deduction_label', 'ASC')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get();
        $taxList = !empty($taxList) ? $taxList->toArray() : [];
        $taxLabels = array_column($taxList, 'deduction_label');
        $paystubmonths = PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $client_id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->select(DB::raw('count(id) as countmonths'))->groupBy(DB::raw("(DATE_FORMAT(pay_date, '%m-%Y'))"))->get();
        $monthsCount = $paystubmonths->count();


        $thisyearTilldate = date('Y').'-01-05';
        $paystubYTD = PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $client_id])->select('gross_pay_ytd')->whereYear('pay_date', date('Y'))->where('pay_date', '>', $thisyearTilldate)->orderby('gross_pay_ytd', 'desc')->first();
        $grossYTD = $paystubYTD['gross_pay_ytd'] ?? 0;
        if ($grossYTD > 0) {

            $financial = ['total_amount_income' => 1,'total_amount_this_year' => 1, 'total_amount_this_year_income' => $grossYTD];
            if ($type == 'spouse') {
                $financial = ['total_amount_income_spouse' => 1,'total_amount_spouse_this_year' => 1, 'total_amount_spouse_this_year_income' => $grossYTD];
            }
            FinancialAffairs::updateOrCreate(["client_id" => $client_id], $financial);
        }

        $lastyearFromdate = date("Y-12-15", strtotime("-1 year"));
        $lastyearTilldate = date('Y').'-01-05';
        ;
        $lastpaystubYTD = PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $client_id])->select('gross_pay_ytd')->whereBetween('pay_date', [$lastyearFromdate, $lastyearTilldate])->orderby('gross_pay_ytd', 'desc')->first();
        $lygrossYTD = $lastpaystubYTD['gross_pay_ytd'] ?? 0;
        if ($lygrossYTD > 0) {
            $financial = ['total_amount_income' => 1,'total_amount_last_year' => 1, 'total_amount_last_year_income' => $lygrossYTD];
            if ($type == 'spouse') {
                $financial = ['total_amount_income_spouse' => 1,'total_amount_spouse_last_year' => 1, 'total_amount_spouse_last_year_income' => $lygrossYTD];
            }
            FinancialAffairs::updateOrCreate(["client_id" => $client_id], $financial);
        }

        $lastbeforeyearFromdate = date("Y-12-15", strtotime("-2 year"));
        $lastbeforeyearTilldate = date("Y-01-05", strtotime("-1 year"));
        $lastpaybstubYTD = PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $client_id])->select('gross_pay_ytd')->whereBetween('pay_date', [$lastbeforeyearFromdate, $lastbeforeyearTilldate])->orderby('gross_pay_ytd', 'desc')->first();
        $lybgrossYTD = $lastpaybstubYTD['gross_pay_ytd'] ?? 0;
        if ($lybgrossYTD > 0) {
            $financial = ['total_amount_income' => 1,'total_amount_lastbefore_year' => 1, 'total_amount_lastbefore_year_income' => $lybgrossYTD];
            if ($type == 'spouse') {
                $financial = ['total_amount_income_spouse' => 1,'total_amount_spouse_lastbefore_year' => 1, 'total_amount_spouse_lastbefore_year_income' => $lybgrossYTD];
            }
            FinancialAffairs::updateOrCreate(["client_id" => $client_id], $financial);
        }

        // clear cache for client SOFA
        CacheSOFA::forgetSOFACache($client_id);

        $totalGrossPay = 0;
        $totalTaxes = 0;
        $totalDeduction = 0;
        $totalnetAmount = 0;

        if (!empty($paystubs[0])) {
            $montYears = DateTimeHelper::getMonthYearArray();
            foreach ($montYears as $m => $v) {
                if (!in_array($m, array_column($paystubs, 'pay_period_end'))) {
                    array_push($paystubs, ['pay_period_end' => $m, 'gross_pay_amount' => 0,'total_taxes' => 0,'total_deductions' => 0]);
                }
            }
            $dateWisePaystub = [];
            foreach ($paystubs as $pays) {
                $dateWisePaystub[$pays['pay_period_end']] = [
                    'gross_pay_amount' => $pays['gross_pay_amount'],
                    'total_taxes' => $pays['total_taxes'],
                    'total_deductions' => $pays['total_deductions'],
                    'gross_pay_amount' => $pays['gross_pay_amount'],
                ];
            }
        }

        foreach ($montYears as $key => $val) {
            $report = $dateWisePaystub[$key] ?? [];
            $totalGrossPay += $report['gross_pay_amount'] ?? 0;
            $totalTaxes += $report['total_taxes'] ?? 0;
            $totalDeduction += $report['total_deductions'] ?? 0;
            $totalnetAmount += isset($report['gross_pay_amount']) ? (float)$report['gross_pay_amount'] - (float)$report['total_taxes'] - (float)$report['total_deductions'] : 0;
        }

        $averageovertime = 0;
        if ($type == 'self') {
            $final_input['debtor_gross_wages'] = 1;
            $final_input['often_get_paid'] = 4;
            $final_input['debtor_gross_wages_month'] = json_encode([1 => ($totalGrossPay > 0 ? Helper::formatPrice(($totalGrossPay / 6), 0, 0) : 0)]);
            $final_input['overtime_per_month'] = $averageovertime;
            $final_input['client_id'] = $client_id;
            $final_input['paycheck_for_security'] = $totalTaxes > 0 ? Helper::formatPrice($totalTaxes / 6, 0, 0) : 0;
            IncomeDebtorMonthlyIncome::updateOrCreate(["client_id" => $client_id], $final_input);
        }

        if ($type == 'spouse') {
            $final_input['joints_debtor_gross_wages'] = 1;
            $final_input['joints_often_get_paid'] = 4;
            $final_input['joints_debtor_gross_wages_month'] = json_encode([1 => ($totalGrossPay > 0 ? Helper::formatPrice($totalGrossPay / 6, 0, 0) : 0)]);
            $final_input['joints_overtime_per_month'] = $averageovertime;
            $final_input['client_id'] = $client_id;
            $final_input['joints_paycheck_for_security'] = $totalTaxes > 0 ? Helper::formatPrice($totalTaxes / 6, 0, 0) : 0;
            IncomeDebtorSpouseMonthlyIncome::updateOrCreate(["client_id" => $client_id], $final_input);
        }

        CacheIncome::forgetIncomeCache($client_id);
    }


    public static function dummyPaystubEntry($input, $docId, $docName = '', $index = '')
    {
        $client_id = $input['client_id'];
        $client_type = Helper::validate_key_value('document_type', $input) == "Debtor_Pay_Stubs" ? 'self' : 'spouse';
        $employerIdData = Helper::validate_key_value('employer_id', $input);
        $paystubDateData = Helper::validate_key_value('paystub_date', $input);
        $dateToRemove = Helper::validate_key_value($index, $paystubDateData);
        $employer_id = ArrayHelper::getValidatedDataForDummyEntry($employerIdData, $index, 'radio');
        $paystub_date = ArrayHelper::getValidatedDataForDummyEntry($paystubDateData, $index);
        if (empty($docName)) {
            $docName = str_replace('/', '.', $paystub_date);
        }
        if (!empty($paystub_date)) {
            $paystub_date = str_replace('/', '.', $paystub_date);
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $paystub_date)) {
            $date = \DateTime::createFromFormat('m.d.Y', $paystub_date);
            if ($date !== false) {
                $paystub_date = $date->format('Y-m-d'); // Output: 2025-01-25
            } else {
                // Handle invalid date format gracefully
                $paystub_date = null;
            }
        }

        $dateTime = date("Y-m-d H:i:s");
        $data = [
                    'client_id' => $client_id,
                    'pay_period_start' => $paystub_date,
                    'pay_period_end' => $paystub_date,
                    'pay_date' => $paystub_date,
                    'document' => $docName,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                    'pinwheel_account_type' => $client_type,
                    'paystub_for_month' => date('Ym', strtotime($paystub_date)),
                    'employer_id' => $employer_id,
                    'is_mapped' => 0,
                    'document_id' => $docId,
                    'is_calculated' => 0,
                ];

        $paystub = PayStubs::updateOrCreate(
            [
                'employer_id' => $employer_id,
                'pay_date' => $paystub_date,
                'pinwheel_account_type' => $client_type,
            ],
            $data
        );

        $empData = AttorneyEmployerInformationToClient::where([ 'client_id' => $client_id, 'id' => $employer_id])->select('not_own_paystub')->first();
        if (!empty($empData)) {
            $not_own_paystub = $empData->not_own_paystub;
            if (!empty($not_own_paystub)) {
                // $not_own_paystub = json_decode($not_own_paystub, true);
                foreach ($not_own_paystub as $key => $value) {
                    if ($value == $dateToRemove) {
                        unset($not_own_paystub[$key]);
                    }
                }
                AttorneyEmployerInformationToClient::where([ 'client_id' => $client_id, 'id' => $employer_id])->update(['not_own_paystub' => json_encode($not_own_paystub)]);
            }
        }


        return $paystub->id;

    }


    public static function importPaystubJson($client_id, $type, $docId, $employer_id, $paystub = [])
    {
        try {
            DB::beginTransaction(); // Start transaction

            $insert = [];
            $filename = '';
            $paystubcolumType = 'self';
            if ($type == 'Co_Debtor_Pay_Stubs') {
                $paystubcolumType = 'spouse';
            }
            $filename = date("F-d-Y", strtotime($paystub['payDate'])) . '.pdf';
            $filename = $paystubcolumType == 'spouse' ? $type . '_' . $filename : $filename;

            $taxesFormat = [];
            if (!empty($paystub['taxes'])) {
                foreach ($paystub['taxes'] as $name => $amount) {
                    if ($amount != 0) {
                        $taxesFormat[] = [
                            'name' => ArrayHelper::getMappingOfTaxrray($name),
                            'amount' => $amount
                        ];
                    }
                }
            }

            $paystub['taxes'] = $taxesFormat;

            if (!empty($paystub['deductions'])) {
                foreach ($paystub['deductions'] as $key => $taxes) {
                    if ($taxes['amount'] != 0) {
                        $paystub['deductions'][$key]['amount'] = $taxes['amount'];
                    }
                }
            }

            if (!empty($paystub['earnings'])) {
                foreach ($paystub['earnings'] as $key => $taxes) {
                    if ($taxes['amount'] != 0) {
                        $paystub['earnings'][$key]['amount'] = $taxes['amount'];
                    }
                }
            }

            if (empty($paystub['total_taxes'])) {
                $paystub['total_taxes'] = 0;
                foreach ($taxesFormat as $tax) {
                    $paystub['total_taxes'] += $tax['amount'];
                }
            }

            if (empty($paystub['total_deductions'])) {
                $paystub['total_deductions'] = 0;
                foreach ($paystub['deductions'] as $ded) {
                    $paystub['total_deductions'] += $ded['amount'];
                }
            }

            $datebreak = explode('-', $paystub['payPeriodStart']);
            $paymonth = $datebreak[0] . $datebreak[1];
            $timestamp = date("Y-m-d H:i:s");

            $insert = [
                'client_id' => $client_id,
                'created_at' => $timestamp,
                'updated_at' => $timestamp,
                'paystub_for_month' => $paymonth,
                'pay_period_start' => $paystub['payPeriodStart'],
                'pay_period_end' => $paystub['payPeriodEnd'],
                'pay_date' => $paystub['payDate'],
                'currency' => 'USD',
                'regular_pay_amount' => $paystub['grossIncomeCurrent'],
                'gross_pay_amount' => $paystub['grossIncomeCurrent'],
                'net_pay_amount' => $paystub['netPay'],
                'check_amount' => $paystub['checkAmount'] ?? 0.00,
                'gross_pay_ytd' => $paystub['gross_pay_ytd'] ?? 0.00,
                'net_pay_ytd' => $paystub['net_pay_ytd'] ?? 0.00,
                'total_taxes' => $paystub['total_taxes'] ?? 0.00,
                'total_deductions' => $paystub['total_deductions'],
                'total_reimbursements' => $paystub['total_reimbursements'] ?? '',
                'taxes' => json_encode($paystub['taxes']),
                'deductions' => json_encode($paystub['deductions']),
                'earnings' => json_encode($paystub['earnings'] ?? ''),
                'pinwheel_account_type' => $paystubcolumType,
                'document' => $filename ?? '',
                'file_content' => '',
                'is_mapped' => 0,
                'paystub_json' => json_encode($paystub),
                'employer_id' => $employer_id,
                'document_id' => $docId,
                'is_calculated' => 0,
                'processed_by_ai' => 1
            ];

            $formattedDate = date('m.d.Y', strtotime($paystub['payDate']));
            \App\Models\ClientDocumentUploaded::where('id', $docId)->update(['document_paystub_date' => $formattedDate, 'updated_name' => $formattedDate]);

            \App\Models\PayStubs::updateOrCreate(
                [
                    'employer_id' => $employer_id,
                    'document_id' => $docId,
                ],
                $insert
            );

            DB::commit(); // Commit transaction if all succeeds

        } catch (\Exception $e) {
            DB::rollBack(); // Roll back changes if error occurs

            // Optionally log the error or re-throw
            \Log::error('Failed to import paystub JSON: ' . $e->getMessage(), ['exception' => $e]);
        }
    }


    public static function getPendingforAiPaystubs($client_id, $document_type, $checkInProgress = false)
    {
        $query = \App\Models\ClientDocumentUploaded::leftJoin('tbl_pinwheel_paystub', 'tbl_pinwheel_paystub.document_id', '=', 'tbl_client_document_uploaded.id')
            ->leftJoin('pdf_ocr_to_json', 'pdf_ocr_to_json.document_id', '=', 'tbl_pinwheel_paystub.document_id')
            ->select(
                'tbl_pinwheel_paystub.id as paystub_id',
                'tbl_pinwheel_paystub.pay_date',
                'tbl_pinwheel_paystub.document_id',
                'tbl_pinwheel_paystub.gross_pay_amount',
                'tbl_pinwheel_paystub.total_taxes',
                'tbl_pinwheel_paystub.total_deductions',
                'tbl_pinwheel_paystub.net_pay_amount',
                'tbl_pinwheel_paystub.employer_id',
                'tbl_pinwheel_paystub.document',
                'tbl_client_document_uploaded.document_file'
            )
            ->where('tbl_client_document_uploaded.client_id', $client_id)
            ->whereNull('tbl_pinwheel_paystub.gross_pay_amount')
            ->whereNotNull('tbl_pinwheel_paystub.document_id');

        if (!empty($document_type)) {
            $query->where('tbl_client_document_uploaded.document_type', $document_type);
        }
        if ($checkInProgress) {
            $query->whereNotNull('pdf_ocr_to_json.status')
                ->addSelect('pdf_ocr_to_json.status');
        } else {
            $query->whereNull('pdf_ocr_to_json.document_id');
        }

        return $query->get();
    }

    public static function getStatusBasedArray($id, $docType)
    {
        $payStubApiStatus = \App\Models\PayStubs::getPendingforAiPaystubs($id, $docType, true);
        $results = !empty($payStubApiStatus) ? $payStubApiStatus->toArray() : [];

        $statusCounts = [
            'pending' => 0, // status = 0
            'in_progress' => 0, // status = 2
            'completed' => 0, // status = 1
            'failed' => 0  // status = 3
        ];
        if (!empty($results)) {
            foreach ($results as $row) {

                switch ((int)$row['status']) {
                    case 0:
                        $statusCounts['pending'] = $statusCounts['pending'] + 1;
                        break;
                    case 1:
                        $statusCounts['completed'] = $statusCounts['completed'] + 1;
                        break;
                    case 2:
                        $statusCounts['in_progress'] = $statusCounts['in_progress'] + 1;
                        break;
                    case 3:
                        $statusCounts['failed'] = $statusCounts['failed'] + 1;
                        break;
                }
            }
        }

        return $statusCounts;
    }

    public static function getAIStatusBasedArray($id)
    {
        $data = self::getStatusBasedArray($id, '');
        $needAttention = false;
        $aicalculationStarted = false;
        $allReport = self::where(['client_id' => $id])
                        ->select([ 'gross_pay_amount',
                                            'total_taxes',
                                            'total_deductions',
                                            'net_pay_amount',
                                            DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as month_year")
                                        ])
                        ->groupBy(DB::raw("DATE_FORMAT(pay_date, '%m-%Y')"))
                        ->orderBy('pay_date', 'DESC')
                        ->get();

        foreach ($allReport as $report) {
            $calculatedNetPay = (float)Helper::priceFormt($report->gross_pay_amount, 1, 0) - ((float)Helper::priceFormt($report->total_taxes, 1, 0) + (float)Helper::priceFormt($report->total_deductions, 1, 0));
            if ((float)Helper::priceFormt($calculatedNetPay) != (float)Helper::priceFormt($report->net_pay_amount)) {
                $needAttention = true;
                break;
            }
            if ((float)Helper::priceFormt($report->gross_pay_amount, 1, 0) > 0) {
                $aicalculationStarted = true;
            }
        }
        $data['paystub_ai_started'] = $aicalculationStarted;
        $data['need_attention'] = $needAttention;
        $data['no_paystub_uploaded_yet'] = $allReport->isEmpty();

        return $data;
    }

    public static function getPaystubListingData($client_id, $account_type, $attorney_id)
    {

        $report = self::getReportsForPaystubListing($client_id, $account_type);

        $debtorAllReport = self::getAllReport($client_id, 'self');
        $codebtorAllReport = self::getAllReport($client_id, 'spouse');

        $editable = FormsStepsCompleted::select('can_edit')->where('client_id', $client_id)->first();

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_PAYROLL_ASSISTANT_VIDEO);

        $paystubType = '';
        $clientType = '';
        switch ($account_type) {
            case 'self': $paystubType = 'Debtor_Pay_Stubs';
                $clientType = 'debtor';
                break;
            case 'spouse': $paystubType = 'Co_Debtor_Pay_Stubs';
                $clientType = 'codebtor';
                break;
        }

        $paystubDocuments = self::getPaystubDocuments($client_id, $paystubType);
        $isPendingPaystub = self::checkPayStubsStatus($client_id, $account_type);
        $payStubAIStatus = self::getAIStatusBasedArray($client_id);
        $payStubApiStatus = self::getStatusBasedArray($client_id, $paystubType);
        $employerData = self::getEmployerData($client_id, $attorney_id, $clientType);

        $emp_list = Helper::validate_key_value('emp_list', $employerData, 'array');
        $employer_ids = array_column($emp_list, 'id');

        $debtorName = ProfitLoss::getName($client_id, 1);
        $codebtorName = ProfitLoss::getName($client_id, 2);

        return [
            'employer_ids' => $employer_ids,
            'payStubAIStatus' => $payStubAIStatus,
            'payStubApiStatus' => $payStubApiStatus,
            'debtorName' => $debtorName,
            'codebtorName' => $codebtorName,
            'employerData' => $employerData,
            'video' => $video,
            'reports' => $report,
            'paystubDocuments' => $paystubDocuments,
            'debtorAllReport' => $debtorAllReport,
            'codebtorAllReport' => $codebtorAllReport,
            'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0),
            'isPendingPaystub' => $isPendingPaystub
        ];
    }

    private static function getReportsForPaystubListing($client_id, $account_type)
    {
        $report = self::leftJoin('tbl_payroll_assistant_employer_to_client as e', 'tbl_pinwheel_paystub.employer_id', '=', 'e.id')
                ->where([
                    'tbl_pinwheel_paystub.client_id' => $client_id,
                    'tbl_pinwheel_paystub.pinwheel_account_type' => $account_type
                ])
                ->select(['tbl_pinwheel_paystub.*', 'e.employer_name', 'e.employer_type'])
                ->orderByRaw("
                    CASE 
                        WHEN tbl_pinwheel_paystub.employer_id IS NOT NULL THEN 0
                        ELSE 1
                    END
                ")
                ->orderByRaw("
                    CASE 
                        WHEN e.employer_type = 1 THEN 1
                        WHEN e.employer_type = 2 THEN 2
                        WHEN e.employer_type = 99 THEN 3
                        WHEN e.employer_type = 0 THEN 4
                        WHEN e.employer_type = 3 THEN 5
                        WHEN e.employer_type = 4 THEN 6
                        WHEN e.employer_type = 5 THEN 7
                        WHEN e.employer_type = 6 THEN 8
                    END
                ")
                ->orderBy('e.employer_name', 'ASC')
                ->orderBy('tbl_pinwheel_paystub.pay_date', 'DESC')
                ->get();

        return !empty($report) ? $report : [];
    }

    private static function getAllReport($client_id, $account_type)
    {
        $tillDate = date('Y-m-d', strtotime('last day of previous month'));
        $fromDate = date("Y-m-d", strtotime("-6 months", strtotime($tillDate)));

        return self::where(['pinwheel_account_type' => $account_type,'client_id' => $client_id])
            ->where('pay_date', '>=', $fromDate)
            ->where('pay_date', '<=', $tillDate)
            ->select([DB::raw('sum(gross_pay_amount) as gross_pay_amount'),DB::raw('sum(total_taxes) as total_taxes'),DB::raw('sum(total_deductions) as total_deductions'),DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as pay_period_end")])
            ->groupBy(DB::raw("DATE_FORMAT(pay_date, '%m-%Y')"))
            ->orderBy('pay_date', 'DESC')
            ->get();
    }

    private static function checkPayStubsStatus($client_id, $type = "self")
    {
        $tillDate = date('Y-m-d', strtotime('last day of previous month'));
        $fromDate = date("Y-m-d", strtotime("-6 months", strtotime($tillDate)));
        $paystub = PayStubs::where([ "client_id" => $client_id, 'pinwheel_account_type' => $type, 'is_mapped' => 0 ])
            ->where('pay_date', '>=', $fromDate)
            ->where('pay_date', '<=', $tillDate)
            ->exists();

        return $paystub ? 1 : 0;
    }

    public static function getEmployerData($client_id, $attorney_id, $client_type)
    {
        $incomeData = CacheIncome::getIncomeData($client_id);
        $debtorEmployer = Helper::validate_key_value('incomedebtoremployer', $incomeData, 'array');
        $emp_list = self::getEmployerListForPaystub($client_id, $attorney_id, $client_type);

        return ['debtorEmployer' => $debtorEmployer, 'emp_list' => $emp_list, 'client_id' => $client_id, 'client_type' => $client_type,];
    }

    public static function getPaystubDocuments($client_id, $payStubType)
    {
        $paystubDocuments = \App\Models\ClientDocumentUploaded::where([ 'client_id' => $client_id,'document_type' => $payStubType ])->select('id', 'document_file', 'updated_name')->get()->toArray();

        if (!empty($paystubDocuments)) {
            foreach ($paystubDocuments as &$data) {
                $path = Helper::validate_key_value('document_file', $data);
                $filename = basename($path);
                $updatedName = Helper::validate_key_value('updated_name', $data);
                $data['name'] = !empty($updatedName) ? $updatedName : $filename;
            }
        }

        return $paystubDocuments;
    }

    public static function getEmployerListForPaystub($client_id, $attorney_id, $client_type, $employer_id = '')
    {
        $client_type = $client_type == 'codebtor' ? 2 : 1;
        $whereConditions = [
                                "client_id" => $client_id,
                                "attorney_id" => $attorney_id,
                                "client_type" => $client_type,
                            ];

        if (!empty($employer_id)) {
            $whereConditions['id'] = $employer_id;
        }

        $query = \App\Models\AttorneyEmployerInformationToClient::where($whereConditions)->where("employer_name", "!=", null);
        $query->orderByRaw("
                                CASE 
                                    WHEN employer_type = 1 THEN 1
                                    WHEN employer_type = 2 THEN 2
                                    WHEN employer_type = 99 THEN 3
                                    WHEN employer_type = 0 THEN 4
                                END
                            ");
        $employers = $query->get();

        return !empty($employers) ? $employers->toArray() : [];
    }
}
