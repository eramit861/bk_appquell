<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF TENNESSEE') }}</h3>
    </div>

    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('DEBTOR/CREDITOR') }}<br>{{ __('CHANGE OF ADDRESS FORM') }}<br>{{ __('(OR OTHER STATISTICAL INFORMATION)') }}</h3>
    </div>

    <div class="col-md-3 p-2">
        <label class="text-bold">{{ __('DEBTOR(S) NAME:') }}</label>
    </div>
    <div class="col-md-6">
        <input type="text" class="form-control" name="<?php echo base64_encode('DEBTORS NAME'); ?>" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-3">
    </div>

    <div class="col-md-3 mt-1 p-2">
        <label class="text-bold">{{ __('Bankruptcy Case Number:') }}</label>
    </div>
    <div class="col-md-6 mt-1">
        <input type="text" class="form-control" name="<?php echo base64_encode('Bankruptcy Case Number'); ?>" value="{{$caseno}}">
    </div>
    <div class="col-md-3 mt-1">
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('THIS ADDRESS CHANGE IS FOR (CHECK ONE)') }} (<input type="checkbox" class="form-control width_auto mr-1" name="<?php echo base64_encode('CB1'); ?>" value="Yes" checked="true">) DEBTOR (
            <input type="checkbox" class="form-control width_auto mr-1" name="<?php echo base64_encode('CB2'); ?>" value="Yes">) CREDITOR (
            <input type="checkbox" class="form-control width_auto mr-1" name="<?php echo base64_encode('CB3'); ?>" value="Yes">{{ __(') PARTY') }}
        </p>
    </div>
    <div class="col-md-12 p-3">
        <div class="row border_1px p-3">
            <div class="col-md-12 p_justify">
                <p>{{ __('To ensure that all address changes are accurate and current, you will need to supply the Court
                    with your old and new address.') }}</p>
            </div>

            <div class="col-md-12">
                <p>
                {{ __('NEW ADDRESS effective as of') }}
                    <input type="text" name="<?php echo base64_encode('NEW ADDRESS effective as of'); ?>"  class="form-control width_auto ml-3">
                    <input type="text" name="<?php echo base64_encode('undefined'); ?>" class="form-control width_auto">
                    <input type="text" name="<?php echo base64_encode('undefined_2'); ?>"  class="form-control width_auto">
                </p>
            </div>

            <div class="col-md-3 mt-1 p-2">
                <label class="text-bold float_right">{{ __('NAME:') }}</label>
            </div>
            <div class="col-md-6 mt-1">
                <input type="text" class="form-control" name="<?php echo base64_encode('NAME'); ?>" value="">
            </div>
            <div class="col-md-3 mt-1">
            </div>
            
            <div class="col-md-3 mt-1 p-2">
                <label class="text-bold float_right">{{ __('ADDRESS:') }}</label>
            </div>
            <div class="col-md-6 mt-1">
                <input type="text" class="form-control" name="<?php echo base64_encode('ADDRESS 1'); ?>" value="">
                <input type="text" name="<?php echo base64_encode('ADDRESS 2'); ?>"  class="form-control mt-1" value="">
                <input type="text" name="<?php echo base64_encode('ADDRESS 3'); ?>" class="form-control mt-1" value="">
            </div>
            <div class="col-md-3 mt-1">
            </div>

            <div class="col-md-3 mt-1 p-2">
                <label class="float_right">{{ __('County:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input type="text" class="form-control" name="<?php echo base64_encode('County'); ?>" value="">
            </div>
            <div class="col-md-2 mt-1 p-2">
                <label class="float_right">{{ __('Phone Number:') }}</label>
            </div>
            <div class="col-md-3 mt-1">
                <input type="text" class="form-control" name="<?php echo base64_encode('Phone Number'); ?>" value="">
            </div>
            <div class="col-md-1 mt-1"></div>

            <div class="col-md-12 text-bold mt-3">
                <p>
                    {{ __('OLD ADDRESS:') }}
                </p>
            </div>

            <div class="col-md-3 mt-1 p-2">
                <label class="text-bold float_right">{{ __('NAME:') }}</label>
            </div>
            <div class="col-md-6 mt-1">
                <input type="text" class="form-control" name="<?php echo base64_encode('NAME_2'); ?>" value="{{$onlyDebtor}}">
            </div>
            <div class="col-md-3 mt-1">
            </div>
            
            <div class="col-md-3 mt-1 p-2">
                <label class="text-bold float_right">{{ __('ADDRESS:') }}</label>
            </div>
            <div class="col-md-6 mt-1">
                <input type="text" class="form-control" name="<?php echo base64_encode('ADDRESS 1_2'); ?>" value="{{$debtoraddress}}">
                <input type="text" name="<?php echo base64_encode('ADDRESS 2_2'); ?>" class="form-control mt-1" value="">
                <input type="text" name="<?php echo base64_encode('ADDRESS 3_2'); ?>" class="form-control mt-1" value="{{$debtorCity}} {{$debtorState}}, {{$debtorzip}}">
            </div>
            <div class="col-md-3 mt-1">
            </div>

            <div class="col-md-6 mt-3">
                <label class="text-bold">{{ __('ADDITIONAL REVISIONS OR COMMENTS:') }}</label>
                <input type="text" class="form-control" name="<?php echo base64_encode('ADDITIONAL REVISIONS OR COMMENTS 1'); ?>" value="">
                <input type="text" name="<?php echo base64_encode('ADDITIONAL REVISIONS OR COMMENTS 2'); ?>" class="form-control mt-1" value="">
                <input type="text" name="<?php echo base64_encode('ADDITIONAL REVISIONS OR COMMENTS 3'); ?>" class="form-control mt-1" value="">
            </div>
            <div class="col-md-6 mt-3"></div>

            <div class="col-md-6 mt-3"></div>
            <div class="col-md-6 mt-3 text-bold">
                <x-officialForm.signVertical
                    labelText="Signature"
                    signNameField="Signature"
                    sign="{{$attorny_sign}}"
                ></x-officialForm.signVertical>
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="DATE"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal> 
            </div>
        </div>
    </div>
    
</div>