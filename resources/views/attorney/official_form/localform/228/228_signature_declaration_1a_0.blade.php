<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OHIO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 bb-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
        <div class="row mt-2">
            <div class="col-md-3 pt-2">
                <label>{{ __('Judge') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Judge'); ?>" type="text" value="" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 bt-0"></div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <h3>{{ __('DECLARATION RE: ELECTRONIC FILING OF DOCUMENTS AND STATEMENT OF SOCIAL SECURITY NUMBER') }}</h3>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="underline mb-3">{{ __('Part I - Declaration of Petitione') }}</h3>
        <p>
            <span class="pl-4"></span>
            I [We] 
            <input type="text" name="<?php echo base64_encode('I We'); ?>" value="{{$onlyDebtor}}" class="form-control width_30percent">
            {{ __('and') }} 
            <input type="text" name="<?php echo base64_encode('and'); ?>" value="{{$spousename}}" class="form-control width_30percent">
             , {{ __('the undersigned debtor(s)') }}, <span class=" text-bold text_italic"> {{ __('hereby
            declare under penalty of perjury') }}</span> {{ __('that the information I have given my attorney and the information provided in the electronically
            filed petition, statements, and schedules, as well as in any other documents that must contain original signatures, is true, correct, and
            complete. I consent to my attorney sending my petition, this declaration, statements, and schedules, and any other documents that
            must contain original signatures, to the United States Bankruptcy Court. The DECLARATION RE: ELECTRONIC FILING shall be
            filed the same day the petition is filed.') }}
        </p>
        <p>
            {{ __('I am aware that I may proceed under chapter 7, 11, 12 or 13 of Title 11 of the United States Code, understand the relief available under
            each chapter, and choose to proceed under the chapter specified in the petition.') }}
        </p>
        <p>
            I [We] 
            <span class=" text-bold text_italic"> {{ __('further declare under penalty of perjury') }}</span> {{ __('that [check appropriate box(es)]:') }}
        </p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box 1'); ?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="pl-4">
                <p class="mb-1">{{ __('The Social Security Number that I, the Debtor, have given to my attorney, which will be submitted to the Court as part of the
                electronic case opening process, is true, correct, and complete.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box 2'); ?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="pl-4">
                <p class="mb-1">{{ __('I, the Debtor, do not have a Social Security Number.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box 3'); ?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="pl-4">
                <p class="mb-1">{{ __('The Social Security Number that I, the Joint Debtor, have given to my attorney, which will be submitted to the Court as part
                    of the electronic case opening process, is true, correct, and complete.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box 4'); ?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="pl-4">
                <p class="mb-1">{{ __('I, the Joint Debtor, do not have a Social Security Number.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box 5'); ?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="pl-4">
                <p class="mb-1">[<span class="text_italic">{{ __('Check box if petitioner is a corporation or partnership') }}</span>{{ __('] I declare under penalty of perjury that the information provided in the
                    petition is true, correct, and complete, and that I have been authorized to file the petition on behalf of the debtor. The debtor
                    requests relief in accordance with the chapter specified in the petition.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-1 pt-2">
        <label class=" float_right">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-4 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Debtor)"
            inputFieldName="Text34"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Co Debtor)"
            inputFieldName="Text35"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="underline mb-3">{{ __('Part II - Declaration of Attorney') }}</h3>
        <p>
            <span class="pl-4"></span>
            I <span class=" text-bold text_italic"> {{ __('declare under penalty of perjury') }}</span> that I have reviewed the above debtor’s petition and that the information is complete and
            correct to the best of my knowledge. The debtor(s) will have signed this form before I submit the petition, schedules, and statements,
            or any other documents that must contain original signatures. I will give the debtor(s) a copy of all forms and information to be filed
            with the United States Bankruptcy Court, and have followed all other requirements of <a class=" text-c-blue" href="https://www.ohnb.uscourts.gov/file-list/local-bankruptcy-rules"> {{ __('Local Bankruptcy Rule 5005-4') }}</a> and the <a class=" text-c-blue" href="https://www.ohnb.uscourts.gov/file-list/administrative-procedures-manual"> Electronic
            Case Filing (ECF) Administrative Procedures Manual</a>{{ __('. I further declare that I have examined the above debtor’s petition, schedules,
            and statements, and any other documents that must contain original signatures, and to the best of my knowledge and belief, they are
            true, correct, and complete. If an individual, I further declare that I have informed the petitioner that [he or she] may proceed under
            chapter 7, 11, 12, or 13 of Title11, United States Code, and have explained the relief available under each such chapter. This declaration
            is based on all information of which I have knowledge. I understand that failure to file the signed original of this DECLARATION will
            cause this case to be dismissed.') }}
        </p>
    </div>
    <div class="col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-8">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor(s)"
            inputFieldName="Attorney for Debtors"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
</div>