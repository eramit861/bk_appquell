<?php
$filingData = !empty($filingData) ? $filingData->toArray() : [];
$debtorFiling = isset($filingData['basic_info']) ? json_decode($filingData['basic_info'], 1) : [];
$summaryFiling = isset($filingData['summary_of_schedule']) ? json_decode($filingData['summary_of_schedule'], 1) : [];
$meanstestFiling = isset($filingData['meantest_information']) ? json_decode($filingData['meantest_information'], 1) : [];

$debtorFilingStatus = 'ok';
$summaryFilingStatus = 'ok';
$meanstestFilingStatus = 'ok';
if (!isset($filingData['basic_info'])) {
    $debtorFilingStatus = 'no';
}
if (!isset($filingData['summary_of_schedule'])) {
    $summaryFilingStatus = 'no';
}
if (!isset($filingData['meantest_information'])) {
    $meanstestFilingStatus = 'no';
}

?>



<div class="row">
    <div class="col-md-12">
        <h2 class="text-center">{{ __('Filing Information') }}</h2>
    </div>
</div>

<div class="tab mt-3">
    <button class="tablinks active" onclick="openTab(event, 'pacer_debtor_info')">{{ __('Debtor Info (Pacer)') }}</button>
    <button class="tablinks" onclick="openTab(event, 'pacer_sum')">{{ __('Summary Of Schedule (Pacer)') }}</button>
    <button class="tablinks" onclick="openTab(event, 'pacer_meanstest')">{{ __('Means Test Information (Pacer)') }}</button>
</div>



