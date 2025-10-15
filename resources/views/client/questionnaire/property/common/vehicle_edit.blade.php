@php
$videos = VideoHelper::getAdminVideos();
$vinGuide = $videos[Helper::PROPERTY_VIN_TUTORIAL] ?? [];
$vinGuideVideos = VideoHelper::getVideos($vinGuide);

$property_type = Helper::validate_key_value('property_type', $vehicle, 'radio');
$property_type_name = Helper::validate_key_value('property_type_name', $vehicle);
@endphp

@if (!empty($vehicle['id']))
    <input type="hidden" class="property_vehicle_ids" name="property_vehicle[id][{{ $i }}]" value="{{ Helper::validate_value($vehicle['id']) }}">
@endif

<!-- <div class="col-12">
    <strong class="">
        Vehicle Information

    </strong>
</div> -->

<div class="col-12 col-md-12">
    <a id="videoanchor"
        class="float_right btn-new-ui-default light-blue px-2 py-1 mb-2"
        href="javascript:void(0)"
        data-bs-toggle="modal"
        onclick="run_tutorial_videos(this,'#video_modal')"
        title=" Click for Step by Step video"
        data-video="{{ $vinGuideVideos['en'] }}"
        data-video2="{{ $vinGuideVideos['sp'] }}">
        Click/Tap Here
        <i class="bi bi-car-front"></i>
        <i class="bi bi-card-text"></i>
        How to get Vehicle Vin #
    </a>
