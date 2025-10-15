@php
$original_creditor = $debt['original_creditor'] ?? '';
$not_original_creditor = 'd-none';
if ($original_creditor == 0) {
    $not_original_creditor = '';
}
$inc = $i + 1;
$debtType = '';

if (!empty(Helper::validate_key_value('cards_collections', $debt))) {
    $type = Helper::validate_key_value('cards_collections', $debt);

    $debtType = $cardTypes[$type] ?? '';
}

$classGreenText = 'd-none';
$collectionAgent = 'd-none';
if ($original_creditor == 0) {
    $collectionAgent = '';
}
if ($original_creditor == 1) {
    $classGreenText = '';
}
@endphp

<div class="light-gray-div debt_creditor_form {{ $inc == 1 ? 'mt-2' : '' }} {{ empty($debt) ? ' unsaved_debtor' : ' ' }} debt_creditor_{{ $inc }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $inc }}</div> Debt Details
        </h2>
        <button type="button" class="delete-div" title="Delete" data-saveid="{{ $inc }}"
            onclick="remove_debt_div({{ $inc }},this);">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <a href="javascript:void(0)" data-saveid="{{ $inc }}" class=" client-edit-button with-delete "
            onclick="display_debt_div(this, {{ $inc }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <!-- summary section -->
        <div
            class="row gx-3 unsecured_credit_summary credit_summ mb-3 {{ empty($debtType) ? 'hide-data' : '' }} creditor_summary_{{ $inc }}">
            <div class="col-lg-6 col-12">
                <div class="row">
                    <div class="col-12">
                        <strong>Debt type: </strong>
                        <span class="summary-type-{{ $inc }}">{{ $debtType }}</span>
                    </div>
                    <div class="col-12">
                        <span
                            class="summary-agent-origional-{{ $inc }} {{ $classGreenText }} text-bold text-success">Original
                            Creditor:</span>
                        <span
                            class="summary-agent-collection-{{ $inc }} section-title font-weight-bold font-lg-12 text-danger {{ $collectionAgent }}">Collection
                            Agent:</span>
                        <span
                            class="summary-name-{{ $inc }} text-bold text-c-blue">{{ Helper::validate_key_value('creditor_name', $debt) }}</span>
                    </div>
                    <div class="col-12">
                        <strong>Street Address: <span class="font-weight-normal summary-street-{{ $inc }}">
                                {{ Helper::validate_key_value('creditor_information', $debt) }}
                            </span></strong>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <strong>City: <span class="font-weight-normal summary-city-{{ $inc }}">
                                {{ Helper::validate_key_value('creditor_city', $debt) }}
                            </span></strong>
                    </div>
                    <div class="col-md-4 col-sm-3 col-12">
                        <strong>State: <span class="font-weight-normal summary-state-{{ $inc }}">
                                {{ Helper::validate_key_value('creditor_state', $debt) }}
                            </span></strong>
                    </div>
                    <div class="col-md-4 col-sm-3 col-12">
                        <strong>Zip: <span class="font-weight-normal summary-zip-{{ $inc }}">
                                {{ Helper::validate_key_value('creditor_zip', $debt) }}
                            </span></strong>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12"><strong>Acct.# (Last 4 digits): </strong><span
                            class="summary-accno-{{ $inc }}">{{ Helper::validate_key_value('amount_number', $debt) }}</span>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12"><strong>Incurred date: </strong><span
                            class="summary-date-{{ $inc }}">{{ Helper::validate_key_value('debt_date', $debt) }}</span>
                    </div>
                    <div class="col-md-4 col-12"><strong>Amount owned: </strong><span
                            class="summary-owed-{{ $inc }} text-danger">
                            ${{ number_format((float) Helper::validate_key_value('amount_owned', $debt), 2, '.', ',') }}</span>
                    </div>

                    <div class="col-12 collectionAgentDiv{{ $inc }} {{ $collectionAgent }} ">
                        <div class="row">
                            <div class="col-12">
                                <strong>
                                    <span class="section-title font-weight-bold font-lg-12 text-success">Original
                                        Creditor:</span>
                                    <span class="text-bold text-c-blue summary-2nd-name-{{ $inc }}">
                                        {{ Helper::validate_key_value('second_creditor_name', $debt) }}
                                    </span>
                                </strong>
                            </div>
                            <div class="col-12">
                                <strong>Street Address: <span
                                        class="font-weight-normal summary-2nd-address-{{ $inc }}">
                                        {{ Helper::validate_key_value('second_creditor_information', $debt) }}
                                    </span></strong>
                            </div>
                            <div class="col-md-4 col-sm-6 col-12">
                                <strong>City:
                                    <span class="font-weight-normal summary-2nd-city-{{ $inc }}">
                                        {{ Helper::validate_key_value('second_creditor_city', $debt) }}
                                    </span>
                                </strong>
                            </div>
                            <div class="col-md-4 col-sm-3 col-12">
                                <strong>State:
                                    <span class="font-weight-normal summary-2nd-state-{{ $inc }}">
                                        {{ Helper::validate_key_value('second_creditor_state', $debt) }}
                                    </span>
                                </strong>
                            </div>
                            <div class="col-md-4 col-sm-3 col-12">
                                <strong>Zip:
                                    <span class="font-weight-normal summary-2nd-zip-{{ $inc }}">
                                        {{ Helper::validate_key_value('second_creditor_zip', $debt) }}
                                    </span>
                                </strong>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        @php
                        $is_three_months = Helper::validate_key_value('is_debt_three_months', $debt);
                        @endphp
                        @if(isset($tax_irs) && !empty($tax_irs))
                            @php
                            $is_three_months_show_hide = "hide-data";
                            if ($is_three_months == 1) {
                                $is_three_months_show_hide = "";
                            }
                            $payment_dates_1 = Helper::validate_key_value('payment_dates_1', $debt);
                            $payment_dates_2 = Helper::validate_key_value('payment_dates_2', $debt);
                            $payment_dates_3 = Helper::validate_key_value('payment_dates_3', $debt);
                            $payment_dates = !empty($payment_dates_1) ? $payment_dates_1 : '';
                            $payment_dates .= !empty($payment_dates_2) ? ', ' . $payment_dates_2 : '';
                            $payment_dates .= !empty($payment_dates_3) ? ', ' . $payment_dates_3 : '';
                            @endphp
                            <div class="row">
                                <div class="col-12">
                                    <label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
                                        <span class="font-weight-normal">{{ Helper::key_display('is_debt_three_months', $debt) }}</span></label>
                                </div>
                                <div class="col-md-8 col-12 {{ $is_three_months_show_hide }} ">
                                    @php
                                    $payments = "<span class='text-c-green'>$" . number_format((float) Helper::validate_key_value('payment_1', $debt), 2, '.', ',') . '</span> (' . Helper::validate_key_value('payment_dates_1', $debt) . ')';
                                    $payments .= ", <span class='text-c-green'>$" . number_format((float) Helper::validate_key_value('payment_2', $debt), 2, '.', ',') . '</span> (' . Helper::validate_key_value('payment_dates_2', $debt) . ')';
                                    $payments .= ", <span class='text-c-green'>$" . number_format((float) Helper::validate_key_value('payment_3', $debt), 2, '.', ',') . '</span> (' . Helper::validate_key_value('payment_dates_3', $debt) . ')';
                                    @endphp
                                    <label class="font-weight-bold ">Payment(s):
                                        <span class="font-weight-normal">{!! $payments !!}</span></label>
                                </div>
                                <div class="col-12 col-md-4 {{ $is_three_months_show_hide }}">
                                    <label class="font-weight-bold">Total Amount Paid:
                                        <span class="font-weight-normal text-c-green">${{ number_format((float) Helper::validate_key_value('total_amount_paid', $debt), 2, '.', ',') }}</span></label>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-12">
                <div class="row {{ Helper::key_hide_show_ownedby('owned_by', $debt) }}">
                    <div class="col-12">
                        <strong><span class="section-title font-weight-bold font-lg-12 text-lightblue">Co-Debtor
                                Name:</span> </strong>
                        <span class="text-bold text-c-blue">{{ Helper::validate_key_value('codebtor_creditor_name', $debt) }}</span>
                    </div>
                    <div class="col-12">
                        <strong>Address: </strong>
                        <span>{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $debt) }}</span>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <strong>City: </strong>
                        <span>{{ Helper::validate_key_value('codebtor_creditor_city', $debt) }}</span>
                    </div>
                    <div class="col-md-4 col-sm-3 col-12">
                        <strong>State: </strong>
                        <span>{{ Helper::validate_key_value('codebtor_creditor_state', $debt) }}</span>
                    </div>
                    <div class="col-md-4 col-sm-3 col-12">
                        <strong>Zip: </strong>
                        <span>{{ Helper::validate_key_value('codebtor_creditor_zip', $debt) }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- edit section -->
        <div
            class="row gx-3 unsecured_credit_form insider_data b-0-i {{ !empty($debtType) ? 'hide-data' : '' }} debt_creditor_sub_{{ $inc }}">
            <div class="col-12 validate_div text-center hide-data validation_msg_div_{{ $i }}">
                <p class="font-weight-bold validate_msg validation_msg_{{ $i }}"></p>
            </div>
            <div class="col-12">
                <strong class="subtitle">Debt Information</strong>
            </div>
            <div class=" col-lg-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Select the type of debt you wish to add into your
                            bankruptcy case: </label>
                        <select class="form-control required cards_collections cards_collections_{{ $inc }}"
                            name="debt_tax[cards_collections][{{ $i }}]"
                            onchange="cardCollectionChanged(this);">
                            @foreach ($cards_collections as $key => $val)
                            <option data-type="{{ $cardTypes[$key] ?? '' }}" value="{{ $key }}" {{ Helper::validate_key_option('cards_collections', $debt, $key) }}>
                                {{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class=" col-lg-3 col-12  col-sm-6 ">
                <div class="label-div">
                    <div class="form-group">
                        <label>
                            List Last 4 Digits of Account #:
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-original-title="If you don't know the account # use the last 4 digits of your social security or ITIN #">
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
                        <input type="text"
                            class="form-control required allow-4digit-alpha-numeric amount_number amount_number_{{ $inc }}"
                            name="debt_tax[amount_number][{{ $i }}]" placeholder="Account Number"
                            value="{{ Helper::validate_key_value('amount_number', $debt) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12  col-sm-6 ">
                <div class="label-div">
                    <div class="form-group amount_owed_section_{{ $i }}">
                        <label>Amount owned
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="" data-bs-original-title="Current Balance">
                                <i class="bi bi-question-circle"></i>
                            </div>
                            <!-- <span class=" text-c-light-blue">(current balance)</span> -->
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                class="form-control required price-field amount_owned amount_owned_{{ $inc }}"
                                name="debt_tax[amount_owned][{{ $i }}]" placeholder="Amount of Claim"
                                value="{{ (float) Helper::validate_key_value('amount_owned', $debt) }}">
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-12">
                <strong class="subtitle">Creditor Information</strong>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label> Name</label>
                        <input type="text" autocomplete="off" autocomplete
                            class="input_capitalize form-control required autocomplete debt_creditor_name creditor_name creditor_name_{{ $inc }}"
                            data-index="{{ $inc }}" name="debt_tax[creditor_name][{{ $i }}]"
                            placeholder="Creditor Name" value="{{ Helper::validate_key_value('creditor_name', $debt) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group ">
                        <label>
                            Street address
                        </label>
                        <input type="text" name="debt_tax[creditor_information][{{ $i }}]"
                            class="input_capitalize form-control required creditor_information creditor_information_{{ $inc }}"
                            placeholder="Street Address" value="{{ Helper::validate_key_value('creditor_information', $debt) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text"
                            class="input_capitalize form-control required creditor_city creditor_city_{{ $inc }} "
                            name="debt_tax[creditor_city][{{ $i }}]" placeholder="City"
                            value="{{ Helper::validate_key_value('creditor_city', $debt) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control creditor_state creditor_state_{{ $inc }} required"
                            name="debt_tax[creditor_state][{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesListUsingArray($stateArray, Helper::validate_key_value('creditor_state', $debt)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="text"
                            class="form-control required allow-5digit creditor_zip creditor_zip_{{ $inc }} "
                            name="debt_tax[creditor_zip][{{ $i }}]" placeholder="Zip"
                            value="{{ Helper::validate_key_value('creditor_zip', $debt) }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class=" col-lg-6 col-md-6 col-sm-8 col-12">
                        <div class="label-div">
                            <div class="form-group debt_date_section_{{ $i }} ">
                                <label style="font-size: 90%;">
                                    @php
                                    $debt_date_unknown = Helper::validate_key_value('debt_date_unknown', $debt);
                                    $checked = '';
                                    $required = 'required';
                                    if (!empty($debt_date_unknown) && $debt_date_unknown == 1) {
                                        $checked = 'checked';
                                        $required = '';
                                    }
                                    @endphp
                                    Enter the date the debt was originally incurred:
                                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title=""
                                        data-bs-original-title="If your not sure of the exact date put your best guess">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                </label>
                                <input type="text"
                                    class="form-control debt_date debt_date_{{ $inc }} date_month_year_custom {{ $required }}"
                                    name="debt_tax[debt_date][{{ $i }}]" placeholder="MM/YYYY"
                                    value="{{ Helper::validate_key_value('debt_date', $debt) }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="label-div question-area b-0-i pb-0">
                            <label class="fs-13px"> Is this original Creditor?</label>
                            <div class="custom-radio-group form-group mb-0">
                                <input type="radio" id="original_creditor_no_{{ $i }}"
                                    class="d-none original_creditor original_creditor_{{ $inc }}"
                                    name="debt_tax[original_creditor][{{ $i }}]" required value="1"
                                    {{ Helper::validate_key_toggle('original_creditor', $debt, 1) }}>
                                <label for="original_creditor_no_{{ $i }}"
                                    class="btn-toggle {{ Helper::validate_key_toggle_active('original_creditor', $debt, 1) }}"
                                    onclick="originalCreditorCheck(1, {{ $i }})">Yes</label>

                                <input type="radio" id="original_creditor_yes_{{ $i }}"
                                    class="d-none original_creditor original_creditor_{{ $inc }}"
                                    name="debt_tax[original_creditor][{{ $i }}]" required value="0"
                                    {{ Helper::validate_key_toggle('original_creditor', $debt, 0) }}>
                                <label for="original_creditor_yes_{{ $i }}"
                                    class="btn-toggle {{ Helper::validate_key_toggle_active('original_creditor', $debt, 0) }}"
                                    onclick="originalCreditorCheck(0, {{ $i }})">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 debt_tax_own_by">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px"> Who owes the debt?</label>
                    <div
                        class="custom-radio-group form-group flex-column flex-md-row multi-input-radio-group btn-small">
                        <input type="radio" id="credt_owned_by_you_{{ $i }}"
                            class="credt_owned_by required d-none " name="debt_tax[owned_by][{{ $i }}]"
                            value="1" {{ Helper::validate_key_toggle('owned_by', $debt, 1) }}>
                        <label for="credt_owned_by_you_{{ $i }}"
                            class="mb-0 btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $debt, 1) }}" onclick="common_toggle_own_by(1,this)">
                            Self</label>

                        <input type="radio" id="credt_owned_by_spouse_{{ $i }}"
                            class="credt_owned_by required d-none " name="debt_tax[owned_by][{{ $i }}]"
                            value="2" {{ Helper::validate_key_toggle('owned_by', $debt, 2) }}>
                        <label for="credt_owned_by_spouse_{{ $i }}"
                            class="mb-0 btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $debt, 2) }}" onclick="common_toggle_own_by(2,this)">
                            Spouse</label>

                        <input type="radio" id="credt_owned_by_joint_{{ $i }}"
                            class="credt_owned_by required d-none " name="debt_tax[owned_by][{{ $i }}]"
                            value="3" {{ Helper::validate_key_toggle('owned_by', $debt, 3) }}>
                        <label for="credt_owned_by_joint_{{ $i }}"
                            class="mb-0 btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $debt, 3) }}" onclick="common_toggle_own_by(3,this)">
                            Joint</label>

                        <input type="radio" id="credt_owned_by_other_{{ $i }}"
                            class="credt_owned_by required d-none " name="debt_tax[owned_by][{{ $i }}]"
                            value="4" {{ Helper::validate_key_toggle('owned_by', $debt, 4) }}>
                        <label for="credt_owned_by_other_{{ $i }}"
                            class="mb-0 btn-toggle {{ Helper::validate_key_toggle_active('owned_by', $debt, 4) }}" onclick="common_toggle_own_by(4,this)">
                            Other</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="row">
                    <div class="col-12 debt_second_address_{{ $i }} {{ $not_original_creditor }}">
                        <strong class="subtitle">Original Creditor Information</strong>
                    </div>
                    <div
                        class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 debt_second_address_{{ $i }} {{ $not_original_creditor }}">
                        <div class="label-div">
                            <div class="form-group">
                                <label> Creditor information</label>
                                <input type="text" autocomplete="off" autocomplete
                                    class="input_capitalize form-control required autocomplete debt_second_creditor_name second_creditor_name second_creditor_name_{{ $inc }}"
                                    name="debt_tax[second_creditor_name][{{ $i }}]"
                                    placeholder="Creditor Name" data-index="{{ $inc }}"
                                    value="{{ Helper::validate_key_value('second_creditor_name', $debt) }}">
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3 debt_second_address_{{ $i }} {{ $not_original_creditor }}">
                        <div class="label-div">
                            <div class="form-group ">
                                <label>
                                    Street address
                                </label>
                                <input type="text"
                                    name="debt_tax[second_creditor_information][{{ $i }}]"
                                    class=" input_capitalize form-control required second_creditor_information second_creditor_information_{{ $inc }}"
                                    placeholder="Street Address" value="{{ Helper::validate_key_value('second_creditor_information', $debt) }}">
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 debt_second_address_{{ $i }} {{ $not_original_creditor }}">
                        <div class="label-div">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text"
                                    class=" input_capitalize form-control required second_creditor_city second_creditor_city_{{ $inc }}"
                                    name="debt_tax[second_creditor_city][{{ $i }}]" placeholder="City"
                                    value="{{ Helper::validate_key_value('second_creditor_city', $debt) }}">
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 debt_second_address_{{ $i }} {{ $not_original_creditor }}">
                        <div class="label-div">
                            <div class="form-group">
                                <label>State</label>
                                <select
                                    class="form-control second_creditor_state second_creditor_state_{{ $inc }} required"
                                    name="debt_tax[second_creditor_state][{{ $i }}]">
                                    <option value="">Please Select State</option>
                                    {!! AddressHelper::getStatesListUsingArray($stateArray, Helper::validate_key_value('second_creditor_state', $debt)) !!}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div
                        class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 debt_second_address_{{ $i }} {{ $not_original_creditor }}">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Zip code</label>
                                <input type="text"
                                    class="form-control required allow-5digit second_creditor_zip second_creditor_zip_{{ $inc }}"
                                    name="debt_tax[second_creditor_zip][{{ $i }}]" placeholder="Zip"
                                    value="{{ Helper::validate_key_value('second_creditor_zip', $debt) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ Helper::key_hide_show_ownedby('owned_by', $debt) }} debt_tax_codebtor_cosigner_data"
                id="debt_tax_codebtor_cosigner_data">
                <div class="row codebtor-tab">
                    <div class="col-12 debt_tax_own_by">
                        <strong class="subtitle">Debt Owner Information</strong>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Codebtor name </label>
                                <input type="text"
                                    class="input_capitalize cod_name form-control debt_tax_codebtor_creditor_name required"
                                    name="debt_tax[codebtor_creditor_name][{{ $i }}]"
                                    placeholder="Codebtor Name" value="{{ Helper::validate_key_value('codebtor_creditor_name', $debt) }}">
                                @if(isset($appservice_codebtors) && !empty($appservice_codebtors))
                                <!-- makeCodetorSelected(this) -->
                                <select class="cod_opt form-control col-12 col-md-6"
                                    onchange="alreadySavedCodebtor(this)">
                                    <option class="form-control" value="">Choose Already Saved Codebtor</option>
                                    @foreach($appservice_codebtors as $codebtor)
                                    <option data-cname="{{ $codebtor['codebtor_creditor_name'] }}"
                                        data-address="{{ $codebtor['codebtor_creditor_name_addresss'] }}"
                                        data-city="{{ $codebtor['codebtor_creditor_city'] }}"
                                        data-state="{{ $codebtor['codebtor_creditor_state'] }}"
                                        data-zip="{{ $codebtor['codebtor_creditor_zip'] }}">
                                        {{ $codebtor['codebtor_creditor_name'] }},
                                        {{ $codebtor['codebtor_creditor_name_addresss'] }},
                                        {{ $codebtor['codebtor_creditor_city'] }},
                                        {{ $codebtor['codebtor_creditor_state'] }},
                                        {{ $codebtor['codebtor_creditor_zip'] }}
                                    </option>
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
                                    class="form-control cod_address debt_tax_codebtor_creditor_name_addresss required input_capitalize "
                                    name="debt_tax[codebtor_creditor_name_addresss][{{ $i }}]"
                                    placeholder="Street Address" value="{{ Helper::validate_key_value('codebtor_creditor_name_addresss', $debt) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text"
                                    class="form-control cod_city debt_tax_codebtor_creditor_city required input_capitalize "
                                    name="debt_tax[codebtor_creditor_city][{{ $i }}]" placeholder="City"
                                    value="{{ Helper::validate_key_value('codebtor_creditor_city', $debt) }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                        <div class="label-div">
                            <div class="form-group">
                                <label>State</label>
                                <select class="form-control cod_state debt_tax_codebtor_creditor_state required"
                                    name="debt_tax[codebtor_creditor_state][{{ $i }}]">
                                    <option value="">Please Select State</option>
                                    {!! AddressHelper::getStatesListUsingArray($stateArray, Helper::validate_key_value('codebtor_creditor_state', $debt)) !!}
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
                                    name="debt_tax[codebtor_creditor_zip][{{ $i }}]" placeholder="Zip"
                                    value="{{ Helper::validate_key_value('codebtor_creditor_zip', $debt) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @php
            $is_debt_three_months = Helper::validate_key_value('is_debt_three_months', $debt);
            $is_debt_three_months_show_hide = 'hide-data';
            if ($is_debt_three_months == 1) {
                $is_debt_three_months_show_hide = '';
            }
            @endphp


            <!-- coding c -->
            <div class="col-12">
                <strong class="subtitle">Payments made on the above debt in the last 90 days</strong>
            </div>

            <div class="col-12 debt_tax_own_by">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px">Have you made any payments on the above debt in the last 3 months?</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="is_debt_three_months_yes_{{ $i }}"
                            name="debt_tax[is_debt_three_months][{{ $i }}]" value="1"
                            class="required d-none is_debt_three_months debt_months" required {{ Helper::validate_key_toggle('is_debt_three_months', $debt, 1) }} />
                        <label for="is_debt_three_months_yes_{{ $i }}"
                            class="btn-toggle debt_months_label_yes {{ Helper::validate_key_toggle_active('is_debt_three_months', $debt, 1) }}"
                            onclick="isThreeMonthsCommon('yes','debt_three_months_div_{{ $i }}')">Yes</label>

                        <input type="radio" id="is_debt_three_months_no_{{ $i }}"
                            name="debt_tax[is_debt_three_months][{{ $i }}]" value="0"
                            class="required d-none is_debt_three_months debt_months" required {{ Helper::validate_key_toggle('is_debt_three_months', $debt, 0) }} />
                        <label for="is_debt_three_months_no_{{ $i }}"
                            class="btn-toggle debt_months_label_no {{ Helper::validate_key_toggle_active('is_debt_three_months', $debt, 0) }}"
                            onclick="isThreeMonthsCommon('no','debt_three_months_div_{{ $i }}')">No</label>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="row debt_months_div debt_three_months_div_{{ $i }} {{ $is_debt_three_months_show_hide }}">
                    <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label>Payment amount</label>
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input id="payment_1" data-index="{{ $i }}"
                                        data-mainarray="debt_tax" placeholder="Payment" type="number"
                                        class="payment_1 price-field form-control required"
                                        value="{{ Helper::validate_key_value('payment_1', $debt) }}"
                                        name="debt_tax[payment_1][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $monthBeforeLast }}
                                    <input type="hidden" class="payment_dates_1"
                                        name="debt_tax[payment_dates_1][{{ $i }}]"
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
                                    <span class="input-group-text">$</span>
                                    <input id="payment_2" data-index="{{ $i }}"
                                        data-mainarray="debt_tax" placeholder="Payment" type="number"
                                        class="payment_2 price-field form-control required"
                                        value="{{ Helper::validate_key_value('payment_2', $debt) }}"
                                        name="debt_tax[payment_2][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $lastMonth }}
                                    <input type="hidden" class="payment_dates_2"
                                        name="debt_tax[payment_dates_2][{{ $i }}]"
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
                                    <span class="input-group-text">$</span>
                                    <input id="payment_3" data-index="{{ $i }}"
                                        data-mainarray="debt_tax" placeholder="Payment" type="number"
                                        class="payment_3 price-field form-control required"
                                        value="{{ Helper::validate_key_value('payment_3', $debt) }}"
                                        name="debt_tax[payment_3][{{ $i }}]" required>
                                </div>
                                <small class="font-weight-bold font-italic">
                                    Payment date: {{ $currentMonth }}
                                    <input type="hidden" class="payment_dates_3"
                                        name="debt_tax[payment_dates_3][{{ $i }}]"
                                        value="{{ $currentMonth }}">
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
                                    <input id="total_amount_paid" readonly required placeholder="Total Amount"
                                        type="number" class="total_amount_paid price-field form-control"
                                        value="{{ Helper::validate_key_value('total_amount_paid', $debt) }}"
                                        name="debt_tax[total_amount_paid][{{ $i }}]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('client.questionnaire.debt.law_suit_que')

            <!-- Condition data End-->
            <div class="col-12 text-right mb-2 pb-2">
                <a href="javascript:void(0)" data-saveid="{{ $inc }}"
                    class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    onclick="saveTheseDebts(true,this)">Save</a>
            </div>

        </div>
    </div>
</div>
