<input type="hidden" value="{{ date('n-Y', strtotime('-1 month')) }}" name="firstmonth_joint">
<input type="hidden" value="{{ date('n-Y', strtotime('-6 month')) }}" name="lastmonth_joint">
<input type="hidden" value="{{ $profitType }}" name="existingType_joint">


<div class="col-12 d-none">
    <div class="form-group">
        <div class="d-flex">
            <label class="d-block no_dup_blc">Would you like to manually calculate & input your income or have the
                system auto calculate it for you?</label>
        </div>
        <div class="d-inline radio-primary">
            <input type="radio" id="calculate-manually" name="joints_calculation" value="0" required {{ Helper::validate_key_toggle('joints_calculation', $debtorspousemonthlyincome, 0) }} />
            <label for="calculate-manually" class="cr">Manually calculate</label>
        </div>
        <div class="d-inline radio-primary">
            <input id="calculate-auto" type="radio" name="joints_calculation" value="1" required {{ Helper::validate_key_toggle('joints_calculation', $debtorspousemonthlyincome, 1) }} />
            <label for="calculate-auto" class="cr">Auto calculate</label>
        </div>
    </div>
</div>
<input type="hidden" name="joints_debtor_gross_wages" value="{{ $hasEmployerCodebtor ? 1 : 0 }}" />
<div class="col-12 {{ ($hasEmployerCodebtor) ? 'hide-data' : Helper::key_hide_show_v('joints_debtor_gross_wages', $debtorspousemonthlyincome) }}"
    id="{{ ($hasEmployerCodebtor) ? '' : 'Joint-gross-wages' }}">
    <div class="row ">
        <div class="col-12">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <input type="hidden" name="joints_often_get_paid"
                        value="{{ Helper::validate_key_value('joints_often_get_paid', $debtorspousemonthlyincome) }}">
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
                        <input type="number" class="form-control  price-field required"
                            name="joints_debtor_gross_wages_month[{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('joints_debtor_gross_wages_month', $debtorspousemonthlyincome, $i) }}" />
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
$recieveOvertime = Helper::validate_key_value('joints_recieve_overtime', $debtorspousemonthlyincome);
$jointOvertimeCheckedNo = empty($recieveOvertime) ? 'checked' : '';
$jointOvertimeCheckedYes = !empty($recieveOvertime) ? 'checked' : '';
@endphp


            <div class="label-div question-area">
                <label class="no_dup_blc">Do you receive overtime pay?</label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group">
                    <input type="radio" id="overtime-no" class="d-none" name="joints_recieve_overtime" required {{ Helper::validate_key_toggle('joints_recieve_overtime', $debtorspousemonthlyincome, 0) }}
                        value="0">
                    <label for="overtime-no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('joints_recieve_overtime', $debtorspousemonthlyincome, 0) }}"
                        onclick="showOvertime('no', true);">No</label>

                    <input type="radio" id="overtime-yes" class="d-none" name="joints_recieve_overtime" required {{ Helper::validate_key_toggle('joints_recieve_overtime', $debtorspousemonthlyincome, 1) }}
                        value="1">
                    <label for="overtime-yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('joints_recieve_overtime', $debtorspousemonthlyincome, 1) }}"
                        onclick="showOvertime('yes', true);">Yes</label>
                </div>
            </div>
        </div>
        <div
            class="col-12 codebtor-recieve-overtime {{ ($jointOvertimeCheckedYes == "checked") ? '' : 'hide-data' }}">
            <div class="label-div question-area border-0 mb-0 p-0">
                <div class="form-group mb-0">
                    <label class="d-block">Enter the average overtime you receive per month:</label>
                </div>
            </div>
        </div>
        <div
            class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 codebtor-recieve-overtime {{ ($jointOvertimeCheckedYes == "checked") ? '' : 'hide-data' }}">
            <div class="label-div question-area">
                <div class="form-group">
                    <div class="input-group ">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control  price-field required" name="joints_overtime_per_month"
                            value="{{ Helper::validate_key_value('joints_overtime_per_month', $debtorspousemonthlyincome, true) }}" />
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
                        <input type="number" class="form-control  price-field required"
                            name="joints_paycheck_for_security"
                            value="{{ Helper::validate_key_value('joints_paycheck_for_security', $debtorspousemonthlyincome, true) }}" />
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
                            <input type="number" class="form-control  price-field required"
                                name="joints_paycheck_mandatory_contribution"
                                value="{{ Helper::validate_key_value('joints_paycheck_mandatory_contribution', $debtorspousemonthlyincome, true) }}" />
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
                            <input type="number" class="form-control  price-field required"
                                name="joints_paycheck_voluntary_contribution"
                                value="{{ Helper::validate_key_value('joints_paycheck_voluntary_contribution', $debtorspousemonthlyincome, true) }}" />
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
                            <input type="number" class="form-control  price-field required"
                                name="joints_paycheck_required_repayment"
                                value="{{ Helper::validate_key_value('joints_paycheck_required_repayment', $debtorspousemonthlyincome, true) }}" />
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
                            <input type="number" class="form-control  price-field required"
                                name="joints_automatically_deduction_insurance"
                                value="{{ Helper::validate_key_value('joints_automatically_deduction_insurance', $debtorspousemonthlyincome, true) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @php
