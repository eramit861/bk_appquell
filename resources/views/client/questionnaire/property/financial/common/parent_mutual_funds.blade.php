<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($mutual_funds['description']) && is_array($mutual_funds['description']))
        @for($i = 0; $i < count($mutual_funds['description']); $i++)
            @include("client.questionnaire.property.financial.mutual_funds",['mutual_funds'=>$mutual_funds,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.mutual_funds",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore('mutual_funds', 'mutual_funds_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Account(s)
        </button>
    </div>
</div>