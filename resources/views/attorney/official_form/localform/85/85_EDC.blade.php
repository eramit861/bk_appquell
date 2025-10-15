<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">{{ __('DOMESTIC SUPPORT OBLIGATION CHECKLIST') }}</h3>
        <h3 class="mt-3 text-center underline">{{ __('FILE WITH TRUSTEE ONLY') }} <br>{{ __('DO NOT FILE WITH THE COURT') }}</h3>
    </div>
    <div class="col-md-12" style="margin-top:20px;">
        <p class="text-center"><i>{{ __('COMPLETE 1 FORM FOR EACH SUPPORT OBLIGATION') }}</i></p>
    </div>
    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">
            <label style="width:300px;">{{ __('Debtor Name(s):') }} </label>
            <input readonly name="<?php echo base64_encode(''); ?>" value="<?php echo $debtorname ?? ''; ?>" type="text" class="form-control">
            <label  style="width:250px;">{{ __('Bk Case #:') }} </label>
            <input readonly name="<?php echo base64_encode(''); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:385px;">{{ __('Debtor Daytime Phone:') }} </label>
            <label >(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</label>
            <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text" class="form-control">
            <label style="width:260px;">{{ __('Evening:') }}  </label>
            <label >(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</label>
            <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Attorney name:') }}</label>
            <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Name of Claim Holder:') }}</label>
            <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Address of Claim Holder:') }}</label>
        </div>

        <div class="col-md-12 mt-3">
            <div class="input-group d-flex">
                <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
                <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
                <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control"><br>
            </div> 
            <div class="input-group d-flex">
                <label style="width:35%;">{{ __('Mailing Address') }}</label> 
                <label style="width:35%;">{{ __('City/State') }}</label> 
                <label style="width:30%;">Zip</label>
            </div> 
        </div>
        <div class="col-md-12 mt-3">
            <label style="width:200px;">{{ __('Support Type:') }}</label>
            <div class="input-group col-md-4 d-flex ml-30" >
                <div class="col-md-8">
                    <label style="width:35%;">{{ __('Spousal Support') }}</label> 
                </div>
                <div class="col-md-4">
                <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
                </div>
            </div>
            <div class="input-group col-md-4 d-flex ml-30" >
                <div class="col-md-8">
                    <label style="width:35%;">{{ __('Child Support') }}</label> 
                </div>
                <div class="col-md-4">
                <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
                </div>
            </div>
            <div class="input-group col-md-4 d-flex ml-30" >
                <div class="col-md-8">
                    <label style="width:35%;">{{ __('Both') }}</label> 
                </div>
                <div class="col-md-4">
                <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
                </div>
            </div>
        </div>

    </div>
<div class="col-md-12 mt-3">
    <h3>{{ __('THE FOLLOWING INFORMATION MUST BE COMPLETED ON EACH SUPPORT 
        OBLIGATION. PLEASE BE SURE TO COMPLETE THIS FORM TO THE BEST OF 
        YOUR ABILITY.') }} 
    </h3>
</div>

<div class="col-md-12 mt-3" style="border:1px solid #000; padding-bottom:15px">
    <div class="input-group d-flex" style="margin-top:15px;">
        <p>{{ __('Name of Applicable State Agency Where Claim Holder Resides:') }} </p>
    </div>
    <div class="input-group d-flex">
        <input readonly name="<?php echo base64_encode('Name of Applicable State Agency Where Claim Holder Resides'); ?>" value="" type="text"  placeholder="" class="form-control">
    </div>
    <div class="input-group d-flex" style="margin-top:15px;">
        <p>{{ __('Payment Address:') }} </p>
    </div>
    <div class="input-group d-flex">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control"><br>
    </div> 
    <div class="input-group d-flex">
        <label style="width:35%;">{{ __('Mailing Address') }}</label> 
        <label style="width:35%;">{{ __('City/State') }}</label> 
        <label style="width:30%;">Zip</label>
    </div>
    <div class="input-group d-flex">
        <label style="width:15%;">{{ __('Account:') }} </label>
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:35%;" type="text" class="form-control">
        <label style="width:15%;">{{ __('Agency Phone #:') }} </label>
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:35%;" type="text" class="form-control">
    </div>
    <div class="input-group d-flex">
        <label style="width:15%;">{{ __('Monthly Payment Amount: $') }} </label>
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:35%;" type="text" class="form-control">
        <label style="width:15%;">{{ __('Monthly Due Date:') }} </label>
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:35%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
    </div>
    <div class="input-group d-flex">
        <label style="width:15%;">{{ __('Date Payment Late:') }} </label>
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:35%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        <label style="width:15%;">{{ __('Years Remaining:') }} </label>
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:35%;" type="text" class="form-control">
    </div>
    <div class="input-group d-flex" style="margin-top:15px;">
        <label>{{ __('Are ongoing payments being made to the claim holder by Wage Order?') }}</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>{{ __('Yes') }}</label> 
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:40px;" type="text"  placeholder="" class="form-control">
        &nbsp;&nbsp;&nbsp;
        <label>{{ __('No') }}</label> 
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:40px;" type="text"  placeholder="" class="form-control">
    </div>
    <div class="input-group d-flex" style="margin-top:15px;">
        <label>{{ __('Is the Debtor currently employed:') }} </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>{{ __('Yes') }}</label> 
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:40px;" type="text"  placeholder="" class="form-control">
        &nbsp;&nbsp;&nbsp;
        <label>{{ __('No') }}</label> 
        <input readonly name="<?php echo base64_encode(''); ?>" value="" style="width:40px;" type="text"  placeholder="" class="form-control">
    </div>
    <div class="input-group d-flex">
        <label style="width:200px;">{{ __('If yes, Employer Information:') }} </label>
    </div>
    <div class="input-group d-flex">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control">
        <input readonly name="<?php echo base64_encode(''); ?>" value="" type="text"  placeholder="" class="form-control"><br>
    </div> 
    <div class="input-group d-flex">
        <label style="width:25%;">{{ __('Name') }}</label> 
        <label style="width:25%;">{{ __('Mailing Address') }}</label> 
        <label style="width:25%;">{{ __('City/State') }}</label> 
        <label style="width:25%;">Zip</label>
    </div>
 </div>

 <div class="col-md-12 mt-3">
 
</div>

</div>