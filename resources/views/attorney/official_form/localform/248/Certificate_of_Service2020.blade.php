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
        <h3 class="text-center underline">{{ __('CERTIFICATION') }}</h3>
    </div>
    <div class="col-md-12 mt-3 ">
        <p><label class="pl-4 ">&nbsp;</label>
        {{ __('I hereby certify that on') }}
            <input type="text" class="form-control width_auto" name="<?php echo base64_encode("day");?>">
            {{ __('day of') }}
            <input type="text" class="form-control width_auto" name="<?php echo base64_encode("month");?>">
            {{ __('the following interested parties received a
            copy of the following documents') }}
        </p>
    </div>
    <div class="col-md-12">
        <textarea name="<?php echo base64_encode("Document");?>" class="form-control" rows="3"></textarea>
        <p>{{ __('relating to the above referenced case were served on the following parties via regular mail at:') }}</p>
    </div>
    <div class="col-md-6 ">
        <x-officialForm.partyDetails
            textareaFieldName="textarea1"
            content=""
        ></x-officialForm.partyDetails>
    </div>
    <div class="col-md-6 ">
        <x-officialForm.partyDetails
            textareaFieldName="textarea2"
            content=""
        ></x-officialForm.partyDetails>
    </div>
    
    <div class="col-md-6 ">
        <x-officialForm.partyDetails
            textareaFieldName="textarea3"
            content=""
        ></x-officialForm.partyDetails>
    </div>
    <div class="col-md-6 ">
        <x-officialForm.partyDetails
            textareaFieldName="textarea4"
            content=""
        ></x-officialForm.partyDetails>
    </div>

    <div class="col-md-6 ">
        <x-officialForm.partyDetails
            textareaFieldName="textarea5"
            content=""
        ></x-officialForm.partyDetails>
    </div>
    <div class="col-md-6 ">
        <x-officialForm.partyDetails
            textareaFieldName="textarea6"
            content=""
        ></x-officialForm.partyDetails>
    </div>
    
    <div class="col-md-6 mt-2 ">
    </div>
    <div class="col-md-6 mt-2 text-center">
        <x-officialForm.signVertical
            labelText="(Signature)"
            signNameField="Signature"
            sign={{$debtor_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6 ">
    </div>
    <div class="col-md-6 mt-2 text-center">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
</div>