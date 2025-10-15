<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Client Bankruptcy Intake Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="refresh" content="{{ config('session.lifetime') * 60 }}">
    <!-- Favicon icon -->
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    @if (isset($attorney_company->company_logo) &&
            !empty($attorney_company->company_logo) &&
            file_exists(public_path() . '/' . $attorney_company->company_logo))
        <meta property="og:image" content="{{ url($attorney_company->company_logo) }}">
    @endif
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/new/bootstrap.min.css') }}" />
    <!-- main.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}?v=1.12" />
    <link rel="stylesheet" href="{{ asset('assets/css/facebox.css') }}" />
    <link rel="styleshhet" href="{{ asset('assets/css/customstyle.css') }}v=1.11">
    <link rel="styleshhet" href="{{ asset('assets/css/system_messages.css') }}">
    @php $language = Config::get('app.locale'); @endphp
    <script src="{{ asset('assets/plugins/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/js/jquery-ui.css') }}">
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.js') }}"></script>
    <script src="{{ asset('assets/js/autocomplete.js') }}"></script>
    <script src="{{ asset('assets/js/facebox.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/new/style.css') }}?v=19.99">
</head>

<body class="{{ Route::currentRouteName() }}">
    @include('layouts.flash')
    <div class="container mb-4 px-4">
        <div class="alert alert--positioned">
            <div class="close"></div>
            <div class="sysmsgcontent content"></div>
        </div>
        @php
            $sessionId = session()->getId();
        @endphp
        <form name="one_page_questionnaire" id="one_page_questionnaire" action="{{ route('questionnaire_update') }}"
            method="post" novalidate enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="session_id" value="{{ $sessionId }}">
            <div class="row">
                <input type="hidden" name="a_token" value="{{ $token ?? '' }}">

                <div class="col-12 ">
                    <div class="row bb-2 mb-3 px-0">
                        @if (isset($attorney_company->company_logo) &&
                                !empty($attorney_company->company_logo) &&
                                file_exists(public_path() . '/' . $attorney_company->company_logo))
                            <div class="col-12 align-items-center d-flex text-center">
                                <div class="questionnaire-logo text-center w-100 mt-2">
                                    <img src="{{ url($attorney_company->company_logo) }}" class=""
                                        alt="Company Logo">
                                </div>
                            </div>
                        @endif
                        <div
                            class="px-0 col-xxl-8 col-xl-8 col-lg-7 col-sm-12 col-xs-12 col-md-6 {{ !isset($attorney_company->company_logo) || empty($attorney_company->company_logo) || !file_exists(public_path() . '/' . $attorney_company->company_logo) ? 'pt-4' : 'pt-0' }} d-flex align-items-center">
                            <h1 style="">Client Bankruptcy Intake Form</h1>
                        </div>
                        <div
                            class="px-0 col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-12 col-xs-12 d-flex align-items-center">
                            <div class="div-timer w-100">
                                <span class="timer-label ml-auto">Time Left:</span>
                                <div class="timer-box">
                                    <div><span class="hours pe-1">00</span><label>Hrs</label></div>
                                    <div><span class="minutes pe-1">00</span><label>Min</label></div>
                                    <div><span class="seconds pe-1">00</span><label>Sec</label></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-notice p-3 mb-3" style="color: #856404;">
                    <i class="bi bi-exclamation-triangle-fill"></i> This form will automatically update and will not
                    save any of your info without being submitted.
                </div>

                <h4 class="p-0">Marital Status<span class="text-c-red">*</span></h4>
                <div class="light-gray-div mt-2">
                    <div class="col-12 p-0">
                        @if (empty($token ?? ''))
                            <p style="color:red;text-align:center;">Invalid token please contact website admin.</p>
                        @endif
                        <div class="label-div question-area border-0">
                            <!-- Radio -->
                            <div style="display:flex !important;"
                                class="custom-radio-group form-group d-flex flex-wrap">
                                <input type="radio" required name="martial_status" class="form-check-input"
                                    {{ old('martial_status') === 0 ? 'checked' : '' }} id="martial_status_single"
                                    value="0">
                                <label for="martial_status_single" class="btn-toggle">Single</label>
                                <input type="radio" required name="martial_status" class="form-check-input"
                                    {{ old('martial_status') === 1 ? 'checked' : '' }} id="martial_status_married"
                                    value="1">
                                <label for="martial_status_married" class="btn-toggle">Married</label>
                                <input type="radio" required name="martial_status" class="form-check-input"
                                    {{ old('martial_status') === 2 ? 'checked' : '' }} id="martial_status_seperated"
                                    value="2">
                                <label for="martial_status_seperated" class="btn-toggle">Separated</label>

                                <input type="radio" required name="martial_status" class="form-check-input"
                                    {{ old('martial_status') === 3 ? 'checked' : '' }} id="martial_status_divorced"
                                    value="3">
                                <label for="martial_status_divorced" class="btn-toggle">Divorced</label>

                                <input type="radio" required name="martial_status" class="form-check-input"
                                    {{ old('martial_status') === 4 ? 'checked' : '' }} id="martial_status_widowed"
                                    value="4">
                                <label for="martial_status_widowed" class="btn-toggle">Widowed</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                    <h4>Debtor's Basic Information</h4>
                </div>

                <div class="light-gray-div mt-2">
                    <h2>Name and Address</h2>
                    <div class="row gx-3">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="">First Name </label>
                                    <input type="text" required name="name"
                                        class="input_capitalize form-control required" placeholder="First Name"
                                        value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="">Middle Name </label>
                                    <input type="text" name="middle_name" class="input_capitalize form-control"
                                        placeholder="Middle Name" value="{{ old('middle_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="">Last Name </label>
                                    <input type="text" required name="last_name"
                                        class="input_capitalize form-control" placeholder="Last Name"
                                        value="{{ old('last_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="">Suffix </label>
                                    @php $suffixArray = ArrayHelper::getSuffixArray(); @endphp
                                    <select name="suffix" class="form-control">
                                        <option value="">None</option>
                                        @foreach ($suffixArray as $key => $val)
                                            <option {{ old('suffix') == $key ? 'selected' : '' }}
                                                value="{{ $key }}">{{ $val }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Home</label>
                                    <input type="text" required name="home" class="form-control phone-field"
                                        placeholder="Home: (123) 456-7890" value="{{ old('home') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-3">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Cell</label>
                                    <input type="text" required name="cell" class="form-control phone-field"
                                        placeholder="Cell: (123) 456-7890" value="{{ old('cell') }}">
                                </div>
                            </div>
                        </div>
                        @php
                            $showDebtorSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot(
                                $conditionalQuestions,
                                'debtor_ssn',
                            );
                            $showDebtorDL = \App\Models\ShortFormConditionalFields::returnActiveOrNot(
                                $conditionalQuestions,
                                'licence_or_id',
                            );
                            $emptyDivFor = !empty($showDebtorSSN) ? 1 : 0;
                            $emptyDivFor = !empty($showDebtorDL) ? $emptyDivFor + 1 : $emptyDivFor;

                            $debtorDOBClass = 'col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-4';
                            if ($emptyDivFor == 1) {
                                $debtorDOBClass = 'col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-4';
                            } elseif ($emptyDivFor == 2) {
                                $debtorDOBClass = 'col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-4';
                            }
                        @endphp
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-3 {{ $showDebtorSSN }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>SSN</label>
                                    <input type="text" required name="security_number" class="form-control is_ssn"
                                        placeholder="SSN" value="{{ old('security_number') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-6 col-xs-12 col-md-3 {{ $showDebtorDL }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Driver's Lic/Gov. ID</label>
                                    <input type="text" required name="work" class="form-control"
                                        placeholder="Driver's Lic/Gov. ID" value="{{ old('work') }}">
                                </div>
                            </div>
                        </div>
                        <div class="{{ $debtorDOBClass }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Date of Birth: <small>(MM/DD/YYYY)</small></label>
                                    <input type="text" name="date_of_birth" class="form-control date_filed"
                                        placeholder="MM/DD/YYYY" value="{{ old('date_of_birth') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="client_email" required name="email"
                                        class="form-control" placeholder="Email" value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12"></div>

                        <div class="col-lg-3 col-md-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" required name="Address" class="form-control"
                                        placeholder="Address" value="{{ old('Address') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>City</label>
                                    <input type="text" required name="City" class="form-control"
                                        placeholder="City" value="{{ old('City') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>State</label>
                                    <select name="state" required class="form-control" id="debtor_state">
                                        <option value="">Please Select State</option>
                                        {!! AddressHelper::getStatesList(old('state')) !!}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input type="text" required name="zip" class="allow-5digit form-control"
                                        placeholder="Zip" value="{{ old('zip') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2  col-md-3 col-sm-6 col-12">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>County</label>
                                    <select name="country" required id="state_based_county" class="form-control">
                                        <option value="0">Choose County</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-sm-12 col-xs-12 col-md-4 hide-data itin_no">
                            <div class="label-div">
                                <div class="form-group">
                                    <label>ITIN:</label>
                                    <input type="text" required name="itin" class="form-control is_ssn"
                                        placeholder="Individual Taxpayer Identification Numbers"
                                        value="{{ old('itin') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0">
                        <div class="label-div question-area">
                            <label>Have you lived at this address for at least 180 days?</label>

                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" name="lived_address_from_180" id="lived_address_from_180_yes"
                                    class="" value="1">
                                <label for="lived_address_from_180_yes" class="btn-toggle">Yes</label>

                                <input type="radio" name="lived_address_from_180" id="lived_address_from_180_no"
                                    class="" value="0">
                                <label for="lived_address_from_180_no"
                                    class="btn-toggle {{ Helper::validate_key_toggle_active('lived_address_from_180', 1, 0) }}">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0">
                        <div class="label-div question-area">
                            <label>Have you ever filed a bankruptcy case before?</label>

                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" name="filed_in_last_8_yrs" id="filed_in_last_8_yrs_yes"
                                    class="" value="0">
                                <label for="filed_in_last_8_yrs_yes" class="btn-toggle">Yes</label>

                                <input type="radio" name="filed_in_last_8_yrs" id="filed_in_last_8_yrs_no"
                                    class="" value="1">
                                <label for="filed_in_last_8_yrs_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0">
                        <div class="hide-data past_8_year_section">
                            <input type="hidden" name="chapter" value="7">
                            <input type="hidden" name="date_filed" value="">
                            <div class="row gx-3 additional_case_section additional_case_section_0 m-0">
                                <div class="light-gray-div mt-2 mb-3">
                                    <h2>Previous Case 1:</h2>
                                    <div class="row gx-3">
                                        <div class="col-md-4">
                                            <div class="label-div mb-3">
                                                <div class="form-group">
                                                    <label class="form-label">Case Name</label>
                                                    <input type="text"
                                                        class="input_capitalize form-control required"
                                                        name="any_bankruptcy_filed_before_data[case_name][0]"
                                                        placeholder="Case Name" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="label-div mb-3">
                                                <div class="form-group">
                                                    <label class="form-label">Date Filed</label>
                                                    <input type="text"
                                                        class="input_capitalize form-control date_filed required date-filed-input"
                                                        name="any_bankruptcy_filed_before_data[data_field][0]"
                                                        placeholder="MM/DD/YYYY" value="">
                                                    <div class="form-check">
                                                        <input class="form-check-input date-filed-unknown"
                                                            type="checkbox" id="date_filed_unknown_0"
                                                            name="any_bankruptcy_filed_before_data[data_field_unsure][0]"
                                                            onclick="toggleRequired('date-filed-input', this)">
                                                        <label class="form-check-label form-label"
                                                            for="date_filed_unknown_0"><small>Unsure</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="label-div mb-3">
                                                <div class="form-group">
                                                    <label class="form-label">Case Number</label>
                                                    <input type="text"
                                                        class="input_capitalize form-control required case-number-input"
                                                        name="any_bankruptcy_filed_before_data[case_numbers][0]"
                                                        placeholder="Case Number" value="">
                                                    <div class="form-check">
                                                        <input class="form-check-input case-number-unknown"
                                                            type="checkbox" id="case_number_unknown_0"
                                                            name="any_bankruptcy_filed_before_data[case_numbers_unknown][0]"
                                                            onclick="toggleRequired('case-number-input', this)">
                                                        <label class="form-check-label form-label"
                                                            for="case_number_unknown_0"><small>Unknown</small></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="label-div mb-3">
                                                <div class="form-group">
                                                    <label class="form-label">District if (known)</label>
                                                    <select
                                                        name="any_bankruptcy_filed_before_data[district_if_known][0]"
                                                        required class="form-control required">
                                                        <option value="">Select District</option>
                                                        @php $groups = []; @endphp
                                                        @foreach ($district_names as $district_name)
                                                            @if (!in_array($district_name->short_name, $groups))
                                                                <optgroup label="{{ $district_name->short_name }}">
                                                                </optgroup>
                                                                @php array_push($groups, $district_name->short_name); @endphp
                                                            @endif
                                                            <option value="{{ $district_name->district_name }}"
                                                                data-name="{{ $district_name->short_name }}"
                                                                data-id="{{ $district_name->id }}"
                                                                class="form-control">
                                                                {{ str_replace('Of', 'of', $district_name->district_name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="d-flex align-items-center additional_case_section_0 additional_addmore_section_0 prev-case-addmore">
                                <button type="button"
                                    class="vehicle-action-btn add-btn shadow-2 rounded-0 w-auto label save-btn mx-ht im-action btn-new-ui-default  mb-3 px-5 py-2"
                                    onclick="addMorePrevCaseSection(0);">
                                    <i class="bi bi-plus-lg mr-1"></i> Add More
                                </button>

                                <button type="button"
                                    class="vehicle-action-btn delete-btn delete-div trash-btn ms-auto hide-data p-inherit mb-3"
                                    title="Delete" onclick="removePrevCaseSection(0);">
                                    <i
                                        class="bi bi-trash3 mr-1 remove-btn cursor-pointer float_right remove_clone"></i>Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 p-0">
                        <div class="label-div question-area border-0 ">
                            <label>What is the total number of people living in your household including your
                                spouse:</label>

                            <div class="pl-md-3 float-r ">
                                <div class="pl-md-1 pl-0 ml-0 pr-1 form-check form-check-inline form-group d-block">
                                    <select required id="family_members"
                                        class="form-control d-inherit required w-auto ml-auto mr-0 "
                                        name="family_members">
                                        <option value=""># No.</option>
                                        @for ($i = 1; $i < 13; $i++)
                                            <option {{ old('family_members') == $i ? 'selected' : '' }}
                                                value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 d2_info hide-data p-0">
                    <div class="row pt-2">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12">
                            <h4>Co-Debtor's/Non-Filings Spouse's Information</h4>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12">
                            <div class="light-gray-div mt-2">
                                <h2 class="">Name and Address</h2>
                                <div class="row gx-3">
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label class="">First Name</label>
                                                <input type="text" required name="spouse_name"
                                                    class="input_capitalize form-control" placeholder="First Name"
                                                    value="{{ old('spouse_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label class="">Middle Name</label>
                                                <input type="text" name="spouse_middle_name"
                                                    class="input_capitalize form-control" placeholder="Middle Name"
                                                    value="{{ old('spouse_middle_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label class="">Last Name</label>
                                                <input type="text" required name="spouse_last_name"
                                                    class="input_capitalize form-control" placeholder="Last Name"
                                                    value="{{ old('spouse_last_name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label class="">Suffix</label>
                                                @php $suffixArray = ArrayHelper::getSuffixArray(); @endphp
                                                <select name="spouse_suffix" class="form-control">
                                                    <option value="">None</option>
                                                    @foreach ($suffixArray as $key => $val)
                                                        <option {{ old('spouse_suffix') == $key ? 'selected' : '' }}
                                                            value="{{ $key }}">{{ $val }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>Cell: (123) 456-7890</label>
                                                <input type="text" required name="spouse_cell"
                                                    class="form-control phone-field"
                                                    placeholder="Cell: (123) 456-7890"
                                                    value="{{ old('spouse_cell') }}">
                                            </div>
                                        </div>
                                    </div>

                                    @php
                                        $showSpouseSSN = \App\Models\ShortFormConditionalFields::returnActiveOrNot(
                                            $conditionalQuestions,
                                            'codebtor_ssn',
                                        );
                                        $spouseEmptyDivFor = !empty($showSpouseSSN) ? 1 : 0;
                                        $spouseEmptyDivFor = !empty($showDebtorDL)
                                            ? $spouseEmptyDivFor + 1
                                            : $spouseEmptyDivFor;

                                        $spouseEmailClass =
                                            'col-xxl-4 col-xl-4 col-lg-4 col-sm-12 col-xs-12 col-md-6 col-12';
                                        $spouseDateClass = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12';
                                        if ($spouseEmptyDivFor == 1) {
                                            $spouseEmailClass =
                                                'col-xxl-5 col-xl-4 col-lg-4 col-sm-12 col-xs-12 col-md-6 col-12';
                                            $spouseDateClass = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12';
                                        } elseif ($spouseEmptyDivFor == 2) {
                                            $spouseEmailClass =
                                                'col-xxl-4 col-xl-4 col-lg-5 col-sm-12 col-xs-12 col-md-5 col-12';
                                            $spouseDateClass = 'col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-12';
                                        }
                                    @endphp
                                    <div class="col-md-3 col-sm-6 col-12 {{ $showSpouseSSN }}">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>SSN</label>
                                                <input type="text" required name="spouse_security_number"
                                                    class="form-control is_ssn" placeholder="SSN"
                                                    value="{{ old('spouse_security_number') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-12 {{ $showDebtorDL }}">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>Driver's Lic/Gov. ID</label>
                                                <input type="text" required name="spouse_work"
                                                    class="form-control" placeholder="Driver's Lic/Gov. ID"
                                                    value="{{ old('spouse_work') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="{{ $spouseDateClass }}">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>Date&nbsp;of&nbsp;Birth:<small>(MM/DD/YYYY)</small></label>
                                                <input type="text" name="spouse_date_of_birth"
                                                    class="form-control date_filed " placeholder="MM/DD/YYYY"
                                                    value="{{ old('spouse_date_of_birth') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="{{ $spouseEmailClass }}">
                                        <div class="label-div">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" id="spouse_email" required name="spouse_email"
                                                    class="form-control" placeholder="Email"
                                                    value="{{ old('spouse_email') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $showEmergencySection = \App\Models\ShortFormConditionalFields::returnActiveOrNot(
                        $conditionalQuestions,
                        'emergency_checks',
                    );
                    $showDiscoverUsSection = \App\Models\ShortFormConditionalFields::returnActiveOrNot(
                        $conditionalQuestions,
                        'discover_us',
                    );
                @endphp

                <div
                    class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0 {{ $showEmergencySection }}">
                    <h4>Emergency Assessment</h4>
                </div>

                <div
                    class="light-gray-div col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 mt-2 {{ $showEmergencySection }} emergency-assesment">
                    <h2 class="">Time-sensitive legal situations</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="label-div question-area">
                                <label>Urgent Situations (Check all that apply)</label>

                                <!-- Radio -->
                                <div class="custom-radio-group custom-checkbox-group form-group multiple-radio-input">
                                    @php
                                        $eAA = \App\Helpers\ArrayHelper::getEmergencyAssessmentArray();
                                    @endphp
                                    @foreach ($eAA as $key => $label)
                                        <input type="checkbox" name="emergency_check[{{ $key }}]"
                                            id="emergency_check_{{ $key }}" class="" value="1"
                                            {{ old('emergency_check.' . $key) == 1 ? 'checked' : '' }}>
                                        <label for="emergency_check_{{ $key }}" class="btn-toggle"
                                            onclick="{{ $key == 14 ? 'otherClicked(this, `emergency_notes_section`);' : '' }}">{{ $label }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-12 emergency_notes_section {{ !empty($emergencyCheckArr[14]) && $emergencyCheckArr[14] == 1 ? '' : (old('emergency_check.' . 14) == 1 ? '' : 'hide-data') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label for="notes5">Notes:</label>
                                    <textarea placeholder="Notes" name="emergency_notes" rows="3" id="notes5"
                                        class="form-textarea form-control">{{ old('emergency_notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0 {{ $showDiscoverUsSection }}">
                    <h4>FIND</h4>
                </div>

                <div
                    class="light-gray-div col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 mt-2 {{ $showDiscoverUsSection }}">
                    <h2 class="">How you discovered us</h2>
                    <div class="row">
                        <div class="col-12">
                            <div class="label-div question-area">
                                <label>How did you find BK Assistant?</label>

                                <!-- Radio -->
                                <div class="custom-radio-group custom-checkbox-group form-group multiple-radio-input">
                                    @php
                                        $findUsArray = \App\Helpers\ArrayHelper::getFindUsArray();
                                    @endphp
                                    @foreach ($findUsArray as $key => $label)
                                        <input type="checkbox" name="find_us[{{ $key }}]"
                                            id="find_us_{{ $key }}" class="" value="1"
                                            {{ old('find_us.' . $key) == 1 ? 'checked' : '' }}>
                                        <label for="find_us_{{ $key }}" class="btn-toggle"
                                            onclick="{{ $key == 14 ? 'otherClicked(this, `referral_name_section`);' : '' }}">{{ $label }}</label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-md-4 referral_name_section {{ !empty($findUsDataArr[14]) && $findUsDataArr[14] == 1 ? '' : (old('find_us.' . 14) == 1 ? '' : 'hide-data') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">If referred by some not listed, what is their name?</label>
                                    <input type="text" name="find_us_referred_by"
                                        class="input_capitalize form-control" placeholder="Name"
                                        value="{{ old('find_us_referred_by') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div question-area">
                                <label>Have you read our Google reviews? They are the best in NC!</label>

                                <!-- Radio -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" name="google_reviews" id="google_reviews_yes"
                                        class="" value="1">
                                    <label for="google_reviews_yes" class="btn-toggle">Yes / Some</label>

                                    <input type="radio" name="google_reviews" id="google_reviews_no"
                                        class="" value="0">
                                    <label for="google_reviews_no" class="btn-toggle">No</label>

                                    @php
                                        $reviewUrl = $attorney_company->attorney_review_url ?? '';
                                    @endphp
                                    @if (!empty($reviewUrl))
                                        <div id="reviews-button-container" class="ml-auto" style="display: none;">
                                            <button type="button" class="btn-submit-success blink"
                                                onclick="window.open('{{ $reviewUrl ?? '' }}', '_blank');">
                                                <i class="bi bi-star-fill me-2"></i>
                                                Click to see {{ $attorney_company->company_name }} reviews
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="label-div question-area">
                                <label>Zoom Video Conference Experience</label>

                                <!-- Radio -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" name="zoom_exp" id="zoom_exp_yes" class=""
                                        value="1">
                                    <label for="zoom_exp_yes" class="btn-toggle">Comfortable with Zoom</label>

                                    <input type="radio" name="zoom_exp" id="zoom_exp_no" class=""
                                        value="0">
                                    <label for="zoom_exp_no" class="btn-toggle">Need Help with Zoom</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                    <h4>Current Monthly Income</h4>
                </div>

                <div class="light-gray-div col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 mt-2">
                    <h2 class="">Debtor's Income Information</h2>


                    <x-shortForm.CommonYesNoWithPrice label='Are you currently employed:'
                        radioName='debtor_gross_wages' amountName='debtor_gross_wages_month'
                        placeholder='Gross Inc./Month' />

                    <x-shortForm.CommonYesNoWithPrice label='Have you had any Self Employment Income:'
                        radioName='self_employment_inc_debtor' amountName='income_net_profit' />

                    <x-shortForm.CommonYesNoWithPrice label='Rent and other real property income:'
                        radioName='rental_inc_debtor' amountName='rental_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice label='Interest, dividends, and royalties:'
                        radioName='royality_inc_debtor' amountName='royality_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice
                        label='Pension and retirement income (NOT Social Security) (Retirement Income):'
                        radioName='retirement_inc_debtor' amountName='retirement_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice
                        label='Regular contributions from others to the household expenses, including child support:'
                        radioName='regular_contributions_inc_debtor'
                        amountName='regular_contributions_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice label='Unemployment Compensation:'
                        radioName='unemployment_compensation_inc_debtor'
                        amountName='unemployment_compensation_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice label='Social Security income. (SSI Income):'
                        radioName='social_security_inc_debtor' amountName='social_security_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice label='Other government assistance you receive regularly:'
                        radioName='government_assistance_inc_debtor'
                        amountName='government_assistance_inc_amt_debtor' />

                    <x-shortForm.CommonYesNoWithPrice label='Other sources of income not already mentioned:'
                        radioName='other_sources_inc_debtor' amountName='other_sources_inc_amt_debtor' />
                </div>
                <div
                    class="light-gray-div col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 mt-4 d2_info hide-data">
                    <h2>Co-Debtor's/Non-Filings Spouse's Income Information</h2>

                    <x-shortForm.CommonYesNoWithPrice label='Are you currently employed:'
                        radioName='joints_debtor_gross_wages' amountName='joints_debtor_gross_wages_month'
                        placeholder='Gross Income Per Month' mainDivClass='d2_info hide-data' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Have you had any Self Employment Income:' radioName='self_employment_inc_spouse'
                        amountName='income_net_profit_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Rent and other real property income:' radioName='rental_inc_spouse'
                        amountName='rental_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Interest, dividends, and royalties:' radioName='royality_inc_spouse'
                        amountName='royality_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Pension and retirement income (NOT Social Security) (Retirement Income):'
                        radioName='retirement_inc_spouse' amountName='retirement_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Regular contributions from others to the household expenses, including child support:'
                        radioName='regular_contributions_inc_spouse'
                        amountName='regular_contributions_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Unemployment Compensation:' radioName='unemployment_compensation_inc_spouse'
                        amountName='unemployment_compensation_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Social Security income. (SSI Income):' radioName='social_security_inc_spouse'
                        amountName='social_security_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Other government assistance you receive regularly:'
                        radioName='government_assistance_inc_spouse'
                        amountName='government_assistance_inc_amt_spouse' />

                    <x-shortForm.CommonYesNoWithPrice mainDivClass='d2_info hide-data'
                        label='Other sources of income not already mentioned:' radioName='other_sources_inc_spouse'
                        amountName='other_sources_inc_amt_spouse' />
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                    <h4 class="w-auto">Mortgages:</h4>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 mt-1 p-0">
                    <label class="mt-2">Please list your home and any other house, bare land or time share where
                        your name is on the deed.</label>
                </div>
                @php

                    // Property Own Data variables
                    $propertyOwnData = []; // Since this is for new submissions, initialize as empty
                    $notPrimaryAddress = old('property_own_data.not_primary_address');
                    $addressSectionClass = $notPrimaryAddress == 1 ? '' : 'd-none';
                    $propertyDataSectionClass =
                        $notPrimaryAddress !== null && $notPrimaryAddress !== '' ? '' : 'd-none';

                    // Property Type and Description
                    $propertyType = old('property_own_data.property_type');
                    $arr1 = [1, 2, 3, 4];
                    $arr2 = [5, 6];
                    $descriptionDiv = 'd-none';
                    $descriptionAndLotSizeDiv = 'd-none';
                    $descriptionAndOtherNameDiv = 'd-none';
                    if (in_array($propertyType, $arr1)) {
                        $descriptionDiv = '';
                        $descriptionAndLotSizeDiv = 'd-none';
                    }
                    if (in_array($propertyType, $arr2)) {
                        $descriptionAndLotSizeDiv = '';
                    }
                    if ($propertyType == 8) {
                        $descriptionAndOtherNameDiv = '';
                    }

                    // Property Value Section Visibility
                    $propertyValueSection = 'd-none';
                    if (in_array($propertyType, $arr1)) {
                        $bedrooms = old('property_own_data.property_bedrooms');
                        $bathrooms = old('property_own_data.property_bathrooms');
                        $sqFt = old('property_own_data.property_home_sq_ft');
                        if ($bedrooms && $bathrooms && $sqFt) {
                            $propertyValueSection = '';
                        }
                    } elseif (in_array($propertyType, $arr2)) {
                        $lotSize = old('property_own_data.property_lot_size_acres');
                        if ($lotSize) {
                            $propertyValueSection = '';
                        }
                    } elseif (in_array($propertyType, [7, 8])) {
                        $propertyValueSection = '';
                    }

                    // Property Owned By Section Visibility
                    $propertyOwnedBySection = 'd-none';
                    $estimatedPropertyValue = old('mortgage_property_value_1');
                    if ($estimatedPropertyValue) {
                        $propertyOwnedBySection = '';
                    }

                    // Mortgage Section Visibility
                    $mortgageSection = 'd-none';
                    $propertyOwnedBy = old('property_own_data.property_owned_by');
                    if ($propertyOwnedBy) {
                        $mortgageSection = '';
                    }
                @endphp
                <div class="light-gray-div mt-2 d-flex flex-row">
                    <div class="col-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div question-area ">
                            <label class="form-label">Rent or Own:</label>
                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="rent_or_own" class="" id="type_rent_1"
                                    {{ old('rent_or_own') === 0 ? 'checked' : '' }} value="0">
                                <label for="type_rent_1" class="btn-toggle">Rent</label>

                                <input type="radio" required name="rent_or_own" class="" id="type_own_1"
                                    {{ old('rent_or_own') === 1 ? 'checked' : '' }} value="1">
                                <label for="type_own_1" class="btn-toggle">Own</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 rent_div_1 p-0 hide-data">
                        <div class="label-div">
                            <label class="align-items-center d-flex">Monthly Rent</label>
                            <div class="form-group ">
                                <div class="d-flex input-group w-fit-content ">
                                    <span class="custom_corner_span h-26px br-0 input-group-text"
                                        id="basic-addon1">$</span>
                                    <input type="text" required name="mortgage_rent_1"
                                        class="form-control price-field custom_corner_input"
                                        placeholder="Monthly Rent" value="{{ old('mortgage_rent_1') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-10 col-xl-8 col-lg-8 col-sm-12 col-xs-12 col-md-8 rent_div_1 hide-data"></div>

                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 own_div_1 hide-data p-0">

                        <div class="row gx-3">
                            <div class="col-12 payment_not_primary_address_parents">
                                <div class="label-div question-area mb-4">
                                    <label class="form-label">
                                        Is this property your primary residence (<u>where you currently live</u>)?
                                    </label>
                                    <!-- Radio Buttons -->
                                    <div class="custom-radio-group form-group ">
                                        <input type="radio" id="payment_not_primary_address_no"
                                            class="d-none not_primary_address"
                                            name="property_own_data[not_primary_address]" required
                                            {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 1 ? 'checked' : '' }}
                                            value="1">
                                        <label for="payment_not_primary_address_no"
                                            class="btn-toggle {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 1 ? 'active' : '' }}"
                                            onclick="not_primary_address_property('no',this);">No</label>

                                        <input type="radio" id="payment_not_primary_address_yes"
                                            class="d-none not_primary_address"
                                            name="property_own_data[not_primary_address]" required
                                            {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 0 ? 'checked' : '' }}
                                            value="0">
                                        <label for="payment_not_primary_address_yes"
                                            class="btn-toggle {{ Helper::validate_key_value('not_primary_address', $propertyOwnData, 'radio') == 0 ? 'active' : '' }}"
                                            onclick="not_primary_address_property('yes',this);">Yes</label>
                                    </div>
                                    <div class="payment_not_primary_address_data {{ $addressSectionClass }}">
                                        <div class="row gx-3 mt-3">
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                                                <div class="label-div">
                                                    <div class="form-group">
                                                        <label class="form-label mb-2">Street Address</label>
                                                        <input type="text"
                                                            class="input_capitalize form-control required mortgage_address"
                                                            name="property_own_data[property_address]"
                                                            placeholder="Street Address"
                                                            value="{{ Helper::validate_key_value('property_address', $propertyOwnData) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                                                <div class="label-div">
                                                    <div class="form-group">
                                                        <label class="form-label mb-2">City</label>
                                                        <input type="text"
                                                            class="input_capitalize form-control required mortgage_city"
                                                            name="property_own_data[property_city]" placeholder="City"
                                                            value="{{ Helper::validate_key_value('property_city', $propertyOwnData) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                                <div class="label-div">
                                                    <div class="form-group">
                                                        @php $stateID = Helper::validate_key_value('property_state', $propertyOwnData); @endphp
                                                        <label class="form-label mb-2">State</label>
                                                        <select class="form-control required mortgage_state"
                                                            name="property_own_data[property_state]"
                                                            id="property_state" data-countyid="property_county">
                                                            <option value="">Please Select State</option>
                                                            {!! AddressHelper::getStatesList($stateID) !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                                <div class="label-div">
                                                    <div class="form-group">
                                                        <label class="form-label mb-2">ZIP Code</label>
                                                        <input type="number"
                                                            class="form-control allow-5digit required mortgage_zip"
                                                            name="property_own_data[property_zip]" placeholder="Zip"
                                                            value="{{ Helper::validate_key_value('property_zip', $propertyOwnData) }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                                                <div class="label-div">
                                                    <div class="form-group">
                                                        @php
                                                            $countyID = Helper::validate_key_value(
                                                                'property_county',
                                                                $propertyOwnData,
                                                            );
                                                            $state_name = AddressHelper::getSelectedStateName($stateID);
                                                            $statearr = explode('(', $state_name);
                                                            $state_name = isset($statearr[0]) ? trim($statearr[0]) : '';
                                                            $countyList = \App\Models\CountyFipsData::get_county_by_state_name(
                                                                $state_name,
                                                            );
                                                        @endphp
                                                        <label class="form-label mb-2">County</label>
                                                        <select name="property_own_data[property_county]"
                                                            id="property_county"
                                                            class="form-control required mortgage_county">
                                                            <option value="">Choose County</option>
                                                            @foreach ($countyList as $data)
                                                                @php $selected = ($countyID == $data['id']) ? 'selected' : ''; @endphp
                                                                <option value="{{ $data['id'] }}"
                                                                    {{ $selected }}>{{ $data['county_name'] }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="property-detail-div d-none">
                                    <div class="pt-3 mb-3">
                                        <a href="javascript:void(0)" 
                                           class="get-property-details-by-graphql shadow-2 rounded-0 float_left label save-btn mx-ht im-action btn-new-ui-default mx-0 mt-0 mb-3 px-5 py-2 vehicle-action-btn link_mortgage" 
                                           onclick="getPropertyDetailsForIntakeForm(this)"
                                           data-client-id="{{ $sessionId ?? '' }}"
                                           data-graphql-url="{{ route('get_property_residence_details_by_graphql') }}">
                                            <i class="bi bi-download"></i> Auto Import Property Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Property Section start --}}
                        <div class="col-12 property-data-section {{ $propertyDataSectionClass }}">
                                <div class="row gx-3">
                                    <div class="col-12">
                                        <div class="label-div question-area mb-0">
                                            <label class="form-label">Select which type of property this is:</label>
                                            <!-- Radio Buttons -->
                                            <div
                                                class="custom-radio-group small-radio-select-btn form-group mb-0 multi-input-radio-group">
                                                <input type="radio" id="single-family-home" class="d-none property"
                                                    name="property_own_data[property_type]" required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 1 ? 'checked' : '' }}
                                                    value="1">
                                                <label for="single-family-home"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 1 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 1)">Single family
                                                    home</label>

                                                <input type="radio" id="duplex-building" class="d-none property"
                                                    name="property_own_data[property_type]" required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 2 ? 'checked' : '' }}
                                                    value="2">
                                                <label for="duplex-building"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 2 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 2)">Duplex or multi-unit
                                                    building</label>

                                                <input type="radio" id="condominium-or-cooperative"
                                                    class="d-none property" name="property_own_data[property_type]"
                                                    required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 3 ? 'checked' : '' }}
                                                    value="3">
                                                <label for="condominium-or-cooperative"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 3 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 3)">Condominium or
                                                    cooperative</label>

                                                <input type="radio" id="manufactured-or-mobile-home"
                                                    class="d-none property" name="property_own_data[property_type]"
                                                    required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 4 ? 'checked' : '' }}
                                                    value="4">
                                                <label for="manufactured-or-mobile-home"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 4 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 4)">Manufactured or mobile
                                                    home</label>

                                                <input type="radio" id="land" class="d-none property"
                                                    name="property_own_data[property_type]" required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 5 ? 'checked' : '' }}
                                                    value="5">
                                                <label for="land"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 5 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 5)">Land</label>

                                                <input type="radio" id="investment" class="d-none property"
                                                    name="property_own_data[property_type]" required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 6 ? 'checked' : '' }}
                                                    value="6">
                                                <label for="investment"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 6 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 6)">Investment
                                                    property</label>

                                                <input type="radio" id="timeshare" class="d-none property"
                                                    name="property_own_data[property_type]" required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 7 ? 'checked' : '' }}
                                                    value="7">
                                                <label for="timeshare"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 7 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 7)">Timeshare</label>

                                                <input type="radio" id="address-other" class="d-none property"
                                                    name="property_own_data[property_type]" required
                                                    {{ Helper::validate_key_value('property_type', $propertyOwnData) == 8 ? 'checked' : '' }}
                                                    value="8">
                                                <label for="address-other"
                                                    class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_type', $propertyOwnData) == 8 ? 'active' : '' }}"
                                                    onclick="showHidePropertySizeDiv(this, 8)">Other</label>
                                            </div>
                                            <div class="row gx-3 description-div-parent mt-3">
                                                <div
                                                    class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-div {{ $descriptionDiv }}">
                                                    <div class="label-div mt-1">
                                                        <div class="form-group mt-1">
                                                            <label class="form-label mb-2 ">Bedrooms:</label>
                                                            <select class="required form-control bedroom"
                                                                name="property_own_data[property_bedrooms]">
                                                                <option value="" selected disabled>Select
                                                                    bedrooms</option>
                                                                @for ($j = 1; $j <= 21; $j++)
                                                                    @php $bedrooms = $j / 2; @endphp
                                                                    @if ($bedrooms >= 1)
                                                                        <option value="{{ $bedrooms }}"
                                                                            {{ Helper::validate_key_value('property_bedrooms', $propertyOwnData) == $bedrooms ? 'selected' : '' }}>
                                                                            {{ $bedrooms }}</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-div {{ $descriptionDiv }}">
                                                    <div class="label-div mt-1">
                                                        <div class="form-group mt-1">
                                                            <label class="form-label mb-2 ">Bathrooms:</label>
                                                            <select class="required form-control bathroom"
                                                                name="property_own_data[property_bathrooms]">
                                                                <option value="" selected disabled>Select
                                                                    bathrooms</option>
                                                                @for ($j = 1; $j <= 21; $j++)
                                                                    @php $bathrooms = $j / 2; @endphp
                                                                    @if ($bathrooms >= 1)
                                                                        <option value="{{ $bathrooms }}"
                                                                            {{ Helper::validate_key_value('property_bathrooms', $propertyOwnData) == $bathrooms ? 'selected' : '' }}>
                                                                            {{ $bathrooms }}</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-div {{ $descriptionDiv }}">
                                                    <div class="label-div mt-1">
                                                        <div class="form-group mt-1">
                                                            <label class="form-label mb-2 ">Square Feet of
                                                                home:</label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control required home_sq_ft description-div-input"
                                                                    name="property_own_data[property_home_sq_ft]"
                                                                    value="{{ Helper::validate_key_value('property_home_sq_ft', $propertyOwnData) }}">
                                                                <span class="input-group-text percent">sq ft</span>
                                                            </div>
                                                            <div id="description-error-message" style="color: red;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-and-lot-size-div {{ $descriptionAndLotSizeDiv }}">
                                                    <div class="label-div mt-1">
                                                        <div class="form-group mt-1">
                                                            <label class="form-label mb-2 ">Lot Size in Acres:</label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="form-control required lot_size_acres lot-size-div-input"
                                                                    name="property_own_data[property_lot_size_acres]"
                                                                    value="{{ Helper::validate_key_value('property_lot_size_acres', $propertyOwnData) }}">
                                                                <span class="input-group-text percent">Acre</span>
                                                            </div>
                                                            <div id="lot-error-message" style="color: red;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 col-xxl-3 description-and-other-name-div {{ $descriptionAndOtherNameDiv }}">
                                                    <div class="label-div mt-1">
                                                        <div class="form-group mt-1">
                                                            <label class="form-label mb-2 ">Name of Other Property:</label>
                                                            <div class="input-group">
                                                                <input type="text"
                                                                    class="w-auto form-control property_other_input input_capitalize"
                                                                    name="property_own_data[property_other_name]"
                                                                    placeholder="Name of other property"
                                                                    value="{{ Helper::validate_key_value('property_other_name', $propertyOwnData) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Property value section start --}}
                                        <div class="property-value-section {{ $propertyValueSection }}">
                                            <div class="row gx-3">
                                                <div class="col-12">
                                                    <div class="details-banner p-3 mb-4 text-start ">
                                                        <span class=" ">
                                                            You can find out the value of your home here
                                                            <span
                                                                onClick="window.open('http://www.zillow.com/','popup','width=1200,height=650'); return false;"
                                                                class="card-title-text text-c-blue cursor-pointer mt-2">zillow.com</span>
                                                            and/or
                                                            <span
                                                                onClick="window.open('http://www.redfin.com/','popup','width=1200,height=650'); return false;"
                                                                class="card-title-text text-c-blue cursor-pointer mt-2">redfin.com</span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 col-xxl-3">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label class="form-label">Estimated Value of Property</label>
                                                            <div class="input-group">
                                                                <span class="input-group-text">$</span>
                                                                <input type="number"
                                                                    class="form-control price-field estimated_property_value"
                                                                    placeholder="Property value"
                                                                    name="mortgage_property_value_1"
                                                                    value="{{ old('mortgage_property_value_1') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Property owned by section start --}}
                                            <div class="property-owned-by-section {{ $propertyOwnedBySection }}">
                                                <div class="label-div question-area mb-4">
                                                    <label class="fs-13px">
                                                        <strong>Owned by:</strong> You, your spouse, both you and your
                                                        spouse, you and at least one person
                                                        other than your spouse.
                                                        <div class="d-inline-block" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" title=""
                                                            data-bs-original-title="Specifies whether the property is owned by you, your spouse, both of you, or shared with someone else.">
                                                            <i class="bi bi-question-circle"></i>
                                                        </div>
                                                    </label>
                                                    <!-- Radio Buttons -->
                                                    <div
                                                        class="custom-radio-group form-group mb-0 multi-input-radio-group btn-small">
                                                        <input type="radio" id="property_owned_by_self"
                                                            class="d-none property_debt_owned_by"
                                                            name="property_own_data[property_owned_by]" required
                                                            {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 1 ? 'checked' : '' }}
                                                            value="1">
                                                        <label for="property_owned_by_self"
                                                            class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 1 ? 'active' : '' }}">Self</label>

                                                        <input type="radio" id="property_owned_by_spouse"
                                                            class="d-none property_debt_owned_by"
                                                            name="property_own_data[property_owned_by]" required
                                                            {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 2 ? 'checked' : '' }}
                                                            value="2">
                                                        <label for="property_owned_by_spouse"
                                                            class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 2 ? 'active' : '' }}">Spouse</label>

                                                        <input type="radio" id="property_owned_by_joint"
                                                            class="d-none property_debt_owned_by"
                                                            name="property_own_data[property_owned_by]" required
                                                            {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 3 ? 'checked' : '' }}
                                                            value="3">
                                                        <label for="property_owned_by_joint"
                                                            class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 3 ? 'active' : '' }}">Joint</label>

                                                        <input type="radio" id="property_owned_by_other"
                                                            class="d-none property_debt_owned_by"
                                                            name="property_own_data[property_owned_by]" required
                                                            {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 4 ? 'checked' : '' }}
                                                            value="4">
                                                        <label for="property_owned_by_other"
                                                            class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 4 ? 'active' : '' }}">Other</label>

                                                        <input type="radio" id="property_owned_by_possessory"
                                                            class="d-none property_debt_owned_by"
                                                            name="property_own_data[property_owned_by]" required
                                                            {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 5 ? 'checked' : '' }}
                                                            value="5">
                                                        <label for="property_owned_by_possessory"
                                                            class="btn-toggle prop_type_radio {{ Helper::validate_key_value('property_owned_by', $propertyOwnData) == 5 ? 'active' : '' }}">Possessory
                                                            interest only</label>
                                                    </div>
                                                </div>
                                                {{-- Mortgage section start --}}
                                                <div class="mortgage-section {{ $mortgageSection }}">
                                                    <div class="row">
                                                        <div class="">
                                                            <div class="label-div question-area ">
                                                                <label class="form-label">Do you have a loan on this property?</label>
                                                                <div class="custom-radio-group form-group  h-auto">
                                                                    <!-- Radio -->
                                                                    <input type="radio" required
                                                                        name="loan_on_property" class=""
                                                                        {{ old('loan_on_property') === 0 ? 'checked' : '' }}
                                                                        id="type_yes" value="0">
                                                                    <label for="type_yes"
                                                                        class="btn-toggle">Yes</label>
                                                                    <input type="radio" required
                                                                        name="loan_on_property" class=""
                                                                        id="type_no"
                                                                        {{ old('loan_on_property') === 1 ? 'checked' : '' }}
                                                                        value="1">
                                                                    <label for="type_no"
                                                                        class="btn-toggle">No</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 loan_div hide-data p-0">
                                                        <div class="light-gray-div mt-2">
                                                            <div class="sub-div">
                                                                <span class="">Mortgage 1 </span>
                                                            </div>
                                                            <div class="row gx-3">
                                                                <div
                                                                    class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label class="">Est. Mortgage - 1st
                                                                                Amount Owed</label>
                                                                            <div class="d-flex input-group">
                                                                                <span
                                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                                    id="basic-addon1">$</span>
                                                                                <input type="text" required
                                                                                    name="mortgage_amount_owned_1"
                                                                                    class="form-control price-field custom_corner_input"
                                                                                    placeholder="Est. Mortgage - 1st Amount Owed"
                                                                                    value="{{ old('mortgage_amount_owned_1') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label class=""> Monthly Payment -
                                                                                1st</label>
                                                                            <div class="d-flex input-group">
                                                                                <span
                                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                                    id="basic-addon1">$</span>
                                                                                <input type="text" required
                                                                                    name="mortgage_own_1"
                                                                                    class="form-control price-field custom_corner_input"
                                                                                    placeholder="Monthly Payment - 1st"
                                                                                    value="{{ old('mortgage_own_1') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label class="aa">Est. Past Due
                                                                                Payments - 1st</label>
                                                                            <div class="d-flex input-group">
                                                                                <span
                                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                                    id="basic-addon1">$</span>
                                                                                <input type="text" required
                                                                                    name="mortgage_past_payment_1"
                                                                                    class="price-field form-control custom_corner_input"
                                                                                    placeholder="Est. Past Due Payments - 1st"
                                                                                    value="{{ old('mortgage_past_payment_1') }}">
                                                                            </div>
                                                                            <small
                                                                                class="custom-input-sub-label-on-desktop ml-0-imp text-c-blue fs-12px"><i>If
                                                                                    your current on this mortgage type
                                                                                    in $0.00</i></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                                    
                                                                </div>
                                                                <div
                                                                    class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label>Creditor Name</label>
                                                                            <input type="text" autocomplete="off"
                                                                                autocomplete
                                                                                class="input_capitalize form-control autocomplete mortgages_creditor_name mortgages_creditor_name_1 required"
                                                                                name="mortgages_creditor_name_1"
                                                                                placeholder="Name of person"
                                                                                data-mcreditor="1"
                                                                                value="{{ old('mortgages_creditor_name_1') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-4 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label>Street Address</label>
                                                                            <input type="text"
                                                                                class="form-control mortgages_creditor_address_1"
                                                                                name="mortgages_creditor_address_1"
                                                                                placeholder="Street address of person"
                                                                                value="{{ old('mortgages_creditor_address_1') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-4">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label>City</label>
                                                                            <input type="text"
                                                                                class="form-control mortgages_creditor_city_1"
                                                                                name="mortgages_creditor_city_1"
                                                                                placeholder="City"
                                                                                value="{{ old('mortgages_creditor_city_1') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-5">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label>State</label>
                                                                            <select
                                                                                class="form-control mortgages_creditor_state_1"
                                                                                name="mortgages_creditor_state_1">
                                                                                <option value="">Please Select
                                                                                    State</option>
                                                                                {!! AddressHelper::getStatesList(old('mortgages_creditor_state_1')) !!}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-xxl-1 col-xl-2 col-lg-2 col-sm-12 col-xs-12 col-md-3">
                                                                    <div class="label-div">
                                                                        <div class="form-group">
                                                                            <label>Zip code</label>
                                                                            <input type="text"
                                                                                class="form-control allow-5digit mortgages_creditor_zipcode_1"
                                                                                name="mortgages_creditor_zipcode_1"
                                                                                placeholder="Zip code"
                                                                                value="{{ old('mortgages_creditor_zipcode_1') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 additional_loans hide-data ">
                                                                    <div class="label-div question-area ">
                                                                        <label class="form-label">Do you have
                                                                            additional loans?</label>

                                                                        <div
                                                                            class="custom-radio-group form-group  h-auto">
                                                                            <!-- Radio -->
                                                                            <input type="radio" required
                                                                                name="mortgage_additional_loans"
                                                                                class="form-check-input"
                                                                                id="additional_loans_yes_1"
                                                                                {{ old('mortgage_additional_loans') === 1 ? 'checked' : '' }}
                                                                                value="1">
                                                                            <label for="additional_loans_yes_1"
                                                                                class="btn-toggle">Yes</label>
                                                                            <input type="radio" required
                                                                                name="mortgage_additional_loans"
                                                                                class="form-check-input"
                                                                                id="additional_loans_no_1"
                                                                                {{ old('mortgage_additional_loans') === 0 ? 'checked' : '' }}
                                                                                value="0">
                                                                            <label for="additional_loans_no_1"
                                                                                class="btn-toggle">No</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            class="col-xxl-7 col-xl-6 col-lg-6 col-sm-12 col-xs-12 col-md-0 additional_loans">
                                                        </div>
                                                        <div
                                                            class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 additional_loans_div hide-data p-0">
                                                            <div class="light-gray-div mt-2">
                                                                <div class="sub-div">
                                                                    <span class="">Mortgage 2 </span>
                                                                </div>
                                                                <div class="row gx-3">
                                                                    <div
                                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label class=" ">Est. Mortgage -
                                                                                    2nd Amount Owed</label>
                                                                                <div class="d-flex input-group">
                                                                                    <span
                                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                                        id="basic-addon1">$</span>
                                                                                    <input type="text" required
                                                                                        name="mortgage_amount_owned_2"
                                                                                        class="form-control price-field custom_corner_input"
                                                                                        placeholder="Est. Mortgage - 2nd Amount Owed"
                                                                                        value="{{ old('mortgage_amount_owned_2') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label class=" "> Monthly Payment
                                                                                    - 2nd</label>
                                                                                <div class="d-flex input-group">
                                                                                    <span
                                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                                        id="basic-addon1">$</span>
                                                                                    <input type="text" required
                                                                                        name="mortgage_own_2"
                                                                                        class="form-control price-field custom_corner_input"
                                                                                        placeholder="Monthly Payment - 2nd"
                                                                                        value="{{ old('mortgage_own_2') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div ">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label class=" ">Est. Past Due
                                                                                    Payments - 2nd</label>

                                                                                <div class="d-flex input-group">
                                                                                    <span
                                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                                        id="basic-addon1">$</span>
                                                                                    <input type="text" required
                                                                                        name="mortgage_past_payment_2"
                                                                                        class="form-control price-field custom_corner_input "
                                                                                        placeholder="Est. Past Due Payments - 2nd"
                                                                                        value="{{ old('mortgage_past_payment_2') }}">
                                                                                </div>
                                                                                <small
                                                                                    class="custom-input-sub-label-on-desktop text-c-blue ml-0 fs-12px"><i>If
                                                                                        your current on this mortgage
                                                                                        type in $0.00</i></small>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-1 col-xl-3 col-lg-0 col-sm-12 col-xs-12 col-md-0 col-0 px-0 own_div">
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label>Creditor Name</label>
                                                                                <input type="text"
                                                                                    autocomplete="off" autocomplete
                                                                                    data-mcreditor="2"
                                                                                    class="input_capitalize form-control autocomplete mortgages_creditor_name mortgages_creditor_name_2 required"
                                                                                    name="mortgages_creditor_name_2"
                                                                                    placeholder="Name of person"
                                                                                    value="{{ old('mortgages_creditor_name_2') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label>Street Address</label>
                                                                                <input type="text"
                                                                                    class="form-control mortgages_creditor_address_2 "
                                                                                    name="mortgages_creditor_address_2"
                                                                                    placeholder="Street address of person"
                                                                                    value="{{ old('mortgages_creditor_address_2') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-4 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label>City</label>
                                                                                <input type="text"
                                                                                    class="form-control mortgages_creditor_city_2 "
                                                                                    name="mortgages_creditor_city_2"
                                                                                    placeholder="City"
                                                                                    value="{{ old('mortgages_creditor_city_2') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-5 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label>State</label>
                                                                                <select
                                                                                    class="form-control mortgages_creditor_state_2 "
                                                                                    name="mortgages_creditor_state_2">
                                                                                    <option value="">Please
                                                                                        Select State</option>
                                                                                    {!! AddressHelper::getStatesList(old('mortgages_creditor_state_2')) !!}
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 col-xs-12 col-md-3 own_div">
                                                                        <div class="label-div">
                                                                            <div class="form-group">
                                                                                <label>Zip code</label>
                                                                                <input type="text"
                                                                                    class="form-control allow-5digit mortgages_creditor_zipcode_2 "
                                                                                    name="mortgages_creditor_zipcode_2"
                                                                                    placeholder="Zip code"
                                                                                    value="{{ old('mortgages_creditor_zipcode_2') }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-12 additional_loans hide-data">
                                                                        <div class="label-div question-area ">
                                                                            <label class="form-label">Do you have
                                                                                additional loans?</label>
                                                                            <!-- Radio -->
                                                                            <div class="">
                                                                                <div
                                                                                    class="custom-radio-group form-group  h-auto">
                                                                                    <input type="radio" required
                                                                                        name="mortgage_additional_loans_2"
                                                                                        class="form-check-input"
                                                                                        id="additional_loans_yes_2"
                                                                                        {{ old('mortgage_additional_loans_2') === 1 ? 'checked' : '' }}
                                                                                        value="1">
                                                                                    <label
                                                                                        for="additional_loans_yes_2"
                                                                                        class="btn-toggle">Yes</label>
                                                                                    <input type="radio" required
                                                                                        name="mortgage_additional_loans_2"
                                                                                        class="form-check-input"
                                                                                        id="additional_loans_no_2"
                                                                                        {{ old('mortgage_additional_loans_2') === 0 ? 'checked' : '' }}
                                                                                        value="0">
                                                                                    <label for="additional_loans_no_2"
                                                                                        class="btn-toggle">No</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div
                                                                class="col-xxl-7 col-xl-6 col-lg-6 col-sm-12 col-xs-12 col-md-0 additional_loans hide-data">
                                                            </div>
                                                            <div
                                                                class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 additional_loans_div_2 hide-data p-0">
                                                                <div class="light-gray-div mt-2">
                                                                    <div class="sub-div">
                                                                        <span class="">Mortgage 3 </span>
                                                                    </div>
                                                                    <div class="row gx-3">
                                                                        <div
                                                                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div ">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label class="">Est.
                                                                                        Mortgage - 3rd Amount
                                                                                        Owed</label>
                                                                                    <div class="d-flex input-group">
                                                                                        <span
                                                                                            class="custom_corner_span h-26px br-0 input-group-text"
                                                                                            id="basic-addon1">$</span>
                                                                                        <input type="text" required
                                                                                            name="mortgage_amount_owned_3"
                                                                                            class="form-control price-field custom_corner_input"
                                                                                            placeholder="Est. Mortgage - 3rd Amount Owed"
                                                                                            value="{{ old('mortgage_amount_owned_3') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label class=""> Monthly
                                                                                        Payment - 3rd</label>
                                                                                    <div class="d-flex input-group ">
                                                                                        <span
                                                                                            class="custom_corner_span h-26px br-0 input-group-text"
                                                                                            id="basic-addon1">$</span>
                                                                                        <input type="text" required
                                                                                            name="mortgage_own_3"
                                                                                            class="form-control price-field custom_corner_input"
                                                                                            placeholder="Monthly Payment - 3rd"
                                                                                            value="{{ old('mortgage_own_3') }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label class="">Est. Past
                                                                                        Due Payments - 3rd</label>
                                                                                    <div class="d-flex input-group ">
                                                                                        <span
                                                                                            class="custom_corner_span h-26px br-0 input-group-text"
                                                                                            id="basic-addon1">$</span>
                                                                                        <input type="text" required
                                                                                            name="mortgage_past_payment_3"
                                                                                            class="form-control price-field custom_corner_input"
                                                                                            placeholder="Est. Past Due Payments - 3rd"
                                                                                            value="{{ old('mortgage_past_payment_3') }}">
                                                                                    </div>
                                                                                    <small
                                                                                        class="custom-input-sub-label-on-desktop text-c-blue ml-0 fs-12px"><i>If
                                                                                            your current on this
                                                                                            mortgage type in
                                                                                            $0.00</i></small>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-3 col-xl-3 col-lg-0 col-sm-12 col-xs-12 col-md-0 col-0 px-0 own_div">
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label>Creditor Name</label>
                                                                                    <input type="text"
                                                                                        autocomplete="off"
                                                                                        autocomplete
                                                                                        data-mcreditor="3"
                                                                                        class="input_capitalize form-control autocomplete mortgages_creditor_name   mortgages_creditor_name_3 required"
                                                                                        name="mortgages_creditor_name_3"
                                                                                        placeholder="Name of person"
                                                                                        value="{{ old('mortgages_creditor_name_3') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label>Street Address</label>
                                                                                    <input type="text"
                                                                                        class="form-control mortgages_creditor_address_3 "
                                                                                        name="mortgages_creditor_address_3"
                                                                                        placeholder="Street address of person"
                                                                                        value="{{ old('mortgages_creditor_address_3') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-4 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label>City</label>
                                                                                    <input type="text"
                                                                                        class="form-control mortgages_creditor_city_3 "
                                                                                        name="mortgages_creditor_city_3"
                                                                                        placeholder="City"
                                                                                        value="{{ old('mortgages_creditor_city_3') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-5 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label>State</label>
                                                                                    <select
                                                                                        class="form-control mortgages_creditor_state_3 "
                                                                                        name="mortgages_creditor_state_3">
                                                                                        <option value="">Please
                                                                                            Select State</option>
                                                                                        {!! AddressHelper::getStatesList(old('mortgages_creditor_state_3')) !!}
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 col-xs-12 col-md-3 own_div">
                                                                            <div class="label-div">
                                                                                <div class="form-group">
                                                                                    <label>Zip code</label>
                                                                                    <input type="text"
                                                                                        class="form-control allow-5digit mortgages_creditor_zipcode_3 "
                                                                                        name="mortgages_creditor_zipcode_3"
                                                                                        placeholder="Zip code"
                                                                                        value="{{ old('mortgages_creditor_zipcode_3') }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div
                                                                            class="col-xxl-8 col-xl-10 col-lg-10 col-sm-12 col-xs-12 col-md-10 rent_div">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- Mortgage section end --}}
                                            </div>
                                            {{-- Property owned by section end --}}
                                        </div>
                                        {{-- Property value section end --}}
                                    </div>
                                </div>
                            </div>
                            {{-- Property Section end --}}
                        </div>


                    </div>


                    <div class="col-xl-6 col-lg-6 col-sm-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div question-area  ">
                            <label class="form-label">Property in foreclosure?</label>
                            <div class="custom-radio-group form-group">
                                <!-- Radio -->
                                <input type="radio" required name="mortgage_foreclosure_property"
                                    {{ old('mortgage_foreclosure_property') === 0 ? 'checked' : '' }}
                                    class="form-check-input" id="foreclosure_property_yes" value="0">
                                <label for="foreclosure_property_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="mortgage_foreclosure_property"
                                    class="form-check-input"
                                    {{ old('mortgage_foreclosure_property') === 1 ? 'checked' : '' }}
                                    id="foreclosure_property_no" value="1">
                                <label for="foreclosure_property_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-lg-6 col-sm-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div question-area ">
                            <label class="form-label">Foreclosure sale date been set?</label>
                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="mortgage_foreclosure_date"
                                    {{ old('mortgage_foreclosure_date') === 0 ? 'checked' : '' }}
                                    class="form-check-input" id="foreclosure_date_yes" value="0">
                                <label for="foreclosure_date_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="mortgage_foreclosure_date"
                                    class="form-check-input"
                                    {{ old('mortgage_foreclosure_date') === 1 ? 'checked' : '' }}
                                    id="foreclosure_date_no" value="1">
                                <label for="foreclosure_date_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-sm-12 col-xs-12 col-md-8 pl-0 forecloser_section hide-data">
                        <div class="label-div">
                            <div class="form-group forecloser_section hide-data">
                                <label for="notes1">Notes:</label>
                                <textarea placeholder="Notes" name="mortgage_notes" rows="3" id="notes2"
                                    class="form-textarea form-control">{{ old('mortgage_notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class=" col-sm-12 col-xs-12 col-md-4 p-0 p-md-2 forecloser_date_section hide-data">
                        <div class="label-div">
                            <div class="form-group forecloser_date_section hide-data ">
                                <label>Foreclosure Date: MM/DD/YYYY</label>
                                <input type="text" name="mortgage_foreclosure_date_scheduled"
                                    class="form-control date_filed max-w-250px"
                                    placeholder="Foreclosure Date: MM/DD/YYYY"
                                    value="{{ old('mortgage_foreclosure_date_scheduled') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0 ">
                    <h4 class="w-auto">Vehicles/ Motorcycles/ Boats etc.:</h4>
                </div>
                <div class="light-gray-div mt-2">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                        <label class="d-block">(LIST ALL VEHICLES YOU OWN, WHETHER YOU OWE MONEY ON THEM OR NOT)<br>
                            <div class="label-div question-area  mt-2">
                                <!-- Radio -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" required name="own_any_vehicle"
                                        {{ old('own_any_vehicle') === 1 ? 'checked' : '' }} class="form-check-input"
                                        id="own_any_vehicle_yes" value="1">
                                    <label for="own_any_vehicle_yes" class="btn-toggle">Yes</label>
                                    <input type="radio" required name="own_any_vehicle"
                                        {{ old('own_any_vehicle') === 0 ? 'checked' : '' }} class="form-check-input"
                                        id="own_any_vehicle_no" value="0">
                                    <label for="own_any_vehicle_no" class="btn-toggle">No</label>
                                </div>
                            </div>
                    </div>
                    <div class="notice p-3 mb-3">
                        (Please list any & ALL types of property listed above you possess, own or use even if you're not
                        on the title or registration.)
                    </div>
                    <div
                        class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 row own_vehicle hide-data pr-0 m-0 p-0">
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                            <label class="mb-2">Please list all cars, trucks, motorcycles, boats or aircraft where
                                your
                                name is on the registration.</label>
                            <div class="details-banner p-3 mb-3 text-start">
                                <span class="">
                                    Click to get value here
                                    <span
                                        onClick="window.open('https://www.kbb.com/','popup','width=1200,height=650'); return false;"
                                        class="card-title-text text-c-blue cursor-pointer mt-2">kbb.com</span>
                                    and/or
                                    <span
                                        onClick="window.open('https://www.nada.com/','popup','width=1200,height=650'); return false;"
                                        class="card-title-text text-c-blue cursor-pointer mt-2">nada.com</span>
                                </span>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12"
                            id="vehicle_page_listing_area">
                            <div id="vehicle_listing_html">
                                @php $i = 1; @endphp
                                <div class="row single-vehicle-form vehicle_form_div_{{ $i + 1 }}">
                                    <div class="light-gray-div mt-2">
                                        <div class="sub-div">
                                            <span class="vtype_name">Vehicle </span>
                                            <span class="vehicleno"> {{ $i }} </span>
                                        </div>
                                        <div class="row gx-3">
                                            <div class="col-12">
                                                <div class="label-div mb-3">
                                                    <label class="form-label">Upload Vehicle Property Value Document
                                                        (Optional)</label>
                                                    <div class="form-group">
                                                        <input type="file"
                                                            class="form-control vehicle_file_upload"
                                                            name="property_vehicle[vehicle_property_value_document][{{ $i }}]"
                                                            id="vehicle_file_{{ $i }}"
                                                            accept="image/*,.pdf,.doc,.docx">
                                                    </div>
                                                </div>
                                            </div>
                                            @php
                                                $property_type = old('property_vehicle.property_type.' . $i, 1);
                                                $property_type_name = old(
                                                    'property_vehicle.property_type_name.' . $i,
                                                    '',
                                                );
                                            @endphp
                                            <div class="col-12 col-md-12">
                                                <div class="chip-style-tab label-div mb-0 mt-2">
                                                    <div class="row">
                                                        <div class="col-12 col-md-6">
                                                            <div class="light-gray-div mb-3">
                                                                <h2 class="pl-2">Vehicle Type</h2>
                                                                <div class="d-flex flex-wrap w-100">
                                                                    <label
                                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Cars' ? 'active' : '' }}{{ empty($property_type_name) && $property_type == 1 ? 'active' : '' }}">
                                                                        <span class="emoji-icon">&#x1F697;</span>Cars
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="1" data-label="Cars"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 1 && ($property_type_name == 'Cars' || empty($property_type_name)) ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Motorcycles' ? 'active' : '' }}">
                                                                        <span
                                                                            class="emoji-icon">&#x1F3CD;&#xFE0F;</span>Motorcycles
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="1" data-label="Motorcycles"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 1 && $property_type_name == 'Motorcycles' ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Vans' ? 'active' : '' }}">
                                                                        <span class="emoji-icon">&#x1F690;</span>Vans
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="1" data-label="Vans"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 1 && $property_type_name == 'Vans' ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Trucks' ? 'active' : '' }}">
                                                                        <span
                                                                            class="emoji-icon">&#x1F69A;</span>Trucks
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="1" data-label="Trucks"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 1 && $property_type_name == 'Trucks' ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab {{ $property_type == 1 && $property_type_name == 'Sport utility vehicles' ? 'active' : '' }}">
                                                                        <span class="emoji-icon">&#x1F699;</span>Sport
                                                                        utility vehicles
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="1"
                                                                            data-label="Sport utility vehicles"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 1 && $property_type_name == 'Sport utility vehicles' ? 'checked' : '' }}>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-6">
                                                            <div class="light-gray-div mb-3">
                                                                <h2 class="pl-2">Recreational Vehicle Type</h2>
                                                                <div class="d-flex flex-wrap w-100">
                                                                    <label
                                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Tractors' ? 'active' : '' }}{{ empty($property_type_name) && $property_type == 6 ? 'active' : '' }}">
                                                                        <span
                                                                            class="emoji-icon">&#x1F69C;</span>Tractors
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="6" data-label="Tractors"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 6 && ($property_type_name == 'Tractors' || empty($property_type_name)) ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Watercraft' ? 'active' : '' }}">
                                                                        <span
                                                                            class="emoji-icon">&#x1F6A4;</span>Watercraft
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="6" data-label="Watercraft"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 6 && $property_type_name == 'Watercraft' ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Motor homes' ? 'active' : '' }}">
                                                                        <span class="emoji-icon">&#x1F690;</span>Motor
                                                                        homes
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="6" data-label="Motor homes"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 6 && $property_type_name == 'Motor homes' ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'ATVs' ? 'active' : '' }}">
                                                                        <span class="emoji-icon">&#x1F6FB;</span>ATVs
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="6" data-label="ATVs"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 6 && $property_type_name == 'ATVs' ? 'checked' : '' }}>
                                                                    </label>

                                                                    <label
                                                                        class="chip-tab rec {{ $property_type == 6 && $property_type_name == 'Other vehicles' ? 'active' : '' }}">
                                                                        <span class="emoji-icon">&#x1F6F8;</span>Other
                                                                        vehicles
                                                                        <input type="radio"
                                                                            name="property_vehicle[property_type][{{ $i }}]"
                                                                            class="property_type required d-none"
                                                                            value="6"
                                                                            data-label="Other vehicles"
                                                                            onclick="changeVehicleQuestionnaire(this, {{ $i }})"
                                                                            {{ $property_type == 6 && $property_type_name == 'Other vehicles' ? 'checked' : '' }}>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" class="property_type_name"
                                                        name="property_vehicle[property_type_name][{{ $i }}]"
                                                        value="{{ $property_type_name }}">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="label-div mb-3">
                                                    <div
                                                        class="form-group mb-0 vin_number_div vin_number_div_{{ $i }}">
                                                        <label class="form-label">Input the vehicle Vin #
                                                            below</label>
                                                        <input type="text" oninput="vinOnInput(this)"
                                                            placeholder="VIN"
                                                            value="{{ old('property_vehicle.vin_number.' . $i) }}"
                                                            name="property_vehicle[vin_number][{{ $i }}]"
                                                            id="vin_{{ $i }}"
                                                            class="w-100 form-control text-uppercase vin_number">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label-div mb-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Mileage</label>
                                                        <input required type="text"
                                                            name="property_vehicle[property_mileage][{{ $i }}]"
                                                            value="{{ old('property_vehicle.property_mileage.' . $i) }}"
                                                            class="form-control property_mileage"
                                                            placeholder="Mileage">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="label-div mb-3">
                                                    <div class="form-group mt-2 mb-2 vin-import-btn-div">
                                                        <label class="form-label d-none d-md-block">&nbsp;</label>
                                                        <a class="link_vin shadow-2 rounded-0 float_left label save-btn mx-ht im-action btn-new-ui-default m-0 px-5 py-2 vehicle-action-btn"
                                                            href="javascript:void(0)"
                                                            id="link_vin_{{ $i }}"
                                                            data-fetch-url="{{ route('fetch_vin_number') }}"
                                                            data-intake-form-id="{{ $sessionId }}"
                                                            data-property-fetch-url="{{ route('get_property_vehicle_details_by_graphql') }}"
                                                            onclick="checkVin2Number(this)">
                                                            <i class="bi bi-download"></i> Auto Import Vehicle Info
                                                        </a>
                                                    </div>
                                                    <div
                                                        class="form-check form-group mb-0 vin_number_div vin_number_div_{{ $i }}">
                                                        <label class="mb-0 form-check-label vin_label_check">
                                                            <input
                                                                class="form-check-input unknown_vin unknown_vin_{{ $i }}"
                                                                value="1" type="checkbox"
                                                                onclick="checkUnknownVin(this, {{ $i }})">
                                                            <small class="">Select IF you can't find the
                                                                Vin#</small>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                // Determine if vehicle data section should be visible initially
                                                $vehicleDataSectionClass = 'd-none';
                                                if (
                                                    !empty(old('property_vehicle.property_year.' . $i)) ||
                                                    !empty(old('property_vehicle.property_make.' . $i)) ||
                                                    !empty(old('property_vehicle.property_model.' . $i))
                                                ) {
                                                    $vehicleDataSectionClass = '';
                                                }
                                            @endphp

                                            <div
                                                class="col-12 vehicle-data-section-{{ $i }} {{ $vehicleDataSectionClass }}">
                                                <div class="row gx-3">
                                                    <div
                                                        class="col-xxl-1 col-xl-2 col-lg-2 col-sm-12 col-xs-12 col-md-3">
                                                        <div class="label-div">
                                                            <div class="form-group">
                                                                <label class="">Year</label>
                                                                <input required type="text"
                                                                    name="property_vehicle[property_year][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.property_year.' . $i) }}"
                                                                    class="form-control property_year"
                                                                    placeholder="Year">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-4">
                                                        <div class="label-div">
                                                            <div class="form-group">
                                                                <label class="">Make</label>
                                                                <input required type="text"
                                                                    name="property_vehicle[property_make][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.property_make.' . $i) }}"
                                                                    class="form-control property_make"
                                                                    placeholder="Make">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-4">
                                                        <div class="label-div">
                                                            <div class="form-group">
                                                                <label class="">Model</label>
                                                                <input required type="text"
                                                                    name="property_vehicle[property_model][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.property_model.' . $i) }}"
                                                                    class="form-control property_model"
                                                                    placeholder="Model">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-4">
                                                        <div class="label-div">
                                                            <div class="form-group">
                                                                <label class="">Style of Vehicle</label>
                                                                <input required type="text"
                                                                    name="property_vehicle[property_other_info][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.property_other_info.' . $i) }}"
                                                                    class="form-control property_other_info"
                                                                    placeholder="Style of Vehicle">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-5  ">
                                                        <div class="label-div">
                                                            <div class="form-group ">
                                                                <label class="">Estimated Value of
                                                                    Property</label>
                                                                <div class="d-flex input-group pt-2 pt-md-0">
                                                                    <span
                                                                        class="custom_corner_span h-26px br-0 input-group-text"
                                                                        id="basic-addon1">$</span>
                                                                    <input required type="text"
                                                                        class="custom_corner_input form-control price-field property_estimated_value"
                                                                        name="property_vehicle[property_estimated_value][{{ $i }}]"
                                                                        placeholder="Estimated Value of Property"
                                                                        value="{{ old('property_vehicle.property_estimated_value.' . $i) }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-xs-12 col-md-12 loan_sect p-0">
                                            <div class="label-div question-area">
                                                <label class="form-label">Do you have a loan on this property?</label>
                                                <!-- Radio -->
                                                <div class="custom-radio-group form-group">
                                                    <input type="radio" required
                                                        name="property_vehicle[loan_own_type_property][{{ $i }}]"
                                                        {{ old('property_vehicle.loan_own_type_property.' . $i) === 0 ? 'checked' : '' }}
                                                        class="vehicle_loan_on_property form-check-input"
                                                        id="type_yes_vehicle_{{ $i }}" value="0"
                                                        onclick="vehicle_loan_show('{{ $i }}','yes')">
                                                    <label class="yes btn-toggle"
                                                        for="type_yes_vehicle_{{ $i }}">Yes</label>
                                                    <input type="radio" required
                                                        name="property_vehicle[loan_own_type_property][{{ $i }}]"
                                                        {{ old('property_vehicle.loan_own_type_property.' . $i) === 1 ? 'checked' : '' }}
                                                        class="vehicle_loan_on_property form-check-input"
                                                        id="type_no_vehicle_{{ $i }}" value="1"
                                                        onclick="vehicle_loan_show('{{ $i }}','no')">
                                                    <label class="no btn-toggle"
                                                        for="type_no_vehicle_{{ $i }}">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-7 col-xl-6 col-lg-6 col-sm-12 col-xs-12 col-md-0 "></div>

                                        <div
                                            class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 vehicle_loan_div_{{ $i }} vehicle_loan_section hide-data p-0">
                                            <div class="row gx-3">
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label class="">Monthly payment amount</label>
                                                            <div class="d-flex input-group">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input required type="text"
                                                                    class="custom_corner_input form-control price-field vehicle_car_loan_monthly_payment"
                                                                    placeholder="Monthly payment amount"
                                                                    name="property_vehicle[vehicle_car_loan][monthly_payment][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.vehicle_car_loan.monthly_payment.' . $i) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label class="">Past due payment</label>
                                                            <div class="d-flex input-group">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input required type="text"
                                                                    class="custom_corner_input form-control price-field vehicle_car_loan_past_due_amount"
                                                                    placeholder="Past due payment"
                                                                    name="property_vehicle[vehicle_car_loan][past_due_amount][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.vehicle_car_loan.past_due_amount.' . $i) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 ">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label class="">Estimated Amount Owed</label>
                                                            <div class="d-flex input-group">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input required type="text"
                                                                    class="custom_corner_input form-control price-field vehicle_car_loan_amount_own"
                                                                    placeholder="Amount Owed"
                                                                    name="property_vehicle[vehicle_car_loan][amount_own][{{ $i }}]"
                                                                    value="{{ old('property_vehicle.vehicle_car_loan.amount_own.' . $i) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-xxl-3 col-xl-3 col-lg-0 col-sm-0 col-xs-0 col-md-0 px-0">
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label>Creditor Name</label>
                                                            <input type="text"
                                                                class="input_capitalize form-control vehicle_creditor_name required"
                                                                name="property_vehicle[vehicle_car_loan][creditor_name][{{ $i }}]"
                                                                placeholder="Name of person"
                                                                value="{{ old('property_vehicle.vehicle_car_loan.creditor_name.' . $i) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label>Street Address</label>
                                                            <input type="text"
                                                                class="form-control vehicle_creditor_name_addresss "
                                                                name="property_vehicle[vehicle_car_loan][creditor_name_addresss][{{ $i }}]"
                                                                placeholder="Street address of person"
                                                                value="{{ old('property_vehicle.vehicle_car_loan.creditor_name_addresss.' . $i) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-4">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <input type="text"
                                                                class="form-control vehicle_creditor_city "
                                                                name="property_vehicle[vehicle_car_loan][creditor_city][{{ $i }}]"
                                                                placeholder="City"
                                                                value="{{ old('property_vehicle.vehicle_car_loan.creditor_city.' . $i) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-5">
                                                    <div class="label-div">
                                                        <label>State</label>
                                                        <div class="form-group">
                                                            <select class="form-control vehicle_creditor_state "
                                                                name="property_vehicle[vehicle_car_loan][creditor_state][{{ $i }}]">
                                                                <option value="">Please Select State</option>
                                                                {!! AddressHelper::getStatesList(old('property_vehicle.vehicle_car_loan.creditor_state.' . $i)) !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 col-xs-12 col-md-3">
                                                    <div class="label-div">
                                                        <label>Zip code</label>
                                                        <div class="form-group">
                                                            <input type="text"
                                                                class="form-control allow-5digit vehicle_creditor_zip "
                                                                name="property_vehicle[vehicle_car_loan][creditor_zip][{{ $i }}]"
                                                                placeholder="Zip code"
                                                                value="{{ old('property_vehicle.vehicle_car_loan.creditor_zip.' . $i) }}">
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
                    <div class="col-12 mb-2 pb-2 p-0 own_vehicle hide-data">
                        <button
                            class="shadow-2 rounded-0 w-auto float_left label save-btn mx-ht im-action  btn-new-ui-default m-0 px-5 py-2"
                            id="add-more-btn" onclick="addMoreVehicleFn();return false;"><i
                                class="feather icon-plus mr-0"></i> Add More
                        </button>

                        <button type="button" class="delete-div trash-btn mt-4 hide-data own_vehicle "
                            title="Delete" onclick="remove_clone_box('single-vehicle-form')">
                            <i
                                class="bi bi-trash3 mr-1 remove-btn  cursor-pointer float_right remove_clone"></i>Delete</button>
                    </div>
                </div>
                <!-- ///////////////////////////////////////////new inputs not in db yet -->
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0 mt-0">
                    <h4 class="mb-0 w-auto">Other Secured Loans:</h4>
                </div>

                <div class="light-gray-div mt-2">
                    <div class="details-banner p-3 mb-2 text-start">
                        Example: A Secured Debt, is when you take out a loan on a specific item that can be taken back
                        if you default on payments like a car, boat, or house. List all items that you have as secure
                        debt(s).
                    </div>
                    <div class="label-div question-area ">
                        <label class=" form-label">Do you have any additional liens or loans secured against any real
                            or
                            personal property not already listed?</label>
                        <!-- Radio -->
                        <div class="custom-radio-group form-group">
                            <input type="radio" required name="additional_liens"
                                {{ old('additional_liens') === 1 ? 'checked' : '' }} class="form-check-input"
                                id="additional_liens_yes" value="1">
                            <label for="additional_liens_yes" class="btn-toggle">Yes</label>
                            <input type="radio" required name="additional_liens"
                                {{ old('additional_liens') === 0 ? 'checked' : '' }} class="form-check-input"
                                id="additional_liens_no" value="0">
                            <label for="additional_liens_no" class="btn-toggle">No</label>
                        </div>
                    </div>
                    @for ($i = 0; $i < 4; $i++)
                        @php
                            $hideClass = 'hide-data';
                            if ($i == 0) {
                                $hideClass = '';
                            }
                        @endphp
                        <div class=" additional_liens_section hide-data p-0">
                            <div class="row gx-3 additional_section_{{ $i }} {{ $hideClass }} m-0">
                                <div class="light-gray-div mt-2">
                                    <h2>Secured Loan {{ $i + 1 }}:</h2>
                                    <div class="row gx-3">
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                            <div class="label-div">
                                                <div class="form-group">
                                                    <label>Creditor Name</label>
                                                    <input type="text" autocomplete="off" autocomplete
                                                        class="input_capitalize form-control autocomplete secured_loans_name al_domestic_support_name required"
                                                        name="additional_liens_data[domestic_support_name][{{ $i }}]"
                                                        placeholder="Name of person" data-mcreditor="1"
                                                        value="{{ old('additional_liens_data.domestic_support_name.' . $i) }}">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                            <div class="label-div">
                                                <div class="form-group">
                                                    <label>Street Address</label>
                                                    <input type="text"
                                                        class="form-control domestic_support_address "
                                                        name="additional_liens_data[domestic_support_address][{{ $i }}]"
                                                        placeholder="Street address of person"
                                                        value="{{ old('additional_liens_data.domestic_support_address.' . $i) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-4">
                                            <div class="label-div">
                                                <div class="form-group">
                                                    <label>City</label>
                                                    <input type="text"
                                                        class="form-control domestic_support_city "
                                                        name="additional_liens_data[domestic_support_city][{{ $i }}]"
                                                        placeholder="City"
                                                        value="{{ old('additional_liens_data.domestic_support_city.' . $i) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-2 col-xl-2 col-lg-4 col-sm-12 col-xs-12 col-md-5 ">
                                            <div class="label-div">
                                                <div class="form-group">
                                                    <label>State</label>
                                                    <select class="form-control creditor_state "
                                                        name="additional_liens_data[creditor_state][{{ $i }}]">
                                                        <option value="">Please Select State</option>
                                                        {!! AddressHelper::getStatesList(old('additional_liens_data.creditor_state.' . $i)) !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-2 col-xl-2 col-lg-2 col-sm-12 col-xs-12 col-md-3">
                                            <div class="label-div">
                                                <div class="form-group">
                                                    <label>Zip code</label>
                                                    <input type="text"
                                                        class="form-control allow-5digit domestic_support_zipcode "
                                                        name="additional_liens_data[domestic_support_zipcode][{{ $i }}]"
                                                        placeholder="Zip code"
                                                        value="{{ old('additional_liens_data.domestic_support_zipcode.' . $i) }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xxl-5 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                            <div class="label-div">
                                                <label for="secured_loans_1">Property Description:</label>
                                                <textarea placeholder="Property Description"
                                                    name="additional_liens_data[describe_secure_claim][{{ $i }}]" rows="3" id="secured_loans_1"
                                                    class="form-textarea describe_secure_claim required form-control">{{ old('additional_liens_data.describe_secure_claim.' . $i) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-7 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12">
                                            <div class="row">
                                                <div class="col-xxl-4 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label class="">Monthly Payment Amount</label>
                                                            <div class="d-flex input-group ">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input type="text" required
                                                                    class="custom_corner_input form-control price-field monthly_payment "
                                                                    placeholder="Monthly Payment Amount"
                                                                    name="additional_liens_data[monthly_payment][{{ $i }}]"
                                                                    value="{{ old('additional_liens_data.monthly_payment.' . $i) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-xxl-4 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 ">
                                                    <div class="label-div">
                                                        <div class="form-group">
                                                            <label class="">Amount due</label>
                                                            <div class="d-flex input-group ">
                                                                <span
                                                                    class="custom_corner_span h-26px br-0 input-group-text"
                                                                    id="basic-addon1">$</span>
                                                                <input type="text" required
                                                                    class="custom_corner_input form-control price-field additional_liens_due "
                                                                    placeholder="Amount due"
                                                                    name="additional_liens_data[additional_liens_due][{{ $i }}]"
                                                                    value="{{ old('additional_liens_data.additional_liens_due.' . $i) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div
                                                    class="col-xxl-4 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 ">
                                                    <div class="label-div">
                                                        <div class="form-group ">
                                                            <label>Date: (MM/YYYY)</label>
                                                            <input type="text"
                                                                name="additional_liens_data[additional_liens_date][{{ $i }}]"
                                                                class="form-control date_filed_mm_yyyy additional_liens_date "
                                                                placeholder="MM/YYYY"
                                                                value="{{ old('additional_liens_data.additional_liens_date.' . $i) }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 additional_liens_section hide-data  p-0 ">
                            <div
                                class="{{ $hideClass }} additional_section_{{ $i }}   additional_addmore_section_{{ $i }} mb-3 mt-1">
                                <a onclick="addMoreDebtSection({{ $i }});"
                                    class="btn btn-primary shadow-2 rounded-0 w-auto float_left label mx-ht im-action save-btn btn-new-ui-default mx-0 my-1 px-5 py-2"
                                    id=""><i class="feather icon-plus mr-0"></i> Add More </a>

                                <button type="button"
                                    class="delete-div trash-btn mt-4 {{ $i == 0 ? 'hide-data' : '' }} "
                                    title="Delete" onclick="removeDebtSection({{ $i }});">
                                    <i
                                        class="bi bi-trash3 mr-1 remove-btn {{ $i == 0 ? 'hide-data' : '' }}  cursor-pointer float_right remove_clone"></i>Delete</button>

                            </div>
                        </div>
                    @endfor
                </div>

                <h4 class="mb-0 p-0">Back taxes owed</h4>
                <div class="light-gray-div mt-2">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0 mt-2">
                    </div>
                    <!-- ///////////////////////////////////////////new inputs not in db yet -->
                    <div class="col-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div question-area ">
                            <label class="form-label">Have you filed all of your Federal & State Tax Returns over the
                                last 5 years</label>
                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="last_5_year_taxes" class="form-check-input"
                                    {{ old('last_5_year_taxes') === 1 ? 'checked' : '' }} id="last_5_year_taxes_yes"
                                    value="1">
                                <label for="last_5_year_taxes_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="last_5_year_taxes" class="form-check-input"
                                    {{ old('last_5_year_taxes') === 0 ? 'checked' : '' }} id="last_5_year_taxes_no"
                                    value="0">
                                <label for="last_5_year_taxes_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="light-gray-div mt-2">
                        <h2 class="">IRS</h2>
                        <div class="p-0">
                            <div class="label-div question-area ">
                                <label class="form-label">Do you owe any back taxes to the <i
                                        class="text-c-blue">IRS?</i></label>
                                <!-- Radio -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" required name="tax_owned_irs" class="form-check-input"
                                        {{ old('tax_owned_irs') === 1 ? 'checked' : '' }} id="tax-owned-irs_yes"
                                        value="1">
                                    <label for="tax-owned-irs_yes" class="btn-toggle">Yes</label>
                                    <input type="radio" required name="tax_owned_irs" class="form-check-input"
                                        {{ old('tax_owned_irs') === 0 ? 'checked' : '' }} id="tax-owned-irs_no"
                                        value="0">
                                    <label for="tax-owned-irs_no" class="btn-toggle">No</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div
                                class="col-xxl-6 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 irs_section hide-data">
                                <div class="label-div question-area border-0 mb-0">
                                    <div class="form-group ">
                                        <label class="">Input which year(s)</label>
                                        <input type="text" required name="taxes_internal_revenue_year"
                                            class="form-control " placeholder="Input which year(s)"
                                            value="{{ old('taxes_internal_revenue_year') }}">
                                    </div>
                                </div>
                            </div>
                            <div
                                class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 irs_section hide-data">
                                <div class="label-div question-area border-0 mb-0">
                                    <div class="form-group">
                                        <label class="">Estimated Amount Due</label>
                                        <div class="d-flex input-group mb-0">
                                            <span class="custom_corner_span h-26px br-0 input-group-text"
                                                id="basic-addon1">$</span>
                                            <input type="text" required
                                                class="custom_corner_input form-control price-field"
                                                placeholder="Estimated Amount Due" name="taxes_irs_taxes_due"
                                                value="{{ old('taxes_irs_taxes_due') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="light-gray-div mt-2">
                        <h2 class="">State Back Taxes</h2>
                        <div class="">
                            <div class="label-div question-area ">
                                <label class="form-label">Do you owe any back taxes owed to the <i
                                        class="text-c-blue">State?</i></label>
                                <!-- Radio -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" required name="back_taxes_owed" class="form-check-input"
                                        {{ old('back_taxes_owed') === 1 ? 'checked' : '' }} id="back_taxes_owed_yes"
                                        value="1">
                                    <label for="back_taxes_owed_yes" class="btn-toggle">Yes</label>
                                    <input type="radio" required name="back_taxes_owed" class="form-check-input"
                                        {{ old('back_taxes_owed') === 0 ? 'checked' : '' }} id="back_taxes_owed_no"
                                        value="0">
                                    <label for="back_taxes_owed_no" class="btn-toggle">No</label>
                                </div>
                            </div>
                            <div class="row back_taxes_owed_section hide-data">
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                    <div class="label-div question-area border-0 ">
                                        <div class="form-group">
                                            <label>State</label>
                                            <select class="form-control  h-36px" required onchange=""
                                                name="taxes_tax_state">
                                                <option value="">Please Select State</option>
                                                {!! AddressHelper::getStatesList(old('taxes_tax_state')) !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                    <div class="label-div question-area border-0 ">
                                        <div class="form-group ">
                                            <label class="">Input which year(s)</label>
                                            <input required type="text" name="taxes_franchise_tax_board"
                                                class="form-control" placeholder="Input which year(s)"
                                                value="{{ old('taxes_franchise_tax_board') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                    <div class="label-div question-area border-0 ">
                                        <div class="form-group ">
                                            <label class="">Estimated Amount Due</label>
                                            <div class="d-flex input-group mb-0 ">
                                                <span class="custom_corner_span h-26px br-0 input-group-text"
                                                    id="basic-addon1">$</span>
                                                <input required type="text"
                                                    class="custom_corner_input form-control price-field"
                                                    placeholder="Estimated Amount Due" name="taxes_state_tax_due"
                                                    value="{{ old('taxes_state_tax_due') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xs-12 col-md-12 p-0">
                                <div class="label-div question-area ">
                                    <label class=" form-label">Do you owe Child Support/Alimony?</label>
                                    <!-- Radio -->
                                    <div class="custom-radio-group form-group">
                                        <input type="radio" required name="child_supp_or_alimony"
                                            class="form-check-input"
                                            {{ old('child_supp_or_alimony') === 0 ? 'checked' : '' }}
                                            id="child_supp_or_alimony_yes" value="0">
                                        <label for="child_supp_or_alimony_yes" class="btn-toggle">Yes</label>
                                        <input type="radio" required name="child_supp_or_alimony"
                                            class="form-check-input"
                                            {{ old('child_supp_or_alimony') === 1 ? 'checked' : '' }}
                                            id="child_supp_or_alimony_no" value="1">
                                        <label for="child_supp_or_alimony_no" class="btn-toggle">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row child_supp_or_alimony_section hide-data">
                                <div class="col-xxl-3 col-lg-4 col-sm-12 col-12 col-md-6">
                                    <div class="label-div question-area border-0 ">
                                        <div class="form-group">
                                            <label> Select state: </label>
                                            <select class="form-control max-w-280px h-36px" required onchange=""
                                                name="taxes_child_support_state">
                                                <option value="">Please Select State</option>
                                                {!! AddressHelper::getStatesList(old('taxes_child_support_state')) !!}
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-md-6 ">
                                    <div class="label-div question-area border-0 w-280px">
                                        <div class="form-group ">
                                            <label class="">Your Monthly Payment Amount</label>
                                            <div class="d-flex input-group max-w-280px mb-0">
                                                <span class="custom_corner_span h-26px br-0 input-group-text"
                                                    id="basic-addon1">$</span>
                                                <input required type="text"
                                                    class="custom_corner_input form-control price-field"
                                                    placeholder="Enter Your Monthly Payment Amount"
                                                    name="taxes_child_support_due"
                                                    value="{{ old('taxes_child_support_due') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="label-div question-area">
                                <label class="form-label">Are you current on your support obiligation(s)?</label>
                                <!-- Radio -->
                                <div class="custom-radio-group form-group">
                                    <input type="radio" required name="current_on_your_support_obligation"
                                        class="form-check-input"
                                        {{ old('current_on_your_support_obligation') === 0 ? 'checked' : '' }}
                                        id="current_on_your_support_obligation_yes" value="0">
                                    <label for="current_on_your_support_obligation_yes"
                                        class="btn-toggle">Yes</label>
                                    <input type="radio" required name="current_on_your_support_obligation"
                                        class="form-check-input"
                                        {{ old('current_on_your_support_obligation') === 1 ? 'checked' : '' }}
                                        id="current_on_your_support_obligation_no" value="1">
                                    <label for="current_on_your_support_obligation_no" class="btn-toggle">No</label>
                                </div>
                            </div>
                            <div class="row align-items-start child_supp_or_alimony_section hide-data">
                                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6">
                                    <div
                                        class="form-group current_on_your_support_obligation_section hide-data w-100">
                                        <div class="label-div question-area border-0 w-100">
                                            <label class="">Your Past Due Amount</label>
                                            <div class="input-group">
                                                <span class="custom_corner_span h-26px br-0 input-group-text"
                                                    id="basic-addon1">$</span>
                                                <input required type="text"
                                                    class="custom_corner_input form-control price-field"
                                                    placeholder="Your Past Due Amount" name="taxes_alimony_due"
                                                    value="{{ old('taxes_alimony_due') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                    <h4>Other Debts</h4>
                    <label class="mt-2">Please give us your best estimate of other debts that you owe.</label>
                </div>
                <div class="light-gray-div mt-2">
                    <div class="row gx-3">
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_credit_card_debt') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Total Credit Card Debt</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Total Credit Card Debt" name="credit_crd_debt"
                                            value="{{ old('credit_crd_debt') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_medical_debt') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Total Medical Debt</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Total Medical Debt" name="medical_debt"
                                            value="{{ old('medical_debt') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_student_loans') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Total Student Debt</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Total Student Debt" name="student_loans"
                                            value="{{ old('student_loans') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_law_suit_judgement') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Lawsuit / Judgement</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Lawsuit / Judgement" name="law_suit"
                                            value="{{ old('law_suit') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_personal_loans') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Total Personal Loans</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Total Personal Loans" name="personal_loans"
                                            value="{{ old('personal_loans') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_credit_union_loans') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Total Credit Union Loans</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Total Credit Union Loans"
                                            name="credit_union_loans" value="{{ old('credit_union_loans') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_loans_from_family') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Total Loans From Family</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Total Loans From Family" name="family_loans"
                                            value="{{ old('family_loans') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ///////////////////////////////////////////new inputs not in db yet -->
                        <div
                            class="col-xxl-3 col-xl-3 col-lg-4 col-sm-12 col-xs-12 col-md-6  {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_misc_loans') }}">
                            <div class="label-div">
                                <div class="form-group">
                                    <label class="">Estimated Other types of Debts</label>
                                    <div class="d-flex input-group">
                                        <span class="custom_corner_span h-26px br-0 input-group-text"
                                            id="basic-addon1">$</span>
                                        <input required type="text"
                                            class="custom_corner_input form-control price-field"
                                            placeholder="Estimated Other types of Debts" name="misc_loans"
                                            value="{{ old('misc_loans') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div question-area ">
                            <label class="form-label">Have you made any major purchases or used credit cards for
                                purchases over the last 3 months?</label>
                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="made_purchases" class="form-check-input"
                                    {{ old('made_purchases') === 0 ? 'checked' : '' }} id="made_purchases_yes"
                                    value="0">
                                <label for="made_purchases_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="made_purchases" class="form-check-input"
                                    {{ old('made_purchases') === 1 ? 'checked' : '' }} id="made_purchases_no"
                                    value="1">
                                <label for="made_purchases_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div question-area ">
                            <label class="form-label">Do you bank at or with any bank you have credit cards with
                                also?</label>
                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="checking_account" class="form-check-input"
                                    id="checking_account_yes" {{ old('checking_account') === 0 ? 'checked' : '' }}
                                    value="0">
                                <label for="checking_account_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="checking_account" class="form-check-input"
                                    id="checking_account_no" {{ old('checking_account') === 1 ? 'checked' : '' }}
                                    value="1">
                                <label for="checking_account_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>
                    @if (!empty($questions))
                        @foreach ($questions as $index => $data)
                            <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                                <div class="label-div question-area ">
                                    <label class="form-label">{{ $data['question'] }}</label>
                                    <!-- Radio -->
                                    <div class="custom-radio-group form-group">
                                        <input type="radio" required
                                            name="concierge_question[{{ $data['id'] }}]"
                                            {{ old('concierge_question.' . $data['id']) === 0 ? 'checked' : '' }}
                                            class="form-check-input"
                                            id="concierge_question_yes[{{ $data['id'] }}]" value="0">
                                        <label for="concierge_question_yes[{{ $data['id'] }}]"
                                            class="btn-toggle">Yes</label>
                                        <input type="radio" required
                                            name="concierge_question[{{ $data['id'] }}]"
                                            {{ old('concierge_question.' . $data['id']) === 1 ? 'checked' : '' }}
                                            class="form-check-input"
                                            id="concierge_question_no[{{ $data['id'] }}]" value="1">
                                        <label for="concierge_question_no[{{ $data['id'] }}]"
                                            class="btn-toggle">No</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    <div class="col-12 col-md-12 p-0">
                        <div class="label-div question-area">
                            <!-- Radio  -->
                            <label class="form-label">Are you being sued?</label>
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="being_sued" class="form-check-input"
                                    id="being_sued_yes" {{ old('being_sued') === 0 ? 'checked' : '' }}
                                    value="0">
                                <label for="being_sued_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="being_sued" class="form-check-input"
                                    id="being_sued_no" {{ old('being_sued') === 1 ? 'checked' : '' }}
                                    value="1">
                                <label for="being_sued_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 p-0">
                        <div class="label-div question-area">
                            <label class="form-label">Are your wages currently being garnished?</label>
                            <!-- Radio -->
                            <div class="custom-radio-group form-group">
                                <input type="radio" required name="wages_being_garnished"
                                    class="form-check-input" id="wages_being_garnished_yes"
                                    {{ old('wages_being_garnished') === 0 ? 'checked' : '' }} value="0">
                                <label for="wages_being_garnished_yes" class="btn-toggle">Yes</label>
                                <input type="radio" required name="wages_being_garnished"
                                    class="form-check-input" id="wages_being_garnished_no"
                                    {{ old('wages_being_garnished') === 1 ? 'checked' : '' }} value="1">
                                <label for="wages_being_garnished_no" class="btn-toggle">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-sm-12 col-xs-12 col-md-12 p-0">
                        <div class="label-div">
                            <div class="form-group">
                                <label for="notes1" class="mb-1">Is there anything else you would like to share
                                    that
                                    would be useful for us to know for our appointment?</label>
                                <textarea placeholder="" name="extra_notes" rows="4" class="form-textarea form-control mt-2">{{ old('extra_notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12 p-0">
                    <div class="form-group">
                        <label style="font-weight:500;" class="">By checking the box below you're simply
                            agreeing to: "I
                            agree and consent to receiving text messages from the law firm and its
                            affiliates."</label><br>
                        <label class="mb-1 mt-2 form-label col-12 p-0"><strong>Term and Conditions</strong></label>
                        <div class="input-group d-block">
                            <input type="checkbox" id="msg_term" name="check_msg"
                                class="largerCheckbox required" value='1' />
                            <label style="font-weight:500;display:inline" for="msg_term">&nbsp;I agree to receive
                                promotional messages sent via an auto dailer, and this agreement
                                Isn't a condition of any purchase. I also agree with the Terms of Service and Privacy.
                                Policy 4 Msgs/Month. Msg & Data rates may apply.</label>
                        </div>
                    </div>

                </div>
                <div class="col-12 text-right mt-3">
                    <a href="javascript:void(0)"
                        class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                        onclick="validateEmail()">Submit</a>
                </div>
        </form>
    </div>
    </div>
    @include('components.common.success-modal', ['attorney_company' => $attorney_company ?? []])
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input');

            function updateActiveClass() {
                document.querySelectorAll('.btn-toggle').forEach(label => {
                    label.classList.remove('active');
                });

                radios.forEach(radio => {
                    if (radio.checked) {
                        const label = document.querySelector(`label[for="${radio.id}"]`);
                        if (label) {
                            label.classList.add('active');
                        }
                    }
                });
            }

            radios.forEach(radio => {
                radio.addEventListener('change', updateActiveClass);
            });

            updateActiveClass();

            const addMoreBtn = document.getElementById('add-more-btn');
            if (addMoreBtn) {
                addMoreBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const radios = document.querySelectorAll('input');

                    function updateActiveClass() {
                        document.querySelectorAll('.btn-toggle').forEach(label => {
                            label.classList.remove('active');
                        });

                        radios.forEach(radio => {
                            if (radio.checked) {
                                const label = document.querySelector(`label[for="${radio.id}"]`);
                                if (label) {
                                    label.classList.add('active');
                                }
                            }
                        });
                    }

                    radios.forEach(radio => {
                        radio.addEventListener('change', updateActiveClass);
                    });


                    updateActiveClass();
                });
            }
        });
    </script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                // Use global helper so this modal can be reused elsewhere without changing content
                if (typeof window.showSuccessModal === 'function') {
                    window.showSuccessModal();
                } else {
                    $('#successModal').modal('show');
                }
            });
        </script>
    @endif
    <script>
        function initFormValidation() {
            const $form = $("#one_page_questionnaire");

            if (!$form.data('validator')) {
                $form.validate({
                    ignore: ':hidden',
                    errorPlacement: function(error, element) {
                        const $formGroup = element.closest('.form-group');

                        if (element.attr("type") === "radio") {
                            // Highlight related .btn-toggle labels
                            $(`input[name="${element.attr('name')}"]`).each(function() {
                                $(`label[for="${this.id}"]`).addClass('error-radio');
                            });

                            // Place error label after the form group (as you wanted earlier)
                            if ($formGroup.next('label.error').length === 0) {
                                $formGroup.after(error);
                            }
                        } else {
                            $formGroup.append(error);
                        }
                    },

                    success: function(label, element) {
                        const $formGroup = $(element).closest('.form-group');

                        if ($(element).attr('type') === 'radio') {
                            $formGroup.next('label.error').remove();

                            // Remove .error from related .btn-toggle labels
                            $(`input[name="${$(element).attr('name')}"]`).each(function() {
                                $(`label[for="${this.id}"]`).removeClass('error-radio');
                            });
                        } else {
                            $formGroup.find('label.error').remove(); // remove inside form-group
                        }
                    },

                    highlight: function(element) {
                        const $el = $(element);
                        const $formGroup = $el.closest('.form-group');

                        if ($el.attr('type') === 'radio') {
                            $(`input[name="${$el.attr('name')}"]`).addClass('error');
                        } else {
                            $el.addClass('error');
                        }

                        $formGroup.addClass('has-error');
                    },

                    unhighlight: function(element) {
                        const $el = $(element);
                        const $formGroup = $el.closest('.form-group');

                        if ($el.attr('type') === 'radio') {
                            $(`input[name="${$el.attr('name')}"]`).removeClass('error');
                        } else {
                            $el.removeClass('error');
                        }

                        $formGroup.removeClass('has-error');
                    },

                    focusInvalid: true,

                    invalidHandler: function(form, validator) {
                        if (validator.numberOfInvalids()) {
                            const firstErrorElement = $(validator.errorList[0].element);
                            $('html, body').animate({
                                scrollTop: firstErrorElement.offset().top - 100
                            }, 500, function() {
                                firstErrorElement.focus();
                            });
                        }
                    }
                });
            }

            return $form.valid();
        }


        validateEmail = function() {

            if (!initFormValidation()) {
                return false;
            }

            showConfirmation("Are you sure you want to submit this form to your attorney?", function(confirmation) {
                if (confirmation) {
                    var client_email = $("#client_email").val();
                    var url = "{{ route('check_email') }}";
                    laws.ajax(url, {
                        email: client_email
                    }, function(response) {
                        var res = JSON.parse(response);
                        if (res.status == false) {
                            $.systemMessage(res.message, 'alert--danger', true);

                        } else {
                            $("#one_page_questionnaire").submit();
                        }
                    });
                }
            });

        }

        function showConfirmation(message, callback) {
            // Create custom modal HTML
            const modalHtml = `
            <div id="customConfirm" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;justify-content:center;align-items:center;">
                <div style="background:white;padding:20px;border-radius:5px;max-width:80%;">
                    <p>${message}</p>
                    <div style="display:flex;justify-content:space-around;margin-top:20px;">
                        <button id="confirmYes" class="btn-new-ui-default ms-auto me-2">Yes</button>
                        <button id="confirmNo" class="btn-new-ui-default me-auto ms-2">No</button>
                    </div>
                </div>
            </div>
        `;

            // Add to body
            $('body').append(modalHtml);

            // Handle clicks
            $('#confirmYes').on('click', function() {
                $('#customConfirm').remove();
                callback(true);
            });

            $('#confirmNo').on('click', function() {
                $('#customConfirm').remove();
                callback(false);
            });
        }

        $(document).on('input', ".allow-5digit", function(e) {
            var firstFive = this.value.substring(0, 5);
            var self = $(this);
            self.val(self.val().replace(/\D/g, ""));
            if ((e.which < 48 || e.which > 57)) {
                e.preventDefault();
            }
            if (this.value.length > 5) {
                this.value = firstFive;
            }
        });

        $(document).on('keyup', ".price-field", function(event) {
            var inputValue = $(this).val();
            var dotCount = inputValue.split('.').length - 1;
            if (dotCount >= 2) {
                if (inputValue.endsWith('.')) {
                    // Remove the last character (dot) from the input value
                    inputValue = inputValue.slice(0, -1);

                    // Update the input field with the modified value
                    $(this).val(inputValue);
                }
                return;
            }


            var kCd = event.keyCode || event.which;
            if (kCd == 0 || kCd == 229) { //for android chrome keycode fix
                kCd = getKeyCode(this.value);
            }
            charCode = kCd;
            console.log(charCode);
            if (event.target.value.length >= 15) {
                var firstseven = event.target.value.substring(0, 15);
                event.target.value = firstseven;
            }



            if (charCode == 9) {
                return;
            }
            if (charCode == 46 || (charCode >= 48 && charCode <= 57) || (charCode >= 96 && charCode <= 105) ||
                charCode == 188 || charCode == 190 || charCode == 37 || charCode == 39 || charCode == 8 ||
                charCode == 110) {
                $(this).val(function(index, value) {

                    value = value.replace(/,/g, '');
                    // Limit to two digits after the dot
                    var dotIndex = value.indexOf('.');
                    if (dotIndex !== -1 && value.length - dotIndex > 2) {
                        value = value.slice(0, dotIndex + 3);
                    }
                    //return value;
                    return numberWithCommas(value);
                });
            } else {
                event.target.value = '';
            }

        });

        function numberWithCommas(x) {
            var parts = x.toString().split(".");
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return parts.join(".");
        }
        var getKeyCode = function(str) {
            return str.charCodeAt(str.length - 1);
        }
    </script>
    <style>
        button.p-inherit {
            position: inherit !important;
        }

        .light-gray-div.emergency-assesment {
            border-color: #dc3545 !important;
        }

        .light-gray-div.emergency-assesment h2 {
            color: #dc3545 !important;
        }

        .btn-submit-success {
            background: linear-gradient(135deg, #16a34a 0%, #22c55e 100%);
            border: none;
            color: white;
            padding: 4px 20px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            transition: all 0.3s ease;
            letter-spacing: 1px;
        }

        .btn-submit-success:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(34, 197, 94, 0.35);
            color: white;
        }

        /* Blinking animation */
        @keyframes btn-blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .blink {
            animation: btn-blink 1.2s infinite;
        }

        .custom-radio-group.multiple-radio-input label {
            padding: 9px 18px !important;
        }

        label.error {
            font-size: 12px !important;
        }

        label.btn-toggle.error-radio {
            border: 1px dotted #dc3545 !important;
            color: #dc3545 !important;
            font-style: inherit;
            background: #fff5f6 !important;
        }

        .form-group.has-error {
            display: block;
        }

        .custom-radio-group.form-group.has-error {
            display: flex;
        }

        .delete-div.trash-btn:hover {
            background-color: red;
            color: var(--bs-white);
        }


        @media (min-width: 576px) {
            .w-500px {
                width: 500px;
            }
        }

        .fs-12px {
            font-size: 12px;
        }


        .div-timer {
            display: flex;
            align-items: center;
            gap: 12px;
            font-family: 'Segoe UI', sans-serif;
        }

        .div-timer .timer-label {
            font-size: 0.95rem;
            font-weight: 600;
            color: #333;
        }

        .timer-box {
            display: flex;
            gap: 10px;
        }

        .timer-box div {
            background: #eef2ff;
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            text-align: center;
            min-width: 50px;
        }

        .timer-box span {
            font-size: 1.2rem;
            color: #0033a0;
            font-weight: bold;
        }

        .timer-box label {
            font-size: 0.7rem;
            color: #666;
            opacity: 0.85;
        }


        .h-36px {
            height: 36px !important;
        }

        .w-280px {
            width: 280px;
        }

        .max-w-280px {
            max-width: 280px;
        }

        .mb-0.input-group {
            margin-bottom: 0px !important;
        }

        .sub-div {
            position: absolute;
            font-size: 16px;
            color: var(--bs-secondary);
            line-height: 1;
            padding: 0 10px;
            background-color: var(--bs-white);
            top: -10px;
        }

        .ml-90px {
            margin-left: 90px;
        }

        .w-150px {
            width: 150px;
        }

        .label-div .custom-radio-group input[type="radio"] {
            /* position: static !important; */
            display: block !important;
        }

        .w-fit-content {
            width: fit-content;
        }

        .questionnaire {
            background-color: #fff;
        }

        h2 {
            font-weight: 400;
        }

        .btn-new-ui-default {
            /* padding: 0.25rem 0.5rem !important; */
            background-color: transparent !important;
            color: var(--bs-primary) !important;
            border: solid 1px var(--bs-primary) !important;
            font-size: 14px !important;
            outline: none !important;
            line-height: 1 !important;
            padding: 10px 25px !important;
            box-shadow: none !important;
            border-radius: 8px !important;
            outline: none !important;
            box-shadow: none !important;
        }

        .btn-new-ui-default:hover {
            background-color: var(--bs-primary) !important;
            color: #fff !important;
            border: solid 1px var(--bs-primary) !important;
            border: 0;
        }


        .ml-auto {
            margin-left: auto;
        }

        .form-group.radio_btn {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            flex-wrap: wrap !important;
        }

        .form-group.radio_btn .form-label {
            margin: 0;
            flex: 1;
            word-wrap: break-word;
        }

        .form-check-inline {
            margin-left: 10px;
        }

        .radio-buttons {
            display: flex;
            align-items: center;
        }

        @media (min-width: 425px) {
            .max-w-250px {
                max-width: 250px;
            }
        }

        @media (min-width: 1400px) {
            .col-xxl-0 {
                flex: 0 0 auto !important;
                width: 0% !important;
            }
        }

        @media screen and (max-width:1400px) {
            .col-xl-0 {
                flex: 0 0 auto !important;
                width: 0% !important;
            }
        }

        @media screen and (max-width:1200px) {
            .col-lg-0 {
                flex: 0 0 auto !important;
                width: 0% !important;
            }
        }

        @media screen and (max-width:992px) {
            .col-md-0 {
                flex: 0 0 auto !important;
                width: 0% !important;
            }
        }

        @media screen and (max-width:768px) {
            .col-sm-0 {
                flex: 0 0 auto !important;
                width: 0% !important;
            }
        }

        .p-0 {
            padding: 0 !important;
        }

        .m-0 {
            margin: 0 !important;
        }

        .timer-card {
            padding: 7px;
            background-color: gray;
            border-radius: 0.25rem;
            color: #fff;
        }

        .time-text {
            /* width: 100%; */
            font-size: 18px;
            font-weight: bold;
        }

        .time-label {
            /* width: 100%; */
            font-size: 16px;
            /* font-weight: bold; */
        }

        .timer-card label {
            line-height: normal;
        }

        .float-r {
            float: right;
        }

        .bg_grey {
            background: #f4f6fa;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        .input-group-text {
            padding: 0.375rem 0.85rem;
            border: 1px solid #ced4da;
            background-color: transparent;
        }

        .ml-input-label {
            margin-left: 2.5rem !important;
        }

        .text-c-blue {
            color: #012cae;
        }

        .system_message,
        .alert.alert--positioned {
            position: fixed;
            width: auto;
            margin: 0;
            -webkit-box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.07);
            box-shadow: 0 0 10px 5px rgba(0, 0, 0, 0.07);
            z-index: 9999;
            right: 20px;
            top: 50px;
            color: white;
        }

        .alert--success,
        .alert_success {
            background: url(../images/icon--success.svg) no-repeat 15px 14px #012cae;
            background-size: 30px;
            padding: 20px 40px 20px 60px !important;
        }

        .alert--danger,
        .alert_danger,
        .kyc-reject-alert {
            background: url(../images/icon--attention.svg) no-repeat 15px 14px #f35f5f;
            background-size: 30px;
            padding: 20px 40px 20px 60px !important;
        }

        .questionnaire-logo img {
            height: 100px !important;
        }

        .alert--process,
        .alert_process {
            background: rgba(0, 0, 0, 0.9);
            padding: 20px 40px 20px 60px !important;
        }

        @media (max-width: 2560px) {}

        @media (max-width: 1440px) {

            .timer-text {
                font-size: 15px
            }
        }

        @media(max-width:767px) {

            .system_message,
            .alert.alert--positioned {
                left: 10px;
                right: 10px;
                top: 10px;
            }

            .float-r {
                float: none;
            }

            .txt-start {
                text-align: left !important;
            }

        }

        /* .form-group {
        display: block !important;
    } */

        .text-c-red {
            color: red;
        }

        .hide-data {
            display: none !important
        }

        input.largerCheckbox {
            transform: scale(1.3);
        }

        select {
            appearance: auto !important;
            padding: 0.525rem 0.75rem !important;
        }

        p {
            margin-bottom: 0.5rem;
        }

        .custom_corner_span {
            border-top-left-radius: 0.25rem;
            border-bottom-left-radius: 0.25rem;
        }

        .custom_corner_input {
            border-top-left-radius: 0rem !important;
            border-bottom-left-radius: 0rem !important;
        }

        .cursor-pointer {
            cursor: pointer;
        }

        .text-bold {
            font-weight: bold;
        }

        .br-0 {
            border-right: 0px;
        }

        .bb-2 {
            border-bottom: 2px solid #989898;
            padding: 9px;
        }

        .ml-1 {
            margin-left: 0.25rem !important;
        }

        .ml-2 {
            margin-left: 0.5rem !important;
        }

        .mr-1 {
            margin-right: 0.25rem !important;
        }

        .mr-2 {
            margin-right: 0.5rem !important;
        }

        .mr-3 {
            margin-right: 0.75rem !important;
        }

        .mr-4 {
            margin-right: 1.5rem !important;
        }

        .pr-0 {
            padding-right: 0rem !important;
        }

        label.error {
            color: red;
            font-size: 10px;
            font-weight: bold;
        }

        .form-group {
            display: -ms-flexbox;
            display: flex;
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            -ms-flex-flow: row wrap;
            flex-flow: row wrap;
            -ms-flex-align: center;
            align-items: center;
            margin-bottom: 0
        }

        iframe {
            border: none;
        }

        .pl-0 {
            padding-left: 0px;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .ml-0 {
            margin-left: 0px;
        }

        .ml-0-imp {
            margin-left: 0px !important;
        }

        .w-auto {
            width: auto !important;
            display: inline;
        }

        .ml-3 {
            margin-left: 0.75rem !important;
        }

        .ml-4 {
            margin-left: 1.5rem !important;
        }

        .ml-5 {
            margin-left: 2rem !important;
        }

        .d-block {
            display: block !important
        }

        .contact_btn a.theme_btn {
            min-width: auto !important;
            line-height: 45px;
            font-size: 14px;
            letter-spacing: 3px;
            font-weight: 700;
            text-transform: uppercase;
            background: transparent;
            color: #fff;
            border: 2px solid #ffffff;
            padding: 0 10px;
        }

        .contact_btn ul {
            list-style: none;
        }

        a.contact_us_btn p {
            margin-bottom: 0;
            font-size: 18px;
            color: #fff;
            font-weight: 700;
        }

        a.contact_us_btn span {
            font-size: 15px;
            color: #fff;
            font-weight: 500;
            opacity: .7;
        }

        .h-41px {
            height: 41px !important;
        }

        .h-44px {
            height: 44px !important;
        }

        .h-64px {
            height: 64px !important;
        }

        .h-88px {
            height: 88px !important;
        }

        .h-110px {
            height: 110px !important;
        }

        .text-blue {
            color: #012cae;
        }

        .pcoded-content input,
        .pcoded-content textarea,
        .pcoded-content input[type='checkbox'],
        .pcoded-content select {
            background: #fff;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: .375rem .75rem;
            /* line-height: 1.5; */
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
            padding: .59rem .0rem;
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
            font-size: 13.5px;
            width: auto;
            height: 20.8px;
            padding: 0px 8px 0px 8px;
            margin: 0px 8px 0px 8px;
            background: white;
            transition: 0.2s ease-in-out;
            top: -3px !important;
            left: 18px;
        }

        .form-floating>.form-control,
        .form-floating>.form-select {
            height: 44px;
        }

        .form-floating>.form-control {
            padding: 9px 12px !important;
        }

        .form-floating>.form-textarea {
            height: unset !important;
            resize: none;
            /* overflow: hidden; */
            min-height: 44px;
            line-height: 1.5;
        }

        input::placeholder {
            font-size: .75rem;
        }

        .radio_btn {
            padding: 9px 12px !important;
            color: #212529;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            height: 44px;
        }

        .mt-4-rs-based {
            margin-top: 1.5rem;
        }

        .custom-label-on-mobile {
            display: none;
        }

        .custom-label-on-desktop {
            display: block;
        }

        .desktop-ml-2 {
            margin-left: 0.5rem;
        }

        .d-inherit {
            display: inherit;
        }

        @media screen and (max-width:992px) {

            .mt-4-rs-based {
                margin-top: 0rem;
            }

            /* .form-floating > label.hide-on-mobile{
            left: -2px !important;
            font-size:10px;
            top: -26px !important;
        }
        .form-floating > .form-control:not(:placeholder-shown) ~ label.hide-on-mobile,.form-floating > .form-control:focus ~ label.hide-on-mobile{
            font-size:8.5px;
        } */
            .custom-label-on-mobile {
                display: block;
            }

            .custom-label-on-desktop {
                display: none;
            }
        }

        .custom-input-label-on-mobile {
            display: none;
        }

        .custom-input-label-on-desktop {
            display: block;
        }

        .custom-input-sub-label-on-desktop {
            margin-left: 2rem;
        }

        .mt-4-mobile-off {
            margin-top: 1.5rem;
        }

        .t-minus-3 {
            top: -3px !important;
        }

        .form-floating>.form-control:focus~.t-minus-3,
        .form-floating>.form-control:not(:placeholder-shown)~.t-minus-3,
        .form-floating>.form-select~.t-minus-3 {
            top: -15px !important;
        }

        @media screen and (max-width:768px) {
            .custom-input-label-on-mobile {
                display: block;
            }

            .custom-input-label-on-desktop {
                display: none;
            }

            .mt-4-mobile-off {
                margin-top: 0rem;
            }

            .mt-3-mobile-on {
                margin-top: 1rem;
            }

            .timer-card {
                padding: 5px;

            }

            .time-text {
                font-size: 16px;
            }

            .time-label {
                font-size: 13px;
            }
        }

        @media screen and (max-width:630px) {
            .mt-4-630 {
                margin-top: 1.5rem;
            }
        }

        @media screen and (max-width:576px) {
            .light-gray-div .label-div .form-control {
                height: 36px !important;
            }

            .custom-input-sub-label-on-desktop {
                margin-left: 0rem;
            }

            .questionnaire-logo img {
                padding: 6px;
                height: 70px !important;
                margin-left: 14px;
            }

            .float-right {
                float: right;
            }

            .radio_btn {
                padding: 9px 12px !important;
                color: #212529;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid #ced4da;
                border-radius: 0.25rem;
                height: 88px;
            }

            .h-44px {
                height: 44px !important;
            }

            .h-66px {
                height: 66px !important;
            }

            .h-77px {
                height: 77px !important;
            }

            .pt-4-mobile {
                padding-top: 1.5rem !important;
            }

            .txt-start {
                text-align: unset !important;
            }

            .mt_sm_2 {
                margin-top: 0.75rem;
            }
        }

        .custom_add_liens_height {
            height: auto;
        }

        @media screen and (max-width: 1024px) and (min-width: 768px) {
            .custom_add_liens_height {
                height: 88px;
            }

            .questionnaire-logo img {
                padding: 6px;
                height: 100px !important;
                margin-left: 14px;
            }

        }
    </style>



    <script type="text/javascript" src="assets/js/slick.min.js"></script>
    <script>
        $(document).on("input", ".is_ssn", function(evt) {

            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            self.val(self.val().replace(/(\d{3})\-?(\d{2})\-?(\d{4})/, '$1-$2-$3'));
            var first10 = $(this).val().substring(0, 11);
            if (this.value.length > 11) {
                this.value = first10;
            }

        });

        function checkYear(str, max) {
            if (str.charAt(0) !== '0' || str == '00') {
                var num = parseInt(str);
                if (isNaN(num) || num <= 0 || num > max) num = CurrentYear;
                str = num > parseInt(max.toString().charAt(0)) && num.toString().length == CurrentYear ? '0' + num : num
                    .toString();
            };
            return str;
        };

        function checkValue(str, max) {
            if (str.charAt(0) !== '0' || str == '00') {
                var num = parseInt(str);
                if (isNaN(num) || num <= 0 || num > max) num = 1;
                str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num.toString();
            };
            return str;
        };

        $(document).ready(function() {

            $(document).on("blur", '.input_capitalize', function() {
                let value = $(this).val();
                let capitalizedValue = value.replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
                $(this).val(capitalizedValue);
            });

            // timer js
            // Set the target time 2 hours from now
            var targetTime = new Date().getTime() + (2 * 60 * 60 * 1000);

            // Update the timer every second
            var timerInterval = setInterval(function() {
                // Get the current time
                var currentTime = new Date().getTime();

                // Calculate the remaining time
                var remainingTime = targetTime - currentTime;

                // Check if the timer has reached 0
                if (remainingTime <= 0) {
                    clearInterval(timerInterval);
                    $('.hours').text('00');
                    $('.minutes').text('00');
                    $('.seconds').text('00');
                    // You can perform any action here when the timer reaches 0
                } else {
                    // Convert remaining time to hours, minutes, and seconds
                    var hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);


                    var finalhours = ('0' + hours).slice(-2)
                    var finalminutes = ('0' + minutes).slice(-2)
                    var finalseconds = ('0' + seconds).slice(-2)

                    $('.hours').text(finalhours);
                    $('.minutes').text(finalminutes);
                    $('.seconds').text(finalseconds);
                    // Format the time as HH:MM:SS
                    // var formattedTime =  + 'H:' +  + 'MM:' + +'S';

                    // $('#countdown').text(formattedTime);
                }
            }, 1000);


            $("input.date_filed").bind("paste", function(e) { //also changed the binding too
                e.preventDefault();
            });
            $("input.date_filed_mm_yyyy").bind("paste", function(e) { //also changed the binding too
                e.preventDefault();
            });
        });

        $(document).on('input', ".date_filed", function(e) {

            this.type = 'text';
            var input = this.value;
            if (/\D\/$/.test(input)) input = input.substr(0, input.length - 3);
            var values = input.split('/').map(function(v) {
                return v.replace(/\D/g, '')
            });
            if (values[0]) values[0] = checkValue(values[0], 12);
            if (values[1]) values[1] = checkValue(values[1], 31);
            var output = values.map(function(v, i) {
                return v.length == 2 && i < 2 ? v + '/' : v;
            });
            this.value = output.join('').substr(0, 10);
        });

        $(document).on('input', ".date_filed_mm_yyyy", function(e) {
            this.type = 'text';
            var input = this.value;
            input = input.replace(/\D/g, '').substr(0, 6);
            var values = input.match(/(\d{1,2})?(\d{1,4})?/).slice(1);
            if (values[0]) values[0] = checkValue(values[0], 12);
            if (values[1] && values[1].length > 4) values[1] = values[1].substr(0, 4);
            this.value = values.map(function(v, i) {
                return v && i === 0 ? v + '/' : v;
            }).join('').substr(0, 7);
        });

        $(document).on('blur', ".date_filed", function(e) {

            this.type = 'text';
            var input = this.value;
            var values = input.split('/').map(function(v, i) {
                return v.replace(/\D/g, '')
            });
            var output = '';

            if (values.length == 3) {
                var year = values[2].length !== 4 ? parseInt(values[2]) + 2000 : parseInt(values[2]);
                var month = parseInt(values[0]) - 1;
                var day = parseInt(values[1]);
                var d = new Date(year, month, day);
                if (!isNaN(d)) {
                    var dates = [d.getMonth() + 1, d.getDate(), d.getFullYear()];
                    output = dates.map(function(v) {
                        v = v.toString();
                        return v.length == 1 ? '0' + v : v;
                    }).join('/');
                };
            };
            this.value = output;
        });

        $(document).on('blur', ".date_filed_mm_yyyy", function(e) {
            this.type = 'text';
            var input = this.value;
            var values = input.split('/').map(function(v, i) {
                return v.replace(/\D/g, '');
            });
            var output = '';

            if (values.length === 2) {
                var month = parseInt(values[0]) - 1; // Subtract 1 to match JavaScript month numbering (0-11).
                var year = parseInt(values[1]);
                if (!isNaN(month) && !isNaN(year)) {
                    // Create a new Date object with the month and year.
                    var d = new Date(year, month);
                    if (!isNaN(d)) {
                        // Format the date as "MM/YYYY."
                        output = (d.getMonth() + 1).toString().padStart(2, '0') + '/' + d.getFullYear();
                    }
                }
            }
            this.value = output;
        });

        $(document).ready(function() {

            $("input[name$='martial_status']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0" || msValue == "3" || msValue == "4") {
                    $(".d2_info").addClass("hide-data");
                    $(".d2_info").addClass("hide-data");
                }
                if (msValue == "1" || msValue == "2") {
                    $(".d2_info").removeClass("hide-data");
                }
            });

            $("input[name$='filed_in_last_8_yrs']").click(function() {
                var msValue = $(this).val();
                if (msValue == "1") {
                    $(".past_8_year_section").addClass("hide-data");
                }
                if (msValue == "0") {
                    $(".past_8_year_section").removeClass("hide-data");
                }
            });

            commonShowHide = function(divToShow, status) {
                if (status == "0") {
                    $("." + divToShow).addClass('hide-data');
                }
                if (status == "1") {
                    $("." + divToShow).removeClass('hide-data');
                }
            }

            $("input[name$='rent_or_own']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".own_div_1").addClass("hide-data");
                    $(".rent_div_1").removeClass("hide-data");
                    $(".additional_loans").addClass("hide-data");
                }
                if (msValue == "1") {
                    $(".own_div_1").removeClass("hide-data");
                    $(".rent_div_1").addClass("hide-data");
                    // $(".additional_loans").removeClass("hide-data");
                }
            });

            $("input[name$='loan_on_property']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".loan_div").removeClass("hide-data");
                    $(".additional_loans").removeClass("hide-data");
                }
                if (msValue == "1") {
                    $(".loan_div").addClass("hide-data");
                    $(".additional_loans").addClass("hide-data");
                    $("#additional_loans_no_2").trigger("click");
                    $("#additional_loans_no_2").prop('checked', false);
                    $("#additional_loans_no_1").trigger("click");
                    $("#additional_loans_no_1").prop('checked', false);

                }
            });

            $("input[name$='mortgage_foreclosure_property']").click(function() {
                var msValue = $(this).val();
                if (msValue == "1") {
                    $(".forecloser_section").addClass("hide-data");
                    $(".forecloser_date_section").addClass("hide-data");
                    $("#foreclosure_date_no").trigger('click');
                }
                if (msValue == "0") {
                    $(".forecloser_section").removeClass("hide-data");
                }
            });

            $("input[name$='mortgage_foreclosure_date']").click(function() {
                var msValue = $(this).val();
                if (msValue == "1") {
                    $(".forecloser_date_section").addClass("hide-data");
                }
                if (msValue == "0") {
                    $(".forecloser_date_section").removeClass("hide-data");
                }
            });

            $("input[name$='child_supp_or_alimony']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".child_supp_or_alimony_section").removeClass("hide-data");
                }
                if (msValue == "1") {
                    $(".child_supp_or_alimony_section").addClass("hide-data");
                }
            });

            $("input[name$='current_on_your_support_obligation']").click(function() {
                var msValue = $(this).val();
                if (msValue == "1") {
                    $(".current_on_your_support_obligation_section").removeClass("hide-data");
                }
                if (msValue == "0") {
                    $(".current_on_your_support_obligation_section").addClass("hide-data");
                }
            });

            $("input[name$='tax_owned_irs']").click(function() {
                var msValue = $(this).val();
                if (msValue == "1") {
                    $(".irs_section").removeClass("hide-data");
                }
                if (msValue == "0") {
                    $(".irs_section").addClass("hide-data");
                }
            });

            $("input[name$='back_taxes_owed']").click(function() {
                var msValue = $(this).val();
                if (msValue == "1") {
                    $(".back_taxes_owed_section").removeClass("hide-data");
                }
                if (msValue == "0") {
                    $(".back_taxes_owed_section").addClass("hide-data");
                }
            });

            $("input[name$='employee_type_1']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".self_employed_section").addClass("hide-data");
                    $(".w2_employee_section").removeClass("hide-data");
                }
                if (msValue == "1") {
                    $(".self_employed_section").removeClass("hide-data");
                    $(".w2_employee_section").addClass("hide-data");
                }
                if (msValue == "2") {
                    $(".self_employed_section").addClass("hide-data");
                    $(".w2_employee_section").addClass("hide-data");
                }
            });

            $("input[name$='employee_type_2']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".self_employed_section_2").addClass("hide-data");
                    $(".w2_employee_section_2").removeClass("hide-data");
                }
                if (msValue == "1") {
                    $(".self_employed_section_2").removeClass("hide-data");
                    $(".w2_employee_section_2").addClass("hide-data");
                }
                if (msValue == "2") {
                    $(".self_employed_section_2").addClass("hide-data");
                    $(".w2_employee_section_2").addClass("hide-data");
                }


            });

            $("input[name$='own_any_vehicle']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".own_vehicle").addClass("hide-data");

                }
                if (msValue == "1") {
                    $(".own_vehicle").removeClass("hide-data");


                }
            });

            $("input[name$='additional_liens']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".additional_liens_section").addClass("hide-data");
                }
                if (msValue == "1") {
                    $(".additional_liens_section").removeClass("hide-data");
                }
            });


            $("input[name$='mortgage_additional_loans']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".additional_loans_div").addClass("hide-data");
                    // $(".additional_loans").addClass("hide-data");

                }
                if (msValue == "1") {
                    $(".additional_loans_div").removeClass("hide-data");
                    $(".additional_loans").removeClass("hide-data");


                }
            });

            $("input[name$='mortgage_additional_loans_2']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0") {
                    $(".additional_loans_div_2").addClass("hide-data");

                }
                if (msValue == "1") {
                    $(".additional_loans_div_2").removeClass("hide-data");


                }
            });

            $("input[name$='additional_loans']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0" || msValue == "3" || msValue == "4") {
                    $(".additional_loans_div").addClass("hide-data");
                }
                if (msValue == "1" || msValue == "2") {
                    $(".additional_loans_div").removeClass("hide-data");
                }
            });

            $("input[name$='additional_loans_2']").click(function() {
                var msValue = $(this).val();
                if (msValue == "0" || msValue == "3" || msValue == "4") {
                    $(".additional_loans_div_2").addClass("hide-data");
                }
                if (msValue == "1" || msValue == "2") {
                    $(".additional_loans_div_2").removeClass("hide-data");
                }
            });


            $(".hamburger").click(function() {
                $(this).toggleClass("is-active");
                $(".nav_bar").toggleClass("active_ham");
            });
            chooseType = function(thisrequest) {
                if (thisrequest.value == "0") {
                    $(".ssn_no").removeClass("hide-data");
                    $(".itin_no").addClass("hide-data");
                }
                if (thisrequest.value == "1") {
                    $(".ssn_no").addClass("hide-data");
                    $(".itin_no").removeClass("hide-data");
                }
            }
            chooseTypeD2 = function(thisrequest) {
                if (thisrequest.value == "0") {
                    $(".ssn_no_spouse").removeClass("hide-data");
                    $(".itin_no_spouse").addClass("hide-data");
                }
                if (thisrequest.value == "1") {
                    $(".ssn_no_spouse").addClass("hide-data");
                    $(".itin_no_spouse").removeClass("hide-data");
                }
            }


        });

        function vehicle_loan_show(index, val) {
            if (val == 'yes') {
                $(".vehicle_loan_div_" + index).removeClass("hide-data");
            }
            if (val == 'no') {
                $(".vehicle_loan_div_" + index).addClass("hide-data");
            }
        }

        function showDebtSection(index, msValue) {
            if (msValue == "1" || msValue == "3") {
                $(".additional_liens_debt_section_" + index).addClass("hide-data");
            }
            if (msValue == "2" || msValue == "4") {
                $(".additional_liens_debt_section_" + index).removeClass("hide-data");
            }
        }

        function addMoreDebtSection(index) {
            var nextIndex = 1 + index;
            if (index == 3) {
                alert('You can only insert 4 properties.');
            }
            if (index != 3) {
                $(".additional_section_" + nextIndex).removeClass("hide-data");
                $(".additional_addmore_section_" + index).addClass("hide-data");
            }
        }

        function removeDebtSection(index) {
            var prevIndex = index - 1;
            $(".additional_addmore_section_" + prevIndex).removeClass("hide-data");
            $(".additional_addmore_section_" + index).addClass("hide-data");
            $(".additional_section_" + index).addClass("hide-data");
        }

        function change_vehicle(sobj, indexese) {

            var val = sobj.value;
            var indexes = sobj.id;
            const myArray = indexes.split("_");
            indexes = myArray[1];
            var cars = 0;
            var recreational = 0;

            $(".property_type").each(function(index, element) {

                if (element.value == 1) {
                    cars = cars + 1;
                }
                if (element.value == 6) {
                    recreational = recreational + 1;
                }
            });

            /**** Here code start*/
            if (val == 1 && cars > 4) {
                $("#vehicle_" + indexes).val(6);
                $("#vehicle_" + indexes).next(".reccreational-vehicle").removeClass("hide-data");
                alert("You can not add more than 4 vehicles.");
                return false;
            }
            if (val == 6 && recreational > 2) {
                $("#vehicle_" + indexes).val(1);
                $("#vehicle_" + indexes).next(".reccreational-vehicle").addClass("hide-data");
                alert("You can not add more than 2 Recreational vehicles.");
                return false;
            }
            if (val == 1) {
                var rvno = cars;
                $("#vehicle_" + indexes).val(1);
                $("#vehicle_" + indexes).prevAll('.vtype_name').first().text('Vehicle');
                $("#vehicle_" + indexes).prevAll('.vehicleno').first().text(rvno);
                $("#vehicle_" + indexes).next(".reccreational-vehicle").addClass("hide-data");
            }
            if (val == 6) {
                $("#vehicle_" + indexes).val(6);
                var rvno = recreational == 1 ? 1 : 2;
                $("#vehicle_" + indexes).prevAll('.vtype_name').first().text('Recreational');
                $("#vehicle_" + indexes).prevAll('.vehicleno').first().text(rvno);
                $("#vehicle_" + indexes).next(".reccreational-vehicle").removeClass("hide-data");

            }


        }

        function changeVehicleQuestionnaire(radioInput, index) {
            // Get the label text from data-label attribute
            var labelText = radioInput.getAttribute('data-label');
            var value = radioInput.value;

            // Update hidden input with the label name
            var hiddenInput = radioInput.closest('.chip-style-tab').querySelector('.property_type_name');
            if (hiddenInput) {
                hiddenInput.value = labelText;
            }

            // Update active state for all chips in this vehicle section
            var allChips = radioInput.closest('.chip-style-tab').querySelectorAll('.chip-tab');
            allChips.forEach(function(chip) {
                chip.classList.remove('active');
            });
            radioInput.closest('.chip-tab').classList.add('active');

            // Update vehicle type name display
            var vehicleName = value == 6 ? 'Recreational' : 'Vehicle';
            var vehicleSection = radioInput.closest('.single-vehicle-form');
            if (vehicleSection) {
                var typeNameSpan = vehicleSection.querySelector('.vtype_name');
                if (typeNameSpan) {
                    typeNameSpan.textContent = vehicleName;
                }
            }

            // Count vehicles for validation
            var cars = 0;
            var recreational = 0;

            document.querySelectorAll('.property_type:checked').forEach(function(element) {
                if (element.value == 1) {
                    cars = cars + 1;
                }
                if (element.value == 6) {
                    recreational = recreational + 1;
                }
            });

            // Validation logic
            if (value == 1 && cars > 4) {
                alert("You can not add more than 4 vehicles.");
                // Revert to recreational
                var recInputs = radioInput.closest('.chip-style-tab').querySelectorAll('input[value="6"]');
                if (recInputs.length > 0) {
                    recInputs[0].checked = true;
                    recInputs[0].closest('.chip-tab').classList.add('active');
                    radioInput.closest('.chip-tab').classList.remove('active');
                    hiddenInput.value = recInputs[0].getAttribute('data-label');
                }
                return false;
            }
            if (value == 6 && recreational > 2) {
                alert("You can not add more than 2 Recreational vehicles.");
                // Revert to vehicle
                var vehicleInputs = radioInput.closest('.chip-style-tab').querySelectorAll('input[value="1"]');
                if (vehicleInputs.length > 0) {
                    vehicleInputs[0].checked = true;
                    vehicleInputs[0].closest('.chip-tab').classList.add('active');
                    radioInput.closest('.chip-tab').classList.remove('active');
                    hiddenInput.value = vehicleInputs[0].getAttribute('data-label');
                }
                return false;
            }
        }

        // VIN Number Input Handler - Limits to 17 alphanumeric characters
        function vinOnInput(inputObj) {
            var vin = $(inputObj).val();
            vin = vin.replace(/[^a-zA-Z0-9]/g, '').substring(0, 17);
            $(inputObj).val(vin);
        }

        // Unknown VIN Checkbox Handler
        function checkUnknownVin(checkbox, index) {
            if ($(checkbox).is(':checked')) {
                // Show vehicle data section for manual entry
                $('.vehicle-data-section-' + index).removeClass('d-none');
                // Remove required from VIN field
                $('.vin_number_div_' + index + ' input.vin_number').removeClass('required');
                $('.vin_number_div_' + index + ' input.vin_number').val('');
            } else {
                // Hide vehicle data section until VIN is provided
                $('.vehicle-data-section-' + index).addClass('d-none');
                // Make VIN field required again
                $('.vin_number_div_' + index + ' input.vin_number').addClass('required');
            }
        }

        // Auto Import Vehicle Info from VIN
        function checkVin2Number(cobj) {
            var fetchUrl = $(cobj).data('fetch-url');
            var this_id = $(cobj).attr('id');
            var propertyFetchUrl = $(cobj).data('property-fetch-url');
            var intakeFormID = $(cobj).data('intake-form-id');
            var attri = this_id.split('_');
            var thisnum = attri[2];
            
            const vehicleVinInput = $("input[name='property_vehicle[vin_number][" + thisnum + "]']");
            const vehicleVinValue = vehicleVinInput.val() || '';
            const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + thisnum + "]']");
            const vehicleMileageValue = vehicleMileageInput.val() || '';

            if (!vehicleVinValue.trim()) {
                $.systemMessage("Kindly enter your vehicle Vin number before accessing the property details.", 'alert--danger', true);
                vehicleVinInput.focus();
                return;
            }

            if (vehicleVinValue.length !== 17) {
                $.systemMessage("Invalid VIN Number. VIN Number must be 17 characters long.", 'alert--danger', true);
                vehicleVinInput.focus();
                return;
            }

            let cleanVehicleMileageValue = '';
            if (vehicleMileageValue) {
                cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
            }

            if (cleanVehicleMileageValue == '') {
                $.systemMessage("Kindly enter your vehicle mileage before accessing the property details.", 'alert--danger', true);
                vehicleMileageInput.focus();
                return;
            }

            // Show loading state
            var $button = $(cobj);
            var originalText = $button.html();
            $button.html('<i class="bi bi-hourglass-split"></i> Loading...').prop('disabled', true);

            $.systemMessage("Grabbing Vehicle Details. Hold Please.", 'alert--process');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: fetchUrl,
                data: {
                    vin_number: vehicleVinValue
                },
                dataType: 'json',
                type: 'post',
                success: function(json) {
                    $button.html(originalText).prop('disabled', false);
                    if (json.status == false) {
                        $.systemMessage.close();
                        $.systemMessage(json.message, 'alert--danger', true);
                        vehicleVinInput.focus();
                        $(".unknown_vin.unknown_vin_" + thisnum).attr('checked', false);
                        $(".vehicle-data-section-" + thisnum).addClass('d-none');
                    } else {
                        $(".unknown_vin.unknown_vin_" + thisnum).attr('checked', true);
                        $(".vehicle-data-section-" + thisnum).removeClass('d-none');
                        $("input[name='property_vehicle[property_year][" + thisnum + "]']").val(json.data.year);
                        $("input[name='property_vehicle[property_make][" + thisnum + "]']").val(json.data.make);
                        $("input[name='property_vehicle[property_model][" + thisnum + "]']").val(json.data.model);
                        $("input[name='property_vehicle[property_other_info][" + thisnum + "]']").val(json.data.trim);
                        $.systemMessage.close();
                        getPropertyVehicleDetailsByGraphQLForIntakeForm(thisnum, intakeFormID, propertyFetchUrl);
                    }
                },
                error: function() {
                    $button.html(originalText).prop('disabled', false);
                    $.systemMessage.close();
                    $.systemMessage('Error connecting to VIN lookup service. Please enter vehicle information manually.', 'alert--danger', true);
                }
            });
        }

        // Get Property Vehicle Details by GraphQL for Intake Form
        function getPropertyVehicleDetailsByGraphQLForIntakeForm(index, intakeFormID, propertyFetchUrl) {
            var client_id = intakeFormID || null;

            const vehicleVinInput = $('.vin_number_div_' + index + ' input.vin_number');
            const vehicleVinValue = vehicleVinInput.val() || '';
            const vehicleMileageInput = $("input[name='property_vehicle[property_mileage][" + index + "]']");
            const vehicleMileageValue = vehicleMileageInput.val() || '';

            let cleanVehicleMileageValue = '';
            if (vehicleMileageValue) {
                cleanVehicleMileageValue = parseFloat(vehicleMileageValue.replace(/[,]/g, '')) || '';
            }

            $.systemMessage("Grabbing Vehicle Value. Hold Please.", 'alert--process');
            var url = propertyFetchUrl || '';
            
            if (!url) {
                $.systemMessage.close();
                $.systemMessage("Property fetch URL not configured.", "alert--danger", true);
                return;
            }
            
            laws.ajax(url, {
                client_id: client_id,
                vin: vehicleVinValue,
                mileage: cleanVehicleMileageValue
            }, function(response) {
                var res = JSON.parse(response);
                $.systemMessage.close();
                if (res.status === 1 && res.finalData) {
                    const finalData = res.finalData;
                    const extraData = res.extraData;
                    // set mileage
                    $('.property_mileage[name="property_vehicle[property_mileage][' + index + ']"]').val(finalData.mileage);
                    // set price
                    $('.property_estimated_value[name="property_vehicle[property_estimated_value][' + index + ']"]').val(finalData.price);
           
                   /* if(extraData){
                         downloadJson(extraData);
                    }	*/
                }
                $.systemMessage.close();
                $.systemMessage("Property details added successfully.", "alert--success", true);
            });
            $('.vehicle_form_div_'+index).find(".vehicle-extra-data-info").removeClass('hide-data');
        }

        function addMoreVehicleFn() {
            var clnln = $(document).find(".single-vehicle-form").length;
            if (clnln > 5) {
                alert("You can only insert 6 properties.");
                $(".remove-btn").addClass("hide-data");
            } else {

                var itm = $(document).find(".single-vehicle-form").last();
                var index_val = clnln + 1;
                var cln = $(itm).clone();
                
                // Update the vehicle_form_div class to match new index
                cln.removeClass(function(index, className) {
                    return (className.match(/\bvehicle_form_div_\d+\b/g) || []).join(' ');
                }).addClass('vehicle_form_div_' + (index_val + 1));

                var property_type = cln.find('.property_type');
                var property_type_name = cln.find('.property_type_name');
                var vin_number = cln.find('.vin_number');
                var property_estimated_value = cln.find('.property_estimated_value');
                var property_year = cln.find('.property_year');
                var property_make = cln.find('.property_make');
                var property_model = cln.find('.property_model');
                var property_mileage = cln.find('.property_mileage');
                var property_other_info = cln.find('.property_other_info');
                var vehicle_car_loan_monthly_payment = cln.find('.vehicle_car_loan_monthly_payment');
                var vehicle_car_loan_past_due_amount = cln.find('.vehicle_car_loan_past_due_amount');
                var vehicle_car_loan_amount_own = cln.find('.vehicle_car_loan_amount_own');
                var vehicle_creditor_name = cln.find('.vehicle_creditor_name');
                var vehicle_creditor_name_addresss = cln.find('.vehicle_creditor_name_addresss');
                var vehicle_creditor_city = cln.find('.vehicle_creditor_city');
                var vehicle_creditor_state = cln.find('.vehicle_creditor_state');
                var vehicle_creditor_zip = cln.find('.vehicle_creditor_zip');
                var vehicle_loan_on_property = cln.find('.vehicle_loan_on_property');
                var vehicle_file_upload = cln.find('.vehicle_file_upload');

                var cars = 0;
                var recreational = 0;

                $(".property_type:checked").each(function() {
                    if ($(this).val() == 1) {
                        cars = cars + 1;
                    }
                    if ($(this).val() == 6) {
                        recreational = recreational + 1;
                    }
                });

                var vehiclename = 'Vehicle';
                var number = cars + 1;
                var defaultType = 1;
                var defaultLabel = 'Cars';

                if (cars == 4) {
                    if (index_val >= 4) {
                        number = 1;
                        if (recreational == 1) {
                            number = 2;
                        }
                        vehiclename = 'Recreational'; // Fixed: removed 'var' to avoid scoping issue
                        defaultType = 6;
                        defaultLabel = 'Tractors';
                    }
                }

                cln.find('.vtype_name').text(vehiclename);
                cln.find('.vehicleno').text(number);

                // Remove active class from all chips and uncheck all radios
                cln.find('.chip-tab').removeClass('active');
                cln.find('.property_type').prop('checked', false);

                // Set the appropriate default chip as active
                if (defaultType == 1) {
                    cln.find('.chip-tab').first().addClass('active');
                    cln.find('.property_type[value="1"][data-label="Cars"]').prop('checked', true);
                } else {
                    cln.find('.chip-tab.rec').first().addClass('active');
                    cln.find('.property_type[value="6"][data-label="Tractors"]').prop('checked', true);
                }

                cln.find(".doc-card").text("Current Auto Loan Statement " + (index_val + 1));
                cln.find(".o-doc-card").text("Other Loan Statement " + (index_val + 1));

                $(property_type).each(function() {
                    $(this).attr('name', 'property_vehicle[property_type][' + index_val + ']');
                    var currentOnclick = $(this).attr('onclick');
                    if (currentOnclick) {
                        // Update the index in onclick attribute
                        $(this).attr('onclick', currentOnclick.replace(/\d+\)$/, index_val + ')'));
                    }
                });

                $(property_type_name).each(function() {
                    $(this).attr('name', 'property_vehicle[property_type_name][' + index_val + ']');
                    $(this).val(defaultLabel);
                });
                $(vin_number).each(function() {
                    $(this).attr('name', 'property_vehicle[vin_number][' + index_val + ']');
                    $(this).attr('id', 'vin_' + index_val);
                });
                $(property_estimated_value).each(function() {
                    $(this).attr('name', 'property_vehicle[property_estimated_value][' + index_val + ']');
                });
                $(property_year).each(function() {
                    $(this).attr('name', 'property_vehicle[property_year][' + index_val + ']');
                });
                $(property_make).each(function() {
                    $(this).attr('name', 'property_vehicle[property_make][' + index_val + ']');
                });
                $(property_model).each(function() {
                    $(this).attr('name', 'property_vehicle[property_model][' + index_val + ']');
                });
                $(property_mileage).each(function() {
                    $(this).attr('name', 'property_vehicle[property_mileage][' + index_val + ']');
                });
                $(property_other_info).each(function() {
                    $(this).attr('name', 'property_vehicle[property_other_info][' + index_val + ']');
                });
                $(vehicle_car_loan_monthly_payment).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][monthly_payment][' + index_val + ']');
                });
                $(vehicle_car_loan_past_due_amount).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][past_due_amount][' + index_val + ']');
                });
                $(vehicle_car_loan_amount_own).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][amount_own][' + index_val + ']');
                });
                $(vehicle_creditor_name).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_name][' + index_val + ']');
                });
                $(vehicle_creditor_name_addresss).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_name_addresss][' + index_val +
                        ']');
                });
                $(vehicle_creditor_city).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_city][' + index_val + ']');
                });
                $(vehicle_creditor_state).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_state][' + index_val + ']');
                });
                $(vehicle_creditor_zip).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_car_loan][creditor_zip][' + index_val + ']');
                });
                // Uncheck vehicle loan radios and remove active class from labels
                cln.find('.vehicle_loan_on_property').prop('checked', false);
                cln.find('.vehicle_loan_on_property').next('label').removeClass('active');
                
                $(vehicle_loan_on_property).each(function() {
                    $(this).attr('name', 'property_vehicle[loan_own_type_property][' + index_val + ']');
                    var msValue = $(this).val();
                    if (msValue == "0") { //yes
                        $(this).attr('id', 'type_yes_vehicle_' + index_val);
                        $(this).attr('onclick', "vehicle_loan_show('" + index_val + "','yes')");
                        $(this).next("label.yes").attr('for', 'type_yes_vehicle_' + index_val);
                    }
                    if (msValue == "1") { //no
                        $(this).attr('id', 'type_no_vehicle_' + index_val);
                        $(this).attr('onclick', "vehicle_loan_show('" + index_val + "','no')");
                        $(this).next("label.no").attr('for', 'type_no_vehicle_' + index_val);
                    }
                    var prevIndex = index_val - 1;
                    // $(this).parent('div.loan_sect').next(".vehicle_loan_section").removeClass('vehicle_loan_div_'+prevIndex);
                    var loan_sect = $(this).closest('.loan_sect').nextAll(".vehicle_loan_section").first();
                    loan_sect.removeClass('vehicle_loan_div_' + prevIndex);
                    loan_sect.addClass('vehicle_loan_div_' + index_val);
                    loan_sect.addClass('hide-data');
                });
                $(vehicle_file_upload).each(function() {
                    $(this).attr('name', 'property_vehicle[vehicle_property_value_document][' + index_val + ']');
                    $(this).attr('id', 'vehicle_file_' + index_val);
                    $(this).val(''); // Clear the file input
                });

                // Update VIN-related elements
                cln.find('.link_vin').attr('id', 'link_vin_' + index_val);
                cln.find('.unknown_vin').each(function() {
                    $(this).attr('class', 'form-check-input unknown_vin unknown_vin_' + index_val);
                    // Update onclick attribute to use new index
                    $(this).attr('onclick', 'checkUnknownVin(this, ' + index_val + ')');
                    $(this).prop('checked', false);
                });
                cln.find('.vin_number_div').each(function() {
                    var classes = $(this).attr('class');
                    // Update the index in the class name
                    classes = classes.replace(/vin_number_div_\d+/, 'vin_number_div_' + index_val);
                    $(this).attr('class', classes);
                });

                // Update vehicle-data-section class and hide it by default
                cln.find('[class*="vehicle-data-section-"]').each(function() {
                    var classes = $(this).attr('class');
                    classes = classes.replace(/vehicle-data-section-\d+/, 'vehicle-data-section-' + index_val);
                    $(this).attr('class', classes + ' d-none');
                });

                cln.find('input[type="text"]').val('');
                cln.find('textarea').val('');
                cln.find('select').val('');
                
                // Clear validation errors from cloned elements
                cln.find('label.error').remove();
                cln.find('.error').removeClass('error');
                cln.find('.has-error').removeClass('has-error');

                $(itm).after(cln);
                $(".remove-btn").removeClass("hide-data");

            }
        }

        $(document).on("change", "#debtor_state", function(evt) {
            statecounty('debtor_state', 'state_based_county');
        });


        statecounty = function(divId, targetdiv) {
            var statename = $("#" + divId + " option:selected").text();
            var ajaxurl = "{{ route('county_by_state_name') }}";
            laws.ajax(ajaxurl, {
                state_name: statename
            }, function(response) {
                var res = JSON.parse(response);
                document.getElementById(targetdiv).innerHTML = "";

                $("#" + targetdiv)
                    .append($("<option></option>")
                        .attr("value", '')
                        .text("Choose County"));
                $.each(res.countyList, function(key, value) {

                    $("#" + targetdiv)
                        .append($("<option></option>")
                            .attr("value", value.id)
                            .text(value.county_name));
                });
            });
            setTimeout(1000);
        }

        $(document).on("input", ".phone-field", function(evt) {

            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
            var first10 = $(this).val().substring(0, 14);
            if (this.value.length > 14) {
                this.value = first10;
            }


        });

        function remove_clone_box(box_class) {
            var clnln = $(document).find("." + box_class).length;
            if (clnln <= 1) {
                alert("You can delete because min 1 entries require.");
                return false;
            } else {
                $(document).find("." + box_class).last().remove();
                var itm = $(document).find("." + box_class).last();
                var remove_btn_index = itm.find('button.remove_clone').data('index');
                if (remove_btn_index > 0) {
                    itm.find('button.' + button_class).show();
                }
            }
        }

        $(document).on('input', ".mortgages_creditor_name", function(e) {

            $(this).autocomplete({
                'classes': {
                    "ui-autocomplete": "custom-ui-autocomplete"
                },
                'source': function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('mortgage_search') }}',
                        data: {
                            keyword: encodeURIComponent(request['term'])
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function(json) {
                            json = json.data;
                            response($.map(json, function(item) {
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
                select: function(event, ui) {
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

        $(document).on('input', ".vehicle_creditor_name", function(e) {
            $(this).autocomplete({
                'classes': {
                    "ui-autocomplete": "custom-ui-autocomplete"
                },
                'source': function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('loan_company_search') }}',
                        data: {
                            keyword: encodeURIComponent(request['term'])
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function(json) {
                            json = json.data;
                            response($.map(json, function(item) {
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
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    var n = $(this).attr('name');
                    var index = n.slice(-3);
                    index = index.replace('[', '');
                    index = index.replace(']', '');
                    index = parseInt(index);

                    $("input[name='property_vehicle[vehicle_car_loan][creditor_name][" + index + "]']")
                        .val(ui.item.label);
                    $("input[name='property_vehicle[vehicle_car_loan][creditor_name_addresss][" +
                        index + "]']").val(ui.item.address);
                    $("input[name='property_vehicle[vehicle_car_loan][creditor_city][" + index + "]']")
                        .val(ui.item.city);
                    $("select[name='property_vehicle[vehicle_car_loan][creditor_state][" + index +
                        "]']").val(ui.item.state);
                    $("input[name='property_vehicle[vehicle_car_loan][creditor_zip][" + index + "]']")
                        .val(ui.item.zip);
                }
            });
        });



        $(document).on('input', ".al_domestic_support_name", function(e) {
            $(this).autocomplete({
                'classes': {
                    "ui-autocomplete": "custom-ui-autocomplete"
                },
                'source': function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '{{ route('master_credit_search') }}',
                        data: {
                            keyword: encodeURIComponent(request['term'])
                        },
                        dataType: 'json',
                        type: 'post',
                        success: function(json) {
                            json = json.data;
                            response($.map(json, function(item) {
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
                select: function(event, ui) {
                    $(this).val(ui.item.label);
                    var n = $(this).attr('name');
                    var index = n.slice(-3);
                    index = index.replace('[', '');
                    index = index.replace(']', '');
                    index = parseInt(index);
                    $("input[name='additional_liens_data[domestic_support_name][" + index + "]']").val(
                        ui.item.label);
                    $("input[name='additional_liens_data[domestic_support_address][" + index + "]']")
                        .val(ui.item.address);
                    $("input[name='additional_liens_data[domestic_support_city][" + index + "]']").val(
                        ui.item.city);
                    $("select[name='additional_liens_data[creditor_state][" + index + "]']").val(ui.item
                        .state);
                    $("input[name='additional_liens_data[domestic_support_zipcode][" + index + "]']")
                        .val(ui.item.zip);
                }
            });
        });

        $(document).on('input', ".allow-5digit", function(e) {
            var firstFive = this.value.substring(0, 5);
            var self = $(this);
            self.val(self.val().replace(/\D/g, ""));
            if ((e.which < 48 || e.which > 57)) {
                e.preventDefault();
            }
            if (this.value.length > 5) {
                this.value = firstFive;
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Get radio buttons and button container
            const googleReviewsYes = document.getElementById('google_reviews_yes');
            const googleReviewsNo = document.getElementById('google_reviews_no');
            const reviewsButtonContainer = document.getElementById('reviews-button-container');

            // Function to toggle button visibility
            function toggleReviewsButton() {
                if (googleReviewsNo.checked) {
                    reviewsButtonContainer.style.display = 'block';
                } else {
                    reviewsButtonContainer.style.display = 'none';
                }
            }

            // Add event listeners
            if (googleReviewsYes) {
                googleReviewsYes.addEventListener('change', toggleReviewsButton);
            }
            if (googleReviewsNo) {
                googleReviewsNo.addEventListener('change', toggleReviewsButton);
            }

            // Check initial state
            if (googleReviewsYes || googleReviewsNo) {
                toggleReviewsButton();
            }
        });

        const maxCases = 3; // maximum allowed cases

        function addMorePrevCaseSection(currentIndex) {
            const totalSections = document.querySelectorAll('.additional_case_section').length;

            if (totalSections >= maxCases) {
                alert("You can only add up to " + maxCases + " cases.");
                return;
            }

            const newIndex = totalSections; // next index
            const templateSelect = document.querySelector(
                'select[name^="any_bankruptcy_filed_before_data[district_if_known]"]'
            );
            let statesOptions = templateSelect ? templateSelect.innerHTML : '';

            // ensure first option is reset
            statesOptions = statesOptions.replace(/selected/gi, "");

            const newSection = `
            <div class="row gx-3 additional_case_section additional_case_section_${newIndex} m-0">
                <div class="light-gray-div mt-2 mb-3">
                    <h2>Previous Case ${newIndex + 1}:</h2>
                    <div class="row gx-3">

                        <!-- Case Name -->
                        <div class="col-md-4">
                            <div class="label-div mb-3">
                                <div class="form-group">
                                    <label class="form-label">Case Name</label>
                                    <input type="text"
                                        class="input_capitalize form-control required"
                                        name="any_bankruptcy_filed_before_data[case_name][${newIndex}]"
                                        placeholder="Case Name" value="">
                                </div>
                            </div>
                        </div>

                        <!-- Date Filed -->
                        <div class="col-md-3">
                            <div class="label-div mb-3">
                                <div class="form-group">
                                    <label class="form-label">Date Filed</label>
                                    <input type="text"
                                        class="input_capitalize form-control date_filed required date-filed-input"
                                        name="any_bankruptcy_filed_before_data[data_field][${newIndex}]"
                                        placeholder="MM/DD/YYYY" value="">
                                    <div class="form-check">
                                        <input class="form-check-input date-filed-unknown" type="checkbox"
                                            id="date_filed_unknown_${newIndex}"
                                            name="any_bankruptcy_filed_before_data[data_field_unsure][${newIndex}]"
                                            onclick="toggleRequired('date-filed-input', this)">
                                        <label class="form-check-label form-label"
                                            for="date_filed_unknown_${newIndex}"><small>Unsure</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Case Number -->
                        <div class="col-md-2">
                            <div class="label-div mb-3">
                                <div class="form-group">
                                    <label class="form-label">Case Number</label>
                                    <input type="text"
                                        class="input_capitalize form-control required case-number-input"
                                        name="any_bankruptcy_filed_before_data[case_numbers][${newIndex}]"
                                        placeholder="Case Number" value="">
                                    <div class="form-check">
                                        <input class="form-check-input case-number-unknown" type="checkbox"
                                            id="case_number_unknown_${newIndex}"
                                            name="any_bankruptcy_filed_before_data[case_numbers_unknown][${newIndex}]"
                                            onclick="toggleRequired('case-number-input', this)">
                                        <label class="form-check-label form-label"
                                            for="case_number_unknown_${newIndex}"><small>Unknown</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- District -->
                        <div class="col-md-3">
                            <div class="label-div mb-3">
                                <div class="form-group">
                                    <label class="form-label">District if (known)</label>
                                    <select name="any_bankruptcy_filed_before_data[district_if_known][${newIndex}]" required class="form-control required">
                                        ${statesOptions}
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center additional_case_section_${newIndex} additional_addmore_section_${newIndex} prev-case-addmore">
                <button type="button"
                    class="vehicle-action-btn add-btn shadow-2 rounded-0 w-auto label save-btn mx-ht im-action btn-new-ui-default  mb-3 px-5 py-2 d-inline-block"
                    onclick="addMorePrevCaseSection(${newIndex});">
                    <i class="bi bi-plus-lg mr-1"></i> Add More
                </button>

                <button type="button"
                    class="vehicle-action-btn delete-btn delete-div trash-btn ms-auto d-inline-block p-inherit mb-3"
                    title="Delete"
                    onclick="removePrevCaseSection(${newIndex});">
                    <i class="bi bi-trash3 mr-1 remove-btn cursor-pointer float_right remove_clone"></i>Delete
                </button>
            </div>`;

            const lastAddMoreRow = document.querySelector(`.additional_addmore_section_${currentIndex}`);
            lastAddMoreRow.insertAdjacentHTML("afterend", newSection);

            // Hide old Add & Delete buttons so only latest block has them
            const oldAdd = lastAddMoreRow.querySelector("button.add-btn");
            if (oldAdd) {
                oldAdd.classList.remove("d-inline-block");
                oldAdd.classList.add("hide-data");
            }

            const oldDelete = lastAddMoreRow.querySelector("button.delete-btn");
            if (oldDelete) {
                oldDelete.classList.remove("d-inline-block");
                oldDelete.classList.add("hide-data");
            }

            // Hide add if max reached
            if (newIndex + 1 >= maxCases) {
                const newAdd = document.querySelector(`.additional_addmore_section_${newIndex} button.add-btn`);
                if (newAdd) {
                    newAdd.classList.remove("d-inline-block");
                    newAdd.classList.add("hide-data");
                }
            }
        }

        function removePrevCaseSection(index) {
            const sections = document.querySelectorAll('.additional_case_section');
            const totalSections = sections.length;

            if (totalSections <= 1) {
                alert("At least one case must remain.");
                return;
            }

            // Remove selected case + its button row
            document.querySelectorAll(`.additional_case_section_${index}`).forEach(el => el.remove());
            document.querySelectorAll(`.additional_addmore_section_${index}`).forEach(el => el.remove());

            // Find new last index
            const newLastIndex = document.querySelectorAll('.additional_case_section').length - 1;
            const lastRow = document.querySelector(`.additional_addmore_section_${newLastIndex}`);
            if (lastRow) {
                const addBtn = lastRow.querySelector("button.add-btn");
                if (addBtn) {
                    addBtn.classList.toggle("hide-data", newLastIndex + 1 >= maxCases);
                    addBtn.classList.toggle("d-inline-block", newLastIndex + 1 < maxCases);
                }

                const delBtn = lastRow.querySelector("button.delete-btn");
                if (delBtn) {
                    delBtn.classList.toggle("hide-data", newLastIndex === 0);
                    delBtn.classList.toggle("d-inline-block", newLastIndex > 0);
                }
            }
        }

        function toggleRequired(inputClass, checkbox) {
            var parent = checkbox.closest('.form-group');
            var input = parent.querySelector('input.' + inputClass);
            if (checkbox.checked) {
                input.classList.remove('required');
                input.required = false;
                input.value = '';
            } else {
                input.classList.add('required');
                input.required = true;
            }
        }

        function otherClicked(labelEl, sectionID) {
            setTimeout(function() {
                const $label = $(labelEl);

                if ($label.hasClass('active')) {
                    $('.' + sectionID).removeClass("hide-data");
                } else {
                    $('.' + sectionID).addClass("hide-data");
                }
            }, 100);
        }

        $(document).on("change", "#property_state", function(evt) {
            statecounty('property_state', 'property_county');
        });

        // Check property description fields (bedrooms, bathrooms, sq ft) to show/hide property-value-section
        $(document).on("change blur input",
            ".property-data-section .bedroom, .property-data-section .bathroom, .property-data-section .home_sq_ft",
            function() {
                // Get the selected property type
                var selectedPropertyType = $("input[name='property_own_data[property_type]']:checked").val();

                // Only check for property types 1-4 (Single family, Duplex, Condo, Mobile home)
                if (selectedPropertyType && [1, 2, 3, 4].includes(parseInt(selectedPropertyType))) {
                    var parentDiv = $(this).closest('.property-data-section');
                    var bedrooms = parentDiv.find('.bedroom').val();
                    var bathrooms = parentDiv.find('.bathroom').val();
                    var sqFt = parentDiv.find('.home_sq_ft').val();
                    var propertyValueSection = parentDiv.find('.property-value-section');

                    // If all three fields are filled, show property-value-section, otherwise hide it
                    if (bedrooms && bathrooms && sqFt) {
                        propertyValueSection.removeClass('d-none');
                    } else {
                        propertyValueSection.addClass('d-none');
                    }
                }
            });

        // Check lot size field to show/hide property-value-section
        $(document).on("change blur input", ".property-data-section .lot_size_acres", function() {
            // Get the selected property type
            var selectedPropertyType = $("input[name='property_own_data[property_type]']:checked").val();

            // Only check for property types 5-6 (Land, Investment)
            if (selectedPropertyType && [5, 6].includes(parseInt(selectedPropertyType))) {
                var parentDiv = $(this).closest('.property-data-section');
                var lotSize = parentDiv.find('.lot_size_acres').val();
                var propertyValueSection = parentDiv.find('.property-value-section');

                // If lot size is filled, show property-value-section, otherwise hide it
                if (lotSize) {
                    propertyValueSection.removeClass('d-none');
                } else {
                    propertyValueSection.addClass('d-none');
                }
            }
        });

        // Check property other name field to show/hide property-value-section
        $(document).on("change blur input", ".property-data-section .property_other_input", function() {
            // Get the selected property type
            var selectedPropertyType = $("input[name='property_own_data[property_type]']:checked").val();
            
            // Only check for property type 8 (Other)
            if (selectedPropertyType && parseInt(selectedPropertyType) === 8) {
                var parentDiv = $(this).closest('.property-data-section');
                var propertyOtherName = parentDiv.find('.property_other_input').val();
                var propertyValueSection = parentDiv.find('.property-value-section');
                
                // If property other name is filled, show property-value-section, otherwise hide it
                if (propertyOtherName) {
                    propertyValueSection.removeClass('d-none');
                } else {
                    propertyValueSection.addClass('d-none');
                }
            }
        });

        // Check estimated property value field to show/hide property-owned-by-section
        $(document).on("change blur input", ".property-data-section .estimated_property_value", function() {
            var parentDiv = $(this).closest('.property-data-section');
            var propertyValue = $(this).val();
            var propertyOwnedBySection = parentDiv.find('.property-owned-by-section');

            // If property value is filled, show property-owned-by-section, otherwise hide it
            if (propertyValue) {
                propertyOwnedBySection.removeClass('d-none');
            } else {
                propertyOwnedBySection.addClass('d-none');
            }
        });

        // Check property owned by selection to show/hide mortgage-section
        $(document).on("change", "input[name='property_own_data[property_owned_by]']", function() {
            var selectedValue = $("input[name='property_own_data[property_owned_by]']:checked").val();

            // If any option is selected, show mortgage-section, otherwise hide it
            if (selectedValue) {
                $(".mortgage-section").removeClass('d-none');
            } else {
                $(".mortgage-section").addClass('d-none');
            }
        });


        // Primary Residence Address Show/Hide Function
        not_primary_address_property = function(value, element) {
            if (value == 'no') {
                // Not primary residence - show address fields and property data section
                $(".payment_not_primary_address_data").removeClass("d-none");
                $(".property-type-section").removeClass("d-none");

                // Show property-data-section immediately when "No" is selected
                $(".property-data-section").removeClass("d-none");
            }
            if (value == 'yes') {
                // Is primary residence - hide address fields, show property data section
                $(".payment_not_primary_address_data").addClass("d-none");
                $(".property-type-section").removeClass("d-none");

                // Show property-data-section immediately when "Yes" is selected
                $(".property-data-section").removeClass("d-none");
            }
        }

        // Property Type Show/Hide Function
        showHidePropertySizeDiv = function(element, value) {
            var valueInt = parseInt(value);
            var arr1 = [1, 2, 3, 4]; // Single family, Duplex, Condo, Mobile home
            var arr2 = [5, 6]; // Land, Investment

            var parentDiv = $(element).closest('.property-data-section');
            var descriptionDiv = parentDiv.find('.description-div');
            var descriptionAndLotSizeDiv = parentDiv.find('.description-and-lot-size-div');
            var descriptionAndOtherNameDiv = parentDiv.find('.description-and-other-name-div');
            var propertyValueSection = parentDiv.find('.property-value-section');
            var propertyOwnedBySection = parentDiv.find('.property-owned-by-section');

            if (arr1.includes(valueInt)) {
                descriptionDiv.removeClass('d-none'); // Show bedrooms/bathrooms/sq ft
                descriptionAndLotSizeDiv.addClass('d-none'); // Hide lot size
                descriptionAndOtherNameDiv.addClass('d-none'); // Hide other name

                // Check if all three fields are filled
                var bedrooms = parentDiv.find('.bedroom').val();
                var bathrooms = parentDiv.find('.bathroom').val();
                var sqFt = parentDiv.find('.home_sq_ft').val();

                if (bedrooms && bathrooms && sqFt) {
                    propertyValueSection.removeClass('d-none'); // Show if all filled

                    // Check if estimated property value is filled to show property-owned-by-section
                    var propertyValue = parentDiv.find('.estimated_property_value').val();
                    if (propertyValue) {
                        propertyOwnedBySection.removeClass('d-none');
                    } else {
                        propertyOwnedBySection.addClass('d-none');
                    }
                } else {
                    propertyValueSection.addClass('d-none'); // Hide if not all filled
                    propertyOwnedBySection.addClass('d-none'); // Also hide owned by section
                }
            } else if (arr2.includes(valueInt)) {
                descriptionAndLotSizeDiv.removeClass('d-none'); // Show lot size
                descriptionDiv.addClass('d-none'); // Hide bedrooms/bathrooms/sq ft
                descriptionAndOtherNameDiv.addClass('d-none'); // Hide other name

                // Check if lot size is filled
                var lotSize = parentDiv.find('.lot_size_acres').val();

                if (lotSize) {
                    propertyValueSection.removeClass('d-none'); // Show if filled

                    // Check if estimated property value is filled to show property-owned-by-section
                    var propertyValue = parentDiv.find('.estimated_property_value').val();
                    if (propertyValue) {
                        propertyOwnedBySection.removeClass('d-none');
                    } else {
                        propertyOwnedBySection.addClass('d-none');
                    }
                } else {
                    propertyValueSection.addClass('d-none'); // Hide if not filled
                    propertyOwnedBySection.addClass('d-none'); // Also hide owned by section
                }
            } else if (valueInt === 7) {
                // Timeshare - hide all description divs
                descriptionAndLotSizeDiv.addClass('d-none');
                descriptionDiv.addClass('d-none');
                descriptionAndOtherNameDiv.addClass('d-none');
                
                propertyValueSection.removeClass('d-none'); // Show property value section for Timeshare

                // Check if estimated property value is filled to show property-owned-by-section
                var propertyValue = parentDiv.find('.estimated_property_value').val();
                if (propertyValue) {
                    propertyOwnedBySection.removeClass('d-none');
                } else {
                    propertyOwnedBySection.addClass('d-none');
                }
            } else if (valueInt === 8) {
                // Other - show other name input
                descriptionDiv.addClass('d-none'); // Hide bedrooms/bathrooms/sq ft
                descriptionAndLotSizeDiv.addClass('d-none'); // Hide lot size
                descriptionAndOtherNameDiv.removeClass('d-none'); // Show other name
                
                // Check if property other name is filled
                var propertyOtherName = parentDiv.find('.property_other_input').val();
                
                if (propertyOtherName) {
                    propertyValueSection.removeClass('d-none'); // Show if filled
                    
                    // Check if estimated property value is filled to show property-owned-by-section
                    var propertyValue = parentDiv.find('.estimated_property_value').val();
                    if (propertyValue) {
                        propertyOwnedBySection.removeClass('d-none');
                    } else {
                        propertyOwnedBySection.addClass('d-none');
                    }
                } else {
                    propertyValueSection.addClass('d-none'); // Hide if not filled
                    propertyOwnedBySection.addClass('d-none'); // Also hide owned by section
                }
            }
        }

        // Property Square Feet Input Validation (max 90,000 sq ft, 2 decimals)
        $(document).on('input', '.description-div-input', function() {
            var inputValue = $(this).val();

            if (/^\d+(\.\d{0,2})?$/.test(inputValue)) {
                var dotIndex = inputValue.indexOf('.');
                if (dotIndex !== -1) {
                    var integerPart = inputValue.substring(0, dotIndex);
                    var decimalPart = inputValue.substring(dotIndex + 1, dotIndex + 3);
                    var newValue = integerPart + '.' + decimalPart;
                    $(this).val(newValue);
                }
                if (parseFloat(inputValue) > 90000) {
                    var newValue = inputValue.slice(0, -1);
                    $(this).val(newValue);
                }
            } else if (/^\d+(\.\d{3})?$/.test(inputValue)) {
                var newValue = inputValue.slice(0, -1);
                $(this).val(newValue);
            } else {
                $(this).val('');
            }
        });

        // Property Lot Size Input Validation (max 200,000 acres, 2 decimals)
        $(document).on('input', '.lot-size-div-input', function() {
            var inputValue = $(this).val();

            if (/^\d+(\.\d{0,2})?$/.test(inputValue)) {
                var dotIndex = inputValue.indexOf('.');
                if (dotIndex !== -1) {
                    var integerPart = inputValue.substring(0, dotIndex);
                    var decimalPart = inputValue.substring(dotIndex + 1, dotIndex + 3);
                    var newValue = integerPart + '.' + decimalPart;
                    $(this).val(newValue);
                }
                if (parseFloat(inputValue) > 200000) {
                    var newValue = inputValue.slice(0, -1);
                    $(this).val(newValue);
                }
            } else if (/^\d+(\.\d{3})?$/.test(inputValue)) {
                var newValue = inputValue.slice(0, -1);
                $(this).val(newValue);
            } else {
                $(this).val('');
            }
        });

        // Property Details GraphQL Function for Questionnaire Form
        function getPropertyDetailsForIntakeForm(element) {
            const $element = $(element);
            const isCheckedNo = $('#payment_not_primary_address_no').is(':checked');
            const isCheckedYes = $('#payment_not_primary_address_yes').is(':checked');

            let address = "";

            if (isCheckedNo) {
                const $streetInput = $('input[name="property_own_data[property_address]"]');
                const street = $streetInput.val() || '';
                const city = $('input[name="property_own_data[property_city]"]').val() || '';
                const state = $('#property_state option:selected').val() || '';
                const zip = $('input[name="property_own_data[property_zip]"]').val() || '';

                address = street;
                address += city ? ', ' + city : '';
                address += state ? ', ' + state : '';
                address += zip ? ', ' + zip : '';

                if (!address.trim()) {
                    $.systemMessage("Kindly enter your residence address before accessing the property details.", 'alert--danger', true);
                    $streetInput.focus();
                    return;
                }
            }

            if (isCheckedYes) {
                // Get primary address from debtor's basic information
                const streetPrimary = $('input[name="Address"]').val() || '';
                const cityPrimary = $('input[name="City"]').val() || '';
                const statePrimary = $('#debtor_state option:selected').val() || '';
                const zipPrimary = $('input[name="zip"]').val() || '';

                address = streetPrimary;
                address += cityPrimary ? ', ' + cityPrimary : '';
                address += statePrimary ? ', ' + statePrimary : '';
                address += zipPrimary ? ', ' + zipPrimary : '';

                if (!address.trim()) {
                    $.systemMessage("Primary address not found. Please enter your address in the Debtor's Basic Information section.", 'alert--danger', true);
                    $('input[name="Address"]').focus();
                    return;
                }
            }

            if (!isCheckedNo && !isCheckedYes) {
                $.systemMessage("Kindly select your primary residence type before accessing the property details.", 'alert--danger', true);
                return;
            }

            if (address && address.trim()) {
                const clientId = $element.data('client-id');
                const graphqlUrl = $element.data('graphql-url');
                fetchPropertyDetailsForIntakeForm(address, clientId, graphqlUrl, $element);
            } else {
                $.systemMessage("Please select your primary residence type and enter address before generating property details", 'alert--danger', true);
            }
        }

        function fetchPropertyDetailsForIntakeForm(address, clientId, graphqlUrl, $button) {
            // Show loading state on button
            var originalText = $button.html();
            $button.html('<i class="bi bi-hourglass-split"></i> Loading...').prop('disabled', true);
            
            // Show loading message
            $.systemMessage("Grabbing Property Details. Hold Please.", 'alert--process');

            $.ajax({
                url: graphqlUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    address: address,
                    client_id: clientId,
                    form_type: 'intake_form'
                },
                dataType: 'json',
                success: function(response) {
                    // Restore button state
                    $button.html(originalText).prop('disabled', false);
                    
                    if (response.status === 1 && response.finalData) {
                        const finalData = response.finalData;
                        
                        // Set property type by clicking the appropriate radio button
                        $('input[name="property_own_data[property_type]"]').each(function() {
                            const isMatch = $(this).val() == finalData.property_type;
                            if (isMatch) {
                                const id = $(this).attr('id');
                                $('label[for="' + id + '"]').trigger('click');
                            }
                        });
                        
                        // Set property value
                        $('input[name="mortgage_property_value_1"]').val(finalData.price).trigger('input');
                        
                        // Set bedrooms
                        $('select[name="property_own_data[property_bedrooms]"]').val(finalData.beds).trigger('change');
                        
                        // Set bathrooms
                        $('select[name="property_own_data[property_bathrooms]"]').val(finalData.baths).trigger('change');
                        
                        // Set home sq ft
                        $('input[name="property_own_data[property_home_sq_ft]"]').val(finalData.lot_size).trigger('input');
                        
                        // Close loading message and show success
                        $.systemMessage.close();
                        $.systemMessage("Property details added successfully.", "alert--success", true);
                    } else {
                        const errorMsg = response.msg || "Failed to fetch property details";
                        $.systemMessage(errorMsg, 'alert--danger', true);               
                    }
                },
                error: function(xhr, status, error) {
                    // Restore button state
                    $button.html(originalText).prop('disabled', false);
                    
                    console.error('AJAX Error:', xhr, status, error);
                    const errorMsg = "Error fetching property details: " + error;
                    $.systemMessage(errorMsg, 'alert--danger', true);
                }
            });
        }

        // Show/hide property detail button when primary residence selection changes
        $(document).on('change', 'input[name="property_own_data[not_primary_address]"]', function() {
            const isCheckedNo = $('#payment_not_primary_address_no').is(':checked');
            const isCheckedYes = $('#payment_not_primary_address_yes').is(':checked');
            
            if (isCheckedNo || isCheckedYes) {
                $('.property-detail-div').removeClass('d-none');
            } else {
                $('.property-detail-div').addClass('d-none');
            }
        });

        // Show property detail button when all address fields are filled (for "No" option)
        $(document).on('blur', 'input[name="property_own_data[property_address]"], input[name="property_own_data[property_city]"], input[name="property_own_data[property_zip]"], #property_state', function() {
            const isCheckedNo = $('#payment_not_primary_address_no').is(':checked');
            
            if (isCheckedNo) {
                const street = $('input[name="property_own_data[property_address]"]').val();
                const city = $('input[name="property_own_data[property_city]"]').val();
                const state = $('#property_state').val();
                const zip = $('input[name="property_own_data[property_zip]"]').val();
                
                if (street && city && state && zip) {
                    $('.property-detail-div').removeClass('d-none');
                }
            }
        });
    </script>

</body>

</html>
