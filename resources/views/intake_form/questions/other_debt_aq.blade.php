@if (!empty($questions))
    @foreach ($questions as $index => $data)
        <div class="col-md-12">
            <div class="label-div question-area ">
                <label class="form-label">{{ $data['question'] }}</label>
                <!-- Radio -->
                <div class="custom-radio-group form-group">
                    @php
                        $cq = Helper::validate_key_loop_value_radio('concierge_question', $formData, $data['id']);
                    @endphp
                    <input type="radio" required name="concierge_question[{{ $data['id'] }}]" {{ (($cq !== '' ? (string) $cq === '0' : old('concierge_question[' . $data['id'] . ']') === '0') ? 'checked' : '') }}
                        class="form-check-input" id="concierge_question_yes[{{ $data['id'] }}]" value="0">
                    <label for="concierge_question_yes[{{ $data['id'] }}]" class="btn-toggle">Yes</label>
                    <input type="radio" required name="concierge_question[{{ $data['id'] }}]" {{ (($cq !== '' ? (string) $cq === '1' : old('concierge_question[' . $data['id'] . ']') === '1') ? 'checked' : '') }}
                        class="form-check-input" id="concierge_question_no[{{ $data['id'] }}]" value="1">
                    <label for="concierge_question_no[{{ $data['id'] }}]" class="btn-toggle">No</label>
                </div>
            </div>
        </div>
    @endforeach
@endif

<div class="col-md-12">
    <div class="label-div question-area">
        <!-- Radio  -->
        <label class="form-label">Are you being sued?</label>
        <div class="custom-radio-group form-group">
            <input type="radio" required name="being_sued" class="form-check-input" id="being_sued_yes" {{ (Helper::validate_key_value('being_sued', $formData, 'radio') === 0 || old('being_sued') === '0') ? 'checked' : '' }} value="0">
            <label for="being_sued_yes" class="btn-toggle">Yes</label>
            <input type="radio" required name="being_sued" class="form-check-input" id="being_sued_no" {{ (Helper::validate_key_value('being_sued', $formData, 'radio') === 1 || old('being_sued') === '1') ? 'checked' : '' }} value="1">
            <label for="being_sued_no" class="btn-toggle">No</label>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="label-div question-area">
        <label class="form-label">Are your wages currently being garnished?</label>
        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" required name="wages_being_garnished" class="form-check-input"
                id="wages_being_garnished_yes" {{ (Helper::validate_key_value('wages_being_garnished', $formData, 'radio') === 0 || old('wages_being_garnished') === '0') ? 'checked' : '' }} value="0">
            <label for="wages_being_garnished_yes" class="btn-toggle">Yes</label>
            <input type="radio" required name="wages_being_garnished" class="form-check-input"
                id="wages_being_garnished_no" {{ (Helper::validate_key_value('wages_being_garnished', $formData, 'radio') === 1 || old('wages_being_garnished') === '1') ? 'checked' : '' }} value="1">
            <label for="wages_being_garnished_no" class="btn-toggle">No</label>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="label-div">
        <div class="form-group">
            <label for="notes1" class="mb-1 form-label">Is there anything else you would like to share that would be
                useful
                for us to know for our appointment?</label>
            <textarea placeholder="" name="extra_notes" rows="4"
                class="form-textarea form-control mt-2">{{ !empty(Helper::validate_key_value('extra_notes', $formData)) ? Helper::validate_key_value('extra_notes', $formData) : old('extra_notes') }}</textarea>
        </div>
    </div>
</div>