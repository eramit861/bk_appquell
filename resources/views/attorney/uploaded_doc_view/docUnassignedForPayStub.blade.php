@php
$ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
$attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
$is_associate = !empty($ClientsAssociateId) ? 1 : 0;
$attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);
@endphp

@foreach ($documentuploaded as $key => $data)
    @if (isset($documentsAddedForThisEmployer) && !in_array($data['id'], $documentsAddedForThisEmployer))
        @continue
    @endif
    
    @php
    $docData = Helper::getDocumentImage($data['document_type']);
    if (empty($docData)) {
        $ottype = \App\Models\ClientDocumentUploaded::OTHER_MISC_DOCUMENTS;
        $docData = Helper::getDocumentImage($ottype);
    }
    $checkbox = false;
    if ($data['mime_type'] == 'application/pdf') {
        $checkbox = true;
    }
    $doclasscs = 'not-uploaded';
    if ($data['id'] > 0) {
        $doclasscs = '';
    }
    $declineText = '';
    $showResubmitDoc = false;
    $docActiveChildClass = "";

    if (!empty($data['id'])) {
        if ($data['document_status'] == 2) {
            $declineText = $data['document_decline_reason'];
        }
        if ($data['document_status'] == 1) {
            $showResubmitDoc = true;
            $docActiveChildClass = '';
        }

        $enableAction = 0;
        if (in_array($data['document_status'], [0, 1, 2])) {
            $enableAction = 1;
        }
    }
    $indicator = "d-none";
    if ($data['is_viewed_by_attorney'] == 0) {
        $indicator = "";
    }
    $formultiples = false;

    if (
        in_array($data['document_type'], ['Co_Debtor_Pay_Stubs', 'Debtor_Pay_Stubs', 'W2_Last_Year', 'W2_Year_Before', 'Insurance_Documents'])
        || in_array($data['document_type'], ['Miscellaneous_Documents', 'Other_Misc_Documents', 'Vehicle_Registration', 'Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'])
        || in_array($data['document_type'], array_keys($clientDocs))
        || in_array($data['document_type'], array_keys($venmoPaypalCash))
        || in_array($data['document_type'], array_keys($brokerageAccount))
        || in_array($data['document_type'], $adminDocs)
        || in_array($data['document_type'], $docsMisc)
        || in_array($data['document_type'], \App\Models\ClientDocumentUploaded::getTaxDocumentById())
        || in_array($data['document_type'], ['debtor_Social_Security_Annual_Award_Letter', 'debtor_VA_Benefit_Award_Letter', 'debtor_Unemployment_Payment_History_Last_7_Months'])
        || in_array($data['document_type'], ['codebtor_Social_Security_Annual_Award_Letter', 'codebtor_VA_Benefit_Award_Letter', 'codebtor_Unemployment_Payment_History_Last_7_Months'])
    ) {
        $formultiples = true;
    }

    $docId = Helper::validate_key_value('id', $data, 'radio');
    $document_type = Helper::validate_key_value('document_type', $data);
    $document_file = Helper::validate_key_value('document_file', $data);
    $document_name = Helper::validate_key_value('document_name', $data);
    $added_by_attorney = Helper::validate_key_value('added_by_attorney', $data, 'radio');
    $updated_name = Helper::validate_key_value('updated_name', $data, );
    $docname = !empty($updated_name) ? $updated_name : $document_name;
    $document_status = Helper::validate_key_value('document_status', $data, 'radio');

    if ($formultiples) {
        $filedocname = str_replace("documents/" . $client_id . "/", "", $document_file);
        $show = '';
    }
    @endphp

    <div class="col-12">
        @include( 'attorney.uploaded_doc_view.docCardMainForSingleDoc', [ 'doc' => $data ] )
    </div>
@endforeach