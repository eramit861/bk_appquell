<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
        <select class="form-control w-auto" name="<?php echo base64_encode('topmostSubform[0].Page1[0].DropDownList1[0]');?>">
            <option></option>
            <option value="GAINESVILLE">{{ __('GAINESVILLE') }}</option>
            <option value="TALLAHASSEE">{{ __('TALLAHASSEE') }}</option>
            <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
            <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
        </select>{{ __('DIVISION') }}</h3>
    </div>
     
    <div class="col-md-6 border_1px br-0 p-3 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].TextField1[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 text-bold">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="topmostSubform[0].Page1[0].Text2[0]"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="topmostSubform[0].Page1[0].Text3[0]"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 ">
        <h3 class="text-center">{{ __('STATEMENT OF NO EMPLOYMENT INCOME') }}</h3>
    </div>
    <div class="col-md-2 mt-3">
        <p class="text_italic text-bold">{{ __('Check box if statement applies to debtor') }}</p>
    </div>
    <div class="col-md-10 mt-3">
        <div class="d-flex">
            <div class="">
               <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Check_Box6[0]');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-2">
            </div>
            <div class="w-100">
                <p>{{ __('Debtor') }},<input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Text7[0]');?>"  type="text" class="form-control w-auto">{{ __(', is not required to submit payment advices or
                other evidence of payment under 11 U.S.C. 521(a)(1)(B)(iv) and certifies as follows:') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Check_Box11[0]');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content">
            <div class="">
            <p class="p_justify">{{ __('Debtor was not employed and had no income from an employer within 60 days prior to the filing of the petition.') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Check_Box11[1]');?>" value="No" type="checkbox" class="form-control w-auto height_fit_content">
            <div class="">
            <p class="p_justify">{{ __('Debtor was self-employed and had no income from an employer within 60 days prior to the filing of the petition.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-2 mt-3">
        <p class="text_italic text-bold">{{ __('Check box if statement applies to joint-debtor') }}</p>
    </div>
    <div class="col-md-10 mt-3">
        <div class="d-flex">
            <div class="">
               <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Check_Box13[0]');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-2">
            </div>
            <div class="w-100">
                <p>
                {{ __('Joint-debtor') }},<input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Text15[0]');?>"  type="text" class="form-control w-auto">{{ __(',
                    is not required to submit payment advices or other evidence of payment under 11 U.S.C. 521(a)(1)(B)(iv) and certifies as follows:') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Check_Box16[0]');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content">
            <div class="">
            <p class="p_justify">{{ __('Debtor was not employed and had no income from an employer within 60 days prior to the filing of the petition.') }}</p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Check_Box16[1]');?>" value="No" type="checkbox" class="form-control w-auto height_fit_content">
            <div class="">
            <p class="p_justify">{{ __('Debtor was self-employed and had no income from an employer within 60 days prior to the filing of the petition.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
    <p>{{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].Text18[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Debtor:"
            inputFieldName="topmostSubform[0].Page1[0].Text20[0]"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="topmostSubform[0].Page1[0].Text21[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Joint-Debtor:"
            inputFieldName="topmostSubform[0].Page1[0].Text22[0]"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVertical>
        <div class="mt-2">
            <div class="row">
                <div class="col-md-4 p-2">
                    <label>By:</label>
                </div>
                <div class="col-md-8">
                    <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Text23[0]');?>" value="{{$attorny_sign}}" type="text" class="form-control">
                    <p class="text_italic text-center text-bold">{{ __('ATTORNEY SIGNATURE IF REPRESENTED BY COUNSEL') }}</p>
                </div>
            </div>
        </div>
    </div>
   
</div>