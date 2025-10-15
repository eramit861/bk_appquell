<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF ALABAMA') }}</h3>
    </div>
    
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
                <input name="<?php echo base64_encode('Amended');?>" value="Yes" type="checkbox" class="form-control width_auto mt-2">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center ">{{ __('Statement Under Penalty of Perjury Concerning Payment Advices') }}<br>{{ __('Due Pursuant to 11 U.S.C. § 521(a)(1)(B)(iv)') }}</h3>
        <p class="mt-3">
            <span class="pl-4 ml-4"></span>
            I*, 
            <input name="<?php echo base64_encode('debtornames');?>" type="text" value="{{$spousename}}" class="form-control width_30percent">
            {{ __('(Co-Debtor’s Name), state as follows:') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            {{ __('I did not file with the Court copies of all payment advices or other evidence of payment
            received within 60 days before the date of the filing of the petition from any employer because:') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            <input name="<?php echo base64_encode('Check Box1');?>" value="Yes" type="checkbox" class="spouse_not_payment_received form-control width_auto spouse_not_payment_received">
            a) {{ __('I was not employed during the period immediately preceding the filing of the
            above-referenced case') }}
            <input name="<?php echo base64_encode('checkbox1a');?>" type="text" class="form-control width_30percent">
            {{ __('(enter dates not employed);') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            <input name="<?php echo base64_encode('CheckBox2');?>" value="Yes" type="checkbox" class="spouse_payment_received form-control width_auto spouse_payment_received">
            {{ __('b) I was employed during the period immediately preceding the filing of the
            above-referenced case but did not receive any payment advices or other evidence of payment from
            my employer within 60 days before the date of the filing of the petition;') }}
        </p>
        <p>
            <span class="pl-4 ml-4"></span>
            <input name="<?php echo base64_encode('CheckBox3');?>" value="Yes" type="checkbox" class="form-control width_auto">
            {{ __('c) I am self-employed and do not receive any evidence of payment;') }}
        </p>
        <div class="d-flex">
            <p>
                <span class="pl-4 ml-4"></span>
                <input name="<?php echo base64_encode('CheckBox4');?>" value="Yes" type="checkbox" class="form-control width_auto">
                {{ __('d) Other (Please Explain)') }}
            </p>
            <textarea name="<?php echo base64_encode('checkbox1d');?>" class="form-control width_50percent ml-3" rows="5"></textarea>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            {{ __('I declare under penalty of perjury that I have read the foregoing statement and that it is true and
            correct to the best of my knowledge, information, and belief.') }}
        </p>
    </div>

    <div class="col-md-12">    
        <div class="row">
            <div class="col-md-6">
                <?php $attorney_date = isset($savedData) ? Helper::validate_key_value('attorney_date', $savedData) : '' ?>
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="date"
                    currentDate={!!$attorney_date!!}
                ></x-officialForm.dateSingleHorizontal>
            </div>
            <div class="col-md-6">
                <x-officialForm.debtorSignVertical
                    labelContent="Co-Debtor:"
                    inputFieldName="debtorsig"
                    inputValue={{$debtor2_sign}}
                ></x-officialForm.debtorSignVertical>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>* {{ __('A separate form must be filed by each Debtor.') }}</p>
    </div>
</div>

