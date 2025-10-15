<div class="input-group d-flex ">
    <div class="input-group-append">
        <span class="input-group-text" id="basic-addon2">$</span>
    </div>
    <input name="{{ base64_encode($inputFieldName) }}" type="text" value="{{ $inputValue }}" class="price-field form-control {{ $extraClass ?? '' }}">
</div>