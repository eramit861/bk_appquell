<div class="col-md-7">
    <div class="distlist section-box">
        <div class="distlist section-header bg-back text-white">
            <p class="distlist font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
        </div>
        <div class="distlist section-body padd-20">
            <div class="row distlist">
                <div class="distlist col-md-12">
                    <div class="distlist input-group">
                        <label>{{ __('United States Bankruptcy Court for the') }}</label>
                        <select class="form-control distlist district-select" name="{{ base64_encode($name) }} "
                            id="district_name">
                            @foreach ($districtNames as $district_name)
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
</div>
