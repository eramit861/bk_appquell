<div class="row">
    
    <div class="col-md-12 border_1px p-3 bb-0">
        <p>{{ __('Mont. LBF 30. STATEMENT OF DOMESTIC SUPPORT OBLIGATION(S).') }}</p>
        <p class="mb-2">{{ __('[Mont. LBR 4002-1(e)]') }}</p>
        <textarea name="<?php echo base64_encode('Text63');?>" class="form-control" rows="7"></textarea>
        <label for="">{{ __('(Attorney for Debtor(s))') }}</label>
    </div>
    <div class="col-md-12 border_1px p-3 bb-0 text-center">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE DISTRICT OF MONTANA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text64"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text65"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <h3 class="mt-3 text-center">
            {{ __('STATEMENT OF DOMESTIC SUPPORT OBLIGATION(S)') }}
        </h3>
    </div>

    <div class="col-md-12">
        <p class=" mt-3">{{ __('[If filing jointly, information for both spouses must be provided on this form]') }}</p>
        <p><span class="pl-4"></span> {{ __('Pursuant to Mont. LBR 4002-1(e), the undersigned hereby provides this Statement of') }}</p>
        <p>{{ __('Domestic Support Obligation(s), as defined in 11 U.S.C. § 101(14A).') }}</p>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">
                {{ __('Debtor’s name (enter full name)') }}:
                    <input type="text" class="form-control width_50percent" name="<?php echo base64_encode('Text66');?>" value="{{$onlyDebtor}}">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">Does Debtor have a domestic support obligation: 
                    <input type="checkbox" name="<?php echo base64_encode('Check Box67');?>" value="Yes" class="form-control w-auto height_width_content">
                    {{ __('yes') }} 
                    <input type="checkbox" name="<?php echo base64_encode('Check Box68');?>" value="Yes" class="form-control w-auto height_width_content">
                    {{ __('no. If yes, please fill out the
                    rest of this form. If no, do not fill out the rest, but sign where indicated below') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Debtor’s employer and employer’s address') }}: 
                    <input type="text" class="form-control width_50percent" name="<?php echo base64_encode('Text69');?>">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Name, address, phone number, employer’s name, and address of employer for any person
                    responsible with the Debtor for the support') }}:
                    <input type="text" class="form-control" name="<?php echo base64_encode('Text70');?>">
                    <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Text71');?>">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Name, address and phone number for the holder of the claim of support') }}:
                    <input type="text" class="form-control" name="<?php echo base64_encode('Text72');?>">
                    {{ __('[If the Debtor does not know the whereabouts of the former spouse, this fact should be
                    affirmatively stated above, but the address for the support collection agency must be
                    provided.]') }}
                </p>
            </div>
        </div>
        <p class="mt-3">
            {{ __('AS OF THE DATE OF FILING OF THE BANKRUPTCY PETITION:') }}
        </p>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">
                {{ __('Amount of support obligation') }}: $
                    <input type="text" class="form-control w-auto price-field" name="<?php echo base64_encode('Text73');?>">
                    {{ __('per') }} 
                    <input type="text" class="form-control w-auto" name="<?php echo base64_encode('Text74');?>">
                    {{ __('[i.e. month, week, etc.]S') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">
                {{ __('Term of support obligation: from') }} 
                    <input type="text" class="form-control w-auto" name="<?php echo base64_encode('Text75');?>">
                    {{ __('until') }} 
                    <input type="text" class="form-control w-auto" name="<?php echo base64_encode('Text76');?>">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">Amount that the domestic support obligation is in arrears: $ 
                    <input type="text" class="form-control w-auto price-field" name="<?php echo base64_encode('Text77');?>">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Court name and jurisdiction in which order of support was issued:') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">Court Case No. 
                    <input type="text" class="form-control w-auto" name="<?php echo base64_encode('Text78');?>">
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Name and address of State Child Support Enforcement Agency involved in such claim:') }}
                </p>
            </div>
        </div>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('I/We declare under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    
    <div class=" col-md-6 mt-3">
        <div class="pl-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Debtor"
                inputFieldName="Text81"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class=" col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text79"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

    
    <div class=" col-md-6 mt-2">
        <div class="pl-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Co-Debtor"
                inputFieldName="Text82"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class=" col-md-6 mt-2">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text80"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

</div>