<div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <a class="navbar-brand logo" href="{{ route('client_dashboard') }}">
            <img class="logo-light mx-auto h-100"
                src="{{ !empty($sidebarLogo) ? $sidebarLogo : asset('assets/img/new/sidebar/logo-light-bg.png') }}"
                alt="Logo light">
            <img class="logo-dark mx-auto h-100"
                src="{{ !empty($sidebarLogo) ? $sidebarLogo : asset('assets/img/new/sidebar/logo-dark-bg.png') }}"
                alt="Logo dark">
        </a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    @php
        $creditReportEnabled = App\Models\User::isCreditReportEnabledByClientId(Auth::user()->id);
       
    @endphp
    <div class="language-area">
        <div class=""></div>
        <div class="switch-mode">
            <button id="themeToggleBtn" class="color-mode-btn">

                <svg id="lightIcon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16"
                    height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                        d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286">
                    </path>
                    <path
                        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z">
                    </path>
                </svg>
                <svg id="darkIcon" xmlns="http://www.w3.org/2000/svg" width="16.069" height="16.069"
                    viewBox="0 0 16.069 16.069">
                    <path id="brightness"
                        d="M8.035,11.382a3.348,3.348,0,1,1,3.348-3.348A3.349,3.349,0,0,1,8.035,11.382Zm0-5.356a2.009,2.009,0,1,0,2.009,2.009A2.015,2.015,0,0,0,8.035,6.026ZM8.7,2.678V.67a.67.67,0,0,0-1.339,0V2.678a.67.67,0,0,0,1.339,0ZM8.7,15.4V13.391a.67.67,0,0,0-1.339,0V15.4a.67.67,0,0,0,1.339,0ZM3.348,8.035a.672.672,0,0,0-.67-.67H.67A.67.67,0,0,0,.67,8.7H2.678A.672.672,0,0,0,3.348,8.035Zm12.721,0a.672.672,0,0,0-.67-.67H13.391a.67.67,0,0,0,0,1.339H15.4A.672.672,0,0,0,16.069,8.035ZM4.493,4.493a.667.667,0,0,0,0-.944L3.154,2.21a.668.668,0,0,0-.944.944L3.549,4.493a.657.657,0,0,0,.475.194A.686.686,0,0,0,4.5,4.493Zm9.374,9.374a.667.667,0,0,0,0-.944l-1.339-1.339a.668.668,0,1,0-.944.944l1.339,1.339a.657.657,0,0,0,.475.194.686.686,0,0,0,.475-.194Zm-10.713,0,1.339-1.339a.668.668,0,1,0-.944-.944L2.21,12.922a.667.667,0,0,0,0,.944.657.657,0,0,0,.475.194.686.686,0,0,0,.475-.194Zm9.374-9.374,1.339-1.339a.668.668,0,1,0-.944-.944L11.583,3.549a.667.667,0,0,0,0,.944.657.657,0,0,0,.475.194.686.686,0,0,0,.475-.194Z"
                        fill="#818181"></path>
                </svg>

                <span id="themeText">Light</span>
            </button>

        </div>
    </div>

    <div class="offcanvas-body">
        <div id="slide-nav">
            <ul class="navbar-nav" id="sidebarAccordion">
                @php
                    $sidebarList = ArrayHelper::getClientSidebar();
                @endphp
                @foreach ($sidebarList as $item)
                    @php
                        $route = route($item['route']);
                        $active = request()->routeIs($item['route']) ? 'active' : '';

                        if ($item['route'] == 'client_dashboard') {
                            $active =
                                request()->routeIs('client_dashboard') ||
                                request()->routeIs('client_basic_info_step1') ||
                                request()->routeIs('client_basic_info_step2')
                                    ? 'active'
                                    : '';
                        }

                        if ($item['route'] == 'property_information') {
                            $active =
                                request()->routeIs('property_information') ||
                                request()->routeIs('client_property_step1') ||
                                request()->routeIs('client_property_step2') ||
                                request()->routeIs('client_property_step3') ||
                                request()->routeIs('client_property_step4_continue') ||
                                request()->routeIs('client_property_step4') ||
                                request()->routeIs('client_property_step4') ||
                                request()->routeIs('client_property_step5')
                                    ? 'active'
                                    : '';
                        }

                        if ($item['route'] == 'client_debts_step2_unsecured') {
                            $active =
                                request()->routeIs('client_debts_step2_unsecured') ||
                                request()->routeIs('client_debts_step2_back_tax') ||
                                request()->routeIs('client_debts_step2_domestic') ||
                                request()->routeIs('client_debts_step2_additional')
                                    ? 'active'
                                    : '';
                        }

                        if ($item['route'] == 'client_income') {
                            $active =
                                request()->routeIs('client_income') ||
                                request()->routeIs('client_income_step2') ||
                                request()->routeIs('client_income_step1') ||
                                request()->routeIs('client_income_step3')
                                    ? 'active'
                                    : '';
                        }

                        if ($item['route'] == 'client_expenses') {
                            $active =
                                request()->routeIs('client_expenses') || request()->routeIs('client_spouse_expenses')
                                    ? 'active'
                                    : '';
                        }

                        if ($item['route'] == 'client_financial_affairs') {
                            $active =
                                request()->routeIs('client_financial_affairs') ||
                                request()->routeIs('client_financial_affairs2') ||
                                request()->routeIs('client_financial_affairs3')
                                    ? 'active'
                                    : '';
                        }

                        $percentageKey = Helper::validate_key_value('percentage_key', $item);
                        $tabPercentage = !empty($percentageKey)
                            ? (float) Helper::validate_key_value($percentageKey, $progress, 'radio')
                            : 0.0;

                        if ($tabPercentage <= 25) {
                            $progressbarClass = 'red';
                        }
                        if ($tabPercentage >= 26 && $tabPercentage <= 99) {
                            $progressbarClass = 'yellow';
                        }
                        if ($tabPercentage >= 100) {
                            $progressbarClass = 'green';
                        }
                    @endphp
                    <li>
                        <a class="{{ $active }} nav-link sidebar-link d-flex align-item-center"
                            href="{{ $route }}" role="button" aria-expanded="false"
                            aria-controls="collapseExample">
                            <span class="me-2">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <span class="w-100 ">
                                {{ $item['name'] }}
                                <div class="d-flex align-items-center mt-1">
                                    <div class="w-85 progress sidebar-progress {{ $progressbarClass }}">
                                        <div class=" progress-bar   {{ $progressbarClass }}" role="progressbar"
                                            style="width: {{ $tabPercentage }}%;" aria-valuenow="{{ $tabPercentage }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <small class="w-15 ml-auto text-align-end">{{ $tabPercentage }}%</small>
                                </div>
                            </span>
                        </a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('list_uploaded_documents') }}" target="_blank"
                        class="nav-link sidebar-link align-item-center">
                        <span class="d-flex">
                            <span class="me-2">
                                <i class="bi bi-files"></i>
                            </span>
                            <span>Documents</span>
                        </span>
                        <p class="mb-0 ml-1 pl-2"><small class="pl-1 ml-1 d-block ">Click here to go to doc(s)
                                page</small></p>
                    </a>
                </li>
                @if (isset($video) && !empty($video) && !($tab == 'tab1' && $step6))
                    <li>
                        <a href="javascript:void(0)" class="nav-link sidebar-link d-flex align-item-center">
                            <div class="video-div m-0 w-100">
                                <button class="video-btn" data-bs-toggle="modal" data-bs-target="#video_modal"
                                    onclick="run_tutorial_videos(this,'#video_modal')" data-video="{{ $video['en'] }}"
                                    data-video2="{{ $video['sp'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29"
                                        viewBox="0 0 29 29">
                                        <g id="vds-btn" transform="translate(-299 -55)">
                                            <rect id="Rectangle_27" data-name="Rectangle 27" width="29"
                                                height="29" rx="14.5" transform="translate(299 55)"
                                                fill="#0b01aa"></rect>
                                            <path id="screen-play"
                                                d="M13.42,0H3.532A3.536,3.536,0,0,0,0,3.532V9.182a3.536,3.536,0,0,0,3.532,3.532H13.42a3.536,3.536,0,0,0,3.532-3.532V3.532A3.536,3.536,0,0,0,13.42,0ZM15.54,9.182A2.122,2.122,0,0,1,13.42,11.3H3.532A2.122,2.122,0,0,1,1.413,9.182V3.532A2.122,2.122,0,0,1,3.532,1.413H13.42A2.122,2.122,0,0,1,15.54,3.532ZM7.063,15.54a1.413,1.413,0,1,1-1.413-1.413A1.412,1.412,0,0,1,7.063,15.54ZM10.828,4.951,8,3.382a1.618,1.618,0,0,0-2.39,1.406V7.925A1.619,1.619,0,0,0,8,9.331l2.824-1.569a1.62,1.62,0,0,0,0-2.812Zm-.687,1.577L7.318,8.1a.2.2,0,0,1-.291-.171V4.788a.186.186,0,0,1,.1-.169.2.2,0,0,1,.1-.029.2.2,0,0,1,.1.026l2.823,1.569a.2.2,0,0,1,0,.343Zm6.811,9.011a.706.706,0,0,1-.706.706H9.182a.706.706,0,1,1,0-1.413h7.063A.706.706,0,0,1,16.952,15.539Zm-14.127,0a.706.706,0,0,1-.706.706H.706a.706.706,0,1,1,0-1.413H2.119A.706.706,0,0,1,2.825,15.539Z"
                                                transform="translate(305 61)" fill="#fff"></path>
                                        </g>
                                    </svg>
                                    <span class="fs-14px">Step-by-Step Guide</span>
                                </button>
                            </div>
                        </a>
                    </li>
                @endif
                @if (env('ENABLED_CLIENT_SIDE_CREDIT_REPORT', false) == true &&
                        ($creditReportEnabled['debtor'] || $creditReportEnabled['codebtor']))
                    @if (isset($crsReportNotCompleted) && in_array($crsReportNotCompleted, [2, 3]))
                        <li class="{{ \App\Models\PdfToJson::colorCode($crsReportNotCompleted) }} crs-report-tab-status blink ">
                            <a class="nav-link sidebar-link d-flex align-item-center "
                                href="{{ route('client_debts_step2_unsecured') }}">
                                <span class="me-2">
                                    <i class="bi bi-file-earmark-text"></i>
                                </span>
                                <span>Credit Report: {{ \App\Models\PdfToJson::getStatusName($crsReportNotCompleted) }}</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>

        @if (!empty($signeddocuments))
            <div class="">
                <a class="text-center attorney-docs-btn" onclick="showSignedDocPopup();" href="javascript:void(0);">
                    <span>Your Attorney Sent You Doc(s)</span>
                    <br />
                    <span class="mt-1">Click Here To View</span>
                </a>
            </div>
        @endif
    </div>

    <div class="light-gray-div border-bottom-language m-0 py-0 bx-0">
        <div class="label-div question-area d-flex align-items-center mb-0 language-area border-0 px-0 py-2">
            <label class="me-2 mb-0 mx-auto mt-0">
                Click to change language:
            </label>
            <div class="custom-radio-group form-group mx-auto mt-1">
                <input type="radio" id="language_en" name="language" class="d-none" value="en" checked>
                <label for="language_en" class="btn-toggle p-1 px-2 mx-2"
                    onclick="changeLanguageClient('en')">English</label>

                <input type="radio" id="language_es" name="language" class="d-none" value="es">
                <label for="language_es" class="btn-toggle p-1 px-2 mx-2"
                    onclick="changeLanguageClient('es')">Spanish</label>
            </div>
            <div id="google_translate_element"></div>
        </div>
    </div>

    <ul class="navbar-nav user-sec notification pt-0 pb-0 w-100">
        <li>
            <a href="javascript:void(0)" class="nav-link user d-flex align-items-center" style="cursor: default;">
                <span class="me-2"><i class="bi bi-person-circle" style="font-size: 32px;"></i></span>
                <span>{{ $authUser->name }}</span>
            </a>
        </li>
        <li>
            <div class="header-notifications hide-data" id="notificationList-header"></div>
            <a onclick="loadNotifications('{{ route('fetch_user_notifications') }}')" href="javascript:void(0);"
                title="Notifications">
                <span class="me-2">
                    <div class="number-circle count-notificaton-text">
                        {{ Helper::getUnreadNotificationCount() }}
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15.749" height="18" viewBox="0 0 15.749 18">
                        <path id="bell"
                            d="M8.875,18a2.25,2.25,0,0,0,2.25-2.25h-4.5A2.25,2.25,0,0,0,8.875,18m0-15.841-.9.181a4.5,4.5,0,0,0-3.6,4.411,24.412,24.412,0,0,1-.516,4.21,14.552,14.552,0,0,1-.746,2.54H14.637a14.621,14.621,0,0,1-.746-2.54,24.412,24.412,0,0,1-.516-4.21,4.5,4.5,0,0,0-3.6-4.41Zm7,11.342a2.862,2.862,0,0,0,.877,1.125H1A2.862,2.862,0,0,0,1.877,13.5,19.921,19.921,0,0,0,3.25,6.75,5.627,5.627,0,0,1,7.755,1.236a1.125,1.125,0,1,1,2.239,0A5.625,5.625,0,0,1,14.5,6.75a19.921,19.921,0,0,0,1.372,6.75"
                            transform="translate(-1 0.001)"></path>
                    </svg>
                </span>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav user-sec setting">

        <li class="">
            <a href="{{ route('client_logout') }}" class="nav-link">
                <span class="me-2">
                    <svg id="sign-out-alt" xmlns="http://www.w3.org/2000/svg" width="17" height="17.183"
                        viewBox="0 0 17 17.183">
                        <path id="Path_11" data-name="Path 11"
                            d="M9.737,10.739a.723.723,0,0,0-.731.716V13.6a2.17,2.17,0,0,1-2.192,2.148H3.654A2.17,2.17,0,0,1,1.461,13.6V3.58A2.17,2.17,0,0,1,3.654,1.432H6.814A2.17,2.17,0,0,1,9.006,3.58V5.728a.731.731,0,0,0,1.461,0V3.58A3.622,3.622,0,0,0,6.814,0H3.654A3.622,3.622,0,0,0,0,3.58V13.6a3.622,3.622,0,0,0,3.654,3.58H6.814a3.622,3.622,0,0,0,3.654-3.58V11.455A.723.723,0,0,0,9.737,10.739Z">
                        </path>
                        <path id="Path_12" data-name="Path 12"
                            d="M18.056,8.442,14.7,5.207a.749.749,0,0,0-1.033,0,.688.688,0,0,0,0,1l3.114,3.007L5.731,9.233a.706.706,0,1,0,0,1.411h0l11.1-.022-3.159,3.05a.688.688,0,0,0,0,1,.749.749,0,0,0,1.033,0l3.351-3.235a2.065,2.065,0,0,0,0-2.992Z"
                            transform="translate(-1.697 -1.346)"></path>
                    </svg>
                </span>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</div>

@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/sidebar.css') }}">
@endpush
@push('tab_scripts')
    <script src="{{ asset('assets/js/client/sidebar.js') }}"></script>
@endpush
