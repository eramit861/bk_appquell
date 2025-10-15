@extends("layouts.attorney")
@section('content')
@include("layouts.flash")

<div class="row paralegal_list">
	<div class="col-12">
		<div class="mcard ">
			<div class="mcard-body">
				<div class="card-title-header">
					<div class="row ">
						<div class="col-md-4 col-sm-12 d-flex align-items-center">
							<h4 class="card-title pb-0 mb-0 bb-0-i">
								<i class="bi bi-person-circle"></i> Paralegal(s) Management
							</h4>
						</div>
						<div class="col-8 col-md-4 col-sm-6 d-flex align-items-center justify-content-center mt-2 pr-0">
							<a class="btn-new-ui-default bg-white py-1 atty_video_btn" style="margin-top: 0px ! important" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 26px;" alt="Video Logo">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()" ><img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px" alt="AI"> See AI Processed Docs Status</a>
						</div>
						<div class="col-4 col-md-4 col-sm-6 mt-2 d-flex align-items-center">
							<button class="btn btn-primary float_right btn-new-ui-default ml-auto mb-0" data-bs-toggle="modal" data-bs-target="#add_attorney">
								<i class="feather icon-plus"></i> ADD
							</button>
						</div>
					</div>
				</div>
				<div class="short_div">
					<div class="show d-flex align-items-center">
						<form action="{{ route('attorney_paralegal_management') }}" method="GET" id="paginationForm" class="d-flex align-items-center">
							<label for="per_page" class="mb-0 per_page">Show:</label>
							<select name="per_page" id="per_page" class="per_page form-select form-control" onchange="document.getElementById('paginationForm').submit();">
								<option value="10" {{ request('per_page') == 10 ? 'selected' : '' }} >10</option>
								<option value="25" {{ request('per_page') == 25 ? 'selected' : '' }} >25</option>
								<option value="50" {{ request('per_page') == 50 ? 'selected' : '' }} >50</option>
								<option value="100" {{ request('per_page') == 100 ? 'selected' : '' }} >100</option>
							</select>
						</form>
					</div>
					<div class="search-field">
						<form class="d-flex align-items-center h-100 sr" id="searchForm" action="{{route('attorney_paralegal_management')}}" method="GET">
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

    <div class="col-12 ">
		<div class="card mt-2 bg-transparent b-0-i">
			<div class="card-body card-body-padding">
				<div class="table-responsive">
					<table class="table">
						<tbody>
                            <tr>
                                <th>
									<a href="{{ route('attorney_paralegal_management', [
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
                                <th>
									<a href="{{ route('attorney_paralegal_management', [
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
                                <th>
									<a href="{{ route('attorney_paralegal_management', [
												'sort_by' => 'phone_no',
												'sort_order' => ($sort_by == 'phone_no' && $sort_order == 'asc') ? 'desc' : 'asc', 
												'q' => request('q'),
												'per_page' => request('per_page')
											]) }}">
                                        Phone										
											@if ($sort_order == 'asc' && $sort_by == 'phone_no')
												<i class="bi bi-caret-down-fill"></i>
											@else
												<i class="bi bi-caret-up-fill"></i>
											@endif
										
									</a>
								</th>
                                <th>Appointment Link</th>
                                <th>Action</th>
                                <th>Active Assigned Cases</th>
                            </tr>
							@if (!empty($attorney) && count($attorney) > 0)
							@foreach ($attorney as $val)
								<tr class="unread attorney-{{ $val['id'] }}">
									<td><span>{{ $val['name'] ?? "" }}</span>
									@if (!empty($val['paralegal_law_firm_id']))<br> <strong>(Law Firm)</strong>@endif</td>
									<td><span>{{ $val['email'] ?? "" }}</span></td>
									<td><span>{{ $val['phone_no'] ?? "" }}</span></td>
									<td>
										@if (!empty($val['appointment_link'] ?? ''))
										<a onclick="copy(this)" href="javascript:void(0)" id="copy_url" data-full-url="{{ $val['appointment_link'] }}">
											<span class="text-c-light-blue">
												{{ \Illuminate\Support\Str::limit($val['appointment_link'] ?? '', 20) }}
												<i class="fas fa-copy ml-1"></i>
											</span>
										</a>
										@endif
									</td>
									<td>
										<div class="d-flex align-items-center">											
											<a href="javascript:void(0)" onclick="editParalegal('{{ route('attorney_paralegal_toggle_menu_items_popup', ['id' => $val['id']]) }}');" class="view_client_btn me-3">Enable Paralegal Menu</a>
											<a href="javascript:void(0)" onclick="editParalegal('{{ route('attorney_paralegal_edit_popup', ['id' => $val['id']]) }}', 'large-fb-width');" class="view_client_btn me-3">Edit</a>
											<button onclick='deleteAttorney("{{ route("attorney_paralegal_delete") }}",{{ $val["id"]}},"{{ $val["name"] }}")' type="button" class="delete-div" title="Delete">
												<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
													<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
													</path>
												</svg>
												Delete
											</button>
                                        </div>
                                    </td>
									<td><span>{{ $val['client_count'] }}</span></td>
                                </tr>
							@endforeach
							@else
							<tr class="unread">
								<td colspan="6">{{ __('No Record Found.') }}</td>
							</tr>
							@endif
                        </tbody>
					</table>
					<div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">
						@if ($attorney->count())
							<div class="shoing">
								@if ($attorney->count())
									Showing {{ $attorney->firstItem() }} to {{ $attorney->lastItem() }} of {{ $attorney->total() }} entries
								@endif
							</div>
							<div>
								{{ $attorney->links() }}
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<style>
	@media only screen and (max-width: 1024px) {
		#facebox .content.fbminwidth{
			min-width: 100% !important;
		}

		#facebox{
			left: unset !important;
			max-width: 100% !important;
			width: 100% !important;
		}

		#facebox .popup{
			max-width: 100%;
			width: 100%;
		}
	}
</style>

@include('modal.attorney.paralegal_management.add')

@push('scripts')
<script>
    window.ParalegalConfig = {
        showEditModal: {{ (session('edit_id') && $errors->any()) ? 'true' : 'false' }},
        editId: {{ session('edit_id') ?? 0 }},
        editRoute: "{{ session('edit_id') ? route('attorney_paralegal_edit', ['id' => session('edit_id')]) : '' }}"
    };
</script>
<script src="{{ asset('assets/js/attorney/paralegal-management.js') }}"></script>
@endpush

@endsection