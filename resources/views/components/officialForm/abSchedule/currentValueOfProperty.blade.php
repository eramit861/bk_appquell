<div class="col-md-4">
    <div class="3rd-colun">
        <div class="column-heading mb-3 bg-dgray">
            <label>
                {{ __('Do not deduct secured claims or exemptions.
                Put the amount of any secured claims on') }}
                <i>
                    {{ __('Schedule D: Creditors Who Have Claims Secured by Property.') }}
                </i>
            </label>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="input-group">
                    <label>
                        <strong>{{ __('Current value of the
                            entire property?') }} </strong></label>
                    <input name="{{ base64_encode($currentValueA) }}" type="text" value="{{ isset($partAB[base64_encode($currentValueA)]) ? Helper::priceFormtWithComma($partAB[base64_encode($currentValueA)]) : Helper::validate_key_value('property_estimated_value', $vehicle, 'comma') }}" class="price-field form-control" placeholder="$">
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <label>
                        <strong>{{ __('Current value of the
                            portion you own?') }} </strong></label>
                    <input name="{{ base64_encode($currentValueB) }}" type="text" value="{{ isset($partAB[base64_encode($currentValueB)]) ? Helper::priceFormtWithComma($partAB[base64_encode($currentValueB)]) : Helper::validate_key_value('property_estimated_value', $vehicle, 'comma') }}" class="price-field form-control" placeholder="$">
                </div>
            </div>
        </div>
    </div>
</div>
