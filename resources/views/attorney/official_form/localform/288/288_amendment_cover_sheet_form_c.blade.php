<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF VERMONT') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
         <x-officialForm.caseNo
            labelText="Chapter"
            casenoNameField="Text1"
            caseno={{$chapterNo}}
        ></x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case #"
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 ">
        <h3 class="text-center">{{ __('NOTICE OF AMENDMENT COVER SHEET') }}<br>
        {{ __('TO AMEND PREVIOUSLY FILED SCHEDULES & STATEMENTS') }}<br>
        {{ __('AND TO FILE REQUIRED SCHEDULES AND STATEMENT NOT PREVIOUSLY FILED*') }}</h3>
    </div>
    <div class="col-md-12 mt-3">
        <p>
        <span class="text-bold">{{ __('Amendment/Schedule Information') }}</span> {{ __('(Check One)') }}
        </p>
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex mt-2">
                   <input type="radio" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Group12'); ?>" value="Choice1">
                    <div class="">
                        <label>{{ __('Amendment to Previously Filed Document') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                   <input type="radio" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Group12'); ?>" value="Choice2">
                    <div class="">
                        <label>{{ __('Schedule Not Previously Filed**') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                   <input type="radio" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Group12'); ?>" value="Choice3">
                    <div class="">
                        <label>
                        {{ __('Schedule of Post-Petition Debts') }} <span class="text_italic">
                            {{ __('(Result of conversion; no fee due.)') }}</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <p>
        <span class="text-bold">{{ __('Creditor/Schedule Information') }} </span>{{ __('(Check All That Apply)') }}
        </p>
        <div class="row">
            <div class="col-md-12">
            <div class="d-flex mt-2">
                   <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('CheckBox0'); ?>" value="YES">
                    <div class="">
                        <label>{{ __('No creditors are being added/deleted from the master mailing list of creditors by thisamendment/schedule.') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                   <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('CheckBox1'); ?>" value="YES">
                    <div class="">
                        <label>
                        {{ __('Information regarding a creditor’s address is being amended/changed (no fee due)') }},<span class="text-bold"> {{ __('AND') }} </span>
                        </label>
                        <p class="mb-0">{{ __('A master mailing list in the format prescribed by the Clerk with the amended/changed address ofthe creditor is attached.') }}</p>
                        <p class="text-bold mb-0"><span class="text_italic">{{ __('NOTE:') }}</span> {{ __('Do not repeat creditor information from a previously filed master mailing list.') }}</p>
                    </div>
                </div>
                <div class="d-flex mt-2">
                   <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('CheckBox2'); ?>" value="YES">
                    <div class="">
                        <label>{{ __('Creditors are being added by this amendment/schedule') }}, <span class="text-bold"> {{ __('AND') }} </span><br>
                        {{ __('The $31.00 amendment fee is attached for adding parties') }}, <span class="text-bold"> {{ __('AND') }} </span><br>
                        {{ __('A master mailing list in the format prescribed by the Clerk with complete names and addresses ofparties') }}
                             <span class="text-bold"> {{ __('added') }} </span>{{ __('is attached.') }}<br>
                        </label>
                        <p class="text-bold mb-0"><span class="text_italic">{{ __('NOTE:') }} </span>{{ __('Do not repeat creditor information from a previously filed master mailing list.') }}</p>
                    </div>
                </div>
                <div class="d-flex mt-2">
                   <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('CheckBox3'); ?>" value="YES">
                    <div class="">
                        <label>{{ __('Creditors are being deleted by this amendment') }}, <span class="text-bold"> {{ __('AND') }} </span> {{ __('the $31.00 amendment fee for deletingparties is attached.') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                   <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('CheckBox4'); ?>" value="YES">
                    <div class="">
                        <label>
                        {{ __('Schedules of creditors are being modified to change amount of debt or classification of debt') }},
                            <span class="text-bold"> {{ __('AND') }} </span> {{ __('the $31.00 amendment fee for deleting parties is attached.') }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <p class="text-bold">
            <span class="pl-4"></span>
            {{ __('I certify that I have served all parties who are affected by this amendment/schedule with a copy thereof and 
            a copy of the Notice of Bankruptcy Case Meeting of Creditors and Deadlines ("341 Meeting Notice"), if applicable,
            and have the case trustee, if any.') }}
        </p>
    </div>
    <div class="col-md-2 ml-1">
       <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text5"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 pl-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of debtor's Attorney or of debtor if pro se, debtor’s mailing address, telephone number and email address"
            inputFieldName="Text4"
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4 mt-3">
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <p class="text-bold">
        {{ __('I certify under penalty of perjury that I have read this Notice of Amendment and the attached schedules, lists, statements, etc.,
            consisting of') }} <input type="text" name="<?php echo base64_encode('Text10'); ?>" class="form-control w-auto">{{ __('sheets, numbered 1 through') }} <input type="text" name="<?php echo base64_encode('Text11'); ?>" class="form-control w-auto">{{ __(', and that they are true and correct to the best of my knowledge, information,
            and belief..') }}
        </p>
    </div>
    <div class="col-md-2 ml-1">
       <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text6"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
        <div class="mt-2">
            <x-officialForm.dateSingle
                labelText="Date:"
                dateNameField="Text7"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>
    </div>
    <div class="col-md-6 pl-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text8"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Co-Debtor, if a Joint Case"
                inputFieldName="Text9"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-12 mt-3">
        <div class="d-flex">

        <span class="pr-3">* </span>
        <p>{{ __('This form may only be used for amendments to lists or schedules first filed') }} <span class="text-bold underline">{{ __('before December 1, 2015.') }}</span>
        {{ __('To amend lists or schedules first filed') }} <span class="text-bold underline"> {{ __('after December 1, 2015,') }} </span>{{ __('the debtor must use either Official Form
            106DEC or Official Form 202.') }} <span class="underline">See</span> {{ __('Vt. LBR 1009-1(a).') }}
        </p>
        </div>
        <div class="d-flex">
        <span class="pr-3">**</span>
        <p>
           {{ __('If dollar amounts on amended schedules change the total for any schedule, the debtor must also file an amended Summary of Schedules document.') }}
        </p>
        </div>
    </div>
 
</div>