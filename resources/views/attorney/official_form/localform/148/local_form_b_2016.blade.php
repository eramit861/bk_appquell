<div>
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>FOR THE<br>{{ __('WESTERN DISTRICT OF KENTUCKY') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Debtor Names"
                debtorname={{$debtorname}}
                rows="4">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="Case Number."
                    casenoNameField="Case Number"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
        <div class="col-md-12 mt-20">
            <div class="text-center">
                <h3 class="underline">{{ __('AMENDMENT TO SCHEDULES') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <label class="underline text-bold">{{ __('INSTRUCTIONS:') }}</label>
    </div>

    <div class="col-md-12 d-flex mt-2">
        <label class="pl-4"> <strong>1.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    {{ __('Check applicable boxes below and describe details of amendment in box provided.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>2.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    <span class="text-bold">{{ __('For amendments to schedules other than D or E/F') }}</span>{{ __(', it is acceptable to check the box on this form, type a brief
                    description in the box for details and attach a new schedule. ANY CHANGES to D, E/F or the mailing matrix
                    must be made using the format on Page 2 of this form; if amendment does not comply, it may be stricken.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>3.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    {{ __('Debtor may use this form to amend the Social Security Number but amendments to the Social Security Number
                    must be filed separately from other amendments (and if filed electronically, using the separate event for
                    Amendment to Social Security Number).') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <label class="underline text-bold">{{ __('CHECK THE APPLICABLE BOXES BELOW:') }}</label>
    </div>

    <div class="col-md-12 d-flex mt-2">
        <label class=""><input name="<?php echo base64_encode('Check Box 1');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p class="mb-0"> 
                    {{ __('Amendment to Petition:') }}
                </p>
                <p> 
                    <input name="<?php echo base64_encode('Check Box 2');?>" value="Yes" type="checkbox" class="form-control width_auto ">Name 
                    <input name="<?php echo base64_encode('Check Box 3');?>" value="Yes" type="checkbox" class="form-control width_auto ">Address 
                    <input name="<?php echo base64_encode('Check Box 4');?>" value="Yes" type="checkbox" class="form-control width_auto ">Alias 
                    <input name="<?php echo base64_encode('Check Box 5');?>" value="Yes" type="checkbox" class="form-control width_auto ">{{ __('Social Security Number') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 6');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Statement of Financial Affairs') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 7');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Statement of Intention') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 8');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Schedule A/B') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 9');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Schedule C') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 10');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12">
                <p class="text-bold mb-0"> 
                    Schedule D or <input name="<?php echo base64_encode('Check Box 11');?>" value="Yes" type="checkbox" class="form-control width_auto ">{{ __('Schedule E/F') }}
                </p>
                <p class="mb-0"> 
                    <input name="<?php echo base64_encode('Check Box 12');?>" value="Yes" type="checkbox" class="form-control width_auto ">Add/Delete creditors or change amount or classification of debt - <span class="text-bold">{{ __('Fee Required') }}</span>{{ __(', or') }}
                </p>
                <p> 
                    <input name="<?php echo base64_encode('Check Box 13');?>" value="Yes" type="checkbox" class="form-control width_auto ">Change address of a creditor listed on the schedules - <span class="text-bold">{{ __('No Fee Required') }}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 14');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Schedule G') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 15');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Schedule H') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 16');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Schedule I') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 17');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Schedule J') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 d-flex">
        <label class=""><input name="<?php echo base64_encode('Check Box 18');?>" value="Yes" type="checkbox" class="form-control width_auto "></label>
        <div class="row pl-4">
            <div class="col-md-12 text-bold">
                <p> 
                    {{ __('Other Document Included with Schedules, e.g., Disclosure of Compensation of Attorney') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <label class="text-bold">{{ __('Additional Details of Amendment (attach separate page if needed):') }}</label>
    </div>
    
    <div class="col-md-12 mt-2">
        <textarea name="<?php echo base64_encode('AFFIRMATION OF DEBTORS I declare under penalty of perjury that I have read this document and any attached');?>" class="form-control " rows="4"></textarea>
    </div>
    
    <div class="col-md-12">
        <p class=" mt-2"><span class="text-bold">{{ __('AFFIRMATION OF DEBTOR(S):') }}</span> {{ __('I declare under penalty of perjury that I have read this document and any attached
schedules or documents, and that they are true and correct to the best of my knowledge, information and belief') }}</p>
    </div>

    <div class="row ">
        <div class="col-md-6">
            <x-officialForm.dateSingleHorizontal
                labelText="DATE:"
                dateNameField="DATE"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6 p-2">
           <x-officialForm.debtorSignVertical
                labelContent="SIGNATURE:"
                inputFieldName=""
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-6 mt-1">
            <x-officialForm.dateSingleHorizontal
                labelText="DATE:"
                dateNameField="DATE_2"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6 p-2 mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="SIGNATURE:"
                inputFieldName=""
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('Name(s) of Debtor(s):') }}</p>
        <p class="text-bold">{{ __('Case Number:') }}</p>
    </div>

    <div class="col-md-12 text-center">
        <h3 class="underline">{{ __('CORRECTIONS TO SCHEDULES D, E/F AND/OR THE CREDITORS MATRIX') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <label class="underline text-bold">{{ __('INSTRUCTIONS:') }}</label>
    </div>

    <div class="col-md-12 d-flex mt-2">
        <label class="pl-4"> <strong>1.</strong></label>
        <div class="row pl-1 p_justify">
            <div class="col-md-12">
                <p> 
                    {{ __('For all changes, the schedule on which creditor is/will be listed should be noted.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>2.</strong></label>
        <div class="row pl-1 p_justify">
            <div class="col-md-12">
                <p> 
                    Each creditor or list of creditors should indicate whether creditors are being added, deleted, or modified in another
                    way, e.g., “change amount to <input name="<?php echo base64_encode('Text2');?>" type="text" name="" class="form-control width_30percent">{{ __(',” or “move creditor from D to E/F.”
                    For added or deleted creditors, the full name and address of the creditor should be listed') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>3.</strong></label>
        <div class="row pl-1 p_justify">
            <div class="col-md-12">
                <p> 
                    {{ __('For creditors whose addresses are being corrected, the current address of the creditor on file with the Court and the
                    new one should both be listed and labeled appropriately so the Court can update the correct creditor.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-2">
        <textarea name="<?php echo base64_encode('If the amendment lists you as a creditor you have 90 days from the certification of mailing of the');?>" class="form-control " rows="20"></textarea>
    </div>
    
    <div class="col-md-12 text-center mt-3">
        <p class="text-bold">{{ __('If the amendment lists you as a creditor, please refer to Fed.R.Bank.P. 3002 for required procedures
            and time frames for filing a proof of claim') }}</p>
    </div>

    <div class="col-md-12 text-center">
        <h3 class="underline">{{ __('FOR ADDITIONAL CHANGES TO SCHEDULES D, E/F AND/OR THE CREDITORS MATRIX,
            INSERT A NEW PAGE AND CONTINUE') }}</h3>
    </div>

    <div class="text-center mt-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE') }}<br>{{ __('WESTERN DISTRICT OF KENTUCKY') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text5"
                debtorname={{$debtorname}}
                rows="4">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="CASE NUMBER."
                    casenoNameField="Text3"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="CHAPTER"
                    casenoNameField="Text4"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
        <div class="col-md-12 mt-20">
            <div class="text-center">
                <h3 class="underline">{{ __('CERTIFICATE OF SERVICE AND') }}<br>{{ __('NOTICE OF AMENDMENT TO SCHEDULES') }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <label class="underline text-bold">{{ __('INSTRUCTIONS:') }}</label>
    </div>

    <div class="col-md-12 d-flex mt-2">
        <label class="pl-4"> <strong>1.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    {{ __('Debtor or debtor’s attorney should complete and file the certificate of service with a complete list of all parties
                    and creditors served.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>2.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    {{ __('Debtor or debtor’s attorney must serve the amendment on all affected parties and creditors, e.g., any added or
                    modified creditors, the trustee, and/or other parties listed on or affected by the amendment. Parties who receive
                    electronic service such as the trustee and U.S. Trustee should be listed on the certificate of service but it is not
                    necessary to serve a copy by mail on these parties.') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>3.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    {{ __('Any added creditor or creditor for whom a new address is being filed must be sent a copy of the Notice of
                    Bankruptcy Case (Official Form 309 – All Chapters) and a copy of the Chapter 13 Plan (Chapter 13 Cases).') }}
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 d-flex">
        <label class="pl-4"> <strong>4.</strong></label>
        <div class="row pl-1">
            <div class="col-md-12">
                <p> 
                    {{ __('For changes to the names, aliases or Social Security Number of the debtor(s), a certificate of service and service
                    by the debtor/debtor’s attorney on all parties and creditors in the case is required.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="text-center">
            <h3 class="underline">{{ __('CERTIFICATION OF SERVICE') }}</h3>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
        <P><span class="pl-4"></span> {{ __('I hereby certify that on') }} <input name="<?php echo base64_encode('I hereby certify that on');?>" name="" value="{{$currentDate}}" type="text" class="form-control date_filed width_auto"> {{ __('(DATE), a copy of the attached Amendment to
            Schedules and, if required, a copy of Official Form 309 – Notice of Bankruptcy Case and the Chapter 13 Plan
            was served upon the following by first class mail:') }}</P>
    </div>

    <div class="col-md-12 mt-2">
        <textarea name="<?php echo base64_encode('Text1');?>" class="form-control " rows="20"></textarea>
    </div>

    <div class="row p-3">
        <div class="col-md-6">
            <x-officialForm.dateSingleHorizontal
                labelText="DATE:"
                dateNameField="DATE_3"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6 p-2">
            <x-officialForm.debtorSignVertical
                labelContent="SIGNATURE:"
                inputFieldName=""
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVertical>
    </div>

</div>

