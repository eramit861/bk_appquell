<?php
$currentDate = \Carbon\Carbon::now();
?>

<section class="accordian p-0" role="tablist" aria-live="polite">
    <?php
        foreach ($payCheckData as $key => $value) {
            if (isset($value['missingDates']) && is_Array($value['missingDates']) && count($value['missingDates']) > 0) {
                $missingDates = Helper::validate_key_value('missingDates', $value);

                $emp_data = Helper::validate_key_value('emp_data', $value);

                $mainTitle = '';
                $title = 'Employer';

                if (!empty($emp_data)) {
                    $title = '<span class="text-bold fs-14px">'.Helper::validate_key_value('employer_name', $emp_data).'</span> ';
                    $title .= '<span class="text-c-blue ml-2 fs-14px">(Pay Dates based upon: <span class="text-bold text_underline">'.$value['clientFrequency'].'</span> frequency)</span> ';
                    if (in_array(Helper::validate_key_value('employer_type', $emp_data, 'radio'), [1,2,3,4,5,6])) {
                        $mainTitle = '<p class=" mb-1 fs-14px">
                                            <span class="text-bold border-bottom-light-blue">'.ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)).':</span>'
                                        .'</p> ';
                    } else {
                        $mainTitle = '<p class=" mb-1 fs-14px">
                                            <span class="text-bold border-bottom-light-blue">'.ArrayHelper::getEmployerType(Helper::validate_key_value('employer_type', $emp_data)).':</span>'
                                        .'</p> ';
                    }
                }
                ?>
    <article class="mb-3">
        <div class="row mt-2">
            <div class="col-md-12">
                <div class="p-point75 ">
                    <div class="row">
                        <div class="col-12 text-left">
                            <?php echo $mainTitle; ?>
                        </div>
                        <div class="col-12 text-left">
                            <?php echo $title; ?>
                        </div>               
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <?php
                            if (!empty($missingDates)) {
                                foreach ($missingDates as $key => $date) {
                                    echo '<span class="text-danger">'.date("M d, Y", strtotime($date)).'</span>; ';
                                }
                            }
                ?>
        </div>
    </article>
    <?php }
            } ?>
</section>