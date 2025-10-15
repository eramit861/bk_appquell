<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('STATEMENT UNDER PENALTY OF PERJURY RE:') }}<br>{{ __('PAYMENT ADVICE DUE PURSUANT TO 11 U.S.C. § 521(a)(1)(B)(iv)') }}</h3>
    </div>   

    <div class=" col-md-12 mt-3">
        <div class=" d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4'); ?>" class="form-control height_fit_content w-auto payment_received">
            </div>
            <div class=" pl-3">
                <p class="p_justify">
                    <span class="text-bold">{{ __('Debtor 1') }}</span> {{ __('has attached to this statement copies of all payment advices or other evidence of payment received
                    within 60 days before the date of the petition from any employer.') }}
                </p>
            </div>
        </div>
        <div class=" d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5'); ?>" class="form-control height_fit_content w-auto not_payment_received">
            </div>
            <div class=" pl-3">
                <p class="p_justify">
                    <span class="text-bold">{{ __('Debtor 1') }}</span> {{ __('has not filed copies of payment advices or other evidence of payment received within 60 days before the
                    date of the filing of the petition from any employer because:') }}
                </p>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box13'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="p_justify">
                            {{ __('Debtor 1 was not employed during the 60 days preceding the filing of the petition;') }}
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box14'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="">
                        {{ __('Debtor 1 was employed for only a portion of the 60 days preceding the filing of the petition. Please specify
                            period during which debtor was unemployed') }}:
                            <input type="text"  name="<?php echo base64_encode('period during which debtor was unemployed'); ?>" class=" form-control width_50percent">
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box15'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="p_justify">
                            {{ __('Debtor 1 was self-employed during the 60 days preceding the filing of the petition;') }}
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box16'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="p_justify">
                            {{ __('Debtor 1 received only unemployment, veteran’s benefits, social security, disability or other retirement
                            income during the 60 days preceding the filing of the petition; or') }}
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class=" pt-2">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box17'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3 w-100">
                        <p class="">
                        {{ __('Other (please explain)') }}:
                            <input type="text"  name="<?php echo base64_encode('Other please explain'); ?>" class=" form-control width_60percent">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <p class=" p_justify">
            {{ __('I declare under penalty of perjury that I have read this Statement and it is true to the best of my knowledge, information
            and belief.') }}
        </p>
    </div>  

    <div class="col-md-6">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Debtor 1:"
                inputFieldName="Text42"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text44"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class=" col-md-12 mt-3">
        <div class=" d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6'); ?>" class="form-control height_fit_content w-auto spouse_payment_received">
            </div>
            <div class=" pl-3">
                <p class="p_justify">
                    <span class="text-bold">{{ __('Debtor 2') }}</span> {{ __('has attached to this statement copies of all payment advices or other evidence of payment received
                    within 60 days before the date of the petition from any employer.') }}
                </p>
            </div>
        </div>
        <div class=" d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box7'); ?>" class="form-control height_fit_content w-auto spouse_not_payment_received">
            </div>
            <div class=" pl-3">
                <p class="p_justify">
                    <span class="text-bold">{{ __('Debtor 2') }}</span> {{ __('has not filed copies of payment advices or other evidence of payment received within 60 days before the
                    date of the filing of the petition from any employer because:') }}
                </p>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box18'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="p_justify">
                            {{ __('Debtor 1 was not employed during the 60 days preceding the filing of the petition;') }}
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box19'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="">
                        {{ __('Debtor 2 was employed for only a portion of the 60 days preceding the filing of the petition. Please specify
                            period during which debtor was unemployed:') }}
                            <input type="text"  name="<?php echo base64_encode('period during which debtor was unemployed_2'); ?>" class=" form-control width_50percent">
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box20'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="p_justify">
                            {{ __('Debtor 2 was self-employed during the 60 days preceding the filing of the petition;') }}
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class="">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box21'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3">
                        <p class="p_justify">
                            {{ __('Debtor 2 received only unemployment, veteran’s benefits, social security, disability or other retirement
                            income during the 60 days preceding the filing of the petition; or') }}
                        </p>
                    </div>
                </div>
                <div class=" d-flex">
                    <div class=" pt-2">
                        <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box22'); ?>" class="form-control height_fit_content w-auto">
                    </div>
                    <div class=" pl-3 w-100">
                        <p class="">
                        {{ __('Other (please explain):') }}
                            <input type="text"  name="<?php echo base64_encode('Other please explain_2'); ?>" class=" form-control width_60percent">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <p class=" p_justify">
            {{ __('I declare under penalty of perjury that I have read this Statement and it is true to the best of my knowledge, information
            and belief.') }}
        </p>
    </div>  

    <div class="col-md-6">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Debtor 2:"
                inputFieldName="Text43"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text45"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

</div>