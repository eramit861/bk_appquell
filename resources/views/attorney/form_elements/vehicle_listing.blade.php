@if (isset($vehicle['property_type']) && !empty($vehicle['property_type']))
    @php
        $vehicle_name = ArrayHelper::getVehiclesTypeArray($vehicle['property_type']);
        if (Helper::validate_key_value('property_type', $vehicle) == 6) {
            $vehicle_name = $vehicle_name . ' ' . $rerc;
            if (!$hide_docs && isset($uploadedDocuments['Other_Loan_Statement_' . $rerc])) {
                $l1 = $uploadedDocuments['Other_Loan_Statement_' . $rerc];
            }
        } else {
            $vehicle_name = $vehicle_name . ' ' . $vehi;
            if (!$hide_docs && isset($uploadedDocuments['Current_Auto_Loan_Statement_' . $vehi])) {
                $l1 = $uploadedDocuments['Current_Auto_Loan_Statement_' . $vehi];
            }
        }
    @endphp

	<div class="col-12 {{ Helper::key_hide_show_v('own_any_property', $vehicle) }}">
		<div class="row ">
			<div class="col-12 outline-gray-border-area ">
				<label class="subtitle pb-1">Vehicle Description:</label>
			</div>
			<div class="col-md-4">
				<label class="font-weight-bold font-lg-12">Type:
						<span class="section-title bg-unset border-0  font-weight-normal" style="display: contents;">{{ $vehicle_name }}</span>
				</label>
			</div>
			<div class="col-md-5 ">
				<label class="font-weight-bold ">Vin #:
					<span class="font-weight-normal">{{ strtoupper(helper::validate_key_value('vin_number', $vehicle)) }}</span></label>
			</div>
			@php $vehicle_car_loan = json_decode($vehicle['vehicle_car_loan'], 1); @endphp
			<div class="col-md-3">
				<span class="bb-1px-black font-weight-bold">Property value:</span>
				<span class="font-weight-normal section-title bg-unset border-0 " style="display: contents;">${{ number_format((float)helper::validate_key_value('property_estimated_value', $vehicle), 2, '.', ',') }}</span>
				@php
					$propertyId = Helper::validate_key_value('id', $vehicle, 'radio');
					$clientUploadedDocumentKeys = isset($client_uoloaded_documents) ? array_keys($client_uoloaded_documents) : [];
					$keyToCheck = 'Autoloan_property_value_'.$propertyId;
					$propValue = @$hide_docs == false && isset($client_uoloaded_documents[$keyToCheck]) ? $client_uoloaded_documents[$keyToCheck] : [];
				@endphp
				@if (!empty($propValue))
						<div class="font-weight-normal display-inline bradly-heading fs-18px">
							<label class="fs-18px">&nbsp;</label>
							<a href="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $keyToCheck]) }}" class="" title="Download {{ $propValue['title'] }}">
								<i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i>
							</a>
						</div>
				@endif
			</div>
			<div class="col-md-2">
				<label class="font-weight-bold ">Year:
					<span class="font-weight-normal">{{ helper::validate_key_value('property_year', $vehicle) }}</span></label>
			</div>
			<div class="col-md-2">
				<label class="font-weight-bold ">Make:
					<span class="font-weight-normal">{{ helper::validate_key_value('property_make', $vehicle) }}</span></label>
			</div>
			<div class="col-md-2">
				<label class="font-weight-bold ">Model:
					<span class="font-weight-normal">{{ helper::validate_key_value('property_model', $vehicle) }}</span></label>
			</div>
			<div class="col-md-3">
				<label class="font-weight-bold ">Style of vehicle:
					<span class="font-weight-normal">{{ helper::validate_key_value('property_other_info', $vehicle) }}</span></label>
			</div>
			<div class="col-md-3">
				<label class="font-weight-bold ">Mileage:
					<span class="font-weight-normal">{{ number_format((float)helper::validate_key_value('property_mileage', $vehicle, 'without-comma'), 0, '.', ',') }}</span></label>
			</div>
			<div class="col-md-12 mt-1">
			@php $owned_by = [1 => 'Self', 2 => 'Spouse', 3 => 'Joint', 4 => 'Other', 5 => 'Possessory interest only']; @endphp
				<label class="font-weight-bold ">Owned by:
					<span class="font-weight-normal">{{ (!empty($vehicle_car_loan['debt_owned_by'])) ? ($owned_by[$vehicle_car_loan['debt_owned_by']] ?? '') : '' }}</span>
				</label>
			</div>
			<div class="row col-md-12 sec_merger {{ helper::key_hide_show_v('loan_own_type_property', $vehicle) }}">
				<div class="col-12 outline-gray-border-area ">
					<label class="subtitle pb-1">Car Loan:</label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-bold ">Creditor name:
					<span class="font-weight-normal">{{ helper::validate_key_value('creditor_name', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-bold ">Street Address:
					<span class="font-weight-normal">{{ helper::validate_key_value('creditor_name_addresss', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-bold ">City:
					<span class="font-weight-normal">{{ helper::validate_key_value('creditor_city', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-1">
					<label class="font-weight-bold ">State:
					<span class="font-weight-normal">{{ helper::validate_key_value('creditor_state', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-2 ">
					<label class="font-weight-bold ">Zip:
					<span class="font-weight-normal">{{ helper::validate_key_value('creditor_zip', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-bold ">Account #:
					<span class="font-weight-normal">{{ helper::validate_key_value('account_number', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-3">
				@php
					$colorClass = '';
					if (isset($vehicle['retain_above_property']) && $vehicle['retain_above_property'] == 1) {
						$colorClass = 'text-c-green';
					}
					if (isset($vehicle['retain_above_property']) && $vehicle['retain_above_property'] == 0) {
						$colorClass = 'text-danger';
					}
				@endphp
					<label class="font-weight-bold">Retain Property:
						<span class="font-weight-normal {{ $colorClass }}">
							{{ Helper::key_display('retain_above_property', $vehicle) }}
						</span>
					</label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-bold ">Monthly payment:
					<span class="font-weight-normal text-danger section-title bg-unset border-0  " style="display:contents;">${{ number_format((float)helper::validate_key_value('monthly_payment', $vehicle_car_loan), 2, '.', ',') }}</span></label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-bold ">Amount owed:
					<span class="font-weight-normal text-danger section-title bg-unset border-0 " style="display:contents;">${{ number_format((float)helper::validate_key_value('amount_own', $vehicle_car_loan), 2, '.', ',') }}</span></label>
				</div>
				<div class="col-md-3 ">
					<label class="font-weight-normal ">Date incurred:
					<span class="font-weight-normal">{{ helper::validate_key_value('debt_incurred_date', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-normal ">Remaining payments:
					<span class="font-weight-normal">{{ helper::validate_key_value('payment_remaining', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-3">
					<label class="font-weight-normal ">Past due amounts:
					<span class="font-weight-normal text-underline" style="color:#D22B2B">${{ number_format((float)helper::validate_key_value('past_due_amount', $vehicle_car_loan), 2, '.', ',') }}</span></label>
				</div>
				<div class="col-md-2 text-left">
					@if (isset($l1))
						<span class="font-weight-normal bradly-heading fs-18px"><span class="bb-1px-black">Vehicle Statement:</span> <a href="{{ route('client_doc_download', ['id' => $l1['id']]) }}" class="" title="Download {{ $l1['updated_name'] }}"> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a>
					@endif
				</div>

				@php
					$vehicle_is_three_months_loan = Helper::validate_key_value('is_vehicle_three_months', $vehicle_car_loan);
					$vehicle_is_three_months_show_hide = 'hide-data';
					if ($vehicle_is_three_months_loan == 1) {
						$vehicle_is_three_months_show_hide = '';
					}
				@endphp
				<div class="col-md-12 mt-1">
					<label class="font-weight-bold ">Payments made on the above debt in the last 90 days:
					<span class="font-weight-normal">{{ Helper::key_display('is_vehicle_three_months', $vehicle_car_loan) }}</span></label>
				</div>
				<div class="col-md-6 <?php echo $vehicle_is_three_months_show_hide ?>">
					@php
						$payments = "<span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_1', $vehicle_car_loan), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_1', $vehicle_car_loan) . ")";
						$payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_2', $vehicle_car_loan), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_2', $vehicle_car_loan) . ")";
						$payments .= ", <span class='text-c-green'>$" . number_format((float)Helper::validate_key_value('payment_3', $vehicle_car_loan), 2, '.', ',') . "</span> (" . Helper::validate_key_value('payment_dates_3', $vehicle_car_loan) . ")";
					@endphp
					<label class="font-weight-bold ">Payment(s):
						<span class="font-weight-normal">{!! $payments !!}</span></label>
				</div>
				<div class="col-md-6 {{ $vehicle_is_three_months_show_hide }}">
					<label class="font-weight-bold ">Total Amount Paid:
						<span class="font-weight-normal text-c-green">${{ number_format((float)Helper::validate_key_value('total_amount_paid', $vehicle_car_loan), 2, '.', ',') }}</span></label>
				</div>
				<div class="col-md-3 mt-1">
					@php $owned_by1 = [1 => 'You', 2 => 'Spouse', 3 => 'Joint', 4 => 'Other']; @endphp
					<label class="font-weight-bold ">Person(s) Responsible/Codebtor:
						<span class="font-weight-normal">{{ (!empty($vehicle['own_by_property'])) ? ($owned_by1[$vehicle['own_by_property']] ?? '') : '' }}</span></label>
				</div>
			</div>
			@if(!$hide_docs && !empty($vehicle) && isset($vehicle['loan_own_type_property']) && $vehicle['loan_own_type_property'] == 0)
			<div class="row col-md-12 sec_merger pl-0">
				<label class="font-weight-bold text-danger ml-2">Client selected this property has no loans</label>
			</div>
			@endif

			<div class="col-md-12 {{ helper::key_hide_show_ownedby('own_by_property', $vehicle) }}">
				@if (!empty(helper::validate_key_value('codebtor_creditor_name', $vehicle)))
					<div class="row">
						<div class="col-md-12">
							<span class="section-title bg-unset border-0  font-weight-bold font-lg-12 text-lightblue" style="display: contents;">Co-Debtor Information:</span>
						</div>
						<div class="col-md-3">
							<label class="font-weight-bold ">Codebtor name:
								<span class="font-weight-normal">{{ helper::validate_key_value('codebtor_creditor_name', $vehicle) }}</span></label>
						</div>
						<div class="col-md-3">
							<label class="font-weight-bold ">Street address:
								<span class="font-weight-normal">{{ helper::validate_key_value('codebtor_creditor_name_addresss', $vehicle) }}</span></label>
						</div>
						<div class="col-md-2">
							<label class="font-weight-bold ">City:
								<span class="font-weight-normal">{{ helper::validate_key_value('codebtor_creditor_city', $vehicle) }}</span></label>
						</div>
						<div class="col-md-2">
							<label class="font-weight-bold ">State:
								<span class="font-weight-normal">{{ helper::validate_key_value('codebtor_creditor_state', $vehicle) }}</span></label>
						</div>
						<div class="col-md-2">
							<label class="font-weight-bold ">Zip:
								<span class="font-weight-normal">{{ helper::validate_key_value('codebtor_creditor_zip', $vehicle) }}</span></label>
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>

@endif