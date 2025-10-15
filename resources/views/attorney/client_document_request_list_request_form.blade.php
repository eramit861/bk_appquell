<div class="col-xl-4 col-lg-6 col-md-12 mt-1 <?php echo $doc_list_name?>">
    <?php if (array_key_exists('Post_submission_documents', $documentList)) {?>
    <p class="mb-2 text-bold"><span class="border-bottom-light-blue">Post submission documents</span></p>
    
    <?php foreach ($documentList as $key => $label) {
        if (!in_array($key, ['Post_submission_documents'])) {
            continue;
        }
        ?>
        @include('attorney.client_document_request_list_request_form_common_code')
    <?php } ?>
    <?php } ?>

    <p class="mb-2 text-bold"><span class="border-bottom-light-blue">Debtor's Document List</span></p>
    <?php foreach ($documentList as $key => $label) {
        if (!in_array($key, ['Debtor_Pay_Stubs','Drivers_License','Social_Security_Card'])) {
            continue;
        }
        ?>
        @include('attorney.client_document_request_list_request_form_common_code')
    <?php } ?>
    
    <?php if ($client->client_type == 2) { ?>
        <p class="mb-2 mt-3 text-bold"><span class="border-bottom-light-blue co_deb_doc_list">Non-Filing Spouse Document List</span></p>
    <?php } ?>
    <?php if ($client->client_type == 3) { ?>
        <p class="mb-2 mt-3 text-bold"><span class="border-bottom-light-blue co_deb_doc_list">Co-Debtor's Document List</span></p>
    <?php } ?>
    
    <?php foreach ($documentList as $key => $label) {
        if (!in_array($key, ['Co_Debtor_Pay_Stubs','Co_Debtor_Drivers_License','Co_Debtor_Social_Security_Card'])) {
            continue;
        }
        ?>
       @include('attorney.client_document_request_list_request_form_common_code')					
    <?php } ?>

    <p class="mb-2 text-bold mt-3"><span class="border-bottom-light-blue">Secured Loan Documents</span></p>
    <?php foreach ($documentList as $key => $label) {
        $checkArray = [
            "Current_Mortgage_Statement",
            // "Current_Mortgage_Statement_1_1", "Current_Mortgage_Statement_2_1", "Current_Mortgage_Statement_3_1", "Current_Mortgage_Statement_1_2", "Current_Mortgage_Statement_2_2", "Current_Mortgage_Statement_3_2", "Current_Mortgage_Statement_1_3", "Current_Mortgage_Statement_2_3", "Current_Mortgage_Statement_3_3", "Current_Mortgage_Statement_1_4", "Current_Mortgage_Statement_2_4", "Current_Mortgage_Statement_3_4", "Current_Mortgage_Statement_1_5", "Current_Mortgage_Statement_2_5", "Current_Mortgage_Statement_3_5",
            "Current_Auto_Loan_Statement",
            // "Current_Auto_Loan_Statement_1", "Current_Auto_Loan_Statement_2", "Current_Auto_Loan_Statement_3", "Current_Auto_Loan_Statement_4", "Other_Loan_Statement_1", "Other_Loan_Statement_2",
            "Vehicle_Information",
        ];

        if (!in_array($key, $checkArray)) {
            continue;
        }
        ?>
        @include('attorney.client_document_request_list_request_form_common_code')					
    <?php } ?>

    <p class="admin-document mb-2 mt-3 text-bold"><span class="border-bottom-light-blue">Select below to add custom document names:</span></p>
    <?php
            $adminDocuments = !empty($adminDocuments) ? json_decode($adminDocuments, true) : [];
