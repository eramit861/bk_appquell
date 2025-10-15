<div class="light-gray-div rent_sec_deposit{{ $i }} rent_sec_deposit{{ $i }}_{{ $index }} security_deposits_{{ $i }}_mutisec">
   <div class="light-gray-box-form-area">
      <h2>
         <div class="circle-number-div security_deposit">{{ $index + 1 }}</div>
         Security Deposit Details
         <i class="bi bi-patch-question-fill ms-2" onclick="openPopup('security-deposit')"></i>
      </h2>
      <button type="button" class="delete-div" title="Delete" onclick="remove_div_common('rent_sec_deposit{{ $i }}', {{ $index }})">
         <i class="bi bi-trash3 mr-1"></i>
         Delete
      </button>
      <div class="row gx-3">
         <div class="col-12 col-md-6 col-lg-3">
            <div class="label-div">
               <div class="form-group">
                  <label class="d-block">For</label>
                  <select class="form-control security_deposits_{{ $i }}_type_of_account security_deposits_type_of_account" name="security_deposits[{{ $i }}][data][type_of_account][{{ $index }}]" required>
                     @php
                     $selected = isset($security_deposits['type_of_account']) && isset($security_deposits['type_of_account'][$index]) ? $security_deposits['type_of_account'][$index] : '';
echo ArrayHelper::securityDepositedSelection($selected);
@endphp
                  </select>
               </div>
            </div>
         </div>
         <div class="col-12 col-md-6 col-lg-5">
            <div class="label-div">
               <div class="form-group">
                  <label>Institution and/or landlord name:</label>
                  <input type="text" name="security_deposits[{{ $i }}][data][description][{{ $index }}]" class="input_capitalize form-control required security_deposits_{{ $i }}_description security_deposits_description"
                     placeholder="Institution name or individual" value="{{ Helper::validate_key_loop_value('description', $security_deposits, $index) }}">
               </div>
            </div>
         </div>
         <div class="col-12 col-md-6 col-lg-3">
            <div class="label-div">
               <div class="form-group">
                  <label>Total amount of security deposit</label>
                  <div class="input-group">
                     <span class="input-group-text">$</span>
                     <input type="number" name="security_deposits[{{ $i }}][data][property_value][{{ $index }}]" class="price-field form-control required security_deposits_{{ $i }}_property_value security_deposits_property_value"
                        placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $security_deposits, $index) }}">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>