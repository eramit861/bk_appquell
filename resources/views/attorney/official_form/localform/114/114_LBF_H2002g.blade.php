<div class="row">

    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text_italic">{{ __('Filer’s Name, Address, Phone, Fax, Email:') }}</label>
        <textarea name="<?php echo base64_encode('Filers Name Address Phone email');?>" class="form-control " rows="9">{{$attorney_name}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorneyFax}}
{{$attorney_email}}</textarea>
    </div>
    <div class="col-md-6 border_1px p-3 text-center bb-0">
        <img src="{{ asset('assets/img/114_court_logo.png')}}" class="verification-master" alt="logo" />
    </div>

    <div class="col-md-6 border_1px p-3 br-0 bt-0">
        <p class="text-center mb-0">
            <span class="text-bold">{{ __('UNITED STATES BANKRUPTCY COURT
            DISTRICT OF HAWAII') }}</span><br>
            {{ __('1132 Bishop Street, Suite 250, Honolulu, Hawaii 96813') }}
        </p>
    </div>
    <div class="col-md-6 border_1px p-3 text-center bt-0">
    </div>

    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-4 border_1px p-3 bt-0 br-0 bl-0">
        <textarea name="<?php echo base64_encode('Debtors');?>" class="form-control" rows="3">{{$debtorname}}</textarea>
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Case No.:') }}</label>
    </div>
    <div class="col-md-4 border_1px p-3 bt-0 bl-0">
        <input name="<?php echo base64_encode('Case No');?>" type="text" class="form-control" value="{{$caseno}}">
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            <span class="underline">{{ __('NOTICE OF CHANGE OF MAILING ADDRESS') }}</span><br>
            <span class="text_italic">{{ __('[See instructions at bottom for correct use of this form.]') }}</span>
        </h3>
        <p class="mt-3">
        {{ __('NOTICE IS GIVEN of the following change of') }} <span class="text-bold">{{ __('mailing address') }}</span>, effective now, or on 
            <input name="<?php echo base64_encode('eff dt');?>" type="text" value="{{$currentDate}}" class="date_filed form-control w-auto">
            .
        </p>
        <p class="">
            <input name="<?php echo base64_encode('Check Box1');?>" value="Yes" type="checkbox" class="form-control w-auto">
            {{ __('This is the address where notices and other documents should be sent to the') }} <span class="text-bold">{{ __('debtor(s)') }}</span>.
        </p>
        <p class="">
            <input name="<?php echo base64_encode('Check Box2');?>" value="Yes" type="checkbox" class="form-control w-auto">
            {{ __('This is the address where notices should be sent to a') }} <span class="text-bold">{{ __('creditor') }}</span> {{ __('or other') }} <span class="text-bold">party in interest</span>{{ __('. (This notice
            must be filed in all pending cases.)') }}
        </p>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text-bold">{{ __('Name and') }} <span class="text_italic">{{ __('OLD') }}</span> {{ __('mailing address:') }}</label>
        <textarea name="<?php echo base64_encode('Name and OLD mailing address');?>" rows="9" class="form-control"></textarea>
    </div>
    <div class="col-md-6 border_1px p-3">
        <label class="text-bold">{{ __('Name and') }} <span class="text_italic">{{ __('NEW') }}</span> {{ __('address:') }}</label>
        <textarea name="<?php echo base64_encode('Name and NEW address');?>" rows="9" class="form-control"></textarea>
    </div>

    <div class="col-md-12">
        <p class=" p_justify mt-3">{{ __('The undersigned declares under penalty of perjury that the information above is true and correct to the best of
            my knowledge.') }}</p>
    </div>
    
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <input name="<?php echo base64_encode('s');?>" type="text" value="{{$attorney_name}}" class="form-control">
        <label for="">{{ __('[Print name and sign]') }}</label>
    </div>

    <div class="col-md-12">
        <ul class=" dot_list">
            <li>{{ __('For a change of a payment or notice address related to a claim, use') }} <span class="text-bold">{{ __('Notice of Change of Address (Proof of Claim)') }}<span></li>
            <li>{{ __('For a change of the creditor’s name for a proof of claim, file a') }} <span class="text-bold">{{ __('Notice of Transfer of Claim') }}</span> {{ __('(fee required)') }}</li>
            <li>{{ __('To add a creditor to a case, file an') }} <span class="text-bold">{{ __('Amended Creditor List') }}</span> {{ __('(fee required)') }}</li>
            <li>{{ __('To correct or change the name of a debtor (e.g., due to marriage or divorce), use') }} <span class="text-bold">{{ __('Debtor’s Notice of Name Change') }}</span></li>
            <li>{{ __('For a change of an attorney’s address or firm affiliation, use') }} <span class="text-bold">{{ __('Attorney’s Notice of Change of Address or Firm Affiliation') }}</span></li>
        </ul>
    </div>

</div>