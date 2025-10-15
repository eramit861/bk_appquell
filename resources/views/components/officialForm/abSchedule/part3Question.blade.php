<div class="row">
    <div class="col-md-8">
        <div class="input-group">
            <div class="input-group">
                <label>
                    {{ $slot }}
                </label>
            </div>
            <div class="input-group">
                <input name="{{ base64_encode($checkBoxName) }}" value="no" type="checkbox"
                    {{ isset($partAB[base64_encode($checkBoxName)]) ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partAB, 'no') : Helper::validate_key_toggle('type_value', $householdGoods, 0) }}>
                <label>{{ __('No') }}</label>
            </div>
            @php
                $exportValue = 'yes';
                if ($checkBoxName == 'check 47#0-106AB' || $checkBoxName == 'check 51#0-106AB') {
                    $exportValue = 'On';
                }
            @endphp
            <div class="input-group">
                <input name="{{ base64_encode($checkBoxName) }}" value="{{ $exportValue }}" type="checkbox"
                    {!! isset($partAB[base64_encode($checkBoxName)])
                        ? Helper::validate_key_toggle(base64_encode($checkBoxName), $partAB, 'yes')
                        : Helper::validate_key_toggle('type_value', $householdGoods, 1) !!}>

                @if (!empty($describe))
                    <label>{{ $describe }}</label>
                @else
                    <label>{{ __('Yes Describe') }}</label>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="input-group">
            @if (!empty($textarea))
                <textarea name="{{ base64_encode($descriptionName) }}" class="noadjust ab_question form-control" rows="2">{{ $partAB[base64_encode($descriptionName)] ?? Helper::validate_key_value('description', $householdGoods) }}</textarea>
            @else
                <input name="{{ base64_encode($descriptionName) }}" type="text"
                    value="{{ $partAB[base64_encode($descriptionName)] ?? Helper::validate_key_value('description', $householdGoods) }}"
                    class="ab_question form-control">
            @endif
        </div>
    </div>
    <div class="col-md-4">
        <div class="input-group d-flex ">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ base64_encode($descriptionAmount) }}" type="text"
                value="{{ isset($partAB[base64_encode($descriptionAmount)]) ? Helper::priceFormtWithComma($partAB[base64_encode($descriptionAmount)]) : Helper::validate_key_value('property_value', $householdGoods, 'comma') }}"
                class="price-field ab_question form-control">
        </div>
    </div>
</div>
