<div class="row">

    <div class="district78 col-md-12">
        <div class="row">
            <div class="district78 col-md-12 text-center">
               <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF ALASKA') }}</h2> 
            </div>      
        </div>
    </div>
    <div class="district78 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district78 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox0'); ?>>" value="" class="form-control" rows="6" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district78 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district78 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district78 col-md-9">
                        <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district78 col-md-3">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="district78 col-md-9">
                        <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo $chapterName; ?>"  placeholder="" type="text" class=" form-control">
                    </div>

                    <div class="district78 col-md-12 mt-3 pt-3 pb-3 text-center" style="border-top:1px solid #000; font-weight: bold;">
                        <label style="">
                        {{ __('STATEMENT UNDER PENALTY OF PERJURY') }} <br>
                            {{ __('CONCERNING PAYMENT ADVICE DUE') }}<br>
                            {{ __('PURSUANT TO 11 U.S.C. § 521(a)(1)(B)(iv)') }} </label>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="district78 col-md-12 mt-3">
        <div class="row">
            <div class="district78 col-md-12">
                <p>
                    <?php echo $nbsp_10; ?>
                    I,
                    <input name="<?php echo base64_encode('TextBox3'); ?>" value="<?php echo $onlyDebtor; ?>"  placeholder="" type="text" class=" form-control" style="width: 40%;">
                    {{ __(', states as follows:') }}
                </p>
                <p>
                    <?php echo $nbsp_10; ?>
                    {{ __('I have not filed with the court copies of all payment advices or other evidence of payment 
                    received within 60 days prior to the filing of my petition from any employer because:') }}
                </p>
            </div>

            <div class="district78 col-md-12">
                <div class="row">
                    <div class="district78 col-md-12">
                        <div class="input-group">
                            <input name="<?php echo base64_encode('CheckBox0'); ?>" value="YES" type="checkbox">
                            <label>{{ __('I am self employed and did not receive any payments from an employer within the 60 day
                            period before the filing of my petition;') }} </label>
                        </div>
                    </div>
                   
                    <div class="district78 col-md-12">
                        <div class="input-group">
                            <input name="<?php echo base64_encode('CheckBox1'); ?>" value="YES" type="checkbox">
                            <label>
                            {{ __('My only income during the 60 day period before the filing of my petition was from
                            Social Security, pensions, or disability payments, or from rental or investment income.') }} 
                            </label>
                        </div>
                    </div>
                
                    <div class="district78 col-md-12">
                        <div class="input-group">
                            <input name="<?php echo base64_encode('CheckBox2'); ?>" value="YES" type="checkbox">
                            <label>
                            {{ __('I was not employed during the 60 day period immediately preceding the filing of my 
                            petition.') }} 
                            </label>
                        </div>
                    </div>
                   
                    <div class="district78 col-md-12">
                        <div class="input-group">
                            <input name="<?php echo base64_encode('CheckBox3'); ?>" value="YES" type="checkbox">
                            <label>
                            {{ __('Other. Specify:') }}
                            </label>
                        </div>
                    </div>
                   
                    <div class="district78 col-md-1">
                        <div class="input-group">
                        </div>
                    </div>
                    <div class="district78 col-md-11">
                        <p>
                            <textarea name="<?php echo base64_encode('TextBox4'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"></textarea>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="district78 col-md-12">
                <p>
                    <?php echo $nbsp_10; ?>
                    {{ __('I declare, under penalty of perjury under the laws of the United States of America that the foregoing is true and correct') }}
                </p>
            </div>
            
        </div>
    </div>
    
    <div class="district78 col-md-2">
        <div class="input-group">
            <label>{{ __('Executed on:') }}</label>
        </div>
    </div>

    <div class="district78 col-md-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox5'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('Date') }}</label>
        </div>
    </div>
    <div class="district78 col-md-3"></div>
    <div class="district78 col-md-4">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('TextBox6'); ?>" value="<?php echo $debtor_sign; ?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Debtor') }}</label>
        </div>
    </div>
    

    <div class="district78 col-md-12 mt-3">
         
    </div>
</div>
