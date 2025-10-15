<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MINNESOTA') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text2"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('SIGNATURE DECLARATION') }}</h3>
    </div>   

    <div class=" col-md-12 pl-3 mt-3"> 
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box3'); ?>" class=" form-control w-auto height_fit_content">
            {{ __('PETITION, SCHEDULES & STATEMENTS') }}
        </p>
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box4'); ?>" class=" form-control w-auto height_fit_content">
            {{ __('CHAPTER 13 PLAN') }}
        </p>
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box5'); ?>" class=" form-control w-auto height_fit_content">
            {{ __('VOLUNTARY CONVERSION, SCHEDULES & STATEMENTS') }}
        </p>
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box6'); ?>" class=" form-control w-auto height_fit_content">
            {{ __('AMENDMENT TO PETITION, SCHEDULES & STATEMENTS') }}
        </p>
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box7'); ?>" class=" form-control w-auto height_fit_content">
            {{ __('MODIFIED CHAPTER 13 PLAN') }}
        </p>
        <p class="">
            <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box8'); ?>" class=" form-control w-auto height_fit_content">
            OTHER: PLEASE DESCRIBE:
            <input type="text" name="<?php echo base64_encode('Text41'); ?>" class=" form-control width_60percent">
        </p>
    </div>
   
    <div class=" col-md-12">
        <p class="">
            {{ __('I [We], the undersigned debtor(s) or authorized representative of the debtor, make the following declarations
            under penalty of perjury') }}
        </p>
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="pl-4">
                <p>
                    {{ __('The information I have given my attorney for the electronically filed petition, statements, schedules,
                    amendments, and/or chapter 13 plan, as indicated above, is true and correct;') }}
                </p>
            </div>
        </div>
         
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="pl-4">
                <p>
                    {{ __('The Social Security Number or Tax Identification Number I have given to my attorney for entry into
                    the court’s Case Management/Electronic Case Filing (CM/ECF) system as a part of the electronic
                    commencement of the above-referenced case is true and correct;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">3.</label>
            </div>
            <div class="pl-4">
                <p>
                    <span class="text-bold">{{ __('[individual debtors only]') }}</span> {{ __('If no Social Security Number was provided as described in paragraph 2
                    above, it is because I do not have a Social Security Number;') }}
                </p>
            </div>
        </div>         
        <div class="d-flex">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="pl-4">
                <p>
                    {{ __('I consent to my attorney electronically filing with the United States Bankruptcy Court my petition,
                    statements and schedules, amendments, and/or chapter 13 plan, as indicated above, together with
                    a scanned image of this Signature Declaration;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">5.</label>
            </div>
            <div class="pl-4">
                <p>
                    {{ __('My electronic signature contained on the documents filed with the Bankruptcy Court has the same
                    effect as if it were my original signature on those documents; and') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">6.</label>
            </div>
            <div class="pl-4">
                <p>
                    <span class="text-bold">{{ __('[corporate and partnership debtors only]') }}</span> {{ __('I have been authorized to file this petition on behalf of the debtor.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text36"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Debtor 1 or Authorized Representative"
                inputFieldName="Text37"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Debtor 2"
                inputFieldName="Text38"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed name of Debtor 1 or Authorized Representative"
                inputFieldName="Text39"
                inputValue={{$onlyDebtor}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6 mt-1">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name of Debtor 2"
                inputFieldName="Text40"
                inputValue={{$spousename}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>