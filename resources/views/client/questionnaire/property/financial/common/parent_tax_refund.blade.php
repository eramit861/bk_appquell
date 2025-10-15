@php
$currentYear = date("Y");
$last5Years = range($currentYear, $currentYear - 4, -1);
$i = 0;
@endphp
@if(!empty($tax_refunds['description']) && is_array($tax_refunds['description']))
    @for($i = 0; $i < count($tax_refunds['description']); $i++)
        @include("client.questionnaire.property.financial.tax_refunds",['tax_refunds'=>$tax_refunds,'i'=>$i])
    @endfor
@else
    @include("client.questionnaire.property.financial.tax_refunds",['i'=>0,'isEmpty'=>true])
@endif
<div class="add-more-div-bottom">
    <button type="button" class="btn-new-ui-default py-1 px-2" onclick="tax_refund_addmore(); return false;">
        <i class="bi bi-plus-lg"></i>
        Add Additional Tax Refund(s)
    </button>
</div>