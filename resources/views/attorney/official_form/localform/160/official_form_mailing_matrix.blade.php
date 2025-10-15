<div class="row">

    <div class="district160 col-md-12 text-center">
        <div class="row">
            <div class="district160 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('DISTRICT OF MARYLAND') }} </h2>
            </div>
        </div>
    </div>

    <div class="district160 col-md-6 border_1px p-3 br-0" >
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="district160 col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="Text3"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="CHAPTER:"
                casenoNameField="Text5"
                caseno={{$chapterNo}}>
            </x-officialForm.caseNo>
        </div>
    </div>

    <div class="district160 col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
        <p class="pl-4">{{ __('The above named Debtors hereby verify that the attached list of creditors is true and correct to the best of their knowledge.') }}</p>
    </div>

    <div class="district160 col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text7"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
 
    <div class="district160 col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Debtor(s)"
            inputFieldName="Text10"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>

</div>
