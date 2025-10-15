<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('SOUTHERN DISTRICT OF FLORIDA') }}<br>
          <a href="#" class="text-c-blue"><span class="underline">{{ __('www.flsb.uscourts.gov') }} </span></a>
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text3"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3 underline">{{ __('DECLARATION REGARDING PAYMENT ADVICES') }}</h3>
        <p class="text-bold mb-2">{{ __('Debtor:') }}</p>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box13" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Copies of all payment advices, pay stubs or other evidence of payment received by the
                    debtor from any employer within 60 days prior to the filing of the bankruptcy petition are
                    attached. (Note: If you worked some, but not all of the 60 days prior, attach copies of any
                    and all received and provide explanation that you didn’t work the full 60 days.') }}
                    <x-officialForm.inputText name="undefined" class="width_95percent" value=""></x-officialForm.inputText>)
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box15" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Copies of all payment advices') }} <span class="text-bold"> {{ __('are not') }} </span> {{ __('attached because the debtor had no income from any employer during the 60 days prior to filing the bankruptcy petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box18" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Copies of all payment advices') }}  <span class="text-bold"> {{ __('are not') }} </span> {{ __('attached because the debtor:') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box4" class="" value="Yes"/>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('receives disability payments') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box5" class="" value="Yes"/>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('is unemployed and does not receive unemployment compensation') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box7" class="" value="Yes"/>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('receives Social Security payments') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box8" class="" value="Yes"/>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('receives a pension') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box9" class="" value="Yes"/>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('does not work outside the home') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box10" class="" value="Yes"/>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('is self employed and does not receive payment advices') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box20" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('None of the statements above apply, however, the debtor is unable to timely provide
                    some or all copies of payment advices or other evidence of payment received Explain:') }}
                    <x-officialForm.inputText name="Explain" class="" value=""></x-officialForm.inputText>
                </p>
            </div>
        </div>
        <p class="text-bold mb-2">{{ __('Joint Debtor (if applicable):') }}</p>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box21" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Copies of payment advices, pay stubs or other evidence of payment received by the joint
                    debtor from any employer within 60 days prior to the filing of the bankruptcy petition are
                    attached. (Note: If you worked some, but not all of the 60 days prior, attach copies of any
                    and all received and provide explanation that you didn’t work the full 60 days.') }}
                    <x-officialForm.inputText name="undefined_2" class="width_95percent" value=""></x-officialForm.inputText>)
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box22" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Copies of payment advices') }} <span class="text-bold"> {{ __('are not') }} </span>{{ __('attached because the joint debtor had no income from
                    any employer during the 60 days prior to filing the bankruptcy petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box23" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('Copies of all payment advices') }}  <span class="text-bold"> {{ __('are not') }} </span> {{ __('attached because the joint debtor::') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box11" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('receives disability payments') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box12" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('is unemployed and does not receive unemployment compensation') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box14" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('receives Social Security payments') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box16" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('receives a pension') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box17" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('does not work outside the home') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div class="">
               <x-officialForm.inputCheckbox name="Check Box19" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('is self employed and does not receive payment advices') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
            <x-officialForm.inputCheckbox name="Check Box24" class="" value="Yes"></x-officialForm.inputCheckbox>
            </div>
            <div class="w-100">
                <p class="p_justify">
                {{ __('None of the statements above apply, however, the joint debtor is unable to timely
                    provide some or all copies of payment advices or other evidence of payment received Explain:') }}
                    <x-officialForm.inputText name="Explain_2" class="" value=""></x-officialForm.inputText>
                </p>
            </div>
        </div>
        <p class="text-bold text_italic mt-3">
            {{ __('NOTE: When submitting copies of evidence of payment such as pay stubs or payment advices,
            it is your responsibility to redact (blackout) any social security numbers, names of minor
            children, dates of birth or financial account numbers before attaching for filing with the
            court. See Local Rule 5005-1(A)(2).') }}
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Attorney or Debtor"
            inputFieldName="Text20"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Joint Debtor, if applicable"
            inputFieldName="Text22"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date_2"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
</div>
