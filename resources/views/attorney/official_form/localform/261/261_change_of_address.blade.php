<div class="row">

    <div class="col-md-12 text-center mb-3">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE EASTERN DISTRICT OF TEXAS') }}<br>
            <select name="<?php echo base64_encode('Location'); ?>" class="w-auto form-control mr-2">
                <option value="Choose Your Division">{{ __('Choose Your Division') }}</option>
                <option value="Beaumont">{{ __('Beaumont') }}</option>
                <option value="Lufkin">{{ __('Lufkin') }}</option>
                <option value="Marshall">{{ __('Marshall') }}</option>
                <option value="Sherman">{{ __('Sherman') }}</option>
                <option value="Texarkana">{{ __('Texarkana') }}</option>
                <option value="Tyler">{{ __('Tyler') }}</option>
            </select>
            {{ __('DIVISION') }}
        </h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <input type="text" name="<?php echo base64_encode('Debt2'); ?>" value="{{$debtorname ?? ''}}" class="form-control mt-1">
            <label>{{ __('DEBTOR(S)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="CASE NO"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            I am a 
            <select name="<?php echo base64_encode('RoleDropDown'); ?>" class="w-auto form-control mr-2 ml-1">
                <option value="Choose your role">{{ __('Choose Your role') }}</option>
                <option value="Creditor">{{ __('Creditor') }}</option>
                <option selected value="Debtor">{{ __('Debtor') }}</option>
            </select>
             {{ __('in the above referenced bankruptcy case.') }}
        </p>
    </div>

    <div class="col-md-4 p-2 pl-3">
        <label for="">My <span class="text-bold">{{ __('PREVIOUS') }}</span> {{ __('address is:') }}</label>
    </div>
    <div class="col-md-8">
        <input type="text" name="<?php echo base64_encode('My PREVIOUS address is 1'); ?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('My PREVIOUS address is 2'); ?>" value="{{$address ?? ''}}" class="form-control mt-1">
    </div>

    
    <div class="col-md-4 mt-3 p-2 pl-3">
        <label for="">Please <span class="text-bold">{{ __('CHANGE') }}</span> {{ __('to the new address:') }}</label>
    </div>
    <div class="col-md-8 mt-3">
        <input type="text" name="<?php echo base64_encode('Please CHANGE  to the new address 1'); ?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('Please CHANGE  to the new address 2'); ?>" class="form-control mt-1">
    </div>

    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATE:"
            dateNameField="DATE"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-4 p-2 pl-3">
        <label for="">{{ __('DEBTOR SIGNATURE:') }}</label>
    </div>
    <div class="col-md-5">
        <input type="text" name="<?php echo base64_encode(''); ?>" value="{{$debtor_sign ?? ''}}" class="form-control bg-none" disabled>
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-4 p-2 pl-3">
        <label for="">{{ __('JOINT DEBTOR SIGNATURE') }}:<br>{{ __('(If filed by Debtor)') }}</label>
    </div>
    <div class="col-md-5">
        <input type="text" name="<?php echo base64_encode(''); ?>" value="{{$debtor2_sign ?? ''}}" class="form-control bg-none" disabled>
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-4 p-2 pl-3">
        <label for="">{{ __('NAME OF CREDITOR:') }}</label>
    </div>
    <div class="col-md-5">
        <input type="text" name="<?php echo base64_encode('undefined'); ?>" class="form-control">
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-4 p-2 pl-3">
        <label for="">{{ __('AUTHORIZED SIGNATURE:') }}</label>
    </div>
    <div class="col-md-5">
        <input type="text" name="<?php echo base64_encode(''); ?>" class="form-control bg-none" disabled>
    </div>
    <div class="col-md-3"></div>

    
    <div class="col-md-4 p-2 pl-3">
        <label for="">TITLE:<br>{{ __('(If filed by Creditor)') }}</label>
    </div>
    <div class="col-md-5 pt-3">
        <input type="text" name="<?php echo base64_encode('AUTHORIZED SIGNATURE 2'); ?>" class="form-control">
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('Mail to: U. S. Bankruptcy Court') }}</h3>
    </div>
    
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('Addr1'); ?>" class="form-control" value="300 Willow, Suite 100">
        <input type="text" name="<?php echo base64_encode('Addr2'); ?>" class="form-control mt-1" value="Beaumont, TX 77701">
</div>
    <div class="col-md-4"></div>

</div>
