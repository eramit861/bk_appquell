<?php

$debtormonthlyincome = $income_info['debtormonthlyincome'];
$gross_average_per_month = \App\Models\IncomeDebtorMonthlyIncome::debtorGrossWagesMonth($debtormonthlyincome);
$debtorspousemonthlyincome = $income_info['debtorspousemonthlyincome'];
$spouse_gross_average_per_month = \App\Models\IncomeDebtorSpouseMonthlyIncome::debtorGrossWagesMonth($debtorspousemonthlyincome);
$dateArray = DateTimeHelper::getMonthYearArray();
$meantestData = !empty($meantestData) ? $meantestData->toArray() : [];
$meantestData = isset($meantestData['mean_test_data']) ? json_decode($meantestData['mean_test_data'], 1) : [];
$editorData = !empty($editorData) ? $editorData->toArray() : [];
$editorData = isset($editorData['data']) ? json_decode($editorData['data'], 1) : [];
?>
<div class="profitlosspopup  profitpopup" style="min-width:1200px;">
    <form name="mean_test_form" id="mean_test_form" method="POST">
        @csrf
        <div class="row no-border-elements">
            <div class="col-5"> <span>Monthly Disposable Income (DMI):</span> <span class="fi_line39c_monthly_disposable_income_first_display">Loading..</span></div>
            <div class="col-7 align-left d-flex">
               
                <h2 class="heading"><strong>{{ __('Meantest details') }}</strong></h2>
                <div class="meantest-img">

                    <img style="display:none;" class="mtp-icon meantest_red" src="{{url('assets/img/like_red.png')}}" alt="Like Red">
                    <img style="display:none;" class="mtp-icon meantest_green" src="{{url('assets/img/like_green.png')}}" alt="Like Green"/>
                </div>
            </div>
            <input type="hidden" name="client_id" value="{{$client_id}}">
           
            <div class="col-2">
           <?php
            $debtorcounty = !empty($address) ? $address->country : '';
