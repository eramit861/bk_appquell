@php
$mainData = $isUploadedScreen ? $data : [];

if (!isset($dataType) || empty($dataType) || !in_array($dataType, [\App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB, \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB])) {
    $dataType = $isUploadedScreen ? $mainData['document_type'] : '';
}

if (!isset($colSize) || empty($colSize)) {
    $colSize = 'col-xxl-6 col-xl-6 col-lg-6 col-sm-12 col-md-6';
}
$documentsAddedForThisEmployer = [];
$colDateSize = $isUploadedScreen ? 'col-xxl-3 col-xl-3 col-lg-3 col-sm-3 col-3 col-md-3' : 'col-xxl-5 col-xl-5 col-lg-5 col-sm-5 col-5 col-md-5';
$colActionSize = $isUploadedScreen ? 'col-xxl-7 col-xl-7 col-lg-7 col-sm-7 col-7 col-md-7' : 'col-xxl-7 col-xl-7 col-lg-7 col-sm-7 col-7 col-md-7';
$uploadedDocumentsArray = $isUploadedScreen && isset($mainData['multiple']) ? $mainData['multiple'] : [];
$currentDate = \Carbon\Carbon::now();

$assignedDocs = [];
$unassignedDocIds = [];

foreach ($payCheckData as $key => $asnadocs) {
    $pay_dates_list = Helper::validate_key_value('pay_dates_list', $asnadocs);
    $pay_datesas = Helper::validate_key_value('pay_dates', $asnadocs);
    $pay_datesas = !empty($pay_datesas) ? array_reverse($pay_datesas) : [];

    if (!empty($pay_dates_list)) {
        foreach ($pay_dates_list as $index => $uppaydates) {
            $uploadedDocId = Helper::validate_key_value('document_id', $uppaydates, 'radio');
            if ($uploadedDocId > 0) {
                $assignedDocs[] = $uploadedDocId;
            }
        }
    }

    if (!empty($pay_datesas)) {
        foreach ($pay_datesas as $index => $asdata) {
            $existsDataAd = Helper::validate_key_value('existsData', $asdata);
            $docObjAs = is_array($existsDataAd) ? reset($existsDataAd) : [];
            $docIdas = Helper::validate_key_value('document_id', $docObjAs, 'radio');
            if ($docIdas > 0) {
                $assignedDocs[] = $docIdas;
            }
        }
    }
}

if (isset($data['multiple'])) {
    $allDocsArray = array_column($data['multiple'], 'id');
    $unassignedDocIds = array_diff($allDocsArray, $assignedDocs);
}
$showNewDocs = false;
foreach ($data['multiple'] as $key => $unassignObject) {
    if (isset($unassignedDocIds) && !in_array($unassignObject['id'], $unassignedDocIds)) {
        continue;
    }
    if ($unassignObject['is_viewed_by_attorney'] == 0) {
        $showNewDocs = true;
    }
}

