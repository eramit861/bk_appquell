@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")

<?php
    $filterParalegalId = $filterParalegalId ?? '';
$filterAssociateId = $filterAssociateId ?? '';
$paralegal_section = Helper::getParalegalSelection($filterParalegalId, true);
?>

<div class="row client_management">
	<div class="col-12">
		<div class="mcard ">
			<div class="mcard-body with-btn">
				<div class="card-title-header">
					<div class="row ">
						<div class="col-12 col-sm-3 d-flex align-items-center">
							<h4 class="card-title pb-0 mb-0 bb-0-i">
								<i class="bi bi-briefcase"></i> <span class="w-100">Client Management</span>
							</h4>
						</div>
						<div class="col-12 col-sm-6 d-flex align-items-center justify-content-center">
							<a class="btn-new-ui-default bg-white py-1 atty_video_btn text-center" style="min-width: 250px" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="<?php echo $video['en']; ?>" data-video2="<?php echo $video['sp']; ?>">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" alt="Video Logo" style="height: 26px;">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()"><img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px" alt="AI Logo"> See AI Processed Docs Status</a>
						</div>
						<div class="col-12 col-sm-3 d-flex align-items-center">
							<button class="btn btn-primary float_right btn-new-ui-default m-0 ml-auto w-100 atty_invite_btn" style="max-width: 250px;" onclick="$('#add_attorney').modal('show');">
								<i class="feather icon-plus"></i> INVITE
							</button>
						</div>
					</div>
				</div>

				<div class="short_div flex-wrap flex-lg-nowrap">
					<div class="show w-100 d-flex align-items-center">
						<form action="{{ route('attorney_client_management',$type) }}" method="GET" id="paginationForm" class="d-flex align-items-center w-100 flex-wrap flex-md-nowrap">
							<div class="w-100 d-flex align-items-center label-div">
								<label for="per_page" class="mb-0 per_page">Show:</label>
								<select name="per_page" id="per_page" class="per_page form-select form-control w-auto" onchange="document.getElementById('paginationForm').submit();">
									<option value="10" <?php echo request('per_page') == 10 ? 'selected' : ''; ?>>10</option>
									<option value="25" <?php echo request('per_page') == 25 ? 'selected' : ''; ?>>25</option>
									<option value="50" <?php echo request('per_page') == 50 ? 'selected' : ''; ?>>50</option>
									<option value="100" <?php echo request('per_page') == 100 ? 'selected' : ''; ?>>100</option>
								</select>
							</div>
							<div class=" d-flex align-items-center mt-2 mt-md-0 flex-column flex-sm-row">
								<div class="d-flex align-items-center w-100 label-div">
									<label for="filter_paralegal" class="mb-0 per_page">Paralegal:</label>
									<select name="filter_paralegal" id="filter_paralegal" class="per_page form-select form-control w-auto me-3" onchange="console.log('here');document.getElementById('paginationForm').submit();">
										<option value="">Choose Paralegal</option>
										<?php echo $paralegal_section; ?>
									</select>
								</div>
								@if(!empty($associates))
								<div class="d-flex align-items-center mt-2 mt-sm-0 label-div">
									<label for="filter_associate" class="mb-0 per_page ">Law&nbsp;Firm:</label>
									<select name="filter_associate" id="filter_associate" class="per_page form-select form-control w-auto me-3" onchange="console.log('here');document.getElementById('paginationForm').submit();">
										<option value="">Choose Law Firm</option>
										<?php foreach ($associates as $key => $associate) {
										    echo '<option value="' . $associate['id'] . '" ' . ($filterAssociateId == $associate['id'] ? 'selected' : '') . '>' . $associate['firstName'] . ' ' . $associate['lastName'] . '</option>';
										} ?>
									</select>
								</div>
								@endif
							</div>
						</form>
					</div>
					<div class="search-field mt-2 mt-lg-0">
						<form class="d-flex align-items-center h-100 sr" id="searchForm" action="{{route('attorney_client_management',$type)}}" method="GET">
							<span>Search</span>
							<div class="input-group mb-0">
								<div class="input-group-prepend bg-transparent" onclick="document.getElementById('searchForm').submit();">
									<i class="bi bi-search input-group-text border-0 "></i>
								</div>
								<input type="text" name="q" class="form-control bg-transparent border-0" placeholder="Search" value="{{@$keyword}}">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12">
		<div class="card information-area mt-3">
			<ul class="nav nav-pills nav-fill w-100 p-0" id="pills-tab" role="tablist">
				@if(!empty(Auth::user()->parent_attorney_id))
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'all_firm_clients') {
					    echo "active";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'all_firm_clients'); ?>')"
						id="all-firm-client-tab" data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button" role="tab" aria-controls="all-firm-client" aria-selected="true">All Law Firm Clients</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'assigned_to_me') {
					    echo "active";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'assigned_to_me'); ?>')"
						id="clients-assigned-to-me-tab" data-bs-toggle="pill" data-bs-target="#clients-assigned-to-me" type="button" role="tab" aria-controls="clients-assigned-to-me" aria-selected="true">Client Assigned To Me</button>
				</li>
				<?php if (!empty($enabled_menu_items) && array_key_exists('attorney_client_management_invited', $enabled_menu_items) && Helper::validate_key_value('attorney_client_management_invited', $enabled_menu_items, 'radio') == 1) { ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'invited') {
					    echo "active nav-link-invited";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'invited'); ?>')"
						id="invited-tab" data-bs-toggle="pill" data-bs-target="#invited" type="button" role="tab" aria-controls="invited" aria-selected="true">Invited</button>
				</li>
				<?php } ?>
				<li class="nav-item" role="presentation">
					<?php $unreadMsgBG = (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'nav-link-archived' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'nav-link-active' : ''); ?>
					<?php $unreadMsgTxt = (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'nav-link-archived-text' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'nav-link-active-text' : ''); ?>

					<button class="nav-link <?php if ($type == 'unread_message') {
					    echo "active ";
					    echo $unreadMsgBG;
					} ?> <?php echo $unreadMsgTxt; ?>"
						onclick="redirectToURL('<?php echo route('attorney_client_management', 'unread_message'); ?>')"
						id="new-text-message-tab" data-bs-toggle="pill" data-bs-target="#new-text-message" type="button" role="tab" aria-controls="new-text-message" aria-selected="true">New Text Messages <?php if (isset($unreadMessageCount) && $unreadMessageCount > 0) {
						    echo '(' . $unreadMessageCount . ')';
						} ?></button>
				</li>
				<?php if (!empty($enabled_menu_items) && array_key_exists('attorney_client_management_case_filed', $enabled_menu_items) && Helper::validate_key_value('attorney_client_management_case_filed', $enabled_menu_items, 'radio') == 1) { ?>
				<li class="nav-item" role="presentation">
					<button class="nav-link filed-case-recieved-tab-class <?php if ($type == 'filed_case') {
					    echo "active nav-link-active";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'filed_case'); ?>')"
						id="filed-case-recieved-tab" data-bs-toggle="pill" data-bs-target="#filed-case-recieved" type="button" role="tab" aria-controls="filed-case-recieved" aria-selected="true"><span class="card-title-text">Filed Cases <?php echo isset($fileCaseCount) ? '(' . $fileCaseCount . ')' : ''; ?></span></button>
				</li>
				<?php } ?>
				@endif
				@if(empty(Auth::user()->parent_attorney_id))
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'active') {
					    echo "active nav-link-active";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'active'); ?>')"
						id="active-tab" data-bs-toggle="pill" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">Active</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'archived') {
					    echo "active nav-link-archived";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'archived'); ?>')"
						id="archived-tab" data-bs-toggle="pill" data-bs-target="#archived" type="button" role="tab" aria-controls="archived" aria-selected="true">Archived</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'invited') {
					    echo "active nav-link-invited";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'invited'); ?>')"
						id="invited-tab" data-bs-toggle="pill" data-bs-target="#invited" type="button" role="tab" aria-controls="invited" aria-selected="true">Invited</button>
				</li>

				<li class="nav-item" role="presentation">
					<button class="nav-link new-docs-recieved-tab-class <?php if ($type == 'new_docs') {
					    echo "active nav-link-active";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'new_docs'); ?>')"
						id="new-docs-recieved-tab" data-bs-toggle="pill" data-bs-target="#new-docs-recieved" type="button" role="tab" aria-controls="new-docs-recieved" aria-selected="true">New Document Received <?php if (isset($isAnyClientWithNewDoc)) {
						    echo '(' . $isAnyClientWithNewDoc . ')';
						} ?></button>
				</li>
				<li class="nav-item" role="presentation">
					<?php $unreadMsgBG = (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'nav-link-archived' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'nav-link-active' : ''); ?>
					<?php $unreadMsgTxt = (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'nav-link-archived-text' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'nav-link-active-text' : ''); ?>

					<button class="nav-link <?php if ($type == 'unread_message') {
					    echo "active ";
					    echo $unreadMsgBG;
					} ?> <?php echo $unreadMsgTxt; ?>"
						onclick="redirectToURL('<?php echo route('attorney_client_management', 'unread_message'); ?>')"
						id="new-text-message-tab" data-bs-toggle="pill" data-bs-target="#new-text-message" type="button" role="tab" aria-controls="new-text-message" aria-selected="true">New Text Messages <?php if (isset($unreadMessageCount) && $unreadMessageCount > 0) {
						    echo '(' . $unreadMessageCount . ')';
						} ?></button>
				</li>
				
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php if ($type == 'reminder') {
					    echo "active nav-link-invited";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'reminder'); ?>')"
						id="reminder-tab" data-bs-toggle="pill" data-bs-target="#reminder" type="button" role="tab" aria-controls="reminder" aria-selected="true">Appointment Reminder</button>
				</li>
				
				<li class="nav-item" role="presentation">
					<button class="nav-link filed-case-recieved-tab-class <?php if ($type == 'filed_case') {
					    echo "active nav-link-active";
					} ?>" onclick="redirectToURL('<?php echo route('attorney_client_management', 'filed_case'); ?>')"
						id="filed-case-recieved-tab" data-bs-toggle="pill" data-bs-target="#filed-case-recieved" type="button" role="tab" aria-controls="filed-case-recieved" aria-selected="true">
						<span class="card-title-text">Filed Cases <?php echo isset($fileCaseCount) ? '(' . $fileCaseCount . ')' : ''; ?></span>
					</button>
				</li>
				@endif
			</ul>
			<div class="card-body border-top-left-radius-none">
				<div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
					<div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
						<div class="table-responsive">
							<table class="table">
								<tbody>
									<tr>
										<th>
											<a href="{{ route('attorney_client_management', [
														'type' => $type,
														'sort_by' => 'id',
														'sort_order' => ($sort_by == 'id' && $sort_order == 'asc') ? 'desc' : 'asc', 
														'q' => request('q'),
														'per_page' => request('per_page')
													]) }}">
												Id

												@if ($sort_order == 'asc' && $sort_by == 'id')
												<i class="bi bi-caret-down-fill"></i>
												@else
												<i class="bi bi-caret-up-fill"></i>
												@endif

											</a>
										</th>
										<th></th>
										<th>
											<a href="{{ route('attorney_client_management', [
														'type' => $type,
														'sort_by' => 'name',
														'sort_order' => ($sort_by == 'name' && $sort_order == 'asc') ? 'desc' : 'asc', 
														'q' => request('q'),
														'per_page' => request('per_page')
													]) }}">
												Name / Email

												@if ($sort_order == 'asc' && $sort_by == 'name')
												<i class="bi bi-caret-down-fill"></i>
												@else
												<i class="bi bi-caret-up-fill"></i>
												@endif

											</a>
										</th>
										<th>Subscriptions / Addons</th>
										<th class="text-center">Form / Doc(s) Completeness</th>
										<th class="text-center">Text Messages</th>
										<th>Status / Action</th>
									</tr>
									<?php if (!empty($client) && count($client) > 0) { ?>
										<?php foreach ($client as $val) {
										    $clendlyData = [];
										    $clendlyData = $client_clendly[$val['id']] ?? [];
										    $documentProgress = $documentCompleteness[$val['id']] ?? [];

										    $displayEvent = false;
										    if (isset($clendlyData['scheduled_event_end_time']) && !empty($clendlyData['scheduled_event_end_time']) && $clendlyData['scheduled_event_end_time'] > date("Y-m-d\TH:i:s\Z", strtotime('now'))) {
										        $displayEvent = true;
										    }
										    $notIn = ['document_sign', 'signed_document'];
										    $unreadDocument = \App\Models\ClientDocumentUploaded::where(['client_id' => $val['id'], 'is_viewed_by_attorney' => 0])->whereNotIn('document_type', $notIn)->count();
										    $rowClass = '';
										    if (($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1) || ($val['concierge_service'] == 0 && !empty($client_percent[$val['id']]['submitted_to_att_at']))) {
										        $rowClass = 'statuc_concierge_service_done';
										    }

										    $date = date_create($val['created_at']);
										    $formated_DATETIME = date_format($date, 'M dS, Y');
										    $formated_last_login = !empty($val['last_login_at']) ? DateTimeHelper::dbDateToDisplay($val['last_login_at'], true) : '';

										    $client_id = $val['id'];
										    $client_type = $val['client_type'];

										    $client_subscription_id = $val['client_subscription'];
										    $email = Helper::validate_key_value('email', $val);

										    $simpleTextWebhookMessages = $val->simpleTextWebhookMessages;
										    $clientsParalegal = $val->clientsParalegal;
										    $clientsAssociate = $val->clientsAssociate;
										    $formsStepsCompleted = $val->formsStepsCompleted;
										    $clientsAppointmentReminder = $val->clientsAppointmentReminder;
										    $clientsSettings = $val->clientsSettings;

										    $seen_by_attorney = $simpleTextWebhookMessages ? $simpleTextWebhookMessages->seen_by_attorney : '';
										    $paralegalId = $clientsParalegal ? $clientsParalegal->paralegal_id : '';
										    $associateId = $clientsAssociate ? $clientsAssociate->associate_id : '';

										    $request_edit_access = $formsStepsCompleted ? $formsStepsCompleted->request_edit_access : 0;
										    $reminderSentClass = '';
										    $reminderTime = '';
										    $reminderLocation = '';
										    $is_case_filed = '';
										    $caseFiledTime = '';
										    if (isset($clientsAppointmentReminder->last_send) && !empty($clientsAppointmentReminder->last_send)) {
										        $reminderSentClass = 'bg-reminder-sent';
										        $reminder_time = $clientsAppointmentReminder->reminder_time ?? '';
										        if (!empty($reminder_time)) {
										            $dateReminder = DateTime::createFromFormat('m/d/Y h:i A', $reminder_time);
										            if ($dateReminder !== false) {
										                $reminderTime = $dateReminder->format('l jS \of F Y h:i A');
										            }
										        }
										        $reminderLocation = $clientsAppointmentReminder->reminder_location ?? '';
										    }
										    if (isset($clientsSettings->is_case_filed)) {
										        $case_filed_timestamp = $clientsSettings->case_filed_timestamp ?? '';
										        $is_case_filed = Helper::validate_key_value('is_case_filed', $clientsSettings, 'radio');
										        if (!empty($case_filed_timestamp) && $is_case_filed == 1) {
										            $caseFiledReminder = DateTime::createFromFormat('Y-m-d H:i:s', $case_filed_timestamp);
										            if ($caseFiledReminder !== false) {
										                $caseFiledTime = $caseFiledReminder->format('l jS \of F Y h:i A');
										            }
										        }
										    }

										    ?>
											<input type="hidden" id="retainer_agreement_box<?php echo $val['id'] ?>" value="<?php echo $val['retainer_agreement_box'] ?>">
											<tr class="unread {{ $reminderSentClass }} event_row_class  client-<?php echo $val['id']; ?>">
												<td>
													<div class="d-flex">
														<strong class="ml-1"><a class="client_id_no"
																<?php if (!empty($form_completed_clients[$val['id']]) && $form_completed_clients[$val['id']] == 6) { ?>
																href="{{route('attorney_form_submission_view',['id'=>$val['id']])}}"
																<?php } else { ?>
																href="{{route('attorney_form_submission_view',['id'=>$val['id']])}}"
																<?php } ?>><span>{{$val['id']}}</span></a></strong>
													</div>
													<?php if (empty($type) && ($val['user_status'] == Helper::ACTIVE && $val['logged_in_ever'] == Helper::YES)) { ?>
														<span class="text-bold text-center text-success">Active</span>
													<?php } elseif (empty($type) && $val['logged_in_ever'] == Helper::NO) { ?>
														<span class="text-bold text-center text-c-blue">Invited</span>
													<?php } elseif (empty($type) && $val['user_status'] == Helper::INACTIVE) { ?>
														<span class="text-bold text-center text-danger">Archived</span>
													<?php } ?>
													<!-- {{ $val['user_status'] }}
											{{ $val['logged_in_ever'] }} -->
												</td>
												<td>
													<div class="text-center mt-1">
														<i title="Documents" class="fas fa-file-alt cursor-pointer <?php if (($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1) || ($val['concierge_service'] == 0 && !empty($client_percent[$val['id']]['submitted_to_att_at']))) { ?> text-c-white <?php } else { ?> text-c-green <?php } ?> mr-2" onclick="openDocumentsListPopup(<?php echo $val['id']; ?>)"> Send Doc(s) <br /> &nbsp;&nbsp;&nbsp;&nbsp;Request</i>
													</div>
												</td>
												<td>
													<div class="d-flex">
														<span class="edit_name_label_{{$client_id}}">Name:&nbsp;</span>
														<input type="text" name="" id="" class="form-control-none w-auto input_capitalize border-bottom-gray edit_name_input_{{$client_id}} " value="<?php echo $val['name']; ?>" readonly="true">
														<i onclick="edit_name('{{$client_id}}')" class="fas fa-pencil-square-o ml-1 edit edit_name_{{$client_id}} pt-1	">edit</i>
														<span onclick="update_name_fn('{{$client_id}}','{{$val['name']}}')" class="ml-1 submit btn-smt edit_name_submit_{{$client_id}} d-none">Save</span>
													</div>
													
													<div class="d-flex">
														<span class="edit_email_label_{{$client_id}}">Email:&nbsp;</span>
														<input type="text" name="" id="" class="form-control-none w-auto border-bottom-gray edit_email_input_{{$client_id}} " value="<?php echo $email; ?>" readonly="true">
														<i onclick="edit_email('{{$client_id}}')" class="fas fa-pencil-square-o ml-1 edit edit_email_{{$client_id}} pt-1	">edit</i>
														<span onclick="update_email_fn('{{$client_id}}','{{$email}}')" class=" ml-1 btn-smt edit_email_submit_{{$client_id}} d-none">Save</span>
													</div>
													<div class="d-flex">
														<span class="edit_phone_label_{{$client_id}}">Phone:&nbsp;</span>
														<input type="text" name="" id="" class="form-control-none w-auto border-bottom-gray phone-field  edit_phone_input_{{$client_id}} " value="<?php echo $val['phone_no']; ?>" readonly="true">
														<i onclick="edit_phone('{{$client_id}}')" class="fas fa-pencil-square-o ml-1 edit edit_phone_{{$client_id}} pt-1	">edit</i>
														<span onclick="update_phone_fn('{{$client_id}}','{{$email}}')" class="ml-1 btn-smt edit_phone_submit_{{$client_id}} d-none">Save</span>
													</div>


													<div class="d-flex"> Start Date: <strong class="ml-1"> {{$formated_DATETIME}}</strong></div>
													<?php if (!empty($formated_last_login)) { ?>
														<div class="d-flex text-c-green"> Recent Login: <strong class="ml-1"> {{$formated_last_login}}</strong></div>
													<?php } ?>
													

													<?php if (!empty($attorney_detailed_property_enabled) && $val['client_subscription'] != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) { ?>
														<div class="d-flex"><span>Detailed Property Tab: &nbsp;</span>
															<input id="detailed_prop_<?php echo $val['id']; ?>" type="checkbox" <?php if ($val['detailed_property'] == 1) {
															    echo "checked";
															} ?> onclick="addDetailProperty('<?php echo $val['id']; ?>','<?php echo $val['detailed_property']; ?>')" value="1" name="detailed_property" />
														</div>
													<?php } ?>

													<div class="doc-recieved-div-{{ $val['id'] }}">
														<?php if (isset($newDocUploaded[$val['id']]) && $newDocUploaded[$val['id']] > 0) { ?>
															<div class="d-flex"><span class="text-c-red"><strong>New Document Received</strong></span></div>
														<?php } ?>
													</div>
													<?php if (!empty($val['case_submitted_to_attorney_on'])) {
													    echo "<small class='text-c-green'>Submitted to Attorney on: " . DateTimeHelper::dbDateToDisplay($val['case_submitted_to_attorney_on'], true) . '</small>';
													} ?>


													<div class="submitted-on-div-{{ $val['id'] }}">
														<?php if (isset($client_percent[$val['id']]['submitted_to_att_at']) && !empty($client_percent[$val['id']]['submitted_to_att_at'])) { ?>
															<span class="d-block font-weight-bold"><?php echo !empty($client_percent[$val['id']]['submitted_to_att_at']) ? "Submitted By Client on:" . DateTimeHelper::dbDateToDisplay($client_percent[$val['id']]['submitted_to_att_at'], true) : ''; ?></span>
														<?php } ?>	
													</div>
													<?php if (!empty($caseFiledTime)) { ?>
														<div class="d-flex text-c-green"> Case&nbsp;Filed&nbsp;at: {{ $caseFiledTime }}</div>
													<?php } ?>															
													<div class="d-flex align-items-center mt-2 mt-sm-0 label-div">
														<label for="case_filed_{{ $val['id'] }}" class="mb-0">Case&nbsp;Status:&nbsp;</label>
														<?php if ($is_case_filed == 1) { ?>
															<span class="text-c-green">Filed</span>
															<button type="button" class="delete-div resend ms-3" style="position: inherit;" title="Preview Hearing Info" onclick="clientCaseFiledInfoPreviewPopup(<?php echo $val['id']; ?>, '<?php echo route('attorney_client_case_filed_preview_popup'); ?>', '<?php echo $type;?>')">
																<i class="bi bi-justify"></i>
																Hearing Info
															</button>
														<?php } else { ?>
														<select name="case_filed_{{ $val['id'] }}" id="case_filed_{{ $val['id'] }}" class=" form-select form-control form-control-custom-padding w-auto me-auto" onchange="clientCaseFiledInfoPopup(this, <?php echo $val['id']; ?>, '<?php echo route('attorney_client_case_filed_popup'); ?>')">
															<option value="0" <?php echo $is_case_filed == 0 || $is_case_filed == null ? 'selected' : ''; ?>>Case Not Filed</option>
															<option value="1" <?php echo $is_case_filed == 1 ? 'selected' : ''; ?>>Filed Case</option>
														</select>
														<?php } ?>
													<div>
												</td>
												<td>

													<div class="d-flex">Client Subscription: <strong><?php echo $val['client_subscription'] > 0 ? \App\Models\AttorneySubscription::packageNameForClient($val['client_subscription']) : ''; ?></strong></div>

													<div class="d-flex">
														<span class="edit_client_type_label_{{$client_id}}"> Client Type:&nbsp;
															<!-- <span class="text-bold"><?php echo $val['client_type'] > 0 ? ArrayHelper::getClientTypeLabelArray($val['client_type']) : ''; ?></span> -->
														</span>
														<select required class="mr-2 border-bottom-gray h-unset fs-12 form-control-none w-auto p-0 no-arrow  edit_client_type_input_{{$client_id}}" name="edit_client_type" id="" disabled="true">
															<?php echo ArrayHelper::getClientTypeSelection($val['client_type']); ?>
														</select>
														<i onclick="edit_client_type('{{$client_id}}', '{{$client_type}}', '{{$client_subscription_id}}')" class="fas fa-pencil-square-o ml-1 edit edit_client_type_edit_{{$client_id}} pt-1 float-end">edit</i>
														<span onclick="update_client_type_fn('{{$client_id}}', '{{$client_type}}', '{{$client_subscription_id}}')" class="ml-1 pt-2 btn-smt edit_client_type_submit_{{$client_id}} d-none">Save</span>
													</div>
													<div class="d-flex">
														<span class="edit_paralegal_label_{{$client_id}}"> Paralegal:&nbsp;</span>
														<select required class="fs-12 border-bottom-gray mr-2 h-unset form-control-none w-auto p-0 no-arrow  edit_paralegal_input_{{$client_id}}" name="edit_paralegal" id="" disabled="true">
															<option value="">Select Paralegal</option>
															<?php echo Helper::getParalegalSelection($paralegalId); ?>
														</select>
														@if(empty(Auth::user()->parent_attorney_id))
														<i onclick="edit_paralegal('{{$client_id}}', '{{$paralegalId}}')" class="fas fa-pencil-square-o ml-1 edit edit_paralegal_edit_{{$client_id}} pt-1 float-end">edit</i>
														<span onclick="update_paralegal_fn('{{$client_id}}', '{{$paralegalId}}')" class=" ml-1 pt-2 btn-smt edit_paralegal_submit_{{$client_id}} d-none">Save</span>
														@endif
													</div>
													@if(!empty($associates))
													<!-- law firm associate -->
													<div class="d-flex">
														<span class="edit_associate_label_{{$client_id}}"> Law Firm:&nbsp;</span>
														<select required class="fs-12 border-bottom-gray mr-2 h-unset form-control-none w-auto p-0 no-arrow edit_associate_input_{{$client_id}}" name="edit_associate" id="" disabled="true">
															<option value="">Choose Law Firm</option>
															<?php foreach ($associates as $key => $associate) {
															    echo '<option value="' . $associate['id'] . '" ' . ($associateId == $associate['id'] ? 'selected' : '') . '>' . $associate['firstName'] . ' ' . $associate['lastName'] . '</option>';
															} ?>
														</select>
														@if(empty(Auth::user()->parent_attorney_id))
														<i onclick="edit_associate('{{$client_id}}', '{{$associateId}}')" class="fas fa-pencil-square-o ml-1 edit edit_associate_edit_{{$client_id}} pt-1 float-end">edit</i>
														<span onclick="update_associate_fn('{{$client_id}}', '{{$associateId}}')" class="ml-1 pt-2 btn-smt edit_associate_submit_{{$client_id}} d-none">Save</span>
														@endif
													</div>
													@endif
													<a href="javascript:void(0)" class="<?php if (($val['concierge_service'] == 1 && $val['concierge_service_status'] == 1) || ($val['concierge_service'] == 0 && !empty($client_percent[$val['id']]['submitted_to_att_at']))) { ?> text-c-white <?php } else {
													    echo "text-c-black hover-black";
													} ?>"
														onclick="showSubscriptionAddon(<?php echo $val['id']; ?>)">
														<span class="">Select to See Subscription/Add Ons:</span>
													</a>

													<div class="hide-data subscription-addon subscription-addon-<?php echo $val['id']; ?>">
														@include('attorney.client.manage.subscription_addon')
													</div>


												</td>
												<td class="progress-td progress-td-{{ $val['id'] }}">
													@include('attorney.client_management_common_progress')
												</td>
												<td class="text-center">
													
													<?php

													if ($paralegalId > 0) { ?>
														<div class="mb-3">
															<button type="button" class="delete-div resend" title="Click to resend appointment reminder" onclick="sendParalegalInfoToClient(<?php echo $val['id']; ?>, <?php echo $paralegalId; ?>, '<?php echo route('send_paralegal_info_to_client_popup_by_attorney'); ?>')">
																<i class="bi bi-envelope"></i>
																Send Paralegal Info
															</button>
														</div>
													<?php } ?>
													<a class="" style="text-decoration:none;" href="javascript:void(0)" onclick="getSimpleTextMessages('<?php echo $val['id']; ?>')">
														<span class="position-relative event_color_class event_color_class-{{$val['id']}}">
															<strong> <i class="fas fa-envelope"></i>
																<?php if (isset($seen_by_attorney) && $seen_by_attorney == '0') { ?>
																	<span class="message-unread-indicator message-indicator-<?php echo $val['id']; ?>"></span>
																<?php } ?> Text Messages
															</strong>
														</span>
													</a>
													<?php if (isset($request_edit_access) && $request_edit_access == 1) { ?>
														<div class="pt-3  ">
															<a class="green requested_access blinking-text" href="javascript:void(0)" onclick="openEditRequestPopup(<?php echo $val['id']; ?>)">Client Edit Request</a>
														</div>
													<?php } ?>


												</td>
												<td>
													<p class="clandely_msg clandely_msg-{{$val['id']}}">
													</p>
													<?php if ($displayEvent) { ?>
														<p class="clandely_msg">
															<?php if ($clendlyData['event_status'] == 'active') {
															    $sdate = explode("T", $clendlyData['scheduled_event_end_time']);
															    $time = explode(".", $sdate[1]);

															    $stdate = explode("T", $clendlyData['scheduled_event_start_time']);
															    $sttime = explode(".", $stdate[1]);

															    ?>
																{{$clendlyData['scheduled_event_name']}}<br>
																<strong>Start </strong>

																<?php echo date('l jS \of F Y  h:i:s a', strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $stdate[0] . ' ' . $sttime[0], 'UTC')->setTimezone('America/Los_Angeles'))); ?><br>



																<strong>End: </strong>
																<?php echo date('l jS \of F Y  h:i:s a', strtotime(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $sdate[0] . ' ' . $time[0], 'UTC')->setTimezone('America/Los_Angeles'))); ?><br>
															<?php } ?>


														</p><?php } ?>
													<div class="d-flex" style="align-items:center;">
														<ul class="custom-ul-cm mb-0 w-100">
															<li>
																<button type="button" class="delete-div resend" title="Click to resend appointment reminder" onclick="resendAppointmentReminder(<?php echo $val['id']; ?>)">
																	<i class="bi bi-envelope"></i>
																	Client Appointment
																</button>
															</li>
															<li>
																<button type="button" class="delete-div resend" onclick="resendInvite(<?php echo $val['id']; ?>,'<?php echo route('attorney_client_resend_invite'); ?>')" title="Click here to resend invite">
																	<i class="bi bi-envelope"></i>
																	Resend invite
																</button>
															</li>
															<?php
															    if ($type != "invited") {
															        $msg = "Click here to activate";
															        if ($val['user_status'] == 1) {
															            $msg = "Click here to de-activate";
															        }
															        if ($val['user_status'] == 0) { ?>
																	<li><a href="javascript:void(0)" title="<?php echo $msg; ?>" onclick="clientChangeStatus(<?php echo $val['id']; ?>, <?php echo $val['user_status']; ?>,'<?php echo route('attorney_client_status'); ?>')" class="text-c-black hover-black"> Activate</a></li>
																<?php }
															        if ($val['user_status'] == 1) { ?>
																	<li><a href="javascript:void(0)" title="<?php echo $msg; ?>" onclick="clientChangeStatus(<?php echo $val['id']; ?>, <?php echo $val['user_status']; ?>,'<?php echo route('attorney_client_status'); ?>')" class="text-c-black hover-black"> Archive</a></li>
																<?php }
															        } ?>															
															<li><a href="javascript:void(0)" data-id="{{route('attorney_client_delete')}}" onclick='deleteClient("<?php echo route("attorney_client_delete"); ?>",<?php echo $val["id"] ?>,"<?php echo $val["name"]; ?>")'><button type="button" class="delete-div" title="Delete">
																		<i class="bi bi-trash3"></i>
																		Delete
																	</button></a></li>
															<?php if (!empty($reminderTime)) { ?>
																<li>{{ $reminderTime }}</li>
															<?php } ?>
															<?php if (!empty($reminderLocation)) { ?>
																<li class="pt-0">Location: {{ $reminderLocation }}</li>
															<?php } ?>
															
														</ul>
														<div class="d-grid text-center" >
															<!-- <button type="button" class="delete-div resend mb-3" title="Click to resend appointment reminder" onclick="clientPasswordReset(<?php echo $val['id']; ?>)">
																<i class="bi bi-key-fill"></i>
																Password Reset
															</button> -->
															<a class="green height-max-content link-unerline" href="<?php echo route("attorney_client_login", ['id' => $val["id"]]); ?>">Login as client <i class="fas fa-sign-in-alt fa-lg" title="Login into your client dashboard"></i></a>
														</div>														
													</div>
												</td>

											</tr>
										<?php }
										} else { ?>
										<tr class="unread">
											<td colspan="7">{{ __('No Record Found.') }}</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">
								@if ($client->count())
								<div class="shoing">
									@if ($client->count())
									Showing {{ $client->firstItem() }} to {{ $client->lastItem() }} of {{ $client->total() }} entries
									@endif
								</div>
								<div>
									{{ $client->links() }}
								</div>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" href="{{ asset('assets/css/uploaded-doc.css')}}">

<style>
	.subscription-addon {
		padding: 0 !important;
	}

	.requested_access {
		background-color: #e4cacd !important;
		border-radius: 5px;
		border: 1px solid #f00 !important;
		padding: 5px;
		font-weight: bold;
		color: #f00 !important;
	}

	.requested_access:hover {
		color: #ff0000;
	}

	.unread-indicator {
		position: absolute;

		width: 11px;
		height: 11px;
		background-color: red;
		border-radius: 50%;
		border: 2px solid white;
	}

	.message-unread-indicator {
		position: absolute;
		top: -3px;
		left: 8px;
		width: 11px;
		height: 11px;
		background-color: red;
		border-radius: 50%;
		border: 2px solid white;
	}

	a.green {
		color: green;
		font-weight: bold;
		background-color: #fff;
		border: 1px solid green;
	}

	.whole-page-overlay .center-loader {
		top: 50%;
		left: 52%;
		position: absolute;
		color: white;
	}

	.form-control-none w-auto {
		display: unset;
		width: 100%;
		padding: unset;
		line-height: unset;
		color: unset;
		background-color: unset !important;
		background-clip: unset !important;
		border: unset;
		border-radius: unset;
		transition: unset;
		font-weight: 600;
	}

	.form-control-custom-padding {
		padding: .2rem .75rem !important;
	}

	.edit,
	.submit {
		color: #012cae;
		cursor: pointer;
	}

	.h-unset {
		height: unset !important;
	}

	.border-unset {
		border: unset !important;
	}

	.no-arrow {
		-webkit-appearance: none;
		-moz-appearance: none;
	}
</style>
<style>
	.table-hover tbody tr.status_canceled:hover {
		background-color: red;
		color: #fff !important;
	}

	.table-hover tbody tr.statuc_Consultation:hover,
	.table-hover tbody tr.statuc_Consultation:hover td {
		background-color: rgb(23, 232, 133) !important;
		color: #000 !important;
	}

	.hover-black:hover {
		color: #414141;
	}

	.statuc_Consultation,
	.statuc_Consultation td {
		color: #000 !important;
		background-color: rgb(23, 232, 133) !important;
	}

	.table-hover tbody tr.statuc_Final:hover,
	tr.statuc_Final select,
	tr.statuc_Final i.fa-pencil-square-o,
	tr.statuc_Final .user_stats,
	tr.statuc_Final .client_id_no {
		background-color: #012cae !important;
		color: #fff !important;
	}

	.statuc_Final,
	.statuc_Final td {
		background-color: #012cae !important;
		color: #fff !important;
	}

	.table-hover tbody tr.statuc_Client:hover,
	.table-hover tbody tr.statuc_Client:hover td,
	.table-hover tbody tr.statuc_Questionnaire:hover,
	.table-hover tbody tr.statuc_Questionnaire:hover td,
	.table-hover tbody tr.statuc_Client:hover td span.color-ultimate {
		background-color: royalblue;
		color: #fff !important;
	}

	tr.statuc_Client,
	tr.statuc_Client td,
	tr.statuc_Questionnaire,
	tr.statuc_Questionnaire td,
	tr.statuc_Client td span.color-ultimate {
		background-color: royalblue;
		color: #fff !important;
	}

	tr td a {
		text-decoration: underline;
	}

	tr.status_canceled {
		background-color: red;
		color: #fff !important;
	}

	@keyframes blink {
		0% {
			opacity: 1;
		}

		50% {
			opacity: 0;
		}

		100% {
			opacity: 1;
		}
	}

	.blinking-text {
		text-align: center;
		margin-top: 20%;
		color: red;
		animation: blink 1s infinite;
	}

	tr.statuc_Client,
	tr.statuc_Client td,
	tr.statuc_Questionnaire,
	tr.statuc_Questionnaire td,
	tr.statuc_Questionnaire select,
	tr.statuc_Questionnaire i.fa-pencil-square-o,
	tr.statuc_Questionnaire .user_stats,
	tr.statuc_Questionnaire .client_id_no,
	tr.statuc_Client select,
	tr.statuc_Client i.fa-pencil-square-o,
	tr.statuc_Client .user_stats,
	tr.statuc_Client .client_id_no {
		background-color: royalblue;
		color: #fff !important;
	}

	a.text-c-white:hover {
		color: #fff;
	}



	.table-hover tbody tr.statuc_concierge_service_done:hover,
	.table-hover tbody tr.statuc_concierge_service_done:hover td {
		background-color: #008000 !important;
		color: #fff !important;
	}

	tr.statuc_concierge_service_done,
	tr.statuc_concierge_service_done td,
	tr.statuc_concierge_service_done select,
	tr.statuc_concierge_service_done i.fa-pencil-square-o,
	tr.statuc_concierge_service_done .user_stats,
	tr.statuc_concierge_service_done .client_id_no {
		background-color: #008000 !important;
		color: #fff !important;
	}

	tr.statuc_Client a,
	tr.statuc_Final .text-c-green,
	tr.statuc_Final a,
	tr.statuc_concierge_service_done a,
	tr.statuc_concierge_service_done .text-c-green,
	tr.statuc_Client .text-c-green {
		color: #fff !important;
	}

	tr.statuc_Client a.link-unerline,
	tr.statuc_Final a.link-unerline,
	tr.statuc_concierge_service_done a.link-unerline {
		border: 1px solid #fff;
	}

	tr.statuc_concierge_service_done a.link-unerline {
		border: 1px dotted #fff;
		padding: 2px;
	}

	.custom-ul-cm {
		list-style: none;
		text-align: center;
		padding-left: 0px;
		padding-right: 10px;
	}

	.custom-ul-cm li {
		padding-top: 10px;
	}

	tr.statuc_concierge_service_done img.done_client {
		background-color: #21de21 !important;

	}

	@media only screen and (max-width: 1024px) {
		#facebox .content.fbminwidth {
			min-width: 100% !important;
		}

		#facebox {
			left: unset !important;
			max-width: 100% !important;
			width: 100% !important;
		}

		#facebox .popup {
			max-width: 100%;
			width: 100%;
		}
	}
	.btn-smt{
	color: #012cae;
	border-radius:5px;
    border: 2px solid #012cae;
    padding: 2px 8px 0px 8px;
    margin: 0px;
    line-height: .8;
}
	.statuc_Final .btn-smt{color:white; border-radius:5px;border:2px solid #fff;}
</style>
@if ($errors->any())
<script>
	$(document).ready(function() {
		var client_name = "<?php echo old('name', ''); ?>";
		var client_email = "<?php echo old('email', ''); ?>";
		var client_id = "<?php echo old('client_id', ''); ?>";
		$("#client_id").val(client_id);
		$("#client_name").val(client_name);
		$("#client_email").val(client_email);
		//$("#edit_client").modal('show');
	});
</script>
@endif
<script>
	$(document).ready(function() {
		$('#page_loader').hide();
		getClientManagementCommonData();
	});

	getClientManagementCommonData = function(selectClass, selectedParalegal) {
		var clientIds = "<?php echo json_encode($clientIds); ?>";
		var ajaxurl = "<?php echo route('attorney_client_management_common_data'); ?>";
		var attorney_id = "<?php echo $attorney_id; ?>";
		var classesNoConsider = [];
		$.ajax({
			url: ajaxurl,
			method: 'POST',
			data: {
				ids: clientIds,
				attorney_id: attorney_id,
				_token: $('meta[name="csrf-token"]').attr('content') // CSRF token
			},
			success: function (response) {
				
				$.each(response, function (className, html) {
					$.each(JSON.parse(clientIds), function (index, clientid) {
						if (className === 'client-' + clientid ||
							className === 'clandely_msg-' + clientid ||
							className === 'event_color_class-' + clientid) {
								if(className === 'clandely_msg-' + clientid){
									$('.' + className).html(html);
								}else{
									$('.' + className).addClass(html);
								}
							
							classesNoConsider.push(className);
						}
					});

					if (className === 'unreadMsg' && html !== '') {
						$('.noti_count').removeClass('hide-data');
						$('.noti_count').html(html);
					}

					if (!classesNoConsider.includes(className) && className !== 'unreadMsg') {
						$('.' + className).html(html);
					}
				});
			},
			error: function () {
				console.error('Failed to load client data.');
			}
		});
	}


	function edit_client(obj, id, ctype) {
		var main_parent = $(obj).parents(".unread");
		var client_name = $(main_parent).find('td:eq(0)>span').text();
		var client_email = $(main_parent).find('td:eq(1)>span').text();
		$("#client_id").val(id);
		$("#client_type").val(ctype);
		$("#client_name").val(client_name);
		$("#client_email").val(client_email);
		if ($("#retainer_agreement_box" + id).val() == "1") {
			$("#retainer_agreement_box").prop("checked", true);
		} else {
			$("#retainer_agreement_box").prop("checked", false);
		}
		$("#edit_client").modal('show');
	}

	function request_msg_modal(obj, id) {
		$("#request_msg_modal").find("#client_id").val(id);
		// $.ajax({

		// type: 'GET',
		// data:{client_id:id},
		// success: function (data) {
		// var data=JSON.parse(data);
		// if(data){
		// for (const item of data){
		// $('#editable_section')[0].sumo.selectItem(item);
		// }
		// }
		// }
		// });
		$("#request_msg_modal").modal('show');
	}

	function file_upload_modal(client_id) {
		$("#image_document_upload_modal").find("#client_id").val(client_id);
		$("#image_document_upload_modal").modal('show');
	}

	function report_edit_modal(client_id) {
		$("#report_edit_modal").find("#client_id").val(client_id);
		$("#report_edit_modal").modal('show');
	}
	edit_name = function(id) {
		if ($(".edit_name_input_" + id).hasClass("form-control-none w-auto") == true) {
			$(".edit_name_input_" + id).removeClass('form-control-none w-auto');
			$(".edit_name_input_" + id).addClass('form-control mr-2 form-control-custom-padding');
			$(".edit_name_input_" + id).attr('readonly', false);
			$(".edit_name_" + id).addClass('d-none');
			$(".edit_name_submit_" + id).removeClass('d-none');
			$(".edit_name_submit_" + id).addClass('pt-2');
			$(".edit_name_label_" + id).addClass('pt-1');
		}
	}
	edit_email = function(id) {
		if ($(".edit_email_input_" + id).hasClass("form-control-none w-auto") == true) {
			$(".edit_email_input_" + id).removeClass('form-control-none w-auto');
			$(".edit_email_input_" + id).addClass('form-control mr-2 form-control-custom-padding');
			$(".edit_email_input_" + id).attr('readonly', false);
			$(".edit_email_" + id).addClass('d-none');
			$(".edit_email_submit_" + id).removeClass('d-none');
			$(".edit_email_submit_" + id).addClass('pt-2');
			$(".edit_email_label_" + id).addClass('pt-1');
		}
	}
	edit_phone = function(id) {
		if ($(".edit_phone_input_" + id).hasClass("form-control-none w-auto") == true) {
			$(".edit_phone_input_" + id).removeClass('form-control-none w-auto');
			$(".edit_phone_input_" + id).addClass('form-control mr-2 form-control-custom-padding');
			$(".edit_phone_input_" + id).attr('readonly', false);
			$(".edit_phone_" + id).addClass('d-none');
			$(".edit_phone_submit_" + id).removeClass('d-none');
			$(".edit_phone_submit_" + id).addClass('pt-2');
			$(".edit_phone_label_" + id).addClass('pt-1');
		}
	}
	edit_client_type = function(id, client_type_id, package_id) {
		var selectClass = ".edit_client_type_input_" + id;
		if ($(selectClass).hasClass("form-control-none w-auto") == true) {
			$(selectClass).removeClass('form-control-none w-auto border-unset no-arrow p-0');
			$(selectClass).addClass('form-control form-control-custom-padding');
			$(selectClass).attr('disabled', false);
			if (package_id != 100) {
				options = '';
				$(selectClass).html(options);
				get_options(selectClass, client_type_id, package_id);
			}
			$(".edit_client_type_edit_" + id).addClass('d-none');
			$(".edit_client_type_submit_" + id).removeClass('d-none');
		}
	}

	edit_paralegal = function(id, selectedParalegal) {
		var selectClass = ".edit_paralegal_input_" + id;
		if ($(selectClass).hasClass("form-control-none w-auto") == true) {
			$(selectClass).removeClass('form-control-none w-auto border-unset no-arrow p-0');
			$(selectClass).addClass('form-control form-control-custom-padding');
			$(selectClass).attr('disabled', false);
			options = '';
			$(selectClass).html(options);
			get_paralegal_options(selectClass, selectedParalegal);
			$(".edit_paralegal_edit_" + id).addClass('d-none');
			$(".edit_paralegal_submit_" + id).removeClass('d-none');
		}
	}


	get_options = function(selectClass, client_type_id, package_id) {
		var url = "<?php echo route('get_client_type_option'); ?>";
		laws.ajax(url, {
			client_type_id: client_type_id,
			package_id: package_id
		}, function(response) {
			var res = JSON.parse(response);
			if (res.status == 1) {
				options += "<option value=''>Choose Client Type</option>";
				options += res.selections;
				$(selectClass).html(options);
			}
		});
	}
	get_paralegal_options = function(selectClass, selectedParalegal) {
		var url = "<?php echo route('get_paralegal_option'); ?>";
		laws.ajax(url, {
			selectedParalegal: selectedParalegal
		}, function(response) {
			var res = JSON.parse(response);
			if (res.status == 1) {
				options += "<option value=''>Choose paralegal</option>";
				options += res.selections;
				$(selectClass).html(options);
			}
		});
	}

	update_client_type_fn = function(id, prev_type, package_id) {

		var new_type = $(".edit_client_type_input_" + id).val();
		if (prev_type == new_type) {
			updateSelectclasses(id);
			return;
		}
		$('#page_loader').show();
		var url = "<?php echo route('update_client_type'); ?>";
		laws.ajax(url, {
			client_id: id,
			client_type_id: new_type,
			package_id: package_id
		}, function(res) {
			if (new_type == 3 && package_id != 100) {
				$('#page_loader').hide();
				laws.updateFaceboxContent(res);
			} else {
				var ans = $.parseJSON(res);
				if (ans.status == 1) {
					$('#page_loader').hide();
					$.systemMessage(ans.msg, 'alert--success', true);
					updateSelectclasses(id);
					$(".edit_client_type_submit_" + id).attr('onclick', 'update_client_type_fn("' + id + '","' + new_type + '","' + package_id + '")');
				} else {
					$('#page_loader').hide();
					$.systemMessage(ans.msg, 'alert--danger', true);
				}
			}
		});
	}

	update_paralegal_fn = function(id, prev_paralegal_user_id) {

		var paralegal_user_id = $(".edit_paralegal_input_" + id).val();
		if (prev_paralegal_user_id == paralegal_user_id) {
			updateParalegalSelectClasses(id);
			return;
		}
		$('#page_loader').show();
		var url = "<?php echo route('update_client_paralegal'); ?>";
		laws.ajax(url, {
			client_id: id,
			paralegal_id: paralegal_user_id
		}, function(res) {
			var ans = $.parseJSON(res);
			if (ans.status == 1) {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--success', true);
				updateParalegalSelectClasses(id);
			} else {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--danger', true);
			}
		});
	}

	updateSelectclasses = function(id) {
		$(".edit_client_type_input_" + id).addClass('form-control-none w-auto border-unset no-arrow p-0');
		$(".edit_client_type_input_" + id).removeClass('form-control form-control-custom-padding');
		$(".edit_client_type_input_" + id).attr('disabled', true);
		$(".edit_client_type_edit_" + id).removeClass('d-none');
		$(".edit_client_type_submit_" + id).addClass('d-none');
	}
	updateParalegalSelectClasses = function(id) {
		$(".edit_paralegal_input_" + id).addClass('form-control-none w-auto border-unset no-arrow p-0');
		$(".edit_paralegal_input_" + id).removeClass('form-control form-control-custom-padding');
		$(".edit_paralegal_input_" + id).attr('disabled', true);
		$(".edit_paralegal_edit_" + id).removeClass('d-none');
		$(".edit_paralegal_submit_" + id).addClass('d-none');
	}

	update_name_fn = function(id, prev_name) {
		
		var url = "<?php echo route('update_name'); ?>";
		var new_name = $(".edit_name_input_" + id).val();
		if (new_name === "") {
			$(".edit_name_input_" + id).focus();
			$.systemMessage("Email cannot be empty!", 'alert--danger', true);
			return;
		}
		if (prev_name == new_name) {
			updateNameclasses(id);
			return;
		}
		if (!confirm(langLbl.confirmNameUpdate)) {
			return;
		}

		$('#page_loader').show();
		laws.ajax(url, {
			client_id: id,
			new_name: new_name
		}, function(res) {
			var ans = $.parseJSON(res);
			if (ans.status == 1) {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--success', true);

				$(".edit_name_input_" + id).val(new_name);
				updateNameclasses(id);
			} else {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--danger', true);
			}
		});
	}

	update_email_fn = function(id, prev_email) {
		var url = "<?php echo route('update_email'); ?>";
		var new_email = $(".edit_email_input_" + id).val();
		if (new_email === "") {
			$(".edit_email_input_" + id).focus();
			$.systemMessage("Email cannot be empty!", 'alert--danger', true);
			return;
		}
		if (prev_email == new_email) {
			updateclasses(id);
			return;
		}
		if (!confirm(langLbl.confirmEmailUpdate)) {
			return;
		}

		$('#page_loader').show();
		laws.ajax(url, {
			client_id: id,
			new_email: new_email
		}, function(res) {
			var ans = $.parseJSON(res);
			if (ans.status == 1) {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--success', true);

				$(".edit_email_input_" + id).val(new_email);
				updateclasses(id);
			} else {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--danger', true);
			}
		});
	}

	update_phone_fn = function(id, prev_phone) {
		var url = "<?php echo route('update_phone'); ?>";
		var new_phone = $(".edit_phone_input_" + id).val();
		if (new_phone === "") {
			$.systemMessage("Phone number cannot be empty!", 'alert--danger', true);
			$(".edit_phone_input_" + id).focus();
			return;
		}
		if (prev_phone == new_phone) {
			updateClassesPhone(id);
			return;
		}
		if (!confirm("Do you want to update phone number?")) {
			return;
		}
		$('#page_loader').show();
		laws.ajax(url, {
			client_id: id,
			new_phone: new_phone
		}, function(res) {
			var ans = $.parseJSON(res);
			if (ans.status == 1) {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--success', true);
				$(".edit_phone_input_" + id).val(new_phone);
				updateClassesPhone(id);
			} else {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--danger', true);
			}
		});
	}

	addDetailProperty = function(client_id, status) {

		var status = 0;
		if ($("#detailed_prop_" + client_id).is(':checked')) {
			if (!confirm("Are you sure you want to enable Detailed Property?")) {
				return;
			}
			status = 1;

		}
		if (!$("#detailed_prop_" + client_id).is(':checked')) {
			if (!confirm("Are you sure you want to disable Detailed Property?")) {
				return;
			}
			status = 0;
		}

		var detail_url = '<?php echo route('enable_detail_property'); ?>';
		laws.ajax(detail_url, {
			client_id: client_id,
			detailed_property: status
		}, function(res) {
			var ans = $.parseJSON(res);
			if (ans.status == 1) {
				$.systemMessage(ans.msg, 'alert--success', true);
				setTimeout(function() {
					location.reload();
				}, 800);
			} else {
				$.systemMessage(ans.msg, 'alert--danger', true);
			}
		});
	}

	updateNameclasses = function(id) {
		$(".edit_name_input_" + id).removeClass('form-control');
		$(".edit_name_input_" + id).removeClass('mr-2');
		$(".edit_name_input_" + id).removeClass('form-control-custom-padding');
		$(".edit_name_" + id).removeClass('d-none');
		$(".edit_name_submit_" + id).removeClass('pt-2');
		$(".edit_name_label_" + id).removeClass('pt-1');
		$(".edit_name_input_" + id).addClass('form-control-none w-auto');
		$(".edit_name_submit_" + id).addClass('d-none');
		$(".edit_name_input_" + id).attr('readonly', true);
	}

	updateclasses = function(id) {
		$(".edit_email_input_" + id).removeClass('form-control');
		$(".edit_email_input_" + id).removeClass('mr-2');
		$(".edit_email_input_" + id).removeClass('form-control-custom-padding');
		$(".edit_email_" + id).removeClass('d-none');
		$(".edit_email_submit_" + id).removeClass('pt-2');
		$(".edit_email_label_" + id).removeClass('pt-1');
		$(".edit_email_input_" + id).addClass('form-control-none w-auto');
		$(".edit_email_submit_" + id).addClass('d-none');
		$(".edit_email_input_" + id).attr('readonly', true);
	}

	updateClassesPhone = function(id) {
		$(".edit_phone_input_" + id).removeClass('form-control');
		$(".edit_phone_input_" + id).removeClass('mr-2');
		$(".edit_phone_input_" + id).removeClass('form-control-custom-padding');
		$(".edit_phone_" + id).removeClass('d-none');
		$(".edit_phone_submit_" + id).removeClass('pt-2');
		$(".edit_phone_label_" + id).removeClass('pt-1');
		$(".edit_phone_input_" + id).addClass('form-control-none w-auto');
		$(".edit_phone_submit_" + id).addClass('d-none');
		$(".edit_phone_input_" + id).attr('readonly', true);
	}

	openDocumentsListPopup = function(client_id) {
		ajaxurl = "<?php echo route('non_concierge_documents_list_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width');
		});
	}

	
	resendAppointmentReminder = function(client_id) {
		ajaxurl = "<?php echo route('attorney_resend_reminder_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
		});
	}

	getSimpleTextMessages = function(client_id) {

		$.systemMessage(langLbl.processing, 'alert--process', true);
		var district = client_id;
		ajaxurl = "<?php echo route('attorney_simpletext_messages'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			$.systemMessage.close();
			$('.message-indicator-' + client_id).remove();
			laws.updateFaceboxContent(response, 'large-fb-width p-0');
		});
	}
	openEditRequestPopup = function(client_id) {
		ajaxurl = "<?php echo route('edit_attorney_request_popup'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width');
		});
	}

	showSubscriptionAddon = function(client_id) {
		var divHtml = $(".subscription-addon-" + client_id).html();
		if (divHtml !== '') {
			laws.updateFaceboxContent(divHtml, 'subscription-addon medium-fb-width p-0 bg-unset');
		}
	}

	edit_associate = function(id, selectedAssociate) {
		var selectClass = ".edit_associate_input_" + id;

		if ($(selectClass).hasClass("form-control-none w-auto") == true) {

			$(selectClass).removeClass('form-control-none w-auto border-unset no-arrow p-0');
			$(selectClass).addClass('form-control form-control-custom-padding');
			$(selectClass).attr('disabled', false);
			$(".edit_associate_edit_" + id).addClass('d-none');
			$(".edit_associate_submit_" + id).removeClass('d-none');
		}
	}

	update_associate_fn = function(id, prev_associate_user_id) {
		var associate_user_id = $(".edit_associate_input_" + id).val();
		if (prev_associate_user_id == associate_user_id) {
			updateAssociateSelectClasses(id);
			return;
		}
		$('#page_loader').show();
		var url = "<?php echo route('update_client_associate'); ?>";
		laws.ajax(url, {
			client_id: id,
			associate_id: associate_user_id
		}, function(res) {
			var ans = $.parseJSON(res);
			if (ans.status == 1) {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--success', true);
				updateAssociateSelectClasses(id);
			} else {
				$('#page_loader').hide();
				$.systemMessage(ans.msg, 'alert--danger', true);
			}
		});
	}

	updateAssociateSelectClasses = function(id) {
		$(".edit_associate_input_" + id).addClass('form-control-none w-auto border-unset no-arrow p-0');
		$(".edit_associate_input_" + id).removeClass('form-control form-control-custom-padding');
		$(".edit_associate_input_" + id).attr('disabled', true);
		$(".edit_associate_edit_" + id).removeClass('d-none');
		$(".edit_associate_submit_" + id).addClass('d-none');
	}
	
	clientPasswordReset = function(client_id) {
		ajaxurl = "<?php echo route('client_password_reset_popup_by_attorney'); ?>";
		laws.ajax(ajaxurl, {
			client_id: client_id
			}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
		});
	}

	sendParalegalInfoToClient = function(id,paralegal_id, ajaxUrl) {
		laws.ajax(ajaxUrl, {
			client_id: id,paralegal_id:paralegal_id
		}, function(response) {
			laws.updateFaceboxContent(response, 'large-fb-width p-0 bg-unset');
		});
	}
</script>
<!-- Modal -->
@include('attorney.invite_client_popup')

@endsection