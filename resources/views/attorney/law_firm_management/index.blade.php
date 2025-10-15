@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")


<div class="row">
	<div class="col-12">
		<div class="mcard ">
			<div class="mcard-body">

				<div class="card-title-header">
					<div class="row d-flex flex-column flex-sm-row">
						<div class="col-12 col-sm-4 d-flex align-items-center">
							<h4 class="card-title pb-0 mb-0 bb-0-i">
								<i class="bi bi-people"></i> Law Firm Management
							</h4>
						</div>
						<div class="col-6 d-flex align-items-center  mt-sm-0 mt-2">
							<a class="btn-new-ui-default bg-white att-video py-1 mx-auto" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="<?php echo $video['en']; ?>" data-video2="<?php echo $video['sp']; ?>">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 26px;" alt="Video Logo">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()" ><img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px" alt="AI"> See AI Processed Docs Status</a>
						</div>
						<div class="col-2 d-flex align-items-center mt-sm-0 mt-2">
							<button class="btn btn-primary float_right btn-new-ui-default m-0 ml-auto" data-bs-toggle="modal" data-bs-target="#add_attorney">
								<i class="feather icon-plus"></i> Add Law firm
							</button>
						</div>
					</div>
				</div>

				<div class="short_div">
					<div class="show d-flex align-items-center">
					</div>
					<div class="search-field">
						<form class="d-flex align-items-center h-100 sr" id="searchForm" action="{{route('law_firm_associate_management')}}" method="GET">
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
			<div class="card-body">
				<div class="table-responsive">
					<table class="table">
						<tbody>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Phone No</th>
								<th>Action</th>
								<!-- <th>Active Assigned Cases</th> -->
							</tr>
							<?php
                            if (!empty($associates) && count($associates) > 0) {
                                foreach ($associates as $key => $val) {
                                    ?>
									<tr>
										<td><?php echo Helper::validate_key_value('firstName', $val); ?> <?php echo Helper::validate_key_value('lastName', $val); ?></td>
										<td><?php echo Helper::validate_key_value('email', $val); ?></td>
										<td><?php echo Helper::validate_key_value('phone_no', $val); ?></td>
										<td>
											<a href="javascript:void(0)" onclick="editParalegal('<?php echo route('law_firm_associate_edit', ['id' => $val['id']]) ?>');" class="view_client_btn me-3">Edit</a>
											<a href="<?php echo route('attorney_lawfirm_settings', ['associate_id' => $val['id'] ?? '']); ?>" class="view_client_btn me-3">Setting</a>
											<a href="<?php echo route('law_firm_associate_remove', $val['id'] ?? ''); ?>">
												<button type="button" class="delete-div" title="Delete">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
														<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
														</path>
													</svg>
													Delete
												</button>
											</a>
										</td>
									</tr>
							<?php
                                }
                            } else {
                                ?>
								<tr class="unread">
									<td colspan="4">{{ __('No Record Found.') }}</td>
								</tr>
							<?php
                            }
							?>

						</tbody>
					</table>
					<div class="d-flex justify-content-between align-items-center px-2 paginationb" id="the_table">

					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<!-- add modal -->
@include('modal.attorney.law_firm_management.add')
<script>
	editParalegal = function(ajaxurl) {
		laws.ajax(ajaxurl, {}, function(response) {

			if (isJson(response)) {
				var res = JSON.parse(response);
				if (res.status == 0) {
					$.systemMessage(res.msg, 'alert--danger', true);
				} else if (res.status == 1) {
					$.systemMessage(res.msg, 'alert--success', true);

					setTimeout(function() {
						location.reload(true);
					}, 1000);
				}
			} else {
				laws.updateFaceboxContent(response, 'large-fb-width questions_popup_div');
			}

		});
	}
</script>
@endsection