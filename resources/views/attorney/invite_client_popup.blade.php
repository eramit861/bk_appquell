@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/invite-client-popup.css') }}">
@endpush

@php
    $authUser = Auth::user();
    $isLawFirmManagementEnabled = App\Models\AttorneySettings::isLawFirmManagementEnabled($authUser->id);
@endphp
<div class="modal invitemodel fade" id="add_attorney" tabindex="-1" aria-labelledby="invitemodalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content modal-content-div">
			<div class="modal-header align-items-center py-2">
				<h5 class="modal-title d-flex w-100" id="invitemodalLabel">
					<i class="bi bi-person-plus-fill me-2"></i> Invite Client(s)
				</h5>
				<a href="javascript:void(0)" class="close-modal btn-new-ui-default bg-white att-video py-1 me-2" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $invite_video['en'] }}" data-video2="{{ $invite_video['sp'] }}">
					<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" alt="Video Logo" style="height: 26px;">
				</a>

				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body p-0">
				<div class="card-body min-height b-0-i">
					<form id="invite_form" action="{{route('attorney_client_add')}}" method="post" novalidate>
						@csrf

						<!-- select plan section -->
						<div class="light-gray-div mt-3">
							<h2>Step 1: Select Questionnaire Type</h2>
							<div class="row gx-3">

								<div class="col-12">
									<div class="light-gray-box-tittle-div mb-3 pb-1">
										<h2>Questionnaire Type details</h2>

									</div>
								</div>
								<div class="col-12 col-sm-6 col-md-4">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Select Questionnaire Type <span class="ms-2" onclick="helpPopup('client_subscription')"><i class="bi bi-question-circle"></i></span></label>
											<select required class="form-control required" name="client_subscription" id="client_subscription">
												<option value="">Choose a Questionnaire</option>
												{!! AddressHelper::getSubscriptionSelection(old('client_subscription')) !!}
											</select>
										</div>
										@if ($errors->has('client_subscription'))
											<p class="help-block text-danger mt-2">{{ $errors->first('client_subscription') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-4">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Select Client Filing Type <span class="ms-2" onclick="helpPopup('client_type')"><i class="bi bi-question-circle"></i></span></label>
											<select required class="form-control required" name="client_type" id="invite_client_type" ></select>
										</div>
										@if ($errors->has('client_type'))
											<p class="help-block text-danger mt-2">{{ $errors->first('client_type') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-4 enable-page-kr">
								<div class="d-flex align-items-center label-div mb-0">
										<div class="form-check float_right me-3  primary-contact-kr {{ (isset($attorney_detailed_property_enabled) && $attorney_detailed_property_enabled != 1) ? 'hide-data' : '' }}">
											<input type="checkbox" name="detailed_property" id="detailed_property" class="form-check-input toggle-btn" value="1" {{ old('detailed_property') === '1' ? 'checked="true"' : '' }}>
											<label class="form-check-label" for="detailed_property">Enable Detailed Property Page
												<span onclick="helpPopup('detailed_property')"><i class="bi bi-question-circle"></i></span>
											</label>
										</div>
									</div>
								</div>

								<input type="hidden" id="request_id" name="onepage_questionnaire_request_id" value="0">




								<div class="col-12 col-sm-6 col-md-4 {{ $isLawFirmManagementEnabled && isset($associates) && !empty($associates) ? '' : 'hide-data' }}">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Choose Law Firm</label>
											<select class="form-control" name="associate_from_law_firm" id="associate_from_law_firm" >
												<option value="">Choose Law Firm</option>
												@foreach ($associates as $key => $associate)
												    <option value="{{ $associate['id'] }}" {{ old('associate_from_law_firm') == $associate['id'] ? 'selected' : '' }}>
												        {{ $associate['firstName'] }} {{ $associate['lastName'] }}
												    </option>
												@endforeach
											</select>
										</div>
										@if ($errors->has('associate_from_law_firm'))
											<p class="help-block text-danger mt-2">{{ $errors->first('associate_from_law_firm') }}</p>
										@endif
									</div>
								</div>

							</div>
						</div>

						<!-- client details section -->
						<div class="light-gray-div mt-3">
							<h2>Step 2: Client Info</h2>
							<div class="row gx-3">
								<!-- debtor details -->
								<div class="col-12">
									<div class="light-gray-box-tittle-div mb-3 pb-1">
										<h2>Debtor 1 details</h2>  
									</div>
								</div>
								<div class="form-check float_right primary-contact-kr">
											<input type="checkbox"
												name="client_send_invite"
												id="d1PrimayContact"
												class="form-check-input toggle-btn"
												value="1"
												{{ old('client_send_invite') === '1' ? 'checked="true"' : '' }}
												onchange="toggleCheckbox(this)">
											<label class="form-check-label" for="d1PrimayContact">Primary Contact (Invite Recipient)</label>
										</div>
								<div class="col-12 col-sm-6 col-md-3">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="">First Name</label>
											<input required name="first_name" type="text" id="client_first_name" value="{{ old('first_name') }}" class="input_capitalize form-control {{ $errors->has('first_name') ? 'btn-outline-danger' : '' }}" placeholder="First Name"  >
										</div>
										@if ($errors->has('first_name'))
											<p class="help-block text-danger mt-2">{{ $errors->first('first_name') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-3">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="">Last Name</label>
											<input required name="last_name" type="text" id="client_last_name" value="{{ old('last_name') }}" class="input_capitalize form-control {{ $errors->has('last_name') ? 'btn-outline-danger' : '' }}" placeholder="Last Name"  >
										</div>
										@if ($errors->has('last_name'))
											<p class="help-block text-danger mt-2">{{ $errors->first('last_name') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-3">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="">Email</label>
											<input required name="email" type="text" id="client_email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'btn-outline-danger' : '' }}" placeholder="Email"  >
										</div>
										@if ($errors->has('email'))
											<p class="help-block text-danger mt-2">{{ $errors->first('email') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-3">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="">Mobile # (To Text Invite) <span class="ms-2" onclick="helpPopup('phone_no')"><i class="bi bi-question-circle"></i></span></label>
											<input required name="phone_no" type="text" id="client_phone" value="{{ old('phone_no') }}" class="input-border form-control phone-field {{ $errors->has('phone_no') ? 'btn-outline-danger' : '' }}" placeholder="Mobile No"  >
										</div>
										@if ($errors->has('phone_no'))
											<p class="help-block text-danger mt-2">{{ $errors->first('phone_no') }}</p>
										@endif
									</div>
								</div>

								<!-- co-debtor details -->
								<div class="col-12 mt-2 debtor_2_details d-none primary-contact-kr">
									<div class="light-gray-box-tittle-div mb-3 pb-1">
										<h2>Debtor 2 details</h2>

									</div>
									<div class="form-check float_right">
											<input type="checkbox" name="client_send_invite" id="d2PrimayContact" class="form-check-input toggle-btn" value="2" {{ old('client_send_invite') === '2' ? 'checked="true"' : '' }} onchange="toggleCheckbox(this)">
											<label class="form-check-label" for="d2PrimayContact">Primary Contact (Invite Recipient)</label>
										</div>
								</div>

								<div class="col-3 debtor_2_details d-none">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="spouse_first_name">First Name</label>
											<input required name="spouse_first_name" type="text" id="spouse_first_name" value="{{ old('spouse_first_name') }}" class="input_capitalize form-control {{ $errors->has('spouse_first_name') ? 'btn-outline-danger' : '' }}" placeholder="First Name"  >
										</div>
										@if ($errors->has('spouse_first_name'))
											<p class="help-block text-danger mt-2">{{ $errors->first('spouse_first_name') }}</p>
										@endif
									</div>
								</div>

								<div class="col-3 debtor_2_details d-none">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="spouse_last_name">Last Name</label>
											<input required name="spouse_last_name" type="text" id="spouse_last_name" value="{{ old('spouse_last_name') }}" class="input_capitalize form-control {{ $errors->has('spouse_last_name') ? 'btn-outline-danger' : '' }}" placeholder="Last Name"  >
										</div>
										@if ($errors->has('spouse_last_name'))
											<p class="help-block text-danger mt-2">{{ $errors->first('spouse_last_name') }}</p>
										@endif
									</div>
								</div>

								<div class="col-3 debtor_2_details d-none">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="spouse_email">Email</label>
											<input required name="spouse_email" type="text" id="spouse_email" value="{{ old('spouse_email') }}" class="form-control {{ $errors->has('spouse_email') ? 'btn-outline-danger' : '' }}" placeholder="Email"  >
										</div>
										@if ($errors->has('spouse_email'))
											<p class="help-block text-danger mt-2">{{ $errors->first('spouse_email') }}</p>
										@endif
									</div>
								</div>

								<div class="col-3 debtor_2_details d-none">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="spouse_cell">Mobile # (To Text Invite) <span class="ms-2" onclick="helpPopup('spouse_cell')"><i class="bi bi-question-circle"></i></span></label>
											<input required name="spouse_cell" type="text" id="spouse_cell" value="{{ old('spouse_cell') }}" class="input-border form-control phone-field {{ $errors->has('spouse_cell') ? 'btn-outline-danger' : '' }}" placeholder="Mobile No"  >
										</div>
										@if ($errors->has('spouse_cell'))
											<p class="help-block text-danger mt-2">{{ $errors->first('spouse_cell') }}</p>
										@endif
									</div>
								</div>

								<div class="">
									<input type="hidden" class="form-control" id="client_attorney" name="client_attorney" value="{{ $authUser->id }}">
									@if ($errors->has('client_attorney'))
										<p class="help-block text-danger">{{ $errors->first('client_attorney') }}</p>
									@endif
								</div>

							</div>
						</div>

						<!-- Step 3 -->
						<div class="light-gray-div mt-3 add_on_features_div">
							<h2>Step 3: Optional Add-On Features (Additional Cost)</h2>
							<div class="row gx-3">

								<div class="col-12">
									<div class="d-flex align-items-center label-div mb-0">

										<div class="d-flex align-items-center label-div mb-0">
											<div class="form-check concierge_service primary-contact-kr p-0">
												<input type="checkbox" name="concierge_service" id="concierge_service" class="form-check-input toggle-btn" value="1" {{ old('concierge_service') === '1' ? 'checked="true"' : '' }}>
												<label class="form-check-label" for="concierge_service">Concierge Service <span class="ms-2" onclick="helpPopup('concierge_service')"><i class="bi bi-question-circle"></i></span></label>
											</div>
										</div>
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-4">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Choose payroll assistant <span class="ms-2" onclick="helpPopup('payroll_assistant')"><i class="bi bi-question-circle"></i></span></label>
											<select required class="form-control required " name="client_payroll_assistant" id="client_payroll_assistant" >
												{!! ArrayHelper::getPayrollAssitantSelection(old('client_payroll_assistant')) !!}
											</select>
										</div>
										@if ($errors->has('client_payroll_assistant'))
											<p class="help-block text-danger mt-2">{{ $errors->first('client_payroll_assistant') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-4">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Choose bank statements <span class="ms-2" onclick="helpPopup('bank_statement')"><i class="bi bi-question-circle"></i></span></label>
											<select required class="form-control required" name="client_bank_statements" id="client_bank_statements" >
												{!! Helper::getBankStatementsSelection(old('client_bank_statements')) !!}
											</select>
										</div>
										@if ($errors->has('client_bank_statements'))
											<p class="help-block text-danger mt-2">{{ $errors->first('client_bank_statements') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 col-sm-6 col-md-4">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Choose profit loss assistant <span class="ms-2" onclick="helpPopup('profit_loss')"><i class="bi bi-question-circle"></i></span></label>
											<select required class="form-control required" name="client_profit_loss_assistant" id="client_profit_loss_assistant" >
												{!! Helper::getProfitLossAssitantSelection(old('client_profit_loss_assistant')) !!}
											</select>
										</div>
										@if ($errors->has('client_profit_loss_assistant'))
											<p class="help-block text-danger mt-2">{{ $errors->first('client_profit_loss_assistant') }}</p>
										@endif
									</div>
								</div>
								<div class="col-12 col-sm-6 col-md-4">
									<div class="label-div">
										<div class="form-group mb-0">
											<label class="">Choose Credit Report <span class="ms-2" onclick="helpPopup('credit_report')"><i class="bi bi-question-circle"></i></span><span class="text-c-green font-weight-bold report_included"></span></label>
											<select required class="form-control required" name="client_credit_report" id="client_credit_report" >
												{!! Helper::getCreditReportSelection(old('client_credit_report')) !!}
											</select>
										</div>
										@if ($errors->has('client_credit_report'))
											<p class="help-block text-danger mt-2">{{ $errors->first('client_credit_report') }}</p>
										@endif
									</div>
								</div>
							</div>
						</div>

						@if (!empty($iDocStatus))
                            @php
                                $documentList1 = Helper::getDocuments(1, false, 1, 1, 0, 0, $authUser->id);
                                $documentList2 = Helper::getDocuments(2, false, 1, 1, 0, 0, $authUser->id);
                                $documentList3 = Helper::getDocuments(3, false, 1, 1, 0, 0, $authUser->id);
                                $documentList1 = $documentList1 + Helper::getMiscDocs();
                                $documentList2 = $documentList2 + Helper::getMiscDocs();
                                $documentList3 = $documentList3 + Helper::getMiscDocs();
                                unset($documentList1['Debtor_Creditor_Report']);
                                unset($documentList2['Debtor_Creditor_Report']);
                                unset($documentList3['Debtor_Creditor_Report']);
                                unset($documentList1['Co_Debtor_Creditor_Report']);
                                unset($documentList2['Co_Debtor_Creditor_Report']);
                                unset($documentList3['Co_Debtor_Creditor_Report']);
                                $excludedocs = \App\Models\AttorneyExcludeDocs::where(['attorney_id' => $authUser->id, 'is_associate' => 0])->first();
                                $excludedocs = !empty(json_decode($excludedocs)) && !empty($excludedocs->doc_type_json) ? json_decode($excludedocs->doc_type_json, 1) : [];
                            @endphp

						<div class="light-gray-div mt-3 doc_list d-none">
							<h2>Client Document Request List</h2>
							<div class="row gx-3">

								@include('attorney.client_document_request_list',['documentList' => $documentList1, 'doc_list_name' => 'doc_list_1'])
								@include('attorney.client_document_request_list',['documentList' => $documentList2, 'doc_list_name' => 'doc_list_2'])
								@include('attorney.client_document_request_list',['documentList' => $documentList3, 'doc_list_name' => 'doc_list_3'])
								<!-- Common Document List -->
								@include('attorney.invite_popup_common_attorney_docs_list')

								<div class="col-xl-12 col-lg-12 col-md-12 mt-3 doc_list d-none">
									<div class="light-gray-box-tittle-div mb-3 pb-1">
										<h2>Client Document Request List Internal Section</h2>

									</div>
								</div>
								<div class="col-xl-4 col-lg-6 col-md-12 mt-1 doc_list new_doc_div d-none">
									<div class="label-div">
										<div class="form-group mb-0">
											<label for="new_document_1">New Document 1</label>
											<input name="new_document[1]" type="text" id="new_document_1" value="{{ old('new_document[1]') }}" class="input_capitalize form-control {{ $errors->has('new_document[1]') ? 'btn-outline-danger' : '' }}" placeholder="Name" maxlength="100" >
										</div>
										@if ($errors->has('new_document'))
											<p class="help-block text-danger mt-2">{{ $errors->first('new_document') }}</p>
										@endif
									</div>
								</div>

								<div class="col-12 mb-3 doc_list d-none ">
									<a href="javascript:void(0)" onclick="addNewDocument();" class="btn-new-ui-default py-1 px-2 me-3">+ Add More</a>
									<a href="javascript:void(0)" onclick="deleteNewDocument();" class="delete-btn-new-ui-default">Remove</a>
								</div>
							</div>
						</div>

						@endif

						<div class="bottom-btn-div">
							<button type="button" class="btn-new-ui-default print-hide closeButton cursor-pointer mb-0 me-3" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn-new-ui-default print-hide submitButton cursor-pointer mb-0" onclick="checkPackageAvailablity(this);showSpinner();" >Invite Client(s)</button>
						</div>

						<div id="loader" class="spinner">
							<img style="position: absolute;top: 50%;left: 50%;" src="{{url('/assets/img/loading2.gif')}}" alt="loading" />
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>

@push('scripts')
<script>
    window.InviteClientPopupConfig = {
        routes: {
            helpPopup: "{{ route('helpPopup') }}"
        },
        selectionHtml: {
            clientType: "{!! trim(preg_replace('/\s+/', ' ', addslashes(ArrayHelper::getClientTypeSelection(old('client_type'))))) !!}"
        },
        priceMaps: {
            packagePrice: {!! json_encode(AddressHelper::getPackagePriceClientTypeWise()) !!},
            bankStatement: {!! json_encode(AddressHelper::getBankStatementPackagePriceClientTypeWise()) !!},
            bankStatementPremium: {!! json_encode(\App\Models\AttorneySubscription::packageBankStatementPriceClientTypeWisePremium()) !!},
            profitLoss: {!! json_encode(AddressHelper::getProfitLossPackagePriceClientTypeWise()) !!},
            creditReport: {!! json_encode(\App\Models\AttorneySubscription::packageCreditReportPriceClientTypeWise()) !!}
        },
        arrays: {
            payrollAssistant: {!! json_encode(ArrayHelper::getPayrollAssistantArray()) !!},
            bankStatements: {!! json_encode(Helper::getBankStatementsArray()) !!},
            profitLossAssistant: {!! json_encode(Helper::getProfitLossAssistantArray()) !!},
            creditReportAssistant: {!! json_encode(Helper::getCreditReportArray()) !!}
        },
        showModalOnError: {{ $errors->any() ? 'true' : 'false' }}
    };
</script>
<script src="{{ asset('assets/js/attorney/invite-client-popup.js') }}"></script>
@endpush