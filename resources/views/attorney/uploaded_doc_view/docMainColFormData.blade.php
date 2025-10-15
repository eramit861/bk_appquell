<div class="employer-card {{ ($key == 'parentIdDocuments') ? 'parent-id-docs' : '' }} border-1px-tab-link-color mb-4  ">
    <div class="employer-header p-3 row {{ !$isIdSection ? 'accordian-with-docs-employer-header' : '' }}  " {{ !$isIdSection ? 'data-bs-toggle="collapse" data-bs-target="#common_doc_section_' . str_replace(" ", "_", $objKey) . '" aria-expanded="true"' : '' }}>
        <div class="col-12 {{ ($key == 'parentIdDocuments') ? '' : 'col-md-9' }}">
            <h3 class="fs-5 mb-0 text-start d-flex-ai-center d-md-flex flex-wrap pb-1 pb-md-0">
                <span class="fs-mob-1rem">
                    {!! Helper::validate_key_value($objKey, $allDocNames) !!}
                </span>
                {!! $banktypeString !!}
                @if (is_array($requestedDocuments) && !empty($requestedDocuments) && in_array($objKey, array_keys($requestedDocuments)))
                    <span class='highlight_btn_requested d-inline-block fs-10px mt-1 mt-md-0 mt-sm-1 ml-md-2 ml-1 {{ $docsCount > 0 ? 'green' : 'red ml-0' }}'> Document(s) Requested </span>
                @endif
                <span class="top document-status blink highlight_btn_requested fs-10px red text-bold font-italic {{$parentIndicator}} status_doc mt-1 mt-sm-0 ml-1 ml-lg-1">New Doc(s) Awaiting Approval</span>
            </h3>
            <div class="w-100 d-flex-ai-center d-flex flex-wrap">
                @if (!empty($notOwnedproperty))
                    <div class="document-status d-flex-ai-center mt-1">
                        <span class="highlight_btn_requested d-inline-block fs-10px red text-bold ml-0 me-2">{{ $notOwnedproperty }}</span>
                    </div>
                @endif
                <label class="hide-on-mobile missing-month-p parent me-2 mt-1 h-fit-content fs-mob-12px {{ !empty($acceptedCount) || !empty($declinedCount) ? '' : 'hide-data' }}">
                    @if(!empty($acceptedCount))
                        <span class='text-bold text-success'>Accepted:{{ $acceptedCount }}</span>
                    @endif
                    @if(!empty($acceptedCount) && !empty($declinedCount))
                        , 
                    @endif
                    @if(!empty($declinedCount))
                        <span class='text-bold text-danger'>Declined:{{ $declinedCount }}</span>
                    @endif
                </label>
                <div class="{{ empty($documentAndMissingText) ? 'hide-data' : '' }} mt-1">
                    <label class="missing-month-p parent me-2">{!! $documentAndMissingText !!}</label>
                </div>
                @if (in_array($objKey, array_keys($clientDocs)) || in_array($objKey, array_keys($venmoPaypalCash)) || in_array($objKey, array_keys($brokerageAccount)) || in_array($objKey, $adminDocs))
                    @php
                        $accountDeleteURL = in_array($objKey, $adminDocs) ? route('delete_requested_doc_type') : route('delete_bank_type');
                    @endphp
                    <button onclick="deleteBankType('{{ $objKey }}','{{ $client_id }}', '{{ $accountDeleteURL }}')"
                        type="button"
                        style="padding: 9px 10px !important;"
                        class="text-bold delete-div me-2 d-flex-ai-center h-fit-content mt-1 fs-13px" title="Delete">
                        <i class="bi bi-trash3" aria-hidden="true"></i>&nbsp;Delete&nbsp;Account
                    </button>
                @endif
            </div>

        </div>
        <div class="col-12 px-md-2 px-lg-3 {{ ($key == 'parentIdDocuments') ? '' : 'col-md-3' }} d-flex-ai-center">
            <div class="ml-auto d-flex-ai-center w-mob-100 w-tab-100">
                <label class="hide-on-desktop missing-month-p parent me-2 mt-1 h-fit-content fs-mob-12px {{ !empty($acceptedCount) || !empty($declinedCount) ? '' : 'hide-data' }}">
                    @if(!empty($acceptedCount))
                        <span class='text-bold text-success'>Accepted:{{ $acceptedCount }}</span>
                    @endif
                    @if(!empty($acceptedCount) && !empty($declinedCount))
                        , 
                    @endif
                    @if(!empty($declinedCount))
                        <span class='text-bold text-danger'>Declined:{{ $declinedCount }}</span>
                    @endif
                </label>
                <div class="w-100 d-flex-ai-center justify-mob-end">
                    @if ($docsCount > 0 && !$isIdSection)
                        <label class="fs-13px mb-0 me-2 text-success text-bold accordian-with-docs">Click to Show {{ $docsCount }} {{ $docsCount > 1 ? 'doc(s)' : 'doc' }}</label>
                    @endif
                    <div class="toggle-icon">
                        <i class="bi bi-chevron-down fs-5 {{ $isIdSection ? 'd-none' : '' }} "></i>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="light-gray-div mt-3 mb-3 doc-parent-div p-3 align-items-unset sortable-container {{ !$isIdSection ? 'collapse' : '' }} {{ isset($expandableDiv) && $expandableDiv ? 'collapse show' : '' }}  " id="common_doc_section_{{ str_replace(" ", "_", $objKey) }}">
    <div class="row gx-3">
        <div class="col-12">
            @include( 'attorney.uploaded_doc_view.docCommonParentActions')
        </div>
        @if (!empty($docs))
            @foreach ($docs as $doc)
                @php
                    $indicator = (Helper::validate_key_value('is_viewed_by_attorney', $doc, 'radio') == 0) ? "" : "d-none";
                    $docId = Helper::validate_key_value('id', $doc, 'radio');
                    $document_type = Helper::validate_key_value('document_type', $doc);
                    $document_file = Helper::validate_key_value('document_file', $doc);
                    $document_name = Helper::validate_key_value('document_name', $doc);
                    $document_month = Helper::validate_key_value('document_month', $doc);
                    $added_by_attorney = Helper::validate_key_value('added_by_attorney', $doc, 'radio');
                    $updated_name = Helper::validate_key_value('updated_name', $doc, );
                    $docname = !empty($updated_name) ? $updated_name : $document_name;
                    $document_status = Helper::validate_key_value('document_status', $doc, 'radio');
                    $checkbox = false;
                    $formultiples = false;
                    if (
                        in_array($document_type, ['Co_Debtor_Pay_Stubs', 'Debtor_Pay_Stubs', 'W2_Last_Year', 'W2_Year_Before', 'Insurance_Documents'])
                        || in_array($document_type, ['Miscellaneous_Documents', 'Other_Misc_Documents', 'Vehicle_Registration', 'Debtor_Creditor_Report'])
                        || in_array($document_type, array_keys($clientDocs))
                        || in_array($document_type, array_keys($venmoPaypalCash))
                        || in_array($document_type, array_keys($brokerageAccount))
                        || in_array($document_type, $adminDocs)
                        || in_array($document_type, $docsMisc)
                        || in_array($document_type, \App\Models\ClientDocumentUploaded::getTaxDocumentById())
                        || ($key == 'parentRetirementDocuments')
                        || ($key == 'parentOtherIncomeDocuments')
                        || str_starts_with($document_type, 'post_submission_doc_')
                    ) {
                        $formultiples = true;
                        $checkbox = true;
                    }
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
                                \Log::error('S3 temporaryUrl failed: ' . $e->getMessage());
                                $filePth = null;
                            }
                        }
                    }
                @endphp

                <div class="col-md-12 col-xs-12 col-sm-12 sortable-item" id="{{ $docId }}">
                    @include( 'attorney.uploaded_doc_view.docCardMainForSingleDoc')
                </div>
            @endforeach
        @endif
    </div>
</div>