<div class="row">
       <div class="district138 col-md-12 text-center">
        <div class="row">
            <div class="district138 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('SOUTHERN DISTRICT OF IOWA') }}</h2>
            </div>
        </div>
    </div>
    <div class="district138 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district138 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('DEBTORNAME1'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district138 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district138 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district138 col-md-9">
                        <input name="<?php echo base64_encode('CASENO'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district138 col-md-12">
        <div class="row">
            <div class="district138 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('VERIFICATION OF MASTER ADDRESS LIST') }}<br>{{ __('ON PAPER (CREDITOR MATRIX)') }}</h3> 
            </div>
            <div class="district138 col-md-12">
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ __('I (we) declare under penalty of perjury that I (we) have read the attached Master Address List (creditor matrix), consisting of') }}
                <input name="<?php echo base64_encode('Pages'); ?>" value="<?php echo $creditors_count; ?>"  placeholder="" type="text" class=" form-control" style="width: 50px;">
                {{ __('pages, and that it is true and correct to the best of my (our)
                knowledge, information, and belief.') }}</p>
            </div>
        </div>
    </div>
    <div class="district138 col-md-3 mt-3">
        <div class="district138 input-group d-flex">
            <label for="">{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('SignDate'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $currentDate;?>" class="date_filed form-control">
        </div>
    </div>
    <div class="district138 col-md-5"></div>
    <div class="district138 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <input name="<?php echo base64_encode(''); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control" readonly>
            <label style="width:205px;">{{ __("Debtor's Signature") }}</label>
        </div>
    </div>
    <div class="district138 col-md-3 mt-3">
        <div class="input-group">
        </div>
    </div>
    <div class="district138 col-md-5"></div>
    <div class="district138 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <input name="<?php echo base64_encode(''); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control" readonly>
            <label style="width:205px;">{{ __("Joint Debtor's Signature") }}</label>
        </div>
    </div>

    <div class="district138 col-md-12 mt-3">
         
    </div>   



</div>
