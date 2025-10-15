<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT
            Western District of Wisconsin') }}<br>
            {{ __('PAYMENT ADVICES COVER SHEET') }}<br>
            {{ __('in Accordance with 11 U.S.C. Sec. 521(a)(1)(B)(iv)') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="debname"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No.:"
                casenoNameField="caseno"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text_italic">{{ __('Please check the appropriate box.') }}</p>
        <p class="text-bold">{{ __('For Debtor:') }}</p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('payattached');?>" value="Yes" class="form-control w-auto height_fit_content mr-3 payment_received">
            <div class="w-100">
                <p class="mb-2">{{ __('Payment advices (pay stubs) are attached.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('nopayattached');?>" value="Yes" class="form-control w-auto height_fit_content mr-3 not_payment_received">
            <div class="w-100">
                <p class="mb-2">{{ __('No payment advices (pay stubs) are attached (the debtor had no income from
                    any employer during the 60 days prior to filing the bankruptcy petition).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('paymissing');?>" value="Yes" class="form-control mt-2 w-auto height_fit_content mr-3">
            <div class="w-100">
                <p class="mb-2">{{ __('No payment advices (pay stubs) attached for other reason, or some payment
                    advices missing ( please explain)') }}.
                    <input type="text" name="<?php echo base64_encode('reason1');?>" class="form-control width_45percent ml-2">
                    <input type="text" name="<?php echo base64_encode('reason2');?>" class="form-control mt-1">
                </p>
            </div>
        </div>
        <p class="text-bold mt-3">{{ __('For Joint Debtor, if applicable:') }}</p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('payattach2');?>" value="Yes" class="form-control w-auto height_fit_content mr-3 spouse_payment_received">
            <div class="w-100">
                <p class="mb-2">{{ __('Payment advices (pay stubs) are attached.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('paymissing2');?>" value="Yes" class="form-control w-auto height_fit_content mr-3 spouse_not_payment_received">
            <div class="w-100">
                <p class="mb-2">{{ __('No payment advices (pay stubs) are attached (the debtor had no income from
                    any employer during the 60 days prior to filing the bankruptcy petition).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('paymissing3');?>" value="Yes" class="form-control mt-2 w-auto height_fit_content mr-3">
            <div class="w-100">
                <p class="mb-2">{{ __('No payment advices (pay stubs) attached for other reason, or some payment
                    advices missing ( please explain).') }} 
                    <input type="text" name="<?php echo base64_encode('reason3');?>" class="form-control width_45percent ml-2">
                    <input type="text" name="<?php echo base64_encode('reason4');?>" class="form-control mt-1">
                </p>
            </div>
        </div>
        <p class="mt-3 p_justify">
        {{ __('I declare under penalty of perjury that I have read this payment advices cover sheet and
            the attached payment advices, consisting of') }} 
            <input type="text" name="<?php echo base64_encode('pages1');?>" class="form-control w-auto">
            {{ __('sheets, numbered 1 through') }} 
            <input type="text" name="<?php echo base64_encode('pages2');?>" class="form-control w-auto">
             {{ __(', and
            that they are true and correct to the best of my knowledge, information and belief.') }}
        </p>
        

    </div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Debtor:"
                inputFieldName=""
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Joint Debtor:"
                inputFieldName=""
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="date1"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="mt-2">
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="date2"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>

</div>