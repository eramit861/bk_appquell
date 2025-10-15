<div class="row">
    <div class="col-md-12 mb-3">
    <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF MISSOURI') }}<br>
        <x-officialForm.inputText name="Text152" class="w-auto" value=""></x-officialForm.inputText></h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="row">
            <div class="col-md-2 pt-2 pr-0">
                <label>{{ __('In re') }}</label>
            </div>
            <div class="col-md-10">
                <label for="">{{ __('DEBTOR NAME,') }}</label>
                <x-officialForm.inputText name="Text155" class="" value="{{$onlyDebtor}}"></x-officialForm.inputText>
                <label class="">{{ __('Debtor.') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Text153"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Text154"
                caseno={{$chapterNo}}>
            </x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="mb-3 mt-3 text-center">{{ __('Notice of Corrected or Undeliverable Address') }}</h3>
        <p>
            <span class="pl-4"></span>
            {{ __('Pursuant to L.R. 9060 D., the undersigned has attempted to make service on the
            following entity and after reasonable efforts to identify a corrected address reports:') }}
        </p>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box156" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('The address below is undeliverable:') }}
        </p>
        <div class="row mb-2">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('Name:') }}"
                        inputFieldName="Text164"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('Address:') }}"
                        inputFieldName="Text162"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('City/State:') }}"
                        inputFieldName="Text161"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('Zip:') }}"
                        inputFieldName="Text160"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box157" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('The corrected address for the entity identified above is:') }}
        </p>

        <div class="row mb-2">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('Name:') }}"
                        inputFieldName="Text169"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('Address:') }}"
                        inputFieldName="Text168"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('City/State:') }}"
                        inputFieldName="Text167"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="{{ __('Zip:') }}"
                        inputFieldName="Text166"
                        inputValue=""
                    ></x-officialForm.debtorSignVertical>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

        <p class="mb-2">
            <x-officialForm.inputCheckbox name="Check Box159" class="" value="Yes"></x-officialForm.inputCheckbox>
            {{ __('Despite a reasonable effort in accordance with L.R. 9060 D., the undersigned
            has not been able to locate a correct address for the entity identified above.') }}
        </p>
        <p class="p_justify">
            {{ __('The undersigned hereby certifies that this form is not being submitted for the purpose of
            updating an address that was accurate at the time the petition was filed in this case or
            that has previously been updated in this case.') }}
        </p>
    </div>


    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }} "
            dateNameField="Text8"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3"></div>

    <div class="col-md-6 pt-2">
        <label class=" float_right">/s/</label>
    </div>
    <div class="col-md-6">
        <x-officialForm.inputText name="Text9" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
        <textarea name="<?php echo base64_encode('Text4');?>" class="form-control mt-1" rows="4">{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}</textarea>
    </div> 

    <div class="col-md-6 mt-1">
    </div>
    <div class="col-md-3 mt-1 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Phone:') }}"
            inputFieldName="Text5"
            inputValue="{{$attorneyPhone}}"
        ></x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-3 mt-1 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Fax:') }}"
            inputFieldName="Text6"
            inputValue="{{$attorneyFax}}"
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-6 mt-1">
    </div>
    <div class="col-md-6 mt-1">
        <div class="row pl-2">
            <div class="col-md-2 p-2">
                <label>{{ __('E-mail:') }}</label>
            </div>
            <div class="col-md-10">
                <x-officialForm.inputText name="Text7" class="" value="{{$attorney_email}}"></x-officialForm.inputText>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class=" underline text-center mb-3 mt-3">{{ __('CERTIFICATE OF SERVICE') }}</h3>
        <p class=" p_justify">
            <span class="pl-4"></span>
            {{ __('I certify that a true and correct copy of the foregoing document was filed
            electronically on the') }}
            <x-officialForm.inputText name="Text179" class=" width_5percent" value="{{$currentDay}}"></x-officialForm.inputText>
            {{ __('day of') }}
            <x-officialForm.inputText name="Text180" class=" w-auto" value="{{$currentMonth}}"></x-officialForm.inputText>
            20
            <x-officialForm.inputText name="Text181" class=" width_5percent" value="{{$currentYearShort}}"></x-officialForm.inputText>
            {{ __(", with the United States Bankruptcy Court, and
            has been served on the parties in interest via e-mail by the Court's CM/ECF System as
            listed on the Court's Electronic Mail Notice List.") }}
        </p>
        <p class=" p_justify">
            <span class="pl-4"></span>
            {{ __('I certify that a true and correct copy of the foregoing document was filed
            electronically with the United States Bankruptcy Court, and has been served by Regular
            United States Mail Service, first class, postage fully pre-paid, addressed to to the parties
            listed below on the') }}
            <x-officialForm.inputText name="Text182" class=" width_5percent" value="{{$currentDay}}"></x-officialForm.inputText>
            {{ __('day of') }}
            <x-officialForm.inputText name="Text183" class=" w-auto" value="{{$currentMonth}}"></x-officialForm.inputText>
            20
            <x-officialForm.inputText name="Text184" class=" width_5percent" value="{{$currentYearShort}}"></x-officialForm.inputText>
            .
        </p>
    </div>

    <div class="col-md-6 pt-2 mt-3">
        <label class=" float_right">/s/</label>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.inputText name="Text185" class="" value="{{$attorny_sign}}"></x-officialForm.inputText>
        <textarea name="<?php echo base64_encode('Text186');?>" class="form-control mt-1" rows="9">{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}</textarea>
    </div>

</div>
