<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Southern District of Indiana') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox0"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="TextBox1"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class=" underline">{{ __('DECLARATION AS TO ORIGINAL SIGNATURE(S)') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            {{ __('(I/We), [name(s) of debtor(s)], hereby declare(s) under the penalty of perjury that all
            documents previously filed in this case with the incorrect electronic signature(s) have
            been signed in the original with the correct name(s) and are true and correct to the best
            of (my/our) knowledge, information, and belief.') }}
        </p>
    </div>
    
    <div class="col-md-6 mt-3 pt-2">
        <label class="float_right">/s/</label>
    </div>
    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Correct Name of Debtor"
                inputFieldName="TextBox2"
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-6 mt-2 pt-2">
        <label class="float_right">/s/</label>
    </div>
    <div class="col-md-6 mt-2">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Correct Name of Joint Debtor"
                inputFieldName="TextBox3"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('(Note: Certificate of Service not required.)') }}</p>
    </div>

</div>