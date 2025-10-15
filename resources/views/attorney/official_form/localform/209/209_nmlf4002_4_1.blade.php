<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Text121"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text120"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo> 
    </div>
 
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('CHANGE OF ADDRESS FOR DEBTOR') }}</h3>
        <p class="mb-2"><span class="pl-4"></span>{{ __('Please change my address in this case. Use the new address to send notices to me.') }}</p>

        <p class="mb-2">{{ __('Old Address:') }}</p>
         <div class="row mb-2">
            <div class="col-md-2 pt-2">
                <p class="text_italic mb-0"><span class="pl-4"></span>{{ __('Name') }}</p>
            </div>
            <div class="col-md-8">
                <x-officialForm.inputText name="Text124" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2"></div>
    
            <div class="col-md-2 pt-2">
                <p class="text_italic mb-0"><span class="pl-4"></span>{{ __('Address') }}</p>
            </div>
            <div class="col-md-8">
                <x-officialForm.inputText name="Text123" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2"></div>
    
            <div class="col-md-2 pt-2">
                <p class="text_italic mb-0"><span class="pl-4"></span>{{ __('City, State, zip code') }}</p>
            </div>
            <div class="col-md-8">
                <x-officialForm.inputText name="Text122" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2"></div>
         </div> 
         <p class="mb-2">{{ __('New Address:') }}</p>
         <div class="row mb-2">
            <div class="col-md-2 pt-2">
                <p class="text_italic mb-0"><span class="pl-4"></span>{{ __('Name') }}</p>
            </div>
            <div class="col-md-8">
                <x-officialForm.inputText name="Text128" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2"></div>
    
            <div class="col-md-2 pt-2">
                <p class="text_italic mb-0"><span class="pl-4"></span>{{ __('Address') }}</p>
            </div>
            <div class="col-md-8">
                <x-officialForm.inputText name="Text127" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2"></div>
    
            <div class="col-md-2 pt-2">
                <p class="text_italic mb-0"><span class="pl-4"></span>{{ __('City, State, zip code') }}</p>
            </div>
            <div class="col-md-8">
                <x-officialForm.inputText name="Text125" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2"></div>
         </div>
         <p><span class="pl-4"></span>{{ __('If I am a joint debtor, I am filing this change of address for (myself/the other debtor/both).') }}</p>
    </div>
 
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 pl-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature"
            inputFieldName="Text5"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="Name"
                inputValue="{{$attorney_name}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Address:"
                inputFieldName="Address 1"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}">
            </x-officialForm.debtorSignVertical>
            <div class="row mt-1">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <x-officialForm.inputText name="Address 2" class="" value="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}"/>
                </div>
            </div>

        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Telephone:"
                inputFieldName="Telephone"
                inputValue="{{$attorneyPhone}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Email:"
                inputFieldName="Email"
                inputValue="{{$attorney_email}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>