
    <div class="text-center"> 
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF NEW YORK') }}</h3>
    </div>
    <div class="row mt-4">
       <div class="col-md-6 border_1px p-3 br-0">
           <div>
                <label>{{ __('In re') }}</label>
                <textarea name="<?php echo base64_encode('Debtor'); ?>" type="text" class="form-control mt-2" row="3">{{$debtorname}}</textarea>
                <p class="text_italic"><strong>{{ __('[Set forth here all names including married, maiden, and trade names used by debtor within last 8 years.]') }}</strong></p>
                <div class="mb-4">
                    <label class="float_right">{{ __('Debtor') }}</label>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8">
                <label class="mt-3"></label>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8 pt-3">
                    <label class="mt-3">{{ __('Employer’s Tax Identification No(s)') }}. <span class="text_italic"><strong>{{ __('[if any]') }}</strong></span></label>
                </div>
                <div class="col-md-4">
                    <input name="<?php echo base64_encode('EIN'); ?>" type="text" value="" class="mt-3 form-control w-auto">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8">
                    <label>{{ __('Last four digits of Social Security No(s):') }}</label>
                </div>
                <div class="col-md-4">
                    <input name="<?php echo base64_encode('SSN'); ?>" type="text" value="{{$last_4_ssn_d1}}" class="form-control w-auto">
                </div>
            </div>
        </div>
        <div class="col-md-6 border_1px p-3">
                <x-officialForm.caseNo
                    labelText="Case No."
                    casenoNameField="Case No"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            <div class="row mt-4">
                <div class="col-md-3 pt-3">
                    <label>{{ __('Chapter:') }}</label>
                </div>
                <div class="col-md-9">
                <select name="<?php echo base64_encode('Chapter'); ?>" class="form-control width_auto mt-2">
                    <option value=""></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                </select>
            </div>
        </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold">{{ __('For Debtor:') }}</p>
            <div class="form-check">
                <input type="checkbox" class=" form-control width_auto payment_received" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
                <label>{{ __('Payment advices are attached') }}</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class=" form-control width_auto not_payment_received" name="<?php echo base64_encode('Check Box2'); ?>" value="Yes">
                <label>{{ __('Payment advices') }} <span class="text-bold">{{ __('are not') }}</span> {{ __('attached because debtor had no income from any employer during the 60 days prior to filing the bankruptcy petition.') }}</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box3'); ?>" value="Yes">
                <label>{{ __('Payment advices') }} <span class="text-bold">are not</span> {{ __('attached because debtor:') }}</label>
            </div>
            <div class="pl-4">
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box4'); ?>" value="Yes">
                    <label>{{ __('receives disability payments') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes">
                    <label>{{ __('is unemployed and does not receive unemployment compensation') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
                    <label>{{ __('receives Social Security payments') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
                    <label>{{ __('receives a pension') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box8'); ?>" value="Yes">
                    <label>{{ __('does not work outside the home') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box9'); ?>" value="Yes">
                    <label>{{ __('is self employed') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class=" form-control width_auto" name="<?php echo base64_encode('Check Box10'); ?>" value="Yes">
                    <label>{{ __('other, please explain') }}</label>
                    <input name="<?php echo base64_encode('Other'); ?>" type="text" value="" class="form-control w-auto">
                </div>
                <div class="mt-2">
                    <p class="mb-1">{{ __('Schedule I, Part 2, Number 2 Income') }}<input name="<?php echo base64_encode('Income1'); ?>" type="text" value="" class="form-control width_50percent ml-2"></p>
                    <p class="mb-1">{{ __('Occupation as listed on Schedule I') }}<input name="<?php echo base64_encode('Occupation1'); ?>" type="text" value="" class="form-control width_50percent ml-3"></p>
                </div>
           </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold">{{ __('For Joint Debtor, if applicable:') }}</p>
            <div class="form-check">
                <input type="checkbox" class=" form-control width_auto spouse_payment_received" name="<?php echo base64_encode('Check Box11'); ?>" value="Yes">
                <label>{{ __('Payment advices are attached') }}</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="o512 form-control width_auto spouse_not_payment_received" name="<?php echo base64_encode('Check Box12'); ?>" value="Yes">
                <label>{{ __('Payment advices') }}<span class="o512 text-bold">{{ __('are not') }}</span> {{ __('attached because debtor had no income from any employer during the 60 days prior to filing the bankruptcy petition.') }}</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box13'); ?>" value="Yes">
                <label>{{ __('Payment advices') }} <span class="o512 text-bold">are not</span> {{ __('attached because debtor:') }}</label>
            </div>
            <div class="pl-4 o512">
                <div class="o512 form-check">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box14'); ?>" value="Yes">
                    <label>{{ __('receives disability payments') }}</label>
                </div>
                <div class="o512 form-check">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box15'); ?>" value="Yes">
                    <label>{{ __('is unemployed and does not receive unemployment compensation') }}</label>
                </div>
                <div class="o512 form-check">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box16'); ?>" value="Yes">
                    <label>{{ __('receives Social Security payments') }}</label>
                </div>
                <div class="o512 form-check">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box17'); ?>" value="Yes">
                    <label>{{ __('receives a pension') }}</label>
                </div>
                <div class="form-check o512">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box18'); ?>" value="Yes">
                    <label>{{ __('does not work outside the home') }}</label>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box19'); ?>" value="Yes">
                    <label>{{ __('is self employed') }}</label>
                </div>
                <div class="o512 form-check">
                    <input type="checkbox" class="o512 form-control width_auto" name="<?php echo base64_encode('Check Box20'); ?>" value="Yes">
                    <label>{{ __('other, please explain') }}</label>
                    <input name="<?php echo base64_encode('Other'); ?>" type="text" value="" class="form-control w-auto">
                </div>
                <div class="mt-2 o512">
                    <p class="mb-1 o512">{{ __('Schedule I, Part 2, Number 2 Income') }}
                        <input name="<?php echo base64_encode('Income2'); ?>" type="text" value="" class="form-control width_50percent ml-2">
                    </p>
                    <p>
                    {{ __('Occupation as listed on Schedule I') }}<input name="<?php echo base64_encode('Occupation2'); ?>" type="text" value="" class="form-control width_50percent ml-3">
                    </p>
                </div>
           </div>
        </div>
        <div class="col-md-12 o512">
            <p>
            {{ __('I declare under penalty of perjury that I have read this Payment Advices Cover Sheet and the attached payment advices, consisting of') }} 
                <input name="<?php echo base64_encode('Number'); ?>" type="text" value="" class="form-control width_10percent">{{ __('sheets,
                and that they are true and correct to the best of my knowledge, information and belief.') }}
            </p>
        </div>
        <div class="col-md-6">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Debtor:"
                inputFieldName="Debtor1"
                inputValue={{$debtor_sign}}> 
            </x-officialForm.debtorSignVertical>
            <div class="mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signature of Joint Debtor:"
                inputFieldName="Debtor2"
                inputValue={{$debtor2_sign}}>
            </x-officialForm.debtorSignVertical>
            </div>
        </div>
        <div class="col-md-6">
           <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Date1"
                currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
            <div class="mt-2">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date2"
                    currentDate={{$currentDate}}>
                </x-officialForm.dateSingleHorizontal>
            </div>
        </div>
    </div>
