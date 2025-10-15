<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF LOUISIANA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3 t-upper">
        <x-officialForm.inReDebtorCustom
            debtorNameField="DebtorNames"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="{{ __('Case No:') }}"
            casenoNameField="CASE NO"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo> 
        <div class="mt-2">
        <x-officialForm.caseNo
            labelText="{{ __('Chapter:') }}"
            casenoNameField="CHAPTER"
            caseno="{{$chapterNo}}">
        </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('DECLARATION CONCERNING PAYMENT ADVICES') }}<br>{{ __('DUE PURSUANT TO 11 USC §521(A)(1)(B)(iv)') }}</h3>
        <p>I,<input name="<?php echo base64_encode('Name1');?>"  value="{{$onlyDebtor}}" type="text" class="form-control mt-1 width_30percent">{{ __(', state as follows:') }}</p>
        <p>
            <span class="pl-4"></span>
            {{ __('I did not file with the Court copies of all payment advices or other evidence of payment
            received within 60 days before the date of the filing of the petition from any employer due to one of the following:') }}
        </p>
    </div>
    <div class="col-md-12">
        <p class="mb-2"><span class="pl-4"></span>
           <input type="checkbox" class="form-comtrol width-auto height_fit_content not_payment_received" name="<?php echo base64_encode('1 I was not employed during the 60day period immediately preceding the filing of'); ?>" value="On">
           1. {{ __('I was not employed during the 60-day period immediately preceding the filing of the above referenced case (please enter dates unemployed)') }}
           <input type="text" class="form-control w-auto" name="<?php echo base64_encode('Dates unemployed'); ?>">
        </p>
        <p class="mb-2"><span class="pl-4"></span>
           <input type="checkbox" class="form-comtrol width-auto height_fit_content payment_received" name="<?php echo base64_encode('2 I was employed during the period immediately preceding the filing of the above'); ?>" value="On">
           {{ __('2. I was employed during the period immediately preceding the filing of the above 
           referenced case but did not receive any payment advices or other evidence of payment
           from my employer within 60 days before the date of the filing of the petition.') }}
        </p>
        <p class="mb-2"><span class="pl-4"></span>
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('3 I am selfemployed and do not receive any evidence of payment'); ?>" value="On">
            {{ __('3. I am self-employed and do not receive any evidence of payment') }}
        </p>
        <p class="mb-2"><span class="pl-4"></span>
            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('4 Other please explain'); ?>" value="On">
            4. {{ __('Other (please explain)') }}
            <textarea  name="<?php echo base64_encode('Other Details'); ?>" class="form-control mt-1" rows="7"></textarea>
        </p>
    </div>
    <div class="col-md-12">
        <p>{{ __('I declare (certify, verify or state) under penalty of perjury that I have read the foregoing statement and that it is true and correct') }}</p>
    </div>

    <div class="col-md-3"></div>
    <div class="col-md- mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Date:') }}"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Signature of Debtor') }}"
            inputFieldName=""
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
      <div class="col-md-12">
        <p>{{ __('A separate form must be filed by each debtor') }}</p>
      </div>
</div>