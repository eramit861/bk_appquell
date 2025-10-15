<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($trusts_life_estates['description']) && is_array($trusts_life_estates['description']))
        @for($i = 0; $i < count($trusts_life_estates['description']); $i++)
            @include("client.questionnaire.property.financial.trusts_life_estates",['trusts_life_estates'=>$trusts_life_estates,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.trusts_life_estates",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore('trusts_life_estates','trusts_life_estates_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>