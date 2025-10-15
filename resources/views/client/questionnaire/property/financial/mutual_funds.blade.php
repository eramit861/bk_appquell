<div class="light-gray-div mutual_funds_mutisec mutual_funds_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Details
			<i class="bi bi-patch-question-fill ms-2" onclick="openPopup('mutual-fund-popup')"></i>
		</h2>
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('mutual_funds_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('mutual_funds_mutisec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                <label class="font-weight-bold">
					Institution or issuer name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $mutual_funds, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                <label class="font-weight-bold">
					Property Value:
                    <span class="font-weight-normal">{{ (Helper::validate_key_loop_value('unknown', $mutual_funds, $i) == 1) ? 'Unknown' : '$ '. (!empty(Helper::validate_key_loop_value('property_value', $mutual_funds, $i)) ? Helper::validate_key_loop_value('property_value', $mutual_funds, $i) : 0.00) }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
				<div class="label-div">
					<div class="form-group">
						<label>Institution or issuer name:
						</label>
						<input type="text" name="mutual_funds[data][description][{{ $i }}]" class="input_capitalize form-control required mutual_funds_description"
							placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $mutual_funds, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
				<div class="label-div">
					<div class="form-group">
						<div class="form-check mb-0 px-0">
							<label class="mb-0 form-check-label ">
								<span class="me-4">Property Value</span>
								<input class=" form-check-input mutual_funds_unknown unknown" name="mutual_funds[data][unknown][{{ $i }}]" value="1" type="checkbox" onchange="checkUnknown(this, {{ $i }},'mutual')" {{ (Helper::validate_key_loop_value('unknown', $mutual_funds, $i) == 1) ? 'checked=checked' : '' }}>
								<span class="">Unknown</span>
							</label>
						</div>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">$</span>
							<input type="number" name="mutual_funds[data][property_value][{{ $i }}]" class="price-field form-control {{ (Helper::validate_key_loop_value('unknown', $mutual_funds, $i) == 1) ? '' : 'required' }} mutual_funds_property_value is_mutual_unknown_{{ $i }}"
								placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $mutual_funds, $i) }}"
								{{ (Helper::validate_key_loop_value('unknown', $mutual_funds, $i) == 1) ? 'disabled=true' : '' }}>
						</div>
					</div>
				</div>
			</div>
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('mutual_funds','mutual_funds_mutisec', 'bonds_mutual_funds_items_data', 'parent_mutual_funds', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>