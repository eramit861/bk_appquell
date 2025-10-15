<div class="light-gray-border-div {{ !$step2 ? 'hidestep' : '' }}" id="basic-info-part-b">
    @push('tab_scripts')
        <script>
            window.__stepData = {
                pstatus: {{ isset($BasicInfoPartB) && !empty($BasicInfoPartB) ? 1 : 0 }},
                divId: 'basic-info-part-b'
            };
        </script>
        <script src="{{ asset('assets/js/client/common_radio_check.js') }}"></script>
    @endpush
    @php $form_route_step_2 = isset($attorney_edit) && $attorney_edit == true ? $save_route : route('client_basic_info_step2'); @endphp
    <form name="client_basic_info_step2" id="client_basic_info_step2" action="{{ $form_route_step_2 }}" method="post"
        novalidate>
        @csrf
        <div class="light-gray-div mt-2">
            <h2 class="text-bold">Name information
                <div class="d-inline-block mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                    data-bs-original-title="If you are filing jointly with your spouse, fill in the following information about your spouse">
                    <i class="bi bi-question-circle"></i>
                </div>
            </h2>
            <div class="row gx-3">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="input_capitalize form-control" required placeholder="Name"
                                name="part2[name]" value="{{ Helper::validate_key_value('name', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input type="text" class="input_capitalize form-control" placeholder="Middle Name"
                                name="part2[middle_name]"
                                value="{{ Helper::validate_key_value('middle_name', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="input_capitalize form-control required" placeholder="Last Name"
                                name="part2[last_name]"
                                value="{{ Helper::validate_key_value('last_name', $BasicInfoPartB) }}">
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
                            <select name="part2[suffix]" class="form-control">
                                <option value="">None</option>
                                @foreach ($suffixArray as $key => $val)
                                    <option value="{{ $key }}"
                                        {{ $key == Helper::validate_key_value('suffix', $BasicInfoPartB) ? 'selected' : '' }}>
                                        {{ $val }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="label-div question-area border-0">
                        <label>Has your spouse used any other names in the past 8 years?
                            <p class="text-bold mb-0 text-bold">
                                <span class="text-c-blue">(For example: a maiden name, a previous married name, or a nickname you go by.)</span>
                            </p>
                        </label>
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="past8years-no" class="d-none" name="part2[spouse_any_other_name]"
                                value="0" required
                                {{ Helper::validate_key_toggle('spouse_any_other_name', $BasicInfoPartB, 0) }}>
                            <label for="past8years-no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('spouse_any_other_name', $BasicInfoPartB, 0) }}"
                                onclick="common_toggle_fn('no','spouse_any_other_name_data');">No</label>

                            <input type="radio" id="past8years-yes" class="d-none" name="part2[spouse_any_other_name]"
                                value="1" required
                                {{ Helper::validate_key_toggle('spouse_any_other_name', $BasicInfoPartB, 1) }}>
                            <label for="past8years-yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('spouse_any_other_name', $BasicInfoPartB, 1) }}"
                                onclick="common_toggle_fn('yes','spouse_any_other_name_data');">Yes</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 {{ Helper::key_hide_show_v('spouse_any_other_name', $BasicInfoPartB) }}"
                    id="spouse_any_other_name_data">
                    <div class="outline-gray-border-area">
                        <div class="light-gray-box-tittle-div">
                            <h2>Other Names Used</h2>
                        </div>

                        @if (!empty($BasicInfoPartB['spouse_other_name']) && is_array($BasicInfoPartB['spouse_other_name']))
                            @for ($j = 0; $j < count($BasicInfoPartB['spouse_other_name']); $j++)
                                @include(
                                    'client.questionnaire.basic.common.spouse_other_names',
                                    $BasicInfoPartB)
                            @endfor
                        @else
                            @include(
                                'client.questionnaire.basic.common.spouse_other_names',
                                $BasicInfoPartB)
                        @endif

                        <div class="add-more-div-bottom">
                            <button type="button" class="btn-new-ui-default py-1 px-2"
                                onclick="spouse_addOther_names(); return false;">
                                <i class="bi bi-plus-lg"></i>
                                Add Additional Name(s)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="light-gray-div">
            <h2 class="text-bold">Identification and Verification</h2>
            <div class="row gx-3">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label>Cell Phone</label>
                            <input type="text" name="part2[part2_phone]" id="part2_phone"
                                class="form-control phone-field required" placeholder="Phone no."
                                value="{{ Helper::validate_key_value('part2_phone', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Identification Type</label>
                            <select onchange="chooseTypeSpouse(this)" id="debtor_ssn_type_spouse"
                                class="form-control required" name="part2[has_security_number]">
                                <option disabled="">Please Select Type</option>
                                <option {{ Helper::validate_key_option('has_security_number', $BasicInfoPartB, 0) }}
                                    value="0">SSN</option>
                                <option {{ Helper::validate_key_option('has_security_number', $BasicInfoPartB, 1) }}
                                    value="1">ITIN</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div
                        class="label-div ssn_no_spouse {{ Helper::validate_key_value('has_security_number', $BasicInfoPartB) == 1 ? 'hide-data' : '' }}">
                        <div class="form-group">
                            <label>SSN</label>
                            <input type="text" name="part2[social_security_number]"
                                class="form-control is_ssn security_number_secp2 required"
                                placeholder="Social Security Number"
                                value="{{ Helper::validate_key_value('social_security_number', $BasicInfoPartB) }}">
                        </div>
                    </div>
                    <div
                        class="label-div itin_no_spouse {{ Helper::validate_key_value('has_security_number', $BasicInfoPartB) != 1 ? 'hide-data' : '' }}">
                        <div class="form-group">
                            <label>ITIN</label>
                            <input type="text" name="part2[itin]" id="part2_itin" class="is_ssn form-control"
                                placeholder="ITIN" value="{{ Helper::validate_key_value('itin', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Driver’s License / Gov ID</label>
                            <input type="text" name="part2[part2_driving_license]" id="part2_driving_license"
                                class="form-control required" placeholder="Driver's Lic/Gov. ID"
                                value="{{ Helper::validate_key_value('part2_driving_license', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-12">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="text" name="part2[part2_dob]" id="part2_dob"
                                class="form-control required max-today-date" placeholder="MM/DD/YYYY"
                                value="{{ Helper::validate_key_value('part2_dob', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 d-none">
                    <div class="label-div">
                        <div class="form-group d-none">
                            <label>Driver's License Number</label>
                            <input type="number" name="part2[license_number]" class="form-control required"
                                placeholder="Driver's License Number" value="{{ Helper::validate_key_value('license_number', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 d-none">
                    <div class="label-div">
                        <div class="form-group">
                            <label>Expiration Date</label>
                            <input type="date" name="part2[expiration_date]"
                                class="form-control date_filed  required" placeholder="MM/DD/YYYY"
                                value="{{ Helper::validate_key_value('expiration_date', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 d-none">
                    <div class="label-div">
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="part2[state]" class="form-control required"
                                placeholder="State" value="{{ Helper::validate_key_value('state', $BasicInfoPartB) }}">
                        </div>
                    </div>
                </div>

                <div class="col-12 d-none">
                    <div class="label-div question-area">
                        <label for="residency_180_days">Has your spouse used any business names or Employer
                            Identification Numbers (EIN) in the last 8 years?</label>
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="einpast8years-no" name="part2[spouse_has_ein]" required
                                {{ Helper::validate_key_toggle('spouse_has_ein', $BasicInfoPartB, 0) }}>
                            <label for="einpast8years-no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('spouse_has_ein', $BasicInfoPartB, 0) }}">No</label>

                            <input type="radio" id="EIN-yes" name="part2[spouse_has_ein]" required
                                {{ Helper::validate_key_toggle('spouse_has_ein', $BasicInfoPartB, 1) }}>
                            <label for="EIN-yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('spouse_has_ein', $BasicInfoPartB, 1) }}">Yes</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="light-gray-div">
            <h2 class="text-bold">Previous Addresses</h2>
            <div class="row gx-3">
                <input type="hidden" name="part2[lived_address_from_180]" value="0">

                <div class="col-12">
                    <div class="label-div question-area">
                        <label> Do you and your spouse/partner live together?
                        </label>
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Confirm if you and your spouse/partner have lived together. If not, provide your previous address details.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <div class="custom-radio-group form-group">
                            <input type="radio" id="spouse_different_address-no"
                                name="part2[spouse_different_address]" required class="d-none"
                                {{ Helper::validate_key_toggle('spouse_different_address', $BasicInfoPartB, 0) }}
                                value="0">
                            <label for="spouse_different_address-no"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('spouse_different_address', $BasicInfoPartB, 0) }}"
                                onclick="common_toggle_fn('no','condition_spouse_different_address');">Yes</label>

                            <input type="radio" id="spouse_different_address-yes"
                                name="part2[spouse_different_address]" required class="d-none"
                                {{ Helper::validate_key_toggle('spouse_different_address', $BasicInfoPartB, 1) }}
                                value="1">
                            <label for="spouse_different_address-yes"
                                class="btn-toggle {{ Helper::validate_key_toggle_active('spouse_different_address', $BasicInfoPartB, 1) }}"
                                onclick="common_toggle_fn('yes','condition_spouse_different_address');">No</label>
                        </div>
                    </div>

                    <!-- List Previous Addresses (Last 3 Years) -->
                    <div id="condition_spouse_different_address"
                        class="col-12 {{ Helper::key_hide_show_v('spouse_different_address', $BasicInfoPartB) }} pt-3">

                        <div class="outline-gray-border-area">
                            <div class="light-gray-div">
                                <h2 style="padding-left: 10px;">Address Details</h2>
                                <div class="row gx-3">
                                    <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <input type="text" name="part2[Address]"
                                                    class="input_capitalize form-control required"
                                                    placeholder="Address"
                                                    value="{{ Helper::validate_key_value('Address', $BasicInfoPartB) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input type="text" name="part2[City]"
                                                    class="input_capitalize form-control required" placeholder="City"
                                                    value="{{ Helper::validate_key_value('City', $BasicInfoPartB) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>State</label>
                                                <select name="part2[state]" id="debtor2_state"
                                                    class="form-control required">
                                                    <option value="">Please Select State</option>
                                                    {!! AddressHelper::getStatesList(Helper::validate_key_value('state', $BasicInfoPartB)) !!}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>ZIP Code</label>
                                                <input type="number" name="part2[zip]"
                                                    class="form-control allow-5digit required" placeholder="Zip"
                                                    value="{{ Helper::validate_key_value('zip', $BasicInfoPartB) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>County</label>
                                                <select name="part2[country]" id="state_based_county2"
                                                    class="form-control">
                                                    <option value="">Choose County</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-btn-div">
            @if (!empty($BasicInfoPartB['id']))
                <input type="hidden" name="basicinfo_partb_id" value="{{ $BasicInfoPartB['id'] }}">
                <a href="{{ route('client_dashboard') }}"
                    class="btn-new-ui-default mr-2 {{ App\Helpers\ClientHelper::hideBackOnEditPopup($attorney_edit ?? '') }}">Back
                    to Previous Page</a>
                <button type="submit"
                    class="btn-new-ui-default">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                    <i class="feather icon-chevron-right mr-0"></i></button>
            @else
                <button type="submit"
                    class="btn-new-ui-default">{{ isset($attorney_edit) && $attorney_edit == true ? 'Save' : 'Save & Next' }}
                    <i class="feather icon-chevron-right mr-0"></i></button>
            @endif
        </div>

    </form>
</div>
