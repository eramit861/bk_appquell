@php
    $additionalLiensData = Helper::validate_key_value('additional_liens_data', $formData, 'array');
@endphp
<div class="col-md-12">
    <div class="details-banner p-3 mb-2 text-start">
        Example: A Secured Debt, is when you take out a loan on a specific item that can be taken back if you
        default on payments like a car, boat, or house. List all items that you have as secure debt(s).
    </div>
</div>
<div class="col-md-12">
    <div class="label-div question-area ">
        <label class=" form-label">Do you have any additional liens or loans secured against any real or
            personal
            property not already listed?</label>
        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" required name="additional_liens" {{ (Helper::validate_key_value('additional_liens', $formData, 'radio') === 1 || old('additional_liens') === '1') ? 'checked' : '' }} class="form-check-input" id="additional_liens_yes"
                value="1">
            <label for="additional_liens_yes" class="btn-toggle {{ (Helper::validate_key_value('additional_liens', $formData, 'radio') === 1 || old('additional_liens') === '1') ? 'active' : '' }}" onclick="addLiensChange(1)">Yes</label>
            <input type="radio" required name="additional_liens" {{ (Helper::validate_key_value('additional_liens', $formData, 'radio') === 0 || old('additional_liens') === '0') ? 'checked' : '' }} class="form-check-input" id="additional_liens_no"
                value="0">
            <label for="additional_liens_no" class="btn-toggle {{ (Helper::validate_key_value('additional_liens', $formData, 'radio') === 0 || old('additional_liens') === '0') ? 'active' : '' }}" onclick="addLiensChange(0)">No</label>
        </div>
    </div>
</div>
@php
    // Determine last initially visible index (0 is always visible; any index with data is also visible)
    $lastVisibleIndex = 0;
    if (!empty($additionalLiensData) && is_array($additionalLiensData)) {
        foreach ($additionalLiensData as $idx => $entry) {
            if (is_array($entry) && count(array_filter($entry)) > 0 && $idx > $lastVisibleIndex) {
                $lastVisibleIndex = $idx;
            }
        }
    }
@endphp
@for($i = 0; $i < 4; $i++)
    @php
        $hideClass = 'hide-data';
        $liensData = Helper::validate_key_value($i, $additionalLiensData, 'array');
        if ($i == 0 || !empty($liensData)) {
            $hideClass = '';
        }
        $addMoreHideClass = ($i == $lastVisibleIndex) ? '' : 'hide-data';
    @endphp
