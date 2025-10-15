<div class="employer-card border-1px-tab-link-color mb-4 ">
    <div class="employer-header accordian-with-docs-employer-header border-bottom-default row" data-bs-toggle="collapse" data-bs-target="#unassigned_paystub_section_{{ str_replace(" ", "_", $mainData['document_type']) }}" aria-expanded="true">
        <div class="col-12 col-md-9 d-flex-ai-center">
            <h3 class="fs-5 mb-0 text-start text-success d-flex-ai-center">
                Unassigned uploaded pay stubs
                <span class="top ms-2 document-status highlight_btn_requested blink fs-10px red text-bold font-italic {{ $showNewDocs ? '' : 'd-none' }}">New Doc(s) Awaiting Approvals</span>
            </h3>
        </div>
        <div class="col-12 col-md-3  d-flex-ai-center">
            <div class="ml-auto d-flex-ai-center">
                <label class="fs-13px mb-0 me-2 text-success text-bold accordian-with-docs unassigned_frequency_{{ str_replace(' ', '_', $mainData['document_type']) }} frequency">{{ 'Click to Show ' . count($unassignedDocIds ?? []) . ((count($unassignedDocIds ?? []) > 1) ? ' doc(s)' : ' doc') }}</label>
                <div class="toggle-icon">
                    <i class="bi bi-chevron-down fs-5 {{ (count($unassignedDocIds ?? []) > 1) ? '' : 'd-none' }} "></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="collapse {{ (isset($expandableDiv) && $expandableDiv) && (isset($expandableEmpId) && $expandableEmpId == '') ? 'show' : '' }} mb-3" id="unassigned_paystub_section_{{ str_replace(' ', '_', $mainData['document_type']) }}">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="uploaded_documents_pagelist" id="pageList_{{ str_replace(' ', '_', $mainData['document_type']) }}">
                    <div class="mb-2 d-flex align-items-center">
                        <a class="upload-doc-btn p-2 view_client_btn p4px accept_all dnpv hide-data" data-item="{{$mainData['document_type']}}" data-url="{{ route('accept_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => null]) }}" id="bulkaccept_{{$mainData['document_type']}}" href="javascript:void(0)"> Accept All</a>
                        <a class="upload-doc-btn p-2 ms-2 view_client_btn btn-danger p4px decline_all hide-data" data-item="{{$mainData['document_type']}}" data-url="{{ route('decline_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => null]) }}" id="bulkdecline_{{$mainData['document_type']}}" href="javascript:void(0)">Decline All</a>
                        <a class="upload-doc-btn p-2 ms-2 view_client_btn delete_doc_btn p4px hide-data" data-item="{{$mainData['document_type']}}" data-url="{{ route('delete_bulk_documents', ['id' => $val['id'], 'type' => $mainData['document_type'], 'employer_id' => null]) }}" id="bulkdelete_{{$mainData['document_type']}}" href="javascript:void(0)"><i class="fa fa-file-trash fa-lg" aria-hidden="true"></i> Delete Selected</a>
                        <a class="float-right ml-auto p-2 upload-doc-btn view_client_btn p4px reorder_doc_btn" data-ptype='unassign' data-url="{{ route('get_document_for_combine', ['id' => $val['id'], 'type' => $data['document_type']]) }}" id="common_doc_combine_btn_{{$data['document_type']}}" href="javascript:void(0)"><i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>&nbsp;{{ 'Combined PDF' }}</a>
                    </div>
                </div>
            </div>
            @include( 'attorney.uploaded_doc_view.docUnassignedForPayStub')
        </div>
    </div>
</div>