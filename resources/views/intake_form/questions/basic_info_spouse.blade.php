@php
    $suffixArray = \App\Helpers\ArrayHelper::getSuffixArray();
    $yesNoArray = [0 => 'Yes', 1 => 'No'];
    $spouseEmptyDivFor = !empty($showSpouseSSN) ? 1 : 0;
    $spouseEmptyDivFor = !empty($showDebtorDL) ? $spouseEmptyDivFor + 1 : $spouseEmptyDivFor;
@endphp

@if(isset($isPreviewPopup) && $isPreviewPopup)
    <div class="col-md-4">
        <div class="label-div">
            <div class="form-group">
                <label class="form-label">Is your Spouse filing with you?</label>
                <select name="spouse_filing_with_you" class="form-control">
                    @foreach($yesNoArray as $key => $val)
                        <option value="{{ $key }}" 
                                {{ (Helper::validate_key_value('spouse_filing_with_you', $formData, 'radio') == $key) ? 'selected' : (old('spouse_filing_with_you') == $key ? 'selected' : '') }}>
                            {{ $val }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-8"></div>
@endif

<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" required name="spouse_name" class="input_capitalize form-control" placeholder="First Name" value="{{ !empty(Helper::validate_key_value('spouse_name', $formData)) ? Helper::validate_key_value('spouse_name', $formData) : old('spouse_name') }}">
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Middle Name</label>
            <input type="text" name="spouse_middle_name" class="input_capitalize form-control" placeholder="Middle Name" value="{{ !empty(Helper::validate_key_value('spouse_middle_name', $formData)) ? Helper::validate_key_value('spouse_middle_name', $formData) : old('spouse_middle_name') }}">
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" required name="spouse_last_name" class="input_capitalize form-control" placeholder="Last Name" value="{{ !empty(Helper::validate_key_value('spouse_last_name', $formData)) ? Helper::validate_key_value('spouse_last_name', $formData) : old('spouse_last_name') }}">
        </div>
    </div>
</div>
<div class="col-md-2">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Suffix</label>
            <select name="spouse_suffix" class="form-control">
                <option value="">None</option>
                @foreach($suffixArray as $key => $val)
                    <option value="{{ $key }}" 
                            {{ (Helper::validate_key_value('spouse_suffix', $formData, 'radio') == $key) ? 'selected' : (old('spouse_suffix') == $key ? 'selected' : '') }}>
                        {{ $val }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Cell: (123) 456-7890</label>
            <input type="text" required name="spouse_cell" class="form-control phone-field" placeholder="Cell: (123) 456-7890"
             value="{{ !empty(Helper::validate_key_value('spouse_cell', $formData)) ? Helper::validate_key_value('spouse_cell', $formData) : old('spouse_cell') }}">
        </div>
    </div>
</div>

<div class="col-md-4 {{ $showSpouseSSN }}">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">SSN</label>
            <input type="text" required name="spouse_security_number" class="form-control is_ssn" placeholder="SSN"
             value="{{ !empty(Helper::validate_key_value('spouse_security_number', $formData)) ? Helper::validate_key_value('spouse_security_number', $formData) : old('spouse_security_number') }}">
        </div>
    </div>
</div>
<div class="col-md-4 {{ $showDebtorDL }}">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Driver's Lic/Gov. ID</label>
            <input type="text" required name="spouse_work" class="form-control" placeholder="Driver's Lic/Gov. ID"
             value="{{ !empty(Helper::validate_key_value('spouse_work', $formData)) ? Helper::validate_key_value('spouse_work', $formData) : old('spouse_work') }}">
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Date&nbsp;of&nbsp;Birth: <small>(MM/DD/YYYY)</small></label>
            <input type="text" name="spouse_date_of_birth" class="form-control date_filed" placeholder="MM/DD/YYYY"
             value="{{ !empty(Helper::validate_key_value('spouse_date_of_birth', $formData)) ? Helper::validate_key_value('spouse_date_of_birth', $formData) : old('spouse_date_of_birth') }}">
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="label-div">
        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" id="spouse_email" required name="spouse_email" class="form-control" placeholder="Email"
             value="{{ !empty(Helper::validate_key_value('spouse_email', $formData)) ? Helper::validate_key_value('spouse_email', $formData) : old('spouse_email') }}">
        </div>
    </div>
</div>