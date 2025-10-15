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
        <h3>{{ __('DISCLOSURE OF COMPENSATION OF ATTORNEY FOR DEBTOR') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-4">
                <p>
                    {{ __('Pursuant to 11 U .S.C. § 329(a) and Fed. Bankr. P. 2016(b), I certify that I am the
                    attorney for the above-named debtor(s) and that compensation paid to me within one year before
                    the filing of the petition in bankruptcy, or agreed to be paid to me, for services rendered or to be
                    rendered on behalf of the debtor(s) in contemplation of or in connection with the bankruptcy case
                    is as follows:') }}</p>
                <div class="row">
                    <div class="col-md-8">
                        <label for="">{{ __('For legal services, I have agreed to accept:') }} </label>
                    </div>
                    <div class="col-md-4">
                        <p>$ <input type="text" name="<?php echo base64_encode('undefined');?>" class="price-field form-control w-auto"></p>
                    </div>
                    <div class="col-md-8">
                        <label for="">{{ __('Prior to the filing of this statement I have received:') }} </label>
                    </div>
                    <div class="col-md-4">
                        <p>$ <input type="text" name="<?php echo base64_encode('undefined_2');?>" class="price-field form-control w-auto"></p>
                    </div>
                    <div class="col-md-8">
                        <label for="">{{ __('Balance Due') }} </label>
                    </div>
                    <div class="col-md-4">
                        <p>$ <input type="text" name="<?php echo base64_encode('undefined_3');?>" class="price-field form-control w-auto"></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-4">
                <p>
                    {{ __('The source of the compensation paid to me was:') }}
                </p>
                <p>
                    <input type="checkbox" name="<?php echo base64_encode('Check Box3');?>" value="Yes" class="form-control w-auto ml-3">
                    {{ __('Debtor') }} 
                    <input type="checkbox" name="<?php echo base64_encode('Check Box4');?>" value="Yes" class="form-control w-auto ml-4">
                    {{ __('Other (specify)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-4">
                <p>
                    {{ __('The source of the compensation to be paid to me is:') }}
                </p>
                <p>
                    <input type="checkbox" name="<?php echo base64_encode('Check Box5');?>" value="Yes" class="form-control w-auto ml-3">
                    {{ __('Debtor') }} 
                    <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control w-auto ml-4">
                    {{ __('Other (specify)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="mb-0">&nbsp;</p>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control w-auto">
                    </div>
                    <div class="w-100 pl-2">
                        <p>
                            {{ __('I have not agreed to share the above-disclosed compensation with any other person
                            unless they are members and associates of my law firm.') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box8');?>" value="Yes" class="form-control w-auto">
                    </div>
                    <div class="w-100 pl-2">
                        <p>
                            {{ __('I have agreed to share the above-disclosed compensation with another person or
                            persons who are not members or associates of my law firm. A copy of the agreement,
                            together with a list of the names of the people or entities sharing in the compensation,
                            is attached.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-4">
                <p>
                    {{ __('In return for the above-disclosed fee, together with such further fee, if any, as is provided
                    in the written contract required by 11 U.S.C. §528(a)(1), I have agreed to render legal
                    service for all aspects of the bankruptcy case, including:') }}</p>
                <div class="d-flex">
                    <div class="">
                        <label for="">A.</label>
                    </div>
                    <div class="w-100 pl-4">
                        <p>
                            {{ __('Analysis of the debtor’s financial situation, and rendering advice to the debtor in
                            determining whether to file a petition in bankruptcy;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">B.</label>
                    </div>
                    <div class="w-100 pl-4">
                        <p>
                            {{ __('Preparation and filing of any petition, schedules, statements of affairs and plan
                            which may be required;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">C.</label>
                    </div>
                    <div class="w-100 pl-4">
                        <p>
                            {{ __('Representation of the debtor at the meeting of creditors and confirmation hearing,
                            and any adjourned hearings thereof;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">D.</label>
                    </div>
                    <div class="w-100 pl-4">
                        <p>
                            {{ __('Representation of the debtor in contested bankruptcy matters: and') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">E.</label>
                    </div>
                    <div class="w-100 pl-4">
                        <p>
                            {{ __('Other services reasonably necessary to represent the debtor(s).') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-4">
                <p>
                    {{ __('Pursuant to Local Rules 1007-1 and 1007-3-1, I have advised the debtor of the
                    requirements in the Statement of FinancialAffairs to disclose all payments made, or
                    property transferred, by or on behalf of the debtor to any person, including attorneys, for
                    consultation concerning debt consolidation or reorganization, relief under bankruptcy law,
                    or preparation of a petition in bankruptcy. I have reviewed the debtor’s disclosures and they
                    are accurate and complete to the best of my knowledge.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-12 ">
        <h3 class="text-center">{{ __('CERTIFICATION') }}</h3>
        <p class="mt-3">
            <span class="pl-4"></span>
            {{ __('I certify that the foregoing, together with the written contract required by 11 U.S.C.
            §528(a)(1), is a complete statement of any agreement or arrangement for payment to me for
            representation of the debtor(s) in this bankruptcy case') }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Attorney"
            inputFieldName="Text9"
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

</div>