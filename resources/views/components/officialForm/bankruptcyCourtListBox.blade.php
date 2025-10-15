<div class="row">
    <div class="col-md-7">
        <div class="section-box">
            <div class="section-header bg-back text-white">
                <p class="courtlist font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
            </div>
            <div class="section-body padd-20">
                <div class="col-md-12">
                    <div class="input-group">
                        <label>{{ __('United States Bankruptcy Court for the') }}</label>
                        <select name="{{ base64_encode($districtName) }}" class="form-control district-select"
                            id="district_name">
                            @foreach ($districtList as $district_name)
                                <option
                                    {{ Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name) }}
                                    value="{{ $district_name->district_name }}" class="form-control">
                                    {{ $district_name->district_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">

        <div class="amended">
            <input name="{{ base64_encode($districtCheckboxName) }}" type="checkbox"
                {{ @$sofa[base64_encode($districtCheckboxName)] !== null ? Helper::validate_key_toggle(base64_encode($districtCheckboxName), @$sofa, 'On') : '' }}>
            <label>{{ __('Check if this is an amended filing') }}</label>
        </div>
    </div>
</div>
