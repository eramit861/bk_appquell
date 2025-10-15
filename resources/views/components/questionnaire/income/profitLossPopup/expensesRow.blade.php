<div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9">
    <div class="dotted-label-div label-div">
        <label>{{$title}}</label>
        <span></span>
    </div>
    @if(!empty($subLabel))
        <small class="hide-on-mobile dotted-label-div-small text-c-blue">{!! $subLabel !!}</small>
    @endif
</div>
<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3">
    <div class="form-group-none label-div">
        <div class="input-group mb-0">
            <span class="input-group-text">$</span>
            <input type="number" class="price-field form-control expense h20 income-price-field form-control required" name="income_profit_loss[{{$name}}]" value="{{ Helper::validate_key_value($name, $incomeProfitLoss, 'float') }}" />
        </div>
    </div>
</div>
@if(!empty($subLabel))
    <div class="col-12">
        <small class="hide-on-desktop dotted-label-div-small text-c-blue">{!! $subLabel !!}</small>
    </div>
@endif