<div class="light-gray-div form-main all_property_transfer_10_year_data all_property_transfer_10_year_data_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Property Details
		</h2>
		
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('all_property_transfer_10_year_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('all_property_transfer_10_year_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Name of Trust:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('trust_name', $finacial_affairs, $i) }}</span>
                </label>
            </div>

            <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Date of Transfer:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('10year_property_transfer_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>

			<div class="col-lg-7 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
					Description and Value of Property Transferred:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('10year_property_transfer', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Name of Trust</label>
						<input type="text" class="input_capitalize form-control required trust_name" placeholder="Name of Trust" name="all_property_transfer_10_year_data[trust_name][{{$i}}]" value="{{ Helper::validate_key_loop_value('trust_name', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-3 col-md-6 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Date of Transfer</label>
						<input type="text" placeholder="MM/DD/YYYY" class="date_filed form-control required 10year_property_transfer_date" name="all_property_transfer_10_year_data[10year_property_transfer_date][{{$i}}]" value="{{ Helper::validate_key_loop_value('10year_property_transfer_date', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-12 col-sm-12 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Description and Value of Property Transferred</label>
						<textarea name="all_property_transfer_10_year_data[10year_property_transfer][{{$i}}]" class="input_capitalize form-control required 10year_property_transfer h-unset"
							cols="30" rows="4"
							placeholder="Description and Value of Property Transferred">{{ Helper::validate_key_loop_value('10year_property_transfer', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('all_property_transfer_10_year','all_property_transfer_10_year_data', 'list-all-property_transfer-data', 'parent_all_property_transfer_10_year', {{ $i }})">Save</a>
			</div>
		</div>
	</div>
</div>