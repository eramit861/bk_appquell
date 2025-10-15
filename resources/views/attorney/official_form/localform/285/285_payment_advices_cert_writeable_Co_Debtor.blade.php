<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF UTAH') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <input type="text" name="<?php echo base64_encode('In re'); ?>" value="{{$onlyDebtor}}" class="form-control mt-1">
            <input type="text" name="<?php echo base64_encode('Debtors'); ?>" value="{{$spousename}}" class="form-control mt-1">
        </div>
        <label class="float_right">
            {{ __('Debtor(s)') }} 
        </label>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
        {{ __('PAYMENT ADVICES') }} <sup>1</sup> {{ __('CERTIFICATION') }}
        </h3>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('Under 11 U.S.C. § 521(a)(1)(B)(iv), I,') }}<sup>2</sup> 
            <input type="text" name="<?php echo base64_encode('Name'); ?>" value="" class="form-control mt-1 width_30percent">
             {{ __('hereby state as follows (select one option below):') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <div class="pl-4">
                <div class="d-flex">
                    <input type="checkbox" class="form-control w-auto mr-4 payment_received" name="<?php echo base64_encode('Check Box5');?>" value="Yes">
                    <label for="">1.</label>
                </div>
            </div>
            <div class=" w-100 pl-4">
                <p class="p_justify mb-0">
                {{ __('I have attached hereto, or previously filed with the Court, copies of') }} <span class="text-bold">all</span> {{ __('payment
                    advices or other evidence of payment received from any employer within 60days
                    before the date of the filing of my bankruptcy petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="pl-4">
                <div class="d-flex">
                    <input type="checkbox" class="form-control w-auto mr-4 not_payment_received" name="<?php echo base64_encode('Check Box6');?>" value="Yes">
                    <label for="">2.</label>
                </div>
            </div>
            <div class=" w-100 pl-4">
                <p class="p_justify mb-0">
                    {{ __('I did not receive any payment advices or other evidence of payment at any point
                    during the 60 days before the date of the filing of my bankruptcy petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="pl-4">
                <div class="d-flex">
                    <input type="checkbox" class="form-control w-auto mr-4" name="<?php echo base64_encode('Check Box7');?>" value="Yes">
                    <label for="">3.</label>
                </div>
            </div>
            <div class=" w-100 pl-4">
                <p class="p_justify mb-0">
                {{ __('I received payment advices from an employer during the 60 days before the date for
                    the filing of my bankruptcy petition but have been unable to locate all of the
                    documents or replacements. I understand that if I do not submit all payment advices
                    or other evidence of payment') }} <span class="text-bold">{{ __('within 45 days') }}</span> {{ __('from the filing of my bankruptcy
                    petition, my case will be') }} <span class="text-bold">{{ __('automatically dismissed') }}</span> {{ __('without further notice or hearing.') }}
                </p>
            </div>
        </div>
        <p class="mt-3"><span class="pl-4"></span> {{ __('I declare under penalty of perjury that the foregoing statement is true and correct to
            the best of my knowledge, information, and belief.') }}</p>
        <p>
        {{ __('Dated this') }}
            <input type="text" name="<?php echo base64_encode('Dated this'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Month'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text2'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>
    
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Signature of Debtor)"
            inputFieldName="Signature"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

</div>