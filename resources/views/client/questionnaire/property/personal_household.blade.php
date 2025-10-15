<div class="col-12">
   <p class="text-bold ">
      <span class="text-danger">This section of your bankruptcy information is crucial for two reasons.</span>
      <br>
      <span class="text-danger">#1: listing EVERY piece of property you own accurately ensures that nothing is overlooked, this helps and/or prevents the loss of any of your personal items.</span>
      <br>
      <span class="text-danger">#2: it's important to include even items of little or no value to demonstrate full disclosure to the Court.</span>
   </p>
</div>


@php
$final = [];
if (!empty($propertyhousehold)) {
    foreach ($propertyhousehold as $key => $households) {
        $type_data = json_decode($households['type_data'], 1);
        if (!empty($type_data)) {
            $households['description'] = (!empty($type_data[0])) ? $type_data[0] : "";
            $households['property_value'] = (!empty($type_data[1])) ? $type_data[1] : "";

            $households['owned_by'] = (!empty($type_data['owned_by'])) ? $type_data['owned_by'] : "";
        }
        $households['array_data'] = (!empty($type_data)) ? $type_data : [];
        unset($households['type_data']);
        if (isset($templateData) && !empty($templateData) && $detailed_property == 0) {         
            $households['parent_label'] = $templateData[$households['type']]['parent_label']??'';
            $households['label'] = $templateData[$households['type']]['label']??'';
        }
        $final[$households['type']] = $households;
    }
}
$priceColor = '';
if (isset($templateData) && !empty($templateData) && $detailed_property == 0) {
    if (empty($final)) {
        $priceColor = '#012cae';
        foreach ($templateData as $key => &$value) {
            $type_data = $value['data'];
            if (!empty($type_data)) {
                $value['description'] = (!empty($type_data[0])) ? $type_data[0] : "";
                $value['property_value'] = (!empty($type_data[1])) ? $type_data[1] : "";
            }
            $value['array_data'] = $type_data;
            unset($type_data);
        }
        $final = $templateData;
    }
}

$household_goods = (!empty($final['household_goods_furnishings'])) ? $final['household_goods_furnishings'] : [];

$electronics = (!empty($final['electronics'])) ? $final['electronics'] : [];

$collectibles = (!empty($final['collectibles'])) ? $final['collectibles'] : [];

$sports = (!empty($final['sports'])) ? $final['sports'] : [];

$firearms = (!empty($final['firearms'])) ? $final['firearms'] : [];

$clothing = (!empty($final['clothing'])) ? $final['clothing'] : [];

$jewelry = (!empty($final['jewelry'])) ? $final['jewelry'] : [];

$pets = (!empty($final['pets'])) ? $final['pets'] : [];

$health_aids = (!empty($final['health_aids'])) ? $final['health_aids'] : [];

$readOnly = ($detailed_property == 1) ? "readonly" : "";

$detailed_tab_items_popup_route = (isset($attorney_edit) && $attorney_edit == true) ? route('detailed_tab_items_popup_att_edit') : route('detailed_tab_items_popup');

$parent_label_household_goods = Helper::validate_key_value('parent_label', $household_goods);
$parent_label_household_goods = empty($parent_label_household_goods) ? "Do you own or possess any household goods and/or furnishings?" : $parent_label_household_goods;
// dd($parent_label_household_goods, $household_goods);

$parent_label_electronics = Helper::validate_key_value('parent_label', $electronics);
$parent_label_electronics = empty($parent_label_electronics) ? "Do you own or possess any electronics?" : $parent_label_electronics;

$parent_label_collectibles = Helper::validate_key_value('parent_label', $collectibles);
$parent_label_collectibles = empty($parent_label_collectibles) ? "Do you own or possess any Collectibles?" : $parent_label_collectibles;

$parent_label_sports = Helper::validate_key_value('parent_label', $sports);
$parent_label_sports = empty($parent_label_sports) ? "Do you own or possess any Equipment for sports and hobbies?" : $parent_label_sports;

