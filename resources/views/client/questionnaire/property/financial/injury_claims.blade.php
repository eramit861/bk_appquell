<div class="light-gray-div injury_claims_mutisec injury_claims_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Claim Details
		</h2>
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('injury_claims_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('injury_claims_mutisec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
			<div class="col-12 col-sm-12 col-md-2 col-lg-3 col-xxl-3">
                <label class="font-weight-bold">
					Type:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('type_of_account', $injury_claims, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xxl-6">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $injury_claims, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                <label class="font-weight-bold">
                    Property Value:
					<span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $injury_claims, $i)) ? Helper::validate_key_loop_value('property_value', $injury_claims, $i) : 0.00) }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-12 col-sm-12 col-md-2 col-lg-4 col-xxl-2">
				<div class="label-div">
					@php $potentialClaimTypes = ArrayHelper::getPotentialClaimTypes(); @endphp
					<div class="form-group">
						<label>Type</label>
						<select class="form-control required injury_claims_type_of_account" required name="injury_claims[data][type_of_account][{{ $i }}]" onchange="potentialClaimTypeChanged(this)">
							<option value="">Type</option>
							@foreach ($potentialClaimTypes as $key => $value)
								<option value="{{ $key }}" {{ Helper::validate_key_loop_value('type_of_account', $injury_claims, $i) == $key ? 'selected' : '' }}>{{ $value }}</option>
							@endforeach							
						</select>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-12 col-md-5 col-lg-4 col-xxl-7">
				<div class="label-div">
					<div class="form-group">
						<label>Description
						</label>
						<input type="text" name="injury_claims[data][description][{{ $i }}]" class="input_capitalize form-control required injury_claims_description"
							placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $injury_claims, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Property Value</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">$</span>
							</div>
							<input type="number" name="injury_claims[data][property_value][{{ $i }}]" class="price-field form-control required injury_claims_property_value"
								placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $injury_claims, $i) }}">
						</div>
					</div>
				</div>
			</div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('injury_claims','injury_claims_mutisec', 'personal_injury_data', 'parent_injury_claims', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>