<div class="light-gray-div form-main payment_past_one_year payment_past_one_year_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Payment Details
		</h2>

		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('payment_past_one_year', {{ $i }})">
			<i class="bi bi-pencil-square mr-1"></i>
			Edit
		</a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('payment_past_one_year', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<label class="font-weight-bold">
					Name:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_address_past_one_year', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<label class="font-weight-bold">
					Address:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_street_past_one_year', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<label class="font-weight-bold">
					City:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_city_past_one_year', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<label class="font-weight-bold">
					State:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_state_past_one_year', $finacial_affairs, $i) }}</span>
				</label>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<label class="font-weight-bold">
					Zip code:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_zip_past_one_year', $finacial_affairs, $i) }}</span>
				</label>
			</div>

			<div class="col-xl-3 col-md-12 col-sm-6 col-12">
				<label class="font-weight-bold">
					Dates of Payment:
					<span class="font-weight-normal">
						{{ Helper::validate_key_loop_value("past_one_year_payment_dates", $finacial_affairs, $i) }}
						{{ !empty(Helper::validate_key_loop_value("past_one_year_payment_dates2", $finacial_affairs, $i)) ? ', '.Helper::validate_key_loop_value("past_one_year_payment_dates2", $finacial_affairs, $i) : '' }}
						{{ !empty(Helper::validate_key_loop_value("past_one_year_payment_dates3", $finacial_affairs, $i)) ? ', '.Helper::validate_key_loop_value("past_one_year_payment_dates3", $finacial_affairs, $i) : '' }}
					</span>
				</label>
			</div>
			<div class="col-xl-3 col-md-6 col-sm-6 col-12">
				<label class="font-weight-bold">
					Total Amount Paid:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('past_one_year_total_amount_paid', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('past_one_year_total_amount_paid', $finacial_affairs, $i) : '0.00' }}</span>
				</label>
			</div>
			<div class="col-xl-3 col-md-6 col-sm-6 col-12">
				<label class="font-weight-bold">
					Amount Still Owed:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('past_one_year_amount_still_owed', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('past_one_year_amount_still_owed', $finacial_affairs, $i) : '0.00' }}</span>
				</label>				
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<label class="font-weight-bold">
					Reason for payment:
					<span class="font-weight-normal">{{ Helper::validate_key_loop_value('past_one_year_payment_reason', $finacial_affairs, $i) }}</span>
				</label>
			</div>

		</div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Name and Address of Creditor</label>
						<input type="text" name="past_one_year_data[creditor_address_past_one_year][{{$i}}]" class="input_capitalize form-control required creditor_address_past_one_year" placeholder="Name and Address of Creditor" value="{{ Helper::validate_key_loop_value('creditor_address_past_one_year', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<div class="label-div">
					<div class="form-group ">
						<label>Street Address</label>
						<input type="text" name="past_one_year_data[creditor_street_past_one_year][{{$i}}]" class="input_capitalize form-control required creditor_street_past_one_year" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('creditor_street_past_one_year', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control required creditor_city_past_one_year" name="past_one_year_data[creditor_city_past_one_year][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('creditor_city_past_one_year', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>State</label>
						<select class="form-control required creditor_state_past_one_year" name="past_one_year_data[creditor_state_past_one_year][{{$i}}]">
							<option value="">Please Select State</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['creditor_state_past_one_year'][$i]) !!}
						</select>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>Zip code</label>
						<input type="number" class="form-control allow-5digit required creditor_zip_past_one_year" name="past_one_year_data[creditor_zip_past_one_year][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('creditor_zip_past_one_year', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="date-column col-lg-2 col-md-4 col-sm-6 col-12">
				<label> Dates of Payment</label>
				<div class="label-div">
					<div class="form-group">
						<input type="text" placeholder="MM/YYYY" class="form-control date_month_year past_one_year_payment_dates" name="past_one_year_data[past_one_year_payment_dates][{{$i}}]" value="{{ Helper::validate_key_loop_value('past_one_year_payment_dates', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="date-column col-lg-2 col-md-4 col-sm-6 col-12">
				<label> Dates of Payment</label>
				<div class="label-div">
					<div class="form-group">
						<input type="text" placeholder="MM/YYYY" class="form-control date_month_year past_one_year_payment_dates2" name="past_one_year_data[past_one_year_payment_dates2][{{$i}}]" value="{{ Helper::validate_key_loop_value('past_one_year_payment_dates2', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="date-column col-lg-2 col-md-4 col-sm-6 col-12">
				<label> Dates of Payment</label>
				<div class="label-div">
					<div class="form-group">
						<input type="text" placeholder="MM/YYYY" class="form-control date_month_year past_one_year_payment_dates3" name="past_one_year_data[past_one_year_payment_dates3][{{$i}}]" value="{{ Helper::validate_key_loop_value('past_one_year_payment_dates3', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
				<label>Total Amount Paid</label>
				<div class="label-div">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required past_one_year_total_amount_paid" name="past_one_year_data[past_one_year_total_amount_paid][{{$i}}]" value="{{ Helper::validate_key_loop_value('past_one_year_total_amount_paid', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
				<label>Amount Still Owed</label>
				<div class="label-div">
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required past_one_year_amount_still_owed" name="past_one_year_data[past_one_year_amount_still_owed][{{$i}}]" value="{{ Helper::validate_key_loop_value('past_one_year_amount_still_owed', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 col-12">
				<label>Reason for payment</label>
				<div class="label-div">
					<div class="form-group">
						<textarea row="2" class="input_capitalize form-control required past_one_year_payment_reason h-unset" name="past_one_year_data[past_one_year_payment_reason][{{$i}}]">{{ Helper::validate_key_loop_value('past_one_year_payment_reason', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			
			<div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('past_one_year_data','payment_past_one_year', 'payment-past-one-year-data', 'parent_payment_past_one_year', {{ $i }})">Save</a>
			</div>

		</div>
	</div>
</div>