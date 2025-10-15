@php
    $doesntHaveEin = Helper::validate_key_loop_value('doesntHaveEin', $finacial_affairs, $i) == 1 ? 1 : 0;
    $stillOpen = Helper::validate_key_loop_value('business_still_open', $finacial_affairs, $i) ?? '';
    $bussinessTypeArray = ArrayHelper::getBasicInfoBussinessTypeArray();
    $bussinessDescriptionArray = ArrayHelper::getBasicInfoBussinessDescriptionArray();
@endphp
<div class="light-gray-div form-main list_nature_business_data list_nature_business_data_{{ $i }} mt-2">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div> Business Details
        </h2>

        <a href="javascript:void(0)" class="client-edit-button with-delete "
            onclick="edit_div_common('list_nature_business_data', {{ $i }})">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <button type="button" class="delete-div" title="Delete"
            onclick="seperate_remove_div_common('list_nature_business_data', {{ $i }})">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3 summary_section @if (isset($isEmpty) && $isEmpty) hide-data @endif">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Name:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('name', $finacial_affairs, $i) }}</span>
                </label>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Type:
                    <span
                        class="font-weight-normal">{{ ArrayHelper::getBasicInfoBussinessTypeArray(Helper::validate_key_loop_value('type', $finacial_affairs, $i)) }}</span>
                </label>
            </div>
            <div
                class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12 @if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == 3) @else hide-data @endif">
                <label class="font-weight-bold">
                    Describe your business:
                    <span
                        class="font-weight-normal">{{ ArrayHelper::getBasicInfoBussinessDescriptionArray(Helper::validate_key_loop_value('businessDescription', $finacial_affairs, $i)) }}</span>
                </label>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Debtor Type:
                    <span class="font-weight-normal">
                        @if (Helper::validate_key_loop_value('own_business_selection', $finacial_affairs, $i) != 1)
                            Debtor
                        @endif
                        @if (Helper::validate_key_loop_value('own_business_selection', $finacial_affairs, $i) == 1)
                            @if ($authUser->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED)
                                Non-Filing Spouse
                            @endif
                            @if ($authUser->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED)
                                Spouse
                            @endif
                        @endif
                    </span>
                </label>
            </div>

            <div class="col-lg-0 col-0 px-0 @if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == 3) hide-data @endif"></div>

            <div class="col-lg-3 col-md-8 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Address:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('street_number', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    City:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('city', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    State:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('state', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Zip code:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('zip', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-0 col-0 px-0 "></div>

            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Nature of Business:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('business_nature', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div
                class="@if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == 3) col-lg-9 col-md-12 col-sm-6 col-12 @else col-lg-6 col-md-8 col-sm-6 col-12 @endif">
                <label class="font-weight-bold">
                    Name of Accountant or Bookkeeper:
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('business_accountant', $finacial_affairs, $i) }}</span>
                </label>
            </div>

            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-6 col-12 @if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == 3) hide-data @endif">
                <label class="font-weight-bold">
                    EIN:
                    <span class="font-weight-normal">
                        @if ($doesntHaveEin == 1)
                            This business doesn't have an EIN #
                        @else
                            {{ Helper::validate_key_loop_value('eiin', $finacial_affairs, $i) }}
                        @endif
                    </span>
                </label>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Date started :
                    <span
                        class="font-weight-normal">{{ Helper::validate_key_loop_value('operation_date', $finacial_affairs, $i) }}</span>
                </label>
            </div>
            <div class="col-lg-9 col-md-6 col-sm-6 col-12">
                <label class="font-weight-bold">
                    Dates ended:
                    <span class="font-weight-normal">
                        @if ($stillOpen == 1)
                            Business is still open
                        @else
                            {{ Helper::validate_key_loop_value('operation_date2', $finacial_affairs, $i) }}
                        @endif
                    </span>
                </label>
            </div>

        </div>

        <div class="row gx-3 edit_section @if (isset($isEmpty) && $isEmpty) @else hide-data @endif">
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Business name</label>
                        <input type="text" name="list_nature_business_data[name][{{ $i }}]"
                            class="input_capitalize form-control required name" placeholder="Business name"
                            value="{{ Helper::validate_key_loop_value('name', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control required bussiness_type"
                            name="list_nature_business_data[type][{{ $i }}]"
                            onchange="updateDsDescDivShowHideAffairs('{{ $i }}', 'bsDescDiv_{{ $i }}', 'beinDiv_{{ $i }}')">
                            <option value="">Please Select type</option>
                            @foreach ($bussinessTypeArray as $key => $type)
                                <option value="{{ $key }}" @if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == $key) selected @endif>
                                    {{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div
                class="col-lg-3 col-md-4 col-sm-6 col-12 bsDescDiv bsDescDiv_{{ $i }} @if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == 3) @else hide-data @endif">
                <div class="label-div">
                    <div class="form-group ">
                        <label>Describe your business</label>
                        <select class="form-control required des_cbussiness_type"
                            name="list_nature_business_data[businessDescription][{{ $i }}]">
                            <option value="">Please Select type</option>
                            @foreach ($bussinessDescriptionArray as $key => $label)
                                <option value="{{ $key }}" @if (Helper::validate_key_loop_value('businessDescription', $finacial_affairs, $i) == $key) selected @endif>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Debtor Type</label>
                        <select class="form-control required own_business_selection"
                            name="list_nature_business_data[own_business_selection][{{ $i }}]">
                            <option value="">Please Debtor type</option>
                            <option value="0" @if (Helper::validate_key_loop_value('own_business_selection', $finacial_affairs, $i) != 1) selected @endif
                                {{ Helper::validate_key_toggle('own_business_selection', $finacial_affairs, $i) }}>
                                Debtor</option>
                            @if (Auth::user()->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED || Auth::user()->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED)
                                <option value="1" @if (Helper::validate_key_loop_value('own_business_selection', $finacial_affairs, $i) == 1) selected @endif
                                    {{ Helper::validate_key_toggle('own_business_selection', $finacial_affairs, $i) }}>
                                    @if (Auth::user()->client_type == Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED)
                                        Non-Filing Spouse
                                    @endif
                                    @if (Auth::user()->client_type == Helper::CLIENT_TYPE_JOINT_MARRIED)
                                        Spouse
                                    @endif
                                </option>
                            @endif                            
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group ">
                        <label>
                            Address
                        </label>
                        <input type="text" name="list_nature_business_data[street_number][{{ $i }}]"
                            class="input_capitalize form-control required street_number" placeholder="Address"
                            value="{{ Helper::validate_key_loop_value('street_number', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" class="input_capitalize form-control required city"
                            name="list_nature_business_data[city][{{ $i }}]" placeholder="City"
                            value="{{ Helper::validate_key_loop_value('city', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required state"
                            name="list_nature_business_data[state][{{ $i }}]">
                            <option value="">Please Select State</option>
                            {!! AddressHelper::getStatesList(Helper::validate_key_loop_value('state', $finacial_affairs, $i)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip code</label>
                        <input type="number" class="form-control allow-5digit required zip"
                            name="list_nature_business_data[zip][{{ $i }}]" placeholder="Zip code"
                            value="{{ Helper::validate_key_loop_value('zip', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label> Nature of Business</label>
                        <textarea name="list_nature_business_data[business_nature][{{ $i }}]"
                            class="input_capitalize form-control required business_nature h-unset" cols="30" rows="2"
                            placeholder=" Nature of Business">{{ Helper::validate_key_loop_value('business_nature', $finacial_affairs, $i) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label> Name of Accountant or Bookkeeper <span class="text-c-blue">(Tax company or professional
                                used to prepare taxes)</span></label>
                        <textarea name="list_nature_business_data[business_accountant][{{ $i }}]"
                            class="input_capitalize form-control required business_accountant h-unset" cols="30" rows="2"
                            placeholder="Name of Accountant or Bookkeeper">{{ Helper::validate_key_loop_value('business_accountant', $finacial_affairs, $i) }}</textarea>
                    </div>
                </div>
            </div>
            <div
                class="col-lg-4 col-md-8 col-sm-12 col-12 beinDiv beinDiv_{{ $i }} @if (Helper::validate_key_loop_value('type', $finacial_affairs, $i) == 3) hide-data @endif">
                <div class="label-div">
                    <div class="form-group">
                        <label class="form-check-label">EIN</label>
                        <input placeholder="EIN" type="text" @if ($doesntHaveEin == 1) disabled @endif
                            class="form-control @if ($doesntHaveEin != 1) required @endif eiin "
                            name="list_nature_business_data[eiin][{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('eiin', $finacial_affairs, $i) }}">
                    </div>
                    <div class="form-check form-group">
                        <label class="form-check-label">

                            <input @if ($doesntHaveEin == 1) checked=checked @endif type="checkbox"
                                onchange="checkEin(this)" value="1" class="doesntHaveEin form-check-input"
                                name="list_nature_business_data[doesntHaveEin][{{ $i }}]">
                            This business doesn't have an EIN #
                        </label>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Date you started in business:</label>
                        <input type="text" placeholder="MM/DD/YYYY"
                            class="form-control  required operation_date date_filed"
                            name="list_nature_business_data[operation_date][{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('operation_date', $finacial_affairs, $i) }}">
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-lg-4 col-md-6 col-sm-12 col-12 businessEnded">
                <div class="label-div mb-1">
                    <div class="form-group">
                        <label>Date you ended/dissolved business:</label>
                        <input type="text" @if ($stillOpen == 1) disabled @endif
                            placeholder="MM/DD/YYYY"
                            class="form-control operation_date2 businessendDate @if ($stillOpen != 1) required @endif operation_date2_{{ $i }} date_filed"
                            name="list_nature_business_data[operation_date2][{{ $i }}]"
                            value="@if ($stillOpen == 1) @else {{ Helper::validate_key_loop_value('operation_date2', $finacial_affairs, $i) }} @endif">
                    </div>
                </div>
                <div class="form-check form-group">
                    <label class="form-check-label">
                        <input type="checkbox" @if ($stillOpen == 1) checked=checked @endif
                            name="list_nature_business_data[business_still_open][{{ $i }}]"
                            class="business_still_open form-check-input"
                            onchange="checkBizend(this, '{{ $i }}')" value="1" />
                        Business is still open
                    </label>
                </div>

            </div>
            <div class="col-12 text-right mt-2 mb-3">
                <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    data-url="{{ route('sofa_seperate_save') }}"
                    onclick="seperate_save('list_nature_business','list_nature_business_data', 'list-nature-business-data', 'parent_list_nature_business', {{ $i }})">Save</a>
            </div>
        </div>
    </div>
</div>
