<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Helper;
use App\Helpers\AddressHelper;
use App\Models\FinancialAffairs;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheSOFA;
use Illuminate\Support\Facades\Log;

class MoveDebtsToSofa implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $client_id;
    public function __construct($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        try {
            // Fetch all needed data in as few queries as possible
            $alldebtsArr = CacheDebt::getDebtData($this->client_id);

            $final_finacial_affairs = CacheSOFA::getSOFAData($this->client_id);
            $debtsData = $final_finacial_affairs['primarily_consumer_debets_data'] ?? [];

            // Remove keys in one go
            $debtsData = Helper::updateAllLoanPayments($debtsData, [3, 6]);
            $debtsData = Helper::updatePaymentsInDebtsData($debtsData);

            // Decode all JSON fields once, outside the loops
            $decoded = [
                'debt_tax' => Helper::validate_key_value('debt_tax', $alldebtsArr, 'array'),
                'back_tax_own' => Helper::validate_key_value('back_tax_own', $alldebtsArr, 'array'),
                'domestic_tax' => Helper::validate_key_value('domestic_tax', $alldebtsArr, 'array'),
                'additional_liens_data' => Helper::validate_key_value('additional_liens_data', $alldebtsArr, 'array'),
                'tax_irs' => Helper::validate_key_value('tax_irs', $alldebtsArr, 'array'),
            ];

            // Pre-fetch state tax addresses and IRS state data for all unique states used
            $stateCodes = [];
            $domesticTax = is_array($decoded['domestic_tax']) ? $decoded['domestic_tax'] : [];
            $backTaxOwn = is_array($decoded['back_tax_own']) ? $decoded['back_tax_own'] : [];
            foreach (array_merge($backTaxOwn, $domesticTax) as $row) {
                if (!empty($row['debt_state'])) {
                    $stateCodes[] = $row['debt_state'];
                }
                if (!empty($row['domestic_address_state'])) {
                    $stateCodes[] = $row['domestic_address_state'];
                }
            }
            $stateCodes = array_unique(array_filter($stateCodes));
            $stateTaxAddresses = [];
            foreach ($stateCodes as $code) {
                $stateTaxAddresses[$code] = AddressHelper::getStateTaxAddress($code);
            }
            $irsStateCode = Helper::validate_key_value('tax_irs_state', $alldebtsArr);
            $irsStateData = $irsStateCode ? Helper::irsState($irsStateCode) : [];

            // Helper for pushing creditor data
            $pushCreditor = function (&$debtsData, $item, $valueData, $amountStillOwedKey, $paymentFor = "6") {
                $debtsData['creditor_address'][] = $item['address_heading'] ?? ($valueData['creditor_name'] ?? '');
                $debtsData['creditor_street'][] = ($item['add1'] ?? '') . (isset($item['add2']) && $item['add2'] ? ', ' . $item['add2'] : '');
                $debtsData['creditor_city'][] = $item['city'] ?? ($valueData['creditor_city'] ?? '');
                $debtsData['creditor_state'][] = $item['code'] ?? ($valueData['creditor_state'] ?? '');
                $debtsData['creditor_zip'][] = $item['zip'] ?? ($valueData['creditor_zip'] ?? '');
                $debtsData['payment_1'][] = $valueData['payment_1'] ?? '';
                $debtsData['payment_2'][] = $valueData['payment_2'] ?? '';
                $debtsData['payment_3'][] = $valueData['payment_3'] ?? '';
                $debtsData['payment_dates'][] = $valueData['payment_dates_1'] ?? '';
                $debtsData['payment_dates2'][] = $valueData['payment_dates_2'] ?? '';
                $debtsData['payment_dates3'][] = $valueData['payment_dates_3'] ?? '';
                $debtsData['total_amount_paid'][] = $valueData['total_amount_paid'] ?? '';
                $debtsData['amount_still_owed'][] = $valueData[$amountStillOwedKey] ?? '';
                $debtsData['creditor_payment_for'][] = $paymentFor;
            };

            // Unsecured Creditors
            if (!empty($decoded['debt_tax']) && is_array($decoded['debt_tax'])) {
                foreach ($decoded['debt_tax'] as $valueData) {
                    if (
                        Helper::validate_key_value('is_debt_three_months', $valueData) == 1 &&
                        Helper::validate_key_value('total_amount_paid', $valueData) >= 600
                    ) {
                        $paymentFor = Helper::validate_key_value('cards_collections', $valueData) == 2 ? "3" : "6";
                        $pushCreditor($debtsData, [], $valueData, 'amount_owned', $paymentFor);
                    }
                }
            }

            // Back Taxes Creditors
            if (!empty($decoded['back_tax_own']) && is_array($decoded['back_tax_own'])) {
                foreach ($decoded['back_tax_own'] as $valueData) {
                    if (
                        Helper::validate_key_value('is_back_tax_state_three_months', $valueData) == 1 &&
                        Helper::validate_key_value('total_amount_paid', $valueData) >= 600
                    ) {
                        $code = Helper::validate_key_value('debt_state', $valueData);
                        $item = $stateTaxAddresses[$code] ?? [];
                        $pushCreditor($debtsData, $item, $valueData, 'tax_total_due');
                    }
                }
            }

            // IRS Creditors
            if (Helper::validate_key_value('tax_owned_irs', $alldebtsArr, 'radio') == 1 && !empty($decoded['tax_irs'])) {
                $tax_irs = $decoded['tax_irs'];
                if (
                    Helper::validate_key_value('is_back_tax_irs_three_months', $tax_irs) == 1 &&
                    Helper::validate_key_value('total_amount_paid', $tax_irs) >= 600
                ) {
                    $pushCreditor($debtsData, $irsStateData, $tax_irs, 'tax_irs_total_due');
                }
            }

            // DSO Creditors
            if (!empty($decoded['domestic_tax']) && is_array($decoded['domestic_tax'])) {
                foreach ($decoded['domestic_tax'] as $valueData) {
                    if (
                        Helper::validate_key_value('is_domestic_support_three_months', $valueData) == 1 &&
                        Helper::validate_key_value('total_amount_paid', $valueData) >= 600
                    ) {
                        $code = Helper::validate_key_value('domestic_address_state', $valueData);
                        $item = $stateTaxAddresses[$code] ?? [];
                        $pushCreditor($debtsData, $item, $valueData, 'domestic_support_past_due');
                    }
                }
            }

            // Additional Liens Creditors
            if (!empty($decoded['additional_liens_data']) && is_array($decoded['additional_liens_data'])) {
                foreach ($decoded['additional_liens_data'] as $valueData) {
                    if (
                        Helper::validate_key_value('is_add_liens_three_months', $valueData) == 1 &&
                        Helper::validate_key_value('total_amount_paid', $valueData) >= 600
                    ) {
                        // No state lookup for additional liens, just use valueData fields
                        $pushCreditor($debtsData, [], $valueData, 'additional_liens_due');
                    }
                }
            }

            $final_finacial_affairs['primarily_consumer_debets'] = 1;
            $final_finacial_affairs['primarily_consumer_debets_data'] = json_encode($debtsData);

            // Only update if changed, to avoid unnecessary DB writes
            $financialData = FinancialAffairs::where('client_id', $this->client_id)->first();
            if ($financialData) {
                $existing = $financialData->primarily_consumer_debets_data;
                if ($existing !== $final_finacial_affairs['primarily_consumer_debets_data']) {
                    FinancialAffairs::where(['id' => $financialData->id, 'client_id' => $this->client_id])
                        ->update($final_finacial_affairs);
                }
            } else {
                $final_finacial_affairs['client_id'] = $this->client_id;
                FinancialAffairs::create($final_finacial_affairs);
            }

            // clear cache for client SOFA
            CacheSOFA::forgetSOFACache($this->client_id);
        } catch (\Exception $e) {
            Log::info('error moving the debts to sofa:'.$e->getMessage());
        }
    }
}
