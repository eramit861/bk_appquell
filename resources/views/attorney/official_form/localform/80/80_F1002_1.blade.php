<div class="row">
   <div class="col-md-12 border_1px bb-0" >
      <div class="row">
         <div class="col-md-6 p-3" >
            <div class="input-group">
                  <label>{{ __('Attorney or Party Name, Address, Telephone & FAX Nos., State Bar No. & Email Address') }}</label>
                  <textarea name="<?php echo base64_encode('TextPg1a'); ?>" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
            </div>
            <div class="input-group">
                  <input name="<?php echo base64_encode('Check Box2'); ?>" value="Yes" type="checkbox">
                  <label for=""><i>{{ __('Debtor(s) appearing without an attorney') }}</i></label>
            </div>
            <div class="input-group">
                  <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes" type="checkbox" checked="checked">
                  <label for=""><i>{{ __('Attorney for Debtor(s)') }}</i></label>
            </div>
         </div>
         
         <div class="col-md-6 p-3 border_left_1px">
            <span>{{ __('FOR COURT USE ONLY') }}</span>
         </div>
      </div>
   </div>

   <div class="col-md-12 border_1px p-3 text-center">
      <p class="mb-0">
      {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
         {{ __('CENTRAL DISTRICT OF CALIFORNIA -') }} 
         <select name="<?php echo base64_encode('Dropdown1'); ?>" class="division_select form-control w-auto">
            <option name="<?php echo base64_encode('Dropdown1'); ?>" value="**SELECT DIVISION**" >{{ __('**SELECT DIVISION**') }}</option>
            <option name="<?php echo base64_encode('Dropdown1'); ?>" value="LOS ANGELES DIVISION" >{{ __('LOS ANGELES DIVISION') }}</option>
            <option name="<?php echo base64_encode('Dropdown1'); ?>" value="RIVERSIDE DIVISION" >{{ __('RIVERSIDE DIVISION') }}</option>
            <option name="<?php echo base64_encode('Dropdown1'); ?>" value="SANTA ANA DIVISION" >{{ __('SANTA ANA DIVISION') }}</option>
            <option name="<?php echo base64_encode('Dropdown1'); ?>" value="NORTHERN DIVISION" >{{ __('NORTHERN DIVISION') }}</option>
            <option name="<?php echo base64_encode('Dropdown1'); ?>" value="SAN FERNANDO VALLEY DIVISION" >{{ __('SAN FERNANDO VALLEY DIVISION') }}</option>
         </select>
      </p>
   </div>

   <div class="col-md-12 border_1px bt-0">
      <div class="row">
         <div class="col-md-6 p-3 border_right_1px">
            <div class="input-group">
               <label>{{ __('In re:') }}</label>
               <textarea name="<?php echo base64_encode('TextPg1b'); ?>" class="form-control" rows="11" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div>
            {{ __('Debtor(s).') }}
         </div>
         <div class="col-md-6 p-3">
            <div class="">
               <x-officialForm.caseNo
                  labelText="CASE NO.:"
                  casenoNameField="Case"
                  caseno={{$caseno}}
               ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
               <x-officialForm.caseNo
                  labelText="CHAPTER:"
                  casenoNameField="Chapter"
                  caseno={{$chapterNo}}
               ></x-officialForm.caseNo>
            </div>
            <div class="col-md-12 p-3 mt-3 text-center border_top_1px" >
               <h3 class="">{{ __('DECLARATION BY DEBTOR(S)') }}<br>
               {{ __('AS TO WHETHER INCOME WAS RECEIVED') }} <br>
                  {{ __('FROM AN EMPLOYER WITHIN 60 DAYS OF') }} <br>
                  {{ __('THE PETITION DATE') }}
               </h3>
               <p class="mb-0 mt-2">{{ __('[11 U.S.C. § 521(a)(1)(B)(iv)]') }}</p>
            </div>
            <div class="col-md-12 mr-0 pr-0 p-3 text-center border_top_1px" style="padding-bottom:0px !important; ">
               <p class="mb-0">{{ __('[No hearing required]') }}</p>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-12 mt-3">
      <p >{{ __('Debtor(s) provides the following declaration(s) as to whether income was received from an employer within 60 days of the 
         Debtor(s) filing this bankruptcy case (Petition Date), as required by 11 U.S.C. § 521(a)(1)(B)(iv):') }} 
      </p>
      <p class="mt-3 underline">{{ __('Declaration of Debtor 1') }}</p>
   </div>
   <div class="col-md-12">
      <div class="input-group">1. 
         <input name="<?php echo base64_encode('Check Box1'); ?>" checked value="Yes" type="checkbox">
         <label for="">{{ __('I am Debtor 1 in this case, and I declare under penalty of perjury that the following information is true and correct:') }}</label>
      </div>
      <div class="input-group ml-30">
         <label><strong>{{ __('During the 60-day period before the Petition Date') }}</strong><i> {{ __('(Check only ONE box below):') }} </i></label>
      </div>
      <div class="input-group ml-30"> 
         <input name="<?php echo base64_encode('GROUP11'); ?>" class="debtor_paid" value="Choice1" type="checkbox">
         <label for="">
         <strong>{{ __('I was paid by an employer.') }}</strong> {{ __('Attached are copies of all statements of earnings, pay stubs, or other proof of 
         employment income I received from my employer during this 60-day period.') }} <i>{{ __('(If the Debtor’s social security 
         number or bank account is on a pay stub or other proof of income, the Debtor must cross out (redact) the 
         number(s) before filing this declaration.)') }}</i>
         </label>
      </div>
      <div class="input-group ml-30"> 
         <input name="<?php echo base64_encode('GROUP11'); ?>" value="Choice2" class="debtor_not_paid" type="checkbox">
         <label for="">
         <strong>{{ __('I was not paid by an employer') }}</strong> {{ __('because I was either self-employed only, or not employed.') }}
         </label>
      </div>
   </div>

   <div class="col-md-12 mt-3 d-flex">
      <div class="col-md-2">
         <input name="<?php echo base64_encode('DateDebtor 1'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
         <br>{{ __('Date') }}
      </div>
      <div class="col-md-5">
         <input name="<?php echo base64_encode('Printed Debtor 1'); ?>" type="text" class="form-control" value="{{$onlyDebtor}}">
         <br>{{ __('Printed name of Debtor 1') }}
      </div>
      <div class="col-md-5">
         <input name="<?php echo base64_encode('Signature Debtor 1'); ?>" type="text" class="form-control" value="<?php echo $debtor_sign;?>">
         <br>{{ __('Signature of Debtor 1') }}
      </div>
   </div>

   <div class="col-md-12 mt-3">
    <p class="underline">{{ __('Declaration of Debtor 2 (Joint Debtor) (if applicable)') }}</p>
      <div class="input-group">2. 
         <input  name="<?php echo base64_encode('Check Box4'); ?>" value="Yes" <?php if ($clentData['client_type'] == 3) {
             echo "checked";
         } ?> type="checkbox">
         <label for="">{{ __('I am Debtor 2 in this case, and I declare under penalty of perjury that the following information is true and correct:') }}</label>
      </div>
      <div class="input-group ml-30">
         <label><strong>{{ __('During the 60-day period before the Petition Date') }}</strong><i> {{ __('(Check only ONE box below):') }} </i></label>
      </div>
      <div class="input-group ml-30"> 
         <input name="<?php echo base64_encode('Group2'); ?>" class="spouse_paid" value="Choice1" type="checkbox">
         <label for="">
         <strong>{{ __('I was paid by an employer.') }}</strong> {{ __('Attached are copies of all statements of earnings, pay stubs, or other proof of 
            employment income I received from my employer during this 60 day period.') }} <i>{{ __('(If the Debtor’s social security 
            number or bank account is on a pay stub or other proof of income, the Debtor must cross out (redact) the 
            number(s) before filing this declaration.)') }}</i>
         </label>
      </div>
      <div class="input-group ml-30"> 
         <input name="<?php echo base64_encode('Group2'); ?>"  class="spouse_not_paid" value="4" type="checkbox">
         <label for="">
         <strong>{{ __('I was not paid by an employer') }}</strong> {{ __('because I was either self-employed only, or not employed.') }}
         </label>
      </div>
   </div>

   <div class="col-md-12 mt-3 d-flex">
      <div class="col-md-2">
         <input name="<?php echo base64_encode('DateDebtor 2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
         <br>{{ __('Date') }}
      </div>
      <div class="col-md-5">
         <input name="<?php echo base64_encode('Printed Debtor 2'); ?>" type="text" class="form-control" value="<?php echo $spousename;?>">
         <br>{{ __('Printed name of Debtor 2') }}
      </div>
      <div class="col-md-5">
         <input name="<?php echo base64_encode('Signature Debtor 2'); ?>" type="text" class="form-control" value="<?php echo $debtor2_sign;?>">
         <br>{{ __('Signature of Debtor 2') }}
      </div>
   </div>



   <div class="col-md-12 mt-3">
 
</div>

</div>
<script>
$(document).ready(function(){
   checkByIncome();
});
$(document).on("change", ".debtor_employed,.debtor_not_employed,.spouse_employed,.spouse_not_employed", function(evt) {
   checkByIncome();
		});
checkByIncome = function(){
   if($(".debtor_employed").is(':checked')){
   $(".debtor_paid").prop('checked',true); 
   $(".debtor_not_paid").prop('checked',false); 
   }
   if($(".debtor_not_employed").is(':checked')){
      $(".debtor_not_paid").prop('checked',true); 
      $(".debtor_paid").prop('checked',false); 
   }
   if($(".spouse_employed").is(':checked')){
      $(".spouse_paid").prop('checked',true); 
      $(".spouse_not_paid").prop('checked',false); 
   }
   if($(".spouse_not_employed").is(':checked')){
      $(".spouse_not_paid").prop('checked',true); 
      $(".spouse_paid").prop('checked',false); 
   }
}
   </script>