<div>
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF ALABAMA') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="debtor.name"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="Case Number."
                    casenoNameField="case_number"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
            <div class="row mt-2">
                <div class="col-md-3 pt-2">
                    <label>{{ __('Amended') }}</label>
                </div>
                <div class="col-md-9">
                    <input type="checkbox" class="form-control width_auto mt-2" name="<?php echo base64_encode('Amended'); ?>" value="Yes">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <p>
            <span class="pl-4 ml-4"></span>
            I*, 
            <input type="text" class="form-control width_30percent" value="{{$onlyDebtor}}" name="<?php echo base64_encode('debtornames'); ?>">
            {{ __("(Debtor's Name), state as follows:") }} 
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            {{ __('I did not file with the Court copies of all payment advices or other evidence of payment
            received within 60 days before the date of the filing of the petition from any employer because') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            <input type="checkbox" class=" not_payment_received form-control width_auto" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
            a) {{ __('I was not employed during the period immediately preceding the filing of the
            above-referenced case') }}
            <input type="text" class="form-control width_30percent" name="<?php echo base64_encode('checkbox1a'); ?>">
            {{ __('(enter dates not employed);') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            <input type="checkbox" class="payment_received form-control width_auto" name="<?php echo base64_encode('CheckBox2'); ?>" value="Yes">
            {{ __('b) I was employed during the period immediately preceding the filing of the
            above-referenced case but did not receive any payment advices or other evidence of payment from
            my employer within 60 days before the date of the filing of the petition;') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            <input type="checkbox" class="form-control width_auto" name="<?php echo base64_encode('CheckBox3'); ?>" value="Yes">
            {{ __('c) I am self-employed and do not receive any evidence of payment;') }}
        </p>
        <div class="d-flex">
            <p>
                <span class="pl-4 ml-4"></span>
                <input type="checkbox" class="form-control width_auto" name="<?php echo base64_encode('CheckBox4'); ?>" value="Yes">
                {{ __('d) Other (Please Explain)') }}
            </p>
            <textarea class="form-control width_50percent ml-3" rows="5" name="<?php echo base64_encode('checkbox1d'); ?>"></textarea>
        </div>
    </div>

    <div class="col-md-12">
        <p>
            {{ __('I declare under penalty of perjury that I have read the foregoing statement and that it is true and
            correct to the best of my knowledge, information, and belief.') }}
        </p>
    </div>

    <div class="col-md-12">    
        <div class="row">
            <div class="col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
            <div class="col-md-6">
                <x-officialForm.debtorSignVertical
                    labelContent="Debtor:"
                    inputFieldName="debtorsig"
                    inputValue={{$debtor_sign}}
                ></x-officialForm.debtorSignVertical>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>* {{ __('A separate form must be filed by each Debtor.') }}</p>
    </div>
</div>

