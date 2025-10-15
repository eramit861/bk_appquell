<?php

namespace App\Services\Attorney;

use App\Helpers\Helper;

class BciService
{
    public function getMortgage1Codebtor($val, $thisloan, $debtors, $CLinkID = "")
    {
        if (empty($thisloan)) {
            return $debtors;
        }
        if (isset($val['currently_lived']) && $val['currently_lived'] == 1 && isset($thisloan['property_owned_by']) && in_array($thisloan['property_owned_by'], Helper::OWNBY_FORM_VALUES) && !empty($thisloan['codebtor_creditor_name'])) {
            $debtors = self::buildDebtorsData($debtors, $thisloan, $CLinkID);
        }

        return $debtors;
    }

    public static function buildDebtorsData($debtors, $thisloan, $CLinkID = "")
    {
        $cod = [
            'codebtor_creditor_name' => Helper::validate_key_value_exclude_comma('codebtor_creditor_name', $thisloan),
            'codebtor_creditor_name_addresss' => Helper::validate_key_value_exclude_comma('codebtor_creditor_name_addresss', $thisloan),
            'codebtor_creditor_city' => Helper::validate_key_value_exclude_comma('codebtor_creditor_city', $thisloan),
            'codebtor_creditor_state' => Helper::validate_key_value_exclude_comma('codebtor_creditor_state', $thisloan),
            'codebtor_creditor_zip' => self::formatZipCode(Helper::validate_key_value_exclude_comma('codebtor_creditor_zip', $thisloan)),
            'codebtor_cLink_id' => $CLinkID ?? ''
        ];

        $debtors[] = $cod;

        return $debtors;
    }

    public static function buildDebtorsDataForIrs($debtors, $thisloan, $CLinkID = "")
    {
        $cod = [
            'codebtor_creditor_name' => Helper::validate_key_value_exclude_comma('tax_irs_codebtor_creditor_name', $thisloan),
            'codebtor_creditor_name_addresss' => Helper::validate_key_value_exclude_comma('tax_irs_codebtor_creditor_name_addresss', $thisloan),
            'codebtor_creditor_city' => Helper::validate_key_value_exclude_comma('tax_irs_codebtor_creditor_city', $thisloan),
            'codebtor_creditor_state' => Helper::validate_key_value_exclude_comma('tax_irs_codebtor_creditor_state', $thisloan),
            'codebtor_creditor_zip' => self::formatZipCode(Helper::validate_key_value_exclude_comma('tax_irs_codebtor_creditor_zip', $thisloan)),
            'codebtor_cLink_id' => $CLinkID ?? ''
        ];

        $debtors[] = $cod;

        return $debtors;
    }

    public static function buildSchDefContent(
        $schDefContent,
        $domestic,
        $nameKey,
        $addressKey,
        $cityKey,
        $stateKey,
        $zipKey,
        $accountKey,
        $pastDueKey,
        $owned_by,
        $address2Key = "",
        $address3Key = "",
        $pastDueDateKey = "",
        $mainData = [],
        $type = 'E'
    ) {
        $debt_creditor_name = Helper::validate_key_value_exclude_comma($nameKey, $domestic);
        $debt_creditor_address1 = Helper::validate_key_value_exclude_comma($addressKey, $domestic);
        $debt_creditor_city = Helper::validate_key_value_exclude_comma($cityKey, $domestic);
        $debt_creditor_state = Helper::validate_key_value_exclude_comma($stateKey, $domestic);
        $debt_creditor_zip = self::formatZipCode(Helper::validate_key_value_exclude_comma($zipKey, $domestic));
        $debt_acc_no = Helper::validate_key_value_exclude_comma($accountKey, $domestic);
        $CLinkID = Helper::validate_key_value_exclude_comma("CLinkID", $domestic);
        $maskAcct = Helper::validate_key_value_exclude_comma("maskAcct", $domestic);
        $property_type = Helper::validate_key_value_exclude_comma("taxesDate", $domestic);
        $taxesTotalDue = Helper::validate_key_value_exclude_comma("taxesTotalDue", $domestic);
        $index = "";
        $debt_creditor_address2 = "";
        $debt_claim_amt = Helper::validate_key_value_exclude_comma($pastDueKey, !empty($mainData) ? $mainData : $domestic);
        if (!empty($address2Key)) {
            $debt_creditor_address2 = Helper::validate_key_value_exclude_comma($address2Key, $domestic);
        }
        $debt_creditor_address3 = "";
        if (!empty($address3Key)) {
            $debt_creditor_address3 = Helper::validate_key_value_exclude_comma($address3Key, $domestic);
        }
        $debt_incurred_date = "";
        if (!empty($pastDueDateKey)) {
            $debt_incurred_date = Helper::validate_key_value_exclude_comma($pastDueDateKey, !empty($mainData) ? $mainData : $domestic);
        }
        $schDefContent .= $CLinkID . ",".$owned_by.",". $type .",".$debt_creditor_name.",".$debt_creditor_address1.",".$debt_creditor_address2.",".$debt_creditor_address3.",".$debt_creditor_city.",".$debt_creditor_state.",".$debt_creditor_zip.",,".$debt_acc_no.",". $maskAcct .",".$debt_incurred_date.",,,,,".$debt_claim_amt.",,,,,,,,,,".$property_type.",". $taxesTotalDue .",". $index .",,,,,,,\r\n";

        return $schDefContent;
    }

    public static function buildAnpContent($anpContent, $domestic, $CLinkID)
    {
        $address_name = Helper::validate_key_value_exclude_comma("address_name", $domestic);
        $address_line1 = Helper::validate_key_value_exclude_comma("address_street", $domestic);
        $address_line2 = Helper::validate_key_value_exclude_comma("address_line2", $domestic);
        $address_line3 = "";
        $address_city = Helper::validate_key_value_exclude_comma("address_city", $domestic);
        $address_state = Helper::validate_key_value_exclude_comma("address_state", $domestic);
        $address_zip = self::formatZipCode(Helper::validate_key_value_exclude_comma("address_zip", $domestic));
        $phone = "";
        $acc_no = Helper::validate_key_value_exclude_comma("domestic_support_account", $domestic);

        $notify_address_name = Helper::validate_key_value_exclude_comma("notify_address_name", $domestic);
        $notify_address_line1 = Helper::validate_key_value_exclude_comma("notify_address_street", $domestic);
        $notify_address_line2 = Helper::validate_key_value_exclude_comma("notify_address_line2", $domestic);
        $notify_address_city = Helper::validate_key_value_exclude_comma("notify_address_city", $domestic);
        $notify_address_zip = self::formatZipCode(Helper::validate_key_value_exclude_comma("notify_address_zip", $domestic));


        $anpContent .= $address_name.",".$address_line1.",".$address_line2.",".$address_line3.",".$address_city.",".$address_state.",".$address_zip.",". $phone . ",".$acc_no.",". $CLinkID ."\r\n";
        $anpContent .= $notify_address_name.",".$notify_address_line1.",".$notify_address_line2.",".$address_line3.",".$notify_address_city.",".$address_state.",".$notify_address_zip.",". $phone . ",".$acc_no.",". $CLinkID ."\r\n";

        return $anpContent;
    }

    public static function formatZipCode($zip)
    {
        $parts = explode('-', $zip);

        return $parts[0] . '-0000';
    }

}
