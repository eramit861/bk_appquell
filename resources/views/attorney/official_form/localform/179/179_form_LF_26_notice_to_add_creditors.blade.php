<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF MISSOURI') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="{{ __('Debtor Name(s)') }}"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="{{ __('Case No.') }}"
            casenoNameField="Case Number"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <label>{{ __('Chapter 7') }}</label>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-0 pl-0">
        <h3 class="text-center mb-3">{{ __('NOTICE OF AMENDMENT TO SCHEDULES AND/OR MATRIX TO ADD CREDITOR(S)') }}</h3>
        <p>{{ __('To: Creditor(s) listed below') }}: <span class="text_italic"> {{ __('(insert creditor names and addresses or attach list)') }} </span></p>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <textarea name="<?php echo base64_encode('Creditor 1');?>" value="" class=" form-control" rows="5"></textarea>
            </div>
            <div class="col-md-4">
                <textarea name="<?php echo base64_encode('Creditor 2');?>" value="" class=" form-control" rows="5"></textarea>
            </div>
            <div class="col-md-4">
                <textarea name="<?php echo base64_encode('Creditor 3');?>" value="" class=" form-control" rows="5"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="d-flex mt-2">
            <span class="pr-3">1.</span>
            <input name="<?php echo base64_encode('Check Box2');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-2">
            <div class="">
                <span class="text-bold">{{ __('Amended Schedules') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3 pl-3"></span>
            <input name="<?php echo base64_encode('Check Box3');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span class="text-bold">{{ __('Amended Creditor Matrix and Verification of Matrix') }} </span>
            </div>
        </div>
        <div class="d-flex  mt-2">
            <span class="pr-3 pl-3"></span>
            <div class="">
                <span>
                {{ __('You are hereby notified that the above Debtor(s) filed Amended Schedules and/or Matrix and added you
                    as a creditor in this case. The following documents are attached for you.') }} <span class="text_italic"> {{ __('(Check all that are attached)') }}</span>
                </span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3 pl-3"></span>
            <input name="<?php echo base64_encode('Check Box4');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0">
            <div class="">
                <span>{{ __('A copy of the most recently filed Schedule listing you as a creditor;') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3 pl-3"></span>
            <input name="<?php echo base64_encode('Check Box5');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0">
            <div class="">
                <span>{{ __('A copy of the original Order and Notice of Chapter 7 Bankruptcy Case, Meeting of Creditors & Deadlines') }} 
                <span class="underline">{{ __("showing the debtor's full social security number;") }}</span></span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3 pl-3"></span>
            <input name="<?php echo base64_encode('Check Box6');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0">
            <div class="">
                <span>{{ __('A copy of any order or notice that set a deadline by which proofs of claim are or were to be filed along with a proof of claim form, if applicable.') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3">2.</span>
            <div class="pl-2">&nbsp;
                <span class="text-bold"> {{ __('Claims.') }} </span> <span class="text_italic">{{ __('You are further notified that: (Check one option)') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3 pl-3"></span>
            <input name="<?php echo base64_encode('Check Box7');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0">
            <div class="">
                <span>
                    {{ __('This is a no-asset case. It is unnecessary to file a claim now. If it is determined there are assets
                    to distribute, creditors will receive a notice setting a deadline to file claims.') }}
                </span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3 pl-3"></span>
            <input name="<?php echo base64_encode('Check Box8');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0">
            <div class="">
                <span>
                    {{ __('This is an asset case. You may file a proof of claim by the deadline specified in the order or
                    notice that set a deadline by which proofs of claim are or were to be filed, or within 30 days of
                    the date of service of this notice, whichever is later.') }}
                </span>
            </div>
        </div>
        <div class="d-flex mt-2">
            <span class="pr-3">3.</span>
            <div class="pl-2">&nbsp;
                <span>
                <span class="text-bold"> {{ __('Discharge.') }} </span> 
                    {{ __("You are further notified that you may file a complaint to determine dischargeability pursuant
                    to 11 U.S.C. ' 523(c) or to object to discharge pursuant to 11 U.S.C. ' 727(c) not later than sixty (60)
                    days after the date on the certificate of service of this notice, or within the time originally set for filing
                    such a complaint, whichever is later.") }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Date:') }}"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6 table_sect">
        <table class="w-100">
            <tr>
                <td class="p-2">{{ __('Signature:') }}</td>
                <td class="p-1"><input name="<?php echo base64_encode('Text1');?>" value="{{$debtor_sign}}" type="text" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2">{{ __('Name:') }}</td>
                <td class="p-1"><input name="<?php echo base64_encode('Name');?>" value="{{$onlyDebtor}}" type="text" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2">{{ __('Address:') }}</td>
                <td class="p-1"><textarea name="<?php echo base64_encode('Address');?>" class="form-control" rows="3">{{$d1EmployerAddressLine1}}, {{$d1EmployerAddressLine2}}</textarea></td>
            </tr>
            <tr>
                <td class="p-2">{{ __('Email:') }}</td>
                <td class="p-1"><input name="<?php echo base64_encode('Email');?>" value="{{$debtor_email}}" type="text" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2">{{ __('Telephone:') }}</td>
                <td class="p-1"><input name="<?php echo base64_encode('Telephone');?>" value="{{$debtorPhoneHome}}" type="text" class="form-control"></td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('Certificate of Service') }}</h3>
        <p>
            I, <input name="<?php echo base64_encode('I Name');?>" value="{{$onlyDebtor}}"  type="text" class="form-control mt-1 width_30percent">,
            {{ __('certify the above Notice and a copy of the designated documents were
            served on the listed creditors(s) by first-class, postage prepaid mail, on this') }} 
            <input name="<?php echo base64_encode('Day');?>" value="{{$currentMonth}}"  type="text" class="form-control mt-1 w-auto">{{ __('day of') }}
            <input name="<?php echo base64_encode('Month');?>" value="{{$currentMonthNumerical}}"  type="text" class="form-control mt-1 width_5percent">, 20 
            <input name="<?php echo base64_encode('Year');?>" value="{{$currentYearShort}}"  type="text" class="form-control mt-1 width_5percent">.
        </p>
        <p class="text_italic">{{ __('(If the creditor names do not appear above, list them below)') }}</p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Typed Name or Signature') }}"
            inputFieldName="Text2"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-12 mt-3">
        <p class="text_italic">
        {{ __('(Instructions: File and serve this notice and serve, but do not file, the referenced documents. Use the
            CM/ECF Event') }} <span class="text-bold"> {{ __('"Amended Schedules"') }} </span> {{ __('and') }} <span class="text-bold">{{ __('"Amended Creditor Matrix and Verification of Matrix"') }}</span>
            {{ __('as appropriate to file this notice as one PDF document with the Amended Schedules. If you file this
            notice separately, use the CM/ECF Event') }} <span class="text-bold">{{ __('"Notice of Amendment to Schedules and/or Matrix to
            Add Creditor(s)."') }}</span> )
        </p>
    </div>
                
</div>