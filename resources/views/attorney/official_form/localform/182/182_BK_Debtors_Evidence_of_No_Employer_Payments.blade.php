<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MISSOURI') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text19"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text18"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('DEBTOR’S EVIDENCE OF NO EMPLOYER PAYMENTS') }}</h3>
        <p class="p_justify">
            <span class="pl-4"></span>
            I,
            <x-officialForm.inputText name="Text17" class=" width_30percent" value="{{$onlyDebtor}}"></x-officialForm.inputText>
            {{ __(', hereby state and declare under penalty of perjury that (check the box that applies):') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-3"></span>
            <x-officialForm.inputCheckbox name="Check Box14" class=" width_90percent ml-1" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('I received no payment from any employer for the 60 days prior to filing the petition.') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-3"></span>
            <x-officialForm.inputCheckbox name="Check Box15" class=" width_90percent" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('I received no payment from any employer from') }}
            <x-officialForm.inputText name="prior to the filing of the petition  Payment advices for the" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __('to') }}
            <x-officialForm.inputText name="remainder of the 60day period have been provided" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __('prior to the filing of the petition. Payment advices for the
            remainder of the 60-day period have been provided.') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-3"></span>
            <x-officialForm.inputCheckbox name="Check Box16" class=" width_90percent" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('I was self-employed. Net income for 60 days prior to filing the petition, itemized to
            show how the amount is calculated is (shown below or in the attachment).') }}
        </p>
    </div>


    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Name of Debtor"
            inputFieldName="Name of Debtor"
            inputValue="{{$onlyDebtor}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-1 mt-3">
        <p class="">{{ __('Instructions') }}</p>
        <p class="">{{ __('ECF Event:') }}</p>
    </div>
    <div class="col-md-11 mt-3">
        <p class="">{{ __('File as a separate document on the date the voluntary petition is filed.') }}</p>
        <p class="">Bankruptcy>Other>{{ __('Debtor Evidence of No Employer Payments') }}</p>
    </div>

</div>
