<div class="main-property-section main-property-section-{{ $i }}">
    <div class="row">
        <div class="col-12 ">
            <div class="label-div question-area">
                <label class="fs-13px">
                    Select which type of property this is:
                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Identifies the category of the property, such as a single-family home, condo, multi-unit building, mobile home, land, investment property, or timeshare.">
                        <i class="bi bi-question-circle"></i>
                    </div>
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group small-radio-select-btn form-group mb-0 multi-input-radio-group">
                    <input type="radio" id="single-family-home-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 1) }} value="1">
                    <label for="single-family-home-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 1) }}" onclick="showHidePropertySizeDiv(this, 1)">Single family home</label>

                    <input type="radio" id="duplex-building-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 2) }} value="2">
                    <label for="duplex-building-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 2) }}" onclick="showHidePropertySizeDiv(this, 2)">Duplex or multi-unit building</label>

                    <input type="radio" id="condominium-or-cooperative-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 3) }} value="3">
                    <label for="condominium-or-cooperative-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 3) }}" onclick="showHidePropertySizeDiv(this, 3)">Condominium or cooperative</label>

                    <input type="radio" id="manufactured-or-mobile-home-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 4) }} value="4">
                    <label for="manufactured-or-mobile-home-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 4) }}" onclick="showHidePropertySizeDiv(this, 4)">Manufactured or mobile home</label>

                    <input type="radio" id="land-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 5) }} value="5">
                    <label for="land-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 5) }}" onclick="showHidePropertySizeDiv(this, 5)">Land</label>

                    <input type="radio" id="investment-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 6) }} value="6">
                    <label for="investment-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 6) }}" onclick="showHidePropertySizeDiv(this, 6)">Investment property</label>

                    <input type="radio" id="timeshare-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 7) }} value="7">
                    <label for="timeshare-{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('property', $resident, 7) }}" onclick="showHidePropertySizeDiv(this, 7)">Timeshare</label>

                    <input type="radio" id="address-other-{{ $i }}" class="d-none property" name="property_resident[property][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('property', $resident, 8) }} value="8">
                    <label for="address-other-{{ $i }}" class="btn-toggle prop_type_radio mr-1 {{ Helper::validate_key_toggle_active('property', $resident, 8) }}" onclick="showHidePropertySizeDiv(this, 8)">Other</label>

                    <input type="text" class="w-auto form-control property_other_input input_capitalize {{ Helper::validate_key_toggle_active('property', $resident, 8) ? '' : 'd-none' }}" name="property_resident[property_other_name][{{ $i }}]" data-index="{{ $i }}" placeholder="Name of other property" value="{{ Helper::validate_key_value('property_other_name', $resident) }}">
                </div>
            </div>
        </div>
    </div>
    
    @php
        $propertyType = Helper::validate_key_value('property', $resident);
        $propertyDescription = Helper::validate_key_value('property_description', $resident) ?? '';
        $propertyDescription = json_decode($propertyDescription, 1) ?? [];
        $arr1 = [1, 2, 3, 4];
        $arr2 = [5, 6];
        $descriptionDiv = 'd-none';
        $descriptionAndLotSizeDiv = 'd-none';
        if (in_array($propertyType, $arr1)) {
            $descriptionDiv = '';
            $descriptionAndLotSizeDiv = 'd-none';
        }
        if (in_array($propertyType, $arr2)) {
            $descriptionAndLotSizeDiv = '';
        }
    @endphp
    
    <div class="row description-div-parent">
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2 description-div {{ ' ' . $descriptionDiv }}">
            <div class="label-div mt-1">
                <div class="form-group mt-1">
                    <label class="">Bedrooms:</label>
                    <select data-index="{{ $i }}" class="required form-control bedroom" name="property_resident[property_description][{{ $i }}][bedroom]">
                        <option value="" selected disabled>Select bedrooms</option>
                        @for ($j = 1; $j <= 21; $j++)
                            @php
                                $bedrooms = $j / 2;
                            @endphp
                            @if ($bedrooms >= 1)
                                <option value="{{ $bedrooms }}" {{ (Helper::validate_key_value('bedroom', $propertyDescription) == $bedrooms) ? 'selected' : '' }}>{{ $bedrooms }}</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2 description-div {{ ' ' . $descriptionDiv }}">
            <div class="label-div mt-1">
                <div class="form-group mt-1">
                    <label class="">Bathrooms:</label>
                    <select data-index="{{ $i }}" class="required form-control bathroom" name="property_resident[property_description][{{ $i }}][bathroom]">
                        <option value="" selected disabled>Select bathrooms</option>
                        @for ($j = 1; $j <= 21; $j++)
                            @php
                                $bathrooms = $j / 2;
                            @endphp
                            @if ($bathrooms >= 1)
                                <option value="{{ $bathrooms }}" {{ (Helper::validate_key_value('bathroom', $propertyDescription) == $bathrooms) ? 'selected' : '' }}>{{ $bathrooms }}</option>
                            @endif
                        @endfor
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2 description-div {{ ' ' . $descriptionDiv }}">
            <div class="label-div mt-1">
                <div class="form-group mt-1">
                    <label class="">Square Feet of home:</label>
                    <div class="input-group">
                        <input data-index="{{ $i }}" type="text" class="form-control required home_sq_ft description-div-input" name="property_resident[property_description][{{ $i }}][home_sq_ft]" value="{{ Helper::validate_key_value('home_sq_ft', $propertyDescription) }}">
                        <span class="input-group-text percent">sq ft</span>
                    </div>
                    <div id="description-error-message" style="color: red;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-2 description-and-lot-size-div {{ ' ' . $descriptionAndLotSizeDiv }}">
            <div class="label-div mt-1">
                <div class="form-group mt-1">
                    <label class="">Lot Size in Acres:</label>
                    <div class="input-group">
                        <input data-index="{{ $i }}" type="text" class="form-control required lot_size_acres lot-size-div-input" name="property_resident[property_description][{{ $i }}][lot_size_acres]" value="{{ Helper::validate_key_value('lot_size_acres', $propertyDescription) }}">
                        <span class="input-group-text percent">Acre</span>
                    </div>
                    <div id="lot-error-message" style="color: red;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-none">
    <div class="col-md-6 d-none">
        <div class="label-div">
            <div class="form-group">
                <label>What is the amount of the mortgage, lien or loan?</label>
                <input type="number" class="form-control required mortgage_loan"
                    placeholder="Enter amount" name="property_resident[mortgage_loan][{{ $i }}]" value="{{ Helper::validate_key_value('mortgage_loan', $resident) }}">
            </div>
        </div>
    </div>
    <div class="col-md-6 d-none">
        <div class="label-div">
            <div class="form-group">
                <label>What is your current interest rate on the loan?</label>
                <input type="number" class="form-control required mortgage_loan_rate"
                    placeholder="Enter a interest rate" name="property_resident[mortgage_loan_rate][{{ $i }}]" value="{{ Helper::validate_key_value('mortgage_loan_rate', $resident) }}">
            </div>
        </div>
    </div>
    <div class="col-md-6 d-none">
        <div class="label-div">
            <div class="form-group">
                <label>What is your monthly payment?</label>
                <input type="number" class="form-control required monthly_payment"
                    placeholder="Enter monthly payment" name="property_resident[monthly_payment][{{ $i }}]" value="{{ Helper::validate_key_value('monthly_payment', $resident) }}">
            </div>
        </div>
    </div>
    <div class="col-md-6 d-none">
        <div class="label-div">
            <div class="form-group">
                <label class="d-block">Does payment include taxes and/or insurance?</label>
                <div class="d-inline radio-primary">
                    <input type="radio" id="payment_include_tax_no"
                        name="property_resident[taxes_insurance][{{ $i }}]" value="1" class="taxes_insurance required" {{ Helper::validate_key_toggle('taxes_insurance', $resident, 1) }}>
                    <label for="payment_include_tax_no"
                        class="cr">No
                    </label>
                </div>
                <div class="d-inline radio-primary">
                    <input type="radio" id="payment_include_tax_yes"
                        name="property_resident[taxes_insurance][{{ $i }}]" value="2" class="taxes_insurance required" {{ Helper::validate_key_toggle('taxes_insurance', $resident, 2) }}>
                    <label for="payment_include_tax_yes"
                        class="cr">Yes
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row estimated-value-div-{{ $i }} {{ empty($resident) ? ' hide-data ' : ' ' }}">
    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3">
        <div class="label-div">
            <div class="form-group">
                <label>Estimated<strong> Value of</strong> Property</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" data-index="{{ $i }}" class="form-control price-field required estimated_property_value"
                        placeholder="Property value" name="property_resident[estimated_property_value][{{ $i }}]" value="{{ Helper::validate_key_value('estimated_property_value', $resident) }}">
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-9 col-xxl-9">
        <p class="property-value-help">
            <span style="font-weight:bold;font-size:14px;">
                You can find out the value of your home here
                <a class="text-danger" href="https://www.zillow.com" target="_blank">zillow.com</a>
                and/or
                <a class="text-danger" href="https://www.redfin.com" target="_blank">redfin.com</a>
            </span>
        </p>
    </div>

    <div class="col-md-12">
        <div class="label-div question-area">
            <label class="fs-13px">
                <strong>Owned by:</strong> You, your spouse, both you and your spouse, you and at least one person other than your spouse.
                <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Specifies whether the property is owned by you, your spouse, both of you, or shared with someone else.">
                    <i class="bi bi-question-circle"></i>
                </div>
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                <input type="radio" id="who_owes_the_debt_you_{{ $i }}" class="d-none vehicle_debt_owned_by" name="property_resident[home_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $home_car_loan, 1) }} value="1">
                <label for="who_owes_the_debt_you_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('debt_owned_by', $home_car_loan, 1) }}">Self</label>

                <input type="radio" id="who_owes_the_debt_spouse_{{ $i }}" class="d-none vehicle_debt_owned_by" name="property_resident[home_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $home_car_loan, 2) }} value="2">
                <label for="who_owes_the_debt_spouse_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('debt_owned_by', $home_car_loan, 2) }}">Spouse</label>

                <input type="radio" id="who_owes_the_debt_joint_{{ $i }}" class="d-none vehicle_debt_owned_by" name="property_resident[home_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $home_car_loan, 3) }} value="3">
                <label for="who_owes_the_debt_joint_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('debt_owned_by', $home_car_loan, 3) }}">Joint</label>

                <input type="radio" id="who_owes_the_debt_other_{{ $i }}" class="d-none vehicle_debt_owned_by" name="property_resident[home_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $home_car_loan, 4) }} value="4">
                <label for="who_owes_the_debt_other_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('debt_owned_by', $home_car_loan, 4) }}">Other</label>

                <input type="radio" id="who_owes_the_debt_possessory_{{ $i }}" class="d-none vehicle_debt_owned_by" name="property_resident[home_car_loan][debt_owned_by][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('debt_owned_by', $home_car_loan, 5) }} value="5">
                <label for="who_owes_the_debt_possessory_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('debt_owned_by', $home_car_loan, 5) }}">Possessory interest only</label>
            </div>
        </div>
    </div>
</div>