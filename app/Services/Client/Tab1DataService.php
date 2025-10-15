<?php

namespace App\Services\Client;

use App\Helpers\Helper;
use App\Helpers\ArrayHelper;

class Tab1DataService
{
    public function processTab1Logic($params = [])
    {
        // Extract all the variables that were passed from the Blade file
        $step1 = $params['step1'] ?? false;
        $step2 = $params['step2'] ?? false;
        $client_type = $params['client_type'] ?? null;
        $debtorname = $params['debtorname'] ?? "Debtor's";
        $spousename = $params['spousename'] ?? "Co-Debtor's";
        $BasicInfoPartA = $params['BasicInfoPartA'] ?? [];
        $BasicInfoPartB = $params['BasicInfoPartB'] ?? [];
        $BasicInfo_AnyOtherName = $params['BasicInfo_AnyOtherName'] ?? [];
        $BasicInfo_PartRest = $params['BasicInfo_PartRest'] ?? [];
        $BasicInfo_PartRestD = $params['BasicInfo_PartRestD'] ?? [];
        $phone_no = $params['phone_no'] ?? '';
        $email = $params['email'] ?? '';
        $progress = $params['progress'] ?? [];

        // Original logic from tab1.blade.php
        $title = '';
        $debtorAddressConfirmed = 1;
        $codebtorAddressConfirmed = 1;

        if ($step1) {
            $title = $debtorname . ' Information';
            if (isset($BasicInfoPartA) && !empty($BasicInfoPartA)) {
                $debtorAddressConfirmed = $BasicInfoPartA['dl_address_confirmed'];
            }
        }

        if ($step2) {
            $title = $spousename . ' Information';
            if ($client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) {
                $title = "Non-Filing Spouse's Information";
            }
            if (isset($BasicInfoPartB) && !empty($BasicInfoPartB)) {
                $codebtorAddressConfirmed = $BasicInfoPartB['dl_address_confirmed'];
            }
        }

        $any_other_name_phone_no = Helper::validate_key_value('cell', $BasicInfo_AnyOtherName);
        $any_other_name_phone_no = !empty($any_other_name_phone_no) ? $any_other_name_phone_no : $phone_no;
        $any_other_name_email = Helper::validate_key_value('email', $BasicInfo_AnyOtherName);
        $any_other_name_email = !empty($any_other_name_email) ? $any_other_name_email : $email;

        $usa_states = '{ "AL": "Alabama", "AK": "Alaska", "AS": "American Samoa", "AZ": "Arizona", "AR": "Arkansas", "CA": "California", "CO": "Colorado", "CT": "Connecticut", "DE": "Delaware", "DC": "District Of Columbia", "FM": "Federated States Of Micronesia", "FL": "Florida", "GA": "Georgia", "GU": "Guam", "HI": "Hawaii", "ID": "Idaho", "IL": "Illinois", "IN": "Indiana", "IA": "Iowa", "KS": "Kansas", "KY": "Kentucky", "LA": "Louisiana", "ME": "Maine", "MH": "Marshall Islands", "MD": "Maryland", "MA": "Massachusetts", "MI": "Michigan", "MN": "Minnesota", "MS": "Mississippi", "MO": "Missouri", "MT": "Montana", "NE": "Nebraska", "NV": "Nevada", "NH": "New Hampshire", "NJ": "New Jersey", "NM": "New Mexico", "NY": "New York", "NC": "North Carolina", "ND": "North Dakota", "MP": "Northern Mariana Islands", "OH": "Ohio", "OK": "Oklahoma", "OR": "Oregon", "PW": "Palau", "PA": "Pennsylvania", "PR": "Puerto Rico", "RI": "Rhode Island", "SC": "South Carolina", "SD": "South Dakota", "TN": "Tennessee", "TX": "Texas", "UT": "Utah", "VT": "Vermont", "VI": "Virgin Islands", "VA": "Virginia", "WA": "Washington", "WV": "West Virginia", "WI": "Wisconsin", "WY": "Wyoming" }';
        $usa_states = json_decode($usa_states, 1);
        $suffixArray = ArrayHelper::getSuffixArray();
        $tab1_percentage_by_steps = Helper::validate_key_value('tab1_percentage_by_steps', $progress);

        // Tab data processing
        $step1TabData = Helper::validate_key_value('step1', $tab1_percentage_by_steps);
        $step1PercentDone = Helper::validate_key_value('percentDone', $step1TabData, 'radio');
        $step1PercentTotal = Helper::validate_key_value('percentTotal', $step1TabData, 'radio');
        $step1TabClass = Helper::validate_key_value('tabClass', $step1TabData);

        $step2TabData = Helper::validate_key_value('step2', $tab1_percentage_by_steps);
        $step2PercentDone = Helper::validate_key_value('percentDone', $step2TabData, 'radio');
        $step2PercentTotal = Helper::validate_key_value('percentTotal', $step2TabData, 'radio');
        $step2TabClass = Helper::validate_key_value('tabClass', $step2TabData);

        $step3TabData = Helper::validate_key_value('step3', $tab1_percentage_by_steps);
        $step3PercentDone = Helper::validate_key_value('percentDone', $step3TabData, 'radio');
        $step3PercentTotal = Helper::validate_key_value('percentTotal', $step3TabData, 'radio');
        $step3TabClass = Helper::validate_key_value('tabClass', $step3TabData);

        // Calculate tab names using the same logic as DashboardDataService
        $clientId = $params['client_id'] ?? null;
        $debtorTabName = 'Debtor';
        $codebtorTabName = 'Co-Debtor';

        if ($clientId) {
            $debtorTabName = ArrayHelper::getClientName($clientId, 'Debtor', true);
            $codebtorTabName = ArrayHelper::getCoDebtorName($clientId, 'Co-Debtor', true);

            // For married clients, use "Non-Filing Spouse" instead of "Co-Debtor"
            if ($client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) {
                $codebtorTabName = ArrayHelper::getCoDebtorName($clientId, 'Non-Filing Spouse', true);
            }
        }

        // Return all variables as an array
        return [
            'title' => $title,
            'debtorAddressConfirmed' => $debtorAddressConfirmed,
            'codebtorAddressConfirmed' => $codebtorAddressConfirmed,
            'any_other_name_phone_no' => $any_other_name_phone_no,
            'any_other_name_email' => $any_other_name_email,
            'usa_states' => $usa_states,
            'suffixArray' => $suffixArray,
            'tab1_percentage_by_steps' => $tab1_percentage_by_steps,
            'step1TabData' => $step1TabData,
            'step1PercentDone' => $step1PercentDone,
            'step1PercentTotal' => $step1PercentTotal,
            'step1TabClass' => $step1TabClass,
            'step2TabData' => $step2TabData,
            'step2PercentDone' => $step2PercentDone,
            'step2PercentTotal' => $step2PercentTotal,
            'step2TabClass' => $step2TabClass,
            'step3TabData' => $step3TabData,
            'step3PercentDone' => $step3PercentDone,
            'step3PercentTotal' => $step3PercentTotal,
            'step3TabClass' => $step3TabClass,
            'debtorTabName' => $debtorTabName,
            'codebtorTabName' => $codebtorTabName,
            'BasicInfo_PartRest' => $BasicInfo_PartRest,
            'BasicInfo_PartRestD' => $BasicInfo_PartRestD,
        ];
    }
}
