<div class="form-main @if($i > 0) mt-3 @endif w-100 primarily_consumer_debets" id="primarily-consumer-debets-1">
	<div class="row form-cstm-row align-items-unset">
		@php $inc = $i + 1; @endphp
		
		
	{{-- echo"<pre>";print_r($finacial_affairs);echo "</pre>"; --}}
		<div class="col-lg-3 col-md-5">
			<div class="form-group">
				<label><span class="font-weight-bold sr_no">{{$inc}}</span><b>.</b> Name and Address of Creditor</label>
				<input type="text" name="primarily_consumer_debets_data[creditor_address][{{$i}}]" class="input_capitalize creditor_address form-control required"	placeholder="Name and Address of Creditor" value="{{ Helper::validate_key_loop_value('creditor_address', $finacial_affairs, $i) }}">
			</div>
		</div>
		<div class="col-lg-3 col-md-5">
			<div class="form-group ">
				<label>
					Street Address
				</label>
				<input type="text" name="primarily_consumer_debets_data[creditor_street][{{$i}}]" class="input_capitalize form-control creditor_street required" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}">
			</div>
		</div>
		<div class="col-lg-2 col-md-2 col-6">
			<div class="form-group">
				<label>City</label>
				<input type="text" class="input_capitalize form-control creditor_city required" name="primarily_consumer_debets_data[creditor_city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}">
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-6">
			<div class="form-group">
				<label>State</label>
	                <select class="form-control required creditor_state" name="primarily_consumer_debets_data[creditor_state][{{$i}}]">
	                   <option value="">Please Select State</option>
						{!! AddressHelper::getStatesList(@$finacial_affairs['creditor_state'][$i]) !!}
	                </select>
            </div>
		</div>
		<div class="col-lg-1 col-md-2 col-6">
			<div class="form-group">
				<label>Zip</label>
				<input type="number" class="form-control allow-5digit creditor_zip required" name="primarily_consumer_debets_data[creditor_zip][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}">
			</div>
		</div>


		<div class=" col-md-2 col-6">
			<div class="form-group">
				<label>Payment amount</label>
				<div class="input-group mb-0">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input data-mainarray="primarily_consumer_debets_data" type="number" placeholder="Payment" data-index="{{$i}}" class="form-control price-field payment_1" name="primarily_consumer_debets_data[payment_1][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_1', $finacial_affairs, $i) }}">
				</div>
				@php $monthBeforeLast = !empty(Helper::validate_key_loop_value('payment_dates', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('payment_dates', $finacial_affairs, $i) : $monthBeforeLast; @endphp
				<small class="font-weight-bold font-italic">
					Payment date: {{ $monthBeforeLast }}
					<input type="hidden" name="primarily_consumer_debets_data[payment_dates][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_dates', $finacial_affairs, $i) ?? $monthBeforeLast }}">
				</small>
			</div>
		</div>
		<div class=" col-md-2 col-6">
			<div class="form-group">
				<label>Payment amount</label>
				<div class="input-group mb-0">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input data-mainarray="primarily_consumer_debets_data" type="number" placeholder="Payment" data-index="{{$i}}" class="form-control price-field payment_2" name="primarily_consumer_debets_data[payment_2][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_2', $finacial_affairs, $i) }}">
				</div>
				@php $lastMonth = !empty(Helper::validate_key_loop_value('payment_dates2', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('payment_dates2', $finacial_affairs, $i) : $lastMonth; @endphp
				<small class="font-weight-bold font-italic">
					Payment date: {{ $lastMonth }}
					<input type="hidden" name="primarily_consumer_debets_data[payment_dates2][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_dates2', $finacial_affairs, $i) ?? $lastMonth }}">
				</small>
			</div>
		</div>
		<div class=" col-md-2 col-6">
			<div class="form-group">
				<label>Payment amount</label>
				<div class="input-group mb-0">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input data-mainarray="primarily_consumer_debets_data" type="number" placeholder="Payment" data-index="{{$i}}" class="form-control price-field payment_3" name="primarily_consumer_debets_data[payment_3][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_3', $finacial_affairs, $i) }}">
				</div>
				@php $currentMonth = !empty(Helper::validate_key_loop_value('payment_dates3', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('payment_dates3', $finacial_affairs, $i) : $currentMonth; @endphp
				<small class="font-weight-bold font-italic">
					Payment date: {{ $currentMonth }}
					<input type="hidden" name="primarily_consumer_debets_data[payment_dates3][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_dates3', $finacial_affairs, $i) ?? $currentMonth }}">
				</small>
			</div>
		</div>
		<div class="col-lg-2 col-md-3">
			<div class="form-group">
				<label>Total Amount Paid</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					</div>
					<input type="number" class="form-control price-field required total_amount_paid" readonly name="primarily_consumer_debets_data[total_amount_paid][{{$i}}]" value="{{ Helper::validate_key_loop_value('total_amount_paid', $finacial_affairs, $i) }}">
				</div>
			</div>
		</div>
		<div class="col-lg-2 col-md-3">
			<div class="form-group">
			<label>Amount Still Owed</label>
			<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text" id="basic-addon1">$</span>
					 </div>
				<input type="number"     class="form-control price-field required amount_still_owed" name="primarily_consumer_debets_data[amount_still_owed][{{$i}}]" value="{{ Helper::validate_key_loop_value('amount_still_owed', $finacial_affairs, $i) }}">
			</div>
			</div>
		</div>

		<div class="col-md-12">
			<label>Was this payment for</label>
			<div class="form-group">
				<div class="d-inline radio-primary ">
					<input type="radio" id="payment-mortgage" class="creditor_payment_for"
						name="primarily_consumer_debets_data[creditor_payment_for][{{$i}}]" value="1" required {!! Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairs, 1, $i) !!}>
					<label 
						class="cr">Mortgage</label>
				</div>
				<div class="d-inline radio-primary ">
					<input type="radio" id="payment-car" class="creditor_payment_for"
						name="primarily_consumer_debets_data[creditor_payment_for][{{$i}}]" value="2" required {!! Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairs, 2, $i) !!}>
					<label  class="cr">Car</label>
				</div>
				<div class="d-inline radio-primary ">
					<input type="radio" id="payment-credit-card" class="creditor_payment_for"
						name="primarily_consumer_debets_data[creditor_payment_for][{{$i}}]" value="3" required {!! Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairs, 3, $i) !!}>
					<label 
						class="cr">Credit card</label>
				</div>
				<div class="d-inline radio-primary ">
					<input type="radio" id="payment-loan-repayment" class="creditor_payment_for"
						name="primarily_consumer_debets_data[creditor_payment_for][{{$i}}]" value="4" required {!! Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairs, 4, $i) !!}>
					<label 
						class="cr">Loan repayment</label>
				</div>
				<div class="d-inline radio-primary ">
					<input type="radio"
						id="payment-suppliers_vendor" class="creditor_payment_for"
						name="primarily_consumer_debets_data[creditor_payment_for][{{$i}}]" value="5" required {!! Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairs, 5, $i) !!}>
					<label 
						class="cr">Suppliers or vendor</label>
				</div>
				<div class="d-inline radio-primary ">
					<input type="radio" id="payment-other" class="creditor_payment_for"
						name="primarily_consumer_debets_data[creditor_payment_for][{{$i}}]" value="6" required {!! Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairs, 6, $i) !!}>
					<label 
						class="cr">Other</label>
				</div>
			</div>
		</div>
	</div>
</div>
