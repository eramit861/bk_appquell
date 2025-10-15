@php
    $mainData = $isUploadedScreen ? $data : [];
    if (
        isset($dataType) &&
        !empty($dataType) &&
        in_array($dataType, [
            \App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB,
            \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB,
        ])
    ) {
        $dataType = $dataType;
    } else {
        $dataType = $isUploadedScreen ? $mainData['document_type'] : '';
    }
    if (isset($colSize) && !empty($colSize)) {
        $colSize = $colSize;
    } else {
        $colSize = 'col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6';
    }
    $documentsAddedForThisEmployer = [];
    $colDateSize = $isUploadedScreen
        ? 'col-xxl-3 col-xl-3 col-lg-3 col-sm-3 col-3 col-md-3'
        : 'col-xxl-5 col-xl-6 col-lg-4 col-md-5 col-sm-4 col-12 paystub-date';
    $colActionSize = $isUploadedScreen
        ? 'col-xxl-7 col-xl-7 col-lg-7 col-sm-7 col-7 col-md-7'
        : 'col-xxl-7 col-xl-6 col-lg-8 col-md-7 col-sm-8 col-12 paystub-action';
    $uploadedDocumentsArray = $isUploadedScreen && isset($mainData['multiple']) ? $mainData['multiple'] : [];
    $currentDate = \Carbon\Carbon::now();
@endphp

