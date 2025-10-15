<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
        <select class="form-control w-auto" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Division[0]');?>">
            <option value="Gainesville" selected="true">{{ __('GAINESVILLE') }}</option>
            <option value="TALLAHASSEE">{{ __('TALLAHASSEE') }}</option>
            <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
            <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
        </select></h3>
    </div>
     
    <div class="col-md-6 border_1px br-0 p-3 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].DbtrNames[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 text-bold">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="topmostSubform[0].Page1[0].CaseNo[0]"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="topmostSubform[0].Page1[0].Chapter[0]"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 ">
        <h3 class="text-center">{{ __('Notice of Change of Address of Debtor(s)') }}</h3>
        <p class="mt-3 text-bold">{{ __("Debtor's former mailing address:") }}</p>
    </div>
    <div class="col-md-2">
        <label>{{ __('Name:') }}</label>
    </div>
    <div class="col-md-8">
    <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField1[0]');?>" class=" form-control mt-1 ">
    </div>
    <div class="col-md-2"></div>

    <div class="col-md-2 mt-1">
        <label>{{ __('Address:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
        <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField1[1]');?>" class=" form-control mt-1">
    </div>
    <div class="col-md-2 mt-2"></div>
    <div class="col-md-12 mt-2 text-bold">
        <p>{{ __('Please be advised that effective') }} <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField2[0]');?>" class=" form-control mt-1 w-auto">{{ __(", the debtor(s)' new mailing address is:") }}</p>
    </div>
    <div class="col-md-2 mt-1">
        <label>{{ __('Name:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
       <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField1[3]');?>" class=" form-control mt-1 ">
    </div>
    <div class="col-md-2"></div>

    <div class="col-md-2 mt-1">
        <label>{{ __('Address:') }}</label>
    </div>
    <div class="col-md-8 mt-1">
       <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField1[2]');?>" class=" form-control mt-1 ">
    </div>
    <div class="col-md-2 mt-1"></div>

     <div class="col-md-4 mt-2">
        <label>{{ __('New address applies to (check one):') }}</label>
     </div>
     <div class="col-md-2 mt-2">
        <input name="<?php echo base64_encode('Group1');?>" value="Choice1" type="radio" class="form-control w-auto mt-0">
        <label for="">{{ __('Debtor Only') }}</label>
     </div>
     <div class="col-md-2 mt-2">
        <input name="<?php echo base64_encode('Group1');?>" value="Choice2" type="radio" class="form-control w-auto mt-0">
        <label for="">{{ __('Joint Debtor Only') }}</label>
     </div>
     <div class="col-md-2 mt-2">
        <input name="<?php echo base64_encode('Group1');?>" value="Choice3" type="radio" class="form-control w-auto mt-0">
        <label for="">{{ __('Both Debtors') }}</label>
     </div> 
     <div class="col-md-2 mt-2"></div>

    <div class="col-md-6"></div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature (if pro se)"
            inputFieldName="topmostSubform[0].Page1[0].TextField3[0]"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor Name Printed"
                inputFieldName="topmostSubform[0].Page1[0].TextField3[1]"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney Signaturer"
                inputFieldName="topmostSubform[0].Page1[0].TextField3[2]"
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Bar ID No."
                inputFieldName="topmostSubform[0].Page1[0].TextField3[3]"
                inputValue="{{$attorney_state_bar_no}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
   
</div>