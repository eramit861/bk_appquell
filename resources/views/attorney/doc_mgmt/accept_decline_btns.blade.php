<?php
$accepted = 'Accepted';
$declined = "Declined";
// if($data['document_type'] == "Debtor_Pay_Stubs"){

if (in_array($data['document_type'], $adminDocs)) {
    $accepted = 'Completed';
    $declined = "Not Completed";
}
if (isset($data['document_status']) && $data['document_status'] == 2) {?>
            <span class="view_client_text declined ml-1">({{$declined}})<?php if (!empty($declineText)) { ?>
                <span class="decline_reasons"> (Reason: {{$declineText}}) </span>
            <?php } ?></span>
            
            <a onclick="requestForReuploadDoc('<?php echo $data['document_type']; ?>','<?php echo route('client_document_enable_reupload');?>','1', '<?php echo $client_id; ?>', this, '<?php echo $data['document_file']; ?>','<?php echo $data['document_status']; ?>')" class="view_client_btn p4px resubmitdocrequest "><i class="fa fa-retweet fa-lg" aria-hidden="true"></i> Enable Re-upload</a>
        <?php } ?>

        <?php if ((isset($data['document_status']) && $data['document_status'] == 1) || (isset($data['added_by_attorney']) && ($data['added_by_attorney'] == 1))) {?>
            <span class="view_client_text accepted ml-1">({{$accepted}})</span>
        <?php } ?>