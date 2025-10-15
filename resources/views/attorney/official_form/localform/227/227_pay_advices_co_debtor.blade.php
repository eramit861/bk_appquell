<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NORTH DAKOTA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In Re:') }}</label>
        <textarea name="<?php echo base64_encode('topmostSubform[0].Page1[0].Debtor[0]'); ?>"  class="form-control" rows="3">{{$debtorname}}</textarea>
        <label class="float_right">{{ __('Debtor.') }}</label>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="topmostSubform[0].Page1[0].Case_No[0]"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-4">{{ __('Statement Under Penalty of Perjury Concerning Payment Advices') }}<br>
            {{ __('Due Pursuant to 11 U.S.C. § 521(a)(1)(B)(iv)') }}</h3>
         <p>
            I*, 
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].Debtor_s_Name__state_as_follows[0]'); ?>" class="form-control mt-1 width_30percent">
            {{ __('(Debtor’s Name), state as follows:') }}
        </p>
        <p>{{ __('I did not file with the Court copies of all payment advices or other evidence of payment received
            within 60 days before the date of the filing of the petition from any employer because:') }}</p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox1');?>" value="YES" class="form-control w-auto height_fit_content spouse_payment_received">
            a) {{ __('I was not employed during the period immediately preceding the filing of the above-
            referenced case') }} 
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].state_the_dates[0]'); ?>" class="form-control mt-1 width_30percent">
            {{ __('(state the dates
            you were not employed);') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox2');?>" value="YES" class="form-control w-auto height_fit_content spouse_not_payment_received">
            {{ __('b) I was employed during the period immediately preceding the filing of the above-
            referenced case but did not receive any payment advices or other evidence of payment from my
            employer within 60 days before the date of the filing of the petition;') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox3');?>" value="YES" class="form-control w-auto height_fit_content">
            {{ __('c) I am self-employed and do not receive any evidence of payment from an employer;') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox4');?>" value="YES" class="form-control w-auto height_fit_content">
            d) {{ __('Other (Please Explain)') }}
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].undefined[0]'); ?>" class="form-control mt-1 width_30percent">
        </p>
        <p>{{ __('I declare under penalty of perjury that the foregoing statement is true and correct.') }}</p>
        <p>
        {{ __('Dated this') }}
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].day_of[0]');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }}
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0]._20[0]');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('topmostSubform[0].Page1[0].undefined_2[0]');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
        </p>        
    </div>

    <div class=" col-md-6 "></div>
    <div class=" col-md-6 ">
        <div class="pl-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor (signature)"
                inputFieldName="topmostSubform[0].Page1[0].sig[0]"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12">
        <p>* {{ __('A separate form must be filed by each Debtor, if appropriate') }}.</p>
    </div>

</div>