$parent_label_firearms = Helper::validate_key_value('parent_label', $firearms);
$parent_label_firearms = empty($parent_label_firearms) ? "Do you own or possess any Firearms, ammunition, and related equipment?" : $parent_label_firearms;

$parent_label_clothing = Helper::validate_key_value('parent_label', $clothing);
$parent_label_clothing = empty($parent_label_clothing) ? "Do you own or possess any Clothing?" : $parent_label_clothing;

$parent_label_jewelry = Helper::validate_key_value('parent_label', $jewelry);
$parent_label_jewelry = empty($parent_label_jewelry) ? "Do you own or possess any Jewelry?" : $parent_label_jewelry;

$parent_label_pets = Helper::validate_key_value('parent_label', $pets);
$parent_label_pets = empty($parent_label_pets) ? "Do you own or possess any Non-farm animals?" : $parent_label_pets;

$parent_label_health_aids = Helper::validate_key_value('parent_label', $health_aids);
$parent_label_health_aids = empty($parent_label_health_aids) ? "Do you own or possess any other personal and/or household items you haven't already listed above?" : $parent_label_health_aids;


@endphp

<!-- Household Goods & Furnishings -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_household_goods }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="household_goods_furnishings[type]" value="household_goods_furnishings">
         <input type="hidden" name="household_goods_furnishings[id]" value="{{ Helper::validate_key_value('id', $household_goods) }}">

         <input type="radio" id="household_items_yes" class="d-none" name="household_goods_furnishings[type_value]" required {{ Helper::validate_key_toggle('type_value', $household_goods, 1) }} value="1">
         <label for="household_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $household_goods, 1) }}" onclick="getHouseHoldItems('yes');">Yes</label>

         <input type="radio" id="household_items_no" class="d-none" name="household_goods_furnishings[type_value]" required {{ Helper::validate_key_toggle('type_value', $household_goods, 0) }} value="0">
         <label for="household_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $household_goods, 0) }}" onclick="getHouseHoldItems('no'); openFlagPopup('household-goods-furnishings-popup','',true,{{ $attorney_edit }});">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: major appliances, refrigerator, stove, washer, dryer, furniture, sofas, tables, chairs, beds, linens, bedding, towels, curtains, lamps, kitchenware, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $household_goods) }}" id="household_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Household Goods & Furnishings</h2>
      <div class="row gx-3">
         <div class="col-12">
            @if ($detailed_property == 1)
               <div class="mb-2">
                  <h6 class="blink text-danger"><strong>Click below button to choose Household Goods & Furnishings</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'household_goods_furnishings', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Household Goods & Furnishings</a>
               </div>
            @endif
            @php
            $label = Helper::validate_key_value('label', $household_goods);
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         @php
         $array = !empty($household_goods["array_data"]) ? $household_goods["array_data"] : [];
         $decription = $household_goods["array_data"][0] ?? '';
         $decriptionValue = $household_goods["array_data"][1] ?? '';
         @endphp
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_household_goods_furnishings' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="household_goods_furnishings[data][0]" class="form-control required detailed_tab_items_household_goods_furnishings"
                     placeholder="Description" value="{{ $decription }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_household_goods_furnishings' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="household_goods_furnishings[data][1]" class="form-control  price-field required detailed_tab_items_household_goods_furnishings_value"
                        placeholder="Property value" value="{{ $decriptionValue }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Electronics -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_electronics }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="electronics[type]" value="electronics">
         <input type="hidden" name="electronics[id]" value="{{ Helper::validate_key_value('id', $electronics) }}">

         <input type="radio" id="electronics_items_yes" class="d-none" name="electronics[type_value]" required {{ Helper::validate_key_toggle('type_value', $electronics, 1) }} value="1">
         <label for="electronics_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $electronics, 1) }}" onclick="getHouseElectronicsItems('yes');">Yes</label>

         <input type="radio" id="electronics_items_no" class="d-none" name="electronics[type_value]" required {{ Helper::validate_key_toggle('type_value', $electronics, 0) }} value="0">
         <label for="electronics_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $electronics, 0) }}" onclick="getHouseElectronicsItems('no'); openFlagPopup('electronics-popup','',true,{{ $attorney_edit }});">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: televisions, desktops & laptop computers, tablets, printers/scanners, video game consoles, DVD players, stereo systems, speakers, home theater equipment, cameras, mobile phones, smartphones, home office equipment, fax machines, copiers, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $electronics) }}" id="electronics_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Electronics</h2>
      <div class="row gx-3">
         <div class="col-12">

            @if ($detailed_property == 1)
               <div class="mb-2">
                  <h6 class="blink text-danger font-weeight-bold"><strong>Click below button to choose Electronics</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'electronics', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Electronics</a>
               </div>
            @endif
