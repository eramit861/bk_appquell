<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Models\ClientDocumentUploaded;
use App\Models\DeductionList;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Helpers\DocumentHelper;
use ZipArchive;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\ArrayHelper;
use App\Models\ClientDocuments;
use App\Models\PayStubs;
use App\Services\Client\CacheIncome;

class AttorneyPaystubController extends AttorneyController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function client_paystub($id, $type)
    {
        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }

        $attorney_id = $this->getClientAttorneyId($id);
        $listingData = Paystubs::getPaystubListingData($id, 'self', $attorney_id);

        $client = $this->getClientData($id);
        $total = $this->getClientCompletedStepsCount($id);

        $listingData['User'] = $client;
        $listingData['totals'] = $total;
        $listingData['type'] = 'paystub';

        return view('attorney.client.paystub', $listingData);
    }

    public function client_paystub_partner($id, $type)
    {
        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }

        $attorney_id = $this->getClientAttorneyId($id);
        $listingData = Paystubs::getPaystubListingData($id, 'spouse', $attorney_id);

        $client = $this->getClientData($id);
        $total = $this->getClientCompletedStepsCount($id);

        $listingData['User'] = $client;
        $listingData['totals'] = $total;
        $listingData['type'] = 'paystub_partner';

        return view('attorney.client.paystub', $listingData);
    }

    public function show_paystub_calculation(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $type = $input['u_type'] ?? '';
            $client_id = $input['client_id'];
            if (in_array($type, ['self', 'spouse'])) {
                //$to = date('Y-m-d', strtotime("-6 month"));
                $tillDate = date('Y-m-d', strtotime('last day of previous month'));
                $fromDate = date("Y-m-d", strtotime("-6 months", strtotime($tillDate)));
                $paystubs = PayStubs::where(['pinwheel_account_type' => $type, 'client_id' => $client_id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->get();
                $paystubs = !empty($paystubs) ? $paystubs->toArray() : [];
                if (empty($paystubs)) {
                    return false;
                }

                $paystubmonths = PayStubs::where(['pinwheel_account_type' => $type, 'client_id' => $client_id])->where('pay_date', '>=', $fromDate)->where('pay_date', '<=', $tillDate)->select(DB::raw('count(id) as countmonths'))->groupBy(DB::raw("(DATE_FORMAT(pay_date, '%m-%Y'))"))->get();
                $monthsCount = $paystubmonths->count();

                $breakdowns = [];
                foreach ($paystubs as $paystub) {
                    unset($paystub['file_content']);

                    $deductions = [];
                    $deductions = json_decode($paystub['deductions'], 1);
                    if (!empty($deductions)) {
                        foreach ($deductions as $deduction) {
                            if (is_numeric($deduction['amount']) && $deduction['amount'] > 0) {
                                $breakdowns[$deduction['name']][] = ['price' => $deduction['amount']];
                            }
                        }
                    }

                }
                $data = [];
                foreach ($breakdowns as $key => $ar) {
                    $total = 0;
                    $total = array_sum(array_column($ar, 'price'));
                    $data[$key] = $total > 0 ? number_format((float)($total / $monthsCount), 2, '.', '') : 0;
                }

                if (empty($data)) {
                    PayStubs::where(['pinwheel_account_type' => $type,'client_id' => $client_id])->update(['is_mapped' => 1]);

                    return response()->json(Helper::renderJsonSuccess('Payroll data sucessfully saved into client questionnaire.'))->header('Content-Type: application/json;', 'charset=utf-8');
                }
                if ($type == 'self') {
                    $submitRouteUrl = route('pinwheel_calculation_setup_attorney_side');

                    return view('client.pinwheel_calculation_form', ['client_id' => $client_id, 'type' => $type,'data' => $data, 'submitRouteUrl' => $submitRouteUrl]);
                }
                if ($type == 'spouse') {
                    $submitRouteUrl = route('spouse_setup_paystub_calculation_attorney_side');

                    return view('client.pinwheel_spouse_calculation_form', ['client_id' => $client_id, 'type' => $type,'data' => $data, 'submitRouteUrl' => $submitRouteUrl]);
                }
            }


        }
    }

    public function pinwheel_calculation_setup_attorney_side(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $items = $input['items'];
            $client_id = $input['client_id'] ?? '';
            $deducations = json_decode($items, 1);
            $otherDeducation = [];
            $normalDeducation = [];
            $life_insurance_for_jubliee = 0;
            $disablity_insurance_for_jubliee = 0;
            foreach ($deducations as $deduction) {
                if ($deduction['key'] == 'other_deduction') {
                    array_push($otherDeducation, $deduction);
                    $disablity_insurance_for_jubliee = $disablity_insurance_for_jubliee + $deduction['value'];
                } else {
                    $normalDeducation[$deduction['key']][] = $deduction['value'];
                }
                if ($deduction['key'] == 'automatically_deduction_insurance') {
                    $life_insurance_for_jubliee = $life_insurance_for_jubliee + $deduction['value'];
                }
            }
            $post = [
                "client_id" => $client_id,
                'paycheck_mandatory_contribution' => isset($normalDeducation["paycheck_mandatory_contribution"]) ? array_sum($normalDeducation["paycheck_mandatory_contribution"]) : '',
                'paycheck_voluntary_contribution' => isset($normalDeducation["paycheck_voluntary_contribution"]) ? array_sum($normalDeducation["paycheck_voluntary_contribution"]) : '',
                'paycheck_required_repayment' => isset($normalDeducation["paycheck_required_repayment"]) ? array_sum($normalDeducation["paycheck_required_repayment"]) : '',
                'automatically_deduction_insurance' => isset($normalDeducation["automatically_deduction_insurance"]) ? array_sum($normalDeducation["automatically_deduction_insurance"]) : '',
                'domestic_support_obligations' => isset($normalDeducation["domestic_support_obligations"]) ? array_sum($normalDeducation["domestic_support_obligations"]) : '',
                'union_dues_deducted' => isset($normalDeducation["union_dues_deducted"]) ? array_sum($normalDeducation["union_dues_deducted"]) : '',
            ];
            foreach ($post as $key => $po) {
                if (empty($po)) {
                    unset($post[$key]);
                }
            }
            $otherDedLabel = [];
            $otherDedPrice = [];
            $otherDedType = [];
            foreach ($otherDeducation as $other) {
                array_push($otherDedType, 16);
                array_push($otherDedLabel, $other['name']);
                array_push($otherDedPrice, $other['value']);
            }
            if (!empty($otherDedLabel)) {
                $post['other_deduction_type'] = json_encode($otherDedType);
                $post['other_deduction'] = json_encode($otherDedPrice);
                $post['other_deduction_specify'] = json_encode($otherDedLabel);
                $post['otherDeductions11'] = 1;
            }

            $post['life_insurance_for_jubliee'] = isset($life_insurance_for_jubliee) ? $life_insurance_for_jubliee : '';
            $post['disablity_insurance_for_jubliee'] = isset($disablity_insurance_for_jubliee) ? $disablity_insurance_for_jubliee : '';

            $client = \App\Models\User::where('id', '=', $client_id)->first();
            $client->incomeDebtorMonthlyIncome()->updateOrCreate(['client_id' => $client_id], $post);

            CacheIncome::forgetIncomeCache($client_id);

            PayStubs::where(['pinwheel_account_type' => 'self','client_id' => $client_id])->update(['is_mapped' => 1]);

            return response()->json(Helper::renderJsonSuccess('Saved sucessfully'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function spouse_setup_paystub_calculation_attorney_side(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $items = $input['items'];
            $client_id = $input['client_id'] ?? '';
            $deducations = json_decode($items, 1);
            $otherDeducation = [];
            $normalDeducation = [];
            $life_insurance_for_jubliee = 0;
            $disablity_insurance_for_jubliee = 0;
            foreach ($deducations as $deduction) {
                if ($deduction['key'] == 'other_deduction') {
                    array_push($otherDeducation, $deduction);
                    $disablity_insurance_for_jubliee = $disablity_insurance_for_jubliee + $deduction['value'];
                } else {
                    $normalDeducation[$deduction['key']][] = $deduction['value'];
                }
                if ($deduction['key'] == 'automatically_deduction_insurance') {
                    $life_insurance_for_jubliee = $life_insurance_for_jubliee + $deduction['value'];
                }
            }
            $post = [
                "client_id" => $client_id,
                'joints_paycheck_mandatory_contribution' => isset($normalDeducation["joints_paycheck_mandatory_contribution"]) ? array_sum($normalDeducation["joints_paycheck_mandatory_contribution"]) : '',
                'joints_paycheck_voluntary_contribution' => isset($normalDeducation["joints_paycheck_voluntary_contribution"]) ? array_sum($normalDeducation["joints_paycheck_voluntary_contribution"]) : '',
                'joints_paycheck_required_repayment' => isset($normalDeducation["joints_paycheck_required_repayment"]) ? array_sum($normalDeducation["joints_paycheck_required_repayment"]) : '',
                'joints_automatically_deduction_insurance' => isset($normalDeducation["joints_automatically_deduction_insurance"]) ? array_sum($normalDeducation["joints_automatically_deduction_insurance"]) : '',
                'joints_domestic_support_obligations' => isset($normalDeducation["joints_domestic_support_obligations"]) ? array_sum($normalDeducation["joints_domestic_support_obligations"]) : '',
                'joints_union_dues_deducted' => isset($normalDeducation["joints_union_dues_deducted"]) ? array_sum($normalDeducation["joints_union_dues_deducted"]) : '',
            ];
            foreach ($post as $key => $po) {
                if (empty($po)) {
                    unset($post[$key]);
                }
            }
            $otherDedType = [];
            $otherDedLabel = [];
            $otherDedPrice = [];
            foreach ($otherDeducation as $other) {
                array_push($otherDedType, 16);
                array_push($otherDedLabel, $other['name']);
                array_push($otherDedPrice, $other['value']);
            }
            if (!empty($otherDedLabel)) {
                $post['joints_other_deduction_type'] = json_encode($otherDedType);
                $post['joints_other_deduction'] = json_encode($otherDedPrice);
                $post['other_deduction_specify'] = json_encode($otherDedLabel);
                $post['otherDeductions22'] = 1;
            }

            $post['life_insurance_for_jubliee'] = isset($life_insurance_for_jubliee) ? $life_insurance_for_jubliee : '';
            $post['disablity_insurance_for_jubliee'] = isset($disablity_insurance_for_jubliee) ? $disablity_insurance_for_jubliee : '';

            $client = \App\Models\User::where('id', '=', $client_id)->first();
            $client->incomeDebtorSpouseMonthlyIncome()->updateOrCreate(["client_id" => $client_id], $post);
            CacheIncome::forgetIncomeCache($client_id);
            PayStubs::where(['pinwheel_account_type' => 'spouse','client_id' => $client_id])->update(['is_mapped' => 1]);

            return response()->json(Helper::renderJsonSuccess('Saved sucessfully'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function transfer_paystub_to_spouse($clientId, $paystubType)
    {
        try {
            \App\Models\User::where('id', $clientId)->update(['client_payroll_assistant' => 3]);

            $checkfor = 'self';
            $accType = 'self';
            $route = 'client_paystub';
            $successMessage = "Income transferred to Debtor's account successfully.";

            if ($paystubType == 'paystub') {
                $checkfor = 'self';
                $accType = 'spouse';
                $route = 'client_paystub';
                $successMessage = "Income transferred to Co-Debtor's account successfully.";
            } elseif ($paystubType == 'paystub_partner') {
                $checkfor = 'spouse';
                $accType = 'self';
                $route = 'client_paystub_partner';
                $successMessage = "Income transferred to Debtor's account successfully.";
            }

            PayStubs::where(['pinwheel_account_type' => $checkfor, 'client_id' => $clientId])
                ->update(['pinwheel_account_type' => $accType]);

            \App\Models\AttorneyEmployerInformationToClient::where('client_id', $clientId)
                ->update(['client_type' => 2]);

            return redirect()->route($route, ['id' => $clientId, 'type' => 'paystub'])->with('success', $successMessage);
        } catch (\Throwable $th) {
            return redirect()->route('client_paystub', ['id' => $clientId, 'type' => 'paystub'])->with('error', 'Something went wrong.');
        }
    }


    public function client_paystub_delete(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $paystub_id = $input['paystub_id'];

            if ($paystub_id) {
                PayStubs::where('id', $paystub_id)->delete();

                return response()->json(Helper::renderJsonSuccess('Paystub Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }
    }


    public function paystub_zip_download($client_id, $type)
    {
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $client = $this->getClientData($client_id);

        $dtype = 'Debtor_Pay_Stubs';
        if ($type == "paystub_partner") {
            $dtype = 'Co_Debtor_Pay_Stubs';
        }
        $documentList = \App\Models\ClientDocumentUploaded::where('client_id', $client_id)->where('document_type', $dtype)->get();
        $documentList = !empty($documentList) ? $documentList->toArray() : [];
        if (empty($documentList)) {
            return redirect()->back()->with('error', 'Client has not uploaded any documents yet');
        }

        $fileName = public_path() . "/documents/" . $client_id. '/'.$dtype.'.zip';

        $zip = new ZipArchive();
        foreach ($documentList as $key => $doc) {
            if (file_exists(public_path().'/'.$doc['document_file'])) {
                $paths = '';
                $relativeName = basename($doc['document_file']);

                $files[] = ['key' => $relativeName,'path' => public_path().'/'.$doc['document_file']];
            }
        }

        if (empty($files)) {
            return redirect()->route('attorney_client_uploaded_documents', ['id' => $client_id])->with('error', 'Client has not uploaded any documents yet.');
        }

        if ($zip->open($fileName, ZipArchive::CREATE) === true) {
            foreach ($files as $value) {

                $zip->addFile($value['path'], $value['key']);
            }
            $zip->close();
        }
        DocumentHelper::generateZipFile(urlencode($dtype.'.zip'), $fileName);
    }

    public function add_new_paystub(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $addedby = $this->getClientAttorneyId($client_id);
        $client_type = $input['client_type'];

        $taxList = ArrayHelper::getTaxesArrayForPaystub();
        $deductionList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "2")->whereIn("deduction_added_by", [$addedby,1])
                        ->orderBy('deduction_label', 'ASC')->groupBy('deduction_label')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get();
        $deductionList = (isset($deductionList) && !empty($deductionList)) ? $deductionList->toArray() : [];
        $dedArray = self::getDeductionListArray($addedby);

        // Create a lookup array from dedArray
        $dedArrayLookup = [];
        foreach ($dedArray as $deduction) {
            $transformedLabel = self::transformLabel($deduction['deduction_label']);
            $dedArrayLookup[$transformedLabel] = true;
        }

        // Filter the deductionList
        $filteredDeductionList = array_filter($deductionList, function ($deduction) use ($dedArrayLookup) {
            $transformedLabel = self::transformLabel($deduction['deduction_label']);

            return !isset($dedArrayLookup[$transformedLabel]);
        });

        // Merge dedArray with the filtered deductionList
        $finalArray = array_merge($dedArray, $filteredDeductionList);

        $employerList = PayStubs::getEmployerListForPaystub($client_id, $addedby, $client_type);


        $payStubType = 'Debtor_Pay_Stubs';
        if ($client_type == 'codebtor') {
            $payStubType = 'Co_Debtor_Pay_Stubs';
        }

        $paystubDocuments = PayStubs::getPaystubDocuments($client_id, $payStubType);

        return view('attorney.client.add_paystub_popup', [
            'client_id' => $client_id, 'client_type' => $client_type, 'taxList' => $taxList, 'deductionList' => $finalArray, 'employerList' => $employerList, 'paystubDocuments' => $paystubDocuments
        ]);
    }

    public function transformLabel($label)
    {
        return strtolower(str_replace(' ', '', $label));
    }

    public function pay_check_calculation(Request $request)
    {

        $input = $request->all();
        $client_id = $input['client_id'];
        $client_type = $input['client_type'] ?? null;
        $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, $client_type);

        return view('attorney.client.pay_check_calculation_popup', [
            'client_id' => $client_id,
            'debtorPayCheckData' => $response['debtorPayCheckData'],
            'codebtorPayCheckData' => $response['codebtorPayCheckData'],
            'debtorCompleteList' => $response['debtorCompleteList'],
            'codebtorCompleteList' => $response['codebtorCompleteList'],
            'debtorAllReport' => $response['debtorAllReport'],
            'codebtorAllReport' => $response['codebtorAllReport'],
            'User' => $response['User'],
            'client_type' => $client_type
        ]);
    }

    public static function getPayCheckData($client_id, $accountType, $employerList)
    {
        $payCheckData = [];
        $now = Carbon::now();
        $startDate = $now->copy()->startOfMonth()->subMonths(6);
        $endDate = $now->copy()->startOfMonth()->subDay();

        foreach ($employerList as $employer) {
            $employer_id = $employer['employer_id'];
            $frequency = $employer['frequency'];
            $payStubData = ClientDocuments::getPayStubs($client_id, $accountType, $employer_id, $startDate, $endDate);

            if (!$payStubData) {
                continue;
            }

            $payDates = [];
            switch ($frequency) {
                case 1: // Weekly
                    $payDates = self::getWeeklyPayDates($startDate, $endDate);
                    break;
                case 2: // Bi-Weekly
                    $payDates = self::getBiWeeklyPayDates($startDate, $endDate);
                    break;
                case 3: // Twice a month
                    $where = [ 'client_id' => $client_id, 'employer_id' => $employer_id, 'pinwheel_account_type' => $accountType ];
                    $payDates = self::getTwiceAMonthPayDates($startDate, $endDate, $where);
                    break;
                case 4: // Monthly
                    $payDates = self::getMonthlyPayDates($startDate, $endDate);
                    break;
            }

            $paystubList = PayStubs::where(['client_id' => $client_id,'pinwheel_account_type' => $accountType])
                                                ->where(function ($query) use ($employer_id) {
                                                    $query->where('employer_id', $employer_id);
                                                })
                                                ->orderBy('pay_date', 'DESC')->get();

            $overrideCount = PayStubs::where([
                                                    'client_id' => $client_id,
                                                    'pinwheel_account_type' => $accountType,
                                                    'employer_id' => $employer_id,
                                                ])
                                                ->where(function ($query) {
                                                    $query->whereNotNull('override_date')
                                                          ->where('override_date', '!=', '');
                                                })
                                                ->count();

            $data = [
                'clientFrequency' => Helper::getPayFrequencyLabel($frequency),
                'emp_data' => $employer,
                'pay_dates' => [],
                'pay_dates_list' => !empty($paystubList) ? $paystubList->toArray() : [],
                'overrideCount' => $overrideCount ?? 0,
            ];

            foreach ($payDates as $payDate) {

                $checkStartDate = '';
                $checkEndDate = '';
                if ($frequency == 4) {
                    $checkStartDate = '';
                    $checkEndDate = '';
                    $checkStartDate = Carbon::parse($payDate)->startOfMonth();
                    $checkEndDate = Carbon::parse($payDate)->endOfMonth();
                } else {
                    $checkStartDate = '';
                    $checkEndDate = '';
                    $checkStartDate = Carbon::parse($payDate)->subDay();
                    $checkEndDate = Carbon::parse($payDate)->addDay();
                }

                if (!empty($checkStartDate) && !empty($checkEndDate)) {
                    $existsData = PayStubs::where([
                                        'client_id' => $client_id,
                                        'employer_id' => $employer_id,
                                        'pinwheel_account_type' => $accountType
                                    ])->whereBetween('pay_date', [$checkStartDate, $checkEndDate])->get();
                }

                $exists = !$existsData->isEmpty();

                $data['pay_dates'][] = [
                    'pay_date' => $payDate,
                    'exists' => $exists,
                    'existsData' => $existsData->toArray()
                ];
            }

            if (!empty($data['pay_dates'])) {
                $payCheckData[] = $data;
            }
        }
        $checkStartDate = "2024-03-14";
        $checkEndDate = "2024-03-16";

        return $payCheckData;
    }

    private static function getWeeklyPayDates($startDate, $endDate)
    {
        $dates = [];

        $firstFriday = $startDate->copy();
        if ($firstFriday->dayOfWeek != Carbon::FRIDAY) {
            $firstFriday->addDays((Carbon::FRIDAY - $firstFriday->dayOfWeek + 7) % 7);
        }

        $currentDate = $firstFriday;
        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $dates[] = $currentDate->toDateString(); // Add current Friday
            $currentDate->addDays(7); // Move to the next Friday
        }

        return $dates;
    }

    private static function getBiWeeklyPayDates($startDate, $endDate)
    {
        $dates = [];
        $firstFriday = $startDate->copy();
        if ($firstFriday->dayOfWeek != Carbon::FRIDAY) {
            $firstFriday->addDays((Carbon::FRIDAY - $firstFriday->dayOfWeek + 7) % 7);
            $currentDate = $firstFriday->copy()->addDays(7);
        } else {
            $currentDate = $firstFriday;
        }

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $dates[] = $currentDate->toDateString();
            $currentDate->addDays(14);
        }

        return $dates;
    }

    private static function getTwiceAMonthPayDates($startDate, $endDate, $where)
    {
        $dates = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $firstDay = $currentDate->copy()->setDay(1);
            $fifteenthDay = $currentDate->copy()->setDay(15);

            $existsFirst = PayStubs::where($where)->where('pay_date', '=', $firstDay->toDateString())->exists();
            $existsThirtieth = false;
            $thirtiethDay = $currentDate->copy();
            if ($thirtiethDay->daysInMonth >= 30) {
                $thirtiethDay->setDay(30);
                $existsThirtieth = PayStubs::where($where)->where('pay_date', '=', $thirtiethDay->toDateString())->exists();
                if ($thirtiethDay->daysInMonth > 30) {
                    $thirtiethDay->addDay();
                    $existsThirtieth = !$existsThirtieth ? PayStubs::where($where)->where('pay_date', '=', $thirtiethDay->toDateString())->exists() : false;
                }
            }

            if ($existsFirst) {
                $dates[] = $firstDay->toDateString();
                $dates[] = $fifteenthDay->toDateString();
            } elseif ($existsThirtieth) {
                $dates[] = $fifteenthDay->toDateString();
                $dates[] = $currentDate->copy()->setDay(30)->toDateString();
            } else {
                $dates[] = $firstDay->toDateString();
                $dates[] = $fifteenthDay->toDateString();
            }

            $currentDate->addMonths(1);
        }

        return array_unique($dates);
    }

    private static function getMonthlyPayDates($startDate, $endDate)
    {
        $dates = [];
        $currentDate = $startDate->copy();
        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $endOfMonth = $currentDate->copy()->endOfMonth();
            if ($endOfMonth->isSaturday()) {
                $dates[] = $endOfMonth->subDay()->toDateString();
            } elseif ($endOfMonth->isSunday()) {
                $dates[] = $endOfMonth->subDays(2)->toDateString();
            } else {
                $dates[] = $endOfMonth->toDateString();
            }
            $currentDate->addMonths(1);
        }

        return $dates;
    }

    public function override_paystub_date(Request $request)
    {
        $input = $request->all();
        $paystub_id = Helper::validate_key_value('paystub_id', $input);
        $overrideDate = Helper::validate_key_value('overrideDate', $input);
        PayStubs::where(['override_date' => $overrideDate])->update(['override_date' => '']);
        PayStubs::where(['id' => $paystub_id])->update(['override_date' => $overrideDate]);

        return response()->json(Helper::renderJsonSuccess("Paystub date has been overrided successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function copy_paystub(Request $request)
    {
        $input = $request->all();

        $paystubId = Helper::validate_key_value('paystubId', $input);

        if (empty($paystubId)) {

            $cType = ($input['client_type'] == 'debtor') ? 'self' : 'spouse';
            $report = PayStubs::leftJoin("tbl_payroll_assistant_employer_to_client", "employer_id", "=", "tbl_payroll_assistant_employer_to_client.id")
                ->where(["tbl_pinwheel_paystub.client_id" => $input['client_id'],"pinwheel_account_type" => $cType])
                ->select(['tbl_pinwheel_paystub.*','employer_name'])
                ->orderBy('pay_date', 'DESC')->first();
            $paystubId = $report->id;
            $input['paystubId'] = $paystubId;

        }

        $client_type = $input['client_type'];
        $data = $this->getRequiredPopupData($input);
        $client_id = $input['client_id'];
        $attorney_id = $this->getClientAttorneyId($client_id);
        $employerList = PayStubs::getEmployerListForPaystub($client_id, $attorney_id, $client_type);
        $data['employerList'] = $employerList ?? [];

        $payStubType = 'Debtor_Pay_Stubs';
        if ($client_type == 'codebtor') {
            $payStubType = 'Co_Debtor_Pay_Stubs';
        }
        $paystubDocuments = PayStubs::getPaystubDocuments($client_id, $payStubType);
        $data['paystubDocuments'] = $paystubDocuments ?? [];

        return view('attorney.client.edit_copy_paystub_popup', $data);
    }

    public function new_monthly_pay(Request $request)
    {
        $input = $request->all();
        $client_type = $input['client_type'];
        $client_id = $input['client_id'];

        $attorney_id = $this->getClientAttorneyId($client_id);
        $employerList = PayStubs::getEmployerListForPaystub($client_id, $attorney_id, $client_type);
        $data = [
            'client_id' => $client_id,
            'client_type' => $client_type,
            'employerList' => $employerList
        ];

        if (empty($employerList)) {
            return response()->json(Helper::renderJsonError("No Employer found with monthly frequency."))->header('Content-Type: application/json;', 'charset=utf-8');
            // return redirect()->back()->with('error', 'No Employer found for this client');
        }

        return view('attorney.client.monthly_pay_popup', $data);
    }

    public function clone_paystub(Request $request)
    {
        $input = $request->all();
        $data = $this->getRequiredPopupData($input);
        $client_id = $input['client_id'];
        $attorney_id = $this->getClientAttorneyId($client_id);
        $client_type = $input['client_type'];
        $employerList = PayStubs::getEmployerListForPaystub($client_id, $attorney_id, $client_type);
        $data['employerList'] = $employerList ?? [];

        $payStubType = 'Debtor_Pay_Stubs';
        if ($client_type == 'codebtor') {
            $payStubType = 'Co_Debtor_Pay_Stubs';
        }
        $paystubDocuments = PayStubs::getPaystubDocuments($client_id, $payStubType);
        $data['paystubDocuments'] = $paystubDocuments ?? [];

        return view('attorney.client.edit_clone_paystub_popup', $data);
    }

    public function edit_paystub(Request $request)
    {
        $input = $request->all();
        $data = $this->getRequiredPopupData($input);
        $client_type = $input['client_type'] ?? '';
        $attorney_id = $this->getClientAttorneyId($input['client_id']);
        $employerList = PayStubs::getEmployerListForPaystub($input['client_id'], $attorney_id, $client_type);
        $data['employerList'] = $employerList ?? [];

        return view('attorney.client.edit_paystub_popup', $data);
    }

    private function getRequiredPopupData($input)
    {
        $paystub_id = $input['paystubId'];
        $paystub_data = PayStubs::where('id', $paystub_id)->first()->toArray();
        $paystub_data_taxes = json_decode($paystub_data['taxes'], 1);
        $paystub_data_deductions = json_decode($paystub_data['deductions'], 1);
        $client_id = $input['client_id'] ?? '';
        $addedby = $this->getClientAttorneyId($client_id);
        $client_type = $input['client_type'] ?? '';
        $taxList = ArrayHelper::getTaxesArrayForPaystub();
        $deductionList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "2")->whereIn("deduction_added_by", [$addedby,1])
                        ->orderBy('deduction_label', 'ASC')->groupBy('deduction_label')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get();
        $deductionList = (isset($deductionList) && !empty($deductionList)) ? $deductionList->toArray() : [];

        $dedArray = self::getDeductionListArray($addedby);

        // Create a lookup array from dedArray
        $dedArrayLookup = [];
        foreach ($dedArray as $deduction) {
            $transformedLabel = self::transformLabel($deduction['deduction_label']);
            $dedArrayLookup[$transformedLabel] = true;
        }

        // Filter the deductionList
        $filteredDeductionList = array_filter($deductionList, function ($deduction) use ($dedArrayLookup) {
            $transformedLabel = self::transformLabel($deduction['deduction_label']);

            return !isset($dedArrayLookup[$transformedLabel]);
        });

        // Merge dedArray with the filtered deductionList
        $finalArray = array_merge($dedArray, $filteredDeductionList);
        $data = [
                    'client_id' => $client_id,
                    'client_type' => $client_type,
                    'taxList' => $taxList,
                    'deductionList' => $finalArray,
                    'paystub_data' => $paystub_data,
                    'paystub_data_taxes' => $paystub_data_taxes,
                    'paystub_data_deductions' => $paystub_data_deductions,
                ];

        return $data;
    }

    public function copy_save_new_paystub(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            return redirect()->back()->with('error', 'Invalid Input.');
        }
        $filename = '';
        if (!empty($input)) {


            $client_id = $input['client_id'] ?? '';
            $client_type = '';
            if (!empty($input) && $input['client_type'] == 'debtor') {
                $client_type = 'self';
            }
            if (!empty($input) && $input['client_type'] == 'codebtor') {
                $client_type = 'spouse';
            }

            // previous data
            $paystub_id = $input['paystub_data_id'] ?? '';
            $paystub_data = PayStubs::where('id', $paystub_id)->first()->toArray();
            $regularPay = Helper::validate_key_value('regular_pay_amount', $paystub_data);
            $overtimePay = Helper::validate_key_value('overtime_pay_amount', $paystub_data);
            $grossPay = $paystub_data['gross_pay_amount'];
            $totalTaxes = $paystub_data['total_taxes'];
            $totalDeductions = $paystub_data['total_deductions'];
            $netPay = $paystub_data['net_pay_amount'];
            $taxesJson = $paystub_data['taxes'];
            $deductionsJson = $paystub_data['deductions'];

            $dateTime = date("Y-m-d H:i:s");

            $pay_frequency = $input['pay_frequency'] ?? '';
            $direction = $input['direction'] ?? '';
            $times = $input['times'] ?? 0;

            if ($times > 0) {
                $halfMonth = 15;
                for ($i = 1; $i <= $times; $i++) {

                    $period_start = Carbon::parse($input['pay_period_start']);
                    $period_end = Carbon::parse($input['pay_period_end']);
                    $pay_date = Carbon::parse($input['pay_date']);
                    $even = ($i % 2 === 0);
                    if ($direction == 0) { // Forward
                        switch ($pay_frequency) {
                            case 1: // Weekly
                                $period_start = $period_start->copy()->addWeeks($i);
                                $period_end = $period_end->copy()->addWeeks($i);
                                $pay_date = $pay_date->copy()->addWeeks($i);
                                break;
                            case 2: // Bi-weekly
                                $period_start = $period_start->copy()->addWeeks(2 * $i);
                                $period_end = $period_end->copy()->addWeeks(2 * $i);
                                $pay_date = $pay_date->copy()->addWeeks(2 * $i);
                                break;
                            case 3: // Half-month or full month depending on even/odd
                                if ($even) {
                                    $period_start = $period_start->copy()->addMonths($i / 2);
                                    $period_end = $period_end->copy()->addMonths($i / 2);
                                    $pay_date = $pay_date->copy()->addMonths($i / 2);
                                } else {
                                    $period_start = $period_start->copy()->addDays($halfMonth * $i);
                                    $period_end = $period_end->copy()->addDays($halfMonth * $i);
                                    $pay_date = $pay_date->copy()->addDays($halfMonth * $i);
                                }
                                break;
                            case 4: // Monthly
                                $period_start = $period_start->copy()->addMonths($i);
                                $period_end = $period_end->copy()->addMonths($i);
                                $pay_date = $pay_date->copy()->addMonths($i);
                                break;
                            default:
                                break;
                        }
                    } else { // Backward
                        switch ($pay_frequency) {
                            case 1: // Weekly
                                $period_start = $period_start->copy()->subWeeks($i);
                                $period_end = $period_end->copy()->subWeeks($i);
                                $pay_date = $pay_date->copy()->subWeeks($i);
                                break;
                            case 2: // Bi-weekly
                                $period_start = $period_start->copy()->subWeeks(2 * $i);
                                $period_end = $period_end->copy()->subWeeks(2 * $i);
                                $pay_date = $pay_date->copy()->subWeeks(2 * $i);
                                break;
                            case 3: // Half-month or full month depending on even/odd
                                if ($even) {
                                    $period_start = $period_start->copy()->subMonths($i / 2);
                                    $period_end = $period_end->copy()->subMonths($i / 2);
                                    $pay_date = $pay_date->copy()->subMonths($i / 2);
                                } else {
                                    $period_start = $period_start->copy()->subDays($halfMonth * $i);
                                    $period_end = $period_end->copy()->subDays($halfMonth * $i);
                                    $pay_date = $pay_date->copy()->subDays($halfMonth * $i);
                                }
                                break;
                            case 4: // Monthly
                                $period_start = $period_start->copy()->subMonths($i);
                                $period_end = $period_end->copy()->subMonths($i);
                                $pay_date = $pay_date->copy()->subMonths($i);
                                break;
                            default:
                                break;
                        }
                    }
                    // Format dates to 'Y-m-d'
                    $period_start = $period_start->format('Y-m-d');
                    $period_end = $period_end->format('Y-m-d');
                    $pay_date = $pay_date->format('Y-m-d');

                    $data = [
                        'client_id' => $client_id,
                        'pay_period_start' => $period_start,
                        'pay_period_end' => $period_end,
                        'pay_date' => $pay_date,
                        'regular_pay_amount' => Helper::priceFormt($regularPay),
                        'overtime_pay_amount' => Helper::priceFormt($overtimePay),
                        'gross_pay_amount' => Helper::priceFormt($grossPay),
                        'net_pay_amount' => Helper::priceFormt($netPay),
                        'total_taxes' => Helper::priceFormt($totalTaxes),
                        'total_deductions' => Helper::priceFormt($totalDeductions),
                        'taxes' => $taxesJson,
                        'deductions' => $deductionsJson,
                        'document' => '',
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'pinwheel_account_type' => $client_type,
                        'paystub_for_month' => date('Ym', strtotime($dateTime)),
                        'document_id' => ''
                    ];
                    $inputPayDate = \Carbon\Carbon::parse($pay_date);
                    $tillDate = \Carbon\Carbon::parse(date('Y-m-d', strtotime('last day of previous month')));
                    $fromDate = \Carbon\Carbon::parse(date("Y-m-d", strtotime("-6 months", strtotime($tillDate))));
                    if ($inputPayDate->between($fromDate, $tillDate)) {
                        $data['is_mapped'] = 0;
                    }
                    PayStubs::Create($data);
                    PayStubs::storePaystub($client_id, $client_type);
                }

            }

            return redirect()->back()->with('success', 'Record has been added successfully.');
        }
    }

    public function save_paystub_doc(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            return response()->json(Helper::renderJsonError("Invalid Input."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $paystub_id = Helper::validate_key_value('paystub_id', $input);
        $document_id = Helper::validate_key_value('document_id', $input);
        $client_id = Helper::validate_key_value('client_id', $input);
        $filename = '';
        if (!empty($document_id)) {
            $filename = self::getFileNameById($document_id, $client_id) ?? '';
        }
        $dateTime = date("Y-m-d H:i:s");
        $paystub_data = PayStubs::where('id', $paystub_id)->first()->toArray();
        $updated_name = date("m.d.Y", strtotime($paystub_data['pay_date']));
        \App\Models\ClientDocumentUploaded::where(['client_id' => $client_id,'id' => $document_id])->update(['updated_name' => $updated_name]);
        $paystub_data['document_id'] = $document_id;
        $paystub_data['document'] = $filename;
        $paystub_data['updated_at'] = $dateTime;
        PayStubs::where('id', $paystub_id)->update($paystub_data);

        return response()->json(Helper::renderJsonSuccess("Record has been updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');

    }

    public function clone_save_new_paystub(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            return redirect()->back()->with('error', 'Invalid Input.');
        }
        $filename = '';
        if (!empty($input)) {

            $client_id = $input['client_id'] ?? '';
            $client_type = '';
            if (!empty($input) && $input['client_type'] == 'debtor') {
                $client_type = 'self';
            }
            if (!empty($input) && $input['client_type'] == 'codebtor') {
                $client_type = 'spouse';
            }

            $documentFile = Helper::validate_key_value('document_file', $input);
            $document_id = Helper::validate_key_value('document_id', $input);

            if (!empty($documentFile)) {
                $file = self::getFileName($request, $client_type, $client_id) ?? '';
                $filename = $file['file_name'];
                $document_id = $file['document_id'];
            }

            // previous data
            $paystub_id = $input['paystub_data_id'] ?? '';
            $paystub_data = PayStubs::where('id', $paystub_id)->first()->toArray();
            $regularPay = Helper::validate_key_value('regular_pay_amount', $paystub_data);
            $overtimePay = Helper::validate_key_value('overtime_pay_amount', $paystub_data);
            $grossPay = $paystub_data['gross_pay_amount'];
            $totalTaxes = $paystub_data['total_taxes'];
            $totalDeductions = $paystub_data['total_deductions'];
            $netPay = $paystub_data['net_pay_amount'];
            $taxesJson = $paystub_data['taxes'];
            $deductionsJson = $paystub_data['deductions'];

            $document_name = $input['document_name'] ?? '';
            $docName = (!empty($document_name) && !empty($paystub_id)) ? $document_name : $filename;
            $dateTime = date("Y-m-d H:i:s");
            $data = [
                        'client_id' => $client_id,
                        'pay_period_start' => $input['pay_period_start'],
                        'pay_period_end' => $input['pay_period_end'],
                        'pay_date' => $input['pay_date'],
                        'regular_pay_amount' => Helper::priceFormt($regularPay),
                        'overtime_pay_amount' => Helper::priceFormt($overtimePay),
                        'gross_pay_amount' => Helper::priceFormt($grossPay),
                        'net_pay_amount' => Helper::priceFormt($netPay),
                        'total_taxes' => Helper::priceFormt($totalTaxes),
                        'total_deductions' => Helper::priceFormt($totalDeductions),
                        'taxes' => $taxesJson,
                        'deductions' => $deductionsJson,
                        'document' => $docName,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'pinwheel_account_type' => $client_type,
                        'paystub_for_month' => date('Ym', strtotime($dateTime)),
                        'document_id' => $document_id
                    ];
            $inputPayDate = \Carbon\Carbon::parse($input['pay_date']);
            $tillDate = \Carbon\Carbon::parse(date('Y-m-d', strtotime('last day of previous month')));
            $fromDate = \Carbon\Carbon::parse(date("Y-m-d", strtotime("-6 months", strtotime($tillDate))));
            if ($inputPayDate->between($fromDate, $tillDate)) {
                $data['is_mapped'] = 0;
            }
            PayStubs::Create($data);
            PayStubs::storePaystub($client_id, $client_type);

            return redirect()->back()->with('success', 'Record has been added successfully.');
        }
    }

    public function save_new_paystub(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            return redirect()->back()->with('error', 'Invalid Input.');
        }
        $filename = '';
        if (!empty($input)) {
            $client_id = $input['client_id'] ?? '';
            $attorney_id = $this->getClientAttorneyId($client_id);
            $client_type = '';
            if (!empty($input) && $input['client_type'] == 'debtor') {
                $client_type = 'self';
            }
            if (!empty($input) && $input['client_type'] == 'codebtor') {
                $client_type = 'spouse';
            }
            $paystub_employer = $input['paystub_employer'];

            $documentFile = Helper::validate_key_value('document_file', $input);
            $document_id = Helper::validate_key_value('document_id', $input);

            if (!empty($documentFile)) {
                $file = self::getFileName($request, $client_type, $client_id) ?? '';
                $filename = $file['file_name'];
                $document_id = $file['document_id'];
            }

            // $taxList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "1")->whereIn("deduction_added_by", [$attorney_id,1])
            //                 ->orderBy('deduction_label', 'ASC')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get()->toArray();
            $deductionList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "2")->whereIn("deduction_added_by", [$attorney_id,1])
                            ->orderBy('deduction_label', 'ASC')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get();
            $deductionList = (isset($deductionList) && !empty($deductionList)) ? $deductionList->toArray() : [];

            $dedArray = self::getDeductionListArray($attorney_id);

            // Create a lookup array from dedArray
            $dedArrayLookup = [];
            foreach ($dedArray as $deduction) {
                $transformedLabel = self::transformLabel($deduction['deduction_label']);
                $dedArrayLookup[$transformedLabel] = true;
            }

            // Filter the deductionList
            $filteredDeductionList = array_filter($deductionList, function ($deduction) use ($dedArrayLookup) {
                $transformedLabel = self::transformLabel($deduction['deduction_label']);

                return !isset($dedArrayLookup[$transformedLabel]);
            });

            // Merge dedArray with the filtered deductionList
            $finalArray = array_merge($dedArray, $filteredDeductionList);
            // gross pay
            $regularPay = Helper::validate_key_value('regularPayAmount', $input);
            $overtimePay = Helper::validate_key_value('overtimePayAmount', $input);
            $grossPay = $input['grossPayAmount'];
            $taxes = $input['Taxes'];

            // total taxes
            $totalTaxes = array_sum($taxes['amountMore'] ?? []) + array_sum($taxes['amountNew'] ?? []);
            $deductions = $input['Deductions'];

            if (!empty(array_filter($taxes['typeNew']))) {
                $taxData = array_filter($taxes['typeNew']);
                $this->setUpDeductions($taxData, 1);
            }

            if (!empty(array_filter($deductions['typeNew']))) {
                $deduData = array_filter($deductions['typeNew']);
                $this->setUpDeductions($deduData, 2);
            }

            // total deductions
            $totalDeductions = array_sum($deductions['amountMore'] ?? []) + array_sum($deductions['amountNew'] ?? []);
            // net pay
            $netPay = '';
            if (!empty($grossPay)) {
                $netPay = $grossPay - $totalTaxes - $totalDeductions;
            }
            $taxList = self::getTaxListArray($attorney_id);
            $taxesJson = self::getDeductionJson($taxes, $taxList);
            $deductionsJson = self::getDeductionJson($deductions, $finalArray);

            $paystub_id = $input['paystub_data_id'] ?? '';
            $created_at = $input['created_at'] ?? '';
            $edit_popup = $input['edit_popup'] ?? 0;
            $is_checked = $input['is_checked'] ?? 0;
            $docName = date("m.d.Y", strtotime($input['pay_date']));
            $dateTime = date("Y-m-d H:i:s");
            $data = [
                        'client_id' => $client_id,
                        'pay_period_start' => $input['pay_period_start'],
                        'pay_period_end' => $input['pay_period_end'],
                        'pay_date' => $input['pay_date'],
                        'regular_pay_amount' => (float)$regularPay,
                        'overtime_pay_amount' => (float)$overtimePay,
                        'gross_pay_amount' => (float)$grossPay,
                        'net_pay_amount' => $netPay,
                        'total_taxes' => $totalTaxes,
                        'total_deductions' => $totalDeductions,
                        'taxes' => $taxesJson,
                        'deductions' => $deductionsJson,
                        'document' => $docName,
                        'created_at' => (!empty($created_at) && !empty($paystub_id)) ? $created_at : $dateTime,
                        'updated_at' => $dateTime,
                        'pinwheel_account_type' => $client_type,
                        'paystub_for_month' => date('Ym', strtotime($dateTime)),
                        'employer_id' => $paystub_employer,
                        'is_mapped' => 0,
                        'is_calculated' => $is_checked,
                    ];
            if (!empty($document_id)) {
                $data['document_id'] = $document_id;
            }

            PayStubs::updateOrCreate(['id' => $paystub_id], $data);
            PayStubs::storePaystub($client_id, $client_type);
            $successMsg = ($edit_popup == 1) ? 'Record has been updated successfully.' : 'Record has been added successfully.';

            return redirect()->back()->with('success', $successMsg);
        }
    }

    public function syncPayStubDocumentOnMindeeOcr($file)
    {
        if (!empty($file)) {
            $fileName = $file->getClientOriginalName();
            $fileContent = file_get_contents($file->getPathname());

            $response = Http::withHeaders([
                'Authorization' => 'Token 810ceb6445a70082e41d7f4f4bf76ee7',
            ])->attach(
                'document',
                $fileContent,
                $fileName
            )->post('https://api.mindee.net/v1/products/BKOCR1/us_pay_stubs_ocr/v1/predict_async');

            $responseBody = $response->body();

            $decodedResponse = json_decode($responseBody, true);

            if (isset($decodedResponse['api_request']['status']) &&
                $decodedResponse['api_request']['status'] === 'success' &&
                isset($decodedResponse['job']['id'])) {

                return $decodedResponse['job']['id'];
                //return response()->json(['id' => $jobId], 200);
            } else {
                if (!empty($decodedResponse['api_request']['error'])) {
                    Log::error('Error fetching document: ' . json_encode($decodedResponse['api_request']['error']));
                }
                //return response()->json(['error' => 'Invalid response structure'], 400);
            }
        }

        return false;
    }

    public function fetchMindeeOcrDocumentDataByJobId($jobId, $client_id, $document_type, $docName, $docId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Token 810ceb6445a70082e41d7f4f4bf76ee7',
            ])->get('https://api.mindee.net/v1/products/BKOCR1/us_pay_stubs_ocr/v1/documents/queue/' . $jobId);

            $responseBody = $response->body();
            $decodedResponse = json_decode($responseBody, true);
            if (isset($decodedResponse['api_request']['status']) &&
                $decodedResponse['api_request']['status'] === 'success' &&
                $decodedResponse['api_request']['status_code'] == '200' &&
                isset($decodedResponse['document']['id'])) {
                if (!empty($decodedResponse['document']['inference'])
                    && !empty($decodedResponse['document']['inference']['prediction'])) {
                    $predictionOcrData = $decodedResponse['document']['inference']['prediction'];
                    // save paystub data
                    $this->saveMindeeApiResponse($predictionOcrData, $client_id, $document_type, $docName, $docId);
                }

                //return response()->json(['id' => $jobId], 200);
            } else {
                Log::error('Error fetching document: ' . json_encode($decodedResponse['api_request']['error']));
            }
        } catch (\Exception $e) {
            Log::error('Error fetching document: ' . $e->getMessage());
            //return response()->json(['error' => 'An error occurred while fetching the document.'], 500);
        }
    }

    public function saveMindeeApiResponse($predictionOcrData, $client_id, $document_type, $docName, $document_id)
    {
        $attorney_id = $this->getClientAttorneyId($client_id);

        $client_type = '';
        if (!empty($document_type) && $document_type == ClientDocumentUploaded::DEBTOR_PAY_STUB) {
            $client_type = 'self';
        }
        if (!empty($document_type) && $document_type == ClientDocumentUploaded::CO_DEBTOR_PAY_STUB) {
            $client_type = 'spouse';
        }

        $taxList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "1")->whereIn("deduction_added_by", [$attorney_id,1])
            ->orderBy('deduction_label', 'ASC')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get()->toArray();
        $deductionList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "2")->whereIn("deduction_added_by", [$attorney_id,1])
            ->orderBy('deduction_label', 'ASC')->select(['id', 'deduction_label', 'deduction_type', 'deduction_added_by'])->get()->toArray();

        $paystub_employer = $predictionOcrData['employer_name']['value'];
        $pay_period_start = $predictionOcrData['pay_period_start_date']['value'];
        $pay_period_end = $predictionOcrData['pay_period_end_date']['value'];
        $pay_date = $predictionOcrData['pay_date']['value'];
        $regularPay = $predictionOcrData['gross_income']['value'];
        $overtimePay = 0;
        $netPay = $predictionOcrData['net_income']['value'];
        $totalTaxes = 0;
        $totalDeductions = 0;
        $created_at = date("Y-m-d H:i:s");
        $dateTime = date("Y-m-d H:i:s");
        $is_checked = true;
        $taxes = [];
        $deductions = [];

        $taxesJson = self::getDeductionJson($taxes, $taxList);
        $deductionsJson = self::getDeductionJson($deductions, $deductionList);
        $data = [
            'client_id' => $client_id,
            'pay_period_start' => $pay_period_start,
            'pay_period_end' => $pay_period_end,
            'pay_date' => $pay_date,
            'regular_pay_amount' => (float)$regularPay,
            'overtime_pay_amount' => (float)$overtimePay,
            'gross_pay_amount' => (float)$regularPay,
            'net_pay_amount' => $netPay,
            'total_taxes' => $totalTaxes,
            'total_deductions' => $totalDeductions,
            'taxes' => $taxesJson,
            'deductions' => $deductionsJson,
            'document' => $docName,
            'created_at' => (!empty($created_at) && !empty($paystub_id)) ? $created_at : $dateTime,
            'updated_at' => $dateTime,
            'pinwheel_account_type' => $client_type,
            'paystub_for_month' => date('Ym', strtotime($dateTime)),
            'employer_id' => $paystub_employer,
            'is_mapped' => 0,
            'document_id' => $document_id,
            'is_calculated' => $is_checked,
        ];

        PayStubs::create($data);

        PayStubs::storePaystub($client_id, $client_type);

    }

    public function save_monthly_pay_form(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            return redirect()->back()->with('error', 'Invalid Input.');
        }

        $client_id = Helper::validate_key_value('client_id', $input);
        $client_type = Helper::validate_key_value('client_type', $input);
        $pay_date = Helper::validate_key_value('pay_date', $input);
        $month = Helper::validate_key_value('month', $input); // array
        $income = Helper::validate_key_value('income', $input); // array
        $employer = Helper::validate_key_value('employer', $input); // array
        $total = Helper::validate_key_value('total', $input);
        $average = Helper::validate_key_value('average', $input);

        $data = [];
        foreach ($month as $key => $value) {

            $dateTime = date("Y-m-d H:i:s");
            $paystub_for_month = Carbon::createFromFormat('m/Y', $value);

            $startDate = $paystub_for_month->copy()->startOfMonth();
            $endDate = $paystub_for_month->copy()->startOfMonth();

            $pay_period_end = $paystub_for_month->copy()->endOfMonth();
            $payDate = self::getMonthlyPayDates($startDate, $endDate);
            $firstPayDate = !empty($payDate) ? $payDate[0] : null;
            $paystub_for_month = $paystub_for_month->toDateString();

            $accountType = ($client_type == 'debtor') ? 'self' : 'spouse';
            $data = [
                'client_id' => $client_id,
                'pay_period_start' => $startDate->toDateString(),
                'pay_period_end' => $pay_period_end->toDateString(),
                'pay_date' => $firstPayDate,
                'regular_pay_amount' => (float)Helper::validate_key_value($key, $income),
                'overtime_pay_amount' => null,
                'gross_pay_amount' => (float)Helper::validate_key_value($key, $income),
                'net_pay_amount' => (float)Helper::validate_key_value($key, $income),
                'total_taxes' => 0.00,
                'total_deductions' => 0.00,
                'taxes' => json_encode([]),
                'deductions' => json_encode([]),
                'document' => null,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'pinwheel_account_type' => $accountType,
                'paystub_for_month' => date('Ym', strtotime($paystub_for_month)),
                'employer_id' => Helper::validate_key_value($key, $employer),
                'is_mapped' => 0,
                'document_id' => null,
                'is_calculated' => null,
            ];

            PayStubs::Create($data);
            PayStubs::storePaystub($client_id, $client_type);
        }

        $successMsg = 'Record has been added successfully.';

        return redirect()->back()->with('success', $successMsg);
    }

    public function getFileName($request, $client_type, $client_id)
    {
        $input = $request->all();
        $displayFileName = '';
        $document_id = 0;
        if ($request->hasFile('document_file')) {
            $file = $request->file('document_file');
            $mime_type = $file->getMimeType();
            $parts = explode('/', $mime_type);
            $extension_from_mime_type = '';
            if (count($parts) === 2) {
                $extension_from_mime_type = $parts[1];
            }
            $document_type = ($client_type == 'spouse') ? \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB : \App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB;
            $extension = !empty($file->getClientOriginalExtension()) ? $file->getClientOriginalExtension() : $extension_from_mime_type;
            $paydate = date("m.d.Y", strtotime($input['pay_date']));
            $filename = $paydate.'.pdf';
            $displayFileName = $client_type == 'spouse' ? $client_type.'_'.$filename : $filename;
            $document_id = \App\Models\ClientDocumentUploaded::storeClientSideDocument($client_id, $file, $document_type, $paydate, 1, 1, $extension, false);

        }

        return ['file_name' => $displayFileName, 'document_id' => $document_id];
    }


    public function getFileNameById($doc_id, $client_id)
    {
        $document = \App\Models\ClientDocumentUploaded::where([ "client_id" => $client_id, 'id' => $doc_id])->first();
        $path = Helper::validate_key_value('document_file', $document);
        $filename = basename($path);

        return $filename;
    }

    public function getDeductionJson($taxes, $list)
    {
        $taxesArray = [];
        if (isset($taxes['typeMore']) && !empty($taxes['typeMore'])) {
            foreach ($taxes['typeMore'] as $index => $value) {
                foreach ($list as $key => $data) {
                    if ($value == $data['id']) {
                        $taxObj = [
                                    "name" => $data['deduction_label'],
                                    "category" => "",
                                    "amount" => $taxes['amountMore'][$index],
                                    "type" => "unknown",
                                ];
                        array_push($taxesArray, $taxObj);
                    }
                }
            }
        }
        if (isset($taxes['typeNew']) && !empty($taxes['typeNew'])) {
            foreach ($taxes['typeNew'] as $index => $value) {
                if (!empty($value)) {
                    $newTaxObj = [
                                "name" => $value,
                                "category" => "",
                                "amount" => $taxes['amountNew'][$index],
                                "type" => "unknown",
                            ];
                    array_push($taxesArray, $newTaxObj);
                }
            }
        }

        return json_encode($taxesArray);
    }

    private function setUpDeductions($deduData, $type)
    {
        foreach ($deduData as $dename) {
            $dlabel = [
                'deduction_label' => $dename,
                'deduction_type' => $type,
                'deduction_added_by' => Helper::getCurrentAttorneyId(),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ];
            DeductionList::updateOrCreate(['deduction_label' => $dename,'deduction_type' => $type, 'deduction_added_by' => Helper::getCurrentAttorneyId()], $dlabel);
        }
    }



    public function manage_employer(Request $request)
    {
        $input = $request->all();
        if (!empty($input)) {
            $client_id = $input['client_id'] ?? '';
            $attorney_id = $this->getClientAttorneyId($client_id);
            $client_type = $input['client_type'] ?? '';

            $employerData = PayStubs::getEmployerData($client_id, $attorney_id, $client_type);
            $employerTypeArray = $this->getEmployerTypeArray($client_id, $attorney_id, $client_type);
            $employerData['employerTypeArray'] = $employerTypeArray;
            $employerData['edit'] = false;

            return view('attorney.client.manage_employer_popup', $employerData);
        }

        return redirect()->back()->with('error', 'Invalid Input.');
    }

    public function getEmployerTypeArray($client_id, $attorney_id, $client_type)
    {
        $clientTypeNo = ($client_type == 'codebtor') ? 2 : 1;
        $savedEmployers = \App\Models\AttorneyEmployerInformationToClient::where([
                            'client_id' => $client_id,
                            'attorney_id' => $attorney_id,
                            'client_type' => $clientTypeNo,
                        ])->pluck('employer_type')->toArray();

        $employerTypeArray = ArrayHelper::getEmployerTypeArray();
        if (!empty($savedEmployers)) {

            $employerCounts = array_count_values($savedEmployers);

            $newEmployerTypeArray = array_filter($employerTypeArray, function ($key) use ($employerCounts) {
                if (in_array($key, [1, 2])) {
                    return ($employerCounts[$key] ?? 0) < 4; // Keep if less than 4 occurrences
                }

                return true; // Keep all other employer types
            }, ARRAY_FILTER_USE_KEY);

            $uniqueTypeArray = [];
            foreach ($newEmployerTypeArray as $key => $value) {
                if (!in_array($value, $uniqueTypeArray)) {
                    $uniqueTypeArray[$key] = $value;
                }
            }
            $employerTypeArray = $uniqueTypeArray;
            $employerTypeArray[99] = ArrayHelper::getEmployerTypeArray(99);

            return !empty($employerTypeArray) ? $employerTypeArray : [99 => ArrayHelper::getEmployerTypeArray(99)];
        } else {
            $uniqueTypeArray = [];
            foreach ($employerTypeArray as $key => $value) {
                if (!in_array($value, $uniqueTypeArray)) {
                    $uniqueTypeArray[$key] = $value;
                }
            }
            $employerTypeArray = $uniqueTypeArray;
        }

        return $employerTypeArray;
    }

    public function edit_employer(Request $request)
    {
        $input = $request->all();
        if (!empty($input)) {
            $employer_id = $input['employer_id'] ?? '';

            $client_id = $input['client_id'] ?? '';
            $attorney_id = $this->getClientAttorneyId($client_id);
            $client_type = $input['client_type'] ?? '';

            $empInfoCLType = '';
            switch ($client_type) {
                case 'debtor': $empInfoCLType = 1;
                    break;
                case 'codebtor': $empInfoCLType = 2;
                    break;
            }

            $employer = \App\Models\AttorneyEmployerInformationToClient::where([ 'id' => $employer_id, 'client_id' => $client_id, 'attorney_id' => $attorney_id, 'client_type' => $empInfoCLType ])->first();
            $employer = isset($employer) && !empty($employer) ? $employer->toArray() : [];

            $uniqueTypeArray = $this->getEmployerTypeArray($client_id, $attorney_id, $client_type);

            $employerData = [
                    'client_id' => $client_id,
                    'client_type' => $client_type,
                    // 'frequency' => '',
                    'employer' => $employer,
                    'edit' => true,
                    'employerTypeArray' => $uniqueTypeArray
                ];

            return view('attorney.client.manage_employer_popup', $employerData);
        }

        return redirect()->back()->with('error', 'Invalid Input.');
    }

    public function delete_employer(Request $request)
    {
        $input = $request->all();
        if (!empty($input)) {
            $client_id = $input['client_id'] ?? '';
            $client_type = $input['client_type'] ?? '';
            $employer_id = $input['emp_id'] ?? '';

            // Set the appropriate client type for deletion
            $empInfoCLType = $client_type === 'debtor' ? 1 : 2;
            $paystubCLType = $client_type === 'debtor' ? 'self' : 'spouse';

            $employer = \App\Models\AttorneyEmployerInformationToClient::where(['id' => $employer_id, 'client_id' => $client_id, 'client_type' => $empInfoCLType])->first();
            $employerData = $employer ? $employer->toArray() : [];

            $employerType = Helper::validate_key_value('employer_type', $employerData, 'radio');

            \App\Models\AttorneyEmployerInformationToClient::where([
                'id' => $employer_id,
                'client_id' => $client_id,
                'client_type' => $empInfoCLType,
                'employer_type' => $employerType
            ])->delete();

            PayStubs::where(['employer_id' => $employer_id, 'client_id' => $client_id, 'pinwheel_account_type' => $paystubCLType])->update(['employer_id' => null]);

            return response()->json(Helper::renderJsonSuccess('Employer Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function save_employer(Request $request)
    {
        $input = $request->all();
        if (empty($input)) {
            return redirect()->back()->with('error', 'Invalid Input.');
        }

        $client_id = $input['client_id'] ?? '';
        $attorney_id = $this->getClientAttorneyId($client_id);
        $employer_type = $input['employer_type'];
        $employer_id = $input['employer_id'];

        $empInfoToClientData = $this->prepareEmpInfoToClientData($input, $attorney_id, $client_id, $employer_type);

        $model = \App\Models\AttorneyEmployerInformationToClient::class;

        if ($employer_id) {
            $previousData = $model::find($employer_id);
            if ($previousData) {
                $previousData->update($empInfoToClientData);
            } else {
                $empInfoToClientData['employer_added_by'] = 1;
                $model::create($empInfoToClientData);
            }

        } else {
            $empInfoToClientData['employer_added_by'] = 1;
            $model::create($empInfoToClientData);
        }

        return redirect()->back()->with('success', 'Record has been added successfully.');
    }

    private function prepareEmpInfoToClientData($input, $attorney_id, $client_id, $employer_type)
    {
        return [
            'attorney_id' => $attorney_id,
            'client_id' => $client_id,
            'employer_occupation' => $input['employer_occupation'],
            'employment_duration' => $input['employment_duration'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'frequency' => $input['employer_frequency'],
            'client_type' => $input['client_type'],
            'created_at' => now(),
            'updated_at' => now(),
            'employer_name' => $input['employer_name'],
            'employer_address' => $input['employer_address'],
            'employer_city' => $input['employer_city'],
            'employer_state' => $input['employer_state'],
            'employer_zip' => $input['employer_zip'],
            'employer_type' => $employer_type,
        ];
    }

    public function employer_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $keyword = urldecode($input["keyword"]);

            $employer = \App\Models\AttorneyEmployerInformationToClient::where("employer_name", "!=", null)
                                                                        ->where("attorney_id", "=", Auth::user()->id)
                                                                        ->select([
                                                                            'id as employer_id',
                                                                            'employer_name',
                                                                            'employment_duration',
                                                                            'employer_occupation',
                                                                            'frequency',
                                                                            'employer_address',
                                                                            'employer_city',
                                                                            'employer_state',
                                                                            'employer_zip',
                                                                            'attorney_id',
                                                                            'client_id',
                                                                        ])
                                                                        ->orderBy('employer_name', 'asc');

            if (!empty($keyword)) {
                $employer->Where(function ($query) use ($keyword) {
                    $query->Where('employer_name', 'like', '%' . $keyword . '%');
                });
            }
            $employer = $employer->get()->toArray();

            $json = null;
            foreach ($employer as $val) {
                $label = strip_tags(html_entity_decode($val['employer_name'], ENT_QUOTES, 'UTF-8'));
                $label .= !empty($val['employment_duration']) ? ', '.strip_tags(html_entity_decode($val['employment_duration'], ENT_QUOTES, 'UTF-8')) : '';
                $label .= !empty($val['employer_occupation']) ? ', '.strip_tags(html_entity_decode($val['employer_occupation'], ENT_QUOTES, 'UTF-8')) : '';
                $label .= !empty($val['employer_address']) ? ', ('.strip_tags(html_entity_decode($val['employer_address'], ENT_QUOTES, 'UTF-8')) : '';
                $label .= !empty($val['employer_city']) ? ', '.strip_tags(html_entity_decode($val['employer_city'], ENT_QUOTES, 'UTF-8')) : '';
                $label .= !empty($val['employer_state']) ? ', '.strip_tags(html_entity_decode($val['employer_state'], ENT_QUOTES, 'UTF-8')) : '';
                $label .= !empty($val['employer_zip']) ? ', '.strip_tags(html_entity_decode($val['employer_zip'], ENT_QUOTES, 'UTF-8')).')' : '';
                $json[] = [
                            'label' => $label,
                            'employer_id' => strip_tags(html_entity_decode($val['employer_id'], ENT_QUOTES, 'UTF-8')),
                            'employer_name' => strip_tags(html_entity_decode($val['employer_name'], ENT_QUOTES, 'UTF-8')),
                            'employment_duration' => strip_tags(html_entity_decode($val['employment_duration'], ENT_QUOTES, 'UTF-8')),
                            'employer_occupation' => strip_tags(html_entity_decode($val['employer_occupation'], ENT_QUOTES, 'UTF-8')),
                            'employer_address' => strip_tags(html_entity_decode($val['employer_address'], ENT_QUOTES, 'UTF-8')),
                            'employer_city' => strip_tags(html_entity_decode($val['employer_city'], ENT_QUOTES, 'UTF-8')),
                            'employer_state' => strip_tags(html_entity_decode($val['employer_state'], ENT_QUOTES, 'UTF-8')),
                            'employer_zip' => strip_tags(html_entity_decode($val['employer_zip'], ENT_QUOTES, 'UTF-8')),
                            'employer_frequency' => strip_tags(html_entity_decode($val['frequency'], ENT_QUOTES, 'UTF-8')),
                        ];
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }

    public static function getTaxListArray($attorney_id)
    {
        return [
            [ "id" => 1, "deduction_label" => "Federal Income Tax", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 2, "deduction_label" => "State Income Tax", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 3, "deduction_label" => "Medicare Tax", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 4, "deduction_label" => "Social Security Tax", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ]
        ];
    }

    public static function getDeductionListArray($attorney_id)
    {
        return [
            [ "id" => 'deduction1', "deduction_label" => "Mandatory Retirement", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction2', "deduction_label" => "Voluntary Retirement", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction10', "deduction_label" => "Retirement Loan Repayment", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction3', "deduction_label" => "Life Insurance", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction4', "deduction_label" => "Health Insurance", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction5', "deduction_label" => "Disability Insurance", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction6', "deduction_label" => "Health Savings Account", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction7', "deduction_label" => "Child Support", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction8', "deduction_label" => "Alimony", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ],
            [ "id" => 'deduction9', "deduction_label" => "Union Dues", "deduction_type" => "1", "deduction_added_by" => $attorney_id  ]
        ];
    }

    public function import_data_to_other_paystubs(Request $request)
    {
        $paystubId = $request->input('paystubId', '');
        $clientId = $request->input('clientId', '');
        $paystubFor = $request->input('paystubFor', 'self');
        $empId = $request->input('empId', '');
        $dateTime = now();

        DB::beginTransaction();

        try {
            // Fetch parent paystub
            $parentPaystub = PayStubs::where([
                'id' => $paystubId,
                'pinwheel_account_type' => $paystubFor,
                'client_id' => $clientId
            ])->first();

            if (!$parentPaystub) {
                return response()->json(
                    Helper::renderJsonError('Parent paystub not found.')
                )->header('Content-Type: application/json;', 'charset=utf-8');
            }

            // Fetch all paystubs for the same employer/client/type
            $allPaystubs = PayStubs::where([
                'pinwheel_account_type' => $paystubFor,
                'client_id' => $clientId,
                'employer_id' => $empId
            ])->get();

            foreach ($allPaystubs as $paystub) {
                // Skip the parent paystub itself
                if ($paystub->id === $parentPaystub->id) {
                    continue;
                }

                $ptaxes = $paystub->taxes;
                $ptotal_taxes = $paystub->total_taxes;
                $pdeductions = $paystub->deductions;
                $ptotal_deductions = $paystub->total_deductions;

                $logObject = [
                    'calculation' => [
                        'taxes' => $ptaxes,
                        'total_taxes' => $ptotal_taxes,
                        'deductions' => $pdeductions,
                        'total_deductions' => $ptotal_deductions,
                    ],
                    'about' => [
                        'imported_by' => Auth::user()?->name,
                        'imported_at' => $dateTime->toDateTimeString(),
                    ]
                ];

                $oldCalculationLogs = $paystub->calculation_logs;
                $newCalculationLogs = [];
                if (!empty($oldCalculationLogs)) {
                    $newCalculationLogs = json_decode($oldCalculationLogs, true);
                }
                $newCalculationLogs[] = $logObject;

                // Update fields
                $paystub->taxes = $parentPaystub->taxes;
                $paystub->total_taxes = $parentPaystub->total_taxes;
                $paystub->deductions = $parentPaystub->deductions;
                $paystub->total_deductions = $parentPaystub->total_deductions;
                $paystub->calculation_logs = json_encode($newCalculationLogs);

                $paystub->save();
            }

            DB::commit();

            return response()->json(
                Helper::renderJsonSuccess('Paystubs updated successfully.')
            )->header('Content-Type: application/json;', 'charset=utf-8');

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(
                Helper::renderJsonError('Something went wrong: ' . $e->getMessage())
            )->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function import_data_to_this_paystubs(Request $request)
    {
        // Validate required inputs
        $request->validate([
            'paystubIndex' => 'required|integer|min:0',
            'paystubId' => 'required|integer',
            'clientId' => 'required|integer',
        ]);

        $paystubIndex = $request->input('paystubIndex', '');
        $paystubId = $request->input('paystubId', '');
        $clientId = $request->input('clientId', '');

        // Check if attorney has access to this client
        if (! Helper::isClientBelongsToAttorney($clientId, Helper::getCurrentAttorneyId())) {
            return response()->json(
                Helper::renderJsonError('Unauthorized access.')
            )
            ->header('Content-Type: application/json;', 'charset=utf-8');
        }

        DB::beginTransaction();
        try {
            // Fetch parent paystub
            $paystub = PayStubs::where([
                'id' => $paystubId,
                'client_id' => $clientId
            ])->first();

            if (!$paystub) {
                return response()->json(
                    Helper::renderJsonError('Parent paystub not found.')
                )->header('Content-Type: application/json;', 'charset=utf-8');
            }

            $calculationLogs = $paystub->calculation_logs;

            $data = [];
            if (!empty($calculationLogs) && is_array(json_decode($calculationLogs, true))) {
                $calculationLogs = json_decode($calculationLogs, true);
                $data = $calculationLogs[$paystubIndex]['calculation'];
            }

            if (!empty($data)) {
                $paystub->taxes = $data['taxes'];
                $paystub->total_taxes = $data['total_taxes'];
                $paystub->deductions = $data['deductions'];
                $paystub->total_deductions = $data['total_deductions'];
                $paystub->save();
            }
            DB::commit();

            return response()->json(
                Helper::renderJsonSuccess('Paystubs updated successfully.')
            )->header('Content-Type: application/json;', 'charset=utf-8');

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(
                Helper::renderJsonError('Something went wrong: ' . $e->getMessage())
            )->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function calculation_logs_popup(Request $request)
    {
        if ($request->isMethod('post')) {

            $paystubId = $request->input('paystubId', '');
            $clientId = $request->input('clientId', '');

            $paystub = PayStubs::where([
                'id' => $paystubId,
                'client_id' => $clientId
            ])->first();


            $renderData = [
                'paystub' => $paystub,
                'client_id' => $clientId
            ];

            $html = view('modal.attorney.payroll_management.calculation_logs', $renderData)->render();

            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }


}
