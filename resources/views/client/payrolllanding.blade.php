@extends('layouts.app')
@section('content')
    @include('layouts.flash')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=3.10">
    <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css') }}">
    <script src="{{ asset('assets/js/facebox.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>
    <div class="sign_up_bgs">
        <div class="container-fluid">
            <div class="row py-0 page-flex">
                <div class="col-md-12">
                    <div class="form_colm row px-md-5 py-4">
                        <div class="col-md-9 mb-3">
                            <div class="title-h mt-1 d-flex">
                                <h4><strong>Welcome, {{ auth()->user()->name }} to your Online Bankruptcy
                                        Questionnaire </strong></h4>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 align-right">
                            <a class="btn font-weight-bold border-blue f-12 enter-dashboard"
                                href="{{ route('client_dashboard') }}">Go To Dashboard</a>
                        </div>
                        @php
                            $landingvideo = VideoHelper::getAdminVideos();
                            $landingtutorial = $landingvideo[Helper::PAYROLL_GUIDE_PAGE_TUTORIAL_VIDEO] ?? [];
                            $pvideo = VideoHelper::getVideos($landingtutorial);
                        @endphp
                        <div class="col-md-12 main-div">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="" id="video_modal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="absolute-swich-btn">
                                                    <div class="text-center btn-cstm-toggle">
                                                        <span class="text-gray">English</span>
                                                        <label class="switch">
                                                            <input type="checkbox" name="graduate">
                                                            <span class="slider round"></span>
                                                        </label>
                                                        <span class="text-primary">Spanish</span>
                                                    </div>
                                                    <div class="col-md-12 ug mt-5 english pr-0 pl-0">
                                                        <div class="card popup-video bg-light">
                                                            <div class="card-body text-center">
                                                                <iframe class="embed-responsive-item"
                                                                    src="{{ $pvideo['en'] }}" id="video"
                                                                    allowscriptaccess="always" allow="autoplay"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 mt-5 phd spanish pr-0 pl-0" style="display: none">
                                                        <div class="card bg-primaryp popup-video spanish-desktop-video">
                                                            <div class="card-body text-center">
                                                                <iframe id="player1" src="{{ $pvideo['sp'] }}"
                                                                    title="YouTube video player" frameborder="0"
                                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                                    allowfullscreen=""></iframe>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>



                                    <!--  -->
                                    <div class="align-left mt-3">
                                        <p class="mt-3">Please watch the welcome video then download our app.</p>
                                        <ul>
                                            <li>It is best if you first, gather the documents requested on the right of
                                                screen. Scan them and upload them into the system, in one of the aps,
                                                before you begin the questionnaire. The reason for this is, <u><strong>the
                                                        software</strong></u> will <u><strong>read your
                                                        documents</strong></u>
                                                and <u><strong>auto-populate</strong></u> the relevant information into the
                                                questionnaire for you. This will save your time!!
                                            </li>
                                            <li>If you have any questions and/or concerns, just ask the law firm in the chat
                                                portion of
                                                the APP or website once downloaded and/or signed in.
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-12 align-center" style="margin-top:40px;">
                                        <a target="_blank" href="{{ Helper::IOS_APP_URL }}"><img
                                                src="{{ asset('assets/img/app-store.png') }}" alt="App Store" /></a>
                                        <a target="_blank" href="{{ Helper::ANDROID_APP_URL }}"><img
                                                src="{{ asset('assets/img/play-store.png') }}" alt="Play Store" /></a>
                                    </div>
                                </div>



                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @include('client.commonlanding')
@endsection
