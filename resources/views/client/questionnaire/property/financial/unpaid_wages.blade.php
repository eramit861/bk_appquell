@php
$clientType = $client->client_type;
$data_for = Helper::validate_key_loop_value('data_for', $unpaid_wages, $i);
@endphp
<div class="light-gray-div unpaid_wages_mutisec unpaid_wages_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}" rowNo="{{ $i }}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Unpaid Wages Details
		</h2>

		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('unpaid_wages_mutisec', {{ $i }})">
			<i class="bi bi-pencil-square mr-1"></i>
			Edit
		</a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('unpaid_wages_mutisec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
			<div class="col-md-3">
				<label class="font-weight-bold">
					Type:
					<span class="font-weight-normal">{{ ArrayHelper::getPropertyFinancialOwedTypeArray(Helper::validate_key_loop_value('owed_type', $unpaid_wages, $i)) }}</span>
				</label>
			</div>
			<div class="col-md-2">
				<label class="font-weight-bold">
					Belongs to:
					<span class="font-weight-normal">
						@if ($clientType == 1)
							{{ ($data_for == 'debtor') ? 'Debtor' : '' }}
						@endif
						@if ($clientType == 2)
							{{ ($data_for == 'debtor') ? 'Debtor' : '' }}
							{{ ($data_for == 'codebtor') ? 'Non-Filing Spouse' : '' }}
						@endif
						@if ($clientType == 3)
							{{ ($data_for == 'debtor') ? 'Debtor' : '' }}
							{{ ($data_for == 'codebtor') ? 'Co-Debtor' : '' }}
						@endif
					</span>
				</label>
			</div>
			<div class="col-md-3">
				<label class="font-weight-bold">
					Amount you are paid monthly:
					<span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('monthly_amount', $unpaid_wages, $i)) ? Helper::validate_key_loop_value('monthly_amount', $unpaid_wages, $i) : 0.00) }}</span>
				</label>
			</div>
			<div class="col-md-3">
				<label class="font-weight-bold">
					Property Value:
					<span class="font-weight-normal">{{ (Helper::validate_key_loop_value('unknown', $unpaid_wages, $i) == 1) ? 'Unknown' : '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $unpaid_wages, $i)) ? Helper::validate_key_loop_value('property_value', $unpaid_wages, $i) : 0.00) }}</span>
				</label>
			</div>
		</div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-lg-3 col-md-4">
				<div class="label-div">
					<div class="form-group">
						<label>Owed Type</label>
						<select class="form-control unpaid_wages_owed_type required" required name="unpaid_wages[data][owed_type][{{ $i }}]">
							<option value="">Type</option>
							@foreach ($propertyFinancialOwedTypeArray as $key => $label)
							    @php $selected = ($key == Helper::validate_key_loop_value('owed_type', $unpaid_wages, $i)) ? "selected" : ""; @endphp
							    <option value="{{ $key }}" {{ $selected }}>{{ $label }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-2 col-md-4">
				<div class="label-div">
					<div class="form-group">
						<label>Belongs to:</label>
						<select class="form-control unpaid_wages_data_for required" required name="unpaid_wages[data][data_for][{{ $i }}]">
							<!-- Single Not Married -->
							@if ($clientType == 1)
								<option value="debtor" {{ ($data_for == 'debtor') ? 'selected' : '' }} selected>Debtor</option>
							@endif
							<!-- Married Not Filing Jointly -->
							@if ($clientType == 2)
								<option disabled>Select Debtor Type</option>
								<option value="debtor" {{ ($data_for == 'debtor') ? 'selected' : '' }}>Debtor</option>
								<option value="codebtor" {{ ($data_for == 'codebtor') ? 'selected' : '' }}>Non-Filing Spouse</option>
							@endif
							<!-- Married Filing Joint -->
							@if ($clientType == 3)
								<option disabled>Select Debtor Type</option>
								<option value="debtor" {{ ($data_for == 'debtor') ? 'selected' : '' }}>Debtor</option>
								<option value="codebtor" {{ ($data_for == 'codebtor') ? 'selected' : '' }}>Co-Debtor</option>
							@endif
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-4">
				<div class="label-div">
					<div class="form-group">
						<label>Amount you are paid monthly</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="unpaid_wages[data][monthly_amount][{{ $i }}]" class="price-field form-control required unpaid_wages_monthly_amount"
								placeholder="Current value" value="{{ Helper::validate_key_loop_value('monthly_amount', $unpaid_wages, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="label-div">
					<div class="form-group">
						<div class="form-check mb-0 px-0">
							<label class="mb-0 form-check-label ">
								<span class="me-4">Total Amount owed/value</span>
								<input type="checkbox" onchange="checkUnknown(this, {{ $i }},'unpaid_wages')" value="1" class="unknown form-check-input unknown unpaid_wages_unknown" name="unpaid_wages[data][unknown][{{ $i }}]" {{ (Helper::validate_key_loop_value('unknown', $unpaid_wages, $i) == 1) ? 'checked=checked' : '' }}>
								<span class="">Unknown</span>
							</label>
						</div>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="unpaid_wages[data][property_value][{{ $i }}]" class="price-field form-control {{ (Helper::validate_key_loop_value('unknown', $unpaid_wages, $i) == 1) ? '' : 'required' }} unpaid_wages_property_value is_unpaid_wages_unknown_{{ $i }}"
								placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $unpaid_wages, $i) }}"
								{{ (Helper::validate_key_loop_value('unknown', $unpaid_wages, $i) == 1) ? 'disabled=true' : '' }}>
						</div>
					</div>
				</div>
			</div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('unpaid_wages','unpaid_wages_mutisec', 'unpaid_wages_data', 'parent_unpaid_wages', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>