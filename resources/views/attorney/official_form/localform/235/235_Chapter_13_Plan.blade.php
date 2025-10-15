<div class="row">

    <div class="col-md-12 p-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Western District of Oklahoma') }}</h3>
    </div>

    <div class="col-md-8 border_1px p-3 br-0">
        <div class="pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="In re"
                inputFieldName="Debtor Name(s)"
                inputValue="{{$debtorname}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-4 border_1px p-3 ">
        <div class="">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="mt-3 text-center underline">{{ __('CHAPTER 13 PLAN') }}</h3>
        <p class="mt-3 text-center text-bold">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check if this is an amended plan');?>" value="Yes">
            {{ __('Check if this is an amended plan') }}
        </p>
        <div class="d-flex">
            <div class="">
                <label class="text-bold">1.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="text-bold">{{ __('NOTICES') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-2">
                <label class="text-bold">{{ __('To') }}&nbsp;{{ __('Debtors:') }}</label>
            </div>
            <div class="w-100 pl-4">
                <p class="text-bold mb-2">{{ __('This form sets out options that may be appropriate in some cases, but the presence of an option on the form
                does not indicate that the option is appropriate in your circumstances or that it is permissible in your judicial
                district. Plans that do not comply with local rules and judicial rulings may not be confirmable.') }}</p>
                <p class="text_italic">{{ __('In the following notice to creditors, you must check each box that applies.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label class="text-bold">{{ __('To') }}&nbsp;{{ __('Creditors:') }}</label>
            </div>
            <div class="w-100 pl-4">
                <p class="text-bold mb-2">{{ __('Your rights may be affected by this plan. Your claim may be reduced, modified, or eliminated.') }}</p>
                <p class="mb-2">{{ __('You should read this plan carefully and discuss it with your attorney if you have one in this bankruptcy case. If you do
                not have an attorney, you may wish to consult one.') }}</p>
                <p class="p_justify">{{ __('If you oppose the plan’s treatment of your claim or any provision of this plan, you or your attorney must file an
                objection to confirmation at least 7 days before the date set for the hearing on confirmation, unless otherwise ordered
                by the Bankruptcy Court. The Bankruptcy Court may confirm this plan without further notice if no objection to
                confirmation is filed. See Bankruptcy Rule 3015. In addition, you must file a timely proof of claim in order to be paid
                under any plan.') }}</p>
            </div>
        </div>
        <div class=" table_sect">
            <table class="w-100">
                <tr>
                    <td class="p-2">{{ __('The plan contains nonstandard provisions set out in Section 10.') }}</td>
                    <td class="p-2">
                        <p class="mb-0 text-center text-bold">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Yes. Plan Contains Nonstandard Provisions');?>" value="On">
                            {{ __('Yes') }}
                        </p>
                    </td>
                    <td class="p-2">
                        <p class="mb-0 text-center text-bold">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('No. This plan does not contain nonstandard provisions');?>" value="On">
                            {{ __('No') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">{{ __('The plan limits the amount of a secured claim based on a valuation of the collateral in accordance with Section 5.C.(2)(b).') }}</td>
                    <td class="p-2">
                        <p class="mb-0 text-center text-bold">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Yes. Plan Limits Amount of Secured Claim');?>" value="On">
                            {{ __('Yes') }}
                        </p>
                    </td>
                    <td class="p-2">
                        <p class="mb-0 text-center text-bold">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('No. Plan Does Not Limit Amount of Secured Claim');?>" value="On">
                            {{ __('No') }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="p-2">{{ __('The plan avoids a security interest or lien in accordance with Section 9.') }}</td>
                    <td class="p-2">
                        <p class="mb-0 text-center text-bold">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Yes. Plan Avoids Security Interest or Lien');?>" value="On">
                            {{ __('Yes') }}
                        </p>
                    </td>
                    <td class="p-2">
                        <p class="mb-0 text-center text-bold">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('No. Plan Does Not Avoid Security Interest or Lien');?>" value="On">
                            {{ __('No') }}
                        </p>
                    </td>
                </tr>
            </table>
        </div>
        <div class="d-flex mt-3">
            <div class="pt-2">
                <label class="text-bold">2.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2"><span class="text-bold mr-3">{{ __('PAYMENTS TO THE TRUSTEE:') }}</span>{{ __('The Debtor (or the Debtor’s employer) shall pay to the Trustee the sum of') }} $
                <input type="text" name="<?php echo base64_encode('Trustee Pay');?>" class="form-control w-auto price-field">
                {{ __('per
                month for') }} <input type="text" name="<?php echo base64_encode('Number of Payment Months');?>" class="form-control w-auto"> {{ __('months. If the plan payment structure is in the form of step payments, the payment structure is indicated below.
                Plan payments to the Trustee shall commence on or before 30 days after the Chapter 13 Petition is filed. The Debtor shall turn
                over such additional funds as required by law and/or any Court Order.') }}</p>
                <p class="mb-2">{{ __('Step payments') }}: $ <input type="text" name="<?php echo base64_encode('Step Payments, if any');?>" class="form-control width_90percent price-field"></p>
                <p>{{ __('Minimum total of plan payments') }}: $ <input type="text" name="<?php echo base64_encode('Minimum total of plan payments');?>" class="form-control w-auto price-field"></p>
                <p class="mb-2">{{ __('The Debtor intends to pay plan payments:') }}</p>
                <div class="row">
                    <div class="col-md-3">
                        <p class="mb-0">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Direct Payments');?>" value="On">
                            {{ __('Direct or') }}
                        </p>
                    </div>
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3">
                        <p class="mb-0">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Wage Deduction Payments');?>" value="On">
                            {{ __('By wage deduction from employer of:') }}
                        </p>
                    </div>
                    <div class="col-md-9">
                        <p class="mb-0">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Debtor Wage Deduction');?>" value="On">
                            {{ __('Debtor') }}
                        </p>
                        <p class="mb-0">
                            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Joint Debtor Wage Deduction');?>" value="On">
                            {{ __('Joint Debtor') }}
                        </p>
                    </div>
                </div>
                <p class="mt-3 mb-2">
                {{ __('Debtor’s Pay Frequency') }}: 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Debtor Paid Monthly');?>" value="On">
                    {{ __('Monthly') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Debtor Paid Semi-monthly');?>" value="On">
                    {{ __('Semi-monthly (24 times per year)') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Debtor Paid  Bi-weekly');?>" value="On">
                    {{ __('Bi-weekly (26 times per year)') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Debtor Paid Weekly');?>" value="On">
                    {{ __('Weekly') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Debtor Paid Other Time Period');?>" value="On">
                    {{ __('Other') }}
                </p>
                <p class="">
                {{ __('Joint Debtor’s Pay Frequency') }}: 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Joint Debtor Paid Monthly');?>" value="On">
                    {{ __('Monthly') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Joint Debtor Paid Semimonthly');?>" value="On">
                    {{ __('Semi-monthly (24 times per year)') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Joint Debtor Paid Bi-weekly');?>" value="On">
                    {{ __('Bi-weekly (26 times per year)') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Joint Debtor Paid Weekly');?>" value="On">
                    {{ __('Weekly') }} 
                    <input type="checkbox" class="form-control height_fit_content w-auto ml-4" name="<?php echo base64_encode('Joint Debtor Paid Other Time Period');?>" value="On">
                    {{ __('Other') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="pt-2">
                <label class="text-bold">3.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('PLAN LENGTH:') }}</span>
                    {{ __('This plan is a') }}
                    <input type="text" name="<?php echo base64_encode('PLAN LENGTH');?>" class="form-control w-auto ">
                    {{ __('month plan.') }}
                </p>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label class="text-bold">4.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('GENERAL PROVISIONS:') }}</span>
                </p>
                <div class="d-flex">
                    <div class="">
                        <label for="">a.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="mb-2">{{ __('As used herein, the term "Debtor" shall include both Debtors in a joint case.') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">b.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="mb-2">{{ __('Student loans are non-dischargeable unless determined in an adversary proceeding to constitute an undue hardship under 11 U.S.C. §523(a)(8).') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">c.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="mb-2 p_justify">{{ __('The Trustee will make no disbursements to any creditor until an allowed proof of claim has been filed. In the case of a
                        secured claim, the party filing the claim must attach proper proof of perfection of its security interest as a condition of
                        payment by the Trustee.') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">d.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="mb-2">{{ __('Creditors not advising the Trustee of address changes may be deemed to have abandoned their claims.') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">e.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="mb-2">{{ __('All property shall remain property of the estate and shall vest in the Debtor only upon dismissal, discharge, conversion or
                        other specific Order of the Court. The Debtor shall be responsible for the preservation and protection of all property of the
                        estate not transferred to and in the actual possession of the Trustee.') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">f.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="mb-2 p_justify">{{ __('The debtor is prohibited from incurring any debts except such debts approved pursuant to the Court’s directives or as
                        necessary for medical or hospital care.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label class="text-bold">5.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('DISBURSEMENTS TO BE MADE BY TRUSTEE:') }}</span>
                </p>
                <div class="d-flex">
                    <div class="">
                        <label class="text-bold">A.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="text-bold mb-2">{{ __('ADMINISTRATIVE EXPENSES:') }}</p>
                        <p class="mb-2">
                            (1) {{ __("Estimated Trustee's Fee") }}: 
                            <input type="text" name="<?php echo base64_encode("Estimated Trustee's Fee");?>" class="form-control w-auto ">
                            %
                        </p>
                        <p>
                            (2) {{ __("Attorney's Fee (unpaid portion)") }}: $ 
                            <input type="text" name="<?php echo base64_encode('Attorney Fee to be paid through the plan in monthly payments');?>" class="form-control w-auto ">
                            {{ __('to be paid through plan in monthly payments') }}
                        </p>
                        <p class="mb-2">
                            (3) {{ __('Filing Fee (unpaid portion)') }}: $
                            <input type="text" name="<?php echo base64_encode('Filing Fee to be paid through the plan');?>" class="form-control w-auto ">
                        </p>
                    </div>
                </div>
                <div class="d-flex mt-2">
                    <div class="">
                        <label class="text-bold">B.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="text-bold mb-2">{{ __('PRIORITY CLAIMS UNDER 11 U.S.C. § 507:') }}</p>
                        <div class="d-flex">
                            <div class="">
                                <label class="text-bold">(1)</label>
                            </div>
                            <div class="pl-3 w-100">
                                <p class="text-bold mb-2">{{ __('DOMESTIC SUPPORT OBLIGATIONS:') }}</p>
                                <p class="mb-2">{{ __('(a) Debtor is required to pay all post-petition domestic support obligations directly to the holder of the claim.') }}</p>
                                <p class="mb-2">{{ __('(b) The name(s) of the holder(s) of any domestic support obligation are as follows:') }}</p>
                                <textarea name="<?php echo base64_encode('Names of Domestic Support Obligation Holders');?>" class="mb-2 form-control" rows="2"></textarea>
                                <p class="mb-2">{{ __('(c) Anticipated Domestic Support Obligation Arrearage Claims. Unless otherwise specified in this Plan, priority claims
                                under 11 U.S.C. § 507(a)(1) will be paid in full pursuant to 11 U.S.C. § 1322(a)(2). These claims will be paid at the same
                                time as secured claims. Any allowed claim for a domestic support obligation that remains payable to the original
                                creditor shall be paid in full pursuant to the filed claim, unless limited by separate Court Order or filed Stipulation.') }}</p>
                                <p class="mb-2">
                                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Domestic support arrerage shall be paid through wage assignment pursuant to nonbankruptcy Court order');?>" value="On">
                                    {{ __('Arrearage shall be paid through wage assignment, pursuant to previous Order entered by a non-bankruptcy Court.') }}
                                </p>
                                <p class="mb-2">
                                    <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Domestic support arrerage shall be paid in full pursuant to the Plan');?>" value="On">
                                    {{ __('Arrearage shall be paid in full through the plan.') }}
                                </p>
                                <div class=" table_sect table_sect_head_border">
                                    <table class="w-100">
                                        <tr>
                                            <th class="p-2 width_60percent">{{ __('Name') }}</th>
                                            <th class="p-2">{{ __('Estimated arrearage claim') }}</th>
                                            <th class="p-2">{{ __('Projected monthly arrearage payment in plan') }}</th>
                                        </tr>
                                        <tr>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Name of Person/Entity Owed Domestic Support Obligation 1');?>" class="form-control "></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Estimated arrearage claim 1');?>" class="form-control w-auto price-field"></p></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Projected monthly arrearage payment in plan 1');?>" class="form-control width_90percent price-field"></p></td>
                                        </tr>
                                        <tr>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Name of Person/Entity Owed Domestic Support Obligation 2');?>" class="form-control "></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Estimated arrearage claim 2');?>" class="form-control w-auto price-field"></p></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Projected monthly arrearage payment in plan 2');?>" class="form-control width_90percent price-field"></p></td>
                                        </tr>   
                                    </table>
                                </div>
                                <p class="mb-2 mt-2">{{ __('(d) Pursuant to §§ 507(a)(1)(B) and 1322(a)(4), the following domestic support obligation claims are assigned to, owed
                                to, or recoverable by a governmental unit, and shall be paid as follows:') }}</p>
                                <div class=" table_sect table_sect_head_border">
                                    <table class="w-100">
                                        <tr>
                                            <th class="p-2">{{ __('Name') }}</th>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Domestic Support Obligation to be paid to');?>" class="form-control "></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <div class="">
                                <label class="text-bold">(2)</label>
                            </div>
                            <div class="pl-3 w-100">
                                <p class="text-bold mb-2">{{ __('OTHER PRIORITY CLAIMS:') }}</p>
                                <p class="mb-2">{{ __('(a) Pre-petition and/or post-petition priority tax claims shall be paid in full pursuant to the filed claim unless
                                limited by separate Court Order or filed Stipulation.') }}</p>
                                <div class=" table_sect table_sect_head_border">
                                    <table class="w-100">
                                        <tr>
                                            <th class="p-2 width_80percent">{{ __('Name') }}</th>
                                            <th class="p-2">{{ __('Estimated claim') }}</th>  
                                        </tr>
                                        <tr>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Pre or Post Petition Priority Tax Claim Holder 1');?>" class="form-control "></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Pre or Post Petition Priority Tax Claim Holder 1 Claim Amount');?>" class="form-control price-field width_90percent"></p></td>
                                        </tr>
                                        <tr>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Pre or Post Petition Priority Tax Claim Holder 2');?>" class="form-control "></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Pre or Post Petition Priority Tax Claim Holder 2 Claim Amount');?>" class="form-control price-field width_90percent"></p></td>
                                        </tr>   
                                    </table>
                                </div>
                                <p class="mb-2 mt-2">{{ __('(b) All other holders of priority claims listed below shall be paid in full as follows:') }}</p>
                                <div class=" table_sect table_sect_head_border">
                                    <table class="w-100">
                                        <tr>
                                            <th class="p-2 width_80percent">{{ __('Name') }}</th>
                                            <th class="p-2">{{ __('Amount of claim') }}</th>  
                                        </tr>
                                        <tr>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Priority Claim Holder 1');?>" class="form-control "></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Claim Amount for Priority Claim Holder 1');?>" class="form-control price-field width_90percent"></p></td>
                                        </tr>
                                        <tr>
                                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Priority Claim Holder 2');?>" class="form-control "></td>
                                            <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Claim Amount for Priority Claim Holder 2');?>" class="form-control price-field width_90percent"></p></td>
                                        </tr>   
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <div class="">
                        <label class="text-bold">C.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="text-bold mb-2">{{ __('SECURED CLAIMS:') }}</p>
                        <p>
                            <span class="text-bold">{{ __('(1) PRE-CONFIRMATION ADEQUATE PROTECTION:') }}</span> {{ __('Pre-confirmation adequate protection payments to the
                            following Creditors holding allowed claims secured by a purchase money security interest in personal property shall be paid
                            by the Trustee through the plan as provided below. Adequate protection payments shall not be paid until the Creditor files a
                            proof of claim, with proper proof of security attached.') }}
                        </p>
                        <div class=" table_sect table_sect_head_border pl-5 mb-3">
                            <table class="w-100">
                                <tr>
                                    <th class="p-2 width_40percent">{{ __('Name') }}</th>
                                    <th class="p-2 width_40percent">{{ __('Collateral Description') }}</th>
                                    <th class="p-2">Pre-Confirmation<br>{{ __('Monthly Payment') }}</th>
                                </tr>
                                <?php
                                    for ($k = 1 ; $k <= 3; $k++) {
                                        ?>
                                    <tr>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Allowed Secured Claim Holder Name '.$k);?>" class="form-control "></td>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Allowed Secured Claim '.$k.' Collateral Description');?>" class="form-control "></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Allowed Secured Claim '.$k.' PreConfirmation Monthly Payment');?>" class="form-control width_90percent price-field"></p></td>
                                    </tr> 
                                <?php
                                    }
            ?>
                            </table>
                        </div>
                        <p class="mb-2">
                            <span class="text-bold">{{ __('(2) SECURED DEBTS WHICH WILL NOT EXTEND BEYOND THE LENGTH OF THE PLAN:') }}</span>
                        </p>
                        <p class="pl-5"><span class="text-bold">{{ __('(a) SECURED CLAIMS NOT SUBJECT TO VALUATION:') }}</span> {{ __('Secured creditors with a purchase money security interest
                        securing a debt either incurred within the 910-day period preceding the filing of the bankruptcy petition where the collateral
                        is a motor vehicle acquired for personal use, or incurred within the 1-year period preceding the bankruptcy petition where
                        the collateral is any other thing of value, shall be paid in full with interest at the rate stated below. The amount stated on an
                        allowed proof of claim controls over any contrary amount listed below') }}</p>
                        <div class=" table_sect table_sect_head_border pl-5 mb-3">
                            <table class="w-100">
                                <tr>
                                    <th class="p-2 width_24percent">{{ __('Name') }}</th>
                                    <th class="p-2 width_30percent">{{ __('Collateral Description') }}</th>
                                    <th class="p-2">{{ __('Estimated Amount of Claim') }}</th>
                                    <th class="p-2">{{ __('Monthly Payment') }}</th>
                                    <th class="p-2 width_13percent">{{ __('Interest Rate') }}</th>
                                </tr>
                                <?php
                for ($k = 1 ; $k <= 3; $k++) {
                    ?>
                                    <tr>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Name '.$k.' Secured Claim Not Subject to Valuation');?>" class="form-control "></td>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode($k.' Secured Claim Not Subject to Valuation Collateral Description');?>" class="form-control "></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode($k.' Secured Claim Not Subject to Valuation Estimated Amount');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode($k.' Secured Claim Not Subject to Valuation Monthly Payment');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center"><input type="text" name="<?php echo base64_encode($k.' Secured Claim Not Subject to Valuation Interest Rate');?>" class="form-control width_80percent">%</p></td>
                                    </tr>
                                <?php
                }
            ?>
                            </table>
                        </div>
                        <p class="pl-5"><span class="text-bold">{{ __('(b) SECURED CLAIMS SUBJECT TO VALUATION:') }}</span> {{ __('All other secured creditors, except secured tax creditors, shall
                        be paid the proposed secured value with interest in the amounts stated below. To the extent the proposed secured value
                        exceeds the secured claim, only the claim amount, plus interest shall be paid. Secured tax claims shall be paid as filed
                        unless limited by separate Court Order.') }}<br>
                        {{ __('NOTE: The valuation of real estate requires the filing of a motion to determine value and the entry of a separate Court
                        Order before any proposed secured value of real estate stated below may be approved.') }}</p>
                        <div class=" table_sect table_sect_head_border pl-5 mb-3">
                            <table class="w-100">
                                <tr>
                                    <th class="p-2 width_24percent">{{ __('Name') }}</th>
                                    <th class="p-2 width_30percent">{{ __('Collateral Description') }}</th>
                                    <th class="p-2">{{ __('Proposed Secured Value') }}</th>
                                    <th class="p-2">{{ __('Monthly Payment') }}</th>
                                    <th class="p-2 width_13percent">{{ __('Interest Rate') }}</th>
                                </tr>
                                <?php
                for ($k = 1 ; $k <= 3; $k++) {
                    ?>
                                    <tr>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Name '.$k.' Secured Claim Subject to Valuation');?>" class="form-control "></td>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Secured Claim '.$k.' Subject to Valuation Collateral Description');?>" class="form-control "></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Secured Claim '.$k.' Proposed Secured Value');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Secured Claim '.$k.' Subject to Valuation Monthly Payment');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center"><input type="text" name="<?php echo base64_encode('Secured Claim '.$k.' Subject to Valuation Interest Rate');?>" class="form-control width_80percent">%</p></td>
                                    </tr>
                                <?php
                }
            ?>
                            </table>
                        </div>
                        <p class="mb-2">
                            <span class="text-bold">{{ __('(3) DEBTS SECURED BY PRINCIPAL RESIDENCE WHICH WILL EXTEND BEYOND THE LENGTH OF THE PLAN (LONG-TERM DEBTS):') }}</span>
                        </p>
                        <div class=" table_sect table_sect_head_border pl-5 mb-3">
                            <table class="w-100">
                                <tr>
                                    <th class="p-2 width_24percent">{{ __('Name') }}</th>
                                    <th class="p-2 width_14percent">{{ __('Collateral Description') }}</th>
                                    <th class="p-2">*Monthly Ongoing Pymt</th>
                                    <th class="p-2">*1<sup>st</sup> {{ __('Post-petition Payment') }}</th>
                                    <th class="p-2">*Estimated Amt of Arrearage</th>
                                    <th class="p-2 width_13percent">{{ __('Interest On Arrearage') }}</th>
                                </tr>
                                <?php
                for ($k = 1 ; $k <= 3; $k++) {
                    ?>
                                    <tr>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Name '.$k.' Long Term Debt Secured by Principal Residence');?>" class="form-control "></td>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Collateral Description Long Term Debt '.$k.' Secured by Principal Residence');?>" class="form-control "></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Long Term Debt '.$k.' Secured by Principal Residence Monthly Pymt');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Long Term Debt '.$k.' Secured by Principal Residence 1st PP Payment');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Long Term Debt '.$k.' Secured by Principal Residence Estimated Arrearage');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center"><input type="text" name="<?php echo base64_encode('Long Term Debt '.$k.' Secured by Principal Residence Interest on Arrearage');?>" class="form-control width_80percent">%</p></td>
                                    </tr>  
                                <?php
                }
            ?>
                            </table>
                        </div>
                        <p class="pl-5">*The “1<sup>st</sup> {{ __('post-petition payment” is the monthly ongoing mortgage payment which comes due between the petition date and the due date of
                        the first plan payment. The arrearage amounts, monthly ongoing payment, and 1') }}<sup>st</sup> {{ __('post-petition payment are estimated and will be paid 
                        according to the amount stated on the claim unless objected to and limited by separate Court Order. The interest rate to be paid on the
                        arrearage and the 1') }}<sup>st</sup> {{ __('post-petition payment is reflected above.') }}</p>
                        <p class="mb-2">
                            <span class="text-bold">{{ __('(4) OTHER SECURED DEBTS WHICH WILL EXTEND BEYOND THE LENGTH OF THE PLAN (LONG-TERM DEBTS):') }}</span>
                        </p>
                        <div class=" table_sect table_sect_head_border pl-5 mb-3">
                            <table class="w-100">
                                <tr>
                                    <th class="p-2 width_24percent">{{ __('Name') }}</th>
                                    <th class="p-2 width_14percent">{{ __('Collateral Description') }}</th>
                                    <th class="p-2">*{{ __('Monthly Ongoing Pymt') }}</th>
                                    <th class="p-2">*1<sup>st</sup> {{ __('Post-petition Payment') }}</th>
                                    <th class="p-2">*{{ __('Estimated Amt of Arrearage') }}</th>
                                    <th class="p-2 width_13percent">{{ __('Interest On Arrearage') }}</th>
                                </tr>
                                <?php
                for ($k = 1 ; $k <= 3; $k++) {
                    ?>
                                    <tr>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Name '.$k.' Other Long Term Secured Debt');?>" class="form-control "></td>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode($k.' Other Long Term Secured Debt Collateral Description');?>" class="form-control "></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode($k.' Other Long Term Secured Debt Ongoing Pymt');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode($k.' Other Long Term Secured Debt 1st PP Payment');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode($k.' Other Long Term Secured Debt Estimated Arrearage');?>" class="form-control width_90percent price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center"><input type="text" name="<?php echo base64_encode($k.' Other Long Term Secured Debt Interest on Arrearage');?>" class="form-control width_80percent">%</p></td>
                                    </tr>  
                                <?php
                }
            ?>
                            </table>
                        </div>
                        <p class="pl-5">* The “1<sup>st</sup> {{ __('post-petition payment” is the monthly ongoing payment which comes due between the petition date and the due date of the first
                        plan payment. The arrearage amounts, monthly ongoing payment, and 1') }}<sup>st</sup> {{ __('post-petition payment are estimated and will be paid according to
                        the amount stated on the claim unless objected to and limited by separate Court Order. The interest rate to be paid on the arrearage and the') }}
                        1<sup>st</sup> {{ __('post-petition payment is reflected above.') }}</p>
                    </div>
                </div>
                <div class="d-flex mt-3">
                    <div class="">
                        <label class="text-bold">D.</label>
                    </div>
                    <div class="pl-3 w-100">
                        <p class="text-bold mb-2">{{ __('UNSECURED CLAIMS:') }}</p>
                        <p>{{ __('(1) Special Nonpriority Unsecured claims shall be paid in full plus interest at the rate stated below, as follows:') }}</p>
                        <div class=" table_sect table_sect_head_border mb-3">
                            <table class="w-100">
                                <tr>
                                    <th class="p-2 width_60percent">{{ __('Name') }}</th>
                                    <th class="p-2">{{ __('Amount of Claim') }}</th>
                                    <th class="p-2">{{ __('Interest Rate') }}</th>
                                </tr>
                                <?php
                for ($k = 1 ; $k <= 3; $k++) {
                    ?>
                                    <tr>
                                        <td class="p-1"><input type="text" name="<?php echo base64_encode('Name '.$k.' Special Nonpriority Unsecured Claim Holder');?>" class="form-control "></td>
                                        <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode($k.' Special Nonpriority Unsecured Claim Amount');?>" class="form-control w-auto price-field"></p></td>
                                        <td class="p-1"><p class="mb-0 text-center"><input type="text" name="<?php echo base64_encode($k.' Special Nonpriority Unsecured Claim Interest Rate');?>" class="form-control width_80percent">%</p></td>
                                    </tr>
                                <?php
                }
            ?>
                            </table>
                        </div>
                        <p>
                            (2) {{ __('General Nonpriority Unsecured: Other unsecured creditors shall be paid pro-rata approximately') }} 
                            <input type="text" name="<?php echo base64_encode('Unsecured Prorata Creditor Percentage');?>" class="form-control width_5percent">
                            {{ __('percent, unless the
                            plan guarantees a set dividend as follows') }}
                        </p>
                        <p class="pl-4">
                        {{ __('Guaranteed dividend to non-priority unsecured creditors') }}: 
                            <input type="text" name="<?php echo base64_encode('Guaranteed Dividend to Nonpriority Unsecured Creditors');?>" class="form-control w-auto">
                            .
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label class="text-bold">6.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('DIRECT PAYMENTS BY DEBTOR:') }}</span>
                    {{ __('The Debtor shall make regular payments directly to the following creditors:') }}
                </p>
                <div class=" table_sect table_sect_head_border pl-5 mb-3">
                    <table class="w-100">
                        <tr>
                            <th class="p-2 width_30percent">{{ __('Name') }}</th>
                            <th class="p-2 width_20percent">{{ __('Amount of Claim') }}</th>
                            <th class="p-2 width_20percent">{{ __('Monthly Payment') }}</th>
                            <th class="p-2">{{ __('Collateral Description if Applicable') }}</th>
                        </tr>
                        <?php
                            for ($k = 1 ; $k <= 3; $k++) {
                                ?>
                            <tr>
                                <td class="p-1"><input type="text" name="<?php echo base64_encode('Creditor '.$k.' Receiving Direct Payment');?>" class="form-control "></td>
                                <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Direct Payment '.$k.' Claim Amount');?>" class="form-control width_90percent price-field"></p></td>
                                <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Direct Claim '.$k.' Monthly Payment');?>" class="form-control width_90percent price-field"></p></td>
                                <td class="p-1"><input type="text" name="<?php echo base64_encode('Direct Payment '.$k.' Collateral Description');?>" class="form-control "></td>
                            </tr>
                        <?php
                            }
            ?>
                    </table>
                </div>
                <p>{{ __('NOTE: Direct payment will be allowed only if the debtor is current on the obligation, the last payment on the obligation comes
                due after the last payment under this plan, and no unfair preference is created by the direct payment.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label class="text-bold">7.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('EXECUTORY CONTRACTS AND UNEXPIRED LEASES:') }}</span>
                    {{ __('The plan rejects all executory contracts and unexpired leases, except as follows:') }}
                </p>
                <div class=" table_sect table_sect_head_border pl-5 ">
                    <table class="w-100">
                        <tr>
                            <th class="p-2">{{ __('Name') }}</th>
                            <th class="p-2">{{ __('Description of Contract or Lease') }}</th>
                        </tr>
                        <tr>
                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Executory Contract Unexpired Lease Holder Name 1');?>" class="form-control "></td>
                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Description of Contract or Lease 1');?>" class="form-control "></td>
                        </tr>
                        <tr>
                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Executory Contract Unexpired Lease Holder Name 2');?>" class="form-control "></td>
                            <td class="p-1"><input type="text" name="<?php echo base64_encode('Description of Contract or Lease 2');?>" class="form-control "></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <label class="text-bold">8.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('SURRENDERED PROPERTY:') }}</span>
                    {{ __('The following property is to be surrendered to the secured creditor, with a deficiency allowed,
                    unless specified otherwise. The Debtor requests the automatic stay be terminated as to the surrendered collateral upon entry of
                    Order Confirming Plan or other Order of the Court.') }}
                </p>
                <div class=" table_sect table_sect_head_border pl-5 mb-3">
                    <table class="w-100">
                        <tr>
                            <th class="p-2">{{ __('Name') }}</th>
                            <th class="p-2 width_20percent">{{ __('Amount of Claim') }}</th>
                            <th class="p-2">{{ __('Collateral Description if Applicable') }}</th>
                        </tr>
                        <?php
                for ($k = 1 ; $k <= 4; $k++) {
                    ?>
                            <tr>
                                <td class="p-1"><input type="text" name="<?php echo base64_encode('Name of Holder of Property '.$k.' to be Surrendered');?>" class="form-control "></td>
                                <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Amount of Surrendered Property Claim '.$k);?>" class="form-control width_90percent price-field"></p></td>
                                <td class="p-1"><input type="text" name="<?php echo base64_encode('Collateral Description Surrendered Property '.$k);?>" class="form-control "></td>
                            </tr>
                        <?php
                }
            ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label class="text-bold">9.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('LIEN AVOIDANCE:') }}</span>
                    {{ __('No lien will be avoided by the confirmation of this plan. Liens may be avoided only by separate Court
                    Order, upon proper Motion including reasonable notice and opportunity for hearing.') }}
                </p>
                <p>{{ __('Liens Debtor intends to avoid:') }}</p>
                <div class=" table_sect table_sect_head_border pl-5 mb-3">
                    <table class="w-100">
                        <tr>
                            <th class="p-2">{{ __('Name') }}</th>
                            <th class="p-2 width_20percent">{{ __('Amount of Claim') }}</th>
                            <th class="p-2">{{ __('Collateral Description if Applicable') }}</th>
                        </tr>
                        <?php
                for ($k = 1 ; $k <= 4; $k++) {
                    ?>
                            <tr>
                                <td class="p-1"><input type="text" name="<?php echo base64_encode('Name '.$k.' Lien Holder to be Avoided');?>" class="form-control "></td>
                                <td class="p-1"><p class="mb-0 text-center">$ <input type="text" name="<?php echo base64_encode('Lien Claim '.$k.' Amount');?>" class="form-control width_90percent price-field"></p></td>
                                <td class="p-1"><input type="text" name="<?php echo base64_encode('Lien Claim '.$k.' Collateral Description');?>" class="form-control "></td>
                            </tr>
                        <?php
                }
            ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label class="text-bold">10.</label>
            </div>
            <div class="w-100 pl-4">
                <p class="p_justify mb-2">
                    <span class="text-bold mr-3">{{ __('NONSTANDARD PLAN PROVISIONS:') }}</span>
                    {{ __('Any nonstandard provision placed elsewhere in this plan is void.') }}
                </p>
                <p>{{ __('By checking this box certification is made by the Debtor, if not represented by an attorney, or the Attorney for Debtor, that the plan
                contains no nonstandard provision other than those set out in this paragraph.') }}</p>
                <textarea name="<?php echo base64_encode('Nonstandard Provisions');?>" class="form-control" rows="9"></textarea>
            </div>
        </div>
        <p class="mt-3">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check this box if Plan contains no nonstandard provisions other than those set out above');?>" value="Yes">
            {{ __('By checking this box certification is made by the Debtor, if not represented by an attorney, or the Attorney for Debtor, that the plan
            contains no nonstandard provision other than those set out in this paragraph.') }}
        </p>
    </div>

    <div class="col-md-5 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Debtor Signature Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-1 mt-3 pt-2">
        <label class=" float_right">{{ __('Signature') }}</label>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor Personal or Electronic Signature"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    
    <div class="col-md-5 mt-1">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Joint Debtor Signature Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-1 mt-1 pt-2">
        <label class=" float_right">{{ __('Signature') }}</label>
    </div>
    <div class="col-md-6 mt-1">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor"
            inputFieldName="Joint Debtor Personal or Electronic Signature"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-5 mt-1">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney Signature"
                inputFieldName="Attorney Personal or Electronic Signature"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney Name"
                inputFieldName="Attorney Typed Name"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Bar Number"
                inputFieldName="Attorney Bar Number"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Address"
                inputFieldName="Attorney Street Address"
                inputValue="{{$attonryAddress1}}, {{$attonryAddress2}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="City, State, Postal Code"
                inputFieldName="City State Postal Code"
                inputValue="{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Telephone Number"
                inputFieldName="Attorney Telephone Number"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Fax Number"
                inputFieldName="Attorney Fax Number"
                inputValue="{{$attorneyFax}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Email Address"
                inputFieldName="Attorney Email Address"
                inputValue="{{$attorney_email}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <label class="mt-1">{{ __('Attorney for Debtor(s)') }}</label>
    </div>
    


</div>