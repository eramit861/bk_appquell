<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MISSOURI') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text38"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text39"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3 underline">{{ __('NOTICE OF AMENDMENT OF SCHEDULES D, E/F, G OR H (ADDITION OF CREDITOR(S))') }}</h3>
        <p class="mb-2">
            {{ __('You are hereby notified that the debtor(s) has filed amended schedule(s) of debt to include creditor(s)
            listed below or on the attachment. Debtor’s counsel must also separately provide you a copy of the
            debtor(s)’ full Social Security Number.') }}
        </p>
        <p class="p_justify"> <span class="text-bold pr-1">1. </span>
        {{ __('Creditor (name and address)') }}:
            <x-officialForm.inputText name="1 Creditor name and address" class="width_80percent" value=""></x-officialForm.inputText>
        </p>
        <p class="p_justify"> <span class="text-bold pr-1">2. </span>
        {{ __('Claim (amount owed, nature of claim, date incurred)') }}:
            <x-officialForm.inputText name="2 Claim amount owed nature of claim dateincurred" class="width_60percent" value=""></x-officialForm.inputText>
        </p>
        <p class="p_justify"><span class="text-bold pr-1">3. </span>
        {{ __('This claim has been scheduled as (mark one):') }}
        </p>
        <p class="pl-4"><span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box28" class="" value="Yes"></x-officialForm.inputCheckbox>
            <label>{{ __('secured') }}</label><span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box29" class="" value="Yes"></x-officialForm.inputCheckbox>
            <label>{{ __('priority') }}</label><span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Check Box30" class="" value="Yes"></x-officialForm.inputCheckbox>
            <label>{{ __('general unsecured') }}</label>
        </p>
        <p class="mb-2"> <span class="text-bold pr-1">4. </span>
        {{ __('Trustee (name, address, and phone) if one has been appointed') }}:
            <x-officialForm.inputText name="4 Trustee name address and phone if one has been appointed" class="width_60percent" value=""></x-officialForm.inputText>
        </p>
        <p class="mb-2"> <span class="text-bold pr-1">5. </span>
        {{ __('Original deadline for filing proofs of claim') }}:
            <x-officialForm.inputText name="5 Original deadline for filing proofs of claim" class="w-auto" value=""></x-officialForm.inputText>
            {{ __('[Input date from 341 meeting notice].') }}
        </p>
        <p class="text-bold">{{ __('Also, check the applicable provision below:') }}</p>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box34" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('This is a no-asset case. It is unnecessary to file a claim now. If it is determined there are assets to
                distribute, creditors will receive a notice setting a deadline to file claims') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box35" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('This claim was added to the schedules after the deadline for filing claims stated above or the
                    claim deadline will pass within 30 days. The creditor has 30 days from the date of service
                    below to file a proof of claim.') }}
                    <a href="#" class="text-c-blue"><span class="underline"> {{ __('https://ecf.mowb.uscourts.gov/cgi-bin/autoFilingClaims.pl') }}</span></a>
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box36" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('This is a Chapter 13 case. The creditor has 30 days from the date of service below or until
                    the bar date, whichever is later, to file a proof of claim.') }}
                    <a href="#" class="text-c-blue"><span class="underline"> {{ __('https://ecf.mowb.uscourts.gov/cgi-bin/autoFilingClaims.pl') }}</span></a>
                </p>
            </div>
        </div>
        <p class="mb-2"> <span class="text-bold pr-1">6. </span>
        {{ __('Deadline for filing complaints objecting to discharge of specific debts or the general
            discharge of debtor under 11 U.S.C. § 523, 727:') }}
            <x-officialForm.inputText name="discharge of debtor under 11 USC  523 727" class="w-auto" value=""></x-officialForm.inputText>
            {{ __('[Input date from 341 meeting notice]') }}
        </p>
        <p class="text-bold">{{ __('Also, check the box below if applicable:Also, check the box below if applicable:') }}</p>

        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box37" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('This claim was added to the schedules after the deadline for filing claims stated above or the
                    claim deadline will pass within 30 days. The creditor has 30 days from the date of service
                    below to file complaints') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-5 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Text40"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-7 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor’s attorney (name, address, phone, email)"
            inputFieldName="Debtors attorney name address phone email"
            inputValue="{{$attorney_name}} , {{$attonryAddress1}} , {{$attonryAddress2}} , {{$attorneyPhone}} , {{$attorney_email}} ">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3">
        <p>
        {{ __('Certificate of Service: I,') }}
            <x-officialForm.inputText name="Text41" class="width_30percent" value=""></x-officialForm.inputText>,
            {{ __('certify the above notice and a separate notice
            of the full social security number of the debtor(s) was served on the above-named creditor(s) by first class, postage prepaid mail, on this') }}
            <x-officialForm.inputText name="Text42" class="w-auto" value="{{$currentMonth}}"></x-officialForm.inputText>{{ __('day of') }}
            <x-officialForm.inputText name="tessss20" class="width_5percent" value="{{$currentDay}}"></x-officialForm.inputText>, 20
            <x-officialForm.inputText name="Text43" class="width_5percent" value="{{$currentYearShort}}"></x-officialForm.inputText>.</p>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
    <x-officialForm.debtorSignVerticalOpp
            labelContent="Typed Name or Signature"
            inputFieldName="Text44"
            inputValue="{{$attorney_name}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-12 mt-3">
        <p>
            {{ __('Instructions: Edit all paragraphs as appropriate and serve on the affected creditor(s).') }}<br>
            ECF Event: Bankruptcy>Notices>{{ __('Amendment to Schedules Adding Creditors (Fee Due)') }}
        </p>
    </div>
</div>
