@php
$form_route_step_7 = $attorney_edit ? $save_route : route('client_property_step6');
$back = route('client_property_step4_continue');
if ((isset($isBusinessProperty->type) && isset($isBusinessProperty->type_value)) && $isBusinessProperty->type == 'is_business_property' && $isBusinessProperty->type_value == 1) {
    $back = route('client_property_step4');
}
@endphp

<form name="client_property_step6" id="client_property_step6" action="{{ $form_route_step_7 }}" method="post" novalidate style="width: 100%">
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Farm and Commercial Fishing-Related Property</h2>
        <div class="row gx-3">
            @if(!empty($farmcommercial) && count($farmcommercial) > 0)
                @include("client.questionnaire.property.farm_commercial",$farmcommercial)
            @else
                @include("client.questionnaire.property.farm_commercial")
            @endif
        </div>
    </div>

    <div class="bottom-btn-div">
        @if(!$attorney_edit)
            <a href="{{ $back }}" class="btn-new-ui-default me-2">Back to Previous Page</a>
        @endif           
        @if(isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $step1PercentDone == 100 && $step2PercentDone == 100 && $step3PercentDone == 100 && $step4PercentDone == 100 && $step5PercentDone == 100 && $step6PercentDone == 100)
            <button type="button" class="btn-new-ui-default" onclick="showConfirmationPrompt('client_property_step6', 'Property')">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}  <i class="feather icon-chevron-right mr-0"></i></button>
        @else
            <button type="submit" class="btn-new-ui-default">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}  <i class="feather icon-chevron-right mr-0"></i></button>
        @endif
    </div>
</form>
