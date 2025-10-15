<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF WISCONSIN') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class="col-md-12 mt-3 text-center">
        <h3>
            {{ __("INDIVIDUAL CHAPTER 7 DEBTOR'S NOTICE") }}<br>{{ __('REGARDING SECTION 522(q)') }}
        </h3>
    </div>

    <div class="col-md-12 pl-4 mt-3">
        <p>{{ __('Pursuant to Local Rule 4004(a), individual chapter 7 debtors must file this notice if:') }}</p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="form-control w-auto height_fit_content">
            {{ __('The debtor pursuant to § 522(b)(3) and state or local law has claimed
            an exemption in property that (i) the debtor or a dependent of the debtor
            uses as a residence, claims as a homestead, or acquired as a burial plot, as
            specified in § 522(p)(1), and (ii) exceeds $160,375') }}<sup>1</sup> {{ __('in value in the aggregate.') }}</p>
    </div>

   

    <div class="col-md-6">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text4"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Text3"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

</div>