@php
   $label = Helper::validate_key_value('label', $electronics);
@endphp
@if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
@else
               <x-businessline></x-businessline>
@endif
         </div>
         @php
         $decription = $electronics["array_data"][0] ?? '';
         $decriptionValue = $electronics["array_data"][1] ?? '';
         @endphp
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_electronics' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="electronics[data][0]" class="form-control required detailed_tab_items_electronics" placeholder="Description" value="{{ $decription }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_electronics' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="electronics[data][1]" class="form-control price-field required detailed_tab_items_electronics_value" placeholder="Property value" value="{{ $decriptionValue }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Collectibles -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_collectibles }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="collectibles[type]" value="collectibles">
         <input type="hidden" name="collectibles[id]" value="{{ Helper::validate_key_value('id', $collectibles) }}">

         <input type="radio" id="collectibles_items_yes" class="d-none" name="collectibles[type_value]" required {{ Helper::validate_key_toggle('type_value', $collectibles, 1) }} value="1">
         <label for="collectibles_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $collectibles, 1) }}" onclick="getHouseCollectiblesItems('yes');">Yes</label>

         <input type="radio" id="collectibles_items_no" class="d-none" name="collectibles[type_value]" required {{ Helper::validate_key_toggle('type_value', $collectibles, 0) }} value="0">
         <label for="collectibles_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $collectibles, 0) }}" onclick="getHouseCollectiblesItems('no');">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: artwork, figurines, paintings, antiques, sculptures, books, other art objects, stamps, coins, sports card collections, memorabilia, collectibles, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $collectibles) }}" id="Collectibles_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Collectibles</h2>
      <div class="row gx-3">
         <div class="col-12">
            @if ($detailed_property == 1)
               <div class="mb-2">
                  <h6 class="blink text-danger font-weeight-bold"><strong>Click below button to choose Collectibles</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'collectibles', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Collectibles</a>
               </div>
            @endif
@php
   $label = Helper::validate_key_value('label', $collectibles);
   $label = !empty($label) ? $label : 'Only list items worth over $500!!!';
@endphp
@if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
@else
               <x-businessline></x-businessline>
