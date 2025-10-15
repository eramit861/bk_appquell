<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MISSOURI') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text4"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3 underline">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
        <p class="p_justify">
            <span class="pl-4"></span>
            {{ __('In a case in which the debtor or a party is a corporation, the following information is
            required pursuant to Fed. R. Bankr. P. 1007(a)(1) and Local Rule 1007-1(A)(14) or Fed. R. Bankr.
            P. 7007.1 and Local Rule 7007.1-1:') }}
        </p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box5" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('There are no corporations that directly or indirectly own 10% of more of any class of') }}
            <x-officialForm.inputText name="s equity interest" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __("'s equity interest.") }}
        </p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box6" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('The following corporations directly or indirectly own 10% or more of a class of') }}
            <x-officialForm.inputText name="s equity interest_2" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __("'s equity interest.") }}
        </p>
        <p class="pl-2 mb-2">
            <span class="pl-4"></span>
            1.
            <x-officialForm.inputText name="Text7" class=" width_90percent ml-1" value=""></x-officialForm.inputText>
        </p>
        <p class="pl-2 mb-2">
            <span class="pl-4"></span>
            2.
            <x-officialForm.inputText name="Text8" class=" width_90percent" value=""></x-officialForm.inputText>
        </p>
        <p class="pl-2 mb-2">
            <span class="pl-4"></span>
            3.
            <x-officialForm.inputText name="Text9" class=" width_90percent" value=""></x-officialForm.inputText>
        </p>
    </div>


    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Name"
            inputFieldName="Text10"
            inputValue="{{$attorney_name}}"
        ></x-officialForm.debtorSignVertical>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Address"
                inputFieldName="Text11"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Phone"
                inputFieldName="Text12"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="E-Mail Address"
                inputFieldName="Text13"
                inputValue="{{$attorney_email}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('cc: U.S. Trustee') }}</p>
        <p class="mt-3">{{ __('Instructions: File as a separate document on the day the voluntary petition is filed under the ECF') }}</p>
        <p class="">Event: Bankruptcy>Other>{{ __('Corporate Ownership Statement.') }}</p>
        <p class="">{{ __('File as a separate document on the day the first appearance is filed in an adversary under the ECF') }}  </p>
        <p class="">Event: Bankruptcy>Other>{{ __('Corporate Ownership Statement.') }}</p>
    </div>

</div>