$adminListShow = (!empty($adminDocuments) && is_array($adminDocuments)) ? '' : 'hide-data';
if (!empty($adminDocuments) && is_array($adminDocuments)) {
    $uploadedClass = "font-color-fail";
    foreach ($adminDocuments as $index => $data) {
        ?>
            <div class="mt-1 admin-document-list list-item-<?php echo $index; ?>">
                <label class="w-100 d-flex" for="<?php echo 'admin_doc_'.$doc_list_name.$data['document_type']; ?>">
                    <span class="d-status <?php echo $uploadedClass; ?>"><i class="fa fa-cloud-upload-alt" aria-hidden="true"></i></span>
                    <span class="doc-card w-100 name_admin_<?php echo $index; ?> <?php echo $uploadedClass; ?>"><?php echo Helper::validate_key_value('document_name', $data); ?></span>
                    <input type="checkbox" 
                        class="float_right mt-1 notify_admin_doc" 
                        id="<?php echo 'admin_doc_'.$doc_list_name.$data['document_type']; ?>" 
                        name="notify_admin_doc_<?php echo $index; ?>"
                        value="1"
                        onclick="addToPreview('admin','<?php echo $index; ?>')"
                        data-key="<?php echo Helper::validate_key_value('document_type', $data); ?>"
                        data-docname="<?php echo Helper::validate_key_value('document_name', $data); ?>"
                    >
                </label>
            </div>	
    <?php
    }
}
?>

    <div class="new-admin-document hide-data">
        <div>
            <input type="text" name="admin_document" class="form-control mt-3 only_alphanumeric" placeholder="Enter Document Name" maxlength="100">
        </div>
    </div>
    <div>
        <div class="pt-4">
            <a href="javascript:void(0)" class="add-new-btn add-btn" onclick="addNewAdminDocument()">
            Select to Add Personalized Doc(s) Request 
            </a>
            <a href="javascript:void(0)" class="add-new-btn save-btn hide-data" onclick="saveNewAdminDocument()">
                Save
            </a>
        </div>
    </div>

</div>

<div class="col-xl-4 col-lg-6 col-md-12 <?php echo $doc_list_name?>">

    <p class="mb-2 mt-2 text-bold"><span class="border-bottom-light-blue">Tax Returns</span></p>
    <?php foreach ($documentList as $key => $label) {
        if (!in_array($key, ['Last_Year_Tax_Returns','Prior_Year_Tax_Returns','Prior_Year_Two_Tax_Returns','Prior_Year_Three_Tax_Returns'])) {
            continue;
        }
        ?>
        @include('attorney.client_document_request_list_request_form_common_code')						
    <?php } ?>

    <p class="mb-2 text-bold mt-3"><span class="border-bottom-light-blue">Requested Documents</span></p>
    <?php foreach ($documentList as $key => $label) {
        if (!in_array($key, ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report', "Vehicle_Registration"])) {
            continue;
        }
        ?>
        @include('attorney.client_document_request_list_request_form_common_code')					
    <?php } ?>
    

</div>

<div class="col-xl-4 col-lg-6 col-md-12 <?php echo $doc_list_name?>">

    <p class="mb-2 mt-2 text-bold"><span class="border-bottom-light-blue">Additional Attorney Docs</span></p>
    <?php
         $attorneydocuments = array_merge($attorneydocuments, ['Miscellaneous_Documents' => 'Additional or Unlisted Documents']);

foreach ($attorneydocuments as $attr_doc_key => $value) {
    $showHideCheckAdd = "";
    $attorneydocKey = $attr_doc_key;
    $uploadedClass = "font-color-fail";
    $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
    if (in_array($attorneydocKey, $documentuploaded)) {
        $uploadedClass = "font-color-sucess";
        $doc = Helper::getArrayByKey($key, $list);
        $showHideCheckAdd = "hide-data";
        if (!empty($doc)) {
            $renabledupload = $doc['document_enable_reupload'];
            $declineReason = $doc['document_decline_reason'];
            $status = $doc['document_status'];
            if ($status == 1) {
                $statusmsg = "Accepted";
                $uploadedClass = "font-color-accept";
                $fStatus = '<i class="fas fa-check-circle"></i>';
            }
            if ($status == 2) {
                $statusmsg = "Declined";
                $uploadedClass = "font-color-decline";
                $fStatus = '<i class="fas fa-ban"></i>';
            }
        }
    }
    ?>
        <div class="mt-1">
            <label class="w-100 d-flex" for="<?php echo empty($showHideCheckAdd) ? 'att_doc_'.$doc_list_name.$key : ''; ?>" >
                <span class="d-status <?php echo $uploadedClass; ?>"><?php echo $fStatus; ?></span>
                <span class="doc-card w-100 name_ad_<?php echo $key; ?> <?php echo $uploadedClass; ?>"><?php echo $value; ?></span>
                <input 
                    type="checkbox"
                    id="<?php echo 'att_doc_'.$doc_list_name.$key; ?>" 
                    class="float_right mt-1 notify_ad_doc <?php echo $showHideCheckAdd; ?>" 
                    name="notify_ad_doc_<?php echo $key; ?>" 
                    onclick="addToPreview('add','<?php echo $key; ?>')" 
                    value="1" 
                    data-key="<?php echo $attr_doc_key; ?>" 
                    data-docname="<?php echo $value; ?>"
                >
            </label>
        </div>
    <?php } ?>

    <p class="mb-2 mt-2 text-bold"><span class="border-bottom-light-blue">Bank Statements docs:</span></p>
    <!--  Bank Statement docs-->

    <?php
        $statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_months ?? 3);
