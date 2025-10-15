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
    
    if ($User->client_type == 2) {
        $spousename = "Non-Filing Spouse's";
    }
    
    $loggedInUserName = 'BKQ Admin';
    if (!empty($loggedInUser)) {
        $loggedInUserName = ($loggedInUser->role == 1) ? 'BKQ Admin' : $loggedInUser->name;
    }
    
    $attorney_id = Helper::getCurrentAttorneyId();
    $unreadcount = \App\Models\SignedDocuments::where(['attorney_id' => $attorney_id, 'client_id' => $val['id'], 'read_by_attorney' => 0])->whereNotNull('sign_document')->count();
    $notIn = ['document_sign', 'signed_document'];
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

    // Sort link function
    function sort_link($column, $label, $currentSort, $currentDirection) {
        $direction = ($currentSort == $column && $currentDirection == 'asc') ? 'desc' : 'asc';
        $icon = '<i class="bi bi-filter-left"></i>';

        if ($currentSort == $column) {
            $icon = $currentDirection == 'asc' ? '<i class="bi bi-caret-up-fill"></i>' : '<i class="bi bi-caret-down-fill"></i>';
        }

        $query = array_merge(request()->query(), ['sort' => $column, 'direction' => $direction]);
        return '<a href="'.request()->url().'?'.http_build_query($query).'">'.$label.' '.$icon.'</a>';
    }

    // Process loan type mapping
    $availableTypes = collect($reportAll)
        ->pluck('creditLoanType')
        ->unique()
        ->filter()
        ->values();

    $filteredLoanTypeMap = collect($creditLoanTypeMap)
        ->only($availableTypes)
        ->toArray();

    // Add types from $availableTypes not present in $creditLoanTypeMap
    $missingTypes = $availableTypes->diff(array_keys($creditLoanTypeMap));
    foreach ($missingTypes as $type) {
        $filteredLoanTypeMap[$type] = $type;
    }

    // Normalize keys to lowercase to avoid duplicates with different cases
    $normalizedLoanTypeMap = [];
    foreach ($filteredLoanTypeMap as $key => $label) {
        $lowerKey = mb_strtolower($key);
        // Only keep the first occurrence (or you can decide to overwrite)
        if (!isset($normalizedLoanTypeMap[$lowerKey])) {
            $normalizedLoanTypeMap[$lowerKey] = $label;
        }
    }
    
    // Sort by label
    $filteredLoanTypeMap = collect($normalizedLoanTypeMap)
        ->sortBy(fn ($label) => $label, SORT_NATURAL | SORT_FLAG_CASE);

    $checkKeys = ['unsecured', 2, 3, 4, 5, 6, 7];

    if ($filteredLoanTypeMap->keys()->intersect($checkKeys)->isNotEmpty()) {
        $filteredLoanTypeMap->put('unsecured', 'All Unsecured Debt');
    }
    
    $desiredOrder = [8, 11, 10, 'unsecured', 7, 3, 2, 6, 4, 5];

    $filteredLoanTypeMap = collect($desiredOrder)
        ->filter(fn ($key) => $filteredLoanTypeMap->has($key))
        ->mapWithKeys(fn ($key) => [$key => $filteredLoanTypeMap->get($key)]);
@endphp

