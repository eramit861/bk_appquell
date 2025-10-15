<div class="col-md-5">
    <div class="input-group-ammend">
        <label>{{ __('Check if this is:') }}</label>
        <div class="input-group">
            <input type="checkbox" value="amended" name="{{ base64_encode($checkBoxName) }}"
                {{ isset($partMain[base64_encode($checkBoxName)]) ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partMain, 'amended') : '' }}>
            <label>{{ __('An amended filing') }}</label>
        </div>
        <div class="input-group">
            <input type="checkbox" value="supplemental" name="{{ base64_encode($checkBoxName) }}"
                {{ isset($partMain[base64_encode($checkBoxName)]) ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partMain, 'supplemental') : '' }}>
            <label>{{ __('A supplement showing postpetition chapter 13 income as of the following date:') }}</label>
        </div>
        <div class="input-group">
            <input name="{{ base64_encode($dateBoxName) }}" placeholder="{{ __('MM/DD/YYYY') }}" type="text"
                value="{{ $partMain[base64_encode($dateBoxValueName)] ?? '' }}" class="date_filed">
        </div>
    </div>
</div>
