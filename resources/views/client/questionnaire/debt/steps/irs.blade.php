<form name="client_debts_step2_irs" id="client_debts_step2_irs" action="{{route('irs_custom_save')}}" method="post" novalidate>
    @csrf
    <input type="hidden" class="form-control tax_irs_state" name="tax_irs_state" value="PA">
    <div class="light-gray-div mt-2">
        <h2>IRS</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <div class="row gx-3">
                        <div class="col-sm-6 col-12">
                            <div class="label-div">
                                <label for="bankruptcy_filed">
                                    Do you owe any back taxes to the <span class="text-c-blue">IRS?</span>
                                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Unpaid federal taxes owed to the IRS from previous years. These may accumulate penalties, interest, or lead to collection actions.">
                                        <i class="bi bi-question-circle"></i>
                                    </div>
                                </label>
                                <!-- Radio Buttons -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" id="tax-owned-irs_yes" class="tax_owned_irs d-none" name="tax_owned_irs" required {{ Helper::validate_key_toggle('tax_owned_irs', $debts, 1) }} value="1">
                                    <label for="tax-owned-irs_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('tax_owned_irs', $debts, 1) }}" onclick="common_toggle_fn('yes','tax-owned-irs');">Yes</label>

                                    <input type="radio" id="tax-owned-irs_no" class="tax_owned_irs d-none" name="tax_owned_irs" required {{ Helper::validate_key_toggle('tax_owned_irs', $debts, 0) }} value="0">
                                    <label for="tax-owned-irs_no" class="btn-toggle {{ Helper::validate_key_toggle_active('tax_owned_irs', $debts, 0) }}" onclick="common_toggle_fn('no','tax-owned-irs');">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12 ">
                            <div class="address-dic float_right">
                                <div class="franchise_tax_board">
                                    <p>Creditor:</p>
                                </div>
                                <div class="franchise_tax_board">
                                    <p>Internal Revenue Service</p>
                                    <p>P.O. Box 7346</p>
                                    <p>Philadelphia, PA 19101</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tax-owned-irs" class="col-12 {{ Helper::key_hide_show_v('tax_owned_irs', $debts) }} {{ Helper::validate_key_value('tax_owned_irs', $debts) == 1 ? "hide-data" : '' }}">

                <div class="light-gray-div mt-2">
                    <h2>
                        IRS Details
                        <div class="d-inline-block ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="If You have a copy of Statement, please upload it into the Misc. Tab under documents">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </h2>

                    <div class="row gx-3 outline-gray-border-area">
                        <div class="col-md-12 text-center hide-data irs_validation_msg_div">
                            <p class="font-weight-bold irs_validation_msg"> </p>
                        </div>
                        <div class="col-xl-4 col-lg-8 col-md-8 col-sm-6 col-12">
                            <div class="label-div">
                                <label class="mb-2">For what year or years</label>
                                @php
                                    $tax_irs_whats_year = !empty($debts['tax_irs_whats_year']) ? $debts['tax_irs_whats_year'] : '';
                                    $selectedYearsArray = explode(" ", $tax_irs_whats_year);
                                @endphp
                                <div class="form-group d-flex flex-sm-row flex-column">
                                    <div class="dropdown me-2">
                                        <button class="year-btn dropdown-toggle mb-0 form-control" data-bs-auto-close="outside"
                                            type="button" data-bs-toggle="dropdown"><span
                                                class="dropdown-text">Select Years</span>
                                            <span class="caret"></span></button>
                                        <ul class="dropdown-menu py-2">
                                            <li>
                                                <!-- <a href="javascript:void(0)"> -->
                                                <label class="justone-label">
                                                    <input type="checkbox" class="selectall"
                                                        data-inputname="tax_irs_whats_year"
                                                        data-inputfor="irs" onchange="setSelectAll(this)" />
                                                    <span class="select-text"> Select</span> All
                                                </label>
                                                <!-- </a> -->
                                            </li>
                                            <li class="divider"></li>
                                            @foreach($last15Years as $index => $year)
                                                <li class="justone-li">
                                                    <!-- <a href="javascript:void(0)" class="justone-a"> -->
                                                    <label class="justone-label"
                                                        for="irs_for_{{ $year }}">
                                                        <input type="checkbox" class="option justone irs"
                                                            data-inputname="tax_irs_whats_year"
                                                            data-inputfor="irs"
                                                            id="irs_for_{{ $year }}"
                                                            value="{{ $year }}"
                                                            {{ in_array($year, $selectedYearsArray) ? 'checked' : '' }}
                                                            onchange="setJustOne(this)" />
                                                        {{ $year }}
                                                    </label>
                                                    <!-- </a> -->
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="w-100 flex-column flex-sm-row mt-2 mt-sm-0">
                                        <input type="text" readonly class="form-control required  tax_irs_whats_year"
                                            name="tax_irs_whats_year" placeholder="Whats Year"
                                            value="{{ $tax_irs_whats_year }}">
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
                                        <input type="number"
                                            class="form-control price-field required tax_irs_total_due"
                                            name="tax_irs_total_due" placeholder="Total Due"
                                            value="{{ !empty($debts['tax_irs_total_due']) ? $debts['tax_irs_total_due'] : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 debt_tax_own_by">
                            <strong class="subtitle">Debt Owner Information</strong>
                        </div>

                        <div class="col-12 debt_tax_own_by">
                            <div class="label-div question-area b-0-i pb-0">
                                <label class="fs-13px"> Who owes the debt?</label>
                                <div class="custom-radio-group form-group flex-column flex-md-row multi-input-radio-group btn-small">
                                    <input type="radio" id="irs_credt_owned_by_you"
                                        class="irs_credt_owned_by d-none" name="tax_irs_owned_by" required value="1"
                                        {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 1) ? 'checked' : '' }}>
                                    <label for="irs_credt_owned_by_you" class="btn-toggle {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 1) ? 'active' : '' }}" onclick="common_toggle_own_by(1,this)"> Self</label>

                                    <input type="radio" id="irs_credt_owned_by_spouse"
                                        class="irs_credt_owned_by d-none" name="tax_irs_owned_by" required value="2"
                                        {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 2) ? 'checked' : '' }}>
                                    <label for="irs_credt_owned_by_spouse" class="btn-toggle {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 2) ? 'active' : '' }}" onclick="common_toggle_own_by(2,this)"> Spouse</label>

                                    <input type="radio" id="irs_credt_owned_by_joint"
                                        class="irs_credt_owned_by d-none" name="tax_irs_owned_by" required value="3"
                                        {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 3) ? 'checked' : '' }}>
                                    <label for="irs_credt_owned_by_joint" class="btn-toggle {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 3) ? 'active' : '' }}" onclick="common_toggle_own_by(3,this)"> Joint</label>

                                    <input type="radio" id="irs_credt_owned_by_other"
                                        class="irs_credt_owned_by d-none" name="tax_irs_owned_by" required value="4"
                                        {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 4) ? 'checked' : '' }}>
                                    <label for="irs_credt_owned_by_other" class="btn-toggle {{ (!empty($debts['tax_irs_owned_by']) && $debts['tax_irs_owned_by'] == 4) ? 'active' : '' }}" onclick="common_toggle_own_by(4,this)"> Other</label>
                                </div>
                            </div>
                        </div>

                        <!-- Condition data -->
                        <div class="col-md-12  {{ (isset($debts['tax_irs_owned_by']) && in_array($debts['tax_irs_owned_by'], [2, 4])) ? '' : 'hide-data' }} debt_tax_codebtor_cosigner_data" id="debt_tax_codebtor_cosigner_data">
                            <div class="row codebtor-tab">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label>Codebtor name
                                                <!--<i class="text-c-blue"> (upload your most recent auto loan statement into the document system):</i>-->
                                            </label>
                                            <input type="text"
                                                class="input_capitalize form-control cod_name tax_irs_codebtor_creditor_name required"
                                                name="tax_irs_codebtor_creditor_name"
                                                placeholder="Codebtor Name"
                                                value="{{ !empty($debts['tax_irs_codebtor_creditor_name']) ? $debts['tax_irs_codebtor_creditor_name'] : '' }}">
                                            @if(isset($appservice_codebtors) && !empty($appservice_codebtors))
                                                <select class="cod_opt form-control col-12 col-md-6" onchange="alreadySavedCodebtor(this)">
                                                    <option class="form-control" value="">Choose Already Saved Codebtor</option>
                                                    @foreach($appservice_codebtors as $codebtor)
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
                                            <input type="text"
                                                class="input_capitalize form-control cod_address tax_irs_codebtor_creditor_name_addresss required"
                                                name="tax_irs_codebtor_creditor_name_addresss"
                                                placeholder="Street Address"
                                                value="{{ !empty($debts['tax_irs_codebtor_creditor_name_addresss']) ? $debts['tax_irs_codebtor_creditor_name_addresss'] : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text"
                                                class="input_capitalize form-control cod_city tax_irs_codebtor_creditor_city required"
                                                name="tax_irs_codebtor_creditor_city" placeholder="City"
                                                value="{{ !empty($debts['tax_irs_codebtor_creditor_city']) ? $debts['tax_irs_codebtor_creditor_city'] : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select
                                                class="form-control cod_state tax_irs_codebtor_creditor_state required"
                                                name="tax_irs_codebtor_creditor_state">
                                                <option value="">Please Select State</option>
                                                {!! AddressHelper::getStatesList(!empty($debts['tax_irs_codebtor_creditor_state']) ? $debts['tax_irs_codebtor_creditor_state'] : '') !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label>Zip code</label>
                                            <input type="number"
                                                class="form-control cod_zip  allow-5digit tax_irs_codebtor_creditor_zip required"
                                                name="tax_irs_codebtor_creditor_zip" placeholder="Zip"
                                                value="{{ !empty($debts['tax_irs_codebtor_creditor_zip']) ? $debts['tax_irs_codebtor_creditor_zip'] : '' }}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Condition data End-->
                        @php
                            $tax_irs = !empty($debts['tax_irs']) ? $debts['tax_irs'] : '';
                            $is_back_tax_irs_three_months = !empty($tax_irs['is_back_tax_irs_three_months']) ? $tax_irs['is_back_tax_irs_three_months'] : '';
                            $is_back_tax_irs_three_months_show_hide = ($is_back_tax_irs_three_months == 1) ? "" : "hide-data";
                        @endphp

                        <div class="col-12">
                            <strong class="subtitle">Payments made on the above debt in the last 90 days</strong>
                        </div>

                        <div class="col-12">
                            <div class="label-div question-area b-0-i pb-0">
                                <label class="fs-13px">Have you made any payments on the above debt in the last 3 months?</label>
                                <div class="custom-radio-group form-group">
                                    <input type="radio" id="is_back_tax_irs_three_months_yes"
                                        name="tax_irs[is_back_tax_irs_three_months]" value="1"
                                        class="required d-none is_back_tax_irs_three_months back_tax_irs_months" required
                                        {{ (!empty($tax_irs['is_back_tax_irs_three_months']) && $tax_irs['is_back_tax_irs_three_months'] == 1) ? 'checked' : '' }} />
                                    <label for="is_back_tax_irs_three_months_yes" class="btn-toggle {{ (!empty($tax_irs['is_back_tax_irs_three_months']) && $tax_irs['is_back_tax_irs_three_months'] == 1) ? 'active' : '' }}" onclick="isThreeMonthsCommon('yes','back_tax_irs_three_months_div')">Yes</label>

                                    <input type="radio" id="is_back_tax_irs_three_months_no"
                                        name="tax_irs[is_back_tax_irs_three_months]" value="0"
                                        class="required d-none is_back_tax_irs_three_months back_tax_irs_months" required
                                        {{ (!empty($tax_irs['is_back_tax_irs_three_months']) && $tax_irs['is_back_tax_irs_three_months'] == 0) ? 'checked' : '' }} />
                                    <label for="is_back_tax_irs_three_months_no" class="btn-toggle {{ (!empty($tax_irs['is_back_tax_irs_three_months']) && $tax_irs['is_back_tax_irs_three_months'] == 0) ? 'active' : '' }}" onclick="isThreeMonthsCommon('no','back_tax_irs_three_months_div')">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row back_tax_irs_months_div back_tax_irs_three_months_div {{ $is_back_tax_irs_three_months_show_hide }}">
                                <div class="col-xxl-2 col-md-4 col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label>Payment amount</label>
                                            <div class="input-group mb-0">
                                                <span class="input-group-text">$</span>
                                                <input data-mainarray="tax_irs" placeholder="Payment" type="number"
                                                    class="payment_1_irs price-field form-control required"
                                                    value="{{ !empty($tax_irs['payment_1']) ? $tax_irs['payment_1'] : '' }}"
                                                    name="tax_irs[payment_1]" required>
                                            </div>
                                            <small class="font-weight-bold font-italic">
                                                Payment date: {{ $monthBeforeLast }}
                                                <input type="hidden" name="tax_irs[payment_dates_1]"
                                                    class="payment_dates_1_irs" value="{{ $monthBeforeLast }}">
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
                                                <input data-mainarray="tax_irs" placeholder="Payment" type="number"
                                                    class="payment_2_irs price-field form-control required"
                                                    value="{{ !empty($tax_irs['payment_2']) ? $tax_irs['payment_2'] : '' }}"
                                                    name="tax_irs[payment_2]" required>
                                            </div>
                                            <small class="font-weight-bold font-italic">
                                                Payment date: {{ $lastMonth }}
                                                <input type="hidden" name="tax_irs[payment_dates_2]"
                                                    class="payment_dates_2_irs" value="{{ $lastMonth }}">
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
                                                <input data-mainarray="tax_irs" placeholder="Payment" type="number"
                                                    class="payment_3_irs price-field form-control required"
                                                    value="{{ !empty($tax_irs['payment_3']) ? $tax_irs['payment_3'] : '' }}"
                                                    name="tax_irs[payment_3]" required>
                                            </div>
                                            <small class="font-weight-bold font-italic">
                                                Payment date: {{ $currentMonth }}
                                                <input type="hidden" name="tax_irs[payment_dates_3]"
                                                    class="payment_dates_3_irs" value="{{ $currentMonth }}">
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xxl-3 col-md-4 col-sm-6 col-12">
                                    <div class="label-div">
                                        <div class="form-group">
                                            <label>Total Amount Paid</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input id="total_amount_paid" readonly placeholder="Monthly Payment"
                                                    type="number"
                                                    class="total_amount_paid total_amount_paid_irs price-field form-control"
                                                    value="{{ !empty($tax_irs['total_amount_paid']) ? $tax_irs['total_amount_paid'] : '' }}"
                                                    name="tax_irs[total_amount_paid]">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 text-right mb-2 pb-2">
                            <a href="javascript:void(0)"
                                class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                                onclick="saveIRSDebt(true)">Save</a>
                        </div>
                    </div>
                </div>



            </div>

            <div class="col-12 irs_view_form {{ (!empty($debts['tax_owned_irs']) && $debts['tax_owned_irs'] != 1) ? 'hide-data' : '' }}" id="irs-texes-views">
                @include("client.questionnaire.debt.ajax_summary.irs_taxes",['debts' => $debts])
            </div>
        </div>
    </div>

</form>