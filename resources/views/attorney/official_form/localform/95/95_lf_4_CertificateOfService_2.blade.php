<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
            <select name="<?php echo base64_encode('Dropdown1');?>" class="form-control w-auto">
                <option value="GAINSVILLE">{{ __('GAINSVILLE') }}</option>
                <option value="TALLAHASSEE" selected="true">{{ __('TALLAHASSEE') }}</option>
                <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
                <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
            </select>
            {{ __('DIVISION') }}
        </h3> 
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('');?><?php echo base64_encode('Text4');?>" class=" form-control" rows="2" >{{$debtorname}}</textarea>
            <p class="mb-0">{{ __('Debtor Name(s)') }}</p>
            <p class="mb-0">{{ __('Debtor(s)') }}</p>
        </div> 
    </div>
    <div class="col-md-6 border_1px p-3">
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
        <h3 class="text-center mt-3 mb-3">{{ __('CERTIFICATE OF SERVICE') }}</h3>
        <p>
            <span class="pl-4"></span>
            I hereby certify that a true and correct copy of the foregoing
            <input type="text" name="<?php echo base64_encode('Text5');?>" class="form-control width_20percent">
            <input type="text" name="<?php echo base64_encode('Text6');?>" class="form-control width_45percent">
            {{ __('was served as set forth below:') }}
        </p>
        <div class="d-flex">
            <div class="pt-2">
                <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                    <span class="text-bold">{{ __('Served via Notice of Electronic Filing (NEF):') }} </span>
                    {{ __('The undersigned verifies that the foregoing
                    document was served via NEF on') }} 
                    <input type="text" name="<?php echo base64_encode('Text9');?>" class="form-control w-auto">
                    {{ __('to the below-listed person(s) and entities:') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pt-2">
                <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="mb-2">
                    <span class="text-bold">{{ __('Served by U.S. Mail:') }} </span>
                    On
                    <input type="text" name="<?php echo base64_encode('Text10');?>" class="form-control w-auto">
                    {{ __('the undersigned served the person(s) and/or entities
                    listed below via first class mail, postage prepaid, at the addresses listed below or on the
                    attached mailing matrix obtained from the Court’s case management system:') }}
                </p>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box11');?>" value="Yes" class="form-control height_fit_content w-auto">
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('Names and addresses of Parties served:') }}
                        </p>
                    </div>
                </div>
                <p class="mb-2 pl-1">{{ __('OR') }}</p>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box12');?>" value="Yes" class="form-control height_fit_content w-auto">
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('See attached mailing matrix.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="pt-2">
                <input type="checkbox" name="<?php echo base64_encode('Check Box13');?>" value="Yes" class="form-control height_fit_content w-auto">
            </div>
            <div class="pl-4">
                <p class="">
                    <span class="text-bold">{{ __('Served by Personal Delivery, Overnight Mail, Facsimile Transmission or Email:') }} </span>
                    On 
                    <input type="text" name="<?php echo base64_encode('Text14');?>" class="form-control w-auto">
                    {{ __(', the undersigned served each person or entity listed below via the means noted for each:') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <p class="text-bold underline">{{ __('Name') }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-bold underline">{{ __('Manner of Service') }}</p>
    </div>
    
    <div class="col-md-12">
        <p>{{ __('I declare under penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>

    <div class=" col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Person Certifying Service"
            inputFieldName="Text16"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <textarea name="<?php echo base64_encode('Text17');?>" class="form-control" rows="5">{{$attorney_name}}, {{$attorney_state_bar_no}}
{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}, {{$attorneyFax}}
{{$attorney_email}}
</textarea>        
    </div>        
    <div class=" col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text15"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

</div>