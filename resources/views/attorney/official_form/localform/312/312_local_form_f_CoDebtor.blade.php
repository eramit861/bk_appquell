<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF WYOMING') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <input type="text" name="<?php echo base64_encode('Text36'); ?>" value="{{$onlyDebtor}}" class="form-control mt-1">
            <input type="text" name="<?php echo base64_encode('Text37'); ?>" value="{{$spousename}}" class="form-control mt-1">
            <label for="">{{ __('(INSERT NAME OF DEBTOR(S))') }}</label>
        </div>
        <p class="text-center mb-0">
            {{ __('Debtor(s).') }} 
        </p>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Text38"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Text39"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>
    <div class="col-md-12 bt-0 p-3 border_1px">
        <h3 class="text-center">{{ __('STATEMENT UNDER PENALTY OF PERJURY CONCERNING PAYMENT ADVICES') }}<br>{{ __('DUE PURSUANT TO 11 U.S.C. §521(A)(1)(B)(IV)') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p><span class="pl-4"></span>
            I*, 
            <input type="text" name="<?php echo base64_encode('Text40');?>" value="{{$spousename}}" class=" form-control width_30percent">    
            {{ __("(Co-Debtor's Name), state as follows:") }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('I did not file with the Court copies of all payment advices or other evidence of payment
            received within 60 days before the date of the filing of the petition from any employer because:') }}
        </p>
        <div class="d-flex">
            <div class="pl-3 pt-2">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box41');?>" class=" form-control w-auto height_fit_content spouse_not_payment_received">    
            </div>
            <div class="pl-4 w-auto">
                <p>
                {{ __('a') }}) 
                    {{ __('I was not employed during the period immediately preceding the filing of the
                    above-referenced case') }} 
                    <input type="text" name="<?php echo base64_encode('Text45');?>" class=" form-control w-auto">
                    {{ __('(state the dates that you were not employed);') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-3">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box42');?>" class=" form-control w-auto height_fit_content spouse_payment_received">    
            </div>
            <div class="pl-4 w-auto">
                <p>
                    {{ __('b) I was employed during the period immediately preceding the filing of the
                    above-referenced case but did not receive any payment advices or other evidence of payment
                    from my employer within 60 days before the date of the filing of the petition;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-3">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box43');?>" class=" form-control w-auto height_fit_content">    
            </div>
            <div class="pl-4 w-auto">
                <p>
                    {{ __('c) I am self-employed and do not receive any evidence of payment;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-3 pt-2">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box44');?>" class=" form-control w-auto height_fit_content">    
            </div>
            <div class="pl-4 w-auto">
                <p>
                    d) {{ __('Other (Please Explain )') }}
                    <input type="text" name="<?php echo base64_encode('Text46');?>" class=" form-control w-auto">
                </p>
            </div>
        </div>
        <p>{{ __('I declare under penalty of perjury that the foregoing statement is true and correct.') }}</p>
        <p>
        {{ __('Dated this') }}
            <input type="text" name="<?php echo base64_encode('Text48'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Text49'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text50'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Debtor') }}"
            inputFieldName="Text47"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3 pt-2">
        <label for="">{{ __('(Signature of Debtor)') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('• A separate form must be filed by each Debtor') }}</p>
        <h3 class="text-center mt-3 underline">{{ __('Certificate of Service') }}</h3>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('I certify that I served true and correct copies of the foregoing declaration by mailing a copy to
            each the following on this') }}
            <input type="text" name="<?php echo base64_encode('Text51'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Text52'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text53'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
        </p>
        <p>{{ __('Trustee Assigned to the Case') }}</p>
        <p>{{ __("(Trustee’s Address)") }}</p>
        <p>{{ __('United States Trustee') }}</p>
    </div>

</div>