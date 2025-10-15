<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9">
    <div class="label-div">
        <input type="text" class="h20 form-control other_expenses required" name="income_profit_loss[{{$name}}]" value="{{ empty(Helper::validate_key_value($name, $incomeProfitLoss)) ? @$fillValue : Helper::validate_key_value($name, $incomeProfitLoss) }}" placeholder="Add in other expense(s)"/>
    </div>
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3">
    <div class="form-group-none label-div other-expense-div">
        <div class="input-group mb-0">
            <span class="input-group-text">$</span>
            <input type="number" class="price-field form-control expense h20 income-price-field form-control required" name="income_profit_loss[{{$title}}]" value="{{ Helper::validate_key_value($title, $incomeProfitLoss, 'float') }}" />
        </div>
    </div>
</div>