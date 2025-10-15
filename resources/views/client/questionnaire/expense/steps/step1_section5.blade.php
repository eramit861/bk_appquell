<div class="col-12">
    <div class="light-gray-div">
        <h2 class="text-dark fw-bold">
            Insurance that comes out of your bank account(s)
        </h2>

        <div class="row gx-3">
            <div class="col-12">
                <p class="blink text-danger text-bold text-center d-block mb-2">Don't list expenses from your paychecks
                    here.</br>Do not include insurance deducted from your pay.</br>Only list amounts that are being
                    withdrawn from your bank accounts.</p>
            </div>
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Enter the amount you pay monthly for any <span class="text-c-blue">Life
                            insurance</span> premiums:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Only list amounts you pay out of your bank account or out-of-pocket.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="life_insurance_price"
                                value="{{ Helper::validate_key_value('life_insurance_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Enter how much you pay per month for <span class="text-c-blue">Health</span>,
                        <span class="text-c-blue">Dental</span>, and/or <span class="text-c-blue">Vision</span>
                        insurance premiums:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Only list amounts you pay out of your bank account or out-of-pocket.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="health_insurance_price"
                                value="{{ Helper::validate_key_value('health_insurance_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Enter the monthly amount you pay per month for <span class="text-c-blue">Auto
                            insurance</span>:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="If you pay your insurance premiums in advance, divide the total amount by the term length and enter the monthly amount below.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="auto_insurance_price"
                                value="{{ Helper::validate_key_value('auto_insurance_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Do you have any other insurance not listed above?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="This is any insurance not accounted for above.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                        <p class="text-c-blue fw-bold mb-0">
                            Such as: home warranty, pet insurance, Umbrella liability insurance etc.
                        </p>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="otherInsurance_notListed" id="otherInsurance_notListed_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('otherInsurance_notListed', $expenses, 1) }}>
                        <label for="otherInsurance_notListed_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('otherInsurance_notListed', $expenses, 1) }}"
                            onclick="getotherInsurance_notListed('yes');">Yes</label>

                        <input type="radio" name="otherInsurance_notListed" id="otherInsurance_notListed_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('otherInsurance_notListed', $expenses, 0) }}>
                        <label for="otherInsurance_notListed_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('otherInsurance_notListed', $expenses, 0) }}"
                            onclick="getotherInsurance_notListed('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 other_insurance {{ Helper::key_hide_show('otherInsurance_notListed', $expenses) }}"
                id="other_insurance1">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Name of the insurance company and type of
                                    insurance</label>
                                <input type="text"
                                    placeholder="Enter the name of the insurance company and type of insurance here"
                                    name="other_insurance_value" class="form-control required other_insurance_value"
                                    value="{{ Helper::current(Helper::validate_key_value('other_insurance_value', $expenses)) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Monthly Payment</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number"
                                        class="form-control price-field expense_prices required other_insurance_price"
                                        name="other_insurance_price"
                                        value="{{ Helper::current(Helper::validate_key_value('other_insurance_price', $expenses)) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Other Expenses:
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="other_expense_available" id="other_expense_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('other_expense_available', $expenses, 1) }}>
                        <label for="other_expense_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('other_expense_available', $expenses, 1) }}"
                            onclick="getOtherExpense('yes');">Yes</label>

                        <input type="radio" name="other_expense_available" id="other_expense_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('other_expense_available', $expenses, 0) }}>
                        <label for="other_expense_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('other_expense_available', $expenses, 0) }}"
                            onclick="getOtherExpense('no');">No</label>
                    </div>
                    <label class="text-c-blue">The US Average based upon your household size for Misc.
                        Expenses is:
                        <span class="text-bold fs-15px ">$<span
                                class="text-decoration-underline other_expense_average_price">0.00</span></span>
                    </label>
                </div>
            </div>
            <div class="col-12 other_insurance {{ Helper::key_hide_show_v('other_expense_available', $expenses) }}"
                id="other_expenses_data">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Specify</label>
                                <input type="text" class="input_capitalize form-control required"
                                    placeholder="Specify" name="other_expense_specify"
                                    value="{{ Helper::validate_key_value('other_expense_specify', $expenses) }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Value</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control price-field expense_prices required"
                                        name="other_expense_price"
                                        value="{{ Helper::validate_key_value('other_expense_price', $expenses, 'float') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
