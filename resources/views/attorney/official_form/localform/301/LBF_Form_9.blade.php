<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF WASHINGTON') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
    <x-officialForm.inReDebtorCustom
            debtorNameField="In re Debtors"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
        <x-officialForm.caseNo
                labelText="Bankruptcy Case No."
                casenoNameField="Case Number"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3 mb-4 text-center">
        <h3>{{ __('Declaration Re: Debtor’s Required Documents for Trustee') }}</h3>
    </div>
    <div class="col-md-12 mt-3 pl-0">
        <p>
            {{ __('I/we declare under penalty of perjury that the attached documents are true copies of the originals.') }}
        </p>
        <p>{{ __('Please check the documents from the following list that are attached to this declaration.') }}</p>
        <div class="d-flex mt-2 pl-4">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Federa;'); ?>" value="Yes">
            <div>
                <span>
                   {{ __('Federal Income Tax Return') }}
                </span>
            </div>
        </div>
        <div class="d-flex mt-2 pl-4">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Payment Advices'); ?>" value="Yes">
            <div>
                <span>{{ __('Payment Advices (i.e., Pay Stubs and/or Earning Statements)') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2 pl-4">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Checking,Savings'); ?>" value="Yes">
            <div>
                <span>{{ __('Checking, Savings or Investment Account Statement(s)') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2 pl-4">
            <input type="checkbox" class="form-comtrol width-auto height_fit_content mt-2" name="<?php echo base64_encode('Other'); ?>" value="Yes">
            <div class="w-100">
                <p class="mb-0">{{ __('Other (please explain)') }} <input name="<?php echo base64_encode('Other please explain 1'); ?>" type="text" value="" class="form-control width_85percent ml-3">
               </p> 
               <input name="<?php echo base64_encode('Other please explain 2'); ?>" type="text" value="" class="form-control mt-2">
               <input name="<?php echo base64_encode('Other please explain 3'); ?>" type="text" value="" class="form-control mt-2">
               <input name="<?php echo base64_encode('Other please explain 4'); ?>" type="text" value="" class="form-control mt-2">
            </div>
        </div>
    </div>
    <div class="col-md-5 mb-3 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor’s Printed Name"
            inputFieldName="Debtors Printed Name"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 mb-3 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor’s Signature"
            inputFieldName="Debtor'sSignature"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mb-3 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

    <div class="col-md-5 mb-3 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor’s Printed Name (If any)"
            inputFieldName="Joint Debtors Printed Name"
            inputValue={{$spousename}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 mb-3 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor’s Signature (If any)"
            inputFieldName="JtDebtorSignature"
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mb-3 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
</div>