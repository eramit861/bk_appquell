@props([
    'title' => '',
    'description' => '',
    'name' => '',
    'value' => '',
    'required' => false,
    'options' => [],
    'type' => 'text',
    'placeholder' => '',
    'class' => 'form-control',
    'onchange' => '',
    'id' => null,
])

<div class="form-group">
    @if ($title)
        <label class="d-block">{!! $title !!}</label>
    @endif

    @if ($description)
        <label class="d-block text-c-blue">{!! $description !!}</label>
    @endif

    @if ($type === 'select')
        <select name="{{ $name }}" class="{{ $class }}" {{ $required ? 'required' : '' }}>
            <option value="">Please Select {!! $title !!}</option>
            @foreach ($options as $key => $option)
                <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>{{ $option }}</option>
            @endforeach
        </select>
    @else
        <input type="{{ $type }}" name="{{ $name }}" class="{{ $class }}"
            placeholder="{{ $placeholder }}" value="{{ $value }}" {{ $required ? 'required' : '' }}
            {!! $onchange ? 'onchange="' . $onchange . '"' : '' !!}>
    @endif
</div>
