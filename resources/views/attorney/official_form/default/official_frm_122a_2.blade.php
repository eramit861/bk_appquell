<form name="official_frm_122a─2" id="official_frm_122a_2" class="save_official_forms" action="{{route('generate_official_pdf')}}" method="post">
                    @csrf
                    <input type="hidden" name="form_id" value="122a_2">
                    <input type="hidden" name="client_id" value="<?php echo $client_id;?>">               
                    <input type="hidden" name="sourcePDFName" value="<?php echo 'form_b_122a_2.pdf'; ?>">
                    <input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_b_122a_2.pdf'; ?>">
                    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Case number1'); ?>" value="<?php echo $caseno; ?>">
                    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Debtor1.Name'); ?>" value="<?php echo $onlyDebtor; ?>">
                    <input type="hidden" name="<?php echo base64_encode('B_122A-2-Debtor2.Name'); ?>" value="<?php echo $spousename; ?>">
                    <?php $mTestA2 = isset($dynamicPdfData['122a_2']) && !empty($dynamicPdfData['122a_2']) ? json_decode($dynamicPdfData['122a_2'], 1) : null;
                    ?>
                <section class="page-section official-form-122a─2 padd-20" id="official-form-122a─2">
                    <div class="container pl-2 pr-0">
                        <div class="frm122a_2 row">
                            <div class="col-md-7">
                                <div class="frm122a_2 section-box">
                                    <div class="section-header bg-back text-white">
                                        <p class="frm122a_2 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                                    </div>
                                    <div class="frm122a_2 section-body padd-20">
                                        <div class="row">
                                             <div class="col-md-12 frm122a_2">
                                                <div class="122a1supfrm input-group frm122a_2">
                                                    <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                                    <select name="<?php echo base64_encode('B_122A-2-Bankruptcy District Information'); ?>" class="form-control frm122a_2 district-select" id="district_name"> @foreach ($district_names as $district_name)
                                                            <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="122a-2frm form-control">{{$district_name->district_name}}</option> @endforeach </select>

                                                </div>

                                            </div>


                                          </div>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-5 frm122a_2">
                                <div class="section-box second-section-box frm122a_2">
                                    <div class="section-header bg-back text-white">
                                        <p class="font-lg-20 frm122a_2">{{ __('Check the appropriate box as directed in lines 40 or 42:') }}</p>
                                    </div>
                                    <div class="section-body padd-20">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="122a1supfrm input-group">
                                                    <label>{{ __('According to the calculations required by this Statement:') }} </label>
                                                </div>
                                                <div class="122a1supfrm input-group">
												<input name="<?php echo base64_encode('B_122A-2-CheckBox1')?>" type="checkbox" value="No Abuse"  <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox1')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox1'), $mTestA2, 'No Abuse') : '';?>>
                                                    <label>{{ __('1. There is no presumption of abuse') }} </label>
                                                    </div>
                                                <div class="122a1supfrm input-group">
												<input  name="<?php echo base64_encode('B_122A-2-CheckBox1')?>" type="checkbox" value="Presumption of abuse applies" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox1')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox1'), $mTestA2, 'Presumption of abuse applies') : '';?>>
                                                    <label>{{ __('2. There is a presumption of abuse.') }}</label>
                                                   </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-7"></div>
							<div class="col-md-5 mt-3">
							<div class="122a1supfrm input-group">
												<input  name="<?php echo base64_encode('B_122A-2-CheckBox2')?>" type="checkbox" value="On" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox2')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox2'), $mTestA2, 'On') : '';?>>
                                                    <label>{{ __('Check if this is an amended filing') }}</label>
                                                   </div>
							</div>
                        </div>
                        <div class="row padd-20">
                            <div class="col-md-12 mb-3">
                                <div class="form-title">
                                    <h4>{{ __('Official Form 122A-2') }}</h4>
                                    <!-- <h4>{{ __('Official Form 122A–2') }} </h4> -->
                                    <h2 class="font-lg-22">{{ __('Chapter 7 Means Test Calculation') }}
                                    </h2> </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-subheading">
                                    <div class="122a1supfrm input-group"> <strong>
                                            {{ __('To fill out this form, you will need your completed copy of Chapter
                                            7
                                            Statement of Your Current Monthly Income (Official Form 122A-1).
                                            Be as complete and accurate as possible. If two married people are
                                            filing together, both are equally responsible for being accurate. If
                                            more space
                                            is needed, attach a separate sheet to this form. Include the line
                                            number
                                            to which the additional information applies. On the top of any
                                            additional
                                            pages, write your name and case number (if known).') }}
                                        </strong> </div>
                                </div>
                            </div>
                        </div>
                        <!-- Part 1 -->
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                                    <h2 class="font-lg-18">{{ __('Determine Your Adjusted Income') }}</h2> </div>
                            </div>
                        </div>
                        <div class="form-border mb-3">
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <div class="122a1supfrm input-group horizontal_dotted_line">
                                        <label style="font-weight: bold;">{{ __('1. Copy your total current monthly income.') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <div class="122a1supfrm input-group horizontal_dotted_line">
                                        <label style="font-weight: bold;">Copy line 11 from Official Form 122A-1 here  <i class='fas fa-arrow-right'></i></label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm input-group d-flex">
                                    <div class="122a1supfrm input-group-append"> <span class="input-group-text " id="basic-addon2">$</span> </div>
                                        <p><input name="<?php echo base64_encode('B_122A-2-Quest1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest1')]) : Helper::priceFormtWithComma('');?>" class="price-field total_income122a2 form-control"></p></div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Row 2 -->
                                    <label for=""> <strong>{{ __('2. Did you fill out Column B in Part 1 of Form 122A–1?') }}</strong> </label>
                                    <div class="122a1supfrm input-group pl-2">
                                        <input name="<?php echo base64_encode('B_122A-2-CheckBox3'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox3')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox3'), $mTestA2, 'No') : (empty($spousename) ? 'checked' : '');?>>
                                        <label for="">{{ __('No. Fill in $0 for the total on line 3.') }}</label>
                                    </div>
                                    <div class="122a1supfrm input-group pl-2">
                                        <input name="<?php echo base64_encode('B_122A-2-CheckBox3'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox3')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox3'), $mTestA2, 'Yes') : (!empty($spousename) ? 'checked' : '');?>>
                                        <label for="">{{ __('Yes. Is your spouse filing with you?.') }} </label>
                                    </div>
                                    <div class="pl-4">
                                        <div class="122a1supfrm input-group">
                                            <input name="<?php echo base64_encode('B_122A-2-CheckBox4'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox4')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox4'), $mTestA2, 'No') : (empty($spousename) ? 'checked' : '');?>>
                                            <label for="">{{ __('No. Go to line 3.') }} </label>
                                        </div>
                                        <div class="122a1supfrm input-group">
                                            <input name="<?php echo base64_encode('B_122A-2-CheckBox4'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox4')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox4'), $mTestA2, 'Yes') : (!empty($spousename) ? 'checked' : '');?>>
                                            <label for="">{{ __('Yes. Fill in $0 for the total on line 3.') }} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9 d-flex mt-3">
                                    <label for=""> <strong>3.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">
                                                {{ __('Adjust your current monthly income by subtracting any part of your spouse’s income not used to pay for the household expenses of you or your dependents.') }}
                                                </span> {{ __('Follow these steps:') }}<br>
                                                On line 11, Column B of Form 122A–1, was any amount of the income you reported for your spouse NOT regularly used for the household expenses of you or your dependents?
                                            </label>
                                            <div class="122a1supfrm input-group mt-2">
                                                <input name="<?php echo base64_encode('B_122A-2-CheckBox5'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox5')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox5'), $mTestA2, 'No') : 'checked';?>>
                                                <label for="">{{ __('No. Fill in 0 for the total on line 3') }}</label>
                                            </div>
                                            <div class="122a1supfrm input-group">
                                                <input name="<?php echo base64_encode('B_122A-2-CheckBox5'); ?>" value="On" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox5')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox5'), $mTestA2, 'On') : '';?>>
                                                <label for="">{{ __('Yes. Fill in the information below:') }} </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3"></div>

                                <div class="col-md-5 mt-2">
                                    <div class="gray-box column-heading ml-3 p-3">
                                        <strong class="d-block">{{ __('State each purpose for which the income was used') }}</strong>
                                        <p style="margin-bottom: 0px;">{{ __('For example, the income is used to pay your spouse’s tax debt or to support people other than you or your dependents') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">{{ __('Fill in the amount you are subtracting from your spouse’s income') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2"></div>
                                <div class="col-md-5 mt-2">
                                    <div class="122a1supfrm input-group ml-3 mt-2">
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest3A'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Quest3A')] ?? '';?>" class="form-control">
                                    </div>
                                    <div class="122a1supfrm input-group ml-3 mt-2">
                                        <input name="<?php echo base64_encode('B_122A-2-Quest3B'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Quest3B')] ?? '';?>" class="form-control"> 
                                    </div>
                                    <div class="122a1supfrm input-group ml-3 mt-2">
                                        <input name="<?php echo base64_encode('B_122A-2-Quest3C'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Quest3C')] ?? '';?>" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm1 input-group d-flex mt-2">
                                        <div class="122a1supfrm input-group-append prf1"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('Quest3A1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('Quest3A1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('Quest3A1')]) : Helper::priceFormtWithComma('');?>" class="price-field 122a2_price meantest_prices form-control">
                                    </div>
                                    <div class="122a1supfrm2 input-group d-flex mt-2">
                                        <div class="122a1supfrm input-group-append prf2"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest3B1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest3B1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest3B1')]) : Helper::priceFormtWithComma('');?>" class="price-field 122a2_price meantest_prices form-control">
                                    </div>
                                    <div class="122a1supfrm3 input-group d-flex mt-2">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">+$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest3C1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest3C1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest3C1')]) : Helper::priceFormtWithComma('');?>" class="price-field 122a2_price  meantest_prices form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2"></div>

                                <div class="col-md-5 mt-2">
                                    <div class="122a1supfrm input-group horizontal_dotted_line ml-3">
                                        <label>{{ __('Total') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm input-group d-flex ">
                                        <div class="122a1supfrm input-group-append prf3"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-total amount'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-total amount')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-total amount')]) : Helper::priceFormtWithComma('');?>" class="price-field 122a2_price_total form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm input-group horizontal_dotted_line">
                                        <label style="font-weight: bold;">Copy total here <i class='fas fa-arrow-right'></i></label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm input-group d-flex ">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">-$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest3B_122A-2-'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest3B_122A-2-')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest3B_122A-2-')]) : Helper::priceFormtWithComma('');?>" class="price-field copy_122a2_price_total form-control"> 
                                    </div>
                                </div>

                                <div class="col-md-10 mt-3 mb-2">
                                    <div class="122a1supfrm input-group">
                                        <label><span style="font-weight: bold;">{{ __('4. Adjust your current monthly income.') }} </span>{{ __('Subtract the total on line 3 from line 1.') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3 mb-2">
                                    <div class="122a1supfrm input-group border_2px d-flex p-2">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest4B_122A-2-'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest4B_122A-2-')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest4B_122A-2-')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line4_current_monthly_income adjusting_current_mnthly_income form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Part 2 -->
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                                    <h2 class="font-lg-18">{{ __('Calculate Your Deductions from Your Income') }}</h2> </div>
                            </div>
                        </div>
                        <!-- Row 1 -->
                        <div class="form-border mb-3">
                            <!-- Row 2 -->
                            <div class="row">
                                <div class="col-md-10 mt-3">
                                    <div class="122a1supfrm input-group">
                                        <label style="font-weight: bold;">{{ __('The Internal Revenue Service (IRS) issues National and Local Standards for certain expense amounts. Use these amounts to 
                                            answer the questions in lines 6-15. To find the IRS standards, go online using the link specified in the separate instructions for 
                                            this form. This information may also be available at the bankruptcy clerk’s office.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3"></div>
                                <div class="col-md-10">
                                    <div class="122a1supfrm input-group mt-2">
                                        <label>{{ __('Deduct the expense amounts set out in lines 6-15 regardless of your actual expense. In later parts of the form, you will use some of your 
                                            actual expenses if they are higher than the standards. Do not deduct any amounts that you subtracted from your spouse’s income in line 3 
                                            and do not deduct any operating expenses that you subtracted from income in lines 5 and 6 of Form 122A–1.') }} </label>
                                    </div>
                                    <div class="122a1supfrm input-group mt-2">
                                        <label>{{ __('If your expenses differ from month to month, enter the average expense.') }} </label>
                                    </div>
                                    <div class="122a1supfrm input-group mt-2">
                                        <label>{{ __('Whenever this part of the form refers to you, it means both you and your spouse if Column B of Form 122A–1 is filled in.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-12 d-flex mt-3">
                                    <label for=""> <strong>5.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label style="font-weight:bold;">
                                                {{ __('The number of people used in determining your deductions from income') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="122a1supfrm input-group mt-2 pl-3">
                                        <label>{{ __('Fill in the number of people who could be claimed as exemptions on your federal income tax return,
                                            plus the number of any additional dependents whom you support. This number may be different from
                                            the number of people in your household.') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="122a1supfrm input-group border_2px p-2">
                                        <input name="<?php echo base64_encode('B_122A-2-Quest5'); ?>" type="number" value="<?php echo Helper::validate_key_value('household_size', $savedData); ?>" class="form-control">  
                                    </div>
                                </div>
                                <div class="col-md-2"></div>

                                <div class="col-md-12 mt-2">
                                    <div class="gray-box ml-3 p-3 mr-2">
                                        <label><strong>{{ __('National Standards') }} </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('You must use the IRS National Standards to answer the questions in lines 6-7') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>6.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Food, clothing, and other items:') }}</span> {{ __('Using the number of people you entered in line 5 and the IRS National Standards, fill
                                                in the dollar amount for food, clothing, and other items.') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm1 input-group d-flex">
                                        <div class="122a1supfrm1 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest6'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest6')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest6')]) : Helper::priceFormtWithComma($meansTestCalculation['food_clothing_cost']);?>" class="price-field fi_line6_food_clothing_other_items form-control"> 
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>7.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Out-of-pocket health care allowance:') }}</span> {{ __('Using the number of people you entered in line 5 and the IRS National Standards,
                                                    fill in the dollar amount for out-of-pocket health care. The number of people is split into two categories-people who are
                                                    under 65 and people who are 65 or olderbecause older people have a higher IRS allowance for health care costs. If your
                                                    actual expenses are higher than this IRS amount, you may deduct the additional amount on line 22.') }}
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <?php $clientSideDentalMedical = Helper::validate_key_value('medical_dental_price', $expenses_info, 'comma'); ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm2 input-group d-flex">
                                        <div class="122a1supfrm2 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest6'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest6')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest6')]) : Helper::priceFormtWithComma($clientSideDentalMedical);?>" class="price-field line7_122a2 form-control"> 
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mt-2">
                                    <div class="gray-box ml-3 p-3 mr-2">
                                        <label style="font-weight:bold;">{{ __('People who are under 65 years of age') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>{{ __('7a. Out-of-pocket health care allowance per person') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm3 input-group d-flex">
                                        <div class="122a1supfrm3 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7A'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7A')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7A')]) : Helper::priceFormtWithComma($meansTestCalculation['outOfPocket_under_65']);?>" class="price-field form-control">  
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>{{ __('7b. Number of people who are under 65') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm4 input-group d-flex">
                                        <div class="122a1supfrm4 input-group-append"> <span class="input-group-text" id="basic-addon2">X</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7B'); ?>" type="number" value="<?php echo $mTestA2[base64_encode('B_122A-2-Quest7B')] ?? $meansTestCalculation['no_people_outOfPocket_under_65'];?>" class="price-field form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>7c. <span style="font-weight:bold;">{{ __('Subtotal.') }}</span> {{ __('Multiply line 7a by line 7b.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm5 input-group d-flex">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7C'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7C')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7C')]) : Helper::priceFormtWithComma(($meansTestCalculation['outOfPocket_under_65'] * $meansTestCalculation['no_people_outOfPocket_under_65']));?>" class="price-field fi_line7c_age1 form-control">  
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm5 input-group d-flex">
                                        <div class="122a1supfrm5 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7C'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7C')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7C')]) : Helper::priceFormtWithComma(($meansTestCalculation['outOfPocket_under_65'] * $meansTestCalculation['no_people_outOfPocket_under_65']));?>" class="price-field form-control">  
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-6 mt-3">
                                    <div class="gray-box ml-3 p-3 mr-2">
                                        <label style="font-weight:bold;">{{ __('People who are 65 years of age or older') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2">
                                </div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>{{ __('7d. Out-of-pocket health care allowance per person') }}  </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm6 input-group d-flex">
                                        <div class="122a1supfrm6 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7D'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7D')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7D')]) : Helper::priceFormtWithComma($meansTestCalculation['outOfPocket_65_and_older']);?>" class="price-field form-control">  
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>{{ __('7e. Number of people who are 65 or older') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm7 input-group d-flex">
                                        <div class="122a1supfrm7 input-group-append"> <span class="input-group-text" id="basic-addon2">X</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7E'); ?>" type="number" value="<?php echo $mTestA2[base64_encode('B_122A-2-Quest7E')] ?? $meansTestCalculation['no_people_outOfPocket_65_and_older'];?>" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>7f. <span style="font-weight:bold;">Subtotal.</span> {{ __('Multiply line 7d by line 7e.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm8 input-group d-flex">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7F'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7F')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7F')]) : Helper::priceFormtWithComma(($meansTestCalculation['outOfPocket_65_and_older'] * $meansTestCalculation['no_people_outOfPocket_65_and_older']));?>" class="price-field fi_line7f_age2 form-control">  
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm8 input-group d-flex">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7F'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7F')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7F')]) : Helper::priceFormtWithComma(($meansTestCalculation['outOfPocket_65_and_older'] * $meansTestCalculation['no_people_outOfPocket_65_and_older']));?>" class="price-field form-control">  
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>
                               <?php   $subtotalOlder = ($meansTestCalculation['outOfPocket_65_and_older'] * $meansTestCalculation['no_people_outOfPocket_65_and_older']) + ($meansTestCalculation['outOfPocket_under_65'] * $meansTestCalculation['no_people_outOfPocket_under_65']); ?>

                                <div class="col-md-7 mt-2">
                                    <div class="122a1supfrm input-group horizontal_dotted_line ml-3">
                                        <label>7g. <span style="font-weight:bold;">{{ __('Total.') }}</span> {{ __('Add lines 7c and 7f.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm input-group d-flex ">
                                        <div class="122a1supfrm input-group-append prf4"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest7G'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7G')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7G')]) : Helper::priceFormtWithComma($subtotalOlder);?>" class="price-field form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm9 input-group d-flex">
                                        <div class="122a1supfrm9 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;total&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <div class=" border_2px p-2">
                                            <input name="<?php echo base64_encode('B_122A-2-Quest7G'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest7G')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest7G')]) : Helper::priceFormtWithComma($subtotalOlder);?>" class="price-field line7g_122a2 form-control"> 
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12 mt-2">
                                    <div class="gray-box ml-3 p-3 mr-2">
                                        <label><strong>{{ __('Local Standards') }} </strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('You must use the IRS Local Standards to answer the questions in lines 8-15.') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>{{ __('Based on information from the IRS, the U.S. Trustee Program has divided the IRS Local Standard for housing for bankruptcy purposes into two parts:') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label style="font-weight:bold;"><i class="fa fa-square"></i>&nbsp;&nbsp;{{ __('Housing and utilities - Insurance and operating expenses') }}</label><br>
                                        <label style="font-weight:bold;"><i class="fa fa-square"></i>&nbsp;&nbsp;{{ __('Housing and utilities - Mortgage or rent expenses') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label style="font-weight:bold;">{{ __('To answer the questions in lines 8-9, use the U.S. Trustee Program chart.') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <div class="122a1supfrm input-group ml-3">
                                        <label>{{ __('To find the chart, go online using the link specified in the separate instructions for this form.') }}<br>{{ __('This chart may also be available at the bankruptcy clerk’s office.') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>8.</strong></label>
                                   
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Housing and utilities – Insurance and operating expenses:') }}</span>  {{ __('Using the number of people you entered in line 5, fill in the
                                                    dollar amount listed for your county for insurance and operating expenses.') }}
                                            </label>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm10 input-group d-flex">
                                        <div class="122a1supfrm10 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest8'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($meansTestCalculation['houshing_util_without_mortgage']);?>" class="price-field fi_line8_operating_expenses form-control"> 
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex mt-3">
                                    <label for=""> <strong>9.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Housing and utilities - Mortgage or rent expenses:') }}</span>
                                            </label>
                                        </div>
                                        
                                        <div class="col-md-8 d-flex mt-2">
                                            <label>9a.</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12">
                                                    <label> {{ __('Using the number of people you entered in line 5, fill in the dollar amount listed for your county for mortgage or rent expenses.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="122a1supfrm input-group d-flex">
                                                <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($meansTestCalculation['houshing_util_with_mortgage']);?>" class="non-mortg-9a price-field form-control"> 
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2"></div>
                                        <div class="col-md-8 d-flex mt-2">
                                            <label>9b.</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12">
                                                    <label> {{ __('Total average monthly payment for all mortgages and other debts secured by your home.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-2"></div>

                                        <div class="col-md-8 d-flex mt-2">
                                            <div class="row pl-4">
                                                <div class="col-md-12">
                                                    <label> {{ __('To calculate the total average monthly payment, add all amounts that are
                                                        contractually due to each secured creditor in the 60 months after you file for
                                                        bankruptcy. Then divide by 60.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $mortagesPopup = [];
                    foreach (range(1, 5) as $prop) {
                        foreach (range(1, 3) as $mor) {
                            if (isset($meantestPData['mortgage_monthly_pay'.$mor.'_'.$prop]) && isset($meantestPData['resident_mortgage_'.$mor.'_'.$prop])) {
                                $mortagesPopup[] = [
                                    'mothlay_pay' => $meantestPData['mortgage_monthly_pay'.$mor.'_'.$prop],
                                    'creditor_name' => $meantestPData['resident_mortgage_'.$mor.'_'.$prop]
                                ];
                            }
                        }

                    }
                    $credit1 = $mTestA2[base64_encode('B_122A-2-Quest9B creditor name1')] ?? null;
                    $credit2 = $mTestA2[base64_encode('B_122A-2-Quest9B creditor name2')] ?? null;
                    $credit3 = $mTestA2[base64_encode('B_122A-2-Quest9B creditor name3')] ?? null;
                    $credit1 = isset($mortagesPopup[0]['creditor_name']) ? $mortagesPopup[0]['creditor_name'] : '';
                    $credit2 = isset($mortagesPopup[1]['creditor_name']) ? $mortagesPopup[1]['creditor_name'] : '';
                    $credit3 = isset($mortagesPopup[2]['creditor_name']) ? $mortagesPopup[2]['creditor_name'] : '';

                    $creditprice1 = $mTestA2[base64_encode('B_122A-2-Quest9B creditor amount1')] ?? 0;
                    $creditprice2 = $mTestA2[base64_encode('B_122A-2-Quest9B creditor amount2')] ?? 0;
                    $creditprice3 = $mTestA2[base64_encode('B_122A-2-Quest9B creditor amount3')] ?? 0;
                    $creditprice1 = isset($mortagesPopup[0]['mothlay_pay']) ? $mortagesPopup[0]['mothlay_pay'] : 0;
                    $creditprice2 = isset($mortagesPopup[1]['mothlay_pay']) ? $mortagesPopup[1]['mothlay_pay'] : 0;
                    $creditprice3 = isset($mortagesPopup[2]['mothlay_pay']) ? $mortagesPopup[2]['mothlay_pay'] : 0;

                    $vehiclePopup = [];
                    foreach (range(0, 5) as $vehi) {
                        if (isset($meantestPData['vehicle_name_'.$vehi]) && isset($meantestPData['vehicle_creditor_'.$vehi]) && isset($meantestPData['vehicle_type_'.$vehi]) && $meantestPData['vehicle_type_'.$vehi] == Helper::VEHICLE_CARS_TK) {
                            if (isset($meantestPData['monthly_payment_'.$vehi])) {
                                $vehiclePopup[] = [
                                    'mothlay_pay' => $meantestPData['monthly_payment_'.$vehi],
                                    'creditor_name' => $meantestPData['vehicle_creditor_'.$vehi],
                                    'vehicle_name' => $meantestPData['vehicle_name_'.$vehi]
                                ];
                            }
                        }


                    }
                    $vehicle1name = $vehiclePopup[0]['vehicle_name'] ?? '';
                    $vehicle1price = $vehiclePopup[0]['mothlay_pay'] ?? 0;
                    $vehicle1creditor = $vehiclePopup[0]['creditor_name'] ?? '';

                    $vehicle2name = $vehiclePopup[1]['vehicle_name'] ?? '';
                    $vehicle2price = $vehiclePopup[1]['mothlay_pay'] ?? 0;
                    $vehicle2creditor = $vehiclePopup[1]['creditor_name'] ?? '';

                    ?>
                                        <div class="col-md-4 mt-2"></div>

                                        <div class="col-md-4 mt-3 pr-0">
                                                <div class="gray-box ml-2 p-3 ">
                                                    <label style="font-weight:bold;">Name of the creditor<br><br></label>
                                                </div>
                                        </div>
                                        <div class="col-md-2 mt-3 pl-0">
                                                <div class="gray-box p-3 mr-2">
                                                    <label style="font-weight:bold;">{{ __('Average monthly payment') }}</label>
                                                </div>
                                        </div>
                                        <div class="col-md-6 mt-3"></div>
                                            
                                        <div class="col-md-4  mt-2">
                                            <div class="122a1supfrm input-group">
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9B creditor name1'); ?>" type="text" value="<?php echo $credit1;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 122a11">
                                            <div class="122a1supfrm input-group d-flex ">
                                                <div class="122a1supfrm input-group-append prf5"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-Quest9B creditor amount1'); ?>" type="text" value="<?php echo $creditprice1; ?>" class="price-field mortgae_price1 form-control"> 
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2"></div>

                                        <div class="col-md-4  mt-2">
                                            <div class="122a1supfrm input-group">
                                            <input  name="<?php echo base64_encode('B_122A-2-Quest9B creditor name2'); ?>" type="text" value="<?php echo $credit2;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 122a12">
                                            <div class="122a1supfrm input-group d-flex ">
                                                <div class="122a1supfrm input-group-append prf6"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-Quest9B creditor amount2'); ?>" type="text" value="<?php echo $creditprice2;?>" class="price-field mortgae_price2 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2"></div>

                                        <div class="col-md-4  mt-2">
                                            <div class="122a1supfrm input-group">
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9B creditor name3'); ?>" type="text" value="<?php echo $credit3;?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 122a13">
                                            <div class="122a1supfrm input-group d-flex ">
                                                <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">+&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9B creditor amount3'); ?>" type="text" value="<?php echo $creditprice3;?>" class="price-field mortgae_price3 form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-2"></div>
                                        <?php $creditorTotal = $mTestA2[base64_encode('B_122A-2-Quest9B total amount')] ?? null;

                    $creditorTotal = str_replace(',', '', $creditprice1) + str_replace(',', '', $creditprice2) + str_replace(',', '', $creditprice3);
                    ?>
                                        <div class="col-md-4  mt-2 122a21">
                                            <div class="text-right">
                                                <label for=""> {{ __('Total average monthly payment') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 ">
                                            <div class="122a1supfrm input-group d-flex border_2px p-2">
                                                <div class="122a1supfrm input-group-append prf7"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9B total amount'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($creditorTotal); ?>" class="price-field mortgae_price_total form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <div class="122a1supfrm input-group d-flex"> 
                                                <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;-&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9B total amount'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($creditorTotal);?>" class="price-field mortgae_price_total_copy form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <div class="122a1supfrm input-group">
                                                <label for=""> {{ __('Repeat this amount on line 33a.') }}</label>
                                            </div>
                                        </div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <label>9c.</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12">
                                                    <label> {{ __('Net mortgage or rent expense.') }} <br>{{ __('Subtract line 9b (total average monthly payment) from line 9a (mortgage or rent expense). If this amount is less than $0, enter $0') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-4 ">
                                            <div class="122a1supfrm input-group d-flex border_2px p-2">
                                                <div class="122a1supfrm input-group-append prf8"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-quest9c1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-quest9c1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-quest9c1')]) : Helper::priceFormtWithComma('');?>" class="price-field subtract9bfrom9a form-control"> 
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 mt-4">
                                            <div class="122a1supfrm input-group d-flex">
                                                <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-Quest9C'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest9C')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest9C')]) : Helper::priceFormtWithComma('');?>" class="price-field subtract9bfrom9a_copy fi_line9c_rent_expense form-control"> 
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>10.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label style="font-weight:bold;">{{ __('If you claim that the U.S. Trustee Program’s division of the IRS Local Standard for housing is incorrect and affects
                                                the calculation of your monthly expenses, fill in any additional amount you claim.') }}</label>
                                        </div>
                                        <div class="col-md-1 mt-2">
                                            <div class="122a1supfrm input-group">
                                                <label for="">{{ __('Explain why:') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-11 mt-2">
                                            <div class="122a1supfrm input-group">
                                                <input name="<?php echo base64_encode('B_122A-2-Explain 1'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Explain 1')] ?? '';?>" class="form-control"> 
                                            </div>
                                            <div class="122a1supfrm input-group mt-1">
                                                <input name="<?php echo base64_encode('B_122A-2-Explain 2'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Explain 2')] ?? '';?>" class="form-control"> 
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm11 input-group d-flex">
                                        <div class="122a1supfrm11 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-Quest10'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest10')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest10')]) : Helper::priceFormtWithComma('');?>" class="price-field line10_122a2 form-control"> 
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex mt-3">
                                    <label for=""> <strong>11.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Local transportation expenses:') }}</span>  {{ __('Check the number of vehicles for which you claim an ownership or operating expense') }}
                                            </label>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="122a1supfrm input-group">
                                                <input class="fi_line11_no_of_vehicle" name="<?php echo base64_encode('B_122A-2-CheckBox6'); ?>" value="0" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox6')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox6'), $mTestA2, '0') : ($countVehicle == 0 ? "checked" : '');?>>
                                                <label for="">{{ __('0. Go to line 14.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="122a1supfrm input-group">
                                                <input class="fi_line11_no_of_vehicle" name="<?php echo base64_encode('B_122A-2-CheckBox6'); ?>" value="1" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox6')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox6'), $mTestA2, '1') : ($countVehicle == 1 ? "checked" : '');?>>
                                                <label for="">{{ __('1. Go to line 12.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="122a1supfrm input-group">
                                                <input class="fi_line11_no_of_vehicle" name="<?php echo base64_encode('B_122A-2-CheckBox6'); ?>" value="on" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox6')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox6'), $mTestA2, 'on') : ($countVehicle > 1 ? "checked" : '');?>>
                                                <label for="">{{ __('2 or more. Go to line 12.') }}</label>
                                           
                                            </div>
                                       
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>12.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Vehicle operation expense:') }}</span> Using the IRS Local Standards and the number of vehicles for which you claim the
                                                operating expenses, fill in the <span style="font-style: italic;">{{ __('Operating Costs') }}</span> {{ __('that apply for your Census region or metropolitan statistical area') }}
                                            </label>
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm12 input-group d-flex">
                                        <div class="122a1supfrm12 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest12'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest12')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest12')]) : Helper::priceFormtWithComma($tranportationExpense);?>" class="price-field fi_line12_public_transportation_expense form-control">
                                    </div>
                                </div>

                                <div class="col-md-9 d-flex mt-3">
                                    <label for=""> <strong>13.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Vehicle ownership or lease expense:') }}</span> {{ __('Using the IRS Local Standards, calculate the net ownership or lease expense
                                                for each vehicle below. You may not claim the expense if you do not make any loan or lease payments on the vehicle.
                                                In addition, you may not claim the expense for more than two vehicles.') }}
                                            </label>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="gray-box column-heading p-3 text-center">
                                                <strong class="d-block">{{ __('Vehicle 1') }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="122a1supfrm input-group">
                                                <label>{{ __('Describe Vehicle 1:') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mt-2">
                                        
                                            <div class="122a1supfrm input-group">
                                                <input name="<?php echo base64_encode('B_122A-2-Describe Vehicle 1 1'); ?>" class="form-control" type="text" value="<?php echo $vehicle1name;?>">
                                                <input name="<?php echo base64_encode('B_122A-2-Describe Vehicle 1 2'); ?>" class="form-control mt-1" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Describe Vehicle 1 2')] ?? '';?>">
                                            </div>
                                        </div>

                                        <div class="col-md-9 d-flex mt-2">
                                            <label>{{ __('13a.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('Ownership or leasing costs using IRS Local Standard.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <div class="122a1supfrm input-group d-flex">
                                                <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-Quest13A'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13A')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13A')]) : Helper::priceFormtWithComma($nationalOwnershipCostforvehicle1);?>" class="price-field line13a_122a2 form-control mr-0">
                                            </div>
                                        </div>

                                        <div class="col-md-9 d-flex mt-2">
                                            <label>{{ __('13b.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label>{{ __('Average monthly payment for all debts secured by Vehicle 1.') }}</label>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label>{{ __('Do not include costs for leased vehicles.') }}</label>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label>{{ __('To calculate the average monthly payment here and on line 13e, add all
                                                        amounts that are contractually due to each secured creditor in the 60 months
                                                        after you filed for bankruptcy. Then divide by 60.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="sp212 col-md-3 mt-2"></div>
                                    </div>

                                </div>
                                <div class="col-md-3 mt-3 sp212">
                                    <div class="122a1supfrm sp212 input-group d-flex">
                                    
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2" style="padding-left: 45px;">
                                    <div class="gray-box ncdtr column-heading ml-3 p-3">
                                        <strong class="d-block ncdtr">Name of each creditor for Vehicle 1<br><br></strong>
                                    </div>
                                </div>
                                
                                <div class="col-md-2 grb1 mt-2">
                                    <div class="gray-box grb1 column-heading p-3">
                                        <strong class="grb1 d-block">{{ __('Average monthly payment') }} </strong>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2" style="padding-left: 45px;">
                                    <div class="122a1supfrm input-group ml-3 mt-2">
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13B Creditor for vehicle 1-1'); ?>" type="text" value="<?php echo $vehicle1creditor;?>" class="form-control"> 
                                    </div>
                                    <div class="122a1supfrm input-group ml-3 mt-2">
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13B Creditor for vehicle 1-2'); ?>" type="text" value="<?php echo  isset($mTestA2[base64_encode('B_122A-2-Quest13B Creditor for vehicle 1-2')]) ? $mTestA2[base64_encode('B_122A-2-Quest13B Creditor for vehicle 1-2')] : '';?>" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm4 input-group d-flex mt-2">
                                        <div class="122a1supfrm input-group-append prf9"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13B amount for vehicle 1-1'); ?>" type="text" value="<?php echo $vehicle1price;?>" class="price-field form-control vehicle_price1"> 
                                    </div>
                                    <div class="122a1supfrm5 input-group d-flex mt-2">
                                        <div class="122a1supfrm5 input-group-append"> <span class="input-group-text" id="basic-addon2">+&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13B amount for vehicle 1-2'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13B amount for vehicle 1-2')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13B amount for vehicle 1-2')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehicle_price2"> 
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                
                                <div class="col-md-4  mt-2 122a21">
                                    <div class="text-right ">
                                        <label class="122a21" for=""> {{ __('Total average monthly payment') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 ">
                                    <div class="122a1supfrme1 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrme2 input-group-append prf10"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13B Total amount for vehicle 1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13B Total amount for vehicle 1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13B Total amount for vehicle 1')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehicle_price_total">                                     </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm12 input-group d-flex">
                                        <div class="122a1supfrm12 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;-&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13B Total amount for vehicle 1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13B Total amount for vehicle 1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13B Total amount for vehicle 1')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehicle_price_total_copy"> 
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm input-group">
                                        <label for=""> {{ __('Repeat this amount on line 33b.') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex mt-2" style="padding-left: 35px;">
                                    <label>{{ __('13c.') }}</label>
                                    <div class="row pl-1">
                                        <div class="col-md-12 ">
                                            <div class="122a1supfrm input-group">
                                                <label> {{ __('Net Vehicle 1 ownership or lease expense') }}<br>{{ __('Subtract line 13b from line 13a. If this amount is less than $0, enter $0.') }} </label>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-3 mt-4 ">
                                    <div class="122a1supfrme4 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrme5 input-group-append prf11"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13C'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13C')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13C')]) : Helper::priceFormtWithComma('');?>" class="price-field line13c_122a2_first fi_line13c_vehicle1_lease_expense form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <div class="122a1supfrm13 input-group d-flex">
                                        <div class="122a1supfrm13 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;net Vehicle&nbsp;1 expense&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13C'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13C')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13C')]) : Helper::priceFormtWithComma('');?>" class="price-field line13c_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-9 d-flex mt-3">
                                    <label for="">&nbsp;&nbsp;&nbsp;</label>
                                    <div class="row pl-1">
                                        <div class="col-md-2 mt-2">
                                            <div class="gray-box column-heading p-3 text-center">
                                                <strong class="d-block">{{ __('Vehicle 2') }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <div class="122a1supfrm input-group">
                                                <label>{{ __('Describe Vehicle 2:') }}</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-7 mt-2">
                                            <div class="122a1supfrm input-group">
                                                <input name="<?php echo base64_encode('B_122A-2-Describe Vehicle 2 1'); ?>" class="form-control" type="text" value="<?php echo $vehicle2name;?>">
                                                <input name="<?php echo base64_encode('B_122A-2-Describe Vehicle 2 2'); ?>" class="form-control mt-1" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Describe Vehicle 2 2')] ?? '';?>">
                                            </div>
                                        </div>

                                        <div class="col-md-9 d-flex mt-2">
                                            <label>{{ __('13d.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('Ownership or leasing costs using IRS Local Standard.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <div class="122a1supfrm input-group d-flex">
                                                <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-Quest13D'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13D')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13D')]) : Helper::priceFormtWithComma($nationalOwnershipCostforvehicle2);?>" class="price-field line13d_122a2 form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-9 d-flex mt-2">
                                            <label>{{ __('13e.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label>{{ __('Average monthly payment for all debts secured by Vehicle 2.') }}</label>
                                                </div>
                                                <div class="col-md-12 mt-2">
                                                    <label>{{ __('Do not include costs for leased vehicles.') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2">

                                        </div>
                                    </div>

                            </div>
                                <div class="col-md-3 mt-3">
                                    <div class="122a1supfrm input-group d-flex">
                                    
                                    </div>
                                </div>

                                <div class="col-md-4 ncdtr mt-2" style="padding-left: 45px;">
                                    <div class="gray-box ncdtr column-heading ml-3 p-3">
                                        <strong class="d-block">Name of each creditor for Vehicle 2<br><br></strong>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="gray-box grb2 column-heading p-3">
                                        <strong class="d-block">{{ __('Average monthly payment') }} </strong>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2" style="padding-left: 45px;">
                                    <div class="122a1supfrm1212 input-group ml-3 mt-2">
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13E.Creditor1'); ?>" type="text" value="<?php echo $vehicle2creditor;?>" class="form-control">
                                    </div>
                                    <div class="122a1supfrm1212 input-group ml-3 mt-2">
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13E.Creditor2'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Quest13E.Creditor2')] ?? '';?>" class="form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm6 input-group d-flex mt-2">
                                        <div class="122a1supfrm6 input-group-append prf12"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13E.Monthly1'); ?>" type="text" value="<?php echo $vehicle2price;?>" class="price-field form-control vehicle_price3">
                                    </div>
                                    <div class="122a1supfrm7 input-group d-flex mt-2">
                                        <div class="122a1supfrm7 input-group-append"> <span class="input-group-text" id="basic-addon2">+&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13E.Monthly2'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13E.Monthly2')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13E.Monthly2')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehicle_price4">
                                    </div>
                                </div>
                                <div class="122a21 col-md-6 mt-2"></div>

                                <div class="122a21 col-md-4  mt-2">
                                    <div class="122a21 text-right">
                                        <label for=""> {{ __('Total average monthly payment') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 ">
                                    <div class="122a1supfrme6 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrme7 input-group-append prf13"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13E.TotalMonthly'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13E.TotalMonthly')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13E.TotalMonthly')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehicle_2_total_price">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm14 input-group d-flex">
                                        <div class="122a1supfrm14 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;-&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13E.TotalMonthly'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13E.TotalMonthly')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13E.TotalMonthly')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehicle_2_total_price_copy"> 
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm input-group">
                                        <label for=""> {{ __('Repeat this amount on line 33c.') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex mt-2" style="padding-left: 35px;">
                                    <label>{{ __('13f.') }}</label>
                                    <div class="row pl-1">
                                        <div class="col-md-12 ">
                                            <div class="122a1supfrm input-group">
                                                <label> {{ __('Net Vehicle 2 ownership or lease expense') }}<br>{{ __('Subtract line 13e from line 13d. If this amount is less than $0, enter $0.') }} </label>
                                                
                                            </div>
                                        </div>
                            </div>
                        </div>
                                <div class="col-md-3 mt-4 ">
                                    <div class="122a1supfrme8 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrm39 input-group-append prf14"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13F'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13F')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13F')]) : Helper::priceFormtWithComma('');?>" class="price-field line13f_122a2_first fi_line13f_vehicle2_lease_expense form-control"> 
                                    </div>
                                </div>
                                <div class="col-md-3 mt-4">
                                    <div class="122a1supfrm15 input-group d-flex">
                                        <div class="122a1supfrm15 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;net Vehicle&nbsp;2 expense&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest13F'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13F')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13F')]) : Helper::priceFormtWithComma('');?>" class="price-field line13f_122a2 line13f_122a2_copy form-control"> 
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>14.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Public transportation expense:') }}</span> If you claimed 0 vehicles in line 11, using the IRS Local Standards, fill in the <span style="font-style: italic;">{{ __('Public Transportation') }}</span> {{ __('expense allowance regardless of whether you use public transportation.') }}
                                            </label>
                                        </div>
                            </div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm16 input-group d-flex">
                                        <div class="122a1supfrm16 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest14'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest14')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest14')]) : Helper::priceFormtWithComma($nationalPublic_transport);?>" class="price-field line14_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>15.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Additional public transportation expense:') }}</span>
                                                If you claimed 1 or more vehicles in line 11 and if you claim that you may also
                                                deduct a public transportation expense, you may fill in what you believe is the appropriate expense, but you may not claim
                                                more than the IRS Local Standard for 
                                                <span style="font-style: italic;">{{ __('Public Transportation') }}</span>
                                            </label>
                                </div>
                                    </div>
                            </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm17 input-group d-flex">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-Quest15'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest15')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest15')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line15_public_transpotation_expense form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2 mr-0 pr-0">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">{{ __('Other Necessary Expenses') }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-9 mt-2 ml-0 pl-0" style="padding-right: 22px;">
                                    <div class="gray-box column-heading p-3">
                                        <label>{{ __('In addition to the expense deductions listed above, you are allowed your monthly expenses forthe following IRS categories.') }}</label>
                                    </div>
                                </div>
                                
                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>16.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Taxes:') }}</span> {{ __('The total monthly amount that you will actually owe for federal, state and local taxes, such as income taxes, self-
                                                employment taxes, Social Security taxes, and Medicare taxes. You may include the monthly amount withheld from your
                                                pay for these taxes. However, if you expect to receive a tax refund, you must divide the expected refund by 12 and
                                                subtract that number from the total monthly amount that is withheld to pay for taxes.') }}<br>
                                                {{ __('Do not include real estate, sales, or use taxes.') }}
                                            </label>
                                        </div>
                                </div>
                                </div>
                                <?php
                                    $tax16FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-underfined16-taxes'), $mTestA2);
                    $tax16fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_48'), $meantestPData);

                    if (!empty($tax16fromPopup)) {
                        $tax16FromDynamic = $tax16fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm18 input-group d-flex">
                                        <div class="122a1supfrm18 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-underfined16-taxes'); ?>" type="text" value="{{Helper::priceFormtWithComma($tax16FromDynamic)}}" class="price-field line16_122a2 form-control">
                                    </div>
                                </div>
                                <?php
                        $q17FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_49'), $mTestA2);
                    $q17fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_49'), $meantestPData);
                    if (!empty($q17fromPopup)) {
                        $q17FromDynamic = $q17fromPopup;
                    }
                    ?>
                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>17.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Involuntary deductions:') }}</span> {{ __('The total monthly payroll deductions that your job requires, such as retirement contributions, union dues, and uniform costs.') }}<br>
                                                Do not include amounts that are not required by your job, such as voluntary 401(k) contributions or payroll savings.
                                            </label>
                                        </div>
                                    </div>
                        </div>
                                <div class="col-md-2 mt-4">
                                    <div class="122a1supfrm19 input-group d-flex">
                                        <div class="122a1supfrm19 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_49'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q17FromDynamic);?>" class="price-field line17_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>18.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Life insurance:') }} </span> {{ __('The total monthly premiums that you pay for your own term life insurance. If two married people are filing
                                                together, include payments that you make for your spouse’s term life insurance. Do not include premiums for life
                                                insurance on your dependents, for a non-filing spouse’s life insurance, or for any form of life insurance other than term.') }} 
                                            </label>

                            </div>
                                </div>
                                </div>
                                <?php
                        $q18FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_50'), $mTestA2);
                    $q18fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_50'), $meantestPData);
                    if (!empty($q18fromPopup)) {
                        $q18FromDynamic = $q18fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm20 input-group d-flex">
                                        <div class="122a1supfrm20 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_50'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q18FromDynamic);?>" class="price-field line18_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>19.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Court-ordered payments:') }}</span> {{ __('The total monthly amount that you pay as required by the order of a court or administrative
                                                agency, such as spousal or child support payments.') }}<br>
                                                {{ __('Do not include payments on past due obligations for spousal or child support. You will list these obligations in line 35.') }} 
                                            </label>
                                        </div>
                                    </div>

                                </div>

                                <?php
                        $q19FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_51'), $mTestA2);
                    $q19fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_51'), $meantestPData);
                    if (!empty($q19fromPopup)) {
                        $q19FromDynamic = $q19fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm input-group d-flex mt-4">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_51'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q19FromDynamic);?>" class="price-field line19_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>20.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Education:') }} </span> {{ __('The total monthly amount that you pay for education that is either required:') }}
                                            </label>
                                        </div>
                                        <div class="col-md-12 mt-2">
                                            <div class="122a1supfrm input-group ml-3">
                                                <label><i class="fa fa-square"></i>&nbsp;&nbsp;{{ __('as a condition for your job, or') }}</label><br>
                                                <label><i class="fa fa-square"></i>&nbsp;&nbsp;{{ __('for your physically or mentally challenged dependent child if no public education is available for similar services.') }}</label>
                                            </div>
                                    </div>

                                </div>
                                </div>
                                <?php
                        $q20FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_52'), $mTestA2);
                    $q20fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_52'), $meantestPData);
                    if (!empty($q20fromPopup)) {
                        $q20FromDynamic = $q20fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm21 input-group d-flex">
                                        <div class="122a1supfrm21 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_52'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q20FromDynamic);?>" class="price-field line20_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>21.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Childcare:') }} </span> {{ __('The total monthly amount that you pay for childcare, such as babysitting, daycare, nursery, and preschool. Do not include payments for any elementary or secondary school education.') }} 
                                            </label>
                                        </div>
                                            </div>
                                </div>
                                <?php
                        $q21FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_53'), $mTestA2);
                    $q21fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_53'), $meantestPData);
                    if (!empty($q21fromPopup)) {
                        $q21FromDynamic = $q21fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm22 input-group d-flex">
                                        <div class="122a1supfrm22 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_53'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q21FromDynamic);?>" class="price-field line21_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>22.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Additional health care expenses, excluding insurance costs:') }} </span> {{ __('The monthly amount that you pay for health care that
                                                is required for the health and welfare of you or your dependents and that is not reimbursed by insurance or paid by a
                                                health savings account. Include only the amount that is more than the total entered in line 7.') }}<br>
                                                {{ __('Payments for health insurance or health savings accounts should be listed only in line 25.') }}
                                            </label>
                                                </div>
                                    </div>
                                    </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm23 input-group d-flex">
                                        <div class="122a1supfrm23 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_54'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_54')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_54')]) : Helper::priceFormtWithComma('');?>" class="price-field line22_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>23.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;"> {{ __('Optional telephones and telephone services:') }} </span> {{ __('The total monthly amount that you pay for telecommunication services for
                                                you and your dependents, such as pagers, call waiting, caller identification, special long distance, or business cell phone
                                                service, to the extent necessary for your health and welfare or that of your dependents or for the production of income, if it
                                                is not reimbursed by your employer.') }}<br>
                                                {{ __('Do not include payments for basic home telephone, internet and cell phone service. Do not include self-employment
                                                expenses, such as those reported on line 5 of Official Form 122A-1, or any amount you previously deducted.') }}
                                            </label>
                                        </div>
                                    </div>
                                            </div>
                                <?php
                        $q23FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_55'), $mTestA2);
                    $q23fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_55'), $meantestPData);
                    if (!empty($q23fromPopup)) {
                        $q23FromDynamic = $q23fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm24 input-group d-flex">
                                        <div class="122a1supfrm24 input-group-append"> <span class="input-group-text" id="basic-addon2">+&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_55'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q23FromDynamic);?>" class="price-field line23_122a2 form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>24.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Add all of the expenses allowed under the IRS expense allowances.') }} </span> <br>
                                                {{ __('Add lines 6 through 23.') }}
                                            </label>
                                        </div>
                                            </div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm25 input-group d-flex">
                                        <div class="122a1supfrm25 input-group-append"> <span class="input-group-text" id="basic-addon2">+&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_56'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_56')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_56')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line24_irs_expense form-control">
                                    </div>
                                </div>

                                <div class="col-md-3 mt-2 mr-0 pr-0">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">Additional Expense Deductions<br><br></strong>
                                    </div>
                                </div>
                                <div class="col-md-9 mt-2 ml-0 pl-0" style="padding-right: 22px;">
                                    <div class="gray-box column-heading p-3">
                                        <label>{{ __('These are additional deductions allowed by the Means Test.') }}<br><i>{{ __('Note:') }}</i> {{ __('Do not include any expense allowances listed in lines 6-24') }} </label>
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>25.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Health insurance, disability insurance, and health savings account expenses.') }} </span> <br>
                                                    {{ __('The monthly expenses for health
                                                    insurance, disability insurance, and health savings accounts that are reasonably necessary for yourself, your spouse, or your
                                                    dependents.') }}
                                            </label>
                                        </div>
                                    </div>
                                        </div>
                                <div class="col-md-2 mt-3"></div>

                                <div class="col-md-4 mt-2 " style="padding-left: 38px;">
                                    <div class="122a1supfrm input-group">
                                        <label for=""> {{ __('Health insurance') }} </label>
                                    </div>
                                </div>
                                <?php
                        $q25aFromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_57'), $mTestA2);
                    $q25afromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_57'), $meantestPData);
                    if (!empty($q25afromPopup)) {
                        $q25aFromDynamic = $q25afromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-2 ">
                                    <div class="122a1supfrm26 input-group d-flex">
                                        <div class="122a1supfrm26 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_57'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q25aFromDynamic);?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2 " style="padding-left: 38px;">
                                    <div class="122a1supfrm input-group">
                                        <label for=""> {{ __('Disability insurance') }}</label>
                                    </div>
                                </div>
                                <?php
                        $q25bFromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_58'), $mTestA2);
                    $q25bfromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_58'), $meantestPData);
                    if (!empty($q25bfromPopup)) {
                        $q25bFromDynamic = $q25bfromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-2 ">
                                    <div class="122a1supfrm27 input-group d-flex">
                                        <div class="122a1supfrm27 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_58'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q25bFromDynamic);?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2 " style="padding-left: 38px;">
                                    <div class="122a1supfrm input-group">
                                        <label for=""> {{ __('Health savings account') }}</label>
                                    </div>
                                </div>
                                <?php
                        $q25cFromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-1_2'), $mTestA2);
                    $q25cfromPopup = Helper::validate_key_value(base64_encode('B_122A-2-1_2'), $meantestPData);
                    if (!empty($q25cfromPopup)) {
                        $q25cFromDynamic = $q25cfromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-2 ">
                                    <div class="122a1supfrm28 input-group d-flex">
                                        <div class="122a1supfrm28 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;+&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-1_2'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q25cFromDynamic);?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4  mt-2 " style="padding-left: 38px;">
                                    <div class="122a1supfrm input-group">
                                        <label for=""> {{ __('Total') }}</label>
                                    </div>
                                </div>
                                <?php
                        $q25dFromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-2_2'), $mTestA2);
                    $q25dfromPopup = Helper::validate_key_value('healthcare_total', $meantestPData);
                    if (!empty($q25dfromPopup)) {
                        $q25dFromDynamic = $q25dfromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-2 ">
                                    <div class="122a1supfrm10 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrm input-group-append prf15"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-2_2'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q25dFromDynamic);?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm291 input-group d-flex">
                                        <div class="122a1supfrm301 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;total&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;</span> </div>
                                    </div>
                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm311 input-group d-flex">
                                        <div class="122a1supfrm321 input-group-append prf15"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-2_2'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q25dFromDynamic);?>" class="price-field form-control line25_122a2">
                                    </div>
                                </div>

                                <div class="col-md-4 mt-2 " style="padding-left: 38px;">
                                    <div class="122a1supfrm input-group">
                                        <label> {{ __('Do you actually spend this total amount?') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mt-2"></div>

                                <div class="col-md-4 mt-2 " style="padding-left: 38px;">
                                    <div class="122a1supfrm input-group ">
                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox7'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox7')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox7'), $mTestA2, 'No') : '';?>>
                                        <label for="">{{ __('No. How much do you actually spend?') }}</label>
                                    </div>
                                    <div class="122a1supfrm input-group ">
                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox7'); ?>" value="On" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox7')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox7'), $mTestA2, 'On') : '';?>>
                                        <label for="">{{ __('Yes') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm30 input-group d-flex">
                                        <div class="122a1supfrm30 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_59'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_59')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_59')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>26.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Continuing contributions to the care of household or family members.') }} </span> {{ __('The actual monthly expenses that you will
                                                continue to pay for the reasonable and necessary care and support of an elderly, chronically ill, or disabled member of your
                                                household or member of your immediate family who is unable to pay for such expenses. These expenses may include
                                                contributions to an account of a qualified ABLE program. 26 U.S.C. § 529A(b).') }}
                                            </label>
                                        </div>
                                    </div></div>
                                <?php
                        $q26FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_61'), $mTestA2);
                    $q26fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_61'), $meantestPData);
                    if (!empty($q26fromPopup)) {
                        $q26FromDynamic = $q26fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm31 input-group d-flex">
                                        <div class="122a1supfrm31 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_61'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q26FromDynamic);?>" class="price-field form-control line26_122a2">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>27.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Protection against family violence.') }} </span> {{ __('The reasonably necessary monthly expenses that you incur to maintain the safety of
                                                you and your family under the Family Violence Prevention and Services Act or other federal laws that apply.') }}<br>
                                                {{ __('By law, the court must keep the nature of these expenses confidential.') }}
                                            </label>
                                        </div></div>
                                </div>
                                <?php
                        $q27FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_62'), $mTestA2);
                    $q27fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_62'), $meantestPData);
                    if (!empty($q27fromPopup)) {
                        $q27FromDynamic = $q27fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm32 input-group d-flex">
                                        <div class="122a1supfrm32 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_62'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q27FromDynamic);?>" class="price-field form-control line27_122a2">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>28.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Additional home energy costs.') }} </span> {{ __('Your home energy costs are included in your insurance and operating expenses on line 8.
                                                If you believe that you have home energy costs that are more than the home energy costs included in expenses on line
                                                8, then fill in the excess amount of home energy costs.') }}<br>
                                                {{ __('You must give your case trustee documentation of your actual expenses, and you must show that the additional amount
                                                claimed is reasonable and necessary.') }} 
                                            </label>
                                        </div></div></div>
                                <?php
                        $q28FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_63'), $mTestA2);
                    $q28fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_63'), $meantestPData);
                    if (!empty($q28fromPopup)) {
                        $q28FromDynamic = $q28fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm33 input-group d-flex">
                                        <div class="122a1supfrm33 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_63'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q28FromDynamic);?>" class="price-field form-control line28_122a2">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>29.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Education expenses for dependent children who are younger than 18.') }} </span> The monthly expenses (not more than $189.58*
                                                per child) that you pay for your dependent children who are younger than 18 years old to attend a private or public
                                                elementary or secondary school.<br>
                                                {{ __('You must give your case trustee documentation of your actual expenses, and you must explain why the amount claimed is
                                                reasonable and necessary and not already accounted for in lines 6-23.') }}<br>
                                                * Subject to adjustment on 4/01/25, and every 3 years after that for cases begun on or after the date of adjustment.
                                            </label></div></div>
                                </div>
                                <?php
                        $q29FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_64'), $mTestA2);
                    $q29fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_64'), $meantestPData);
                    if (!empty($q29fromPopup)) {
                        $q29FromDynamic = $q29fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm34 input-group d-flex">
                                        <div class="122a1supfrm34 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_64'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q29FromDynamic);?>" class="price-field fi_line29_education_expense form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>30.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Additional food and clothing expense.') }} </span> {{ __('The monthly amount by which your actual food and clothing expenses are higher
                                                than the combined food and clothing allowances in the IRS National Standards. That amount cannot be more than 5% of the
                                                food and clothing allowances in the IRS National Standards.') }}<br>
                                                {{ __('To find a chart showing the maximum additional allowance, go online using the link specified in the separate instructions for
                                                this form. This chart may also be available at the bankruptcy clerk’s office.') }}<br>
                                                {{ __('You must show that the additional amount claimed is reasonable and necessary') }} 
                                            </label>
                                    </div></div>
                                </div>
                                <?php
                        $q30FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_65'), $mTestA2);
                    $q30fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_65'), $meantestPData);
                    if (!empty($q30fromPopup)) {
                        $q30FromDynamic = $q30fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm35 input-group d-flex">
                                        <div class="122a1supfrm35 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_65'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q30FromDynamic);?>" class="price-field fi_line30_additional_food_and_clothing_expense form-control">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>31.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Continuing charitable contributions.') }} </span> {{ __('The amount that you will continue to contribute in the form of cash or financial instruments to a religious or charitable organization. 26 U.S.C. § 170(c)(1)-(2).') }} 
                                            </label>
                                        </div></div></div>
                                <?php
                        $q31FromDynamic = Helper::validate_key_value(base64_encode('B_122A-2-undefined_66'), $mTestA2);
                    $q31fromPopup = Helper::validate_key_value(base64_encode('B_122A-2-undefined_66'), $meantestPData);
                    if (!empty($q31fromPopup)) {
                        $q31FromDynamic = $q31fromPopup;
                    }
                    ?>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm36 input-group d-flex">
                                        <div class="122a1supfrm36 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_66'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($q31FromDynamic);?>" class="price-field form-control line31_122a2">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>32.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Add all of the additional expense deductions.') }} </span> <br>{{ __('Add lines 25 through 31.') }}
                                            </label>
                                        </div></div>
                                </div>
                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm37 input-group d-flex">
                                        <div class="122a1supfrm37 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_67'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_67')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_67')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line32_additional_expense_deductions form-control">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">{{ __('Deductions for Debt Payment') }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex mt-3">
                                    <label for=""> <strong>33.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-10">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('For debts that are secured by an interest in property that you own, including home mortgages, vehicle
                                                loans, and other secured debt, fill in lines 33a through 33e.') }} </span>
                                            </label>
                                        </div>
                                        <div class="col-md-2"></div>

                                        <div class="col-md-10">
                                            <label>{{ __('To calculate the total average monthly payment, add all amounts that are contractually due to each secured
                                                creditor in the 60 months after you file for bankruptcy. Then divide by 60.') }}
                                            </label>
                                        </div>
                                        <div class="col-md-2"></div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <div class="row pl-3">
                                                <div class="col-md-12 pt-3">
                                                    <label style="font-weight:bold;"> {{ __('Mortgages on your home:') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="gray-box column-heading p-3">
                                                <strong class="d-block">{{ __('Average Monthly payment') }}</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <label>{{ __('33a.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('Copy line 9b here') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="122a1supfrm38 input-group d-flex">
                                                <div class="122a1supfrm38 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-Quest9B total amount'); ?>" type="text" value="<?php echo Helper::priceFormtWithComma($creditorTotal);?>" class="price-field form-control line33a_122a2">
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <label>&nbsp;&nbsp;&nbsp;</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12">
                                                    <label style="font-weight:bold;"> {{ __('Loans on your first two vehicles:') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 mt-2">
                                        </div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <label>{{ __('33b.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('Copy line 13b here.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="122a1supfrm39 input-group d-flex">
                                                <div class="122a1supfrm39 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-Quest13B Total amount for vehicle 1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13B Total amount for vehicle 1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13B Total amount for vehicle 1')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehcile_price_33_b">
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <label>{{ __('33c.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('Copy line 13e here.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <div class="122a1supfrm30 input-group d-flex">
                                                <div class="122a1supfrm30 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input  name="<?php echo base64_encode('B_122A-2-Quest13E.TotalMonthly'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest13E.TotalMonthly')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest13E.TotalMonthly')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control vehcile_price_33_e">
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>

                                        <div class="col-md-12 d-flex mt-2">
                                            <label>{{ __('33d.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('List other secured debts:') }} </label>
                                                </div>
                                                <div class="col-md-3 mt-2" style="padding-right: 2px;">
                                                    <div class="gray-box column-heading p-3">
                                                        <strong class="d-block">Name of each creditor for other secured debt<br><br><br><br></strong>
                                                    </div>
                                                    <div class="122a1supfrm41 input-group" style="margin-top: 12px;">
                                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_71'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_71')] ?? ''; ?>" class="form-control">
                                                    </div>
                                                    <div class="122a1supfrm42 input-group" style="margin-top: 18px;">
                                                    <input name="<?php echo base64_encode('B_122A-2-undefined_74'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_74')] ?? ''; ?>" class="form-control">
                                                    </div>
                                                    <div class="122a1supfrm42 input-group" style="margin-top: 18px;">
                                                    <input name="<?php echo base64_encode('B_122A-2-undefined_77'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_77')] ?? ''; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-2" style="padding-right: 2px; padding-left:2px;">
                                                    <div class="gray-box column-heading p-3">
                                                        <strong class="d-block">Identify property that secures the debt<br><br><br><br><br></strong>
                                                    </div>
                                                    <div class="122a1supfrm43 input-group" style="margin-top: 12px;">
                                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_72'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_72')] ?? ''; ?>" class="form-control">
                                                    </div>
                                                    <div class="122a1supfrm44 input-group" style="margin-top: 18px;">
                                                    <input name="<?php echo base64_encode('B_122A-2-undefined_75'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_75')] ?? ''; ?>" class="form-control">
                                                    </div>
                                                    <div class="122a1supfrm45 input-group" style="margin-top: 18px;">
                                                    <input name="<?php echo base64_encode('B_122A-2-undefined_78'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_78')] ?? ''; ?>" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-1 pr-0 mt-2" style="padding-left:2px;">
                                                    <div class="gray-box column-heading p-3">
                                                        <strong class="d-block">{{ __('Does payment include taxes or insurance?') }}</strong>
                                                    </div>
                                                    <div class="122a1supfrm46 input-group mt-2 pl-3">
                                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox8'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox8')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox8'), $mTestA2, 'No') : '';?>>
                                                        <label for="">{{ __('No') }}</label>
                                                    </div>
                                                    <div class="122a1supfrm47 input-group pl-3">
                                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox8'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox8')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox8'), $mTestA2, 'Yes') : '';?>>
                                                        <label for="">{{ __('Yes') }}</label>
                                                    </div>
                                                    <div class="122a1supfrm48 input-group mt-2 pl-3">
                                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox9'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox9')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox9'), $mTestA2, 'No') : '';?>>
                                                        <label for="">{{ __('No') }}</label>
                                                    </div>
                                                    <div class="122a1supfrm49 input-group pl-3">
                                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox9'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox9')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox9'), $mTestA2, 'Yes') : '';?>>
                                                        <label for="">{{ __('Yes') }}</label>
                                                    </div>
                                                    <div class="122a1supfrm50 input-group mt-2 pl-3">
                                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox10'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox10')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox10'), $mTestA2, 'No') : '';?>>
                                                        <label for="">{{ __('No') }}</label>
                                                    </div>
                                                    <div class="122a1supfrm51 input-group pl-3">
                                                        <input  name="<?php echo base64_encode('B_122A-2-CheckBox10'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox10')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox10'), $mTestA2, 'Yes') : '';?>>
                                                        <label for="">{{ __('Yes') }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pl-0 mt-2">
                                                    <div class="122a1supfrm52 input-group d-flex" style="margin-top:139px;">
                                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                        <input name="<?php echo base64_encode('B_122A-2-undefined_73'); ?>" type="text" style="margin-right: 14px;" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_73')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_73')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line33d1_122a2">
                                                    </div>
                                                    <div class="122a1supfrm53 input-group d-flex" style="margin-top:18px;">
                                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                        <input name="<?php echo base64_encode('B_122A-2-undefined_76'); ?>" type="text" style="margin-right: 14px;" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_76')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_76')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line33d2_122a2">
                                                    </div>
                                                    <div class="122a1supfrm54 input-group d-flex" style="margin-top:18px;">
                                                        <div class="122a1supfrm54 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                        <input name="<?php echo base64_encode('B_122A-2-undefined_79'); ?>" type="text" style="margin-right: 14px;" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_79')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_79')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line33d3_122a2">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 mt-2"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-7 d-flex mt-2">
                                            <label>{{ __('33e.') }}</label>
                                            <div class="row pl-1">
                                                <div class="col-md-12 ">
                                                    <label> {{ __('Total average monthly payment. Add lines 33a through 33d.') }} </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2 ">
                                            <div class="122a1supfrm55 input-group d-flex border_2px p-2">
                                                <div class="122a1supfrm55 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-undefined_80'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_80')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_80')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line33e_122a2">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-2">
                                            <div class="122a1supfrm56 input-group d-flex">
                                                <div class="122a1supfrm56 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;total&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-undefined_80'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_80')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_80')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line33e_122a2">
                                            </div>
                                </div></div>
                                </div>
                                
                                <div class="col-md-9 d-flex mt-3">
                                    <label for=""> <strong>34.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Are any debts that you listed in line 33 secured by your primary residence, a vehicle, or other property necessary for your support or the support of your dependents?') }} </span>
                                            </label>
                                        </div>
                            </div></div>
                                <div class="col-md-3 mt-3"></div>

                                <div class="col-md-10 d-flex mt-3">
                                    <div class="row pl-3">
                                        <div class="col-md-1">
                                            <div class="122a1supfrm57 input-group">
                                                <input  name="<?php echo base64_encode('B_122A-2-CheckBox11'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox11')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox11'), $mTestA2, 'No') : '';?>>
                                                <label>{{ __('No.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="122a1supfrm57 input-group">
                                                <label> {{ __('Go to line 35.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="122a1supfrm58 input-group">
                                                <input  name="<?php echo base64_encode('B_122A-2-CheckBox11'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox11')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox11'), $mTestA2, 'Yes') : '';?>>
                                                <label>{{ __('Yes.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="122a1supfrm58 input-group">
                                                <label> {{ __('State any amount that you must pay to a creditor, in addition to the payments listed in line 33, to keep possession of your property (called the') }} <i>{{ __('cure amount') }}</i>{{ __('). Next, divide by 60 and fill in the information below.') }}</label>
                                            </div>
                                        </div>
                                    </div></div>
                                <div class="col-md-2 mt-3"></div>

                                <div class="col-md-1 mt-3"></div>
                                <div class="col-md-2 mt-3 pr-0">
                                    <div class="gray-box column-heading p-3" style="padding-right:2px;">
                                        <strong class="d-block">Name of the creditor<br><br></strong>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3 pr-0" style=" padding-right:2px; padding-left:4px;">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">{{ __('Identify property that secures the debt') }}</strong>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3 pr-0" style=" padding-right:66px; padding-left:2px;">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">Total cure amount<br><br></strong>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3" style=" padding-left:2px;">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">Monthly cure amount<br><br></strong>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3"></div>

                                <div class="col-md-1 mt-2"></div>
                                <div class="col-md-2 mt-2 pr-0">
                                    <div class="122a1supfrm59 input-group">
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_81'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_81')] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:2px; padding-left:4px;">
                                    <div class="122a1supfrm60 input-group">
                                        <input name="<?php echo base64_encode('B_122A-2-secures the debt'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-secures the debt')] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:2px; padding-left:2px;">
                                    <div class="122a1supfrm61 input-group d-flex ">
                                        <div class="122a1supfrm62 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_82'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_82')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_82')]) : Helper::priceFormtWithComma('');?>" class="price-field line34_cure_1_122a2 form-control">
                                        <div class="122a1supfrm63 input-group-append"> <span class="input-group-text" id="basic-addon2">÷&nbsp;60&nbsp;=</span> </div>
                                    </div></div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm64 input-group d-flex ">
                                        <div class="122a1supfrm65 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_83'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_83')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_83')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line34_1_122a2">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-1 mt-2"></div>
                                <div class="col-md-2 mt-2 pr-0">
                                    <div class="122a1supfrm66 input-group">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_84'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_84')] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:2px; padding-left:4px;">
                                    <div class="122a1supfrm67 input-group">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_85'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_85')] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:2px; padding-left:2px;">
                                    <div class="122a1supfrm68 input-group d-flex ">
                                        <div class="122a1supfrm69 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_86'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_86')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_86')]) : Helper::priceFormtWithComma('');?>" class="price-field line34_cure_2_122a2 form-control">
                                        <div class="122a1supfrm70 input-group-append"> <span class="input-group-text" id="basic-addon2">÷&nbsp;60&nbsp;=</span> </div>
                                    </div>
                                </div>
                                <div class="122a1sup col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm71 input-group d-flex ">
                                        <div class="122a1supfrm72 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_87'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_87')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_87')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line34_2_122a2">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-1 mt-2"></div>
                                <div class="col-md-2 mt-2 pr-0">
                                    <div class="122a1supfrm73 input-group">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_88'); ?>"  type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_88')] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:2px; padding-left:4px;">
                                    <div class="122a1supfrm74 input-group">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_89'); ?>"  type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_89')] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:2px; padding-left:2px;">
                                    <div class="122a1supfrm75 input-group d-flex ">
                                        <div class="122a1supfrm76 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_90'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_90')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_90')]) : Helper::priceFormtWithComma('');?>" class="price-field line34_cure_3_122a2 form-control">
                                        <div class="122a1supfrm77 input-group-append"> <span class="input-group-text" id="basic-addon2">÷&nbsp;60&nbsp;=</span> </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm78 input-group d-flex ">
                                        <div class="122a1supfrm79 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_91'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_91')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_91')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line34_3_122a2">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-5 mt-2"></div>
                                <div class="col-md-2 mt-2 pr-0" style=" padding-right:7px; padding-left:2px;">
                                    <div class="text-right mt-2">
                                        <label for="">{{ __('Total') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm80 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrm80 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_92'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_92')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_92')]) : Helper::priceFormtWithComma('');?>" class="price-field readonly form-control line34_total_122a2">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm81 input-group d-flex mt-2">
                                        <div class="122a1supfrm81 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;total&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_92'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_92')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_92')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line34_total_122a2">
                                    </div>
                                </div>

                                <div class="col-md-9 d-flex mt-3">
                                    <label for=""> <strong>35.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Do you owe any priority claims such as a priority tax, child support, or alimony ─
                                                that are past due as of the filing date of your bankruptcy case?') }}</span> {{ __('11 U.S.C. § 507.') }} 
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3"></div>

                                <div class="col-md-10 d-flex mt-3">
                                    <div class="row pl-3">
                                        <div class="col-md-1">
                                            <div class="122a1supfrm input-group">
                                                <input  name="<?php echo base64_encode('B_122A-2-CheckBox12'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox12')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox12'), $mTestA2, 'No') : '';?>>
                                                <label>{{ __('No.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="122a1supfrm82 input-group">
                                                <label> {{ __('Go to line 36.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="122a1supfrm83 input-group">
                                                <input  name="<?php echo base64_encode('B_122A-2-CheckBox12'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox12')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox12'), $mTestA2, 'Yes') : '';?>>
                                                <label>{{ __('Yes.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="122a1supfrm84 input-group">
                                                <label> {{ __('Fill in the total amount of all of these priority claims. Do not include current or ongoing priority claims, such as those you listed in line 19.') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3"></div>

                                <div class="col-md-1"></div>

                                <div class="col-md-6 mt-2" style="">
                                    <div class="122a1supfrm85 input-group">
                                        <label for="">{{ __('Total amount of all past-due priority claims') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm86 input-group d-flex ">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_93'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_93')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_93')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-1 mt-2">
                                    <div class="122a1supfrm87 input-group d-flex mt-2">
                                        <div class="122a1supfrm input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">÷&nbsp;60&nbsp;=</span> </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm88 input-group d-flex mt-2">
                                        <div class="122a1supfrm88 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_93-1'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_93-1')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_93-1')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line35_122a2">
                                    </div>
                                </div>

                                <div class="col-md-9 d-flex mt-3">
                                    <label for=""> <strong>36.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Are you eligible to file a case under Chapter 13?') }}</span> {{ __('11 U.S.C. § 109(e).') }}<br>
                                                {{ __('For more information, go online using the link for') }} <i>{{ __('Bankruptcy Basics') }}</i> {{ __('specified in the separate
                                                instructions for this form.') }} <i>{{ __('Bankruptcy Basics') }}</i> {{ __('may also be available at the bankruptcy clerk’s office.') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-3"></div>

                                <div class="col-md-10 d-flex mt-3">

                                    <div class="row pl-3">
                                        <div class="col-md-2">
                                            <div class="122a1supfrm89 input-group d-flex">
                                                <input name="<?php echo base64_encode('B_122A-2-CheckBox13'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox13')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox13'), $mTestA2, 'No') : '';?>>
                                                <label>{{ __('No.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="122a1supfrm90 input-group pl-2">
                                                <label> {{ __('Go to line 37.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="122a1supfrm91 input-group d-flex">
                                                <input name="<?php echo base64_encode('B_122A-2-CheckBox13'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox13')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox13'), $mTestA2, 'Yes') : '';?>>
                                                <label>{{ __('Yes.') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="122a1supfrm92 input-group pl-2">
                                                <label> {{ __('Fill in the following information.') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-3"></div>

                                <div class="col-md-1"></div>

                                <div class="col-md-6 mt-2" style="">
                                    <div class="122a1supfrm93 input-group">
                                        <label for="">{{ __('Projected monthly plan payment if you were filing under Chapter 13') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm94 input-group d-flex ">
                                        <div class="122a1supfrm94 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input  name="<?php echo base64_encode('B_122A-2-undefined_97'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_97')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_97')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-1"></div>
                                <div class="col-md-6 mt-2" style="">
                                    <div class="122a1supfrm95 input-group">
                                        <label for="">{{ __('Current multiplier for your district as stated on the list issued by the
                                        Administrative Office of the United States Courts (for districts in Alabama and
                                        North Carolina) or by the Executive Office for United States Trustees (for all
                                        other districts).') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm96 input-group d-flex ">
                                        <div class="122a1supfrm96 input-group-append"> <span class="input-group-text" id="basic-addon2">X</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-x'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-x')] ?? '';?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-1"></div>
                                <div class="col-md-6 mt-2" style="">
                                    <div class="122a1supfrm97 input-group">
                                        <label for="">{{ __('To find a list of district multipliers that includes your district, go online using the
                                        link specified in the separate instructions for this `form. This list may also be
                                        available at the bankruptcy clerk’s office.') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-5 mt-2"></div>

                                <div class="col-md-1"></div>
                                <div class="col-md-6 mt-2" style="">
                                    <div class="122a1supfrm98 input-group">
                                        <label for="">{{ __('Average monthly administrative expense if you were filing under Chapter 13.') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm99 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrm99 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_98'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_98')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_98')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line36_122a2">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm100 input-group d-flex mt-2">
                                        <div class="122a1supfrm100 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;total&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_98'); ?>"  type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_98')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_98')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control line36_122a2_copy">
                                    </div>
                                </div>

                                <div class="col-md-10 d-flex mt-3">
                                    <label for=""> <strong>37.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Add all of the deductions for debt payment.') }} </span> <br>{{ __('Add lines 33e through 36.') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 mt-3">
                                    <div class="122a1supfrm101 input-group d-flex">
                                        <div class="122a1supfrm101 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_100'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_100')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_100')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line37_deduction_for_debt_payment form-control">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-3">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">{{ __('Total Deductions from Income') }}</strong>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 d-flex mt-3">
                                    <label for=""> <strong>38.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">
                                            <label>
                                                <span style="font-weight:bold;">{{ __('Add all of the allowed deductions.') }} </span> <br>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="122a1supfrm102 input-group" style="padding-left:22px;">
                                        <label for="">Copy line 24, <i>{{ __('All of the expenses allowed under IRS expense allowances.') }}</i></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="122a1supfrm103 input-group d-flex ">
                                        <div class="122a1supfrm103 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_101'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_101')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_101')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line24_irs_expense form-control">
                                    </div>
                                </div>
                                <div class="col-md-6"></div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm104 input-group" style="padding-left:22px;">
                                        <label for="">Copy line 32, <i> {{ __('All of the additional expense deductions.') }}</i></label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm105 input-group d-flex ">
                                        <div class="122a1supfrm106 input-group-append"> <span class="input-group-text" id="basic-addon2">&nbsp;&nbsp;&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_102'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_102')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_102')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line32_additional_expense_deductions form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-2"></div>

                                <div class="col-md-4 mt-2">
                                    <div class="122a1supfrm107 input-group" style="padding-left:22px;">
                                        <label for="">Copy line 37, <i>{{ __('All of the deductions for debt payment.') }}</i></label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <div class="122a1supfrm108 input-group d-flex ">
                                        <div class="122a1supfrm108 input-group-append"> <span class="input-group-text" id="basic-addon2">+&nbsp;$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_103'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_103')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_103')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line37_deduction_for_debt_payment form-control">
                                    </div>
                                </div>

                                <div class="col-md-6 mt-2"></div>

                                
                                <div class="col-md-4 mt-2 pr-0" style=" padding-right:7px; padding-left:2px;">
                                    <div class="text-right mt-2">
                                        <label for="">{{ __('Total deductions') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 mt-2" style=" padding-right:8px; padding-left:2px;">
                                    <div class="122a1supfrm109 input-group d-flex border_2px p-2">
                                        <div class="122a1supfrm109 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_104'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_104')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_104')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line38_deduction_for_income form-control">
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm110 input-group d-flex mt-2">
                                        <div class="122a1supfrm110 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;total&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;</span> </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2">
                                    <div class="122a1supfrm111 input-group d-flex mt-2">
                                        <div class="122a1supfrm111 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_104'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_104')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_104')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line38_deduction_for_income form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Part 3 -->
                        <div class="row align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 3') }}</span>
                                    <h2 class="font-lg-18">{{ __('Determine Whether There Is a Presumption of Abuse') }}
                                    </h2> </div>
                            </div>
                        </div>
                        <div class="form-border mb-3">
                            <!-- 39 -->
                            <div class="col-md-12 mt-3">
                                <div class="row">
                                    
                                    <div class="col-md-12 d-flex mt-3">
                                        <label for=""> <strong>39.</strong></label>
                                        <div class="row pl-1">
                                            <div class="col-md-12">
                                                <label>
                                                    <span style="font-weight:bold;">{{ __('Calculate monthly disposable income for 60 months.') }} </span> <br>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-2">
                                        <div class="122a1supfr112 input-group ml-3">
                                            <label>{{ __('39a. Copy line 4,') }} <i>{{ __('adjusted current monthly income') }}</i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="122a1supfrm112 input-group d-flex">
                                            <div class="122a1supfrm112 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                            <input name="<?php echo base64_encode('B_122A-2-Quest4'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-Quest4')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-Quest4')]) : Helper::priceFormtWithComma('');?>" class="price-field  adjusting_current_mnthly_income form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-2"></div>

                                    <div class="col-md-4 mt-2">
                                        <div class="122a1supfrm113 input-group ml-3">
                                            <label>{{ __('39b. Copy line 38,') }} <i>{{ __('Total deductions.') }}</i> </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="122a1supfrm114 input-group d-flex">
                                            <div class="122a1supfrm114 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                            <input name="<?php echo base64_encode('B_122A-2-undefined_104'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_104')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_104')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line38_deduction_for_income form-control">
                                        </div>

                                    </div>

                                    <div class="col-md-6 mt-2"></div>

                                    <div class="col-md-4 mt-2">
                                        <div class="122a1supfrm115 input-group ml-3">
                                            <label>{{ __('39c. Monthly disposable income. 11 U.S.C. § 707(b)(2).') }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Subtract line 39b from line 39a.') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="122a1supfrm116 input-group d-flex border_2px p-2">
                                            <div class="122a1supfrm116 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                            <input name="<?php echo base64_encode('B_122A-2-undefined_107'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_107')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_107')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line39c_monthly_disposable_income fi_line39c_monthly_disposable_income_first form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="122a1supfrm117 input-group d-flex">
                                            <div class="122a1supfrm117 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;$</span> </div>
                                            <input name="<?php echo base64_encode('B_122A-2-undefined_107'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_107')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_107')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line39c_monthly_disposable_income form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2"></div>

                                    <div class="col-md-7 mt-2">
                                        <div class="122a1supfrm118 input-group ml-3">
                                            <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('For the next 60 months (5 years)') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-2">
                                        <div class="122a1supfrm119 input-group d-flex">
                                            <div class="122a1supfrm119 input-group-append"> <span class="input-group-text" id="basic-addon2">X 60</span> </div>
                                        </div>
                                    </div>

                                    <div class="col-md-7 mt-2">
                                        <div class="122a1supfrm120 input-group ml-3">
                                            <label>39d. <span style="font-weight:bold;">Total.</span> {{ __('Multiply line 39c by 60') }} </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="122a1supfrm121 input-group border_2px p-2 d-flex">
                                            <div class="122a1supfrm121 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                            <input name="<?php echo base64_encode('B_122A-2-undefined_108'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_108')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_108')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line39d_60month_disposable_income form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2">
                                        <div class="122a1supfrm input-group d-flex">
                                            <div class="122a1supfrm122 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">Copy&nbsp;here&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;</span> </div>
                                            <div class="122a1supfrm122 input-group border_2px p-2 d-flex">
                                                <div class="122a1supfrm122 input-group-append"> <span class="input-group-text" id="basic-addon2"><span style="font-weight:bold;">$</span> </div>
                                                <input name="<?php echo base64_encode('B_122A-2-undefined_108'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_108')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_108')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line39d_60month_disposable_income form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex mt-3">
                                        <label for=""> <strong>40.</strong></label>
                                        <div class="row pl-1">
                                            <div class="col-md-12">
                                                <label>
                                                    <span style="font-weight:bold;">{{ __('Find out whether there is a presumption of abuse.') }}</span> {{ __('Check the box that applies') }}
                                                </label>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="122a1supfrm123 input-group">
                                                    <input class="fi_line40_initial_presumptions line_40a_check" name="<?php echo base64_encode('B_122A-2-CheckBox14'); ?>" value="1" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox14')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox14'), $mTestA2, '1') : '';?>>
                                                    <label><span style="font-weight:bold;">The line 39d is less than $9,075*.</span> {{ __('On the top of page 1 of this form, check box 1, There is no presumption of abuse. Go to Part 5.') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="122a1supfrm124 input-group">
                                                    <input class="fi_line40_initial_presumptions line_40b_check" name="<?php echo base64_encode('B_122A-2-CheckBox14'); ?>" value="2" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox14')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox14'), $mTestA2, '2') : '';?>>
                                                    <label for=""><span style="font-weight:bold;">The line 39d is more than $15,150*.</span> {{ __('On the top of page 1 of this form, check box 2, There is a presumption of abuse. You may fill out Part 4 if you claim special circumstances. Then go to Part 5.') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="122a1supfrm125 input-group">
                                                    <input class="fi_line40_initial_presumptions line_40c_check" name="<?php echo base64_encode('B_122A-2-CheckBox14'); ?>" value="On" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox14')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox14'), $mTestA2, 'On') : '';?>>
                                                    <label for=""><span style="font-weight:bold;">The line 39d is at least $9,075*, but not more than $15,150*.</span> {{ __('Go to line 41.') }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    * Subject to adjustment on 4/01/25, and every 3 years after that for cases filed on or after the date of adjustment.</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-8 d-flex mt-3">
                                        <label for=""> <strong>41.</strong></label>
                                        <div class="row pl-1">
                                            <div class="col-md-12">
                                                <label>
                                                    <span style="font-weight:bold;">{{ __('41a. Fill in the amount of your total nonpriority unsecured debt.') }} </span>  {{ __('If you filled out A') }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <i>{{ __('Summary of Your Assets and Liabilities and Certain Statistical Information Schedules') }}</i><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('(Official Form 106Sum), you may refer to line 3b on that form') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="122a1supfrm126 input-group d-flex mt-4">
                                            <div class="122a1supfrm126 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                            <input  name="<?php echo base64_encode('B_122A-2-undefined_110'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_110')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_110')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line41a_nonpriority_unsecured_debt form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2"></div>

                                    <div class="col-md-8 d-flex mt-3">
                                        <div class="row pl-4">
                                            <div class="col-md-12">
                                                <label>
                                                    <span style="font-weight:bold;">{{ __('41b. 25% of your total nonpriority unsecured debt.') }}</span> {{ __('11 U.S.C. § 707(b)(2)(A)(i)(I).') }}<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    {{ __('Multiply line 41a by 0.25.') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2">
                                        <div class="122a1supfrm127 input-group d-flex border_2px p-2">
                                            <div class="122a1supfrm127 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                            <input name="<?php echo base64_encode('undefined_111B_122A-2-'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('undefined_111B_122A-2-')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('undefined_111B_122A-2-')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line41b_25percent_nonpriority_unsecured_debt form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mt-2 pl-0 pr-0">
                                        <div class="122a1supfrm128 input-group d-flex">
                                            <div class="122a1supfrm128 input-group-append"> <span class="input-group-text" id="basic-addon2">{{ __('Copy here') }}&nbsp;</span><i class='fas fa-arrow-right'></i>&nbsp;&nbsp;&nbsp;</span> </div>
                                            <div class="122a1supfrm128 input-group d-flex border_2px p-2">
                                                <div class="122a1supfrm128 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                                <input name="<?php echo base64_encode('undefined_111B_122A-2-'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('undefined_111B_122A-2-')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('undefined_111B_122A-2-')]) : Helper::priceFormtWithComma('');?>" class="price-field fi_line41b_25percent_nonpriority_unsecured_debt form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex mt-3">
                                        <label for=""> <strong>42.</strong></label>
                                        <div class="row pl-1">
                                            <div class="col-md-9">
                                                <label>
                                                    <span style="font-weight:bold;">{{ __('Determine whether the income you have left over after subtracting all allowed deductions is enough to pay 25% of your unsecured, nonpriority debt.') }}</span><br> Check the box that applies
                                                </label>
                                            </div>
                                            <div class="col-md-3 mt-2"></div>
                                            <div class="col-md-9 mt-2">
                                                <div class="122a1supfrm129 input-group">
                                                    <input class="fi_line42_secondary_presumptions value_41a_check" name="<?php echo base64_encode('B_122A-2-CheckBox15'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox15')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox15'), $mTestA2, 'No') : '';?>>
                                                    <label><span style="font-weight:bold;">{{ __('Line 39d is less than line 41b.') }}</span> {{ __('On the top of page 1 of this form, check box 1,') }} <i>{{ __('There is no presumption of abuse.') }}</i> {{ __('Go to Part 5.') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-2"></div>
                                            <div class="col-md-9 mt-2">
                                                <div class="122a1supfrm129 input-group">
                                                    <input class="fi_line42_secondary_presumptions value_41b_check" name="<?php echo base64_encode('B_122A-2-CheckBox15'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox15')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox15'), $mTestA2, 'Yes') : '';?>>
                                                    <label for=""><span style="font-weight:bold;">{{ __('Line 39d is equal to or more than line 41b.') }}</span> {{ __('On the top of page 1 of this form, check box 2,') }} <i>{{ __('There is no presumption of abuse.') }}</i> {{ __('You may fill out Part 4 if you claim special circumstances. Then go to Part 5.') }}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mt-2"></div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <!-- Part 4 -->
                        <div class="row align-items-center">

                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 4') }}</span>
                                    <h2 class="font-lg-18">{{ __('Give Details About Special Circumstances') }} </h2> </div>
                            </div>
                        </div>
                        <div class="form-border mb-3">

                            <div class="row">
                                <div class="col-md-12 d-flex mt-3">

                                    <label for=""> <strong>43.</strong></label>
                                    <div class="row pl-1">
                                        <div class="col-md-12">

                                            <label>
                                                <span style="font-weight:bold;">{{ __('Do you have any special circumstances that justify additional expenses or adjustments of current monthly income for which there is no
                                                reasonable alternative?') }} </span> {{ __('11 U.S.C. § 707(b)(2)(B).') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1 mt-2">
                                    <div class="122a1supfrm130 input-group pl-4">
                                        <input name="<?php echo base64_encode('B_122A-2-CheckBox16'); ?>" value="No" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox16')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox16'), $mTestA2, 'No') : '';?>>
                                        <label for=""> {{ __('No.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8 mt-2">
                                    <div class="122a1supfrm131 input-group">
                                        <label for=""> {{ __('Go to Part 5.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-3 mt-2"></div>

                                <div class="col-md-1">
                                    <div class="122a1supfrm132 input-group pl-4">
                                        <input name="<?php echo base64_encode('B_122A-2-CheckBox16'); ?>" value="Yes" type="checkbox" <?php echo isset($mTestA2[base64_encode('B_122A-2-CheckBox16')]) ? Helper::validate_key_toggle(base64_encode('B_122A-2-CheckBox16'), $mTestA2, 'Yes') : '';?>>
                                        <label for=""> {{ __('Yes.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="122a1supfrm133 input-group">
                                        <label for=""> {{ __('Fill in the following information. All figures should reflect your average monthly expense or income adjustment for each item. You may include expenses you listed in line 25.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>

                                <div class="col-md-1"></div>
                                <div class="col-md-8">
                                    <div class="122a1supfrm134 input-group mt-3">
                                        <label for=""> {{ __('You must give a detailed explanation of the special circumstances that make the expenses or income
                                        adjustments necessary and reasonable. You must also give your case trustee documentation of your actual
                                        expenses or income adjustments.') }} </label>
                                    </div>
                                </div>
                                <div class="col-md-3"></div>

                                <div class="col-md-1 mt-2"></div>

                                <div class="col-md-8 mt-2">

                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">Give a detailed explanation of the special circumstances<br><br><br></strong>
                                    </div>
                                    <div class="122a1supfrm135 input-group mt-2">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_113'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_113')] ?? '';?>" class="form-control">
                                    </div>
                                    <div class="122a1supfrm136 input-group mt-2">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_115'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_115')] ?? '';?>" class="form-control">
                                    </div>
                                    <div class="122a1supfrm137 input-group mt-2">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_117'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_117')] ?? '';?>" class="form-control">
                                    </div>
                                    <div class="122a1supfrm138 input-group mt-2">
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_119'); ?>" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-undefined_119')] ?? '';?>" class="form-control">
                                    </div>

                                </div>
                                <div class="col-md-2 mt-2 122a1supfrm139">
                                    <div class="gray-box column-heading p-3">
                                        <strong class="d-block">{{ __('Average monthly expense or income adjustment') }}</strong>
                                    </div>
                                    <div class="122a1supfrm140 input-group d-flex mt-2">
                                        <div class="122a1supfrm140 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_114'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_114')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_114')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                    <div class="122a1supfrm141 input-group d-flex mt-2">
                                        <div class="122a1supfrm141 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_116'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_116')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_116')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                    <div class="122a1supfrm142 input-group d-flex mt-2 ">
                                        <div class="122a1supfrm142 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_118'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_118')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_118')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>
                                    <div class="122a1supfrm144 input-group d-flex mt-2">
                                        <div class="122a1supfrm145 input-group-append"> <span class="input-group-text" id="basic-addon2">$</span> </div>
                                        <input name="<?php echo base64_encode('B_122A-2-undefined_120'); ?>" type="text" value="<?php echo isset($mTestA2[base64_encode('B_122A-2-undefined_120')]) ? Helper::priceFormtWithComma($mTestA2[base64_encode('B_122A-2-undefined_120')]) : Helper::priceFormtWithComma('');?>" class="price-field form-control">
                                    </div>

                                </div>
                                <div class="col-md-1 mt-2"></div>
                            </div>
                        </div>

                        <!-- Part 3 1-->

                        <div class="row part2a2 align-items-center">
                            <div class="col-md-12">
                                <div class="part-form-title mb-3"> <span>{{ __('Part 5') }}</span>
                                    <h2 class="font-lg-18">{{ __('Sign Below') }}</h2> </div>
                            </div>
                        </div>
                        <!-- Row 1 -->
                        <div class="form-border">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="122a1supfrm146 input-group d-inline-block">
                                        <label for=""> <strong class="d-block">{{ __('By signing here, I declare under penalty of
                                                perjury that the information on this statement and in any
                                                attachments is true and correct') }}
                                            </strong> </label>
                                    </div>
                                </div>
                                <div class="col-md-12 mt-3">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="122a1supfrm147 input-group signature-field">
                                                <p>{{ __('Signature of Debtor 1') }}</p> <span> <input name="<?php echo base64_encode('B_122A-2-Debtor1.sig'); ?>"  type="text" value="<?php echo $debtor_sign;?>" class="form-control"></span> </div>
                                            <div class="122a1supfrm input-group">
                                                <label>{{ __('Date') }}</label>
                                                <input name="<?php echo base64_encode('B_122A-2-Debtor1.Date signed'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Debtor1.Date signed')] ?? $currentDate;?>" class="date_filed form-control">
                                             </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="122a1supfrm148 input-group signature-field">
                                                <p>{{ __('Signature of Debtor 2') }}</p> <span> <input name="<?php echo base64_encode('B_122A-2-Debtor2.sig'); ?>"  type="text" value="<?php echo $debtor2_sign;?>" class="form-control"></span> </div>
                                            <div class="122a1supfrm149 input-group">
                                                <label>{{ __('Date') }}</label>
                                                <input name="<?php echo base64_encode('B_122A-2-Debtor2.Date signed'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $mTestA2[base64_encode('B_122A-2-Debtor2.Date signed')] ?? $currentDate;?>" class="date_filed form-control">
                                             </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    <x-officialForm.generatePdfButton title="Generate Means Test Calculation(122A-2) PDF" divtitle="official_frm_122a_2"></x-officialForm.generatePdfButton>

                </section>
                </form>
<script>
    $(document).on("keyup", ".non-mortg-9a, .mortgae_price1,.mortgae_price2,.mortgae_price3", function(evt) {
        calculateMortgage();
        calculateMortgagenonMortgage();
		});

        

        calculateMortgage = function(){
            var mortgae_price1 = $(".mortgae_price1").val().replace(/,/g, '');
        var mortgae_price2 = $(".mortgae_price2").val().replace(/,/g, '');
        var mortgae_price3 = $(".mortgae_price3").val().replace(/,/g, '');

        var mortageTotal = 0;
        mortageTotal = parseFloat(mortgae_price1) + parseFloat(mortgae_price2)+ parseFloat(mortgae_price3);
      
			$(".mortgae_price_total").val(mortageTotal.toLocaleString());
            $(".mortgae_price_total_copy").val(mortageTotal.toLocaleString());
            $(".mortgae_price_total").blur();
            $(".mortgae_price_total_copy").blur();
        }

        $(document).on("keyup", ".vehicle_price1,.vehicle_price2", function(evt) {
            calculateVehicle();
		});
        $(document).on("keyup", ".vehicle_price3,.vehicle_price4", function(evt) {
            calculateSecondVehicle();
		});

        $(document).ready(function(){
           
            calculateVehicle();
            calculateMortgage();
            calculateSecondVehicle();
            calculateMortgagenonMortgage();
            calculatetotalfor23();
        });

        calculateVehicle = function(){
            var vehicle_price1 = $(".vehicle_price1").val().replace(/,/g, '');
        var vehicle_price2 = $(".vehicle_price2").val().replace(/,/g, '');

        var vehicle_price_total = 0;
        vehicle_price_total = parseFloat(vehicle_price1) + parseFloat(vehicle_price2);
      
			$(".vehicle_price_total").val(vehicle_price_total.toLocaleString());
            $(".vehicle_price_total_copy").val(vehicle_price_total.toLocaleString());
            $(".vehcile_price_33_b").val(vehicle_price_total.toLocaleString());
            $(".vehicle_price_total").blur();
            $(".vehcile_price_33_b").blur();
            $(".vehicle_price_total_copy").blur();
        }

        calculateSecondVehicle = function(){
            var vehicle_price3 = $(".vehicle_price3").val().replace(/,/g, '');
            var vehicle_price4 = $(".vehicle_price4").val().replace(/,/g, '');
            var vehicle_price_total = 0;
            vehicle_price_total = parseFloat(vehicle_price3) + parseFloat(vehicle_price4);
			$(".vehicle_2_total_price").val(vehicle_price_total.toLocaleString());
            $(".vehicle_2_total_price_copy").val(vehicle_price_total.toLocaleString());
            $(".vehcile_price_33_e").val(vehicle_price_total.toLocaleString());
            $(".vehicle_2_total_price").blur();
            $(".vehcile_price_33_e").blur();
            $(".vehicle_2_total_price_copy").blur();
        }

        calculateMortgagenonMortgage = function()
        {
            var mortgae_price_total_copy =0;
            var non_mortgage = $(".non-mortg-9a").val().replace(/,/g, '');
            mortgae_price_total_copy = $(".mortgae_price_total_copy").val().replace(/,/g, '');
            var fi_line9c_rent_expense = 0;
            fi_line9c_rent_expense = parseFloat(non_mortgage) - parseFloat(mortgae_price_total_copy);
            if(fi_line9c_rent_expense < 0){
                fi_line9c_rent_expense = 0;
            }
            $(".subtract9bfrom9a").val(fi_line9c_rent_expense.toLocaleString());
            $(".subtract9bfrom9a").blur();
            $(".subtract9bfrom9a_copy").val(fi_line9c_rent_expense.toLocaleString());
            $(".subtract9bfrom9a_copy").blur();
        }

        
       

        $(document).on("keyup", ".fi_line6_food_clothing_other_items,.line7_122a2,.line7g_122a2,.fi_line8_operating_expenses,.subtract9bfrom9a_copy,.line10_122a2,.fi_line12_public_transportation_expense,.line13c_122a2,.line13f_122a2,.line14_122a2,.fi_line15_public_transpotation_expense,.line16_122a2,.line17_122a2,.line18_122a2,.line19_122a2,.line20_122a2,.line21_122a2,.line22_122a2,.line23_122a2", function(evt) {
            calculatetotalfor23();
		});
        calculatetotalfor23 = function(){
            var classes = [".fi_line6_food_clothing_other_items",".line7_122a2",".line7g_122a2",".fi_line8_operating_expenses",".subtract9bfrom9a_copy",".line10_122a2",".fi_line12_public_transportation_expense",".line13c_122a2",".line13f_122a2",".line14_122a2",".fi_line15_public_transpotation_expense",".line16_122a2",".line17_122a2",".line18_122a2",".line19_122a2",".line20_122a2",".line21_122a2",".line22_122a2",".line23_122a2"];
            var totaltill23 = 0;
            $.each(classes, function( index, value ) {
                if($(value).val()!=''){
                    totaltill23 = totaltill23+parseFloat($(value).val().replace(/,/g, ''));
                }
            });
            totaltill23 = parseFloat(totaltill23);
            $(".fi_line24_irs_expense").val(totaltill23.toLocaleString());
        }
        
        $(document).ready(function() { 
            set122a1Prices();
            calculatetotalfor32();
            calculatetotalfor33only();
            calculatetotalfor34only();
            calculatetotalfor37();
            calculate13();
            calculatetotalfor38only();
            setTimeout(calculatetotalfor39only,2000);
            calculatetotalfor42only ();

        });
        $(document).on("keyup", ".line13a_122a2, .vehicle_price1, .vehicle_price2, .vehicle_price_total, .line13d_122a2, .vehicle_price3, .vehicle_price4, .vehicle_2_total_price, .vehicle_2_total_price_copy", function(evt) {
            calculate13();
		});
        
        calculate13 = function(){
            var total13c = 0;
            var line13a_122a2 = $(".line13a_122a2").val().replace(/,/g, '');
            var vehicle_price_total = $(".vehicle_price_total").val().replace(/,/g, '');
            total13c = parseFloat(line13a_122a2).toFixed(2) - parseFloat(vehicle_price_total).toFixed(2);
            if(total13c<0){
                total13c = 0;
            }
            $(".line13c_122a2_first").val((total13c.toFixed(2)).toLocaleString());
           var line13c_122a2_first =  $(".line13c_122a2_first").val().replace(/,/g, '');
            $(".line13c_122a2").val((parseFloat(line13c_122a2_first).toFixed(2)).toLocaleString());

            var total13d = 0;
            var line13d_122a2 = $(".line13d_122a2").val().replace(/,/g, '');
            var vehicle_2_total_price = $(".vehicle_2_total_price").val().replace(/,/g, '');
            total13d = parseFloat(line13d_122a2).toFixed(2) - parseFloat(vehicle_2_total_price).toFixed(2);
            if(total13d<0){
                total13d = 0;
            }
            $(".line13f_122a2_first").val((total13d.toFixed(2)).toLocaleString());
           var line13c_122a2_first =  $(".line13f_122a2_first").val().replace(/,/g, '');
            $(".line13f_122a2_copy").val((parseFloat(line13c_122a2_first).toFixed(2)).toLocaleString());
        }

        $(document).on("keyup", ".line25_122a2, .line26_122a2, .line27_122a2, .line28_122a2, .fi_line29_education_expense, .fi_line30_additional_food_and_clothing_expense, .line31_122a2", function(evt) {
            calculatetotalfor32();
		});
        calculatetotalfor32 = function(){
            var classes = [".line25_122a2",".line26_122a2",".line27_122a2",".line28_122a2",".fi_line29_education_expense",".fi_line30_additional_food_and_clothing_expense",".line31_122a2"];
            var totaltill32 = 0;
            $.each(classes, function( index, value ) {
                if($(value).val()!=''){
                    totaltill32 = totaltill32+parseFloat($(value).val().replace(/,/g, ''));
                }
            });
            totaltill32 = parseFloat(totaltill32);
            $(".fi_line32_additional_expense_deductions").val(totaltill32.toLocaleString());
        }

        $(document).on("keyup", ".line33a_122a2, .vehcile_price_33_b, .vehcile_price_33_e, .line33d1_122a2, .line33d2_122a2, .line33d3_122a2 ", function(evt) {
            calculatetotalfor33only();
		});
        calculatetotalfor33only = function(){
            var classes = [".line33a_122a2",".vehcile_price_33_b",".vehcile_price_33_e",".line33d1_122a2",".line33d2_122a2",".line33d3_122a2"];
            var totalof33 = 0;
            $.each(classes, function( index, value ) {
                if($(value).val()!=''){
                    totalof33 = totalof33+parseFloat($(value).val().replace(/,/g, ''));
                }
            });
            totalof33 = parseFloat(totalof33);
            $(".line33e_122a2").val(totalof33.toLocaleString());
        }
        
        $(document).on("keyup", ".line34_1_122a2, .line34_2_122a2, .line34_3_122a2, .line34_cure_1_122a2, .line34_cure_2_122a2, .line34_cure_3_122a2", function(evt) {
            calculatetotalfor34only();
		});
        calculatetotalfor34only = function(){
            var line34_cure_1_122a2 = parseFloat($(".line34_cure_1_122a2").val().replace(/,/g, '')); 
            var line34_cure_2_122a2 = parseFloat($(".line34_cure_2_122a2").val().replace(/,/g, '')); 
            var line34_cure_3_122a2 = parseFloat($(".line34_cure_3_122a2").val().replace(/,/g, '')); 
            var line34_cure_1_122a2_m1 = 0.00;
            if(line34_cure_1_122a2>0){
                line34_cure_1_122a2_m1 = parseFloat(line34_cure_1_122a2/60).toFixed(2);
            }
            $(".line34_1_122a2").val(line34_cure_1_122a2_m1.toLocaleString());
            var line34_cure_2_122a2_m2 = 0.00;
            if(line34_cure_2_122a2>0){
                line34_cure_2_122a2_m2 = parseFloat(line34_cure_2_122a2/60).toFixed(2);
            }
            $(".line34_2_122a2").val(line34_cure_2_122a2_m2.toLocaleString());
            var line34_cure_3_122a2_m3 = 0.00;
            if(line34_cure_3_122a2>0){
                line34_cure_3_122a2_m3 = parseFloat(line34_cure_3_122a2/60).toFixed(2);
            }
            $(".line34_3_122a2").val(line34_cure_3_122a2_m3.toLocaleString());
           
            var classes = [".line34_1_122a2",".line34_2_122a2",".line34_3_122a2"];
            var totalof34 = 0;
            $.each(classes, function( index, value ) {
                if($(value).val()!=''){
                    totalof34 = totalof34+parseFloat($(value).val().replace(/,/g, ''));
                }
            });
            totalof34 = parseFloat(totalof34);
            $(".line34_total_122a2").val(totalof34.toLocaleString());
        }
        
        $(document).on("keyup", ".line33e_122a2, .line34_1_122a2,.line34_2_122a2,.line34_3_122a2, .line35_122a2, .line36_122a2,.line36_122a2_copy", function(evt) {
            calculatetotalfor37();
		});
        calculatetotalfor37 = function(){
            var line36_122a2 = $(".line36_122a2").val().replace(/,/g, '');
            $(".line36_122a2_copy").val((parseFloat(line36_122a2)).toLocaleString());
            var classes = [".line33e_122a2",".line34_1_122a2",".line34_2_122a2",".line34_3_122a2",".line35_122a2",".line36_122a2"];
            var totaltill37 = 0;
            $.each(classes, function( index, value ) {
                if($(value).val()!=''){
                    totaltill37 = totaltill37+parseFloat($(value).val().replace(/,/g, ''));
                }
            });
            totaltill37 = parseFloat(totaltill37);
            $(".fi_line37_deduction_for_debt_payment").val(totaltill37.toLocaleString());
        }

        $(document).on("keyup", ".fi_line24_irs_expense, .fi_line32_additional_expense_deductions, .fi_line37_deduction_for_debt_payment", function(evt) {
            calculatetotalfor38only();
		});
        calculatetotalfor38only = function(){
            var classes = [".fi_line24_irs_expense",".fi_line32_additional_expense_deductions",".fi_line37_deduction_for_debt_payment"];
            var totalof38only = 0;
            $.each(classes, function( index, value ) {
                if($(value).val()!=''){
                    totalof38only = totalof38only+parseFloat($(value).val().replace(/,/g, ''));
                }
            });
            totalof38only = parseFloat(totalof38only);
            $(".fi_line38_deduction_for_income").val(totalof38only.toLocaleString());
        }

        $(document).on("keyup", ".adjusting_current_mnthly_income, .fi_line38_deduction_for_income", function(evt) {
            calculatetotalfor39only();
		});
        calculatetotalfor39only = function(){
            var value39a = parseFloat($(".adjusting_current_mnthly_income").val().replace(/,/g, ''));
            var value39b = parseFloat($(".fi_line38_deduction_for_income").val().replace(/,/g, ''));
            var value39c = 0;
            var value39d = 0;
            var value39c = value39a-value39b;
            var value39d = value39c*60;
            value39c = parseFloat(value39c);
            $(".fi_line39c_monthly_disposable_income").val(value39c.toLocaleString());
            $(".fi_line39d_60month_disposable_income").val(value39d.toLocaleString());
            if(value39d < 9075){$('.line_40a_check').prop('checked', true);$('.line_40b_check').prop('checked', false);$('.line_40c_check').prop('checked', false);}
            if(value39d > 15150){$('.line_40b_check').prop('checked', true);$('.line_40a_check').prop('checked', false);$('.line_40c_check').prop('checked', false);}
            if(value39d > 9075 && value39d < 15150){$('.line_40c_check').prop('checked', true);$('.line_40a_check').prop('checked', false);$('.line_40b_check').prop('checked', false);}
        }
           
        $(document).on("keyup", ".fi_line39d_60month_disposable_income, .fi_line41a_nonpriority_unsecured_debt, .fi_line41b_25percent_nonpriority_unsecured_debt", function(evt) {
            calculatetotalfor42only ();
		});
        calculatetotalfor42only  = function(){
            var value39d = parseFloat($(".fi_line39d_60month_disposable_income").val().replace(/,/g, ''));
            var value41b = parseFloat($(".fi_line41b_25percent_nonpriority_unsecured_debt").val().replace(/,/g, ''));
            if(value39d < value41b){$('.value_41a_check').prop('checked', true);$('.value_41b_check').prop('checked', false);}
            if(value39d >= value41b){$('.value_41b_check').prop('checked', true);$('.value_41a_check').prop('checked', false);}
        }
           
</script>