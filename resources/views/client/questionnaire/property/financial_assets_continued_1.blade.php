<!-- Family Support -->
@if (Helper::validate_key_value('alimony_child_support',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $alimony_child_support) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Are you or your spouse getting or expecting any family support, such as <span class="text-c-blue">child
            support</span> and/or <span class="text-c-blue">alimony</span>?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
            data-bs-original-title="(Examples: Court ordered monthly support, past due/arrears or lump sum of: child support, alimony, spousal support, maintenance, divorce settlement, and/or property settlement.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <p class="text-bold mb-0">
            <span class="text-c-blue">This includes any money either ofyou receive from a former spouse or partner for yourself or your children.</span></br>
            <span class="text-danger">Include any support you are supposed to receive, whether or not payments are currently being made</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="alimony_child_support[id]"
            value="{{ Helper::validate_key_value('id', $alimony_child_support) }}">
         <input type="hidden" name="alimony_child_support[type]" value="alimony_child_support">

         <input type="radio" id="alimony_child_support_items_yes" class="d-none"
            name="alimony_child_support[type_value]" required {!! Helper::validate_key_toggle('type_value', $alimony_child_support, 1) !!} value="1">
         <label for="alimony_child_support_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $alimony_child_support, 1) }}"
            onclick="getAlimonyChildItems('yes');">Yes</label>

         <input type="radio" id="alimony_child_support_items_no" class="d-none" name="alimony_child_support[type_value]"
            required {!! Helper::validate_key_toggle('type_value', $alimony_child_support, 0) !!} value="0">
         <label for="alimony_child_support_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $alimony_child_support, 0) }}"
            onclick="getAlimonyChildItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $alimony_child_support) }}"
   id="alimony_child_data">
   @include("client.questionnaire.property.financial.common.parent_alimony_child_support")
</div>
@else
<input type="hidden" name="alimony_child_support[type_value]" value="0">
@endif

<!-- Unpaid Wages -->
@if (Helper::validate_key_value('unpaid_wages',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $unpaid_wages) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label class="d-block">
         Are you or your spouse getting, or have you applied for, any of these: Social Security (SSI/SSDI), VA benefits, unemployment, disability,
workers' comp, unpaid wages, sick or vacation pay , or repayment of a personal loan?
         <br>
         <p class="blink text-danger text-bold mb-0">List any benefits (Social Security, SSDI, unemployment, etc.) you're receiving or have applied for <i class="fa fa-arrow-down"></i></p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="unpaid_wages[id]"
            value="{{ Helper::validate_key_value('id', $unpaid_wages) }}">
         <input type="hidden" name="unpaid_wages[type]" value="unpaid_wages">

         <input type="radio" id="unpaid_wages_items_yes" class="d-none" name="unpaid_wages[type_value]" required {!! Helper::validate_key_toggle('type_value', $unpaid_wages, 1) !!} value="1">
         <label for="unpaid_wages_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $unpaid_wages, 1) }}"
            onclick="getUnpaidWagesItems('yes');">Yes</label>

         <input type="radio" id="unpaid_wages_items_no" class="d-none" name="unpaid_wages[type_value]" required {!! Helper::validate_key_toggle('type_value', $unpaid_wages, 0) !!} value="0">
         <label for="unpaid_wages_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $unpaid_wages, 0) }}"
            onclick="getUnpaidWagesItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $unpaid_wages) }}"
   id="unpaid_wages_data">
   @include("client.questionnaire.property.financial.common.parent_unpaid_wages")
</div>
@else
<input type="hidden" name="unpaid_wages[type_value]" value="0">
@endif

<!-- Life Insurance -->
@if (Helper::validate_key_value('life_insurance',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $life_insurance) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or your spouse have any interests in any life insurance policy with a cash value, such as whole or universal life?
            
         <p class="text-bold mb-0">
            <span class="text-c-blue">(Not term-life which only has value upon death).</span>
         </p>
         <p class="text-bold mb-0 blink">
            <span class="text-danger fs-13px">This is very important to avoid losing coverage. If you’re unsure, upload a copy of the policy, under additional doc(s) so your attorney can review it for you.</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="life_insurance[id]"
            value="{{ Helper::validate_key_value('id', $life_insurance) }}">
         <input type="hidden" name="life_insurance[type]" value="life_insurance">

         <input type="radio" id="life_insurance_items_yes" class="d-none" name="life_insurance[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $life_insurance, 1) !!} value="1">
         <label for="life_insurance_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $life_insurance, 1) }}"
            onclick="getLifeInsuranceItems('yes');">Yes</label>

         <input type="radio" id="life_insurance_items_no" class="d-none" name="life_insurance[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $life_insurance, 0) !!} value="0">
         <label for="life_insurance_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $life_insurance, 0) }}"
            onclick="getLifeInsuranceItems('no'); openFlagPopup('life-insurance-popup', 'No', true, {{ $attorney_edit }});">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $life_insurance) }}"
   id="life_insurance_data">
   @include("client.questionnaire.property.financial.common.parent_life_insurance")
</div>
@else
<input type="hidden" name="life_insurance[type_value]" value="0">
@endif

<!-- HSA/FSA -->
 @if (Helper::validate_key_value('insurance_policies',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $insurance_policies) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Do you or a spouse, if applicable, have any <span class="text-c-blue">Health Savings Accounts</span> (HSA)
         and/or <span class="text-c-blue">Flex Savings Accounts</span> (FSA)?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
            data-bs-original-title="(These include from your employer that come out of your pay OR your own accounts)">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="insurance_policies[id]"
            value="{{ Helper::validate_key_value('id', $insurance_policies) }}">
         <input type="hidden" name="insurance_policies[type]" value="insurance_policies">

         <input type="radio" id="insurance_policies_items_yes" class="d-none" name="insurance_policies[type_value]"
            required {!! Helper::validate_key_toggle('type_value', $insurance_policies, 1) !!} value="1">
         <label for="insurance_policies_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $insurance_policies, 1) }}"
            onclick="getInsurancePoliciesItems('yes');">Yes</label>

         <input type="radio" id="insurance_policies_items_no" class="d-none" name="insurance_policies[type_value]"
            required {!! Helper::validate_key_toggle('type_value', $insurance_policies, 0) !!} value="0">
         <label for="insurance_policies_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $insurance_policies, 0) }}"
            onclick="getInsurancePoliciesItems('no'); openFlagPopup('insurance-policies-popup', 'No', true, {{ $attorney_edit }});">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $insurance_policies) }}"
   id="insurance_policies_data">
   @include("client.questionnaire.property.financial.common.parent_insurance_policies")
</div>
@else
<input type="hidden" name="insurance_policies[type_value]" value="0">
@endif

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('financial_assets_continued_1')">
      No to all of the above
   </button>
</div>