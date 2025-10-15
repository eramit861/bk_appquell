<?php
use App\Models\IncomeDebtorMonthlyIncome;
use App\Models\IncomeDebtorSpouseMonthlyIncome;

?>
<form name="official_frm_122a-1" id="official_frm_122a_1" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="122a_1">
    <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b_122a_1.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b_122a_1.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('Case number1'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor1.Name'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2.Name'); ?>" value="<?php echo $spousename; ?>">
    <?php $mTest = isset($dynamicPdfData['122a_1']) && !empty($dynamicPdfData['122a_1']) ? json_decode($dynamicPdfData['122a_1'], 1) : null; ?>
            <section class="page-section official-form-109 padd-20" id="official-form-109">
            <div class="frm122a_1 container pl-2 pr-0">
                <div class="row">
                    <div class="frm122a_1 col-md-7">
                        <div class="section-box">
                            <div class="frm122a_1 section-header bg-back text-white">
                                <p class="frm122a_1 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                            </div>
                            <div class="frm122a_1 section-body padd-20">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="frm122a_1 input-group">
                                            <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                            <select name="<?php echo base64_encode('Bankruptcy District Information'); ?>" class="form-control frm122a_1 district-select" id="district_name"> @foreach ($district_names as $district_name)
                                                    <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>

                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-5 122a1-frm">
                        <div class="section-box second-section-box">
                            <div class="section-header bg-back text-white">
                                <p class="font-lg-20">{{ __('Check one box only as directed in this form and in Form 122A-1Supp:') }}</p>
                            </div>
                            <div class="section-body padd-20">
                                <div class="row">
                                    <div class="col-md-12 frm122a_1 ">
                                        <div class="input-group frm122a_1">
                                        <input name="<?php echo base64_encode('CheckBox1'); ?>" value="No Abuse" class="122a_check1" type="checkbox" <?php isset($mTest[base64_encode('CheckBox1')]) ? Helper::validate_key_toggle(base64_encode('CheckBox1'), $mTest, 'No Abuse') : ''?>>
                                            <label>{{ __('1. There is no presumption of abuse') }} </label>
                                                </div>
                                        <div class="input-group">
                                        <input name="<?php echo base64_encode('CheckBox1'); ?>" class="122a_check2" value="Presumption of abuse applies" type="checkbox" <?php isset($mTest[base64_encode('CheckBox1')]) ? Helper::validate_key_toggle(base64_encode('CheckBox1'), $mTest, 'Presumption of abuse applies') : ''?>>
                                            <label>{{ __('2. The calculation to determine if a presumption of abuse applies will be made under Chapter 7 Means Test Calculation (Official Form 122A–2).') }} </label>
                                            </div>
                                        <div class="input-group">
                                        <input name="<?php echo base64_encode('CheckBox1'); ?>" class="122a_check3" value="Does not apply" type="checkbox" <?php isset($mTest[base64_encode('CheckBox1')]) ? Helper::validate_key_toggle(base64_encode('CheckBox1'), $mTest, 'Does not apply') : ''?>>
                                            <label>{{ __('3. The Means Test does not apply now because of qualified military service but it could apply later') }}</label>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-7 mt-3"></div>
                    <div class="col-md-5 mt-3">
                    <div class="input-group">
                                <input type="checkbox" name="<?php echo base64_encode('CheckBox2'); ?>" value="" <?php isset($mTest[base64_encode('CheckBox2')]) ? Helper::validate_key_toggle(base64_encode('CheckBox2'), $mTest, '') : ''?>>
                                <label>{{ __('Check if this is an amended filing') }}</label>
                                </div>
                                </div>

                </div>
                <div class="row padd-20">
                    <div class="col-md-12 mb-3">
                        <div class="form-title">
                            <h4>{{ __('Official Form 122A─1') }} </h4>
                            <!-- <h4>{{ __('Official Form 122A─1') }} </h4> -->
                            <h2 class="font-lg-22">{{ __('Chapter 7 Statement of Your Current Monthly Income') }}
                            </h2> </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-subheading">
                            <div class="input-group"> <strong>
                                    {{ __('Be as complete and accurate as possible. If two married people are
                                    filing together, both are equally responsible for being accurate. If
                                    more
                                    space is needed, attach a separate sheet to this form. Include the
                                    line
                                    number to which the additional information applies. On the top of
                                    any
                                    additional pages, write your name and case number (if known). If you
                                    believe that you are exempted from a presumption of abuse because
                                    you
                                    do not have primarily consumer debts or because of qualifying
                                    military
                                    service, complete and file Statement of Exemption from Presumption
                                    of
                                    Abuse Under § 707(b)(2) (Official Form 122A-1Supp) with this form.') }}
                                </strong> </div>
                        </div>
                    </div>
                </div>
                <!-- Part 1 -->
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                            <h2 class="font-lg-18">{{ __('Calculate Your Current Monthly Income') }}</h2> </div>
                    </div>
                </div>
                <?php
                    $debtormonthlyincome = (!empty($income_info['debtormonthlyincome'])) ? $income_info['debtormonthlyincome'] : [];
$debtorspousemonthlyincome = (!empty($income_info['debtorspousemonthlyincome'])) ? $income_info['debtorspousemonthlyincome'] : [];
?>
                <!-- Row 1 -->
                <div class="form-border mb-3 pt-2">
                    <label for=""> <strong>{{ __('1. What is your marital and filing status?') }} </strong>{{ __('Check one only') }} </label>
                    <div class="input-group">
                        <input class="fi_marital_status_" <?php echo isset($mTest[base64_encode('CheckBox3')]) ? Helper::validate_key_toggle(base64_encode('CheckBox3'), $mTest, 'Not married') : Helper::validate_key_toggle('client_type', $clentData, Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED); ?> name="<?php echo base64_encode('CheckBox3'); ?>" value="Not married" type="checkbox">
                        <label for=""><strong>{{ __('Not married.') }}</strong> {{ __('Fill out Column A, lines 2-11') }}</label>
                    </div>
                    <div class="input-group">
                        <input class="fi_marital_status_" <?php echo isset($mTest[base64_encode('CheckBox3')]) ? Helper::validate_key_toggle(base64_encode('CheckBox3'), $mTest, 'Maried and filing') : Helper::validate_key_toggle('client_type', $clentData, Helper::CLIENT_TYPE_JOINT_MARRIED); ?> name="<?php echo base64_encode('CheckBox3'); ?>" value="Maried and filing" type="checkbox">
                        <label for=""><strong>{{ __('Married and your spouse is filing with you.') }}</strong> {{ __('Fill out both Columns A and B, lines 2-11.') }} </label>
                    </div>
                    <div class="input-group">
                        <input class="fi_marital_status_" <?php echo isset($mTest[base64_encode('CheckBox3')]) ? Helper::validate_key_toggle(base64_encode('CheckBox3'), $mTest, 'Married but not filing') : Helper::validate_key_toggle('client_type', $clentData, Helper::CLIENT_TYPE_INDIVIDUAL_MARRIED); ?> name="<?php echo base64_encode('CheckBox3'); ?>" value="Married but not filing" type="checkbox">
                        <label for=""><strong>{{ __('Married and your spouse is NOT filing with you. You and
                                your
                                spouse are:') }}</strong> </label>
                        <div class="pl-3">
                            <div class="input-group">
                                <input name="<?php echo base64_encode('CheckBox3A'); ?>" value="together" <?php echo isset($mTest[base64_encode('CheckBox3A')]) ? Helper::validate_key_toggle(base64_encode('CheckBox3A'), $mTest, 'together') : Helper::validate_key_toggle('spouse_different_address', $BasicInfoPartB, 0); ?>  type="checkbox">
                                <label for=""><strong>{{ __('Living in the same household and are not legally
                                        separated.') }}</strong> {{ __('Fill out both Columns A and B, lines 2-11.') }} </label>
                            </div>
                            
                            <div class="input-group">
                                <label class="hr_dotted">
                                    <input name="<?php echo base64_encode('CheckBox3A'); ?>" <?php echo isset($mTest[base64_encode('CheckBox3A')]) ? Helper::validate_key_toggle(base64_encode('CheckBox3A'), $mTest, 'separately') : Helper::validate_key_toggle('spouse_different_address', $BasicInfoPartB, 1); ?>  value="separately" type="checkbox" style="margin-right: 10px; align-self: flex-start;" >
                                    <p>
                                        <strong>
                                            {{ __('Living separately or are legally separated.') }}
                                        </strong>
                                            {{ __('Fill out Column A, lines 2-11; do not fill out Column B. By checking this box, you declare under penalty of perjury
                                        that you and your spouse are legally separated under nonbankruptcy law that applies or that you and your spouse are living 
                                        apart for reasons that do not include evading the Means Test requirements. 11 U.S.C. § 707(b)(7)(B).') }}
                                    <p>
                                </label>
                            </div>


                        </div>
                    </div>
                    <div class="input-group gray-box ">
                        <div class="column-heading">
                            <label for=""><strong>{{ __('Fill in the average monthly income that you received
                                    from
                                    all sources, derived during the 6 full months before you file this
                                    bankruptcy case.') }}</strong> {{ __('11 U.S.C. § 101(10A). For example, if you are filing on September 15, the 6-month period would be March 1 through August 31. If the amount of your monthly income varied during the 6 months, add the income for all 6 months and divide the total by 6. Fill in the result. Do not include any income amount more than once. For example, if both spouses own the same rental property, put the income from that property in one column only. If you have nothing to report for any line, write $0 in the space') }}</label>
                        </div>
                    </div>
                    <!-- Row 1 -->
                    <div class="row mb-3 mt-3">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 122a24">
                            <div class="row">
                                <div class="col-md-6 gray-box">
                                    <div class="column-heading">
                                        <h4>
                                            <i>{{ __('Column A') }}</i><br>
                                            {{ __('Debtor 1') }}
                                        </h4> 
                                    </div>
                                </div>
                                <div class="col-md-6 gray-box">
                                    <div class="column-heading">
                                        <h4>
                                            <i>{{ __('Column B') }}</i><br>
                                            {{ __('Debtor 2 or
                                            non-filing spouse') }}
                                        </h4> 
                                    </div>

                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <?php $debtorSum = 0;
$spouseSum = 0;
?>
                    <!-- Row 2 -->
                    <div class="row mt-3">
                        <div class="col-md-6 d-flex">
                            <label for=""> <strong>2.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                        {{ __('Your gross wages, salary, tips, bonuses, overtime, and
                                        commissions') }}
                                        </strong>
                                        {{ __('(before all payroll deductions).') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 122a27">
                            <div class="row fa2121">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = $debtor_gross1 = IncomeDebtorMonthlyIncome::debtorGrossWagesMonth($debtormonthlyincome); ?>
                                        <input  name="<?php echo base64_encode('Debto1.Quest2.0'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest2.0')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest2.0')]) : Helper::priceFormtWithComma($debt1); ?>" class="wages-price 122_line2_debtor pricetobesum price121a_1 price-field form-control mr-0 "> </div>
                                        <?php $debtorSum = $debtorSum + $debtor_gross1; ?>
                                    </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> 
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <?php $debt2 = $debtorspouse_gross1 = IncomeDebtorSpouseMonthlyIncome::debtorGrossWagesMonth($debtorspousemonthlyincome);?>
                                        <input  name="<?php echo base64_encode('Debto2.Quest2.0'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest2.0')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest2.0')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field pricetobesum2 122_line2_spouse price121a_1 form-control mr-0 "> </div>
                                        <?php $spouseSum = $spouseSum + $debtorspouse_gross1; ?>
                                    </div>
                            
                            </div>
                        </div>
                    </div>
                    <!-- Row 3 -->
                    <div class="row mt-3">
                        <div class="col-md-6 d-flex">
                            <label for=""> <strong>3.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                            {{ __('Alimony and maintenance payments.') }}
                                        </strong>
                                        {{ __('Do not include payments from a spouse if Column B is filled in.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 122a21">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = IncomeDebtorMonthlyIncome::regularContribution($debtormonthlyincome);?>
                                        <input name="<?php echo base64_encode('Debto1.Quest3'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest3')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest3')]) : Helper::priceFormtWithComma($debt1); ?>" class="price-field pricetobesum price121a_1 122a1_line3_debtor form-control mr-0"> </div>
                                        <?php  $debtorSum = $debtorSum + $debt1; ?>
                                    </div>
                                <div class="col-md-6 pl-0 pr-0 122a-1frm1 ">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt2 = IncomeDebtorSpouseMonthlyIncome::regularContribution($debtorspousemonthlyincome);?>
                                        <input name="<?php echo base64_encode('Debto2.Quest3'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest3')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest3')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field pricetobesum2 price121a_1 122a1_line3_spouse form-control mr-0"> </div>
                                        <?php $spouseSum = $spouseSum + $debt2;?>
                                        </div>
                            
                            </div>
                        </div>
                    </div>
                    <!-- Row 4 -->
                    <div class="row mt-3">
                        <div class="col-md-6 d-flex">
                            <label for=""> <strong>4.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> {{ __('All amounts from any source which are regularly paid for
                                            household expenses
                                            of you or your dependents, including child
                                            support') }}
                                        </strong>
                                        {{ __('Include regular contributions from an unmarried partner, 
                                        members of your household, your dependents, parents, and roommates. 
                                        Include regular contributions from a spouse only if Column B is not 
                                        filled in. Do not include payments you listed on line 3.') }} 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php $debtor_gross1 = IncomeDebtorMonthlyIncome::debtorGrossWagesMonth($debtormonthlyincome); ?>
                        <?php $debtor_gross2 = IncomeDebtorSpouseMonthlyIncome::debtorGrossWagesMonth($debtorspousemonthlyincome); ?>
                        <div class="col-md-6">
                            <div class="row 122a-1frm1">
                                <div class="col-md-6 122a-1frm1 pl-0 pr-0 ">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('Debto1.Quest4'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest4')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest4')]) : Helper::priceFormtWithComma($debtor_gross1); ?>" class="price-field pricetobesum price121a_1 122a1_line4_debtor form-control mr-0 mr-0"> </div>
                                        <?php $debtorSum = $debtorSum + $debtor_gross1; ?>
                                    </div>
                                <div class="col-md-6 pl-0 pr-0 ">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('Debto2.Quest2.2'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest2.2')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest2.2')]) : Helper::priceFormtWithComma($debtor_gross2); ?>" class="price-field pricetobesum2 price121a_1 122a1_line4_spouse form-control mr-0 mr-0"> </div>
                                        <?php $spouseSum = $spouseSum + $debtor_gross2; ?>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                <?php

$debtortotal6month = 0;
$debtoraverage = 0;
$debtorTotalOperatingExpense = 0;
$codebtorTotalOperatingExpense = 0;
$totalCoDebtorIncome = 0;
$totalDebtorIncome = 0;

if ($debtormonthlyincome['operation_business'] == 1 && is_array($debtormonthlyincome['income_profit_loss']) && count($debtormonthlyincome['income_profit_loss']) > 0) {
    $income_profit_loss = $debtormonthlyincome['income_profit_loss'];
    $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
    $debtorindex = 1;
    foreach ($income_profit_loss as $profit) {
        if ($debtorindex > 6) {
            continue;
        }
        if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
            $debtorTotalOperatingExpense = $debtorTotalOperatingExpense + $profit['total_expense'];
            $dates = explode("-", $profit['profit_loss_month']);
            $year = $dates[1] ?? '';
            $month = $dates[0] ?? '';
            $month_name = date("F", mktime(0, 0, 0, (int)$month, 10));
            $totalDebtorIncome = $totalDebtorIncome + ($profit['total_expense'] + Helper::validate_key_value('total_profit_loss', $profit, 'float'));
            $debtortotal6month = $debtortotal6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
        }
        $debtorindex++;
    }
}

$debtorExpenseaverage = $debtorTotalOperatingExpense > 0 ? number_format((float)($debtorTotalOperatingExpense / ($debtorindex - 1)), 2, '.', '') : 0.00;
$totalAvgdebtor = $totalDebtorIncome > 0 ? number_format((float)($totalDebtorIncome / ($debtorindex - 1)), 2, '.', '') : 0.00;
$debtoraverage = $debtortotal6month > 0 ? number_format((float)($debtortotal6month / ($debtorindex - 1)), 2, '.', '') : 0.00;
$spouseaverage = 0;
$totalSpouse6month = 0;
if (isset($debtorspousemonthlyincome['joints_operation_business']) && $debtorspousemonthlyincome['joints_operation_business'] == 1 && is_array($debtorspousemonthlyincome['income_profit_loss']) && count($debtorspousemonthlyincome['income_profit_loss']) > 0) {
    $income_profit_loss = $debtorspousemonthlyincome['income_profit_loss'];
    $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
    $spouseindex = 1;
    foreach ($income_profit_loss as $profit) {
        if ($i > 6) {
            continue;
        }
        if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
            $codebtorTotalOperatingExpense = $codebtorTotalOperatingExpense + $profit['total_expense'];
            $dates = explode("-", $profit['profit_loss_month']);
            $year = $dates[1] ?? '';
            $month = $dates[0] ?? '';
            $month_name = date("F", mktime(0, 0, 0, (int)$month, 10));
            $totalSpouse6month = $totalSpouse6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
            $totalCoDebtorIncome = $totalCoDebtorIncome + ($profit['total_expense'] + Helper::validate_key_value('total_profit_loss', $profit, 'float'));
        }
        $spouseindex++;
    }
}
$totalAvgCodebtor = $totalCoDebtorIncome > 0 ? number_format((float)($totalCoDebtorIncome / ($spouseindex - 1)), 2, '.', '') : 0.00;
$spouseExpenseaverage = $codebtorTotalOperatingExpense > 0 ? number_format((float)($codebtorTotalOperatingExpense / ($spouseindex - 1)), 2, '.', '') : 0.00;
$spouseaverage = $totalSpouse6month > 0 ? number_format((float)($totalSpouse6month / ($spouseindex - 1)), 2, '.', '') : 0.00;
?>
                    <!-- Row 5 -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2 d-flex">
                                    <label for=""> <strong>5.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12 pr">
                                            <p> 
                                                <strong> 
                                                {{ __('Net income from operating a business, profession,
                                                or farm') }}
                                                </strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 122a1-debtpr">
                                    <div class="row 122a1-debtpr">
                                        <div class="122a1-debtpr col-md-6 gray-box">
                                            <div class="122a1-debtpr column-heading"> <strong>{{ __('Debtor 1') }}</strong> </div>
                                        </div>
                                        <div class="122a1-debtpr col-md-6 gray-box">
                                            <div class="122a1-debtpr column-heading"> <strong>{{ __('Debtor 2') }}</strong> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 122a1-debtpr mt-2">
                            <div class="row 122a1-debtpr">
                                <div class="col-md-2 122a1-debtpr pr-0">
                                    <div class="input-group 122a1-debtpr pl-3">
                                        <label for="" class="d-block"> {{ __('Gross receipts (before all deductions)') }} </label>
                                    </div>
                                </div>
                                <?php
                $debtorGross = 0; //$mTest[base64_encode('Debto1.Quest5A')]??0;
if ($importIncome) {
    $debtorGross = Helper::validate_key_value_exclude_comma('debtor_income_avg', $meantestPData);
    if (Helper::validate_key_value('graduate', $meantestPData) == 1) {
        $debtorGross = Helper::validate_key_value_exclude_comma('debtor_biz_income_avg', $meantestPData, 'float', false);

    }
}

$debtorGross = $importIncome ? $debtorGross : $totalAvgdebtor;
?>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group f122a12 d-flex ">
                                                <div class="f122a12 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest5A'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($debtorGross); ?>" class="price-field price121a_1 income_gross form-control mr-0">
                                            </div>
                                        </div>
                                        <?php
        $spouseGross = 0; //$mTest[base64_encode('Debto2.Quest5A')]??null;
if ($importIncome) {
    $spouseGross = Helper::validate_key_value_exclude_comma('spouse_income_avg', $meantestPData);
    if (Helper::validate_key_value('graduate', $meantestPData) == 1) {
        $spouseGross = Helper::validate_key_value_exclude_comma('spouse_biz_income', $meantestPData, 'float', false);
    }
}
$spouseGross = $importIncome ? $spouseGross : $totalAvgCodebtor;
?>
                                        <div class="col-md-6 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group d-flex ">
                                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto2.Quest5A'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($spouseGross); ?>" class="price-field price121a_1 income_gross2 form-control mr-0">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12 mt-2">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="input-group pl-3">
                                        <label for="" class="d-block"> {{ __('Ordinary and necessary operating expenses') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group d-flex ">
                                            <?php
        $debtorexp = 0; //$mTest[base64_encode('Debto1.Quest5B')]??null;
if ($importIncome) {
    $debtorexp = Helper::validate_key_value_exclude_comma('debtor_expense_avg', $meantestPData);
    if (Helper::validate_key_value('graduate', $meantestPData) == 1) {
        $debtorexp = Helper::validate_key_value_exclude_comma('debtor_biz_expense_avg', $meantestPData);
    }
}
$debtorexp = $importIncome ? $debtorexp : $debtorExpenseaverage;
?>
                                                <div class="input-group-append pl-0"> <span class="input-group-text" id="basic-addon2">-$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest5B'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($debtorexp); ?>" class="price-field price121a_1 deduct_expense form-control mr-0"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group d-flex ">
                                            <?php
    $spouseexp = 0;  //$mTest[base64_encode('Debto2.Quest5B')]??null;
if ($importIncome) {
    $spouseexp = Helper::validate_key_value_exclude_comma('spouse_expense_avg', $meantestPData);
    if (Helper::validate_key_value('graduate', $meantestPData) == 1) {
        $spouseexp = Helper::validate_key_value_exclude_comma('spouse_biz_expense', $meantestPData);
    }
}
$spouseexp = $importIncome ? $spouseexp : $spouseExpenseaverage;
?>
                                                <div class="input-group-append pl-0"> <span class="input-group-text" id="basic-addon2">-$</span> </div>
                                                <input name="<?php echo base64_encode('Debto2.Quest5B'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($spouseexp); ?>" class="price-field price121a_1 deduct_expense2 form-control mr-0"> 
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group pl-3">
                                        <label for="" class="d-block"> {{ __('Net monthly income from a business, profession, or farm') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="f1221a1 col-md-6 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group f1221a1 d-flex ">
                                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest5C.1'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest5C.1')]) : Helper::priceFormtWithComma($debtoraverage); ?>" class="price-field price121a_1 netincome_after_deduction form-control mr-0"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group d-flex ">
                                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto2.Quest5C.2'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest5C.2')]) : Helper::priceFormtWithComma($spouseaverage); ?>" class="price-field price121a_1 netincome_after_deduction2 form-control mr-0"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="row">
                                <div class="col-md-8 mr-0 ml-0 pl-0 pr-0">
                                    <div class="row p-0 m-0">
                                        <div class="col-md-5">
                                            <div class="input-group d-flex ">
                                                <div class="input-group-append"> <label for="">&nbsp;{{ __('Copy') }}&nbsp;{{ __('Here') }}</label><span class="input-group-text" id="basic-addon2"><i class='fas fa-arrow-right' style="padding-right: 0px;"></i>&nbsp;</span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 pl-0">
                                            <div class="input-group d-flex ">
                                                <div class="input-group-append"><span class="input-group-text ml-0" id="basic-addon2">&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest5C.3'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest5C.3')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest5C.3')]) : Helper::priceFormtWithComma($debtoraverage); ?>" class="price-field pricetobesum price121a_1 copy_from5 form-control mr-0"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $debtorSum = (float)$debtorSum + (float)$debtoraverage; ?>
                                <div class="col-md-4 mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('Debto2.Quest5C.4'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest5C.4')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest5C.4')]) : Helper::priceFormtWithComma($spouseaverage); ?>" class="price-field pricetobesum2 price121a_1 copy_from5_2 form-control mr-0"> </div>
                                </div>
                                <?php $spouseSum = (float)$spouseSum + (float)$spouseaverage; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Row 6 -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2 d-flex">
                                    <label for=""> <strong>6.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12 pr">
                                            <p> 
                                                <strong> 
                                                    {{ __('Net income from rental and other real
                                                property') }}
                                                </strong>
                                                
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 122a1-debtpr2">
                                    <div class="row 122a1-debtpr2">
                                        <div class="col-md-6 122a1-debtpr2 gray-box">
                                            <div class="column-heading 122a1-debtpr2"> <strong>{{ __('Debtor 1') }}</strong> </div>
                                        </div>
                                        <div class="col-md-6 122a1-debtpr2 gray-box">
                                            <div class="122a1-debtpr2 column-heading"> <strong>{{ __('Debtor 2') }}</strong> </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="col-md-12 mt-2 122a1-debtpr2">
                            <div class="row 122a1-debtpr2">
                                <div class="col-md-2 pr-0 122a1-debtpr2">
                                    <div class="input-group pl-3">
                                        <label for="" class="d-block"> {{ __('122a1-debtpr2 Gross receipts (before all deductions)') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-4 122a1-debtpr2">
                                    <div class="row">
                                        <div class="col-md-6 122a1-debtpr2 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group 122a1-debtpr2 d-flex ">
                                                <div class="122a1-debtpr2 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest6A'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest6A')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest6A')]) : Helper::priceFormtWithComma($debtor_gross1 = IncomeDebtorMonthlyIncome::getPropertyIncome($debtormonthlyincome)); ?>" class="price-field price121a_1 property_income_gross form-control mr-0"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 122a1-debtpr2 mr-0 ml-0 pl-0 pr-0">
                                            <div class="input-group 122a1-debtpr2 d-flex ">
                                                <div class="122a1-debtpr2 input-group-append"> <span class="input-group-text 122a1-debtpr2" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto2.Quest6A'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest6A')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest6A')]) : Helper::priceFormtWithComma($debtorspouse_gross1 = IncomeDebtorSpouseMonthlyIncome::getPropertyIncome($debtorspousemonthlyincome)); ?>" class="price-field price121a_1 property_income_gross2 form-control mr-0"> 
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12 mt-2 122a1-debtpr3">
                            <div class="row 122a1-debtpr3">
                                <div class="col-md-2 122a1-debtpr4">
                                    <div class="input-group pl-3">
                                        <label for="" class="d-block"> {{ __('Ordinary and necessary operating expenses') }} </label>
                                    </div>
                                </div>                                                
                                <div class="col-md-4 122a1-debtpr4">
                                    <div class="122a1-debtpr4 row">
                                        <div class="col-md-6 122a1-debtpr4 mr-0 ml-0 pl-0 pr-0">
                                            <div class="122a1-debtpr4 input-group d-flex ">
                                                <div class="input-group-append pl-0"> <span class="input-group-text" id="basic-addon2">-$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest6B'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest6B')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest6B')]) : Helper::priceFormtWithComma(''); ?>" class="price-field price121a_1 property_deduct_expense form-control mr-0">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mr-0 ml-0 122a1-debtpr5 pl-0 pr-0">
                                            <div class="input-group 122a1-debtpr5  d-flex ">
                                                <div class="122a1-debtpr5  input-group-append pl-0"> <span class="input-group-text" id="basic-addon2">-$</span> </div>
                                                <input name="<?php echo base64_encode('Debto2.Quest6B'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest6B')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest6B')]) : Helper::priceFormtWithComma(''); ?>" class="price-field price121a_1 property_deduct_expense2 form-control mr-0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mt-2 122a1-debtpr5 ">
                            <div class="122a1-debtpr5 row">
                                <div class="col-md-4 122a1-debtpr5 ">
                                    <div class="input-group 122a1-debtpr5 pl-3">
                                        <label for="" class="122a1-debtpr5 d-block"> {{ __('Net monthly income from a business, profession, or farm') }} </label>
                                    </div>
                                </div>
                                <div class="122a1-debtpr5 col-md-8">
                                    <div class="row 122a1-debtpr5 ">
                                        <div class="col-md-6 mr-0 ml-0 122a1-debtpr5 pl-0 pr-0">
                                            <div class="input-group d-flex 122a1-debtpr5 ">
                                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest6C.1'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest6C.1')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest6C.1')]) : Helper::priceFormtWithComma($debtor_gross1 = IncomeDebtorMonthlyIncome::debtorGrossWagesMonth($debtormonthlyincome)); ?>" class="price-field price121a_1 property_netincome_after_deduction form-control mr-0"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 mr-0 122a1-debtpr5  ml-0 pl-0 pr-0">
                                            <div class="input-group d-flex ">
                                                <div class="input-group-append 122a1-debtpr5 "> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('Debto2.Quest6C.2'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest6C.2')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest6C.2')]) : Helper::priceFormtWithComma($debtorspouse_gross1 = IncomeDebtorSpouseMonthlyIncome::debtorGrossWagesMonth($debtorspousemonthlyincome)); ?>" class="price-field price121a_1 property_netincome_after_deduction2 form-control mr-0"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="122a1-debtpr6 row">
                                <div class="col-md-8  mr-0 ml-0 pl-0 pr-0">
                                    <div class="122a1-debtpr6  row p-0 m-0">
                                        <div class="col-md-5">
                                            <div class="122a1-debtpr6  input-group d-flex ">
                                                <div class="input-group-append"> <label for="">&nbsp;{{ __('Copy') }}&nbsp;{{ __('Here') }}</label><span class="input-group-text" id="basic-addon2"><i class='fas fa-arrow-right' style="padding-right: 0px;"></i>&nbsp;</span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7 122a1-debtpr6 pl-0">
                                            <div class="input-group 122a1-debtpr6 d-flex ">
                                                <div class="input-group-append 122a1-debtpr6 "><span class="input-group-text ml-0" id="basic-addon2">&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('Debto1.Quest6C.3'); ?>" type="text" value="" class="price-field pricetobesum price121a_1 property_copy_from5 form-control mr-0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $debtorSum = $debtorSum + $debtoraverage; ?>
                                <div class="col-md-4  mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('Debto2.Quest6C.4'); ?>" type="text" value="" class="price-field pricetobesum2 price121a_1 property_copy_from5_2 form-control mr-0"> </div>
                                </div>
                                <?php $spouseSum = $spouseSum + $spouseaverage; ?>
                            </div>
                        </div>
                    </div>
                    <!-- Row 7 -->
                    <div class="row mt-3">
                        <div class="col-md-6 122a1-debtpr7 d-flex">
                            <label for=""> <strong>7.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                        {{ __('Interest, dividends, and royalties') }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 122a22">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = IncomeDebtorMonthlyIncome::getInterestDividends($debtormonthlyincome); //Helper::priceFormtWithComma((!empty($debtormonthlyincome['royalties_month'])) ? array_sum($debtormonthlyincome['royalties_month']) : 0.00);?>
                                        <input name="<?php echo base64_encode('Debto1.Quest7'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest7')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest7')]) : Helper::priceFormtWithComma($debt1); ?>" class="price-field pricetobesum price121a_1 form-control mr-0"> </div>
                                        <?php $debtorSum = $debtorSum + $debt1; ?>
                                    </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt2 = IncomeDebtorSpouseMonthlyIncome::getInterestDividends($debtorspousemonthlyincome);?>
                                        <input name="<?php echo base64_encode('Debto2.Quest7'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest7')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest7')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field pricetobesum2 price121a_1 form-control mr-0"> </div>
                                        <?php
                                        $spouseSum = $spouseSum + $debt2; ?>
                                    </div>
                            </div>
                        </div>
                    </div>            
                    <!-- Row 8 -->
                    <div class="row mt-3 122a1-debtpr7 ">
                        <div class="col-md-6 122a1-debtpr7 d-flex">
                            <label for=""> <strong>8.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                        {{ __('Unemployment compensation') }}
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 122a1-debtpr8">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class=" 122a1-debtpr8 input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = IncomeDebtorMonthlyIncome::unemploymentCompensation($debtormonthlyincome); ?>
                                        <input name="<?php echo base64_encode('Debto1.Quest8.0'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest8.0')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest8.0')]) : Helper::priceFormtWithComma($debt1); ?>" class="price-field pricetobesum price121a_1 form-control mr-0"> </div>
                                        <?php $debtorSum = $debtorSum + $debt1; ?>
                                    </div>
                                <div class=" 122a1-debtpr8 col-md-6 pl-0 pr-0">
                                    <div class=" 122a1-debtpr8 input-group d-flex ">
                                        <div class="input-group-append  122a1-debtpr8"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php
                                        $debt2 = IncomeDebtorSpouseMonthlyIncome::unemploymentCompensation($debtorspousemonthlyincome); ?>
                                        <input
                                            name="<?php echo base64_encode('Debto2.Quest8.0'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest8.0')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest8.0')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field pricetobesum2 price121a_1 form-control mr-0"> </div>
                                        <?php
                                        $spouseSum = $spouseSum + $debt2;
?>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex">
                            <div class="row pl-3">
                                <div class="col-md-12">
                                    <p> 
                                        Do not enter the amount if you contend that the amount received was a benefit under the Social Security Act. Instead, list it here:
                                        <?php echo $nbsp_10;
echo $nbsp_10;
echo $nbsp_10; ?><i class='fas fa-arrow-down'></i>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>

                        <div class="col-md-4">
                            <div class="input-group  122a1-debtpr9 horizontal_dotted_line">
                                <label class="pl-3">{{ __('For you') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding-right: 0px; padding-left: 0px;">
                            <div class="input-group 122a1-debtpr9 d-flex ">
                                <div class="input-group-append 122a1-debtpr9"> 
                                    <span class="input-group-text" id="basic-addon2">$</span> 
                                </div>
                                <input  name="<?php echo base64_encode('Debto1.Quest8A'); ?>" type="text"  value="<?php echo isset($mTest[base64_encode('Debto1.Quest8A')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest8A')]) : Helper::priceFormtWithComma(''); ?>" class="price-field pricetobesum price121a_1 w120 form-control">
                            </div>
                        </div>
                        <div class="col-md-6 122a1-debtpr9"></div>

                        <div class="col-md-4 mt-2 122a1-debtpr9">
                            <div class="input-group horizontal_dotted_line">
                                <label class="pl-3">{{ __('For your spouse') }}</label>
                            </div>
                        </div>

                        <div class="col-md-2 mt-2 122a1-debtpr9" style="padding-right: 0px; padding-left: 0px;">
                            <div class="input-group 122a1-debtpr9 d-flex ">
                                <div class="input-group-append">
                                    <span class="122a1-debtpr9 input-group-text" id="basic-addon2">$</span> 
                                </div>
                                <input name="<?php echo base64_encode('Debto2.Quest8A'); ?>" type="text"  value="<?php echo isset($mTest[base64_encode('Debto2.Quest8A')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest8A')]) : Helper::priceFormtWithComma(''); ?>" class="price-field pricetobesum2 price121a_1 w120 form-control"> 
                            </div>
                        </div>
                        <div class="col-md-6 mt-2"></div>
                    </div>

                    <!-- Row 9 -->
                    <div class="row mt-3 122a1-debtpr9">
                        <div class="col-md-6 d-flex">
                            <label for=""> <strong>9.</strong></label>
                            <div class="row pl-1 122a1-debtpr10">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                        {{ __('Pension or retirement income.') }}
                                        </strong>
                                        {{ __('Do not include any amount received that was a benefit under the Social Security Act.
                                        Also, except as stated in the next sentence, do not include any compensation, pension,
                                        pay, annuity, or allowance paid by the United States Government in connection with a 
                                        disability, combat-related injury or disability, or death of a member of the uniformed
                                        services. If you received any retired pay paid under chapter 61 of title 10, 
                                        then include that pay only to the extent that it does not exceed the amount
                                        of retired pay to which you would otherwise be entitled if retired under any 
                                        provision of title 10 other than chapter 61 of that title.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row 122a-1frm2">
                                <div class="col-md-6 pl-0 122a-1frm2 pr-0 ">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome);?>
                                        <input name="<?php echo base64_encode('Debto1.Quest9'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest9')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest9')]) : Helper::priceFormtWithComma($debt1); ?>" class="price-field pricetobesum price121a_1 form-control mr-0"> </div>
                                </div>
                                <?php $debtorSum = $debtorSum + $debt1; ?>
                                <div class="col-md-6 pl-0 pr-0 ">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt2 = IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome);?>
                                        <input name="<?php echo base64_encode('Debto2.Quest9'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest9')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest9')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field pricetobesum2 price121a_1 form-control mr-0"> </div>
                                </div>
                                <?php $spouseSum = $spouseSum + $debt2;?>
                            </div>
                        </div>
                    </div>   

                    <!-- Row 10 -->
                    <div class="row mt-3">
                        <div class="col-md-6 d-flex">
                            <label for=""> <strong>10.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                            {{ __('Income from all other sources not listed above') }}
                                        </strong>
                                        {{ __('Specify the source and amount.
                                        Do not include any benefits received under the Social Security Act; payments received
                                        as a victim of a war crime, a crime against humanity, or international or domestic
                                        terrorism; or compensation, pension, pay, annuity, or allowance paid by the United
                                        States Government in connection with a disability, combat-related injury or disability, or
                                        death of a member of the uniformed services. If necessary, list other sources on a
                                        separate page and put the total below.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                    </div>   
                    <?php

                    $osIncome = IncomeDebtorMonthlyIncome::otherSourcesName($debtormonthlyincome);
$osIncome2 = IncomeDebtorSpouseMonthlyIncome::otherSourcesSpecify($debtorspousemonthlyincome);
$finalText = $osIncome . $osIncome2;
if (!empty($osIncome) && !empty($osIncome)) {
    $finalText = $osIncome . ', ' . $osIncome2;
}
?>
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="row">
                                <div class=" col-md-8" style="padding-left: 2rem !important;">
                                    <div class=" input-group">
                                        <input  name="<?php echo base64_encode('terrorism If necessary list other sources on a separate page and put the total below 1'); ?>" type="text" value="<?php echo $mTest[base64_encode('terrorism If necessary list other sources on a separate page and put the total below 1')] ?? $finalText; ?>" class="form-control"> 
                                    </div>
                                </div>

                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <div class="col-md-6 122a23">
                            <div class="row">
                                <div class="col-md-6  mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome);?>
                                        <input  name="<?php echo base64_encode('Debto1.Quest10A'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest10A')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest10A')]) : Helper::priceFormtWithComma($debt1); ?>" class="price-field other_source_pages1 price121a_1 form-control mr-0 "> </div>
                                </div>
                                <?php
            $debtorSum = $debtorSum + $debt1;?>
                                <div class="col-md-6  mr-0 ml-0 pl-0 pr-0 122a-1frm2">
                                    <div class="input-group d-flex 122a-1frm2">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php
                    $debt2 = IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome);?>
                                        <input  name="<?php echo base64_encode('Debto2.Quest10A'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest10A')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest10A')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field other_source_pages2 price121a_1 form-control mr-0"> </div>
                                </div>
                                <?php $spouseSum = $spouseSum + $debt2; ?>
                            </div>
                        </div>
                        <?php

    $gvIncome = IncomeDebtorMonthlyIncome::governmentAssictantSpecify($debtormonthlyincome);
$gvIncome2 = IncomeDebtorSpouseMonthlyIncome::governmentAssictantSpecify($debtorspousemonthlyincome);
$finalgvText = $gvIncome . $gvIncome2;
if (!empty($gvIncome) && !empty($gvIncome2)) {
    $finalgvText = $gvIncome . ', ' . $gvIncome2;
}
?>
                        <div class="col-md-6 mt-2">
                            <div class="row">
                                <div class="col-md-8" style="padding-left: 2rem !important;">
                                    <div class="input-group">
                                        <input  name="<?php echo base64_encode('terrorism If necessary list other sources on a separate page and put the total below 2'); ?>" type="text" value="<?php echo $mTest[base64_encode('terrorism If necessary list other sources on a separate page and put the total below 2')] ?? $finalgvText; ?>" class="form-control"> 
                                    </div>

                                </div>

                                <div class="col-md-4"></div>
                            </div>

                        </div>
                        <div class="col-md-6 f122a21 mt-2">
                            <div class="row">
                                <div class="f122a21 col-md-6  mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt1 = IncomeDebtorMonthlyIncome::governmentAssictant($debtormonthlyincome); ?>
                                        <input  name="<?php echo base64_encode('Debto1.Quest10B'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest10B')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest10B')]) : Helper::priceFormtWithComma($debt1); ?>" class="price-field other_pages1 price121a_1 form-control mr-0"> </div>
                                </div>
                                <?php $debtorSum = $debtorSum + $debt1;?>
                                <div class="col-md-6  mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <?php $debt2 = IncomeDebtorSpouseMonthlyIncome::governmentAssictant($debtorspousemonthlyincome); ?>
                                        <input  name="<?php echo base64_encode('Debto2.Quest10B'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest10B')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest10B')]) : Helper::priceFormtWithComma($debt2); ?>" class="price-field other_pages2 price121a_1 form-control mr-0"> </div>
                                </div>
                                <?php $spouseSum = $spouseSum + $debt2; ?>
                            </div>
                        </div>

                        <div class="col-md-6 mt-2">
                            <div class="row">
                                <div class="col-md-8" style="padding-left: 2rem !important;">
                                    <div class="input-group">
                                        <p>{{ __('Total amounts from separate pages, if any.') }} </p>
                                    </div>

                                </div>

                                <div class="col-md-4"></div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2">
                            <div class="row fa2121">
                                <div class="col-md-6  fa2121 mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text ml-0" id="basic-addon2">+$</span> </div>
                                        <input  name="<?php echo base64_encode('Debto1.Quest10C'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest10C')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest10C')]) : Helper::priceFormtWithComma(''); ?>" class="price-field pricetobesum total_from_pages1 price121a_1 form-control mr-0"> </div>
                                </div>
                                <div class="col-md-6  mr-0 ml-0 pl-0 pr-0">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text ml-0" id="basic-addon2">+$</span> </div>
                                        <input  name="<?php echo base64_encode('Debto2.Quest10C'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest10C')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest10C')]) : Helper::priceFormtWithComma(''); ?>" class="price-field pricetobesum2 total_from_pages2 price121a_1 form-control mr-0"> </div>
                                </div>
                            
                            </div>
                        </div>

                    </div>
                    <!-- Row 11 -->

                    <div class="row mt-3">
                        <div class="col-md-5 d-flex">
                            <label for=""> <strong>11.</strong></label>
                            <div class="row pl-1">
                                <div class="col-md-12">
                                    <p> 
                                        <strong> 
                                        {{ __('Calculate your total current monthly income.') }}
                                        </strong>
                                        {{ __('Add lines 2 through 10 for each
                                        column. Then add the total for Column A to the total for Column B.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="row 122a-1frm3">
                                <div class="col-md-4 122a-1frm3 pl-0 pr-0 ">
                                    <div class="input-group d-flex b-dotted" style="padding-block: 5px; padding-left: 2px; padding-right: 5px; padding-bottom: 9px;">
                                        <div class="input-group-append p-1"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('Debto1.Quest11'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto1.Quest11')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto1.Quest11')]) : Helper::priceFormtWithComma($debtorSum); ?>" class="price-field fi_line11_debtor pricetobesum_total form-control mr-0 p-1"> </div>
                                </div>
                                <div class="col-md-4 pl-1 pr-0 ">
                                    <div class="input-group d-flex b-dotted" style="padding-block: 5px; padding-left: 2px; padding-right: 5px;">
                                        <div class="input-group-append pl-0"> <span class="input-group-text" id="basic-addon2">+$</span> </div>
                                        <input name="<?php echo base64_encode('Debto2.Quest11'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Debto2.Quest11')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Debto2.Quest11')]) : Helper::priceFormtWithComma($spouseSum); ?>" class="price-field fi_line11_spouse  pricetobesum2_total form-control mr-0"> </div>
                                </div>
                                <div class="col-md-4 pl-1 pr-2 ">
                                    <div class="input-group d-flex border_2px" style="padding-block: 5px; padding-left: 2px; padding-right: 5px;">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">=$</span> </div>
                                        <input name="<?php echo base64_encode('Quest11'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Quest11')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Quest11')]) : Helper::priceFormtWithComma($debtorSum + $spouseSum); ?>" class="price-field total_income_122a1 form-control mr-0">
                                    </div>
                                    <p style="padding-left: 1.5rem !important;" for="">{{ __('Total current monthly income') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <!-- Part 2 -->
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                            <h2 class="font-lg-18">{{ __('Determine Whether the Means Test Applies to You') }}</h2> </div>
                    </div>
                </div>
                <!-- Row 1 -->
                <div class="form-border mb-3">
                    <!-- Row 12 -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for=""> <strong>{{ __('12. Calculate your current monthly income for the year.') }}
                                </strong>{{ __('Follow these steps:') }} </label>
                        </div>
                        <div class="col-md-10 mt-2">
                            <div class="row pl-3">
                                <div class="col-md-10">
                                    <div class="input-group horizontal_dotted_line">
                                        <label for="">{{ __('12a. Copy your total current monthly income from line 11') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="">Copy line 11 here <i class='fas fa-arrow-right'></i></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 pl-0 pr-1">
                            <div class="row">
                                <div class="col-md-12 122fa21">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('Quest11'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('Quest11')]) ? Helper::priceFormtWithComma($mTest[base64_encode('Quest11')]) : Helper::priceFormtWithComma($debtorSum + $spouseSum); ?>" class="price-field fi_current_monthly_expense copyfromline11 form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row pl-3">
                        <div class="col-md-10 mt-2">
                            <div class="input-group">
                                <label for="">{{ __('Multiply by 12 (the number of months in a year).') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2 f122a1 mt-2 pl-0 pr-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> 
                                            <span class="input-group-text" id="basic-addon2">X<?php echo $nbsp_10; ?> 12</span> 
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 pl-0 pr-0">
                            <div class="input-group d-flex ">
                                        
                            </div>
                        </div>
                    </div>
                    <div class="row pl-3">
                        <div class="col-md-10 mt-2 ">
                            <div class="input-group">
                                <label for="">{{ __('12b. The result is your annual income for this part of the form.') }} </label>
                            </div>
                        </div>
                        <div class="col-md-2 f122a2 mt-2 pl-0 pr-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group d-flex ">
                                        <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('12B'); ?>" type="text" value="<?php echo isset($mTest[base64_encode('12B')]) ? Helper::priceFormtWithComma($mTest[base64_encode('12B')]) : Helper::priceFormtWithComma(($debtorSum + $spouseSum) * 12); ?>" class="price-field annual_income12_b form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row 13 -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for=""> <strong>{{ __('13. Calculate the median family income that applies to you.') }}
                                </strong> {{ __('Follow these steps:') }} </label>
                        </div>
                        <div class="col-md-10 mt-2">
                            <div class="row mb-3 pl-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="">{{ __('Fill in the state in which you live.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 pl-0 pr-0">
                                    <input name="<?php echo base64_encode('13A'); ?>" type="text" value="<?php echo $mTest[base64_encode('13A')] ?? $stateOfHouseHold; ?>" class="form-control"> 
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                            <div class="row mb-3 pl-3">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <label for="">{{ __('Fill in the number of people in your household.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 pl-0 pr-0">
                                    <input  name="<?php echo base64_encode('13B'); ?>" type="text" value="<?php echo Helper::validate_key_value('household_size', $savedData); ?>" class="fi_line13_no_of_people form-control">
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row pl-3">
                                <div class="col-md-9">
                                    <div class="input-group horizontal_dotted_line">
                                        <label for="">{{ __('Fill in the median family income for your state and size of household') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-3 pl-0 pr-1">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-group d-flex border_2px p-1 ">
                                                <div class="input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input  name="<?php echo base64_encode('13C'); ?>" type="text" value="<?php echo Helper::validate_key_value('medianFamilyIncome', $meansTestCalculation, 'comma'); ?>" class="price-field fi_line13_median_family_income median_family_income form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pl-0 pr-0">
                                    <div class="row">
                                        <div class="col-md-9">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="row pl-3">
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <label for=""> {{ __('To find a list of applicable median income amounts, go online using the link specified in the separate instructions for this form. This list may also be available at the bankruptcy clerk’s office.') }} </label>
                                    </div>
                                </div>

                                <div class="col-md-3"></div>
                            </div>
                        </div>

                    </div>
                    <!-- Row 14 -->
                    <div class="row">
                        <div class="col-md-12">
                            <label for=""> <strong>{{ __('14. How do the lines compare?') }}
                                </strong> </label>
                        </div>
                        <div class="col-md-12">
                            <div class="pl-3">
                                <div class="input-group mt-2">
                                    <label class="hr_dotted">
                                        <label for="">{{ __('14a.') }}</label>
                                        <input style="align-self: flex-start;" name="<?php echo base64_encode('14a'); ?>" value="12b less or equal to 13" type="checkbox" <?php echo isset($mTest[base64_encode('14a')]) ? Helper::validate_key_toggle(base64_encode('14a'), $mTest, '12b less or equal to 13') : '';?>>
                                        <p>
                                            {{ __('Line 12b is less than or equal to line 13. On the top of page 1, check box 1, There is no presumption of abuse.
                                            Go to Part 3. Do NOT fill out or file Official Form 122A-2') }} 
                                        <p>
                                    </label>
                                </div>
                                <div class="input-group">
                                    <label class="hr_dotted">
                                        <label for="">{{ __('14b.') }}</label>
                                        <input style="align-self: flex-start;" name="<?php echo base64_encode('14a'); ?>" value="12b more than 13" type="checkbox" <?php echo isset($mTest[base64_encode('14a')]) ? Helper::validate_key_toggle(base64_encode('14a'), $mTest, '12b more than 13') : '';?>>
                                        <p>
                                        {{ __('Line 12b is more than line 13. On the top of page 1, check box 2, The presumption of abuse is determined 
                                            by Form 122A-2. Go to Part 3 and fill out Form 122A-2') }}  
                                        <p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Part 3 -->
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
                            <h2 class="font-lg-18">{{ __('Sign Below') }}</h2> </div>
                    </div>
                </div>
                <!-- Row 1 -->
                <div class="122fa21 form-border">
                    <div class="row">
                        <div class="col-md-12 122fa21">
                            <div class="input-group 122fa21 d-inline-block">
                                <label for=""> <strong class="d-block">{{ __('By signing here, I declare under penalty of
                                        perjury that the information on this statement and in any
                                        attachments is true and correct.') }}
                                    </strong> </label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group ">
                                        <p>{{ __('Signature of Debtor 1') }}</p> <span> <input name="<?php echo base64_encode('Debtor1.sig'); ?>"  type="text" value="<?php echo $debtor_sign;?>" class="form-control"></span></div>
                                    <div class="input-group mt-2">
                                        <label>{{ __('Date') }}</label>
                                        <input  name="<?php echo base64_encode('Debtor1.Date signed'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $mTest[base64_encode('Debtor1.Date signed')] ?? $currentDate;?>" class="date_filed form-control"> </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <p>{{ __('Signature of Debtor 2') }}</p> <span> <input name="<?php echo base64_encode('Debtor2.sig'); ?>"  type="text" value="<?php echo $debtor2_sign; ?>" class="form-control"></span> </div>
                                    <div class="input-group mt-2">
                                        <label>{{ __('Date') }}</label>
                                        <input  name="<?php echo base64_encode('Debtor2.Date signed'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $mTest[base64_encode('Debtor2.Date signed')] ?? $currentDate; ?>" class="date_filed form-control"> </div>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="input-group mt-2">
                                        <label for="">{{ __('If you checked line 14a, do NOT fill out or file Form 122A-2.') }}</label>
                                    </div>
                                    <div class="input-group mt-2">
                                        <label for="">{{ __('If you checked line 14b, fill out Form 122A-2 and file it with this form.') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <x-officialForm.generatePdfButton title="Generate Means Test (Statement of Income) 122A-1 PDF" divtitle="coles_official-form-109"></x-officialForm.generatePdfButton>

        </section>
</form>
