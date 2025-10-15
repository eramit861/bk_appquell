<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF TENNESSEE') }}</h3>
    </div>

    <div class="col-md-12 border_1px p-3 bb-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('A1'); ?>" value="" class=" form-control" rows="1" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div> 
    </div>

    <div class="col-md-7 border_1px p-3 br-0"></div>
    <div class="col-md-5 border_1px p-3 bl-0">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="A2"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <span class="mt-3">&nbsp;</span>
        <x-officialForm.caseNo
            labelText="Chapter"
            casenoNameField="A3"
            caseno={{$chapterNo}}
        ></x-officialForm.caseNo>
    </div>
    <div class="col-md-12 border_1px p-3 bt-0 ">
        <x-officialForm.debtorSignVertical
            labelContent="Debtor(s) *"
            inputFieldName="A4"
            inputValue="<?php echo $debtorname ?? ''; ?>"
        ></x-officialForm.debtorSignVertical>
    </div>
    
    <div class="col-md-3 border_1px pt-3 pb-3 pl-1 br-0 bt-0 ">
        <label class="p-2">{{ __('Social Security No(s):') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bl-0 bt-0 br-0">
        <x-officialForm.caseNo
            labelText="H -"
            casenoNameField="A5"
            caseno="{{$ssn1}}"
        ></x-officialForm.caseNo>
        <x-officialForm.caseNo
            labelText="W -"
            casenoNameField="A6"
            caseno="{{$ssn2}}"
        ></x-officialForm.caseNo>
    </div>
    <div class="col-md-4 border_1px p-3 bl-0 bt-0 ">
    </div>

    <div class="col-md-12 mt-3 border_bottom_1px">
        <h3 class="text-center mb-3">{{ __('DISCLOSURE OF COMPENSATION UNDER 11 U.S.C. § 329') }}<br>{{ __('AND FED. R. BANKR. P. 2016(b)') }}</h3>
    </div>
    <div class="col-md-12 mt-3 ">
        <p><label class="pl-4 ">&nbsp;</label>
        {{ __('I certify that I am the attorney for the above-named debtor(s) and that the compensation paid or
            agreed to be paid to me for services rendered or to be rendered in behalf of the debtor in or in connection
            with a case under title 11 of the United States Code, such payment or agreement having been made after one
            year before the date of the filing of the petition, is as follows') }}: $
            <input type="text" name="<?php echo base64_encode('A7')?>" class="form-control width_auto price-field" value="<?php echo Helper::validate_key_value('attorney_price', $savedData);?>">
            {{ __('paid') }}, $
            <input type="text" name="<?php echo base64_encode('A8')?>" class="form-control width_auto price-field">
            {{ __('to
            be paid, that the source of the compensation paid was
            and that the source of the compensation agreed
            to be paid is') }}
        </p>
        <p><label class="pl-4 ">&nbsp;</label>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox0')?>" value="YES" class="form-control width_auto">
            {{ __('I have') }} 
            <input type="checkbox" name="<?php echo base64_encode('CheckBox1')?>" value="YES" class="form-control width_auto ml-4">
            {{ __('I have not agreed to share this compensation with any other person.') }} [<span class="text_italic">{{ __('If
            appropriate') }}</span>] {{ __('The details of such sharing or agreement to share are as follows') }} [<span class="text_italic">{{ __('except that no such details
            are required of any agreement for sharing of the compensation with a member or regular associate of the
            attorney’s law firm') }}</span>]:
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="A11"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div> 
    <div class="col-md-6 mt-3">
        <div class="mt-1 text-center text_italic">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney for Debtor"
                inputFieldName="A12"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <input name="<?php echo base64_encode('A13a'); ?>" type="text" value="{{$attonryAddress1}}, {{$attonryAddress2}}" class="form-control">
        </div>
        <div class="mt-1">
            <label class="mt-2 text_italic">{{ __('Address:') }}</label>
            <input name="<?php echo base64_encode('A13b'); ?>" type="text" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" class="form-control">
        </div>
        <div class="mt-1 pl-2 text_italic">
            <x-officialForm.debtorSignVertical
                labelContent="Telephone No.:"
                inputFieldName="A14"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2 text_italic">
            <x-officialForm.debtorSignVertical
                labelContent="State Bar Disciplinary No:"
                inputFieldName="A15"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>  
    <div class="col-md-12 mt-2">
        <label class="text_italic">
            *{{ __('Include all names used by debtor within last 6 years') }}
        </label>
    </div>
</div>