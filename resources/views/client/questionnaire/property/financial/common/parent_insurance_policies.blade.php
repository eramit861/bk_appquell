<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($insurance_policies['type_of_account']) && is_array($insurance_policies['type_of_account']))
        @for($i = 0; $i < count($insurance_policies['type_of_account']); $i++)
            @include("client.questionnaire.property.financial.insurance_policies",['insurance_policies'=>$insurance_policies,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.insurance_policies",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('insurance_policies',5); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>