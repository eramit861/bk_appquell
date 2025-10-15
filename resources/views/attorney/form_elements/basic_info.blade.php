@php
$BasicInfoPartA = $basic_info['BasicInfoPartA'];
$BasicInfo_AnyOtherName = !empty($basic_info['BasicInfo_AnyOtherName']) ? $basic_info['BasicInfo_AnyOtherName']->toArray() : [];
$BasicInfoPartB = !empty($basic_info['BasicInfoPartB']) ? $basic_info['BasicInfoPartB']->toArray() : [];
$BasicInfo_PartC = !empty($basic_info['BasicInfo_PartC']) ? $basic_info['BasicInfo_PartC']->toArray() : [];
$BasicInfo_PartRest = !empty($basic_info['BasicInfo_PartRest']) ? $basic_info['BasicInfo_PartRest']->toArray() : [];
@endphp

@push('tab_styles')
<link rel="stylesheet" href="{{ asset('assets/css/basic-info.css') }}">
@endpush

@push('tab_scripts')
<script src="{{ asset('assets/js/basic-info.js') }}"></script>
@endpush

@php
$numbers = ['1st', '2nd', '3rd'];
$prefix = !empty($generation = Helper::validate_key_value('suffix', $BasicInfoPartA)) ? ArrayHelper::getSuffixArray($generation) : '';
$fName = Helper::validate_key_value('name', $BasicInfoPartA);
$mName = Helper::validate_key_value('middle_name', $BasicInfoPartA);
$lName = Helper::validate_key_value('last_name', $BasicInfoPartA);
$name = !empty($prefix) ? $prefix : '';
$name = !empty($fName) ? $name.' '.$fName : $name;
$name = !empty($mName) ? $name.' '.$mName : $name;
$debtorName = !empty($lName) ? $name.' '.$lName : $name;

$street = Helper::validate_key_value('Address', $BasicInfoPartA);
$city = Helper::validate_key_value('City', $BasicInfoPartA);
$state = Helper::validate_key_value('state', $BasicInfoPartA);
$zip = Helper::validate_key_value('zip', $BasicInfoPartA);
$county = \App\Models\CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $BasicInfoPartA));
$address = !empty($street) ? $street : '';
$address = !empty($city) ? $address.', '.$city : $address;
$address = !empty($state) ? $address.', '.$state : $address;
$address = !empty($zip) ? $address.', '.$zip : $address;
$debtoraddress = !empty($county) ? $address.', <span class="font-weight-bold fs-14px w-auto d-inline">County:</span> '.$county : $address;
$debtoraddress = '<span class="fs-14px w-auto d-inline"><strong>Address: </strong>'.$debtoraddress."</span>";
$yes_no = Helper::key_display('any_other_name', $BasicInfoPartA);
$suffix = isset($BasicInfo_AnyOtherName['suffix']) ? json_decode($BasicInfo_AnyOtherName['suffix']) : [];
$name = isset($BasicInfo_AnyOtherName['name']) ? json_decode($BasicInfo_AnyOtherName['name']) : [];
$middleName = isset($BasicInfo_AnyOtherName['middle_name']) ? json_decode($BasicInfo_AnyOtherName['middle_name']) : [];
$lastName = isset($BasicInfo_AnyOtherName['last_name']) ? json_decode($BasicInfo_AnyOtherName['last_name']) : [];
$otherNames = [];
if ($yes_no == 'Yes') {
if (!empty($suffix)) {
foreach ($suffix as $key => $suf) {
$otherNames[] = ['Suffix' => !empty($suf) ? ArrayHelper::getSuffixArray($suf) : '', 'Name' => $name[$key], 'Last Name' => $lastName[$key], 'Middle Name' => $middleName[$key]];
}
}
}
unset($BasicInfo_AnyOtherName['suffix']);
unset($BasicInfo_AnyOtherName['name']);
unset($BasicInfo_AnyOtherName['middle_name']);
unset($BasicInfo_AnyOtherName['last_name']);

