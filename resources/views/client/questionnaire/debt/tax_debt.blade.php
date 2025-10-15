@php
$tax_whats_year = Helper::validate_key_value('tax_whats_year', $backdebts);
$selectedYearsArray = explode(" ", $tax_whats_year);
$securityNumberLastFour = '';
if (!empty($basic_info) && !empty($basic_info['BasicInfoPartA']) && !empty($basic_info['BasicInfoPartA']->security_number)) {
    $securityNumberLastFour = substr($basic_info['BasicInfoPartA']->security_number, -4);
}
$statecode = Helper::validate_key_value('debt_state', $backdebts);
$item = AddressHelper::getStateTaxAddressUsingArray($arrayDebtStateTaxes, $statecode);
$stateaddress = '';
if (!empty($item) && isset($item['address_heading'])) {
    $stateaddress = $item['address_heading'] . '<br>';
    $stateaddress .= !empty($item['add1']) ? $item['add1'] . '<br>' : $stateaddress;
    //  $stateaddress = !empty($item['add2']) ? $stateaddress.', '.$item['add2'] : $stateaddress;
    $stateaddress = !empty($item['city']) ? $stateaddress . ' ' . $item['city'] : $stateaddress;
    $stateaddress = !empty($statecode) ? $stateaddress . ', ' . $statecode : $stateaddress;
    $stateaddress = !empty($item['zip']) ? $stateaddress . ' ' . $item['zip'] : $stateaddress;
}
@endphp
<div class="light-gray-div tax_debt_form {{ ($taxNo == 1) ? 'mt-2' : '' }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $taxNo }}</div> State taxes owed to
        </h2>
        <button type="button" class="delete-div" title="Delete" data-saveid="{{ $i }}" onclick="removeBackTaxDebt('{{ route('back_tax_custom_save') }}',this);">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <a href="javascript:void(0)" data-saveid="{{ $i }}" class=" client-edit-button with-delete " onclick="display_bt_debt_div(this, {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <div class="row gx-3 common_creditor_summary @if(empty($backdebts)) hide-data @endif back_tax_summary_{{ $i }}">
            <div class="col-12">
                <div class="row">
                    <div class="col-md-8  col-12 no_dup_col">
                        <div class="row">
                            <div class="col-lg-4 col-12 no_dup_col">
                                <label class="font-weight-bold ">Tax years owed:
                                    <span class="font-weight-normal">{{ DateTimeHelper::convertYearsToEndOfYear(Helper::validate_key_value('tax_whats_year', $backdebts)) }}</span>
                                </label>
                            </div>

                            <div class="col-lg-4 col-12 no_dup_col">
                                <div class="row">
                                    <div class="col-12">
                                        @php $owned_by = [1 => "You", 2 => "Spouse", 3 => "Joint", 4 => "Other"]; @endphp
                                        <label class="font-weight-bold ">Who owes the debt:
                                            <span class="font-weight-normal">{{ (!empty($backdebts['owned_by'])) ? $owned_by[$backdebts['owned_by']] : "" }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <label class="font-weight-bold ">Total Amount Owed:<span class="font-weight-normal text-danger">
                                        ${{ number_format((float)Helper::validate_key_value('tax_total_due', $backdebts), 2, '.', ',') }}</span></label>
                            </div>
                        </div>

                        <div class="row {{ Helper::key_hide_show_ownedby('owned_by', $backdebts) }}">
                            <div class="col-12">
                                <span class="section-title font-weight-bold font-lg-12 text-lightblue ">Co-Debtor
                                    Information:</span>
                            </div>
                            <div class="col-12">
                                <label class="font-weight-bold ">Codebtor Name: <span class="font-weight-normal">
                                        {{ Helper::validate_key_value('codebtor_creditor_name', $backdebts) }}
                                    </span></label>
                            </div>
                            <div class="col-5">
                                <label class="font-weight-bold">Street Address: <span class="font-weight-normal">
                                        {{ Helper::validate_key_value('codebtor_creditor_name_addresss', $backdebts) }}
                                    </span></label>
                            </div>
                            <div class="col-3">
                                <label class="font-weight-bold">City: <span class="font-weight-normal">
                                        {{ Helper::validate_key_value('codebtor_creditor_city', $backdebts) }}
                                    </span></label>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold">State: <span class="font-weight-normal">
                                        {{ Helper::validate_key_value('codebtor_creditor_state', $backdebts) }}
                                    </span></label>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold">Zip: <span class="font-weight-normal">
                                        {{ Helper::validate_key_value('codebtor_creditor_zip', $backdebts) }}
                                    </span></label>
                            </div>
                        </div>
                        <div class="row">
                            @php
                            $is_three_months = Helper::validate_key_value('is_back_tax_state_three_months', $backdebts);

$is_three_months_show_hide = "hide-data";
if ($is_three_months == 1) {
    $is_three_months_show_hide = "";
}
$payment_dates_1 = Helper::validate_key_value('payment_dates_1', $backdebts);
$payment_dates_2 = Helper::validate_key_value('payment_dates_2', $backdebts);
$payment_dates_3 = Helper::validate_key_value('payment_dates_3', $backdebts);
$payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
$payment_dates .= !empty($payment_dates_2) ? ', ' . $payment_dates_2 : '';
$payment_dates .= !empty($payment_dates_3) ? ', ' . $payment_dates_3 : '';
@endphp
                            <div class="col-12">
                                <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                    <span
                                        class="font-weight-normal">{{ Helper::key_display('is_back_tax_state_three_months', $backdebts) }}</span></label>
                            </div>
                            <div class="col-8 {{ $is_three_months_show_hide . ' ' }}">
                                @php
    $payments = "<span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_1', $backdebts), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_1', $backdebts) . ")";
$payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_2', $backdebts), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_2', $backdebts) . ")";
$payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_3', $backdebts), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_3', $backdebts) . ")";
@endphp
                                <label class="font-weight-bold ">Payment(s):
                                    <span class="font-weight-normal">{!! $payments !!}</span></label>
                            </div>
                            <div class="col-4 {{ $is_three_months_show_hide }}">
                                <label class="font-weight-bold">Total Amount Paid:
                                    <span
                                        class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $backdebts), 2, '.', ',') }}</span></label>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-4 col-12 no_dup_col">
                        <label class="font-weight-bold ">Creditor Address</br>
                            <span class="font-weight-normal">
                                {!! $stateaddress !!}
                            </span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gx-3 back_taxes_credit_form insider_data b-0-i back_tax_data_{{ $i }} @if(!empty($backdebts)) hide-data @endif">
            <div class="col-12 validate_div text-center hide-data {{ 'validation_msg_div_' . $i }}">
                <p class="font-weight-bold validate_msg {{ 'validation_msg_' . $i }}"></p>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Select state: </label>
                        <select class="form-control debt_state debt_state_{{$i}} required" onchange="getAddress(this,{{ $i }})" id="state_{{ $i }}" name="back_tax_own[debt_state][{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesListUsingArray($stateArray, Helper::validate_key_value('debt_state', $backdebts)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-8 col-md-8 col-sm-6 col-12">
                <div class="label-div">
                    <label class="mb-2">For what year or years</label>
                    <div class="form-group d-flex align-items-center">

                        <div class="dropdown me-2">
                            <button class="year-btn form-control dropdown-toggle" type="button" data-bs-auto-close="outside" data-bs-toggle="dropdown">
                                <span class="dropdown-text">Select Years</span>
                                <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu py-2" style="min-width: 150px;">
                                <li>
                                    <label class="justone-label">
                                        <input type="checkbox" class="selectall" data-inputname="back_tax_own[tax_whats_year][{{ $i }}]" data-inputfor="state_tax_{{ $i }}" onchange="setSelectAll(this)" />
                                        <span class="select-text"> Select</span> All
                                    </label>
                                </li>
                                <li class="divider"></li>
                                @foreach ($last15Years as $index => $year)
                                    <li class="justone-li">
                                        <label class="justone-label" for="{{ 'state_tax_for_' . $year . '_' . $i }}">
                                            <input type="checkbox" class="option justone state_tax_{{ $i }}" data-inputname="back_tax_own[tax_whats_year][{{ $i }}]" data-inputfor="state_tax_{{ $i }}" id="{{ 'state_tax_for_' . $year . '_' . $i }}" value='{{ $year }}'
                                                @if(in_array($year, $selectedYearsArray)) checked @endif onchange="setJustOne(this)" />
                                            {{ $year }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="w-100">
                            <input type="text" class="form-control tax_whats_year tax_whats_year_{{$i}} required" readonly name="back_tax_own[tax_whats_year][{{ $i }}]" placeholder="Whats Year" value="{{ $tax_whats_year }}">
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="label-div">           
                    <div class="form-group">
                        <label>How much total due:</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field tax_total_due tax_total_due_{{$i}} required" name="back_tax_own[tax_total_due][{{ $i }}]" placeholder="Total Due" value="{{ Helper::validate_key_value('tax_total_due', $backdebts) }}">
                        </div>
                    </div>
                </div>
            </div>
            @php
            $item = [];
if (!empty(Helper::validate_key_value('debt_state', $backdebts))) {
    $item = AddressHelper::getStateTaxAddressUsingArray($arrayDebtStateTaxes, Helper::validate_key_value('debt_state', $backdebts));
}
@endphp
            <div class="col-xl-3 col-lg-8 col-md-8 col-sm-6 col-12">
                <div class="tax_debt_div address-dic float_right @if(!isset($item['address_heading']) || empty($item['address_heading'])) hide-data @endif" id="tax_address_div_{{ $i }}">

                    <div class="franchise_tax_board head_text" id="head_{{ $i }}">
                        <p>{{ isset($item['address_heading']) ? $item['address_heading'] : '' }}</p>
                    </div>
                    <div id="address_{{ $i }}" class="franchise_tax_board desc_text">

                        @php $address = "";
if (isset($item['add1']) && !empty(trim($item['add1']))) {
    $address .= $item['add1'] . '<br>';
}
if (isset($item['add2']) && !empty(trim($item['add2']))) {
    $address .= $item['add2'] . '<br>';
}
if (isset($item['add3']) && !empty(trim($item['add3']))) {
    $address .= $item['add3'] . '<br>';
}
if (isset($item['city'])) {
    $address .= $item['city'] . ', ' . $item['code'] . ' ' . $item['zip'];
}
@endphp
                        <p>{!! $address !!}</p>
                    </div>

                </div>
            </div>

            <div class="col-12 debt_tax_own_by">
                <strong class="subtitle">Debt Owner Information</strong>
            </div>

            <div class="col-12 debt_tax_own_by">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px"> Who owes the debt?</label>
                    <div class="custom-radio-group form-group multi-input-radio-group btn-small">
                        <input required type="radio" id="pasttax_owned_by_you_{{ $i }}"
                            class="pasttax_owned_by d-none" name="back_tax_own[owned_by][{{ $i }}]" value="1"
                            {{ Helper::validate_key_toggle('owned_by', $backdebts, 1) }}>
                        <label for="pasttax_owned_by_you_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $backdebts, 1) }}" onclick="common_toggle_own_by(1,this)"> Self</label>

                        <input required type="radio" id="pasttax_owned_by_spouse_{{ $i }}"
                            class="pasttax_owned_by d-none" name="back_tax_own[owned_by][{{ $i }}]" required value="2"
                            {{ Helper::validate_key_toggle('owned_by', $backdebts, 2) }}>
                        <label for="pasttax_owned_by_spouse_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $backdebts, 2) }}" onclick="common_toggle_own_by(2,this)"> Spouse</label>

                        <input required type="radio" id="pasttax_owned_by_joint_{{ $i }}"
                            class="pasttax_owned_by d-none" name="back_tax_own[owned_by][{{ $i }}]" required value="3"
                            {{ Helper::validate_key_toggle('owned_by', $backdebts, 3) }}>
                        <label for="pasttax_owned_by_joint_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $backdebts, 3) }}" onclick="common_toggle_own_by(3,this)"> Joint</label>

                        <input type="radio" id="pasttax_owned_by_other_{{ $i }}"
                            class="pasttax_owned_by d-none" name="back_tax_own[owned_by][{{ $i }}]" required value="4"
                            {{ Helper::validate_key_toggle('owned_by', $backdebts, 4) }}>
                        <label for="pasttax_owned_by_other_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $backdebts, 4) }}" onclick="common_toggle_own_by(4,this)"> Other</label>
                    </div>
                </div>
            </div>


            <!-- Condition data -->
            <div class="col-12 {{ Helper::key_hide_show_ownedby('owned_by', $backdebts) }}  debt_tax_codebtor_cosigner_data" id="debt_tax_codebtor_cosigner_data">
                <div class="row codebtor-tab">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="label-div"> 
                            <div class="form-group">
                                <label>Codebtor name</label>
                                <input type="text" class="input_capitalize cod_name form-control debt_tax_codebtor_creditor_name required" name="back_tax_own[codebtor_creditor_name][{{ $i }}]" placeholder="Codebtor Name" value="{{ Helper::validate_key_value('codebtor_creditor_name', $backdebts) }}">
                                @if (isset($appservice_codebtors) && !empty($appservice_codebtors))
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
                                <input type="text" class="input_capitalize cod_address form-control debt_tax_codebtor_creditor_name_addresss required" name="back_tax_own[codebtor_creditor_name_addresss][{{ $i }}]" placeholder="Street Address" value="{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $backdebts) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div"> 
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="input_capitalize cod_city form-control debt_tax_codebtor_creditor_city required" name="back_tax_own[codebtor_creditor_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_value('codebtor_creditor_city', $backdebts) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div"> 
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control cod_state debt_tax_codebtor_creditor_state required" name="back_tax_own[codebtor_creditor_state][{{ $i }}]">
                                    <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesListUsingArray($stateArray, Helper::validate_key_value('codebtor_creditor_state', $backdebts)) !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div"> 
                            <div class="form-group">
                                <label>Zip code</label>
                                <input type="number" class="form-control cod_zip allow-5digit debt_tax_codebtor_creditor_zip required" name="back_tax_own[codebtor_creditor_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_value('codebtor_creditor_zip', $backdebts) }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Condition data End-->

            @php
            $is_back_tax_state_three_months = Helper::validate_key_value('is_back_tax_state_three_months', $backdebts);
$is_back_tax_state_three_months_show_hide = "hide-data";
if ($is_back_tax_state_three_months == 1) {
    $is_back_tax_state_three_months_show_hide = "";
}
@endphp

            <div class="col-12">
                <strong class="subtitle">Payments made on the above debt in the last 90 days</strong>
            </div>

            <div class="col-12">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px">Have you made any payments on the above debt in the last 3 months?</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="is_back_tax_state_three_months_yes_{{ $i }}"
                            name="back_tax_own[is_back_tax_state_three_months][{{ $i }}]" value="1"
                            class="required d-none is_back_tax_state_three_months back_tax_state_months" required
                            {{ Helper::validate_key_toggle('is_back_tax_state_three_months', $backdebts, 1) }} />
                        <label for="is_back_tax_state_three_months_yes_{{ $i }}" class="btn-toggle debt_months_label_yes {{ Helper::validate_key_toggle_active('is_back_tax_state_three_months', $backdebts, 1) }}" onclick="isThreeMonthsCommon('yes','back_tax_state_three_months_div_{{ $i }}')">Yes</label>
                        
                        <input type="radio" id="is_back_tax_state_three_months_no_{{ $i }}"
                            name="back_tax_own[is_back_tax_state_three_months][{{ $i }}]" value="0"
                            class="required d-none is_back_tax_state_three_months back_tax_state_months" required
                            {{ Helper::validate_key_toggle('is_back_tax_state_three_months', $backdebts, 0) }} />
                        <label for="is_back_tax_state_three_months_no_{{ $i }}" class="btn-toggle debt_months_label_no {{ Helper::validate_key_toggle_active('is_back_tax_state_three_months', $backdebts, 0) }}" onclick="isThreeMonthsCommon('no','back_tax_state_three_months_div_{{ $i }}')">No</label>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="row back_tax_state_months_div back_tax_state_three_months_div_{{ $i }} {{ $is_back_tax_state_three_months_show_hide }}">

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="label-div"> 
                            <div class="form-group">
                                <label>Payment amount</label>
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input id="payment_1" data-index="{{ $i }}" data-mainarray="back_tax_own" placeholder="Payment" type="number" class="payment_1 price-field form-control required" value="{{ Helper::validate_key_value('payment_1', $backdebts) }}" name="back_tax_own[payment_1][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $monthBeforeLast }}
                                    <input type="hidden" class="payment_dates_1" name="back_tax_own[payment_dates_1][{{ $i }}]" value="{{ $monthBeforeLast }}">
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
                                    <input id="payment_2" data-index="{{ $i }}" data-mainarray="back_tax_own" placeholder="Payment" type="number" class="payment_2 price-field form-control required" value="{{ Helper::validate_key_value('payment_2', $backdebts) }}" name="back_tax_own[payment_2][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $lastMonth }}
                                    <input type="hidden" class="payment_dates_2" name="back_tax_own[payment_dates_2][{{ $i }}]" value="{{ $lastMonth }}">
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
                                    <input id="payment_3" data-index="{{ $i }}" data-mainarray="back_tax_own" placeholder="Payment" type="number" class="payment_3 price-field form-control required" value="{{ Helper::validate_key_value('payment_3', $backdebts) }}" name="back_tax_own[payment_3][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $currentMonth }}
                                    <input type="hidden" class="payment_dates_3" name="back_tax_own[payment_dates_3][{{ $i }}]" value="{{ $currentMonth }}">
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                        <div class="label-div"> 
                            <div class="form-group">
                                <label>Total amount of your payments</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text">$</span>
                                    <input id="total_amount_paid" readonly required placeholder="Total Amount" type="number" class="total_amount_paid price-field form-control" value="{{ Helper::validate_key_value('total_amount_paid', $backdebts) }}" name="back_tax_own[total_amount_paid][{{ $i }}]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 text-right mb-2 pb-2">
                <a href="javascript:void(0)" data-saveid="{{ $i }}"
                    class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    onclick="saveBackTaxDebt(true,this)">Save</a>
            </div>
        </div>
    </div>
</div>