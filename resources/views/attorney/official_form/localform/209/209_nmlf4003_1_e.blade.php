<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text118"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text117"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('NOTICE OF AMENDMENT TO BANKRUPTCY SCHEDULE C AND NOTICE OF') }}{{ __('DEADLINE TO OBJECT') }}</h3>
        <p class="mb-0"><span class="pl-4"></span>
        {{ __('On') }} <x-officialForm.inputText name="On" class="w-auto" value=""></x-officialForm.inputText>, 20
            <x-officialForm.inputText name="Text119" class="width_5percent" value=""></x-officialForm.inputText>{{ __(',
            I filed amended schedule C. The following summarizes the amendment:') }}
        </p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border pl-0 pr-0 mt-3 mb-2">
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Brief Description of the Property and line on Schedule A/B that lists the property') }}</td>
                <td class="p-2">{{ __('Current value of the portion you own') }}</td>
                <td class="p-2">{{ __('Amount of the Exemption you claim') }}</td>
                <td class="p-2">{{ __('Current value of the portion you own') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Brief Description of the Property and line on Schedule AB that lists the propertyRow1" class="" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Current value of the portion you ownRow1" class="" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Amount of the Exemption you claimRow1" class="" value=""></x-officialForm.inputText></td>
                <td class="p-2"><x-officialForm.inputText name="Specific law that allows the exemptionRow1" class="" value=""></x-officialForm.inputText></td>
            </tr>
        </table>
        <p class="mt-3 mb-2"><span class="pl-4"></span>
            {{ __('If you object to this amended claim of exemption, you must file and serve your objection
            within 30 days after the date this notice is served. Objections must be filed with the Clerk of the
            Bankruptcy Court, 333 Lomas Blvd. NW, Suite 360, Albuquerque, NM 87102. A copy must be
            served on debtor’s attorney (name and address below).') }}
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
            inputFieldName="Text6"
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
        <h3 class="text-center mb-3 underline">{{ __('Certificate of Service') }}</h3>
        <p><span class="pl-4"></span>
            {{ __('I certify that, on the date set forth above, copies of this notice were served on all creditors
            and parties in interest, either through the notice transmission facilities of CM/ECF or via first
            class mail, postage prepaid.') }}
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 mt-2 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text7"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>
