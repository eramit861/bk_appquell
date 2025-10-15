<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE MIDDLE DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('IN THE MATTER OF:') }}</label>
            <textarea name="<?php echo base64_encode('Debtors'); ?>" value="" class=" form-control" rows="2" style="padding-right:5px;">{{$debtorname}}</textarea>
            <p class="text-center w-100 mb-0">{{ __('DEBTOR(S)') }}</p>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case Number:"
                casenoNameField="Case Number"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class=" col-md-12 text-center mb-3 mt-3">
        <h3 class=" underline">{{ __('CERTIFICATE OF SERVICE') }}</h3>
    </div>
    <div class=" col-md-12">
        <p>
            <span class="pl-4"></span>
            {{ __('I certify that I am more than 18 years of age and that on') }} 
            <input type="text"  name="<?php echo base64_encode('Date'); ?>" class="form-control w-auto" value="{{$attorneyDate}}">
            , {{ __('I served a copy of') }}
            <input type="text"  name="<?php echo base64_encode('Document served'); ?>" class="form-control mt-1 width_40percent">
            {{ __('on the following parties in this matter:') }}
        </p>
    </div>
    <div class="col-md-12 table_sect table_sect_head_border mt-3">
        <table class="w-100">
            <tr>
                <th class="p-2">{{ __('Name and Address') }}</th>
                <th class="p-2">{{ __('Mode of Service') }}</th>
            </tr>
            <tr>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Name and Address 1'); ?>" class="form-control" rows="4"></textarea>
                </td>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Mode of Service 1'); ?>" class="form-control" rows="4"></textarea>
                </td>
            </tr>
            <tr>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Name and Address 2'); ?>" class="form-control" rows="4"></textarea>
                </td>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Mode of Service 2'); ?>" class="form-control" rows="4"></textarea>
                </td>
            </tr>
            <tr>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Name and Address 3'); ?>" class="form-control" rows="4"></textarea>
                </td>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Mode of Service 3'); ?>" class="form-control" rows="4"></textarea>
                </td>
            </tr>
            <tr>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Name and Address 4'); ?>" class="form-control" rows="4"></textarea>
                </td>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Mode of Service 4'); ?>" class="form-control" rows="4"></textarea>
                </td>
            </tr>
            <tr>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Name and Address 5'); ?>" class="form-control" rows="4"></textarea>
                </td>
                <td class="p-1">
                    <textarea name="<?php echo base64_encode('Mode of Service 5'); ?>" class="form-control" rows="4"></textarea>
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 mt-3">
        <p>
            {{ __('I certify under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date signed"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-3">
                <label for="">{{ __('Name: s/') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Attorney name'); ?>" type="text" value="{{$attorny_sign}}" class="form-control">
            </div>
            <div class="col-md-12 text-center">
                <label class="text_italic">{{ __('Printed Name of Attorney') }}</label>
            </div>
            <div class="col-md-3">
                <label for="">{{ __('Address:') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Address'); ?>" type="text" value="{{$attonryAddress1}}, {{$attonryAddress2}}" class="form-control">
            </div>
            <div class="col-md-12 mt-1">
            <input name="<?php echo base64_encode('Address 2'); ?>" type="text" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" class="form-control">
            </div>
        </div>
        
        
    </div>
</div>