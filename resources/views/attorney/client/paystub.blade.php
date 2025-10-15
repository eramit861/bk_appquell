@extends("layouts.attorney")
@section('content')
@include("layouts.flash")


@php
$val = $User;
$client_type = $val['client_type'];

$BIData = \App\Services\Client\CacheBasicInfo::getBasicInformationData($val['id']);
$clientBasicInfoPartA = \App\Helpers\Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
$clientBasicInfoPartB = \App\Helpers\Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
$debtorname = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");
$spousename = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor's");

$messages = [];

if ($payStubApiStatus['in_progress'] > 0) {
$messages[] = "<a href='javascript:void(0)' class='border border-danger lh_point_1 blink text-danger btn m-0 w-auto' onclick='location.reload(); return false;'>"
	. "<img alt='AI' src='" . asset(' assets/img/ai_icon_dark.png') . "' class='ai-icon' style='height:24px;'>"
		. " {$payStubApiStatus['in_progress']} document(s) are in progress.<br> Click here to refresh"
		. "</a>" ;
		}

		if (!empty($messages)) {
		$statusMessage=implode('<br>', $messages);
	} else {
	$statusMessage = '';
	}

	if ($User->client_type == 2) {
	$spousename = "Non-Filing Spouse's";
	}

	$loggedInUserName = 'BKQ Admin';
	if (!empty($loggedInUser)) {
	$loggedInUserName = ($loggedInUser->role == 1) ? 'BKQ Admin' : $loggedInUser->name;
	}

	$attorney_id = Helper::getCurrentAttorneyId();
	$unreadcount = \App\Models\SignedDocuments::where(['attorney_id' => $attorney_id, 'client_id' => $val['id'],'read_by_attorney' => 0])->whereNotNull('sign_document')->count();
	$notIn = ['document_sign','signed_document'];
	$unreadDoccountArray = (new \App\Models\ClientDocumentUploadedData())->getClientUploadDocData($val['id'], $attorney_id);
	$unreadDoccount = isset($unreadDoccountArray['unreadDocuments']) && is_array($unreadDoccountArray['unreadDocuments']) ? count($unreadDoccountArray['unreadDocuments']) : 0;
	$date = date_create($val['created_at']);
	$formated_DATETIME = date_format($date, 'M dS, Y');
	$ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($val['id']);
	$settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
	$is_associate = !empty($ClientsAssociateId) ? 1 : 0;
	$attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['attorney_enabled_bank_statment'])->first();
	$attorney_enabled_bank_statment = !empty($attorneySettings) ? $attorneySettings->attorney_enabled_bank_statment : 1;
	$formstep = \App\Models\FormsStepsCompleted::where(['client_id' => $val['id']])->first();
	$payrollRoute = route('client_paystub', ['id' => $val['id'], 'type' => 'paystub']);

	if ($val['client_payroll_assistant'] == 2) {
	$payrollRoute = route('client_paystub_partner', ['id' => $val['id'], 'type' => 'paystub']);
	}

	$forText = '';
	$userId = $User['id'];
	$debtorName = empty(trim($debtorName)) ? $User['name'] : $debtorName;
	$codebtorName = empty(trim($codebtorName)) ? "Co-debtor Pay stubs" : $codebtorName;

	if ($type == 'paystub') {
	$clType = 'debtor';
	$forText = "Debtor's";
	}

	if ($type == 'paystub_partner') {
	$clType = 'codebtor';
	$forText = "Co-debtor's";
	}
	@endphp



	<div class="row">
		 {{-- @include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type]) --}}
		@include('attorney.client.manage.common_client_description')

		<div class="col-12">
			<div class="card information-area mt-3">

				@include('attorney.client.manage.common_tab_links')

				<div class="card-body border-top-left-radius-none">
					<div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
						<div class="payroll-tab tab-pane fade show active mcard-body" id="active" role="tabpanel" aria-labelledby="" tabindex="0">


							<div class="container-fluid px-0">
								<div class="d-flex flex-nowrap overflow-auto align-items-center gap-2 py-2 justify-content-between">
									<div class="d-flex flex-nowrap align-items-center gap-2 flex-wrap">
										<div class="d-flex flex-nowrap align-items-center gap-2 flex-wrap">
											<a href="{{ route('client_paystub', ['id' => $User['id'], 'type' => 'paystub']) }}"
												class="btn btn-new-ui-default mb-0 {{ $type == 'paystub' ? 'is_active' : '' }} text-nowrap"
												style="white-space:nowrap; min-width:120px;">
												{{ $debtorName }}
											</a>

											@if($User['client_type'] == 2 || $User['client_type'] == 3)
											<a href="{{ route('client_paystub_partner', ['id' => $User['id'], 'type' => 'paystub']) }}"
												class="btn btn-new-ui-default mb-0 {{ $type == 'paystub_partner' ? 'is_active' : '' }} text-nowrap"
												style="white-space:nowrap; min-width:120px;">
												{{ $codebtorName }}
											</a>
											@endif

											<div class="d-inline-block">
											@if (in_array($type, ['paystub', 'paystub_partner']))
												@php
												$dataType = 'Debtor_Pay_Stubs';
												$for = "Debtor";
												if ($type == 'paystub') {
													$for = "Debtor";
													$dataType = 'Debtor_Pay_Stubs';
												}
												if ($type == 'paystub_partner') {
													$for = ($client_type == 2) ? "Non-Filing Spouse" : "Co-Debtor";
													$dataType = 'Co_Debtor_Pay_Stubs';
												}
												@endphp
												<a href="javascript:void(0)" onclick="calculateUploadBtnClickForAllEmployer('{{ $dataType }}', '{{ $for }}' )"
													class="view_client_btn calculate-dt-income text-nowrap"
													style="border-radius: var(--border-radius); white-space:nowrap; min-width:180px;">
													{{ ($type == "paystub_partner") ? "Calculate Co-Debtor's Income" : "Calculate Debtor's Income" }}
													<img src="{{ asset('assets/img/ai_icon.png')}}" class="" alt="AI" style="height:20px">
												</a>
											@endif
											</div>
										</div>
										<div class="ms-3 text-nowrap">
											@if (!empty($statusMessage))
												{!! $statusMessage !!}
											@endif
										</div>
									</div>

									<div class="d-none d-md-flex flex-nowrap align-items-center gap-2">
										@if (!empty($reports[0]))
										<a href="javascript:void(0)" onclick="showCalculation()"
											class="btn btn-new-ui-default {{ $type == 'paystub' ? 'is_active' : '' }} text-nowrap"
											style="white-space:nowrap;">
											6 Month CMI Calculation
										</a>
										@endif

										<a href="javascript:void(0)" onclick="payCheckPopup('{{ $User['id'] }}')"
											class="btn btn-new-ui-default text-nowrap"
											style="white-space:nowrap;">
											Pay Check/Calculation
										</a>
									</div>
								</div>
							</div>

							<div class="row m-0">
								<div class="row button-set-3 m-0 p-0">
									@php
									$paystubRoute = 'javascript:void(0)';
									$employerRoute = 'javascript:void(0)';
									if ($type == 'paystub') {
										$paystubRoute = route('client_paystub', ['id' => $User['id'], 'type' => 'paystub']);
										$employerRoute = route('client_paystub', ['id' => $User['id'], 'type' => 'employer']);
									}
									if ($type == 'paystub_partner') {
										$paystubRoute = route('client_paystub_partner', ['id' => $User['id'], 'type' => 'paystub']);
										$employerRoute = route('client_paystub_partner', ['id' => $User['id'], 'type' => 'employer']);
									}
									@endphp
									<div class="col-3 col-lg-3 pl-1 pr-1">
										<a href="{{ $paystubRoute }}" class="btn btn-new-ui-default mb-0 is_active paychecks-btn w-100"><span class="">Paystubs</span></a>
									</div>
									<div class="col-3 col-lg-3 pl-1 pr-1">
										<a href="{{ $employerRoute }}" class="btn btn-new-ui-default mb-0 employer-btn w-100"><i class="fa fa-user"></i> <span class="">Manage Employer</span></a>
									</div>
									<div class="col-3 col-lg-3 pl-1 pr-1">
										<a href="javascript:void(0)" onclick="manageEmployer('{{ $userId }}', '{{ $clType }}')" class="btn btn-new-ui-default mb-0 float_left new-employer-btn w-100"><i class="feather icon-plus"></i> <span class="">Add New Employer</span></a>
									</div>
									<div class="col-3 col-lg-3 btn-group float_left mb-1 pl-1 pr-1">
										<button class="btn btn-new-ui-default mb-0 new-paychecks-btn dropdown-toggle w-100" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="height: fit-content;">
											<i class="feather icon-plus" aria-hidden="true"></i>
											<span class="">Add New Paystub</span>
										</button>
										<div class="dropdown-menu">
											<!-- Old one -->
											<a href="javascript:void(0)" class="dropdown-item" onclick="addNewPaystub('{{ $userId }}', '{{ $clType }}')">
												<img alt="add" class="head_img" src="{{ asset('assets/img/payroll_add_icon.svg')}}">
												<div class="head_in"><strong>Add an individual Pay check </strong>
													<br><span>(Enter individual pay checks)</span>
												</div>
											</a>
											<!-- Copy Popup -->
											<a href="javascript:void(0)" class="dropdown-item" onclick="copyPopup('', '{{ $userId }}', '{{ $clType }}')"><img alt="add" class="head_img" src="{{ asset('assets/img/payroll_add_icon_green.svg')}}">
												<div class="head_in"><strong>Add pay stubs for Entire CMI period</strong>
													<br><span>(This auto duplicates first pay stub to all pay periods)</span>
												</div>
											</a>
											<!-- New popup -->
											<a href="javascript:void(0)" class="dropdown-item" onclick="newMonthlyPayPopup('{{ $userId }}', '{{ $clType }}')"><img alt="add" class="head_img" src="{{ asset('assets/img/payroll_add_icon_blue.svg')}}">
												<div class="head_in"><strong>Add pay month by month for CMI</strong>
													<br><span>(This allows you to add pay by month and use avg.)</span>
												</div>
											</a>

										</div>
									</div>
								</div>
								<div class="row button-set-4 justify-content-end m-0 p-0">
									<div class="col-7 float_right w-100 pl-1 pr-1">
										@if (!empty($reports[0]))
										<a onclick="syncPaystub('{{ $User['id'] }}', '{{ $clType }}')" href="javascript:void(0)" class="btn blink text-c-red btn-new-ui-default mb-0 mr-0 w-100 text-nowrap" style="white-space:normal !important;">
											Confirm Debtor Payroll Deductions
										</a>
										@endif
									</div>
								</div>
							</div>

							<h4 class="card-title"></h4>

							<div class="table-responsive paystb paychecks-section">
								<table class="table">
									<tbody>
										<tr>
											<th scope="col">{{ __('Download PDF') }}</th>
											<th scope="col">{{ __('Pay period') }}</th>
											<th scope="col">{{ __('Pay date') }}</th>
											<th scope="col">{{ __('Gross pay') }}</th>
											<th scope="col">{{ __('Taxes') }}</th>
											<th scope="col">{{ __('Deductions') }}</th>
											<th scope="col">{{ __('Check amount') }}</th>
											<th scope="col">{{ __('Json') }}</th>
											<th scope="col">{{ __('Action') }}</th>
										</tr>
										@php $monthn = ''; @endphp
										@if (empty($reports[0]))
										<tr class="unread text-center">
											<td colspan="13">{{ __('No Record Found.') }}</td>
										</tr>
										@endif
										@php
										$documentArray = \App\Models\PayStubs::where(['client_id' => $User['id']])->where('document_id', '!=', null)->select('document_id')->get();
										$documentArray = !empty($documentArray) ? $documentArray->toArray() : [];
										$assignedDocumentIds = array_column($documentArray, 'document_id');

										$unassignedDocs = [];
										$totalpaydocIds = array_column($paystubDocuments, 'id');
										foreach ($paystubDocuments as $key => $doc) {
											if (!in_array($doc['id'], $assignedDocumentIds)) {
												array_push($unassignedDocs, $doc);
												unset($paystubDocuments[$key]);
											}
										}

										$lastEmployerName = '';
										$notAssignedDisplayed = false;

										$currentAdditionalLabelDisplayed = false;
										$attorneyEmployerLabelDisplayed = false;
										$previousEmployerLabelDisplayed = false;

										$notAssignedLabelDisplayed = false;
										@endphp
										@foreach ($reports as $report)
											@php
												$monthn = date("F Y", strtotime($report->pay_period_end));
											@endphp
											@php
												// Check if employer name is empty or null
												$employerName = !empty($report['employer_name']) ? $report['employer_name'] : '';

												// Check if it's a new employer name or "" is being shown for the first time
												if (($employerName !== $lastEmployerName && $employerName !== '')
													|| ($employerName === '' && !$notAssignedDisplayed)
												) {
													$employer_type = Helper::validate_key_value('employer_type', $report, 'radio');
													$labelText = "<span class='border-bottom-light-blue text-danger'>Not Assigned Paystubs:</span>";
													$employerNoBorderTop = "bt-0-i";
													if (($employer_type == 1 || $employer_type == 99 || $employer_type == 0)) {
														$labelText = "<span class='border-bottom-light-blue text-c-green'>Current and Additional Employer(s):</span>";
													}
													if (($employer_type == 2)) {
														$labelText = "<span class='border-bottom-light-blue text-danger'>Previous Employer(s):</span>";
													}
												}
											@endphp
											<tr class="employer-name-header ">
												<th colspan="9" class="px-3 py-2 ">
													<p class="mb-0 text-lightblue font-weight-bold">
														@if (!empty($labelText))
															{!! $labelText !!}
														@endif{{ $employerName }}
													</p>
												</th>
											</tr>

											@php
												$lastEmployerName = $employerName;
												// Mark "Not Assigned" as displayed so it doesn't appear again
												if ($employerName === '') {
													$notAssignedDisplayed = true;
												}
											@endphp
									


										<tr class="unread paystub-row paystub-{{ $report->id }}  @if ($report['gross_pay_amount'] < 0) {{ __('negative-record') }} @endif">
											@php $tdId = "/paystubs/" . $User['id'] . '/' . $report->document; @endphp
											<td class="text-center" id="{{ $tdId }}">
												@if ($report->processed_by_ai)
													<img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px" alt="AI">
												@endif
												@php
												$calculated = "<small class='text-danger text-bold'><i class='fas fa-exclamation-circle' ></i> Not marked calculated</small>";
												if (isset($report->is_calculated) && !empty($report->is_calculated)) {
													$calculated = "<small class='text-c-green text-bold'><i class='fas fa-check-circle' ></i> Marked calculated</small>";
												}
												@endphp
												<p class="mb-0">{!! $calculated !!}

												@php
												$paystubs = [];
												foreach ($paystubDocuments as $payst) {
													$thisdate = 1;
													$payst['updated_name'] = rtrim($payst['updated_name'], ".");
													$payst['updated_name'] = rtrim($payst['updated_name'], ".pdf");
													$dates = explode(".", $payst['updated_name']);
													if (isset($dates[0]) && isset($dates[1]) && isset($dates[2])) {
														$month = $dates[0];
														$day = $dates[1];
														$year = $dates[2];
														$thisdate = $year . '/' . $month . '/' . $day;
														$thisdate = strtotime($thisdate);
													}
													$payst['compare_date'] = $thisdate;
													$paystubs[] = $payst;
												}
												$paystubDocuments = $paystubs;
												usort($paystubDocuments, function ($a, $b) {
													return $b['compare_date'] <=> $a['compare_date'];
												});
												@endphp
												@if (empty($report->document_id))
												<span>
													<div class="light-gray-div p-0 m-0 b-0-i mr-3">
														<div class="label-div m-0 b-0-i">
															<div class="form-group pt-1">
																<select class="form-control document-select h-44px" name="document_id_{{ $report->id }}" id="document_id" onchange="savePaystubDocument(this,'{{ $report->client_id }}', '{{ $report->id }}');">
																	<option value="">Select Document</option>
																	@if (!empty($unassignedDocs))
																		<optgroup label="Unassigned documents"></optgroup>
																	@endif
																	@foreach ($unassignedDocs as $data)
																		<option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
																	@endforeach
																	@if (!empty($paystubDocuments))
																		<optgroup label="Assigned documents"></optgroup>
																	@endif
																	@foreach ($paystubDocuments as $data)
																		@if (in_array($data['id'], $assignedDocumentIds))
																			<option value="{{ $data['id'] }}">{{ $data['name'] }}</option>
																		@endif
																	@endforeach
																</select>
															</div>
														</div>
													</div>
												</span>
												@endif
												@if (!empty($report->document_id))
												<p class="my-2 ">
													<a href="{{ route('client_doc_download', ['id' => $report->document_id]) }}" download title="{{ $report->document }}">
														<i style="font-size:24px;" class="fa fa-file-pdf" aria-hidden="true"></i>
														<br><span style="color:#012cae;">{{ date("F d, Y", strtotime($report->pay_date)) }} {{ __('Pay Stub') }}</span>
													</a>
												</p>
												@endif
												@if ($report['gross_pay_amount'] < 0)
													<br>
													<p style="color: red; margin:auto;font-size: 10px; max-width: 150px; word-break: break-word; white-space: normal;">
														{{ __('Pay Period/Pay stub shows negative value') }} <br>{{ __('(not included in calculation provided for info purposes)') }}
													</p>
												@endif
												@if (isset($report['employer_name']) && !empty($report['employer_name']))
													<p class="mb-0"><small class="text-c-green font-weight-bold mt-2">{{ $report['employer_name'] }} </small></p>
												@endif
											</td>
											<td>
												<span>{{ date("F d, Y", strtotime($report->pay_period_start)) }} <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('to') }}<br> {{ date("F d, Y", strtotime($report->pay_period_end)) }}</span>
											</td>
											<td>
												<span>{{ date("F d, Y", strtotime($report->pay_date)) }}</span>
											</td>
											<td>
												<span>
													<ul>
														<li> Regular Pay = {{ Helper::formatPrice($report->regular_pay_amount) }} </li>
														<li> Overtime Pay = {{ Helper::formatPrice($report->overtime_pay_amount) }} </li>
														<li style='text-align:left;list-style:none'><span class='font-weight-bold'>Total Gross Pay: <span class="text-c-green ">{{ Helper::formatPrice($report->gross_pay_amount) }}</span></span></li>
														@if (!empty($report->gross_pay_ytd))
															<li style='text-align:left;list-style:none'><span class='font-weight-bold'>YTD: <span class="text-c-green ">{{ Helper::formatPrice($report->gross_pay_ytd) }}</span></span></li>
														@endif
														@if (isset($report->is_calculated) && !empty($report->is_calculated))
															@php
															$cnfmPaystubDate = date("F d, Y", strtotime($report->pay_date)) . " Pay Stub";
															$cnfmPaystubName = $report['employer_name'];
															$cnfmPaystubNameEscaped = addslashes($cnfmPaystubName);
															$cnfmsg = "Are you sure you want to import " . $cnfmPaystubDate . " Taxes and Deductions to other Pay Stub for " . $cnfmPaystubNameEscaped . "?";
															@endphp
															<li><a href="javascript:void(0)" class="text-c-blue font-weight-bold pl-0 ml-0" onclick="assignDataToOtherPaystubs('{{ $report->id }}', '{{ $userId }}', '{{ $report->pinwheel_account_type }}', '{{ $cnfmsg }}', {{ $report->employer_id }})">
																	<i class="bi bi-copy font-weight-bold-imp text-c-blue mr-1"></i> Import Taxes and Deductions to All
																</a></li>
														@endif
														@php
														$rname = $report->pay_period_start . ' - ' . $report->pay_period_end;
														$deleteRoute = route('client_paystub_delete');
														$calculationLogs = '';
														$calculationLogs = $report->calculation_logs;
														@endphp
														@if (!empty($calculationLogs))
															<li><a href="javascript:void(0)" class="text-c-blue font-weight-bold" onclick="calculationLogsPopup('{{ $report->id }}', '{{ $userId }}')">
																	<i class="bi bi-repeat font-weight-bold-imp text-c-blue mr-1"></i> Deductions and Taxes History
																</a></li>
														@endif
													</ul>
												</span>
											</td>
											<td class="pt-3">
												<span>
													<ul>
														@if (!empty(json_decode($report->taxes, 1)))
															@foreach (json_decode($report->taxes,1) as $tax)
															<li> {{ $tax['name'] }} = {{ $tax['amount'] }} </li>
															@endforeach
														@endif
														<li style='text-align:left;list-style:none'><span class='font-weight-bold'>Total Taxes: {{ Helper::formatPrice($report->total_taxes) }}</span></li>
													</ul>
												</span>
											</td>
											<!-- <td><span>{{ Helper::formatPrice($report->total_reimbursements) }}</span></td> -->
											<td class="pt-3">
												<span>
													<ul>
														@if (!empty(json_decode($report->deductions, 1)))
															@foreach (json_decode($report->deductions,1) as $deduction)
															<li> {{ $deduction['name'] }} = {{ $deduction['amount'] }} </li>
															@endforeach
														@endif
														<li style='text-align:left;list-style:none'><span class='font-weight-bold'>Total Deductions: {{ Helper::formatPrice($report->total_deductions) }}</span></li>
													</ul>
												</span>
											</td>
											<td><span>{{ Helper::formatPrice($report->net_pay_amount) }}</span></td>
											<td><span><a href="javascript:void(0)" onclick="showresponse('{{ base64_encode($report->paystub_json) }}')">{{ __('See response') }}</a></span></td>
											<td>
												@php
												$calculationMismatch = false;
												$calculatedNetPay = (float)Helper::priceFormt($report['gross_pay_amount'], 1, 0) - ((float)Helper::priceFormt($report->total_taxes, 1, 0) + (float)Helper::priceFormt($report->total_deductions, 1, 0));
												if ((float)Helper::priceFormt($calculatedNetPay) != (float)Helper::priceFormt($report->net_pay_amount)) {
													$calculationMismatch = true;
												}
												// Calculate sum of all tax amounts
												$taxes = is_string($report['taxes']) ? json_decode($report['taxes'], true) : $report['taxes'];
												$totalTaxAmount = 0;
												if (is_array($taxes)) {
													foreach ($taxes as $tax) {
														if (isset($tax['amount'])) {
															$totalTaxAmount += (float)$tax['amount'];
														}
													}
												}
												$isTaxesMismatch = false;
												if ((float)Helper::priceFormt($totalTaxAmount, 1, 0) != (float)Helper::priceFormt($report->total_taxes, 1, 0)) {
													$isTaxesMismatch = true;
												}

												$deductions = is_string($report['deductions']) ? json_decode($report['deductions'], true) : $report['deductions'];
												$totalDeductionAmount = 0;
												if (is_array($deductions)) {
													foreach ($deductions as $ded) {
														if (isset($ded['amount'])) {
															$totalDeductionAmount += (float)$ded['amount'];
														}
													}
												}
												$isDeductionsMismatch = false;
												if ((float)Helper::priceFormt($totalDeductionAmount, 1, 0) != (float)Helper::priceFormt($report->total_deductions, 1, 0)) {
													$isDeductionsMismatch = true;
												}
												@endphp
												<div class="btn-group">
													<button class="btn-new text-white btn option-btn dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
														<i class="fa fa-cog" aria-hidden="true"></i>
														Options
													</button>
													<div class="dropdown-menu">
														<a href="javascript:void(0)" class="dropdown-item" onclick="editPaystub('{{$report->id}}', '{{ $userId }}', '{{ $clType }}')">
															<i class="fas fa-pencil-square-o text-c-blue mr-1"></i> Edit
														</a>
														<a href="javascript:void(0)" class="dropdown-item" onclick="copyPopup('{{$report->id}}', '{{ $userId }}', '{{ $clType }}')">
															<i class="fas fa-clone text-success mr-1"></i> Add Duplicated checks to CMI
														</a>
														<a href="javascript:void(0)" class="dropdown-item" onclick="clonePopup('{{$report->id}}', '{{ $userId }}', '{{ $clType }}')">
															<i class="fas fa-clone text-c-blue mr-1"></i> Add Duplicate Pay Stubs
														</a>

														<a href="javascript:void(0)" onclick="deletePaystub('{{ $deleteRoute }}', '{{ $report->id }}', '{{ $rname }}')" class="px-2">
															<button type="button" class="delete-div" title="Delete">
																<i class="bi bi-trash3"></i>
																Delete
															</button>
														</a>
													</div>
												</div>

												@if ($calculationMismatch == true)
													<br><i class="fa text-c-red blink fa-exclamation-triangle pr-0" aria-hidden="true"></i><span class="text-c-red"> Need to Check Calculation <i class="fa text-c-red blink fa-exclamation-triangle pr-0" aria-hidden="true"></i></span>
												@endif
												@if ($isTaxesMismatch == true)
													<br><i class="fa text-c-red blink fa-exclamation-triangle pr-0" aria-hidden="true"></i><span class="text-c-red"> Need to Check Taxes <i class="fa text-c-red blink fa-exclamation-triangle pr-0" aria-hidden="true"></i></span>
												@endif
												@if ($isDeductionsMismatch == true)
													<br><i class="fa text-c-red blink fa-exclamation-triangle pr-0" aria-hidden="true"></i><span class="text-c-red"> Need to Check Deductions <i class="fa text-c-red blink fa-exclamation-triangle pr-0" aria-hidden="true"></i></span>
												@endif
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
								@if (!empty($reports[0]))
								<div class="pagination px-2">
									<span class="mt-2">Total records: {{ count($reports) }}</span>
								</div>
								@endif
							</div>

							<div class="hide-data cal-popip">
								<div class="modal-content modal-content-div conditional-ques">
									<div class="modal-header align-items-center py-2">
										<h5 class="modal-title d-flex w-100" id="invitemodalLabel">
											6 Month CMI Calculation
										</h5>
									</div>

									<!-- Debtor CMI calculation -->
									<div class="mt-4">
										@include('client.common_calculation_popup', ['allReport' => $debtorAllReport->toArray(), 'title' => "Debtor's Payroll Calculation"])
									</div>

									<!-- Co-Debtor CMI calculation -->
									@if ($User['client_type'] !== 1)
										<div class="">
											@include('client.common_calculation_popup', ['allReport' => $codebtorAllReport->toArray(), 'title' => "Co-Debtor's Payroll Calculation"])
										</div>
									@endif

								</div>


							</div>

							<div class="table-responsive d-none employer-section">
								<table class="table">
									<tbody>
										<tr>
											<th scope="col">Name</th>
											<th scope="col">Address</th>
											<th scope="col">Employment Duration</th>
											<th scope="col">Occupation</th>
											<th scope="col">Frequency</th>
											<th scope="col">Schedule</th>
											<th scope="col">Action</th>
										</tr>
										@php
										$emp_list = Helper::validate_key_value('emp_list', $employerData);

										$currentAndAdditionalShown = false;
										$previousEmployerShown = false;
										@endphp

										@if (!empty($emp_list))
											@foreach ($emp_list as $index => $list)
												@php
												$emp_added_by = Helper::validate_key_value('employer_added_by', $list, 'radio');
												$empAddress = '';
												$empAddress .= !empty(Helper::validate_key_value('employer_address', $list)) ? Helper::validate_key_value('employer_address', $list) : '';
												$empAddress .= !empty(Helper::validate_key_value('employer_city', $list)) ? ', ' . Helper::validate_key_value('employer_city', $list) : '';
												$empAddress .= !empty(Helper::validate_key_value('employer_state', $list)) ? ', ' . Helper::validate_key_value('employer_state', $list) : '';
												$empAddress .= !empty(Helper::validate_key_value('employer_zip', $list)) ? ', ' . Helper::validate_key_value('employer_zip', $list) : '';
												$emp_name = Helper::validate_key_value('employer_name', $list);
												$emp_id = Helper::validate_key_value('id', $list);
												$emp_type = Helper::validate_key_value('employer_type', $list, 'radio');
												@endphp
												@if (($emp_type == 1 || $emp_type == 99 || $emp_type == 0) && !$currentAndAdditionalShown)
													@php $currentAndAdditionalShown = true; @endphp
													<tr class="employer-name-header">
														<th colspan="9" class="px-3 py-2">
															<h6 class="mb-0 text-c-green width_max_content border-bottom-light-blue font-weight-bold">Current and Additional Employer(s):</h6>
														</th>
													</tr>
												@endif

												@if (($emp_type == 2) && !$previousEmployerShown)
													@php $previousEmployerShown = true; @endphp
													<tr class="employer-name-header">
														<th colspan="9" class="px-3 py-2">
															<h6 class="mb-0 text-c-red width_max_content border-bottom-light-blue font-weight-bold">Previous Employer(s):</h6>
														</th>
													</tr>
												@endif
												<tr class="employer-row employer-row-{{ $emp_id }}">
													<td>
														<span>
															@if ($emp_type == 99)
																<small class="text-bold text-danger">Added by Attorney</small></br>
															@else
																<small class="text-bold text-success">Client Questionnaire</small></br>
															@endif
															{{ $emp_name }}
														</span>
													</td>
													<td>{{ $empAddress }}</td>
													<td>{{ Helper::validate_key_value('employment_duration', $list) }}</td>
													<td>{{ Helper::validate_key_value('employer_occupation', $list) }}</td>
													<td>{{ Helper::getPayFrequencyLabel(Helper::validate_key_value('frequency', $list)) }}</td>
													@php
													$twice_month_selection = Helper::validate_key_value('twice_month_selection', $list);
													@endphp
													<td>
														@if (Helper::validate_key_value('frequency', $list, 'radio') == 3)
															@if (Helper::validate_key_value('twice_month_selection', $list, 'radio') == 0)
																1st & 15th of month
															@elseif (Helper::validate_key_value('twice_month_selection', $list, 'radio') == 1)
																15th & last day ({{ date("jS", strtotime("last day of this month")) }}) of the month
															@endif
														@endif
													</td>
													<td>
														<div class=" d-flex align-items-center">
															<button class="btn-new text-white btn option-btn dropdown-toggle" onclick="editEmployer('{{ $userId }}', '{{ $clType }}', '{{ $emp_id }}')" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																<i class="fas fa-pencil-square-o mr-1"></i> Edit
															</button>
															<a href="javascript:void(0)" onclick="deleteEmployer('{{ $userId }}', '{{ $clType }}','{{ $emp_id }}', '{{ $emp_name }}')">
																<button type="button" class="delete-div" title="Delete">
																	<i class="bi bi-trash3"></i>
																	Delete
																</button>
															</a>
														</div>
													</td>
												</tr>
											@endforeach
										@else
											<tr>
												<td colspan="6" class="text-center">No Records Found</td>
											</tr>
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	@push('styles')
	<link rel="stylesheet" href="{{ asset('css/paystub.css') }}">
	@endpush

	@push('scripts')
	<script>
		window.PaystubManagementConfig = {
			lastUrlSegment: '{{ last(request()->segments()) }}',
			clientId: '{{ $val['
			id '] }}',
			employerIds: @json($employer_ids),
			routes: {
				addNewPaystub: "{{ route('add_new_paystub') }}",
				newMonthlyPay: "{{ route('new_monthly_pay') }}",
				payCheckCalculation: "{{ route('pay_check_calculation') }}",
				copyPaystub: "{{ route('copy_paystub') }}",
				clonePaystub: "{{ route('clone_paystub') }}",
				editPaystub: "{{ route('edit_paystub') }}",
				showPaystubCalculation: "{{ route('show_paystub_calculation') }}",
				manageEmployer: "{{ route('manage_employer') }}",
				editEmployer: "{{ route('edit_employer') }}",
				deleteEmployer: "{{ route('delete_employer') }}",
				savePaystubDoc: "{{ route('save_paystub_doc') }}",
				processByGraphqlForAllEmployers: "{{ route('process_by_graphql_for_all_employers') }}",
				importDataToOtherPaystubs: "{{ route('import_data_to_other_paystubs') }}",
				calculationLogsPopup: "{{ route('calculation_logs_popup') }}",
				importDataToThisPaystubs: "{{ route('import_data_to_this_paystubs') }}"
			}
		};
	</script>
	<script src="{{ asset('js/paystub-management.js') }}"></script>
	@endpush
	@endsection