@endif
         </div>
         @php
         $decription = $collectibles["array_data"][0] ?? '';
         $decriptionValue = $collectibles["array_data"][1] ?? '';
         @endphp
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_collectibles' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="collectibles[data][0]" class="input_capitalize form-control detailed_tab_items_collectibles required" placeholder="Description" value="{{ $decription }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_collectibles' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="collectibles[data][1]" class="form-control  price-field detailed_tab_items_collectibles_value required" placeholder="Property value" value="{{ $decriptionValue }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Sports Equipment -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_sports }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="sports[type]" value="sports">
         <input type="hidden" name="sports[id]" value="{{ Helper::validate_key_value('id', $sports) }}">

         <input type="radio" id="sports_items_yes" class="d-none" name="sports[type_value]" required {{ Helper::validate_key_toggle('type_value', $sports, 1) }} value="1">
         <label for="sports_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $sports, 1) }}" onclick="getHouseSportsItems('yes');">Yes</label>

         <input type="radio" id="sports_items_no" class="d-none" name="sports[type_value]" required {{ Helper::validate_key_toggle('type_value', $sports, 0) }} value="0">
         <label for="sports_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $sports, 0) }}" onclick="getHouseSportsItems('no');">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: sports, photography, exercise, hobby equipment, bicycles, pool tables, golf clubs, skis, canoes, kayaks, carpentry tools, musical instruments, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $sports) }}" id="sports_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Sports Equipment</h2>
      <div class="row gx-3">
         <div class="col-12">
            @if ($detailed_property == 1)
               <div class="mb-2">
               <h6 class="blink text-danger font-weeight-bold"><strong>Click below button to choose Sports Equipment</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'sports', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Sports Equipment</a>
               </div>
            @endif
            @php
               $label = Helper::validate_key_value('label', $sports);
               $label = !empty($label) ? $label : 'Only list items worth over $500!!!';
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         @php
         $decription = $sports["array_data"][0] ?? '';
         $decriptionValue = $sports["array_data"][1] ?? '';
         @endphp
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_sports' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="sports[data][0]" class="input_capitalize form-control detailed_tab_items_sports required" placeholder="Description" value="{{ $decription }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_sports' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="sports[data][1]" class="form-control  detailed_tab_items_sports_value price-field required" placeholder="Property value" value="{{ $decriptionValue }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Firearms -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_firearms }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="firearms[type]" value="firearms">
         <input type="hidden" name="firearms[id]" value="{{ Helper::validate_key_value('id', $firearms) }}">

         <input type="radio" id="firearms_items_yes" class="d-none" name="firearms[type_value]" required {{ Helper::validate_key_toggle('type_value', $firearms, 1) }} value="1">
         <label for="firearms_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $firearms, 1) }}" onclick="getHouseFirearmsItems('yes');">Yes</label>

         <input type="radio" id="firearms_items_no" class="d-none" name="firearms[type_value]" required {{ Helper::validate_key_toggle('type_value', $firearms, 0) }} value="0">
         <label for="firearms_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $firearms, 0) }}" onclick="getHouseFirearmsItems('no');">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: pistols, rifles, shotguns, ammunition, and related equipment, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $firearms) }}" id="firearms_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Firearms</h2>
      <div class="row gx-3">
         <div class="col-12">
            @if ($detailed_property == 1)
               <div class="mb-2">
                  <h6 class="blink text-danger font-weeight-bold"><strong>Click below button to choose Firearms</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'firearms', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Firearms</a>
               </div>
            @endif
            @php
               $label = Helper::validate_key_value('label', $firearms);
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         @php
            $decription = $firearms["array_data"][0] ?? '';
            $decriptionValue = $firearms["array_data"][1] ?? '';
         @endphp
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_firearms' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="firearms[data][0]" class="input_capitalize detailed_tab_items_firearms form-control required" placeholder="Description" value="{{ Helper::validate_key_value('description', $firearms) }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_firearms' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="firearms[data][1]" class="form-control  detailed_tab_items_firearms_value price-field required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $firearms) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Everyday Clothing -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_clothing }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="clothing[type]" value="clothing">
         <input type="hidden" name="clothing[id]" value="{{ Helper::validate_key_value('id', $clothing) }}">

         <input type="radio" id="clothing_items_yes" class="d-none" name="clothing[type_value]" required {{ Helper::validate_key_toggle('type_value', $clothing, 1) }} value="1">
         <label for="clothing_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $clothing, 1) }}" onclick="getHouseClothingItems('yes');">Yes</label>

         <input type="radio" id="clothing_items_no" class="d-none" name="clothing[type_value]" required {{ Helper::validate_key_toggle('type_value', $clothing, 0) }} value="0">
         <label for="clothing_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $clothing, 0) }}" onclick="getHouseClothingItems('no'); openFlagPopup('clothing-popup','',true,{{ $attorney_edit }});">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: everyday clothing, furs, coats, designer wear, shoes, designer handbags, accessories, underwear, formal wear, work uniforms, scrubs for healthcare workers, safety gear for construction workers, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $clothing) }}" id="clothing_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Everyday Clothing</h2>
      <div class="row gx-3">
         <div class="col-12">
            @if ($detailed_property == 1)
               <div class="mb-2">
                  <h6 class="blink text-danger font-weeight-bold"><strong>Click below button to choose Everyday Clothing</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'everydayclothing', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Everyday Clothing</a>
               </div>
            @endif
            @php
               $label = Helper::validate_key_value('label', $clothing);
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         @php
            $decription = $clothing["array_data"][0] ?? '';
            $decriptionValue = $clothing["array_data"][1] ?? '';
         @endphp

         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_everydayclothing' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="clothing[data][0]" class="input_capitalize input_capitalize form-control detailed_tab_items_everydayclothing required" placeholder="Description" value="{{ Helper::validate_key_value('description', $clothing) }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_everydayclothing' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="clothing[data][1]" class="form-control detailed_tab_items_everydayclothing_value price-field required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $clothing) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Everyday Jewelry -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_jewelry }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="jewelry[type]" value="jewelry">
         <input type="hidden" name="jewelry[id]" value="{{ Helper::validate_key_value('id', $jewelry) }}">

         <input type="radio" id="jewelry_items_yes" class="d-none" name="jewelry[type_value]" required {{ Helper::validate_key_toggle('type_value', $jewelry, 1) }} value="1">
         <label for="jewelry_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $jewelry, 1) }}" onclick="getHouseJewelryItems('yes');">Yes</label>

         <input type="radio" id="jewelry_items_no" class="d-none" name="jewelry[type_value]" required {{ Helper::validate_key_toggle('type_value', $jewelry, 0) }} value="0">
         <label for="jewelry_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $jewelry, 0) }}" onclick="getHouseJewelryItems('no'); openFlagPopup('jewelry-popup','',true,{{ $attorney_edit }});">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: everyday jewelry, costume jewelry, engagement rings, wedding rings, heirloom jewelry, watches, gems, gold, silver, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $jewelry) }}" id="jewelry_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Everyday and Fine Jewelry</h2>
      <div class="row gx-3">
         <div class="col-12">
            @if ($detailed_property == 1)
               <div class="mb-2">
               <h6 class="blink text-danger font-weeight-bold"><strong>Click below button to choose Everyday and Fine Jewelry</strong> <i class="fa fa-arrow-down"></i></h6>
                  <a href="javascript:void(0)" class="open-utility-btn px-2 py-1 {{ @$web_view ? 'w-auto text-center' : '' }}" onclick="emptySelectedItems(); openDetailedTabItemsForm('{{ $detailed_tab_items_popup_route }}', 'everydayfinejqwl', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }}); ">Select Everyday and Fine Jewelry</a>
               </div>
            @endif
            @php
               $label = Helper::validate_key_value('label', $jewelry);
               $label = !empty($label) ? $label : 'Only list items worth over $500!!! This includes engagement and wedding bands!!!';
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         @php
         $decription = $jewelry["array_data"][0] ?? '';
         $decriptionValue = $jewelry["array_data"][1] ?? '';
         @endphp
         
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_everydayfinejqwl' : '' }}">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input {{ $readOnly }} type="text" name="jewelry[data][0]" class="input_capitalize form-control detailed_tab_items_everydayfinejqwl required" placeholder="Description" value="{{ $decription }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3 {{ ($detailed_property == 1 && empty($decription)) ? 'hide-data check_empty_everydayfinejqwl' : '' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input {{ $readOnly }} style="color: {{ $priceColor }}" type="number" name="jewelry[data][1]" class="form-control  detailed_tab_items_everydayfinejqwl_value price-field required" placeholder="Property value" value="{{ $decriptionValue }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Non-farm animals -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_pets }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="pets[type]" value="pets">
         <input type="hidden" name="pets[id]" value="{{ Helper::validate_key_value('id', $pets) }}">

         <input type="radio" id="non_farm_animals_items_yes" class="d-none" name="pets[type_value]" required {{ Helper::validate_key_toggle('type_value', $pets, 1) }} value="1">
         <label for="non_farm_animals_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $pets, 1) }}" onclick="getHouseNonFarmAnimalsItems('yes');">Yes</label>

         <input type="radio" id="non_farm_animals_items_no" class="d-none" name="pets[type_value]" required {{ Helper::validate_key_toggle('type_value', $pets, 0) }} value="0">
         <label for="non_farm_animals_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $pets, 0) }}" onclick="getHouseNonFarmAnimalsItems('no');">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(These include: dogs, cats, birds, horses, pets of any kind, etc.)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $pets) }}" id="non_farm_animals_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Non-Farm Animals</h2>

      <div class="row gx-3">
         <div class="col-12">
            @php
               $label = Helper::validate_key_value('label', $pets);
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input type="text" name="pets[data][0]" class="input_capitalize input_capitalize form-control required" placeholder="Description" value="{{ Helper::validate_key_value('description', $pets) }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input style="color: {{ $priceColor }}" type="number" name="pets[data][1]" class="form-control  price-field required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $pets) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>


