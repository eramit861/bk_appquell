<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Western District of Louisiana') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtors"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="Text2"
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
    <h3 class="text-center">
    {{ __('Statement Under Penalty of Perjury Concerning Payment Advices') }}<br>
            {{ __('Due Pursuant to 11 USC §521(A)(1)(B)(iv)') }}
        </h3>
         <p>
            I*,
            <input type="text" name="<?php echo base64_encode('debtorname'); ?>" class="form-control width_30percent" value="{{$onlyDebtor}}">
            , {{ __('state as follows') }}:<br>
            <span class="pl-4">{{ __('Debtor’s Name') }}</span>
        </p>
      
        <p>
            <span class="pl-4"></span>
            {{ __('I did not file with the Court copies of all payment advices or other evidence of payment
            received within 60 days before the date of the filing of the petition from any employer due to one
            of the following:') }}
        </p>
        <div class="d-flex">
            <input type="checkbox" class="form-control height_fit_content w-auto not_payment_received" name="<?php echo base64_encode('Check Box5.0'); ?>" value="Yes">
                <div class="row w-100">
                    <div class="col-md-7 pr-0">
                        <span class="pr-1">(a)</span>
                        {{ __('I was not employed during the period immediately preceding the filing of the
                        above-referenced case') }} 
                    </div>
                    <div class="col-md-4 pl-0">   
                        <p class="mb-0"><input type="text" name="<?php echo base64_encode('datefile'); ?>" class="form-control width_95percent">;</p>
                        <p class="text-center mb-2">{{ __('Please enter dates not employed.') }}</p>
                    </div>
                    <div class="col-md-1"></div>
                <br>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" class="form-control height_fit_content w-auto payment_received" name="<?php echo base64_encode('Check Box5.1'); ?>" value="Yes">
            <div class="w-100">
               <p>  
                   <span class="pr-1">(b)</span> {{ __('I was employed during the period immediately preceding the filing of the
                    above-referenced case but did not receive any payment advices or other
                    evidence of payment from my employer within 60 days before the date of the
                    filing of the petition;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box5.2'); ?>" value="Yes">
            <div>
                <span class="pr-1"> {{ __('(c)') }} </span>{{ __('I am self-employed and do not receive any evidence of payment;') }}
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" class="form-control height_fit_content w-auto mt-2" name="<?php echo base64_encode('Check Box5.3'); ?>" value="Yes">
            <div class="w-100">
                <p class="mb-2">
                <span class="pr-1"> {{ __('(d)') }} </span> 
                {{ __('Other (Please Explain, i.e. Retired, etc.)') }} <input type="text" name="<?php echo base64_encode('Text7'); ?>" class="form-control width_75percent ml-2">
                </p>
                <input type="text" name="<?php echo base64_encode('Text8'); ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <p>
            {{ __('I declare under penalty of perjury that I have read the foregoing statement and that it is true and
           correct to the best of my knowledge, information, and belief.') }}
        </p>
    </div>
    <div class="col-md-6 mt-3">
    <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text9"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
         <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="Text10"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-12">
        <p class="text-bold">
        * {{ __('A separate form must be filed by each Debtor.') }}
        </p>
    </div>
</div>