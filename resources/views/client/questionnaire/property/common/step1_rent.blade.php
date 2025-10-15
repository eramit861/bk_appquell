<div class="row">

    <div class="col-12 light-gray-div b-0-i py-0 mb-0 eviction_pending_div">
        <div class="label-div question-area">
            <label class="fs-13px">
                Do you have an eviction pending against you?
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="eviction-pending-no-{{ $i }}" class="d-none eviction_pending_cc" name="property_resident[eviction_pending][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('eviction_pending', $resident, 0) }} value="0">
                <label for="eviction-pending-no-{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('eviction_pending', $resident, 0) }}" onclick="get_eviction_pending('no', '{{ $i }}');">No</label>

                <input type="radio" id="eviction-pending-yes-{{ $i }}" class="d-none eviction_pending_cc" name="property_resident[eviction_pending][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('eviction_pending', $resident, 1) }} value="1">
                <label for="eviction-pending-yes-{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('eviction_pending', $resident, 1) }}" onclick="get_eviction_pending('yes', '{{ $i }}');">Yes</label>
            </div>
        </div>
    </div>

    <div class="col-12 eviction_pending_data_{{ $i }} {{ Helper::key_hide_show_v('eviction_pending', $resident) }}">

        @php
        $eviction_pending_data = Helper::validate_key_value('eviction_pending_data', $resident);
        $epData = (isset($eviction_pending_data) && !empty($eviction_pending_data)) ? json_decode($eviction_pending_data, 1) : [];
        @endphp
        <div class="row">
            <div class="col-12">
                <strong class="subtitle">Please provide your landlord's name and address</strong>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label> Name</label>
                        <input type="text" class="input_capitalize form-control required ep_data_name" name="property_resident[eviction_pending_data][{{ $i }}][Name]" placeholder="Name" value="{{ Helper::validate_key_value('Name', $epData) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>
                            Address
                        </label>
                        <input type="text" class="input_capitalize form-control required ep_data_address" name="property_resident[eviction_pending_data][{{ $i }}][Address]" placeholder="Address" value="{{ Helper::validate_key_value('Address', $epData) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required ep_data_city" name="property_resident[eviction_pending_data][{{ $i }}][City]" placeholder="City" value="{{ Helper::validate_key_value('City', $epData) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required ep_data_state" name="property_resident[eviction_pending_data][{{ $i }}][State]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(Helper::validate_key_value('State', $epData)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required ep_data_zip" name="property_resident[eviction_pending_data][{{ $i }}][Zip]" placeholder="Zip" value="{{ Helper::validate_key_value('Zip', $epData) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <strong class="subtitle">Rent Information</strong>
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
        <div class="label-div">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input
                        type="number"
                        class="form-control price-field required residence_rent"
                        name="property_resident[rent][{{ $i }}]"
                        placeholder="Residence Rent"
                        value="{{ Helper::validate_key_value('rent', $resident) }}">
                </div>
            </div>
        </div>
    </div>
    @php
    $security_deposits_data = Helper::validate_key_value('security_deposits', $resident);
    $security_deposits_data = !empty($security_deposits_data) ? json_decode($security_deposits_data, true) : [];
    $security_deposits = !empty($security_deposits_data) ? Helper::validate_key_value('data', $security_deposits_data) : [];
    @endphp

    <div class="col-12 light-gray-div b-0-i py-0 mb-0 security_deposit_div">
        <div class="label-div question-area">
            <label class="fs-13px">
                Do you or your spouse, if applicable, have any security deposits or prepaid amounts with any individual or organization?
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="security_deposits_yes_{{ $i }}" class="d-none security_deposit_yes_no" name="security_deposits[{{ $i }}][type_value]" required {{ Helper::validate_key_toggle('type_value', $security_deposits_data, 1) }} value="1">
                <label for="security_deposits_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $security_deposits_data, 1) }}" onclick="getSecurityDepositsItems('yes', '{{ $i }}');">Yes</label>

                <input type="radio" id="security_deposits_no_{{ $i }}" class="d-none security_deposit_yes_no" name="security_deposits[{{ $i }}][type_value]" required {{ Helper::validate_key_toggle('type_value', $security_deposits_data, 0) }} value="0">
                <label for="security_deposits_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $security_deposits_data, 0) }}" onclick="getSecurityDepositsItems('no', '{{ $i }}'); openFlagPopup('security-deposits-popup', 'No',true, {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }});">No</label>

            </div>
            <div class="hide-data security-deposits-popup">
                <p>You selected you rent. It's not normal to rent and not have to pay a security deposit when you move in. &#x1F914;</p>
                <p>Are you sure?</p>
            </div>
        </div>
    </div>

    <div class="col-12 security_deposit_data_div {{ Helper::key_hide_show_v('type_value', $security_deposits_data) }}" id="security_deposits_data_{{ $i }}">
        <div class="outline-gray-border-area mt-2">
            @php
            $index = 0;
            if (!empty($security_deposits['description']) && is_array($security_deposits['description'])) {
                for ($index = 0; $index < count($security_deposits['description']); $index++) {
                    @endphp
                   @include("client.questionnaire.property.financial.security_deposits",['security_deposits'=>$security_deposits,'index'=>$index])
                @php
                }
            } else {
                @endphp
                @include("client.questionnaire.property.financial.security_deposits")
            @php } @endphp
            <div class="add-more-div-bottom">
                <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('security_deposits_{{ $i }}',9,'security-deposits-mutisec-{{ $i }}', 'security_deposits[{{ $i }}]'); return false;">
                    <i class="bi bi-plus-lg"></i>
                    Add more
                </button>
            </div>
        </div>
    </div>
</div>

<div class="hide-data security-deposit">
    Disclose all security deposits and prepayments. Examples include: prepaid rent, deposits with public utility companies (gas, electric & water) Rental deposits on apartments and homes.
</div>