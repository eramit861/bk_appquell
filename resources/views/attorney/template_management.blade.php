@extends('layouts.attorney',['video' => $video])
@section('content')
@include("layouts.flash")

<div class="row">
	<div class="col-12">
		<div class="mcard ">
			<div class="mcard-body">
				<div class="card-title-header">
					<div class="row ">
						<div class="col-md-5 col-12 d-flex align-items-center">
							<h4 class="card-title pb-0 mb-0 bb-0-i">
								<i class="bi bi-file-ruled"></i> Customize Property Section
							</h4>
						</div>
						<div class="col-8 col-md-4 col-sm-6 d-flex align-items-center justify-content-center mt-2 pr-0">
							<a class="btn-new-ui-default bg-white att-video py-1 mx-auto" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
								<img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 26px;" alt="Video Logo">
							</a>
							<a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()"><img alt="AI" src="{{ asset('assets/img/ai_icon_dark.png')}}" class="ai-icon" style="height:20px"> See AI Processed Docs Status</a>
						</div>
						<div class="col-1 d-flex align-items-center">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12">
		<div class="card information-area mt-3">
			<ul class="nav nav-pills nav-fill w-100 p-0" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'personal_household_items' ? 'active' : '' }}"
						onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'personal_household_items']) }}')"
						id="personal-household-items-tab" data-bs-toggle="pill" data-bs-target="#personal-household-items-template" type="button" role="tab" aria-controls="template-personal-household-items" aria-selected="true">
						Standard Personal and Household Items
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'detailed_property' ? 'active' : '' }}"
						onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'detailed_property']) }}')"
						id="detailed-property-tab" data-bs-toggle="pill" data-bs-target="#detailed-property-template" type="button" role="tab" aria-controls="template-detailed-property" aria-selected="true">
						Detailed Personal and Household Items
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'financial_assets' ? 'active' : '' }}"
						onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'financial_assets']) }}')"
						id="financial-assets-tab" data-bs-toggle="pill" data-bs-target="#financial-assets-template" type="button" role="tab" aria-controls="template-financial-property" aria-selected="true">
						Financial Assets
					</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link {{ $type == 'money_own_to_you' ? 'active' : '' }}"
						onclick="redirectToURL('{{ route('attorney_template_management', ['type' => 'money_own_to_you']) }}')"
						id="money_own_to_you-tab" data-bs-toggle="pill" data-bs-target="#money_own_to_you-template" type="button" role="tab" aria-controls="template-money_own_to_you-property" aria-selected="true">
						Money Own to You
					</button>
				</li>
			</ul>
			<div class="card-body border-top-left-radius-none">
				<div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
					<div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
						@if ($type == 'personal_household_items')
							@include('attorney.template_management.personal_household_items')
						@endif

						@if ($type == 'detailed_property')
							@include('attorney.template_management.detailed_property')
						@endif

						@if ($type == 'financial_assets')
							@include('attorney.template_management.financial_assets')
						@endif

						@if ($type == 'money_own_to_you')
							@include('attorney.template_management.money_own_to_you')
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.error {
		color: red;
	}

	input[type="number"] {
		-moz-appearance: textfield;
	}
	  .question-text {
        white-space: normal !important;
        word-break: break-word;
        max-width: 850px; /* Adjust as needed */
    }
    .custom-radio-group {
        min-width: 120px; /* Adjust as needed */
        gap: 10px;
        justify-content: center;
    }
    .table td, .table th {
        vertical-align: middle;
    }
</style>

@push('scripts')
<script>
	window.TemplateManagementConfig = {};
</script>
<script src="{{ asset('assets/js/attorney/template-management.js') }}"></script>
@endpush

@endsection