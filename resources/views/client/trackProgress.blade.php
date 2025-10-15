@extends('layouts.client')
@section('content')
    @include('layouts.flash')
    <!-- [ Main Content ] start -->
    @php
        $user = Auth::user();
        $client_id = Auth::user()->id;
        $progress_percentage = $progress['all_percentage'];
        $class = '';
        if ($progress_percentage == 0) {
            $class = 'bg-danger';
        }
        if ($progress_percentage > 50 && $progress_percentage < 75) {
            $class = 'bg-warning';
        }
        if ($progress_percentage > 75 && $progress_percentage < 90) {
            $class = 'bg-info';
        }
        if ($progress_percentage == 100) {
            $class = 'bg-success';
        }

        $msg = $progress_percentage . '%';
        if ($progress_percentage == 100) {
            $msg = '100%';
        }
        $width = $progress_percentage;
        if ($progress_percentage == 0) {
            $width = 100;
        }

        $refreenceParent = Session::get('refrence_parent');
        $refreenceAdmin = Session::get('refrence_admin');
    @endphp

    @php $web_view = Session::get('web_view'); @endphp

    <div class="row">
        @if (@$web_view)
            <div class="d-flex col-md-12 col-sm-12 col-lg-12 col-xl-12 mt-4">
                <a href="{{ route('pre_client_dashboard') }}" class="btn-new-ui-default me-2 btn-primary">
                    <i class="fa fa-arrow-left mr-1"></i>Back To Dashboard
                </a>

                @if (isset($video) && !empty($video))
                    <a id="videoanchor" style="position: absolute; right: 20px; top: -10px;" href="javascript:void(0)"
                        class="download-forms  text-c-blue f-w-800 heading-menu nav-link mb-0 pb-0 text-left"
                        data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                        title=" Click for Step by Step video" data-video="{{ $video['en'] }}"
                        data-video2="{{ $video['sp'] }}">
                        Step-by-step <img src="{{ url('assets/img/video-icon.jpg') }}" alt="Video Icon"
                            style="height: 36px;">
                    </a>
                @endif
            </div>

        @endif


        <div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
            <div class="row">
                <div class="col-md-12 pl-0 pr-0 col-sm-12">
                    <div class="tab-content position-relative" id="v-pills-tabContent">
                        <div class="">
                            <h4 class="text-bold text-c-blue">Track your progress in one place</h4>
                            <div class="row percentage_div">

                                <div class="col-md-12 mb-2 mt-3">
                                    <span class="progress-head">Overall Questionnaire Progress</span>
                                </div>
                                <div class="col-md-10 mh-40">
                                    @php
                                        $progress_percentage = $progress['all_percentage'];
                                        $class = '';

                                        if ($progress_percentage == 100) {
                                            $class = 'bg-success';
                                        }
                                    @endphp
                                    <div class="overall-progress-box mt-1">
                                        <div class="progress">
                                            <div class="progress-bar {{ $class }}" role="progressbar"
                                                style="width: {{ $width }}%;"
                                                aria-valuenow="{{ $progress['all_percentage'] }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mh-40">
                                    <span class="text-bold">{{ $msg }} complete </span>
                                </div>

                                @php
                                    $uploadedDocsProgress = $docsProgress['progress'] ?? 0;
                                    $notUploadedDocs = $docsProgress['notUploadedDocs'] ?? [];
                                @endphp
                                <div class="col-md-12 mb-2 mt-3">
                                    <span class="progress-head">Uploaded Document Progress</span>
                                </div>
                                <div class="col-md-10 mh-40 ">
                                    @php
                                        $class = '';
                                        if ($uploadedDocsProgress == 100) {
                                            $class = 'bg-success';
                                        }
                                    @endphp
                                    <div class="overall-progress-box mt-1">
                                        <div class="progress">
                                            <div class="progress-bar {{ $class }}" role="progressbar"
                                                style="width: {{ $uploadedDocsProgress }}%;"
                                                aria-valuenow="{{ $uploadedDocsProgress }}" aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mh-40 ">
                                    <span class="text-bold">{{ $uploadedDocsProgress ?? '0' }}% complete </span>
                                </div>

                                <div class="col-md-12">
                                    @include('client.doc_upload_layout')

                                    <!-- previous used view client.common_client_upload_view -->
                                    @include('client.overall_progress.client_progress_upload_view', [
                                        'docsUploadInfo' => $docsUploadInfo,
                                        'client_id' => $client_id,
                                        'ignore_uploaded' => true,
                                    ])

                                    <!-- modal -->
                                    @include('client.uploaddoc_mode', [
                                        'max_size' => 200,
                                        'isManual' => false,
                                    ])
                                </div>

                                <div class="col-md-8"></div>
                                <div class="col-md-4 text-center pl-0 pr-0 final-sub-div ">
                                    @php
                                        if (
                                            Auth::user()->client_subscription !=
                                            \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION
                                        ) {
                                            $btntxt = 'Final Submit to Attorney for Preparation';
                                        }
                                        if (
                                            Auth::user()->client_subscription ==
                                            \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION
                                        ) {
                                            $btntxt = 'Submit to Attorney for Preparation';
                                        }
                                    @endphp

                                    @if ($progress['eligible_for_final_submit'] == 1)
                                        @if ($uploadedDocsProgress == 100 && $progress['all_percentage'] == 100)
                                            <a onclick="finalSubmitToAttorney()" href="javascript:void(0)"
                                                class="btn btn-primary mr-3 my-3">{{ $btntxt }}</a>
                                        @else
                                            <label class="text-center text-c-blue mb-0 px-3">
                                                Once all documents are uploaded and questionnaire is
                                                100% complete, this will turn blue to enable you to select
                                                and submit your case
                                            </label>
                                            <a href="javascript:void(0)"
                                                class="btn btn-primary bg-gray mr-3 my-3">{{ $btntxt }}</a>
                                        @endif
                                    @endif
                                </div>

                                <div class="col-md-12 text-center mt-4">
                                    <label class="w-100"> If we you need help finding documents or with the filling out the
                                        questionnaire: </label>
                                    <label class="w-100">
                                        <span> Text us: <a class="text-lightblue" href="tel:1-949-994-4190"> (949) 994-4190
                                            </a> </span>
                                        <span class="ml-5"> Email us: <a class="text-lightblue"
                                                href="mailto:info@bkquestionnaire.com"> info@bkquestionnaire.com </a>
                                        </span>
                                        <span class="ml-5"> Call Us: <a class="text-lightblue ml-2"
                                                href="tel:1-888-356-5777"> 1-888-356-5777 </a> </span>
                                    </label>
                                    <label class="w-100"> Or you can setup an appointment with us here: </label>
                                    <label class="w-100">
                                        @if (isset($concierge_service) && $concierge_service == 1)
                                            <a href="{{ Helper::CALENDY_CONCIERGE_APPOINTMENT_URL . '?month=' . date('Y-m') }}"
                                                class="bk-main-button btn button-blue" target="_blank"> BOOK A MEETING (45
                                                minutes) </a>
                                        @endif
                                        <a href="{{ Helper::CALENDY_CONCIERGE_PROCESS_OVERVIEW_CALL_URL . '?month=' . date('Y-m') }}"
                                            class="bk-main-button btn button-blue" target="_blank"> BOOK A MEETING (15
                                            minutes) </a>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

@push('tab_scripts')
    <script>
        window.__trackProgressData = {
            userJustLogin: {{ @$userJustLogin ? 'true' : 'false' }},
            webView: {{ @$web_view ? 'true' : 'false' }}
        };
    </script>
    <script src="{{ asset('assets/js/client/track_progress.js') }}"></script>
@endpush
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/track_progress.css') }}">
@endpush
@endsection
