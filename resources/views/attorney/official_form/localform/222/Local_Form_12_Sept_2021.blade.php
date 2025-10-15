<div class="text-center">
   <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
   WESTERN DISTRICT OF NORTH CAROLINA<br>
       <select class="form-control w-auto p-1" name="<?php echo base64_encode('Dropdown1'); ?>">
                <option value="BRYSON CITY DIVISION" selected="true">{{ __('BRYSON CITY DIVISION') }}</option>
                <option value="ASHEVILLE DIVISION">{{ __('ASHEVILLE DIVISION') }}</option>
                <option value="SHELBY DIVISION">{{ __('SHELBY DIVISION') }}</option>
                <option value="CHARLOTTE DIVISION">{{ __('CHARLOTTE DIVISION') }}</option>
                <option value="STATESVILLE DIVISION">{{ __('STATESVILLE DIVISION') }}</option>
        </select>
    </h3>
</div>
<div class="row mt-3">
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text2"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text3"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text4"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
</div>
<div class="text-center mb-3 mt-3">
    <h3>{{ __('NOTICE OF CASE-SPECIFIC NAME AND/OR ADDRESS CHANGE*') }}</h3>
</div>
<div class="pl-5 mb-3">
    <div>
        <!-- checked by default  -->
        <input type="checkbox" class="form-control w-auto " name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" checked="true">
        <label>{{ __('Filed by the Debtor(s)') }}</label>
    </div>
    <div>
        <input type="checkbox" class="form-control w-auto " name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
        <label>{{ __('Filed by a creditor') }}</label>
    </div>
    <div>
        <input type="checkbox" class="form-control w-auto " name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
        <label>{{ __('Filed by another party in interest') }}</label>
    </div>
</div>
<p>(
    <span class="underline">{{ __('Debtor(s)') }}</span>
    {{ __(') files this notice of name and/or mailing address change to be used to provide notice and/or to
    deliver payments in this case. Pursuant to 11 U.S.C. § 342(e)(2), any notice in this case required to be
    provided to a creditor by the Debtor or the court will not be provided in care of the new name and/or mailing
    address designated below until after 7 days following the filing of this notice with the court.') }}
</p>
<p class="text-bold">
    {{ __('Current address to be changed (if applicable):') }}
</p>

<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Name:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text9'); ?>" type="text" value="{{$debtorname}}" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 1:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text10'); ?>" type="text" value="{{$debtoraddress}}" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 2:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text11'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 3:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text12'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 4:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text13'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('City, State, Zip:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text14'); ?>" type="text" value="{{$debtorCity}} {{$debtorState}}, {{$debtorzip}}" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2 pl-5">
        <p class="text-bold">{{ __('New name and/or') }}<br> {{ __('mailing address') }}<br>{{ __('below:') }}</p>
    </div>
    <div class="col-md-10">
        <div class="d-flex">
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box17'); ?>" value="Yes">
            <div>
                <label>{{ __('for payment purposes only') }}</label>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box18'); ?>" value="Yes">
            <div>
                <label>{{ __('for notice purposes only') }}</label>
            </div>
        </div>
        <div class="d-flex">
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box19'); ?>" value="Yes">
            <div>
                <label>{{ __('for both payment and notice purposes') }}</label>
            </div>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Name:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text15'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 1:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text16'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 2:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text20'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2 mb-3">
    <div class="col-md-2">
        <label>{{ __('Address 3:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text21'); ?>" type="text" value="" class="form-control">
    </div>
    <div class="col-md-4 border_bottom_1px mt-4">
    </div>
    <div class="col-md-8 mt-4">
    </div>
</div>

<p>* {{ __('This form cannot be used to file a formal notice of transfer of claim pursuant to Federal Rule of Bankruptcy Procedure
3001(e)') }}.</p>

<div class="row mt-2">
    <div class="col-md-2">
        <label>{{ __('Address 4:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text22'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<div class="row mt-2 mb-4">
    <div class="col-md-2">
        <label>{{ __('City, State, Zip:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text23'); ?>" type="text" value="" class="form-control">
    </div>
</div>
<p>{{ __('Under penalty of perjury, I, the undersigned, affirm that I am authorized to request this address change.') }}</p>
<div class="row mt-2">
    <div class="col-md-2 pr-0">
        <label>{{ __('Name and position:') }}</label>
    </div>
    <div class="col-md-4 pl-0 ml-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Print or Type)"
            inputFieldName="Text24"
            inputValue="{{$attorney_name}} / Attorney for Debtor(s)"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4">
    </div>
</div>
<div class="row mt-2">
    
    <div class="col-md-4 mt-2">
        <div class="pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signature"
                inputFieldName="Text25"
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-4 mt-2">
    </div>
    <div class="col-md-4 mt-2">
    </div>

    <div class="col-md-4 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text26"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4 mt-2">
    </div>
    <div class="col-md-4 mt-2">
    </div>
</div>
