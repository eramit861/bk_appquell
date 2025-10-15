<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('1003Attorney'); ?>"  class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
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
                <textarea style="margin-right:40px" name="<?php echo base64_encode('1003Debtor'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
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
                    <input name="<?php echo base64_encode('1003CaseNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('NOTICE OF RELATED CASE') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('TO THE CLERK OF COURT:') }}
        </p>
    </div>  

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('You are hereby advised that this case is related to the case indicated below. The related case is or was pending within the past three (3) years of the filing of the later petition. In accordance with Local Bankruptcy Rule 1015-2 this form is to be filed with the Court and served on the U.S. Trustee.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-12">
        <div class="col-md-2">
                <label>{{ __('RELATED CASE:') }}</label>
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('1003RelatedCase'); ?>" value="" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('CASE NO.:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1003RelatedCaseNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('DATE FILED:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1003DateFiled'); ?>" value="" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        {{ __('Neither case is a chapter 13 and the relationship is based upon the fact that') }} (<i>{{ __('check all appropriate boxes') }}</i>):
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group">
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox1'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtors in both cases are the same entity') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox2'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtors in both cases are spouses or former spouses') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox3'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtors in both cases are partners') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox4'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtor in one case is a general partner of the debtor in the other case') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox5'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtor in one case is an "affiliate," as that term is defined at 11 U.S.C. § 101(2), of the debtor in the other
                case') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox6'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtors are corporations and have one or more common shareholder which owns twenty percent (20%)
                or more of each corporation') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox7'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtors are partnerships and have one or more common general partner') }};<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox8'); ?>" value="Yes" type="checkbox"> 
                {{ __('the debtor in one case has, or within 180 days of the commencement of either of the related cases had, an 
                interest in property that as or is included in the property of the other estate under 11 U.S.C. § 541(a); or') }}<br>
            </div>
            <div class="input-group d-flex">
                <input name="<?php echo base64_encode('1003ChBox9'); ?>" value="Yes" type="checkbox"> 
                {{ __('the cases are otherwise so related as to warrant being treated as related to promote efficient administration
                of the estates.') }}<br>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('1003Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control height_fit_content w-auto">
        </div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('1003AttySign'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label>{{ __('Attorney for Debtor') }}</label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
         
    </div>

</div>