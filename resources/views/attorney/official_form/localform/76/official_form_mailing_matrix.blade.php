<div class="row">

    <div class="district76 col-md-12 text-center">
        <div class="row">
            <div class="district76 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('FOR THE SOUTHERN DISTRICT OF ALABAMA') }} </h2>
            </div>
        </div>
    </div>
    <div class="district76 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district76 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group mb-3">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('inre'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <label>{{ __('Debtor(s):') }}</label>
                    <textarea name="<?php echo base64_encode('debtor'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"></textarea>
                </div>
            </div>
            <div class="district76 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district76 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district76 col-md-9">
                        <input name="<?php echo base64_encode('caseno'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district76 col-md-3">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="district76 col-md-9">
                        <input name="<?php echo base64_encode('chapter'); ?>" value="<?php echo $chapterName; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district76 col-md-12">
        <div class="row">
            <div class="district76 col-md-12 text-center mb-3" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('VERIFICATION OF OFFICIAL CREDITOR LIST (INITIAL OR SUPPLEMENTAL)') }}</h3> 
            </div>
            <div class="district76 col-md-3"></div>
            <div class="district76 col-md-3">
                <input name="<?php echo base64_encode('org'); ?>" value="Yes" placeholder="" type="checkbox" style="width:10px;" class=" form-control">
                <label>{{ __('Original') }}</label>
            </div>
            <div class="district76 col-md-6"></div>
            <div class="district76 col-md-3"></div>
            <div class="district76 col-md-3">
                <input name="<?php echo base64_encode('amd'); ?>" value="Yes" placeholder="" type="checkbox" style="width:10px;" class=" form-control">
                <label>{{ __('Amendment') }}</label>
            </div>
            <div class="district76 col-md-6"></div>
            <div class="district76 col-md-3"></div>
            <div class="district76 col-md-3">
                <input name="<?php echo base64_encode('add'); ?>" value="Yes" placeholder="" type="checkbox" style="width:10px;" class=" form-control">
                <label>{{ __('Adding') }}</label>
            </div>
            <div class="district76 col-md-3">
                <input name="<?php echo base64_encode('del'); ?>" value="Yes" placeholder="" type="checkbox" style="width:10px;" class=" form-control">
                <label>{{ __('Deleting') }}</label>
            </div>
            <div class="district76 col-md-3"></div>
            <div class="district76 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I hereby certify under penalty of perjury that the master mailing list of creditors attached and/or uploaded to the Electronic Case Filing System is true, correct and complete to the best of my knowledge.') }}
                </p>
            </div>
            <div class="district76 col-md-12">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I further acknowledge that (1) the accuracy and completeness of the creditor list are the shared responsibility of the debtor and the debtor’s attorney, (2) the court will rely on the creditor list for all mailings, and (3) the various schedules and statements required by the Bankruptcy Rules are not used for mailing purposes.') }}
                </p>
            </div>
            <div class="district76 col-md-12">
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('If you are amending a previously-filed list of creditors, attach a list of only the creditor being added or deleted and indicate below') }} <u>{{ __('only') }}</u> {{ __('the number of creditors being added or deleted..') }}
                </p>
            </div>
            <div class="district76 col-md-2"></div>
            <div class="district76 col-md-10 d-flex">
                <input name="<?php echo base64_encode('cred1'); ?>" value="<?php echo $countCreditors; ?>" type="text" class="form-control" style="width:110px;">
                <p>
                    {{ __('creditor(s) (or if amended, number of creditors added), as shown on attached list') }}
                </p>
            </div>
            <div class="district76 col-md-2"></div>
            <div class="district76 col-md-10 d-flex" style="margin-top: 16px;">
                <input name="<?php echo base64_encode('cred2'); ?>" value="" type="text" class="form-control" style="width:110px;">
                <p>
                    {{ __('creditor(s) to be deleted, as shown on attached list') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district76 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo $debtor_sign?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Debtor Signature') }}</label>
        </div>
    </div>
    <div class="district76 col-md-5 mt-3"></div>
    <div class="district76 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox0'); ?>" value="<?php echo $debtor2_sign?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Joint Debtor Signature') }}</label>
        </div>
    </div>
    <div class="district76 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo $attorny_sign?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Attorney') }}</label>
        </div>
    </div>
    <div class="district76 col-md-5 mt-3"></div>
    <div class="district76 col-md-4 mt-3">
        <div class="district76 input-group d-flex">
            <label class="district76" for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('date'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="district76date_filed form-control">
        </div>
    </div>
    
    <div class="district76 col-md-3 mt-3"></div>  
    <div class="district76 col-md-5 mt-3"></div>
    <div class="district76 col-md-4 mt-3">
        <div class="input-group">
            <label style="font-style: italic;">{{ __('[Check if applicable]') }} </label><br>
            <input name="<?php echo base64_encode('foreign'); ?>" value="Yes" placeholder="" type="checkbox" style="width:10px;" class=" form-control">
            <label>{{ __('Creditors with foreign addresses included') }}</label>
        </div>
    </div>

    <div class="district76 col-md-12 mt-3">
         
    </div>   


</div>
