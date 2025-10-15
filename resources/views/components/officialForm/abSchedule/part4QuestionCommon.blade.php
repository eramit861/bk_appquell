<div class="{{ $class }}">
    <div class="input-group">
        <input name="{{ base64_encode($textName) }}" type="text" value="{{ $partAB[base64_encode($textName)] ?? Helper::validate_key_loop_value('description', $dataArray, $i) }}" class="ab_question form-control">
    </div>
</div>
<div class="col-md-4">
    <div class="input-group d-flex">
        <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">$</span>
        </div>
        <input name="{{ base64_encode($amountName) }}" type="text" value="{{ isset($partAB[base64_encode($amountName)]) ? Helper::priceFormtWithComma($partAB[base64_encode($amountName)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $dataArray, $i)) }}" class="price-field ab_question form-control">
    </div>
</div>
