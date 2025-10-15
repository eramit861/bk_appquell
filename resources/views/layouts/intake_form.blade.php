<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Client Bankruptcy Intake Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">

    <?php if (isset($attorney_company->company_logo) && !empty($attorney_company->company_logo) && file_exists(public_path() . '/' . $attorney_company->company_logo)) { ?>
    <meta property="og:image" content="{{url($attorney_company->company_logo)}}">
    <?php } ?>
    <link rel="icon" href="{{ asset('assets/img/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/new/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/new/intake_form.css') }}?v=1.14" />

    <!-- main.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/facebox.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/css/system_messages.css')}}">
    <?php $language = Config::get('app.locale'); ?>

    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.css')}}">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{ asset('assets/js/autocomplete.js')}}"></script>
    <script src="{{ asset('assets/js/facebox.js')}}"></script>
    <script src="{{ asset('assets/js/custom.js')}}?v=1.01"></script>
    <script type="text/javascript" src="assets/js/slick.min.js"></script>
    <script src="{{ asset('assets/js/new/intake_form.js')}}?v=1.19"></script>
    <script src="{{ asset('assets/js/new/intake_form_only.js')}}?v=1.20"></script>

</head>

<body class="{{Route::currentRouteName()}}">
    @include("layouts.flash")

    <div class="container mb-4 px-4">
        <div class="alert alert--positioned">
            <div class="close"></div>
            <div class="sysmsgcontent content"></div>
        </div>
        <div class="form-container">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="hero-content">
                    <?php if (isset($attorney_company->company_logo) && !empty($attorney_company->company_logo) && file_exists(public_path() . '/' . $attorney_company->company_logo)) { ?>
                    <div class="align-items-center d-flex text-center ">
                        <div class="questionnaire-logo text-center w-100">
                            <img src="{{url($attorney_company->company_logo)}}" class="" alt="Company Logo">
                        </div>
                    </div>
                    <?php } ?>
                    @if ($attorney->id == 55026)
                    <div class="align-items-center d-flex text-center mb-2">
                        <div class="questionnaire-logo text-center w-100">
                            <img src="{{asset('assets/img/55026.jpg')}}" class="firm-image" alt="Company Logo">
                        </div>
                    </div>
                    @else
                    <h1 class="display-5 mb-3 text-white">{{ $attorney_company->company_name }}</h1>
                    @endif
                    <h2 class="h4 mb-4 text-white">{{ $attorney_company->company_name }} Consultation Form
                        <?php
echo $stepNo == 1 ? '1 - PERSONAL' : '';
    echo $stepNo == 2 ? '2 - POSSESSIONS' : '';
    echo $stepNo == 3 ? '3 - DEBT' : '';
    ?>
                    </h2>
                    <p class="lead mb-0 text-white">Your journey to financial freedom begins here</p>
                </div>
            </div>

            <div class="p-4">

                <?php if (@$token == '') { ?>
                <p class="emergency-alert p-3 mb-3" style="text-align:center;">Invalid token please contact website
                    admin.</p>
                <?php } ?>

                @yield('content')


            </div>
        </div>
    </div>
    <?php
$attorneyUrl = Helper::validate_key_value('attorney_appointment_url', $attorney_company);
    $attorneyPhone = Helper::validate_key_value('attorney_phone', $attorney_company);
    ?>
    <!-- Bootstrap Modal HTML -->
    @include('modal.attorney.intake_form.final_submit')

    <?php if (session('showSuccessModal')) { ?>
    <script>
        $(document).ready(function () {
            $('#successModal').modal('show');
        });
    </script>
    <?php } ?>

    <?php $isReadOnly = (!empty($formData ?? []) && Helper::validate_key_value('step_3_submited', $formData ?? [], 'radio') == 1); ?>
    <?php if ($isReadOnly) { ?>
    <script>
        $(function () {
            const $form = $('#one_page_questionnaire');
            if ($form.length) {
                $form.find('input, select, textarea, button').prop('disabled', true);
                // Re-enable the navigation/next step button if present
                $form.find('.btn-submit-back, .btn-submit-dark, .btn-submit-success').prop('disabled', false);

                // Hide "Add More" and "Delete" action buttons in read-only mode
                $form.find('.add-btn, .delete-btn, .trash-btn, .delete-div, #add-more-btn, .add-more-div-bottom, .remove_clone, .remove-btn')
                    .addClass('hide-data')
                    .hide();

                // Hide timer section in read-only mode
                $form.find('.timer-section').addClass('hide-data').hide();
            }
        });
    </script>
    <?php } ?>

    <script>
        $(document).ready(function () {
            statecounty('debtor_state', 'state_based_county');
        });
        statecounty = function (divId, targetdiv) {
            var statename = $("#" + divId + " option:selected").text();
            var ajaxurl = "<?php echo route('county_by_state_name'); ?>";
            laws.ajax(ajaxurl, {
                state_name: statename
            }, function (response) {
                var res = JSON.parse(response);
                document.getElementById(targetdiv).innerHTML = "";
                $("#" + targetdiv)
                    .append($("<option></option>")
                        .attr("value", '')
                        .text("Choose County"));
                $.each(res.countyList, function (key, value) {

                    $("#" + targetdiv)
                        .append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.county_name));
                });
                var selectedValue = $("#" + targetdiv).data("value");
                $("#" + targetdiv).val(selectedValue);
            });
            setTimeout(1000);
        }

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
                        url: '<?php echo route("mortgage_search"); ?>',
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
                        url: '<?php echo route("loan_company_search"); ?>',
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
                        url: '<?php echo route("master_credit_search"); ?>',
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

        validateEmail = function (btn) {

            if (!initFormValidation()) {
                return false;
            }

            showConfirmation("Are you sure you want to submit this form to the law firm?", function (confirmation) {
                if (confirmation) {
                    const hasData = $('input[name="hasData"]').val();
                    ;
                    if (hasData == '1') {
                        $("#one_page_questionnaire").submit();
                        disableThisButton(btn);
                        $.systemMessage(langLbl.processing, 'alert--process alert');
                    } else {

                        var client_email = $("#client_email").val();
                        var url = "<?php echo route('check_email'); ?>";
                        laws.ajax(url, {
                            email: client_email
                        }, function (response) {
                            var res = JSON.parse(response);
                            if (res.status == false) {
                                $.systemMessage(res.message, 'alert--danger', true);
                            } else {
                                $("#one_page_questionnaire").submit();
                                disableThisButton(btn);
                                $.systemMessage(langLbl.processing, 'alert--process alert');
                            }
                        });
                    }
                }
            });

        }

        step2Submit = function (btn) {

            if (!initFormValidation()) {
                return false;
            }
            showConfirmation("Are you sure you want to submit this form to the law firm?", function (confirmation) {
                if (confirmation) {
                    $("#one_page_questionnaire").submit();
                    disableThisButton(btn);
                    $.systemMessage(langLbl.processing, 'alert--process alert');
                }
            });
        }

        disableThisButton = function (btn) {
            $(btn).prop('disabled', true).addClass('disabled');
        }

    </script>
</body>

</html>