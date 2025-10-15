@extends('layouts.attorney_form',['chapterName' => $chapterName, 'ch13video' => $ch13video, 'ch7video' => $ch7video])
@section('content') @include("layouts.flash",['auto_close' => false])

<!-- [ Main Content ] start -->
<style>
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

.btn-form {
    cursor: pointer;
    color: #000;
    border: 2px solid #012cae;
    background-color: #fff;
    padding: 10px;
    font-weight: 500 !important;
}

.hide-data {
    display: none !important;
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}
</style>
<script>
var listofexeption = [];
</script>

<?php
$currentDate = date("m/d/Y");
$currentDay = date("d");
$currentMonthNumerical = date("m");
$currentMonth = date("F");
$currentYear = date("Y");
$currentYearShort = date("y");
$attorny_sign = '';
$debtor_sign = '';
$debtor2_sign = '';

$debtor_email = Helper::validate_key_value('email', $clentData);
$meantestDBData = !empty($meantestData) ? $meantestData->toArray() : [];
$meantestPData = isset($meantestDBData['mean_test_data']) ? json_decode($meantestDBData['mean_test_data'], 1) : [];
$importIncome = (isset($meantestDBData['import_income']) && $meantestDBData['import_income'] == 1) ? true : false;
$nbsp_10 = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
$BasicInfoPartA = $basic_info['BasicInfoPartA'];
$BasicInfoPartB = $basic_info['BasicInfoPartB'];
$BasicInfo_PartC = $basic_info['BasicInfo_PartC'];
$BasicInfo_AnyOtherName = $basic_info['BasicInfo_AnyOtherName'];
$itin_full = Helper::validate_key_value('itin', $BasicInfoPartA);
$BasicInfo_PartRestD = $basic_info['BasicInfo_PartRestD'];
$BasicInfo_PartRest = $basic_info['BasicInfo_PartRest'];
$any_other_name = Helper::key_display('any_other_name', $BasicInfoPartA);
$businessEIN = Helper::key_display('used_business_ein', $BasicInfo_PartRestD);
$onlyDebtor = '';
$debtorname = Helper::validate_key_value('name', $BasicInfoPartA);
$debtorname .= " " . Helper::validate_key_value('middle_name', $BasicInfoPartA);
$debtorname .= " " . Helper::validate_key_value('last_name', $BasicInfoPartA);
$onlyDebtor = $debtorname;
$spousename = '';
$spousename = Helper::validate_key_value('name', $BasicInfoPartB);
if (!empty(trim($spousename))) {
    $spousename .= " " . Helper::validate_key_value('middle_name', $BasicInfoPartB);
    $spousename .= " " . Helper::validate_key_value('last_name', $BasicInfoPartB);
    $spousename = trim($spousename);
}
$debtorClientType = Helper::validate_key_value('client_type', $clentData);
$debtorname .= !empty($spousename) ? " and " . $spousename : '';
$debtorFirstName = trim(Helper::validate_key_value('name', $BasicInfoPartA));
$debtorMiddleName = trim(Helper::validate_key_value('middle_name', $BasicInfoPartA));
$debtorLastName = trim(Helper::validate_key_value('last_name', $BasicInfoPartA));
$suffix_d1 = ArrayHelper::getSuffixArray($BasicInfoPartA['suffix']);
$debtorPhoneHome = Helper::validate_key_value('home', $BasicInfo_AnyOtherName);
$debtorPhoneCell = Helper::validate_key_value('cell', $BasicInfo_AnyOtherName);
$debtorEmployer = Helper::validate_key_value('employer_name', $incomedebtoremployer);
$d1EmployerAddressLine1 = Helper::validate_key_value('name_address_employer', $incomedebtoremployer);
$d1EmployerAddressLine2 = Helper::validate_key_value('employer_address_line', $incomedebtoremployer);
$d1EmployerCity = Helper::validate_key_value('employer_city', $incomedebtoremployer);
$d1EmployerState = Helper::validate_key_value('employer_state', $incomedebtoremployer);
$d1EmployerZip = Helper::validate_key_value('employer_zip', $incomedebtoremployer);

$spouseFirstName = trim(Helper::validate_key_value('name', $BasicInfoPartB));
$spouseMiddleName = trim(Helper::validate_key_value('middle_name', $BasicInfoPartB));
$spouseLastName = trim(Helper::validate_key_value('last_name', $BasicInfoPartB));
$suffix_d2 = ArrayHelper::getSuffixArray(Helper::validate_key_value('suffix', $BasicInfoPartB));
$spousePhoneHome = Helper::validate_key_value('part2_phone', $BasicInfoPartB);
$spouseEmployer = Helper::validate_key_value('spouse_employer_name', $debtorspouseemployer);
$d2EmployerAddressLine1 = Helper::validate_key_value('name_address_spouse_employer', $debtorspouseemployer);
$d2EmployerAddressLine2 = Helper::validate_key_value('spouse_employer_address_line', $debtorspouseemployer);
$d2EmployerCity = Helper::validate_key_value('spouse_employer_city', $debtorspouseemployer);
$d2EmployerState = Helper::validate_key_value('spouse_employer_state', $debtorspouseemployer);
$d2EmployerZip = Helper::validate_key_value('spouse_employer_zip', $debtorspouseemployer);

$debtoraddress = Helper::validate_key_value('Address', $BasicInfoPartA);
$debtorCity = Helper::validate_key_value('City', $BasicInfoPartA);
$debtorState = Helper::validate_key_value('state', $BasicInfoPartA);
$debtorzip = Helper::validate_key_value('zip', $BasicInfoPartA);

$spouseaddress = Helper::validate_key_value('Address', $BasicInfoPartB);
$spouseCity = Helper::validate_key_value('City', $BasicInfoPartB);
$spouseState = Helper::validate_key_value('state', $BasicInfoPartB);
$spousezip = Helper::validate_key_value('zip', $BasicInfoPartB);

$address = '';
$address .= Helper::validate_key_value('Address', $BasicInfoPartA);
$address .= ", " . Helper::validate_key_value('City', $BasicInfoPartA);
$address .= " " . Helper::validate_key_value('state', $BasicInfoPartA);
$address .= " " . Helper::validate_key_value('zip', $BasicInfoPartA);

$clientAddress1 = Helper::validate_key_value('Address', $BasicInfoPartA);
$clientCity = Helper::validate_key_value('City', $BasicInfoPartA);
$clientState = Helper::validate_key_value('state', $BasicInfoPartA);
$clientZip = Helper::validate_key_value('zip', $BasicInfoPartA);

$ssn1 = Helper::validate_key_value('security_number', $BasicInfoPartA);
$ssn2 = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
$last_4_ssn_d1 = substr($ssn1, -4) ?? '';
$last_4_ssn_d2 = substr($ssn2, -4) ?? '';
$atroneyName = $attorney_company['company_name'];
$attonryAddress1 = $attorney_company['attorney_address'];
$attonryAddress2 = $attorney_company['attorney_address2'];
$attorneydetails = '';
$attorneydetails .= $attorney_company['company_name'] . "\n";
$attorneydetails .= $attorney_company['attorney_address'] . "\n";
$attorneydetails .= $attorney_company['attorney_address2'] . "\n";
$attorneydetails .= $attorney_company['attorney_city'];
$attorneydetails .= ", " . $attorney_company['attorney_state'];
$attorneydetails .= " " . $attorney_company['attorney_zip'] . "\n";
$attorneydetails .= $attorney_company['attorney_phone'] . ', ';
$attorneydetails .= $attorney_company['attorney_fax'] . "\n";
$attorneydetails .= "California State Bar Number: " . $attorney_company['state_bar'] . "\n";
$attorneydetails .= $attorney_email;
$attorney_company = $attorney_company;
$attorney_email = $attorney_email;
$attorney_state_bar_no = $attorney_company['state_bar'];
$attorneyPhone = $attorney_company['attorney_phone'];
$attorneyFax = $attorney_company['attorney_fax'];
$attorney_city = $attorney_company['attorney_city'];
$attorney_state = $attorney_company['attorney_state'];
$attorney_zip = $attorney_company['attorney_zip'];

$creditors_count = 0;
if (file_exists(base_path('resources') . '/courts_pdf_clients/' . $client_id . '/creditors.pdf')) {
    $pdftext = file_get_contents(base_path('resources') . '/courts_pdf_clients/' . $client_id . '/creditors.pdf');
    $pageCount = preg_match_all("/\/Page\W/", $pdftext, $dummy);
    $pageCount = $countCreditors > 0 ? ($countCreditors / 10) : 0;
    $creditors_count = ceil($pageCount);
}

$dynamicPdfData = $dynamicHtmlData;

$supplimentForm = isset($editorData['suppliment_form']) && !empty($editorData['suppliment_form']) ? json_decode($editorData['suppliment_form'], 1) : null;
$savedData = isset($editorSavedData['data']) && !empty($editorSavedData['data']) ? json_decode($editorSavedData['data'], 1) : null;

$householdSize = Helper::validate_key_value('household_size', $savedData);
$attorneyDate = Helper::validate_key_value('attorney_date', $savedData);
$confirm_html_forms_json = isset($editorSavedData['confirm_html_forms_json']) && !empty($editorSavedData['confirm_html_forms_json']) ? json_decode($editorSavedData['confirm_html_forms_json'], 1) : [];
$zipcode = Helper::validate_key_value('district_id', $savedData);

$requestStatus = $editorSavedData['request_for_combined'] ?? '';
$state = Helper::validate_key_value('district_full_name', $savedData);
$stateShort = Helper::validate_key_value('district_name', $savedData);
$statename = explode("of", $state);
$stateOfHouseHold = trim($statename[1] ?? $stateShort);
$caseno = !empty($caseNo) ? $caseNo : Helper::validate_key_value('case_number', $savedData);
$include_signature = Helper::validate_key_value('include_signature', $savedData);
if ($include_signature == 1) {
    $attorny_sign = "/s/ " . $attorney_name ?? '';
    $debtor_sign = "/s/ " . $onlyDebtor;
    $debtor2_sign = !empty($spousename) ? "/s/ " . $spousename : '';
}
$both_sign = !empty($spousename) ? $debtor_sign."  /  ".$debtor2_sign : $debtor_sign;
$both_name = !empty($spousename) ? $onlyDebtor."  /  ".$spousename : $onlyDebtor;
$d1_name_sign = $onlyDebtor."  /  ".$debtor_sign ?? '';
$d2_name_sign = !empty($spousename) ? $spousename."  /  ".$debtor2_sign : '';
$both_ssn = !empty($spousename) ? $ssn1."  /  ".$ssn2 : $ssn1;

$district_id = Helper::validate_key_value('district_id', $savedData);

$district_attorney = Helper::validate_key_value('district_attorney', $savedData);
$editorCh = Helper::validate_key_value('editor_chepter', $savedData);
$chapterName = Helper::getChapterName(Helper::validate_key_value('editor_chepter', $savedData));
$chapterNo = str_replace("chapter", "", $editorCh) ?? $chapterName;
$propertyresident = $property_info['propertyresident']->toArray();
$propertyvehicle = $property_info['propertyvehicle']->toArray();
$loan_own_type_property = true;

$creditors = [];
$statementIntent = [];
$totalAssetsYouOwn = 0;
$residentsp = [];
foreach ($propertyresident as $val) {
    $propertyName = '';
    $clientAddress = '';
    if (!empty($BasicInfoPartA)) {
        $clientAddress .= $BasicInfoPartA['Address'] ?? '';
        $clientAddress .= ', ' . $BasicInfoPartA['City'] ?? '';
        $clientAddress .= ', ' . $BasicInfoPartA['state'] ?? '';
        $clientAddress .= ', ' . $BasicInfoPartA['zip'] ?? '';
    }
    if ($val['currently_lived'] && $val['loan_own_type_property'] == 1) {
        $thisloan = json_decode($val['home_car_loan'], 1);
        if ($val['not_primary_address'] == 0) {
            $propertyName = $clientAddress;
        } else {
            $propertyName .= $val['mortgage_address'];
            $propertyName .= ', ' . $val['mortgage_city'];
            $propertyName .= ', ' . $val['mortgage_state'];
            $propertyName .= ', ' . $val['mortgage_zip'];
        }
        $cod = ['codebtor_creditor_name' => $thisloan['codebtor_creditor_name'] ?? '', 'codebtor_creditor_name_addresss' => $thisloan['codebtor_creditor_name_addresss'] ?? '', 'codebtor_creditor_city' => $thisloan['codebtor_creditor_city'] ?? '', 'codebtor_creditor_state' => $thisloan['codebtor_creditor_state'] ?? '', 'codebtor_creditor_zip' => $thisloan['codebtor_creditor_zip'] ?? '', 'part' => 1];
        $totalAssetsYouOwn = $totalAssetsYouOwn + $val['estimated_property_value'];
        $thisloan['describe_secure_claim'] = $propertyName;
        $thisloan['property_type'] = 'd';
        $thisloan['debt_owned_by'] = isset($val['property_owned_by']) ? $val['property_owned_by'] : '';
        $thisloan['debt_amount_due'] = $thisloan['amount_own'];
        $thisloan['retain_above_property'] = $val['retain_above_property'];
        $thisloan['property_value'] = $val['estimated_property_value'];
        $thisloan['partc_amount'] = ($thisloan['amount_own'] > $val['estimated_property_value']) ? ($thisloan['amount_own'] - $val['estimated_property_value']) : '0.00';
        $thisloan['account_number'] = Helper::lastchar($thisloan['account_number']);
        $cod['account_number'] = Helper::lastchar($thisloan['account_number']);
        $thisloan['codebtor'] = $cod;
        $creditors[] = $thisloan;

        if (!empty($val['home_car_loan2'])) {

            $thisloan = json_decode($val['home_car_loan2'], 1);
            $thisloan['describe_secure_claim'] = $propertyName;
            $thisloan['debt_amount_due'] = $thisloan['amount_own'];
            $thisloan['property_value'] = $val['estimated_property_value'];
            $thisloan['partc_amount'] = ($thisloan['amount_own'] > $val['estimated_property_value']) ? ($thisloan['amount_own'] - $val['estimated_property_value']) : '0.00';
            $thisloan['account_number'] = Helper::lastchar($thisloan['account_number']);
            $thisloan['retain_above_property'] = $val['retain_above_property'];
            $thisloan['property_type'] = 'd';

            $thisloan['debt_owned_by'] = isset($val['property_owned_by']) ? $val['property_owned_by'] : '';
            if (isset($thisloan['additional_loan1']) && !empty($thisloan['creditor_name']) && $thisloan['additional_loan1'] == 1) {
                $cod = ['codebtor_creditor_name' => $thisloan['codebtor_creditor_name'] ?? '', 'codebtor_creditor_name_addresss' => $thisloan['codebtor_creditor_name_addresss'] ?? '', 'codebtor_creditor_city' => $thisloan['codebtor_creditor_city'] ?? '', 'codebtor_creditor_state' => $thisloan['codebtor_creditor_state'] ?? '', 'codebtor_creditor_zip' => $thisloan['codebtor_creditor_zip'] ?? '', 'part' => 1];
                $cod['account_number'] = Helper::lastchar($thisloan['account_number']);
                $thisloan['codebtor'] = $cod;
                array_push($creditors, $thisloan);
            }
        }
        if (!empty($val['home_car_loan3'])) {
            $thisloan = json_decode($val['home_car_loan3'], 1);
            $thisloan['describe_secure_claim'] = $propertyName;
            $thisloan['debt_amount_due'] = $thisloan['amount_own'];
            $thisloan['property_value'] = $val['estimated_property_value'];
            $thisloan['partc_amount'] = ($thisloan['amount_own'] > $val['estimated_property_value']) ? ($thisloan['amount_own'] - $val['estimated_property_value']) : '0.00';
            $thisloan['retain_above_property'] = $val['retain_above_property'];
            $thisloan['property_type'] = 'd';
            $thisloan['account_number'] = Helper::lastchar($thisloan['account_number']);

            $thisloan['debt_owned_by'] = isset($val['property_owned_by']) ? $val['property_owned_by'] : '';
            if (isset($thisloan['additional_loan2']) && !empty($thisloan['creditor_name']) && $thisloan['additional_loan2'] == 1) {
                $cod2 = ['codebtor_creditor_name' => $thisloan['codebtor_creditor_name'] ?? '', 'codebtor_creditor_name_addresss' => $thisloan['codebtor_creditor_name_addresss'] ?? '', 'codebtor_creditor_city' => $thisloan['codebtor_creditor_city'] ?? '', 'codebtor_creditor_state' => $thisloan['codebtor_creditor_state'] ?? '', 'codebtor_creditor_zip' => $thisloan['codebtor_creditor_zip'] ?? '', 'part' => 1];
                $cod2['account_number'] = Helper::lastchar($thisloan['account_number']);
                $thisloan['codebtor'] = $cod2;
                array_push($creditors, $thisloan);
            }
        }
    }
}
$residentsp = $creditors;
$ri = 0;
$vi = 0;
foreach ($propertyvehicle as $vehicle) {
    $cod = ['codebtor_creditor_name' => $vehicle['codebtor_creditor_name'] ?? '', 'codebtor_creditor_name_addresss' => $vehicle['codebtor_creditor_name_addresss'] ?? '', 'codebtor_creditor_city' => $vehicle['codebtor_creditor_city'] ?? '', 'codebtor_creditor_state' => $vehicle['codebtor_creditor_state'] ?? '', 'codebtor_creditor_zip' => $vehicle['codebtor_creditor_zip'] ?? '', 'part' => 1];
    if ($vehicle['own_any_property'] && $vehicle['loan_own_type_property'] == 1 && isset($vehicle['vehicle_car_loan'])) {
        if (!empty($creditors)) {
            $vehicle_name = '';
            $loan = json_decode($vehicle['vehicle_car_loan'], 1);
            $vehicle_name = ArrayHelper::getVehiclesTypeArray($vehicle['property_type']);
            if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
                $ri++;
                $vehicle_name = $vehicle_name . " " . $ri;
            } else {
                $vi++;
                $vehicle_name = $vehicle_name . " " . $vi;
            }
            $totalAssetsYouOwn = $totalAssetsYouOwn + $vehicle['property_estimated_value'];
            $vehicle_name .= ', ' . $vehicle['property_year'];
            $vehicle_name .= ', ' . $vehicle['property_make'];
            $vehicle_name .= ', ' . $vehicle['property_model'];
            $vehicle_name .= ', ' . $vehicle['property_mileage'];
            $vehicle_name .= ', ' . $vehicle['property_other_info'];
            if (!empty($vehicle['vin_number'])) {
                $vehicle_name .= ', Vin # ' . $vehicle['vin_number'];
            }
            $loan['account_number'] = Helper::lastchar($loan['account_number']);
            $loan['describe_secure_claim'] = $vehicle_name;
            $loan['property_type'] = 'd';
            $loan['debt_owned_by'] = $vehicle['own_by_property'];
            $loan['debt_amount_due'] = $loan['amount_own'];
            $loan['property_value'] = $vehicle['property_estimated_value'];
            $loan['partc_amount'] = ($loan['amount_own'] > $vehicle['property_estimated_value']) ? ($loan['amount_own'] - $vehicle['property_estimated_value']) : '0.00';
            $loan['retain_above_property'] = $vehicle['retain_above_property'];

            $cod['account_number'] = Helper::lastchar($loan['account_number']);
            $loan['codebtor'] = $cod;
            $loan['vehicle_type'] = $vehicle['property_type'];
            if (!empty($loan['creditor_name'])) {
                array_push($creditors, $loan);
            }
        } else {
            $vehicle_name2 = '';
            $loan = json_decode($vehicle['vehicle_car_loan'], 1);
            $vehicle_name2 = ArrayHelper::getVehiclesTypeArray($vehicle['property_type']);
            if ((Helper::validate_key_value('property_type', $vehicle) == 6)) {
                $ri++;
                $vehicle_name2 = $vehicle_name2 . " " . $ri;
            } else {
                $vi++;
                $vehicle_name2 = $vehicle_name2 . " " . $vi;
            }

            $vehicle_name2 .= ', ' . $vehicle['property_year'];
            $vehicle_name2 .= ', ' . $vehicle['property_make'];
            $vehicle_name2 .= ', ' . $vehicle['property_model'];
            $vehicle_name2 .= ', ' . $vehicle['property_mileage'];
            $vehicle_name2 .= ', ' . $vehicle['property_other_info'];
            if (!empty($vehicle['vin_number'])) {
                $vehicle_name2 .= ', Vin # ' . $vehicle['vin_number'];
            }
            $loan['describe_secure_claim'] = $vehicle_name2;
            $loan['property_type'] = 'd';
            $loan['account_number'] = Helper::lastchar($loan['account_number']);
            $loan['debt_owned_by'] = $vehicle['own_by_property'];
            $loan['debt_amount_due'] = $loan['amount_own'];
            $loan['retain_above_property'] = $vehicle['retain_above_property'];
            $loan['property_value'] = $vehicle['property_estimated_value'];
            $loan['partc_amount'] = ($loan['amount_own'] > $vehicle['property_estimated_value']) ? ($loan['amount_own'] - $vehicle['property_estimated_value']) : '0.00';
            $cod['account_number'] = Helper::lastchar($loan['account_number']);
            $loan['codebtor'] = $cod;
            $loan['vehicle_type'] = $vehicle['property_type'];
            $creditors[] = $loan;
        }
    }
}
$statementIntent = $creditors;
$additionaCreditor = [];
$additional_liens = (Helper::validate_key_value('additional_liens', $final_debtstax) == 1) ? $final_debtstax['additional_liens_data'] : [];
if (!empty($additional_liens)) {
    foreach ($additional_liens as $additional) {
        $additionaCreditor = ['creditor_name' => $additional['domestic_support_name'] ?? '', 'creditor_name_addresss' => $additional['domestic_support_address'] ?? '', 'creditor_city' => $additional['domestic_support_city'] ?? '', 'creditor_state' => $additional['creditor_state'] ?? '', 'creditor_zip' => $additional['domestic_support_zipcode'] ?? '', 'account_number' => Helper::lastchar($additional['additional_liens_account']) ?? '', 'debt_incurred_date' => $additional['additional_liens_date'] ?? '', 'debt_amount_due' => $additional['additional_liens_due'] ?? '', 'describe_secure_claim' => $additional['describe_secure_claim'] ?? '', 'debt_owned_by' => $additional['owned_by'] ?? ''];
        $cod = ['codebtor_creditor_name' => $additional['codebtor_creditor_name'] ?? '', 'codebtor_creditor_name_addresss' => $additional['codebtor_creditor_name_addresss'] ?? '', 'codebtor_creditor_city' => $additional['codebtor_creditor_city'] ?? '', 'codebtor_creditor_state' => $additional['codebtor_creditor_state'] ?? '', 'codebtor_creditor_zip' => $additional['codebtor_creditor_zip'] ?? '', 'account_number' => Helper::lastchar($additional['additional_liens_account']) ?? '', 'part' => 1];
        $additionaCreditor['codebtor'] = $cod;
        array_push($creditors, $additionaCreditor);
    }
}
if (!empty($creditors)) {
    usort($creditors, function ($a, $b) {
        return strnatcasecmp($a['creditor_name'], $b['creditor_name']);
    });
}

