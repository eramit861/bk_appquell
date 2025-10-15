<div class="light-gray-div brokerage_account_mutisec brokerage_account_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Brokerage Account <span class="hide_mobile"> Details</span>
		</h2>
		<a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('brokerage_account_mutisec', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
		<button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('brokerage_account_mutisec', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-md-3 col-sm-6 col-12">
                <label class="font-weight-bold">
					Type Of Account:
                    <span class="font-weight-normal">Brokerage account</span>
                </label>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $brokerage_account, $i) }}</span>
                </label>
            </div>
            <div class="col-md-3 col-sm-12 col-12">
                <label class="font-weight-bold">
					Acct# <small><i>(Last 4 digits)</i></small>:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('last_4_digits', $brokerage_account, $i) }}</span>
                </label>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <label class="font-weight-bold">
					Property Value:
                    <span class="font-weight-normal">{{ '$ '. (!empty(Helper::validate_key_loop_value('property_value', $brokerage_account, $i)) ? Helper::validate_key_loop_value('property_value', $brokerage_account, $i) : 0.00) }}</span>
                </label>
            </div>
        </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-lg-3 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Type of account</label>
						<p class="form-control">Brokerage account</p>
						<input type="hidden" class="brokerage_account_property_account " name="brokerage_account[data][account_type][{{ $i }}]" value="6">
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Brokerage or Institution name:</label>
						<input type="text" name="brokerage_account[data][description][{{ $i }}]" class="input_capitalize form-control required brokerage_account_description alphanumericInput"
							placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $brokerage_account, $i) }}">
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-12 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Acct. Ending in:<small class="text-c-blue"><i>(Last 4 digits of Acct#)</i></small></label>
						<input type="text" name="brokerage_account[data][last_4_digits][{{ $i }}]" class="form-control allow-4digit-alpha-numeric required last_4_digits"
							placeholder="Enter last 4 digits of Acct #" value="{{ Helper::validate_key_loop_value('last_4_digits', $brokerage_account, $i) }}">

					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Current balance of this account:</label>
						<div class="input-group">
							<span class="input-group-text" id="basic-addon1">$</span>
							<input type="number" name="brokerage_account[data][property_value][{{ $i }}]" class="price-field form-control required brokerage_account_property_value"
								placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $brokerage_account, $i) }}">
						</div>
					</div>
				</div>
			</div>
			
            <div class="col-12 text-right my-2">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('brokerage_account','brokerage_account_mutisec', 'brokerage_items_data', 'parent_brokerage_account', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>
