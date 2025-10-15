<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($other_financial['description']) && is_array($other_financial['description']))
        @for($i = 0; $i < count($other_financial['description']); $i++)
            @include("client.questionnaire.property.financial.other_financial",['other_financial'=>$other_financial,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.other_financial",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore('other_financial', 'other_financial_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>