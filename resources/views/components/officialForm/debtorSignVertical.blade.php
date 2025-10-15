<div class="row">
    <div class="col-md-4 p-2">
        <label>{{ $labelContent }}</label>
    </div>
    <div class="col-md-8">
        <input name="{{ base64_encode($inputFieldName) }}" value="{{ $inputValue }}" type="text" class="form-control">
    </div>
</div>
