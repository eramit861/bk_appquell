<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">IN THE UNITED STATES BANKRUPTCY COURT FOR THE<br>{{ __('WESTERN DISTRICT OF MISSOURI') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text20"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text22"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('VERIFICATION BY DEBTOR(S)') }}</h3>
        <p class="p_justify">
            <span class="pl-4"></span>
            I/We,
            <x-officialForm.inputText name="declare under the penalty of perjury that Iwe have read the" class=" width_30percent" value=""></x-officialForm.inputText>
            {{ __(', named as the debtor(s) in this case, declare under the penalty of perjury that I/we have read the') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box2" class=" w-auto ml-1" value="Yes"></x-officialForm.inputCheckbox>
            Schedule(s)
            <x-officialForm.inputText name="Amended Schedules" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __('(A - J insert all that apply)') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box3" class=" w-auto" value="Yes"></x-officialForm.inputCheckbox>
            Amended Schedule(s)
            <x-officialForm.inputText name="A  J insert all that apply" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __('(A - J insert all that apply)') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box4" class=" w-auto ml-1" value="Yes"></x-officialForm.inputCheckbox>
            Conversion Schedules
            <x-officialForm.inputText name="StatementAmended Statement of Financial Affairs" class=" w-auto" value=""></x-officialForm.inputText>
            {{ __('(A - J insert all that apply)') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box5" class=" w-auto" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Statement/Amended Statement of Financial Affairs') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box6" class=" w-auto ml-1" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Statement/Amended Statement of Intent') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box7" class=" w-auto" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Statement/Amended Statement of Current Monthly Income') }}
        </p>
        <p class="mb-2 p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box8" class=" w-auto ml-1" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Matrix') }}
        </p>
        <p class="p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box9" class=" w-auto" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Amended Matrix') }}
        </p>
        <p class="">{{ __('and that they are true and correct to the best of my/our knowledge, information, and belief.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text23"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1 text-center">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Joint Debtor"
                inputFieldName="Text24"
                inputValue="{{$debtor2_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            {{ __('Instructions: File with original schedules or matrix not filed with the original petition or
            amended schedules/statements/matrix. Must be prepared as a separate document and must
            contain image of the debtor(s)’ signature(s). Docket as a separate event or as a separate
            attachment to the schedules/statements/matrix.') }}
        </p>
        <p class="">
            ECF Event: If not filed as an attachment to the schedules/statements/matrix, but filed as a
            separate document use the event – Bankruptcy>Other>{{ __('Verification by Debtor') }}
        </p>
    </div>

</div>
