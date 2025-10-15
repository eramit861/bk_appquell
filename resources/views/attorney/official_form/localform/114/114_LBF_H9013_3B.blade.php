<div class="row">

    <div class="col-md-6 border_1px p-3 br-0">
        <label class="text_italic">{{ __('Filer’s Name, Address, Phone, Fax, Email:') }}</label>
        <textarea name="<?php echo base64_encode('Name1');?>" class="form-control " rows="9">{{$attorney_name}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorneyFax}}
{{$attorney_email}}</textarea>
    </div>
    <div class="col-md-6 border_1px p-3 text-center bb-0 bt-0 br-0">
        <img src="{{ asset('assets/img/114_court_logo.png')}}" class="verification-master" alt="logo" />
    </div>

    <div class="col-md-6 border_1px p-3 br-0 bt-0">
        <p class="text-center mb-0">
            <span class="text-bold">{{ __('UNITED STATES BANKRUPTCY COURT
            DISTRICT OF HAWAII') }}</span><br>
            {{ __('1132 Bishop Street, Suite 250, Honolulu, Hawaii 96813') }}
        </p>
    </div>
    <div class="col-md-6 border_1px p-3 text-center bt-0 br-0">
    </div>

    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <label class=" text_italic">{{ __('Debtor:') }}</label>
    </div>
    <div class="col-md-4 border_1px p-3 bt-0 br-0 bl-0">
        <textarea name="<?php echo base64_encode('Debtors');?>" class="form-control" rows="3">{{$onlyDebtor}}</textarea>
    </div>
    <div class="col-md-2 border_1px p-3 bt-0 br-0">
        <div>
            <label class=" text_italic">{{ __('Case No.:') }}</label>
        </div>
        <div class="mt-3">
            <label class=" text_italic">{{ __('Related Docket No.:') }}</label>
        </div>
    </div>
    <div class="col-md-4 border_1px p-3 bt-0 bl-0">
        <input name="<?php echo base64_encode('Case No');?>" type="text" class="form-control" value="{{$caseno}}">
        <input name="<?php echo base64_encode('H9013-3BDocket No');?>" type="text" class="form-control mt-1">
    </div>

    <div class="col-md-12 border_1px bt-0 p-3">
        <h3 class="text-center">
            {{ __('CERTIFICATE OF SERVICE') }}
        </h3>
    </div>

    <div class="col-md-9 border_1px bt-0 p-3 br-0">
        <label for="">{{ __('Document(s) served:') }}</label>
        <textarea name="<?php echo base64_encode('H9013-3BDocuments');?>" class="form-control" rows="3"></textarea>
    </div>
    <div class="col-md-3 border_1px bt-0 p-3">
        <label for="">{{ __('Date served:') }}</label>
        <input name="<?php echo base64_encode('H9013-3BDate1');?>" value="{{$currentDate}}" type="text" class="form-control">
    </div>

    <div class="col-md-12 border_1px bt-0 p-3">
        <p class="mb-0">
            <span class="text-bold">{{ __('The undersigned certifies under penalty of perjury that that the following were served the above
            document(s) by first class mail unless noted otherwise and that consent was given to any service by
            fax or electronic means.') }}</span> <span class="text_italic">{{ __('[Enter information as shown in example below, including identification of the client if the
            individual served is an attorney or service agent. CM/ECF Notice of Electronic Filing may be attached to identify parties
            served. The notation “ECF” means that court records indicate service was made using the court’s electronic transmission
            facilities; “HD” means that service was by hand delivery; “7004(h)” means that service on a depository institution was
            made by certified mail addressed to an officer of the institution. Attach continuation sheets as needed.]') }}</span>
        </p>
    </div>

    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <label class="text_italic">{{ __('Example:') }}</label>
        <ul class=" dot_list">
            <li>
                {{ __('Name of person served') }}
            </li>
            <li>
                {{ __('If attorney, name of client') }}
            </li>
            <li>{{ __('Mailing address or
                Email address if served via ECF or
                Fax number if served by fax') }}</li>
        </ul>
    </div>
    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName2');?>" class="form-control" rows="7"></textarea>
    </div>
    <div class="col-md-4 border_1px bt-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName3');?>" class="form-control" rows="7"></textarea>
    </div>

    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName4');?>" class="form-control" rows="7"></textarea>
    </div>
    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName5');?>" class="form-control" rows="7"></textarea>
    </div>
    <div class="col-md-4 border_1px bt-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName6');?>" class="form-control" rows="7"></textarea>
    </div>

    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName7');?>" class="form-control" rows="7"></textarea>
    </div>
    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3B');?>" class="form-control" rows="7"></textarea>
    </div>
    <div class="col-md-4 border_1px bt-0 p-3">
        <textarea name="<?php echo base64_encode('H9013-3BName9');?>" class="form-control" rows="7"></textarea>
    </div>

    <div class="col-md-4 border_1px bt-0 br-0 p-3">
        <label class="text_italic">{{ __('Dated:') }}</label>
        <input name="<?php echo base64_encode('H9013-3BDate2');?>" type="text" value="{{$currentDate}}" class="form-control w-auto date_filed" placeholder="{{ __('MM/DD/YYYY') }}">
    </div>
    <div class="col-md-8 border_1px bt-0 p-3">
        <input name="<?php echo base64_encode('H9013-3BName');?>" type="text" value="{{$attorney_name}}" class="form-control">
        <label class="text_italic">{{ __('[Print name and sign]') }}</label>
    </div>

</div>