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
        <h3 class="text-center">{{ __('Notice of Correction of Social Security Number') }}</h3>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('An incorrect social security number for the debtor whose name is shown below was submitted
            in this case and thus appears on notices mailed by the court. Please correct your records
            accordingly.') }}
        </p>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-3">
            <label class="">{{ __('Debtor name:') }}</label>
        </div>
        <div class="col-md-7">
            <input type="text" class="form-control" name="<?php echo base64_encode('Debtor name'); ?>" value="{{$onlyDebtor}}">
        </div>
        <div class="col-md-1"></div>
        
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <label class="">{{ __('Incorrect 9-digit SSN:') }}</label>
        </div>
        <div class="col-md-7 mt-1">
            <input type="text" class="form-control" name="<?php echo base64_encode('Incorrect 9digit SSN'); ?>">
        </div>
        <div class="col-md-1 mt-1"></div>
        
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <label class="text-bold">{{ __('Correct 9-digit SSN:') }}</label>
        </div>
        <div class="col-md-7 mt-1">
            <input type="text" class="form-control" name="<?php echo base64_encode('Correct 9digit SSN'); ?>">
        </div>
        <div class="col-md-1 mt-1"></div>

        <div class="col-md-12 mt-3">
            <p>
            {{ __('This') }} 
                <input type="text" class="form-control width_5percent" name="<?php echo base64_encode('This'); ?>" value="{{$currentDay}}">
                {{ __('day of') }} 
                <input type="text" class="form-control width_auto" name="<?php echo base64_encode('day of'); ?>" value="{{$currentMonth}}">
                , 20            
                <input type="text" class="form-control width_5percent" name="<?php echo base64_encode('year'); ?>" value="{{$currentYearShort}}">
            </p>
        </div>

        <div class="col-md-6"></div>
        <div class="col-md-6">
            <label for="">{{ __('Pro Se Debtor Signature and Printed Name') }}</label>
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Pro Se Debtor Signature and Printed Name 1'); ?>" value="{{$debtor_sign}}">
            <input type="text" class="form-control mt-1 mb-3" name="<?php echo base64_encode('Pro Se Debtor Signature and Printed Name 2'); ?>" value="{{$onlyDebtor}}">
            <label class="">{{ __('Attorney Name, Address, Telephone, Email') }}</label>
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 1'); ?>" value="{{$attorney_name}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 2'); ?>" value="{{$attonryAddress1}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 3'); ?>" value="{{$attonryAddress2}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 4'); ?>" value="{{$attorneyPhone}}">
            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Attorney Name Address Telephone Email 5'); ?>" value="{{$attorney_email}}">
        </div>

        <div class="col-md-12 mt-3">
            <label class="text-bold">{{ __('NOTE TO THE SENDER OF THIS NOTICE:') }}</label>
            <ul class="dot_list pl-3">
                <li>{{ __('DO NOT file this notice with the court.') }}</li>
                <li>{{ __('Send this notice all parties and credit reporting agencies.') }}</li>
                <li>{{ __('File an Amended B121 with the court.') }}</li>
                <li>{{ __('File the Certification of Mailing of Notice of Correction of Social Security Number with the
                    court. (Docket as Certificate of Service and link to the B121 or Amended B121).') }}</li>
            </ul>
            <label class="text-bold">{{ __('NOTE TO RECIPIENT OF THIS NOTICE:') }}</label>
            <p>{{ __("You will NOT be able to view this notice containing the debtor's full SSN on the court's internet
                website.") }}</p>
        </div>
    </div>
</div>

