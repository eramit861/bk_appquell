<div class="py-1">
    <div class="document-div">
        <div class=" single-doc-card flex-tab-wrap gap-tab-4">

            <div class="d-flex-ai-center reorder-section justify-content-between w-tab-100">
                <!-- |move  -->
                @if (($docsCount > 1) && !in_array($objKey, ['Drivers_License', 'Social_Security_Card', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card', 'Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs']))
                    <i class="dragHandle bi bi-arrows-move text-bold ms-2 text-center d-flex-ai-center edit edit-doc-name ">
                        <small class="text-bold ms-1">Reorder</small>
                    </i>
                @endif
                @if ($formultiples)
                    <div class="hide-on-desktop rename-button-div">
                        <a href="javascript:void(0)" class="text-bold edit edit-doc-name edit_doc_name_btn_{{$docId}} rename-button " onclick="edit_doc_name('{{$docId}}')">
                            Rename&nbsp;Document&nbsp;<i class="fas fa-pencil-square-o"></i>
                        </a>
                        <a href="javascript:void(0)"
                            onclick='update_doc_fn("{{$docId}}","{{ $objKey }}","{{$filedocname}}","{{$client_id}}","{{$document_file}}")'
                            class=" ms-2 submit edit_doc_name_submit_{{$docId}} d-none view_client_btn btn-new-ui-default py-2 px-3 hide-on-desktop">Save</a>
                    </div>

                @endif
            </div>

            <div class="d-flex-ai-center rename-section w-100 mt-sm-1 mt-xl-0">
                <!-- |checkbox  -->
                @if ($checkbox)
                    <input type="checkbox" class="checked_docs ms-2" data-item="{{$document_type}}" name="pdf_id[]" value="{{$doc['id']}}">
                @endif
                <!-- |logo  -->
                @include( 'attorney.uploaded_doc_view.docSvgLogo')
                <!-- |rename btn  -->
                @include( 'attorney.uploaded_doc_view.docRename')
            </div>

            <div class="d-flex-ai-center button-action-section ml-mob-auto">
                <div class="label-div mb-0 ms-2 d-flex-ai-center width-mob-fit-content">
                    @if ($formultiples)
                        @php
                        if (in_array($document_type, array_keys($clientDocs)) || in_array($document_type, array_keys($venmoPaypalCash)) || in_array($document_type, array_keys($brokerageAccount))) {
                            $months = 3;
                            if (!empty($val['client_bank_statements_premium']) || $val['client_subscription'] == \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION) {
                                $months = 6;
                            }
                            $bank_statement_month_nos = $bank_statement_months;
                            if (isset($bank_account_documents) && !empty($bank_account_documents)) {

                                foreach ($bank_account_documents as $docu) {
                                    if ($docu['document_name'] === $document_type) {
                                        $bank_statement_month_nos = ($docu['bank_account_type'] == 2) ? ($attProfitLossMonths) : $bank_statement_months;
                                        break;
                                    }
                                }
                            }
                            $hideSelect = '';
                            $brokerageMonths = null;
                            if ($key == 'parentBrokerageDocuments') {
                                $brokerageMonths = $brokerage_months;
                                $bank_statement_month_nos = $brokerage_months;
                            }
                            $statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_month_nos, null, false, $brokerageMonths);
                            $doc_type = $document_type;
                        }
                        @endphp
                        @if (in_array($document_type, array_keys($clientDocs)) || in_array($document_type, array_keys($venmoPaypalCash)) || in_array($document_type, array_keys($brokerageAccount)))
                            <select class="form-control w-auto month-select-box select-custom-padding {{ $hideSelect }}" onchange="renameDocument('{{ $client_id }}', '{{ $docId }}', this, '{{ $doc_type }}')">
                                <option value="">Choose month</option>
                                @foreach ($statement_month_array as $month => $name)
                                    <option value="{{$month}}" {{ $document_month == $month ? 'selected' : '' }}> {{$name}}</option>
                                @endforeach
                            </select>
                        @endif
                        <a href="javascript:void(0)"
                            onclick='update_doc_fn("{{$docId}}","{{ $objKey }}","{{$filedocname}}","{{$client_id}}","{{$document_file}}")'
                            class=" ms-2 submit edit_doc_name_submit_{{$docId}} d-none view_client_btn btn-new-ui-default py-2 px-3 hide-on-mobile">Save</a>

                    @endif
                    <div class="hide-on-desktop ml-auto">
                        <div class="d-flex-ai-center">
                            <!-- |status  -->
                            @include( 'attorney.uploaded_doc_view.docStatus')
                            <!-- |accept decline document  -->
                            @include( 'attorney.uploaded_doc_view.docAcceptDecline')
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="status-accept-section hide-on-mobile">
                <div class="d-flex-ai-center">
                    @if ($formultiples)
                        <a href="javascript:void(0)" class="text-bold edit edit-doc-name edit_doc_name_btn_{{$docId}}" onclick="edit_doc_name('{{$docId}}')">
                            Rename&nbsp;Document&nbsp;<i class="fas fa-pencil-square-o"></i>
                        </a>
                    @endif
                    <!-- |status  -->
                    @include( 'attorney.uploaded_doc_view.docStatus')
                    <!-- |accept decline document  -->
                    @include( 'attorney.uploaded_doc_view.docAcceptDecline')
                </div>
            </div>

            <div class="d-flex-ai-center doc-action-section justify-content-end width-mob-fit-content">
                <!-- |move to dropdopdown  -->
                @include( 'attorney.uploaded_doc_view.docMoveTo')
                <!-- |download  -->
                @include( 'attorney.uploaded_doc_view.docDownload')
                <!-- |delete document  -->
                @include( 'attorney.uploaded_doc_view.docDelete')
            </div>
            
            @if (in_array($document_type, ['Miscellaneous_Documents', 'Other_Misc_Documents']))
                <div class=" creditor-select-section justify-content-end width-mob-fit-content px-2">
                    <!-- |creditor selectbox -->
                    @include( 'attorney.uploaded_doc_view.docCreditorSelectBox')
                </div>
            @endif
        </div>
    </div>
</div>