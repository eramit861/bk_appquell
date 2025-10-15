<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF TENNESSEE') }}</h3>
    </div>

    <div class="col-md-4"></div>
    <div class="col-md-4">
        <h3>{{ __('Payment Advices Cover Sheet') }}</h3>
        <p >{{ __('consistent with 11 U.S.C. Sec.') }}<br>{{ __('521(a)(1)(B)(iv)') }}</p>
    </div>
    <div class="col-md-4"></div>


    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <label>{{ __('Chapter 7') }}</label>          
        </div>          
    </div>
    
    <div class="col-md-12 mt-3">
        <label class="text_italic">{{ __('Please Check the Appropriate Box.') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold">{{ __('For Debtor:') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-12">
                <p>(<input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2')?>" class="form-control width_auto mr-1 payment_received">{{ __(') Payment Advices are attached.') }}</p>
            </div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Number of Pages attached:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input type="text" name="<?php echo base64_encode('Text3')?>" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Period Covered:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input type="text" name="<?php echo base64_encode('Period Covered')?>" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('(please explain any gaps):') }}</label>
            </div>
            <div class="col-md-7 mt-1">
                <input type="text" name="<?php echo base64_encode('please explain any gaps')?>" class="form-control">
            </div>
            <div class="col-md-1 mt-1">
            </div>

            <div class="col-md-12 mt-1">
                <p class="pl-4 ml-3 p-2 ">
                {{ __('Number of Employers from Whom Debtor Received Payment Advices During the 60 Days Prior to Filing the
                    Bankruptcy Petition') }}: <input type="text" name="<?php echo base64_encode('Bankruptcy Petition')?>" class="form-control width_auto">
                </p>
            </div>

            <div class="col-md-12">
                <p>(<input type="checkbox" name="<?php echo base64_encode('Check Box4')?>" value="Yes" class="form-control width_auto mr-1 not_payment_received">{{ __(') No Payment Advices are attached (the debtor had no income from any employer during the 60 days prior to
                    filing the bankruptcy petition ).') }}</p>
            </div>

            <div class="col-md-12">
                <p>(<input type="checkbox" name="<?php echo base64_encode('Check Box5')?>" value="Yes" class="form-control width_auto mr-1">{{ __(') No Payment Advices are attached for other reason, or some payment advices are missing.') }}</p>
            </div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('(please explain):') }}</label>
            </div>
            <div class="col-md-7 mt-1">
                <input type="text" name="<?php echo base64_encode('please explain')?>" class="form-control">
            </div>
            <div class="col-md-1 mt-1">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold">{{ __('For Joint Debtor, if applicable:') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-12">
                <p>(<input type="checkbox" name="<?php echo base64_encode('Check Box6')?>" value="Yes" class="form-control width_auto mr-1 spouse_payment_received">{{ __(') Payment Advices are attached.') }}</p>
            </div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Number of Pages attached:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input type="text" name="<?php echo base64_encode('Text7')?>" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('Period Covered:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input type="text" name="<?php echo base64_encode('Period Covered_2')?>" class="form-control">
            </div>
            <div class="col-md-5 mt-1"></div>

            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('(please explain any gaps):') }}</label>
            </div>
            <div class="col-md-7 mt-1">
                <input type="text" name="<?php echo base64_encode('please explain any gaps_2')?>" class="form-control">
            </div>
            <div class="col-md-1 mt-1">
            </div>

            <div class="col-md-12 mt-1">
                <p class="pl-4 ml-3 p-2 ">
                {{ __('Number of Employers from Whom Debtor Received Payment Advices During the 60 Days Prior to Filing the
                    Bankruptcy Petition') }}: <input type="text" name="<?php echo base64_encode('Bankruptcy Petition_2')?>" class="form-control width_auto">
                </p>
            </div>

            <div class="col-md-12">
                <p>(<input type="checkbox" name="<?php echo base64_encode('Check Box8')?>" value="Yes" class="form-control width_auto mr-1 spouse_not_payment_received">{{ __(') No Payment Advices are attached (the debtor had no income from any employer during the 60 days prior to
                    filing the bankruptcy petition).') }}</p>
            </div>

            <div class="col-md-12">
                <p>(<input type="checkbox" name="<?php echo base64_encode('Check Box9')?>" value="Yes" class="form-control width_auto mr-1">{{ __(') No Payment Advices are attached for other reason, or some payment advices are missing.') }}</p> 
            </div>
            <div class="col-md-4 mt-1">
                <label class="pl-4 ml-3 p-2 ">{{ __('(please explain):') }}</label>
            </div>
            <div class="col-md-7 mt-1">
                <input type="text" name="<?php echo base64_encode('please explain_2')?>" class="form-control">
            </div>
            <div class="col-md-1 mt-1">
            </div>

            <div class="col-md-12 mt-3">
                <p>{{ __('I declare under penalty of perjury that the statements in this Payment Advices Cover Sheet are true and correct to the best of
                    my knowledge, information and belief.') }}</p>
            </div>

            <div class="col-md-8 mt-3">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature of Debtor:"
                    inputFieldName="Text10"
                    inputValue={{$debtor_sign}}>
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="col-md-4 mt-3">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>

            <div class="col-md-8 mt-3">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature of Joint Debtor:"
                    inputFieldName="Text11"
                    inputValue={{$debtor2_sign}}>
                </x-officialForm.debtorSignVertical>
            </div>
            <div class="col-md-4 mt-3">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date_2"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
        </div>
    </div>

</div>
