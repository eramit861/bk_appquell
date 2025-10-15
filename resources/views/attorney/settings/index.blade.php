@extends('layouts.attorney', ['video' => $video])

@section('content')
@include('layouts.flash')

@php
$documentlisttoexlude = [
    'Last_Year_Tax_Returns',
    'Prior_Year_Tax_Returns',
    'Prior_Year_Two_Tax_Returns',
    'Prior_Year_Three_Tax_Returns',
    'Vehicle_Registration',
    'Pre_Filing_Bankruptcy_Certificate_CCC',
    'W2_Last_Year',
    'W2_Year_Before',
    'Insurance_Documents',
    'Other_Misc_Documents',
    'Current_Mortgage_Statement',
    'Current_Auto_Loan_Statement',
];
$attorney_enabled_bank_statment = Helper::validate_key_value('attorney_enabled_bank_statment', $attorneySettings, 'radio');
$enabled_detailed_property = Helper::validate_key_value('enabled_detailed_property', $attorneySettings, 'radio');
$enable_text_msg_notification_email = Helper::validate_key_value('enable_text_msg_notification_email', $attorneySettings, 'radio');
$transaction_pdf_enabled = Helper::validate_key_value('transaction_pdf_enabled', $attorneySettings, 'radio');
$transaction_pdf_signature_enabled = Helper::validate_key_value('transaction_pdf_signature_enabled', $attorneySettings, 'radio');
$zip_in_schedule_structure = Helper::validate_key_value('zip_in_schedule_structure', $attorneySettings, 'radio');
$is_car_title_enabled = Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio');
$is_rental_agreement_enabled = Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio');
$is_debt_header_custom_enabled = Helper::validate_key_value('is_debt_header_custom_enabled', $attorneySettings, 'radio');
$is_confirm_prompt_enabled = Helper::validate_key_value('is_confirm_prompt_enabled', $attorneySettings, 'radio');
$is_doc_upload_restriction_enabled = Helper::validate_key_value('is_doc_upload_restriction_enabled', $attorneySettings, 'radio');
$is_current_partial_month_enabled = Helper::validate_key_value('is_current_partial_month_enabled', $attorneySettings, 'radio');
$certificateenable = !empty($certificateenable);

$associate_name = Helper::validate_key_value('associate_name', $associate_data);
$associate_name = $associate_name ?? 'Associate';
@endphp

<div class="row">
    <div class="col-12">
        <div class="mcard">
            <div class="mcard-body">
                <div class="card-title-header">
                    <div class="row ">
                        <div class="col-sm-4 col-12 d-flex align-items-center">
                            <h4 class="card-title pb-0 mb-0 bb-0-i">
                                <i class="bi bi-gear"></i> 
                                @if (request()->routeIs('attorney_lawfirm_settings'))
                                    Law Firm Settings - {{ $associate_name }}
                                @else
                                    Manage Settings
                                @endif
                            </h4>
                        </div>
                        <div class="col-sm-4 col-12 d-flex align-items-center justify-content-center">
                            <a class="btn-new-ui-default bg-white py-1 atty_video_btn" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title=" Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
                                <img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" alt="Video Logo" class="mx-auto" style="height: 26px;">
                            </a>
                        </div>
                        <div class="col-sm-4 col-12">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card information-area">
            <ul class="nav nav-pills nav-fill w-100 p-0" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $type == 1 ? 'active' : '' }}" id="pills-show-hide-documents-tab" data-bs-toggle="pill" data-bs-target="#pills-show-hide-documents" type="button" role="tab" aria-controls="pills-show-hide-documents" aria-selected="true">Show/Hide Documents</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $type == 2 ? 'active' : '' }}" id="document-setting-tab" data-bs-toggle="pill" data-bs-target="#document-setting" type="button" role="tab" aria-controls="document-setting" aria-selected="false">Manage Document Settings</button>
                </li>
                @if (!request()->routeIs('attorney_lawfirm_settings'))
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $type == 3 ? 'active' : '' }}" id="notification-setting-tab" data-bs-toggle="pill" data-bs-target="#notification-setting" type="button" role="tab" aria-controls="notification-setting" aria-selected="false">Manage Notifications</button>
                    </li>
                @endif
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $type == 4 ? 'active' : '' }}" id="common-document-list-tab" data-bs-toggle="pill" data-bs-target="#common-document-list" type="button" role="tab" aria-controls="common-document-list" aria-selected="false">Invite Common Document List</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $type == 5 ? 'active' : '' }}" id="post-submission-common-document-list-tab" data-bs-toggle="pill" data-bs-target="#post-submission-common-document-list" type="button" role="tab" aria-controls="common-document-list" aria-selected="false">Post Submission Document List</button>
                </li>
            </ul>
            <div class="card-body border-top-left-radius-none">
                <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                    <div class="tab-pane fade {{ $type == 1 ? 'show active' : '' }}" id="pills-show-hide-documents" role="tabpanel" aria-labelledby="pills-show-hide-documents-tab" tabindex="0">
                        @include('attorney.settings.tab_show_hide_docs')
                    </div>
                    <div class="tab-pane fade {{ $type == 2 ? 'show active' : '' }}" id="document-setting" role="tabpanel" aria-labelledby="document-setting-tab" tabindex="0">
                        @include('attorney.settings.tab_manage_docs')
                    </div>
                    @if (!request()->routeIs('attorney_lawfirm_settings'))
                        <div class="tab-pane fade {{ $type == 3 ? 'show active' : '' }}" id="notification-setting" role="tabpanel" aria-labelledby="notification-setting-tab" tabindex="0">
                            @include('attorney.settings.tab_manage_notifications')
                        </div>
                    @endif

                    <div class="tab-pane fade {{ $type == 4 ? 'show active' : '' }}" id="common-document-list" role="tabpanel" aria-labelledby="common-document-list-tab" tabindex="0">
                        @include('attorney.settings.common_docs', ['documents' => $commonDocuments, 'delete_route' => route("attorney_common_doc_delete")])
                    </div>
                    <div class="tab-pane fade {{ $type == 5 ? 'show active' : '' }}" id="post-submission-common-document-list" role="tabpanel" aria-labelledby="post-submission-common-document-list-tab" tabindex="0">
                        @include('attorney.settings.post_submission_docs', ['documents' => $pSDocuments, 'delete_route' => route("attorney_common_doc_delete")])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('modal.attorney.manage_settings.pre_filing_ccc')

@push('scripts')
<script type="text/javascript">
    window.AttorneySettingsConfig = {
        routes: {
            setup_certificate_ccc: '{{ route("setup_attorney_certificate_ccc") }}',
            attorney_exclude_docs: '{{ route("attorney_exclude_docs") }}'
        },
        is_associate: {{ Helper::validate_key_value('is_associate', $associate_data, 'radio') }},
        associate_id: {{ Helper::validate_key_value('associate_id', $associate_data, 'radio') }}
    };
    // The external script relies on jQuery, jQuery Validate, and laws.* helpers already loaded on the page
</script>
<script src="{{ asset('assets/js/attorney/attorney-settings.js') }}"></script>
@endpush
<style>
    label.error {
        color: red;
        font-style: italic;
    }
</style>
@endsection