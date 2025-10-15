<div class="row">
    <div class="col-md-12 mt-3 text-center"> 
        <h3>{{ __('United States Bankruptcy Court') }}<br>{{ __('District of Nevada') }}</h3>
        <p class="mt-3">{{ __('STATEMENT OF RESPONSIBILITY FOR ATTORNEYS WHO ALLOW STAFF TO FILE') }}<br>{{ __('DOCUMENTS ELECTRONICALLY') }}</p>
    </div>

    <div class="col-md-12">
        <p>
            <span class="pl-4"></span>
            {{ __('The following is a statement of responsibility concerning electronic filings in the
            CM/ECF system maintained by the U.S. Bankruptcy Court for the District of Nevada:') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('As the attorney responsible for all filings in my cases, I understand that I have been
            offered the opportunity to grant my staff permission to electronically file as a filing agent using
            my log-in by the U.S. Bankruptcy Court for the District of Nevada. I have allowed my staff to
            receive CM/ECF training and have elected to proceed with electronic filing of documents by my
            staff without the ability to supervise the actual data input. I agree that I will take full
            responsibility and liability for the work of my staff in filing the documents through the CM/ECF
            system. This includes financial responsibility for any loss due to errors or omissions, damages or
            misuse of the system by my staff.') }}
        </p>
    </div>

    <div class="col-md-6"></div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney Signature"
            inputFieldName=""
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <label class="text-c-red">{{ __('*Original signature required, not digital') }}</label>
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Type or print attorney name"
            inputFieldName="Type or print attorney name"
            inputValue={{$attorney_name}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2"></div>

    <div class="col-md-6">
        <label for="">{{ __('Staff Members authorized to use my CM/ECF log-in:') }}</label>
        <input type="text" name="<?php echo base64_encode('Staff Members authorized to use my CMECF login 1');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('Staff Members authorized to use my CMECF login 2');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Staff Members authorized to use my CMECF login 3');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Staff Members authorized to use my CMECF login 4');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Staff Members authorized to use my CMECF login 5');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Staff Members authorized to use my CMECF login 6');?>" class="form-control mt-1">
    </div>
    <div class="col-md-6"></div>
    
</div>