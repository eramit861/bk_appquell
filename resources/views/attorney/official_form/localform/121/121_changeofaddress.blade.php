<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">IN THE {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE SOUTHERN DISTRICT OF ILLINOIS') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="txtDebtor"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <label for="">{{ __('In Proceedings Under') }}</label>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="underline ">{{ __('NOTICE OF CHANGE OF ADDRESS') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            <span class="pl-4"></span>
            {{ __('Notice is hereby given to amend the Court’s records to reflect a change of address for the
            debtor(s). The new address applies to (check applicable box(es)):') }}
        </p>
        <div class="d-flex">
            <div class="">
                <input type="radio" value="Choice1" name="<?php echo base64_encode('Group7');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('debtor') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="radio" value="Choice2" name="<?php echo base64_encode('Group7');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('joint debtor') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="radio" value="Choice3" name="<?php echo base64_encode('Group7');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>{{ __('both') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-2 pt-2">
        <label for="">{{ __('Old Address:') }}</label>
    </div>
    <div class="col-md-10">
        <div class=" width_90percent">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Old Address 1"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Old Address 2"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Old Address 3"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-2 pt-2 mt-3">
        <label for="">{{ __('New Address:') }}</label>
    </div>
    <div class="col-md-10 mt-3">
        <div class=" width_90percent">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="New Address 1"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="New Address 2"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class=" width_90percent mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="New Address 3"
                inputValue=""
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName="txtDebtSig"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor Signature"
                inputFieldName="txtJtDbtSig"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>