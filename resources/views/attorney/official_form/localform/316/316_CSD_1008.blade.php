<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label></label><br>
                <textarea name="<?php echo base64_encode('TextBox0'); ?>" class="form-control" rows="4" cols="" style="padding-right:5px;">{{$attorneydetails}}</textarea>
            </div>
            <div class="col-md-6 mt-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center" style="border-top:3px solid #000;">
                <label><strong></strong></label><br>
                <label></label><br>
                <label></label>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="border-top:3px solid #000; border-bottom:3px solid #000;">
                <label></label>
                <textarea style="margin-right:40px" name="<?php echo base64_encode('TextBox1'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;">{{$debtorname}}</textarea>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('VERIFICATION OF CREDITOR MATRIX') }}
        </h3>
    </div>

    <div class="row col-md-12 mt-3">
      <div class="input-group">
         <label for=""><u>{{ __('PART I') }}</u> {{ __('(check and complete one):') }}</label>
      </div>
    </div>

    <div class="row col-md-12 mt-3">
      <div class="input-group col-md-8">
         <input name="<?php echo base64_encode(''); ?>" value="" readonly type="checkbox" checked>
         <label for="">{{ __('New petition filed. Creditor') }} <u>{{ __('diskette') }}</u> {{ __('required.') }} </label>
      </div>
      <div class="row col-md-4 input-group">
            <div class="row col-md-8">
                <label for="">{{ __('TOTAL NO. OF CREDITORS:') }}</label>
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('TextBox2'); ?>" value="{{$countCreditors}}" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-3">
      <div class="input-group col-md-12">
         <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
         <label for="">{{ __('Conversion filed on') }} ___________ <i>{{ __('See instructions on reverse side.') }}</i></label><br>
      </div>
    </div>

    <div class="row col-md-12 mt-3">
        <div class="col-md-2"></div>
        <div class="col-md-6 input-group">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('Former Chapter 13 converting. Creditor') }} <u>diskette</u> {{ __('required.') }}</label>
        </div>
        <div class="row col-md-4 input-group">
            <div class="row col-md-8">
                <label for="">{{ __('TOTAL NO. OF CREDITORS:') }}</label>
            </div>
            <div class="col-md-4">
                <input name="<?php echo base64_encode('TextBox3'); ?>" value="" type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-2"></div>
        <div class="col-md-6 input-group">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('Post-petition creditors added.') }} <u>{{ __('Scannable') }}</u> {{ __('matrix required.') }}</label>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-2"></div>
        <div class="col-md-6 input-group">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('There are no post-petition creditors. No matrix required.') }}</label>
        </div>
    </div>
    
    <div class="row col-md-12">
      <div class="input-group col-md-12">
         <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
         <label for="">{{ __('Amendment or Balance of Schedules filed concurrently with this original') }} <u>{{ __('scannable') }}</u> {{ __('matrix affecting Schedule of Debts and/or Schedule of 
            Equity Security Holders.') }} <i>{{ __('See instructions on reverse side.') }}</i></label><br>
      </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-6 input-group">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('Names and addresses are being ADDED.') }}</label>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-6 input-group">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('Names and addresses are being DELETED.') }}</label>
        </div>
    </div>
    <div class="row col-md-12">
        <div class="col-md-4"></div>
        <div class="col-md-6 input-group">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('Names and addresses are being CORRECTED.') }}</label>
        </div>
    </div>

    <div class="row col-md-12 mt-3">
      <div class="input-group">
         <label for=""><u>{{ __('PART II') }}</u> {{ __('(check one):') }}</label>
      </div>
    </div>

    <div class="row col-md-12 mt-3">
        <div class="input-group col-md-12">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox" checked>
            <label for="">{{ __('The above-named Debtor(s) hereby verifies that the list of creditors is true and correct to the best of my (our) knowledge.') }}</label>
        </div>
    </div>
    <div class="row col-md-12 mt-3">
        <div class="input-group col-md-12">
            <input name="<?php echo base64_encode(''); ?>" value="" onclick="return false" type="checkbox">
            <label for="">{{ __('The above-named Debtor(s) hereby verifies that there are no post-petition creditors affected by the filing of the conversion of this case and that 
                the filing of a matrix is not required.') }}</label>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('TextBox6'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('TextBox5'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('Signature of Debtor') }}</label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('INSTRUCTIONS') }}
        </h3>
    </div>


    <div class="col-md-12 mt-3">
        <p>{{ __('1) Full compliance with') }} <u>{{ __('Special Requirements for Mailing Addresses') }}</u> {{ __('(CSD 1007) is required.') }}</p>
        <p>{{ __('2) A creditors matrix with') }} <u>{{ __('Verification') }}</u> {{ __('is required whenever the following occurs:') }}</p>
        <p class="ml-20"> {{ __('a) A new petition is filed. Diskette required.') }}</p>
        <p class="ml-20"> {{ __('b) A case is converted on or after SEPTEMBER 1, 2000. (See paragraph 4b concerning post-petition creditors.)') }}</p>
        <p class="ml-20"> {{ __("c) An amendment to a case on or after SEPTEMBER 1, 2000, which adds, deletes or changes creditor address information on the debtor's Schedule 
            of Debts and/or Schedule of Equity Security Holders. Scannable matrix format required.") }}</p>
        <p>{{ __('3) The scannable matrix must be') }} <u>{{ __('originally') }}</u> {{ __('typed or printed. It may not be a copy.') }}</p>
        <p>{{ __('4) CONVERSIONS:') }}</p>
        <p class="ml-20"> {{ __('a) When converting a Chapter 13 case filed before SEPTEMBER 1, 2000, to another chapter, ALL creditors must be listed on the mailing matrix at the time of filing and accompanied by a Verification. Diskette required.') }}</p>
        <p class="ml-20"> b) {{ __('For Chapter 7, 11, or 12 cases converted on or after SEPTEMBER 1, 2000,') }} <span style="text-decoration-line: underline; text-decoration-style: double;">{{ __('only post-petition creditors need be listed on the 
            mailing matrix') }}</span>{{ __('. The matrix and') }} <u>{{ __('Verification') }}</u> {{ __('must be filed with the post-petition schedule of debts and/or schedule of equity 
            security holders. If there are no post-petition creditors, only the verification form is required. Scannable matrix format required.') }}</p>
        <p>{{ __('5) AMENDMENTS AND BALANCE OF SCHEDULES:') }}</p>
        <p class="ml-20"> a) <u>{{ __('Scannable matrix format required.') }}</u></p>
        <p class="ml-20"> b) {{ __('The matrix with') }} <u>{{ __('Verification') }}</u> {{ __('is a document separate from the amended schedules and may not be used to substitute for any 
            portion of the schedules. IT MUST BE SUBMITTED WITH THE AMENDMENT/BALANCE OF SCHEDULES.') }}</p>
        <p class="ml-20"> c) {{ __('Prepare a separate page for each type of change required: ADDED, DELETED, or CORRECTED. On the') }} <b>{{ __('REVERSE') }}</b> {{ __('side of 
            each matrix page, indicate which category that particular page belongs in. Creditors falling in the same category should be placed
            on the same page in alphabetical order.') }}</p>
        <p>{{ __('6) Please refer to CSD 1007 for additional information on how to avoid matrix-related problems.') }}</p>
    </div>




    <div class="col-md-12 mt-3">
         
    </div>

</div>