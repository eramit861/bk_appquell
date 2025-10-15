<div class="light-gray-div stepfour_clone stepfour_clone_{{ $j }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $j + 1 }}</div>Business Details
        </h2>
        <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('stepfour_clone', {{ $j }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3 set-mobile-col">
            <div class="col-12"><strong class="subtitle">Business Information</strong>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Business Name</label>
                        <input type="text" class="input_capitalize form-control own_business_name required" name="used_business_ein_data[own_business_name][{{ $j }}]" placeholder="Business Name" value="{{ Helper::validate_key_loop_value('own_business_name', $used_business_data, $j) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Type</label>
                        @php $bussinessTypeArray = ArrayHelper::getBasicInfoBussinessTypeArray(); @endphp
                        <select class="form-control required bussiness_type" name="used_business_ein_data[type][{{ $j }}]" onchange="updateDsDescDivShowHide('{{ $j }}', 'bsDescDiv_{{ $j }}', 'beinDiv_{{ $j }}')">
                            <option value="">Please Select type</option>
                            @foreach ($bussinessTypeArray as $key => $type)
                            <option value="{{ $key }}" {{ (Helper::validate_key_loop_value('type', $used_business_data, $j) == $key) ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-6 col-12 bsDescDiv bsDescDiv_{{ $j }} {{ (Helper::validate_key_loop_value('type', $used_business_data, $j) == 3) ? '' : 'hide-data' }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>Describe your business</label>
                        @php $bussinessDescriptionArray = ArrayHelper::getBasicInfoBussinessDescriptionArray(); @endphp
                        <select class="form-control required des_cbussiness_type" name="used_business_ein_data[businessDescription][{{ $j }}]">
                            <option value="">Please Select type</option>
                            @foreach ($bussinessDescriptionArray as $key => $label)
                            <option value="{{ $key }}" {{ (Helper::validate_key_loop_value('businessDescription', $used_business_data, $j) == $key) ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Owned By?</label>
                        <select class="form-control required own_business_selection" name="used_business_ein_data[own_business_selection][{{ $j }}]">
                            <option value="">Select Debtor type</option>
                            <option value="0" {{ (Helper::validate_key_loop_value('own_business_selection', $used_business_data, $j) != 1) ? 'selected' : '' }} {{ Helper::validate_key_toggle('own_business_selection', $used_business_data, $j) }}>Debtor</option>
                            <option value="1" {{ (Helper::validate_key_loop_value('own_business_selection', $used_business_data, $j) == 1) ? 'selected' : '' }} {{ Helper::validate_key_toggle('own_business_selection', $used_business_data, $j) }}>
                                {{ ($client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED) ? 'Non-Filing Spouse' : '' }}
                                {{ ($client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) ? 'Spouse' : '' }}
                            </option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label><small><strong>What is (or was) the nature of your business or self-employment?</strong></small> <br>
                        <small class="text-c-blue">(Examples: restaurant owner, rideshare driver, construction contractor)</small></label>
                        <input type="text" class="input_capitalize form-control nature_of_business required" name="used_business_ein_data[nature_of_business][{{ $j }}]" placeholder="Nature of Business" value="{{ Helper::validate_key_loop_value('nature_of_business', $used_business_data, $j) }}">
                    </div>
                </div>
            </div>


            <div class="col-12"><strong class="subtitle">Address Details</strong></div>


            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Street Address</label>
                        <input type="text" name="used_business_ein_data[street_number][{{$j}}]" class="input_capitalize form-control required street_number" placeholder="Address" value="{{ Helper::validate_key_loop_value('street_number', $used_business_data, $j) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required city" name="used_business_ein_data[city][{{$j}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('city', $used_business_data, $j) }}">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required state" name="used_business_ein_data[state][{{$j}}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(Helper::validate_key_loop_value('state', $used_business_data, $j)) !!}
                        </select>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>ZIP Code</label>
                        <input type="number" class="form-control allow-5digit required zip" name="used_business_ein_data[zip][{{$j}}]" placeholder="Zip code" value="{{ Helper::validate_key_loop_value('zip', $used_business_data, $j) }}">
                    </div>
                </div>
            </div>

            <div class="col-12"><strong class="subtitle">Business Identification</strong>
            </div>

            <div class="col-xl-4 col-lg-6 col-md-6 col-md-3 col-12 beinDiv beinDiv_{{ $j }} {{ (Helper::validate_key_loop_value('type', $used_business_data, $j) == 3) ? 'hide-data' : '' }}">
                <div class="label-div mb-2">
                    <div class="form-group mb-0">
                        <label>EIN # </label>
                        <input type="text" {{ Helper::validate_key_loop_value('doesntHaveEin', $used_business_data, $j) == 1 ? 'disabled' : '' }} maxlength="10" class="form-control eiin own_ein_no {{ Helper::validate_key_loop_value('doesntHaveEin', $used_business_data, $j) != 1 ? 'required' : '' }}" name="used_business_ein_data[own_ein_no][{{ $j }}]" placeholder="EIN" value="{{ Helper::validate_key_loop_value('own_ein_no', $used_business_data, $j) }}">
                    </div>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label">
                        <input {{ (Helper::validate_key_loop_value('doesntHaveEin', $used_business_data, $j) == 1) ? 'checked=checked' : '' }} type="checkbox" onchange="checkEin(this)" value="1" class="doesntHaveEin form-check-input" name="used_business_ein_data[doesntHaveEin][{{ $j }}]">
                        This business doesn't have an EIN#
                    </label>
                </div>
            </div>
          
            <div class="col-xl-3 col-lg-6 col-md-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Date you started in business</label>
                        <input type="text" placeholder="MM/DD/YYYY" class="form-control required operation_date date_filed" name="used_business_ein_data[operation_date][{{$j}}]" value="{{ Helper::validate_key_loop_value('operation_date', $used_business_data, $j) }}">
                    </div>
                </div>
            </div>

            @php $stillOpen = Helper::validate_key_loop_value('business_still_open', $used_business_data, $j) ?? ''; @endphp
            <div class="col-xl-4 col-lg-6 col-md-6 col-12 businessEnded">
                <div class="label-div mb-2">
                    <div class="form-group mb-0">
                        <label>Date you ended/dissolved business:</label>
                        <input type="text" {{ $stillOpen == 1 ? 'disabled' : '' }} placeholder="MM/DD/YYYY" class="form-control operation_date2 {{ $stillOpen != 1 ? 'required' : '' }} operation_date2_{{$j}} date_filed" name="used_business_ein_data[operation_date2][{{$j}}]" value="{{ ($stillOpen == 1) ? '' : Helper::validate_key_loop_value('operation_date2', $used_business_data, $j) }}">
                    </div>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label">
                        <input type="checkbox" {{ $stillOpen == 1 ? 'checked=checked' : '' }} name="used_business_ein_data[business_still_open][{{$j}}]" class="business_still_open form-check-input" onchange="checkBizend(this, '{{$j}}')" value="1" /> 
                        Business is still open
                    </label>
                </div>
            </div>

            <div class="col-12 business_still_open_data business_still_open_data_{{ $j }} {{ ($stillOpen == 1) ? '' : 'hide-data' }}">
                <strong class="subtitle">Ownership &amp; Financial Information</strong>
            </div>

            <div class="col-xl-3 col-md-4 col-sm-6 col-12 business_still_open_data business_still_open_data_{{ $j }} {{ ($stillOpen == 1) ? '' : 'hide-data' }}">
                <div class="label-div">
                    <div class="form-group">
                        <label> Percentage of your ownership in the business:</label>
                        <div class="input-group">
                            <input type="text" name="used_business_ein_data[type_of_account][{{ $j }}]" class="form-control required traded_stocks_type_of_account_step" placeholder="% of ownership" value="{{ Helper::validate_key_loop_value('type_of_account', $used_business_data, $j) }}">
                            <span class="input-group-text percent">%</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-4 col-sm-6 col-12 business_still_open_data business_still_open_data_{{ $j }} {{ ($stillOpen == 1) ? '' : 'hide-data' }}">
                <div class="label-div">
                    <div class="form-group">
                        <label>Value of Business:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="used_business_ein_data[property_value][{{ $j }}]" class="price-field form-control  required traded_stocks_property_value_step" placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $used_business_data, $j) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>