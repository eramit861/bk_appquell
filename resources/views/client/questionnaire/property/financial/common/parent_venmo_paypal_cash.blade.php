<div class="outline-gray-border-area">
    @php $i = 0; @endphp
    @if(!empty($venmo_paypal_cash['property_value']) && is_array($venmo_paypal_cash['property_value']))
        @for($i = 0; $i < count($venmo_paypal_cash['property_value']); $i++)
            @include("client.questionnaire.property.financial.venmo_paypal_cash",['venmo_paypal_cash'=>$venmo_paypal_cash,'i'=>$i])
        @endfor
    @else
        @include("client.questionnaire.property.financial.venmo_paypal_cash",['i'=>0,'isEmpty'=>true])
    @endif
    <div class="add-more-div-bottom">
        <button type="button" class="btn-new-ui-default py-1 px-2" onclick="venmo_paypal_cash_addmore(); return false;">
            <i class="bi bi-plus-lg"></i>
            Add Additional Account(s)
        </button>
    </div>
</div>