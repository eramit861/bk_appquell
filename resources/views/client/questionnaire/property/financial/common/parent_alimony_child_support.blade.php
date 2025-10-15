<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($alimony_child_support['description']) && is_array($alimony_child_support['description']))
        @for($i = 0; $i < count($alimony_child_support['description']); $i++)
            @include("client.questionnaire.property.financial.alimony_child_support",['bank'=>$alimony_child_support,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.alimony_child_support",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="child_addmore(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
        </button>
    </div>
</div>