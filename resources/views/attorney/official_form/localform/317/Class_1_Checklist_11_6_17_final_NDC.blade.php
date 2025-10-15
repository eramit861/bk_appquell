<div class="ndcl1 row">
    <div class="ndcl1 col-md-12">
        <h3 class="ndcl1 text-center">{{ __('CLASS 1 CHECKLIST') }}</h3>
        <h3 class="ndcl1 mt-2 text-center underline">PROVIDE TO TRUSTEE ONLY <br> {{ __('DO NOT FILE WITH THE COURT') }}</h3>
    </div>

    <?php
        $propertNames = array_unique(array_column($residentsp, 'describe_secure_claim'));
    $propertname = implode(", ", $propertNames);
    $creditor_name = array_filter(array_column($residentsp, 'creditor_name'));
    //
    $creditor_name = implode(", ", $creditor_name);
    $account_number = array_filter(array_column($residentsp, 'account_number'));
    //
    $account_number = implode(", ", $account_number);
    $monthly_payment = array_filter(array_column($residentsp, 'monthly_payment'));
    //
    $monthly_payment = implode(", ", $monthly_payment);
    //
    $current_interest_rate = array_filter(array_column($residentsp, 'current_interest_rate'));
    $current_interest_rate = implode(", ", $current_interest_rate);
    ?>

    <div class="ndcl1 col-md-6 mt-3 d-flex">
        <label class="pt-2">{{ __('Debtor') }}&nbsp;{{ __('Name(s):') }}</label>
        <div class="pl-3 w-100">
            <input name="<?php echo base64_encode('Text117'); ?>" value="<?php echo $debtorname ?? ''; ?>" type="text" class="ndcl1 form-control">
        </div>
    </div>
    <div class="ndcl1 col-md-6 mt-3 d-flex">
        <label class="pt-2">{{ __('Bk Case #:') }}</label>
        <div class="pl-3">
            <input name="<?php echo base64_encode('Text118'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="ndcl1 form-control">
        </div>
    </div>
    <div class="ndcl1 col-md-12 mt-3 d-flex">
        <label class="pt-2">{{ __('Property') }}&nbsp;{{ __('Address:') }}</label>
        <div class="pl-3 w-100">
            <input name="<?php echo base64_encode('Text119'); ?>" value="<?php echo $propertname; ?>" type="text" class="ndcl1 form-control">
        </div>
    </div>
    <div class="ndcl1 col-md-3 mt-3 d-flex">
        <p class="mb-0"><input name="<?php echo base64_encode('Check Box120'); ?>" checked value="Yes" type="checkbox">{{ __('Residence') }}</p>
    </div>
    <div class="ndcl1 col-md-9 mt-2"></div>
    <div class="ndcl1 col-md-3 d-flex">
        <p class="mt-2 mb-0"><input name="<?php echo base64_encode('Check Box121'); ?>" value="Yes" type="checkbox">{{ __('Rental') }}</p>
    </div>
    <div class="ndcl1 col-md-9"></div>
    <div class="ndcl1 col-md-2 d-flex">
        <p class="mt-2 "><input name="<?php echo base64_encode('Check Box122'); ?>" value="Yes" type="checkbox">{{ __('Other') }}</p>
    </div>
    <div class="ndcl1 col-md-10 d-flex">
        <label class="pt-2">{{ __('Describe:') }}</label>
        <div class="pl-3 w-100">
            <input name="<?php echo base64_encode('TextBox0'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="ndcl1 form-control">
        </div>
    </div>
    <div class="ndcl1 col-md-6 mt-3">
        <?php $aPhone = explode("-", $attorneyPhone); ?>
        <p>
        {{ __('Daytime Phone') }}: (<input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo $aPhone[0] ?? '';?>" type="text" class="ndcl1 form-control width_10percent mr-0" style="width:50px;">
            )<input name="<?php echo base64_encode('Text123'); ?>" value="<?php echo $aPhone[1] ?? '';
    echo isset($aPhone[2]) ? "-".$aPhone[2] : '';?>" type="text" class="ndcl1 form-control width_auto ml-1">
        </p>        
    </div>
    <div class="ndcl1 col-md-6 mt-3">
        <p>
        {{ __('Evening') }}: (<input name="<?php echo base64_encode('TextBox2'); ?>" value="" type="text" class="ndcl1 form-control width_10percent mr-0" style="width:50px;">
            )<input name="<?php echo base64_encode('Text124'); ?>" value="<?php echo ''; ?>" type="text" class="ndcl1 form-control width_auto ml-1">
        </p>  
    </div>
    <div class="ndcl1 col-md-2 mt-2">
        <p>{{ __('Attorney name: (if any)') }}</p>  
    </div>
    <div class="ndcl1 col-md-10 mt-2">
        <input name="<?php echo base64_encode('Text125'); ?>" value="<?php echo $atroneyName; ?>" type="text" class="ndcl1 form-control">  
    </div>
    <div class="ndcl1 col-md-12 mt-3">
        <h3>{{ __('THE FOLLOWING INFORMATION MUST BE COMPLETED ON ALL
            CLAIMS LISTED IN CLASS 1. COMPLETE THIS FORM TO THE BEST
            OF YOUR ABILITY AND ATTACH THE PAYMENT COUPON OR
            STATEMENT THAT WAS SUPPLIED TO YOU FROM EACH
            CREDITOR.') }}</h3>
    </div>
    <div class="ndcl1 col-md-12 mt-3 border_1px">
        <div class="row mt-3 mb-2">
            <div class="col-md-2">
                <p class="pt-2">{{ __('Creditor Name:') }}</p>
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('Text126'); ?>" value="<?php echo $creditor_name; ?>" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('Account #:') }}</p>
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('Text127'); ?>" value="<?php echo $account_number; ?>" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('Payment Address:') }}</p>
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('Text128'); ?>" value="" type="text"  class="ndcl1 form-control">
                <p class="text-center">{{ __('Street Address') }}</p>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('Text129'); ?>" value="" type="text"  class="ndcl1 form-control">
                <p class="">{{ __('City') }}</p>
            </div>
            <div class="col-md-3">
                <input name="<?php echo base64_encode('Text130'); ?>" value="" type="text"  class="ndcl1 form-control">
                <p class="">{{ __('State') }}</p>
            </div>
            <div class="col-md-3">
                <input name="<?php echo base64_encode('Text131'); ?>" value="" type="text"  class="ndcl1 form-control">
                <p class="">Zip</p>
            </div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('Creditor') }}&nbsp;{{ __('Phone') }}&nbsp;{{ __('Number') }}&nbsp;(if&nbsp;known):</p>
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('TextBox3'); ?>" value="" type="text"  class="ndcl1 form-control">
            </div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('Regular') }}&nbsp;{{ __('Monthly') }}&nbsp;{{ __('Payment') }}&nbsp;{{ __('Amount:') }}&nbsp;$</p>
            </div>
            <div class="col-md-6">
                <input name="<?php echo base64_encode('Text132'); ?>" value="<?php echo $monthly_payment; ?>" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-2">
                <p class="pt-2 float_right">{{ __('Current') }}&nbsp;{{ __('Interest') }}&nbsp;{{ __('Rate:') }}</p>
            </div>
            <div class="col-md-2">
                <input name="<?php echo base64_encode('Text133'); ?>" value="<?php echo $current_interest_rate; ?>" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('Monthly Payment Due Date::') }}</p>
            </div>
            <div class="col-md-6">
                <input name="<?php echo base64_encode('Text134'); ?>" value="1st of each month" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('Date Payment Late:') }}</p>
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('Text135'); ?>" value="after 15th  of each month" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-2">
                <p class="pt-2 float_right">{{ __('Monthly Late Charge Amount: $') }}</p>
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('Text136'); ?>" value="<?php echo ''; ?>" type="text" class="ndcl1 price-field form-control">
            </div>
            <div class="col-md-8">
                <p class="pt-2">{{ __('Is this a variable interest rate loan?') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box137'); ?>" value="Yes" type="checkbox">{{ __('Yes') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box139'); ?>" value="Yes" type="checkbox">{{ __('No') }}</p>
            </div>
            <div class="col-md-8">
                <p class="pt-2">{{ __('If yes, when is the next anticipated adjustment date?') }}</p>
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('TextBox4'); ?>" value="<?php echo ''; ?>" type="text" class="ndcl1 form-control">
            </div>
            <div class="col-md-8">
                <p class="pt-2">{{ __('Are property taxes included in the monthly payment?') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box138'); ?>" value="Yes" type="checkbox">{{ __('Yes') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box140'); ?>" value="Yes" type="checkbox">{{ __('No') }}</p>
            </div>
            <div class="col-md-8">
                <p class="pt-2">{{ __('Is insurance included in the monthly payment?') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box141'); ?>" value="Yes" type="checkbox">{{ __('Yes') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box142'); ?>" value="Yes" type="checkbox">{{ __('No') }}</p>
            </div>
            <div class="col-md-8">
                <p class="pt-2">{{ __('Is the loan due in full and payable in less than 5 years?') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box143'); ?>" value="Yes" type="checkbox">{{ __('Yes') }}</p>
            </div>
            <div class="col-md-2">
                <p class="mt-2 "><input name="<?php echo base64_encode('Check Box144'); ?>" value="Yes" type="checkbox">{{ __('No') }}</p>
            </div>
            <div class="col-md-2">
                <p class="pt-2">{{ __('If yes, date due:') }}</p>
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('Text145'); ?>" value="<?php echo ''; ?>" type="text" class="ndcl1 form-control">
            </div>
        </div>
    </div>
  

</div>