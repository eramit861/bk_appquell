<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF OREGON') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor5005"
            debtorname={{$debtorname}}
            rows="5">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="CaseNo5005"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                    labelText=""
                    casenoNameField="CaptionText5005"
                    caseno="">
            </x-officialForm.caseNo>
        </div>
        <p class="text-bold mt-3">{{ __('ELECTRONIC FILING DECLARATION') }}<br>{{ __('(FOR INDIVIDUAL DEBTORS)') }}</p>
    </div>
    <div class="col-md-12 mt-2">
        <p>{{ __('Check if Applicable') }}</p>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex mt-2 pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Box15005'); ?>">
                    <div>
                        <span>{{ __('Petition (Including Exhibit D if applicable)') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign15005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex mt-2 pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Box25005'); ?>">
                    <div>
                        <span>{{ __('Chapter 7 Debtor’s Statement of Intention') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign25005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex mt-2 pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Box35005'); ?>">
                    <div>
                        <span>{{ __('Declaration Concerning Debtor’s Schedules') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign35005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex mt-2 pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Box45005'); ?>">
                    <div>
                        <span>{{ __('Statement of Financial Affairs') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign45005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex mt-2 pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Box55005'); ?>">
                    <div>
                        <span>{{ __('Statement of Monthly Income') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign55005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex mt-2 pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('Box65005'); ?>">
                    <div>
                        <span>{{ __('Statement of Social Security Numbers') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign65005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <div class="d-flex pl-4">
                    <input type="checkbox" value="Yes" class="form-comtrol width-auto height_fit_content mt-2" name="<?php echo base64_encode('Box75005'); ?>">
                    <div class="w-100">
                        <p>Other (specify): <input name="<?php echo base64_encode('Other5005'); ?>" type="text" value="" class="form-control width_85percent"></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
               <p>{{ __('Date Signed') }}:<input name="<?php echo base64_encode('DateSign75005'); ?>" type="text" value="" class="date_filed form-control w-auto"></p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('PART I – DECLARATION OF DEBTOR(S)') }}</p>
        <p>
        {{ __('I/We, the undersigned debtor(s), hereby declare under penalty of perjury that I/we:') }}
        </p>
        <div class="d-flex mt-2">
            <span class="pr-2">1.</span>
            <div>                
                {{ __('signed each above-referenced document and gave it to my (our) attorney, whose name appears below;') }}
            </div>
       </div>
       <div class="d-flex mt-2">
            <span class="pr-2">2.</span>
            <div>
                {{ __('authorize and instruct my (our) lawyer to:') }}
            </div>
       </div>
       <div class="d-flex mt-2 pl-4">
            <span class="pr-2">a.</span>
            <div>
                 {{ __('electronically file the document(s), with “/s/” and my (our) typed name(s) in lieu of my (our) signature(s);') }}
            </div>
       </div>
       <div class="d-flex mt-2 pl-4">
            <span class="pr-2">b.</span>
            <div>
            {{ __('electronically file a') }} <span class="text-bold underline">{{ __('scanned') }} </span>{{ __('copy of this completed and signed LBF 5005;') }}
            </div>
       </div>
       <div class="d-flex mt-2 pl-4">
            <span class="pr-2">c.</span>
            <div>
                {{ __('scan and destroy the document(s), but not this LBF 5005; and') }}
            </div>
       </div>
       <div class="d-flex mt-2 pl-4">
            <span class="pr-2">d.</span>
            <div>
                {{ __('retain a scanned electronic replica of the document(s), and the signed original of this form, for the period required by LBR 5005-4(e).') }}
            </div>
       </div>
       <div class="d-flex mt-2 ">
            <span class="pr-2">3.</span>
            <div>
                {{ __('agree that the electronic copy of the document(s) my (our) lawyer retains may serve as the original for all purposes.') }}
            </div>
       </div>
    </div>
    <div class="col-md-5 mb-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName=""
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 mb-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Printed Name of Debtor"
            inputFieldName="PrintDB5005"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mb-3 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="DateSign85005"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

    <div class="col-md-5 mb-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Joint Debtor (if applicable)"
            inputFieldName=""
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 mb-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Printed Name of Joint Debtor"
            inputFieldName="PrintJDB5005"
            inputValue={{$spousename}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mb-3 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="DateSign95005"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('PART II – DECLARATION OF ATTORNEY') }}</p>
        <p>{{ __('I declare under penalty of perjury that, to the best of my knowledge after appropriate inquiry, the
        signature on this LBF 5005 purporting to be that of the debtor(s) is in fact that of the debtor(s).') }}</p>
    </div>
    <div class="col-md-5 mb-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Attorney"
            inputFieldName=""
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 mb-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Printed Name of Attorney"
            inputFieldName="PrintAtty5005"
            inputValue={{$attorney_name}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mb-3 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="DateSign105005"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
</div>