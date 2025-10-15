<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttorneyCinReportController extends AttorneyController
{
    public function cin_report_upload(Request $request)
    {
        ini_set('max_execution_time', 300);
        if ($request->isMethod('post')) {
            $clientId = $request->input('client_id');
            $document_type = $request->input('document_type');
            $file = $request->file('document_file');
            if (is_array($file)) {
                $file = $file[0] ?? null;
            }
            if (!$file || !$file instanceof \Illuminate\Http\UploadedFile) {
                return response()->json(['error' => 'No valid file uploaded'], 400);
            }

            if (!\App\Models\User::isCreditReportEnabledForClient($clientId, $document_type)) {
                \App\Models\ClientDocumentUploaded::storeClientSideDocument($clientId, $file, $document_type, '', 1);

                return response()->json(Helper::renderJsonSuccess('Document has been uploaded successfully.'));
            }
            if (\App\Models\User::isCreditReportEnabledForClient($clientId, $document_type)) {
                try {
                    $pdfToJson = new \App\Models\PdfToJson();
                    $resData = $pdfToJson->uploadFileToGraphQl($clientId, $file, $document_type);
                    Log::info('uploaded file response: ' . json_encode($resData));
                    if (isset($resData['data']['scrapeDocument']['success']) && $resData['data']['scrapeDocument']['success'] == 1) {
                        return response()->json(Helper::renderJsonSuccess('Document has been uploaded successfully. The Magic takes some time. We will notify you when its done.'))->header('Content-Type: application/json;', 'charset=utf-8');
                    } else {
                        return response()->json(Helper::renderJsonError('Invalid file, Please try again'))->header('Content-Type: application/json;', 'charset=utf-8');
                    }
                } catch (\Exception $e) {
                    Log::error('Error uploading report: ' . $e->getMessage());

                    return response()->json(Helper::renderJsonError('Invalid file, Please try again'))->header('Content-Type: application/json;', 'charset=utf-8');
                }
            }
        }
    }


    public function cin_report_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id < 1) {
            return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return view('attorney.client.cin_import_popup', ['client_id' => $client_id]);
    }

    public function cin_report_review(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id < 1) {
            return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        $uploadedStatus = \App\Models\PdfToJson::where(['client_id' => $client_id,'request_type' => 'credit_report','company_name' => 'bestcase'])->first();
        $uploadedStatus = !empty($uploadedStatus) ? $uploadedStatus->toArray() : [];
        $responseJson = [];
        $refrenceId = 0;
        if (!empty($uploadedStatus)) {
            $responseJson = $uploadedStatus['json'];
            $refrenceId = $uploadedStatus['refrence_id'];
        }
        $responseJson = $this->formatCinReportData($responseJson);

        return view('attorney.client.cin_import_review', ['refrenceId' => $refrenceId,'creditorData' => $responseJson, 'client_id' => $client_id]);
    }

    private function formatCinReportData($creditorData)
    {
        $json = json_decode($creditorData, 1);
        $data = $json['data'];
        $pages = $data['pages'];

        $finalcreditors = [];
        foreach ($pages as $page) {
            if (isset($page['data'])) {
                $loans = json_decode($page['data'], 1);
                if (isset($loans['non_mortgage_liabilities_with_balances'])) {
                    $creditors = [];
                    $creditors = $loans['non_mortgage_liabilities_with_balances'];
                    foreach ($creditors as $credit) {
                        $finalcreditors[] = $credit;
                    }
                }
            }
        }

        return $finalcreditors;
    }

    public function cin_report_save(Request $request)
    {

        $input = $request->all();
        $client_id = $input['client_id'];
        $refrence_id = $input['refrence_id'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($client_id < 1) {
            return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }


        $responseJson = \App\Models\PdfToJson::where(['client_id' => $client_id,'refrence_id' => $refrence_id])->first();
        $responseJson = !empty($responseJson) ? $responseJson->toArray() : [];
        if (!empty($responseJson)) {
            $responseJson = $this->formatCinReportData($responseJson['json']);
            foreach ($responseJson as $creditor) {
                $address = '';
                $accntno = '';
                $address = ($creditor['address']['attn'] ?? '').','.($creditor['address']['address'] ?? '');
                $accntno = $creditor['account_number'] ?? '';
                $accntno = !empty($accntno) ? substr($accntno, -4) : '';
                $obj = [
                    'client_id' => $client_id,
                    'fullName' => $creditor['creditor_name'] ?? '',
                    'address' => $address,
                    'city' => $creditor['address']['city'] ?? '',
                    'state' => $creditor['address']['state'] ?? '',
                    'zip' => $creditor['address']['zipCode'] ?? '',
                    'creditBusinessType' => '',
                    'creditLiabilityAccountIdentifier' => $accntno,
                    'creditLiabilityAccountOpenedDate' => '',
                    'creditLiabilityAccountReportedDate' => '',
                    'creditLiabilityAccountType' => '',
                    'creditLiabilityAccountOwnershipType' => 'Debtor 1',
                    'creditLiabilityAccountStatusType' => $creditor['account_type'] ?? '',
                    'creditLiabilityMonthlyPaymentAmount' => $creditor['monthly_payment'] ?? '',
                    'creditLiabilityPastDueAmount' => $creditor['past_due'] ?? '',
                    'creditLiabilityTermsSourceType' => '',
                    'creditLiabilityUnpaidBalanceAmount' => '',
                    'creditLoanType' => ''  ,
                    'detailCreditBusinessType' => '',
                    'date_incurred' => $creditor['date_opened'] ?? ''
                ];
                \App\Models\CrsCreditReport::updateOrCreate($obj, $obj);
            }
        }
        \App\Models\PdfToJson::where(['client_id' => $client_id,'refrence_id' => $refrence_id])->update(['status' => 4,'updated_at' => date('Y-m-d H:i:s')]);

        return response()->json(Helper::renderJsonSuccess("Records Saved Successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }


}
