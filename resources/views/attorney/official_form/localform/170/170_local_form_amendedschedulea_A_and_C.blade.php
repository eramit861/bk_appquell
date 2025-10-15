<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('AMENDED SCHEDULES A/B AND C') }}<br>{{ __('TO CORRECT DESCRIPTION OF REALTY CLAIMED EXEMPT') }}</h3>
        <p class="mt-3 p_justify">
            {{ __('Schedule A/B and/or Schedule C filed in this case identified and claimed as exempt certain real property of the
            debtor(s). The description of that real property was stated as:') }}
        </p>
        <p class=" text_italic p_justify">
            {{ __('(Insert the property description in original Schedule A or A/B and Schedule C. If different, insert and specify each description)') }}
        </p>
    </div>   
    
    <div class="col-md-6">
        <label class=" underline">{{ __('Legal Description Including County') }}</label>
        <textarea name="<?php echo base64_encode('Text5'); ?>" class=" form-control" rows="9"></textarea>
    </div>
    <div class="col-md-3">
        <label class=" underline">{{ __('Market Value') }}</label>
        <textarea name="<?php echo base64_encode('Text6'); ?>" class=" form-control" rows="9"></textarea>
    </div>
    <div class="col-md-3">
        <label class=" underline">{{ __('Amount of Value Claimed Exempt') }}</label>
        <textarea name="<?php echo base64_encode('Text7'); ?>" class=" form-control" rows="9"></textarea>
    </div>

    <div class=" col-md-12 mt-3">
        <p class="p_justify">
        {{ __('The foregoing description was incorrect. Schedules A/B and C are amended by deleting the foregoing and inserting
            the following, and the debtor(s) claims the following real property as exempt, pursuant to') }} 
            <input type="checkbox" name="<?php echo base64_encode('Check Box1'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            {{ __('11 U.S.C. § 522(d) or') }}
            <input type="checkbox" name="<?php echo base64_encode('Check Box2'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            {{ __('Minn. Stat. Chapter 510') }}: (<span class=" text_italic">{{ __('In large space below, insert the correct legal description adding “in') }}
            <input type="text" name="<?php echo base64_encode('Minn Stat Chapter 510 In large space below insert the correct legal description adding in'); ?>" class="form-control w-auto">
            {{ __('County, Minnesota.”') }}</span>)
        </p>
    </div>   

    <div class="col-md-6">
        <label class=" underline">{{ __('Legal Description Including County') }}</label>
        <textarea name="<?php echo base64_encode('Text8'); ?>" class=" form-control" rows="9"></textarea>
    </div>
    <div class="col-md-3">
        <label class=" underline">{{ __('Market Amount or Value or') }}</label>
        <textarea name="<?php echo base64_encode('Text9'); ?>" class=" form-control" rows="9"></textarea>
    </div>
    <div class="col-md-3">
        <label class=" underline">{{ __('Value Claimed Exempt') }}</label>
        <textarea name="<?php echo base64_encode('Text10'); ?>" class=" form-control" rows="9"></textarea>
    </div>

    <div class=" col-md-12 mt-3">
        <p class="p_justify text_italic">
            * {{ __('Market Value without deduction for secured claims or exemption claimed.') }}
        </p>
        <p class="p_justify">
            {{ __('Verification I (We), debtor(s) named in this amended schedule, declare under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>   


    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on:"
            dateNameField="Executed on"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed_2"
                inputValue={{$attorny_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-6 mt-1"></div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Print Attorney Name:"
                inputFieldName="Print Attorney Name"
                inputValue={{$attorney_name}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-6 mt-1">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Debtor 1') }}</label>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Address:"
                inputFieldName="Address 1"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row mt-1">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <input type="text" class=" form-control" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" name="<?php echo base64_encode('Address 2'); ?>">
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-1">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed_3"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Debtor 2 (if joint case)') }}</label>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Phone Number:"
                inputFieldName="Phone Number"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="License Number:"
                inputFieldName="License Number"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>


    <div class=" col-md-12 mt-3">
        <p class="p_justify">
         <span class=" underline">{{ __('SERVICE OF COPIES') }}</span> {{ __('- The attorney should serve any entity that filed a request for notice, and each entity
            listed on the matrix and file proof of such service.') }}
        </p>
    </div>   
</div>    