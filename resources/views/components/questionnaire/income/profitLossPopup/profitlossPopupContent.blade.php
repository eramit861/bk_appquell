@php
$months = DateTimeHelper::getMonthArrayForProfitLoss(null, $attProfitLossMonths);
if (!empty($months)) {
    $saveBtnText = 'Save ' . reset($months);
} else {
    $saveBtnText = 'Save';
}
foreach ($months as $key => $month) {
    if (Helper::validate_key_value('profit_loss_month', $incomeProfitLoss) == $key) {
        $saveBtnText = 'Save ' . $month;
    }
}
@endphp
<div class="col-12">
    <div class="light-gray-div ">
        <h2 class="{{ $majorLawProfitLossLabels['labels']==false ? 'hide-data' : '' }}">Monthly Profit/Loss Statement</h2>
        <h2 class="{{ $majorLawProfitLossLabels['labels']==true ? 'hide-data' : '' }}">Business Income & Expense Worksheet</h2>
        <div class="row gx-3">
            <!-- Company Name and Month -->
            <x-questionnaire.income.profitLossPopup.businessIncome
                :incomeProfitLoss="$incomeProfitLoss"
                :onchangeFunction="$onchangeFunction"
                :onchangeMonthFunction="$onchangeMonthFunction"
                :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                :months="$months">
            </x-questionnaire.income.profitLossPopup.businessIncome>
            <!-- Income -->
            <x-questionnaire.income.profitLossPopup.incomeDetails
                :incomeProfitLoss="$incomeProfitLoss"
                :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                :web_view="$webView">
            </x-questionnaire.income.profitLossPopup.incomeDetails>
            <!-- Business Costs -->
            <x-questionnaire.income.profitLossPopup.bussinessExpenses
                :incomeProfitLoss="$incomeProfitLoss"
                :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                :web_view="$webView">
            </x-questionnaire.income.profitLossPopup.bussinessExpenses>
            <!-- Other Bussiness -->
            <x-questionnaire.income.profitLossPopup.otherBussinessExpenses
                :incomeProfitLoss="$incomeProfitLoss"
                :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                :web_view="$webView">
            </x-questionnaire.income.profitLossPopup.otherBussinessExpenses>
            <!-- Calculation -->
            <x-questionnaire.income.profitLossPopup.totalExpenses
                :incomeProfitLoss="$incomeProfitLoss"
                :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                :web_view="$webView">
            </x-questionnaire.income.profitLossPopup.totalExpenses>
            <!-- declaration -->
            <x-questionnaire.income.profitLossPopup.declaration
                :incomeProfitLoss="$incomeProfitLoss"
                :web_view="$webView"
                :basicInfoPartA="$basicInfoPartA"
                :basicInfoPartB="$basicInfoPartB"
                :majorLawProfitLossLabels="$majorLawProfitLossLabels"
                :final_date="$finalDate">
            </x-questionnaire.income.profitLossPopup.declaration>
        </div>
    </div>
    <div class="bottom-btn-div">
        <button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3" data-bs-dismiss="modal" onclick="faceboxclose()">Close</button>
        <button type="button" id="sbmt-btn" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0" onclick="{{$onclickSubmitFunction}}">{{ $saveBtnText }}</button>
    </div>
</div>