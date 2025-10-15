@php
    $income_data = Helper::validate_key_value('codebtor_income_data', $formData, 'array');

    $wagesValue = \App\Helpers\Helper::validate_key_value('joints_debtor_gross_wages', $income_data, 'radio');
    $checked1 = ($wagesValue !== null && $wagesValue !== '') ? (($wagesValue === '1' || $wagesValue === 1) ? 'checked' : '') : ((old('joints_debtor_gross_wages') === '1' || old('joints_debtor_gross_wages') === 1) ? 'checked' : '');
    $checked0 = ($wagesValue !== null && $wagesValue !== '') ? (($wagesValue === '0' || $wagesValue === 0) ? 'checked' : '') : ((old('joints_debtor_gross_wages') === '0' || old('joints_debtor_gross_wages') === 0) ? 'checked' : '');
    $wagesSectionVisible = ($wagesValue === '1' || $wagesValue === 1) ? '' : 'hide-data';
@endphp
<div class="mb-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="row gx-3 ">
            <div class="col-md-12">
                <label class="">Are you currently employed:</label>
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="joints_debtor_gross_wages" class="d-none"
                        id="joints_debtor_gross_wages_1"
                        onclick="commonShowHide('joints_debtor_gross_wages_section', 1)"
                        {{ $checked1 }} value="1">
                    <label for="joints_debtor_gross_wages_1" class="btn-toggle {{ $checked1 == 'checked' ? 'active' : '' }}">Yes</label>

                    <input type="radio" required name="joints_debtor_gross_wages" class="d-none"
                        id="joints_debtor_gross_wages_0"
                        onclick="commonShowHide('joints_debtor_gross_wages_section', 0)"
                        {{ $checked0 }} value="0">
                    <label for="joints_debtor_gross_wages_0" class="btn-toggle {{ $checked0 == 'checked' ? 'active' : '' }}">No</label>
                </div>
            </div>
            <div class="col-md-4 joints_debtor_gross_wages_section {{ $wagesSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">Job Title</label>
                        <input type="text" name="spouse_job_title" class="input_capitalize form-control"
                            placeholder="Job Title"
                            value="{{ !empty(Helper::validate_key_value('spouse_job_title', $formData)) ? Helper::validate_key_value('spouse_job_title', $formData) : old('spouse_job_title') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-4 joints_debtor_gross_wages_section {{ $wagesSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">Gross Income Per Month</label>
                        <div class="d-flex input-group ">
                            <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                            <input type="text" required name="joints_debtor_gross_wages_month"
                                class="w-auto form-control price-field custom_corner_input"
                                placeholder="Gross Income Per Month"
                                value="{{ (\App\Helpers\Helper::validate_key_value('joints_debtor_gross_wages_month', $income_data) !== '') ? \App\Helpers\Helper::validate_key_value('joints_debtor_gross_wages_month', $income_data) : old('joints_debtor_gross_wages_month') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $selfEmpValue = \App\Helpers\Helper::validate_key_value('self_employment_inc_spouse', $income_data, 'radio');
    $checked1 = ($selfEmpValue !== null && $selfEmpValue !== '') ? (($selfEmpValue === '1' || $selfEmpValue === 1) ? 'checked' : '') : ((old('self_employment_inc_spouse') === '1' || old('self_employment_inc_spouse') === 1) ? 'checked' : '');
    $checked0 = ($selfEmpValue !== null && $selfEmpValue !== '') ? (($selfEmpValue === '0' || $selfEmpValue === 0) ? 'checked' : '') : ((old('self_employment_inc_spouse') === '0' || old('self_employment_inc_spouse') === 0) ? 'checked' : '');
    $selfEmpSectionVisible = ($selfEmpValue === '1' || $selfEmpValue === 1) ? '' : 'hide-data';
