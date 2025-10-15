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
                <textarea name="<?php echo base64_encode('Text63')?>" class="form-control" rows="2">{{$debtorname}}</textarea>
                <label class="float_right">{{ __('Debtor') }}</label>
            </div>
            <div class="col-md-2 mt-3 pt-2 pr-0">
                <label>{{ __('Movant') }}</label>
            </div>
            <div class="col-md-10 mt-3">
                <x-officialForm.inputText name="Text64" class="" value=""></x-officialForm.inputText>
                <label>v.</label>
                <x-officialForm.inputText name="Text65" class="" value=""></x-officialForm.inputText>
                <label>{{ __('Respondent (if none, then “No Respondent”)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="Text66"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-1">
            <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text67"
                    caseno={{$chapterNo}}>
            </x-officialForm.caseNo>
        </div>
        <div class="row mt-1">
            <div class="col-md-3 pt-2 pr-0">
                <label>{{ __('Related to Document No.') }}</label>
            </div>
            <div class="col-md-9">
                <x-officialForm.inputText name="Text68" class="w-auto" value=""></x-officialForm.inputText>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('NOTICE REGARDING MODIFICATION TO MAILING MATRIX') }}</h3>
        <p>
            <span class="pl-4"></span>
            {{ __('In accordance with Local Bankruptcy Rule 1007-1(f) I') }},
            <x-officialForm.inputText name="undefined" class="width_30percent" value=""></x-officialForm.inputText>
            {{ __(', counsel for the debtor(s) in the above-captioned case, hereby certify that the following list of creditors’
            names and addresses was uploaded through the creditor maintenance option in CM/ECF to the above-captioned case regarding the filing of an amendment to the schedules.') }}
        </p>
    </div>

    <div class="col-md-6 pt-2 mt-3">
        <label class=" float_right">By:</label>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text170"
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
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
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
