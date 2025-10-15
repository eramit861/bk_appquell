<?php
$sectionTitle = 'Primary Employer:';
switch ($key) {
    case 0:
        $sectionTitle = 'Primary Employer:';
        break;
    case 1:
        $sectionTitle = 'Second Employer:';
        break;
    case 2:
        $sectionTitle = 'Third Employer:';
        break;
    case 3:
        $sectionTitle = 'Fourth Employer:';
        break;
}
?>

<div
    class="light-gray-div employer_form debt_creditor_form <?php echo ($key == 0) ? 'mt-2' : ''; ?> debt_creditor_{{$key}}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div "><?php echo $key + 1; ?></div> <?php echo $sectionTitle; ?>
        </h2>
        <?php if ($enableEdit) { ?>
        <button type="button" class="delete-div" title="Delete" data-saveid="<?php    echo $key; ?>"
            onclick="removeCurrentEmployer(this, '<?php    echo Helper::validate_key_value('id', $value); ?>', '<?php    echo $formId ?? ''; ?>');">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>
        <a href="javascript:void(0)" data-saveid="<?php    echo $key; ?>" class=" client-edit-button with-delete "
            onclick="displayEmployerEditDiv(<?php    echo $key; ?>, '<?php    echo $formId ?? ''; ?>');">
            <i class="bi bi-pencil-square mr-1"></i>
            Edit
        </a>
        <?php } ?>
        <!-- summary section -->
        <div
            class="row gx-3 employer_summary mb-3 <?php if (empty($value)) { ?>hide-data<?php } ?> employer_summary_<?php echo $key; ?>">
            <div class="col-12 " id="current_employer_summary_div_<?php echo $key; ?>">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label class="font-weight-bold ">Name of Employer: <span
                                class="font-weight-normal name"><?php echo Helper::validate_key_value('employer_name', $value); ?></span></label>
                    </div>
                    <div class="col-xxl-6 col-xl-5 col-lg-5 col-md-5 col-sm-12">
                        <label class="font-weight-bold ">Street Address: <span
                                class="font-weight-normal address_line_1"><?php echo Helper::validate_key_value('employer_address', $value); ?></span></label>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-4">
                        <label class="font-weight-bold ">City: <span
                                class="font-weight-normal city"><?php echo Helper::validate_key_value('employer_city', $value); ?></span></label>
                    </div>
                    <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <label class="font-weight-bold ">State: <span
                                class="font-weight-normal state"><?php echo Helper::validate_key_value('employer_state', $value); ?></span></label>
                    </div>
                    <div class="col-xxl-1 col-xl-2 col-lg-2 col-md-2 col-sm-4">
                        <label class="font-weight-bold ">Zip: <span
                                class="font-weight-normal zip"><?php echo Helper::validate_key_value('employer_zip', $value); ?></span></label>
                    </div>
                    <div class="col-xxl-6 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                        <label class="font-weight-bold ">Job Title: <span
                                class="font-weight-normal occupation"><?php echo Helper::validate_key_value('employer_occupation', $value); ?></span></label>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label class="font-weight-bold ">How long employed here:
                            <span
                                class="font-weight-normal job_period"><?php echo Helper::validate_key_value('employment_duration', $value) ?></span>
                        </label>
                    </div>
                    <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 <?php echo (!empty(Helper::validate_key_value('start_date', $value))) ? '' : 'hide-data' ?>">
                        <label
                            class="font-weight-bold text-c-light-blue paystub_paydate_start_parent <?php echo (!empty(Helper::validate_key_value('start_date', $value))) ? '' : 'hide-data' ?> ">Start
                            Date:
                            <span
                                class="font-weight-normal paystub_paydate_start"><?php echo Helper::validate_key_value('start_date', $value); ?></span>
                        </label>
                    </div>
                    <?php
                        $frequency = Helper::validate_key_value('frequency', $value, 'radio');
$twice_month_selection = Helper::validate_key_value('twice_month_selection', $value, 'radio');
?>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3">
                        <label class="font-weight-bold ">Pay Frequency:
                            <span
                                class="font-weight-normal often_get_paid"><?php echo Helper::getPayFrequencyLabel(Helper::validate_key_value('frequency', $value)); ?></span>
                        </label>
                    </div>
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 <?php echo ($frequency == 3 && isset($twice_month_selection)) ? '' : 'hide-data'; ?>">
                        <label class="font-weight-bold ">Pay Schedule:
                            <span class="font-weight-normal often_get_paid">
                                <?php echo Helper::validate_key_value('twice_month_selection', $value, 'radio') == 0 ? '1st & 15th of month' : ''; ?>
                                <?php echo Helper::validate_key_value('twice_month_selection', $value, 'radio') == 1 ? '15th & last day ('. date("jS", strtotime("last day of this month")).') of the month' : ''; ?>
                            </span>
                        </label>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <label class="font-weight-bold ">Recent Paystub Pay Date:
                            <span
                                class="font-weight-normal paystub_paydate_recent"><?php echo Helper::validate_key_value('end_date', $value); ?></span>
                        </label>
                    </div>
                    <?php
