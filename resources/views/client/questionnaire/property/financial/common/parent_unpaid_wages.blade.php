<div class="outline-gray-border-area">
    @php
    $i = 0;
    $propertyFinancialOwedTypeArray = ArrayHelper::getPropertyFinancialOwedTypeArray();
    @endphp
    @if(!empty($unpaid_wages['owed_type']) && is_array($unpaid_wages['owed_type']))
        @for($i = 0; $i < count($unpaid_wages['owed_type']); $i++)
            @include("client.questionnaire.property.financial.unpaid_wages",['unpaid_wages'=>$unpaid_wages,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.unpaid_wages",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('unpaid_wages',8,'unpaid_wages_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>