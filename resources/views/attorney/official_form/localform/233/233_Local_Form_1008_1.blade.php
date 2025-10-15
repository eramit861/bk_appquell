<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text4"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text3"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text5"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('UNSWORN DECLARATION VERIFICATION') }}</h3>
        <p class="text-center">{{ __('DECLARATION UNDER PENALTY OF PERJURY ON BEHALF OF
            [DEBTOR/DEBTORS/CORPORATION OR PARTNERSHIP]') }}</p>
        <p>
            <span class="pl-4"></span>
            {{ __('[I/We], the [Debtor] President of the corporation named as the debtor in this case, declare under penalty of perjury that I
            have read the foregoing') }} 
            <input type="text" name="<?php echo base64_encode('Text6');?>" class="form-control width_20percent">
            {{ __('and that it is true and correct to the best of my information and belief.') }}
        </p>
    </div>

    <div class=" col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text7"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>        
    <div class=" col-md-6 mt-3">
        <div class="pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signature"
                inputFieldName="Text9"
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-2 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="Text11"
                inputValue="{{$onlyDebtor}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-2 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Title:"
                inputFieldName="Text12"
                inputValue="{{$suffix_d1}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class=" col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text8"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>        
    <div class=" col-md-6 mt-3">
        <div class="pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Signature"
                inputFieldName="Text10"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-2 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="Text13"
                inputValue="{{$spousename}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-2 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Title:"
                inputFieldName="Text14"
                inputValue="{{$suffix_d2}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>



</div>