<section class="accordian p-0" role="tablist" aria-live="polite">
    <input type="hidden" name="document_type" id="document_types" value="{{ $dataType }}">
    @foreach ($payCheckData as $key => $value)
        @php
            $class = '';
            $emp_data = Helper::validate_key_value('emp_data', $value);

            $not_own_paystub = Helper::validate_key_value('not_own_paystub', $emp_data);
            $employer_id = Helper::validate_key_value('id', $emp_data);
            $pay_dates = Helper::validate_key_value('pay_dates', $value);
            $pay_dates = !empty($pay_dates) ? array_reverse($pay_dates) : [];
            $pay_dates_list = Helper::validate_key_value('pay_dates_list', $value);

            $docForThisEmployer = is_array($pay_dates_list) ? array_column($pay_dates_list, 'document_id') : [];

            $overrideCount = Helper::validate_key_value('overrideCount', $value);
            $countFalse = 0;
            $mainTitle = '';
            $paystubShowMore = '';
            $paystbcount = is_array($docForThisEmployer) ? count($docForThisEmployer) : 0;
            $title = 'Employer';
            if (!empty($emp_data)) {
                $title = '<span>' . Helper::validate_key_value('employer_name', $emp_data) . '</span> ';
                $title .=
                    '<small class="text-c-blue ml-1">(Pay Dates based upon: <span class="text-bold text_underline">' .
                    $value['clientFrequency'] .
                    '</span> frequency)</small> ';
                if (in_array(Helper::validate_key_value('employer_type', $emp_data, 'radio'), [1, 2, 3, 4, 5, 6])) {
                    $end_date = Helper::validate_key_value('end_date', $emp_data);
                    $mainTitle =
                        '<p class="mb-0 fs-14px">
                    <span class="text-bold border-bottom-light-blue">' .
                        ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) .
                        ':</span>' .
                        (!empty($end_date)
                            ? '<span class="recent-pay-date mt-2 d-inline"> (Most recent paystub pay date: ' .
                                date('M d, Y', strtotime($end_date)) .
                                ')</span>'
                            : '') .
                        '</p>';
                    if ($isUploadedScreen && $paystbcount > 0) {
                        $paystubShowMore =
                            '<a class="text-underline float-right text-c-black" href="' .
                            route('attorney_client_uploaded_documents', ['id' => $val['id']]) .
                            (isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id
                                ? ''
                                : '?type=' . $dataType . '&employer_id=' . $employer_id) .
                            '"> 
                        <span class="read-more-less" style="font-size:10px;">' .
                            ((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id
                                ? 'Hide '
                                : 'Click to Show ') .
                                $paystbcount .
                                ' doc(s)') .
                            ' <i class="fa fa-angle-' .
                            (isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id ? 'up' : 'down') .
                            '" aria-hidden="true"></i></span>
                    </a>';
                    }
                } else {
                    $end_date = Helper::validate_key_value('end_date', $emp_data);
                    $mainTitle =
                        '<p class=" mb-0 fs-14px">
                                        <span class="text-bold border-bottom-light-blue">' .
                        ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) .
                        ':</span>' .
                        (!empty($end_date)
                            ? '<span class="recent-pay-date"> (Most recent paystub pay date: ' .
                                date('M d, Y', strtotime($end_date)) .
                                ')</span>'
                            : '') .
                        '</p> ';
                    if ($isUploadedScreen && $paystbcount > 0) {
                        $paystubShowMore =
                            '<a class="text-underline float-right text-c-black" href="' .
                            route('attorney_client_uploaded_documents', ['id' => $val['id']]) .
                            (isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id
                                ? ''
                                : '?type=' . $dataType . '&employer_id=' . $employer_id) .
                            '"> 
                            <span class="read-more-less" style="font-size:10px;">' .
                            ((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id
                                ? 'Hide '
                                : 'Click to Show ') .
                                $paystbcount .
                                ' doc(s)') .
                            ' <i class="fa fa-angle-' .
                            (isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id ? 'up' : 'down') .
                            '" aria-hidden="true"></i></span>
                        </a>';
                    }
                }
            }
            $datesCount = count($pay_dates);

            $countFalse = count(array_filter($pay_dates, fn($pd) => !$pd['exists']));
            $countFalse = $countFalse - (int) $overrideCount;
            $missingCount = '<span class="text-danger text-bold me-2">Missing: ' . $countFalse . '</span>';
            $lastSixMonthPayStubDates = [];
            if (!empty($pay_dates_list)) {
                $filteredDates = array_filter($pay_dates_list, function ($item) {
                    return !empty($item['pay_date']);
                });

                $lastSixMonthPayStubDates = array_map(function ($item) {
                    return $item['pay_date'];
                }, $filteredDates);

                $lastSixMonthPayStubDates = array_filter($lastSixMonthPayStubDates, function ($date) use (
                    $currentDate,
                ) {
                    $dateInstance = \Carbon\Carbon::parse($date);
                    $monthsDifference = $dateInstance->diffInMonths($currentDate);

                    return $monthsDifference <= 6;
                });

                foreach ($lastSixMonthPayStubDates as $date) {
                    // Check if this date exists in any object in $pay_dates by "pay_date"
                    $existsInPayDates = array_filter($pay_dates, fn($pay) => $pay['pay_date'] === $date);

                    // If the date is missing in $pay_dates, add a new object
                    if (empty($existsInPayDates)) {
                        // Search for the date in $pay_dates_list to set "exists" and "existsData"
                        $matchingData = array_filter($pay_dates_list, fn($list) => $list['pay_date'] === $date);

                        // If there's a match in $pay_dates_list with document_id > 0, set "exists" to true and add "existsData"
            if (!empty($matchingData)) {
                $matchingData = reset($matchingData); // Get the first matching item

                $newEntry = [
                    'custom_added' => true,
                    'pay_date' => $date,
                    'exists' => $matchingData['document_id'] > 0,
                    'existsData' => $matchingData['document_id'] > 0 ? [$matchingData] : null,
                ];
            } else {
                // No match found in $pay_dates_list, set "exists" to false
                $newEntry = [
                    'custom_added' => true,
                    'pay_date' => $date,
                    'exists' => false,
                    'existsData' => [],
                ];
            }

            // Add the new entry to $pay_dates
            $pay_dates[] = $newEntry;
        }
    }

    usort($pay_dates, function ($a, $b) {
        $dateA = \Carbon\Carbon::parse($a['pay_date']);
        $dateB = \Carbon\Carbon::parse($b['pay_date']);

                    return $dateA->lessThan($dateB) ? 1 : -1;
                });
            }
        @endphp
        <div class="light-gray-div {{ $key }}">
            <div class="light-gray-box-form-area">
                <h2>{!! $mainTitle !!}</h2>

                <div class="row gx-3">
                    @php
                        $for = '';
                        if (
                            Auth::user() &&
                            Auth::user()->role == 1 &&
                            in_array($dataType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])
                        ) {
                            if ($dataType == 'Debtor_Pay_Stubs') {
                                $for = 'Debtor';
                            }
                            if ($dataType == 'Co_Debtor_Pay_Stubs') {
                                $for = $client_type == 2 ? 'Non-Filing Spouse' : 'Co-Debtor';
                            }
                        }
                    @endphp
                    @if (Auth::user() && Auth::user()->role == 1 && in_array($dataType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                        <div class="col-12">
                            <a href="javascript:void(0)"
                                onclick="calculateUploadBtnClick('{{ $dataType }}', '{{ $for }}', '{{ $employer_id }}')"
                                class="calculate-dt-income" data-type="" data-text="">
                                {{ $dataType == 'Co_Debtor_Pay_Stubs' ? 'Calculate Co-Debtors Income' : 'Calculate Debtors Income' }}
                                <img src="{{ asset('assets/img/ai_icon.png') }}" alt="AI" class=""
                                    style="height:20px">
                            </a>
                        </div>
                    @endif
                    <div class="col-12">
                        {!! $paystubShowMore !!}
                    </div>

                    <div class="col-12">
                        <div class="light-gray-box-tittle-div mb-2">
                            <h2>
                                <div class="label-div mb-0 mt-2 mt-sm-0">{!! $title !!}</div>
                            </h2>
                            <div class="label-div mb-0">
                                <span class="text-danger fs-14px">You must enter the pay date before uploading pay
                                    stub:</span>
                                <span class="d-flex flex-wrap">
                                    <input type="text" name="" id="{{ $employer_id . '-' . $dataType }}"
                                        placeholder="MM/DD/YYYY"
                                        class="form-control date_filed d-inline py-2 w-auto my-1 my-md-0 mb-2" />
                                    <a href="javascript:void(0)"
                                        onclick="paystubUploadBtnClick(this, '{{ $employer_id . $dataType }}')"
                                        class="btn-new-ui-default upload_doc_line py-2  d-inline ms-0 ms-md-2 d-flex flex-nowrap my-md-0 mb-2 align-items-center my-1 mx-1 px-1"
                                        data-type="" data-text="" style="display: inline-block !important;"> <i
                                            class="fa fa-upload mr-1" aria-hidden="true"></i> Upload Pay stub(s) not
                                        listed below</a>
                                    <input type='file' onblur="removeActive(this)" required
                                        onchange="paystubFileSelect(event, '', {{ $employer_id }}, '', '{{ $dataType }}', 'custom', 'false', '{{ $for }}')"
                                        class="required" style="display:none;" name="document_file[]"
                                        id="{{ $employer_id . $dataType }}" accept="{{ $acceptType }}" />
                                </span>
                                @if (
                                    $isUploadedScreen &&
                                        !empty($uploadedDocumentsArray) &&
                                        in_array($dataType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                                    <a class="{{ empty($combinedForm) ? 'd-none' : '' }} view_client_btn p4px combined_doc_btn float_right"
                                        data-employer_id="{{ @$employer_id }}"
                                        data-url="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $dataType, 'employer_id' => @$employer_id]) }}"
                                        id="combined_{{ $dataType }}" href="javascript:void(0)"><i
                                            class="fa fa-file-pdf fa-lg" aria-hidden="true"></i> Combined PDF</a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row ">
                    @if (!empty($pay_dates))
                        @php
                            $pay_date = '';
                            $i = 1;
                        @endphp
                        @foreach ($pay_dates as $index => $data)
                            @php
                                $isCustomAdded = isset($data['custom_added']) && $data['custom_added'] ? true : false;
                                $overrideString = '';
                                $pay_date = Helper::validate_key_value('pay_date', $data);
                                $exists = $data['exists'] ?? false;
                                $existsData = Helper::validate_key_value('existsData', $data);
                                $overrideData = [];
                                $overrideData = Helper::searchForOverrideDate($pay_date, $completeList, $employer_id);
                                $status = " <span class='text-bold text-danger me-2'>Missing</span>";
                                $showOverrideSelect = true;
                                $showUploadSelect = '';
                                $docExists = false;
                                if ($exists == true) {
                                    $status = " <span class='text-bold text-success'>Entered</span>";
                                    $docExists = true;
                                    $showUploadSelect = 'hide-data';
                                    $showOverrideSelect = false;
                                }

                                $grossPay = '-';
                                $netPay = '-';

                                if (!empty($existsData) && is_array($existsData)) {
                                    $grossPay = array_sum(
                                        array_map('floatval', array_column($existsData, 'gross_pay_amount')),
                                    );
                                    $netPay = array_sum(
                                        array_map('floatval', array_column($existsData, 'net_pay_amount')),
                                    );
                                    $grossPay = '$' . $grossPay;
                                    $netPay = '$' . $netPay;
                                }

                                if (!empty($overrideData)) {
                                    $status = " <span class='text-bold text-success'>Entered</span>";
                                    $docExists = true;
                                    $showUploadSelect = 'hide-data';
                                    $showOverrideSelect = false;
                                    $grossPay = '$ ' . Helper::validate_key_value('gross_pay_amount', $overrideData);
                                    $netPay = '$ ' . Helper::validate_key_value('net_pay_amount', $overrideData);
                                    $overPayDate = Helper::validate_key_value('pay_date', $overrideData);
                                    $overrideString =
                                        "<small class='text-bold text-success'>Overridden with " .
                                        date('F d, Y', strtotime($overPayDate)) .
                                        '</small>';
                                }
                                $payDate = date('m/d/Y', strtotime($pay_date));
                                $isAssigned = false;
                                $matchingDocument = null;
                            @endphp
                            <div class="{{ $colSize }}">
                                <div class="row mt-2">
                                    <div class="{{ $colDateSize }} ">
                                        @if ($isUploadedScreen)
                                            @php
                                                $docId = '';
                                                if ($docExists) {
                                                    $docObj = is_array($existsData) ? reset($existsData) : [];
                                                    $docId = Helper::validate_key_value(
                                                        'document_id',
                                                        $docObj,
                                                        'radio',
                                                    );
                                                    if ($docId > 0) {
                                                        if (is_array($documentsAddedForThisEmployer)) {
                                                            $documentsAddedForThisEmployer[
                                                                $employer_id
                                                            ][] = (int) $docId;
                                                        }
                                                    }
                                                    $isAssigned = $docId > 0 ? true : false;
                                                    $showUploadSelect = $docId > 0 ? 'hide-data' : '';
                                                    $filteredDocuments = array_filter(
                                                        $uploadedDocumentsArray,
                                                        function ($document) use ($docId) {
                                                            return $document['id'] == $docId;
                                                        },
                                                    );

                                                    if (!empty($filteredDocuments)) {
                                                        $matchingDocument = reset($filteredDocuments);
                                                    }

                                                    $doclasscs = 'not-uploaded';
                                                    if ($docId > 0) {
                                                        $doclasscs = '';
                                                    }
                                                }
                                            @endphp
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="w-15 fs-14px"><!--input type="checkbox" class="{{ 'checkbox-span-' . $key . '-paystub-' . $pay_date }} checked_docs mr-1 {{ $isAssigned ? '' : 'hide-data' }}" data-item="{{ $employer_id }}_{{ $dataType }}" name="pdf_id[]" value="{{ $docId }}"-->&nbsp;</span>
                                                <span
                                                    class="w-85 fs-14px {{ $isCustomAdded ? 'text-custom-added' : '' }}">{{ date('M d, Y', strtotime($pay_date)) }}</span>
                                            </div>
                                        @else
                                            <div class="d-flex align-items-center">
                                                <span
                                                    class="w-14 fs-14px index-span text-bold">{{ $i . '. ' }}</span>
                                                <span
                                                    class="w-86 fs-14px pay-date-span {{ $isCustomAdded ? 'text-custom-added' : '' }}">{{ date('M d, Y', strtotime($pay_date)) }}</span>
                                            </div>
                                        @endif

                                    </div>
                                    @if ($isUploadedScreen)
                                        <div class="px-1 col-2">
                                            <span class="fs-14px {{ 'span-' . $key . '-paystub-' . $pay_date }}">
                                                {!! $status !!}
                                                {!! !$isAssigned && $docExists ? "<small class='text-bold'>(Not Assigned)</small>" : '' !!}
                                            </span>
                                        </div>
                                    @endif
                                    <div class="{{ $colActionSize }}">
                                        <span
                                            class="fs-14px me- paystub-status-span {{ !$isUploadedScreen ? 'span-' . $key . '-paystub-' . $pay_date : 'section-span-' . $key . '-paystub-' . $pay_date }}">

                                            @if (!$isUploadedScreen)
                                                {!! $status !!}
                                            @endif

                                            <a href="javascript:void(0)"
                                                onclick="paystubUploadBtnClick(this, '{{ $key . '-paystub-' . $pay_date }}')"
                                                class=" upload_doc_line btn-new-ui-default py-1 px-2 {{ $showUploadSelect }}"
                                                data-type="" data-text=""> <i class="fa fa-upload "
                                                    aria-hidden="true"></i>&nbsp;Upload&nbsp;Paystub</a>
                                            <input type='file' required
                                                onchange="paystubFileSelect(event, '{{ $payDate }}', {{ $employer_id }}, '{{ 'span-' . $key . '-paystub-' . $pay_date }}', '{{ $dataType }}', '', {{ !$isAssigned && $docExists ? 'true' : 'false' }}, '{{ $for }}')"
                                                class="required" style="display:none;" name="document_file[]"
                                                id="{{ $key . '-paystub-' . $pay_date }}"
                                                accept="{{ $acceptType }}" />
                                            @if (!$matchingDocument && !empty($documentuploaded))
                                                <span class="mx-2 select-input {{ $showUploadSelect }}">OR</span>
                                                <select name=""
                                                    class="select-input form-control select-custom-padding-paystub w-auto d-inline {{ $showUploadSelect }}"
                                                    onchange="paystubFileSelect(event, '{{ $payDate }}', {{ $employer_id }}, '{{ 'span-' . $key . '-paystub-' . $pay_date }}', '{{ $dataType }}', '', 'false', '{{ $for }}' )">
                                                    <option value="">Choose uploaded Doc</option>
                                                    @foreach ($documentuploaded as $docData)
                                                        <option
                                                            value="{{ Helper::validate_key_value('id', $docData, 'radio') }}">
                                                            {{ Helper::validate_key_value('updated_name', $docData) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if (!empty($matchingDocument))
                                                <span class="paystub-accept-decline-section mx-2">
                                                    @include('attorney.doc_mgmt.btn_actions', [
                                                        'data' => $matchingDocument,
                                                        'doc_pay_date' => $pay_date,
                                                    ])
                                                </span>
                                            @endif

                                        </span>
                                        @if (!empty($matchingDocument))
                                            <select name=""
                                                class="select-input form-control select-custom-padding-paystub w-auto d-inline"
                                                onchange="paystubChangeSelect(event, {{ $employer_id }}, {{ $docId }})">
                                                <option value="">Transfer to Paydate</option>
                                                @foreach ($pay_dates as $paydateli)
                                                    <option
                                                        value="{{ Helper::validate_key_value('pay_date', $paydateli) }}">
                                                        {{ date('M d, Y', strtotime(Helper::validate_key_value('pay_date', $paydateli))) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                    </div>
                                </div>
                                @if ($exists == false)
                                    <div class="px-1">
                                        <div style="text-align:left;">
                                            <div class="form-check form-group mb-0">
                                                <label
                                                    for="dont_have_paystub_{{ $payDate }}_{{ $employer_id }}"
                                                    class="ml-1 {{ $isUploadedScreen ? 'hide-data' : '' }} mb-0 form-check-label"
                                                    style="font-size:10px;">
                                                    <input
                                                        {{ is_array($not_own_paystub) && !empty($not_own_paystub) && in_array($payDate, $not_own_paystub) ? 'checked' : '' }}
                                                        class="form-check-input" type="checkbox"
                                                        id="dont_have_paystub_{{ $payDate }}_{{ $employer_id }}"
                                                        onclick="makrnotOwnPaystub('{{ @$client_id }}','{{ $payDate }}','{{ $employer_id }}',this)">
                                                    I don't have this Pay Stub
                                                </label>
                                            </div>
                                            <label
                                                class="ml-3 {{ is_array($not_own_paystub) && !empty($not_own_paystub) && in_array($payDate, $not_own_paystub) && $isUploadedScreen ? '' : 'hide-data' }} text-c-red">(Client
                                                selected this Pay Stub not available)</label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            @php $i++; @endphp
                        @endforeach
                    @endif
                    <div class="col-md-12">
                        <p class="mt-3 text-center text-bold"><span class="text-danger">Sometimes pay stubs don't
                                match the exact date. Upload the closet date to whats listed for each if this is the
                                case.</span></p>
                    </div>
                    @if (isset($_GET['employer_id']) &&
                            $_GET['employer_id'] == $employer_id &&
                            isset($mainData['document_type']) &&
                            in_array($mainData['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                        <div class="col-md-12"
                            id="select_{{ $employer_id }}_{{ str_replace(' ', '_', $mainData['document_type']) }}">
                            <form id="{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                action="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]) }}"
                                method="GET">
                                <table width="100%"
                                    id="pageList_{{ $employer_id }}_{{ str_replace(' ', '_', $mainData['document_type']) }}">

                                    <tr style="border-bottom:1px solid #50cbcb">
                                        <td colspan='4'>

                                            @if ($paystbcount > 0 || in_array($mainData['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                                                <input
                                                    class="ml-2 parent_{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                    type="checkbox"
                                                    onclick="checkChildCheckboxes(this,'{{ $mainData['document_type'] }}',{{ $employer_id }})"
                                                    value="1"
                                                    id="label_for_{{ $employer_id }}_{{ $mainData['document_type'] }}">
                                                <label
                                                    for="label_for_{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                    class="click_all_docs">Click to Select All Doc(s) </label>
                                            @endif
                                            <a class="float-right  view_client_btn delete_doc_btn p4px hide-data"
                                                data-item="{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                data-url="{{ route('delete_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]) }}"
                                                id="bulkdelete_{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                href="javascript:void(0)"><i class="fa fa-file-trash fa-lg"
                                                    aria-hidden="true"></i> Delete Selected</a>
                                            <a href="javascript:void(0)"
                                                class="ml-5 view_client_btn p4px accept_all dnpv hide-data"
                                                data-item="{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                data-url="{{ route('accept_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]) }}"
                                                id="bulkaccept_{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                href="javascript:void(0)"> Accept All</a> <a
                                                class="ml-1 view_client_btn btn-danger p4px decline_all hide-data"
                                                data-item="{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                data-url="{{ route('decline_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => $employer_id]) }}"
                                                id="bulkdecline_{{ $employer_id }}_{{ $mainData['document_type'] }}"
                                                href="javascript:void(0)">Decline All</a>

                                        </td>
                                    </tr>


                                    @include('attorney.client_uploaded_multiple_document', [
                                        'documentuploaded' => $mainData['multiple'] ?? [],
                                        'documentsAddedForThisEmployer' => $docForThisEmployer,
                                        'employer_id' => $employer_id,
                                    ])

                                </table>
                            </form>

                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
</section>
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/pay_check_calculation.css') }}">
@endpush
@push('tab_scripts')
    <script>
        window.__payCheckCalculationRoutes = {
            paystubDateChange: "{{ route('client_paystub_date_change') }}",
            clientDocumentUploads: "{{ route('client_document_uploads') }}"
        };
        window.__payCheckCalculationData = {
            clientId: "{{ @$client_id }}",
            isAdmin: "{{ Auth::user() ? Auth::user()->role == 1 : 0 }}",
            route: "{{ isset($route) && !empty($route) ? $route : '' }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/pay_check_calculation.js') }}"></script>
@endpush
