@php
    $rentOrOwn = Helper::validate_key_value('rent_or_own', $formData, 'radio');
    $loanOnProperty = Helper::validate_key_value('loan_on_property', $formData, 'radio');
    $mortgageAdditionalLoans = Helper::validate_key_value('mortgage_additional_loans', $formData, 'radio');
    $mortgageAdditionalLoans2 = Helper::validate_key_value('mortgage_additional_loans_2', $formData, 'radio');
    $mortgageForeclosureProperty = Helper::validate_key_value('mortgage_foreclosure_property', $formData, 'radio');
    $mortgageForeclosureDate = Helper::validate_key_value('mortgage_foreclosure_date', $formData, 'radio');

    // Precompute radio button states and visibility classes
    $rentChecked = ($rentOrOwn !== null && $rentOrOwn !== '') ? (($rentOrOwn === '0' || $rentOrOwn === 0) ? 'checked' : '') : ((old('rent_or_own') === 0) ? 'checked' : '');
    $ownChecked = ($rentOrOwn !== null && $rentOrOwn !== '') ? (($rentOrOwn === '1' || $rentOrOwn === 1) ? 'checked' : '') : ((old('rent_or_own') === 1) ? 'checked' : '');
    $rentActive = ($rentOrOwn !== null && $rentOrOwn !== '') ? (($rentOrOwn === '0' || $rentOrOwn === 0) ? 'active' : '') : ((old('rent_or_own') === 0) ? 'active' : '');
    $ownActive = ($rentOrOwn !== null && $rentOrOwn !== '') ? (($rentOrOwn === '1' || $rentOrOwn === 1) ? 'active' : '') : ((old('rent_or_own') === 1) ? 'active' : '');

    $rentDivClass = ($rentOrOwn !== null && $rentOrOwn !== '') ? (($rentOrOwn === '0' || $rentOrOwn === 0) ? '' : 'hide-data') : 'hide-data';
    $ownDivClass = ($rentOrOwn !== null && $rentOrOwn !== '') ? (($rentOrOwn === '1' || $rentOrOwn === 1) ? '' : 'hide-data') : 'hide-data';

    $loanYesChecked = ($loanOnProperty !== null && $loanOnProperty !== '') ? (($loanOnProperty === '0' || $loanOnProperty === 0) ? 'checked' : '') : ((old('loan_on_property') === 0) ? 'checked' : '');
    $loanNoChecked = ($loanOnProperty !== null && $loanOnProperty !== '') ? (($loanOnProperty === '1' || $loanOnProperty === 1) ? 'checked' : '') : ((old('loan_on_property') === 1) ? 'checked' : '');
    $loanYesActive = ($loanOnProperty !== null && $loanOnProperty !== '') ? (($loanOnProperty === '0' || $loanOnProperty === 0) ? 'active' : '') : ((old('loan_on_property') === 0) ? 'active' : '');
    $loanNoActive = ($loanOnProperty !== null && $loanOnProperty !== '') ? (($loanOnProperty === '1' || $loanOnProperty === 1) ? 'active' : '') : ((old('loan_on_property') === 1) ? 'active' : '');
    
    $loanDivClass = ($loanOnProperty !== null && $loanOnProperty !== '') ? (($loanOnProperty === '0' || $loanOnProperty === 0) ? '' : 'hide-data') : 'hide-data';
    $addLoansYesChecked = ($mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '') ? (($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1) ? 'checked' : '') : ((old('mortgage_additional_loans') === 1) ? 'checked' : '');
    $addLoansNoChecked = ($mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '') ? (($mortgageAdditionalLoans === '0' || $mortgageAdditionalLoans === 0) ? 'checked' : '') : ((old('mortgage_additional_loans') === 0) ? 'checked' : '');
    $addLoansYesActive = ($mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '') ? (($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1) ? 'active' : '') : ((old('mortgage_additional_loans') === 1) ? 'active' : '');
    $addLoansNoActive = ($mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '') ? (($mortgageAdditionalLoans === '0' || $mortgageAdditionalLoans === 0) ? 'active' : '') : ((old('mortgage_additional_loans') === 0) ? 'active' : '');
    
    $addLoansDivClass = ($mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '') ? (($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1) ? '' : 'hide-data') : 'hide-data';

    $addLoans2YesChecked = ($mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '') ? (($mortgageAdditionalLoans2 === '1' || $mortgageAdditionalLoans2 === 1) ? 'checked' : '') : ((old('mortgage_additional_loans_2') === 1) ? 'checked' : '');
    $addLoans2NoChecked = ($mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '') ? (($mortgageAdditionalLoans2 === '0' || $mortgageAdditionalLoans2 === 0) ? 'checked' : '') : ((old('mortgage_additional_loans_2') === 0) ? 'checked' : '');
    $addLoans2YesActive = ($mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '') ? (($mortgageAdditionalLoans2 === '1' || $mortgageAdditionalLoans2 === 1) ? 'active' : '') : ((old('mortgage_additional_loans_2') === 1) ? 'active' : '');
    $addLoans2NoActive = ($mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '') ? (($mortgageAdditionalLoans2 === '0' || $mortgageAdditionalLoans2 === 0) ? 'active' : '') : ((old('mortgage_additional_loans_2') === 0) ? 'active' : '');



    $addLoansDiv2Class = ($mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '') ? (($mortgageAdditionalLoans2 === '1' || $mortgageAdditionalLoans2 === 1) ? '' : 'hide-data') : 'hide-data';

    $foreclosureYesChecked = ($mortgageForeclosureProperty !== null && $mortgageForeclosureProperty !== '') ? (($mortgageForeclosureProperty === '0' || $mortgageForeclosureProperty === 0) ? 'checked' : '') : ((old('mortgage_foreclosure_property') === 0) ? 'checked' : '');
    $foreclosureNoChecked = ($mortgageForeclosureProperty !== null && $mortgageForeclosureProperty !== '') ? (($mortgageForeclosureProperty === '1' || $mortgageForeclosureProperty === 1) ? 'checked' : '') : ((old('mortgage_foreclosure_property') === 1) ? 'checked' : '');
    $foreclosureYesActive = ($mortgageForeclosureProperty !== null && $mortgageForeclosureProperty !== '') ? (($mortgageForeclosureProperty === '0' || $mortgageForeclosureProperty === 0) ? 'active' : '') : ((old('mortgage_foreclosure_property') === 0) ? 'active' : '');
    $foreclosureNoActive = ($mortgageForeclosureProperty !== null && $mortgageForeclosureProperty !== '') ? (($mortgageForeclosureProperty === '1' || $mortgageForeclosureProperty === 1) ? 'active' : '') : ((old('mortgage_foreclosure_property') === 1) ? 'active' : '');

    $foreclosureDateYesChecked = ($mortgageForeclosureDate !== null && $mortgageForeclosureDate !== '') ? (($mortgageForeclosureDate === '0' || $mortgageForeclosureDate === 0) ? 'checked' : '') : ((old('mortgage_foreclosure_date') === 0) ? 'checked' : '');
    $foreclosureDateNoChecked = ($mortgageForeclosureDate !== null && $mortgageForeclosureDate !== '') ? (($mortgageForeclosureDate === '1' || $mortgageForeclosureDate === 1) ? 'checked' : '') : ((old('mortgage_foreclosure_date') === 1) ? 'checked' : '');
    $foreclosureDateYesActive = ($mortgageForeclosureDate !== null && $mortgageForeclosureDate !== '') ? (($mortgageForeclosureDate === '0' || $mortgageForeclosureDate === 0) ? 'active' : '') : ((old('mortgage_foreclosure_date') === 0) ? 'active' : '');
    $foreclosureDateNoActive = ($mortgageForeclosureDate !== null && $mortgageForeclosureDate !== '') ? (($mortgageForeclosureDate === '1' || $mortgageForeclosureDate === 1) ? 'active' : '') : ((old('mortgage_foreclosure_date') === 1) ? 'active' : '');

    $foreclosureNotesClass = ($mortgageForeclosureProperty === '0' || $mortgageForeclosureProperty === 0) ? '' : 'hide-data';
    $foreclosureDateClass = ($mortgageForeclosureProperty === '0' || $mortgageForeclosureProperty === 0) && ($mortgageForeclosureDate === '0' || $mortgageForeclosureDate === 0) ? '' : 'hide-data';


    // Property Own Data
    $propertyOwnData = Helper::validate_key_value('property_own_data', $formData);
    $notPrimaryAddress = Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio');
    $addressSectionClass = $notPrimaryAddress == 1 ? '' : 'd-none';
    $propertySectionClass = $notPrimaryAddress !== null && $notPrimaryAddress !== '' ? '' : 'd-none';
    // Property data section should be visible when any option is selected (Yes=0 or No=1)
    $propertyDataSectionClass = $notPrimaryAddress !== null && $notPrimaryAddress !== '' ? '' : 'd-none';

    // Property Type and Description
    $propertyType = Helper::validate_key_value('property_type', $propertyOwnData);
    $propertyDescription = Helper::validate_key_value('property_description', $propertyOwnData) ?? '';
    $propertyDescription = is_string($propertyDescription)
        ? json_decode($propertyDescription, true)
        : $propertyDescription;
    $propertyDescription = $propertyDescription ?? [];
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
    $descriptionAndOtherNameDiv = 'd-none';
    if ($propertyType == 8) {
        $descriptionAndOtherNameDiv = '';
    }

    // Property Value Section Visibility
    $propertyValueSection = 'd-none';
    if (in_array($propertyType, $arr1)) {
        // For types 1-4: Check if bedrooms, bathrooms, and sq ft are filled
        $bedrooms = Helper::validate_key_value('property_bedrooms', $propertyOwnData);
        $bathrooms = Helper::validate_key_value('property_bathrooms', $propertyOwnData);
        $sqFt = Helper::validate_key_value('property_home_sq_ft', $propertyOwnData);
        if ($bedrooms && $bathrooms && $sqFt) {
            $propertyValueSection = '';
        }
    } elseif (in_array($propertyType, $arr2)) {
        // For types 5-6: Check if lot size is filled
        $lotSize = Helper::validate_key_value('property_lot_size_acres', $propertyOwnData);
        if ($lotSize) {
            $propertyValueSection = '';
        }
    } elseif (in_array($propertyType, [7, 8])) {
        // For types 7-8: Show immediately
        $propertyValueSection = '';
    }

    // Property Owned By Section Visibility
    $propertyOwnedBySection = 'd-none';
    $estimatedPropertyValue = Helper::validate_key_value('mortgage_property_value_1', $formData);
    if ($estimatedPropertyValue) {
        $propertyOwnedBySection = '';
    }

    // Mortgage Section Visibility
    $mortgageSection = 'd-none';
    $propertyOwnedBy = Helper::validate_key_value('property_owned_by', $propertyOwnData);
    if ($propertyOwnedBy) {
        $mortgageSection = '';
    }



    @endphp
