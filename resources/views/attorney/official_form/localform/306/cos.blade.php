<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE SOUTHERN DISTRICT OF WEST VIRGINIA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <div class="row">
            <div class="col-md-1">
                <label for="">{{ __('IN') }}&nbsp;{{ __('RE:') }}</label>
            </div>
            <div class="col-md-11">
                <textarea name="<?php echo base64_encode('Text19');?>" class="form-control" rows="4"><?php echo $debtorname ?? ''; ?></textarea>
                <div class="row mt-2">
                    <div class="col-md-2">
                        <label for="">{{ __('Debtor(s).') }}</label>
                    </div>
                    <div class="col-md-10">
                        <textarea name="<?php echo base64_encode('Text21');?>" class="form-control" rows="3"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
                labelText="Case Number"
                casenoNameField="Text20"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CERTIFICATE OF SERVICE') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify">
            <span class="pl-4"></span>
            {{ __('I, the Debtor(s) in this case, certify that I served the both the attached motion and notice upon
            the following parties at the addresses listed, by mailing true copies of these documents by U.S. Mail,
            first class, postage prepaid, on the') }} 
            <input type="text" name="<?php echo base64_encode('Text22');?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Text23');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('TextBox0');?>" value="{{$currentYearShort}}" class="form-control width_5percent">.
        </p>
    </div>

    <div class="col-md-1 p-2">
        <label class="float_right">1.</label>
    </div>
    <div class="col-md-6">
        <textarea name="<?php echo base64_encode('Text24');?>" class="form-control" rows="4"></textarea>
    </div>
    <div class="col-md-5"></div>
    
    <div class="col-md-1 mt-2 p-2">
        <label class="float_right">2.</label>
    </div>
    <div class="col-md-6 mt-2">
        <textarea name="<?php echo base64_encode('Text25');?>" class="form-control" rows="4"></textarea>
    </div>
    <div class="col-md-5 mt-2"></div>
    
    <div class="col-md-1 mt-2 p-2">
        <label class="float_right">3.</label>
    </div>
    <div class="col-md-6 mt-2">
        <textarea name="<?php echo base64_encode('Text26');?>" class="form-control" rows="4"></textarea>
    </div>
    <div class="col-md-5 mt-2"></div>
    
    <div class="col-md-1 mt-2 p-2">
        <label class="float_right">4.</label>
    </div>
    <div class="col-md-6 mt-2">
        <textarea name="<?php echo base64_encode('Text27');?>" class="form-control" rows="4"></textarea>
    </div>
    <div class="col-md-5 mt-2"></div>

    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3 text-center">
        <div>
            <x-officialForm.signVertical
                labelText="Debtor"
                signNameField="Text28"
                sign={{$onlyDebtor}}
            ></x-officialForm.signVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.signVertical
                labelText="Joint Debtor"
                signNameField="Text29"
                sign={{$spousename}}
            ></x-officialForm.signVertical>
        </div>
    </div>
</div>