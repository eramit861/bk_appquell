<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Helpers\AddressHelper;
use Illuminate\Http\Request;
use App\Helpers\DateTimeHelper;
use Illuminate\Support\Facades\DB;
use App\Helpers\VideoHelper;
use App\Helpers\ClientHelper;
use App\Models\CrsCreditReport;
use App\Models\DebtsTax;
use App\Models\PayStubs;
use App\Services\Client\CacheDebt;
use App\Models\ProfitLoss;
use App\Services\Client\CacheProperty;

class CreditReportController extends AttorneyController
{
    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function credit_report_edit(Request $request, $id, $dType = 1)
    {
        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }
        $client = $this->getClientData($id);
        $editable = \App\Models\FormsStepsCompleted::select('can_edit')->where('client_id', $id)->first();

        $total = $this->getClientCompletedStepsCount($id);
        $report = CrsCreditReport::where("client_id", $id);

        if ($dType == 1) {
            $report->where(function ($q) {
                $q->where('creditLiabilityAccountOwnershipType', 'Debtor 1')
                ->orWhere('creditLiabilityAccountOwnershipType', 'INDIVIDUAL')
                ->orWhere('creditLiabilityAccountOwnershipType', 'Debtor 1 and Debtor 2')
                ->orWhere('creditLiabilityAccountOwnershipType', 'JOINT')
                ->orWhere('creditLiabilityAccountOwnershipType', '')
                ->orWhereNull('creditLiabilityAccountOwnershipType');
            });
        }

        if ($dType == 2) {
            $report->where(function ($q) {
                $q->where('creditLiabilityAccountOwnershipType', 'Debtor 2')
                ->orWhere('creditLiabilityAccountOwnershipType', 'Debtor 1 and Debtor 2')
                ->orWhere('creditLiabilityAccountOwnershipType', 'JOINT');
            });
        }

        $reportAll = clone $report->get();

        $selectedCreditType = $request->get('credit_type', []);
        if (!empty($selectedCreditType)) {
            $checkKeys = ['unsecured', 2, 3, 4, 5, 6, 7];
            if (in_array('unsecured', $selectedCreditType)) {
                $selectedCreditType = array_values(array_unique(array_merge($selectedCreditType, $checkKeys)));
            }
            $report->whereIn('creditLoanType', $selectedCreditType);
        }

        $creditLoanTypeMap = AddressHelper::getDebtSelection();

        $sort = $request->get('sort', 'is_imported');
        $direction = $request->get('direction', 'asc');

        $report = $report->orderBy('is_imported', 'asc');

        if ($sort === 'creditLoanType') {
            $sortedKeys = collect($creditLoanTypeMap)->sortBy(fn ($label) => $label, SORT_NATURAL | SORT_FLAG_CASE)->keys()->toArray();
            $report = $report->orderByRaw("FIELD(creditLoanType, " . implode(',', $sortedKeys) . ") " . strtoupper($direction));
        } else {
            $report = $report->orderBy($sort, $direction);
        }

        $report = $report->get();

        $report = !empty($report) ? $report->toArray() : [];