<div id="pacer_debtor_info" class="tabcontent">
    <form method="POST" name="filing_information_debtor_info_form" id="basic_info">
        @csrf
        <h3>{{ __('Debtor Information') }}</h3>
        <div class="row mt-3">
            <!-- 1 -->
            <div class="col-md-2">
                <label>{{ __('Last Name') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="last_name" type="text" value="<?php echo Helper::validate_key_value('last_name', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('First Name') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="first_name" type="text" value="<?php echo Helper::validate_key_value('first_name', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-12 mt-2"></div>
            <!-- 2 -->
            <div class="col-md-2">
                <label>{{ __('Middle Name') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="middle_name" type="text" value="<?php echo Helper::validate_key_value('middle_name', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('Generation') }}</label>
            </div>
            <div class="col-md-1">
                <div class="input-group">
                    <input name="generation" type="text" value="<?php echo Helper::validate_key_value('generation', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group d-flex">
                    <label class="p-r-30">{{ __('Title') }}</label>
                    <input name="title" type="text" value="<?php echo Helper::validate_key_value('title', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-12 mt-2"></div>
            <!-- 3 -->
            <div class="col-md-2">
                <label>{{ __('SSN/ITIN') }}</label>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input name="ssn_itin" type="text" value="" class="is_ssn form_input_box">
                </div>
            </div>
            <div class="col-md-2 p-2">
                <span>{{ __('999-99-9999') }}</span>
            </div>
            <div class="col-md-2">
                <label>{{ __('Tax Id/EIN') }}</label>
            </div>
            <div class="col-md-2">
                <div class="input-group">
                    <input name="tax_id_ein" type="text" value="" class="eiin form_input_box">
                </div>
            </div>
            <div class="col-md-2 p-2">
                <span>{{ __('12-1234567') }}</span>
            </div>
            <div class="col-md-12 mt-2"></div>
            <!-- 4 -->
            <div class="col-md-2">
                <label>{{ __('Office') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="office" type="text" value="<?php echo Helper::validate_key_value('office', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('Address 1') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="address_1" type="text" value="<?php echo Helper::validate_key_value('address_1', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-12 mt-2"></div>
            <!-- 5 -->
            <div class="col-md-2">
                <label>{{ __('Address 2') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="address_2" type="text" value="<?php echo Helper::validate_key_value('address_2', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('Address 3') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="address_3" type="text" value="<?php echo Helper::validate_key_value('address_3', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-12 mt-2"></div>
            <!-- 6 -->
            <div class="col-md-2">
                <label>{{ __('City') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="city" type="text" value="<?php echo Helper::validate_key_value('city', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('State') }}</label>
            </div>
            <div class="col-md-1">
                <div class="input-group">
                    <input name="state" type="text" value="<?php echo Helper::validate_key_value('state', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group d-flex">
                    <label class="p-r-30">Zip</label>
                    <input name="zip" type="text" value="<?php echo Helper::validate_key_value('zip', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-12 mt-2"></div>
            <!-- 7 -->
            <div class="col-md-2">
                <label>{{ __('County') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="county" type="text" value="<?php echo Helper::validate_key_value('county', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('Country') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="country" type="text" value="<?php echo Helper::validate_key_value('country', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-12 mt-2"></div>
            <!-- 8 -->
            <div class="col-md-2">
                <label>{{ __('Phone') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="phone" type="text" value="" class="phone-field form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>Fax</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="fax" type="text" value="<?php echo Helper::validate_key_value('fax', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-12 mt-2"></div>
            <!-- 9 -->
            <div class="col-md-2">
                <label>{{ __('E-mail') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="email" type="text" value="<?php echo Helper::validate_key_value('email', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2">
                <label>{{ __('Party text') }}</label>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="party_text" type="text" value="<?php echo Helper::validate_key_value('party_text', $debtorFiling); ?>" class="form_input_box">
                </div>
            </div>
            <div class="col-md-12 mt-2"></div>
            <!-- 10 -->
            <div class="col-md-11 mt-2 mb-2">
                <a href="javascript:void(0)" class="btn-form float_right" onclick="saveFilingInfoToDb('basic_info',false)">{{ __('Save Changes') }}</a>
                <a href="javascript:void(0)" class="btn-form float_right mr-2" onclick="saveFilingInfoToDb('basic_info',true)">{{ __('Reset to Client Questionnaire') }}</a>
            </div>
        </div>
    </form>
</div>

<div id="pacer_sum" class="tabcontent pt-0 pb-0">
    <form method="POST" name="filing_information_sum_form" id="summary_info">
        @csrf
        <h3>{{ __('Summary of Schedule') }}</h3>
        <div class="row heading text-center">
            <div class="col-md-6 p-3">
                <label>{{ __('NAME OF SCHEDULE/FORM') }}</label>
            </div>
            <div class="col-md-2 p-3">
                <label>{{ __('ASSETS') }}</label>
            </div>
            <div class="col-md-2 p-3">
                <label>{{ __('LIABILITIES') }}</label>
            </div>
            <div class="col-md-2 p-3">
                <label>{{ __('OTHER') }}</label>
            </div>
        </div>
        <div class="row padding-0 ">
            <!-- 1 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule A/B - Total Real Estate') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_ab_real_estate" type="text" value="<?php echo Helper::validate_key_value('schedule_ab_real_estate', $summaryFiling); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- 2 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule A/B - Total Personal Property') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_ab_personal_property" type="text" value="<?php echo Helper::validate_key_value('schedule_ab_personal_property', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- 3 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule D - Total Secured Claims') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_d_secured_claims" type="text" value="<?php echo Helper::validate_key_value('schedule_d_secured_claims', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- 4 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule E/F - Total Priority Unsecured Claims') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_ef_priority_unsecured_claims" type="text" value="<?php echo Helper::validate_key_value('schedule_ef_priority_unsecured_claims', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- 5 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule E/F - Total Nonpriority Unsecured Claims') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_ef_nonpriority_unsecured_claims" type="text" value="<?php echo Helper::validate_key_value('schedule_ef_nonpriority_unsecured_claims', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- 6 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule I - Monthly Income') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 bb-1 br-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_i_monthly_income" type="text" value="<?php echo Helper::validate_key_value('schedule_i_monthly_income', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <!-- 7 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Schedule J - Monthly Expenses') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 bb-1 br-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="schedule_j_monthly_expense" type="text" value="<?php echo Helper::validate_key_value('schedule_j_monthly_expense', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <!-- 8 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label>{{ __('Current Monthly Income (Official Form 122A-1, 122B or 122C-1)') }}</label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 bb-1 br-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="current_monthly_expense" type="text" value="<?php echo Helper::validate_key_value('current_monthly_expense', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <!-- 9 -->
            <div class="col-md-6 p-3 br-1 bb-1">
                <label><b>{{ __('Total Nondischargable Debt (Official Form 106Sum, 9g)') }}</b></label>
            </div>
            <div class="col-md-2 br-1 bb-1 bg-dim"></div>
            <div class="col-md-2 br-1 bb-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="nondischargable_debt" type="text" value="<?php echo Helper::validate_key_value('nondischargable_debt', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- 10 -->
            <div class="col-md-6 bb-1 p-3 br-1">
                <label><b>{{ __('Total Dischargeable Debt (Computed)') }}</b><br>{{ __('Note: Not computed when any value above for D, E/f, or total nondischargeable debt is not known') }}</label>
            </div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <div class="col-md-2 bb-1 br-1 bg-dim">
                <div class="input-group mt-2">
                    <input name="dischargable_debt" type="text" value="<?php echo Helper::validate_key_value('dischargable_debt', $summaryFiling, 'comma'); ?>" class="price-field form_input_box">
                </div>
            </div>
            <div class="col-md-2 bb-1 br-1 bg-dim"></div>
            <!-- save button -->
            <div class="col-md-12 mt-3 mb-3">
                <a href="javascript:void(0)" class="btn-form float_right" onclick="saveFilingInfoToDb('summary_info',false)">{{ __('Save Changes') }}</a>
                <a href="javascript:void(0)" class="btn-form float_right mr-2" onclick="saveFilingInfoToDb('summary_info',true)">{{ __('Reset to Client Questionnaire') }}</a>
            </div>
        </div>
    </form>
</div>

<div id="pacer_meanstest" class="tabcontent">
    <form method="POST" name="filing_information_means_test_form" id="meanstest_info">
        @csrf
        <h3>{{ __('Means Test Information') }}</h3>
        <a href="javascript:void(0)" onclick="selectMultiples()" class="btn-form float_right mt-2">{{ __('Select multiple') }}</a>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <!-- Schedules -->
                    <div class="col-md-12 pt-3">
                        <label><b>{{ __('Schedules') }}</b></label>
                    </div>
                    <div class="col-md-5 mt-2">
                        <label>{{ __('Schedule I line 2: Monthly gross wages, salary, and commission') }}</label>
                    </div>
                    <div class="col-md-7 mt-2">
                        <div class="input-group d-flex">
                            <label class="pr-2 pt-2 pl-3px">{{ __('Debtor') }}</label>
                            <input name="schedule_i_line2_debtor" type="text" value="<?php echo Helper::validate_key_value('schedule_i_line2_debtor', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                            <label class="pr-2 pl-2 pt-2">{{ __('Spouse') }}</label>
                            <input name="schedule_i_line2_spouse" type="text" value="<?php echo Helper::validate_key_value('schedule_i_line2_spouse', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-5 mt-2">
                        <label>{{ __('Schedule I line 6: Subtotal of payroll deductions') }}</label>
                    </div>
                    <div class="col-md-7 mt-2">
                        <div class="input-group d-flex">
                            <label class="pr-2 pt-2 pl-3px">{{ __('Debtor') }}</label>
                            <input name="schedule_i_line6_debtor" type="text" value="<?php echo Helper::validate_key_value('schedule_i_line6_debtor', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                            <label class="pr-2 pl-2 pt-2">{{ __('Spouse') }}</label>
                            <input name="schedule_i_line6_spouse" type="text" value="<?php echo Helper::validate_key_value('schedule_i_line6_spouse', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Schedule J line 23c: Monthly net income') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="schedule_j_line23c_monthly_net_income" type="text" value="<?php echo Helper::validate_key_value('schedule_j_line23c_monthly_net_income', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <!-- Form B122A-1 -->
                    <div class="col-md-12 pt-3">
                        <label><b>{{ __('Form B122A-1') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 1: Marital and filing status') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select class="form_input_box" name="marital_status">
                            <?php echo ArrayHelper::getClientTypeSelection(Helper::validate_key_value('marital_status', $meanstestFiling), true); ?>
                        </select>
                    </div>
                    <div class="col-md-5 mt-2">
                        <label>{{ __('Line 11: Total current monthly income') }}</label>
                    </div>
                    <div class="col-md-7 mt-2">
                        <div class="input-group d-flex">
                            <label class="pr-2 pt-2 pl-3px">{{ __('Debtor') }}</label>
                            <input name="line11_debtor" type="text" value="<?php echo Helper::validate_key_value('line11_debtor', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                            <label class="pr-2 pl-2 pt-2">{{ __('Spouse') }}</label>
                            <input name="line11_spouse" type="text" value="<?php echo Helper::validate_key_value('line11_spouse', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __("Line 13: Number of people in debtor's household") }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line13_no_of_people" type="text" value="<?php echo Helper::validate_key_value('line13_no_of_people', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 13: Applicable median family income') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line13_median_family_income" type="text" value="<?php echo Helper::validate_key_value('line13_median_family_income', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <!-- Form B122A-1Supp -->
                    <div class="col-md-12 pt-3">
                        <label><b>{{ __('Form B122A-1Supp') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 1: Declaration of non-consumer debt') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line1_non_consumer_debt" type="checkbox" value="" class="form_input_box width-auto">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 2: Disabled veteran') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line2_disable_veteran" type="checkbox" value="" class="form_input_box width-auto">
                        </div>
                    </div>
                    <!-- Form B122A-2 -->
                    <div class="col-md-12 pt-3">
                        <label><b>{{ __('Form B122A-2') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 4: Adjusted current monthly income') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line4_current_monthly_income" type="text" value="<?php echo Helper::validate_key_value('line4_current_monthly_income', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <!-- National Standards -->
                    <div class="col-md-12 pt-3">
                        <label class="italic-text"><b>{{ __('National Standards') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 6: Food, clothing and other items') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line6_food_clothing_other_items" type="text" value="<?php echo Helper::validate_key_value('line6_food_clothing_other_items', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 7c: Out-of-pocket health care allowance: people under 65 years of age') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line7c_age1" type="text" value="<?php echo Helper::validate_key_value('line7c_age1', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 7f: Out-of-pocket health care allowance: people 65 years of age or older') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line7f_age2" type="text" value="<?php echo Helper::validate_key_value('line7f_age2', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <!-- Local Standards -->
                    <div class="col-md-12 pt-3">
                        <label class="italic-text"><b>{{ __('Local Standards') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 8: Housing and utilities; insurance and operating expenses') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line8_operating_expenses" type="text" value="<?php echo Helper::validate_key_value('line8_operating_expenses', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 9c: Housing and utilities; Net mortgage or rent expense') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line9c_rent_expense" type="text" value="<?php echo Helper::validate_key_value('line9c_rent_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 11: Local transportaion expenses: number of vehicles') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select class="form_input_box" onchange="" name="line11_no_of_vehicle" id="">
                            <option value="" class="form_input_box">{{ __('Select number of vehicle') }}</option>
                            <option value="1" class="form_input_box" <?php echo Helper::validate_key_option('line11_no_of_vehicle', $meanstestFiling, 1);?>>0</option>
                            <option value="2" class="form_input_box" <?php echo Helper::validate_key_option('line11_no_of_vehicle', $meanstestFiling, 2);?>>1</option>
                            <option value="3" class="form_input_box" <?php echo Helper::validate_key_option('line11_no_of_vehicle', $meanstestFiling, 3);?>>{{ __('2 or more') }}</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 12: Vehicle operation expense OR Line 14: Public transportation expense') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line12_public_transportation_expense" type="text" value="<?php echo Helper::validate_key_value('line12_public_transportation_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 13c: Net Vehicle 1 ownership or lease expense') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line13c_vehicle1_lease_expense" type="text" value="<?php echo Helper::validate_key_value('line13c_vehicle1_lease_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 13f: Net Vehicle 2 ownership or lease expense') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line13f_vehicle2_lease_expense" type="text" value="<?php echo Helper::validate_key_value('line13f_vehicle2_lease_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 15: Additional public transpotation expense') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line15_public_transpotation_expense" type="text" value="<?php echo Helper::validate_key_value('line15_public_transpotation_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <!-- Other Expenses -->
                    <div class="col-md-12 pt-3">
                        <label class="italic-text"><b>{{ __('Other Expenses') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 24: Total expenses allowed under IRS expense allowance') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line24_irs_expense" type="text" value="<?php echo Helper::validate_key_value('line24_irs_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 29: Education expenses from dependent children younger than 18') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line29_education_expense" type="text" value="<?php echo Helper::validate_key_value('line29_education_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 30: Additional food and clothing expense') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line30_additional_food_and_clothing_expense" type="text" value="<?php echo Helper::validate_key_value('line30_additional_food_and_clothing_expense', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 32: Total additional expense deductions') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line32_additional_expense_deductions" type="text" value="<?php echo Helper::validate_key_value('line32_additional_expense_deductions', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 37: Total deductions for debt payment') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line37_deduction_for_debt_payment" type="text" value="<?php echo Helper::validate_key_value('line37_deduction_for_debt_payment', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 38: Total deductions for income') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line38_deduction_for_income" type="text" value="<?php echo Helper::validate_key_value('line38_deduction_for_income', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <!-- Determine Presumption of Abuse -->
                    <div class="col-md-12 pt-3">
                        <label class="italic-text"><b>{{ __('Determine Presumption of Abuse') }}</b></label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 39c: Monthly disposable income') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line39c_monthly_disposable_income" type="text" value="<?php echo Helper::validate_key_value('line39c_monthly_disposable_income', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 39d: 60-month disposable income') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line39d_60month_disposable_income" type="text" value="<?php echo Helper::validate_key_value('line39d_60month_disposable_income', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 40: Initial presumptions determination') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select class="form_input_box" name="line40_initial_presumptions" onchange="" id="">
                            <option value="" class="form_input_box">{{ __('Select Initial presumption determination') }}</option>
                            <option value="1" class="form_input_box" <?php echo Helper::validate_key_option('line40_initial_presumptions', $meanstestFiling, 1);?>>The line 39d is less than $9,075*</option>
                            <option value="2" class="form_input_box" <?php echo Helper::validate_key_option('line40_initial_presumptions', $meanstestFiling, 2);?>>The line 39d is more than $15,150*</option>
                            <option value="3" class="form_input_box" <?php echo Helper::validate_key_option('line40_initial_presumptions', $meanstestFiling, 3);?>>The line 39d is at least $9,075*</option>
                        </select>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 41a: Total nonpriority unsecured debt') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line41a_nonpriority_unsecured_debt" type="text" value="<?php echo Helper::validate_key_value('line41a_nonpriority_unsecured_debt', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 41b: 25% of total nonpriority unsecured debt') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="input-group">
                            <input name="line41b_25percent_nonpriority_unsecured_debt" type="text" value="<?php echo Helper::validate_key_value('line41b_25percent_nonpriority_unsecured_debt', $meanstestFiling, 'comma'); ?>" class="price-field form_input_box">
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <label>{{ __('Line 42: Secondary presumption determination') }}</label>
                    </div>
                    <div class="col-md-6 mt-2">
                        <select class="form_input_box" name="line42_secondary_presumptions" onchange="" id="">
                            <option value="" class="form_input_box">{{ __('Select Secondary presumption determination') }}</option>
                            <option value="1" class="form_input_box" <?php echo Helper::validate_key_option('line42_secondary_presumptions', $meanstestFiling, 1);?>>{{ __('Line 39d is less than line 41b') }}</option>
                            <option value="2" class="form_input_box" <?php echo Helper::validate_key_option('line42_secondary_presumptions', $meanstestFiling, 2);?>>{{ __('Line 39d is equal to or more than line 41b') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- save button -->
            <div class="col-md-12 mt-3 mb-2">
                <a href="javascript:void(0)" class="btn-form float_right" onclick="saveFilingInfoToDb('meanstest_info',false)">{{ __('Save Changes') }}</a>
                <a href="javascript:void(0)" class="btn-form float_right mr-2" onclick="saveFilingInfoToDb('meanstest_info',true)">{{ __('Reset to Client Questionnaire') }}</a>
            </div>
        </div>
    </form>
</div>

<script>


    function openTab(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).on("input", ".is_ssn", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        self.val(self.val().replace(/(\d{3})\-?(\d{2})\-?(\d{4})/, '$1-$2-$3'));
        var first10 = $(this).val().substring(0, 11);
        if (this.value.length > 11) {
            this.value = first10;
        }
    });

    $(document).on("input", ".eiin", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        self.val(self.val().replace(/(\d{2})\-?(\d{7})/, '$1-$2'));
        var first10 = $(this).val().substring(0, 10);
        if (this.value.length > 10) {
            this.value = first10;
        }
    });

    $(document).on("input", ".phone-field", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/[^0-9\.]/g, ''));
        self.val(self.val().replace(/^(\d{3})(\d{3})(\d+)$/, "($1) $2-$3"));
        var first10 = $(this).val().substring(0, 14);
        if (this.value.length > 14) {
            this.value = first10;
        }
    });

    saveFilingInfoToDb = function(saveType, resetType = false) {

        var mt_form = $("#" + saveType);
        var dataString1 = $(mt_form).serialize();
        var client_id = "<?php echo @$client_id; ?>";
        var successMessage = "Record Saved Successfully";
        if(resetType == true){
            var successMessage = "Data Reset Successfully";
        }

        dataString1 += '&saveType=' + saveType + '&client_id=' + client_id + '&resetType=' + resetType;

        $.ajax({
            type: "POST",
            url: "<?php echo route('filing_information_popup_save'); ?>",
            data: dataString1,
            async: true,
            success: function() {
                $.systemMessage(successMessage, 'alert--success', true);
                if(resetType == true){
                    filingPopup();
                }
            }
        });

    }
    
    
    var debtorFilingStatus = '<?php echo $debtorFilingStatus;?>';
    var summaryFilingStatus = '<?php echo $summaryFilingStatus;?>';
    var meanstestFilingStatus = '<?php echo $meanstestFilingStatus;?>';

    if(debtorFilingStatus == 'no'){
        $("#pacer_debtor_info input[type=text]").each(function() {
            $(this).val($(".fi_" + $(this).attr('name')).val());
        });

        $("select[name='marital_status']").val($(".fi_marital_status").val());
    }

    if(summaryFilingStatus == 'no'){
        $("#pacer_sum input[type=text]").each(function() {
            $(this).val($(".fi_" + $(this).attr('name')).val());
        });
    }

    if(meanstestFilingStatus == 'no'){
        $("#pacer_meanstest input[type=text]").each(function() {
            $(this).val($(".fi_" + $(this).attr('name')).val());
        });

        $(".fi_line11_no_of_vehicle").each(function() {
            if ($(this).is(':checked')) {
                console.log($(this).val());
                if ($(this).val() == 0) {
                    $("select[name='line11_no_of_vehicle']").val(1);
                }
                if ($(this).val() == 1) {
                    $("select[name='line11_no_of_vehicle']").val(2);
                }
                if ($(this).val() == 'on') {
                    $("select[name='line11_no_of_vehicle']").val(3);
                }

            }
        });

        $(".fi_line40_initial_presumptions").each(function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 1) {
                    $("select[name='line40_initial_presumptions']").val(1);
                }
                if ($(this).val() == 2) {
                    $("select[name='line40_initial_presumptions']").val(2);
                }
                if ($(this).val() == 'On') {
                    $("select[name='line40_initial_presumptions']").val(3);
                }
            }
        });

        $(".fi_line42_secondary_presumptions").each(function() {
            if ($(this).is(':checked')) {
                if ($(this).val() == 'No') {
                    $("select[name='line42_secondary_presumptions']").val(1);
                }
                if ($(this).val() == 'Yes') {
                    $("select[name='line42_secondary_presumptions']").val(2);
                }

            }
        });
    }

    selectMultiples = function(){
        $("input[name='schedule_i_line2_debtor']").select();
        $("input[name='schedule_i_line2_spouse']").select();
        
        $("input[name='schedule_i_line6_debtor']").select();
        $("input[name='schedule_i_line6_spouse']").select();
    }
</script>

<style>
    #pacer_debtor_info {
        display: block;
    }

    .p-r-30 {
        padding-right: 30px;
    }

    .pb-0 {
        padding-bottom: 0 !important;
    }

    .pl-3px {
        padding-left: 3px;
    }

    .bg-dim {
        background-color: #fafafa;
    }

    .padding-0 {
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        padding-left: 2px !important;
        padding-right: 2px !important;
    }

    .br-1 {
        border-right: 1px solid #ccc;
    }

    .bb-1 {
        border-bottom: 1px solid #ccc;
    }

    .italic-text {
        font-style: italic;
    }

    #pacer_sum h3 {
        padding-top: 6px;
        padding-bottom: 6px;
    }

    #pacer_sum .heading {
        background-color: #EDEEF0;
        color: #414141;
        border-bottom: 1px solid #eaeaea;
        margin-left: -12px;
        margin-right: -12px;
    }

    #pacer_sum .heading label {
        font-weight: bold;
    }

    .form_input_box {
        width: 100%;
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #495057;
        border-radius: 0.25rem;
    }

    #pacer_debtor_info label {
        float: right !important;
        margin-top: 0.5rem !important;
    }

    .float_right {
        float: right !important;
    }

    .width-auto {
        width: auto;
    }

    .tab {
        overflow: hidden;
    }

    .tablinks {
        color: #888;
    }

    .tab button {
        float: left;
        border: 2px solid #012cae !important;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
        font-size: 17px;
        border-bottom: none !important;
        background-color: #fff;
        border-top-left-radius: .25rem;
        border-top-right-radius: .25rem;
    }

    .tab button:hover {
        color: #012cae;
    }

    .tab button.active {
        border: 1px solid #012cae;
        background-color: #012cae;
        color: #fff;
    }

    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top-right-radius: .25rem;
        border-bottom-left-radius: .25rem;
        border-bottom-right-radius: .25rem;
    }
    
    .btn-form {
        transition: all 0.6s ease-out;
    }
    .btn-form:hover, .btn-form:focus {
        background-color: #012cae;
        color: white !important;
    }
</style>
@include("attorney.official_form.common_popup")