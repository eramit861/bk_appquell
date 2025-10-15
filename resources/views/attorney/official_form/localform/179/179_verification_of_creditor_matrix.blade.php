<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('EASTERN DISTRICT OF MISSOURI') }}<br>
        <input name="<?php echo base64_encode('DIVISION');?>"  type="text" class="form-control w-auto">{{ __('DIVISION') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor 1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case #"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('Verification of Creditor Matrix') }}</h3>
        <p>
        {{ __('The above named debtor(s) hereby certifies/certify under penalty of perjury that
            the attached list containing the names and addresses of my creditors (Matrix), consisting of') }}
            <input name="<?php echo base64_encode('#');?>"  type="text" class="form-control width_10percent">
            {{ __('page(s) and is true, correct and complete.') }}
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName="Text2"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
        <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor Signature (If applicable)"
                inputFieldName="Text3"
                inputValue="{{$debtor2_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" mt-1">
        <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Date"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>
</div>