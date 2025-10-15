<div class="row">

           <div class="district141 col-md-12 text-center">
        <div class="row">
            <div class="district141 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF KANSAS') }}</h2>
            </div>
        </div>
    </div>
    <div class="district141 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district141 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('DebtorName'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district141 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district141 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district141 col-md-9">
                        <input name="<?php echo base64_encode('CaseNo'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district141 col-md-12">
        <div class="row">
            <div class="district141 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
            </div>
            <div class="district141 col-md-12">
            <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('The above-named Debtor(s) hereby verify that the attached list of creditors is true and correct to the best of her/his/their knowledge.') }}</p>
            </div>
        </div>
    </div>
    <div class="district141 col-md-3 mt-3">
        <div class="district141 input-group d-flex">
            <label for="">{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Dated'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class="district141 col-md-5"></div>
    <div class="district141 col-md-4 mt-3">
        <div class="input-group ml-30 ">
            <input name="<?php echo base64_encode('DebtorSig'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Debtor') }}</label>
        </div>
    </div>
    <div class="district141 col-md-3 mt-3">
        <div class="input-group">
        </div>
    </div>
    <div class="district141 col-md-5"></div>
    <div class="district141 col-md-4 mt-3">
        <div class="input-group ml-30 ">
            <input name="<?php echo base64_encode('JointDebtorSig'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Joint Debtor') }}</label>
        </div>
    </div>

    <div class="district141 col-md-12 mt-3">
         
    </div>  

</div>
