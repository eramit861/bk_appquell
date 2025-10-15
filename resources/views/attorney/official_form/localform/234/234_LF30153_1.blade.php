<div class="row">

    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text2"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
           <label for="">{{ __('Chapter 13') }}</label>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3 class="underline">{{ __('PRE-CONFIRMATION CERTIFICATION') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" p_justify">{{ __('Debtor(s) hereby certify under penalty of perjury that the following statements are true and correct:') }}</p>
        <div class="d-flex">
            <div class="pt-2">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('The following information is provided in connection with the confirmation hearing set on') }}
                <input type="text" name="<?php echo base64_encode('Text3'); ?>" value="{{$currentMonth}} {{$currentDay}}" class="form-control w-auto">
                , 20
                <input type="text" name="<?php echo base64_encode('Text4'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
                .</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('Debtor(s) paid all fees, charges, and amounts required under 28 U.S.C. § 1930.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('Debtor(s) are current with all post-petition obligations, including, but not limited to, payments
                proposed by the plan to the trustee and payments to lessors of personal property as required by 11
                U.S.C. § 1326(a)(1)(B) and (C).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('Debtor(s) filed all applicable federal, state, and local tax returns with the appropriate taxing
                authorities for all taxable periods ending during the 4-year period ending on the date of the filing
                of the petition in accordance with 11 U.S.C. §§ 1308 and 1325(a)(9).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-4">
                <p>(<span class="text_italic">{{ __('Select one') }}</span>)</p>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box4');?>" value="Yes">
                    </div>
                    <div class="w-100 pl-3">
                        <p>{{ __('Debtor(s) have not been required by a judicial or administrative order, or by statute, to pay
                        any domestic support obligation, as defined in 11 U.S.C. § 101(14A), either prior to the
                        date the petition was filed or any time after the petition date.') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box5');?>" value="Yes">
                    </div>
                    <div class="w-100 pl-3">
                        <p>{{ __('Debtor(s) paid all amounts due under a domestic support obligation, as defined in 11
                        U.S.C. § 101(14A), required by a judicial or administrative order, or by statute, that first
                        became payable after the date the petition was filed.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('If the confirmation hearing date set forth in Paragraph 1 is adjourned for any reason, Debtor(s) will
                file an updated Certification prior to any subsequent confirmation hearing date, in the event any
                of the information contained in this Certification changes.') }}</p>
            </div>
        </div>
        <p>{{ __('Debtor(s) affirm that the plan is proposed in accordance with 11 U.S.C. § 1325 and request that the plan be confirmed.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text6"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <div class="d-flex">
            <div class="pt-2">
                <label for="">/s/</label>
            </div>
            <div class="w-100 pl-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Debtor"
                    inputFieldName="Text9"
                    inputValue={{$debtor_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
        <div class="d-flex mt-1">
            <div class="pt-2">
                <label for="">/s/</label>
            </div>
            <div class="w-100 pl-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Joint Debtor"
                    inputFieldName="Text10"
                    inputValue={{$debtor2_sign}}
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
    </div>

</div>