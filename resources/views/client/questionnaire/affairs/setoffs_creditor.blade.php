<div class="light-gray-div form-main setoffs_creditor_data setoffs_creditor_data_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Creditor Details
		</h2>
		<button type="button" class="delete-div" title="Delete" onclick="remove_div_common('setoffs_creditor_data', {{ $i }})">
			<i class="bi bi-trash3 mr-1"></i>
			Delete
		</button>
		
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('setoffs_creditor_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('setoffs_creditor_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @isset($isEmpty) @if($isEmpty) hide-data @endif @endisset">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <label class="font-weight-bold">
                    Name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditors_address', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			
            <div class="col-xl-4 col-lg-6 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditors_action', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
					Date:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('date_action', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
					Account No:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('account_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
					Amount:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('amount_data', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('amount_data', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @isset($isEmpty) @if($isEmpty) @else hide-data @endif @else hide-data @endisset">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Select Creditor from the Drop Down</label>
						<input type="text" name="setoffs_creditor_data[creditors_address][{{$i}}]" class="input_capitalize form-control required creditors_address setoffs_creditor_address autocomplete" placeholder="Creditor's Name and Address" value="{{ Helper::validate_key_loop_value('creditors_address', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<div class="label-div">
					<div class="form-group ">
						<label>Street Address</label>
						<input type="text" class="input_capitalize form-control required creditor_street" name="setoffs_creditor_data[creditor_street][{{$i}}]" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control required creditor_city" name="setoffs_creditor_data[creditor_city][{{$i}}]" placeholder="City" value="{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>State</label>
					<select class="form-control required creditor_state" name="setoffs_creditor_data[creditor_state][{{$i}}]">
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
						<input type="number" class="form-control allow-5digit required creditor_zip" name="setoffs_creditor_data[creditor_zip][{{$i}}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-6 col-md-8 col-12">
				<div class="label-div">
					<div class="form-group">
						<label> Description of action taken by creditor</label>
					<textarea name="setoffs_creditor_data[creditors_action][{{$i}}]" class="input_capitalize form-control required creditors_action h-unset" cols="30"
						rows="2" placeholder="Description">{{ Helper::validate_key_loop_value('creditors_action', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Date Action Taken</label>
						<input type="text" placeholder="MM/DD/YYYY" class="form-control max-today-date required date_action" name="setoffs_creditor_data[date_action][{{$i}}]" value="{{ Helper::validate_key_loop_value('date_action', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-4 col-md-5 col-sm-6 col-12">
				<div class="label-div">
					<div class="label-div">
						<div class="form-group">
							<label>Last 4 Digits of Account Number</label>
							<input type="text" class="form-control allow-4digit required account_number" name="setoffs_creditor_data[account_number][{{$i}}]" value="{{ Helper::validate_key_loop_value('account_number', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<div class="form-group">
						<label>Amount</label>
						<div class="input-group">
							<span class="input-group-text">$</span>
							<input type="number" class="form-control price-field required amount_data" name="setoffs_creditor_data[amount_data][{{$i}}]" value="{{ Helper::validate_key_loop_value('amount_data', $finacial_affairs, $i) }}">
						</div>
					</div>
				</div>
			</div>
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('setoffs_creditor','setoffs_creditor_data', 'setoffs_creditor-data', 'parent_setoffs_creditor', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>