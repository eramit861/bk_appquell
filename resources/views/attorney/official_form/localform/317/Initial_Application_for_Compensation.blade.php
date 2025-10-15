<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('NORTHERN DISTRICT OF CALIFORNIA') }}</h3>
        </div>
        <div class="col-md-6 pb-2 mt-3 border_bottom_1px border_right_1px">
            <div class="input-grpup">
                <label>{{ __('In re:') }}</label>
                <textarea name="<?php echo base64_encode('TextBox9'); ?>"  class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div> 
            <label>{{ __('Debtor(s).') }}</label>
        </div>
        <div class="col-md-6 mt-3 ">
            <div class="d-flex mb-3">
                <label class="pt-2">{{ __('CASE NO.:') }}</label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('TextBox10'); ?>" placeholder="" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" class=" form-control">
                </div>
            </div>
            <label>{{ __('Chapter 13') }}</label>
            <h3 class="mt-3">{{ __('INITIAL APPLICATION FOR COMPENSATION') }}</h3>
        </div>
        <div class="col-md-12 mt-3">
            <p><span class="ml-4">&nbsp;</span> {{ __('Applicant') }} <input name="<?php echo base64_encode('TextBox2'); ?>" type="text" value="{{$onlyDebtor}}" class="form-control width_24percent"> {{ __('(“Applicant”) hereby submits this') }} <span class="text_italic">{{ __('Initial
                Application for Compensation') }}</span> {{ __('(the “Application”) and requests approval of attorney’s fees in the 
                amount of') }} $<input name="<?php echo base64_encode('TextBox3'); ?>" type="text" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="price-field price-by-attorney form-control width_auto"> {{ __('pursuant to the') }} <span class="text_italic">{{ __('Guidelines for Payment of Attorney’s Fees in Chapter 13 
                Case') }}</span> {{ __('in the above-captioned matter.') }}</p>
            <p><span class="ml-4">&nbsp;</span> {{ __('Applicant filed the') }} <span class="text_italic">{{ __('Rights and Responsibilities of Chapter 13 Debtors and Their 
                Attorneys') }}</span>, {{ __('which was executed by both Applicant and Debtor. See Dkt. No.') }}<input name="<?php echo base64_encode('TextBox4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto"> .</p>
            <p><span class="ml-4">&nbsp;</span> {{ __('Prior to filing this case, Applicant was paid') }} $&nbsp;<input name="<?php echo base64_encode('TextBox5'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> , {{ __('and Applicant requests that 
                additional fees of') }} $<input name="<?php echo base64_encode('TextBox6'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> {{ __('be paid through Debtor’s Chapter 13 Plan pursuant to Section 3.05, 
                upon approval by this Court.') }}</p>
        </div>
        <div class="col-md-12">
            <div class="pl-4 borderless_table">
                <p>{{ __('In addition to the base fee of $4,500, Applicant requests approval of the following fees:') }} </p>
                <table class="text-center w-100">
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox0'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$2,500') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Operating business') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox1'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$1,500') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Real property with secured claim(s) (first parcel)') }} </div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox2'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$800') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Additional real property with secured claim(s) greater than $10,000') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox3'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$800') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Tax claims') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox4'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$300') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('More than 25 creditors') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox5'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$800') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Vehicle loans or leases') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox6'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$800') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Domestic support arrears') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox7'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$800') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Motion to extend or impose automatic stay') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox8'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$1,500') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Motion to avoid judicial lien on real property (11 U.S.C. §522(f))') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox9'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$1,500') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Motion or Adversary Proceeding to value and/or avoid lien on real 
                            property, including obtaining final order (11 U.S.C. § 506)') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox10'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$500') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Motion or Adversary Proceeding to value and/or avoid lien on real 
                            property, including obtaining final order (11 U.S.C. § 506) 
                            [additional lien on same property]') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox11'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$1,100') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Motion to sell, refinance, convey title, purchase real property') }}</div></td>
                    </tr>
                    <tr>
                        <td class="width_5percent"><input name="<?php echo base64_encode('CheckBox12'); ?>" value="YES" type="checkbox"></td>
                        <td class="width_5percent"><div class="float_right">{{ __('$2,600') }}</div></td>
                        <td class="width_9percent"><div class="float_left pl-4">{{ __('Entry into and completion of the Mortgage Modification Mediation 
                            Program [$2,500 fees + $100 costs]') }}</div></td>
                    </tr>
                </table>
            </div> 
        </div>
        <div class="col-md-12 mt-3">
            <p><span class="ml-4">&nbsp;</span> {{ __('Applicant hereby attests under penalty of perjury that the fees requested are reasonable 
                and necessary to representation of the interests of the debtor in connection with the bankruptcy 
                case, and the fees requested comply with the Guidelines for Payment of Attorney’s Fees in 
                Chapter 13 Cases and with the Rights and Responsibilities of Chapter 13 Debtors and their 
                Attorneys.') }}</p>
            <p><span class="ml-4">&nbsp;</span> {{ __('WHEREFORE, Applicant requests that the Court enter an order approving the 
                Application and for such other and further relief as the Court deems just and proper.') }}</p>
        </div>
        <div class="col-md-6 mt-2">
            <div class="input-group d-flex">
                <label class="pt-2">{{ __('Dated:') }} </label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('TextBox7'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <label>{{ __('Respectfully Submitted,') }} </label>
        </div>
        <div class="col-md-6 mt-2">
        </div>
        <div class="col-md-6 mt-2">
            <div class="input-group d-flex">
                <label class="pt-2">{{ __('By:') }} </label>
                <div class="pl-3 w-100">
                    <input name="<?php echo base64_encode('TextBox8'); ?>" type="text" value="" class="form-control">
                </div>
            </div>
        </div>

 
    </div>
</div>
