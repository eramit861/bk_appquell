<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF ARIZONA') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text23"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text24"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text25"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('DECLARATION RE: ELECTRONIC FILING') }}</h3>
    </div>
    <div class="col-md-12">
        <p class="text-bold">{{ __('PART I - DECLARATION OF PETITIONER:') }}</p>
        <p><span class="pl-4"></span>
        {{ __('I [We]') }} <input name="<?php echo base64_encode('Text26');?>"  type="text" class="form-control mt-1 width_30percent" value="{{$onlyDebtor}}">,
        {{ __('the undersigned debtor(s), corporate officer or partnership member, hereby declare under penalty of perjury that the information I have
            given my attorney and the information, including social security numbers, provided in the completed petition, lists, statements and
            schedules is true and correct. I have reviewed and signed each of the foregoing completed documents and my attorney has provided me
            with a signed copy of each to retain for my records. I consent to my attorney electronically filing the completed petition, lists, statements
            and schedules with the United States Bankruptcy Court. I understand that this') }} <span class="text-bold"> {{ __('DECLARATION RE: ELECTRONIC FILING') }} </span> {{ __('is to be
            filed with the Clerk after all schedules and statements have been filed electronically but, in no event, no later than 21 days after the date
            the petition was filed or, in the event an extension has been granted, no later than 7 days after the schedules and statements are filed. I
            understand that failure to file the signed original of this') }} <span class="text-bold"> {{ __('DECLARATION') }} </span> {{ __('will cause my case to be dismissed without further notice.') }}
        </p>
        <p>{{ __('[If petitioner is an individual whose debts are primarily consumer debts and has chosen to file under chapter 7] I am aware
           that I may proceed under chapter 7, 11, 12, or 13 of 11 United States Code, understand the relief available under each such chapter, and
           choose to proceed under chapter 7. I request relief in accordance with the chapter specified in the petition.') }}
        </p>
       
    </div>
    <div class="col-md-6 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text27"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-1 pt-2 mt-3">
        <label class="text-bold">{{ __('SIGNED:') }}</label>
    </div>
    <div class="col-md-5 text-center mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Text28"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 text-center mt-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor"
            inputFieldName="Text29"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-1 pt-2 mt-3">
        <label class="text-bold">{{ __('SIGNED:') }}</label>
    </div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Authorized Corporate Officer or Partnership Member"
            inputFieldName="Text30"
            inputValue="">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3"></div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('PART II - DECLARATION OF ATTORNEY:') }}</p>
        <p class=" p_justify"><span class="pl-4"></span>
            {{ __('I declare as follows: The debtor(s) will have signed this form before I submit the petition, schedules and statements. I will give
            the debtor(s) a copy of all forms and information to be filed with the United States Bankruptcy Court and have complied with all other
            requirements in the most recent Interim Operating Order. If an individual, I have informed the petitioner that [he or she] may proceed
            under chapter 7, 11, 12 or 13 of Title 11, United States Code, and have explained the relief available under each such chapter.') }}
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text31"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor(s)"
            inputFieldName="Text32"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-center">{{ __('(FILE ORIGINAL WITH COURT - DO NOT FILE ELECTRONICALLY)') }}</p>
    </div>
</div>