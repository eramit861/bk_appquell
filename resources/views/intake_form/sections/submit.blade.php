@php $isReadOnly = !empty($formData) && Helper::validate_key_value('step_3_submited', $formData, 'radio') === 1; @endphp

<!-- Submit Section -->
<div class="submit-section">
    @if ($isReadOnly)
        @if ($stepNo > 1)
            <button type="button" class="btn-submit-back mb-3 me-2"
                onclick="redirectToURL('{{ route('intake_form', ['token' => $token, 'userId' => $userId, 'stepNo' => $stepNo - 1]) }}')">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Step {{ $stepNo - 1 }}
            </button>
        @endif
        @if ($stepNo < 3)
            <button type="button" class="btn-submit-back mb-3"
                onclick="redirectToURL('{{ route('intake_form', ['token' => $token, 'userId' => $userId, 'stepNo' => $stepNo + 1]) }}')">
                <i class="bi bi-arrow-right me-2"></i>
                Continue to Step {{ $stepNo + 1 }}
            </button>
        @endif
        <div class="success-notice mb-3">
            You have already submitted your consultation form.
        </div>
    @else
        <h4 class="text-primary mb-4 mt-0">Ready to Schedule Your Consultation?</h4>
        <p class="text-muted mb-4">By selecting submit consultation request below you're simply agreeing to: "I agree
            and
            consent to receiving text messages from the law firm and its affiliates."<br /></p>

        <input type="hidden" name="hasData" value="{{ !empty($formData) }}">

        @if ($stepNo == 1)
            <button type="button" class="btn-submit-dark mb-3" onclick="validateEmail(this)">
                <i class="bi bi-calendar-check me-2"></i>
                Submit Consultation Request
            </button>
        @else
            <button type="button" class="btn-submit-back mb-3 me-2"
                onclick="redirectToURL('{{ route('intake_form', ['token' => $token, 'userId' => $userId, 'stepNo' => $stepNo - 1]) }}')">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Step {{ $stepNo - 1 }}
            </button>
            <button type="button" class="btn-submit-dark mb-3" onclick="step2Submit(this)">
                <i class="bi bi-calendar-check me-2"></i>
                Submit Consultation Request
            </button>
        @endif
    @endif
</div>
