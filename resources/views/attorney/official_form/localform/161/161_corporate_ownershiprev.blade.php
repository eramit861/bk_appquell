<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MASSACHUSETTS') }}</h3>
    </div>
    <div class="col-md-6 border_1px br-0 p-3">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('in re');?>" value="" class=" form-control" rows="2" style="padding-right:5px;">{{ __('Condi X Testcase and Cary X Testcase') }}</textarea>
            <p class="text-center mb-0">{{ __('Debtor') }}</p>
        </div>
    </div>
    <div class="col-md-6 p-3 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Chapter:"
            casenoNameField="Text2"
            caseno="{{$chapterNo}}">
        </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case No:"
                casenoNameField="Text3"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('STATEMENT OF CORPORATE OWNERSHIP') }}</h3>
        <p>
            <span class="pl-3"></span>{{ __('As required by Fed.R.Bankr.P. 1007(a)(1), the debtor now files this Corporate Ownership Statement and reports as follows:') }}
        </p>
    </div>
    
    <div class="col-md-12">
    <p class="text_italic">{{ __('(Check one box only.)') }}</p>
        <div class="d-flex mt-2 pl-3">
            <input name="<?php echo base64_encode('Debtor is not a corporation as defined in 11 USC 1019');?>" value="On" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span class="">{{ __('Debtor is not a “corporation” as defined in 11 U.S.C. §101(9).') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2 pl-3">
            <input name="<?php echo base64_encode('Debtor is a corporation as defined in 11 USC 1019 but has no entities to report under');?>" value="On" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span class="">{{ __('Debtor is a “corporation” as defined in 11 U.S.C. §101(9) but has no entities to report under Fed.R.Bankr.P. 1007(a)(1).') }}</span>
            </div>
        </div>
        <div class="d-flex mt-2 pl-3">
            <input name="<?php echo base64_encode('Debtor is a corporation as defined in 11 USC 1019 and the following corporations directly');?>" value="On" type="checkbox" class="form-control w-auto height_fit_content mt-0 ml-0">
            <div class="">
                <span class="">{{ __("Debtor is a \"corporation\" as defined in 11 U.S.C. §101(9), and the following corporations directly
                or indirectly own 10% or more of any class of the debtor's equity interests: (List corporations below.)") }}</span>
            </div>
        </div>
    </div>
   
    <div class="col-md-2 pt-2">
        <label for=""><span class="pl-3">{{ __('Name:') }}</span></label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Name');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-2 pt-2">
        <label for=""><span class="pl-3">{{ __('Address:') }}</span></label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Address');?>"  type="text" class="form-control mt-1">
    </div>

    <div class="col-md-2 pt-2">
        <label for=""><span class="pl-3">{{ __('Name') }}</span></label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Name_2');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-2 pt-2">
        <label for=""><span class="pl-3">{{ __('Address:') }}</span></label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Address_2');?>"  type="text" class="form-control mt-1">
    </div>

    <div class="col-md-2 pt-2">
        <label for=""><span class="pl-3">{{ __('Name') }}</span></label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Name_3');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-2 pt-2">
        <label for=""><span class="pl-3">{{ __('Address:') }}</span></label>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Address_3');?>"  type="text" class="form-control mt-1">
        <p class="text-center">{{ __('(For additional names, attach an addendum to this form.)') }}</p>
    </div>


    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text4"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-8 mt-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Authorized Individual for Corporate Debtor/Party"
            inputFieldName="Text1"
            inputValue="">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name of Authorized Individual for Corporate Debtor/Party"
                inputFieldName="Printed Name of Authorized Individual for Corporate DebtorParty"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Title of Authorized Individual for Corporate Debtor/Party"
                inputFieldName="Title of Authorized Individual for Corporate DebtorParty"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div>