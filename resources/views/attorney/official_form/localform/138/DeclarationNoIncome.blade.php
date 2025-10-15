<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}
            <br>
            {{ __('SOUTHERN DISTRICT OF IOWA') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In the Matter of:') }}</label>
            <textarea name="<?php echo base64_encode("Debtors"); ?>" value="" class="form-control" rows="4" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            <div class="text-center">
                <label>{{ __('Debtor(s)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-3">
            <h3> 
                {{ __('DECLARATION OF DEBTOR(S)
                REGARDING NO EVIDENCE OF ANY PAYMENT RECEIVED FROM ANY EMPLOYER') }}
            </h3>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('I/We, the above-named Debtor(s), hereby declare') }} <span class="text-bold">{{ __('under penalty of perjury') }}</span>
            {{ __('that I/we have not received from any employer any payment advices or other
            evidence of payment received within 60 days before the date of the filing of the
            bankruptcy petition in this chapter case because') }}
            <input type="text" name="<?php echo base64_encode('Text3');?>" class="form-control width_50percent">
            <input type="text" name="<?php echo base64_encode('Text4');?>" class="form-control mt-1">
        </p>
    </div>

    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="{{ __('Signature of Debtor') }}"
                inputFieldName="Text5"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="{{ __('Signature of Joint Debtor') }}"
                inputFieldName="Text6"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.dateSingle
                labelText="{{ __('Date') }}"
                dateNameField="Text7"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>
    </div>

</div>