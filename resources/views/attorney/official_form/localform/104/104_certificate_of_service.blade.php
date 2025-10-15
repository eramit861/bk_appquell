<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF GEORGIA') }}<br>
            <select class="w-auto form-control" name="<?php echo base64_encode('division dropdown'); ?>">
                <option value=" "></option>
                <option value="div1"> {{ __('ATLANTA DIVISION') }}</option>
                <option value="div2">{{ __('GAINESVILLE DIVISION') }}</option>
                <option value="div3">{{ __('NEWNAN DIVISION') }}</option>
                <option value="div4">{{ __('ROME DIVISION') }}</option>
            </select>
        </h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text5"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div> 
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="{{ __('Case No:') }}"
                casenoNameField="Text6"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Text7"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 border_bottom_1px pb-3">
        <h3 class="text-center mb-2">{{ __('CERTIFICATE OF SERVICE') }}</h3>

        <p class="mt-4">
        {{ __('I, the undersigned, hereby certify under penalty of perjury that I am, and at all times hereinafter
            mentioned, was more than 18 year of age, and that on the') }}  
            <input name="<?php echo base64_encode('Text8'); ?>"  type="text" class="width_5percent form-control" value="{{$currentDay}}">
            {{ __('day of') }}  
            <input name="<?php echo base64_encode('Text9'); ?>"  type="text" class="w-auto form-control" value="{{$currentMonth}}">, 20 
            <input name="<?php echo base64_encode('Text10'); ?>"  type="text" class="width_5percent form-control" value="{{$currentYearShort}}">,
            {{ __('I served a copy of') }}<input name="<?php echo base64_encode('Text11'); ?>" type="text"  class="width_80percent form-control mb-1">,
            {{ __('which was filed in this bankruptcy matter on the') }}  
            <input name="<?php echo base64_encode('Text12'); ?>"  type="text" class="width_5percent form-control" value="{{$currentDay}}">day of  
            <input name="<?php echo base64_encode('Text13'); ?>"  type="text" class="w-auto  form-control" value="{{$currentMonth}}">,
             20 <input name="<?php echo base64_encode('Text14'); ?>"  type="text" class="width_5percent form-control" value="{{$currentYearShort}}">.
        </p>
    </div>
    <div class="col-md-4 mt-3">
        <span>{{ __('Mode of service (check one):') }}</span>
    </div>
    <div class="col-md-4 mt-3">
        <div class="">
            <input type="radio" value="Choice1" name="<?php echo base64_encode('Radio Mailed'); ?>" class=" form-control w-auto">
            <label>{{ __('MAILED') }}</label>                      
        </div>
    </div>
    <div class="col-md-4 mt-3">
        <div class="">
            <input type="radio" value="Choice2" name="<?php echo base64_encode('Radio Mailed'); ?>" class=" form-control w-auto">
            <label>{{ __('HAND DELIVERED') }}</label>                      
        </div>
    </div>
   <div class="col-md-12 mt-3">
       <p>{{ __('Name and Address of each party served (If necessary, you may attach a list.):') }}</p>
   </div>

    <div class="col-md-6 mt-1">
        <textarea name="<?php echo base64_encode("Address 1"); ?>" class="form-control" rows="5"></textarea>
    </div>
    <div class="col-md-6 mt-1">
        <textarea name="<?php echo base64_encode("Address 2"); ?>" class="form-control" rows="5"></textarea>
    </div>
   
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('I CERTIFY UNDER PENALTY OF PERJURY THAT THE FOREGOING IS TRUE AND CORRECT.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated') }}:"
            dateNameField="Text18"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Signature:') }}"
            inputFieldName="Text123"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVertical>
        <div class="mt-1">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Printed Name:') }}"
            inputFieldName="Text19"
            inputValue="{{$attorney_name}}">
        </x-officialForm.debtorSignVertical>
        </div>
        <div class="row">
            <div class="col-md-4 pl-2">
                <label for="">{{ __('Address:') }}</label>
            </div>
            <div class="col-md-8">
               <textarea name="<?php echo base64_encode("Text20"); ?>" class="form-control" rows="3">{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}</textarea>
            </div>
        </div>
        <div class="mt-1">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Phone:') }}"
            inputFieldName="Text21"
            inputValue="{{$attorneyPhone}}">
        </x-officialForm.debtorSignVertical>
        </div>
    </div>
</div>