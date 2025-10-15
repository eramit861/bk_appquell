<div class="container">
    <div class="row">
        <div class="col-md-12 text-center ">
            <h3>{{ __("UNITED STATES BANKRUPTCY COURT") }}<br>{{ __("EASTERN DISTRICT OF CALIFORNIA") }}</h3>
        </div>
        <div class="col-md-6 mt-3 ">
            <p class="mb-0">{{ __("Name of Debtor:") }}</p>
            <textarea name="<?php echo base64_encode('Names'); ?>" class="form-control" rows="3" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
        </div>
        <div class="col-md-6 mt-3  d-flex">
            <label class="pt-2">{{ __("Case No.") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('CaseNo'); ?>"  placeholder="" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" class=" form-control">												
            </div>
        </div>
        <div class="col-md-6 mt-2  d-flex">
            <label class="pt-2">Last four digits of Soc. Sec. No.: <span class="ml-3">&nbsp;</span> {{ __("XXX-XX-") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('DB SSN Fill'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2 "></div>
        <div class="col-md-6 mt-2  d-flex">
            <label class="pt-2">{{ __("Last four digits of Soc. Sec. No.") }}: <span class="ml-3">&nbsp;</span> {{ __("XXX-XX-") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('JDB SSN Fill'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-6 mt-2 "></div>
        <div class="col-md-5 mt-2 "></div>
        <div class="col-md-2 mt-2 ">
            <select name="<?php echo base64_encode('AmdDropdown'); ?>" class="form-control">
                <option value=""></option>
                <option name="<?php echo base64_encode('AmdDropdown'); ?>" value="FIRST AMENDED" >{{ __("FIRST AMENDED") }}</option>
                <option name="<?php echo base64_encode('AmdDropdown'); ?>" value="SECOND AMENDED" >{{ __("SECOND AMENDED") }}</option>
                <option name="<?php echo base64_encode('AmdDropdown'); ?>" value="THIRD AMENDED" >{{ __("THIRD AMENDED") }}</option>
                <option name="<?php echo base64_encode('AmdDropdown'); ?>" value="FOURTH AMENDED" >{{ __("FOURTH AMENDED") }}</option>
            </select>
        </div>
        <div class="col-md-5 mt-2 "></div>
        <div class="col-md-12 mt-3  text-center ">
            <h3>{{ __("CHAPTER 13 PLAN") }}</h3>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __("Section 1. Notices") }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">1.01.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Use of this form is mandatory.") }}</span>{{ __("The Bankruptcy Court of the Eastern District of California requires the use of this
                    local form chapter 13 plan in lieu of any national form plan. This Plan shall be filed as a separate document.") }}</p>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.02.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Nonstandard provisions.") }}</span> {{ __("Any nonstandard provision is in section 7 below. If there are nonstandard provisions
                    this box must be checked") }} <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes" type="checkbox">{{ __(". A nonstandard provision will be given no effect unless this section indicates one is
                    included in section 7 and it appears in section 7.") }}</p>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.03.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("No alterations to form plan permitted.") }}</span> {{ __("Other than to insert text into designated spaces, expand tables to
                    include additional claims, or to change the plan title to indicate the date of the plan or that it is a modified plan, the
                    preprinted text of this form shall not be altered. No such alteration will be given any effect.") }}</p>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.04.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Valuation of collateral and lien avoidance requires a separate motion.") }}</span> {{ __("Unless there is a nonstandard
                    provision in section 7 requesting such relief, the confirmation of this plan will not limit the amount of a secured
                    claim based on a valuation of the collateral for the claim, nor will it avoid a security interest or lien. This relief
                    requires a separate claim objection, valuation motion, or lien avoidance motion that is successfully prosecuted in
                    connection with the confirmation of this plan.") }}</p>
            </div>
        </div>
        <div class="col-md-12  d-flex">
            <label class="text-bold">1.05.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Separate notice of confirmation hearing.") }}</span> {{ __("You will receive a separate notice of the date, time, and location of a
                    hearing to confirm this plan and of the deadline to object to its confirmation. In the absence of a timely written
                    objection, the plan may be confirmed without a hearing. It will be effective upon its confirmation.") }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __("Section 2. Plan Payments and Plan Duration") }} </label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold pt-2">2.01.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Monthly plan payments.") }} </span>{{ __("To complete this plan, Debtor shall submit to the supervision and control of Trustee on
                    a monthly basis the sum of") }} $ &nbsp;<input name="<?php echo base64_encode('from future earnings  This monthly plan payment is subject to'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto">
                    {{ __("from future earnings. This monthly plan payment is subject to
                    adjustment pursuant to section 3.07(b)(2) below and it must be received by Trustee not later than the 25th day of
                    each month beginning the month after the order for relief under chapter 13. The monthly plan payment includes
                    all adequate protection payments due on Class 2 secured claims.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">2.02.</label>
            <div class="pl-3">
                <p class="mb-0"><span class="text-bold">{{ __("Other payments.") }}</span> {{ __("In addition to the submission of future earnings, Debtor will make payment(s) derived from
                    property of the bankruptcy estate, property of Debtor, or from other sources, as follows:") }}</p>
                <textarea name="<?php echo base64_encode('undefined'); ?>" class="form-control" rows="1" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>

            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold pt-2">2.03.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Duration of payments.") }} </span>{{ __("The monthly plan payments will continue for") }} &nbsp;<input name="<?php echo base64_encode('months unless all allowed unsecured'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto">
                {{ __("months unless all allowed unsecured
                claims are paid in full within a shorter period of time. If necessary to complete the plan, monthly payments may
                continue for an additional 6 months, but in no event shall monthly payments continue for more than 60 months.") }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __("Section 3. Claims and Expenses") }}</label>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __("A. Proofs of Claim") }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.01.</label>
            <div class="pl-3">
                <p>{{ __("With the exception of the payments required by sections 3.03, 3.07(b), 3.10, and 4.01, a claim will not be
                    paid pursuant to this plan unless a proof of claim is filed by or on behalf of a creditor, including a secured creditor.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">3.02.</label>
            <div class="pl-3">
                <p>{{ __("The proof of claim, not this plan or the schedules, shall determine the amount and classification of a claim unless
                    the court’s disposition of a claim objection, valuation motion, or lien avoidance motion affects the amount or
                    classification of the claim.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">3.03.</label>
            <div class="pl-3">
                <p>{{ __("Post-petition amounts due on account of a domestic support obligation, a loan from retirement or thrift savings
                    plan, or an executory contract/unexpired lease being assumed, shall be paid by Debtor directly to the person
                    entitled to such payments whether or not the plan is confirmed or a proof of claim has been filed.") }} </p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __("B. AdministrativeExpenses") }} </label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.04.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Trustee’s fees.") }} </span>{{ __("Pursuant to 28 U.S.C. § 586(e), Trustee shall receive up to 10% of plan payments, whether made
                    before or after confirmation, but excluding direct payments by Debtor on Class 4 claims, executory contracts and
                    unexpired leases, and obligations of the kind described in section 3.03.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold pt-2">3.05.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Debtor’s attorney’s fees.") }} </span>{{ __("Debtor’s attorney was paid") }} $ &nbsp;<input name="<?php echo base64_encode('shall be paid through this plan  Debtors attorney will'); ?>" type="text" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="price-field price-by-attorney form-control width_auto"> {{ __("prior to the filing of the case. Subject to
                    prior court approval, additional fees of") }} $ &nbsp;<input name="<?php echo base64_encode('seek the courts approval by choose one  0 complying with Local Bankruptcy Rule 20161c or 0  filing and'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> {{ __("shall be paid through this plan. Debtor’s attorney will
                    seek the court’s approval by") }} <span class="text-bold text_italic">{{ __("[choose one]") }}</span>: <input name="<?php echo base64_encode('Check Box4'); ?>" value="Yes" type="checkbox"> {{ __("complying with Local Bankruptcy Rule 2016-1(c); or") }} <input name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" type="checkbox"> {{ __("filing and
                    serving a motion in accordance with 11 U.S.C. §§ 329 and 330, Fed. R. Bankr. P. 2002, 2016, and 2017 [if neither
                    alternative is selected, the attorney shall comply with the latter]") }}.</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold pt-2">3.06.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Administrative expenses.") }} </span>{{ __("In accordance with sections 5.02 and 5.03 below") }}, $ &nbsp;<input name="<?php echo base64_encode('payment shall be paid on account of a compensation due a former chapter 7 trustee b approved'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> {{ __("of each monthly plan
                    payment shall be paid on account of: (a) compensation due a former chapter 7 trustee; (b) approved
                    administrative expenses; and (c) approved attorney’s fees. Approved administrative expenses shall be paid in full
                    through this plan except to the extent a claimant agrees otherwise or 11 U.S.C. § 1326(b)(3)(B) is applicable.") }} </p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __("C. Secured Claims") }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.07.</label>
            <div class="pl-3 ">
                <p class="text-bold">{{ __("Class 1 includes all delinquent secured claims that mature after the completion of this plan, including
                    those secured by Debtor’s principal residence.") }}</p>
                <p><span class="text-bold">{{ __("(a) Cure of defaults.") }} </span>{{ __("All arrears on Class 1 claims shall be paid in full by Trustee. The equal monthly installment
                    specified in the table below as the “arrearage dividend” shall pay the arrears in full") }}</p>
                <div class="pl-4">
                    <p><span class="text-bold">(1) &nbsp;</span>{{ __("Unless otherwise specified below, interest will accrue at the rate of 0%.") }}</p>
                    <p><span class="text-bold">(2) </span>{{ __("The arrearage dividend must be applied by the Class I creditor to the arrears. If this plan provides for
                        interest on the arrears, the arrearage dividend shall be applied first to such interest, then to the arrears.") }}</p>
                </div>
                <p><span class="text-bold">{{ __("(b) Maintaining payments.") }} </span>{{ __("Trustee shall maintain all post-petition monthly payments to the holder of each Class
                    1 claim whether or not this plan is confirmed or a proof of claim is filed.") }}</p>
                <div class="pl-4">
                    <p><span class="text-bold">(1) &nbsp;</span>{{ __("Unless subpart (b)(1)(A) or (B) of this section is applicable, the amount of a post-petition monthly
                        payment shall be the amount specified in this plan.") }}</p>
                        <div class="pl-4">
                            <p><span class="text-bold">{{ __("(A)") }} &nbsp;</span>{{ __("If the amount specified in the plan is incorrect, the Class 1 creditor may demand the correct
                                amount in its proof of claim. Unless and until an objection to such proof of claim is sustained, the
                                trustee shall pay the payment amount demanded in the proof of claim.") }}</p>
                            <p><span class="text-bold">{{ __("(B)") }} </span>{{ __("Whenever the post-petition monthly payment is adjusted in accordance with the underlying
                                loan documentation, including changes resulting from an interest rate or escrow account
                                adjustment, the Class 1 creditor shall give notice of the payment change pursuant to Fed. R.
                                Bankr. P. 3002.1(b). Notice of the change shall not be given by including the change in a proof of
                                claim. Unless and until an objection to a notice of payment change is sustained, the trustee shall
                                pay the amount demanded in the notice of payment change.") }}</p>
                        </div>
                    <p><span class="text-bold">(2) </span>{{ __("If a Class 1 creditor files a proof of claim or a notice of payment change pursuant to Fed. R. Bankr. P.
                        3002.1(b) demanding a higher or lower post-petition monthly payment, the plan payment shall be adjusted
                        accordingly.") }}</p>
                    <p><span class="text-bold">(3) </span>{{ __("If Debtor makes a partial plan payment that is insufficient to satisfy all post-petition monthly payments
                        due each Class 1 claim, distributions will be made in the order such claims are listed below.") }}</p>
                    <p><span class="text-bold">(4) </span>{{ __("Trustee will not make a partial distribution on account of a post-petition monthly payment.") }}</p>
                    <p><span class="text-bold">(5) </span>{{ __("If Debtor makes a partial plan payment, or if it is not paid on time, and Trustee is unable to make
                        timely a post-petition monthly payment, Debtor’s cure of this default shall include any late charge.") }}</p>
                    <p><span class="text-bold">(6) </span>{{ __("If the holder of a Class 1 claim gives Debtor and Trustee notice of post-petition fees, expenses, and
                        charges pursuant to Fed. R. Bankr. P. 3002.1(c), Debtor shall modify this plan if Debtor wishes to provide
                        for such fees, expenses, and charges.") }}</p>
                    <p><span class="text-bold">(7) </span>{{ __("Post-petition monthly payments made by Trustee and received by the holder of a Class 1 claim shall
                        be applied as if the claim was current and no arrearage existed on the date the case was filed.") }}</p>
                </div>
                <p><span class="text-bold">{{ __("(C) No claim modification and lien retention.") }} </span>{{ __("Each Class 1 creditor shall retain its lien. Other than to cure of
                    arrears, this plan does not modify Class 1 claims.") }}</p>
                <div class="table_sect mt-2">
                    <table class="text-center w-100 ">
                        <tr class="">
                            <td class="p-2">Class 1 Creditor’s Name/ <br>{{ __("Collateral Description") }}</td>
                            <td class="p-2">{{ __("Amount of Arrears") }}</td>
                            <td class="p-2">{{ __("Interest Rate on Arrears") }}</td>
                            <td class="p-2">{{ __("Arrearage Dividend") }}</td>
                            <td class="p-2">{{ __("Post-Petition Monthly Payment") }}</td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">1.</label><input name="<?php echo base64_encode('Class1cred1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Amount of Arrears1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Interest Rate on Arrears1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Arrearage Dividend1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('PostPetition Monthly Payment1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Class1cred2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Amount of Arrears2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Interest Rate on Arrears2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Arrearage Dividend2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('PostPetition Monthly Payment2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">3.</label><input name="<?php echo base64_encode('Class1cred3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Amount of Arrears3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Interest Rate on Arrears3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Arrearage Dividend3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('PostPetition Monthly Payment3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">4.</label><input name="<?php echo base64_encode('Class1cred4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('Amount of Arrears4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Interest Rate on Arrears4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Arrearage Dividend4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('PostPetition Monthly Payment4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="2"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __("Total") }}&nbsp;$</label><input name="<?php echo base64_encode('Totals'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                            <td><div class="d-flex"><label class="p-2">$</label><input name="<?php echo base64_encode('TotalPPMP'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.08.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __("Class 2 includes all secured claims that are modified by this plan, or that have matured or will mature
                    before the plan is completed.") }}</p>       
                <p><span class="text-bold">{{ __("(a) Payment of claim.") }} </span>{{ __("Subject to section 3.08(c), the “monthly dividend” payable to each Class 2A and 2B claim
                    is an equal monthly payment sufficient to pay each claim in full with interest at the rate specified below. If no
                    interest rate is specified, a 5% rate will be imputed.") }}</p>
                <p><span class="text-bold">{{ __("(b) Adequate protection payments.") }} </span>{{ __("Prior to confirmation, Trustee shall pay on account of each Class 2(A) and
                    2(B) claim secured by a purchase money security interest in personal property an adequate protection payment if
                    required by section 1326(a)(1)(C). The adequate protection payment shall equal the monthly dividend. Adequate
                    protection payments shall be disbursed by Trustee in connection with the customary month-end disbursement
                    cycle beginning the month after the case was filed. If a Class 2 claimant is paid an adequate protection payment,
                    that claimant shall not be paid a monthly dividend for the same month.") }}</p>
                <p><span class="text-bold">{{ __("(c) Claim amount.") }} </span>{{ __("The amount of a Class 2 claim is determined by applicable nonbankruptcy law. However,
                    except as noted below, Debtor may reduce the claim amount to the value of the collateral securing it by filing,
                    serving, setting for hearing, and prevailing on a motion to determine the value of that collateral. If this plan
                    proposes to reduce a claim based upon the value of its collateral, the failure to successfully prosecute a valuation
                    motion in conjunction with plan confirmation may result in the denial of confirmation.") }}</p>
                <div class="pl-4">
                    <p><span class="text-bold">(1) &nbsp;{{ __("Class 2 claims that cannot be reduced based on value of collateral") }}</span>{{ __("Debtor is prohibited from
                        reducing a claim if the claim holder has a purchase money security interest and the claim either was
                        incurred within 910 days of the filing of the case and is secured by a motor vehicle acquired for the
                        personal use of Debtor, or was incurred within 1-year of the filing of the case and is secured by any other
                        thing of value. These claims must be included in Class 2(A).") }}</p>
                    <p><span class="text-bold">{{ __("(2) Class 2 claims that may be reduced based on the value of their collateral") }}</span>{{ __("shall be included in
                        Class 2(B) or 2(C) as is appropriate.") }}</p>
                    <p><span class="text-bold">{{ __("(3) Class 2 claims secured by Debtor’s principal residence.") }} </span>{{ __("Except as permitted by 11 U.S.C. §
                        1322(c), Debtor is prohibited from modifying the rights of a holder of a claim secured only by Debtor’s
                        principal residence.") }}</p>
                </div>
                <p><span class="text-bold">{{ __("(d) Lien retention.") }} </span>{{ __("Each Class 2 creditor shall retain its existing lien until completion of the plan and, unless not
                    required by Bankruptcy Court, entry of Debtor’s discharge.") }}</p>
                <div class="table_sect mt-2">
                    <table class="text-center w-100 ">
                        <tr class="">
                            <td class="p-2">{{ __("Class 2 Creditor’s name and description of collateral") }}</td>
                            <td class="p-2">Purchase money security interest in personal property? <br>{{ __("YES/NO") }}</td>
                            <td class="p-2">{{ __("Amount claimed by creditor") }}</td>
                            <td class="p-2">{{ __("Value of creditor’s interest in its collateral") }}</td>
                            <td class="p-2">{{ __("Interest Rate") }}</td>
                            <td class="p-2">{{ __("Monthly Dividend") }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("Class 2(A) claims are not reduced based on value of collateral") }}</td>
                            <td class="p-2 bg-dgray" colspan="5"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Class2Aclaim1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2A1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2A1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('IntRate2A1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('MonthlyDiv2A1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Class2AClaim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2A2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2A2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('IntRate2A2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('MonthlyDiv2A2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">3.</label><input name="<?php echo base64_encode('Class2Aclaim3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2A3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2A3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2 bg-dgray"></td>
                            <td><input name="<?php echo base64_encode('IntRate2A3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('MonthlyDiv2A3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="4"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __("Total") }}&nbsp;$</label><input name="<?php echo base64_encode('Total2A'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
                <div class="table_sect mt-3">
                    <table class="text-center w-100 ">
                        <tr>
                            <td class="p-2">{{ __("Class 2(B) claims are reduced based on value of collateral") }}</td>
                            <td class="p-2 bg-dgray" colspan="5"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Class2BClaim1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2B1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2B1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('ValueofColl2B1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('IntRate2B1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('MonthlyDiv2B1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Class2BClaim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2B2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2B2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('ValueofColl2B2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('IntRate2B2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('MonthlyDiv2B2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">3.</label><input name="<?php echo base64_encode('Class2BClaim3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2B3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2B3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('ValueofColl2B3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('IntRate2B3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('MonthlyDiv2B3'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="4"></td>
                            <td colspan="2"><div class="d-flex"><label class="p-2">{{ __("Total") }}&nbsp;$</label><input name="<?php echo base64_encode('Total2B'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                        </tr>
                    </table>
                </div>
                <div class="table_sect mt-3">
                    <table class="text-center w-100 ">
                        <tr>
                            <td class="p-2">{{ __("Class 2(C) are claims reduced to $0 based on value of collateral") }}</td>
                            <td class="p-2 bg-dgray" colspan="5"></td>
                        </tr>
                        <tr>             
                            <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Class2CClaim1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2C1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2C1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input readonly type="text" class="text-right form-control input_bg_white_no_border" placeholder="$0.00"></td>
                            <td><input readonly type="text" class="text-right form-control input_bg_white_no_border" placeholder="0"></td>
                            <td><input readonly type="text" class="text-right form-control input_bg_white_no_border" placeholder="$0.00"></td>
                        </tr>
                        <tr>
                            <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Class2CClaim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                            <td><input name="<?php echo base64_encode('PMSIyn2C2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('Amtclaimedbycred2C2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input readonly type="text" class="text-right form-control input_bg_white_no_border" placeholder="$0.00"></td>
                            <td><input readonly type="text" class="text-right form-control input_bg_white_no_border" placeholder="0"></td>
                            <td><input readonly type="text" class="text-right form-control input_bg_white_no_border" placeholder="$0.00"></td>
                        </tr>
                        <tr>
                            <td class="p-2 bg-dgray" colspan="4"></td>
                            <td class="p-2" colspan="2"><span class="float_left">{{ __("Total $") }}</span> <span class="float_right pr-1">$0.00</span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.09.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __("Class 3 includes all secured claims satisfied by the surrender of collateral.") }} </p>
            </div>
        </div>
        <div class="col-md-12 table_sect mt-2 ">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __("Class 3 Creditor’s Name/Collateral Description") }} </td>
                    <td class="p-2">{{ __("Estimated Deficiency") }}</td>
                    <td class="p-2">Is Deficiency a Priority Claim? <br>{{ __("YES/NO") }}</td>
                </tr>
                <tr>             
                    <td><div class="d-flex "><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Class3Claim1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Estimated Deficiency1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Is Deficiency a Priority Claim YESNO1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Class3Claim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('Estimated Deficiency2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Is Deficiency a Priority Claim YESNO2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 d-flex ">
            <label class="text-bold">3.10.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Class 4 includes all secured claims paid directly by Debtor or third party.") }}</span>{{ __("Class 4 claims mature after the
                    completion of this plan, are not in default, and are not modified by this plan. These claims shall be paid by Debtor
                    or a third person whether or not a proof of claim is filed or the plan is confirmed.") }}</p>
            </div>
        </div>
        <div class="col-md-12 table_sect mt-2">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __("Class 4 Creditor’s Name/Collateral Description") }}</td>
                    <td class="p-2">{{ __("Monthly Contract Installment") }}</td>
                    <td class="p-2">{{ __("Person Making Payment") }}</td>
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('Class4Claim1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('MonthlyInstallmentClass4Clm1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('PayorClass4Clm1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('Class4Claim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('MonthlyInstallmentClass4Clm2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('PayorClass4Clm2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.11.</label>
            <div class="pl-3">
                <p class="text-bold">{{ __("Bankruptcy stays.") }}</p>
                <p><span class="text-bold">{{ __("(a)") }} </span>{{ __("Upon confirmation of the plan, the automatic stay of 11 U.S.C. § 362(a) and the co-debtor stay of 11 U.S.C. §
                    1301(a) are (1) terminated to allow the holder of a Class 3 secured claim to exercise its rights against its collateral;
                    (2) modified to allow the holder of a Class 4 secured claim to exercise its rights against its collateral and any
                    nondebtor in the event of a default under applicable law or contract; and (3) modified to allow the nondebtor party
                    to an unexpired lease that is in default and rejected in section 4 of this plan to obtain possession of leased
                    property, to dispose of it under applicable law, and to exercise its rights against any nondebtor.") }}</p>
                <p><span class="text-bold">{{ __("(b)") }} </span>{{ __("Secured claims not listed as Class 1, 2, 3, or 4 claims are not provided for by this plan. While this may be
                    cause to terminate the automatic stay, such relief must be separately requested by the claim holder.") }}</p>
                <p><span class="text-bold">{{ __("(c)") }} </span>{{ __("If, after confirmation of the plan, the court grants a motion to terminate the automatic stay to permit a Class 1
                    or 2 claim holder to proceed against its collateral, unless the court orders otherwise, Trustee shall make no further
                    payments on account of such claim and any portion of such claim not previously satisfied under this plan shall be
                    satisfied as a Class 3 claim. Any deficiency remaining after the creditor’s disposition of its collateral shall be
                    satisfied as a Class 7 unsecured claim subject to the filing of a proof of claim.") }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <label class="text-bold underline">{{ __("D. Unsecured Claims") }}</label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">3.12.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Priority claims.") }} </span>{{ __("Class 5 consists of unsecured claims entitled to priority pursuant to 11 U.S.C. § 507, such as
                    taxes, approved administrative expenses, and domestic support obligations.") }}</p>
                <p>{{ __("(a) Priority claims other than domestic support obligations will be paid in full except to the extent the claim holder
                    has agreed to accept less. When the claim holder has agreed to accept less than payment in full, the claim holder
                    and the treatment of the claim shall be specified in section 7, the Nonstandard Provisions.") }}</p>
                <p>{{ __("(b) Priority claims that are domestic support obligation shall be paid in full except to the extent 11 U.S.C. §
                    1322(a)(4) is applicable. When section 1322(a)(4) is applicable, the claim holder and the treatment of the claim
                    shall be specified in section 7, the Nonstandard Provisions.") }}</p>
                <p>{{ __("(c) Debtor estimates that all priority claims, not including those identified in section 7, total") }} $ &nbsp;<input name="<?php echo base64_encode('c  Debtor estimates that all priority claims not including those identified in section 7 total'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto">.</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">3.13.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Class 6 includes designated nonpriority unsecured claims,") }} </span>{{ __("such as co-signed unsecured debts, that will be
                    treated differently than the other nonpriority unsecured claims provided for in Class 7. The claim holder of each
                    Class 6 claim and the treatment of each claim shall be specified in section 7, the Nonstandard Provisions.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold pt-2">3.14.</label>
            <div class="pl-3">
                <p><span class="text-bold">{{ __("Class 7 consists of all other nonpriority unsecured claims") }} </span>{{ __("not provided for in Class 6. These claims will
                    receive no less than a") }} &nbsp;<input name="<?php echo base64_encode('receive no less than a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_auto">% {{ __("dividend. These claims, including the under-collateralized portion of
                    secured claims not entitled to priority, total approximately") }} $&nbsp;<input name="<?php echo base64_encode('secured claims not entitled to priority total approximately'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"></p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __("Section 4. Executory Contracts And Unexpired Leases") }} </label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">4.01.</label>
            <div class="pl-3">
                <p>{{ __("Debtor assumes the executory contracts and unexpired leases listed below. Debtor shall pay directly to the other
                    party to the executory contract or unexpired lease, before and after confirmation of this plan and whether or not a
                    proof of claim is filed, all post-petition monthly payments required by the lease or contract. Unless a different
                    treatment is required by 11 U.S.C. § 365(b)(1) and is set out in section 7, the Nonstandard Provisions, pre-petition
                    arrears shall be paid in full. Trustee shall pay the monthly dividend specified in the table below on account of
                    those arrears.") }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">4.02.</label>
            <div class="pl-3">
                <p>{{ __("Any executory contract or unexpired lease not listed in the table below is rejected.") }}</p>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="">
                    <td class="p-2">{{ __("Name of Other Party to Executory Contract/ Unexpired Lease") }}</td>
                    <td class="p-2">{{ __("Post-Petition Monthly Payment") }}</td>
                    <td class="p-2">{{ __("Pre-petition Arrears") }}</td>
                    <td class="p-2">{{ __("Arrearage Dividend") }}</td>
                </tr>
                <tr>             
                    <td><div class="d-flex"><label class="p-2">1.&nbsp;</label><input name="<?php echo base64_encode('LeaseClaim1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('PostPetition Monthly Payment1_2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Prepetition Arrears1'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Arrearage Dividend1_2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td><div class="d-flex"><label class="p-2">2.</label><input name="<?php echo base64_encode('LeaseClaim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td><input name="<?php echo base64_encode('PostPetition Monthly Payment2_2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Prepetition Arrears2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="<?php echo base64_encode('Arrearage Dividend2_2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2 bg-dgray" colspan="2"></td>
                    <td colspan="2"><div class="d-flex"><label class="p-2">{{ __("Total") }}&nbsp;$</label><input name="<?php echo base64_encode('Total_3'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></div></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __("Section 5. Payment of Claims and Order of Distribution") }} </label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">5.01.</label>
            <div class="pl-3">
                <p>{{ __("After confirmation, payments by Trustee to holders of allowed claims and approved expenses will be made
                    monthly.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">5.02.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __("Distribution of plan payment.") }} </span></p>
                <p>{{ __("(a) At a minimum, each monthly plan payment must be sufficient to pay in full: (i) Trustee's fees; (ii) post-petition
                    monthly payments due on Class 1 claims; (iii) the monthly dividend specified in section 3.06 for administrative
                    expenses; and (iv) the monthly dividends payable on account of Class 1 arrearage claims, Class 2 claims, and
                    executory contract and unexpired lease arrearage claims.") }}</p>
                <p>{{ __("(b) If the amount paid by Debtor is insufficient to pay all of the minimum dividends required by section 5.02(a),
                    Trustee shall pay, to the extent possible, such fees, payments, expenses, and claims in the order specified in
                    section 5.02(a)(i) through (iv). If the amount paid by Debtor is insufficient to pay all dividends due on account of
                    fees, payments, expenses, and claims within a subpart of section 5.02(a), no dividend shall be paid on account of
                    any of the fees, payments, expenses, and claims within such subpart except as permitted by section 3.07(b)(3).") }}</p>
                <p>{{ __("(c) Each month, if funds remain after payment of all monthly dividends due on account of the fees, payments,
                    expenses, and claims specified in section 5.02(a)(i) through (iv), the remainder shall be paid pro rata, first to
                    holders of Class 1 arrearage claims, Class 2 claims, and executory contract and unexpired lease arrearage
                    claims; second to Class 5 priority claims; third to Class 6 unsecured claims; and fourth to Class 7 unsecured
                    claims.") }}</p>
                <p>{{ __("(d) Over the plan's duration, distributions must equal the total dividends required by sections 3.04, 3.06, 3.07, 3.08,
                    3.12, 3.13, 3.14, and 4.01. The case may be dismissed if Debtor's plan payments are or will be insufficient to pay
                    these dividends.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">5.03.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __("Priority of payment among administrative expenses.") }} </span> {{ __("The portion of the monthly plan payment allocated in
                    section 3.06 for administrative expenses, shall be distributed first to any former chapter 7 trustee up to the monthly
                    amount required by 11 U.S.C. § 1326(b)(3)B), and second to holders of approved administrative expenses on a
                    pro rata basis.") }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold"> {{ __("Section 6. Miscellaneous Provisions") }} </label>
        </div>
        <div class="col-md-12 mt-3 d-flex">
            <label class="text-bold">6.01.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __("Vesting of property.") }} </span> Property of the estate <span class="text-bold">[choose one]</span> shall
                    <input name="<?php echo base64_encode('Check Box21'); ?>" value="Yes" type="checkbox"> shall not <input name="<?php echo base64_encode('Check Box22'); ?>" value="Yes" type="checkbox"> {{ __("revest in Debtor upon
                    confirmation of the plan. In the event the case is converted to a case under Chapters 7, 11, or 12 of the
                    Bankruptcy Code or is dismissed, the property of the estate shall be determined in accordance with applicable law.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">6.02.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __("Debtor’s duties.") }} </span> {{ __("In addition to the duties imposed upon Debtor by the Bankruptcy Code, the Bankruptcy Rules,
                    and applicable nonbankruptcy law, the court’s Local Bankruptcy Rules impose additional duties on Debtor,
                    including without limitation, obtaining prior court authorization prior to transferring property or incurring additional
                    debt, maintaining insurance, providing Trustee copies of tax returns, W-2 forms, 1099 forms, and quarterly
                    financial information regarding Debtor’s business or financial affairs, and providing Trustee not later than the 14
                    days after the filing of the case with the Domestic Support Obligation Checklist for each domestic support
                    obligation and a Class 1 Checklist and Authorization to Release Information for each Class 1 claim.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">6.03.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __("Post-Petition claims.") }} </span> {{ __("If a proof of claim is filed and allowed for a claim of the type described in 11 U.S.C. §
                    1305(a), this plan may be modified to provide for such claim.") }}</p>
            </div>
        </div>
        <div class="col-md-12 d-flex">
            <label class="text-bold">6.03.</label>
            <div class="pl-3">
                <p> <span class="text-bold">{{ __("Remedies upon default.") }} </span> {{ __("If Debtor defaults under this plan, or if the plan will not be completed within six months
                    of its stated term, not to exceed 60 months, Trustee or any other party in interest may request appropriate relief by
                    filing a motion and setting it for hearing pursuant to Local Bankruptcy Rule 9014-1. This relief may consist of,
                    without limitation, dismissal of the case, conversion of the case to chapter 7, or relief from the automatic stay to
                    pursue rights against collateral.") }}</p>
            </div>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <label class="text-bold">{{ __("Section 7. Nonstandard Provisions") }}</label>
        </div>
        <div class="col-md-12 mt-3">
            <p>{{ __("Debtor may propose nonstandard provisions that modify the preprinted text of this form plan. All nonstandard plan
                provisions shall be on a separate piece of paper appended to this plan. Each nonstandard provision shall be identified by
                a section number beginning with section 7.01 and indicate which section(s) of the form plan are modified by the
                nonstandard provision. Nonstandard provisions placed elsewhere are void. The signatures below are certifications by
                Debtor and Debtor’s attorney that this plan form has not been altered and that all nonstandard provisions are in section 7") }}</p>
        </div>
        <div class="col-md-6 mt-3 d-flex">
            <label class="pt-2">{{ __("Dated:") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Db Dated'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="d-flex">
                <label class="pt-2">/s/</label>
                <input name="<?php echo base64_encode('Debtor'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            </div>
            <div class="d-flex mt-1">
                <label class="pt-2">{{ __("Debtor") }}</label>
                <input name="<?php echo base64_encode('Db printed name field'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="form-control width_auto">
                <label class="pt-2">{{ __("(Debtor's printed name)") }}</label>
            </div>
        </div>
        <div class="col-md-6 mt-3 d-flex">
            <label class="pt-2">{{ __("Dated:") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Jdb Dated'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="d-flex">
                <label class="pt-2">/s/</label>
                <input name="<?php echo base64_encode('Debtor_2'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            </div>
            <div class="d-flex mt-1">
                <label class="pt-2">{{ __("Debtor") }}</label>
                <input name="<?php echo base64_encode('Jdb printed name field'); ?>" value="<?php echo $spousename;?>" type="text" class="form-control width_auto">
                <label class="pt-2">{{ __("(Joint debtor's printed name, if applicable)") }}</label>
            </div>
        </div>
        <div class="col-md-6 mt-3 d-flex">
            <label class="pt-2">{{ __("Dated:") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('Aty Dated'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="d-flex">
                <label class="pt-2">/s/</label>
                <input name="<?php echo base64_encode('Debtors Attorney'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            </div>
            <div class="d-flex mt-1">
                <label class="pt-2">{{ __("Debtor’s Attorney") }}</label>                
            </div>
        </div>
        
 
        
    </div>
</div>