<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MISSOURI') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="d-flex">
            <div class=" width_5percent">
                <label for="">{{ __('In re:') }}</label>
            </div>
            <div class=" width_60percent pl-3">
                <x-officialForm.inputText name="In re 1" class="" value="{{$onlyDebtor}} and"></x-officialForm.inputText>
                <x-officialForm.inputText name="In re 2" class=" mt-1" value="{{$spousename}}"></x-officialForm.inputText>
                <label class=" float_left">{{ __('Debtor(s) Name(s)') }}</label>
                <label class=" float_right">and</label>
            </div>
            <div class=" width_40percent pl-3">
                <x-officialForm.inputText name="undefined" class=" w-auto" value="{{$ssn1}}"></x-officialForm.inputText>
                <x-officialForm.inputText name="undefined_2" class=" w-auto mt-1" value="{{$ssn2}}"></x-officialForm.inputText>
                <label class="">{{ __('Full Social Security No.') }}</label>
            </div>
        </div>

    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12">
        <h3 class="mt-3 mb-3 text-center">{{ __('Declaration Re: Electronic Filing') }}</h3>
        <p class="p_justify">
            <span class="text-bold">{{ __('Part I - Declaration of Petitioner(s):') }}</span>
             {{ __('I [We], the undersigned debtor(s), corporate officer, partner, or member, hereby declare
            under penalty of perjury that the information I have given my attorney and the information provided in the electronically filed
            petition, statements and schedules is true and correct. I consent to my attorney sending my petition, this declaration, statements
            and schedules and any future amendments of these documents to the United States Bankruptcy Court, United States Trustee
            and Panel Trustee. I understand that this “Declaration Re: Electronic Filing” is to be filed with the Clerk when the petition is
            filed. I understand that failure to file this document with an image of the original signature or an image of the signature
            captured electronically will cause my case to be dismissed without further notice.') }}
        </p>
        <div class="d-flex">
            <div class="">
                <x-officialForm.inputCheckbox name="Check Box26" class=" w-auto" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('[If petitioner is an individual whose debts are primarily consumer debts and has chosen to file under chapter 7] I am
                    aware that I may proceed under chapter 7, 11, 12, or 13 of 11 United States Code, understand the relief available
                    under each such chapter, and choose to proceed under chapter 7. I request relief in accordance with the chapter
                    specified in the petition. I declare under penalty of perjury that the foregoing social security number is true and
                    correct.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <x-officialForm.inputCheckbox name="Check Box27" class=" w-auto" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                    {{ __('[If petitioner is a corporation, partnership or limited liability entity] I declare under penalty of perjury that the
                    information provided in this petition is true and correct, and that I have been authorized to file this petition on behalf
                    of the debtor. The debtor requests relief in accordance with the chapter specified in this petition.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-1 mt-3">
        <label for="">{{ __('Signed:') }} </label>
    </div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 1"
            inputFieldName="Signed"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-1 mt-3"></div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 1"
            inputFieldName="Debtor 2"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12">
        <p class="text-center text-bold">{{ __('(If joint case, both debtors must sign)') }}</p>
    </div>


    <div class="col-md-6 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Authorized Corporate Officer, Partner, or Member"
            inputFieldName="Authorized Corporate Officer Partner or Member"
            inputValue="">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12">
        <p class="p_justify">
            <span class="text-bold">{{ __('Part II - Declaration of Attorney:') }}</span>
             {{ __("I declare under penalty of perjury that I have reviewed the above debtor's[s'] petition,
            schedules, statements and that the information is complete and correct to the best of my knowledge; and, the debtor(s) signed
            this Declaration before I submitted the petition, schedules and statements. I will give the debtor(s) a copy of all pleadings and
            information to be filed with, or received from, the United States Bankruptcy Court, and have complied with all other
            requirements in the most recent General Order, Administrative Procedures for Electronic Case Filing Manual and this court's
            Local Rules. I have informed the individual petitioner that [he and/or she] may proceed under chapter 7, 11, 12 or 13 of Title
            11, United States Code, and have explained the relief available under such chapter. This declaration is based upon all
            information of which I have knowledge.") }}
        </p>
    </div>

    <div class="col-md-3 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated_2"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-3 mt-3 pt-2">
        <p class="float_right mb-0 text-bold">{{ __('Signed:') }}</p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.inputText name="Signed_2" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
    </div>

    <div class="col-md-3 mt-1">
    </div>
    <div class="col-md-3 mt-1 pt-2">
        <p class="float_right mb-0 text-bold">{{ __('Name; MO Bar No.:') }}</p>
    </div>
    <div class="col-md-6 mt-1">
        <x-officialForm.inputText name="Name MO Bar No 1" class="" value="{{$attorney_name}}; {{$attorney_state_bar_no}}"></x-officialForm.inputText>
    </div>

    <div class="col-md-3 mt-1">
    </div>
    <div class="col-md-3 mt-1 pt-2">
        <p class="float_right mb-0 text-bold">{{ __('Address:') }}</p>
    </div>
    <div class="col-md-6 mt-1">
        <x-officialForm.inputText name="Address 1" class="" value="{{$attonryAddress1}}"></x-officialForm.inputText>
        <x-officialForm.inputText name="Name MO Bar No 2" class="mt-1" value="{{$attonryAddress2}}"></x-officialForm.inputText>
        <x-officialForm.inputText name="Address 2" class="mt-1" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}"></x-officialForm.inputText>
    </div>

    <div class="col-md-3 mt-1">
    </div>
    <div class="col-md-3 mt-1 pt-2">
        <p class="float_right mb-0 text-bold">{{ __('Phone No.:') }}</p>
    </div>
    <div class="col-md-6 mt-1">
        <x-officialForm.inputText name="Phone No" class="" value="{{$attorneyPhone}}"></x-officialForm.inputText>
    </div>

    <div class="col-md-3 mt-1">
    </div>
    <div class="col-md-3 mt-1 pt-2">
        <p class="float_right mb-0 text-bold">{{ __('E-mail:') }}</p>
    </div>
    <div class="col-md-6 mt-1">
        <x-officialForm.inputText name="Email" class="" value="{{$attorney_email}}"></x-officialForm.inputText>
    </div>

    <div class="col-md-12 mt-3">
        <p class="p_justify">
            <span class="text-bold">{{ __('Instructions:') }}</span> Complete applicable sections. Debtor(s) signature must be an image of original or electronically captured. File electronically
            for all cases using the
            <span class="text-bold">{{ __('ECF event') }}</span> found under
            <span class="text-bold">Bankruptcy > Other > {{ __('Declaration Re: Electronic Filing.') }}</span>
        </p>
    </div>
</div>
