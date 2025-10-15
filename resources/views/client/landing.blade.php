@extends('layouts.app')
@section('content')
    @include('layouts.flash')

    @php
        use App\Helpers\VideoHelper;
    @endphp
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>
    <div class="sign_up_bgs">
        <div class="container">
            <div class="row py-0 page-flex">
                <div class="col-md-12 mt-3">
                    <div class="form_colm row py-4 pl-0">
                        <div class="col-md-9">
                            <div class="title-h mt-1 d-flex">
                                <h4><strong>Welcome, {{ auth()->user()->name }} to your Online Bankruptcy Questionnaire
                                    </strong></h4>
                            </div>
                        </div>
                        <div class="col-md-3 align-right">
                            <a class="btn font-weight-bold border-blue f-12 enter-dashboard"
                                href="{{ route('client_dashboard') }}">Go to Questionnaire</a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="video_container hide_on_mobile text-center mb-3">
                        @php
                            $language = Config::get('app.locale');
                            $videos = VideoHelper::getAdminVideos();
                            $tutorial = $videos[Helper::GUIDE_PAGE_TUTORIAL_VIDEO] ?? [];
                            $video = VideoHelper::getVideos($tutorial);
                        @endphp

                        @if (empty($attorneyGuide))
                            <iframe class="rumble {{ empty($attorneyGuide) ? '' : 'hide-data' }}" width="930"
                                height="523"
                                src="{{ ($language == 'en' ? $video['en'] : $video['sp']) . '&autoplay=2&mute=1' }}"
                                allow="autoplay; encrypted-media"></iframe>
                        @endif

                        @if (!empty($attorneyGuide))
                            <iframe class="rumble {{ empty($attorneyGuide) ? 'hide-data' : '' }}" width="930"
                                height="523" src="{{ $attorneyGuide . '?rel=0&autoplay=1&mute=1' }}"
                                allow="autoplay; encrypted-media"></iframe>
                        @endif
                    </div>

                    <div class="px-3 hide_on_desktop mobile_img">
                        <video class="elementor-video masked w-100" autoplay loop muted playsinline>
                            <source
                                src="{{ !empty($attorney_welcome_mobile_video_url) ? $attorney_welcome_mobile_video_url : asset('assets/img/Produce.mp4') }}"
                                type="video/mp4">
                        </video>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card-deck landing-card-parent">

                        <div class="card text-center mb_3">
                            <div class="step step_top">
                                <label class="p-step">Step</label>
                                <span>1</span>
                            </div>
                            <div class="card-body pt-3 mb-0 pb-0">
                                <h5 class="card-title mb-0"> Questionnaire Tab </h5>

                            </div>
                            <div class="card-footer">
                                <a class="doc_btn" href="{{ route('client_dashboard') }}">Go to my questionnaire</a>
                            </div>
                        </div>
                        <div class="card text-center mb_3">
                            <div class="step step_top">
                                <label class="p-step">Step</label>
                                <span>2</span>
                            </div>
                            <div class="card-body pt-3">
                                <h5 class="card-title mb-0 "> Documents Tab</h5>
                            </div>
                        </div>
                        <div class="card text-center mb_3">
                            <div class="step step_top">
                                <label class="p-step">Step</label>
                                <span>3</span>
                            </div>
                            <div class="card-body pt-3">
                                <h5 class="card-title mb-0"> Help, Questions or for an appointment<br></h5>
                                <div class="card_content">
                                    <h6 class="text-left">
                                        If you need any technical support or help:<br>
                                        Call: 1-888-356-5777 Text us: (949) 994-4190 Email: info@bkassistant net<br>
                                    </h6>
                                    <span class="text-c-blue font-weight-bold text-center">(Its FREE)</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- client.commonlanding is only js and csss --}}
@include('client.commonlanding')

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/landing.css') }}">
@endpush
@push('tab_scripts')
    <script src="{{ asset('assets/js/client/change_password.js') }}"></script>
@endpush