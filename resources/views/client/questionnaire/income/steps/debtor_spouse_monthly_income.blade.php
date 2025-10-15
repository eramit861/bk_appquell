@php
    $web_view = Session::get('web_view');
    $title = '';
    if (
        Auth::user()->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED ||
        Auth::user()->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED
    ) {
        $title = $spousename . ' Current Monthly Income Calculation';
    }
    $income_profit_loss = $debtorspousemonthlyincome['income_profit_loss'] ?? null;
    $profitType = 1;
    if (!empty($income_profit_loss)) {
        if (isset($income_profit_loss[0]['profit_loss_type'])) {
            $profitType = 2;
        }
    }
    $currentEmployerStatusCodebtor = Helper::validate_key_value('current_employed', $debtorspouseemployer, 'radio'); //1
    $primaryEmployerStatusCodebtor = Helper::validate_key_value('recieved_any_income', $debtorspouseemployer, 'radio'); //1
    $acceptType = '.png, .jpg, .jpeg, .pdf,.doc,.docx';
    $hasEmployerCodebtor = false;
    if ($currentEmployerStatusCodebtor == 1 || $primaryEmployerStatusCodebtor == 1) {
        $hasEmployerCodebtor = true;
    }
    $income_profit_loss = $debtorspousemonthlyincome['income_profit_loss'] ?? null;
    $income_profit_loss_2 = $debtorspousemonthlyincome['income_profit_loss_2'] ?? null;
    $income_profit_loss_3 = $debtorspousemonthlyincome['income_profit_loss_3'] ?? null;
    $income_profit_loss_4 = $debtorspousemonthlyincome['income_profit_loss_4'] ?? null;
    $income_profit_loss_5 = $debtorspousemonthlyincome['income_profit_loss_5'] ?? null;
    $income_profit_loss_6 = $debtorspousemonthlyincome['income_profit_loss_6'] ?? null;
    $companyName1 = $debtorspousemonthlyincome['profit_loss_business_name'] ?? null;
    $companyName2 = $debtorspousemonthlyincome['profit_loss_business_name_2'] ?? null;
    $companyName3 = $debtorspousemonthlyincome['profit_loss_business_name_3'] ?? null;
    $companyName4 = $debtorspousemonthlyincome['profit_loss_business_name_4'] ?? null;
    $companyName5 = $debtorspousemonthlyincome['profit_loss_business_name_5'] ?? null;
    $companyName6 = $debtorspousemonthlyincome['profit_loss_business_name_6'] ?? null;
    $isthereSpouseBusiness = array_filter([
        $companyName1,
        $companyName2,
        $companyName2,
        $companyName3,
        $companyName4,
        $companyName5,
        $companyName5,
    ]);
@endphp
    <div class="light-gray-div mt-2">
        <h2>{{ $title }}</h2>
        <form name="client_income_step4" id="client_income_step4" action="{{route('client_income_step4')}}" method="post" novalidate>
            @csrf
            <div class="row">
                <!-- hidden data -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section1')
                <!-- Paystub(s) Information -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section2')
                <div class="col-12">
                    <div class="light-gray-div light-gray-div-kr light-gray-div-kr-top">
                        <span>Any Other Types of Income</span>
                        <p>In the past 7 months, have you received any other types of income listed below, excluding the income you already reported above?</p>
                    </div>
                </div>
                <!-- Work & Business Income -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section3')
                <!-- Property & Investment Income -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section4')
                <!-- Retirement & Pension Income -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section5')
                <!-- Household & Support Income -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section6')
                <!-- Benefits & Assistance Income -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section7')
                <!-- Other Income -->
                @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section8')
                <div class="col-12 light-gray-div-button" style="text-align: right;">
                    <div class="income-section-first-button">
                        <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('income_section_first_spouse');">
                            I haven't received any of the income listed below
                        </button>
                    </div>
                </div>
                @if (env('ENABLED_CREDIT_COUNCELING', false) == true)
                <!-- Other Income -->
                    @include('client.questionnaire.income.steps.debtor_spouse_monthly_income_section9')
                @endif
            </div>
                <div class="bottom-btn-div pb-2 mb-1 bottom-btn-div-kr">
                    @if (!empty($debtorspousemonthlyincome['id']))
                        <input type="hidden" class="property_vehicle_ids" name="id"
                               value="{{ Helper::validate_value($debtorspousemonthlyincome['id']) }}">
                    @endif
                        <a href="{{ route('client_income_step1') }}" class="btn-new-ui-default mr-2">Back to Previous Page</a>
                    @if (isset($is_confirm_prompt_enabled) &&
                            $is_confirm_prompt_enabled &&
                            $step1PercentDone == 100 &&
                            $step2PercentDone == 100 &&
                            $step3PercentDone == 100)
                        <button type="button" class="btn-new-ui-default"
                            onclick="showConfirmationPrompt('client_income_step4', 'Current Income')">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                            <i class="feather icon-chevron-right mr-0"></i></button>
                    @else
                        <button type="submit"
                            class="btn-new-ui-default">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                            <i class="feather icon-chevron-right mr-0"></i></button>
                    @endif
            </div>
        </form>
    </div>