        // Debug: Log the query and results for troubleshooting
        \Illuminate\Support\Facades\Log::info('Credit Report Query Debug', [
            'client_id' => $id,
            'dType' => $dType,
            'selectedCreditType' => $selectedCreditType,
            'total_results' => count($report),
            'sample_ownership_types' => array_unique(array_column($report, 'creditLiabilityAccountOwnershipType'))
        ]);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CREDITORS_CREDIT_REPORT_VIDEO);
        $reqstatus = \App\Models\PdfToJson::where(['client_id' => $id,'request_type' => 'credit_report', 'company_name' => 'bestcase'])->first();
        $reqstatus = !empty($reqstatus) ? $reqstatus->toArray() : [];

        $attorney = \App\Models\ClientsAttorney::where("client_id", $id)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }
        $docsUploadInfo = ClientHelper::documentUploadInfo($client, $id, $attorney_id, false);
        $payStubAIStatus = PayStubs::getAIStatusBasedArray($id);
        $debtorName = ProfitLoss::getName($id, 1);
        $codebtorName = ProfitLoss::getName($id, 2);

        return view('attorney.client.credit_report', [
                'payStubAIStatus' => $payStubAIStatus,
                'authUser' => $client,
                'client_id' => $id,
                'docsUploadInfo' => $docsUploadInfo,
                'reqstatus' => $reqstatus,
                'video' => $video,
                'report' => $report,
                'User' => $client,
                'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0),
                'type' => 'credit_report',
                'totals' => $total,
                'dType' => $dType,
                'debtorName' => $debtorName,
                'codebtorName' => $codebtorName,
                'sort' => $sort,
                'direction' => $direction,
                'creditLoanTypeMap' => $creditLoanTypeMap,
                'selectedCreditType' => $selectedCreditType,
                'reportAll' => $reportAll,
            ]);
    }

    public function manual_import_schedule(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id < 1) {
            return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $clientAddress = AddressHelper::getClientBasicAddress($client_id);
        $PropertyData = CacheProperty::getPropertyData($client_id);
        $propertyresident = Helper::validate_key_value('propertyresident', $PropertyData, 'array');
        $propertyresident = !empty($propertyresident) ? $propertyresident->toArray() : [];
        $propertyvehicle = Helper::validate_key_value('propertyvehicle', $PropertyData, 'array');

        return view('attorney.client.manual-import-schedule', ['propertyvehicle' => $propertyvehicle,'client_id' => $client_id,'propertyresident' => $propertyresident, 'clientAddress' => $clientAddress]);
    }

    public function csv_import_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id < 1) {
            return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return view('attorney.client.csv_import_popup', ['client_id' => $client_id]);
    }

    public function csv_import_save(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $software = $input['software'] ?? '';
            $schedule = $input['schedule'] ?? '';
            $client_id = $input['client_id'] ?? '';
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return redirect()->back()->with('error', 'Invalid Request.');
            }
            if ($client_id < 1) {
                return redirect()->back()->with('error', 'Invalid Request.');
            }
            if ($request->hasFile('document_file')) {
                $file = $request->file('document_file');
                $firstFile = $file[0];
                $fileContents = file($firstFile->getPathname());
                if (!empty($fileContents)) {
                    $store_path = "client/" . $client_id . "/creditors";
                    $imageName = $firstFile->getClientOriginalName();
                    $imageName = time() . '_' . $imageName;
                    $imageName = Helper::validate_doc_type($imageName);
                    \Storage::disk('s3')->putFileAs($store_path, $firstFile, $imageName);
                    $path = $store_path.'/'.$imageName;
                    $this->createCreditReport($client_id, $software, $schedule, $fileContents, $path);
                }

                return redirect()->back()->with('success', 'CSV imported successfully.');
            } else {
                return redirect()->back()->with('error', 'Document is Required.');
            }

        }
    }

    private function createCreditReport($client_id, $software, $schedule, $fileContents, $path)
    {
        // delete prev data
        // CrsCreditReport::where('client_id', $client_id)->delete();
        // jubliee
        if ($software === '1') {
            foreach ($fileContents as $index => $line) {
                if ($index !== 0) {
                    $data = str_getcsv($line);
                    $address = $data[2].((isset($data[3]) && !empty($data[3])) ? ', '.$data[3] : '').((isset($data[4]) && !empty($data[4])) ? ', '.$data[4] : '');
                    $incDate = $data[15] ?? '';
                    $dateArray = !empty($incDate) ? explode("/", $incDate) : [];
                    $incuredDate = '';
                    if (!empty($dateArray) && count($dateArray) == 2) {
                        $incuredDate = $dateArray[0].'/'.$dateArray[1];
                    }
                    if (!empty($dateArray) && count($dateArray) == 3) {
                        $incuredDate = $dateArray[0].'/'.$dateArray[2];
                    }
                    if (empty($incuredDate)) {
                        $incuredDate = date('m/Y');
                    }
                    $incuredDate = DateTimeHelper::formatToMonthYearFromAnyFormat($incuredDate);
                    if ($incuredDate == false) {
                        continue;
                    }
                    $obj = [
                                'client_id' => $client_id,
                                'fullName' => $data[0] ?? '',
                                'address' => $address,
                                'city' => $data[5] ?? '',
                                'state' => $data[6] ?? '',
                                'zip' => $data[7] ?? '',
                                'creditBusinessType' => '',
                                'creditLiabilityAccountIdentifier' => (isset($data[8]) && !empty($data[8]) ? Helper::lastchar($data[8]) : ''),
                                'creditLiabilityAccountOpenedDate' => '',
                                'creditLiabilityAccountReportedDate' => '',
                                'creditLiabilityAccountType' => '',
                                'creditLiabilityAccountOwnershipType' => $data[14] ?? '',
                                'creditLiabilityAccountStatusType' => $data[31] ?? '',
                                'creditLiabilityMonthlyPaymentAmount' => $data[39] ?? '',
                                'creditLiabilityPastDueAmount' => $data[10] ?? '',
                                'creditLiabilityTermsSourceType' => '',
                                'creditLiabilityUnpaidBalanceAmount' => '',
                                'creditLoanType' => $data[1] ?? '',
                                'detailCreditBusinessType' => '',
                                'date_incurred' => $incuredDate ?? '',
                                'csv_data' => $path ?? ''
                            ];
                    CrsCreditReport::updateOrCreate($obj, $obj);
                }
            }
        }

        // best case
        if ($software === '2') {
            if ($schedule === 'd') {
                foreach ($fileContents as $index => $line) {
                    if ($index !== 0) {
                        $data = str_getcsv($line);
                        $address = $data[1].((isset($data[2]) && !empty($data[2])) ? ', '.$data[2] : '').((isset($data[3]) && !empty($data[3])) ? ', '.$data[3] : '');
                        $ownership = '';
                        if (isset($data[10]) && !empty($data[10])) {
                            switch ($data[10]) {
                                case '1': $ownership = 'Debtor 1';
                                    break;
                                case '2': $ownership = 'Debtor 2';
                                    break;
                                case '3': $ownership = 'Debtor 1 and Debtor 2';
                                    break;
                                default: $ownership = '';
                                    break;
                            }
                        }
                        $extractedDate = '';
                        if (preg_match('/Opened (\d{2}\/\d{2})/', $data[9] ?? '', $matches)) {
                            $extractedDate = $matches[1];
                        }
                        $extractedDate = DateTimeHelper::formatToMonthYearFromAnyFormat($extractedDate);
                        if ($extractedDate == false) {
                            $extractedDate = DateTimeHelper::formatToMonthYearFromAnyFormat($data[9]);
                        }
                        if ($extractedDate == false) {
                            continue;
                        }
                        $obj = [
                                    'client_id' => $client_id,
                                    'fullName' => $data[0] ?? '',
                                    'address' => $address ?? '',
                                    'city' => $data[4] ?? '',
                                    'state' => $data[5] ?? '',
                                    'zip' => $data[6] ?? '',
                                    'creditBusinessType' => '',
                                    'creditLiabilityAccountIdentifier' => (isset($data[7]) && !empty($data[7]) ? Helper::lastchar($data[7]) : ''),
                                    'creditLiabilityAccountOpenedDate' => '',
                                    'creditLiabilityAccountReportedDate' => '',
                                    'creditLiabilityAccountType' => '',
                                    'creditLiabilityAccountOwnershipType' => $ownership,
                                    'creditLiabilityAccountStatusType' => $data[24] ?? '',
                                    'creditLiabilityMonthlyPaymentAmount' => '',
                                    'creditLiabilityPastDueAmount' => '$'.number_format((float)Helper::validate_key_value(15, $data), 2, '.', ',') ?? '',
                                    'creditLiabilityTermsSourceType' => '',
                                    'creditLiabilityUnpaidBalanceAmount' => '',
                                    'creditLoanType' => 'Secured',
                                    'detailCreditBusinessType' => '',
                                    'date_incurred' => $extractedDate ?? ''
                                ];
                        CrsCreditReport::updateOrCreate($obj, $obj);
                    }
                }
            }
            if ($schedule === 'f') {
                foreach ($fileContents as $index => $line) {
                    if ($index !== 0) {
                        $data = str_getcsv($line);

                        $address = $data[1].((isset($data[2]) && !empty($data[2])) ? ', '.$data[2] : '').((isset($data[3]) && !empty($data[3])) ? ', '.$data[3] : '');
                        $ownership = '';
                        if (isset($data[10]) && !empty($data[10])) {
                            switch ($data[10]) {
                                case '1': $ownership = 'Debtor 1';
                                    break;
                                case '2': $ownership = 'Debtor 2';
                                    break;
                                case '3': $ownership = 'Debtor 1 and Debtor 2';
                                    break;
                                default: $ownership = '';
                                    break;
                            }
                        }
                        $extractedDate = '';
                        if (preg_match('/Opened (\d{2}\/\d{2})/', $data[9] ?? '', $matches)) {
                            $extractedDate = $matches[1];
                        }

                        $extractedDate = DateTimeHelper::formatToMonthYearFromAnyFormat($extractedDate);
                        if ($extractedDate == false) {
                            $extractedDate = DateTimeHelper::formatToMonthYearFromAnyFormat($data[9]);
                        }

                        if ($extractedDate == false) {
                            continue;
                        }

                        $obj = [
                                    'client_id' => $client_id,
                                    'fullName' => $data[0] ?? '',
                                    'address' => $address ?? '',
                                    'city' => $data[4] ?? '',
                                    'state' => $data[5] ?? '',
                                    'zip' => $data[6] ?? '',
                                    'creditBusinessType' => '',
                                    'creditLiabilityAccountIdentifier' => (isset($data[7]) && !empty($data[7]) ? Helper::lastchar($data[7]) : ''),
                                    'creditLiabilityAccountOpenedDate' => '',
                                    'creditLiabilityAccountReportedDate' => '',
                                    'creditLiabilityAccountType' => '',
                                    'creditLiabilityAccountOwnershipType' => $ownership,
                                    'creditLiabilityAccountStatusType' => $data[21] ?? '',
                                    'creditLiabilityMonthlyPaymentAmount' => '',
                                    'creditLiabilityPastDueAmount' => '$'.number_format((float)Helper::validate_key_value(15, $data), 2, '.', ',') ?? '',
                                    'creditLiabilityTermsSourceType' => $data[21] ?? '',
                                    'creditLiabilityUnpaidBalanceAmount' => '',
                                    'creditLoanType' => 'Unsecured',
                                    'detailCreditBusinessType' => '',
                                    'date_incurred' => $extractedDate ?? ''
                                ];

                        CrsCreditReport::updateOrCreate($obj, $obj);
                    }
                }
            }
        }
    }

    public function import_unsecured_to_client(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'] ?? '';
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return redirect()->back()->with('error', 'Invalid Request.');
            }
            if ($client_id < 1) {
                return redirect()->back()->with('error', 'Invalid Request.');
            }
            $unsecuredArray = array_keys(AddressHelper::getDebtSelection());
            array_push($unsecuredArray, 'unsecured');
            $crsData = CrsCreditReport::where(['client_id' => $client_id, 'is_imported' => 0])
                        ->whereIn(DB::raw('lower(creditLoanType)'), $unsecuredArray)->get()->toArray();
            $user = \App\Models\User::where('id', $client_id)->first();
            $debtstax = CacheDebt::getDebtData($client_id);
            $debt_tax = Helper::validate_key_value('debt_tax', $debtstax, 'array');

            if (!empty($debt_tax) && is_array($debt_tax)) {
                $total_count = count($debt_tax) + count($crsData);
                if ($total_count > 125) {
                    return response()->json(Helper::renderJsonError("Oops! Maximum 125 Debt taxes allowed."))->header('Content-Type: application/json;', 'charset=utf-8');
                }
            }
            $debt_tax = !empty($debt_tax) ? $debt_tax : [];
            if (!empty($crsData) && is_array($crsData)) {
                $reportIds = [];
                foreach ($crsData as $report) {
                    $creditLiabilityAccountOwnershipType = $report['creditLiabilityAccountOwnershipType'] ?? '';
                    $owned_by = 1;
                    switch (strtolower($creditLiabilityAccountOwnershipType)) {
                        case 'debtor 1': $owned_by = 1;
                            break;
                        case 'debtor 2': $owned_by = 2;
                            break;
                        case 'debtor 1 and debtor 2': $owned_by = 3;
                            break;
                        default: break;
                    }
                    $date = $report['date_incurred'];
                    $dateArray = explode("/", $report['date_incurred']);
                    if (is_array($dateArray) && count($dateArray) == 3) {
                        $date = $dateArray[0].'/'.$dateArray[2];
                    }
                    $dateFormatted = DateTimeHelper::formatToMonthYearFromAnyFormat($date);
                    if ($dateFormatted == false) {
                        continue;
                    }
                    $tax = $this->getTaxArray($report, $report['date_incurred'], $owned_by);
                    $tax['original_creditor'] = 1;
                    $tax['is_debt_three_months'] = 0;
                    if ($owned_by == 2 && $user->client_type == 3) {
                        $codebtor = Helper::getCodebtorAddress($client_id);
                        $tax['codebtor_creditor_name'] = $codebtor['name'];
                        $tax['codebtor_creditor_name_addresss'] = $codebtor['address'];
                        $tax['codebtor_creditor_city'] = $codebtor['city'];
                        $tax['codebtor_creditor_state'] = $codebtor['state'];
                        $tax['codebtor_creditor_zip'] = $codebtor['zip'];
                    }
                    $reportIds[] = $report['id'];
                    array_push($debt_tax, $tax);
                }

                $row = [];
                $row['client_id'] = $client_id;
                $row['debt_tax'] = json_encode($debt_tax);
                $row['does_not_have_additional_creditor'] = 1;
                DebtsTax::updateOrCreate(['client_id' => $client_id], $row);

                // clear cache for client debt
                CacheDebt::forgetDebtCache($client_id);

                CrsCreditReport::whereIn('id', $reportIds)->update(['is_imported' => 1]);

                return response()->json(Helper::renderJsonSuccess("Record Imported Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            return response()->json(Helper::renderJsonError("No Unsecured debt(s) left to Import."))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    private function getTaxArray($report, $date = '', $owned_by = '')
    {
        $creditLiabilityType = $report['creditLiabilityAccountStatusType'] ?? '';
        $debt_type = '';

        switch (strtolower($creditLiabilityType)) {
            case 'credit card':             $debt_type = 2;
                break;
            case 'credit card purchases':   $debt_type = 2;
                break;
            case 'collection account':      $debt_type = 3;
                break;
            case 'educational':             $debt_type = 5;
                break;
            case 'law suit':                $debt_type = 6;
                break;
            case 'cash advances':           $debt_type = 7;
                break;
            default: $debt_type = 4;
                break;
        }
        $dateArray = explode("/", $date);
        if (is_array($dateArray) && count($dateArray) == 3) {
            $date = $dateArray[0].'/'.$dateArray[2];
        }
        $amounttosave = (float)str_replace(['$', ','], '', $report['creditLiabilityPastDueAmount']);
        $dateFormatted = DateTimeHelper::formatToMonthYearFromAnyFormat($date); // returns mm/yyyy from any format and return date('m/Y') if $ date is empty or null

        return  [
                    "cards_collections" => $debt_type,
                    "creditor_name" => $report['fullName'],
                    "amount_number" => Helper::lastchar($report['creditLiabilityAccountIdentifier']),
                    "creditor_information" => $report['address'],
                    "debt_date" => $dateFormatted,
                    "creditor_city" => $report['city'],
                    "creditor_state" => $report['state'],
                    "creditor_zip" => $report['zip'],
                    "amount_owned" => !empty($amounttosave) ? $amounttosave : '0.00',
                    "owned_by" => $owned_by,
                    "codebtor_creditor_name" => null,
                    "codebtor_creditor_name_addresss" => null,
                    "codebtor_creditor_city" => null,
                    "codebtor_creditor_state" => null,
                    "codebtor_creditor_zip" => null,
                    "original_creditor" => 1,
                    "is_debt_three_months" => 0,
                ];
    }

    public function delete_crs_creditor(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = $input['client_id'];
            $ids = $input['ids'];
            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if ($client_id < 1) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if (is_array($ids) && !empty($ids)) {
                CrsCreditReport::where(['client_id' => $client_id])->whereIn('id', $ids)->delete();

                return response()->json(Helper::renderJsonSuccess("Records deleted Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

    }

    public function save_creditor_incurred_date(Request $request)
    {
        if ($request->isMethod('post')) {
            $recordId = $request->input('recordId', '');
            $dateValue = $request->input('dateValue', '');
            $client_id = $request->input('client_id', '');

            if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            if ($client_id < 1) {
                return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            CrsCreditReport::where(['id' => $recordId, 'client_id' => $client_id])->update(['date_incurred' => $dateValue]);

            return response()->json(Helper::renderJsonSuccess("Date saved Successfully!"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

}
