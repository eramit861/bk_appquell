<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Helpers\ArrayHelper;

class CreditorsService
{
    /**
     * @throws \JsonException
     */
    public static function calculateTax($debtsTax): array
    {
        $debtsTax = (!empty($debtsTax)) ? $debtsTax->toArray() : [];

        $result = [];
        if (!empty($debtsTax)) {
            foreach ($debtsTax as $k => $v) {
                if (is_array(json_decode($v, true, 512))) {
                    $result[$k] = json_decode($v, true, 512);
                } else {
                    $result[$k] = $v;
                }
            }
        }

        return $result;
    }



    /**
     * @throws \JsonException
     */
    public static function buildVehicle($vehicle): array
    {
        $loan = json_decode($vehicle['vehicle_car_loan'], true, 512);
        $vehicle_name = ArrayHelper::getVehiclesArray($vehicle['property_type']);
        $vehicle_name .= ', ' . $vehicle['property_year'];
        $vehicle_name .= ', ' . $vehicle['property_make'];
        $vehicle_name .= ', ' . $vehicle['property_model'];
        $vehicle_name .= ', ' . $vehicle['property_mileage'];
        $vehicle_name .= ', ' . $vehicle['property_other_info'];
        $loan['describe_secure_claim'] = $vehicle_name;
        $loan['property_type'] = 'd';
        $loan['debt_owned_by'] = $vehicle['own_by_property'];
        $loan['debt_amount_due'] = $loan['amount_own'];

        return $loan;
    }

    public static function makeCode($debtsTaxes, &$creditors): void
    {
        if (!is_array($debtsTaxes)) {
            $debtsTaxes = [];
        }
        foreach ($debtsTaxes as $debtsTax) {
            if (isset($debtsTax['owned_by'], $debtsTax['codebtor_creditor_name']) && $debtsTax['owned_by'] > 0 && !empty($debtsTax['codebtor_creditor_name']) && in_array(
                $debtsTax['owned_by'],
                Helper::OWNBY_FORM_VALUES,
                true
            )) {
                $creditors[] = self::buildCodeArray($debtsTax);
            }
        }
    }

    public static function buildCodeArray($info): array
    {
        return [
            'creditor_name' => $info['codebtor_creditor_name'],
            'creditor_name_addresss' => $info['codebtor_creditor_name_addresss'],
            'creditor_city' => $info['codebtor_creditor_city'],
            'creditor_state' => $info['codebtor_creditor_state'] ?? '',
            'creditor_zip' => $info['codebtor_creditor_zip']
        ];
    }

    /**
     * @throws \JsonException
     */
    public static function financialAffairs($financialAffairs): array
    {
        $financial_affairs = (!empty($financialAffairs)) ? $financialAffairs->toArray() : [];
        $final_financial_affairs = [];
        if (!empty($financial_affairs)) {
            foreach ($financial_affairs as $k => $v) {
                if (is_array(json_decode($v, true, 512))) {
                    if (in_array($k, ['community_property_state', 'domestic_partner'])) {
                        $final_financial_affairs[$k] = array_values(json_decode($v, true, 512));
                    } else {
                        $final_financial_affairs[$k] = json_decode($v, true, 512);
                    }
                } else {
                    $final_financial_affairs[$k] = $v;
                }
            }
        }

        return $final_financial_affairs;
    }

    public static function additionalLiens($final_debts_tax, &$creditors)
    {
        $additional_liens = $final_debts_tax['additional_liens_data'] ?? [];
        if (!empty($additional_liens)) {
            foreach ($additional_liens as $additional) {
                $creditors[] = [
                    'creditor_name' => $additional['domestic_support_name'] ?? '',
                    'creditor_name_addresss' => $additional['domestic_support_address'] ?? '',
                    'creditor_city' => $additional['domestic_support_city'] ?? '',
                    'creditor_state' => $additional['creditor_state'] ?? '',
                    'creditor_zip' => $additional['domestic_support_zipcode'] ?? '',
                    'account_number' => $additional['additional_liens_account'] ?? '',
                    'debt_incurred_date' => $additional['additional_liens_date'] ?? '',
                    'debt_amount_due' => $additional['additional_liens_due'] ?? '',
                    'describe_secure_claim' => $additional['describe_secure_claim'] ?? '',
                    'debt_owned_by' => $additional['owned_by'] ?? ''
                ];
            }
        }
    }

    public static function debtTaxes($debt_taxes, &$creditors)
    {
        if (!empty($debt_taxes)) {
            foreach ($debt_taxes as $debt_tax) {
                $creditors[] = [
                    'creditor_name' => $debt_tax['creditor_name'] ?? '',
                    'creditor_name_addresss' => $debt_tax['creditor_information'] ?? '',
                    'creditor_city' => $debt_tax['creditor_city'] ?? '',
                    'creditor_state' => $debt_tax['creditor_state'] ?? '',
                    'creditor_zip' => $debt_tax['creditor_zip'] ?? '',
                    'account_number' => $debt_tax['amount_number'] ?? '',
                    'debt_incurred_date' => $debt_tax['debt_date'] ?? '',
                    'debt_amount_due' => $debt_tax['amount_owned'] ?? '',
                    'describe_secure_claim' => '',
                    'debt_owned_by' => ''
                ];
            }
        }
    }

