<section class="accordian p-0" role="tablist" aria-live="polite">
    <input type="hidden" name="document_type" id="document_types" value="">
    <?php

        foreach ($payCheckData as $key => $value) {

            $class = "";
            $emp_data = Helper::validate_key_value('emp_data', $value);
            $employer_id = Helper::validate_key_value('id', $emp_data);
            $pay_dates = Helper::validate_key_value('pay_dates', $value);
            $pay_dates = !empty($pay_dates) ? array_reverse($pay_dates) : [];
            $pay_dates_list = Helper::validate_key_value('pay_dates_list', $value);
            $overrideCount = Helper::validate_key_value('overrideCount', $value);
            $countFalse = 0;
            $title = '<p class="mb-0 text-bold"><span class="text-c-light-blue"></span></p>';
            if (!empty($emp_data)) {
                $title = '<p class="mb-0 text-bold"><span class="text-c-light-blue">'.Helper::validate_key_value('employer_name', $emp_data).'</span></p>';
                if (in_array(Helper::validate_key_value('employer_type', $emp_data, 'radio'), [1,2,3,4,5,6])) {
                    $end_date = Helper::validate_key_value('end_date', $emp_data);
                } else {
                    $end_date = Helper::validate_key_value('end_date', $emp_data);
                }
            }
            $datesCount = count($pay_dates);

            $countFalse = count(array_filter($pay_dates, fn ($pd) => !$pd['exists']));
            $countFalse = ($countFalse - (int)$overrideCount);
            $missingCount = '<span class="text-danger text-bold ">Missing: '.$countFalse.'</span>';
            ?>
    <article class="mt-1 {{$key}} ">
    <?php echo $title; ?>

            <div class="row pt-1">
                <?php if (!empty($pay_dates)) { ?>
                    
                    <tbody>
                <?php   $pay_date = '';
                    $i = 1;
                    foreach ($pay_dates as $index => $data) {
                        $uploadedClass = "font-color-fail";
                        $borderClass = "not-uploaded-border";
                        $overrideString = "";
                        $pay_date = Helper::validate_key_value('pay_date', $data);
                        $exists = $data['exists'] ?? false;
                        $existsData = Helper::validate_key_value('existsData', $data);
                        $overrideData = [];
                        $overrideData = Helper::searchForOverrideDate($pay_date, $completeList, $employer_id);
                        $status = " <span class='text-bold text-danger'>Missing</span>";
                        $showOverrideSelect = true;
                        $showUploadSelect = "";
                        $showHideCheck = "";
                        $cardBg = "";
                        $fStatus = '<i class="fa fa-cloud-upload-alt" aria-hidden="true"></i>';
                        if ($exists == true) {
                            $status = " <span class='text-bold text-success'>Entered</span>";
                            $cardBg = "accepted";
                            $fStatus = '<i class="fas fa-check-circle"></i>';
                            $showHideCheck = "hide-data";
                            $uploadedClass = "text-c-white";
                            $borderClass = '';
                            $showUploadSelect = "hide-data";
                            $showOverrideSelect = false;
                        }

                        $grossPay = '-';
                        $netPay = '-';

                        if (!empty($existsData)) {
                            $grossPay = '$ '.array_sum(array_column($existsData, 'gross_pay_amount'));
                            $netPay = '$ '.array_sum(array_column($existsData, 'net_pay_amount'));
                        }
                        if (!empty($overrideData)) {
                            $status = " <span class='text-bold text-success'>Entered</span>";
                            $cardBg = "accepted";
                            $fStatus = '<i class="fas fa-check-circle"></i>';
                            $showHideCheck = "hide-data";
                            $uploadedClass = "text-c-white";
                            $borderClass = '';
                            $showUploadSelect = "hide-data";
                            $showOverrideSelect = false;
                            $grossPay = '$ '.Helper::validate_key_value('gross_pay_amount', $overrideData);
                            $netPay = '$ '.Helper::validate_key_value('net_pay_amount', $overrideData);
                            $overPayDate = Helper::validate_key_value('pay_date', $overrideData);
                            $overrideString = "<small class='text-bold text-success'>Overridden with ".date("F d, Y", strtotime($overPayDate))."</small>";
                        }
                        $payDate = date('m/d/Y', strtotime($pay_date));
                        ?>
                <div class="col-6 col-sm-4 col-lg-3 col-xl-2 custom-item mt-1">
                    <div class="card item-card <?php echo $borderClass; ?> <?php echo $cardBg; ?>" data-label="">
                        <div class="card-body p-1">
                            <label class="w-100 d-flex mb-0" for="<?php echo empty($showHideCheck) ? 'debtor_doc_'.$doc_list_name.'-'.$employer_id.'-'.$index : '';  ?>" >
                                <span class="d-status <?php echo $uploadedClass; ?>"><?php echo $fStatus; ?></span>
                                <span class="doc-card w-100 <?php echo $uploadedClass; ?>"><?php echo date("M d, Y", strtotime($pay_date));?></span>
                                <span class="d-none name_<?php echo $doc_list_name.'-'.$employer_id.'-'.$index; ?>"><?php echo Helper::validate_key_value('employer_name', $emp_data).' ('.date("M d, Y", strtotime($pay_date)).')'; ?></span>
                                <input type="checkbox" 
                                    id="<?php echo 'debtor_doc_'.$doc_list_name.'-'.$employer_id.'-'.$index; ?>" 
                                    class="float_right d-none mt-1 notify_doc <?php echo $showHideCheck;
                        echo ($borderClass == "not-uploaded-border") ? ' not-accepted' : '' ; ?>" 
                                    name="notify_doc_<?php echo $doc_list_name.'-'.$employer_id.'-'.$index; ?>" 
                                   onclick="addPaystubToPreview(
    '<?php echo addslashes($doc_list_name); ?>',
    '<?php echo addslashes($employer_id); ?>',
    '<?php echo addslashes($index); ?>',
    '<?php echo addslashes(Helper::validate_key_value('employer_name', $emp_data)); ?>'
)"
                                    value="1" 
                                    data-key="<?php echo $doc_list_name.'-'.$employer_id; ?>" 
                                    data-docname="<?php echo DateTimeHelper::convertToDatePaystub(date("M d, Y", strtotime($pay_date))); ?>" 
                                >
                            </label>
                        </div>
                    </div>
                </div>
                <?php $i++;
                    } ?>
                  
                <?php  } ?>
                        </div>
        
        <!-- onclick="addToPreview('main','<?php //echo $doc_list_name.'-'.$key.'-'.$index.$pay_date;?>', 0, '<?php //echo $doc_list_name;?>')"  -->
    </article>
    <?php
        }
    ?>
</section>
<style>
    .text-align-left{
        text-align: left;
    }
    .w-10{
        width: 10%;
    }
    .w-40{
        width: 40%;
    }
    .w-50{
        width: 50%;
    }
    .fs-14px{
        font-size: 14px;
        font-weight: 400;
        font-family: "Titillium Web", sans-serif;
    }
    .border-bottom-light-blue {
        border-bottom: 2px solid #00b0f0 !important;
    }
    .text-bold {
        font-weight: bold;
    }
    .view_client_btn {
        cursor: pointer;
        font-weight: bold;
        border-radius: 4px;
        background: #00b0f0;
        padding: 10px;
        opacity: 0.9;
        color: #fff;
        line-height: 130%;
    }
    
</style>