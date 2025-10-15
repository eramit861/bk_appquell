<div class="row">
    
    <div class="district167 col-md-12 text-center">
        <div class="row">
            <div class="district167 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF MICHIGAN') }}</h2>
            </div>
        </div>
    </div>
    <div class="district167 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district167 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('IN RE'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district167 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district167 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district167 col-md-9">
                        <input name="<?php echo base64_encode('Case No'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district167 col-md-12">
        <div class="row">
            <div class="district167 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('Verification of Creditor Matrix') }}</h3> 
            </div>
            <div class="district167 col-md-12">
            <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I (We), hereby declare, under penalty of perjury, that the attached list of creditors is true and correct to the best of my (our) knowledge.') }}</p>
            </div>
        </div>
    </div>
    <div class="district167 col-md-3 mt-3">
        <div class="district167 input-group d-flex">
            <label class="district167" for="">{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="<?php echo $currentDate;?>}" class="date_filed district167 form-control">
        </div>
    </div>
    <div class="district167 col-md-5"></div>
    <div class="district167 col-md-4 mt-3">
        <div class="input-group ml-30 ">
            <input name="<?php echo base64_encode('Attorney for the Debtors'); ?>" value="<?php echo $attorney_name;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Attorney for the Debtor(s)') }}</label>
        </div>
    </div>
    <div class="district167 col-md-3 mt-3"></div>
    <div class="district167 col-md-5"></div>
    <div class="district167 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <label style="width:205px;">{{ __('- OR -') }}</label>
        </div>
    </div>
    <div class="district167 col-md-3 mt-3"></div>
    <div class="district167 col-md-5"></div>
    <div class="district167 col-md-4 mt-3">
        <div class="input-group ml-30 ">
            <input name="<?php echo base64_encode('Debtor'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Debtor') }}</label>
        </div>
    </div>
    <div class="district167 col-md-3 mt-3"></div>
    <div class="district167 col-md-5"></div>
    <div class="district167 col-md-4 mt-3">
        <div class="input-group ml-30 ">
            <input name="<?php echo base64_encode('Joint Debtor if any'); ?>" value="<?php echo $spousename;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Joint Debtor') }}</label>
        </div>
    </div>

    <div class="district167 col-md-12 mt-3">
         
    </div>

</div>
