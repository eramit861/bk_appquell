<?php
$enableEdit = (isset($enableEdit) && !empty($enableEdit)) ? $enableEdit : false;
$summaryDivId = (isset($summaryDivId) && !empty($summaryDivId)) ? $summaryDivId : '';
?>

<div class="row <?php echo Helper::key_hide_show_v('current_employed', $employerData) ?>" id="<?php echo $summaryDivId; ?>">
    <?php
    $currentEmployerData = Helper::validate_key_value('current_employer', $employerData);
$currentEmployerData = !empty($currentEmployerData) ? json_decode($currentEmployerData, true) : [];
if (!empty($currentEmployerData)) {
    $currentEmployerDataName = Helper::validate_key_value('name', $currentEmployerData);
    $currentEmployerDataName = !empty($currentEmployerDataName) ? $currentEmployerDataName : [];
    foreach ($currentEmployerDataName as $key => $value) {
        $al2 = Helper::validate_key_loop_value('address_line_2', $currentEmployerData, $key);
        ?>
            <div class="col-12 current_employer_div" data-index="<?php echo $key; ?>">
                <div class="row">
                    <div class="col-12 mt-2" id="current_employer_summary_label_div_<?php echo $key; ?>">
                        <label class="section-title font-weight-bold font-lg-12 ">Primary Employer:</label>
                    </div>
                    <div class="col-12 " id="current_employer_summary_div_<?php echo $key; ?>">
                        <div class="row">
                            <div class="col-12">
                                <label class="font-weight-bold ">Occupation: <span class="font-weight-normal occupation"><?php echo Helper::validate_key_loop_value('occupation', $currentEmployerData, $key); ?></span></label>
                            </div>
                            <div class="col-12">
                                <label class="font-weight-bold ">Name of employer: <span class="font-weight-normal name"><?php echo Helper::validate_key_loop_value('name', $currentEmployerData, $key); ?></span></label>
                            </div>
                            <div class="col-12">
                                <label class="font-weight-bold ">Street Address: <span class="font-weight-normal address_line_1"><?php echo Helper::validate_key_loop_value('address_line_1', $currentEmployerData, $key); ?></span></label>
                            </div>
                            <div class="col-12 address_line_2_parent <?php echo (!empty($al2)) ? '' : 'hide-data' ?>">
                                <label class="font-weight-bold ">Address Line 2: <span class="font-weight-normal address_line_2"><?php echo $al2; ?></span></label>
                            </div>
                            <div class="col-5">
                                <label class="font-weight-bold ">City: <span class="font-weight-normal city"><?php echo Helper::validate_key_loop_value('city', $currentEmployerData, $key); ?></span></label>
                            </div>
                            <div class="col-2">
                                <label class="font-weight-bold ">State: <span class="font-weight-normal state"><?php echo Helper::validate_key_loop_value('state', $currentEmployerData, $key); ?></span></label>
                            </div>
                            <div class="col-4">
                                <label class="font-weight-bold ">Zip: <span class="font-weight-normal zip"><?php echo Helper::validate_key_loop_value('zip', $currentEmployerData, $key); ?></span></label>
                            </div>
                            <div class="col-5">
                                <label class="font-weight-bold ">How long employed here:
                                    <span class="font-weight-normal job_period"><?php echo Helper::validate_key_loop_value('job_period', $currentEmployerData, $key) ?></span>
                                </label>
                            </div>
                            <div class="col-7">
                                <label class="font-weight-bold text-c-light-blue paystub_paydate_start_parent <?php echo (!empty(Helper::validate_key_loop_value('paystub_paydate_start', $currentEmployerData, $key))) ? '' : 'hide-data' ?> ">Start Date:
                                    <span class="font-weight-normal paystub_paydate_start"><?php echo Helper::validate_key_loop_value('paystub_paydate_start', $currentEmployerData, $key); ?></span>
                                </label>
                            </div>
                            <div class="col-5">
                                <label class="font-weight-bold ">Pay Frequency:

                                    <span class="font-weight-normal often_get_paid"><?php echo Helper::getPayFrequencyLabel(Helper::validate_key_loop_value('often_get_paid', $currentEmployerData, $key)); ?></span>
                                </label>
                            </div>
                            <div class="col-7">
                                <label class="font-weight-bold ">Recent Paystub Pay Date:
                                    <span class="font-weight-normal paystub_paydate_recent"><?php echo Helper::validate_key_loop_value('paystub_paydate_recent', $currentEmployerData, $key); ?></span>
                                </label>
                            </div>
                            <?php
                                $note = Helper::validate_key_loop_value('notes', $currentEmployerData, $key);
        if (!empty($note)) {
            ?>
                                <div class="col-12">
                                    <label class="font-weight-bold w-100 mb-0">Notes:</label>
                                    <span class="font-weight-normal notes"><?php echo $note; ?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-12 hide-data" id="current_employer_edit_div_<?php echo $key; ?>">
                        <div class="row <?php echo Helper::key_hide_show_v('current_employed', $incomedebtoremployer); ?>">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="d-block">Occupation <i class="text-c-blue">(please state job title or provide brief
                                            description)</i>:</label>
                                    <input type="text" name="current_employer[occupation][<?php echo $key; ?>]" id="employer_occupation" class="input_capitalize form-control required occupation"
                                        cols="30" rows="4" placeholder="Title or Description"
                                        value="<?php echo Helper::validate_key_loop_value('occupation', $currentEmployerData, $key); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="d-block">Name of your employer:</label>
                                    <input type="text" name="current_employer[name][<?php echo $key; ?>]" id="employer_name" class="input_capitalize form-control required name"
                                        value="<?php echo Helper::validate_key_loop_value('name', $currentEmployerData, $key); ?>" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="d-block">Street Address</label>
                                    <input type="text" name="current_employer[address_line_1][<?php echo $key; ?>]" id="name_address_employer"
                                        class="input_capitalize form-control required address_line_1" placeholder="Street Address"
                                        value="<?php echo Helper::validate_key_loop_value('address_line_1', $currentEmployerData, $key); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="d-block">Address Line 2</label>
                                    <input type="text" name="current_employer[address_line_2][<?php echo $key; ?>]" id="employer_address_line" class="input_capitalize form-control address_line_2"
                                        placeholder="Address Line 2"
                                        value="<?php echo $al2; ?>">
                                </div>
                            </div>
                            @php
                            $empCity = Helper::validate_key_loop_value('city', $currentEmployerData, $key);
                            @endphp
                            <x-input type="text" divClass="col-5 " name="current_employer[city][<?php echo $key; ?>]" id="employer_city" placeholder="City"
                                label="City" inputClass="required input_capitalize city" value="{{ $empCity }}"></x-input>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control required state" name="current_employer[state][<?php echo $key; ?>]" id="employer_state">
                                        <option value="">Please Select State</option>
                                        <?php echo AddressHelper::getStatesList(Helper::validate_key_loop_value('state', $currentEmployerData, $key)); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Zip</label>
                                    <input type="number" class="form-control allow-5digit required zip" name="current_employer[zip][<?php echo $key; ?>]"
                                        id="employer_zip" placeholder="Zip"
                                        value="<?php echo Helper::validate_key_loop_value('zip', $currentEmployerData, $key); ?>">
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group">
                                    <label class="d-block">How long you been employed at this job:</label>
                                    <div class=" d-inline-flex">
                                        <select class="form-control w-auto employment_period_year" onchange="updateEmpPeriod('current_employer_edit_div_<?php echo $key; ?>', 'current_employer_summary_div_<?php echo $key; ?>')">
                                            <option value="0" selected>Select Years</option>
                                            <?php for ($i = 1; $i <= 30; $i++) { ?>
                                                <option value="{{$i}}">{{$i}} <?php echo ($i === 1) ? 'Year' : 'Years'; ?></option>
                                            <?php } ?>
                                        </select>
                                        <select class="form-control w-auto ml-3 employment_period_month"
                                            onchange="updateEmpPeriod('current_employer_edit_div_<?php echo $key; ?>', 'current_employer_summary_div_<?php echo $key; ?>')">
                                            <option value="0" selected>Select Months</option>
                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                <option value="{{$i}}">{{$i}} <?php echo ($i === 1) ? 'Month' : 'Months'; ?></option>
                                            <?php } ?>
                                        </select>
                                        <?php $edate = Helper::validate_key_loop_value('paystub_paydate_start', $currentEmployerData, $key); ?>
                                        <label
                                            class="employment_period_date pt-2 ml-3 <?php echo empty($edate) ? 'hide-data' : 'required'; ?>">Your
                                            Start Date: </label>
                                        <input type="text"
                                            class="form-control w-auto ml-3 date_filed employment_period_date paystub_paydate_start <?php echo empty($edate) ? 'hide-data' : 'required'; ?>"
                                            name="current_employer[paystub_paydate_start][<?php echo $key; ?>]" placeholder="MM/DD/YYYY" value="<?php echo $edate; ?>">
                                    </div>
                                    <label class="error-message text-danger ml-3 mt-1 float_right employment_period_date_error" style="font-style: italic;"></label>
                                    <input type="text" readonly name="current_employer[job_period][<?php echo $key; ?>]" id="employer_job_period"
                                        data-oldString="<?php echo Helper::validate_key_loop_value('job_period', $currentEmployerData, $key); ?>"
                                        class="de_job_period job_period form-control required mt-3"
                                        value="<?php echo Helper::validate_key_loop_value('job_period', $currentEmployerData, $key); ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label class="d-block">How often do you get paid?</label>
                                    <select name="current_employer[often_get_paid][<?php echo $key; ?>]" class="form-control required often_get_paid">
                                        <option value="">Select Pay Frequency</option>
                                        <?php foreach (Helper::getPayFrequencyLabel() as $index => $label) { ?>
                                            <option value="<?php echo $index; ?>" <?php echo (Helper::validate_key_loop_value_radio('often_get_paid', $currentEmployerData, $key) == $index) ? 'selected' : ''; ?>><?php echo $label; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <label class="d-block">Please enter your most recent paystub pay date :</label>
                                    <input type="text"
                                        class="form-control w-auto date_filed paystub_paydate_recent" required
                                        name="current_employer[paystub_paydate_recent][<?php echo $key; ?>]" placeholder="MM/DD/YYYY" value="<?php echo Helper::validate_key_loop_value('paystub_paydate_recent', $currentEmployerData, $key); ?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="d-block nts">Notes</label>
                                    <textarea name="current_employer[notes][<?php echo $key; ?>]" class="input_capitalize form-control notes" cols="30" rows="2"
                                        placeholder="Notes"><?php echo Helper::validate_key_loop_value('notes', $currentEmployerData, $key); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Button Div -->
                    <?php if ($enableEdit) { ?>
                        <div class='col-12 d-inline-flex align-items-center my-2' id="current_employer_option_div_<?php echo $key; ?>">
                            <span class="w-100">
                                <a href="javascript:void(0)" class="label mb-0 mx-ht btn lightblue-bg text-white f-12 edit-btn float_right" onclick="display_current_employer_edit_section( '<?php echo $summaryDivId; ?>', <?php echo $key; ?> )">Edit</a>
                                <a href="javascript:void(0)" class="label mx-ht btn im-action  green-bg text-white f-12 save-btn float_right hide-data" onclick="hide_current_employer_edit_section( '<?php echo $summaryDivId; ?>', <?php echo $key; ?> )">Done</a>
                            </span>
                            <a href="javascript:void(0)" class="label delte-icon mb-0 mx-ht btn text-white f-12 " onclick="remove_current_employer_section( '<?php echo $summaryDivId; ?>', <?php echo $key; ?> )"><i class="fa fa-lg fa-trash"></i></a>
                        </div>
                        <div class="col-12 border_bottom pb-0 mt-0 mb-3"></div>
                    <?php } ?>
                </div>
            </div>

    <?php
    }
}
?>
</div>

<!-- display_current_employer_edit_section( summaryDivId, editDivId ) -->