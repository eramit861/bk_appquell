<div class="col-12">
    <div class="light-gray-div mt-2">
        <h2 class="text-dark fw-bold">
            These are your average monthly expenses:
            <strong class="text-danger">$</strong>
            <strong class="text-danger" id="total_expenses">0.00</strong>
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="If this seems correct select save & Next if not re look at the above expenses.">
                <i class="bi bi-question-circle"></i>
            </div>
        </h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Do you expect any increase or decrease in expenses to occur in the next year:
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="increase_decrease_expenses_option"
                            id="increase_decrease_expenses_option_yes" class="d-none required" value="1"
                            {{ Helper::validate_key_toggle('increase_decrease_expenses_option', $expenses, 1) }}> <label
                            for="increase_decrease_expenses_option_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('increase_decrease_expenses_option', $expenses, 1) }}"
                            onclick="getExpIncBox('yes');">Yes</label>

                        <input type="radio" name="increase_decrease_expenses_option"
                            id="increase_decrease_expenses_option_no" class="d-none required" value="0"
                            {{ Helper::validate_key_toggle('increase_decrease_expenses_option', $expenses, 0) }}> <label
                            for="increase_decrease_expenses_option_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('increase_decrease_expenses_option', $expenses, 0) }}"
                            onclick="getExpIncBox('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 other_insurance {{ Helper::key_hide_show_v('increase_decrease_expenses_option', $expenses) }}"
                id="div_desc_incexp">
                <div class="label-div">
                    <div class="form-group">
                        <label for="">Specify</label>
                        <textarea id="increase_decrease_expenses" name="increase_decrease_expenses"
                            class="input_capitalize form-control required h-unset" cols="30" rows="3" placeholder="Description">{{ Helper::validate_key_value('increase_decrease_expenses', $expenses) }}</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
