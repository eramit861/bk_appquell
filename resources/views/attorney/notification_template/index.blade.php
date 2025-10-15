@extends('layouts.attorney', ['video' => $video])
@section('content')
    @include('layouts.flash')

    <div class="row">
        <div class="col-12">
            <div class="mcard ">
                <div class="mcard-body">
                    <div class="card-title-header">
                        <div class="row d-flex flex-column flex-sm-row">
                            <div class="col-12 col-sm-4 d-flex align-items-center">
                                <h4 class="card-title pb-0 mb-0 bb-0-i">
                                    <i class="bi bi-bell"></i> <?php if ($type == 'template') {
                                        echo 'Notification Template Management';
                                    } else {
                                        echo 'Notification Management';
                                    } ?>
                                </h4>
                            </div>
                            <div class="col-6 d-flex align-items-center  mt-sm-0 mt-2">
                                <a class="btn-new-ui-default bg-white att-video py-1 mx-auto" href="javascript:void(0)"
                                    data-bs-toggle="modal" onclick="run_tutorial_videos(this,'#video_modal')"
                                    title=" Click for Step by Step video" data-video="<?php echo $video['en']; ?>"
                                    data-video2="<?php echo $video['sp']; ?>">
                                    <img src="{{ asset('assets/img/new/sidebar/video-logo.png') }}" alt="Video Logo"
                                        class="mx-auto" style="height: 26px;">
                                </a>
                                <a class="btn btn-primary ai_processed_btn_top float_right btn-new-ui-default m-0 ml-auto"
                                    href="javascript:void(0)" onclick="seeAiProcessedReportStatus()"><img alt="AI"
                                        src="{{ asset('assets/img/ai_icon_dark.png') }}" class="ai-icon"
                                        style="height:20px"> See AI Processed Docs Status</a>
                            </div>
                            <div class="col-2 d-flex align-items-center mt-sm-0 mt-2">
                                <?php if ($type == 'template') { ?>
                                <button class="btn btn-primary float_right btn-new-ui-default m-0 ml-auto"
                                    data-bs-toggle="modal" data-bs-target="#add_attorney">
                                    <i class="feather icon-plus"></i> ADD TEMPLATE
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($type == 'template') { ?>
                    <div class="short_div">
                        <div class="show d-flex align-items-center">
                        </div>
                        <div class="search-field">
                            <form class="d-flex align-items-center h-100 sr" id="searchForm"
                                action="{{ route('notification_template_list', ['type' => $type]) }}" method="GET">
                                <span>Search</span><input type="hidden" name="type" value="{{ $type }}">
                                <div class="input-group mb-0">
                                    <div class="input-group-prepend bg-transparent"
                                        onclick="document.getElementById('searchForm').submit();">
                                        <i class="bi bi-search input-group-text border-0 "></i>
                                    </div>
                                    <input type="text" name="q" class="form-control bg-transparent border-0"
                                        placeholder="Search" value="{{ @$keyword }}">
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card information-area mt-3">
                <ul class="nav nav-pills nav-fill w-100 p-0" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $type == 'template' ? 'active' : ''; ?>" onclick="redirectToURL('<?php echo route('notification_template_list', ['type' => 'template']); ?>')"
                            id="notification-template-tab" data-bs-toggle="pill" data-bs-target="#notification-template"
                            type="button" role="tab" aria-controls="notification-template" aria-selected="true">
                            Notification Templates
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $type == 'automated' ? 'active' : ''; ?>" onclick="redirectToURL('<?php echo route('notification_template_list', ['type' => 'automated']); ?>')"
                            id="automated-template-tab" data-bs-toggle="pill" data-bs-target="#automated-template"
                            type="button" role="tab" aria-controls="automated-template" aria-selected="false">
                            Automated Email Templates
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php echo $type == 'broadcast' ? 'active' : ''; ?>" onclick="redirectToURL('<?php echo route('notification_template_list', ['type' => 'broadcast']); ?>')"
                            id="text-email-notification-tab" data-bs-toggle="pill" data-bs-target="#text-email-notification"
                            type="button" role="tab" aria-controls="text-email-notification" aria-selected="true">
                            Text / Email Notifications
                        </button>
                    </li>
                </ul>
                <div class="card-body border-top-left-radius-none">
                    <div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby=""
                            tabindex="0">
                            <?php if ($type == 'template') { ?>
                            @include('attorney.notification_template.template_view')
                            <?php } ?>

                            <?php if ($type == 'automated') { ?>
                            @include('attorney.notification_template.automated_view')
                            <?php } ?>

                            <?php if ($type == 'broadcast') { ?>
                            @include('attorney.notification_template.broadcast_view')
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($type == 'template')
        @include('attorney.notification_template.add_template_popup')
    @endif

    {{-- css and js --}}
    @if ($type == 'template' || $type == 'automated')
        <style>
            .attribute_bubble {
                padding: 8px 15px;
                border-radius: 2rem;
                font-size: 12px;
                margin-bottom: 1rem;
                margin-right: 10px;
                -webkit-transition: all 0.3s ease-in-out;
                transition: all 0.3s ease-in-out;
                background-color: #00b0f0;
                color: #fff;
                cursor: default;
                display: inline-block;
            }

            .attribute_bubble:hover {
                background-color: #4fd0ff;
            }

            .height-unset {
                height: unset !important;
            }

            /* head */
            .invitePopup .head {
                background: rgb(0, 22, 87);
                background: linear-gradient(90deg, #00b0f0 11%, rgba(14, 66, 223, 1) 100%);
                padding: 0rem 1.5rem;
                border-radius: 0.25rem 0.25rem 0rem 0rem;
                display: flex;
                align-items: center;
            }

            .invitePopup .head h4 {
                color: #ffffff;
            }

            .invitePopup .head a {
                padding: 5px 10px;
            }

            .invitePopup .invite-popup-att-video {
                background-color: #ffffff;
                border-radius: 0.25rem;
            }

            .invitePopup .close {
                color: #fff;
            }

            /* body */
            .invitePopup .body {
                background: #ebf2fc;
                padding: 1rem 1.5rem 1rem 1.5rem;
            }

            .invitePopup .body-middle {
                background: #ebf2fc;
                padding: 0rem 1.5rem 0rem 1.5rem;
            }

            .invitePopup .card {
                border-radius: 0.25rem;
            }

            /* foot */
            .invitePopup .foot {
                background: #eaf1fb;
                padding: 0rem 1.5rem;
                border-radius: 0rem 0rem 0.25rem 0.25rem;
            }

            .invitePopup .submitButton {
                background: #0e42df;
                color: #ffffff !important;
                border: none;
                border-radius: 0.25rem;
                float: right;
                padding: 8px 13px;
                font-weight: 600;
                /* height: 36px; */
                width: auto;
            }

            .invitePopup .closeButton {
                background: #1f1f1f;
                color: #ffffff;
                border: none;
                border-radius: 0.25rem;
                float: right;
                padding: 8px 13px;
                font-weight: 600;
                /* height: 36px; */
                width: auto;
            }

            .spinner {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.75) no-repeat center center;
                z-index: 10000;
            }

            .form-control {
                display: block;
                width: 100%;
                padding: .375rem .75rem;

                line-height: 1.5;
                color: #495057;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: .25rem;
                transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            }

            .form-control:focus {
                color: #212529;
                background-color: #fff;
                border-color: #86b7fe;
                outline: 0;
                box-shadow: 0 0 0 .25rem rgba(13, 110, 253, .25);
            }

            .form-floating>input::placeholder {
                opacity: 0;
                color: blue;
            }

            .form-floating>label {
                position: absolute;
                top: 0px;
                left: 15px !important;
                padding: .59rem .75rem;
                pointer-events: none;
                border: 1px solid transparent;
                transform-origin: 0 0;
                transition: opacity .1s ease-in-out, transform .1s ease-in-out;
            }

            .form-floating>.form-control:focus~label,
            .form-floating>.form-control:not(:placeholder-shown)~label,
            .form-floating>.form-select~label {
                opacity: 1 !important;
                transform: scale(1) translateY(-.5rem) translateX(.15rem) !important;
                color: #012cae;
                font-size: 12.5px;
                width: auto;
                height: 20.8px;
                padding: 0px 8px 0px 8px;
                margin: 0px 8px 0px 8px;
                background: white;
                transition: 0.2s ease-in-out;
                top: 0px !important;
                left: 18px;
            }

            .form-floating>.form-control,
            .form-floating>.form-select {
                height: 41px;
            }

            .form-floating>.form-control {
                padding: 9px 12px !important;
            }

            .form-floating>.form-textarea {
                height: unset !important;
                resize: none;
                overflow: hidden;
                min-height: 41px;
                line-height: 1.5;
            }

            label.error {
                color: red;
                font-style: italic;
            }

            .modal-dialog {
                max-width: 1120px !important;
                margin: 1.75rem auto;
            }

            #add_attorney .modal-content,
            #add_automated_attorney .modal-content {
                margin-top: 100px;
            }

            #facebox .content.fbminwidth {
                min-width: 450px;
                min-height: 670px !important;
            }

            #facebox .content.fbminwidth {
                min-width: 450px;
                min-height: unset !important;
            }

            .small-fb-width {
                box-shadow: 0px 8px 23px 8px rgba(0, 0, 0, 0.33);
                -webkit-box-shadow: 0px 8px 23px 8px rgba(0, 0, 0, 0.33);
                -moz-box-shadow: 0px 8px 23px 8px rgba(0, 0, 0, 0.33);
            }

            .required_message {
                color: #dc3545 !important;
                font-style: italic;
                margin-bottom: 0 !important;
                margin-top: 0.25rem;
            }

            /* Radio button styles for automated templates */
            .attribute_bubble.radio-label.selected:hover {
                background-color: #144df8;
            }

            .radio-label.selected {
                background-color: #0e42df;
                color: #ffffff !important;
            }

            .radio-label:hover {
                background-color: #4fd0ff;
            }

            /* Disabled button styles */
            button[type="submit"]:disabled {
                opacity: 0.6;
                cursor: not-allowed !important;
                pointer-events: none;
            }

            button[type="submit"]:disabled:hover {
                background-color: inherit !important;
            }

            .selected_clients_p {
                margin-bottom: 0.5rem;
            }

            .preview {
                max-height: 350px;
                overflow-y: auto;
            }

            .dropdown-menu {
                max-height: 500px;
                /* Adjust height as needed */
                overflow-y: auto;
            }

            .client-preview,
            .template-preview {
                line-height: 1.5 !important;
            }
        </style>
        <script>
            $(document).ready(function() {
                $("#notification_template_setup_form").submit(function(event) {
                    let isValid = true;

                    $(".required_message").remove();

                    if ($("#subject").val().trim() === "") {
                        isValid = false;
                        $("#subject").after('<p class="required_message">This field is required.</p>');
                    }

                    if ($("#body").val().trim() === "") {
                        isValid = false;
                        $("#body").after('<p class="required_message">This field is required.</p>');
                    }

                    if (!isValid) {
                        event.preventDefault();
                    }
                });

                $("#automated_notification_template_setup_form_for_not_logged_in_user").submit(function(event) {
                    let isValid = true;

                    $("#automated_notification_template_setup_form_for_not_logged_in_user .required_message")
                        .remove();

                    if ($("#subject_not_logged").val().trim() === "") {
                        isValid = false;
                        $("#subject_not_logged").after(
                            '<p class="required_message">This field is required.</p>');
                    }

                    // Check if time_frame radio button is selected
                    if (!$("#automated_notification_template_setup_form_for_not_logged_in_user input[name='time_frame']:checked").length) {
                        isValid = false;
                        $("#automated_notification_template_setup_form_for_not_logged_in_user .radio-group").after(
                            '<p class="required_message">Please select a time frame.</p>');
                    }

                    if (!isValid) {
                        event.preventDefault();
                    } else {
                        // Disable submit button and show loading state
                        var $submitBtn = $(this).find('button[type="submit"]');
                        $submitBtn.prop('disabled', true).text('Saving...');

                        // Re-enable button after 5 seconds as fallback (in case of network issues)
                        setTimeout(function() {
                            $submitBtn.prop('disabled', false).text('Click here to Save');
                        }, 5000);
                    }
                });

                $("#automated_notification_template_setup_form_for_logged_in_user").submit(function(event) {
                    let isValid = true;

                    $("#automated_notification_template_setup_form_for_logged_in_user .required_message")
                        .remove();

                    if ($("#subject_logged").val().trim() === "") {
                        isValid = false;
                        $("#subject_logged").after('<p class="required_message">This field is required.</p>');
                    }

                    // Check if time_frame radio button is selected
                    if (!$("#automated_notification_template_setup_form_for_logged_in_user input[name='time_frame']:checked").length) {
                        isValid = false;
                        $("#automated_notification_template_setup_form_for_logged_in_user .radio-group").after(
                            '<p class="required_message">Please select a time frame.</p>');
                    }

                    if (!isValid) {
                        event.preventDefault();
                    } else {
                        // Disable submit button and show loading state
                        var $submitBtn = $(this).find('button[type="submit"]');
                        $submitBtn.prop('disabled', true).text('Saving...');

                        // Re-enable button after 5 seconds as fallback (in case of network issues)
                        setTimeout(function() {
                            $submitBtn.prop('disabled', false).text('Click here to Save');
                        }, 5000);
                    }
                });

                $("#subject, #body, #subject_not_logged, #subject_logged").on("input", function() {
                    let value = $(this).val().trim();

                    if (value === "") {
                        if ($(this).next(".required_message").length === 0) {
                            $(this).after('<p class="required_message">This field is required.</p>');
                        }
                    } else {
                        $(this).next(".required_message").remove();
                    }
                });

                // Clear time_frame validation message when radio button is selected
                $("input[name='time_frame']").on("change", function() {
                    var form = $(this).closest('form');
                    form.find('.radio-group').next('.required_message').remove();
                });

            });

            showSpinner = function() {
                $('#loader').show();
            }
            $(document).ready(function() {
                // Initialize selected state on page load for both forms
                $('input[name="time_frame"]:checked').each(function() {
                    var radioId = $(this).attr('id');
                    $('.' + radioId).addClass('selected');
                });
            });

            function selectRadio(radioId) {
                // Get the form that contains this radio button
                var form = $('#' + radioId).closest('form');

                // Remove selected class from all radio labels within this form only
                form.find('.radio-label').removeClass('selected');

                // Uncheck all radio buttons within this form only
                form.find('input[name="time_frame"]').prop('checked', false);

                // Check the selected radio button
                $('#' + radioId).prop('checked', true);

                // Add selected class only to the span with the specific radio ID class
                $('.' + radioId).addClass('selected');
            }

            // Initialize radio buttons for automated templates
            $(document).ready(function() {
                // Initialize selected state on page load for both forms
                $('input[name="time_frame"]:checked').each(function() {
                    var radioId = $(this).attr('id');
                    $('.' + radioId).addClass('selected');
                });
            });
        </script>
    @endif
@endsection
