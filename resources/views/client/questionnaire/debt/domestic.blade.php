@php
$statecode = Helper::validate_key_value('domestic_address_state', $domestic);
$domesticAddresses = current(AddressHelper::getDomesticAddressStatesList($statecode, false));
@endphp

<div class="light-gray-div domestic_form {{ ($debtNo == 1) ? 'mt-2' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $debtNo }}</div> Debt Details
        </h2>
        <button type="button" class="delete-div" title="Delete" data-saveid="{{ $i }}" onclick="removeDSODebt('{{ route('dso_custom_save') }}',this);">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <a href="javascript:void(0)" data-saveid="{{ $i }}" class=" client-edit-button with-delete " onclick="display_dso_debt_div(this, {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <!-- summary -->
        <div class="row gx-3 common_creditor_summary mb-3 {{ empty($domestic) ? 'hide-data' : '' }} dso_summary_{{ $i }}">
            <div class="col-lg-7 col-md-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <label class="font-weight-bold ">The Court Order is from: <span class="font-weight-normal summary-state-{{ $i }}">
                                {{ Helper::validate_key_value('domestic_address_state', $domestic) }}
                            </span></label>
                    </div>
                    <div class="col-12">
                        <label class="font-weight-bold ">Creditor Name: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('domestic_support_name', $domestic) }}
                            </span></label>
                    </div>
                    <div class="col-12">
                        <label class="font-weight-bold ">Address: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('domestic_support_address', $domestic) }}
                            </span></label>
                    </div>
                    <div class="col-lg-3 col-12">
                        <label class="font-weight-bold ">City: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('domestic_support_city', $domestic) }}
                            </span></label>
                    </div>
                    <div class="col-lg-2 col-12">
                        <label class="font-weight-bold ">State: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('creditor_state', $domestic) }}
                            </span></label>
                    </div>
                    <div class="col-lg-7 col-12">
                        <label class="font-weight-bold ">Zip: <span class="font-weight-normal">
                                {{ Helper::validate_key_value('domestic_support_zipcode', $domestic) }}
                            </span></label>
                    </div>

                    <div class="col-lg-3 col-12">
                        <label class="font-weight-bold ">Acct #: <span
                                class="font-weight-normal">{{ Helper::validate_key_value('domestic_support_account', $domestic) }}</span></label>
                    </div>

                    <div class="col-lg-5 col-12">
                        <label class="font-weight-bold ">Current monthly payment: <span
                                class="section-title font-weight-normal text-success">${{ number_format((float)Helper::validate_key_value('domestic_support_monthlypay', $domestic), 2, '.', ',') }}</span></label>
                    </div>
                    <div class="col-lg-4 col-12">
                        <label class="font-weight-bold ">Past due amount: <span
                                class="font-weight-normal text-danger">${{ number_format((float)Helper::validate_key_value('domestic_support_past_due', $domestic), 2, '.', ',') }}</span></label>
                    </div>
                    @php
                    $is_three_months = Helper::validate_key_value('is_domestic_support_three_months', $domestic);

                    $is_three_months_show_hide = "hide-data";
                    if ($is_three_months == 1) {
                        $is_three_months_show_hide = "";
                    }
                    $payment_dates_1 = Helper::validate_key_value('payment_dates_1', $domestic);
                    $payment_dates_2 = Helper::validate_key_value('payment_dates_2', $domestic);
                    $payment_dates_3 = Helper::validate_key_value('payment_dates_3', $domestic);
                    $payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
                    $payment_dates .= !empty($payment_dates_2) ? ', ' . $payment_dates_2 : '';
                    $payment_dates .= !empty($payment_dates_3) ? ', ' . $payment_dates_3 : '';
                    @endphp
                    <div class="col-12">
                        <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                            <span
                                class="font-weight-normal">{{ Helper::key_display('is_domestic_support_three_months', $domestic) }}</span></label>
                    </div>
                    <div class="col-lg-8 col-12 {{ $is_three_months_show_hide }} ">
                        @php
                        $payments = "<span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_1', $domestic), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_1', $domestic) . ")";
                        $payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_2', $domestic), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_2', $domestic) . ")";
                        $payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_3', $domestic), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_3', $domestic) . ")";
                        @endphp
                        <label class="font-weight-bold ">Payment(s):
                            <span class="font-weight-normal">{!! $payments !!}</span></label>
                    </div>
                    <div class="col-lg-4 col-12 {{ $is_three_months_show_hide }}">
                        <label class="font-weight-bold">Total Amount Paid:
                            <span
                                class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $domestic), 2, '.', ',') }}</span></label>
                    </div>


                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-12">

                <div class="row {{ (!isset($domesticAddresses['notify_address_name']) || $domesticAddresses['notify_address_name'] == '') ? 'hide-data' : '' }}">
                    @php
                    $address = "";
                    if (isset($domesticAddresses['address_street']) && !empty(trim($domesticAddresses['address_street']))) {
                        $address .= $domesticAddresses['address_street'] . '<br>';
                    }
                    if (isset($domesticAddresses['address_line2']) && !empty(trim($domesticAddresses['address_line2']))) {
                        $address .= $domesticAddresses['address_line2'] . '<br>';
                    }
                    if (isset($domesticAddresses['address_city'])) {
                        $address .= $domesticAddresses['address_city'] . ', ' . $domesticAddresses['address_state'] . ' ' . $domesticAddresses['address_zip'] . '<br>';
                    }
                    @endphp
                    

            
                    <div class="col-lg-6 col-12">
                    <div class="address-dic">
                        <label class="font-weight-bold ">Domestic Address</br>
                            <span class="font-weight-normal">
                                {{ isset($domesticAddresses['address_name']) ? $domesticAddresses['address_name'] : '' }}
                                {!! $address !!}
                            </span>
                        </label>
                    </div>
                    @php
                    $address = "";
                    if (isset($domesticAddresses['notify_address_street']) && !empty(trim($domesticAddresses['notify_address_street']))) {
                        $address .= $domesticAddresses['notify_address_street'] . '<br>';
                    }
                    if (isset($domesticAddresses['notify_address_line2']) && !empty(trim($domesticAddresses['notify_address_line2']))) {
                        $address .= $domesticAddresses['notify_address_line2'] . '<br>';
                    }
                    if (isset($domesticAddresses['notify_address_city']) && !empty($domesticAddresses['notify_address_city'])) {
                        $address .= $domesticAddresses['notify_address_city'] . ', ' . $domesticAddresses['notify_address_zip'] . '<br>';
                    }
                    @endphp
                    </div>
                    <div class="col-lg-6 col-12 mt-2 mt-lg-0">
                    <div class="address-dic">
                        <label class="font-weight-bold ">BK Service Address</br>
                            <span class="font-weight-normal">
                                {{ isset($domesticAddresses['notify_address_name']) ? $domesticAddresses['notify_address_name'] : '' }}
                                {!! $address !!}
                            </span>
                        </label>
                    </div>
                </div> </div>
            </div>
        </div>
        <!-- edit -->
        <div class="row gx-3 domastic_credit_form bb-0-i insider_data dso_data_{{ $i }} {{ !empty($domestic) ? 'hide-data' : '' }}">
            <div class="col-12 text-center hide-data dso_valid_div dso_validation_msg_div_{{ $i }}">
                <p class="font-weight-bold dso_valid_msg dso_validation_msg_{{ $i }}"> </p>
            </div>

            <div class="col-12">
                <strong class="subtitle">Court Details</strong>
            </div>

            <div class="col-xl-3 col-lg-4 col-sm-5 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>The Court Order is from:</label>
                        <select onchange="getDomesticAddress(this,{{ $i }})" id="domesticstate_{{ $i }}"
                            class="form-control domestic_address_state domestic_address_state_{{ $i }} required"
                            name="domestic_tax[domestic_address_state][{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getDomesticAddressStatesSelection(Helper::validate_key_value('domestic_address_state', $domestic)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-8 col-sm-7 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of person owed the support:</label>
                        <input type="text"
                        class="input_capitalize form-control domestic_support_name domestic_support_name_{{ $i }} required"
                        name="domestic_tax[domestic_support_name][{{ $i }}]" placeholder="Name of person"
                        value="{{ Helper::validate_key_value('domestic_support_name', $domestic) }}">
                    </div>
                </div>
            </div>
            
            @php
            $item = [];
            if (!empty(Helper::validate_key_value('domestic_address_state', $domestic))) {
                $item = AddressHelper::getDomesticAddressStatesList(Helper::validate_key_value('domestic_address_state', $domestic));
                // print_r($item);
            }
            @endphp

            <div class="col-xl-5 col-lg-12 col-12">
                <div class="row {{ !isset($item['address_name']) || empty($item['address_name']) ? 'hide-data' : '' }}" id="domestic_saddress_div_{{ $i }}">
                    <div class="col-lg-6 col-sm-5 col-12 {{ isset($web_view) && $web_view ? ' domestic_div' : '' }}">
                        <div class="address-dic">
                            <div class="row  ">
                                <div class="col-12">
                                    <p class="mb-0"><u>Domestic Address</u></p>
                                </div>
                                <div class="col-12">
                                    <div class="franchise_tax_board domestic_head_text " id="domesic_head_{{ $i }}">
                                        <p>{{ isset($item['address_name']) ? $item['address_name'] : '' }}</p>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="domestic_address_{{ $i }}"
                                        class="franchise_tax_board domestic_desc_text">
                                        @php
                                        $address = "";

                                        if (isset($item['address_street']) && !empty(trim($item['address_street']))) {
                                            $address .= $item['address_street'] . '<br>';
                                        }
                                        if (isset($item['address_line2']) && !empty(trim($item['address_line2']))) {
                                            $address .= $item['address_line2'] . '<br>';
                                        }
                                        if (isset($item['address_city'])) {
                                            $address .= $item['address_city'] . ', ' . $item['address_state'] . ' ' . $item['address_zip'] . '<br>';
                                        }
                                        @endphp
                                        <p>{!! $address !!}</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6 col-sm-7 col-12 mt-2 mt-sm-0 {{ isset($web_view) && $web_view ? 'notify_domestic_div mdsoview' : '' }}" style=" {{ isset($web_view) && $web_view ? 'margin-top: 10px;' : '' }}">
                        <div class="address-dic">
                            <div class="row  ">
                                <div class="col-12">
                                    <p class="mb-0"><u>BK Service Address</u></p>
                                </div>
                                <div class="col-12">
                                    <div class="franchise_tax_board notify_domestic_head_text "
                                        id="notify_domesic_head_{{ $i }}">
                                        <p>{{ isset($item['notify_address_name']) ? $item['notify_address_name'] : '' }}
                                        </p>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div id="notify_domestic_address_{{ $i }}"
                                        class="franchise_tax_board notifiy_domestic_desc_text">
                                        @php
                                        $address = "";
                                        if (isset($item['notify_address_street']) && !empty(trim($item['notify_address_street']))) {
                                            $address .= $item['notify_address_street'] . '<br>';
                                        }
                                        if (isset($item['notify_address_line2']) && !empty(trim($item['notify_address_line2']))) {
                                            $address .= $item['notify_address_line2'] . '<br>';
                                        }
                                        if (isset($item['notify_address_city']) && !empty($item['notify_address_city'])) {
                                            $address .= $item['notify_address_city'] . ', ' . $item['notify_address_zip'] . '<br>';
                                        }
                                        @endphp
                                        <p>{!! $address !!}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12">
                <strong class="subtitle">Address Details</strong>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
            <div class="label-div">
                <div class="form-group">
                    <label>Street address of person</label>
                    <input type="text"
                        class="input_capitalize form-control domestic_support_address domestic_support_address_{{ $i }} required"
                        name="domestic_tax[domestic_support_address][{{ $i }}]"
                        placeholder="Street address of person"
                        value="{{ Helper::validate_key_value('domestic_support_address', $domestic) }}">
                </div>
            </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
            <div class="label-div">    
                <div class="form-group">
                    <label>City</label>
                    <input type="text" class="input_capitalize form-control domestic_support_city domestic_support_city_{{ $i }} required"
                        name="domestic_tax[domestic_support_city][{{ $i }}]" placeholder="City"
                        value="{{ Helper::validate_key_value('domestic_support_city', $domestic) }}">
                </div>
            </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="form-group">
                <div class="label-div">
                    <label>State</label>
                    <select class="form-control creditor_state creditor_state_{{ $i }} required"
                        name="domestic_tax[creditor_state][{{ $i }}]">
                        <option value="">Please Select State</option>
                        {!! AddressHelper::getStatesListUsingArray($stateArray, Helper::validate_key_value('creditor_state', $domestic)) !!}
                    </select>
                </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="form-group">
                <div class="label-div">
                    <label>Zip code</label>
                    <input type="text" class="form-control allow-5digit domestic_support_zipcode domestic_support_zipcode_{{ $i }} required"
                        name="domestic_tax[domestic_support_zipcode][{{ $i }}]" placeholder="Zip code"
                        value="{{ Helper::validate_key_value('domestic_support_zipcode', $domestic) }}">
                </div>
                </div>
            </div>


            <div class="col-12">
                <strong class="subtitle">Payment Details</strong>
            </div>

            <div class="col-md-4 col-xxl-3 col-sm-6 col-12">
                <div class="form-group">
                <div class="label-div">
                    <label>Current monthly payment</label>
                    <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="number" class="form-control price-field domestic_support_monthlypay required"
                            name="domestic_tax[domestic_support_monthlypay][{{ $i }}]"
                            placeholder="Current monthly payment"
                            value="{{ Helper::validate_key_value('domestic_support_monthlypay', $domestic) }}">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-xxl-3 col-sm-6 col-12">
                <div class="form-group">
                <div class="label-div">
                    <label>Past due amount</label>
                    <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">$</span>
                        <input type="number"
                            class="form-control price-field domestic_support_past_due domestic_support_past_due_{{ $i }} required"
                            name="domestic_tax[domestic_support_past_due][{{ $i }}]"
                            placeholder="Past due amount"
                            value="{{ Helper::validate_key_value('domestic_support_past_due', $domestic) }}">
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-4 col-xxl-3 col-12">
                <div class="form-group">
                <div class="label-div">
                    <label>Account Number</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control only_alphanumeric domestic_support_account domestic_support_account_{{ $i }} required"
                            name="domestic_tax[domestic_support_account][{{ $i }}]" placeholder="Account Number"
                            value="{{ Helper::validate_key_value('domestic_support_account', $domestic) }}">
                    </div>
                </div>
                </div>
            </div>


            @php
            $is_domestic_support_three_months = Helper::validate_key_value('is_domestic_support_three_months', $domestic);
            $is_domestic_support_three_months_show_hide = "hide-data";
            if ($is_domestic_support_three_months == 1) {
                $is_domestic_support_three_months_show_hide = "";
            }
            @endphp

            <div class="col-12">
                <strong class="subtitle">Payments made on the above debt in the last 90 days</strong>
            </div>

            <div class="col-12">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px">Have you made any payments on the above debt in the last 3 months?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Only list your payments if the combined total are more than $600.00">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="is_domestic_support_three_months_yes_{{ $i }}"
                            name="domestic_tax[is_domestic_support_three_months][{{ $i }}]" value="1"
                            class="d-none is_domestic_support_three_months domestic_support_months" required
                            {{ Helper::validate_key_toggle('is_domestic_support_three_months', $domestic, 1) }} />
                        <label for="is_domestic_support_three_months_yes_{{ $i }}" class="btn-toggle domestic_support_months_yes {{ Helper::validate_key_toggle_active('is_domestic_support_three_months', $domestic, 1) }}" onclick="isThreeMonthsCommon('yes','domestic_support_three_months_div_{{ $i }}')">Yes</label>

                        <input type="radio" id="is_domestic_support_three_months_no_{{ $i }}"
                            name="domestic_tax[is_domestic_support_three_months][{{ $i }}]" value="0"
                            class="d-none is_domestic_support_three_months domestic_support_months" required
                            {{ Helper::validate_key_toggle('is_domestic_support_three_months', $domestic, 0) }} />
                        <label for="is_domestic_support_three_months_no_{{ $i }}" class="btn-toggle domestic_support_months_no {{ Helper::validate_key_toggle_active('is_domestic_support_three_months', $domestic, 0) }}" onclick="isThreeMonthsCommon('no','domestic_support_three_months_div_{{ $i }}')">No</label>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row domestic_support_months_div domestic_support_three_months_div_{{ $i }} {{ $is_domestic_support_three_months_show_hide }}">

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                        <div class="label-div">
                            <label>Payment amount</label>
                            <div class="input-group mb-0">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                <input id="payment_1" data-index="{{ $i }}" data-mainarray="domestic_tax"
                                    placeholder="Payment" type="number" class="payment_1 price-field form-control required"
                                    value="{{ Helper::validate_key_value('payment_1', $domestic) }}"
                                    name="domestic_tax[payment_1][{{ $i }}]" required>
                            </div>
                            <small class="font-weight-bold font-italic">
                                Payment date: {{ $monthBeforeLast }}
                                <input type="hidden" class="payment_dates_1" name="domestic_tax[payment_dates_1][{{ $i }}]"
                                    value="{{ $monthBeforeLast }}">
                            </small>
                        </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                        <div class="label-div">
                            <label>Payment amount</label>
                            <div class="input-group mb-0">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                <input id="payment_2" data-index="{{ $i }}" data-mainarray="domestic_tax"
                                    placeholder="Payment" type="number" class="payment_2 price-field form-control required"
                                    value="{{ Helper::validate_key_value('payment_2', $domestic) }}"
                                    name="domestic_tax[payment_2][{{ $i }}]" required>
                            </div>
                            <small class="font-weight-bold font-italic">
                                Payment date: {{ $lastMonth }}
                                <input type="hidden" class="payment_dates_2" name="domestic_tax[payment_dates_2][{{ $i }}]"
                                    value="{{ $lastMonth }}">
                            </small>
                        </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                        <div class="label-div">
                            <label>Payment amount</label>
                            <div class="input-group mb-0">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                <input id="payment_3" data-index="{{ $i }}" data-mainarray="domestic_tax"
                                    placeholder="Payment" type="number" class="payment_3 price-field form-control required"
                                    value="{{ Helper::validate_key_value('payment_3', $domestic) }}"
                                    name="domestic_tax[payment_3][{{ $i }}]" required>
                            </div>
                            <small class="font-weight-bold font-italic">
                                Payment date: {{ $currentMonth }}
                                <input type="hidden" class="payment_dates_3" name="domestic_tax[payment_dates_3][{{ $i }}]"
                                    value="{{ $currentMonth }}">
                            </small>
                        </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                        <div class="label-div">
                            <label>Total Amount Paid</label>
                            <div class="input-group mb-4">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                <input id="total_amount_paid" readonly required placeholder="Monthly Payment"
                                    type="number" class="total_amount_paid price-field form-control"
                                    value="{{ Helper::validate_key_value('total_amount_paid', $domestic) }}"
                                    name="domestic_tax[total_amount_paid][{{ $i }}]">
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-10"></div>
            <div class="col-12 text-right mb-2">
                <a href="javascript:void(0)" data-saveid="{{ $i }}"
                    class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    onclick="saveDSODebt(true,this)">Save</a>
                
            </div>
        </div>
    </div>
</div>