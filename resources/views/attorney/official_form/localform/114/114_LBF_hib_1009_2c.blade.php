<div class="row">

    <div class="col-md-12">
        <h3 class="text-center">
        **Send to creditors - DO NOT FILE WITH COURT**
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text_italic">{{ __('Filer’s Name, Address, Phone, Fax, Email:') }}</label>
        <textarea name="<?php echo base64_encode('Filer');?>" class="form-control " rows="9">{{$attorney_name}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorneyFax}}
{{$attorney_email}}</textarea>
    </div>
    <div class="col-md-3 border_1px p-3 br-0 text-center">
        <img src="{{ asset('assets/img/dist_of_hawaii_logo.jpg')}}" alt="logo" />
        <p class="text-bold">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('DISTRICT OF HAWAII') }}<br>
            1132 Bishop Street, Suite 250<br>
            {{ __('Honolulu, Hawaii 96813') }}
        </p>
    </div>
    <div class="col-md-3 border_1px p-3 bl-0">
        <label class="float_right">{{ __('hib_1009-2c (11/16)') }}</label>
    </div>

    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Debtor');?>" class="form-control" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Case No.:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Case Number');?>" class="form-control" value="{{$caseno}}">
    </div>
    
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">Joint Debtor:<br>{{ __('(if any)') }}</label>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 br-0 bl-0">
        <input type="text" name="<?php echo base64_encode('Joint Debtor');?>" class="form-control" value="{{$spousename}}">
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Chapter:') }}</label>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 bl-0">
        <select name="<?php echo base64_encode('Chapter');?>" class="form-control w-auto">
            <option value=""></option>
            <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
            <option value="11">11</option>
            <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
            <option value="12">12</option>
            
        </select>
    </div>
    
    <div class="col-md-12 border_1px p-3 bt-0">
        <h3 class="text-center">
            CERTIFICATE OF SERVICE:<br>
            {{ __('NOTICE OF CORRECTED SOCIAL SECURITY NUMBER') }}
        </h3>
    </div>
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class=" p_justify">
            [<span class="text_italic">{{ __('Instructions to debtor(s):') }}</span> {{ __('After sending a Notice of Corrected Social Security Number, file this certificate to
            show service on all creditors and parties in interest, the trustee, the Office of the United States Trustee, and
            the credit reporting agencies listed on the notice form. Attach a list of names and addresses where the notice
            was sent.]') }}
        </p>
        <p class=" p_justify">
            {{ __('NOTICE IS HEREBY GIVEN:The undersigned declares under penalty of perjury that an amended Statement of Social Security Number or
            Individual Taxpayer Identification Number (Official Form B121) was submitted to the court and that a Notice
            of Corrected Social Security Number was sent to the following:') }}
        </p>
    </div>

    <div class="col-md-5 border_1px p-3 bt-0 br-0">
        <p class="text-center">
            Office of the United States Trustee<br>
            {{ __('300 Ala Moana Boulevard, Room 4108') }}<br>
            {{ __('Honolulu, HI 96850') }}
        </p>
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <div>
            <label class="">{{ __('Trustee:') }}</label>
        </div>
        <div class="mt-3 pt-1">
            <label class="">{{ __('Address:') }}</label>
        </div>
    </div>
    <div class="col-md-5 border_1px p-3 bt-0 bl-0">
        <div>
            <input type="text" name="<?php echo base64_encode('hib_1009-2c_1');?>" class="form-control">
        </div>
        <div class="mt-1">
            <textarea name="<?php echo base64_encode('hib_1009-2c_2');?>" class="form-control" rows="4"></textarea>
        </div>
    </div>

    <div class="col-md-12 border_1px p-3 bt-0 bb-0">
        <p class="">{{ __('Attach a list of names and addresses of all entities sent the Notice of Corrected Social Security Number.') }}</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>

    <div class="col-md-6 border_1px p-3 bt-0 br-0 ">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="hib_1009-2c_4"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 border_1px p-3 bt-0 bl-0 ">
        <input type="text" name="<?php echo base64_encode('hib_1009-2c_5');?>" class="form-control" value="{{$attorney_name}}">
        <label class=" float_left">{{ __('Signature') }}</label>
        <label class=" float_right">{{ __('(Print name if original signature)') }}</label>
    </div>
    
</div>