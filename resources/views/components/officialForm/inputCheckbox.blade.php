<input type="checkbox" name="{{ base64_encode($name) }}" class="form-control height_fit_content w-auto {{ $class }}"
    value="{{ $value }}" {!! $checked ?? '' !!}>
