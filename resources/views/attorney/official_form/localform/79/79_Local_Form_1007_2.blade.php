<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF ARIZONA') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor(s) Name"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case Number"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __("Declaration of Evidence of Employers' Payments Within 60 Days") }}</h3>
    </div>
    <div class="col-md-12">
        <div class="d-flex pl-4">
            <div>
                <input type="checkbox" name="<?php echo base64_encode('Check Box1');?>" value="Yes" class="form-control w-auto">
            </div>
            <div>
                <p class=" p_justify">{{ __('Attached hereto are copies of all payment advices, pay stubs or other evidence of payment
                    received by the debtor from any employer within 60 days prior to the filing of the petition;') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <input type="checkbox" name="<?php echo base64_encode('Check Box2');?>" value="Yes" class="form-control w-auto">
            </div>
            <div>
                <p class=" p_justify">{{ __('Debtor has received no payment advices, pay stubs or other evidence of payment
                    from any employer within 60 days prior to the filing of the petition; or') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="pt-2">
                <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="form-control w-auto">
            </div>
            <div>
                <p class=" p_justify">{{ __('Debtor has received the following payments from employers within 60 days prior
                    to the filing of the petition') }}: $ 
                    <input type="text" name="<?php echo base64_encode('Amount of payments');?>" class="form-control w-auto">.</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control w-auto">
            </div>
            <div>
                <p class=" p_justify">{{ __('Debtor declares the foregoing to be true and correct under penalty of perjury.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.inputText name="Text1" class="" value="{{$debtor_sign}}"></x-officialForm.inputText>
        <label for="">{{ __('Signature of Debtor') }}</label>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class=" p_justify">
            {{ __('If attaching pay stubs or other payment advices, it is your responsibility to redact (black out) any social
            security numbers, names of minor children, dates of birth or financial account numbers before attaching
            them to this document.') }}
        </p>
    </div>

</div>