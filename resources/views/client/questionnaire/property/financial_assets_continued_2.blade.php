
<!-- Inheritance -->
@if (Helper::validate_key_value('inheritances',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $inheritances) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or a spouse, if applicable, have any interest in property that is due to you from someone who has died?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
            data-bs-original-title="(If you are the beneficiary of a living trust, expect proceeds from a life insurance policy, or are currently entitled to receive property because someone has died.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <p class="text-bold mb-0">
            <span class="text-danger">(If you are the beneficiary of a living trust, expect proceeds from a life
               insurance policy, or are currently entitled to receive property because someone has died.)</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="inheritances[id]"
            value="{{ Helper::validate_key_value('id', $inheritances) }}">
         <input type="hidden" name="inheritances[type]" value="inheritances">

         <input type="radio" id="inheritances_items_yes" class="d-none" name="inheritances[type_value]" required {!! Helper::validate_key_toggle('type_value', $inheritances, 1) !!} value="1">
         <label for="inheritances_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $inheritances, 1) }}"
            onclick="getInheritancesBenefitsItems('yes');">Yes</label>

         <input type="radio" id="inheritances_items_no" class="d-none" name="inheritances[type_value]" required {!! Helper::validate_key_toggle('type_value', $inheritances, 0) !!} value="0">
         <label for="inheritances_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $inheritances, 0) }}"
            onclick="getInheritancesBenefitsItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $inheritances) }}"
   id="Inheritances_benefits_data">
   @include("client.questionnaire.property.financial.common.parent_inheritances")
</div>
@else
<input type="hidden" name="inheritances[type_value]" value="0">
@endif

<!-- Injury Claims -->
@if (Helper::validate_key_value('injury_claims',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $injury_claims) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         If married, do you or your spouse have any current or potential claims or lawsuits related to the items listed below?
         <p class="mb-0 text-c-blue font-weight-bold">(This includes: Car Accidents, Slip and Fall, Medical Malpractice,
            Workplace Injuries, Product Liability, Dog Bites, etc.)</p>
         <p class="text-bold mb-0">
            <span class="text-danger">(If you have the <u>ability</u> to and/or <u>you are suing</u> any entity. Its
               crucial that you list these above failing to disclose them may result in losing the case to the Court
               Trustee, who may take control of the claim.)</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="injury_claims[id]"
            value="{{ Helper::validate_key_value('id', $injury_claims) }}">
         <input type="hidden" name="injury_claims[type]" value="injury_claims">

         <input type="radio" id="injury_claims_items_yes" class="d-none" name="injury_claims[type_value]" required {!! Helper::validate_key_toggle('type_value', $injury_claims, 1) !!} value="1">
         <label for="injury_claims_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $injury_claims, 1) }}"
            onclick="getPersonalInjuryItems('yes');">Yes</label>

         <input type="radio" id="injury_claims_items_no" class="d-none" name="injury_claims[type_value]" required {!! Helper::validate_key_toggle('type_value', $injury_claims, 0) !!} value="0">
         <label for="injury_claims_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $injury_claims, 0) }}"
            onclick="getPersonalInjuryItems('no');">No</label>
      </div>

   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $injury_claims) }}"
   id="personal_injury_data">
   @include("client.questionnaire.property.financial.common.parent_injury_claims")
</div>
@else
<input type="hidden" name="injury_claims[type_value]" value="0">
@endif

<!-- Other Claims -->
@if (Helper::validate_key_value('other_claims',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $other_claims) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or a spouse, if applicable, have any potential legal claims (even if they are not fully settled or
         determined) that could affect your financial situation, including claims where you might owe or be owed money?
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="other_claims[id]"
            value="{{ Helper::validate_key_value('id', $other_claims) }}">
         <input type="hidden" name="other_claims[type]" value="other_claims">

         <input type="radio" id="other_claims_items_yes" class="d-none" name="other_claims[type_value]" required {!! Helper::validate_key_toggle('type_value', $other_claims, 1) !!} value="1">
         <label for="other_claims_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $other_claims, 1) }}"
            onclick="getOtherClaimsItems('yes');">Yes</label>

         <input type="radio" id="other_claims_items_no" class="d-none" name="other_claims[type_value]" required {!! Helper::validate_key_toggle('type_value', $other_claims, 0) !!} value="0">
         <label for="other_claims_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $other_claims, 0) }}"
            onclick="getOtherClaimsItems('no');">No</label>
      </div>
      <p class="text-bold mb-0">
         <span class="text-c-blue">This is different then the question above. This question is asking if you have any
            claims that aren't settled or a value has yet to be determined, list it here.</span>
         </br>
         <span class="text-c-blue">This means your due a settlement or sum of money, however the full amount has yet to
            be determined or your right to sue is yet to be determined.</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $other_claims) }}"
   id="other_claims_data">
   @include("client.questionnaire.property.financial.common.parent_other_claims")
</div>
@else
<input type="hidden" name="other_claims[type_value]" value="0">
@endif

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('financial_assets_continued_2')">
      No to all of the above
   </button>
</div>