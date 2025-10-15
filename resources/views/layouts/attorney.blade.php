<!DOCTYPE html>
<html lang="en">

<head>
    <title>BK Assistant</title>
    <meta charset="utf-8">
    <!-- Security -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/bootstrap.min.css') }}?v=19.38">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/select2.min.css') }}?v=19.34">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/style.css') }}?v=22.09">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/dashboard.css') }}?v=19.68">
    <!-- Material Design Icons commented out for performance -->
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/materialdesignicons.min.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/font-awesome.min.css') }}?v=19.15">

    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.css') }}?v=19.15">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/plugins/animation/css/animate.min.css') }}?v=19.1">
    <link rel="stylesheet" href="{{ asset('assets/plugins/sumo/sumoselect.css') }}?v=19.1">
    <link rel="stylesheet" href="{{ asset('assets/css/system_messages.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}?v=20.14">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}?v=1.11">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bradley.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ai-requests.css') }}">

    <!-- Page-specific styles -->
    @stack('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/attorney-layout.css') }}">

    <!-- Core JavaScript Libraries -->
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Plugin Scripts -->
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/plugins/sumo/jquery.sumoselect.js') }}?v=19.15"></script>
    <script src="{{ asset('assets/js/facebox.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js') }}?v=19.15"></script>
    <script src="{{ asset('assets/js/autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.tablednd.js') }}"></script>

    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"
        integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script src="{{ asset('assets/js/custom.js') }}?v=14.30"></script>
    <script src="{{ asset('assets/js/admin.js') }}?v=1.43"></script>

    @if (request()->routeIs('questionnaire_index'))
    <link rel="stylesheet" href="{{ asset('assets/css/new/intake_edit_form.css') }}" />
    <script src="{{ asset('assets/js/new/intake_form.js') }}?v=1.19"></script>    
    <script src="{{ asset('assets/js/new/intake_form_only.js')}}?v=1.20"></script>
    @endif

    @if (in_array(Route::currentRouteName(), ['attorney_form_submission_view']))
        <script src="{{ asset('assets/js/questionarrie.js') }}?v=14.08"></script>
    @endif

    @if (in_array(Route::currentRouteName(), ['attorney_edit_client_report']))
        <script src="{{ asset('assets/js/questionarrie.js') }}?v=14.08"></script>
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    @stack('tab_styles')
    @include('analytics')
    
</head>

