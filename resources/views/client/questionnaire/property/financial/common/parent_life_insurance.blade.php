<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($life_insurance['type_of_account']) && is_array($life_insurance['type_of_account']))
        @for($i = 0; $i < count($life_insurance['type_of_account']); $i++)
            @include("client.questionnaire.property.financial.life_insurance",['life_insurance'=>$life_insurance,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.life_insurance",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('life_insurance',10); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>