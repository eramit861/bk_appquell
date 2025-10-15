<div class="row">
    <div class="col-12">
        <div class="uploaded_documents_pagelist row" id="pageList_{{ str_replace(" ", "_", $securedObjKey) }}">
            <div class="col-12">
                <div class="mb-2 d-flex align-items-center">
                    <a class="float-right ml-auto p-2 upload-doc-btn view_client_btn p4px reorder_doc_btn" data-ptype='unassign' data-url="{{ route('get_document_for_combine', ['id' => $val['id'], 'type' => 'secured_docs']) }}" id="common_doc_combine_btn_{{$securedObjKey}}" href="javascript:void(0)"><i class="bi bi-file-earmark-pdf-fill" aria-hidden="true"></i>&nbsp;Combined PDF</a>
                </div>
            </div>
            @foreach ($securedDocs as $objKey => $docs)
                @php
                $indicator = "d-none";
                foreach ($unreadDocuments as $value) {
                    if (isset($value['document_file']) && isset($doc['document_file']) && $value['document_file'] == $doc['document_file']) {
                        $indicator = "";
                    }
                }
                @endphp

                <div class="py-1">
                    <div class="document-div">
                        <div class=" single-doc-card flex-tab-wrap gap-tab-4">
                            <div class="d-flex-ai-center reorder-section">
                                <!-- |upload button  -->
                                <a href="javascript:void(0)" class="upload_doc_line view_client_btn upload-doc-btn p-2 me-2 "
                                    onclick="@if (in_array($objKey, [\App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB, \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB])) setDataType('{{ $objKey }}'); @endif both_upload_modal('{{ $objKey }}',$(this).data('text'), '', 0 , {{ $isStatements }} , {{ $isPaystub }}, {{ isset($isW2) && !empty($isW2) ? $isW2 : 0 }} );"
                                    data-type="{{ $objKey }}"
                                    data-text="{{ Helper::removeUnderscores(Helper::validate_key_value($objKey, $allDocNames), false) }}">
                                    <i class="bi bi-cloud-arrow-up me-1"></i> Click to Upload File(s)
                                </a>
                            </div>
                            @if (!empty($docs))
                                    @foreach ($docs as $doc)
                                        @php
                                            $docId = Helper::validate_key_value('id', $doc, 'radio');
                                            $document_type = Helper::validate_key_value('document_type', $doc);
                                            $document_file = Helper::validate_key_value('document_file', $doc);
                                            $document_name = Helper::validate_key_value('document_name', $doc);
                                            $added_by_attorney = Helper::validate_key_value('added_by_attorney', $doc, 'radio');
                                            $updated_name = Helper::validate_key_value('updated_name', $doc, );
                                            $docname = !empty($updated_name) ? $updated_name : $document_name;
                                            $document_status = Helper::validate_key_value('document_status', $doc, 'radio');
                                            $checkbox = false;
                                            if (Helper::validate_key_value('mime_type', $doc) == 'application/pdf') {
                                                $checkbox = true;
                                            }
                                            $indicator = "d-none";
                                            foreach ($unreadDocuments as $value) {
                                                if (isset($value['document_file']) && isset($doc['document_file']) && $value['document_file'] == $doc['document_file']) {
                                                    $indicator = "";
                                                }
                                            }
                                            $formultiples = true;
                                            if ($formultiples) {
                                                $filedocname = str_replace("documents/" . $client_id . "/", "", $document_file);
                                                $show = '';
                                            }
                                            $filedocname = str_replace("documents/" . $client_id . "/", "", $document_file);
                                            $show = '';
                                            $filePth = null;
                                            if (!empty($doc) && isset($doc['document_type']) && $doc['document_type'] != "requested_documents" && (!is_array($doc['document_file']) && !empty($doc['document_file']))) {
                                                // Only generate temporary URL if S3 is properly configured
                                                if (config('filesystems.disks.s3.bucket')) {
                                                    try {
                                                        $filePth = \Storage::disk('s3')->temporaryUrl(
                                                            $doc['document_file'],
                                                            now()->addDays(2), // Expires in 2 days
                                                            ['ResponseContentDisposition' => 'inline']
                                                        );
                                                    } catch (\Exception $e) {
                                                        \Log::error('S3 temporaryUrl failed in docSecuredColFormData: ' . $e->getMessage());
                                                        $filePth = null;
                                                    }
                                                }
                                            }
                                        @endphp

                                        <div class="d-flex-ai-center rename-section w-mob-100 mt-sm-2 mt-lg-0 w-tab-60 flex-tab-wrap w-lap-auto">
                                            <!-- |checkbox -->
                                            <input type="checkbox" class="checked_docs ms-2" data-item="{{$document_type}}" name="pdf_id[]" value="{{$doc['id']}}">
                                            <!-- |logo  -->
                                            @include('attorney.uploaded_doc_view.docSvgLogo')
                                            <!-- |name  -->
                                            <span class="ms-2 mr-auto">{{ $docname }}</span>
                                        </div>

                                        <div class="d-flex-ai-center button-action-section ml-auto ">
                                            <div class="label-div mb-0 ms-2 d-flex-ai-center width-mob-fit-content">
                                                <div class="hide-on-desktop ml-auto">
                                                    <div class="d-flex-ai-center">
                                                        <!-- |status  -->
                                                        @include('attorney.uploaded_doc_view.docStatus')
                                                        <!-- |accept decline document  -->
                                                        @include('attorney.uploaded_doc_view.docAcceptDecline')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="status-accept-section hide-on-mobile">
                                            <div class="d-flex-ai-center">
                                                <!-- |status  -->
                                                @include('attorney.uploaded_doc_view.docStatus')
                                                <!-- |accept decline document  -->
                                                @include('attorney.uploaded_doc_view.docAcceptDecline')
                                            </div>
                                        </div>

                                        <div class="d-flex-ai-center doc-action-section justify-content-end width-mob-fit-content">
                                            <!-- |move to dropdopdown  -->
                                            @include( 'attorney.uploaded_doc_view.docMoveTo')
                                            <!-- |download  -->
                                            @include('attorney.uploaded_doc_view.docDownload')
                                            <!-- |delete document  -->
                                            @include('attorney.uploaded_doc_view.docDelete')
                                        </div>

                                    @endforeach
                                @else
                                <div class="d-flex-ai-center rename-section w-mob-100 ">
                                    <!-- |logo  -->
                                    @include('attorney.uploaded_doc_view.docSvgLogo', ['document_type' => $objKey])
                                    <span class="d-inline-grid-mobile">
                                        <!-- |name  -->
                                        <span class="ms-2 ">{{ Helper::validate_key_value($objKey, $allDocNames) }}</span>
                                        <!-- |status  -->
                                        <span class="document-status highlight_btn_requested fs-10px red text-bold ">Missing </span>
                                    </span>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach    
        </div>
    </div>
</div>