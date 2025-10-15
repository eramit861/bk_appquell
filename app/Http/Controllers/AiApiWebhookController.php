<?php

namespace App\Http\Controllers;

use App\Models\PdfToJson;
use Illuminate\Http\Request;
use Exception;
use Helper;
use App\Helpers\ClientHelper;

class AiApiWebhookController extends Controller
{
    public function webhook(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->errorResponse('Invalid request');
        }

        // Check if UID exists in URL
        $uid = $request->route('uid');
        if (empty($uid)) {
            return $this->errorResponse('UID not available in URL');
        }
        $jobstatus = \App\Models\PdfToJson::STATUS_FAILED;
        $apiResponse = $request->all();
        // Log UID and posted data
        \Log::info("Live webhook received for UID: {$uid}");
        \Log::info("Webhook payload: " . json_encode($apiResponse));
        try {
            $requestData = $this->getRequestData($uid);
            if (empty($requestData)) {
                return $this->errorResponse('UID not matched in BKQ system');
            }

            $request_type = $requestData['request_type'];
            $client_id = $requestData['client_id'];
            $attorneyId = ClientHelper::getClientAttorneyId($client_id);
            switch ($request_type) {
                case 'Debtor_Creditor_Report':
                case 'Co_Debtor_Creditor_Report':
                    $response = $apiResponse['accounts'] ?? [];
                    if (!empty($response)) {
                        $jobstatus = \App\Models\PdfToJson::STATUS_COMPLETED;
                        $other_names = !empty(Helper::validate_key_value('other_names', $response)) ? Helper::validate_key_value('other_names', $response) : [] ;
                        if (!empty($other_names) && $request_type == 'Debtor_Creditor_Report') {
                            PdfToJson::importOtherNamesIntoBasicInfo($other_names, $uid);
                        }
                        if (!empty($other_names) && $request_type == 'Co_Debtor_Creditor_Report') {
                            PdfToJson::importOtherNamesIntoSpouseBasicInfo($other_names, $uid);
                        }
                        PdfToJson::importintoCreditReportFromGraphql($response, $uid);
                    }
                    break;
                case 'Debtor_Pay_Stubs':
                case 'Co_Debtor_Pay_Stubs':
                    $response = $apiResponse['paystubs'] ?? [];
                    if (!empty($response)) {
                        $jobstatus = \App\Models\PdfToJson::STATUS_COMPLETED;
                        PdfToJson::handlePaystubJson($response, $uid);
                    }
                    break;
                default:
                    break;
            }

            \App\Models\PdfToJson::where('refrence_id', $uid)
                ->update([
                    'json' => $apiResponse,
                    'status' => $jobstatus,
                    'updated_at' => date("Y-m-d H:i:s")
                ]);
            cache()->forget('ai_processed_requests_'.$attorneyId);

            return $this->successResponse('Record has been saved');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    private function getRequestData(string $uid)
    {
        $requestData = PdfToJson::where('refrence_id', $uid)
            ->select(['client_id', 'request_type','document_id','employer_id'])
            ->first();

        return !empty($requestData) ? $requestData->toArray() : [];
    }

    private function errorResponse(string $message)
    {
        return response()->json(Helper::renderApiError($message), 401);
    }

    private function successResponse(string $message)
    {
        return response()->json(Helper::renderApiSuccess($message, []), 200);
    }


    public function resend_ai_request(Request $request)
    {
        if (!$request->isMethod('post')) {
            return response()->json(['status' => 'false', 'message' => 'Invalid request']);
        }

        $requestId = $request->input('id');

        if (!$requestId) {
            return response()->json(['status' => 'false', 'message' => 'Missing request ID']);
        }

        $pdfRequest = \App\Models\PdfToJson::find($requestId);

        if (!$pdfRequest) {
            return response()->json(['status' => 'false', 'message' => 'Request not found']);
        }

        // Limit check
        if ($pdfRequest->resend_count >= 3) {
            return response()->json(['status' => 'false', 'message' => 'Resend limit reached for this request.']);
        }

        try {
            $pdfToJson = new \App\Models\PdfToJson();
            $pdfToJson->uploadFileToGraphQl(
                $pdfRequest->client_id,
                '', // placeholder
                $pdfRequest->request_type,
                $pdfRequest->document_id,
                $pdfRequest->employer_id
            );

            // Increment resend count
            $pdfRequest->increment('resend_count');

            return response()->json(['status' => 'success', 'message' => 'AI request resent successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Failed to resend AI request: ' . $e->getMessage()]);
        }
    }
}
