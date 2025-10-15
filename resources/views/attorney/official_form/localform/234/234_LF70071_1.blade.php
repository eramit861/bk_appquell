<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="IN RE"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
       <x-officialForm.caseNo
            labelText="{{ __('Case No.') }}"
            casenoNameField="CASE#"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="CHPT"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="underline ">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            <span class="pl-4"></span>
            {{ __('Pursuant to Bankruptcy Rules 1007(a) and Bankruptcy Rule 7007.1, and Local Rules
            1007-1, 2003-2, 7007.1-1 and 9014-1(B),') }}</p>
    </div>

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class="d-flex">
            <div class="text-center width_90percent">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="[Name of Corporate Party]"
                    inputFieldName="NAME"
                    inputValue=""
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="pt-2">
                <p>, a</p>
            </div>
        </div>
        <p>{{ __('(check one):') }}</p>
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box1');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('Corporate Debtor') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('Party to an adversary proceeding') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box3');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('Party to a contested matter') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('Member of committee of creditors') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-12">
        <p>{{ __('makes the following disclosure(s):') }}</p>
        <p><span class="text-bold">{{ __('All') }}</span> {{ __('corporations, other than a governmental unit, that directly') }} <span class="text-bold">{{ __('or indirectly') }}</span> {{ __('own ten percent
(10%) or more of any class of the corporation’s equity interests are listed below:') }}</p>
    </div>

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div class=" width_90percent">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="CORP"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="CORP1"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="CORP2"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="CORP3"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-12">
        <p class="text-bold">{{ __('OR') }}</p>
    </div>
    
    <div class="col-md-12">
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('There are no entities that directly or indirectly own 10% or more of any class of the corporation’s equity interest.') }}</p>
                <p>{{ __('Dated this') }} 
                    <input type="text" name="<?php echo base64_encode('DAY');?>" value="{{$currentMonth}}" class="form-control w-auto">
                    {{ __('day of') }} 
                    <input type="text" name="<?php echo base64_encode('month');?>" value="{{$currentDay}}" class="form-control width_5percent">
                    , 20
                    <input type="text" name="<?php echo base64_encode('year');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
                    .
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney Signature"
            inputFieldName="Attoney Signature"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <label for="">{{ __('[Insert Information Required by Local Rule 9004-1(C)]') }}</label>
            <textarea name="<?php echo base64_encode('Attorney Information');?>" class="form-control" rows="9">{{$attorney_name}}
State Bar No: {{$attorney_state_bar_no}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}, {{$attorneyFax}}
{{$attorney_email}}
{{$onlyDebtor}}
</textarea>
        </div>
    </div>
</div>