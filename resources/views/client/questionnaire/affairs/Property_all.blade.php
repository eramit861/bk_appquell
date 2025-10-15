<div class="light-gray-div form-main Property_all_data Property_all_data_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Property Details
		</h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('Property_all_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('Property_all_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @isset($isEmpty) @if($isEmpty) hide-data @endif @endisset">
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
			
			<div class="col-xl-6 col-lg-12 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
					Description and value of property transferred:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_value', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-6 col-lg-12 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
					Describe any property or payments received or debts paid in exchange:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_exchange', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Relationship to you:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('relationship_to_you', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Date of transfer:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_transfer_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @isset($isEmpty) @if($isEmpty) @else hide-data @endif @else hide-data @endisset">
			
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12 mr-0 pr-0">
					<div class="label-div">
						<div class="form-group">
							<label>Person who received the transfer</label>
							<input type="text" name="Property_all_data[name][{{$i}}]" class="input_capitalize form-control required name" placeholder="Person who received the transfer" value="{{@$finacial_affairs['name'][$i]}}">
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12">
					<div class="label-div">
						<div class="form-group ">
							<label>Street address</label>
							<input type="text" name="Property_all_data[street_number][{{$i}}]" class="input_capitalize form-control required street_number" placeholder="Address" value="{{@$finacial_affairs['street_number'][$i]}}">
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
					<div class="label-div">
						<div class="form-group">
							<label>City</label>
							<input type="text" class="input_capitalize form-control required city" name="Property_all_data[city][{{$i}}]" placeholder="City" value="{{@$finacial_affairs['city'][$i]}}">
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
					<div class="label-div">
						<div class="form-group">
							<label>State</label>
							<select class="form-control required state" name="Property_all_data[state][{{$i}}]">
								<option value="">Please select state</option>
								{!! AddressHelper::getStatesList(@$finacial_affairs['state'][$i]) !!}
							</select>
						</div>
					</div>
				</div>
				<div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-12">
					<div class="label-div">
						<div class="form-group">
							<label>Zip code</label>
							<input type="number" class="form-control allow-5digit required zip" name="Property_all_data[zip][{{$i}}]" placeholder="Zip" value="{{@$finacial_affairs['zip'][$i]}}">
						</div>
					</div>
				</div>
			
			<div class="col-lg-5">
				<div class="label-div">
					<div class="form-group">
						<label> Description and value of property transferred</label>
						<textarea row="2" name="Property_all_data[property_transfer_value][{{$i}}]" class="input_capitalize form-control required property_transfer_value" rows="2" placeholder="Description and value of property transferred">{{ Helper::validate_key_loop_value('property_transfer_value', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-lg-7">
				<div class="label-div">
					<div class="form-group">
						<label> Describe any property or
							payments received or debts paid
							in exchange</label>
						<textarea name="Property_all_data[property_exchange][{{$i}}]" class="input_capitalize form-control required property_exchange" rows="2" placeholder="Describe any property or payments received or debts paid in exchange">{{ Helper::validate_key_loop_value('property_exchange', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Person's relationship to you </label>
						<input type="text" placeholder="Person's relationship to you" class="input_capitalize form-control required relationship_to_you" name="Property_all_data[relationship_to_you][{{$i}}]" value="{{ Helper::validate_key_loop_value('relationship_to_you', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label> Date of transfer</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed required property_transfer_date" name="Property_all_data[property_transfer_date][{{$i}}]" value="{{ Helper::validate_key_loop_value('property_transfer_date', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>

			<div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('Property_all','Property_all_data', 'Property_all-data', 'parent_Property_all', {{ $i }})">Save</a>
			</div>
		</div>
	</div>
</div>