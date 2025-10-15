<div class="light-gray-div form-main list_judicial_proceedings_data list_judicial_proceedings_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Case Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_judicial_proceedings_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_judicial_proceedings_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Case Title:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('case_name', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Case Number:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('case_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Nature of the case:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('case_nature', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-xl-3 col-lg-12 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Status of the Case:
                    <span class="font-weight-normal">
                        {{ Helper::validate_key_loop_value('case_status', $finacial_affairs, $i) == 1 ? 'Pending' : '' }}
                        {{ Helper::validate_key_loop_value('case_status', $finacial_affairs, $i) == 2 ? 'On Appeal' : '' }}
                        {{ Helper::validate_key_loop_value('case_status', $finacial_affairs, $i) == 3 ? 'Concluded' : '' }}
                    </span>
                </label>
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
        </div>

        <div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Case Title</label>
                        <input type="text" name="list_judicial_proceedings_data[case_name][{{$i}}]" class="input_capitalize form-control required case_name" placeholder="Case Title" value="{{ @$finacial_affairs['case_name'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Case Number</label>
                        <input type="text" name="list_judicial_proceedings_data[case_number][{{$i}}]" class="form-control required case_number" placeholder="Case Number" value="{{ @$finacial_affairs['case_number'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-8">
                <div class="label-div">
                    <div class="form-group">
                        <label> Nature of the case</label>
                        <textarea name="list_judicial_proceedings_data[case_nature][{{$i}}]" class="input_capitalize form-control required case_nature h-unset" cols="30"
                            rows="2"
                            placeholder="Nature of the case">{{ Helper::validate_key_loop_value('case_nature', $finacial_affairs, $i) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of Court or Agency</label>
                        <input type="text" name="list_judicial_proceedings_data[name][{{$i}}]" class="input_capitalize form-control required name" placeholder="Name of Court or Agency" value="{{ @$finacial_affairs['name'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
                        <input type="text" name="list_judicial_proceedings_data[street_number][{{$i}}]" class="input_capitalize form-control required street_number" placeholder="Address" value="{{ @$finacial_affairs['street_number'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required city" name="list_judicial_proceedings_data[city][{{$i}}]" placeholder="City" value="{{ @$finacial_affairs['city'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required state" name="list_judicial_proceedings_data[state][{{$i}}]">
                            <option value="">State</option>
                            {!! AddressHelper::getStatesList(@$finacial_affairs['state'][$i])  !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required zip" name="list_judicial_proceedings_data[zip][{{$i}}]" placeholder="Zip code" value="{{ @$finacial_affairs['zip'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="label-div question-area border-0 pb-0">
                    <label class="fs-13px">
                        Status of the Case
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                        <input type="radio" id="Nature-case_pending_yes_{{ $i }}" class="d-none case_status" name="list_judicial_proceedings_data[case_status][{{$i}}]" required {{ Helper::validate_key_loop_toggle('case_status', $finacial_affairs, 1, $i) }} value="1">
                        <label for="Nature-case_pending_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('case_status', $finacial_affairs, 1, $i) }}">Pending</label>

                        <input type="radio" id="Nature-case_on_appeal_no_{{ $i }}" class="d-none case_status" name="list_judicial_proceedings_data[case_status][{{$i}}]" required {{ Helper::validate_key_loop_toggle('case_status', $finacial_affairs, 2, $i) }} value="2">
                        <label for="Nature-case_on_appeal_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('case_status', $finacial_affairs, 2, $i) }}">On Appeal</label>

                        <input type="radio" id="Nature-case-concluded_no_{{ $i }}" class="d-none case_status" name="list_judicial_proceedings_data[case_status][{{$i}}]" required {{ Helper::validate_key_loop_toggle('case_status', $finacial_affairs, 3, $i) }} value="3">
                        <label for="Nature-case-concluded_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_loop_toggle_active('case_status', $finacial_affairs, 3, $i) }}">Concluded</label>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_judicial_proceedings','list_judicial_proceedings_data', 'list-judicial-proceedings-data', 'parent_list_judicial_proceedings', {{ $i }})">Save</a>
			</div>
        </div>
    </div>
</div>
