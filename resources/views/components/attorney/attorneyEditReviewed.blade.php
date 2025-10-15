@if (isset($reviewedData) && !empty($reviewedData))
    @php
        $extraClass = isset($extraClass) ? ' ' . $extraClass : '';
        $name = Helper::validate_key_value('reviewed_by_name', $reviewedData);
        $timeStamp = Helper::validate_key_value('reviewed_on', $reviewedData);
        $noteForView =
            'Reviewed By: ' . $name . ' on: Date ' . \Carbon\Carbon::parse($timeStamp)->format('m/d/Y @ h:i A');
    @endphp
    <span class="text-c-red text-bold w-auto {{ $extraClass }}">
        {!! $noteForView !!}
    </span>
@endif
