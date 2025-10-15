<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        .notesPopup {
            position: fixed;
            /* Stays fixed in the viewport */
            background: #fff;
            padding: 20px;
            width: 90%;
            /* Responsive width */
            max-width: fit-content;
            /* Restrict size on larger screens */
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .notesPopup {
                width: 95%;
                /* Increase width for smaller devices */
                font-size: 14px;
                /* Adjust font size */
            }
        }

        #facebox .content.fbminwidth {
            min-width: 1300px !important;
            max-width: 1440px !important;
            max-height: 90vh !important;
        }

        p {
            margin-bottom: 0.5rem;
        }

        .hide-data {
            display: none !important
        }

        .notesPopup .body {
            overflow-y: scroll;
            max-height: 400px;
        }
    </style>
    <?php //$web_view = Session::get('web_view');
?>
</head>

<body>

    <div class="ontainer-xl" id="printableArea">

        <div class="row messagePopup" style="margin-left: -15px;
    margin-right: -15px;">
            <div class="col-12 head">
                <h4 class="py-3 mb-0 w-100">
                    Client Details
                </h4>

            </div>
        </div>
        <div class="row client_details_popup">
            <div class="col-md-8 mt-3 element-1">
                <h3></h3>
                <p class="mt-2"><span class=" fw-bold">Marital Status:
                    </span><?php echo ArrayHelper::getMartialStatus($details['martial_status']);?></p>
                <h4 class="mt-3">Debtor's Basic Information</h4>
            </div>

            <div class="col-md-4 element-2">
                <?php if ($is_print == 0) {  ?>
                <a href="javascript:void(0)" onclick="printDiv('printableArea')"
                    class="btn mb-0 mr-4 mt-4 close-modal font-weight-bold border-blue-big f-12 float-right">
                    <i class="fa fa-regular fa-print"></i>
                    <span class="card-title-text">Print</span>
                </a>
                <?php } ?>

            </div>
            <div class="col-md-8 element-3">
                <div class="row">
                    <div class="col-12">
                        <h4 class="mt-3">Debtor's Basic Information</h4>
                    </div>
                    <div class="col-md-4">
                        <?php $middle_name = $details['middle_name'] ? " " . $details['middle_name'] . " " : " ";
    $fullName = $details['name'] . $middle_name . $details['last_name']; ?>
                        <p class=""><span class=" fw-bold">Name: </span><?php echo $fullName; ?> </p>
                    </div>
                    <div class="col-md-8">
                        <p class=""><span class=" fw-bold">Suffix:
                            </span><?php echo ($details['suffix'] == null) ? "None" : ArrayHelper::getSuffixArray($details['suffix']); ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class=""><span class=" fw-bold">Address: </span><?php echo $details['Address']; ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">City: </span><?php echo $details['City']; ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">State: </span><?php echo $details['state']; ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">Zip: </span><?php echo $details['zip']; ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">County:
                            </span><?php echo \App\Models\CountyFipsData::get_county_name_by_id(Helper::validate_key_value('country', $details));?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class=""><span class=" fw-bold">Home: </span><?php echo $details['home']; ?></p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">Cell: </span><?php echo $details['cell']; ?></p>
                    </div>
                    <div
                        class="col-md-2 <?php echo (isset($details['security_number']) && !empty($details['security_number'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">SSN: </span><?php echo $details['security_number']; ?></p>
                    </div>
                    <div class="col-md-4">
                        <p class=""><span class=" fw-bold">Email: </span><?php echo $details['email']; ?></p>
                    </div>
                    <div
                        class="col-md-4 <?php echo (isset($details['work']) && !empty($details['work'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Driver's Lic/Gov. ID: </span><?php echo $details['work']; ?>
                        </p>
                    </div>

                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">Date of Birth:
                            </span><?php echo $details['date_of_birth']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p class=""><span class=" fw-bold">Have you lived at this address for at least 180 days:
                            </span><?php echo Helper::key_display('lived_address_from_180', $details); ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Have you ever filed a bankruptcy case before:
                            </span><?php echo Helper::key_display_reverse('filed_in_last_8_yrs', $details); ?></p>
                    </div>

                    <?php  $any_bankruptcy_filed_before_data = Helper::validate_key_value('any_bankruptcy_filed_before_data', $details);
    if (Helper::validate_key_value('filed_in_last_8_yrs', $details, 'radio') == 0 && !empty($any_bankruptcy_filed_before_data)) {
        $any_bankruptcy_filed_before_data = json_decode($any_bankruptcy_filed_before_data, true);
        if (is_array($any_bankruptcy_filed_before_data)) {
            $count = count(Helper::validate_key_value('case_name', $any_bankruptcy_filed_before_data, 'array'));
            for ($i = 0; $i < $count; $i++) {
                ?>
                    <div class="col-md-4">
                        <p class=""><span class=" fw-bold">{{ $i + 1 }}. Case Name:
                            </span><?php            echo Helper::validate_key_loop_value('case_name', $any_bankruptcy_filed_before_data, $i); ?>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">Date Filed:
                            </span><?php            echo Helper::validate_key_loop_value('data_field_unsure', $any_bankruptcy_filed_before_data, $i) == 'on' ? '(unsure) ' : '';?>
                            <?php            echo Helper::validate_key_loop_value('data_field', $any_bankruptcy_filed_before_data, $i); ?>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <p class=""><span class=" fw-bold">Case Number:
                            </span><?php            echo Helper::validate_key_loop_value('case_numbers_unknown', $any_bankruptcy_filed_before_data, $i) == 'on' ? '(unknown) ' : '';?>
                            <?php            echo Helper::validate_key_loop_value('case_numbers', $any_bankruptcy_filed_before_data, $i); ?>
                        </p>
                    </div>
                    <div class="col-md-4">
                        <p class=""><span class=" fw-bold">District if (known):
                            </span><?php            echo Helper::validate_key_loop_value('district_if_known', $any_bankruptcy_filed_before_data, $i); ?>
                        </p>
                    </div>
                    <?php
            }
        }
    } ?>
                    <!-- Spouse section -->
                    <?php $spouseClass = "hide-data";
    if ($details['martial_status'] == 1 || $details['martial_status'] == 2) {
        $spouseClass = "";
    }?>
                    <div class="col-md-12 <?php echo $spouseClass; ?>">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h4>Co-Debtor's/Spouse's Information</h4>
                            </div>
                            <div class="col-md-4">
                                <?php
    $middle_name = $details['spouse_middle_name'] ? " " . $details['spouse_middle_name'] . " " : " ";
    $spouseFullName = $details['spouse_name'] . $middle_name . $details['spouse_last_name'];
    ?>
                                <p class=""><span class=" fw-bold">Name: </span><?php echo $spouseFullName; ?> </p>
                            </div>
                            <div class="col-md-8">
                                <p class=""><span class=" fw-bold">Suffix:
                                    </span><?php echo ($details['spouse_suffix'] == null) ? "None" : ArrayHelper::getSuffixArray($details['spouse_suffix'] ?? ""); ?>
                                </p>
                            </div>
                            <div class="col-md-4">
                                <p class=""><span class=" fw-bold">Cell: </span><?php echo $details['spouse_cell']; ?>
                                </p>
                            </div>
                            <div
                                class="col-md-3 <?php echo (isset($details['spouse_security_number']) && !empty($details['spouse_security_number'])) ? '' : 'hide-data' ?>">
                                <p class=""><span class=" fw-bold">SSN:
                                    </span><?php echo $details['spouse_security_number']; ?></p>
                            </div>
                            <div
                                class="col-md-3 <?php echo (isset($details['spouse_work']) && !empty($details['spouse_work'])) ? '' : 'hide-data' ?>">
                                <p class=""><span class=" fw-bold">Driver's Lic/Gov. ID:
                                    </span><?php echo $details['spouse_work']; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Date of Birth:
                                    </span><?php echo $details['spouse_date_of_birth']; ?></p>
                            </div>
                            <div
                                class="col-md-3 <?php echo (isset($details['spouse_email']) && !empty($details['spouse_email'])) ? '' : 'hide-data' ?>">
                                <p class=""><span class=" fw-bold">Email: </span><?php echo $details['spouse_email']; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Number of family members and others living with you
                                (including your spouse): </span><?php echo $details['family_members']; ?></p>
                    </div>

                    <!-- EMERGENCY SECTION -->

                    <?php
