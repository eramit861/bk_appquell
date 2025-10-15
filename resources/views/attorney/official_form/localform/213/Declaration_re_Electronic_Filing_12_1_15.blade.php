<h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
    {{ __('WESTERN DISTRICT OF NEW YORK') }}</h3>
    <div class="row my-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text3"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo> 
        </div>
    </div>
    <div class="text-center mt-4 mb-4">
        <h3>{{ __('DECLARATION RE: ELECTRONIC FILING OF') }}<br>{{ __('PETITION, SCHEDULES & STATEMENTS') }}</h3>
    </div>
   <div>
        <p class="text-bold">{{ __('PART I - DECLARATION OF PETITIONER') }}</p>
        <p>
            <span class="pl-4 ml-4"></span>
            {{ __('I (WE) and, the undersigned debtor(s)') }}, 
            <span class="text_italic text-bold">{{ __('hereby declare under penalty of perjury') }} </span>
            {{ __('that the information provided in the electronically filed petition, statements, and 
            schedules is true and correct and that I signed these documents prior to electronic filing.
            I consent to my attorney sending my petition, statements and schedules to the United States Bankruptcy Court.
            I understand that this DECLARATION RE: ELECTRONIC FILING is to be executed at the First Meeting of Creditors and filed with the Trustee.
            I understand that failure to file the signed and dated original of this DECLARATION may cause my case to be dismissed pursuant to 11 U.S.C. § 707(a)(3) without further notice.
            I (we) further declare under penalty of perjury that I (we) signed the original Statement of Social Security Number (s), (Official Form 121), prior to the electronic filing
            of the petition and have verified the 9-digit social security number displayed on the Notice of Meeting of Creditors to be accurate.') }}
        </p>
        <p>
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes">
            {{ __('If petitioner is an individual whose debts are primarily consumer debts and who has chosen to file under a chapter:
            I am aware that I may proceed under chapter 7, 11, 12 or 13 of Title 11, United States Code, understand the relief available under each
            chapter, and choose to proceed under this chapter. I request relief in accordance with the chapter specified in this petition.I (WE) and, the undersigned debtor(s)') }}, 
            <span class="text_italic text-bold">{{ __('hereby declare under penalty of perjury') }} </span>
            {{ __('that the information provided in the electronically filed petition, statements, and schedules is true and correct.') }}
        </p>
        <p>
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
            {{ __('If petitioner is a corporation or partnership: I declare under a penalty of perjury that the information
            provided in the electronically filed petition is true and correct, and that I have been authorized to file this petition on behalf of the debtor.
            The debtor requests relief in accordance with the chapter specified in this petition.') }}
        </p>
        <p>
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
            {{ __('If petitioner files an application to pay filing fees in installments: I certify that I completed an application to pay the filing fee in installments.
            I am aware that if the fee is not paid within 120 days of the filing date of filing the petition, the bankruptcy case may
            be dismissed and, if dismissed, I may not receive a discharge of my debts.') }}
        </p>
   </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text8"
            currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6">
            <div class="row mt-3">
                <div class="col-md-2 pt-2">
                    <label>{{ __('Signed:') }}</label>
                </div>
                <div class="col-md-10 text-center">
                    <x-officialForm.debtorSignVerticalOpp
                        labelContent="(Applicant)"
                        inputFieldName="Text9"
                        inputValue="{{$debtor_sign}}"
                    ></x-officialForm.debtorSignVerticalOpp>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3 text-center">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Joint Applicant)"
                inputFieldName="Text10"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <p class="text-bold">{{ __('PART II - DECLARATION OF ATTORNEY') }}</p>
        <p>
            <span class="pl-4 ml-4">
            </span>I <span class="text_italic text-bold"> {{ __('declare under penalty of perjury') }}</span>
            {{ __('that the debtor(s) signed the petition, schedules, statements, etc.,
            including the Statement of Social Security Number(s) (Official Form 121) before I electronically
            transmitted the petition, schedules, and statements to the United States Bankruptcy Court, and have
            followed all other requirements in Administrative Orders and Administrative Procedures, including 
            submission of the electronic entry of the debtor(s) Social Security number into the Court’s electronic records.
             If an individual, I further declare that I have informed the petitioner (if an individual) that [he or she] may qualify to proceed under chapter 7, 11, 12 or 13 of Title 11, United States Code,
            and have explained the relief available under each chapter. This declaration is based on the information of which I have knowledge.') }}</p>
         <div class="row mt-3">
        <div class="col-md-6">
            <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text14"
            currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney for Debtor(s)"
                inputFieldName="Text11"
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVertical>
            <div class="mt-2">
                <x-officialForm.debtorSignVertical
                    labelContent="Address of Attorney"
                    inputFieldName="Text12"
                    inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}">
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="row mt-2">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <input name="<?php echo base64_encode('Text13'); ?>" type="text" value=" {{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" class="form-control">
                </div>
            </div>
        </div>
    </div>