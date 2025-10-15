@php
    $eAA = \App\Helpers\ArrayHelper::getEmergencyAssessmentArray();
@endphp

<div class="emergency-alert">
    <div class="emergency-content">
        <h5 class="mb-3">
            <i class="bi bi-alarm me-2"></i>
            Urgent Situations (Check all that apply)
        </h5>
        <div class="row g-2">
            <div class="col-md-12">
                <div class="custom-radio-group custom-check-group form-group mt-0 mb-2">
                    @foreach($eAA as $key => $label)
                        <label for="emergency_check_{{ $key }}" class="btn-toggle {{ (!empty($emergencyCheckArr[$key]) && $emergencyCheckArr[$key] == 1) ? 'active' : (old('emergency_check.' . $key) == 1 ? 'active' : '') }}"
                               onclick="intakeFormCheckboxClick(this); {{ $key == 14 ? 'otherClicked(this, `emergency_notes_section`);' : '' }}"    
                               style="width: auto; display: inline-block; margin-right: 10px; margin-bottom: 5px;">
                            <input type="checkbox" name="emergency_check[{{ $key }}]" value="1"
                             id="emergency_check_{{ $key }}" class="" {{ (!empty($emergencyCheckArr[$key]) && $emergencyCheckArr[$key] == 1) ? 'checked' : (old('emergency_check.' . $key) == 1 ? 'checked' : '') }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="row mt-3 emergency_notes_section {{ (!empty($emergencyCheckArr[14]) && $emergencyCheckArr[14] == 1) ? '' : (old('emergency_check.' . 14) == 1 ? '' : 'hide-data') }}">
            <div class="col-12">
                <label for="emergency_notes" class="form-label fw-bold">NOTES:</label>
                <textarea id="emergency_notes" name="emergency_notes" class="form-control" rows="3"
                  placeholder="Enter any additional notes here...">{{ !empty(Helper::validate_key_value('emergency_notes', $formData)) ? Helper::validate_key_value('emergency_notes', $formData) : old('emergency_notes') }}</textarea>
            </div>
        </div>
    </div>
</div>