<div class="input-group">
    <input name="{{ base64_encode($dateNameField) }}" placeholder="{{ __('MM/DD/YYYY') }}" type="text"
        value="{{ $currentDate }}" class="date_filed width_auto form-control">
    <br>
    <label for="">{{ $labelText }}</label>
</div>
