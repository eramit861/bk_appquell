<div class="col-12">
    <div class="light-gray-div">
        <h2 class="text-dark fw-bold">Tax payments from installment agreements only</h2>
        <div class="row gx-3">
            <div class="col-12">
                <p class="text-danger text-bold text-center mb-1">Do not include taxes deducted from your pay.</p>
            </div>
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Enter any monthly tax payments you make, such as those for an <span
                            class="text-c-blue">IRS</span> or state tax agency payment plan:
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="taxbills_not_deducted" id="taxbills_not_deducted_yes"
                            class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('taxbills_not_deducted', $expenses, 1) }}>
                        <label for="taxbills_not_deducted_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('taxbills_not_deducted', $expenses, 1) }}"
                            onclick="getTaxbillNotDeducted('yes');">Yes</label>

                        <input type="radio" name="taxbills_not_deducted" id="taxbills_not_deducted_no"
                            class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('taxbills_not_deducted', $expenses, 0) }}>
                        <label for="taxbills_not_deducted_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('taxbills_not_deducted', $expenses, 0) }}"
                            onclick="getTaxbillNotDeducted('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 tax_bills {{ Helper::key_hide_show_v('taxbills_not_deducted', $expenses) }}"
                id="tax_bill_not_deducted_data">
                <div class="row">
                    <div class="col-md-8 col-sm-12 col-12">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="">Name of the insurance company and type of
                                    insurance</label>
                                <input type="text" placeholder="Enter the name of the agency for example IRS"
                                    name="taxbills_value" class="form-control required"
                                    value="{{ Helper::current(Helper::validate_key_value('taxbills_value', $expenses)) }}" />
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
                                        class="form-control price-field expense_prices required taxbills_price"
                                        name="taxbills_price"
                                        value="{{ Helper::current(Helper::validate_key_value('taxbills_price', $expenses)) }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
