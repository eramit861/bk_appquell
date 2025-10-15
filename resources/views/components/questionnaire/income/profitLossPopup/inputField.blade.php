<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 pl-0">
    <div class="form-group-none">
        <div class="input-group{{ @$webView ? 's d-flex ' : '' }} mb-0">
            <div class="input-group{{ @$webView ? 's d-flex ' : '' }}-prepend h20 mb-0">
                <span class="input-group{{ @$webView ? 's d-flex ' : '' }}-text mb-0" id="basic-addon1">$</span>
            </div>
            <input type="number" class="{{$class}}" name="{{$name}}" value="{{$value}}"/>
        </div>
    </div>
</div>
