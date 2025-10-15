<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($education_ira['description']) && is_array($education_ira['description']))
        @for($i = 0; $i < count($education_ira['description']); $i++)
            @include("client.questionnaire.property.financial.education_ira",['education_ira'=>$education_ira,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.education_ira",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('education_ira', 6); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Account(s)
        </button>
    </div>
</div>