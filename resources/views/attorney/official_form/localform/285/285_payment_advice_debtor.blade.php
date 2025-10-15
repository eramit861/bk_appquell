<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF UTAH') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
    <label for="">{{ __('In re:') }}</label>
    <input name="<?php echo base64_encode('In re');?>"  type="text" class="form-control mt-1" value="{{$onlyDebtor}} and">
    <input name="<?php echo base64_encode('Debtors');?>"  type="text" class="form-control mt-1" value="{{$spousename}}">
    <label for="">{{ __('Debtor(s)') }}</label>

    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('PAYMENT ADVICES') }} <sup> 1 </sup> {{ __('CERTIFICATION') }}</h3>
    </div>
    <div class="col-md-12">
        <p class=""><span class="pl-4"></span>
            {{ __('Under 11 U.S.C. § 521(a)(1)(B)(iv), I,') }}<sup> 2</sup>
            <input name="<?php echo base64_encode('Name');?>"  type="text" class="form-control mt-1 width_30percent">
            {{ __('hereby state as follows (select one option below):') }}
        </p>
    </div>
    <div class="col-md-12">
        <div class="d-flex pl-4 mt-2">
        <input name="<?php echo base64_encode('Check Box5');?>" value="Yes" type="checkbox" class="spouse_payment_received form-control w-auto height_fit_content mt-0">
            <span class="pr-3 pl-2">1.</span>
            <div class="">
                <span>
                {{ __('I have attached hereto, or previously filed with the Court, copies of') }} <span class="text-bold"> {{ __('all') }} </span> {{ __('payment
                    advices or other evidence of payment received from any employer within 60days
                    before the date of the filing of my bankruptcy petition.') }}
                </span>
            </div>
        </div>
        <div class="d-flex pl-4 mt-2">
            <input name="<?php echo base64_encode('Check Box6');?>" value="Yes" type="checkbox" class="spouse_not_payment_received form-control w-auto height_fit_content mt-0">
            <span class="pr-3 pl-2">2.</span>
            <div class="">
                <span>
                    {{ __('I did not receive any payment advices or other evidence of payment at any point
                    during the 60 days before the date of the filing of my bankruptcy petition.') }}
                </span>
            </div>
        </div>
        <div class="d-flex pl-4 mt-2">
            <input name="<?php echo base64_encode('Check Box7');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0">
            <span class="pr-3 pl-2">3.</span>
            <div class="">
                <span>
                {{ __('I received payment advices from an employer during the 60 days before the date for
                    the filing of my bankruptcy petition but have been unable to locate all of the
                    documents or replacements. I understand that if I do not submit all payment advices
                    or other evidence of payment') }} <span class="text-bold"> {{ __('within 45 days') }} </span> {{ __('from the filing of my bankruptcy
                    petition, my case will be') }} <span class="text-bold"> {{ __('automatically dismissed') }} </span> {{ __('without further notice or hearing.') }}
                </span>
            </div>
        </div>
    </div>

    <div class="d-flex pl-4 mt-3">
        <span class="pl-5 "></span>
        <div class="pl-5 ml-2">
            <span>
            {{ __('I declare under penalty of perjury that the foregoing statement is true and correct to the best of my knowledge, information, and belief.') }}
            </span>
            <p>
            {{ __('Dated this') }}<input name="<?php echo base64_encode('Dated this');?>"  type="text" class="form-control mt-1 w-auto" value="{{$currentMonth}}">{{ __('day of') }} 
                <input name="<?php echo base64_encode('Month');?>"  type="text" class="form-control mt-1 width_5percent" value="{{$currentMonthNumerical}}">, 20
                <input name="<?php echo base64_encode('Text2');?>"  type="text" class="form-control mt-1 width_5percent" value="{{$currentYearShort}}">
            </p>
        </div>
    </div>

    
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Signature of Joint Debtor)"
            inputFieldName="Signature"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-4 mt-3 border_bottom_1px"></div>
    <div class="col-md-4 mt-3"></div>
    <div class="col-md-4 mt-3"></div>

    <div class="col-md-12 mt-3">
        <p class="mb-2">1</p>
        <p class="mb-2">
           <span class="pl-4"></span>
           {{ __('A “Payment Advice” includes, but is not limited to, pay stubs attached to your
           paycheck, employer’s statements of hours and earnings, deposit notifications, etc.') }}
        </p>
        <p class="mb-2">2</p>
        <p class="mb-2"><span class="pl-4"></span>{{ __('A separate form must be submitted by each debtor in a joint case.') }}</p>
    </div>

    
</div>