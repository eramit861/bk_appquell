<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text7"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
        <div class="row mt-1">
            <div class="col-md-2 pt-2 pr-0">
                <label>{{ __('Movant') }}</label>
            </div>
            <div class="col-md-10">
                <x-officialForm.inputText name="Text8" class="" value=""></x-officialForm.inputText>
                <label>v.</label>
                <x-officialForm.inputText name="Text9" class="" value=""></x-officialForm.inputText>
                <label>{{ __('Respondent (if none, then “No Respondent”)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="Text10"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-1">
            <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text11"
                    caseno={{$chapterNo}}>
            </x-officialForm.caseNo>
        </div>
        <div class="row mt-1">
            <div class="col-md-3 pr-0">
                <label>{{ __('Related to Document No.') }}</label>
            </div>
            <div class="col-md-9">
                <x-officialForm.inputText name="Text12" class="w-auto" value=""></x-officialForm.inputText>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('DECLARATION RE: ELECTRONIC FILING OF PETITION, SCHEDULES & STATEMENTS') }}</h3>
        <p>{{ __('Amendment(s) to the following petition, list(s), schedule(s), or statement(s) are transmitted herewith:') }}</p>
        <p>
            <x-officialForm.inputCheckbox name="Check Box13" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Voluntary Petition -') }}
            <span class="text_italic">{{ __('Specify reason for amendment:') }}</span>
        </p>
        <p class="pl-1"><span class="pl-4 underline">{{ __('Official Form 6 Schedules') }}</span> {{ __('(Itemization of Changes Must Be Specified)') }}</p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box14" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Summary of Schedules') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box15" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule A - Real Property') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box16" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule B - Personal Property') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box17" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule C - Property Claimed as Exempt') }}
        </p>
        <p class="mb-1">
            <x-officialForm.inputCheckbox name="Check Box18" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule D - Creditors holding Secured Claims') }}
        </p>
        <div class="pl-4">
            <p class="mb-1 ml-4">{{ __('Check one:') }}</p>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box19" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box20" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('NO creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box21" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) deleted') }}</label>
                </div>
            </div>
        </div>
        <p class="mt-2 mb-1">
            <x-officialForm.inputCheckbox name="Check Box22" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule E - Creditors Holding Unsecured Priority Claims') }}
        </p>
        <div class="pl-4">
            <p class="mb-1 ml-4">{{ __('Check one:') }}</p>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box23" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box24" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('NO creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box25" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) deleted') }}</label>
                </div>
            </div>
        </div>
        <p class="mt-2 mb-1">
            <x-officialForm.inputCheckbox name="Check Box26" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule F - Creditors Holding Unsecured Nonpriority Claims') }}
        </p>
        <div class="pl-4">
            <p class="mb-1 ml-4">{{ __('Check one:') }}</p>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box27" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box28" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('NO creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box29" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) deleted') }}</label>
                </div>
            </div>
        </div>
        <p class="mt-2 mb-1">
            <x-officialForm.inputCheckbox name="Check Box30" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule G - Executory Contracts and Unexpired Leases') }}
        </p>
        <div class="pl-4">
            <p class="mb-1 ml-4">{{ __('Check one:') }}</p>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box31" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box32" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('NO creditor(s) added') }}</label>
                </div>
            </div>
            <div class="d-flex ml-4">
                <div class="">
                    <x-officialForm.inputCheckbox name="Check Box33" class="" value="Yes"></x-officialForm.inputCheckbox>
                </div>
                <div class="w-100">
                    <label>{{ __('Creditor(s) deleted') }}</label>
                </div>
            </div>
        </div>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box34" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule H - Codebtors') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box35" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule I - Current Income of Individual Debtor(s)') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box36" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Schedule J - Current Expenditures of Individual Debtor(s)') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box37" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Statement of Financial Affairs') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box38" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __("Chapter 7 Individual Debtor's Statement of Intention") }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box39" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Chapter 11 List of Equity Security Holders') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box40" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Chapter 11 List of Creditors Holding 20 Largest Unsecured Claims') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box41" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Disclosure of Compensation of Attorney for Debtor') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box42" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Other') }}
            <x-officialForm.inputText name="undefined" class="width_90percent" value=""></x-officialForm.inputText>
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor(s) [or pro se Debtor(s)]"
            inputFieldName="Attorney for Debtors or pro se Debtors"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Typed Name)"
                inputFieldName="Typed Name"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Address)"
                inputFieldName="Address"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Phone No.)"
                inputFieldName="Phone No"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="List Bar I.D. and State of Admission"
                inputFieldName="List Bar ID and State of Admission"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="p_justify">
            {{ __('Note: An amended matrix of creditors added by the amendment must be submitted on disk with the
            amendment. Attorneys filing electronically on the Case Management/Electronic Case Filing System may
            add creditors to the case electronically.') }}
        </p>
    </div>

</div>
