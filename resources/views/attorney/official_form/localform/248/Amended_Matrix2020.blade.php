<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF RHODE ISLAND') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor(s)"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="BK No."
            casenoNameField="Case No"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <span class="mt-3">&nbsp;</span>
        <x-officialForm.caseNo
            labelText="Chapter"
            casenoNameField="Chapter"
            caseno={{$chapterNo}}
        ></x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3">
        <p class="text-center"><span class="text-bold underline">{{ __('AMENDED MATRIX') }}</span>{{ __('(Fee Required)') }}</p>
    </div>
    <div class="col-md-12 mt-3 ">
        <p><label class="pl-4 ">&nbsp;</label>
            {{ __('NOW COME THE DEBTOR(S) and hereby moves to amend the matrix as submitted to 
            the court. The amended matrix is attached hereto.') }}
        </p>
    </div>
    <div class="col-md-6 ">
        <x-officialForm.signVertical
            labelText="Debtor"
            signNameField="Debtor"
            sign={{$onlyDebtor}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6 ">
        <x-officialForm.signVertical
            labelText="Joint Debtor"
            signNameField="Joint Debtor"
            sign={{$spousename}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6 mt-2 ">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date1"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-2 ">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-12 mt-3 ">
        <p class="text-center underline ">{{ __('CERTIFICATION') }}</p>
    </div>
    <div class="col-md-12 mb-3  ">
        <p>{{ __('I hereby certify that a copy of the within amendment was mailed to') }}</p>
        <textarea name="<?php echo base64_encode('Service to parties'); ?>" value="" class="form-control" rows="8" cols=" "></textarea>
        <p class="mt-1 ">
        {{ __('on the') }} 
            <input type="text" class="form-control width_auto ml-2 " name="<?php echo base64_encode('day'); ?>"> {{ __('day of') }} 
            <input type="text" class="form-control width_auto ml-2 " name="<?php echo base64_encode('month and year'); ?>">
        <p>
    </div>
    <div class="col-md-6 "></div>
    <div class="col-md-6 ">
        <x-officialForm.signVertical
            labelText="(Signature)"
            signNameField="Signature"
            sign={{$debtor_sign}}
        ></x-officialForm.signVertical>
        <span >&nbsp;</span>
        <x-officialForm.dateSingle
            labelText="(Date)"
            dateNameField="Date3"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
</div>