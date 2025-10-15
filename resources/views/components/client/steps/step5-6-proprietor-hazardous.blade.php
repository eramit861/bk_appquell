@props([
    'step5' => false,
    'step6' => false,
    'basicInfoPartRest' => [],
    'basicInfoPartRestD' => [],
    'usaStates' => [],
    'attorneyEdit' => '',
])

<!-- Step 5/6: Proprietor and Hazardous Property Section -->
<div id="basic-info-part-e" class="{{ $step5 || $step6 ? '' : 'hidestep' }}">
    <div class="mt-3">
        <form name="client_basic_info_step6" id="client_basic_info_step6" action="{{ route('client_basic_info_step6') }}"
            method="post" novalidate>
            @csrf

            <!-- Keep original structure for Step 5/6 sections -->
            <div class="row">
                <div class="col-md-12">
                    <p class="section-part-title"><span> Business Owned as a Sole
                            Proprietor
                        </span>
                    </p>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label class="d-block"><strong>Are you a sole proprietor of any full or part-time
                                business?</strong></label>
                        <label class="d-block text-c-blue">
                            (<span class="text-decoration-underline">Only list</span> your business here if it is a
                            <span class="text-decoration-underline">sole proprietor</span>, if you own or have an
                            interest in a corporation, and/or LLC don't list it here)
                        </label>
                        <div class="d-inline radio-primary">
                            <input type="radio" name="part_rest[proprietor_status]" required
                                {{ Helper::validate_key_toggle('proprietor_status', $basicInfoPartRestD, 0) }}
                                onchange="common_toggle_fn('no','any_proprietor_status_data');" value="0">
                            <label for="business-partner-no" class="cr">No</label>
                        </div>
                        <div class="d-inline radio-primary">
                            <input type="radio" name="part_rest[proprietor_status]" required
                                {{ Helper::validate_key_toggle('proprietor_status', $basicInfoPartRestD, 1) }}
                                onchange="common_toggle_fn('yes','any_proprietor_status_data');" value="1">
                            <label for="business-partner-yes" class="cr">Yes</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 {{ Helper::key_hide_show_v('proprietor_status', $basicInfoPartRestD) }} mb-3"
                    id="any_proprietor_status_data">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <x-client.form-section title="Name of business, if any"
                                                    name="part_rest[any_proprietor_status_data][name_of_business]"
                                                    :value="Helper::validate_key_value(
                                                        'name_of_business',
                                                        $basicInfoPartRestD,
                                                    )"
                                                    class="input_capitalize form-control name_of_business required" />
                                            </div>
                                            <div class="col-md-6">
                                                <x-client.form-section title="Street Address"
                                                    name="part_rest[any_proprietor_status_data][number_of_business]"
                                                    :value="Helper::validate_key_value(
                                                        'number_of_business',
                                                        $basicInfoPartRestD,
                                                    )"
                                                    class="input_capitalize form-control number_of_business required" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-4 d-none">
                                                <div class="form-group">
                                                    <label>Address 2</label>
                                                    <input type="text"
                                                        class="input_capitalize form-control street_of_business "
                                                        name="part_rest[any_proprietor_status_data][street_of_business]"
                                                        placeholder=""
                                                        value="{{ Helper::validate_key_value('street_of_business', $basicInfoPartRestD) }}"
                                                        aria-invalid="true">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <x-client.form-section title="City"
                                                    name="part_rest[any_proprietor_status_data][city_of_business]"
                                                    :value="Helper::validate_key_value(
                                                        'city_of_business',
                                                        $basicInfoPartRestD,
                                                    )"
                                                    class="input_capitalize form-control city_of_business required" />
                                            </div>
                                            <div class="col-md-5">
                                                <x-client.form-section title="State"
                                                    name="part_rest[any_proprietor_status_data][state_of_business]"
                                                    :value="Helper::validate_key_value(
                                                        'state_of_business',
                                                        $basicInfoPartRestD,
                                                    )" type="select" :options="$usaStates"
                                                    class="form-control required state_of_business" />
                                            </div>
                                            <div class="col-md-2">
                                                <x-client.form-section title="Zip code"
                                                    name="part_rest[any_proprietor_status_data][zip_of_business]"
                                                    :value="Helper::validate_key_value(
                                                        'zip_of_business',
                                                        $basicInfoPartRestD,
                                                    )"
                                                    class="form-control allow-5digit zip_of_business required" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- step 5 data: start -->
                <div class="col-md-12">
                    <p class="section-part-title"><span>Hazardous Property or Property That Needs Immediate
                            Attention
                        </span>
                    </p>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="d-block text-c-blue">For example, do you own perishable goods, or livestock
                            that must be fed, or a building that needs urgent repairs?
                        </label>
                        <label class="d-block">Do you own or have any property that
                            needs
                            immediate attention or that poses or is alleged to pose a
                            threat
                            of imminent
                            and identifiable harm to public health or safety?
                        </label>
                        <div class="d-inline radio-primary">
                            <input type="radio" id="own-property-no-step5" class='step5-No-step5'
                                name="part_rest[hazardous_property]" required
                                {{ Helper::validate_key_toggle('hazardous_property', $basicInfoPartRest, 0) }}
                                value="0">
                            <label for="own-property-no-step5" class="cr">No</label>
                        </div>
                        <div class="d-inline radio-primary">
                            <input type="radio" id="own-property-yes-step5" class='step5-yes-step5'
                                name="part_rest[hazardous_property]" required
                                {{ Helper::validate_key_toggle('hazardous_property', $basicInfoPartRest, 1) }}
                                value="1">
                            <label class="cr" for="own-property-yes-step5">Yes</label>
                        </div>
                    </div>
                </div>
                <div class=" {{ Helper::key_hide_show_v('hazardous_property', $basicInfoPartRest) }}" id="stepp5-step5">
                    <div class="col-md-12 step5">
                        <div class="row">
                            <div class="col-md-6">
                                <x-client.form-section title="What is the hazard?"
                                    name="part_rest[hazardous_property_data][what_is_hazard]" :value="Helper::validate_key_value('what_is_hazard', $basicInfoPartRestD)"
                                    class="input_capitalize form-control name_of_business required" />
                            </div>
                            <div class="col-md-6">
                                <x-client.form-section title="If immediate attention is needed why is it needed?"
                                    name="part_rest[hazardous_property_data][attention_needed]" :value="Helper::validate_key_value('attention_needed', $basicInfoPartRestD)"
                                    class="input_capitalize form-control number_of_business required" />
                            </div>
                            <div class="col-md-6">
                                <x-client.form-section title="Where is the property?"
                                    name="part_rest[hazardous_property_data][hazard_street_of_business]"
                                    :value="Helper::validate_key_value(
                                        'hazard_street_of_business',
                                        $basicInfoPartRestD,
                                    )"
                                    class="input_capitalize form-control street_of_business required" />
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-5">
                                        <x-client.form-section title="City"
                                            name="part_rest[hazardous_property_data][hazard_city_of_business]"
                                            :value="Helper::validate_key_value(
                                                'hazard_city_of_business',
                                                $basicInfoPartRestD,
                                            )"
                                            class="input_capitalize form-control city_of_business required" />
                                    </div>
                                    <div class="col-md-5">
                                        <x-client.form-section title="State"
                                            name="part_rest[hazardous_property_data][hazard_state]" :value="Helper::validate_key_value('hazard_state', $basicInfoPartRestD)"
                                            type="select" :options="$usaStates"
                                            class="form-control required state_of_business" />
                                    </div>
                                    <div class="col-md-2">
                                        <x-client.form-section title="Zip code"
                                            name="part_rest[hazardous_property_data][hazard_zip_of_business]"
                                            :value="Helper::validate_key_value(
                                                'hazard_zip_of_business',
                                                $basicInfoPartRestD,
                                            )"
                                            class="form-control allow-5digit zip_of_business required" />
                                    </div>
                                </div>
                            </div>
                            @php
                                if (is_array(Helper::validate_key_value('describe_of_business', $basicInfoPartRestD))) {
                                    $array_checkbox = Helper::validate_key_value(
                                        'describe_of_business',
                                        $basicInfoPartRestD,
                                    );

                                    //$array_checkbox = json_decode($jsondata,true);
                                } else {
                                    $array_checkbox = [];
                                }
                            @endphp
                        </div>
                    </div>
                </div>
                <!-- step 5 data: end -->
                <!-- condition-data -->
                <div class="col-md-12">
                    <div class="next-part-btn text-right">

                        @if (!empty($basicInfoPartRest['id']))
                            <input type="hidden" name="basicinfo_partrest_id"
                                value="{{ $basicInfoPartRest['id'] }}">
                            <a href="{{ route('client_basic_info_step3') }}"
                                class="btn btn-primary shadow-2 mb-4 {{ ClientHelper::hideBackOnEditPopup($attorneyEdit) }}">Back</a>
                            <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next <i
                                    class="feather icon-chevron-right mr-0"></i></button>
                            <!--<button class="btn btn-primary shadow-2 mb-4" onclick="changeStep(this);return false;">Next <i class="feather icon-chevron-right mr-0"></i></button>-->
                        @else
                            <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next <i
                                    class="feather icon-chevron-right mr-0"></i></button>
                        @endif

                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
