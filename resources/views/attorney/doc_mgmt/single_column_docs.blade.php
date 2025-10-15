 <tr style="background-color:<?php echo $background;?>; color:<?php echo $color;?>" class="<?php if ($doc_page_open) {
    echo "active";
} ?>">
                            <td width="100%" class="no_border" colspan="2">
                           <?php $paystClass = '';
if (in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) {
    $isPaystub = 1;
    $paystClass = 'fs-16px';
}?>
                            <table  width="100%">
                                <?php $prifixPay = '';

if ($data['document_type'] == 'Debtor_Pay_Stubs') {
    $prifixPay = 'Debtor:';
}

if ($data['document_type'] == 'Co_Debtor_Pay_Stubs' && $val['client_type'] == 3) {
    $prifixPay = 'Co-Debtor:';
}

?>
                                <tr>
                                    
                                <?php if (empty($isPaystub)) {?>
                                <td style="position:relative;padding:4px 4px 4px 0px;">
                                
                                        <?php if ($displayMainName && $multiplecount > 0) { ?>
                                            <a title="Select to view all documents" href="<?php echo route('attorney_client_uploaded_documents', ['id' => $val['id']]).'?type='.$data['document_type'] ?>">
                                                <img src="<?php echo @$svgUrl; ?>" class="licence-img " style="height:40px" alt="icon">
                                                <span class="unread-indicator {{$indicator}} ki">New Doc(s) Uploaded</span>
                                            </a>
                                        <?php } else {
                                            ?>
                                            <img src="<?php echo @$svgUrl; ?>" class="licence-img " style="height:40px" alt="icon">
                                            <span class="unread-indicator {{$indicator}} ki">New Doc(s) Uploaded</span>
                                        <?php } ?>
                                    </td><?php } ?>
                                    <?php
                                              $acceptedCount = 0;
