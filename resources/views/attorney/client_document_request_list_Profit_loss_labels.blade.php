<?php

$showHideCheck = "";
$addVideoStatus = $addVideo ?? 0;

if ($isPending) {
    $uploadedClass = "font-color-fail";
    $cardBg = "";
    $borderClass = 'not-uploaded-border';
    $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
}

$plData = [];

$incomeProfitLoss = !empty($incomeProfitLoss) && isset($incomeProfitLoss[$key]) ? $incomeProfitLoss[$key] : [];

$profitType = 1;
if (!empty($incomeProfitLoss)) {
    if (isset($incomeProfitLoss[0]['profit_loss_type'])) {
        $profitType = 2;
    }
}
if ($profitType == 1) {
    $plData = DateTimeHelper::createSixDuplicateObject($incomeProfitLoss, $attProfitLossMonths);
} elseif ($profitType == 2) {
    $plData = DateTimeHelper::getIncomeDescArray($incomeProfitLoss);
}

$monthsArray = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
$i = 1;

foreach ($monthsArray as $val => $monthYear) {
    $cardBg = "";
    $uploadedClass = "font-color-fail";
    $borderClass = 'not-uploaded-border';
    $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
    foreach ($plData as $data) {
        if (isset($data['profit_loss_month']) && $data['profit_loss_month'] == $val) {
            $cardBg = "accepted";
            $uploadedClass = "text-c-white";
            $borderClass = '';
            $fStatus = '<i class="fas fa-check-circle"></i>';
            break;
        }
    }

    ?>
    <div class="<?php echo $colValue; ?> custom-item mt-1">
        <div class="card item-card <?php echo $borderClass; ?> <?php echo $cardBg; ?>" data-label="">
            <div class="card-body p-1">
                <label class="w-100 d-flex mb-0" for="<?php echo empty($showHideCheck) ? 'debtor_doc_'.$doc_list_name.'-'.$key.'-'.$val : '';  ?>" >
                    <span class="d-status <?php echo $uploadedClass; ?>"><?php echo $fStatus; ?></span>
                    <span class="doc-card w-100 <?php echo $uploadedClass; ?>">Month <?php echo $i; ?>:&nbsp;<?php echo $monthYear; ?></span>
                    <span class="d-none name_<?php echo $doc_list_name.'-'.$key.'-'.$val; ?>"><?php echo $label.' ('.$monthYear.')'; ?></span>
                    <input type="checkbox" 
                        id="<?php echo 'debtor_doc_'.$doc_list_name.'-'.$key.'-'.$val; ?>" 
                        class="float_right d-none mt-1 notify_doc <?php echo $showHideCheck;
    echo ($borderClass == "not-uploaded-border") ? ' not-accepted' : '' ; ?>" 
                        name="notify_doc_<?php echo $doc_list_name.'-'.$key.'-'.$val; ?>" 
                        onclick="addPaystubToPreview('<?php echo addslashes($doc_list_name); ?>', '<?php echo addslashes($key); ?>', '<?php echo addslashes($val); ?>', '<?php echo addslashes($label); ?>', true )"
                        value="1" 
                        data-key="<?php echo $doc_list_name.'-'.$key; ?>" 
                        data-docname="<?php echo DateTimeHelper::convertToDateProfitLoss($monthYear); ?>" 
                    >
                </label>
            </div>
        </div>
    </div>
<?php
        $i++;
}
?>
