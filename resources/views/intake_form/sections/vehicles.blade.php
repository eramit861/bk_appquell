@php
    $vehicleData = Helper::validate_key_value('vehicle_details', $formData, 'array');
@endphp

<div class="section-block">
    <div class="section-header">
        <div class="section-icon">
            <i class="bi bi-car-front"></i>
        </div>
        <div>
            <h3 class="section-title">Vehicles/ Motorcycles/ Boats etc.</h3>
            <p class="text-muted mb-0">Details of your cars, motorcycles, boats, etc.</p>
        </div>
    </div>

    <div class="row g-4">
        @include('intake_form.questions.vehicles')
    </div>
</div>