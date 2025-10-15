@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")


<div class="row transaction_history">
	<div class="col-12">
		<div class="mcard ">
			<div class="mcard-body">
				<div class="card-title-header">
					<div class="row ">
						<div class="col-lg-4 col-md-8 col-12 d-flex align-items-center">
							<h4 class="card-title pb-0 mb-0 bb-0-i">
								<i class="fa fa-usd"></i> Transactions History - Purchased Subscriptions/Add-ons
							</h4>
						</div>
                        <div class="col-md-4 col-12 d-flex align-items-center justify-content-center video_button_div">
                            <a class="btn-new-ui-default bg-white py-1 atty_video_btn" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 26px;" alt="Video Logo">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()" ><img alt="AI" src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px"> See AI Processed Docs Status</a>
						</div>
						<div class="col-0 d-flex align-items-center">
						</div>
					</div>
				</div>
				<div class="short_div">
					<div class="show d-flex align-items-center">
						<form action="{{ route('attorney_transactions_consumed') }}" method="GET" id="paginationForm" class="d-flex align-items-center">
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
						<form class="d-flex align-items-center h-100 sr" id="searchForm" action="{{route('attorney_transactions_consumed')}}" method="GET">
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
									<a href="{{ route('attorney_transactions_consumed', [
												'sort_by' => 'package_id',
												'sort_order' => ($sort_by == 'package_id' && $sort_order == 'asc') ? 'desc' : 'asc', 
												'q' => request('q'),
												'per_page' => request('per_page')
											]) }}">
										Questionnaire type/add-on										
											@if ($sort_order == 'asc' && $sort_by == 'package_id')
												<i class="bi bi-caret-down-fill"></i>
											@else
												<i class="bi bi-caret-up-fill"></i>
											@endif
										
									</a>
								</th>
                                <th>
									<a href="{{ route('attorney_transactions_consumed', [
												'sort_by' => 'name',
												'sort_order' => ($sort_by == 'name' && $sort_order == 'asc') ? 'desc' : 'asc', 
												'q' => request('q'),
												'per_page' => request('per_page')
											]) }}">
										Consumed for Client										
											@if ($sort_order == 'asc' && $sort_by == 'name')
												<i class="bi bi-caret-down-fill"></i>
											@else
												<i class="bi bi-caret-up-fill"></i>
											@endif
										
									</a>
								</th>
                                <th>
									<a href="{{ route('attorney_transactions_consumed', [
												'sort_by' => 'quantity',
												'sort_order' => ($sort_by == 'quantity' && $sort_order == 'asc') ? 'desc' : 'asc', 
												'q' => request('q'),
												'per_page' => request('per_page')
											]) }}">
										Consumed Units										
											@if ($sort_order == 'asc' && $sort_by == 'quantity')
												<i class="bi bi-caret-down-fill"></i>
											@else
												<i class="bi bi-caret-up-fill"></i>
											@endif
										
									</a>
								</th>
                                <th>
									<a href="{{ route('attorney_transactions_consumed', [
												'sort_by' => 'created_at',
												'sort_order' => ($sort_by == 'created_at' && $sort_order == 'asc') ? 'desc' : 'asc', 
												'q' => request('q'),
												'per_page' => request('per_page')
											]) }}">
										Consumed at										
											@if ($sort_order == 'asc' && $sort_by == 'created_at')
												<i class="bi bi-caret-down-fill"></i>
											@else
												<i class="bi bi-caret-up-fill"></i>
											@endif
										
									</a>
								</th>
                            </tr>
                            @if (!empty($listing) && count($listing) > 0)
                                @foreach ($listing as $val)
                                <tr class="unread">
                                    <td><span>{!! $val->package_name !!}</span></td>
                                    <td><span><a title="Click here to view client details" href="{{ route('attorney_form_submission_view', ['id' => $val->client_id]) }}">{{ $val->name }}</a></span></td>
                                    <td><span>{{ $val->quantity }}</span></td>
                                    <td><span>{{ DateTimeHelper::dbDateToDisplay($val->created_at, true) }}</span></td>
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
						@if ($listing->count())
							<div class="shoing">
								@if ($listing->count())
									Showing {{ $listing->firstItem() }} to {{ $listing->lastItem() }} of {{ $listing->total() }} entries
								@endif
							</div>
							<div>
								{{ $listing->links() }}
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection
