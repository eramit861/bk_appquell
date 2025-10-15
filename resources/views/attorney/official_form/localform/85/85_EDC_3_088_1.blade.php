<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">{{ __('DOMESTIC SUPPORT OBLIGATION CHECKLIST') }}</h3>
        <h3 class="mt-3 text-center underline">{{ __('FILE WITH TRUSTEE ONLY') }} <br>{{ __('DO NOT FILE WITH THE COURT') }}</h3>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-center"><i>{{ __('COMPLETE 1 FORM FOR EACH SUPPORT OBLIGATION') }}</i></p>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                <label>{{ __('Debtor Name(s):') }} </label>
            </div>
            <div class="col-md-9">
            <input name="<?php echo base64_encode('Debtor Names'); ?>" value="<?php echo $debtorname ?? ''; ?>" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
            <label>{{ __('Bk Case #:') }} </label>
            </div>
            <div class="col-md-9">
            <input name="<?php echo base64_encode('Bk Case'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="row">
            <div class="col-md-6">
            <p class="mb-0">{{ __('Debtor Daytime Phone:  (') }}
                <input name="<?php echo base64_encode('AreaCode1'); ?>" value="" type="text" class="form-control width_15percent">
                <span>)</span>
            </p>
            </div>
            <div class="col-md-6">
            <input name="<?php echo base64_encode('Phone1'); ?>" value="" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="row">
            <div class="col-md-6">
            <p class="mb-0">{{ __('Evening:  (') }}
                <input name="<?php echo base64_encode('AreaCode2'); ?>" value="" type="text" class="form-control width_15percent">
                <span>)</span>
            </p>
            </div> 
            <div class="col-md-6">
                <input name="<?php echo base64_encode('Phone2'); ?>" value="" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-12">

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Attorney name:') }}</label>
            <input name="<?php echo base64_encode('Attorney Name'); ?>" value="{{$atroneyName}}" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Name of Claim Holder:') }}</label>
            <input name="<?php echo base64_encode('Name of Claim Holder'); ?>" value="" type="text" class="form-control">
        </div>

        <div class="input-group mt-3 d-flex">
            <label style="width:200px;">{{ __('Address of Claim Holder:') }}</label>
        </div>

        <div class="col-md-12 mt-3">
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('Mailing Address'); ?>" value="" type="text"  placeholder="" class="form-control">
                <input name="<?php echo base64_encode('CityState'); ?>" value="" type="text"  placeholder="" class="form-control">
                <input name="<?php echo base64_encode('Zip'); ?>" value="" type="text"  placeholder="" class="form-control"><br>
            </div> 
            <div class="input-group d-flex">
                <label style="width:35%;">{{ __('Mailing Address') }}</label> 
                <label style="width:35%;">{{ __('City/State') }}</label> 
                <label style="width:30%;">{{ __('Zip') }}</label>
            </div> 
        </div>
        <div class="col-md-12 mt-3">
            <label style="width:200px;">{{ __('Support Type:') }}</label>
            <div class="input-group col-md-4 d-flex ml-30" >
                <div class="col-md-8">
                    <label style="width:35%;">{{ __('Spousal Support') }}</label> 
                </div>
                <div class="col-md-4">
                    <input name="<?php echo base64_encode('Check Box3.0'); ?>" value="Yes" type="checkbox">
                </div>
            </div>
            <div class="input-group col-md-4 d-flex ml-30" >
                <div class="col-md-8">
                    <label style="width:35%;">{{ __('Child Support') }}</label> 
                </div>
                <div class="col-md-4">
                    <input name="<?php echo base64_encode('Check Box3.1'); ?>" value="Yes" type="checkbox">
                </div>
            </div>
            <div class="input-group col-md-4 d-flex ml-30" >
                <div class="col-md-8">
                    <label style="width:35%;">{{ __('Both') }}</label> 
                </div>
                <div class="col-md-4">
                    <input name="<?php echo base64_encode('Check Box3.2'); ?>" value="Yes" type="checkbox">
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

