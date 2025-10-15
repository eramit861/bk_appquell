<div class="row">
    <div class="329_joint col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF IDAHO') }}</h3>
    </div>
    <div class="329_joint col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="329_joint col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="{{ __('Case Number:') }}"
            casenoNameField="Text2"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter:') }}"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="329_joint col-md-12 mt-3">
        <h3 class="text-center mb-4">
           {{ __('DEBTOR’S STATEMENT OF DOMESTIC SUPPORT OBLIGATION(S)') }}
        </h3>
        <p class="text_italic border_bottom_1px  pb-2">
            {{ __('If filing jointly, information for joint debtor must be filled out on a separate form.') }}
        </p>
        <p>
        {{ __('Debtor’s name (enter full name):') }}
            <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="{{$spousename ?? ''}}" class="form-control width_50percent">
        </p>
        <p>
        {{ __('Does Debtor have a domestic support obligation:') }}
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
            {{ __('yes') }} <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('CB2'); ?>" value="Yes">
            {{ __('no. If yes, please fill out the rest of this form. If no, do not fill out the rest, but sign where indicated below.') }}
        </p>
        <p>
            <?php
            $debtorspouseemployer = (!empty($income_info['debtorspouseemployer'])) ? $income_info['debtorspouseemployer'] : [];
            $incomedebtoremployer = (!empty($income_info['incomedebtoremployer'])) ? $income_info['incomedebtoremployer'] : [];

            $onejob = Helper::validate_key_value('current_employed', $incomedebtoremployer);
            $secondjob = Helper::validate_key_value('current_employed', $debtorspouseemployer);

            $incomedebtoremployer = $onejob == 1 ? $incomedebtoremployer : [];
            $debtorspouseemployer = $secondjob == 1 ? $debtorspouseemployer : [];
            ?>
            <?php

            $d2name = $partIMain[base64_encode('Employers Name Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_name', $debtorspouseemployer);
            $d2address = $partIMain[base64_encode('Employers Street1 Debtor 2-106I')] ?? Helper::validate_key_value('name_address_spouse_employer', $debtorspouseemployer);
            $d2address2 = $partIMain[base64_encode('Employers Street2 Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_address_line', $debtorspouseemployer);
            $d2city = $partIMain[base64_encode('Employers City Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_city', $debtorspouseemployer);
            $d2state = $partIMain[base64_encode('Employers State Debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_state', $debtorspouseemployer);
            $d2zip = $partIMain[base64_encode('Employers Zip debtor 2-106I')] ?? Helper::validate_key_value('spouse_employer_zip', $debtorspouseemployer);

            $deb2add = [$d2name, $d2address, $d2address2,$d2city, $d2state, $d2zip];
            $deb2fulladd = implode(', ', $deb2add);
            ?>

{{ __('Debtor’s employer’s name, address, and phone number:') }}
            <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="<?php echo $deb2fulladd; ?>" class="form-control width_60percent">
            <input name="<?php echo base64_encode('Text6'); ?>" type="text" value="" class="form-control mt-2">
        </p>
        <p>
        {{ __('Name, address and phone number for the holder of the claim of support:') }} 
            <textarea  name="<?php echo base64_encode('Text7'); ?>" class="form-control mt-1" rows="3"></textarea>
        </p>
        <p class="mt-3">{{ __('AS OF THE DATE OF FILING THE BANKRUPTCY PETITION:') }}</p>
        <p>
        {{ __('Amount of support ob ligation:') }} $<input name="<?php echo base64_encode('Text8'); ?>" type="text" value="" class="form-control w-auto">per
            <input name="<?php echo base64_encode('Text9'); ?>" type="text" value="" class="form-control w-auto">{{ __('(i.e. month, week, etc.)') }}
        </p> 
        <p>
        {{ __('Term of support obligation: from') }}<input name="<?php echo base64_encode('Text10'); ?>" type="text" value="" class="form-control w-auto">
            until <input name="<?php echo base64_encode('Text11'); ?>" type="text" value="" class="form-control w-auto">.
        </p>
        <p>
        {{ __('Amount that the domestic support obligation is in arrears:') }} $<input name="<?php echo base64_encode('Text12'); ?>" type="text" value="" class="form-control w-auto">
        </p>
        <p>
        {{ __('Court name and jurisdiction in which order of support was issued:') }}
            <input name="<?php echo base64_encode('Text13'); ?>" type="text" value="" class="form-control mt-1">
        </p>
        <p>{{ __('Court Case No.') }} <input name="<?php echo base64_encode('Text14'); ?>" type="text" value="" class="form-control width_50percent">.</p>
        <p>
        {{ __('Name, address and phone number of the State child support enforcement agency involved in such claim:') }}
            <textarea  name="<?php echo base64_encode('Text15'); ?>" class="form-control mt-1" rows="3"></textarea>
        </p>
    </div>

    <div class="329_joint col-md-12 mt-2 mb-3">
        <p class="text-center text-bold">
           {{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text16"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div> 
    <div class="col-md-1"></div>
    <div class="col-md-7 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text17"
            currentDate={{$attorneyDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="329_joint col-md-12 mt-3 mb-3">
        <p>
            {{ __('Penalty for making a false statement: Fine up to $250,000 or imprisonment for up to 5 years or both. 18 U.S.C. §§ 152 and 3571') }}
        </p>
    </div>
</div>

<div class="row mt-4">
    <div class="329_joint col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF IDAHO') }}</h3>
    </div>
    <div class="329_joint col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1A"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="329_joint col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case Number:"
                casenoNameField="Text2A"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Text3A"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="329_joint col-md-12 mt-3">
        <h3 class="text-center mb-4">
        {{ __('JOINT DEBTOR’S STATEMENT OF DOMESTIC SUPPORT OBLIGATION(S)') }}
        </h3>
        <p class="text_italic joint2 border_bottom_1px  pb-2">
           {{ __('If filing jointly, information for joint debtor must be filled out on a separate form.') }}
        </p>
        <p>
        {{ __('Debtor’s name (enter full name):') }}
            <input name="<?php echo base64_encode('Text4A'); ?>" type="text" value="{{$spousename}}" class="joint2 form-control width_50percent">
        </p>
        <p>
        {{ __('Does Debtor have a domestic support obligation:') }} 
            <input type="checkbox" class="form-comtrol joint2 width-auto height_fit_content" name="<?php echo base64_encode('Check Box1A'); ?>" value="Yes">
            {{ __('yes') }} <input type="checkbox" class="form-comtrol joint2  width-auto height_fit_content" name="<?php echo base64_encode('CB2A'); ?>" value="Yes">
            {{ __('no. If yes, please fill out the rest of this form. If no, do not fill out the rest, but sign where indicated below.') }}
        </p>
        <p>
        {{ __('Debtor’s employer’s name, address, and phone number:') }}
            <input name="<?php echo base64_encode('Text5A'); ?>" type="text" value="" class="joint2 form-control width_60percent">
            <input name="<?php echo base64_encode('Text6A'); ?>" type="text" value="" class="joint2 form-control mt-2">
        </p>
        <p>
        {{ __('Name, address and phone number for the holder of the claim of support:') }} 
            <textarea  name="<?php echo base64_encode('Text7A'); ?>" class="joint2 form-control mt-1" rows="3"></textarea>
        </p>
        <p class="mt-3">{{ __('AS OF THE DATE OF FILING THE BANKRUPTCY PETITION:') }}</p>
        <p>
        {{ __('Amount of support ob ligation:') }} $<input name="<?php echo base64_encode('Text8A'); ?>" type="text" value="" class="joint2 form-control w-auto">per
            <input name="<?php echo base64_encode('Text9A'); ?>" type="text" value="" class="form-control w-auto">{{ __('(i.e. month, week, etc.)') }}
        </p>
        <p>
        {{ __('Term of support obligation: from') }}<input name="<?php echo base64_encode('Text10A'); ?>" type="text" value="" class="form-control joint2 w-auto">
            until <input name="<?php echo base64_encode('Text11A'); ?>" type="text" value="" class="joint2 form-control w-auto">.
        </p>
        <p>
        {{ __('Amount that the domestic support obligation is in arrears:') }} $<input name="<?php echo base64_encode('Text12A'); ?>" type="text" value="" class="joint2 form-control w-auto">
        </p>
        <p>
        {{ __('Court name and jurisdiction in which order of support was issued:') }}
            <input name="<?php echo base64_encode('Text13A'); ?>" type="text" value="" class="joint2 form-control mt-1">
        </p>
        <p>{{ __('Court Case No.') }} <input name="<?php echo base64_encode('Text14A'); ?>" type="text" value="" class="form-control width_50percent">.</p>
        <p>
        {{ __('Name, address and phone number of the State child support enforcement agency involved in such claim:') }}
            <textarea  name="<?php echo base64_encode('Text15A'); ?>" class="form-control joint2 mt-1" rows="3"></textarea>
        </p>
    </div>

    <div class="329_joint2 col-md-12 mt-2 mb-3">
        <p class="text-center joint2 text-bold">
           {{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text16A"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div> 
    <div class="col-md-1"></div>
    <div class="col-md-7 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text17A"
            currentDate={{$attorneyDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="329_joint col-md-12 mt-3 mb-3">
        <p>
            {{ __('Penalty for making a false statement: Fine up to $250,000 or imprisonment for up to 5 years or both. 18 U.S.C. §§ 152 and 3571') }}
        </p>
    </div>
</div>
    