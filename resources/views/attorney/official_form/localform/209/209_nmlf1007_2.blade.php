<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text140"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text139"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('CERTIFICATE OF MAILING STATEMENT OF SOCIAL SECURITY NUMBER') }}</h3>
        <p class="mb-0"><span class="pl-4"></span>
        {{ __('Pursuant to New Mexico Local Bankruptcy Rule 1007-2, I certify that on') }}
            <x-officialForm.inputText name="TESST20" class="w-auto" value="{{$currentDay}} {{$currentMonth}}"/>, 20
            <x-officialForm.inputText name="Text138" class="width_5percent" value="{{$currentYearShort}}"/>{{ __(',
            I mailed a copy of the Statement of Social Security Number
            (Form 121) (“Statement”) to the trustee, all creditors and indenture trustees in this case as shown
            on the attached mailing list. For privacy reasons, a copy of the Statement is not attached.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text1"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="Name"
                inputValue="{{$attorney_name}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Address:"
                inputFieldName="Address 1"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}">
            </x-officialForm.debtorSignVertical>
            <div class="row mt-1">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <x-officialForm.inputText name="Address 2" class="" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}"/>
                </div>
            </div>
        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Telephone:"
                inputFieldName="Telephone"
                inputValue="{{$attorneyPhone}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Email:"
                inputFieldName="Email"
                inputValue="{{$attorney_email}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>
