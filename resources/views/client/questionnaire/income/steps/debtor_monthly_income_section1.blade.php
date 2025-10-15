<input type="hidden" value="{{ date('n-Y', strtotime('-1 month')) }}" name="firstmonth">
<input type="hidden" value="{{ date('n-Y', strtotime('-6 month')) }}" name="lastmonth">


<div class="col-12 d-none">
    <div class="form-group">
        <div class="d-flex">
            <label class="d-block no_dup_blc">Would you like to manually calculate & input your income or have the
                system auto calculate it for you?</label>
        </div>
        <div class="d-inline radio-primary">
            <input type="radio" id="calculate-manually" name="calculation" value="0" required {{ Helper::validate_key_toggle('calculation', $debtormonthlyincome, 0) }} />
            
            <label for="calculate-manually" class="cr">Manually calculate</label>
        </div>
        <div class="d-inline radio-primary">
            <input id="calculate-auto" type="radio" name="calculation" value="1" required {{ Helper::validate_key_toggle('calculation', $debtormonthlyincome, 1) }} />
            <label for="calculate-auto" class="cr">Auto calculate</label>
        </div>
    </div>
</div>

<input type="hidden" name="debtor_gross_wages" value="{{ $hasEmployer ? 1 : 0 }}" />
<div class="col-12 {{ ($hasEmployer) ? 'hide-data' : Helper::key_hide_show_v('debtor_gross_wages', $debtormonthlyincome) }}"
    id="{{ ($hasEmployer) ? '' : 'debtor-gross-wages' }}">
    <div class="row ">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <input type="hidden" name="often_get_paid"
                        value="{{ Helper::validate_key_value('often_get_paid', $debtormonthlyincome) }}">
                    <label class="d-block">Enter your gross income per month:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Gross pay is the amount your paid before any deductions such as taxes, insurance etc. are removed from your check)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        @for ($i = 1; $i <= 1; $i++)
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area border-0 mb-0">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" id="monthly_income" class=" form-control price-field required"
                            name="debtor_gross_wages_month[{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('debtor_gross_wages_month', $debtormonthlyincome, $i) }}" />
                    </div>
                </div>
            </div>
        </div>
        @endfor
        <div class="col-12">
            <div class="border-bottom-default mb-2">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @php
            $recieveOvertime = Helper::validate_key_value('recieve_overtime', $debtormonthlyincome);
            $overtimeCheckedNo = empty($recieveOvertime) ? 'checked' : '';
            $overtimeCheckedYes = !empty($recieveOvertime) ? 'checked' : '';
            @endphp

            <div class="label-div question-area">
                <label class="">Do you receive overtime pay?</label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group">
                    <input type="radio" id="overtime-no" class="d-none" name="recieve_overtime" required {{ Helper::validate_key_toggle('recieve_overtime', $debtormonthlyincome, 0) }} value="0">
                    <label for="overtime-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('recieve_overtime', $debtormonthlyincome, 0) }}"
                        onclick="showOvertime('no');">No</label>

                    <input type="radio" id="overtime-yes" class="d-none" name="recieve_overtime" required {{ Helper::validate_key_toggle('recieve_overtime', $debtormonthlyincome, 1) }} value="1">
                    <label for="overtime-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('recieve_overtime', $debtormonthlyincome, 1) }}"
                        onclick="showOvertime('yes');">Yes</label>
                </div>
            </div>
        </div>
        <div
            class="col-12 debtor-recieve-overtime {{ ($overtimeCheckedYes == "checked") ? '' : 'hide-data' }}">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">Enter the average overtime you receive per month:</label>
                </div>
            </div>
        </div>
        <div
            class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 debtor-recieve-overtime {{ ($overtimeCheckedYes == "checked") ? '' : 'hide-data' }}">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required no_dup_inp"
                            name="overtime_per_month"
                            value="{{ Helper::validate_key_value('overtime_per_month', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">How much is deducted from your pay for taxes?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Federal, State, Local, Medicare, Social Security Taxes, etc.)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required" name="paycheck_for_security"
                            value="{{ Helper::validate_key_value('paycheck_for_security', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">Enter any mandatory contributions to retirement?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Such as from a Pension or Thrift Savings Plan (TSP))">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required"
                            name="paycheck_mandatory_contribution"
                            value="{{ Helper::validate_key_value('paycheck_mandatory_contribution', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">Enter any Voluntary contributions to retirement?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Such as a 401(k), IRA contributions)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required"
                            name="paycheck_voluntary_contribution"
                            value="{{ Helper::validate_key_value('paycheck_voluntary_contribution', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">Enter any deductions from your pay to repay retirement loans?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Such as 401(k) Loan Repayment Deduction)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required no_dup_inp"
                            name="paycheck_required_repayment"
                            value="{{ Helper::validate_key_value('paycheck_required_repayment', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">How much is deducted for insurance?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Health, vision, dental, etc.)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field  required"
                            name="automatically_deduction_insurance"
                            value="{{ Helper::validate_key_value('automatically_deduction_insurance', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @php
            $dsoDeduction = Helper::validate_key_value('dso_deduction', $debtormonthlyincome);
            $dsoCheckedNo = empty($dsoDeduction) ? 'checked' : '';
            $dsoCheckedYes = !empty($dsoDeduction) ? 'checked' : '';
            @endphp

            <!-- <div class="col-12 p-0"> -->
            <div class="label-div question-area">
                <label class="">Do you have any deductions for domestic support obligations?
                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="(Such as child support and/or alimony)">
                        <i class="bi bi-question-circle"></i>
                    </div>
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group">
                    <input type="radio" id="dso-deduction-no" class="d-none" name="dso_deduction" required {{ Helper::validate_key_toggle('dso_deduction', $debtormonthlyincome, 0) }} value="0">
                    <label for="dso-deduction-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('dso_deduction', $debtormonthlyincome, 0) }}"
                        onclick="showDSO('no');">No</label>

                    <input type="radio" id="dso-deduction-yes" class="d-none" name="dso_deduction" required {{ Helper::validate_key_toggle('dso_deduction', $debtormonthlyincome, 1) }} value="1">
                    <label for="dso-deduction-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('dso_deduction', $debtormonthlyincome, 1) }}"
                        onclick="showDSO('yes');">Yes</label>
                </div>
            </div>

        </div>
        <div class="col-12 debtor-dso {{ ($dsoCheckedYes == "checked") ? '' : 'hide-data' }}">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">Enter the average amount deducted from your pay per month</label>
                </div>
            </div>
        </div>
        <div
            class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 debtor-dso {{ ($dsoCheckedYes == "checked") ? '' : 'hide-data' }}">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required"
                            name="domestic_support_obligations"
                            value="{{ Helper::validate_key_value('domestic_support_obligations', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">How much is deducted for union dues ?</label>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class=" form-control price-field required no_dup_inp"
                            name="union_dues_deducted"
                            value="{{ Helper::validate_key_value('union_dues_deducted', $debtormonthlyincome, true) }}" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 p-0">
        <div class="label-div question-area">
            <label class="">Do you have any other deductions that come out of your check deductions?
                <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                    data-bs-original-title="(Such as life ins., wage garnishments, fsa, etc.)">
                    <i class="bi bi-question-circle"></i>
                </div>
            </label>
            <!-- Radio Buttons -->
            <div class="custom-radio-group form-group">
                <input type="radio" id="otherDeductions11-no" class="d-none" name="otherDeductions11" required {{ Helper::validate_key_toggle('otherDeductions11', $debtormonthlyincome, 0) }} value="0">
                <label for="otherDeductions11-no"
                    class="btn-toggle {{ Helper::validate_key_toggle_active('otherDeductions11', $debtormonthlyincome, 0) }}"
                    onclick="GetotherDeductions11('no');">No</label>

                <input type="radio" id="otherDeductions11-yes" class="d-none" name="otherDeductions11" required {{ Helper::validate_key_toggle('otherDeductions11', $debtormonthlyincome, 1) }} value="1">
                <label for="otherDeductions11-yes"
                    class="btn-toggle {{ Helper::validate_key_toggle_active('otherDeductions11', $debtormonthlyincome, 1) }}"
                    onclick="GetotherDeductions11('yes');">Yes</label>
            </div>
        </div>
    </div>




    <div class="col-12  form-main {{ Helper::key_hide_show_v('otherDeductions11', $debtormonthlyincome) }}"
        id="otherDeductions11_data">
        <div class="row gx-3 outline-gray-border-area">
            @php
            $i = 0;
            @endphp
            @if(!empty($debtormonthlyincome['other_deduction']) && is_array($debtormonthlyincome['other_deduction']))
                @for ($i = 0; $i < count($debtormonthlyincome['other_deduction']); $i++)
                    @include("client.questionnaire.income.steps.other_deducation", ['debtormonthlyincome' => $debtormonthlyincome, 'i' => $i])
                @endfor
            @else
                @include("client.questionnaire.income.steps.other_deducation")
            @endif
            <div class="add-more-div-bottom">
                <button type="button" class="btn-new-ui-default py-1 px-2"
                    onclick="addDeductionSection();return false;">
                    <i class="bi bi-plus-lg"></i>
                    Add More
                </button>
            </div>
        </div>
    </div>
</div>