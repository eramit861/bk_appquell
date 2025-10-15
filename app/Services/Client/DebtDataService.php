<?php

namespace App\Services\Client;

use App\Models\AttorneySettings;
use App\Models\AttorneySubscription;
use App\Models\Expenses;
use App\Models\FinancialAffairs;
use App\Models\FormsStepsCompleted;
use App\Models\AttorneyDocuments;
use App\Models\Creditors;
use App\Models\CrsCreditReport;
use App\Models\DebtStateTaxes;
use App\Models\PdfToJson;
use App\Models\User;
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use App\Helpers\AddressHelper;
use App\Helpers\VideoHelper;
use Illuminate\Support\Facades\Auth;

class DebtDataService
{
    /**
     * Get bank statement months for attorney
     */
    public function getBankStatementMonths(int $attorneyId): ?int
    {
        $attorneySettings = AttorneySettings::where('attorney_id', $attorneyId)->first();

        return Helper::validate_key_value('bank_statement_months', $attorneySettings);
    }

    /**
     * Check if user should redirect to income
     */
    public function shouldRedirectToIncome(User $user): bool
    {
        return $user->client_subscription == AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION;
    }

    /**
     * Check if user should redirect to no questionnaire
     */
    public function shouldRedirectToNoQuestionnaire(User $user): bool
    {
        return $user->hide_questionnaire && empty($user->client_payroll_assistant);
    }

    /**
     * Get comprehensive client debts data
     */
    public function getClientDebtsData(): array
    {
        $client = Auth::user();
        $clientId = $client->id;
        $clientType = $client->client_type;

        // Parallelize independent database queries
        [$arrayDebtStateTaxes, $progress] = [
            AddressHelper::getStateTaxAddress(),
            FormsStepsCompleted::getStepCompletionData($clientId, $clientType)
        ];

        $clientAttorneyId = Helper::find_client_attorney_id()->attorney_id;
        $package = AttorneySubscription::where('attorney_id', $clientAttorneyId)->first();

        // Cache static data calls
        $stateArray = AddressHelper::getStateListArray();
        $docsUploadInfo = ClientHelper::documentUploadInfo($client, $clientId, $clientAttorneyId);
        $crsReportNotCompleted = PdfToJson::getCrsReportStatus($clientId);
        $crsReportExistsStatus = PdfToJson::getCrsReportExistsStatus($clientId);

        $isConfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($clientAttorneyId);
        $debtstax = CacheDebt::getDebtData($clientId);

        return [
            'listOfFiles' => AttorneyDocuments::getSignedDocuments($clientId, $clientAttorneyId),
            'appservice_codebtors' => Creditors::geCodebtors($clientId, $clientType),
            'progress' => $progress,
            'docsProgress' => ClientHelper::get_uploaded_docs_progress('', $clientId, $clientAttorneyId),
            'debts' => $debtstax,
            'docsUploadInfo' => $docsUploadInfo,
            'progress_percentage' => ClientHelper::checkProgress(),
            'clientAttorneySubPackage' => $package->type ?? '',
            'stateArray' => $stateArray,
            'arrayDebtStateTaxes' => $arrayDebtStateTaxes,
            'isAiProcessedEverExists' => CrsCreditReport::isAiProcessedEverExists($clientId),
            'isAiProcessedClientPendingExists' => CrsCreditReport::isAiProcessedClientPendingExists($clientId),
            'isAiProcessedClientConfirmedExists' => CrsCreditReport::isAiProcessedClientConfirmedExists($clientId),
            'client' => $client,
            'crsReportNotCompleted' => $crsReportNotCompleted,
            'crsReportExistsStatus' => $crsReportExistsStatus,
            'is_confirm_prompt_enabled' => $isConfirmPromptEnabled
        ];
    }

    /**
     * Get credit report videos
     */
    public function getCreditReportVideos(): array
    {
        return [
            'iphone' => VideoHelper::getVideos(VideoHelper::getAdminVideos()[Helper::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE] ?? []),
            'android' => VideoHelper::getVideos(VideoHelper::getAdminVideos()[Helper::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID] ?? []),
            'desktop_laptop' => VideoHelper::getVideos(VideoHelper::getAdminVideos()[Helper::CREDIT_REPORT_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE] ?? [])
        ];
    }

