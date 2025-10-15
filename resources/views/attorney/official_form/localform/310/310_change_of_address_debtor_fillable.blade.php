<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF WISCONSIN') }}</h3>
        <h3 class="mt-3">{{ __('CHANGE OF ADDRESS - DEBTOR') }}</h3>
    </div>

    <input type="hidden" name="<?php echo base64_encode('undefined');?>" value="{{$onlyDebtor}}">
    <input type="hidden" name="<?php echo base64_encode('Debtors');?>" value="{{$spousename}}">
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
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

    <div class="col-md-12 mt-3">
        <p class="mb-2">
            {{ __('Check who this address change is affecting') }}
        </p>
        <p class="mb-2">
            <span class="pl-3"></span>
            <input type="radio" name="<?php echo base64_encode('Group1');?>" class="w-auto form-control height_fit_content" value="Choice1">
            {{ __('Both Debtors') }}
        </p>
        <p class="mb-2">
            <span class="pl-3"></span>
            <input type="radio" name="<?php echo base64_encode('Group1');?>" class="w-auto form-control height_fit_content" value="Choice2">
            {{ __('Debtor only') }}
        </p>
        <p>
            <span class="pl-3"></span>
            <input type="radio" name="<?php echo base64_encode('Group1');?>" class="w-auto form-control height_fit_content" value="Choice3">
            {{ __('Joint Debtor only') }}
        </p>
    </div>

    <div class="col-md-3 pt-2">
        <label for="">{{ __('New Address:') }} </label>
    </div>
    <div class="col-md-9">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Street Address"
                inputFieldName="Street Address"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="City, State, and Zip Code"
                inputFieldName="City State and Zip Code"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-3 pt-2 mt-3">
        <label for="">{{ __('Telephone Number With Area Code :') }}  </label>
    </div>
    <div class="col-md-9 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="To Be Completed by Pro Se Debtors Only"
                inputFieldName="To Be Completed by Pro Se Debtors Only"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-3 pt-2 mt-3">
        <label for="">{{ __('Change Requested By:') }}  </label>
    </div>
    <div class="col-md-9 mt-3">
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