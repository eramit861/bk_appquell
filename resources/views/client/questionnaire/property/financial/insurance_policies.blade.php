<div class="light-gray-div insurance_policies_mutisec insurance_policies_mutisec_{{ $i }} {{ ($i == 0) ? 'mt-2' : '' }}" rowNo="{{ $i }}">
   <div class="light-gray-box-form-area">
      <h2>
         <div class="circle-number-div">{{ $i + 1 }}</div> Account Details
      </h2>

      <a href="javascript:void(0)" class="client-edit-button with-delete " onclick="edit_div_common('insurance_policies_mutisec', {{ $i }})">
         <i class="bi bi-pencil-square mr-1"></i>
         Edit
      </a>
      <button type="button" class="delete-div" title="Delete" onclick="seperate_remove_div_common('insurance_policies_mutisec', {{ $i }})">
         <i class="bi bi-trash3 mr-1"></i>
         Delete
      </button>

		<div class="row gx-3 summary_section {{ isset($isEmpty) && $isEmpty ? 'hide-data' : '' }}">
         <div class="col-md-2">
            <label class="font-weight-bold">
               Type:
               <span class="font-weight-normal">{{ Helper::validate_key_loop_value('account_type', $insurance_policies, $i) }}</span>
            </label>
         </div>
         <div class="col-md-3">
            <label class="font-weight-bold">
               Company name:
               <span class="font-weight-normal">{{ Helper::validate_key_loop_value('type_of_account', $insurance_policies, $i) }}</span>
            </label>
         </div>
         <div class="col-md-3">
            <label class="font-weight-bold">
               Property Value:
               <span class="font-weight-normal">{{ '$ ' . (!empty(Helper::validate_key_loop_value('property_value', $insurance_policies, $i)) ? Helper::validate_key_loop_value('property_value', $insurance_policies, $i) : 0.00) }}</span>
            </label>
         </div>
      </div>

		<div class="row gx-3 edit_section {{ isset($isEmpty) && $isEmpty ? '' : 'hide-data' }}">
         <div class="col-lg-2 col-md-6">
            <div class="label-div">
               <label>Account Type</label>
               <select class="form-control insurance_policies_account_type required" required name="insurance_policies[data][account_type][{{ $i }}]">
                  <option value="">Type</option>
                  <option value="HSA" {{ (Helper::validate_key_loop_value('account_type', $insurance_policies, $i) == 'HSA') ? 'selected' : '' }}>HSA</option>
                  <option value="FSA" {{ (Helper::validate_key_loop_value('account_type', $insurance_policies, $i) == 'FSA') ? 'selected' : '' }}>FSA</option>
               </select>
            </div>
         </div>
         <div class="col-lg-3 col-md-6">
            <div class="label-div">
               <div class="form-group">
                  <label>Company name</label>
                  <input type="text" name="insurance_policies[data][type_of_account][{{ $i }}]" class="form-control input_capitalize required insurance_policies_type_of_account"
                     placeholder="Company name" value="{{ Helper::validate_key_loop_value('type_of_account', $insurance_policies, $i) }}">
               </div>
            </div>
         </div>
         <input type="hidden" name="insurance_policies[data][description][{{ $i }}]" class="form-control required insurance_policies_description" placeholder="Description" value="">
         <div class="col-lg-6 col-md-12">
            <div class="label-div">
               <div class="form-group">
                  <label>Current balance of account</label>
                  <div class="input-group mb-0">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                     </div>
                     <input type="number" name="insurance_policies[data][property_value][{{ $i }}]" class="price-field form-control required insurance_policies_property_value is_insu_unknown_{{ $i }}"
                        placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $insurance_policies, $i) }}">
                  </div>
                  <small class="text-bold text-c-blue font-italic">(If your unsure check the YTD on most <u>Current Last Pay Stub</u>)</small>
               </div>
            </div>
         </div>
         <div class="col-12 text-right my-2">
            <a href="javascript:void(0)" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" data-url="{{ route('property_asset_seperate_save') }}" onclick="seperate_save('insurance_policies','insurance_policies_mutisec', 'insurance_policies_data', 'parent_insurance_policies', {{ $i }})">Save</a>
         </div>
      </div>
   </div>
</div>