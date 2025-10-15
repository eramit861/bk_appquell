@php
    $income_data = Helper::validate_key_value('debtor_income_data', $formData, 'array');
    
    // Helper function to determine radio button checked state
    function getCheckedState($radioValue, $fieldName) {
        if ($radioValue !== null && $radioValue !== '') {
            $checked1 = ($radioValue === '1' || $radioValue === 1) ? 'checked' : '';
            $checked0 = ($radioValue === '0' || $radioValue === 0) ? 'checked' : '';
        } else {
            $checked1 = (old($fieldName) === '1' || old($fieldName) === 1) ? 'checked' : '';
            $checked0 = (old($fieldName) === '0' || old($fieldName) === 0) ? 'checked' : '';
        }
        return ['checked1' => $checked1, 'checked0' => $checked0];
    }
    
    // Process employment radio values
    $debtorGrossWagesValue = \App\Helpers\Helper::validate_key_value('debtor_gross_wages', $income_data, 'radio');
    $debtorWagesChecked = getCheckedState($debtorGrossWagesValue, 'debtor_gross_wages');
    $debtorWagesChecked1 = $debtorWagesChecked['checked1'];
    $debtorWagesChecked0 = $debtorWagesChecked['checked0'];
    
    // Process self employment radio values
    $selfEmploymentValue = \App\Helpers\Helper::validate_key_value('self_employment_inc_debtor', $income_data, 'radio');
    $selfEmploymentChecked = getCheckedState($selfEmploymentValue, 'self_employment_inc_debtor');
    $selfEmploymentChecked1 = $selfEmploymentChecked['checked1'];
    $selfEmploymentChecked0 = $selfEmploymentChecked['checked0'];
    
    // Business type array
    $bussinessTypeArray = \App\Helpers\ArrayHelper::getBasicInfoBussinessTypeArray();
    $debtor_bussiness_type = Helper::validate_key_value('debtor_bussiness_type', $formData);
@endphp

