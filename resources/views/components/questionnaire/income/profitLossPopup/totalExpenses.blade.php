<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 {{ $majorLawProfitLossLabels['labels'] == false ? 'hide-data' : '' }}">
    <div class="dotted-label-div label-div">
        <label>Total Operating Expenses</label>
        <span></span>
    </div>
</div>
<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 {{ $majorLawProfitLossLabels['labels'] == true ? 'hide-data' : '' }}">
    <div class="dotted-label-div label-div">
        <label>{{ $majorLawProfitLossLabels['total_monthly_expenses'] }}</label>
        <span></span>
    </div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 ">
    <div class="form-group-none label-div">
        <div class="input-group mb-0">
            <span class="input-group-text">$</span>
            <input type="number" class="price-field form-control total-expense income-price-field h20 required"
                name="income_profit_loss[total_expense]"
                value="{{ Helper::validate_key_value('total_expense', $incomeProfitLoss, 'float') }}" />
        </div>
    </div>
</div>

<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 {{ $majorLawProfitLossLabels['labels'] == false ? 'hide-data' : '' }}">
    <div class="dotted-label-div label-div">
        <label>Profit and/or Loss from Business</label>
        <span></span>
    </div>
</div>
<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 {{ $majorLawProfitLossLabels['labels'] == true ? 'hide-data' : '' }} ">
    <div class="dotted-label-div label-div">
        <label>{{ $majorLawProfitLossLabels['net_monthly_income'] }}</label>
        <span></span>
    </div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 ">
    <div class="form-group-none label-div">
        <div class="input-group mb-0">
            <span class="input-group-text">$</span>
            <input type="number" class="price-field form-control total-profit-loss h20 income-price-field required"
                name="income_profit_loss[total_profit_loss]"
                value="{{ Helper::validate_key_value('total_profit_loss', $incomeProfitLoss, 'float') }}" />
        </div>
    </div>
</div>
