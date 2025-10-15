<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF LOUISIANA') }}</h3>
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
        <h3>{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <p class=" p_justify">{{ __('The above named debtor(s) hereby verify that the attached list of creditors is true and correct to
        the best of his/her/their knowledge.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text3"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 ">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="By:"
                inputFieldName="Text4"
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent=""
                inputFieldName="Text5"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
</div>