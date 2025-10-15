<div class="outline-gray-border-area">
    @if(!empty($cash['property_value']) && is_array($cash['property_value']))
        @for($i = 0; $i < count($cash['property_value']); $i++)
            @include("client.questionnaire.property.financial.cash",['cash'=>$cash,'i'])
        @endfor
    @else
        @include("client.questionnaire.property.financial.cash",['i'=>0,'isEmpty'=>true])
    @endif
</div>