<!-- Other Personal and/or Household Items -->
<div class="col-12 light-gray-div b-0-i py-0 mb-0 {{ !@$web_view ? 'form-main' : '' }}">
   <div class="label-div question-area">
      <label>{{ $parent_label_health_aids }}</label>
      <!-- Radio Buttons -->
      <div class="custom-radio-group form-group">
         <input type="hidden" name="health_aids[type]" value="health_aids">
         <input type="hidden" name="health_aids[id]" value="{{ Helper::validate_key_value('id', $health_aids) }}">

         <input type="radio" id="health_aids_items_yes" class="d-none" name="health_aids[type_value]" required {{ Helper::validate_key_toggle('type_value', $health_aids, 1) }} value="1">
         <label for="health_aids_items_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $health_aids, 1) }}" onclick="getHouseHEathAidItems('yes');">Yes</label>

         <input type="radio" id="health_aids_items_no" class="d-none" name="health_aids[type_value]" required {{ Helper::validate_key_toggle('type_value', $health_aids, 0) }} value="0">
         <label for="health_aids_items_no" class="btn-toggle {{ Helper::validate_key_toggle_active('type_value', $health_aids, 0) }}" onclick="getHouseHEathAidItems('no');">No</label>
      </div>
      <!-- Example Label -->
      <p class="text-bold mb-0">
         <span class="text-c-blue">(Including any health aids)</span>
      </p>
   </div>
