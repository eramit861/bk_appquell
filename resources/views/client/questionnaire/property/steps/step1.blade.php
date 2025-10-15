@php
$form_route_step_1 = $attorney_edit ? $save_route : route('update_property_step1_ajax');
$form_id = $attorney_edit ? 'property_step1_modal_save' : 'client_property_step1';
@endphp
<form name="client_property_step1" id="{{ $form_id }}" action="{{$form_route_step_1}}" method="post" novalidate style="width: 100%">
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Residence, Building, Land, Other Real Estate</h2>

        <div class="row gx-3" id="residence_main_div">

            <div class="col-12">
                <p class="text-bold blink text-danger ">
                    <span class="text-danger"><span class="red_underline">Please list any</span> and all properties you own even if they aren't located in the United States and/or <span class="red_underline">your not including them</span> in your bankruptcy case</span>
                </p>
            </div>

            <div class="col-12" id="resident_listing_html">
                <div class="row">
                    @php
                        $i = 0;
                        $resident = [];
                        $bottomSec = "hide-data";
                    @endphp
                    
                    @if(!empty($propertyresident) && count($propertyresident) > 0)
                        @foreach($propertyresident as $resident)
                            @php $bottomSec = ""; @endphp
                            @include("client.questionnaire.property.common.resident",$resident)
                            @php $i++; @endphp
                        @endforeach
                    @else
                        @include("client.questionnaire.property.common.resident",$resident)
                    @endif
                </div>
            </div>
            <div class="col-12 light-gray-div b-0-i py-0 mb-0 bottom-section {{ $bottomSec }}">
                <div class="label-div question-area border-bottom-default">
                    <label for="bankruptcy_filed">
                        Do you own any other property.
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="(such as homes, land, rental properties etc.) If yes select add additional properties below. Even if your not including them in your case. (This includes property owned or leased inside and/or outside the United States. Failure to disclose any such property may result in the Court taking it.)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
                <div class=" mb-3">
                    <button class="btn-new-ui-default"
                        id="add-more-residence-form" onclick="addResidenceForm({{ $attorney_edit ? 'true' : 'false' }});return false;"><i
                            class="feather icon-plus mr-0"></i> Add Additional Property(s)</button>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button
            type="button"
            onclick="checkResidentSelection('{{ route('client_property_step1') }}', {{ $attorney_edit ? 'true' : 'false' }})"
            class="btn-new-ui-default">
            {{ $attorney_edit ? 'Save' : 'Save & Next' }} <i class="feather icon-chevron-right mr-0"></i>
        </button>
    </div>
</form>
