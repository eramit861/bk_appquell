@php $inc = $i + 1; @endphp
<div class="light-gray-div additional_liens_form {{ $inc == 1 ? 'mt-2' : '' }} addionallines_{{ $inc }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div ">{{ $inc }}</div> Debt Details
        </h2>
        <button type="button" class="delete-div" title="Delete" data-saveid="{{ $inc }}"
            onclick="remove_al_debt_div({{ $inc }},this);">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <a href="javascript:void(0)" data-saveid="{{ $inc }}" class=" client-edit-button with-delete "
            onclick="display_al_debt_div(this, {{ $inc }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <!-- summary -->
        <div
            class="row gx-3 common_creditor_summary mb-3 {{ empty($additional) ? 'hide-data' : '' }} al_creditor_summary_{{ $inc }}">
            <div class="col-lg-4 col-12">
                <div class="row">
                    <div class="col-12"><strong>Secure creditor name: </strong><span
                            class="summary-name-{{ $inc }}">{{ Helper::validate_key_value('domestic_support_name', $additional) }}</span>
                    </div>
                    <div class="col-12"><strong>Secure creditor address: </strong><span
                            class="summary-address-{{ $inc }}">{{ Helper::validate_key_value('domestic_support_address', $additional) }}</span>
                    </div>
                    <div class="col-lg-5 col-md-5 col-12"><strong>City: </strong><span
                            class="summary-city-{{ $inc }}">{{ Helper::validate_key_value('domestic_support_city', $additional) }}</span>
                    </div>
                    <div class="col-lg-3 col-md-3 col-12"><strong>State: </strong><span
                            class="summary-state-{{ $inc }}">{{ Helper::validate_key_value('creditor_state', $additional) }}</span>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12"><strong>Zip: </strong><span
                            class="summary-zip-{{ $inc }}">{{ Helper::validate_key_value('domestic_support_zipcode', $additional) }}</span>
                    </div>
                    <div class="col-12"><strong>Property Description: </strong><span
                            class="summary-desc-{{ $inc }}">{{ Helper::validate_key_value('describe_secure_claim', $additional) }}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-6"><strong>Acct.#: </strong><span
                            class="summary-acc-no-{{ $inc }}">{{ Helper::validate_key_value('additional_liens_account', $additional) }}</span>
                    </div>
                    <div class="col-lg-6"><strong>Amount owned: </strong><span
                            class="summary-owed-{{ $inc }} text-danger">${{ Helper::validate_key_value('additional_liens_due', $additional) }}</span>
                    </div>
                    @php $owned_by = [1 => "You", 2 => "Spouse", 3 => "Joint", 4 => "Other"]; @endphp
                    <div class="col-lg-6"><strong>Who owes the debt: </strong><span
                            class="summary-owes-{{ $inc }}">{{ !empty($additional['owned_by']) ? $owned_by[$additional['owned_by']] : '' }}</span>
                    </div>
                    <div class="col-lg-6"><strong>Incurred date: </strong><span
                            class="summary-date-{{ $inc }}">{{ Helper::validate_key_value('additional_liens_date', $additional) }}</span>
                    </div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6"><strong>Monthly Payment: </strong><span
                            class="summary-mpayment-{{ $inc }}">${{ Helper::validate_key_value('monthly_payment', $additional) }}</span>
                    </div>
                </div>
            </div>
            @php
                $is_add_liens_three_months = Helper::validate_key_value('is_add_liens_three_months', $additional);
                $is_add_liens_three_months_show_hide = 'hide-data';
                if ($is_add_liens_three_months == 1) {
                    $is_add_liens_three_months_show_hide = '';
                }
            @endphp
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-12 {{ $is_add_liens_three_months_show_hide }}"><strong>Total Amount Paid:
                        </strong><span
                            class="summary-owed-{{ $inc }} text-danger">${{ number_format((float) Helper::validate_key_value('total_amount_paid', $additional), 2, '.', ',') }}</span>
                    </div>
                    <div class="col-12"><strong>Payments made on the above debt in the last 90 days: </strong><span
                            class="summary-acc-no-{{ $inc }}">{{ Helper::key_display('is_add_liens_three_months', $additional) }}</span>
                    </div>
                    @php
                        $payments =
                            "<span class='text-c-green'>$" .
                            number_format((float) Helper::validate_key_value('payment_1', $additional), 2, '.', ',') .
                            '</span> (' .
                            Helper::validate_key_value('payment_dates_1', $additional) .
                            ')';
                        $payments .=
                            ", <span class='text-c-green'>$" .
                            number_format((float) Helper::validate_key_value('payment_2', $additional), 2, '.', ',') .
                            '</span> (' .
                            Helper::validate_key_value('payment_dates_2', $additional) .
                            ')';
                        $payments .=
                            ", <span class='text-c-green'>$" .
                            number_format((float) Helper::validate_key_value('payment_3', $additional), 2, '.', ',') .
                            '</span> (' .
                            Helper::validate_key_value('payment_dates_3', $additional) .
                            ')';
                    @endphp
                    <div class="col-lg-12 {{ $is_add_liens_three_months_show_hide }}"><strong>Payment(s):
                        </strong><span class="summary-payments-{{ $inc }}">{!! $payments !!}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 {{ Helper::key_hide_show_ownedby('owned_by', $additional) }}">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="section-title text-c-light-blue font-weight-bold font-lg-12 ">Co-Debtor
                            Information:</span>
                    </div>
                    <div class="col-lg-12">
                        <label class="mb-0 font-weight-bold ">Codebtor Name: <span class="font-weight-normal">
                                {{ $additional['codebtor_creditor_name'] ?? '' }}
                            </span></label>
                    </div>

                    <div class="col-lg-3">
                        <label class="mb-0 font-weight-bold ">Street Address: <span class="font-weight-normal">
                                {{ $additional['codebtor_creditor_name_addresss'] ?? '' }}
                            </span></label>
                    </div>
                    <div class="col-lg-2 col-md-5 col-12">
                        <label class="mb-0 font-weight-bold ">City: <span class="font-weight-normal">
                                {{ $additional['codebtor_creditor_city'] ?? '' }}
                            </span></label>
                    </div>
                    <div class="col-lg-1 col-md-3 col-12">
                        <label class="mb-0 font-weight-bold ">State: <span class="font-weight-normal">
                                {{ $additional['codebtor_creditor_state'] ?? '' }}
                            </span></label>
                    </div>
                    <div class="col-lg-1 col-md-4 col-12">
                        <label class="mb-0 font-weight-bold ">Zip: <span class="font-weight-normal">
                                {{ $additional['codebtor_creditor_zip'] ?? '' }}
                            </span></label>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="row gx-3 mb-3 {{ !empty($additional) ? 'hide-data' : '' }} add_inside_al additional_liens_credit_form {{ 'add_liens_creditor_' . $inc }}">
            <div class="col-12 text-center hide-data al_valid_div {{ 'al_validation_msg_div_' . $i }}">
                <p class="font-weight-bold al_valid_msg {{ 'al_validation_msg_' . $i }}"> </p>
            </div>
            <div class="col-12">
                <strong class="subtitle">creditor Information</strong>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Secure creditor name</label>
                        <input type="text"
                            class="input_capitalize form-control al_domestic_support_name al_domestic_support_name_{{ $inc }} required"
                            name="additional_liens_data[domestic_support_name][{{ $i }}]"
                            placeholder="Name of person"
                            value="{{ Helper::validate_key_value('domestic_support_name', $additional) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Secure creditor address</label>
                        <input type="text"
                            class="input_capitalize form-control domestic_support_address al_domestic_support_address_{{ $inc }} required"
                            name="additional_liens_data[domestic_support_address][{{ $i }}]"
                            placeholder="Street address of person"
                            value="{{ Helper::validate_key_value('domestic_support_address', $additional) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text"
                            class="input_capitalize form-control domestic_support_city al_domestic_support_city_{{ $inc }} required"
                            name="additional_liens_data[domestic_support_city][{{ $i }}]" placeholder="City"
                            value="{{ Helper::validate_key_value('domestic_support_city', $additional) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control creditor_state al_creditor_state_{{ $inc }} required"
                            name="additional_liens_data[creditor_state][{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesListUsingArray(
                                $stateArray,
                                Helper::validate_key_value('creditor_state', $additional),
                            ) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="text"
                            class="form-control allow-5digit domestic_support_zipcode al_domestic_support_zipcode_{{ $inc }} required"
                            name="additional_liens_data[domestic_support_zipcode][{{ $i }}]"
                            placeholder="Zip code"
                            value="{{ Helper::validate_key_value('domestic_support_zipcode', $additional) }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <strong class="subtitle">Payment Details</strong>
            </div>

            <div class="col-lg-6 col-md-8 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Describe the property that secures the claim</label>
                        <div class="input-group">
                            <textarea rows='2' style="resize: none;" placeholder="Describe the property that secures the claim"
                                class="form-control describe_secure_claim required"
                                name="additional_liens_data[describe_secure_claim][{{ $i }}]">{{ Helper::validate_key_value('describe_secure_claim', $additional) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Monthly Payment</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="number"
                                class="form-control price-field monthly_payment al_monthly_payment_{{ $inc }} required"
                                name="additional_liens_data[monthly_payment][{{ $i }}]"
                                placeholder="Amount Due"
                                value="{{ Helper::validate_key_value('monthly_payment', $additional) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Amount due</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="number"
                                class="form-control price-field additional_liens_due additional_liens_due_{{ $inc }} required"
                                name="additional_liens_data[additional_liens_due][{{ $i }}]"
                                placeholder="Amount Due"
                                value="{{ Helper::validate_key_value('additional_liens_due', $additional) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Account number</label>
                        <div class="input-group">
                            <input type="text"
                                class="form-control only_alphanumeric additional_liens_account additional_liens_account_{{ $inc }} required"
                                name="additional_liens_data[additional_liens_account][{{ $i }}]"
                                placeholder="Account Number"
                                value="{{ Helper::validate_key_value('additional_liens_account', $additional) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>
                            @php $additional_liens_date_unknown = Helper::validate_key_value('additional_liens_date_unknown', $additional); @endphp
                            Date
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                title=""
                                data-bs-original-title="If your not sure of the exact date put your best guess">
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
                        <input type="text" placeholder="MM/YYYY"
                            class="form-control additional_liens_date additional_liens_date_{{ $inc }} required date_month_year_custom"
                            name="additional_liens_data[additional_liens_date][{{ $i }}]"
                            value="{{ Helper::validate_key_value('additional_liens_date', $additional) }}">
                    </div>
                </div>
            </div>

            @php
                $is_add_liens_three_months = Helper::validate_key_value('is_add_liens_three_months', $additional);
                $is_add_liens_three_months_show_hide = 'hide-data';
                if ($is_add_liens_three_months == 1) {
                    $is_add_liens_three_months_show_hide = '';
                }
            @endphp
            <div class="col-12">
                <strong class="subtitle">Payments made on the above debt in the last 90 days</strong>
            </div>
            <div class="col-12">
                <div class="form-group label-div question-area">
                    <label class="mb-0">Have you made any payments on the above debt in the last 3
                        months?</label><br>
                    <label class=" text-c-blue text-decoration-underline">Only list your payments if the combined total
                        are more than $600.00</label><br>
                    <div class=" radio-primary custom-radio-group ">
                        <input type="radio" id="is_add_liens_three_months_yes_{{ $i }}"
                            name="additional_liens_data[is_add_liens_three_months][{{ $i }}]"
                            value="1" class="required d-none is_add_liens_three_months add_liens_three_months"
                            required {{ Helper::validate_key_toggle('is_add_liens_three_months', $additional, 1) }} />
                        <label for="is_add_liens_three_months_yes_{{ $i }}"
                            class="cr btn-toggle {{ Helper::validate_key_toggle_active('is_add_liens_three_months', $additional, 1) }}"
                            onclick="isThreeMonthAddLiens('yes',{{ $i }})">Yes</label>

                        <input type="radio" id="is_add_liens_three_months_no_{{ $i }}"
                            name="additional_liens_data[is_add_liens_three_months][{{ $i }}]"
                            value="0" class="required d-none is_add_liens_three_months add_liens_three_months"
                            required {{ Helper::validate_key_toggle('is_add_liens_three_months', $additional, 0) }} />
                        <label for="is_add_liens_three_months_no_{{ $i }}"
                            class="cr btn-toggle {{ Helper::validate_key_toggle_active('is_add_liens_three_months', $additional, 0) }}"
                            onclick="isThreeMonthAddLiens('no',{{ $i }})">No</label>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div
                    class="row add_liens_three_months_div add_liens_three_months_div_{{ $i }} {{ $is_add_liens_three_months_show_hide }}">
                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Payment amount</label>
                                <div class="input-group mb-0">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input id="payment_1" data-index="{{ $i }}"
                                        data-mainarray="additional_liens_data" placeholder="Payment" type="number"
                                        class="payment_1 price-field form-control required"
                                        value="{{ Helper::validate_key_value('payment_1', $additional) }}"
                                        name="additional_liens_data[payment_1][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $monthBeforeLast }}
                                    <input type="hidden" class="payment_dates_1"
                                        name="additional_liens_data[payment_dates_1][{{ $i }}]"
                                        value="{{ $monthBeforeLast }}">
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Payment amount</label>
                                <div class="input-group mb-0">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input id="payment_2" data-index="{{ $i }}"
                                        data-mainarray="additional_liens_data" placeholder="Payment" type="number"
                                        class="payment_2 price-field form-control required"
                                        value="{{ Helper::validate_key_value('payment_2', $additional) }}"
                                        name="additional_liens_data[payment_2][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $lastMonth }}
                                    <input type="hidden" class="payment_dates_2"
                                        name="additional_liens_data[payment_dates_2][{{ $i }}]"
                                        value="{{ $lastMonth }}">
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Payment amount</label>
                                <div class="input-group mb-0">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input id="payment_3" data-index="{{ $i }}"
                                        data-mainarray="additional_liens_data" placeholder="Payment" type="number"
                                        class="payment_3 price-field form-control required"
                                        value="{{ Helper::validate_key_value('payment_3', $additional) }}"
                                        name="additional_liens_data[payment_3][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $currentMonth }}
                                    <input type="hidden" class="payment_dates_3"
                                        name="additional_liens_data[payment_dates_3][{{ $i }}]"
                                        value="{{ $currentMonth }}">
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Total Amount Paid</label>
                                <div class="input-group mb-4">
                                    <span class="input-group-text" id="basic-addon1">$</span>
                                    <input id="total_amount_paid" readonly placeholder="Monthly Payment"
                                        type="number" class="total_amount_paid price-field form-control"
                                        value="{{ Helper::validate_key_value('total_amount_paid', $additional) }}"
                                        name="additional_liens_data[total_amount_paid][{{ $i }}]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <strong class="subtitle">Debt Owner Information</strong>
            </div>

            <div class="col-12 debt_tax_own_by">
                <div class="form-group label-div question-area">
                    <label class="d-block">Who owes the debt?</label>
                    <div class=" radio-primary custom-radio-group d-flex multi-input-radio-group btn-small">
                        <input type="radio" id="additionalliens_owned_by_you_{{ $i }}"
                            class="additionalliens_owned_by d-none "
                            name="additional_liens_data[owned_by][{{ $i }}]" required value="1"
                            {{ Helper::validate_key_toggle('owned_by', $additional, 1) }}>
                        <label onclick="common_toggle_own_by(1,this)"
                            id="additionalliens_owned_by_you_{{ $i }}"
                            for="additionalliens_owned_by_you_{{ $i }}"
                            class="cr btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $additional, 1) }}">
                            Self</label>

                        <input type="radio" id="additionalliens_owned_by_spouse_{{ $i }}"
                            class="additionalliens_owned_by d-none"
                            name="additional_liens_data[owned_by][{{ $i }}]" required value="2"
                            {{ Helper::validate_key_toggle('owned_by', $additional, 2) }}>
                        <label onclick="common_toggle_own_by(2,this)"
                            id="additionalliens_owned_by_spouse_{{ $i }}"
                            for="additionalliens_owned_by_spouse_{{ $i }}"
                            class="cr btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $additional, 2) }}">
                            Spouse</label>

                        <input type="radio" id="additionalliens_owned_by_joint_{{ $i }}"
                            class="additionalliens_owned_by d-none"
                            name="additional_liens_data[owned_by][{{ $i }}]" required value="3"
                            {{ Helper::validate_key_toggle('owned_by', $additional, 3) }}>
                        <label onclick="common_toggle_own_by(3,this)"
                            id="additionalliens_owned_by_joint_{{ $i }}"
                            for="additionalliens_owned_by_joint_{{ $i }}"
                            class="cr btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $additional, 3) }}">
                            Joint</label>

                        <input type="radio" id="additionalliens_owned_by_other_{{ $i }}"
                            class="additionalliens_owned_by d-none"
                            name="additional_liens_data[owned_by][{{ $i }}]" required value="4"
                            {{ Helper::validate_key_toggle('owned_by', $additional, 4) }}>
                        <label onclick="common_toggle_own_by(4,this)"
                            id="additionalliens_owned_by_other_{{ $i }}"
                            for="additionalliens_owned_by_other_{{ $i }}"
                            class="cr btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $additional, 4) }}">
                            Other</label>
                    </div>
                </div>
            </div>
            <!-- Condition data -->
            <div class="col-12 {{ Helper::key_hide_show_ownedby('owned_by', $additional) }} debt_tax_codebtor_cosigner_data"
                id="debt_tax_codebtor_cosigner_data">
                <div class="col-12">
                    <div class="row codebtor-tab">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Codebtor name
                                        <!--<i class="text-c-blue"> (upload your most recent auto loan statement into the document system):</i>--></label>
                                    <input type="text"
                                        class="input_capitalize cod_name form-control debt_tax_codebtor_creditor_name required"
                                        name="additional_liens_data[codebtor_creditor_name][{{ $i }}]"
                                        placeholder="Codebtor Name"
                                        value="{{ Helper::validate_key_value('codebtor_creditor_name', $additional) }}">
                                    @if (isset($appservice_codebtors) && !empty($appservice_codebtors))
                                        <select class="cod_opt form-control col-12 col-md-6"
                                            onchange="alreadySavedCodebtor(this)">
                                            <option class="form-control" value="">Choose Already Saved Codebtor
                                            </option>
                                            @foreach ($appservice_codebtors as $codebtor)
                                                <option data-cname="{{ $codebtor['codebtor_creditor_name'] }}"
                                                    data-address="{{ $codebtor['codebtor_creditor_name_addresss'] }}"
                                                    data-city="{{ $codebtor['codebtor_creditor_city'] }}"
                                                    data-state="{{ $codebtor['codebtor_creditor_state'] }}"
                                                    data-zip="{{ $codebtor['codebtor_creditor_zip'] }}">
                                                    {{ $codebtor['codebtor_creditor_name'] }},
                                                    {{ $codebtor['codebtor_creditor_name_addresss'] }},
                                                    {{ $codebtor['codebtor_creditor_city'] }},
                                                    {{ $codebtor['codebtor_creditor_state'] }},
                                                    {{ $codebtor['codebtor_creditor_zip'] }}</option>
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
                                    <input type="text"
                                        class="input_capitalize cod_address form-control debt_tax_codebtor_creditor_name_addresss required"
                                        name="additional_liens_data[codebtor_creditor_name_addresss][{{ $i }}]"
                                        placeholder="Street Address"
                                        value="{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $additional) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text"
                                        class="input_capitalize cod_city form-control debt_tax_codebtor_creditor_city required"
                                        name="additional_liens_data[codebtor_creditor_city][{{ $i }}]"
                                        placeholder="City"
                                        value="{{ Helper::validate_key_value('codebtor_creditor_city', $additional) }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control cod_state debt_tax_codebtor_creditor_state required"
                                        name="additional_liens_data[codebtor_creditor_state][{{ $i }}]">
                                        <option value="">Please Select State</option>
                                        {!! AddressHelper::getStatesList(Helper::validate_key_value('codebtor_creditor_state', $additional)) !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Zip code</label>
                                    <input type="number"
                                        class="form-control cod_zip allow-5digit debt_tax_codebtor_creditor_zip required"
                                        name="additional_liens_data[codebtor_creditor_zip][{{ $i }}]"
                                        placeholder="Zip"
                                        value="{{ Helper::validate_key_value('codebtor_creditor_zip', $additional) }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 mb-2"></div>
            <div class="col-12 text-right mb-2">
                <a href="javascript:void(0)" data-saveid="{{ $inc }}"
                    class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    onclick="alSaveTheseDebts(true,this)">Save</a>
            </div>
        </div>
    </div>
</div>
