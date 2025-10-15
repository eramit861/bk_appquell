<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('SOUTHERN DISTRICT OF WEST VIRGINIA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case Number"
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>           
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify mb-0">
            <span class="pl-4"></span>
            {{ __('The above named debtor(s), and attorney for debtor(s) if applicable, hereby
            verify(ies) that the attached mailing matrix of creditors is complete, correct and
            consistent with the debtor(s)’s schedules to the best of my (our) knowledge.') }}
        </p>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-8 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Debtor, if any"
            inputFieldName="TextBox0"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVertical>
    </div>
    
    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-8 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Joint Debtor, if any:"
            inputFieldName="TextBox1"
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date_3"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-8 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Attorney for Debtor(s), if any:"
            inputFieldName="TextBox2"
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVertical>
    </div>

</div>