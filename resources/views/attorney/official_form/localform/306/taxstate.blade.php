<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE SOUTHERN DISTRICT OF WEST VIRGINIA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case Number"
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text3"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>           
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('STATEMENT REGARDING TAX RETURNS') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify mb-0">
            <span class="pl-4"></span>
            {{ __('I (we) have not been required to file income tax returns for the two
            (2) years preceding the filing of my bankruptcy case, for the following
            reason(s):') }}
        </p>
        <input type="text" name="<?php echo base64_encode('demo1');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('demo2');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Text4');?>" class="form-control mt-1">

    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text5"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-8 mt-3">
        <div>
            <x-officialForm.debtorSignVertical
                labelContent="Debtor’s Name (printed)"
                inputFieldName="Debtors Name printed"
                inputValue={{$onlyDebtor}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Signed"
                inputFieldName="Signed"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-3">
            <x-officialForm.debtorSignVertical
                labelContent="Joint Debtor’s Name (printed)"
                inputFieldName="Joint Debtors Name printed"
                inputValue={{$spousename}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Signed"
                inputFieldName="Signed_2"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>