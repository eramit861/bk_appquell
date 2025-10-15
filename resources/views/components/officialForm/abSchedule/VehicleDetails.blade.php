<div class="col-md-4 d-flex">
    <label for="">&nbsp;&nbsp;{{ $q }}.{{ $i }}</label>
    <div class="row pl-1">
        <div class="col-md-4 mb-1">
            <label for="">{{ __('Make:') }}</label>
        </div>
        <div class="col-md-8 mb-1">
            <input id=""name="{{ base64_encode($make) }}" type="text"
                value="{{ $partAB[base64_encode($make)] ?? Helper::validate_key_value('property_make', $vehicle) }}"
                class="form-control">
        </div>

        <div class="col-md-4 mb-1">
            <label for="">{{ __('Model:') }}</label>
        </div>
        <div class="col-md-8 mb-1">
            <input id=""name="{{ base64_encode($model) }}" type="text"
                value="{{ $partAB[base64_encode($model)] ?? Helper::validate_key_value('property_model', $vehicle) }}"
                class="form-control">
        </div>

        <div class="col-md-4 mb-1">
            <label for="">{{ __('Year:') }}</label>
        </div>
        <div class="col-md-8 mb-1">
            <input id=""name="{{ base64_encode($year) }}" type="number"
                value="{{ $partAB[base64_encode($year)] ?? Helper::validate_key_value('property_year', $vehicle) }}"
                class="form-control">
        </div>

        @if (!empty($mileage))
            <div class="col-md-4 mb-1">
                <label for="">{{ __('Approximate mileage:') }}</label>
            </div>
            <div class="col-md-8 mb-1">
                <input id=""name="{{ base64_encode($mileage) }}" type="text"
                    value="{{ $partAB[base64_encode($mileage)] ?? Helper::validate_key_value('property_mileage', $vehicle) }}"
                    class="form-control">
            </div>
        @endif

        <div class="col-md-12 mb-1">
            <div class="input-group">
                <label for="">{{ __('Other information:') }}</label>
                <textarea name="{{ base64_encode($otherInformation) }}" class="noadjust form-control" rows="2">{{ $partAB[base64_encode($otherInformation)] ?? Helper::validate_key_value('property_other_info', $vehicle) }}</textarea>
            </div>
        </div>
    </div>
</div>
