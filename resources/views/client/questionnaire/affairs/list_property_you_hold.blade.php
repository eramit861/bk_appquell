<div class="light-gray-div form-main list_property_you_hold_data list_property_you_hold_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Property Details
        </h2>
        
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_property_you_hold_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_property_you_hold_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">

            <div class="col-12">
				<strong class="subtitle pb-0">Owner Information</strong>
			</div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('name', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('street_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			
            <div class="col-12">
				<strong class="subtitle pb-0">Property Information</strong>
			</div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('location_street_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('location_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('location_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('location_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>            
			
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <label class="font-weight-bold">
                    Description of Contents:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_desc', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @if(isset($isEmpty) && $isEmpty) @else hide-data @endif">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Owner's name</label>
						<input type="text" name="list_property_you_hold_data[name][{{$i}}]" class="input_capitalize form-control required name" placeholder="Owner's name" value="{{ @$finacial_affairs['name'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
						<input type="text" name="list_property_you_hold_data[street_number][{{$i}}]" class="input_capitalize form-control required street_number" placeholder="Address" value="{{ @$finacial_affairs['street_number'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
						<input type="text" class="input_capitalize form-control required city" name="list_property_you_hold_data[city][{{$i}}]" placeholder="City" value="{{ @$finacial_affairs['city'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
						<select class="form-control required state" name="list_property_you_hold_data[state][{{$i}}]">
							<option value="">Please Select State</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['state'][$i]) !!}
						</select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
						<input type="number" class="form-control allow-5digit required zip" name="list_property_you_hold_data[zip][{{$i}}]" placeholder="Zip code" value="{{ @$finacial_affairs['zip'][$i] }}">
                    </div>
                </div>
            </div>   
			<div class="col-12">
				<strong class="subtitle">Location of Property</strong>
			</div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
						<input type="text" name="list_property_you_hold_data[location_street_number][{{$i}}]" class="input_capitalize form-control required location_street_number" placeholder="Address" value="{{ @$finacial_affairs['location_street_number'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
						<input type="text" class="input_capitalize form-control required location_city" name="list_property_you_hold_data[location_city][{{$i}}]" placeholder="City" value="{{ @$finacial_affairs['location_city'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
						<select class="form-control required location_state" name="list_property_you_hold_data[location_state][{{$i}}]">
							<option value="">Please Select State</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['location_state'][$i]) !!}
						</select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
						<input type="number" class="form-control allow-5digit required location_zip" name="list_property_you_hold_data[location_zip][{{$i}}]" placeholder="Zip code" value="{{ @$finacial_affairs['location_zip'][$i] }}">
                    </div>
                </div>
            </div>  
			
			<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label> Value</label>
							<div class="input-group">
								<span class="input-group-text">$</span>
								<input type="number" class="form-control  price-field required property_value" name="list_property_you_hold_data[property_value][{{$i}}]" value="{{ Helper::validate_key_loop_value('property_value', $finacial_affairs, $i) }}">
							</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="label-div">
					<div class="form-group">
						<label> Description of Property</label>
						<textarea name="list_property_you_hold_data[property_desc][{{$i}}]" class="input_capitalize form-control required property_desc h-unset"
							cols="30" rows="2"
							placeholder=" Description of Property">{{ Helper::validate_key_loop_value('property_desc', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
            <div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_property_you_hold','list_property_you_hold_data', 'list-property-you-hold-data', 'parent_list_property_you_hold', {{ $i }})">Save</a>
			</div>
		</div>
	</div>
</div>
