<?php

namespace App\Models;

use App\Helpers\Helper;
use App\Services\CreditorsService;
use App\Services\Attorney\BciService;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheDebt;
use App\Services\Client\CacheProperty;
use App\Services\Client\CacheSOFA;
use Illuminate\Database\Eloquent\Model;
use JsonException;

class Creditors extends Model
{
    /**
     * @throws JsonException
     */
    public function download_cliet_creditors($user, $basic_info, $propertyInfo): array
    {


        $BasicInfoPartA = $basic_info['BasicInfoPartA'];
        $property_resident = $propertyInfo['propertyresident'];
        $property_vehicle = $propertyInfo['propertyvehicle'];
        $client_id = $user->id;
        $financial_affairs_info = CacheSOFA::getSOFAData($client_id);

        $creditors = [];
        $final_debts_tax = CacheDebt::getDebtData($client_id);

        CreditorsService::propertyResident($property_resident, $BasicInfoPartA, $creditors);

        CreditorsService::propertyVehicle($property_vehicle, $creditors);

        CreditorsService::additionalLiens($final_debts_tax, $creditors);

        $debt_taxes = [];
        if (!empty($final_debts_tax['debt_tax']) && count($final_debts_tax['debt_tax']) > 0) {
            $debt_taxes = $final_debts_tax['debt_tax'];
        }

        CreditorsService::debtTaxes($debt_taxes, $creditors);
        CreditorsService::propertyResidentCode($property_resident, $creditors);
        CreditorsService::propertyVehicleCode($property_vehicle, $creditors);

        if (!empty($final_debts_tax)) {
            CreditorsService::makeCode($final_debts_tax['debt_tax'], $creditors);
            CreditorsService::makeCode($final_debts_tax['back_tax_own'], $creditors);

            if (in_array($final_debts_tax['tax_irs_owned_by'], Helper::OWNBY_FORM_VALUES, true)) {
                $cod = [
                    'creditor_name' => $final_debts_tax['tax_irs_codebtor_creditor_name'] ?? '',
                    'creditor_name_addresss' => $final_debts_tax['tax_irs_codebtor_creditor_name_addresss'] ?? '',
                    'creditor_city' => $final_debts_tax['tax_irs_codebtor_creditor_city'] ?? '',
                    'creditor_state' => $final_debts_tax['tax_irs_codebtor_creditor_state'] ?? '',
                    'creditor_zip' => $final_debts_tax['tax_irs_codebtor_creditor_zip'] ?? ''
                ];
                $creditors[] = $cod;
            }

            CreditorsService::makeCode($final_debts_tax['additional_liens_data'], $creditors);
        }

        CreditorsService::financialAffairsInfo($financial_affairs_info, $creditors);

        if (!empty($creditors)) {
            usort($creditors, static function ($a, $b) {
                return strnatcasecmp($a['creditor_name'], $b['creditor_name']);
            });
        }

        return $creditors;
    }

    /**
     * @throws JsonException
     */

