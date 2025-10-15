
<!-- business related property -->
@if (Helper::validate_key_value('is_business_property',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $isBusinessProperty) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         If married, do you or your spouse own or have any legal or equitable interest in any business property?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
            data-bs-original-title="(Business related property such as: Accounts receivables, Office equipment, Machinery, fixtures, tools of your trade, Inventory, Customer lists, mailing lists, and/or Any business-related property you did not already list.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <p class="text-bold mb-0">
            <span class="text-c-blue">This includes any property owned by a business that you or your spouse benefit from, even if it's not fully in your name.</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="is_business_property[id]"
            value="{{ Helper::validate_key_value('id', $isBusinessProperty) }}">
         <input type="hidden" name="is_business_property[type]" value="is_business_property">

         <input type="radio" id="is_business_property_items_yes" class="d-none" name="is_business_property[type_value]"
            required {!! Helper::validate_key_toggle('type_value', $isBusinessProperty, 1) !!} value="1">
         <label for="is_business_property_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $isBusinessProperty, 1) }}">Yes</label>

         <input type="radio" id="is_business_property_items_no" class="d-none" name="is_business_property[type_value]"
            required {!! Helper::validate_key_toggle('type_value', $isBusinessProperty, 0) !!} value="0">
         <label for="is_business_property_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $isBusinessProperty, 0) }}">No</label>
      </div>
   </div>
</div>
@else
<input type="hidden" name="is_business_property[type_value]" value="0">
@endif

<!-- farm or commercial fishing-related property -->
@if (Helper::validate_key_value('is_farm_property',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $isFarmProperty) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         If married, do you or your spouse have any legal or equitable interest in any farm or commercial fishing property?
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
            data-bs-original-title="(Indicates if you own or have any legal or financial interest in farm or commercial fishing-related property.)">
            <i class="bi bi-question-circle"></i>
         </div>
         <p class="text-bold mb-0">
            <span class="text-c-blue">This includes property used for farming or commercial fishing that you or your spouse benefit from, even if it's not fully in your name.</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="is_farm_property[id]"
            value="{{ Helper::validate_key_value('id', $isFarmProperty) }}">
         <input type="hidden" name="is_farm_property[type]" value="is_farm_property">

         <input type="radio" id="is_farm_property_items_yes" class="d-none" name="is_farm_property[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $isFarmProperty, 1) !!} value="1">
         <label for="is_farm_property_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $isFarmProperty, 1) }}">Yes</label>

         <input type="radio" id="is_farm_property_items_no" class="d-none" name="is_farm_property[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $isFarmProperty, 0) !!} value="0">
         <label for="is_farm_property_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $isFarmProperty, 0) }}">No</label>
      </div>
   </div>
</div>
@else
<input type="hidden" name="is_farm_property[type_value]" value="0">
@endif

<!-- Other Claims -->
@if (Helper::validate_key_value('other_financial',$moneyOwnSettings) == 1 || empty($moneyOwnSettings) || Helper::validate_key_value('type_value', $other_financial) == 1)
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         If married, do you or your spouse have any other personal or financial property not listed elsewhere in this questionnaire?
         <p class="text-bold mb-0">
            <span class="text-c-blue">Include anything of value you haven't already mentioned, such as personal belongings, investments, or other financial interests.</span>
         </p>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="other_financial[id]"
            value="{{ Helper::validate_key_value('id', $other_financial) }}">
         <input type="hidden" name="other_financial[type]" value="other_financial">

         <input type="radio" id="other_financial_items_yes" class="d-none" name="other_financial[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $other_financial, 1) !!} value="1">
         <label for="other_financial_items_yes"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $other_financial, 1) }}"
            onclick="getFinancialAssetItems('yes');">Yes</label>

         <input type="radio" id="other_financial_items_no" class="d-none" name="other_financial[type_value]" required
            {!! Helper::validate_key_toggle('type_value', $other_financial, 0) !!} value="0">
         <label for="other_financial_items_no"
            class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $other_financial, 0) }}"
            onclick="getFinancialAssetItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div
   class="col-12 {{ !$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $other_financial) }}"
   id="financial_asset_data">
   @include("client.questionnaire.property.financial.common.parent_other_financial")
</div>
@else
<input type="hidden" name="other_financial[type_value]" value="0">
@endif