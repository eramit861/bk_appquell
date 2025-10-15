<div class="row">

    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF WISCONSIN') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text13"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text15"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text16"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class="col-md-12 pt-3 text-center border_1px bt-0 pb-3">
        <h3>
            {{ __('PAYMENT ADVICE COVER SHEET') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" text_italic">{{ __('Please check the appropriate box') }}</p>
        <p class=" text-bold">{{ __('For Debtor:') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box17');?>" value="Yes" class="form-control w-auto height_fit_content payment_received">
            </div>
            <div class="">
                <p>
                    {{ __('Payment advices (pay stubs) for the 60 days prior to the petition are attached. (Please redact
                    social security numbers and any other information restricted by applicable privacy
                    regulations).') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box18');?>" value="Yes" class="form-control w-auto height_fit_content not_payment_received">
            </div>
            <div class="">
                <p>
                    {{ __('No payment advices (pay stubs) are attached (the debtor received no income or payment
                    from any employer during the 60 days prior to filing the bankruptcy petition).') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box19');?>" value="Yes" class="form-control w-auto height_fit_content">
            </div>
            <div class="">
                <p>
                    {{ __('Payment advices (pay stubs) for the 60 days prior to the petition are attached. (Please redact
                    social security numbers and any other information restricted by applicable privacy
                    regulations).') }}
                </p>
            </div>
        </div>

        <p class=" text-bold mt-3">{{ __('For Joint Debtor, if applicable:') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box20');?>" value="Yes" class="form-control w-auto height_fit_content spouse_payment_received">
            </div>
            <div class="">
                <p>
                    {{ __('Payment advices (pay stubs) for the 60 days prior to the petition are attached. (Please redact
                    social security numbers and any other information restricted by applicable privacy
                    regulations).') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box21');?>" value="Yes" class="form-control w-auto height_fit_content spouse_not_payment_received">
            </div>
            <div class="">
                <p>
                    {{ __('No payment advices (pay stubs) are attached (the debtor received no income or payment
                    from any employer during the 60 days prior to filing the bankruptcy petition).') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box22');?>" value="Yes" class="form-control w-auto height_fit_content">
            </div>
            <div class="">
                <p>
                    {{ __('No payment advices (pay stubs) attached for other reason, or some payment advices are
                    missing (please explain).') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text23"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor or Debtor if not represented by an attorney"
            inputFieldName="Text24"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
             <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor if not represented by an attorney"
                inputFieldName="Text25"
                inputValue={{$spousename}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>