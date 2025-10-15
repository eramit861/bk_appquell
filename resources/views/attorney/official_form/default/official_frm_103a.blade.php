<form name="official_frm_103a" class="save_official_forms" id="official_frm_103a" action="{{route('generate_official_pdf')}}" method="post">
@csrf
<input type="hidden" name="form_id" value="103a">
<input type="hidden" name="client_id" value="<?php echo $client_id;?>">
<input type="hidden" name="sourcePDFName" value="<?php echo 'form_103a.pdf'; ?>">
<input type="hidden" name="clientPDFName" value="<?php echo $client_id.'_103a.pdf'; ?>">
<input type="hidden" name="<?php echo base64_encode('Case number'); ?>" value="<?php echo $caseno; ?>">
<input type="hidden" name="<?php echo base64_encode('Debtor 1'); ?>" value="<?php echo $onlyDebtor; ?>">
<input type="hidden" name="<?php echo base64_encode('caseNoTextBox'); ?>" value="<?php echo $caseno; ?>">
<input type="hidden" name="<?php echo base64_encode('Debtor 2'); ?>" value="<?php echo $spousename; ?>">
<section class="page-section official-form-103a padd-20" id="official-form-103a">
<div class="container pl-2 pr-0">
    <div class="row">
        <div class="frm103a col-md-7">
            <div class="frm103a section-box">
                <div class="frm103a section-header bg-back text-white">
                    <p class="frm103a font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>
                <div class="frm103a section-body padd-20">
                    <div class="row">


                        <div class="frm103a col-md-12">
                            <div class="frm103a input-group">
                                <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                <select class=" form-control frm103a district-select" name="<?php echo base64_encode('Bankruptcy District Information'); ?>" id="district_name"> @foreach ($district_names as $district_name)
                                        <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>

                            </div></div></div></div></div></div>

        <div class="103a col-md-5">
            <div class="amended">
                <input type="checkbox" name="<?php echo base64_encode('Check if this is an amended filing');?>" value="On">
                <label>{{ __('Check if this is an amended filing') }}</label>
            </div>
        </div>
    </div>
    <div class="row padd-20">
        <div class="col-md-12 mb-3">
            <div class="form-title">
            <h4>{{ __('Official Form 103A') }}</h4>
                        <!-- <h4>{{ __('Official Form 106Sum') }} </h4> -->
                        <h2 class="font-lg-22">{{ __('Application for Individuals to Pay the Filing Fee in Installments') }}
                    </h2> </div>
                </div>
                <div class="col-md-12">
                    <div class="form-subheading">
                        <p class="font-lg-14">{{ __('Be as complete and accurate as possible. If two married people are filing together, both are equally responsible for supplying correct information.') }}  </p>
                    </div>
                </div>
            </div>
            <!-- Part 1 -->
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                        <h2 class="font-lg-18">{{ __('Specify Your Proposed Payment Timetable') }}</h2> </div>
                </div>
            </div>
            <div class="form-border mb-3">
                <div class="row">
                    <div class="col-md-5 d-flex">
                        <strong>1.</strong>
                        <strong>&nbsp;{{ __('Which chapter of the Bankruptcy Code are you choosing to file under?') }}</strong>
                    </div>
                    <div class="col-md-7">
                        <div class="input-group">
                            <input type="checkbox" name="<?php echo base64_encode('Filing Chapter1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter7'); ?> value="7">
                            <label>{{ __('Chapter 7') }}</label><br>
                            <input type="checkbox" name="<?php echo base64_encode('Filing Chapter1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter11'); ?> value="11">
                            <label>{{ __('Chapter 11') }}</label><br>
                            <input type="checkbox" name="<?php echo base64_encode('Filing Chapter1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter12'); ?> value="12">
                            <label>{{ __('Chapter 12') }}</label><br>
                            <input type="checkbox" name="<?php echo base64_encode('Filing Chapter1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter13'); ?> value="13">
                            <label>{{ __('Chapter 13') }}</label>
                        </div>
                    </div>

                    <div class="col-md-4 mt-3">
                        <div class="d-flex">
                            <strong>2.</strong>
                            <strong>
                            &nbsp;{{ __('You may apply to pay the filing fee in up to four installments. Fill in the amounts you propose to pay and the dates you plan to pay them. Be sure all dates are business days. Then add the payments you propose to pay.') }}
                            </strong>
                        </div>
                        <p class="mt-3" style="padding-left: 10px;">
                            {{ __('You must propose to pay the entire fee no later than 120 days after you file this bankruptcy case. If the court approves your application, the court will set your final payment timetable.') }}
                        </p>
                    </div>
                    <div class="col-md-8 mt-3">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <p style="border-bottom: 2px solid black;" >
                                        <strong>{{ __('You propose to pay…') }}</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-8"></div>
                            <div class="col-md-4 frm103a3">
                                <div class="input-group d-flex frm103a3">
                                    <div class="input-group-append frm103a3"> 
                                        <span class="input-group-text " id="basic-addon2">$</span>
                                    </div>
                                    <p>
                                        <input name="<?php echo base64_encode('Application.Fee.Amt.Install.1.pay 1');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <input type="checkbox" name="<?php echo base64_encode('Application.Fee.Amt.1st.When');?>" value="WithPetition">
                                <label>{{ __('With the filing of the petition') }}</label><br>
                                <input type="checkbox" name="<?php echo base64_encode('Application.Fee.Amt.1st.When');?>" value="OtherDate">
                                <label>{{ __('On or before this date') }}</label>
                            </div>
                            <div class="col-md-4">
                                <input name="<?php echo base64_encode('Application.Fee.Amt.1st.Date.date 1'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                            </div>
                            <div class="col-md-4">
                                <div class="input-group d-flex frm103a1">
                                    <div class="input-group-append frm103a2"> 
                                        <span class="input-group-text " id="basic-addon2">$</span>
                                    </div>
                                    <p>
                                        <input name="<?php echo base64_encode('Application.Fee.Amt.Install.2.pay 2');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 103a1">
                                <div class="103a1 input-group horizontal_dotted_line">
                                    <label>{{ __('On or before this date') }}</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input name="<?php echo base64_encode('Application.Fee.Amt.2nd.Date.date 2'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                            </div>
                            <div class="col-md-4 frm103a2">
                                <div class="input-group d-flex frm103a2">
                                    <div class="input-group-append frm103a2"> 
                                        <span class="input-group-text " id="basic-addon2">$</span>
                                    </div>
                                    <p>
                                        <input name="<?php echo base64_encode('Application.Fee.Amt.Install.3.pay 3');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4 103a2">
                                <div class="input-group 103a2 horizontal_dotted_line">
                                    <label>{{ __('On or before this date') }}</label>
                                </div>
                            </div>
                            <div class="col-md-4 103a3">
                                <input name="<?php echo base64_encode('Application.Fee.Amt.3rd.Date.date 3'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <p style="text-align: right; font-size:large;">+</p>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group d-flex">
                                            <div class="input-group-append"> 
                                                <span class="input-group-text " id="basic-addon2">$</span>
                                            </div>
                                            <p>
                                                <input name="<?php echo base64_encode('Application.Fee.Amt.Install.4.pay 4');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pasrt21212">
                                        <div class="input-group pasrt21212 horizontal_dotted_line">
                                            <label>{{ __('On or before this date') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 pasrt21212">
                                        <input name="<?php echo base64_encode('Application.Fee.Amt.4th.Date.date 4'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <p style="text-align: right; font-weight: bold;">{{ __('Total') }}</p>
                                </div>
                            <div class="col-md-8 103a12">
                                <div class="row">
                                    <div class="col-md-4 103a12" style="border: 2px solid black; padding-top: 5px;">
                                        <div class="input-group d-flex 103a12">
                                            <div class="input-group-append 103a12"> 
                                                <span class="input-group-text " id="basic-addon2">$</span>
                                            </div>
                                            <p>
                                                <input name="<?php echo base64_encode('Application.Fee.Amt.Ttl.pay total');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-8" style="margin-top: 5px;">
                                        <label>{{ __('◄ Your total must equal the entire fee for the chapter you checked in line 1.') }}</label>
                                    </div>
                                </div>
                                
                            </div></div>
                    </div> </div>
            </div>
            <!-- Part 2 -->
            <div class="row p122a2 align-items-center">
                <div class="col-md-12 p122a2">
                    <div class="p122a2 part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                        <h2 class="p122a2 font-lg-18">{{ __('Sign Below') }}</h2> </div>
                </div>
            </div>
            <div class="form-border mb-3 p122a2">
            <div class="row align-items-center p122a2">
                <div class="col-md-12 p122a2">
                    <strong>
                        {{ __('By signing here, you state that you are unable to pay the full filing fee at once, that you want to pay the fee in installments, and that you understand that:') }}
                    </strong>
                    <ul>
                        <li class="mt-2">
                            {{ __('You must pay your entire filing fee before you make any more payments or transfer any more property to an attorney, bankruptcy petition
                            preparer, or anyone else for services in connection with your bankruptcy case.') }}
                        </li>
                        <li class="mt-2">
                            {{ __('You must pay the entire fee no later than 120 days after you first file for bankruptcy, unless the court later extends your deadline. Your
                            debts will not be discharged until your entire fee is paid.') }}
                        </li>
                        <li class="mt-2">
                            {{ __('If you do not make any payment when it is due, your bankruptcy case may be dismissed, and your rights in other bankruptcy proceedings
                            may be affected.') }}
                        </li>
                    </ul>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-md-4">
                            <input name="<?php echo base64_encode('Debtor Sig.1');?>" id=""  type="text" value="<?php echo $debtor_sign;?>" class="form-control">
                            <label>{{ __('Signature of Debtor 1') }}</label>
                        </div>
                        <div class="col-md-4">
                            <input name="<?php echo base64_encode('Debtor Sig.2');?>" id=""  type="text" value="<?php echo $debtor2_sign;?>" class="form-control">
                            <label>{{ __('Signature of Debtor 2') }}</label>
                        </div>
                        <div class="col-md-4">
                            <input name="<?php echo base64_encode('Debtor attorney Sig.1');?>" id=""  type="text" value="<?php echo $attorny_sign;?>" class="form-control">
                            <label>{{ __('Your attorney’s name and signature, if you used one') }} </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <div class="row">
                        <div class="col-md-4 d-flex date1">
                            <label>{{ __('Date:') }}</label>
                            <input name="<?php echo base64_encode('Debtor date.1'); ?>" value="<?php echo $currentDate?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                        </div>
                        <div class="col-md-4 d-flex date2">
                            <label>{{ __('Date:') }}</label>
                            <input name="<?php echo base64_encode('Debtor date.2'); ?>" value="<?php echo $currentDate?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                        </div>
                        <div class="col-md-4 d-flex date3">
                            <label>{{ __('Date:') }}</label>
                            <input name="<?php echo base64_encode('Debtor attorney date.1'); ?>" value="<?php echo $currentDate?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                        </div>
                    </div>
                </div>
                <style> li{list-style: square !important;}</style>
            </div>
        </div>
        <div class="row" style="margin-top:3rem;">
            <div class="col-md-7">
                <div class="section-box">
                    <div class="frm103a section-header bg-back text-white">
                        <p class="frm103a font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                    </div>
                    <div class="frm103a section-body padd-20">
                        <div class="row">
                            <div class="frm103a col-md-12">
                                <label>{{ __('United States Bankruptcy Court for the:') }}</label>
                            </div>
                            <div class="col-md-12">
                                <div class="frm103a input-group">
                                    <select class="frm103a form-control district-select" name="<?php echo base64_encode('districtTextBox');?>" id="district_name"> @foreach ($district_names as $district_name)
                                        <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>
                                </div>
                            </div>
                            <div class="frm103a col-md-12">
                                <div class="frm103a input-group">
                                    <label>{{ __('Chapter you are filing under:') }}</label>
                                    <div class="checkbox-cust">
                                        <input class="chapter7" name="<?php echo base64_encode('Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter7'); ?> value="Chapter 7" type="checkbox">
                                        <label>Chapter 7</label>
                                    </div>
                                    <div class="frm103a checkbox-cust">
                                        <input class="chapter11" type="checkbox" name="<?php echo base64_encode('Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter11'); ?> value="Chapter 11">
                                        <label>Chapter 11</label>
                                    </div>
                                    <div class="frm103a checkbox-cust">
                                        <input class="chapter12" type="checkbox" name="<?php echo base64_encode('Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter12'); ?> value="Chapter 12">
                                        <label>Chapter 12</label>
                                    </div>
                                    <div class="frm103a checkbox-cust">
                                        <input  class="chapter13" type="checkbox" name="<?php echo base64_encode('Check Box1');?>" <?php echo Helper::validate_key_toggle('editor_chepter', $savedData, 'chapter13'); ?> value="Chapter 13">
                                        <label>{{ __('Chapter 13') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5"></div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="form-title">
                    <h2 class="font-lg-22">{{ __('Order Approving Payment of Filing Fee in Installments') }}</h2> 
                </div>
            </div>
            <div class="col-md-12 mt-3">
                <p>{{ __('Be as complete and accurate as possible. If two married people are filing together, both are equally responsible for supplying correct information.') }}  </p>
            </div>
            <div class="col-md-12">
                <div class="input-group">
                    <input type="checkbox" name="<?php echo base64_encode('CheckBox2');?>" value="YES">
                    <label>{{ __('The debtor(s) may pay the filing fee in installments on the terms proposed in the application.') }}</label><br>
                    <input type="checkbox" name="<?php echo base64_encode('CheckBox1');?>" value="YES">
                    <label>{{ __('The debtor(s) must pay the filing fee according to the following terms:') }}</label>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3"></div>
            <div class="col-md-3">
                <div class="input-group">
                    <p style="border-bottom: 2px solid black;">
                        <strong >{{ __('You must pay…') }}</strong>
                    </p>                                    
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <p style="border-bottom: 2px solid black;">
                        <strong>{{ __('On or before this date…') }}</strong>
                    </p>
                </div>
            </div>
            <div class="col-md-3 103a13"></div>

            <div class="col-md-3 103a13"></div>
            <div class="col-md-3 103a13">
                <div class="input-group 103a13 text-center">
                    <div class="103a13 input-group-append"> 
                        <span class="103a13 input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="<?php echo base64_encode('Application.Fee.Amt.Install.1.pay 5');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="103a13 price-field form-control" placeholder="$">
                        </p>
                    </div>                                      
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="<?php echo base64_encode('Application.Fee.Amt.1st.Date.date 5'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="col-md-3 103a14"></div>

            <div class="col-md-3 103a14"></div>
            <div class="col-md-3 103a14">
                <div class="input-group 103a14 text-center">
                    <div class="input-group-append 103a14"> 
                        <span class="input-group-text 103a14" id="basic-addon2">$</span>
                        <p>
                            <input name="<?php echo base64_encode('Application.Fee.Amt.Install.2.pay 6');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                        </p>
                    </div>                                      
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="<?php echo base64_encode('Application.Fee.Amt.2nd.Date.date 6'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="103a15 col-md-3"></div>

            <div class="col-md-3 103a15"></div>
            <div class="col-md-3 103a15">
                <div class="103a15 input-group text-center">
                    <div class="103a15 input-group-append"> 
                        <span class="103a15 input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="<?php echo base64_encode('Application.Fee.Amt.Install.3.pay 7');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control 103a15" placeholder="$">
                        </p>
                    </div>                                      
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="<?php echo base64_encode('Application.Fee.Amt.3rd.Date.date 7'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="col-md-3"></div>

            <div class="col-md-3">
                <p style="text-align: right; font-size:large;">+</p>
            </div>
            <div class="col-md-3">
                <div class="103a15 input-group text-center">
                    <div class="103a15 input-group-append"> 
                        <span class="input-group-text 103a15" id="basic-addon2">$</span>
                        <p>
                            <input name="<?php echo base64_encode('Application.Fee.Amt.Install.4.pay 8');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                        </p>
                    </div>                                      
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group 103a15">
                    <input name="<?php echo base64_encode('Application.Fee.Amt.4th.Date.date 8'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="col-md-3"></div>

            <div class="col-md-3 103a15">
                <p style="text-align: right; font-weight: bold;">{{ __('Total') }}</p>
            </div>
            <div class="col-md-3">
                <div class="input-group 103a15 text-center">
                    <div class="input-group-append 103a15" style="border: 2px solid black;"> 
                        <span class="input-group-text " id="basic-addon2">$</span>
                        <p>
                            <input name="<?php echo base64_encode('Application.Fee.Amt.Ttl.pay total 2');?>" id=""  type="text" value="<?php echo Helper::priceFormtWithComma('');?>" class="price-field form-control" placeholder="$">
                        </p>
                    </div>                                      
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group text-center">
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>

        <div class="col-md-12 mt-3">
            <p>
                {{ __('Until the filing fee is paid in full, the debtor(s) must not make any additional payment or transfer any 
                additional property to an attorney or to anyone else for services in connection with this case.') }}
            </p>
        </div>

        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <input name="<?php echo base64_encode('Judge date.0'); ?>" value="" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
                </div>
            </div>
            <div class="col-md-2">
                <p style="text-align: right; font-weight: bold;">{{ __('By the court:') }}</p>
            </div>
            <div class="col-md-5">
                <input name="<?php echo base64_encode('Judge Sig.0');?>" id=""  type="text" value="" class="form-control">
                <label>{{ __('United States Bankruptcy Judge') }}</label>
            </div>
        </div>

        <x-officialForm.generatePdfButton title="Generate PDF" divtitle="official_frm_103a"></x-officialForm.generatePdfButton>
    </div>
    </section>
</form>
				