<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF WISCONSIN') }}</h3>
        <h3 class="mt-3">{{ __('CHANGE OF NAME – DEBTOR') }}</h3>
    </div>
    <input type="hidden" name="<?php echo base64_encode('Debtor Name');?>" value="{{$onlyDebtor}}">
    <input type="hidden" name="<?php echo base64_encode('Joint Debtor');?>" value="{{$spousename}}">
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField=""
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class="col-md-6 mt-3 pt-2">
        <label for="">{{ __('Previous Name of Debtor:') }} </label>
    </div>
    <div class="col-md-6 mt-3">
        <input type="text" name="<?php echo base64_encode('Previous Name of Debtor');?>" class="form-control">
    </div>
    
    <div class="col-md-6 mt-1 pt-2">
        <label for="">{{ __('Previous Name of Joint Debtor:') }}</label>
    </div>
    <div class="col-md-6 mt-1">
        <input type="text" name="<?php echo base64_encode('Previous Name of Joint Debtor');?>" class="form-control">
    </div>
   
    <div class="col-md-6 mt-1 pt-2">
        <label for="">{{ __('Current Name of Debtor:') }} </label>
    </div>
    <div class="col-md-6 mt-1">
        <input type="text" name="<?php echo base64_encode('Current Name of Debtor');?>" class="form-control">
    </div>

    <div class="col-md-6 mt-1 pt-2">
        <label for="">{{ __('Current Name of Joint Debtor:') }}</label>
    </div>
    <div class="col-md-6 mt-1">
        <input type="text" name="<?php echo base64_encode('Current Name of Joint Debtor');?>" class="form-control">
    </div>

    <div class="col-md-6 mt-1 pt-2">
        <label for="">{{ __('Change Requested By:') }} </label>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Print or Type Name"
                inputFieldName="Print or Type Name"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature"
                inputFieldName="Text1"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name of Submitting Law Firm or Attorney"
                inputFieldName="Printed Name of Submitting Law Firm or Attorney"
                inputValue="{{$atroneyName}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>


</div>