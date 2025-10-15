<div class="col-md-3">
    <div class="form-group">
        <label>{{ $label }}</label>
            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{ $span }}</span>
                </div>
                <input id="{{ $inputId }}" required placeholder= "{{ $placeholder }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}" class="{{ $inputClass }}">
            </div>
    </div>
</div>