$jointsDsoDeduction = Helper::validate_key_value('joints_dso_deduction', $debtorspousemonthlyincome);
$jointsDsoCheckedNo = empty($jointsDsoDeduction) ? 'checked' : '';
$jointsDsoCheckedYes = !empty($jointsDsoDeduction) ? 'checked' : '';
@endphp

                <div class="label-div question-area">
                    <label class="no_dup_blc">Do you have any deductions for domestic support obligations?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Such as child support and/or alimony)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="joint-dso-deduction-no" class="d-none" name="joints_dso_deduction"
                            required {{ Helper::validate_key_toggle('joints_dso_deduction', $debtorspousemonthlyincome, 0) }} value="0">
                        <label for="joint-dso-deduction-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('joints_dso_deduction', $debtorspousemonthlyincome, 0) }}"
                            onclick="showDSO('no', true);">No</label>

                        <input type="radio" id="joint-dso-deduction-yes" class="d-none" name="joints_dso_deduction"
                            required {{ Helper::validate_key_toggle('joints_dso_deduction', $debtorspousemonthlyincome, 1) }} value="1">
                        <label for="joint-dso-deduction-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('joints_dso_deduction', $debtorspousemonthlyincome, 1) }}"
                            onclick="showDSO('yes', true);">Yes</label>
                    </div>
                </div>
            </div>
            <div class="col-12 codebtor-dso {{ ($jointsDsoCheckedYes == "checked") ? '' : 'hide-data' }}">
                <div class="label-div question-area border-0 mb-0 p-0">
                    <div class="form-group mb-0">
                        <label class="d-block">Enter the average amount deducted from your pay per month</label>
                    </div>
                </div>
            </div>
            <div
                class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 col-xxl-2 codebtor-dso {{ ($jointsDsoCheckedYes == "checked") ? '' : 'hide-data' }}">
                <div class="label-div question-area">
                    <div class="form-group">
                        <div class="input-group ">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control  price-field required"
                                name="joints_domestic_support_obligations"
                                value="{{ Helper::validate_key_value('joints_domestic_support_obligations', $debtorspousemonthlyincome, true) }}" />
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
                            <input type="number" class="form-control  price-field required"
                                name="joints_union_dues_deducted"
                                value="{{ Helper::validate_key_value('joints_union_dues_deducted', $debtorspousemonthlyincome, true) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- <div class="col-12 p-0"> -->
                <div class="label-div question-area">
                    <label class="">Do you have any other deductions that come out of your check deductions?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="(Such as life ins., wage garnishments, fsa, etc.)">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="otherDeductions22-no" class="d-none" name="otherDeductions22" required
                            {{ Helper::validate_key_toggle('otherDeductions22', $debtorspousemonthlyincome, 0) }} value="0">
                        <label for="otherDeductions22-no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('otherDeductions22', $debtorspousemonthlyincome, 0) }}"
                            onclick="GetotherDeductions22('no');">No</label>

                        <input type="radio" id="otherDeductions22-yes" class="d-none" name="otherDeductions22" required
                            {{ Helper::validate_key_toggle('otherDeductions22', $debtorspousemonthlyincome, 1) }} value="1">
                        <label for="otherDeductions22-yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('otherDeductions22', $debtorspousemonthlyincome, 1) }}"
                            onclick="GetotherDeductions22('yes');">Yes</label>
                    </div>
                </div>

                <div class="col-12  form-main {{ Helper::key_hide_show_v('otherDeductions22', $debtorspousemonthlyincome) }}"
                    id="otherDeductions22_data">
                    <div class="row gx-3 outline-gray-border-area">
                        @php
$i = 0;
if (!empty($debtorspousemonthlyincome['joints_other_deduction']) && is_array($debtorspousemonthlyincome['joints_other_deduction'])) {

    for ($i = 0; $i < count($debtorspousemonthlyincome['joints_other_deduction']); $i++) {
        @endphp
                        @include("client.questionnaire.income.steps.spouse_other_deduction", ['debtorspousemonthlyincome' => $debtorspousemonthlyincome, $i])
                        @php    }
} else { @endphp
                        @include("client.questionnaire.income.steps.spouse_other_deduction")
                        @php } @endphp
                        <div class="add-more-div-bottom">
                            <button type="button" class="btn-new-ui-default py-1 px-2"
                                onclick="addSpouseDeductionSection();return false;">
                                <i class="bi bi-plus-lg"></i>
                                Add More
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>