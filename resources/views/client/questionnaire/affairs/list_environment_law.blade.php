<div class="light-gray-div form-main list_environment_law_data list_environment_law_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Property Details
        </h2>
        
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_environment_law_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_environment_law_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">

            <div class="col-12">
				<strong class="subtitle pb-0">Site Information</strong>
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
				<strong class="subtitle pb-0">Government Unit Information</strong>
			</div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Name:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gov_name', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gov_street_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    City:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gov_city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    State:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gov_state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Zip code:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('gov_zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>       
			
            <div class="col-lg-6 col-md-8 col-sm-12 col-12">
                <label class="font-weight-bold">
                    Environmental Law, If You Know It:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('environment_law_know', $finacial_affairs, $i) }}</span>
                </label>
            </div>            
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date of Notice:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('notice_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>  
        </div>

        <div class="row gx-3 edit_section @if(isset($isEmpty) && $isEmpty) @else hide-data @endif">
            <div class="col-12">
                <strong class="subtitle">Site Details</strong>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of Site</label>
                        <input type="text" name="list_environment_law_data[name][{{$i}}]" class="input_capitalize form-control required name" placeholder="Name of Site" value="{{@$finacial_affairs['name'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
                        <input type="text" name="list_environment_law_data[street_number][{{$i}}]" class="input_capitalize form-control required street_number" placeholder="Address" value="{{@$finacial_affairs['street_number'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required city" name="list_environment_law_data[city][{{$i}}]" placeholder="City" value="{{@$finacial_affairs['city'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required state" name="list_environment_law_data[state][{{$i}}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(@$finacial_affairs['state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required zip" name="list_environment_law_data[zip][{{$i}}]" placeholder="Zip code" value="{{@$finacial_affairs['zip'][$i]}}">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <strong class="subtitle">Government Unit Details</strong>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name of Government Unit</label>
                        <input type="text" name="list_environment_law_data[gov_name][{{$i}}]" class="input_capitalize form-control gov_name required" placeholder="Name of Government Unit" value="{{@$finacial_affairs['gov_name'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
                        <input type="text" name="list_environment_law_data[gov_street_number][{{$i}}]" class="input_capitalize form-control required gov_street_number" placeholder="Address" value="{{@$finacial_affairs['gov_street_number'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required gov_city" name="list_environment_law_data[gov_city][{{$i}}]" placeholder="City" value="{{@$finacial_affairs['gov_city'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required gov_state" name="list_environment_law_data[gov_state][{{$i}}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(@$finacial_affairs['gov_state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required gov_zip" name="list_environment_law_data[gov_zip][{{$i}}]" placeholder="Zip code" value="{{@$finacial_affairs['gov_zip'][$i]}}">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-9">
                <div class="label-div">
                    <div class="form-group">
                        <label> Environmental Law, If You Know It</label>
                        <textarea name="list_environment_law_data[environment_law_know][{{$i}}]" class="input_capitalize form-control required environment_law_know h-unset"
                        cols="30" rows="2"
                        placeholder="Environmental Law, If You Know It">{{ Helper::validate_key_loop_value('environment_law_know', $finacial_affairs, $i) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="label-div">
                    <div class="form-group">
                        <label> Date of Notice</label>
                        <input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed required notice_date" name="list_environment_law_data[notice_date][{{$i}}]" value="{{ Helper::validate_key_loop_value('notice_date', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_environment_law','list_environment_law_data', 'list-environment_law-data', 'parent_list_environment_law', {{ $i }})">Save</a>
			</div>
        </div>
    </div>
</div>

