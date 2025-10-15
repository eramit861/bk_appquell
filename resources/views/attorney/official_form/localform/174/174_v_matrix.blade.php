<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br>
NORTHERN DISTRICT OF MISSISSIPPII</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="TextBox1"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">VERIFICATION OF MATRIX</h3>
        <p class="mt-3 mb-3">
            The undersigned Debtor(s) hereby verifies that the attached list of creditors is true and correct.
        </p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box5" class="" value="Yes"/>
            is the first mail matrix in this case.
        </p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box6" class="" value="Yes"/>
            adds entities not listed on previously filed mailing list(s).
        </p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box7" class="" value="Yes"/>
            changes or corrects name(s) and address(es) on previously filed mailing list(s)
        </p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box8" class="" value="Yes"/>
            deletes name(s) and address(es) on previously filed mailing list(s).
        </p>
        <p>
            In accordance with N.D. TX L.B.R. 1007.1, the above named Debtor(s) hereby verifies that the attached list of creditors is true and correct.
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text9"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="DEBTOR"
            inputFieldName="Text10"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="JOINT DEBTOR"
                inputFieldName="Text11"
                inputValue="{{$spousename}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>
