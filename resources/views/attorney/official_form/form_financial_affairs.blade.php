<form name="official_frm_107" id="official_frm_107" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="107">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b_107.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b107.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_107-Case number'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_107-Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('B_107-Debtor 2'); ?>" value="<?php echo $spousename; ?>">
    <?php $sofa = isset($dynamicPdfData['b107']) && !empty($dynamicPdfData['b107']) ? json_decode($dynamicPdfData['b107'], 1) : null;?>
    <section class="page-section official-form-107 padd-20" id="official-form-107">
        <div class="container pl-2 pr-0">
            <x-officialForm.bankruptcyCourtListBox
                districtName="B_107-Bankruptcy District Information"
                :districtList="$district_names"
                :savedData="$savedData"
                districtCheckboxName="B_107-Check if this is an"
                :sofa="$sofa"
            ></x-officialForm.bankruptcyCourtListBox>
            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Statement of Financial Affairs') }}  </h4>
                        <!-- <h4>{{ __('Official Form 107') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Statement of Financial Affairs for Individuals Filing
                            for
                            Bankruptcy') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14"><strong>{{ __('Be as complete and accurate as possible. If
                                two
                                married people are filing together, both are equally responsible for
                                supplying correct
                                information. If more space is needed, attach a separate sheet to
                                this
                                form. On the top of any additional pages, write your name and case
                                number (if known). Answer every question.') }}
                            </strong></p>
                    </div>
                </div>
            </div>
            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('Give Details About Your Marital Status and Where You
                            Lived Before') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Row 1 -->
            <?php
            $finacial_affairs = $financialaffairs_info;
    // dump();
    // $loan_own_type_property=true;
    ?>
            <div class="form-border mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group d-inline-block">
                            <label for="">
                                <strong class="d-block">{{ __('1. What is your current marital status?') }}
                                </strong>
                            </label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check1'); ?>" value="married" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check1')]) ? Helper::validate_key_toggle(base64_encode('B_107-check1'), $sofa, 'married') : Helper::validate_key_toggle('current_marital_Status', $finacial_affairs, 1);?>>
                            <label>{{ __('Married') }}</label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check1'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check1')]) ? Helper::validate_key_toggle(base64_encode('B_107-check1'), $sofa, 'yes') : Helper::validate_key_toggle('current_marital_Status', $finacial_affairs, 0);?>>
                            <label>{{ __('Not married') }}</label>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="input-group d-inline-block">
                            <label for="">
                                <strong class="d-block">{{ __('2. During the last 3 years, have you lived
                                    anywhere other than where you live now?') }}
                                </strong>
                            </label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check2'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check2')]) ? Helper::validate_key_toggle(base64_encode('B_107-check2'), $sofa, 'no') : Helper::validate_key_toggle('list_every_address', $finacial_affairs, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check2'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check2')]) ? Helper::validate_key_toggle(base64_encode('B_107-check2'), $sofa, 'yes') : Helper::validate_key_toggle('list_every_address', $finacial_affairs, 1);?>>
                            <label>{{ __('Yes. List all of the places you lived in the last 3 years. Do not
                                include where you live now.') }}</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 pl-2 <?php echo Helper::key_hide_show_v2('list_every_address', $finacial_affairs);?>">
                    <?php
            if (!empty($finacial_affairs['prev_address']['creditor_street'])) {
                for ($i = 0;$i < count($finacial_affairs['prev_address']['creditor_street']);$i++) {

                    if ($i == 0) {
                        $deb_title = 'Debtor 1';
                        $address = 'B_107-Street address 1b Debtor 1';
                        $city = 'B_107-City 1b Debtor1';
                        $state = 'B_107-State 1b Debtor1';
                        $zip = 'B_107-ZIP Code 1b Debtor 1';
                        $fromDate = 'B_107-Date from 1b Debtor1';
                        $toDate = 'B_107-Date to 1b Debtor1';
                    }
                    if ($i == 1) {
                        $deb_title = 'Debtor 2';
                        $address = 'B_107-Street address 1b Debtor 2';
                        $city = 'B_107-City 1b Debtor2';
                        $state = 'B_107-State 1b Debtor2';
                        $zip = 'B_107-ZIP Code 1b Debtor 2';
                        $fromDate = 'B_107-Date from 1b Debtor2';
                        $toDate = 'B_107-Date to 1b Debtor2';
                    }
                    if ($i == 2) {
                        $address = 'B_107-Street address 1c Debtor 1';
                        $city = 'B_107-City 1c Debtor1';
                        $state = 'B_107-State 1c Debtor1';
                        $zip = 'B_107-ZIP Code 1c Debtor 1';
                        $fromDate = 'B_107-Date from 1c Debtor1';
                        $toDate = 'B_107-Date to 1c Debtor1';
                    }
                    if ($i == 3) {
                        $address = 'B_107-Street address 1c Debtor 2';
                        $city = 'B_107-City 1c Debtor2';
                        $state = 'B_107-State 1c Debtor2';
                        $zip = 'B_107-ZIP Code 1c Debtor 2';
                        $fromDate = 'B_107-Date from 1c Debtor2';
                        $toDate = 'B_107-Date to 1c Debtor2';
                    }


                    ?>
                    <div class="col-md-6">
                        <div class="row <?php  if ($i > 1) { ?> pt-3 <?php } ?>">
                            <div class="col-md-8">
                                <div class="colum-heading-main">
                                    <h4> <?php echo $deb_title;?>:</h4>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input id="{{$i}}" name="<?php echo base64_encode($address); ?>" type="text" value="<?php echo $sofa[base64_encode($address)] ?? Helper::validate_key_loop_value("creditor_street", $finacial_affairs['prev_address'], $i);?>" class="form-control">
                                            <label>{{ __('Street Address') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            @php

                                                $cityvalue = $sofa[base64_encode($city)]??Helper::validate_key_loop_value("creditor_city",$finacial_affairs['prev_address'],$i);

                                            @endphp
                                            <x-labelAfterInput name="<?php echo base64_encode($city); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1" label="City" inputClass=""></x-labelAfterInput>
                                            @php

                                                $statevalue = $sofa[base64_encode($state)]??Helper::validate_key_loop_value("creditor_state",$finacial_affairs['prev_address'],$i);

                                            @endphp
                                            <x-labelAfterInput name="<?php echo base64_encode($state); ?>" type="text"  value="{{ $statevalue }}" divClass="col-md-2 pr-1 pl-1" label="State" inputClass=""></x-labelAfterInput>

                                            <div class="col-md-6 pr-1">
                                                <div class="input-group">
                                                    <input name="<?php echo base64_encode($zip); ?>" type="text" value="<?php echo $sofa[base64_encode($zip)] ?? Helper::validate_key_loop_value("creditor_zip", $finacial_affairs['prev_address'], $i);?>" class="form-control">
                                                    <label for="">{{ __('ZIP Code') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 p-0 ">
                                <div class="colum-heading-main">
                                    <h4>Dates <?php echo $deb_title;?>
                                        {{ __('lived there') }}</h4>
                                </div>

                                <div class="input-group mt-3">
                                    <label>{{ __('From') }}</label>
                                    <?php $debt_from_sofa = $sofa[base64_encode($fromDate)] ?? Helper::validate_key_loop_value("from", $finacial_affairs['prev_address'], $i);
                    if (strtotime($debt_from_sofa) != false && strlen($debt_from_sofa) > 7) {
                        $debt_from_sofa = date('m/Y', strtotime($debt_from_sofa));
                    } ?>
                                    <input name="<?php echo base64_encode($fromDate); ?>" type="text" value="<?php echo $debt_from_sofa;?>" class="form-control">
                                </div>
                                <div class="input-group">
                                    <label>To</label>
                                    <?php $debt_to_sofa = $sofa[base64_encode($toDate)] ?? Helper::validate_key_loop_value("to", $finacial_affairs['prev_address'], $i);
                    if (strtotime($debt_to_sofa) != false && strlen($debt_to_sofa) > 7) {
                        $debt_to_sofa = date('m/Y', strtotime($debt_to_sofa));
                    } ?>
                                    <input name="<?php echo base64_encode($toDate); ?>" type="text" value="<?php echo $debt_to_sofa;?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                }?>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-md-12 mt-3 d-flex">
                        <label for=""> <strong>3.</strong></label>
                        <div class="row pl-1">
                            <div class="col-md-12">
                                <strong> {{ __('Within the last 8 years, did you ever
                                    live
                                    with a spouse or legal equivalent in a community property state
                                    or
                                    territory?') }}
                                </strong>{{ __('(Community property
                                states and territories include Arizona, California, Idaho,
                                Louisiana, Nevada, New Mexico, Puerto Rico, Texas, Washington, and
                                Wisconsin.') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check3'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check3')]) ? Helper::validate_key_toggle(base64_encode('B_107-check3'), $sofa, 'no') : Helper::validate_key_toggle('living_domestic_partner', $finacial_affairs, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check3'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check3')]) ? Helper::validate_key_toggle(base64_encode('B_107-check3'), $sofa, 'yes') : Helper::validate_key_toggle('living_domestic_partner', $finacial_affairs, 1);?>>
                            <label>{{ __('Yes. Make sure you fill out Schedule H: Your Codebtors (Official
                                Form
                                106H)') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Part 2 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 2') }}</span>
                        <h2 class="font-lg-18">{{ __('Explain the Sources of Your Income') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Row 1 -->
            <div class="form-border">
                <div class="row mt-2">
                    <div class="col-md-12 d-flex">
                        <label for=""> <strong>4.</strong></label>
                        <div class="row pl-1">
                            <div class="col-md-12">
                                <strong> {{ __('Did you have any income from employment
                                    or
                                    from
                                    operating a business during this year or the two previous
                                    calendar
                                    years?') }}
                            </strong><br>
                                {{ __('Fill in the total amount of income you received from all
                                jobs
                                and
                                all businesses, including part-time activities.
                                If you are filing a joint case and you have income that you receive
                                together, list it only once under Debtor 1.') }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check4'); ?>" value="no" type="checkbox" class="income_4_no" <?php echo isset($sofa[base64_encode('B_107-check4')]) ? Helper::validate_key_toggle(base64_encode('B_107-check4'), $sofa, 'no') : Helper::validate_key_toggle('total_amount_income', $finacial_affairs, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check4'); ?>" value="yes" type="checkbox" class="income_4_yes" <?php echo isset($sofa[base64_encode('B_107-check4')]) ? Helper::validate_key_toggle(base64_encode('B_107-check4'), $sofa, 'yes') : Helper::validate_key_toggle('total_amount_income', $finacial_affairs, 1);?>>
                            <label>{{ __('Yes. Fill in the details.') }}</label>
                        </div>
                    </div>
                    <div class="col-md-12 <?php echo Helper::key_hide_show_v('total_amount_income', $finacial_affairs);?>">
                        <!-- First Row Heading -->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pl-0 ml-0">
                                        <div class="colum-heading-main">
                                            <h4>{{ __('Debtor 1') }}</h4>
                                        </div>
                                    </div>

                                    <x-sourceOfIncome divClass="column-heading pl-0 ml-0 pr-0 mr-0" strong="{{ __('Sources of income')}}" label="Check all that apply"></x-sourceOfIncome>
                                    <x-sourceOfIncome divClass="column-heading" strong="{{ __('Gross income')}}" label="{{ __('(before deductions and exclusions)')}}"></x-sourceOfIncome>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pl-0 ml-0">
                                        <div class="colum-heading-main">
                                            <h4>{{ __('Debtor 2') }}</h4>
                                        </div>
                                    </div>
                                     <x-sourceOfIncome divClass="column-heading pl-0 ml-0 pr-0 mr-0" strong="{{ __('Sources of income')}}" label="Check all that apply"></x-sourceOfIncome>
                                     <x-sourceOfIncome divClass="column-heading" strong="{{ __('Gross income')}}" label="{{ __('(before deductions and exclusions)')}}"></x-sourceOfIncome>
                                </div>
                            </div>
                        </div>

                        <!-- Second Row Body -->
                        <div class="row border-bottm-1">
                            <div class="col-md-4" >
                                <div class="input-group" >
                                    <label for=""><strong>
                                            {{ __('From January 1 of current year until
                                            the date you filed for bankruptcy:') }}
                                        </strong></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pl-0 ml-0 pr-0 mr-0">
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4a Debtor 1')])? Helper::validate_key_toggle(base64_encode('B_107-check4a Debtor 1'),$sofa,'no'):Helper::validate_key_toggle('total_amount_this_year',$finacial_affairs,1);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Wages, commissions, bonuses, tips') }}" name="<?php echo base64_encode('B_107-check4a Debtor 1'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4b Debtor 1')])? Helper::validate_key_toggle(base64_encode('B_107-check4b Debtor 1'),$sofa,'no'):Helper::validate_key_toggle('total_amount_this_year',$finacial_affairs,0);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Operating a business') }}" name="<?php echo base64_encode('B_107-check4b Debtor 1'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>

                                    </div>
                                    <div class="col-md-6 pl-0 ">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 4a Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 4a Debtor 1')]):Helper::validate_key_value('total_amount_this_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Income 4a Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field total_amount_this_year_income form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pl-0 ml-0 pr-0 mr-0">
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4a Debtor 2')])? Helper::validate_key_toggle(base64_encode('B_107-check4a Debtor 2'),$sofa,'no'):Helper::validate_key_toggle('total_amount_spouse_this_year',$finacial_affairs,1);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Wages, commissions, bonuses, tips') }}" name="<?php echo base64_encode('B_107-check4a Debtor 2'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4b Debtor 2')])? Helper::validate_key_toggle(base64_encode('B_107-check4b Debtor 2'),$sofa,'no'):Helper::validate_key_toggle('total_amount_spouse_this_year',$finacial_affairs,0);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Operating a business') }}" name="<?php echo base64_encode('B_107-check4b Debtor 2'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 4a Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 4a Debtor 2')]):Helper::validate_key_value('total_amount_spouse_this_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Income 4a Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field total_amount_spouse_this_year_income form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Third Row Body -->
                        <div class="row mt-2 border-bottm-1">
                            <div class="col-md-4">
                                <div class="">
                                    <label for=""><strong>
                                            {{ __('For last calendar year:') }}
                                        </strong>(January 1 to December 31,
                                    <input name="<?php echo base64_encode('B_107-Year from 4b Debtor1'); ?>" style="width:50px; padding-left: 5px; padding-right: 5px;"  type="text" value="<?php echo $sofa[base64_encode('B_107-Year from 4b Debtor1')] ?? date("Y", strtotime("-1 year"))?>" class="form-control" placeholder="{{ __('YYYY') }}">
                                )</label>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pl-0 ml-0 pr-0 mr-0">
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4c Debtor 1')])? Helper::validate_key_toggle(base64_encode(''),$sofa,'no'):Helper::validate_key_toggle('total_amount_last_year',$finacial_affairs,1);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Wages, commissions, bonuses, tips') }}" name="<?php echo base64_encode('B_107-check4c Debtor 1'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4d Debtor 1')])? Helper::validate_key_toggle(base64_encode(''),$sofa,'no'):Helper::validate_key_toggle('total_amount_last_year',$finacial_affairs,0);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Operating a business') }}" name="<?php echo base64_encode('B_107-check4d Debtor 1'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 4b Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 4b Debtor 1')]):Helper::validate_key_value('total_amount_last_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Income 4b Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field total_amount_last_year_income form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pl-0 ml-0 pr-0 mr-0">
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4c Debtor 2')])? Helper::validate_key_toggle(base64_encode('B_107-check4c Debtor 2'),$sofa,'no'):Helper::validate_key_toggle('total_amount_spouse_last_year',$finacial_affairs,1);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Wages, commissions, bonuses, tips') }}" name="<?php echo base64_encode('B_107-check4c Debtor 2'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4d Debtor 2')])? Helper::validate_key_toggle(base64_encode('B_107-check4d Debtor 2'),$sofa,'no'):Helper::validate_key_toggle('total_amount_spouse_last_year',$finacial_affairs,0);
                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Operating a business') }}" name="<?php echo base64_encode('B_107-check4d Debtor 2'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 4b Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 4b Debtor 2')]):Helper::validate_key_value('total_amount_spouse_last_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Income 4b Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field total_amount_spouse_last_year_income form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- Fourth Row Body -->
                        <div class="row mt-2 border-bottm-1">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label for=""><strong>
                                            {{ __('For last calendar year:') }}
                                        </strong>(January 1 to December 31,
                                    <input name="<?php echo base64_encode('B_107-Year from 4c Debtor1'); ?>" style="width:50px; padding-left: 5px; padding-right: 5px;" type="text" value="<?php echo $sofa[base64_encode('B_107-Year from 4c Debtor1')] ?? date("Y", strtotime("-2 year"));?>" class="form-control" placeholder="{{ __('YYYY') }}">
                                    )</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pl-0 ml-0 pr-0 mr-0">
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4e Debtor 1')])? Helper::validate_key_toggle(base64_encode('B_107-check4e Debtor 1'),$sofa,'no'):Helper::validate_key_toggle('total_amount_lastbefore_year',$finacial_affairs,1);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Wages, commissions, bonuses, tips') }}" name="<?php echo base64_encode('B_107-check4e Debtor 1'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4f Debtor 1')])? Helper::validate_key_toggle(base64_encode('B_107-check4f Debtor 1'),$sofa,'no'):Helper::validate_key_toggle('total_amount_lastbefore_year',$finacial_affairs,0);
                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Operating a business') }}" name="<?php echo base64_encode('B_107-check4f Debtor 1'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 4c Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 4c Debtor 1')]):Helper::validate_key_value('total_amount_lastbefore_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Income 4c Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field total_amount_lastbefore_year_income form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6 pl-0 ml-0 pr-0 mr-0">
                                         @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4e Debtor 2')])? Helper::validate_key_toggle(base64_encode('B_107-check4e Debtor 2'),$sofa,'no'):Helper::validate_key_toggle('total_amount_spouse_lastbefore_year',$finacial_affairs,1);

                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Wages, commissions, bonuses, tips') }}" name="<?php echo base64_encode('B_107-check4e Debtor 2'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                        @php

                                            $incomevalue = isset($sofa[base64_encode('B_107-check4f Debtor 2')])? Helper::validate_key_toggle(base64_encode('B_107-check4f Debtor 2'),$sofa,'no'):Helper::validate_key_toggle('total_amount_spouse_lastbefore_year',$finacial_affairs,0);
                                        @endphp

                                        <x-sourceOfIncomeCheckbox label="{{ __('Operating a business') }}" name="<?php echo base64_encode('B_107-check4f Debtor 2'); ?>" style="" type="checkbox" value="no" checked="{!! $incomevalue !!}"></x-sourceOfIncomeCheckbox>
                                    </div>
                                    <div class="col-md-6 pl-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 4c Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 4c Debtor 2')]):Helper::validate_key_value('total_amount_spouse_lastbefore_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Income 4c Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field total_amount_spouse_lastbefore_year_income form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12  d-flex">
                        <label for=""> <strong>5.</strong></label>
                        <div class="row pl-1">
                            <div class="col-md-12">
                                <strong> {{ __('Did you receive any other income during
                                    this
                                    year or the two previous calendar years?') }}
                            </strong><br>
                                {{ __('Include income regardless of whether that income is taxable. Examples of') }} <i>{{ __('other income') }}</i> are alimony; child support; Social Security,
                                unemployment, and other public benefit payments; pensions; rental income; interest; dividends; money collected from lawsuits; royalties; and
                                gambling and lottery winnings. If you are filing a joint case and you have income that you received together, list it only once under Debtor 1.
                                <p class="mt-2">{{ __('List each source and the gross income from each source separately. Do not include income that you listed in line 4.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check5'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check5')]) ? Helper::validate_key_toggle(base64_encode('B_107-check5'), $sofa, 'no') : Helper::validate_key_toggle('other_income_received_income', $finacial_affairs, 0);?>>
                            <label>{{ __('No') }}</label>
                        </div>
                        <div class="input-group pl-2">
                            <input name="<?php echo base64_encode('B_107-check5'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check5')]) ? Helper::validate_key_toggle(base64_encode('B_107-check5'), $sofa, 'no') : Helper::validate_key_toggle('other_income_received_income', $finacial_affairs, 1);?>>
                            <label>{{ __('Yes. Fill in the details.') }}</label>
                        </div>
                    </div>
                    <div class="col-md-12 <?php echo Helper::key_hide_show_v('other_income_received_income', $finacial_affairs);?>">
                        <!-- First Row Heading -->
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4" style="padding-right: 16px;">
                                <div class="row">
                                    <div class="col-md-12" style="background: #d2d2d2">
                                        <div class="" style="padding:10px;">
                                            <h4>{{ __('Debtor 1') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 gray-box">
                                        <div class="column-heading">
                                            <label for=""><strong class="d-block">
                                                    {{ __('Sources of income') }}
                                                </strong>{{ __('Check all that apply') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 gray-box">
                                        <div class="column-heading">
                                            <label for=""><strong class="d-block">
                                                    {{ __('Gross income') }}
                                                </strong>{{ __('(before deductions and
                                                exclusions)') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pr-3"  style="padding-left: 16px; padding-right: 22px;">
                                <div class="row">
                                    <div class="col-md-12" style="background: #d2d2d2">
                                        <div class="" style="padding:10px;">
                                            <h4>{{ __('Debtor 2') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6  gray-box">
                                        <div class="column-heading">
                                            <label for=""><strong class="d-block">
                                                    {{ __('Sources of income') }}
                                                </strong>{{ __('Check all that apply') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6  gray-box">
                                        <div class="column-heading">
                                            <label for=""><strong class="d-block">
                                                    {{ __('Gross income') }}
                                                </strong>{{ __('(before deductions and
                                                exclusions)') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Second Row Body -->
                    <div class="col-md-12 border-bottm-1 <?php echo Helper::key_hide_show_v('other_income_received_income', $finacial_affairs);?>">
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label for=""><strong>
                                            {{ __('From January 1 of current year until
                                            the date you filed for bankruptcy:') }}
                                        </strong></label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?php $source = ''; //Helper::getSourceOfIncomeArray(Helper::validate_key_value('other_income_received_this_year',$finacial_affairs));?>
                                            <input name="<?php echo base64_encode('B_107-Income source 5a Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5a Debtor 1')] ?? $source;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                    @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5a Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5a Debtor 1')]):'';

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5a Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field other_amount_this_year_income form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5b Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5b Debtor 1')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6  pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5b Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5b Debtor 1')]):Helper::priceFormtWithComma('');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5b Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5c Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5c Debtor 1')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5c Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5c Debtor 1')]):Helper::priceFormtWithComma('');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5c Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                        <?php $source = ''; //Helper::getSourceOfIncomeArray(Helper::validate_key_value('other_income_received_spouse_this_year',$finacial_affairs));?>
                                            <input name="<?php echo base64_encode('B_107-Income source 5a Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5a Debtor 2')] ?? $source;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5a Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5a Debtor 2')]):Helper::validate_key_value('other_amount_spouse_this_year_income',$finacial_affairs,'comma');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5a Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field other_amount_spouse_this_year_income form-control"></x-sourceOfIncomeGrossInput>

                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5b Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5b Debtor 2')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5b Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5b Debtor 2')]):Helper::priceFormtWithComma('');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5b Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5c Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5c Debtor 2')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5c Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5c Debtor 2')]):Helper::priceFormtWithComma('');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5c Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="col-md-12 mt-3 border-bottm-1 <?php echo Helper::key_hide_show_v('other_income_received_income', $finacial_affairs);?>">
                        <!-- Fourth Row Body -->
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label for=""><strong>
                                            {{ __('For last calendar year:') }}
                                        </strong>(January 1 to December 31,
                                    <input name="<?php echo base64_encode('B_107-Year from 4b Debtor1'); ?>" style="width: 50px; padding-left: 5px; padding-right: 5px;" type="text" value="<?php echo $sofa[base64_encode('B_107-Year from 4b Debtor1')] ?? date("Y", strtotime("-1 year"));?>" class="form-control" placeholder="{{ __('YYYY') }}">
                                )</label>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?php $source = '';// Helper::getSourceOfIncomeArray(Helper::validate_key_value('other_income_received_last_year',$finacial_affairs));?>
                                            <input name="<?php echo base64_encode('B_107-Income source 5d Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5d Debtor 1')] ?? $source;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <div class="input-group d-flex">
                                            <div class="input-group-append">
											<span class="input-group-text"
                                                  id="basic-addon2">$</span>
                                            </div>
                                            <input name="<?php echo base64_encode('B_107-Income 5d Debtor 1'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Income 5d Debtor 1')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5d Debtor 1')]) : '';?>" class="price-field other_amount_last_year_income form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5e Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5e Debtor 1')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5e Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5e Debtor 1')]):Helper::priceFormtWithComma('');

                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5e Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5f Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5f Debtor 1')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5f Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5f Debtor 1')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5f Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?php $source = ''; //Helper::getSourceOfIncomeArray(Helper::validate_key_value('other_income_received_spouse_last_year',$finacial_affairs));?>
                                            <input name="<?php echo base64_encode('B_107-Income source 5d Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5d Debtor 2')] ?? $source;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <div class="input-group d-flex ">
                                            <div class="input-group-append">
											<span class="input-group-text"
                                                  id="basic-addon2">$</span>
                                            </div>
                                            <input name="<?php echo base64_encode('B_107-Income 5d Debtor 2'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Income 5d Debtor 2')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5d Debtor 2')]) : Helper::validate_key_value('other_amount_spouse_last_year_income', $finacial_affairs, 'comma');?>" class="price-field other_amount_spouse_last_year_income form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5e Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5e Debtor 2')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                         @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5e Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5e Debtor 2')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5e Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5f Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5f Debtor 2')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5f Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5f Debtor 2')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5f Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 mt-3 <?php echo Helper::key_hide_show_v('other_income_received_income', $finacial_affairs);?>">
                        <!-- Fourth Row Body -->
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label for=""><strong>
                                            {{ __('For last calendar year:') }}
                                        </strong>(January 1 to December 31,
                                    <input name="<?php echo base64_encode('B_107-Year from 4c Debtor1'); ?>" style=" width: 50px; padding-left: 5px; padding-right: 5px;" type="text" value="<?php echo $sofa[base64_encode('B_107-Year from 4c Debtor1')] ?? date("Y", strtotime("-2 year"));?>" class="form-control" placeholder="{{ __('YYYY') }}">
                               ) </label>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?php $source = ''; //Helper::getSourceOfIncomeArray(Helper::validate_key_value('other_income_received_lastbefore_year',$finacial_affairs));?>
                                            <input name="<?php echo base64_encode('B_107-Income source 5g Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5g Debtor 1')] ?? $source;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <div class="input-group d-flex">
                                            <div class="input-group-append">
											<span class="input-group-text"
                                                  id="basic-addon2">$</span>
                                            </div>
                                            <input name="<?php echo base64_encode('B_107-Income 5g Debtor 1'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Income 5g Debtor 1')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5g Debtor 1')]) : Helper::validate_key_value('other_amount_lastbefore_year_income', $finacial_affairs, 'comma');?>" class="price-field other_amount_lastbefore_year_income form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5h Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5h Debtor 1')] ?? ''; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5h Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5h Debtor 1')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5h Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5i Debtor 1'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5i Debtor 1')] ?? ''; ?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5i Debtor 1')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5i Debtor 1')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5i Debtor 1'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <?php $source = '';// Helper::getSourceOfIncomeArray(Helper::validate_key_value('other_income_received_spouse_lastbefore_year',$finacial_affairs));?>
                                            <input name="<?php echo base64_encode('B_107-Income source 5g Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5g Debtor 2')] ?? $source;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <div class="input-group d-flex ">
                                            <div class="input-group-append">
											<span class="input-group-text"
                                                  id="basic-addon2">$</span>
                                            </div>
                                            <input name="<?php echo base64_encode('B_107-Income 5g Debtor 2'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Income 5g Debtor 2')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5g Debtor 2')]) : Helper::validate_key_value('other_amount_spouse_lastbefore_year_income', $finacial_affairs, 'comma');?>" class="price-field other_amount_spouse_lastbefore_year_income form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5h Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5h Debtor 2')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                         @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5h Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5h Debtor 2')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5h Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Income source 5i Debtor 2'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Income source 5i Debtor 2')] ?? '';?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-0 pr-0">
                                        @php

                                            $grossvalue = isset($sofa[base64_encode('B_107-Income 5i Debtor 2')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Income 5i Debtor 2')]):Helper::priceFormtWithComma('');
                                        @endphp

                                        <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Income 5i Debtor 2'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Part 3 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3 mt-3">
                        <span>{{ __('Part 3') }}</span>
                        <h2 class="font-lg-18">{{ __('List Certain Payments You Made Before You Filed for
                            Bankruptcy') }}</h2>
                    </div>
                </div>
            </div>
            <!-- Row 6 -->
            <div class="form-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group d-inline-block">
                            <label for="">
                                <strong class="d-block">{{ __("6. Are either Debtor 1’s or Debtor 2’s debts
                                primarily consumer debts?") }}
                                </strong>
                            </label>
                        </div>
                        <div class="row pl-2">
                            <?php
                            $debtRadio = $savedData['debtbtextvalue'] ?? 0;
    $debtNo = '';
    $debtYes = '';
    //bussiness debt = 0
    if ($debtRadio == 0) {
        $debtNo = "checked";
    }
    //consumer debt = 1
    if ($debtRadio == 1) {
        $debtYes = "checked";
    }

    $firstYes = $debtRadio == 0 ? Helper::validate_key_toggle('primarily_consumer_debets', $finacial_affairs, 1) : '';
    $firstNo = $debtRadio == 0 ? Helper::validate_key_toggle('primarily_consumer_debets', $finacial_affairs, 0) : '';

    $secondYes = $debtRadio == 1 ? Helper::validate_key_toggle('primarily_consumer_debets', $finacial_affairs, 1) : '';
    $secondNo = $debtRadio == 1 ? Helper::validate_key_toggle('primarily_consumer_debets', $finacial_affairs, 0) : '';

    ?>
                            <div class="col-md-1" style="display: block ruby;">
                                <input class="payment_6_no" name="<?php echo base64_encode('B_107-check6'); ?>" value="no" type="checkbox" <?php echo  $debtNo; ?>>
                                <label for="">{{ __('No.') }}</label>
                            </div>
                            <div class="col-md-9">
                                <p>
                                    <strong>
                                    {{ __('Neither Debtor 1 nor Debtor 2 has primarily consumer
                                    debts.') }}
                                    </strong>
                                    {{ __('Consumer debts are defined in 11 U.S.C. § 101(8) as
                                    “incurred by an individual primarily for a personal, family, or
                                    household
                                    purpose.”') }}<br>
                                    During the 90 days before you filed for bankruptcy, did you pay any
                                    creditor
                                    a total of $6,825* or more?
                                </p>
                                <div class="row">
                                    <div class="col-md-1" style="display: block ruby;">
                                        <input name="<?php echo base64_encode('B_107-check6a'); ?>" value="no" type="checkbox" <?php echo $firstNo;?>>
                                        <label>{{ __('No.') }}</label>
                                    </div>
                                    <div class="col-md-11" style="padding-left: 25px;">
                                        <p> {{ __('Go to line 7.') }}</p>
                                    </div>
                                    <div class="col-md-1" style="display: block ruby;">
                                        <input name="<?php echo base64_encode('B_107-check6a'); ?>" value="yes" type="checkbox" <?php echo $firstYes;?>>
                                        <label>{{ __('Yes.') }}</label>
                                    </div>
                                    <div class="col-md-11" style="padding-left: 25px;">
                                        <p>
                                            List below each creditor to whom you paid a total of $7,575* or more in one or more payments and the
                                            total amount you paid that creditor. Do not include payments for domestic support obligations, such as
                                            child support and alimony. Also, do not include payments to an attorney for this bankruptcy case.
                                        </p>
                                    </div>
                                    <div class="col-md-12">
                                        <p>* Subject to adjustment on 4/01/25 and every 3 years after that for cases filed on or after the date of adjustment.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>

                            <div class="col-md-1" style="display: block ruby;">
                                <input class="payment_6_yes" name="<?php echo base64_encode('B_107-check6'); ?>" value="yes"  type="checkbox" <?php echo $debtYes;?>>
                                <label for="">{{ __('Yes.') }}</label>
                            </div>
                            <div class="col-md-9">
                                <p>
                                    <strong> {{ __('Debtor 1 or Debtor 2 or both have primarily consumer
                                    debts.') }}
                                    </strong>
                                    <br>
                                    {{ __('During the 90 days before you filed for bankruptcy, did you pay any creditor a total of $600 or more?') }}
                                </p>
                                <div class="row">
                                    <div class="col-md-1" style="display: block ruby;">
                                        <input name="<?php echo base64_encode('B_107-check6b'); ?>" value="no"  type="checkbox" <?php echo $secondNo;?>>
                                        <label>{{ __('No.') }}</label>
                                    </div>
                                    <div class="col-md-11" style="padding-left: 25px;">
                                        <p> {{ __('Go to line 7.') }}</p>
                                    </div>
                                    <div class="col-md-1" style="display: block ruby;">
                                        <input name="<?php echo base64_encode('B_107-check6b'); ?>" value="yes" type="checkbox" <?php echo $secondYes;?>>
                                        <label>{{ __('Yes.') }}</label>
                                    </div>
                                    <div class="col-md-11" style="padding-left: 25px;">
                                        <p>
                                            {{ __('List below each creditor to whom you paid a total of $600 or more and the total amount you paid that
                                            creditor. Do not include payments for domestic support obligations, such as child support and
                                            alimony. Also, do not include payments to an attorney for this bankruptcy case.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
                    </div>
                </div>
                <!-- First Row Heading -->
                <div class="row  mt-3 <?php echo Helper::key_hide_show_v('primarily_consumer_debets', $finacial_affairs);?>">
                    <div class="col-md-4"></div>
                    <x-financialAffairsPart3Headings divClass="pl-0" title="{{ __('Dates of payment') }}" style="padding-left: 5px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="" title="{{ __('Total amount paid') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="" title="{{ __('Amount you still owe') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="pr-3" title="{{ __('Was this payment for…') }}" style="padding-left: 2px;"></x-financialAffairsPart3Headings>
                </div>
                <?php

                if (!empty($finacial_affairs['primarily_consumer_debets_data']['creditor_address'])) {
                    for ($i = 0;$i < count($finacial_affairs['primarily_consumer_debets_data']['creditor_address']);$i++) {
                        $finacial_affairst = $finacial_affairs['primarily_consumer_debets_data'];

                        ?>
                    <!-- Second Row Body -->
                <div class="col-md-12 border-bottm-1 <?php echo Helper::key_hide_show_v('primarily_consumer_debets', $finacial_affairs);?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors Name '.($i + 1));?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors Name '.($i + 1))] ?? Helper::validate_key_loop_value('creditor_address', $finacial_affairst, $i);?>" class="form-control">
                                        <label>{{ __('Name') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors address a '.($i + 1));?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors address a '.($i + 1))] ?? Helper::validate_key_loop_value('creditor_street', $finacial_affairst, $i);?>" class="form-control">
                                        <label>{{ __('Street Address') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors City '.($i + 1));?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors City '.($i + 1))] ?? Helper::validate_key_loop_value('creditor_city', $finacial_affairst, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors State '.($i + 1));?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors State '.($i + 1))] ?? Helper::validate_key_loop_value('creditor_state', $finacial_affairst, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors ZIP Code '.($i + 1));?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors ZIP Code '.($i + 1))] ?? Helper::validate_key_loop_value('creditor_zip', $finacial_affairst, $i);?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php $sofa_payment_dates = $sofa[base64_encode('B_107-Creditors payment Date '.($i + 1).'a')] ?? Helper::validate_key_loop_value('payment_dates', $finacial_affairst, $i);
                        if (strtotime($sofa_payment_dates) != false && strlen($sofa_payment_dates) > 7) {
                            $sofa_payment_dates = date('m/Y', strtotime($sofa_payment_dates));
                        } ?>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Creditors payment Date '.($i + 1).'a');?>" type="text" 
                                            value="<?php echo $sofa_payment_dates;?>" class="quest6_date_one form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <?php $sofa_payment_dates2 = $sofa[base64_encode('B_107-Creditors payment Date '.($i + 1).'b')] ?? Helper::validate_key_loop_value('payment_dates2', $finacial_affairst, $i);
                        if (strtotime($sofa_payment_dates2) != false && strlen($sofa_payment_dates2) > 7) {
                            $sofa_payment_dates2 = date('m/Y', strtotime($sofa_payment_dates2));
                        } ?>
                                        <div class="input-group" style="margin-top: 19px;">
                                            <input name="<?php echo base64_encode('B_107-Creditors payment Date '.($i + 1).'b');?>" type="text" 
                                            value="<?php echo $sofa_payment_dates2;?>" class="quest6_date_two form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <?php $sofa_payment_dates3 = $sofa[base64_encode('B_107-Creditors payment Date '.($i + 1).'c')] ?? Helper::validate_key_loop_value('payment_dates3', $finacial_affairst, $i);
                        if (strtotime($sofa_payment_dates3) != false && strlen($sofa_payment_dates3) > 7) {
                            $sofa_payment_dates3 = date('m/Y', strtotime($sofa_payment_dates3));
                        } ?>
                                        <div class="input-group" style="margin-top: 19px;">
                                            <input name="<?php echo base64_encode('B_107-Creditors payment Date '.($i + 1).'c');?>" type="text" 
                                            value="<?php echo $sofa_payment_dates3;?>" class="quest6_date_three form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Creditors amount paid '.($i+1))])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Creditors amount paid '.($i+1))]):Helper::priceFormtWithComma(Helper::validate_key_loop_value('total_amount_paid',$finacial_affairst,$i));

                                $input = base64_encode('B_107-Creditors amount paid '.($i+1) );

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="" span="$" name="{{ $input }}" type="text" value="{{ $grossvalue }}" inputClass="price-field quest6_amount_paid form-control pr-0 mr-0"></x-sourceOfIncomeGrossInput>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Creditors amount owe '.($i+1))])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Creditors amount owe '.($i+1))]):Helper::priceFormtWithComma(Helper::validate_key_loop_value('amount_still_owed',$finacial_affairst,$i));

                                $input = base64_encode('B_107-Creditors amount owe '.($i+1) );

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="" span="$" name="{{ $input }}" type="text" value="{{ $grossvalue }}" inputClass="price-field  form-control pr-0 mr-0"></x-sourceOfIncomeGrossInput>
                        </div>

                        <div class="col-md-2">
                            <div class="">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check mortgage '.($i + 1));?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check mortgage '.($i + 1))]) ? Helper::validate_key_toggle(base64_encode('B_107-check mortgage '.($i + 1)), $sofa, 'no') : Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairst, 1, $i);?>>
                                    <label for="">{{ __('Mortgage') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check car '.($i + 1));?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check car '.($i + 1))]) ? Helper::validate_key_toggle(base64_encode('B_107-check car '.($i + 1)), $sofa, 'yes') : Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairst, 2, $i);?>>
                                    <label for="">Car</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check credit card '.($i + 1));?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check credit card '.($i + 1))]) ? Helper::validate_key_toggle(base64_encode('B_107-check credit card '.($i + 1)), $sofa, 'no') : Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairst, 3, $i);?>>
                                    <label for="">{{ __('Credit card') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check loan '.($i + 1));?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check loan '.($i + 1))]) ? Helper::validate_key_toggle(base64_encode('B_107-check loan '.($i + 1)), $sofa, 'yes') : Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairst, 4, $i);?>>
                                    <label for="">{{ __('Loan repayment') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check vendors '.($i + 1));?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check vendors '.($i + 1))]) ? Helper::validate_key_toggle(base64_encode('B_107-check vendors '.($i + 1)), $sofa, 'no') : Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairst, 5, $i);?>>
                                    <label for="">{{ __('Suppliers or vendors') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check other '.($i + 1));?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check other '.($i + 1))]) ? Helper::validate_key_toggle(base64_encode('B_107-check other '.($i + 1)), $sofa, 'yes') : Helper::validate_key_loop_toggle('creditor_payment_for', $finacial_affairst, 6, $i);?>>
                                    <label for="">{{ __('Other') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                    }?>


            <!-- Row 7	 -->
            <div class="mt-3">
                <div class="col-md-12 pl-0 d-flex">
                    <label for=""> <strong>7.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 1 year before you filed for bankruptcy, did you make a payment on a debt you owed anyone who was an insider?') }}
                        </strong><br>
                            <i>{{ __('Insiders') }}</i> {{ __('include your relatives; any general
                            partners;
                            relatives of any general partners; partnerships of which you are a
                            general
                            partner;
                            corporations of which you are an officer, director, person in control,
                            or
                            owner of 20% or more of their voting securities; and any managing
                            agent, including one for a business you operate as a sole proprietor. 11
                            U.S.C. § 101. Include payments for domestic support obligations,
                            such as child support and alimony') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-2">
                        <input class="payment_7_no" name="<?php echo base64_encode('B_107-check7'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check7')]) ? Helper::validate_key_toggle(base64_encode('B_107-check7'), $sofa, 'no') : Helper::validate_key_toggle('payment_past_one_year', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group pl-2">
                        <input class="payment_7_yes" name="<?php echo base64_encode('B_107-check7'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check7')]) ? Helper::validate_key_toggle(base64_encode('B_107-check7'), $sofa, 'yes') : Helper::validate_key_toggle('payment_past_one_year', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. List all payments to an insider') }}</label>
                    </div>
                </div>
                <!-- First Row Heading -->
                <div class="row  mt-3 <?php echo Helper::key_hide_show_v('payment_past_one_year', $finacial_affairs);?>">
                    <div class="col-md-4"></div>
                    <x-financialAffairsPart3Headings divClass="pl-0" title="{{ __('Dates of payment') }}" style="padding-left: 5px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="" title="{{ __('Total amount paid') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="" title="{{ __('Amount you still owe') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="pr-3" title="{{ __('Reason for this payment') }}" style="padding-left: 2px;"></x-financialAffairsPart3Headings>
                </div>


                <!-- Second Row Body -->
                <?php

                    if (!empty($finacial_affairs['past_one_year_data']['creditor_address_past_one_year'])) {
                        for ($i = 0;$i < count($finacial_affairs['past_one_year_data']['creditor_address_past_one_year']);$i++) {
                            $finacial_affairspast = $finacial_affairs['past_one_year_data'];

                            $alpha = '';
                            if ($i == 0) {
                                $alpha = 'a';
                            } elseif ($i == 1) {
                                $alpha = 'b';
                            }

                            ?>
                <div class="col-md-12 border-bottm-1 <?php echo Helper::key_hide_show_v('payment_past_one_year', $finacial_affairs);?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insider Name 7'.$alpha); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insider Name 7'.$alpha)] ?? Helper::validate_key_loop_value('creditor_address_past_one_year', $finacial_affairspast, $i);?>" class="form-control">
                                        <label>{{ __('Name') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insiders address 7'.$alpha); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders address 7'.$alpha)] ?? Helper::validate_key_loop_value('creditor_street_past_one_year', $finacial_affairspast, $i);?>" class="form-control">
                                        <label>{{ __('Street Address') }}</label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insiders City 7'.$alpha); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders City 7'.$alpha)] ?? Helper::validate_key_loop_value("creditor_city_past_one_year", $finacial_affairspast, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insiders State 7'.$alpha); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders State 7'.$alpha)] ?? Helper::validate_key_loop_value("creditor_state_past_one_year", $finacial_affairspast, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                @php

                                    $zipvalue = $sofa[base64_encode('B_107-Insiders ZIP Code 7'.$alpha)]??Helper::validate_key_loop_value("creditor_zip_past_one_year",$finacial_affairspast,$i);

                                @endphp
                                <x-labelAfterInput name="<?php echo base64_encode('B_107-Insiders ZIP Code 7'.$alpha); ?>" type="text"  value="{{ $zipvalue }}" divClass="col-md-6" label="ZIP Code" inputClass=""></x-labelAfterInput>
                            </div>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php $past_one_year_payment_dates = $sofa[base64_encode('B_107-Insiders payment Date1 7'.$alpha)] ?? Helper::validate_key_loop_value("past_one_year_payment_dates", $finacial_affairspast, $i);
                            if (strtotime($past_one_year_payment_dates) != false && strlen($past_one_year_payment_dates) > 7) {
                                $past_one_year_payment_dates = date('m/Y', strtotime($past_one_year_payment_dates));
                            } ?>
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Insiders payment Date1 7'.$alpha); ?>" type="text" value="<?php echo $past_one_year_payment_dates;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <?php $past_one_year_payment_dates2 = $sofa[base64_encode('B_107-Insiders payment Date2 7'.$alpha)] ?? Helper::validate_key_loop_value("past_one_year_payment_dates2", $finacial_affairspast, $i);
                            if (strtotime($past_one_year_payment_dates2) != false && strlen($past_one_year_payment_dates2) > 7) {
                                $past_one_year_payment_dates2 = date('m/Y', strtotime($past_one_year_payment_dates2));
                            } ?>
                                        <div class="input-group" style="margin-top:19px">
                                            <input name="<?php echo base64_encode('B_107-Insiders payment Date2 7'.$alpha); ?>" type="text" value="<?php echo $past_one_year_payment_dates2;?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <?php $past_one_year_payment_dates3 = $sofa[base64_encode('B_107-Insiders payment Date3 7'.$alpha)] ?? Helper::validate_key_loop_value("past_one_year_payment_dates3", $finacial_affairspast, $i);
                            if (strtotime($past_one_year_payment_dates3) != false && strlen($past_one_year_payment_dates3) > 7) {
                                $past_one_year_payment_dates3 = date('m/Y', strtotime($past_one_year_payment_dates3));
                            } ?> 
                                        <div class="input-group" style="margin-top:19px">
                                            <input name="<?php echo base64_encode('B_107-Insiders payment Date3 7'.$alpha); ?>" type="text" value="<?php echo $past_one_year_payment_dates3;?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 pl-0 pr-0">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Insiders amount paid 7'.$alpha)])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Insiders amount paid 7'.$alpha)]):Helper::priceFormtWithComma(Helper::validate_key_loop_value("past_one_year_total_amount_paid",$finacial_affairspast,$i));

                                $input = base64_encode('B_107-Creditors amount owe '.($i+1) );

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Insiders amount paid 7'.$alpha); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control pr-0 mr-0"></x-sourceOfIncomeGrossInput>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Insiders amount owe 7'.$alpha)])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Insiders amount owe 7'.$alpha)]):Helper::priceFormtWithComma(Helper::validate_key_loop_value("past_one_year_amount_still_owed",$finacial_affairspast,$i));

                                $input = base64_encode('B_107-Creditors amount owe '.($i+1) );

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Insiders amount owe 7'.$alpha); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control pr-0 mr-0"></x-sourceOfIncomeGrossInput>
                        </div>

                        <div class="col-md-2 pr-0 mr-0">
							<textarea name="<?php echo base64_encode('B_107-Insider reason of pay 7'.$alpha); ?>" id="" cols="20" rows="7"
                                      class="form-control "><?php echo $sofa[base64_encode('B_107-Insider reason of pay 7'.$alpha)] ?? Helper::validate_key_loop_value("past_one_year_payment_reason", $finacial_affairspast, $i);?></textarea>
                        </div>
                    </div>
                </div>
                <!-- Third Row Body -->
                <?php }
                        } ?>





            </div>

            <div class="mb-2 mt-3 mb-3">
                <div class="col-md-12 pl-0  d-flex">
                    <label for=""> <strong>8.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 1 year before you filed for bankruptcy,
                                did you make any payments or transfer any property on account of a debt that
                                benefited an insider?') }}
                        </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check8'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check8')]) ? Helper::validate_key_toggle(base64_encode('B_107-check8'), $sofa, 'no') : Helper::validate_key_toggle('transfers_property', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check8'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check8')]) ? Helper::validate_key_toggle(base64_encode('B_107-check8'), $sofa, 'yes') : Helper::validate_key_toggle('transfers_property', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. List all payments to an insider') }}</label>
                    </div>
                </div>
                <!-- First Row Heading -->
                <div class="row  mt-3 <?php echo Helper::key_hide_show_v('transfers_property', $finacial_affairs);?>">
                    <div class="col-md-4"></div>
                    <x-financialAffairsPart3Headings divClass="pl-0" title="{{ __('Dates of payment') }}" style="padding-left: 5px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="" title="{{ __('Total amount paid') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="" title="{{ __('Amount you still owe') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart3Headings>
                    <x-financialAffairsPart3Headings divClass="pr-3" title="{{ __('Reason for this payment') }}" style="padding-left: 2px;"></x-financialAffairsPart3Headings>
                </div>

                <?php

                        if (!empty($finacial_affairs['transfers_property_data']['creditor_address_transfers_property'])) {
                            for ($i = 0;$i < count($finacial_affairs['transfers_property_data']['creditor_address_transfers_property']);$i++) {
                                $finacial_affairstrans = $finacial_affairs['transfers_property_data'];
                                $alpha_1 = '';
                                if ($i == 0) {
                                    $alpha_1 = 'a';
                                } elseif ($i == 1) {
                                    $alpha_1 = 'b';
                                }
                                ?>
                <div class="col-md-12 border-bottm-1 <?php echo Helper::key_hide_show_v('transfers_property', $finacial_affairs);?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insider Name 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insider Name 8'.$alpha_1)] ?? Helper::validate_key_loop_value('creditor_address_transfers_property', $finacial_affairstrans, $i);?>" class="form-control">
                                        <label>{{ __('Name') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insiders address 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders address 8'.$alpha_1)] ?? Helper::validate_key_loop_value('creditor_street_transfers_property', $finacial_affairstrans, $i);?>" class="form-control">
                                        <label>{{ __('Street Address') }}</label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insiders City 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders City 8'.$alpha_1)] ?? Helper::validate_key_loop_value("creditor_city_transfers_property", $finacial_affairstrans, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Insiders State 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders State 8'.$alpha_1)] ?? Helper::validate_key_loop_value("creditor_state_transfers_property", $finacial_affairstrans, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                 @php

                                    $zipvalue = $sofa[base64_encode('B_107-Insiders ZIP Code 8'.$alpha_1)]??Helper::validate_key_loop_value("creditor_zip_transfers_property",$finacial_affairstrans,$i);

                                @endphp
                                <x-labelAfterInput name="<?php echo base64_encode('B_107-Insiders ZIP Code 8'.$alpha_1); ?>" type="text"  value="{{ $zipvalue }}" divClass="col-md-6" label="ZIP Code" inputClass=""></x-labelAfterInput>
                            </div>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            <div class="col-md-12 pl-0 pr-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Insiders payment Date1 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders payment Date1 8'.$alpha_1)] ?? Helper::validate_key_loop_value("payment_dates_transfers_property", $finacial_affairstrans, $i);?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group" style="margin-top:19px;">
                                            <input name="<?php echo base64_encode('B_107-Insiders payment Date2 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders payment Date2 8'.$alpha_1)] ?? Helper::validate_key_loop_value("payment_dates_transfers_property2", $finacial_affairstrans, $i);?>" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="input-group" style="margin-top:19px;">
                                            <input name="<?php echo base64_encode('B_107-Insiders payment Date3 8'.$alpha_1); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Insiders payment Date3 8'.$alpha_1)] ?? Helper::validate_key_loop_value("payment_dates_transfers_property3", $finacial_affairstrans, $i);?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 pl-0 pr-0">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Insiders amount paid 8'.$alpha_1)])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Insiders amount paid 8'.$alpha_1)]):Helper::priceFormtWithComma(Helper::validate_key_loop_value("total_amount_paid_transfers_property",$finacial_affairstrans,$i));

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="" span="$" name="<?php echo base64_encode('B_107-Insiders amount paid 8'.$alpha_1); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode('B_107-Insiders amount owe 8'.$alpha_1); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Insiders amount owe 8'.$alpha_1)]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Insiders amount owe 8'.$alpha_1)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value("amount_still_owed_transfers_property", $finacial_affairstrans, $i));?>" class="price-field form-control">
                            </div>
                        </div>

                        <div class="col-md-2 pr-0 mr-0">
                            <div class="">
							<textarea name="<?php echo base64_encode('B_107-Insider reason of pay 8'.$alpha_1); ?>" id="" cols="20" rows="7"
                                      class="form-control"><?php echo $sofa[base64_encode('B_107-Insider reason of pay 8'.$alpha_1)] ?? Helper::validate_key_loop_value("payment_reason_transfers_property", $finacial_affairstrans, $i);?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Third Row Body -->
                <?php }
                            } ?>
            </div>

            </div>




            <!-- Row 7	 -->


            <!-- Part 4 -->
            <div class="row align-items-center mt-3">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 4') }}</span>
                        <h2 class="font-lg-18">{{ __('Identify Legal Actions, Repossessions, and
                            Foreclosures') }}
                        </h2>
                    </div>
                </div>
            </div>
            <!-- Row 9	 -->
            <div class="form-border">
                <div class="col-md-12 pl-0 mt-2 d-flex">
                    <label for=""> <strong>9.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 1 year before you filed for
                                bankruptcy,
                                were you a party in any lawsuit, court action, or administrative
                                proceeding?') }}
                            </strong>
                            <p>
                                {{ __('List all such matters, including personal injury
                                cases, small claims actions, divorces, collection suits, paternity
                                actions,
                                support or custody modifications,
                                and contract disputes.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group">
                        <input name="<?php echo base64_encode('B_107-check9'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check9')]) ? Helper::validate_key_toggle(base64_encode('B_107-check9'), $sofa, 'no') : Helper::validate_key_toggle('list_lawsuits', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('B_107-check9'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check9')]) ? Helper::validate_key_toggle(base64_encode('B_107-check9'), $sofa, 'yes') : Helper::validate_key_toggle('list_lawsuits', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. List all payments to an insider') }}</label>
                    </div>
                </div>
                <!-- First Row Heading -->
                <div class="row mt-2 <?php echo Helper::key_hide_show_v('list_lawsuits', $finacial_affairs);?>">
                    <div class="col-md-3"></div>
                    <div class="col-md-3 pl-0" style="padding-left: 5px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Nature of the case') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding-left: 2px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Total amount paid') }} </h4>
                        </div>
                    </div>
                    <div class="col-md-3 pr-3" style="padding-left: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Status of the case') }} </h4>
                        </div>
                    </div>
                </div>

                <?php

                            if (!empty($finacial_affairs['list_lawsuits_data']['case_title'])) {
                                for ($i = 0;$i < count($finacial_affairs['list_lawsuits_data']['case_title']);$i++) {
                                    $finacial_affairssuits = $finacial_affairs['list_lawsuits_data'];
                                    $alpha_2 = '';
                                    if ($i == 0) {
                                        $alpha_2 = 'a';
                                    } elseif ($i == 1) {
                                        $alpha_2 = 'b';
                                    }
                                    ?>
                    <!-- Second Row Body -->
                <div class="col-md-12 border-bottm-1 mt-2 <?php echo Helper::key_hide_show_v('list_lawsuits', $finacial_affairs);?>">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="input-group">
                                <label>{{ __('Case title') }}</label>
                                <input name="<?php echo base64_encode('B_107-Case title1 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Case title1 9'.$alpha_2)] ?? Helper::validate_key_loop_value('case_title', $finacial_affairssuits, $i);?>" class="form-control">
                            </div>
                            <div class="input-group mt-2">
                                <label>{{ __('Case Number') }}</label>
                                <input name="<?php echo base64_encode('B_107-Case number 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Case number 9'.$alpha_2)] ?? Helper::validate_key_loop_value('case_number', $finacial_affairssuits, $i);?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 pl-0 pr-0" style="padding-right: 2px;">
                            <div class="input-group">
                                <textarea name="<?php echo base64_encode('B_107-Case nature 9'.$alpha_2); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Case nature 9'.$alpha_2)] ?? Helper::validate_key_loop_value('case_nature', $finacial_affairssuits, $i);?></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Court Name 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court Name 9'.$alpha_2)] ?? Helper::validate_key_loop_value('agency_location', $finacial_affairssuits, $i);?>" class="form-control">
                                        <label>{{ __('Court Name') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Court address 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court address 9'.$alpha_2)] ?? Helper::validate_key_loop_value('agency_street', $finacial_affairssuits, $i);?>" class="form-control">
                                        <label>{{ __('Street') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Court City 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court City 9'.$alpha_2)] ?? Helper::validate_key_loop_value('agency_city', $finacial_affairssuits, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Court State 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court State 9'.$alpha_2)] ?? Helper::validate_key_loop_value('agency_state', $finacial_affairssuits, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Court ZIP Code 9'.$alpha_2); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court ZIP Code 9'.$alpha_2)] ?? Helper::validate_key_loop_value('agency_zip', $finacial_affairssuits, $i);?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check9'.$alpha_2); ?>" value="pending" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check9'.$alpha_2)]) ? Helper::validate_key_toggle(base64_encode('B_107-check9'.$alpha_2), $sofa, 'pending') : Helper::validate_key_loop_toggle('disposition', $finacial_affairssuits, 1, $i);?>>
                                <label for="">{{ __('Pending') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check9'.$alpha_2); ?>" value="on appeal" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check9'.$alpha_2)]) ? Helper::validate_key_toggle(base64_encode('B_107-check9'.$alpha_2), $sofa, 'on appeal') : Helper::validate_key_loop_toggle('disposition', $finacial_affairssuits, 2, $i);?>>
                                <label for="">{{ __('On appeal') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check9'.$alpha_2); ?>" value="concluded" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check9'.$alpha_2)]) ? Helper::validate_key_toggle(base64_encode('B_107-check9'.$alpha_2), $sofa, 'concluded') : Helper::validate_key_loop_toggle('disposition', $finacial_affairssuits, 3, $i);?>>
                                <label for="">{{ __('Concluded') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                                } ?>
                <!-- Third Row Body -->


                <!-- Row 10	 -->

                <div class="col-md-12 pl-0 mt-2 d-flex">
                    <label for=""> <strong>10.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 1 year before you filed for
                                bankruptcy,
                                was any of your property repossessed, foreclosed, garnished,
                                attached,
                                seized, or levied?') }}
                            </strong>
                            <p>
                            {{ __('Check all that apply and fill in the
                            details
                            below.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check10'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check10')]) ? Helper::validate_key_toggle(base64_encode('B_107-check10'), $sofa, 'no') : Helper::validate_key_toggle('property_repossessed', $finacial_affairs, 0);?>>
                        <label>{{ __('No. Go to line 11') }}</label>
                    </div>
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check10'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check10')]) ? Helper::validate_key_toggle(base64_encode('B_107-check10'), $sofa, 'yes') : Helper::validate_key_toggle('property_repossessed', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the information below') }}</label>
                    </div>
                </div>


                <!-- First Row Heading -->
                <div class="row mt-3 <?php echo Helper::key_hide_show_v('property_repossessed', $finacial_affairs);?>">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="padding-left: 8px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Describe the property') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Date') }} </h4>
                        </div>
                    </div>
                    <div class="col-md-2 pr-3"  style="padding-left: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Value of the property') }} </h4>
                        </div>
                    </div>
                </div>

                <!-- Second Row Body -->
                <div class="col-md-12 <?php echo Helper::key_hide_show_v('property_repossessed', $finacial_affairs);?>">
                    <?php
                                    if (!empty($finacial_affairs['property_repossessed_data']['creditor_address'])) {
                                        for ($i = 0;$i < count($finacial_affairs['property_repossessed_data']['creditor_address']);$i++) {

                                            $finacial_affairsp = $finacial_affairs['property_repossessed_data'];
                                            $alpha_3 = '';
                                            if ($i == 0) {
                                                $alpha_3 = 'a';
                                            } elseif ($i == 1) {
                                                $alpha_3 = 'b';
                                            }
                                            ?>
                    <div class="row border-bottm-1 <?php if ($i > 0) {
                        echo "pt-3";
                    } ?>">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors Name 10'.$alpha_3); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors Name 10'.$alpha_3)] ?? Helper::validate_key_loop_value('creditor_address', $finacial_affairsp, $i);?>" class="form-control">
                                        <label>{{ __("Creditor’s Name") }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors address 10'.$alpha_3); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors address 10'.$alpha_3)] ?? Helper::validate_key_loop_value('creditor_street', $finacial_affairsp, $i);?>" class="form-control">
                                        <label>{{ __('Street') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors City 10'.$alpha_3); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors City 10'.$alpha_3)] ?? Helper::validate_key_loop_value('creditor_city', $finacial_affairsp, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors State 10'.$alpha_3); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors State 10'.$alpha_3)] ?? Helper::validate_key_loop_value('creditor_state', $finacial_affairsp, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors ZIP Code 10'.$alpha_3); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors ZIP Code 10'.$alpha_3)] ?? Helper::validate_key_loop_value('creditor_zip', $finacial_affairsp, $i);?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4" style="padding-left:0px; padding-right:0px;">
                            <div class="input-group">
                                <textarea name="<?php echo base64_encode('B_107-Describe property 10'.$alpha_3); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe property 10'.$alpha_3)] ?? Helper::validate_key_loop_value('creditor_Property', $finacial_affairsp, $i);?></textarea>
                            </div>
                            <div class="input-group mt-2 column-heading gray-box">
                                <label style="font-weight: bold;">{{ __('Explain what happened') }} </label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check10'.$alpha_3.'1'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check10'.$alpha_3.'1')]) ? Helper::validate_key_toggle(base64_encode('B_107-check10'.$alpha_3.'1'), $sofa, 'yes') : Helper::validate_key_loop_toggle('what_happened', $finacial_affairsp, 1, $i);?>>
                                <label for="">{{ __('Property was repossessed.') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check10'.$alpha_3.'2'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check10'.$alpha_3.'2')]) ? Helper::validate_key_toggle(base64_encode('B_107-check10'.$alpha_3.'2'), $sofa, 'yes') : Helper::validate_key_loop_toggle('what_happened', $finacial_affairsp, 2, $i);?>>
                                <label for="">{{ __('Property was foreclosed.') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check10'.$alpha_3.'3'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check10'.$alpha_3.'3')]) ? Helper::validate_key_toggle(base64_encode('B_107-check10'.$alpha_3.'3'), $sofa, 'yes') : Helper::validate_key_loop_toggle('what_happened', $finacial_affairsp, 3, $i);?>>
                                <label for="">{{ __('Property was garnished.') }}</label>
                            </div>
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-check10'.$alpha_3.'4'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check10'.$alpha_3.'4')]) ? Helper::validate_key_toggle(base64_encode('B_107-check10'.$alpha_3.'4'), $sofa, 'yes') : Helper::validate_key_loop_toggle('what_happened', $finacial_affairsp, 4, $i);?>>
                                <label for="">{{ __('Property was attached, seized, or levied.') }}</label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-Creditor Date3 10'.$alpha_3); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditor Date3 10'.$alpha_3)] ?? Helper::validate_key_loop_value('property_repossessed_date', $finacial_affairsp, $i);?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 pr-0 mr-0">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode('B_107-Property value 10'.$alpha_3); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Property value 10'.$alpha_3)]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Property value 10'.$alpha_3)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_repossessed_value', $finacial_affairsp, $i));?>" class="price-field form-control mr-0">
                            </div>
                        </div>
                    </div>
                    <?php }
                                        }?>
                </div>
                <!-- Third Row Body -->


                <!-- Row 11	 -->
                <div class="col-md-12 pl-0 mt-2 d-flex">
                    <label for=""> <strong>11.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 90 days before you filed for
                                bankruptcy,
                                did any creditor, including a bank or financial institution, set off
                                any
                                amounts from your
                                accounts or refuse to make a payment because you owed a
                                debt?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check11'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check11')]) ? Helper::validate_key_toggle(base64_encode('B_107-check11'), $sofa, 'no') : Helper::validate_key_toggle('setoffs_creditor', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check11'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check11')]) ? Helper::validate_key_toggle(base64_encode('B_107-check11'), $sofa, 'yes') : Helper::validate_key_toggle('setoffs_creditor', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details') }}</label>
                    </div>
                </div>


                <!-- First Row Heading -->
                <div class="row mt-3 <?php echo Helper::key_hide_show_v('setoffs_creditor', $finacial_affairs);?>">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="padding-left: 5px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Describe the action the creditor took') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-2" style="padding-left: 2px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Date action
                                was taken') }} </h4>
                        </div>
                    </div>
                    <div class="col-md-2 pr-3"  style="padding-left: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Amount') }} </h4>
                        </div>
                    </div>
                </div>

                <?php
                if (!empty($finacial_affairs['setoffs_creditor_data']['creditors_address'])) {
                    for ($i = 0;$i < count($finacial_affairs['setoffs_creditor_data']['creditors_address']);$i++) {

                        $finacial_affairst = $finacial_affairs['setoffs_creditor_data']
                        ?>

                    <!-- Second Row Body -->
                <div class="col-md-12 mt-2 <?php if ($i > 0) {
                    echo "pt-3";
                };
                        echo Helper::key_hide_show_v('setoffs_creditor', $finacial_affairs);?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors Name 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors Name 11')] ?? Helper::validate_key_loop_value('creditors_address', $finacial_affairst, $i);?>" class="form-control">                                        <label>{{ __("Creditor’s Name") }}</label>
                                        <label>{{ __("Creditor’s Name") }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Creditors address 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors address 11')] ?? Helper::validate_key_loop_value("creditor_street", $finacial_affairst, $i);?>" class="form-control">
                                        <label>{{ __('Street') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Creditors City 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors City 11')] ?? Helper::validate_key_loop_value("creditor_city", $finacial_affairst, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Creditors State 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors State 11')] ?? Helper::validate_key_loop_value("creditor_state", $finacial_affairst, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Creditors ZIP Code 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditors ZIP Code 11')] ?? Helper::validate_key_loop_value("creditor_zip", $finacial_affairst, $i);?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 pl-0 pr-0">
                            <div class="input-group">
                                <textarea name="<?php echo base64_encode('B_107-Describe action 11'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe action 11')] ?? Helper::validate_key_loop_value('creditors_action', $finacial_affairst, $i);?></textarea>
                            </div>

                            <div class="input-group mt-2">
                                <label for="">{{ __('Last 4 digits of account number: XXXX') }}</label>
                                <input name="<?php echo base64_encode('B_107-account number 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-account number 11')] ?? Helper::validate_key_loop_value('account_number', $finacial_affairst, $i);?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-Creditor Date 11'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Creditor Date 11')] ?? Helper::validate_key_loop_value('date_action', $finacial_affairst, $i);?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 pl-0 pr-0">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode('B_107-Amount 11'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Amount 11')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Amount 11')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('amount_data', $finacial_affairst, $i));?>" class="price-field form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                    }?>

                <div class="col-md-12 pl-0 mt-2 d-flex">
                    <label for=""> <strong>12.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 1 year before you filed for
                                bankruptcy,
                                was any of your property in the possession of an assignee for the
                                benefit of
                                creditors, a court-appointed receiver, a custodian, or another
                                official?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="input-group ">
                    <input name="<?php echo base64_encode('B_107-check12'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check12')]) ? Helper::validate_key_toggle(base64_encode('B_107-check12'), $sofa, 'no') : Helper::validate_key_toggle('court_appointed', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group ">
                    <input name="<?php echo base64_encode('B_107-check12'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check12')]) ? Helper::validate_key_toggle(base64_encode('B_107-check12'), $sofa, 'yes') : Helper::validate_key_toggle('court_appointed', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes') }}</label>
                    </div>
                </div>
            </div>

            <!-- Part 5 -->
            <div class="row align-items-center mt-3">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 5') }}</span>
                        <h2 class="font-lg-18">{{ __('List Certain Gifts and Contributions') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <div class="col-md-12 pl-0 pr-0 mt-2 d-flex">
                    <label for=""> <strong>13.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 2 years before you filed for
                                bankruptcy,
                                did you give any gifts with a total value of more than $600 per
                                person?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check13'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check13')]) ? Helper::validate_key_toggle(base64_encode('B_107-check13'), $sofa, 'no') : Helper::validate_key_toggle('list_any_gifts', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group ">
                        <input name="<?php echo base64_encode('B_107-check13'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check13')]) ? Helper::validate_key_toggle(base64_encode('B_107-check13'), $sofa, 'yes') : Helper::validate_key_toggle('list_any_gifts', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details for each gift') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_any_gifts', $finacial_affairs);?>">
                    <div class="row pl-3 mt-3">
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="{{ __('Gifts with a total value of more than $600  per person') }}" style="padding-left: 0px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="{{ __('Describe the gifts') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="{{ __('Date action was taken') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="{{ __('Amount')}}" style="padding-left: 2px;"></x-financialAffairsPart5Headings>
                    </div>
                </div>


                <?php
                    if (!empty($finacial_affairs['list_any_gifts_data']['recipient_address'])) {
                        for ($i = 0;$i < count($finacial_affairs['list_any_gifts_data']['recipient_address']);$i++) {

                            $finacial_affairgift = $finacial_affairs['list_any_gifts_data'];
                            $alpha_4 = '';
                            if ($i == 0) {
                                $alpha_4 = 'a';
                            } elseif ($i == 1) {
                                $alpha_4 = 'b';
                            }
                            ?>

                    <!-- Second Row Body -->
                <div class="col-md-12 mt-2 <?php echo Helper::key_hide_show_v('list_any_gifts', $finacial_affairs);?>">
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <div class="row">
                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Name to who you gave gift 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Name to who you gave gift 13'.$alpha_4)] ?? Helper::validate_key_loop_value('recipient_address', $finacial_affairgift, $i);?>" class="form-control">
                                        <label>{{ __('Person to Whom You Gave the Gift') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-address 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 13'.$alpha_4)] ?? Helper::validate_key_loop_value('creditor_street', $finacial_affairgift, $i);?>" class="form-control">
                                        <label>{{ __('Street') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-City 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-City 13'.$alpha_4)] ?? Helper::validate_key_loop_value('creditor_city', $finacial_affairgift, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-State 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 13'.$alpha_4)] ?? Helper::validate_key_loop_value('creditor_state', $finacial_affairgift, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-ZIP Code 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 13'.$alpha_4)] ?? Helper::validate_key_loop_value('creditor_zip', $finacial_affairgift, $i);?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Relation 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Relation 13'.$alpha_4)] ?? Helper::validate_key_loop_value('relationship', $finacial_affairgift, $i);?>" class="form-control">
                                        <label>{{ __("Person’s relationship to you") }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-2 pr-0">
                            <div class="input-group">
                                <textarea name="<?php echo base64_encode('B_107-Describe 13'.$alpha_4); ?>" class="form-control" cols="30" rows="9"><?php echo $sofa[base64_encode('B_107-Describe 13'.$alpha_4)] ?? Helper::validate_key_loop_value('gifts', $finacial_affairgift, $i);?></textarea>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 p-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <input name="<?php echo base64_encode('B_107-Date1 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date1 13'.$alpha_4)] ?? Helper::validate_key_loop_value('gifts_date_from', $finacial_affairgift, $i);?>" class="form-control">
                                    </div>
                                    <div class="input-group mt-2">
                                        <input name="<?php echo base64_encode('B_107-Date2 13'.$alpha_4); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date2 13'.$alpha_4)] ?? Helper::validate_key_loop_value('gifts_date_to', $finacial_affairgift, $i);?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 p-1">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Amount1 13'.$alpha_4)])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Amount1 13'.$alpha_4)]):Helper::priceFormtWithComma(Helper::validate_key_loop_value('gifts_value',$finacial_affairgift,$i));

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Amount1 13'.$alpha_4); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>
                            <div class="input-group d-flex mt-2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode('B_107-Amount2 13'.$alpha_4); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Amount2 13'.$alpha_4)]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Amount2 13'.$alpha_4)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('gifts_value1', $finacial_affairgift, $i));?>" class="price-field form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                        } ?>
                    <!-- Third Row Body -->


                <!-- Row 14	 -->
                <!-- First Row Heading -->
                <div class="col-md-12 pl-0 pr-0 mt-3 d-flex">
                    <label for=""> <strong>14.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 2 years before you filed for
                                bankruptcy,
                                did you give any gifts or contributions with a total value of more
                                than
                                $600 to any charity?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group ">
                    <input name="<?php echo base64_encode('B_107-check14'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check14')]) ? Helper::validate_key_toggle(base64_encode('B_107-check14'), $sofa, 'no') : Helper::validate_key_toggle('gifts_charity', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group ">
                    <input name="<?php echo base64_encode('B_107-check14'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check14')]) ? Helper::validate_key_toggle(base64_encode('B_107-check14'), $sofa, 'yes') : Helper::validate_key_toggle('gifts_charity', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details for each gift or contribution.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('gifts_charity', $finacial_affairs);?>">
                    <div class="row pl-3 mt-3">
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="{{ __('Gifts with a total value of more than $600  per person') }}" style="padding-left: 0px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="{{ __('Describe the gifts') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="{{ __('Date action was taken') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="{{ __('Amount')}}" style="padding-left: 2px;"></x-financialAffairsPart5Headings>
                    </div>
                </div>
                <?php
                        if (!empty($finacial_affairs['gifts_charity_data']['charity_address'])) {
                            for ($i = 0;$i < count($finacial_affairs['gifts_charity_data']['charity_address']);$i++) {

                                $finacial_affairdata = $finacial_affairs['gifts_charity_data']
                                ?>
                    <!-- Second Row Body -->
                <div class="col-md-12 border-bottm-1 mb-3 <?php echo Helper::key_hide_show_v('gifts_charity', $finacial_affairs);?>">
                    <div class="row">
                    <div class="col-md-4 mt-2">
                            <div class="row">
                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Charitys Name 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Charitys Name 14')] ?? Helper::validate_key_loop_value('charity_address', $finacial_affairdata, $i);?>" class="form-control">
                                        <label>{{ __('Person to Whom You Gave the Gift') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-12 pr-0">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-address 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 14')] ?? Helper::validate_key_loop_value('charity_street', $finacial_affairdata, $i);?>" class="form-control">
                                        <label>{{ __('Street') }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-City 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-City 14')] ?? Helper::validate_key_loop_value('charity_city', $finacial_affairdata, $i);?>" class="form-control">
                                        <label for="">{{ __('City') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-1 pl-1">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-State 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 14')] ?? Helper::validate_key_loop_value('charity_state', $finacial_affairdata, $i);?>" class="form-control">
                                        <label for="">{{ __('State') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 pr-0">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-ZIP Code 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 14')] ?? Helper::validate_key_loop_value('charity_zip', $finacial_affairdata, $i);?>" class="form-control">
                                        <label for="">{{ __('ZIP Code') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4 mt-2 pr-0">
                            <div class="input-group">
                                <textarea name="<?php echo base64_encode('B_107-Describe 14'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe 14')] ?? Helper::validate_key_loop_value('charity_contribution', $finacial_affairdata, $i);?></textarea>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 p-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Date1 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date1 14')] ?? Helper::validate_key_loop_value('charity_contribution_date', $finacial_affairdata, $i);?>" class="form-control">
                                    </div>
                                    <div class="input-group mt-2">
                                    <input name="<?php echo base64_encode('B_107-Date2 14'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date2 14')] ?? Helper::validate_key_loop_value('charity_contribution_date1', $finacial_affairdata, $i);?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mt-2 p-1">
                            @php

                                $grossvalue = isset($sofa[base64_encode('B_107-Amount1 14')])?Helper::priceFormtWithComma($sofa[base64_encode('B_107-Amount1 14')]):Helper::priceFormtWithComma(Helper::validate_key_loop_value('charity_contribution_value',$finacial_affairdata,$i));

                            @endphp

                            <x-sourceOfIncomeGrossInput divClass="mt-3" span="$" name="<?php echo base64_encode('B_107-Amount1 14'); ?>" type="text" value="{{ $grossvalue }}" inputClass="price-field form-control"></x-sourceOfIncomeGrossInput>

                            <div class="input-group d-flex mt-2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode('B_107-Amount2 14'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Amount2 14')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Amount2 14')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('charity_contribution_value1', $finacial_affairdata, $i));?>" class="price-field form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <?php }
                            } ?>
                    <!-- Third Row Body -->
            </div>

            <!-- Part 6 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 6') }}</span>
                        <h2 class="font-lg-18">{{ __('List Certain Losses') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <div class="col-md-12 pl-0 pr-0 mt-3 d-flex">
                    <label for=""> <strong>15.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                                 {{ __('Within 1 year before you filed for
                                bankruptcy or
                                since you filed for bankruptcy, did you lose anything because of
                                theft,
                                fire, other
                                disaster, or gambling?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group ">
                    <input name="<?php echo base64_encode('B_107-check15'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check15')]) ? Helper::validate_key_toggle(base64_encode('B_107-check15'), $sofa, 'no') : Helper::validate_key_toggle('losses_from_fire', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group ">
                    <input name="<?php echo base64_encode('B_107-check15'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check15')]) ? Helper::validate_key_toggle(base64_encode('B_107-check15'), $sofa, 'yes') : Helper::validate_key_toggle('losses_from_fire', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('losses_from_fire', $finacial_affairs);?>">
                    <div class="row pl-3 mt-3">
                        <div class="col-md-3 gray_bg_with_border" style="padding-left: 0px; padding-right: 2px;">
                            <div class="column-heading">
                                <h4>{{ __('Describe the property you lost and how the loss occurred') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-5 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Describe any insurance coverage for the loss') }}</h4><br>
                                <p class="mb-0">{{ __('Include the amount that insurance has paid. List pending
                                    insurance
                                    claims on line 33 of Schedule A/B: Property.') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Date of your loss') }} </h4>
                            </div>
                        </div>
                        <div class="col-md-2 pr-3 gray_bg_with_border"  style="padding-left: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Value of property lost') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 mb-3 <?php echo Helper::key_hide_show_v('losses_from_fire', $finacial_affairs);?>">
                    <?php
                                if (!empty($finacial_affairs['losses_from_fire_data']['loss_description'])) {
                                    for ($i = 0;$i < count($finacial_affairs['losses_from_fire_data']['loss_description']);$i++) {

                                        $finacial_affairfire = $finacial_affairs['losses_from_fire_data']
                                        ?>
                    <div class="row <?php if ($i > 0) { ?> mt-3 <?php } ?>">
                        <div class="col-md-3 pr-0">
                            <div class="input-group" style="padding-left: 3px;">
                                <textarea name="<?php echo base64_encode('B_107-Describe1 15'); ?>"  class="form-control" rows="3"><?php echo $sofa[base64_encode('B_107-Describe1 15')] ?? Helper::validate_key_loop_value('loss_description', $finacial_affairfire, $i);?></textarea>
                            </div>
                        </div>
                        <div class="col-md-5 pr-1">
                            <div class="input-group">
                                <textarea name="<?php echo base64_encode('B_107-Describe2 15'); ?>"  class="form-control" rows="3"><?php echo $sofa[base64_encode('B_107-Describe2 15')] ?? Helper::validate_key_loop_value('transferred_description', $finacial_affairfire, $i);?></textarea>
                            </div>
                        </div>
                        <div class="col-md-2 pr-0 " style="padding-left: 8px;">
                            <div class="input-group">
                                <input name="<?php echo base64_encode('B_107-Date1 15'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date1 15')] ?? Helper::validate_key_loop_value('loss_date_payment', $finacial_affairfire, $i);?>" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2 pr-0" style="padding-left: 8px;">
                            <div class="input-group d-flex">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">$</span>
                                </div>
                                <input name="<?php echo base64_encode('B_107-Amount1 15'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Amount1 15')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Amount1 15')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('loss_amount_payment', $finacial_affairfire, $i));?>" class="price-field form-control">
                            </div>
                        </div>
                    </div>
                    <?php }
                                    } ?>

                </div>
            </div>


            <!-- Part 7 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 7') }}</span>
                        <h2 class="font-lg-18">{{ __('List Certain Payments or Transfers') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <!-- 16 -->
                <div class="row">
                    <div class="col-md-12  mt-3 d-flex">
                        <label for=""> <strong>16.</strong></label>
                        <div class="row pl-1">
                            <div class="col-md-12">
                                <strong>
                                    {{ __('Within 1 year before you filed for
                                    bankruptcy,
                                    did you or anyone else acting on your behalf pay or transfer any
                                    property to anyone
                                    you consulted about seeking bankruptcy or preparing a bankruptcy
                                    petition?') }}
                                </strong>
                                <p>{{ __('Include any attorneys, bankruptcy petition preparers, or credit
                                counseling agencies for services required in your bankruptcy.') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check16'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check16')]) ? Helper::validate_key_toggle(base64_encode('B_107-check16'), $sofa, 'no') : Helper::validate_key_toggle('property_transferred', $finacial_affairs, 0);?>>
                            <label>{{ __('No.') }}</label>
                        </div>
                        <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check16'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check16')]) ? Helper::validate_key_toggle(base64_encode('B_107-check16'), $sofa, 'yes') : Helper::validate_key_toggle('property_transferred', $finacial_affairs, 1);?>>
                            <label>{{ __('Yes. Fill in the details.') }}</label>
                        </div>
                    </div>

                    <div class="col-md-12 <?php echo Helper::key_hide_show_v('property_transferred', $finacial_affairs);?>">
                        <div class="row pl-3 mt-2">
                            <div class="col-md-4"></div>
                            <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="{{ __('Description and value of any property transferred') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                            <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="{{ __('Date payment or transfer was made') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                            <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="{{ __('Amount of payment') }}" style="padding-left: 2px; border-right: 16px solid white;"></x-financialAffairsPart5Headings>
                        </div>
                    </div>
                    <div class="col-md-12 <?php echo Helper::key_hide_show_v('property_transferred', $finacial_affairs);?>">
                        <div class="row pl-3">
                        <!-- body -->
                        <?php
                                        if (!empty($finacial_affairs['property_transferred_data']['person_paid'])) {

                                            for ($i = 0;$i < count($finacial_affairs['property_transferred_data']['person_paid']);$i++) {

                                                $finacial_affairtrans = $finacial_affairs['property_transferred_data'];
                                                $alpha_5 = '';
                                                if ($i == 0) {
                                                    $name = 'B_107-Name to who you was paid 16a';
                                                    $street = 'B_107-address 16a';
                                                    $city = 'B_107-City 16a';
                                                    $state = 'B_107-State 16a';
                                                    $zip = 'B_107-ZIP Code 16a';
                                                    $mail = 'B_107-Email 16a';
                                                    $personWhoMade = 'B_107-Person who paid 16a';
                                                    $description = 'B_107-Describe 16a';
                                                    $dateA = 'B_107-Date1 16a';
                                                    $dateB = 'B_107-Date2 16a';
                                                    $amountA = 'B_107-Amount1 16a';
                                                    $amountB = 'B_107-Amount2 16a';
                                                } elseif ($i == 1) {
                                                    $name = 'Name to who you was paid 16bB_107-';
                                                    $street = 'address 16bB_107-';
                                                    $city = 'City 16bB_107-';
                                                    $state = 'State 16bB_107-';
                                                    $zip = 'ZIP Code 16bB_107-';
                                                    $mail = 'Email 16bB_107-';
                                                    $personWhoMade = 'Person who paid 16bB_107-';
                                                    $description = 'Describe 16bB_107-';
                                                    $dateA = 'Date1 16bB_107-';
                                                    $dateB = 'Date2 16bB_107-';
                                                    $amountA = 'Amount1 16bB_107-';
                                                    $amountB = 'Amount2 16bB_107-';
                                                } elseif ($i > 1) {
                                                    $name = '';
                                                    $street = '';
                                                    $city = '';
                                                    $state = '';
                                                    $zip = '';
                                                    $mail = '';
                                                    $personWhoMade = '';
                                                    $description = '';
                                                    $dateA = '';
                                                    $dateB = '';
                                                    $amountA = '';
                                                    $amountB = '';
                                                }
                                                if (!empty(Helper::validate_key_loop_value('person_paid', $finacial_affairtrans, $i))) {
                                                    ?>

                        <div class="col-md-12 border-bottm-1 mt-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12 pr-2">
                                            <div class="input-group">
                                                <input name="<?php echo base64_encode($name); ?>" type="text" value="<?php echo $sofa[base64_encode($name)] ?? Helper::validate_key_loop_value('person_paid', $finacial_affairtrans, $i);?>" class="form-control">
                                                <label>{{ __('Person Who Was Paid') }} </label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pr-2">
                                            <div class="input-group">
                                                <input name="<?php echo base64_encode($street); ?>" type="text" value="<?php echo $sofa[base64_encode($street)] ?? Helper::validate_key_loop_value("person_paid_street", $finacial_affairtrans, $i);?>" class="form-control">
                                                <label>{{ __('Street') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 pr-1">
                                            <div class="input-group">
                                            <input name="<?php echo base64_encode($city); ?>" type="text" value="<?php echo $sofa[base64_encode($city)] ?? Helper::validate_key_loop_value("person_paid_city", $finacial_affairtrans, $i);?>" class="form-control">
                                                <label for="">{{ __('City') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-1 pl-1">
                                            <div class="input-group">
                                            <input name="<?php echo base64_encode($state); ?>" type="text" value="<?php echo $sofa[base64_encode($state)] ?? Helper::validate_key_loop_value("person_paid_state", $finacial_affairtrans, $i);?>" class="form-control">
                                                <label for="">{{ __('State') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 pr-2">
                                            <div class="input-group">
                                            <input name="<?php echo base64_encode($zip); ?>" type="text" value="<?php echo $sofa[base64_encode($zip)] ?? Helper::validate_key_loop_value("person_paid_zip", $finacial_affairtrans, $i);?>" class="form-control">
                                                <label for="">{{ __('ZIP Code') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pr-2">
                                            <div class="input-group">
                                                <input name="<?php echo base64_encode($mail); ?>" type="text" value="<?php echo $sofa[base64_encode($mail)] ?? Helper::validate_key_loop_value('person_email_or_website', $finacial_affairtrans, $i);?>" class="form-control">
                                                <label> {{ __('Email or website address') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12 pr-2">
                                            <div class="input-group">
                                                <input name="<?php echo base64_encode($personWhoMade); ?>" type="text" value="<?php echo $sofa[base64_encode($personWhoMade)] ?? Helper::validate_key_loop_value('person_made_payment', $finacial_affairtrans, $i);?>" class="form-control">
                                                <label>{{ __('Person Who Made the Payment, if Not You') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left:3px;">
                                    <div class="input-group">
                                        <textarea name="<?php echo base64_encode($description); ?>" class="form-control" cols="30" rows="9"><?php echo $sofa[base64_encode($description)] ?? Helper::validate_key_loop_value('property_transferred_value', $finacial_affairtrans, $i);?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="row">
                                        <div class="col-md-12" style="padding-left:3px;">
                                            <div class="input-group">
                                                <input name="<?php echo base64_encode($dateA); ?>" type="text" value="<?php echo $sofa[base64_encode($dateA)] ?? Helper::validate_key_loop_value('property_transferred_date', $finacial_affairtrans, $i);?>" class="<?php if (Helper::validate_key_loop_value('attorney_added_field', $finacial_affairtrans, $i) == 1) { ?> date-by-attorney <?php } ?> form-control">
                                            </div>
                                            <div class="input-group mt-2">
                                                <input name="<?php echo base64_encode($dateB); ?>" type="text" value="<?php echo $sofa[base64_encode($dateB)] ?? ''?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 pl-0">
                                    <div class="input-group d-flex">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode($amountA); ?>" type="text" value="<?php echo isset($sofa[base64_encode($amountA)]) ? Helper::priceFormtWithComma($sofa[base64_encode($amountA)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_transferred_payment', $finacial_affairtrans, $i));?>" class="<?php if (Helper::validate_key_loop_value('attorney_added_field', $finacial_affairtrans, $i) == 1) { ?> price-by-attorney <?php } ?>price-field form-control">
                                    </div>
                                    <div class="input-group d-flex mt-2">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">$</span>
                                        </div>
                                        <input name="<?php echo base64_encode($amountB); ?>" type="text" value="<?php echo isset($sofa[base64_encode($amountB)]) ? Helper::priceFormtWithComma($sofa[base64_encode($amountB)]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }
                                                }
                                        }?>
                            <!-- Body 2 -->
                        </div>
                    </div>
                    <!-- 17 -->

                    <div class="col-md-12  mt-3 d-flex">
                        <label for=""> <strong>17.</strong></label>
                        <div class="row pl-1">
                            <div class="col-md-12">
                                <strong>
                                    {{ __('Within 1 year before you filed for bankruptcy, did you or anyone else acting on your behalf pay or transfer any property to anyone who promised to help you deal with your creditors or to make payments to your creditors?') }}
                                </strong>
                                <p>{{ __('Do not include any payment or transfer that you listed on line 16.') }} </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="input-group pl-3">
                            <input name="<?php echo base64_encode('check17B_107-'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check17B_107-')]) ? Helper::validate_key_toggle(base64_encode('check17B_107-'), $sofa, 'no') : Helper::validate_key_toggle('property_transferred_creditors', $finacial_affairs, 0);?>>
                            <label>{{ __('No.') }}</label>
                        </div>
                        <div class="input-group pl-3">
                            <input name="<?php echo base64_encode('check17B_107-'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check17B_107-')]) ? Helper::validate_key_toggle(base64_encode('check17B_107-'), $sofa, 'yes') : Helper::validate_key_toggle('property_transferred_creditors', $finacial_affairs, 1);?>>
                            <label>{{ __('Yes. Fill in the details.') }}</label>
                        </div>
                    </div>

                    <div class="col-md-12 <?php echo Helper::key_hide_show_v('property_transferred_creditors', $finacial_affairs);?>">
                        <div class="row pl-3 mt-2">
                            <div class="col-md-4"></div>
                            <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="{{ __('Description and value of any property transferred') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                            <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="{{ __('Date payment or transfer was made') }}" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                            <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="{{ __('Amount of payment') }}" style="padding-left: 2px; border-right: 16px solid white;"></x-financialAffairsPart5Headings>
                        </div>
                    </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('property_transferred_creditors', $finacial_affairs);?>">
                    <!-- First Row Heading -->

                    <!-- body -->
                    <?php
                    if (!empty($finacial_affairs['property_transferred_creditors_data']['person_paid_address'])) {
                        for ($i = 0;$i < count($finacial_affairs['property_transferred_creditors_data']['person_paid_address']);$i++) {

                            $finacial_affairtrans = $finacial_affairs['property_transferred_creditors_data']
                            ?>
                    <div class="col-md-12 border-bottm-1 mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Name to who you was paid 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Name to who you was paid 17B_107-')] ?? Helper::validate_key_loop_value('person_paid_address', $finacial_affairtrans, $i);?>" class="form-control">
                                            <label>{{ __('Person Who Was Paid') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('address 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('address 17B_107-')] ?? Helper::validate_key_loop_value('person_paid_street', $finacial_affairtrans, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('City 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('City 17B_107-')] ?? Helper::validate_key_loop_value('person_paid_city', $finacial_affairtrans, $i);?>" class="form-control">
                                            <label for="">{{ __('City') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('State 17B_107-')] ?? Helper::validate_key_loop_value('person_paid_state', $finacial_affairtrans, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-2">
                                        <div class="input-group">
                                        <input name="<?php echo base64_encode('ZIP Code 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 17B_107-')] ?? Helper::validate_key_loop_value('person_paid_zip', $finacial_affairtrans, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 pr-0" style="padding-left:7px;">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('Describe 17B_107-'); ?>" class="form-control" cols="30" rows="9"><?php echo $sofa[base64_encode('Describe 17B_107-')] ?? Helper::validate_key_loop_value('property_transfer_value', $finacial_affairtrans, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2" >
                                <div class="row">
                                    <div class="col-md-12 pr-0" style="padding-left:14px;">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Date1 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Date1 17B_107-')] ?? Helper::validate_key_loop_value('property_transfer_date', $finacial_affairtrans, $i);?>" class="form-control">
                                        </div>
                                        <div class="input-group mt-2">
                                            <input name="<?php echo base64_encode('Date2 17B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Date2 17B_107-')] ?? Helper::validate_key_loop_value('property_transfer_date2', $finacial_affairtrans, $i);?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 pl-0 pr-0" style="padding-left:14px;">
                                <div class="input-group d-flex">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount1 17B_107-'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('Amount1 17B_107-')]) ? Helper::priceFormtWithComma($sofa[base64_encode('Amount1 17B_107-')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_transfer_amount_payment', $finacial_affairtrans, $i));?>" class="price-field form-control">
                                </div>
                                <div class="input-group d-flex mt-2">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Amount2 17B_107-'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('Amount2 17B_107-')]) ? Helper::priceFormtWithComma($sofa[base64_encode('Amount2 17B_107-')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_transfer_amount_payment2', $finacial_affairtrans, $i));?>" class="price-field form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php }
                        } ?>
                        <!-- Body 2 -->

                </div>




                <!-- 18 -->
                <div class="col-md-12  mt-3 d-flex">
                    <label for=""> <strong>18.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                                {{ __('Within 2 years before you filed for bankruptcy, did you sell, trade, or otherwise transfer any property to anyone, other than property transferred in the ordinary course of your business or financial affairs?') }}
                            </strong>
                            <p>{{ __('Include both outright transfers and transfers made as security (such as the granting of a security interest or mortgage on your property). Do not include gifts and transfers that you have already listed on this statement.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check18'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check18')]) ? Helper::validate_key_toggle(base64_encode('B_107-check18'), $sofa, 'no') : Helper::validate_key_toggle('Property_all', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check18'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check18')]) ? Helper::validate_key_toggle(base64_encode('B_107-check18'), $sofa, 'yes') : Helper::validate_key_toggle('Property_all', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('Property_all', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-3 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Description and value of any property transferred') }} </h4>
                            </div>
                        </div>
                        <div class="col-md-3 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Date payment or transfer was made') }} </h4>
                            </div>
                        </div>
                        <div class="col-md-2 pr-3 gray_bg_with_border"  style="padding-left: 2px; border-right: 16px solid white;">
                            <div class="column-heading ">
                                <h4>{{ __('Amount of payment') }} </h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-2 <?php echo Helper::key_hide_show_v('Property_all', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                        if (!empty($finacial_affairs['Property_all_data']['name'])) {
                            for ($i = 0;$i < count($finacial_affairs['Property_all_data']['name']);$i++) {

                                $finacial_affairprop = $finacial_affairs['Property_all_data'];
                                $alpha_6 = '';
                                if ($i == 0) {
                                    $personWhoRecievedTransfer18 = 'B_107-Name to who you received transfer 18a';
                                    $address18 = 'address 18aB_107-';
                                    $city18 = 'City 18aB_107-';
                                    $state18 = 'B_107-State 18a';
                                    $zip18 = 'B_107-ZIP Code 18a';
                                    $descriptionA18 = 'B_107-Describe1 18a';
                                    $descriptionB18 = 'B_107-Describe2 18a';
                                    $date18 = 'B_107-Date1 18a';
                                    $relationship = 'B_107-Relation 18a';
                                } elseif ($i == 1) {
                                    $personWhoRecievedTransfer18 = 'Name to who you received transfer 18bB_107-';
                                    $address18 = 'address 18b';
                                    $city18 = 'City 18bB_107-';
                                    $state18 = 'State 18bB_107-';
                                    $zip18 = 'ZIP Code 18bB_107-';
                                    $descriptionA18 = 'Describe1 18bB_107-';
                                    $descriptionB18 = 'Describe2 18bB_107-';
                                    $date18 = 'B_107-date2054';
                                    $relationship = 'Relation 18bB_107-';
                                }
                                ?>
                    <div class="col-md-12 border-bottm-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($personWhoRecievedTransfer18); ?>" type="text" value="<?php echo $sofa[base64_encode($personWhoRecievedTransfer18)] ?? Helper::validate_key_loop_value('name', $finacial_affairprop, $i);?>" class="form-control">
                                            <label>{{ __('Person Who Received Transfer') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($address18); ?>" type="text" value="<?php echo $sofa[base64_encode($address18)] ?? Helper::validate_key_loop_value('street_number', $finacial_affairprop, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($city18); ?>" type="text" value="<?php echo $sofa[base64_encode($city18)] ?? Helper::validate_key_loop_value('city', $finacial_affairprop, $i);?>" class="form-control">
                                            <label for="">{{ __('City') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($state18); ?>" type="text" value="<?php echo $sofa[base64_encode($state18)] ?? Helper::validate_key_loop_value('state', $finacial_affairprop, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($zip18); ?>" type="text" value="<?php echo $sofa[base64_encode($zip18)] ?? Helper::validate_key_loop_value('zip', $finacial_affairprop, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode($relationship); ?>" type="text" value="<?php echo $sofa[base64_encode($relationship)] ?? Helper::validate_key_loop_value('relationship_to_you', $finacial_affairprop, $i);?>" class="form-control">
                                            <label>{{ __("Person’s relationship to you") }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 pr-0" style="padding-left:7px;">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode($descriptionA18); ?>" class="form-control" cols="30" rows="9"><?php echo $sofa[base64_encode($descriptionA18)] ?? Helper::validate_key_loop_value('property_transfer_value', $finacial_affairprop, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 pr-0" style="padding-left:11px;">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode($descriptionB18); ?>" class="form-control" cols="30" rows="9"><?php echo $sofa[base64_encode($descriptionB18)] ?? Helper::validate_key_loop_value('property_exchange', $finacial_affairprop, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode($date18); ?>" type="text" value="<?php echo $sofa[base64_encode($date18)] ?? Helper::validate_key_loop_value('property_transfer_date', $finacial_affairprop, $i);?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                            } ?>
                        <!-- Body 2 -->

                </div>
                <!-- 19 -->
                <div class="col-md-12 mt-3 d-flex">
                    <label for=""> <strong>19.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Within 10 years before you filed for bankruptcy, did you transfer any property to a self-settled trust or similar device of which you are a beneficiary?') }}
                            </strong>
                            {{ __('(These are often called') }} <i>{{ __('asset-protection') }}</i> {{ __('devices.)') }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-2">
                        <input name="<?php echo base64_encode('check19B_107-'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check19B_107-')]) ? Helper::validate_key_toggle(base64_encode('check19B_107-'), $sofa, 'no') : Helper::validate_key_toggle('all_property_transfer_10_year', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group pl-2">
                        <input name="<?php echo base64_encode('check19B_107-'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check19B_107-')]) ? Helper::validate_key_toggle(base64_encode('check19B_107-'), $sofa, 'yes') : Helper::validate_key_toggle('all_property_transfer_10_year', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('all_property_transfer_10_year', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-6 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Description and value of the property transferred') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-2 pr-3 gray_bg_with_border"  style="padding-left: 2px; border-right: 16px solid white;">
                            <div class="column-heading ">
                                <h4>{{ __('Date transfer was made') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-2 mb-2 <?php echo Helper::key_hide_show_v('all_property_transfer_10_year', $finacial_affairs);?>">
                    <!-- body -->

                    <?php
                            if (!empty($finacial_affairs['all_property_transfer_10_year_data']['trust_name'])) {
                                for ($i = 0;$i < count($finacial_affairs['all_property_transfer_10_year_data']['trust_name']);$i++) {

                                    $finacial_affairprop = $finacial_affairs['all_property_transfer_10_year_data']
                                    ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <label>{{ __('Name of trust') }} </label>
                                    <input name="<?php echo base64_encode('Name of trust1 19B_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Name of trust1 19B_107-')] ?? Helper::validate_key_loop_value('trust_name', $finacial_affairs, $i);?>" class="form-control mt-2">
                                </div>
                            </div>
                            <div class="col-md-6 pr-0" style="padding-left:8px;">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('Describe 19B_107-'); ?>" class="form-control" cols="30" rows="5"><?php echo $sofa[base64_encode('Describe 19B_107-')] ?? Helper::validate_key_loop_value('10year_property_transfer', $finacial_affairs, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Date1 18bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Date1 18bB_107-')] ?? Helper::validate_key_loop_value('10year_property_transfer_date', $finacial_affairs, $i);?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                } ?>
                </div>
                </div>

            </div>

            <!-- Part 7 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 8') }}</span>
                        <h2 class="font-lg-18">{{ __('List Certain Financial Accounts, Instruments, Safe
                            Deposit Boxes, and Storage Units') }}
                        </h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3 pl-0 pr-0">
                <!-- 20 -->
                <div class="col-md-12 mt-2 d-flex">
                    <label for=""> <strong>20.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                            {{ __('Within 1 year before you filed for bankruptcy, were any financial accounts or
                            instruments held in your name, or for your benefit, closed, sold, moved, or transferred?') }}<br>
                            {{ __('Include checking, savings, money market, or other financial accounts; certificates of deposit;
                            shares in banks, credit unions, brokerage houses, pension funds, cooperatives, associations,
                             and other financial institutions.') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check20B_107-'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check20B_107-')]) ? Helper::validate_key_toggle(base64_encode('check20B_107-'), $sofa, 'no') : Helper::validate_key_toggle('list_all_financial_accounts', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check20B_107-'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check20B_107-')]) ? Helper::validate_key_toggle(base64_encode('check20B_107-'), $sofa, 'yes') : Helper::validate_key_toggle('list_all_financial_accounts', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_all_financial_accounts', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-2 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Last 4 digits of account number') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-2 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Type of account or instrument') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-2 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Date account was closed, sold, moved, or transferred') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-2 pr-3 gray_bg_with_border"  style="padding-left: 2px; border-right: 16px solid white;">
                            <div class="column-heading ">
                                <h4>{{ __('Last balance before closing or transfer') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-2 <?php echo Helper::key_hide_show_v('list_all_financial_accounts', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                                if (!empty($finacial_affairs['list_all_financial_accounts_data']['institution_name'])) {
                                    for ($i = 0;$i < count($finacial_affairs['list_all_financial_accounts_data']['institution_name']);$i++) {
                                        $finacial_affairs_list_all = $finacial_affairs['list_all_financial_accounts_data'];
                                        $alpha_7 = '';
                                        if ($i == 0) {
                                            $alpha_7 = 'aB_107-';
                                        } elseif ($i == 1) {
                                            $alpha_7 = 'bB_107-';
                                        }
                                        ?>
                    <div class="col-md-12 border-bottm-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Name of financial institution 20'.$alpha_7); ?>" type="text" value="<?php echo $sofa[base64_encode('Name of financial institution 20'.$alpha_7)] ?? Helper::validate_key_loop_value('institution_name', $finacial_affairs_list_all, $i);?>" class="form-control">
                                            <label>{{ __('Name of Financial Institution') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('address 20'.$alpha_7); ?>" type="text" value="<?php echo $sofa[base64_encode('address 20'.$alpha_7)] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_list_all, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('City 20'.$alpha_7); ?>" type="text" value="<?php echo $sofa[base64_encode('City 20'.$alpha_7)] ?? Helper::validate_key_loop_value('city', $finacial_affairs_list_all, $i);?>" class="form-control">
                                            <label for="">{{ __('City') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 20'.$alpha_7); ?>" type="text" value="<?php echo $sofa[base64_encode('State 20'.$alpha_7)] ?? Helper::validate_key_loop_value('state', $finacial_affairs_list_all, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('ZIP Code 20'.$alpha_7.'.1'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 20'.$alpha_7.'.1')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_list_all, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 pr-0" style="padding-left:8px;">
                                <div class="input-group d-flex">
                                    <label for="">{{ __('XXXX') }}</label>
                                    <input name="<?php echo base64_encode('account number 20'.$alpha_7); ?>" type="text" value="<?php echo $sofa[base64_encode('account number 20'.$alpha_7)] ?? Helper::validate_key_loop_value('account_number', $finacial_affairs_list_all, $i);?>" class="form-control ml-2">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check Checking 20'.$alpha_7); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check Checking 20'.$alpha_7)]) ? Helper::validate_key_toggle(base64_encode('check Checking 20'.$alpha_7), $sofa, 'yes') : Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs_list_all, 1, $i);?>>
                                    <label for="">{{ __('Checking') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check Savings 20'.$alpha_7); ?>" value="no"  type="checkbox" <?php echo isset($sofa[base64_encode('check Savings 20'.$alpha_7)]) ? Helper::validate_key_toggle(base64_encode('check Savings 20'.$alpha_7), $sofa, 'no') : Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs_list_all, 2, $i);?>>
                                    <label for="">{{ __('Savings') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check Money market 20'.$alpha_7); ?>" value="yes"  type="checkbox" <?php echo isset($sofa[base64_encode('check Money market 20'.$alpha_7)]) ? Helper::validate_key_toggle(base64_encode('check Money market 20'.$alpha_7), $sofa, 'yes') : Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs_list_all, 3, $i);?>>
                                    <label for="">{{ __('Money market') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check brokerage 20'.$alpha_7); ?>" value="no"  type="checkbox" <?php echo isset($sofa[base64_encode('check brokerage 20'.$alpha_7)]) ? Helper::validate_key_toggle(base64_encode('check brokerage 20'.$alpha_7), $sofa, 'no') : Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs_list_all, 4, $i);?>>
                                    <label for="">{{ __('Brokerage') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check other 20'.$alpha_7); ?>" value="yes"  type="checkbox" <?php echo isset($sofa[base64_encode('check other 20'.$alpha_7)]) ? Helper::validate_key_toggle(base64_encode('check other 20'.$alpha_7), $sofa, 'yes') : Helper::validate_key_loop_toggle('type_of_account', $finacial_affairs_list_all, 5, $i);?>>
                                    <label for="">{{ __('Other') }}</label>
                                    <input name="<?php echo base64_encode('Other 20'.$alpha_7);?>" type="text" value="<?php echo $sofa[base64_encode('Other 20'.$alpha_7)] ?? '';?>" class="form-control mt-1">
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('Date closed 20'.$alpha_7); ?>" type="text" value="<?php echo $sofa[base64_encode('Date closed 20'.$alpha_7)] ?? Helper::validate_key_loop_value('date_account_closed', $finacial_affairs_list_all, $i);?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-2  pr-0" style="padding-left7px;">
                                <div class="input-group d-flex">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('Balance 20'.$alpha_7); ?>" type="text" value="<?php echo isset($sofa[base64_encode('Balance 20'.$alpha_7)]) ? Helper::priceFormtWithComma($sofa[base64_encode('Balance 20'.$alpha_7)]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('last_balance', $finacial_affairs_list_all, $i));?>" class="price-field form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                    }?>
                        <!-- Body 2 -->

                </div>

                <!-- 21 -->
                <div class="col-md-12  mt-3 d-flex">
                    <label for=""> <strong>21.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                            {{ __('Do you now have, or did you have within 1 year before you filed for bankruptcy, any safe deposit box or other depository for securities, cash, or other valuables?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group pl-3">
                        <input  name="<?php echo base64_encode('check21B_107-'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check21B_107-')]) ? Helper::validate_key_toggle(base64_encode('check21B_107-'), $sofa, 'no') : Helper::validate_key_toggle('list_safe_deposit', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input  name="<?php echo base64_encode('check21B_107-'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check21B_107-')]) ? Helper::validate_key_toggle(base64_encode('check21B_107-'), $sofa, 'yes') : Helper::validate_key_toggle('list_safe_deposit', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_safe_deposit', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="Who else had access to it?" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="Describe the contents" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="Do you still have it?" style="padding-left: 2px; border-right: 16px solid white;"></x-financialAffairsPart5Headings>
                    </div>
                </div>

                <div class="col-md-12 mt-2 <?php echo Helper::key_hide_show_v('list_safe_deposit', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                                    if (!empty($finacial_affairs['list_safe_deposit_data']['name'])) {
                                        for ($i = 0;$i < count($finacial_affairs['list_safe_deposit_data']['name']);$i++) {
                                            $finacial_affairs_safe = $finacial_affairs['list_safe_deposit_data'];


                                            ?>
                    <div class="col-md-12 border-bottm-1">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Name of financial institution 21aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Name of financial institution 21aB_107-')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label>{{ __('Name of Financial Institution') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('address 21aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('address 21aB_107-')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @php

                                        $cityvalue = $sofa[base64_encode('City 21aB_107-')]??Helper::validate_key_loop_value('city',$finacial_affairs_safe,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('City 21aB_107-'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1" label="City" inputClass=""></x-labelAfterInput>

                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 21aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('State 21aB_107-')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('ZIP Code 21aB_107-.1'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 21aB_107-.1')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Name of who else had access 21bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Name of who else had access 21bB_107-')] ?? Helper::validate_key_loop_value('bo_name', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label>{{ __('Name') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('address 21bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('address 21bB_107-')] ?? Helper::validate_key_loop_value('bo_street_number', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-6 pr-1 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('City 21bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('City 21bB_107-')] ?? Helper::validate_key_loop_value('bo_city', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label for="">{{ __('City') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 21bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('State 21bB_107-')] ?? Helper::validate_key_loop_value('bo_state', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('ZIP Code 21aB_107-.2'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 21aB_107-.2')] ?? Helper::validate_key_loop_value('bo_zip', $finacial_affairs_safe, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('Describe 21B_107-'); ?>" class="form-control" cols="" rows="7"><?php echo $sofa[base64_encode('Describe 21B_107-')] ?? Helper::validate_key_loop_value('contents', $finacial_affairs_safe, $i);?></textarea>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check21aB_107-'); ?>" Value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check21aB_107-')]) ? Helper::validate_key_toggle(base64_encode('check21aB_107-'), $sofa, 'no') : Helper::validate_key_loop_toggle('still_have_safe_deposite', $finacial_affairs_safe, 0, $i);?>>
                                    <label for="">{{ __('No') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('check21aB_107-'); ?>" Value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check21aB_107-')]) ? Helper::validate_key_toggle(base64_encode('check21aB_107-'), $sofa, 'yes') : Helper::validate_key_loop_toggle('still_have_safe_deposite', $finacial_affairs_safe, 1, $i);?>>
                                    <label for="">{{ __('Yes') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                        } ?>
                </div>

                <!-- 22 -->
                <div class="col-md-12  mt-3 d-flex">
                    <label for=""> <strong>22.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                            {{ __('Have you stored property in a storage unit or place other than your home within 1 year before you filed for bankruptcy?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check22B_107-'); ?>" Value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check22B_107-')]) ? Helper::validate_key_toggle(base64_encode('check22B_107-'), $sofa, 'no') : Helper::validate_key_toggle('other_storage_unit', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check22B_107-'); ?>" Value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check22B_107-')]) ? Helper::validate_key_toggle(base64_encode('check22B_107-'), $sofa, 'yes') : Helper::validate_key_toggle('other_storage_unit', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('other_storage_unit', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="Who else had access to it?" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="Describe the contents" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="Do you still have it?" style="padding-left: 2px; border-right: 16px solid white;"></x-financialAffairsPart5Headings>
                    </div>
                </div>
                <div class="col-md-12 mt-2 mb-2 <?php echo Helper::key_hide_show_v('other_storage_unit', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                                        if (!empty($finacial_affairs['other_storage_unit_data']['name'])) {
                                            for ($i = 0;$i < count($finacial_affairs['other_storage_unit_data']['name']);$i++) {
                                                $finacial_affairs_storage = $finacial_affairs['other_storage_unit_data'];
                                                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Name of financial institution 22aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Name of financial institution 22aB_107-')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label>{{ __('Name of Storage Facility') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('address 22aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('address 22aB_107-')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('City 22aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('City 22aB_107-')] ?? Helper::validate_key_loop_value('city', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label for="">{{ __('City') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 22aB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('State 22aB_107-')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('ZIP Code 22aB_107-.1'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 22aB_107-.1')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('Name of who else had access 22bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('Name of who else had access 22bB_107-')] ?? Helper::validate_key_loop_value('bd_name', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label>{{ __('Name') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('address 22bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('address 22bB_107-')] ?? Helper::validate_key_loop_value('bd_street_number', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('City 22bB_107-')]??Helper::validate_key_loop_value('bd_city',$finacial_affairs_storage,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('City 22bB_107-'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 22bB_107-'); ?>" type="text" value="<?php echo $sofa[base64_encode('State 22bB_107-')] ?? Helper::validate_key_loop_value('bd_state', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('ZIP Code 22aB_107-.2'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 22aB_107-.2')] ?? Helper::validate_key_loop_value('bd_zip', $finacial_affairs_storage, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('B_107-Describe 22'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe 22')] ?? Helper::validate_key_loop_value('contents', $finacial_affairs_storage, $i);?></textarea>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check22a'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check22a')]) ? Helper::validate_key_toggle(base64_encode('B_107-check22a'), $sofa, 'no') : Helper::validate_key_loop_toggle('still_have_storage_unit', $finacial_affairs_storage, 0, $i); ?>>
                                    <label for="">{{ __('No') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check22a'); ?>" value="yes" type="checkbox" <?php echo  isset($sofa[base64_encode('B_107-check22a')]) ? Helper::validate_key_toggle(base64_encode('B_107-check22a'), $sofa, 'yes') : Helper::validate_key_loop_toggle('still_have_storage_unit', $finacial_affairs_storage, 1, $i); ?>>
                                    <label for="">{{ __('Yes') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                            } ?>

                </div>
            </div>

            <!-- Part 9 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 9') }}</span>
                        <h2 class="font-lg-18">{{ __('Identify Property You Hold or Control for Someone
                            Else') }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- 23 -->
            <div class="form-border mb-3 pl-0 pr-0">
                <div class="col-md-12  mt-2 d-flex">
                    <label for=""> <strong>23.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                            {{ __('Do you hold or control any property that someone else owns? Include any property you borrowed from, are storing for, or hold in trust for someone.') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check23'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check23')]) ? Helper::validate_key_toggle(base64_encode('B_107-check23'), $sofa, 'no') : Helper::validate_key_toggle('list_property_you_hold', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check23'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check23')]) ? Helper::validate_key_toggle(base64_encode('B_107-check23'), $sofa, 'yes') : Helper::validate_key_toggle('list_property_you_hold', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_property_you_hold', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="Where is the property?" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="Describe the contents" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="Value" style="padding-left: 2px; border-right: 16px solid white;"></x-financialAffairsPart5Headings>
                    </div>
                </div>

                <div class="col-md-12 mt-3 <?php echo Helper::key_hide_show_v('list_property_you_hold', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                                            if (!empty($finacial_affairs['list_property_you_hold_data']['name'])) {
                                                for ($i = 0;$i < count($finacial_affairs['list_property_you_hold_data']['name']);$i++) {
                                                    $finacial_affairs_hold = $finacial_affairs['list_property_you_hold_data'];
                                                    ?>
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Name of owner 23a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Name of owner 23a')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label>{{ __("Owner’s Name") }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-address 23a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 23a')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-City 23a')]??Helper::validate_key_loop_value('city',$finacial_affairs_hold,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-City 23a'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>

                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 23a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 23a')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 23a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 23a')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-address 23b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 23b')] ?? Helper::validate_key_loop_value('location_street_number', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-City 23b')]??Helper::validate_key_loop_value('location_city',$finacial_affairs_hold,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-City 23b'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>

                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 23b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 23b')] ?? Helper::validate_key_loop_value('location_state', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 23b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 23b')] ?? Helper::validate_key_loop_value('location_zip', $finacial_affairs_hold, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2  pr-0">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('B_107-Describe 23'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe 23')] ?? Helper::validate_key_loop_value('property_desc', $finacial_affairs_hold, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2 pr-0">
                                <div class="input-group d-flex">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">$</span>
                                    </div>
                                    <input name="<?php echo base64_encode('B_107-Value 23b'); ?>" type="text" value="<?php echo isset($sofa[base64_encode('B_107-Value 23b')]) ? Helper::priceFormtWithComma($sofa[base64_encode('B_107-Value 23b')]) : Helper::priceFormtWithComma(Helper::validate_key_loop_value('property_value', $finacial_affairs_hold, $i));?>" class="price-field form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                                } ?>
                </div>
            </div>

            <!-- Part 10 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 10') }}</span>
                        <h2 class="font-lg-18">{{ __('Give Details About Environmental Information') }}
                        </h2>
                    </div>
                </div>
            </div>

            <!-- 24 -->
            <div class="form-border mb-3 pr-0 pl-0">
                <div class="col-md-12 mt-2">
                    <div class="input-group d-inline-block">
                        <label for="" style="font-weight:bold;">{{ __('For the purpose of Part 10, the following definitions apply:') }}</label>
                        <ul class="list-square" style="font-weight:bold;">
                            <li>
                                <i>{{ __('Environmental law') }}</i> {{ __('means any federal, state, or local statute or
                                regulation concerning pollution, contamination, releases of hazardous
                                or toxic substances, wastes, or material into the air, land, soil,
                                surface water, groundwater, or other medium, including statutes or
                                regulations controlling the cleanup of these substances, wastes,
                                or material.') }}
                            </li>
                            <li>
                                <i>{{ __('Site') }}</i> {{ __('means any location, facility, or property as defined under any
                                environmental law, whether you now own, operate, or
                                utilize it or used to own, operate, or utilize it, including
                                disposal
                                sites.') }}
                            </li>
                            <li>
                                <i>{{ __('Hazardous material') }}</i> {{ __('means anything an environmental law defines as a
                                hazardous waste, hazardous substance, toxic
                                substance, hazardous material, pollutant, contaminant, or similar
                                term.') }}
                            </li>
                        </ul>
                        <label style="font-weight:bold;">
                            {{ __('Report all notices, releases, and proceedings that you know about,
                            regardless of when they occurred.') }}
                        </label>
                    </div>
                </div>
                <div class="col-md-12 mt-3 d-flex">
                    <label for=""> <strong>24.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                                {{ __('Has any governmental unit notified you that you may be
                                liable
                                or potentially liable under or in violation of an environmental
                                law?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check24'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check24')]) ? Helper::validate_key_toggle(base64_encode('B_107-check24'), $sofa, 'no') : Helper::validate_key_toggle('list_noticeby_gov', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check24'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check24')]) ? Helper::validate_key_toggle(base64_encode('B_107-check24'), $sofa, 'yes') : Helper::validate_key_toggle('list_noticeby_gov', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_noticeby_gov', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <x-financialAffairsPart5Headings divClass="col-md-4 gray_bg_with_border" title="Governmental unit" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 gray_bg_with_border" title="Environmental law, if you know it" style="padding-left: 2px; padding-right: 2px;"></x-financialAffairsPart5Headings>
                        <x-financialAffairsPart5Headings divClass="col-md-2 pr-3 gray_bg_with_border" title="Date of notice" style="padding-left: 2px; border-right: 16px solid white;"></x-financialAffairsPart5Headings>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_noticeby_gov', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                                                if (!empty($finacial_affairs['list_noticeby_gov_data']['name'])) {
                                                    for ($i = 0;$i < count($finacial_affairs['list_noticeby_gov_data']['name']);$i++) {
                                                        $finacial_affairs_gov = $finacial_affairs['list_noticeby_gov_data'];
                                                        ?>
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input  name="<?php echo base64_encode('B_107-Name of site 24a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Name of site 24a')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label>{{ __('Name of site') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-address 24a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 24a')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-city-10')]??Helper::validate_key_loop_value('city',$finacial_affairs_gov,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-city-10'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 24a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 24a')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 24a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 24a')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input  name="<?php echo base64_encode('B_107-Government unit 24b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Government unit 24b')] ?? Helper::validate_key_loop_value('gov_name', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label>{{ __('Governmental unit') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input  name="<?php echo base64_encode('B_107-Address2 24b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Address2 24b')] ?? Helper::validate_key_loop_value('gov_street_number', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-City 24b')]??Helper::validate_key_loop_value('gov_city',$finacial_affairs_gov,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-City 24b'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 24b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 24b')] ?? Helper::validate_key_loop_value('gov_state', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 24b'); ?>"  type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 24b')] ?? Helper::validate_key_loop_value('gov_zip', $finacial_affairs_gov, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <textarea  name="<?php echo base64_encode('B_107-Describe 24'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe 24')] ?? Helper::validate_key_loop_value('environmental_law', $finacial_affairs_gov, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="input-group">
                                    <input  name="<?php echo base64_encode('B_107-Date 24'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date 24')] ?? Helper::validate_key_loop_value('notice_date', $finacial_affairs_gov, $i);?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                                    } ?>
                </div>

                <!-- 25 -->
                <div class="col-md-12 mt-3 d-flex">
                    <label for=""> <strong>25.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                                {{ __('Have you notified any governmental unit of any release of hazardous material?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check25'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check25')]) ? Helper::validate_key_toggle(base64_encode('B_107-check25'), $sofa, 'no') : Helper::validate_key_toggle('list_environment_law', $finacial_affairs, 0);?>>
                        <label>{{ __('No.') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check25'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check25')]) ? Helper::validate_key_toggle(base64_encode('B_107-check25'), $sofa, 'no') : Helper::validate_key_toggle('list_environment_law', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. Fill in the details.') }}</label>
                    </div>
                </div>

                <div class="col-md-12 <?php echo Helper::key_hide_show_v('list_environment_law', $finacial_affairs);?>">
                    <div class="row pl-3 mt-2">
                        <div class="col-md-4"></div>
                        <div class="col-md-4 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>Governmental unit</h4>
                            </div>
                        </div>
                        <div class="col-md-2 gray_bg_with_border" style="padding-left: 2px; padding-right: 2px;">
                            <div class="column-heading ">
                                <h4>{{ __('Environmental law, if you know it') }}</h4>
                            </div>
                        </div>
                        <div class="col-md-2 pr-3 gray_bg_with_border"  style="padding-left: 2px; border-right: 16px solid white;">
                            <div class="column-heading ">
                                <h4>{{ __('Date of notice') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 <?php echo Helper::key_hide_show_v('list_environment_law', $finacial_affairs);?>">
                    <?php
                                                    if (!empty($finacial_affairs['list_environment_law_data']['name'])) {
                                                        for ($i = 0;$i < count($finacial_affairs['list_environment_law_data']['name']);$i++) {
                                                            $finacial_affairs_law = $finacial_affairs['list_environment_law_data'];
                                                            ?>
                        <!-- body -->
                        <div class="col-md-12  <?php if ($i > 0) { ?> mt-1 <?php } ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Name of site 25a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Name of site 25a')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label>{{ __('Name of site') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-address 25a'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 25a')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('City 25a')]??Helper::validate_key_loop_value('city',$finacial_affairs_law,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('City 25a'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('State 25a'); ?>" type="text" value="<?php echo $sofa[base64_encode('State 25a')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('ZIP Code 25a'); ?>" type="text" value="<?php echo $sofa[base64_encode('ZIP Code 25a')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Government unit 25b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Government unit 25b')] ?? Helper::validate_key_loop_value('gov_name', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label>{{ __('Governmental unit') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Address2 25b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Address2 25b')] ?? Helper::validate_key_loop_value('gov_street_number', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-City 25b')]??Helper::validate_key_loop_value('gov_city',$finacial_affairs_law,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-City 25b'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 25b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 25b')] ?? Helper::validate_key_loop_value('gov_state', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 25b'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 25b')] ?? Helper::validate_key_loop_value('gov_zip', $finacial_affairs_law, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 pr-0">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('B_107-Describe 25'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Describe 25')] ?? Helper::validate_key_loop_value('environment_law_know', $finacial_affairs_law, $i);?></textarea>
                                </div>
                            </div>
                            <div class="col-md-2 ">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Date 25'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date 25')] ?? Helper::validate_key_loop_value('notice_date', $finacial_affairs_law, $i);?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                                        } ?>
                </div>

                <!-- 26 -->
                <div class="col-md-12 mt-3 d-flex">
                    <label for=""> <strong>26.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong> {{ __('Have you been a party in any judicial or administrative proceeding under any environmental law? Include settlements and orders') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check26'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check26')]) ? Helper::validate_key_toggle(base64_encode('check26'), $sofa, 'no') : Helper::validate_key_toggle('list_judicial_proceedings', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check26'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check26')]) ? Helper::validate_key_toggle(base64_encode('check26'), $sofa, 'yes') : Helper::validate_key_toggle('list_judicial_proceedings', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. List all payments to an insider') }}</label>
                    </div>
                </div>
                <!-- First Row Heading -->
                <div class="row mt-2 pl-3  <?php echo Helper::key_hide_show_v('list_judicial_proceedings', $finacial_affairs);?>">
                    <div class="col-md-3"></div>
                    <div class="col-md-3 " style="padding-left: 5px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Court or agency') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3"  style="padding-left: 2px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Nature of the case') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-3 pr-3" style="padding-left: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Status of the case') }} </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2 mb-2 <?php echo Helper::key_hide_show_v('list_judicial_proceedings', $finacial_affairs);?>">
                    <!-- body -->
                    <?php
                                                        if (!empty($finacial_affairs['list_judicial_proceedings_data']['name'])) {
                                                            for ($i = 0;$i < count($finacial_affairs['list_judicial_proceedings_data']['name']);$i++) {
                                                                $finacial_affairs_judical = $finacial_affairs['list_judicial_proceedings_data'];
                                                                ?>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="input-group">
                                    <label>{{ __('Case title') }}</label>
                                    <input name="<?php echo base64_encode('B_107-Case title1 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Case title1 26')] ?? Helper::validate_key_loop_value('case_name', $finacial_affairs_judical, $i);?>" class="form-control">
                                </div>
                                <div class="input-group mt-2">
                                    <label>{{ __('Case Number') }}</label>
                                    <input name="<?php echo base64_encode('B_107-Case number 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Case number 26')] ?? Helper::validate_key_loop_value('case_number', $finacial_affairs_judical, $i);?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3 pl-0 pr-0" style="padding-right: 2px;">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Court Name 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court Name 26')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_judical, $i);?>" class="form-control">
                                            <label>{{ __('Court Name') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 ">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Court address 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court address 26')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_judical, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Court City 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court City 26')] ?? Helper::validate_key_loop_value('city', $finacial_affairs_judical, $i);?>" class="form-control">
                                            <label for="">{{ __('City') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Court State 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court State 26')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_judical, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Court ZIP Code 26'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Court ZIP Code 26')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_judical, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 pr-0">
                                <div class="input-group">
                                    <textarea name="<?php echo base64_encode('B_107-Case nature 26'); ?>" class="form-control" cols="30" rows="7"><?php echo $sofa[base64_encode('B_107-Case nature 26')] ?? Helper::validate_key_loop_value('case_nature', $finacial_affairs_judical, $i);?></textarea>
                                </div>
                            </div>

                            <div class="col-md-3" style="padding-left: 1.5rem;">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check26'); ?>" value="pending" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check26')]) ? Helper::validate_key_toggle(base64_encode('B_107-check26'), $sofa, 'pending') : Helper::validate_key_loop_toggle('case_status', $finacial_affairs_judical, 1, $i);?>>
                                    <label for="">{{ __('Pending') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check26'); ?>" value="on appeal" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check26')]) ? Helper::validate_key_toggle(base64_encode('B_107-check26'), $sofa, 'on appeal') : Helper::validate_key_loop_toggle('case_status', $finacial_affairs_judical, 2, $i);?>>
                                    <label for="">{{ __('On appeal') }}</label>
                                </div>
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-check26'); ?>" value="concluded" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check26')]) ? Helper::validate_key_toggle(base64_encode('B_107-check26'), $sofa, 'concluded') : Helper::validate_key_loop_toggle('case_status', $finacial_affairs_judical, 3, $i);?>>
                                    <label for="">{{ __('Concluded') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }
                                                            } ?>
                </div>
            </div>

            <!-- Part 11 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 11') }}</span>
                        <h2 class="font-lg-18">{{ __(': Give Details About Your Business or Connections to
                            Any
                            Business') }}
                        </h2>
                    </div>
                </div>

            </div>

            <!-- 27 -->
            <div class="form-border mb-3 pl-0 pr-0">
                <div class="col-md-12 mt-3 d-flex">
                    <label for=""> <strong>27.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                                {{ __('Within 4 years before you filed for bankruptcy, did you own a business or have any of the following connections to any business?') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group" style="padding-left: 2.5rem;">
                        <input name="<?php echo base64_encode('B_107-check Sole Proprietor 27'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check Sole Proprietor 27')]) ? Helper::validate_key_toggle(base64_encode('B_107-check Sole Proprietor 27'), $sofa, 'yes') : Helper::validate_key_toggle('employer_identification', $finacial_affairs, 1);?>>
                        <label>{{ __('A sole proprietor or self-employed in a trade, profession, or other activity, either full-time or part-time') }}</label>
                    </div>
                    <div class="input-group" style="padding-left: 2.5rem;">
                        <input name="<?php echo base64_encode('B_107-check LLC 27'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check LLC 27')]) ? Helper::validate_key_toggle(base64_encode('B_107-check LLC 27'), $sofa, 'no') : Helper::validate_key_toggle('employer_identification', $finacial_affairs, 2);?>>
                        <label>{{ __('A member of a limited liability company (LLC) or limited liability partnership (LLP)') }}</label>
                    </div>
                    <div class="input-group" style="padding-left: 2.5rem;">
                        <input name="<?php echo base64_encode('B_107-check Partner 27'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check Partner 27')]) ? Helper::validate_key_toggle(base64_encode('B_107-check Partner 27'), $sofa, 'yes') : Helper::validate_key_toggle('employer_identification', $finacial_affairs, 3);?>>
                        <label>{{ __('A partner in a partnership') }}</label>
                    </div>
                    <div class="input-group" style="padding-left: 2.5rem;">
                        <input name="<?php echo base64_encode('B_107-check Executive 27'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check Executive 27')]) ? Helper::validate_key_toggle(base64_encode('B_107-check Executive 27'), $sofa, 'no') : Helper::validate_key_toggle('employer_identification', $finacial_affairs, 4);?>>
                        <label>{{ __('An officer, director, or managing executive of a corporation') }}</label>
                    </div>
                    <div class="input-group" style="padding-left: 2.5rem;">
                        <input name="<?php echo base64_encode('B_107-check CorpOwner 27'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check CorpOwner 27')]) ? Helper::validate_key_toggle(base64_encode('B_107-check CorpOwner 27'), $sofa, 'yes') : Helper::validate_key_toggle('employer_identification', $finacial_affairs, 5);?>>
                        <label>{{ __('An owner of at least 5% of the voting or equity securities of a corporation') }}</label>
                    </div>
                    <div class="input-group mt-2 pl-3">
                        <input name="<?php echo base64_encode('B_107-check27a'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check27a')]) ? Helper::validate_key_toggle(base64_encode('B_107-check27a'), $sofa, 'no') : '';?>>
                        <label>{{ __('No. None of the above applies. Go to Part 12.') }} </label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('B_107-check27a'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check27a')]) ? Helper::validate_key_toggle(base64_encode('B_107-check27a'), $sofa, 'yes') : '';?>>
                        <label>{{ __('Yes. Check all that apply above and fill in the details below for each business.') }}</label>
                    </div>
                </div>



                <div class="col-md-12">
                    <!-- body -->
                    <?php
                                                            if (!empty($finacial_affairs['list_nature_business_data']['name'])) {
                                                                for ($i = 0;$i < count($finacial_affairs['list_nature_business_data']['name']);$i++) {
                                                                    $finacial_affairs_nature = $finacial_affairs['list_nature_business_data'];
                                                                    $alpha_8 = '';
                                                                    if ($i == 0) {
                                                                        $alpha_8 = 'a';
                                                                    } elseif ($i == 1) {
                                                                        $alpha_8 = 'b';
                                                                    } elseif ($i == 2) {
                                                                        $alpha_8 = 'c';
                                                                    }
                                                                    ?>
                    <div class="col-md-12 <?php if ($i > 0) { ?> mt-1 <?php } ?>">
                        <div class="row border-bottm-1 mt-0">
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Business Name 27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Business Name 27'.$alpha_8)] ?? Helper::validate_key_loop_value('name', $finacial_affairs_nature, $i);?>" class="financial_affair_business_name business_name_{{$i}} form-control">
                                            <label>{{ __('Business Name') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('aB_107-ddress 27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('aB_107-ddress 27'.$alpha_8)] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_nature, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-City 27'.$alpha_8)]??Helper::validate_key_loop_value('city',$finacial_affairs_nature,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-City 27'.$alpha_8); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 27'.$alpha_8)] ?? Helper::validate_key_loop_value('state', $finacial_affairs_nature, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 27'.$alpha_8)] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_nature, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6 pr-0" style="padding-left: 5px;">
                                        <div class="column-heading gray_bg_with_border" style="padding-left: 2px;">
                                            <h4 style="padding-left: 8px;">{{ __('Describe the nature of the business') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="column-heading gray_bg_with_border" style="padding-left: 10px;">
                                            <h4>{{ __('Employer Identification number') }}<br>{{ __('Do not include Social Security number or ITIN.') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 pr-0" style="padding-left: 5px;">
                                        <div class="input-group">
                                            <textarea name="<?php echo base64_encode('B_107-Describe nature 27'.$alpha_8); ?>" class="form-control" cols="30" rows="2"><?php echo $sofa[base64_encode('B_107-Describe nature 27'.$alpha_8)] ?? Helper::validate_key_loop_value('business_nature', $finacial_affairs_nature, $i);?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 pr-0">
                                        <div class="input-group d-flex" style="padding-right: 16px;">
                                            <label for="">{{ __('EIN:') }}</label>
                                            <input name="<?php echo base64_encode('B_107-Debtor1.Employer Identification Number27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Debtor1.Employer Identification Number27'.$alpha_8)] ?? Helper::validate_key_loop_value('eiin', $finacial_affairs_nature, $i);?>" class="ml-2 financial_affair_business_ein business_ein_{{$i}} form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2 pr-0" style="padding-left: 5px;">
                                        <div class="column-heading gray_bg_with_border" style="padding-left: 2px;">
                                            <h4 style="padding-left: 8px;">{{ __('Name of accountant or bookkeeper') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <div class="column-heading gray_bg_with_border" style="padding-left: 10px;">
                                            <h4>{{ __('Dates business existed') }}</h4>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0" style="padding-left: 5px;">
                                        <div class="input-group">
                                            <textarea name="<?php echo base64_encode('B_107-Accountant Name 27'.$alpha_8); ?>" class="mt-2 form-control" cols="30" rows="2"><?php echo $sofa[base64_encode('B_107-Accountant Name 27'.$alpha_8)] ?? Helper::validate_key_loop_value('business_accountant', $finacial_affairs_nature, $i);?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <div class="input-group d-flex">
                                                    <label for="">{{ __('From') }}</label>
                                                    <input name="<?php echo base64_encode('B_107-Date from 27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date from 27'.$alpha_8)] ?? Helper::validate_key_loop_value('operation_date', $finacial_affairs_nature, $i);?>" class="ml-2 form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group d-flex">
                                                    <label for="">To</label>
                                                    <input name="<?php echo base64_encode('B_107-Date to 27'.$alpha_8); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Date to 27'.$alpha_8)] ?? Helper::validate_key_loop_value('operation_date2', $finacial_affairs_nature, $i);?>" class="ml-2 form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                    </div>
                    <?php }
                                                                } ?>
                </div>

                <div class="col-md-12 mt-3 d-flex">
                    <label for=""> <strong>28.</strong></label>
                    <div class="row pl-1">
                        <div class="col-md-12">
                            <strong>
                                {{ __('Within 2 years before you filed for bankruptcy, did you give a financial statement to anyone about your business? Include all financial institutions, creditors, or other parties.') }}
                            </strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check28'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('check28')]) ? Helper::validate_key_toggle(base64_encode('check28'), $sofa, 'no') : Helper::validate_key_toggle('list_financial_institutions', $finacial_affairs, 0);?>>
                        <label>{{ __('No') }}</label>
                    </div>
                    <div class="input-group pl-3">
                        <input name="<?php echo base64_encode('check28'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('check28')]) ? Helper::validate_key_toggle(base64_encode('check28'), $sofa, 'yes') : Helper::validate_key_toggle('list_financial_institutions', $finacial_affairs, 1);?>>
                        <label>{{ __('Yes. List all payments to an insider') }}</label>
                    </div>
                </div>
                <!-- First Row Heading -->
                <div class="row mt-2 pl-3 <?php echo Helper::key_hide_show_v('list_financial_institutions', $finacial_affairs);?>">
                    <div class="col-md-4"></div>
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 2px;">
                        <div class="column-heading gray-box">
                            <h4>{{ __('Date issued') }}</h4>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>

                <div class="col-md-12 mb-2 <?php echo Helper::key_hide_show_v('list_financial_institutions', $finacial_affairs);?>">
                    <?php
                                                                if (!empty($finacial_affairs['list_financial_institutions_data']['name'])) {
                                                                    for ($i = 0;$i < count($finacial_affairs['list_financial_institutions_data']['name']);$i++) {
                                                                        $finacial_affairs_financ = $finacial_affairs['list_financial_institutions_data'];
                                                                        ?>
                        <!-- body -->
                    <div class="col-md-12 mt-2">
                        <div class="row ">
                            <div class="col-md-4">
                                <div class="row" style="padding-left:8px;">
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-Name 28'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-Name 28')] ?? Helper::validate_key_loop_value('name', $finacial_affairs_financ, $i);?>" class="form-control">
                                            <label>{{ __('Name of site') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pr-0 pl-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-address 28'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-address 28')] ?? Helper::validate_key_loop_value('street_number', $finacial_affairs_financ, $i);?>" class="form-control">
                                            <label>{{ __('Street') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-left:8px;">
                                    @php

                                        $cityvalue = $sofa[base64_encode('B_107-City 28')]??Helper::validate_key_loop_value('city',$finacial_affairs_financ,$i);

                                    @endphp
                                    <x-labelAfterInput name="<?php echo base64_encode('B_107-City 28'); ?>" type="text"  value="{{ $cityvalue }}" divClass="col-md-6 pr-1 pl-0" label="City" inputClass=""></x-labelAfterInput>
                                    <div class="col-md-6 pr-1 pl-1">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-State 28'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-State 28')] ?? Helper::validate_key_loop_value('state', $finacial_affairs_financ, $i);?>" class="form-control">
                                            <label for="">{{ __('State') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 pr-0">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('B_107-ZIP Code 28'); ?>" type="text" value="<?php echo $sofa[base64_encode('B_107-ZIP Code 28')] ?? Helper::validate_key_loop_value('zip', $finacial_affairs_financ, $i);?>" class="form-control">
                                            <label for="">{{ __('ZIP Code') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2" style="padding-left:5px;">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('B_107-Date 28'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $sofa[base64_encode('B_107-Date 28')] ?? Helper::validate_key_loop_value('date_issued', $finacial_affairs_financ, $i);?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6"></div>
                        </div>
                    </div>
                    <?php }
                                                                    } ?>
                </div>
            </div>


            <!-- Part 12 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 12') }}</span>
                        <h2 class="font-lg-18">{{ __('Sign Below') }}
                        </h2>
                    </div>
                </div>
            </div>
            <!-- 28 -->
            <div class="form-border pl-0 pr-0">
                <div class="col-md-12 mt-2">
                    <div class="input-group">
                        <label for=""><strong>{{ __('I have read the answers on this Statement of Financial
                                Affairs and any attachments, and I declare under penalty of perjury
                                that
                                the
                                answers are true and correct. I understand that making a false
                                statement, concealing property, or obtaining money or property by
                                fraud
                                in connection with a bankruptcy case can result in fines up to
                                $250,000,
                                or imprisonment for up to 20 years, or both.
                                18 U.S.C. §§ 152, 1341, 1519, and 3571.') }} </strong></label>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="input-group signature-field">
                            <input name="<?php echo base64_encode('B_107-Signature of Debtor 1'); ?>"  type="text" value="{{$debtor_sign}}" class="form-control">
                                <label>{{ __('Signature of Debtor 1') }}</label>
                            </div>
                            <div class="input-group mt-3 d-flex">
                                <label>{{ __('Date') }}</label>
                                <input name="<?php echo base64_encode('B_107-Date signed Debtor 1'); ?>" style="width:auto;" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="ml-2 date_filed form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group signature-field">
                            <input name="<?php echo base64_encode('B_107-Signature of Debtor 2'); ?>"  type="text" value="{{$debtor2_sign}}" class="form-control">
                                <label>{{ __('Signature of Debtor 2') }}</label>
                            </div>
                            <div class="input-group mt-3 d-flex">
                                <label>{{ __('Date') }}</label>
                                <input name="<?php echo base64_encode('B_107-Date signed Debtor 2'); ?>" style="width:auto;" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="ml-2 date_filed form-control">
                            </div>
                        </div>
                    </div>
                    <div class="input-group mt-3">
                        <label for=""><strong>{{ __('Did you attach additional pages to Your Statement of
                                Financial Affairs for Individuals Filing for Bankruptcy (Official
                                Form
                                107)?') }}</strong></label>
                        <div class="input-group mt-2">
                            <input name="<?php echo base64_encode('B_107-check29'); ?>" value="no" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check29')]) ? Helper::validate_key_toggle(base64_encode('B_107-check29'), $sofa, 'no') : 'checked';?>>
                            <label for="">{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('B_107-check29'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check29')]) ? Helper::validate_key_toggle(base64_encode('B_107-check29'), $sofa, 'yes') : '';?>>
                            <label for="">{{ __('Yes') }}</label>
                        </div>
                    </div>
                    <div class="input-group mt-3 mb-2">
                        <label for=""><strong>{{ __('Did you pay or agree to pay someone who is not an
                                attorney
                                to help you fill out bankruptcy forms?') }} </strong></label>
                        <div class="input-group mt-2">
                            <input name="<?php echo base64_encode('B_107-check30'); ?>" value="no" type="checkbox"  <?php echo isset($sofa[base64_encode('B_107-check30')]) ? Helper::validate_key_toggle(base64_encode('B_107-check30'), $sofa, 'no') : 'checked';?>>
                            <label for="">{{ __('No') }}</label>
                        </div>
                        <div class="input-group">
                            <input name="<?php echo base64_encode('B_107-check30'); ?>" value="yes" type="checkbox" <?php echo isset($sofa[base64_encode('B_107-check30')]) ? Helper::validate_key_toggle(base64_encode('B_107-check30'), $sofa, 'yes') : '';?>>
                            <label for="">{{ __('Name of person') }}</label>
                            <input name="<?php echo base64_encode('B_107-Name of person agreed to pay'); ?>" style="width: 250px;" type="text" value="<?php echo $sofa[base64_encode('B_107-Name of person agreed to pay')] ?? '';?>" class="ml-2 form-control">
                            <i class="text-bold"> {{ __("Attach the Bankruptcy Petition Preparer’s Notice,
                                Declaration, and Signature (Official Form 119).") }}</i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

       
        <x-officialForm.generatePdfButton title="Generate Statement of Financial Affairs PDF" divtitle="coles_official-form-107"></x-officialForm.generatePdfButton>


    </section>
</form>
