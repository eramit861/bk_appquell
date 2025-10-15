<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('FOR THE SOUTHERN DISTRICT OF IOWA') }}</h3>
    </div>
     
    <div class="col-md-6 border_1px br-0 p-3">
        <div class="input-group">
            <label>{{ __('IN RE:') }}</label>
            <textarea name="<?php echo base64_encode('Case Name'); ?>" class="form-control" rows="4"><?php echo $debtorname ?? ''; ?></textarea>
        </div>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 ">
        <x-officialForm.caseNo
            labelText="Bankruptcy Case No."
            casenoNameField="BK Case No"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo> 
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('REQUEST AND NOTICE TO CORRECT SOCIAL SECURITY NUMBER') }}<br>{{ __('AND CERTIFICATE OF SERVICE') }}</h3>
        <p>{{ __('The debtor(s) requests the court correct the social security number as follows:') }}</p>
        <div class="row mt-3">
            <div class="col-md-2 pt-2">
                <label>{{ __('Debtor Name:') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Db Name');?>"  type="text" class="form-control mt-1" value="{{$onlyDebtor}}">
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-1"></div>
            <div class="col-md-3 pt-2">
                <label for="">{{ __('Incorrect Social Security Number:') }}</label>
            </div>
            <div class="col-md-7">
                <input name="<?php echo base64_encode('Incorr SSN');?>"  type="text" class="form-control mt-1">
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-1"></div>
            <div class="col-md-3 pt-2">
                <label for="">{{ __('Correct Social Security Number:') }}</label>
            </div>
            <div class="col-md-7">
                <input name="<?php echo base64_encode('Correct SSN');?>"  type="text" class="form-control mt-1">
            </div>
            <div class="col-md-1"></div>
        </div>

        <div class="row mt-3">
            <div class="col-md-2 pt-2">
                <label>{{ __('Joint Debtor Name:') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Jt Db Name');?>"  type="text" class="form-control mt-1" value="{{$spousename}}">
            </div>
            <div class="col-md-1"></div>
            
            <div class="col-md-1"></div>
            <div class="col-md-3 pt-2">
                <label for="">{{ __('Incorrect Social Security Number:') }}</label>
            </div>
            <div class="col-md-7">
                <input name="<?php echo base64_encode('Incorr SSN2');?>"  type="text" class="form-control mt-1">
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-1"></div>
            <div class="col-md-3 pt-2">
                <label for="">{{ __('Correct Social Security Number:') }}</label>
            </div>
            <div class="col-md-7">
                <input name="<?php echo base64_encode('Correct SSN2');?>"  type="text" class="form-control mt-1">
            </div>
            <div class="col-md-1"></div>
        </div>

    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <div class="pl-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature"
                inputFieldName="Signature"
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1 pl-4">
            <x-officialForm.debtorSignVertical
                labelContent="Name"
                inputFieldName="Name"
                inputValue="{{$attorney_name}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-4">
            <x-officialForm.debtorSignVertical
                labelContent="Address"
                inputFieldName="Address"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}">
            </x-officialForm.debtorSignVertical>
            <input name="<?php echo base64_encode('Address2');?>"  type="text" class="form-control mt-1" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}">
        </div>
        <div class="mt-1 pl-4">
            <x-officialForm.debtorSignVertical
                labelContent="Phone"
                inputFieldName="Phone"
                inputValue="{{$attorneyPhone}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-12">
        <p>{{ __('Note: Certificate of Service showing service upon all creditors is required.') }}</p>
        <p>{{ __('Attachment: Certificate of Service') }}</p>
    </div>

</div>