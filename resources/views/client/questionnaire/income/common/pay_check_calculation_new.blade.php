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
    $mark_not_own_paystub_route = route('mark_not_own_paystub');
@endphp

<input type="hidden" name="document_type" id="document_types" value="{{ $dataType }}">

<div class="header-notice p-3 mb-3">
    The Court requires you to submit pay stubs for the pay dates listed for each employer listed below. To make this
    process easier for you, please upload each paystub corresponding to the specified pay dates.
</div>

<div class="info-banner p-3 mb-4">
    BKQ will keep track of what pay stubs are needed and which one you have uploaded.
</div>




@foreach ($payCheckData as $key => $value)
    @php
        $startDate = Helper::validate_key_value('startDate', $value);
        $endDate = Helper::validate_key_value('endDate', $value);

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
        $paystbcount = is_array(value: $docForThisEmployer) ? count($docForThisEmployer) : 0;
        $title = 'Employer';
        if (!empty($emp_data)) {
            $title = '<span>' . Helper::validate_key_value('employer_name', $emp_data) . '</span> ';
            if(!empty($value['clientFrequency']) && is_string($value['clientFrequency'])) {
                $title .=
                    '<small class="text-c-blue ml-1">(Pay Dates based upon: <span class="text-bold text_underline">' .
                    $value['clientFrequency'] .
                    '</span> frequency)</small> ';
            }
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

            $lastSixMonthPayStubDates = array_filter($lastSixMonthPayStubDates, function ($date) use ($currentDate) {
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
    <div class="employer-card mb-4">
        <div class="employer-header p-3 row" data-bs-toggle="collapse" data-bs-target="#{{ 'paystub-section-' . $key }}"
            aria-expanded="true">
            <div class="col-12 col-md-5">
                <h3 class="fs-5 mb-0 text-start accordian-label">
                    {{ ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) . ': ' }}
                    {{ !empty(Helper::validate_key_value('employer_name', $emp_data)) ? Helper::validate_key_value('employer_name', $emp_data) : 'Employer' }}
                </h3>
                @if(!empty(Helper::validate_key_value('clientFrequency', $value)) && is_string(Helper::validate_key_value('clientFrequency', $value)))
                <div class="frequency mt-1">Pay dates frequency:
                    {{ Helper::validate_key_value('clientFrequency', $value) }}</div>
                @endif
            </div>
            <div class="col-12 col-md-6 d-flex align-items-center ">
                <h6 class="blink text-c-red mb-0">
                    <strong>
                        @if (!empty($countFalse))
                            Please upload your missing pay stubs by clicking here. Missing Pay Stubs:
                            {{ $countFalse }}
                        @else
                            <span class="text-success">All Court required pay stubs for this employer are
                                uploaded.</span>
                        @endif
                    </strong>
                </h6>
            </div>
            <div class="col-12 col-md-1 d-flex align-items-center toggle-icon">
                <i class="bi bi-chevron-down fs-5 ml-auto"></i>
            </div>
        </div>

        <div class="collapse {{ $key == 0 ? 'show' : '' }}" id="{{ 'paystub-section-' . $key }}">
            <div class="card-body border-0">
                <div class="notice p-3 mb-3">
                    Sometimes paystubs don't match the exact date. Upload the closest date to what's listed for each if
                    this is the case.
                </div>

                <div class="row gy-3">

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
                                $status = 'missing';
                                $showOverrideSelect = true;
                                $showUploadSelect = '';
                                $docExists = false;
                                $thisPaystubId = '';
                                $thisPaystubDocId = '';
                                if ($exists == true) {
                                    $status = 'uploaded';
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
                                    $existsDataFirst = reset($existsData);
                                    $thisPaystubId = Helper::validate_key_value('id', $existsDataFirst, 'radio');
                                    $thisPaystubDocId = Helper::validate_key_value(
                                        'document_id',
                                        $existsDataFirst,
                                        'radio',
                                    );
                                }

                                if (!empty($overrideData)) {
                                    $status = 'uploaded';
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
                                $paystubDate = date('M d, Y', strtotime($pay_date));
                                $paystubDeleteRoute = route('paystub_delete_client_side');
                            @endphp

                            <!-- Payslip Item 1 -->
                            <div
                                class="col-12 col-sm-6 col-md-6 col-lg-4 {{ isset($isClientDocPage) && $isClientDocPage ? 'col-xl-4' : 'col-xl-3' }}">
                                <div class="payslip-item p-3" id="payslip-{{ $index }}">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <div class="payslip-date">
                                            <strong class="date-label">{{ $i }}.
                                                {{ $paystubDate }}</strong>
                                            @if ($status == 'missing')
                                                <span class="status missing ms-2">Missing</span>
                                            @elseif ($status == 'uploaded')
                                                <span class="status uploaded ms-2">Uploaded</span>
                                            @endif
                                            {!! $isCustomAdded ? '<span class="status additional ms-2">Additional</span>' : '' !!}
                                        </div>
                                    </div>

                                    <a href="javascript:void(0)"
                                        onclick="paystubUploadBtnClick(this, '{{ $key }}-paystub-{{ $pay_date }}-{{ $employer_id }}')"
                                        class="btn-new-ui-default px-3  upload-btn mb-1 d-block text-center w-100 position-relative"
                                        data-type="" data-text="">
                                        <i
                                            class="bi bi-cloud-arrow-up me-2"></i>{!! $status == 'missing' ? 'Upload&nbsp;Pay&nbsp;Stub' : 'Replace&nbsp;Pay&nbsp;Stub' !!}
                                    </a>
                                    <input type='file' required
                                        onchange="paystubFileSelect(event, '{{ $payDate }}', {{ $employer_id }}, '{{ 'span-' . $key . '-paystub-' . $pay_date . '-' . $employer_id }}', '{{ $dataType }}', '', {{ !$isAssigned && $docExists ? 'true' : 'false' }}, '{{ $for }}')"
                                        class="required" style="display:none;" name="document_file[]"
                                        id="{{ $key }}-paystub-{{ $pay_date }}-{{ $employer_id }}"
                                        accept="{{ $acceptType }}" />

                                    <label for="dont_have_paystub_{{ $payDate }}_{{ $employer_id }}"
                                        class="no-paystub-label btn-new-ui-default px-3 custom-not-available-btn {{ is_array($not_own_paystub) && !empty($not_own_paystub) && in_array($payDate, $not_own_paystub) ? 'active' : '' }} {{ $exists == false && $status == 'missing' ? '' : 'hide-data' }}"
                                        data-payslip-id="{{ $index }}">
                                        <input
                                            {{ is_array($not_own_paystub) && !empty($not_own_paystub) && in_array($payDate, $not_own_paystub) ? 'checked' : '' }}
                                            class="form-check-input" type="checkbox"
                                            id="dont_have_paystub_{{ $payDate }}_{{ $employer_id }}"
                                            onclick="makrnotOwnPaystubClNew('{{ @$client_id }}','{{ $payDate }}','{{ $employer_id }}','{{ $mark_not_own_paystub_route }}',this)"
                                            style="display:none;">
                                        I don't have this Pay Stub
                                    </label>
                                    <label
                                        class="delete-paystub-label btn-new-ui-default px-3 custom-not-available-btn delete {{ $status == 'missing' ? 'hide-data' : '' }} "
                                        onclick="deletePaystubFromClientSide(this, '{{ $paystubDeleteRoute }}', '{{ $thisPaystubId }}', '{{ $thisPaystubDocId }}', '{{ $paystubDate }}', '{{ @$client_id }}')">
                                        <i class="bi bi-trash3 mr-1"></i> Delete Pay Stub
                                    </label>
                                </div>
                            </div>

                            @php $i++; @endphp
                        @endforeach
                    @endif

                    <!-- Additional Payslip Item -->
                    <div
                        class="col-12 col-sm-6 col-md-6 col-lg-4 {{ isset($isClientDocPage) && $isClientDocPage ? 'col-xl-4' : 'col-xl-3' }}">
                        <div class="payslip-item p-3" id="payslip-additional-{{ $key }}">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="payslip-date mb-1">
                                    <span class="blink text-c-red"><strong>If you have additional pay stubs and/or any
                                            pay dates that don't match above please upload them here.</strong> <i
                                            class="fa fa-arrow-down"></i></span></br>
                                    <!--strong class="text-c-blue">Please enter the pay date first then upload the pay stub</strong-->
                                </div>
                            </div>
                            <div class="label-div mb-1">
                                <div class="form-group">
                                    <div class="input-group">
                                        @if (isset($isClientDocPage) && $isClientDocPage)
                                            <a href="javascript:void(0)"
                                                class="w-100 d-block text-center upload_doc_line view_client_btn"
                                                onclick="showPopupUploadArea('{{ $employer_id }}')"
                                                data-type="{{ $dataType }}" data-text="{{ $dataType }}"> <i
                                                    class="fa fa-upload" aria-hidden="true"></i> Click to Upload
                                                File(s)</a>
                                        @else
                                            <a href="javascript:void(0)"
                                                class="w-100 d-block text-center upload_doc_line view_client_btn"
                                                onclick="both_upload_modal('{{ $dataType }}',$(this).data('text'), '', 0 , 0,1,0,'{{ $employer_id }}' )"
                                                data-type="{{ $dataType }}" data-text="{{ $dataType }}"> <i
                                                    class="fa fa-upload" aria-hidden="true"></i> Click to Upload
                                                File(s)</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endforeach
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
    <script src="{{ asset('assets/js/client/pay_check_calculation_new.js') }}"></script>
@endpush
