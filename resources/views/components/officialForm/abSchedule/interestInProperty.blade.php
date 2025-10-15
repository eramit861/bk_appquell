<div class="col-md-4">
    <div class="interest-property mt-3">
        <div class="input-group">
            <p>
                <strong>{{ __('Who has an interest in the property?') }}</strong>
                {{ __('Check one.') }}
            </p>
        </div>
        <div class="input-group mb-0">
            <input name="{{ base64_encode($interestInTheProperty) }}" value="{{ $debtor1Value }}" type="checkbox" {!! isset($partAB[base64_encode($interestInTheProperty)]) ? Helper::validate_key_toggle(base64_encode($interestInTheProperty), $partAB, $debtor1Value) : Helper::validate_key_toggle('own_by_property', $vehicle, 1) !!}>
            <label>{{ __('Debtor 1 only') }}</label>
        </div>
        <div class="input-group mb-0">
            <input name="{{ base64_encode($interestInTheProperty) }}" value="{{ $debtor2Value }}" type="checkbox" {!! isset($partAB[base64_encode($interestInTheProperty)]) ? Helper::validate_key_toggle(base64_encode($interestInTheProperty), $partAB, $debtor2Value) : Helper::validate_key_toggle('own_by_property', $vehicle, 2) !!}>
            <label>{{ __('Debtor 2 only') }}</label>
        </div>
        <div class="input-group mb-0">
            <input name="{{ base64_encode($interestInTheProperty) }}" value="{{ $debtor1And2Value }}" type="checkbox" {!! isset($partAB[base64_encode($interestInTheProperty)]) ? Helper::validate_key_toggle(base64_encode($interestInTheProperty), $partAB, $debtor1And2Value) : Helper::validate_key_toggle('own_by_property', $vehicle, 3) !!}>
            <label>{{ __('Debtor 1 and Debtor 2 only') }}
            </label>
        </div>
        <div class="input-group mb-0">
            <input name="{{ base64_encode($interestInTheProperty) }}" value="{{ $oneOfDebtorAndAnotherValue }}" type="checkbox" {!! isset($partAB[base64_encode($interestInTheProperty)]) ? Helper::validate_key_toggle(base64_encode($interestInTheProperty), $partAB, $oneOfDebtorAndAnotherValue) : Helper::validate_key_toggle('own_by_property', $vehicle, 4) !!}>
            <label>{{ __('At least one of the debtors and another') }}
            </label>
        </div>

        <div class="input-group mb-0 pt-3">
            @if(!empty($seeInstruction))
                <input name="{{ base64_encode($seeInstruction) }}" value="On" type="checkbox" {!! isset($partAB[base64_encode($seeInstruction)]) ? Helper::validate_key_toggle(base64_encode($seeInstruction), $partAB, 'On') : '' !!}>
            @else
                <input name="{{ base64_encode($interestInTheProperty) }}" value="On" type="checkbox" {!! isset($partAB[base64_encode($interestInTheProperty)]) ? Helper::validate_key_toggle(base64_encode($interestInTheProperty), $partAB, 'On') : '' !!}>
            @endif
            <label>
                <strong>
                    {{ __('Check if this is community property') }}
                </strong>
                {{ __('(see instructions)') }}
            </label>
        </div>
    </div>
</div>
