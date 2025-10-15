@php
    $manul_url_document_type = '';
    if (isset($isManualPage) && $isManualPage) {
        $hideDownload = true;
        $manul_url_document_type = $url_document_type ?? '';
    }
    $guidAjax = true;
@endphp
@if (($manul_url_document_type != '' && $key == $manul_url_document_type) || empty($manul_url_document_type))
    @php
        $docData = Helper::getDocumentImage($key);
        $svgname = Helper::validate_key_value('svg', $docData);
        $svgname = empty($svgname) ? 'attorney_docs.svg' : $svgname;
        $uploadedClass = '';
        $bgClass = 'text-gray';
        $svgUrl = asset('assets/img/gray_icons/' . $svgname);
        $renabledupload = false;
        $declineReason = '';
        $status = 0;
        $reason = '';
        $statusFontColor = 'text-danger';
        $statusmsg = 'Not Submitted Yet';
        $showDownloadLink = false;
        if (in_array($key, @$documentuploaded)) {
            // $uploadedClass="color-yellow";
            $statusmsg = 'Submitted Waiting for Approval';
            $statusFontColor = '';
            $showDownloadLink = true;
            $bgClass = 'text-yellow';
            $svgUrl = asset('assets/img/yellow_icons/' . $svgname);
            $doc = Helper::getArrayByKey($key, $list);
            if (!empty($doc)) {
                $renabledupload = $doc['document_enable_reupload'];
                $declineReason = $doc['document_decline_reason'];
                $status = $doc['document_status'];
                $addedByAttorney = Helper::validate_key_value('added_by_attorney', $doc, 'radio');
                if ($status == 1 || $addedByAttorney == 1) {
                    $statusmsg = 'Accepted';
                    // $uploadedClass="color-green";
                    $bgClass = 'text-green';
                    $svgUrl = asset('assets/img/green_icons/' . $svgname);
                    // $fStatus = '<i class="fas fa-check-circle"></i>';
                }
                if ($status == 2) {
                    $statusmsg = 'Declined';
                    // $uploadedClass="color-yellow-decline";
                    $bgClass = 'text-red';
                    $svgUrl = asset('assets/img/red_icons/' . $svgname);
                    // $fStatus = '<i class="fas fa-ban"></i>';
                }
            }
        }
        $name = str_replace('_', ' ', $name);

        if (in_array($key, ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])) {
            $guidAjax = false;
        }
        if (in_array($key, ['paypal_account_1', 'paypal_account_2', 'paypal_account_3'])) {
            $name = str_replace('PayPal', "<span class='text-c-blue f-w-600'>PayPal</span>", $name);
            $guidAjax = false;
        }
        if (in_array($key, ['cash_account_1', 'cash_account_2', 'cash_account_3'])) {
            $name = str_replace('Cash App', "<span class='text-success f-w-600'>Cash App</span>", $name);
            $guidAjax = false;
        }

        if (in_array($key, $notOwnedDocs)) {
            $statusmsg = 'Client selected no document available';
            $bgClass = 'text-yellow';
            $statusFontColor = '';
            $svgUrl = asset('assets/img/yellow_icons/' . $svgname);
        }
    @endphp


    <li class="{{ $bgClass }} mb-3">
        @php $name = str_replace("_", " ", $name); 
        $capitlizedclass = '';
        
        @endphp
        @if (in_array($key, ['Miscellaneous_Documents']))
            <label class="ml-1 w-100" style="font-size:12px;text-decoration:underline;text-align: start;">Use this to
                upload doc(s) that don't fit into an existing category or if you're unsure where they belong</label>
        @endif
       
        

        @php
        if (in_array($key, ['Other_Misc_Documents'])){
            $capitlizedclass = "text-transform-none";
       }
            $postfix = !empty($statusmsg)
                ? '<span class="text-bold status-message ' . $statusFontColor . ' pt-0">(' . $statusmsg . ')</span>'
                : '';
            $monthsLabel = @$textToDisplay ?? '';
            $monthsLabel = !empty($monthsLabel) ? $monthsLabel . '</br>' : $monthsLabel;
            $finalLabel = isset($bankline) && !empty($bankline) ? $bankline : '';
            $nbsp = isset($monthsLabel) && !empty($monthsLabel) ? '&nbsp;' : '';

        @endphp
        <a title="{{ $statusmsg }}" href="javascript:void(0);" id="upload_btn_{{ $client_id }}_{{ $key }}"
            class="nav-linkf {{ $capitlizedclass??'' }} {{ isset($hideDownload) && !$hideDownload ? ' mb-2 ' : '' }}"
            data-type="{{ $key }}"
            onclick='both_upload_modal($(this).data("type"), $(this).find(".doc-card").html(), "{{ $bgClass }}", 0, {{ $isStatements }}, {{ $isPaystub }}, {{ isset($isW2) && !empty($isW2) ? $isW2 : 0 }} )'>
            <div class="fs-12px status-div {{ $isStatements == 0 ? 'bottom-list-without-month' : 'bottom-list' }}">
                <small class="doc-status w-100 {{ $bgClass }} b-none"
                    style="display: block ruby; text-align: right;">{!! $postfix !!}</small></div>
            <div class="d-flex align-items-center w-100">
                <div class="d-status">
                    <img src="{{ $svgUrl }}" class="doc-icon" width="35px" alt="icon">
                </div>
                <div class="{{ $bgClass }} b-none doc-card d-block {{ $unsecured_page }}">Tap or Click to upload:
                    {!! $finalLabel . $name !!}</div>
            </div>
            <div
                class="w-100 text-right fs-12px status-div {{ $isStatements == 0 ? 'bottom-list-without-month' : 'bottom-list' }}">
                <small class="doc-status {{ $bgClass }} b-none">{!! $monthsLabel !!}</small></div>
        </a>
        @if (isset($hideDownload) && !$hideDownload)
            @php
                $downloadLabel = str_replace('Upload your', '', $finalLabel . $name);
                $simpleUploadDocClass = '';
                if ($isRequestedType) {
                    $downloadLabel = 'upload doc(s)';
                    $simpleUploadDocClass = 'simple-upload-doc-class';
                }
            @endphp
            @if ($showDownloadLink)
                <a href="javascript:void(0)" class=" d-inline-block"
                    onclick='clientShowSavedDocs({{ $user->id }}, "{{ $key }}")'>
                    <small class="align-items-center fs-10px {{ $simpleUploadDocClass }}">
                        <i style="font-size:16px;vertical-align:middle;" class="fa fa-file-pdf mx-2"
                            aria-hidden="true"></i>
                        Click to see {!! $downloadLabel !!}
                    </small>
                </a>
            @endif
        @endif

        @if (!empty($sampleName))
            <p class="mb-0">
                <a href="javascript:void(0)"
                    onclick="openFlagPopup('{{ $sampleName }}', '', false, false, '{{ $guidAjax }}' , '{{ route('load_guide_doc') }}');"
                    class="text-dark"><small class="text-bold"
                        style="width: 100%; display: inline-block; text-align: right;">{!! $samplePopupLabel !!}</small></a>
            </p>
        @endif

        @if (!empty($sampleAnchorLabel))
            <p class="mb-0">
                <a href="{{ $sampleAnchorLink }}"
                    {{ $sampleAnchorLink != 'javascript:void(0)' ? 'target="_blank"' : '' }}
                    class="text-dark "><small class="text-bold"
                        style="width: 100%; display: inline-block; text-align: right;">{!! $sampleAnchorLabel !!}</small></a>
            </p>
        @endif
    </li>
    @if ($bgClass == 'text-gray' || in_array($key, $notOwnedDocs))
        <li class="box-lapel-flex p-0">
            <div class="btn-no-document-parent">
                <label for="check_{{ $key }}"
                    class="btn-no-document {{ in_array($key, $notOwnedDocs) ? 'active' : '' }}"
                    style="font-size:10px;">
                    <input type="checkbox" class="mr-2 " name="document_list_{{ $client_id }}_{{ $key }}"
                        id="check_{{ $key }}" {{ in_array($key, $notOwnedDocs) ? 'checked' : '' }}
                        onclick="makrnotOwn('{{ $client_id }}','{{ $key }}', this)">
                    I don't have this document
                </label>
            </div>
        </li>
    @endif
@endif
