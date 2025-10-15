<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE EASTERN DISTRICT OF MICHIGAN') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group text-bold">
            <label>{{ __('In RE:') }}</label>
            <textarea name="<?php echo base64_encode('Text151');?>" value="" class=" form-control" rows="2">{{ __('Condi X Testcase and Cary X Testcase') }}</textarea>
       </div>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
        <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('NOTICE OF DEBTOR(S) ADDRESS CHANGE') }}</h3>
        <p class="mb-0">{{ __('The debtor(s) in the above entitled case do hereby request that the mailing address listed in the above stated case be changed to:') }}</p>
    </div>
    <div class="col-md-6">
        <p class="mb-0 mt-3">{{ __('Debtor:') }}</p>
        <input type="text" name="<?php echo base64_encode('Debtor 1');?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Debtor 2');?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Debtor 3');?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Debtor 4');?>" value="" class="form-control mt-1">
    </div>
    <div class="col-md-6">
        <p class="mb-0 mt-3">{{ __('Joint Debtor:') }}</p>
        <input type="text" name="<?php echo base64_encode('Joint Debtor 1');?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Joint Debtor 2');?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Joint Debtor 3');?>" value="" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Joint Debtor 4');?>" value="" class="form-control mt-1">
    </div>
    <div class="col-md-12 mt-3">
        <x-officialForm.inputCheckbox name="Change Debtors Address on Adversary Cases if applicable" class="mt-1" value="On"></x-officialForm.inputCheckbox>
        <label class="text-bold">{{ __('Change Debtor(s) Address on Adversary Case(s) if applicable') }}</label>
        <div class="row mt-3 pl-4">&nbsp;
            <div class="col-md-7 text-bold">
                <x-officialForm.caseNo
                    labelText="Adversary Case No."
                    casenoNameField="Adversary Case No"
                    caseno="">
                </x-officialForm.caseNo>
            </div>
            <div class="col-md-5"></div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
    <x-officialForm.dateSingleHorizontal
        labelText="Date"
        dateNameField="Text177"
        currentDate={{$currentDate}}>
    </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName="undefined_2"
            inputValue={{$debtor_sign}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor Signature"
            inputFieldName="Text176"
            inputValue={{$debtor2_sign}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>

</div>
