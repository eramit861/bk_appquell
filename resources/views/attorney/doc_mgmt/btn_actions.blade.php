        <!-- $attorneyDocs, $clientDocs, $adminDocs -->
         
       
       <?php
        $accept = 'Accept';
       $decline = "Decline";
       if (in_array($data['document_type'], $adminDocs)) {
           $accept = 'Completed';
           $decline = "Not Completed";
       }


       if (!isset($is_main) && !in_array($data['document_type'], $cardsArray)) {
           $arrayGroup = ['Current_Mortgage_Statement','Current_Auto_Loan_Statement','bank_statements','type_venmo_paypal_cash','type_brokerage_account','other_income','retirement_docs','requested_documents'];
           $docId = $data['id'];
           $docType = $data['document_type'];
           $moveDocumentToOptions = DocumentHelper::getMoveDocumentToOptions($allDocs, $docType, $client_id)
           ?>
            <select class="move-to-select form-control select-custom-padding mr-1" onchange="move_document_to( this, '{{$docId}}','{{$client_id}}', '{{$docType}}', '<?php echo (isset($doc_pay_date) && !empty($doc_pay_date)) ? $doc_pay_date : '';  ?>')" id="document_{{ $docId }}" name="">
                <option disabled selected value="disabled">Move Document to...</option>
                <?php foreach ($moveDocumentToOptions as $label) {
                    echo $label;
                } ?>
            </select>
        <?php } ?>
        <?php

        if ($data['document_type'] != "requested_documents" && (!is_array($data['document_file']) && !empty($data['document_file']))) {
            $filePth = \Storage::disk('s3')->temporaryUrl(
                $data['document_file'],
                now()->addDays(2), // Expires in 10 minutes
                ['ResponseContentDisposition' => 'inline']
            );
            ?>
            <a href="javascript:void(0)" data-url="{{$filePth}}" class="openPdf text-c-blue" title="<?php echo "Download ".$data['document_name'];?>"> <i style="font-size:28px;vertical-align:middle;" class="fa fa-file-pdf" aria-hidden="true"></i></a>
        <?php  } ?>

        <?php if ($data['document_type'] != "requested_documents" && ($data['added_by_attorney'] == 0 && ((isset($data['document_status']) && $data['document_status'] == 0) || ($data['id'] > 0 && empty($data['document_status']))))) {?>
            <a onclick="acceptDocument('<?php echo $data['document_type'];?>','<?php echo route('client_document_status');?>','1', '<?php echo $client_id; ?>', this, '', '<?php echo $data['id']; ?>')" herf="javascript:void(0)" class="ml-1 mb-0 p4px view_client_btn dnpv">{{$accept}}</a>
            <a onclick="declineDocumentPopUp('<?php echo $data['document_type']; ?>','<?php echo route('client_decline_docs_popup');?>','2', '<?php echo $client_id; ?>',this, '<?php echo $data['document_file']; ?>', '<?php echo $data['id']; ?>','<?php echo $decline; ?>')" herf="javascript:void(0)" class="ml-1 p4px view_client_btn <?php echo !empty($doclasscs) ? 'd-none' : ''; ?> mb-0 btn-danger">{{$decline}}</a>
        <?php }?>

        <?php if (in_array($data['document_type'], $autoloankeys) || in_array($data['document_type'], $mortloankeys) || in_array($data['document_type'], $cardsArray)) { ?>
               

                        <button <?php if (empty($doclasscs)) { ?>
                    onclick="deleteDocDocument('<?php echo  $data['document_type']; ?>','<?php echo route('client_document_delete'); ?>','<?php echo $client_id; ?>', this, '','<?php echo $data['id']; ?>')"
                    <?php } ?> type="button" class="delete-div" title="Delete">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
		<path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5">
		</path>
	</svg>
	Delete
</button>
        <?php } ?>
