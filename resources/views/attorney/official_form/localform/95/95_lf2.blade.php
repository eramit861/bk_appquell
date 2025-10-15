<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
            <select name="<?php echo base64_encode('topmostSubform[0].Page1[0].Division[0]');?>" class="form-control w-auto">
                <option value="GAINESVILLE" selected="true">{{ __('GAINSVILLE') }}</option>
                <option value="TALLAHASSEE">{{ __('TALLAHASSEE') }}</option>
                <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
                <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
            </select>
            {{ __('DIVISION') }}
        </h3> 
    </div>

    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].DbtrNames[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="topmostSubform[0].Page1[0].CaseNo[0]"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="topmostSubform[0].Page1[0].Chapter[0]"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3 ">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
        <p class="mb-2">
        {{ __('Pursuant to Bankruptcy Rule 1007(a) or Bankruptcy Rule 7007.1,') }}
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CorpName1[0]');?>" class="form-control width_30percent">
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CorpName2[0]');?>" class="form-control width_90percent mt-1">
            {{ __(', a') }}
        </p>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CorpDbtr[0]');?>" value="1" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                {{ __('Corporate Debtor') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('topmostSubform[0].Page1[0].AdvParty[0]');?>" value="1" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                {{ __('Party to an adversary proceeding') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('topmostSubform[0].Page1[0].CntstdMtrPrty[0]');?>" value="1" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                {{ __('Party to a contested matter') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('topmostSubform[0].Page1[0].MbrCredCom[0]');?>" value="1" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                {{ __('Member of committee of creditors') }}
                </p>
            </div>
        </div>
        <P>{{ __('makes the following disclosure(s):') }}</P>
    </div>

    <div class="col-md-12 ">
        <p class="pl-4 mb-2">{{ __("All corporations, other than a governmental unit, that directly or indirectly own ten percent
        (10%) or more of any class of the corporation's equity interests, are listed below:") }} </p>
        <div class="pl-4">
            <textarea name="<?php echo base64_encode('topmostSubform[0].Page1[0].TextField1[0]');?>" class="form-control" rows="5"></textarea>
        </div>
        <p class="mt-2 mb-2">{{ __('OR') }}</p>
        <p class="pl-4">
            <input type="checkbox" name="<?php echo base64_encode('topmostSubform[0].Page1[0].NoEqHolders[0]');?>" value="1" class="form-control height_fit_content w-auto mr-0">
            <span class="pl-4"></span>
            {{ __("There are no entities that directly or indirectly own ten percent (10%) or more of any
            class of the corporation's equity interest") }}
        </p>
    </div>

    <div class=" col-md-5 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="topmostSubform[0].Page1[0].Date[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>      
    </div>        
    <div class=" col-md-1 mt-3 pt-2">
        <label class="float_right">By:</label>
    </div>      
    <div class=" col-md-6 mt-3">
        <input type="text" class="form-control" name="<?php echo base64_encode('topmostSubform[0].Page1[0].AttySign[0]');?>" value="{{$attorney_name}}">
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Addr1[0]');?>" value="{{$attonryAddress1}}, {{$attonryAddress2}}">
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Addr1[2]');?>" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}">
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Addr1[1]');?>" value="{{$attorneyPhone}}, {{$attorneyFax}}">
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Addr1[3]');?>" value="{{$attorney_email}}">
    </div>
</div>