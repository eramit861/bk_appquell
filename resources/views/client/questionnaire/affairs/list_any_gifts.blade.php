<div class="light-gray-div form-main list_any_gifts_data list_any_gifts_data_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Creditor Details
		</h2>
		
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_any_gifts_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_any_gifts_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('recipient_address', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			
			<div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date you gave the gifts:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gifts_date_from', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-lg-3 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Value of gifts:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('gifts_value1', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('gifts_value1', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>			
			<div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date you gave the gifts:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gifts_date_to', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-lg-3 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Value of gifts:
                    <span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('gifts_value', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('gifts_value', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
						
			<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Relationship to You:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('relationship', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-xl-6 col-lg-12 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gifts', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @if(!isset($isEmpty) || !$isEmpty) hide-data @endif">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Creditor's Name and Address</label>
						<input type="text" name="list_any_gifts_data[recipient_address][{{$i}}]" class="input_capitalize form-control required recipient_address" placeholder="Name of Recipien" value="{{ Helper::validate_key_loop_value('recipient_address', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<div class="label-div">
					<div class="form-group ">
						<label>Street Address</label>
						<input type="text" class="input_capitalize form-control required creditor_street" name="list_any_gifts_data[creditor_street][{{$i}}]" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control required creditor_city" name="list_any_gifts_data[creditor_city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>State</label>
						<select class="form-control required creditor_state" name="list_any_gifts_data[creditor_state][{{$i}}]">
							<option value="">Please Select State</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['creditor_state'][$i]) !!}
						</select>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>Zip code</label>
						<input type="number" class="form-control allow-5digit required creditor_zip" name="list_any_gifts_data[creditor_zip][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-4 col-lg-6 col-md-12">
				<div class="label-div">
					<div class="form-group">
						<label> Relationship to You</label>
						<input type="text" class="input_capitalize form-control required relationship" name="list_any_gifts_data[relationship][{{$i}}]" value="{{ Helper::validate_key_loop_value('relationship', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Date you gave the gifts</label>
						<input type="text" placeholder="From Date MM/DD/YYYY" class="form-control date_filed required gifts_date_from" name="list_any_gifts_data[gifts_date_from][{{$i}}]" value="{{ Helper::validate_key_loop_value('gifts_date_from', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Value of gifts</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required gifts_value1" name="list_any_gifts_data[gifts_value1][{{$i}}]" value="{{ Helper::validate_key_loop_value('gifts_value1', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Date you gave the Gifts</label>
						<input type="text" placeholder="To Date MM/DD/YYYY" class="form-control date_filed required gifts_date_to" name="list_any_gifts_data[gifts_date_to][{{$i}}]" value="{{ Helper::validate_key_loop_value('gifts_date_to', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xxl-2 col-lg-3 col-sm-6">
				<div class="label-div">
					<div class="form-group">
						<label>Value of gifts</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required gifts_value" name="list_any_gifts_data[gifts_value][{{$i}}]" value="{{ Helper::validate_key_loop_value('gifts_value', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Description of gifts</label>
						<textarea name="list_any_gifts_data[gifts][{{$i}}]" class="input_capitalize form-control required gifts h-unset"
							cols="30" rows="2"
							placeholder=" Description of Gifts">{{ Helper::validate_key_loop_value('gifts', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_any_gifts','list_any_gifts_data', 'list-any-gifts-data', 'parent_list_any_gifts', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>