@endphp
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="row gx-3 ">
            <div class="col-md-12">
                <label class="">Have you been self-employed in the last year? If so, please explain:</label>
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="self_employment_inc_spouse" class="d-none"
                        id="self_employment_inc_spouse_1"
                        onclick="commonShowHide('self_employment_inc_spouse_section', 1)"
                        {{ $checked1 }} value="1">
                    <label for="self_employment_inc_spouse_1" class="btn-toggle {{ $checked1 == 'checked' ? 'active' : '' }}">Yes</label>

                    <input type="radio" required name="self_employment_inc_spouse" class="d-none"
                        id="self_employment_inc_spouse_0"
                        onclick="commonShowHide('self_employment_inc_spouse_section', 0)"
                        {{ $checked0 }} value="0">
                    <label for="self_employment_inc_spouse_0" class="btn-toggle {{ $checked0 == 'checked' ? 'active' : '' }}">No</label>
                </div>
            </div>
            <div class="col-md-4 self_employment_inc_spouse_section {{ $selfEmpSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">Business Name</label>
                        <input type="text" name="spouse_bussiness_name" class="input_capitalize form-control"
                            placeholder="Business Name"
                            value="{{ !empty(Helper::validate_key_value('spouse_bussiness_name', $formData)) ? Helper::validate_key_value('spouse_bussiness_name', $formData) : old('spouse_bussiness_name') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-4 self_employment_inc_spouse_section {{ $selfEmpSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">Business Type</label>
                        @php
                            $bussinessTypeArray = \App\Helpers\ArrayHelper::getBasicInfoBussinessTypeArray();
                            $spouse_bussiness_type = Helper::validate_key_value('spouse_bussiness_type', $formData);
                        @endphp
                        <select class="form-control" name="spouse_bussiness_type">
                            <option value="">Please Select type</option>
                            @foreach($bussinessTypeArray as $key => $label)
                                <option value="{{ $key }}" {{ $spouse_bussiness_type == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-4 self_employment_inc_spouse_section {{ $selfEmpSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">Nature of your business</label>
                        <input type="text" name="spouse_bussiness_nature" class="input_capitalize form-control"
                            placeholder="Nature of your business"
                            value="{{ !empty(Helper::validate_key_value('spouse_bussiness_nature', $formData)) ? Helper::validate_key_value('spouse_bussiness_nature', $formData) : old('spouse_bussiness_nature') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-4 self_employment_inc_spouse_section {{ $selfEmpSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">How much is your business worth?</label>
                        <div class="d-flex input-group ">
                            <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                            <input type="text" required name="income_net_profit_spouse"
                                class="w-auto form-control price-field custom_corner_input"
                                placeholder="Business worth"
                                value="{{ (\App\Helpers\Helper::validate_key_value('income_net_profit_spouse', $income_data) !== '') ? \App\Helpers\Helper::validate_key_value('income_net_profit_spouse', $income_data) : old('income_net_profit_spouse') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 self_employment_inc_spouse_section {{ $selfEmpSectionVisible }} ">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class=" w-100">How much money are you owed by anyone (Total)</label>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="d-flex input-group ">
                                    <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                                    <input type="text" required name="spouse_money_owed_by_anyone"
                                        class="w-auto form-control price-field custom_corner_input"
                                        placeholder="Money owed"
                                        value="{{ (\App\Helpers\Helper::validate_key_value('spouse_money_owed_by_anyone', $formData) !== '') ? \App\Helpers\Helper::validate_key_value('spouse_money_owed_by_anyone', $formData) : old('spouse_money_owed_by_anyone') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
       <div class="form-group">
            <label class=" w-100">FUTURE LARGE AMOUNT OF MONEY OR STUFF (future):<br> Expect to get any big cash or valuables—like an • inheritance • gift • lottery win • lawsuit payout • retirement or life insurance withdrawal, or • other surprise money/property? Tell us what you expect to get, when you expect it, & how much.</label>
            <input type="text" name="spouse_future_large_amount" class="input_capitalize form-control"
                placeholder="What you expect to get, when you expect it, & how much"
                value="{{ !empty(Helper::validate_key_value('spouse_future_large_amount', $formData)) ? Helper::validate_key_value('spouse_future_large_amount', $formData) : old('spouse_future_large_amount') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
       <div class="form-group">
            <label class=" w-100">LARGE AMOUNTS OF MONEY OR STUFF (last 6 months):<br> Got any big cash or valuables—like an • inheritance • gift • lottery win • lawsuit payout • retirement or life insurance withdrawal, or • other surprise money/property? Tell us what you got, when, & how much.</label>
            <input type="text" name="spouse_last_6_month_large_amount" class="input_capitalize form-control"
                placeholder="What you got, when, & how much"
                value="{{ !empty(Helper::validate_key_value('spouse_last_6_month_large_amount', $formData)) ? Helper::validate_key_value('spouse_last_6_month_large_amount', $formData) : old('spouse_last_6_month_large_amount') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
       <div class="form-group">
            <label class=" w-100">SUING/SUED:<br> • Have you sued, currently suing, or been sued in the last 2 years? List any cases where you might sue someone.</label>
            <input type="text" name="spouse_sued_details" class="input_capitalize form-control"
                placeholder="Details"
                value="{{ !empty(Helper::validate_key_value('spouse_sued_details', $formData)) ? Helper::validate_key_value('spouse_sued_details', $formData) : old('spouse_sued_details') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <label class=" w-100">RETIREMENT / LIFE INSURANCE Withdrawals (last 2 years):<br> Did you pull out any money? If yes—type, date, and amount.</label>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <div class="input-group date">
                        <input type="text" 
                            name="spouse_retirement_life_insurance_date" 
                            class="form-control datepicker date_filed custom_date_input" 
                            placeholder="MM/DD/YYYY"
                            value="{{ !empty(Helper::validate_key_value('spouse_retirement_life_insurance_date', $formData)) ? Helper::validate_key_value('spouse_retirement_life_insurance_date', $formData) : old('spouse_retirement_life_insurance_date') }}">
                        <span class="input-group-text">
                            <i class="bi bi-calendar-date"></i> <!-- Bootstrap Icons -->
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">      
                <div class="form-group">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="spouse_retirement_life_insurance" class="custom_corner_input form-control price-field"
                            placeholder="Amount"
                            value="{{ !empty(Helper::validate_key_value('spouse_retirement_life_insurance', $formData)) ? Helper::validate_key_value('spouse_retirement_life_insurance', $formData) : old('spouse_retirement_life_insurance') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-shortForm.CommonYesNoWithPriceSepererate label='Rent and other real property income:' radioName='rental_inc_spouse'
    amountName='rental_inc_amt_spouse' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Interest, dividends, and royalties:' radioName='royality_inc_spouse'
    amountName='royality_inc_amt_spouse' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate
    label='Pension and retirement income (NOT Social Security) (Retirement Income):' radioName='retirement_inc_spouse'
    amountName='retirement_inc_amt_spouse' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate
    label='Regular contributions from others to the household expenses, including child support:'
    radioName='regular_contributions_inc_spouse' amountName='regular_contributions_inc_amt_spouse'
    :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Unemployment Compensation:'
    radioName='unemployment_compensation_inc_spouse' amountName='unemployment_compensation_inc_amt_spouse'
    :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Social Security income. (SSI Income):'
    radioName='social_security_inc_spouse' amountName='social_security_inc_amt_spouse' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Other government assistance you receive regularly:'
    radioName='government_assistance_inc_spouse' amountName='government_assistance_inc_amt_spouse'
    :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Other sources of income not already mentioned:'
    radioName='other_sources_inc_spouse' amountName='other_sources_inc_amt_spouse' :incomeData="$income_data" />