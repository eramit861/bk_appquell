<div class="row list_every_addresses sub-item-radio last_three_year">
	<div class="col-md-4 col-sm-6">
		<div class="form-group ">
			<label>
				Street Address
			</label>
			<input type="text" class="input_capitalize form-control required creditor_street"
		placeholder="Street Address" name="prev_address[creditor_street][{{$i}}]" value="{{ Helper::validate_key_loop_value("creditor_street", $finacial_affairs, $i) }}">
		</div>
	</div>
	<div class="col-md-3 col-sm-6">
		<div class="form-group">
			<label>City</label>
			<input type="text" class="input_capitalize form-control required creditor_city" name="prev_address[creditor_city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value("creditor_city", $finacial_affairs, $i) }}">
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-8">
		<div class="form-group">
			<label>State</label>
			<select class="form-control required creditor_state 1" name="prev_address[creditor_state][{{$i}}]">
				<option value="">Please Select State</option>
				{!! AddressHelper::getStatesList(@$finacial_affairs['creditor_state'][$i]) !!}
			</select>
		</div>
	</div>
	<div class="col-md-2 col-sm-3 col-4">
		<div class="form-group">
			<label>Zip</label>
			<input type="number" class="form-control allow-5digit required creditor_zip" name="prev_address[creditor_zip][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value("creditor_zip", $finacial_affairs, $i) }}">
		</div>
	</div>
	<div class="col-md-2 col-sm-3 col-6">
		<label>From</label>
		<div class="form-group">
			<input 
				type="text" 
				placeholder="From Date MM/YYYY" 
				class="form-control date-validate-mm-yyyy-format required prev_address_from date_month_year_custom" 
				name="prev_address[from][{{$i}}]" 
				value="{{ Helper::validate_key_loop_value("from", $finacial_affairs, $i) }}"
				data-startinputname="prev_address[from][{{$i}}]"
				data-endinputname="prev_address[to][{{$i}}]"
			>
			<div class="error-msg italic-text text-danger small mt-1"></div>
		</div>
	</div>
	<div class="col-md-2 col-sm-3 col-6">
		<label>To</label>
		<div class="form-group">
			<input 
				type="text" 
				placeholder="To Date MM/YYYY"  
				class="form-control date-validate-mm-yyyy-format required prev_address_to date_month_year_custom" 
				name="prev_address[to][{{$i}}]" 
				value="{{ Helper::validate_key_loop_value("to", $finacial_affairs, $i) }}"
				data-startinputname="prev_address[from][{{$i}}]"
				data-endinputname="prev_address[to][{{$i}}]"
			>
			<div class="error-msg italic-text text-danger small mt-1"></div>
		</div>
	</div>
    <div class="col-md-5 col-sm-6 col-6 d-none">
        <label>Add in:</label>
        <div class="form-group">
            <div class="d-inline radio-primary ">
                <input type="radio" id="debtor_1" class="live_debtor" value="debtor 1" @if($client_type == Helper::CLIENT_TYPE_JOINT_MARRIED) checked @endif name="prev_address[debtor][{{$i}}]"  required {!! Helper::validate_key_loop_toggle('debtor', $finacial_affairs, 'debtor 1', $i) !!}>
                <label for="debtor_1" class="cr">Debtor 1</label>
            </div>
			@if($client_type == Helper::CLIENT_TYPE_JOINT_MARRIED)
			<div class="d-inline radio-primary ">
                <input type="radio" id="debtor_2" class="live_debtor" value="debtor 2"  name="prev_address[debtor][{{$i}}]" required {!! Helper::validate_key_loop_toggle('debtor', $finacial_affairs, 'debtor 2', $i) !!}>
                <label for="debtor_2" class="cr">Spouse</label>
            </div>
            <div class="d-inline radio-primary ">
                <input type="radio" id="debtor_both" class="live_debtor" value="both"  name="prev_address[debtor][{{$i}}]" required {!! Helper::validate_key_loop_toggle('debtor', $finacial_affairs, 'both', $i) !!}>
                <label for="debtor_both" class="cr">Both</label>
            </div>
			@endif
        </div>
    </div>
</div>
