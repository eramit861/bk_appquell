<div class="row">
    <div class="col-md-3 pt-2">
        <label>{{ $labelText }}</label>
    </div>
    <div class="col-md-9">
        <input name="{{ base64_encode($casenoNameField) }}" placeholder="" type="text" value="{{ $caseno }}"
            class="w-auto form-control">
    </div>
</div>
