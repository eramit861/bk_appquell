<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('CONVERSION OF CASE BY DEBTOR') }}</h3>
        <p class="mt-3">
        {{ __('CONVERSION OF CHAPTER') }} 
            <input type="text" name="<?php echo base64_encode('Chapter');?>" class=" form-control w-auto">
            {{ __('CASE TO CHAPTER') }} 
            <input type="text" name="<?php echo base64_encode('TO CHAPTER');?>" class=" form-control w-auto">
            {{ __('CASE') }}
        </p>
    </div>    

    <div class=" col-md-12 mt-3">
        <div class="d-flex">
            <div class=" pt-2">
                <label for="">1.</label>
            </div>
            <div class="pl-4 w-100">
                <p class="mb-2">
                {{ __('This bankruptcy case was commenced by petition filed by the debtor(s) under chapter') }}
                    <input type="text" name="<?php echo base64_encode('L10');?>" class=" form-control w-auto">
                    {{ __('on') }}
                    <input type="text" name="<?php echo base64_encode('L11');?>" class=" form-control w-auto">
                    . {{ __('Conversion of this case by the debtor(s) to a chapter') }}
                    <input type="text" name="<?php echo base64_encode('L12');?>" class=" form-control w-auto">
                    {{ __('case is allowed under §') }}
                    <input type="text" name="<?php echo base64_encode('L13');?>" class=" form-control w-auto">
                    {{ __('of the Bankruptcy Code') }}</p>  
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class=" pt-2">
                <label for="">2.</label>
            </div>
            <div class="pl-4 w-100">
                <p class="mb-2">
                {{ __('The debtor(s) hereby files this conversion and converts this case to a chapter') }}
                    <input type="text" name="<?php echo base64_encode('L14');?>" class=" form-control w-auto">
                    {{ __('case') }}
                        {{ __('under §§ 348 and') }} 
                    <input type="text" name="<?php echo base64_encode('L15');?>" class=" form-control w-auto">
                    {{ __('of the Bankruptcy Code.') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class=" pt-2">
                <label for="">3.</label>
            </div>
            <div class="pl-4 w-100">
                <p class="mb-2">
                {{ __('(If 12 or 13 to 7 or if 7 to 12 or 13) Attached hereto and filed herewith are new exhibits,
                    attachments, schedules, statements and lists appropriate for a chapter') }}    
                    <input type="text" name="<?php echo base64_encode('L16');?>" class=" form-control w-auto">
                    {{ __('case.') }} 
                </p>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="pl-4 w-100">
                <p class="mb-1">
                    {{ __('The current address(es) for the debtor(s) is as follows:') }}
                </p>
                <input type="text" name="<?php echo base64_encode('L17');?>" class=" form-control mt-1">
                <input type="text" name="<?php echo base64_encode('L18');?>" class=" form-control mt-1">
            </div>
        </div>
        <p class=" mt-3">
            <span class="pl-5"></span>
            {{ __('WHEREFORE, the debtor(s) requests relief in accordance with chapter') }}
            <input type="text" name="<?php echo base64_encode('L19');?>" class=" form-control mt-1 w-auto">
             {{ __('of the
            Bankruptcy Code and declares under penalty of perjury that the information provided in this
            conversion is true and correct.') }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="L20"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="L23"
                inputValue={{$attorny_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <label for="">{{ __('Attorney for Debtor(s)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="L21"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row pl-2">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <label for="">{{ __('Debtor 1') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="L24"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signed:"
                inputFieldName="L22"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row pl-2">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <label for="">{{ __('Debtor 2 (if joint case)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Address:"
                inputFieldName="L25"
                inputValue="{{$attonryAddress1}} ,{{$attonryAddress2}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row mt-1">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('L26');?>" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}" class="form-control">
            </div>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Phone:"
                inputFieldName="L27"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="License Number"
                inputFieldName="L28"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    

</div>