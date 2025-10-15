<div class="row">
    <div class="col-md-12 text-center mt-3 mb-3">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('FOR THE NORTHERN DISTRICT OF TEXAS') }}</h3>
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
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="topmostSubform[0].Page1[0].TextField1[2]"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3 mb-4">
        <h3>{{ __('DECLARATION FOR ELECTRONIC FILING OF') }}<br>
        <span class="underline">{{ __('BANKRUPTCY PETITION AND MASTER MAILING LIST (MATRIX)') }}</span></h3>
    </div>
    <div class="col-md-12">
        <p class="text-bold">{{ __('PART I: DECLARATION OF PETITIONER:') }}</p>
        <p><span class="pl-5"></span>
        {{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the corporation,
            partnership, or limited liability company seeking bankruptcy relief in this case, I hereby request relief as, or on
            behalf of, the debtor in accordance with the chapter of title 11, United States Code, specified in the petition to be
            filed electronically in this case. I have read the information provided in the petition and in the lists of creditors to
            be filed electronically in this case and') }} <span class="text_italic text-bold">{{ __('I hereby declare under penalty of perjury') }} </span>{{ __('that the information provided
            therein, as well as the social security information disclosed in this document, is true and correct. I understand that
            this Declaration is to be filed with the Bankruptcy Court within seven (7) business days after the petition and lists of
            creditors have been filed electronically. I understand that a failure to file the signed original of this Declaration will
            result in the dismissal of my case.') }}
        </p>
        <div class="d-flex mt-3">
            <!-- checked by default -->
            <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CheckBox1[0]'); ?>" value="1" checked>
            <div>
                <label>
                    <span class="text_italic text-bold">{{ __('[Only include for Chapter 7 individual petitioners whose debts are primarily consumer debts] –') }}</span><br>
                    {{ __('I am an individual whose debts are primarily consumer debts and who has chosen to file under chapter 7. I
                    am aware that I may proceed under chapter 7, 11, 12, or 13 of title 11, United States Code, understand the
                    relief available under each chapter, and choose to proceed under chapter 7.') }}
                </label>
            </div>
        </div>
        <div class="d-flex mt-3">
            <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CheckBox2[0]'); ?>" value="1">
            <div>
                <label>
                    <span class="text_italic text-bold">{{ __('[Only include if petitioner is a corporation, partnership or limited liability company] –') }}</span><br>
                    {{ __('I hereby further declare under penalty of perjury that I have been authorized to file the petition and lists of
                    creditors on behalf of the debtor in this case.') }}
                </label>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].TextField1[3]"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4 mt-3">
    <x-officialForm.signVertical
            labelText="Debtor"
            signNameField="topmostSubform[0].Page1[0].TextField1[4]"
            sign="{{$onlyDebtor}}">
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-4 mt-3">
    <x-officialForm.signVertical
            labelText="Joint Debtor"
            signNameField="topmostSubform[0].Page1[0].TextField1[5]"
            sign="{{$spousename}}">
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('PART II: DECLARATION OF ATTORNEY:') }}</p>
        <p>
            <span class="pl-5"></span>{{ __('I declare') }}<span class="text_italic text-bold">{{ __('under penalty of perjury') }}</span>
            {{ __('that: (1) I will give the debtor(s) a copy of all documents referenced by
            Part I herein which are filed with the United States Bankruptcy Court; and (2) I have informed the debtor(s), if an
            individual with primarily consumer debts, that he or she may proceed under chapter 7, 11, 12, or 13 of title 11,
            United States Code, and have explained the relief available under each such chapter.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].TextField1[6]"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-4 mt-3">
    </div>
    <div class="col-md-4 mt-3">
        <x-officialForm.signVertical
            labelText="Attorney for Debtor"
            signNameField="topmostSubform[0].Page1[0].TextField1[7]"
            sign="{{$attorney_name}}">
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-4 mt-3">
    </div>

</div>