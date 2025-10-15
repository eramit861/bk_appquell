<div class="row">
    <div class="col-md-12 mb-3 text-center">
        <h3>{{ __('LOCAL FORM 1007.1') }}</h3>
        <h3 class="mt-3">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF TEXAS') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="row">
            <div class="col-md-2">
                <label>{{ __('In re:') }}</label>
            </div>
            <div class="col-md-10">
            <input type="text" name="<?php echo base64_encode('Text3'); ?>" class="form-control" value="{{$debtorname}}">
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text1"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text2"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mb-3 mt-3">
        <h3 class="text-center">
            {{ __('STATEMENT REGARDING PAYMENT ADVICES OR OTHER EVIDENCE OF PAYMENT') }}
        </h3>
    </div>
    <div class="col-md-6 mb-3">
        <p class="text-center">{{ __('CERTIFICATION OF DEBTOR') }}</p>
        <p class="pl-2">{{ __('I hereby certify under penalty of perjury that') }}</p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box1'); ?>" class="form-control w-auto height_fit_content payment_received" value="Yes">
            <div class="pl-2">
                <p  class="p_justify">
                {{ __('attached hereto are copies of all
                    payment advices or other evidence
                    of payment [such as paycheck stubs,
                    direct deposit advices, statements of
                    payment, etc.] that I have received
                    from an employer within 60 days
                    before the date of the filing of the
                    petition, with all but the last four
                    digits of the debtor’s Social Security
                    number redacted,*') }}
                </p>
            </div>
        </div>
        <p class="text-center">{{ __('OR') }}</p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box2'); ?>" class="form-control w-auto height_fit_content not_payment_received" value="Yes">
            <div class="pl-2">
                <p  class="p_justify">
                    {{ __('I did not receive any such documents
                    from an employer within 60 days
                    before the date of the filing of the
                    petition.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
    <p class="text-center">{{ __('CERTIFICATION OF JOINT DEBTOR') }}</p>
        <p class="pl-2">{{ __('I hereby certify under penalty of perjury that') }}</p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box3'); ?>" class="form-control w-auto height_fit_content spouse_payment_received" value="Yes">
            <div class="pl-2">
                <p class="p_justify">
                    {{ __('attached hereto are copies of all
                    payment advices or other evidence
                    of payment [such as paycheck stubs,
                    direct deposit advices, statements of
                    payment, etc.] that I have received
                    from an employer within 60 days
                    before the date of the filing of the
                    petition, with all but the last four
                    digits of the debtor’s Social Security
                    number redacted,') }}
                </p>
            </div>
        </div>
        <p class="text-center">{{ __('OR') }}</p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check Box4'); ?>" class="form-control w-auto height_fit_content spouse_not_payment_received" value="Yes">
            <div class="pl-2">
                <p class="p_justify">
                    {{ __('I did not receive any such documents
                    from an employer within 60 days
                    before the date of the filing of the
                    petition.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6 text-bold">
            <x-officialForm.signVertical
                labelText="[SIGNATURE OF DEBTOR]"
                signNameField="Text5"
                sign={{$debtor_sign}}>
            </x-officialForm.signVertical>
        <div class="mt-3">    
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="Text7"
                currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
    </div>
    <div class="col-md-6 text-bold">
            <x-officialForm.signVertical
                labelText="[SIGNATURE OF JOINT DEBTOR]"
                signNameField="Text6"
                sign={{$debtor2_sign}}>
            </x-officialForm.signVertical>
        <div class="mt-3">
            <x-officialForm.dateSingleHorizontal
                labelText="Date:"
                dateNameField="Text8"
                currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
    </div>
    <div class="col-md-12 mb-3">
        <input type="text" name="<?php echo base64_encode(''); ?>" class="form-control bg-none w-auto mt-3" disabled>
        <p class="mt-3">
        * {{ __('Other evidence of payment may consist of the debtor’s most recent paycheck stub showing year-to-
        date earnings if the debtor has worked the same job the last 60 days before the date of the filing
        of the petition.') }} 
        </p>
    </div>
</div> 