<div class="col-md-12 mt-3 border_1px pb-3">
    <div class="input-group d-flex" style="margin-top:15px;">
        <p>{{ __('Name of Applicable State Agency Where Claim Holder Resides:') }} </p>
    </div>
    <div class="input-group d-flex">
        <input name="<?php echo base64_encode('Name of Applicable State Agency Where Claim Holder Resides'); ?>" value="" type="text"  placeholder="" class="form-control">
    </div>
    <div class="input-group d-flex" style="margin-top:15px;">
        <p>{{ __('Payment Address:') }} </p>
    </div>
    <div class="input-group d-flex">
        <input name="<?php echo base64_encode('Mailing Address_2'); ?>" value="" type="text"  placeholder="" class="form-control">
        <input name="<?php echo base64_encode('CityState_2'); ?>" value="" type="text"  placeholder="" class="form-control">
        <input name="<?php echo base64_encode('Zip_2'); ?>" value="" type="text"  placeholder="" class="form-control"><br>
    </div> 
    <div class="input-group d-flex">
        <label style="width:35%;">{{ __('Mailing Address') }}</label> 
        <label style="width:35%;">{{ __('City/State') }}</label> 
        <label style="width:30%;">{{ __('Zip') }}</label>
    </div>
    <div class="input-group d-flex">
        <label style="width:15%;">{{ __('Account:') }} </label>
        <input name="<?php echo base64_encode('Account'); ?>" value="" style="width:35%;" type="text" class="form-control">
        <label style="width:15%;">{{ __('Agency Phone #:') }} </label>
        <input name="<?php echo base64_encode('Agency Phone'); ?>" value="" style="width:35%;" type="text" class="form-control">
    </div>
    <div class="input-group d-flex">
        <label style="width:15%;">{{ __('Monthly Payment Amount: $') }} </label>
        <input name="<?php echo base64_encode('Monthly Payment Amount'); ?>" value="" style="width:35%;" type="text" class="form-control">
        <label style="width:15%;">{{ __('Monthly Due Date:') }} </label>
        <input name="<?php echo base64_encode('Monthly Due Date'); ?>" value="" style="width:35%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
    </div>
    <div class="input-group d-flex">
        <label style="width:15%;">{{ __('Date Payment Late:') }} </label>
        <input name="<?php echo base64_encode('Date Payment Late'); ?>" value="" style="width:35%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        <label style="width:15%;">{{ __('Years Remaining:') }} </label>
        <input name="<?php echo base64_encode('Years Remaining'); ?>" value="" style="width:35%;" type="text" class="form-control">
    </div>
    <div class="input-group d-flex" style="margin-top:15px;">
        <label>{{ __('Are ongoing payments being made to the claim holder by Wage Order?') }}</label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>{{ __('Yes') }}</label> 
        <input name="<?php echo base64_encode('Check Box4.0.0'); ?>" value="Yes" type="checkbox">
        &nbsp;&nbsp;&nbsp;
        <label>{{ __('No') }}</label> 
        <input name="<?php echo base64_encode('Check Box4.0.1'); ?>" value="Yes" type="checkbox">
    </div>
    <div class="input-group d-flex" style="margin-top:15px;">
        <label>{{ __('Is the Debtor currently employed:') }} </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label>{{ __('Yes') }}</label> 
        <input name="<?php echo base64_encode('Check Box4.1.0'); ?>" value="Yes" type="checkbox">
        &nbsp;&nbsp;&nbsp;
        <label>{{ __('No') }}</label> 
        <input name="<?php echo base64_encode('Check Box4.1.1'); ?>" value="Yes" type="checkbox">
    </div>
    <div class="input-group d-flex">
        <label style="width:200px;">{{ __('If yes, Employer Information:') }} </label>
    </div>
    <div class="input-group d-flex">
        <input name="<?php echo base64_encode('Employer Name'); ?>" value="" type="text"  placeholder="" class="form-control">
        <input name="<?php echo base64_encode('Employer Mailing Address'); ?>" value="" type="text"  placeholder="" class="form-control">
        <input name="<?php echo base64_encode('Employer City/State'); ?>" value="" type="text"  placeholder="" class="form-control">
        <input name="<?php echo base64_encode('Employer Zip'); ?>" value="" type="text"  placeholder="" class="form-control"><br>
    </div> 
    <div class="input-group d-flex">
        <label style="width:25%;">{{ __('Name') }}</label> 
        <label style="width:25%;">{{ __('Mailing Address') }}</label> 
        <label style="width:25%;">{{ __('City/State') }}</label> 
        <label style="width:25%;">{{ __('Zip') }}</label>
    </div>
 </div>

</div>