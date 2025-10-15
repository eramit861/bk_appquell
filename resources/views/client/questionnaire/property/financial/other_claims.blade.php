<div class="light-gray-div other_claims_mutisec other_claims_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Claim Details
			<i class="bi bi-patch-question-fill ms-2" onclick="openPopup('other-claim-popup')"></i>
		</h2>
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('other_claims_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('other_claims_mutisec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $other_claims, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                <label class="font-weight-bold">
                    Property Value:
					<span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $other_claims, $i)) ? Helper::validate_key_loop_value('property_value', $other_claims, $i) : 0.00) }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
				<div class="label-div">
					<div class="form-group">
						<label>Description</label>
						<input type="text" name="other_claims[data][description][{{ $i }}]" class="input_capitalize form-control required other_claims_description" placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $other_claims, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Property Value</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" name="other_claims[data][property_value][{{ $i }}]" class="price-field form-control required other_claims_property_value" placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $other_claims, $i) }}">
						</div>
					</div>
				</div>
			</div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('other_claims','other_claims_mutisec', 'other_claims_data', 'parent_other_claims', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>