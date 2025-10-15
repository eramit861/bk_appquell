<div class="col-12 col-md-3 sign_block">
    <div class="label-div mb-0">
        <label class="pt-2 mb-0">{{ $signatureTitle }}:</label>
    </div>
</div>
<div class="col-12 col-md-4 sign_block">
    <div class="label-div mobile-mb-2">
        <input type="text" readonly class="h20 form-control required" name="income_profit_loss[{{$signName}}]" value="{{$name}}"/>
    </div>
</div>
<div class="col-12 col-md-1 sign_block">
    <div class="label-div mb-0">
        <label class="pt-2 mb-0">Date:</label>
    </div>
</div>
<div class="col-12 col-md-4 sign_block">
    <div class="label-div mobile-mb-2">
        <input type="text" readonly placeholder="{{ __('MM/DD/YYYY') }}" class="h20 form-control date_filed required" name="income_profit_loss[{{$signDateName}}]" value="{{$finalDate}}"/>
    </div>
</div>