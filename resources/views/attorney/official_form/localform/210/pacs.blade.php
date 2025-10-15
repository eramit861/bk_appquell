<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF NEW YORK') }}</h3>
    </div>

    <div class="col-md-12 text-center">
        <h3>{{ __('PAYMENT ADVICES COVER SHEET') }}</h3>
        <p >{{ __('cin Accordance With 11 U.S.C. Sec. 521(a)(1)(B)(iv)') }}</p>
    </div>


    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="In re"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="row">
            <div class="col-md-3 pt-2">
                <label>{{ __('Chapter') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Chapter'); ?>" class="form-control width_auto mt-2">
                    <option value=""></option>
                    <option <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>  value="7">7</option>
                    <option value="9">9</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?> value="13">13</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>        
    </div>
    
    <div class="col-md-12 mt-3">
        <label class="text_italic">{{ __('Please Check the Appropriate Box.') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold text_italic">{{ __('For Debtor:') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-12">
                <p><input name="<?php echo base64_encode('Check Box30');?>" value="Yes" type="checkbox" class="form-control payment_received width_auto mr-1"> {{ __('Payment Advices are attached.') }}</p>
            </div>

            <ul class="dot_list">
                <li>
                    <p class="pl-4 ml-3">
                    {{ __('Number of Payment Advices Attached') }}: 
                        <input name="<?php echo base64_encode('Number of Payment Advices Attached');?>" type="text" class="form-control width_auto">
                    </p>
                </li>
                <li>
                    <p class="pl-4 ml-3">
                    {{ __('Period Covered') }}:
                        <input name="<?php echo base64_encode('Period Covered');?>" type="text" class="form-control width_auto">
                        {{ __('(If period covered is less than 60 days or 8
                        weeks, attach an explanation)') }}
                    </p>
                </li>
                <li>
                    <p class="pl-4 ml-3">
                    {{ __('Number of Employers From Whom Debtor Received Payment Advices During the 60 Days Prior to Filing the
                        Bankruptcy Petition') }}:
                        <input name="<?php echo base64_encode('No# of Employers');?>" type="text" class="form-control width_auto">
                    </p>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold">{{ __('For Joint Debtor, if applicable:') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-12">
                <p><input name="<?php echo base64_encode('Check Box38');?>" value="Yes" type="checkbox" class="form-control spouse_payment_received width_auto mr-1"> {{ __('Payment Advices are Attached.') }}</p>
            </div>

            <ul class="dot_list">
                <li>
                    <p class="pl-4 ml-3">
                    {{ __('Number of Payment Advices Attached') }}: 
                        <input name="<?php echo base64_encode('Number of Payment Advices Attached_2');?>" type="text" class="form-control width_auto">
                    </p>
                </li>
                <li>
                    <p class="pl-4 ml-3">
                    {{ __('Period Covered') }}:
                        <input name="<?php echo base64_encode('Period Covered_2');?>" type="text" class="form-control width_auto">
                        {{ __('(If period covered is less than 60 days or 8
                        weeks, attach an explanation)') }}
                    </p>
                </li>
                <li>
                    <p class="pl-4 ml-3">
                    {{ __('Number of Employers From Whom Debtor Received Payment Advices During the 60 Days Prior to Filing the
                        Bankruptcy Petition') }}:
                        <input name="<?php echo base64_encode('TextBox0');?>" type="text" class="form-control width_auto">
                    </p>
                </li>
            </ul>
        </div>

        <div class="col-md-12 mt-3">
            <label class="text-bold text_italic">{{ __('For Debtor:') }}</label>
        </div>

        <div class="col-md-12 mt-3">
            <div class="row">
                <div class="col-md-12">
                    <p><input name="<?php echo base64_encode('Check Box39');?>" value="Yes" type="checkbox" class="form-control not_payment_received width_auto mr-1"> {{ __('No Payment Advices are Attached (the debtor had no income from any employer during the 60 Days Prior to Filing the Bankruptcy Petition).') }}</p>
                    <p><input name="<?php echo base64_encode('Check Box40');?>" value="Yes" type="checkbox" class="form-control width_auto mr-1"> {{ __('No Payment Advices are Attached for Some Other Reason. (Attach an explanation)') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <label class="text-bold">{{ __('For Joint Debtor, if applicable:') }}</label>
        </div>

        <div class="col-md-12 mt-3">
            <div class="row">
                <div class="col-md-12">
                    <p><input name="<?php echo base64_encode('Check Box41');?>" value="Yes" type="checkbox" class="form-control spouse_not_payment_received width_auto mr-1"> {{ __('No Payment Advices are Attached (the debtor had no income from any employer during the 60 Days Prior to Filing the Bankruptcy Petition).') }}</p>
                    <p><input name="<?php echo base64_encode('Check Box42');?>" value="Yes" type="checkbox" class="form-control width_auto mr-1"> {{ __('No Payment Advices are Attached for Some Other Reason. (Attach an explanation)') }}</p>
                </div>
            </div>
        </div>



        <div class="col-md-12 mt-3 p_justify">
            <p>{{ __('I declare under penalty of perjury that I have read this Payment Advices Cover Sheet and the attached payment advices,
                consisting of sheets, numbered 1 through , and that they are true and correct to the best of my knowledge, information
                and belief.') }}</p>
        </div>
        <div class="row">
            <div class="col-md-8 mt-3">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature of Debtor:"
                    inputFieldName="Signature of Debtor"
                    inputValue={{$debtor_sign}}>
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="col-md-4 mt-3">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date:"
                    dateNameField="Date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>

            <div class="col-md-8 mt-3">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature of Joint Debtor:"
                    inputFieldName="Signature of Joint Debtor"
                    inputValue={{$debtor2_sign}}>
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="col-md-4 mt-3">
                <x-officialForm.dateSingleHorizontal
                    labelText="Date:"
                    dateNameField="Date_2"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
        
    </div>

</div>

