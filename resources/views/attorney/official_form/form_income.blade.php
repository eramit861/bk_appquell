<?php
use App\Models\IncomeDebtorMonthlyIncome;
use App\Models\IncomeDebtorSpouseMonthlyIncome;

$isDWagesOn = Helper::validate_key_value('debtor_gross_wages', $debtormonthlyincome);
$isWagesOn = Helper::validate_key_value('joints_debtor_gross_wages', $debtorspousemonthlyincome);
?>
<section class="page-section official-form-106i padd-20" id="official-form-106i">
    <div class="container pl-2 pr-0">
        <form name="official_frm_106i" class="official_106i_form_first save_official_forms" id="official_frm_106i" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <input type="hidden" name="form_id" value="106i">
            <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
            <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106i.pdf'; ?>">
            <input type="hidden" name="clientPDFName" value="<?php echo $client_id . '_b106i.pdf'; ?>">
            <input type="hidden" name="<?php echo base64_encode('Case number#0-106I'); ?>" value="<?php echo $caseno; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 1#0-106I'); ?>" value="<?php echo $onlyDebtor; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 2-106I'); ?>" value="<?php echo $spousename; ?>">
            <!-- use below varibale for PArt D -->
            <?php $partIMain = isset($dynamicPdfData['106i']) && !empty($dynamicPdfData['106i']) ? json_decode($dynamicPdfData['106i'], 1) : null;
?>
            <div class="row">
                <x-officialForm.districList :districtNames="$district_names" :savedData="$savedData" name="Bankruptcy District Information-106I"></x-officialForm.districList>
                <x-officialForm.districListAfterCheckBox :partMain="$partIMain" checkBoxName="Check 1#0-106I" dateBoxName="Supplemental income date-106I" dateBoxValueName="4"></x-officialForm.districListAfterCheckBox>
            </div>
            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Schedule I') }}</h4>
                        <!-- <h4>{{ __('Official Form 106I') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Schedule I: Your Income') }} 
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14"><strong>{{ __('Be as complete and accurate as possible. If
                                two
                                married people are filing together (Debtor 1 and Debtor 2), both are
                                equally responsible for
                                supplying correct information. If you are married and not filing
                                jointly, and your spouse is living with you, include information
                                about
                                your spouse.
                                If you are separated and your spouse is not filing with you, do not
                                include information about your spouse. If more space is needed,
                                attach a
                                separate sheet to this form. On the top of any additional pages,
                                write
                                your name and case number (if known). Answer every question.') }}
                            </strong></p>
                    </div>
                </div>
            </div>
            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('Describe Employment') }}</h2>
                    </div>
                </div>
            </div>

            <?php
$debtorspouseemployer = (!empty($income_info['debtorspouseemployer'])) ? $income_info['debtorspouseemployer'] : [];
$incomedebtoremployer = (!empty($income_info['incomedebtoremployer'])) ? $income_info['incomedebtoremployer'] : [];

$onejob = Helper::validate_key_value('current_employed', $incomedebtoremployer);
$secondjob = Helper::validate_key_value('current_employed', $debtorspouseemployer);

