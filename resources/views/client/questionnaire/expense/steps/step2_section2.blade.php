<div class="col-12">
    <div class="light-gray-div ">
        <h2 class="text-dark fw-bold">Rental or home ownership expenses for your residence</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter your current monthly Rent or Mortgage payment below:
                                <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="" data-bs-original-title="Only enter your 1st mortgage here.">
                                    <i class="bi bi-question-circle"></i>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required "
                                        name="rent_home_mortage"
                                        value="{{ Helper::validate_key_value('rent_home_mortage', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Does the above rent/mortgage payment include real estate taxes?
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="real_estate_taxes" id="real_estate_taxes_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('real_estate_taxes', $expenses, 1) }}>
                        <label for="real_estate_taxes_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('real_estate_taxes', $expenses, 1) }}"
                            onclick="getRealEstateTaxData('no');">Yes</label>

                        <input type="radio" name="real_estate_taxes" id="real_estate_taxes_no" class="d-none required"
                            value="0" {{ Helper::validate_key_toggle('real_estate_taxes', $expenses, 0) }}>
                        <label for="real_estate_taxes_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('real_estate_taxes', $expenses, 0) }}"
                            onclick="getRealEstateTaxData('yes');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v2('real_estate_taxes', $expenses) }}"
                id="real_estate_taxes_data">
                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter the additional amount you pay each month:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="estate_taxes_pay"
                                        value="{{ Helper::validate_key_value('estate_taxes_pay', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Does the above rent/mortgage payment include property insurance?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="If you rent and pay renters insurance list your monthly rental insurance here.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="amount_include_property" id="amount_include_property_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('amount_include_property', $expenses, 1) }}>
                        <label for="amount_include_property_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('amount_include_property', $expenses, 1) }}"
                            onclick="getAmountIncludePropertyData('no');">Yes</label>

                        <input type="radio" name="amount_include_property" id="amount_include_property_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('amount_include_property', $expenses, 0) }}>
                        <label for="amount_include_property_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('amount_include_property', $expenses, 0) }}"
                            onclick="getAmountIncludePropertyData('yes');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v2('amount_include_property', $expenses) }}"
                id="amount_include_property_data">
                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter the additional amount you pay each month:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices  required"
                                        name="amount_include_property_pay"
                                        value="{{ Helper::validate_key_value('amount_include_property_pay', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Does the above rent/mortgage payment include home maintenance, repairs and
                        monthly upkeep?
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="amount_include_home" id="amount_include_home_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('amount_include_home', $expenses, 1) }}>
                        <label for="amount_include_home_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('amount_include_home', $expenses, 1) }}"
                            onclick="getAmountIncludehomeData('no');">Yes</label>

                        <input type="radio" name="amount_include_home" id="amount_include_home_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('amount_include_home', $expenses, 0) }}>
                        <label for="amount_include_home_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('amount_include_home', $expenses, 0) }}"
                            onclick="getAmountIncludehomeData('yes');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v2('amount_include_home', $expenses) }}"
                id="amount_include_home_data">
                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter the additional amount you pay each month:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="amount_include_home_pay"
                                        value="{{ Helper::validate_key_value('amount_include_home_pay', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Does the above rent/mortgage payment include home owners <span class="text-c-blue">(HOA)</span>
                        or condominium dues <span class="text-c-blue">(COA)</span>?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="If you don't have any HOA or COA payments, select Yes.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="amount_include_homeowner" id="amount_include_homeowner_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('amount_include_homeowner', $expenses, 1) }}>
                        <label for="amount_include_homeowner_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('amount_include_homeowner', $expenses, 1) }}"
                            onclick="getAmountIncludeHomeOwnerData('no');">Yes</label>

                        <input type="radio" name="amount_include_homeowner" id="amount_include_homeowner_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('amount_include_homeowner', $expenses, 0) }}>
                        <label for="amount_include_homeowner_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('amount_include_homeowner', $expenses, 0) }}"
                            onclick="getAmountIncludeHomeOwnerData('yes');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v2('amount_include_homeowner', $expenses) }}"
                id="amount_include_homeowner_data">
                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter the additional amount you pay each month:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="amount_include_homeowner_pay"
                                        value="{{ Helper::validate_key_value('amount_include_homeowner_pay', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Does you have additional mortgage payment(s) on your primary residence?
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="mortgage_payments" id="mortgage_payments_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('mortgage_payments', $expenses, 1) }}>
                        <label for="mortgage_payments_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('mortgage_payments', $expenses, 1) }}"
                            onclick="getMortgagePaymentsrData('no');">Yes</label>

                        <input type="radio" name="mortgage_payments" id="mortgage_payments_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('mortgage_payments', $expenses, 0) }}>
                        <label for="mortgage_payments_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('mortgage_payments', $expenses, 0) }}"
                            onclick="getMortgagePaymentsrData('yes');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('mortgage_payments', $expenses) }}"
                id="mortgage_payments_data">
                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter the additional amount you pay each month:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="mortgage_payments_pay"
                                        value="{{ Helper::validate_key_value('mortgage_payments_pay', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
