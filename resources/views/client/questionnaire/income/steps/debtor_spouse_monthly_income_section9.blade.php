<div class="col-12">
    <div class="light-gray-div">
        <h2 class="text-dark fw-bold">Take Home Pay</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div mb-2">
                    <div class="form-group mb-2">
                        @if (isset($hasMultipleCurrentEmployer) && $hasMultipleCurrentEmployer)
                        <label>Multiple current employer What is your net pay per month <span class="text-c-blue">(Take
                                Home Pay)</span>?</label>
                        @else
                        <label>What is your net amount per pay period <span class="text-c-blue">(Take Home
                                Pay)</span>?</label>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                <div class="label-div">
                    <div class="form-group">
                        <div class="input-group ">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field required"
                                name="joints_debtor_take_home_pay"
                                value="{{ Helper::validate_key_value('joints_debtor_take_home_pay', $debtorspousemonthlyincome) }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>