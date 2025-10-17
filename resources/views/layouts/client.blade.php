<!DOCTYPE html>
<html lang="en">

<head>
    @php $web_view = Session::get('web_view'); @endphp
    <title>Bankruptcy</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if (@$web_view)
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    @else
        <meta name="viewport" content="width=device-width, initial-scale=1" />
    @endif
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/bootstrap.min.css') }}?v=19.90">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/select2.min.css') }}?v=19.90">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/style.css') }}?v=22.09">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/dashboard.css') }}?v=19.98">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/font-awesome.min.css') }}">
    <!-- Favicon icon -->
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/new/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/facebox.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}?v=14.31"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.tablednd.js') }}"></script>
    <!-- Google Translate script - loaded after dashboard.js to ensure googleTranslateElementInit function is defined -->
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="{{ asset('assets/js/new/dashboard.js') }}?v=17.97"></script>
    <!-- fontawesome icon -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <!-- animation css -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css') }}">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/dynamic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=20.97">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v=2.91">
    <link rel="stylesheet" href="{{ asset('assets/css/client/client_layout.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Outfit' rel='stylesheet'>
    @stack('tab_styles')
    @yield('dashboard_styles')
    <script>
        const CHECK_PERMISSION_URL = "{{ route('check_permission') }}";
    </script>
    @include('analytics')
    
</head>

