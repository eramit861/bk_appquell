<input type="hidden" name="<?php echo base64_encode('Debtor 1')?>" value="{{$onlyDebtor}}">
<input type="hidden" name="<?php echo base64_encode('Debtor 2')?>" value="{{$spousename}}">
<input type="hidden" name="<?php echo base64_encode('Case number')?>" value="{{$caseno}}">

<div class="container">
    <div class="row">
        <div class="col-md-7 frm85">
            <div class="section-box frm85">
                <div class="section-header bg-back text-white">
                    <p class="frm85 font-lg-20">{{ __('Fill in this information to identify your case') }}</p>
                </div>
                <div class="section-body frm85 padd-20">
                    <div class="row frm85">
                        <div class="col-md-12">
                            <div class="input-group frm85">
                                <label>{{ __('United States Bankruptcy Court for the') }}</label>
                                <select name="<?php echo base64_encode('Bankruptcy District Information-122a-1supp'); ?>" class="form-control frm85 district-select" id="district_name"> @foreach ($district_names as $district_name)
                                    <option <?php echo Helper::validate_key_option('district_attorney', $savedData, $district_name->district_name); ?> value="{{$district_name->district_name}}" class="form-control">{{$district_name->district_name}}</option> @endforeach </select>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5 frm85">
            <div class="amended frm85">
                <input name="<?php echo base64_encode('Check if this is an'); ?>" value="On" type="checkbox" name="<?php echo base64_encode('CheckBox1-122a-1supp');?>">
                <label>{{ __('Check if this is an amended filing') }}</label>
                </div>
            </div>
    </div>

    <div class="row padd-20">
        <div class="col-md-12 mb-3">
            <div class="form-title">
                <h4>{{ __('Official Form 103A') }}</h4>
                <!-- <h4>{{ __('Official Form 122A─1Supp') }} </h4> -->
                <h2 class="font-lg-22">{{ __('Application for Individuals to Pay the Filing Fee in Installments') }}
    </h2> </div>
        </div>
        <div class="col-md-12">
            <div class="form-subheading">
                <div class="input-group"> <strong>
                {{ __('Be as complete and accurate as possible. If two married people are filing together, both are equally responsible for supplying correct information.') }}
        </strong> </div>
            </div>
        </div>
    </div>
    <!-- Part 1 -->
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="part-form-title mb-3"> <span>{{ __('Part 1') }}</span>
                <h2 class="font-lg-18">{{ __('Select Your Chapter') }}</h2> </div>
        </div>
    </div>
    <!-- Row 1 -->
    <div class="form-border mb-3">
       <div class="row">
        <div class="col-md-5">
       <label for="">{{ __('Which chapter of the Bankruptcy Code
are you choosing to file under?') }}</label>
       </div>
        <div class="col-md-7">
           <div class="input-group">
               <input name="<?php echo base64_encode('Chapter 7'); ?>" value="On" checked ="checked" type="checkbox"><label>{{ __('Chapter 7') }}</label><br>
               <input name="<?php echo base64_encode('Chapter 11'); ?>" value="On" type="checkbox"><label>{{ __('Chapter 11') }}</label><br>
               <input name="<?php echo base64_encode('Chapter 12'); ?>" value="On" type="checkbox"><label>{{ __('Chapter 12') }}</label><br>
               <input name="<?php echo base64_encode('Chapter 13'); ?>" value="On" type="checkbox"><label>{{ __('Chapter 13') }}</label><br>
           </div>
        </div>
        </div>
       
    </div>
    <!-- Part 2 -->
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="part-form-title mb-3"> <span>{{ __('Part 2') }}</span>
                <h2 class="font-lg-18">{{ __('Sign Below') }}</h2> </div>
        </div>
    </div>
    <!-- Row 1 -->
    <div class="form-border mb-3">
        <!-- Row 2 -->
        <div class="row">
            <div class="col-md-12">
                <label for=""> <strong>{{ __('By signing here, you state that you are unable to pay the full filing fee at once, that you want to pay the fee in installments, and that you understand that:') }}
        </strong> </label>
               <p class="ml-30 mt-3">{{ __('You must pay your entire filing fee before you make any more payments or transfer any more property to an attorney, bankruptcy petition preparer, or anyone else for services in connection with your bankruptcy case.') }}</p>
               <p class="ml-30 mt-3">{{ __('If you do not pay the filing fee in full, then you will not receive a discharge or your debts when your bankruptcy case is closed. Your discharge, or confirmation of any plan, will be delayed until the filing fee is paid in full.') }}</p>
           
               <p class="ml-30 mt-3">{{ __('If you do not make any payment when it is due, your bankruptcy case may be dismissed or closed without discharge, and your rights in other bankruptcy proceedings may be affected.') }}</p>
           
               <p class="ml-30 mt-3">{{ __("The Clerk's Office will set the terms for payment of the filing fee, and the number of installments shall not exceed four (4).") }}</p>
               <p class="ml-30 ">{{ __('The final installment shall be payable not later than 120 days after filing the petition.') }}</p>
            </div>
        </div>
       

          <!-- Row 3 -->
          <div class="row mt-3">
            <div class="col-md-3 mt-3">
            <input readonly="" name="<?php echo base64_encode('signature1'); ?>" value="{{$debtor_sign}}" type="text" class="form-control">
                <label  style="border-top:1px solid;">{{ __('Signature of Debtor 1') }}</label>
                    </div>
                    <div class="col-md-3 mt-3">
                    <input readonly="" name="<?php echo base64_encode('signature1'); ?>" value="{{$debtor2_sign}}" type="text" class="form-control">
                    <label  style="border-top:1px solid;">{{ __('Signature of Debtor 2') }}</label>
                </div>
                <div class="col-md-6 mt-3">
                <input readonly="" name="<?php echo base64_encode('signature1'); ?>" value="{{$attorny_sign}}" type="text" class="form-control">
                <label style="border-top:1px solid;">{{ __('Your attorney’s name and signature, if you used one') }}</label>
             </div>
        </div>

         <!-- Row 3 -->
         <div class="row mt-3">
            <div class="col-md-3 mt-3">
                <div class="input-group d-flex">
                    <label>{{ __('Date') }} </label>
                    <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="w-150 date_filed form-control">
                </div>
            </div>
           
            <div class="col-md-3 mt-3">
                <div class="input-group d-flex">
                    <label>{{ __('Date') }} </label>
                    <input name="<?php echo base64_encode('Date_2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="w-150 date_filed form-control">
                </div>
            </div>    

            <div class="col-md-6 mt-3">
                <div class="input-group d-flex">
                    <label>{{ __('Date') }} </label>
                    <input name="<?php echo base64_encode('Date_3'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="w-150 date_filed form-control">
                </div>
            </div>     
        
        </div>
           
       
   

</div>
   
</div>