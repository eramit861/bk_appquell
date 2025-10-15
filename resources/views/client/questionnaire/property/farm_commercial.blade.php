@php
$final = [];
if (!empty($farmcommercial)) {
    foreach ($farmcommercial as $farm) {
        $fr_type_data = json_decode($farm['type_data'], 1);
        if (!empty($fr_type_data)) {
            $farm['description'] = $fr_type_data['description'] ?? '';
            $farm['property_value'] = $fr_type_data['property_value'] ?? '';
            $farm['owned_by'] = $fr_type_data['owned_by'] ?? '';
        }
        unset($farm['type_data']);
        $final[$farm['type']] = $farm;
    }
}

$farm_animals = $final['farm_animals'] ?? [];
$crops = $final['crops'] ?? [];
$fishing_equipment = $final['fishing_equipment'] ?? [];
$fishing_supplies = $final['fishing_supplies'] ?? [];
$fishing_property = $final['fishing_property'] ?? [];
@endphp


<!-- Farm animals -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Farm animals
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Livestock, poultry, farm-raised fish, or other animals used for farming or commercial purposes.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="farm_animals[id]" value="{{ Helper::validate_key_value('id', $farm_animals) }}">
         <input type="hidden" name="farm_animals[type]" value="farm_animals">

         <input type="radio" id="farm_animals_items_yes" class="d-none" name="farm_animals[type_value]" required {{ Helper::validate_key_toggle('type_value', $farm_animals, 1) }} value="1">
         <label for="farm_animals_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $farm_animals, 1) }}" onclick="getFarmAnimalsItems('yes');">Yes</label>

         <input type="radio" id="farm_animals_items_no" class="d-none" name="farm_animals[type_value]" required {{ Helper::validate_key_toggle('type_value', $farm_animals, 0) }} value="0">
         <label for="farm_animals_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $farm_animals, 0) }}" onclick="getFarmAnimalsItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $farm_animals) }}" id="farm_animals_data">
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
                        <textarea rows="3" name="farm_animals[data][description]" class="input_capitalize form-control noadjust required h-unset" placeholder="Description"> {{ Helper::validate_key_value('description', $farm_animals) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="farm_animals[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $farm_animals) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Crops -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Crops
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Planted or harvested crops intended for sale or personal use.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="crops[id]" value="{{ Helper::validate_key_value('id', $crops) }}">
         <input type="hidden" name="crops[type]" value="crops">

         <input type="radio" id="crops_yes" class="d-none" name="crops[type_value]" required {{ Helper::validate_key_toggle('type_value', $crops, 1) }} value="1">
         <label for="crops_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $crops, 1) }}" onclick="getCropsItems('yes');">Yes</label>

         <input type="radio" id="crops_no" class="d-none" name="crops[type_value]" required {{ Helper::validate_key_toggle('type_value', $crops, 0) }} value="0">
         <label for="crops_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $crops, 0) }}" onclick="getCropsItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $crops) }}" id="crops_data">
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
                        <textarea name="crops[data][description]" rows="3" class="input_capitalize noadjust form-control required h-unset" placeholder="Description">{{ Helper::validate_key_value('description', $crops) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="crops[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $crops) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Farm and commercial fishing equipment, implements, machinery, fixtures, and tools of trade -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Farm and commercial fishing equipment, implements, machinery, fixtures, and tools of trade
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Implements, machinery, fixtures, and tools essential for farming or commercial fishing.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="fishing_equipment[id]" value="{{ Helper::validate_key_value('id', $fishing_equipment) }}">
         <input type="hidden" name="fishing_equipment[type]" value="fishing_equipment">

         <input type="radio" id="fishing_equipment_yes" class="d-none" name="fishing_equipment[type_value]" required {{ Helper::validate_key_toggle('type_value', $fishing_equipment, 1) }} value="1">
         <label for="fishing_equipment_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $fishing_equipment, 1) }}" onclick="getCommercialFishingEquipmentItems('yes');">Yes</label>

         <input type="radio" id="fishing_equipment_no" class="d-none" name="fishing_equipment[type_value]" required {{ Helper::validate_key_toggle('type_value', $fishing_equipment, 0) }} value="0">
         <label for="fishing_equipment_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $fishing_equipment, 0) }}" onclick="getCommercialFishingEquipmentItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $fishing_equipment) }}" id="commercial_fishing_equipment_data">
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
                        <textarea rows="3" name="fishing_equipment[data][description]" class="input_capitalize form-control noadjust required h-unset" placeholder="Description">{{ Helper::validate_key_value('description', $fishing_equipment) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="fishing_equipment[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $fishing_equipment) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Farm and commercial fishing supplies, chemicals, and feed -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Farm and commercial fishing supplies, chemicals, and feed
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Materials like fertilizers, pesticides, animal feed, and other necessary supplies.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="fishing_supplies[id]" value="{{ Helper::validate_key_value('id', $fishing_supplies) }}">
         <input type="hidden" name="fishing_supplies[type]" value="fishing_supplies">

         <input type="radio" id="fishing_supplies_yes" class="d-none" name="fishing_supplies[type_value]" required {{ Helper::validate_key_toggle('type_value', $fishing_supplies, 1) }} value="1">
         <label for="fishing_supplies_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $fishing_supplies, 1) }}" onclick="getCommercialFishingItems('yes');">Yes</label>

         <input type="radio" id="fishing_supplies_no" class="d-none" name="fishing_supplies[type_value]" required {{ Helper::validate_key_toggle('type_value', $fishing_supplies, 0) }} value="0">
         <label for="fishing_supplies_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $fishing_supplies, 0) }}" onclick="getCommercialFishingItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $fishing_supplies) }}" id="commercial_fishing_supplies_data">
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
                        <textarea rows="3" name="fishing_supplies[data][description]" class="input_capitalize noadjust form-control required h-unset" placeholder="Description">{{ Helper::validate_key_value('description', $fishing_supplies) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="fishing_supplies[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $fishing_supplies) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--  Any Farm and commercial fishing-related property you did not already list  -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>
         Any Farm and commercial fishing-related property you did not already list 
         <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Any additional assets related to farming or commercial fishing not listed above.">
            <i class="bi bi-question-circle"></i>
         </div>
      </label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="fishing_property[id]" value="{{ Helper::validate_key_value('id', $fishing_property) }}">
         <input type="hidden" name="fishing_property[type]" value="fishing_property">

         <input type="radio" id="fishing_property_yes" class="d-none" name="fishing_property[type_value]" required {{ Helper::validate_key_toggle('type_value', $fishing_property, 1) }} value="1">
         <label for="fishing_property_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $fishing_property, 1) }}" onclick="getCommercialFishingPropertyItems('yes');">Yes</label>

         <input type="radio" id="fishing_property_no" class="d-none" name="fishing_property[type_value]" required {{ Helper::validate_key_toggle('type_value', $fishing_property, 0) }} value="0">
         <label for="fishing_property_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $fishing_property, 0) }}" onclick="getCommercialFishingPropertyItems('no');">No</label>
      </div>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $fishing_property) }}" id="commercial_fishing_property_data">
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
                        <textarea rows="3" name="fishing_property[data][description]" class="input_capitalize noadjust form-control required" placeholder="Description">{{ Helper::validate_key_value('description', $fishing_property) }}</textarea>
                     </div>
                  </div>
               </div>
               <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
                  <div class="label-div">
                     <div class="form-group">
                        <label>Property Value</label>
                        <div class="input-group">
                           <span class="input-group-text">$</span>
                           <input type="number" name="fishing_property[data][property_value]" class="price-field form-control required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $fishing_property) }}">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>