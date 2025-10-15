<form name="official_frm_106sum"  class="save_official_forms"   id="official_frm_106sum" action="{{route('generate_official_pdf')}}" method="post">
    @csrf
    <input type="hidden" name="form_id" value="106sum">
    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">
    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b106sum.pdf'; ?>">
    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b106sum.pdf'; ?>">
    <input type="hidden" name="<?php echo base64_encode('Case number-106SUM'); ?>" value="<?php echo $caseno; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1#0-106SUM'); ?>" value="<?php echo $onlyDebtor; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 2-106SUM'); ?>" value="<?php echo $spousename; ?>">
    <input type="hidden" name="<?php echo base64_encode('Debtor 1-106SUM'); ?>" value="<?php echo $onlyDebtor; ?>">

    <section class="page-section official-form-106sum padd-20" id="official-form-106sum">
        <div class="frm106sum container pl-2 pr-0">
            <div class="row">
                <div class="frm106sum col-md-7">
                    <div class="section-box">

                        <div class="section-header bg-back frm106sum text-white">
                            <p class="frm106sum font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                        </div>

                        <div class="frm106sum section-body padd-20">
                            <div class="frm106sum row">



                                <div class="frm106sum col-md-12">
                                    <div class="input-group">
                                        <label for="">{{ __('United States Bankruptcy Court for the') }}</label>

                                        <select class="form-control frm106sum district-select"
                                            name="<?php echo base64_encode('Bankruptcy District Information-106SUM');?>"
                                            id="district_name">
                                            @foreach ($district_names as $district_name)
                                            <option
                                                <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?>
                                                value="{{$district_name->district_name}}" class="form-control">
                                                {{$district_name->district_name}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="frm106sum col-md-5">

                    <div class="frm106sum amended">
                        <input type="checkbox" name="<?php echo base64_encode('Check if this is an-106SUM');?>">
                        <label>{{ __('Check if this is an amended filing') }}</label>

                    </div>
                </div>
            </div>

            <div class="row padd-20">
                <div class="col-md-12 mb-3">
                    <div class="form-title">
                        <h4>{{ __('Summary of Schedules') }}</h4>
                        <!-- <h4>{{ __('Official Form 106Sum') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Summary of Your Assets and Liabilities and Certain
                            Statistical Information') }}
                        </h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14">{{ __('Be as complete and accurate as possible. If two married people are filing
                            together, both are equally responsible for supplying correct information. Fill out all of
                            your schedules first; then complete the information on this form. If you are filing amended
                            schedules after you file your original forms, you must fill out a new Summary and check the
                            box at the top of this page.') }} </p>
                    </div>
                </div>
            </div>
            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('Summarize Your Assets') }}</h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group gray-box column-heading d-inline-block" style="float: right;"> <strong
                                class="d-block">{{ __('Your assets') }}
                            </strong>
                            <p>{{ __('Value of what you own') }} </p>
                        </div>
                        <div class="input-group mbm10" style="clear: both;">
                            <strong>1.</strong> {{ __('Schedule A/B: Property (Official Form 106A/B)') }}
                        </div>
                        <div class="frm106sum row align_center sub-child">
                            <div class="frm106sum col-md-9">
                                <div class="input-group horizontal_dotted_line">
                                    <label>{{ __('1a. Copy line 55, Total real estate, from Schedule A/B') }}</label>
                                </div>

                            </div>

                            <div class="frm106sum col-md-3">
                                <div class="frm106sum input-group d-flex">
                                    <div class="frm106sum input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <p><input name="<?php echo base64_encode('1a-106SUM');?>" id="sum_total_real_estate"
                                            type="text" value="<?php echo Helper::priceFormt('');?>"
                                            class="price-field form-control" placeholder="$"></p>
                                </div>
                            </div>
                        </div>
                        <div class="frm106sum row align_center sub-child">
                            <div class="col-md-9">
                                <div class="input-group horizontal_dotted_line">
                                    <label>{{ __('1b. Copy line 62, Total personal property, from Schedule A/B') }}</label>
                                </div>
                            </div>
                            <div class="sum1frm4 col-md-3">
                                <div class="sum1frm4 input-group d-flex">
                                    <div class="sum1frm4 input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <p><input name="<?php echo base64_encode('1b-106SUM');?>" id="sum_total_personal_property" type="text"  value="<?php echo Helper::priceFormt('');?>" class="price-field form-control" placeholder="$"></p>
                                </div>
                            </div>
                        </div>
                        <div class="frm106sum row align_center sub-child">
                            <div class="frm106sum col-md-9">
                                <div class="frm106sum input-group horizontal_dotted_line">
                                    <label>{{ __('1c. Copy line 63, Total of all property on Schedule A/B') }}</label>
                                </div>
                            </div>

                            <div class="frmsum2 col-md-3">
                                <div class="frmsum2 input-group d-flex">
                                    <div class="frmsum2 input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <p class="a"><input name="<?php echo base64_encode('1c-106SUM');?>"
                                            id="sum_total_all_property" type="text"
                                            value="<?php echo Helper::priceFormt('');?>"
                                            class="price-field form-control" placeholder="$"></p>
                                </div>
                            </div>
                            <!-- Outline Black Box Styling Started -->
                            <style>
                            .a {
                                border-style: solid;
                                border-color: black;
                            }
                            </style>
                            <!-- Styling Finish -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Part 2 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                        <h2 class="font-lg-18">{{ __('Summarize Your Liabilities') }}</h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <!-- Part 3 -->
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="input-group gray-box column-heading d-inline-block" style="float: right;">
                            <strong class="d-block">{{ __('Your liabilities') }}
                            </strong>
                            <p>{{ __('Value of what you own') }} </p>
                        </div>
                        <div class="input-group mbm10" style="clear: both;">
                            <label><strong>2.</strong> {{ __('Schedule D: Creditors Who Have Claims Secured by
                                Property (Official Form 106D)') }}</label>
                        </div>
                        <div class="106sumfrm row align_center sub-child">
                            <div class="106sumfrm col-md-9">
                                <div class="106sumfrm input-group horizontal_dotted_line">
                                    <label>{{ __('2a. Copy the total you listed in Column A, Amount of
                                        claim,
                                        at the bottom of the last page of Part 1 of Schedule
                                        D') }}</label>
                                </div>
                            </div>
                            <div class="sum1frm5 col-md-3">
                                <div class="sum1frm5 input-group d-flex">
                                    <div class="sum1frm5 input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <input name="<?php echo base64_encode('2-106SUM');?>" id="sum_d_Amount_of_claim"
                                        type="text" value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field  form-control" placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="input-group mbm10" style="margin-top:10px;clear: both;">
                            <label><strong>3.</strong> {{ __('Schedule E/F: Creditors Who Have Unsecured Claims
                                (Official Form 106E/F)') }}</label>
                        </div>

                        <div class="106sumfrm2 row align_center sub-child">
                            <div class="106sumfrm2 col-md-9">
                                <div class="106sumfrm2 input-group horizontal_dotted_line">
                                    <label>{{ __('3a. Copy the total claims from Part 1
                                        (priority unsecured claims) from line 6e of Schedule E/F') }}</label>
                                </div>
                            </div>

                            <div class="sum1frm6 col-md-3">
                                <div class="sum1frm6 input-group d-flex">
                                    <div class="input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <p><input name="<?php echo base64_encode('3a-106SUM');?>"
                                            id="sum_e_f_total_claims_part1" type="text"
                                            value="<?php echo Helper::priceFormt('');?>"
                                            class="price-field form-control" placeholder="$">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="106sumfrm3 row align_center sub-child">
                            <div class="106sumfrm3 col-md-9">
                                <div class="106sumfrm3 input-group horizontal_dotted_line">
                                    <label>{{ __('3b. Copy the total claims from Part 2
                                        (nonpriority unsecured claims) from line 6j of Schedule E/F') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="input-group d-flex">
                                    <div class="input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <p><input name="<?php echo base64_encode('3b-106SUM');?>"
                                            id="sum_e_f_total_claims_part2" type="text"
                                            value="<?php echo Helper::priceFormt('');?>"
                                            class="price-field form-control" placeholder="$">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="106sumfrm4 row align_center sub-child">
                            <div class="106sumfrm4 col-md-7">
                                <div class="106sumfrm4 input-group">
                                    <p>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <p><strong>{{ __('Your total liabilities') }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="sum1frm col-md-3">
                                <div class="sum1frm input-group d-flex">
                                    <div class="sum1frm input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>

                                    <p class="a"><input name="<?php echo base64_encode('3c-106SUM');?>"
                                            id="final_sum_e_f_total_claims_part2" type="text"
                                            value="<?php echo Helper::priceFormt('');?>"
                                            class="price-field form-control" placeholder="$"></a>
                                </div>
                            </div>
                        </div>

                        <!-- Black Outline Styling Started -->
                        <style>
                        .b {
                            border-style: solid;
                            border-color: Black;
                        }
                        </style>
                        <!-- Styling Finish  -->

                    </div>
                </div>
            </div>
            <!-- Part 3 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3">
                        <span>{{ __('Part 3') }}</span>
                        <h2 class="font-lg-18">{{ __('Summarize Your Income and Expenses') }}</h2>
                    </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group mbm10 mt-3" style="clear: both;">
                            <label><strong>4.</strong> {{ __('Schedule I: Your Income (Official Form 106I)') }}</label>

                        </div>
                        <div class="106sumfrm5 row align_center sub-child">
                            <div class="106sumfrm5 col-md-9">
                                <div class="input-group horizontal_dotted_line">
                                    <label>{{ __('Copy your combined monthly income from line 12 of
                                        Schedule
                                        I') }}</label>
                                </div>
                            </div>
                            <div class="sum1frm2 col-md-3">
                                <div class="sum1frm2 input-group d-flex">
                                    <div class="sum1frm2 input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <input name="<?php echo base64_encode('4-106SUM');?>"
                                        id="sum_combined_monthly_income" type="text"
                                        value="<?php echo Helper::priceFormt('');?>" class="price-field form-control"
                                        placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="input-group mbm10 mt-3" style="clear: both;">
                            <label><strong>5.</strong> {{ __('Schedule J: Your Expenses (Official Form 106J)') }}
                            </label>
                        </div>
                        <div class="row align_center sub-child 106sumfrm">
                            <div class="col-md-9 106sumfrm">
                                <div class="input-group horizontal_dotted_line 106sumfrm">
                                    <label>{{ __('Copy your monthly expenses from line 22c of Schedule J') }}</label>
                                </div>
                            </div>
                            <div class="sum1frm3 col-md-3">
                                <div class="sum1frm3 input-group d-flex">
                                    <div class="sum1frm3 input-group-append"> <span class="input-group-text "
                                            id="basic-addon2">$</span> </div>
                                    <input name="<?php echo base64_encode('5-106SUM');?>" id="sum_monthly_expenses"
                                        type="text" value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field form-control" placeholder="$">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- For Debtor 1  -->

            <!-- Part 4-->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 4') }}</span>
                        <h2 class="font-lg-18">{{ __('Answer These Questions for Administrative and
                            Statistical
                            Records') }}</h2>
                    </div>
                </div>
            </div>
            <div class="form-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <p><strong>{{ __('6. Are you filing for bankruptcy under Chapters 7, 11, or
                                    13?') }}</strong></p>
                        </div>
                        <div class="input-group">
                            <input type="radio" name="<?php echo base64_encode('check6#0-106SUM');?>" value="no">
                            <label>{{ __('No. You have nothing to report on this part of the form. Check
                                this
                                box and submit this form to the court with your other
                                schedules.') }}</label>
                        </div>
                        <div class="input-group">
                            <input type="radio" name="<?php echo base64_encode('check6#0-106SUM');?>" value="yes"
                                checked="checked">
                            <label>{{ __('Yes') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <p><strong>{{ __('7.What kind of debt do you have?') }}</strong></p>
                        </div>
                        <div class="input-group">
                            <input type="checkbox" name="<?php echo base64_encode('check7-106SUM');?>" value="consumer">
                            <label><strong>{{ __('Your debts are primarily consumer debts.') }}</strong>
                                {{ __('Consumer
                                debts are those
                                “incurred by an individual primarily for a personal,
                                family, or household purpose.” 11 U.S.C. § 101(8). Fill out lines
                                8-9g
                                for statistical purposes. 28 U.S.C. § 159.') }}</label>
                        </div>
                        <div class="input-group">
                            <input type="checkbox" name="<?php echo base64_encode('check7-106SUM');?>"
                                value="not consumer">
                            <label><strong>{{ __('Your debts are not primarily consumer debts.') }} </strong>{{ __('You
                                have nothing to
                                report on this part of the form. Check this box and submit
                                this form to the court with your other schedules.') }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-border">
                <div class="row">
                    <div class="col-md-8">
                        <div class="input-group">
                            <label><strong>{{ __('8. From the Statement of Your Current Monthly
                                    Income:') }}</strong> {{ __('Copy your
                                total current monthly income from Official
                                Form 122A-1 Line 11; OR, Form 122B Line 11; OR, Form 122C-1 Line
                                14.') }}</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group abc">
                            <input name="<?php echo base64_encode('8-106SUM');?>" id="sum_current_monthly_income"
                                type="text" value="<?php echo Helper::priceFormtWithComma('');?>"
                                class="price-field form-control" placeholder="$">

                        </div>
                    </div>

                    <!-- Black Outline Styling  -->
                    <style>
                    .abc {
                        border-style: solid;
                        border-color: Black;
                    }
                    </style>
                    <!-- Styling Finish -->

                </div>
            </div>
            <div class="form-border">
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <p><strong>{{ __('9. Copy the following special categories of claims from Part
                                    4,
                                    line 6 of Schedule E/F:') }}</strong></p>
                        </div>
                        <div class="row">
                            <div class="col-md-10 frm106sum2">
                                <div class="gray-box column-heading">
                                    <strong>{{ __('From Part 4 on Schedule E/F, copy the following:') }}
                                    </strong>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="column-heading gray-box">
                                    <strong>{{ __('Total claim') }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <div class="col-md-10 frm106sum3">
                                <div class="input-group frm106sum3">
                                    <label><strong>{{ __('9a.') }} </strong>{{ __('Domestic support obligations (Copy
                                        line 6a.)') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('9a-106SUM');?>"
                                        id="sum_Domestic_support_obligations" type="text"
                                        value="<?php echo Helper::priceFormt('');?>" class="	price-field form-control"
                                        placeholder="$">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 frm106sum4">
                                <div class="input-group frm106sum4">
                                    <label><strong>{{ __('9b.') }} </strong>{{ __('Taxes and certain other debts you
                                        owe
                                        the government. (Copy line 6b.)') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('9b-106SUM');?>" id="sum_ef_Taxes_and_certain"
                                        type="text" value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field form-control" placeholder="$">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 frm106sum5">
                                <div class="input-group frm106sum5">
                                    <label><strong>{{ __('9c.') }} </strong>{{ __('Claims for death or personal injury
                                        while you were intoxicated. (Copy line 6c)') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('9c-106SUM');?>" id="sum_ef_claims_for_death"
                                        type="text" value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field form-control" placeholder="$">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-10 frm106sum6">
                                <div class="input-group frm106sum6">
                                    <label><strong>{{ __('9d.') }} </strong>{{ __('Student loans. (Copy line
                                        6f.)') }}</label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('9d-106SUM');?>" id="sum_ef_students_loan"
                                        type="text" value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field form-control" placeholder="$">
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-10 frm106sum7">
                                <div class="input-group frm106sum7">
                                    <label><strong>{{ __('9e.') }} </strong>{{ __('Obligations arising out of a
                                        separation
                                        agreement or divorce that you did not report as
                                        priority claims. (Copy line 6g.)') }} </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('9e-106SUM');?>"
                                        id="sum_ef_obligation_arising" type="text"
                                        value="<?php echo Helper::priceFormt('');?>" class="price-field form-control"
                                        placeholder="$">
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 frm106sum8">
                                <div class="input-group frm106sum8">
                                    <label><strong>{{ __('9f.') }} </strong>{{ __('Debts to pension or profit-sharing
                                        plans, and other similar debts. (Copy line 6h.)') }} </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="input-group">
                                    <input name="<?php echo base64_encode('9f-106SUM');?>" id="sum_ef_debts_pension"
                                        type="text" value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field form-control" placeholder="$">
                                </div>
                            </div>
                        </div>
                        <div class="frm106sum1 row">
                            <div class="frm106sum1 col-md-10">
                                <div class="input-group frm106sum1">
                                    <label><strong>{{ __('9g.') }} </strong><strong>Total. </strong> {{ __('Add lines
                                        9a
                                        through 9f.') }}
                                    </label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="input-group abcd">
                                    <input name="<?php echo base64_encode('9g-106SUM');?>" id="total_ef" type="text"
                                        value="<?php echo Helper::priceFormt('');?>"
                                        class="price-field fi_nondischargable_debt form-control" placeholder="$">
                                </div>
                            </div>

                            <!-- Outline Styling Started -->
                            <style>
                            .abcd {
                                border-style: solid;
                                border-color: Black;
                            }
                            </style>
                            <!-- Styling Finish -->

                        </div>

                    </div>
                </div>
            </div>

            <x-officialForm.generatePdfButton title="Generate Summary of Schedules PDF" divtitle="coles_official-form-106sum"></x-officialForm.generatePdfButton>
    </section>
</form>