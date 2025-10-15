<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('FOR THE NORTHERN DISTRICT OF TEXAS') }}<br>
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].TextField1[0]"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="topmostSubform[0].Page1[0].TextField1[1]"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="topmostSubform[0].Page1[0].TextField1[2]"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center">{{ __('DECLARATION FOR ELECTRONIC FILING OF BANKRUPTCY') }}<br>
        <span class="underline">{{ __('PETITION, LISTS, STATEMENTS, AND SCHEDULES') }}</span></h3>
        <p class="text-bold">{{ __('PART I: DECLARATION OF PETITIONER:') }}</p>
        <p class="mt-3"><span class="pl-4"></span>
        {{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the corporation, partnership, or limited liability company seeking bankruptcy relief in this case, I hereby request relief as, or on behalf of, the debtor in accordance with the chapter of title 11, United States Code, specified in the petition to be filed electronically in this case. I have read the information provided in the petition, lists, statements, and schedules to be filed electronically in this case and I hereby declare under penalty of perjury that the information provided therein, as well as the social security information disclosed in this document, is true and correct. I understand that this Declaration is to be filed with the Bankruptcy Court within seven (7) business days after the petition, lists, statements, and schedules have been filed electronically. I understand that a failure to file the signed original of this Declaration will result in the dismissal of my case.') }}
        </p> 

        <div class="d-flex">
            <div class="">
                 <!-- checked by default -->
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox1[0]" class="" value="1" checked="checked"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>
                    <span class="text_italic">[{{ __('Only include for Chapter 7 individual petitioners whose debts are primarily consumer debts') }}]</span>
                {{ __('I am an individual whose debts are primarily consumer debts and who has chosen to file under chapter 7. I am aware that I may proceed under chapter 7, 11, 12, or 13 of title 11, United States Code, understand the  relief available under each chapter, and choose to proceed under chapter 7.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox2[0]" class="" value="1"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>
                    <span class="text_italic">[{{ __('Only include if petitioner is a corporation, partnership or limited liability company') }}] –</span>
                    {{ __('I hereby further declare under penalty of perjury that I have been authorized to file the petition, lists, statements, and schedules on behalf of the debtor in this case.') }}
                </p>
            </div>
        </div>

    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].TextField1[3]"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="topmostSubform[0].Page1[0].TextField1[4]"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor"
            inputFieldName="topmostSubform[0].Page1[0].TextField1[5]"
            inputValue="{{$spousename}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('PART II: DECLARATION OF ATTORNEY:') }}</p>
        <p>
            <span class="pl-4"></span> {{ __('I declare') }} <span class="text_italic text-bold"> {{ __('under penalty of perjury') }} </span>
                {{ __ ('that: (1) I will give the debtor(s) a copy of all documents referenced by
            Part I herein which are filed with the United States Bankruptcy Court; and (2) I have informed the debtor(s), if an
            individual with primarily consumer debts, that he or she may proceed under chapter 7, 11, 12, or 13 of title 11,
            United States Code, and have explained the relief available under each such chapter.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].TextField1[6]"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.signVertical
            labelText="Attorney for Debtor"
            signNameField="topmostSubform[0].Page1[0].TextField1[7]"
            sign="{{$attorney_name}}">
        </x-officialForm.signVertical>
    </div>

</div>