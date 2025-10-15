<div class="card border-danger mb-3">
    <div class="card-body">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="consentCheckbox" name="consent" required
                {{ !empty($formData) ? 'checked' : '' }}>
            <label class="form-check-label fw-bold text-danger" for="consentCheckbox">
                Consent <span class="text-danger">*</span> Required
            </label>
        </div>
        <small class="text-muted">
            To go forward, this <span class="fw-bold">MUST</span> be checked.<br>
            By clicking the checkbox, you consent to get texts regarding appointments and other messages from  {{ $attorney_company->company_name??'' }} and/or BK Questionnaire. Frequency may vary. Message data rates may apply. Reply STOP to
            opt out or HELP for more information.
            @if (isset($attorney_privacy_policy_url) && !empty($attorney_privacy_policy_url))
                View our terms and privacy policy at our website
                <a href="{{ $attorney_privacy_policy_url }}" target="_blank">{{ $attorney_privacy_policy_url }}</a>
            @endif
        </small>
    </div>
</div>
