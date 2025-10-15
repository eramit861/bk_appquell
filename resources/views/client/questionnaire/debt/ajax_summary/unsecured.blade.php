@php
$currentYear = date("Y");
$last15Years = range($currentYear, $currentYear - 15, -1);
if (date('d') >= 10) {
    // Current date is the 10th or later
    $currentMonth = date('m/Y'); // Current month
    $lastMonth = date('m/Y', strtotime('-1 month')); // Last month
    $monthBeforeLast = date('m/Y', strtotime('-2 months')); // Month before last
} else {
    // Current date is before the 10th
    $currentMonth = date('m/Y', strtotime('-1 month')); // Set to last month
    $lastMonth = date('m/Y', strtotime('-2 months')); // Month before last
    $monthBeforeLast = date('m/Y', strtotime('-3 months')); // Two months before last
}
$cardTypes = ArrayHelper::getDebtCardSelectionsForAttorney();
$cards_collections = ArrayHelper::getDebtCardSelections();
$i = 0;
$debt = [];
if (!empty($debts) && !empty($debts['debt_tax'])) {
    usort($debts['debt_tax'], function ($a, $b) {
        $aName = isset($a['creditor_name']) ? $a['creditor_name'] : '';
        $bName = isset($b['creditor_name']) ? $b['creditor_name'] : '';

        return strnatcasecmp($aName, $bName);
    });
}
@endphp

<div class="col-12">
    <div class="outline-gray-border-area">
        @if(!empty($debts) && !empty($debts['debt_tax']) && count($debts['debt_tax']) > 0)
            @foreach($debts['debt_tax'] as $debt)
                @include("client.questionnaire.debt.creditors")
                @php $i++; @endphp
            @endforeach
        @else
            @include("client.questionnaire.debt.creditors")
        @endif

        @php $customSaveUrl = route("debt_custom_save"); @endphp

        <input type="hidden" id="debt_url" value="{{ $customSaveUrl }}">
        <div class="add-more-div-bottom">
            <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-residence-form" onclick="addanotherDebts('{{ $customSaveUrl }}');return false;">
                <i class="bi bi-plus-lg"></i>
                Add Additional Debt(s)
            </button>
        </div>
    </div>
</div>