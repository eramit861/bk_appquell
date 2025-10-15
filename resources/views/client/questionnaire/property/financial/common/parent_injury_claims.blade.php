<div class="outline-gray-border-area">
    @php
    $i = 0;
    @endphp
    @if(!empty($injury_claims['description']) && is_array($injury_claims['description']))
        @for($i = 0; $i < count($injury_claims['description']); $i++)
            @include("client.questionnaire.property.financial.injury_claims",['injury_claims'=>$injury_claims,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.injury_claims",['isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('injury_claims',6); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>