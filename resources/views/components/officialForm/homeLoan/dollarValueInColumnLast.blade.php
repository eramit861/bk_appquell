<div class="row" >
    <div class="col-md-7" style="margin-top: 9px;">
        {{ __('If this is the last page of your form, add the dollar value totals from all pages.
        Write that number here:') }}
    </div>
    <div class="col-md-5" style="padding-left: 0px;">
        <div class="input-group d-flex ">
            @php
                $totalValue = isset($partDMain[base64_encode($name)]) ? Helper::priceFormtWithComma($partDMain[base64_encode($name)]) : (empty($arrayData) ? Helper::priceFormtWithComma($value) : 0.00);
                $totalValueClass = '';
                if ($totalValue > 0) {
                    $totalValueClass = 'fi_schedule_d_secured_claims';
                }
            @endphp
            <input name="{{ base64_encode($name) }}" placeholder="$" type="text" id="{{ (empty($arrayData)) ? 'total_dollor_amount_last_page' : '' }}" value="{{ $totalValue }}" class="price-field form-control {{ $totalValueClass }}">
        </div>
    </div>
</div>
<input type="hidden" name="{{ base64_encode('fill_27.1.0') }}" value="{{ $pagefrom }}">
<input type="hidden" name="{{ base64_encode('fill_27.1.1') }}" value="{{ $totalPage }}">
<h3 style="text-align:right;">Page {{ $pagefrom }} of {{ $totalPage }} </h3>
