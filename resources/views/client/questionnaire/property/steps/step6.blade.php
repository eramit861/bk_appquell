@php
$form_route_step_6 = $attorney_edit ? $save_route : route('client_property_step5');
@endphp
<form name="client_property_step5" id="client_property_step5" action="{{ $form_route_step_6 }}" method="post" novalidate style="width: 100%">
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Business-Related Assets</h2>

        <div class="row gx-3">
            @if(!empty($businessassets) && count($businessassets) > 0)
                @include("client.questionnaire.property.business_assets",$businessassets)
            @else
                @include("client.questionnaire.property.business_assets")
            @endif
        </div>
    </div>

    <div class="bottom-btn-div">
        @if(!$attorney_edit)
            <a href="{{ route('client_property_step4_continue') }}" class="btn-new-ui-default me-2">Back to Previous Page</a>
        @endif   
        @if(isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $step1PercentDone == 100 && $step2PercentDone == 100 && $step3PercentDone == 100 && $step4PercentDone == 100 && $step5PercentDone == 100 && (int)(!empty($isFarmProperty['type_value']) ? $isFarmProperty['type_value'] : 0) == 0)
            <button type="button" class="btn-new-ui-default" onclick="showConfirmationPrompt('client_property_step5', 'Property')">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}  <i class="feather icon-chevron-right mr-0"></i></button>
        @else
            <button type="submit" class="btn-new-ui-default">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}  <i class="feather icon-chevron-right mr-0"></i></button>
        @endif
    </div>
</form>
