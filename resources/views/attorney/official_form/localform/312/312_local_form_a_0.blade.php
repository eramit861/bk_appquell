<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF WYOMING') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
                debtorNameField="Text1"
                debtorname={{$debtorname}}
                rows="3">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Case No"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">{{ __('COVER SHEET FOR APPLICATION FOR PROFESSIONAL COMPENSATION') }}</h3>
    </div>

    <div class="col-md-12">
        <p class="mb-0 float_right">{{ __('Interim Application') }} 
            <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="form-control w-auto mr-1 height_fit_content">
        </p>
    </div>

    <div class="col-md-12">
        <p class="mb-0 float_right">{{ __('Final Application') }} 
            <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control w-auto mr-1 height_fit_content">
        </p>
    </div>

    <div class="col-md-3 mt-2">
        <p class="mb-0">{{ __('Name of Applicant') }} </p>
    </div>

    <div class="col-md-9 mt-2">
        <input type="text" name="<?php echo base64_encode('Name of Applicant');?>" class=" form-control width_40percent">
    </div>
    
    <div class="col-md-3 mt-1">
        <p class="mb-0">{{ __('Date of Order Authorizing Employment') }}</p>
    </div>

    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('Date of Order Authorizing Employment');?>" class=" form-control width_40percent">
    </div>
    <div class="col-md-3 mt-1">
        <p class="mb-0">{{ __('Period for which compensation is requested') }}</p>
    </div>

    <div class="col-md-9 mt-1">
        <input type="text" name="<?php echo base64_encode('Period for which compensation is requested');?>" class=" form-control w-auto">
    </div>
    <div class="col-md-12">
        <p class="mb-0">{{ __('Fees and Expenses:') }}</p>
        <div class="row pl-4">
            <div class="col-md-3">
                <p class="mb-0 mt-2">{{ __('Fees paid pre-petition') }}</p>
                <p class="mb-0 mt-3">{{ __('Fees requested to be paid by estate') }}</p>
                <p class="mb-0 mt-3">{{ __('Total amount of fees requested') }}</p>
            </div>
            <div class="col-md-3">
                <input type="text" name="<?php echo base64_encode('Fees paid prepetition');?>" class=" form-control w-auto">
                <input type="text" name="<?php echo base64_encode('Fees requested to be paid by estate');?>" class=" form-control w-auto mt-1">
                <input type="text" name="<?php echo base64_encode('Total amount of fees requested');?>" class=" form-control w-auto mt-1">
            </div>
            <div class="col-md-3">
                 <p class="mb-0 mt-2">{{ __('Expenses paid pre-petition') }} </p>
                 <p class="mb-0 mt-3">{{ __('Expenses requested to be paid by estate') }} </p>
                 <p class="mb-0 mt-3">{{ __('Total amount of expenses requested') }} </p>
            </div>
            <div class="col-md-3">
                <input type="text" name="<?php echo base64_encode('Expenses paid prepetition');?>" class=" form-control w-auto">
                <input type="text" name="<?php echo base64_encode('Expenses requested to be paid by estate');?>" class=" form-control w-auto mt-1">
                <input type="text" name="<?php echo base64_encode('Total amount of expenses requested');?>" class=" form-control w-auto mt-1">
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('Total amount of fees and expenses requested for the above stated period') }}: 
            <input type="text" name="<?php echo base64_encode('Total amount of fees and expenses requested for the above stated period');?>" class=" form-control w-auto">
        </p>
        <p>{{ __('Total hours billed and applicable billing rate for each person requesting fees as part of this application') }}</p>
    </div>
    <div class="col-md-5">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Name') }}"
            inputFieldName="Name"
            inputValue="">
        </x-officialForm.labelInputVertical>
    </div>
    <div class="col-md-2">
       <x-officialForm.labelInputVertical
            labelContent="{{ __('Rate') }}"
            inputFieldName="Rate"
            inputValue="">
        </x-officialForm.labelInputVertical>
    </div>
    <div class="col-md-2">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Hours') }}"
            inputFieldName="Hours"
            inputValue="">
        </x-officialForm.labelInputVertical>
    </div>
    <div class="col-md-3">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Total Requested') }}"
            inputFieldName="Total Requested"
            inputValue="">
        </x-officialForm.labelInputVertical>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('If this is') }} <span class="underline">not</span> {{ __('the first application filed, disclose all prior fee applications:') }}</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Date Filed') }}"
            inputFieldName="Date Filed 1"
            inputValue="">
        </x-officialForm.labelInputVertical>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent=""
                inputFieldName="Date Filed 2"
                inputValue="">
            </x-officialForm.labelInputVertical>
        </div>
    </div>
    <div class="col-md-3">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Period Covered') }}"
            inputFieldName="Period Covered 1"
            inputValue="">
        </x-officialForm.labelInputVertical>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent=""
                inputFieldName="Period Covered 2"
                inputValue="">
            </x-officialForm.labelInputVertical>
        </div>
    </div>
    <div class="col-md-3">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Total Requested (Fees & Expenses)') }}"
            inputFieldName="Fees  Expenses 1"
            inputValue="">
        </x-officialForm.labelInputVertical>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent=""
                inputFieldName="Fees  Expenses 2"
                inputValue="">
            </x-officialForm.labelInputVertical>
        </div>
    </div>
    <div class="col-md-3">
        <x-officialForm.labelInputVertical
            labelContent="{{ __('Total Allowed (Fees & Expenses)') }}"
            inputFieldName="Fees  Expenses 1_2"
            inputValue="">
        </x-officialForm.labelInputVertical>
        <div class="mt-1">
            <x-officialForm.labelInputVertical
                labelContent=""
                inputFieldName="Fees  Expenses 2_2"
                inputValue="">
            </x-officialForm.labelInputVertical>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }}"
            dateNameField="Dated"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
   
    <div class="col-md-6 mt-4 pl-4">
    <x-officialForm.debtorSignVertical
            labelContent="{{ __('Applicant') }}"
            inputFieldName="Applicant"
            inputValue=""
        ></x-officialForm.debtorSignVertical>
    </div>
</div>