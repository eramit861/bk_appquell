<div class="row">

    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text2"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="ch"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3 class="underline">{{ __('PAYMENT ADVICES CERTIFICATION') }}</h3>
        <p class="text_italic">{{ __('(NOTE: A separate form must be filed by each debtor in a joint case)') }}</p>
    </div>

    <div class="col-md-12">
        <p class="p_justify"><span class="pl-4"></span>
        {{ __("Pursuant to 11 U.S.C. § 521(a)(1)(B)(iv), a debtor shall file copies of all payment advices or other evidence
            of payment (such as paycheck stubs, direct deposit statements, employer's statement of hours and earnings) received
            from the debtor's employer within 60 days before the date the debtor filed his/her bankruptcy case (the “petition date”)") }}.*
        </p>
        <p><span class="pl-4 mb-0"></span>I,  <input type="text" value="{{$onlyDebtor}}" name="<?php echo base64_encode('Text3');?>" class=" form-control mt-1 width_30percent ">{{ __('hereby state as follows:') }}</p>
        <p class="pl-5">{{ __("(joint debtor's name)") }}</p>
       
        <p class="text-bold p_justify">(<span class="text_italic">{{ __('Select One') }}</span>)</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box15');?>" value="Yes" class=" form-control w-auto height_fit_content spouse_payment_received">
            </div>
            <div class="w-100 pl-3">
                <p class="p_justify">{{ __('I have attached hereto, or previously filed with the Court, copies of all payment advices or other evidence
                of payment received from my employer(s) within 60 days before the petition date.') }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
            <p class="pl-4 mb-2"><span class="pl-4"></span>
            {{ __('Number of Employers') }}: <input type="text" name="<?php echo base64_encode('Text4');?>" class=" form-control mt-1 w-auto">
            </p>
            </div>
            <div class="col-md-8">
                <p class="mb-2">
                {{ __('Number of Payment Advices received') }}:<input type="text" name="<?php echo base64_encode('Text5');?>" class=" form-control mt-1 w-auto">
                </p>
            </div>
            <div class="col-md-4 pt-2">
                <p class="pl-4 mb-2"><span class="pl-4"></span>
                    {{ __('Number of Payment Advices attached:') }}
                </p>
            </div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('Text6');?>" class=" form-control mt-1 w-auto">
            </div>
            
            <div class="col-md-4 pt-2">
                <p class="pl-4 mb-2"><span class="pl-4"></span>
                    {{ __('Period Covered:') }}
                </p>
            </div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('Text7');?>" class=" form-control mt-1 width_40percent">
                <p class="text_italic mb-0">{{ __('(If period covered is less than 60 days, attach an explanation.)') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <p class="pl-5">
            {{ __('If the attached payment advices do not cover the entire 60-day period, describe any “other evidence of
                payment” that you intend to rely upon.') }}
                <input type="text" name="<?php echo base64_encode('Text8');?>" class=" form-control mt-1 width_40percent">.
            </p>
        </div>
       <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box16');?>" value="Yes" class=" form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-3">
                <p class="p_justify">
                {{ __('I received payment advices from an employer(s) during the 60 days before the petition date but have not
                    yet located or obtained copies of all of the payment advices. I understand that if I do not file all payment
                    advices or other evidence of payment') }} <span class="text-bold underline"> {{ __('within 45 days') }} </span> {{ __('from the petition date, my bankruptcy case may be') }}
                    <span class="text-bold underline"> {{ __('dismissed.') }} </span>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <p class="pl-4 mb-2"><span class="pl-4"></span>
                {{ __('Number of Employers') }}: <input type="text" name="<?php echo base64_encode('Text9');?>" class=" form-control mt-1 w-auto">
                </p>
            </div>
            <div class="col-md-8">
                <p class="mb-2">
                {{ __('Number of Payment Advices attached') }}:<input type="text" name="<?php echo base64_encode('Text10');?>" class=" form-control mt-1 w-auto">
                </p>
            </div>
               
            <div class="col-md-4 pt-2">
                <p class="pl-4 mb-2"><span class="pl-4"></span>
                    {{ __('Period Covered:') }}
                </p>
            </div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('Text11');?>" class=" form-control mt-1 width_30percent">
            </div>

            <div class="col-md-5 pt-2">
                <p class="pl-4 mb-2"><span class="pl-4"></span>
                {{ __('Number of missing Payment Advices') }}:<input type="text" name="<?php echo base64_encode('pa');?>" class=" form-control mt-1 w-auto">
                </p>
            </div>
            <div class="col-md-7">
                <p>{{ __('Dates of missing Payment Advices') }}:<input type="text" name="<?php echo base64_encode('Text12');?>" class=" form-control mt-1 w-auto"></p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box17');?>" value="Yes" class=" form-control w-auto height_fit_content spouse_not_payment_received">
            </div>
            <div class="w-100 pl-3">
                <p class="p_justify">
                {{ __('I did not receive any payment advices or other evidence of payment from any employer at any point during the 60 days before the petition date') }}.
                   <span class="text_italic">{{ __('(If you were employed, attach an explanation of why you did not receive any payment advices from your employer.)') }}</span>
                </p>
            </div>
        </div> 
        <p class="pl-4">{{ __('I declare under penalty of perjury that the foregoing statement is true and correct to the best of my knowledge, information and belief.') }}</p>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text13"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Signature of Joint Debtor)"
            inputFieldName="Text54"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Print name:"
            inputFieldName="Text14"
            inputValue="{{$spousename}}">
        </x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-12 mt-3 text_italic">
        <p>
            * {{ __("In order to protect the debtor's privacy, all but the last four digits of the Debtor's social security number and financial account
            number should be redacted from any payment advice. References to dates of birth should contain only the year and names of
            any minors should be redacted or include only initials.") }}
        </p>
    </div>

</div>