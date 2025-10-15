<?php
$fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
$uploadedClass = "font-color-fail";
$borderClass = "not-uploaded-border";
$renabledupload = false;
$declineReason = '';
$status = 0;
$statusmsg = '';
$showHideCheck = "";
$addVideoStatus = $addVideo ?? 0;
$cardBg = "";
if (in_array($key, $documentuploaded)) {
    $cardBg = "accepted";
    $uploadedClass = "text-c-white";
    $borderClass = '';
    $showHideCheck = "hide-data";
    $doc = Helper::getArrayByKey($key, $list);
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

        if ($isTaxReturnDocs && !in_array($doc['document_type'], $acceptdTaxReturnDocs)) {
            $uploadedClass = "font-color-fail";
            $cardBg = "";
            $borderClass = 'not-uploaded-border';
            $showHideCheck = "";
        }
    }
}

if ($isPending) {
    $uploadedClass = "font-color-fail";
    $cardBg = "";
    $borderClass = 'not-uploaded-border';
    $showHideCheck = "";
}

$postfix = '';
?>
<div class="<?php echo $colValue; ?> custom-item mt-1">
    <div class="card item-card <?php echo $borderClass; ?> <?php echo $cardBg; ?>" data-label="">
        <div class="card-body p-1">
            <label class="w-100 d-flex mb-0" for="<?php echo empty($showHideCheck) ? 'debtor_doc_'.$doc_list_name.$key : '';  ?>" >
                <span class="d-status <?php echo $uploadedClass; ?>"><?php echo $fStatus; ?></span>
                <span class="doc-card d-block name_main_<?php echo $key; ?> <?php echo $uploadedClass; ?>"><?php echo $label . $postfix; ?></span>
                <input type="checkbox" 
                    id="<?php echo 'debtor_doc_'.$doc_list_name.$key; ?>" 
                    class="float_right d-none mt-1 notify_doc <?php echo $showHideCheck;
echo ($borderClass == "not-uploaded-border") ? ' not-accepted' : '' ; ?> " 
                    name="notify_doc_<?php echo $key; ?>" 
                    onclick="addToPreview('main','<?php echo $key; ?>', <?php echo $addVideoStatus; ?>)" 
                    value="1" 
                    data-key="<?php echo $key; ?>" 
                    data-docname="<?php echo $label; ?>"
                >
            </label>
        </div>
    </div>
</div>