<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF LOUISIANA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3 t-upper">
        <x-officialForm.inReDebtorCustom
            debtorNameField="DebtorNames"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="{{ __('Case No:') }}"
            casenoNameField="CASE NO"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo> 
        <div class="mt-2">
        <x-officialForm.caseNo
            labelText="{{ __('Chapter:') }}"
            casenoNameField="CHAPTER"
            caseno="{{$chapterNo}}">
        </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('AFFIDAVIT OF NON-MILITARY SERVICE') }}</h3>
        <p>{{ __('BEFORE ME, the undersigned authority empowered to administer oaths and take acknowledgements, personally appeared') }}
           <input name="<?php echo base64_encode('Name');?>"  type="text" class="form-control mt-1 width_30percent">
           {{ __('("Affiant"), who, after being duly sworn, stated') }}
        </p>

        <div class="row">
            <div class="col-md-12 pr-0">
                <div class="d-flex">
                    <div class=" pl-4">
                        <label for="">1.</label>
                    </div>
                    <div class="pl-3 width_13percent">
                        <p class="mb-0">{{ __('That the Affiant is') }}</p>
                    </div>
                    <div class=" pl-0 width_80percent">
                        <p class="mb-2">
                            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('the attorney for the party seeking relief in this matter'); ?>" value="On">
                            {{ __('the attorney for the party seeking relief in this matter.') }}
                        </p> 
                        <p class="mb-2">
                            <input type="checkbox" class="form-comtrol width-auto height_fit_content" name="<?php echo base64_encode('the pro se party seeking relief in this matter'); ?>" value="On">
                            {{ __('the pro se party seeking relief in this matter.') }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex">
                   <div class=" pt-2 mt-1 pl-4">
                        <label class="">2.</label>
                   </div>
                   <div class="w-100 pl-3">
                   <p>
                   {{ __("That the Affiant received a response from the United States Department of Defense's Defense Manpower Data Center† that") }} 
                        <input name="<?php echo base64_encode('Name2');?>"  type="text" class="form-control mt-1 width_30percent">{{ __(", is
                        not a member of the armed forces pursuant to the provisions of the Servicemembers'
                        Civil Relief Act. Copies of the responses are attached and incorporated as Exhibit A.") }}
                    </p>
                    <p class="text-center mb-2">{{ __('OR') }}</p>
                   </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex">
                   <div class=" pt-2 mt-1 pl-4">
                        <label class="">3.</label>
                   </div>
                   <div class="w-100 pl-3">
                   <p>
                   {{ __('That the Affiant was unable to determine') }} 
                        <input name="<?php echo base64_encode('Name3');?>"  type="text" class="form-control mt-1 width_30percent">{{ __('s
                        military status due to lack of a valid social security number, last name and date of birth.') }}
                    </p>
                    <p class="text-center mb-2">{{ __('OR') }}</p>
                   </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="d-flex">
                   <div class=" pt-2 mt-1 pl-4">
                        <label class="">4.</label>
                   </div>
                   <div class="w-100 pl-3">
                        <p>
                        {{ __('That') }}<input name="<?php echo base64_encode('Name4');?>"  type="text" class="form-control mt-1 width_30percent">
                            {{ __('is a juridical person not eligible for military service.') }}
                        </p>
                   </div>
                </div>
            </div>
            <div class="col-md-12">
                <p class="mb-2">{{ __('STATE OF') }} <input name="<?php echo base64_encode('State');?>"  type="text" class="form-control mt-1 w-auto"></p>
                <p class="mb-2"> {{ __('COUNTY/PARISH OF') }} <input name="<?php echo base64_encode('County/Parish');?>"  type="text" class="form-control mt-1 w-auto"></p>
                <p>
                {{ __('SWORN TO AND SUBSCRIBED before me this') }} 
                    <input name="<?php echo base64_encode('Day');?>"  value="{{$currentMonth}}" type="text" class="form-control mt-1 w-auto">day of
                    <input name="<?php echo base64_encode('Month');?>"  value="{{$currentDay}}" type="text" class="form-control mt-1 width_5percent">, 20
                    <input name="<?php echo base64_encode('Year');?>"  value="{{$currentYearShort}}" type="text" class="form-control mt-1 width_5percent">, by
                    <input name="<?php echo base64_encode('Name5');?>"  value="{{$attorny_sign}}" type="text" class="form-control mt-1 width_20percent">
                </p>
            </div>
        </div>
    </div>
 
    <div class="col-md-4 mt-3"></div>
    <div class="col-md-3 mt-3"></div>
    <div class="col-md-5 mt-3">
        <input name="<?php echo base64_encode('NotarySignature');?>"  type="text" class="form-control mt-1">
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="{{ __('Notary Public, State of') }}"
                inputFieldName="NotaryState"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="{{ __('My commission expires:') }}"
                inputFieldName="NotaryExpiration"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-12">
       <p>{{ __('A record request may be made at https://scra.dmdc.osd.mil/') }}</p>
    </div>
</div> 