</div>
<!-- Condition data -->
<div class="col-12  {{ !@$web_view ? 'form-main' : '' }} {{ Helper::key_hide_show_v('type_value', $health_aids) }}" id="health_aids_items_data">
   <div class="light-gray-div mt-2 mb-3">
      <h2>Other Personal and/or Household Items </h2>

      <div class="row gx-3">
         <div class="col-12">
            @php
               $label = Helper::validate_key_value('label', $health_aids);
            @endphp
            @if ($label)
               <p class="text-bold mb-2">
                  <small class="blink text-danger text-bold mb-0">{{ $label }} <i class="fa fa-arrow-down"></i></small>
               </p>
            @else
               <x-businessline></x-businessline>
            @endif
         </div>
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
            <div class="label-div">
               <div class="form-group ">
                  <label>Description</label>
                  <input type="text" name="health_aids[data][0]" class="input_capitalize form-control required" placeholder="Description" value="{{ Helper::validate_key_value('description', $health_aids) }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Property value of everything listed:</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input style="color: {{ $priceColor }}" type="number" name="health_aids[data][1]" class="form-control  price-field required" placeholder="Property value" value="{{ Helper::validate_key_value('property_value', $health_aids) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="hide-data household-goods-furnishings-popup">
   <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Its not normal not to have a Bed, linens, kitchenware, table, chairs or a place to sit. &#x1F914;</p>
   <p>Are you sure you don't have this?</p>
</div>
<div class="hide-data electronics-popup">
   <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Its not normal not to have any electronics. You don't have a cell phone, tablet or computer? &#x1F914;</p>
   <p>Are you sure you don't have this?</p>
</div>
<div class="hide-data clothing-popup">
   <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Its not normal not to have any clothing. You don't have any clothing? This is embarrasing....... &#x1FAE3; &#x1F633;</p>
   <p>Are you sure your not clothed right now?</p>
</div>
<div class="hide-data jewelry-popup">
   <p><i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i> Most people have some type of jewelry even if its not valuable like costume jewelry. &#x1F914;</p>
   <p>Are you sure you don't have this?</p>
</div>