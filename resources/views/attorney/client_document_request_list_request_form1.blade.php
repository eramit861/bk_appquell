<?php
$postSubEnable = false;
$parentClass = 'col-6';
$childClass = 'col-6';
if ($client->client_type == 1) {
    $parentClass = 'col-12';
    $childClass = 'col-12 col-sm-6 col-lg-4 col-xl-3';
}
$isTaxReturnDocs = false;
?>


<div class="light-gray-div mt-3 mb-2 pb-3">
    <h2>Questionnaire Sections Reviewed</h2>
    <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
        <div class="col-12">
            <div class="label-div">
                <label class="text-bold" style="font-style: italic;"> 
                    <span class="<?php echo in_array('basic_info', $rwData) ? 'text-success' : 'text-danger'; ?>">Basic Info</span>,
                    <span class="<?php echo in_array('property', $rwData) ? 'text-success' : 'text-danger'; ?>">Property</span>,
                    <span class="<?php echo in_array('debt', $rwData) ? 'text-success' : 'text-danger'; ?>">Debts</span>,
                    <span class="<?php echo in_array('income', $rwData) ? 'text-success' : 'text-danger'; ?>">Income</span>,
                    <span class="<?php echo in_array('expense', $rwData) ? 'text-success' : 'text-danger'; ?>">Expenses</span>,
                    <span class="<?php echo in_array('sofa', $rwData) ? 'text-success' : 'text-danger'; ?>">Financial Affairs</span>
                </label>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-12">
        <div class="section-edit-div d-inline float_right mt-2">
            <span class="select-all-button select-all-span text-success" onclick="selectAll()" style="font-style: initial;">Select All Remaining Required Doc(s)</span>
            <span class="select-all-button deselect-all-span hide-data text-danger" onclick="deselectAll()" style="font-style: initial;">Deselect All Remaining Required Doc(s)</span>
        </div>
    </div>
    
    <div class="col-12 <?php echo $doc_list_name?>">
        <?php if (array_key_exists('Post_submission_documents', $documentList)) {
            $postSubEnable = true;?>
           

            <div class="light-gray-div mt-3 mb-2 pb-3">
                <h2>Post submission documents</h2>
                <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                    <?php foreach ($documentList as $key => $label) {
                        if (! (str_starts_with($key, 'post_submission_doc_') || in_array($key, ['Post_submission_documents']))) {
                            continue;
                        }
                        ?>
                        @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-3'])
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="col-12 col-sm-6 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2><?php echo $debtorname; ?> Document List</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php foreach ($documentList as $key => $label) {
                    if (!in_array($key, ['Debtor_Pay_Stubs','Drivers_License','Social_Security_Card'])) {
                        continue;
                    }
                    if ($key != 'Debtor_Pay_Stubs') {
                        ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' =>  $childClass])
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>

    <?php if ($client->client_type == 2 || $client->client_type == 3) { ?>
    <div class="col-6 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>
                <?php if ($client->client_type == 2) { ?>
                    <?php echo $spousename; ?> Document List
                <?php } ?>
                <?php if ($client->client_type == 3) { ?>
                    <?php echo $spousename; ?> Document List
                <?php } ?>
            </h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php foreach ($documentList as $key => $label) {
                    if (!in_array($key, ['Co_Debtor_Pay_Stubs','Co_Debtor_Drivers_License','Co_Debtor_Social_Security_Card'])) {
                        continue;
                    }
                    if ($key != 'Co_Debtor_Pay_Stubs') {
                        ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-6'])	
                <?php
                    }
                } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    
    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Secured Loan Documents</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php
$clientPropertyData = \App\Services\Client\CacheProperty::getPropertyData($client_id);
$clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
$clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];
$clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, false, true);
$clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($client_id);
$mortgageLoanList = Helper::validate_key_value('clientDocumentList', $clientDebtorResidentDocumentList);
$vehicleLoanList = Helper::validate_key_value('vehiclesDocumentList', $clientDebtorVehiclesDocumentList);
$vehicleLoanList = is_array($vehicleLoanList) ? $vehicleLoanList : [];
$mortgageLoanList = is_array($mortgageLoanList) ? $mortgageLoanList : [];
$mergedLoanList = array_filter(array_merge($mortgageLoanList, $vehicleLoanList));
$mergedLoanList = array_merge($mergedLoanList, array_keys($vehicleRegisterationDocs));
$mergedLoanList[] = 'Insurance_Documents';
?>
                <?php foreach ($documentList as $key => $label) {
                    if (!in_array($key, $mergedLoanList)) {
                        continue;
                    }
                    if (isset($excludeDocs) && !empty($excludeDocs) && is_array($excludeDocs) && in_array($key, $excludeDocs)) {
                        continue;
                    }
                    ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-12 col-sm-4 col-lg-3 col-xl-2'])					
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Tax Returns</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php
                    foreach ($documentList as $key => $label) {
                        if (!in_array($key, ['Last_Year_Tax_Returns','Prior_Year_Tax_Returns','Prior_Year_Two_Tax_Returns','Prior_Year_Three_Tax_Returns'])) {
                            continue;
                        }
                        ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-12 col-sm-6 col-lg-4 col-xl-3', 'isTaxReturnDocs' => true])						
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Retirement Docs</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php
                            foreach ($retirement_pension as $key => $label) {
                                ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-12 col-sm-6'])					
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Requested Documents</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php
                                $reqdoc = ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report'];
foreach ($documentList as $key => $label) {
    if (!in_array($key, $reqdoc)) {
        continue;
    }
    ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-12 col-sm-6 col-lg-4 col-xl-3'])					
                <?php }

$isPending = false;
foreach ($unpaid_wages as $key => $label) { ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['isPending' => $isPending, 'colValue' => 'col-6'])					
                <?php } ?>
            </div>
        </div>
    </div>
    
    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Additional Attorney Docs</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?> w-100 m-0">	
                <?php
$attorneydocuments = array_merge($attorneydocuments, ['Miscellaneous_Documents' => 'Additional or Unlisted Documents']);

foreach ($attorneydocuments as $attr_doc_key => $value) {
    $showHideCheckAdd = "";
    $attorneydocKey = $attr_doc_key;
    $uploadedClass = "font-color-fail";
    $borderClass = 'not-uploaded-border';
    $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
    $cardBg = "";
    if (in_array($attorneydocKey, $documentuploaded)) {
        $uploadedClass = "text-c-white";
        $borderClass = '';
        $cardBg = "accepted";
        $doc = Helper::getArrayByKey($attr_doc_key, $list);
        $showHideCheckAdd = "hide-data";
        if (!empty($doc)) {
            $renabledupload = $doc['document_enable_reupload'];
            $declineReason = $doc['document_decline_reason'];
            $status = $doc['document_status'];
            if ($status == 1) {
                $statusmsg = "Accepted";
                $cardBg = "accepted";
                $uploadedClass = "text-c-white";
                $borderClass = '';
                $fStatus = '<i class="fas fa-check-circle"></i>';
            }
            if ($status == 2) {
                $statusmsg = "Declined";
                $cardBg = "declined";
                $uploadedClass = "text-c-white";
                $borderClass = '';
                $fStatus = '<i class="fas fa-ban"></i>';
            }
        }
    }
    ?>
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mt-1">
                        <div class="card item-card <?php echo $borderClass; ?> <?php echo $cardBg; ?>" data-label="">
                            <div class="card-body p-1">
                                <label class="w-100 d-flex mb-0" for="<?php echo empty($showHideCheckAdd) ? 'att_doc_'.$doc_list_name.$attr_doc_key : ''; ?>" >
                                    <span class="d-status <?php echo $uploadedClass; ?>"><?php echo $fStatus; ?></span>
                                    <span class="doc-card w-100 name_ad_<?php echo $attr_doc_key; ?> <?php echo $uploadedClass; ?>"><?php echo $value; ?></span>
                                    <input 
                                        type="checkbox"
                                        id="<?php echo 'att_doc_'.$doc_list_name.$attr_doc_key; ?>" 
                                        class="float_right d-none mt-1 notify_ad_doc <?php echo $showHideCheckAdd;
    echo ($borderClass == "not-uploaded-border") ? ' not-accepted' : '' ; ?>" 
                                        name="notify_ad_doc_<?php echo $attr_doc_key; ?>" 
                                        onclick="addToPreview('add','<?php echo $attr_doc_key; ?>')" 
                                        value="1" 
                                        data-key="<?php echo $attr_doc_key; ?>" 
                                        data-docname="<?php echo $value; ?>"
                                    >
                                </label>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    
    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Bank Statements docs</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <!--  Bank Statement docs-->
                <?php
                    foreach ($bankDocuments as $key => $label) {
                        if ((isset($bankDocsBussinessKeys) && !empty($bankDocsBussinessKeys)) && in_array($key, $bankDocsBussinessKeys)) {
                            $statement_month_array = DateTimeHelper::getBankStatementMonthArray(6, null, $addCurrentMonthToDate);
                        } else {
                            $statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_months ?? 3, null, $addCurrentMonthToDate);
                        }
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
                    @include('attorney.client_document_request_list_request_form_common_code1', ['isPending' => $isPending, 'colValue' => 'col-6'])					
                <?php
                    }
$statement_month_array = DateTimeHelper::getBankStatementMonthArray($bank_statement_months ?? 3, null, $addCurrentMonthToDate);
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
                    @include('attorney.client_document_request_list_request_form_common_code1', ['isPending' => $isPending, 'addVideo' => 1, 'colValue' => 'col-6'])					
                <?php
}
$isPending = false;
foreach ($brokerageAccount as $key => $label) {
    ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['isPending' => $isPending, 'colValue' => 'col-6'])					
                <?php
}
?>
                <!--  Life Insurance docs -->
                <?php
    foreach ($lifeInsuranceDocuments as $key => $label) {
        ?>
                    @include('attorney.client_document_request_list_request_form_common_code1', ['colValue' => 'col-6'])					
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2><?php echo $debtorname; ?> Pay Stubs (Past 7 Months)</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php foreach ($documentList as $key => $label) {
                    if (!in_array($key, ['Debtor_Pay_Stubs'])) {
                        continue;
                    }
                    $client_type = 1;
                    $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, $client_type);
                    if (!empty($response['debtorPayCheckData'])) {
                        ?>
                    <div class="col-12">
                        @include('attorney.client.pay_check_calculation_without_accordian_requested_form', ['payCheckData' => $response['debtorPayCheckData'], 'completeList' => $response['debtorCompleteList'], 'doc_list_name' => 'Debtor_Pay_Stubs', 'isUploadedScreen' => false])
                    </div>                        
                <?php } else { ?>
                    <div class='col-12'>
                        <p class="text-center mb-0">
                            You haven't filled out the <span class="text-c-blue">Current Income</span> in the questionnaire yet. In order to upload pay stubs you must fill this section out first so the system can determine what pay stubs need to be uploaded for the Court. Please fill out the Current Income section first and then upload your pay stubs. <br><span class="text-c-blue">Click here to go to the Current Income Tab.</span>
                        </p>
                    </div>
                <?php }
                } ?>
            </div>
        </div>
    </div>

    <?php if ($client->client_type == 2 || $client->client_type == 3) { ?>
    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>
                <?php if ($client->client_type == 2) { ?>
                    <?php echo $spousename; ?> Pay Stubs (Past 7 Months)
                <?php } ?>
                <?php if ($client->client_type == 3) { ?>
                    <?php echo $spousename; ?> Pay Stubs (Past 7 Months)
                <?php } ?>
            </h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php foreach ($documentList as $key => $label) {
                    if (!in_array($key, ['Co_Debtor_Pay_Stubs'])) {
                        continue;
                    }
                    $client_type = 2;
                    $response = \App\Models\ClientDocuments::pay_check_calculation($client_id, $client_type);
                    if (!empty($response['codebtorPayCheckData'])) {
                        ?>
                    <div class="col-12">
                        @include('attorney.client.pay_check_calculation_without_accordian_requested_form', ['payCheckData' => $response['codebtorPayCheckData'], 'completeList' => $response['codebtorCompleteList'], 'doc_list_name' => 'Co_Debtor_Pay_Stubs', 'isUploadedScreen' => false])
                    </div>
                <?php } else { ?>
                    <div class='col-12'>
                        <p class="text-center mb-0">
                        You haven't filled out the <span class="text-c-blue">Current Income</span> in the questionnaire yet. In order to upload pay stubs you must fill this section out first so the system can determine what pay stubs need to be uploaded for the Court. Please fill out the Current Income section first and then upload your pay stubs. <br><span class="text-c-blue">Click here to go to the Current Income Tab.</span>
                        </p>
                    </div>
                <?php } ?>				
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if (isset($debtorBussinessData) && !empty($debtorBussinessData)) { ?>
    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2><?php echo $debtorname; ?> Profit/Loss</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <!-- Debtor Business docs -->
                <?php
                            if (isset($debtorBussinessData) && !empty($debtorBussinessData)) {
                                foreach ($debtorBussinessData as $key => $label) {
                                    ?>
                <div class="col-12">
                    <p class="mb-0 text-bold"><span class="text-c-light-blue"><?php echo $label; ?></span></p>
                </div>
                @include('attorney.client_document_request_list_Profit_loss_labels', ['colValue' => 'col-3', 'incomeProfitLoss' => $debtorPLData])	
                <?php
                                }
                            } else {
                                echo "<div class='col-12'><span class='text-italic'>No Profit/Loss added yet.</span></div>";
                            }
        ?>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if (isset($spouseBussinessData) && !empty($spouseBussinessData) && isset($spousePLData) && !empty($spousePLData)) { ?>
    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2><?php echo $spousename; ?> Profit/Loss</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <!-- Spouse Business docs -->
                <?php
            if (isset($spouseBussinessData) && !empty($spouseBussinessData)) {
                foreach ($spouseBussinessData as $key => $label) {
                    ?>
                    <div class="col-12">
                        <p class="mb-0 text-bold"><span class="text-c-light-blue"><?php echo $label; ?></span></p>
                    </div>
                    @include('attorney.client_document_request_list_Profit_loss_labels', ['colValue' => 'col-3', 'incomeProfitLoss' => $spousePLData])	
                <?php
                }
            } else {
                echo "<div class='col-12'><span class='text-italic'>No Profit/Loss added yet.</span></div>";
            }
        ?>  
            </div>
        </div>
    </div>
    <?php } ?>

    <div class="col-12 <?php echo $doc_list_name; ?>">
        <div class="light-gray-div mt-3 mb-2 pb-3">
            <h2>Select below to add custom document names</h2>
            <div class="row gx-3 request-popup-<?php echo $client_id; ?>">	
                <?php
            $adminDocuments = !empty($adminDocuments) ? json_decode($adminDocuments, true) : [];
$adminListShow = (!empty($adminDocuments) && is_array($adminDocuments)) ? '' : 'hide-data';
if (!empty($adminDocuments) && is_array($adminDocuments)) {
    $uploadedClass = "font-color-fail";
    foreach ($adminDocuments as $index => $data) {

        $showHideCheckAdd = "";
        $attorneydocKey = $data['document_type'];
        $uploadedClass = "font-color-fail";
        $borderClass = 'not-uploaded-border';
        $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
        $cardBg = "";
        if (in_array($attorneydocKey, $documentuploaded)) {
            $uploadedClass = "text-c-white";
            $borderClass = '';
            $cardBg = "accepted";
            $doc = Helper::getArrayByKey($attorneydocKey, $list);
            $showHideCheckAdd = "hide-data";
            if (!empty($doc)) {
                $renabledupload = $doc['document_enable_reupload'];
                $declineReason = $doc['document_decline_reason'];
                $status = $doc['document_status'];
                if ($status == 1) {
                    $statusmsg = "Accepted";
                    $cardBg = "accepted";
                    $uploadedClass = "text-c-white";
                    $borderClass = '';
                    $fStatus = '<i class="fas fa-check-circle"></i>';
                }
                if ($status == 2) {
                    $statusmsg = "Declined";
                    $cardBg = "declined";
                    $uploadedClass = "text-c-white";
                    $borderClass = '';
                    $fStatus = '<i class="fas fa-ban"></i>';
                }
            }
        }
        ?>
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mt-1 admin-document-list list-item-<?php echo $index; ?>">
                            <div class="card item-card <?php echo $borderClass; ?>  <?php echo $cardBg; ?>" data-label="">
                                <div class="card-body p-1">
                                    <label class="w-100 d-flex mb-0" for="<?php echo 'admin_doc_'.$doc_list_name.$data['document_type']; ?>">
                                        <span class="d-status <?php echo $uploadedClass; ?>"><i class="fa fa-cloud-upload-alt" aria-hidden="true"></i></span>
                                        <span class="doc-card w-100 name_admin_<?php echo $index; ?> <?php echo $uploadedClass; ?>"><?php echo Helper::validate_key_value('document_name', $data); ?></span>
                                        <input type="checkbox" 
                                            class="float_right mt-1 d-none notify_admin_doc not-accepted" 
                                            id="<?php echo 'admin_doc_'.$doc_list_name.$data['document_type']; ?>" 
                                            name="notify_admin_doc_<?php echo $index; ?>"
                                            value="1"
                                            onclick="addToPreview('admin','<?php echo $index; ?>')"
                                            data-key="<?php echo Helper::validate_key_value('document_type', $data); ?>"
                                            data-docname="<?php echo Helper::validate_key_value('document_name', $data); ?>"
                                        >
                                    </label>
                                </div>
                            </div>
                        </div>	

                        
                <?php
    }
} else { ?>
                        <div class="admin-document-list hide-data list-item-0">
                        </div>
                        <?php
}
?>

                <div class="new-admin-document hide-data col-12 mt-3">
                    <div class="label-div">
                        <label for="">Enter Document Name</label>
                        <input type="text" name="admin_document" class="form-control only_alphanumeric" placeholder="Enter Document Name" maxlength="100">
                    </div>
                </div>
                <div class="col-12 mt-3 mb-2"> 
                    <div class="">
                        <a href="javascript:void(0)" class="add-new-btn add-btn btn-new-ui-default px-3 py-2" onclick="addNewAdminDocument()">
                        Select to Add Personalized Doc(s) Request 
                        </a>
                        <a href="javascript:void(0)" class="add-new-btn save-btn hide-data btn-new-ui-default px-3 py-2" onclick="saveNewAdminDocument()">
                            Save
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .sec-heading-font2 {
        color: #000000;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border: none;
        border-bottom: 2px solid #00b0f0;
    }

    .item-card {
        transition: box-shadow 0.3s ease, background-color 0.3s ease;
        /* background-color: #f8f9fa; */
        border-radius: 8px;
        margin-bottom: 0.1rem;
    }

    .item-card.selected {
        background-color: #007bff;
        color: white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        border-color: #007bff;
        border-radius: 8px;
    }

    .item-card.selected .card-title{
        color: white !important;
    }
    .item-card .card-title{
        cursor: pointer;
    }

    .item-card img {
        border-radius: 12px;
    }

    .item-card.selected img {
        filter: brightness(0.8);
    }
    .item-card.accepted {
        background-color: #28a745;
        color: white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        border-color: #28a745;
        border-radius: 8px;
    }

    .item-card.declined {
        background-color: #ffa600;
        color: white;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.6);
        border-color: #ffa600;
        border-radius: 8px;
    }

    .item-card.selected span, .item-card.selected span i, .item-card.selected span, .item-card.selected span small {
        color: white !important;
    }

    .font-color-fail:hover{
        cursor: pointer;
    }
    .item-card.declined span:hover, .item-card.accepted span:hover{
        cursor: not-allowed;
    }
    .item-card span {
        line-height: 1.3;
        font-size: 85%;
        font-weight: bold;
    }
    .body-no-pt{
        background: #ebf2fc;
        padding: 0rem 0.65rem 0.5rem 0.65rem;;
    }
    .item-heading {
        color: #fff;
        /* text-transform: uppercase; */
        display: block;
        background-color: #0061ca;
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        border-radius: .25rem;
        padding: 0.25rem 0.5rem;
    }
    .paystub-bg{
        background: #eaeaea;
        border-radius: .25rem;
    }
    .text-italic{
        font-style: italic;
    }
    .not-uploaded-border{
        border: 1px solid #dc3545;
    }
</style>