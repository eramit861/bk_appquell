<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="dbtrs"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="csno"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="chap"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-4">{{ __('PAYMENT ADVICES CERTIFICATION') }}</h3>
         <p class="text-center text_italic">{{ __('(NOTE: A separate form must be filed by each debtor in a joint case)') }}</p>
         <p>
            <span class="pl-4"></span>
            {{ __("Pursuant to 11 U.S.C. § 521(a)(1)(B)(iv), a debtor shall file copies of all payment advices or other
            evidence of payment (such as paycheck stubs, direct deposit statements, employer's statement of hours and
            earnings) received from the debtor's employer") }} <span class="text_italic">{{ __('within 60 days') }}</span> {{ __('before the date the debtor filed his/her
            bankruptcy case (the "petition date")') }}.*
        </p>
        <p>
            <span class="pl-4"></span>
            I, 
            <input type="text" name="<?php echo base64_encode('hereby'); ?>"  class="form-control mt-1 width_30percent" value="{{$spousename}}">
            {{ __('hereby state as follows') }}:<br>{{ __("(joint debtor's name)") }}
        </p>
        <p class=" text_italic">
            {{ __('(select one)') }}
        </p>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('ckbx1');?>" value="Yes" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-4">
                <p class="mb-2 ">{{ __("I have attached hereto, or previously filed with the Court, copies of all payment advices or other
                    evidence of payment received from my employer(s) within 60 days before the petition date.") }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('ckbx2');?>" value="Yes" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-4">
                <p class="mb-2 ">{{ __('I received payment advices from an employer(s) during the 60 days before the petition date but have
                    not yet located or obtained copies of all of the payment advices.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('ckbx3');?>" value="Yes" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-4">
                <p class="mb-2 ">{{ __('I did not receive any payment advices or other evidence of payment from any employer at any point
                    during the 60 days before the petition date') }}.
                    <input type="text" name="<?php echo base64_encode('tx1');?>" class="form-control w-auto">
                </p>
            </div>
        </div>
        <p class="text_italic">
            {{ __('(If you were employed, attach an explanation of why you did not receive any payment advices from your
            employer.)') }}
        </p>

        <p>
            <span class="pl-4"></span>
            {{ __('I declare under penalty of perjury that the foregoing statement is true and correct to the best of my
            knowledge, information and belief.') }}
        </p>
    </div>

    <div class=" col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>        
    <div class=" col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(Signature of Debtor)"
                inputFieldName="dbsig"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="pl-2 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Print name:"
                inputFieldName="prtdbname"
                inputValue={{$spousename}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-12">
        <p class="text-bold text_italic mt-3">* {{ __("In order to protect the debtor's privacy, all but the last four digits of the Debtor's
            social security number and financial account number should be redacted from any
            payment advice. References to dates of birth should contain only the year and
            names of any minors should be redacted or include only initials") }}.</p>
    </div>

</div>