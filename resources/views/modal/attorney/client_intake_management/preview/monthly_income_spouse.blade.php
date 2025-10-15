@php
    $codebtor_income_data = Helper::validate_key_value('codebtor_income_data', $details);
    $codebtor_income_data = json_decode($codebtor_income_data, true);
@endphp

@if (!empty($codebtor_income_data))
    @php
        $dataFor = 'spouse-income-info';
        $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);

        $isEmployedYes = Helper::key_display('joints_debtor_gross_wages', $codebtor_income_data) === 'Yes';
        $monthlyWagesAmount = $isEmployedYes
            ? (isset($codebtor_income_data['joints_debtor_gross_wages_month'])
                ? '$' .
                    number_format(
                        (float) Helper::validate_key_value('joints_debtor_gross_wages_month', $codebtor_income_data),
                        2,
                    )
                : '$0.00')
            : '$0.00';

        $businessWorth = isset($codebtor_income_data['income_net_profit_spouse'])
            ? '$' .
                number_format((float) Helper::validate_key_value('income_net_profit_spouse', $codebtor_income_data), 2)
            : '$0.00';

        $moneyOwed = isset($details['spouse_money_owed_by_anyone'])
            ? '$' . number_format((float) Helper::validate_key_value('spouse_money_owed_by_anyone', $details), 2)
            : '$0.00';

        $retirementInfo = isset($details['spouse_retirement_life_insurance'])
            ? ' & $' .
                number_format((float) Helper::validate_key_value('spouse_retirement_life_insurance', $details), 2)
            : ' & $0.00';
    @endphp

    <div class="col-12 col-md-12 {{ $spouseClass }}">
        <div class="light-gray-div">
            <h2>Co-Debtor's/Spouse's Income Info</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}"
                    onclick="openHistoryLogsModal('{{ $dataFor }}', {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;"> <i class="bi bi-clock-history"></i>
                        History </span>
                </a>
                <a href="javascript:void(0)" onclick="editIntakeData(this, '{{ $dataFor }}')"
                    class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;"> <i class="bi bi-pencil-square"></i>
                        Edit </span>
                </a>
            </div>
            <div class="row gx-3 {{ $dataFor }} summary-div">
                <div class="col-md-12 ">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <span class="title"><span class="text-bold">Are you currently employed:</span>
                                {{ Helper::key_display('joints_debtor_gross_wages', $codebtor_income_data) }}</span>
                        </div>
                        <div class="col-12 col-md-4">
                            <span
                                class="title {{ Helper::validate_key_value('joints_debtor_gross_wages', $codebtor_income_data, 'radio') == 1 ? '' : 'hide-data' }}"><span
                                    class="text-bold">Job Title:</span>
                                {{ Helper::validate_key_value('spouse_job_title', $details) }}</span>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="w-100">
                                <span class="float-end amount">{{ $monthlyWagesAmount }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <span class="title"><span class="text-bold">Have you had any Self Employment Income:</span>
                                {{ Helper::key_display('self_employment_inc_spouse', $codebtor_income_data) }}</span>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><span class=" fw-bold">Business Name: </span>
                                {{ $details['spouse_bussiness_name'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><span class=" fw-bold">Business Type: </span>
                                {{ $details['spouse_bussiness_type'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><span class=" fw-bold">Nature of your business: </span>
                                {{ $details['spouse_bussiness_nature'] }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><span class=" fw-bold">Business worth: </span> {{ $businessWorth }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><span class=" fw-bold">How much money are you owed by anyone: </span>
                                {{ $moneyOwed }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <span class="title "><span class="text-bold">Future large amount of money or stuff (future): </span>
                        {{ Helper::validate_key_value('spouse_future_large_amount', $details) }}</span>
                </div>
                <div class="col-md-12 mb-2">
                    <span class="title "><span class="text-bold">Large amounts of money or stuff (last 6 months):
                        </span> {{ Helper::validate_key_value('spouse_last_6_month_large_amount', $details) }}</span>
                </div>
                <div class="col-md-12 mb-2">
                    <span class="title "><span class="text-bold">Suing/Sued:</span>
                        {{ Helper::validate_key_value('spouse_sued_details', $details) }}</span>
                </div>
                <div class="col-md-12 mb-2">
                    <span class="title "><span class="text-bold">Retirement / LIFE Insurance Withdrawals (last 2
                            years):</span>
                        {{ Helper::validate_key_value('spouse_retirement_life_insurance_date', $details) }}{{ $retirementInfo }}</span>
                </div>

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Rent and other real property income:'
                    radioValue='{{ Helper::key_display('rental_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['rental_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['rental_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Interest, dividends, and royalties:'
                    radioValue='{{ Helper::key_display('royality_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['royality_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['royality_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Pension and retirement income (Retirement Income):'
                    radioValue='{{ Helper::key_display('retirement_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['retirement_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['retirement_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Regular contributions from others:'
                    radioValue='{{ Helper::key_display('regular_contributions_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['regular_contributions_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['regular_contributions_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Unemployment Compensation:'
                    radioValue='{{ Helper::key_display('unemployment_compensation_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['unemployment_compensation_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['unemployment_compensation_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Social Security income. (SSI Income):'
                    radioValue='{{ Helper::key_display('social_security_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['social_security_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['social_security_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Other government assistance you receive regularly:'
                    radioValue='{{ Helper::key_display('government_assistance_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['government_assistance_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['government_assistance_inc_amt_spouse'], 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{ $spouseClass }}'
                    label='Other sources of income not already mentioned:'
                    radioValue='{{ Helper::key_display('other_sources_inc_spouse', $codebtor_income_data) }}'
                    amountValue='{{ $codebtor_income_data['other_sources_inc_amt_spouse'] ? "$" . number_format((float) $codebtor_income_data['other_sources_inc_amt_spouse'], 2) : "$0.00" }}' />
            </div>

            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                    action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                    method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.monthly_income_spouse', [
                            'formData' => $finalDetails,
                        ])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button"
                            class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{ $dataFor }}')">Close</button>
                        <button type="button"
                            class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save
                            Spouse's Income Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (!empty($details['employee_type_2']))
        @php
            $employee_type_2 = '';
            $spouseW2EmployeeClass = 'hide-data';
            $spouseSelfEmployeeClass = 'hide-data';

            if ($details['employee_type_2'] == 0) {
                $employee_type_2 = 'W-2 Employee';
                $spouseW2EmployeeClass = '';
            }
            if ($details['employee_type_2'] == 1) {
                $employee_type_2 = 'Self Employed';
                $spouseSelfEmployeeClass = '';
            }
            if ($details['employee_type_2'] == 2) {
                $employee_type_2 = 'Unemployed';
                $spouseSelfEmployeeClass = 'hide-data';
                $spouseW2EmployeeClass = 'hide-data';
            }
        @endphp

        <div class="col-12 col-md-6">
            <div class="light-gray-div">
                <h2>Co-Debtor's/Spouse's Income Information</h2>
                <div class="row gx-3">
                    <div class="col-md-4">
                        <p><span class="fw-bold">Spouse: </span>{{ $employee_type_2 }}</p>
                    </div>
                    <div class="col-md-4 {{ $spouseW2EmployeeClass }}">
                        <p><span class="fw-bold">How often do you get paid: </span>
                            {{ $details['income_paid_2'] == 4 ? 'Monthly' : '' }}</p>
                    </div>
                    <div class="col-md-4 {{ $spouseW2EmployeeClass }}">
                        <p><span class="fw-bold">Your average Gross Paycheck per payday: </span>
                            {{ $details['income_spouse_avg_paycheck'] ? '$' . number_format((float) $details['income_spouse_avg_paycheck'], 2) : '' }}
                        </p>
                    </div>
                    <div class="col-md-8 {{ $spouseSelfEmployeeClass }}">
                        <p><span class="fw-bold">Self Employed/ Business Net profit per mo: </span>
                            {{ $details['income_net_profit_spouse'] ? '$' . number_format((float) $details['income_net_profit_spouse'], 2) : '' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
