<div class="row">

    
    <div class="district261 col-md-12 text-center">
        <div class="row">
            <div class="district261 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF TEXAS') }}</h2>
            </div>
        </div>
    </div>
    <div class="district261 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district261 col-md-6 p-3" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('Text30'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <label>{{ __('Debtor(s)') }}</label>
                </div>
            </div>
            <div class="district261 col-md-6 pt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                <div class="district261 col-md-6 pt-2">
                        <label>{{ __('Bankruptcy Case Number:') }}</label>
                    </div>
                    <div class="district261 col-md-6">
                        <input name="<?php echo base64_encode('Text31'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district261 col-md-12">
        <div class="row">
            <div class="district261 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 >{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
            </div>
            <div class="district261 col-md-12">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('The above named Debtor(s) hereby verifies that the attached list of creditors is true and correct to the best of my/our knowledge.') }}
            </p>
            </div>
        </div>
    </div>
    <div class="district261 col-md-3 mt-3">
        <div class="ds261 input-group d-flex">
            <label for="ds261 pt-2">{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Text32'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" id="ds261" class="date_filed form-control">
        </div>
    </div>
    <div class="1district261 col-md-5"></div>
    <div class="1district261 col-md-4 mt-3">
        <div class="1district261 input-group ml-30">
            <input name="<?php echo base64_encode('Text34'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('Debtor Signature') }}</label>
        </div>
    </div>
    <div class="district261 col-md-3 mt-3">
        <div class="district261 input-group d-flex">
            <label for="">{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Text33'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class="district261 col-md-5"></div>
    <div class="district261 col-md-4 mt-3">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('Text35'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label>{{ __('Joint Debtor Signature') }}</label>
        </div>
    </div>

    <div class="district261 col-md-12 mt-3">
         
    </div>   


</div>