    /**
     * Get debtor and spouse names
     */
    public function getDebtorNames(int $clientId): array
    {
        $BIData = \App\Services\Client\CacheBasicInfo::getBasicInformationData($clientId);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        return [
            'debtorname' => ClientHelper::getDebtorName($clientBasicInfoPartA, ""),
            'spousename' => ClientHelper::getDebtorName($clientBasicInfoPartB, "")
        ];
    }

    /**
     * Remove no credit report input fields
     */
    public function removeNoCreditReportInput(array $data): array
    {
        foreach ($data as $key => $value) {
            if (preg_match('/^document_list_\d+_Debtor_Creditor_Report$/', $key)) {
                unset($data[$key]);
            }
            if (preg_match('/^document_list_\d+_Co_Debtor_Creditor_Report$/', $key)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    /**
     * Transform debt data from input format to final format
     */
    public function transformDebtData(array $debtTaxData): array
    {
        $transformed = [];
        $keys = array_keys($debtTaxData);
        $count = count(reset($debtTaxData));

        for ($i = 0; $i < $count; $i++) {
            foreach ($keys as $key) {
                if (isset($debtTaxData[$key][$i])) {
                    $transformed[$i][$key] = $debtTaxData[$key][$i];
                }
                if ($key == 'list_lawsuits_data' && !empty($debtTaxData[$key]) && is_array($debtTaxData[$key])) {
                    $lawSuitData = [];
                    foreach ($debtTaxData[$key] as $lawSuitKey => $lawSuitValue) {
                        if (is_array($lawSuitValue) && isset($lawSuitValue[$i])) {
                            $lawSuitData[$lawSuitKey] = $lawSuitValue[$i];
                        }
                    }

                    $transformed[$i][$key] = $lawSuitData;
                }
            }
        }

        return $transformed;
    }

    /**
     * Move lawsuit data to SOFA
     */
    public function moveLawsuitDataToSofa(array $debtFinal, int $clientId): void
    {
        if (empty($debtFinal)) {
            return;
        }

        $sofaData = CacheSOFA::getSOFAData($clientId);
        $sofaData['client_id'] = $clientId;

        $existingLawsuits = Helper::validate_key_value('list_lawsuits_data', $sofaData, 'array');
        $existingLawsuits = !empty($existingLawsuits) ? $existingLawsuits : [];

        // Convert existing column-wise structure into row-wise
        $lawsuitRows = [];
        if (!empty($existingLawsuits)) {
            $count = count($existingLawsuits['case_title'] ?? []);
            for ($i = 0; $i < $count; $i++) {
                $lawsuitRows[] = [
                    'case_title' => $existingLawsuits['case_title'][$i] ?? null,
                    'case_number' => $existingLawsuits['case_number'][$i] ?? null,
                    'case_nature' => $existingLawsuits['case_nature'][$i] ?? null,
                    'agency_location' => $existingLawsuits['agency_location'][$i] ?? null,
                    'agency_street' => $existingLawsuits['agency_street'][$i] ?? null,
                    'agency_city' => $existingLawsuits['agency_city'][$i] ?? null,
                    'agency_state' => $existingLawsuits['agency_state'][$i] ?? null,
                    'agency_zip' => $existingLawsuits['agency_zip'][$i] ?? null,
                    'disposition' => $existingLawsuits['disposition'][$i] ?? null,
                ];
            }
        }

        // Process new debt lawsuits
        foreach ($debtFinal as $debt) {
            if (isset($debt['cards_collections']) && $debt['cards_collections'] == "6") {
                if (!empty($debt['list_lawsuits_data'])) {
                    $lawsuitData = $debt['list_lawsuits_data'];

                    // Check if lawsuit already exists (deep compare)
                    $isDuplicate = collect($lawsuitRows)->contains(function ($row) use ($lawsuitData) {
                        return $row == $lawsuitData;
                    });

                    if (!$isDuplicate) {
                        $lawsuitRows[] = $lawsuitData;
                    }
                }
            }
        }

        // Convert back to column-wise format
        $final = [
            'case_title' => [],
            'case_number' => [],
            'case_nature' => [],
            'agency_location' => [],
            'agency_street' => [],
            'agency_city' => [],
            'agency_state' => [],
            'agency_zip' => [],
            'disposition' => [],
        ];

        foreach ($lawsuitRows as $row) {
            $final['case_title'][] = $row['case_title'] ?? null;
            $final['case_number'][] = $row['case_number'] ?? null;
            $final['case_nature'][] = $row['case_nature'] ?? null;
            $final['agency_location'][] = $row['agency_location'] ?? null;
            $final['agency_street'][] = $row['agency_street'] ?? null;
            $final['agency_city'][] = $row['agency_city'] ?? null;
            $final['agency_state'][] = $row['agency_state'] ?? null;
            $final['agency_zip'][] = $row['agency_zip'] ?? null;
            $final['disposition'][] = $row['disposition'] ?? null;
        }

        // Save into SOFA
        $sofaData['list_lawsuits'] = 1;
        $sofaData['list_lawsuits_data'] = json_encode($final);

        FinancialAffairs::updateOrCreate(
            ["client_id" => $clientId],
            $sofaData
        );

        // Clear cache
        CacheSOFA::forgetSOFACache($clientId);
    }

    /**
     * Process back tax data
     */
    public function processBackTaxData(array $backTaxData): array
    {
        if (empty($backTaxData)) {
            return [];
        }

        $checkKeyArray = [
            'codebtor_creditor_name',
            'codebtor_creditor_name_addresss',
            'codebtor_creditor_city'
        ];

        $processedData = [];
        foreach ($backTaxData as $key => $values) {
            foreach ($values as $i => $val) {
                $processedData[$i][$key] = in_array($key, $checkKeyArray)
                    ? ucwords(strtolower($val))
                    : $val;
            }
        }

        return $processedData;
    }

    /**
     * Move IRS back taxes amount to expense
     */
    public function moveIrsBackTaxesAmountToExpense(int $clientId): void
    {
        $debtstax = CacheDebt::getDebtData($clientId);

        $isIRSYEs = Helper::validate_key_value('tax_owned_irs', $debtstax);
        $totalAmount = 0;
        $amountCount = 0;

        if ($isIRSYEs == 1) {
            $taxIRS = Helper::validate_key_value('tax_irs', $debtstax);
            if (!empty($taxIRS)) {
                if (Helper::validate_key_value('is_back_tax_irs_three_months', $taxIRS) == 1) {
                    $totalAmount = $totalAmount + (float) Helper::validate_key_value('total_amount_paid', $taxIRS);
                    $amountCount = $amountCount + 1;
                }
            }
        }

        $isBackTaxesYes = Helper::validate_key_value('tax_owned_state', $debtstax);
        if ($isBackTaxesYes == 1) {
            $backTaxes = Helper::validate_key_value('back_tax_own', $debtstax);
            if (!empty($backTaxes)) {
                foreach ($backTaxes as $backTax) {
                    if (Helper::validate_key_value('is_back_tax_state_three_months', $backTax) == 1) {
                        $totalAmount = $totalAmount + (float) Helper::validate_key_value('total_amount_paid', $backTax);
                        $amountCount = $amountCount + 1;
                    }
                }
            }
        }

        if ($totalAmount > 0) {
            $expense = Expenses::where("client_id", $clientId)->first();
            if (!empty($expense)) {
                $expense = $expense->toArray();
                $result = $totalAmount / $amountCount;
                $formattedResult = number_format($result, 2);
                $expenseDataToUpdate['taxbills_not_deducted'] = 1;
                $expenseDataToUpdate['taxbills_value'] = 'Tax Payment Plan(s)';
                $expenseDataToUpdate['taxbills_price'] = $formattedResult;
                Expenses::where(["id" => $expense['id'], "client_id" => $clientId])->update($expenseDataToUpdate);
            } else {
                $expenseDataToUpdate['taxbills_not_deducted'] = 1;
                $expenseDataToUpdate["client_id"] = $clientId;
                $expenseDataToUpdate['taxbills_value'] = 'Tax Payment Plan(s)';
                $expenseDataToUpdate['taxbills_price'] = $totalAmount;
                Expenses::create($expenseDataToUpdate);
            }
            CacheExpense::forgetExpenseCache($clientId);
        }
    }

    /**
     * Move DSO debts to SOFA
     */
    public function moveDsoDebtsToSofa(array $dsoData, int $clientId): void
    {
        $sofaData = CacheSOFA::getSOFAData($clientId);
        $dataToUpdate = [];

        if (!empty($dsoData)) {
            $sofaData['client_id'] = $clientId;
            foreach ($dsoData as $index => $data) {
                $addLast3Payments = Helper::validate_key_value('is_domestic_support_three_months', $data, 'radio');
                $dataToUpdate['creditor_address_past_one_year'][$index] = Helper::validate_key_value('domestic_support_name', $data);
                $dataToUpdate['creditor_street_past_one_year'][$index] = Helper::validate_key_value('domestic_support_address', $data);
                $dataToUpdate['creditor_city_past_one_year'][$index] = Helper::validate_key_value('domestic_support_city', $data);
                $dataToUpdate['creditor_state_past_one_year'][$index] = Helper::validate_key_value('creditor_state', $data);
                $dataToUpdate['creditor_zip_past_one_year'][$index] = Helper::validate_key_value('domestic_support_zipcode', $data);
                $dataToUpdate['past_one_year_payment_1'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('payment_1', $data) : '';
                $dataToUpdate['past_one_year_payment_dates'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('payment_dates_1', $data) : '';
                $dataToUpdate['past_one_year_payment_2'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('payment_2', $data) : '';
                $dataToUpdate['past_one_year_payment_dates2'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('payment_dates_2', $data) : '';
                $dataToUpdate['past_one_year_payment_3'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('payment_3', $data) : '';
                $dataToUpdate['past_one_year_payment_dates3'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('payment_dates_3', $data) : '';
                $dataToUpdate['past_one_year_total_amount_paid'][$index] = ($addLast3Payments == 1) ? Helper::validate_key_value('total_amount_paid', $data) : '';
                $dataToUpdate['past_one_year_amount_still_owed'][$index] = Helper::validate_key_value('domestic_support_past_due', $data);
                $dataToUpdate['past_one_year_payment_reason'][$index] = 'Payments for Child Support/Alimony from ' . $data['domestic_address_state'] . ' Court Order.';
            }
            $sofaData['payment_past_one_year'] = 1;
            $sofaData['past_one_year_data'] = json_encode($dataToUpdate);

            // update or create
            FinancialAffairs::updateOrCreate(
                ["client_id" => $clientId],
                $sofaData
            );

            // clear cache for client SOFA
            CacheSOFA::forgetSOFACache($clientId);
        }
    }

    /**
     * Move domestic to creditor report
     */
    public function moveDomesticToCreditorReport(array $finaldebts): void
    {
        foreach ($finaldebts as $input) {
            $domesticSupportName = Helper::validate_key_value('domestic_support_name', $input);
            if (isset($domesticSupportName) && !empty($domesticSupportName)) {
                $dataTosave = [
                    'client_id' => Auth::user()->id,
                    'fullName' => Helper::validate_key_value('domestic_support_name', $input),
                    'creditLiabilityAccountIdentifier' => Helper::validate_key_value('domestic_support_account', $input),
                    'address' => Helper::validate_key_value('domestic_support_address', $input),
                    'city' => Helper::validate_key_value('domestic_support_city', $input),
                    'state' => Helper::validate_key_value('creditor_state', $input),
                    'zip' => Helper::validate_key_value('domestic_support_zipcode', $input),
                    'creditLoanType' => 9,
                    'client_confirm' => Helper::NO,
                    'manual_added_by_client' => Helper::YES,
                    'creditLiabilityUnpaidBalanceAmount' => Helper::validate_key_value('domestic_support_past_due', $input)
                ];
                CrsCreditReport::updateOrCreate($dataTosave, $dataTosave);
            }
        }
    }

    /**
     * Move back taxes to creditor report
     */
    public function moveBackTaxesToCreditorReport(array $backtaxes): void
    {
        foreach ($backtaxes as $input) {
            $statecode = Helper::validate_key_value('debt_state', $input);
            if (!empty($statecode)) {
                $item = AddressHelper::getStateTaxAddress($statecode);
                $ownedBy = Helper::validate_key_value('owned_by', $input, 'radio');
                $dataTosave = [
                    'client_id' => Auth::user()->id,
                    'fullName' => Helper::validate_key_value('address_heading', $item),
                    'creditLiabilityAccountIdentifier' => '',
                    'address' => Helper::validate_key_value('add1', $item) . ',' . Helper::validate_key_value('add2', $item),
                    'city' => Helper::validate_key_value('city', $item),
                    'state' => $statecode,
                    'zip' => Helper::validate_key_value('zip', $item),
                    'creditLoanType' => 8,
                    'creditLiabilityAccountOwnershipType' => (isset($ownedBy) && $ownedBy == 1 ? 'INDIVIDUAL' : 'JOINT'),
                    'client_confirm' => Helper::NO,
                    'manual_added_by_client' => Helper::YES,
                    'creditLiabilityUnpaidBalanceAmount' => Helper::validate_key_value('tax_total_due', $input),
                    'creditLiabilityAccountReportedDate' => Helper::validate_key_value('tax_whats_year', $input)
                ];
                CrsCreditReport::updateOrCreate($dataTosave, $dataTosave);
            }
        }
    }

    /**
     * Move IRS taxes to creditor report
     */
    public function moveIRSTaxesToCreditorReport(array $input): void
    {
        $statecode = Helper::validate_key_value('tax_irs_state', $input);
        if (!empty($statecode)) {
            $item = Helper::irsState($statecode);
            $taxIrsOwnedBy = Helper::validate_key_value('tax_irs_owned_by', $input, 'radio');
            $dataTosave = [
                'client_id' => Auth::user()->id,
                'fullName' => Helper::validate_key_value('address_heading', $item),
                'creditLiabilityAccountIdentifier' => '',
                'address' => Helper::validate_key_value('add1', $item) . ',' . Helper::validate_key_value('add2', $item),
                'city' => Helper::validate_key_value('city', $item),
                'state' => $statecode,
                'zip' => Helper::validate_key_value('zip', $item),
                'creditLoanType' => 8,
                'creditLiabilityAccountOwnershipType' => (isset($taxIrsOwnedBy) && $taxIrsOwnedBy == 1 ? 'INDIVIDUAL' : 'JOINT'),
                'client_confirm' => Helper::NO,
                'manual_added_by_client' => Helper::YES,
                'creditLiabilityUnpaidBalanceAmount' => Helper::validate_key_value('tax_irs_total_due', $input),
                'creditLiabilityAccountReportedDate' => Helper::validate_key_value('tax_irs_whats_year', $input)
            ];
            CrsCreditReport::updateOrCreate($dataTosave, $dataTosave);
        }
    }

    /**
     * Create new expense record
     */
    public function createNewExpenseRecord(int $clientId, array $expenseData): void
    {
        if (
            !isset(
                $expenseData['installmentpayments_value'],
                $expenseData['installmentpayments_price'],
                $expenseData['installmentpayments_type']
            )
        ) {
            return;
        }

        $combined = array_map(
            fn ($v, $p, $t) => compact('v', 'p', 't'),
            $expenseData['installmentpayments_value'],
            $expenseData['installmentpayments_price'],
            $expenseData['installmentpayments_type']
        );

        array_multisort(array_column($combined, 't'), $combined);

        Expenses::create([
            'client_id' => $clientId,
            'installmentpayments_value' => json_encode(array_column($combined, 'v')),
            'installmentpayments_price' => json_encode(array_column($combined, 'p')),
            'installmentpayments_type' => json_encode(array_column($combined, 't'))
        ]);
    }

    /**
     * Get common view data for debt summaries
     */
    public function getCommonDebtViewData(int $clientId, User $client): array
    {
        return [
            'stateArray' => AddressHelper::getStateListArray(),
            'arrayDebtStateTaxes' => DebtStateTaxes::groupBy("stax_name")
                ->select([
                    'stax_name as address_heading',
                    'stax_address1 as add1',
                    'stax_address2 as add2',
                    'stax_address3 as add3',
                    'stax_city as city',
                    'stax_state as code',
                    'stax_zip as zip',
                    'stax_contact'
                ])
                ->orderBy('stax_name', "asc")
                ->whereNotNull("stax_name")
                ->get()
                ->toArray(),
            'appservice_codebtors' => Creditors::geCodebtors($clientId, $client->client_type),
            'debts' => CacheDebt::getDebtData($clientId)
        ];
    }
}
