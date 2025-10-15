@php
    $r1Checked = $r1Checked ?? false;
    $r2Checked = $r2Checked ?? false;
@endphp

<div class="{{ $extraClass ?? '' }}">
    <label class="pl-3" for="Yes-{{ $fieldNameYes }}"> 
        <input 
            type="checkbox" 
            name="{{ base64_encode($fieldNameYes) }}" 
            value="{{ $r1Value }}" 
            {!! $r1Checked ? 'checked' : '' !!} 
            class="form-control w-auto mr-2" 
            id="Yes-{{ $fieldNameYes }}"
        >
        Yes
    </label>

    <label class="pl-3" for="No-{{ $fieldNameNo }}">
        <input 
            type="checkbox" 
            name="{{ base64_encode($fieldNameNo) }}" 
            value="{{ $r2Value }}" 
            {!! $r2Checked ? 'checked' : '' !!} 
            class="form-control w-auto mr-2" 
            id="No-{{ $fieldNameNo }}"
        >
        No
    </label> 
</div>
