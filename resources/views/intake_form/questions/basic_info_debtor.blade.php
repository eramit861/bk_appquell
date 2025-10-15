@php
    $suffixArray = \App\Helpers\ArrayHelper::getSuffixArray();
@endphp

<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">First Name </label>
            <input type="text" required 
                   name="name" class="input_capitalize form-control required" placeholder="First Name" value="{{ !empty(Helper::validate_key_value('name', $formData)) ? Helper::validate_key_value('name', $formData) : old('name') }}">
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Middle Name </label>
            <input type="text" 
                   name="middle_name" class="input_capitalize form-control" placeholder="Middle Name" value="{{ !empty(Helper::validate_key_value('middle_name', $formData)) ? Helper::validate_key_value('middle_name', $formData) : old('middle_name') }}">
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Last Name </label>
            <input type="text" required name="last_name" class="input_capitalize form-control" placeholder="Last Name" value="{{ !empty(Helper::validate_key_value('last_name', $formData)) ? Helper::validate_key_value('last_name', $formData) : old('last_name') }}">
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Suffix </label>
            <select name="suffix" class="form-control">
                <option value="">None</option>
                @foreach($suffixArray as $key => $val)
                    <option value="{{ $key }}" 
                            {{ (!empty(Helper::validate_key_value('suffix', $formData, 'radio')) && Helper::validate_key_value('suffix', $formData, 'radio') == $key) ? 'selected' : (old('suffix') == $key ? 'selected' : '') }}>
                        {{ $val }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Home</label>
            <input type="text" required name="home" class="form-control phone-field" placeholder="Home: (123) 456-7890" value="{{ !empty(Helper::validate_key_value('home', $formData)) ? Helper::validate_key_value('home', $formData) : old('home') }}">
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Cell</label>
            <input type="text" required name="cell" class="form-control phone-field" placeholder="Cell: (123) 456-7890" value="{{ !empty(Helper::validate_key_value('cell', $formData)) ? Helper::validate_key_value('cell', $formData) : old('cell') }}">
        </div>
    </div>
</div>

@php
    $emptyDivFor = !empty($showDebtorSSN) ? 1 : 0;
    $emptyDivFor = !empty($showDebtorDL) ? $emptyDivFor + 1 : $emptyDivFor;
@endphp

<div class="col-md-3 {{ $showDebtorSSN }}">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">SSN</label>
            <input type="text" required name="security_number" class="form-control is_ssn" placeholder="SSN" value="{{ !empty(Helper::validate_key_value('security_number', $formData)) ? Helper::validate_key_value('security_number', $formData) : old('security_number') }}">
        </div>
    </div>
</div>

<div class="col-md-3 {{ $showDebtorDL }}">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Driver's Lic/Gov. ID</label>
            <input type="text" required name="work" class="form-control" placeholder="Driver's Lic/Gov. ID" value="{{ !empty(Helper::validate_key_value('work', $formData)) ? Helper::validate_key_value('work', $formData) : old('work') }}">
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Date of Birth: <small>(MM/DD/YYYY)</small></label>
            <input type="text" name="date_of_birth" class="form-control date_filed" placeholder="MM/DD/YYYY" value="{{ !empty(Helper::validate_key_value('date_of_birth', $formData)) ? Helper::validate_key_value('date_of_birth', $formData) : old('date_of_birth') }}">
        </div>
    </div>
</div>
<div class="col-md-{{ (!empty($showDebtorSSN) && !empty($showDebtorDL)) ? '3' : '3' }} email-div">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" id="client_email" required name="email" class="form-control" placeholder="Email" value="{{ !empty(Helper::validate_key_value('email', $formData)) ? Helper::validate_key_value('email', $formData) : old('email') }}">
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Address</label>
            <input type="text" required name="Address" class="form-control" placeholder="Address" value="{{ !empty(Helper::validate_key_value('Address', $formData)) ? Helper::validate_key_value('Address', $formData) : old('Address') }}">
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">City</label>
            <input type="text" required name="City" class="form-control" placeholder="City" value="{{ !empty(Helper::validate_key_value('City', $formData)) ? Helper::validate_key_value('City', $formData) : old('City') }}">
        </div>
    </div>
</div>

@php
    $stateD1 = Helper::validate_key_value('state', $formData);
    $countyD1 = Helper::validate_key_value('country', $formData);
@endphp

<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">State</label>
            <select name="state" required class="form-control" id="debtor_state">
                <option value="">Select State</option>
                {!! \App\Helpers\AddressHelper::getStatesList(!empty($stateD1) ? $stateD1 : old('state')) !!}
            </select>
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Zip</label>
            <input type="text" required name="zip" class="allow-5digit form-control" placeholder="Zip" value="{{ !empty(Helper::validate_key_value('zip', $formData)) ? Helper::validate_key_value('zip', $formData) : old('zip') }}">
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">County</label>
            <select name="country" required id="state_based_county" class="form-control" data-value="{{ !empty($countyD1) ? $countyD1 : old('country') }}">
                <option value="0">Choose County</option>
            </select>
        </div>
    </div>
</div>
<div class="col-md-6 hide-data itin_no">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">ITIN:</label>
            <input type="text" required name="itin" class="form-control is_ssn" placeholder="Individual Taxpayer Identification Numbers" value="{{ !empty(Helper::validate_key_value('itin', $formData)) ? Helper::validate_key_value('itin', $formData) : old('itin') }}">
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class="form-label">If you filed Chapter 13 in the last 2 years, how have your circumstances improved?</label>
            <input type="text" name="chapter_13_filed_info" class="form-control" placeholder="" value="{{ !empty(Helper::validate_key_value('chapter_13_filed_info', $formData)) ? Helper::validate_key_value('chapter_13_filed_info', $formData) : old('chapter_13_filed_info') }}">
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="label-div question-area">
        <label>Have you lived at this address for at least 180 days?</label>

        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" name="lived_address_from_180" id="lived_address_from_180_yes" class="" value="1"
                   {{ (Helper::validate_key_value('lived_address_from_180', $formData, 'radio') === 1 || old('lived_address_from_180') === '1') ? 'checked' : '' }}>
            <label for="lived_address_from_180_yes" 
                class="btn-toggle {{ \App\Helpers\Helper::validate_key_toggle_active('lived_address_from_180', $formData, 1) }}">Yes</label>

            <input type="radio" name="lived_address_from_180" id="lived_address_from_180_no" class="" value="0"
                   {{ (Helper::validate_key_value('lived_address_from_180', $formData, 'radio') === 0 || old('lived_address_from_180') === '0') ? 'checked' : '' }}>
            <label for="lived_address_from_180_no"
                class="btn-toggle {{ \App\Helpers\Helper::validate_key_toggle_active('lived_address_from_180', $formData, 0) }}">No</label>
        </div>
    </div>
</div>

@php
    $lived_in_nc_month = !empty(Helper::validate_key_value('lived_in_nc_month', $formData)) ? Helper::validate_key_value('lived_in_nc_month', $formData) : old('lived_in_nc_month');
    $lived_in_nc_year = !empty(Helper::validate_key_value('lived_in_nc_year', $formData)) ? Helper::validate_key_value('lived_in_nc_year', $formData) : old('lived_in_nc_year');
@endphp

<div class="col-md-12">
    <div class="label-div question-area border-0">
        <div class="row align-items-center g-2">
            <div class="col-auto">
                <label class="mb-0">How long have you lived in {{ isset($attorney_company->attorney_state) && !empty($attorney_company->attorney_state) ? \App\Helpers\AddressHelper::getStateNameByCode($attorney_company->attorney_state) : 'N/A' }}?</label>
            </div>
            <div class="col-auto">
                <select name="lived_in_nc_month" class="form-control d-inline-block w-auto ml-auto mr-0">
                    <option value="">Select Month</option>
                    @foreach(range(1, 12) as $month)
                        @php
                            $monthN = \Carbon\Carbon::create()->month($month)->format('F');
                        @endphp
                        <option value="{{ $monthN }}" {{ $lived_in_nc_month == $monthN ? 'selected' : '' }}>{{ $monthN }}</option>
                    @endforeach
                </select>  
            </div>
            <div class="col-auto">
                <select name="lived_in_nc_year" class="form-control d-inline-block w-auto ml-auto mr-0">
                    <option value="">Select Year</option>
                    @foreach(range(1980, now()->year) as $year)
                        <option value="{{ $year }}" {{ $lived_in_nc_year == $year ? 'selected' : '' }}>{{ $year }}</option>
                    @endforeach
                </select>  
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="label-div question-area">
        <label>Have you ever filed a bankruptcy case before?</label>

        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" name="filed_in_last_8_yrs" id="filed_in_last_8_yrs_yes" class="" value="0" 
                   {{ (Helper::validate_key_value('filed_in_last_8_yrs', $formData, 'radio') === 0 || old('filed_in_last_8_yrs') === '0') ? 'checked' : '' }}>
            <label for="filed_in_last_8_yrs_yes" class="btn-toggle {{ \App\Helpers\Helper::validate_key_toggle_active('filed_in_last_8_yrs', $formData, 0) }}" onclick="filedBankruptcyCase(0)">Yes</label>

            <input type="radio" name="filed_in_last_8_yrs" id="filed_in_last_8_yrs_no" class="" value="1" 
                   {{ (Helper::validate_key_value('filed_in_last_8_yrs', $formData, 'radio') === 1 || old('filed_in_last_8_yrs') === '1') ? 'checked' : '' }}>
            <label for="filed_in_last_8_yrs_no" class="btn-toggle {{ \App\Helpers\Helper::validate_key_toggle_active('filed_in_last_8_yrs', $formData, 1) }}" onclick="filedBankruptcyCase(1)">No</label>
        </div>
        <div class="past_8_year_section {{ (Helper::validate_key_value('filed_in_last_8_yrs', $formData, 'radio') == 0) ? '' : 'hide-data' }}">
            <input type="hidden" name="chapter" value="7">
            <input type="hidden" name="date_filed" value="">
        </div>
    </div>
</div>

@php
    $prevCaseCount = 1;
    $prevCaseData = Helper::validate_key_value('any_bankruptcy_filed_before_data', $formData, 'array');
    if (!empty($prevCaseData)) {
        $caseName = Helper::validate_key_value('case_name', $prevCaseData, 'array');
        $prevCaseCount = count($caseName);
    }
@endphp

<div class="col-md-12 past_8_year_section {{ (Helper::validate_key_value('filed_in_last_8_yrs', $formData, 'radio') == 0) ? '' : 'hide-data' }} mt-3 mb-0">
    @for($i = 0; $i < $prevCaseCount; $i++)
        @php
            // Default hidden
            $addMoreHideClass = 'hide-data';
            $deleteHideClass = 'hide-data';

            // Add More button rules
            if ($prevCaseCount == 1 && $i == 0) {
                // Only one case → show Add More on first (only) loop
                $addMoreHideClass = '';
            } elseif ($prevCaseCount == 2 && $i == 1) {
                // Two cases → show Add More only on last loop
                $addMoreHideClass = '';
            } elseif ($prevCaseCount == 3 && $i < 2) {
                // Three cases → show Add More only on first and second loop
                $addMoreHideClass = '';
            }

            if ($prevCaseCount == 3) {
                $addMoreHideClass = 'hide-data';
            }

            // Delete button rules
            if ($prevCaseCount > 1 && $i == $prevCaseCount - 1) {
                // Show Delete only on the last loop if more than 1 case
                $deleteHideClass = '';
            }
        @endphp

        <div class="row gx-3 additional_case_section additional_case_section_{{ $i }} m-0">
            <div class="light-gray-div mt-2">
                <h2>Previous Case {{ $i + 1 }}:</h2>
                <div class="row gx-3">
                    <div class="col-md-4">
                        <div class="label-div mb-3">
                            <div class="form-group">
                                <label class="form-label">Case Name</label>
                                <input type="text"
                                    class="input_capitalize form-control required"
                                    name="any_bankruptcy_filed_before_data[case_name][{{ $i }}]"
                                    placeholder="Case Name"
                                    value="{{ Helper::validate_key_loop_value('case_name', $prevCaseData, $i) }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="label-div mb-3">
                            <div class="form-group">
                                <label class="form-label">Date Filed</label>
                                <input type="text"
                                    class="input_capitalize form-control date_filed {{ Helper::validate_key_loop_value('data_field_unsure', $prevCaseData, $i) == 'on' ? '' : 'required' }} date-filed-input"
                                    name="any_bankruptcy_filed_before_data[data_field][{{ $i }}]"
                                    placeholder="MM/DD/YYYY"
                                    value="{{ Helper::validate_key_loop_value('data_field', $prevCaseData, $i) }}">
                                <div class="form-check">
                                    <input class="form-check-input date-filed-unknown" 
                                        type="checkbox"
                                        id="date_filed_unknown_{{ $i }}"
                                        name="any_bankruptcy_filed_before_data[data_field_unsure][{{ $i }}]"
                                        onclick="toggleRequired('date-filed-input', this)"
                                        {{ Helper::validate_key_loop_value('data_field_unsure', $prevCaseData, $i) == 'on' ? 'checked' : '' }}>
                                    <label class="form-check-label form-label"
                                        for="date_filed_unknown_{{ $i }}"><small>Unsure</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="label-div mb-3">
                            <div class="form-group">
                                <label class="form-label">Case Number</label>
                                <input type="text"
                                    class="input_capitalize form-control {{ Helper::validate_key_loop_value('case_numbers_unknown', $prevCaseData, $i) == 'on' ? '' : 'required' }} case-number-input"
                                    name="any_bankruptcy_filed_before_data[case_numbers][{{ $i }}]"
                                    placeholder="Case Number"
                                    value="{{ Helper::validate_key_loop_value('case_numbers', $prevCaseData, $i) }}">
                                <div class="form-check">
                                    <input class="form-check-input case-number-unknown" 
                                        type="checkbox"
                                        id="case_number_unknown_{{ $i }}"
                                        name="any_bankruptcy_filed_before_data[case_numbers_unknown][{{ $i }}]"
                                        onclick="toggleRequired('case-number-input', this)"
                                        {{ Helper::validate_key_loop_value('case_numbers_unknown', $prevCaseData, $i) == 'on' ? 'checked' : '' }}>
                                    <label class="form-check-label form-label"
                                        for="case_number_unknown_{{ $i }}"><small>Unknown</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="label-div mb-3">
                            <div class="form-group">
                                <label class="form-label">District if (known)</label>
                                <select name="any_bankruptcy_filed_before_data[district_if_known][{{ $i }}]" required class="form-control required">
                                    <option value="">Select District</option>
                                    @php $groups = []; @endphp
                                    @foreach($district_names as $district_name)
                                        @if(!in_array($district_name->short_name, $groups))
                                            <optgroup label="{{ $district_name->short_name }}"></optgroup>
                                            @php array_push($groups, $district_name->short_name); @endphp
                                        @endif
                                        <option value="{{ $district_name->district_name }}" 
                                                data-name="{{ $district_name->short_name }}" 
                                                data-id="{{ $district_name->id }}" 
                                                class="form-control"
                                                {{ Helper::validate_key_loop_value('district_if_known', $prevCaseData, $i) == $district_name->district_name ? 'selected' : '' }}>
                                            {{ str_replace('Of', 'of', $district_name->district_name) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center additional_case_section_{{ $i }} additional_addmore_section_{{ $i }} prev-case-addmore">
            <button type="button"
                class="{{ $addMoreHideClass }} vehicle-action-btn add-btn shadow-2 rounded-0 w-auto label save-btn mx-ht im-action btn-new-ui-default m-0 py-2"
                onclick="addMorePrevCaseSection({{ $i }});">
                <i class="bi bi-plus-lg mr-1"></i> Add More
            </button>

            <button type="button"
                class="{{ $deleteHideClass }} vehicle-action-btn delete-btn delete-div trash-btn ms-auto {{ ($i == 0) ? 'hide-data' : '' }}"
                title="Delete" onclick="removePrevCaseSection({{ $i }});">
                <i class="bi bi-trash3 mr-1 remove-btn cursor-pointer float_right remove_clone"></i>Delete</button>
        </div>
    @endfor
</div>

<div class="col-md-12">
    <div class="label-div question-area border-0">
        <div class="row align-items-center g-2">
            <div class="col-auto">
                <label class="mb-0">What is the total number of people living in your household including your spouse:</label>
            </div>
            <div class="col-auto">
                <select required 
                        id="family_members"
                        class="form-control d-inline-block w-auto required ml-auto mr-0" 
                        name="family_members">
                    <option value=""># No.</option>
                    @foreach(range(1, 12) as $i)
                        <option value="{{ $i }}" 
                                {{ (Helper::validate_key_value('family_members', $formData, 'radio') == $i) ? 'selected' : (old('family_members') == $i ? 'selected' : '') }}>
                            {{ $i }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>