<div class="row">
	<!-- @include("attorney.client.common",["video" => $video,'totals' => $totals, 'val' => $val, 'type' => $type]) -->
	@include('attorney.client.manage.common_client_description')

	<div class="col-12">
		<div class="card information-area mt-3">

			@include('attorney.client.manage.common_tab_links')

			<div class="card-body border-top-left-radius-none">
				<div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
					<div class="tab-pane fade show active mcard-body" id="active" role="tabpanel" aria-labelledby="" tabindex="0">

						<div class="row m-0">

							<div class="row credit-reports-btn-set-1 m-0">
								<div class="col-12 col-md-6 px-1">
									@if(!empty(trim($debtorName)))
									<a href="{{ route('attorney_edit_client_report', ['id' => $User['id'], 'dType' => 1]) }}"
										class="btn btn-new-ui-default w-100 mw-mc {{ $dType == '1' ? 'is_active' : '' }} text-nowrap">
										{{ $debtorName }}
									</a>
									@endif
								</div>
							
								<div class="col-12 col-md-6 px-1">
									@if(($User['client_type'] == 2 || $User['client_type'] == 3) && (!empty(trim($codebtorName))))
									<a href="{{ route('attorney_edit_client_report', ['id' => $User['id'], 'dType' => 2]) }}"
										class="btn btn-new-ui-default w-100 mw-mc {{ $dType == '2' ? 'is_active' : '' }} text-nowrap">
										{{ $codebtorName }}
									</a>
									@endif
								</div>
							
								<div class="col-12 col-md-4 px-1">
									<a href="javascript:void(0)" onclick="manualImportPopup('{{ $User['id'] }}')" class="btn btn-new-ui-default p-10px w-100 mw-mc">
										<i class="feather icon-plus"></i>
										<span class="">{{ __('Add Creditors') }}</span>
									</a>
								</div>
								<div class="col-12 col-md-4 px-1">
									<a href="javascript:void(0)" onclick="deleteSelected('{{ $User['id'] }}')" class="btn btn-new-ui-default p-10px w-100 mw-mc">
										<span class=""><i class="fas fa-trash mr-1"></i> Delete Selected</span>
									</a>
								</div>								
								<div class="col-12 col-md-4 px-1 position-relative">
									@if (!empty($filteredLoanTypeMap))
										<form method="GET" action="{{ route('attorney_edit_client_report', ['id' => $User['id'], 'dType' => $dType]) }}">
											<div class="light-gray-div border-0 p-0 m-0">
												<div class="label-div">
													<div class="form-group mb-0">
														<!-- Display input -->
														<label id="credit_type" class="form-control mb-0 fs-14px-i d-flex-ai-center">Sort Creditors By:</label>

														<!-- Custom dropdown -->
														<ul class="custom-time-dropdown w-auto" id="timeDropdown" style="display: none;">
															<!-- <li class="dropdown-option">Sort Creditors By</li> -->
															@foreach ($filteredLoanTypeMap as $key => $label)
																<li class="dropdown-option {{ $key == 'unsecured' ? 'list-heading' : '' }}">
																	<label class="mb-0 d-flex-ai-center">
																		<input type="checkbox" class="credit-checkbox mr-2" name="credit_type[]" value="{{ $key }}" {{ in_array($key, $selectedCreditType ?? []) ? 'checked' : '' }}>
																		{{ $label }}
																	</label>
																</li>
															@endforeach
														</ul>
													</div>
												</div>
											</div>
										</form>
									@endif
								</div>
							</div>

							<div class="row justify-content-end credit-reports-btn-set-2 m-0">
								<div class="col-12 col-xl-5 col-lg-5 col-md-6 col-sm-12 pl-1 pr-1">
									<a href="javascript:void(0)" onclick="importUnsecuredToClient('{{ $User['id'] }}')" class="btn btn-new-ui-default m-0 w-100 mw-mc">
										<span class="">Import all unsecured to client questionnaire</span>
									</a>
								</div>
								@include('client.common_client_upload_view',['docsUploadInfo' => $docsUploadInfo, 'client_id' => $client_id, 'isManualPage' => false,'isUnsecuredPage' => true, 'user' =>$authUser])
								@include('client.uploaddoc_mode', ['max_size' => 200, 'isManual' => false,'route' => route('cin_report_upload'),'isUnsecuredPage' => true])

								<div class="col-6 col-xl-2 col-lg-2 col-md-6 col-sm-6 pl-1 pr-1">
									<a href="javascript:void(0)" onclick="csvImportPopup('{{ $User['id'] }}')" class="btn btn-new-ui-default m-0 w-100 mw-mc">
										<span class="">Import CSV</span>
									</a>
								</div>
							</div>
						</div>

						<h4 class="card-title"></h4>

						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<th scope="col">
											<input type="checkbox" id="selectAll" onclick="toggleSelectAll(this)">
										</th>
										<th scope="col">{{ __('Import to Schedule') }}</th>
										<th>{!! sort_link('fullName', 'Creditor', $sort, $direction) !!}</th>
										<th>{!! sort_link('creditLiabilityAccountIdentifier', 'Account #', $sort, $direction) !!}</th>
										<th>{!! sort_link('address', 'Address', $sort, $direction) !!}</th>
										<!--th>{!! sort_link('creditLiabilityAccountOwnershipType', 'Ownership', $sort, $direction) !!}</th-->
										<th>{!! sort_link('date_incurred', 'Date Issue', $sort, $direction) !!}</th>
										<th>{!! sort_link('creditLoanType', 'Credit Type', $sort, $direction) !!}</th>
										<th>{!! sort_link('creditLiabilityPastDueAmount', 'Amount Due', $sort, $direction) !!}</th>
									</tr>
									@php
                                        $list = $report;
                                    @endphp
									@if (!empty($list))
										@foreach ($list as $val)
											<tr class="unread row-{{ $val['id'] }} {{ $val['is_imported'] == 1 ? 'drop-green' : 'drop-red' }}">
												<td>
													<div class="d-flex-ai-center">
														<input type="checkbox" class="select-row" value="{{ $val['id'] }}">
														@if ($val['is_ai_processed'])
															<img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon ms-2" style="height:24px" alt="AI">
														@endif
														@if ($val['manual_added_by_client'])
															<i class="bi bi-person-fill ms-2 text-c-green" style="font-size:24px"></i>
														@endif
														@if ($val['csv_data'])
															@php
																$path = null;
																if (config('filesystems.disks.s3.bucket')) {
																	try {
																		$path = \Storage::disk('s3')->temporaryUrl($val['csv_data'], now()->addDays(2));
																	} catch (\Exception $e) {
																		\Log::error('S3 temporaryUrl failed in credit_report: ' . $e->getMessage());
																		$path = null;
																	}
																}
															@endphp
															@if($path)
																<a target="_blank" href="{{ $path }}" download>
																	<i class="bi bi-filetype-csv ms-2" style="font-size:24px"></i>
																</a>
															@endif
														@endif
													</div>
												</td>
												<td>
													<div class="light-gray-div p-0 m-0 b-0-i mr-3">
														<div class="label-div m-0 b-0-i">
															<select class="import_to_schedule form-control" onchange="importToSchedule('{{ $val['id'] }}','{{ $User['id'] }}', this)" name="import_to_schedule">
																<option value="">{{ __('Select') }}</option>
																<option value="Mortgage">{{ __('D - Mortgage') }}</option>
																<option value="Auto">{{ __('D - Auto') }}</option>
																<option value="Installment Loan">{{ __('D - Installment Loan') }}</option>
																<option value="State Taxes">{{ __('E - State Taxes') }}</option>
																<option value="Federal Taxes">{{ __('E - Federal Taxes') }}</option>
																<option value="DSO">{{ __('E - DSO') }}</option>
																<option value="F Debt Tab">{{ __('F - Unsecured Debt') }}</option>
															</select>
														</div>
													</div>
												</td>
												<td>
													<span>{{ $val['fullName'] }}</span>
													@if ($val['client_confirm'] == 1)
														<br><span class="text-c-green">Debtor(s) want to include this debt</span>
													@endif
													@if ($val['client_confirm'] == 2)
														<br><span class="text-c-red">Debtor(s) want to exclude this debt</span>
													@endif
												</td>
												<td><span>{{ substr($val['creditLiabilityAccountIdentifier'], -4) }}</span></td>
												<td><span>{{ $val['address'] }},<br> {{ $val['city'] }}, {{ $val['state'] }} {{ $val['zip'] }}</span></td>
												<!--td><span>{{ $val['creditLiabilityAccountOwnershipType'] }}</span></td-->
												<td>
													@if (empty($val['date_incurred']))
														<div class="d-flex-ai-center">
															<input type="text" id="date_input_{{ $val['id'] }}" class="form-control date_month_year py-1 w-100px" placeholder="MM/YYYY">
															<a href="javascript:void(0);" class="view_client_btn ms-2" data-bs-toggle="modal" onclick="saveDateIncurred(this, '{{ $client_id }}', '{{ $val['id'] }}');">Save</a>
														</div>
													@else
														<span>{{ $val['date_incurred'] }}</span>
													@endif
												</td>
												<td>
													<span>
														{{ in_array($val['creditLoanType'], array_keys(AddressHelper::getDebtSelection())) ? AddressHelper::getDebtSelection($val['creditLoanType']) : $val['creditLoanType'] }}
													</span>
												</td>
												<td><span>{{ Helper::formatPrice($val['creditLiabilityPastDueAmount']) }}</span></td>
											</tr>
										@endforeach
									@else
										<tr class="unread text-center">
											<td colspan="9">{{ __('No Record Found.') }}</td>
										</tr>
									@endif
								</tbody>
							</table>

							<div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">
								@if (count($list))
								<div class="shoing">
									Showing {{ 1 }} to {{ count($list) }} of {{ count($list) }} entries
								</div>
								@endif
							</div>
						</div>

						<div class="row mt-4">
							<!--[ Recent Users ] start-->
							<div class="col-xl-12 col-md-12">

								<div class="card-block px-0 py-0">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>

											</thead>
											<tbody>

											</tbody>
										</table>
									</div>
									<div class="pagination px-2">
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<style>
	.w-100px {
		width: 100px !important;
	}

	.card {
		margin-bottom: 0px;
	}

	.medium-fb-width {
		margin-top: 30px !important;
	}
