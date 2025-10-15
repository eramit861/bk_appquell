<div class="light-gray-div form-main list_financial_institutions_data list_financial_institutions_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Case Details
        </h2>
        
        <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('list_financial_institutions_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('list_financial_institutions_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if(isset($isEmpty) && $isEmpty) hide-data @endif">        
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

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date Financial Statement Shared:
                    <span class="font-weight-normal">{{ Helper::validate_key_loop_value('date_issued', $finacial_affairs, $i) }}</span>
                </label>
            </div>
        </div>

        <div class="row gx-3 edit_section @if(!isset($isEmpty) || !$isEmpty) hide-data @endif">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Name</label>
						<input type="text" name="list_financial_institutions_data[name][{{$i}}]" class="input_capitalize form-control required name" placeholder="Name " value="{{ @$finacial_affairs['name'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Address</label>
						<input type="text" name="list_financial_institutions_data[street_number][{{$i}}]" class="input_capitalize form-control required street_number" placeholder="Address" value="{{ @$finacial_affairs['street_number'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
						<input type="text" class="input_capitalize form-control required city" name="list_financial_institutions_data[city][{{$i}}]" placeholder="City" value="{{ @$finacial_affairs['city'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required state" name="list_financial_institutions_data[state][{{$i}}]">
                            <option value="">State</option>
							{!! AddressHelper::getStatesList(@$finacial_affairs['state'][$i]) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
						<input type="number" class="form-control allow-5digit required zip" name="list_financial_institutions_data[zip][{{$i}}]" placeholder="Zip code" value="{{ @$finacial_affairs['zip'][$i] }}">
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label> Date Financial Statement Shared</label>
							<input type="text" placeholder="MM/DD/YYYY" class="form-control date_filed required date_issued" name="list_financial_institutions_data[date_issued][{{$i}}]" value="{{ Helper::validate_key_loop_value('date_issued', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-12 text-right mt-2 mb-3">
				<a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('sofa_seperate_save') }}" onclick="seperate_save('list_financial_institutions','list_financial_institutions_data', 'list-financial-institutions-data', 'parent_list_financial_institutions', {{ $i }})">Save</a>
			</div>
        </div>
    </div>
</div>