<div class="col-md-12">
    <div class="label-div question-area mb-4">
        <div class="row">
            <div class="col-md-8">
                <label class="form-label">Rent or Own:</label>
                <!-- Radio -->
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="rent_or_own" class="" id="type_rent_1"
                        {{ $rentChecked }} value="0">
                    <label for="type_rent_1" class="btn-toggle {{ $rentActive }}" onclick="rentOrOwnChange(0)">Rent</label>

                    <input type="radio" required name="rent_or_own" class="" id="type_own_1"
                        {{ $ownChecked }} value="1">
                    <label for="type_own_1" class="btn-toggle {{ $ownActive }}" onclick="rentOrOwnChange(1)">Own</label>
                </div>
            </div>
            <div class="col-md-4 rent_div_1 {{ $rentDivClass }}">
                <div class="label-div">
                    <label class="align-items-center d-flex">Monthly Rent</label>
                    <div class="form-group ">
                        <div class="d-flex input-group w-fit-content ">
                            <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                            <input type="text" required name="mortgage_rent_1"
                                class="form-control price-field custom_corner_input" placeholder="Monthly Rent"
                                value="{{ (Helper::validate_key_value('mortgage_rent_1', $formData) !== '') ? Helper::validate_key_value('mortgage_rent_1', $formData) : old('mortgage_rent_1') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div
    class="col-md-12 own_div_1 mt-0 {{ $rentOrOwn !== null && $rentOrOwn !== '' ? ($rentOrOwn === '1' || $rentOrOwn === 1 ? '' : 'hide-data') : 'hide-data' }}">

    <div class="row gx-3">
        <div class="col-12 payment_not_primary_address_parents">
            <div class="label-div question-area mb-4">
                <label class="fs-13px">
                    Is this property your primary residence (<u>where you currently live</u>)?
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group ">
                    <input type="radio" id="payment_not_primary_address_no" class="d-none not_primary_address"
                        name="property_own_data[not_primary_address]" required
                        {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 1 ? 'checked' : '' }}
                        value="1">
                    <label for="payment_not_primary_address_no"
                        class="btn-toggle {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 1 ? 'active' : '' }}"
                        onclick="not_primary_address_property('no',this);">No</label>

                    <input type="radio" id="payment_not_primary_address_yes" class="d-none not_primary_address"
                        name="property_own_data[not_primary_address]" required
                        {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 0 ? 'checked' : '' }}
                        value="0">
                    <label for="payment_not_primary_address_yes"
                        class="btn-toggle {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 0 ? 'active' : '' }}"
                        onclick="not_primary_address_property('yes',this);">Yes</label>
                </div>
                <div class="payment_not_primary_address_data {{ $addressSectionClass }}">
                    <div class="row gx-3 mt-3">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="form-label mb-2">Street Address</label>
                                    <input type="text"
                                        class="input_capitalize form-control required mortgage_address"
                                        name="property_own_data[property_address]" placeholder="Street Address"
                                        value="{{ Helper::validate_key_value('property_address', $propertyOwnData) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="form-label mb-2">City</label>
                                    <input type="text" class="input_capitalize form-control required mortgage_city"
                                        name="property_own_data[property_city]" placeholder="City"
                                        value="{{ Helper::validate_key_value('property_city', $propertyOwnData) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    @php $stateID = Helper::validate_key_value('property_state', $propertyOwnData); @endphp
                                    <label class="form-label mb-2">State</label>
                                    <select class="form-control required mortgage_state"
                                        name="property_own_data[property_state]" id="property_state"
                                        data-countyid="property_county">
                                        <option value="">Please Select State</option>
                                        {!! AddressHelper::getStatesList($stateID) !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="form-label mb-2">ZIP Code</label>
                                    <input type="text" class="form-control allow-5digit required mortgage_zip"
                                        name="property_own_data[property_zip]" placeholder="Zip"
                                        value="{{ Helper::validate_key_value('property_zip', $propertyOwnData) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    @php
                                        $countyID = Helper::validate_key_value('property_county', $propertyOwnData);
                                        $state_name = AddressHelper::getSelectedStateName($stateID);
                                        $statearr = explode('(', $state_name);
                                        $state_name = isset($statearr[0]) ? trim($statearr[0]) : '';
                                        $countyList = \App\Models\CountyFipsData::get_county_by_state_name($state_name);
                                    @endphp
                                    <label class="form-label mb-2">County</label>
                                    <select name="property_own_data[property_county]" id="property_county"
                                        class="form-control required mortgage_county">
                                        <option value="">Choose County</option>
                                        @foreach ($countyList as $data)
                                            @php $selected = ($countyID == $data['id']) ? 'selected' : ''; @endphp
                                            <option value="{{ $data['id'] }}" {{ $selected }}>
                                                {{ $data['county_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="property-detail-div property-data-section {{ $propertyDataSectionClass }}">
                    <div class="pt-3">
                        <a href="javascript:void(0)"
                            class="get-property-details-by-graphql shadow-2 rounded-0 float_left label save-btn mx-ht im-action btn-new-ui-default m-0 px-5 py-2 vehicle-action-btn link_mortgage"
                            onclick="getPropertyDetailsForIntakeForm(this)"
                            data-primary-address="{{ Helper::validate_key_value('Address', $formData) }}, {{ Helper::validate_key_value('City', $formData) }}, {{ Helper::validate_key_value('state', $formData) }}, {{ Helper::validate_key_value('zip', $formData) }}"
                            data-client-id="{{ session()->getId() }}"
                            data-graphql-url="{{ route('get_property_residence_details_by_graphql') }}">
                            <i class="bi bi-download"></i> Auto Import Property Details
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- Property Section start --}}
        <div class="col-12 property-data-section {{ $propertyDataSectionClass }}">
            <div class="row gx-3">
                <div class="col-12">
                    <div class="label-div question-area mb-4">
                        <label class="fs-13px">Select which type of property this is:</label>
                        <!-- Radio Buttons -->
                        <div class="custom-radio-group small-radio-select-btn form-group mb-0 multi-input-radio-group">
                            <input type="radio" id="single-family-home" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 1 ? 'checked' : '' }}
                                value="1">
                            <label for="single-family-home"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 1 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 1)">Single family home</label>

                            <input type="radio" id="duplex-building" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 2 ? 'checked' : '' }}
                                value="2">
                            <label for="duplex-building"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 2 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 2)">Duplex or multi-unit building</label>

                            <input type="radio" id="condominium-or-cooperative" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 3 ? 'checked' : '' }}
                                value="3">
                            <label for="condominium-or-cooperative"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 3 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 3)">Condominium or cooperative</label>

                            <input type="radio" id="manufactured-or-mobile-home" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 4 ? 'checked' : '' }}
                                value="4">
                            <label for="manufactured-or-mobile-home"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 4 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 4)">Manufactured or mobile home</label>

                            <input type="radio" id="land" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 5 ? 'checked' : '' }}
                                value="5">
                            <label for="land"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 5 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 5)">Land</label>

                            <input type="radio" id="investment" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 6 ? 'checked' : '' }}
                                value="6">
                            <label for="investment"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 6 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 6)">Investment property</label>

                            <input type="radio" id="timeshare" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 7 ? 'checked' : '' }}
                                value="7">
                            <label for="timeshare"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 7 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 7)">Timeshare</label>

                            <input type="radio" id="address-other" class="d-none property"
                                name="property_own_data[property_type]" required
                                {{ Helper::validate_key_value('property_type', $propertyOwnData) == 8 ? 'checked' : '' }}
                                value="8">
                            <label for="address-other"
                                class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 8 ? 'active' : '' }}"
                                onclick="showHidePropertySizeDiv(this, 8)">Other</label>


                        </div>
                        <div class="row gx-3 description-div-parent mt-3">
                            <div
                                class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-div {{ $descriptionDiv }}">
                                <div class="label-div mt-1">
                                    <div class="form-group mt-1">
                                        <label class="form-label mb-2 ">Bedrooms:</label>
                                        <select class="required form-control bedroom"
                                            name="property_own_data[property_bedrooms]">
                                            <option value="" selected disabled>Select bedrooms</option>
                                            @for ($j = 1; $j <= 21; $j++)
                                                @php $bedrooms = $j / 2; @endphp
                                                @if ($bedrooms >= 1)
                                                    <option value="{{ $bedrooms }}"
                                                        {{ Helper::validate_key_value('property_bedrooms', $propertyOwnData) == $bedrooms ? 'selected' : '' }}>
                                                        {{ $bedrooms }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-div {{ $descriptionDiv }}">
                                <div class="label-div mt-1">
                                    <div class="form-group mt-1">
                                        <label class="form-label mb-2 ">Bathrooms:</label>
                                        <select class="required form-control bathroom"
                                            name="property_own_data[property_bathrooms]">
                                            <option value="" selected disabled>Select bathrooms</option>
                                            @for ($j = 1; $j <= 21; $j++)
                                                @php $bathrooms = $j / 2; @endphp
                                                @if ($bathrooms >= 1)
                                                    <option value="{{ $bathrooms }}"
                                                        {{ Helper::validate_key_value('property_bathrooms', $propertyOwnData) == $bathrooms ? 'selected' : '' }}>
                                                        {{ $bathrooms }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-div {{ $descriptionDiv }}">
                                <div class="label-div mt-1">
                                    <div class="form-group mt-1">
                                        <label class="form-label mb-2 ">Square Feet of home:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control required home_sq_ft description-div-input"
                                                name="property_own_data[property_home_sq_ft]"
                                                value="{{ Helper::validate_key_value('property_home_sq_ft', $propertyOwnData) }}">
                                            <span class="input-group-text percent">sq ft</span>
                                        </div>
                                        <div id="description-error-message" style="color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-and-lot-size-div {{ $descriptionAndLotSizeDiv }}">
                                <div class="label-div mt-1">
                                    <div class="form-group mt-1">
                                        <label class="form-label mb-2 ">Lot Size in Acres:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="form-control required lot_size_acres lot-size-div-input"
                                                name="property_own_data[property_lot_size_acres]"
                                                value="{{ Helper::validate_key_value('property_lot_size_acres', $propertyOwnData) }}">
                                            <span class="input-group-text percent">Acre</span>
                                        </div>
                                        <div id="lot-error-message" style="color: red;"></div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-and-other-name-div {{ $descriptionAndOtherNameDiv }}">
                                <div class="label-div mt-1">
                                    <div class="form-group mt-1">
                                        <label class="form-label mb-2 ">Name of other property:</label>
                                        <div class="input-group">
                                            <input type="text"
                                                class="w-auto form-control property_other_input input_capitalize "
                                                name="property_own_data[property_other_name]"
                                                placeholder="Name of other property"
                                                value="{{ Helper::validate_key_value('property_other_name', $propertyOwnData) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Property value section start --}}
                    <div class="property-value-section {{ $propertyValueSection }}">
                        <div class="light-gray-div mt-2">
                            <div class="row gx-3">
                                <div class="col-12">
                                    <div class="details-banner p-3 mb-4 text-start ">
                                        <span class=" ">
                                            You can find out the value of your home here
                                            <span
                                                onClick="window.open('http://www.zillow.com/','popup','width=1200,height=650'); return false;"
                                                class="card-title-text text-c-blue cursor-pointer mt-2">zillow.com</span>
                                            and/or
                                            <span
                                                onClick="window.open('http://www.redfin.com/','popup','width=1200,height=650'); return false;"
                                                class="card-title-text text-c-blue cursor-pointer mt-2">redfin.com</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label class="form-label">Estimated Value of Property</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="text"
                                                    class="form-control price-field estimated_property_value"
                                                    placeholder="Property value" name="mortgage_property_value_1"
                                                    value="{{ Helper::validate_key_value('mortgage_property_value_1', $formData) !== '' ? Helper::validate_key_value('mortgage_property_value_1', $formData) : old('mortgage_property_value_1') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Property owned by section start --}}
                        <div class="property-owned-by-section {{ $propertyOwnedBySection }}">
                            <div class="label-div question-area mb-4">
                                <label class="fs-13px">
                                    <strong>Owned by:</strong> You, your spouse, both you and your spouse, you and at
                                    least one person
                                    other than your spouse.
                                </label>
                                <!-- Radio Buttons -->
                                <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                                    <input type="radio" id="property_owned_by_self"
                                        class="d-none property_debt_owned_by"
                                        name="property_own_data[property_owned_by]" required
                                        {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 1 ? 'checked' : '' }}
                                        value="1">
                                    <label for="property_owned_by_self"
                                        class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 1 ? 'active' : '' }}">Self</label>

                                    <input type="radio" id="property_owned_by_spouse"
                                        class="d-none property_debt_owned_by"
                                        name="property_own_data[property_owned_by]" required
                                        {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 2 ? 'checked' : '' }}
                                        value="2">
                                    <label for="property_owned_by_spouse"
                                        class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 2 ? 'active' : '' }}">Spouse</label>

                                    <input type="radio" id="property_owned_by_joint"
                                        class="d-none property_debt_owned_by"
                                        name="property_own_data[property_owned_by]" required
                                        {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 3 ? 'checked' : '' }}
                                        value="3">
                                    <label for="property_owned_by_joint"
                                        class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 3 ? 'active' : '' }}">Joint</label>

                                    <input type="radio" id="property_owned_by_other"
                                        class="d-none property_debt_owned_by"
                                        name="property_own_data[property_owned_by]" required
                                        {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 4 ? 'checked' : '' }}
                                        value="4">
                                    <label for="property_owned_by_other"
                                        class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 4 ? 'active' : '' }}">Other</label>

                                    <input type="radio" id="property_owned_by_possessory"
                                        class="d-none property_debt_owned_by"
                                        name="property_own_data[property_owned_by]" required
                                        {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 5 ? 'checked' : '' }}
                                        value="5">
                                    <label for="property_owned_by_possessory"
                                        class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 5 ? 'active' : '' }}">Possessory
                                        interest only</label>
                                </div>
                            </div>
                            {{-- Mortgage section start --}}
                            <div class="mortgage-section {{ $mortgageSection }} mb-4">
                                <div class="label-div question-area ">
                                    <label class="form-label">Do you have a loan on this property?</label>
                                    <div class="custom-radio-group form-group  h-auto">
                                        <!-- Radio -->
                                        <input type="radio" required name="loan_on_property" class=""
                                            id="type_yes"
                                            {{ $loanOnProperty !== null && $loanOnProperty !== '' ? ($loanOnProperty === '0' || $loanOnProperty === 0 ? 'checked' : '') : (old('loan_on_property') === 0 ? 'checked' : '') }}
                                            value="0">
                                        <label for="type_yes"
                                            class="btn-toggle {{ $loanOnProperty !== null && $loanOnProperty !== '' ? ($loanOnProperty === '0' || $loanOnProperty === 0 ? 'active' : '') : (old('loan_on_property') === 0 ? 'active' : '') }}"
                                            onclick="loanOwnProperty1Change(0)">Yes</label>
                                        <input type="radio" required name="loan_on_property" class=""
                                            id="type_no"
                                            {{ $loanOnProperty !== null && $loanOnProperty !== '' ? ($loanOnProperty === '1' || $loanOnProperty === 1 ? 'checked' : '') : (old('loan_on_property') === 1 ? 'checked' : '') }}
                                            value="1">
                                        <label for="type_no"
                                            class="btn-toggle {{ $loanOnProperty !== null && $loanOnProperty !== '' ? ($loanOnProperty === '1' || $loanOnProperty === 1 ? 'active' : '') : (old('loan_on_property') === 1 ? 'active' : '') }}"
                                            onclick="loanOwnProperty1Change(1)">No</label>
                                    </div>
                                </div>


                                <div
                                    class="loan_div {{ $loanOnProperty !== null && $loanOnProperty !== '' ? ($loanOnProperty === '0' || $loanOnProperty === 0 ? '' : 'hide-data') : 'hide-data' }}">
                                    <div class="light-gray-div mt-4">
                                        <h2 class="">Mortgage 1</h2>
                                        <div class="row gx-3">
                                            <div class="col-md-6">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Est. Mortgage - 1st Amount
                                                            Owed</label>
                                                        <div class="d-flex input-group">
                                                            <span
                                                                class="custom_corner_span h-26px br-0 input-group-text"
                                                                id="basic-addon1">$</span>
                                                            <input type="text" required
                                                                name="mortgage_amount_owned_1"
                                                                class="form-control price-field custom_corner_input"
                                                                placeholder="Est. Mortgage - 1st Amount Owed"
                                                                value="{{ Helper::validate_key_value('mortgage_amount_owned_1', $formData) !== '' ? Helper::validate_key_value('mortgage_amount_owned_1', $formData) : old('mortgage_amount_owned_1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label"> Monthly Payment - 1st</label>
                                                        <div class="d-flex input-group">
                                                            <span
                                                                class="custom_corner_span h-26px br-0 input-group-text"
                                                                id="basic-addon1">$</span>
                                                            <input type="text" required name="mortgage_own_1"
                                                                class="form-control price-field custom_corner_input"
                                                                placeholder="Monthly Payment - 1st"
                                                                value="{{ Helper::validate_key_value('mortgage_own_1', $formData) !== '' ? Helper::validate_key_value('mortgage_own_1', $formData) : old('mortgage_own_1') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Est. Past Due Payments - 1st</label>
                                                        <div class="d-flex input-group">
                                                            <span
                                                                class="custom_corner_span h-26px br-0 input-group-text"
                                                                id="basic-addon1">$</span>
                                                            <input type="text" required
                                                                name="mortgage_past_payment_1"
                                                                class="price-field form-control custom_corner_input"
                                                                placeholder="Est. Past Due Payments - 1st"
                                                                value="{{ Helper::validate_key_value('mortgage_past_payment_1', $formData) !== '' ? Helper::validate_key_value('mortgage_past_payment_1', $formData) : old('mortgage_past_payment_1') }}">
                                                        </div>
                                                        <small
                                                            class="custom-input-sub-label-on-desktop ml-0-imp text-c-blue fs-12px"><i>If
                                                                your current on this mortgage type in $0.00</i></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-3">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" autocomplete="off" autocomplete
                                                            class="input_capitalize form-control autocomplete mortgages_creditor_name mortgages_creditor_name_1 required"
                                                            name="mortgages_creditor_name_1"
                                                            placeholder="Creditor Name" data-mcreditor="1"
                                                            value="{{ Helper::validate_key_value('mortgages_creditor_name_1', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_name_1', $formData) : old('mortgages_creditor_name_1') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Street Address</label>
                                                        <input type="text"
                                                            class="form-control mortgages_creditor_address_1"
                                                            name="mortgages_creditor_address_1"
                                                            placeholder="Street address"
                                                            value="{{ Helper::validate_key_value('mortgages_creditor_address_1', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_address_1', $formData) : old('mortgages_creditor_address_1') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">City</label>
                                                        <input type="text"
                                                            class="form-control mortgages_creditor_city_1"
                                                            name="mortgages_creditor_city_1" placeholder="City"
                                                            value="{{ Helper::validate_key_value('mortgages_creditor_city_1', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_city_1', $formData) : old('mortgages_creditor_city_1') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">State</label>
                                                        <select class="form-control mortgages_creditor_state_1"
                                                            name="mortgages_creditor_state_1">
                                                            <option value="">Please Select State</option>
                                                            {!! AddressHelper::getStatesList(
                                                                Helper::validate_key_value('mortgages_creditor_state_1', $formData) !== ''
                                                                    ? Helper::validate_key_value('mortgages_creditor_state_1', $formData)
                                                                    : old('mortgages_creditor_state_1'),
                                                            ) !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Zip code</label>
                                                        <input type="text"
                                                            class="form-control allow-5digit mortgages_creditor_zipcode_1"
                                                            name="mortgages_creditor_zipcode_1" placeholder="Zip code"
                                                            value="{{ Helper::validate_key_value('mortgages_creditor_zipcode_1', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_zipcode_1', $formData) : old('mortgages_creditor_zipcode_1') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="col-12 additional_loans {{ $loanOnProperty !== null && $loanOnProperty !== '' ? ($loanOnProperty === '0' || $loanOnProperty === 0 ? '' : 'hide-data') : 'hide-data' }}">
                                                <div class="label-div question-area ">
                                                    <label class="form-label">Do you have additional loans?</label>

                                                    <div class="custom-radio-group form-group  h-auto">
                                                        <!-- Radio -->
                                                        <input type="radio" required
                                                            name="mortgage_additional_loans" class="form-check-input"
                                                            id="additional_loans_yes_1"
                                                            {{ $mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '' ? ($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1 ? 'checked' : '') : (old('mortgage_additional_loans') === 1 ? 'checked' : '') }}
                                                            value="1">
                                                        <label for="additional_loans_yes_1"
                                                            class="btn-toggle {{ $mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '' ? ($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1 ? 'active' : '') : (old('mortgage_additional_loans') === 1 ? 'active' : '') }}"
                                                            onclick="loanOwnProperty2Change(1)">Yes</label>
                                                        <input type="radio" required
                                                            name="mortgage_additional_loans" class="form-check-input"
                                                            id="additional_loans_no_1"
                                                            {{ $mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '' ? ($mortgageAdditionalLoans === '0' || $mortgageAdditionalLoans === 0 ? 'checked' : '') : (old('mortgage_additional_loans') === 0 ? 'checked' : '') }}
                                                            value="0">
                                                        <label for="additional_loans_no_1"
                                                            class="btn-toggle {{ $mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '' ? ($mortgageAdditionalLoans === '0' || $mortgageAdditionalLoans === 0 ? 'active' : '') : (old('mortgage_additional_loans') === 0 ? 'active' : '') }}"
                                                            onclick="loanOwnProperty2Change(0)">No</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="additional_loans_div {{ $mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '' ? ($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1 ? '' : 'hide-data') : 'hide-data' }}">
                                        <div class="light-gray-div mt-2">
                                            <h2 class="">Mortgage 2</h2>
                                            <div class="row gx-3">
                                                <div class="col-md-6 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Est. Mortgage - 2nd Amount
                                                                Owed</label>
                                                            <div class="d-flex input-group">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input type="text" required
                                                                    name="mortgage_amount_owned_2"
                                                                    class="form-control price-field custom_corner_input"
                                                                    placeholder="Est. Mortgage - 2nd Amount Owed"
                                                                    value="{{ Helper::validate_key_value('mortgage_amount_owned_2', $formData) !== '' ? Helper::validate_key_value('mortgage_amount_owned_2', $formData) : old('mortgage_amount_owned_2') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label"> Monthly Payment - 2nd</label>
                                                            <div class="d-flex input-group">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input type="text" required name="mortgage_own_2"
                                                                    class="form-control price-field custom_corner_input"
                                                                    placeholder="Monthly Payment - 2nd"
                                                                    value="{{ Helper::validate_key_value('mortgage_own_2', $formData) !== '' ? Helper::validate_key_value('mortgage_own_2', $formData) : old('mortgage_own_2') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 own_div ">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Est. Past Due Payments -
                                                                2nd</label>

                                                            <div class="d-flex input-group">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input type="text" required
                                                                    name="mortgage_past_payment_2"
                                                                    class="form-control price-field custom_corner_input "
                                                                    placeholder="Est. Past Due Payments - 2nd"
                                                                    value="{{ Helper::validate_key_value('mortgage_past_payment_2', $formData) !== '' ? Helper::validate_key_value('mortgage_past_payment_2', $formData) : old('mortgage_past_payment_2') }}">
                                                            </div>
                                                            <small
                                                                class="custom-input-sub-label-on-desktop text-c-blue ml-0 fs-12px"><i>If
                                                                    your current on this mortgage type in
                                                                    $0.00</i></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-0 px-0 own_div">
                                                </div>
                                                <div class="col-md-3 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Name</label>
                                                            <input type="text" autocomplete="off" autocomplete
                                                                data-mcreditor="2"
                                                                class="input_capitalize form-control autocomplete mortgages_creditor_name mortgages_creditor_name_2 required"
                                                                name="mortgages_creditor_name_2"
                                                                placeholder="Creditor Name"
                                                                value="{{ Helper::validate_key_value('mortgages_creditor_name_2', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_name_2', $formData) : old('mortgages_creditor_name_2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Street Address</label>
                                                            <input type="text"
                                                                class="form-control mortgages_creditor_address_2 "
                                                                name="mortgages_creditor_address_2"
                                                                placeholder="Street address"
                                                                value="{{ Helper::validate_key_value('mortgages_creditor_address_2', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_address_2', $formData) : old('mortgages_creditor_address_2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">City</label>
                                                            <input type="text"
                                                                class="form-control mortgages_creditor_city_2 "
                                                                name="mortgages_creditor_city_2" placeholder="City"
                                                                value="{{ Helper::validate_key_value('mortgages_creditor_city_2', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_city_2', $formData) : old('mortgages_creditor_city_2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">State</label>
                                                            <select class="form-control mortgages_creditor_state_2 "
                                                                name="mortgages_creditor_state_2">
                                                                <option value="">Please Select State</option>
                                                                {!! AddressHelper::getStatesList(
                                                                    Helper::validate_key_value('mortgages_creditor_state_2', $formData) !== ''
                                                                        ? Helper::validate_key_value('mortgages_creditor_state_2', $formData)
                                                                        : old('mortgages_creditor_state_2'),
                                                                ) !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 own_div">
                                                    <div class="label-div mb-3">
                                                        <div class="form-group">
                                                            <label class="form-label">Zip code</label>
                                                            <input type="text"
                                                                class="form-control allow-5digit mortgages_creditor_zipcode_2 "
                                                                name="mortgages_creditor_zipcode_2"
                                                                placeholder="Zip code"
                                                                value="{{ Helper::validate_key_value('mortgages_creditor_zipcode_2', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_zipcode_2', $formData) : old('mortgages_creditor_zipcode_2') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 additional_loans {{ $mortgageAdditionalLoans !== null && $mortgageAdditionalLoans !== '' ? ($mortgageAdditionalLoans === '1' || $mortgageAdditionalLoans === 1 ? '' : 'hide-data') : 'hide-data' }}">
                                                    <div class="label-div question-area ">
                                                        <label class="form-label">Do you have additional loans?</label>
                                                        <!-- Radio -->
                                                        <div class="">
                                                            <div class="custom-radio-group form-group  h-auto">
                                                                <input type="radio" required
                                                                    name="mortgage_additional_loans_2"
                                                                    class="form-check-input"
                                                                    id="additional_loans_yes_2"
                                                                    {{ $mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '' ? ($mortgageAdditionalLoans2 === '1' || $mortgageAdditionalLoans2 === 1 ? 'checked' : '') : (old('mortgage_additional_loans_2') === 1 ? 'checked' : '') }}
                                                                    value="1">
                                                                <label for="additional_loans_yes_2"
                                                                    class="btn-toggle {{ $mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '' ? ($mortgageAdditionalLoans2 === '1' || $mortgageAdditionalLoans2 === 1 ? 'active' : '') : (old('mortgage_additional_loans_2') === 1 ? 'active' : '') }}"
                                                                    onclick="loanOwnProperty3Change(1)">Yes</label>
                                                                <input type="radio" required
                                                                    name="mortgage_additional_loans_2"
                                                                    class="form-check-input"
                                                                    id="additional_loans_no_2"
                                                                    {{ $mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '' ? ($mortgageAdditionalLoans2 === '0' || $mortgageAdditionalLoans2 === 0 ? 'checked' : '') : (old('mortgage_additional_loans_2') === 0 ? 'checked' : '') }}
                                                                    value="0">
                                                                <label for="additional_loans_no_2"
                                                                    class="btn-toggle {{ $mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '' ? ($mortgageAdditionalLoans2 === '0' || $mortgageAdditionalLoans2 === 0 ? 'active' : '') : (old('mortgage_additional_loans_2') === 0 ? 'active' : '') }}"
                                                                    onclick="loanOwnProperty3Change(0)">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="additional_loans_div_2 {{ $mortgageAdditionalLoans2 !== null && $mortgageAdditionalLoans2 !== '' ? ($mortgageAdditionalLoans2 === '1' || $mortgageAdditionalLoans2 === 1 ? '' : 'hide-data') : 'hide-data' }}">
                                            <div class="light-gray-div mt-2">
                                                <h2 class="">Mortgage 3</h2>
                                                <div class="row gx-3">
                                                    <div class="col-md-6 own_div ">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Est. Mortgage - 3rd Amount
                                                                    Owed</label>
                                                                <div class="d-flex input-group">
                                                                    <span
                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                        id="basic-addon1">$</span>
                                                                    <input type="text" required
                                                                        name="mortgage_amount_owned_3"
                                                                        class="form-control price-field custom_corner_input"
                                                                        placeholder="Est. Mortgage - 3rd Amount Owed"
                                                                        value="{{ Helper::validate_key_value('mortgage_amount_owned_3', $formData) !== '' ? Helper::validate_key_value('mortgage_amount_owned_3', $formData) : old('mortgage_amount_owned_3') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 own_div">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label"> Monthly Payment -
                                                                    3rd</label>
                                                                <div class="d-flex input-group ">
                                                                    <span
                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                        id="basic-addon1">$</span>
                                                                    <input type="text" required
                                                                        name="mortgage_own_3"
                                                                        class="form-control price-field custom_corner_input"
                                                                        placeholder="Monthly Payment - 3rd"
                                                                        value="{{ Helper::validate_key_value('mortgage_own_3', $formData) !== '' ? Helper::validate_key_value('mortgage_own_3', $formData) : old('mortgage_own_3') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 own_div">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Est. Past Due Payments -
                                                                    3rd</label>
                                                                <div class="d-flex input-group ">
                                                                    <span
                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                        id="basic-addon1">$</span>
                                                                    <input type="text" required
                                                                        name="mortgage_past_payment_3"
                                                                        class="form-control price-field custom_corner_input"
                                                                        placeholder="Est. Past Due Payments - 3rd"
                                                                        value="{{ Helper::validate_key_value('mortgage_past_payment_3', $formData) !== '' ? Helper::validate_key_value('mortgage_past_payment_3', $formData) : old('mortgage_past_payment_3') }}">
                                                                </div>
                                                                <small
                                                                    class="custom-input-sub-label-on-desktop text-c-blue ml-0 fs-12px"><i>If
                                                                        your current on this mortgage type in
                                                                        $0.00</i></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-0 px-0 own_div">
                                                    </div>
                                                    <div class="col-md-3 own_div">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Name</label>
                                                                <input type="text" autocomplete="off" autocomplete
                                                                    data-mcreditor="3"
                                                                    class="input_capitalize form-control autocomplete mortgages_creditor_name   mortgages_creditor_name_3 required"
                                                                    name="mortgages_creditor_name_3"
                                                                    placeholder="Creditor Name"
                                                                    value="{{ Helper::validate_key_value('mortgages_creditor_name_3', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_name_3', $formData) : old('mortgages_creditor_name_3') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 own_div">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">Street Address</label>
                                                                <input type="text"
                                                                    class="form-control mortgages_creditor_address_3 "
                                                                    name="mortgages_creditor_address_3"
                                                                    placeholder="Street address"
                                                                    value="{{ Helper::validate_key_value('mortgages_creditor_address_3', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_address_3', $formData) : old('mortgages_creditor_address_3') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 own_div">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">City</label>
                                                                <input type="text"
                                                                    class="form-control mortgages_creditor_city_3 "
                                                                    name="mortgages_creditor_city_3"
                                                                    placeholder="City"
                                                                    value="{{ Helper::validate_key_value('mortgages_creditor_city_3', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_city_3', $formData) : old('mortgages_creditor_city_3') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 own_div">
                                                        <div class="label-div mb-3">
                                                            <div class="form-group">
                                                                <label class="form-label">State</label>
                                                                <select
                                                                    class="form-control mortgages_creditor_state_3 "
                                                                    name="mortgages_creditor_state_3">
                                                                    <option value="">Please Select State</option>
                                                                    {!! AddressHelper::getStatesList(
                                                                        Helper::validate_key_value('mortgages_creditor_state_3', $formData) !== ''
                                                                            ? Helper::validate_key_value('mortgages_creditor_state_3', $formData)
                                                                            : old('mortgages_creditor_state_3'),
                                                                    ) !!}
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 own_div">
                                                        <div class="label-div">
                                                            <div class="form-group">
                                                                <label class="form-label">Zip code</label>
                                                                <input type="text"
                                                                    class="form-control allow-5digit mortgages_creditor_zipcode_3 "
                                                                    name="mortgages_creditor_zipcode_3"
                                                                    placeholder="Zip code"
                                                                    value="{{ Helper::validate_key_value('mortgages_creditor_zipcode_3', $formData) !== '' ? Helper::validate_key_value('mortgages_creditor_zipcode_3', $formData) : old('mortgages_creditor_zipcode_3') }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Mortgage section end --}}
                        </div>
                        {{-- Property owned by section end --}}
                    </div>
                    {{-- Property value section end --}}
                </div>
            </div>
        </div>
        {{-- Property Section end --}}
    </div>
</div>


<div class="col-md-6 mt-0">
    <div class="label-div question-area  ">
        <label class="form-label">Property in foreclosure?</label>
        <div class="custom-radio-group form-group">
            <!-- Radio -->
            <input type="radio" required name="mortgage_foreclosure_property" class="form-check-input"
                id="foreclosure_property_yes" value="0" {{ $foreclosureYesChecked }}>
            <label for="foreclosure_property_yes" class="btn-toggle {{ $foreclosureYesActive }}"
                onclick="forclosurePropertyChange(0)">Yes</label>
            <input type="radio" required name="mortgage_foreclosure_property" class="form-check-input"
                id="foreclosure_property_no" value="1" {{ $foreclosureNoChecked }}>
            <label for="foreclosure_property_no" class="btn-toggle {{ $foreclosureNoActive }}"
                onclick="forclosurePropertyChange(1)">No</label>
        </div>
    </div>
</div>

<div class="col-md-6  mt-0">
    <div class="label-div question-area ">
        <label class="form-label">Foreclosure sale date been set?</label>
        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" required name="mortgage_foreclosure_date" class="form-check-input"
                id="foreclosure_date_yes" value="0" {{ $foreclosureDateYesChecked }}>
            <label for="foreclosure_date_yes" class="btn-toggle {{ $foreclosureDateYesActive }}"
                onclick="forclosureDateChange(0)">Yes</label>
            <input type="radio" required name="mortgage_foreclosure_date" class="form-check-input"
                id="foreclosure_date_no" value="1" {{ $foreclosureDateNoChecked }}>
            <label for="foreclosure_date_no" class="btn-toggle {{ $foreclosureDateNoActive }}"
                onclick="forclosureDateChange(1)">No</label>
        </div>
    </div>
</div>

<div class="col-md-6 forecloser_section {{ ($mortgageForeclosureProperty === '0' || $mortgageForeclosureProperty === 0 ? '' : 'hide-data') }}">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label" for="notes1">Notes:</label>
            <textarea placeholder="Notes" name="mortgage_notes" rows="3" id="notes2"
                class="form-textarea form-control">{{ Helper::validate_key_value('mortgage_notes', $formData) !== '' ? Helper::validate_key_value('mortgage_notes', $formData) : old('mortgage_notes') }}</textarea>
        </div>
    </div>
</div>
<div class="col-md-6 forecloser_date_section {{ (($mortgageForeclosureProperty === '0' || $mortgageForeclosureProperty === 0) && ($mortgageForeclosureDate === '0' || $mortgageForeclosureDate === 0) ? '' : 'hide-data') }}">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Foreclosure Date: MM/DD/YYYY</label>
            <input type="text" name="mortgage_foreclosure_date_scheduled"
                class="form-control date_filed max-w-250px" placeholder="Foreclosure Date: MM/DD/YYYY"
                value="{{ Helper::validate_key_value('mortgage_foreclosure_date_scheduled', $formData) !== '' ? Helper::validate_key_value('mortgage_foreclosure_date_scheduled', $formData) : old('mortgage_foreclosure_date_scheduled') }}">
        </div>
    </div>
</div>
