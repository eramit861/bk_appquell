<div class="col-12 {{ $majorLawProfitLossLabels['labels'] == true ? 'hide-data' : '' }}">
    <p class="text-bold text-center  w-100">
        <span class="text-danger">(Note: ONLY INCLUDE information directly related to the business operation. DO NOT include personal income or expenses)</span>
    </p>
</div>

<div class="col-md-12 {{ $majorLawProfitLossLabels['labels'] == false ? 'hide-data' : '' }}">
    <div class="light-gray-box-tittle-div mb-2 mt-3">
        <h2>Income</h2>
    </div>
</div>

<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9">
    <div class="dotted-label-div label-div">
        <label>{{$majorLawProfitLossLabels[Helper::GROSS_BUSINESS_INCOME]}}</label>
        <span></span>
    </div>
    <small class="hide-on-mobile dotted-label-div-small text-c-blue {{ $majorLawProfitLossLabels['labels'] == false ? 'hide-data' : '' }}">(You can get this amount from your Additions and/or total deposits from bank statement(s))</small>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3">
    <div class="form-group-none label-div">
        <div class="input-group mb-0">
            <span class="input-group-text">$</span>
            <input type="number" class="price-field form-control income h20 income-price-field form-control required" name="income_profit_loss[gross_business_income]" value="{{ Helper::validate_key_value('gross_business_income', $incomeProfitLoss, 'float') }}" />
        </div>
    </div>
</div>
<div class="col-12">
    <small class="hide-on-desktop dotted-label-div-small text-c-blue {{ $majorLawProfitLossLabels['labels'] == false ? 'hide-data' : '' }}">(You can get this amount from your Additions and/or total deposits from bank statement(s))</small>
</div>
