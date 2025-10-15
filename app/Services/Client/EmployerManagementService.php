<?php

namespace App\Services\Client;

use App\Models\AttorneyEmployerInformationToClient;
use App\Models\IncomeDebtorEmployer;
use App\Models\IncomeDebtorSpouseEmployer;
use App\Models\ClientsAssociate;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class EmployerManagementService
{
    /**
     * Sync employer data to attorney table
     */
    public function syncEmployerToAttorney(array $employerData, int $clientType, int $clientId, int $attorneyId, int $employerType): void
    {
        if (empty($employerData)) {
            return;
        }

        $dateTime = now()->format('Y-m-d H:i:s');

        foreach ($employerData as $data) {
            $condition = ['id' => Helper::validate_key_value('id', $data, 'radio')];

            $empInfoToClientData = [
                'attorney_id' => $attorneyId,
                'client_id' => $clientId,
                'employer_type' => $employerType,
                'employer_occupation' => Helper::validate_key_value('employer_occupation', $data),
                'employment_duration' => Helper::validate_key_value('employment_duration', $data),
                'start_date' => Helper::validate_key_value('start_date', $data),
                'end_date' => Helper::validate_key_value('end_date', $data),
                'frequency' => Helper::validate_key_value('frequency', $data),
                'twice_month_selection' => Helper::validate_key_value('twice_month_selection', $data),
                'client_type' => $clientType,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'employer_name' => Helper::validate_key_value('employer_name', $data),
                'employer_address' => Helper::validate_key_value('employer_address', $data),
                'employer_city' => Helper::validate_key_value('employer_city', $data),
                'employer_state' => Helper::validate_key_value('employer_state', $data),
                'employer_zip' => Helper::validate_key_value('employer_zip', $data),
                'notes' => (Helper::validate_key_value('has_notes', $data, 'radio') == 1)
                    ? Helper::validate_key_value('notes', $data)
                    : '',
            ];

            if (AttorneyEmployerInformationToClient::where($condition)->exists()) {
                AttorneyEmployerInformationToClient::where($condition)->update($empInfoToClientData);
            } else {
                AttorneyEmployerInformationToClient::create($empInfoToClientData);
            }
        }
    }

    /**
     * Delete employer data from attorney table
     */
    public function deleteEmployerToAttorney(int $clientId, int $attorneyId, int $employerType, int $clientType): void
    {
        $condition = [
            'attorney_id' => $attorneyId,
            'client_id' => $clientId,
            'employer_type' => $employerType,
            'client_type' => $clientType,
        ];

        AttorneyEmployerInformationToClient::where($condition)->delete();
    }

    /**
     * Sync radio data in employer table
     */
    public function syncRadioDataInEmployerTable(int $clientId, string $modal, int $currEmpRadioStatus, int $prevEmpRadioStatus): void
    {
        $dateTime = now()->format('Y-m-d H:i:s');
        $condition = ['client_id' => $clientId];

        $dataToSave = [
            'client_id' => $clientId,
            'current_employed' => $currEmpRadioStatus,
            'recieved_any_income' => $prevEmpRadioStatus,
            'created_on' => $dateTime,
            'updated_on' => $dateTime,
        ];

        $modal::updateOrCreate($condition, $dataToSave);
        CacheIncome::forgetIncomeCache($clientId);
    }

    /**
     * Sync radio data for previous employer
     */
    public function syncRadioDataInEmployerTableForPreviousEmployer(int $clientId, string $modal, int $prevEmpRadioStatus): void
    {
        $dateTime = now()->format('Y-m-d H:i:s');
        $condition = ['client_id' => $clientId];

        $dataToSave = [
            'client_id' => $clientId,
            'recieved_any_income' => $prevEmpRadioStatus,
            'created_on' => $dateTime,
            'updated_on' => $dateTime,
        ];

        $modal::updateOrCreate($condition, $dataToSave);
        CacheIncome::forgetIncomeCache($clientId);
    }

    /**
     * Handle employer separate save with transaction
     */
    public function handleEmployerSeparateSave(array $inputData, int $clientId): array
    {
        DB::beginTransaction();

        try {
            $fileName = Helper::validate_key_value('fileName', $inputData);
            $isDelete = Helper::validate_key_value('isDelete', $inputData);
            $assetType = Helper::validate_key_value('assetType', $inputData);
            $assetData = Helper::validate_key_value('previous_employer', $inputData);
            $employerType = 2;

            [$clientType, $debType, $modal] = $this->determineClientTypeAndModal($assetType);
            $attorneyId = AttorneyEmployerInformationToClient::getClientAttorneyId($clientId);

            if ($isDelete == "true") {
                $this->handleEmployerDeletion($clientId, $attorneyId, $employerType, $clientType, $assetData);
            }

            $this->processEmployerData($assetData, $clientId, $attorneyId, $employerType, $clientType, $modal);

            $existingAsset = AttorneyEmployerInformationToClient::getCurrentEmployerData($clientType, $clientId, $attorneyId, $employerType);

            DB::commit();

            return [
                'status' => true,
                'html' => view('client.questionnaire.income.common.' . $fileName, [
                    'previousEmployerData' => $existingAsset,
                    'debType' => $debType
                ])->render()
            ];
        } catch (\Exception $e) {
            DB::rollBack();

            return [
                'status' => false,
                'message' => 'Something went wrong, try again.'
            ];
        }
    }

    /**
     * Determine client type and modal based on asset type
     */
    private function determineClientTypeAndModal(string $assetType): array
    {
        switch ($assetType) {
            case 'previous_employer_self':
                return [1, 'self', IncomeDebtorEmployer::class];
            case 'previous_employer_spouse':
                return [2, 'spouse', IncomeDebtorSpouseEmployer::class];
            default:
                return [1, 'self', IncomeDebtorEmployer::class];
        }
    }

    /**
     * Handle employer deletion logic
     */
    private function handleEmployerDeletion(int $clientId, int $attorneyId, int $employerType, int $clientType, array $assetData): void
    {
        $existingAsset = AttorneyEmployerInformationToClient::where([
            'client_id' => $clientId,
            'employer_type' => $employerType,
            'client_type' => $clientType,
        ])->get()->toArray();

        if (!empty($existingAsset)) {
            $submittedIds = collect($assetData)->pluck('id')->filter()->map(fn ($id) => (int)$id)->toArray();
            $existingIds = collect($existingAsset)->pluck('id')->map(fn ($id) => (int)$id)->toArray();
            $deletedIds = array_diff($existingIds, $submittedIds);

            if (!empty($deletedIds)) {
                AttorneyEmployerInformationToClient::where([
                    'attorney_id' => $attorneyId,
                    'client_id' => $clientId,
                    'employer_type' => $employerType,
                    'client_type' => $clientType,
                ])->whereIn('id', $deletedIds)->delete();
            }
        }
    }

    /**
     * Process employer data
     */
    private function processEmployerData(array $assetData, int $clientId, int $attorneyId, int $employerType, int $clientType, string $modal): void
    {
        $dateTime = now();

        foreach ($assetData as $data) {
            $employerId = Helper::validate_key_value('id', $data, 'radio');

            $saveData = [
                'attorney_id' => $attorneyId,
                'client_id' => $clientId,
                'employer_type' => $employerType,
                'employer_occupation' => '',
                'employment_duration' => '',
                'start_date' => Helper::validate_key_value('start_date', $data),
                'end_date' => Helper::validate_key_value('end_date', $data),
                'frequency' => Helper::validate_key_value('frequency', $data),
                'twice_month_selection' => Helper::validate_key_value('twice_month_selection', $data),
                'client_type' => $clientType,
                'updated_at' => $dateTime,
                'employer_name' => Helper::validate_key_value('employer_name', $data),
                'employer_address' => '',
                'employer_city' => '',
                'employer_state' => '',
                'employer_zip' => '',
                'notes' => '',
            ];

            if ($employerId) {
                AttorneyEmployerInformationToClient::where('id', $employerId)
                    ->where('client_id', $clientId)
                    ->update($saveData);
            } else {
                $saveData['created_at'] = $dateTime;
                AttorneyEmployerInformationToClient::create($saveData);
            }

            $this->syncRadioDataInEmployerTableForPreviousEmployer($clientId, $modal, 1);
        }
    }

    /**
     * Get attorney ID for client
     */
    public function getClientAttorneyId(int $clientId): int
    {
        $clientsAssociateId = ClientsAssociate::getAssociateId($clientId);

        return !empty($clientsAssociateId)
            ? $clientsAssociateId
            : AttorneyEmployerInformationToClient::getClientAttorneyId($clientId);
    }

    /**
     * Check if client has multiple current employers
     */
    public function hasMultipleCurrentEmployer(int $clientId, int $attorneyId, int $clientType): bool
    {
        return AttorneyEmployerInformationToClient::hasMultipleCurrentEmployer($clientId, $attorneyId, $clientType);
    }
}
