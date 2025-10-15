<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($inheritances['description']) && is_array($inheritances['description']))
        @for($i = 0; $i < count($inheritances['description']); $i++)
            @include("client.questionnaire.property.financial.inheritances",['inheritances'=>$inheritances,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.inheritances",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore('inheritances','inheritances_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>