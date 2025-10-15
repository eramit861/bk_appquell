<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF VIRGINIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox0"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="CASE NO."
                casenoNameField="TextBox1"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="CHAPTER"
                casenoNameField="TextBox2"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __("NOTICE OF AMENDMENT TO DEBTOR'S SCHEDULES OF CREDITORS AND/OR MATRIX") }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="">
        {{ __('Debtor, pursuant to Bankruptcy Rule 1009(a), hereby gives') }} <span class="underline">{{ __('NOTICE') }}</span> {{ __("of the names of creditors added to debtor's schedules of creditors
            and/or mailing matrix as follows:") }}
        </p>
    </div>

    <div class="col-md-4 border_bottom_1px">
        <label class="text-bold">{{ __('NAME AND ADDRESS OF CREDITOR') }}</label>
    </div>
    <div class="col-md-4 border_bottom_1px">
        <label class="text-bold">{{ __('DATE OF DEBT AND SECURITY, IF ANY') }}</label>
    </div>
    <div class="col-md-2 border_bottom_1px">
        <label class="text-bold">{{ __('WHETHER DISPUTED') }}</label>
    </div>
    <div class="col-md-2 border_bottom_1px">
        <label class="text-bold">{{ __('AMOUNT') }}</label>
    </div>

    <div class="col-md-12 mt-2">
        <p>
        {{ __('Note') }}: <span class="text_italic">{{ __('Name') }}</span>: max - <span class="text_italic">{{ __('50 characters; Address - max 5 lines of 40 characters each. More than one creditor may be entered
            separated by a blank line') }}</span>.
        </p>
    </div>
    
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <input name="<?php echo base64_encode('TextBox3')?>" type="text" class="form-control" value="{{$debtor_sign}}">
        <label for="">{{ __('(Debtor Must Sign)') }}</label>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="pl-4">{{ __('The above-named debtor(s) certifies under penalty of perjury that the foregoing is true and correct pursuant to 28 U.S.C. § 1746.') }}</p>
        <h3 class="underline text-center mb-3">{{ __('CERTIFICATION') }}</h3>
        <p class=" p_justify">
            {{ __("I hereby certify that I have contacted the Bankruptcy Court Clerk's office and the above-styled case has not been closed or I have
            enclosed herewith a Motion to Reopen and the appropriate filing fees. I further certify that a true copy of this Notice was duly mailed
            on , to the Court, debtor, trustee, U.S. Trustee, and, if the § 341(a) creditors' meeting notice has been issued, to the above-named
            creditors, which notice of amendment to said creditors shall include a copy of the § 341(a) creditors' meeting notice, proof of claim
            form, and order of discharge, as applicable. I further certify that I have also filed the Certification Regarding Amended Schedules or
            Statements. See Local Rule 1009-1.") }}
        </p>
    </div>
    
    <div class="col-md-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="TextBox4" 
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVertical
            labelContent="Signed:"
            inputFieldName="TextBox5"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-5"></div>

    <div class="col-md-12 border_top_1px mt-3">
        <p class="mt-3">
        {{ __('Note: ALL amendments must be accompanied by a THIRTY-TWO DOLLARS ($32.00) filing fee payable to') }} <span class="text-bold">{{ __('Clerk, U. S.
            Bankruptcy Court.') }}</span> {{ __('Personal checks are not accepted') }}. <span class="text-bold">{{ __('If more than five (5) creditors are added by amendment, counsel for the
            debtor, or debtor if') }} <span class=" underline">{{ __('pro-se') }}</span>{{ __(', shall file with the Clerk an amended matrix which lists only the added creditors in alphabetical
            order.') }}</span>
        </p>
    </div>

</div>