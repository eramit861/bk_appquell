<div class="light-gray-div ">
    <h2 class="px-2">
        <span class="me-2">Mortgage Loan 2</span>
        <small class="text-c-blue text-bold">@if(!@$web_view)(Please upload your most recent mortgage statement on the document page)@endif</small>
    </h2>
    <div class="row gx-3 loan-2-div loan-2-div-{{ $i }}">
        <div class="col-12">
            <strong class="subtitle">Creditor and Account Details</strong>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
            <div class="label-div">
                <div class="form-group">
                    <label> Name</label>
                    <input data-index="{{ $i }}" type="text" class="input_capitalize form-control loan2_vehicle_creditor_name required" name="property_resident[home_car_loan2][creditor_name][{{ $i }}]" placeholder="Creditor Name" value="{{ Helper::validate_key_value('creditor_name', $home_car_loan2) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
            <div class="label-div">
                <div class="form-group ">
                    <label>
                        Street address
                    </label>
                    <input data-index="{{ $i }}" type="text" class="input_capitalize form-control loan2_vehicle_creditor_name_addresss required" name="property_resident[home_car_loan2][creditor_name_addresss][{{ $i }}]" placeholder="Street Address" value="{{ Helper::validate_key_value('creditor_name_addresss', $home_car_loan2) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>City</label>
                    <input data-index="{{ $i }}" type="text" class="input_capitalize form-control loan2_vehicle_creditor_city required" name="property_resident[home_car_loan2][creditor_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_value('creditor_city', $home_car_loan2) }}">
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>State</label>
                    <select data-index="{{ $i }}" class="form-control loan2_vehicle_creditor_state required" name="property_resident[home_car_loan2][creditor_state][{{ $i }}]">
                        <option value="">Please Select State</option>
                        {!! AddressHelper::getStatesList(Helper::validate_key_value('creditor_state', $home_car_loan2)) !!}
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">
                <div class="form-group">
                    <label>Zip code</label>
                    <input data-index="{{ $i }}" type="number" class="form-control allow-5digit loan2_vehicle_creditor_zip required" name="property_resident[home_car_loan2][creditor_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_value('creditor_zip', $home_car_loan2) }}">
                </div>
            </div>
        </div>

        <div class="col-xl-2 col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Amount Owed:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input data-index="{{ $i }}" type="number" class="form-control price-field loan2_vehicle_amount_own required" name="property_resident[home_car_loan2][amount_own][{{ $i }}]" placeholder="Amount Owed" value="{{ Helper::validate_key_value('amount_own', $home_car_loan2) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Account Number:</label>
                    <input data-index="{{ $i }}" type="text" class="form-control loan2_vehicle_account_number required" name="property_resident[home_car_loan2][account_number][{{ $i }}]" placeholder="Account Number" value="{{ Helper::validate_key_value('account_number', $home_car_loan2) }}">
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Date when debt was incurred:</label>
                    <input data-index="{{ $i }}" type="text" class="form-control date_month_year_custom loan2_vehicle_debt_incurred_date required" name="property_resident[home_car_loan2][debt_incurred_date][{{ $i }}]" placeholder="MM/YYYY" value="{{ Helper::validate_key_value('debt_incurred_date', $home_car_loan2) }}">
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Monthly payment amount:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input data-index="{{ $i }}" type="number" class="form-control price-field loan2_vehicle_monthly_payment required" name="property_resident[home_car_loan2][monthly_payment][{{ $i }}]" placeholder="Monthly payment" value="{{ Helper::validate_key_value('monthly_payment', $home_car_loan2) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Past due payments: &nbsp;&nbsp;&nbsp;</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        </div>
                        <input data-index="{{ $i }}" type="number" class="form-control price-field loan2_vehicle_due_payment required" name="property_resident[home_car_loan2][due_payment][{{ $i }}]" placeholder="Past due payments" value="{{ Helper::validate_key_value('due_payment', $home_car_loan2) }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-2 col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="label-div">
                <div class="form-group">
                    <label>Current Interest Rate:</label>
                    <div class="input-group">
                        <input data-index="{{ $i }}" type="number" class="form-control price-field  loan2_vehicle_current_interest_rate" name="property_resident[home_car_loan2][current_interest_rate][{{ $i }}]" placeholder="Current Interest Rate" value="{{ Helper::validate_key_value('current_interest_rate', $home_car_loan2) }}">
                        <span class="input-group-text percent">%</span>
                    </div>
                </div>
            </div>
        </div>

        @php
        $is_mortgage_three_months2 = Helper::validate_key_value('is_mortgage_three_months', $home_car_loan2);
        $is_mortgage_three_months2_show_hide = "hide-data";
        if ($is_mortgage_three_months2 == 1) {
            $is_mortgage_three_months2_show_hide = "";
        }
        @endphp

        <div class="col-12">
            <strong class="subtitle">Payments made on this mortgage in the last 90 days</strong>
        </div>

        <div class="col-12 debt_tax_own_by">
            <div class="label-div question-area b-0-i pb-0">
                <label class="fs-13px">Have you made any payments on this mortgage in the last 3 months?</label>
                <div class="custom-radio-group form-group">
                    <input type="radio" data-index="{{ $i }}" id="additional_is_mortgage_three_months_yes_{{ $i }}"
                        name="property_resident[home_car_loan2][is_mortgage_three_months][{{ $i }}]" value="1"
                        class="required d-none is_mortgage_three_months three_month_mortgage_2" required
                        {!! Helper::validate_key_toggle('is_mortgage_three_months', $home_car_loan2, 1) !!} />
                    <label for="additional_is_mortgage_three_months_yes_{{ $i }}" class="btn-toggle debt_months_label_yes {{ Helper::validate_key_toggle_active('is_mortgage_three_months', $home_car_loan2, 1) }}" onclick="isThreeMonthsCommon('yes','additional_three_months_div_{{ $i }}'); isMortgageThreeMonthAdditional1('yes',{{ $i }});">Yes</label>

                    <input type="radio" data-index="{{ $i }}" id="additional_is_mortgage_three_months_no_{{ $i }}"
                        name="property_resident[home_car_loan2][is_mortgage_three_months][{{ $i }}]" value="0"
                        class="required d-none is_mortgage_three_months three_month_mortgage_2" required
                        {!! Helper::validate_key_toggle('is_mortgage_three_months', $home_car_loan2, 0) !!} />
                    <label for="additional_is_mortgage_three_months_no_{{ $i }}" class="btn-toggle debt_months_label_no {{ Helper::validate_key_toggle_active('is_mortgage_three_months', $home_car_loan2, 0) }}" onclick="isThreeMonthsCommon('no','additional_three_months_div_{{ $i }}'); isMortgageThreeMonthAdditional1('no',{{ $i }});">No</label>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="row additional_three_months_div additional_three_months_div_{{ $i }} {{ ' ' . $is_mortgage_three_months2_show_hide }}">
                <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Payment amount</label>
                            <div class="input-group mb-0">
                                <span class="input-group-text">$</span>
                                <input data-index="{{ $i }}" data-index="{{ $i }}" data-key="home_car_loan2" data-mainarray="property_resident" placeholder="Payment" type="number" class="payment_1_of_2 price-field form-control" value="{{ Helper::validate_key_value('payment_1', $home_car_loan2) }}" name="property_resident[home_car_loan2][payment_1][{{ $i }}]">
                            </div>
                            <small class="font-weight-bold font-italic">
                                Payment date: {{ $monthBeforeLast }}
                                <input type="hidden" class="payment_dates_1_of_2" name="property_resident[home_car_loan2][payment_dates_1][{{ $i }}]" value="{{ $monthBeforeLast }}">
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
                                <input data-index="{{ $i }}" data-index="{{ $i }}" data-key="home_car_loan2" data-mainarray="property_resident" placeholder="Payment" type="number" class="payment_2_of_2 price-field form-control" value="{{ Helper::validate_key_value('payment_2', $home_car_loan2) }}" name="property_resident[home_car_loan2][payment_2][{{ $i }}]">
                            </div>
                            <small class="font-weight-bold font-italic">
                                Payment date: {{ $lastMonth }}
                                <input type="hidden" class="payment_dates_2_of_2" name="property_resident[home_car_loan2][payment_dates_2][{{ $i }}]" value="{{ $lastMonth }}">
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
                                <input data-index="{{ $i }}" data-index="{{ $i }}" data-key="home_car_loan2" data-mainarray="property_resident" placeholder="Payment" type="number" class="payment_3_of_2 price-field form-control" value="{{ Helper::validate_key_value('payment_3', $home_car_loan2) }}" name="property_resident[home_car_loan2][payment_3][{{ $i }}]">
                            </div>
                            <small class="font-weight-bold font-italic">
                                Payment date: {{ $currentMonth }}
                                <input type="hidden" class="payment_dates_3_of_2" name="property_resident[home_car_loan2][payment_dates_3][{{ $i }}]" value="{{ $currentMonth }}">
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
                                <input readonly placeholder="Monthly Payment" type="number" class="price-field form-control total_amount_paid_1_of_2" value="{{ Helper::validate_key_value('total_amount_paid', $home_car_loan2) }}" name="property_resident[home_car_loan2][total_amount_paid][{{ $i }}]">
                            </div>
                        </div>
                    </div>
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
                    <input type="radio" id="owned_by_you_loan2_{{ $i }}" data-index="{{ $i }}"
                        class="loan2_property_owned_by required d-none " name="property_resident[home_car_loan2][property_owned_by][{{ $i }}]" value="1"
                        {!! Helper::validate_key_toggle('property_owned_by', $home_car_loan2, 1) !!}>
                    <label for="owned_by_you_loan2_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('property_owned_by', $home_car_loan2, 1) }}" onclick="property_common_toggle_own_by(1,this)"> You</label>

                    <input type="radio" id="owned_by_spouse_loan2_{{ $i }}" data-index="{{ $i }}"
                        class="loan2_property_owned_by required d-none " name="property_resident[home_car_loan2][property_owned_by][{{ $i }}]" value="2"
                        {!! Helper::validate_key_toggle('property_owned_by', $home_car_loan2, 2) !!}>
                    <label for="owned_by_spouse_loan2_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('property_owned_by', $home_car_loan2, 2) }}" onclick="property_common_toggle_own_by(2,this)"> Spouse</label>

                    <input type="radio" id="owned_by_joint_loan2_{{ $i }}" data-index="{{ $i }}"
                        class="loan2_property_owned_by required d-none " name="property_resident[home_car_loan2][property_owned_by][{{ $i }}]" value="3"
                        {!! Helper::validate_key_toggle('property_owned_by', $home_car_loan2, 3) !!}>
                    <label for="owned_by_joint_loan2_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('property_owned_by', $home_car_loan2, 3) }}" onclick="property_common_toggle_own_by(3,this)"> Joint</label>

                    <input type="radio" id="owned_by_other_loan2_{{ $i }}" data-index="{{ $i }}"
                        class="loan2_property_owned_by required d-none " name="property_resident[home_car_loan2][property_owned_by][{{ $i }}]" value="4"
                        {!! Helper::validate_key_toggle('property_owned_by', $home_car_loan2, 4) !!}>
                    <label for="owned_by_other_loan2_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('property_owned_by', $home_car_loan2, 4) }}" onclick="property_common_toggle_own_by(4,this)"> Other</label>
                </div>
            </div>
        </div>

        <div class="col-12 {{ Helper::key_hide_show_ownedby('property_owned_by', $home_car_loan2) }} property_codebtor_cosigner_data" id="property_codebtor_cosigner_data">
            <div class="row codebtor-tab">
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Codebtor name </label>
                            <input data-index="{{ $i }}" type="text" class="input_capitalize cod_name form-control loan2_cosigner_vehicle_creditor_name required" name="property_resident[home_car_loan2][codebtor_creditor_name][{{ $i }}]" placeholder="Codebtor Name" value="{{ Helper::validate_key_value('codebtor_creditor_name', $home_car_loan2) }}">
                            @if (isset($appservice_codebtors) && !empty($appservice_codebtors))
                                <!-- makeCodetorSelected(this) -->
                                <select class="cod_opt form-control col-12 col-md-6" onchange="alreadySavedCodebtor(this)">
                                    <option class="form-control" value="">Choose Already Saved Codebtor</option>
                                    @foreach ($appservice_codebtors as $codebtor)
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
                            <input data-index="{{ $i }}" type="text" class="input_capitalize cod_address form-control loan2_cosigner_vehicle_creditor_name_addresss required" name="property_resident[home_car_loan2][codebtor_creditor_name_addresss][{{ $i }}]" placeholder="Street Address" value="{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $home_car_loan2) }}">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                    <div class="label-div">
                        <div class="form-group">
                            <label>City</label>
                            <input data-index="{{ $i }}" type="text" class="input_capitalize cod_city form-control loan2_cosigner_vehicle_creditor_city required" name="property_resident[home_car_loan2][codebtor_creditor_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_value('codebtor_creditor_city', $home_car_loan2) }}">
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                    <div class="label-div">
                        <div class="form-group">
                            <label>State</label>
                            <select data-index="{{ $i }}" class="form-control cod_state loan2_cosigner_vehicle_creditor_state required" name="property_resident[home_car_loan2][codebtor_creditor_state][{{ $i }}]">
                                <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesList(Helper::validate_key_value('codebtor_creditor_state', $home_car_loan2)) !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Zip code</label>
                            <input data-index="{{ $i }}" type="number" class="form-control cod_zip allow-5digit loan2_cosigner_vehicle_creditor_zip required" name="property_resident[home_car_loan2][codebtor_creditor_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_value('codebtor_creditor_zip', $home_car_loan2) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="label-div question-area">
                <label class="fs-13px">
                    Do your payments include taxes and/or insurance?
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group">
                    <input type="radio" id="loan2_vehicle_payment_tax_insurance_no_{{ $i }}" class="d-none loan2_vehicle_payment_tax_insurance" name="property_resident[home_car_loan2][payment_tax_insurance][{{ $i }}]" data-index="{{ $i }}" required {!! Helper::validate_key_toggle('payment_tax_insurance', $home_car_loan2, 1) !!} value="1">
                    <label for="loan2_vehicle_payment_tax_insurance_no_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('payment_tax_insurance', $home_car_loan2, 1) }}">No</label>

                    <input type="radio" id="loan2_vehicle_payment_tax_insurance_yes_{{ $i }}" class="d-none loan2_vehicle_payment_tax_insurance" name="property_resident[home_car_loan2][payment_tax_insurance][{{ $i }}]" data-index="{{ $i }}" required {!! Helper::validate_key_toggle('payment_tax_insurance', $home_car_loan2, 2) !!} value="2">
                    <label for="loan2_vehicle_payment_tax_insurance_yes_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('payment_tax_insurance', $home_car_loan2, 2) }}">Yes</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row additional_loan_obj loan-3-main-div-{{ $i }} {{ empty($resident) ? ' hide-data ' : ' ' }}">
        <div class="col-12">
            <div class="label-div question-area">
                <label class="fs-13px">
                    Do you have any <span class="text-c-blue">mortgages</span> or <span class="text-c-blue">loans</span> on property listed above? <span class="text-c-blue">(These include a 3rd mortgage, etc.)</span>
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group">
                    <input type="radio" id="additional_loan2_no_{{ $i }}" class="d-none additional_loan2" name="property_resident[home_car_loan3][additional_loan2][{{ $i }}]" data-index="{{ $i }}" required {!! Helper::validate_key_toggle('additional_loan2', $home_car_loan3, 0) !!} value="0">
                    <label for="additional_loan2_no_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('additional_loan2', $home_car_loan3, 0) }}" onclick="getSecondAdditionalLoan('no',this);">No</label>

                    <input type="radio" id="additional_loan2_yes_{{ $i }}" class="d-none additional_loan2" name="property_resident[home_car_loan3][additional_loan2][{{ $i }}]" data-index="{{ $i }}" required {!! Helper::validate_key_toggle('additional_loan2', $home_car_loan3, 1) !!} value="1">
                    <label for="additional_loan2_yes_{{ $i }}" class="btn-toggle prop_type_radio {{ Helper::validate_key_toggle_active('additional_loan2', $home_car_loan3, 1) }}" onclick="getSecondAdditionalLoan('yes',this);">Yes</label>
                </div>
            </div>
        </div>
    </div>
</div>