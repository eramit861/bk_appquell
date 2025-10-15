<div class="light-gray-div other_business_mutisec other_business_mutisec_{{ $i }} {{ $i == 0 ? 'mt-2' : '' }}">
   <div class="light-gray-box-form-area">
      <h2>
         <div class="circle-number-div">{{ $i + 1 }}</div> Asset Details
      </h2>
      <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('other_business_mutisec', {{ $i }})">
         <i class="bi bi-trash3 mr-1"></i>
         Delete
      </button>
      <div class="row gx-3">
         <div class="col-12 col-sm-12 col-md-7 col-lg-8 col-xxl-9">
            <div class="label-div">
               <div class="form-group">
                  <label>Description</label>
                  <textarea rows="3" name="other_business[data][description][{{ $i }}]" class="input_capitalize noadjust form-control required other_business_description h-unset" placeholder="Description">{{ Helper::validate_key_loop_value('description', $other_business, $i) }}</textarea>
               </div>
            </div>
         </div>
         <div class="col-12 col-sm-6 col-md-5 col-lg-4 col-xxl-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Property Value</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input type="number" name="other_business[data][property_value][{{ $i }}]" class="price-field form-control required other_business_property_value" placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $other_business, $i) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>