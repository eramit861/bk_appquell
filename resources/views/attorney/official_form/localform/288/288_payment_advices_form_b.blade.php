<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF VERMONT') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="undefined_2"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
         <x-officialForm.caseNo
            labelText="Chapter"
            casenoNameField="Text1"
            caseno={{$chapterNo}}
        ></x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case #"
                casenoNameField="Case"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 ">
         <h3 class="text-center">{{ __('PAYMENT ADVICES COVER SHEET') }}</h3>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text_italic mb-3">
            {{ __('Check the Appropriate Box.') }}
        </p>
        <p class="text-bold">
            {{ __('For Debtor:') }}
        </p>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto payment_received" name="<?php echo base64_encode('Check Box3'); ?>" value="Yes">
            <div class="w-100">
                <label>{{ __('Payment advices (pay stubs) are attached.') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <p>{{ __('Number of pages attached') }}:
                    <input type="text" name="<?php echo base64_encode('Number of pages attached'); ?>" class="form-control w-auto">
                </p>
                <p>
                {{ __('Period covered') }}:<input type="text" name="<?php echo base64_encode('Period covered'); ?>" class="form-control w-auto">
                    {{ __('through') }}<input type="text" name="<?php echo base64_encode('through'); ?>" class="form-control w-auto">
                </p>
                <p class="mt-1">Explain any gaps:<input type="text" name="<?php echo base64_encode('Explain any gaps'); ?>" class="form-control width_50percent"></p>
                <p>
                    {{ __('Number of employers from whom debtor received') }}
                </p>
                <p>
                    {{ __('payment advices during the 60 days prior to filing the') }}
                </p>
                <p> {{ __('bankruptcy petition') }}:
                   <input type="text" name="<?php echo base64_encode('bankruptcy petition'); ?>" class="form-control w-auto">
                </p>
            </div>
        </div>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto not_payment_received" name="<?php echo base64_encode('Check Box4'); ?>" value="Yes">
            <div class="w-100">
            <label>{{ __('No payment advices are attached because the debtor had no income from any employer during the 60 days prior to filing the bankruptcy petition.') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes">
            <div class="w-100">
            <label>
                {{ __('No payment advices are attached, or some payment advices missing, for some other reason.') }}
            </label>
            <p class="mt-1">Please explain:<input type="text" name="<?php echo base64_encode('Please explain'); ?>" class="form-control width_50percent"></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-bold">
           {{ __('For Joint Debtor, if applicable:') }}
        </p>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto spouse_payment_received" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
            <div class="w-100">
                <label>{{ __('Payment advices (pay stubs) are attached.') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-11">
                <p>{{ __('Number of pages attached') }}:
                    <input type="text" name="<?php echo base64_encode('Number of pages attached_2'); ?>" class="form-control w-auto">
                </p>
                <p>
                {{ __('Period covered') }}:<input type="text" name="<?php echo base64_encode('Period covered_2'); ?>" class="form-control w-auto">
                    {{ __('through') }}<input type="text" name="<?php echo base64_encode('through_2'); ?>" class="form-control w-auto">
                </p>
                <p class="mt-1">Explain any gaps:<input type="text" name="<?php echo base64_encode('Explain any gaps_2'); ?>" class="form-control width_50percent"></p>
                <p>
                    {{ __('Number of employers from whom debtor received') }}
                </p>
                <p>
                    {{ __('payment advices during the 60 days prior to filing the') }}
                </p>
                <p> {{ __('bankruptcy petition') }}:
                   <input type="text" name="<?php echo base64_encode('bankruptcy petition_2'); ?>" class="form-control w-auto">
                </p>
            </div>
        </div>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto spouse_not_payment_received" name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
            <div class="w-100">
            <label>{{ __('No payment advices are attached because the debtor had no income from any employer during the 60 days prior to filing the bankruptcy petition.') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box8'); ?>" value="Yes">
            <div class="w-100">
            <label>
                {{ __('No payment advices are attached, or some payment advices missing, for some other reason.') }}
            </label>
            <p class="mt-1">Please explain:<input type="text" name="<?php echo base64_encode('Please explain_2'); ?>" class="form-control width_50percent"></p>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-4 ">{{ __('DEBTOR’S DECLARATION UNDER PERJURY') }}</h3>
        <p>
        {{ __('I declare under penalty of perjury that I have read the payment advices cover sheet and the attached
            payment advices, consisting of') }} <input type="text" name="<?php echo base64_encode('payment advices consisting of'); ?>" class="form-control w-auto">
            {{ __('sheets, numbered 1 through') }} <input type="text" name="<?php echo base64_encode('Text2'); ?>" class="form-control w-auto">{{ __(', and that they are true and correct
            to the best of my knowledge, information, and belief.') }}
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Debtor:"
            inputFieldName=""
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVertical>
        <div class="mt-1">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Joint Debtor:"
            inputFieldName=""
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-6 mt-3">
    <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        <div class="mt-1">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>
</div>