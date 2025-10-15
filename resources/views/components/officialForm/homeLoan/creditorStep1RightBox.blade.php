<div class="col-md-5 pl-0 ml-0">
    <div class="row">
        <div class="col-md-4 mr-0 pr-0">
            <div class="input-group d-flex ">
                <input name="{{ base64_encode($fieldName['columnA']) }}" placeholder="$" type="text" value="{{ isset($partDMain[base64_encode($fieldName['columnA'])]) ? Helper::priceFormtWithComma($partDMain[base64_encode($fieldName['columnA'])]) : Helper::validate_key_value('debt_amount_due', $creditor, 'comma') }}" class="price-field form-control colAmountOfClaims">
            </div>
        </div>
        <div class="col-md-4 mr-0 pr-0">
            <div class="input-group d-flex ">
                <input name="{{ base64_encode($fieldName['columnB']) }}" placeholder="$" type="text" value="{{ isset($partDMain[base64_encode($fieldName['columnB'])]) ? Helper::priceFormtWithComma($partDMain[base64_encode($fieldName['columnB'])]) : Helper::validate_key_value('property_value', $creditor, 'comma') }}" class="price-field form-control">
            </div>
        </div>
        <div class="col-md-4 mr-0 pr-0">
            <div class="input-group d-flex ">
                <input name="{{ base64_encode($fieldName['columnC']) }}" placeholder="$" type="text" value="{{ isset($partDMain[base64_encode($fieldName['columnC'])]) ? Helper::priceFormtWithComma($partDMain[base64_encode($fieldName['columnC'])]) : Helper::validate_key_value('partc_amount', $creditor, 'comma') }}" class="price-field form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mr-0 pr-0">
            <div class="input-group">
                <label>{{ __('Describe the property that secures the claim:') }} </label>
                <textarea name="{{ base64_encode($fieldName['propertyClaim']) }}" id="" cols="3" rows="5" class="form-control">{{ $partDMain[base64_encode($fieldName['propertyClaim'])] ?? Helper::validate_key_value('describe_secure_claim', $creditor) }}</textarea>
            </div>
            <div class="input-group">
                <label><strong>{{ __('Who owes the debt?') }}</strong> {{ __('Check one.') }}</label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['debtorA']) }}" value="{{ $fieldName['debtor1'] }}" type="radio"
                {!! isset($partDMain[base64_encode($fieldName['debtorA'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtorA']), $partDMain, $fieldName['debtor1']) : Helper::validate_key_toggle('debt_owned_by', $creditor, 1) !!}
                >
                <label>{{ __('Debtor 1 only') }} </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['debtorB']) }}" value="{{ $fieldName['debtor2'] }}" type="radio"
                {!! isset($partDMain[base64_encode($fieldName['debtorB'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtorB']), $partDMain, $fieldName['debtor2']) : Helper::validate_key_toggle('debt_owned_by', $creditor, 2) !!}
                >
                <label>{{ __('Debtor 2 only') }} </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['debtorC']) }}" value="{{ $fieldName['debtor1and2'] }}" type="radio"
                {!! isset($partDMain[base64_encode($fieldName['debtorC'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtorC']), $partDMain, $fieldName['debtor1and2']) : Helper::validate_key_toggle('debt_owned_by', $creditor, 3) !!}
                >
                <label>{{ __('Debtor 1 and Debtor 2 only') }} </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['debtorD']) }}" value="{{ $fieldName['debtorOneOrAnother'] }}" type="radio"
                {!! isset($partDMain[base64_encode($fieldName['debtorD'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['debtorD']), $partDMain, $fieldName['debtorOneOrAnother']) : Helper::validate_key_toggle('debt_owned_by', $creditor, 4) !!}
                >
                <label>{{ __('At least one of the debtors and another') }} </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['checkIfClaimRelatesTo']) }}" value="On" type="checkbox" {!! isset($partDMain[base64_encode($fieldName['checkIfClaimRelatesTo'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['checkIfClaimRelatesTo']), $partDMain, 'On') : '' !!}>
                <label>{{ __('Check if this claim relates to a community debt') }} </label>
            </div>
            <div class="input-group">
                <label><strong>{{ __('As of the date you file, the claim is:') }}</strong> {{ __(': Check all that apply .') }}</label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['contingent']) }}" value="On" type="checkbox" {!! isset($partDMain[base64_encode($fieldName['contingent'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['contingent']), $partDMain, 'On') : '' !!}>
                <label>{{ __('Contingent') }} </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['inliquidated']) }}" value="On" type="checkbox" {!! isset($partDMain[base64_encode($fieldName['inliquidated'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['inliquidated']), $partDMain, 'On') : '' !!}>
                <label>{{ __('Unliquidated') }} </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($fieldName['disputed']) }}" value="On" type="checkbox" {!! isset($partDMain[base64_encode($fieldName['disputed'])]) ? Helper::validate_key_toggle(base64_encode($fieldName['disputed']), $partDMain, 'On') : '' !!}>
                <label>{{ __('Disputed') }} </label>
            </div>
        </div>
    </div>
</div>
