<div class="row">
    <div class="col-md-12 mb-3 text-center">
        <h3 class="">
           {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
           {{ __('NORTHERN DISTRICT OF GEORGIA') }}
        </h3>
        <h3 class="mt-3">{{ __('Request for Change of Address') }}</h3>
    </div>

    <div class="col-md-12 mb-2">
        <div class="row">
            <div class="col-md-2 pt-2">
                <label>{{ __('Case Name:') }}</label>
            </div>
            <div class="col-md-10">
            <input name="<?php echo base64_encode('Text1'); ?>"  type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <x-officialForm.caseNo
            labelText="{{ __('Case No.:') }}"
            casenoNameField="Text2"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-3">
        <x-officialForm.caseNo
            labelText="{{ __('Chapter:') }}"
            casenoNameField="Text3"
            caseno={{$chapterNo}}>
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-5"></div>

    <div class="col-md-12 mt-3">
       <p class="text-bold mb-1">{{ __('Change of Address for:') }}</p>
        <p class="mb-1 pl-4"> {{ __('Debtor') }}
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4'); ?>" class=" form-control w-auto mr-4">
            {{ __('Creditor') }}
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5'); ?>" class=" form-control w-auto mr-4">
            {{ __('Attorney for Debtor') }}
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6'); ?>" class=" form-control w-auto mr-4">        
            {{ __('Attorney for Creditor') }}
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box7'); ?>" class=" form-control w-auto"> 
        </p>
    </div>
  
    <div class="col-md-12 mt-2">
       <p class="text-bold mb-0">{{ __('Change for:') }}</p>
        <p class="mb-1 pl-4"> {{ __('Notices ONLY') }} 
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box8'); ?>" class=" form-control w-auto mr-4">
            {{ __('Payments ONLY') }} 
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box9'); ?>" class=" form-control w-auto mr-4">
            {{ __('Notices and Payments') }}
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box10'); ?>" class=" form-control w-auto mr-4">        
        </p>
    </div>

    <div class="col-md-3 mt-1 pt-2">
        <p  class="mb-0">{{ __('EFFECTIVE DATE OF CHANGE:') }}</p>
    </div>
    <div class="col-md-9 mt-1">
        <input name="<?php echo base64_encode('Text11'); ?>"  type="text" class="w-auto form-control">
    </div>
    <div class="col-md-3 mt-1 pt-2">
        <p class="mb-0">{{ __('Name:') }} </p>
    </div>
    <div class="col-md-9 mt-1">
        <input name="<?php echo base64_encode('Text12'); ?>"  type="text" class=" form-control">
    </div>

    <div class="col-md-3 mt-1 pt-2">
        <p class="mb-0">{{ __('Prior Address:') }}</p>
    </div>
    <div class="col-md-9 mt-1">
        <input name="<?php echo base64_encode('Text13'); ?>"  type="text" class=" form-control mt-1">
        <input name="<?php echo base64_encode('Text14'); ?>"  type="text" class=" form-control mt-1">
        <input name="<?php echo base64_encode('Text15'); ?>"  type="text" class=" form-control mt-1">
    </div>
   
    <div class="col-md-12 mt-3 pl-3 pr-3" >
        <p class="w-100 mb-2" style="border-top:2px dotted black"></p>
    </div>
    <div class="col-md-3 mt-1 pt-2">
        <p class="mb-0">{{ __('New Address:') }}</p>
    </div>
    <div class="col-md-9 mt-1">
        <input name="<?php echo base64_encode('Text16'); ?>"  type="text" class=" form-control mt-1">
        <input name="<?php echo base64_encode('Text17'); ?>"  type="text" class=" form-control mt-1">
        <input name="<?php echo base64_encode('Text18'); ?>"  type="text" class=" form-control mt-1">
    </div>
    <div class="col-md-3 mt-3">
        <p>{{ __('Change of Address Was Furnished By:') }} </p>
    </div>
    <div class="col-md-9 mt-3">
        <p class="mb-1">
            <span class="ml-3">{{ __('Debtor') }}</span>
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check BoxDebtor'); ?>" class=" form-control w-auto mr-4">
            {{ __('Creditor') }}
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check BoxCreditor'); ?>" class=" form-control w-auto mr-4">
            {{ __('Attorney') }} 
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check BoxAttorney'); ?>" class=" form-control w-auto mr-4">   
        </p>
    </div>



    <div class="col-md-3 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }}"
            dateNameField="DateFurnished"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-9 mt-3">
        <div class="pl-2">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Signature of Filer') }} :"
            inputFieldName="FilerSig"
            inputValue="">
        </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Telephone Number') }}:"
            inputFieldName="FilerTelNo"
            inputValue="">
        </x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-10 border_1px mt-3 mb-3">
        <p class="text-center text-bold mb-0 pt-2 pb-2">{{ __('IF FILED BY ATTORNEY') }}</p>
    </div>
    <div class="col-md-1"></div>

    <div class="col-md-3 pt-2">
        <label>{{ __('Attorney Name:') }} </label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Text20'); ?>"  type="text" class=" form-control mt-1" value="{{$attorney_name}}">
    </div>
    <div class="col-md-3 pt-2">
        <label>{{ __('Bar ID:') }}</label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Text21'); ?>"  type="text" class=" form-control mt-1" value="{{$attorney_state_bar_no}}">
    </div>
    <div class="col-md-3 pt-2">
        <label>{{ __('Address:') }}</label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Text22'); ?>"  type="text" class=" form-control mt-1" value="{{$attonryAddress1}}, {{$attonryAddress2}}">
        <input name="<?php echo base64_encode('Text23'); ?>"  type="text" class=" form-control mt-1" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}">
    </div>
</div>