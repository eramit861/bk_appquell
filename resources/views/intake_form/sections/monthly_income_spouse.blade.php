@php
    $income_data = Helper::validate_key_value('codebtor_income_data', $formData, 'array');
@endphp

<!-- Personal Information -->
<div class="section-block d2_info hide-data">
    <div class="section-header">
        <div class="section-icon">
            <i class="bi bi-cash-stack"></i>
        </div>
        <div>
            <h3 class="section-title">Co-Debtor's/Non-Filings Spouse's Income Information</h3>
            <p class="text-muted mb-0">Monthly income details about your co-debtor or spouse</p>
        </div>
    </div>

    <div class="row g-4">
        @include('intake_form.questions.monthly_income_spouse')
    </div>
</div>
