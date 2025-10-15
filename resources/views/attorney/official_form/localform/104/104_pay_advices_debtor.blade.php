<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF GEORGIA') }}<br>
            <select class="w-auto form-control" name="<?php echo base64_encode('Combo Box1'); ?>">
                <option value="div1" selected="true"> {{ __('ATLANTA DIVISION') }}</option>
                <option value="div2">{{ __('GAINESVILLE DIVISION') }}</option>
                <option value="div3">{{ __('NEWNAN DIVISION') }}</option>
                <option value="div4">{{ __('ROME DIVISION') }}</option>
            </select>
        </h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3 mt-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text7"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div> 
    <div class="col-md-6 border_1px p-3 mt-3">
        <div>
            <x-officialForm.caseNo
                labelText="{{ __('Case No:') }}"
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __("STATEMENT REGARDING PAYMENT ADVICES (11 U.S.C. '521(a)(1)") }})</h3>
        <p class="mb-0">
            {{ __('I, the undersigned debtor, hereby certify that during the 60 day period preceding the filing of my bankruptcy petition in this case,
            I did not receive pay stubs from an employer because:') }} 
        </p>
    </div>
    <div class="col-md-12 mt-3">
        <div class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2'); ?>" class=" form-control w-auto">
            <label> {{ __('I am unemployed; or') }}</label>                      
        </div>
        <div class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box3'); ?>" class=" form-control w-auto">
            <label> {{ __('I am self-employed; or') }}</label>                      
        </div>
        <div class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4'); ?>" class=" form-control w-auto">
            <label>{{ __('My employer did not provide pay stubs.') }}</label>                      
        </div>
        <div class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5'); ?>" class=" form-control w-auto">
            <label>{{ __('Other') }}</label>    
            <input name="<?php echo base64_encode('Text11'); ?>"  type="text" class="form-control width_40percent ">                  
        </div>
    </div>
  
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }}"
            dateNameField="Dated"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Signature of Debtor') }}"
            inputFieldName="Debtor"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>