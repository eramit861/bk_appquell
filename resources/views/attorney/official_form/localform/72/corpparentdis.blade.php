
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}
            <br>NORTHERN DISTRICT OF ALABAMA<br>
            <select class="form-control w-auto p-1" name="<?php echo base64_encode('Div'); ?>">
                <option value="Eastern" selected="true">{{ __('Eastern') }}</option>
                <option value="Northern">{{ __('Northern') }}</option>
                <option value="Southern">{{ __('Southern') }}</option>
                <option value="Western">{{ __('Western') }}</option>
            </select>
            {{ __('DIVISION') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Debtor"
                debtorname={{$debtorname}}
                rows="3">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
                labelText="CASE NO."
                casenoNameField="caseno"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <div class="text-center">
            <h3>{{ __('CORPORATE PARENT DISCLOSURE STATEMENT') }}</h3>
        </div>
        <div class="mt-3 row">
            <div class="col-md-4">
                <p>
                    {{ __('Pursuant to Bankruptcy Rule 1007(a) or Bankruptcy Rule 7007.1,') }}
                </p>
            </div>
            <div class="col-md-4 text-center">
                <input name="<?php echo base64_encode('Corp'); ?>" type="text" value="" class="form-control">
                <p class="mb-0">{{ __('(Name of Corporation)') }}</p>
            </div>
            <div class="col-md-4">
                <p>{{ __(', a (check one)') }}</p>
            </div>
        </div>
        <div class="mt-3">
            
            <div class="form-check pl-4">
                <p>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('type'); ?>" value="0">
                    {{ __('Corporate Debtor') }}
                </p>
            </div>
            <div class="form-check pl-4">
                <p>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('type'); ?>" value="1">
                    {{ __('Party to an adversary proceeding') }}
                </p>
            </div>
            <div class="form-check pl-4">
                <p>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('type'); ?>" value="2">
                    {{ __('Party to a contested matter') }}
                </p>
            </div> 
            <div class="form-check pl-4">
                <p>
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('type'); ?>" value="3">
                    {{ __('Member of committee of creditors') }}
                </p>
            </div> 
            <div class="mt-2">
                <p>{{ __('makes the following disclosure(s):') }}</p>
            </div>
            <div class="mt-3">
                <div class="form-check">
                <span class="pl-4"></span>{{ __('All corporations, other than a governmental unit, that directly or indirectly own ten
                percent (10%) or more of any class of the corporation’s equity interests, are listed
                below:') }}
                    <input name="<?php echo base64_encode('other'); ?>" type="text" value="" class="form-control h-80 width_90percent">
                    <p  class="mt-3">{{ __('OR') }}</p>
                </div> 
                <div class="mt-3 pl-4">
                    <input type="radio" class="form-check-input" name="<?php echo base64_encode('type'); ?>" value="4">
                    {{ __('There are no entities that directly or indirectly own 10% or more of any
                    class of the corporation’s equity interest.') }}
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div> 
            <div class="col-md-6">
                <div class="d-flex">
                     <span class="mt-2">{{ __('By:') }}&nbsp;</span>
                     <input name="<?php echo base64_encode('sig1'); ?>" type="text" value="" class="form-control">
                </div>
                <div class="d-flex mt-1">
                    <span class="pl-3">&nbsp;</span>
                    <input name="<?php echo base64_encode('sig2'); ?>" type="text" value="" class="form-control">
                </div>
            </div> 
        </div>
    </div>
