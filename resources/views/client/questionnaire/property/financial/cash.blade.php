<div class="light-gray-div cash_mutisec cash_mutisec_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>&nbsp;Cash</h2>

		<a href="javascript:void(0)" class="client-edit-button " onclick="edit_div_common('cash_mutisec', {{ $i }})">
			<i class="bi bi-pencil-square mr-1"></i>
			Edit
		</a>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
			<div class="col-12">
				<label class="font-weight-bold">
					Cash on hand:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('property_value', $cash, $i)) ? Helper::validate_key_loop_value('property_value', $cash, $i) : 0.00 }}</span>
				</label>
			</div>
		</div>
		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Cash on hand</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" name="cash[data][property_value][{{ $i }}]" class="price-field form-control required cash_property_value"
								placeholder="Cash on hand" value="{{ Helper::validate_key_loop_value('property_value', $cash, $i) }}">
						</div>
					</div>
				</div>
			</div>
            <div class="col-12  text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('cash','cash_mutisec', 'cash_items_data', 'parent_cash', {{ $i }})">Save</a>
            </div>
		</div>

	</div>
</div>