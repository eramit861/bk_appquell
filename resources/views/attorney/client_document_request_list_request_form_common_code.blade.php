<?php
$fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
$uploadedClass = "font-color-fail";
$renabledupload = false;
$declineReason = '';
$status = 0;
$statusmsg = '';
$showHideCheck = "";
$addVideoStatus = $addVideo ?? 0;
if (in_array($key, $documentuploaded)) {
    $uploadedClass = "font-color-sucess";
    $showHideCheck = "hide-data";
    $doc = Helper::getArrayByKey($key, $list);
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

if ($isPending) {
    $uploadedClass = "font-color-fail";
    $showHideCheck = "";
}

$postfix = !empty($statusmsg) ? '&nbsp;<span class="font-weight-bold fs-10px"> (' . $statusmsg . ')</span>' : '';
?>
<div class="mt-1">
    <label class="w-100 d-flex" for="<?php echo empty($showHideCheck) ? 'debtor_doc_'.$doc_list_name.$key : '';  ?>" >
        <span class="d-status <?php echo $uploadedClass; ?>"><?php echo $fStatus; ?></span>
        <span class="doc-card w-100 name_<?php echo $key; ?> <?php echo $uploadedClass; ?>"><?php echo $label . $postfix; ?></span>
        <input type="checkbox" 
            id="<?php echo 'debtor_doc_'.$doc_list_name.$key; ?>" 
            class="float_right mt-1 notify_doc <?php echo $showHideCheck; ?>" 
            name="notify_doc_<?php echo $key; ?>" 
            onclick="addToPreview('main','<?php echo $key; ?>', <?php echo $addVideoStatus; ?>)" 
            value="1" 
            data-key="<?php echo $key; ?>" 
            data-docname="<?php echo $label; ?>"
        >
    </label>
</div>