$incomedebtoremployer = $onejob == 1 ? $incomedebtoremployer : [];
$debtorspouseemployer = $secondjob == 1 ? $debtorspouseemployer : [];
?>
            <div class="form-border mb-3">
                <!-- Row 1 -->
                <div class="row">
                    <div class="col-md-6 pr-0 pb-2">
                        <div class="row mb-1">
                            <div class="col-md-12 column-heading align--center"><strong>{{ __('Debtor 1') }}</strong></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-12">
                               <!--  <strong>{{ __('Employment Status:') }}</strong> -->

                                  <x-stronglabel label="{{ __('Employment Status:')}}"></x-stronglabel>


                            </div>
                            <div class="col-md-3 mt-2"></div>
                            <div class="col-md-9 mt-2">
                                <div class="input-group mb-3">
                                    <div class="input-group ">
                                        <input class="debtor_employed" name="<?php echo base64_encode('Check emploment status Debtor 1#0-106I'); ?>" value="employed" type="radio" <?php echo isset($partIMain[base64_encode('Check emploment status Debtor 1#0-106I')]) ? Helper::validate_key_toggle(base64_encode('Check emploment status Debtor 1#0-106I'), $partIMain, 'employed') : (($onejob == 1) ? "checked" : ''); ?>>
                                        <label for="" class="">{{ __('Employed') }}</label>
                                    </div>
                                    <div class="input-group ">
                                        <input class="debtor_not_employed" name="<?php echo base64_encode('Check emploment status Debtor 1#0-106I'); ?>" value="unemployed" type="radio" <?php echo isset($partIMain[base64_encode('Check emploment status Debtor 1#0-106I')]) ? Helper::validate_key_toggle(base64_encode('Check emploment status Debtor 1#0-106I'), $partIMain, 'unemployed') : (($onejob != 1) ? "checked" : ''); ?>>
                                        <label for="">{{ __('Not Employed') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Occupation:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Occupation Debtor 1-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Occupation Debtor 1-106I')] ?? Helper::validate_key_value('employer_occupation', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Employer’s name:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Employers Name Debtor 1-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Employers Name Debtor 1-106I')] ?? Helper::validate_key_value('employer_name', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Address:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Employers Street1 Debtor 1-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Employers Street1 Debtor 1-106I')] ?? Helper::validate_key_value('name_address_employer', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Employers Street2 Debtor 1-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Employers Street2 Debtor 1-106I')] ?? Helper::validate_key_value('employer_address_line', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6 d-flex pr-0">
                                <label style="font-weight:bold">{{ __('City:') }}</label>
                                <input name="<?php echo base64_encode('Employers City Debtor 1-106I'); ?>" type="text" style="margin-left:6px;" style="margin-left:6px;" value="<?php echo $partIMain[base64_encode('Employers City Debtor 1-106I')] ?? Helper::validate_key_value('employer_city', $incomedebtoremployer); ?>" class="form-control">
                            </div>
                            <div class="col-md-6 d-flex pr-0 pl-0">
                                <label style="font-weight:bold">{{ __('State:') }}</label>
                                <input name="<?php echo base64_encode('Employers State Debtor 1-106I'); ?>" type="text" style="margin-left:6px;" style="margin-left:6px;" value="<?php echo $partIMain[base64_encode('Employers State Debtor 1-106I')] ?? Helper::validate_key_value('employer_state', $incomedebtoremployer); ?>" class="form-control">
                            </div>
                            <div class="col-md-6 d-flex" style="padding-right:8px;">
                                <label style="font-weight:bold">{{ __('Zip:') }}</label>
                                <input name="<?php echo base64_encode('Employers Zip debtor 1-106I'); ?>" type="text" style="margin-left:6px;" style="margin-left:6px;" value="<?php echo $partIMain[base64_encode('Employers Zip debtor 1-106I')] ?? Helper::validate_key_value('employer_zip', $incomedebtoremployer); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <!-- <strong>{{ __('How long employed:') }}</strong> -->

                                  <x-stronglabel label="{{ __('How long employed:')}}"></x-stronglabel>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Time employed Debtor 1#0-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Time employed Debtor 1#0-106I')] ?? Helper::validate_key_value('employer_job_period', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>

                    <div class="col-md-6 pb-2">

                        <div class="row mb-1">
                            <div class="col-md-12 column-heading align--center"><strong>{{ __('Debtor 2 or non-filing spouse') }}</strong></div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12">
                                <strong>{{ __('Employment Status:') }}</strong>
                            </div>
                            <div class="col-md-3 mt-2"></div>
                            <div class="col-md-9 mt-2">
                                <div class="input-group mb-3">
                                    <div class="input-group ">
                                        <input class="spouse_employed" name="<?php echo base64_encode('Check emploment status Debtor 2#0-106I'); ?>" value="employed" type="radio" <?php echo isset($partIMain[base64_encode('Check emploment status Debtor 2#0-106I')]) ? Helper::validate_key_toggle(base64_encode('Check emploment status Debtor 2#0-106I'), $partIMain, 'unemployed') : (($secondjob == 1) ? "checked" : ''); ?>>
                                        <label for="" class="">{{ __('Employed') }}</label>
                                    </div>
                                    <div class="input-group ">
                                        <input class="spouse_not_employed" name="<?php echo base64_encode('Check emploment status Debtor 2#0-106I'); ?>" value="unemployed" type="radio" <?php echo isset($partIMain[base64_encode('Check emploment status Debtor 2#0-106I')]) ? Helper::validate_key_toggle(base64_encode('Check emploment status Debtor 2#0-106I'), $partIMain, 'unemployed') : (($secondjob != 1) ? "checked" : ''); ?>>
                                        <label for="">{{ __('Not Employed') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                              <!--   <strong>{{ __('Occupation:') }}</strong> -->

                                  <x-stronglabel label="{{ __('Occupation:')}}"></x-stronglabel>

                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Occupation Debtor 2-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Occupation Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_occupation', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">


                              <!--   <strong>{{ __('Employer’s name:') }}</strong> -->
                                 <x-stronglabel label="{{ __('Employer’s name:')}}"></x-stronglabel>


                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Employers Name Debtor 2-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Employers Name Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_name', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <!-- <strong>{{ __('Address:') }}</strong> -->
                                <x-stronglabel label="{{ __('Address:')}}"></x-stronglabel>


                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Employers Street1 Debtor 2-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Employers Street1 Debtor 2-106I')] ?? Helper::validate_key_value('name_address_spouse_employer', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Employers Street2 Debtor 2-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Employers Street2 Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_address_line', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6 d-flex pr-0">
                                <label style="font-weight:bold">{{ __('City:') }}</label>
                                <input name="<?php echo base64_encode('Employers City Debtor 2-106I'); ?>" type="text" style="margin-left:6px;" value="<?php echo $partIMain[base64_encode('Employers City Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_city', $debtorspouseemployer); ?>" class="form-control">
                            </div>
                            <div class="col-md-6 d-flex pr-0 pl-0">
                                <label style="font-weight:bold">{{ __('State:') }}</label>
                                <input name="<?php echo base64_encode('Employers State Debtor 2-106I'); ?>" type="text" style="margin-left:6px;" value="<?php echo $partIMain[base64_encode('Employers State Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_state', $debtorspouseemployer); ?>" class="form-control">
                            </div>
                            <div class="col-md-6 d-flex" style="padding-right:8px;">
                                <label style="font-weight:bold">{{ __('Zip:') }}</label>
                                <input name="<?php echo base64_encode('Employers Zip debtor 2-106I'); ?>" type="text" style="margin-left:6px;" value="<?php echo $partIMain[base64_encode('Employers Zip debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_zip', $debtorspouseemployer); ?>" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>How long employed:</strong>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Time employed Debtor 1-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Time employed Debtor 1-106I')] ?? Helper::validate_key_value('spouse_employer_job_period', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Part 2 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 2') }}</span>
                        <h2 class="font-lg-18">{{ __('Give Details About Monthly Income') }} </h2>
                    </div>
                </div>
            </div>
            <div class="form-border">
                <!-- Row 1 -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group d-inline-block">
                            <label for="">
                                <strong class="d-block">{{ __('Estimate monthly income as of the date you
                                    file
                                    this form. If you have nothing to report for any line, write $0
                                    in
                                    the space. Include your non-filing
                                    spouse unless you are separated.') }}
                                </strong> {{ __('If you or your non-filing spouse have more than one
                                employer,
                                combine the information for all employers for that person on the
                                lines
                                below. If you need more space, attach a separate sheet to this form.') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 mb-3">
                        <div class="row">
                            <div class="col-md-6  column-heading">{{ __('For Debtor 1') }} </div>
                            <div class="col-md-6  column-heading">{{ __('For Debtor 2') }} </div>
                        </div>
                    </div>
                </div>
                <!-- Row 2 -->
                <?php
    $debtormonthlyincome = (!empty($income_info['debtormonthlyincome'])) ? $income_info['debtormonthlyincome'] : [];
$debtorspousemonthlyincome = (!empty($income_info['debtorspousemonthlyincome'])) ? $income_info['debtorspousemonthlyincome'] : [];
?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('2. List monthly gross wages, salary, and
                                    commissions') }}
                                </strong> {{ __('(before all payroll
                                deductions). If not paid monthly, calculate what the monthly wage
                                would
                                be') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">2</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <?php

                    //$dgross = $partIMain[base64_encode('Amount 2 Debtor 1-106I')] ?? 0;
                    $dgross = 0;
if ($importIncome) {
    $dgross = Helper::validate_key_value('debtor_gross_avg', $meantestPData);
    if (Helper::validate_key_value('graduate', $meantestPData) == 1) {
        $dgross = Helper::validate_key_value('avg_debtor_gross_avg', $meantestPData);
    }
}
$debtor_gross1 = IncomeDebtorMonthlyIncome::debtorGrossWagesMonth($debtormonthlyincome);
$dgross = $importIncome ? $dgross : $debtor_gross1;

?>
                                    <input name="<?php echo base64_encode('Amount 2 Debtor 1-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($dgross); ?>" class="price-field form-control income_line2_debtor schd_i_price fi_schedule_i_line2_debtor">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">2</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <?php
$sgross = 0;
//$partIMain[base64_encode('Amount 2 Debtor 2-106I')] ?? 0;
if ($importIncome) {
    $sgross = Helper::validate_key_value('spouse_gross_avg', $meantestPData);
}
if ($importIncome && Helper::validate_key_value('graduate', $meantestPData) == 1) {
    $sgross = Helper::validate_key_value('avg_spouse_gross_avg', $meantestPData);
}

$debtorspouse_gross1 = IncomeDebtorSpouseMonthlyIncome::debtorGrossWagesMonth($debtorspousemonthlyincome);
$sgross = ($importIncome) ? $sgross : $debtorspouse_gross1;


?>
                                    <input name="<?php echo base64_encode('Amount 2 Debtor 2-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($sgross); ?>" class="price-field form-control income_line2_spouse schd_i_price fi_schedule_i_line2_spouse">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Row 3 -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('3. Estimate and list monthly overtime pay') }}
                                </strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">3</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text">+</span><span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <?php $debtor_gross2 = IncomeDebtorMonthlyIncome::overTimePerMonth($debtormonthlyincome);
$debtorspouse_gross2 = IncomeDebtorSpouseMonthlyIncome::overTimePerMonth($debtorspousemonthlyincome);
?>
                                    <input name="<?php echo base64_encode('Amount 3 Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 3 Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 3 Debtor 1-106I')]) : Helper::priceFormtWithComma($debtor_gross2); ?>" class="price-field income_overtime_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text">+</span><span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 3 Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 3 Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 3 Debtor 2-106I')]) : Helper::priceFormtWithComma($debtorspouse_gross2); ?>" class="price-field income_overtime_spouse schd_i_price form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Row 3 -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('4. Calculate gross income.') }}
                                </strong>{{ __('Add line 2 + line 3') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">4.</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 4 Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 4 Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 4 Debtor 1-106I')]) : Helper::priceFormtWithComma((float)($debtor_gross1) + (float)($debtor_gross2)); ?>" class="price-field income_line4_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 4 Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 4 Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 4 Debtor 2-106I')]) : Helper::priceFormtWithComma((float)($debtorspouse_gross1) + (float)($debtorspouse_gross2)); ?>" class="price-field income_line4_spouse schd_i_price form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Row 4 -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('4. Copy line 4 here') }}
                                </strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">4.</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 4 Debtor 2-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma((float)($debtor_gross1) + (float)($debtor_gross2)); ?>" class="price-field copy_line4_debtor form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 4 Debtor 2-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma((float)($debtorspouse_gross1) + (float)($debtorspouse_gross2)); ?>" class="price-field copy_line4_spouse form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Row 5 -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <strong class="d-block">{{ __('5. List all payroll deductions:') }}
                            </strong>
                        </div>
                    </div>
                </div>
               
                <div class="payroll-deduction">
                    <!-- Row 5.1 -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5a. Tax, Medicare, and Social Security deductions 5a.') }}</label>
                            </div>
                        </div>
                        <?php
                        $dtaxes = 0;
if ($importIncome) {
    $dtaxes = Helper::validate_key_value('debtor_taxes_avg', $meantestPData);
}
if ($importIncome && Helper::validate_key_value('graduate', $meantestPData) == 1) {
    $dtaxes = Helper::validate_key_value('avg_debtor_taxes_avg', $meantestPData);
}
$dtaxes = $importIncome ? $dtaxes : IncomeDebtorMonthlyIncome::payCheckSecurity($debtormonthlyincome);
?>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5a.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5a Debtor 1-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($dtaxes); ?>" class="price-field inecome_line5a_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <?php
                $staxes = 0; // $partIMain[base64_encode('Amount 5a Debtor 2-106I')] ?? 0;
if ($importIncome) {
    $staxes = Helper::validate_key_value('spouse_taxes_avg', $meantestPData);
}
if ($importIncome && Helper::validate_key_value('graduate', $meantestPData) == 1) {
    $staxes = Helper::validate_key_value('avg_spouse_taxes_avg', $meantestPData);
}
$staxes = $importIncome ? $staxes : IncomeDebtorSpouseMonthlyIncome::payCheckSecurity($debtorspousemonthlyincome);
?>
                                        <input name="<?php echo base64_encode('Amount 5a Debtor 2-106I'); ?>" type="text" value="<?php echo  Helper::priceFormtWithComma($staxes); ?>" class="price-field inecome_line5a_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5.b -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5b. Mandatory contributions for retirement plans') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5b.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5b Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5b Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5b Debtor 1-106I')]) : IncomeDebtorMonthlyIncome::payCheckMandatoryContribution($debtormonthlyincome); ?>" class="price-field inecome_line5b_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5b Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5b Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5b Debtor 2-106I')]) : IncomeDebtorSpouseMonthlyIncome::payCheckMandatoryContribution($debtorspousemonthlyincome); ?>" class="price-field inecome_line5b_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5.c -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5c. Voluntary contributions for retirement plans') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5c.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5c Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5c Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5c Debtor 1-106I')]) : IncomeDebtorMonthlyIncome::payCheckVoluntaryContribution($debtormonthlyincome); ?>" class="price-field inecome_line5c_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5c Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5c Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5c Debtor 2-106I')]) : IncomeDebtorSpouseMonthlyIncome::payCheckVoluntaryContribution($debtorspousemonthlyincome); ?>" class="price-field inecome_line5c_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5d -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5d. Required repayments of retirement fund loans') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5d.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5d Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5d Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5d Debtor 1-106I')]) : IncomeDebtorMonthlyIncome::payCheckRequiredRepayment($debtormonthlyincome); ?>" class="price-field  inecome_line5d_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5d Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5d Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5d Debtor 2-106I')]) : IncomeDebtorSpouseMonthlyIncome::payCheckRequiredRepayment($debtorspousemonthlyincome); ?>" class="price-field inecome_line5d_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5e -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5e. Insurance') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5e.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5e Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5e Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5e Debtor 1-106I')]) : IncomeDebtorMonthlyIncome::automaticallyDeductionInsurance($debtormonthlyincome); ?>" class="price-field inecome_line5e_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5e Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5e Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5e Debtor 2-106I')]) : IncomeDebtorSpouseMonthlyIncome::automaticallyDeductionInsurance($debtorspousemonthlyincome); ?>" class="price-field inecome_line5e_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5f -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5f. Domestic support obligations') }} </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5f.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5f Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5f Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5f Debtor 1-106I')]) : IncomeDebtorMonthlyIncome::domesticSupportObligations($debtormonthlyincome); ?>" class="price-field inecome_line5f_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5f Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5f Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5f Debtor 2-106I')]) : IncomeDebtorSpouseMonthlyIncome::domesticSupportObligations($debtorspousemonthlyincome); ?>" class="price-field inecome_line5f_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5g -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5g. Union dues') }} </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5g.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5g Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5g Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5g Debtor 1-106I')]) : IncomeDebtorMonthlyIncome::unionDuesDeducted($debtormonthlyincome); ?>" class="price-field inecome_line5g_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5g Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5g Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5g Debtor 2-106I')]) : IncomeDebtorSpouseMonthlyIncome::unionDuesDeducted($debtorspousemonthlyincome); ?>" class="price-field inecome_line5g_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 5h -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('5h. Other deductions') }} </label>
                            </div>
                            <div class="input-group mb-3">
                                <label>{{ __('specify') }} </label>
                                <input name="<?php echo base64_encode('Other deductions 5h-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Other deductions 5h-106I')] ?? IncomeDebtorMonthlyIncome::otherDeductionSpecify($debtormonthlyincome); ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">5h.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5h Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5h Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5h Debtor 1-106I')]) : number_format(IncomeDebtorMonthlyIncome::othergrossDeduction($debtormonthlyincome), 2, '.', ''); ?>" class="price-field inecome_line5h_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 5h Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 5h Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 5h Debtor 2-106I')]) : number_format(IncomeDebtorSpouseMonthlyIncome::othergrossDeduction($debtorspousemonthlyincome), 2, '.', ''); ?>" class="price-field inecome_line5h_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                $debtor_payroll = 0;
$debtorspouse_payroll = 0;

$debtor_payroll = IncomeDebtorMonthlyIncome::getWagesIncomeSum($debtormonthlyincome);
$debtorspouse_payroll = IncomeDebtorSpouseMonthlyIncome::getWagesIncomeSum($debtorspousemonthlyincome);

$debtors_home_pay = (float)($debtor_gross1) + (float)($debtor_gross2);
$debtorspouse_home_pay = (float)($debtorspouse_gross1) + (float)($debtorspouse_gross2);

$total_monthly_debtors_home_pay = 0;
$total_monthly_debtorspouse_home_pay = 0;

if (isset($debtor_payroll) && $debtors_home_pay) {
    $total_monthly_debtors_home_pay = $debtors_home_pay - $debtor_payroll;
}

if (isset($debtorspouse_payroll) && $debtorspouse_home_pay) {
    $total_monthly_debtorspouse_home_pay = $debtorspouse_home_pay - $debtorspouse_payroll;
}
?>
                <!-- Row 6 -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <strong class="d-block">{{ __('6. Add the payroll deductions.') }}
                            </strong> {{ __('Add lines 5a + 5b + 5c + 5d + 5e +5f + 5g + 5h') }}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">6.</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 6 Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 6 Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 6 Debtor 1-106I')]) : Helper::priceFormtWithComma($debtor_payroll); ?>" class="price-field form-control line6_income_debtor schd_i_price fi_schedule_i_line6_debtor">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 6 Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 6 Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 6 Debtor 2-106I')]) : Helper::priceFormtWithComma($debtorspouse_payroll); ?>" class="price-field form-control line6_income_spouse schd_i_price fi_schedule_i_line6_spouse">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 7 -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="">
                            <strong class="d-block">{{ __('7. Calculate total monthly take-home pay.') }}
                            </strong> {{ __('Subtract line 6 from line 4.') }}
                        </label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">7.</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 7 Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 7 Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 7 Debtor 1-106I')]) : Helper::priceFormtWithComma($total_monthly_debtors_home_pay); ?>" class="price-field line7_income_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 7 Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 7 Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 7 Debtor 2-106I')]) : Helper::priceFormtWithComma($total_monthly_debtorspouse_home_pay); ?>" class="price-field line7_income_spouse schd_i_price form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 8 -->
                <div class="row">
                    <div class="col-md-12">
                        <label for="">
                            <strong class="d-block">{{ __('8. List all other income regularly received:') }}
                            </strong>
                        </label>
                    </div>
                </div>

                <div class="payroll-deduction">
                    <!-- Row 8.a -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label><strong>
                                        {{ __('8a. Net income from rental property and from operating a
                                        business,
                                        profession, or farm') }}
                                    </strong> {{ __('Attach a statement for each property and business
                                    showing gross
                                    receipts, ordinary and necessary business expenses, and the
                                    total
                                    monthly net income.') }} </label>
                            </div>
                        </div>
                        <?php

        $codebtorTotalOperatingExpense = 0;
$incomeData = AddressHelper::getDebtorIncomeFromBusiness($debtormonthlyincome);
$debtoraverage = $incomeData['debtoraverage'];
$debtorProperty = IncomeDebtorMonthlyIncome::getPropertyIncome($debtormonthlyincome);
$debtoraverage = $debtoraverage + $debtorProperty;
?>

                        <?php
$coDebtorncome = AddressHelper::getSpouseIncomeFromBusiness($debtorspousemonthlyincome);
$spouseaverage = $coDebtorncome['spouseaverage'];
$spouseProperty = IncomeDebtorSpouseMonthlyIncome::getPropertyIncome($debtorspousemonthlyincome);
$spouseaverage = $spouseaverage + $spouseProperty;
?>

                        <?php
$sbnetincome = 0; // $partIMain[base64_encode('Amount 8a Debtor 1-106I')] ?? 0;
if ($importIncome) {
    $sbnetincome = Helper::validate_key_value_exclude_comma('debtor_net_avg', $meantestPData);
    $sbnetincome = (float)$sbnetincome + (float)$debtorProperty;
}
if ($importIncome && Helper::validate_key_value('graduate', $meantestPData) == 1) {
    $sbnetincome = Helper::validate_key_value_exclude_comma('debtor_biz_net_avg', $meantestPData, 'float', false);
    $sbnetincome = (float)$sbnetincome + (float)$debtorProperty;
}
$sbnetincome = $importIncome ? $sbnetincome : $debtoraverage;
?>

                        <?php
$spbnetincome = 0; //$partIMain[base64_encode('Amount 8a Debtor 2-106I')] ?? 0;
if ($importIncome) {
    $spbnetincome = Helper::validate_key_value_exclude_comma('spouse_net_avg', $meantestPData, 'float', false);
    $spbnetincome = (float)$spbnetincome + (float)$spouseProperty;
}
if ($importIncome && Helper::validate_key_value('graduate', $meantestPData) == 1) {
    $spbnetincome = Helper::validate_key_value_exclude_comma('spouse_biz_net', $meantestPData, 'float', false);
    $spbnetincome = (float)$spbnetincome + (float)$spouseProperty;
}
$spbnetincome = $importIncome ? $spbnetincome : $spouseaverage;
?>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">8a.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8a Debtor 1-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($sbnetincome); ?>" class="price-field line8a_income_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8a Debtor 2-106I'); ?>" type="text" value="<?php echo  Helper::priceFormtWithComma($spbnetincome); ?>" class="price-field line8a_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row 8.b -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('8b. Interest and dividends') }} </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">8b.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8b Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8b Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8b Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::getInterestDividends($debtormonthlyincome)); ?>" class="price-field line8b_income_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8b Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8b Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8b Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::getInterestDividends($debtorspousemonthlyincome)); ?>" class="price-field line8b_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 8 c -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label><strong>
                                        {{ __('8c. Family support payments that you, a non-filing spouse,
                                        or a dependent
                                        regularly receive') }}
                                    </strong> {{ __('Include alimony, spousal support, child support,
                                    maintenance, divorce
                                    settlement, and property settlement.') }} </label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">8c.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8c Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8c Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8c Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::regularContribution($debtormonthlyincome)); ?>" class="price-field line8c_income_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8c Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8c Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8c Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::regularContribution($debtorspousemonthlyincome)); ?>" class="price-field line8c_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 8d -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('8d. Unemployment compensation') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">8d.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8d Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8d Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8d Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::unemploymentCompensation($debtormonthlyincome)); ?>" class="price-field line8d_income_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8d Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8d Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8d Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::unemploymentCompensation($debtorspousemonthlyincome)); ?>" class="price-field line8d_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 8e -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label>{{ __('8e. Social Security') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">8e.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8e Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8e Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8e Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::socialSecurity($debtormonthlyincome)); ?>" class="price-field line8e_income_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8e Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8e Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8e Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::socialSecurity($debtorspousemonthlyincome)); ?>" class="price-field line8e_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row 8f -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <label><strong>
                                        {{ __('8f. Other government assistance that you regularly receive') }}
                                    </strong><br>{{ __('Include cash assistance and the value (if known) of any
                                    non-cash assistance
                                    that you receive, such as food stamps (benefits under the
                                    Supplemental
                                    Nutrition Assistance Program) or housing subsidies.') }} </label>
                            </div>
                            <div class="input-group mb-3">
                                <label>{{ __('Specify') }}</label>
                                <?php

        $gvIncome = IncomeDebtorMonthlyIncome::governmentAssictantSpecify($debtormonthlyincome);
$gvIncome2 = IncomeDebtorSpouseMonthlyIncome::governmentAssictantSpecify($debtorspousemonthlyincome);
$finalgvText = $gvIncome . $gvIncome2;
if (!empty($gvIncome) && !empty($gvIncome2)) {
    $finalgvText = $gvIncome . ', ' . $gvIncome2;
}
?>
                                <input name="<?php echo base64_encode('Assistance 8f#0-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Assistance 8f#0-106I')] ?? $finalgvText; ?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <strong class="input-group-text">8f.</strong>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8f Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8f Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8f Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::governmentAssictant($debtormonthlyincome)); ?>" class="price-field line8f_income_debtor schd_i_price form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 pl-0 pr-0">
                                    <div class="input-group d-flex mb-3">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode('Amount 8f Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8f Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8f Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::governmentAssictant($debtorspousemonthlyincome)); ?>" class="price-field line8f_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>



                </div>
                <!-- Row 9 -->
                <?php
                    $debtor_other_total_income = 0;
$debtorspouse_other_total_income = 0;
$debtor_other_total_income = IncomeDebtorMonthlyIncome::otherIncomeTotal($debtormonthlyincome);
$debtorspouse_other_total_income = IncomeDebtorSpouseMonthlyIncome::otherIncomeTotal($debtorspousemonthlyincome);
?>
                <!-- Row 8f -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label><strong>
                                    {{ __('8g. Pension or retirement income') }}</strong> </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">8g.</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    
                                    <input name="<?php echo base64_encode('Amount 8g Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8g Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8g Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::retirementPension($debtormonthlyincome)); ?>" class="price-field line8g_income_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 8g Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8g Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8g Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::retirementPension($debtorspousemonthlyincome)); ?>" class="price-field line8g_income_spouse schd_i_price form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <!-- Row 8f -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label><strong>
                                    {{ __('8h. Other monthly income.') }}</strong> </label>
                        </div>
                        <div class="input-group mb-3">
                            <label>{{ __('Specify') }}</label>
                            <?php
            $osIncome = IncomeDebtorMonthlyIncome::otherSourcesSpecify($debtormonthlyincome);
$osIncome2 = IncomeDebtorSpouseMonthlyIncome::otherSourcesSpecify($debtorspousemonthlyincome);
$finalText = $osIncome . $osIncome2;
if (!empty($osIncome) && !empty($osIncome)) {
    $finalText = $osIncome . ' / ' . $osIncome2;
}
?>
                            <input name="<?php echo base64_encode('Other income 8h-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Other income 8h-106I')] ?? $finalText; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">8h.</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>

                                    <input name="<?php echo base64_encode('Amount 8h Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8h Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8h Debtor 1-106I')]) : Helper::priceFormtWithComma(IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome)); ?>" class="price-field line8h_income_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 8h Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 8h Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 8h Debtor 2-106I')]) : Helper::priceFormtWithComma(IncomeDebtorSpouseMonthlyIncome::otherSources($debtorspousemonthlyincome)); ?>" class="price-field line8h_income_spouse schd_i_price form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('9. Add all other income.') }}
                                </strong> {{ __('Add lines 8a + 8b + 8c + 8d + 8e + 8f +8g + 8h') }}
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6 pl-0 ">
                                <div class="input-group d-flex border_2px" style="padding:5px;">
                                    <strong class="input-group-text">9</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 9 Debtor 1-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 9 Debtor 1-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 9 Debtor 1-106I')]) : Helper::priceFormtWithComma($debtor_other_total_income); ?>" class="price-field line9_income_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-6 pl-0 pr-0">
                                <div class="input-group d-flex border_2px" style="padding:5px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount 9 Debtor 2-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 9 Debtor 2-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 9 Debtor 2-106I')]) : Helper::priceFormtWithComma($debtorspouse_other_total_income); ?>" class="price-field line9_income_spouse  schd_i_price form-control">
                                </div>
                            </div>

                           
                        </div>

                    </div>
                </div>
                <!-- Row 10 -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('10. Calculate monthly income. Add line 7 +
                                    line
                                    9.') }}
                                </strong> {{ __('Add the entries in line 10 for Debtor 1 and Debtor 2 or
                                non-filing spouse.') }}
                            </label>
                        </div>
                    </div>
                    <?php
                    $debtor_caluculate_income = $debtor_other_total_income + $total_monthly_debtors_home_pay;
$debtorspouse_caluculate_income = $debtorspouse_other_total_income + $total_monthly_debtorspouse_home_pay;

?>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4 pl-0 ">
                                <div class="input-group d-flex border_2px" style="padding:5px;">
                                    <strong class="input-group-text">10</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <?php $db1 = isset($partIMain[base64_encode('Amount 10 Debtor 1#0-106I')]) ? $partIMain[base64_encode('Amount 10 Debtor 1#0-106I')] : $debtor_caluculate_income; ?>
                                    <input name="<?php echo base64_encode('Amount 10 Debtor 1#0-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($db1); ?>" class="price-field line10_income_debtor schd_i_price form-control">
                                </div>
                            </div>
                            <div class="col-md-4 pl-0 pr-0">
                                <div class="d-flex"><span class="mt-3">+</span>
                                <div class="input-group d-flex border_2px" style="padding:5px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <?php $db2 = isset($partIMain[base64_encode('Amount 10 Debtor 1-106I')]) ? $partIMain[base64_encode('Amount 10 Debtor 1-106I')] : $debtorspouse_caluculate_income; ?>
                                    <input name="<?php echo base64_encode('Amount 10 Debtor 1-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($db2); ?>" class="price-field line10_income_spouse schd_i_price form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pr-0">
                            <div class="d-flex"><span class="mt-3">=</span>
                                <div class="input-group d-flex border_2px" style="padding:5px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <?php

                $dbs = Helper::priceFormt($db1) + Helper::priceFormt($db2); ?>
                                    <input name="<?php echo base64_encode('Amount 10#0-106I'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($dbs); ?>" class="price-field line10last line10_sum_both schd_i_price form-control">
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php $debtor_gross1 = (!empty($debtormonthlyincome['debtor_gross_wages_month'])) ? IncomeDebtorMonthlyIncome::otherSources($debtormonthlyincome) : 0.00; ?>
                <!-- Row 11 -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('11. State all other regular contributions to
                                    the
                                    expenses that you list in Schedule J.') }}
                                </strong> {{ __('Include contributions from an unmarried partner, members
                                of
                                your household, your dependents, your roommates, and other
                                friends or relatives.') }}

                            </label>
                            <div class="input-group mb-3">
                                <label for=""> {{ __('Do not include any amounts already included in lines
                                    2-10
                                    or amounts
                                    that are not available to pay expenses listed in Schedule J') }}
                                </label>
                                <div class="input-group mb-3 mt-1">
                                    <label for="">Specify:
                                        <input name="<?php echo base64_encode('Assistance 8f-106I'); ?>" type="text" value="" class="form-control">
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">11</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text">+</span><span class="input-group-text" id="basic-addon2">$</span>
                                    </div>

                                    <input name="<?php echo base64_encode('Amount 11-106I'); ?>" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 11-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 11-106I')]) : Helper::priceFormtWithComma(''); ?>" class="price-field line11_income schd_i_price line11sum form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 12 -->
                <div class="row">
                    <div class="col-md-9">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('12. Add the amount in the last column of
                                    line 10
                                    to the amount in line 11.') }}
                                </strong>{{ __('. The result is the combined monthly income.
                                Write that amount on the Summary of Your Assets and Liabilities and
                                Certain Statistical Information, if it applies') }}
                            </label>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group d-flex mb-3">
                                    <strong class="input-group-text">12</strong>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                  
                                    <input name="<?php echo base64_encode('Amount 10-106I'); ?>" id="i_combined_monthly_income" type="text" value="<?php echo isset($partIMain[base64_encode('Amount 10-106I')]) ? Helper::priceFormtWithComma($partIMain[base64_encode('Amount 10-106I')]) : Helper::priceFormtWithComma($line11Total); ?>" class="price-field totalline11 schd_i_price fi_schedule_i_monthly_income line12_income form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row 13 -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mb-3">
                            <label for="">
                                <strong class="d-block">{{ __('13. Do you expect an increase or decrease
                                    within
                                    the
                                    year after you file this form?') }}</strong>




                            </label>
                            <div class="input-group ">
                                <input checked name="<?php echo base64_encode('Check increase#0-106I'); ?>" value="no" type="checkbox" <?php echo isset($partIMain[base64_encode('Check increase#0-106I')]) ? Helper::validate_key_toggle(base64_encode('Check increase#0-106I'), $partIMain, 'no') : ''; ?>>
                                <label for="" class="">{{ __('No') }}</label>
                            </div>
                            <div class="input-group ">
                                <input name="<?php echo base64_encode('Check increase#0-106I'); ?>" value="yes" type="checkbox" <?php echo isset($partIMain[base64_encode('Check increase#0-106I')]) ? Helper::validate_key_toggle(base64_encode('Check increase#0-106I'), $partIMain, 'yes') : ''; ?>>
                                <label for="">{{ __('Yes Explain') }}</label>
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode('Increase/Decrease 13-106I'); ?>" type="text" value="<?php echo $partIMain[base64_encode('Increase/Decrease 13-106I')] ?? ''; ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </form>
        <?php if ($onejob == 1 || $secondjob == 1) { ?>
        <form name="official_frm_106i_additional" id="official_frm_106i_additional" class="official_106i_form save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
            @csrf
            <input type="hidden" name="form_id" value="106i_additional">
            <input type="hidden" name="client_id" value="<?php echo $client_id; ?>">
            <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106i_additional.pdf'; ?>">
            <input type="hidden" name="clientPDFName" value="<?php echo $client_id . '_b106i_additional.pdf'; ?>">
            <input type="hidden" name="<?php echo base64_encode('Case number#0-106I'); ?>" value="<?php echo $caseno; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 1#1-106I'); ?>" value="<?php echo $onlyDebtor; ?>">
            <input type="hidden" name="<?php echo base64_encode('Debtor 2-106I'); ?>" value="<?php echo $spousename; ?>">
            <!-- use below varibale for PArt D -->
            <?php $partIAdd = isset($dynamicPdfData['106i_additional']) && !empty($dynamicPdfData['106i_additional']) ? json_decode($dynamicPdfData['106i_additional'], 1) : null;
            ?>
            <?php
            $onejob = Helper::validate_key_value('any_other_jobs', $incomedebtoremployer);
            $secondjob = Helper::validate_key_value('spouse_any_other_jobs', $debtorspouseemployer);

            $incomedebtoremployer = $onejob == 1 ? $incomedebtoremployer : [];
            $debtorspouseemployer = $secondjob == 1 ? $debtorspouseemployer : [];
            ?>
            <div class="form-border mt-3 mb-3 <?php if ($onejob == 1 || $secondjob == 1) {
            } else { ?> hide-data<?php } ?>">
                <!-- Row 1 -->
                <div class="row">
                    <div class="col-md-12 align--center pt-2">
                        <h3><strong>{{ __('(Additional Employment Information)') }}</strong></h3>
                    </div>


                    <div class="col-md-6 pr-0 pb-2">
                        <div class="row mb-1">
                            <div class="col-md-12 column-heading align--center"><strong>{{ __('Debtor 1') }}</strong></div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <strong>{{ __('Employment Status:')}}</strong>
                            </div>
                            <div class="col-md-3 mt-2"></div>
                            <div class="col-md-9 mt-2">
                                <?php
                                $c1 = $partIAdd[base64_encode('CheckBox0')] ?? null;
            $c2 = $partIAdd[base64_encode('CheckBox1')] ?? null;

            $dbvalues = [$c1, $c2];
            if (!empty(array_filter($dbvalues))) {
                unset($onejob);
            }

            $check1 = ((isset($onejob) && $onejob == 1) ? "checked" : '');
            $check2 = ((isset($onejob) && $onejob != 1) ? "checked" : '');
            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group ">
                                        <input value="YES" name="<?php echo base64_encode("CheckBox0"); ?>" type="checkbox" <?php echo $check1; ?>>
                                        <label for="" class="">{{ __('Employed') }}</label>
                                    </div>
                                    <div class="input-group ">
                                        <input value="YES" name="<?php echo base64_encode("CheckBox1"); ?>" type="checkbox" <?php echo $check2; ?>>
                                        <label for="">{{ __('Not Employed') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Occupation:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox0"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox0')] ?? Helper::validate_key_value('second_employer_occupation', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Employer’s name:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox1"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox1')] ?? Helper::validate_key_value('second_employer_name', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Address:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox2"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox2')] ?? Helper::validate_key_value('name_address_second_employer', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox3"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox3')] ?? Helper::validate_key_value('second_employer_address_line', $incomedebtoremployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6 d-flex pr-0">
                                <label style="font-weight:bold">{{ __('City:') }}</label>
                                <input type="text" name="<?php echo base64_encode("TextBox4"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox4')] ?? Helper::validate_key_value('second_employer_city', $incomedebtoremployer); ?>" class="form-control" style="margin-left:6px;">
                            </div>
                            <div class="col-md-6 d-flex pr-0 pl-0">
                                <label style="font-weight:bold">{{ __('State:') }}</label>
                                <input type="text" name="<?php echo base64_encode("TextBox5"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox5')] ?? Helper::validate_key_value('second_employer_state', $incomedebtoremployer); ?>" class="form-control" style="margin-left:6px;">
                            </div>
                            <div class="col-md-6 d-flex" style="padding-right:8px;">
                                <label style="font-weight:bold">{{ __('Zip:') }}</label>
                                <input type="text" name="<?php echo base64_encode("TextBox6"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox6')] ?? Helper::validate_key_value('second_employer_zip', $incomedebtoremployer); ?>" class="form-control" style="margin-left:6px;">
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                

                                <x-stronglabel label="{{ __('How long employed:')}}"></x-stronglabel>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group ">


                                    <input type="text" name="<?php echo base64_encode("TextBox7"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox7')] ?? Helper::validate_key_value('second_employer_job_period', $incomedebtoremployer); ?>" class="form-control">

                                   


                                    


                                </div>
                            </div>
                            <div class="col-md-5"></div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                 
                                <x-stronglabel label="{{ __('Notes:')}}"></x-stronglabel>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <textarea class="form-control" name="<?php echo base64_encode("TextBox8"); ?>" rows="4" cols=""><?php echo $partIAdd[base64_encode('TextBox8')] ?? Helper::validate_key_value('notes', $incomedebtoremployer); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 pb-2">

                        <div class="row mb-1">
                            <div class="col-md-12 column-heading align--center">
                                <!-- <strong>Debtor 2 or non-filing spouse</strong> -->
                                  <x-stronglabel label="{{ __('Debtor 2 or non-filing spouse')}}"></x-stronglabel>
                            </div>

                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12">
                                

                                  <x-stronglabel label="{{ __('Employment Status:')}}"></x-stronglabel>

                            </div>
                            <div class="col-md-3 mt-2"></div>
                            <div class="col-md-9 mt-2">
                                <?php
            $c1 = $partIAdd[base64_encode('CheckBox2')] ?? null;
            $c2 = $partIAdd[base64_encode('CheckBox3')] ?? null;

            $dbvalues = [$c1, $c2];
            if (!empty(array_filter($dbvalues))) {
                unset($secondjob);
            }

            $check1 = ((isset($secondjob) && $secondjob == 1) ? "checked" : '');
            $check2 = ((isset($secondjob) && $secondjob != 1) ? "checked" : '');
            ?>
                                <div class="input-group mb-3">
                                    <div class="input-group ">
                                        <input value="YES" name="<?php echo base64_encode("CheckBox2"); ?>" type="checkbox" <?php echo $check1; ?>>
                                        <label for="" class="">{{ __('Employed') }}</label>
                                    </div>
                                    <div class="input-group ">
                                        <input value="YES" name="<?php echo base64_encode("CheckBox3"); ?>" type="checkbox" <?php echo $check2; ?>>
                                        <label for="">{{ __('Not Employed') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                

                                 <x-stronglabel label="{{ __('Occupation:')}}"></x-stronglabel>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox9"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox9')] ?? Helper::validate_key_value('spouse_second_employer_occupation', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                

                                 <x-stronglabel label="{{ __('Employer’s name:')}}"></x-stronglabel>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox10"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox10')] ?? Helper::validate_key_value('spouse_second_employer_name', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                

                                <x-stronglabel label="{{ __('Address:')}}"></x-stronglabel>


                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox11"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox11')] ?? Helper::validate_key_value('name_address_spouse_second_employer', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-12">
                                <div class="input-group ">
                                    <input type="text" name="<?php echo base64_encode("TextBox12"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox12')] ?? Helper::validate_key_value('second_spouse_employer_address_line', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-6 d-flex pr-0">
                                <label style="font-weight:bold">{{ __('City:') }}</label>
                                <input type="text" name="<?php echo base64_encode("TextBox13"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox13')] ?? Helper::validate_key_value('second_spouse_employer_city', $debtorspouseemployer); ?>" class="form-control" style="margin-left:6px;">
                            </div>
                            <div class="col-md-6 d-flex pr-0 pl-0">
                                <label style="font-weight:bold">{{ __('State:') }}</label>
                                <input type="text" name="<?php echo base64_encode("TextBox14"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox14')] ?? Helper::validate_key_value('second_spouse_employer_state', $debtorspouseemployer); ?>" class="form-control" style="margin-left:6px;">
                            </div>
                            <div class="col-md-6 d-flex" style="padding-right:8px;">
                                <label style="font-weight:bold">{{ __('Zip:') }}</label>
                                <input type="text" name="<?php echo base64_encode("TextBox15"); ?>" value="<?php echo $partIAdd[base64_encode('TextBox15')] ?? Helper::validate_key_value('second_spouse_employer_zip', $debtorspouseemployer); ?>" class="form-control" style="margin-left:6px;">
                            </div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                 

                                <x-stronglabel label=">{{ __('How long employed:')}}"></x-stronglabel>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group ">
                                    <input name="<?php echo base64_encode("TextBox16"); ?>" type="text" value="<?php echo $partIAdd[base64_encode('TextBox16')] ?? Helper::validate_key_value('spouse_second_employer_job_period', $debtorspouseemployer); ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-5"></div>
                        </div>

                        <div class="row mb-1">
                            <div class="col-md-3">
                                <strong>{{ __('Notes:') }}</strong>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group ">
                                    <textarea name="<?php echo base64_encode("TextBox17"); ?>" class="form-control" rows="4" cols=""><?php echo $partIAdd[base64_encode('TextBox17')] ?? Helper::validate_key_value('notes', $debtorspouseemployer); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </form>
        <?php } ?>
        <div class="row align-items-center avoid-this" style="margin-left:1px;">
            <div class="form-title mb-9" style="margin-top:15px;">
                <button type="submit" onclick="generateIPDF()" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2 print-hide">
                    <span class="card-title-text">{{ __('Generate Schedule I (Income) PDF') }}</span>
                </button>
            </div>
            <div class="form-title mb-9" style="margin-top:15px;">
                <a id="generate_combined_pdf" onclick="printDocument('coles_official-form-106i')" href="javascript:void(0)">
                    <button type="button" style="cursor:pointer; border: 2px solid #012cae; background-color: #fff; color:#012cae; padding:10px; font-weight: bold" class="float-right ml-2  generate_combined">
                        <span class="card-title-text">{{ __('print')}}</span>
                    </button>
                </a>
            </div>
        </div>
    </div>
</section>