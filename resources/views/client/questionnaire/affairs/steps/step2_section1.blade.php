
<!-- List any gifts -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the past 2 years, have you <span class="text-c-blue">given</span> any <span class="text-c-blue">gifts</span> worth more than <span class="text-c-blue">$600</span> to any one person?
            <p class="text-bold mb-0">
                <span class="text-c-blue">This includes money, property, or anything valuable given to friends, family, or others.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="list_any_gifts_yes" class="d-none" name="list_any_gifts" required {{ Helper::validate_key_toggle('list_any_gifts', $finacial_affairs, 1) }} value="1">
            <label for="list_any_gifts_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('list_any_gifts', $finacial_affairs, 1) }}" onclick="getListGiftsData('yes');">Yes</label>

            <input type="radio" id="list_any_gifts_no" class="d-none" name="list_any_gifts" required {{ Helper::validate_key_toggle('list_any_gifts', $finacial_affairs, 0) }} value="0">
            <label for="list_any_gifts_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('list_any_gifts', $finacial_affairs, 0) }}" onclick="getListGiftsData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-md-12 {{ Helper::key_hide_show_v('list_any_gifts', $finacial_affairs) }}" id="list-any-gifts-data">
    @include("client.questionnaire.affairs.common.parent_list_any_gifts")
</div>

<!-- List any Charity gifts -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the past 2 years, have you <span class="text-c-blue">given gifts</span> or <span class="text-c-blue">donations</span> worth more than <span class="text-c-blue">$600</span> to any charity?
            <p class="text-bold mb-0">
                <span class="text-c-blue">This includes money, property, or other valuable items donated to any nonprofit or charitable organization.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="gifts-charity_yes" class="d-none" name="gifts_charity" required {{ Helper::validate_key_toggle('gifts_charity', $finacial_affairs, 1) }} value="1">
            <label for="gifts-charity_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('gifts_charity', $finacial_affairs, 1) }}" onclick="getGiftsCharityData('yes');">Yes</label>

            <input type="radio" id="gifts-charity_no" class="d-none" name="gifts_charity" required {{ Helper::validate_key_toggle('gifts_charity', $finacial_affairs, 0) }} value="0">
            <label for="gifts-charity_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('gifts_charity', $finacial_affairs, 0) }}" onclick="getGiftsCharityData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('gifts_charity', $finacial_affairs) }}" id="gifts-charity-data">
    @include("client.questionnaire.affairs.common.parent_gifts_charity")
</div>

<!--17. Losses from fire -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Within the last 12 months did you lose anything because of theft, fire, other disaster, or gambling?
            <p class="text-bold mb-0">
                <span class="text-c-blue">This includes: Stolen money or property, Damage from fire, flood, or other disasters, Losses from gambling or betting.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="losses_from_fire_yes" class="d-none" name="losses_from_fire" required {{ Helper::validate_key_toggle('losses_from_fire', $finacial_affairs, 1) }} value="1">
            <label for="losses_from_fire_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('losses_from_fire', $finacial_affairs, 1) }}" onclick="getLossesFireData('yes');">Yes</label>

            <input type="radio" id="losses_from_fire_no" class="d-none" name="losses_from_fire" required {{ Helper::validate_key_toggle('losses_from_fire', $finacial_affairs, 0) }} value="0">
            <label for="losses_from_fire_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('losses_from_fire', $finacial_affairs, 0) }}" onclick="getLossesFireData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('losses_from_fire', $finacial_affairs) }}" id="losses_from_fire-data">
    @include("client.questionnaire.affairs.common.parent_losses_from_fire")
</div>

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('sofa_section_gifts')">
      No to all of the above
   </button>
</div>