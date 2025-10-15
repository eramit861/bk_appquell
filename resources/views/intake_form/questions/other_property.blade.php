<div class="mb-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class=" w-100">LET GO ITEMS:<br> In the last 4 years, have you sold, traded, gifted, or junked anything that was worth $1,000 +? List each item, when it happened, and what you got for it (if anything).</label>
            <input type="text" name="other_property_let_go_item" class="input_capitalize form-control"
                placeholder="Each item, when it happened, and what you got for it (if anything)."
                value="{{ !empty(Helper::validate_key_value('other_property_let_go_item', $formData)) ? Helper::validate_key_value('other_property_let_go_item', $formData) : old('other_property_let_go_item') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class=" w-100">NEW STUFF:<br> In the last 2 years, have you acquired anything worth more than $1,000 when you received it? Write each item and what you think it’s worth today.</label>
            <input type="text" name="other_property_new_stuff" class="input_capitalize form-control"
                placeholder="Each item and what you think it’s worth today."
                value="{{ !empty(Helper::validate_key_value('other_property_new_stuff', $formData)) ? Helper::validate_key_value('other_property_new_stuff', $formData) : old('other_property_new_stuff') }}">
        </div>
    </div>
</div>

<div class="my-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <label class=" w-100">VALUED POSSESSIONS:<br> Got anything worth over $1,000 if you sold it today? Write each item and what you think it’s worth now. </label>
            <input type="text" name="other_property_valued_possession" class="input_capitalize form-control"
                placeholder="Each item and what you think it’s worth now."
                value="{{ !empty(Helper::validate_key_value('other_property_valued_possession', $formData)) ? Helper::validate_key_value('other_property_valued_possession', $formData) : old('other_property_valued_possession') }}">
        </div>
    </div>
</div>