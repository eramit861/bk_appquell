<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="row">
            <div class="col-md-2 pt-2 pr-0">
                <label>{{ __('In Re:') }}</label>
            </div>
            <div class="col-md-10">
                <textarea name="<?php echo base64_encode('Text43')?>" class="form-control"  rows="2">{{$debtorname}}</textarea>
                <label class="float_right">{{ __('Debtor') }}</label>
            </div>
            <div class="col-md-2 mt-3 pt-2 pr-0">
                <label>{{ __('Movant') }}</label>
            </div>
            <div class="col-md-10 mt-3">
                <x-officialForm.inputText name="Text44" class="" value=""></x-officialForm.inputText>
                <label>v.</label>
                <x-officialForm.inputText name="Text45" class="" value=""></x-officialForm.inputText>
                <label>{{ __('Respondent (if none, then “No Respondent”)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="Text46"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-1">
            <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text47"
                    caseno={{$chapterNo}}>
            </x-officialForm.caseNo>
        </div>
        <div class="row mt-1">
            <div class="col-md-3 pt-2 pr-0">
                <label>{{ __('Related to Document No.') }}</label>
            </div>
            <div class="col-md-9">
                <x-officialForm.inputText name="Text48" class="w-auto" value=""></x-officialForm.inputText>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-3 pt-2 pr-0">
                <label>Hearing Date and Time:</label>
            </div>
            <div class="col-md-9">
                <x-officialForm.inputText name="Text49" class="" value=""></x-officialForm.inputText>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('CERTIFICATE OF SERVICE OF (Specify Document Served)') }}</h3>
        <p>
            <span class="pl-4"></span>
            {{ __('I certify under penalty of perjury that I served the above captioned pleading on the parties at the addresses
            specified below or on the attached list on (date)') }}
            <x-officialForm.inputText name="I certify under penalty of perjury that I served the above captioned pleading on the parties at the addresses" class="w-auto" value="{{$currentDate}}"></x-officialForm.inputText>
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('The type(s) of service made on the parties (first-class mail, electronic notification, hand delivery, or
            another type of service) was') }}
            <x-officialForm.inputText name="The types of service made on the parties firstclass mail electronic notification hand delivery or" class="width_40percent" value=""></x-officialForm.inputText>
        </p>
        <p class="p_justify">
            <span class="pl-4"></span>
            {{ __('If more than one method of service was employed, this certificate of service groups the parties
            by the type of service. For example, the full name, email address, and where applicable the full name of
            the person or entity represented, for each party served by electronic transmission is listed under the
            heading “Service by NEF,” and the full name and complete postal address for each party served by mail,
            is listed under the heading “Service by First-Class Mail.”') }}
        </p>
    </div>


    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="EXECUTED ON: "
            dateNameField="is listed under the heading Service by FirstClass Mail"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3"></div>

    <div class="col-md-6 pt-2">
        <label class=" float_right">By:</label>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="By"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Typed Name"
                inputFieldName="Text174"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Address"
                inputFieldName="Typed Name"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Phone No."
                inputFieldName="Address"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="List Bar I.D. and State of Admission"
                inputFieldName="Phone No"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>
