<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\CreditCounselingApiData;
use App\Models\ClientDocumentUploadedData;
use Exception;
use App\Helpers\Helper;

class CreditCounselingCertificateWebhookController extends Controller
{
    /**
     * Handle the webhook request for credit counseling certificates
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function webhook(Request $request)
    {
        if (!$request->isMethod('post')) {
            return $this->errorResponse('Invalid request');
        }

        $response = $request->all();

        if (!$this->validateWebhookResponse($response)) {
            return $this->errorResponse('RespStatus should be 1 and UserName should be provided');
        }

        try {
            $clientId = $this->getClientId($response['UserName']);

            if ($clientId <= 0) {
                return $this->errorResponse('UserName not matched in BKQ system');
            }

            $this->updateCreditCounselingData($response);

            if ($this->shouldDownloadCertificate($response)) {
                $this->downloadAndStoreCertificate($clientId, $response);
            }

            return $this->successResponse('Certificate has been saved');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Validate the webhook response structure
     *
     * @param array $response
     * @return bool
     */
    private function validateWebhookResponse(array $response): bool
    {
        return isset($response['RespStatus']) &&
               isset($response['UserName']) &&
               !empty($response['UserName']);
    }

    /**
     * Get client ID by username
     *
     * @param string $username
     * @return int
     */
    private function getClientId(string $username): int
    {
        return CreditCounselingApiData::where('username', $username)
            ->value('client_id') ?? 0;
    }

    /**
     * Update or create credit counseling data
     *
     * @param array $response
     */
    private function updateCreditCounselingData(array $response): void
    {
        $dataToUpdate = [
            'username' => $response['UserName'],
            'status' => 1,
            'certificateStatus' => json_encode($response),
            'updated_at' => now(),
        ];

        CreditCounselingApiData::updateOrCreate(
            ["username" => $response['UserName']],
            $dataToUpdate
        );
    }

    /**
     * Check if certificate should be downloaded
     *
     * @param array $response
     * @return bool
     */
    private function shouldDownloadCertificate(array $response): bool
    {
        return isset($response['CourseCert']) &&
               $this->isValidPdfUrl($response['CourseCert']) &&
               !empty($response['CourseCert']);
    }

    /**
     * Download and store the certificate
     *
     * @param int $clientId
     * @param array $response
     * @throws \Exception
     */
    private function downloadAndStoreCertificate(int $clientId, array $response): void
    {
        $fileResponse = Http::timeout(300)->get($response['CourseCert']);

        if (!$fileResponse->successful()) {
            throw new Exception("Failed to download file. HTTP status: " . $fileResponse->status());
        }

        ClientDocumentUploadedData::uploadCcCertificate(
            $clientId,
            $fileResponse,
            $response
        );
    }

    /**
     * Validate PDF URL
     *
     * @param string $url
     * @return bool
     */
    private function isValidPdfUrl(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Return success response
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function successResponse(string $message)
    {
        return response()->json(Helper::renderApiSuccess($message, []), 200);
    }

    /**
     * Return error response
     *
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse(string $message)
    {
        return response()->json(Helper::renderApiError($message), 401);
    }
}
