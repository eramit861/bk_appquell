@php
$totalBackTaxes = Helper::validate_key_value('tax_owned_state', $debts) == 1 ? count($debts['back_tax_own']) : 0;
$totalIRSTaxes = (Helper::validate_key_value('tax_owned_irs', $debts) == 1 && isset($debts['tax_irs_state']) && !empty($debts['tax_irs_state'])) ? 1 : 0;
$totalAdditionalLiens = Helper::validate_key_value('additional_liens', $debts) == 1 ? count($debts['additional_liens_data']) : 0;
$totalDomestic = Helper::validate_key_value('domestic_support', $debts) == 1 ? count($debts['domestic_tax']) : 0;
$totalUnsecured = Helper::validate_key_value('does_not_have_additional_creditor', $debts) == 1 ? count($debts['debt_tax']) : 0;
$totalCreditors = (int)$totalBackTaxes + (int)$totalIRSTaxes + (int)$totalAdditionalLiens + (int)$totalDomestic + (int)$totalUnsecured ;

$DebtsCount = "";
$totalBackTaxes = empty($totalBackTaxes) ? $DebtsCount : ' State Taxes: '.$totalBackTaxes;
$totalIRSTaxes = empty($totalIRSTaxes) ? $DebtsCount : $DebtsCount.' IRS Debt';
$totalAdditionalLiens = empty($totalAdditionalLiens) ? $DebtsCount : ' Additional liens Debt: '.$totalAdditionalLiens;
$totalDomestic = empty($totalDomestic) ? $DebtsCount : $DebtsCount.' DSO Debt: '.$totalDomestic;
$totalUnsecured = empty($totalUnsecured) ? $DebtsCount : $DebtsCount.' Unsecured Creditors: '.$totalUnsecured;
$totalCreditors = empty($totalCreditors) ? $DebtsCount : $DebtsCount.' Total Creditors: '.$totalCreditors;

$allTotal = [];

if (!empty($totalBackTaxes)) {
    array_push($allTotal, $totalBackTaxes);
}
if (!empty($totalIRSTaxes)) {
    array_push($allTotal, $totalIRSTaxes);
}
if (!empty($totalAdditionalLiens)) {
    array_push($allTotal, $totalAdditionalLiens);
}
if (!empty($totalDomestic)) {
    array_push($allTotal, $totalDomestic);
}
if (!empty($totalUnsecured)) {
    array_push($allTotal, $totalUnsecured);
}
if (!empty($totalCreditors)) {
    array_push($allTotal, $totalCreditors);
}
@endphp

<div class="light-gray-div questionnaire" id="scroll-debts">        
    <h2 >Debts</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'debt', 'forLabel' => 'Debts' ])
    <div class="row gx-3">									
        <div class="col-12">            
                        
            <div class="scroll-debts-sec">
                @include("attorney.form_elements.debts",$debts)
            </div>
        </div>
    </div>
</div>