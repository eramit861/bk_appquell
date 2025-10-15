<div>
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF GEORGIA') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Debtor(s)"
                debtorname={{$debtorname}}
                rows="3">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="Case Number."
                    casenoNameField="Case No"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <h3 class="text-center">{{ __('CERTIFICATE OF MAILING OF NOTICE OF') }}<br>{{ __('CORRECTION OF SOCIAL SECURITY NUMBER') }}</h3>
    </div>

    <div class="row">
       
        <div class="col-md-12">
            <p class="mt-3">
                <span class="pl-4"></span>
                {{ __('I certify that on') }} 
                <input type="text" class="form-control width_auto" name="<?php echo base64_encode('I certify that on'); ?>">
                 {{ __('(date), I mailed a Notice of Correction
                of Social Security Number for the debtor whose name is shown below to the trustee, all creditors
                and indenture trustees in this case, along with the nation’s three main credit reporting bureaus as
                shown below.') }}
            </p>
        </div>

        <div class="col-md-12 mt-3">
            <p>
                <span class="pl-4"></span>
                {{ __('This') }} 
                <input type="text" class="form-control width_5percent" name="<?php echo base64_encode('date'); ?>" value="{{$currentDay}}">
                {{ __('day of') }} 
                <input type="text" class="form-control width_auto" name="<?php echo base64_encode('TextBox0'); ?>" value="{{$currentMonth}}">
                , 20            
                <input type="text" class="form-control width_5percent" name="<?php echo base64_encode('undefined'); ?>" value="{{$currentYearShort}}">
            </p>
        </div>

        <div class="col-md-4 mb-3 mt-3">
            <p class="text-bold">
                Experian<br>
                {{ __('Profile Maintenance') }}<br>
                P.O. Box 9558<br>
                {{ __('Allen, TX 75013-9558') }}
            </p>
        </div>
        <div class="col-md-4 mb-3 mt-3">
            <p class="text-bold">
                Trans Union Corp.<br>
                {{ __('Attn: Public Records Dep.') }}<br>
                555 West Adams St.<br>
                {{ __('Chicago, IL 60661-3719') }}
            </p>
        </div>
        <div class="col-md-4 mb-3 mt-3">
            <p class="text-bold">
                Equifax<br>
                {{ __('P.O. Box 740256') }}<br>
                {{ __('Atlanta, GA 30374') }}
            </p>
        </div>

        <div class="col-md-6"></div>
        <div class="col-md-6">
            <label for="">{{ __('Pro Se Debtor Signature and Printed Name') }}</label>
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Debtor Signature1'); ?>" value="{{$debtor_sign}}">
            <input type="text" class="form-control mt-1 mb-3" name="<?php echo base64_encode('Debtor Signature2'); ?>" value="{{$onlyDebtor}}">
            <label class="">{{ __('Attorney Name, Address, Telephone, Email') }}</label>
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 1'); ?>" value="{{$attorney_name}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 2'); ?>" value="{{$attonryAddress1}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 3'); ?>" value="{{$attonryAddress2}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 4'); ?>" value="{{$attorneyPhone}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 5'); ?>" value="{{$attorney_email}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email6'); ?>" value="">
        </div>
    </div>
</div>

