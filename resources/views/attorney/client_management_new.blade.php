@extends('layouts.attorney',['video' => $video])

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/uploaded-doc.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/client-management.css') }}">
@endpush

@section('content')
@include("layouts.flash")

@php
    $filterParalegalId = $filterParalegalId ?? '';
    $filterAssociateId = $filterAssociateId ?? '';
    $paralegal_section = Helper::getParalegalSelection($filterParalegalId, true);
    $parentAttorneyId = Auth::user()->parent_attorney_id;
    
    // Consolidate unread message styling logic
    $unreadMsgBG = (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'nav-link-archived' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'nav-link-active' : '');
    $unreadMsgTxt = (isset($unreadMessageCount) && $unreadMessageCount > 0) ? 'nav-link-archived-text' : ((isset($unreadMessageCount) && $unreadMessageCount == 0) ? 'nav-link-active-text' : '');
@endphp

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
							<a class="btn-new-ui-default bg-white py-1 atty_video_btn text-center" style="min-width: 250px" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title="Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 26px;">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()"><img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px"> See AI Processed Docs Status</a>
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
									@foreach([10, 25, 50, 100] as $perPageValue)
										<option value="{{ $perPageValue }}" {{ request('per_page') == $perPageValue ? 'selected' : '' }}>{{ $perPageValue }}</option>
									@endforeach
								</select>
							</div>
							<div class=" d-flex align-items-center mt-2 mt-md-0 flex-column flex-sm-row">
								<div class="d-flex align-items-center w-100 label-div">
									<label for="filter_paralegal" class="mb-0 per_page">Paralegal:</label>
									<select name="filter_paralegal" id="filter_paralegal" class="per_page form-select form-control w-auto me-3" onchange="document.getElementById('paginationForm').submit();">
										<option value="">Choose Paralegal</option>
										{!! $paralegal_section !!}
									</select>
								</div>
								@if(!empty($associates))
								<div class="d-flex align-items-center mt-2 mt-sm-0 label-div">
									<label for="filter_associate" class="mb-0 per_page ">Law&nbsp;Firm:</label>
									<select name="filter_associate" id="filter_associate" class="per_page form-select form-control w-auto me-3" onchange="document.getElementById('paginationForm').submit();">
										<option value="">Choose Law Firm</option>
										@foreach($associates as $associate)
											<option value="{{ $associate['id'] }}" {{ $filterAssociateId == $associate['id'] ? 'selected' : '' }}>
												{{ $associate['firstName'] }} {{ $associate['lastName'] }}
											</option>
										@endforeach
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
				@if(!empty($parentAttorneyId))
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'all_firm_clients' ? 'active' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'all_firm_clients') }}')"
						id="all-firm-client-tab" data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button" role="tab" aria-controls="all-firm-client" aria-selected="true">All Law Firm Clients</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'assigned_to_me' ? 'active' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'assigned_to_me') }}')"
						id="clients-assigned-to-me-tab" data-bs-toggle="pill" data-bs-target="#clients-assigned-to-me" type="button" role="tab" aria-controls="clients-assigned-to-me" aria-selected="true">Client Assigned To Me</button>
				</li>
				@if (!empty($enabled_menu_items) && array_key_exists('attorney_client_management_invited', $enabled_menu_items) && Helper::validate_key_value('attorney_client_management_invited', $enabled_menu_items, 'radio') == 1)
					<li class="nav-item" role="presentation">
						<button class="nav-link {{ $type == 'invited' ? 'active nav-link-invited' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'invited') }}')"
							id="invited-tab" data-bs-toggle="pill" data-bs-target="#invited" type="button" role="tab" aria-controls="invited" aria-selected="true">Invited</button>
					</li>
				@endif
				<li class="nav-item" role="presentation">
					@php
						$activeClass = ($type == 'unread_message') ? "active {$unreadMsgBG}" : '';
					@endphp

					<button class="nav-link {{ $activeClass }} {{ $unreadMsgTxt }}"
						onclick="redirectToURL('{{ route('attorney_client_management', 'unread_message') }}')"
						id="new-text-message-tab" data-bs-toggle="pill" data-bs-target="#new-text-message" type="button" role="tab" aria-controls="new-text-message" aria-selected="true">
						New Text Messages {{ isset($unreadMessageCount) && $unreadMessageCount > 0 ? '(' . $unreadMessageCount . ')' : '' }}
					</button>
				</li>
				@if (!empty($enabled_menu_items) && array_key_exists('attorney_client_management_case_filed', $enabled_menu_items) && Helper::validate_key_value('attorney_client_management_case_filed', $enabled_menu_items, 'radio') == 1)
					<li class="nav-item" role="presentation">
						<button class="nav-link filed-case-recieved-tab-class {{ $type == 'filed_case' ? 'active nav-link-active' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'filed_case') }}')"
							id="filed-case-recieved-tab" data-bs-toggle="pill" data-bs-target="#filed-case-recieved" type="button" role="tab" aria-controls="filed-case-recieved" aria-selected="true">
							<span class="card-title-text">Filed Cases {{ isset($fileCaseCount) ? '(' . $fileCaseCount . ')' : '' }}</span>
						</button>
					</li>
				@endif
				@endif
				@if(empty($parentAttorneyId))
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'active' ? 'active nav-link-active' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'active') }}')"
						id="active-tab" data-bs-toggle="pill" data-bs-target="#active" type="button" role="tab" aria-controls="active" aria-selected="true">Active</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'archived' ? 'active nav-link-archived' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'archived') }}')"
						id="archived-tab" data-bs-toggle="pill" data-bs-target="#archived" type="button" role="tab" aria-controls="archived" aria-selected="true">Archived</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'invited' ? 'active nav-link-invited' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'invited') }}')"
						id="invited-tab" data-bs-toggle="pill" data-bs-target="#invited" type="button" role="tab" aria-controls="invited" aria-selected="true">Invited</button>
				</li>

				<li class="nav-item" role="presentation">
					<button class="nav-link new-docs-recieved-tab-class {{ $type == 'new_docs' ? 'active nav-link-active' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'new_docs') }}')"
						id="new-docs-recieved-tab" data-bs-toggle="pill" data-bs-target="#new-docs-recieved" type="button" role="tab" aria-controls="new-docs-recieved" aria-selected="true">
						New Document Received {{ isset($isAnyClientWithNewDoc) ? '(' . $isAnyClientWithNewDoc . ')' : '' }}
					</button>
				</li>
				<li class="nav-item" role="presentation">
					@php
						$activeClass = ($type == 'unread_message') ? "active {$unreadMsgBG}" : '';
					@endphp

					<button class="nav-link {{ $activeClass }} {{ $unreadMsgTxt }}"
						onclick="redirectToURL('{{ route('attorney_client_management', 'unread_message') }}')"
						id="new-text-message-tab" data-bs-toggle="pill" data-bs-target="#new-text-message" type="button" role="tab" aria-controls="new-text-message" aria-selected="true">
						New Text Messages {{ isset($unreadMessageCount) && $unreadMessageCount > 0 ? '(' . $unreadMessageCount . ')' : '' }}
					</button>
				</li>

				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'reminder' ? 'active nav-link-invited' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'reminder') }}')"
						id="reminder-tab" data-bs-toggle="pill" data-bs-target="#reminder" type="button" role="tab" aria-controls="reminder" aria-selected="true">Appointment Reminder</button>
				</li>

				<li class="nav-item" role="presentation">
					<button class="nav-link filed-case-recieved-tab-class {{ $type == 'filed_case' ? 'active nav-link-active' : '' }}" onclick="redirectToURL('{{ route('attorney_client_management', 'filed_case') }}')"
						id="filed-case-recieved-tab" data-bs-toggle="pill" data-bs-target="#filed-case-recieved" type="button" role="tab" aria-controls="filed-case-recieved" aria-selected="true">
						<span class="card-title-text">Filed Cases {{ isset($fileCaseCount) ? '(' . $fileCaseCount . ')' : '' }}</span>
					</button>
				</li>
				
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'removed' ? 'active nav-link-archived' : '' }}"
						onclick="redirectToURL('{{ route('attorney_client_management', 'removed') }}')"
						id="deleted-tab" data-bs-toggle="pill" data-bs-target="#deleted" type="button" role="tab" aria-controls="deleted" aria-selected="true">Deleted</button>
				</li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $type == 'unsubscribed' ? 'active nav-link-invited' : '' }}"
                        onclick="redirectToURL('{{ route('attorney_client_management', 'unsubscribed') }}')"
                        id="unsubscribed-tab" data-bs-toggle="pill" data-bs-target="#unsubscribed" type="button"
                        role="tab" aria-controls="unsubscribed" aria-selected="true">Unsubscribed</button>
                </li>
				@endif
			</ul>
			<div class="card-body border-top-left-radius-none" id="clientTabsContent">
				<!-- Active Clients Tab -->
				<div class="tab-pane fade show active" id="active" role="tabpanel">
					@include('attorney.client_management.list')
				</div>
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


