<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px pt-3 pl-3 pr-3 br-0 bb-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text55"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px pt-3 pl-3 pr-3 ">
       <x-officialForm.caseNo
            labelText="{{ __('Case No.') }}"
            casenoNameField="Text56"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Text57"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 bt-0">
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="YES" name="<?php echo base64_encode('CheckBox0');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="pl-3">
                <p>{{ __('Check if address should also be
                    changed in an adversary proceeding
                    (list all that apply)') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 bt-0">
        <label for="">{{ __('Adversary No. and Title:') }}</label>
        <input type="text" value="" name="<?php echo base64_encode('Text58');?>" class="form-control mt-1">
        <input type="text" value="" name="<?php echo base64_encode('Text59');?>" class="form-control mt-1">
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="underline text-center">{{ __('NOTICE OF CHANGE OF ADDRESS OF DEBTOR') }}</h3>
    </div>

    <div class="col-md-2 pt-2">
        <p class="mb-0 text-bold">{{ __('OLD ADDRESS:') }}</p>
    </div>
    <div class="col-md-10">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Name)"
                inputFieldName="Text60"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Street Address or P.O. Box)"
                inputFieldName="Text61"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(City, State, Zip Code)"
                inputFieldName="Text62"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-2 mt-3 pt-2">
        <p class="mb-0 text-bold">{{ __('NEW ADDRESS:') }}</p>
    </div>
    <div class="col-md-10 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Name)"
                inputFieldName="Text63"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Street Address or P.O. Box)"
                inputFieldName="Text64"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(City, State, Zip Code)"
                inputFieldName="Text65"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text66"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor or Debtor’s Attorney"
            inputFieldName="Text67"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <input type="text" value="{{$attorney_name}}" name="<?php echo base64_encode('Text68');?>" class="form-control mt-1">
        <input type="text" value="State Bar No: {{$attorney_state_bar_no}}" name="<?php echo base64_encode('Text69');?>" class="form-control mt-1">
        <input type="text" value="{{$attonryAddress1}}, {{$attonryAddress2}}" name="<?php echo base64_encode('Text70');?>" class="form-control mt-1">
        <input type="text" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" name="<?php echo base64_encode('Text71');?>" class="form-control mt-1">
        <input type="text" value="{{$attorneyPhone}}" name="<?php echo base64_encode('Text72');?>" class="form-control mt-1">
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Name/OBA#/Address/Telephone #/Email"
                inputFieldName="Text73"
                inputValue="{{$attorney_email}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>