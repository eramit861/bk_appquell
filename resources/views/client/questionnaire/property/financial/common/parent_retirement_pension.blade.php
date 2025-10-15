<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($retirement_pension['description']) && is_array($retirement_pension['description']))
        @for($i = 0; $i < count($retirement_pension['description']); $i++)
            @include("client.questionnaire.property.financial.retirement_pension",['retirement_pension'=>$retirement_pension,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.retirement_pension",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('retirement_pension', 10); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Retirement Account(s)
        </button>
    </div>
</div>