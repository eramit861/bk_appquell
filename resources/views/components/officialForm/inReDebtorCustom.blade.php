<div class="input-group ">
    <label>{{ __('In re:') }}</label>
    <textarea name="{{ base64_encode($debtorNameField) }}" value="" class=" form-control" rows="{{ $rows }}" style="padding-right:5px;">{{ $debtorname ?? '' }}</textarea>
</div> 
{{ __('Debtor(s)') }}.