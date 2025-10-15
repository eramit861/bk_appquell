<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF UTAH') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text120');?>" class=" form-control" rows="2" style="padding-right:5px;">{{$debtorname}}</textarea>
        </div>
        <p class="text-center">
            {{ __('Debtor(s)') }} 
        </p>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text94"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text95"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>    
        <div class="mt-3">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label>{{ __('Trustee') }}</label>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text96');?>" type="text" value="" class="form-control">
                </div>
            </div>
        </div>    
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="">
            {{ __('AMENDMENT DECLARATION') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('Please circle or underline amended material when appropriate:') }}</p>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="mb-1">{{ __('PETITION-REOPENING: Yes or No CONVERSION (13 to 7): Yes or No') }}</p>
                <p class="mb-1 text-bold">{{ __('When changing debtor’s address, please file a separate change of address form.') }}</p>
                <p class="text-bold">{{ __('When amending schedules, please circle or underline the changes/additions.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="mb-1">
                    SCHEDULES:
                    <span class="pl-4"></span> A/B
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box97');?>" value="Yes">
                    <span class="pl-4"></span>
                    C
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box98');?>" value="Yes">
                    <span class="pl-4"></span>
                     D
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box99');?>" value="Yes">
                    <span class="pl-4"></span>
                     E/F
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box100');?>" value="Yes">
                    <span class="pl-4"></span>
                     G
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box101');?>" value="Yes">
                    <span class="pl-4"></span>
                     H
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box102');?>" value="Yes">
                    <span class="pl-4"></span>
                     I
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box103');?>" value="Yes">
                    <span class="pl-4"></span>
                     J
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box104');?>" value="Yes">
                    <span class="pl-4"></span>                     
                </p>
                <p class="mb-0">
                    {{ __('Are you changing the address, amounts, etc., or adding a creditor?') }}
                </p>
                <p class="text-bold">Changing
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box105');?>" value="Yes">
                    {{ __('Adding') }}
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box106');?>" value="Yes">
                    {{ __('($32 amendment fee required for D, E/F; OR ___ IFP Waiver)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="">
                {{ __('AMENDED AMOUNTS/TOTAL OF SCHEDULES') }}:
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box107');?>" value="Yes">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="">
                {{ __('STATEMENT OF AFFAIRS') }}:
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box108');?>" value="Yes">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="">
                {{ __('AMENDED CHAPTER 13 PLAN') }}:
                    <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box109');?>" value="Yes">
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <p>
        {{ __('If you have amended schedules D, E/F by adding a creditor or modifying the schedule, you owe $32.00 amendment
            fee.') }} <span class="text-bold">{{ __('If adding a listed creditor’s attorney, no fee is necessary.') }}</span>
        </p>
        <p class="text-bold">
            {{ __('It is the debtor’s responsibility to notify additional creditors by sending a 341 notice and/or Discharge Order
            to the creditors added to the schedules/matrix.') }}
        </p>
        <p>{{ __('A certificate of mailing to creditors should be filed with the Clerk’s office (see below).') }}</p>
    </div>
    
    <div class="col-md-12 p-3 border_1px">
        <p class="text-bold">
            {{ __('I declare under penalty of perjury that the information provided in this attached amendment is true and correct.') }}
        </p>
        <div class="row">
            <div class="col-md-4">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent=" Debtor "
                    inputFieldName="Text113"
                    inputValue="{{$debtor_sign}}"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-2">
                <x-officialForm.dateSingle
                    labelText="Date"
                    dateNameField="Text114"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingle>
            </div>
            <div class="col-md-4">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent=" Debtor "
                    inputFieldName="Text115"
                    inputValue="{{$debtor2_sign}}"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-2">
                <x-officialForm.dateSingle
                    labelText="Date"
                    dateNameField="Text116"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingle>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>
        {{ __("U.S. Trustee’s Office and Trustee in the case have received notice of electronic filing of amendment(s)?") }} {{ __('Yes') }}
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box118');?>" value="Yes">
            {{ __('No') }}
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box119');?>" value="Yes"> 
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="ATTORNEY FOR DEBTOR(S)"
            inputFieldName="Text117"
            inputValue="{{$attorney_name}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-12 border_top_1px pt-3 mt-3">
        <h3 class="text-center">{{ __('CERTIFICATE OF MAILING') }}</h3>
        <p>
            {{ __('I hereby certify that a true and correct copy of the foregoing was mailed, postage prepaid, to creditors of this estate
            as follows (please mark the appropriate lines(s):') }}   
        </p>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box110');?>" value="Yes">
            </div>
            <div class="w-100 pl-4">
                <p class="">
                    {{ __('341 Notice to creditors added by this amendment.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box111');?>" value="Yes">
            </div>
            <div class="w-100 pl-4">
                <p class="">
                    {{ __('Discharge Notice to creditors added by this amendment.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box112');?>" value="Yes">
            </div>
            <div class="w-100 pl-4">
                <p class="">
                    {{ __('Amended Chapter 13 Plan to all creditors.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Dated"
            dateNameField="Text121"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="ATTORNEY FOR DEBTOR(S)"
            inputFieldName="Text122"
            inputValue="{{$attorney_name}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
</div>