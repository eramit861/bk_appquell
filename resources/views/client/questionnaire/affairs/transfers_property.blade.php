@php
$paidValue = Helper::validate_key_loop_value('total_amount_paid_transfers_property',$finacial_affairs,$i);
$owedValue = Helper::validate_key_loop_value('amount_still_owed_transfers_property',$finacial_affairs,$i);
@endphp

<div class="light-gray-div form-main transfers_property transfers_property_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Payment Details
		</h2>
		
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('transfers_property', {{ $i }})">
			<i class="bi bi-pencil-square mr-1"></i>
			Edit
		</a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('transfers_property', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section @isset($isEmpty) @if($isEmpty) hide-data @endif @endisset">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<label class="font-weight-bold">
					Name:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_address_transfers_property', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<label class="font-weight-bold">
					Address:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_street_transfers_property', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<label class="font-weight-bold">
					City:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_city_transfers_property', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<label class="font-weight-bold">
					State:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_state_transfers_property', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<label class="font-weight-bold">
					Zip code:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_zip_transfers_property', $finacial_affairs, $i) }}</span>
				</label>
			</div>

			<div class="col-xl-6 col-md-12 col-sm-6 col-12">
				<label class="font-weight-bold">
					Dates of Payment:
					<span class="font-weight-normal">
						{{ Helper::validate_key_loop_value("payment_dates_transfers_property", $finacial_affairs, $i)}}
						{{ !empty(Helper::validate_key_loop_value("payment_dates_transfers_property2", $finacial_affairs, $i)) ? ', '.Helper::validate_key_loop_value("payment_dates_transfers_property2", $finacial_affairs, $i) : ''}}
						{{ !empty(Helper::validate_key_loop_value("payment_dates_transfers_property3", $finacial_affairs, $i)) ? ', '.Helper::validate_key_loop_value("payment_dates_transfers_property3", $finacial_affairs, $i) : ''}}
					</span>
				</label>
			</div>
			<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-6 col-12">
				<label class="font-weight-bold">
					Total Amount Paid:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('total_amount_paid_transfers_property', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('total_amount_paid_transfers_property', $finacial_affairs, $i) : '0.00' }}</span>
				</label>
			</div>
			<div class="col-xxl-3 col-xl-4 col-md-6 col-sm-6 col-12">
				<label class="font-weight-bold">
					Amount Still Owed:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('amount_still_owed_transfers_property', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('amount_still_owed_transfers_property', $finacial_affairs, $i) : '0.00' }}</span>
				</label>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<label class="font-weight-bold">
					Reason for payment:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('payment_reason_transfers_property', $finacial_affairs, $i) }}</span>
				</label>
			</div>

		</div>

		<div class="row gx-3 edit_section @isset($isEmpty) @if($isEmpty) @else hide-data @endif @else hide-data @endisset">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Name and Address of Creditor</label>
						<input type="text" name="transfers_property_data[creditor_address_transfers_property][{{$i}}]" class="input_capitalize form-control required creditor_address_transfers_property" placeholder="Name and Address of Creditor" value="{{ Helper::validate_key_loop_value('creditor_address_transfers_property', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<div class="label-div">
					<div class="form-group ">
						<label>Street Address</label>
						<input type="text" name="transfers_property_data[creditor_street_transfers_property][{{$i}}]" class="input_capitalize form-control required creditor_street_transfers_property" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('creditor_street_transfers_property', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control required creditor_city_transfers_property" name="transfers_property_data[creditor_city_transfers_property][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('creditor_city_transfers_property', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>State</label>
						<select class="form-control required creditor_state_transfers_property" name="transfers_property_data[creditor_state_transfers_property][{{$i}}]">
							<option disabled="">Please Select State or Territory</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['creditor_state_transfers_property'][$i]) !!}
						</select>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>Zip code</label>
						<input type="number" class="form-control allow-5digit required creditor_zip_transfers_property" name="transfers_property_data[creditor_zip_transfers_property][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('creditor_zip_transfers_property', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="date-column col-lg-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Dates of Payment</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed  payment_dates_transfers_property" name="transfers_property_data[payment_dates_transfers_property][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_dates_transfers_property', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="date-column col-lg-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Dates of Payment</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed  payment_dates_transfers_property2" name="transfers_property_data[payment_dates_transfers_property2][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_dates_transfers_property2', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="date-column col-lg-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Dates of Payment</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed  payment_dates_transfers_property3" name="transfers_property_data[payment_dates_transfers_property3][{{$i}}]" value="{{ Helper::validate_key_loop_value('payment_dates_transfers_property3', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Total Amount Paid</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required total_amount_paid_transfers_property" name="transfers_property_data[total_amount_paid_transfers_property][{{$i}}]" value="{{ $paidValue }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Amount Still Owed</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required amount_still_owed_transfers_property" name="transfers_property_data[amount_still_owed_transfers_property][{{$i}}]" value="{{ $owedValue }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-12">
				<label>Reason for payment <i>(include the creditor's name)</i></label>
				<div class="label-div">
					<div class="form-group">
						<textarea rows="2" class="input_capitalize form-control required payment_reason_transfers_property h-unset" name="transfers_property_data[payment_reason_transfers_property][{{$i}}]">{{ Helper::validate_key_loop_value('payment_reason_transfers_property', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			
			<div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('transfers_property','transfers_property', 'transfers-property-data', 'parent_transfers_property', {{ $i }})">Save</a>
			</div>
		</div>
	</div>
</div>