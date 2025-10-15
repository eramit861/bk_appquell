<?php
$radioValue = \App\Helpers\Helper::validate_key_value($radioName, $incomeData, 'radio');
if ($radioValue !== null && $radioValue !== '') {
    $checked1 = ($radioValue === '1' || $radioValue === 1) ? 'checked' : '';
    $checked0 = ($radioValue === '0' || $radioValue === 0) ? 'checked' : '';
} else {
    $checked1 = (old($radioName) === '1' || old($radioName) === 1) ? 'checked' : '';
    $checked0 = (old($radioName) === '0' || old($radioName) === 0) ? 'checked' : '';
}
?>
<div class="my-2 <?php echo $mainDivClass ?? ''; ?> col-md-12 ">
    <div class="label-div question-area">
        <div class="row gx-3 ">
            <div class="col-md-8">
                <label class=""><?php echo $label; ?></label>
                <div class="custom-radio-group form-group">
                    <input type="radio" required name="<?php echo $radioName; ?>" class="d-none"
                        id="<?php echo $radioName; ?>_1"
                        onclick="commonShowHide('<?php echo $radioName; ?>_section', 1)"
                        <?php echo $checked1; ?> value="1">
                    <label for="<?php echo $radioName; ?>_1" class="btn-toggle <?php echo $checked1 == 'checked' ? 'active' : ''; ?>">Yes</label>

                    <input type="radio" required name="<?php echo $radioName; ?>" class="d-none"
                        id="<?php echo $radioName; ?>_0"
                        onclick="commonShowHide('<?php echo $radioName; ?>_section', 0)"
                        <?php echo $checked0; ?> value="0">
                    <label for="<?php echo $radioName; ?>_0" class="btn-toggle <?php echo $checked0 == 'checked' ? 'active' : ''; ?>">No</label>
                </div>
            </div>
            <div class="col-md-4 <?php echo $radioName; ?>_section <?php echo ($radioValue === '1' || $radioValue === 1) ? '' : 'hide-data'; ?> ">
                <?php if (!empty($amountName)) { ?>
                <div class="label-div">
                    <div class="form-group">
                        <label class=" w-100"><?php    echo $placeholder ?? 'Avg. Monthly Inc.'; ?></label>
                        <div class="d-flex input-group ">
                            <span class="custom_corner_span px-3 input-group-text" id="basic-addon1">$</span>
                            <input type="text" required name="<?php    echo $amountName; ?>"
                                class="w-auto form-control price-field custom_corner_input"
                                placeholder="<?php    echo $placeholder ?? 'Avg. Monthly Inc.'; ?>"
                                value="<?php echo (\App\Helpers\Helper::validate_key_value($amountName, $incomeData) !== '') ? \App\Helpers\Helper::validate_key_value($amountName, $incomeData) : old($amountName); ?>">
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>