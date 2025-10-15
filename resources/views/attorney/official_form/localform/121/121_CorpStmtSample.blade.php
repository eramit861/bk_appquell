<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('SOUTHERN DISTRICT OF ILLINOIS') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text15"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text16"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text17"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="">{{ __('STATEMENT OF CORPORATE OWNERSHIP') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
        {{ __('Comes Now') }},
            <input type="text" name="<?php echo base64_encode('Text33');?>" value="" class="form-control w-auto">
            {{ __('(the “Debtor(s)”) and pursuant to Fed. R. Bankr. P.
            1007(a) and 7007.1 state as follows:') }}
        </p>
        <p class="">
            <span class="pl-4"></span>1.<span class="pl-4"></span> {{ __('All corporations that directly or indirectly own 10% or more of any class of the Debtor’s
            equity interests are listed below:') }}
        </p>
    </div>

    <div class="col-md-6 text-center">
        <label class="text-bold"> {{ __('Owner') }}</label>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text25"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text27"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text28"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text29"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-2 text-center">
        <label class="text-bold">{{ __('% of Shares Owned') }}</label>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text26"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text30"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text31"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Text32"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-2"></div>
    

    <div class="col-md-6 mt-3 pt-2">
        <label class="float_right">By:</label>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent=""
            inputFieldName="TextBox0"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney for Debtor(s)"
                inputFieldName="Text24"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>