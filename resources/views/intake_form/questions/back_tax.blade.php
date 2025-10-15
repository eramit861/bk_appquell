<div class="col-md-12 ">
    <div class="label-div question-area ">
        <label class="form-label">Have you filed all of your Federal & State Tax Returns over the last 5
            years</label>
        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" required name="last_5_year_taxes" class="form-check-input" {{ (Helper::validate_key_value('last_5_year_taxes', $formData, 'radio') === 1 || old('last_5_year_taxes') === '1') ? 'checked' : '' }} id="last_5_year_taxes_yes" value="1">
            <label for="last_5_year_taxes_yes"
                class="btn-toggle {{ (Helper::validate_key_value('last_5_year_taxes', $formData, 'radio') === 1 || old('last_5_year_taxes') === '1') ? 'active' : '' }}">Yes</label>
            <input type="radio" required name="last_5_year_taxes" class="form-check-input" {{ (Helper::validate_key_value('last_5_year_taxes', $formData, 'radio') === 0 || old('last_5_year_taxes') === '0') ? 'checked' : '' }} id="last_5_year_taxes_no" value="0">
            <label for="last_5_year_taxes_no"
                class="btn-toggle {{ (Helper::validate_key_value('last_5_year_taxes', $formData, 'radio') === 0 || old('last_5_year_taxes') === '0') ? 'active' : '' }}">No</label>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="light-gray-div mt-2">
        <h2 class="">IRS and State Back Taxes</h2>
        <div class="label-div question-area mb-3">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label class="form-label">Do you owe any back taxes to the <i class="text-c-blue">IRS?</i></label>
                    <!-- Radio -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" required name="tax_owned_irs" class="form-check-input" {{ (Helper::validate_key_value('tax_owned_irs', $formData, 'radio') === 1 || old('tax_owned_irs') === '1') ? 'checked' : '' }} id="tax-owned-irs_yes" value="1">

                        <label for="tax-owned-irs_yes"
                            class="btn-toggle {{ (Helper::validate_key_value('tax_owned_irs', $formData, 'radio') === 1 || old('tax_owned_irs') === '1') ? 'active' : '' }}"
                            onclick="oweIRSChange(1)">Yes</label>
                        <input type="radio" required name="tax_owned_irs" class="form-check-input" {{ (Helper::validate_key_value('tax_owned_irs', $formData, 'radio') === 0 || old('tax_owned_irs') === '0') ? 'checked' : '' }} id="tax-owned-irs_no" value="0">
                        <label for="tax-owned-irs_no"
                            class="btn-toggle {{ (Helper::validate_key_value('tax_owned_irs', $formData, 'radio') === 0 || old('tax_owned_irs') === '0') ? 'active' : '' }}"
                            onclick="oweIRSChange(0)">No</label>
                    </div>
                </div>
                <div
                    class="col-md-6 irs_section {{ (Helper::validate_key_value('tax_owned_irs', $formData, 'radio') === 1 || old('tax_owned_irs') === '1') ? '' : 'hide-data' }}">
                    <div class="label-div p-0 question-area border-0 mb-0">
                        <div class="form-group ">
                            <label class="">Input which year(s)</label>
                            <input type="text" required name="taxes_internal_revenue_year" class="form-control "
                                placeholder="Input which year(s)"
                                value="{{ !empty(Helper::validate_key_value('taxes_internal_revenue_year', $formData)) ? Helper::validate_key_value('taxes_internal_revenue_year', $formData) : old('taxes_internal_revenue_year') }}">
                        </div>
                    </div>
                </div>
                <div
                    class="col-md-6 irs_section {{ (Helper::validate_key_value('tax_owned_irs', $formData, 'radio') === 1 || old('tax_owned_irs') === '1') ? '' : 'hide-data' }}">
                    <div class="label-div p-0 question-area border-0 mb-0">
                        <div class="form-group">
                            <label class="">Estimated Amount Due</label>
                            <div class="d-flex input-group mb-0">
                                <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                                <input type="text" required class="custom_corner_input form-control price-field"
                                    placeholder="Estimated Amount Due" name="taxes_irs_taxes_due"
                                    value="{{ !empty(Helper::validate_key_value('taxes_irs_taxes_due', $formData)) ? Helper::validate_key_value('taxes_irs_taxes_due', $formData) : old('taxes_irs_taxes_due') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="label-div question-area mb-3">
            <div class="mb-3">
                <label class="form-label">Do you owe any back taxes to any State agencies?</label>
                <!-- Radio -->
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="back_taxes_owed" class="form-check-input" {{ (Helper::validate_key_value('back_taxes_owed', $formData, 'radio') === 1 || old('back_taxes_owed') === '1') ? 'checked' : '' }} id="back_taxes_owed_yes" value="1">
                    <label for="back_taxes_owed_yes"
                        class="btn-toggle {{ (Helper::validate_key_value('back_taxes_owed', $formData, 'radio') === 1 || old('back_taxes_owed') === '1') ? 'active' : '' }}"
                        onclick="oweBackTaxChange(1)">Yes</label>
                    <input type="radio" required name="back_taxes_owed" class="form-check-input" {{ (Helper::validate_key_value('back_taxes_owed', $formData, 'radio') === 0 || old('back_taxes_owed') === '0') ? 'checked' : '' }} id="back_taxes_owed_no" value="0">
                    <label for="back_taxes_owed_no"
                        class="btn-toggle {{ (Helper::validate_key_value('back_taxes_owed', $formData, 'radio') === 0 || old('back_taxes_owed') === '0') ? 'active' : '' }}"
                        onclick="oweBackTaxChange(0)">No</label>
                </div>
            </div>
            <div
                class="row back_taxes_owed_section {{ (Helper::validate_key_value('back_taxes_owed', $formData, 'radio') === 1 || old('back_taxes_owed') === '1') ? '' : 'hide-data' }}">
                <div class="col-md-6">
                    <div class="label-div mb-3 p-0 question-area border-0 ">
                        <div class="form-group">
                            <label>State</label>
                            <select class="form-control  h-36px" required onchange="" name="taxes_tax_state">
                                <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesList((Helper::validate_key_value('taxes_tax_state', $formData) !== '') ? Helper::validate_key_value('taxes_tax_state', $formData) : old('taxes_tax_state')) !!}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="label-div mb-3 p-0 question-area border-0 ">
                        <div class="form-group ">
                            <label class="">Input which year(s)</label>
                            <input required type="text" name="taxes_franchise_tax_board" class="form-control"
                                placeholder="Input which year(s)"
                                value="{{ !empty(Helper::validate_key_value('taxes_franchise_tax_board', $formData)) ? Helper::validate_key_value('taxes_franchise_tax_board', $formData) : old('taxes_franchise_tax_board') }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="label-div p-0 question-area border-0 ">
                        <div class="form-group ">
                            <label class="">Estimated Amount Due</label>
                            <div class="d-flex input-group mb-0 ">
                                <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                                <input required type="text" class="custom_corner_input form-control price-field"
                                    placeholder="Estimated Amount Due" name="taxes_state_tax_due"
                                    value="{{ !empty(Helper::validate_key_value('taxes_state_tax_due', $formData)) ? Helper::validate_key_value('taxes_state_tax_due', $formData) : old('taxes_state_tax_due') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="label-div question-area mb-3">
            <div class="mb-3">
                <label class=" form-label">Do you owe Child Support/Alimony?</label>
                <!-- Radio -->
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="child_supp_or_alimony" class="form-check-input" {{ (Helper::validate_key_value('child_supp_or_alimony', $formData, 'radio') === 0 || old('child_supp_or_alimony') === '0') ? 'checked' : '' }} id="child_supp_or_alimony_yes"
                        value="0">
                    <label for="child_supp_or_alimony_yes"
                        class="btn-toggle {{ (Helper::validate_key_value('child_supp_or_alimony', $formData, 'radio') === 0 || old('child_supp_or_alimony') === '0') ? 'active' : '' }}"
                        onclick="childSuppAndAlimonyChange(0)">Yes</label>
                    <input type="radio" required name="child_supp_or_alimony" class="form-check-input" {{ (Helper::validate_key_value('child_supp_or_alimony', $formData, 'radio') === 1 || old('child_supp_or_alimony') === '1') ? 'checked' : '' }} id="child_supp_or_alimony_no"
                        value="1">
                    <label for="child_supp_or_alimony_no"
                        class="btn-toggle {{ (Helper::validate_key_value('child_supp_or_alimony', $formData, 'radio') === 1 || old('child_supp_or_alimony') === '1') ? 'active' : '' }}"
                        onclick="childSuppAndAlimonyChange(1)">No</label>
                </div>
            </div>
            <div
                class="row child_supp_or_alimony_section {{ (Helper::validate_key_value('child_supp_or_alimony', $formData, 'radio') === 0 || old('child_supp_or_alimony') === '0') ? '' : 'hide-data' }}">
                <div class="col-md-6">
                    <div class="label-div p-0 question-area border-0 ">
                        <div class="form-group">
                            <label> Select state: </label>
                            <select class="form-control max-w-280px h-36px" required onchange=""
                                name="taxes_child_support_state">
                                <option value="">Please Select State</option>
                                {!! AddressHelper::getStatesList((Helper::validate_key_value('taxes_child_support_state', $formData) !== '') ? Helper::validate_key_value('taxes_child_support_state', $formData) : old('taxes_child_support_state')) !!}
                            </select>
                        </div>
                    </div>

                </div>
                <div class="col-md-6 ">
                    <div class="label-div p-0 question-area border-0 w-280px">
                        <div class="form-group ">
                            <label class="">Your Monthly Payment Amount</label>
                            <div class="d-flex input-group max-w-280px mb-0">
                                <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                                <input required type="text" class="custom_corner_input form-control price-field"
                                    placeholder="Enter Your Monthly Payment Amount" name="taxes_child_support_due"
                                    value="{{ !empty(Helper::validate_key_value('taxes_child_support_due', $formData)) ? Helper::validate_key_value('taxes_child_support_due', $formData) : old('taxes_child_support_due') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="label-div question-area">
            <div class="mb-3">
                <label class="form-label">Are you current on your support obiligation(s)?</label>
                <!-- Radio -->
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="current_on_your_support_obligation" class="form-check-input"
                        {{ (Helper::validate_key_value('current_on_your_support_obligation', $formData, 'radio') === 0 || old('current_on_your_support_obligation') === '0') ? 'checked' : '' }}
                        id="current_on_your_support_obligation_yes" value="0">
                    <label for="current_on_your_support_obligation_yes"
                        class="btn-toggle {{ (Helper::validate_key_value('current_on_your_support_obligation', $formData, 'radio') === 0 || old('current_on_your_support_obligation') === '0') ? 'active' : '' }}"
                        onclick="currSuppObligChange(0)">Yes</label>
                    <input type="radio" required name="current_on_your_support_obligation" class="form-check-input"
                        {{ (Helper::validate_key_value('current_on_your_support_obligation', $formData, 'radio') === 1 || old('current_on_your_support_obligation') === '1') ? 'checked' : '' }}
                        id="current_on_your_support_obligation_no" value="1">
                    <label for="current_on_your_support_obligation_no"
                        class="btn-toggle {{ (Helper::validate_key_value('current_on_your_support_obligation', $formData, 'radio') === 1 || old('current_on_your_support_obligation') === '1') ? 'active' : '' }}"
                        onclick="currSuppObligChange(1)">No</label>
                </div>
            </div>
            <div
                class="row align-items-start child_supp_or_alimony_section {{ (Helper::validate_key_value('child_supp_or_alimony', $formData, 'radio') === 0 || old('child_supp_or_alimony') === '0') ? '' : 'hide-data' }}">
                <div class="col-md-6">
                    <div
                        class="form-group current_on_your_support_obligation_section {{ (Helper::validate_key_value('current_on_your_support_obligation', $formData, 'radio') === 1 || old('current_on_your_support_obligation') === '1') ? '' : 'hide-data' }} w-100">
                        <div class="label-div p-0 question-area border-0 w-100">
                            <label class="">Your Past Due Amount</label>
                            <div class="input-group">
                                <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                                <input required type="text" class="custom_corner_input form-control price-field"
                                    placeholder="Your Past Due Amount" name="taxes_alimony_due"
                                    value="{{ !empty(Helper::validate_key_value('taxes_alimony_due', $formData)) ? Helper::validate_key_value('taxes_alimony_due', $formData) : old('taxes_alimony_due') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>