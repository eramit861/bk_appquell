<div class="col-md-12">
    <div class="label-div question-area border-0">
        <!-- Radio -->
        <div class="custom-radio-group form-group mt-0">
            <input type="radio" required name="martial_status" class="form-check-input" id="martial_status_single"
                value="0" {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 0 || old('martial_status') === '0') ? 'checked' : '' }}>
            <label for="martial_status_single" onclick="updateD2InfoClasses(0)" class="btn-toggle {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 0 || old('martial_status') === '0') ? 'active' : '' }}">Single</label>
            <input type="radio" required name="martial_status" class="form-check-input" id="martial_status_married"
                value="1" {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 1 || old('martial_status') === '1') ? 'checked' : '' }}>
            <label for="martial_status_married" onclick="updateD2InfoClasses(1)" class="btn-toggle {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 1 || old('martial_status') === '1') ? 'active' : '' }}">Married</label>
            <input type="radio" required name="martial_status" class="form-check-input" id="martial_status_seperated"
                value="2" {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 2 || old('martial_status') === '2') ? 'checked' : '' }}>
            <label for="martial_status_seperated" onclick="updateD2InfoClasses(2)" class="btn-toggle {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 2 || old('martial_status') === '2') ? 'active' : '' }}">Separated</label>

            <input type="radio" required name="martial_status" class="form-check-input" id="martial_status_divorced"
                value="3" {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 3 || old('martial_status') === '3') ? 'checked' : '' }}>
            <label for="martial_status_divorced" onclick="updateD2InfoClasses(3)" class="btn-toggle {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 3 || old('martial_status') === '3') ? 'active' : '' }}">Divorced</label>

            <input type="radio" required name="martial_status" class="form-check-input" id="martial_status_widowed"
                value="4" {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 4 || old('martial_status') === '4') ? 'checked' : '' }}>
            <label for="martial_status_widowed" onclick="updateD2InfoClasses(4)" class="btn-toggle {{ (Helper::validate_key_value('martial_status', $formData, 'radio') === 4 || old('martial_status') === '4') ? 'active' : '' }}">Widowed</label>
        </div>
    </div>
</div>