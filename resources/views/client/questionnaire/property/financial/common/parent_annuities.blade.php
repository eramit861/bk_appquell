<div class="outline-gray-border-area">
    @php
    $i = 0;
    @endphp
    @if(!empty($annuities['description']) && is_array($annuities['description']))
        @for($i = 0; $i < count($annuities['description']); $i++)
            @include("client.questionnaire.property.financial.annuities",['annuities'=>$annuities,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.annuities",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('annuities', 3); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Annuity(s)
        </button>
    </div>
</div>