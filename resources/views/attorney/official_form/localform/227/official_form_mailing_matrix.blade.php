<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NORTH DAKOTA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('IN RE:') }}</label>
        <textarea name="<?php echo base64_encode('Debtors'); ?>"  class="form-control" rows="3">{{$debtorname}}</textarea>
        <label class="float_right">{{ __('Debtors.') }}</label>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="CASE NO."
            casenoNameField="Case Number"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-3">
           {{ __('VERIFICATION OF CREDITOR MATRIX') }}
         </h3>
         <p>
           {{ __('The above named Debtor(s) hereby verifies that the attached list of creditors is true and correct to the best of our knowledge.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
         <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor signature"
            inputFieldName="Text1"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor signature"
                inputFieldName="Text2"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>