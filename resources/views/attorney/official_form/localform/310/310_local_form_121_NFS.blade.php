<div class="row">
    
    <div class="col-md-12"> 
    <p class="text-bold">{{ __("Do not file this form as part of the public case file. This form must be submitted separately and must not be included in the court's public
    electronic records. Please consult local court procedures for submission requirements.") }}</p>
    <p class="text-bold">{{ __('Note: You must also file Official Form 121. Only file this form if you are married and you are NOT filing a joint case with your spouse.') }}</p>
    <p class="text-bold">{{ __('To protect your spouse’s privacy, the court will not make this form available to the public. The court will make only the last four digits of your
    numbers known to the public. However, the full numbers will be available to your creditors, the U.S. Trustee or bankruptcy administrator, and
    the trustee assigned to your case.') }}</p>
    <p class="text-bold">{{ __('Making a false statement, concealing property, or obtaining money or property by fraud in connection with a bankruptcy case can result in
    fines up to $250,000, or imprisonment for up to 20 years, or both. 18 U.S.C. §§ 152, 1341, 1519, and 3571.') }}</p>
    </div>

    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF WISCONSIN') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="In re"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Case No.:"
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class="col-md-12 mt-3 text-center">
        <h3>
            {{ __("STATEMENT OF NON-FILING SPOUSE’S SOCIAL") }}<br>
            {{ __('SECURITY NUMBER(S)') }}
        </h3>
    </div>

    <div class="col-md-4 mt-3">
        <label>{{ __('Name of Spouse if not a Joint Debtor (Last, First, Middle):') }}</label>
    </div>
    <div class="col-md-5 mt-3">
        <input type="text" name="<?php echo base64_encode('Name of Spouse if not a Joint Debtor Last First Middle');?>" class="form-control" value="{{$spousename}}" >
    </div>
    <div class="col-md-3 mt-3">
    </div>

    <div class="col-md-4 mt-1">
        <label>{{ __('Address:') }}</label>
    </div>
    <div class="col-md-5 mt-1">
        <input type="text" name="<?php echo base64_encode('Address');?>" class="form-control" value="{{$spouseaddress}}">
        <input type="text" name="<?php echo base64_encode('Text2');?>" class="form-control mt-1" value="">
    </div>
    <div class="col-md-3 mt-1">
    </div>
   <?php
        $dssnArray[] = "";
        if (Helper::validate_key_value('has_security_number', $BasicInfoPartB) != 1) {
            $dssn = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
            if (preg_match('/-/', $dssn) != 1) {
                $dssnArray[0] = substr($dssn, 0, 3);
                $dssnArray[1] = substr($dssn, 3, 2);
                $dssnArray[2] = substr($dssn, 5, 4);
            } else {
                $dssnArray = explode('-', $dssn);
            }
        }
        ?>
    <div class="col-md-12 mt-2">
        <p class=" mb-2">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5');?>" class="form-control w-auto height_fit_content"> Spouse has a Social Security Number and it is:
            <input type="text" name="<?php echo base64_encode('undefined');?>" class=" form-control w-auto" value="<?php echo !empty($dssnArray[0]) ? $dssnArray[0] : "";?>">
            -
            <input type="text" name="<?php echo base64_encode('demo1');?>" class=" form-control w-auto" value="<?php echo !empty($dssnArray[1]) ? $dssnArray[1] : "";?>">
            -
            <input type="text" name="<?php echo base64_encode('undefined_2');?>" class=" form-control w-auto" value="<?php echo !empty($dssnArray[2]) ? $dssnArray[2] : "";?>">
        </p>
        <p class=" mb-2">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6');?>" class="form-control w-auto height_fit_content"> Spouse has more than one Social Security Number and it is:
            <input type="text" name="<?php echo base64_encode('TextBox0');?>" class=" form-control w-auto">
            -
            <input type="text" name="<?php echo base64_encode('undefined_3');?>" class=" form-control w-auto">
            -
            <input type="text" name="<?php echo base64_encode('undefined_4');?>" class=" form-control w-auto">
        </p>
        <p class=" mb-2">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box7');?>" class="form-control w-auto height_fit_content"> Spouse does not have a Social Security Number but has an Individual Taxpayer-Identification Number (ITIN), and it is:
            <input type="text" name="<?php echo base64_encode('ITIN and it is');?>" class=" form-control w-auto">
            -
            <input type="text" name="<?php echo base64_encode('undefined_5');?>" class=" form-control w-auto">
        </p>
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box8');?>" class="form-control w-auto height_fit_content"> {{ __('Spouse does not have either a Social Security Number or an Individual Taxpayer-Identification Number (ITIN).') }}
        </p>

        <p class="text-bold">
            {{ __('I have filed Official Form 121 or I am filing Official Form 121 with this Local Form 121.') }}
        </p>

        <p class="">
            {{ __('I declare under penalty of perjury that the foregoing is true and correct') }}
        </p>
    </div>

    
    <div class="col-md-6 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor "
            inputFieldName="X"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text3"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" text_italic text-bold mb-2">* {{ __('Check the appropriate boxes above and provide the required information.') }}</p>
        <p class=" text_italic text-bold">* {{ __('If Spouse (if not Joint Debtor) has more than one Social Security Number, state all.') }}</p>
    </div>

</div>