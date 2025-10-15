<div class="offcanvas offcanvas-start sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <a class="navbar-brand logo" href="{{route('attorney_dashboard')}}">
            <img class="logo-light mx-auto h-100" src="{{ asset('assets/img/new/sidebar/logo-light-bg.png') }}" alt="Logo light">
            <img class="logo-dark mx-auto h-100" src="{{ asset('assets/img/new/sidebar/logo-dark-bg.png') }}" alt="Logo dark">
        </a>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="language-area">
        <div class="language-div">
            <svg class="size-5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m7.5-6.923c-.67.204-1.335.82-1.887 1.855A8 8 0 0 0 5.145 4H7.5zM4.09 4a9.3 9.3 0 0 1 .64-1.539 7 7 0 0 1 .597-.933A7.03 7.03 0 0 0 2.255 4zm-.582 3.5c.03-.877.138-1.718.312-2.5H1.674a7 7 0 0 0-.656 2.5zM4.847 5a12.5 12.5 0 0 0-.338 2.5H7.5V5zM8.5 5v2.5h2.99a12.5 12.5 0 0 0-.337-2.5zM4.51 8.5a12.5 12.5 0 0 0 .337 2.5H7.5V8.5zm3.99 0V11h2.653c.187-.765.306-1.608.338-2.5zM5.145 12q.208.58.468 1.068c.552 1.035 1.218 1.65 1.887 1.855V12zm.182 2.472a7 7 0 0 1-.597-.933A9.3 9.3 0 0 1 4.09 12H2.255a7 7 0 0 0 3.072 2.472M3.82 11a13.7 13.7 0 0 1-.312-2.5h-2.49c.062.89.291 1.733.656 2.5zm6.853 3.472A7 7 0 0 0 13.745 12H11.91a9.3 9.3 0 0 1-.64 1.539 7 7 0 0 1-.597.933M8.5 12v2.923c.67-.204 1.335-.82 1.887-1.855q.26-.487.468-1.068zm3.68-1h2.146c.365-.767.594-1.61.656-2.5h-2.49a13.7 13.7 0 0 1-.312 2.5m2.802-3.5a7 7 0 0 0-.656-2.5H12.18c.174.782.282 1.623.312 2.5zM11.27 2.461c.247.464.462.98.64 1.539h1.835a7 7 0 0 0-3.072-2.472c.218.284.418.598.597.933M10.855 4a8 8 0 0 0-.468-1.068C9.835 1.897 9.17 1.282 8.5 1.077V4z">
                </path>
            </svg>
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    English
                </button>
                <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('en')">English</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0)" onclick="changeLanguage('es')">Spanish</a></li>
                </ul>
            </div>
        </div>
        
        <div id="google_translate_element"></div>

        <div class="switch-mode">
            <button id="themeToggleBtn" class="color-mode-btn">
                    
                <svg id="lightIcon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278M4.858 1.311A7.27 7.27 0 0 0 1.025 7.71c0 4.02 3.279 7.276 7.319 7.276a7.32 7.32 0 0 0 5.205-2.162q-.506.063-1.029.063c-4.61 0-8.343-3.714-8.343-8.29 0-1.167.242-2.278.681-3.286"></path>
                    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.73 1.73 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.73 1.73 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.73 1.73 0 0 0 1.097-1.097zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.16 1.16 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.16 1.16 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732z"></path>
                </svg>
                <svg id="darkIcon" xmlns="http://www.w3.org/2000/svg" width="16.069" height="16.069" viewBox="0 0 16.069 16.069">
                    <path id="brightness" d="M8.035,11.382a3.348,3.348,0,1,1,3.348-3.348A3.349,3.349,0,0,1,8.035,11.382Zm0-5.356a2.009,2.009,0,1,0,2.009,2.009A2.015,2.015,0,0,0,8.035,6.026ZM8.7,2.678V.67a.67.67,0,0,0-1.339,0V2.678a.67.67,0,0,0,1.339,0ZM8.7,15.4V13.391a.67.67,0,0,0-1.339,0V15.4a.67.67,0,0,0,1.339,0ZM3.348,8.035a.672.672,0,0,0-.67-.67H.67A.67.67,0,0,0,.67,8.7H2.678A.672.672,0,0,0,3.348,8.035Zm12.721,0a.672.672,0,0,0-.67-.67H13.391a.67.67,0,0,0,0,1.339H15.4A.672.672,0,0,0,16.069,8.035ZM4.493,4.493a.667.667,0,0,0,0-.944L3.154,2.21a.668.668,0,0,0-.944.944L3.549,4.493a.657.657,0,0,0,.475.194A.686.686,0,0,0,4.5,4.493Zm9.374,9.374a.667.667,0,0,0,0-.944l-1.339-1.339a.668.668,0,1,0-.944.944l1.339,1.339a.657.657,0,0,0,.475.194.686.686,0,0,0,.475-.194Zm-10.713,0,1.339-1.339a.668.668,0,1,0-.944-.944L2.21,12.922a.667.667,0,0,0,0,.944.657.657,0,0,0,.475.194.686.686,0,0,0,.475-.194Zm9.374-9.374,1.339-1.339a.668.668,0,1,0-.944-.944L11.583,3.549a.667.667,0,0,0,0,.944.657.657,0,0,0,.475.194.686.686,0,0,0,.475-.194Z" fill="#818181"></path>
                </svg>

                <span id="themeText">Light</span>
            </button>

        </div>
    </div>


 


    <div class="offcanvas-body">
        <div id="slide-nav">
            <ul class="navbar-nav">
                
                @php
                    $authUser = Auth::user();
                    $sidebarList = \App\Helpers\ArrayHelper::getAttorneySidebar(($authUser->parent_attorney_id > 0 && $authUser->parent_attorney_id == 54695));
                    $enabledMenuItems = ($authUser->parent_attorney_id > 0) ? \App\Models\ParalegalSettings::getEnabledMenuItems($authUser->id) : [];
                    $isLawFirmManagementEnabled = \App\Models\AttorneySettings::isLawFirmManagementEnabled($authUser->id);
                @endphp

                @foreach($sidebarList as $item)
                    @php
                        // Skip law firm management if not enabled
                        if ($item['route'] == 'law_firm_associate_management' && !$isLawFirmManagementEnabled) {
                            continue;
                        }

                        $route = route($item['route']);
                        $active = request()->routeIs($item['route']) ? 'active' : '';

                        // Special handling for client management
                        if ($item['route'] == 'attorney_client_management') {
                            $route = !empty($authUser->parent_attorney_id) 
                                ? route('attorney_client_management', 'assigned_to_me') 
                                : route('attorney_client_management', 'active');
                            $active = (request()->routeIs('attorney_client_management') || request()->routeIs('attorney_client_uploaded_documents')) ? 'active' : '';
                        }

                        // Special handling for law firm management
                        if ($item['route'] == 'law_firm_associate_management') {
                            $active = (request()->routeIs('law_firm_associate_management') || request()->routeIs('attorney_lawfirm_settings')) ? 'active' : '';
                        }

                        // Skip menu items not enabled for paralegals
                        if ($authUser->parent_attorney_id > 0 && !in_array($item['route'], ['attorney_dashboard', 'attorney_client_management'])) {
                            if (empty($enabledMenuItems[$item['route']]) || $enabledMenuItems[$item['route']] === "0") {
                                continue;
                            }
                        }
                    @endphp
                    
                    <li>
                        <a class="{{ $active }} nav-link sidebar-link d-flex align-item-center" href="{{ $route }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                            <span class="me-2">
                                <i class="{{ $item['icon'] }}"></i>
                            </span>
                            <span>
                                {{ $item['name'] }}
                                @if (!empty($item['subtext']))
                                    <br><small>{{ $item['subtext'] }}</small>
                                @endif
                            </span>
                        </a>
                    </li>
                @endforeach
                @if(request()->routeIs('attorney_dashboard'))
                    <li>
                        <a class="nav-link sidebar-link d-flex align-item-center bg-white" href="javascript:void(0)" data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')" title="Click for Step by Step video" data-video="{{ $video['en'] }}" data-video2="{{ $video['sp'] }}">
                            <img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" class="mx-auto" style="height: 35px;" alt="Video logo">
                        </a>
                        <a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto" href="javascript:void(0)" onclick="seeAiProcessedReportStatus()">
                            <img alt="AI" src="{{ asset('assets/img/ai_icon_dark.png') }}" class="ai-icon" style="height:20px"> See AI Processed Docs Status
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
        
    <ul class="navbar-nav user-sec notification">
        <li>
            <a href="{{ route('attorney_profile') }}" class="nav-link user">
                @php
                    $userLogo = \App\Models\AttorneyCompany::getLoggedInAttorneyLogo($authUser->id);
                @endphp
                <span class="account-user-avatar me-2">
                    <img src="{{ asset($userLogo) }}" alt="User">
                </span>
                <span>{{ $authUser->name }}</span>
            </a>
        </li>
        <!-- <li>
            <a href="javascript:void(0)"><span class="me-2">
                <div class="number-circle">3</div><svg xmlns="http://www.w3.org/2000/svg" width="15.749" height="18" viewBox="0 0 15.749 18">
                    <path id="bell" d="M8.875,18a2.25,2.25,0,0,0,2.25-2.25h-4.5A2.25,2.25,0,0,0,8.875,18m0-15.841-.9.181a4.5,4.5,0,0,0-3.6,4.411,24.412,24.412,0,0,1-.516,4.21,14.552,14.552,0,0,1-.746,2.54H14.637a14.621,14.621,0,0,1-.746-2.54,24.412,24.412,0,0,1-.516-4.21,4.5,4.5,0,0,0-3.6-4.41Zm7,11.342a2.862,2.862,0,0,0,.877,1.125H1A2.862,2.862,0,0,0,1.877,13.5,19.921,19.921,0,0,0,3.25,6.75,5.627,5.627,0,0,1,7.755,1.236a1.125,1.125,0,1,1,2.239,0A5.625,5.625,0,0,1,14.5,6.75a19.921,19.921,0,0,0,1.372,6.75" transform="translate(-1 0.001)"></path>
                </svg>
            </span></a>
        </li> -->
    </ul>
    <ul class="navbar-nav user-sec setting">
    
        <li>
            <a href="{{ route('attorney_logout') }}" class="nav-link">
                <span class="me-2">
                    <svg id="sign-out-alt" xmlns="http://www.w3.org/2000/svg" width="17" height="17.183" viewBox="0 0 17 17.183">
                        <path id="Path_11" data-name="Path 11" d="M9.737,10.739a.723.723,0,0,0-.731.716V13.6a2.17,2.17,0,0,1-2.192,2.148H3.654A2.17,2.17,0,0,1,1.461,13.6V3.58A2.17,2.17,0,0,1,3.654,1.432H6.814A2.17,2.17,0,0,1,9.006,3.58V5.728a.731.731,0,0,0,1.461,0V3.58A3.622,3.622,0,0,0,6.814,0H3.654A3.622,3.622,0,0,0,0,3.58V13.6a3.622,3.622,0,0,0,3.654,3.58H6.814a3.622,3.622,0,0,0,3.654-3.58V11.455A.723.723,0,0,0,9.737,10.739Z"></path>
                        <path id="Path_12" data-name="Path 12" d="M18.056,8.442,14.7,5.207a.749.749,0,0,0-1.033,0,.688.688,0,0,0,0,1l3.114,3.007L5.731,9.233a.706.706,0,1,0,0,1.411h0l11.1-.022-3.159,3.05a.688.688,0,0,0,0,1,.749.749,0,0,0,1.033,0l3.351-3.235a2.065,2.065,0,0,0,0-2.992Z" transform="translate(-1.697 -1.346)"></path>
                    </svg>
                </span>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</div>