$docUploaded = $mainData['multiple'] ?? [];
foreach ($docUploaded as $key => $data) {
    if (isset($unassignedDocIds) && in_array($data['id'], $unassignedDocIds)) {
        $documentuploaded = array_merge($documentuploaded, [$key => $data]);
    }
}
@endphp
<div class="mt-2"></div>
@if(count($unassignedDocIds) > 0 && isset($data['document_type']) && in_array($data['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
    <form id="{{ $mainData['document_type'] }}" class="main_form_{{ $mainData['document_type'] }}" data-parentKey="{{ $parentKey }}"
        action="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => null]) }}"
        method="GET">
        @include('attorney.uploaded_doc_view.docUnassignedForPayStubFormData', ["documentuploaded" => $mainData['multiple'] ?? [], 'documentsAddedForThisEmployer' => $unassignedDocIds, 'objKey' => $mainData['document_type']])
    </form>
@endif

<input type="hidden" name="document_type" id="document_types" value="{{ $dataType }}">
@foreach($payCheckData as $key => $value)
    @php
    $startDate = Helper::validate_key_value('startDate', $value);
    $endDate = Helper::validate_key_value('endDate', $value);

    $class = "";
    $emp_data = Helper::validate_key_value('emp_data', $value);

    $not_own_paystub = Helper::validate_key_value('not_own_paystub', $emp_data);
    $employer_id = Helper::validate_key_value('id', $emp_data);
    $pay_dates = Helper::validate_key_value('pay_dates', $value);
    $pay_dates = !empty($pay_dates) ? array_reverse($pay_dates) : [];
    $pay_dates_list = Helper::validate_key_value('pay_dates_list', $value);

    $docForThisEmployer = is_array($pay_dates_list) ? array_column($pay_dates_list, 'document_id') : [];
    $docForThisEmployer = array_filter($docForThisEmployer, function ($value) {
        return $value !== null;
    });
    $overrideCount = Helper::validate_key_value('overrideCount', $value);
    $countFalse = 0;
    $mainTitle = '';
    $paystubShowMore = '';
    $paystbcount = is_array($docForThisEmployer) ? count($docForThisEmployer) : 0;
    $title = 'Employer';
    if (!empty($emp_data) && !is_array(Helper::validate_key_value('clientFrequency', $value))) {
        $title = '<span class="text-bold fs-14px">' . Helper::validate_key_value('employer_name', $emp_data) . '</span> ';
        $title .= '<span class="text-c-blue ml-2 fs-14px">(Pay Dates based upon: <span class="text-bold text_underline">' . Helper::validate_key_value('clientFrequency', $value) . '</span> frequency)</span> ';
     
        if (in_array(Helper::validate_key_value('employer_type', $emp_data, 'radio'), [1, 2, 3, 4, 5, 6])) {
            $end_date = Helper::validate_key_value('end_date', $emp_data);
            $mainTitle = '<p class="mb-1 fs-14px">
                    <span class="text-bold border-bottom-light-blue">' . ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) . ':</span>' .
                (!empty($end_date) ? '<span class="recent-pay-date"> (Most recent paystub pay date: ' . date("M d, Y", strtotime($end_date)) . ')</span>' : '') .
                '</p>';
            
            if ($isUploadedScreen && $paystbcount > 0) {
                $paystubShowMore = '<a class="text-underline float-right text-c-black" href="' . route('attorney_client_uploaded_documents', ['id' => $val['id']]) . ((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id) ? '' : '?type=' . $dataType . '&employer_id=' . $employer_id) . '"> 
                        <span class="read-more-less" style="font-size:10px;">' . (((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id) ? 'Hide ' : 'Click to Show ') . $paystbcount . ' doc(s)') . ' <i class="fa fa-angle-' . ((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id) ? 'up' : 'down') . '" aria-hidden="true"></i></span>
                    </a>';
            }
        } else {
            $end_date = Helper::validate_key_value('end_date', $emp_data);
            $mainTitle = '<p class=" mb-1 fs-14px">
                                        <span class="text-bold border-bottom-light-blue">' . ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) . ':</span>' .
                (!empty($end_date) ? '<span class="recent-pay-date"> (Most recent paystub pay date: ' . date("M d, Y", strtotime($end_date)) . ')</span>' : '')
                . '</p> ';
            
            if ($isUploadedScreen && $paystbcount > 0) {
                $paystubShowMore = '<a class="text-underline float-right text-c-black" href="' . route('attorney_client_uploaded_documents', ['id' => $val['id']]) . ((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id) ? '' : '?type=' . $dataType . '&employer_id=' . $employer_id) . '"> 
                            <span class="read-more-less" style="font-size:10px;">' . (((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id) ? 'Hide ' : 'Click to Show ') . $paystbcount . ' doc(s)') . ' <i class="fa fa-angle-' . ((isset($_GET['employer_id']) && $_GET['employer_id'] == $employer_id) ? 'up' : 'down') . '" aria-hidden="true"></i></span>
                        </a>';
            }
        }
    }
    
    $datesCount = count($pay_dates);
    $countFalse = count(array_filter($pay_dates, fn ($pd) => !$pd['exists']));
    $countFalse = ($countFalse - (int)$overrideCount);
    $missingCount = '<span class="text-danger text-bold ">Missing: ' . $countFalse . '</span>';
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
            $existsInPayDates = array_filter($pay_dates, fn ($pay) => $pay['pay_date'] === $date);

            // If the date is missing in $pay_dates, add a new object
            if (empty($existsInPayDates)) {
                // Search for the date in $pay_dates_list to set "exists" and "existsData"
                $matchingData = array_filter($pay_dates_list, fn ($list) => $list['pay_date'] === $date);

                // If there's a match in $pay_dates_list with document_id > 0, set "exists" to true and add "existsData"
                if (!empty($matchingData)) {
                    $matchingData = reset($matchingData); // Get the first matching item

                    $newEntry = [
                        'custom_added' => true,
                        'pay_date' => $date,
                        'exists' => $matchingData['document_id'] > 0,
                        'existsData' => $matchingData['document_id'] > 0 ? [$matchingData] : null
                    ];
                } else {
                    // No match found in $pay_dates_list, set "exists" to false
                    $newEntry = [
                        'custom_added' => true,
                        'pay_date' => $date,
                        'exists' => false,
                        'existsData' => []
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

    $for = '';
    $hasButton = false;
    @endphp
    @if (!is_array(Helper::validate_key_value('clientFrequency', $value)))
    <div class="employer-card border-1px-tab-link-color mb-4 {{ $key }}">
        <div class="employer-header accordian-with-docs-employer-header border-bottom-default " data-bs-toggle="collapse" data-bs-target="#{{ 'paystub-section-'.$key.$dataType }}" aria-expanded="true">
            <div class="row">
                <!-- Employer Info -->
                <div class="col-12 col-md-11 mb-3 mb-md-0">
                    <h3 class="fs-5 mb-0 text-start accordian-label d-flex-ai-center">
                        {{ ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)) }}: 
                        @if(!empty(Helper::validate_key_value('employer_name', $emp_data)))
                            {{ Helper::validate_key_value('employer_name', $emp_data) }}
                        @else
                            Employer
                        @endif
                    </h3>
                    <div class="frequency mt-1">
                        Pay dates frequency: {{ Helper::validate_key_value('clientFrequency', $value) }}
                    </div>
                    <h6 class="blink text-left text-c-red mb-0">
                        <strong>
                            @if(!empty($countFalse))
                                Please upload your missing pay stubs by clicking here. Missing Pay Stubs: {{ $countFalse }}
                            @else
                                <span class="text-success">All Court required pay stubs for this employer are uploaded.</span>
                            @endif
                        </strong>
                    </h6>
                </div>

                <!-- Toggle Icon -->
                <div class="col-12 col-md-1 d-flex justify-content-end align-items-center toggle-icon">
                    <i class="bi bi-chevron-down fs-5"></i>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="collapse mb-3 {{ (isset($expandableDiv) && $expandableDiv) && (isset($expandableEmpId) && $expandableEmpId == @$employer_id) ? ' show' : '' }}" id="{{ 'paystub-section-'.$key.$dataType }}">
        <div class="card-body main_form_{{ $childObjKey }}_{{ @$employer_id }}" id="{{ $childObjKey }}_{{ @$employer_id }}">

            <div class="notice p-3 mb-3">
                Sometimes paystubs don't match the exact date. Upload the closest date to what's listed for each if this is the case.
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <!-- Left: AI Button -->
                <div>
                    @if(in_array($dataType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                        @if($dataType == 'Debtor_Pay_Stubs')
                            @php $for = "Debtor"; @endphp
                        @endif
                        @if($dataType == 'Co_Debtor_Pay_Stubs')
                            @php $for = ($client_type == 2) ? "Non-Filing Spouse" : "Co-Debtor"; @endphp
                        @endif
                        @php $hasButton = true; @endphp
                        
                        <a href="javascript:void(0)" onclick="calculateUploadBtnClick('{{ $dataType }}', '{{ $for }}', '{{ $employer_id }}')" class="view_client_btn calculate-dt-income" data-type="" data-text="">
                            @if($dataType == "Co_Debtor_Pay_Stubs")
                                Calculate Co-Debtor's Income
                            @else
                                Calculate Debtor's Income
                            @endif
                            <img src="{{ asset('assets/img/ai_icon.png')}}" alt="AI" class="" style="height:20px">
                        </a>
                    @endif
                </div>

                <!-- Right: Combined PDF Button -->
                <div>
                    @if($isUploadedScreen && !empty($uploadedDocumentsArray) && in_array($dataType, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                        @php $hasButton = true; @endphp

                        <a class="hide-on-mobile float-right h-fit-content ml-auto p-2 upload-doc-btn view_client_btn p4px reorder_doc_btn mt-1 mt-sm-0"
                            data-ptype='unassign'
                            data-url="{{ route('get_document_for_combine', ['id' => $val['id'], 'type' => $dataType, 'employer_id' => @$employer_id]) }}"
                            id="common_doc_combine_btn_{{ $dataType.'_'.@$employer_id }}"
                            href="javascript:void(0)">
                            <i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>&nbsp;Combined&nbsp;PDF
                        </a>
                    @endif
                </div>
            </div>


            <div class="row gy-3">
                @if(!empty($pay_dates))
                    @php
                    $pay_date = '';
                    $i = 1;
                    @endphp
                    
                    @foreach($pay_dates as $index => $data)
                        @php
                        $isCustomAdded = (isset($data['custom_added']) && $data['custom_added']) ? true : false;
                        $overrideString = "";
                        $pay_date = Helper::validate_key_value('pay_date', $data);
                        $exists = $data['exists'] ?? false;
                        $existsData = Helper::validate_key_value('existsData', $data);
                        $overrideData = [];
                        $overrideData = Helper::searchForOverrideDate($pay_date, $completeList, $employer_id);
                        $status = 'missing';
                        $showOverrideSelect = true;
                        $showUploadSelect = "";
                        $docExists = false;
                        $thisPaystubId = '';
                        $thisPaystubDocId = '';
                        
                        if ($exists == true) {
                            $status = 'uploaded';
                            $docExists = true;
                            $showUploadSelect = "hide-data";
                            $showOverrideSelect = false;
                        }

                        $grossPay = '-';
                        $netPay = '-';

                        if (!empty($existsData) && is_array($existsData)) {
                            $grossPay = array_sum(array_map('floatval', array_column($existsData, 'gross_pay_amount')));
                            $netPay = array_sum(array_map('floatval', array_column($existsData, 'net_pay_amount')));
                            $grossPay = '$' . $grossPay;
                            $netPay = '$' . $netPay;
                            $existsDataFirst = reset($existsData);
                            $thisPaystubId = Helper::validate_key_value('id', $existsDataFirst, 'radio');
                            $thisPaystubDocId = Helper::validate_key_value('document_id', $existsDataFirst, 'radio');
                        }

                        if (!empty($overrideData)) {
                            $status = 'uploaded';
                            $docExists = true;
                            $showUploadSelect = "hide-data";
                            $showOverrideSelect = false;
                            $grossPay = '$ ' . Helper::validate_key_value('gross_pay_amount', $overrideData);
                            $netPay = '$ ' . Helper::validate_key_value('net_pay_amount', $overrideData);
                            $overPayDate = Helper::validate_key_value('pay_date', $overrideData);
                            $overrideString = "<small class='text-bold text-success'>Overridden with " . date("F d, Y", strtotime($overPayDate)) . "</small>";
                        }
                        
                        $payDate = date('m/d/Y', strtotime($pay_date));
                        $isAssigned = false;
                        $matchingDocument = null;
                        $paystubDate = date("M d, Y", strtotime($pay_date));
                        $paystubDeleteRoute = route('paystub_delete_client_side');
                        
                        if ($isUploadedScreen) {
                            $docId = '';
                            if ($docExists) {
                                $docObj = is_array($existsData) ? reset($existsData) : [];
                                $docId = Helper::validate_key_value('document_id', $docObj, 'radio');
                                if ($docId > 0) {
                                    if (is_array($documentsAddedForThisEmployer)) {
                                        $documentsAddedForThisEmployer[$employer_id][] = (int)$docId;
                                    }
                                }
                                $isAssigned = $docId > 0 ? true : false;
                                $showUploadSelect = $docId > 0 ? 'hide-data' : '';
                                $filteredDocuments = array_filter($uploadedDocumentsArray, function ($document) use ($docId) {
                                    return $document['id'] == $docId;
                                });

                                if (!empty($filteredDocuments)) {
                                    $matchingDocument = reset($filteredDocuments);
                                }

                                $doclasscs = 'not-uploaded';
                                if ($docId > 0) {
                                    $doclasscs = '';
                                }
                            }
                        }
                        @endphp


                        <!-- Payslip Item -->
                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 {{ (isset($isClientDocPage) && $isClientDocPage) ? 'col-xl-4' : 'col-xl-3' }}">
                            <div class="payslip-item p-3" id="payslip-{{ $index }}">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="payslip-date w-100 align-items-center d-flex">
                                        <strong class="date-label">{{ $i }}. {{ $paystubDate }}</strong>
                                        @if($status == 'missing')
                                            <span class="status missing ms-2">Missing</span>
                                        @elseif($status == 'uploaded')
                                            <span class="status uploaded ms-2">Uploaded
                                                @if($isUploadedScreen && !$isAssigned && $docExists)
                                                    (Not Assigned)
                                                @endif
                                            </span>
                                        @endif
                                        @if($isCustomAdded)
                                            <span class="status additional ms-2">Additional</span>
                                        @endif
                                        
                                        @if(!empty($matchingDocument) && $matchingDocument['document_type'] != "requested_documents" && (!is_array($matchingDocument['document_file']) && !empty($matchingDocument['document_file'])))
                                            @php
                                            $filePth = null;
                                            // Check if file is stored on S3
                                            if ($matchingDocument['is_uploaded_to_s3'] == 1) {
                                                if (config('filesystems.disks.s3.bucket')) {
                                                    try {
                                                        $filePth = Storage::disk('s3')->temporaryUrl($matchingDocument['document_file'], now()->addDays(2));
                                                    } catch (\Exception $e) {
                                                        \Log::error('S3 temporaryUrl failed in pay_check_calculation: ' . $e->getMessage());
                                                        $filePth = null;
                                                    }
                                                }
                                            } else {
                                                $filePth = asset('storage/' . $matchingDocument['document_file']);
                                            }
                                            @endphp
                                            <input type="checkbox" class="checked_docs d-none" data-item="{{ $dataType }}" name="pdf_id[]" value="{{ $docId }}" checked>
                                            <a href="javascript:void(0)" data-url="{{ $filePth }}" data-docid="{{ $docId }}" data-clientid="{{ $client_id }}" class="openPdf text-c-blue ml-auto" title="Download {{ Helper::validate_key_value($childObjKey, $allDocNames) }}"> 
                                                <i style="font-size:22px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                <a href="javascript:void(0)" onclick="paystubUploadBtnClickUploadedPage(this, '{{ $key }}-paystub-{{ $pay_date }}-{{ $employer_id }}')" class="btn-new-ui-default px-3 upload-btn mb-1 d-block text-center w-100 position-relative" data-type="" data-text="">
                                    <i class="bi bi-cloud-arrow-up me-2"></i>
                                    @if($status == 'missing')
                                        Upload&nbsp;Pay&nbsp;Stub
                                    @else
                                        Replace&nbsp;Pay&nbsp;Stub
                                    @endif
                                </a>
                                
                                <input type='file' required
                                    onchange="paystubFileSelectUploadedPage(event, '{{ $payDate }}', {{ $employer_id }}, '{{ 'span-' . $key . '-paystub-' . $pay_date . '-' . $employer_id }}', '{{ $dataType }}', '', {{ (!$isAssigned && $docExists) ? 'true' : 'false' }}, '{{ $for }}')"
                                    class="required"
                                    style="display:none;"
                                    name="document_file[]"
                                    id="{{ $key }}-paystub-{{ $pay_date }}-{{ $employer_id }}"
                                    accept="{{ $acceptType }}" />

                                @if(!empty($matchingDocument) || !$matchingDocument)
                                    <div class="row g-2 mt-2">
                                        @if(!empty($matchingDocument) && !isset($is_main) && !in_array($matchingDocument['document_type'], $cardsArray))
                                            @php
                                            $docId = $matchingDocument['id'];
                                            $docType = $matchingDocument['document_type'];
                                            @endphp
                                            <div class="col-12 col-md-6">
                                                <div class="btn-group ms-2 mb-0 label-div" id="document_{{ $docId }}">
                                                    <button class="form-select form-select-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Move Document to...
                                                    </button>
                                                    <div class="dropdown-menu" 
                                                        data-doc_id='{{ $docId }}'
                                                        data-client_id='{{ $client_id }}'
                                                        data-prev_selected_value='{{ $docType }}'
                                                        data-pay_date='{{ (isset($pay_date) && !empty($pay_date)) ? $pay_date : '' }}'
                                                        data-select_employer_id='{{ $employer_id }}'
                                                    >
                                                        @foreach($documentMoveToList as $key => $option)
                                                            @if($key == $docType && !in_array($key, ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                                                                @continue
                                                            @endif
                                                            {!! $option !!}
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if(!empty($matchingDocument))
                                            <div class="col-12 col-md-6">
                                                <select name="" class="select-input form-select form-select-sm" onchange="paystubChangeSelectUploadedPage(event, {{ $employer_id }}, {{ $docId }}, '{{ $docType }}')">
                                                    <option value="">Transfer to Paydate</option>
                                                    @foreach($pay_dates as $paydateli)
                                                        <option value="{{ Helper::validate_key_value('pay_date', $paydateli) }}">{{ date("M d, Y", strtotime(Helper::validate_key_value('pay_date', $paydateli))) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        
                                        <div class="col-12 col-md-6">
                                            @if(!$matchingDocument && !empty($documentuploaded))
                                                <select name="" class="select-input form-select form-select-sm {{ $showUploadSelect }}" onchange="paystubFileSelectUploadedPage(event, '{{ $payDate }}', {{ $employer_id }}, '{{ 'span-' . $key . '-paystub-' . $pay_date . '-' . $employer_id }}', '{{ $dataType }}', '', 'false', '{{ $for }}')">
                                                    <option value="">Choose uploaded Doc</option>
                                                    @foreach($documentuploaded as $docData)
                                                        <option value="{{ Helper::validate_key_value('id', $docData, 'radio') }}">{{ Helper::validate_key_value('updated_name', $docData) }}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                                @if($exists == false)
                                    <label class="{{ is_array($not_own_paystub) && !empty($not_own_paystub) && in_array($payDate, $not_own_paystub) && $isUploadedScreen ? '' : 'hide-data' }} mt-1 text-c-red mb-0">(Client selected this Pay Stub not available)</label>
                                @endif
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                @endif


                <!-- Additional Payslip Item -->
                <div class="col-12 col-sm-6 col-md-6 col-lg-4 {{ (isset($isClientDocPage) && $isClientDocPage) ? 'col-xl-4' : 'col-xl-3' }}">
                    <div class="payslip-item p-3 light-gray-div mb-0" id="payslip-additional-{{ $key }}">
                        <div class="mb-2">
                            <div class="payslip-date mb-1">
                                <div class="blink text-c-red" style="word-wrap: break-word; white-space: normal;">
                                    <span>If you have additional pay stubs and/or any pay dates that don't match above please upload them here.</span>
                                    <i class="fa fa-arrow-down"></i>
                                </div>
                            </div>
                        </div>

                        <div class="label-div mb-1">
                            <div class="form-group">
                                <div class="input-group bg-unset">
                                    <a href="javascript:void(0)" class="w-100 d-block text-center upload_doc_line view_client_btn" onclick="both_upload_modal('{{ $dataType }}',$(this).data('text'), '', 0 , 0,1 )" data-type="{{ $dataType }}" data-text="{{ Helper::validate_key_value($childObjKey, $allDocNames) }}"> 
                                        <i class="fa fa-upload" aria-hidden="true"></i> Click to Upload File(s)
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

<style>
    .upload-active {
        background-color: #f0ad4e !important;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        bindUnassignedCollapseHandlers("{{ str_replace(' ', '_', $mainData['document_type']) }}", {{ count($unassignedDocIds ?? []) }});
    });

    function bindUnassignedCollapseHandlers(documentType, docCount) {
        const collapseId = `unassigned_paystub_section_${documentType}`;
        const collapseElement = document.getElementById(collapseId);

        if (!collapseElement) return;

        const frequencyClass = `.unassigned_frequency_${documentType}`;
        const frequencyDiv = document.querySelector(frequencyClass);

        collapseElement.addEventListener('shown.bs.collapse', function () {
            if (frequencyDiv) {
                frequencyDiv.innerHTML = `Click to Hide ${docCount} doc(s)`;
            }
        });

        collapseElement.addEventListener('hidden.bs.collapse', function () {
            if (frequencyDiv) {
                frequencyDiv.innerHTML = `Click to Show ${docCount} doc(s)`;
            }
        });
    }

    var selectedFiles = [];

    function replaceAllUploadedPage(str, term, replacement) {
        return str.replace(new RegExp(escapeRegExpUploadedPage(term), 'g'), replacement);
    }

    function escapeRegExpUploadedPage(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, "\\$&");
    }

    function paystubUploadBtnClickUploadedPage(anchorElement, input_id) {
        if (!$(anchorElement).hasClass('upload-active')) {
            $(anchorElement).addClass('upload-active');
        }

        let fileInput = $('#' + input_id);
        $('#' + input_id).click(); // Trigger the hidden file input
        setTimeout(function() {
            if (!fileInput[0].files.length) {
                $(anchorElement).removeClass('upload-active');
            }
        }, 3000);
    }

    function paystubChangeSelectUploadedPage(event, employer_id, selectdocId, dataType) {
        var selectedDocToMove = '';
        selectedDateToMove = event.target.value;
        var client_id = '{{ @$client_id }}';
        var ajaxURL = "{{ route('client_paystub_date_change') }}";
        var formData = new FormData();
        formData.append('employer_id', employer_id);
        formData.append('new_date', selectedDateToMove);
        formData.append('document_id', selectdocId);
        formData.append('client_id', client_id);

        $.ajax({
            url: ajaxURL,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            success: function(response) {
                selectedFiles = [];
                if (response.status == 1) {
                    updateUploadedDocsHtml(dataType, client_id, employer_id);
                    $.systemMessage(response.msg, 'alert--success', true);
                }
                if (response.status == 0) {
                    $.systemMessage(response.msg, 'alert--danger', true);
                }
            },
            error: function(response) {
                console.log("error", response.status, response.msg);
            }
        });
    }

    function paystubFileSelectUploadedPage(event, pay_date, employer_id, span_class, dataType, uploadType = '', isNotAssigned = false, dataFor) {
        var inputDT = false;
        if (dataType == "" || dataType == undefined) {
            dataType = $('#document_types').val();
            inputDT = true;
        }
        var formData = new FormData();
        formData.append('document_type', dataType);

        var autoloan_id = $('#autoloan_id').val(); // Get the autoloan ID
        formData.append('autoloan_id', autoloan_id);

        var isPaystubStatus = 1; // Replace with actual logic to determine status
        var client_id = '{{ @$client_id }}'; // Get the client ID from PHP
        formData.append('client_id', client_id);

        formData.append('employer_id', employer_id);

        formData.append('isNotAssigned', isNotAssigned);
        if (event.target.type == "select-one") {
            var selectedFiles = [];
            var selectedDocToMove = event.target.value;
            formData.append('paystub_date[]', pay_date);
        } else {
            var selectedFiles = event.target.files;
            var selectedDocToMove = '';
        }

        if (uploadType == 'custom') {
            if (inputDT) {
                pay_date = $('#' + employer_id + '-').val();
                if (pay_date == '') {
                    $('#' + employer_id + '-').focus();
                    $.systemMessage('Pay Stub date should not be empty.', 'alert--danger', true);
                    return;
                }
            } else {
                pay_date = $('#' + employer_id + '-' + dataType).val();
                if (pay_date == '') {
                    $('#' + employer_id + '-' + dataType).focus();
                    $.systemMessage('Pay Stub date should not be empty.', 'alert--danger', true);
                    return;
                }
            }
        }

        formData.append('selectedDocToMove', selectedDocToMove);
        // Loop through the selected files
        for (var i = 0; i < selectedFiles.length; i++) {
            var imageFile = selectedFiles[i]; // Get the selected file
            var newName = replaceAllUploadedPage(imageFile.name, "_", " ");

            formData.append('document_file[]', imageFile, newName);
            formData.append('paystub_date[]', pay_date);
        }
        if (uploadType != 'custom') {
            $('.' + span_class).html('<span class="text-bold ">Uploading...</span>');
        }

        const isAdmin = "{{ (Auth::user()) ? (Auth::user()->role == 1) : 0 }}";
        if (isAdmin == '1') {
            $.systemMessage(`BKQ AI is pulling all of the ${dataFor}'s payroll data from the uploaded pay stubs and importing it to Payroll Assistant with AI. Please be patient the magic takes a few minutes.`, 'alert--process');
        } else {
            $.systemMessage("Uploading document..", 'alert--process');
        }

        var ajaxURL = "{{ route('upload_client_date', ['client_id' => @$client_id]) }}";
        $.ajax({
            url: ajaxURL,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            success: function(response) {
                selectedFiles = [];
                if (response.status == 1) {
                    updateUploadedDocsHtml(dataType, client_id, employer_id);
                    $.systemMessage(response.msg, 'alert--success', true);
                }
                if (response.status == 0) {
                    $.systemMessage(response.msg, 'alert--danger', true);
                }
            },
            error: function(response) {
                console.log("error", response.status, response.msg);
            }
        });
    }

</script>