</div>
<div class="col-12 col-md-12">
    <div class="chip-style-tab label-div mb-0">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="light-gray-div mb-3">
                    <h2 class="pl-2">Vehicle Type</h2>
                    <div class="d-flex flex-wrap w-100">
                        <label class="chip-tab {{ $property_type == 1 && $property_type_name == 'Cars' ? 'active ' : ' ' }}{{ empty($property_type_name) && $property_type == 1 ? 'active' : '' }}">
                            <span class="emoji-icon">&#x1F697;</span>Cars
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="1" data-label="Cars" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 1 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab {{ $property_type == 1 && $property_type_name == 'Motorcycles' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F3CD;&#xFE0F;</span>Motorcycles
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="1" data-label="Motorcycles" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 1 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab {{ $property_type == 1 && $property_type_name == 'Vans' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F690;</span>Vans
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="1" data-label="Vans" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 1 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab {{ $property_type == 1 && $property_type_name == 'Trucks' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F69A;</span>Trucks
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="1" data-label="Trucks" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 1 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab {{ $property_type == 1 && $property_type_name == 'Sport utility vehicles' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F699;</span>Sport utility vehicles
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="1" data-label="Sport utility vehicles" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 1 ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="light-gray-div mb-3">
                    <h2 class="pl-2">Recreational Vehicle Type</h2>
                    <div class="d-flex flex-wrap w-100">
                        <label class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Tractors' ? 'active ' : ' ' }} {{ empty($property_type_name) && $property_type == 6 ? 'active' : '' }}">
                            <span class="emoji-icon">&#x1F69C;</span>Tractors
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="6" data-label="Tractors" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 6 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Watercraft' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F6A4;</span>Watercraft
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="6" data-label="Watercraft" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 6 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Motor homes' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F690;</span>Motor homes
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="6" data-label="Motor homes" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 6 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'ATVs' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F6FB;</span>ATVs
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="6" data-label="ATVs" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 6 ? 'checked' : '' }}>
                        </label>

                        <label class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Other vehicles' ? 'active ' : ' ' }}">
                            <span class="emoji-icon">&#x1F6F8;</span>Other vehicles
                            <input type="radio"
                                name="property_vehicle[property_type][{{ $i }}]" class="property_type required" value="6" data-label="Other vehicles" onclick="if(typeof changeVehicle === 'function') changeVehicle(this)" {{ $property_type == 6 ? 'checked' : '' }}>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" class="property_type_name" name="property_vehicle[property_type_name][{{ $i }}]" value="{{ Helper::validate_key_value('property_type_name', $vehicle) }}">
    </div>
</div>


<div class="col-12 vehicle-info-div {{ empty(Helper::validate_key_value('vin_number', $vehicle)) ? '' : ''}}">
    <div class="row">

        <div class="col-lg-3 col-md-6 col-12">
            <div class="label-div">
                <div class="form-group mb-0 vin_number_div vin_number_div_{{ $i }} ">
                    <label>Input the vehicle Vin # below</label>
                    <input type="text"
                        oninput="vinOnInput(this)"
                        placeholder="Enter VIN number"
                        value="{{ Helper::validate_key_value('vin_number', $vehicle) }}"
                        name="property_vehicle[vin_number][{{ $i }}]"
                        id="vin_{{ $i }}"
                        class="w-100 form-control text-uppercase vin_number required ">
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
            <div class="label-div">
                <div class="form-group mb-0">
                    <label>Mileage</label>
                    <input type="text" class="form-control required vehicle_property_mileage mileage_field"
                        placeholder="Mileage" name="property_vehicle[property_mileage][{{ $i }}]" value="{{ Helper::validate_key_value('property_mileage', $vehicle) }}">
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 col-12">
            <div class="label-div mb-2">
                <div class="form-group mt-2 mb-2 vin-import-btn-div">
                    <label class="d-none d-md-block">&nbsp;</label>
                    <a class="fetch-vin-info link_vin btn-new-ui-default py-2 px-3" href="javascript:void(0)" id="link_vin_{{ $i }}" onclick="checkVin2Number(this)"><i class="bi bi-download mr-2"></i> Auto Import Vehicle Info</a>
                </div>
                <div class="form-check form-group mb-0 vin_number_div vin_number_div_{{ $i }}">
                    <label class="mb-0 form-check-label vin_label_check ">
                        <input class="form-check-input unknown_vin unknown_vin_{{ $i }}" value="1" type="checkbox" onclick="checkUnknownVin(this, {{ $i }})">
                        <small class="text-bold">Select IF you still cant find the Vin#</small>
                    </label>
                </div>
            </div>
        </div>

        @php
        $vehicleDataSection = 'd-none';
        $hasYear = Helper::validate_key_value('property_year', $vehicle);
        if (isset($hasYear) && !empty($hasYear)) {
            $vehicleDataSection = '';
        }
        @endphp

        <div class="col-12">
            <div class="row">
                <div class="col-lg-1 col-md-6 col-sm-12 vd-section vehicle-data-section-{{ $i }} {{ $vehicleDataSection }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Year</label>
                            <input type="number" min="{{date('Y', strtotime('-70 year'))}}" max="{{date('Y')}}" class="form-control required allow-4digit vehicle_property_year"
                                placeholder="Year" name="property_vehicle[property_year][{{ $i }}]" value="{{ Helper::validate_key_value('property_year', $vehicle) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 vd-section vehicle-data-section-{{ $i }} {{ $vehicleDataSection }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Make</label>
                            <input type="text" class="input_capitalize form-control required vehicle_property_make"
                                placeholder="Make" name="property_vehicle[property_make][{{ $i }}]" value="{{ Helper::validate_key_value('property_make', $vehicle) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 vd-section vehicle-data-section-{{ $i }} {{ $vehicleDataSection }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Model</label>
                            <input type="text" class="input_capitalize form-control required vehicle_property_model"
                                placeholder="Model" name="property_vehicle[property_model][{{ $i }}]" value="{{ Helper::validate_key_value('property_model', $vehicle) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-12 vd-section vehicle-data-section-{{ $i }} {{ $vehicleDataSection }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Style of vehicle</label>
                            <input type="text" class="form-control required vehicle_property_other_info input_capitalize"
                                placeholder="Other information" name="property_vehicle[property_other_info][{{ $i }}]" value="{{ Helper::validate_key_value('property_other_info', $vehicle) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 vd-section vehicle-data-section-{{ $i }} {{ $vehicleDataSection }}">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Estimated <strong> Value of </strong>Property</label>
                            <div class="input-group mb-0">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control price-field required vehicle_property_estimated_value"
                                    placeholder="Property value" name="property_vehicle[property_estimated_value][{{ $i }}]" value="{{ Helper::validate_key_value('property_estimated_value', $vehicle) }}">
                            </div>
                            <p class="mb-0">
                                <small>
                                    Click to get value here: <a target="_blank" class="text-c-blue" href="https://www.kbb.com">kbb.com</a> and/or <a href="https://www.nada.com" target="_blank" class="text-c-blue">nada.com</a>
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-xl-3 col-12 laon_property_obj_data">
            <div class="label-div question-area">
                <label class="fs-13px">
                    Do you have a loan on this property?
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group mb-0 multi-input-radio-group">
                    <input type="radio" id="loan_own_type_property_yes_{{ $i }}" class="loan_own_type_property required no_dup_loan" name="property_vehicle[loan_own_type_property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('loan_own_type_property', $vehicle, 1) }} value="1">
                    <label for="loan_own_type_property_yes_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('loan_own_type_property', $vehicle, 1) }}" onclick="laon_property_obj('yes',this);">Yes</label>

                    <input type="radio" id="loan_own_type_property_no_{{ $i }}" class="loan_own_type_property required no_dup_loan" name="property_vehicle[loan_own_type_property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('loan_own_type_property', $vehicle, 0) }} value="0" data-prop-type="vehicle" data-attorney_edit='{{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}'>
                    <label for="loan_own_type_property_no_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('loan_own_type_property', $vehicle, 0) }}" onclick="laon_property_obj('no', this);" data-prop-type="vehicle" data-attorney_edit='{{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}'>No</label>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-xl-9 col-12">
            <div class="label-div question-area">
                <label class="fs-13px">
                    <strong>Owned by:</strong> Specify is the property is owned by you, your spouse, both of you and/or someone else.
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                    <input type="radio" id="who_owes_the_debt_you_{{ $i }}" class=" vehicle_debt_owned_by" name="property_vehicle[vehicle_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $vehicle_car_loan, 1) }} value="1">
                    <label for="who_owes_the_debt_you_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('debt_owned_by', $vehicle_car_loan, 1) }}">Self</label>

                    <input type="radio" id="who_owes_the_debt_spouse_{{ $i }}" class=" vehicle_debt_owned_by" name="property_vehicle[vehicle_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $vehicle_car_loan, 2) }} value="2">
                    <label for="who_owes_the_debt_spouse_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('debt_owned_by', $vehicle_car_loan, 2) }}">Spouse</label>

                    <input type="radio" id="who_owes_the_debt_joint_{{ $i }}" class=" vehicle_debt_owned_by" name="property_vehicle[vehicle_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $vehicle_car_loan, 3) }} value="3">
                    <label for="who_owes_the_debt_joint_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('debt_owned_by', $vehicle_car_loan, 3) }}">Joint</label>

                    <input type="radio" id="who_owes_the_debt_other_{{ $i }}" class=" vehicle_debt_owned_by" name="property_vehicle[vehicle_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $vehicle_car_loan, 4) }} value="4">
                    <label for="who_owes_the_debt_other_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('debt_owned_by', $vehicle_car_loan, 4) }}">Other</label>

                    <input type="radio" id="who_owes_the_debt_possessory_{{ $i }}" class=" vehicle_debt_owned_by" name="property_vehicle[vehicle_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $vehicle_car_loan, 5) }} value="5">
                    <label for="who_owes_the_debt_possessory_{{ $i }}" class="btn-toggle prop_type_radio mr-0 {{ Helper::validate_key_toggle_active('debt_owned_by', $vehicle_car_loan, 5) }}">Possessory interest only</label>
                </div>
            </div>
        </div>

        <div class="col-12 loan_own_type_property_sec {{ Helper::key_hide_show_v('loan_own_type_property', $vehicle) }}">

            <div class="light-gray-div mt-3">
                <h2 class="px-2 flex-column flex-md-row">
                    <span class="me-2">Car Loan Info:</span>
                    <small class="text-c-blue text-bold">(Please upload a copy of your most recent statement on the document page)</small>
                </h2>
                <div class="row gx-3 mt-3 mt-sm-2 mt-md-0">
                    <div class="col-12">
                        <strong class="subtitle">Account and Creditor Details</strong>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <!-- Balance or current payoff on your car: -->
                                <label>Current Payoff Amount:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input type="number" class="form-control price-field vehicle_amount_own required" name="property_vehicle[vehicle_car_loan][amount_own][{{ $i }}]" placeholder="Amount Owed" value="{{ Helper::validate_key_value('amount_own', $vehicle_car_loan) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Account Number:</label>
                                <input type="text" class="form-control vehicle_account_number required" name="property_vehicle[vehicle_car_loan][account_number][{{ $i }}]" placeholder="Account Number" value="{{ Helper::validate_key_value('account_number', $vehicle_car_loan) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Date you got the loan:</label>
                                <input type="text" class="form-control date_month_year_custom vehicle_debt_incurred_date required" name="property_vehicle[vehicle_car_loan][debt_incurred_date][{{ $i }}]" placeholder="MM/YYYY" value="{{ Helper::validate_key_value('debt_incurred_date', $vehicle_car_loan) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Monthly payment amount:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input type="number" class="form-control price-field vehicle_monthly_payment required" name="property_vehicle[vehicle_car_loan][monthly_payment][{{ $i }}]" placeholder="Monthly payment" value="{{ Helper::validate_key_value('monthly_payment', $vehicle_car_loan) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Past due payment </label>
                                <div class="input-group mb-4 no_dup_inp">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">$</span>
                                    </div>
                                    <input id="monthly_payment" required placeholder="Past due payment" type="number" class="price-field past_due_amount form-control no_dup_inp" value="{{ Helper::validate_key_value('past_due_amount', $vehicle_car_loan) }}" name="property_vehicle[vehicle_car_loan][past_due_amount][{{ $i }}]">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-0 col-xl-0 col-lg-4 col-md-4 p-0 m-0"></div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Name of creditor:</label>
                                <input autocomplete="off" type="text" autocomplete class="input_capitalize form-control  autocomplete vehicle_creditor_name required" name="property_vehicle[vehicle_car_loan][creditor_name][{{ $i }}]" placeholder="Creditor Name" value="{{ Helper::validate_key_value('creditor_name', $vehicle_car_loan) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                        <div class="label-div">
                            <div class="form-group ">
                                <label>Street address</label>
                                <input type="text" class="input_capitalize form-control vehicle_creditor_name_addresss required" name="property_vehicle[vehicle_car_loan][creditor_name_addresss][{{ $i }}]" placeholder="Street Address" value="{{ Helper::validate_key_value('creditor_name_addresss', $vehicle_car_loan) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="input_capitalize form-control vehicle_creditor_city required" name="property_vehicle[vehicle_car_loan][creditor_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_value('creditor_city', $vehicle_car_loan) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div">
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control vehicle_creditor_state required" name="property_vehicle[vehicle_car_loan][creditor_state][{{ $i }}]">
                                    <option value="">Please Select State</option>
                                    {!! AddressHelper::getStatesList(Helper::validate_key_value('creditor_state', $vehicle_car_loan)) !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Zip code</label>
                                <input type="number" class="form-control allow-5digit vehicle_creditor_zip required" name="property_vehicle[vehicle_car_loan][creditor_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_value('creditor_zip', $vehicle_car_loan) }}">
                            </div>
                        </div>
                    </div>

                    @php
            $vehicle_is_vehicle_three_months = Helper::validate_key_value('is_vehicle_three_months', $vehicle_car_loan);
            $vehicle_is_vehicle_three_months_show_hide = "hide-data";
            if ($vehicle_is_vehicle_three_months == 1) {
                $vehicle_is_vehicle_three_months_show_hide = "";
            }
            @endphp

                    <div class="col-12">
                        <strong class="subtitle">Payments made on this vehicle in the last 90 days</strong>
                    </div>

                    <div class="col-12 debt_tax_own_by">
                        <div class="label-div question-area b-0-i pb-0">
                            <label class="fs-13px">Have you made any payments on this vehicle in the last 3 months?</label>
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="is_vehicle_three_months_yes_{{ $i }}"
                                    name="property_vehicle[vehicle_car_loan][is_vehicle_three_months][{{ $i }}]" value="1"
                                    class=" is_vehicle_three_months" required
                                    {{ Helper::validate_key_toggle('is_vehicle_three_months', $vehicle_car_loan, 1) }} />
                                <label for="is_vehicle_three_months_yes_{{ $i }}" class="btn-toggle debt_months_label_yes {{ Helper::validate_key_toggle_active('is_vehicle_three_months', $vehicle_car_loan, 1) }}" onclick="isThreeMonthsCommon('yes','vehicle_three_months_div_{{ $i }}'); isThreeMonthVehicle('yes',{{ $i }});">Yes</label>

                                <input type="radio" id="is_vehicle_three_months_no_{{ $i }}"
                                    name="property_vehicle[vehicle_car_loan][is_vehicle_three_months][{{ $i }}]" value="0"
                                    class=" is_vehicle_three_months" required
                                    {{ Helper::validate_key_toggle('is_vehicle_three_months', $vehicle_car_loan, 0) }} />
                                <label for="is_vehicle_three_months_no_{{ $i }}" class="btn-toggle debt_months_label_no {{ Helper::validate_key_toggle_active('is_vehicle_three_months', $vehicle_car_loan, 0) }}" onclick="isThreeMonthsCommon('no','vehicle_three_months_div_{{ $i }}'); isThreeMonthVehicle('no',{{ $i }});">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row vehicle_three_months_div vehicle_three_months_div_{{ $i }} {{ $vehicle_is_vehicle_three_months_show_hide }}">
                            <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Payment amount</label>
                                        <div class="input-group mb-0">
                                            <span class="input-group-text">$</span>
                                            <input id="payment_1" data-index="{{ $i }}" data-key="vehicle_car_loan" data-mainarray="property_vehicle" placeholder="Payment" type="number" class="payment_1 price-field form-control" value="{{ Helper::validate_key_value('payment_1', $vehicle_car_loan) }}" name="property_vehicle[vehicle_car_loan][payment_1][{{ $i }}]">
                                        </div>
                                            <small class="font-weight-bold font-italic">
                                                Payment date: {{ $monthBeforeLast }}
                                                <input type="hidden" class="payment_dates_1" name="property_vehicle[vehicle_car_loan][payment_dates_1][{{ $i }}]" value="{{ $monthBeforeLast }}">
                                            </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Payment amount</label>
                                        <div class="input-group mb-0">
                                            <span class="input-group-text">$</span>
                                            <input id="payment_2" data-index="{{ $i }}" data-key="vehicle_car_loan" data-mainarray="property_vehicle" placeholder="Payment" type="number" class="payment_2 price-field form-control" value="{{ Helper::validate_key_value('payment_2', $vehicle_car_loan) }}" name="property_vehicle[vehicle_car_loan][payment_2][{{ $i }}]">
                                        </div>
                                            <small class="font-weight-bold font-italic">
                                                Payment date: {{ $lastMonth }}
                                                <input type="hidden" class="payment_dates_2" name="property_vehicle[vehicle_car_loan][payment_dates_2][{{ $i }}]" value="{{ $lastMonth }}">
                                            </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Payment amount</label>
                                        <div class="input-group mb-0">
                                            <span class="input-group-text">$</span>
                                            <input id="payment_3" data-index="{{ $i }}" data-key="vehicle_car_loan" data-mainarray="property_vehicle" placeholder="Payment" type="number" class="payment_3 price-field form-control" value="{{ Helper::validate_key_value('payment_3', $vehicle_car_loan) }}" name="property_vehicle[vehicle_car_loan][payment_3][{{ $i }}]">
                                        </div>
                                            <small class="font-weight-bold font-italic">
                                                Payment date: {{ $currentMonth }}
                                                <input type="hidden" class="payment_dates_3" name="property_vehicle[vehicle_car_loan][payment_dates_3][{{ $i }}]" value="{{ $currentMonth }}">
                                            </small>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-3 col-md-4 col-sm-6 col-12">

                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Total amount of your payments</label>
                                        <div class="input-group">
                                            <span class="input-group-text">$</span>
                                            <input id="total_amount_paid" readonly required placeholder="Monthly Payment" type="number" class="total_amount_paid price-field form-control" value="{{ Helper::validate_key_value('total_amount_paid', $vehicle_car_loan) }}" name="property_vehicle[vehicle_car_loan][total_amount_paid][{{ $i }}]">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <strong class="subtitle">Property Information</strong>
                    </div>

                    <div class="col-xl-3 col-lg-4 col-md-5 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Number of payment remaining:</label>
                                <select class="form-control vehicle_payment_remaining" name="property_vehicle[vehicle_car_loan][payment_remaining][{{ $i }}]">
                                    @foreach(range(1, 84) as $no)
                                        <option {{ $no == Helper::validate_key_value('payment_remaining', $vehicle_car_loan) ? "selected" : '' }} value="{{ $no }}">{{ $no }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-8 col-md-7 col-12">
                        <div class="label-div question-area b-0-i pb-0">
                            <label class="fs-13px">Would you like to retain the above property?</label>
                            <div class="custom-radio-group form-group">
                                <input type="radio" id="retain_above_property_yes_{{ $i }}" name="property_vehicle[retain_above_property][{{ $i }}]" value="1" class="retain_above_property" required {{ Helper::validate_key_toggle('retain_above_property', $vehicle, 1) }} />
                                <label for="retain_above_property_yes_{{ $i }}" class="btn-toggle  {{ Helper::validate_key_toggle_active('retain_above_property', $vehicle, 1) }}">Yes</label>



                                <input type="radio" id="retain_above_property_no_{{ $i }}"
                                    name="property_vehicle[retain_above_property][{{ $i }}]" value="0"
                                    class="retain_above_property" required
                                    {{ Helper::validate_key_toggle('retain_above_property', $vehicle, 0) }} />
                                <label for="retain_above_property_no_{{ $i }}" class="btn-toggle  {{ Helper::validate_key_toggle_active('retain_above_property', $vehicle, 0) }}">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 property_own_by">
                        <strong class="subtitle">Person(s) Responsible/Co-debtor</strong>
                    </div>

                    <div class="col-12 property_own_by">
                        <div class="label-div question-area b-0-i pb-0">
                            <label class="fs-13px">Who owes the debt?</label>
                            <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                                <input type="radio" id="owned_by_vehicle_you_{{ $i }}" data-index="{{ $i }}"
                                    class="own_by_property required d-none " name="property_vehicle[own_by_property][{{ $i }}]" value="1"
                                    {{ Helper::validate_key_toggle('own_by_property', $vehicle, 1) }}>
                                <label for="owned_by_vehicle_you_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('own_by_property', $vehicle, 1) }}" onclick="property_common_toggle_own_by(1,this)"> You</label>

                                <input type="radio" id="owned_by_vehicle_spouse_{{ $i }}" data-index="{{ $i }}"
                                    class="own_by_property required d-none " name="property_vehicle[own_by_property][{{ $i }}]" value="2"
                                    {{ Helper::validate_key_toggle('own_by_property', $vehicle, 2) }}>
                                <label for="owned_by_vehicle_spouse_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('own_by_property', $vehicle, 2) }}" onclick="property_common_toggle_own_by(2,this)"> Spouse</label>

                                <input type="radio" id="owned_by_vehicle_joint_{{ $i }}" data-index="{{ $i }}"
                                    class="own_by_property required d-none " name="property_vehicle[own_by_property][{{ $i }}]" value="3"
                                    {{ Helper::validate_key_toggle('own_by_property', $vehicle, 3) }}>
                                <label for="owned_by_vehicle_joint_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('own_by_property', $vehicle, 3) }}" onclick="property_common_toggle_own_by(3,this)"> Joint</label>

                                <input type="radio" id="owned_by_vehicle_other_{{ $i }}" data-index="{{ $i }}"
                                    class="own_by_property required d-none " name="property_vehicle[own_by_property][{{ $i }}]" value="4"
                                    {{ Helper::validate_key_toggle('own_by_property', $vehicle, 4) }}>
                                <label for="owned_by_vehicle_other_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('own_by_property', $vehicle, 4) }}" onclick="property_common_toggle_own_by(4,this)"> Other</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 {{ Helper::key_hide_show_ownedby('own_by_property', $vehicle) }} property_codebtor_cosigner_data" id="property_codebtor_cosigner_data">
                        <div class="row codebtor-tab">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Codebtor name </label>
                                        <input type="text" class="input_capitalize form-control cod_name cosigner_vehicle_creditor_name required" name="property_vehicle[codebtor_creditor_name][{{ $i }}]" placeholder="Codebtor Name" value="{{ Helper::validate_key_value('codebtor_creditor_name', $vehicle) }}">
                                        @if (isset($appservice_codebtors) && !empty($appservice_codebtors))
                                            <!-- makeCodetorSelected(this) -->
                                            <select class="cod_opt form-control col-12 col-md-6" onchange="alreadySavedCodebtor(this)">
                                                <option class="form-control" value="">Choose Already Saved Codebtor</option>
                                                @foreach($appservice_codebtors as $codebtor)
                                                    <option data-cname="{{$codebtor['codebtor_creditor_name']}}" data-address="{{$codebtor['codebtor_creditor_name_addresss']}}" data-city="{{$codebtor['codebtor_creditor_city']}}" data-state="{{$codebtor['codebtor_creditor_state']}}" data-zip="{{$codebtor['codebtor_creditor_zip']}}">{{$codebtor['codebtor_creditor_name']}}, {{$codebtor['codebtor_creditor_name_addresss']}}, {{$codebtor['codebtor_creditor_city']}}, {{$codebtor['codebtor_creditor_state']}}, {{$codebtor['codebtor_creditor_zip']}}</option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Street address</label>
                                        <input type="text" class="input_capitalize cod_address form-control cosigner_vehicle_creditor_name_addresss required" name="property_vehicle[codebtor_creditor_name_addresss][{{ $i }}]" placeholder="Street Address" value="{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $vehicle) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" class="input_capitalize cod_city form-control cosigner_vehicle_creditor_city required" name="property_vehicle[codebtor_creditor_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_value('codebtor_creditor_city', $vehicle) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control cod_state cosigner_vehicle_creditor_state required" name="property_vehicle[codebtor_creditor_state][{{ $i }}]">
                                            <option value="">Please Select State</option>
                                            {!! AddressHelper::getStatesList(Helper::validate_key_value('codebtor_creditor_state', $vehicle)) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Zip code</label>
                                        <input type="number" class="form-control cod_zip allow-5digit cosigner_vehicle_creditor_zip required" name="property_vehicle[codebtor_creditor_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_value('codebtor_creditor_zip', $vehicle) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 text-right mb-2 pb-2 mt-2">
    <a href="javascript:void(0)" data-saveid="{{ $i }}" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" onclick="saveVehicles(true, this,'', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }});">Save</a>
</div>