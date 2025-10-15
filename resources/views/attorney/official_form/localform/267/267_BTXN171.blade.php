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
            rows="2">
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
        <h3 class="text-center">{{ __('DECLARATION FOR ELECTRONIC FILING OF AMENDED PETITION') }},<br>
        {{ __('ORIGINAL/AMENDED BANKRUPTCY STATEMENTS AND SCHEDULES') }},<br>
            <span class="underline">{{ __('AND/OR AMENDED MASTER MAILING LIST (MATRIX') }})</span>
        </h3>
        
        <p class="mt-3"><span class="pl-4"></span>
        {{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the corporation, partnership, or limited liability company named as the debtor in this case') }},
            <span class="text_italic text-bold">{{ __('I hereby declare under penalty of perjury') }}</span>  {{ __('that I have read') }}
        </p> 

        <div class="d-flex pl-4">
            <div class="">
                <!-- checked by default -->
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox5[0]" class="" value="1" checked="checked"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>{{ __('the original statements and schedules to be filed electronically in this case') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox4[0]" class="" value="1"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>{{ __('the voluntary petition as amended on the date indicated below and to be filed electronically in this case') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox3[0]" class="" value="1"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>{{ __('the statements and schedules as amended on the date indicated below and to be filed electronically in this case') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox2[0]" class="" value="1"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>{{ __('the master mailing list (matrix) as amended on the date indicated below and to be filed electronically in this case') }}</p>
            </div>
        </div>

        <p>{{ __('and that the information provided therein is true and correct. I understand that this Declaration is to be filed with the Bankruptcy Court within seven (7) business days after such statements, schedules, and/or amended petition or matrix have been filed electronically. I understand that a failure to file the signed original of this Declaration as to any original statements and schedules will result in the dismissal of my case and that, as to any amended petition, statement, schedule or matrix, such failure may result in the striking of the amendment(s') }})
        </p>
        <div class="d-flex">
            <div class="">
                <x-officialForm.inputCheckbox name="topmostSubform[0].Page1[0].CheckBox1[0]" class="" value="1"></x-officialForm.inputCheckbox>
            </div>
            <div class="">
                <p>
                    <span class="text_italic">[{{ __('Only include if petitioner is a corporation, partnership or limited liability company') }}] –</span>
                    {{ __('I hereby further declare under penalty of perjury that I have been authorized to file the statements, chedules, and/or amended petition or amended matrix on behalf of the debtor in this case.')}}
                </p>
            </div>
        </div>

    </div>

    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].TextField1[3]"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4 mt-3"></div>
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

</div>