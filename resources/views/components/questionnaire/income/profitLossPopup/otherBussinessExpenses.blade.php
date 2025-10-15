<div class="col-md-12 {{ $majorLawProfitLossLabels['labels'] == false ? 'hide-data' : '' }}">
    <div class="light-gray-box-tittle-div pb-2 mb-3 mt-3">
        <h2 class="mb-2">Other Business Expenses</h2>
        <small class="dotted-label-div-small text-c-blue w-100">(Add in other expense(s) that you didn’t list above such as: Rent (not home office), Salaries/Wages, Travel and Meals, etc.)</small>
    </div>
</div>

<x-questionnaire.income.profitLossPopup.otherExpensesRow
    :incomeProfitLoss="$incomeProfitLoss"
    :web_view="$webView"
    title="other_1"
    :fillValue="$majorLawProfitLossLabels['other_1']"
    name="other_expense_name1"
></x-questionnaire.income.profitLossPopup.otherExpensesRow>
<x-questionnaire.income.profitLossPopup.otherExpensesRow
    :incomeProfitLoss="$incomeProfitLoss"
    :web_view="$webView"
    title="other_2"
    :fillValue="$majorLawProfitLossLabels['other_2']"
    name="other_expense_name2"
></x-questionnaire.income.profitLossPopup.otherExpensesRow>
<x-questionnaire.income.profitLossPopup.otherExpensesRow
    :incomeProfitLoss="$incomeProfitLoss"
    :web_view="$webView"
    title="other_3"
    :fillValue="$majorLawProfitLossLabels['other_3']"
    name="other_expense_name3"
></x-questionnaire.income.profitLossPopup.otherExpensesRow>
<x-questionnaire.income.profitLossPopup.otherExpensesRow
    :incomeProfitLoss="$incomeProfitLoss"
    :web_view="$webView"
    title="other_4"
    name="other_expense_name4">
</x-questionnaire.income.profitLossPopup.otherExpensesRow>