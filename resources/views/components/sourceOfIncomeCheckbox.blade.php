<div class="input-group">
    <label class="diplay_flex">
        <input  name="{{ $name }}" value="{{ $value }}" type="{{ $type }}" {{ str_replace("'", "",$checked) }} style="margin-right: 10px; align-self: flex-start;" >
        {{ $label }}
    </label>
</div>