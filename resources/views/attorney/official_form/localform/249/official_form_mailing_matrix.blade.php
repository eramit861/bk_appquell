<div class="row">

    <div class="district249 col-md-12 text-center">
        <div class="row">
            <div class="district249 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('DISTRICT OF SOUTH CAROLINA') }} </h2>
            </div>
        </div>
    </div>



    
    @include("attorney.official_form.localform.common_details")



    <div class="district249 col-md-12">
        <div class="row">
            <div class="district249 col-md-12 text-center mb-3" style="margin-top: 1rem !important;">
                <h3>{{ __('CERTIFICATION VERIFYING CREDITOR MATRIX') }}</h3> 
            </div>

            <div class="district249 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __("The above named debtor, or attorney for the debtor if applicable, hereby certifies pursuant to South Carolina Local  Bankruptcy Rule I 007-1 that the master mailing list of creditors submitted either on computer diskette, electronically filed via  CM/ECF, or conventionally filed in a typed hard copy scannable format which has been compared to, and contains identical  information to, the debtor's schedules, statements and lists which are being filed at this time or as they currently exist in draft form.") }} 
                </p>
            </div>
    
            <div class="district249 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Master mailing list of creditors submitted via:') }}
                </p>
            </div>

            <div class="district249 col-md-1"></div>
            <div class="district249 col-md-11 d-flex">
                <label>(a)</label>
                <input name="<?php echo base64_encode('Check Box1'); ?>" value="Yes" type="checkbox" class="form-control height_fit_content w-auto">
                <p>
                    {{ __('computer diskette') }}
                </p>
            </div>

            <div class="district249 col-md-1"></div>
            <div class="district249 col-md-11 d-flex">
                <label>(b)</label>
                <input name="<?php echo base64_encode('Check Box2'); ?>" value="Yes" checked type="checkbox" class="form-control height_fit_content w-auto">
                <p>
                    {{ __('scannable hard copy (number of sheets submitted') }}
                </p>
                <input name="<?php echo base64_encode('TextBox13'); ?>" value="<?php echo $creditors_count; ?>" type="number" class="form-control" style="margin-left:5px; width:50px;">
                <p>
                    )
                </p>
            </div>

            <div class="district249 col-md-1"></div>
            <div class="district249 col-md-11 d-flex" style="margin-top: 16px;">
                <label>(c)</label>
                <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes" type="checkbox" class="form-control height_fit_content w-auto">
                <p>
                    {{ __('electronic version filed via CM/ECF') }}
                </p>
            </div>

        </div>
    </div>

    <div class="district249 col-md-4 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('TextBox17'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="date_filed form-control">
        </div>
    </div>
    <div class="district249 col-md-4 mt-3"></div>
    <div class="district249 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox9'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('Signature of Debtor') }}</label>
        </div>
    </div>

    <div class="district249 col-md-4 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('TextBox7'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="date_filed form-control">
        </div>
    </div>
    <div class="2district249 col-md-4 mt-3"></div>
    <div class="2district249 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('Text4'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label>{{ __('Signature of Co-Debtor') }}</label>
        </div>
    </div>

    <div class="district249 col-md-4 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('TextBox8'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="date_filed form-control">
        </div>
    </div>
    <div class="3district249 col-md-4 mt-3"></div>
    <div class="3district249 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('Text5'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label>{{ __('Signature of Attorney') }}</label>
            <textarea name="<?php echo base64_encode('TextBox16'); ?>>" value="" class="form-control mt-3" rows="4" cols="" style="padding-right:5px;"></textarea>
            <p>{{ __('Typed/Printed Name/Address/Telephone') }}</p>
            <input name="<?php echo base64_encode('TextBox15'); ?>" value="" type="text" class="form-control">
            <label>{{ __('District Court I.D. Number') }}</label>
        </div>
    </div>


    <div class="district249 col-md-12 mt-3">
         
    </div>   


</div>
