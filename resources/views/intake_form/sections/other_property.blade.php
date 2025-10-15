@php
    $vehicleData = Helper::validate_key_value('vehicle_details', $formData, 'array');
@endphp
<div class="section-block">
    <div class="section-header">
        <div class="section-icon">
            <i class="bi bi-card-list"></i>
        </div>
        <div>
            <h3 class="section-title">Other property.</h3>
            <p class="text-muted mb-0">Details of your other property.</p>
        </div>
    </div>

    <div class="row g-4">
        @include('intake_form.questions.other_property')
    </div>
</div>