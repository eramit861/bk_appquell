@if ($hiddenInputs)
	<input type="hidden" name="traded_stocks[data][description][{{ $i }}]" class="input_capitalize form-control required traded_stocks_description"
		placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $traded_stocks, $i) }}">
	<input type="hidden" name="traded_stocks[data][type_of_account][{{ $i }}]" class="form-control required traded_stocks_type_of_account"
		placeholder="% of ownership" value="{{ Helper::validate_key_loop_value('type_of_account', $traded_stocks, $i) }}">
	<input type="hidden" name="traded_stocks[data][property_value][{{ $i }}]"     class="price-field form-control  required traded_stocks_property_value"
		placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $traded_stocks, $i) }}">
@endif
@if (!$hiddenInputs)
<div class="col-md-12 traded_stocks_mutisec">
	<div class="row">
		<div class="col-md-6">
		<div class="label-div">
				<div class="form-group">
					<label>Name of entity
					</label>
					<input type="text" name="traded_stocks[data][description][{{ $i }}]" class="input_capitalize form-control required traded_stocks_description"
						placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $traded_stocks, $i) }}">
				</div>
			</div>
		</div>
		<div class="col-md-3">
		<div class="label-div">
			<div class="form-group">
				<label>% of ownership
				</label>
				<div class="input-group">
					<input type="text" name="traded_stocks[data][type_of_account][{{ $i }}]" class="form-control required traded_stocks_type_of_account"
						placeholder="% of ownership" value="{{ Helper::validate_key_loop_value('type_of_account', $traded_stocks, $i) }}">
						<span class="input-group-text percent">%</span>
				</div>
			</div>
		</div>
		</div>
		<div class="col-md-3">
		<div class="label-div">
			<div class="form-group">
				<label>Value of interest in company</label>
				<div class="input-group">
						<span class="input-group-text">$</span>
					<input type="number" name="traded_stocks[data][property_value][{{ $i }}]"     class="price-field form-control  required traded_stocks_property_value"
						placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $traded_stocks, $i) }}">
				</div>
			</div>
		</div>
		</div>
	</div>
</div>
@endif