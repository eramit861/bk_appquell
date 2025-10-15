<div class="light-gray-div form-main property_repossessed_data_form property_repossessed_data_form_{{ $i }} mt-2">
	<div class="light-gray-box-form-area">
		<h2>
			<div class="circle-number-div">{{ $i + 1 }}</div> Property Details
		</h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('property_repossessed_data_form', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('property_repossessed_data_form', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @isset($isEmpty) @if($isEmpty) hide-data @endif @endisset">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <label class="font-weight-bold">
                    Court or Agency:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_address', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 col-xl-3">
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
			
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
					Description:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('creditor_Property', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('property_repossessed_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
					Property Value:
					<span class="font-weight-normal">$ {{ !empty(Helper::validate_key_loop_value('property_repossessed_value', $finacial_affairs, $i)) ? Helper::validate_key_loop_value('property_repossessed_value', $finacial_affairs, $i) : '0.00' }}</span>
                </label>
            </div>
			
            <div class="col-xl-4 col-md-12 col-12">
                <label class="font-weight-bold">
					Explain what happened:
                    <span class="font-weight-normal">
						{{ Helper::validate_key_loop_value('what_happened', $finacial_affairs, $i) == 1 ? 'Property was repossessed' : '' }}
						{{ Helper::validate_key_loop_value('what_happened', $finacial_affairs, $i) == 2 ? 'Property was foreclosed' : '' }}
						{{ Helper::validate_key_loop_value('what_happened', $finacial_affairs, $i) == 3 ? 'Property was garnished' : '' }}
						{{ Helper::validate_key_loop_value('what_happened', $finacial_affairs, $i) == 4 ? 'Property was attached, seized, or levied' : '' }}
					</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @isset($isEmpty) @if($isEmpty) @else hide-data @endif @else hide-data @endisset">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
				<div class="label-div">
					<div class="form-group">
						<label>Select Creditor from the Drop Down</label>
						<input type="text" name="property_repossessed_data[creditor_address][{{ $i }}]" class="input_capitalize form-control required property_repossessed_address autocomplete" placeholder="Creditor's Name" value="{{ Helper::validate_key_loop_value('creditor_address', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
				<div class="label-div">
					<div class="form-group ">
						<label>Street Address</label>
						<input type="text" name="property_repossessed_data[creditor_street][{{ $i }}]" class="input_capitalize form-control property_repossessed_creditor_street required" placeholder="Street Address" value="{{ Helper::validate_key_loop_value('creditor_street', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>City</label>
						<input type="text" class="input_capitalize form-control property_repossessed_creditor_city required" name="property_repossessed_data[creditor_city][{{ $i }}]" placeholder="City" value="{{ Helper::validate_key_loop_value('creditor_city', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
				<div class="label-div">
					<div class="form-group">
						<label>State</label>
						<select class="form-control required property_repossessed_creditor_state" name="property_repossessed_data[creditor_state][{{ $i }}]">
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
						<input type="number" class="form-control allow-5digit property_repossessed_creditor_zip required" name="property_repossessed_data[creditor_zip][{{ $i }}]" placeholder="Zip" value="{{ Helper::validate_key_loop_value('creditor_zip', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>

			<div class="col-12 col-sm-12 col-md-12 col-lg-8">
				<div class="label-div">
					<div class="form-group">
						<label>Description of Property</label>
						<textarea name="property_repossessed_data[creditor_Property][{{ $i }}]" class="input_capitalize form-control required property_repossessed_creditor_Property h-unset" cols="30" rows="2" placeholder="Description of Property">{{ Helper::validate_key_loop_value('creditor_Property', $finacial_affairs, $i) }}</textarea>
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<label> Date</label>
					<div class="form-group">
						<input type="text" placeholder="MM/DD/YYYY" class="form-control max-today-date required property_repossessed_date" name="property_repossessed_data[property_repossessed_date][{{ $i }}]" value="{{ Helper::validate_key_loop_value('property_repossessed_date', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 col-12">
				<div class="label-div">
					<label> Property Value</label>
					<div class="input-group">
						<span class="input-group-text">$</span>
						<input type="number" placeholder="Property Value" class="form-control price-field required property_repossessed_value" name="property_repossessed_data[property_repossessed_value][{{ $i }}]" value="{{ Helper::validate_key_loop_value('property_repossessed_value', $finacial_affairs, $i) }}">
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="label-div question-area border-0 pb-0">
					<label class="fs-13px">
						Explain what happened
					</label>
					<!-- Radio Buttons -->
					<div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
						<input type="radio" id="property-repossessed-{{ $i }}" class="d-none property_repossessed_what_happened" name="property_repossessed_data[what_happened][{{$i}}]" required {{ Helper::validate_key_loop_toggle('what_happened', $finacial_affairs, 1, $i) }} value="1">
						<label for="property-repossessed-{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('what_happened', $finacial_affairs, 1, $i) }}">Property was repossessed</label>

						<input type="radio" id="property-foreclosed-{{ $i }}" class="d-none property_repossessed_what_happened" name="property_repossessed_data[what_happened][{{$i}}]" required {{ Helper::validate_key_loop_toggle('what_happened', $finacial_affairs, 2, $i) }} value="2">
						<label for="property-foreclosed-{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('what_happened', $finacial_affairs, 2, $i) }}">Property was foreclosed</label>

						<input type="radio" id="property-garnished-{{ $i }}" class="d-none property_repossessed_what_happened" name="property_repossessed_data[what_happened][{{$i}}]" required {{ Helper::validate_key_loop_toggle('what_happened', $finacial_affairs, 3, $i) }} value="3">
						<label for="property-garnished-{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('what_happened', $finacial_affairs, 3, $i) }}">Property was garnished</label>

						<input type="radio" id="property-attached-{{ $i }}" class="d-none property_repossessed_what_happened" name="property_repossessed_data[what_happened][{{$i}}]" required {{ Helper::validate_key_loop_toggle('what_happened', $finacial_affairs, 4, $i) }} value="4">
						<label for="property-attached-{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('what_happened', $finacial_affairs, 4, $i) }}">Property was attached, seized, or levied</label>
					</div>
				</div>
			</div>
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('property_repossessed','property_repossessed_data_form', 'property-repossessed-data', 'parent_property_repossessed', {{ $i }})">Save</a>
            </div>
		</div>
	</div>
</div>