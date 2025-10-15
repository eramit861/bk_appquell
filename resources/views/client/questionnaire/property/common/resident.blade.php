<div class="col-md-12 residence_property_main_div residence_property_main_div_{{$i}} ">
	<!-- SUMMARY -->

	@php
		$property = [1 => "Single family home", 2 => "Duplex or multi-unit building", 3 => "Condominium or cooperative", 4 => "Manufactured or mobile home", 5 => "Land", 6 => "Investment property", 7 => "Timeshare", 8 => "Other"];

		$ownRent = Helper::validate_key_value('currently_lived', $resident, 'radio'); // 1
		$isPrimaryProperty = Helper::validate_key_value('not_primary_address', $resident, 'radio'); // 0

		$primary_text = (($ownRent == 1 && $isPrimaryProperty == 0) || ($ownRent == 0)) ? 'Primary Residence' : 'Non-Primary Residence';
	@endphp

	<div class="outline-gray-border-area mt-2">
		<div class="light-gray-div {{ ($i == 1) ? 'mt-2' : '' }}">
			<div class="light-gray-box-form-area">
				<h2>
					<div class="circle-number-div ">{{ $i + 1 }}</div> <span class="border-label">{{ $primary_text }}</span>
				</h2>
				<button type="button" class="delete-div trash-btn" title="Delete" data-saveid="{{ $i }}" onclick="remove_resident_div({{ $i }},{{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }});">
					<i class="bi bi-trash3 mr-1"></i>
					Delete
				</button>

				<!-- summary -->
				<div class="row gx-3 residence_form_summary mb-3 {{ (!isset($resident['id']) || empty($resident['id'])) ? 'hide-data' : '' }} residence_form_summary_{{ $i }}">
				@if (!empty($resident))
					@include("attorney.form_elements.property-primary", ['hide_docs' => true, 'primary_text' => $primary_text, 'i' => $i+1])
				@endif
				</div>
				<!-- edit section -->
				<div class="row gx-3 currently_lived_parents form-main residence_form {{ !empty($resident) ? 'hide-data' : '' }} residence_form_{{ $i }}">
					@php
						$home_car_loan = (!empty($resident['home_car_loan'])) ? json_decode($resident['home_car_loan'], 1) : [];
						$home_car_loan2 = (!empty($resident['home_car_loan2'])) ? json_decode($resident['home_car_loan2'], 1) : [];
						$home_car_loan3 = (!empty($resident['home_car_loan3'])) ? json_decode($resident['home_car_loan3'], 1) : [];
						$list = @$docsUploadInfo['list'];
						if (date('d') >= 10) {
							$currentMonth = date('m/Y');
							$lastMonth = date('m/Y', strtotime('-1 month'));
							$monthBeforeLast = date('m/Y', strtotime('-2 months'));
						} else {
							$currentMonth = date('m/Y', strtotime('-1 month'));
							$lastMonth = date('m/Y', strtotime('-2 months'));
							$monthBeforeLast = date('m/Y', strtotime('-3 months'));
						}
						$rentArea = empty($resident) ? "hide-data" : '';
					@endphp
					
					@if (!empty($resident['id']))
						<input type="hidden" 
							name="property_resident[id][{{ $i }}]" 
							value="{{ Helper::validate_value($resident['id']) }}">
					@endif

					<div class="col-12 light-gray-div b-0-i py-0 mb-0">
						<div class="label-div question-area border-bottom-default">
							<label for="bankruptcy_filed">
								Do you own or rent where you currently live?
							</label>
							<!-- Radio Buttons -->
							<div class="custom-radio-group form-group">
								<input type="radio" id="currently_lived_yes_{{ $i }}" class="d-none currently_lived currently_lived_own" name="property_resident[currently_lived][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('currently_lived', $resident, 1) }} value="1">
								<label for="currently_lived_yes_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('currently_lived', $resident, 1) }}" onclick="currently_lived_property('yes',this, 1,{{ $mortageloanData['id'] ?? 0 }},'{{ route('show_scanned_resident') }}'); setBorderLabel(this, 'Primary Residence');">Own</label>

								<input type="radio" id="currently_lived_no_{{ $i }}" class="d-none currently_lived currently_lived_rent" name="property_resident[currently_lived][{{ $i }}]" data-index="{{ $i }}" required {{ Helper::validate_key_toggle('currently_lived', $resident, 0) }} value="0">
								<label for="currently_lived_no_{{ $i }}" class="btn-toggle {{ Helper::validate_key_toggle_active('currently_lived', $resident, 0) }}" onclick="currently_lived_property('no',this, 0 ,{{ $mortageloanData['id'] ?? 0 }},'{{ route('show_scanned_resident') }}'); setBorderLabel(this, 'Primary Residence');">Rent</label>
							</div>
						</div>
					</div>

					<!-- Own Section -->
					<div class="col-12 currently_lived_data {{ Helper::key_hide_show_v('currently_lived', $resident) }}">
						@include("client.questionnaire.property.common.step1_own")
						<div class="text-right mb-2 pb-2 own-save-div hide-data">
							<a href="javascript:void(0)" data-saveid="{{ $i }}" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" onclick="saveResident(true, this, '', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }})">Save</a>
						</div>
					</div>

					<!-- Rent Section -->
					<div class="col-12 resident_rent_data {{ $rentArea }} {{ (count($propertyresident) == 0) ? '' : Helper::key_hide_show_v2('currently_lived', $resident) }}">
						@include("client.questionnaire.property.common.step1_rent")
						<div class="text-right mb-2 pb-2">
							<a href="javascript:void(0)" data-saveid="{{ $i }}" class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2" onclick="saveResident(true, this, '', {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }})">Save</a>
						</div>
					</div>

				</div>

				<a href="javascript:void(0)" data-saveid="{{ $i }}" class=" client-edit-button with-delete bottom-left-position " onclick="display_resident_div({{ $i }}, {{ (isset($attorney_edit) && $attorney_edit == true) ? 'true' : 'false' }})">
					<span>
						<i class="bi bi-pencil-square mr-1"></i>
						Edit
					</span>
				</a>
			</div>

		</div>
	</div>
</div>
