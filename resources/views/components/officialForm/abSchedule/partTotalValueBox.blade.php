<div class="row mt-3 mb-3">
    <div class="col-md-8 d-flex">
        <label for="">
            <strong>{{ $questionNumber }}.</strong>
        </label>
        <div class="row pl-1">
            <div class="col-md-12">
                <label class="hr_dotted">
                    <strong class="d-block">
                        {{ $question }}
                    </strong>
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-1">
        <p style="text-align: right;">
            <i class="fa fa-arrow-right mt-5" style="text-align: right;"></i>
        </p>
    </div>
    <div class="col-md-3">
        <div class="input-group d-flex border_2px" style="padding:10px;">
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">$</span>
            </div>
            <input name="{{ $name }}" type="text" value="{{ $value }}"
                class="price-field form-control" placeholder="$">
        </div>
    </div>
</div>
