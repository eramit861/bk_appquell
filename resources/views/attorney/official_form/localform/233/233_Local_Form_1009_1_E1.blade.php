<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text2"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3 ">{{ __('VERIFICATION AS TO OFFICIAL CREDITOR LIST') }}</h3>
    </div>

    <div class="col-md-3">
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <span>
                    {{ __('Original Matrix') }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <span>
                    {{ __('Amendment to Matrix') }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <span>
                    {{ __('Adding creditors') }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <span>
                    {{ __('Deleting creditors') }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('I the Debtor named in this case') }}, <span class="text-bold">{{ __('certify under penalty of perjury') }}</span> {{ __('that the master mailing list of
            creditors submitted on the attached creditor list, is a true, correct and complete listing to the best of my
            knowledge of all creditors listed on the schedules filed herein.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('I further acknowledge that (1) the accuracy and completeness in preparing the creditor listing is the
            responsibility of the debtor, (2) the court will rely on the creditor listing for all mailings, and (3) the various
            schedules and statements required by the Bankruptcy Rules are not used for mailing purposes.') }}
        </p>
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                    {{ __('If this filing is the original creditor list, all creditors contained in the schedules are listed. (For
                    verification purposes, a list of the creditors is ATTACHED)') }}
                </p>
            </div>
        </div>
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box9');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                    {{ __('If this filing is an amendment to the creditor list, only the creditors being added or to be deleted
                    are listed. (For verification purposes, a list of the creditors is ATTACHED)') }}
                </p>
            </div>
        </div>
        <div class="d-flex text-bold">
            <div class="pt-2">
                <input type="checkbox" name="<?php echo base64_encode('Check Box10');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                {{ __('If represented by an attorney') }}, 
                    <input type="text" name="<?php echo base64_encode('Text12');?>" value="" class="form-control width_30percent">
                    {{ __('Attorney for the debtor HAS
                    uploaded the creditors listed on the ATTACHED list into the court’s creditor database for this
                    case and have signed below.') }}
                </p>
            </div>
        </div>
        <div class="d-flex text-bold">
            <div class="">
                <input type="checkbox" name="<?php echo base64_encode('Check Box11');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                {{ __('If this filing is an amendment to the creditor list, I certify that a true and correct copy of the
                    Notice of Bankruptcy Case, Meeting of Creditors and Deadlines was mailed to all creditors
                    listed on the attached mailing list for this case on') }}: 
                    <input type="text" name="<?php echo base64_encode('Text13');?>" class="form-control w-auto">
                    {{ __('in compliance with
                    Local Rule 1009-1(E).') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <p class="mb-1 mt-3">
            <input type="text" name="<?php echo base64_encode('Text14');?>" class="form-control w-auto">
            {{ __('# of Creditors on attached list (if Original Matrix)') }}
        </p>
        <p class="mb-1">
            <input type="text" name="<?php echo base64_encode('Text15');?>" class="form-control w-auto">
            {{ __('# of Creditors added (if Amended Matrix)') }}
        </p>
        <p class="">
            <input type="text" name="<?php echo base64_encode('Text16');?>" class="form-control w-auto">
            {{ __('# of Creditors to be deleted (if Amended Matrix)') }}
        </p>
    </div>
    <div class="col-md-3"></div>

    <div class=" col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor Signature"
                inputFieldName="Text18"
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <label for="">{{ __('Address: (if not represented by an attorney)') }}</label>
        <input type="text" class="form-control bg-none" disabled="true">
        <input type="text" class="form-control bg-none" disabled="true">
        <label for="">{{ __('Phone: (if not represented by an attorney)') }}</label>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Attorney"
                inputFieldName="Text19"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Text20');?>" value="{{$attorney_name}}">
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Text21');?>" value="State Bar No.: {{$attorney_state_bar_no}}">
        <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Text22');?>" value="{{$attonryAddress1}}, {{$attonryAddress2}}">
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Name/OBA#/Address/Telephone #/Email"
                inputFieldName="Text23"
                inputValue="{{$attorneyPhone}}, {{$attorney_email}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>        
    <div class=" col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor Signature"
                inputFieldName="Text17"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <label for="">{{ __('Address: (if not represented by an attorney)') }}</label>
        <input type="text" class="form-control bg-none" disabled="true">
        <input type="text" class="form-control bg-none" disabled="true">
        <label for="">{{ __('Phone: (if not represented by an attorney)') }}</label>
    </div>
</div>