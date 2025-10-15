<div class="d-flex common-parent-action flex-wrap gap-mob-6px gap-tab-4">

    @if (in_array($objKey, ['Drivers_License', 'Social_Security_Card', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card']))

        <a href="javascript:void(0)" class="upload_doc_line view_client_btn upload-doc-btn p-2 mb-1 fs-mob-10px"
            onclick="both_upload_modal('{{ $objKey }}',$(this).data('text'))" data-type="{{ $objKey }}"
            title="Select to Upload Document"
            data-text="{{ Helper::validate_key_value($objKey, $allDocNames) }}">
            <i class="bi bi-cloud-arrow-up"></i> Click to Upload File(s)
        </a>

        <label class="missing-month-p {{ empty($documentAndMissingText) ? 'hide-data' : '' }}">{!! $documentAndMissingText !!}</label>

    @else

        <a href="javascript:void(0)" class="upload_doc_line view_client_btn upload-doc-btn p-2 me-2 d-flex-ai-center h-fit-content mt-1 mt-sm-0"
            onclick="@if (in_array($objKey, [\App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB, \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB])) setDataType('{{ $objKey }}'); @endif both_upload_modal('{{ $objKey }}',$(this).data('text'), '', 0 , {{ $isStatements }} , {{ $isPaystub }}, {{ isset($isW2) && !empty($isW2) ? $isW2 : 0 }} );"
            data-type="{{ $objKey }}"
            data-text="{{ Helper::removeUnderscores(Helper::validate_key_value($objKey, $allDocNames), false) }}">
            <i class="bi bi-cloud-arrow-up"></i>&nbsp;Click&nbsp;to&nbsp;Upload&nbsp;File(s)
        </a>

        <a class="hide-on-desktop float-right h-fit-content ml-auto p-2 upload-doc-btn view_client_btn p4px reorder_doc_btn {{ ($docsCount > 0) ? '' : 'hide-data' }} mt-1 mt-sm-0" data-ptype='unassign' data-url="{{ route('get_document_for_combine', ['id' => $val['id'], 'type' => $objKey]) }}" id="common_doc_combine_btn_{{$objKey}}" href="javascript:void(0)"><i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>&nbsp;Combined&nbsp;PDF</a>

        @if (($checkbox && $docsCount > 0))
            <label class="missing-month-p me-2 click_all_docs mt-1 mt-sm-0">
                <span class="d-flex-ai-center">
                    <input class="parent_{{ $objKey }} me-2" type="checkbox" onclick="checkChildCheckboxes(this,'{{ $objKey }}')" value="1">Click&nbsp;to&nbsp;Select&nbsp;All&nbsp;Doc(s) 
                </span>
            </label>
        @endif

        <a class="d-flex-ai-center h-fit-content upload-doc-btn p-2 view_client_btn p4px accept_all btn-accept dnpv hide-data  mt-1 mt-sm-0" data-item="{{$objKey}}" data-url="{{ route('accept_bulk_documents', ['id' => $val['id'], 'type' => $objKey, 'employer_id' => null]) }}" id="bulkaccept_{{$objKey}}" href="javascript:void(0)"><i class="bi bi-check-lg" aria-hidden="true"></i>&nbsp;Accept&nbsp;Selected</a>
        
        <a class="d-flex-ai-center h-fit-content upload-doc-btn p-2 ms-sm-2 view_client_btn btn-danger btn-decline p4px decline_all hide-data mt-1 mt-sm-0" data-item="{{$objKey}}" data-url="{{ route('decline_bulk_documents', ['id' => $val['id'], 'type' => $objKey, 'employer_id' => null]) }}" id="bulkdecline_{{$objKey}}" href="javascript:void(0)"><i class="bi bi-x-lg" aria-hidden="true"></i>&nbsp;Decline&nbsp;Selected</a>
        
        <a class="d-flex-ai-center h-fit-content upload-doc-btn p-2 ms-sm-2 me-sm-2 view_client_btn btn-decline delete_doc_btn p4px hide-data  mt-1 mt-sm-0" data-item="{{$objKey}}" data-url="{{ route('delete_bulk_documents', ['id' => $val['id'], 'type' => $objKey, 'employer_id' => null]) }}" id="bulkdelete_{{$objKey}}" href="javascript:void(0)"><i class="bi bi-trash3" aria-hidden="true"></i>&nbsp;Delete&nbsp;Selected</a>
        
        <a class="hide-on-mobile float-right h-fit-content ml-auto p-2 upload-doc-btn view_client_btn p4px reorder_doc_btn {{ ($docsCount > 0) ? '' : 'hide-data' }} mt-1 mt-sm-0" data-ptype='unassign' data-url="{{ route('get_document_for_combine', ['id' => $val['id'], 'type' => $objKey]) }}" id="common_doc_combine_btn_{{$objKey}}" href="javascript:void(0)"><i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>&nbsp;Combined&nbsp;PDF</a>
        
    @endif
</div>