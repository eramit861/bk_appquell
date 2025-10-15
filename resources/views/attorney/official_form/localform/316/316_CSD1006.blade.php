<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('1006Attorney'); ?>" class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
            </div>
            <div class="col-md-6 mt-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center" style="border-top:3px solid #000;">
                <label><strong>{{ __('UNITED STATES BANKRUPTCY COURT') }}</strong></label><br>
                <label>{{ __('SOUTHERN DISTRICT OF CALIFORNIA') }}</label><br>
                <label>{{ __('325 West F Street, San Diego, California 92101-6991') }}</label>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="border-top:3px solid #000; border-bottom:3px solid #000;">
                <label>{{ __('In Re') }}</label>
                <textarea style="margin-right:40px" name="<?php echo base64_encode('1006Debtor'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                <div class="row">
                    <div class="col-md-8">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('Debtor.') }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                    <label>{{ __('BANKRUPTCY NO.') }}</label>
                    <input name="<?php echo base64_encode('1006CaseNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('APPLICATION TO PAY FILING FEES IN INSTALLMENTS') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('In accordance with FRBP 1006, application is made for permission to pay half the filing fee at the time the petition is filed with the balance of the fee in not more than one installment due within 30 days of petition file date. (check one):') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group">
            <div class="d-flex col-md-12">
                <div class="col-md-6 input-group d-flex">
                    <input name="<?php echo base64_encode('1006ChBox1'); ?>" value="1" type="checkbox"> 
                    {{ __('Chapter 7 payment of') }} &nbsp;<u>{{ __('$169.00') }}</u><br>
                </div>
                <div class="col-md-6 input-group d-flex">
                    <input name="<?php echo base64_encode('1006ChBox1'); ?>" value="3" type="checkbox"> 
                    {{ __('Chapter 13 payment of') }} &nbsp;<u>{{ __('$156.50') }}</u><br>
                </div>
            </div>
            <div class="d-flex col-md-12">
                <div class="col-md-6 input-group d-flex">
                    <input name="<?php echo base64_encode('1006ChBox1'); ?>" value="2" type="checkbox"> 
                    {{ __('Chapter 11 payment of') }} &nbsp;<u>{{ __('$869.00') }}</u><br>
                </div>
                <div class="col-md-6 input-group d-flex">
                    <input name="<?php echo base64_encode('1006ChBox1'); ?>" value="4" type="checkbox"> 
                    {{ __('Chapter 12 payment of') }} &nbsp;<u>{{ __('$139.00') }}</u><br>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I certify that I am unable to pay the filing fee except in installments and I understand the following:') }} 
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I must pay my entire fee before I make any more payments or transfer any more property to an attorney, bankruptcy petition preparer, or anyone else for services in connection with my bankruptcy case.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I must pay the entire fee no later than 30 days after I first file for bankruptcy, unless the Court later extends my Deadline. My debts will not be discharged until my entire fee is paid.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('If I do not make my payment when it is due, my bankruptcy case may be dismissed, and my rights in other bankruptcy proceedings may be affected.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Dated:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1006Date1'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('Signed:') }}</label>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input name="<?php echo base64_encode('1006DebtSign'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
                    <label>{{ __('Signature of Debtor') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Dated:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1006Date2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('Signed:') }}</label>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input name="<?php echo base64_encode('1006CoDebtSign'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
                    <label>{{ __('Signature of Joint Debtor (if any)') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label></label>
            </div>
            <div class="col-md-8">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label></label>
            </div>
            <div class="col-md-8">
                <div class="input-group">
                    <input name="<?php echo base64_encode('1006DebtAttySign'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
                    <label>{{ __('Attorney for Debtor(s)') }}</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-3 text-center">
        <p class="text-center"  style="border:3px solid #000; background: lightgrey; padding: 15px">
        {{ __("If this document is prepared by a') }} <strong>{{ __('Non-Attorney Bankruptcy Petition Preparer') }}</strong>{{ __(', the form 
            119, Bankruptcy Petition Preparer's Notice, Declaration, and Signature, must be completed and 
            submitted with this Application.") }}
        </p>
    </div>


    <div class="col-md-12 mt-3">
         
    </div>

</div>