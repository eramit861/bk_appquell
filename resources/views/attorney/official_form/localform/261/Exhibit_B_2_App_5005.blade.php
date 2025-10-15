<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF TEXAS') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor(s)"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="CaseNo"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
        {{ __('DECLARATION FOR ELECTRONIC FILING OF') }}<br>
            <span class="underline">{{ __('BANKRUPTCY PETITION AND MASTER MAILING LIST (MATRIX)') }}</span>
        </h3>
    </div>
    <div class="col-md-12 mb-3">
        <p class="text-bold">{{ __('PART I: DECLARATION OF PETITIONER:') }}</p>
        <p>
            <span class="pl-4"></span>
            {{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the
            corporation, partnership, or limited liability company seeking bankruptcy relief in this case, I hereby
            request relief as, or on behalf of, the debtor in accordance with the chapter of title 11, United States Code,
            specified in the petition to be filed electronically in this case. I have read the information provided in the
            petition and in the lists of creditors to be filed electronically in this case and I') }} <span class="text-bold text_italic">{{ __('hereby declare under
            penalty of perjury') }} </span>{{ __('that the information provided therein, as well as the social security information
            disclosed in this document, is true and correct. I understand that this Declaration is to be filed with the
            Bankruptcy Court within seven (7) business days after the petition and lists of creditors have been filed
            electronically. I understand that a failure to file the signed original of this Declaration will result in the
            dismissal of my case.') }}
        </p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check1'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p>
                    <span class="text_italic">{{ __('[Only include for Chapter 7 individual petitioners whose debts are primarily consumer debts]') }} </span> {{ __('-
                    I am an individual whose debts are primarily consumer debts and who has chosen to file under
                    chapter 7. I am aware that I may proceed under chapter 7, 11, 12, or 13 of title 11, United States
                    Code, understand the relief available under each chapter, and choose to proceed under chapter 7.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box4'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p>
                    <span class="text_italic">{{ __('[Only include if petitioner is a corporation, partnership or limited liability company]') }}</span> {{ __('-
                    I hereby further declare under penalty of perjury that I have been authorized to file the petition and
                    lists of creditors on behalf of the debtor in this case.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="DateSigned"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>


     <?php


    $dssn = Helper::validate_key_value('security_number', $BasicInfoPartA);
            $dssn = $volPetData[base64_encode('Form101-Debtor1.SSNum')] ?? $dssn;

            $dssn2 = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
            $dssn2 = $volPetData[base64_encode('Form101-Debtor2 SSNum')] ?? $dssn2;



            ?> 
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode(''); ?>" value="{{$debtor_sign ?? ''}}" class="form-control bg-none" disabled>
        <label class="float_right">{{ __(', Debtor') }}</label>
        <div class="mt-4 w-100 pl-1">
            <x-officialForm.debtorSignVertical
                labelContent="Soc. Sec. No."
                inputFieldName="DbtrSSN"
                inputValue="{{$dssn ?? ''}}"
            ></x-officialForm.debtorSignVertical>
            <div class="pl-4">
                <p>{{ __('OR') }}</p>
            </div>
            <div class=" float_right">
                <p>{{ __(', Position/Capacity') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode(''); ?>" value="{{$debtor2_sign ?? ''}}" class="form-control bg-none" disabled>
        <label class="float_right">{{ __(', Joint Debtor') }}</label>
        <div class="mt-4 w-100 pl-1">
            <x-officialForm.debtorSignVertical
                labelContent="Soc. Sec. No. "
                inputFieldName="JDbtrSSN"
                inputValue="{{$dssn2 ?? ''}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <p class="text-bold">{{ __('PART II: DECLARATION OF ATTORNEY:') }}</p>
        <p>
            <span class="pl-4"></span>
            {{ __('I declare') }} <span class="text-bold text_italic">{{ __('under penalty of perjury') }} </span> {{ __('that: (1) I will give the debtor(s) a copy of all documents
            referenced by Part I herein which are filed with the United States Bankruptcy Court; and (2) I have
            informed the debtor(s), if an individual with primarily consumer debts, that he or she may proceed under
            chapter 7, 11, 12, or 13 of title 11, United States Code, and have explained the relief available under each
            such chapter.') }}
        </p>
    </div>
    <div class="col-md-6">
    <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="AttyDate"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor"
            inputFieldName="Text55"
            inputValue="{{$attorny_sign ?? ''}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2">
         
    </div>
</div>