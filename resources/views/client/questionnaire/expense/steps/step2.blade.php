<form name="client_expenses" id="client_expenses" action="{{ route('client_spouse_expenses') }}" method="post"
    style="width: 100%" novalidate>
    @csrf
    <div class="row">
        <div class="col-12 col-xxl-6">
            <div class="row">
                <!-- Relationship Information -->
                @include('client.questionnaire.expense.steps.step2_section1')
                <!-- Rental or home ownership expenses for your residence -->
                @include('client.questionnaire.expense.steps.step2_section2')
                <!-- Household Expenses -->
                @include('client.questionnaire.expense.steps.step2_section3')
            </div>
        </div>
        <div class="col-12 col-xxl-6">
            <div class="row">
                <!-- Utilities -->
                @include('client.questionnaire.expense.steps.step2_section4')
                <!-- Insurance that comes out of your bank account(s) -->
                @include('client.questionnaire.expense.steps.step2_section5')
                <!-- Tax payments from installment agreements only -->
                @include('client.questionnaire.expense.steps.step2_section6')
                <!-- Installment payments -->
                @include('client.questionnaire.expense.steps.step2_section7')
                <!-- Expenses for property you own other than your main home -->
                @include('client.questionnaire.expense.steps.step2_section8')
                <!-- These are your average monthly expenses -->
                @include('client.questionnaire.expense.steps.step2_section9')
            </div>
        </div>
    </div>
    <div class="bottom-btn-div">
        <a href="{{ route('client_expenses') }}"
            class="btn-new-ui-default mr-2 {{ ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back
            to Previous Page</a>
        @if (!empty($expenses['id']))
        @endif
        @if (isset($is_confirm_prompt_enabled) && $is_confirm_prompt_enabled && $step1PercentDone == 100)
            <button type="button" class="btn-new-ui-default"
                onclick="showConfirmationPrompt('client_expenses', 'Current Household Expense')">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                <i class="feather icon-chevron-right mr-0"></i></button>
        @else
            <button type="submit"
                class="btn-new-ui-default">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
        @endif
    </div>
</form>
