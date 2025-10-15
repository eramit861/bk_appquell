@php
$form_route_step_3 = $attorney_edit ? $save_route : route('client_property_step3');
@endphp

<form name="client_property_step3" id="client_property_step3" action="{{$form_route_step_3}}" method="post" novalidate style="width: 100%">
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Personal and Household Items</h2>
        <div class="row gx-3">
            @php
                $i = 0;
            @endphp
            
            @if(!empty($propertyhousehold) && count($propertyhousehold) > 0)
                @include("client.questionnaire.property.personal_household",[$propertyhousehold,$detailed_property ])
            @else
                @include("client.questionnaire.property.personal_household")
            @endif
        </div>
    </div>

    <div class="bottom-btn-div">
        @if(!$attorney_edit)
            <a href="{{ route('client_property_step1') }}" class="btn-new-ui-default me-2">Back to Previous Page</a>
        @endif
        <button type="submit" class="btn-new-ui-default">{{ $attorney_edit ? 'Save' : 'Save & Next' }}</button>
    </div>
</form>