<!-- <div class="whole-page-overlay" id="page_loader">
   <img class="center-loader"  style="width:30px;" src="{{url('/assets/img/loading2.gif')}}"/>
</div> -->
@if ($errors->any())
<script>
	$(document).ready(function() {
		var client_name = "{{ old('name', '') }}";
		var client_email = "{{ old('email', '') }}";
		var client_id = "{{ old('client_id', '') }}";
		$("#client_id").val(client_id);
		$("#client_name").val(client_name);
		$("#client_email").val(client_email);
		//$("#edit_client").modal('show');
	});
</script>
@endif
@push('scripts')
<!-- Include optimized JavaScript using Laravel standard stack -->
<script src="{{ asset('assets/js/attorney/client-management.js') }}"></script>
<script>
	// Initialize Client Management Manager
	document.addEventListener('DOMContentLoaded', function() {
		const clientManagementConfig = {
			routes: {
				getClientTypeOption: "{{ route('get_client_type_option') }}",
				getParalegalOption: "{{ route('get_paralegal_option') }}",
				updateName: "{{ route('update_name') }}",
				updateEmail: "{{ route('update_email') }}",
				updatePhone: "{{ route('update_phone') }}",
				updateClientType: "{{ route('update_client_type') }}",
				updateClientParalegal: "{{ route('update_client_paralegal') }}",
				updateClientAssociate: "{{ route('update_client_associate') }}",
				enableDetailProperty: "{{ route('enable_detail_property') }}",
				nonConciergeDocumentsListPopup: "{{ route('non_concierge_documents_list_popup') }}",
				attorneyResendReminderPopup: "{{ route('attorney_resend_reminder_popup') }}",
				attorneySimpletextMessages: "{{ route('attorney_simpletext_messages') }}",
				editAttorneyRequestPopup: "{{ route('edit_attorney_request_popup') }}",
				clientPasswordResetPopupByAttorney: "{{ route('client_password_reset_popup_by_attorney') }}"
			},
			jsonClientData: {!! json_encode($jsonClientData) !!},
			clientIds: {!! json_encode($clientIds) !!},
			langLbl: {
				processing: "{{ __('Processing...') }}",
				confirmNameUpdate: "{{ __('Do you want to update name?') }}",
				confirmEmailUpdate: "{{ __('Do you want to update email?') }}"
			}
		};

		// Initialize the client management manager
		window.clientManagementManager = new ClientManagementManager(clientManagementConfig);
	});
</script>
@endpush
<!-- Modal -->
@include('attorney.invite_client_popup')

@endsection
