<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Helpers\DocumentHelper;
use App\Helpers\DateTimeHelper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;

class ClientDocuments extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_client_documents';
    public $timestamps = false;


    public static function getClientDocumentList($id, $type = null, $forApi = false)
    {
        if (!empty($type)) {
            $clientDocuments = \App\Models\ClientDocuments::orderBy('document_name', 'DESC')->where('client_id', $id)->where('type', '=', $type)->get();
        } else {
            $clientDocuments = \App\Models\ClientDocuments::orderBy('document_name', 'DESC')->where('client_id', $id)->where('type', '!=', 'life_insurance')->get();
        }
        $clientDocuments = !empty($clientDocuments) ? $clientDocuments->toArray() : [];
        $clientDocumentArray = [];

        if (!empty($clientDocuments)) {
            foreach ($clientDocuments as $val) {
                $doc_type = Helper::validate_doc_type($val['document_name']);

                if ($type == "bank") {
                    $labelText = '';
                    $accType = Helper::validate_key_value('bank_account_type', $val, 'radio');
                    if ($accType == 1) {

                        $labelText = ($forApi == false ? " <small class='absolute-tick font-weight-bold text-c-light-blue changes'>(Personal)</small>" : ' (Personal)');
                    } elseif ($accType == 2) {
                        $labelText = ($forApi == false ? " <small class='absolute-tick font-weight-bold text-c-blue changes'>(Business)</small>" : ' (Business)');
                    }
                    $clientDocumentArray[$doc_type] = $val['document_type'] . $labelText;
                } else {
                    $clientDocumentArray[$doc_type] = $val['document_type'];
                }
            }
        }

        return $clientDocumentArray;
    }

    public static function getClientBankDocumentList($id)
    {
        $clientDocuments = self::orderBy('document_name', 'DESC')->where('client_id', $id)->where('type', '=', 'bank')->select(['document_name', 'document_type', 'type', 'bank_account_type'])->get();
        $clientDocuments = !empty($clientDocuments) ? $clientDocuments->toArray() : [];

        return $clientDocuments;
    }

    public static function getClientBrokerageDocumentList($id)
    {
        $clientDocuments = self::orderBy('document_name', 'DESC')->where('client_id', $id)->where('type', '=', 'brokerage_account')->select(['document_name', 'document_type', 'type'])->get();
        $clientDocuments = !empty($clientDocuments) ? $clientDocuments->toArray() : [];

        return $clientDocuments;
    }

    public static function getClientPostSubmissionDocumentList($id)
    {
        $clientDocuments = self::orderBy('document_name', 'DESC')->where('client_id', $id)->where('type', '=', 'post_submission_doc')->select(['document_name', 'document_type', 'type'])->get();
        $clientDocuments = !empty($clientDocuments) ? $clientDocuments->toArray() : [];

        return $clientDocuments;
    }

    public static function pay_check_calculation($client_id, $client_type = null)
    {
        $attorney_id = self::getClientAttorneyId($client_id);
        $tillDate = date('Y-m-d');
        $fromDate = date("Y-m-d", strtotime("-7 months", strtotime($tillDate)));

        $debtorAllReport = \App\Models\PayStubs::where(['pinwheel_account_type' => 'self', 'client_id' => $client_id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->select([DB::raw('sum(gross_pay_amount) as gross_pay_amount'), DB::raw('sum(total_taxes) as total_taxes'), DB::raw('sum(total_deductions) as total_deductions'), DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as pay_period_end")])->groupBy(DB::raw("DATE_FORMAT(pay_date, '%m-%Y')"))->orderBy('pay_date', 'DESC')->get();
        $debtorAllReport = !empty($debtorAllReport) ? $debtorAllReport->toArray() : [];
        $debtorEmployerList = self::getEmployerList($client_id, $attorney_id, 'debtor');
        $debtorPayCheckData = self::getPayCheckData($client_id, 'self', $debtorEmployerList);

        $debtorCompleteList = \App\Models\PayStubs::where(['client_id' => $client_id, 'pinwheel_account_type' => 'self'])->get();
        $debtorCompleteList = !empty($debtorCompleteList) ? $debtorCompleteList->toArray() : [];

        $codebtorAllReport = \App\Models\PayStubs::where(['pinwheel_account_type' => 'spouse', 'client_id' => $client_id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->select([DB::raw('sum(gross_pay_amount) as gross_pay_amount'), DB::raw('sum(total_taxes) as total_taxes'), DB::raw('sum(total_deductions) as total_deductions'), DB::raw("DATE_FORMAT(pay_date, '%m-%Y') as pay_period_end")])->groupBy(DB::raw("DATE_FORMAT(pay_date, '%m-%Y')"))->orderBy('pay_date', 'DESC')->get();
        $codebtorAllReport = !empty($codebtorAllReport) ? $codebtorAllReport->toArray() : [];
        $codebtorEmployerList = self::getEmployerList($client_id, $attorney_id, 'codebtor');

        $codebtorPayCheckData = self::getPayCheckData($client_id, 'spouse', $codebtorEmployerList);
        $codebtorCompleteList = \App\Models\PayStubs::where(['client_id' => $client_id, 'pinwheel_account_type' => 'spouse'])->get();
        $codebtorCompleteList = !empty($codebtorCompleteList) ? $codebtorCompleteList->toArray() : [];

        $client = self::getClientData($client_id);

        $data = [
             'client_id' => $client_id,
             'debtorPayCheckData' => $debtorPayCheckData ?? [],
             'codebtorPayCheckData' => $codebtorPayCheckData ?? [],
             'debtorCompleteList' => $debtorCompleteList ?? [],
             'codebtorCompleteList' => $codebtorCompleteList ?? [],
             'debtorAllReport' => $debtorAllReport ?? [],
             'codebtorAllReport' => $codebtorAllReport ?? [],
             'User' => $client,
             'client_type' => $client_type
         ];

        return $data;
    }

    public static function pay_check_not_calculated_dates($client_id, $client_type)
    {

        $allData = self::pay_check_calculation($client_id, $client_type);

        $allReport = [];
        if ($client_type == 1) {
            $payCheckData = Helper::validate_key_value('debtorPayCheckData', $allData);
            $allReport = Helper::validate_key_value('debtorAllReport', $allData);
        }
        if ($client_type == 2) {
            $payCheckData = Helper::validate_key_value('codebtorPayCheckData', $allData);
            $allReport = Helper::validate_key_value('codebtorAllReport', $allData);
        }

        $hasAnyNotCalculatedDates = false;
        $hasAnyMissingDates = false;
        $requiredData = [];
        if (is_array($payCheckData) && !empty($payCheckData)) {

            foreach ($payCheckData as $index => $empData) {
                $pay_dates = Helper::validate_key_value('pay_dates', $empData);
                $notCalculatedDates = false;
                $anyMissingDates = false;
                $missingDates = [];
                if (is_array($pay_dates)) {
                    foreach ($pay_dates as $data) {
                        $pay_date = Helper::validate_key_value('pay_date', $data);
                        $payDate = date('M d, Y', strtotime($pay_date));
                        $exists = $data['exists'] ?? false;
                        if ($exists) {
                            $existsData = Helper::validate_key_value('existsData', $data);
                            $firstObj = reset($existsData);
                            $isCalculated = Helper::validate_key_value('is_calculated', $firstObj, 'radio');
                            if ($isCalculated == 0) {
                                $notCalculatedDates = true;
                            }
                        }
                        if (!$exists) {
                            $missingDates[] = $payDate;
                            $anyMissingDates = true;
                        }
                    }
                }

                $requiredData[$index]['clientFrequency'] = $empData['clientFrequency'] ?? [];
                $requiredData[$index]['emp_data'] = $empData['emp_data'] ?? [];
                $requiredData[$index]['missingDates'] = $missingDates;
                $requiredData[$index]['hasNotCalculatedDates'] = $notCalculatedDates;

                $hasAnyNotCalculatedDates = $notCalculatedDates ? true : $hasAnyNotCalculatedDates;
                $hasAnyMissingDates = $anyMissingDates ? true : $hasAnyMissingDates;
            }
        }

        return ['payCheckData' => $requiredData, 'hasAnyNotCalculatedDates' => $hasAnyNotCalculatedDates, 'hasAnyMissingDates' => $hasAnyMissingDates, 'allReport' => $allReport ];

    }

    public static function getBothEmployerList($client_id)
    {
        $attorney_id = self::getClientAttorneyId($client_id);
        $debtorEmployerList = self::getEmployerList($client_id, $attorney_id, 'debtor');
        $codebtorEmployerList = self::getEmployerList($client_id, $attorney_id, 'codebtor');

        return ['debtorEmployerList' => $debtorEmployerList, 'codebtorEmployerList' => $codebtorEmployerList];
    }

    public static function getEmployerList($client_id, $attorney_id, $client_type, $employer_id = '', $frequency = '')
    {
        $client_type = $client_type == 'codebtor' ? 2 : 1;
        $attorney_id = self::getClientAttorneyId($client_id);

        $whereConditions = [
            "client_id" => $client_id,
            "attorney_id" => $attorney_id,
            "client_type" => $client_type,
        ];

        if (!empty($employer_id)) {
            $whereConditions['id'] = $employer_id;
        }

        $employers = \App\Models\AttorneyEmployerInformationToClient::where($whereConditions)->where("employer_name", "!=", null)->orderBy('employer_type', 'ASC')->get();
        $employerList = !empty($employers) ? $employers->toArray() : [];

        // populate employer_paystub_paydate for current and additional employers (employer_type == 1 or 2)
        foreach ($employerList as $emp_index => $employer) {
            $employer_paystub_paydate = $employer['end_date'];
            $employerList[$emp_index]['employer_paystub_paydate'] = $employer_paystub_paydate;
        }

        return $employerList;
    }

    /**
     * Get a list of paycheck dates for a client
     *
     * @param mixed $client_id
     * @param mixed $accountType
     * @param mixed $employerList
     * @param mixed $defaultFrequency
     *
     * @return array array of employers and date objects (paydates)
     */
    public static function getPayCheckData($client_id, $accountType, $employerList)
    {
        $payCheckData = [];
        $employerIds = array_column($employerList, 'id');

        // Fetch all pay stubs once
        $paystubList = \App\Models\PayStubs::where([
                'client_id' => $client_id,
                'pinwheel_account_type' => $accountType,
            ])
            ->whereIn('employer_id', $employerIds)
            ->orderBy('pay_date', 'DESC')
            ->get();

        foreach ($employerList as $employer) {
            $employer_id = $employer['id'];
            $frequency = $employer['frequency'];
            $tMS = Helper::validate_key_value('twice_month_selection', $employer, 'radio'); // date schedult 1-15 or 15-last day of that month

            [$startDate, $endDate] = self::calcStartAndEndDate($employer, $frequency);

            // Determine pay dates based on frequency
            $payDates = [];
            switch ($frequency) {
                case 1: // Weekly
                    $payDates = self::getPayDatesByWeeks(1, $startDate, $endDate);
                    break;
                case 2: // Bi-Weekly
                    $payDates = self::getPayDatesByWeeks(2, $startDate, $endDate);
                    break;
                case 3: // Twice a month
                    $payDates = self::getTwiceAMonthPayDates(
                        $startDate,
                        $endDate,
                        $tMS
                    );
                    break;
                case 4: // Monthly
                    $payDates = self::getMonthlyPayDates($startDate, $endDate);
                    break;
            }

            // Filter dates based on employer start/end dates
            $emp_start_date = Helper::validate_key_value('start_date', $employer);
            $start_date_parsed = !empty($emp_start_date) ? Carbon::createFromFormat('m/d/Y', $emp_start_date) : null;
            if ($start_date_parsed) {
                $payDates = self::removeOlderThanStartDate($payDates, $start_date_parsed);
            }

            $emp_end_date = Helper::validate_key_value('end_date', $employer);
            if (!empty($emp_end_date)) {
                try {
                    $end_date_parsed = Carbon::createFromFormat('m/d/Y', $emp_end_date);
                } catch (\Exception $e) {
                    try {
                        $end_date_parsed = Carbon::parse($emp_end_date);
                    } catch (\Exception $e) {
                        $end_date_parsed = null;
                    }
                }
            } else {
                $end_date_parsed = null;
            }
            if ($employer['employer_type'] == 2 && $end_date_parsed) {
                $payDates = self::removeLaterThanEndDate($payDates, $end_date_parsed);
            }

            if (is_array($payDates) && !empty($payDates)) {
                $startDate = $startDate !== null ? min(min($payDates), $startDate) : min($payDates);
            }
            $employerPayStubs = $paystubList->filter(function ($stub) use ($employer_id, $startDate, $endDate) {
                return $stub['employer_id'] == $employer_id &&
                        Carbon::parse($stub['pay_date'])->between(Carbon::parse($startDate), Carbon::parse($endDate));
            });
            // Prepare the response data
            $data = [
                'clientFrequency' => Helper::getPayFrequencyLabel($frequency),
                'emp_data' => $employer,
                'pay_dates' => [],
                'pay_dates_list' => $employerPayStubs->values()->toArray(),
                'overrideCount' => $employerPayStubs->whereNotNull('override_date')
                                    ->whereIn('override_date', $payDates)
                                    ->count() ?? 0,
            ];
            foreach ($payDates as $payDate) {
                $existsData = [];
                $existsData = $employerPayStubs->where('pay_date', $payDate);

                $exists = $existsData->isNotEmpty();
                // \Log::info("Data=for date for type ".$accountType.'fpr date'.$payDate.' = '.$exists. json_encode($employerIds,1));
                // Only add to response if it doesn't exist or you specifically want to show empty stubs
                $data['pay_dates'][] = [
                    'pay_date' => $payDate,
                    'display_date' => date('M d, Y', strtotime($payDate)),
                    'exists' => $exists,
                    'existsData' => $exists ? $existsData->toArray() : []
                ];
            }

            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate ;
            $payCheckData[] = $data;
        }

        return $payCheckData;
    }

    /**
     * Calculate CMI start and end dates
     *
     * @param mixed $employer
     * @param mixed $frequency
     * @return array of 2 date objects (start and end dates)
     */
    private static function calcStartAndEndDate(
        $employer,
        $frequency
    ) {

        $today = Carbon::now()->startOfDay();
        $numDaysFrequency = $frequency * 7; // for by weeks calculations

        $endDate = $today->copy()->startOfDay();

        # get the last paystub date to calculate paydates based on frequency
        $emp_end_date = Helper::validate_key_value('end_date', $employer);
        $paystubPaydateStr = Helper::validate_key_value('employer_paystub_paydate', $employer);

        $paystubPaydate = null;
        if ($paystubPaydateStr) {
            try {
                $paystubPaydate = Carbon::createFromFormat('m/d/Y', $paystubPaydateStr);
            } catch (\Exception $e) {
                try {
                    $paystubPaydate = Carbon::parse($paystubPaydateStr);
                } catch (\Exception $e) {
                    $paystubPaydate = null;
                }
            }
            if ($paystubPaydate) {
                $paystubPaydate = $paystubPaydate->startOfDay();
            }
        }
        // set end date to be the end date of employer if no last paystub paydate was entered
        elseif (!$paystubPaydateStr && !empty($emp_end_date)) {
            $paystubPaydate = !empty($emp_end_date) ? Carbon::createFromFormat('m/d/Y', $emp_end_date) : $endDate;
            $paystubPaydate = $paystubPaydate->startOfDay();

        }


        $endDate = !empty($paystubPaydate) ? $paystubPaydate->copy() : $endDate;

        if ($paystubPaydate) {
            // the endDate should be the latest paydate, based on the entered paystubPaydate,
            // that is less than or equal to today's date
            $endDate = $paystubPaydate->startOfDay();
            $newEndDate = $endDate->copy()->startOfDay();

            $index = 0;
            $max_iterations = 100;
            while ($newEndDate <= $today && $index < $max_iterations) {
                switch ($frequency) {
                    case 1: // Weekly
                    case 2: // Every 2 weeks
                        $newEndDate = $newEndDate->addDays($numDaysFrequency);
                        break;
                    case 3: // Twice a month
                        $newEndDate = $newEndDate->addDays(15);
                        break;
                    case 4: // Monthly
                        $originalDay = $endDate->day;
                        $lastDayOfMonth = $endDate->copy()->endOfMonth()->startOfDay();
                        $isLastDayOfMonth = $endDate == $lastDayOfMonth;

                        $newEndDate = $newEndDate->addMonthsNoOverflow(1);

                        if ($isLastDayOfMonth) {
                            $newEndDate = $newEndDate->endOfMonth()->startOfDay();
                        } elseif ($newEndDate->month == 1) {
                            // special cases for february overflow, revert back to original date after feb overflow
                            $newEndDate->day = $originalDay;
                        }

                        break;
                }

                if ($newEndDate <= $today) {
                    $endDate = $newEndDate->copy();
                }
                $index++;
            }
        }

        /*
         get the CMI date range:

         The current monthly income (CMI) is the average income from all sources
         in the six months prior to filing for bankruptcy.
        */

        $endOfLastMonth = $today->copy()->startOfMonth()->subDays(1)->startOfDay();
        $startDate = $endOfLastMonth->startOfMonth()->subMonths(5)->startOfDay();
        // update start date to include one more paystub beyond the CMI months (6 CMI_MONTHS)
        switch ($frequency) {
            case 1: // Weekly
            case 2: // Every 2 weeks
                $startDate = $startDate->subDays($numDaysFrequency);
                break;
            case 3: // Twice a month
                $startDate = $startDate->subDays(15);
                break;
            case 4: // Monthly
                $originalDay = $endDate->day;
                $lastDayOfMonth = $endDate->copy()->endOfMonth()->startOfDay();
                $isLastDayOfMonth = $endDate == $lastDayOfMonth;

                $startDate = $startDate->subMonthNoOverflow();

                if ($isLastDayOfMonth) {
                    $startDate = $startDate->endOfMonth()->startOfDay();
                }
                break;
        }

        return [$startDate, $endDate];
    }

    private static function removeLaterThanEndDate($dates, $endDate)
    {
        $filteredDates = array_filter($dates, function ($date) use ($endDate) {
            return $date <= $endDate;
        });
        $filteredDates = array_values($filteredDates);

        return $filteredDates;
    }

    private static function removeOlderThanStartDate($dates, $startDate)
    {
        $startDateTime = new \DateTime($startDate);
        $startDateTime->setTime(0, 0, 0); // Set time to 00:00:00
        $startDate = $startDateTime->format('Y-m-d');
        $filteredDates = array_filter($dates, function ($date) use ($startDate) {
            return $date >= $startDate;
        });
        $filteredDates = array_values($filteredDates);

        return $filteredDates;
    }

    private static function getPayDatesByWeeks(
        $numWeeks,
        $startDate,
        $endDate
    ) {
        $dates = [];
        $numDaysFrequency = $numWeeks * 7;

        $index = 1;
        $MAX_DATE_ENTRIES = 100;

        $newStartDate = $endDate->copy();
        while ($newStartDate->greaterThanOrEqualTo($startDate) && $index < $MAX_DATE_ENTRIES) {
            $dates[] = $newStartDate->toDateString();
            $newStartDate->subDays($numDaysFrequency);
            $index++;
        }

        $reversed = array_reverse($dates);

        return $reversed;
    }

    private static function getTwiceAMonthPayDates($startDate, $endDate, $tMS)
    {
        $dates = [];
        $currentDate = $startDate->copy()->startOfMonth();

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            if ($tMS == 0) {
                // 1st and 15th
                $firstDay = $currentDate->copy()->setDay(1);
                $fifteenthDay = $currentDate->copy()->setDay(15);

                $dates[] = $firstDay->toDateString();
                $dates[] = $fifteenthDay->toDateString();

            } elseif ($tMS == 1) {
                // 15th and last day
                $fifteenthDay = $currentDate->copy()->setDay(15);
                $lastDay = $currentDate->copy()->endOfMonth();

                $dates[] = $fifteenthDay->toDateString();
                $dates[] = $lastDay->toDateString();
            }

            $currentDate->addMonth();
        }

        // remove any dates outside of the given range
        $dates = array_filter($dates, function ($date) use ($startDate, $endDate) {
            return $date >= $startDate->toDateString() && $date <= $endDate->toDateString();
        });

        return array_values(array_unique($dates));
    }


    private static function getMonthlyPayDates(
        $startDate,
        $endDate
    ) {
        $dates = [];
        $isLastDayOfMonth = false;

        $lastDayOfMonth = $endDate->copy()->endOfMonth()->startOfDay();
        $isLastDayOfMonth = $endDate == $lastDayOfMonth;

        $originalDay = $endDate->day;

        $index = 1;
        $MAX_DATE_ENTRIES = 12;

        $newStartDate = $endDate->copy();
        while ($newStartDate->greaterThanOrEqualTo($startDate) && $index <= $MAX_DATE_ENTRIES) {
            $dates[] = $newStartDate->toDateString();

            $newStartDate = $newStartDate->copy()->subMonthNoOverflow();

            if ($isLastDayOfMonth) {
                $newStartDate = $newStartDate->copy()->endOfMonth()->startOfDay();
            } elseif ($newStartDate->month == 1) {
                // special cases for february overflow, revert back to original date after feb overflow
                $newStartDate->day = $originalDay;
            }

            $index++;
        }

        $reversed = array_reverse($dates);

        return $reversed;
    }

    public static function getPayStubs($client_id, $accountType, $employer_id, $startDate, $endDate)
    {
        return \App\Models\PayStubs::where([
            'client_id' => $client_id,
            'employer_id' => $employer_id,
            'pinwheel_account_type' => $accountType
        ])->whereBetween('pay_date', [$startDate, $endDate])
            ->get();
    }

    public static function getClientAttorneyId($client_id)
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        return $attorney_id;
    }

    protected static function getClientData($client_id)
    {
        return \App\Models\User::with(['ClientsAttorneybyclient', 'ClientsAttorneybyattorney', 'ClientsAttorneybyclient.getuserattorney'])->select('id', 'user_status', 'name', 'created_at', 'client_type', 'client_payroll_assistant', 'client_subscription', 'document_email_notification', 'document_pushed_notification', 'argyle_invalid_credential_self', 'argyle_invalid_credential_spouse', 'client_bank_statements', 'client_profit_loss_assistant', 'detailed_property')->where('id', $client_id)->first();
    }


    public static function getClientDocs($id, $type = null)
    {
        $clientDocuments = [];
        $clientDocuments = \App\Models\ClientDocuments::orderBy('document_name', 'DESC')->where('client_id', $id)->get();
        $clientDocuments = !empty($clientDocuments) ? $clientDocuments->toArray() : [];
        $clientDocumentArray = [];
        if (!empty($clientDocuments)) {
            foreach ($clientDocuments as $val) {
                $doc_type = Helper::validate_doc_type($val['document_name']);
                $clientDocumentArray[$val['type']][$doc_type] = $val['document_type'];
            }
        }
        if (!empty($type)) {
            return $clientDocumentArray[$type] ?? [];
        }

        return $clientDocumentArray;
    }

    public static function getAdminRequestedDocumentList($adminDocuments, $clientBankDocs)
    {
        $lifeInsuDocs = $clientBankDocs['life_insurance'] ?? [];
        if (!empty($lifeInsuDocs)) {
            $adminDocuments = array_merge($adminDocuments, $lifeInsuDocs);
        }

        return !empty($adminDocuments) ? array_keys($adminDocuments) : [];

    }

    public static function getAllBankDocumentKeysList($id)
    {
        if (empty($id)) {
            return [];
        }
        $bankArray = \App\Models\ClientDocuments::getClientDocumentList($id, 'bank');
        $bankArray = !empty($bankArray) ? array_keys($bankArray) : [] ;
        $VPCArray = \App\Models\ClientDocuments::getClientDocumentList($id, 'venmo_paypal_cash');
        $VPCArray = !empty($VPCArray) ? array_keys($VPCArray) : [] ;
        $combinedArray = array_merge($bankArray, $VPCArray);

        return $combinedArray;
    }

    public static function getClientUploadedDocArray($client, $client_id, $client_attorney_id, $realObject = false)
    {
        $documents = [];
        $documentTypes = Helper::getDocuments($client->client_type, false, 1, 1, 0, 0, $client_attorney_id);
        $documentTypes = $documentTypes + Helper::getMiscDocs();
        if ($documentTypes) {
            unset($documentTypes['Current_Auto_Loan_Statement']);
            unset($documentTypes['Current_Mortgage_Statement']);
        }
        if (!isset($documentTypes['Co_Debtor_Drivers_License'])) {
            $documentTypes['Co_Debtor_Drivers_License'] = "Co-Debtor’s Drivers Lic./Gov. ID";
        }
        if (!isset($documentTypes['Co_Debtor_Social_Security_Card'])) {
            $documentTypes['Co_Debtor_Social_Security_Card'] = "Co-Debtor’s Social Security Card/ITIN";
        }
        $documentTypes = self::addAttorneyDocumentTolist($documentTypes, $client_attorney_id);
        $documentTypes = self::addClientDocumentToList($documentTypes, $client_id);
        $documentTypes = self::addAdminRequestedDocumentToList($documentTypes, $client_id);
        $ValiddocumentTypes = array_keys($documentTypes);
        $allDocumentsQuery = \App\Models\ClientDocumentUploaded::where([
            'client_id' => $client_id,
            'is_uploaded_to_s3' => 1
        ]);

        if ($realObject === true) {
            // If $realObject is true, retrieve all documents.
            $allDocuments = $allDocumentsQuery->get();
        } else {
            // If $realObject is not true, filter by valid document types.
            $allDocuments = $allDocumentsQuery->whereIn('document_type', $ValiddocumentTypes)->get();
        }


        $allDocuments = !empty($allDocuments) ? $allDocuments->toArray() : [];

        $clientPropertyData = CacheProperty::getPropertyData($client_id);
        $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

        $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, true);
        $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];

        $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($client_id, true);
        $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];

        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        if ($client->client_type == 2) {
            $spousename = "Non-Filing Spouse";
        }
        $singleDocType = [ 'Drivers_License', 'Co_Debtor_Drivers_License', 'Social_Security_Card', 'Co_Debtor_Social_Security_Card' ];
        foreach ($allDocuments as $data) {
            $type = Helper::validate_key_value('document_type', $data);

            $updatedName = rtrim(Helper::validate_key_value('updated_name', $data), '.');
            $typeName = isset($documentTypes[$type]) ? $documentTypes[$type] : $type;
            $title = $typeName;
            if (!empty($type) && !in_array($type, $singleDocType)) {
                $title = $typeName.' '.$updatedName;
            }
            $description = !empty($updatedName) ? $updatedName : $typeName;
            $downloadPath = route('doc_download', ['id' => $data['id']]);
            $title = isset($mortgageUpdatedNames[$type]) ? $mortgageUpdatedNames[$type] : $title;
            $title = isset($vehicleUpdatedNames[$type]) ? $vehicleUpdatedNames[$type] : $title;
            if (in_array($data['document_type'], ['paypal_account_1','paypal_account_2','paypal_account_3'])) {
                $description = $description.' Paypal';
            }
            if (in_array($data['document_type'], ['cash_account_1','cash_account_2','cash_account_3'])) {
                $description = $description.' Cash';
            }
            if (in_array($data['document_type'], ['venmo_account_1','venmo_account_2','venmo_account_3'])) {
                $description = $description.' Venmo';
            }
            $title = \App\Helpers\ClientHelper::getUpdatedLabelNameForJubliee($debtorname, $spousename, $type, $title);
            if ($realObject == false) {
                $object = [
                    "Title" => $title,
                    "Description" => $description,
                    "DownloadPath" => stripslashes($downloadPath),
                ];

                if (is_array($documents)) {
                    array_push($documents, $object);
                }
            }

            if ($realObject == true) {
                $realObject = [
                    "title" => $title,
                    "download_path" => stripslashes($downloadPath),
                    "document_id" => $data['id'],
                    "document_type" => $data['document_type']  // to identify which document type is being downloaded.
                ];
                if (is_array($documents)) {
                    $documents[$data['document_type']] = $realObject;
                }
            }
        }

        return $documents;
    }

    private static function addAttorneyDocumentTolist($documentTypes, $attorney_id)
    {
        $attorneyDocuments = self::getAttorneyDocumentTypes($attorney_id);
        $attorneyDocumentArray = [];
        if (!empty($attorneyDocuments)) {
            foreach ($attorneyDocuments as $val) {
                $doc_type = Helper::validate_doc_type($val);
                $attorneyDocumentArray[$doc_type] = $val;
            }
        }

        return !empty($attorneyDocuments) ? $documentTypes + $attorneyDocumentArray : $documentTypes;
    }

    private static function getAttorneyDocumentTypes($attorneyId)
    {
        $attorneyDocuments = \App\Models\AttorneyDocuments::orderBy('id', 'DESC')->where(['attorney_id' => $attorneyId , 'is_associate' => 0])->get();
        $attorneyDocuments = !empty($attorneyDocuments) ? $attorneyDocuments->toArray() : [];

        return  array_column($attorneyDocuments, 'document_name');
    }

    private static function addClientDocumentToList($documentList, $id)
    {
        $clientDocumentArray = \App\Models\ClientDocuments::getClientDocumentList($id);
        $bankstatement = [
            'bank_statements' => 'Bank Statements'
         ];

        return !empty($clientDocumentArray) ? $documentList + $bankstatement + $clientDocumentArray : $documentList;
    }

    private static function addAdminRequestedDocumentToList($documentList, $id)
    {
        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $id)->pluck('document_name', 'document_type')->all();
        $bankstatement = [
            'requested_documents' => 'Requested Documents'
        ];

        return !empty($adminDocuments) ? $documentList + $bankstatement + $adminDocuments : $documentList;
    }
    public static function bankDocsBussinessKeys($client_id)
    {
        $list = \App\Models\ClientDocuments::where([
                    'client_id' => $client_id,
                    'type' => 'bank',
                    'bank_account_type' => 2
                ])
                ->orderBy('document_name', 'DESC')
                ->pluck('document_name');
        $list = !empty($list) ? $list->toArray() : [] ;

        return $list;
    }


    public static function getAvailableStatementMonths($clientId, $documentType, $bankStatementMonths = null, $addCurrentMonthToDate = false)
    {
        // Get attorney or associate ID
        $ClientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $attorney_id = $ClientsAssociateId ?: self::getClientAttorneyId($clientId);
        $is_associate = $ClientsAssociateId ? 1 : 0;

        $brokerage_months = null; // Default as 1 for most recent month
        $attorneySettings = \App\Models\AttorneySettings::where([
                'attorney_id' => $attorney_id,
                'is_associate' => $is_associate
            ])->select(['bank_statement_months', 'brokerage_months'])->first();

        // Fallback: Get from Attorney Settings if not passed
        if (empty($bankStatementMonths)) {

            $bankStatementMonths = $attorneySettings ? (int) Helper::validate_key_value('bank_statement_months', $attorneySettings) : 0;
        }
        $brokerageDocTypes = ClientDocuments::getClientDocs($clientId, 'brokerage_account');
        if (array_key_exists($documentType, $brokerageDocTypes)) {
            $addCurrentMonthToDate = false;
            $brokerage_months = !empty($attorneySettings) ? (int) Helper::validate_key_value('brokerage_months', $attorneySettings) : 1;
        }
        $profitLossMonth = AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

        // Get bank documents
        $bankDocuments = self::getClientBankDocumentList($clientId);

        $statementMonthCount = $bankStatementMonths;

        foreach ($bankDocuments as $document) {
            if ($document['document_name'] === $documentType) {
                $statementMonthCount = ($document['bank_account_type'] == 2) ? $profitLossMonth : $bankStatementMonths;
                break;
            }
        }

        // Prepare month list
        $statementMonths = is_array($statementMonthCount) ? $statementMonthCount : DateTimeHelper::getBankStatementMonthArray($statementMonthCount, null, $addCurrentMonthToDate, $brokerage_months);
        $statementMonths = is_array($statementMonths) ? $statementMonths : [];
        // Get uploaded docs for the given type
        $uploadedDocs = \App\Models\ClientDocumentUploaded::where([
            'client_id' => $clientId,
            'document_type' => $documentType,
        ])->select(['document_status', 'document_month'])->get()->toArray();

        $finalArray = $statementMonths;
        $additionalMonths = [];

        foreach ($uploadedDocs as $uploadedDoc) {
            $docMonth = Helper::validate_key_value('document_month', $uploadedDoc);
            $docStatus = Helper::validate_key_value('document_status', $uploadedDoc, 'radio');

            if ($docStatus == 2) {
                $additionalMonths[$docMonth] = $statementMonths[$docMonth] ?? null;
            } else {
                unset($finalArray[$docMonth]);
            }
        }

        // Merge and clean
        $finalArray = array_merge($additionalMonths, $finalArray);
        $finalArray = array_filter($finalArray); // remove nulls
        $finalArray = array_unique($finalArray);

        // Temporarily store and remove the "" => "Current Month Stmt" entry
        $currentMonthStmt = [];
        if (isset($finalArray[""])) {
            $currentMonthStmt[""] = $finalArray[""];
            unset($finalArray[""]);
        }

        // Sort descending
        uksort($finalArray, function ($a, $b) {
            $dateA = \DateTime::createFromFormat('m-Y', $a) ?: new \DateTime('01-1970');
            $dateB = \DateTime::createFromFormat('m-Y', $b) ?: new \DateTime('01-1970');

            return $dateB <=> $dateA;
        });

        // Merge the preserved top entry back in
        $finalArray = $currentMonthStmt + $finalArray;

        return $finalArray;
    }

}
