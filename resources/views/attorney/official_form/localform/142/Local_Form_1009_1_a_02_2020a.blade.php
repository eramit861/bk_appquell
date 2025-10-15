<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}
            <br>
            {{ __('EASTERN DISTRICT OF KENTUCKY') }}
            <br>
            <input name="<?php echo base64_encode('TextBox0');?>" type="text" class="form-control w-auto"> {{ __('DIVISION') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="CASE NO."
                casenoNameField="TextBox2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3 class="underline">{{ __('AMENDMENT TO LISTS, SCHEDULES, AND/OR STATEMENTS') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            {{ __('Comes the Debtor(s) in person and makes application for leave to amend the lists, schedules and/or statements previously filed as follows:') }}
        </p>
    </div>

    <div class="col-md-12 mt-3 table_sect table_sect_head_border">
        <table class="w-100">
            <tr>
                <th class="p-2">{{ __('Item Amended') }}</th>
                <th class="p-2">{{ __('Description of Amendment') }}</th>
            </tr>
            <tr>
                <td class="p-1">
                    <input type="text" name="<?php echo base64_encode('TextBox3');?>" class="form-control">
                </td>
                <td class="p-1">
                    <input type="text" name="<?php echo base64_encode('TextBox4');?>" class="form-control">
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"><span>
            I, 
            <input type="text" name="<?php echo base64_encode('TextBox5');?>" value="{{$onlyDebtor}}" class="form-control width_50percent">
            {{ __(', the petitioner named in the foregoing
            amendment, certify under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    
    <div class="col-md-2 mt-3 pt-2">
        <p>
            {{ __('Executed on') }}
        </p>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('TextBox6');?>" value="{{$currentDate}}" class="date_filed form-control">
    </div>
    <div class="col-md-6 mt-3"></div>

    <div class="col-md-6 mt-3">
        <x-officialForm.signVertical
            labelText="Debtor"
            signNameField="TextBox7"
            sign="{{$onlyDebtor}}"
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.signVertical
            labelText="Joint Debtor (if applicable)"
            signNameField="TextBox8"
            sign="{{$spousename}}"
        ></x-officialForm.signVertical>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3 class="underline">{{ __('CERTIFICATE OF SERVICE') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"><span>
            {{ __("In addition to the parties who will be served by the Court's ECF System, I certify that a copy of 
            this amendment was served this") }}
            <input type="text" name="<?php echo base64_encode('TextBox9');?>" value="{{$currentMonth}}" class="form-control w-auto mt-1">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('TextBox10');?>" value="{{$currentDay}}" class="form-control width_5percent mt-1">
             , 20
            <input type="text" name="<?php echo base64_encode('TextBox11');?>" value="{{$currentYearShort}}" class="form-control width_5percent mt-1">
            {{ __('on the following parties affected thereby:') }}
        </p>
        <p class="mb-1">
            <span class="pl-4"><span>
            {{ __('(Insert name and address of each party served, as well as method of service - i.e., first class mail, hand delivery, etc.)') }}
        </p>
        <textarea name="<?php echo base64_encode('TextBox12');?>"  class="form-control" rows="3"></textarea>
    </div>

    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <input type="text" name="<?php echo base64_encode('TextBox13');?>" value="{{$attorny_sign}}" class="form-control">
        <p class="mt-2 mb-1">{{ __('Petitioner/Attorney') }}</p>
        <textarea name="<?php echo base64_encode('TextBox14');?>"  class="form-control" rows="7">{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}, {{$attorneyFax}}
{{$attorney_email}}</textarea>
    </div>

</div>