<div class="row" >
    <div class="col-md-7" style="margin-top: 9px;">
        {{ __('Add the dollar value of your entries in Column A on this page. Write that number here:') }}
    </div>
    <div class="col-md-5" style="padding-left: 0px;">
        <div class="input-group d-flex ">
            <input name="{{ base64_encode($name) }}" placeholder="$" type="text" value="{{ isset($partDMain[base64_encode($name)]) ? Helper::priceFormtWithComma($partDMain[base64_encode($name)]) : Helper::priceFormtWithComma($value) }}" class="price-field form-control">
        </div>
    </div>
</div>
