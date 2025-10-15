<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF CALIFORNIA') }}</h3>
        </div>
        <div class="col-md-6 mt-3">
            <p class="mb-0">{{ __('Name of Debtor:') }}</p>
            <textarea name="<?php echo base64_encode('Text1'); ?>" class="form-control" rows="3" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div>
        <div class="col-md-6 mt-3 d-flex">
            <label class="pt-2">{{ __('Case No.') }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Text3'); ?>"  placeholder="" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" class=" form-control">												
            </div>
        </div>
        <div class="col-md-6 mt-2 d-flex">
            <label class="pt-2">{{ __('Last four digits of Soc. Sec. No.:') }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2"></div>
        <div class="col-md-6 mt-2 d-flex">
            <label class="pt-2">{{ __('Last four digits of Soc. Sec. No.:') }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2"></div>
        <div class="col-md-12 mt-3 text-center">
            <h3>{{ __('CHAPTER 13 PLAN') }}</h3>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 1. Notices') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">1.01.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __('Notices') }}</p>
                <div class="d-flex">
                    <label class="text-bold">(a)</label>
                    <div class="pl-3">
                        <p><span class="text-bold">{{ __('Use of this form is mandatory.') }}</span> {{ __('The Bankruptcy Court of the Northern District of California requires the
                            use of this local form chapter 13 plan in lieu of any national form plan. Fed. R. Bankr. P. 3015.1.') }}</p>
                    </div>
                </div>
                <div class="d-flex">
                    <label class="text-bold">(b)</label>
                    <div class="pl-3">
                        <p><span class="text-bold">{{ __('Notice of specific plan provisions required by Fed.R.Bankr.P. 3015.1(c).') }}</span> {{ __('Any nonstandard provision
                            is in section 7 below.') }}</p>
                        <p> {{ __('If the plan proposes to limit the amount of a secured claim based on a valuation of the collateral for the
                            claim, this box must be checked') }} [<input name="<?php echo base64_encode('Check Box6'); ?>" value="Yes" type="checkbox">].</p>
                        <p> {{ __('If the plan proposes to avoid a security interest or lien, this box must be checked') }} [<input name="<?php echo base64_encode('Check Box7'); ?>" value="Yes" type="checkbox">].</p>
                        <p> {{ __('If there are nonstandard provisions, this box must be checked') }} [<input name="<?php echo base64_encode('Check Box8'); ?>" value="Yes" type="checkbox">{{ __(']. A nonstandard provision will be given
                            no effect unless this section indicates one is included in section 7 and it appears in section 7.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.02.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('No alterations to form plan permitted.') }}</span> {{ __('Other than to insert text into designated spaces, to expand tables to
                    include additional items, or to change the plan title to indicate the date of the plan or that it is a modified plan, the
                    preprinted text of this form shall not be altered. No such alteration will be given any effect.') }}</p>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.03.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Valuation of collateral and lien avoidance.') }}</span> {{ __('Unless otherwise provided in Section 7 below, as to non-governmental units, the confirmation of this plan will not limit the amount of a secured claim based on a valuation
                    of the collateral for the claim, nor will it avoid a security interest or lien. This relief requires a separate claim
                    objection, valuation motion or adversary proceeding, or lien avoidance motion, with supporting evidence, that is
                    successfully prosecuted in connection with the confirmation of this plan. Determining the amount of secured and
                    priority claims of governmental units, however, must be done in compliance with Fed.R.Bankr.P. 3012.') }}</p>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.04.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Confirmation of Plan.') }}</span> {{ __('In the absence of a timely written objection, the plan may be confirmed without a hearing.
                    It will be effective upon its confirmation.') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 2. Plan Payments and Plan Duration') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold pt-2">2.01.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Monthly plan payments.') }} </span>{{ __('To complete this plan, Debtor shall submit to the supervision and control of Trustee on
                    a monthly basis the sum of') }} $ &nbsp;<input name="<?php echo base64_encode('Text9'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto">
                    {{ __('from future earnings. This monthly plan payment is subject to
                    adjustment pursuant to section 3.07(b)(5) below and it must be received by Trustee not later than the 20th day of
                    each month beginning the month after the order for relief under chapter 13. The monthly plan payment includes
                    all adequate protection payments due on Class 2 secured claims.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">2.02.</label>
            <div class="pl-3">
                <p class="mb-0"><span class="text-bold">{{ __('Other payments.') }}</span> {{ __('In addition to the submission of future earnings, Debtor will make payment(s) derived from
                    property of the bankruptcy estate, property of Debtor, or from other sources, as follows:') }}</p>
                <textarea name="<?php echo base64_encode('Text10'); ?>" class="form-control" rows="3" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>

            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold pt-2">2.03.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Duration of payments.') }} </span>{{ __('The monthly plan payments will continue for') }} &nbsp;<input name="<?php echo base64_encode('Text11'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto">
                    {{ __('months unless all allowed unsecured
                    claims are paid in full within a shorter period of time. If necessary to complete the plan, monthly payments may
                    continue for an additional 6 months, but in no event may a plan be proposed and confirmed that exceeds 60
                    months. This section is to be read in conjunction with section 3.14.') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 3. Claims and Expenses') }}</label>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __('A. Proofs of Claim') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.01.</label>
            <div class="pl-3">
                <p>{{ __('With the exception of the payments required by sections 3.03, 3.07(b), 3.08(b), 3.10, and 4.01, a claim will not be
                    paid pursuant to this plan unless a proof of claim is filed by or on behalf of a creditor, including a secured creditor.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">3.02.</label>
            <div class="pl-3">
                <p>{{ __('The proof of claim, not this plan or the schedules, shall determine the amount and classification of a claim unless
                    the court’s disposition of a claim objection, valuation motion, adversary proceeding, confirmed plan, or lien
                    avoidance motion affects the amount or classification of the claim, consistent with section 1.03.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">3.03.</label>
            <div class="pl-3">
                <p>{{ __('Post-petition amounts due on account of a domestic support obligation, a loan from retirement or thrift savings
                    plan, or an executory contract/unexpired lease being assumed, shall be paid by Debtor directly to the person
                    entitled to such payments whether or not the plan is confirmed or a proof of claim has been filed.') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __('B. AdministrativeExpenses') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.04.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Trustee’s fees.") }} </span>{{ __('Pursuant to 28 U.S.C. § 586(e), Trustee shall retain up to 10% of plan payments, whether made
                    before or after confirmation, but excluding direct payments by Debtor provided for by the plan.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold pt-2">3.05.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Debtor’s attorney’s fees.') }} </span>{{ __('Debtor’s attorney was paid') }} $ &nbsp;<input name="<?php echo base64_encode('Text12'); ?>" type="text" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="price-field price-by-attorney form-control width_auto"> {{ __('prior to the filing of the case. Additional
                    fees of') }} $ &nbsp;<input name="<?php echo base64_encode('Text13'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> {{ __('shall be paid through this plan upon court approval. Debtor’s attorney will seek the
                    court’s approval by') }} <span class="text-bold text_italic">{{ __('[choose one]') }}</span>: <input name="<?php echo base64_encode('Check Box1'); ?>" value="Yes" type="checkbox"> {{ __('complying with General Order 35; or') }} <input name="<?php echo base64_encode('Check Box2'); ?>" value="Yes" type="checkbox"> {{ __('filing and serving a motion in
                    accordance with 11 U.S.C. §§ 329 and 330, Fed. R. Bankr. P. 2002, 2016, and 2017 [if neither alternative is
                    selected, the attorney shall comply with the latter]') }}.</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold pt-2">3.06.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Administrative expenses.') }} </span>{{ __('In accordance with sections 5.02 and 5.03 below') }}, $ &nbsp;<input name="<?php echo base64_encode('Text14'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> {{ __('of each monthly plan
                    payment shall be paid on account of: (a) compensation due a former chapter 7 trustee; (b) approved
                    administrative expenses; and (c) approved attorney’s fees. Approved administrative expenses shall be paid in full
                    through this plan except to the extent a claimant agrees otherwise or 11 U.S.C. § 1326(b)(3)(B) is applicable.') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __('C. Secured Claims') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.07.</label>
            <div class="pl-3 ">
                <p class="text-bold">{{ __('Class 1 includes all delinquent secured claims that mature after the completion of this plan, including
                    those secured by Debtor’s principal residence.') }}</p>
                <p><span class="text-bold">{{ __('(a) Cure of defaults.') }} </span>{{ __('All arrears on Class 1 claims shall be paid in full by Trustee. The monthly installments
                    specified in the table below as the “monthly arrearage dividend,” in conjunction with the distribution scheme in
                    section 5 of this plan, shall pay the arrears in full.') }}</p>
                <div class="pl-4">
                    <p><span class="text-bold">(1) &nbsp;</span>{{ __('Unless otherwise specified below, interest will accrue at the rate of 0%.') }}</p>
                    <p><span class="text-bold">(2) </span>{{ __('The arrearage dividend must be applied by the Class 1 creditor to the arrears. If this plan provides for
                        interest on the arrears, the arrearage dividend shall be applied first to such interest, then to the arrears.') }}</p>
                </div>
                <p><span class="text-bold">{{ __('(b) Maintaining payments.') }} </span>{{ __('From plan payments received, Trustee shall make all post-petition monthly payments
                    to the holder of each Class 1 claim whether or not this plan is confirmed or a proof of claim is filed.') }}</p>
                <div class="pl-4">
                    <p><span class="text-bold">(1) &nbsp;</span>{{ __('Unless sub-part (b)(1)(A)or(B) of this section is applicable, the amount of the post-petition monthly
                        payment shall be the amount specified in the plan.') }}</p>
                        <div class="pl-4">
                            <p><span class="text-bold">{{ __('(A)') }} &nbsp;</span>{{ __('If the amount specified in the plan is incorrect, the Class 1 creditor may demand the correct
                                amount in its proof of claim. Unless and until an objection to such proof of claim is sustained, the
                                trustee shall pay the payment amount demanded in the proof of claim.') }}</p>
                            <p><span class="text-bold">{{ __('(B)') }} </span>{{ __('Whenever the post-petition monthly payment amount is adjusted in accordance with the
                                underlying loan documentation, including changes resulting from an interest rate or escrow
                                account adjustment, the Class 1 creditor shall give notice of payment change pursuant to Fed. R.
                                Bankr. P. 3002.1(b). Notice of the change in a proof of claim is not sufficient. Until and unless an
                                objection to a notice of payment change is sustained, the trustee shall pay the amount demanded
                                in the notice of payment change.') }}</p>
                        </div>
                    <p><span class="text-bold">(2) </span>{{ __('If Debtor makes a partial plan payment that is insufficient to satisfy all post-petition monthly payments
                        due each Class 1 claim, distributions will be made in the order such claims are listed in the table below.') }}</p>
                    <p><span class="text-bold">(3) </span>{{ __('Trustee will not make a partial distribution on account of a post-petition monthly payment.') }}</p>
                    <p><span class="text-bold">(4) </span>{{ __('If Debtor makes a partial plan payment, or if it is not paid on time, and Trustee is unable to make timely
                        a post-petition monthly payment, Debtor may be obligated to pay a late charge.') }}</p>
                    <p><span class="text-bold">(5) </span>{{ __('If the holder of a Class 1 claim files a notice of payment change in accordance with Fed.R.Bankr.P.
                        3002.1(b) demanding a higher or lower post-petition monthly payment, the plan payment shall be adjusted
                        accordingly, without modification of the plan.') }}</p>
                    <p><span class="text-bold">(6) </span>{{ __('If the holder of a Class 1 claim gives Debtor and Trustee notice of post-petition fees, expenses, and
                        charges in accordance with Fed. R. Bankr. P. 3002.1(c), Debtor may modify this plan if Debtor wishes to
                        provide for such fees, expenses, and charges.') }}</p>
                    <p><span class="text-bold">(7) </span>{{ __('Post-petition monthly payments made by Trustee and received by the holder of a Class 1 claim shall
                        be applied as if the claim was current and no arrearage existed on the date the case was filed..') }}</p>
                </div>
                <p><span class="text-bold">{{ __('(C) No claim modification and lien retention.') }} </span>{{ __('Each Class 1 creditor shall retain its lien. Other than to cure
                    arrears, this plan does not modify Class 1 claims.') }}</p>
                <div class="table_sect mt-2">
                    <table class="text-center w-100 ">
                        <tr class="">
                            <td class="p-2">{{ __('Class 1 Creditor’s Name') }}/ <br>{{ __('Collateral Description') }}</td>
                            <td class="p-2">{{ __('Amount of Arrears') }}</td>
                            <td class="p-2">{{ __('Interest Rate on Arrears') }}</td>
                            <td class="p-2">{{ __('Monthly Arrearage Dividend') }}</td>
                            <td class="p-2">Monthly Arrearage Dividend Start Date <br> {{ __('(Start Date will be a specific month/year during the plan)') }} </td>
                            <td class="p-2">{{ __('Post-Petition Monthly Payment') }}</td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">1.</label><input name="<?php echo base64_encode('Text15'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text16'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text17'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text24'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text27'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text30'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text18'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text22'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text20'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text25'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text28'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text31'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">3.</label><input name="<?php echo base64_encode('Text19'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text23'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text21'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text26'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text29'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text32'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="2"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __('Total') }}&nbsp;$</label><input name="<?php echo base64_encode('Text34'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><div class="d-flex"><label class="p-2">$</label><input name="<?php echo base64_encode('Text33'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.08.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __('Class 2 includes all secured claims that are modified by this plan, or that have matured or will mature
                    before the plan is completed.') }}</p>
                <p><span class="text-bold">{{ __('(a) Payment of claim.') }} </span>{{ __('Subject to section 3.08(c), the “monthly dividend” payable to each Class 2A and 2B claim
                    is a monthly payment sufficient to pay each claim in full with interest at the rate specified below. If no interest rate
                    is specified, a 5% rate will be imputed.') }}</p>
                <p><span class="text-bold">{{ __('(b) Adequate protection payments.') }} </span>{{ __('Prior to confirmation and once a proof of claim is filed, Trustee shall pay on
                    account of each Class 2(A) and 2(B) claim secured by a purchase money security interest in personal property an
                    adequate protection payment if required by 11 U.S.C. § 1326(a)(1)(C). The adequate protection payment shall
                    equal the monthly dividend. Adequate protection payments shall be disbursed by Trustee in connection with the
                    customary disbursement cycle beginning the month after the case was filed. If a Class 2 claimant is paid an
                    adequate protection payment, that claimant shall not be paid a monthly dividend for the same month.') }}</p>
                <p><span class="text-bold">{{ __('(c) Claim amount.') }} </span>{{ __('The amount of a Class 2 claim is determined by applicable nonbankruptcy law. However,
                    except as noted below, Debtor may reduce the claim amount to the value of the collateral securing it by complying
                    with Section 1.03 above.') }}</p>
                <div class="pl-4">
                    <p><span class="text-bold">(1) &nbsp;{{ __('Class 2 claims that cannot be reduced based on value of collateral') }}</span>{{ __('Debtor is prohibited from
                        reducing a claim if the claim holder has a purchase money security interest and the claim either was
                        incurred within 910 days of the filing of the case and is secured by a motor vehicle acquired for the
                        personal use of Debtor, or was incurred within 1-year of the filing of the case and is secured by any other
                        thing of value. These claims must be included in Class 2(A).') }}</p>
                    <p><span class="text-bold">{{ __('(2) Class 2 claims that may be reduced based on the value of their collateral') }}</span>{{ __('shall be included in
                        Class 2(B) or 2(C) as is appropriate.') }}</p>
                    <p><span class="text-bold">{{ __('(3) Class 2 claims secured by Debtor’s principal residence.') }} </span>{{ __('Except as permitted by 11 U.S.C. §
                        1322(c), Debtor is prohibited from modifying the rights of a holder of a claim secured only by Debtor’s
                        principalresidence.') }}</p>
                </div>
                <p><span class="text-bold">{{ __('(d) Lien retention.') }} </span>{{ __('Each Class 2 creditor shall retain its existing lien on the property interest of the Debtor or the
                    Estate until the earlier of: (a) payment of the underlying debt determined under nonbankruptcy law, or (b)
                    completion of the plan and, unless not required by the bankruptcy court, entry of Debtor’s discharge under 11
                    U.S.C. § 1328.') }}</p>
                <div class="table_sect mt-2">
                    <table class="text-center w-100 ">
                        <tr class="">
                            <td class="p-2">{{ __('Class 2(A) Creditor’s name and description of collateral') }}</td>
                            <td class="p-2">Purchase money security interest in personal property? <br>{{ __('YES/NO') }}</td>
                            <td class="p-2">{{ __('Amount claimed by creditor') }}</td>
                            <td class="p-2">{{ __('Value of creditor’s interest in its collateral') }}</td>
                            <td class="p-2">{{ __('Interest Rate') }}</td>
                            <td class="p-2">{{ __('Monthly Dividend') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __('Class 2(A) claims are not reduced based on value of collateral') }}</td>
                            <td class="p-2 bg-dgray" colspan="5"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text35'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text42'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text46'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('Text56'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text62'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text36'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text43'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text47'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('Text57'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text63'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="4"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __('Total') }}&nbsp;$</label><input name="<?php echo base64_encode('Text64'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
                <div class="table_sect mt-3">
                    <table class="text-center w-100 ">
                        <tr class="">
                            <td class="p-2">{{ __('Class 2(B) Creditor’s name and description of collateral') }}</td>
                            <td class="p-2">Purchase money security interest in personal property? <br>{{ __('YES/NO') }}</td>
                            <td class="p-2">{{ __('Amount claimed by creditor') }}</td>
                            <td class="p-2">{{ __('Value of creditor’s interest in its collateral') }}</td>
                            <td class="p-2">{{ __('Interest Rate') }}</td>
                            <td class="p-2">{{ __('Monthly Dividend') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __('Class 2(B) claims are reduced to an amount greater than $0 based on value of collateral') }}</td>
                            <td class="p-2 bg-dgray" colspan="5"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text38'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text44'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text48'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text52'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text58'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text65'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text39'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Text45'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text49'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text53'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text59'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text66'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="4"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __('Total') }}&nbsp;$</label><input name="<?php echo base64_encode('Text67'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
                <div class="table_sect mt-3">
                    <table class="text-center w-100 ">
                        <tr class="">
                            <td class="p-2">{{ __('Class 2(C) Creditor’s name and description of collateral') }}</td>
                            <td class="p-2">{{ __('Purchase money security interest in personal property?') }} <br>{{ __('YES/NO') }}</td>
                            <td class="p-2">{{ __('Amount claimed by creditor') }}</td>
                            <td class="p-2">{{ __('Value of creditor’s interest in its collateral') }}</td>
                            <td class="p-2">{{ __('Interest Rate') }}</td>
                            <td class="p-2">{{ __('Monthly Dividend') }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __('Class 2(C) are claims reduced to $0 based on value of collateral') }}</td>
                            <td class="p-2 bg-dgray" colspan="5"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text40'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('Text50'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text54'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="$0.00"></td>
                            <td><input name="<?php echo base64_encode('Text60'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="0%"></td>
                            <td><input name="<?php echo base64_encode('Text68'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="$0.00"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text41'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('Text51'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Text55'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="$0.00"></td>
                            <td><input name="<?php echo base64_encode('Text61'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="0%"></td>
                            <td><input name="<?php echo base64_encode('Text69'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="$0.00"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="4"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __('Total') }}&nbsp;$</label><input name="<?php echo base64_encode('Text70'); ?>" type="text" value="<?php echo ''; ?>" placeholder="$0.00" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.09.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __('Class 3 includes all secured claims satisfied by the surrender of collateral.') }}</p>
            </div>
        </div>
        <div class="col-md-12 table_sect mt-2">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __('Class 3 Creditor’s Name/Collateral Description') }} </td>
                    <td class="p-2">{{ __('Estimated Deficiency') }}</td>
                    <td class="p-2">{{ __('Is Deficiency a Priority Claim?') }} <br>{{ __('YES/NO') }}</td>
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text73'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text75'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text77'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text83'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text76'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text78'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.10.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Class 4 includes all secured claims paid directly by Debtor or third party.') }}</span>{{ __('Class 4 claims are not in default
                    and are not modified by this plan. These claims shall be paid by Debtor or a third person whether or not a proof of
                    claim is filed or the plan is confirmed.') }}</p>
            </div>
        </div>
        <div class="col-md-12 table_sect mt-2">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __('Class 4 Creditor’s Name/Collateral Description') }}</td>
                    <td class="p-2">{{ __('Monthly Contract Installment') }}</td>
                    <td class="p-2">{{ __('Person Making Payment') }}</td>
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text79'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text84'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text88'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text80'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text85'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text89'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">{{ __('3.') }}&nbsp;</label><input name="<?php echo base64_encode('Text81'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text86'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text90'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">4.</label><input name="<?php echo base64_encode('Text82'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text87'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text91'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.11.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __('Bankruptcy stays.') }}</p>
                <p><span class="text-bold">{{ __('(a)') }} </span>{{ __('Upon confirmation of the plan, the automatic stay of 11 U.S.C. § 362(a) and the co-debtor stay of 11 U.S.C.
                    § 1301(a) are (1) terminated to allow the holder of a Class 3 secured claim to exercise its rights under non-bankruptcy law against its collateral; and (2) modified to allow the nondebtor party to an unexpired lease that is in
                    default and rejected in section 4 of this plan to obtain possession of leased property, and to dispose of it under
                    applicable law, and to exercise its rights against any nondebtor.') }}</p>
                <p><span class="text-bold">{{ __('(b)') }} </span>{{ __('Secured claims not listed as Class 1, 2, 3, or 4 claims are not provided for by this plan. While this may be
                    cause to terminate the automatic stay, such relief must be separately requested by the claim holder.') }}</p>
                <p><span class="text-bold">{{ __('(c)') }} </span>{{ __('If, after confirmation of the plan, the court grants a motion to terminate the automatic stay to permit a Class 1 or
                    2 claim holder to proceed against its collateral, unless the court orders otherwise, Trustee shall make no further
                    payments on account of such claim and any portion of such claim not previously satisfied under this plan shall be
                    satisfied as a Class 3 claim. Any deficiency remaining after the creditor’s disposition of its collateral shall be
                    satisfied as a Class 7 unsecured claim subject to the filing of a proof of claim.') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __('D. Unsecured Claims') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.12.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __('Class 5 consists of unsecured claims entitled to priority pursuant to 11 U.S.C. § 507.') }}</p>
                <p><span class="text-bold">{{ __('(a) Domestic support obligations entitled to priority pursuant to 11 U.S.C. § 507.') }} </span>{{ __('These claims will be paid in
                    full except to the extent the claim holder has agreed to accept less or 11 U.S.C. § 1322(a)(4) is applicable. When
                    the claim holder has agreed to accept less than payment in full or when 11 U.S.C. § 1322(a)(4) is applicable, the
                    claim holder and the treatment of the claim shall be specified in section 7, the Nonstandard Provisions.') }}</p>
                <p><span class="text-bold">{{ __('(b) Taxes, and other priority claims entitled to priority pursuant to 11 U.S.C. § 507.') }} </span>{{ __('These claims will be paid
                    in full except to the extent the claim holder has agreed to accept less. When the claim holder has agreed to accept
                    less than payment in full, the claim holder and the treatment of the claim shall be specified in section 7, the
                    Nonstandard Provisions.') }}&nbsp;<input name="<?php echo base64_encode('Text6'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto"></p>
                <p><span class="text-bold">{{ __('(c) Estimate of priority claims pursuant to 11 U.S.C. § 507.') }} </span>Debtor estimates that all priority claims, not
                    including those identified in section 7, total $ &nbsp;<input name="<?php echo base64_encode('Text92'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto">.</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">3.13.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Class 6 includes designated nonpriority unsecured claims,') }} </span>{{ __('such as co-signed unsecured debts, that will be
                    treated differently than the other nonpriority unsecured claims provided for in Class 7. The claim holder of each
                    Class 6 claim and the treatment of each claim shall be specified in section 7, the Nonstandard Provisions.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold pt-2">3.14.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __('Class 7 consists of all other nonpriority unsecured claims') }} </span>{{ __('not provided for in Class 6. These claims total
                    approximately') }} $ &nbsp;<input name="<?php echo base64_encode('TextBox0'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto">{{ __('. Class 7 creditors shall be paid on a pro-rata basis by the Trustee from the funds
                    remaining after the Trustee pays the administrative expenses and other claims provided for in this plan.') }}</p>
                <label class="text-bold">{{ __('[select one of the following options:]') }}</label>
                <p class="mt-2"><input name="<?php echo base64_encode('Check Box93'); ?>" type="checkbox" value="Yes"><span class="text-bold">{{ __('Percent Plan.') }} </span>
                {{ __('Class 7 claimants will receive no less than') }} <input name="<?php echo base64_encode('Text95'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto">
                    {{ __('% of their allowed claims through this plan') }}</p>
                <p><input name="<?php echo base64_encode('Check Box94'); ?>" type="checkbox" value="Yes"><span class="text-bold">{{ __('Pot Plan.') }} </span>
                {{ __('Class 7 claimants are estimated to receive') }} <input name="<?php echo base64_encode('Text96'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto">
                    {{ __('% of their allowed claims through this plan') }}</p>
                <p>{{ __('This section is to be read in conjunction with section 2.03') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 4. Executory Contracts And Unexpired Leases') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">4.01.</label>
            <div class="pl-3">
                <p>{{ __('Debtor assumes the executory contracts and unexpired leases listed below. Debtor shall directly pay all post-petition monthly lease or contract payments to the other party to the executory contract or unexpired lease.
                    Unless otherwise permitted under the Bankruptcy Code or Section 7 herein, pre-petition arrears shall be fully
                    paid. Trustee shall pay the monthly arrearage dividend specified in the table below') }}</p>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __('Name of Other Party to Executory Contract/ Unexpired Lease') }}</td>
                    <td class="p-2">{{ __('Post-Petition Monthly Payment') }}</td>
                    <td class="p-2">{{ __('Pre-petition Arrears') }}</td>
                    <td class="p-2">{{ __('Monthly Arrearage Dividend') }}</td>
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text97'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text101'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text103'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text105'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text98'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text102'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text104'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Text106'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2 bg-dgray" colspan="2"></td>
                    <td colspan="2"><div class="d-flex"><label class="p-2">{{ __('Total') }}&nbsp;$</label><input name="<?php echo base64_encode('Text107'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">4.02.</label>
            <div class="pl-3">
                <p>{{ __('Debtor rejects the executory contracts and unexpired leases listed below. Any executory contract or unexpired
                    lease not listed in section 4.01 or section 4.02 is rejected.') }}</p>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __('Name of Other Party to Executory Contract/ Unexpired Lease') }}</td>
                    <td class="p-2">{{ __('Description of Executory Contract/Unexpired Lease') }}</td>  
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Text99'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text108'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Text100'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Text109'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 5. Payment of Claims and Order of Distribution') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">5.01.</label>
            <div class="pl-3">
                <p>{{ __('After confirmation, payments by Trustee to holders of allowed claims and approved expenses will be made monthly') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">5.02.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __('Distribution of plan payment by Trustee.') }} </span> {{ __('Debtor’s monthly plan payment must be sufficient to pay in full') }}: <span class="text-bold">{{ __('(a)') }} </span>
                {{ __("Trustee’s fees") }}; <span class="text-bold">{{ __('(b)') }} </span> {{ __('post-petition monthly payments due on Class 1 claims') }}; <span class="text-bold">{{ __('(c)') }} </span> {{ __('the monthly dividend specified in
                    section 3.06 for administrative expenses; and') }} <span class="text-bold">{{ __('(d)') }} </span> {{ __('the monthly dividends payable on account of Class 1 arrearage
                    claims, Class 2 claims, and executory contract and unexpired lease arrearage claims.') }}</p>
                <p>{{ __('If Debtor tenders a partial monthly plan payment to Trustee, Trustee shall pay, to the extent possible, such fees,
                    expenses, and claims in the order specified in (a) through (d) above. If the amount paid by Debtor, however, is
                    insufficient to pay all dividends due on account of fees, payments, expenses, and claims within a subpart of
                    section 5.02(a) through (d), no dividend shall be paid on account of any of the fees, payments, expenses, and
                    claims within such subpart, except as permitted by section 3.07(b)(2) and (3).') }}</p>
                <p>{{ __('Once a monthly plan payment, or a portion thereof, is not needed to pay a monthly dividend because a fee,
                    expense, or claim is not allowed or has been paid in full, such plan payment shall be paid pro rata, based on claim
                    balance, to holders of:') }} <span class="text-bold">{{ __('first') }} </span>, {{ __('section 3.06 administrative expenses;') }} <span class="text-bold">{{ __('second') }} </span>, {{ __('Class 1 arrearage claims, Class 2
                    claims, and executory contract and unexpired lease arrearage claims') }}; <span class="text-bold">{{ __('third') }} </span>, {{ __('Class 5 priority claims') }}; <span class="text-bold">{{ __('fourth') }} </span>, {{ __('Class
                    6 unsecured claims; and') }} <span class="text-bold">{{ __('fifth') }} </span>{{ __(', Class 7 unsecured claims. Over the plan’s duration, these distributions must equal
                    the total dividends required by sections 3.04, 3.06, 3.07, 3.08, 3.12, 3.13, 3.14, and 4.01.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">5.03.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __('Priority of payment among administrative expenses.') }} </span> {{ __('The portion of the monthly plan payment allocated in
                    section 3.06 for administrative expenses, shall be distributed first to any former chapter 7 trustee up to the monthly
                    amount required by 11 U.S.C. § 1326(b)(3)(B), and second, to holders of approved administrative expenses on a
                    pro rata basis.') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 6. Miscellaneous Provisions') }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">6.01.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __('Vesting of property.') }} </span> {{ __('Property of the estate will revest in Debtor upon confirmation unless Debtor checks the 
                    following box') }}: <input name="<?php echo base64_encode('Check Box110'); ?>" value="Yes" type="checkbox"> {{ __('SHALL NOT REVEST') }}</p>
                <p>{{ __('If the property of the estate does not revest in Debtor, Trustee is not required to file income tax returns for the estate
                    or insure any estate property. Upon dismissal or completion of this plan, all property shall revest in Debtor.
                    Notwithstanding the revesting of property in Debtor, the court will retain its supervisory role post-confirmation to
                    enforce Fed. R. Bankr. P. 3002.1 and provide any other relief necessary to effectuate this plan and the orderly
                    administration of this case.') }}</p>
                <p>{{ __('After the property revests in Debtor, Debtor may sell, refinance or execute a loan modification regarding real or
                    personal property without further order of the court with the approval of Trustee.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">6.02.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __('Remedies upon default.') }} </span> {{ __('If Debtor defaults under this plan, Trustee or any other party in interest may request
                    appropriate relief by filing a motion pursuant to Local Bankruptcy Rule 9014-1, et seq. This relief may consist of,
                    without limitation, dismissal of the case, conversion of the case to chapter 7, or relief from the automatic stay to
                    pursue rights against collateral. This is without prejudice to Debtor’s right to seek plan modification under 11
                    U.S.C. § 1329.') }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">6.03.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __('Impermissible Provisions.') }} </span> {{ __('Notwithstanding any other term in this plan, Debtor does not seek through the
                    confirmation and completion of this plan either a determination of the dischargability of any debt or the discharge
                    of any debt that is non-dischargable as a matter of law in a Chapter 13 case under 11 U.S.C. § 1328(a)') }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __('Section 7. Nonstandard Provisions') }}</label>
        </div>
        <div class="col-md-12 mt-3">
            <p>{{ __('Debtor may propose nonstandard provisions that modify the preprinted text of this form plan. All nonstandard plan
                provisions shall be set forth below, or on a separate page(s) appended to this plan. Each such provision shall be identified
                by a section number beginning with section 7.01 and indicate which section(s) of the form plan are modified by it.
                Nonstandard provisions placed elsewhere in the plan are void. The signatures below are certifications by Debtor and
                Debtor’s attorney that this plan form has not been altered and that all nonstandard provisions are in section 7 and
                appended to this plan') }}</p>
        </div>
        <div class="col-md-6 mt-3 d-flex">
            <label class="pt-2">{{ __('Dated:') }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Text111'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <input name="<?php echo base64_encode('Text113'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('Debtor') }}</label>
            <input name="<?php echo base64_encode('Text114'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control mt-2">
            <label>{{ __('Debtor') }}</label>
        </div>
        <div class="col-md-6 mt-2 d-flex">
            <label class="pt-2">{{ __('Dated:') }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Text112'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2">
            <input name="<?php echo base64_encode('Text115'); ?>" value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
            <label>{{ __('Debtor’s Attorney') }}</label>
        </div>


    </div>
</div>