?>
<?php

$propertyhousehold = $property_info['propertyhousehold'];
$financialassets = $property_info['financialassets'];
$farmcommercial = $property_info['farmcommercial'];
$miscellaneous = $property_info['miscellaneous'];


if (!empty($propertyhousehold)) {
    foreach ($propertyhousehold as $household) {
        $type_data = json_decode($household['type_data'], 1);
        if (!empty($type_data)) {
            $household['description'] = (!empty($type_data[0])) ? $type_data[0] : "";
            $household['property_value'] = (!empty($type_data[1])) ? $type_data[1] : "";
            $household['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";
        }
        $household['array_data'] = (!empty($type_data)) ? $type_data : [];
        unset($household['type_data']);
        $hholdfinal[$household['type']] = $household;
    }
}



if (!empty($financialassets)) {
    foreach ($financialassets as $financial) {
        $type_data = json_decode($financial['type_data'], 1);
        if (!empty($type_data)) {

            $financial['description'] = (!empty($type_data['description'])) ? $type_data['description'] : "";
            $financial['property_value'] = (isset($type_data['property_value']) && !empty($type_data['property_value'])) ? $type_data['property_value'] : "";
            $financial['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";

            if ($financial['type'] == 'life_insurance') {
                $financial['account_type'] = (!empty($type_data['account_type'])) ? $type_data['account_type'] : "";
            }

            if ($financial['type'] == 'tax_refunds') {
                $financial['year'] = (!empty($type_data['year'])) ? $type_data['year'] : "";
            }

            if ($financial['type'] == 'retirement_pension') {
                $financial['type_of_account'] = (!empty($type_data['type_of_account'])) ? $type_data['type_of_account'] : "";
            }

            if ($financial['type'] == 'alimony_child_support') {
                $financial['account_type'] = (!empty($type_data['account_type'])) ? $type_data['account_type'] : "";
            }

        }
        unset($financial['type_data']);
        $financial_assests[$financial['type']] = $financial;
    }
}

if (!empty($farmcommercial)) {
    foreach ($farmcommercial as $commercial) {
        $type_data = json_decode($commercial['type_data'], 1);

        if (!empty($type_data)) {

            $commercial['description'] = (!empty($type_data['description'])) ? $type_data['description'] : "";
            $commercial['property_value'] = (!empty($type_data['property_value'])) ? $type_data['property_value'] : "";
            $commercial['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";
        }
        unset($commercial['type_data']);
        $commercial_assets[$commercial['type']] = $commercial;
    }
}

if (!empty($miscellaneous)) {
    foreach ($miscellaneous as $misc) {
        $type_data = json_decode($misc['type_data'], 1);

        if (!empty($type_data)) {
            $misc['description'] = (!empty($type_data['description']) && is_array($type_data['description']) ? implode(",", $type_data['description']) : $type_data['description']);
            $misc['property_value'] = (!empty($type_data['property_value'])) ? array_sum($type_data['property_value']) : "";
            $misc['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";
        }
        unset($misc['type_data']);
        $misc_assets[$misc['type']] = $misc;
    }
}


$household_goods = (!empty($hholdfinal['household_goods_furnishings'])) ? $hholdfinal['household_goods_furnishings'] : [];

$electronics = (!empty($hholdfinal['electronics'])) ? $hholdfinal['electronics'] : [];
$collectibles = (!empty($hholdfinal['collectibles'])) ? $hholdfinal['collectibles'] : [];
$sports = (!empty($hholdfinal['sports'])) ? $hholdfinal['sports'] : [];
$firearms = (!empty($hholdfinal['firearms'])) ? $hholdfinal['firearms'] : [];
$clothing = (!empty($hholdfinal['clothing'])) ? $hholdfinal['clothing'] : [];
$jewelry = (!empty($hholdfinal['jewelry'])) ? $hholdfinal['jewelry'] : [];
$pets = (!empty($hholdfinal['pets'])) ? $hholdfinal['pets'] : [];
$health_aids = (!empty($hholdfinal['health_aids'])) ? $hholdfinal['health_aids'] : [];

$cash = (!empty($hholdfinal['cash'])) ? $hholdfinal['cash'] : [];
$bank = (!empty($hholdfinal['bank'])) ? $hholdfinal['bank'] : [];
$mutual_funds = (!empty($hholdfinal['mutual_funds'])) ? $hholdfinal['mutual_funds'] : [];
$traded_stocks = (!empty($hholdfinal['traded_stocks'])) ? $hholdfinal['traded_stocks'] : [];
$government_corporate_bonds = (!empty($hholdfinal['government_corporate_bonds'])) ? $hholdfinal['government_corporate_bonds'] : [];
$retirement_pension = (!empty($hholdfinal['retirement_pension'])) ? $hholdfinal['retirement_pension'] : [];
$security_deposits = (!empty($hholdfinal['security_deposits'])) ? $hholdfinal['security_deposits'] : [];
$annuities = (!empty($hholdfinal['annuities'])) ? $hholdfinal['annuities'] : [];
$education_ira = (!empty($hholdfinal['education_ira'])) ? $hholdfinal['education_ira'] : [];
$trusts_life_estates = (!empty($hholdfinal['trusts_life_estates'])) ? $hholdfinal['trusts_life_estates'] : [];
$patents_copyrights = (!empty($hholdfinal['patents_copyrights'])) ? $hholdfinal['patents_copyrights'] : [];
$licenses_franchises = (!empty($hholdfinal['licenses_franchises'])) ? $hholdfinal['licenses_franchises'] : [];
$tax_refunds = (!empty($hholdfinal['tax_refunds'])) ? $hholdfinal['tax_refunds'] : [];
$alimony_child_support = (!empty($hholdfinal['alimony_child_support'])) ? $hholdfinal['alimony_child_support'] : [];
$insurance_policies = (!empty($hholdfinal['insurance_policies'])) ? $hholdfinal['insurance_policies'] : [];
$unpaid_wages = (!empty($hholdfinal['unpaid_wages'])) ? $hholdfinal['unpaid_wages'] : [];
$inheritances = (!empty($hholdfinal['inheritances'])) ? $hholdfinal['inheritances'] : [];
$injury_claims = (!empty($hholdfinal['injury_claims'])) ? $hholdfinal['injury_claims'] : [];
$other_claims = (!empty($hholdfinal['other_claims'])) ? $hholdfinal['other_claims'] : [];
$other_financial = (!empty($hholdfinal['other_financial'])) ? $hholdfinal['other_financial'] : [];



$usedbizdata = [];

if (!empty($BasicInfo_PartRest['used_business_ein_data'])) {

    $used_business_dta_info = json_decode($BasicInfo_PartRest['used_business_ein_data'], 1);

    $usedbizdata = (!empty($used_business_dta_info) && is_array($used_business_dta_info)) ? $used_business_dta_info : [];

}

$d = [];
$s = [];
if (isset($usedbizdata['own_business_name'])) {
    for ($j = 0;$j < (is_countable($usedbizdata['own_business_name']));$j++) {
        $business = [];
        if (!empty($usedbizdata) && is_array($usedbizdata['own_business_name'])) {
            for ($j = 0; $j < count($usedbizdata['own_business_name']); $j++) {
                if (isset($usedbizdata['own_business_selection'][$j]) && $usedbizdata['own_business_selection'][$j] == 0 && isset($usedbizdata['own_business_name'][$j])) {
                    $d[] = $usedbizdata['own_business_name'][$j];
                } else {
                    $s[] = isset($usedbizdata['own_business_name'][$j]) ? $usedbizdata['own_business_name'][$j] : '';
                }
            }
        }
    }
}
$business = $d + $s;


$finanicalTotal = 0;
if (Helper::validate_key_value('type_value', $household_goods) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $household_goods, 'float');
}
if (Helper::validate_key_value('type_value', $electronics) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $electronics, 'float');
}
if (Helper::validate_key_value('type_value', $collectibles) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $collectibles, 'float');
}
if (Helper::validate_key_value('type_value', $sports) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $sports, 'float');
}
if (Helper::validate_key_value('type_value', $firearms) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $firearms, 'float');
}
if (Helper::validate_key_value('type_value', $clothing) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $clothing, 'float');
}
if (Helper::validate_key_value('type_value', $jewelry) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $jewelry, 'float');
}
if (Helper::validate_key_value('type_value', $pets) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $pets, 'float');
}
if (Helper::validate_key_value('type_value', $health_aids) == 1) {
    $finanicalTotal += Helper::validate_key_value('property_value', $health_aids, 'float');
}
?>
<?php

$final_BasicInfo_PartB = [];
if (!empty($BasicInfoPartB)) {
    foreach ($BasicInfoPartB->toArray() as $k => $v) {
        if (is_array(json_decode($v, 1))) {
            $adata[$k] = json_decode($v, 1);
            $final_BasicInfo_PartB[$k] = $adata[$k];
        } else {
            $final_BasicInfo_PartB[$k] = $v;
        }
    }
}
$BasicInfoPartB = $final_BasicInfo_PartB;
// $financialaffairs_info['property_transferred'] = 1;
if (!isset($financialaffairs_info['property_transferred_data']) || !is_array($financialaffairs_info['property_transferred_data'])) {
    $financialaffairs_info['property_transferred_data'] = [];
    $financialaffairs_info['property_transferred_data']['attorney_added_field'] = [];
}
$financialaffairs_info['property_transferred_data']['attorney_added_field'] = [];
if (isset($financialaffairs_info['property_transferred_data']['person_paid']) && !empty($financialaffairs_info['property_transferred_data']['person_paid'])) {
    foreach ($financialaffairs_info['property_transferred_data']['person_paid'] as $person) {
        array_push($financialaffairs_info['property_transferred_data']['attorney_added_field'], 0);
    }
}

if (isset($financialaffairs_info['property_transferred_data']['person_paid'])) {
    // Initialize arrays if they don't exist
    $financialaffairs_info['property_transferred_data']['person_paid'] = $financialaffairs_info['property_transferred_data']['person_paid'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_paid_street'] = $financialaffairs_info['property_transferred_data']['person_paid_street'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_paid_address_line2'] = $financialaffairs_info['property_transferred_data']['person_paid_address_line2'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_paid_city'] = $financialaffairs_info['property_transferred_data']['person_paid_city'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_paid_state'] = $financialaffairs_info['property_transferred_data']['person_paid_state'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_paid_zip'] = $financialaffairs_info['property_transferred_data']['person_paid_zip'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_made_payment'] = $financialaffairs_info['property_transferred_data']['person_made_payment'] ?? [];
    $financialaffairs_info['property_transferred_data']['person_email_or_website'] = $financialaffairs_info['property_transferred_data']['person_email_or_website'] ?? [];
    $financialaffairs_info['property_transferred_data']['property_transferred_value'] = $financialaffairs_info['property_transferred_data']['property_transferred_value'] ?? [];
    $financialaffairs_info['property_transferred_data']['property_transferred_date'] = $financialaffairs_info['property_transferred_data']['property_transferred_date'] ?? [];
    $financialaffairs_info['property_transferred_data']['property_transferred_payment'] = $financialaffairs_info['property_transferred_data']['property_transferred_payment'] ?? [];
    $financialaffairs_info['property_transferred_data']['attorney_added_field'] = $financialaffairs_info['property_transferred_data']['attorney_added_field'] ?? [];
    
    array_push($financialaffairs_info['property_transferred_data']['person_paid'], $attorney_company['company_name']);
    array_push($financialaffairs_info['property_transferred_data']['person_paid_street'], $attorney_company['attorney_address']);
    array_push($financialaffairs_info['property_transferred_data']['person_paid_address_line2'], '');
    array_push($financialaffairs_info['property_transferred_data']['person_paid_city'], $attorney_company['attorney_city']);
    array_push($financialaffairs_info['property_transferred_data']['person_paid_state'], $attorney_company['attorney_state']);
    array_push($financialaffairs_info['property_transferred_data']['person_paid_zip'], $attorney_company['attorney_zip']);
    array_push($financialaffairs_info['property_transferred_data']['person_made_payment'], '');
    array_push($financialaffairs_info['property_transferred_data']['person_email_or_website'], $attorney_email ?? '');
    array_push($financialaffairs_info['property_transferred_data']['property_transferred_value'], '');
    array_push($financialaffairs_info['property_transferred_data']['property_transferred_date'], '');
    array_push($financialaffairs_info['property_transferred_data']['property_transferred_payment'], '');
    array_push($financialaffairs_info['property_transferred_data']['attorney_added_field'], 1);
}
$creditorsmain = [];
if (!empty($financialaffairs_info['community_property_state'])) {
    for ($i = 0; $i < count($financialaffairs_info['community_property_state']); $i++) {
        array_push($creditorsmain, ['codebtor' => 1, 'creditor_name' => @$financialaffairs_info['domestic_partner'][$i], 'codebtor_creditor_name' => @$financialaffairs_info['domestic_partner'][$i], 'codebtor_creditor_name_addresss' => @$financialaffairs_info['domestic_partner_street_address'][$i], 'codebtor_creditor_city' => @$financialaffairs_info['domestic_partner_city'][$i], 'codebtor_creditor_state' => @$financialaffairs_info['domestic_partner_state'][$i], 'codebtor_creditor_zip' => @$financialaffairs_info['domestic_partner_zip'][$i], 'domestic_partner_living' => @$financialaffairs_info['domestic_partner_living'][$i]]);
    }
}
?>
<?php

$totalCreditor = 0;
if (is_array($creditors)) {
    $totalCreditor += count($creditors);
}
if (is_array($creditorsmain)) {
    $totalCreditor += count($creditorsmain);
}
if (!empty($final_debtstax['back_tax_own']) && count($final_debtstax['back_tax_own']) > 0) {
    $totalCreditor += count($final_debtstax['back_tax_own']);
}
if (Helper::validate_key_value('tax_owned_irs', $final_debtstax) == 1 && isset($final_debtstax['tax_irs_state']) && !empty($final_debtstax['tax_irs_state'])) {
    $totalCreditor += 1;
}
if (!empty($final_debtstax['domestic_tax']) && count($final_debtstax['domestic_tax']) > 0) {
    $totalCreditor += count($final_debtstax['domestic_tax']);
}
if (!empty($final_debtstax['debt_tax']) && count($final_debtstax['debt_tax']) > 0) {
    $totalCreditor += count($final_debtstax['debt_tax']);
}

