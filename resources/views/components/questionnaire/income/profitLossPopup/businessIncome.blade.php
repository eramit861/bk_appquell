<div class="col-md-12">
    <div class="label-div question-area border-0">
        <input type="hidden" id="profit_type_selection" name="income_profit_loss[profit_loss_type]" value="2">
        <input type="hidden" name="existing_type" value="2">
        <div class="row">
            <div class="col-12 col-md-9">
                <div class="label-div">
                    <label for="">Company Name</label>
                    <input type="text" class="form-control required input_capitalize" value="{{ Helper::validate_key_value('name_of_business', $incomeProfitLoss) }}" name="income_profit_loss[name_of_business]" placeholder="{{ __('Name of Business') }}" />
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="label-div selected-months">
                    <label for="">For Month</label>
                    <select class=" profit-loss-months form-control required  no-border-elements "
                        onchange="{{$onchangeMonthFunction}}"
                        id="date_selections"
                        name="income_profit_loss[profit_loss_month]">
                        <option disabled="">{{ __('Select Month') }}</option>
                        @foreach($months as $key => $month)
                            <option value="{{ $key }}" @if(Helper::validate_key_value('profit_loss_month', $incomeProfitLoss) == $key) selected @endif>{{ $month }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>