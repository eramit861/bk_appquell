<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text137"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text136"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('CERTIFICATE OF MAILING') }}<br>{{ __('NOTICE OF CORRECTED SOCIAL SECURITY NUMBER') }}</h3>
        <p class="mb-0"><span class="pl-4"></span>
        {{ __('I certify that on') }} <x-officialForm.inputText name="I certify that on" class="w-auto" value="{{$currentDay}} {{$currentMonth}}"></x-officialForm.inputText>, 20
            <x-officialForm.inputText name="Text135" class="width_5percent" value="{{$currentYearShort}}"></x-officialForm.inputText>,
            {{ __('I mailed a Notice of Corrected Social Security Number for') }}
            <x-officialForm.inputText name="Number for" class="width_30percent" value="{{$onlyDebtor}}"></x-officialForm.inputText><br>(<span class="text_italic"> {{ __('name of debtor') }} </span>{{ __(')
            to the parties listed on the attached mailing list and also to:') }}
        </p>
    </div>

    <div class="col-md-4 mt-3">
        <p>{{ __('TransUnion LLC') }}<br>Attn: Public Records Dept.<br>{{ __('P.O. Box 2002') }}<br>{{ __('Allen, TX 75013-2002') }}</p>
    </div>
    <div class="col-md-4 mt-3">
        <p>{{ __('Experian') }}<br>Profile Maintenance<br>{{ __('P.O. Box 2000') }}<br>{{ __('Chester, PA 19016-2000') }}</p>
    </div>
    <div class="col-md-4 mt-3">
        <p>{{ __('Equifax') }}<br>Profile Maintenance<br>{{ __('P.O. Box 740241') }}<br>{{ __('Atlanta, GA 30374-0241') }}</p>
    </div>

    <div class="col-md-3 mt-3">
       <label>{{ __('Last four digits of the wrong SSN:') }}</label>
    </div>
    <div class="col-md-3 mt-3">
       <x-officialForm.inputText name="Last four digits of the wrong SSN" class="w-auto" value=""/>
    </div>
    <div class="col-md-6 mt-3"></div>

    <div class="col-md-3 mt-3">
       <label>{{ __('Last four digits of debtor’s') }} <span class="text-bold"> {{ __('correct') }} </span> {{ __('SSN:') }} </label>
    </div>
    <div class="col-md-3 mt-3">
       <x-officialForm.inputText name="Last four digits of debtors correct SSN" class="w-auto" value=""/>
    </div>
    <div class="col-md-6 mt-3"></div>

    <div class="col-md-12 mt-3">
        <p>{{ __('For privacy reasons, I am not attaching a copy of the notice to this certificate.') }}</p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-2 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text2"
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
                    <x-officialForm.inputText name="Address 2" class="" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}"></x-officialForm.inputText>
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
