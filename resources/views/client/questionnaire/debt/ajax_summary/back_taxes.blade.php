<div class="outline-gray-border-area">
    @php
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
        $i = 0;
        $taxNo = 1;
        $backdebts = [];
    @endphp

    @if (!empty($debts) && !empty($debts['back_tax_own']) && count($debts['back_tax_own']) > 0)
        @foreach ($debts['back_tax_own'] as $backdebts)
            @include('client.questionnaire.debt.tax_debt', $backdebts)
            @php
                $i++;
                $taxNo++;
            @endphp
        @endforeach
    @else
        @include('client.questionnaire.debt.tax_debt')
    @endif

    @php $customSaveUrl = route("back_tax_custom_save"); @endphp

    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-residence-form"
            onclick="addbackTaxes('{{ $customSaveUrl }}');return false;">
            <i class="bi bi-plus-lg"></i>
            Add State Taxes Owed to Another State
        </button>
    </div>
</div>