    public static function propertyVehicle($property_vehicle, &$creditors)
    {
        foreach ($property_vehicle as $vehicle) {
            if ($vehicle['own_any_property'] && $vehicle['loan_own_type_property'] == 1 && isset($vehicle['vehicle_car_loan'])) {
                $loan = self::buildVehicle($vehicle);
                if (!empty($creditors)) {
                    if (!empty($loan['creditor_name'])) {
                        $creditors[] = $loan;
                    }
                } else {
                    $creditors[] = $loan;
                }
            }
        }
    }

    public static function financialAffairsInfo($financial_affairs_info, &$creditors)
    {
        if (!empty($financial_affairs_info['community_property_state'])) {
            for ($i = 0, $iMax = count($financial_affairs_info['community_property_state']); $i < $iMax; $i++) {
                if (isset($financial_affairs_info['domestic_partner'][$i]) && !empty(@$financial_affairs_info['domestic_partner'][$i])) {
                    $creditors[] = [
                        'creditor_name' => @$financial_affairs_info['domestic_partner'][$i],
                        'creditor_name_addresss' => @$financial_affairs_info['domestic_partner_street_address'][$i],
                        'creditor_city' => @$financial_affairs_info['domestic_partner_city'][$i],
                        'creditor_state' => @$financial_affairs_info['domestic_partner_state'][$i],
                        'creditor_zip' => @$financial_affairs_info['domestic_partner_zip'][$i]
                    ];
                }
            }
        }
    }

    public static function propertyResident($property_resident, $basicInformation, &$creditors)
    {
        foreach ($property_resident as $val) {
            if ($val['currently_lived'] && $val['loan_own_type_property'] == 1) {
                $propertyName = self::makePopertyName($val, $basicInformation);
                $creditors[] = self::makeLoan($val['home_car_loan'], $propertyName, $val);

                if (!empty($val['home_car_loan2'])) {
                    $thisLoan = self::makeLoan($val['home_car_loan2'], $propertyName, $val);
                    if (isset($thisLoan['additional_loan1']) && !empty($thisLoan['creditor_name']) && $thisLoan['additional_loan1'] == 1) {
                        $creditors[] = $thisLoan;
                    }
                }
                if (!empty($val['home_car_loan3'])) {
                    $thisLoan = self::makeLoan($val['home_car_loan3'], $propertyName, $val);
                    if (isset($thisLoan['additional_loan2']) && !empty($thisLoan['creditor_name']) && $thisLoan['additional_loan2'] == 1) {
                        $creditors[] = $thisLoan;
                    }
                }
            }
        }
    }

    public static function propertyVehicleCode($property_vehicle, &$creditors)
    {
        foreach ($property_vehicle as $vehicle) {
            if (isset($vehicle['own_any_property']) && !empty($vehicle['codebtor_creditor_name']) && $vehicle['own_any_property'] == 1 && in_array(
                $vehicle['own_by_property'],
                Helper::OWNBY_FORM_VALUES,
                true
            )) {
                $creditors[] = self::buildCodeArray($vehicle);
            }
        }
    }

    public static function propertyResidentCode($property_resident, &$creditors)
    {
        foreach ($property_resident as $val) {
            if (isset($val['currently_lived']) && !empty($val['codebtor_creditor_name']) && $val['currently_lived'] == 1 && in_array(
                $val['property_owned_by'],
                Helper::OWNBY_FORM_VALUES,
                true
            )) {
                $creditors[] = self::buildCodeArray($val);
            }
        }
    }

    private static function makePopertyName($val, $basicInformation)
    {
        $propertyName = '';
        $clientAddress = ClientService::buildClientAddress($basicInformation);
        if ($val['not_primary_address'] == 0) {
            $propertyName = $clientAddress;
        } else {
            $propertyName .= $val['mortgage_address'];
            $propertyName .= ', ' . $val['mortgage_city'];
            $propertyName .= ', ' . $val['mortgage_state'];
            $propertyName .= ', ' . $val['mortgage_zip'];
        }

        return $propertyName;
    }

    private static function makeLoan($loan, $propertyName, $val)
    {
        $thisLoan = json_decode($loan, true, 512);
        $thisLoan['describe_secure_claim'] = $propertyName;
        $thisLoan['debt_amount_due'] = $thisLoan['amount_own'];
        $thisLoan['property_type'] = 'd';
        $thisLoan['debt_owned_by'] = $val['property_owned_by'] ?? '';

        return $thisLoan;
    }

}
