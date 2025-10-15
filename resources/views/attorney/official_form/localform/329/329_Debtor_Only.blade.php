<div class="row">
    <div class="329debtor col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF IDAHO') }}</h3>
    </div>
    <div class="329debtor col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="329debtor col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case Number:"
                casenoNameField="Text2"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="329debtor col-md-12 mt-3">
        <h3 class="text-center mb-4">
            {{ __('DEBTOR’S STATEMENT OF DOMESTIC SUPPORT OBLIGATION(S)') }}
        </h3>
        <p class="text_italic border_bottom_1px  pb-2">
            {{ __('If filing jointly, information for joint debtor must be filled out on a separate form.') }}
        </p>
        <p>
        {{ __('Debtor’s name (enter full name):') }}
            <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="{{$onlyDebtor ?? ''}}" class="form-control width_50percent">
        </p>
        <p>
        {{ __('Does Debtor have a domestic support obligation:') }} 
            <input type="checkbox" class="form-comtrol 329debtor width-auto height_fit_content" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
            {{ __('yes') }} <input type="checkbox" class="form-comtrol 329debtor width-auto height_fit_content" name="<?php echo base64_encode('CB2'); ?>" value="Yes">
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

            $dname = $partIMain[base64_encode('Employers Name Debtor 1-106I')] ?? Helper::validate_key_value('employer_name', $incomedebtoremployer);
            $daddress = $partIMain[base64_encode('Employers Street1 Debtor 1-106I')] ?? Helper::validate_key_value('name_address_employer', $incomedebtoremployer);
            $daddress2 = $partIMain[base64_encode('Employers Street2 Debtor 1-106I')] ?? Helper::validate_key_value('employer_address_line', $incomedebtoremployer);
            $dcity = $partIMain[base64_encode('Employers City Debtor 1-106I')] ?? Helper::validate_key_value('employer_city', $incomedebtoremployer);
            $dstate = $partIMain[base64_encode('Employers State Debtor 1-106I')] ?? Helper::validate_key_value('employer_state', $incomedebtoremployer);
            $dzip = $partIMain[base64_encode('Employers Zip debtor 1-106I')] ?? Helper::validate_key_value('employer_zip', $incomedebtoremployer);

            $debadd = [$dname, $daddress, $daddress2,$dcity, $dstate, $dzip];
            $debfulladd = implode(', ', $debadd);
            ?>
            {{ __('Debtor’s employer’s name, address, and phone number:') }}
            <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="{{$debfulladd ?? ''}}" class="form-control width_60percent">
            <input name="<?php echo base64_encode('Text6'); ?>" type="text" value="" class="form-control mt-2">
        </p>
        <p>
        {{ __('Name, address and phone number for the holder of the claim of support:') }} 
            <textarea  name="<?php echo base64_encode('Text7'); ?>" class="form-control 329debtor mt-1" rows="3"></textarea>
        </p>
        <p class="mt-3 329debtor">{{ __('AS OF THE DATE OF FILING THE BANKRUPTCY PETITION:') }}</p>
        <p>
        {{ __('Amount of support ob ligation:') }} $<input name="<?php echo base64_encode('Text8'); ?>" type="text" value="" class="form-control 329debtor w-auto">per
            <input name="<?php echo base64_encode('Text9'); ?>" type="text" value="" class="form-control 329debtor w-auto">{{ __('(i.e. month, week, etc.)') }}
        </p>
        <p>
        {{ __('Term of support obligation: from') }}<input name="<?php echo base64_encode('Text10'); ?>" type="text" value="" class="form-control 329debtor w-auto">
            until <input name="<?php echo base64_encode('Text11'); ?>" type="text" value="" class="form-control 329debtor w-auto">.
        </p>
        <p>
        {{ __('Amount that the domestic support obligation is in arrears:') }} $<input name="<?php echo base64_encode('Text12'); ?>" type="text" value="" class="form-control 329debtor w-auto">
        </p>
        <p>
        {{ __('Court name and jurisdiction in which order of support was issued:') }}
            <input name="<?php echo base64_encode('Text13'); ?>" type="text" value="" class="form-control 329debtor mt-1">
        </p>
        <p>{{ __('Court Case No.') }} <input name="<?php echo base64_encode('Text14'); ?>" type="text" value="" class="form-control 329debtor width_50percent">.</p>
        <p>
        {{ __('Name, address and phone number of the State child support enforcement agency involved in such claim:') }}
            <textarea  name="<?php echo base64_encode('Text15'); ?>" class="form-control 329debtor mt-1" rows="3"></textarea>
        </p>
    </div>

    <div class="329debtor col-md-12 329debtor mt-2 mb-3">
        <p class="text-center 329debtor text-bold">
           {{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    <div class="col-md-4 mt-2 text-bold">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text16"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div> 
    <div class="col-md-1"></div>
    <div class="col-md-7 mt-2 text-bold text-center">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text17"
            currentDate="{{$attorneyDate}}"
        ></x-officialForm.dateSingle>
    </div>
    <div class="329debtor col-md-12 mt-3 mb-3">
        <p>
            {{ __('Penalty for making a false statement: Fine up to $250,000 or imprisonment for up to 5 years or both. 18 U.S.C. §§ 152 and 3571') }}
        </p>
    </div>
</div>
