
<div class="row">
   
    <div class="container">
        <div class="row">
            <div class="district88 col-md-10">
                <div class="frm88 section-box">
                    <div class="frm88 section-header bg-back text-white">
                        <p class="frm88 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                    </div>
                    <div class="frm88 section-body padd-20">
                        <div class="row">


                            <div class="district88 col-md-12">
                                <div class="frm88 input-group">
                                    <label class="frm88" style="font-weight: bold;">{{ __('UNITED STATES BSNKRUPTCY COURT DISTRICT OF COLORADO') }}</label>
                                </div>
                            </div>
                            <div class="district88 col-md-12 pt-2">
                                <div class="row">
                                    <div class="district88 col-md-2">
                                        <label>{{ __('Debtor 1:') }}</label>
                                    </div>
                                    <div class="district88 col-md-5">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('TextBox0'); ?>" value="<?php echo $onlyDebtor; ?>"  placeholder="" type="text" class=" form-control">
                                            <div class="row">
                                                <div class="district88 col-md-4"><label>{{ __('First Name') }}</label></div>
                                                <div class="district88 col-md-4"><label>{{ __('Middle Name') }}</label></div>
                                                <div class="district88 col-md-4"><label>{{ __('Last Name') }} </label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="district88 col-md-2">
                                        <label>{{ __('Case #:') }}</label>
                                    </div>
                                    <div class="district88 col-md-3">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                                        </div>
                                    </div>

                                    <div class="district88 col-md-2 pt-2">
                                        <label>{{ __('Debtor 2:') }}</label>
                                    </div>
                                    <div class="district88 col-md-5 pt-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo $spousename; ?>"  placeholder="" type="text" class=" form-control">
                                            <div class="row">
                                                <div class="district88 col-md-4"><label>{{ __('First Name') }}</label></div>
                                                <div class="district88 col-md-4"><label>{{ __('Middle Name') }}</label></div>
                                                <div class="district88 col-md-4"><label>{{ __('Last Name') }} </label></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="district88 col-md-2 pt-2">
                                        <label>{{ __('Chapter:') }}</label>
                                    </div>
                                    <div class="district88 col-md-3 pt-2">
                                        <div class="input-group">
                                            <input name="<?php echo base64_encode('TextBox3'); ?>" value="<?php echo $chapterName; ?>"  placeholder="" type="text" class=" form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="district88 col-md-2"></div>
        </div>
        
        <div class="row padd-20">
            <div class="district88 col-md-12 mb-3">
                <div class="form-title">
                    <h4>{{ __('Local Bankruptcy Form 1007-6.1') }}</h4>
                    <h2 class="font-lg-22">{{ __('Statement Under Penalty of Perjury Concerning Payment Advices') }}</h2>
                </div>
            </div>
            <div class="district88 col-md-12">
                <div class="form-subheading">
                    <p class="font-lg-14">
                        {{ __('Complete the applicable sections and check the applicable boxes.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-center">
        <div class="district88 col-md-12">
            <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                <h2 class="font-lg-18">{{ __('Statement') }}</h2>
            </div>
        </div>
    </div>

    <div class="district88 col-md-12 form-border">
        <div class="row pt-3 pb-3">
            <div class="district88 col-md-12">
                <p>
                    I,
                    <input name="<?php echo base64_encode('TextBox4'); ?>" value="<?php echo $onlyDebtor; ?>"  placeholder="" type="text" class=" form-control" style="width: 40%;">
                    <strong>
                        {{ __('[name]') }}
                        <sup>1</sup>
                    </strong>
                    {{ __(', states as follows:') }}
                </p>
                <p>
                    {{ __('I did not file with the court copies of some or all payment advices or other evidence of payment received within 60 days 
                    before the date of the filing of the petition from any employer because:') }} 
                </p>
            </div>

            <div class="district88 col-md-12">
                <div class="row">
                 
                    <div class="district88 col-md-12">
                    <div class="input-group">
                    <input name="<?php echo base64_encode('CheckBox0'); ?>" value="YES" type="checkbox">
                       
                    <label>
                            I was not employed during the period immediately preceding the filing of the above-referenced case
                            <input name="<?php echo base64_encode('TextBox5'); ?>" value=""  placeholder="" type="text" class=" form-control">
                            <strong>
                                {{ __('[insert the dates you were not employed].') }}
                            </strong>
                    </label>
                        </div>
                    </div>
                  
                    <div class="district88 col-md-12">
                    <div class="input-group">
                        <input name="<?php echo base64_encode('CheckBox1'); ?>" value="YES" type="checkbox">
                        
                        <label>
                            {{ __('I was employed during the period immediately preceding the filing of the above referenced case but did not 
                            receive any payment advices or other evidence of payment from my employer within 60 days before the date of 
                            the filing of the petition.') }} 
                    </label>
                    </div>
                    </div>
                 
                    <div class="district88 col-md-12">
                    <div class="input-group">
                            <input name="<?php echo base64_encode('CheckBox2'); ?>" value="YES" type="checkbox">
                        
                        <label>
                            {{ __('I am self-employed and do not receive any evidence of payment from an employer.') }}
                    </label>
                    </div></div>
                   
                    <div class="district88 col-md-12">
                        <div class="input-group">
                            <label>
                                {{ __('Other:') }}
                            </label>
                            <input name="<?php echo base64_encode('TextBox6'); ?>" value=""  placeholder="" type="text" class=" form-control" style="width:90%;">
                            <br>
                            <strong>
                                {{ __('[please provide explanation].') }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row align-items-center mt-3">
        <div class="district88 col-md-12">
            <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                <h2 class="font-lg-18">{{ __('Verification of Debtor') }}</h2>
            </div>
        </div>
    </div>
    <div class="district88 col-md-12 form-border">
        <div class="row pt-3 pb-3">
            <div class="district88 col-md-12">
                <div class="row">
                    <div class="district88 col-md-12">
                        <p>
                            {{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}
                        </p>
                    </div>
                    
                </div>
            </div>
            
            <div class="district88 col-md-12">
                <div class="row">
                    <div class="district88 col-md-4">
                        <div class="input-group d-flex">
                            <label for="">{{ __('Dated:') }}</label>
                            <input name="<?php echo base64_encode('TextBox7'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                        </div>
                    </div>
                    <div class="district88 col-md-2"></div>
                    <div class="district88 col-md-6">
                        <div class="row">
                            <div class="district88 col-md-2">
                                <label for="">By:</label>
                            </div>
                            <div class="district88 col-md-10">
                                <input name="<?php echo base64_encode('TextBox8'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
                                <label>{{ __('Signature of Debtor') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="district88 col-md-12 mt-2">
                <div class="row">
                    <div class="district88 col-md-6"></div>
                    <div class="district88 col-md-6">
                        <div class="row">
                            <div class="district88 col-md-3">
                                <label for="">{{ __('Mailing Address:') }}</label>
                            </div>
                            <div class="district88 col-md-9">
                                <input name="<?php echo base64_encode('TextBox9'); ?>" value="{{$debtoraddress}}, {{$debtorCity}} {{$debtorState}}, {{$debtorzip}}" type="text" class="form-control">
                            </div>

                            <div class="district88 col-md-3">
                                <label for="">{{ __('Telephone number:') }}</label>
                            </div>
                            <div class="district88 col-md-9">
                                <input name="<?php echo base64_encode('TextBox10'); ?>" value="{{$debtorPhoneHome}}" type="text" class="form-control">
                            </div>

                            <div class="district88 col-md-3">
                                <label for="">{{ __('Facsimile number:') }}</label>
                            </div>
                            <div class="district88 col-md-9">
                                <input name="<?php echo base64_encode('TextBox11'); ?>" value="" type="text" class="form-control">
                            </div>

                            <div class="district88 col-md-3">
                                <label for="">{{ __('E-mail address:') }}</label>
                            </div>
                            <div class="district88 col-md-9">
                                <input name="<?php echo base64_encode('TextBox12'); ?>" value="" type="text" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>
            </div>               


        </div>
    </div>

    <div class="district88 col-md-12 mt-3">
         
    </div>

</div>
