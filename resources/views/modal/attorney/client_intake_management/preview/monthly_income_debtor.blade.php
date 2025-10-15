@php
    $debtor_income_data = Helper::validate_key_value('debtor_income_data', $details);
    $debtor_income_data = json_decode($debtor_income_data, 1);
@endphp

@if(!empty($debtor_income_data))
    @php
        $dataFor = 'debtor-income-info';
        $historyExists = Helper::checkSectionKeyExists($historyLog, $dataFor);
        
        // Calculate monthly wages amount conditionally
        $monthlyWagesAmount = ($debtor_income_data && Helper::key_display("debtor_gross_wages", $debtor_income_data) == 'Yes') 
            ? (isset($debtor_income_data["debtor_gross_wages_month"]) ? "$" . number_format((float) Helper::validate_key_value("debtor_gross_wages_month", $debtor_income_data), 2) : "$0.00")
            : '$0.00';
            
        // Calculate business worth
        $businessWorth = isset($debtor_income_data["income_net_profit"]) ? "$" . number_format((float) Helper::validate_key_value("income_net_profit", $debtor_income_data), 2) : "$0.00";
        
        // Calculate money owed
        $moneyOwed = isset($details["debtor_money_owed_by_anyone"]) ? "$" . number_format((float) Helper::validate_key_value("debtor_money_owed_by_anyone", $details), 2) : "$0.00";
        
        // Format retirement info
        $retirementInfo = '';
        if (isset($details["debtor_retirement_life_insurance"])) {
            $retirementInfo = " & $" . number_format((float) Helper::validate_key_value("debtor_retirement_life_insurance", $details), 2);
        } else {
            $retirementInfo = " & $0.00";
        }
    @endphp

    <div class="col-12 col-md-12">
        <div class="light-gray-div">
            <h2>Debtor's Income Information</h2>
            <div class="intake-edit-div">
                <a href="javascript:void(0)" class="history-section-btn {{ $historyExists ? '' : 'hide-data' }}" onclick="openHistoryLogsModal('{{ $dataFor }}', {{ $intakeFormID }})">
                    <span class="text-bold" style="min-width: 80px !important;"><i class="bi bi-clock-history"></i> History </span>
                </a>
                <a href="javascript:void(0)" onclick="editIntakeData(this, '{{ $dataFor }}')" class="ml-2 edit edit-section-btn">
                    <span class="text-bold" style="min-width: 80px !important;"> <i class="bi bi-pencil-square"></i> Edit </span>
                </a>
            </div>
            
            <div class="row gx-3 {{ $dataFor }} summary-div">
                <div class="col-md-12">
                    <div class="row mb-2">
                        <div class="col-12 col-md-6">
                            <span class="title">
                                <span class="text-bold">Are you currently employed:</span>
                                {{ Helper::key_display("debtor_gross_wages", $debtor_income_data) }}
                            </span>
                        </div>
                        <div class="col-12 col-md-4">
                            <span class="title {{ Helper::validate_key_value("debtor_gross_wages", $debtor_income_data, 'radio') == 1 ? '' : 'hide-data' }}">
                                <span class="text-bold">Job Title:</span>
                                {{ Helper::validate_key_value("debtor_job_title", $details) }}
                            </span>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="w-100">
                                <span class="float-end amount">{{ $monthlyWagesAmount }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 mb-2">
                    <span class="title"> <span class="text-bold">Total family income:</span>{{ Helper::validate_key_value("debtor_total_family_income", $details) }}</span>
                </div>

                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <span class="title"> <span class="text-bold">Have you had any Self Employment Income:</span>
                                {{ Helper::key_display("self_employment_inc_debtor", $debtor_income_data) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"> <span class="fw-bold">Business Name: </span> {{ $details['debtor_bussiness_name'] }} </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"> <span class="fw-bold">Business Type: </span> {{ $details['debtor_bussiness_type'] }} </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"> <span class="fw-bold">Nature of your business: </span> {{ $details['debtor_bussiness_nature'] }} </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"> <span class="fw-bold">Business worth: </span> {{ $businessWorth }} </p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"> <span class="fw-bold">How much money are you owed by anyone: </span> {{ $moneyOwed }} </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <span class="title"> <span class="text-bold">Future large amount of money or stuff (future): </span>
                        {{ Helper::validate_key_value("debtor_future_large_amount", $details) }}
                    </span>
                </div>
                
                <div class="col-md-12 mb-2">
                    <span class="title"> <span class="text-bold">Large amounts of money or stuff (last 6 months): </span>
                        {{ Helper::validate_key_value("debtor_last_6_month_large_amount", $details) }}
                    </span>
                </div>
                
                <div class="col-md-12 mb-2">
                    <span class="title"> <span class="text-bold">Suing/Sued:</span>
                        {{ Helper::validate_key_value("debtor_sued_details", $details) }}
                    </span>
                </div>
                
                <div class="col-md-12 mb-2"> <span class="title">
                        <span class="text-bold">Retirement / LIFE Insurance Withdrawals (last 2 years):</span>
                        {{ Helper::validate_key_value("debtor_retirement_life_insurance_date", $details) }}{{ $retirementInfo }}
                    </span>
                </div>

                <x-shortForm.CommonYesNoWithPriceView label='Rent and other real property income:'
                    radioValue='{{ Helper::key_display("rental_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["rental_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("rental_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Interest, dividends, and royalties:'
                    radioValue='{{ Helper::key_display("royality_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["royality_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("royality_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Pension and retirement income (Retirement Income):'
                    radioValue='{{ Helper::key_display("retirement_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["retirement_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("retirement_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Regular contributions from others:'
                    radioValue='{{ Helper::key_display("regular_contributions_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["regular_contributions_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("regular_contributions_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Unemployment Compensation:'
                    radioValue='{{ Helper::key_display("unemployment_compensation_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["unemployment_compensation_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("unemployment_compensation_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Social Security income. (SSI Income):'
                    radioValue='{{ Helper::key_display("social_security_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["social_security_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("social_security_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Other government assistance you receive regularly:'
                    radioValue='{{ Helper::key_display("government_assistance_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["government_assistance_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("government_assistance_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

                <x-shortForm.CommonYesNoWithPriceView label='Other sources of income not already mentioned:'
                    radioValue='{{ Helper::key_display("other_sources_inc_debtor", $debtor_income_data) }}'
                    amountValue='{{ $debtor_income_data["other_sources_inc_amt_debtor"] ? "$" . number_format((float) Helper::validate_key_value("other_sources_inc_amt_debtor", $debtor_income_data), 2) : "$0.00" }}' />

            </div>

            <div class="{{ $dataFor }} edit-div hide-data">
                <form name="intake_form_save_by_attorney" id="intake_form_save_by_attorney_{{ $dataFor }}"
                      action="{{ route('intake_form_save_by_attorney', ['dataFor' => $dataFor, 'intakeFormID' => $intakeFormID]) }}"
                      method="post" novalidate>
                    @csrf
                    <div class="row gx-3">
                        @include('intake_form.questions.monthly_income_debtor', ['formData' => $finalDetails])
                    </div>
                    <div class="bottom-btn-div px-0">
                        <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3 btn-red"
                            onclick="closeIntakeForm('{{ $dataFor }}')">Close</button>
                        <button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0 btn-green"
                            onclick="submitIntakeForm('{{ $dataFor }}')">Save Debtor's Income Info</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- old -->
@php
    $employee_type_1 = "";
    $w2EmployeeClass = "hide-data";
    $selfEmployeeClass = "hide-data";
    if (!empty($details['employee_type_1'])) {
        if ($details['employee_type_1'] == 0) {
            $employee_type_1 = "W-2 Employee";
            $w2EmployeeClass = "";
        }
        if ($details['employee_type_1'] == 1) {
            $employee_type_1 = "Self Employed";
            $selfEmployeeClass = "";
        }
        if ($details['employee_type_1'] == 2) {
            $employee_type_1 = "Unemployed";
            $selfEmployeeClass = "hide-data";
            $w2EmployeeClass = "hide-data";
        }
    }
@endphp
@endif