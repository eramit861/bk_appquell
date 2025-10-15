<div class="row">
	@if (!isset($i) || $i == 0)
		<div class="col-12 important-r">
			<div class="label-div">
				<p class="text-bold mb-0">
					<span class="text-c-blue">IMPORTANT: It is important that you list any and <span class="text-decoration-underline">ALL property</span> you may own or possess in this section <span class="text-decoration-underline">even if your not including</span> it into your bankruptcy case</span>
				</p>
			</div>
		</div>
	@endif

	<!-- Residence Information -->
	@include('client.questionnaire.property.common.residence_information')

	<div class="col-12 light-gray-div b-0-i py-0 mb-0 poperty-type-div-{{ $i }} {{ empty($resident) ? ' hide-data ' : ' ' }}">
		<!-- Property Information -->
		@include('client.questionnaire.property.common.property_information')

		<!-- Mortgages and/or Loans Information -->
		<div class="property_mortgage_section {{ (Helper::validate_key_value('loan_own_type_property', $resident, 'radio') === 0 || Helper::validate_key_value('loan_own_type_property', $resident, 'radio') === 1) ? '' : 'hide-data' }}">
			<div class="laon_property_obj_data loan-div-{{ $i }} {{ empty($resident) ? ' hide-data ' : ' ' }}">

				<p class="m-0 blink text-c-blue text-bold">Please fill out your mortgage information if you have a mortgage.</p>
				<div class="w-100 mt-2">
					<strong class="subtitle">Mortgages and/or Loans Information</strong>
				</div>

				<div class="label-div question-area">
					<p class="text-bold mb-0 ">
						<span class="text-danger">It’s important to list your mortgages and/or loans on the property to accurately reflect your equity. Failing to do so could make it appear that you have more equity than you actually do, which may put the property at risk of being sold during the bankruptcy process.</span>
					</p>

					<label class="fs-13px">
						Do you have any <span class="text-c-blue">mortgages</span> or <span class="text-c-blue">loans</span> on property listed above?
						<div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Do you have any mortgages or loans on property listed above.">
							<i class="bi bi-question-circle"></i>
						</div>
					</label>
					<!-- Radio Buttons -->
					<div class="custom-radio-group form-group mb-0">
						<input type="radio" id="loan_own_type_property_yes_{{ $i }}" class="d-none loan_own_type_property" name="property_resident[loan_own_type_property][{{ $i }}]" required {{ Helper::validate_key_toggle('loan_own_type_property', $resident, 1) }} value="1">
						<label for="loan_own_type_property_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('loan_own_type_property', $resident, 1) }}" onclick="showHidePropertyLoan('yes',this);">Yes</label>

						<input type="radio" id="loan_own_type_property_no_{{ $i }}" class="d-none loan_own_type_property" name="property_resident[loan_own_type_property][{{ $i }}]" required {{ Helper::validate_key_toggle('loan_own_type_property', $resident, 0) }} value="0" data-attorney_edit='{{ (isset($attorney_edit) && $attorney_edit == true) ? true : false }}'>
						<label for="loan_own_type_property_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('loan_own_type_property', $resident, 0) }}" onclick="showHidePropertyLoan('no', this);">No</label>
					</div>
				</div>
			</div>

			<div class="row loan_own_type_property_sec {{ Helper::key_hide_show_v('loan_own_type_property', $resident) }}">
				<!-- Loan 1 -->
				@include('client.questionnaire.property.common.resident_loan_1')

				<div id="tab_additional_loan_div_{{ $i }}" class="col-md-12 {{ @$removepadding }} section_additional_loan {{ Helper::key_hide_show_v('additional_loan1', $home_car_loan2) }}" style="margin-top:16px;">
					<!-- Loan 2 -->
					@include('client.questionnaire.property.common.resident_loan_2')

					<!-- Loan 3 -->
					@include('client.questionnaire.property.common.resident_loan_3')
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 loan-div-{{ $i }} {{ empty($resident) ? ' hide-data ' : ' ' }}">
		<div class="row">
			<div class="col-12">
				<strong class="subtitle">Property Information</strong>
			</div>

			<div class="col-12 light-gray-div b-0-i py-0 mb-0 payment_not_primary_address_parents">
				<div class="label-div question-area">
					<label class="fs-13px">
						Would you like to keep the above property?
						<div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Indicates whether you want to keep or give up the listed property.">
							<i class="bi bi-question-circle"></i>
						</div>
					</label>
					<!-- Radio Buttons -->
					<div class="custom-radio-group form-group mb-0">
						<input type="radio" id="retain_above_property_yes_{{ $i }}" class="d-none retain_above_property" name="property_resident[retain_above_property][{{ $i }}]" required {{ Helper::validate_key_toggle('retain_above_property', $resident, 1) }} value="1">
						<label for="retain_above_property_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('retain_above_property', $resident, 1) }}">Yes</label>

						<input type="radio" id="retain_above_property_no_{{ $i }}" class="d-none retain_above_property" name="property_resident[retain_above_property][{{ $i }}]" required {{ Helper::validate_key_toggle('retain_above_property', $resident, 0) }} value="0">
						<label for="retain_above_property_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('retain_above_property', $resident, 0) }}">No</label>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>