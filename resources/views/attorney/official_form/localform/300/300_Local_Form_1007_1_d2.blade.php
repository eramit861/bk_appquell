<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF WASHINGTON') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re') }}</label>
        <input name="<?php echo base64_encode('Text3'); ?>" type="text" value="{{$debtorname}}" class="form-control">
        <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="" class="form-control mt-2">
        <p class="mb-0 mt-3 float_right">{{ __('Debtor(s)') }}</p>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
          <p class="text-bold mt-3">{{ __('DECLARATION REGARDING PAYMENTS') }}</p>
    </div>
    <div class="col-md-12 mt-3 pl-0">
        <div class="d-flex mt-3">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content spouse_payment_received" name="<?php echo base64_encode('Check box 1'); ?>" value="On">
            <div>
                <span class="p_justify">
                {{ __('Attached hereto are copies of all payment advices, pay stubs or other evidence of payment received by the debtor from an employer
                within 60 days before the date of the filing of the petition, with redaction of all but the last four digits of the debtor’s 
                social security number or individual tax payer identification number.') }}
                </span>
            </div>
        </div>
        <div class="d-flex mt-3">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content spouse_not_payment_received" name="<?php echo base64_encode('Check box 2'); ?>" value="On">
            <div>
                <span class="p_justify">{{ __('Debtor has received no payment advices, pay stubs or other evidence of payment from any employer within 60 days prior to the filing of the petition.') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12 pl-1 mt-4 mb-4">
        <p>
            {{ __('Debtor declares the foregoing to be true and correct under penalty of perjury.') }}
        </p>
    </div>
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$attorneyDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div> 
    <div class="col-md-6 mt-2 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Signature"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>