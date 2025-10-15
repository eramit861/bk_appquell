<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text142"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text141"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('NOTICE OF CORRECTED SOCIAL SECURITY NUMBER') }}</h3>
        <p class="mb-0"><span class="pl-4"></span>
        {{ __('The social security number (“SSN”) for') }}
            <x-officialForm.inputText name="The social security number SSN for" class="w-auto" value="{{$onlyDebtor}}"/>(<span class="text_italic"> {{ __('name of debtor') }} </span>)
            {{ __('submitted in this case was wrong. The incorrect full SSN is') }}
            <x-officialForm.inputText name="The incorrect full SSN is" class="w-auto" value=""/>.
            {{ __('The') }} <span class="text-bold"> {{ __('correct') }} </span> SSN is <x-officialForm.inputText name="correct full SSN is" class="w-auto mt-1" value=""/>.
            {{ __('For privacy reasons') }}, <span class="text-bold"> {{ __('this notice will not be filed with the Court') }}.<sup>1</sup></span>
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Signature"
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

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('Certificate of Service') }}</h3>
        <p class="mb-0 mt-3"><span class="pl-4"></span>
        {{ __('I certify that on the date set forth above I mailed a copy of this notice to the parties shown on the attached mailing list and also to:') }}
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

    <div class="col-md-6 mt-3 mb-3"></div>
    <div class="col-md-6 mt-3 mb-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text1"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-4 border_top_1px ml-3"></div>
    <div class="col-md-6"></div>

    <div class="col-md-12 mt-3">
        <p><sup>1</sup>
            {{ __('Send this notice to all creditors and to other parties in interest, but DO NOT file it with the
            court. DO FILE the Certificate of Mailing Statement of Social Security Number (Form NM LF
            1007-2) showing only the last 4 digits of the social security number.') }}
        </p>
    </div>

</div>