$emergency_check = Helper::validate_key_value('emergency_check', $details);
    $emergency_notes = Helper::validate_key_value('emergency_notes', $details);
    $find_us = Helper::validate_key_value('find_us', $details);
    $eAA = \App\Helpers\ArrayHelper::getEmergencyAssessmentArray();
    $findUsArray = \App\Helpers\ArrayHelper::getFindUsArray();

    if (!empty($emergency_check) || !empty($emergency_notes)) {
        $emergency_check = json_decode($emergency_check, true);
        ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h4>Emergency Assessment Information</h4>
                            </div>
                            <?php    if ((!empty($emergency_check) && is_array($emergency_check))) { ?>
                            <div class="col-md-12 ">
                                <p class=""><span class=" fw-bold">Urgent Situations : </span>
                                    <?php
        foreach ($emergency_check as $key => $status) {
            if ($status == 1) {
                echo Helper::validate_key_value($key, $eAA) . ', ';
            }
        }?>
                                </p>
                            </div>
                            <?php    } ?>

                            <?php    if ((!empty($emergency_notes))) { ?>
                            <div class="col-md-12 ">
                                <p class=""><span class=" fw-bold">Notes : </span>
                                    <?php        echo $emergency_notes; ?>
                                </p>
                            </div>
                            <?php    } ?>
                        </div>
                    </div>
                    <?php } ?>

                    <!-- FIND SECTION -->
                    <?php if (!empty($find_us)) {
                        $find_us = json_decode($find_us, true);
                        ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12 mt-3">
                                <h4>Find Us Information</h4>
                            </div>
                            <?php    if ((!empty($find_us) && is_array($find_us))) { ?>
                            <div class="col-md-12 ">
                                <p class=""><span class=" fw-bold">Urgent Situations : </span>
                                    <?php
        foreach ($find_us as $key => $status) {
            if ($status == 1) {
                echo Helper::validate_key_value($key, $findUsArray) . ', ';
            }
        }?>
                                </p>
                            </div>
                            <?php    } ?>

                            <div class="col-md-4">
                                <p class=""><span class=" fw-bold">Have you read our Google reviews:
                                    </span><?php    echo $details['google_reviews'] == 1 ? 'Yes / Some' : 'No'; ?>
                                </p>
                            </div>
                            <div class="col-md-8">
                                <p class=""><span class=" fw-bold">Zoom Video Conference Experience:
                                    </span><?php    echo $details['zoom_exp'] == 1 ? 'Comfortable with Zoom' : 'Need Help with Zoom'; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>


                    <!-- Income Section -->
                    <?php
$debtor_income_data = Helper::validate_key_value('debtor_income_data', $details);
    $codebtor_income_data = Helper::validate_key_value('codebtor_income_data', $details);
    $debtor_income_data = json_decode($debtor_income_data, 1);
    $codebtor_income_data = json_decode($codebtor_income_data, 1);
    $spouseSectionClass = "hide-data";
    if ($details['martial_status'] == 1 || $details['martial_status'] == 2) {
        $spouseSectionClass = "";
    }

    if (!empty($debtor_income_data)) {
        ?>

                    <div class="col-lg-12 col-xl-6 mt-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Debtor's Income Information</h4>
                            </div>

                            <x-shortForm.CommonYesNoWithPriceView label='Are you currently employed:'
                                radioValue='{{ Helper::key_display("debtor_gross_wages", $debtor_income_data)}}'
                                amountValue='{{ isset($debtor_income_data["debtor_gross_wages_month"]) ? "$" . number_format((float) $debtor_income_data["debtor_gross_wages_month"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Have you had any Self Employment Income:'
                                radioValue='{{ Helper::key_display("self_employment_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["income_net_profit"] ? "$" . number_format((float) $debtor_income_data["income_net_profit"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Rent and other real property income:'
                                radioValue='{{ Helper::key_display("rental_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["rental_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["rental_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Interest, dividends, and royalties:'
                                radioValue='{{ Helper::key_display("royality_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["royality_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["royality_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView
                                label='Pension and retirement income (Retirement Income):'
                                radioValue='{{ Helper::key_display("retirement_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["retirement_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["retirement_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Regular contributions from others:'
                                radioValue='{{ Helper::key_display("regular_contributions_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["regular_contributions_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["regular_contributions_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Unemployment Compensation:'
                                radioValue='{{ Helper::key_display("unemployment_compensation_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["unemployment_compensation_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["unemployment_compensation_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Social Security income. (SSI Income):'
                                radioValue='{{ Helper::key_display("social_security_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["social_security_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["social_security_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView
                                label='Other government assistance you receive regularly:'
                                radioValue='{{ Helper::key_display("government_assistance_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["government_assistance_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["government_assistance_inc_amt_debtor"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView label='Other sources of income not already mentioned:'
                                radioValue='{{ Helper::key_display("other_sources_inc_debtor", $debtor_income_data)}}'
                                amountValue='{{ $debtor_income_data["other_sources_inc_amt_debtor"] ? "$" . number_format((float) $debtor_income_data["other_sources_inc_amt_debtor"], 2) : "$0.00"}}' />
                        </div>
                    </div>
                    <?php } ?>
                    <!-- old -->
                    <?php
if (!empty($details['employee_type_1'])) {
    $employee_type_1 = "";
    $w2EmployeeClass = "hide-data";
    $selfEmployeeClass = "hide-data";
    if ($details['employee_type_1'] == 0) {
        $employee_type_1 = "W-2 Employee";
        $w2EmployeeClass = "";
    }
    if ($details['employee_type_1'] == 1) {
        $employee_type_1 = "Self Employed";
        $selfEmployeeClass = "";
    }
    if ($details['employee_type_1'] == 2) {
        $employee_type_1 = "Unemployed";
        $selfEmployeeClass = "hide-data";
        $w2EmployeeClass = "hide-data";
    }
    ?>
                    <div class="col-md-12 mt-3">
                        <h4>Income</h4>
                    </div>
                    <div class="col-md-4">
                        <p class=""><span class=" fw-bold">Debtor: </span><?php    echo $employee_type_1; ?></p>
                    </div>
                    <div class="col-md-4 <?php    echo $w2EmployeeClass; ?>">
                        <p class=""><span class=" fw-bold">How often do you get paid:
                            </span><?php    echo ($details['income_paid_1'] == 4) ? "Monthly" : ""; ?></p>
                    </div>
                    <div class="col-md-4 <?php    echo $w2EmployeeClass; ?>">
                        <p class=""><span class=" fw-bold">Your average Gross Paycheck per payday:
                            </span><?php    echo $details['income_avg_paycheck'] ? "$" . number_format((float) $details['income_avg_paycheck'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-8 <?php    echo $selfEmployeeClass; ?>">
                        <p class=""><span class=" fw-bold">Self Employed/ Business Net profit per mo:
                            </span><?php    echo $details['income_net_profit'] ? "$" . number_format((float) $details['income_net_profit'], 2) : "";?>
                        </p>
                    </div>
                    <?php } ?>
                    <!--  -->

                    <!-- <div class="col-md-4">
                    <p class=""><span class=" fw-bold">Retirement / Pension: </span><?php echo $details['income_rpmo'] ? "$" . number_format((float) $details['income_rpmo'], 2) : "";?></p>
                </div>
                <div class="col-md-4">
                    <p class=""><span class=" fw-bold">Social Security Income: </span><?php echo $details['ss_income'] ? "$" . number_format((float) $details['ss_income'], 2) : "";?></p>
                </div>
                <div class="col-md-4">
                    <p class=""><span class=" fw-bold">Other Income: </span><?php echo $details['income_other_income'] ? "$" . number_format((float) $details['income_other_income'], 2) : "";?></p>
                </div>
                <div class="col-md-12">
                    <p class=""><span class=" fw-bold">Notes: </span><?php echo $details['income_notes'];?></p>
                </div> -->



                    <div class="col-md-6">
                        <div class="row">
                            <?php if (!empty($codebtor_income_data)) { ?>
                            <div class="col-md-12 mt-3 <?php    echo $spouseClass; ?>">
                                <h4>Co-Debtor's/Spouse's Income Information</h4>
                            </div>

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Are you currently employed:'
                                radioValue='{{ Helper::key_display("joints_debtor_gross_wages", $codebtor_income_data)}}'
                                amountValue='{{ isset($codebtor_income_data["joints_debtor_gross_wages_month"]) ? "$" . number_format((float) $codebtor_income_data["joints_debtor_gross_wages_month"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Have you had any Self Employment Income:'
                                radioValue='{{ Helper::key_display("self_employment_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["income_net_profit_spouse"] ? "$" . number_format((float) $codebtor_income_data["income_net_profit_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Rent and other real property income:'
                                radioValue='{{ Helper::key_display("rental_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["rental_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["rental_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Interest, dividends, and royalties:'
                                radioValue='{{ Helper::key_display("royality_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["royality_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["royality_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Pension and retirement income (Retirement Income):'
                                radioValue='{{ Helper::key_display("retirement_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["retirement_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["retirement_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Regular contributions from others:'
                                radioValue='{{ Helper::key_display("regular_contributions_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["regular_contributions_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["regular_contributions_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Unemployment Compensation:'
                                radioValue='{{ Helper::key_display("unemployment_compensation_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["unemployment_compensation_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["unemployment_compensation_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Social Security income. (SSI Income):'
                                radioValue='{{ Helper::key_display("social_security_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["social_security_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["social_security_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Other government assistance you receive regularly:'
                                radioValue='{{ Helper::key_display("government_assistance_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["government_assistance_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["government_assistance_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <x-shortForm.CommonYesNoWithPriceView spouseSectionClass='{{$spouseSectionClass}}'
                                label='Other sources of income not already mentioned:'
                                radioValue='{{ Helper::key_display("other_sources_inc_spouse", $codebtor_income_data)}}'
                                amountValue='{{ $codebtor_income_data["other_sources_inc_amt_spouse"] ? "$" . number_format((float) $codebtor_income_data["other_sources_inc_amt_spouse"], 2) : "$0.00"}}' />

                            <?php } ?>
                            <?php if (!empty($details['employee_type_2'])) {
                                $employee_type_2 = "";
                                $spouseW2EmployeeClass = "hide-data";
                                $spouseSelfEmployeeClass = "hide-data";
                                if ($details['employee_type_2'] == 0) {
                                    $employee_type_2 = "W-2 Employee";
                                    $spouseW2EmployeeClass = "";
                                }
                                if ($details['employee_type_2'] == 1) {
                                    $employee_type_2 = "Self Employed";
                                    $spouseSelfEmployeeClass = "";
                                }
                                if ($details['employee_type_2'] == 2) {
                                    $employee_type_2 = "Unemployed";
                                    $spouseSelfEmployeeClass = "hide-data";
                                    $spouseW2EmployeeClass = "hide-data";
                                } ?>
                            <div class="col-md-4">
                                <p class=""><span class=" fw-bold">Spouse: </span><?php    echo $employee_type_2; ?></p>
                            </div>
                            <div class="col-md-4 <?php    echo $spouseW2EmployeeClass; ?>">
                                <p class=""><span class=" fw-bold">How often do you get paid: </span><?php    echo ($details['income_paid_2'] == 4) ? "Monthly" : "";
                                ; ?></p>
                            </div>
                            <div class="col-md-4 <?php    echo $spouseW2EmployeeClass; ?>">
                                <p class=""><span class=" fw-bold">Your average Gross Paycheck per payday:
                                    </span><?php    echo $details['income_spouse_avg_paycheck'] ? "$" . number_format((float) $details['income_spouse_avg_paycheck'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-8 <?php    echo $spouseSelfEmployeeClass; ?>">
                                <p class=""><span class=" fw-bold">Self Employed/ Business Net profit per mo:
                                    </span><?php    echo $details['income_net_profit_spouse'] ? "$" . number_format((float) $details['income_net_profit_spouse'], 2) : "";?>
                                </p>
                            </div>
                            <?php } ?>

                        </div>
                    </div>

                    <!-- Mortgages -->
                    <div class="col-md-12 mt-3">
                        <h4>Mortgages</h4>
                    </div>
                    <?php $rentOrOwn = "";
    $rentSection = "hide-data";
    $ownSection = "hide-data";
    if ($details['rent_or_own'] == 0) {
        $rentOrOwn = "Rent";
        $rentSection = "";
    }
    if ($details['rent_or_own'] == 1) {
        $rentOrOwn = "Own";
    }
    if ($details['loan_on_property'] === 0) {
        $ownSection = "";
    }
    ?>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Rent or Own: </span><?php echo $rentOrOwn; ?></p>
                    </div>
                    <div class="col-md-9 <?php echo $rentSection; ?>">
                        <p class=""><span class=" fw-bold">Monthly Rent:
                            </span><?php echo $details['mortgage_rent_1'] ? "$" . number_format((float) $details['mortgage_rent_1'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Mortgage - 1st Amount Owed:
                            </span><?php echo $details['mortgage_amount_owned_1'] ? "$" . number_format((float) $details['mortgage_amount_owned_1'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Monthly Payment - 1st:
                            </span><?php echo $details['mortgage_own_1'] ? "$" . number_format((float) $details['mortgage_own_1'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Past Due Payments - 1st:
                            </span><?php echo $details['mortgage_past_payment_1'] ? "$" . number_format((float) $details['mortgage_past_payment_1'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Property Value:
                            </span><?php echo $details['mortgage_property_value_1'] ? "$" . number_format((float) $details['mortgage_property_value_1'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Creditor Name:
                            </span><?php echo $details['mortgages_creditor_name_1'];?></p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Street Address:
                            </span><?php echo $details['mortgages_creditor_address_1'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">City:
                            </span><?php echo $details['mortgages_creditor_city_1'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">State:
                            </span><?php echo $details['mortgages_creditor_state_1'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Zip code:
                            </span><?php echo $details['mortgages_creditor_zipcode_1'];?></p>
                    </div>
                    <?php $mortgageAdditionalLoans_2 = "";
    $yesOptionClass = "hide-data";
    $noOptionClass = "hide-data";
    $ownSection = "hide-data";
    if ($details['mortgage_additional_loans'] == 0) {
        $mortgageAdditionalLoans_2 = "No";
        $noOptionClass = "";
    }
    if ($details['mortgage_additional_loans'] == 1) {
        $mortgageAdditionalLoans_2 = "Yes";
        $yesOptionClass = "";
        $ownSection = "";
    }?>
                    <div class="col-md-3 <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Do you have additional loans:
                            </span><?php echo $mortgageAdditionalLoans_2; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">Mortgage - 2nd Amount Owed:
                            </span><?php echo $details['mortgage_amount_owned_2'] ? "$" . number_format((float) $details['mortgage_amount_owned_2'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">Monthly Payment - 2nd:
                            </span><?php echo $details['mortgage_own_2'] ? "$" . number_format((float) $details['mortgage_own_2'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">Past Due Payments - 2nd:
                            </span><?php echo $details['mortgage_past_payment_2'] ? "$" . number_format((float) $details['mortgage_past_payment_2'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">Creditor Name:
                            </span><?php echo $details['mortgages_creditor_name_2'];?></p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">Street Address:
                            </span><?php echo $details['mortgages_creditor_address_2'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">City:
                            </span><?php echo $details['mortgages_creditor_city_2'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">State:
                            </span><?php echo $details['mortgages_creditor_state_2'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?>">
                        <p class=""><span class=" fw-bold">Zip code:
                            </span><?php echo $details['mortgages_creditor_zipcode_2'];?></p>
                    </div>
                    <div
                        class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass; ?> <?php echo $noOptionClass; ?>">
                    </div>

                    <?php $mortgageAdditionalLoans_3 = "";
    $yesOptionClass2 = "hide-data";
    $noOptionClass2 = "hide-data";
    $ownSection = "hide-data";
    if ($details['mortgage_additional_loans_2'] == 0) {
        $mortgageAdditionalLoans_3 = "No";
        $noOptionClass2 = "";
    }
    if ($details['mortgage_additional_loans_2'] == 1) {
        $mortgageAdditionalLoans_3 = "Yes";
        $yesOptionClass2 = "";
        $ownSection = "";
    }?>
                    <div class=" <?php echo $ownSection; ?>">
                        <p class=""><span class=" fw-bold">Do you have additional loans:
                            </span><?php echo $mortgageAdditionalLoans_3; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">Mortgage - 3rd Amount Owed:
                            </span><?php echo $details['mortgage_amount_owned_3'] ? "$" . number_format((float) $details['mortgage_amount_owned_3'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">Monthly Payment - 3rd:
                            </span><?php echo $details['mortgage_own_3'] ? "$" . number_format((float) $details['mortgage_own_3'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">Past Due Payments - 3rd:
                            </span><?php echo $details['mortgage_past_payment_3'] ? "$" . number_format((float) $details['mortgage_past_payment_3'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">Creditor Name:
                            </span><?php echo $details['mortgages_creditor_name_3'];?></p>
                    </div>
                    <div class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">Street Address:
                            </span><?php echo $details['mortgages_creditor_address_3'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">City:
                            </span><?php echo $details['mortgages_creditor_city_3'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">State:
                            </span><?php echo $details['mortgages_creditor_state_3'];?></p>
                    </div>
                    <div class="col-md-2 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?>">
                        <p class=""><span class=" fw-bold">Zip code:
                            </span><?php echo $details['mortgages_creditor_zipcode_3'];?></p>
                    </div>
                    <div
                        class="col-md-3 <?php echo $ownSection; ?> <?php echo $yesOptionClass2; ?> <?php echo $noOptionClass2; ?>">
                    </div>

                    <?php $foreclosureValue = "";
    $foreclosureSection = "hide-data";
    if ($details['mortgage_foreclosure_property'] == 0) {
        $foreclosureValue = "Yes";
        $foreclosureSection = "";
    }
    if ($details['mortgage_foreclosure_property'] == 1) {
        $foreclosureValue = "No";
    }?>
                    <div class="col-md-3">
                        <p class=""><span class=" fw-bold">Property in foreclosure:
                            </span><?php echo $foreclosureValue; ?></p>
                    </div>
                    <div class="col-md-3  <?php echo $foreclosureSection; ?>">
                        <p class=""><span class=" fw-bold">Foreclosure sale date been set:
                            </span><?php echo Helper::key_display_reverse('mortgage_foreclosure_date', $details); ?></p>
                    </div>
                    <div class="col-md-6  <?php echo $foreclosureSection; ?>">
                        <p class=""><span class=" fw-bold">Date Foreclosure Scheduled:
                            </span><?php echo $details['mortgage_foreclosure_date_scheduled']; ?></p>
                    </div>
                    <div class="col-md-12  <?php echo $foreclosureSection; ?>">
                        <p class=""><span class=" fw-bold">Notes: </span><?php echo $details['mortgage_notes']; ?></p>
                    </div>

                    <!-- Vehicle -->
                    <div class="col-md-12 mt-3">
                        <h4>Vehicles/ Motorcycles/ Boats etc. </h4>
                    </div>
                    <?php
    $vehiclesYesOrNo = "";
    $vehicleYesSection = "hide-data";
    if ($details['own_any_vehicle'] == 0) {
        $vehiclesYesOrNo = "No";
    }
    if ($details['own_any_vehicle'] == 1) {
        $vehiclesYesOrNo = "Yes";
        $vehicleYesSection = "";
    }
    ?>
                    <div class="col-md-3">
                        <p class=""><span class=" fw-bold">Do you own any vehicle:
                            </span><?php echo $vehiclesYesOrNo; ?></p>
                    </div>
                    <div class="col-md-12 <?php echo $vehicleYesSection; ?>">
                        <?php $vehicle_details = $details['vehicle_details'];
    $vehicle_details = json_decode($vehicle_details, true);
    $i = 1;
    if (!empty($vehicle_details)) {
        foreach ($vehicle_details as $val => $veh) {?>
                        <div class="row mt-2">
                            <div class="col-md-8">
                                <?php        $vehicleType = "";
            if ($veh['property_type'] == 1) {
                $vehicleType = "Vehicle (Cars, vans, trucks, tractors, sport utility vehicles)";
            }
            if ($veh['property_type'] == 6) {
                $vehicleType = "Watercraft, aircraft, motor homes, ATVs and other recreational vehicles, other vehicles, and accessories";
            }
            ?>
                                <p class=""><span class=" fw-bold">Vehicle <?php        echo $i; ?>:
                                    </span><?php        echo $vehicleType; ?></p>
                            </div>
                            <div class="col-md-4">
                                <p class=""><span class=" fw-bold">Estimated Value of Property:
                                    </span><?php        echo $veh['property_estimated_value'] ? "$" . number_format((float) $veh['property_estimated_value'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Year:
                                    </span><?php        echo $veh['property_year']; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Make:
                                    </span><?php        echo $veh['property_make']; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Model:
                                    </span><?php        echo $veh['property_model']; ?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Mileage:
                                    </span><?php        echo $veh['property_mileage']; ?></p>
                            </div>
                            <div class="col-md-4">
                                <p class=""><span class=" fw-bold">Style of Vehicle:
                                    </span><?php        echo $veh['property_other_info']; ?></p>
                            </div>
                            <?php
        $vehPayment = json_decode($veh['vehicle_car_loan'], true);
            $vehicleLoan = "hide-data";
            $vehicleLoanType = $veh['loan_own_type_property'] ?? "";
            if ($vehicleLoanType == 0) {
                $vehicleLoan = "";
            }
            ?>
                            <div class="col-md-4 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">Monthly payment amount:
                                    </span><?php        echo isset($vehPayment['monthly_payment']) ? "$" . number_format((float) $vehPayment['monthly_payment'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-4 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">Past due payment:
                                    </span><?php        echo $vehPayment['past_due_amount'] ? "$" . number_format((float) $vehPayment['past_due_amount'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-4 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">Amount Owed:
                                    </span><?php        echo $vehPayment['amount_own'] ? "$" . number_format((float) $vehPayment['amount_own'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-3 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">Creditor Name:
                                    </span><?php        echo $vehPayment['creditor_name'] ?? "";?></p>
                            </div>
                            <div class="col-md-3 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">Street Address:
                                    </span><?php        echo $vehPayment['creditor_name_addresss'] ?? "";?></p>
                            </div>
                            <div class="col-md-2 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">City:
                                    </span><?php        echo $vehPayment['creditor_city'] ?? "";?></p>
                            </div>
                            <div class="col-md-2 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">State:
                                    </span><?php        echo $vehPayment['creditor_state'] ?? "";?></p>
                            </div>
                            <div class="col-md-2 <?php        echo $vehicleLoan;?>">
                                <p class=""><span class=" fw-bold">Zip code:
                                    </span><?php        echo $vehPayment['creditor_zip'] ?? "";?></p>
                            </div>

                        </div>
                        <?php        $i++;
        }
    } ?>
                    </div>

                    <!-- ///////////////////////////////////// -->

                    <!-- Other Secured Loans -->
                    <div class="col-md-12 mt-3">
                        <h4>Other Secured Loans</h4>
                    </div>
                    <?php
    $additionalLiensYesOrNo = "";
    $additionalLiensYesSection = "hide-data";
    if ($details['additional_liens'] == 0) {
        $additionalLiensYesOrNo = "No";
    }
    if ($details['additional_liens'] == 1) {
        $additionalLiensYesOrNo = "Yes";
        $additionalLiensYesSection = "";
    }
    ?>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Do you have any additional liens or loans secured against any
                                real or personal property not already listed:
                            </span><?php echo $additionalLiensYesOrNo; ?></p>
                    </div>
                    <div class="col-md-12 <?php echo $additionalLiensYesSection; ?>">
                        <?php $additional_liens_data = $details['additional_liens_data'];
    $additional_liens_data = json_decode($additional_liens_data, true);
    $i = 0;
    if (!empty($additional_liens_data)) {
        foreach ($additional_liens_data as $val => $data) {
            ?>
                        <div class="row mt-2">

                            <div class="col-md-3">
                                <p class=""><span class=" fw-bold">Creditor Name:
                                    </span><?php        echo $data["domestic_support_name"] ?? ''; ?></p>
                            </div>
                            <div class="col-md-3">
                                <p class=""><span class=" fw-bold">Address:
                                    </span><?php        echo $data["domestic_support_address"] ?? ''; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">City:
                                    </span><?php        echo $data["domestic_support_city"] ?? ''; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">State:
                                    </span><?php        echo $data["creditor_state"] ?? ''; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Zip:
                                    </span><?php        echo $data["domestic_support_zipcode"] ?? ''; ?></p>
                            </div>

                            <div class="col-md-6">
                                <p class=""><span class=" fw-bold">Property Description:
                                    </span><?php        echo $data["describe_secure_claim"] ?? ''; ?></p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Monthly Payment:
                                    </span><?php        echo isset($data['monthly_payment']) ? "$" . number_format((float) $data['monthly_payment'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Amount Due:
                                    </span><?php        echo isset($data['additional_liens_due']) ? "$" . number_format((float) $data['additional_liens_due'], 2) : "";?>
                                </p>
                            </div>
                            <div class="col-md-2">
                                <p class=""><span class=" fw-bold">Date:
                                    </span><?php        echo $data["additional_liens_date"] ?? ''; ?></p>
                            </div>


                        </div>
                        <?php        $i++;
        }
    } ?>
                    </div>

                    <!-- ///////////////////////////////////// -->
                    <div class="col-md-12 mt-3">
                        <h4>Back taxes owed</h4>
                    </div>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Have you filed State & Federal taxes the last 5 years:
                            </span><?php echo Helper::key_display("last_5_year_taxes", $details); ?></p>
                    </div>

                    <div
                        class="<?php echo (Helper::validate_key_value("tax_owned_irs", $details, 'radio') == 1) ? 'col-md-3' : 'col-md-12'; ?>">
                        <p class=""><span class=" fw-bold">Do you owe any back taxes to the IRS:
                            </span><?php echo Helper::key_display("tax_owned_irs", $details); ?></p>
                    </div>
                    <div class="col-md-3 <?php echo Helper::key_hide_show('tax_owned_irs', $details); ?>">
                        <p class=""><span class=" fw-bold">Input which year(s):
                            </span><?php echo $details['taxes_internal_revenue_year']; ?></p>
                    </div>
                    <div class="col-md-6 <?php echo Helper::key_hide_show('tax_owned_irs', $details); ?>">
                        <p class=""><span class=" fw-bold">Total IRS Taxes Due:
                            </span><?php echo $details['taxes_irs_taxes_due'] ? "$" . number_format((float) $details['taxes_irs_taxes_due'], 2) : "";?>
                        </p>
                    </div>

                    <div
                        class="<?php echo (Helper::validate_key_value("back_taxes_owed", $details, 'radio') == 1) ? 'col-md-3' : 'col-md-12'; ?>">
                        <p class=""><span class=" fw-bold">Do you owe any back taxes owed to the State:
                            </span><?php echo Helper::key_display("back_taxes_owed", $details); ?></p>
                    </div>

                    <div class="col-md-3 <?php echo Helper::key_hide_show('back_taxes_owed', $details); ?>">
                        <p class=""><span class=" fw-bold">Taxes - State:
                            </span><?php echo $details['taxes_tax_state']; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo Helper::key_hide_show('back_taxes_owed', $details); ?>">
                        <p class=""><span class=" fw-bold">Input which year(s):
                            </span><?php echo $details['taxes_franchise_tax_board']; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo Helper::key_hide_show('back_taxes_owed', $details); ?>">
                        <p class=""><span class=" fw-bold">Total State Taxes Due:
                            </span><?php echo $details['taxes_state_tax_due'] ? "$" . number_format((float) $details['taxes_state_tax_due'], 2) : "";?>
                        </p>
                    </div>
                    <?php $childSuppYesOrNo = "";
    $childSuppYesSection = "hide-data";
    if ($details['child_supp_or_alimony'] == 0) {
        $childSuppYesOrNo = "Yes";
        $childSuppYesSection = "";
    }
    if ($details['child_supp_or_alimony'] == 1) {
        $childSuppYesOrNo = "No";
    }
    $childSuppObligationYesOrNo = "";
    $childSuppObligationSection = "hide-data";
    $current_on_your_support_obligation = $details['current_on_your_support_obligation'] ?? '';
    if ($current_on_your_support_obligation == 0) {
        $childSuppObligationYesOrNo = "Yes";
    }
    if ($current_on_your_support_obligation == 1) {
        $childSuppObligationYesOrNo = "No";
        $childSuppObligationSection = "";
    }
    ?>

                    <div
                        class="<?php echo (Helper::validate_key_value("child_supp_or_alimony", $details, 'radio') == 0) ? 'col-md-3' : 'col-md-12'; ?>">
                        <p class=""><span class=" fw-bold">Do you owed Child Support/Alimony:
                            </span><?php echo $childSuppYesOrNo; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo $childSuppYesSection; ?>">
                        <p class=""><span class=" fw-bold">Child Support/Alimony - State:
                            </span><?php echo $details['taxes_child_support_state']; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo $childSuppYesSection; ?>">
                        <p class=""><span class=" fw-bold">Monthly Payment:
                            </span><?php echo $details['taxes_child_support_due'] ? "$" . number_format((float) $details['taxes_child_support_due'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-6 <?php echo $childSuppYesSection; ?>">
                        <p class=""><span class=" fw-bold">Are you current on your support obiligation(s):
                            </span><?php echo $childSuppObligationYesOrNo; ?></p>
                    </div>
                    <div class="col-md-3 <?php echo $childSuppYesSection;
    echo ' ' . $childSuppObligationSection;?> ">
                        <p class=""><span class=" fw-bold">Past Due Amount:
                            </span><?php echo $details['taxes_alimony_due'] ? "$" . number_format((float) $details['taxes_alimony_due'], 2) : "";?>
                        </p>
                    </div>

                    <!-- Other Debts -->
                    <div class="col-md-12 mt-3">
                        <h4>Other Debts</h4>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['credit_crd_debt']) && !empty($details['credit_crd_debt'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Total Credit Card debt:
                            </span><?php echo $details['credit_crd_debt'] ? "$" . number_format((float) $details['credit_crd_debt'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['medical_debt']) && !empty($details['medical_debt'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Total Medical debt:
                            </span><?php echo $details['medical_debt'] ? "$" . number_format((float) $details['medical_debt'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['student_loans']) && !empty($details['student_loans'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Total Student loans:
                            </span><?php echo $details['student_loans'] ? "$" . number_format((float) $details['student_loans'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['law_suit']) && !empty($details['law_suit'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Law Suit / Judgement:
                            </span><?php echo $details['law_suit'] ? "$" . number_format((float) $details['law_suit'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['personal_loans']) && !empty($details['personal_loans'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Total Personal Loans:
                            </span><?php echo $details['personal_loans'] ? "$" . number_format((float) $details['personal_loans'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['credit_union_loans']) && !empty($details['credit_union_loans'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Total Credit Union Loans:
                            </span><?php echo $details['credit_union_loans'] ? "$" . number_format((float) $details['credit_union_loans'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['family_loans']) && !empty($details['family_loans'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Total loans from family:
                            </span><?php echo $details['family_loans'] ? "$" . number_format((float) $details['family_loans'], 2) : "";?>
                        </p>
                    </div>
                    <div
                        class="col-md-3 <?php echo (isset($details['misc_loans']) && !empty($details['misc_loans'])) ? '' : 'hide-data' ?>">
                        <p class=""><span class=" fw-bold">Misc. loans:
                            </span><?php echo $details['misc_loans'] ? "$" . number_format((float) $details['misc_loans'], 2) : "";?>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Have you made purchases in the last 3 months?: </span><?php echo Helper::key_display_reverse('made_purchases', $details);
    ; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Do you have a checking account at a bank that issued the
                                card?: </span><?php echo Helper::key_display_reverse('checking_account', $details); ?>
                        </p>
                    </div>
                    <?php if (!empty($concierge_questions)) { ?>
                    <!-- Concierge Questions -->
                    <div class="col-md-12 mt-3">
                        <h4>Additional Questions</h4>
                    </div>
                    <?php    foreach ($concierge_questions as $key => $value) { ?>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold"><?php        echo $value['question']; ?>:
                            </span><?php        echo Helper::key_display_reverse('value', $value); ?></p>
                    </div>
                    <?php    }
                    } ?>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Are you being sued:
                            </span><?php echo Helper::key_display_reverse('being_sued', $details); ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Are your wages currently being garnished:
                            </span><?php echo Helper::key_display_reverse('wages_being_garnished', $details); ?></p>
                    </div>
                    <div class="col-md-12">
                        <p class=""><span class=" fw-bold">Is there anything else you would like to share that would be
                                useful for us to know for our appointment:
                            </span><?php echo Helper::validate_key_value('extra_notes', $details); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 element-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="notesPopup">
                            <?php echo $notesForm ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>



    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>


</body>

</html>