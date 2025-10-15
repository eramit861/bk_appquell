<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NORTH DAKOTA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtors"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Bankruptcy No:"
            casenoNameField="Case No"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-4">{{ __('Certificate of Service') }}</h3>
         <p>
            <span class="pl-4"></span>
            {{ __('The undersigned states that on') }} 
            <input type="text" name="<?php echo base64_encode('Day'); ?>" class="form-control width_5percent" value="{{$currentDay}}">
            {{ __('the day of') }} <input type="text" name="<?php echo base64_encode('Month'); ?>" class="form-control w-auto" value="{{$currentMonth}}">,
            20 <input type="text" name="<?php echo base64_encode('Year'); ?>" class="form-control width_5percent" value="{{$currentYearShort}}">,
            {{ __('I served the following documents') }} ({{ __('check') }} <span class="underline"> {{ __('all') }} </span> {{ __('documents that apply') }}):
        </p>
    </div>

    <div class="col-md-12">  
        <div class="d-flex mt-2"><span class="pl-4"></span> 
            <!-- checked by default -->
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check box 1'); ?>" value="Yes" checked="true">
            <div class="w-100">
                <label>{{ __('Notice of Chapter 7 Bankruptcy Case') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2"><span class="pl-4"></span> 
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check box 2'); ?>" value="Yes">
            <div class="w-100">
                <label> {{ __('Notice of Chapter 13 Bankruptcy Case') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2"><span class="pl-4"></span> 
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check box 3'); ?>" value="Yes">
            <div class="w-100">
                <label> {{ __('Amended Schedules') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2"><span class="pl-4"></span> 
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check box 4'); ?>" value="Yes">
            <div class="w-100">
                <label> {{ __('Notice to Creditors of Amended Schedules') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2"><span class="pl-4"></span> 
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check box 5'); ?>" value="Yes">
            <div class="w-100">
                <label> {{ __('Order of Discharge') }}</label>
            </div>
        </div>
        <div class="d-flex"><span class="pl-4"></span> 
            <input type="checkbox" class="form-control height_fit_content w-auto mt-2" name="<?php echo base64_encode('Check box 6'); ?>" value="Yes">
            <div class="w-100">
                <label>Other (state title of document(s)):<input type="text" name="<?php echo base64_encode('Other 1'); ?>" class="form-control width_80percent ml-4 mt-1"></label>
                <input type="text" name="<?php echo base64_encode('Other 2'); ?>" class="form-control mt-1">
                <input type="text" name="<?php echo base64_encode('Other 3'); ?>" class="form-control mt-1">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">    
        <p class="mb-3 mt-3">
        {{ __('by placing the foregoing documents in an envelope addressed to each entity as indicated below and mailing by first class mail postage prepaid to:') }}
          ({{ __('type the Name, Address, City, State and Zip Code for') }} <span class="text-bold underline"> {{ __('each') }} </span> {{ __('entity served') }} <span class="text-bold underline"> or </span> {{ __('attach a creditor matrix') }}):
        </p>
        <div class="row">
            <div class="col-md-6"> 
                <textarea name="<?php echo base64_encode('Text8'); ?>"  class="form-control width_90percent ml-4" rows="10"></textarea>
            </div>   
            <div class="col-md-6">
                <textarea name="<?php echo base64_encode('Text9'); ?>"  class="form-control  width_90percent" rows="10"></textarea>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 mt-3">
    <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
         <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text1"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent="Print Name and Address:"
                inputFieldName="Print Name and Address 1"
                inputValue="{{$onlyDebtor}}"
            ></x-officialForm.labelInputVertical>
        </div>
        <input type="text" name="<?php echo base64_encode('Print Name and Address 2'); ?>" class="form-control mt-1" value="{{$debtoraddress}}">
        <input type="text" name="<?php echo base64_encode('Print Name and Address 3'); ?>" class="form-control mt-1" value="{{$debtorCity}} {{$debtorState}}, {{$debtorzip}}">
        <input type="text" name="<?php echo base64_encode('Print Name and Address 4'); ?>" class="form-control mt-1" value="">
    </div>
</div>