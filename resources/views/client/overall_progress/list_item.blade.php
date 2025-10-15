@php
    $monthsLabel = '';
    $docData = Helper::getDocumentImage($key);
    $svgname = Helper::validate_key_value('svg', $docData);
    $svgname = empty($svgname) ? 'attorney_docs.svg' : $svgname;
    $uploadedClass = '';
    $bgClass = 'text-red';
    $svgUrl = asset('assets/img/red_icons/' . $svgname);
    $renabledupload = false;
    $declineReason = '';
    $status = 0;
    $reason = '';
    $statusmsg = 'Not Submitted Yet';
    if (in_array($key, @$documentuploaded)) {
        // $uploadedClass="color-yellow";
        $statusmsg = 'Submitted Waiting for Approval';
        $bgClass = 'text-yellow';
        $svgUrl = asset('assets/img/yellow_icons/' . $svgname);
        $doc = Helper::getArrayByKey($key, $list);
        if (!empty($doc)) {
            $renabledupload = $doc['document_enable_reupload'];
            $declineReason = $doc['document_decline_reason'];
            $status = $doc['document_status'];
            if ($status == 1) {
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
    if (in_array($key, $notOwnedDocs)) {
        $statusmsg = 'Client selected no document available';
        $bgClass = 'text-yellow';
        $statusFontColor = '';
        $svgUrl = asset('assets/img/yellow_icons/' . $svgname);
    }
    $name = str_replace('_', ' ', $name);
@endphp
@if ($uploadedList && (!empty(Helper::getArrayByKey($key, $list)) || in_array($key, $notOwnedDocs)))
    <li class="{{ $bgClass }} text-center">
        @php $name = str_replace("_", " ", $name); @endphp
        @if (in_array($key, ['Miscellaneous_Documents']))
            <label class="ml-1 mb-0" style="font-size:12px;text-decoration:underline;">Use this to upload doc(s) that
                don't fit into an existing category or if you're unsure where they belong</label>
        @endif
        <a title="{{ $statusmsg }}" href="{{ route('list_uploaded_documents') }}"
            id="upload_btn_{{ $client_id }}_{{ $key }}"
            class="nav-linkf  anchor_diable text-left {{ $uploadedClass }} d-flex" data-type="{{ $key }}">
            <div class="d-status">
                <img src="{{ $svgUrl }}" class="doc-icon" width="35px" alt="icon">
            </div>
            @php
                $postfix = !empty($statusmsg)
                    ? '<span class="font-weight-bold status-message"> (' . $statusmsg . ')</span>'
                    : '';
                $finalLabel = isset($bankline) && !empty($bankline) ? $bankline : '';
                $postfix = !empty($statusmsg)
                    ? '<span class="text-bold status-message pt-0">(' . $statusmsg . ')</span>'
                    : '';
                $monthsLabel = isset($isBrokerage) && !empty($isBrokerage) ? '' : @$textToDisplay;
                $monthsLabel = !empty($monthsLabel) ? $monthsLabel . '</br>' : $monthsLabel;
                $nbsp = isset($monthsLabel) && !empty($monthsLabel) ? '&nbsp;' : '';
            @endphp

            <div class="{{ $bgClass }} b-none doc-card d-block"> {!! $finalLabel . $name !!}
                <div
                    class="w-100 text-right fs-12px status-div {{ $isStatements == 0 ? 'bottom-list-without-month' : 'bottom-list' }}">
                    <small class="doc-status {{ $bgClass }} b-none">{!! $monthsLabel . $nbsp . $postfix !!}</small></div>
            </div>
        </a>
    </li>
@endif

{{-- if (!$uploadedList && ($uploadedDocsProgress != 100) && (empty(Helper::getArrayByKey($key, $list)) || (in_array($key,$notOwnedDocs) && empty(Helper::getArrayByKey($key, $list)) ))) --}}
@if (
    !$uploadedList &&
        $uploadedDocsProgress != 100 &&
        empty(Helper::getArrayByKey($key, $list)) &&
        !in_array($key, $notOwnedDocs))
    @if (!$uploadedList)
        <div class="col-md-6">
    @endif
    <li class="{{ $bgClass }} text-center">
        @php $name = str_replace("_", " ", $name); @endphp
        @if (in_array($key, ['Miscellaneous_Documents']))
            <label class="ml-1 mb-0" style="font-size:12px;text-decoration:underline;">Use this to upload doc(s) that
                don't fit into an existing category or if you're unsure where they belong</label>
        @endif
        <a title="{{ $statusmsg }}" href="{{ route('list_uploaded_documents') }}"
            id="upload_btn_{{ $client_id }}_{{ $key }}"
            class="nav-linkf  anchor_diable text-left {{ $uploadedClass }} d-flex" data-type="{{ $key }}">
            <div class="d-status">
                <img src="{{ $svgUrl }}" class="doc-icon" width="35px" alt="icon">
            </div>
            @php
                $postfix = !empty($statusmsg)
                    ? '<span class="font-weight-bold status-message"> (' . $statusmsg . ')</span>'
                    : '';
                $finalLabel = isset($bankline) && !empty($bankline) ? $bankline : '';
                $postfix = !empty($statusmsg)
                    ? '<span class="text-bold status-message pt-0">(' . $statusmsg . ')</span>'
                    : '';
                $monthsLabel = isset($isBrokerage) && !empty($isBrokerage) ? '' : @$textToDisplay;
                $monthsLabel = !empty($monthsLabel) ? $monthsLabel . '</br>' : $monthsLabel;
                $nbsp = isset($monthsLabel) && !empty($monthsLabel) ? '&nbsp;' : '';
            @endphp
            <div class="{{ $bgClass }} b-none doc-card d-block"> {!! $finalLabel . $name !!}
                <div
                    class="w-100 text-right fs-12px status-div {{ $isStatements == 0 ? 'bottom-list-without-month' : 'bottom-list' }}">
                    <small class="doc-status {{ $bgClass }} b-none">{!! $monthsLabel . $nbsp . $postfix !!}</small></div>
            </div>
        </a>
    </li>
    @if (!$uploadedList)
        </div>
    @endif
@endif
