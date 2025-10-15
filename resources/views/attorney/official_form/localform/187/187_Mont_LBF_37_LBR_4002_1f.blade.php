<div class="row">
    
    <div class="col-md-12 border_1px p-3 bb-0">
        <p>{{ __('Mont. LBF 37. NOTICE OF COMPLIANCE WITH § 521.') }}</p>
        <p class="mb-2">{{ __('[Mont. LBR 4002-1(f)]') }}</p>
        <textarea name="<?php echo base64_encode('Text47');?>" class="form-control" rows="7"></textarea>
        <label for="">{{ __('(Attorney for Debtor(s))') }}</label>
    </div>
    <div class="col-md-12 border_1px p-3 bb-0 text-center">
        <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE DISTRICT OF MONTANA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text49"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text48"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <h3 class="mt-3 text-center">
            {{ __('NOTICE OF COMPLIANCE WITH § 521s') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3x">
        <p><span class="pl-4"></span> {{ __('Debtor(s) hereby certify under penalty of perjury that:') }}</p>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">
                    {{ __('Pursuant to § 521(a)(1)(A), the list of creditors is filed herewith.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(a)(1)(B), the schedules of (i) assets and liabilities; (ii) current income
                    and expenditures; (iii) statement of financial affairs; and (iv) the proof of delivery of the § 342(b)
                    notice to the debtor is filed herewith') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(a)(1)(B)(iv), the Debtor(s) has/have filed with the Court copies of all
                    payment advices or other evidence of payment received within 60 days before the date of filing of
                    the Debtor’s/Debtors’ petition;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(a)(1)(B)(v), the Debtor(s) has/have filed with the Court Schedules I
                    and J, showing the amount of monthly net income, itemized to show how the amount is calculated,
                    and the Statement of Current Monthly Income and Means Test Calculation;') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(a)(1)(vi), the Debtor(s) state(s) that:') }}</p>
                <div class="d-flex">
                    <div class="pl-4">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box50');?>" value="Yes" class="form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="mb-2">{{ __('The Debtor(s) anticipate(s) an increase in income or expenditures over the
                            12-month period following the date of filing the petition. Specifically') }}:
                            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Text57');?>">
                            <input type="text" class="form-control mt-1" name="<?php echo base64_encode('Text58');?>">
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pl-4">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box51');?>" value="Yes" class="form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="mb-2">{{ __('The Debtor(s) does/do not anticipate(s) an increase in income or expenditures
                            over the 12-month period following the date of filing the petition.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(b)(1), the required credit counseling certification is filed herewith.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">7.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(b)(2), the Debtor(s) state(s) that there are no debt repayment plans
                    of the type contemplated by this statute (or, a copy of such repayment plan is filed herewith);') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">8.</label>
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('Pursuant to § 521(c), the Debtor(s) state(s) that:') }}</p>
                <div class="d-flex">
                    <div class="pl-4">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box52');?>" value="Yes" class="form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="mb-2">{{ __('The Debtor(s) has/have an interest in an account or program of the type
                            specified in § 521(c) of the Code, with documentation thereof filed herewith:') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="pl-4">
                        <input type="checkbox" name="<?php echo base64_encode('Check Box53');?>" value="Yes" class="form-control w-auto height_fit_content">
                    </div>
                    <div class="w-100 pl-3">
                        <p class="mb-2">{{ __('The Debtor(s) has/have no interest in an account or program of the type
                            specified in § 521(c) of the Code.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <p class="mt-3">
            <span class="pl-4"></span>
            DATED this
            <input type="text" name="<?php echo base64_encode('Text54');?>" value="{{$currentMonth}}" class="form-control w-auto">
            day of
            <input type="text" name="<?php echo base64_encode('Text55');?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text56');?>" value="{{$currentYearShort}}" class="form-control width_5percent">
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('I/We declare under penalty of perjury that the foregoing is true and correct.') }}
        </p>
    </div>
    
    <div class=" col-md-6 mt-3">
        <div class="pl-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Debtor"
                inputFieldName="Text61"
                inputValue={{$debtor_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class=" col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text59"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

    
    <div class=" col-md-6 mt-2">
        <div class="pl-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Co-Debtor"
                inputFieldName="Text62"
                inputValue={{$debtor2_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class=" col-md-6 mt-2">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="Text60"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

    <div class="col-md-12">
        <p class="p_justify">{{ __('Penalty for making a false statement: Fine up to $250,000 or imprisonment for up to 5 years or
            both. 18 U.S.C. §§ 152 and 3571') }}</p>
    </div>

</div>