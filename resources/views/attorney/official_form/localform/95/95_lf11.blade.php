<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
            <select name="<?php echo base64_encode('topmostSubform[0].Page1[0].Division[0]');?>" class="form-control w-auto">
                <option></option>
                <option value="GAINESVILLE">{{ __('GAINSVILLE') }}</option>
                <option value="TALLAHASSEE">{{ __('TALLAHASSEE') }}</option>
                <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
                <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
            </select>
            {{ __('DIVISION') }}
        </h3> 
    </div>

    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].DbtrNames[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="topmostSubform[0].Page1[0].CaseNo[0]"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="topmostSubform[0].Page1[0].Chapter[0]"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('Notice of Change of Address for Creditor') }}</h3>
    </div>

    <div class="col-md-12 mt-3 text-bold">
        <p class="mb-1">{{ __('Creditor Name:') }}</p>
        <div class="pl-4">
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CreditorName[0]');?>" class="form-control">
        </div>
        <p class="mb-1 mt-3">{{ __("Creditor's former mailing address:") }}</p>
        <div class="pl-4">
            <textarea name="<?php echo base64_encode('topmostSubform[0].Page1[0].OldAddress[0]');?>" class="form-control" rows="6"></textarea>
        </div>
        <p class="mb-1 mt-3">
        {{ __('Effective') }} 
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].EffectiveDate[0]');?>" class="form-control w-auto">
            {{ __(', the new mailing address is:') }}
        </p>
        <div class="pl-4 mt-2">
            <textarea name="<?php echo base64_encode('topmostSubform[0].Page1[0].NewAddress[0]');?>" class="form-control" rows="6"></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <p class="mb-2"><span class="text-bold">{{ __('This new address applies to') }}</span> {{ __('(check one):') }}</p>
        <p>
            <input type="radio" name="<?php echo base64_encode('Group1');?>" class="form-control w-auto height_fit_content ml-4" value="Choice1">
            {{ __('Mailing Matrix Only') }}
            <input type="radio" name="<?php echo base64_encode('Group1');?>" class="form-control w-auto height_fit_content ml-4" value="Choice2">
            {{ __('Claim Payment Address Only') }}
            <input type="radio" name="<?php echo base64_encode('Group1');?>" class="form-control w-auto height_fit_content ml-4" value="Choice3">
            {{ __('Both') }}
        </p>
    </div>

    <div class="col-md-6 pt-2">
        <label class="float_right">{{ __('Claim Number(s):') }}</label>
    </div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].ClaimNos[0]');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('');?>" class="form-control mt-1 bg-none" disabled="true">
        <label for="">{{ __('Signature of Creditor or Creditor Representative') }}</label>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name"
                inputFieldName="topmostSubform[0].Page1[0].PrintedName[0]"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>    
        </div>
    </div>

    <div class="col-md-12">
        <p class="text-bold text_italic">
            {{ __('NOTE: The Clerk will not change a claim payment address when the creditor name on the Notice of Change of Address 
            for Creditor differs from the creditor name on the Proof of Claim.') }}
        </p>
    </div>

</div>