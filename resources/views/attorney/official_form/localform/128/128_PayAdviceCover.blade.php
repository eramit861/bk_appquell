<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Southern District of Indiana') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="form1[0].#subform[0].Debtors[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case Number"
                casenoNameField="form1[0].#subform[0].CaseNumber[0]"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class=" underline">{{ __('PAYMENT ADVICE COVER SHEET/ STATEMENT IN LIEU OF PAYMENT ADVICE') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            I,
            <input type="text" name="<?php echo base64_encode('form1[0].#subform[0].DebtorName[0]');?>" value="" class="form-control width_30percent">
            {{ __(', declare under penalty of perjury that the following is true and correct:') }}
        </p>
        <p class="text-center text_italic">{{ __('(Check one of the boxes below)') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox1[0]');?>" value="1" class="form-control w-auto height_fit_content payment_received">
            </div>
            <div class="w-100 pl-3">
                <p>
                    {{ __('I have received payment advices or other evidence of payment from any employer
                    within 60 days before the date of the filing of the petition, and they are attached.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox2[0]');?>" value="1" class="form-control w-auto height_fit_content not_payment_received">
            </div>
            <div class="w-100 pl-3">
                <p>
                    {{ __('I have not been employed by any employer within 60 days before the date of filing
                    of the petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox3[0]');?>" value="1" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-3">
                <p class="mb-0">
                    I was employed by an employer within 60 days before the date of filing of the petition,
                    but I have not received payment advices or other evidence of payment because
                    <span class=" text_italic">{{ __('(provide information in the space below)') }}</span>
                </p>
                <textarea name="<?php echo base64_encode('form1[0].#subform[0].EmpExp[0]');?>" class="form-control mb-3" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox4[0]');?>" value="1" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-3">
                <p>
                    {{ __('I am self employed and do not receive any evidence of payment.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox5[0]');?>" value="1" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-3">
                <p class="mb-0">
                    Other 
                    <span class=" text_italic">{{ __('(provide information in the space below)') }}</span>
                </p>
                <textarea name="<?php echo base64_encode('form1[0].#subform[0].OtherExp[0]');?>" class="form-control mb-3" rows="4"></textarea>
            </div>
        </div>
    </div>





    
    <div class="col-md-2 text-center mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('form1[0].#subform[0].DateField1[0]');?>" value="{{$currentDate}}" type="text" class="form-control date_filed width_auto">
            <label>{{ __('Date') }}</label>
        </div>
    </div>
    <div class="col-md-5 text-center mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Printed Name"
            inputFieldName="form1[0].#subform[0].TextField3[0]"
            inputValue="{{$onlyDebtor}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 text-center mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName=""
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

</div>