<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">{{ __('CLASS 1 CHECKLIST') }}</h3>
         <p class="mt-3 text-center underline">{{ __('FILE WITH TRUSTEE ONLY') }} <br>{{ __('DO NOT FILE WITH THE COURT') }}</p>
    </div>
<?php

$propertNames = array_unique(array_column($residentsp, 'describe_secure_claim'));
$propertname = implode(", ", $propertNames);

$creditor_name = array_filter(array_column($residentsp, 'creditor_name'));
$creditor_name = implode(", ", $creditor_name);

$account_number = array_filter(array_column($residentsp, 'account_number'));
$account_number = implode(", ", $account_number);

$monthly_payment = array_filter(array_column($residentsp, 'monthly_payment'));
$monthly_payment = implode(", ", $monthly_payment);

$current_interest_rate = array_filter(array_column($residentsp, 'current_interest_rate'));
$current_interest_rate = implode(", ", $current_interest_rate);
?>
    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">
            <label style="width:300px;">{{ __('Debtor Name(s):') }} </label>
            <input name="<?php echo base64_encode('dbname'); ?>" value="<?php echo $debtorname ?? ''; ?>" type="text" class="form-control">
            <label  style="width:250px;">{{ __('Bk Case #:') }} </label>
            <input name="<?php echo base64_encode('bknum'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:150px;">{{ __('Property Address:') }}</label>
            <input name="<?php echo base64_encode('propaddr'); ?>" value="<?php echo $propertname; ?>" type="text" class="form-control">
        </div>

        <div class="input-group mt-3">
            <input name="<?php echo base64_encode('residence'); ?>" value="Yes" checked type="checkbox" class="height-fit-content"><label>{{ __('Residence') }}</label><br>
            <input name="<?php echo base64_encode('rental'); ?>" value="Yes" type="checkbox" class="height-fit-content"><label>{{ __('Rental') }}</label>
        </div>
        
        <div class="">
            <p><input name="<?php echo base64_encode('otherbox'); ?>" value="Yes" type="checkbox" class="height-fit-content">
            {{ __('Other') }} &nbsp &nbsp {{ __('Describe:') }} 
            <input name="<?php echo base64_encode('other'); ?>" value="" type="text" class="form-control width_85percent">
        </p> 
        </div>

        <div class="input-group mt-3 d-flex">
        <?php $aPhone = explode("-", $attorneyPhone); ?>
            <label style="width:385px;">{{ __('Daytime Phone:  (') }}</label>
            <input name="<?php echo base64_encode('code1'); ?>" value="<?php  echo $aPhone[0] ?? ''; ?>" type="text" class="form-control" style="width:50px;"><label>)</label>
            <input name="<?php echo base64_encode('dayphone'); ?>" value="<?php echo $aPhone[1] ?? '';
echo isset($aPhone[2]) ? "-".$aPhone[2] : '';?>" type="text" class="form-control">
            <label style="width:260px;">{{ __('Evening:  (') }}</label>
            <input name="<?php echo base64_encode('code2'); ?>" value="" type="text" class="form-control" style="width:50px;"><label>)</label>
            <input name="<?php echo base64_encode('evephone'); ?>" value="" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Attorney name: (if any)') }} </label>
            <input name="<?php echo base64_encode('attyname'); ?>" value="<?php echo $atroneyName; ?>" type="text" class="form-control">
        </div>
    </div>
<div class="col-md-12 mt-3">
    <p>{{ __('THE FOLLOWING INFORMATION MUST BE COMPLETED ON ALL CLAIMS LISTED IN CLASS 1. PLEASE BE SURE TO COMPLETE THIS FORM TO THE BEST OF YOUR ABILITY AND ATTACH THE PAYMENT COUPON OR STATEMENT THAT WAS SUPPLIED TO YOU FROM EACH CREDITOR.') }}</p>
</div>

