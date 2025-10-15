<div class="light-gray-div form-main gifts_charity_data gifts_charity_data_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Charity Details
		</h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('gifts_charity_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('gifts_charity_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_address', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_street', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>

			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Contribution Date:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_contribution_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Value:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('charity_contribution_value', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('charity_contribution_value', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
			<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Contribution Date:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_contribution_date1', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Value:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('charity_contribution_value1', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('charity_contribution_value1', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
			<div class="col-12">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('charity_contribution', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Name and Address of Charity</label>
						<input type="text" name="gifts_charity_data[charity_address][{{$i}}]" class="input_capitalize form-control required charity_address" placeholder="Name of Charity" value="{{ Helper::validate_key_loop_value('charity_address', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<div class="label-div">
					<div class="form-group ">
						<label>Street Address</label>
						<input type="text" class="input_capitalize form-control required charity_street" name="gifts_charity_data[charity_street][{{$i}}]" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('charity_street', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control required charity_city" name="gifts_charity_data[charity_city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('charity_city', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>State</label>
						<select class="form-control required charity_state" name="gifts_charity_data[charity_state][{{$i}}]">
							<option value="">Please Select State or Territory</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['charity_state'][$i])  !!}
						</select>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>Zip code</label>
						<input type="number" class="form-control allow-5digit required charity_zip" name="gifts_charity_data[charity_zip][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('charity_zip', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Contribution Date</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed required charity_contribution_date" name="gifts_charity_data[charity_contribution_date][{{$i}}]" value="{{ Helper::validate_key_loop_value('charity_contribution_date', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Value</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required charity_contribution_value" name="gifts_charity_data[charity_contribution_value][{{$i}}]" value="{{ Helper::validate_key_loop_value('charity_contribution_value', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Contribution Date</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed required charity_contribution_date1" name="gifts_charity_data[charity_contribution_date1][{{$i}}]" value="{{ Helper::validate_key_loop_value('charity_contribution_date1', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Value</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required charity_contribution_value1" name="gifts_charity_data[charity_contribution_value1][{{$i}}]" value="{{ Helper::validate_key_loop_value('charity_contribution_value1', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Description of Contribution</label>
						<textarea name="gifts_charity_data[charity_contribution][{{$i}}]" class="input_capitalize form-control required charity_contribution h-unset"
							cols="30" rows="2"
							placeholder=" Description of Contribution">{{ Helper::validate_key_loop_value('charity_contribution', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>

            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('gifts_charity','gifts_charity_data', 'gifts-charity-data', 'parent_gifts_charity', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>
