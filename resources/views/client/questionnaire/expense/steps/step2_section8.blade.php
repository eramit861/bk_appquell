<div class="col-12">
    <div class="light-gray-div">
        <h2 class="text-dark fw-bold">Expenses for property you own other than your main home</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Do you have other real property expenses NOT already listed above?
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="otherRealPropertyNotAddedSpouse"
                            id="otherRealPropertyNotAddedSpouse_yes" class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('otherRealPropertyNotAddedSpouse', $expenses, 1) }}>
                        <label for="otherRealPropertyNotAddedSpouse_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('otherRealPropertyNotAddedSpouse', $expenses, 1) }}"
                            onclick="getotherRealPropertyNotAddedSpouse('yes');">Yes</label>

                        <input type="radio" name="otherRealPropertyNotAddedSpouse"
                            id="otherRealPropertyNotAddedSpouse_no" class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('otherRealPropertyNotAddedSpouse', $expenses, 0) }}>
                        <label for="otherRealPropertyNotAddedSpouse_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('otherRealPropertyNotAddedSpouse', $expenses, 0) }}"
                            onclick="getotherRealPropertyNotAddedSpouse('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('otherRealPropertyNotAddedSpouse', $expenses) }}"
                id="otherRealPropertyNotAddedSpouse_data">

                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Mortgage on other Property:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="mortgage_property[other_real_estate_price]"
                                        value="{{ Helper::validate_key_loop_value('mortgage_property', $expenses, 'other_real_estate_price') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter how much you pay per month for <span class="text-c-blue">real
                                    estate taxes</span>:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="mortgage_property[tax]"
                                        value="{{ Helper::validate_key_loop_value('mortgage_property', $expenses, 'tax') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter how much you pay per month for <span class="text-c-blue">property,
                                    homeowner's, or renter's insurance</span>:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="mortgage_property[rental_insurance_price]"
                                        value="{{ Helper::validate_key_loop_value('mortgage_property', $expenses, 'rental_insurance_price') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter how much you pay per month for <span class="text-c-blue">maintenance, repair, and
                                    upkeep expenses</span>:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="mortgage_property[home_maintenance_price]"
                                        value="{{ Helper::validate_key_loop_value('mortgage_property', $expenses, 'home_maintenance_price') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 ">
                        <div class="label-div mb-0">
                            <label class="d-block">
                                Enter how much you pay per month for <span class="text-c-blue">homeowner's association
                                    or condominium
                                    dues</span>:
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group mb-0">
                                <div class="input-group mb-0">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="mortgage_property[condominium_price]"
                                        value="{{ Helper::validate_key_loop_value('mortgage_property', $expenses, 'condominium_price') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
