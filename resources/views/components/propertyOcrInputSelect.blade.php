<div class="{{ $divClass }}">
    <div class="form-group">
        <label>{{ $label }}</label>
        <div class="input-group mb-4">
            <input id="{{ $inputId }}" required placeholder="{{ $placeholder }}" type="{{ $type }}"
                class="form-control" value="{{ $value }}" name="{{ $name }}">
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label>{{ __('State') }}</label>
        <div class="input-group mb-4">
            <select id="state" class="form-control required" required name="state">
                <option value="">{{ __('Please Select State') }}</option>
                {!! AddressHelper::getStatesList($stateval) !!}
            </select>
        </div>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <labelOnly label="Zip" />
        <div class="input-group mb-4">
            <input id="zip" required placeholder= "Zip" type="text" class="allow-5digit form-control"
                value="{{ $zipval }}" name="zip">
        </div>
    </div>
</div>
