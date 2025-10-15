<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br> NORTHERN DISTRICT OF MISSISSIPPI </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text25"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="CASE NUMBER:"
            casenoNameField="CASE NO"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline">VERIFICATION OF MATRIX</h3>
        <p class="mt-2 mb-2"><span class="pl-4"></span>
            The undersigned Debtor(s) hereby verifies that the attached list of creditors is true and correct.
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATED:"
            dateNameField="Text26"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="DEBTOR"
            inputFieldName="DEBTOR"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="JOINT DEBTOR"
            inputFieldName="JOINT DEBTOR"
            inputValue="{{$spousename}}">
        </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>
