@php
$final = [];
if (!empty($businessassets)) {
    foreach ($businessassets as $business) {
        $b_type_data = json_decode($business['type_data'], 1);
        if (!empty($b_type_data)) {
            $business['description'] = (!empty($b_type_data['description'])) ? $b_type_data['description'] : "";
            $business['property_value'] = (!empty($b_type_data['property_value'])) ? $b_type_data['property_value'] : "";
            $business['type_of_account'] = (!empty($b_type_data['type_of_account'])) ? $b_type_data['type_of_account'] : "";
            $business['owned_by'] = (!empty($b_type_data['owned_by'])) ? $b_type_data['owned_by'] : "";
        }
        unset($business['type_data']);
        $final[$business['type']] = $business;
    }
}
$commissions = (!empty($final['commissions'])) ? $final['commissions'] : [];
$office_equipment = (!empty($final['office_equipment'])) ? $final['office_equipment'] : [];
$machinery_fixtures = (!empty($final['machinery_fixtures'])) ? $final['machinery_fixtures'] : [];
$business_inventory = (!empty($final['business_inventory'])) ? $final['business_inventory'] : [];
$interests = (!empty($final['interests'])) ? $final['interests'] : [];
$customer_mailing = (!empty($final['customer_mailing'])) ? $final['customer_mailing'] : [];
$other_business = (!empty($final['other_business'])) ? $final['other_business'] : [];
@endphp

