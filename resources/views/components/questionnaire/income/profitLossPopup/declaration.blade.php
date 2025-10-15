<div class="col-md-12">
    <div class="light-gray-box-tittle-div my-3 border-0">
        <h2 class="text-center w-100 mb-2">DECLARATION UNDER PENALTY OF PERJURY BY DEBTOR(S)</h2>
        <div class="label-div">
            <label class="mb-0">I/We declare under penalty of perjury that the information provided is true and correct to the best of my/our knowledge and belief.</label>    
        </div>
    </div>
</div>

@php
$name1 = Helper::validate_key_value('name', $basicInfoPartA) . ' ' . Helper::validate_key_value('middle_name', $basicInfoPartA) . ' ' . Helper::validate_key_value('last_name', $basicInfoPartA);
$name2 = Helper::validate_key_value('name', $basicInfoPartB) . ' ' . Helper::validate_key_value('middle_name', $basicInfoPartB) . ' ' . Helper::validate_key_value('last_name', $basicInfoPartB);
@endphp

<x-questionnaire.income.profitLossPopup.signatureBlock
    :web_view="$webView"
    :final_date="$finalDate"
    signatureTitle="Signature of Debtor"
    :name="$name1"
    signName="debtor1_sign"
    signDateName="debtor1_sign_date">
</x-questionnaire.income.profitLossPopup.signatureBlock>
<x-questionnaire.income.profitLossPopup.signatureBlock
    :web_view="$webView"
    :final_date="$finalDate"
    signatureTitle="Signature of Co-Debtor"
    :name="$name2"
    signName="debtor2_sign"
    signDateName="debtor2_sign_date">
</x-questionnaire.income.profitLossPopup.signatureBlock>