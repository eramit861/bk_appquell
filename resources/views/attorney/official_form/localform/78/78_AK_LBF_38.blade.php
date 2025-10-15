<div class="row">
    <div class="col-md-6 border_1px p-3 br-0 bb-0">
        <textarea name="<?php echo base64_encode('Text11');?>" class="form-control" rows="10"></textarea>
    </div>
    <div class="col-md-6 border_1px p-3 bb-0">
        <label class="float_right">{{ __('AK LBF 38') }}</label><br>
        <label class="float_right">{{ __('[11/15]') }}</label>
    </div>
    <div class="col-md-12 p-3 border_1px bb-0">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF ALASKA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text12"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text13"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Text14"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <p class="mt-3 text-bold">
        {{ __('STATEMENT UNDER PENALTY OF PERJURY') }}<br>
            {{ __('CONCERNING PAYMENT ADVICES DUE') }}<br>  
            {{ __('PURSUANT TO 11 U.S.C. § 521(a)(1)(B)(iv)') }}<br>
       </p>
    </div>
    <div class="col-md-12 mt-3 pl-0">
        <p><span class="pl-4"></span> I <input name="<?php echo base64_encode('Text15'); ?>" type="text" value="" class="form-control width_30percent">{{ __(', state as follows:') }}</p>
        <p class="p_justify"><span class="pl-4"></span>
            {{ __('I have not filed with the court copies of all payment advice or other evidence of payment received within 60 days prior to the filing of my petition from
            any employer because:') }}
        </p>
        <div class="d-flex pl-4 mt-1">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Check Box16'); ?>" value="Yes">
            <div>
                <span>{{ __('I am self-employed and did not receive any payments from an employer within the 60-day period before the filing of my petition;') }}</span>
            </div>
        </div>
        <div class="d-flex pl-4 mt-1">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Check Box17'); ?>" value="Yes">
            <div>
                <span>{{ __('My only income during the 60-day period before the filing of my petition was from Social Security, pensions, or disability payments, or from rental or investment income.') }}</span>
            </div>
        </div>
        <div class="d-flex pl-4 mt-1">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Check Box18'); ?>" value="Yes">
            <div>
                <span>{{ __('I was not employed during the 60 day period immediately preceding the filing of my petition.') }}</span>
            </div>
        </div>
        <div class="d-flex pl-4 mt-1">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content mt-2" name="<?php echo base64_encode('Check Box19'); ?>" value="Yes">
            <div class="w-100">
                <span>{{ __('Other. Specify') }}:<input name="<?php echo base64_encode('Text20'); ?>" type="text" value="" class="form-control width_90percent"></span>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-2 pl-0">
        <p class="p_justify"><span class="pl-4"></span>
            {{ __('I declare, under penalty of perjury under the laws of the United States of America that the foregoing is true and correct.') }}
        </p>
    </div>
    <div class="col-md-12 pl-4 mt-2">
    <p class="mb-0">{{ __('Executed on') }}  <input name="<?php echo base64_encode('Text21'); ?>" type="text" value="{{$currentDate}}" class="form-control w-auto date_filed" placeholder="{{ __('MM/DD/YYYY') }}"></p>
        <div class="row">
            <div class="col-md-2 pr-0">
            </div>
            <div class="col-md-3 pl-0">
                <p>{{ __('Date') }}</p>
            </div>
            <div class="col-md-7">
            </div>
        </div>
    </div> 
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <input name="<?php echo base64_encode('Text22'); ?>" type="text" value="{{$debtor_sign}}" class="form-control">
        <p>{{ __('(signature of debtor)') }}</p>
    </div>
</div>
   