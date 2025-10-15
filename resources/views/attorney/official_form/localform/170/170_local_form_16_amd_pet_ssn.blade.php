<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    
    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('AMENDMENT TO PETITION REGARDING SOCIAL SECURITY/TAX ID NUMBER') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <p>{{ __('To: Clerk of Bankruptcy Court') }}</p>
        <p>{{ __('The original petition filed on') }} <input type="text" name="<?php echo base64_encode('The original petition filed on');?>" class=" form-control w-auto"> {{ __('is amended as follows:') }}</p>
    </div>
    
    <div class=" col-md-6">
        <p class=" underline">{{ __('Social Security/Tax ID Number') }}</p>
        <p>{{ __('The correct Social Security number(s)
            and/or Employer’s Federal and State
            Tax Identification number(s) of the
            Debtor(s) is (are):') }}</p>
    </div>
    <div class=" col-md-6">
        <div class="">
            <x-officialForm.labelInputVertical
                labelContent="SSN (Debtor 1)"
                inputFieldName="SSN Debtor 2"
                inputValue="{{$ssn1}}">
            </x-officialForm.labelInputVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent="SSN (Debtor 2)"
                inputFieldName="FTN"
                inputValue="{{$ssn2}}">
            </x-officialForm.labelInputVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent="FTN"
                inputFieldName="STN"
                inputValue="">
            </x-officialForm.labelInputVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent="STN"
                inputFieldName="undefined"
                inputValue="">
            </x-officialForm.labelInputVertical>
        </div>
    </div>
    
    <div class=" col-md-12 pt-3 mt-3">
        <p class="text-bold">{{ __('PLEASE INCLUDE ENTIRE SOCIAL SECURITY NUMBER AND FILE THIS DOCUMENT
            UNDER: Bankruptcy Events-> Commencement Events->Amendments->Amended
            petition re: Social security/tax ID (Restricted entry)') }}</p>
        <p>{{ __('VERIFICATION: I (We), debtor(s) named in the foregoing amended schedule, declare under
            penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>
    
    <div class=" col-md-6">
        <div>
            <x-officialForm.dateSingleHorizontal
                labelText="Executed on:"
                dateNameField="Executed on"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed_2"
                inputValue={{$attorny_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Attorney for Debtor(s)') }}</label>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Print Attorney Name"
                inputFieldName="Print Attorney Name 1"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney Address:"
                inputFieldName="Attorney Address"
                inputValue="{{$attonryAddress1}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8"> 
                <input type="text" value="{{$attonryAddress2}}" name="<?php echo base64_encode('Print Attorney Name 2');?>" class=" form-control mt-1">
            </div>
        </div>
       
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Phone Number:"
                inputFieldName="Phone"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="License Number:"
                inputFieldName="License Number"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class=" col-md-6">
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Debtor 1') }}</label>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed_3"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Debtor 2 (if joint case)') }}</label>
    </div>


</div>