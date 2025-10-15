<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text132"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text130"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
        <p class="mb-0"><span class="pl-4"></span>
        {{ __('On') }} <x-officialForm.inputText name="Pursuant to Local Rule 10091b1 the following describes the amendments2" class="w-auto" value="{{$currentDay}} {{$currentMonth}}"/>, 20
            <x-officialForm.inputText name="Text129" class="width_5percent" value="{{$currentYearShort}}"/>, {{ __('I filed amended schedule(s)') }}
            <x-officialForm.inputText name="undefined" class="w-auto" value=""/>.
            {{ __('Pursuant to Local Rule 1009-1(b),1 the following describes the amendment(s)') }}<sup>2</sup>.
        </p>
    </div>

    <div class="col-md-12 table_sect table_sect_head_border pl-0 pr-0 mt-3 mb-2">
       <p class="mb-2">{{ __('Schedules A or B (individuals):') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Description of Property') }}</td>
                <td class="p-2">
                {{ __('Interest in Property') }}<br>
                    {{ __('(i.e., Debtor 1 only, Debtor 2
                    only, Debtor 1 and Debtor 2 only,
                    at least one debtor and another)') }}
                </td>
                <td class="p-2">{{ __('Current value of entire property') }}</td>
                <td class="p-2">{{ __('Current value of portion owned') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Description of PropertyRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Interest in Property ie Debtor 1 only Debtor 2 only Debtor 1 and Debtor 2 only at least one debtor and anotherRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Current value of entire propertyRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Current value of portion ownedRow1" class="" value=""/></td>
            </tr>
        </table>

        <p class="mb-2 pt-3">{{ __('Schedules A or B (non-individuals):') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Description of Property') }}</td>
                <td class="p-2">{{ __('Current value of debtor’s interest') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Description of PropertyRow1_2" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Current value of debtors interestRow1" class="" value=""/></td>
            </tr>
        </table>

        <p class="mb-2 pt-3">{{ __('Schedule D:') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Creditor’s name') }};<br> {{ __('last 4 digits of account #, mailing address') }}</td>
                <td class="p-2">{{ __('Claim amount') }}</td>
                <td class="p-2">{{ __('Collateral') }}<br> {{ __('(i.e. property securing claim)') }}</td>
                <td class="p-2">{{ __('Any other changes') }}<br>{{ __('(i.e. nature of debt, who owes the debt, nature of lien)') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Creditors name last 4 digits of account  mailing addressRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Claim amountRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Collateral ie property securing claimRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Collateral valueRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Any other changes ie nature of debt who owes the debt nature of lienRow1" class="" value=""/></td>
            </tr>
        </table>

        <p class="mb-2 pt-3">{{ __('Schedules E or F:') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Creditor’s name') }};<br>{{ __('last 4 digits of account #, mailing address') }}</td>
                <td class="p-2">{{ __('Total claim amount') }}</td>
                <td class="p-2">{{ __('Priority amount (if any)') }}</td>
                <td class="p-2">{{ __('Any other changes') }}<br>{{ __('(i.e. nature of debt, type of claim, who owes the debt)') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Creditors name last 4 digits of account  mailing addressRow1_2" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Total claim amountRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Priority amount if anyRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Any other changes ie nature of debt type of claim who owes the debtRow1" class="" value=""/></td>
            </tr>
        </table>
        <div class="row mt-3">
            <div class="col-md-12">
                <x-officialForm.inputText name="1 NM LBR 10091b requires that the notice of amendment specify the amended or new information" class="width_24percent" value=""/>
                <p class="mt-1"> <sup> 1 </sup> {{ __('NM LBR 1009-1(b) requires that the notice of amendment “specify the amended or new information.”') }}</p>
                <p> <sup> 1 </sup> {{ __('Please delete all tables and text that do not apply to the amendment. If amending Schedule C, use NM LF 4003-1(e).') }}</p>
                <p class="mb-2 pt-3">{{ __('Schedule G:') }}</p>
            </div>
        </div>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Contracting / leasing party; address') }}</td>
                <td class="p-2">{{ __('What the contract or lease is for') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Contracting  leasing party addressRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="What the contract or lease is forRow1" class="" value=""/></td>
            </tr>
        </table>
        <p class="mb-2 pt-3">{{ __('Schedule H:') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Codebtor / spouse, former spouse, or legal equivalent; name and address') }}</td>
                <td class="p-2">{{ __('Creditor to whom you owe the debt / community state or territory') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Codebtor  spouse former spouse or legal equivalent name and addressRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Creditor to whom you owe the debt  community state or territoryRow1" class="" value=""/></td>
            </tr>
        </table>
        <p class="mb-2 pt-3">{{ __('Schedules I or J:') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Amended or New Information') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Amended or New InformationRow1" class="" value=""/></td>
            </tr>
        </table>
        <p class="mb-2 pt-3">{{ __('Change in creditor’s name or address:') }}</p>
        <table class="w-100">
            <tr class="">
                <td class="p-2">{{ __('Creditor’s name and/or address before amendment') }}</td>
                <td class="p-2">{{ __('Corrected creditor’s name and/or address') }}</td>
            </tr>
            <tr>
                <td class="p-2"><x-officialForm.inputText name="Creditors name andor address before amendmentRow1" class="" value=""/></td>
                <td class="p-2"><x-officialForm.inputText name="Corrected creditors name andor addressRow1" class="" value=""/></td>
            </tr>
        </table>

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
        <h3 class="text-center mb-3 underline">{{ __('Certificate of Service') }}</h3>
        <p><span class="pl-4"></span>
            {{ __('I certify that, on the date set forth above, copies of this notice were served 1) via
            CM/ECF electronic notice on all creditors and parties in interest listed on the notice of electronic
            filing associated with this document; and 2) via first class mail, postage prepaid on all persons
            who have requested notice in this case but who do not receive electronic notice through
            CM/ECF') }}
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 mt-2 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Signature_2"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>
