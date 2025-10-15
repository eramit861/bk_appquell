<div class="{{ $divClass }}">
    <div class="label-div">
        <div class="form-group">
            <label>{{ $label }}</label>
            <select class="form-control {{ $selectClass }}" name="{{ $name }}">
                {!! $slot !!}
            </select>
        </div>
    </div>
</div>
