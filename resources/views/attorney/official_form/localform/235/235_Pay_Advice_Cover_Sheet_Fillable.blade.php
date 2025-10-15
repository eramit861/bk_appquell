<div class="row">

    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Names of Debtor(s)"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="TextBox0"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mb-3 mt-3">
        <h3 class="text-center">{{ __('PAY ADVICE COVER SHEET') }}</h3>
    </div>

    <div class="col-md-12">
        <p>
            <span class="pl-4"></span>
            {{ __('The following pay advice/income record information is filed on behalf of the debtors:') }}
        </p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Pay Advice Attached');?>" value="Yes">
            </div>
            <div class="w-100">
                <p>{{ __('Pay advices are attached as follows:') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <label for="">{{ __('Employer') }}</label>
        <input name="<?php echo base64_encode('Employer 1'); ?>" type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode('Beginning Date 1'); ?>" type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode('Ending Date 1'); ?>" type="text" value="" class="form-control mt-1">
    </div>
    <div class="col-md-3">
        <label for="">{{ __('Beginning Date') }}</label>
        <input name="<?php echo base64_encode('Employer 2'); ?>" type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode('Beginning Date 2'); ?>" type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode('Ending Date 2'); ?>" type="text" value="" class="form-control mt-1">
    </div>
    <div class="col-md-3">
        <label for="">{{ __('Ending Date') }}</label>
        <input name="<?php echo base64_encode('Employer 3'); ?>" type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode('Beginning Date 3'); ?>" type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode('Ending Date 3'); ?>" type="text" value="" class="form-control mt-1">
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check No Records');?>" value="Yes">
            </div>
            <div class="w-100">
                <p>{{ __('The debtor certifies by his/her signature below that he/she has no pay records because:') }}</p>
            </div>
        </div>
        <textarea name="<?php echo base64_encode('Reason No Pay Records'); ?>" id="" class=" form-control" rows="5"></textarea>
        <p>
            <span class="pl-4"></span>
            {{ __('Dated on the') }} 
            <input type="text" name="<?php echo base64_encode('Date'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Month'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Year'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>

    
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="(Debtor Signature)"
            inputFieldName="Debtor Signature"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="d-flex mt-2">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Pro Se Check');?>" value="Yes">
            </div>
            <div class="w-100">
                <p class="mb-0">{{ __('Pro se Debtor') }}</p>
            </div>
        </div>
        <div class="d-flex mt-1">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Represented Check');?>" value="Yes">
            </div>
            <div class="w-100">
                <p>{{ __('Represented by Counsel') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6 pt-2">
        <label class="float_right">s/</label>
    </div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('Attorney Signature'); ?>" value="{{$attorny_sign}}" class="form-control date_filled ">
        <div class="row mt-1">
            <div class="col-md-8 pr-0">
                <input type="text" name="<?php echo base64_encode('Attorney Printed Name'); ?>" value="" class="form-control">
            </div>
            <div class="col-md-4">
                <input type="text" name="<?php echo base64_encode('Attorney Bar No'); ?>" value="" class="form-control">
            </div>
        </div>
        <input type="text" name="<?php echo base64_encode('Attorney Address, City, State, Zip'); ?>" value="" class="form-control mt-1">
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Telephone Number"
                inputFieldName="Attorney Phone No"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Fax Number"
                inputFieldName="Attorney Fax No"
                inputValue="{{$attorneyFax}}"
            ></x-officialForm.debtorSignVertical>
        </div>        
        <input type="text" name="<?php echo base64_encode('Attorney Email'); ?>" value="" class="form-control mt-1">
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Counsel for"
                inputFieldName="Representing"
                inputValue="{{$onlyDebtor}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>


</div>