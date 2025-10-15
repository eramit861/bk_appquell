<?php

namespace App\Services\Client;

use App\Helpers\Helper;
use App\Models\IncomeDebtorMonthlyIncome;
use App\Models\IncomeDebtorSpouseMonthlyIncome;
use App\Models\ClientsAttorney;
use App\Models\User;
use App\Models\ClientParalegal;
use App\Models\AttorneySettings;
use App\Models\ParalegalSettings;
use App\Mail\ClientFirstLogin;
use Illuminate\Support\Facades\Mail;

class ClientBasicInfoBusinessService
{
    /**
     * Update business names to income data
     * Pure business logic for processing business information
     */
    public function updateBusinessNamesToIncome($client_id, $data)
    {
        $names = $data['own_business_name'];
        $types = $data['own_business_selection'];
        $stillOpens = Helper::validate_key_value('business_still_open', $data) ?? [];
        $D1TypeArray = [];
        $D2TypeArray = [];

        $profitLossKeys = [
            'profit_loss_business_name',
            'profit_loss_business_name_2',
            'profit_loss_business_name_3',
            'profit_loss_business_name_4',
            'profit_loss_business_name_5',
            'profit_loss_business_name_6'
        ];

        $d1Count = 0;
        $d2Count = 0;

        if (!empty($stillOpens)) {
            foreach ($types as $key => $type) {
                if ($type == 0 && $d1Count < 4 && Helper::validate_key_value($key, $stillOpens, 'radio') == 1) {
                    $D1TypeArray[$profitLossKeys[$d1Count]] = $names[$key];
                    $d1Count++;
                }

                if ($type == 1 && $d2Count < 4 && Helper::validate_key_value($key, $stillOpens, 'radio') == 1) {
                    $D2TypeArray[$profitLossKeys[$d2Count]] = $names[$key];
                    $d2Count++;
                }
            }

            if (!empty($D1TypeArray)) {
                $D1TypeArray['operation_business'] = 1;
                IncomeDebtorMonthlyIncome::updateOrCreate(['client_id' => $client_id], $D1TypeArray);
            }
            if (!empty($D2TypeArray)) {
                $D2TypeArray['joints_operation_business'] = 1;
                IncomeDebtorSpouseMonthlyIncome::updateOrCreate(['client_id' => $client_id], $D2TypeArray);
            }

            CacheIncome::forgetIncomeCache($client_id);
        }
    }

    /**
     * Handle first login business logic
     * Processes first login, updates user status, and sends notifications
     */
    public function handleFirstLogin(User $client, $attorney)
    {
        $client->update(['logged_in_ever' => 1, 'recommned_password_update' => 0]);

        try {
            $clientParalegal = ClientParalegal::where('client_id', $client->id)->first();
            $attorneyData = User::find($clientParalegal ? $clientParalegal->paralegal_id : $attorney->attorney_id);

            if (AttorneySettings::isEmailEnabled($attorney->attorney_id, 'attorney_client_first_login_mail')) {
                $mail = Helper::getAttorneyEmailArray($attorneyData->id);
                $sendTo = ParalegalSettings::getMailSendToId(
                    $client->id,
                    $mail,
                    !empty($client->parent_attorney_id)
                );

                Mail::to($sendTo)->send(new ClientFirstLogin($client, $attorneyData->name));
            }
        } catch (\Exception $e) {
            // Log the exception if needed
        }
    }

    /**
     * Get attorney data for client
     * Data access method
     */
    public function getAttorneyData($client_id)
    {
        return ClientsAttorney::where("client_id", $client_id)->first();
    }

    /**
     * Get basic info data
     * Data access method
     */
    public function getBasicInfoData($client_id)
    {
        return CacheBasicInfo::getBasicInformationData($client_id);
    }
}
