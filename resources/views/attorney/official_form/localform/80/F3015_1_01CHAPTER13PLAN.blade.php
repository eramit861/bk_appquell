<div class="container">
    <div class="row">
        <div class="col-md-12 border_1px border_bottom_none">
            <div class="row">
                <div class="col-md-6 pt-3 pb-2" >
                    <div class="input-grpup">
                        <label>{{ __("Attorney or Party Name, Address, Telephone & FAX Numbers, State Bar Number & Email Address") }}</label>
                        <textarea name="<?php echo base64_encode('CH-13-PLAN-Text1'); ?>" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('CH-13-PLAN-Group'); ?>" value="1" type="checkbox">
                        <label for=""><i>{{ __("Debtor appearing without an attorney") }}</i></label>
                    </div>
                    <div class="input-group">
                        <input name="<?php echo base64_encode('CH-13-PLAN-Group'); ?>" value="2" type="checkbox">
                        <label for=""><i>{{ __("Attorney for Debtor") }}</i></label>
                    </div>
                </div>
            
                <div class="col-md-6 pt-3 border_left_1px">
                    <span>{{ __("FOR COURT USE ONLY") }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center p-3 border_1px">
            <p class="mb-0">
            {{ __("UNITED STATES BANKRUPTCY COURT") }} <br>
                {{ __("CENTRAL DISTRICT OF CALIFORNIA -") }} 
                <select name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" class="division_select form-control w-auto">
                    <option name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" value="**SELECT DIVISION**" >{{ __("**SELECT DIVISION**") }}</option>
                    <option name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" value="LOS ANGELES DIVISION" >{{ __("LOS ANGELES DIVISION") }}</option>
                    <option name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" value="RIVERSIDE DIVISION" >{{ __("RIVERSIDE DIVISION") }}</option>
                    <option name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" value="SANTA ANA DIVISION" >{{ __("SANTA ANA DIVISION") }}</option>
                    <option name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" value="NORTHERN DIVISION" >{{ __("NORTHERN DIVISION") }}</option>
                    <option name="<?php echo base64_encode('CH-13-PLAN-Division'); ?>" value="SAN FERNANDO VALLEY DIVISION" >{{ __("SAN FERNANDO VALLEY DIVISION") }}</option>
                </select>
            </p>
        </div>
        <div class="col-md-12 border_1px border_top_none" >
            <div class="row ">
                <div class="col-md-6 pt-3 border_right_1px">
                    <span>{{ __("List all names (including trade names) used by Debtor within the last 8 years.") }}</span>
                    <div class="input-grpup mt-3">
                        <label>{{ __("In re:") }}</label>
                        <textarea name="<?php echo base64_encode('CH-13-PLAN-Debtor'); ?>" class="form-control" rows="33" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    </div>
                    <span class="float_right">{{ __("Debtor(s).") }}</span>
                </div>
                <div class="col-md-6 pt-3">
                    <div class="row">
                        <div class="col-md-2 pt-2"> 
                            <label>{{ __("CASE NO.:") }}</label>	
                        </div>
                        <div class="col-md-5"> 
                            <input name="<?php echo base64_encode('CH-13-PLAN-Case Number'); ?>"  placeholder="" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" class=" form-control">												
                        </div>
                        <div class="col-md-5"></div>
                        <div class="col-md-12 mt-2">
                            <label>{{ __("CHAPTER 13") }} </label>	
                        </div>
                        <div class="col-md-12 mt-2 text-center border_top_1px">
                            <h3 class="mt-2">{{ __("CHAPTER 13 PLAN") }}</h3>
                        </div>
                        <div class="col-md-5 mt-2"></div>
                        <div class="col-md-7 mt-2">
                            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1'); ?>" value="0" type="checkbox">{{ __("Original") }}</p>
                            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1'); ?>" value="1" type="checkbox">1<sup>st</sup> {{ __("Amended") }}</p>
                            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1'); ?>" value="2" type="checkbox">2<sup>nd</sup> {{ __("Amended") }}</p>
                            <p class="d-flex"><input name="<?php echo base64_encode('CH-13-PLAN-Group 1'); ?>" value="3" type="checkbox"><input name="<?php echo base64_encode('CH-13-PLAN-Text9'); ?>" type="text" class="form-control width_20percent" value=""><span class="pt-2">{{ __("Amended") }}</span></p>
                        </div>
                        <div class="col-md-12 mt-2">
                            <p class="mb-1">*list below which sections have been changed:</p>     
                            <textarea name="<?php echo base64_encode('CH-13-PLAN-Text10'); ?>" class="form-control mb-2" rows="3" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                            <p class="mb-2 text-center">{{ __("[FRBP 3015(b); LBR 3015-1]") }}</p>
                        </div>
                        <div class="col-md-12 border_top_1px">
                            <h3 class="mt-2">{{ __("11 U.S.C. SECTION 341(a) CREDITORS’ MEETING:") }}</h3>
                        </div>
                        <div class="col-md-2 pt-2"> 
                            <label class="text-bold">{{ __("Date:") }}</label>	
                        </div>
                        <div class="col-md-3"> 
                            <input name="<?php echo base64_encode('CH-13-PLAN-341 date'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" class="date_filed form-control">
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-2 pt-2"> 
                            <label class="text-bold">{{ __("Time:") }}</label>	
                        </div>
                        <div class="col-md-3"> 
                            <input name="<?php echo base64_encode('CH-13-PLAN-341 time'); ?>"  placeholder="" type="text" value="<?php echo ''; ?>" class=" form-control">												
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-2 pt-2"> 
                            <label class="text-bold">{{ __("Address:") }}</label>	
                        </div>
                        <div class="col-md-10"> 
                            <textarea name="<?php echo base64_encode('CH-13-PLAN-341 address'); ?>" class="form-control mb-2" rows="3" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                        </div>
                        <div class="col-md-12">
                            <h3 class="mt-2">{{ __("PLAN CONFIRMATION HEARING: [LBR 3015-1(d)]") }}</h3>
                        </div>
                        <div class="col-md-2 pt-2"> 
                            <label class="text-bold">{{ __("Date:") }}</label>	
                        </div>
                        <div class="col-md-3"> 
                            <input name="<?php echo base64_encode('CH-13-PLAN-conf date'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" class="date_filed form-control">
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-2 pt-2"> 
                            <label class="text-bold">{{ __("Time:") }}</label>	
                        </div>
                        <div class="col-md-3"> 
                            <input name="<?php echo base64_encode('CH-13-PLAN-conf time'); ?>"  placeholder="" type="text" value="<?php echo ''; ?>" class=" form-control">												
                        </div>
                        <div class="col-md-7"></div>
                        <div class="col-md-2 pt-2"> 
                            <label class="text-bold">{{ __("Address:") }}</label>	
                        </div>
                        <div class="col-md-10"> 
                            <textarea name="<?php echo base64_encode('CH-13-PLAN-conf address'); ?>" class="form-control mb-2" rows="3" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <div class="row border_1px mt-3">
        <div class="col-md-12 mt-2 text-center text_italic">
            <p>{{ __('"Bankruptcy Code” and “11 U.S.C.” refer to the United States Bankruptcy Code, Title 11 of the United States Code.') }}<br>
            {{ __('“FRBP” refers to the Federal Rules of Bankruptcy Procedure. “LBR” and “LBRs” refer to the Local Bankruptcy Rule(s) of this court.') }}</p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 mt-2 mb-2">
            <h3>{{ __("Part 1: PRELIMINARY INFORMATION") }}</h3>
            <p class="mt-2 p_justify"><span class="text-bold">{{ __('TO DEBTOR (the term "Debtor" includes and refers to both spouses as Debtors in a joint bankruptcy case):') }}</span> {{ __('This 
                Chapter 13 Plan (Plan) sets out options that may be appropriate in some cases, but the presence of an option in this Plan
                does not indicate that the option is appropriate, or permissible, in your situation. A Plan that does not comply with local rules 
                and judicial rulings may not be confirmable. You should read this Plan carefully and discuss it with your attorney if you have 
                one. If you do not have an attorney, you may wish to consult one.') }}
            </p>
            <p class="p_justify"><span class="text-bold">{{ __("TO ALL CREDITORS:") }}</span> {{ __("This Plan is proposed by Debtor and your rights may be affected by this Plan. Your claim may be 
                reduced, modified, or eliminated. You should read this Plan carefully and discuss it with your attorney if you have one. If 
                you do not have an attorney, you may wish to consult one.") }}
            </p>
            <h4 class="text-bold text_italic">{{ __("PLEASE NOTE THAT THE PROVISIONS OF THIS PLAN MAY BE MODIFIED BY ORDER OF THE COURT.") }}</h4>
            <p class="p_justify">If you oppose this Plan’s treatment of your claim or any provision of this Plan, you or your attorney must file a written 
                objection to confirmation of the Plan at least 14 days before the date set for the hearing on confirmation. However, the 
                amounts listed on a proof of claim for an allowed secured or priority claim control over any contrary amounts listed in the 
                Plan. The Bankruptcy Court may confirm this plan without further notice if no objection to confirmation is filed. <span class="text_italic">See</span> FRBP
                3015. In addition, you must file a timely proof of claim in order to be paid under any plan. <span class="text_italic">See</span> {{ __("LBR 3015-1 and FRBP
                3002(a).") }}
            </p>
            <p>{{ __("Defaults will be cured using the interest rate set forth below in the Plan.") }}
            </p> 
            <p><span class="text-bold underline">{{ __("The following matters may be of particular importance to you:") }} </span>
            </p>
            <h4 class="text-bold text_italic">{{ __("Debtor must check one box on each line to state whether or not this Plan includes each of the following items. If 
                an item is checked as “Not included,” if both boxes are checked, or neither box is checked, the item will be 
                ineffective if set out later as a provision in this Plan.") }}</h4>
        </div>
        <div class="col-md-12">
            <span class="text-bold">1.1 &nbsp;&nbsp;&nbsp;&nbsp;{{ __("Valuation of property and avoidance of a lien on property of the bankruptcy estate, set out in Class 3B
                and/or Section IV (11 U.S.C. § 506(a) and (d)):") }}</span>
        </div>
        <div class="col-md-2">
            <p class="ml-4"><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 valuation'); ?>" value="1" type="checkbox">{{ __("Included") }}</p>
        </div>
        <div class="col-md-10">
            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 valuation'); ?>" value="2" type="checkbox">{{ __("Not Included") }}</p>
        </div>
        <div class="col-md-12">
            <span class="text-bold">1.2 &nbsp;&nbsp;&nbsp;&nbsp;{{ __("Avoidance of a judicial lien or nonpossessory, nonpurchase-money security interest, set out in Section IV 
                (11 U.S.C. § 522(f)):") }}</span>
        </div>
        <div class="col-md-2">
            <p class="ml-4"><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 avoid lien'); ?>" value="1" type="checkbox">{{ __("Included") }}</p>
        </div>
        <div class="col-md-10">
            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 avoid lien'); ?>" value="2" type="checkbox">{{ __("Not Included") }}</p>
        </div>
        <div class="col-md-12">
            <span class="text-bold">1.3 &nbsp;&nbsp;&nbsp;&nbsp;{{ __("Less than full payment of a domestic support obligation that has been assigned to a governmental unit, 
                pursuant to 11 U.S.C. §1322(a)(4). This provision requires that payments in Part 2 Section I.A. be for a 
                term of 60 months:") }} </span>
        </div>
        <div class="col-md-2">
            <p class="ml-4"><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 DMO'); ?>" value="1" type="checkbox">{{ __("Included") }}</p>
        </div>
        <div class="col-md-10">
            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 DMO'); ?>" value="2" type="checkbox">{{ __("Not Included") }}</p>
        </div>
        <div class="col-md-12">
            <span class="text-bold">1.4 &nbsp;&nbsp;&nbsp;&nbsp;{{ __("Other Nonstandard Plan provisions, set out in Section IV:") }}</span>
        </div>
        <div class="col-md-2">
            <p class="ml-4"><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 Nonstandard Provisions'); ?>" value="1" type="checkbox">{{ __("Included") }}</p>
        </div>
        <div class="col-md-10">
            <p><input name="<?php echo base64_encode('CH-13-PLAN-Group 1 Nonstandard Provisions'); ?>" value="2" type="checkbox">{{ __("Not Included") }}</p>
        </div>
        <div class="col-md-12">
            <p><span class="text-bold">{{ __("ALL CREDITORS ARE REQUIRED TO FILE A PROOF OF CLAIM IN ORDER TO HAVE AN ALLOWED CLAIM, EXCEPT 
                AS PROVIDED IN FRBP 3002(a).") }}</span> {{ __("A Debtor whose Plan is confirmed may be eligible thereafter to receive a discharge of 
                debts to the extent specified in 11 U.S.C. § 1328.") }}
            </p>
            <p>{{ __("Regardless of whether this Plan treats a claim as secured or unsecured, any lien securing such claim is not avoided other 
                than as provided by law or order of the court.") }}
            </p>
            <h3>{{ __("Part 2: PLAN TERMS") }}</h3>
            <p class="mt-2 mb-2">{{ __("Debtor proposes the following Plan terms and makes the following declarations:") }}
            </p>
            <h3>{{ __("Section I. PLAN PAYMENT AND LENGTH OF PLAN") }}</h3>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>A.</span>
                <div class="pl-3">
                    <p>{{ __("Monthly Plan Payments will begin 30 days from the date the bankruptcy petition was filed. If the payment due date
                        falls on the 29th, 30th, or 31st day of the month, payment is due on the 1st day of the following month (LBR
                        3015-1(k)(1)(A)).") }}
                    </p>
                    <p class="pl-3">{{ __("Payments by Debtor of:") }}</p>

                    <div class="row pl-3">
                        <div class="col-md-2 d-flex pr-0">
                            <label class="pt-2">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A 1a'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-3 d-flex pl-0 pr-0">
                            <span class="pt-2">{{ __("per month for months 1 through") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A1 months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_30percent">
                        </div>  
                        <div class="col-md-7 d-flex pl-0">
                            <span class="pt-2">{{ __("Totaling") }} $&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A 1b'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_20percent"><span class="pt-2">.</span>
                        </div> 

                        <div class="col-md-2 mt-1 d-flex pr-0">
                            <label class="pt-2">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A 2a'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-2 mt-1 d-flex pl-0 pr-0">
                            <span class="pt-2">{{ __("per month for months") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A2a months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_30percent">
                        </div> 
                        <div class="col-md-2 mt-1 d-flex pr-0 pl-0">
                            <span class="pt-2"> {{ __("through") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A2b months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                        </div>  
                        <div class="col-md-6 mt-1 d-flex pl-0">
                            <span class="pt-2">{{ __("Totaling") }} $&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A2b'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_20percent"><span class="pt-2">.</span>
                        </div> 

                        <div class="col-md-2 mt-1 d-flex pr-0">
                            <label class="pt-2">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A3a'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-2 mt-1 d-flex pl-0 pr-0">
                            <span class="pt-2">{{ __("per month for months") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A3a months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_30percent">
                        </div> 
                        <div class="col-md-2 mt-1 d-flex pr-0 pl-0">
                            <span class="pt-2"> {{ __("through") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A3b months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                        </div>  
                        <div class="col-md-6 mt-1 d-flex pl-0">
                            <span class="pt-2">{{ __("Totaling") }} $&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A3b'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_20percent"><span class="pt-2">.</span>
                        </div> 

                        <div class="col-md-2 mt-1 d-flex pr-0">
                            <label class="pt-2">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A4a'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-2 mt-1 d-flex pl-0 pr-0">
                            <span class="pt-2">{{ __("per month for months") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A4a months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_30percent">
                        </div> 
                        <div class="col-md-2 mt-1 d-flex pr-0 pl-0">
                            <span class="pt-2"> {{ __("through") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A4b months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                        </div>  
                        <div class="col-md-6 mt-1 d-flex pl-0">
                            <span class="pt-2">{{ __("Totaling") }} $&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A 4a'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_20percent"><span class="pt-2">.</span>
                        </div> 
                        <div class="col-md-12 mt-1 d-flex ">
                            <span class="pt-2"> {{ __("For a total plan length of") }}&nbsp;</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-Total Months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_5percent">
                            <span class="pt-2">{{ __("months totaling $") }}</span>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1A Total'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                            <span class="pt-2">.</span>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <div class="d-flex">
                <span>B.</span>
                <div class="pl-3">
                    <p>{{ __("Nonpriority unsecured claims.") }}
                    </p>

                    <div class="row pl-3">
                        <div class="col-md-12 d-flex">
                            <label class="pt-2">{{ __("The total amount of estimated non-priority unsecured claims is $") }}</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-1B total unsec claim'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                        </div>
                        
                        <div class="col-md-12 d-flex mt-2 pr-0">
                            <label>1.</label>
                            <div class="row pl-3">
                                <div class="col-md-12">
                                    <p>
                                        {{ __("Unless otherwise ordered by the court, after Class 1 through Class 4 creditors are paid, allowed nonpriority
                                        unsecured claims that are not separately classified (Class 5) will be paid pro rata per the option checked
                                        below. If both options below are checked, the option providing the largest payment will be effective.") }}
                                    </p>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <span class="pt-2"> {{ __("a.") }}&nbsp;</span>
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Section 1 B1'); ?>" value="1" type="checkbox">
                                    <span class="pt-2 text-bold"> {{ __("“Percentage” plan:") }} &nbsp;</span>
                                    <input name="<?php echo base64_encode('CH-13-PLAN-1B1a percentage'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_5percent">
                                    <span class="pt-2">{{ __("% of the total amount of these claims, for an estimated total payment of $") }}</span>
                                    <input name="<?php echo base64_encode('CH-13-PLAN-1B1a sum'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                                </div>
                                <div class="col-md-12 d-flex">
                                    <span class="pt-3"> {{ __("b.") }}&nbsp;</span>
                                    <p class="pt-2"><input name="<?php echo base64_encode('CH-13-PLAN-Section 1 B1'); ?>" value="2" type="checkbox">
                                        <span class="text-bold"> {{ __("“Residual” plan:") }} &nbsp;</span>he remaining funds, after disbursements have been made to all other 
                                        creditors provided for in this Plan, estimated to pay a total of $ <input name="<?php echo base64_encode('CH-13-PLAN-1B1b sum'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_12percent">
                                        and <input name="<?php echo base64_encode('CH-13-PLAN-1B1b percentage'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_5percent">
                                        {{ __("% to claims in Class 5. The amount distributed to Class 5 claims may be less than the amount 
                                        specified here depending on the amount of secured and priority claims allowed.") }} 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex mt-2 pr-0">
                            <label>2.</label>
                            <div class="row pl-3">
                                <div class="col-md-12">
                                    <p>
                                        {{ __("Minimum Plan payments. Regardless of the options checked above, payments on allowed nonpriority
                                        unsecured claims will be made in at least the greater of the following amounts:") }}
                                    </p>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <span class="pt-3"> {{ __("a.") }}&nbsp;</span>
                                    <p class="pt-2">
                                    {{ __("the sum of") }} $ <input name="<?php echo base64_encode('CH-13-PLAN-1B2a sum'); ?>" type="text" value="<?php echo ''; ?>" class=" price-field form-control width_12percent">
                                        {{ __(", representing the liquidation value of the estate in a hypothetical
                                        Chapter 7 case under 11 U.S.C. § 1325(a)(4), or") }}
                                    </p>
                                </div>
                                <div class="col-md-12 d-flex">
                                    <span class="pt-2"> {{ __("b.") }}&nbsp;</span>
                                    <p>
                                    {{ __("if Debtor has above-median income and otherwise subject to 11 U.S.C. § 1325(b), the sum of") }}
                                        $ <input name="<?php echo base64_encode('CH-13-PLAN-1B2b sum'); ?>" type="text" value="<?php echo ''; ?>" class=" price-field form-control width_12percent">
                                        {{ __(", representing all disposable income payable for 60 months under the means test.") }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>C.</span>
                <div class="pl-3">
                    <p>{{ __("Income tax refunds. Debtor will provide the Chapter 13 Trustee with a copy of each income tax return filed during
                        the Plan term within 14 days of filing the return and, unless the Plan provides 100% payment to nonpriority
                        unsecured creditors (Class 5), will turn over to the Chapter 13 Trustee all federal and state income tax refunds
                        received for the term of the plan. The Debtor may retain a total of $500 of the sum of the federal and state tax
                        refunds for each tax year. Income tax refunds received by the debtor and turned over to the Chapter 13 Trustee or
                        directly turned over to the Chapter 13 Trustee by the taxing authorities do not decrease the total amount of
                        payments stated in Section I.A., above. The refunds are pledged to the plan in addition to the amounts stated in
                        Section I.A. and can be used by the Chapter 13 Trustee to increase the percentage paid to general unsecured
                        creditors without further order of the Bankruptcy Court.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>D.</span>
                <div class="pl-3">
                    <p>{{ __("In the event that secured creditor(s) file a Notice of Postpetition Fees and Costs pursuant to FRBP 3002.1(c), the
                        Chapter 13 Trustee is authorized, but not required, to commence paying those charges 90 days after that notice is
                        filed, unless within that time the Debtor contests those charges by filing a motion to determine payment under FRBP
                        3002.1(e) or agrees to pay those charges by filing a motion to modify this Plan.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>E.</span>
                <div class="pl-3 table_sect">
                    <p>{{ __("Debtor must make preconfirmation adequate protection payments for any creditor that holds an allowed claim secured 
                        by personal property where such security interest is attributable to the purchase of such property and preconfirmation 
                        payments on leases of personal property whose allowed claim is impaired by the terms proposed in this Plan. Debtor 
                        must make preconfirmation adequate protection payments and preconfirmation lease payments to the Chapter 13 
                        Trustee for the following creditor(s) in the following amounts:") }}
                    </p>
                    <table class="text-center w-100">
                        <tr class="bg-dgray">
                            <td class="p-2">{{ __("Creditor/Lessor Name") }}</td>
                            <td class="p-2">{{ __("Collateral Description") }}</td>
                            <td class="p-2">{{ __("Last 4 Digits of Account #") }}</td>
                            <td class="p-2">{{ __("Amount") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F account#'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F amount'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr><tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F2 creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F2 collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F2 account#'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F2 amount'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F 3creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F3 collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F3 account#'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F3 amount'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                    </table>
                    <p class="mt-2">{{ __("Each adequate protection payment or preconfirmation lease payment will accrue beginning the 30th day from the 
                        date of filing of the case. The Chapter 13 Trustee must deduct the foregoing adequate protection payment(s) and/or 
                        preconfirmation lease payment from Debtor's Plan Payment and disburse the adequate protection payment or 
                        preconfirmation lease payment to the secured creditor(s) at the next disbursement or as soon as practicable after the 
                        payment is received and posted to the Chapter 13 Trustee’s account. The Chapter 13 Trustee will collect his or her 
                        statutory fee on all receipts made for preconfirmation adequate protection payments or preconfirmation lease 
                        payments.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>F.</span>
                <div class="pl-3">
                    <p>{{ __("Debtor must not incur debt greater than $1,000 without prior court approval unless the debt is incurred in the ordinary 
                        course of business pursuant to 11 U.S.C. §1304(b) or for medical emergencies.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>G.</span>
                <div class="pl-3">
                    <p>{{ __("The Chapter 13 Trustee is authorized to disburse funds after the date Plan confirmation is announced in open court.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>H.</span>
                <div class="pl-3">
                    <p>{{ __("Debtor must file timely all postpetition tax returns and pay timely all postconfirmation tax liabilities directly to the 
                        appropriate taxing authorities.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>I.</span>
                <div class="pl-3">
                    <p>{{ __("Debtor must pay all amounts required to be paid under a Domestic Support Obligation that first became payable after 
                        the date of the filing of the bankruptcy petition") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>J.</span>
                <div class="pl-3">
                    <p>{{ __("If the Plan proposes to avoid a lien of a creditor, the Chapter 13 Trustee must not disburse any payments to that 
                        creditor on that lien until the Plan confirmation order is entered.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span>K.</span>
                <div class="pl-3">
                    <p>{{ __("Debtor must pay all required ongoing property taxes and insurance premiums for all real and personal property that
                        secures claims paid under the Plan.") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <h3>{{ __("Section II. ORDER OF PAYMENT OF CLAIMS; CLASSIFICATION AND TREATMENT OF CLAIMS:") }}</h3>
            <div class="d-flex mt-1">
                <span>&nbsp;&nbsp;</span>
                <div class="pl-3">
                    <p>{{ __("Except as otherwise provided in this Plan, the Chapter 13 Trustee must disburse all available funds for the payment of claims as follows") }}
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="d-flex">
                <span class="text-bold">A.</span>
                <div class="pl-3">
                    <p class="text-bold">{{ __("ORDER OF PAYMENT OF CLAIMS:") }} 
                    </p>
                    <div class="d-flex">
                        <span class="text-bold">1st</span>
                        <div class="pl-3">
                            <p>{{ __("If there are Domestic Support Obligations, the order of priority will be:") }}
                            </p>
                            <p>{{ __("(a) Domestic Support Obligations and the Chapter 13 Trustee’s fee not exceeding the amount accrued on Plan 
                                Payments made to date;") }}
                            </p>
                            <p>{{ __("(b) Administrative expenses (Class 1(a)) until paid in full;") }}
                            </p>
                            <p>If there are <span class="underline">{{ __("No") }}</span> {{ __("Domestic Support Obligations, the order of priority will be:") }}
                            </p>
                            <p>{{ __("(a) The Chapter 13 Trustee’s fee not exceeding the amount accrued on Plan Payments made to date;") }}
                            </p>
                            <p>{{ __("(b) Administrative expenses (Class 1(a)) until paid in full.") }} 
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <span class="text-bold">2nd</span>
                        <div class="pl-3">
                            <p>{{ __("Subject to the 1st paragraph") }}, <span class="text_italic">{{ __("pro rata") }}</span> {{ __("to all secured claims and all priority unsecured claims until paid in full except 
                                as otherwise provided in this Plan.") }}
                            </p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <span class="text-bold">3rd</span>
                        <div class="pl-3">
                            <p>{{ __("Non-priority unsecured creditors will be paid") }} <span class="text_italic">{{ __("pro rata") }}</span> {{ __("except as otherwise provided in this Plan. No payment will
                                be made on nonpriority unsecured claims until all the above administrative, secured and priority claims have been 
                                paid in full unless otherwise provided in this Plan.") }} 
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex">
                <span class="text-bold">B.</span>
                <div class="pl-3 table_sect">
                    <p class="text-bold">{{ __("CLASSIFICATION AND TREATMENT OF CLAIMS:") }} 
                    </p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="4" class="p-2 text-center">{{ __("CLASS 1") }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="p-2 text-center">
                                <h3>{{ __("ALLOWED UNSECURED CLAIMS ENTITLED TO PRIORITY UNDER 11 U.S.C. §507") }}</h3><br>
                                <p>{{ __("Class 1 claims will be paid in full pro rata. Any treatment that proposes to pay claims in Class 1(a) or 1(b) less than in 
                                    full must be agreed to in writing by the holder of each such claim and specifically addressed in Section IV.D.") }}</p>
                                <p class="mb-0">{{ __("Unless otherwise ordered by the court, the claim amount stated on a proof of claim, and the dollar amount of any 
                                    allowed administrative expense, controls over any contrary amount listed below.") }}</p>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("CATEGORY") }}</td>
                            <td class="p-2">{{ __("AMOUNT OF PRIORITY CLAIM") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE, if any") }}</td>
                            <td class="p-2">{{ __("TOTAL PAYMENT") }}</td>
                        </tr>
                        <tr class="bg_black text_white">
                            <td colspan="4" class="p-2">{{ __("a. Administrative Expenses") }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="p-2">{{ __("(1) Chapter 13 Trustee’s Fee – estimated at 11% of all payments to be made to all classes through this Plan") }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(2) Attorney’s Fees") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a2 attorney fees'); ?>" type="text" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="price-by-attorney price-field form-control"></td>
                            <td class="p-2 bg_black"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a2 attorney total payment'); ?>" type="text" value="<?php echo '0.00'; ?>" class="price-field form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(3) Chapter 7 Trustee's Fees") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a3 Ch7 trustee fees'); ?>" type="text" value="<?php echo '0.00'; ?>" class="price-field form-control"></td>
                            <td class="p-2 bg_black"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a3 Ch7 trustee total payment'); ?>" type="text" value="<?php echo '0.00'; ?>" class="price-field form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(4) Other") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a4 other fees'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></td>
                            <td class="p-2 bg_black"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a4 other total payment'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(5) Other") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a4 other fees2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2 bg_black"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2a4 other total payment2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr class="bg_black text_white">
                            <td colspan="4" class="p-2">{{ __("b. Other Priority Claims") }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(1) Internal Revenue Service") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b1 IRS'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b1 IRS percentage'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b1 IRS total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(2) Franchise Tax Board") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b2 franchise tax bd'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b2 franhcis tax bd percentage'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b2 franchise tax bd total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(3) Domestic Support Obligation") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b3 DMO'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b3 DMO percentage'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b3 DMO total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td class="p-2">{{ __("(4) Other") }}</td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b4 Other priority claim'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b4 Other percentage'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2b4 Other priority claim total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr class="bg_black text_white">
                            <td colspan="4" class="p-2">c. Domestic Support Obligations that have been assigned to a governmental unit and are not to be paid in full in the
                                Plan pursuant to 11 U.S.C. §1322(a)(4) (this provision requires that payments in Part 2 Section I.A. be for a term of
                                60 months)<br><br><span class="text_italic mt-2">{{ __("(specify creditor name):") }}</span>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2c DMO priority claim'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2c DMO percent'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2c DMO total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-1F creditor2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2c DMO priority claim2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2c DMO percent2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-II B2c DMO total payment2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class1 claims'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 1.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="7" class="p-2 text-center">{{ __("CLASS 2") }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-2 ">
                                <h3 class="text-center">{{ __("CLAIMS SECURED SOLELY BY PROPERTY THAT IS DEBTOR’S PRINCIPAL RESIDENCE") }}<br>
                                {{ __("ON WHICH OBLIGATION MATURES") }} <span class="underline">{{ __("AFTER") }}</span> {{ __("THE FINAL PLAN PAYMENT IS DUE") }}</h3>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <p><input name="<?php echo base64_encode('Check Box1'); ?>" value="Yes" type="checkbox">None. <span class="text_italic">{{ __("If “None” is checked, the rest of this form for Class 2 need not be completed.") }}</span></p>
                                <p class="p_justify"><input name="<?php echo base64_encode('Check Box2'); ?>" value="Yes" type="checkbox">{{ __("Debtor will maintain and make the current contractual installment payments on the secured claims listed below, with 
                                    any changes required by the applicable contract and noticed in conformity with any applicable rules. Unless otherwise 
                                    ordered by the court, these payments will be disbursed either by the Chapter 13 Trustee or directly by Debtor, as 
                                    specified below. Debtor will cure the prepetition arrearages, if any, on a listed claim through disbursements by the 
                                    Chapter 13 Trustee, with interest, if any, at the rate stated.") }}</p>
                                <p class="mb-0 pl-4">{{ __("The arrearage amount stated on a proof of claim controls over any contrary amount listed below.") }}</p>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                            <td class="p-2">{{ __("AMOUNT OF ARREARAGE, IF ANY") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENT ON ARREARAGE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                            <td class="p-2">{{ __("POST-PETITION PAYMENT DISBURSING AGENT") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 creditor name a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 acct no a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 Amt Arrearage a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-vClass 2 interest a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 est mo pay arrearage a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Clas 2 est Total Payments a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 a checkbox'); ?>" value="Choice1" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 a checkbox'); ?>" value="Choice2" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 creditor name b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 acct no b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 Amt Arrearage b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-vClass 2 interest b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 est mo pay arrearage b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Clas 2 est Total Payments b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-CH-13-PLAN-Class 2 b checkbox'); ?>" value="2" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-CH-13-PLAN-Class 2 b checkbox'); ?>" value="0" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 creditor name c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 acct no c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 Amt Arrearage c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-vClass 2 interest c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 est mo pay arrearage c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Clas 2 est Total Payments c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 c checkbox'); ?>" value="2" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 2 c checkbox'); ?>" value="0" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class2 claims'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 2.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td class="p-2 text-center">{{ __("CLASS 3A") }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-2">
                                <h3 class="text-center">{{ __("UNIMPAIRED CLAIMS TO BE PAID DIRECTLY BY DEBTOR") }}</h3>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <p><input name="<?php echo base64_encode('CH-13-PLAN-CH-13-PLAN-Class 3A'); ?>" value="Entire Hearing" type="checkbox">None. <span class="text_italic">{{ __("If “None” is checked, the rest of this form for Class 3A need not be completed.") }}</span></p>
                                <p><input name="<?php echo base64_encode('CH-13-PLAN-CH-13-PLAN-Class 3A'); ?>" value="2" type="checkbox">{{ __("Debtor will make regular payments, including any preconfirmation payments, directly to the following creditors
                                    in accordance with the terms of the applicable contract (Include Creditor Name and Last 4 Digits of Account Number):") }}</p>
                                <textarea name="<?php echo base64_encode('Class 3A Text Field'); ?>" class="form-control mb-2" rows="3" cols=""><?php echo ''; ?></textarea>
                                <p class="mb-0 pl-4">{{ __("The claims of these creditors are unimpaired under the plan.") }}</p>
                            </td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class3a claims'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 3A.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="7" class="p-2 text-center">{{ __("CLASS 3B") }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-2">
                                <h3 class="text-center">CLAIMS SECURED BY REAL OR PERSONAL PROPERTY WHICH ARE TO BE BIFURCATED <br>
                                    {{ __("AND PAID IN FULL DURING THE TERM OF THIS PLAN.") }} </h3>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <p><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B'); ?>" value="Entire Hearing" type="checkbox">None. <span class="text_italic"> {{ __("If “None” is checked, the rest of this form for Class 3B need not be completed") }}</span></p>
                                <p><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B'); ?>" value="2" type="checkbox">{{ __("Debtor proposes:") }}</p>
                                <div class="pl-4">
                                    <p><span class="text-bold">{{ __("Bifurcation of Claims - Dollar amounts/lien avoidance.") }}</span> {{ __("Except as provided below regarding bifurcation of 
                                    claims into a secured part and an unsecured part, the claim amounts listed on a proof of claim control this 
                                    Plan over any contrary amounts listed below.") }}</p>
                                    <div class="d-flex">
                                        <label>(a)</label>
                                        <div class="pl-3">
                                            <p><span class="underline">{{ __('Bifurcated claims - secured parts:") }}</span> {{ __("Debtor proposes that, for the purposes of distributions under this 
                                            Plan, the dollar amount of secured claims in this Class 3B should be as set forth in the column
                                            headed “Secured Claim Amount.” For that dollar amount to be binding on the affected parties, either') }} </p>
                                            <div class="d-flex">
                                                <label>(i)</label>
                                                <div class="pl-3">
                                                    <p>{{ __("Debtor must obtain a court order granting a motion fixing the dollar amount of the secured claim 
                                                        and/or avoiding the lien, or") }} </p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <label>{{ __("(ii)") }}</label>
                                                <div class="pl-3">
                                                    <p>{{ __('Debtor must complete and comply with Part 2 Section IV.C., so that the Plan itself serves as such 
                                                        a motion; the "Included" boxes must be checked in Part 1 Paragraphs 1.1 and/or 1.2 (indicating 
                                                        that this Plan includes valuation and lien avoidance, and/or avoidance of a judicial lien or 
                                                        nonpossessory, nonpurchase-money lien in Section IV.C.); and this Plan must be confirmed - if 
                                                        any one of those conditions is not satisfied, then the claim will not be bifurcated into a secured 
                                                        part and an unsecured part pursuant to this sub-paragraph.') }} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <label>(b)</label>
                                        <div class="pl-3">
                                            <p><span class="underline">{{ __("Bifurcated claims - unsecured parts:") }}</span> {{ __("Any allowed claim that exceeds the amount of the secured claim 
                                                will be treated as a nonpriority unsecured claim in Class 5 below.") }}</p>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                            <td class="p-2">{{ __("CLAIM TOTAL") }}</td>
                            <td class="p-2">{{ __("SECURED CLAIM AMOUNT") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENTS") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B creditor name a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B acct no a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B claim total a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B secured amount a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B interest rate a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="0.00%"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B estimated mo payment a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B estimated Total payment a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B creditor name b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B acct no b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B claim total b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B secured amount b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3B interest rate b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="0.00%"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B estimated mo payment b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3B estimated Total payment b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class3b claims'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 3B.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="6" class="p-2 text-center">{{ __("CLASS 3C") }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-2">
                                <h3 class="text-center">{{ __("CLAIMS SECURED BY REAL OR PERSONAL PROPERTY WHICH ARE TO BE PAID") }}<br>
                                    {{ __("IN FULL DURING THE TERM OF THIS PLAN (WITHOUT BIFURCATION), INCLUDING CURE OF") }} <br>
                                    {{ __("ARREARS, IF APPLICABLE.") }}  </h3>
                                <p class="text_italic">{{ __("Check all that apply.") }} </p>

                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 3c'); ?>" value="0" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p>None.<span class="text_italic"> {{ __("If “None” is checked, the rest of this form for Class 3C need not be completed.") }}</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 3c'); ?>" value="1" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p class="p_justify">{{ __("Debtor proposes to treat the claims listed below as fully secured claims on the terms set forth below. These 
                                        claims will not be bifurcated. The claim amounts listed on a proof of claim control this Plan over any contrary 
                                        amounts listed below.") }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td colspan="6" class="p-2 text_italic"><h3>{{ __("IMPAIRED CLAIMS PAID THROUGH THE PLAN BY THE TRUSTEE") }}</h3></td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                            <td class="p-2">{{ __("CLAIM TOTAL") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENTS") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c creditor name a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c acct no'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3c claim total'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c interest rate'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3c estimated mo payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3c estimated Total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td colspan="6" class="p-2 text_italic"><h3>{{ __("CURE AND MAINTAIN CLAIMS") }}</h3></td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-2">
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p>{{ __("Debtor will maintain and make the current contractual installment payments (Ongoing Payments) on the secured 
                                            claims listed below pursuant to the terms of the applicable contract, except as stated otherwise in this Plan. 
                                            These payments will be disbursed either by the Chapter 13 Trustee or directly by Debtor, as specified below. 
                                            Debtor will cure and pay the prepetition arrearages, if any, on a claim listed below through disbursements by the 
                                            Chapter 13 Trustee, with interest, if any, at the rate stated. The dollar amount of arrearage stated on a proof of 
                                            claim controls over any contrary amount listed below") }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="w-100">
                        <tr class="text-center bg-dgray">
                            <td rowspan="3" class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td rowspan="3" class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                        </tr>
                        <tr class="text-center bg_black text_white">
                            <td colspan="5" class="p-2">{{ __("Cure of Default") }}</td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("AMOUNT OF ARREARAGE, IF ANY") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENTS ON ARREARAGE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                            <td class="p-2">{{ __("ONGOING PAYMENT DISBURSING AGENT") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c Cure creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c cure account'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3c arrearage amt'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c default interest rate'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __('0.00%') }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3c estimated arrearage payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3c Default estimated Total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c Trustee'); ?>" value="Choice1" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c Trustee'); ?>" value="Choice2" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c Cure'); ?>" value="1" type="checkbox">{{ __("See attachment for additional claims in Class 3C.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="6" class="p-2 text-center">{{ __("CLASS 3D") }}</td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-2">
                                <h3 class="text-center">{{ __("SECURED CLAIMS EXCLUDED FROM 11 U.S.C. §506") }}</h3>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 3c Trustee1'); ?>" value="Choice3" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p><span class="text-bold">{{ __("None.") }}</span><span class="text_italic"> If “None” is checked, the rest of this form for Class 3D need not be completed.</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 3c Trustee1'); ?>" value="Choice4" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p>{{ __("The claims listed below were either:") }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <label class="pl-2">1.</label>
                                    <div class="pl-2">
                                        <p>{{ __("Incurred within 910 days before the petition date and secured by a purchase money security interest in a motor 
                                            vehicle acquired for the personal use of Debtor, or") }}</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <label class="pl-2">2.</label>
                                    <div class="pl-2">
                                        <p>{{ __("Incurred within 1 year of the petition date and secured by a purchase money security interest in any other thing of value.") }}</p>
                                    </div>
                                </div>
                                <p class="mb-0">{{ __("These claims will be paid in full under this Plan with interest at the rate stated below. The claim amount stated on a
                                    proof of claim controls over any contrary amount listed below.") }}</p>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                            <td class="p-2">{{ __("CLAIM TOTAL") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENTS") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d creditor name a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d acct no'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d claim total'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d interest rate'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d estimated mo payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d estimated Total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d creditor name b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d acct no b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d claim total b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d interest rate b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d estimated mo payment b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d estimated Total payment b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d creditor name c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3c acct no c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d claim totalc'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 3d interest ratec'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d estimated mo paymentc'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3d estimated Total paymentc'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('Check Box4'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 3D.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="7" class="p-2 text-center">{{ __("CLASS 4") }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-2">
                                <h3 class="text-center">{{ __("OTHER CLAIMS ON WHICH THE LAST PAYMENT ON A CLAIM IS DUE") }}<br>
                                    {{ __("AFTER THE DATE ON WHICH THE FINAL PLAN PAYMENT IS DUE,") }} <br>
                                    {{ __("WHICH ARE PROVIDED FOR UNDER 11 U.S.C. §1322(b)(5)") }}</h3>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 4'); ?>" value="Entire Hearing" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p><span class="text-bold">None.</span><span class="text_italic"> {{ __("If “None” is checked, the rest of this form for Class 4 need not be completed.") }}</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 4'); ?>" value="2" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p class="p_justify">{{ __("Debtor will maintain and make the current contractual installment payments (Ongoing Payments) on the secured 
                                            claims listed below pursuant to the terms of the applicable contract, except as stated otherwise in this Plan. These
                                            payments will be disbursed either by the Chapter 13 Trustee or directly by Debtor, as specified below. Debtor will 
                                            cure and pay the prepetition arrearages, if any, on a claim listed below through disbursements by the Chapter 13 
                                            Trustee, with interest, if any, at the rate stated. The dollar amount of arrearage stated on a proof of claim controls 
                                            over any contrary amount listed below.") }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td rowspan="3" class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td rowspan="3" class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                        </tr>
                        <tr class="text-center bg_black text_white">
                            <td colspan="5" class="p-2">{{ __("Cure of Default") }}</td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("AMOUNT OF ARREARAGE, IF ANY") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENTS ON ARREARAGE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                            <td class="p-2">{{ __("ONGOING PAYMENT DISBURSING AGENT") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 creditor name a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 acct no a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-3A claim total a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 interest rate a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 estimated mo payment a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 estimated Total payment a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 a trustee/debtor'); ?>" value="Entire Hearing" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 a trustee/debtor'); ?>" value="2" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 creditor name b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 acct no b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4A claim total b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 interest rateb'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 estimated mo payment b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 estimated Total payment b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 b trustee/debtor'); ?>" value="Entire Hearing" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 b trustee/debtor'); ?>" value="2" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 creditor name c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 acct no c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 claim total c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 interest ratec'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 estimated mo payment c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-4 estimated Total payment c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td class="p-2">
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 c trustee/debtor'); ?>" value="Entire Hearing" type="checkbox">{{ __("Trustee") }}</p>
                                <p class="mb-0"><input name="<?php echo base64_encode('CH-13-PLAN-Class 4 c trustee/debtor'); ?>" value="2" type="checkbox">{{ __("Debtor") }}</p>
                            </td>
                        </tr>
                        <tr class="bg_black">
                            <td colspan="7" class="p-2"></td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class4 claims'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 4.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td class="p-2 text-center">{{ __("CLASS 5A") }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">
                                <h3 class="text-center">{{ __("NON-PRIORITY UNSECURED CLAIMS NOT SEPARATELY CLASSIFIED") }}</h3>
                                <p class="mb-0">{{ __("Allowed nonpriority unsecured claims not separately classified must be paid pursuant to Section I.B. above.") }} </p>
                            </td>
                        </tr>
                        <tr class="bg_black">
                            <td class="p-2"></td>
                        </tr>
                    </table>
                    <h3 class="text-center mt-2">{{ __("SEPARATE CLASSIFICATION:") }}</h3>
                    <h3 class="text_italic pl-1">{{ __("Check all that apply if Debtor proposes any separate classification of nonpriority unsecured claims.") }}</h3>
                    <div class="d-flex">
                        <input name="<?php echo base64_encode('CH-13-PLAN-5a'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                        <div>
                            <p><span class="text-bold">None.</span><span class="text_italic"> If “None” is checked, the rest of this form for Class 5 need not be completed.</span></p>
                        </div>
                    </div>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="5" class="p-2 text-center">{{ __("CLASS 5B") }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="p-2">
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-5b'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p class="mb-0"><span class="text-bold">{{ __("Maintenance of payments.") }}</span> {{ __("Debtor will maintain and make the contractual installment payments on the unsecured 
                                            claims listed below on which the last payment is due after the final Plan payment. The contractual installment 
                                            payments will be disbursed by Debtor.") }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED MONTHLY PAYMENTS") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5bcreditor name'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 acct no a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 interest rate'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 estimated mo payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 estimated Total payment'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5b2creditor name'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 acct no a2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 interest rateb2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 estimated mo paymentb2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5-1stimated Total paymentb2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                    </table>
                    <table class="w-100 mt-3">
                        <tr class="bg_black text_white">
                            <td colspan="5" class="p-2 text-center">{{ __("CLASS 5C") }}</td>
                        </tr>
                        <tr>
                            <td colspan="5" class="p-2">
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-5c'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p class="mb-0"><span class="text-bold">{{ __("Other separately classified nonpriority unsecured claims.") }}</span></p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr class="text-center bg-dgray">
                            <td class="p-2">{{ __("NAME OF CREDITOR") }}</td>
                            <td class="p-2">{{ __("LAST 4 DIGITS OF ACCOUNT NUMBER") }}</td>
                            <td class="p-2">{{ __("AMOUNT TO BE PAID ON THE CLAIM") }}</td>
                            <td class="p-2">{{ __("INTEREST RATE") }}</td>
                            <td class="p-2">{{ __("ESTIMATED TOTAL PAYMENTS") }}</td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5c creditor name'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 acct no c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 AMT pd claim a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 interest rate c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 estimated Total payment c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                        <tr>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5c2 creditor name'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 acct no c2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 amt pd claim 2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-Class 5 interest rate c2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control" placeholder="{{ __("0.00%") }}"></td>
                            <td><input name="<?php echo base64_encode('CH-13-PLAN-5 estimated Total payment c2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                        </tr>
                    </table>
                    <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-5d'); ?>" value="Yes" type="checkbox">{{ __("See attachment for additional claims in Class 5.") }}</p>
                    <table class="w-100">
                        <tr class="bg_black text_white">
                            <td colspan="7" class="p-2 text-center">{{ __("CLASS 6") }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-2">
                                <h3 class="text-center">{{ __("SURRENDER OF COLLATERAL") }}</h3>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 6'); ?>" value="Entire Hearing" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p><span class="text-bold">None.</span><span class="text_italic"> {{ __("If “None” is checked, the rest of this form for Class 6 need not be completed.") }}</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 6'); ?>" value="2" type="checkbox" class="height_fit_content">
                                    <div class="row pr-3">
                                        <div class="col-md-12">
                                            <p class="p_justify">{{ __("Debtor elects to surrender to each creditor listed below the collateral that secures the creditor’s claim. Debtor 
                                                requests that upon confirmation of the Plan the stay under 11 U.S.C. § 362(a) be terminated as to the collateral only 
                                                and that the stay under 11 U.S.C. §1301 be terminated in all respects. Any allowed unsecured claim resulting from 
                                                the disposition of the collateral will be treated in Class 5 above.") }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-bold mb-0">{{ __("Creditor Name:") }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-bold mb-0">{{ __("Description:") }}</p>
                                        </div>
                                        <div class="col-md-6 border_1px p-2">
                                            <textarea name="<?php echo base64_encode('CH-13-PLAN-Class 6 creditor name a'); ?>" class="form-control" rows="2" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                                        </div>
                                        <div class="col-md-6 border_1px p-2">
                                            <textarea name="<?php echo base64_encode('CH-13-PLAN-Class 6 collateral descrip a'); ?>" class="form-control" rows="2" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                                        </div>
                                        <div class="col-md-6 border_1px p-2">
                                            <textarea name="<?php echo base64_encode('CH-13-PLAN-Class 6 creditor name b'); ?>" class="form-control" rows="2" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                                        </div>
                                        <div class="col-md-6 border_1px p-2">
                                            <textarea name="<?php echo base64_encode('CH-13-PLAN-Class 6 collateral descrip b'); ?>" class="form-control" rows="2" cols="" style="padding-right:5px;"><?php echo ''; ?></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class6 claims'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p class="mb-0">{{ __("See attachment for additional claims in Class 6.") }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="w-100 mt-3">
                        <tr class="bg_black text_white">
                            <td colspan="7" class="p-2 text-center">{{ __("CLASS 7") }}</td>
                        </tr>
                        <tr>
                            <td colspan="7" class="p-2">
                                <h3 class="text-center">{{ __("EXECUTORY CONTRACTS AND UNEXPIRED LEASES") }}</h3>
                                <p class="mb-0">{{ __("Any executory contracts or unexpired leases not listed below are deemed rejected.") }}</p>
                                <p class="text_italic">{{ __("Check one.") }}</p>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 7'); ?>" value="Entire Hearing" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p><span class="text-bold">None.</span><span class="text_italic"> If “None” is checked, the rest of this form for Class 7 need not be completed.</span></p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-Class 7'); ?>" value="2" type="checkbox" class="height_fit_content">
                                    <div class="row pr-3">
                                        <div class="col-md-12">
                                            <p class="p_justify">{{ __("The executory contracts and unexpired leases listed below are treated as specified") }} <span class="text_italic">{{ __("(identify the contract or 
                                                lease at issue and the other party(ies) to the contract or lease):") }}</span></p>
                                        </div>
                                        <div class="col-md-2 mt-1">
                                            <p class="text-bold mb-0">{{ __("Creditor Name:") }}</p>
                                        </div>
                                        <div class="col-md-10 mt-1">
                                            <input name="<?php echo base64_encode('CH-13-PLAN-Class 7 creditor name a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-2 mt-1">
                                            <p class="text-bold mb-0">{{ __("Description:") }}</p>
                                        </div>
                                        <div class="col-md-10 mt-1">
                                            <input name="<?php echo base64_encode('CH-13-PLAN-Class 7 description a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-2 mt-1"></div>
                                        <div class="col-md-4 mt-1 d-flex">
                                            <input name="<?php echo base64_encode('CheckboxClass7'); ?>" value="Choice1" type="checkbox" class="height_fit_content mt-2">
                                            <div>
                                                <p class="text-bold mb-0 pt-2">{{ __("Rejected") }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-1 d-flex">
                                            <input name="<?php echo base64_encode('CheckboxClass7'); ?>" value="Choice2" type="checkbox" class="height_fit_content mt-2">
                                            <div>
                                                <p class="text-bold mb-0">{{ __("Assumed; cure amount (if any)") }}: $&nbsp;<input name="<?php echo base64_encode('CH-13-PLAN-7a amount'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_24percent">,
                                                    to be paid over &nbsp;<input name="<?php echo base64_encode('class 7 months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_10percent"> {{ __("months") }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            <p class="text-bold mb-0">{{ __("Creditor Name:") }}</p>
                                        </div>
                                        <div class="col-md-10 mt-2">
                                            <input name="<?php echo base64_encode('CH-13-PLAN-Class 7 creditor name b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-2 mt-1">
                                            <p class="text-bold mb-0">{{ __("Description:") }}</p>
                                        </div>
                                        <div class="col-md-10 mt-1">
                                            <input name="<?php echo base64_encode('CH-13-PLAN-Class 7 description b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                                        </div>
                                        <div class="col-md-2 mt-1"></div>
                                        <div class="col-md-4 mt-1 d-flex">
                                            <input name="<?php echo base64_encode('CheckboxClass7a'); ?>" value="Choice1" type="checkbox" class="height_fit_content mt-2">
                                            <div>
                                                <p class="text-bold mb-0 pt-2">{{ __("Rejected") }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-1 d-flex">
                                            <input name="<?php echo base64_encode('CheckboxClass7a'); ?>" value="Choice2" type="checkbox" class="height_fit_content mt-2">
                                            <div>
                                                <p class="text-bold mb-0">{{ __("Assumed; cure amount (if any)") }}: $&nbsp;<input name="<?php echo base64_encode('CH-13-PLAN-7bamount'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_24percent">,
                                                    to be paid over &nbsp;<input name="<?php echo base64_encode('class 7 monthsb'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_10percent"> {{ __("months") }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <p class="text-bold mb-0">{{ __("Payments to be cured within") }}&nbsp;<input name="<?php echo base64_encode('CH-13-PLAN-Class 7 # of months'); ?>" type="text" value="<?php echo ''; ?>" class="form-control width_5percent">
                                                {{ __("months of filing of the bankruptcy petition. All cure payments will be 
                                                made through disbursements by the Chapter 13 Trustee.") }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex mt-2">
                                    <input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl Class7 claims'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                                    <div>
                                        <p class="mb-0">{{ __("See attachment for additional claims in Class 7.") }}</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <h3>{{ __("Section III. PLAN SUMMARY") }}</h3>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8 table_sect">
            <table class="w-100 mt-3 text-bold">
                <tr class="bg_black text_white">
                    <td colspan="2" class="p-2"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 1a") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 1a'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 1b") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 1b'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 1c") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 1c'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 2") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 3B") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 3B'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 3C") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 3C'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 3D") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 3D'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 4") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 4'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 5A") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 5A'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 5C") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 5B'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("CLASS 7") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Class 7'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">{{ __("SUB-TOTAL") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III Subtotal'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2">CHAPTER 13 TRUSTEE'S FEE <br> {{ __("(Estimated 11% unless advised otherwise)") }}</td>
                    <td><input name="<?php echo base64_encode("CH-13-PLAN-Chapter 13 Trustee's Fee"); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
                <tr class="bg-dgray">
                    <td class="p-2">{{ __("TOTAL PAYMENT") }}</td>
                    <td><input name="<?php echo base64_encode('CH-13-PLAN-III TOTAL PAYMENT'); ?>" type="text" value="<?php echo ''; ?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-12 mt-3">
            <h3>{{ __("Section IV. NON-STANDARD PLAN PROVISIONS") }}</h3>
            <div class="pl-4">
                <div class="d-flex mt-2">
                    <input name="<?php echo base64_encode('CH-13-PLAN-IV none'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                    <div>
                        <p><span class="text-bold">None.</span><span class="text_italic"> {{ __("If “None” is checked, the rest of Section IV need not be completed.") }}</span></p>
                    </div>
                </div>
                <p><span class="text-bold">{{ __("Pursuant to FRBP 3015(c), Debtor must set forth all nonstandard Plan provisions in this Plan in this 
                    separate Section IV of this Plan and must check off the “Included” box or boxes in Paragraphs 1.1, 1.2, 1.3 
                    and/or 1.4 of Part 1 of this Plan. Any nonstandard Plan provision that does not comply with these 
                    requirements is") }} <span class="underline">{{ __("ineffective.") }}</span> </span>{{ __("A nonstandard Plan provision means any Plan provision not otherwise included in 
                    this mandatory Chapter 13 Plan form, or any Plan provision deviating from this form") }}</p>
                <p class="text-bold">{{ __("The nonstandard Plan provisions seeking modification of liens and security interests address only those 
                    liens and security interests known to Debtor, and known to be subject to avoidance, and all rights are 
                    reserved as to any matters not currently known to Debtor.") }} </p>
                <div class="d-flex">
                    <input name="<?php echo base64_encode('CH-13-PLAN-IV none-A'); ?>" value="1" type="checkbox" class="height_fit_content"> A.
                    <div class="pl-3">
                        <p><span class="underline"> {{ __("Debtor’s Intent to File Separate Motion to Value Property Subject to Creditor’s Lien or Avoid Creditor’s Lien 
                            [11 U.S.C. § 506(a) and (d)].") }}</span> {{ __("Debtor will file motion(s) to value real or personal property of the bankruptcy 
                            estate and/or to avoid a lien pursuant to 11 U.S.C § 506(a) and (d), as specified in") }} <span class="text-bold">{{ __("Attachment A.") }}</span> </p>
                    </div>
                </div>
                <div class="d-flex">
                    <input name="<?php echo base64_encode('CH-13-PLAN-IV none-A'); ?>" value="2" type="checkbox" class="height_fit_content"> B.
                    <div class="pl-3">
                        <p><span class="underline"> {{ __("Debtor’s Intent to File Separate Motion to Avoid Creditor’s Judicial Lien or Nonpossessory, Nonpurchase 
                            Security Interest [11 U.S.C. § 522(f)].") }}</span> {{ __("Debtor will file a Motion to avoid a judicial lien or nonpossessory, 
                            nonpurchase-money security interest, on real or personal property of the bankruptcy estate listed below 
                            pursuant to 11 U.S.C § 522(f). If the court enters an order avoiding a lien under 11 U.S.C. § 522(f), the 
                            Chapter 13 Trustee will not pay any claim filed based on that lien as a secured claim.") }} </p>
                    </div>
                </div>
                <div class="pl-4 row">
                    <div class="col-md-3">
                        <p class="text-bold mb-0 pt-2"> {{ __("Name of Creditor Lienholder/Servicer:") }} </p>
                    </div>
                    <div class="col-md-9">
                        <input name="<?php echo base64_encode('CH-13-PLAN-IV A Name of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                    </div>
                    <div class="col-md-4 mt-1">
                        <p class="text-bold mb-0 pt-2"> {{ __("Description of lien and collateral (e.g., 2nd lien on 123 Main St.):") }} </p>
                    </div>
                    <div class="col-md-8 mt-1">
                        <input name="<?php echo base64_encode('CH-13-PLAN-IV A Name of Collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                    </div>
                    <div class="col-md-12 mt-1">
                        <input name="<?php echo base64_encode('CH-13-PLAN-IV A2 Name of Collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                    </div>
                    
                    <div class="col-md-3 mt-3">
                        <p class="text-bold mb-0 pt-2"> {{ __("Name of Creditor Lienholder/Servicer:") }} </p>
                    </div>
                    <div class="col-md-9 mt-3">
                        <input name="<?php echo base64_encode('CH-13-PLAN-IV B Name of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                    </div>
                    <div class="col-md-4 mt-1">
                        <p class="text-bold mb-0 pt-2"> {{ __("Description of lien and collateral (e.g., 2nd lien on 123 Main St.):") }} </p>
                    </div>
                    <div class="col-md-8 mt-1">
                        <input name="<?php echo base64_encode('CH-13-PLAN-IV B Name of Collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                    </div>
                    <div class="col-md-12 mt-1">
                        <input name="<?php echo base64_encode('CH-13-PLAN-IV B2 Name of Collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                    </div>
                    <div class="col-md-12 mt-1">
                        <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl liens'); ?>" value="Yes" type="checkbox">{{ __("See attachment for any additional liens and security interests to be avoided by separate 11 U.S.C. § 522(f) 
                            motion.") }}</p> 
                    </div>
                </div>
                <div class="d-flex">
                    <input name="<?php echo base64_encode('CH-13-PLAN-sECTION v c'); ?>" value="Yes" type="checkbox" class="height_fit_content"> C.
                    <div class="pl-3">
                        <p><span class="underline">{{ __("Debtor’s Request in this Plan to Modify Creditor’s Secured Claim and Lien.") }}</span> {{ __("Debtor proposes to modify the 
                            following secured claims and liens in this Plan") }} <span class="underline">{{ __("without") }}</span> {{ __("a separate motion or adversary proceeding - this
                            Plan will serve as the motion to value the collateral and/or avoid the liens as proposed below.") }} <span class="text-bold">{{ __("To use this 
                            option, Debtor must serve this Plan, LBR Form F 3015-1.02.NOTICE.341.LIEN.CONFRM and all 
                            related exhibits as instructed in that form. Note: Not all Judges will grant motions to value and/or 
                            avoid liens through this Plan. Please consult the specific Judge’s Instructions/Procedures on the 
                            court’s website for more information.") }}</span> </p>
                    </div>
                </div>
                <div class="border_1px">
                    <div class="pl-4 pr-3 pb-2 row">
                        <div class="col-md-12 mt-2 text-center">
                            <h3 class="underline">{{ __("DEBTOR’S REQUEST TO MODIFY CREDITOR’S SECURED CLAIM AND LIEN") }}</h3>
                        </div>
                        <div class="col-md-3 mt-2">
                            <p class="text-bold mb-0 pt-2"> {{ __("TO CREDITOR LIENHOLDER/SERVICER") }} </p>
                        </div>
                        <div class="col-md-9 mt-2">
                            <input name="<?php echo base64_encode('CH-13-PLAN-lienholder/servicer'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                        </div>
                        <div class="col-md-12 mt-1">
                            <input name="<?php echo base64_encode('CH-13-PLAN-lienholder/servicerline2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                        </div>
                        <div class="col-md-12 d-flex mt-2">
                            <input name="<?php echo base64_encode('CH-13-PLAN-RE collateral'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                            <div class="w-100">
                                <p class="mb-0">{{ __("Real property collateral (street address and/or legal description or document recording number, 
                                    including county of recording):") }}</p>
                                <input name="<?php echo base64_encode('CH-13-PLAN-real estate collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                                <p class="text_italic"> {{ __("(attach page with legal description of property or document recording number as appropriate).") }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex ">
                            <input name="<?php echo base64_encode('CH-13-PLAN-Other collateral'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                            <div class="w-100">
                                <p class="mb-0">{{ __("Other collateral") }} <span class="text_italic">{{ __("(add description such as judgment date, date and place of lien recording, book 
                                    and page number):") }}</span></p>
                                <input name="<?php echo base64_encode('CH-13-PLAN-other collateral'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
                                <p class="text_italic pb-0"> {{ __("(attach page with legal description of property or document recording number as appropriate).") }}</span></p>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex ">
                            <input name="<?php echo base64_encode('CH-13-PLAN-522'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                            <div class="w-100">
                                <p class="mb-0">{{ __("11 U.S.C. § 522(f) – Debtor seeks avoidance of your lien(s) on the above described collateral 
                                    effective immediately upon issuance of the order confirming this Plan.") }}</p>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex mt-2">
                            <input name="<?php echo base64_encode('CH-13-PLAN-506'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                            <div class="w-100">
                                <p>{{ __("11 U.S.C. § 506(a) and (d) – Debtor seeks avoidance of your lien(s) on the above described collateral 
                                    that will be effective upon the earliest to occur of either payment of the underlying debt determined 
                                    under nonbankruptcy law or one of the following:") }}</p>
                                <p class="mb-0">(<span class="text_italic">{{ __("check all that apply") }}</span> {{ __("and see LBR Form F 4003-2.4.ORDER.AFTERDISCH):") }}</p>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex mt-2">
                            <input name="<?php echo base64_encode('CH-13-PLAN-1328'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                            <div class="w-100">
                                <p>(1) &nbsp;{{ __("discharge under 11 U.S.C. § 1328, or") }} </p>
                            </div>
                        </div>
                        <div class="col-md-12 d-flex">
                            <input name="<?php echo base64_encode('CH-13-PLAN-value is zero'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                            <div class="w-100">
                                <p>{{ __("(2) Upon completion of all Plan payments.") }} </p>
                            </div>
                        </div>
                        <div class="col-md-10 input-group horizontal_dotted_line">
                            <p class="pt-2">{{ __("Value of collateral:") }}</p>
                        </div>
                        <div class="col-md-2 d-flex">
                            <label class="pt-2" for="">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-IV C collateral value'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-12">
                            <p class="pt-2 mb-0">{{ __("Liens reducing equity (to which subject lien can attach):") }}</p>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-2 d-flex">
                            <span class="pt-2">$&nbsp;</span><input name="<?php echo base64_encode('CH-13-PLAN-IV C liens reduce equity a'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-2 d-flex">
                            <span class="pt-2">+&nbsp;$&nbsp;</span><input name="<?php echo base64_encode('CH-13-PLAN-IV C liens reduce b'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-2 d-flex">
                            <span class="pt-2">+&nbsp;$&nbsp;</span><input name="<?php echo base64_encode('CH-13-PLAN-IV C liens reduce equity c'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-2 d-flex">
                            <span class="pt-2">=&nbsp;$&nbsp;</span><input name="<?php echo base64_encode('CH-13-PLAN-IV C liens reduce equity Total'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-10 input-group horizontal_dotted_line mt-2">
                            <p class="pt-2">{{ __("Exemption (only applicable for lien avoidance under 11 U.S.C. § 522(f)):") }}</p>
                        </div>
                        <div class="col-md-2 d-flex mt-2">
                            <label class="pt-2" for="">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-IV C exemption'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-12">
                            <p class="pt-2 mb-0 text-bold p_justify">{{ __("Wherefore, Debtor requests that this court issue an order granting the foregoing property valuation 
                                and/or lien avoidance of the above-listed creditor on the above-described collateral in the form") }} 
                                <span class="underline">{{ __("Attachment B, C and/or D") }}</span> to this Plan, as applicable. <span class="text_italic">{{ __("(Debtor must use and attach a separate 
                                Attachment B, C and/or D which are also mandatory court forms for modification of each secured 
                                claim and lien.)") }}</span></p>
                        </div>
                        <div class="col-md-10 input-group horizontal_dotted_line mt-2">
                            <p class="pt-2">{{ __("Amount of remaining secured claim (negative results should be listed as $-0-):") }}</p>
                        </div>
                        <div class="col-md-2 d-flex mt-2">
                            <label class="pt-2" for="">$&nbsp;</label>
                            <input name="<?php echo base64_encode('CH-13-PLAN-IV C remaining secured claim'); ?>" type="text" value="<?php echo ''; ?>" class="price-field form-control">
                        </div>
                        <div class="col-md-12">
                            <p class="pt-2 mb-0"><span class="text_italic"> {{ __("Note:") }}</span> {{ __("See other parts of this Plan for the proposed treatment of any remaining secured claim (generally Class 3)") }}</p>
                        </div>
                    </div>
                </div>
                <p class="mt-2"><input name="<?php echo base64_encode('CH-13-PLAN-attachment addtl request to mod secured'); ?>" value="Yes" type="checkbox"> {{ __("See attachment(s) for additional request(s) to modify secured claims and liens by this Plan.") }}</p> 
                <div class="d-flex">
                    <input name="<?php echo base64_encode('CH-13-PLAN-sECTION v D'); ?>" value="Yes" type="checkbox" class="height_fit_content"> D.
                    <div class="pl-3 w-100">
                        <p class="text-bold">Other Non-Standard Plan Provisions<span class="text_italic"> {{ __("(use attachment, if necessary):") }}</span></p>
                        <textarea name="<?php echo base64_encode('CH-13-PLAN-IV D other non-standard plan provisions'); ?>" class="form-control" rows="10" cols=""><?php echo ''; ?></textarea>
                    </div>
                </div>
            </div>  
        </div>
        <div class="col-md-12 mt-3">
            <h3>{{ __("V. REVESTING OF PROPERTY") }}</h3>
            <div class="pl-3">
                <div class=" mt-2 pl-3">
                    <p class="p_justify">{{ __("Property of the bankruptcy estate will not revest in Debtor until a discharge is granted or the case is dismissed or 
                        closed without discharge. Revesting will be subject to all liens and encumbrances in existence when the case was 
                        filed, except those liens avoided by court order or extinguished by operation of law. In the event the case is 
                        converted to a case under Chapter 7, 11, or 12 of the Bankruptcy Code, the property of the estate will vest in 
                        accordance with applicable law. After confirmation of this Plan, the Chapter 13 Trustee will not have any further 
                        authority or fiduciary duty regarding use, sale, or refinance of property of the estate except to respond to any motion 
                        for proposed use, sale, or refinance as required by the LBRs. Prior to any discharge or dismissal, Debtor must 
                        seek approval of the court to purchase, sell, or refinance real property.") }}</p>
                </div>
            </div>
            <p class="text-bold p_justify">{{ __("By filing this document, the Attorney for Debtor, or Debtor if not represented by an attorney, also certify(ies) that 
                the wording and order of the provisions in this Plan are identical to those contained in the Central District of 
                California Chapter 13 Plan other than any nonstandard Plan provisions included in Section IV.") }}</p>
        </div>
        <div class="col-md-4 mt-3 d-flex">
            <label class="pt-2">{{ __("Date:") }}</label>
            <div class="pl-3">
                <input name="<?php echo base64_encode('CH-13-PLAN-V date'); ?>" value="{{$currentDate}}" placeholder="{{ __("MM/DD/YYYY") }}" type="text" class="date_filed form-control">
            </div>
        </div>
        <div class="col-md-8 mt-3">
            <input name="<?php echo base64_encode('CH-13-PLAN-Signature attorney for debtor'); ?>" value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
            <label for="">{{ __("Attorney for Debtor") }}</label>
        </div>
        <div class="col-md-4 mt-3"></div>
        <div class="col-md-8 mt-3">
            <input name="<?php echo base64_encode('CH-13-PLAN-Signature debtor'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label for="">{{ __("Debtor 1") }}</label>
        </div>
        <div class="col-md-4 mt-3"></div>
        <div class="col-md-8 mt-3">
            <input name="<?php echo base64_encode('Signature attorney for joint debtor'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label for="">{{ __("Debtor 2") }}</label>
        </div>
        <div class="col-md-12 mt-3">
            <h3 class="text-center">{{ __("ATTACHMENT A to Chapter 13 Plan/Confirmation Order") }} <br>
                {{ __("(11 U.S.C. §§ 506: valuation/lien avoidance by separate motion(s))") }}</h3>
            <div class="d-flex mt-3">
                <input name="<?php echo base64_encode('CH-13-PLAN-attachmentA to Ch13Plan'); ?>" value="Yes" type="checkbox" class="height_fit_content">
                <div>
                    <p><span class="text-bold">{{ __("None.") }} </span><span class="text_italic">{{ __("If “None” is checked, the rest of this Attachment A need not be completed.") }}</span></p>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("1. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA1Name of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 2") }}<sup>nd</sup> {{ __("Lien on 123 Main St.):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA1Subject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA1Subject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("2. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA2Name of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">Subject Lien</span> {{ __("(e.g., 3") }}<sup>rd</sup> {{ __("Lien on 123 Main St.):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA2ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA2ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("3. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA3ame of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 4") }}<sup>th</sup> {{ __("Lien on 123 Main St.):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA3ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA3ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("4. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA4ame of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 2") }}<sup>nd</sup> {{ __("Lien on 456 Broadway):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA4ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA4ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("5. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA5me of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 3") }}<sup>rd</sup> {{ __("Lien on 456 Broadway):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA5ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA5ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("6. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA1\6me of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 4") }}<sup>th</sup> {{ __("Lien on 456 Broadway):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA6ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA+6bject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("7. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA7ame of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 2") }}<sup>nd</sup> {{ __("Lien on 789 Crest Ave.):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA7Subject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA7ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("8. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA8ame of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 3") }}<sup>rd</sup> {{ __("Lien on 789 Crest Ave.):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA8ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA8ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-2 mt-2">
            <p class="text-bold mb-0 pt-2">{{ __("9. Creditor Lienholder/Servicer:") }}</p>
        </div>
        <div class="col-md-10 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA9ame of Creditor'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-3 mt-1">
            <p class="mb-0 pt-2"><span class="text-bold">{{ __("Subject Lien") }}</span> {{ __("(e.g., 4") }}<sup>th</sup> {{ __("Lien on 789 Crest Ave.):") }} </p>
        </div>
        <div class="col-md-8 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA9ubject'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-1 mt-1"></div>
        <div class="col-md-11 mt-1">
            <input name="<?php echo base64_encode('CH-13-PLAN-AttachmentA9ubject2'); ?>" type="text" value="<?php echo ''; ?>" class="form-control">
        </div>
        <div class="col-md-12 mt-2">
            <p class=""><span class="text_italic">{{ __("(Attach additional pages for more liens/provisions.)") }}</span></p>
        </div>
        <div class="col-md-12 mt-2">
            <p class="mb-0"><span class="text-bold">{{ __("CERTIFICATION:") }}</span> {{ __("I have prepared this attachment (including any additional pages) for use by the Chapter 13 Trustee. 
                I certify under penalty of perjury under the laws of the United States of America that the information provided in this 
                attachment is accurate to the best of my knowledge after reasonable inquiry, and I acknowledge that the Chapter 13 
                Trustee has no duty to verify the accuracy of that information.") }} </p>
        </div>
        <div class="col-md-2 mt-2">
            <p class="mb-0 pt-1">{{ __("Executed on") }} <span class="text_italic">{{ __("(date)") }}</span></p>
        </div>
        <div class="col-md-2 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-Executed on (Date)'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" value="{{$currentDate}}" type="text" class="date_filed form-control">
        </div>
        <div class="col-md-8 mt-2"></div>
        <div class="col-md-2 mt-2">
            <p class="mb-0 pt-1 text_italic">{{ __("Printed Name") }}</p>
        </div>
        <div class="col-md-3 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-Pritned Name'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="form-control">
        </div>
        <div class="col-md-1 mt-2"></div>
        <div class="col-md-1 mt-2">
            <p class="mb-0 pt-1 text_italic">{{ __("Signature") }}</p>
        </div>
        <div class="col-md-4 mt-2">
            <input name="<?php echo base64_encode('CH-13-PLAN-Sig'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
        </div>
        <div class="col-md-12 mt-2">
            <div class="d-flex ">
                <input name="<?php echo base64_encode('CH-13-PLAN-Group'); ?>" value="5" type="checkbox" class="height_fit_content">
                <div class="pr-3">
                    <p>{{ __("Attorney for Debtor or") }}</p>
                </div>
                <input name="<?php echo base64_encode('CH-13-PLAN-Group'); ?>" value="Entire Hearing" type="checkbox" class="height_fit_content">
                <div>
                    <p>{{ __("Debtor appearing without attorney") }}</p>
                </div>
            </div>
        </div>


    </div>
</div>