$declinedCount = 0;
if (isset($data['multiple']) && is_array($data['multiple'])) {

    foreach ($data['multiple'] as $dic) {
        if ((isset($dic['document_status']) && $dic['document_status'] == 1) || (isset($dic['added_by_attorney']) && ($dic['added_by_attorney'] == 1))) {
            $acceptedCount++;
        }
        if (isset($dic['document_status']) && $dic['document_status'] == 2) {
            $declinedCount++;
        }

    }

} ?>
                                    <td style="width:30%;position:relative;">
                                    <?php if (($displayMainName && $multiplecount > 0)) { ?>
                                        <a title="Select to view all documents" href="<?php echo route('attorney_client_uploaded_documents', ['id' => $val['id']]).'?type='.$data['document_type'] ?>">
                                        <span style="color:{{@$color}}" class="<?php if (in_array($data['document_type'], ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report']) && $data['id'] == 0) {
                                            echo 'red_credit';
                                        } ?>  titleh {{$paystClass}} <?php if ($displayMainName) {?> bold-wide<?php } else {
                                            echo "small_font";
                                        } ?>">
                                        <?php echo $prifixPay.$data['document_name'];
                                        ?>
                                          
                                    </span>
                                    </a>
                                    <?php echo !empty($acceptedCount) ? " <small class='ml-1 font-weight-bold text-c-green'>(Completed:".$acceptedCount.")</small>" : '';?>
                                    <?php echo !empty($declinedCount) ? " <small class='font-weight-bold text-c-red'>(Not Completed:".$declinedCount.")</small>" : '';?>

                                    <?php if (in_array($data['document_type'], array_keys($clientDocs)) || in_array($data['document_type'], array_keys($venmoPaypalCash)) || in_array($data['document_type'], array_keys($brokerageAccount))) { ?>
                                               
                                                    <button onclick="deleteBankType('<?php echo $data['document_type']; ?>','<?php echo $client_id; ?>', '<?php echo route('delete_bank_type'); ?>')" type="button" class="delete-div" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                        <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
                                                        </path>
                                                    </svg>
                                                    Delete Account
                                                </button>
                                                   
                                        <?php } ?>
                                    @include("attorney.doc_mgmt.doc_request_flag", ['colored' => 'green'])

                                    <?php } else {

                                        ?>
                                        <span style="color:{{@$color}}" class="<?php if (!in_array($data['document_name'], ["Current Auto Loan Statements","Current Mortgage Statements"])) {
                                            echo "doc_heading_title";
                                        } if (in_array($data['document_type'], ['Debtor_Creditor_Report', 'Co_Debtor_Creditor_Report']) && $data['id'] == 0) {
                                            echo 'red_credit';
                                        } ?>  titleh  {{$paystClass}} <?php if ($displayMainName) {?> bold-wide<?php } else {
                                            echo "small_font";
                                        } ?>">
                                            <?php echo $prifixPay.$data['document_name']; ?>
                                           
                                            <?php if (!empty($notOwnedproperty)) { ?> 
                                                <br><span style="text-decoration:none !important;" class="small-text-font text-left text-c-red">({{$notOwnedproperty}})</span> 
                                            <!-- <a href="javascript:void(0)" class="view_client_btn" onclick="rmeoveFromNotOwn('<?php echo $client_id; ?>','<?php echo $keyNotOwn;?>')">To allow Client click here</a> -->
                                        <?php } ?>
                                        </span>
                                       
                                          @include("attorney.doc_mgmt.doc_request_flag")
                                        <?php }?>
                                        <a class="paystub_path view_client_btn <?php echo empty($ppath) ? 'd-none' : '';?>" href="{{$ppath}}">Payroll Assistant</a>
                                        @include("attorney.doc_mgmt.accept_decline_btns")
                                    </td>

                                    <td style="width:24%">
                                        <?php if (!in_array($data['document_type'], $autoloankeys) && !in_array($data['document_type'], $mortloankeys) && (!in_array($data['document_type'], $valid_document_types) && $displayMainName) || $singleDocs) {
                                            ?>
                                            
                                           <?php if (!in_array($data['document_type'], ['Current_Mortgage_Statement','Current_Auto_Loan_Statement','Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) { ?>  <a href="javascript:void(0)" class="{{$data['document_type']}} upload_doc_line view_client_btn" onclick="both_upload_modal('<?php echo $data['document_type']; ?>',$(this).data('text'), '', 0 , <?php echo $isStatements; ?>, <?php echo $isPaystub; ?> )" data-type="<?php echo $data['document_type']; ?>" data-text="<?php echo $data['document_name']; ?>"> <i class="fa fa-upload" aria-hidden="true"></i> Click to Upload File(s)</a> <?php } ?>
                                            <?php if (($doc_page_open == true && $multiplecount > 0) && !in_array($data['document_type'], ['Debtor_Pay_Stubs','Co_Debtor_Pay_Stubs'])) { ?>
                                            <input class="ml-2 parent_<?php echo $data['document_type']; ?>" type="checkbox" onclick="checkChildCheckboxes(this,'<?php echo $data['document_type']; ?>')" value="1"> <label class="click_all_docs">Click to Select All Doc(s) </label> 
                                        <?php } ?>
                                        <?php } ?>
                                       
                                        
                                        
                                        
                                        <?php if (in_array($data['document_type'], $adminDocs)) { ?>
                                                
                                                    <button onclick="deleteRequestedDocType('<?php echo $data['document_type']; ?>','<?php echo $client_id; ?>', '<?php echo route('delete_requested_doc_type'); ?>')" type="button" class="delete-div" title="Delete">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
		<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
		</path>
	</svg>
	Delete
</button>
                                                
                                        <?php } ?>
                                    </td>


                                <td style="width:36%">
                                   

                                    @include("attorney.doc_mgmt.document_actions")
                                    <?php if (empty($doclasscs)) { ?>
                                    @include("attorney.doc_mgmt.vehile_reg")
                                    <?php } ?>

                                </td>
                                <td style="text-align:right;width:8%">
                                <?php if ($displayMainName) {
                                    if ($multiplecount > 0 && !in_array($data['document_type'], ['Debtor_Pay_Stubs', 'Co_Debtor_Pay_Stubs'])) {
                                        ?>
                                    <a class="text-underline text-c-black toggle-docs" href="javascript:void(0)" onclick="toggleDocPage(this)" data-document-type="<?php echo $data['document_type']; ?>" data-client-id="{{$val['id']}}" data-select-id="{{$data['document_type']}}"> <span class="read-more-less" style="font-size:10px;"> <?php echo $doc_page_open == true ? 'Hide ' : 'Click to Show'; ?> {{$multiplecount}} doc(s) <i class="fa fa-angle-<?php echo $doc_page_open == true ? 'up' : 'down';?>" aria-hidden="true"></i></span></a>
                                <?php }
                                    } ?>
                                </td>
                                </tr>
                             <?php
                                            $noEmployerText = "";
if ($data['document_type'] == "Debtor_Pay_Stubs" && !$d1HasEmployers) {
    $noEmployerText = "(Debtor selected not employed over previous 7 months)";
}
if ($data['document_type'] == "Co_Debtor_Pay_Stubs" && !$d2HasEmployers) {
    $noEmployerText = ($User['client_type'] == 2) ? "(Non-Filing Spouse selected not employed over previous 7 months)" : "(Co-Debtor selected not employed over previous 7 months)" ;
}
?>
                                    <?php if (!empty($noEmployerText)) { ?>
                                        <tr><td class="p-0 m-0" colspan=5>
                                        <span class="text-c-red float-left ml-1 m-0 p-0"><?php echo $noEmployerText; ?></span>
                                        </td> </tr><?php } ?>
                            </table>
                            </td>
                        </tr>