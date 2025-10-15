<?php

namespace App\Services\Client;

use App\Models\PayStubs;
use App\Models\ClientDocumentUploaded;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaystubManagementService
{
    /**
     * Delete paystub from client side
     */
    public function deletePaystubClientSide(array $input): array
    {
        DB::beginTransaction();

        try {
            $clientId = Helper::validate_key_value('client_id', $input, 'radio');
            $thisPaystubId = Helper::validate_key_value('thisPaystubId', $input, 'radio');
            $thisPaystubDocId = Helper::validate_key_value('thisPaystubDocId', $input, 'radio');

            if ($thisPaystubId) {
                PayStubs::where('id', $thisPaystubId)->delete();

                if ($thisPaystubDocId) {
                    $this->deletePaystubDocument($clientId, $thisPaystubDocId);
                }
            }

            DB::commit();

            return Helper::renderJsonSuccess("Paystub Deleted Successfully.");

        } catch (\Exception $e) {
            DB::rollBack();

            return Helper::renderJsonError("Something went wrong, try again.");
        }
    }

    /**
     * Delete paystub document and related data
     */
    private function deletePaystubDocument(int $clientId, int $docId): void
    {
        $document = ClientDocumentUploaded::where([
            'client_id' => $clientId,
            'id' => $docId
        ])->first();

        if ($document && Storage::disk('s3')->exists($document['document_file'])) {
            Storage::disk('s3')->delete($document['document_file']);
        }

        if ($document && isset($document['id']) && !empty($document['id'])) {
            ClientDocumentUploaded::where('id', $document['id'])->delete();
            ClientDocumentUploaded::where(['relate_to_document' => $document['id']])
                ->update(['relate_to_document' => 0]);
        }
    }

    /**
     * Create dummy paystub entry
     */
    public function createDummyPaystubEntry(array $input, int $docId, string $updatedImageName = '', int $index = 0): void
    {
        PayStubs::dummyPaystubEntry($input, $docId, $updatedImageName, $index);
    }

    /**
     * Import paystub JSON data
     */
    public function importPaystubJson(int $clientId, string $type, int $docId, int $employerId, array $paystub = []): void
    {
        PayStubs::importPaystubJson($clientId, $type, $docId, $employerId, $paystub);
    }

    /**
     * Get paystub data for client
     */
    public function getPaystubData(int $clientId, string $type = "self"): array
    {
        return PayStubs::where([
            'client_id' => $clientId,
            'pinwheel_account_type' => $type
        ])->get()->toArray();
    }

    /**
     * Check if paystub exists for date range
     */
    public function checkPaystubExists(int $clientId, string $type, string $fromDate, string $tillDate): bool
    {
        return PayStubs::where([
            "client_id" => $clientId,
            'pinwheel_account_type' => $type,
            'is_mapped' => 0
        ])
        ->where('pay_date', '>=', $fromDate)
        ->where('pay_date', '<=', $tillDate)
        ->exists();
    }

    /**
     * Get unmapped paystubs
     */
    public function getUnmappedPaystubs(int $clientId, string $type): array
    {
        return PayStubs::where([
            'client_id' => $clientId,
            'pinwheel_account_type' => $type,
            'is_mapped' => 0
        ])->get()->toArray();
    }

    /**
     * Update paystub mapping status
     */
    public function updatePaystubMappingStatus(int $paystubId, int $isMapped = 1): void
    {
        PayStubs::where('id', $paystubId)->update(['is_mapped' => $isMapped]);
    }

    /**
     * Get paystub by ID
     */
    public function getPaystubById(int $paystubId): ?PayStubs
    {
        return PayStubs::find($paystubId);
    }

    /**
     * Delete paystub by ID
     */
    public function deletePaystubById(int $paystubId): bool
    {
        return PayStubs::where('id', $paystubId)->delete() > 0;
    }

    /**
     * Get paystubs for date range
     */
    public function getPaystubsForDateRange(int $clientId, string $type, string $fromDate, string $toDate): array
    {
        return PayStubs::where([
            'client_id' => $clientId,
            'pinwheel_account_type' => $type
        ])
        ->whereBetween('pay_date', [$fromDate, $toDate])
        ->orderBy('pay_date', 'desc')
        ->get()
        ->toArray();
    }

    /**
     * Calculate total gross pay for period
     */
    public function calculateTotalGrossPay(int $clientId, string $type, string $fromDate, string $toDate): float
    {
        $paystubs = $this->getPaystubsForDateRange($clientId, $type, $fromDate, $toDate);

        return array_sum(array_column($paystubs, 'gross_pay_amount'));
    }

    /**
     * Calculate total net pay for period
     */
    public function calculateTotalNetPay(int $clientId, string $type, string $fromDate, string $toDate): float
    {
        $paystubs = $this->getPaystubsForDateRange($clientId, $type, $fromDate, $toDate);

        return array_sum(array_column($paystubs, 'net_pay_amount'));
    }

    /**
     * Get latest paystub for client
     */
    public function getLatestPaystub(int $clientId, string $type): ?PayStubs
    {
        return PayStubs::where([
            'client_id' => $clientId,
            'pinwheel_account_type' => $type
        ])
        ->orderBy('pay_date', 'desc')
        ->first();
    }

    /**
     * Validate paystub data
     */
    public function validatePaystubData(array $paystubData): array
    {
        $errors = [];

        if (empty($paystubData['pay_date'])) {
            $errors[] = 'Pay date is required';
        }

        if (empty($paystubData['gross_pay_amount']) || $paystubData['gross_pay_amount'] < 0) {
            $errors[] = 'Valid gross pay amount is required';
        }

        if (empty($paystubData['net_pay_amount']) || $paystubData['net_pay_amount'] < 0) {
            $errors[] = 'Valid net pay amount is required';
        }

        return $errors;
    }
}
