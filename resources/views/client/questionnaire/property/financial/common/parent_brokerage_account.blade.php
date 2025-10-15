<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($brokerage_account['property_value']) && is_array($brokerage_account['property_value']))
        @for($i = 0; $i < count($brokerage_account['property_value']); $i++)
            @include("client.questionnaire.property.financial.brokerage_account",['brokerage_account'=>$brokerage_account,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.brokerage_account",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="brokerage_account_addmore(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Brokerage Account(s)
        </button>
    </div>
</div>