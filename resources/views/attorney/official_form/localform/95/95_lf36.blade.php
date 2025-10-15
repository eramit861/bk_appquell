<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
        <select class="form-control w-auto" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Division[0]');?>">
            <option value="GAINESVILLE" selected="true">{{ __('GAINESVILLE') }}</option>
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
        <h3 class="text-center">{{ __('VERIFICATION OF CREDITOR MAILING MATRIX') }}</h3>
        <p class="mt-3"><span class="pl-4"></span>
            {{ __('I/We, the above named debtor(s), do hereby verify under penalty of perjury that the mailing
            matrix (list of creditors) attached or previously filed in this case is true and correct to the best of
            my/our knowledge.') }}
        </p>
    </div>
    <div class="col-md-5 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor's Signature"
            inputFieldName="topmostSubform[0].Page1[0].Signature[0]"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name of Debtor"
                inputFieldName="topmostSubform[0].Page1[0].Signature[1]"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-5 mt-3 pl-5">
        <x-officialForm.dateSingle
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].Date[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-1"></div>

    <div class="col-md-5 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor's Signature"
            inputFieldName="topmostSubform[0].Page1[0].Signature[2]"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name of Joint Debtor"
                inputFieldName="topmostSubform[0].Page1[0].Signature[3]"
                inputValue="{{$spousename}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-6 mt-3 pl-5">
        <x-officialForm.dateSingle
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].Date[1]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-1"></div>

</div>