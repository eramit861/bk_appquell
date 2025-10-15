<!-- Personal Information -->
<div class="section-block d2_info hide-data">
    <div class="d-md-flex section-header">
        <div class="d-flex" style="gap: 15px;">
            <div class="section-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div>
                <h3 class="section-title">Co-Debtor's / Non-Filings Spouse's Information</h3>
                <p class="text-muted mb-0">Details about your co-debtor or spouse</p>
            </div>
        </div>
        <div class="ml-auto">
            <div class="label-div">
                <div class="form-group">
                    <label class="form-label">Is your Spouse filing with you?</label>
                    @php $yesNoArray = [ 1 => 'Yes', 0 => 'No']; @endphp
                    <select name="spouse_filing_with_you" class="form-control">
                        @foreach ($yesNoArray as $key => $val)
                            <option
                                {{ Helper::validate_key_value('spouse_filing_with_you', $formData, 'radio') == $key ? 'selected' : (old('spouse_filing_with_you') == $key ? 'selected' : '') }}
                                value="{{ $key }}">
                                {{ $val }}
                            </option>
                        @endforeach
                    </select>

                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        @include('intake_form.questions.basic_info_spouse')
    </div>
</div>