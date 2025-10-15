<div class="row">

    <div class="district234 col-md-12 text-center">
        <div class="row">
            <div class="district234 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('NORTHERN DISTRICT OF OKLAHOMA') }} </h2>
            </div>
        </div>
    </div>
    <div class="district234 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district234 col-md-6 p-3" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox1'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p class="mb-0 p-text-end">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district234 col-md-6 p-3 d-flex">
                <div class="row">
                    <div class="district234 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district234 col-md-9">
                        <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district234 col-md-3 pt-2">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="district234 col-md-9">
                        <input name="<?php echo base64_encode('TextBox3'); ?>" value="<?php echo $chapterNo; ?>" placeholder="" type="text" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district234 col-md-12">
        <div class="row">
            <div class="district234 col-md-12 text-center mb-3" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('VERIFICATION OF OFFICIAL CREDITOR LIST') }}</h3> 
            </div>
            <div class="district234 col-md-3"></div>
            <div class="district234 col-md-3">
                <input name="<?php echo base64_encode('CheckBox0'); ?>" value="YES" placeholder="" type="checkbox" class="form-control w-auto">
                <label>{{ __('Original') }}</label>
            </div>
            <div class="district234 col-md-6"></div>
            <div class="district234 col-md-3"></div>
            <div class="district234 col-md-3">
                <input name="<?php echo base64_encode('CheckBox1'); ?>" value="YES" placeholder="" type="checkbox" class="form-control w-auto">
                <label>{{ __('Amendment') }}</label>
            </div>
            <div class="district234 col-md-6"></div>
            <div class="district234 col-md-3"></div>
            <div class="district234 col-md-2 pl-5">
                <input name="<?php echo base64_encode('CheckBox2'); ?>" value="YES" placeholder="" type="checkbox" class="form-control w-auto ml-3">
                <label>Add</label>
            </div>
            <div class="district234 col-md-3">
                <input name="<?php echo base64_encode('CheckBox3'); ?>" value="YES" placeholder="" type="checkbox" class="form-control w-auto">
                <label>{{ __('Deleting') }}</label>
            </div>
            <div class="district234 col-md-4"></div>
            <div class="district234 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I hereby certify under penalty of perjury that the master mailing list of creditors submitted either on the Creditor List Submission application, or uploaded to the Electronic Case Filing System is a true, correct and complete listing to the best of my knowledge.') }}
                </p>
            </div>
            <div class="district234 col-md-12">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I further acknowledge that (1) the accuracy and completeness in preparing the creditor list are the shared responsibility of the debtor and the debtor’s attorney, (2) the court will rely on the creditor listing for all mailings, and (3) that the various schedules and statements required by the Bankruptcy Rules are not used for mailing purposes.') }}
                </p>
            </div>
            <div class="district234 col-md-12">
                <strong >
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    {{ __('If this filing is an amendment to the creditor list, indicate') }} <u>{{ __('only') }}</u> {{ __('the number of creditors being added or deleted at this time. (For verification purposes, attach a list of the creditors being submitted, uploaded, or to be deleted.)') }}
                </strong>
            </div>
            <div class="district234 col-md-12 d-flex mt-3">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input name="<?php echo base64_encode('TextBox4'); ?>" value="<?php echo $countCreditors; ?>" type="text" class="form-control" style="width:80px;">
                    <p>
                        {{ __('# of Creditors (or if amended, # of creditors added)') }}
                    </p>
            </div>
            <div class="district234 col-md-12 mt-3">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Method of submission:') }}
                </p>
            </div>
            <div class="district234 col-md-1"></div>
            <div class="district234 col-md-11 d-flex">
                <p class="mb-0"><span class="pr-2">(a)</span>
                <input name="<?php echo base64_encode('CheckBox4'); ?>" value="YES" type="checkbox" class="form-control w-auto height_fit_content">
                    {{ __('uploaded to Electronic Case Filing System; or') }}
                </p>
            </div>
            <div class="district234 col-md-1"></div>
            <div class="district234 col-md-11 d-flex" style="margin-top: 16px;">
                <p class="mb-0"><span class="pr-2">(b)</span>
                <input name="<?php echo base64_encode('CheckBox5'); ?>" value="YES" type="checkbox" class="form-control w-auto height_fit_content">
                    {{ __("Creditor List Submission application (to be used by Pro Se Filers, found on the court's website at www.oknb.uscourts.gov, or available in the Clerk's Office)") }}
                </p>
            </div>
            <div class="district234 col-md-12 d-flex mt-3">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input name="<?php echo base64_encode('TextBox0'); ?>" value="" type="text" class="form-control" style="width:80px;">
                <p>
                    {{ __('# of Creditors (on attached list) to be deleted') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox20'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('Debtor Signature') }}</label>
        </div>
    </div>
    <div class="district234 col-md-4 mt-3"></div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox21'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label>{{ __('Joint Debtor Signature') }}</label>
        </div>
    </div>

    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <label>{{ __('Address: (if not represented by an attorney)') }}</label>
            <input name="<?php echo base64_encode('TextBox18'); ?>" value="" type="text" class="form-control">
        </div>
    </div>
    <div class="district234 col-md-4 mt-3"></div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
        <label>{{ __('Address: (if not represented by an attorney)') }}</label>
            <input name="<?php echo base64_encode('TextBox7'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox19'); ?>" value="" type="text" class="form-control">
            <label>{{ __('Phone: (if not represented by an attorney)') }}</label>
        </div>
    </div>
    <div class="district234 col-md-4 mt-3"></div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox8'); ?>" value="" type="text" class="form-control">
            <label>{{ __('Phone: (if not represented by an attorney)') }}</label>
        </div>
    </div>

    <div class="district234 col-md-4 mt-3">
        <div class="district234 input-group d-flex">
            <label for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('TextBox9'); ?>" value="<?php echo $currentDate?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="date_filed form-control">
        </div>
    </div>
    <div class="district234 col-md-4 mt-3"></div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox11'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label>{{ __('Signature of Attorney') }}</label>
        </div>
    </div>

    <div class="district234 col-md-8 mt-3"></div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox12'); ?>" value="" type="text" class="form-control">
            <input name="<?php echo base64_encode('TextBox13'); ?>" value="" type="text" class="mt-3 form-control">
        </div>
    </div>
    
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <label style="font-style:italic;">{{ __('[Check if applicable]') }}</label><br>
            <input name="<?php echo base64_encode('CheckBox6'); ?>" value="YES" type="checkbox" placeholder=""  class="form-control w-auto height_fit_content">
            <label>{{ __('creditors with foreign addressed included') }}</label>
        </div>
    </div>
    <div class="district234 col-md-4 mt-3"></div>
    <div class="district234 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('TextBox14'); ?>" value="" type="text" class="form-control">
            <input name="<?php echo base64_encode('TextBox15'); ?>" value="" type="text" class="mt-3 form-control">
            <input name="<?php echo base64_encode('TextBox16'); ?>" value="" type="text" class="mt-3 form-control">
            <input name="<?php echo base64_encode('TextBox17'); ?>" value="" type="text" class="mt-3 form-control">
            <label>{{ __('Name/OBA#/Address/Telephone #/Email') }}</label>
        </div>
    </div>



    <div class="district234 col-md-12 mt-3">
         
    </div>   


</div>
