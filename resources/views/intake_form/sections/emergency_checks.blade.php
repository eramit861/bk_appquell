@php
    $emergencyCheckArr = Helper::validate_key_value('emergency_check', $formData, 'array');
@endphp
<!-- Emergency Assessment -->
<div class="section-block {{ $showEmergencySection }}">
    <div class="section-header">
        <div class="section-icon">
            <i class="bi bi-exclamation-triangle"></i>
        </div>
        <div>
            <h3 class="section-title">Emergency Assessment</h3>
            <p class="text-muted mb-0">Time-sensitive legal situations</p>
        </div>
    </div>

    @include('intake_form.questions.emergency_checks')
</div>