<div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:130px;">{{ __('Creditor Name:') }} </label>
        <input name="<?php echo base64_encode('credname'); ?>" value="<?php echo $creditor_name; ?>" type="text" class="form-control">
      </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:90px;">{{ __('Account #:') }} </label>
        <input name="<?php echo base64_encode('acctnum'); ?>" value="<?php echo $account_number; ?>" type="text" class="form-control">
      </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:140px;">{{ __('Payment Address:') }}  </label>
        <input name="<?php echo base64_encode('pmtaddr'); ?>" value="" type="text"  class="form-control">
      </div> 
      <div class="input-group d-flex">
        <label style="text-align:center;width:100%;">{{ __('Street Address') }}</label> 
      </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <input name="<?php echo base64_encode('citystatezip'); ?>" value="" type="text"  placeholder="" class="form-control"><br>
      
      </div> 
      <div class="input-group d-flex">
        <label class="width_30percent">{{ __('City') }}</label> <label class="width_30percent">{{ __('State') }}</label> <label class="width_30percent">{{ __('Zip') }}</label>
      </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:340px;">{{ __('Creditor Phone Number: (if known)') }}  </label>
        <input name="<?php echo base64_encode('credphone'); ?>" value="" type="text"  class="form-control">
    </div> 
 </div>

 <div class="col-md-12">
    <div class="input-group d-flex">
        <label style="width:30%;">{{ __('Regular Monthly Payment Amount: $') }} </label>
        <input name="<?php echo base64_encode('pmtamt'); ?>" value="<?php echo $monthly_payment; ?>" type="text" style="width:25%;" class="form-control">
        <label style="width:20%;">{{ __('Current Interest Rate:') }} </label>
        <input name="<?php echo base64_encode('intrate'); ?>" value="<?php echo $current_interest_rate; ?>" type="text" style="width:25%;" class="form-control">
        
    </div> 
 </div>

 <div class="col-md-12">
    <div class="input-group d-flex">
        <label style="width:25%;">{{ __('Monthly Payment Due Date:') }} </label>
        <input name="<?php echo base64_encode('pmtduedate'); ?>" value="" type="text" style="width:50%;" class="form-control">
        <label style="width:25%;"> </label> 
    </div> 
 </div>

 <div class="col-md-12">
    <div class="input-group d-flex">
        <label style="width:20%;">{{ __('Date Payment Late:') }}</label>
        <input name="<?php echo base64_encode('pmtlate'); ?>" value="" type="text" style="width:30%;" class="form-control">
        <label style="width:30%;">{{ __('Monthly Late Charge Amount: $') }} </label>
        <input name="<?php echo base64_encode('latecharge'); ?>" value="" type="text" style="width:20%;" class="form-control">
        
    </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:45%;">{{ __('Is this a variable interest rate loan?') }}</label>
        <input name="<?php echo base64_encode('y1'); ?>" value="Yes" type="checkbox"> <label>{{ __('Yes') }}</label>
        <input name="<?php echo base64_encode('n1'); ?>" value="Yes" type="checkbox" class="ml-30"> <label>{{ __('No') }}</label>
     </div> 
 </div>


 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:75%;">{{ __('If yes, when is the next anticipated adjustment date?') }} </label>
       <input name="<?php echo base64_encode('anticipatedate'); ?>" value="" type="text" class="form-control">
     </div> 
 </div>
 
 
 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:45%;">{{ __('Are property taxes included in the monthly payment?') }}</label>
        <input name="<?php echo base64_encode('y2'); ?>" value="Yes" type="checkbox"> <label>{{ __('Yes') }}</label>
        <input name="<?php echo base64_encode('n2'); ?>" value="Yes" type="checkbox" class="ml-30 height-fit-content"> <label>{{ __('No') }}</label>
     </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:45%;">{{ __('Is insurance included in the monthly payment?') }}</label>
        <input name="<?php echo base64_encode('y3'); ?>" value="Yes" type="checkbox"> <label>{{ __('Yes') }}</label>
        <input name="<?php echo base64_encode('n3'); ?>" value="Yes" type="checkbox" class="ml-30"> <label>{{ __('No') }}</label>
     </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label style="width:45%;">{{ __('Is the loan due in full and payable in less than 5 years?') }}</label>
        <input name="<?php echo base64_encode('y4'); ?>" value="Yes" type="checkbox"> <label>{{ __('Yes') }}</label>
        <input name="<?php echo base64_encode('n4'); ?>" value="Yes" type="checkbox" class="ml-30"> <label>{{ __('No') }}</label>
     </div> 
 </div>

 <div class="col-md-12 mt-3">
    <div class="input-group d-flex">
        <label class="width_15percent">{{ __('If yes, date due:') }}  </label>
        <input name="<?php echo base64_encode('yesdatedue'); ?>" value="" type="text"  class="form-control">
    </div> 
 </div>

</div>