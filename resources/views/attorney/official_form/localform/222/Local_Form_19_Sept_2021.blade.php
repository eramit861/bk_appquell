<div class="text-center">
   <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
   WESTERN DISTRICT OF NORTH CAROLINA<br>
       <select class="form-control w-auto p-1" name="<?php echo base64_encode('Dropdown8'); ?>">
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
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text1"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text2"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
</div>
<div class="text-center mb-3 mt-3 underline">
    <h3>{{ __('COVER SHEET FOR AMENDED SCHEDULES AND STATEMENTS') }}</h3>
</div>
<p>
    {{ __('Briefly describe the amendments to the Debtor’s schedules and statements below, including the names of
    the schedules and/or statements being amended and any creditors added or removed.') }}
</p>
<p>
    <span class="underline text-bold">{{ __('Note:') }}</span>
     {{ __('A filing fee may be required.') }}
</p>
<textarea name="<?php echo base64_encode(''); ?>" type="text" value="" class="form-control bg-none bb-0 " rows="15" disabled></textarea>
<div class="row">
    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text4"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor(s) (or Debtor, if Pro Se)"
            inputFieldName="Text5"
            inputValue="{{$attorney_name}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Print Name(s)"
                inputFieldName="Text6"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Pro Se Joint Debtor (if applicable)"
            inputFieldName=""
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Address"
                inputFieldName="Text7"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>