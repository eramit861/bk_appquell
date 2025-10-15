<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3 class="underline">{{ __('LOCAL BANKRUPTCY FORM 2016-1') }}</h3>
        <h3 class="mt-3">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE MIDDLE DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="CHAPTER"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label>{{ __('CASE NO.') }}</label>
                </div>
                <div class="col-md-9">
                    <p>
                        <input type="text" name="<?php echo base64_encode('Office Number'); ?>" class="form-control width_10percent">
                        -
                        <input type="text" name="<?php echo base64_encode('Case Year'); ?>" class="form-control width_20percent">
                        -bk-
                        <input type="text" name="<?php echo base64_encode('Case Number'); ?>" class="form-control w-auto" value="{{$caseno}}">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class=" col-md-12 text-center mb-3 mt-3">
        <h3 class="">{{ __('SUMMARY COVER SHEET') }}<br>{{ __('FEES AND EXPENSES APPLICATION') }}</h3>
    </div>
    
    <div class=" col-md-12 ">
        <div class="d-flex pl-2">
            <label class="p-2">a.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('Your applicant was appointed on') }} 
                    <input type="text" name="<?php echo base64_encode('Date of appointment'); ?>" class="form-control width_50percent">
                    ,
                    <br>
                    {{ __('based on an application filed') }} 
                    <input type="text" name="<?php echo base64_encode('Filed date of application'); ?>" class="form-control width_50percent mt-1">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="p-2">b.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('Your applicant represents') }} 
                    <input type="text" name="<?php echo base64_encode('Party applicant represents'); ?>" class="form-control width_50percent">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="p-2">c.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('This application is a') }}
                    <input type="text" name="<?php echo base64_encode('Type of application, interim or final'); ?>" class="form-control width_50percent">
                    {{ __('(state whether interim or final application).') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="p-2">d.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('The total amount of compensation for which reimbursement is sought is') }} 
                    <input type="text" name="<?php echo base64_encode('Amount of compensation'); ?>" class="form-control w-auto">
                    {{ __('and is
                    for the period from') }} 
                    <input type="text" name="<?php echo base64_encode('Compensation From'); ?>" class="form-control w-auto">
                    {{ __('to') }} 
                    <input type="text" name="<?php echo base64_encode('Compensation To'); ?>" class="form-control w-auto">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="p-2">e.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('The total amount of expenses for which reimbursement is sought is') }} 
                    <input type="text" name="<?php echo base64_encode('Amount of expenses'); ?>" class="form-control w-auto">
                    {{ __('and is
                    for the period from') }} 
                    <input type="text" name="<?php echo base64_encode('Expenses From'); ?>" class="form-control w-auto">
                    {{ __('to') }} 
                    <input type="text" name="<?php echo base64_encode('Expenses To'); ?>" class="form-control w-auto">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="p-2">f.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('The dates and amounts of any retainer received are') }} 
                    <input type="text" name="<?php echo base64_encode('Dates and amounts of retainer'); ?>" class="form-control width_50percent">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="p-2">g.</label>
            <div class="pl-2 w-100">
                <p>
                {{ __('The dates and amounts of withdrawals from the retainer by the Applicant are') }}
                    <input type="text" name="<?php echo base64_encode('Dates and amounts of withdrawals'); ?>" class="form-control width_50percent">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="pl-2">h.</label>
            <div class="pl-2 w-100">
                <p>
                    {{ __('The dates and amounts of previous compensation allowed are:') }}
                    <br>
                    <input type="text" name="<?php echo base64_encode('Dates and amounts of previous compensation allowed'); ?>" class="form-control width_50percent">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="pl-2">i.</label>
            <div class="pl-2 w-100">
                <p>
                    {{ __('The dates and amounts of previous compensation paid are:') }}
                    <br>
                    <input type="text" name="<?php echo base64_encode('Dates and amounts of previous compensation paid'); ?>" class="form-control width_50percent">
                    .
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <label class="pl-2">j.</label>
            <div class="pl-2 w-100">
                <p>
                    {{ __('There are/are no objections to prior fee applications of Applicant that have not been ruled
                    upon by the Court in this bankruptcy case.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 pt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATED:"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="input-group">
            <label>{{ __("Applicant's Signature") }}</label>
            <?php $namefield = "Applicant's Signature"?>
            <input name="<?php echo base64_encode($namefield); ?>" value="{{$attorny_sign}}" type="text" class="form-control">
        </div>
    </div>
</div>