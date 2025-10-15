<div class="container">
    <div class="row">
        <div class="col-md-12">
            <p class="text-bold">United States Bankruptcy Court <br>
                {{ __("Southern District of California") }}</p>
        </div>
        <div class="col-md-6">
            <label>{{ __("Debtor(s):") }}</label>
            <textarea name="<?php echo base64_encode(''); ?>" class="form-control" rows="5" cols=""
                style="padding-right:5px;">{{$debtorname}}</textarea>
        </div>
        <div class="col-md-6">
            <div class="d-flex">
                <label class="pt-2">{{ __("CASE NO.:") }}</label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('Case Number'); ?>" placeholder="" type="text"
                        value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>"
                        class=" form-control">
                </div>
            </div>
            <div class="d-flex mt-3">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div>
                    <p class="mb-0">{{ __("Check if this is an amended plan, and list below the
                        sections of the plan that have been changed.") }}</p>
                </div>
            </div>
            <textarea name="<?php echo base64_encode(''); ?>" value="" class="form-control mt-2" rows="2" cols=""
                style="padding-right:5px;"><?php echo ''; ?></textarea>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold">{{ __("Mandatory Chapter 13 Plan") }}</p>
            <div class="d-flex">
                <label class="pt-2">{{ __("Dated:") }}</label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode(''); ?>" placeholder="{{ __("MM/DD/YYYY") }}" value="{{$currentDate}}"
                        type="text" class="date_filed form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 1:") }}</span>
                <h2 class="font-lg-18">{{ __("Notices") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">{{ __("To All Parties in Interest:") }}</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-11">
            <p class="text-bold mb-0">{{ __("The court has provided guidelines for use of this form that can be found in CSD
                1300A.") }} </p>
            <p class="text-bold">{{ __("This plan does not provide for avoidance of a lien which impairs an exemption. This
                must be sought by separate motion.") }} </p>
        </div>
        <div class="col-md-12">
            <p class="text-bold mb-0">{{ __("To Debtors:") }}</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-11">
            <p class="text-bold mb-0">{{ __("In some places this form provides you with options. You should carefully consider
                whether you need to elect among the options. If you do, you should carefully consider
                which option is appropriate.") }}</p>
            <p class="text_italic">{{ __("In the following notice to creditors, you must check each box that applies.") }}</p>
        </div>
        <div class="col-md-12">
            <p class="text-bold mb-0">{{ __("To Creditors:") }}</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-11">
            <p class="text-bold mb-0">{{ __("Your rights may be affected by this plan. Your claim may be reduced, modified, or
                eliminated.") }}</p>
            <p>{{ __("You should read this plan carefully and discuss it with your attorney, if you have one in this
                bankruptcy case. If you do not have an attorney, you may wish to consult one.") }}</p>
            <p>{{ __("If you oppose the plan’s treatment of your claim or any provision of this plan, you or your
                attorney must file an objection to confirmation in accordance with Southern District of
                California Local Bankruptcy Rule 3015-5 within 7 days after the filing of the Notice of Meeting
                of Creditors Held and Concluded. Untimely objections may not be considered. Any such
                objections must be noticed for hearing at least 28 days after filing the objection. The Court
                may confirm this plan without further notice if no objection to confirmation is filed. See
                Bankruptcy Rule 3015(f). In addition, you may need to file a timely proof of claim in order to
                be paid under any plan.") }}</p>
            <p>{{ __("The following matters may be of particular importance.") }} <span class="text_italic">{{ __("Debtors must check one
                    box on each
                    line to state whether or not the plan includes each of the following items. If an item is
                    checked as “Not Included” or if both boxes are checked, the provision will be ineffective if set
                    out later in the plan.") }}</span></p>
        </div>
        <div class="col-md-1">
            <label class="float_right">1.1</label>
        </div>
        <div class="col-md-8">
            <p>{{ __("A limit on the amount of a secured claim, set out in § 3.2, which may result
                in a partial payment or no payment at all to the secured creditor") }}</p>
        </div>
        <div class="col-md-3">
            <div class="d-flex ">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3">
                    <p>{{ __("Included") }}</p>
                </div>
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div>
                    <p>{{ __("Not included") }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            <label class="float_right">1.2</label>
        </div>
        <div class="col-md-8">
            <p>{{ __("Nonstandard provisions, set out in Part 9") }}</p>
        </div>
        <div class="col-md-3">
            <div class="d-flex ">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3">
                    <p>{{ __("Included") }}</p>
                </div>
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div>
                    <p>{{ __("Not included") }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 2:") }}</span>
                <h2 class="font-lg-18">{{ __("Plan Payments and Length of Plan") }} </h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">2.1 &nbsp;&nbsp;{{ __("Regular payments.") }}</p>
            <p class="mt-2">{{ __("Debtor(s) will make regular payments to the trustee as follows") }}</p>
            <p class="text_italic pl-3 mb-0">{{ __("Complete one.") }}</p>
        </div>
        <div class="col-md-12 pr-0 mt-2">
            <p>$ <input name="schedule_ab_real_estate" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_13percent">
                {{ __("per month for 36 months (Applicable commitment period for below median debtor(s))") }} </p>
        </div>
        <div class="col-md-12 pr-0 mt-2">
            <p>$ <input name="schedule_ab_real_estate" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_13percent">
                {{ __("per month for 60 months (Applicable commitment period for above median debtor(s))") }}</p>
        </div>
        <div class="col-md-12 pr-0 mt-2">
            <p>$ <input name="schedule_ab_real_estate" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_13percent">
                per month &nbsp;<input name="" type="text" value="<?php echo ''; ?>"
                    class="form-control width_5percent">
                {{ __("months (Despite applicable commitment period of 36 months,
                debtor(s) seek additional time to cure secured or priority arrearages or to make necessary payments to
                meet
                the liquidation test specified in § 5.2.2.)") }} </p>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">2.2 &nbsp;&nbsp;{{ __("Irregular payments.") }}</p>
            <p class="mt-2">{{ __("Debtor(s) will make regular payments to the trustee as follows") }}</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-10 table_sect">
            <table class="text-center w-100">
                <tr>
                    <td class="p-2">$</td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td class="p-2">per</td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td class="p-2">{{ __("from") }}</td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td class="p-2">to</td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
            <p class="text_italic mb-0 mt-2">{{ __("Insert additional payments as needed.") }}</p>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">2.3 &nbsp;&nbsp;{{ __("Manner of payments.") }}</p>
            <p class="mt-2">{{ __("Regular payments must be made directly to the trustee from future earnings unless the court
                issues an
                earnings withholding order. Any other manner of payment must be specified by checking the box below.") }}</p>
        </div>
        <div class="col-md-12">
            <div class="d-flex ">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p>Other (specify method of payment): <input name="" type="text" value="<?php echo ''; ?>"
                            class="form-control width_24percent"></p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">2.4 &nbsp;&nbsp;{{ __("Income tax issues.") }}</p>
            <div class="pl-4 mt-2">
                <p class="text_italic">{{ __("Check all that apply.") }}</p>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("Debtor(s) will retain any federal or state tax refunds received during the plan term.") }}</p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("Debtor(s) will supply the trustee with a copy of each federal and state tax return filed
                        during the plan term within 14 days of filing the return.") }}</p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("Debtor(s) will turn over to the trustee all federal and state income tax refunds, other than
                        earned
                        income or childcare tax credits, received during the plan term.") }}</p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("Debtor(s) will supply the trustee with federal and state tax returns filed during the plan
                        term and will turn over to the trustee a portion of any federal and state income tax
                        refunds received during the plan term as specified below.") }}</p>
                    <p class="text-bold">{{ __("Debtor(s) must not change their withholding exemptions during the plan term
                        unless there is an appropriate change in circumstances and will timely pay all
                        post-confirmation tax liabilities directly to the appropriate taxing authority as they
                        become due.") }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">2.5 &nbsp;&nbsp;{{ __("Additional payments.") }}</p>
            <div class="pl-4 mt-2">
                <p class="text_italic">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                        applies.") }}</span></p>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold"> {{ __("None.") }} </span><span class="text_italic">If “None” is checked, the rest of
                            § 2.5 need not be completed or reproduced.</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("Debtor(s) will make additional payment(s) to the trustee from other sources, as specified below.
                        Describe the source, estimated amount, and date of each anticipated payment.") }}</p>
                    <textarea name="<?php echo base64_encode(''); ?>" value="" class="form-control mt-2" rows="3"
                        cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>

                </div>
            </div>

        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">2.6 &nbsp;&nbsp;{{ __("The total amount of estimated payments to the trustee provided for
                in §§ 2.1 through 2.5 is.") }}</p>
        </div>
        <div class="col-md-12 pr-0 mt-2">
            <p>$ <input name="schedule_ab_real_estate" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_13percent">
                . </p>
        </div>

        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 3:") }}</span>
                <h2 class="font-lg-18">{{ __("Treatment of Secured Claims") }} </h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">3.1 &nbsp;&nbsp;{{ __("Maintenance of payments and cure of any default.") }}</p>
            <p class="mb-0 pl-4 text_italic">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }} </span><span class="text_italic">If “None” is checked, the rest of
                            § 3.1 need not be completed or reproduced.</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The debtor(s) will maintain the contractual installment payments on the claims listed below, with
                        any changes required by the applicable contract, and cure any default in payments on the
                        secured claims listed below. The allowed claim for any arrearage amount will be paid under the
                        plan, with interest, if any, at the rate stated. Unless otherwise ordered by the court, the
                        amounts
                        listed on a proof of claim or amended proof of claim filed before the filing deadline under
                        Bankruptcy Rule 3002(c) control over any contrary amounts listed below. A tardily filed proof of
                        claim will be disallowed unless it is estimated below or unless the debtor(s) brings a motion to
                        allow the claim. If relief from the automatic stay is ordered as to any item of collateral
                        listed in
                        this paragraph, then, unless otherwise ordered by the court, all payments under this paragraph
                        as to that collateral will cease and all secured claims based on that collateral will no longer
                        be
                        treated by the plan. The final column includes only payments disbursed by the trustee rather
                        than by the debtor.") }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor with last 4 digits of account number") }}</td>
                    <td class="p-2">{{ __("Collateral") }}</td>
                    <td class="p-2">{{ __("Amount of arrearage") }}</td>
                    <td class="p-2">Interest rate on arrearage <br>{{ __("(if applicable)") }}</td>
                    <td class="p-2">{{ __("Monthly plan payment on arrearage") }}</td>
                    <td class="p-2">{{ __("Estimated total payments by trustee") }}</td>
                </tr>
                <tr class="row1">
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="ro11 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="ro12 form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro11 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex ro11"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control"><label class="p-2">%</label></div>
                    </td>
                    <td>
                        <div class="d-flex ro12"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro12 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro12 form-control"></div>
                    </td>
                </tr>
                <tr class="row2">
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="ro21 form-control">
                    </td>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="ro22 form-control">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro21 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex ro22"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control"><label class="p-2">%</label></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro21 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control ro22"></div>
                    </td>
                </tr>
                <tr class="row3">
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="ro31 form-control">
                    </td>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control ro31">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro32 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex ro32"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control"><label class="p-2">%</label></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro33 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="ro33 form-control"></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">3.2 &nbsp;&nbsp;{{ __("Request for valuation of security and claim modification.") }}</p>

            <p class="mb-0 pl-4 text-bold">{{ __("To determine the proper valuation of real estate secured claims, the
                debtor(s) must timely file a
                motion in accordance with Local Bankruptcy Rule 3015-8 in addition to including the creditor in this
                section of the plan. No such motion is necessary for valuation determinations for personal property
                secured claims.") }}</p>
            <div class="pl-4">
                <div class="pl-3 mt-2">
                    <p>{{ __("The portion of any allowed claim that exceeds the amount of the secured claim will be treated as
                        an
                        unsecured claim under Part 5 of this plan unless the claim is entitled to priority status, in
                        which
                        case it will be provided in Part 4. If the amount of a creditor’s secured claim is listed below
                        as
                        having no value, the creditor’s allowed claim will be treated in its entirety as an unsecured
                        claim
                        under Part 5 of this plan. Unless otherwise ordered by the court, the amount of the creditor’s
                        total
                        claim listed on the proof of claim controls over any contrary amounts listed in this paragraph.") }}
                    </p>
                    <p>The holder of any claim listed below as having value in the column headed <span
                            class="text_italic">{{ __("Amount of secured claim") }}</span>
                        {{ __("will retain the lien until the earlier of the following events as applicable to the particular
                        secured
                        creditor: 1) payment of the underlying debt determined under nonbankruptcy law; 2) discharge
                        under
                        11 U.S.C. § 1328, or 3) completion of payments under the plan if the debtors(s) are not entitled
                        to a
                        discharge. After the date applicable to termination of the lien, it will be released by the
                        creditor unless
                        the claim is a nondischargeable claim owed to a governmental entity. See Local Bankruptcy Rule
                        3015-8.") }}</p>
                </div>
            </div>
            <p class="one mb-0 pl-4 text_italic">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">

                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">

                    <p><span class="text-bold">None. </span>
                        <span class="text_italic">{{ __("If “None” is checked, the rest of § 3.2 need not be completed or
                            reproduced.") }}</span>
                    </p>
                    <p class="text-bold text_italic">{{ __("The remainder of this paragraph will be effective only if the
                        applicable box in Part 1 of this plan is checked.") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The debtor(s) request that the court determine the value of the secured claims to be treated in
                        the manner below. For each non-governmental secured claim listed below, the debtor(s) state
                        that the value of the secured claim should be as stated below in the column headed") }} <span
                            class="text_italic">{{ __("Amount of
                            secured") }}</span> {{ __("claim. For secured claims of governmental units, unless otherwise ordered by
                        the court
                        pursuant to a claim objection, the amounts listed in proofs of claim filed in accordance with
                        the
                        Bankruptcy Rules control over any contrary amounts listed below. For each listed secured
                        claim, the controlling amount of the claim will be paid in full under the plan with interest at
                        the
                        rate stated below.") }}</p>
                </div>
            </div>
            <p class="mb-0 pl-4 text-bold">{{ __("3.2.1 Identify creditor and collateral.") }}</p>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 mt-2">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor with last 4 digits of account number") }}</td>
                    <td class="p-2">{{ __("Estimated amount of creditor's allowed secured claim") }}</td>
                    <td class="p-2">{{ __("Collateral") }}</td>
                    <td class="p-2">{{ __("Value of collateral") }}</td>
                    <td class="p-2">{{ __("Amount of claims senior to creditor's allowed secured claim") }}</td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>

                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control">
                        </div>
                    </td>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmio98"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="0fmcmio99 form-control">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="fmcmio99 form-control"></div>
                    </td>
                    <td>

                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="fmcmio09 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmio9"></div>
                    </td>
                </tr>

                <tr>
                    <td>

                        <input name="" type="text" value="<?php echo ''; ?>" class="fmcmio0 form-control">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmio2"></div>
                    </td>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcmio3">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmio9"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmio9"></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3 table_sect">
            <p class="mb-0 pl-4 text-bold">{{ __("3.2.2 Treatment of creditor.") }}</p>
            <table class="text-center w-100 mt-2">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor with last 4 digits of account number") }}</td>
                    <td class="p-2">{{ __("Amount of allowed secured claim") }}</td>
                    <td class="p-2">{{ __("Interest rate as provided by law") }}</td>
                    <td class="p-2">{{ __("Monthly payment to creditor") }}</td>
                    <td class="p-2">{{ __("Estimated total of monthly payments") }}</td>
                </tr>
                <tr>
                    <td class="col1row1"><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd89"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcmd09"><label class="p-2">%</label></div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcmd90">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td class="col1row2"><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control  fmcmd1">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcmd1"><label
                                class="p-2">%</label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="fmcmd1  form-control">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="fmcmd1  form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="col1row3">
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>
                    <td><div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="fmcmd1 form-control">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <input name="" type="text" value="<?php echo ''; ?>" class="form-control"><label
                                class="p-2">%</label>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex">
                            <label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control">
                        </div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <p class="n8 text-bold mb-0">3.3 &nbsp;&nbsp;{{ __("Secured claims excluded from 11 U.S.C. § 506.") }}</p>
            <p class="text_italic pl-3 mb-0">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }} </span><span class="text_italic">If “None” is checked, the rest of
                            § 3.3 need not be completed or reproduced.</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">

                <div class="pr-3 w-100 ">
                    <p>{{ __("The claims listed below were either:") }}</p>
                    <div class="d-flex">
                        <label for="">(1)</label>
                        <div class="pr-3 w-100 pl-3">
                            <p class="mb-0 io">&nbsp;{{ __("secured by real estate and matured pre-petition;") }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="">(2)</label>
                        <div class="pr-3 w-100 pl-3">
                            <p class="mb-0">{{ __("secured by real estate and will mature during the term of the plan;") }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="">(3)</label>
                        <div class="pr-3 w-100 pl-3">
                            <p class="mb-0"> {{ __("incurred within 910 days before the petition date and secured by a purchase
                                money security
                                interest in a motor vehicle acquired for the personal use of the debtor(s); or") }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <label for="">(4)</label>
                        <div class="pr-3 w-100 pl-3">
                            <p> {{ __("incurred within 1 year of the petition date and secured by a purchase money security
                                interest in any other property of value.") }} </p>
                        </div>
                    </div>
                    <p>{{ __("These claims will be paid in full under the plan with interest at the rate stated below.
                        Unless otherwise ordered by the court, the claim amount stated on a proof of claim or
                        modification of a proof of claim filed before the filing deadline under Bankruptcy Rule
                        3002(c) controls over any contrary amount listed below. The final column includes only
                        payments disbursed by the trustee rather than by the debtor.") }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12  table_sect">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor with last 4 digits of account number") }}</td>
                    <td class="p-2">{{ __("Collateral") }}</td>
                    <td class="p-2">{{ __("Amount of claim") }}</td>
                    <td class="p-2">{{ __("Interest rate") }}</td>
                    <td class="p-2">{{ __("Monthly payment") }}</td>
                    <td class="p-2">{{ __("Estimated total payments") }}</td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcmd11">
                    </td>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcm11">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd10"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcmd9"><label class="p-2">%</label></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd8"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd7"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd4"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcmd3"><label class="p-2">%</label></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd2"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcmd1"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="fmcmd1 form-control">
                    </td>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="fmcmd2 form-control">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control fmcpercentcsd6"></div>
                    </td>
                    <td><div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>" class="form-control"><label class="p-2">%</label></div>
                    </td>
                    <td><div class="d-flex"><label class="p-2">$</label><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></div></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="form-control"></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">3.4 &nbsp;&nbsp;{{ __("Surrender of collateral to secured creditors.") }}</p>
            <p class="text_italic pl-3 mb-0">{{ __("Check one") }}. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">

                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">

                    <p><span class="text-bold">{{ __("None.") }} </span><span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 3.4 need not be completed or reproduced.") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The debtor(s) elect to surrender to each creditor listed below the collateral that secures the
                        creditor’s claim. The stays under 11 U.S.C. § 362(a) and § 1301 will terminate with respect to
                        the surrendered property on the effective date of the plan without the requirement of any
                        further
                        order. The stays will otherwise remain in effect. Any allowed unsecured claim resulting from the
                        disposition of the collateral will be treated in Part 5 below") }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor with last 4 digits of account number") }}</td>
                    <td class="p-2">{{ __("Collateral") }}</td>

                </tr>

                <tr>
                    <td>
                            <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>
                        <td>
                            <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                </td>
                    <td>
                <input name="" type="text" value="<?php echo ''; ?>" class="form-control"> </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td> <input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">3.5 &nbsp;&nbsp;{{ __("Intentional exclusion of claim from treatment under the plan.") }}</p>
            <p class="text_italic pl-3 mb-0">{{ __("Secured and partially secured creditors who received proper notice but who
                do not timely file a proof of
                claim, and who are not provided for elsewhere in the plan, will be considered excluded creditors and
                treated
                in this section") }}</p>
            <p class="text_italic pl-3 mb-0">{{ __("Check one") }}. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }} </span><span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 3.5 need not be completed or reproduced.") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The claims held by creditors listed below will not be provided for under the plan, and the plan
                        will not affect any of the claimant's rights under applicable law.") }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor and description of claim") }}</td>
                    <td class="p-2">{{ __("Description of claim") }}</td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercentcsd1 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercentcsd2 form-control"></td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcpercentcsd1"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcpercentcsd2"></td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcpercentcsd3"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcpercentcsd3"></td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>

        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 4:") }}</span>
                <h2 class="font-lg-18">{{ __("Treatment of Priority Claims") }} </h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">4.1 &nbsp;&nbsp;{{ __("Treatment of priority claims.") }}</p>
            <p class="mb-0 mt-2">{{ __("All allowed priority claims other than those treated in §§ 4.5 and 4.6 of the plan will
                be paid in full without
                interest.") }}</p>
            <p class="text-bold mb-0 mt-2">4.2 &nbsp;&nbsp;{{ __("Interest exception.") }}</p>
            <p class="mb-0 mt-2">{{ __("If the plan provides interest to unsecured nonpriority creditors, that same rate of
                interest will be paid to all
                creditors for which interest is not otherwise specifically provided under this plan.") }}</p>
            <p class="text-bold mb-0 mt-2">4.3 &nbsp;&nbsp;{{ __("Trustee’s fees.") }}</p>
            <p class="mb-0 mt-2">{{ __("The trustee will receive a fee, the percentage of which is set by the United States
                Trustee in accordance with
                applicable law. The trustee’s fees are estimated to be") }} <input name="" type="text"
                    value="<?php echo ''; ?>" class="form-control width_5percent">{{ __("% of plan payments; and during the
                plan
                term, they are estimated to total") }} $ <input name="" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_12percent">.</p>
            <p class="text-bold mb-0 mt-2">4.4 &nbsp;&nbsp;{{ __("Adequate protection payments.") }}</p>
            <p class="mb-0 mt-2">{{ __("The trustee will make pre-confirmation adequate protection payments to secured
                creditor, identified in General
                Order 175-F, from plan payments received from the debtor(s), as this order may be amended from time to
                time.") }}</p>
            <p class="text-bold mb-0 mt-2">4.5 &nbsp;&nbsp;{{ __("Domestic support obligations.") }}</p>
            <p class="text_italic pl-3 mb-0 mt-2">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }} </span><span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 4.5 need not be completed or reproduced.") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The allowed priority claims listed below are based on a domestic support obligation owed to a
                        spouse or a dependent as scheduled or in the amount set forth in a proof of claim, which will
                        control in the event of a conflict.") }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 csd_1 table_sect">
            <table class="text-center csd_1 w-100 ">
                <tr class="bg-dgray csd_1">
                    <td class="p-2 csd_1">{{ __("Name of creditor") }}</td>
                    <td class="p-2 csd_1">{{ __("Amount of claim to be paid by trustee") }}</td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="csd_1 form-control"></td>
                    <td>
                        <div class="csd_1 d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="csd_1 form-control"></td>
                    <td>
                        <div class="d-flex csd_1"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control csd_1"></td>
                    <td>
                        <div class="d-flex csd_1"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field form-control"></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 csd_1 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">4.6 &nbsp;&nbsp;{{ __("Assigned domestic support obligations.") }}</p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The allowed priority claims listed below are based on a domestic support obligation that has
                        been assigned to or is owed to a governmental unit and will be paid less than the full amount
                        of the claim under 11 U.S.C. § 1322(a)(4), but not less than the amount that would have been
                        paid on such claim if the estate of the debtor(s) were to be liquidated under chapter 7. See 11
                        U.S.C. § 1325(a)(4).") }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor") }}</td>
                    <td class="p-2">{{ __("Amount of claim to be paid by trustee") }}</td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field form-control"></div>
                    </td>
                </tr>
            </table>
            <p class="mb-0 mt-2">{{ __("Even if a domestic support obligation claim is not listed here, debtor(s) must
                nevertheless pay it in full to
                receive a discharge.") }}</p>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">4.7 &nbsp;&nbsp;{{ __("Attorney’s fees.") }}</p>
            <p class="mb-0 mt-2">{{ __("The total amount of attorney's fees to be paid under the plan is estimated to be") }} $
                <input name="" type="text"
                    value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>"
                    class="price-by-attorney price-field form-control width_12percent">{{ __(". The balance
                of the fees awarded by court order to professionals for debtor(s) under 11 U.S.C. § 330 will be paid as
                follows:") }}</p>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Check one") }}</p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("on a priority basis before other priority claims other than trustee’s fees and adequate
                        protection payments.") }}</p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p>{{ __("in installment payments of") }} $ &nbsp;<input name="" type="text" value="<?php echo ''; ?>"
                            class="price-field form-control width_12percent"></p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-1">
            <p class="text-bold mb-0">4.8 &nbsp;&nbsp;{{ __("Other priority claims and secured portion of federal and state tax
                claims.") }}</p>
            <p class="mb-0 mt-2">{{ __("All priority claims identified in 11 U.S.C. § 507, including unsecured priority tax
                claims, are included in this
                section of the plan. The secured portion of a federal or state tax claim is also included in this
                section unless
                specifically provided for elsewhere in this plan") }}</p>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Check one") }}. <span class="underline">{{ __("If neither box is checked, “None”
                    applies") }}</span></p>
            <div class="d-flex mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }}</span> <span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 4.8 need not be completed or reproduced.") }}</span></p>
                </div>
            </div>
            <div class="d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The debtor(s) estimate the total amount of priority and secured tax claims to be paid under this
                        section
                        of the plan to be") }} $ &nbsp;<input name="" type="text" value="<?php echo ''; ?>"
                            class="price-field form-control width_12percent">{{ __(". This sum is a total of all of the
                        payments listed below to be
                        paid in accordance with this section. Priority claim payments are owed to the following
                        creditors in the
                        following amounts.") }}</p>
                </div>
            </div>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Check all that apply.") }}</p>
            <div class="pl-4 d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p class="mb-1">{{ __("Internal Revenue Service in the estimated amount of") }} $ &nbsp;<input name=""
                            type="text" value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                        .</p>
                </div>
            </div>
            <div class="pl-4 d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p class="mb-1">{{ __("Franchise Tax Board in the estimated amount of") }} $ &nbsp;<input name="" type="text"
                            value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                        .</p>
                </div>
            </div>
            <div class="pl-4 d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p class="mb-1">{{ __("California Department of Tax and Fee Administration in the estimated amount of") }} $
                        &nbsp;<input name="" type="text" value="<?php echo ''; ?>"
                            class="price-field form-control width_12percent">
                        .</p>
                </div>
            </div>
            <div class="pl-4 d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p class="mb-1">{{ __("Employment Development Department in the estimated amount of") }} $ &nbsp;<input name=""
                            type="text" value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                        .</p>
                </div>
            </div>
            <div class="pl-4 d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p class="mb-1">{{ __("County Property Tax Assessor (not real property taxes) in the estimated amount of") }} $
                        &nbsp;<input name="" type="text" value="<?php echo ''; ?>"
                            class="price-field form-control width_12percent">
                        .</p>
                </div>
            </div>
            <div class="pl-4 d-flex">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p>{{ __("Other in the estimated amount of") }} $ &nbsp;<input name="" type="text" value="<?php echo ''; ?>"
                            class="price-field form-control width_12percent">
                        .</p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 5:") }}</span>
                <h2 class="font-lg-18">{{ __("Treatment of Nonpriority Unsecured Claims") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">5.1 &nbsp;&nbsp;{{ __("General.") }}</p>
            <p class="mb-0 mt-2">{{ __("Nonpriority unsecured claims will be paid to the extent allowed as specified in this
                Part.") }}</p>
            <p class="text-bold mb-0 mt-3">5.2 &nbsp;&nbsp;{{ __("Nonpriority unsecured claims not separately classified.") }}</p>
            <p class="mb-0 mt-2">{{ __("Allowed nonpriority unsecured claims that are not separately classified in this plan
                will be paid, pro rata, all
                funds remaining after payment of all other creditors provided under the plan. Payments to unsecured
                creditors
                will be allowed to the extent paid if an allowed amended, late filed, or late added claim reduces the
                amount
                available to unsecured creditors under this section.") }}</p>
            <p class="text-bold mb-0 mt-3">5.2.1 &nbsp;&nbsp;{{ __("Projected payment to nonpriority unsecured creditors.") }}</p>
            <p class="mb-0 mt-2">{{ __("Based upon the total payments to the trustee listed in § 2.6 of the plan, minus the
                payments under the plan
                on the claims scheduled by the debtor(s) that are provided for in §§ 3.1 through 3.3, Part 4, §§ 5.3
                through
                5.5, and Part 6 of the plan, the estimated payment to allowed nonpriority unsecured claims not
                separately
                classified under the plan is") }} $ <input name="" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_12percent">{{ __(". This amount will be shared on a pro-rata basis on
                these
                claims. This amount will not be reduced by claims arising under 11 U.S.C. § 1305 and §§ 507(a)(1)(A) and
                (B)
                that are not fully addressed in the plan, but may otherwise increase or decrease.") }}</p>
            <p class="text-bold mb-0 mt-3">5.2.2 &nbsp;&nbsp;{{ __("Required payment to nonpriority unsecured creditors under
                the liquidation test.") }}</p>
            <p class="mb-0 mt-2">{{ __("If the estate of the debtor(s) were liquidated under chapter 7, nonpriority unsecured
                claims would be paid
                approximately") }} $ <input name="" type="text" value="<?php echo ''; ?>"
                    class="price-field form-control width_12percent">{{ __(". The total of the payments on allowed nonpriority
                unsecured claims will
                be made in at least this amount, and debtor(s) will be required to make payments in addition to those
                specified
                in Part 2 to prevent the plan from going into default.") }}</p>
            <p class="text-bold mb-0 mt-3">5.3 &nbsp;&nbsp;{{ __("Interest on allowed nonpriority unsecured claims not
                separately classified.") }}</p>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Check one") }}. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }}</span> <span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 5.3 need not be completed or reproduced") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox"
                    class="height_fit_content mt-2">
                <div class="pr-3 w-100 ">
                    <p class="mb-0">{{ __("Once nonpriority unsecured claims are paid 100% without interest, accrued simple
                        interest at an annual
                        percentage rate of") }} <input name="" type="text" value="<?php echo ''; ?>"
                            class="form-control width_5percent">{{ __("% calculated as of the petition date will be paid to the
                        extent of available
                        funds") }}</p>
                </div>
            </div>
            <p class="text-bold mb-0 mt-3">5.4 &nbsp;&nbsp;{{ __("Non-filing co-debtor claim treatment for maintenance of
                payments and cure of any default on
                nonpriority unsecured claims.") }}</p>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Check one") }}. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }}</span> <span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 5.4 need not be completed or reproduced") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>{{ __("The debtor(s) will maintain the contractual installment payments and cure any default in payments
                        on
                        the unsecured claims listed below on which the last payment is due after the final plan payment.
                        The
                        allowed claim for the arrearage amount will be paid under the plan. Filed proof of claim amounts
                        will
                        control over scheduled amounts of claims.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">

                    <td class="p-2">{{ __("Name of creditor with last 4 digits of account number") }}</td>

                    <td class="p-2">{{ __("Estimated arrearage") }}</td>
                    <td class="p-2">{{ __("Interest rate on arrearage") }}</td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcpercent68 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcpercent67"><label class="p-2">%</label></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcpercent86">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcpercent87 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcpercent88"><label class="p-2">%</label></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcpercent89">
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcpercent37 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcpercent33"><label class="p-2">%</label></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12">
            <p class="text-bold mb-0 mt-3">5.5 &nbsp;&nbsp;{{ __("Other separately classified nonpriority unsecured claims.") }}</p>
            <p class="pl-4 text_italic mb-0 mt-2">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }}</span> <span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 5.5 need not be completed or reproduced.") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p>The <span class="text-bold">{{ __("nonpriority") }}</span> {{ __("unsecured allowed claims listed below are
                        separately classified and will be treated as follows:") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor") }}</td>
                    <td class="p-2">{{ __("Basis for separate classification and treatment") }}</td>
                    <td class="p-2">{{ __("Amount of claim to be paid over life of plan") }}</td>
                    <td class="p-2">Interest rate <br>{{ __("(if applicable)") }}</td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercent32 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercent31 form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcpercent39 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcpercent29"><label class="p-2">%</label></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercent19 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercent20 form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcpercent18 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcpercent17"><label class="p-2">%</label></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercent14 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcpercent13 form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcpercent11 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><input name="" type="text" value="<?php echo ''; ?>"
                                class="form-control fmcpercent1"><label class="p-2">%</label></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional claims as needed") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 6:") }}</span>
                <h2 class="font-lg-18">{{ __("Executory Contracts and Unexpired Leases") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="mb-0 mt-2">{{ __("The executory contracts and unexpired leases listed below are assumed and will be
                treated as specified.
                All other executory contracts and unexpired leases are rejected.") }} </p>
            <p class="pl-4 text_italic mb-0 mt-2">Check one. <span class="underline">{{ __("If neither box is checked, “None”
                    applies.") }}</span></p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }}</span> <span class="text_italic">{{ __("If “None” is checked, the rest of
                            § 6.1 need not be completed or reproduced") }}</span></p>
                </div>
            </div>
            <div class="d-flex pl-4">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p class="mb-0"><span class="text-bold">{{ __("Assumed items.") }}</span> {{ __("The final column includes only
                        payments disbursed by the trustee rather
                        than by the debtor(s).") }} </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 table_sect mt-2">
            <table class="text-center w-100 ">
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("Name of creditor") }}</td>
                    <td class="p-2">{{ __("Property description") }}</td>
                    <td class="p-2">Treatment <br>{{ __("(Refer to other plan section if applicable)") }}</td>
                    <td class="p-2">Current installment payment <br>{{ __("(Disbursed by Debtor(s))") }}</td>
                    <td class="p-2">{{ __("Amount of arrearage to be paid by trustee") }}</td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcprice26 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcprice27"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcprice28 form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcprice25 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcprice24 form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmcprice21 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcprice22"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="form-control fmcprice23"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcprice12 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcprice21 form-control"></div>
                    </td>
                </tr>
                <tr>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmc1 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmc2 form-control"></td>
                    <td><input name="" type="text" value="<?php echo ''; ?>" class="fmc3 form-control"></td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcprice1 form-control"></div>
                    </td>
                    <td>
                        <div class="d-flex"><label class="p-2">$</label><input name="" type="text"
                                value="<?php echo ''; ?>" class="price-field fmcprice2 form-control"></div>
                    </td>
                </tr>
            </table>
            <p class="pl-4 text_italic mb-0 mt-2">{{ __("Insert additional contracts or leases as needed.") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 7:") }}</span>
                <h2 class="font-lg-18">{{ __("Order of Distribution of Trustee Payments") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="mt-2">{{ __("Trustee will have discretion to determine the order of distribution within the requirements
                of applicable law
                and whether to reserve payment to claims that are subject to a pending objection.") }} </p>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 8:") }}</span>
                <h2 class="font-lg-18">{{ __("Vesting of Property of the Estate") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="text-bold mb-0">8.1 &nbsp;&nbsp;{{ __("General.") }}</p>
            <p class="mb-0 mt-2">{{ __("Income and earnings of the debtor(s) will remain vested in the estate until the case is
                closed. Other property of
                the estate will revest in debtor(s) upon confirmation of the plan except as elected in Section 8.2.") }}</p>
            <p class="text-bold mb-0 mt-3">8.2 &nbsp;&nbsp;{{ __("Election.") }}</p>
            <p class="mb-0 mt-2">{{ __("The following assets will remain property of the estate until the case is closed:") }} </p>
            <p class="text-bold mb-0 mt-3">8.3 &nbsp;&nbsp;{{ __("Revesting.") }}</p>
            <p class="mb-0 mt-2">{{ __("The revesting of an asset will be subject to all liens and encumbrances in existence
                when the case was
                filed, except those liens avoided by court order or extinguished by operation of law.") }}</p>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 9:") }}</span>
                <h2 class="font-lg-18">{{ __("Nonstandard Plan Provisions") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="mb-0 mt-2">{{ __("Check “None” or List Nonstandard Plan Provisions") }} </p>
            <div class="d-flex pl-4 mt-2">
                <input name="<?php echo base64_encode('rd1'); ?>" value="1" type="checkbox" class="height_fit_content">
                <div class="pr-3 w-100 ">
                    <p><span class="text-bold">{{ __("None.") }}</span> <span class="text_italic"> {{ __("If “None” is checked, the rest of
                            Part 9 need not be completed or reproduced.") }}</span></p>
                </div>
            </div>
            <p class="mb-0 mt-1 text_italic">{{ __("Under Bankruptcy Rule 3015(c), nonstandard provisions must be set forth
                below. A nonstandard provision is a
                provision not otherwise included in the Official Form or deviating from it. Nonstandard provisions set
                out
                elsewhere in this plan are ineffective.") }}</p>
            <p class="mb-0 mt-2 text_italic text-bold">{{ __("The following plan provisions will be effective only if there is
                a check in the box “Included” in § 1.2.") }}</p>
            <textarea name="<?php echo base64_encode(''); ?>" value="" class="form-control mt-2" rows="5" cols=""
                style="padding-right:5px;"><?php echo ''; ?></textarea>
        </div>
        <div class="col-md-12 mt-3">
            <div class="part-form-title">
                <span>{{ __("Part 10:") }}</span>
                <h2 class="font-lg-18">{{ __("Signatures") }}</h2>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <p class="mt-2 text-bold">{{ __("Signatures of Debtor(s) and Debtor(s)’ Attorney") }}</p>
            <p class="mt-2 text_italic">{{ __("If the Debtor(s) do not have an attorney, the Debtor(s) must sign below;
                otherwise the Debtor(s)’ signatures are
                optional. The attorney for the Debtor(s), if any, must sign below.") }}</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="<?php echo base64_encode('Statemen'); ?>" value="<?php echo $debtor_sign;?>"
                            type="text" class="form-control"><br>{{ __("Signature of Debtor 1") }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input name="<?php echo base64_encode('Statement'); ?>" value="<?php echo $debtor2_sign;?>"
                            type="text" class="form-control"><br>{{ __("Signature of Debtor 2") }}
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label style="width:120px;">{{ __("Executed on") }} </label>
                        <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text"
                            value="{{$currentDate}}" class="date_filed form-control">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label style="width:120px;">{{ __("Executed on") }} </label>
                        <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text"
                            value="{{$currentDate}}" class="date_filed form-control">
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label style="width:205px;">{{ __("Signature of Attorney for Debtor(s)") }}</label>
                        <div class="w-100">
                            <input name="<?php echo base64_encode('Attorney Sig'); ?>"
                                value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label style="width:120px;">{{ __("Date") }} </label>
                        <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text"
                            value="{{$currentDate}}" class="date_filed form-control">
                    </div>
                </div>


            </div>
            <p class="mt-2">{{ __("By filing this document, the Debtor(s), if not represented by an attorney, or the Attorney
                for Debtor(s)
                also certify(ies) that the wording and order of the provisions in this Chapter 13 plan are identical to
                those contained in CSD 1300, other than any nonstandard provisions included in Part 9.") }}</p>
        </div>


    </div>
</div>