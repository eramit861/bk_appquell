<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('In the UNITED STATES BANKRUPTCY COURT') }}<br>
        <select name="<?php echo base64_encode('F[0].P1[0].Combo_Box5[0]'); ?>" class="form-control w-auto mr-1">
            <option value="Eastern ">{{ __('Western') }}</option>
            <option value="Western" selected="true">{{ __('Eastern') }}</option>
        </select>
         {{ __('District of Arkansas') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="F[0].P1[0].Text6[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
        <div class="input-group ">
            <textarea name="<?php echo base64_encode('F[0].P1[0].Text7[0]'); ?>" value="" class=" form-control" rows="2" style="padding-right:5px;"></textarea>
            <label>{{ __('Plaintiff(s)') }}</label><br>
            <label>vs.</label>
        </div>
        <div class="input-group ">
            <textarea name="<?php echo base64_encode('F[0].P1[0].Text9[0]'); ?>" value="" class=" form-control" rows="2" style="padding-right:5px;"></textarea>
            <label>{{ __('Defendant(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Bankruptcy Case No:"
                casenoNameField="F[0].P1[0].Text1[0]"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Adversary Proceeding No:"
                casenoNameField="F[0].P1[0].Text8[0]"
                caseno=""
            ></x-officialForm.caseNo>
        </div>           
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('Certificate of Service') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify mb-0">
            I, <input type="text" name="<?php echo base64_encode('F[0].P1[0].Text10[0]'); ?>" class="form-control width_50percent" value="{{$attorney_name}}"> , {{ __('certify that I am, and at all times during the service of
            process was, not less than 18 years of age and not a party to the matter concerning which service of
            process was made. I further certify that service of the summons and a copy of the complaint, in the
            above-styled case, was made') }} <input type="text" name="<?php echo base64_encode('F[0].P1[0].Text11[0]'); ?>" class="form-control width_30percent"> {{ __('by:') }}
        </p>
        <div class="d-flex mt-3">
            <input type="checkbox" name="<?php echo base64_encode('F[0].P1[0].Check_Box12[0]'); ?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="w-100">
                <p class="mb-2">{{ __('Mail service: Regular, first class United States mail, postage fully pre-paid, addressed to:') }}</p>
                <textarea rows="4" class="form-control" name="<?php echo base64_encode('F[0].P1[0].TextField1[0]'); ?>"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <input type="checkbox" name="<?php echo base64_encode('F[0].P1[0].Check_Box13[0]'); ?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="w-100">
                <p class="mb-2">{{ __('Personal Service: By leaving the process with defendant or with an officer or agent of defendant at:') }}</p>
                <textarea rows="4" class="form-control" name="<?php echo base64_encode('F[0].P1[0].TextField2[0]'); ?>"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <input type="checkbox" name="<?php echo base64_encode('F[0].P1[0].Check_Box14[0]'); ?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="w-100">
                <p class="mb-2">{{ __('Residence Service: By leaving the process with the following person of suitable age and discretion (then residing therein) at:') }}</p>
                <textarea rows="4" class="form-control" name="<?php echo base64_encode('F[0].P1[0].TextField3[0]'); ?>"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <input type="checkbox" name="<?php echo base64_encode('F[0].P1[0].Check_Box15[0]'); ?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="w-100">
                <p class="mb-2">{{ __('Publication: The defendant was served as follows: [Describe briefly]') }}</p>
                <textarea rows="4" class="form-control" name="<?php echo base64_encode('F[0].P1[0].TextField4[0]'); ?>"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <input type="checkbox" name="<?php echo base64_encode('F[0].P1[0].Check_Box16[0]'); ?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="w-100">
                <p class="mb-2">{{ __('State Law: The defendant was served pursuant to the laws of the State of') }} <input type="text"  name="<?php echo base64_encode('F[0].P1[0].Text17[0]'); ?>" class="form-control w-auto">{{ __(', as follows: [Describe briefly]') }}</p>
                <textarea rows="4" class="form-control" name="<?php echo base64_encode('F[0].P1[0].Text18[0]'); ?>"></textarea>
            </div>
        </div>
        <p class="mt-3">
            {{ __('Under penalty of perjury, I declare that the foregoing is true and correct.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="F[0].P1[0].Text20[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-6 mt-3">
        <div>
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="F[0].P1[0].Text19[0]"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="pl-2 mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Signature: /s/"
                inputFieldName="TextBox0"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>