@php
    use App\Helpers\ClientHelper;

    $income_profit_loss   = $debtormonthlyincome['income_profit_loss']   ?? null;
    $income_profit_loss_2 = $debtormonthlyincome['income_profit_loss_2'] ?? null;
    $income_profit_loss_3 = $debtormonthlyincome['income_profit_loss_3'] ?? null;
    $income_profit_loss_4 = $debtormonthlyincome['income_profit_loss_4'] ?? null;
    $income_profit_loss_5 = $debtormonthlyincome['income_profit_loss_5'] ?? null;
    $income_profit_loss_6 = $debtormonthlyincome['income_profit_loss_6'] ?? null;
    $companyName1 = $debtormonthlyincome['profit_loss_business_name']     ?? null;
    $companyName2 = $debtormonthlyincome['profit_loss_business_name_2']   ?? null;
    $companyName3 = $debtormonthlyincome['profit_loss_business_name_3']   ?? null;
    $companyName4 = $debtormonthlyincome['profit_loss_business_name_4']   ?? null;
    $companyName5 = $debtormonthlyincome['profit_loss_business_name_5']   ?? null;
    $companyName6 = $debtormonthlyincome['profit_loss_business_name_6']   ?? null;

    $isthereDebtorBusiness = array_filter([
        $companyName1,
        $companyName2,
        $companyName3,
        $companyName4,
        $companyName5,
        $companyName6
    ]);

    $web_view = Session::get('web_view');

    $currentEmployerStatus = Helper::validate_key_value('current_employed', $incomedebtoremployer, 'radio');
    $primaryEmployerStatus = Helper::validate_key_value('recieved_any_income', $incomedebtoremployer, 'radio');

    $acceptType = ".png, .jpg, .jpeg, .pdf, .doc, .docx";

    $hasEmployer = ($currentEmployerStatus == 1 || $primaryEmployerStatus == 1);
@endphp

<form name="client_income_step3" id="client_income_step3" action="{{route('client_income_step3')}}" method="post" style="width: 100%" novalidate>
   @csrf
   <div class="row">
      <!-- hidden data -->
      @include('client.questionnaire.income.steps.debtor_monthly_income_section1')
      <!-- Paystub(s) Information -->
      @include('client.questionnaire.income.steps.debtor_monthly_income_section2')
        <div class="col-12">
        <div class="custom-box">
            <div class="main-kr-custom-box">
            <span class="box-title">Any Other Types of Income</span>
            <p>In the past 7 months, have you received any other types of income listed below, excluding the income you already reported above?</p>
            </div>
            <!-- Work & Business Income -->
            @include('client.questionnaire.income.steps.debtor_monthly_income_section3')
            <!-- Property & Investment Income -->
            @include('client.questionnaire.income.steps.debtor_monthly_income_section4')
            @include('client.questionnaire.income.steps.debtor_monthly_income_section4-part2')
            <!-- Retirement & Pension Income -->
            @include('client.questionnaire.income.steps.debtor_monthly_income_section5')
            <!-- Household & Support Income -->
            @include('client.questionnaire.income.steps.debtor_monthly_income_section6')
            <!-- Benefits & Assistance Income -->
            @include('client.questionnaire.income.steps.debtor_monthly_income_section7')
            <!-- Other Income -->
            @include('client.questionnaire.income.steps.debtor_monthly_income_section8')

            <div class="col-12 light-gray-div-button" style="text-align: right;">
                <div class="income-section-first-button">
                    <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('income_section_first');">
                        I haven't received any of the income listed above
                    </button>
                </div>
            </div>
        </div>
        </div>
     @if (env('ENABLED_CREDIT_COUNCELING', false) == true)
    <!-- Other Income  -->

    @include('client.questionnaire.income.steps.debtor_monthly_income_section9')
@endif
</div>

<div class="bottom-btn-div bottom-btn-div-kr">
    @if (request()->routeIs('client_income_step2'))
        <a href="{{ route('client_income') }}"
           class="btn-new-ui-default mr-2 {{ ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">
           Back to Previous Page
        </a>

        @if (!empty($is_confirm_prompt_enabled)
             && $is_confirm_prompt_enabled
             && $step1PercentDone == 100
             && $authUser->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED)

            <button type="button"
                    class="btn-new-ui-default"
                    onclick="showConfirmationPrompt('client_income_step3', 'Current Income')">
                {{ (!empty($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}
                <i class="feather icon-chevron-right mr-0"></i>
            </button>
        @else
            <button type="submit" class="btn-new-ui-default">
                {{ (!empty($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}
                <i class="feather icon-chevron-right mr-0"></i>
            </button>
        @endif
    @endif
</div>

</form>
