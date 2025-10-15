<div class="light-gray-div interests_mutisec interests_mutisec_{{ $i }} {{ $i == 0 ? 'mt-2' : '' }}">
   <div class="light-gray-box-form-area">
      <h2>
         <div class="circle-number-div">{{ $i + 1 }}</div> Entity Details
      </h2>
      <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('interests_mutisec', {{ $i }})">
         <i class="bi bi-trash3 mr-1"></i>
         Delete
      </button>
      <div class="row gx-3">
         <div class="col-12 col-sm-12 col-md-7 col-lg-5 col-xxl-6">
            <div class="label-div">
               <div class="form-group">
                  <label>Name of entity
                  </label>
                  <input type="text" name="interests[data][description][{{ $i }}]" class="input_capitalize form-control required interests_description" placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $interests, $i) }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-3 col-xxl-3">
            <div class="label-div">
               <div class="form-group">
                  <label>% of ownership</label>
                  <div class="input-group">
                     <input type="number" name="interests[data][type_of_account][{{ $i }}]" class="allow-3digit form-control required interests_type_of_account" placeholder="Property value" value="{{ Helper::validate_key_loop_value('type_of_account', $interests, $i) }}">
                     <span class="input-group-text percent">%</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Property Value</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input type="number" name="interests[data][property_value][{{ $i }}]" class="price-field form-control required interests_property_value" placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $interests, $i) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>