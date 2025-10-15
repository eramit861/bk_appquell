<div class="row">
    <div class="col-md-12 text-center mt-3 mb-3">
        <h3 class="underline">AUTHORIZATION TO RELEASE INFORMATION TO THE TRUSTEE<br>{{ __('REGARDING SECURED CLAIMS BEING PAID BY THE TRUSTEE') }}</h3>
        <h3 class="mt-3">{{ __('(FILE WITH TRUSTEE ONLY—DO NOT FILE WITH THE COURT)') }}</h3>
    </div>
    
    <div class="col-md-2 pt-2">
        <label for="">{{ __('Debtor Name(s):') }}</label>
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control"  name="<?php echo base64_encode('Text34');?>" value="{{$onlyDebtor}}">
    </div>
    <div class="col-md-6">
        <x-officialForm.caseNo
            labelText="Case #:"
            casenoNameField="Text33"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" p_justify">
            <span class="pl-4"></span>
            {{ __('The debtor(s) in the above captioned bankruptcy case do/does hereby authorize any and all lien holder(s)
            on real property of the bankruptcy estate to release information to the Standing Chapter 13 Trustee in this
            bankruptcy filing.') }}
        </p>
        <p class=" p_justify">
            <span class="pl-4"></span>
            {{ __('The information to be released includes, but is not limited to, the amount of the post-petition monthly
            installment, the annual interest rate and its type, the loan balance, escrow accounts, amount of the contractual
            late charge and the mailing address for payments. This information will only be used by the Trustee and his/her
            staff in the administration of the bankruptcy estate and may be included in motions before the Court.') }}
        </p>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName=""
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text35"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    
    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor Signature (if applicable) "
            inputFieldName=""
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text36"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
</div>