$note = Helper::validate_key_value('notes', $value);
if (!empty($note)) {
    ?>
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <label class="font-weight-bold w-100 mb-0">Notes:
                            <span class="font-weight-normal notes"><?php    echo $note; ?></span></label>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- edit section -->
        <div
            class="row employer_edit_form insider_data border-0 employer_data_<?php echo $key; ?> <?php if (!empty($value)) { ?>hide-data<?php } ?>">
            <div class="col-12">
                <strong class="subtitle">Employer Information</strong>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Name</label>
                        <input type="text" name="current_employer[<?php echo $key; ?>][employer_name]"
                            id="employer_name" class="input_capitalize form-control required name"
                            value="<?php echo Helper::validate_key_value('employer_name', $value); ?>" />
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-8 col-lg-8 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Street Address</label>
                        <input type="text" name="current_employer[<?php echo $key; ?>][employer_address]"
                            id="name_address_employer" class="input_capitalize form-control required address_line_1"
                            placeholder="Street Address"
                            value="<?php echo Helper::validate_key_value('employer_address', $value); ?>">
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">City</label>
                        <input type="text" name="current_employer[<?php echo $key; ?>][employer_city]"
                            id="employer_city" class="required input_capitalize form-control city"
                            placeholder="Street Address"
                            value="<?php echo Helper::validate_key_value('employer_city', $value); ?>">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>State</label>
                        <select class="form-control required state"
                            name="current_employer[<?php echo $key; ?>][employer_state]" id="employer_state">
                            <option value="">Please Select State</option>
                            <?php echo AddressHelper::getStatesList(Helper::validate_key_value('employer_state', $value)); ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-2">
                <div class="label-div">
                    <div class="form-group">
                        <label>Zip</label>
                        <input type="number" class="form-control allow-5digit required zip"
                            name="current_employer[<?php echo $key; ?>][employer_zip]" id="employer_zip"
                            placeholder="Zip" value="<?php echo Helper::validate_key_value('employer_zip', $value); ?>">
                    </div>
                </div>
            </div>

            <div class="col-12">
                <strong class="subtitle">Job Information</strong>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <input type="hidden" class="employer_id" name="current_employer[<?php echo $key; ?>][id]"
                    value="<?php echo Helper::validate_key_value('id', $value); ?>">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Enter your job title</label>
                        <input type="text" name="current_employer[<?php echo $key; ?>][employer_occupation]"
                            id="employer_occupation" class="input_capitalize form-control required occupation" cols="30"
                            rows="4" placeholder="Title or Description"
                            value="<?php echo Helper::validate_key_value('employer_occupation', $value); ?>">
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">How does <?php echo $debtorname; ?> get paid?</label>
                        <select name="current_employer[<?php echo $key; ?>][frequency]"
                            class="form-control required often_get_paid"
                            onchange="payFrequencyChanged(this, '<?php echo $key; ?>', '<?php    echo $formId ?? ''; ?>')"
                            >
                            <option value="">Select Pay Frequency</option>
                            <?php foreach (Helper::getPayFrequencyLabel() as $index => $label) { ?>
                            <option value="<?php    echo $index; ?>" <?php    echo ($frequency == $index) ? 'selected' : ''; ?>><?php    echo $label; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-6 twice-month-selection <?php echo $frequency == 3 ? '' : 'hide-data'; ?>">
                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px mb-1">Select your pay schedule:</label>
                    <div class="custom-radio-group form-group multi-input-radio-group btn-small">
                        <input type="radio" id="twice_month_selection_yes_<?php echo $key; ?>"
                            name="current_employer[<?php echo $key; ?>][twice_month_selection]" value="0"
                            class="required d-none twice_month_selection_radio" required
                            <?php    echo ($twice_month_selection == 0) ? 'checked' : ''; ?> />
                        <label for="twice_month_selection_yes_<?php echo $key; ?>"
                            class="btn-toggle <?php    echo ($twice_month_selection == 0) ? 'active' : ''; ?>" onclick="toggleMonthSelection(0, '<?php echo $key; ?>', '<?php    echo $formId ?? ''; ?>')">1st & 15th of month</label>

                        <input type="radio" id="twice_month_selection_no_<?php echo $key; ?>"
                            name="current_employer[<?php echo $key; ?>][twice_month_selection]" value="1"
                            class="required d-none twice_month_selection_radio" required
                            <?php    echo ($twice_month_selection == 1) ? 'checked' : ''; ?> />
                        <label for="twice_month_selection_no_<?php echo $key; ?>"
                            class="btn-toggle <?php    echo ($twice_month_selection == 1) ? 'active' : ''; ?>" onclick="toggleMonthSelection(1, '<?php echo $key; ?>', '<?php    echo $formId ?? ''; ?>')">15th & last day (<?php echo date("jS", strtotime("last day of this month")); ?>) of the month</label>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Date you received your last check</label>
                        <input type="text" class="form-control  date_filed paystub_paydate_recent" required
                            name="current_employer[<?php echo $key; ?>][end_date]" placeholder="MM/DD/YYYY"
                            value="<?php echo Helper::validate_key_value('end_date', $value); ?>">
                    </div>
                </div>
            </div>


            <div class="col-12">
                <strong class="subtitle">How long has <?php echo $debtorname; ?> been employed at above</strong>
            </div>
            <div class="col-12 col-md-3 col-lg-3 col-xl-2  col-sm-6">
                <div class="label-div">
                    <label class="d-block">Year(s)</label>
                    <select class="form-control mb-2 employment_period_year"
                        onchange="updateEmpPeriod(<?php echo $key; ?>, '<?php echo $formId ?? ''; ?>')">
                        <option value="0" selected>Select Years</option>
                        <?php for ($i = 1; $i <= 30; $i++) { ?>
                        <option value="{{$i}}">{{$i}} <?php    echo ($i === 1) ? 'Year' : 'Years'; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-3 col-lg-3 col-xl-2  col-sm-6">
                <div class="label-div">
                    <label class="d-block">Month(s)</label>
                    <select class="form-control mb-2 employment_period_month"
                        onchange="updateEmpPeriod(<?php echo $key; ?>, '<?php echo $formId ?? ''; ?>')">
                        <option value="0" selected>Select Months</option>
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                        <option value="{{$i}}">{{$i}} <?php    echo ($i === 1) ? 'Month' : 'Months'; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <?php $edate = Helper::validate_key_value('start_date', $value); ?>
            <div
                class="col-12 col-md-3 col-lg-3 col-xl-2  col-sm-6 start-date-main-div employment_period_date <?php echo empty($edate) ? 'hide-data' : 'required'; ?>">
                <div class="mt-md-0">
                    <div class="label-div">
                        <div class="form-group mb-0">
                            <label class="">Start&nbsp;Date</label>
                            <input type="text"
                                class="form-control date_filed employment_period_date paystub_paydate_start <?php echo empty($edate) ? 'hide-data' : 'required'; ?>"
                                name="current_employer[<?php echo $key; ?>][start_date]" placeholder="MM/DD/YYYY"
                                value="<?php echo $edate; ?>" data-key="<?php echo $key; ?>">
                        </div>
                    </div>
                </div>
                <label
                    class="error-message text-danger ml-3 mt-1 mb-0 float_right employment_period_date employment_period_date_error"
                    style="font-style: italic;"></label>
            </div>
            <div class="col-12 col-md-3 col-lg-3 col-xl-2  col-sm-6">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Employment Duration</label>
                        <input type="text" readonly name="current_employer[<?php echo $key; ?>][employment_duration]"
                            id="employer_job_period"
                            data-oldString="<?php echo Helper::validate_key_value('employment_duration', $value); ?>"
                            class="de_job_period job_period form-control required"
                            value="<?php echo Helper::validate_key_value('employment_duration', $value); ?>">
                    </div>
                </div>
            </div>



            <?php $notes = Helper::validate_key_value('notes', $value); ?>
            <div class="col-lg-6 col-12">


                <div class="label-div question-area b-0-i pb-0">
                    <label class="fs-13px">Do you have any notes about <?php echo $debtorname; ?> You would like your
                        attorney to know?</label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="current_employer_yes_<?php echo $key; ?>"
                            name="current_employer[<?php echo $key; ?>][has_notes]" value="1"
                            class="required d-none has_notes_radio" required <?php echo isset($notes) && !empty($notes) ? 'checked' : ''; ?> />
                        <label for="current_employer_yes_<?php echo $key; ?>"
                            class="btn-toggle <?php echo isset($notes) && !empty($notes) ? 'active' : ''; ?>"
                            onclick="toggleHasNotes('yes', <?php echo $key; ?>, '<?php echo $formId; ?>' );">Yes</label>

                        <input type="radio" id="current_employer_no_<?php echo $key; ?>"
                            name="current_employer[<?php echo $key; ?>][has_notes]" value="0"
                            class="required d-none has_notes_radio" required <?php echo isset($notes) && empty($notes) ? 'checked' : ''; ?> />
                        <label for="current_employer_no_<?php echo $key; ?>"
                            class="btn-toggle <?php echo isset($notes) && empty($notes) ? 'active' : ''; ?>"
                            onclick="toggleHasNotes('no', <?php echo $key; ?>, '<?php echo $formId; ?>' );">No</label>
                    </div>
                </div>

            </div>

            <div
                class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 has_notes has_notes_<?php echo $key; ?> <?php echo empty($notes) ? 'hide-data' : ''; ?>">
                <div class="label-div">
                    <div class="form-group">
                        <label class="d-block">Notes</label>
                        <textarea name="current_employer[<?php echo $key; ?>][notes]"
                            class="input_capitalize h-unset form-control notes" cols="30" rows="3"
                            placeholder="Notes"><?php echo $notes; ?></textarea>
                    </div>
                </div>
            </div>

            <?php if ($enableEdit) { ?>
            <div class="col-12 text-right my-2 pb-2">
                <a href="javascript:void(0)" data-saveid="<?php    echo $i; ?>"
                    class="label mx-ht im-action save-btn btn-new-ui-default m-0 px-5 py-2"
                    onclick="saveCurrentEmployer(true,this,false, '<?php    echo $formId ?? ''; ?>')">Save</a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>