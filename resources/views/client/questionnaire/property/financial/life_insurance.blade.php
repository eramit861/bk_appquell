<div class="light-gray-div life_insurance_mutisec life_insurance_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}" rowNo="{{ $i }}">
   <div class="light-gray-box-form-area">
      <h2>
         <div class="circle-number-div">{{ $i + 1 }}</div> Insurance Details
      </h2>

      <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('life_insurance_mutisec', {{ $i }})">
         <i class="bi bi-pencil-square mr-1"></i>
         Edit
      </a>
      <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('life_insurance_mutisec', {{ $i }})">
         <i class="bi bi-trash3 mr-1"></i>
         Delete
      </button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
         <div class="col-md-3">
            <label class="font-weight-bold">
               Company Name:
               <span class="font-weight-normal">{{ Helper::validate_key_loop_value('type_of_account', $life_insurance, $i) }}</span>
            </label>
         </div>
         <div class="col-md-3">
            <label class="font-weight-bold">
               Insurance Type:
               <span class="font-weight-normal">
                  {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Term') ? 'Term Life Insurance' : '' }}
                  {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Whole') ? 'Whole Life Insurance' : '' }}
                  {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Universal') ? 'Universal Life Insurance' : '' }}
                  {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Renters') ? 'Renters Insurance' : '' }}
                  {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Disability') ? 'Disability Insurance' : '' }}
               </span>
            </label>
         </div>
         <div class="col-md-3 {{ !in_array(Helper::validate_key_loop_value('account_type', $life_insurance, $i), ['Renters', 'Disability']) ? '' : 'hide-data' }} ">
            <label class="font-weight-bold">
            Beneficiary:
               <span class="font-weight-normal">{{ Helper::validate_key_loop_value('description', $life_insurance, $i) }}</span>
            </label>
         </div>
         <div class="col-md-3 {{ in_array(Helper::validate_key_loop_value('account_type', $life_insurance, $i), ['Whole', 'Universal']) ? '' : 'hide-data' }}">
            <label class="font-weight-bold">
               Cash/Surrender Value:
               <span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('current_value', $life_insurance, $i)) ? Helper::validate_key_loop_value('current_value', $life_insurance, $i) : 0.00) }}</span>
            </label>
         </div>
         <div class="col-md-3 {{ in_array(Helper::validate_key_loop_value('account_type', $life_insurance, $i), ['Renters', 'Disability']) ? '' : 'hide-data' }}">
            <label class="font-weight-bold">
               {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Renters') ? 'Refund Value' : 'Total Value of policy' }}:
					<span class="font-weight-normal">{{ (Helper::validate_key_loop_value('unknown', $life_insurance, $i) == 1) ? 'Unknown' : '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $life_insurance, $i)) ? Helper::validate_key_loop_value('property_value', $life_insurance, $i) : 0.00) }}</span>
            </label>
         </div>
      </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
         <div class="col-md-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Company name</label>
                  <input type="text" name="life_insurance[data][type_of_account][{{ $i }}]" class="input_capitalize form-control required life_insurance_type_of_account"
                     placeholder="Company name" value="{{ Helper::validate_key_loop_value('type_of_account', $life_insurance, $i) }}">
               </div>
            </div>
         </div>
         <div class="col-lg-2 col-md-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Insurance Type</label>
                  <select class="form-control life_insurance_account_type required" required name="life_insurance[data][account_type][{{ $i }}]"
                     onchange="openUnknownFlagPopup(this, {{ $attorney_edit }});">
                     <option value="">Type</option>
                     <option value="Term" {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Term') ? 'selected' : '' }}>Term Life Insurance</option>
                     <option value="Whole" {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Whole') ? 'selected' : '' }}>Whole Life Insurance</option>
                     <option value="Universal" {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Universal') ? 'selected' : '' }}>Universal Life Insurance</option>
                     <option value="Renters" {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Renters') ? 'selected' : '' }}>Renters Insurance</option>
                     <option value="Disability" {{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Disability') ? 'selected' : '' }}>Disability Insurance</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-md-3 beneficiary_div {{ !in_array(Helper::validate_key_loop_value('account_type', $life_insurance, $i), ['Renters', 'Disability']) ? '' : 'hide-data' }}">
            <div class="label-div">
               <div class="form-group">
                  <label>Beneficiary</label>
                  <input type="text" name="life_insurance[data][description][{{ $i }}]" class="input_capitalize form-control required life_insurance_description"
                     placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $life_insurance, $i) }}">
               </div>
            </div>
         </div>
         <div class="col-md-2 {{ in_array(Helper::validate_key_loop_value('account_type', $life_insurance, $i), ['Whole', 'Universal']) ? '' : 'hide-data' }} cash_current_value">
            <div class="label-div">
               <div class="form-group">
                  <label>Cash/Surrender Value</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                     </div>
                     <input type="number" name="life_insurance[data][current_value][{{ $i }}]" class="price-field form-control required life_insurance_current_value"
                        placeholder="Current value" value="{{ Helper::validate_key_loop_value('current_value', $life_insurance, $i) }}">
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3 total_term_div {{ in_array(Helper::validate_key_loop_value('account_type', $life_insurance, $i), ['Renters', 'Disability']) ? '' : 'hide-data' }}">
            <div class="label-div">
               <div class="form-group">
                  <div class="form-check mb-0 px-0">
                     <label class="mb-0 form-check-label ">
                        <span class="me-4 total-span-section">{{ (Helper::validate_key_loop_value('account_type', $life_insurance, $i) == 'Renters') ? 'Refund Value' : 'Total Value of policy' }}</span>
                        <input type="checkbox" onchange="checkUnknown(this, {{ $i }},'life_insu')" value="1" class="unknown life_insurance_unknown form-check-input" name="life_insurance[data][unknown][{{ $i }}]" {{ (Helper::validate_key_loop_value('unknown', $life_insurance, $i) == 1) ? 'checked=checked' : '' }}>
                        <span class="">Unknown</span>
                     </label>
                  </div>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                     </div>
                     <input type="number" name="life_insurance[data][property_value][{{ $i }}]" class="price-field form-control {{ (Helper::validate_key_loop_value('unknown', $life_insurance, $i) == 1) ? '' : 'required' }} life_insurance_property_value is_life_insu_unknown_{{ $i }}"
                        placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $life_insurance, $i) }}"
                        {{ (Helper::validate_key_loop_value('unknown', $life_insurance, $i) == 1) ? 'disabled=true' : '' }}>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 text-right my-2">
            <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('life_insurance','life_insurance_mutisec', 'life_insurance_data', 'parent_life_insurance', {{ $i }})">Save</a>
         </div>
      </div>
   </div>
</div>