<body class="zoom-unset">
    @php
        $authUser = Auth::user();
        $client_id = $authUser->id;

        $client_subscription = $authUser->client_subscription;
        $signeddocuments = \App\Models\SignedDocuments::where('client_id', $client_id)->orderBy('id', 'desc')->select('is_sent')->first();
        $signeddocuments = !empty($signeddocuments->is_sent) ? true : false;
        $all_percentage = isset($progress) ? Helper::validate_key_value('all_percentage', $progress) : 0;
        $submitted_to_att_at = isset($progress) ? Helper::validate_key_value('submitted_to_att_at', $progress) : '';

        $refreenceParent = Session::get('refrence_parent');
        $refreenceAdmin = Session::get('refrence_admin');

        $tabLabel = '';
        $tabLogo = '';

        if (
            request()->routeIs('client_dashboard') ||
            request()->routeIs('client_basic_info_step1') ||
            request()->routeIs('client_basic_info_step2')
        ) {
            $tabLabel = 'Basic Information';
            $tabLogo = 'bi bi-person-circle';
        } elseif (
            request()->routeIs('property_information') ||
            request()->routeIs('client_property_step1') ||
            request()->routeIs('client_property_step2') ||
            request()->routeIs('client_property_step3') ||
            request()->routeIs('client_property_step4_continue') ||
            request()->routeIs('client_property_step4')
        ) {
            $tabLabel = 'Property';
            $tabLogo = 'bi bi-house-exclamation';
        } elseif (
            request()->routeIs('client_debts_step2_unsecured') ||
            request()->routeIs('client_debts_step2_back_tax') ||
            request()->routeIs('client_debts_step2_domestic') ||
            request()->routeIs('client_debts_step2_additional')
        ) {
            $tabLabel = 'Debts';
            $tabLogo = 'bi bi-coin';
        } elseif (
            request()->routeIs('client_income') ||
            request()->routeIs('client_income_step2') ||
            request()->routeIs('client_income_step1') ||
            request()->routeIs('client_income_step3')
        ) {
            $tabLabel = 'Current Income';
            $tabLogo = 'bi bi-wallet';
        } elseif (request()->routeIs('client_expenses') || request()->routeIs('client_spouse_expenses')) {
            $tabLabel = 'Current Household Expense';
            $tabLogo = 'bi bi-wallet2';
        } elseif (
            request()->routeIs('client_financial_affairs') ||
            request()->routeIs('client_financial_affairs2') ||
            request()->routeIs('client_financial_affairs3')
        ) {
            $tabLabel = 'Statement of Financial Affairs';
            $tabLogo = 'bi bi-file-earmark-medical';
        }

        // For Sidebar And Percentage
        $client_attorney = \App\Models\ClientsAttorney::where('client_id', $client_id)->select('attorney_id')->first();
        $client_attorney = !empty($client_attorney) ? $client_attorney : [];
        $attorney_company = [];
        if (!empty($client_attorney->attorney_id)) {
            $attorney_id = $client_attorney->attorney_id;
            $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
            $attorney_company = !empty($attorney_company) ? $attorney_company : [];
        }

        $sidebarLogo = '';
        if (
            !empty($attorney_company->company_logo) &&
            file_exists(public_path() . '/' . $attorney_company->company_logo)
        ) {
            $sidebarLogo = url($attorney_company->company_logo);
        }
        $progress_percentage = @$progress['all_percentage'];
        $progress_percentage = ($progress_percentage + (int) ($docsProgress['progress'] ?? 0)) / 2;
    @endphp
    @if (@$web_view)
        <style>
            .tab-content>.active {
                padding-top: 0px !important;
            }

            .section-main-title {
                font-size: 20px;
            }
        </style>
    @endif
    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>


    <div class="wrapper my-0" id="togglemenu">
        @if (!@$web_view && !in_array(Route::currentRouteName(), ['list_uploaded_documents']))
            @include('layouts.client.new.sidebar')
        @endif

        <div class="@if (!@$web_view && !in_array(Route::currentRouteName(), ['list_uploaded_documents'])) content-page @endif pb-0">
            <div class="top-header-moblie ">
                <div class="container">
                    <div class="top-header-bar">
                        <div class="show-menu-button {{ Route::currentRouteName() == 'list_uploaded_documents' ? 'hide-data' : '' }}"
                            type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                            aria-controls="offcanvasExample">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5">
                                </path>
                            </svg>
                        </div>
                        <div class="top-logo">
                            <img class="logo-light" src="{{ asset('assets/img/new/sidebar/logo-light-bg.png') }}"
                                alt="logo">
                        </div>
                    </div>
                </div>
            </div>
            @php
                $labelDivMainCols =
                    (@$refreenceParent > 0 && @\App\Models\User::where('id', $refreenceParent)->value('role') != 1) ||
                    (@$refreenceAdmin > 0 && @\App\Models\User::where('id', $refreenceAdmin)->value('role') == 1)
                        ? 'col-12 col-md-3 col-lg-3 col-xl-3 col-xxl-3'
                        : 'col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-7';
                $docDivMainCols =
                    (@$refreenceParent > 0 && @\App\Models\User::where('id', $refreenceParent)->value('role') != 1) ||
                    (@$refreenceAdmin > 0 && @\App\Models\User::where('id', $refreenceAdmin)->value('role') == 1)
                        ? 'col-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5'
                        : 'col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-5';
            @endphp
            <div class="container">
                <div class="page-title-box py-2">
                    <div class="row py-1">
                        <div
                            class="col-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 align-items-center {{ @$web_view ? '' : 'mb-3' }}  mb-md-0">
                            <div class="{{ @$web_view ? 'mt-5' : '' }} page-title-div w-100 client-doc-page">
                                <p class="text-success text-bold mb-2 text-center text-md-start fs-md-12px">This is not
                                    your attorney's filing system. Your attorney will carefully review all the info you
                                    provide in BK Questionnaire before filing anything on your behalf.</p>
                            </div>
                        </div>
                        @if (!in_array(Route::currentRouteName(), ['pre_client_dashboard']))
                            <div
                                class="{{ $labelDivMainCols }} d-flex align-items-center {{ @$web_view ? '' : 'mb-3' }} mb-md-0">
                                <div class="page-title-div w-100">
                                    <h1>
                                        <i class="{{ $tabLogo }}"></i>
                                        {{ $tabLabel }}
                                    </h1>
                                </div>
                            </div>
                        @endif


                        @if (!@$web_view && !in_array(Route::currentRouteName(), ['list_uploaded_documents']))
                            <div class="{{ $docDivMainCols }} d-flex align-items-left ">
                                <div class="step-area w-100">
                                    <div class="document-div m-auto">
                                        <a class="d-flex align-items-center"
                                            @if ($all_percentage < 100 && empty($submitted_to_att_at)) href="javascript:void(0)"
                onclick="openFlagPopup('questionnaire-completion-popup', '', false);"
                @else
                href="{{ route('list_uploaded_documents') }}" target="_blank" @endif>
                                            @if (
                                                $client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION &&
                                                    $authUser->hide_questionnaire == 0)
                                                @php
                                                    $notUploadedDocsCount = 0;
                                                    $requestedDocuments = @$docsUploadInfo['requestedDocuments'];
                                                    if (
                                                        isset($docsProgress) &&
                                                        !empty(
                                                            Helper::validate_key_value('notUploadedDocs', $docsProgress)
                                                        )
                                                    ) {
                                                        $notUploadedDocsCount = count(
                                                            Helper::validate_key_value(
                                                                'notUploadedDocs',
                                                                $docsProgress,
                                                            ),
                                                        );
                                                    }
                                                @endphp
                                                <div class="document-img-div">
                                                    <figure><img
                                                            src="{{ asset('assets/img/upload_doc_image_new.png') }}?v=1.0"
                                                            alt="Mask Group"></figure>
                                                </div>
                                                <div class="document-upload-div">
                                                    <div class="document-upload-abs text-c-blue"
                                                        style="margin-bottom: 15px">Click Here To Go To Documents Page
                                                    </div>
                                                    @if ($notUploadedDocsCount == 0)
                                                        <div class="document-yellow-div">
                                                            You Have Uploaded All Required Documents
                                                        </div>
                                                    @endif
                                                    @if ($notUploadedDocsCount > 0)
                                                        <div class="document-upload mb-2">Documents Required By
                                                            Bankruptcy Court</div>
                                                        <div class="document-yellow-div mb-2">
                                                            {{ $notUploadedDocsCount }} Documents Left
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if (
                            (@$refreenceParent > 0 || @$refreenceAdmin > 0) &&
                                !@$web_view &&
                                !in_array(Route::currentRouteName(), ['list_uploaded_documents']))
                            <div
                                class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 d-flex align-items-center mb-3 mb-md-0">
                                <div class="page-title-div w-100">

                                    @if (@$refreenceParent > 0 && @\App\Models\User::where('id', $refreenceParent)->value('role') != 1)
                                        <p class="login_info_para text-center text-md-start my-2">
                                            You're logged in to your client questionnaire.
                                            <a class="btn-new-ui-default btn-login-to-att d-inline-block"
                                                href="{{ route('attorney_login_dashboard', ['id' => $refreenceParent]) . '?q=' . $authUser->id }}">CLICK
                                                HERE</a>
                                            to go back in your attorney side.
                                        </p>
                                    @endif

                                    @if (@\App\Models\User::where('id', $refreenceAdmin)->value('role') == 1)
                                        <p class="login_info_para text-center text-md-start my-2">
                                            You're logged in to your client questionnaire.
                                            <a class="btn-new-ui-default btn-login-to-att d-inline-block"
                                                href="{{ route('admin_login_dashboard', ['id' => $refreenceAdmin]) . '?q=' . $authUser->id }}">CLICK
                                                HERE</a>
                                            to go back in your admin side.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card information-area container-client-section">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @if (!@$web_view && !in_array(Route::currentRouteName(), ['list_uploaded_documents']))
        <div class="action-bar p-2">

            <div class="action-bar-button-div px-3" data-bs-toggle="collapse" data-bs-target="#actionBarContent"
                aria-expanded="false" aria-controls="actionBarContent" style="cursor: pointer;">
                <span class="blink mb-0 text-c-red text-bold">
                    Click here to See Case Progress Summary
                    <i class="bi bi-chevron-up float-end ms-2"></i>
                </span>
            </div>

            <div class="action-bar-div float_right collapse py-2" id="actionBarContent">
                <span class="text-c-green">Click the progress bar at anytime to see what is still needed to complete
                    the questionnaire</span>
                <a href="{{ route('client_progress') }}" class="case-progress-card mb-0">
                    <div class="d-flex align-items-center ">
                        <p class="case-progress-title mb-1 w-100">Case&nbsp;Progress&nbsp;&nbsp;
                            <span class="case-progress-percentage ml-auto">{{ $progress_percentage }}%</span>
                        </p>
                    </div>
                    <div class="progress-bar-container">
                        <div class="progress-bar" style="width: {{ $progress_percentage }}% !important;"></div>
                    </div>
                </a>

                @if (!@$web_view)
                    @php
                        $uploadedDocsProgress = $docsProgress['progress'] ?? 0;
                        if ($client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
                            $btntxt = 'Final Submit to Attorney for Preparation';
                        }
                        if ($client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
                            $btntxt = 'Submit to Attorney for Preparation';
                        }
                    @endphp
                    @if (@$progress['eligible_for_final_submit'] == 1 && (empty(@$refreenceParent) && empty(@$refreenceAdmin)))
                        @if ($uploadedDocsProgress == 100 && $progress['all_percentage'] == 100)
                            <span class="text-c-blue">Complete the questionnaire & upload all requested documents to
                                submit:</span>
                            <button type="button" class="btn btn-primary"
                                onclick="finalSubmitToAttorney()">{{ $btntxt }}</button>
                        @else
                            <span class="text-c-blue">Complete the questionnaire & upload all requested documents to
                                submit:</span>
                            <button type="button" class="btn btn-primary disabled">{{ $btntxt }}</button>
                        @endif
                    @endif
                @endif
            </div>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="video_modal" tabindex="-1" aria-labelledby="videomodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex" id="videomodalLabel">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="29" height="29"
                            viewBox="0 0 29 29">
                            <g id="vds-btn" transform="translate(-299 -55)">
                                <rect id="Rectangle_27" data-name="Rectangle 27" width="29" height="29"
                                    rx="14.5" transform="translate(299 55)" fill="#0b01aa"></rect>
                                <path id="screen-play"
                                    d="M13.42,0H3.532A3.536,3.536,0,0,0,0,3.532V9.182a3.536,3.536,0,0,0,3.532,3.532H13.42a3.536,3.536,0,0,0,3.532-3.532V3.532A3.536,3.536,0,0,0,13.42,0ZM15.54,9.182A2.122,2.122,0,0,1,13.42,11.3H3.532A2.122,2.122,0,0,1,1.413,9.182V3.532A2.122,2.122,0,0,1,3.532,1.413H13.42A2.122,2.122,0,0,1,15.54,3.532ZM7.063,15.54a1.413,1.413,0,1,1-1.413-1.413A1.412,1.412,0,0,1,7.063,15.54ZM10.828,4.951,8,3.382a1.618,1.618,0,0,0-2.39,1.406V7.925A1.619,1.619,0,0,0,8,9.331l2.824-1.569a1.62,1.62,0,0,0,0-2.812Zm-.687,1.577L7.318,8.1a.2.2,0,0,1-.291-.171V4.788a.186.186,0,0,1,.1-.169.2.2,0,0,1,.1-.029.2.2,0,0,1,.1.026l2.823,1.569a.2.2,0,0,1,0,.343Zm6.811,9.011a.706.706,0,0,1-.706.706H9.182a.706.706,0,1,1,0-1.413h7.063A.706.706,0,0,1,16.952,15.539Zm-14.127,0a.706.706,0,0,1-.706.706H.706a.706.706,0,1,1,0-1.413H2.119A.706.706,0,0,1,2.825,15.539Z"
                                    transform="translate(305 61)" fill="#fff"></path>
                            </g>
                        </svg>
                        Guide video
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Video  -->
                    <div class="card-body text-center min-height">
                        <iframe class="embed-responsive-item w-100 min-height" id="video"
                            allowscriptaccess="always" allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="sessionTimeOutPopup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"> <span
                    aria-hidden="true">&times;</span></button>
            <div class="modal-content">
                <div class="col-md-12">
                    <div class="form_colm red-flag row p-4">
                        <div class="col-md-12 main-div">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="align-left">
                                        <p>
                                            <i class="fa fa-exclamation-triangle fs-18px text-danger blink"
                                                aria-hidden="true"></i>
                                            The System has logged you out. Because you have been logged in without
                                            making any changes to the system.
                                            Please re log into the system before trying to make any changes.
                                        </p>
                                        <p class="text-center"><a href="{{ route('client_login') }}"
                                                target="_blank">Re-log in</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editRequestWarning" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div
                        class="alert-warning border-warning border-start-3 rounded-0 border-start-5 mb-4 alert-custom-padding">
                        <div class="d-flex">
                            <i class="bi bi-exclamation-triangle-fill fs-1 me-3 blink text-c-red pb-0 mb-0"></i>
                            <div>
                                <h5 class="alert-heading fw-bold mb-2">You submitted your questionnaire already.</h5>
                                <p class="mb-0">The system will not allow changes to the questionnaire unless your
                                    attorney grants edit access.</p>
                            </div>
                        </div>
                    </div>

                    <div
                        class="alert-info border-info border-start-3 rounded-0 border-start-5 mb-4 alert-custom-padding">
                        <i class="bi bi-info-circle-fill me-2"></i>
                        You can still upload documents without submitting an edit request.
                    </div>

                    <div class="row gx-3 mb-4">
                        <div class="col-md-6">
                            <a class="btn btn-dark-green w-100 py-2" href="{{ route('list_uploaded_documents') }}">
                                <i class="bi bi-upload me-2"></i>Upload Additional Doc(s)
                            </a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-outline-primary w-100 py-2 request-edit-access-main-btn"
                                href="javascript:void(0)" onclick="showHideRequestedForm();">
                                <i class="bi bi-pencil-square me-2"></i>Request Edit Access
                            </a>
                        </div>
                    </div>

                    <div class="request-edit-access-form hide-data mb-4">
                        <form action="{{ route('request_edit_access') }}" method="post" novalidate>
                            @csrf
                            <div class="card border-primary mb-3">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0 fw-bold text-c-white">Select Sections to Edit</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row gy-2">
                                        <div class="col-md-4">
                                            <div class="form-check text-left">
                                                <input class="form-check-input" type="checkbox"
                                                    name="requested[basic_info]" value="1" id="basic_info">
                                                <label class="form-check-label" for="basic_info">Basic Info</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check text-left">
                                                <input class="form-check-input" type="checkbox"
                                                    name="requested[property]" value="1" id="property">
                                                <label class="form-check-label" for="property">Property</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check text-left">
                                                <input class="form-check-input" type="checkbox"
                                                    name="requested[debt]" value="1" id="debt">
                                                <label class="form-check-label" for="debt">Debts</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check text-left">
                                                <input class="form-check-input" type="checkbox"
                                                    name="requested[income]" value="1" id="income">
                                                <label class="form-check-label" for="income">Current Income</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check text-left">
                                                <input class="form-check-input" type="checkbox"
                                                    name="requested[expense]" value="1" id="expense">
                                                <label class="form-check-label" for="expense">Household
                                                    Expenses</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-check text-left">
                                                <input class="form-check-input" type="checkbox"
                                                    name="requested[sofa]" value="1" id="sofa">
                                                <label class="form-check-label" for="sofa">Statement of Financial
                                                    Affairs</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary w-100 py-2" type="submit">
                                <i class="bi bi-send-fill me-2"></i>Request Access
                            </button>
                        </form>
                    </div>
                    @if (isset($authUser->concierge_service) && $authUser->concierge_service == 1)
                        <div class="card border-primary bg-light mt-4">
                            <div class="card-body">
                                <h6 class="fw-bold text-primary mb-3">
                                    <i class="bi bi-calendar-check me-2"></i>Schedule an Appointment
                                </h6>
                                <p class="mb-3">
                                    To help ensure your case is processed quickly, your attorney has asked us to review
                                    your questionnaire and documents.
                                    Please schedule an appointment with us. During this meeting, we'll make sure
                                    everything is complete and accurate before
                                    submitting your case to your attorney.
                                </p>
                                <a href="https://calendly.com/bkquestionnaire/final-document-questionnaire-review"
                                    target="_blank" class="btn btn-outline-primary">
                                    <i class="bi bi-calendar-plus me-2"></i>Schedule Appointment
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class=" alert-light border mt-4 alert-custom-padding">
                        <i class="bi bi-shield-lock me-2 text-muted"></i>
                        <small class="text-muted">This restriction protects you and your case from errors or the law
                            firm missing important information.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- default questionnaire completion popup -->
    <div class="hide-data questionnaire-completion-popup">

        <div class="row px-2">
            <div class="col-1 d-flex align-items-center sign">
                <i class="fa text-c-red blink fa-exclamation-triangle m-0" aria-hidden="true"
                    style="font-size: 28px"></i>
            </div>
            <div class="col-10">
                <h5 class="text-danger text-center text-bold mb-0">
                    Please complete the questionnaire before uploading documents, (Step 1)
                </h5>
            </div>
            <div class="col-1 d-flex align-items-center">
                <i class="fa text-c-red blink fa-exclamation-triangle m-0" aria-hidden="true"
                    style="font-size: 28px"></i>
            </div>

            <div class="col-12 mt-2">
                <p class=" mb-0">The questionnaire determines which documents are required based on your
                    specific situation and the Court's requirements. Uploading documents before
                    completing the questionnaire (Step 2) may result in repeated uploads, which can
                    be frustrating.</p>
                <p class="text-center mb-0 mt-3 text-c-blue">Additionally, completing the questionnaire first ensures
                    that we can assist you
                    effectively by identifying the exact documents needed for your case.</p>

                <div class="questionnaire-completion-popup-radio mt-3 row">
                    <div class="col-6">
                        <a class="i_will_follow is_active green btn-new-ui-default" href="#"
                            onclick="$.facebox.close(); return false;">
                            I will follow the Steps & complete the questionnaire first
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="i_will_follow item-card not-selected-border no-selected btn-new-ui-default"
                            href="#" onclick="onUploadClick(); return false;">
                            I want to upload the doc(s)</br>first anyways
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Confirmation Modal -->
    <div class="modal fade" id="submitConfirmationModal" tabindex="-1"
        aria-labelledby="submitConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitConfirmationModalLabel">Submit Questionnaire Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if (isset($authUser->concierge_service) && $authUser->concierge_service == 1)
                        <p>Are you sure you want to submit the questionnaire and uploaded documents to the BK
                            Questionnaire.</p>
                    @else
                        <p>Are you sure you want to submit the questionnaire and uploaded documents to the attorney?</p>
                    @endif

                    <div class="alert-warning alert-custom-padding d-flex align-items-start text-danger blink"
                        role="alert">
                        <i class="fa fa-exclamation-triangle me-2 mt-1 text-danger"></i>
                        <div>
                            @if (isset($authUser->concierge_service) && $authUser->concierge_service == 1)
                                Once you submit your questionnaire, you will not be able to make any changes unless your
                                attorney gives you edit permission. You can still upload any documents.
                            @else
                                Once you submit your questionnaire, you will not be able to make any changes unless BK
                                Questionnaire gives you edit permission. You can still upload any documents.
                            @endif
                        </div>
                    </div>

                    @if (isset($authUser->concierge_service) && $authUser->concierge_service == 1)
                        <div class="mt-4">
                            <a class="btn btn-link p-0" data-bs-toggle="collapse" href="#appointmentCardCollapse"
                                role="button" aria-expanded="false" aria-controls="appointmentCardCollapse">
                                <i class="bi bi-chevron-down me-1"></i> Click To See Schedule An Appointment Option
                            </a>

                            <div class="collapse mt-3" id="appointmentCardCollapse">
                                <div class="card border-primary bg-light">
                                    <div class="card-body">
                                        <h6 class="fw-bold text-primary mb-3">
                                            <i class="bi bi-calendar-check me-2"></i>Schedule an Appointment
                                        </h6>
                                        <p class="mb-3">
                                            To help ensure your case is processed quickly, your attorney has asked us to
                                            review your questionnaire and documents.
                                            Please schedule an appointment with us. During this meeting, we'll make sure
                                            everything is complete and accurate before
                                            submitting your case to your attorney.
                                        </p>
                                        <a href="https://calendly.com/bkquestionnaire/final-document-questionnaire-review"
                                            target="_blank" class="btn btn-outline-primary">
                                            <i class="bi bi-calendar-plus me-2"></i>Schedule Appointment
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <p class="mt-3">
                        I/We declare under penalty of perjury that the information contained within this questionnaire,
                        as well as the uploaded documents hereto, is true and correct to the best of my/our knowledge.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">I would like to make
                        additional changes</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Yes, I would like to submit
                        everything</button>
                </div>
            </div>
        </div>
    </div>

    <!-- [ pcoded-main-container ] end -->
    <!-- Required Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    @stack('utility_scripts')

    {{-- Common Questionnaire Utilities (loaded before questionarrie.js) --}}
    <script src="{{ asset('assets/js/client/questionnaire/common-utilities.js') }}?v=1.06"></script>

    {{-- <script src="{{ asset('assets/js/questionarrie.js') }}?v=20.08"></script> --}}
    
    {{-- TEMPORARY: JS Loading Test Script (Remove after testing) --}}
    <script src="{{ asset('assets/js/test-js-loading.js') }}"></script>

    @if (!@$web_view && !in_array(Route::currentRouteName(), ['list_uploaded_documents']))
        <script>
            document.querySelector('.action-bar-button-div').addEventListener('click', function() {
                const icon = this.querySelector('i');
                icon.classList.toggle('bi-chevron-up');
                icon.classList.toggle('bi-chevron-down');
            });
        </script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (!@$web_view)
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
    @endif

    @if (!@$web_view)
        <div class="back-to-top">
            <a href="#top">
                <i class="bi bi-caret-up-fill"></i>
                <span>Top</span>
            </a>
        </div>
    @endif

    <script>
        window.__clientLayoutRoutes = {
            addUploadClientNote: "{{ route('add_upload_client_note') }}",
            listUploadedDocuments: "{{ route('list_uploaded_documents') }}",
            clientFinalSubmit: "{{ route('client_final_submit', '_self') }}"
        };
        window.__clientLayoutData = {
            clientId: "{{ $client_id }}",
            sessionLifetime: "{{ config('session.lifetime') }}",
            editableTab1: "{{ Helper::isTabEditable('can_edit_basic_info') }}",
            editableTab2: "{{ Helper::isTabEditable('can_edit_property') }}",
            editableTab3: "{{ Helper::isTabEditable('can_edit_debts') }}",
            editableTab4: "{{ Helper::isTabEditable('can_edit_income') }}",
            editableTab5: "{{ Helper::isTabEditable('can_edit_expenase') }}",
            editableTab6: "{{ Helper::isTabEditable('can_edit_sofa') }}",
            isBasicTab: "{{ UtilityHelper::checkTabName('basic') }}",
            isPropertyTab: "{{ UtilityHelper::checkTabName('property') }}",
            isDebtTab: "{{ UtilityHelper::checkTabName('debt') }}",
            isIncomeTab: "{{ UtilityHelper::checkTabName('income') }}",
            isExpTab: "{{ UtilityHelper::checkTabName('expense') }}",
            isSofaTab: "{{ UtilityHelper::checkTabName('sofa') }}",
            isDocumentScreen: "{{ Route::currentRouteName() == 'list_uploaded_documents' ? 1 : 0 }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/client_layout.js') }}"></script>
    @stack('tab_scripts')
    @yield('dasbhoard_scripts')
    @include('components.common.success-modal', ['attorney_company' => $attorney_company ?? []])
    <script>
            $(function () {
                // Show success modal when client has actually submitted all questions
                @if (!empty($submitted_to_att_at) && isset($progress['all_percentage']) && $progress['all_percentage'] == 100)
                    if (typeof window.showSuccessModal === 'function') {
                        window.showSuccessModal();
                    } else {
                        $('#successModal').modal('show');
                    }
                @endif
            });
    </script>
   </body>
</html>