$matrixTab = [];
foreach ($tabData as $disdata) {
    if (($disdata['type'] == 'local' && $disdata['chapter_type'] != 13 && $disdata["form_tab_content"] == "official_form_mailing_matrix")) {
        $matrixTab = $disdata;
    }
}


$defaultForms = [];
foreach ($tabData as $disdata) {
    if (($disdata['type'] == 'default' && ($disdata['is_active'] == 1 && ($disdata['is_uppliment'] == 0)))) {
        array_push($defaultForms, $disdata);
    }
}

$finalDefault = [];
$i = 1;
foreach ($defaultForms as $dForm) {
    if ($i == count($defaultForms)) {
        array_push($finalDefault, $matrixTab);
    }
    array_push($finalDefault, $dForm);
    $i++;
}


foreach ($tabData as $disdata) {
    if (($disdata['type'] == 'default' && ($disdata['is_active'] == 1 && ($disdata['is_uppliment'] == 1 && (isset($supplimentForm) && in_array($disdata['form_tab_content'], $supplimentForm)))))) {
        array_push($finalDefault, $disdata);
    }
}

$localForms = [];
foreach ($tabData as $disdata) {

    if ($disdata['trustee'] == '' && $disdata['type'] == 'local' && $disdata['chapter_type'] != 13 && ($disdata['form_tab_content'] != 'official_form_mailing_matrix')) {
        array_push($localForms, $disdata);
    } elseif ($disdata['trustee'] == '' && $disdata['type'] == 'local' && $disdata['chapter_type'] != 13 && ($disdata['form_tab_content'] != 'official_form_mailing_matrix')) {
        array_push($localForms, $disdata);
    }
}
if (!empty($localForms)) {
    usort($localForms, function ($a, $b) {
        return strnatcasecmp($a['form_tab'], $b['form_tab']);
    });
}

$trusteeForms = [];
if ($editorCh == 'chapter7' && !empty($selectedTrusteeID)) {
    foreach ($tabData as $disdata) {
        if (!empty($disdata['trustee']) && $disdata['trustee'] == $selectedTrusteeID && $disdata['type'] == 'local' && $disdata['chapter_type'] != 13 && ($disdata['form_tab_content'] != 'official_form_mailing_matrix')) {
            array_push($trusteeForms, $disdata);
        }
    }
    if (!empty($trusteeForms)) {
        usort($trusteeForms, function ($a, $b) {
            return strnatcasecmp($a['form_tab'], $b['form_tab']);
        });
    }
}

$chapter13localforms = [];
foreach ($tabData as $disdata) {
    if ($disdata['type'] == 'local' && $disdata['chapter_type'] == 13) {
        array_push($chapter13localforms, $disdata);
    }
}
if (!empty($chapter13localforms)) {
    usort($chapter13localforms, function ($a, $b) {
        return strnatcasecmp($a['form_tab'], $b['form_tab']);
    });
}


$priorCasesContent = "NONE";
$BasicInfo_PartC = !empty($BasicInfo_PartC) ? $BasicInfo_PartC->toArray() : [];
if (!empty(Helper::validate_key_value('filed_bankruptcy_case_last_8years', $BasicInfo_PartC))) {
    if (!empty($BasicInfo_PartC['case_filed_state']) && is_array($BasicInfo_PartC['case_filed_state']) && count($BasicInfo_PartC['case_filed_state']) > 0) {
        $BasicInfo_PartC['case_filed_state'] = $BasicInfo_PartC['case_filed_state'];
        $BasicInfo_PartC['case_number'] = $BasicInfo_PartC['case_number'];
        $BasicInfo_PartC['date_filed'] = $BasicInfo_PartC['date_filed'];
        $basicInfoPartCCaseFiledCount = count($BasicInfo_PartC['case_filed_state']);
        for ($k = 0; $k < $basicInfoPartCCaseFiledCount; $k++) {
            $priorCasesContent = $priorCasesContent . date("m/d/Y", strtotime(Helper::validate_key_loop_value('date_filed', $BasicInfo_PartC, $k))) . "," .Helper::validate_key_loop_value('case_filed_state', $BasicInfo_PartC, $k).",".Helper::validate_key_loop_value('case_number', $BasicInfo_PartC, $k)."\r\n";
        }
    }
}