<!-- Accounts receivable or commissions earned -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Accounts receivable or commissions earned
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Money owed to you for goods or services provided but not yet paid">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="commissions[id]" value="{{ Helper::validate_key_value('id', $commissions) }}">
         <input type="hidden" name="commissions[type]" value="commissions">

         <input type="radio" id="commissions_items_yes" class="d-none" name="commissions[type_value]" required {{ Helper::validate_key_toggle('type_value', $commissions, 1) }} value="1">
         <label for="commissions_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $commissions, 1) }}" onclick="getAccountsReceivableItems('yes');">Yes</label>

         <input type="radio" id="commissions_items_no" class="d-none" name="commissions[type_value]" required {{ Helper::validate_key_toggle('type_value', $commissions, 0) }} value="0">
         <label for="commissions_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $commissions, 0) }}" onclick="getAccountsReceivableItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $commissions) }}" id="account_receivable_data">
   <div class="outline-gray-border-area">
      <div class="light-gray-div mt-2">
         <div class="light-gray-box-form-area">
            <h2>
               <span class="pl-2"></span> Asset Details
            </h2>
            <div class="row gx-3">
               <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="commissions[data][description]" class="input_capitalize noadjust form-control required h-unset" placeholder="Description">{{ Helper::validate_key_value('description', $commissions) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="commissions[data][property_value]" class="form-control price-field  required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $commissions) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Office equipment, furnishings, and supplies -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Office equipment, furnishings, and supplies
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Items like desks, chairs, computers, and office materials used for business operations">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="office_equipment[id]" value="{{ Helper::validate_key_value('id', $office_equipment) }}">
         <input type="hidden" name="office_equipment[type]" value="office_equipment">

         <input type="radio" id="office_equipment_items_yes" class="d-none" name="office_equipment[type_value]" required {{ Helper::validate_key_toggle('type_value', $office_equipment, 1) }} value="1">
         <label for="office_equipment_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $office_equipment, 1) }}" onclick="getOfficeEquipmentItems('yes');">Yes</label>

         <input type="radio" id="office_equipment_items_no" class="d-none" name="office_equipment[type_value]" required {{ Helper::validate_key_toggle('type_value', $office_equipment, 0) }} value="0">
         <label for="office_equipment_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $office_equipment, 0) }}" onclick="getOfficeEquipmentItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $office_equipment) }}" id="office_equipment_data">
   <div class="outline-gray-border-area">
      <div class="light-gray-div mt-2">
         <div class="light-gray-box-form-area">
            <h2>
               <span class="pl-2"></span> Asset Details
            </h2>
            <div class="row gx-3">
               <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Description</label>
                        <textarea name="office_equipment[data][description]" class="input_capitalize noadjust form-control required h-unset" rows="3" placeholder="Description">{{ Helper::validate_key_value('description', $office_equipment) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="office_equipment[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $office_equipment) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Machinery, fixtures, equipment, business supplies, and tools of your trade -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Machinery, fixtures, equipment, business supplies, and tools of your trade
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Business-related tools, machinery, and essential equipment for your profession or trade">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="machinery_fixtures[id]" value="{{ Helper::validate_key_value('id', $machinery_fixtures) }}">
         <input type="hidden" name="machinery_fixtures[type]" value="machinery_fixtures">

         <input type="radio" id="machinery_fixtures_items_yes" class="d-none" name="machinery_fixtures[type_value]" required {{ Helper::validate_key_toggle('type_value', $machinery_fixtures, 1) }} value="1">
         <label for="machinery_fixtures_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $machinery_fixtures, 1) }}" onclick="getMachineryTradeItems('yes');">Yes</label>

         <input type="radio" id="machinery_fixtures_items_no" class="d-none" name="machinery_fixtures[type_value]" required {{ Helper::validate_key_toggle('type_value', $machinery_fixtures, 0) }} value="0">
         <label for="machinery_fixtures_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $machinery_fixtures, 0) }}" onclick="getMachineryTradeItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $machinery_fixtures) }}" id="machinery_trade_data">
   <div class="outline-gray-border-area">
      <div class="light-gray-div mt-2">
         <div class="light-gray-box-form-area">
            <h2>
               <span class="pl-2"></span> Asset Details
            </h2>
            <div class="row gx-3">
               <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="machinery_fixtures[data][description]" class="input_capitalize noadjust form-control required h-unset" placeholder="Description">{{ Helper::validate_key_value('description', $machinery_fixtures) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="machinery_fixtures[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $machinery_fixtures) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Business inventory -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Business inventory
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Goods or products held for sale or business use">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="business_inventory[id]" value="{{ Helper::validate_key_value('id', $business_inventory) }}">
         <input type="hidden" name="business_inventory[type]" value="business_inventory">

         <input type="radio" id="business_inventory_items_yes" class="d-none" name="business_inventory[type_value]" required {{ Helper::validate_key_toggle('type_value', $business_inventory, 1) }} value="1">
         <label for="business_inventory_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $business_inventory, 1) }}" onclick="getBusinessInventoryItems('yes');">Yes</label>

         <input type="radio" id="business_inventory_items_no" class="d-none" name="business_inventory[type_value]" required {{ Helper::validate_key_toggle('type_value', $business_inventory, 0) }} value="0">
         <label for="business_inventory_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $business_inventory, 0) }}" onclick="getBusinessInventoryItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $business_inventory) }}" id="business_inventory_data">
   <div class="outline-gray-border-area">
      <div class="light-gray-div mt-2">
         <div class="light-gray-box-form-area">
            <h2>
               <span class="pl-2"></span> Asset Details
            </h2>
            <div class="row gx-3">
               <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Description</label>
                        <textarea rows="3" name="business_inventory[data][description]" class="input_capitalize noadjust form-control required h-unset" placeholder="Description">{{ Helper::validate_key_value('description', $business_inventory) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="business_inventory[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $business_inventory) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Interests in partnerships or joint ventures  -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area ">
      <label>
         Interests in partnerships or joint ventures
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Ownership percentage in a partnership or joint business venture, including business type and name.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="interests[id]" value="{{ Helper::validate_key_value('id', $interests) }}">
         <input type="hidden" name="interests[type]" value="interests">

         <input type="radio" id="interests_items_yes" class="d-none" name="interests[type_value]" required {{ Helper::validate_key_toggle('type_value', $interests, 1) }} value="1">
         <label for="interests_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $interests, 1) }}" onclick="getInterestsPartnershipsItems('yes');">Yes</label>

         <input type="radio" id="interests_items_no" class="d-none" name="interests[type_value]" required {{ Helper::validate_key_toggle('type_value', $interests, 0) }} value="0">
         <label for="interests_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $interests, 0) }}" onclick="getInterestsPartnershipsItems('no');">No</label>
      </div>
      <p class="text-bold mb-0">
         <span class="text-c-blue font-italic">(Name and type of business, % of interest.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $interests) }}" id="interests_data">
   <div class="outline-gray-border-area">
      @if(!empty($interests['description']) && is_array($interests['description']))
         @for($i = 0; $i < count($interests['description']); $i++)
            @include("client.questionnaire.property.assets.interests",['interests'=>$interests,'i'=>$i])
         @endfor
      @else
         @include("client.questionnaire.property.assets.interests",['i'=>0])
      @endif
      <div class="add-more-div-bottom">
         <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('interests',6,'interests_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
         </button>
      </div>
   </div>
</div>


<!-- Customer and mailing lists -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Customer and mailing lists
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Databases of clients, leads, or contacts valuable to business operations">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="customer_mailing[id]" value="{{ Helper::validate_key_value('id', $customer_mailing) }}">
         <input type="hidden" name="customer_mailing[type]" value="customer_mailing">

         <input type="radio" id="customer_mailing_items_yes" class="d-none" name="customer_mailing[type_value]" required {{ Helper::validate_key_toggle('type_value', $customer_mailing, 1) }} value="1">
         <label for="customer_mailing_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $customer_mailing, 1) }}" onclick="getCustomerMailingItems('yes');">Yes</label>

         <input type="radio" id="customer_mailing_items_no" class="d-none" name="customer_mailing[type_value]" required {{ Helper::validate_key_toggle('type_value', $customer_mailing, 0) }} value="0">
         <label for="customer_mailing_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $customer_mailing, 0) }}" onclick="getCustomerMailingItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $customer_mailing) }}" id="customer_mailing_lists_data">
   <div class="outline-gray-border-area">
      <div class="light-gray-div mt-2">
         <div class="light-gray-box-form-area">
            <h2>
               <span class="pl-2"></span> Asset Details
            </h2>
            <div class="row gx-3">
               <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Description</label>
                        <textarea name="customer_mailing[data][description]" class="input_capitalize noadjust form-control required h-unset" placeholder="Description" rows="3">{{ Helper::validate_key_value('description', $customer_mailing) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="customer_mailing[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $customer_mailing) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Other business-related property not already listed  -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area ">
      <label>
         Other business-related property not already listed
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Any additional business assets not covered in the categories above.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="other_business[id]" value="{{ Helper::validate_key_value('id', $other_business) }}">
         <input type="hidden" name="other_business[type]" value="other_business">

         <input type="radio" id="other_business_items_yes" class="d-none" name="other_business[type_value]" required {{ Helper::validate_key_toggle('type_value', $other_business, 1) }} value="1">
         <label for="other_business_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $other_business, 1) }}" onclick="getOtherBusimessItems('yes');">Yes</label>

         <input type="radio" id="other_business_items_no" class="d-none" name="other_business[type_value]" required {{ Helper::validate_key_toggle('type_value', $other_business, 0) }} value="0">
         <label for="other_business_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $other_business, 0) }}" onclick="getOtherBusimessItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $other_business) }}" id="other_business_data">
   <div class="outline-gray-border-area">
      @if(!empty($other_business['description']) && is_array($other_business['description']))
         @for($i = 0; $i < count($other_business['description']); $i++)
            @include("client.questionnaire.property.assets.other_business",['other_business'=>$other_business,'i'=>$i])
         @endfor
      @else
         @include("client.questionnaire.property.assets.other_business",['i'=>0])
      @endif
      <div class="add-more-div-bottom">
         <button type="button" class="btn-new-ui-default py-1 px-2" onclick="common_financial_addmore_with_limit('other_business',6,'other_business_mutisec'); return false;">
            <i class="bi bi-plus-lg"></i>
            Add More
         </button>
      </div>
   </div>
</div>