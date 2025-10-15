<div class="row">
<input type="hidden" name="<?php echo base64_encode('TextBox0'); ?>" value="NORTHERN DISTRICT OF MISSISSIPPI">
<input type="hidden" name="<?php echo base64_encode('TextBox2'); ?>" value="{{$chapterNo}}">
    <div class="district174 col-md-12 text-center">
        <div class="row">
            <div class="district174 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('NORTHERN DISTRICT OF MISSISSIPPI') }} </h2>
            </div>
        </div>
    </div>
    <div class="district174 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district174 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="district174 input-group mb-3">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox3'); ?>>" value="" class="district174 form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district174 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district174 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district174 col-md-9">
                        <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : $caseno; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district174 col-md-12">
        <div class="row">
            <div class="district174 col-md-12 text-center mb-3" style="margin-top: 1rem !important;">
                <h3 style="text-decoration:underline;">{{ __('VERIFICATION OF MATRIX') }}</h3> 
            </div>
            <div class="district174 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('The undersigned Debtor(s) hereby verifies that the attached list of creditors is true and correct.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district174 col-md-3 mt-3">
        <div class="district174 input-group d-flex">
            <label for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('TextBox4'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="date_filed form-control">
            
        </div>
    </div>
    <div class="district174 col-md-5 mt-3"></div>
    <div class="district174 col-md-4 mt-3">
        <div class="input-groups">
            <input name="<?php echo base64_encode('TextBox5a'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Debtor') }}</label>
        </div>
    </div>

    <div class="district174 col-md-8 mt-3"></div>
    <div class="district174 col-md-4 mt-3">
        <div class="input-groups">
            <input name="<?php echo base64_encode('TextBox6a'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Joint Debtor') }}</label>
        </div>
    </div>

    <div class="district174 col-md-12 mt-3">
         
    </div>   


</div>
