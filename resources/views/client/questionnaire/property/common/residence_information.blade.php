<div class="col-12">
    <strong class="subtitle">Residence Information</strong>
</div>

<div class="col-12 light-gray-div b-0-i py-0 mb-0 payment_not_primary_address_parents">
    <div class="label-div question-area">
        <label class="fs-13px">
            Is this property your primary residence (<u>were you currently live</u>)?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Confirms whether this property is your main home where you currently live.">
                <i class="bi bi-question-circle"></i>
            </div>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group mb-0">
            <input type="radio" id="payment_not_primary_address_no_{{ $i }}" class="d-none not_primary_address" name="property_resident[not_primary_address][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('not_primary_address', $resident, 1) }} value="1">
            <label for="payment_not_primary_address_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('not_primary_address', $resident, 1) }}" onclick="not_primary_address_property('no',this); setBorderLabel(this, 'Non-Primary Residence');" data-index="{{ $i }}">No</label>

            <input type="radio" id="payment_not_primary_address_yes_{{ $i }}" class="d-none not_primary_address" name="property_resident[not_primary_address][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('not_primary_address', $resident, 0) }} value="0">
            <label for="payment_not_primary_address_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('not_primary_address', $resident, 0) }}" onclick="not_primary_address_property('yes',this); setBorderLabel(this, 'Primary Residence');" data-index="{{ $i }}">Yes</label>
        </div>
    </div>
</div>

<div class="col-12 {{ Helper::key_hide_show_v('not_primary_address', $resident) }} payment_not_primary_address_data main-property-section main-property-section-{{ $i }}">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <div class="label-div">
                <div class="form-group">
                    <label>Street Address</label>
                    <input type="text" class="input_capitalize form-control required mortgage_address" data-index="{{ $i }}" name="property_resident[mortgage_address][{{ $i }}]" placeholder="Street Address" value="{{ Helper::validate_key_value('mortgage_address', $resident) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
            <div class="label-div">
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="input_capitalize form-control required mortgage_city" data-index="{{ $i }}" name="property_resident[mortgage_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_value('mortgage_city', $resident) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    @php $stateID = Helper::validate_key_value('mortgage_state', $resident); @endphp
                    <label>State</label>
                    <select class="form-control required mortgage_state" data-index="{{ $i }}" name="property_resident[mortgage_state][{{ $i }}]" id="mortgage_state_{{ $i }}" data-countyid="mortgage_county_{{ $i }}">
                        <option value="">Please Select State</option>
                        {!! AddressHelper::getStatesList($stateID) !!}
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>ZIP Code</label>
                    <input type="number" class="form-control allow-5digit required mortgage_zip" data-index="{{ $i }}" name="property_resident[mortgage_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_value('mortgage_zip', $resident) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    @php
                    $countyID = Helper::validate_key_value('mortgage_county', $resident);
                    $state_name = AddressHelper::getSelectedStateName($stateID);
                    $statearr = explode("(", $state_name);
                    $state_name = isset($statearr[0]) ? trim($statearr[0]) : '';
                    $countyList = \App\Models\CountyFipsData::get_county_by_state_name($state_name);
                    @endphp
                    <label>County</label>
                    <select value="{{ $countyID }}" data-index="{{ $i }}" name="property_resident[mortgage_county][{{ $i }}]" id="mortgage_county_{{ $i }}" class="form-control required mortgage_county">
                        <option value="">Choose County</option>
                        @foreach($countyList as $data)
                            @php $selected = ($countyID == $data['id']) ? 'selected' : ''; @endphp
                            <option value="{{ $data['id'] }}" {{ $selected }}>{{ $data['county_name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-12 col-md-12 property-detail-div hide-data">
    <div class="mb-3 mt-1">
        <a href="javascript:void(0)" class="profit-loss-btn px-2 py-1 get-property-details-by-graphql" onclick="getPropertyResidenceDetailsByGraphQL({{ $i }})">
            <i class="bi bi-house-exclamation mr-1"></i>
            Select/Tap Here to Get Property Details
        </a>
    </div>
</div>