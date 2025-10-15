<div class="row mt-3">
<div class="col-md-12">
    <h3 class="text-center">{{ __('PROOF OF SERVICE OF DOCUMENT') }}</h3>
</div>
    <div class="col-md-12">
     <div class="input-group">
        <label>{{ __('I am over the age of 18 and not a party to this bankruptcy case or adversary proceeding. My business address is:') }}</label>
        <textarea name="<?php echo base64_encode('POSText1'); ?>" value="" class="form-control"></textarea>
        </div>
    </div>
    <div class="col-md-12">
   <div class="input-group d-flex">
        <label>{{ __('A true and correct copy of the foregoing document entitled (specify):') }} </label>
        <input name="<?php echo base64_encode('POSText3'); ?>" value="" type="text" class="form-control">
    </div>
</div>
<div class="col-md-12">
    <div class="input-group">
        <input name="<?php echo base64_encode('POSText4'); ?>" value="" type="text" class="form-control">
        <input name="<?php echo base64_encode('POSText5'); ?>" value="" type="text" class="form-control">
        <input name="<?php echo base64_encode('POSText6'); ?>" value="" type="text" class="form-control">
        <label>{{ __('will be served or was served') }} <strong>(a)</strong> {{ __('on the judge in chambers in the form and manner required by LBR 5005-2(d); and') }} <strong>(b)</strong> {{ __('in the manner stated below:') }}</label>
    </div>
    </div>
    
    <div class="col-md-12 mt-3">
    <div class="input-group">
       <p><strong>1. </strong><strong class="underline">{{ __('TO BE SERVED BY THE COURT VIA NOTICE OF ELECTRONIC FILING (NEF):') }}</strong> Pursuant to controlling General Orders and LBR, the foregoing document will be served by the court via NEF and hyperlink to the document. On <i>{{ __('(date)') }}</i> 
       <input name="<?php echo base64_encode('POSText7'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control" style="width:100px;">{{ __(', I checked the CM/ECF docket for this bankruptcy case or adversary proceeding and determined that the following persons are on the Electronic Mail Notice List to receive NEF transmission at the email addresses stated below:') }}</p>
        <textarea name="<?php echo base64_encode('POSText8'); ?>" value="" class="form-control"></textarea>  
    </div>

    <div class="input-group" style="float:right;">
        <input name="<?php echo base64_encode('POSCheck Box12'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Service information continued on attached page') }}</label>
    </div>

  
</div>

<div class="col-md-12">
<div class="input-group mt-3">
        <p><strong>2.</strong> <strong class="underline">{{ __('SERVED BY UNITED STATES MAIL:') }}</strong> On <i>{{ __('(date)') }}</i> 
         <input name="<?php echo base64_encode('POSText13'); ?>"  style="width:100px;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" value="<?php echo $currentDate;?>" class="form-control date_filed">,  I served the following persons and/or entities at the last known addresses in this bankruptcy case or adversary proceeding by placing a true and correct copy thereof in a sealed envelope in the United States mail, first class, postage prepaid, and addressed as follows. Listing the judge here constitutes a declaration that mailing to the judge <span class="underline">{{ __('will be completed') }}</span> {{ __('no later than 24 hours after the document is filed.') }}</p>
         <textarea name="<?php echo base64_encode('POSText14'); ?>" value="" class="form-control"></textarea>  
    </div>
    <div class="input-group" style="float:right;">
        <input name="<?php echo base64_encode('POSCheck Box18'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Service information continued on attached page') }}</label>
    </div>
</div>

<div class="col-md-12 mt-3">
<div class="input-group">
        <p><strong>3.</strong> 
            <strong class="underline">{{ __('SERVED BY PERSONAL DELIVERY, OVERNIGHT MAIL, FACSIMILE TRANSMISSION OR EMAIL') }}</strong> 
            <span class="underline">{{ __('(state method for each person or entity served)') }}</span>
             Pursuant to F.R.Civ.P. 5 and/or controlling LBR, on <i>{{ __('(date)') }}</i>
              <input name="<?php echo base64_encode('POSText19'); ?>"  style="width:100px;" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="form-control date_filed">, I served the following persons and/or entities by personal delivery, overnight mail service, or (for those who consented in writing to such service method), by facsimile transmission and/or email, as follows. Listing the judge here constitutes a declaration that personal delivery on, or overnight mail to, the judge <span class="underline">{{ __('will be completed') }}</span> {{ __('no later than 24 hours after the document is filed.') }}</p>
         <textarea name="<?php echo base64_encode('POSText21'); ?>" value="" class="form-control"></textarea>  
    </div>
    <div class="input-group" style="float:right;">
        <input name="<?php echo base64_encode('POSCheck Box24'); ?>" value="Yes" type="checkbox">
        <label>{{ __('Service information continued on attached page') }}</label>
    </div>
</div>

  <div class="col-md-12 mt-3">
    <p>{{ __('I declare under penalty of perjury under the laws of the United States that the foregoing is true and correct.') }}</p>
  </div>

<div class="col-md-2">
    <input name="<?php echo base64_encode('POSText25'); ?>" value="<?php echo $currentDate;?>" type="text"  placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control"><br>
    <i>{{ __('Date') }}</i>
</div>
<div class="col-md-5">
    <input name="<?php echo base64_encode('POSText26'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="form-control"><br>
    <i>{{ __('Printed Name') }}</i>
</div>
<div class="col-md-5">
    <input name="<?php echo base64_encode('POSText27'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control"><br>
    <i>{{ __('Signature') }}</i>
</div>

  


<div class="col-md-12 mt-3">
 
</div>


</div>