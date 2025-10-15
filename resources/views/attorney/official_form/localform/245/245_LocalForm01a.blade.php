<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text5"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="Text6"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('DECLARATION RE: ELECTRONIC FILING OF PETITION, SCHEDULES & STATEMENTS') }}</h3>
        <p>{{ __('PART I – DECLARATION OF PETITIONER') }}</p>
        <p class=" p_justify">
            <span class="pl-4"></span>
            I,
            <x-officialForm.inputText name="debtor certify that the information I give to my attorney for the preparation of the petition statements schedules and mailing matrix is true" class="width_30percent" value="{{$onlyDebtor}}"></x-officialForm.inputText>
            , and I,
            <x-officialForm.inputText name="the undersigned" class="width_30percent" value="{{$spousename}}"></x-officialForm.inputText>
            {{ __(', the undersigned
            debtor, certify that the information I give to my attorney for the preparation of the petition, statements, schedules and mailing matrix is true
            and correct. I consent to my attorney sending my petition, this declaration, statements and schedules to the United States Bankruptcy Court.
            I understand that this DECLARATION RE: ELECTRONIC FILING is to be submitted to the Clerk once all schedules have been
            electronically docketed but, in any event, no later than fourteen (14) days following the date the petition was electronically filed unless the
            time is extended by order of court. I understand that failure to timely submit the signed original of this DECLARATION will result in
            dismissal of my case pursuant to 11 U.S.C. § 707(a)(3) without further notice.') }}
        </p>
        <p class=" p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="Security numbers listed below are true and correct" class="" value="On"></x-officialForm.inputCheckbox>
            {{ __('[If petitioner is an individual] I declare under penalty of perjury that the information provided in this petition and the Social
            Security number(s) listed below are true and correct:') }}
        </p>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Name of Debtor"
            inputFieldName="Name of Debtor"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-3 mt-3 pt-2">
        <span>{{ __('Debtor has a Social Security number and it is:') }} </span>
    </div>
    <div class="col-md-5 mt-3">
        <x-officialForm.inputText name="Check here if Debtor does not have a Social Security number" class="" value=""></x-officialForm.inputText>
    </div>

    <div class="col-md-4"></div>
    <div class="col-md-8">
        <p>
        {{ __('Check here if Debtor does not have a Social Security number') }}:
            <x-officialForm.inputCheckbox name="Check Box1" class="" value="Yes"></x-officialForm.inputCheckbox>
        </p>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Name of Joint Debtor"
            inputFieldName="Name of Joint Debtor"
            inputValue="{{$spousename}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-3 mt-3 pt-2">
        <span>{{ __('Debtor has a Social Security number and it is:') }} </span>
    </div>
    <div class="col-md-5 mt-3">
        <x-officialForm.inputText name="Check here if Joint Debtor does not have a Social Security number" class="" value=""></x-officialForm.inputText>
    </div>

    <div class="col-md-4"></div>
    <div class="col-md-8">
        <p>
        {{ __('Check here if Debtor does not have a Social Security number') }}:
            <x-officialForm.inputCheckbox name="Check Box2" class="" value="Yes"></x-officialForm.inputCheckbox>
        </p>
    </div>

    <div class="col-md-12">
        <p class=" p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="true and correct and that I have been authorized to file this petition on behalf of the debtor The debtor requests relief in accordance with" class="width_30percent" value="On"></x-officialForm.inputCheckbox>
            {{ __('[If petitioner is a corporation or partnership] I declare under penalty of perjury that the information provided in this petition is
            true and correct, and that I have been authorized to file this petition on behalf of the debtor. The debtor requests relief in accordance with
            the Chapter specified in this petition.') }}
        </p>
    </div>

    <div class="col-md-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-1 pt-2">
        <label class="float_right">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Type Debtor name here)"
            inputFieldName="Type Debtor name here"
            inputValue="{{$onlyDebtor}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Joint Debtor, if applicable, type name)"
            inputFieldName="Joint Debtor if applicable type name"
            inputValue="{{$spousename}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>


    <div class="col-md-4 mt-1 pt-2">
        <label class="float_right">{{ __('Title:') }}</label>
    </div>
    <div class="col-md-4 mt-1">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Corporate or Partnership Filing)"
            inputFieldName="Corporate or Partnership Filing"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4 mt-1 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="EIN:"
            inputFieldName="EIN"
            inputValue=""
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-4 mt-1"></div>
    <div class="col-md-4 mt-1">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Phone Number of Signer"
            inputFieldName="Phone Number of Signer"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4 mt-1">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Address of Signer"
            inputFieldName="Address of Signer"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12">
        <p>{{ __('PART II – DECLARATION OF ATTORNEY') }}</p>
        <p class=" p_justify">
            <span class="pl-4"></span>
            {{ __('I further declare that before filing any document I will have examined the debtor’s petition and that the information is complete
            and correct to the best of my knowledge, information and belief. The debtor will have signed this form before I submit the petition,
            schedules, statements and mailing matrix. I will give the debtor a copy of all forms and information to be filed with the United States
            Bankruptcy Court, and have followed all other requirements for electronic case filing. I further declare that I have examined the above
            debtor’s petition, schedules, and statements and, to the best of my knowledge, information and belief, they are true, correct, and complete.
            If debtor is an individual, I further declare that I have informed the petitioner that [he or she] may proceed under Chapter 7, 11, 12 or 13 of
            Title 11, United States Code, and have explained the relief available under each such Chapter. This declaration is based on all information
            of which I have knowledge.') }}
        </p>
        <p class=" p_justify">
            <span class="pl-4"></span>
            <x-officialForm.inputCheckbox name="entitled to protections of the Act during the bankruptcy case he shall file an affidavit advising the Court within fourteen 14 days of the date of" class="" value="On"></x-officialForm.inputCheckbox>
            {{ __('Check box if debtor is a servicemember as defined by the Servicemembers Civil Relief Act of 2003. If debtor becomes
            entitled to protections of the Act during the bankruptcy case, he shall file an affidavit advising the Court within fourteen (14) days of the date of
            his change in status.') }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated_2"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor (Signature)"
            inputFieldName="Text175"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Typed Name"
                inputFieldName="Typed Name"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Address"
                inputFieldName="Address"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}, {{$attorney_city}}, {{$attorney_state}}, {{$attorney_zip}} "
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Phone No."
                inputFieldName="Phone No"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="List Bar I.D. and State of Admission"
                inputFieldName="List Bar ID and State of Admission"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>