foreach ($bankDocuments as $key => $label) {
    $isPending = false;
    $matchingObjects = array_filter($list, function ($item) use ($key) {
        return $item['document_type'] === $key;
    });
    array_values($matchingObjects);
    $missing_months = '';
    foreach ($statement_month_array as $month_key => $month_value) {
        $found = false;
        foreach ($matchingObjects as $object) {
            if ($object['document_month'] === $month_key) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $missing_months .= $month_value . ', ';
        }
    }
    $missing_months = rtrim($missing_months, ', ');

    $label = !empty($missing_months) ? $label.' ('.$missing_months.')' : $label;
    $isPending = !empty($missing_months) ? true : false;
    ?>
        @include('attorney.client_document_request_list_request_form_common_code', ['isPending' => $isPending])					
    <?php
}
foreach ($venmoPaypalCash as $key => $label) {
    $isPending = false;
    $matchingObjects = array_filter($list, function ($item) use ($key) {
        return $item['document_type'] === $key;
    });
    array_values($matchingObjects);
    $missing_months = '';
    foreach ($statement_month_array as $month_key => $month_value) {
        $found = false;
        foreach ($matchingObjects as $object) {
            if ($object['document_month'] === $month_key) {
                $found = true;
                break;
            }
        }
        if (!$found) {
            $missing_months .= $month_value . ', ';
        }
    }
    $missing_months = rtrim($missing_months, ', ');

    $label = !empty($missing_months) ? $label.' statement(s): ('.$missing_months.')' : $label;
    $isPending = !empty($missing_months) ? true : false;

    ?>
        @include('attorney.client_document_request_list_request_form_common_code', ['isPending' => $isPending, 'addVideo' => 1])					
    <?php
}
$isPending = false;
foreach ($brokerageAccount as $key => $label) {
    ?>
        @include('attorney.client_document_request_list_request_form_common_code', ['isPending' => $isPending])					
    <?php
}
?>
    <!--  Life Insurance docs -->
    <?php
    foreach ($lifeInsuranceDocuments as $key => $label) {
        ?>
        @include('attorney.client_document_request_list_request_form_common_code')					
    <?php } ?>

</div>

<div class="col-xl-12 col-lg-12 col-md-12">
    <label class="float_right mt-3" style="font-style: italic;">
        <span class=" text-danger">Not Uploaded*</span><span class="ml-3 text-success">Uploaded*</span>
    </label>
</div>

