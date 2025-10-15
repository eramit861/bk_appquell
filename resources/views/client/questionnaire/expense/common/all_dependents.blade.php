<div class="light-gray-div all_dependents_form_{{ $i }} all_dependents_form @if ($i == 0) mt-2 @endif"
    id="all_dependents_form1">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $i + 1 }}</div>
            Dependent Details
        </h2>
        <button type="button" class="delete-div" title="Delete"
            onclick="remove_div_common('all_dependents_form', {{ $i }});updateAveragePrice();return false;">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <div class="row gx-3">
            <div class="col-md-3 col-sm-8 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Relationship</label>
                        <select class="form-control required dependent_relationship"
                            name="dependent_relationship[{{ $i }}]">
                            <option disabled="">Relationship</option>
                            {!! Helper::dependent_relationship(Helper::validate_key_loop_value('dependent_relationship', $expenses, $i)) !!}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-4 col-12">
                <div class="label-div">
                    <div class="form-group">
                        <label>Age</label>
                        <input type="text" class="form-control allow-3digit required dependent_age"
                            name="dependent_age[{{ $i }}]"
                            value="{{ Helper::validate_key_loop_value('dependent_age', $expenses, $i) }}"
                            placeholder="Age" />
                    </div>
                </div>
            </div>
            <div class="col-md-7 col-12">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px mb-1">Does dependent live with you?</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="dependent_live_with[{{ $i }}]"
                            id="dependent_live_with_yes_{{ $i }}" class="d-none required dependent_live_with"
                            value="1" @if (@$expenses['dependent_live_with'][$i] == 1) checked @endif>
                        <label for="dependent_live_with_yes_{{ $i }}"
                            class="btn-toggle @if (@$expenses['dependent_live_with'][$i] == 1) active @endif">Yes</label>

                        <input type="radio" name="dependent_live_with[{{ $i }}]"
                            id="dependent_live_with_no_{{ $i }}" class="d-none required dependent_live_with"
                            value="0" @if (@$expenses['dependent_live_with'][$i] == 0) checked @endif>
                        <label for="dependent_live_with_no_{{ $i }}"
                            class="btn-toggle @if (@$expenses['dependent_live_with'][$i] == 0) active @endif">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
