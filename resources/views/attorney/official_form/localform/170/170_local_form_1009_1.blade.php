<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text16"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text17"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('SUMMARY OF AMENDMENTS TO VOLUNTARY PETITION,') }}<br>{{ __('LISTS, SCHEDULES AND STATEMENTS') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="pl-4 w-100">
                <p class="mb-2">{{ __('Attached to this form are the following amended documents:') }}</p>  
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C1');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Petition') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C2');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule A/B') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C3');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule C') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C4');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule D') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C5');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule E/F') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C6');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule G') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C7');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule H') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C8');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule I') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C9');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule J') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C10');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Schedule J-2') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C11');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Summary of assets and liabilities and certain statistical information (note that this Summary MUST BE submitted with any amended schedule)') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C12');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Statement of financial affairs') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C13');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Statement of intention') }}
                </p>
                <p class="">
                    <input type="checkbox" name="<?php echo base64_encode('C14');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Statement of current monthly income/means test calculation') }}
                </p>
                <p class="mb-1">
                    <input type="checkbox" name="<?php echo base64_encode('C15');?>" value="Yes" class=" form-control w-auto height_fit_content">
                    {{ __('Other (specify):') }}
                </p>
                <div class="pl-5">
                    <textarea name="<?php echo base64_encode('Text2');?>" id="" class="form-control" rows="3"></textarea>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="pl-4 w-100">
                <p class="mb-2">{{ __('For each amended document attached, clearly identify all changes (additions and
                    deletions) to the amended document when compared with the original or most
                    recent amendment:') }}</p>  
                <div class="">
                    <textarea name="<?php echo base64_encode('Text1');?>" id="" class="form-control" rows="10"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>