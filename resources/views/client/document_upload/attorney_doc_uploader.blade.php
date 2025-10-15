@php
    $manul_url_document_type = '';
    if (isset($isManualPage) && $isManualPage) {
        $hideDownload = true;
        $manul_url_document_type = $url_document_type ?? '';
    }
@endphp

@if (!empty($attorneydocuments) && is_array($attorneydocuments))
    @if (empty($manul_url_document_type) ||
            (!empty($manul_url_document_type) && in_array($manul_url_document_type, array_keys($attorneydocuments))))
        <div class="card">
            <div class="card-header text-center">
                <h5 class="text-c-blue">Additional Attorney Docs</h5>
            </div>
            <div class="card-body border-0 p-3">
                <ul class="attorney-docs">
                    @foreach ($attorneydocuments as $attdoc_type => $val)
                        @if (!empty($manul_url_document_type) && $manul_url_document_type != $attdoc_type)
                            @continue
                        @endif

                        @php
                            $sampleName = '';
                            $samplePopupLabel = '';
                            $attorneydocKey = $attdoc_type;
                            $uploadedClass = '';
                            $statusmsg = 'Not Submitted Yet';
                            $statusFontColor = 'text-danger';
                            $showDownloadLink = false;
                            $bgClass = 'text-gray';
                            $docData = Helper::getDocumentImage($key);

                            $svgname = Helper::validate_key_value('svg', $docData);
                            $svgUrl = asset('assets/img/gray_icons/' . $svgname);

                            if (in_array($attorneydocKey, @$documentuploaded)) {
                                $doc = Helper::getArrayByKey($attorneydocKey, $list);
                                $bgClass = 'text-yellow';
                                $statusFontColor = '';
                                $showDownloadLink = true;
                                $statusmsg = 'Submitted Waiting for Approval';
                                $svgUrl = asset('assets/img/yellow_icons/' . $svgname);

                                if (!empty($doc)) {
                                    $renabledupload = $doc['document_enable_reupload'];
                                    $declineReason = $doc['document_decline_reason'];
                                    $status = $doc['document_status'];
                                    $addedByAttorney = Helper::validate_key_value('added_by_attorney', $doc, 'radio');
                                    if ($status == 1 || $addedByAttorney == 1) {
                                        $statusmsg = 'Accepted';
                                        $bgClass = 'text-green';
                                        $svgUrl = asset('assets/img/green_icons/' . $svgname);
                                    }
                                    if ($status == 2) {
                                        $statusmsg = 'Declined';
                                        $bgClass = 'text-red';
                                        $svgUrl = asset('assets/img/red_icons/' . $svgname);
                                    }
                                }
                            }
                            if (in_array($attorneydocKey, $notOwnedDocs)) {
                                $statusmsg = 'Client selected no document available';
                                $bgClass = 'text-yellow';
                                $statusFontColor = '';
                                $svgUrl = asset('assets/img/yellow_icons/' . $svgname);
                            }
                            $counseling_agency = '';
                            $counseling_agency_site = '';
                            $attorney_code = '';
                            if ($attorneydocKey == 'Pre_Filing_Bankruptcy_Certificate_CCC') {
                                $agencyName = str_replace('Pre-Filing Bankruptcy Certificate(s) ', '', $val);
                                $val =
                                    'Tap or Click to upload: Pre-Filing Bankruptcy Certificate(s): <span class="text-dark f-w-600">' .
                                    $agencyName .
                                    '</span>';
                                $svgUrl = asset('assets/img/gray_icons/misc_docs.svg');
                                $counseling_agency =
                                    isset($attorneySettings->counseling_agency) &&
                                    !empty($attorneySettings->counseling_agency)
                                        ? $attorneySettings->counseling_agency
                                        : '';
                                $counseling_agency_site =
                                    isset($attorneySettings->counseling_agency_site) &&
                                    !empty($attorneySettings->counseling_agency_site)
                                        ? $attorneySettings->counseling_agency_site
                                        : '';
                                $attorney_code =
                                    isset($attorneySettings->attorney_code) && !empty($attorneySettings->attorney_code)
                                        ? $attorneySettings->attorney_code
                                        : '';
                            }
                            if ($attorneydocKey === 'Miscellaneous_Documents') {
                                $sampleName = 'popup-miscellaneous-doucments';
                                $samplePopupLabel =
                                    "<span class='text-success'>Put anything your unsure of here. If you don't have any docs for here select the box you don't have any <img alt='Quick tip' src='" .
                                    $quickTipUrl .
                                    "' width='18px' /></span>";
                            }
                            if ($attorneydocKey === 'Insurance_Documents') {
                                $samplePopupLabel =
                                    '<span class="text-success">What insurance documents are needed? <img alt="Quick tip" src="' .
                                    $quickTipUrl .
                                    '" width="18px" /></span>';
                            }
                            if (str_starts_with($attorneydocKey, 'Vehicle_Registration_')) {
                                $sampleName = 'Vehicle_Registration';
                                $samplePopupLabel =
                                    '<span class="text-success">Whats a Vehicle Registration? <img alt="Quick tip" src="' .
                                    $quickTipUrl .
                                    '" width="18px" /></span>';
                            }
                            foreach ($documentuploadedImages as $guide) {
                                if ($guide['type'] == $attorneydocKey && !empty($guide['image'])) {
                                    $sampleName = $guide['type'];
                                }
                            }
                        @endphp

                        <li class="{{ $bgClass }} text-center mb-3">
                              @if (in_array($attorneydocKey, ['Miscellaneous_Documents']))
                                    <label class="ml-1 w-100 text-c-red blink mb-0 pb-0" style="font-size:12px;text-decoration:underline;text-align: start;">Use this to
                                        upload doc(s) that don't fit into an existing category or if you're unsure where they belong</label>
                                @endif
                            <a href="javascript:void(0);" class="nav-linkf text-left mb-2 {{ $uploadedClass }}"
                                data-bs-toggle="modal" data-type="{{ $attorneydocKey }}"
                                onclick='both_upload_modal($(this).data("type"),$(this).find(".doc-card").html(), "{{ $bgClass }}")'>
                                @php
                                    $postfix = !empty($statusmsg)
                                        ? '<span class="font-weight-bold status-div status-message doc-status ' .
                                            $statusFontColor .
                                            '">(' .
                                            $statusmsg .
                                            ')</span>'
                                        : '';
                                @endphp
                                <div class="fs-12px status-div"><small
                                        class="doc-status w-100 {{ $bgClass }} b-none"
                                        style="display: block ruby; text-align: right;">{!! $postfix !!}</small>
                                </div>
                                <div class="d-flex align-items-center w-100">
                                    <div class="d-status">
                                        <img src="{{ $svgUrl }}" class="doc-icon" width="35px" alt="icon">
                                    </div>
                                    <div class="{{ $bgClass }} b-none doc-card d-block">{!! $val !!}
                                    </div>
                                </div>
                            </a>
                            @if (isset($isManualPage) && !$isManualPage && $showDownloadLink)
                                <a href="javascript:void(0)"
                                    onclick='clientShowSavedDocs({{ $user->id }}, "{{ $attorneydocKey }}")'>
                                    <small class="d-flex align-items-center fs-10px mt-1">
                                        <i style="font-size:16px;vertical-align:middle;" class="fa fa-file-pdf mx-2"
                                            aria-hidden="true"></i>
                                        Click to see {!! $val !!}
                                    </small>
                                </a>
                            @endif
                            @if ($attorneydocKey == 'Pre_Filing_Bankruptcy_Certificate_CCC')
                                <a href="{{ !empty($counseling_agency_site) ? (strpos($counseling_agency_site, 'http') === 0 ? $counseling_agency_site : 'https://' . $counseling_agency_site) : 'javascript:void(0);' }}"
                                    class="text-success att_doc_bankruptcy_certificate blink mb-0 pb-0" target="_blank">
                                    <small class="text-bold">Click here to go to Pre-Filing Credit Counseling Website
                                    </small></a>
                                @if ($attorneydocKey == 'Pre_Filing_Bankruptcy_Certificate_CCC')
                                    <small class="text-c-blue att_doc_bankruptcy_certificate_small text-bold">Atty Code
                                        for credit counseling website: ({{ $attorney_code }})</small>
                                @endif
                                <p class="mb-0">
                                    <a href="javascript:void(0)"
                                        onclick="openFlagPopup('Pre_Filing_Bankruptcy_Certificate_CCC', '', false, false, true, '{{ route('load_guide_doc') }}');"
                                        class="text-dark"><small class="text-bold"
                                            style="width: 100%; display: inline-block; text-align: right;"><span
                                                class="text-success">What does this look like? <img
                                                    src="{{ url('assets/img/quick-tip.jpg') }}" width="18px"
                                                    alt="Quick Tip" /></span></small></a>
                                </p>
                                @if ($statusmsg == 'Not Submitted Yet')
                                    <p class="mb-0">
                                        <small class="text-bold text-danger"
                                            style="width: 100%; display: inline-block; text-align: right;">
                                            <i class="fa text-c-red blink fa-exclamation-triangle mr-0"
                                                aria-hidden="true"></i>
                                            You must complete this before your case can be filed with the Court
                                        </small>
                                    </p>
                                @endif
                            @endif

                            @if (!empty($sampleName))
                                <p class="mb-0">
                                    <a href="javascript:void(0)"
                                        onclick="openFlagPopup('{{ $sampleName }}', '', false, false, true, '{{ route('load_guide_doc') }}');"
                                        class="text-dark"><small class="text-bold"
                                            style="width: 100%; display: inline-block; text-align: right;">{!! $samplePopupLabel !!}</small></a>
                                </p>
                            @endif
                        </li>

                        @if ($bgClass == 'text-gray' || in_array($attdoc_type, $notOwnedDocs))
                            <li class="box-lapel-flex p-0">
                                <div class="btn-no-document-parent">
                                    <label for="check_{{ $attdoc_type }}" class="btn-no-document"
                                        style="font-size:10px;">
                                        <input type="checkbox"
                                            name="document_list_{{ $client_id }}_{{ $attdoc_type }}"
                                            {{ in_array($attdoc_type, $notOwnedDocs) ? 'checked' : '' }}
                                            id="check_{{ $attdoc_type }}"
                                            onclick="makrnotOwn('{{ $client_id }}','{{ $attdoc_type }}', this)">
                                        I don't have this document
                                    </label>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endif
