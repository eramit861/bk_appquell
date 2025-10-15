<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE SOUTHERN DISTRICT OF IOWA') }}<br>
            {{ __('110 E. Court Avenue, Ste 300') }}<br>
            {{ __('Des Moines, Iowa 50309') }}<br>
            {{ __('www.iasb.uscourts.go') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group">
            <label>{{ __('In the Matter of:') }}</label>
            <textarea name="<?php echo base64_encode('Text3'); ?>" class="form-control" rows="4"><?php echo $debtorname ?? ''; ?></textarea>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center"> 
        {{ __('NOTICE OF CHANGE OF ADDRESS') }}<br>
        <span class="underline">{{ __('CHECK ONLY ONE') }}</span>
        </h3>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <p class="text-bold"><input name="<?php echo base64_encode('Check Box5');?>" value="Yes" type="checkbox" class="form-control w-auto">
        {{ __('Debtor’s Change of Address') }}</p>
        <p class="text-bold"><span class="pl-2"></span><input name="<?php echo base64_encode('Check Box6');?>" value="Yes" type="checkbox" class="form-control w-auto">
        {{ __('Creditor’s Change of Address') }}</p>
    </div>
 
    <div class="col-md-3 pt-2">
        <label>{{ __('NAME:') }}</label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Text7');?>" type="text" class="form-control mt-1" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-3 pt-2">
        <label>{{ __('OLD MAILING ADDRESS:') }}</label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Text8');?>" type="text" class="form-control mt-1" value="">
        <input name="<?php echo base64_encode('Text9');?>" type="text" class="form-control mt-1" value="">
        <input name="<?php echo base64_encode('Text10');?>" type="text" class="form-control mt-1" value="">
    </div>
    <div class="col-md-3 pt-2 mt-2">
        <label>{{ __('NEW MAILING ADDRESS:') }}</label>
    </div>
    <div class="col-md-9 mt-2">
        <input name="<?php echo base64_encode('Text11');?>"  type="text" class="form-control mt-1">
        <input name="<?php echo base64_encode('Text13');?>"  type="text" class="form-control mt-1">
        <input name="<?php echo base64_encode('Text14');?>"  type="text" class="form-control mt-1">
    </div>
    
    <div class="col-md-3 mt-3">
       <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text12"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-9 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text15"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-3 pt-2 mt-2">
        <label>{{ __('REQUESTOR’S NAME:') }}</label>
    </div>
    <div class="col-md-9 mt-2">
        <input name="<?php echo base64_encode('Text16');?>"  type="text" class="form-control mt-1" value="{{$attorney_name}}">
    </div>
    <div class="col-md-3 pt-2">
        <label>{{ __('ADDRESS:') }}</label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Text17');?>"  type="text" class="form-control mt-1" value="{{$attonryAddress1}}, {{$attonryAddress2}}">
        <input name="<?php echo base64_encode('Text18');?>"  type="text" class="form-control mt-1" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}">
    </div>
    <div class="col-md-3 pt-2">
        <label>{{ __('TELEPHONE NO.') }}</label>
    </div>
    <div class="col-md-9">
        <input name="<?php echo base64_encode('Tex19');?>"  type="text" class="form-control mt-1" value="{{$attorneyPhone}}">
    </div>
    <div class="col-md-12 mt-3">
        <p class=" text-center text-bold">{{ __('All future notices will be sent to the above address.') }}</p>
    </div>

</div>