    public static function geCodebtors($client_id, $clientType)
    {
        $debtors = [];
        if ($clientType == 3) {
            $BIData = CacheBasicInfo::getBasicInformationData($client_id);
            $BasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

            $jointDebtorname = '';
            $jointDebtorname .= Helper::validate_key_value('name', $BasicInfoPartB);
            $jointDebtorname .= " ". Helper::validate_key_value('middle_name', $BasicInfoPartB);
            $jointDebtorname .= " ". Helper::validate_key_value('last_name', $BasicInfoPartB);

            $address = Helper::validate_key_value('Address', $BasicInfoPartB);
            $city = Helper::validate_key_value('City', $BasicInfoPartB);
            $state = strtoupper(Helper::validate_key_value('state', $BasicInfoPartB));
            $zip = Helper::validate_key_value('zip', $BasicInfoPartB);

            if (isset($BasicInfoPartB['spouse_different_address']) && $BasicInfoPartB['spouse_different_address'] != 1) {
                $BasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
                $address = Helper::validate_key_value('Address', $BasicInfoPartA);
                $city = Helper::validate_key_value('City', $BasicInfoPartA);
                $state = strtoupper(Helper::validate_key_value('state', $BasicInfoPartA));
                $zip = Helper::validate_key_value('zip', $BasicInfoPartA);
            }
            $joint = [
                'codebtor_creditor_name' => $jointDebtorname,
                'codebtor_creditor_name_addresss' => $address,
                'codebtor_creditor_city' => $city,
                'codebtor_creditor_state' => $state,
                'codebtor_creditor_zip' => $zip,

            ];
            $debtors = BciService::buildDebtorsData($debtors, $joint);
        }

        $clientPropertyData = CacheProperty::getPropertyData($client_id);
        $propertyresident = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
        $propertyresident = !empty($propertyresident) ? $propertyresident->toArray() : [];

        $propertyvehicle = Helper::validate_key_value('propertyvehicle', $clientPropertyData, 'array');
        $propertyvehicle = !empty($propertyvehicle) ? $propertyvehicle->toArray() : [];

        $final_debtstax = CacheDebt::getDebtData($client_id);
        ;

        foreach ($propertyresident as $val) {
            $thisloan = json_decode($val['home_car_loan'], 1);
            $debtors = app(BciService::class)->getMortgage1Codebtor($val, $thisloan, $debtors);
            $thisloan = json_decode($val['home_car_loan2'], 1);
            $debtors = app(BciService::class)->getMortgage1Codebtor($val, $thisloan, $debtors);
            $thisloan = json_decode($val['home_car_loan3'], 1);
            $debtors = app(BciService::class)->getMortgage1Codebtor($val, $thisloan, $debtors);
        }

        $debtors = self::getvehicleCodebtor($propertyvehicle, $debtors);

        $debtors = self::getSchHDebtTax($final_debtstax, $debtors);
        $debtors = self::getSchHTaxOwned($final_debtstax, $debtors);
        $debtors = self::getSchHIrs($final_debtstax, $debtors);
        $debtors = self::getSchHLiens($final_debtstax, $debtors);

        $finaldebtor = [];
        if (!empty($debtors)) {
            foreach ($debtors as $debt) {
                $zipadd = explode("-", $debt['codebtor_creditor_zip']);
                $debt['codebtor_creditor_zip'] = isset($zipadd[0]) ? $zipadd[0] : '';
                if (!in_array($debt, $finaldebtor)) {
                    $finaldebtor[] = $debt;
                }
            }
        }

        return $finaldebtor;
    }

    private static function getvehicleCodebtor($propertyvehicle, $debtors)
    {
        foreach ($propertyvehicle as $veh) {
            if (isset($veh['own_any_property']) && $veh['own_any_property'] == 1 && $veh['loan_own_type_property'] == 1) {
                if (in_array($veh['own_by_property'], Helper::OWNBY_FORM_VALUES) && !empty($veh['codebtor_creditor_name'])) {
                    $debtors = BciService::buildDebtorsData($debtors, $veh);
                }
            }
        }

        return $debtors;
    }

    private static function getSchHDebtTax($final_debtstax, $debtors)
    {
        if (empty($final_debtstax['debt_tax'])) {
            return $debtors;
        }
        foreach ($final_debtstax['debt_tax'] as $dt) {
            if (isset($dt['owned_by'])) {
                if (in_array($dt['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    $debtors = BciService::buildDebtorsData($debtors, $dt);
                }
            }
        }

        return $debtors;
    }

    private static function getSchHTaxOwned($final_debtstax, $debtors)
    {
        if (Helper::validate_key_value('tax_owned_state', $final_debtstax) == 1) {
            foreach ($final_debtstax['back_tax_own'] as $dt) {
                if (isset($dt['owned_by']) && in_array($dt['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    $debtors = BciService::buildDebtorsData($debtors, $dt);
                }
            }
        }

        return $debtors;
    }

    private static function getSchHIrs($final_debtstax, $debtors)
    {
        if (Helper::validate_key_value('tax_owned_irs', $final_debtstax) == 1
            && in_array($final_debtstax['tax_irs_owned_by'], Helper::OWNBY_FORM_VALUES)) {
            $debtors = BciService::buildDebtorsDataForIrs($debtors, $final_debtstax);
        }

        return $debtors;
    }

    private static function getSchHLiens($final_debtstax, $debtors)
    {
        if (Helper::validate_key_value('additional_liens', $final_debtstax) == 1) {
            foreach ($final_debtstax['additional_liens_data'] as $dt) {
                if (isset($dt['owned_by']) && in_array($dt['owned_by'], Helper::OWNBY_FORM_VALUES)) {
                    $debtors = BciService::buildDebtorsData($debtors, $dt);
                }
            }
        }

        return $debtors;
    }

}
