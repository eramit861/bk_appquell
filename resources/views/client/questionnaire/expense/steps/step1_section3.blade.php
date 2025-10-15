<div class="col-12">
    <div class="light-gray-div">
        <h2 class="text-dark fw-bold">Household Expenses</h2>
        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter what you pay on average for food & housekeeping
                        supplies:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="food_housekeeping_price"
                                value="{{ Helper::validate_key_value('food_housekeeping_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 ">
                <div class="label-div">
                    <label class="text-c-blue">The US Average based upon your household size is:
                        <span class="text-bold fs-15px ">$<span
                                class="text-decoration-underline food_housekeeping_average_price">0.00</span></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter what you pay on average for childcare and children
                        education costs:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div ">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="childcare_price"
                                value="{{ Helper::validate_key_value('childcare_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter what you pay on average for clothing, laundry, and dry
                        cleaning:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices  required"
                                name="laundry_price"
                                value="{{ Helper::validate_key_value('laundry_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 ">
                <div class="label-div">
                    <label class="text-c-blue">The US Average based upon your household size is:
                        <span class="text-bold fs-15px ">$<span
                                class="text-decoration-underline apparel_average_price">0.00</span></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">Enter what you pay on average for personal care products and
                        services:</label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices  required"
                                name="personal_care_price"
                                value="{{ Helper::validate_key_value('personal_care_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 ">
                <div class="label-div">
                    <label class="text-c-blue">The US Average based upon your household size is:
                        <span class="text-bold fs-15px ">$<span
                                class="text-decoration-underline personal_care_average_price">0.00</span></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Enter what you pay on average per month for medical & dental expenses:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Only your co-pays and medications. Don't include monthly premiums.">
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
                                name="medical_dental_price"
                                value="{{ Helper::validate_key_value('medical_dental_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Transportation (do NOT include car payments):
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="This includes, monthly gas, maintenance, and yearly car registration.">
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
                                name="transportation_price"
                                value="{{ Helper::validate_key_value('transportation_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Your average monthly recreation & entertainment:
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="Starbucks, date night, eating out, etc.">
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
                                name="entertainment_price"
                                value="{{ Helper::validate_key_value('entertainment_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-3">
            <div class="col-12 ">
                <div class="label-div mb-0">
                    <label class="d-block">
                        Charitable contributions and religious donations:
                    </label>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-12">
                <div class="label-div">
                    <div class="form-group mb-0">
                        <div class="input-group mb-0">
                            <span class="input-group-text">$</span>
                            <input type="number" class="form-control price-field expense_prices required"
                                name="charitablet_price"
                                value="{{ Helper::validate_key_value('charitablet_price', $expenses, 'float') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
