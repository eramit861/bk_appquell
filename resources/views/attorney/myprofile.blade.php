@extends('layouts.attorney',["video" => $video])

@push('styles')
<link rel="stylesheet" href="{{ asset('css/attorney-profile.css') }}">
@endpush

@section('content')
@include("layouts.flash")

@php
     $subvideo = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_SETTING_SUBSCRIPTION);
     $petvideo = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_SETTING_PETITION_PREP);
     $welcomevideo = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_SETTING_WELCOME_VIDEO);
@endphp

<div class="row">
    <div class="col-12">
        <div class="mcard">
            <div class="mcard-body">
                </h4>
				<div class="card-title-header">
					<div class="row ">
						<div class="col-12 col-sm-4 d-flex align-items-center">
							<h4 class="card-title pb-0 mb-0 bb-0-i">
								<i class="bi bi-person-circle"></i> Manage Profile
							</h4>
						</div>
						<div class="col-12 col-sm-6 col-md-4 d-flex align-items-center justify-content-center">
							<a class="btn-new-ui-default bg-white py-1 atty_video_btn" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 26px;" alt="Video Logo">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()" ><img src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px" alt="AI Logo"> See AI Processed Docs Status</a>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>

	<div class="col-12">
		<div class="card information-area" data-is-lawfirm="{{ !empty(Auth::user()->paralegal_law_firm_id) ? 1 : 0 }}" data-delete-mobile-video-url="{{ route('delete_attorney_mobile_video') }}">
			<div class="card-body">
				<div class="row gx-3">
					@if (empty(Auth::user()->paralegal_law_firm_id))
					<div class="col-12">
						<div class="card-title-header pb-2">
							<h4 class="card-title pb-0 mb-0 bb-0-i ">
								<i class="bi bi-person-lines-fill"></i> Profile Settings
							</h4>
						</div>
					</div>
					<div class="col-12 ">
						@include('attorney.manage_profile.profile')
					</div>
					@endif
					<div class="col-12">
						<div class="card-title-header pb-2">
							<h4 class="card-title pb-0 mb-0 bb-0-i ">
								<i class="bi bi-key"></i> Password Settings
							</h4>
						</div>
					</div>
					<div class="col-12 ">
						@include('attorney.manage_profile.password')
					</div>
					@if (empty(Auth::user()->paralegal_law_firm_id))
					<div class="col-12">
						<div class="card-title-header pb-2">
							<h4 class="card-title pb-0 mb-0 bb-0-i ">
								<i class="bi bi-credit-card-2-front"></i> Credit / Debit Card Settings
							</h4>
						</div>
					</div>
					<div class="col-12">
						@include('attorney.manage_profile.card')
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>

</div>

{{-- inline validation and deleteMobileVideo moved to assets/js/attorney/myprofile.js --}}

<!-- [ Main Content ] start -->
<div class="row">
	<div class="col-md-12">
		<div class="tab-content p-0 shadow-none" id="v-pills-tabContent">
			<div class="tab-pane fade hide-data" id="retainer_doc" role="tabpanel"
				aria-labelledby="profile-tab">
				<div class="card attorney-listing attorney-setting-table">
					<div class="card-header justify-content-start">
						<h4>{{ __('Retainer Agreement') }}</h4>
					</div>
					<div class="card-block">
						<form name="attorney_retainer_doc_frm" id="attorney_retainer_doc_frm" action="{{route('attorney_retainer_doc')}}" method="post" enctype="multipart/form-data" novalidate>
							@csrf
							<div class="row">
								<div class="col-md-12">
									<div class="avatar-upload">
										<div class="avatar-edit">
											<input type='file' name="retainer_document" id="retainer_document" accept=".png, .jpg, .jpeg" /> <label for="retainer_document"></label>
										</div>
										<div class="avatar-preview" id="retainer__preview__DL">
											<img class="profile-user-img img-responsive img-circle" id="retainer_document_imagePreview" src="{{url('assets/images/documents/report.png')}}" alt="{{ __('Retainer Document') }}">
										</div>
										<div class="doc-preview hide_img_preview position-relative" id="both__preview__DL">
											<iframe id="pdfboth-licence-imagePreview" src=""
											alt="User profile picture" width="150"height="150" type="application/pdf"></iframe>
										</div>
									</div>
								</div>
								<input type="hidden" name="document_id" value="{{ @$retainer_documents->id }}">
								<div class="col-sm-12 text-right">
									@if (!empty($retainer_documents->retainer_document) && file_exists(public_path().'/'.$retainer_documents->retainer_document))
										<a href="{{ url($retainer_documents->retainer_document) }}" class="btn font-weight-bold border-blue-big" download>{{ __('Download') }}</a>
									@endif
									<a onclick="gotToProfile()" class="btn btn-default" >{{ __('Back') }}</a>
									<button type="submit"
										class="btn font-weight-bold border-blue-big">{{ __('Upload') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="tab-pane fade {{ $active == 4 ? 'show active' : '' }}" id="additional_add_ons" role="tabpanel"
				aria-labelledby="profile-tab">
				<div class="card attorney-listing attorney-setting-table">
					<div class="card-header justify-content-start">
						<h4> <span class="border-bottom-light-blue"> Subscription(s)/Add-ons </span> </h4>
					</div>
					<div class="card-block">
						<div class="row">

						@include('attorney.subscription_addon_popup')
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<!-- [ Main Content ] end -->

<script src="{{ asset('assets/js/jquery.validate.js' )}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<div class="modal fade" id="cropImagePop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div id="upload-full-image"><img src="" width="100%" height="100%" alt="img"></div>
                <div id="upload-crop-image" class="center-block"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close_crop" id="cancelCropBtn" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-default" id="Flip">{{ __('Flip') }}</button>
                {{-- <button class="btn btn-default" id="rotate" data-deg="-90">{{ __('Rotate') }}</button> --}}
                <button type="button" id="startCropImageBtn" class="btn btn-primary">{{ __('Start Crop') }}</button>
                <button type="button" id="cropImageBtn" class="btn btn-primary">{{ __('Select') }}</button>
            </div>
        </div>
    </div>
</div>
{{-- croppie handlers moved to assets/js/attorney/myprofile.js --}}

<script>
window.APP_NON_DISCOUNT_PACKAGE = {!! json_encode(\App\Models\AttorneySubscription::NON_DISCOUNT_PACKAGE) !!};
window.APP_SUBSCRIPTION_DISCOUNT_PERCENT = {{ (int) auth()->user()->subscription_discount_percent }};
window.APP_PETITION_BASIC = {{ \App\Models\AttorneySubscription::BASIC_PETITION_PREPARATION }};
window.APP_PETITION_PREMIUM = {{ \App\Models\AttorneySubscription::PREMIUM_PETITION_PREPARATION }};
window.APP_PARALEGAL_BASIC = {{ \App\Models\AttorneySubscription::BASIC_PARALEGAL_ADDON }};
window.APP_PARALEGAL_PREMIUM = {{ \App\Models\AttorneySubscription::PREMIUM_PARALEGAL_ADDON }};
</script>
<script src="{{ asset('assets/js/attorney/myprofile.js') }}" defer></script>
@endsection
