@extends('layouts.attorney', ['video' => $video])
@section('content')
	@include("layouts.flash")

	<div class="row client_intake">
		<div class="col-12">
			<div class="mcard ">
				<div class="mcard-body">

					<div class="card-title-header">
						<div class="row ">
							<div class="col-lg-4 col-md-8 col-12 d-flex align-items-center">
								<h4 class="card-title pb-0 mb-0 bb-0-i">
									<i class="bi bi-list-check"></i> Client Intake Form (Imports to Client Questionnaire)
								</h4>
							</div>
							<div
								class="col-md-4 col-sm-12 col-12 d-flex align-items-center justify-content-center video_button_div">
								<a class="btn-new-ui-default bg-white py-1 atty_video_btn" style="max-width: 250px"
									href="javascript:void(0)" data-bs-toggle="modal"
									onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video"
									data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
									<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto"
										style="height: 26px;" alt="Video Logo">
								</a>
								<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto"
									href="javascript:void(0)" onclick="seeAiProcessedReportStatus()"><img alt="AI"
										src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px">
									See AI Processed Docs Status</a>
							</div>
							<div class="col-2">

							</div>
						</div>
					</div>

					<div class="row py-1">

						<div class="col-lg-6 col-xl-6 col-12 ">
							<div class="d-flex gap-2 d-flex align-items-center">
								<button type="button" class="btn btn-outline-primary border-radius-default" data-success="Client Intake Form Url Copied !" data-url="{{$url}}" onclick="copyFromDataUrl(this)">
									Click Here To<br>Copy Client Intake
								</button>
								@if (in_array($attorney_id, [55026, 610]) || in_array(env('APP_ENV'), ['local', 'development'])) 
								<button type="button" class="btn btn-outline-primary border-radius-default" data-success="Multi Step Intake Form Url Copied !" data-url="{{$urlCustom}}" onclick="copyFromDataUrl(this)">
									Click Here To<br>Copy Multi Step Intake
								</button>
								@endif
							</div>
						</div>
						<div class=" col-lg-6 col-xl-6 col-12 responsive_questions d-flex-ai-center gx-3">
							<div class="w-100"></div>
							<a href="#"
								class="btn close-modal font-weight-bold border-blue-big f-12 mr-0 mb-0 btn-new-ui-default btn-green mt-2 mt-md-0"
								onclick="conditional_questions_popup()">
								<span class="">Change/Edit Preset Questions</span>
							</a>
							<a href="#"
								class="btn close-modal font-weight-bold border-blue-big f-12 mr-0 mb-0 btn-new-ui-default btn-green mt-2 ml-3 mt-md-0"
								onclick="attorney_questions_popup()">
								<i class="bi bi-plus-lg"></i>
								<span class="">Add Questions with a Yes/No Response</span>
							</a>
						</div>
					</div>
					<h4 class="card-title"></h4>
					<div class="short_div">
						<div class="show d-flex align-items-center">
							<form action="{{route('questionnaire_index', ['active' => $active])}}" method="GET"
								id="paginationForm" class="d-flex align-items-center">
								<label for="per_page" class="mb-0 per_page">Show:</label>
								<select name="per_page" id="per_page" class="per_page form-select form-control"
									onchange="document.getElementById('paginationForm').submit();">
									<option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
									<option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
									<option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
									<option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
								</select>
							</form>
						</div>
						<div class="search-field">
							<form class="d-flex align-items-center h-100 sr" id="searchForm"
								action="{{route('questionnaire_index', ['active' => $active])}}" method="GET">
								<span>Search</span><input type="hidden" name="active" value="{{$active}}">
								<div class="input-group mb-0">
									<div class="input-group-prepend bg-transparent"
										onclick="document.getElementById('searchForm').submit();">
										<i class="bi bi-search input-group-text border-0 "></i>
									</div>
									<input type="text" name="q" class="form-control bg-transparent border-0"
										placeholder="Search" value="{{@$keyword}}">
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
					<li class="nav-item" role="presentation">
						<button class="nav-link {{ $active == '0' ? 'active' : '' }}" onclick="redirectToURL('{{ route('questionnaire_index', ['active' => 0]) }}')"
							id="all-firm-client-tab" data-bs-toggle="pill" data-bs-target="#all-firm-client" type="button"
							role="tab" aria-controls="all-firm-client" aria-selected="true">New Requests</button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link {{ $active == '1' ? 'active' : '' }}" onclick="redirectToURL('{{ route('questionnaire_index', ['active' => 1]) }}')"
							id="clients-assigned-to-me-tab" data-bs-toggle="pill" data-bs-target="#clients-assigned-to-me"
							type="button" role="tab" aria-controls="clients-assigned-to-me"
							aria-selected="true">Done</button>
					</li>
				</ul>
				<div class="card-body border-top-left-radius-none">
					<div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
						<div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
							<div class="table-responsive">
								<table class="table">
									<tbody>
										<tr>
											<th>
												<a href="{{ route('questionnaire_index', [
		'active' => $active,
		'sort_by' => 'created_at',
		'sort_order' => ($sort_by == 'created_at' && $sort_order == 'asc') ? 'desc' : 'asc',
		'q' => request('q'),
		'per_page' => request('per_page')
	]) }}">
													Added on

													@if ($sort_order == 'asc' && $sort_by == 'created_at')
														<i class="bi bi-caret-down-fill"></i>
													@else
														<i class="bi bi-caret-up-fill"></i>
													@endif

												</a>
											</th>
											<th>
												<a href="{{ route('questionnaire_index', [
		'active' => $active,
		'sort_by' => 'name',
		'sort_order' => ($sort_by == 'name' && $sort_order == 'asc') ? 'desc' : 'asc',
		'q' => request('q'),
		'per_page' => request('per_page')
	]) }}">
													Name

													@if ($sort_order == 'asc' && $sort_by == 'name')
														<i class="bi bi-caret-down-fill"></i>
													@else
														<i class="bi bi-caret-up-fill"></i>
													@endif

												</a>
											</th>
											<th>
												<a href="{{ route('questionnaire_index', [
		'active' => $active,
		'sort_by' => 'martial_status',
		'sort_order' => ($sort_by == 'martial_status' && $sort_order == 'asc') ? 'desc' : 'asc',
		'q' => request('q'),
		'per_page' => request('per_page')
	]) }}">
													Marital Status

													@if ($sort_order == 'asc' && $sort_by == 'martial_status')
														<i class="bi bi-caret-down-fill"></i>
													@else
														<i class="bi bi-caret-up-fill"></i>
													@endif

												</a>
											</th>
											<th>
												<a href="{{ route('questionnaire_index', [
		'active' => $active,
		'sort_by' => 'cell',
		'sort_order' => ($sort_by == 'cell' && $sort_order == 'asc') ? 'desc' : 'asc',
		'q' => request('q'),
		'per_page' => request('per_page')
	]) }}">
													Phone No

													@if ($sort_order == 'asc' && $sort_by == 'cell')
														<i class="bi bi-caret-down-fill"></i>
													@else
														<i class="bi bi-caret-up-fill"></i>
													@endif

												</a>
											</th>
											<th>
												<a href="{{ route('questionnaire_index', [
		'active' => $active,
		'sort_by' => 'email',
		'sort_order' => ($sort_by == 'email' && $sort_order == 'asc') ? 'desc' : 'asc',
		'q' => request('q'),
		'per_page' => request('per_page')
	]) }}">
													Email

													@if ($sort_order == 'asc' && $sort_by == 'email')
														<i class="bi bi-caret-down-fill"></i>
													@else
														<i class="bi bi-caret-up-fill"></i>
													@endif

												</a>
											</th>
											<th class="text-center">Status</th>
											<th>Action</th>
										</tr>
										@if(!empty($onePage) && count($onePage) > 0)
                                         @php
                                                // Create the link input array similar to IntakeFormController
                                                $linkinput = [
                                                    'link' => route('questionnaire') . "?token=" . base64_encode($attorney_id),
                                                    'attorney_id' => $attorney_id,
                                                    'link_for' => \App\Models\ShortLink::CUSTOM_INTAKE_LINK,
                                                    'custom_intake_link' => route('intake_form') . "?token=" . base64_encode($attorney_id)
                                                ];
                                                // Get the shortened URL base
                                                $shortUrlBase = \App\Models\ShortLink::getSetLink($linkinput, $attorney_id);
                                            @endphp
										@foreach($onePage as $val)
										<!-- step_completed
									step_1_submited
									step_2_submited
									step_3_submited -->
										<tr class="request-{{$val->id}}">
											<td>{{ DateTimeHelper::dbDateToDisplay($val->created_at, true) }}</td>
											<td>{{$val->name}} {{$val->middle_name}} {{$val->last_name}} </td>
											<td>{{ArrayHelper::getMartialStatus($val->martial_status)}}</td>
											<td>{{$val->cell}}</td>
											<td>{{$val->email}}</td>
											<td>
												<div class="d-flex align-items-center justify-content-center">
                                                            @if ($val->step_completed > 0)
                                                                @php
                                                                    // Create step-specific URLs with userId appended
                                                                    $step1Url = $val->step_1_submited == 1 ? $shortUrlBase . "/" . base64_encode($val->id) . "?stepNo=1" : '';
                                                                    $step2Url = $val->step_2_submited == 1 ? $shortUrlBase . "/" . base64_encode($val->id) . "?stepNo=2" : '';
                                                                    $step3Url = $val->step_3_submited == 1 ? $shortUrlBase . "/" . base64_encode($val->id) . "?stepNo=3" : '';
                                                                @endphp
                                                                <i class="bi bi-1-circle-fill fs-16px me-1 {{ $val->step_1_submited == 1 ? 'text-success step-status-copy' : 'text-danger' }}"
                                                                    data-success="Form 1 Url Copied !"
                                                                    @if (!empty($step1Url)) data-url="{{ $step1Url }}" onclick="copyFromDataUrl(this)" @endif></i>
                                                                <i class="bi bi-2-circle-fill fs-16px me-1 {{ $val->step_2_submited == 1 ? 'text-success step-status-copy' : 'text-danger' }}"
                                                                    data-success="Form 2 Url Copied !"
                                                                    @if (!empty($step2Url)) data-url="{{ $step2Url }}" onclick="copyFromDataUrl(this)" @endif></i>
                                                                <i class="bi bi-3-circle-fill fs-16px {{ $val->step_3_submited == 1 ? 'text-success step-status-copy' : 'text-danger' }}"
                                                                    data-success="Form 3 Url Copied !"
                                                                    @if (!empty($step3Url)) data-url="{{ $step3Url }}" onclick="copyFromDataUrl(this)" @endif></i>
                                                            @endif
                                                        </div>
											</td>
											<td>
												<div class="d-flex align-items-center">
													<a href="#" class="close-modal view_client_btn me-3"
														onclick="attorney_short_form_notes_popup('{{$val->id}}')">
														<span class="">Notes</span>
													</a>
													<a href="#" class="close-modal view_client_btn me-3"
														onclick="details_view_modal('{{$val->id}}')">
														<span class="">View</span>
													</a>
													@if($val['onepage_questionnaire_request_id'] > 0)
														<i class="feather icon-check"></i>&nbsp;<span class="me-3">INVITE SENT</span>
													@else
														@if($val->step_completed == 0 || ($val->step_1_submited == 1 && $val->step_2_submited == 1 && $val->step_3_submited == 1))
														<a href="javascript:void(0)"
															onclick='openmodel("{{$val->email}}","{{$val->name}}","{{$val->last_name}}","{{$val->cell}}","{{$val->martial_status}}","{{$val->id}}", "{{$val->spouse_email}}","{{$val->spouse_name}}","{{$val->spouse_last_name}}","{{$val->spouse_cell}}","{{$val->spouse_filing_with_you}}")'
															class="close-modal view_client_btn me-3"
															data-email="{{$val->email}}"
															data-name="{{$val->name}} {{$val->middle_name}} {{$val->last_name}}"
															id="invitepopup">
															<i class="feather icon-plus"></i>
															<span class="">INVITE</span>
														</a>
														@endif
													@endif

													<button type="button"
														onclick='deleteIntakeRequest("{{$val->id}}", "{{$val->name}} {{$val->middle_name}} {{$val->last_name}}")'
														class="float-right delete-div ml-auto" title="Delete">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
															fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
															<path
																d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
															</path>
														</svg>
														Delete
													</button>
												</div>
											</td>
										</tr>
										@endforeach
										@else
									<tr class="unread">
										<td colspan="6" class="text-center">No Record Found.</td>
									</tr>
								@endif
									</tbody>
								</table>
								<div class="d-flex justify-content-between align-items-center px-2 paginationb"
									id="the_table">
									@if ($onePage->count())
										<div class="shoing">
											@if ($onePage->count())
												Showing {{ $onePage->firstItem() }} to {{ $onePage->lastItem() }} of
												{{ $onePage->total() }} entries
											@endif
										</div>
										<div>
											{{ $onePage->links() }}
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 ">

		</div>

	</div>

	@include('attorney.invite_client_popup')
	@include('modal.attorney.client_intake_management.preset_questions', $conditionalQuePopupData)
	@include('modal.attorney.client_intake_management.yes_no_questions', ['questions' => $questions])

	<style>
		#questionnaire_import_modal .modal-dialog {
			max-width: 1350px;
		}

		#copy_url:hover {
			cursor: pointer;
		}

		#facebox .content.fbminwidth {
			min-width: 100vw !important;
		}

		input[type=checkbox] {
			/* IE */
			-ms-transform: scale(1);
			/* FF */
			-moz-transform: scale(1);
			/* Safari and Chrome */
			-webkit-transform: scale(1);
			/* Opera */
			-o-transform: scale(1);
		}

		.large-fb-width {
			min-width: 100vh;
		}
	</style>

	@push('scripts')
	<script>
		window.QuestionnaireIntakeConfig = {
			routes: {
				short_form_notes: "{{ route('attorney_short_form_notes_popup') }}",
				questionnaire_view: "{{ route('questionnaire_view') }}",
				questionnaire_import: "{{ route('questionnaire_import') }}",
				questionnaire_index: "{{ route('questionnaire_index') }}",
				delete_intake_request: "{{ route('delete_intake_request') }}",
				log_history: "{{ route('show_log_history_modal') }}"
			}
		};
	</script>
	<script src="{{ asset('assets/js/attorney/questionnaire-intake.js') }}?v=1.04"></script>
	@endpush

@endsection
