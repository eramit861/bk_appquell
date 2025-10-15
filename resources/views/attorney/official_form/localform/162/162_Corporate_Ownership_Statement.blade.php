<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE EASTERN DISTRICT OF MICHIGAN') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text143"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Hon"
                casenoNameField="Hon"
                caseno="">
            </x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('STATEMENT OF DEBTOR REGARDING') }}<br>{{ __('CORPORATE OWNERSHIP') }}</h3>
        <p class="text-bold mb-0"><x-officialForm.inputCheckbox name="Check Box1" class="" value="Yes" />{{ __('The following entities directly or indirectly own 10% or more of any class of the debtor’s equity interest:') }}</p>
        <div class="pl-4 row">
            <?php
            for ($i = 1; $i <= 4; $i++) {
                ?>
            <div class="col-md-2 mt-3">
                <p class="mb-0 pt-2">{{ __('Name:') }}</p>
                <p class="mb-0 pt-3">{{ __('Address:') }}</p>
            </div>
            <div class="col-md-8 mt-3">
                <x-officialForm.inputText name="Name_{{$i}}" class="" value=""></x-officialForm.inputText>
                <x-officialForm.inputText name="Address_{{$i}}" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-3"></div>
            <?php } ?>
            <div class="col-md-12 mt-3">
                <p class="text-bold">(For additional names, attach an addendum to this form)</p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold mb-0">
            <x-officialForm.inputCheckbox name="Check Box2" class="" value="Yes" />
            There are no entities that directly or indirectly own 10% or more of any class of the debtor's equity interest.
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-center">{{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Dated"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Authorized Individual For Corporation Debtor"
            inputFieldName="Text187"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-2"></div>
    <div class="col-md-6 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Print Name"
            inputFieldName="Print Name"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Title"
                inputFieldName="Title"
                inputValue="{{$suffix_d1}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>
