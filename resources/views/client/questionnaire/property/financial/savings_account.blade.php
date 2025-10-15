<div class="col-md-12 savings_account_mutisec">
	<div class="col-md-8">
            <div class="form-group">
               <label>Description
               </label>
               <input type="text" name="savings_account[data][description][{{ $i }}]" class="form-control required savings_account_description"
                  placeholder="Description" value="{{ Helper::validate_key_loop_value('description', $savings_account, $i) }}">
            </div>
         </div>
	 <div class="col-md-4">
		<div class="form-group">
		   <label>Property Value</label>
		   <div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">$</span>
				 </div>
		   <input type="number" name="savings_account[data][property_value][{{ $i }}]"     class="price-field form-control required savings_account_property_value"
			  placeholder="Property value" value="{{ Helper::validate_key_loop_value('property_value', $savings_account, $i) }}">
			</div>
		</div>
	 </div>
 </div>