<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">IN THE {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE SOUTHERN DISTRICT OF ILLINOIS') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text18"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text20"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class=" underline">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            <span class="pl-4"></span>{{ __('The above named Debtor(s) hereby verify that the attached list of creditors is true and correct
            to the best of my/our knowledge and that it corresponds to the creditors listed in my/our schedules.') }}
        </p>
    </div>
    

    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text23"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="debtorone"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor"
                inputFieldName="joint debtor text"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>