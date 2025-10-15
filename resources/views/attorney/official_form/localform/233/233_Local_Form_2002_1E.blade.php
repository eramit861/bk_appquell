<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
     
    <div class="col-md-6 border_1px br-0 p-3">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text26');?>" class="form-control" rows="2">{{$debtorname}}</textarea>
            <label class="float_right">{{ __('Debtor') }}</label>
        </div>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 ">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text24"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text25"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('CERTIFICATE OF SERVICE') }}</h3>
        <p class="text-center text_italic">{{ __('(WHEN NOTICE IS ACCOMPLISHED BY MAIL OR SERVICE OTHER THAN ELECTRONIC)') }}</p>
        <p class="p_justify">
            I,<input name="<?php echo base64_encode('Text30');?>"  type="text" class="form-control mt-1 width_30percent">,
            {{ __('declare under penalty of perjury that on') }}<input name="<?php echo base64_encode('Text31');?>"  type="text" class="form-control mt-1 w-auto">,
                {{ __('I mailed copies of the foregoing') }} <input name="<?php echo base64_encode('Text33');?>"  type="text" class="form-control mt-1 width_40percent"> {{ __('along
            with a copy of the Notice of Electronic Filing “NEF” (or copies of the attached') }}
            <input name="<?php echo base64_encode('Text32');?>"  type="text" class="form-control mt-1 width_30percent">{{ __('along with a copy of the Notice of Electronic Filing
            “NEF” ) in compliance with Local Rule 5005-1(E) by first class mail postage prepaid to each entity
            named below at the address stated below for each entity:') }}
        </p>
    </div>
    <div class="col-md-12"> <p>{{ __('(state name and address for each entity served)') }}</p></div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Executed on:"
            dateNameField="Text27"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 pl-5">
       <x-officialForm.debtorSignVertical
            labelContent="Signed:"
            inputFieldName="Text28"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVertical>
        <div class="mt-1">
            <textarea name="<?php echo base64_encode('Text29');?>" value="" class=" form-control" rows="6">{{$attorney_name}}, {{$attorney_state_bar_no}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorney_email}}</textarea>
        </div>
    </div>

</div>