?>
            <div class="input-group align-center paralegal form-control no-b pl-0 county-section" style="border:none;">
                    <label>{{ __('County:') }}</label>
                <select name="statecounty" id="selected_county" class="paralegal form-control input-border-imp" style="height: fit-content; margin-top: 8px; margin-right: 2px !important;">
                <option value="">{{ __('Choose County') }}</option>
                <?php foreach ($countyList as $county) {?>
                    <option <?php if ($debtorcounty == $county['id']) {
                        echo "selected";
                    } ?> value="{{$county['id']}}">{{$county['county_name']}}</option>
                <?php }?>
                </select>
                </div>
            </div>
            <div class="col-3"></div>
            <div class="col-2 align-center">
                <div class="input-group paralegal form-control no-b pl-0 hosehold-section" style="border:none;">
                    <label>{{ __('Household Size:') }}</label>
                    <select id="household_size" name="household_size" class="paralegal form-control input-border-imp mr-0 pr-0" style="height: fit-content; margin-top: 8px; margin-right: 2px !important;">
                        <?php foreach (range(1, 15) as $num) { ?>
                            <option <?php echo Helper::validate_key_option('household_size', $editorData, $num); ?> value="<?php echo $num; ?>"><?php echo $num; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-5 text-right">
                <a class="off-btn" href="javascript:void(0)" onclick="saveMeanTestToDb()">
                    <button type="button" class="btn-form float-right ml-2 print-hide">
                        <span class="card-title-text">{{ __('Save Changes') }}</span>
                    </button>
                </a>
                <?php if ($parent == "official_form") { ?>
                <a class="off-btn" onclick="saveMeanTestToDb(true)" href="javascript:void(0)">
                    <button type="button" class="btn-form float-right ml-2 print-hide">
                        <span class="card-title-text">{{ __('Import Income To Petition') }}</span>
                    </button>
                </a>
                <?php }  ?>
                <?php if ($parent == "client_questionnaire") {
                    if (\App\Models\AttorneySubscription::isParalegalAvailable($client_id)) { ?>
                <a class="" href="javascript:void(0)" onclick="showparalegalCheckPopup()">
                    <button type="button" class="btn-form float-right ml-2 print-hide">
                        <span class="card-title-text">Paralegal Check</span>
                    </button>
                </a>
                <?php }
                    } ?>
                <br><br>
                <a class="off-btn" onclick="resetMeanTestPopup()" href="javascript:void(0)">
                    <button type="button" class="btn-form float-right ml-2 print-hide">
                        <span class="card-title-text">{{ __('Reset to Client Questionnaire') }}</span>
                    </button>
                </a>
            </div>
        </div>

        <div class="row no-border-elements">
            <!-- First half-->
            
            
            <div class="col-<?php if (Helper::validate_key_value('client_type', $savedData) != Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED) { ?>6<?php } else { ?>12<?php } ?>">
                <div class="title-details row">
                    <div class="col-5">
                        <h3 class="heading" style="text-decoration:underline;">{{ __("Debtor's Meantest details") }}</h3>
                    </div>
                    <div class="col-7">
                        <div class="text-center btn-cstm-toggle meantest-toggle">
                            <span class="text-gray">{{ __('Average') }}</span>
                            <label class="switch">
                                <input type="checkbox" id="togglecheck" class="slider-default debtor-slider-default" name="graduate_debtor" onchange="getAmountDetails(1)" <?php echo Helper::validate_key_toggle('graduate_debtor', $meantestData, 2); ?> value="<?php echo Helper::validate_key_value('graduate_debtor', $meantestData) == 2 ? '1' : '2'; ?>">
                                <span class="slider round"></span>
                            </label>
                            <span class="text-primary slider-second-text">{{ __('6 month details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11 mt-3">
                        <h4 class="sub-heading">{{ __('Gross wages, salary, tips, bonuses, overtime,commissions') }} </h4>
                    </div>
                    <div class="col-11 w2_income mt-2 hide-data">
                        <div class="input-group no-b">
                            <label>{{ __('Your gross income is the amount before any deductions such as taxes, insurance etc.') }}</label>
                        </div>

                        <div class="row">
                            <div class="col-2 average-details debtor-average-details"></div>
                            <div class="col-2 six-month-details debtor-six-month-details"><strong>{{ __('Month') }}</strong></div>
                            <div class="col-3 "><strong>{{ __('Gross Pay') }}</strong></div>
                            <div class="col-2 pl-0 "><strong>{{ __('Taxes') }}</strong></div>
                            <div class="col-2 pl-0 "><strong>{{ __('Deduction') }}</strong></div>
                            <div class="col-3"><strong>{{ __('Net Income') }}</strong></div>

                            <div class="col-6"></div>
                        </div>
                        <?php
                            if (!empty($debtorpaysData)) {
                                usort($debtorpaysData, function ($a, $b) {
                                    return str_replace('-', 0, $b['pay_period_end']) <=> str_replace('-', 0, $a['pay_period_end']);
                                });
                            }

$dateWisePaystub = [];
if (!empty($debtorpaysData)) {
    foreach ($debtorpaysData as $pays) {
        $dateWisePaystub[$pays['pay_period_end']] = [
            'gross_pay_amount' => $pays['gross_pay_amount'],
            'total_taxes' => $pays['total_taxes'],
            'total_deductions' => $pays['total_deductions'],
            'gross_pay_amount' => $pays['gross_pay_amount'],
        ];
    }
}



$in = 1;
foreach ($dateArray as $key => $val) {
    $monthprice = $dateWisePaystub[$key] ?? 0;

    ?>
                            <div class="row">
                                <div class="col-2 pr-0 six-month-details debtor-six-month-details">
                                    <label class=" price_dots_label">
                                        <span class="price_dots_span"><?php echo $in . '. ' . $val; ?>
                                        </span>
                                        <span class=" font-weight-normal price_dots_span"></span>
                                    </label>
                                </div>
                                <div class="col-3 six-month-details debtor-six-month-details">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="debtor_paystub full-text debtor_gross_{{$in}}_per_month paralegal form-control h20 price-field required" name="debtor_gross_{{$in}}_per_month" value="<?php echo $meantestData['debtor_gross_' . $in . '_per_month'] ?? Helper::priceFormtWithComma($monthprice['gross_pay_amount'] ?? 0); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2  pl-0 six-month-details debtor-six-month-details">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="debtor_paystub full-text debtor_taxes_{{$in}}_per_month paralegal form-control h20 price-field required" name="debtor_taxes_{{$in}}_per_month" value="<?php echo $meantestData['debtor_taxes_' . $in . '_per_month'] ?? Helper::priceFormtWithComma($monthprice['total_taxes'] ?? 0); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2  pl-0 six-month-details debtor-six-month-details">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="debtor_paystub full-text debtor_deduction_{{$in}}_per_month paralegal form-control h20 price-field required" name="debtor_deduction_{{$in}}_per_month" value="<?php echo $meantestData['debtor_deduction_' . $in . '_per_month'] ?? Helper::priceFormtWithComma($monthprice['total_deductions'] ?? 0); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3 pr-0 pl-0 six-month-details debtor-six-month-details">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" readonly class="debtor_paystub  full-text debtor_net_pay_{{$in}}_per_month paralegal form-control h20 price-field required" name="debtor_net_pay_{{$in}}_per_month" value="<?php echo $meantestData['debtor_net_pay_' . $in . '_per_month'] ?? ""; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">

                                </div>
                            </div>
                        <?php $in++;
} ?>

                        <div class="row mt-3 six-month-details debtor-six-month-details">
                            <div class="col-2 mt-2 pr-0">{{ __('Total') }}</div>
                            <div class="col-3">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_gross_total full-text paralegal form-control price-field" name="debtor_gross_total" value="<?php echo Helper::validate_key_value('debtor_gross_total', $meantestData); ?>" />
                                </div>
                            </div>
                            <div class="col-2  pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_taxes_total full-text paralegal form-control price-field" name="debtor_taxes_total" value="<?php echo Helper::validate_key_value('debtor_taxes_total', $meantestData); ?>" />
                                </div>
                            </div>
                            <div class="col-2  pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_deduction_total full-text paralegal form-control price-field" name="debtor_deduction_total" value="<?php echo Helper::validate_key_value('debtor_deduction_total', $meantestData); ?>" />
                                </div>
                            </div>
                            <div class="col-3 pr-0 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_net_total full-text paralegal form-control price-field" name="debtor_net_total" value="<?php echo Helper::validate_key_value('debtor_net_total', $meantestData); ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row cs-bd six-month-average-details debtor-six-month-average-details">
                            <div class="col-2 pr-0 "><strong>Average</strong></div>

                            <div class="col-3">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_gross_avg full-text  paralegal form-control price-field" name="debtor_gross_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_gross_avg', $meantestData)); ?>" />
                                </div>
                            </div>
                            <div class="col-2 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" class="debtor_taxes_avg  full-text paralegal form-control price-field" name="debtor_taxes_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_taxes_avg', $meantestData)); ?>" />
                                </div>
                            </div>
                            <div class="col-2 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_deduction_avg  full-text paralegal form-control price-field" name="debtor_deduction_avg" value="<?php echo  Helper::priceFormtWithComma(Helper::validate_key_value('debtor_deduction_avg', $meantestData)); ?>" />
                                </div>
                            </div>
                            <div class="col-3 pr-0 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="debtor_wages_net_avg  full-text paralegal form-control price-field" name="debtor_wages_net_avg" value="<?php echo  Helper::priceFormtWithComma(Helper::validate_key_value('debtor_wages_net_avg', $meantestData)); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row cs-bd average-details debtor-average-details">
                            <div class="col-2 pr-0 "><strong>Average</strong></div>

                            <div class="col-3">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                   
                                    <input type="text" readonly class="avg_debtor_gross_avg debtor_gross_avg debtor_six_m_avg full-text paralegal form-control price-field" id="debtor_gross_avg" name="avg_debtor_gross_avg" value="<?php echo  Helper::priceFormtWithComma(Helper::validate_key_value('avg_debtor_gross_avg', $meantestData)); ?>" />
                                </div>
                            </div>
                            <div class="col-2 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" class="avg_debtor_taxes_avg debtor_taxes_avg full-text debtor_six_m_avg paralegal form-control price-field" id="debtor_taxes_avg" name="avg_debtor_taxes_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('avg_debtor_taxes_avg', $meantestData)); ?>" />
                                </div>
                            </div>
                            <div class="col-2 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="avg_debtor_deduction_avg debtor_deduction_avg debtor_six_m_avg full-text paralegal form-control price-field" id="debtor_deduction_avg" name="avg_debtor_deduction_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('avg_debtor_deduction_avg', $meantestData));  ?>" />
                                </div>
                            </div>
                            <div class="col-3 pr-0 pl-0">
                                <div class="input-groups d-flex">
                                    <div class="input-group-prepends h20">
                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                    </div>
                                    <input type="text" readonly class="avg_debtor_wages_net_avg debtor_wages_net_avg debtor_six_m_avg full-text paralegal form-control price-field" id="debtor_wages_net_avg" name="avg_debtor_wages_net_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('avg_debtor_wages_net_avg', $meantestData));  ?>" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-10">
                        <div class="row">
                            <div class="col-12 mt-3 mb-2">
                                <h4 class="sub-heading">
                                    <label>
                                        Income from operation of business: <i class="text-c-blue self-class">{{ __('(Self Employment Income)') }}</i>
                                    </label>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-10 opt-bs">
                        <div class="row">
                            <div class="col-3 average-details debtor-average-details">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                            <div class="col-3 six-month-details debtor-six-month-details"><strong>{{ __('Month') }}</strong></div>
                            <div class="col-3"><strong>{{ __('Gross Income') }}</strong></div>
                            <div class="col-3"><strong>{{ __('Expense') }}</strong></div>
                            <div class="col-3"><strong>{{ __('Net Income') }}</strong></div>
                        </div>

                        <?php if (isset($debtormonthlyincome['operation_business']) && $debtormonthlyincome['operation_business'] == 1 && is_array($debtormonthlyincome['income_profit_loss']) && count($debtormonthlyincome['income_profit_loss']) > 0) { ?>
                            <?php
    $total6month = 0;
                            $income_profit_loss = $debtormonthlyincome['income_profit_loss'];
                            $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
                            $i = 1;
                            foreach ($income_profit_loss as $profit) {
                                //print_r($profit);
                                if ($i > 6) {
                                    continue;
                                }
                                if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                                    $dates = explode("-", $profit['profit_loss_month']);
                                    $month_name = date("M", mktime(0, 0, 0, (int)$dates[0], 10));
                                    $total6month = $total6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                                    ?>
                                    <div class="row">
                                        <div class="col-3 six-month-details debtor-six-month-details">
                                            <label class=" price_dots_label">
                                                <span class="price_dots_span"><?php echo $i; ?>.&nbsp;<?php echo $month_name . ', ' . $dates[1]; ?>
                                                </span>
                                                <span class=" font-weight-normal price_dots_span"></span>
                                            </label>
                                        </div>
                                        <div class="col-3 six-month-details debtor-six-month-details">
                                            <div class="form-group-none">
                                                <div class="input-groups d-flex">
                                                    <div class="input-group-prepends h20">
                                                        <span class="input-group-text basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" class="debtor_monthly_income full-text debtor_month_{{$i}}_income debtor_per_month paralegal form-control h20 price-field required" name="debtor_month_{{$i}}_income" value="<?php echo  $meantestData['debtor_month_' . $i . '_income'] ?? (Helper::priceFormtWithComma(Helper::validate_key_value('total_profit_loss', $profit, 'float') + Helper::validate_key_value('total_expense', $profit, 'float'))); ?>" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 six-month-details debtor-six-month-details">
                                            <div class="form-group-none">
                                                <div class="input-groups d-flex">
                                                    <div class="input-group-prepends h20">
                                                        <span class="input-group-text basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" class="debtor_per_month_expense full-text debtor_per_month debtor_month_{{$i}}_expense paralegal form-control h20 price-field required" name="debtor_month_{{$i}}_expense" value="<?php echo $meantestData['debtor_month_' . $i . '_expense'] ?? Helper::validate_key_value('total_expense', $profit, 'comma'); ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 six-month-details debtor-six-month-details" style="margin-top:7px;">
                                            <div class="input-group">
                                                <label><span class="debtor_per_month_net full-text debtor_month_{{$i}}_net"><?php echo Helper::validate_key_value('total_profit_loss', $profit, 'comma'); ?> </span></label>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                            $i++;
                                }
                            }

                            ?>

                            <div class="row mt-3 six-month-details debtor-six-month-details">
                                <div class="col-3 mt-2">{{ __('Total') }}</div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_income_total full-text  paralegal form-control price-field" name="debtor_income_total" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_income_total', $meantestData)); ?>" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_expense_total full-text paralegal form-control price-field" name="debtor_expense_total" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_expense_total', $meantestData)); ?>" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_income_net full-text paralegal form-control price-field" name="debtor_income_net" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_income_net', $meantestData)); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="row cs-bd six-month-average-details debtor-six-month-average-details">
                                <div class="col-3"><strong>Average</strong></div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_income_avg full-text paralegal form-control price-field" name="debtor_income_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_income_avg', $meantestData)); ?>" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_expense_avg full-text paralegal form-control price-field" name="debtor_expense_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_expense_avg', $meantestData)); ?>" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_net_avg full-text paralegal form-control price-field" name="debtor_net_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_net_avg', $meantestData)); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row cs-bd average-details debtor-average-details">
                                <div class="col-3"><strong>Average</strong></div>

                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_income_avg debtor_biz_income_avg debtor_six_m_avg full-text paralegal form-control price-field" id="debtor_income_avg" name="debtor_biz_income_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_biz_income_avg', $meantestData)); ?>" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_expense_avg debtor_biz_expense_avg full-text debtor_six_m_avg paralegal form-control price-field" id="debtor_expense_avg" name="debtor_biz_expense_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_biz_expense_avg', $meantestData)); ?>" />
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="debtor_net_avg debtor_biz_net_avg full-text debtor_six_m_avg paralegal form-control price-field" id="debtor_net_avg" name="debtor_biz_net_avg" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('debtor_biz_net_avg', $meantestData)); ?>" />
                                    </div>
                                </div>
                            </div>

                        <?php } ?>

                        <?php if (isset($debtormonthlyincome['income_profit_loss']['total_profit_loss'])) { ?>
                            <div class="row">
                                <div class="col-6">
                                    <label class="price_dots_label">
                                        <span class="price_dots_span">{{ __('Average (Per month):') }}
                                        </span>
                                        <span class="font-weight-normal price_dots_span">$</span>
                                    </label>
                                </div>
                                <div class="col-6">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="income-price-field full-text paralegal form-control expense h20 price-field required" name="debtor_biz_avg_per_month" value="<?php echo Helper::priceFormtWithComma($meantestData['debtor_biz_avg_per_month'] ?? ($debtormonthlyincome['income_profit_loss']['total_profit_loss'] >= 0 ? $debtormonthlyincome['income_profit_loss']['total_profit_loss'] : abs($debtormonthlyincome['income_profit_loss']['total_profit_loss']))); ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>

                    </div>

                </div>


            </div>
            <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////// -->

            <?php if (Helper::validate_key_value('client_type', $savedData) != Helper::CLIENT_TYPE_INDIVIDUAL_NOT_MARRIED) { ?>
                <!-- Second half-->
                <div class="col-6">
                    <div class="row no-border-elements">
                        <div class="col-5">
                            <h3 class="heading" style="text-decoration:underline;">{{ __("Co-Debtor's Meantest details") }}</h3>
                        </div>
                        <div class="col-7">
                            <div class="text-center btn-cstm-toggle meantest-toggle">
                                <span class="text-gray">{{ __('Average') }}</span>
                                <label class="switch">
                                    <input type="checkbox" id="togglecheck" class="slider-default codebtor-slider-default" name="graduate_codebtor" onchange="getAmountDetails(2)" <?php echo Helper::validate_key_toggle('graduate_codebtor', $meantestData, 2); ?> value="<?php echo Helper::validate_key_value('graduate_codebtor', $meantestData) == 2 ? '1' : '2'; ?>">
                                    <span class="slider round"></span>
                                </label>
                                <span class="text-primary slider-second-text">{{ __('6 month details') }}</span>
                            </div>
                        </div>
                        <div class="col-11 mt-3">
                            <h4 class="sub-heading">{{ __('Gross wages, salary, tips, bonuses, overtime,commissions') }} </h4>
                        </div>
                        <div class="col-11 spouse_w2_income mt-2 hide-data">
                            <div class="input-group no-b">
                                <label> {{ __('Your gross income is the amount before any deductions such as taxes, insurance etc.') }}</label>
                            </div>

                            <div class="row">
                                <div class="col-2 average-details codebtor-average-details"></div>
                                <div class="col-2 six-month-details codebtor-six-month-details"><strong>{{ __('Month') }}</strong></div>
                                <div class="col-3"><strong>{{ __('Gross Pay') }}</strong></div>
                                <div class="col-2 pl-0s"><strong>{{ __('Taxes') }}</strong></div>
                                <div class="col-2 pl-0"><strong>{{ __('Deduction') }}</strong></div>
                                <div class="col-3"><strong>{{ __('Net Income') }}</strong></div>

                                <div class="col-6"></div>
                            </div>
                            <?php


                            $spousedateWisePaystub = [];
                if (!empty($spousepaysData)) {
                    foreach ($spousepaysData as $spays) {
                        $spousedateWisePaystub[$spays['pay_period_end']] = [
                            'gross_pay_amount' => $spays['gross_pay_amount'],
                            'total_taxes' => $spays['total_taxes'],
                            'total_deductions' => $spays['total_deductions'],
                            'gross_pay_amount' => $spays['gross_pay_amount'],
                        ];
                    }
                }
                $si = 1;
                foreach ($dateArray as $key => $val) {
                    $spousemonthprice = $spousedateWisePaystub[$key] ?? 0;
                    ?>
                                <div class="row">
                                    <div class="col-2 pr-0 six-month-details codebtor-six-month-details">
                                        <label class=" price_dots_label">
                                            <span class="price_dots_span"><?php echo  $si . '. ' . $val; ?>
                                            </span>
                                            <span class=" font-weight-normal price_dots_span"></span>
                                        </label>
                                    </div>
                                    <div class="col-3 six-month-details codebtor-six-month-details">
                                        <div class="form-group-none">
                                            <div class="input-groups d-flex">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1">$</span>
                                                </div>
                                                <input type="text" class="spouse_paystub  full-text spouse_gross_{{$si}}_per_month paralegal form-control h20 price-field required" name="spouse_gross_{{$si}}_per_month" value="<?php echo $meantestData['spouse_gross_' . $si . '_per_month'] ?? Helper::priceFormtWithComma(Helper::validate_key_value('gross_pay_amount', $spousemonthprice, 'float')); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2  pl-0 six-month-details codebtor-six-month-details">
                                        <div class="form-group-none">
                                            <div class="input-groups d-flex">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1">$</span>
                                                </div>
                                               
                                                <input type="text" class="spouse_paystub  full-text spouse_taxes_{{$si}}_per_month paralegal form-control h20 price-field required" name="spouse_taxes_{{$si}}_per_month" value="<?php echo $meantestData['spouse_taxes_' . $si . '_per_month'] ?? Helper::priceFormtWithComma(Helper::validate_key_value('total_taxes', $spousemonthprice, 'float')); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2  pl-0 six-month-details codebtor-six-month-details">
                                        <div class="form-group-none">
                                            <div class="input-groups d-flex">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1">$</span>
                                                </div>
                                                <input type="text" class="spouse_paystub  full-text spouse_deduction_{{$si}}_per_month paralegal form-control h20 price-field required" name="spouse_deduction_{{$si}}_per_month" value="<?php echo $meantestData['spouse_deduction_' . $si . '_per_month'] ?? Helper::priceFormtWithComma(Helper::validate_key_value('total_deductions', $spousemonthprice, 'float')); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3 pr-0 pl-0  six-month-details codebtor-six-month-details">
                                        <div class="form-group-none">
                                            <div class="input-groups d-flex">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1">$</span>
                                                </div>
                                                <input type="text" readonly class="spouse_paystub  full-text spouse_net_pay_{{$si}}_per_month paralegal form-control h20 price-field required" name="spouse_net_pay_{{$si}}_per_month" value="<?php echo $meantestData['spouse_net_pay_' . $si . '_per_month'] ?? (Helper::priceFormtWithComma(Helper::validate_key_value('gross_pay_amount', $spousemonthprice, 'float') - Helper::validate_key_value('total_taxes', $spousemonthprice, 'float') - Helper::validate_key_value('total_deductions', $spousemonthprice, 'float'))); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">

                                    </div>
                                </div>
                            <?php $si++;
                } ?>


                            <div class="row mt-3  six-month-details codebtor-six-month-details">
                                <div class="col-2 mt-2 pr-0">{{ __('Total') }}</div>
                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_gross_total full-text paralegal form-control price-field" name="spouse_gross_total" value="<?php echo Helper::validate_key_value('spouse_gross_total', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-2 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_taxes_total full-text paralegal form-control price-field" name="spouse_taxes_total" value="<?php echo Helper::validate_key_value('spouse_taxes_total', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-2 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_deduction_total full-text paralegal form-control price-field" name="spouse_deduction_total" value="<?php echo Helper::validate_key_value('spouse_deduction_total', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-3 pr-0 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_net_total full-text paralegal form-control price-field" name="spouse_net_total" value="<?php echo Helper::validate_key_value('spouse_net_total', $meantestData); ?>" />
                                    </div>
                                </div>
                            </div>

                            <div class="row cs-bd six-month-average-details codebtor-six-month-average-details">
                                <div class="col-2 pr-0"><strong>Average</strong></div>

                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_gross_avg full-text paralegal form-control price-field" name="spouse_gross_avg" value="<?php echo Helper::validate_key_value('spouse_gross_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-2 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_taxes_avg full-text paralegal form-control price-field" name="spouse_taxes_avg" value="<?php echo Helper::validate_key_value('spouse_taxes_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-2 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_deduction_avg full-text paralegal form-control price-field" name="spouse_deduction_avg" value="<?php echo Helper::validate_key_value('spouse_deduction_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-3 pr-0 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_wages_net_avg  full-text paralegal form-control price-field" name="spouse_wages_net_avg" value="<?php echo Helper::validate_key_value('spouse_wages_net_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row cs-bd cs-bd average-details codebtor-average-details">
                                <div class="col-2 pr-0"><strong>Average</strong></div>

                                <div class="col-3">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_gross_avg avg_spouse_gross_avg spouse_six_m_avg full-text paralegal form-control price-field" id="spouse_gross_avg" name="avg_spouse_gross_avg" value="<?php echo Helper::validate_key_value('avg_spouse_gross_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-2 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" class="spouse_taxes_avg full-text avg_spouse_taxes_avg spouse_six_m_avg paralegal form-control price-field" id="spouse_taxes_avg" name="avg_spouse_taxes_avg" value="<?php echo Helper::validate_key_value('avg_spouse_taxes_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-2 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_deduction_avg full-text avg_spouse_deduction_avg spouse_six_m_avg paralegal form-control price-field" id="spouse_deduction_avg" name="avg_spouse_deduction_avg" value="<?php echo Helper::validate_key_value('avg_spouse_deduction_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                                <div class="col-3 pr-0 pl-0">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                        </div>
                                        <input type="text" readonly class="spouse_wages_net_avg  avg_spouse_wages_net_avg full-text spouse_six_m_avg paralegal form-control price-field" id="spouse_wages_net_avg" name="avg_spouse_wages_net_avg" value="<?php echo Helper::validate_key_value('avg_spouse_wages_net_avg', $meantestData); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-12 mt-3 mb-2">
                                    <h4 class="sub-heading"><label>Income from operation of business: <i class="text-c-blue self-class">{{ __('(Self Employment Income)') }}</i></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-10">
                            <div class="row">
                                <div class="col-3 average-details codebtor-average-details">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="col-3 six-month-details codebtor-six-month-details"><strong>{{ __('Month') }}</strong></div>
                                <div class="col-3"><strong>{{ __('Gross Income') }}</strong></div>
                                <div class="col-3 "><strong>{{ __('Expense') }}</strong></div>
                                <div class="col-3"><strong>{{ __('Net Income') }}</strong></div>
                            </div>
                            <?php

                if (isset($debtorspousemonthlyincome['joints_operation_business']) && $debtorspousemonthlyincome['joints_operation_business'] == 1 && isset($debtorspousemonthlyincome['income_profit_loss']) && is_array($debtorspousemonthlyincome['income_profit_loss']) && count($debtorspousemonthlyincome['income_profit_loss']) > 0) {
                    $total6month = 0;
                    $income_profit_loss = $debtorspousemonthlyincome['income_profit_loss'];
                    $income_profit_loss = DateTimeHelper::getIncomeDescArray($income_profit_loss);
                    $i = 1;
                    foreach ($income_profit_loss as $profit) {
                        // print_r($profit);
                        if ($i > 6) {
                            continue;
                        }
                        if (isset($profit['profit_loss_month']) && !empty($profit['profit_loss_month'])) {
                            $dates = explode("-", $profit['profit_loss_month']);

                            $month_name = date("M", mktime(0, 0, 0, (int)$dates[0], 10));
                            $total6month = $total6month + Helper::validate_key_value('total_profit_loss', $profit, 'float');
                            ?>

                                        <div class="row">
                                            <div class="col-3 six-month-details codebtor-six-month-details">
                                                <label class=" price_dots_label">
                                                    <span class="price_dots_span"><?php echo $i; ?>.&nbsp;<?php echo $month_name . ', ' . $dates[1]; ?>
                                                    </span>
                                                    <span class=" font-weight-normal price_dots_span"></span>
                                                </label>
                                            </div>
                                            <div class="col-3 six-month-details codebtor-six-month-details">
                                                <div class="form-group-none">
                                                    <div class="input-groups d-flex">
                                                        <div class="input-group-prepends h20">
                                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                        </div>
                                                        <input type="text" class="spouse_monthly_income full-text spouse_per_month spouse_month_{{$i}}_income paralegal form-control h20 price-field required" name="spouse_month_{{$i}}_income" value="<?php echo  $meantestData['spouse_month_' . $i . '_income'] ?? (Helper::priceFormtWithComma(Helper::validate_key_value('total_profit_loss', $profit, 'float') + Helper::validate_key_value('total_expense', $profit, 'float'))); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 six-month-details codebtor-six-month-details">
                                                <div class="form-group-none">
                                                    <div class="input-groups d-flex">
                                                        <div class="input-group-prepends h20">
                                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                        </div>
                                                        <input type="text" class="spouse_monthly_expense full-text spouse_per_month_expense spouse_per_month spouse_month_{{$i}}_expense paralegal form-control h20 price-field required" name="spouse_month_{{$i}}_expense" value="<?php echo $meantestData['spouse_month_' . $i . '_expense'] ?? Helper::validate_key_value('total_expense', $profit, 'comma'); ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 six-month-details codebtor-six-month-details" style="margin-top:7px;">
                                                <div class="input-group">
                                                    <label>$<span class="spouse_month_{{$i}}_net full-text spouse_per_month_net"><?php echo Helper::validate_key_value('total_profit_loss', $profit, 'comma'); ?> </span></label>
                                                </div>
                                            </div>
                                        </div>

                                <?php
                                        $i++;
                        }
                    }


                    ?>
                                <div class="row mt-3 six-month-details codebtor-six-month-details">
                                    <div class="col-3 mt-2">{{ __('Total') }}</div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_income_total full-text paralegal form-control price-field" name="spouse_income_total" value="<?php echo Helper::validate_key_value('spouse_income_total', $meantestData); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_expense_total full-text paralegal form-control price-field" name="spouse_expense_total" value="<?php echo Helper::validate_key_value('spouse_expense_total', $meantestData); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_income_net full-text paralegal form-control price-field" name="spouse_income_net" value="<?php echo Helper::validate_key_value('spouse_income_net', $meantestData); ?>" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row cs-bd six-month-average-details codebtor-six-month-average-details">
                                    <div class="col-3"><strong>Average</strong></div>

                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_income_avg full-text paralegal form-control price-field" name="spouse_income_avg" value="<?php echo Helper::validate_key_value('spouse_income_avg', $meantestData); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_expense_avg full-text paralegal form-control price-field" name="spouse_expense_avg" value="<?php echo Helper::validate_key_value('spouse_expense_avg', $meantestData); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_net_avg full-text paralegal form-control price-field" name="spouse_net_avg" value="<?php echo Helper::validate_key_value('spouse_net_avg', $meantestData); ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row cs-bd average-details codebtor-average-details">
                                    <div class="col-3"><strong>Average</strong></div>

                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_income_avg spouse_biz_income spouse_six_m_avg full-text paralegal form-control price-field" id="spouse_income_avg" name="spouse_biz_income" value="<?php echo Helper::validate_key_value('spouse_biz_income', $meantestData); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_expense_avg spouse_biz_expense spouse_six_m_avg full-text paralegal form-control price-field" id="spouse_expense_avg" name="spouse_biz_expense" value="<?php echo Helper::validate_key_value('spouse_biz_expense', $meantestData); ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                            </div>
                                            <input type="text" readonly class="spouse_net_avg spouse_biz_net spouse_six_m_avg full-text paralegal form-control price-field" id="spouse_net_avg" name="spouse_biz_net" value="<?php echo Helper::validate_key_value('spouse_biz_net', $meantestData); ?>" />
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if (isset($debtorspousemonthlyincome['income_profit_loss']['total_profit_loss'])) { ?>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="price_dots_label">
                                            <span class="price_dots_span"> {{ __('Last 6 month Average:') }}
                                            </span>
                                            <span class="font-weight-normal price_dots_span"></span>
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group-none">
                                            <div class="input-groups d-flex">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1">$</span>
                                                </div>
                                                <input type="text" class="income-price-field full-text paralegal form-control expense h20 price-field required" name="spouse_biz_per_month_avg" value="<?php echo $meantestData['spouse_biz_per_month_avg'] ?? ($debtorspousemonthlyincome['income_profit_loss']['total_profit_loss'] >= 0 ? $debtorspousemonthlyincome['income_profit_loss']['total_profit_loss'] : abs($debtorspousemonthlyincome['income_profit_loss']['total_profit_loss'])); ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="col-12 mt-3">
                <?php
                $part2Array = [
                    ['key' => "16. Taxes", 'id' => 'Taxes', 'fieldname' => base64_encode('B_122A-2-undefined_48'), 'title' => 'Federal, state, and local taxes. Do not include Do not include real estate, sales, or use taxes.'],
                    ['key' => "17. Involuntary deductions", 'id' => 'involuntary_deductions', 'fieldname' => base64_encode('B_122A-2-undefined_49'), 'title' => 'Payroll deductions that your job requires, such as retirement contributions, union dues, and uniform costs. (Do not include non-mandatory items: such as voluntary 401(k) contributions or payroll savings.)'],
                    ['key' => "18. Term Life Insurance", 'id' => 'term_life_insurance', 'fieldname' => base64_encode('B_122A-2-undefined_50'), 'title' => 'The total monthly premiums that debtors pay for their own insurance. (If joint filing, include spouse’s insurance also. Do not include dependents, or a non-filing spouse.'],
                    ['key' => "19. Court-ordered payments", 'id' => 'court_ordered_payments', 'fieldname' => base64_encode('B_122A-2-undefined_51'), 'title' => "Alimony child support and other court ordered payments. (Only enter current court ordered monthly payments, past due priority payments don't get listed here.)"],
                    ['key' => "20. Education for...", 'id' => 'education', 'fieldname' => base64_encode('B_122A-2-undefined_52'), 'title' => 'Education expenses for: as a condition for your job or dependent children physically or mentally challenged dependent child.'],
                    ['key' => "21. Child care", 'id' => 'child_care', 'fieldname' => base64_encode('B_122A-2-undefined_53'), 'title' => 'The total monthly amount that you pay for childcare, such as babysitting, daycare, nursery, and preschool. Do not include payments for any elementary or secondary school education.'],
                    ['key' => "23. Telecommunication", 'id' => 'telecommunication', 'fieldname' => base64_encode('B_122A-2-undefined_55'), 'title' => 'The total monthly telecommunication services, such as pagers, call waiting, caller identification, special long distance, or business cell phone service, to the extent necessary for your health and welfare or that of your dependents or to produce income, if it is not reimbursed by your employer'],
                ];
?>
                <div class="row">

                    <div class="col-10">
                        <h3 class="heading">{{ __('Expenses:') }}</h3>
                        <h4 class="sub-heading">{{ __('Part 2 of 122A-2: Calculate Deductions for Other Necessary Expenses') }}</h4>
                    </div>
                </div>
                <?php foreach ($part2Array as $field) { ?>
                    <div class="row">

                        <div class="col-12">

                            <div class="row">
                                <div class="col-2 pr-0" style="margin-top:8px;">
                                    <label class=" price_dots_label">
                                        <span class="price_dots_span"><?php echo $field['key']; ?>
                                        </span>
                                        <span class=" font-weight-normal price_dots_span"></span>
                                    </label>
                                </div>
                                @if ($field['key'] == '16. Taxes')
                                <div class="col-1">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" readonly class="netAvgTax paralegal form-control full-text h20 price-field required" name="<?php echo $field['fieldname']; ?>" value="<?php echo $meantestData[$field['fieldname']] ?? ''; ?>" />
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-1">
                                    <div class="form-group-none">
                                        <div class="input-groups d-flex">
                                            <div class="input-group-prepends h20">
                                                <span class="input-group-text basic-addon1">$</span>
                                            </div>
                                            <input type="text" class="paralegal form-control full-text h20 price-field required" name="<?php echo $field['fieldname']; ?>" id="{{$field['id']}}" value="<?php echo $meantestData[$field['fieldname']] ?? ''; ?>" />
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-9">
                                    <div class="form-group-none" style="margin-top:8px;">
                                        <?php echo $field['title']; ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>



                <div class="row">
                    <div class="col-10 mt-3 mb-2">
                        <h4 class="sub-heading">{{ __('Part 2 of 122A-2: Calculate Deductions for Additional Expenses') }}</h4>
                    </div>
                </div>
                <div class="row">

                    <div class="col-3">

                        <div class="row">
                            <div class="col-12 pr-0">
                                <label class=" price_dots_label">
                                    <span class="price_dots_span">{{ __('25. Health Insurance, Disability Insurance, Health Savings') }}
                                    </span>
                                    <span class=" font-weight-normal price_dots_span"></span>
                                </label>
                            </div>

                            <!-- Health Insurance -->
                            <div class="col-8 pr-0" style="margin-top:8px;">
                                <label class=" price_dots_label">
                                    <span class="price_dots_span">{{ __('Health Insurance') }}
                                    </span>
                                    <span class=" font-weight-normal price_dots_span"></span>
                                </label>
                            </div>
                            <div class="col-4">
                                <div class="form-group-none">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control full-text health_field health_insurance h20 price-field required" name="<?php echo base64_encode('B_122A-2-undefined_57'); ?>" value="<?php echo $meantestData[base64_encode('B_122A-2-undefined_57')] ?? ''; ?>" />
                                    </div>
                                </div>
                            </div>

                            <!-- Health Insurance -->

                            <!-- Disability Insurance -->
                            <div class="col-8 pr-0" style="margin-top:8px;">
                                <label class=" price_dots_label">
                                    <span class="price_dots_span"> {{ __('Disability Insurance') }}
                                    </span>
                                    <span class=" font-weight-normal price_dots_span"></span>
                                </label>
                            </div>
                            <div class="col-4">
                                <div class="form-group-none">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control full-text health_field disability_insurance h20 price-field required" name="<?php echo base64_encode('B_122A-2-undefined_58'); ?>" value="<?php echo $meantestData[base64_encode('B_122A-2-undefined_58')] ?? ''; ?>" />
                                    </div>
                                </div>
                            </div>



                            <!-- Disability Insurance -->

                            <!-- Health Savings Accounts -->
                            <div class="col-8 pr-0" style="margin-top:8px;">
                                <label class=" price_dots_label">
                                    <span class="price_dots_span">{{ __('Health Savings Accounts') }}
                                    </span>
                                    <span class=" font-weight-normal price_dots_span"></span>
                                </label>
                            </div>
                            <div class="col-4">
                                <div class="form-group-none">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control full-text health_field health_saving_account h20 price-field required" name="<?php echo base64_encode('B_122A-2-1_2'); ?>" value="<?php echo $meantestData[base64_encode('B_122A-2-1_2')] ?? ''; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 pr-0 mt-3">
                                <strong>Total</strong>
                            </div>
                            <div class="col-4 mt-2 cs-bd">
                                <div class="form-group-none">
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" readonly class="paralegal form-control full-text healthcare_total h20 price-field required" name="healthcare_total" value="<?php echo $meantestData['healthcare_total'] ?? ''; ?>" />
                                    </div>
                                </div>
                            </div>
                            <!-- Health Savings Accounts -->
                        </div>
                    </div>
                    <div class="col-9">
                        <?php
        $part2Array = [
            ['key' => "26. Care and support of elderly, chronically ill or disabled", 'id' => 'care_and_support', 'fieldname' => base64_encode('B_122A-2-undefined_61'), 'title' => ''],
            ['key' => "27. Protection against family violence", 'id' => 'protection_against', 'fieldname' => base64_encode('B_122A-2-undefined_62'), 'title' => ''],
            ['key' => "28. Home energy costs in excess of the allowance", 'id' => 'home_energy_costs', 'fieldname' => base64_encode('B_122A-2-undefined_63'), 'title' => ''],
            ['key' => "29. Education expenses for dependent children less than 18", 'id' => 'education_expenses', 'fieldname' => base64_encode('B_122A-2-undefined_64'), 'title' => ''],
            ['key' => "30. Additional food and clothing expense", 'id' => 'food_and_clothing_expense', 'fieldname' => base64_encode('B_122A-2-undefined_65'), 'title' => ''],
            ['key' => "31. Charitable contributions", 'id' => 'charitable_contribution', 'fieldname' => base64_encode('B_122A-2-undefined_66'), 'title' => ''],
        ];
?>
                        <?php foreach ($part2Array as $field) { ?>
                            <div class="row">

                                <div class="col-12">

                                    <div class="row">
                                        <div class="col-6 pr-0">
                                            <label class=" price_dots_label">
                                                <span class="price_dots_span"><?php echo $field['key']; ?>
                                                </span>
                                                <span class=" font-weight-normal price_dots_span"></span>
                                            </label>
                                        </div>
                                        <div class="col-1 pr-0 pl-0">
                                            <div class="form-group-none">
                                                <div class="input-groups d-flex">
                                                    <div class="input-group-prepends h20">
                                                        <span class="input-group-text basic-addon1">$</span>
                                                    </div>
                                                    <input type="text" class="paralegal form-control full-text h20 price-field required" id="{{ $field['id'] }}" name="<?php echo $field['fieldname']; ?>" value="<?php echo $meantestData[$field['fieldname']] ?? ''; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-5">
                                            <div class="form-group-none" style="padding-left:10px;margin-top:8px;">
                                                <?php echo $field['title']; ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-underline">
                <span class="headingtexdt">{{ __('Secured Debt Claims') }}</span> <span class="smallh">(Deductions for Debt Payments)</span> <span class="headingtexdt">:</span>

            </div>

            <div class="col-6">

                <div class="row no-border-elements">
                    <div class="col-12">

                        <h5 class="mt-2 payment-mtgr">{{ __('Mortgages:') }} </h5>
                    </div>
                    <div class="col-12 mb-2 headingpm">
                        <div class="row">

                            <div class="col-4 mt-2  pr-0">
                                <strong>{{ __('Property/Creditor') }}</strong>
                            </div>






                            <div class="col-2 mt-2  pr-0">
                                <strong><label>{{ __('Monthly Payment') }}</label></strong>
                            </div>
                            <div class="col-2 mt-2  pr-0">
                                <strong>{{ __('Past Due') }}</strong>
                            </div>
                            <div class="col-2 mt-2 ">
                                <strong> <label>{{ __('Remaining Payments') }}</label></strong>
                            </div>
                            <div class="col-2 mt-2 ">
                                <strong> <label>Total</label></strong>
                            </div>
                        </div>
                    </div>

                    <?php
                    $loans = [];
$clientPrimaryAddress = '';

if ($address) {
    $clientPrimaryAddress = $address->Address . ", " . $address->City . ", " . $address->zip . ", " . \App\Models\CountyFipsData::get_county_name_by_id($address->country);
}
$keyind = 1;

foreach ($mortgages as $k => $resident) {

    if ($resident['not_primary_address'] == 1) {
        $clientPrimaryAddress = $resident['mortgage_address'] . ", " . $resident['mortgage_city'] . ", " . $resident['mortgage_state'] . ", " . $resident['mortgage_zip'];
    }
    $loan1 = json_decode($resident['home_car_loan'], 1);
    $loan2 = json_decode($resident['home_car_loan2'], 1);
    $loan3 = json_decode($resident['home_car_loan3'], 1);
    if (isset($resident['loan_own_type_property']) && $resident['loan_own_type_property'] == 1) {
        $loans = ['loan1' => $loan1];
    }
    if (isset($loan2['additional_loan1']) && $loan2['additional_loan1'] == 1) {
        $loans['loan2'] = $loan2;
    }
    if (isset($loan3['additional_loan2']) && $loan3['additional_loan2'] == 1) {
        $loans['loan3'] = $loan3;
    }

    if (!empty($loans)) {
        ?>

                            <div class="col-12 headingpm">
                                Property Address: {{ $clientPrimaryAddress }}
                                <input type="hidden" name="resident_property_{{$keyind}}" value="<?php echo Helper::validate_key_value("resident_property_" . $keyind, $meantestData); ?>">
                            </div>
                            <?php $mindex = 1;
        foreach ($loans as $loan) { ?>
                                <div class="col-12 mb-2">
                                    <div class="row">

                                        <div class="col-4 mt-2">
                                            <span class="text-underline creditors">Mortgage {{$mindex}}</span>
                                            <span class="creditors">
                                                {{$loan['creditor_name']}} </span>
                                        </div>
                                        <input type="hidden" name="resident_mortgage_{{$mindex}}_{{$keyind}}" value="<?php echo $loan['creditor_name']; ?>">

                                        <div class="col-2 mt-2">
                                            <div class="form-group d-flex">

                                                <div class="input-groups d-flex ml-2">
                                                    <div class="input-group-prepends h20">
                                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                    </div>
                                                    <input type="text" class="paralegal form-control mortgage-monthly-payments price-field full-text required" name="mortgage_monthly_pay{{$mindex}}_{{$keyind}}" value="<?php echo Helper::priceFormtWithComma($meantestData['mortgage_monthly_pay' . $mindex . '_' . $keyind] ?? ($loan['monthly_payment'] ? $loan['monthly_payment'] : 0.00)); ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2 mt-2">
                                            <div class="payment-box">
                                                <div class="form-group d-flex">

                                                    <div class="input-groups d-flex ml-2">
                                                        <div class="input-group-prepends h20">
                                                            <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                        </div>
                                                        <input type="text" readonly class="paralegal form-control price-field full-text required" name="mortgage_due{{$mindex}}_{{$keyind}}" value="<?php echo Helper::priceFormtWithComma($meantestData['mortgage_due' . $mindex . '_' . $keyind] ?? ((isset($loan['due_payment'])) ? $loan['due_payment'] : 0.00)); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-2 mt-2 ">
                                            <div class="form-group d-flex">
                                                <?php

                            $pr = (isset($meantestData['mortgage_payment_remaining_' . $mindex . '_' . $keyind]) && !empty($meantestData['mortgage_payment_remaining_' . $mindex . '_' . $keyind])) ? $meantestData['mortgage_payment_remaining_' . $mindex . '_' . $keyind] : null;
            ?>
                                                <div class="input-groups d-flex ml-2">
                                                    <select class="paralegal form-control input-border-imp mortgage-select mortgage_payment-remaining-number" name="mortgage_payment_remaining_{{$mindex}}_{{$keyind}}">
                                                        <?php foreach (range(1, 60) as $no) { ?>
                                                            <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>"><?php echo $no; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-2 mt-2 ">
                                            <div class="form-group d-flex">

                                                <div class="input-groups d-flex ml-2">
                                                    <div class="input-group-prepends h20">
                                                        <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                    </div>
                                                    <input type="text" readonly class="paralegal form-control price-field full-text required mortgage-payment-total" name="mortgage_total{{$mindex}}_{{$keyind}}" value="<?php echo Helper::priceFormtWithComma($meantestData['mortgage_total' . $mindex . '_' . $keyind] ?? 0.00); ?>">
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            <?php $mindex++;
        } ?>

                    <?php $keyind++;
    }
} ?>
                </div>
            </div>

            <div class="col-6">
                <?php if (count($vehicleMortgage) > 0) { ?>
                    <div class="row no-border-elements">
                        <div class="col-12">
                            <h5 class="mt-2 payment-mtgr">{{ __('Vehicles:') }}</h5>
                        </div>
                        <div class="col-12  mb-2 headingpm">
                            <div class="row">
                                <div class="col-4 mt-2 ">
                                    <strong> <label>{{ __('Vehicle Name') }}<br>{{ __('/Creditor') }}</label></strong>
                                </div>

                                <div class="col-2 mt-2  pr-0">
                                    <strong><label>Monthly Payment</label></strong>
                                </div>
                                <div class="col-2 mt-2 ">
                                    <strong><label>{{ __('Past due') }}</label></strong>
                                </div>
                                <div class="col-2 mt-2  pr-0">
                                    <strong><label>Remaining Payments</label></strong>
                                </div>

                                <div class="col-2 mt-2 ">
                                    <strong><label>Total</label></strong>
                                </div>

                            </div>
                        </div>
                        <?php $countVehicle = 0;
                    $veh = 1;
                    $recnal = 1;
                    ?>
                        <?php foreach ($vehicleMortgage as $key => $mortgage) {



                            $vehicle_loan = [];
                            if (($mortgage->vehicle_car_loan) != null) {
                                $vehicle_loan[] = json_decode($mortgage->vehicle_car_loan);
                                $vehicle_obj = $vehicle_loan[0];
                            }
                            ?>
                        <?php if (isset($vehicle_obj) && !empty($vehicle_obj)) { ?>
                            <div class="col-12 mb-2">
                                <div class="row">

                                    <div class="col-12 headingpm pr-0">
                                        <?php
                                            $vehicleType = 'Vehicle 1';
                            if ($mortgage->property_type == Helper::VEHICLE_RECREATINAL_VEHICLE) {
                                $vehicleType = 'Recreational ' . $recnal;
                                echo ' <span style="font-size:14px;">' . $vehicleType . ':&nbsp;</span>';
                            } ?>
                                        <?php if ($mortgage->property_type == Helper::VEHICLE_CARS_TK) {
                                            $vehicleType = 'Vehicle ' . $veh;
                                            echo ' <span style="font-size:14px;">' . $vehicleType . ':&nbsp;</span>';
                                        }
                            $vehicleName = $mortgage->property_make . ', ' . $mortgage->property_model;
                            $vehicleNameTobeSave = $vehicleType;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_year;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_make;
                            $vehicleNameTobeSave .= ', ' . $mortgage->property_model;
                            $vehicleNameTobeSave .= ', ' .$mortgage->property_mileage;
                            $vehicleNameTobeSave .= ', ' .$mortgage->property_other_info;
                            if (!empty($mortgage->vin_number)) {
                                $vehicleNameTobeSave .= ', Vin # ' . $mortgage->vin_number;
                            }
                            $creditorname = isset($vehicle_obj->creditor_name) && !empty($vehicle_obj->creditor_name) ? $vehicle_obj->creditor_name : 'Unknown Creditor';
                            ?>
                                        <span class="">{{$vehicleName}}</span>
                                        <input type="hidden" name="vehicle_name_{{$countVehicle}}" value="<?php echo $vehicleNameTobeSave ?>">
                                        <input type="hidden" name="vehicle_type_{{$countVehicle}}" value="{{$mortgage->property_type}}">
                                    </div>
                                    <div class="col-4 mt-2 pr-0">

                                        <span class="creditors mt-2">Creditor: {{$creditorname}} </span>
                                        <input type="hidden" name="vehicle_creditor_{{$countVehicle}}" value="<?php echo $creditorname ?>">
                                    </div>

                                    <div class="col-2 mt-2 ">
                                        <div class="form-group d-flex">

                                            <div class="input-groups d-flex ml-2">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                </div>
                                                <input type="text" class="paralegal form-control price-field full-text required monthly-payments" name="monthly_payment_{{$countVehicle}}" value="<?php echo $meantestData['monthly_payment_' . $countVehicle] ?? ($vehicle_obj->monthly_payment ?? ''); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-2 mt-2 ">
                                        <div class="form-group d-flex">
                                            <div class="input-groups d-flex ml-2">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                </div>
                                                <input type="text" readonly class="paralegal form-control price-field full-text required" name="past_due_{{$countVehicle}}" value="<?php echo Helper::priceFormtWithComma($meantestData['past_due_' . $countVehicle] ?? ($vehicle_obj->past_due_amount ?? '')); ?>">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-2 mt-2 ">
                                        <div class="form-group d-flex">
                                            <?php
                                $pr = $vehicle_obj->payment_remaining ?? '';
                            $pr = (isset($meantestData['property_vehicle_payment_remaining_' . $countVehicle]) && !empty($meantestData['property_vehicle_payment_remaining_' . $countVehicle])) ? $meantestData['property_vehicle_payment_remaining_' . $countVehicle] : $pr;
                            ?>
                                            <div class="input-groups d-flex ml-2">
                                                <select class="paralegal form-control payment-remaining-number input-border-imp mortgage-select" name="property_vehicle_payment_remaining_{{$countVehicle}}">
                                                    <?php foreach (range(1, 60) as $no) { ?>
                                                        <option <?php echo $no == $pr ? "selected" : ''; ?> value="<?php echo $no; ?>"><?php echo $no; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-2 ">
                                        <div class="form-group d-flex">

                                            <div class="input-groups d-flex ml-2">
                                                <div class="input-group-prepends h20">
                                                    <span class="input-group-text basic-addon1 dollar-pt-1">$</span>
                                                </div>
                                                <input type="text" readonly class="paralegal form-control price-field full-text required vehicle-payment-total" name="property_vehicle_payment_total_{{$countVehicle}}" value="<?php echo Helper::priceFormtWithComma($meantestData['property_vehicle_payment_total_' . $countVehicle] ?? ((isset($vehicle_obj->monthly_payment) && $vehicle_obj->monthly_payment > 0 && $vehicle_obj->payment_remaining > 0 ? $vehicle_obj->monthly_payment * $vehicle_obj->payment_remaining : 0))); ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        <?php
                            if ($mortgage->property_type == Helper::VEHICLE_CARS_TK) {
                                $veh = $veh + 1;
                            }
                            if ($mortgage->property_type == Helper::VEHICLE_RECREATINAL_VEHICLE) {
                                $recnal = $recnal + 1;
                            }
                            $countVehicle = $countVehicle + 1;
                        } ?>

                    </div>
                <?php } ?>

            </div>
        </div>
        <!-- <div class="row">

            <div class="col-6">
                <div class="row no-border-elements">
                    <div class="col-12">
                        <h3 class="mt-2">{{ __('Priority Debt Claims:') }} </h3>
                    </div>
                </div>

                <div class="row headingpm">
                    <div class="col-3">
                        <span class=" creditors"> {{ __('Back Taxes') }} </span>
                    </div>
                    <div class="col-4">
                        <span class=" creditors"> {{ __('Domestic Support Obligations') }}</span>
                    </div>
                    <div class="col-2">
                        <span class=" creditors"> {{ __('Other') }} </span>
                    </div>
                    <div class="col-3">
                        <span class="creditors"> {{ __('Student Loans') }} </span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="row">

                            <div class="col-3 mt-2">
                                <div class="form-group d-flex">

                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" id="claim_taxes" name="claim_taxes" value="<?php echo Helper::validate_key_value('claim_taxes', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-4 mt-2">
                                <div class="form-group d-flex">

                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" id="claim_obligations" name="claim_obligations" value="<?php echo Helper::validate_key_value('claim_obligations', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-2 mt-2">
                                <div class="form-group d-flex">
                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" id="claim_other" name="claim_other" value="<?php echo Helper::validate_key_value('claim_other', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-3 mt-2">
                                <div class="form-group d-flex">
                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" id="claim_student_loans" name="claim_student_loans" value="<?php echo Helper::validate_key_value('claim_student_loans', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="col-6">
                <div class="row ">
                    <div class="col-12">
                        <h5 class="mt-2 payment-mtgr">{{ __('Other Secured Debts:') }}</h5>
                    </div>
                </div>
                <div class="row no-border-elements  headingpm">

                    <div class="col-4">
                        <span class="creditors">{{ __('Creditor Name:') }} </span>
                    </div>
                    <div class="col-4">
                        <span class="creditors">{{ __('Past Due:') }}</span>
                    </div>
                    <div class="col-4">
                        <span class="creditors">{{ __('Monthly Payments:') }} </span>
                    </div>
                </div>
                <div class="row no-border-elements">

                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 mt-2 flx_cs_add">

                                <div class="form-group d-flex">

                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" name="other_sec_past_due1" value="<?php echo Helper::validate_key_value('other_sec_past_due1', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mt-2 flx_cs_add">
                                <div class="form-group d-flex">

                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required monthly-payments" name="other_sec_monthly_pay1" value="<?php echo Helper::validate_key_value('other_sec_monthly_pay1', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 mb-2">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4 mt-2 flx_cs_add">

                                <div class="form-group d-flex">
                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" name="other_sec_past_due2" value="<?php echo Helper::validate_key_value('other_sec_past_due2', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 mt-2 flx_cs_add">
                                <div class="form-group d-flex">

                                    <div class="input-groups d-flex ml-2">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required monthly-payments" name="other_sec_monthly_pay2" value="<?php echo Helper::validate_key_value('other_sec_monthly_pay2', $meantestData); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="row no-border-elements mt-2">
            <div class="col-12 mb-3">
                <h4>{{ __('Change in Income or Expenses:') }}</h4>
            </div>
            <div class="col-12 mb-2">
                <div class="tbl-resive-cs">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Form') }}</th>
                                <th>{{ __('Line') }}</th>
                                <th>{{ __('Reason for change') }}</th>
                                <th>{{ __('Date of change') }}</th>
                                <th>{{ __('Increase or') }} <br> {{ __('discrease') }}</th>
                                <th>{{ __('Amount of change') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span>{{ __('122c-1') }}</span> <br /> <span>122c-2</span></td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row1_1" value="<?php echo Helper::validate_key_value('sch_122_row1_1', $meantestData); ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <textarea class="paralegal form-control" id="exampleFormControlTextarea1" name="sch_122_row1_2" rows="3"><?php echo Helper::validate_key_value('sch_122_row1_2', $meantestData); ?></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row1_3" value="<?php echo Helper::validate_key_value('sch_122_row1_3', $meantestData); ?>">
                                    </div>
                                </td>
                                <td><span>{{ __('Increase') }}</span> <br /> <span>Decrease</span></td>
                                <td>
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" name="sch_122_row1_4" value="<?php echo Helper::validate_key_value('sch_122_row1_4', $meantestData); ?>">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span>{{ __('122c-1') }}</span> <br /> <span>122c-2</span></td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row2_1" value="<?php echo Helper::validate_key_value('sch_122_row2_1', $meantestData); ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <textarea class="paralegal form-control" id="exampleFormControlTextarea1" name="sch_122_row2_2" rows="3"><?php echo Helper::validate_key_value('sch_122_row2_2', $meantestData); ?></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row2_3" value="<?php echo Helper::validate_key_value('sch_122_row2_3', $meantestData); ?>">
                                    </div>
                                </td>
                                <td><span>{{ __('Increase') }}</span> <br /> <span>Decrease</span></td>
                                <td>
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" name="sch_122_row2_4" value="<?php echo Helper::validate_key_value('sch_122_row2_4', $meantestData); ?>">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span>{{ __('122c-1') }}</span> <br /> <span>122c-2</span></td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row3_1" value="<?php echo Helper::validate_key_value('sch_122_row3_1', $meantestData); ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <textarea class="paralegal form-control" id="exampleFormControlTextarea1" name="sch_122_row3_2" rows="3"><?php echo Helper::validate_key_value('sch_122_row3_2', $meantestData); ?></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row3_3" value="<?php echo Helper::validate_key_value('sch_122_row3_3', $meantestData); ?>">
                                    </div>
                                </td>
                                <td><span>{{ __('Increase') }}</span> <br /> <span>Decrease</span></td>
                                <td>
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" name="sch_122_row3_4" value="<?php echo Helper::validate_key_value('sch_122_row3_4', $meantestData); ?>">

                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span>{{ __('122c-1') }}</span> <br /> <span>122c-2</span></td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row4_1" value="<?php echo Helper::validate_key_value('sch_122_row4_1', $meantestData); ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <textarea class="paralegal form-control" id="exampleFormControlTextarea1" name="sch_122_row4_2" rows="3"><?php echo Helper::validate_key_value('sch_122_row4_2', $meantestData); ?></textarea>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-groups">
                                        <input type="text" class="paralegal form-control full-text required" name="sch_122_row4_3" value="<?php echo Helper::validate_key_value('sch_122_row4_3', $meantestData); ?>">
                                    </div>
                                </td>
                                <td><span>{{ __('Increase') }}</span> <br /> <span>Decrease</span></td>
                                <td>
                                    <div class="input-groups d-flex">
                                        <div class="input-group-prepends h20">
                                            <span class="input-group-text basic-addon1">$</span>
                                        </div>
                                        <input type="text" class="paralegal form-control price-field full-text required" name="sch_122_row4_4" value="<?php echo Helper::validate_key_value('sch_122_row4_4', $meantestData); ?>">

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div> -->

        <!-- paralegal check -->
        <div class="paralegal_check_div">
            
        </div>

    </form>

</div>
<style>
#facebox .content.large-fb-width {
  max-width: 1280px;
}
#facebox .content.fbminwidth {
  min-width: 1250px;
  min-height: 550px;
}
<?php if ($parent == "client_questionnaire") {?>
  
   
    .heading{
        font-size: 16px;
        font-weight: bold;
    }
    .sub-heading{
        font-size: 14px;
        font-weight: bold;
    }
    .btn-form {
        cursor: pointer;
        /* color: #000; */
        /* border: 2px solid #012cae; */
        background-color: #fff;
        padding: 5px 10px;
        font-weight: 500 !important;
        color: #012cae;
        border: 2px solid #000;
    }

    .paralegal.form-control {
        width: 100% !important;
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #495057 ;
        border-radius: unset;
    }

    .input-border-imp{
        border: 1px solid #495057 !important ;
        border-radius: 0.25rem !important;
    }

    .county-section label{
        margin-bottom: 0;
    }
    .county-section select{
        margin-top: 0;
    }
    .hosehold-section label{
        margin-bottom: 0;
    }
    .hosehold-section select{
        margin-top: 0;
    }
    .switch{
        bottom: 17px;
    }
    .basic-addon1{
        padding: 0px 5px;
        margin-top: 0px !important;
    }
    .full-text{
        max-width: 80px !important;
        min-width: 80px !important;
    }
    .paralegal form-control:disabled, .paralegal form-control[readonly] {
        background-color: white;
        opacity: 1;
    }
    .dollar-pt-1{
        padding-top: 0.25rem !important; 
    }
    .six-month-details{
        margin-top: 0px !important;
    }
    .six-month-details .input-group{
        margin-bottom: 0px !important;
    }
    .six-month-details .opt-bs label.price_dots_label {
        position: relative;
        top: 7px;
    }
    .price_dots_label{
        margin-bottom: 0px;
    }
    span.creditors {
        font-size: 11px !important;
    }
    .mortgage-select{
        height: unset !important;
    }
    span.text-gray, span.text-primary {
        position: relative;
        bottom: 0px;
    }
    .switch {
        bottom: -5px;
    }

<?php }?>
</style>
<script>
    //  $(".price-field").on({
    //         keyup: function() {
    //             formatCurrency($(this));
    //         },
    //         blur: function() {
    //             formatCurrency($(this), "blur");
    //         }
    //     });
    
    
    var graduate_debtor = '<?php echo Helper::validate_key_value('graduate_debtor', $meantestData); ?>';

    if (graduate_debtor == '') {

        $('.debtor-six-month-details').hide();
        $('.debtor-six-month-average-details').hide();
        $('.debtor-average-details').show();
        $('.debtor-slider-default').val(1);
    }
    if (graduate_debtor == 1) {
        $('.debtor-six-month-details').hide();
        $('.debtor-six-month-average-details').hide();
        $('.debtor-average-details').show();
        $('.debtor-slider-default').val(1);
        $("#togglecheck").prop("checked", true);
    }
    if (graduate_debtor == 2) {
        $('.debtor-six-month-details').show();
        $('.debtor-six-month-average-details').show();
        $('.debtor-average-details').hide();
        $('.debtor-slider-default').val(2);
    }
    var graduate_codebtor = '<?php echo Helper::validate_key_value('graduate_codebtor', $meantestData); ?>';

    if (graduate_codebtor == '') {
        $('.codebtor-six-month-details').hide();
        $('.codebtor-six-month-average-details').hide();
        $('.codebtor-average-details').show();
        $('.codebtor-slider-default').val(1);
    }
    if (graduate_codebtor == 1) {
        $('.codebtor-six-month-details').hide();
        $('.codebtor-six-month-average-details').hide();
        $('.codebtor-average-details').show();
        $('.codebtor-slider-default').val(1);
        $("#togglecheck").prop("checked", true);
    }
    if (graduate_codebtor == 2) {
        $('.codebtor-six-month-details').show();
        $('.codebtor-six-month-average-details').show();
        $('.codebtor-average-details').hide();
        $('.codebtor-slider-default').val(2);
    }

    var netAvgTax = 0

    commoncalculation = function() {
        var di = 0;
        var hsi = 0;
        var hi = 0;
        var h_total = 0;
        hsi = parseFloat($(".health_saving_account").val().replace(/,/g, '')) || 0;
        hi = parseFloat($(".health_insurance").val().replace(/,/g, '')) || 0;
        di = parseFloat($(".disability_insurance").val().replace(/,/g, '')) || 0;
        h_total = hsi + hi + di;
        $(".healthcare_total").val(parseFloat(h_total).toFixed(2));
    }
    $(document).ready(function() {

        var parent = "<?php echo $parent;?>"
        var disposableIncome = "<?php echo Helper::validate_key_value(base64_encode('B_122A-2-undefined_107'), $mTestA2);?>";
        if (parent == "client_questionnaire"){
            var mTestA1Q12 = "<?php echo $mTestA1Data['mTestA1Q12'];?>".replace(/,/g, '');
            var mTestA1Q13 = "<?php echo $mTestA1Data['mTestA1Q13'];?>".replace(/,/g, '');

            if (mTestA1Q12 < mTestA1Q13){
                $(".mtp-icon.meantest_green").removeAttr("style");
                $(".mtp-icon.meantest_red").css("display", 'none');
                $(".fi_line39c_monthly_disposable_income_first_display").removeClass('text-c-red');
                $(".fi_line39c_monthly_disposable_income_first_display").addClass('text-c-green');
            }
            if (mTestA1Q12 > mTestA1Q13){
                $(".mtp-icon.meantest_red").removeAttr("style");
                $(".mtp-icon.meantest_green").css("display", 'none');
                $(".fi_line39c_monthly_disposable_income_first_display").removeClass('text-c-green');
                $(".fi_line39c_monthly_disposable_income_first_display").addClass('text-c-red');
            }        
        }   
        

        $(".mean-icons").each(function() {
            if ($(this).is(":visible")) {
                


                if ($(this).hasClass('meantest_red') == true) {
                    $(".mtp-icon.meantest_red").removeAttr('style');
                    $(".mtp-icon.meantest_green").hide();
                    $(".fi_line39c_monthly_disposable_income_first_display").removeClass('text-c-green');
                    $(".fi_line39c_monthly_disposable_income_first_display").addClass('text-c-red');
                }
                if ($(this).hasClass('meantest_green') == true) {
                    $(".fi_line39c_monthly_disposable_income_first_display").removeClass('text-c-red');
                    $(".fi_line39c_monthly_disposable_income_first_display").addClass('text-c-green');
                    $(".mtp-icon.meantest_green").removeAttr('style');
                    $(".mtp-icon.meantest_red").hide();
                }
            }
        });
        setTimeout(function() {
            if (parent == "client_questionnaire"){
                $('.fi_line39c_monthly_disposable_income_first_display').html("$ "+disposableIncome);
                if (!disposableIncome) {
                    $('.fi_line39c_monthly_disposable_income_first_display').html("Please save your Means Test Form");
                }
            }
            if (parent == "official_form"){
                $('.fi_line39c_monthly_disposable_income_first_display').html("$"+$('.fi_line39c_monthly_disposable_income_first').val());
            }
            
        }, 500);

        $(".w2_income").removeClass('hide-data');
        $(".spouse_w2_income").removeClass('hide-data');
        calculateSpouse();
        calculateDebtor();
        //populateThumbIcon();
        $('#facebox').hide();
        if ($('.debtor-slider-default').val() == 1) {
            $('.debtor-six-month-details').hide();
            $('.debtor-six-month-average-details').hide();
            $('.debtor-average-details').show();
            $(".debtor-six-month-average-details input").each(function() {
                $(this).attr('readonly', true);
            });
            $(".debtor-average-details input").each(function() {
                $(this).attr('readonly', false);
            });
            $('#facebox').show()
        } else {
            $('.debtor-six-month-details').show();
            $('.debtor-six-month-average-details').show();
            $('.debtor-average-details').hide();
            $(".debtor-average-details input").each(function() {
                //$(this).attr('readonly', true);
            });
            $('#facebox').show()
        }
        if ($('.codebtor-slider-default').val() == 1) {
            $('.codebtor-six-month-details').hide();
            $('.codebtor-six-month-average-details').hide();
            $('.codebtor-average-details').show();
            $(".codebtor-six-month-average-details input").each(function() {
                $(this).attr('readonly', true);
            });
            $(".codebtor-average-details input").each(function() {
                $(this).attr('readonly', false);
            });
            $('#facebox').show()
        } else {
            $('.codebtor-six-month-details').show();
            $('.codebtor-six-month-average-details').show();
            $('.codebtor-average-details').hide();
            $(".codebtor-average-details input").each(function() {
                //$(this).attr('readonly', true);
            });
            $('#facebox').show()
        }

        calculateVehicleLoand();
        calculateMortages();


    });
    incomeTypeChange = function(thisobject, client_type) {
        var valueSelected = thisobject.value;
        if (client_type == 'debtor') {
            debtorIncome(valueSelected);
        }

        if (client_type == 'spouse') {
            coDebtorIncome(valueSelected);
        }
    }

  

    debtorIncome = function(incometype) {
        if (incometype == 'w2_income') {
            $(".self_employment_income").addClass("hide-data");
            $("." + incometype).removeClass("hide-data");
        }
        if (incometype == 'self_employment_income') {
            $(".w2_income").addClass("hide-data");
            $("." + incometype).removeClass("hide-data");
        }

    }

    coDebtorIncome = function(incometype) {
        if (incometype == 'spouse_w2_income') {
            $(".spouse_self_employment_income").addClass("hide-data");
            $("." + incometype).removeClass("hide-data");
        }
        if (incometype == 'spouse_self_employment_income') {
            $(".spouse_w2_income").addClass("hide-data");
            $("." + incometype).removeClass("hide-data");
        }
    }
    $(document).on("change", ".creditors-taxes-include .radio-primary input", function(evt) {
        if ($(this).val() == 1) {
            $(this).closest(".creditors-taxes-include").find(".input-groups .price-field").removeClass("input-red-background");
            $(this).closest(".creditors-taxes-include").find(".input-groups .price-field").addClass("input-green-background");
        } else if ($(this).val() == 0) {
            $(this).closest(".creditors-taxes-include").find(".input-groups .price-field").removeClass("input-green-background");
            $(this).closest(".creditors-taxes-include").find(".input-groups .price-field").addClass("input-red-background");
        }
    });

    



    $(document).on("keyup", ".health_field,.debtor_per_month,.debtor_paystub,.debtor_gross_per_month", function(evt) {
        calculateDebtor();
        commoncalculation();
        calculateTax();
    });

    $(document).on("keyup", ".spouse_gross_per_month,.spouse_per_month,.spouse_paystub", function(evt) {
        calculateSpouse();
        calculateTax();
    });

    $(document).on("keyup", ".avg_debtor_taxes_avg,.avg_spouse_taxes_avg", function(evt) {
        calculateAvgTax();
    });

    function calculateSpouse() {
        paystubCalculation('spouse');

        var fieldLength = $(".spouse_monthly_income").length;
        var total_income = 0;
        var total_expense = 0;
        var netplus = 0;
        for (var j = 0; j < fieldLength; j++) {
            var inex = j + 1;
            var income = 0;
            income = $(".spouse_month_" + inex + "_income").val().replace(/,/g, '');

            total_income += +income;
            var spexpense = 0;
            spexpense = $(".spouse_month_" + inex + "_expense").val().replace(/,/g, '');
            total_expense += +spexpense;
            var spnet = 0;
            spnet = income - spexpense;
            netplus += +spnet;
            $(".spouse_month_" + inex + "_net").text(parseFloat(spnet).toFixed(2));
        }
        $(".spouse_income_total").val(total_income.toLocaleString());
        $(".spouse_expense_total").val(total_expense.toLocaleString());
        $(".spouse_income_net").val(netplus.toLocaleString());
        var incomeAvg = 0;
        incomeAvg = (total_income / fieldLength).toFixed(2);
        $(".spouse_income_avg").val(incomeAvg.toLocaleString());
        $(".spouse_income_avg").blur();
        var expenseAvg = 0;
        expenseAvg = (total_expense / fieldLength).toFixed(2);

        $(".spouse_expense_avg").val(expenseAvg.toLocaleString());
        $(".spouse_expense_avg").blur();
        var netAvg = 0;
        netAvg = (netplus / fieldLength).toFixed(2);
        $(".spouse_net_avg").val(netAvg.toLocaleString());
        $(".spouse_net_avg").blur();
        calculateTax();
    }

    calculateAvgTax = function() {
        var debtortax = 0;

        var debtortax = $(".avg_debtor_taxes_avg").val().replace(/,/g, '');

        var sptax = 0;
        var sptax = $(".avg_spouse_taxes_avg").val().replace(/,/g, '');

        $('.netAvgTax').val(parseFloat(parseFloat(debtortax) + parseFloat(sptax)).toFixed(2).toLocaleString('en-IN', setting));

    }

    calculateTax = function() {
        var debtortax = 0;

        var debtortax = $(".debtor_taxes_avg").val();
        if(debtortax!=undefined){
            debtortax = parseFloat(debtortax.replace(/,/g, '')).toFixed(2);
        }
        var sptax = 0;
        var sptax = $(".spouse_taxes_avg").val();
        if(sptax!=undefined){
            sptax = parseFloat(sptax.replace(/,/g, '')).toFixed(2);
        }
        $('.netAvgTax').val(parseFloat(parseFloat(debtortax) + parseFloat(sptax)).toFixed(2).toLocaleString('en-IN', setting));
        $('.netAvgTax').blur();
    }

    function calculateDebtor() {

        paystubCalculation('debtor');

        var fieldLength = $(".debtor_monthly_income").length;
        var total_income = 0;
        var total_expense = 0;
        var netplus = 0;
        for (var j = 1; j <= fieldLength; j++) {
            var income = 0;
            income = $(".debtor_month_" + j + "_income").val().replace(/,/g, '');

            total_income += +income;
            var spexpense = 0;
            spexpense = $(".debtor_month_" + j + "_expense").val().replace(/,/g, '');
            total_expense += +spexpense;
            var spnet = 0;
            spnet = income - spexpense;
            netplus += +spnet;
            $(".debtor_month_" + j + "_net").text(parseFloat(spnet.toFixed(2)).toLocaleString('en-IN', setting));
        }
        var total_income_formated = parseFloat(total_income).toFixed(2);
        var total_expense_formated = parseFloat(total_expense).toFixed(2);
        var netplus_formated = parseFloat(netplus).toFixed(2);
        $(".debtor_income_total").val(total_income_formated.toLocaleString('en-IN', setting));
        $(".debtor_expense_total").val(total_expense_formated.toLocaleString('en-IN', setting));
        $(".debtor_income_net").val(netplus_formated.toLocaleString('en-IN', setting));
        $(".debtor_income_net").blur();
        $(".debtor_expense_total").blur();
        $(".debtor_income_total").blur();
        var incomeAvg = 0;
        incomeAvg = (total_income / fieldLength).toFixed(2);
        var income_avg_formated = incomeAvg;
        $(".debtor_income_avg").val(income_avg_formated.toLocaleString('en-IN', setting));
        $(".debtor_income_avg").blur();
        var expenseAvg = 0;
        expenseAvg = (total_expense / fieldLength).toFixed(2);
        var expense_avg_formated = expenseAvg;
        $(".debtor_expense_avg").val(expense_avg_formated.toLocaleString('en-IN', setting));
        $(".debtor_expense_avg").blur();
        var netAvg = 0;
        netAvg = (netplus_formated / fieldLength).toFixed(2);
        var net_avg_formated = expenseAvg;
        $(".debtor_net_avg").val(netAvg.toLocaleString('en-IN', setting));
        $(".debtor_net_avg").blur();
        //$(".full-text").trigger('blur');
        calculateTax();
    }
    $(document).on("keyup", ".debtor_six_m_avg", function(evt) {
        debtorSixmonthAvg();
    });

    $(document).on("keyup", ".spouse_six_m_avg", function(evt) {
        spouseSixmonthAvg();
    });

    spouseSixmonthAvg = function() {

        var sp_gross_avg = 0;
        var sp_taxes_avg = 0
        var sp_deduction_avg = 0;
        var sp_gross_avg = $(".avg_spouse_gross_avg").val().replace(/,/g, '');
        var sp_taxes_avg = $(".avg_spouse_taxes_avg").val().replace(/,/g, '');
        var sp_deduction_avg = $(".avg_spouse_deduction_avg").val().replace(/,/g, '');
        var remaining = 0;
        var remaining = (parseFloat(sp_gross_avg) - (parseFloat(sp_taxes_avg) + parseFloat(sp_deduction_avg)));
        $(".avg_spouse_wages_net_avg").val(remaining.toLocaleString('en-IN', ''));


        /** calculate business avg */

        var sp_bizi_avg = 0;
        var sp_ex_avg = 0
        var sp_bizi_avg = $(".spouse_biz_income").val().replace(/,/g, '');
        var sp_ex_avg = $(".spouse_biz_expense").val().replace(/,/g, '');
        var neti = 0;
        var neti = (parseFloat(sp_bizi_avg) - (parseFloat(sp_ex_avg)));
        $(".spouse_biz_net").val(neti.toLocaleString('en-IN', ''));
    }



    debtorSixmonthAvg = function() {
        var debtor_gross_avg = 0;
        var debtor_taxes_avg = 0
        var debtor_deduction_avg = 0;
        var avg = $(".avg_debtor_gross_avg").val();
       
        var debtor_gross_avg = $(".avg_debtor_gross_avg").val().replace(/,/g, '');
        var debtor_taxes_avg = $(".avg_debtor_taxes_avg").val().replace(/,/g, '');
        var debtor_deduction_avg = $(".avg_debtor_deduction_avg").val().replace(/,/g, '');
        var remaining = 0;
        var remaining = (parseFloat(debtor_gross_avg) - (parseFloat(debtor_taxes_avg) + parseFloat(debtor_deduction_avg)));
        $(".avg_debtor_wages_net_avg").val(remaining.toLocaleString('en-IN', ''));


        /** calculate business avg */

        var debtor_bizi_avg = 0;
        var debtor_ex_avg = 0
        var debtor_bizi_avg = $(".debtor_biz_income_avg").val().replace(/,/g, '');
        var debtor_ex_avg = $(".debtor_biz_expense_avg").val().replace(/,/g, '');
        var neti = 0;
        var neti = (parseFloat(debtor_bizi_avg) - (parseFloat(debtor_ex_avg)));
        $(".debtor_biz_net_avg").val(neti.toLocaleString('en-IN', ''));

    }

    paystubCalculation = function(client_type) {
        var paystubLength = 6;
        var total_gross = 0;
        var total_taxes = 0;
        var total_deduction = 0;
        var total_net_income = 0;
        var netplus = 0;
        var totalTax = 0;
        for (var ps = 0; ps < 6; ps++) {
            var pinex = ps + 1;
            var gross = 0;
            var taxes = 0;
            var deduction = 0;
            var income_pay = 0;
            gross = $("." + client_type + "_gross_" + pinex + "_per_month").val();
            
            if(gross!=undefined){
                gross = gross.replace(/,/g, '');
            }
            
            total_gross += +gross;
            taxes = $("." + client_type + "_taxes_" + pinex + "_per_month").val();
            if(taxes!=undefined){
                taxes = taxes.replace(/,/g, '');
            }
            total_taxes += +taxes;
            deduction = $("." + client_type + "_deduction_" + pinex + "_per_month").val();
            if(deduction!=undefined){
                deduction = deduction.replace(/,/g, '');
            }
            total_deduction += +deduction;
            var spnet = 0;
            spnet = gross - taxes - deduction;
            netplus += +spnet;
            
            var netp = parseFloat(spnet).toFixed(2);
            $("." + client_type + "_net_pay_" + pinex + "_per_month").val(netp.toLocaleString());

        }
        $("." + client_type + "_gross_total").val(total_gross.toLocaleString());
        $("." + client_type + "_taxes_total").val(total_taxes.toLocaleString());
        $("." + client_type + "_deduction_total").val(total_deduction.toLocaleString());
        $("." + client_type + "_net_total").val(netplus.toLocaleString());
        var grossAvg = 0;
        var netAvgTax = 0;
        debtor_taxes_avg
        grossAvg = (total_gross / paystubLength).toFixed(2);
        $("." + client_type + "_gross_avg").val(grossAvg.toLocaleString('en-IN', setting));
        
        $("." + client_type + "_gross_avg").blur();
        var taxesAvg = 0;
        taxesAvg = (total_taxes / paystubLength).toFixed(2);
        netAvgTax += parseFloat(taxesAvg)
        $("." + client_type + "_taxes_avg").val(taxesAvg.toLocaleString());
        $("." + client_type + "_taxes_avg").blur();
        var netdAvg = 0;
        netdAvg = (total_deduction / paystubLength).toFixed(2);
        $("." + client_type + "_deduction_avg").val(netdAvg.toLocaleString());
        $("." + client_type + "_deduction_avg").blur();
        var netinAvg = 0;
        netinAvg = (netplus / paystubLength).toFixed(2);
        $("." + client_type + "_wages_net_avg").val(netinAvg.toLocaleString());
        $("." + client_type + "_wages_net_avg").blur();

    }

  

    function getAmountDetails(client) {

        if(client == 1){
            if ($('.debtor-slider-default').val() == 1) {
                $('.debtor-six-month-details').show();
                $('.debtor-six-month-average-details').show();
                $('.debtor-average-details').hide();
                $('.debtor-slider-default').val(2);
                calculateTax();

            } else {
                $('.debtor-six-month-details').hide();
                $('.debtor-six-month-average-details').hide();
                $('.debtor-average-details').show();
                $('.debtor-slider-default').val(1);
                calculateAvgTax();
            }
        }
        if(client == 2){
            if ($('.codebtor-slider-default').val() == 1) {
                $('.codebtor-six-month-details').show();
                $('.codebtor-six-month-average-details').show();
                $('.codebtor-average-details').hide();
                $('.codebtor-slider-default').val(2);
                calculateTax();
            } else {
                $('.codebtor-six-month-details').hide();
                $('.codebtor-six-month-average-details').hide();
                $('.codebtor-average-details').show();
                $('.codebtor-slider-default').val(1);
                calculateAvgTax();
            }
        }

        


    }

    showparalegalCheckPopup = function(){
        var ajaxurl = "{{route('paralegal_check_popup',['id'=>$client_id])}}";
        laws.ajax(ajaxurl, { }, function(response) {
            var res = JSON.parse(response);
            if (res.success == true) {
                var paralegalCheckDiv = $('.paralegal_check_div');
                paralegalCheckDiv.html(res.html);
                var scrollToElement = paralegalCheckDiv[0];
                scrollToElement.scrollIntoView({ behavior: 'smooth' });
            } 
        });
    }

    resetMeanTestPopup = function() {
        var client_id = "<?php echo $client_id; ?>";
        var url = "<?php echo route('mean_test_popup_reset'); ?>";
        laws.ajax(url, {
            client_id: client_id
        }, function(response) {
            var res = JSON.parse(response);

            if (res.status == 0) {
                $.systemMessage(res.msg, 'alert--danger');
            } else {
                $.systemMessage(res.msg, 'alert--success');

                meanTestPopup();
            }
        });
    }

    saveMeanTestToDb = function(importincome = false) {

        var mt_form = $("#mean_test_form");
        var dataString1 = $(mt_form).serialize();
        var parent = "<?php echo $parent;?>";
       
        dataString1 += '&client_id='.$client_id;
        if (importincome) {
            dataString1 += '&import_income=1';
        }
        $.ajax({
            type: "POST",
            url: "<?php echo route('mean_test_popup_save'); ?>",
            data: dataString1,
            async: true,
            success: function() {
                $.systemMessage("Record Saved Successfully", 'alert--success', true);
                if (parent == "client_questionnaire"){
                    $.facebox.close();
                }
                if (parent == "official_form"){
                    window.location.href = "{{ route('attorney_offical_form', ['id' => $client_id]) }}";
                }
            }
        });


    }
</script>
@include("attorney.official_form.common_popup")