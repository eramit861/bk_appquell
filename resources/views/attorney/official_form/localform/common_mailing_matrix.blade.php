<div class="cmmatrix row">
<?php
$name = $onlyDebtor.' and '. $spousename;
?>
    <div class="cmmatrix col-md-12">
    <div class="cmmatrix row text-center">
    <div class="cmmatrix col-md-4"></div> <div class="cmmatrix col-md-4">
        <h2>{{ __('United States Bankruptcy Court') }}
        
        </h2> 
            </div> 
        <div class="cmmatrix col-md-4"></div>
    <div class="cmmatrix col-md-4"></div> <div class="cmmatrix col-md-4">
    <input name="<?php echo base64_encode('TextBox0'); ?>" value="<?php echo $district_attorney;?>"  placeholder="" type="text" class="fs-h2 form-control">
    </div>  <div class="cmmatrix col-md-4"></div>
    </div>
    </div>

    <div class="cmmatrix col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="cmmatrix row">
            <div class="cmmatrix col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="cmmatrix commonl input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox3'); ?>>" value="" class="commonl form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>

            <div class="cmmatrix col-md-6 mt-3 d-flex">
                <div class="cmmatrix row" style="margin-top: 14px;">
                    <div class="cmmatrix col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>

                    <div class="cmmatrix col-md-9">
                        <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>

                    <div class="cmmatrix col-md-3">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>

                    <div class="cmmatrix col-md-9">
                        <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo $chapterNo; ?>"  placeholder="" type="text" class=" form-control">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="cmmatrix col-md-12">
        <div class="cmmatrix row">
            <div class="cmmatrix col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3>{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
            </div>

            <div class="cmmatrix col-md-12">
            <p>
                {{ __('The above-named Debtor hereby verifies that 
                the attached list of creditors is true and correct to the best of his/her knowledge.') }}</p>
            </div>

        </div>
    </div>
    <div class="cmmatrix col-md-3 mt-3">
        <div class="cmmatrix input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('TextBox4'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>

    <div class="cmmatrix col-md-6"></div>
    <div class="cmmatrix col-md-3 mt-3">
        <div class="cmmatrix input-group ml-30 text-center">
            <input name="<?php echo base64_encode('TextBox5a'); ?>" value="<?php echo $debtor_sign?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Debtor 1') }} </label>
        </div>
    </div>

    <div class="cmmatrix col-md-9"></div>
    <div class="cmmatrix col-md-3 mt-3">
        <div class="cmmatrix input-group ml-30 text-center">
            <input name="<?php echo base64_encode('TextBox6a'); ?>" value="<?php echo $debtor2_sign?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Debtor 2') }} </label>
        </div>
    </div>
   
</div>
<style>
    .col-md-12.float-left .input-group {
        float: left;width: 20%;
    }
</style>