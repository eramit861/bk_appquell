<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Eastern District of Missouri') }}</h3>
    </div>
    <div class="col-md-12 border_1px">
        <div class="row">
            <div class="col-md-6 border_right_1px p-3">
                <label>{{ __('Names of Debtor(s) listed on the bankruptcy case') }}</label>
                <textarea name="<?php echo base64_encode('Names of Debtors listed on the bankruptcy case');?>" class=" form-control" rows="5">{{$debtorname}}</textarea>
            </div>
            <div class="col-md-6 p-0">
                <div class="mt-3 pr-3 pl-3">
                    <x-officialForm.caseNo
                        labelText="{{ __('Case No:') }}"
                        casenoNameField="Bankruptcy Case No"
                        caseno="{{$caseno}}"
                    ></x-officialForm.caseNo> 
                </div>
                <div class="row pl-3 pr-3 mt-2">
                    <div class="col-md-3 pt-2">
                    <p class="mb-0">{{ __('Adversary Proceeding No.:') }}</p>
                    </div>
                    <div class="col-md-9">
                       <input name="<?php echo base64_encode('Adversary Proceeding Number');?>" value="" type="text" class="form-control w-auto mt-1">
                    </div>
                </div>
                <div class="mt-2 pr-3 pl-3 pb-3">
                    <x-officialForm.caseNo
                        labelText="{{ __('Chapter:') }}"
                        casenoNameField="Chapter"
                        caseno="{{$chapterNo}}"
                ></x-officialForm.caseNo> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-0 pl-0">
        <h3 class="text-center mb-3">{{ __('CHANGE OF MAILING ADDRESS FOR DEBTOR') }},<br>{{ __('CREDITOR or OTHER PARTY IN INTEREST') }}</h3>
        <p>{{ __('This change of mailing address is submitted by') }}: <span class="text_italic"> {{ __('(Mark only one)') }} </span></p>
    </div>
    <div class="col-md-2">
        <div class="d-flex mt-2">
            <input name="<?php echo base64_encode('Check Box1');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span>{{ __('Debtor') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="d-flex mt-2">
            <input name="<?php echo base64_encode('Check Box2');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span>{{ __('Joint Debtor') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="d-flex mt-2">
            <input name="<?php echo base64_encode('Check Box3');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span>{{ __('Creditor') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-2 pt-2">
                <input name="<?php echo base64_encode('Check Box4');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">{{ __('Other') }}  
            </div>
            <div class="col-md-10">
                <input name="<?php echo base64_encode('Party in interest plaintiff defendant professional retained by the estate etc');?>"  type="text" class="form-control">
            </div>
            <div class="col-md-12"><p class="text_italic">{{ __('(Party in interest, plaintiff, defendant, professional retained by the estate, etc.)') }}</p></div>
        </div>

    </div>
    <div class="col-md-2">
        <label for="">{{ __('Full Name:') }}</label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Pary Name');?>"  type="text" class="form-control">
        <p class="text_italic">{{ __('Separate forms must be completed for each requester updating their address') }}</p>
    </div>
    <div class="col-md-3 border_1px br-0 p-3 bb-0">
        <label for="">{{ __('List the address previously provided to the Court:') }}</label>
    </div>
    <div class="col-md-9 border_1px p-3 bb-0">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Street Address - Line 1"
            inputFieldName="Old Street Address  Line 1"
            inputValue="">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Street Address - Line 2"
                inputFieldName="Old Street Address  Line 2"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="ATTN: Line (if applicable, for Creditor)"
                inputFieldName="ATTN Line if applicable for Creditor"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="City, State and Zip Code"
                inputFieldName="City State and Zip Code"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-3 border_1px br-0 p-3">
        <label for="">{{ __('List the new address:') }}</label>
    </div>
    <div class="col-md-9 border_1px p-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="(new) Street Address - Line 1"
            inputFieldName="new Street Address  Line 1"
            inputValue="">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(new) Street Address - Line 2"
                inputFieldName="new Street Address  Line 2"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(new) ATTN: Line (if applicable, for Creditor)"
                inputFieldName="new ATTN Line if applicable for Creditor"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="(new) City, State and Zip Code"
                inputFieldName="new City State and Zip Code"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="{{ __('Signed:') }}"
            inputFieldName="By 1"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-12 mt-1">
                <input name="<?php echo base64_encode('By 2');?>" value="{{$attorney_name}}" type="text" class="form-control mt-1">
                <div class="">
                <span>{{ __('Printed Name') }}</span> 
                <span class="float_right">{{ __('Title') }}</span>
                </div>
                
            </div>
            <div class="col-md-12 mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="{{ __('Address') }}"
                    inputFieldName="Address"
                    inputValue="{{$attonryAddress1}} ,{{$attonryAddress2}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="{{ __('City') }}"
                    inputFieldName="City"
                    inputValue="{{$attorney_city}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="{{ __('State') }}"
                    inputFieldName="State"
                    inputValue="{{$attorney_state}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="{{ __('Zip Code') }}"
                    inputFieldName="Zip Code"
                    inputValue="{{$attorney_zip}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-6 mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="{{ __('Telephone') }}"
                    inputFieldName="Telephone"
                    inputValue="{{$attorneyPhone}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-6 mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="{{ __('Bar ID') }}"
                    inputFieldName="Bar ID"
                    inputValue="{{$attorney_state_bar_no}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
    </div>
</div>