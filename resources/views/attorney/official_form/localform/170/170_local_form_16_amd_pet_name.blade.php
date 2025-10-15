<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    
    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('AMENDMENT TO PETITION REGARDING NAME/ADDRESS') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <p>{{ __('To: Clerk of Bankruptcy Court') }}</p>
        <p>{{ __('The original petition filed on') }} <input type="text"  name="<?php echo base64_encode('The original petition filed on 1'); ?>" class=" form-control w-auto"> {{ __('is amended as follows:') }}</p>
    </div>
    
    <div class=" col-md-6 pt-3 border_top_1px">
        <p class=" underline">{{ __('Name') }}</p>
        <p>{{ __('The correct name(s) of the Debtor(s),
            including AKA, DBA, or ASF if any,
            is (are):') }}</p>
    </div>
    <div class=" col-md-6 pt-3 border_top_1px">
        <textarea name="<?php echo base64_encode('Text3'); ?>"  class=" form-control " rows="5"></textarea>
    </div>

    <div class=" col-md-6 pt-3 mt-3 border_top_1px">
        <p class=" underline">{{ __('Address') }}</p>
        <p>{{ __('The correct address(es) of the Debtor(s), in') }} <input type="text" name="<?php echo base64_encode('County is are'); ?>" class=" form-control w-auto"> {{ __('County, is (are):') }}</p>
    </div>
    <div class=" col-md-6 pt-3 mt-3 border_top_1px">
        <textarea name="<?php echo base64_encode('Text4'); ?>"  class=" form-control " rows="5"></textarea>
    </div>
    
    <div class=" col-md-12 pt-3 mt-3 border_top_1px">
        <p>{{ __('VERIFICATION: I (We), debtor(s) named in the foregoing amended schedule, declare under
        penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>

    
    <div class=" col-md-6">
        <div>
            <x-officialForm.dateSingleHorizontal
                labelText="Executed on:"
                dateNameField="Executed on"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed_2"
                inputValue={{$attorny_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Attorney for Debtor(s)') }}</label>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Print Attorney Name"
                inputFieldName="Print Attorney Name 1"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney Address:"
                inputFieldName="Attorney Address"
                inputValue="{{$attonryAddress1}} ,{{$attonryAddress2}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8"> <input type="text" name="<?php echo base64_encode('Print Attorney Name 2'); ?>" class=" form-control mt-1" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}"></div>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Phone Number:"
                inputFieldName="Phone Number"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="License Number:"
                inputFieldName="License Number"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class=" col-md-6">
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Debtor 1') }}</label>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="Signed_3"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <label for="">{{ __('Debtor 2 (if joint case)') }}</label>
    </div>


</div>