</style>

<!-- Include optimized JavaScript -->
<script src="{{ asset('js/credit-report.js') }}"></script>
<script>
	// Initialize Credit Report Manager
	document.addEventListener('DOMContentLoaded', function() {
		const creditReportConfig = {
			routes: {
				deleteCreditor: "{{ route('delete_crs_creditor') }}",
				importSchedule: "{{ route('import_schedule') }}",
				manualImport: "{{ route('manual_import_schedule') }}",
				csvImport: "{{ route('csv_import_popup') }}",
				cinReport: "{{ route('cin_report_popup') }}",
				cinReview: "{{ route('cin_report_review') }}",
				importUnsecured: "{{ route('import_unsecured_to_client') }}",
				saveDateIncurred: "{{ route('save_creditor_incurred_date') }}"
			},
			clientId: "{{ $User['id'] }}",
			messages: {
				noCreditorSelected: "No Creditor selected.",
				deleteSingle: "Are you sure you want to delete the selected creditor?",
				deleteMultiple: "Are you sure you want to delete the selected creditors?",
				importConfirm: "Are you sure you want to import this creditor to",
				importUnsecuredConfirm: "Are you sure you want to import these creditors to Unsecured Debts?",
				dateImportConfirm: "Are you sure you want to import date to this creditor?"
			}
		};

		// Initialize the credit report manager
		window.creditReportManager = new CreditReportManager(creditReportConfig);
	});
</script>
@endsection