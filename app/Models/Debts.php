<?php

namespace App\Models;

use App\Helpers\AddressHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheDebt;
use Illuminate\Database\Eloquent\Model;

class Debts extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_debts';
    public $timestamps = false;


    public static function getAllDebtCreditorsByType($client_id)
    {
        $final_debtstax = CacheDebt::getDebtData($client_id);
        $returnData = [
            'state_back_tax' => self::getStateBackTaxArray($final_debtstax),
            'irs' => self::getIRSArray($final_debtstax),
            'domestic_support' => self::getDomesticSupportDebtArray($final_debtstax),
            'secured' => self::getSecuredArray($final_debtstax),
            'unsecured' => self::getUnsecuredArray($final_debtstax),
        ];

        return $returnData;
    }

    public static function getSecuredArray($debtsData)
    {
        $returnData = [];
        $yesNo = Helper::validate_key_value('additional_liens', $debtsData, 'radio');
        $debts = Helper::validate_key_value('additional_liens_data', $debtsData, 'array');

        if (empty($debts) || !is_array($debts) || $yesNo !== 1) {
            return $returnData;
        }

        foreach ($debts as $key => $debt) {

            $name = Helper::validate_key_value('domestic_support_name', $debt);
            $address = Helper::validate_key_value('domestic_support_address', $debt);
            $city = Helper::validate_key_value('domestic_support_city', $debt);
            $state = Helper::validate_key_value('creditor_state', $debt);
            $zip = Helper::validate_key_value('domestic_support_zipcode', $debt);

            $returnData[$key] = [
                'name' => $name,
                'address' => $address,
                'misc' => self::getCString($city, $state, $zip)
            ];
        }

        return $returnData;
    }

    public static function getUnsecuredArray($debtsData)
    {
        $returnData = [];
        $debts = Helper::validate_key_value('debt_tax', $debtsData, 'array');

        if (empty($debts) || !is_array($debts)) {
            return $returnData;
        }

        foreach ($debts as $key => $debt) {

            $name = Helper::validate_key_value('creditor_name', $debt);
            $address = Helper::validate_key_value('creditor_information', $debt);
            $city = Helper::validate_key_value('creditor_city', $debt);
            $state = Helper::validate_key_value('creditor_state', $debt);
            $zip = Helper::validate_key_value('creditor_zip', $debt);
            $noticingPartyData = [];

            $originalCreditor = Helper::validate_key_value('original_creditor', $debt);
            if ($originalCreditor != '1') {
                $nameNP = Helper::validate_key_value('second_creditor_name', $debt);
                if (!empty($nameNP)) {
                    $cityNP = Helper::validate_key_value('second_creditor_city', $debt);
                    $stateNP = Helper::validate_key_value('second_creditor_state', $debt);
                    $zipNP = Helper::validate_key_value('second_creditor_zip', $debt);
                    $noticingPartyData[] = [
                        'label' => 'Noticing Party',
                        'name' => $nameNP,
                        'address' => Helper::validate_key_value('second_creditor_information', $debt),
                        'misc' => self::getCString($cityNP, $stateNP, $zipNP)
                    ];
                }
            }

            $returnData[$key] = [
                'name' => $name,
                'address' => $address,
                'misc' => self::getCString($city, $state, $zip),
                'noticingPartyData' => $noticingPartyData
            ];
        }

        return $returnData;
    }


    public static function getStateBackTaxArray($debtsData)
    {
        $returnData = [];
        $debts = Helper::validate_key_value('back_tax_own', $debtsData, 'array');

        if (empty($debts) || !is_array($debts)) {
            return $returnData;
        }

        foreach ($debts as $key => $debt) {
            $statecode = Helper::validate_key_value('debt_state', $debt);
            if (!empty($statecode)) {
                $btitem = AddressHelper::getStateTaxAddress($statecode);

                $name = Helper::validate_key_value('address_heading', $btitem);
                $address = Helper::validate_key_value('add1', $btitem);
                $city = Helper::validate_key_value('city', $btitem);
                $state = Helper::validate_key_value('code', $btitem);
                $zip = Helper::validate_key_value('zip', $btitem);

                $returnData[$key] = [
                    'name' => $name,
                    'address' => $address,
                    'misc' => self::getCString($city, $state, $zip)
                ];
            }

        }

        return $returnData;
    }

    public static function getIRSArray($debtsData)
    {
        $returnData = [];
        $yesNo = Helper::validate_key_value('tax_owned_irs', $debtsData, 'radio');
        if (empty($debtsData) || $yesNo !== 1) {
            return $returnData;
        }

        $name = 'Internal Revenue Service';
        $address = 'P.O. Box 7346';
        $city = 'Philadelphia';
        $state = 'PA';
        $zip = '19101';

        $returnData[0] = [
            'name' => $name,
            'address' => $address,
            'misc' => self::getCString($city, $state, $zip)
        ];

        return $returnData;
    }

    public static function getDomesticSupportDebtArray($debtsData)
    {
        $returnData = [];
        $yesNo = Helper::validate_key_value('domestic_support', $debtsData, 'radio');
        $debts = Helper::validate_key_value('domestic_tax', $debtsData, 'array');

        if (empty($debts) || !is_array($debts) || $yesNo !== 1) {
            return $returnData;
        }

        foreach ($debts as $key => $debt) {
            $noticingPartyData = [];

            $name = Helper::validate_key_value('domestic_support_name', $debt);
            $address = Helper::validate_key_value('domestic_support_address', $debt);
            $city = Helper::validate_key_value('domestic_support_city', $debt);
            $state = Helper::validate_key_value('creditor_state', $debt);
            $zip = Helper::validate_key_value('domestic_support_zipcode', $debt);

            $statecode = Helper::validate_key_value('domestic_address_state', $debt);
            $domesticAddresses = current(AddressHelper::getDomesticAddressStatesList($statecode, false));

            $nameNP = Helper::validate_key_value('address_name', $domesticAddresses);
            if (!empty($nameNP)) {
                $cityNP = Helper::validate_key_value('address_city', $domesticAddresses);
                $stateNP = Helper::validate_key_value('address_state', $domesticAddresses);
                $zipNP = Helper::validate_key_value('address_zip', $domesticAddresses);
                $noticingPartyData[] = [
                    'label' => 'Domestic Address',
                    'name' => $nameNP,
                    'address' => Helper::validate_key_value('address_street', $domesticAddresses),
                    'misc' => self::getCString($cityNP, $stateNP, $zipNP)
                ];
            }

            $nameNP2 = Helper::validate_key_value('notify_address_name', $domesticAddresses);
            if (!empty($nameNP2)) {
                $cityNP2 = Helper::validate_key_value('notify_address_city', $domesticAddresses);
                $stateNP2 = '';
                $zipNP2 = Helper::validate_key_value('notify_address_zip', $domesticAddresses);
                $noticingPartyData[] = [
                    'label' => 'BK Service Address',
                    'name' => $nameNP2,
                    'address' => Helper::validate_key_value('notify_address_street', $domesticAddresses),
                    'misc' => self::getCString($cityNP2, $stateNP2, $zipNP2)
                ];
            }

            $returnData[$key] = [
                'name' => $name,
                'address' => $address,
                'misc' => self::getCString($city, $state, $zip),
                'noticingPartyData' => $noticingPartyData
            ];

        }

        return $returnData;
    }

    public static function getCString($city, $state, $zip)
    {
        $cString = '';
        $cString = $city;
        $cString .= !empty($state) ? ', ' . $state : '';
        $cString .= !empty($zip) ? ', ' . $zip : '';

        return $cString;
    }

    public static function removeSelectedCreditorDebts($request, $final_debtstax, $isBci = false)
    {
        $cWB = (int) $request->query('creditorWithBalance', 0);

        $secured = $request->input('secured', []);
        $unsecured = $request->input('unsecured', []);
        $state_back_tax = $request->input('state_back_tax', []);
        $irs = $request->input('irs', []);
        $domestic_support = $request->input('domestic_support', []);

        if ($isBci) {
            $additional_liens_data = Helper::validate_key_value('additional_liens_data', $final_debtstax, 'array');
            $final_debtstax['additional_liens_data'] = is_string($additional_liens_data) ? json_decode($additional_liens_data, true) : $additional_liens_data;
            $debt_tax = Helper::validate_key_value('debt_tax', $final_debtstax, 'array');
            $final_debtstax['debt_tax'] = is_string($debt_tax) ? json_decode($debt_tax, true) : $debt_tax;
            $back_tax_own = Helper::validate_key_value('back_tax_own', $final_debtstax, 'array');
            $final_debtstax['back_tax_own'] = is_string($back_tax_own) ? json_decode($back_tax_own, true) : $back_tax_own;
            $domestic_tax = Helper::validate_key_value('domestic_tax', $final_debtstax, 'array');
            $final_debtstax['domestic_tax'] = is_string($domestic_tax) ? json_decode($domestic_tax, true) : $domestic_tax;
        }

        if (isset($secured)) {
            $final_debtstax = self::removeSelectedCreditorFromSecuredDebts($final_debtstax, $secured, $cWB);
        }
        if (isset($unsecured)) {
            $final_debtstax = self::removeSelectedCreditorFromUnsecuredDebts($final_debtstax, $unsecured, $cWB);
        }
        if (isset($state_back_tax)) {
            $final_debtstax = self::removeSelectedCreditorFromStateBackTaxDebts($final_debtstax, $state_back_tax, $cWB);
        }
        if (isset($irs)) {
            $final_debtstax = self::removeSelectedCreditorFromIRSDebts($final_debtstax, $irs, $cWB);
        }
        if (isset($domestic_support)) {
            $final_debtstax = self::removeSelectedCreditorFromDomesticSupportDebts($final_debtstax, $domestic_support, $cWB);
        }

        if ($isBci) {
            $additional_liens_data = Helper::validate_key_value('additional_liens_data', $final_debtstax, 'array');
            $final_debtstax['additional_liens_data'] = json_encode($additional_liens_data);
            $debt_tax = Helper::validate_key_value('debt_tax', $final_debtstax, 'array');
            $final_debtstax['debt_tax'] = json_encode($debt_tax);
            $back_tax_own = Helper::validate_key_value('back_tax_own', $final_debtstax, 'array');
            $final_debtstax['back_tax_own'] = json_encode($back_tax_own);
            $domestic_tax = Helper::validate_key_value('domestic_tax', $final_debtstax, 'array');
            $final_debtstax['domestic_tax'] = json_encode($domestic_tax);
        }

        return $final_debtstax;
    }

    public static function removeSelectedCreditorFromSecuredDebts($debtsData, $arrayToCheck, $cWB)
    {
        $yesNo = Helper::validate_key_value('additional_liens', $debtsData, 'radio');
        $debts = Helper::validate_key_value('additional_liens_data', $debtsData, 'array');
        if (empty($debts) || !is_array($debts) || $yesNo !== 1) {
            return $debtsData;
        }

        foreach ($debts as $key => $debt) {
            $balance = Helper::validate_key_value('additional_liens_due', $debt, 'float');
            if ($cWB == 1 && (!isset($balance) || $balance <= 0)) {
                unset($debts[$key]);
            }
            if (!array_key_exists($key, $arrayToCheck)) {
                unset($debts[$key]);
            }
        }

        $debts = array_values($debts);

        $debtsData['additional_liens_data'] = $debts;

        return $debtsData;
    }

    public static function removeSelectedCreditorFromUnsecuredDebts($debtsData, $arrayToCheck, $cWB)
    {
        $debts = Helper::validate_key_value('debt_tax', $debtsData, 'array');
        if (empty($debts) || !is_array($debts)) {
            return $debtsData;
        }

        foreach ($debts as $key => $debt) {
            $balance = Helper::validate_key_value('amount_owned', $debt, 'float');
            if ($cWB == 1 && (!isset($balance) || $balance <= 0)) {
                unset($debts[$key]);
            }
            if (!array_key_exists($key, $arrayToCheck)) {
                unset($debts[$key]);
            }
        }

        $debts = array_values($debts);

        $debtsData['debt_tax'] = $debts;

        return $debtsData;
    }

    public static function removeSelectedCreditorFromStateBackTaxDebts($debtsData, $arrayToCheck, $cWB)
    {
        $debts = Helper::validate_key_value('back_tax_own', $debtsData, 'array');
        if (empty($debts) || !is_array($debts)) {
            return $debtsData;
        }

        foreach ($debts as $key => $debt) {
            $balance = Helper::validate_key_value('tax_total_due', $debt, 'float');
            if ($cWB == 1 && (!isset($balance) || $balance <= 0)) {
                unset($debts[$key]);
            }
            if (!array_key_exists($key, $arrayToCheck)) {
                unset($debts[$key]);
            }
        }

        $debts = array_values($debts);

        $debtsData['back_tax_own'] = $debts;

        return $debtsData;
    }

    public static function removeSelectedCreditorFromIRSDebts($debtsData, $arrayToCheck, $cWB)
    {
        $balance = Helper::validate_key_value('tax_irs_total_due', $debtsData, 'float');
        if ($cWB == 1 && (!isset($balance) || $balance <= 0)) {
            self::getEmptyIrsDebtData($debtsData);
        }
        if (empty($arrayToCheck)) {
            self::getEmptyIrsDebtData($debtsData);
        }

        return $debtsData;
    }

    private static function getEmptyIrsDebtData($data)
    {
        $data['tax_owned_irs'] = 0;
        $data['tax_irs_state'] = '';
        $data['tax_irs_whats_year'] = '';
        $data['tax_irs_total_due'] = '';
        $data['tax_irs_owned_by'] = '';
        $data['tax_irs_codebtor_creditor_name'] = '';
        $data['tax_irs_codebtor_creditor_name_addresss'] = '';
        $data['tax_irs_codebtor_creditor_city'] = '';
        $data['tax_irs_codebtor_creditor_state'] = '';
        $data['tax_irs_codebtor_creditor_zip'] = '';
        $data['tax_irs'] = json_encode(["is_back_tax_irs_three_months" => 0, "payment_1" => null, "payment_dates_1" => date('m/Y', strtotime('-3 month')), "payment_2" => null, "payment_dates_2" => date('m/Y', strtotime('-2 month')), "payment_3" => null, "payment_dates_3" => date('m/Y', strtotime('-1 month')), "total_amount_paid" => null]);

        return $data;
    }

    public static function removeSelectedCreditorFromDomesticSupportDebts($debtsData, $arrayToCheck, $cWB)
    {
        $yesNo = Helper::validate_key_value('domestic_support', $debtsData, 'radio');
        $debts = Helper::validate_key_value('domestic_tax', $debtsData, 'array');

        if (empty($debts) || !is_array($debts) || $yesNo !== 1) {
            return $debtsData;
        }

        foreach ($debts as $key => $debt) {
            $balance = Helper::validate_key_value('domestic_support_past_due', $debt, 'float');
            if ($cWB == 1 && (!isset($balance) || $balance <= 0)) {
                unset($debts[$key]);
            }
            if (!array_key_exists($key, $arrayToCheck)) {
                unset($debts[$key]);
            }
        }

        $debts = array_values($debts);
        $debtsData['domestic_tax'] = $debts;

        return $debtsData;
    }

}
