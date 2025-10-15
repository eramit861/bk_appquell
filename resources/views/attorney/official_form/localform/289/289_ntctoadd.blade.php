<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
        {{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF VIRGINIA') }}<br>
            <input type="text" name="<?php echo base64_encode('DIV'); ?>" class="form-control w-auto mr-1">
            {{ __('Division') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re') }}</label>
        <input type="text" name="<?php echo base64_encode('DEBTOR NAME1'); ?>" class="form-control" value="{{$onlyDebtor}}">
        <div class="text-center">
            <input type="text" name="<?php echo base64_encode('DEBTOR NAME2'); ?>" class="form-control mt-1" value="{{$spousename}}">
            <label>{{ __('Debtor(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="CASENO"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="CHP"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 border_1px p-3 bt-0">
        <div class="row">
            <div class="col-md-1">
                <label class="text-bold">TO:</label>
            </div>
            <div class="col-md-11">
                <input type="text" name="<?php echo base64_encode('CRED NAME1'); ?>" class="form-control">
                <input type="text" name="<?php echo base64_encode('CRED NAME2'); ?>" class="form-control mt-1">
                <input type="text" name="<?php echo base64_encode('CRED NAME3'); ?>" class="form-control mt-1">
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">{{ __('NOTICE TO') }}<br>{{ __('CREDITOR(S) (RE AMENDMENT)') }}</h3>
    </div>
    
    <div class="col-md-12">
        <p>
            <span class="ml-4"></span>
            {{ __('NOTICE IS HEREBY GIVEN that an amendment to the above-captioned debtor’s schedules and/or list of
            creditors has been filed') }}
        </p>
    </div>

    <div class="col-md-5"></div>
    <div class="col-md-7">
        <p>
            <input type="checkbox" name="<?php echo base64_encode('add1'); ?>" value="Yes" class="form-control height_fit_content w-auto">
            {{ __('adding you as a creditor,') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('del1'); ?>" value="Yes" class="form-control height_fit_content w-auto">
            {{ __('deleting you as a creditor,') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('corr1'); ?>" value="Yes" class="form-control height_fit_content w-auto">
            {{ __('correcting your address') }}
        </p>
    </div>

    <div class="col-md-12">
        <p>{{ __('A copy of the amendment is forwarded to you together with this notice.') }}</p>
        <p>
            <span class="ml-4 text-bold text_italic">
                {{ __('[If amendment is adding creditor(s)]') }}
            </span>
            {{ __('NOTICE IS FURTHER GIVEN that also forwarded to you together
            with this notice is a copy of the notice of the meeting of creditors called by the United States Trustee pursuant to
            Federal Rule of Bankruptcy Procedure 2003, giving the particulars of the case and stating the last date for the filing
            of claims') }} 
            <span class="text_italic">
                {{ __('(if any was given)') }}
            </span>
            , {{ __('for filing complaints objecting to the discharge and complaints to determine the
            dischargeability of certain debts; a copy of the discharge of the debtor') }}, 
            <span class="text_italic">
            {{ __('if one has been entered') }}
            </span>
            , {{ __('a subsequent notice
            to file claims') }}, 
            <span class="text_italic">
            {{ __('if one has been issued') }}
            </span>
            {{ __(', and any other filed document affecting the rights of the added creditor(s).') }}
        </p>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="DTE"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <div class="row">
            <div class="col-md-1">
                <label for=""></label>
            </div>
            <div class="col-md-11">
                <input type="text" name="<?php echo base64_encode('DEBTOR NAME1'); ?>" class="form-control mt-1" value="{{$onlyDebtor}}">
            </div>
            <div class="col-md-1">
                <label for=""></label>
            </div>
            <div class="col-md-11">
                <input type="text" name="<?php echo base64_encode('DEBTOR NAME2'); ?>" class="form-control mt-1" value="{{$spousename}}">
            </div>
            <div class="col-md-1 p-2">
                <label class="pl-2">By</label>
            </div>
            <div class="col-md-11">
                <input type="text" name="<?php echo base64_encode('ATTYSIG'); ?>" class="form-control mt-1">
            </div>
            <div class="col-md-12 mt-2">
                <label class="">{{ __('Attorney for Debtor:') }}</label>
            </div>
            <div class="col-md-4 p-2">
                <label class="pl-2">{{ __('State Bar No.:') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('VA BAR#'); ?>" class="form-control mt-1" value="{{$attorney_state_bar_no}}">
            </div>
            <div class="col-md-4 p-2">
                <label class="pl-2">{{ __('Address:') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('ATTY ADDR1'); ?>" class="form-control mt-1" value="{{$attonryAddress1}}">
                <input type="text" name="<?php echo base64_encode('ATTY ADDR2'); ?>" class="form-control mt-1" value="<?php echo $attorney_city.', '.$attorney_state.', '.$attorney_zip ?>">
            </div>
            <div class="col-md-4 p-2">
                <label class="pl-2">{{ __('Telephone No.:') }}</label>
            </div>
            <div class="col-md-8">
                <input type="text" name="<?php echo base64_encode('PH#'); ?>" class="form-control mt-1" value="{{$attorneyPhone}}">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('CERTIFICATION') }}</h3>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('I certify that on') }} 
            <input type="text" name="<?php echo base64_encode('DTE2'); ?>" value="{{$attorneyDate}}" class="form-control w-auto date_filed ">
            {{ __(', I served a copy of the foregoing notice on the
            United States Trustee, any appointed trustee, and any and all entities affected by the amendment pursuant to Local
            Bankruptcy Rule 1009-1(A).') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('ATTYSIG'); ?>"  type="text" value="{{$attorny_sign}}" class="form-control">
            <label>{{ __('Attorney for Debtor [or') }} <span class="text_italic">{{ __('Pro Se') }}</span> {{ __('Debtor]') }}</label>
        </div>
    </div>

</div>