<div class="mb-2 col-md-12">
    <div class="label-div question-area">
        <div class="row gx-3">
            <div class="col-12 col-md-12">
                <label class="">Are you currently employed:</label>
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="debtor_gross_wages" class="d-none"
                           id="debtor_gross_wages_1"
                           onclick="commonShowHide('debtor_gross_wages_section', 1)"
                           {{ $debtorWagesChecked1 }} 
                           value="1">
                    <label for="debtor_gross_wages_1" 
                           class="btn-toggle {{ $debtorWagesChecked1 == 'checked' ? 'active' : '' }}">Yes</label>

                    <input type="radio" required name="debtor_gross_wages" class="d-none"
                           id="debtor_gross_wages_0"
                           onclick="commonShowHide('debtor_gross_wages_section', 0)"
                           {{ $debtorWagesChecked0 }} 
                           value="0">
                    <label for="debtor_gross_wages_0" 
                           class="btn-toggle {{ $debtorWagesChecked0 == 'checked' ? 'active' : '' }}">No</label>
                </div>
            </div>
            
            <div class="col-12 col-md-4 debtor_gross_wages_section {{ ($debtorGrossWagesValue === '1' || $debtorGrossWagesValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">Job Title</label>
                        <input type="text" name="debtor_job_title" class="input_capitalize form-control"
                               placeholder="Job Title"
                               value="{{ !empty(Helper::validate_key_value('debtor_job_title', $formData)) ? Helper::validate_key_value('debtor_job_title', $formData) : old('debtor_job_title') }}">
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-md-4 debtor_gross_wages_section {{ ($debtorGrossWagesValue === '1' || $debtorGrossWagesValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">Gross Inc./Month</label>
                        <div class="d-flex input-group">
                            <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                            <input type="text" required name="debtor_gross_wages_month"
                                   class="w-auto form-control price-field custom_corner_input"
                                   placeholder="Gross Inc./Month"
                                   value="{{ \App\Helpers\Helper::validate_key_value('debtor_gross_wages_month', $income_data) !== '' ? \App\Helpers\Helper::validate_key_value('debtor_gross_wages_month', $income_data) : old('debtor_gross_wages_month') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class="w-100">TOTAL FAMILY INCOME:<br>
                Total Household Income (Last 6 Months, Before Taxes)<br>
                Enter the combined income for you for the past 6 months, before taxes. This includes:
                Paychecks (wages, salary, bonuses); Child support or alimony; Unemployment benefits; Business income (before taxes)
                Retirement or insurance withdrawals; Any other money received.
                <span class="blink">( 👉 Please include all sources of income.)</span>
            </label>
            <input type="text" name="debtor_total_family_income" class="input_capitalize form-control"
                   placeholder="Total family income"
                   value="{{ !empty(Helper::validate_key_value('debtor_total_family_income', $formData)) ? Helper::validate_key_value('debtor_total_family_income', $formData) : old('debtor_total_family_income') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="row gx-3">
            <div class="col-md-12">
                <label class="">Have you been self-employed in the last year? If so, please explain:</label>
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="self_employment_inc_debtor" class="d-none"
                           id="self_employment_inc_debtor_1"
                           onclick="commonShowHide('self_employment_inc_debtor_section', 1)"
                           {{ $selfEmploymentChecked1 }} 
                           value="1">
                    <label for="self_employment_inc_debtor_1" 
                           class="btn-toggle {{ $selfEmploymentChecked1 == 'checked' ? 'active' : '' }}">Yes</label>

                    <input type="radio" required name="self_employment_inc_debtor" class="d-none"
                           id="self_employment_inc_debtor_0"
                           onclick="commonShowHide('self_employment_inc_debtor_section', 0)"
                           {{ $selfEmploymentChecked0 }} 
                           value="0">
                    <label for="self_employment_inc_debtor_0" 
                           class="btn-toggle {{ $selfEmploymentChecked0 == 'checked' ? 'active' : '' }}">No</label>
                </div>
            </div>

            <div class="col-md-4 self_employment_inc_debtor_section {{ ($selfEmploymentValue === '1' || $selfEmploymentValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">Business Name</label>
                        <input type="text" name="debtor_bussiness_name" class="input_capitalize form-control"
                               placeholder="Business Name"
                               value="{{ !empty(Helper::validate_key_value('debtor_bussiness_name', $formData)) ? Helper::validate_key_value('debtor_bussiness_name', $formData) : old('debtor_bussiness_name') }}">
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 self_employment_inc_debtor_section {{ ($selfEmploymentValue === '1' || $selfEmploymentValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">Business Type</label>
                        <select class="form-control" name="debtor_bussiness_type">
                            <option value="">Please Select type</option>
                            @foreach($bussinessTypeArray as $key => $label)
                                <option value="{{ $key }}" {{ $debtor_bussiness_type == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 self_employment_inc_debtor_section {{ ($selfEmploymentValue === '1' || $selfEmploymentValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">Nature of your business</label>
                        <input type="text" name="debtor_bussiness_nature" class="input_capitalize form-control"
                               placeholder="Nature of your business"
                               value="{{ !empty(Helper::validate_key_value('debtor_bussiness_nature', $formData)) ? Helper::validate_key_value('debtor_bussiness_nature', $formData) : old('debtor_bussiness_nature') }}">
                    </div>
                </div>
            </div>
            <div class="col-md-4 self_employment_inc_debtor_section {{ ($selfEmploymentValue === '1' || $selfEmploymentValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">How much is your business worth?</label>
                        <div class="d-flex input-group">
                            <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                            <input type="text" required name="income_net_profit" class="w-auto form-control price-field custom_corner_input"
                                   placeholder="Business worth"
                                   value="{{ \App\Helpers\Helper::validate_key_value('income_net_profit', $income_data) !== '' ? \App\Helpers\Helper::validate_key_value('income_net_profit', $income_data) : old('income_net_profit') }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 self_employment_inc_debtor_section {{ ($selfEmploymentValue === '1' || $selfEmploymentValue === 1) ? '' : 'hide-data' }}">
                <div class="label-div mt-3">
                    <div class="form-group">
                        <label class="w-100">How much money are you owed by anyone (Total)</label>
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="d-flex input-group"> <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                                    <input type="text" required name="debtor_money_owed_by_anyone" class="w-auto form-control price-field custom_corner_input"
                                           placeholder="Money owed"
                                           value="{{ \App\Helpers\Helper::validate_key_value('debtor_money_owed_by_anyone', $formData) !== '' ? \App\Helpers\Helper::validate_key_value('debtor_money_owed_by_anyone', $formData) : old('debtor_money_owed_by_anyone') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class="w-100">FUTURE LARGE AMOUNT OF MONEY OR STUFF (future):<br> Expect to get any big cash or valuables—like an • inheritance • gift • lottery win • lawsuit payout • retirement or life insurance withdrawal, or • other surprise money/property? Tell us what you expect to get, when you expect it, & how much.</label>
            <input type="text" name="debtor_future_large_amount" class="input_capitalize form-control"
                   placeholder="What you expect to get, when you expect it, & how much"
                   value="{{ !empty(Helper::validate_key_value('debtor_future_large_amount', $formData)) ? Helper::validate_key_value('debtor_future_large_amount', $formData) : old('debtor_future_large_amount') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class="w-100">LARGE AMOUNTS OF MONEY OR STUFF (last 6 months):<br> Got any big cash or valuables—like an • inheritance • gift • lottery win • lawsuit payout • retirement or life insurance withdrawal, or • other surprise money/property? Tell us what you got, when, & how much.</label>
            <input type="text" name="debtor_last_6_month_large_amount" class="input_capitalize form-control"
                   placeholder="What you got, when, & how much"
                   value="{{ !empty(Helper::validate_key_value('debtor_last_6_month_large_amount', $formData)) ? Helper::validate_key_value('debtor_last_6_month_large_amount', $formData) : old('debtor_last_6_month_large_amount') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class="w-100">SUING/SUED:<br> • Have you sued, currently suing, or been sued in the last 2 years? List any cases where you might sue someone.</label>
            <input type="text" name="debtor_sued_details" class="input_capitalize form-control"
                   placeholder="Details"
                   value="{{ !empty(Helper::validate_key_value('debtor_sued_details', $formData)) ? Helper::validate_key_value('debtor_sued_details', $formData) : old('debtor_sued_details') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class="w-100">RETIREMENT / LIFE INSURANCE Withdrawals (last 2 years):<br> Did you pull out any money? If yes—type, date, and amount. </label>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="input-group date">
                            <input type="text" 
                                   name="debtor_retirement_life_insurance_date" 
                                   class="form-control datepicker date_filed custom_date_input" 
                                   placeholder="MM/DD/YYYY"
                                   value="{{ !empty(Helper::validate_key_value('debtor_retirement_life_insurance_date', $formData)) ? Helper::validate_key_value('debtor_retirement_life_insurance_date', $formData) : old('debtor_retirement_life_insurance_date') }}">
                            <span class="input-group-text">
                                <i class="bi bi-calendar-date"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <div class="d-flex input-group">
                            <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                            <input type="text" name="debtor_retirement_life_insurance" class="custom_corner_input form-control price-field"
                                   placeholder="Amount"
                                   value="{{ !empty(Helper::validate_key_value('debtor_retirement_life_insurance', $formData)) ? Helper::validate_key_value('debtor_retirement_life_insurance', $formData) : old('debtor_retirement_life_insurance') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-shortForm.CommonYesNoWithPriceSepererate label='Rent and other real property income:' radioName='rental_inc_debtor'
    amountName='rental_inc_amt_debtor' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Interest, dividends, and royalties:' radioName='royality_inc_debtor'
    amountName='royality_inc_amt_debtor' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate 
    label='Pension and retirement income (NOT Social Security) (Retirement Income):' radioName='retirement_inc_debtor'
    amountName='retirement_inc_amt_debtor' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate
    label='Regular contributions from others to the household expenses, including child support:'
    radioName='regular_contributions_inc_debtor' amountName='regular_contributions_inc_amt_debtor'
    :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Unemployment Compensation:'
    radioName='unemployment_compensation_inc_debtor' amountName='unemployment_compensation_inc_amt_debtor'
    :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Social Security income. (SSI Income):'
    radioName='social_security_inc_debtor' amountName='social_security_inc_amt_debtor' :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Other government assistance you receive regularly:'
    radioName='government_assistance_inc_debtor' amountName='government_assistance_inc_amt_debtor'
    :incomeData="$income_data" />

<x-shortForm.CommonYesNoWithPriceSepererate label='Other sources of income not already mentioned:'
    radioName='other_sources_inc_debtor' amountName='other_sources_inc_amt_debtor' :incomeData="$income_data" />