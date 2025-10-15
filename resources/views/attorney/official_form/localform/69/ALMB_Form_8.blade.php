<div>
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF ALABAMA') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text2"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
                labelText="CASE NO."
                casenoNameField="Case Number"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="col-md-12 mt-20">
            <div class="text-center">
                <h3>{{ __('CORPORATE PARENT DISCLOSURE STATEMENT') }}</h3>
            </div>
            <div class="mt-20">
                <p><label class="pl-4 ">&nbsp;</label>{{ __('Pursuant to Bankruptcy Rule 1007(a) or Bankruptcy Rule 7007.1,') }}
                <input name="<?php echo base64_encode('Corp Name'); ?>" type="text" value="" class="form-control width_30percent">{{ __(', a (check one)') }}</p>
            </div>
            <div class="mt-20">
                <p>{{ __('(Name of Corporation)') }}</p>
                <div class="form-check">
                <p><label class="pl-4 ">&nbsp;</label>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('Type'); ?>" value="Choice1">
                    {{ __('Corporate Debtor') }}</p>
                </div>
                <div class="form-check">
                    <p><label class="pl-4 ">&nbsp;</label>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('Type'); ?>" value="Choice2">
                    {{ __('Party to an adversary proceeding') }}</p>
                </div>
                <div class="form-check">
                    <p><label class="pl-4 ">&nbsp;</label>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('Type'); ?>" value="Choice3">
                    {{ __('Member of committee of creditors') }}</p>
                </div> 
                <div class="form-check">
                    <p><label class="pl-4 ">&nbsp;</label>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('Type'); ?>" value="Choice4">
                    {{ __('Member of committee of creditors') }}</p>
                </div> 
                <div class="mt-20">
                    <p>{{ __('makes the following disclosure(s):') }}</p>
                </div>
                <div class="mt-3">
                    <div class="form-check pl-4">
                        <p>
                        <input type="radio" class="form-check-input" name="<?php echo base64_encode('Disclosure'); ?>" value="Choice1">
                        {{ __('All corporations, other than a governmental unit, 
                        that directly or indirectly own ten percent (10%) or more of any class of the corporation’s equity interests, are listed below:') }}</p>
                        <textarea name="<?php echo base64_encode('Ownership'); ?>" class="form-control"  rows="3"></textarea>
                        <p>{{ __('OR') }}</p>
                    </div> 
                    <div class="mt-3 pl-4">
                        <input type="radio" class="form-check-input" name="<?php echo base64_encode('Disclosure'); ?>" value="Choice2">
                        {{ __('There are no corporate entities that directly or indirectly own 10% or more of any class of the corporation’s equity interest.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-6"></div>
        <div class="col-md-6 pl-0">
            <input name="<?php echo base64_encode('Signature'); ?>" type="text" value="{{$attorny_sign}}" class="form-control">
        </div>
        <div class="col-md-6">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Date1_af_date"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div> 
        <div class="col-md-6 pl-0">
            <div class="mt-1">
                 <input name="<?php echo base64_encode('Attorney Name'); ?>" type="text" value="{{$attorney_name}}" class="form-control">
            </div>
            <div class="row">
                <div class="col-md-4 mt-1 p-2 pl-3">
                    <label class="mt-2">{{ __('Address:') }}</label>
                </div>
                <div class="col-md-8 mt-1">
                    <textarea class="form-control" name="<?php echo base64_encode('Address'); ?>" id="" cols="" rows="3">{{$attonryAddress1}}    
{{$attonryAddress2}}
{{$attorney_city}}, {{$attorney_state}}, {{$attorney_zip}}</textarea>            
                </div>
            </div>
            <div class="mt-1 pl-2">
                <x-officialForm.debtorSignVertical
                labelContent="Phone:"
                inputFieldName="Phone Number"
                inputValue="{{$attorneyPhone}}"
                ></x-officialForm.debtorSignVertical>
            </div>
            <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Email:"
                inputFieldName="TextBox0"
                inputValue="{{$attorney_email}}"
            ></x-officialForm.debtorSignVertical>
            </div>
        </div>   
    </div>
</div>

