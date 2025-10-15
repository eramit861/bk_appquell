<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('District of North Dakota') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <input type="hidden" name="<?php echo base64_encode('Debtor1'); ?>" value="{{$onlyDebtor}}">
        <input type="hidden" name="<?php echo base64_encode('Debtor2'); ?>" value="{{$spousename}}">
        <x-officialForm.inReDebtorCustom
            debtorNameField=""
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Bankruptcy No:"
            casenoNameField="Bankruptcy No"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chap"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center">{{ __('AMENDMENT COVER SHEET') }}</h3>
    </div>
    <div class="col-md-12">
        <div class="row border_1px">
            <div class="col-md-12 mt-3">    
                <p class="text-center text-bold">
                    {{ __('Schedules and Statements Amended (check all that apply):') }}
                </p>
            </div>
            <div class="col-md-6 pb-3">
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Vol_Pet'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Voluntary Petition') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Summary'); ?>" value="Yes">
                    <div class="w-100">
                        <label> {{ __('Summary of Assets and Liabilities') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_AB'); ?>" value="Yes">
                    <div class="w-100">
                        <label> {{ __('Schedule A/B –Property') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_C'); ?>" value="Yes">
                    <div class="w-100">
                        <label> {{ __('Schedule C') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_D'); ?>" value="Yes">
                    <div class="w-100">
                        <label> {{ __('Schedule D') }} </label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_EF'); ?>" value="Yes">
                    <div class="w-100">
                        <label> {{ __('Schedule E/F') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_G'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Schedule G') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_H'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Schedule H') }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pb-3">
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_I'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Schedule I') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Sched_J'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Schedule J') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Dec_Sched'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Declaration Concerning Schedules') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('SOFA'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Statement of Financial Affairs') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Atty_Disc'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __("Attorney's Disclosure of Compensation") }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('State_Int'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Statement of Intention') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Means_Test'); ?>" value="Yes">
                    <div class="w-100">
                        <label>{{ __('Statement of Current Monthly Income') }}</label>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <input type="checkbox" class="form-control height_fit_content w-auto mt-2" name="<?php echo base64_encode('Other'); ?>" value="Yes">
                    <div class="w-100">
                        <label>Other <input type="text" name="<?php echo base64_encode('Other Text'); ?>" class="form-control width_90percent"></label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 border_top_none border_1px">    
        <p class="mb-2 mt-3">
            {{ __('Schedules and Statements Amended (check all that apply):') }}
        </p>
        <div class="d-flex mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Add_Cred'); ?>" value="Yes">
            <div class="w-100">
                <label>{{ __('Other Add new creditor(s) (Notice to Creditors of Amended Schedules must be served and filed)') }}</label>
            </div>
        </div>
        <div class="d-flex mt-2 mb-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Correct_Delete'); ?>" value="Yes">
            <div class="w-100">
                <label>{{ __('Correct or delete information.') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-12 border_top_none border_1px pb-3">    
        <p class="mb-2 mt-3">
            {{ __('Describe changes: (ex. "Added creditor XYZ to Schedule E/F")') }}
        </p>
        <textarea name="<?php echo base64_encode('Changes'); ?>"  class="form-control" rows="4"></textarea>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline mb-4 ">{{ __('DECLARATION') }}</h3>
        <p>
           {{ __('I certify under penalty of perjury that the foregoing is true and correct, and that the attached amendments are true and correct.') }}
        </p>
    </div>
    <div class="col-md-6 mt-3">
    <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
         <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 1 (Signature)"
            inputFieldName="D1_Sig"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor 2 (Signature)"
                inputFieldName="D2_Sig"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>