$relatedCasesContent = "";
if (!empty(Helper::validate_key_value('any_bankruptcy_cases_pending', $BasicInfo_PartC))) {
    if (!empty($BasicInfo_PartC['any_bankruptcy_cases_pending_data']) && is_object($BasicInfo_PartC['any_bankruptcy_cases_pending_data'])) {
        $any_bankruptcy_cases_pendingdata = $BasicInfo_PartC['any_bankruptcy_cases_pending_data'];
        $relatedDebatorName = array_filter($any_bankruptcy_cases_pendingdata->debator_name);
        $totalCounts = count($relatedDebatorName);
        for ($key = 0;$key <= $totalCounts;$key++) {
            if (!empty(Helper::valueFromObjectArray('partner_date_filed', $any_bankruptcy_cases_pendingdata, $key))) {
                $relatedCasesContent = $relatedCasesContent . Helper::valueFromObjectArray('partner_date_filed', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('partner_case_number', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('debator_name', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('your_relationship', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('district', $any_bankruptcy_cases_pendingdata, $key)."\r\n";
            }
        }
    }
}

$pendingCaseContent = "";
if (!empty(Helper::validate_key_value('any_bankruptcy_cases_pending', $BasicInfo_PartC))) {
    if (!empty($BasicInfo_PartC['any_bankruptcy_filed_before_data']) && is_object($BasicInfo_PartC['any_bankruptcy_filed_before_data'])) {
        $any_bankruptcy_cases_pendingdata = $BasicInfo_PartC['any_bankruptcy_filed_before_data'];
        $case_name = array_filter($any_bankruptcy_cases_pendingdata->case_name);
        $totalCounts = count($case_name);
        for ($key = 0;$key <= $totalCounts;$key++) {
            if (!empty(Helper::valueFromObjectArray('case_name', $any_bankruptcy_cases_pendingdata, $key))) {
                $pendingCaseContent = $pendingCaseContent . Helper::valueFromObjectArray('case_name', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('data_field', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('case_numbers', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('date_discharged', $any_bankruptcy_cases_pendingdata, $key) . "," . Helper::valueFromObjectArray('district_if_known', $any_bankruptcy_cases_pendingdata, $key)."\r\n";
            }
        }
    }
}

$meantest = isset($mTestA2[base64_encode('B_122A-2-undefined_107')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_107')]) : Helper::priceFormtWithComma('');


$selectedTrusteeName = '';
if ($editorCh == 'chapter7' && isset($trustees) && !empty($trustees)) {
    $selectedTrusteeId = Helper::validate_key_value('trustee', $savedData, 'radio');
    $trusteeNames = [];
    foreach ($trustees as $trusteeObject) {
        $trusteeNames[Helper::validate_key_value('id', $trusteeObject, 'radio')] = Helper::validate_key_value('trustee_name', $trusteeObject);

    }
    $selectedTrusteeName = Helper::validate_key_value($selectedTrusteeId, $trusteeNames);
}
?>

<div class="main-wrapper">
    <div class="container p-0">
        <div class="row column-heading">
            <div class="col-md-3 hide-print hide-small-screen pr-0 pl-0">
                <ul class="nav flex-column nav-pills" role="tablist" id="sidebar">
                    @php $i = 0; @endphp
                    @foreach($finalDefault as $disdata)
                    @if(isset($disdata['form_tab_content']) && ($disdata['form_tab_content'] == 'official-form-106j-2')
                    && $expenses_info['live_separately'] ==0)
                    @continue
                    @endif
                    @if(isset($disdata['form_tab_content']) && (($disdata['form_tab_content'] ==
                    'official_form_mailing_matrix') || ($disdata['type'] == 'default' && ($disdata['is_active']==1 ||
                    ($disdata['is_uppliment']==1 && in_array($disdata['form_tab_content'], $supplimentForm))))))
                    <li class="{{($i==0) ? 'active':''}}">
                        <a href="#{{$disdata['form_tab_content']}}"
                            onclick="collesped('<?php echo $disdata['form_tab_content']; ?>')"
                            class="nav-link width990 text-left id_{{$disdata['form_tab_content']}}"
                            id="section{{($i++)}}-tab" role="tab">
                            <span>{{$disdata['form_name']}}</span>
                            <span
                                class="desc-tab"><?php echo isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? $disdata['form_tab_description'] : '&nbsp;'; ?></span>
                        </a>
                        <span class="individual_pdf_icon" data-form_id="{{$disdata['form_tab_content']}}"><img
                                src="{{url('assets/img/pdf-icon.svg')}}" alt="pdf icon" /></span>
                    </li>
                    @endif
                    @endforeach
                    
                    <!-- local forms sidebar view listing -->
                    @include('attorney.official_form.common.form_listing', ['forms' => $localForms, 'mainLabel' => 'LOCAL FORMS', 'addLFAnchor' => true])
                    <!-- trustee forms sidebar view listing -->
                    @include('attorney.official_form.common.form_listing', ['forms' => $trusteeForms, 'mainLabel' => 'TRUSTEE FORMS', 'addLFAnchor' => false])

                    <?php if (!empty($chapter13localforms)) { ?>
                    <span class="nav-localheading">{{ __('CHAPTER-13 LOCAL FORMS') }}</span>
                    @foreach($chapter13localforms as $disdata)
                    @if($disdata['type'] == 'local')
                    <li class="localformli small-font-item" style="position: relative;">
                        <input type="checkbox" class="localform-include check_include_form"
                            value="{{$disdata['form_tab_content']}}" checked></input>
                        <a href="#{{$disdata['form_tab_content']}}"
                            onclick="collesped('<?php echo $disdata['form_tab_content']; ?>')"
                            class="nav-link text-left id_{{$disdata['form_tab_content']}}" id="section{{$i++}}-tab"
                            role="tab">
                            <span>{{$disdata['form_name']}}</span>
                            <span
                                class="desc-tab"><?php echo isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? $disdata['form_tab_description'] : '&nbsp;'; ?></span>
                        </a><span class="individual_pdf_icon" data-form_id="{{$disdata['form_tab_content']}}"><img
                                src="{{url('assets/img/pdf-icon.svg')}}" alt="pdf icon" /></span>
                    </li>
                    @endif
                    @endforeach
                    <?php } ?>

                    <span class="nav-localheading">{{ __('SUPPLEMENTAL') }}</span>
                    <?php foreach ($tabData as $disdata) {
                        if ($disdata['is_uppliment'] == 1) { ?>
                    <li class="suppliment">
                        <?php if (isset($supplimentForm) && !empty($supplimentForm) && in_array($disdata['form_tab_content'], $supplimentForm)) { ?>
                        <?php $class = "item-added"; ?>
                        <a href="javascript:void(0)"
                            onclick="deactivateFormTab('<?php echo $disdata['form_tab_content']; ?>')"
                            title="Click to remove from default list" class="show_in_default"
                            value="{{$disdata['form_tab_content']}}"><span
                                class='custom-btn'>{{ __('Remove from Petition') }}</span><i class="red fa fa-trash"
                                aria-hidden="true"></i></a>
                        <?php
                        } else { ?>
                        <?php $class = "not-added"; ?>
                        <a href="javascript:void(0)"
                            onclick="activateFormTab('<?php echo $disdata['form_tab_content']; ?>')"
                            title="Click to add into default list" class="not-added show_in_default "
                            id="not_added_{{$disdata['form_tab_content']}}"
                            value="{{$disdata['form_tab_content']}}">
                            <span class='custom-btn add_btn_petiton'>{{ __('Add to Petition') }}</span>
                            <i class="green fa fa-plus" aria-hidden="true"></i>
                        </a>
                        <?php
                        } ?>
                        <a class="text-left <?php echo $class; ?> width80" href="javascript:void(0)">
                            <span>{{$disdata['form_name']}}</span>
                            <span class="desc-tab">{{$disdata['form_tab_description']}}</span>
                        </a>
                    </li>
                    <?php
                        }
                    } ?>
                </ul>
            </div>
            <div class="col-md-9 w-100 pr-0 pl-2">
                <div class="main-wrapper-body" id="main">
                    <input type="hidden" id="client_id" value="<?php echo $client_id; ?>">
                    <div class="container avoid-this">
                        <div class="row">
                            <div class="filingInformation col-xxl-7 col-lg-7 col-md-12 custom_box">
                                <div class="filingInformation_inner">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label
                                                class="box_heading"><strong>{{ __('Filing Information:') }}</strong></label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="section-box1">
                                                <?php $chapters = ['' => 'Choose Chapter', 'chapter7' => "Chapter 7", 'chapter13' => "Chapter 13"];

if (!LocalFormHelper::isChapterThirteenEnabled($district_id)) {
    $chapters = ['' => 'Choose Chapter', 'chapter7' => "Chapter 7"];
}
?>

                                                <div class="section-body padd-10">
                                                    <div class="row">
                                                        <div class="col-md-7 pr-0 mb-2">
            
                                                            <label>{{ __('District Of') }}</label>
                                                            <?php $groups = []; ?>
                                                            <div class="input-group">
                                                                <select class="form-control"
                                                                    onchange="setDistrict(this)" id="district_attorney">
                                                                    <?php foreach ($district_names as $district_name) {
                                                                        if (!in_array($district_name->short_name, $groups)) {?>
                                                                    <optgroup label="{{$district_name->short_name}}">
                                                                    </optgroup>
                                                                    <?php array_push($groups, $district_name->short_name); ?><?php } ?>
                                                                            
                                                                    <option
                                                                        <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?>
                                                                        value="{{$district_name->district_name}}"
                                                                        data-name="{{$district_name->short_name}}"
                                                                        data-id="{{$district_name->id}}"
                                                                        class="form-control">
                                                                        {{str_replace('Of', 'of',$district_name->district_name)}}
                                                                    </option>

                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <?php if ($editorCh == 'chapter7' && isset($trustees) && !empty($trustees)) { ?>
                                                            <label class="mt-2">Trustee</label>
                                                            <?php $groups = []; ?>
                                                            <div class="input-group">
                                                                <select class="form-control"
                                                                    onchange="saveToDb()" 
                                                                    id="trustee-select">
                                                                    <option value="">Choose Trustee</option>
                                                                    <?php foreach ($trustees as $trustee) { ?>
                                                                        <option value="{{ Helper::validate_key_value('id', $trustee, 'radio') }}" <?php echo Helper::validate_key_option('trustee', $savedData, Helper::validate_key_value('id', $trustee, 'radio')); ?>>{{ Helper::validate_key_value('trustee_name', $trustee) }}</option>    
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-md-5 mb-2">
                                                            <label>{{ __('Chapter') }}</label>
                                                            <div class="input-group">
                                                                <select class="form-control" onchange="setChapter(this)"
                                                                    id="editor_chepter"> @foreach ($chapters as $key =>
                                                                    $name)
                                                                    <option value="{{$key}}"
                                                                        <?php echo Helper::validate_key_option('editor_chepter', $savedData, $key); ?>
                                                                        class="form-control">{{$name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="<?php if ($chapterName == 'Chapter 13') {
                                                echo "col-md-5";
                                            } else {
                                                echo "col-md-7";
                                            } ?> debtblock cs-schecks mb-2">
                                            <div class="section-box1">
                                                <div class="section-body">
                                                    <div class="form-group">
                                                        <label>{{ __('Debts:') }}</label>
                                                        <div class="d-inline radio-primary pt-2">
                                                            <input type="radio"
                                                                <?php echo Helper::validate_key_toggle('debtbtextvalue', $savedData, 1); ?>
                                                                onclick="isConsumerDebt('consumer')"
                                                                id="is_consumer_debt" name="is_debt_c_b" value="1"
                                                                class="required is_debt_c_b" />
                                                            <label for="is_consumer_debt"
                                                                class="cr">{{ __('Consumer Debts') }}</label>
                                                        </div>
                                                        <div class="d-inline radio-primary pt-2">
                                                            <input
                                                                <?php echo Helper::validate_key_toggle('debtbtextvalue', $savedData, 0); ?>
                                                                type="radio" onclick="isConsumerDebt('business')"
                                                                id="is_business_debt" name="is_debt_c_b" value="0"
                                                                class="required is_debt_c_b" />
                                                            <label for="is_business_debt"
                                                                class="cr">{{ __('Business Debts') }}</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="<?php if ($chapterName == 'Chapter 13') {
                                                echo "col-md-7";
                                            } else {
                                                echo "col-md-5";
                                            } ?> attrnyfee-block cs-ints mb-2">
                                            <div class="section-box1">
                                                <div class="section-body">
                                                    <div class="row">
                                                        <div class="col-md-8 attorny_fee pr-0 pl-0">
                                                            <label>{{ __('Attorney fee:') }}</label>
                                                            <div class="input-group d-flex w-100">
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2" style="margin-left: 0px;">$</span>
                                                                </div>
                                                                <input name="attorney_fees attornydate" type="text"
                                                                    value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>"
                                                                    class="price-field attorney_price form-control width_80percent"
                                                                    style="margin-right: 0px;">

                                                                <div
                                                                    class="<?php if ($chapterName != 'Chapter 13') {
                                                                        echo "hide-data";
                                                                    }?> hrlyprice input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2"
                                                                        style="margin-left: 0px;">&nbsp;/&nbsp;$</span>
                                                                </div>
                                                                <input name="attorney_hourly_rate" type="text"
                                                                    value="<?php echo Helper::validate_key_value('attorney_hourly_rate', $savedData); ?>"
                                                                    class="<?php if ($chapterName != 'Chapter 13') {
                                                                        echo "hide-data";
                                                                    }?> hrlyprice price-field attorney_hourly_rate form-control"
                                                                    style="margin-right: 0px;">

                                                            </div>
                                                            <div
                                                                class="input-group <?php if ($chapterName != 'Chapter 13') {
                                                                    echo "hide-data";
                                                                }?>  d-flex hrlyprice">
                                                                <label
                                                                    style="font-style:italic;font-size:10px;width:50%;margin-left:20px;">{{ __('(Flat Fees)') }}</label>
                                                                <label
                                                                    style="font-style:italic;font-size:10px;width:50%;margin-left:30px;">{{ __('(Hourly Rate)') }}</label>
                                                            </div>


                                                        </div>

                                                        <div class="col-md-4 attorny_fee ml-0 mt-1" style="padding-right: 0px !important; padding-left: 0px !important;">
                                                            <label>{{ __('Date:') }}&nbsp;</label>
                                                            <div class="input-group">
                                                                <input name="attorney_file_date"
                                                                    placeholder="{{ __('MM/DD/YYYY') }}" type="text"
                                                                    value="<?php echo Helper::validate_key_value('attorney_date', $savedData); ?>"
                                                                    class="date_filed attorney_date form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 pr-0 extrem_cs mt-2">
                                            <div class="form-group">
                                                <label>{{ __('Exemptions:') }}</label>
                                                <div class="d-inline radio-primary">
                                                    <input
                                                        <?php echo Helper::validate_key_toggle('is_exemptionstext', $savedData, 1); ?>
                                                        type="radio" onclick="isExemptions('State')"
                                                        id="is_exemptions_state" name="is_exemptions" value="1"
                                                        class="required is_exemptions" />
                                                    <label for="is_exemptions_state"
                                                        class="cr">{{ __('State') }}</label>
                                                </div>
                                                <div class="d-inline radio-primary">
                                                    <input
                                                        <?php echo Helper::validate_key_toggle('is_exemptionstext', $savedData, 0); ?>
                                                        type="radio" onclick="isExemptions('Federal')"
                                                        id="is_exemptions_federal" name="is_exemptions" value="0"
                                                        class="required is_exemptions" />
                                                    <label for="is_exemptions_federal"
                                                        class="cr">{{ __('Federal') }}</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-3 d-flex ml-0 pl-0 extrem_cs_slct mt-2 width21percent" style="padding-right:0px"  >
                                            <div class="input-group form-control pt-0 pb-0 pl-0" style="border:none; padding-right:0px" >
                                                <label>{{ __('Household Size:') }}</label>
                                                <select id="household_size" onchange="saveToDb()" name="household_size"
                                                    class="form-control mr-0" style="height: fit-content;">
                                                    <?php foreach (range(1, 15) as $num) { ?>
                                                    <option <?php if (Helper::validate_key_value('household_size', $savedData) == $num) {
                                                        echo "selected";
                                                    } ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 d-flex mt-2 mb-2 means-test-spc width24percent">
                                            <label class="mean_test" style="margin-top:4px;">{{ __('Means Test:') }}&nbsp;</label>
                                            <div class="input-group pl-0 ml-1" style="padding-left:0 !important;">
                                                <img style="display:none;" class="mean-icons meantest_red"
                                                    src="{{url('assets/img/like_red.png')}}" alt="like red" >
                                                <img style="display:none;" class="mean-icons meantest_green"
                                                    src="{{url('assets/img/like_green.png')}}" alt="like green" />
                                            </div>
                                        </div>

                                        <div class="col-md-3 extrem_cs_btn pl-0 mt-2">
                                            <a class="btn-form btn_res" href="javascript:void(0)" onclick="meanTestPopup()">{{ __('Mean Test Info') }}</a>
                                        </div>
                                        <div class="col-xxl-7 col-lg-9 int-fll-width mt-2 pl_15px media_width72">
                                            <div class="input-group d-flex">
                                                <label>{{ __('Case number (if known):') }}</label>
                                                <input type="text" name="case number"
                                                    value="<?php echo $caseno; ?>"
                                                    class="case_number form-control">
                                            </div>
                                        </div>
                                        <div class="col-xxl-2 col-lg-0 extrem_cs_btn pl-0 mt-2">
                                            
                                        </div>
                                        <div class="col-xxl-3 col-lg-3 extrem_cs_btn pl-0 mt-2 pr_15px media_width25">
                                            <a class="btn-form mt-0" onclick="printDocument('main')"
                                                href="javascript:void(0)" style="float:right">
                                                <span class="card-title-text">{{ __('Print All Forms') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-5 col-lg-5 col-md-12 clientinformation custom_box">
                                <div class="clientinformation_scnd-inner">
                                    <div class="section-body padd-10" style="padding-top:0px;">
                                        <div class="row">
                                            <div class="col-md-12 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label
                                                            class="box_heading"><strong>{{ __('Client Information:') }}</strong></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a href="{{ route('download_attorney_bci', ['id'=> $clentData['id']])}}"
                                                            class="btn-form" style="float:right">
                                                            {{ __('Atty Side Import File') }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12  mt-1">
                                                <div class="row">

                                                    <div class="col-md-12 mb-3 pt-1">
                                                        <strong>{{ __('Client type') }}</strong>
                                                        <label>
                                                            <?php echo $clentData['client_type'] > 0 ? ArrayHelper::getClientTypeLabelArray($clentData['client_type']) : ''; ?>
                                                        </label>
                                                    </div>

                                                    <div class="col-md-6 mb-2">
                                                        <strong>{{ __('Debtor 1') }}</strong>
                                                        <lable><?php echo $onlyDebtor; ?></lable>
                                                    </div>
                                                    <div class="col-md-6 mb-2">
                                                        <?php if (!empty(trim($spousename))) { ?>
                                                        <strong>{{ __('Debtor 2') }}</strong>
                                                        <lable><?php echo $spousename; ?></lable>
                                                        <?php
                                                        } ?>
                                                    </div>

                                                    <div class="col-md-4">

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-2 clent-add-cs">
                                                <label>{{ __('Client Address:') }}</label>
                                                <span><?php echo $address; ?></span>
                                            </div>
                                            <div class="col-md-12  mt-3 mb-2 mailing_add_cs">

                                                <div class="form-group">
                                                    <label>{{ __('Use a Mailing Address') }}</label>
                                                    <div class="d-inline radio-primary">
                                                        <input
                                                            <?php echo Helper::validate_key_toggle('is_this_mailing_address', $savedData, 1); ?>
                                                            type="radio" onclick="isMailingAddress('yes')"
                                                            id="is_this_mailing_address_yes"
                                                            name="is_this_mailing_address" value="1"
                                                            class="required is_this_mailing_address" />
                                                        <label for="is_this_mailing_address_yes"
                                                            class="cr">{{ __('Yes') }}</label>
                                                    </div>
                                                    <div class="d-inline radio-primary">
                                                        <input type="radio"
                                                            <?php echo Helper::validate_key_toggle('is_this_mailing_address', $savedData, 0); ?>
                                                            onclick="isMailingAddress('no')"
                                                            id="is_this_mailing_address_no"
                                                            name="is_this_mailing_address" value="0"
                                                            class="required is_this_mailing_address" />
                                                        <label for="is_this_mailing_address_no"
                                                            class="cr">{{ __('No') }}</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div
                                                    class="row new_address_div <?php echo Helper::key_hide_show_v('is_this_mailing_address', $savedData); ?>">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>{{ __('Current Address') }}</label>
                                                            <div class="input-group mb-4">
                                                                <input id="new_address"
                                                                    placeholder="{{ __('Address') }}" type="text"
                                                                    class="form-control"
                                                                    value="<?php echo Helper::validate_key_value('new_address', $savedData); ?>"
                                                                    name="new_address">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>{{ __('City') }}</label>
                                                            <div class="input-group mb-4">
                                                                <input id="new_city" placeholder="{{ __('City') }}"
                                                                    type="text" class="form-control"
                                                                    value="<?php echo Helper::validate_key_value('new_city', $savedData); ?>"
                                                                    name="new_city">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>{{ __('State') }}</label>
                                                            <div class="input-group mb-4">
                                                                <select class="form-control required" id="new_state"
                                                                    name="new_state">
                                                                    <option value="">{{ __('Please Select State') }}
                                                                    </option>
                                                                    <?php echo AddressHelper::getStatesList(Helper::validate_key_value('new_state', $savedData)); ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Zip</label>
                                                            <div class="input-group mb-4">
                                                                <input id="new_zip" placeholder="Zip" type="text"
                                                                    class="allow-5digit form-control"
                                                                    value="<?php echo Helper::validate_key_value('new_zip', $savedData); ?>"
                                                                    name="new_zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if (empty($ispetitionPackageAdded)) { ?>

                            <div class="col-md-12">
                                <div class="section_one alert-msg">
                                    <span class="red">{{ __('Alert:') }}</span><span> Petition preparation has not been
                                        purchased for this client. A watermark will appear on ALL PDF'S. <a
                                            href="javascript:void(0)"
                                            onclick="packagePurchasePopup('petition','<?php echo $client_id; ?>','<?php echo route('package_purchase_popup'); ?>')"
                                            style="text-decoration:underline !important;"> Click here</a>
                                        {{ __('to purchase petition preparation for this client.') }}</span>
                                </div>
                            </div>

                            <?php } ?>

                            <div class="col-md-12 petitionPreperation mb-4">
                                <div class="custom-add_box">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-group mb-3">
                                                <label class="box_heading"><strong>{{ __('Petition Preparation:') }}
                                                    </strong></label>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            <div
                                                class="section_one <?php if ($requestStatus == '') { ?>hide-data<?php }?> alert-msg pdf-alert-msg">
                                                <?php $compath = base_path('resources/local_forms_clients/'.$client_id.'/'.$zipcode.'/Combine.zip'); ?>
                                                <label class="d-flex"><?php if ($requestStatus == 1) { ?><span
                                                        class="queue_msg"><?php echo $inQueue > 0 && $requestStatus == 1 ? $inQueue. " in queue " : ''; ?></span>
                                                    <span
                                                        class="pending-req">&nbsp;{{ __('System Preparing Complete Petition') }}</span>
                                                    <div class="sloader"></div><?php } ?>
                                                    <span
                                                        class='downloadcombinedlink <?php if ($requestStatus != 2) {
                                                            echo "hide-data";
                                                        }?>'>
                                                        Your combined pdf is ready. <a
                                                            href="<?php echo route('downloadCombined', ['id' => $client_id,'zip' => $zipcode])?>"
                                                            onclick="downloadZip('<?php echo $compath; ?>')">
                                                            {{ __('click here to Download.') }}</a></span>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mt-3">
                                        <div class="col">
                                            <a class="off-btn generate_combined_pdf btn-form   generate_combined"
                                                onclick="saveToDb(true,true)" href="javascript:void(0)">
                                                <span class="card-title-text">{{ __('Prepare petition for filing') }}
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="off-btn btn-form float-right "
                                                href="{{route('download_cliet_creditors',['id' => $client_id])}}">
                                                <span class="card-title-text">{{ __('Creditors.Text File') }}</span>
                                            </a>
                                        </div>

                                        <div class="col">
                                            <div class="input-group mb-3">
                                                <a href="javascript:void(0)" class="btn-form  align-right"
                                                    onclick="filingPopup()">
                                                    {{ __('Filing Information') }}</a>

                                            </div>
                                        </div>
                                         <div class="<?php echo LocalFormHelper::chapter13Hide($district_id); ?> col chapter13_plan <?php  if ($chapterName != 'Chapter 13') { ?> disabled <?php  } ?>">
											<a href="javascript:void(0)" class="btn-form float-right " onclick="planPopup()">
												{{ __('Chapter 13 Plan') }}</a>
										</div> 
										<?php if ($isParalegalPackageAdded) { ?>
											<div class="col">
												<a href="javascript:void(0)" class="btn-form float-right " onclick="paralegalPopup()">
													{{ __('Paralegal Check') }}</a>
											</div>
										<?php } ?>


                                        <div class="col">
                                            <a class="off-btn btn-form float-right "
                                                href="<?php echo route('resetToClientQuestionnaire', ['id' => $client_id]); ?>">
                                                <span
                                                    class="card-title-text">{{ __('Reset To Client Questionnaire') }}</span>
                                            </a>
                                        </div>

                                        <div class="col">
                                            <a class="off-btn btn-form float-right" href="javascript:void(0)"
                                                onclick="saveToDb(true)">
                                                <span class="card-title-text">{{ __('Save Changes') }}</span>
                                            </a>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label>{{ __('Add /s/') }}
                                                    <span>{{ __('signatures/dates') }}</span></label>
                                                <div class="d-inline radio-primary">
                                                    <input type="radio"
                                                        <?php echo Helper::validate_key_toggle('include_signature', $savedData, 1); ?>
                                                        id="include_signature" name="include_signature" value="1"
                                                        class="required include_signature" />
                                                    <label for="is_consumer_debt" class="cr">{{ __('Yes') }}</label>
                                                </div>
                                                <div class="d-inline radio-primary">
                                                    <input
                                                        <?php echo Helper::validate_key_toggle('include_signature', $savedData, 0); ?>
                                                        type="radio" id="include_signature" name="include_signature"
                                                        value="0" class="required include_signature" />
                                                    <label for="is_business_debt" class="cr">{{ __('No') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>


                        </div>
                    </div>



                    <?php
                        $expenses_utilities_info = (!empty($expenses_info['utilities'])) ? $expenses_info['utilities'] : [];
$totalExpenses = 0;
$totalExpenses += Helper::validate_key_value('rent_home_mortage', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('estate_taxes_pay', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('amount_include_property_pay', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('amount_include_home_pay', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('amount_include_homeowner_pay', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('mortgage_payments_pay', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('electricity_heating_price', $expenses_utilities_info, 'float');
$totalExpenses += Helper::validate_key_value('water_sewerl_price', $expenses_utilities_info, 'float');
$totalExpenses += Helper::validate_key_value('telephone_service_price', $expenses_utilities_info, 'float');
$totalExpenses += Helper::validate_key_value('monthly_utilities_value', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('food_housekeeping_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('childcare_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('laundry_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('personal_care_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('medical_dental_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('transportation_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('entertainment_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('charitablet_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('life_insurance_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('health_insurance_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('auto_insurance_price', $expenses_info, 'float');
$totalExpenses += (!empty($expenses_info['other_insurance_price']) && is_array($expenses_info['other_insurance_price'])) ? array_sum($expenses_info['other_insurance_price']) : $expenses_info['auto_insurance_price'];
$totalExpenses += (!empty($expenses_info['taxbills_price']) && is_array($expenses_info['taxbills_price'])) ? array_sum($expenses_info['taxbills_price']) : $expenses_info['taxbills_price'];
if (is_array($expenses_info['installmentpayments_price'])) {
    for ($i = 0; $i < count($expenses_info['installmentpayments_price']); $i++) {
        if (isset($expenses_info['installmentpayments_type'][$i])) {
            $totalExpenses += $expenses_info['installmentpayments_price'][$i];
        }
    }
}
$totalExpenses += Helper::validate_key_value('alimony_price', $expenses_info, 'float');
$totalExpenses += Helper::validate_key_value('payments_dependents_price', $expenses_info, 'float');
$mortgage_property = (!empty($expenses_info['mortgage_property'])) ? $expenses_info['mortgage_property'] : [];
$totalExpenses += Helper::validate_key_value('other_real_estate_price', $mortgage_property, 'float');
$totalExpenses += Helper::validate_key_value('tax', $mortgage_property, 'float');
$totalExpenses += Helper::validate_key_value('rental_insurance_price', $mortgage_property, 'float');
$totalExpenses += Helper::validate_key_value('home_maintenance_price', $mortgage_property, 'float');
$totalExpenses += Helper::validate_key_value('condominium_price', $mortgage_property, 'float');
$expenses_utilities_info = (!empty($expenses_info['utilities'])) ? $expenses_info['utilities'] : [];
$totalExpensesSpouse = 0;
$totalExpensesSpouse += Helper::validate_key_value('mortgage_payments_pay', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('electricity_heating_price', $expenses_utilities_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('water_sewerl_price', $expenses_utilities_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('telephone_service_price', $expenses_utilities_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('monthly_utilities_value', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('food_housekeeping_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('childcare_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('laundry_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('personal_care_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('medical_dental_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('transportation_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('entertainment_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('charitablet_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('life_insurance_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('health_insurance_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('auto_insurance_price', $spouse_expenses_info, 'float');
$ins = (isset($spouse_expenses_info['other_insurance_price']) && !empty($spouse_expenses_info['other_insurance_price']) && is_array($spouse_expenses_info['other_insurance_price'])) ? array_sum($spouse_expenses_info['other_insurance_price']) : (isset($spouse_expenses_info['other_insurance_price']) ? $spouse_expenses_info['other_insurance_price'] : 0.00);
$tax = (isset($spouse_expenses_info['taxbills_price']) && !empty($spouse_expenses_info['taxbills_price']) && is_array($spouse_expenses_info['taxbills_price'])) ? array_sum($spouse_expenses_info['taxbills_price']) : (isset($spouse_expenses_info['taxbills_price']) ? $spouse_expenses_info['taxbills_price'] : 0.00);
;
if ($ins > 0) {
    $totalExpensesSpouse += $ins;
}
if ($tax > 0) {
    $totalExpensesSpouse += $tax;
}
if (isset($spouse_expenses_info['installmentpayments_price']) && is_array($spouse_expenses_info['installmentpayments_price'])) {
    for ($i = 0; $i < count($spouse_expenses_info['installmentpayments_price']); $i++) {
        if (isset($spouse_expenses_info['installmentpayments_type'][$i])) {
            $totalExpensesSpouse += $spouse_expenses_info['installmentpayments_price'][$i];
        }
    }
}
$totalExpensesSpouse += Helper::validate_key_value('alimony_price', $spouse_expenses_info, 'float');
$totalExpensesSpouse += Helper::validate_key_value('payments_dependents_price', $spouse_expenses_info, 'float');
$mortgage_property = (!empty($spouse_expenses_info['mortgage_property'])) ? $spouse_expenses_info['mortgage_property'] : [];
$totalExpensesSpouse += Helper::validate_key_value('other_real_estate_price', $mortgage_property, 'float');
$totalExpensesSpouse += Helper::validate_key_value('tax', $mortgage_property, 'float');
$totalExpensesSpouse += Helper::validate_key_value('rental_insurance_price', $mortgage_property, 'float');
$totalExpensesSpouse += Helper::validate_key_value('home_maintenance_price', $mortgage_property, 'float');
$totalExpensesSpouse += Helper::validate_key_value('condominium_price', $mortgage_property, 'float');
$totalExpensesSpouse += Helper::validate_key_value('other_expense_value', $spouse_expenses_info, 'float');
$resultExpense = $totalExpenses + $totalExpensesSpouse;

$debtor_other_total_income = 0;
$debtorspouse_other_total_income = 0;



$debtormonthlyincome = (!empty($income_info['debtormonthlyincome'])) ? $income_info['debtormonthlyincome'] : [];
$debtorspousemonthlyincome = (!empty($income_info['debtorspousemonthlyincome'])) ? $income_info['debtorspousemonthlyincome'] : [];
$debtorspouse_payroll = 0;
$debtorspouse_payroll = \App\Models\IncomeDebtorSpouseMonthlyIncome::getWagesIncomeSum($debtorspousemonthlyincome);
$debtorspouse_gross2 = \App\Models\IncomeDebtorSpouseMonthlyIncome::overTimePerMonth($debtorspousemonthlyincome);

$debtorspouse_gross1 = \App\Models\IncomeDebtorSpouseMonthlyIncome::debtorGrossWagesMonth($debtorspousemonthlyincome);
$debtorspouse_home_pay = intval($debtorspouse_gross1) + intval($debtorspouse_gross2);
$total_monthly_debtorspouse_home_pay = 0;
if (isset($debtorspouse_payroll) && $debtorspouse_home_pay) {
    $total_monthly_debtorspouse_home_pay = $debtorspouse_home_pay - $debtorspouse_payroll;
}

$debtor_other_total_income = \App\Models\IncomeDebtorMonthlyIncome::otherIncomeTotal($debtormonthlyincome);

$debtorspouse_other_total_income = \App\Models\IncomeDebtorSpouseMonthlyIncome::otherIncomeTotal($debtorspousemonthlyincome);
$total_monthly_debtorspouse_home_pay = 0;
if (isset($debtorspouse_payroll) && $debtorspouse_home_pay) {
    $total_monthly_debtorspouse_home_pay = $debtorspouse_home_pay - $debtorspouse_payroll;
}
// line10
$debtorspouse_caluculate_income = $debtorspouse_other_total_income + $total_monthly_debtorspouse_home_pay;
$debtormonthlyincome = (!empty($income_info['debtormonthlyincome'])) ? $income_info['debtormonthlyincome'] : [];
$debtorspousemonthlyincome = (!empty($income_info['debtorspousemonthlyincome'])) ? $income_info['debtorspousemonthlyincome'] : [];
// line11
$debtor_gross1 = \App\Models\IncomeDebtorMonthlyIncome::debtorGrossWagesMonth($debtormonthlyincome);
$line11Total = $debtorspouse_caluculate_income + $debtor_gross1;
$monthlyNetIncome = $line11Total - $resultExpense;
?>

                    <?php
$htmlFormOrder = ['official-form-101' => "official_frm_101", 'official-form-106sum' => 'official_frm_106sum', 'official-form-106a_and_b' => "form_property", 'official-form-106c' => "official_frm_106c", 'official-form-106d' => "form_property_homeloan", 'official-form-106e_and_f' => "official_frm_106ef", 'official-form-106g' => "official_frm_106g", 'official-form-106h' => "official_frm_106h", 'official-form-106i' => "form_income", 'official-form-106j' => "form_expenses", 'official-form-106j-2' => "form_spouse_expenses", 'official-form-106dec' => "official_frm_106dec", 'official-form-107' => "form_financial_affairs", 'official-form-108' => "official_frm_108", 'official-form-110' => "official_frm_110", 'official-form-111' => "official_frm_111", 'official-form-109' => "official_frm_122a_1", 'official-form-122a─1supp' => "official_frm_122a_1supp", 'official-form-122a─2' => "official_frm_122a_2", 'official-form-121' => "official_frm_121", "official_form_mailing_matrix" => "official_form_mailing_matrix", "official-form-103a" => "official_frm_103a", "official-form-103b" => "official_frm_103b"];

foreach ($finalDefault as $disdata) {
    if (isset($disdata['form_tab_content'])) {
        if (isset($htmlFormOrder[$disdata['form_tab_content']]) && !empty($htmlFormOrder[$disdata['form_tab_content']])) {
            $fileName = $htmlFormOrder[$disdata['form_tab_content']];
            if ($fileName != "official_form_mailing_matrix") { ?>
                    <button type="button"
                        class="avoid-this collapsible test5 fil_{{$disdata['form_tab_content']}} <?php if (in_array($disdata['form_tab_content'], $confirm_html_forms_json)) { ?> checked <?php }?>">{{$disdata['form_name']}}
                        <span
                            class="desc-tab"><?php echo isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? "<br>".$disdata['form_tab_description'] : ''; ?></span>
                           <?php if ($disdata['form_tab_content'] == 'official-form-106a_and_b') {?>
                            <a class="btn-form mt-0 fst_res" style="margin-left:10%;" onclick="schABPopupImport()"
                                href="javascript:void(0)" >
                                <span class="card-title-text">Import Template</span>
                            </a>

                            <a class="btn-form mt-0 ml-3 fst_res" onclick="schABPopup()"
                                href="javascript:void(0)" >
                                <span class="card-title-text">Schedule A/B Template</span>
                            </a>
                      

                                <?php } ?>
                        <label class="chek_collespe"><input
                                onclick="htmlChecked('<?php echo $disdata['form_tab_content'];?>')"
                                class="collesped_check" type="checkbox" name="{{$disdata['form_tab_content']}}"
                                <?php if (in_array($disdata['form_tab_content'], $confirm_html_forms_json)) {
                                    echo "checked";
                                } ?>
                                value="1">
                            <span class="checkmark"></span></label>

                    </button>
                    <div class="collapsible_content" id="coles_{{$disdata['form_tab_content']}}">
                      
                        @include("attorney.official_form.default.$fileName")
                    </div>
                    <?php
            }
            if ($fileName == "official_form_mailing_matrix") { ?>
                    <button type="button"
                        class="avoid-this collapsible test3 fil_official_form_mailing_matrix <?php if (in_array('official_form_mailing_matrix', $confirm_html_forms_json)) {
                            echo "checked";
                        } ?>">Verification
                        of Mailing Matrix
                        <label class="chek_collespe"><input onclick="htmlChecked('official_form_mailing_matrix')"
                                class="collesped_check" type="checkbox" name="official_form_mailing_matrix"
                                <?php if (in_array('official_form_mailing_matrix', $confirm_html_forms_json)) {
                                    echo "checked";
                                } ?>
                                value="1">
                            <span class="checkmark"></span></label>


                    </button>


                    <div class="collapsible_content" id="coles_{{$disdata['form_tab_content']}}">
                        <form name="official_form_mailing_matrix" class="save_official_forms"
                            id="official_official_form_mailing_matrix" action="{{route('generate_official_pdf')}}"
                            method="post">
                            @csrf
                            <input type="hidden" name="form_id" value="official_form_mailing_matrix">
                            <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                            <section class="page-section official-form-122a─2 padd-20"
                                id="official_form_mailing_matrix">
                                <div class="container pl-2 pr-0">
                                    <?php
                                                    if (file_exists(resource_path() . '/views/attorney/official_form/localform/' . $disdata['zipcode'] . '/' . $fileName . '.blade.php')) {
                                                        $zip = $disdata['zipcode'];


                                                        ?>
                                    @include("attorney.official_form.localform.$zip.$fileName")
                                    <?php
                                                    } ?>
                                    <div class="col-md-12 mt-3 row">
                                        <x-officialForm.generatePdfButtonlocal title="Generate PDF"
                                            divtitle="official_form_mailing_matrix">
                                        </x-officialForm.generatePdfButtonlocal>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                    <?php
            }
        }
    }
}
?>
                    
                    <!-- local forms view listing -->
                    @include('attorney.official_form.common.form_view_listing', ['forms' => $localForms, 'mainLabel' => 'LOCAL FORMS'])
                    <!-- trustee forms view listing -->
                    @include('attorney.official_form.common.form_view_listing', ['forms' => $trusteeForms, 'mainLabel' => 'TRUSTEE FORMS'])

                    <?php if (LocalFormHelper::isChapterThirteenEnabled($district_id)) {  ?>
                    <?php if (!empty($chapter13localforms)) { ?>
                    <span class="nav-localheading" style="padding-left:0px;">{{ __('CHAPTER-13 LOCAL FORMS') }}</span>
                    <?php } ?>
                    <?php foreach ($chapter13localforms as $disdata) {
                        if ($disdata['type'] == 'local' && $disdata['chapter_type'] == 13) { ?>
                    <button type="button"
                        class="<?php echo LocalFormHelper::chapter13Hide($district_id); ?> avoid-this collapsible test2 fil_{{$disdata['form_tab_content']}} <?php if (in_array($disdata['form_tab_content'], $confirm_html_forms_json)) { ?> checked <?php }?>">{{$disdata['form_name']}}
                        <?php if (isset($disdata['form_tab_description']) && !empty(trim($disdata['form_tab_description']))) { ?>
                        <span
                            class="desc-tab"><?php echo isset($disdata['form_tab_description']) && !empty($disdata['form_tab_description']) ? "<br>".$disdata['form_tab_description'] : ''; ?></span>
                        <?php } ?>
                        <label class="chek_collespe"><input
                                onclick="htmlChecked('<?php echo $disdata['form_tab_content'];?>')"
                                class="collesped_check" type="checkbox" name="{{$disdata['form_tab_content']}}"
                                <?php if (in_array($disdata['form_tab_content'], $confirm_html_forms_json)) {
                                    echo "checked";
                                } ?>
                                value="1">
                            <span class="checkmark"></span></label>
                    </button>


                    <div class="<?php echo LocalFormHelper::chapter13Hide($district_id); ?> collapsible_content"
                        id="coles_{{$disdata['form_tab_content']}}">
                        <form name="official_{{$disdata['form_tab_content']}}" class="save_official_forms"
                            id="official_{{$disdata['form_tab_content']}}" action="{{route('generate_official_pdf')}}"
                            method="post">
                            @csrf
                            <input type="hidden" name="form_id" value="{{$disdata['form_tab_content']}}">
                            <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
                            <section class="page-section padd-20" id="{{$disdata['form_tab_content']}}">
                                <div class="container pl-2 pr-0">

                                    @if (file_exists( resource_path() .
                                    '/views/attorney/official_form/localform/'.$disdata['zipcode'].'/'.$disdata['form_tab_content'].'.blade.php'))
                                    @include("attorney.official_form.localform.form",['key'=>$disdata['zipcode'],'formname'=>$disdata['form_tab_content']])
                                    @endif
                                    <div class="col-md-12 mt-3 row">
                                        <x-officialForm.generatePdfButtonlocal title="Generate PDF"
                                            divtitle="coles_{{$disdata['form_tab_content']}}">
                                        </x-officialForm.generatePdfButtonlocal>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>


                    <?php	}
                        }
                    }?>

                </div>
            </div>


            <div class="row align-items-center" style="margin-left:50%;">
                <div class="form-title mb-9" style="margin-top:15px;">
                    <a  onclick="saveToDb(true,true)" href="javascript:void(0)">
                        <button type="button"
                            style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold"
                            class="float-right ml-2 ">
                            <span class="card-title-text">{{ __('Generate Combined Official PDF') }}</span>
                        </button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<style type="text/css">
.spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    background: rgba(255, 255, 255, 0.75) no-repeat center center;
    z-index: 10000;
}
</style>
<div id="loader" class="spinner">
    <img style="position: absolute;top: 40%;left: 50%;" src="{{url('/assets/img/loading2.gif')}}" alt="loading" />
    <p style="color: #012cae;font-size: 24px;text-align: center;top: 50%;position: absolute;left: 42%;">
        {{ __('Generating Petition in PDF. Hold please...') }}</p>
</div>


<script>
var setting = {
    minimumFractionDigits: 2,
    maximumFractionDigits: 2
};
var spinner = $('#loader');
$(".generate_combined").click(function() {


    /*return false;
    spinner.show();

    setCookie('downloadFinished', 0, 100);
    setTimeout(checkDownloadCookie, 1000);*/
});

var downloadTimeout;
var checkDownloadCookie = function() {
    if (getCookie("downloadFinished") == 1) {
        setCookie("downloadFinished", "false", 100);
        spinner.hide();
    } else {
        downloadTimeout = setTimeout(checkDownloadCookie, 1000);
    }
}

var setCookie = function(name, value, expiracy) {
    var exdate = new Date();
    exdate.setTime(exdate.getTime() + expiracy * 1000);
    var c_value = escape(value) + ((expiracy == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = name + "=" + c_value + '; path=/';
};

var getCookie = function(name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == name) {
            return y ? decodeURI(unescape(y.replace(/\+/g, ' '))) : y;
        }
    }
};

$(window).scroll(function() {
    var scrollDistance = $(window).scrollTop();
    // Assign active class to nav links while scolling
    $('.page-section').each(function(i) {
        if ($(this).position().top <= scrollDistance) {
            var section_id = $(this).attr('id');
            var ssize = scrollDistance - $(this).position().top;
            $('.nav-pills a').parent('li').removeClass('active');
            // $('.nav-pills a').eq(i).addClass('active');
            //$('.nav-pills a.id_' + section_id).parent("li").addClass('active');
          
        }
    });
}).scroll();

function sumIncome1011() {
    var line10 = 0;
    var line11 = 0;
    line10 = $(".line10last").val().replace(/,/g, '');
    line11 = $(".line11sum").val().replace(/,/g, '');
    var total1011 = 0;
    total1011 = parseFloat(line10) + parseFloat(line11);
    $(".totalline11").val(total1011.toLocaleString('en-IN', setting));
}

$(document).on("blur", ".line11sum", function(evt) {
    sumIncome1011();
});

function getAutoPopulateSummaryOfSchedule() {

    sumIncome1011();
    $("#sum_total_real_estate").val(($("#ab_total_real_estate").val()));
    $("#sum_total_personal_property").val(($("#ab_total_personal_property").val()));
    $("#sum_total_all_property").val(($("#ab_total_all_property-old").val()));

    $("#sum_d_Amount_of_claim").val(($("#total_dollor_amount_last_page").val()));
    $("#sum_e_f_total_claims_part1").val(($("#e_f_total_claims_part1").val()));
    $("#sum_e_f_total_claims_part2").val(($("#e_f_total_claims_part2").val()));
    $(".fi_line41a_nonpriority_unsecured_debt").val(($("#e_f_total_claims_part2").val().toLocaleString()));
    value1 = $("#e_f_total_claims_part2").val();
    value41b = value1*0.25;
    $(".fi_line41b_25percent_nonpriority_unsecured_debt").val(value41b.toLocaleString());
    var totalliblity = 0;

    if ($("#total_dollor_amount_last_page").val() != undefined) {
        totalliblity += +($("#total_dollor_amount_last_page").val()).replace(/,/g, '');
    }
    if ($("#e_f_total_claims_part1").val() != undefined) {
        totalliblity += +($("#e_f_total_claims_part1").val()).replace(/,/g, '');
    }
    if ($("#e_f_total_claims_part2").val() != undefined) {
        totalliblity += +($("#e_f_total_claims_part2").val()).replace(/,/g, '');
    }

    $("#final_sum_e_f_total_claims_part2").val(totalliblity.toLocaleString('en-IN', setting));
    $("#sum_combined_monthly_income").val(($("#i_combined_monthly_income").val()));
    $("#sum_monthly_expenses").val(($("#j_monthly_expenses").val()));
    $("#sum_Domestic_support_obligations").val(($("#ef_Domestic_support_obligations").val()));
    $("#sum_ef_Taxes_and_certain").val(($("#ef_Taxes_and_certain").val()));
    $("#sum_ef_claims_for_death").val(($("#ef_claims_for_death").val()));
    $("#sum_ef_students_loan").val(($("#ef_student_loan").val()));
    $("#sum_ef_obligation_arising").val(($("#ef_obligation_arising").val()));
    $("#sum_ef_debts_pension").val(($("#ef_debts_to_pension").val()));

    var totalefval = 0;
    if ($("#sum_Domestic_support_obligations").val() != undefined) {
        totalefval += +($("#sum_Domestic_support_obligations").val()).replace(/,/g, '');
    }
    if ($("#sum_ef_Taxes_and_certain").val() != undefined) {
        totalefval += +($("#sum_ef_Taxes_and_certain").val()).replace(/,/g, '');
    }
    if ($("#sum_ef_claims_for_death").val() != undefined) {
        totalefval += +($("#sum_ef_claims_for_death").val()).replace(/,/g, '');
    }
    if ($("#sum_ef_students_loan").val() != undefined) {
        totalefval += +($("#sum_ef_students_loan").val()).replace(/,/g, '');
    }
    if ($("#sum_ef_obligation_arising").val() != undefined) {
        totalefval += +($("#sum_ef_obligation_arising").val()).replace(/,/g, '');
    }
    if ($("#sum_ef_debts_pension").val() != undefined) {
        totalefval += +($("#sum_ef_debts_pension").val()).replace(/,/g, '');
    }
    $("#total_ef").val(totalefval.toLocaleString('en-IN', setting));

    set122a1Prices();

    populateThumbIcon();

    var total_income_122a1 = $(".total_income_122a1").val();
    $(".total_income122a2").val(total_income_122a1);
    set122a2Prices();

    $(".liabilities2").each(function() {
        var libval = $(this).val();
        var priceval = libval.split("-");
        var pricefrom = priceval[0];
        var priceTo = priceval[1];
        if (parseFloat(totalliblity) > parseFloat(pricefrom) && parseFloat(totalliblity) <= parseFloat(
            priceTo)) {
            $(this).prop('checked', true);
        }
    });
}
$('.122a_check1').change(function() {

    if (this.checked) {
        $(".meantest_green").removeAttr("style");
        $(".meantest_red").css("display", 'none');
        $(".122a_check2").prop('checked', false);
    } else {
        $(".meantest_green").css("display", 'none');
        $(".meantest_red").removeAttr("style");
    }
});

$('.122a_check2').change(function() {
    if (this.checked) {
        $(".meantest_red").removeAttr("style");
        $(".meantest_green").css("display", 'none');
        $(".122a_check1").prop('checked', false);
    } else {
        $(".meantest_green").removeAttr("style");
        $(".meantest_red").css("display", 'none');

    }
});

function populateThumbIcon() {
    var annual_income12_b = $(".annual_income12_b").val().replace(/,/g, '');
    var median_family_income = $(".median_family_income").val().replace(/,/g, '');

    if ($(".122a_check1").prop('checked') == true) {
        $(".meantest_red").removeAttr("style");
        $(".meantest_green").css("display", 'none');
    }

    if (parseFloat(annual_income12_b) < parseFloat(median_family_income)) {
        $(".meantest_green").removeAttr("style");
        $(".meantest_red").css("display", 'none');
        $(".122a_check1").prop('checked', true);
    }

    if (parseFloat(annual_income12_b) > parseFloat(median_family_income)) {
        $(".122a_check2").prop('checked', true);
        $(".meantest_red").removeAttr("style");
        $(".meantest_green").css("display", 'none');
        if ($("#not_added_official-form-122a─2").hasClass("not-added")) {
            //activateFormTab('official-form-122a─2',true);
        }
    }
}

function set122a2Prices() {
    var total122a2val = 0;
    $(".122a2_price").each(function() {
        total122a2val += +$(this).val().replace(/,/g, '');
    });
    var total_income_122a1 = $(".total_income_122a1").val();
    $(".122a2_price_total").val(total122a2val.toLocaleString('en-IN', setting));
    $(".copy_122a2_price_total").val(total122a2val.toLocaleString('en-IN', setting));
    $(".adjusting_current_mnthly_income").val((parseFloat(total_income_122a1.replace(/,/g, '')) - parseFloat(
        total122a2val)).toLocaleString('en-IN', setting));
}

function set122a1Prices() {

    var income_gross = $(".income_gross").val().replace(/,/g, '');
    var income_gross2 = $(".income_gross2").val().replace(/,/g, '');

    var deduct_expense = $(".deduct_expense").val().replace(/,/g, '');
    var deduct_expense2 = $(".deduct_expense2").val().replace(/,/g, '');

    $(".netincome_after_deduction").val((parseFloat(income_gross) - parseFloat(deduct_expense)).toLocaleString('en-IN',
        setting));
    $(".netincome_after_deduction2").val((parseFloat(income_gross2) - parseFloat(deduct_expense2)).toLocaleString(
        'en-IN', setting));

    $(".copy_from5").val($(".netincome_after_deduction").val());
    $(".copy_from5_2").val($(".netincome_after_deduction2").val());

    var property_income_gross = $(".property_income_gross").val().replace(/,/g, '');
    var property_income_gross2 = $(".property_income_gross2").val().replace(/,/g, '');

    var property_deduct_expense = $(".property_deduct_expense").val().replace(/,/g, '');
    var property_deduct_expense2 = $(".property_deduct_expense2").val().replace(/,/g, '');

    $(".property_netincome_after_deduction").val((parseFloat(property_income_gross) - parseFloat(
        property_deduct_expense)).toLocaleString('en-IN', setting));
    $(".property_netincome_after_deduction2").val((parseFloat(property_income_gross2) - parseFloat(
        property_deduct_expense2)).toLocaleString('en-IN', setting));

    $(".property_copy_from5").val(parseFloat($(".property_netincome_after_deduction").val().replace(/,/g, ''))
        .toLocaleString('en-IN', setting));
    $(".property_copy_from5_2").val(parseFloat($(".property_netincome_after_deduction2").val().replace(/,/g, ''))
        .toLocaleString('en-IN', setting));

    var other_source_pages1 = parseFloat($(".other_source_pages1").val().replace(/,/g, '')).toLocaleString('en-IN',
        setting);
    var other_source_pages2 = parseFloat($(".other_source_pages2").val().replace(/,/g, '')).toLocaleString('en-IN',
        setting);

    var other_pages1 = $(".other_pages1").val().replace(/,/g, '');
    var other_pages2 = $(".other_pages2").val().replace(/,/g, '');

    $(".total_from_pages1").val((parseFloat(other_source_pages1) + parseFloat(other_pages1)).toLocaleString('en-IN',
        setting));
    $(".total_from_pages2").val((parseFloat(other_source_pages2) + parseFloat(other_pages2)).toLocaleString('en-IN',
        setting));

    var pricetobesum_total = 0;
    $(".pricetobesum").each(function() {
        pricetobesum_total += +$(this).val().replace(/,/g, '');

    });
    $(".pricetobesum_total").val(pricetobesum_total.toLocaleString('en-IN', setting));

    var pricetobesum2_total = 0;
    $(".pricetobesum2").each(function() {
        pricetobesum2_total += +$(this).val().replace(/,/g, '');
    });
    $(".pricetobesum2_total").val(pricetobesum2_total.toLocaleString('en-IN', setting));
    var totaldebtoranddebtor2 = (parseFloat(pricetobesum_total) + parseFloat(pricetobesum2_total));
    $(".total_income_122a1").val(totaldebtoranddebtor2.toLocaleString('en-IN', setting));
    $(".copyfromline11").val($(".total_income_122a1").val());
    var pricefromline11 = $(".copyfromline11").val().replace(/,/g, '');
    $(".annual_income12_b").val((parseFloat(pricefromline11) * 12).toLocaleString('en-IN', setting));

}
$(document).on("keyup", ".price121a_1", function(evt) {
    set122a1Prices();
});
$(document).on("keyup", ".meantest_prices", function(evt) {
    set122a2Prices();
});

isMailingAddress = function(selected_value) {

    if (selected_value == 'no') {
        $(".new_address_div").addClass("hide-data");
    }
    if (selected_value == 'yes') {
        $(".new_address_div").removeClass("hide-data");
    }
}

setDistrict = function(obj1) {

    if (obj1.value != '') {
        // var objectValue = $(obj1).find(':selected').data('id');
        $(".district-select").val(obj1.value);
    }
    
    var requeststatus = '<?php echo $requestStatus; ?>';
    if (requeststatus == 1) {
        if (!confirm("By changing district your request for pdf generation will be canceled automatically.")) {
            return;
        }
    }
    if (requeststatus == 2) {
        if (!confirm(
                "By changing district your combined petition pdf for already saved district will no longer be available for download."
                )) {
            return;
        }
    }
    if (requeststatus == 1 || requeststatus == 2) {
        delteRequestAndCombinedPDF();
    }
    
    saveToDb();
    //$("#is_exemptions_state").prop("checked", true);
    //$("#is_exemptions_federal").prop("checked", false);

}
delteRequestAndCombinedPDF = function() {

    var ajaxurl = "<?php echo route('delete_last_placed_request', ['client_id' => $client_id]); ?>";
    laws.ajax(ajaxurl, {}, function(response) {});
}
setChapter = function(obj1) {
    if (obj1.value != '') {
        if (obj1.value == 'chapter7') {
            $(".chapter7").prop("checked", true);
            $(".chapter7").val(1);
            $(".chapter13").prop("checked", false);
            $(".chapter13_plan").addClass("disabled");
            $(".hrlyprice").addClass('hide-data');
            $(".ch13_guide").addClass("hide-data");
            $(".attrnyfee-block").removeClass("col-md-7");
            $(".attrnyfee-block").addClass("col-md-6");
            $(".debtblock").removeClass("col-md-5");
            $(".debtblock").addClass("col-md-6");

            $(".ch7_guide").removeClass("hide-data");
            $(".ch7_guide").removeAttr('style');
        }
        if (obj1.value == 'chapter13') {
            $(".chapter13").prop("checked", true);
            $(".chapter13").val(1);
            $(".chapter7").prop("checked", false);
            $(".chapter13_plan").removeClass("disabled");
            $(".hrlyprice").removeClass('hide-data');
            $(".ch7_guide").addClass("hide-data");
            $(".ch13_guide").removeClass("hide-data");
            $(".ch13_guide").removeAttr('style');
            $(".attrnyfee-block").removeClass("col-md-6");
            $(".attrnyfee-block").addClass("col-md-7");
            $(".debtblock").removeClass("col-md-6");
            $(".debtblock").addClass("col-md-5");
        }
        saveToDb(false, false);
    }

}

createcreditorPDF = function() {
    var ajaxurl = "<?php echo route('createCreditorPdfByAjax', ['id' => $client_id]); ?>";
    laws.ajax(ajaxurl, {}, function(response) {});
}

saveToDb = function(complete_html = false, request_for_combined = false) {


    var ajaxurl = "<?php echo route('save_attorney_data'); ?>";
    var editor_chepter = $('#editor_chepter').val();
    var attorney_price = $(".attorney_price").val();
    var attorney_hourly_rate = $(".attorney_hourly_rate").val();
    var attorney_date = $(".attorney_date").val();
    var district_attorney = $("#district_attorney").val();
    var district_id = $("#district_attorney").find(":selected").data('id');
    var district_name = $("#district_attorney").find(":selected").data('name');
    var district_full_name = $("#district_attorney").find(":selected").val();
    var household_size = $("#household_size").find(":selected").val();
    var trustee = $("#trustee-select").find(":selected").val();
   
    var is_exemptionstext = $('input[name="is_exemptions"]:checked').val();
    var debtbtextvalue = $('input[name="is_debt_c_b"]:checked').val();
    var case_number = $(".case_number").val();
    var client_id = "<?php echo $client_id; ?>";
    var new_address = $("#new_address").val();
    var new_city = $("#new_city").val();
    var new_state = $("#new_state").val();
    var new_zip = $("#new_zip").val();
    var include_signature = $('input[name="include_signature"]:checked').val();
    var is_this_mailing_address = $('input[name="is_this_mailing_address"]:checked').val();
    var is_paralegal = $('input[name=is_paralegal]:checked') ? 1 : 0;
    var loadmsg = "Please wait, form data getting save.";
    if (request_for_combined == true) {

        loadmsg = "Please wait, we are placing your request for petition preparation.";

    }
    spinner.show();
    $("#loader p").text(loadmsg);

    if (complete_html == true) {
        saveEfForm();
       
    }

    laws.ajax(ajaxurl, {
        new_address: new_address,
        new_city: new_city,
        new_state: new_state,
        new_zip: new_zip,
        household_size: household_size,
        client_id: client_id,
        district_id: district_id,
        district_name: district_name,
        district_full_name: district_full_name,
        is_paralegal: is_paralegal,
        is_this_mailing_address: is_this_mailing_address,
        case_number: case_number,
        district_attorney: district_attorney,
        attorney_date: attorney_date,
        editor_chepter: editor_chepter,
        debtbtextvalue: debtbtextvalue,
        is_exemptionstext: is_exemptionstext,
        include_signature: include_signature,
        attorney_price: attorney_price,
        attorney_hourly_rate: attorney_hourly_rate,
        trustee: trustee,
        request_for_combined: (request_for_combined == true ? 1 : 0)
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 0) {
            $.systemMessage(res.msg, 'alert--danger', true);
        } else if (res.status == 1) {
            
                spinner.hide();
                $.systemMessage(res.msg, 'alert--success', true);
                window.location.href = '<?php echo route('attorney_offical_form', ['id' => $client_id]) ?>';
           
           
        }

    });
}


isExemptions = function(exemption_type) {
    $(".exemption-by-attorney").val(exemption_type);
    if (exemption_type != '') {
        ajaxurl = "<?php echo route('attorney_exemption'); ?>";
        var stateval = $('#district_attorney').find(':selected').attr('data-name');
        laws.ajax(ajaxurl, {
            exemption_type: exemption_type,
            state_name: stateval
        }, function(response) {
            var res = JSON.parse(response);

            if (response.status == 0) {
                $.systemMessage(response.msg, 'alert--danger');
            } else {

                $('.exemp_select').each(function() {
                    var priceVal = ($(this).data('optionid').length > 0) ? parseFloat($(this).data(
                        'optionid').replace(/,/g, '')) : 0;
                    var linefrom = '';
                    linefrom = $(this).data('linefrom');
                    listofexeption = res.list;
                    var length = listofexeption.length;
                    var clientType = '<?php echo $clentData['client_type']; ?>';
                    var firstRow = listofexeption[0];
                    if (firstRow != undefined) {
                        var elem = $(
                            '<button type="button" class="btn btn-primary exemption-sel oo" href="javascript:void(0)">' +
                            firstRow['exemption_description'] + '</button>');
                        var opts = $('<div>');
                    }

                    for (var i = 0; i < length; i++) {
                        row = listofexeption[i];
                        var arr = [];
                        if (row['relate'] != null) {
                            linefrom = Math.floor(linefrom);
                            arr = row['relate'].split(",");
                            arr = $.map(arr, function(s) {
                                return parseFloat(s);
                            });
                            var index = -1;
                            var index = arr.indexOf(linefrom);
                            if (index != -1) {
                                firstRow = row;
                                var sttue = '';
                                sttue = firstRow['exemption_statute'];
                                $("." + $.escapeSelector("law_" + linefrom)).val(sttue);
                                var stri = '';
                                stri = $.escapeSelector("linefrom_" + linefrom);
                            }

                        }

                        var emplmt = (clientType == '3') ? row['exemption_limit_joint'] : row[
                            'exemption_limit_individual'];
                        var emplmt2 = 0;
                        if (typeof emplmt !== 'undefined' && emplmt != null) {
                            emplmt2 = parseFloat(emplmt.replace(/,/g, ''));
                        }

                        var remaining = (emplmt2 - priceVal) > 0 ? emplmt2 - priceVal : '';
                        opts.append('<div class="table-body-cs-inner row" data-description="' + row[
                                'exemption_description'] + '" data-limit="' + row[
                                'exemption_limit'] + '" data-statute="' + row[
                                'exemption_statute'] + '" value="' + row['id'] +
                            '"><div class="col-md-5"><p>' + row['exemption_description'] +
                            '</p></div><div class="col-md-3"><p>' + row['exemption_statute'] +
                            '</p></div><div class="col-md-2"><p>' + remaining +
                            '</p></div><div class="col-md-2"><p>' + emplmt + '</p></div></div>');
                    }
                    if (opts != undefined) {
                        opts.append('</div>');
                    }
                    $(this).next('div.exemp-sel-options').children('div.table-cols-cs').children(
                        'div').eq(1).html(opts);
                    if (elem != undefined) {
                        elem.append('</div>');
                    }
                    $(this).html(elem);
                    if (firstRow != undefined) {
                        $("." + stri).find("button").html(firstRow['exemption_description']);
                    }
                    //$('input[name="hiddenlinefrom_'+$(this).data('linefrom')+'"]').val(firstRow['exemption_description']);
                });
                $('.exemption-sel').addClass("exemp-red");
            }
        });
    }

    setTimeout(function() {
        $(".sc_c_description").each(function() {
            var desc = $(this).val();
            var linefrom = $(this).data('linefrom');
            var fromdb = $(this).data('lval');
            if (fromdb != '') {
                $(".linefromdb_" + linefrom).children("button").html(fromdb);
                $(".linefromdb_" + linefrom).children("button").removeClass("exemp-red");
                $(".linefromdb_" + linefrom).children("button").addClass("exemp-green");
            }
        });
    }, 500);
}

$(document).on('click', ".table-body-cs-inner", function(e) {

    var selectedstatute = $(this).attr("data-statute");
    var selecteddescription = $(this).attr("data-description");

    $(this).parent().parent().parent().parent().prev().children().html(selecteddescription);
    $(this).parent().parent().parent().parent().prev().children().removeClass("exemp-green");
    $(this).parent().parent().parent().parent().prev().children().addClass("exemp-green");
    $(this).parent().parent().parent().parent().next('textarea.exemption-by-attorney').val(selectedstatute);
    $(".exemp-sel-options").css("display", "none");
    $(".exemp-sel-options").removeClass("active");
    $(e.target).addClass("exemp-green");
    var dataId = $(this).parent().parent().parent().parent().prev().data('lineufrom');
    console.log(dataId);
    $('input[name="hiddenlinefrom_' + dataId + '"]').val(selecteddescription);

});

$(document).on('click', ".exemption-sel", function(e) {
    $(e.target).removeClass("exemp-red");
    $(e.target).addClass("exemp-green");
    if ($(e.target).parent('div').next(".exemp-sel-options").hasClass('active')) {
        $(e.target).parent('div').next(".exemp-sel-options").removeClass('active');
    } else {
        $(e.target).parent('div').next(".exemp-sel-options").removeAttr('style');
        $(e.target).parent('div').next(".exemp-sel-options").addClass('active');
    }
});


$(document).mouseup(function(e) {
    var container = $(".exemp-sel-options");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        if ($(e.target).hasClass('exemp_select')) {
            $(e.target).children("button").removeClass("exemp-red");
            $(e.target).children("button").addClass("exemp-green");
        }

        $(e.target).parent('div').next('.exemption-sel').addClass("exemp-green");
        container.hide();
        $(container).removeClass("active");
        var description = $(e.target).children("button").text();
        $('input[name="hiddenlinefrom_' + $(e.target).data('lineufrom') + '"]').val(description);
    }
});

activateFormTab = function(form_id, noconfirm = false) {
    if (noconfirm == false) {
        if (!confirm("Are you sure you want to show this form into default forms.")) {
            return;
        }
    }
    ajaxurl = "<?php echo route('activate_form_tab_by_attorney'); ?>";
    var clientId = '<?php echo $client_id; ?>';
    laws.ajax(ajaxurl, {
        form_id: form_id,
        status: 1,
        client_id: clientId
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 1) {
            $.systemMessage(res.msg, 'alert--success', true);
            window.location.href = '<?php echo route('attorney_offical_form', ['id' => $client_id]) ?>';
        } else {
            $.systemMessage(res.msg, 'alert--danger', true);
        }
    });
}

deactivateFormTab = function(form_id) {
    if (!confirm("Are you sure you want to hide this form from default forms.")) {
        return;
    }
    ajaxurl = "<?php echo route('activate_form_tab_by_attorney'); ?>";
    var clientId = '<?php echo $client_id; ?>';
    laws.ajax(ajaxurl, {
        form_id: form_id,
        status: 0,
        client_id: clientId
    }, function(response) {
        var res = JSON.parse(response);
        if (res.status == 1) {
            $.systemMessage(res.msg, 'alert--success', true);
            window.location.href = '<?php echo route('attorney_offical_form', ['id' => $client_id]) ?>';

        } else {
            $.systemMessage(res.msg, 'alert--danger', true);
        }
    });
}
isConsumerDebt = function(debt_type) {
    if (debt_type == 'consumer') {
        $(".consumer_yes").prop("checked", true);
        $(".consumer_no").prop("checked", false);
        $(".business_no").prop("checked", true);
        $(".business_yes").prop("checked", false);
    }

    if (debt_type == 'business') {
        $(".business_yes").prop("checked", true);
        $(".business_no").prop("checked", false);
        $(".consumer_yes").prop("checked", false);
        $(".consumer_no").prop("checked", true);
    }

}
$(document).ready(function() {
    $(".collapsible.official_frm_101").next(".collapsible_content").show();




    var selEx = $("input[name='is_exemptions']:checked").val();

    if (selEx == 1) {
        isExemptions('State');

    }
    if (selEx == 0) {
        isExemptions('Federal');
    }
    createcreditorPDF();
    //$("#is_exemptions_state").trigger("click");

    $(document).on('blur', ".attorney_date", function(e) {
        var attorneyDate = e.target.value;
        $(".date-by-attorney").val(attorneyDate);
    });

    $(document).on('blur', "#new_address", function(e) {
        $(".ma-address").val(e.target.value);
    });
    $(document).on('blur', "#new_city", function(e) {
        $(".ma-city").val(e.target.value);
    });
    $(document).on('blur', "#new_state", function(e) {
        $(".ma-state").val(e.target.value);
    });
    $(document).on('blur', "#new_zip", function(e) {
        $(".ma-zip").val(e.target.value);
    });

    $(document).on('blur', ".attorney_price", function(e) {
        var attorneyprice = e.target.value;
        $(".price-by-attorney").val(attorneyprice);
    });

    $(document).on('blur', ".attorney_hourly_rate", function(e) {
        var attorneyprice = e.target.value;
        $(".price-hourly-attorney").val(attorneyprice);
    });


    $("#sum_current_monthly_income").val($(".wages-price").val());
    $("input.date_filed").bind("paste", function(e) { //also changed the binding too
        e.preventDefault();
    });

    calculateSchdIPrices();
    getAutoPopulateSummaryOfSchedule();
    schJ2Calculation();
    schJCalculation();
    var county_division = "<?php echo strtoupper($fips_division); ?>";
    $(".division_select").val(county_division);
    checkByPayIncome();

});

$(document).on('input', ".date_filed", function(e) {

    this.type = 'text';
    var input = this.value;
    if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
    var values = input.split('/').map(function(v) {
        return v.replace(/\D/g, '')
    });
    if (values[0]) values[0] = checkValue(values[0], 12);
    if (values[1]) values[1] = checkValue(values[1], 31);
    var output = values.map(function(v, i) {
        return v.length == 2 && i < 2 ? v + '/' : v;
    });
    this.value = output.join('').substr(0, 10);
});


$(document).on('blur', ".date_filed", function(e) {

    this.type = 'text';
    var input = this.value;
    var values = input.split('/').map(function(v, i) {
        return v.replace(/\D/g, '')
    });
    var output = '';

    if (values.length == 3) {
        var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
        var month = parseInt(values[0]) - 1;
        var day = parseInt(values[1]);
        var d = new Date(year, month, day);
        if (!isNaN(d)) {
            var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
            output = dates.map(function(v) {
                v = v.toString();
                return v.length == 1 ? '0' + v : v;
            }).join('/');
        };
    };
    this.value = output;
});

function checkValue(str, max) {
    if (str.charAt(0) !== '0' || str == '00') {
        var num = parseInt(str);
        if (isNaN(num) || num <= 0 || num > max) num = 1;
        str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
    };
    return str;
};




$(document).on("wheel", "input[type=number]", function(e) {
    $(this).blur();
});

$(document).on('input', ".allow-5digit", function(e) {
    var firstFive = this.value.substring(0, 5);
    var self = $(this);
    self.val(self.val().replace(/\D/g, ""));
    if ((e.which < 48 || e.which > 57)) {
        e.preventDefault();
    }
    if (this.value.length > 5) {
        this.value = firstFive;
    }
});

$(document).on("wheel", "input[type=number]", function(e) {
    $(this).blur();
});

$(".price-field").on({
    keyup: function() {
        formatCurrency($(this));
    },
    blur: function() {
        formatCurrency($(this), "blur");
    }
});


function formatNumber(n) {
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}


function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.
    // get input value
    var input_val = input.val();
    // don't validate empty input
    if (input_val === "") {
        if (blur === "blur") {
            input.val('0.00');
            return;
        } else {
            return;
        }
    }
    // original length
    var original_len = input_val.length;
    // initial caret position
    var caret_pos = input.prop("selectionStart");
    // check for decimal
    if (input_val.indexOf(".") >= 0) {
        // get position of first decimal
        // this prevents multiple decimals from
        // being entered
        var decimal_pos = input_val.indexOf(".");
        // split number by decimal point
        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);
        // add commas to left side of number
        left_side = formatNumber(left_side);
        // validate right side
        right_side = formatNumber(right_side);
        // On blur make sure 2 numbers after decimal
        if (blur === "blur") {
            right_side += "00";
        }
        // Limit decimal to only 2 digits
        right_side = right_side.substring(0, 2);
        // join number by .
        input_val = left_side + "." + right_side;
    } else {
        // no decimal entered
        // add commas to number
        // remove all non-digits
        input_val = formatNumber(input_val);
        // final formatting
        if (blur === "blur") {
            input_val += ".00";
        }
    }
    // send updated string to input
    input.val(input_val);
    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}

saveVolPetForm = function() {
    var form1 = $("#official_frm_101");
    var dataString1 = $(form1).serialize();
    dataString1 += '&form_id=vol_petition&client_id='.$client_id;
    $.ajax({
        type: "POST",
        url: "<?php echo route('saveFormAjax'); ?>",
        data: dataString1,
        async: true,
        success: function() {

        }
    });
}

function selectPopup(e) {
    $('.exemp-sel-div').css("display", "block");
}

meanTestPopup = function() {
    $(".id_official-form-122a─2").trigger('click');
    var client_id = "<?php echo $client_id; ?>";
    ajaxurl = "<?php echo route('mean_test_popup'); ?>";
    laws.ajax(ajaxurl, {
        client_id: client_id
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
}

schABPopup = function() {
    var client_id = "<?php echo $client_id; ?>";
    ajaxurl = "<?php echo route('sch_ab_popup'); ?>";
    laws.ajax(ajaxurl, {
        client_id: client_id
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
}

schABPopupImport = function() {
   
   
    var total = document.getElementsByClassName("official_frm_106a_and_b").length;
    spinner.show();
    $('.official_frm_106a_and_b').each(function(index) {
        var form = $(this);

        var dataString = $(form).serialize();
    $.ajax({
        type: "POST",
        url: "<?php echo route('submitFormAjax'); ?>",
        data: dataString,
        async: true,
        success: function() {
            setupabImport();
        }
    });
});
}


setupabImport = function(){
    var client_id = "<?php echo $client_id; ?>";
                ajaxurl = "<?php echo route('import_ab_template'); ?>";
                laws.ajax(ajaxurl, {
                    client_id: client_id
                }, function(response) {
                    var res = JSON.parse(response);
                    if (res.status == 1) {
                        $.systemMessage(res.msg, 'alert--success', true);
                        window.location.href = '<?php echo route('attorney_offical_form', ['id' => $client_id]) ?>';
                    } else {
                        $.systemMessage(res.msg, 'alert--danger', true);
                    }
                });
}



submitSchDForm = function() {
    var total = document.getElementsByClassName("official_frm_106d").length;
    spinner.show();
    $('.official_frm_106d').each(function(index) {
        var form = $(this);

        var dataString = $(form).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo route('submitFormAjax'); ?>",
            data: dataString,
            async: true,
            success: function() {
                if (index === total - 1) {
                    $(".official_frm_106d_first").submit();
                    setTimeout(function() {
                        spinner.hide();
                    }, 2000);

                }
            }
        });
    });
}

generateIndividualPDF = function(first_form_name, child_form_name) {
    var total = document.getElementsByClassName(child_form_name).length;
    
    spinner.show();
    if(total==0){
        $("." + first_form_name).submit();
        setTimeout(function() {
            spinner.hide();
        }, 2000);

        }
    $('.' + child_form_name).each(function(index) {
        var form = $(this);
       
        var dataString = $(form).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo route('submitFormAjax'); ?>",
            data: dataString,
            async: true,
            success: function() {
                
                if (index === total - 1) {
                    $("." + first_form_name).submit();
                    setTimeout(function() {
                        spinner.hide();
                    }, 2000);

                }
            }
        });
    });
}

generateEFPDF = function() {
    var total = document.getElementsByClassName("official_ef_forms").length;
    spinner.show();
    $('.official_ef_forms').each(function(index) {
        var form = $(this);

        var dataString = $(form).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo route('submitFormAjax'); ?>",
            data: dataString,
            async: true,
            success: function() {
                if (index === total - 1) {
                    $(".official_ef_form_first").submit();
                    setTimeout(function() {
                        spinner.hide();
                    }, 2000);

                }
            }
        });
    });
}

saveEfForm = function() {
    $('.save_official_forms').each(function(index) {
        var form = $(this);
        var dataString = $(form).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo route('saveFormAjax'); ?>",
            data: dataString,
            async: true,
            success: function() {}
        });
    });
}

generateIPDF = function() {
    var total = document.getElementsByClassName("official_106i_form").length;
    spinner.show();
    if(total==0){
        $(".official_106i_form_first").submit();
        spinner.hide();
    }
    
    $('.official_106i_form').each(function(index) {
        var form = $(this);
        var dataString = $(form).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo route('submitFormAjax'); ?>",
            data: dataString,
            async: true,
            success: function() {
                if (index === total - 1) {
                    $(".official_106i_form_first").submit();
                    setTimeout(function() {
                        spinner.hide();
                    }, 2000);

                }
            }
        });
    });
}


function createConbinedPDF(excludepdf, new_url, total, comabine_with_default) {

    $('form').each(function(e) {
        //var form_id = $(this).closest('form').find('input["name=form_id"]').val();
        var form = $(this);

        var dataString = $(form).serialize();
        $.ajax({
            type: "POST",
            url: "<?php echo route('submitFormAjax'); ?>",
            data: dataString,
            async: false,
            success: function() {
                if (e === total - 1) {
                    var form = $(document.createElement('form'));
                    $(form).attr("action", new_url);
                    $(form).attr("method", "POST");

                    var input = $("<input>").attr("type", "hidden")
                        .attr("name", "exclude_fields")
                        .val(excludepdf);
                    var input = $("<input>").attr("type", "hidden")
                        .attr("name", "comabine_with_default")
                        .val(comabine_with_default);
                    var token = $("<input>").attr("type", "hidden")
                        .attr("name", "_token")
                        .val($('meta[name="csrf-token"]').attr('content'));


                    $(form).append($(input));
                    $(form).append($(token));
                    $(document.body).append(form);
                    $(form).submit();

                    setTimeout(function() {
                        spinner.hide();
                    }, 2000);
                }
            }
        });
        //e.preventDefault();
    });
}

checkParalegal = function() {
    var is_check = $(".is_paralegal").prop('checked');
    var isParalegalPackageAdded = <?php echo $isParalegalPackageAdded ?? 0; ?>;
    if (is_check == true && isParalegalPackageAdded == 0) {
        if (confirm("Paralegal Assistant addon not added for this client, do you want to add it?")) {
            packagePurchasePopup('paralegal', '<?php echo $client_id; ?>',
                "<?php echo route('package_purchase_popup'); ?>");
            return;
        }
    }
}

paralegalPopup = function() {



    var client_id = "<?php echo $client_id; ?>";
    var businessEIN = "<?php echo $businessEIN;?>";
    var ssn1 = "<?php echo $ssn1;?>";
    var hasssn = "<?php echo Helper::validate_key_value('has_security_number', $BasicInfoPartA); ?>";
    var hasssn2 = "<?php echo Helper::validate_key_value('has_security_number', $BasicInfoPartB); ?>";
    var itin_full = "<?php echo $itin_full ; ?>";
    var income_q4_d1 = "<?php echo Helper::validate_key_value('total_amount_income', $financialaffairs_info); ?>";
    var income_q4_d2 =
        "<?php echo Helper::validate_key_value('total_amount_income', $financialaffairs_info) == 1 ? Helper::validate_key_value('total_amount_income_spouse', $financialaffairs_info) : 0; ?>";
    var income_q5_d1 =
        "<?php echo  Helper::validate_key_value('other_income_received_income', $financialaffairs_info); ?>";
    var income_q5_d2 =
        "<?php echo Helper::validate_key_value('other_income_received_income', $financialaffairs_info) == 1 ? Helper::validate_key_value('other_income_received_income_spouse', $financialaffairs_info) : 0; ?>";
    ajaxurl = "<?php echo route('paralegal_popup'); ?>";
    laws.ajax(ajaxurl, {
        client_id: client_id,
        any_other_name: businessEIN,
        ssn1: ssn1,
        hasssn: hasssn,
        hasssn2: hasssn2,
        itin_full: itin_full,
        income_q4_d1: income_q4_d1,
        income_q4_d2: income_q4_d2,
        income_q5_d1: income_q5_d1,
        income_q5_d2: income_q5_d2,
        usedbizdata: <?php echo json_encode($usedbizdata['own_business_name'] ?? []); ?>

    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
}

planPopup = function() {
    var client_id = "<?php echo $client_id; ?>";
    ajaxurl = "<?php echo route('chapter_pan_popup'); ?>";
    laws.ajax(ajaxurl, {
        client_id: client_id
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
}

filingPopup = function() {
    var client_id = "<?php echo $client_id; ?>";
    ajaxurl = "<?php echo route('filing_information_popup'); ?>";
    laws.ajax(ajaxurl, {
        client_id: client_id
    }, function(response) {
        laws.updateFaceboxContent(response, 'large-fb-width');
    });
}
generateCombinedPDF1 = function() {
    $(".pdf-alert-msg").removeClass("hide-data");
};

$(document).on("blur", ".schd_i_price", function(evt) {
    calculateSchdIPrices();
});
$(document).on("blur", ".schj_income", function(evt) {
    schJCalculation();
});
$(document).on("blur", ".schj2_income", function(evt) {
    schJ2Calculation();


});


schJCalculation = function() {
    var fouttoTwentyOne = [
        "schj_line4_income",
        "schj_line4a_income",
        "schj_line4b_income",
        "schj_line4c_income",
        "schj_line4d_income",
        "schj_line5_income",
        "schj_line6a_income",
        "schj_line6b_income",
        "schj_line6c_income",
        "schj_line7_income",
        "schj_line8_income",
        "schj_line9_income",
        "schj_line10_income",
        "schj_line11_income",
        "schj_line12_income",
        "schj_line13_income",
        "schj_line14_income",
        "schj_line15a_income",
        "schj_line15b_income",
        "schj_line15c_income",
        "schj_line15d_income",
        "schj_line16_income",
        "schj_line17a_income",
        "schj_line17b_income",
        "schj_line17c_income",
        "schj_line17d_income",
        "schj_line18_income",
        "schj_line19_income",
        "schj_line20a_income",
        "schj_line20b_income",
        "schj_line20c_income",
        "schj_line20d_income",
        "schj_line20e_income",
        "schj_line21_income"
    ];
    var schj_line22a_income = 0;
    $(fouttoTwentyOne).each(function(key, classname) {
        var schj_line_income = 0;
        if ($("." + classname).val() != undefined) {
            schj_line_income = $("." + classname).val().replace(/,/g, '');
            schj_line22a_income = parseFloat(schj_line22a_income) + parseFloat(schj_line_income);
        }
    });

    $(".schj_line22a_income").val(schj_line22a_income.toLocaleString('en-IN', setting));
    $(".schj_line22b_income").val($(".schj2_line22_income").val());
    var schj_line22b_income = 0;
    schj_line22b_income = $(".schj_line22b_income").val().replace(/,/g, '');

    var schj_line22c_income = 0;
    schj_line22c_income = parseFloat(schj_line22a_income) + parseFloat(schj_line22b_income);
    $(".schj_line22c_income").val(schj_line22c_income.toLocaleString('en-IN', setting));


    $(".schj_line23a_income").val($(".line12_income").val());
    $(".schj_line23b_income").val($(".schj_line22c_income").val());
    var m_income_from_j = 0;
    var m_expense_from_j = 0;
    var m_income_from_j = $(".schj_line23a_income").val().replace(/,/g, '');
    var m_expense_from_j = $(".schj_line23b_income").val().replace(/,/g, '');
    var net_home_take_income = 0;
    net_home_take_income = parseFloat(m_income_from_j) - parseFloat(m_expense_from_j);
    $(".schj_line23c_income").val(net_home_take_income.toLocaleString('en-IN', setting));


}

schJ2Calculation = function() {
    var fouttoTwentyOne = [
        "schj2_line4_income",
        "schj2_line4a_income",
        "schj2_line4b_income",
        "schj2_line4c_income",
        "schj2_line4d_income",
        "schj2_line5_income",
        "schj2_line6a_income",
        "schj2_line6b_income",
        "schj2_line6c_income",
        "schj2_line7_income",
        "schj2_line8_income",
        "schj2_line9_income",
        "schj2_line10_income",
        "schj2_line11_income",
        "schj2_line12_income",
        "schj2_line13_income",
        "schj2_line14_income",
        "schj2_line15a_income",
        "schj2_line15b_income",
        "schj2_line15c_income",
        "schj2_line15d_income",
        "schj2_line16_income",
        "schj2_line17a_income",
        "schj2_line17b_income",
        "schj2_line17c_income",
        "schj2_line17d_income",
        "schj2_line18_income",
        "schj2_line19_income",
        "schj2_line20a_income",
        "schj2_line20b_income",
        "schj2_line20c_income",
        "schj2_line20d_income",
        "schj2_line20e_income",
        "schj2_line21_income"
    ];
    var schj2_line22_income = 0;
    $(fouttoTwentyOne).each(function(key, classname) {
        var schj2_line_income = 0;
        if ($("." + classname).val() != undefined) {
            schj2_line_income = $("." + classname).val().replace(/,/g, '');
            schj2_line22_income = parseFloat(schj2_line22_income) + parseFloat(schj2_line_income);
        }
    });
    $(".schj2_line22_income").val(schj2_line22_income.toLocaleString('en-IN', setting));
}

calculateSchdIPrices = function() {
    var income_line2_debtor = 0;
    var income_line2_spouse = 0;
    income_line2_debtor = $(".income_line2_debtor").val().replace(/,/g, '');
    income_line2_spouse = $(".income_line2_spouse").val().replace(/,/g, '');

    var income_overtime_debtor = 0;
    var income_overtime_spouse = 0;
    income_overtime_debtor = $(".income_overtime_debtor").val().replace(/,/g, '');
    income_overtime_spouse = $(".income_overtime_spouse").val().replace(/,/g, '');

    var income_line4_debtor = 0;
    var income_line4_spouse = 0;
    income_line4_debtor = (parseFloat(income_line2_debtor) + parseFloat(income_overtime_debtor)).toFixed(2);
    $(".income_line4_debtor").val(income_line4_debtor.toLocaleString('en-IN', setting));
    $(".copy_line4_debtor").val(income_line4_debtor.toLocaleString('en-IN', setting));

    income_line4_spouse = (parseFloat(income_line2_spouse) + parseFloat(income_overtime_spouse)).toFixed(2);
    $(".income_line4_spouse").val(income_line4_spouse.toLocaleString('en-IN', setting));
    $(".copy_line4_spouse").val(income_line4_spouse.toLocaleString('en-IN', setting));

    var inecome_line5a_debtor = 0;
    var inecome_line5a_spouse = 0
    inecome_line5a_debtor = $(".inecome_line5a_debtor").val().replace(/,/g, '');
    inecome_line5a_spouse = $(".inecome_line5a_spouse").val().replace(/,/g, '');

    var inecome_line5b_debtor = 0;
    var inecome_line5b_spouse = 0;
    inecome_line5b_debtor = $(".inecome_line5b_debtor").val().replace(/,/g, '');
    inecome_line5b_spouse = $(".inecome_line5b_spouse").val().replace(/,/g, '');

    var inecome_line5c_debtor = 0;
    var inecome_line5c_spouse = 0;
    inecome_line5c_debtor = $(".inecome_line5c_debtor").val().replace(/,/g, '');
    inecome_line5c_spouse = $(".inecome_line5c_spouse").val().replace(/,/g, '');

    var inecome_line5d_debtor = 0;
    var inecome_line5d_spouse = 0;
    inecome_line5d_debtor = $(".inecome_line5d_debtor").val().replace(/,/g, '');
    inecome_line5d_spouse = $(".inecome_line5d_spouse").val().replace(/,/g, '');

    var inecome_line5e_debtor = 0;
    var inecome_line5e_spouse = 0;
    inecome_line5e_debtor = $(".inecome_line5e_debtor").val().replace(/,/g, '');
    inecome_line5e_spouse = $(".inecome_line5e_spouse").val().replace(/,/g, '');

    var inecome_line5f_debtor = 0;
    var inecome_line5f_spouse = 0;
    inecome_line5f_debtor = $(".inecome_line5f_debtor").val().replace(/,/g, '');
    inecome_line5f_spouse = $(".inecome_line5f_spouse").val().replace(/,/g, '');

    var inecome_line5g_debtor = 0;
    var inecome_line5g_spouse = 0;
    inecome_line5g_debtor = $(".inecome_line5g_debtor").val().replace(/,/g, '');
    inecome_line5g_spouse = $(".inecome_line5g_spouse").val().replace(/,/g, '');

    var inecome_line5h_debtor = 0;
    var inecome_line5h_spouse = 0;
    inecome_line5h_debtor = $(".inecome_line5h_debtor").val().replace(/,/g, '');
    inecome_line5h_spouse = $(".inecome_line5h_spouse").val().replace(/,/g, '');

    var line6_income_debtor = 0;
    var line6_income_spouse = 0;

    line6_income_debtor = parseFloat(inecome_line5a_debtor) + parseFloat(inecome_line5b_debtor) + parseFloat(
            inecome_line5c_debtor) +
        parseFloat(inecome_line5d_debtor) + parseFloat(inecome_line5e_debtor) + parseFloat(inecome_line5f_debtor) +
        parseFloat(inecome_line5g_debtor) + parseFloat(inecome_line5h_debtor);
    $(".line6_income_debtor").val(line6_income_debtor.toLocaleString('en-IN', setting));

    line6_income_spouse = parseFloat(inecome_line5a_spouse) + parseFloat(inecome_line5b_spouse) + parseFloat(
            inecome_line5c_spouse) +
        parseFloat(inecome_line5d_spouse) + parseFloat(inecome_line5e_spouse) + parseFloat(inecome_line5f_spouse) +
        parseFloat(inecome_line5g_spouse) + parseFloat(inecome_line5h_spouse);
    $(".line6_income_spouse").val(line6_income_spouse.toLocaleString('en-IN', setting));

    var line7_income_debtor = 0;
    var line7_income_spouse = 0;
    line7_income_debtor = parseFloat(income_line4_debtor) - parseFloat(line6_income_debtor);
    $(".line7_income_debtor").val(line7_income_debtor.toLocaleString('en-IN', setting));

    line7_income_spouse = parseFloat(income_line4_spouse) - parseFloat(line6_income_spouse);
    $(".line7_income_spouse").val(line7_income_spouse.toLocaleString('en-IN', setting));

    var line8a_income_debtor = 0;
    var line8a_income_spouse = 0;
    line8a_income_debtor = $(".line8a_income_debtor").val().replace(/,/g, '');
    line8a_income_spouse = $(".line8a_income_spouse").val().replace(/,/g, '');

    var line8b_income_debtor = 0;
    var line8b_income_spouse = 0;
    line8b_income_debtor = $(".line8b_income_debtor").val().replace(/,/g, '');
    line8b_income_spouse = $(".line8b_income_spouse").val().replace(/,/g, '');

    var line8c_income_debtor = 0;
    var line8c_income_spouse = 0;
    line8c_income_debtor = $(".line8c_income_debtor").val().replace(/,/g, '');
    line8c_income_spouse = $(".line8c_income_spouse").val().replace(/,/g, '');

    var line8d_income_debtor = 0;
    var line8d_income_spouse = 0;
    line8d_income_debtor = $(".line8d_income_debtor").val().replace(/,/g, '');
    line8d_income_spouse = $(".line8d_income_spouse").val().replace(/,/g, '');

    var line8e_income_debtor = 0;
    var line8e_income_spouse = 0;
    line8e_income_debtor = $(".line8e_income_debtor").val().replace(/,/g, '');
    line8e_income_spouse = $(".line8e_income_spouse").val().replace(/,/g, '');

    var line8f_income_debtor = 0;
    var line8f_income_spouse = 0;
    line8f_income_debtor = $(".line8f_income_debtor").val().replace(/,/g, '');
    line8f_income_spouse = $(".line8f_income_spouse").val().replace(/,/g, '');

    var line8g_income_debtor = 0;
    var line8g_income_spouse = 0;
    line8g_income_debtor = $(".line8g_income_debtor").val().replace(/,/g, '');
    line8g_income_spouse = $(".line8g_income_spouse").val().replace(/,/g, '');

    var line8h_income_debtor = 0;
    var line8h_income_spouse = 0;
    line8h_income_debtor = $(".line8h_income_debtor").val().replace(/,/g, '');
    line8h_income_spouse = $(".line8h_income_spouse").val().replace(/,/g, '');

    var line9_income_debtor = 0;
    line9_income_debtor = parseFloat(line8a_income_debtor) + parseFloat(line8b_income_debtor) + parseFloat(
            line8c_income_debtor) +
        parseFloat(line8d_income_debtor) + parseFloat(line8e_income_debtor) + parseFloat(line8f_income_debtor) +
        parseFloat(line8g_income_debtor) + parseFloat(line8h_income_debtor);

    $(".line9_income_debtor").val(line9_income_debtor.toLocaleString('en-IN', setting));

    var line9_income_spouse = 0;
    line9_income_spouse = parseFloat(line8a_income_spouse) + parseFloat(line8b_income_spouse) + parseFloat(
            line8c_income_spouse) +
        parseFloat(line8d_income_spouse) + parseFloat(line8e_income_spouse) + parseFloat(line8f_income_spouse) +
        parseFloat(line8g_income_spouse) + parseFloat(line8h_income_spouse);
    $(".line9_income_spouse").val(line9_income_spouse.toLocaleString('en-IN', setting));

    var line10_income_debtor = 0;
    var line10_income_spouse = 0;
    line10_income_debtor = line7_income_debtor + line9_income_debtor;
    $(".line10_income_debtor").val(line10_income_debtor.toLocaleString('en-IN', setting));

    line10_income_spouse = line7_income_spouse + line9_income_spouse;
    $(".line10_income_spouse").val(line10_income_spouse.toLocaleString('en-IN', setting));

    var line10_sum_both = 0;
    line10_sum_both = line10_income_debtor + line10_income_spouse;
    $(".line10_sum_both").val(line10_sum_both.toLocaleString('en-IN', setting));

    var line11_income = 0;
    line11_income = $(".line11_income").val().replace(/,/g, '');

    var line12_income = 0;
    line12_income = parseFloat(line11_income) + line10_sum_both;
    $(".line12_income").val(line12_income.toLocaleString('en-IN', setting));

    $(".122_line2_debtor").val(income_line2_debtor.toLocaleString('en-IN', setting));
    $(".122_line2_spouse").val(income_line2_spouse.toLocaleString('en-IN', setting));

    $(".122a1_line3_debtor").val(line8c_income_debtor.toLocaleString('en-IN', setting));
    $(".122a1_line3_spouse").val(line8c_income_spouse.toLocaleString('en-IN', setting));
    var sch122a1_line4_debtor = 0;
    var sch122a1_line4_spouse = 0;
    sch122a1_line4_debtor = parseFloat(line8h_income_debtor) + parseFloat(line11_income);
    sch122a1_line4_spouse = parseFloat(line8h_income_spouse) + parseFloat(line11_income);
    $(".122a1_line4_debtor").val(sch122a1_line4_debtor.toLocaleString('en-IN', setting));
    $(".122a1_line4_spouse").val(sch122a1_line4_spouse.toLocaleString('en-IN', setting));

}

generateCombinedPDF = function() {
    var total = $('form').length;
    spinner.show();
    var excludepdf = "";
    var zip_code = "";
    var id = [];
    $(".check_include_form").each(function(index) {
        if ($(this).prop('checked') == false) {
            id.push($(this).val());
        }
    });

    var local_combine_with_default = [];
    var comabine_with_default = '';
    $(".local_combine_with_default").each(function(index) {
        if ($(this).prop('checked') == true) {
            local_combine_with_default.push($(this).val());
        }
    });
    comabine_with_default = local_combine_with_default.join(',');

    new_url = "{{route('generate_combine_official_pdf',$client_id)}}";
    excludepdf = id.join(',');
    spinner.show();
    setTimeout(function() {
        //createConbinedPDF(excludepdf, new_url, total, comabine_with_default);
    }, 500);


}



//});
$("#district_attorney").change(function() {
    var value = $(this).val();
    var excludepdf = "";
    $('.local_forms_list').hide();
    var zip_code = $(this).find(":selected").data('id');
    $('.local_forms_' + zip_code).show();
    if (new_url != undefined) {
        var array = new_url.split('/');
        var lastElement = array[array.length - 2];
        excludepdf = lastElement;
    }
    if (excludepdf == "") {
        excludepdf = "none";
    }
    var new_url = "{{route('generate_combine_official_pdf',$client_id)}}/" + excludepdf + "/" + zip_code;
    $('.generate_combined_pdf').attr('href', new_url);

});


$(".individual_pdf_icon").click(function() {
    var form_id = $(this).data('form_id');
    $("#coles_" + form_id).show();
    $('html, body').animate({
        scrollTop: $("#coles_" + form_id).offset().top
    }, 100);
    //var btn_element = $("#"+form_id).closest('form').find(':submit');
    var btn_element = $("#" + form_id).find(':submit');
    if (form_id == 'official-form-101') {

        $(".vp-101").trigger('click');
    }
    btn_element.trigger('click');
});
</script>
<style>
.input-group-ammend {
    position: absolute;
    bottom: 0px;
}

/* Chrome, Safari, Edge, Opera */

/* Firefox */
input[type=number] {

    border-left: none !important;
    border-right: none !important;
    border-top: none !important;
    border-radius: 0 !important;
}

.disabled a {
    pointer-events: none;
    cursor: default;
    color: #aaa !important;
}

.hide-data {
    display: none;
}

.amended {
    position: absolute;
    right: 0;
    bottom: 0;
}

.align_center {
    align-items: center;
}

.mbm10 {
    margin-bottom: -5px;
}

.sub-child {
    padding-left: 10px;
}

.sub-child .input-group-text {
    align-items: baseline;
}

.horizontal_dotted_line {
    position: relative;
}

.horizontal_dotted_line label {
    display: inline-block;
    background: #fff;
    position: relative;
    z-index: 1;
}

.small-font-item {
    padding-left: 20px !important;
}

.horizontal_dotted_line:after {
    content: '';
    position: absolute;
    top: 80%;
    left: 0;
    right: 0;
    z-index: -1;
    border-top: 1px dotted black;
}

.ml-30 {
    margin-left: 30px;
}

.sub-forms {
    padding-left: 0px;
}

.gray-box {
    background-color: #e4e4e470;
}

.navbar-nav li {
    list-style: none !important;
}

.align-center {
    text-align: center;
}



#facebook {
    top: 0px;
}



.ml-30 {
    margin-left: 30px;
}

.sub-forms {
    padding-left: 0px;
}

.gray-box {
    background-color: #e4e4e470;
}

.navbar-nav li {
    list-style: none !important;
}

.align-center {
    text-align: center;
}



#facebook {
    top: 0px;
}

.col-md-12.float-left .input-group {
    float: left;
    width: 20%;
}




select.form-control.changeExemption {
    border-color: #f00;
}

.page-section .col-md-7 {
    /*width: 100%;*/
    display: block;
    max-width: 100%;
}

.additionaltextform {
    text-align: right;
    float: right;
    padding: 0px;
    font-size: 14px;
    padding-top: 5px;
}

.page-section .container {
    max-width: 100%;
}

.alert-msg {
    margin-bottom: 20px;
    padding: 10px;
    background-color: #efefef;
    font-size: 16px;
}

.pdf-alert-msg {
    font-size: 14px;
    margin: 0px;
    padding: 0px;
    line-height: 37px;
    background: transparent;
}

.alert-msg .red {
    color: red;
    text-decoration: underline;
}

.custom-btn {
    font-size: 8px !important;
    color: #000 !important;
    margin-top: 5px;
    margin-right: 6px;
}

.chek_collespe {
    float: right;
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

.chek_collespe input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
}

.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.chek_collespe:hover input~.checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.chek_collespe input:checked~.checkmark {
    background-color: #012cae;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.chek_collespe input:checked~.checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.chek_collespe .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}

.col {
    width: auto;
    margin-left: 10px;
    float: left;
    min-height: 50px;
}

.b-light {
    padding: 15px 20px;
    color: #343a40 !important;
    background-color: #efefef;
}

.collapsible {
    background-color: #d3cece;
    color: black;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    margin-bottom: 4px;
    border: none;
    text-align: left;
    outline: none;
    font-size: 16px;
    font-weight: bold;
}

.collapsible.checked {
    background-color: #000;
    color: white;
}

.collapsible.normal {
    background-color: #d3cece;
    color: black;
}

.collapsible .desc-tab {
    font-size: 14px;
}

.collapsible_content {
    display: none;
}

.active,
.collapsible:hover {
    background-color: #000;
    color: white;
}

.exemp-sel-options.active {
    background-color: #ffffff;
}

/** spinner */
.sloader {
    border: 3px solid #d3cece;
    border-radius: 50%;
    border-top: 3px solid #012cae;
    width: 32px;
    height: 32px;
    margin-left: 20px;
    -webkit-animation: spin 2s linear infinite;
    /* Safari */
    animation: spin 2s linear infinite;
}
.dislocal{
    padding-top: 5px;
}
.checkbox_mt{
    margin-top: 9px;
}
.singleFormTitle{
    height: 30px;
    padding-top: 3px;
}
@media (max-width: 1440px) {
    .additionaltextform {
    font-size: 11px; 
    padding-top: 6px
}
.LocalForm{
  padding-right: 0px !important;
}

}
@media (max-width: 1025px) {
    .additionaltextform {
    font-size: 12px; 
    padding-top: 0px;
    float: left;
}
.LocalForm{
    height: 50px;
}
}
/* Safari */
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
    }

    100% {
        -webkit-transform: rotate(360deg);
    }
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
            content.style.display = "none";
        } else {
            content.style.display = "block";
        }
    });
}

var formId = '<?php echo $_GET['download'] ?? ''; ?>';
if(formId !=''){
    $(".nav-link").removeClass("active");
    $(".id_" + formId).addClass("active");
    $("#coles_" + formId).show();
    $('html, body').animate({
        scrollTop: $("#coles_" + formId).offset().top
    }, 100);
    $("#official_"+formId ).submit();
}


collesped = function(formId) {
    $(".nav-link").removeClass("active");
    $(".id_" + formId).addClass("active");
    $("#coles_" + formId).show();
    $('html, body').animate({
        scrollTop: $("#coles_" + formId).offset().top
    }, 100);
}
htmlChecked = function(formId) {
    var forms = [];

    $(".collesped_check").each(function() {
        if ($(this).prop("checked") == true) {
            $(this).closest('button').removeClass('normal');
            $(this).closest('button').addClass('checked');
            var formId = $(this).attr('name');
            forms.push(formId);
        } else {
            $(this).closest('button').removeClass('checked');
            $(this).closest('button').addClass('normal');
        }
    });

    var confirmes = JSON.stringify(forms);
    var ajaxurl = '<?php echo route("confirm_html_forms"); ?>';
    var client_id = "<?php echo $client_id; ?>";
    laws.ajax(ajaxurl, {
        client_id: client_id,
        confirm_html_forms_json: confirmes
    }, function(response) {});

}



var volssn = $(".vol_pet_ssn").val();
var voltin = $(".vol_pet_itin").val();
if (volssn != '') {
    $(".vol_pet_ssn_tolf").val(volssn);
}
if (voltin != '') {
    $(".vol_pet_ssn_tolf").val(voltin);
}

var requeststatus = '<?php echo $requestStatus; ?>';
if (requeststatus == 1) {
    var client_id = "<?php echo $client_id; ?>";

    setInterval(function() {
        var requesturl = '<?php echo route("check_request_queue"); ?>';
        laws.ajax(requesturl, {
            client_id: client_id
        }, function(response) {
            var res = JSON.parse(response);
            if (res.queue_count == 0) {
                $(".sloader").addClass("readypdf");
                $(".readypdf").removeClass("sloader");
                $(".downloadcombinedlink").removeClass('hide-data');
                $(".queue_msg").addClass("hide-data");
                $(".pending-req").addClass("hide-data");

            } else {
                $(".queue_msg").html("");
                $(".queue_msg").html(res.queue_count + " in queue");
                $(".queue_msg").removeClass('hide-data');
                $(".downloadcombinedlink").addClass('hide-data');
                $(".pending-req").removeClass("hide-data");
                $(".readypdf").addClass("sloader");

            }
        });
    }, 15000);
}



$(document).on("change", ".debtor_employed,.debtor_not_employed", function(evt) {
    checkByPayIncome();
});


checkByPayIncome = function() {
    if ($(".debtor_employed").is(':checked')) {
        $(".payment_received").prop('checked', true);
        $(".not_payment_received").prop('checked', false);
    }
    if ($(".debtor_not_employed").is(':checked')) {
        $(".not_payment_received").prop('checked', true);
        $(".payment_received").prop('checked', false);
    }
    if ($(".spouse_employed").is(':checked')) {
        $(".spouse_payment_received").prop('checked', true);
        $(".spouse_not_payment_received").prop('checked', false);
    }
    if ($(".spouse_not_employed").is(':checked')) {
        $(".spouse_not_payment_received").prop('checked', true);
        $(".spouse_payment_received").prop('checked', false);
    }
}

function printDocument(divName) {

	if (divName == 'main') {
		var coll = document.getElementsByClassName("collapsible");
		var i;

		for (i = 0; i < coll.length; i++) {
		    coll[i].classList.add("active");
		    var content = coll[i].nextElementSibling;
		    if (content.style.display === "block") {
		      content.style.display = "block";
		    } else {
		      content.style.display = "block";
		    }
		    //console.log(coll.length-1, i)
		    if ((coll.length-1) == i) {
				setTimeout(function() {
					createPrint(divName);
				}, 3000);
			}
		}



    } else {
        createPrint(divName);
    }
}

function createPrint(divName) {
    $("#" + divName).print({
        //Use Global styles
        globalStyles: true,
        //Add link with attrbute media=print
        mediaPrint: true,
        /*Custom stylesheet
        stylesheet : "{{ asset('assets/css/official_form_print.css')}}",
        /*stylesheet : "{{ asset('assets/css/system_messages.css')}}",
        stylesheet : "{{ asset('assets/css/facebox.css')}}",
        stylesheet : "{{ asset('assets/css/style.css')}}",
        stylesheet : "{{ asset('assets/css/custom.css')}",*/
        //Print in a hidden iframe
        iframe: false,
        //Don't print this
        noPrintSelector: ".avoid-this",
        //Add this at top
        //prepend : "<br>",
        //Add this on bottom
        //append : "<span><br>End</span>",
        //Log to console when printing is done via a deffered callback
        deferred: $.Deferred().done(function() {
            console.log('Printing done', arguments);
        })
    });

    /*
	var originalContents = document.body.innerHTML;
	var printContents = document.getElementById(divName).innerHTML;
    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
    location.reload()*/

}
changeLanguage = function(data) {
    var url = '{!! route("language_setup", ":id") !!}';
    url = url.replace(':id', data.value);
    window.location.href = url;
}

/*function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'es,en',
        layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
        autoDisplay: false}, 'google_translate_element');
}*/
</script>
<!-- <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script> -->
@endsection