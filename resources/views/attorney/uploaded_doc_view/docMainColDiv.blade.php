@php
$docsCount = count($docs);
$bank_statement_month_nos = $bank_statement_months;
$banktypeString = '';
$documentAndMissingText = '';
$missing_months = '';
$allbankUploaded = true;
if (in_array($objKey, $notOwned)) {
    $notOwnedproperty = "Client selected no document available";
}

if ($isStatements == 1) {
    $ClientsAssociateId = \App\Models\ClientsAssociate::getAssociateId($client_id);
    $attorney_id = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
    $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
    $attProfitLossMonths = \App\Models\AttorneySettings::getProfitLossMonths($attorney_id, $is_associate);

    foreach ($bank_account_documents as $bnksacc) {
        if ($bnksacc['document_name'] == $objKey && $bnksacc['bank_account_type'] == 1) {
            $banktypeString = "<small class='ms-1 absolute-tick font-weight-bold text-c-light-blue'>(Personal)</small>";
        }
        if ($bnksacc['document_name'] == $objKey && $bnksacc['bank_account_type'] == 2) {
            $bank_statement_month_nos = ($bnksacc['bank_account_type'] == 2) ? $attProfitLossMonths : $bank_statement_months;
            $banktypeString = "<small class='ms-1 absolute-tick font-weight-bold text-c-blue'>(Business)</small>";
        }
    }

    $brokerageMonths = null;
    if ($key == 'parentBrokerageDocuments') {
        $brokerageMonths = $brokerage_months;
        $bank_statement_month_nos = $brokerage_months;
        $addCurrentMonthToDate = false;
    }

    $statement_month_array = DateTimeHelper::getBankStatementShortMonthArray($bank_statement_month_nos, null, $addCurrentMonthToDate, $brokerageMonths);

    foreach ($statement_month_array as $month_key => $month_value) {
        $found = false;
        foreach ($docs as $object) {
            if ($object['document_month'] === $month_key) {
                $found = true;
                $missing_months .= '<span class="text-success">' . $month_value . '</span>, ';
                ;
                break;
            }
        }
        if (!$found) {
            $allbankUploaded = false;
            $missing_months .= '<span class="text-danger">' . $month_value . '</span>, ';
        }
    }
    $missing_months = rtrim($missing_months, ', ');
    if (!empty($missing_months)) {
        $documentAndMissingText = !empty($banktypeString) ? $missing_months : '' . $missing_months;
    } else {
        $successString = "<span class='text-c-green font-weight-bold ml-2'>All Uploaded</span>";
        $documentAndMissingText = !empty($banktypeString) ? $successString : '' . $successString;
    }
}

$acceptedCount = 0;
$declinedCount = 0;
$checkbox = false;
$parentIndicator = "d-none";
if (isset($docs) && is_array($docs)) {
    foreach ($docs as $doc) {
        if ((isset($doc['document_status']) && $doc['document_status'] == 1) || (isset($doc['document_status']) && $doc['document_status'] !== 2 && isset($doc['added_by_attorney']) && ($doc['added_by_attorney'] == 1))) {
            $acceptedCount++;
        }
        if (isset($doc['document_status']) && $doc['document_status'] == 2) {
            $declinedCount++;
        }
        if (
            !$checkbox &&
            (in_array($objKey, ['Co_Debtor_Pay_Stubs', 'Debtor_Pay_Stubs', 'W2_Last_Year', 'W2_Year_Before', 'Insurance_Documents'])
                || in_array($objKey, ['Miscellaneous_Documents', 'Other_Misc_Documents', 'Vehicle_Registration', 'Debtor_Creditor_Report'])
                || in_array($objKey, array_keys($clientDocs))
                || in_array($objKey, array_keys($venmoPaypalCash))
                || in_array($objKey, array_keys($brokerageAccount))
                || in_array($objKey, $adminDocs)
                || in_array($objKey, $docsMisc)
                || in_array($objKey, \App\Models\ClientDocumentUploaded::getTaxDocumentById())
                || ($key == 'parentRetirementDocuments')
                || ($key == 'parentOtherIncomeDocuments'))
                || str_starts_with($objKey, 'post_submission_doc_')
        ) {
            $checkbox = true;
        }
        if (Helper::validate_key_value('is_viewed_by_attorney', $doc, 'radio') == 0) {
            $parentIndicator = "";
        }
    }
}


$isIdSection = in_array($objKey, ['Drivers_License', 'Social_Security_Card', 'Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card']);

@endphp

<div class="col-{{ $isIdSection ? '12 col-md-6' : '12' }}">
    <form id="{{$objKey}}" class="main_form_{{$objKey}}" data-parentKey="{{$key}}"
        action="{{ route('combine_and_download_tax_return', ['id' => $val['id'], 'type' => $objKey, 'employer_id' => null]) }}"
        method="GET">
        @include( 'attorney.uploaded_doc_view.docMainColFormData')
    </form>
</div>