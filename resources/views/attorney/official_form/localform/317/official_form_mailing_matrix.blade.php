<div class="row">

<div class="district317 col-md-12 text-center">
    <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('NORTHERN DISTRICT OF CALIFORNIA') }}</h2>
</div>
<div class="district317 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district317 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="district317 input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox3'); ?>>" value="" class="district317 form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district317 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district317 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district317 col-md-9">
                        <input name="<?php echo base64_encode('TextBox4'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district317 col-md-12">
        <div class="row">
            <div class="district317 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('CREDITOR MATRIX COVER SHEET') }}</h3> 
            </div>
            <div class="district317 col-md-12">
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ __('I declare that the attached Creditor Mailing Matrix, consisting of') }} 
                <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo $creditors_count; ?>"  placeholder="" type="text" class=" form-control" style="width: 50px;">
                {{ __("sheets, contains the correct, complete and current names and addresses of all priority, secured and unsecured creditors listed in debtor's filing
                and that this matrix conforms with the Clerk's promulgated requirements..") }}</p>
            </div>
        </div>
    </div>
    <div class="district317 col-md-3 mt-3">
        <div class="district317 input-group d-flex">
            <label for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('TextBox0'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class="district317 col-md-5"></div>
    <div class="district317 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __("Signature of Debtor's Attorney or Pro Per Debtor") }} </label>
        </div>
    </div>
    <div class="district317 col-md-12 mt-3">
         
    </div>   
</div>
