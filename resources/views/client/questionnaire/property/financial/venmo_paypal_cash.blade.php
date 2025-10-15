@php
$clientType = $client->client_type;
$accType = Helper::validate_key_loop_value('account_type', $venmo_paypal_cash, $i);
$description = Helper::validate_key_loop_value('description', $venmo_paypal_cash, $i);
$propValue = Helper::validate_key_loop_value('property_value', $venmo_paypal_cash, $i);
$web_view = Session::get('web_view');
@endphp
<div class="light-gray-div venmo-paypal-cash-mainsec venmo-paypal-cash-mainsec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Account Details
		</h2>
		<input type="hidden" name="venmo_paypal_cash[data][last_4_digits][{{ $i }}]" class="last_4_digits" value="">
		
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('venmo-paypal-cash-mainsec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('venmo-paypal-cash-mainsec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-md-3 col-sm-6 col-12">
                <label class="font-weight-bold">
					Type Of Account:
                    <span class="font-weight-normal">
						{{ ArrayHelper::getAccountKeyValue($accType) }}
					</span>
                </label>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <label class="font-weight-bold">
					Belongs to:
                    <span class="font-weight-normal">{{ $description }}</span>
                </label>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <label class="font-weight-bold">
					Property Value:
                    <span class="font-weight-normal">{{ '$ '. (!empty($propValue) ? $propValue : 0.00) }}</span>
                </label>
            </div>
			
			<div class="col-12">
				@include("client.questionnaire.property.financial.common_video_div_venmo_paypal_cash")
			</div>
			
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			
			<div class="col-md-3">
				<div class="label-div">
					<div class="form-group">
						<label> Type of account:</label>
						<select class="form-control required account_type" name="venmo_paypal_cash[data][account_type][{{ $i }}]"
							onfocus="storePreviousValue(this)"
							onchange="selectVPCAccount(this)"
							data-previousvalue=''
							data-index='{{ $i }}'>
							<option value="paypal_account_1" {{ ($accType == 'paypal_account_1') ? 'selected' : '' }}>PayPal - Account 1</option>
							<option value="paypal_account_2" {{ ($accType == 'paypal_account_2') ? 'selected' : '' }}>PayPal - Account 2</option>
							<option value="paypal_account_3" {{ ($accType == 'paypal_account_3') ? 'selected' : '' }}>PayPal - Account 3</option>
							<option value="cash_account_1" {{ ($accType == 'cash_account_1') ? 'selected' : '' }}>Cash App – Account 1</option>
							<option value="cash_account_2" {{ ($accType == 'cash_account_2') ? 'selected' : '' }}>Cash App – Account 2</option>
							<option value="cash_account_3" {{ ($accType == 'cash_account_3') ? 'selected' : '' }}>Cash App – Account 3</option>
							<option value="venmo_account_1" {{ ($accType == 'venmo_account_1') ? 'selected' : '' }}>Venmo – Account 1</option>
							<option value="venmo_account_2" {{ ($accType == 'venmo_account_2') ? 'selected' : '' }}>Venmo – Account 2</option>
							<option value="venmo_account_3" {{ ($accType == 'venmo_account_3') ? 'selected' : '' }}>Venmo – Account 3</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-md-3">
				<div class="label-div">
					<div class="form-group">
						<label> Account belongs to:</label>
						<select class="form-control description required" name="venmo_paypal_cash[data][description][{{ $i }}]">
							<!-- Single Not Married -->
							@if ($clientType == 1)
								<option value="Debtor" {{ ($description == 'Debtor') ? 'selected' : '' }} selected>Debtor</option>
							@endif
							<!-- Married Not Filing Jointly -->
							@if ($clientType == 2)
								<option disabled>Select Debtor Type</option>
								<option value="Debtor" {{ ($description == 'Debtor') ? 'selected' : '' }}>Debtor</option>
								<option value="Non-Filing Spouse" {{ ($description == 'Non-Filing Spouse') ? 'selected' : '' }}>Non-Filing Spouse</option>
							@endif
							<!-- Married Filing Joint -->
							@if ($clientType == 3)
								<option disabled>Select Debtor Type</option>
								<option value="Debtor" {{ ($description == 'Debtor') ? 'selected' : '' }}>Debtor</option>
								<option value="Co-Debtor" {{ ($description == 'Co-Debtor') ? 'selected' : '' }}>Co-Debtor</option>
							@endif
						</select>
					</div>
				</div>
			</div>


			<div class="col-lg-4 col-md-6">
				<div class="label-div">
					<div class="form-group">
						<label>Average Balance of the account:</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" name="venmo_paypal_cash[data][property_value][{{ $i }}]" class="price-field form-control required property_value"
								placeholder="Property value" value="{{ $propValue }}">
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-8">
				@include("client.questionnaire.property.financial.common_video_div_venmo_paypal_cash")
			</div>

            <div class="col-12 col-lg-4 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('venmo_paypal_cash','venmo-paypal-cash-mainsec', 'account_items_data', 'parent_venmo_paypal_cash', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>