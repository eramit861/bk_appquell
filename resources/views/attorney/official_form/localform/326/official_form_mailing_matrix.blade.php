<div class="row">

    <div class="district326 col-md-12 text-center">
        <div class="row">
            <div class="district326 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('WESTERN DISTRICT OF ARKANSAS') }} </h2>
            </div>
        </div>
    </div>
    @include("attorney.official_form.localform.common_details")



    
    <div class="district326 col-md-12">
        <div class="row">
            <div class="district326 col-md-12 text-center mb-3" style="margin-top: 1rem !important;">
                <h3>{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
            </div>
            <div class="district326 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ __('The above-named Debtor hereby verifies that the attached list of creditors is true and correct to the best of his/her knowledge.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district326 col-md-3 mt-3">
        <div class="district326 input-group d-flex">
            <label for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('TextBox3'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="date_filed form-control">
            
        </div>
    </div>
    <div class="district326 col-md-5 mt-3"></div>
    <div class="district326 col-md-4 mt-3">
        <div class="input-groups">
            <input name="<?php echo base64_encode('TextBox4'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Debtor') }}</label>
        </div>
    </div>

    <div class="district326 col-md-12 mt-3">
         
    </div>   


</div>
