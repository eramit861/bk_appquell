<div class="text-center">
   <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
   WESTERN DISTRICT OF NORTH CAROLINA<br>
       <select class="form-control w-auto p-1" name="<?php echo base64_encode('Dropdown4'); ?>">
                <option value="BRYSON CITY DIVISION">{{ __('BRYSON CITY DIVISION') }}</option>
                <option value="ASHEVILLE DIVISION">{{ __('ASHEVILLE DIVISION') }}</option>
                <option value="SHELBY DIVISION">{{ __('SHELBY DIVISION') }}</option>
                <option value="CHARLOTTE DIVISION">{{ __('CHARLOTTE DIVISION') }}</option>
                <option value="STATESVILLE DIVISION" selected="true">{{ __('STATESVILLE DIVISION') }}</option>
        </select>
    </h3>
</div>
<div class="row mt-3">
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
            casenoNameField="Text2"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
</div>
<div class="text-center mb-3 mt-3">
    <h3>{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
    <div class="mt-4">
    <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="" class="form-control width_50percent"><br>
    <label>{{ __('[Insert name of corporate debtor/party]') }}</label>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <label>{{ __('Check one:') }}</label>
            </div>
            <div class="col-md-4">
                <!-- checked by default -->
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes" checked="true">
                <label>{{ __('DEBTOR') }}</label>
            </div>
            <div class="col-md-4">
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box7'); ?>"  value="Yes">
                <label>{{ __('PLAINTIFF') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4">
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box8'); ?>"  value="Yes">
                <label>{{ __('DEFENDANT') }}</label>
            </div>
            <div class="col-md-8">
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box9'); ?>"  value="Yes">
                <label>{{ __('OTHER (specify):') }}</label>
                <input name="<?php echo base64_encode('Text10'); ?>" type="text" value="" class="form-control w-auto">
            </div>
        </div>
    </div>
</div>
<p class="text_italic">
    <span class="text-bold">{{ __('Instructions:') }}</span>
    {{ __('Federal Rule of Bankruptcy Procedure 7007.1 requires corporate parties to an adversary
    proceeding, other than the debtor or a governmental unit, to file a statement of corporate ownership with
    the first pleading filed. Similarly, Federal Rule of Bankruptcy Procedure 1007(a)(1) requires corporate
    debtors to file a corporate ownership statement with their petitions containing the information described in
    Rule 7007.1. Check one of the statements set forth below and provide any information as directed.') }}
</p>

<div class="mt-2 gray-box p-2">
    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box11'); ?>" value="Yes">
    <label>
        <span class="pr-2">1.</span>
        {{ __('The following corporations directly or indirectly own 10% or more of any class of the abovenamed
        corporate debtor’s/party’s equity interests:') }}
    </label>
</div>

<div class="row mt-3">
    <div class="col-md-2 pt-2">
        <div class="float_right">
            <label>{{ __('Name:') }}</label>
        </div>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text13'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-2 pt-2">
        <div class="float_right">
            <label>{{ __('Address:') }}</label>
        </div>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text16'); ?>" type="text" value="" class="form-control">
    </div>
</div>

<div class="row mt-25">
    <div class="col-md-2 pt-2">
        <div class="float_right">
            <label>{{ __('Name:') }}</label>
        </div>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text14'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-2 pt-2">
        <div class="float_right">
        <label>{{ __('Address:') }}</label>
        </div>
    </div>
    <div class="col-md-10">
    <input name="<?php echo base64_encode('Text17'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-25">
    <div class="col-md-2 pt-2">
        <div class="float_right">
        <label>{{ __('Name:') }}</label>
        </div>
    </div>
    <div class="col-md-10">
    <input name="<?php echo base64_encode('Text15'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-2 pt-2">
        <div class="float_right">
        <label>{{ __('Address:') }}</label>
        </div>
    </div>
    <div class="col-md-10">
    <input name="<?php echo base64_encode('Text18'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<p class="text_italic text-bold mt-2">
    {{ __('(For additional names, attach an addendum to this form.)') }}
</p>
<div class="mt-2 gray-box p-2" >
    <input type="checkbox" class="form-check-input" name="<?php echo base64_encode('Check Box12'); ?>" value="Yes">
    <label>
        <span class="pr-2">2.</span>
        {{ __('There are no entities that directly or indirectly own 10% or more of any class of the abovenamed
        corporate debtor’s/party’s equity interests.') }}
    </label>
</div>
<div class="row mt-3">
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text19"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div>
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Authorized Individual for Corporate Debtor/Party"
            inputFieldName="Text20"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div>
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Printed Name of Authorized Individual for Corporate Debtor/Party"
            inputFieldName="Text21"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div>
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Title of Authorized Individual for Corporate Debtor/Party"
            inputFieldName="Text22"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>