$home = Helper::validate_key_value('home', $BasicInfo_AnyOtherName);
$cell = Helper::validate_key_value('cell', $BasicInfo_AnyOtherName);
@endphp
<div class="light-gray-div questionnaire basic_info_questionnaire">
	<h2>Basic Information</h2>
	@include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'basic_info', 'forLabel' => 'Basic Information' ])
	<div class="row gx-3">
		<div class="col-6 mt-3 details_card">
			@include("attorney.form_elements.details_card.debtor")
		</div>

		@if (!empty($BasicInfoPartB))
		@php
		$suffix = json_decode($BasicInfoPartB['spouse_other_suffix']);
		$name = json_decode($BasicInfoPartB['spouse_other_name']);
		$middleName = json_decode($BasicInfoPartB['spouse_other_middle_name']);
		$lastName = json_decode($BasicInfoPartB['spouse_other_last_name']);
		$spotherNames = [];
		if (!empty($suffix)) {
		foreach ($suffix as $key => $suf) {
		$spotherNames[] = ['Suffix' => !empty($suf) ? ArrayHelper::getSuffixArray($suf) : '', 'Name' => $name[$key], 'Last Name' => $lastName[$key], 'Middle Name' => $middleName[$key]];
		}
		}
		unset($BasicInfoPartB['spouse_other_suffix'], $BasicInfoPartB['spouse_other_name'], $BasicInfoPartB['spouse_other_middle_name'], $BasicInfoPartB['spouse_other_last_name']);
		$prefix = ArrayHelper::getSuffixArray(Helper::validate_key_value('suffix', $BasicInfoPartB));
		$fName = Helper::validate_key_value('name', $BasicInfoPartB);
		$mName = Helper::validate_key_value('middle_name', $BasicInfoPartB);
		$lName = Helper::validate_key_value('last_name', $BasicInfoPartB);
		$spouseName = trim(implode(' ', array_filter([$prefix, $fName, $mName, $lName])));

		$street = Helper::validate_key_value('Address', $BasicInfoPartB);
		$city = Helper::validate_key_value('City', $BasicInfoPartB);
		$state = Helper::validate_key_value('state', $BasicInfoPartB);
		$zip = Helper::validate_key_value('zip', $BasicInfoPartB);
		$address = trim(implode(', ', array_filter([$street, $city, $state, $zip])));
		$address = '<span class="fs-14px w-auto d-inline"><strong>Address: </strong>'.$address.'</span>';
		@endphp
		<div class="col-6 mt-3 details_card">
			@include("attorney.form_elements.details_card.codebtor")
		</div>
		@endif



		<div class="col-12 ">
			<div class="light-gray-div questionnaire mt-4 ">
				<h2>BK Cases/Businesses</h2>
				<div class="att-edit-div">
					<x-attorney.attorneyEditButton
						:route="route('basic_info_step3_modal')"
						:isEdited="$isBusinessEdited"
						extraClass="text-bold" />
					<x-attorney.attorneyEditReviewed
						:reviewedData="$isBusinessEdited"
						extraClass="ml-3" />
				</div>
				<div class="row gx-3">
					<div class="col-12">
						<div class="outline-gray-border-area">
							<label class="subtitle pb-1">Prior and/or Pending Bankruptcy Cases</label>
							<!-- Prior and/or Pending Bankruptcy Cases -->
							<div class="row">

								<div class="col-12">
									@php $caseInLast8years = Helper::key_display('filed_bankruptcy_case_last_8years', $BasicInfo_PartC); @endphp
									<label class="font-weight-bold mt-2">Have you filed a bankruptcy case in the last 8 years:
										<span class="{{ ($caseInLast8years == 'Yes') ? 'text-success font-weight-normal ' : 'text-danger text-bold' }}">{{ ($caseInLast8years == 'No') ? 'None' : $caseInLast8years }}</span>
									</label>
								</div>
								@php
								$cases = [];
								if (isset($BasicInfo_PartC['case_filed_state']) && !empty($BasicInfo_PartC['case_filed_state'])) {
								$sates = $BasicInfo_PartC['case_filed_state'];
								$caseno = $BasicInfo_PartC['case_number'];
								$dates = $BasicInfo_PartC['date_filed'];
								$idcaseDismissed = $BasicInfo_PartC['is_case_dismissed'];
								foreach ($sates as $key => $state) {
								$cases[] = [
								'case_state' => $state,
								'case_no' => $caseno[$key] ?? '',
								'case_dates' => $dates[$key] ?? '',
								'case_dismissed' => $idcaseDismissed[$key] ?? ''
								];
								}
								}
								@endphp

								@foreach ($cases as $case)
								<div class="col-3">
									<label class="font-weight-bold ">
										District:
										<span class="font-weight-normal">{{ $case['case_state'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Case #:
										<span class="font-weight-normal">{{ $case['case_no'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Date Filed:
										<span class="font-weight-normal">{{ $case['case_dates'] }}</span>
									</label>
								</div>
								<div class="col-5">
									@php $case_dismissed = ArrayHelper::getYesNoArray($case['case_dismissed']); @endphp
									<label class="font-weight-bold ">
										Was the case dismissed in the last year:
										<span class="font-weight-normal {{ ($case_dismissed == 'Yes') ? 'text-success' : 'text-danger' }}">{{ $case_dismissed }}</span>
									</label>
								</div>
								@endforeach

								<div class="col-12">
									@php $any_bankruptcy_cases_pending = Helper::key_display('any_bankruptcy_cases_pending', $BasicInfo_PartC); @endphp
									<label class="font-weight-bold mt-2">Do you have any bankruptcy cases pending or being filed by your spouse, a business partner, or an affiliate:
										<span class="{{ ($any_bankruptcy_cases_pending == 'Yes') ? 'text-success font-weight-normal ' : 'text-danger text-bold' }}">{{ ($any_bankruptcy_cases_pending == 'No') ? 'None' : $any_bankruptcy_cases_pending }}</span>
									</label>
								</div>
								@php
								$pcases = [];
								if (!empty($BasicInfo_PartC['any_bankruptcy_cases_pending_data'])) {
								$pendingCase = $BasicInfo_PartC['any_bankruptcy_cases_pending_data'];
								$names = $pendingCase['debator_name'];
								$relationsships = $pendingCase['your_relationship'];
								$casenos = $pendingCase['partner_case_number'];
								$dateFields = $pendingCase['partner_date_filed'];
								$districts = $pendingCase['district'];
								foreach ($districts as $key => $dis) {
								$pcases[] = [
								'name' => $names[$key],
								'relation' => $relationsships[$key],
								'caseno' => $casenos[$key],
								'date' => $dateFields[$key],
								'district' => $districts[$key]
								];
								}
								}
								@endphp

								@foreach ($pcases as $pending)
								<div class="col-3">
									<label class="font-weight-bold ">
										Name of debtor:
										<span class="font-weight-normal">{{ $pending['name'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Case #:
										<span class="font-weight-normal">{{ $pending['caseno'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Date Filed:
										<span class="font-weight-normal">{{ $pending['date'] }}</span>
									</label>
								</div>
								<div class="col-3">
									<label class="font-weight-bold ">
										District if (known):
										<span class="font-weight-normal">{{ $pending['district'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Relationship to you:
										<span class="font-weight-normal">{{ $pending['relation'] }}</span>
									</label>
								</div>
								@endforeach

								<div class="col-12">
									@php $bankruptcy_filed_before = Helper::key_display('bankruptcy_filed_before', $BasicInfo_PartC); @endphp
									<label class="font-weight-bold  mt-2">Have you or your spouse ever filed a bankruptcy before:
										<span class="{{ ($bankruptcy_filed_before == 'Yes') ? 'text-success font-weight-normal ' : 'text-danger text-bold' }}">{{ ($bankruptcy_filed_before == 'No') ? 'None' : $bankruptcy_filed_before }}</span>
									</label>
								</div>
								@php
								$pcases = [];
								if (!empty($BasicInfo_PartC['any_bankruptcy_filed_before_data'])) {
								$pendingCase = $BasicInfo_PartC['any_bankruptcy_filed_before_data'];
								$names = $pendingCase['case_name'];
								$casenos = $pendingCase['case_numbers'];
								$dateFields = $pendingCase['data_field'];
								$datedis = $pendingCase['date_discharged'];
								$districts = $pendingCase['district_if_known'];
								foreach ($districts as $key => $dis) {
								$pcases[] = [
								'name' => $names[$key],
								'caseno' => $casenos[$key],
								'date' => $dateFields[$key],
								'datedis' => $datedis[$key],
								'district' => $districts[$key]
								];
								}
								}
								@endphp

								@foreach ($pcases as $pending)
								<div class="col-3">
									<label class="font-weight-bold ">
										Case Name:
										<span class="font-weight-normal">{{ $pending['name'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Case #:
										<span class="font-weight-normal">{{ $pending['caseno'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Date Filed:
										<span class="font-weight-normal">{{ $pending['date'] }}</span>
									</label>
								</div>
								<div class="col-2">
									<label class="font-weight-bold ">
										Date Discharged:
										<span class="font-weight-normal">{{ $pending['datedis'] }}</span>
									</label>
								</div>
								<div class="col-3">
									<label class="font-weight-bold ">
										District if (known):
										<span class="font-weight-normal">{{ $pending['district'] }}</span>
									</label>
								</div>
								@endforeach
							</div>
						</div>
					</div>
					<div class="col-12">
						@php $einArray = json_decode($BasicInfo_PartRest['used_business_ein_data'], 1); @endphp
						<div class="outline-gray-border-area">
							<label class="subtitle mt-3 mb-4 pb-1">
								Business Owned as a Sole Proprietor
								@if (!isset($einArray['type']) || (isset($einArray['type']) && is_array($einArray['type']) && !in_array(3, $einArray['type'])))
									: <span class="text-c-red ">None</span>
								@endif
							</label>
							<!-- Business Owned as a Sole Proprietor -->
							@php

							$businesses = $einArray['own_business_selection'] ?? [];
							$businesstype = $einArray['type'] ?? [];
							$businesnames = $einArray['own_business_name'] ?? [];
							$einnos = $einArray['own_ein_no'] ?? [];
							$doesntHaveEin = $einArray['doesntHaveEin'] ?? [];
							$einstreet_number = $einArray['street_number'] ?? [];
							$eincity = $einArray['city'] ?? [];
							$einstate = $einArray['state'] ?? [];
							$einzip = $einArray['zip'] ?? [];
							$einoperation_date = $einArray['operation_date'] ?? [];
							$business_still_open = $einArray['business_still_open'] ?? [];
							$einoperation_date2 = $einArray['operation_date2'] ?? [];
							$einbusinessDescription = $einArray['businessDescription'] ?? [];
							$ownershipPrecentage = $einArray['type_of_account'] ?? [];
							$property_value = $einArray['property_value'] ?? [];
							$einBusiness = [];
							foreach ($businesses as $key => $business) {
							$einBusiness[] = [
							'selection' => $businesses[$key],
							'name' => $businesnames[$key],
							'street_number' => $einstreet_number[$key] ?? '',
							'city' => $eincity[$key] ?? '',
							'state' => $einstate[$key] ?? '',
							'zip' => $einzip[$key] ?? '',
							'doesnothave' => $doesntHaveEin[$key] ?? '',
							'ein' => ($einnos[$key] ?? ''),
							'business_still_open' => ($business_still_open[$key] ?? ''),
							'einoperation_date' => ($einoperation_date[$key] ?? ''),
							'einoperation_date2' => ($einoperation_date2[$key] ?? ''),
							'description' => Helper::validate_key_value($key, $einbusinessDescription, 'radio'),
							'type' => (isset($businesstype[$key]) && (Helper::validate_key_value($key, $businesstype, 'radio'))) ? ArrayHelper::getBasicInfoBussinessTypeArray($businesstype[$key]) : '',
							'b_type' => isset($businesstype[$key]) ? $businesstype[$key] : 0,
							'ownershipPrecentage' => $ownershipPrecentage[$key] ?? '',
							'property_value' => $property_value[$key] ?? ''
							];
							}
							$spouse_Business = ArrayHelper::getYesNoArray($BasicInfo_PartRest['used_business_ein']);
							@endphp
							@if ($spouse_Business == 'Yes')
								@if (!empty($einBusiness))
									@php $i = 1; @endphp
									@foreach ($einBusiness as $biz)
										@if ($biz['b_type'] == 3)
											@php
											$einAddress = '';
											if (!empty($biz)) {
											$einAddress .= $biz['street_number'] ?? '';
											$einAddress .= !empty($biz['city']) ? ', '.$biz['city'] : '';
											$einAddress .= !empty($biz['state']) ? ', '.$biz['state'] : '';
											$einAddress .= !empty($biz['zip']) ? ', '.$biz['zip'] : '';
											}
											@endphp
											<div class="light-gray-div">
												<div class="light-gray-box-form-area">
													<h2 class="">
														<div class="circle-number-div">{{ $i }}</div>Business Details
													</h2>
													<div class="row gx-3 set-mobile-col">
														<div class="col-7 align-items-center d-flex">
															<div class="row">
																<div class="col-5">
																	<label class="font-weight-bold ">Business name:
																		<span class="font-weight-normal">{{ $biz['name'] }}</span></label>
																</div>
																<div class="col-4">
																	@if (!empty($biz['type']))
																	<label class="font-weight-bold ">Type:
																		<span class="font-weight-normal">{{ $biz['type'] }}</span></label>
																	@endif
																</div>
																<div class="col-3">
																	<label class="font-weight-bold ">Who owns this business:
																		<span class="font-weight-normal">{{ $biz['selection'] == 0 ? 'Debtor' : 'Spouse' }}</span></label>
																</div>
																<div class="col-12">
																	<label class="font-weight-bold ">Address:
																		<span class="font-weight-normal">{{ $biz['street_number'] }}</span></label>
																</div>
																<div class="col-5">
																	<label class="font-weight-bold ">City:
																		<span class="font-weight-normal">{{ $biz['city'] }}</span></label>
																</div>
																<div class="col-4">
																	<label class="font-weight-bold ">State:
																		<span class="font-weight-normal">{{ $biz['state'] }}</span></label>
																</div>
																<div class="col-2">
																	<label class="font-weight-bold ">Zip:
																		<span class="font-weight-normal">{{ $biz['zip'] }}</span></label>
																</div>



																<div class="col-5">
																	<label class="font-weight-bold ">Date started:
																		<span class="font-weight-normal">{{ $biz['einoperation_date'] }}</span></label>
																</div>
																<div class="col-6">
																	<label class="font-weight-bold ">Date dissolved:
																		@if (isset($biz['business_still_open']) && ($biz['business_still_open'] == 1))
																		<span class="font-weight-normal">Business is still open</span>
																		@else
																		<span class="font-weight-normal">{{ Helper::validate_key_value('einoperation_date2', $biz) }}</span>
																		@endif
																	</label>
																</div>
															</div>
														</div>
														<div class="col-5">
															<div class="row">
																<div class="col-12">
																	@if (!empty($biz['description']))
																	<label class="font-weight-bold ">Describe your business:</label>
																	@foreach (ArrayHelper::getBasicInfoBussinessDescriptionArray() as $key => $label)
																	<p class="mb-1">
																		<input type="checkbox" id="checkbox_{{ $key }}" class="disabled-blue-color" readonly disabled {{ ($key == $biz['description']) ? 'checked' : '' }}>
																		<label for="checkbox_{{ $key }}" class="custom-checkbox mb-0">{{ $label }}</label>
																	</p>
																	@endforeach
																	@endif
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
											@php $i++; @endphp
										@endif
									@endforeach
								@endif
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>