@php 
    $attorneyPhone = Helper::validate_key_value('attorney_phone', $attorney_company); 
@endphp

<div class="consultation-instructions">
    @if ($stepNo == 1)
    <p>We have three forms that need to be filled out. It will take 5-10 minutes. You must fill them out so we have
        something to talk about in your free consultation. The figures do not need to be exact, but rough estimates.
    </p>
    @endif
    @if ($stepNo == 2)
    <p>Hello, <span class="form-label">{{ $clientname }}</span></p>
    <p>This is the second of three forms that need to be filled out. It will take 5-10 minutes. It is important you fill
        them out so we have something to talk about in your free consultation. The figures do not need to be exact, but
        rough estimates.
    </p>
    @endif
    @if ($stepNo == 3)
    <p>Hello, <span class="form-label">{{ $clientname }}</span></p>
    <p>This is the LAST of four forms that need to be filled out. It will take 5-10 minutes. It is important you fill
        them out so we have something to talk about in your free consultation. The figures do not need to be exact, but
        rough estimates.
    </p>
    @endif
    <p>I need all this information to give you the best consultation possible!</p>
    <p class="form-label mb-0">If a question does not apply, please write "N/A" unless a date, then leave it blank!</p>
</div>

<div class="success-notice">
    <p class="mb-0">
        <i class="bi bi-clock-fill me-2"></i>
        {{ Helper::validate_key_value('name', $attorney) }} is available 10 am - 10 pm, 7 days a week.
    </p>
    <p class="mb-0">
        <i class="bi bi bi-telephone-fill me-2"></i>
        If you have any questions call {{ Helper::validate_key_value('name', $attorney) }} at: 
        <strong>
            <a href="{{ !empty($attorneyPhone) ? 'tel:' . $attorneyPhone : 'javascript:void(0);' }}" >{{ !empty($attorneyPhone) ? $attorneyPhone : '' }}</a>
        </strong>
    </p>
</div>