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
    $i = 0;
    $debtNo = 1;
    $domestic = [];
    $customSaveUrl = route("dso_custom_save");
@endphp

<script>
var addresslist = {!! json_encode(AddressHelper::getStateTaxAddress()) !!};
</script>

@if(!empty($debts) && !empty($debts['domestic_tax']) && count($debts['domestic_tax']) > 0)
    @foreach($debts['domestic_tax'] as $domestic)
        @include("client.questionnaire.debt.domestic", $domestic)
        @php
            $i++;
            $debtNo++;
        @endphp
    @endforeach
@else
    @include("client.questionnaire.debt.domestic")
@endif

<div class="add-more-div-bottom">
    <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-domestic-form" onclick="addAnotherDomesticForm('{{ $customSaveUrl }}');return false;">
        <i class="bi bi-plus-lg"></i>
        Add Additional DSO Owed
    </button>
</div>