<div
    class="col-md-12 additional_liens_section {{ (Helper::validate_key_value('additional_liens', $formData, 'radio') === 1 || old('additional_liens') === '1') ? '' : 'hide-data' }} {{ $i == 0 ? 'mt-3 mb-0' : 'my-0'}}">
    <div class="row gx-3 additional_section_{{ $i }} {{ $hideClass }} m-0">
        <div class="light-gray-div mt-2">
            <h2>Secured Loan {{ $i + 1 }}:</h2>
            <div class="row gx-3">
                <div class="col-md-3">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">Secure creditor name</label>
                            <input type="text" autocomplete="off" autocomplete
                                class="input_capitalize form-control autocomplete secured_loans_name al_domestic_support_name required"
                                name="additional_liens_data[domestic_support_name][{{ $i }}]"
                                placeholder="Name of person" data-mcreditor="1"
                                value="{{ (Helper::validate_key_value('domestic_support_name', $liensData) !== '') ? Helper::validate_key_value('domestic_support_name', $liensData) : old('additional_liens_data[domestic_support_name][' . $i . ']') }}">

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">Secure creditor address</label>
                            <input type="text" class="form-control domestic_support_address "
                                name="additional_liens_data[domestic_support_address][{{ $i }}]"
                                placeholder="Street address of person"
                                value="{{ (Helper::validate_key_value('domestic_support_address', $liensData) !== '') ? Helper::validate_key_value('domestic_support_address', $liensData) : old('additional_liens_data[domestic_support_address][' . $i . ']') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control domestic_support_city "
                                name="additional_liens_data[domestic_support_city][{{ $i }}]"
                                placeholder="City"
                                value="{{ (Helper::validate_key_value('domestic_support_city', $liensData) !== '') ? Helper::validate_key_value('domestic_support_city', $liensData) : old('additional_liens_data[domestic_support_city][' . $i . ']') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">State</label>
                            <select class="form-control creditor_state "
                                name="additional_liens_data[creditor_state][{{ $i }}]">
                                <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesList((Helper::validate_key_value('creditor_state', $liensData) !== '') ? Helper::validate_key_value('creditor_state', $liensData) : old('additional_liens_data[creditor_state][' . $i . ']')) !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="label-div mb-3">
                        <div class="form-group">
                            <label class="form-label">Zip code</label>
                            <input type="text" class="form-control allow-5digit domestic_support_zipcode "
                                name="additional_liens_data[domestic_support_zipcode][{{ $i }}]"
                                placeholder="Zip code"
                                value="{{ (Helper::validate_key_value('domestic_support_zipcode', $liensData) !== '') ? Helper::validate_key_value('domestic_support_zipcode', $liensData) : old('additional_liens_data[domestic_support_zipcode][' . $i . ']') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="label-div mb-3">
                        <label for="secured_loans_1" class="form-label">Property Description:</label>
                        <textarea placeholder="Property Description"
                            name="additional_liens_data[describe_secure_claim][{{ $i }}]" rows="3"
                            id="secured_loans_1"
                            class="form-textarea describe_secure_claim required form-control">{{ (Helper::validate_key_value('describe_secure_claim', $liensData) !== '') ? Helper::validate_key_value('describe_secure_claim', $liensData) : old('additional_liens_data[describe_secure_claim][' . $i . ']') }}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="label-div mb-3">
                                <div class="form-group">
                                    <label class="form-label">Monthly Payment Amount</label>
                                    <div class="d-flex input-group ">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input type="text" required
                                            class="custom_corner_input form-control price-field monthly_payment "
                                            placeholder="Monthly Payment Amount"
                                            name="additional_liens_data[monthly_payment][{{ $i }}]"
                                            value="{{ (Helper::validate_key_value('monthly_payment', $liensData) !== '') ? Helper::validate_key_value('monthly_payment', $liensData) : old('additional_liens_data[monthly_payment][' . $i . ']') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="label-div mb-3">
                                <div class="form-group">
                                    <label class="form-label">Amount due</label>
                                    <div class="d-flex input-group ">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input type="text" required
                                            class="custom_corner_input form-control price-field additional_liens_due "
                                            placeholder="Amount due"
                                            name="additional_liens_data[additional_liens_due][{{ $i }}]"
                                            value="{{ (Helper::validate_key_value('additional_liens_due', $liensData) !== '') ? Helper::validate_key_value('additional_liens_due', $liensData) : old('additional_liens_data[additional_liens_due][' . $i . ']') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 ">
                            <div class="label-div">
                                <div class="form-group ">
                                    <label class="form-label">Date: (MM/YYYY)</label>
                                    <input type="text"
                                        name="additional_liens_data[additional_liens_date][{{ $i }}]"
                                        class="form-control date_filed_mm_yyyy additional_liens_date "
                                        placeholder="MM/YYYY"
                                        value="{{ (Helper::validate_key_value('additional_liens_date', $liensData) !== '') ? Helper::validate_key_value('additional_liens_date', $liensData) : old('additional_liens_data[additional_liens_date][' . $i . ']') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div
    class="col-md-12 additional_liens_section my-0 {{ (Helper::validate_key_value('additional_liens', $formData, 'radio') === 1 || old('additional_liens') === '1') ? '' : 'hide-data' }}">
    <div
        class="d-flex align-items-center {{ $addMoreHideClass }} additional_section_{{ $i }}   additional_addmore_section_{{ $i }} mb-3 mt-1">
        <button type="button"
            class="vehicle-action-btn add-btn shadow-2 rounded-0 w-auto label save-btn mx-ht im-action btn-new-ui-default m-0 py-2"
            onclick="addMoreDebtSection({{ $i }});">
            <i class="bi bi-plus-lg mr-1"></i> Add More
        </button>

        <button type="button"
            class="vehicle-action-btn delete-btn delete-div trash-btn ms-auto {{ ($i == 0) ? 'hide-data' : '' }} "
            title="Delete" onclick="removeDebtSection({{ $i }});">
            <i
                class="bi bi-trash3 mr-1 remove-btn {{ ($i == 0) ? 'hide-data' : '' }}  cursor-pointer float_right remove_clone"></i>Delete</button>
    </div>
</div>
@endfor