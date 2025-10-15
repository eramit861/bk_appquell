<div class="row">
    <div class="col-md-12 text-center mb-3">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('FOR THE SOUTHERN DISTRICT OF TEXAS') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="d-flex">
            <div class="w-100">
                <label>{{ __('In re:') }}</label>
                <textarea name="<?php echo base64_encode('Text1'); ?>" class="form-control" rows="4" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div>
            <div class="pt-3 pl-2">
                <p>§</p>
                <p>§</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center"> 
        {{ __("JOINT DEBTOR'S CERTIFICATION") }}<br>{{ __('REGARDING NECESSITY OF FILING PAYMENT ADVICES') }}</h3>
           <p class="mt-3 p_justify">
            <span class="pl-4"></span>{{ __('My name is') }}        
            <input name="<?php echo base64_encode('Text3');?>" value="{{$spousename}}" type="text" class="form-control width_30percent mt-1">{{ __('. I am a Joint
            debtor in this bankruptcy case. I declare that I did not receive any payment
            advices or other evidence of payment from any employer during the 60 days before the
            date of the filing of the bankruptcy petition. If this case is a joint case, both spouses
            have signed below to make this declaration jointly with respect to both.') }}
        </p>
        <p  class="p_justify">
            <span class="pl-4"></span>{{ __('I declare under penalty of perjury under the laws of the United States of America
            that the foregoing is true and correct.') }}
        </p>
         <p><span class="pl-4"></span>{{ __('Executed on') }} <input name="<?php echo base64_encode('Text4');?>" value="{{$currentDate}}" type="text" class="form-control w-auto mt-1">{{ __('(date).') }}</p>
    </div>
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text5"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Joint Debtor (if joint case)"
                inputFieldName="Text6"
                inputValue="{{$debtor2_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>