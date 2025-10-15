<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($patents_copyrights['description']) && is_array($patents_copyrights['description']))
        @for($i = 0; $i < count($patents_copyrights['description']); $i++)
            @include("client.questionnaire.property.financial.patents_copyrights",['patents_copyrights'=>$patents_copyrights,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.patents_copyrights",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore('patents_copyrights','patents_copyrights_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>