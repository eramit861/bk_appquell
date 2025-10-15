@php
    $reviewUrl = $attorney_company->attorney_review_url ?? '';
    $findUsDataArr = Helper::validate_key_value('find_us', $formData, 'array');
    $findUsArray = \App\Helpers\ArrayHelper::getFindUsArray();
@endphp

<div class="col-md-12">
    <div class="label-div question-area">
        <label class="form-label">How did you find {{ $attorney_company->company_name }}?</label>
        <div class="row g-2">
            <div class="col-md-12">
                <div class="custom-radio-group custom-check-group form-group mt-0">
                    @foreach($findUsArray as $key => $label)
                        <label for="find_us_{{ $key }}" class="btn-toggle {{ (!empty($findUsDataArr[$key]) && $findUsDataArr[$key] == 1) ? 'active' : (old('find_us.' . $key) == 1 ? 'active' : '') }}" 
                               style="width: auto; display: inline-block; margin-right: 10px; margin-bottom: 5px;" 
                               onclick="intakeFormCheckboxClick(this); {{ $key == 14 ? 'otherClicked(this, `referral_name_section`);' : '' }}">
                            <input type="checkbox" name="find_us[{{ $key }}]" value="1" id="find_us_{{ $key }}" class="" {{ (!empty($findUsDataArr[$key]) && $findUsDataArr[$key] == 1) ? 'checked' : (old('find_us.' . $key) == 1 ? 'checked' : '') }}>
                            {{ $label }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="col-md-12 referral_name_section {{ (!empty($findUsDataArr[14]) && $findUsDataArr[14] == 1) ? '' : (old('find_us.' . 14) == 1 ? '' : 'hide-data') }}">
                <div class="label-div">
                    <div class="form-group">
                        <label class="form-label">If referred by someone not listed, what is their name?</label>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <input type="text" name="find_us_referred_by" class="input_capitalize form-control" placeholder="Name"
                                    value="{{ !empty(Helper::validate_key_value('find_us_referred_by', $formData)) ? Helper::validate_key_value('find_us_referred_by', $formData) : old('find_us_referred_by') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="label-div question-area">
        <label>Have you read our Google reviews? They are the best in NC!</label>

        <!-- Radio -->
        <div class="custom-radio-group form-group align-items-center">
            <input type="radio" name="google_reviews" id="google_reviews_yes" class="" value="1"
                   {{ (Helper::validate_key_value('google_reviews', $formData, 'radio') === 1 || old('google_reviews') === '1') ? 'checked' : '' }}>
            <label for="google_reviews_yes" class="btn-toggle" onclick="toggleReviewsButton(1)">Yes / Some</label>

            <input type="radio" name="google_reviews" id="google_reviews_no" class="" value="0"
                   {{ (Helper::validate_key_value('google_reviews', $formData, 'radio') === 0 || old('google_reviews') === '0') ? 'checked' : '' }}>
            <label for="google_reviews_no" class="btn-toggle" onclick="toggleReviewsButton(0)">No</label>
                
            @if(!empty($reviewUrl))
                <!-- Button that appears when "No" is selected -->
                <div id="reviews-button-container" 
                     class="ml-auto {{ (Helper::validate_key_value('google_reviews', $formData, 'radio') === 0 || old('google_reviews') === '0') ? '' : 'hide-data' }}">
                    <button type="button" class="btn-submit-success blink mb-0" 
                            onclick="window.open('{{ $reviewUrl }}', '_blank');">
                        <i class="bi bi-star-fill me-2"></i>
                        Click to see {{ $attorney_company->company_name }} reviews
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="label-div question-area">
        <label>Zoom Video Conference Experience</label>

        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" name="zoom_exp" id="zoom_exp_yes" class="" value="1"
                   {{ (Helper::validate_key_value('zoom_exp', $formData, 'radio') === 1 || old('zoom_exp') === '1') ? 'checked' : '' }}>
            <label for="zoom_exp_yes" class="btn-toggle">Comfortable with Zoom</label>

            <input type="radio" name="zoom_exp" id="zoom_exp_no" class="" value="0"
                   {{ (Helper::validate_key_value('zoom_exp', $formData, 'radio') === 0 || old('zoom_exp') === '0') ? 'checked' : '' }}>
            <label for="zoom_exp_no" class="btn-toggle">Need Help with Zoom</label>
        </div>
    </div>
</div>