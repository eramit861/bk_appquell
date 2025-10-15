@php
$have_access_of_box = Helper::validate_key_loop_toggle('have_access_of_box', $finacial_affairs, 1, $i);
$showSection = '';
if (empty($have_access_of_box)) {
    $showSection = 'hide-data';
}
@endphp

<div class="light-gray-div form-main list_safe_deposit_data list_safe_deposit_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Depository Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_safe_deposit_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_safe_deposit_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Name <small class="text-bold">(Financial Institution)</small>:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('name', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
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
                <label class="font-weight-bold">
                    Did anyone else have access to the box or depository:
                    <span class="font-weight-normal">
                        @if(Helper::validate_key_loop_value_radio('have_access_of_box', $finacial_affairs, $i) == 1) Yes @endif
                        @if(Helper::validate_key_loop_value_radio('have_access_of_box', $finacial_affairs, $i) == 0) No @endif
                    </span>
                </label>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 {{ $showSection }}">
                <label class="font-weight-bold">
                    Name <small class="text-bold">(Anyone with access)</small>:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('bo_name', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 {{ $showSection }}">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('bo_street_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12 {{ $showSection }}">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('bo_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12 {{ $showSection }}">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('bo_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12 {{ $showSection }}">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('bo_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            
			
            <div class="col-lg-6 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Description of Contents:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('contents', $finacial_affairs, $i) }}</span>
                </label>
            </div>
			<div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Do You Still Have It:
                    <span class="font-weight-normal">
                        @if(Helper::validate_key_loop_value_radio('still_have_safe_deposite', $finacial_affairs, $i) == 1) Yes @endif
                        @if(Helper::validate_key_loop_value_radio('still_have_safe_deposite', $finacial_affairs, $i) == 0) No @endif
                    </span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @if(isset($isEmpty) && $isEmpty) @else hide-data @endif">
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of financial institution</label>
						<input required type="text" name="list_safe_deposit_data[name][{{$i}}]" class="input_capitalize form-control name" placeholder="Name of Financial institution" value="{{ @$finacial_affairs['name'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
						<input required type="text" name="list_safe_deposit_data[street_number][{{$i}}]" class="input_capitalize form-control street_number" placeholder="Address" value="{{ @$finacial_affairs['street_number'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
						<input required type="text" class="input_capitalize form-control city" name="list_safe_deposit_data[city][{{$i}}]" placeholder="City" value="{{ @$finacial_affairs['city'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select required class="form-control state" name="list_safe_deposit_data[state][{{$i}}]">
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
						<input required type="number" class="form-control allow-5digit zip" name="list_safe_deposit_data[zip][{{$i}}]" placeholder="Zip code" value="{{ @$finacial_affairs['zip'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12 have_access_of_box has-sub-item-field">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">Did anyone else have access to the box or depository?</label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group  multi-input-radio-group">
                        <input type="radio" id="have_access_of_deposit_box_yes_{{ $i }}" class="d-none have_access_of_box" name="list_safe_deposit_data[have_access_of_box][{{$i}}]" required {{ Helper::validate_key_loop_toggle('have_access_of_box', $finacial_affairs, 1, $i) }} value="1">
                        <label for="have_access_of_deposit_box_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('have_access_of_box', $finacial_affairs, 1, $i) }}" onclick="getboname('yes', this);">Yes</label>

                        <input type="radio" id="have_access_of_deposit_box_no_{{ $i }}" class="d-none have_access_of_box" name="list_safe_deposit_data[have_access_of_box][{{$i}}]" required {{ Helper::validate_key_loop_toggle('have_access_of_box', $finacial_affairs, 0, $i) }} value="0">
                        <label for="have_access_of_deposit_box_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('have_access_of_box', $finacial_affairs, 0, $i) }}" onclick="getboname('no',  this);">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 have-access-box @if(isset($finacial_affairs['have_access_of_box'][$i]) && $finacial_affairs['have_access_of_box'][$i] == 1) @else hide-data @endif">
                <div class="light-gray-border-div">
                    <div class="light-gray-div mt-2 mb-3">
                        <h2>&nbsp;&nbsp;Anyone with access to the box or depository</h2>
                        <div class="row gx-3">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 depository-yes">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Name</label>
										<input type="text" name="list_safe_deposit_data[bo_name][{{$i}}]" class="input_capitalize form-control bo_name required" placeholder="Name of Anyone With Access to Box or Depository" value="{{ @$finacial_affairs['bo_name'][$i] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3 depository-yes">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Address</label>
										<input type="text" name="list_safe_deposit_data[bo_street_number][{{$i}}]" class="input_capitalize form-control bo_street_number required" placeholder="Address" value="{{ @$finacial_affairs['bo_street_number'][$i] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 depository-yes">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>City</label>
										<input type="text" class="input_capitalize form-control bo_city required" name="list_safe_deposit_data[bo_city][{{$i}}]" placeholder="City" value="{{ @$finacial_affairs['bo_city'][$i] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 depository-yes">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>State</label>
                                        <select class="form-control required bo_state" name="list_safe_deposit_data[bo_state][{{$i}}]">
                                            <option value="">Please Select State</option>
											{!! AddressHelper::getStatesList(@$finacial_affairs['bo_state'][$i]) !!}
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2 depository-yes">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label>Zip code</label>
										<input type="number" class="form-control allow-5digit bo_zip required" name="list_safe_deposit_data[bo_zip][{{$i}}]" placeholder="Zip code" value="{{ @$finacial_affairs['bo_zip'][$i] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Description of Contents</label>
						<textarea required name="list_safe_deposit_data[contents][{{$i}}]" class="input_capitalize form-control contents h-unset"
							cols="30" rows="2"
							placeholder="Description of Contents">{{ Helper::validate_key_loop_value('contents', $finacial_affairs, $i) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-12">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">Do You Still Have It?</label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group  multi-input-radio-group">
                        <input type="radio" id="still_have_safe_deposite_yes_{{ $i }}" class="d-none still_have_safe_deposite" name="list_safe_deposit_data[still_have_safe_deposite][{{$i}}]" required {{ Helper::validate_key_loop_toggle('still_have_safe_deposite', $finacial_affairs, 1, $i) }} value="1">
                        <label for="still_have_safe_deposite_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('still_have_safe_deposite', $finacial_affairs, 1, $i) }}">Yes</label>

                        <input type="radio" id="still_have_safe_deposite_no_{{ $i }}" class="d-none still_have_safe_deposite" name="list_safe_deposit_data[still_have_safe_deposite][{{$i}}]" required {{ Helper::validate_key_loop_toggle('still_have_safe_deposite', $finacial_affairs, 0, $i) }} value="0">
                        <label for="still_have_safe_deposite_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('still_have_safe_deposite', $finacial_affairs, 0, $i) }}">No</label>
                    </div>
                </div>
            </div>

			<div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_safe_deposit','list_safe_deposit_data', 'list-safe-deposit-data', 'parent_list_safe_deposit', {{ $i }})">Save</a>
			</div>
        </div>
    </div>
</div>