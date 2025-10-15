<div class="input-grpup">
    <label>{{ __('Attorney or Party Name, Address, Telephone & FAX Nos., State Bar No. & Email Address') }}</label>
    <textarea name="{{ base64_encode('Party Information') }}" value="" class="form-control" rows="10" cols=""
        style="padding-right:5px;">{!! htmlentities($attorneyDetails) !!}</textarea>
</div>
<div class="input-group">
    <input name="{{ base64_encode('atty1') }}" value="Choice 1" type="checkbox">
    <label for="">
        <i>{{ __('Debtor(s) appearing without attorney') }}</i>
    </label>
</div>
<div class="input-group">
    <input name="{{ base64_encode('atty1') }}" value="Choice 2" type="checkbox" checked="checked">
    <label for="">
        <i>{{ __('Attorney for Debtor') }}</i>
    </label>
</div>