<body class="attorney_side_content">
    @php
        $authUser = Auth::user();
        $refreenceParent = Session::get('refrence_parent');
        $refreenceAdmin = Session::get('refrence_admin');
    @endphp

    <div class="wrapper {{ ($authUser->id == 1) ? 'm-0' : '' }}" id="togglemenu">

        @if ($authUser->id == 1)
            @include("layouts.admin.sidebar")
        @else
            @include('layouts.attorney.new.sidebar')
        @endif

        <div class="content-page pb-0">

            @if ($authUser->id == 1)
                @include('layouts.attorney.navbar')
            @else
            <div class="top-header-moblie">
                <div class="container">
                    <div class="top-header-bar">
                        <div class="show-menu-button" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                class="bi bi-list" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5">
                                </path>
                            </svg>
                        </div>
                        <div class="top-logo">
                            <img class="logo-light" src="{{ asset('assets/img/bkq_logo.png')}}" alt="logo">
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="container-fluid">
                @if (@$refreenceAdmin > 0 && @\App\Models\User::where('id', $refreenceAdmin)->value('role') == 1)
                    <div class="row">
                        <div class="col-md-12">
                            @if (Auth::user()->parent_attorney_id == 0)
                                <span class="float-right p-3"> You're logged into attorney dashboard <a
                                        class="go-back-to-parent-btn"
                                        href="{{ route('admin_login_dashboard_via_attorney', ['id' => $refreenceAdmin]) }}">CLICK
                                        HERE</a> to go back to Admin.</span>
                            @else
                                <span class="float-right p-3"> You're logged into Paralegal dashboard <a
                                        class="go-back-to-parent-btn"
                                        href="{{ route('admin_login_dashboard_via_paralegal', ['id' => $refreenceAdmin]) }}">CLICK
                                        HERE</a> to go back to Admin.</span>
                            @endif
                        </div>
                    </div>
                @endif
                <div class="card information-area attorney_side_content">
                    @yield('content')
                </div>
            </div>

            <div class="row px-3">
                <div class="col-12">
                    <div class="card information-area">
                        <div class="card mt-2 bg-transparent b-0-i">
                            <div class="card-body card-body-padding ">
                                <span class="text-muted text-center text-sm-center d-block">Copyright © 2025 <a href="#"
                                        target="_blank">{{config('app.name') }}</a>. All rights reserved.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="whole-page-overlay" id="page_loader">
        <img class="center-loader" style="width:30px;" src="{{url('/assets/img/loading2.gif')}}" alt="Loading" />
    </div>

    <div class="alert alert--positioned">
        <div class="close"></div>
        <div class="custom_alerting sysmsgcontent content"></div>
    </div>


    <!-- [ pcoded-main-container ] end -->
    <div class="modal fade" id="video_modal" tabindex="-1" aria-labelledby="videomodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title d-flex" id="videomodalLabel">
                        <svg class="me-2" xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29">
                            <g id="vds-btn" transform="translate(-299 -55)">
                                <rect id="Rectangle_27" data-name="Rectangle 27" width="29" height="29" rx="14.5"
                                    transform="translate(299 55)" fill="#0b01aa"></rect>
                                <path id="screen-play"
                                    d="M13.42,0H3.532A3.536,3.536,0,0,0,0,3.532V9.182a3.536,3.536,0,0,0,3.532,3.532H13.42a3.536,3.536,0,0,0,3.532-3.532V3.532A3.536,3.536,0,0,0,13.42,0ZM15.54,9.182A2.122,2.122,0,0,1,13.42,11.3H3.532A2.122,2.122,0,0,1,1.413,9.182V3.532A2.122,2.122,0,0,1,3.532,1.413H13.42A2.122,2.122,0,0,1,15.54,3.532ZM7.063,15.54a1.413,1.413,0,1,1-1.413-1.413A1.412,1.412,0,0,1,7.063,15.54ZM10.828,4.951,8,3.382a1.618,1.618,0,0,0-2.39,1.406V7.925A1.619,1.619,0,0,0,8,9.331l2.824-1.569a1.62,1.62,0,0,0,0-2.812Zm-.687,1.577L7.318,8.1a.2.2,0,0,1-.291-.171V4.788a.186.186,0,0,1,.1-.169.2.2,0,0,1,.1-.029.2.2,0,0,1,.1.026l2.823,1.569a.2.2,0,0,1,0,.343Zm6.811,9.011a.706.706,0,0,1-.706.706H9.182a.706.706,0,1,1,0-1.413h7.063A.706.706,0,0,1,16.952,15.539Zm-14.127,0a.706.706,0,0,1-.706.706H.706a.706.706,0,1,1,0-1.413H2.119A.706.706,0,0,1,2.825,15.539Z"
                                    transform="translate(305 61)" fill="#fff"></path>
                            </g>
                        </svg>
                        Attorney Video
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <!-- Video  -->
                    <div class="card-body text-center min-height">
                        <iframe class="embed-responsive-item w-100 min-height" id="video" allowscriptaccess="always"
                            allow="autoplay"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="modal fade" id="videos_modal" tabindex="-1" role="dialog"  aria-hidden="true" style="z-index: 9999; background-color: rgba(0, 0, 0, 0.7);">
        <div class="modal-dialog" role="document">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-content">
                <div class="container absolute-swich-btn">
                    {{-- <div class="text-center btn-cstm-toggle">
                        <span class="text-gray">English</span>
                        <label class="switch">
                        <input type="checkbox" name="graduate">
                        <span class="slider round"></span>
                        </label>
                        <span class="text-primary">Spanish</span>
                    </div> --}}
                    <div class="col-md-12 ug  english">
                        <div class="card popup-video bg-light">
                            <div class="card-body text-center">
                                <iframe class="embed-responsive-item" id="video"
                                    allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-5 phd spanish" style="display: none">
                        <div class="card bg-primaryp popup-video spanish-desktop-video">
                            <div class="card-body text-center">
                                <iframe id="player1" title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!-- Modal Placeholder -->
    <div class="modal fade" id="dynamicAiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="dynamicAiModalContent">
                <!-- AJAX will inject modal HTML here -->
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/new/dashboard.js') }}?v=19.17"></script>
    @stack('tab_scripts')

    <div class="back-to-top">
        <a href="#top">
            <svg class="svg">
                <use xlink:href="{{ asset('assets/img/sprite.svg#up-arrow') }}"
                    href="{{ asset('assets/img/sprite.svg#up-arrow') }}"></use>
            </svg>
            <span>Top</span>
        </a>
    </div>
    <script>
        seeAiProcessedReportStatus = function () {
            var test_type = '';
            ajaxurl = "{{ route('get_ai_processed_requests') }}";
            laws.ajax(ajaxurl, { test_type: test_type }, function (response) {

                var res = JSON.parse(response);
                if (res.status == 0) {
                    $.systemMessage(res.msg, 'alert--danger', true);
                } else {
                    // laws.updateFaceboxContent(res.html, 'xlarge-fb-width');
                    $('#dynamicAiModalContent').html(res.html);

                    let aiModal = document.getElementById('dynamicAiModal');
                    var documentAIModal = new bootstrap.Modal(aiModal);
                    documentAIModal.show();
                }
            });
        }
        $(document).on("input", ".phone-field", function (evt) {
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ""));
            self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
            var first10 = $(this).val().substring(0, 14);
            if (this.value.length > 14) {
                this.value = first10;
            }
        });
    </script>

    @if (request()->routeIs('questionnaire_index'))

    <script>
        $(document).on('input', ".mortgages_creditor_name", function (e) {

            $(this).autocomplete({
                'classes': {
                    "ui-autocomplete": "custom-ui-autocomplete"
                },
                'source': function (request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("mortgage_search") }}',
                        data: {
                            keyword: encodeURIComponent(request['term'])
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function (json) {
                            json = json.data;
                            response($.map(json, function (item) {
                                return {
                                    label: item['placeholder'],
                                    value: item['value'],
                                    address: item['address'],
                                    city: item['city'],
                                    state: item['state'],
                                    zip: item['zip'],
                                };
                            }));
                        },
                    });
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    var index = $(this).data('mcreditor');

                    index = parseInt(index);
                    $("input[name='mortgages_creditor_name_" + index + "']").val(ui.item.label);
                    $("input[name='mortgages_creditor_address_" + index + "']").val(ui.item.address);
                    $("input[name='mortgages_creditor_city_" + index + "']").val(ui.item.city);
                    $("select[name='mortgages_creditor_state_" + index + "']").val(ui.item.state);
                    $("input[name='mortgages_creditor_zipcode_" + index + "']").val(ui.item.zip);
                }
            });
        });

        $(document).on('input', ".vehicle_creditor_name", function (e) {
            $(this).autocomplete({
                'classes': {
                    "ui-autocomplete": "custom-ui-autocomplete"
                },
                'source': function (request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("loan_company_search") }}',
                        data: {
                            keyword: encodeURIComponent(request['term'])
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function (json) {
                            json = json.data;
                            response($.map(json, function (item) {
                                return {
                                    label: item['placeholder'],
                                    value: item['value'],
                                    address: item['address'],
                                    city: item['city'],
                                    state: item['state'],
                                    zip: item['zip'],
                                };
                            }));
                        },
                    });
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    var n = $(this).attr('name');
                    var index = n.slice(-3);
                    index = index.replace('[', '');
                    index = index.replace(']', '');
                    index = parseInt(index);

                    $("input[name='property_vehicle[vehicle_car_loan][creditor_name][" + index + "]']").val(ui.item.label);
                    $("input[name='property_vehicle[vehicle_car_loan][creditor_name_addresss][" + index + "]']").val(ui.item.address);
                    $("input[name='property_vehicle[vehicle_car_loan][creditor_city][" + index + "]']").val(ui.item.city);
                    $("select[name='property_vehicle[vehicle_car_loan][creditor_state][" + index + "]']").val(ui.item.state);
                    $("input[name='property_vehicle[vehicle_car_loan][creditor_zip][" + index + "]']").val(ui.item.zip);
                }
            });
        });

        $(document).on('input', ".al_domestic_support_name", function (e) {
            $(this).autocomplete({
                'classes': {
                    "ui-autocomplete": "custom-ui-autocomplete"
                },
                'source': function (request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route("master_credit_search") }}',
                        data: {
                            keyword: encodeURIComponent(request['term'])
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function (json) {
                            json = json.data;
                            response($.map(json, function (item) {
                                return {
                                    label: item['placeholder'],
                                    value: item['value'],
                                    address: item['address'],
                                    city: item['city'],
                                    state: item['state'],
                                    zip: item['zip'],
                                };
                            }));
                        },
                    });
                },
                select: function (event, ui) {
                    $(this).val(ui.item.label);
                    var n = $(this).attr('name');
                    var index = n.slice(-3);
                    index = index.replace('[', '');
                    index = index.replace(']', '');
                    index = parseInt(index);
                    $("input[name='additional_liens_data[domestic_support_name][" + index + "]']").val(ui.item.label);
                    $("input[name='additional_liens_data[domestic_support_address][" + index + "]']").val(ui.item.address);
                    $("input[name='additional_liens_data[domestic_support_city][" + index + "]']").val(ui.item.city);
                    $("select[name='additional_liens_data[creditor_state][" + index + "]']").val(ui.item.state);
                    $("input[name='additional_liens_data[domestic_support_zipcode][" + index + "]']").val(ui.item.zip);
                }
            });
        });
        statecounty = function (divId, targetdiv) {
            var statename = $("#" + divId + " option:selected").text();
            var ajaxurl = "{{ route('county_by_state_name') }}";
            laws.ajax(ajaxurl, {
                state_name: statename
            }, function (response) {
                var res = JSON.parse(response);
                document.getElementById(targetdiv).innerHTML = "";

                $("#" + targetdiv)
                    .append($("<option></option>")
                        .attr("value", '')
                        .text("Choose County"));

                let targetVal = $("#" + targetdiv).data("value");

                $.each(res.countyList, function (key, value) {
                    $("#" + targetdiv)
                        .append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.county_name));
                });

                if (targetVal) {
                    $("#" + targetdiv).val(targetVal);
                }
            });
            setTimeout(1000);
        }
    </script>
    @endif

    <!-- Page-specific scripts -->
    @stack('scripts')
</body>

</html>
