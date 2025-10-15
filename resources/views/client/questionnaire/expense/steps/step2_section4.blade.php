<div class="col-12">
    <div class="light-gray-div mt-2">
        <h2 class="text-dark fw-bold">Utilities</h2>
        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter your average monthly electric and/or heating
                        bill:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="utilities[electricity_heating_price]"
                                value="{{ Helper::validate_key_loop_value('utilities', $expenses, 'electricity_heating_price') }}"
                                aria-label="Username" aria-describedby="basic-addon1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter your average monthly water and/or sewer bill:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="utilities[water_sewerl_price]"
                                value="{{ Helper::validate_key_loop_value('utilities', $expenses, 'water_sewerl_price') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter your average monthly phone bill:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="utilities[telephone_service_price]"
                                value="{{ Helper::validate_key_loop_value('utilities', $expenses, 'telephone_service_price') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Do you have any other utility bills?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="These typically include Internet/Netflix/Hulu/Cable/Streaming Services etc.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="utility_bills" id="utility_bills_yes" class="d-none required"
                            value="1" {{ Helper::validate_key_toggle('utility_bills', $expenses, 1) }}>
                        <label for="utility_bills_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('utility_bills', $expenses, 1) }}"
                            onclick="getUtilityBillsData('yes');">Yes</label>

                        <input type="radio" name="utility_bills" id="utility_bills_no" class="d-none required"
                            value="0" {{ Helper::validate_key_toggle('utility_bills', $expenses, 0) }}>
                        <label for="utility_bills_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('utility_bills', $expenses, 0) }}"
                            onclick="getUtilityBillsData('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('utility_bills', $expenses) }}" id="utility_bills_data">
                <div class="label-div">
                    <label class="w-100 mb-2">
                        <span class="me-2">List each extra utility like above example</span>
                    </label>
                    <h6 class="blink text-c-red"><strong>Click below button to choose Utilities</strong>
                        <i class="fa fa-arrow-down"></i>
                    </h6>
                    <a href="javascript:void(0)" class="px-2 py-1 open-utility-btn"
                        onclick="openUtilityForm('{{ route('expense_utility_popup') }}', 2)">
                        Select Utilities
                    </a>
                </div>
                <div class="form-main w-100 monthly_amount utility-bills-data-div-d1 {{ !empty(Helper::current(Helper::validate_key_value('monthly_utilities_bills', $expenses))) ? '' : 'hide-data' }}"
                    id="monthly_amount1">
                    <div class="row">
                        <div class="col-12">
                            <div class="label-div mb-0">
                                <div class="form-group">
                                    <div class="input-group mb-1">
                                        <input {{ $readOnly }} type="text"
                                            value="{{ Helper::current(Helper::validate_key_value('monthly_utilities_bills', $expenses)) }}"
                                            placeholder="Specify" name="monthly_utilities_bills"
                                            class="form-control required monthly_utilities_bills utility_text_field_d2" />
                                    </div>
                                </div>
                                <label>Put the combined amount you pay for all above extra utility bills
                                    below:</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <div class="input-group mb-1">
                                        <span class="input-group-text">$</span>
                                        <input type="number"
                                            class="form-control price-field expense_prices required monthly_utilities_value"
                                            name="monthly_utilities_value[{{ $i }}]"
                                            value="{{ Helper::current(Helper::validate_key_value('monthly_utilities_value', $expenses)) }}" />
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
