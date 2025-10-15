<div class="d-flex radio-primary">
    <label>{{ __('CASE NO.:') }}</label>
    <input name="{{ base64_encode('Case Number') }}" placeholder="" type="text" value="{{ $caseno }}"
        class=" form-control">
</div>
<div class="d-flex radio-primary mt-3">
    <label>{{ __('CHAPTER:') }}</label>
    <select name="{{ base64_encode('Chapter') }}" value="" class="form-control">
        <option name="{{ base64_encode('Chapter') }}" value="**Select Chapter**">**SELECT CHAPTER**</option>
        <option name="{{ base64_encode('Chapter') }}" selected="selected" value="7">7</option>
        <option name="{{ base64_encode('Chapter') }}" value="11">11</option>
        <option name="{{ base64_encode('Chapter') }}" value="12">12</option>
        <option name="{{ base64_encode('Chapter') }}" value="13">13</option>
        <option name="{{ base64_encode('Chapter') }}" value="15">15</option>
    </select>
</div>