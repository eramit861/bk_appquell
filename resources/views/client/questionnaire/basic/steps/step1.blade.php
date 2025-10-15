<div class="light-gray-border-div {{ (!$step1) ? 'hidestep' : '' }}" id="basic-info-part-a">
    @php $form_route_step_1 = isset($attorney_edit) && $attorney_edit == true ? $save_route : route('client_basic_info_step1'); @endphp
    <form name="client_basic_info_step1" id="client_basic_info_step1" action="{{ $form_route_step_1 }}" method="post"
        style="width: 100%" novalidate>
        @csrf
        <div class="light-gray-div mt-2">
            <h2 class="text-bold">Name information</h2>
            <div class="row gx-3">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="input_capitalize form-control required" placeholder="First Name"
                                name="part1[name]"
                                value="{{ Helper::validate_key_value('name', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="input_capitalize form-control" placeholder="Middle Name"
                                name="part1[middle_name]"
                                value="{{ Helper::validate_key_value('middle_name', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="input_capitalize form-control required" placeholder="Last Name"
                                name="part1[last_name]"
                                value="{{ Helper::validate_key_value('last_name', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Suffix
                            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                data-bs-html="true"
                                data-bs-original-title="• Jr. (Junior) → Son of someone with the same full name<br>• Sr. (Senior) → The father when the son is “Jr.”<br>• II, III, IV → Second, third, fourth with the same name in the family"
                            >
                                <i class="bi bi-question-circle"></i>
                            </div>
                        </label>
                            <select name="part1[suffix]" class="form-control">
                                <option value="">None</option>
                                @foreach ($suffixArray as $key => $val)
                                <option value="{{ $key }}" {{ $key == Helper::validate_key_value('suffix', $BasicInfoPartA) ? 'selected' : '' }}>
                                    {{ $val }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="label-div question-area border-0">
                        <label> Have you used any other names in the past eight years?
                            <p class="text-bold mb-0 text-bold">
                                <span class="text-c-blue">(For example: a maiden name, a previous married name, or a nickname you go by.)</span>
                            </p>
                        </label>
                        <div class="custom-radio-group form-group">
                            <input type="radio" name="part1[any_other_name][past_eight]" id="otherNamesNo"
                                class="d-none" value="0" {{ Helper::validate_key_toggle('any_other_name', $BasicInfoPartA, 0) }}>
                            <label for="otherNamesNo"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('any_other_name', $BasicInfoPartA, 0) }}"
                                onclick="getHiddenData('no');">No</label>

                            <input type="radio" name="part1[any_other_name][past_eight]" id="otherNamesYes"
                                class="d-none" value="1" {{ Helper::validate_key_toggle('any_other_name', $BasicInfoPartA, 1) }}>
                            <label for="otherNamesYes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('any_other_name', $BasicInfoPartA, 1) }}"
                                onclick="getHiddenData('yes');">Yes</label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 {{ Helper::key_hide_show_v('any_other_name', $BasicInfoPartA) }}"
                    id="condition-data">
                    <div class="outline-gray-border-area">
                        <div class="light-gray-box-tittle-div">
                            <h2>Other Names Used</h2>
                        </div>
                        @php
                        $k = 0;
                        if (!empty($BasicInfo_AnyOtherName['name']) && is_array($BasicInfo_AnyOtherName['name'])) {
                            if (count($BasicInfo_AnyOtherName['name']) > 0) {
                                for ($k = 0; $k < count($BasicInfo_AnyOtherName['name']); $k++) {
                                    @endphp
                                    @include('client.questionnaire.basic.common.other_names', $BasicInfo_AnyOtherName)
                                    @php
                                }
                            }
                        } else {
                            $k = 0;
                            @endphp
                            @include('client.questionnaire.basic.common.other_names', $BasicInfo_AnyOtherName)
                            @php
                            $k++;
                        }@endphp
                        <div class="add-more-div-bottom">
                            <button type="button" class="btn-new-ui-default py-1 px-2"
                                onclick="addOther_names(); return false;">
                                <i class="bi bi-plus-lg"></i>
                                Add Additional Name(s)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-gray-div">
            <h2 class="text-bold">Contact Information</h2>
            <div class="row gx-3">
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Home Phone</label>
                            <input type="text" class="phone-field form-control required"
                                name="part1[any_other_name][home]" placeholder="Home"
                                value="{{ Helper::validate_key_value('home', $BasicInfo_AnyOtherName) }}">
                            @error('part1.any_other_name.home')
                                <div class="error mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Cell Phone</label>
                            <input type="text" class="form-control phone-field required"
                                name="part1[any_other_name][cell]" placeholder="Cell"
                                value="{{ $any_other_name_phone_no }}">
                            @error('part1.any_other_name.cell')
                                <div class="error mb-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="text" class="form-control required" readonly
                                name="part1[any_other_name][email]" placeholder="Email"
                                value="{{ $any_other_name_email }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-gray-div">
            <h2>Address Details</h2>
            <div class="row gx-3">
                <div class="col-lg-3 col-md-8 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Street Address</label>
                            <input type="text" class="input_capitalize form-control required" name="part1[Address]"
                                placeholder="Address"
                                value="{{ Helper::validate_key_value('Address', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="input_capitalize form-control required" name="part1[City]"
                                placeholder="City"
                                value="{{ Helper::validate_key_value('City', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control required" id="debtor_state" name="part1[state]">
                                <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesList(Helper::validate_key_value('state', $BasicInfoPartA)) !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>ZIP Code</label>
                            <input type="number" class="form-control required allow-5digit" name="part1[zip]"
                                placeholder="Zip"
                                value="{{ Helper::validate_key_value('zip', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>County</label>
                            <select name="part1[country]" id="state_based_county" class="form-control required">
                                <option value="">Choose County</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-gray-div">
            <h2 class="text-bold">Identification and Verification</h2>
            <div class="row gx-3">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Identification Type</label>
                            <select onchange="chooseType(this)" id="debtor_ssn_type" class="form-control required"
                                name="part1[has_security_number]">
                                <option disabled="">Please Select Type</option>
                                <option {{ Helper::validate_key_option('has_security_number', $BasicInfoPartA, 0) }} value="0">SSN</option>
                                <option {{ Helper::validate_key_option('has_security_number', $BasicInfoPartA, 1) }} value="1">ITIN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div
                        class="label-div ssn_no {{ Helper::validate_key_value('has_security_number', $BasicInfoPartA) == 1 ? 'hide-data' : '' }}">
                        <div class="form-group">
                            <label>SSN</label>
                            <input type="text" name="part1[security_number]"
                                class="form-control is_ssn security_number_sec required"
                                placeholder="Social Security Number"
                                value="{{ Helper::validate_key_value('security_number', $BasicInfoPartA) }}">
                        </div>
                    </div>
                    <div
                        class="label-div itin_no {{ Helper::validate_key_value('has_security_number', $BasicInfoPartA) != 1 ? 'hide-data' : '' }}">
                        <div class="form-group">
                            <label>ITIN</label>
                            <input type="text" class="form-control is_ssn required" id="part1_itin" name="part1[itin]"
                                placeholder="ITIN"
                                value="{{ Helper::validate_key_value('itin', $BasicInfoPartA) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Driver’s License / Gov ID</label>
                            <input type="text" class="form-control required" name="part1[any_other_name][work]"
                                placeholder="Driver's Lic/Gov. ID"
                                value="{{ Helper::validate_key_value('work', $BasicInfo_AnyOtherName) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="text" class="form-control max-today-date required"
                                name="part1[any_other_name][date_of_birth]" placeholder="MM/DD/YYYY"
                                value="{{ Helper::validate_key_value('date_of_birth', $BasicInfo_AnyOtherName) }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-gray-div">
            <h2 class="text-bold">Previous Addresses</h2>
            <div class="row gx-3">
                <input type="hidden" value="0" name="part1[lived_address_from_180]">
                <div class="col-12">
                    <div class="label-div question-area">
                        <label> Have you lived at your current address for the last 3 years?
                            <p class="text-bold mb-0 text-bold">
                                <span class="text-c-blue">(We need your past 3 years of addresses so the court can verify your identity and make sure no debts are missed.)</span>
                            </p>
                        </label>
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="list-every-address_yes" name="list_every_address" class="d-none"
                                value="1" required {{ Helper::validate_key_toggle('list_every_address', $finacial_affairs, 1) }}>
                            <label for="list-every-address_yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('list_every_address', $finacial_affairs, 1) }}"
                                onclick="getListEveryAddressData('yes');">Yes</label>

                            <input type="radio" id="list-every-address_no" name="list_every_address" class="d-none"
                                value="0" required {{ Helper::validate_key_toggle('list_every_address', $finacial_affairs, 0) }}>
                            <label for="list-every-address_no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('list_every_address', $finacial_affairs, 0) }}"
                                onclick="getListEveryAddressData('no');">No</label>
                        </div>
                    </div>

                    <!-- List Previous Addresses (Last 3 Years) -->
                    <div id="list-every-address-data"
                        class="{{ Helper::key_hide_show_v2('list_every_address', $finacial_affairs) }}">
                        <div class="outline-gray-border-area">
                            <div class="light-gray-box-tittle-div">
                                <h2>Please list any other addresses where you have lived in the past 3 years.</h2>
                            </div>
                            @php
                            if (!empty($finacial_affairs['prev_address']['creditor_street'])) {
                                for ($i = 0; $i < count($finacial_affairs['prev_address']['creditor_street']); $i++) {
                                    @endphp
                                    @include('client.questionnaire.affairs.common.prev_address', ['finacial_affairs' => $finacial_affairs['prev_address'], $i, $usa_states])
                                    @php
                                }
                            } else {
                                @endphp
                                    @include('client.questionnaire.affairs.common.prev_address', [$usa_states, 'i' => 0])
                                    @php
                            }
                            @endphp
                            <div class="add-more-div-bottom">
                                <button type="button" class="btn-new-ui-default py-1 px-2"
                                    onclick="addEveryAddressForm(); return false;">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Additional Addresses
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- living_domestic_partner -->
                <div class="col-12">
                    <div class="label-div question-area">
                        <label>
                            Have you lived in <span class="text-c-blue">(Arizona, California, Idaho, Louisiana, Nevada,
                                New Mexico, Puerto Rico, Texas, Washington, and/or Wisconsin)</span> within the past 8
                            years?
                        </label>
                        <!-- Radio Buttons -->
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="living_domestic_partner_yes" class="d-none"
                                name="living_domestic_partner" required {{ Helper::validate_key_toggle('living_domestic_partner', $finacial_affairs, 1) }}
                                value="1">
                            <label for="living_domestic_partner_yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('living_domestic_partner', $finacial_affairs, 1) }}"
                                onclick="getLivingDomesticPartnerData('yes');">Yes</label>

                            <input type="radio" id="living_domestic_partner_no" class="d-none"
                                name="living_domestic_partner" required {{ Helper::validate_key_toggle('living_domestic_partner', $finacial_affairs, 0) }}
                                value="0">
                            <label for="living_domestic_partner_no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('living_domestic_partner', $finacial_affairs, 0) }}"
                                onclick="getLivingDomesticPartnerData('no');">No</label>
                        </div>
                    </div>
                </div>
                <!-- Condition data -->
                <div class="col-12 {{ Helper::key_hide_show_v('living_domestic_partner', $finacial_affairs) }}"
                    id="living-domestic-partner-data">
                    @include("client.questionnaire.affairs.common.parent_living_domestic_partner")
                </div>
            </div>
        </div>
        <div class="light-gray-div d-none">
            <div class="label-div question-area b-0-i">
                <div class="form-group">
                    <label>Marital Status:</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="divorced" class="d-none" name="part1[marital_status]" required {{ Helper::validate_key_toggle('marital_status', $BasicInfoPartA, 1) }} value="1">
                        <label for="divorced"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('marital_status', $BasicInfoPartA, 1)}}">Single,
                            Divorced or Widowed</label>

                        <input type="radio" id="living-together" class="d-none" name="part1[marital_status]" required
                            {{ Helper::validate_key_toggle('marital_status', $BasicInfoPartA, 2) }} value="2">
                        <label for="living-together"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('marital_status', $BasicInfoPartA, 2)}}">Married
                            & living together</label>

                        <input type="radio" id="living-apart" class="d-none" name="part1[marital_status]" required {{ Helper::validate_key_toggle('marital_status', $BasicInfoPartA, 3) }} value="3">
                        <label for="living-apart"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('marital_status', $BasicInfoPartA, 3)}}">Married
                            & living in separate households</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-btn-div">
            @if (!empty($BasicInfoPartA['id']))
            <input type="hidden" name="basicinfo_parta_id"
                value="{{ Helper::validate_key_value('id', $BasicInfoPartA) }}">
            <input type="hidden" name="basicinfo_anyothername_id"
                value="{{ Helper::validate_key_value('id', $BasicInfo_AnyOtherName) }}">
            <button type="submit"
                class="btn-new-ui-default">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}
                <i class="feather icon-chevron-right mr-0"></i></button>
            @else
            <button type="submit"
                class="btn-new-ui-default">{{ (isset($attorney_edit) && $attorney_edit == true) ? 'Save' : 'Save & Next' }}
                <i class="feather icon-chevron-right mr-0"></i></button>
            @endif
        </div>

    </form>
</div>