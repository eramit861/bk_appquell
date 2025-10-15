@php
    $i = 0;
    $currentYear = date('Y');
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
    $additional = [];
@endphp

@if (!empty($debts) && !empty($debts['additional_liens_data']) && count($debts['additional_liens_data']) > 0)
    @foreach ($debts['additional_liens_data'] as $additional)
        @include('client.questionnaire.debt.additional_liens', $additional)
        @php $i++; @endphp
    @endforeach
@else
    @include('client.questionnaire.debt.additional_liens')
@endif

@php $alCustomSaveUrl = route("additional_liens_custom_save"); @endphp

<div class="add-more-div-bottom">
    <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-additional-form"
        onclick="addAdditionalLiensForm('{{ $alCustomSaveUrl }}');return false;">
        <i class="bi bi-plus-lg"></i>
        Add Additional Secured Debts
    </button>
</div>
