<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('Northern District of Iowa') }}<br>
            {{ __('PAYMENT COVER SHEET') }}<br>
            {{ __('in Accordance with 11 U.S.C. Sec. 521(a)(1)(B)(iv)') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode("Debtors"); ?>" value="" class="form-control" rows="4" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            <label>{{ __('Debtor(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text_italic">
            {{ __('Please check the appropriate box') }}
        </p>
        <p class="text-bold">
            {{ __('For Debtor:') }}
        </p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box1')?>" value="Yes" class="form-control w-auto height_fit_content payment_received">
            <div class="pl-2">
                <p>
                    {{ __('Payment advices (or other evidence of payment) are attached.') }}
                </p>
            </div>            
            
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box2')?>" value="Yes" class="form-control w-auto height_fit_content not_payment_received">
            <div class="pl-2">           
                <p>
                    {{ __('No payment advices (or other evidence of payment) are attached (the debtor had
                    no income from any employer during the 60 days prior to filing the bankruptcy
                    petition).') }}
                </p>
            </div> 
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box3')?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="pl-2">
                <p>
                    {{ __('No payment advices (or other evidence of payment) attached for other reason, or
                    some payment advices missing (please explain).') }}
                </p>
            </div>            
            
        </div>
       
        <p class="text-bold">
            {{ __('For Joint Debtor, if applicable:') }}
        </p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box4')?>" value="Yes" class="form-control w-auto height_fit_content spouse_payment_received">
            <div class="pl-2">
                <p>
                    {{ __('Payment advices (or other evidence of payment) are attached.') }}
                </p>
            </div>                        
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box5')?>" value="Yes" class="form-control w-auto height_fit_content spouse_not_payment_received">
            <div class="pl-2">
                <p>
                    {{ __('No payment advices (or other evidence of payment) are attached (the debtor had
                    no income from any employer during the 60 days prior to filing the bankruptcy
                    petition).') }}
                </p>
            </div>                        
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box6')?>" value="Yes" class="form-control w-auto height_fit_content">
            <div class="pl-2">
                <p>
                    {{ __('No payment advices (or other evidence of payment) attached for other reason, or
                    some payment advices missing ( please explain).') }}
                </p>
            </div>                        
        </div>
        <p>
        {{ __('I declare under penalty of perjury that I have read this payment advices cover sheet and
            the attached payment advices, consisting of') }} 
            <input type="text" name="<?php echo base64_encode('the attached payment advices consisting of')?>" class="form-control w-auto">
            {{ __('sheets, numbered 1 through') }} 
            <input type="text" name="<?php echo base64_encode('sheets numbered 1 through')?>" class="form-control w-auto">
             {{ __(', and
            that they are true and correct to the best of my knowledge, information and belief.') }}
        </p>
    </div>

    <div class="col-md-8">
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Debtor:"
                inputFieldName="Text52"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-8">
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Joint Debtor:"
                inputFieldName="Text53"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

</div>
