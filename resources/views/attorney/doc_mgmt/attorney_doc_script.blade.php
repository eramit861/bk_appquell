@php
$parentSecuredDocumentsData = isset($mainDocumentTypeStructure) ? Helper::validate_key_value('parentSecuredDocuments', $mainDocumentTypeStructure, 'array') : [];
$morgageLoanStatements = Helper::validate_key_value('Current_Mortgage_Statement', $parentSecuredDocumentsData, 'array');
$autoLoanStatements = Helper::validate_key_value('Current_Auto_Loan_Statement', $parentSecuredDocumentsData, 'array');

$payCheckdata = \App\Models\ClientDocuments::pay_check_calculation($client_id);
$debtorPayCheckData = Helper::validate_key_value('debtorPayCheckData', $payCheckdata, 'array');
$codebtorPayCheckData = Helper::validate_key_value('codebtorPayCheckData', $payCheckdata, 'array');
$payCheckData = array_merge($debtorPayCheckData, $codebtorPayCheckData);

function getPayDatesByEmployerId($payCheckData)
{
    $datesListArray = [];
    foreach ($payCheckData as $data) {
        $datesList = '<option value="">Select Pay Date</option>';
        $hasMissingPaystubs = false;

        if (!empty($data['pay_dates'])) {
            $pay_dates_data = array_reverse($data['pay_dates']);

            foreach ($pay_dates_data as $dateObj) {
                if (!$dateObj['exists']) {
                    $hasMissingPaystubs = true;
                    $datesList .= "<option value='".date('m/d/Y', strtotime($dateObj['pay_date']))."'>".$dateObj['display_date']."</option>";
                }
            }
        }

        // If no missing paystubs found, show completion message
        if (!$hasMissingPaystubs && !empty($data['pay_dates'])) {
            $datesList = '<option value="">All Paystubs Uploaded ✓</option>';
        }

        $datesListArray[$data['emp_data']['id']] = $datesList;
    }

    return json_encode($datesListArray);
}

$payDates = getPayDatesByEmployerId($payCheckData);
@endphp

<div class="modal fade" id="payDateModal" tabindex="-1" aria-labelledby="payDateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="payDateModalLabel">Enter Pay Date</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <select id="payDateSelect" class="select-input form-select"></select>
                    </div>
                    <div class="col-12 col-md-1 d-flex-ai-center justify-content-center"><span class="">OR</span>
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="text" id="payDateInput" class="date_filed form-control "
                            placeholder="MM/DD/YYYY" required>
                    </div>
                    <div class="col-0 col-md-5"></div>
                    <div class="col-12 col-md-4">
                        <div id="payDateError" class="invalid-feedback d-block" style="display:none;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="cancelPayDate" class="btn btn-outline-secondary"
                    data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="submitPayDate" class="btn btn-primary">Continue</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Configuration object for Attorney Document Script
    window.AttorneyDocScriptConfig = {
        morgageLoanStatements: @json($morgageLoanStatements),
        autoLoanStatements: @json($autoLoanStatements),
        payDates: {!! $payDates !!},
        clientId: '{{ $client_id }}',
        userId: '{{ $User["id"] }}',
        selectedDocType: '{{ @$_GET["type"] }}',
        documentMoveToList: @json($documentMoveToList ?? []),
        bankDocTypes: @json(array_merge(array_keys($clientDocs ?? []), array_keys($venmoPaypalCash ?? []), array_keys($brokerageAccount ?? []))),
        assets: {
            loadingGif: '{{ asset("assets/img/loading.gif") }}'
        },
        routes: {
            getUpdatedDocViewHtml: "{{ route('get_updated_doc_view_html') }}",
            assignTrustee: "{{ route('assign_trustee') }}",
            attorneyClientUploadedDocuments: "{{ route('attorney_client_uploaded_documents', ['id' => $client_id]) }}",
            attorneyClientUploadedDocumentsWithUser: "{{ route('attorney_client_uploaded_documents', ['id' => $User['id']]) }}",
            markDocumentSeen: "{{ route('mark_document_seen') }}",
            updateViewedByAttorney: "{{ route('update_viewed_by_attorney') }}",
            updateNotificationType: "{{ route('update_notification_type') }}",
            postSubmissionDocumentsEnabled: "{{ route('post_submission_documents_enabled') }}",
            updateDocDate: "{{ route('update_doc_date') }}",
            updateBankNameAfterOrder: "{{ route('update_bank_name_after_order') }}",
            updateTaxNameAfterOrder: "{{ route('update_tax_name_after_order') }}",
            clientDocDownloadFormat: "{{ route('client_doc_download_format') }}",
            updateDocName: "{{ route('update_doc_name') }}",
            moveDocumentTo: "{{ route('move_document_to') }}",
            checkZipStatus: "{{ route('check_zip_status') }}",
            updateCreditorsToDoc: "{{ route('update_creditors_to_doc') }}",
            saveDocumentOrder: "{{ route('save_document_order') }}",
            payCheckCalculation: "{{ route('pay_check_calculation') }}",
            markOwnDocument: "{{ route('mark_own_document') }}",
            nonConciergeDocumentsListPopup: "{{ route('non_concierge_documents_list_popup') }}",
            combineAndDownloadTaxReturn: "{{ route('combine_and_download_tax_return', ['id' => 'CLIENT_ID', 'type' => 'DOC_TYPE', 'employer_id' => null]) }}",
            postSubmissionDocumentAdd: "{{ route('post_submission_document_add') }}",
            getThumbnailGenerateStatus: "{{ route('get_thumbnail_generate_status') }}",
            processByGraphql: "{{ route('process_by_graphql') }}"
        }
    };
</script>
<script src="{{ asset('js/attorney-doc-script.js') }}?v=1.0"></script>
@endpush
