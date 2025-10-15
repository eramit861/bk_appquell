<section class="rts">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row border_bottom_1px" style="">
                    <div class="col-md-6 pt-3 pb-2 border_bottom_1px border_right_1px">
                        <div class="input-group">
                           <label>{{ __("Revised:(01/01/2023)") }}</label><br>
                           <label>{{ __("Name, Address, Telephone No. & I.D. No.") }}</label>
                           <textarea name="<?php echo base64_encode('Text1'); ?>"  class="form-control" rows="5" cols="" style="padding-right:5px;">{{$attorneydetails}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                    </div>
                    <div class="col-md-6 pt-3" style="border:1px solid #000; border-bottom:none; border-top:none; border-left:none">
                        <div class="box-text text-center mb-2">
                            <h3>{{ __("UNITED STATES BANKRUPTCY COURT") }}</h3>
                            <span>{{ __("SOUTHERN DISTRICT OF CALIFORNIA") }} </span><br>
                            <span>{{ __("325 West F Street, San Diego, California 92101-6991") }}</span>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3">
                    </div>
                </div>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row border_bottom_1px">
                    <div class="col-md-6 pt-3" style="border-right:1px solid #000;">
                        <div class="input-group">
                            <label>{{ __("In re:") }}</label>
                            <textarea name="<?php echo base64_encode('Text2'); ?>" class="form-control" rows="5" cols="" style="padding-right:5px;">{{$debtorname}}</textarea>
                        </div>
                        <span class="float-left">{{ __("Debtor.") }}</span>
                        <div class="d-flex mt-3 mb-3 pt-3">
                            <label class="">{{ __("Last four digits of Soc. Sec. or") }} {{ __("Individual-Taxpayer I.D.(ITIN)/Complete EIN :") }}</label>
                            <div class="w-100 pl-3">
                                <input name="<?php echo base64_encode('Text3'); ?>" type="text" value="{{Helper::lastchar($ssn1)}}" class=" form-control ">
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-6 pt-3">
                        <div class="d-flex radio-primary"> 
                            <label class="mt-2">{{ __("BANKRUPTCY") }}&nbsp;{{ __("NO.") }}</label>	
                            <div class=" pl-3">
                                <input name="<?php echo base64_encode('Text4'); ?>"  type="text" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" class=" form-control ">	 											    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
       <div class="text-center mt-3 mb-3">
            <h3>{{ __("UNITED STATES BANKRUPTCY COURT") }} </h3>
            <h3> {{ __("SOUTHERN DISTRICT OF CALIFORNIA") }} </h3>
            <h3>{{ __("RIGHTS AND RESPONSIBILITIES OF CHAPTER 13 DEBTORS") }}</h3> 
            <h3>{{ __("AND THEIR ATTORNEY") }} </h3>
            <h3>{{ __("(Consumer Case)") }}<h3>
        </div>
        <p class="p_justify">{{ __("It is important for debtors in Chapter 13 bankruptcy to understand their rights and responsibilities.
            It is also important that they know what their attorney's responsibilities are and appreciate the
            importance of communicating with their attorney to make the case successful. Debtors can expect
            their attorney to provide certain services for them. And they should know the costs of attorneys'
            fees through the life of a plan. To assure that debtors and their attorney understand their
            rights and responsibilities in the bankruptcy process, the Bankruptcy Court has made the 
            following rights and responsibilities binding on them under Local Bankruptcy Rule 1002-1(c)
            and General Order 180¬A. (Nothing in this agreement should be construed to excuse an attorney
            from any ethical duties or responsibilities under any other applicable law.)") }}</p>
        <p class="p_justify">{{ __("Debtors' attorneys can be paid in one of two ways: through guideline fees; or by formal fee application.
            The choice, agreed upon by the debtors and their attorney, must be made at the start of the representation.
            Once an attorney accepts any type of guideline fee in any amount, guideline fees will apply for the 
            duration of the case.
            In this case, the attorney [check one]:") }}
        </p>
        <div class="form-check d-flex pl-3">
            <input name="<?php echo base64_encode('Check Box1');?>" value="Yes" class="form-check-input height_fit_content" type="checkbox">
            <label class="form-check-label">
             {{ __("will be paid guideline fees 
            (subject to increase through a fee application only in atypical cases as discussed below).") }}
            </label>
        </div>
        <div class="form-check d-flex pl-3">
            <input name="<?php echo base64_encode('Check Box2');?>" value="Yes" class="form-check-input" type="checkbox">
            <label class="form-check-label">
            {{ __("waives guideline fees and will instead prepare fee applications for all work done.") }}
           </label>
        </div> 
        <div class="order-form">
            <h3 class="mb-2 mt-3">{{ __("UNLESS THE COURT ORDERS OTHERWISE, in every case — regardless of fee regime —the following rights and
            responsibilities apply:") }}</h3>
                <p class="text_italic text-bold">{{ __("The debtor must:") }}</p>
                <div class="">
                    <ol class="inner_text">
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide accurate financial information") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide information in a timely manner") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Cooperate and communicate with the attorney.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Discuss with the attorney the debtor's objectives in filing the case.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Keep the trustee and attorney informed of the debtor's address and telephone number.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Inform the attorney of any wage garnishments or attachments of assets which occur or
                          continue after the filing of the case.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Contact the attorney promptly if the debtor loses his/her job or has other financial problems.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Let the attorney know immediately if the debtor is sued before or during the case.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Inform the attorney if any tax refunds the debtor is entitled to are seized or 
                         not returned to the debtor by the IRS or Franchise Tax Board.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Contact the attorney before buying, refinancing, or selling 
                         real property or before entering into any long-term loan agreements to find out what approvals are required.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Pay any filing fees and filing expenses that may be incurred directly to the attorney.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Pay appropriate attorney's fees commensurate with this agreement and the United States Bankruptcy Court Guidelines regarding Chapter 13 Attorney Fees. Any future increase or other change in \"additional fees\" under the guidelines will also automatically apply to this case until it is finally closed. 
                         If a court order is entered regarding attorney's fees, fees should be paid in accordance with the court's order.") }}</li>
                    </ol>
                </div>
                <div class="mt-2 mb-2">
                <p class="text_italic text-bold p_justify">{{ __("To receive $4,600 in 'initial fees' under the guidelines,
                     and in the case of all fee applications, the attorney must:") }}</p>
                </div>
                <div class="">
                    <ol class="inner_text">
                        <li class="pl-3 pb-1 p_justify">{{ __("Meet with the debtor to review the debtor's assets, liabilities, income and expenses.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Analyze the debtor's financial situation and render advice to the debtor in determining whether 
                            to file a petition in bankruptcy") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Counsel the debtor regarding the advisability of filing either a Chapter 7 or Chapter 13 case,
                             discuss both procedures with the debtor, and answer the debtor's questions.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Explain to the debtor how the attorney's fees and trustee's fees are paid.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Explain what payments will be made directly by the debtor and when to make those payments, and what payments will be made through the debtor's Chapter 13 plan 
                            (with particular attention to mortgage and vehicle loan payments, as well as any other claims with accrued interest).") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Explain to the debtor how, when, and where to make the Chapter 13 plan payments.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Explain to the debtor that the first plan payment must be made to the Trustee within 30 days of the date the plan is filed.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Advise the debtor of the requirement to attend the § 341(a) Meeting of Creditors, and instruct the debtor as to the date, time and place of the meeting.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Advise the debtor of the necessity of maintaining liability, collision and comprehensive insurance on vehicles securing loans or leases.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Timely prepare, file and serve the debtor's petition, plan, schedules, statement of financial affairs, and any necessary amendments thereto, which may be required.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide an executed copy of the Rights and Responsibilities of Chapter 13 Debtors and their Attorneys and a copy of the Court's Guidelines regarding Chapter 13 Attorney Fees to the debtor.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Appear and represent the debtor at the § 341(a) Meeting of Creditors and any confirmation hearings.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Respond to the objections to plan confirmation, and where necessary, prepare, file and serve an amended plan.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide Certification of Eligibility for Discharge pursuant to Local Bankruptcy Rule 4004-1.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide such other legal services as are necessary for the administration of the case before the
                             Bankruptcy Court, which include, but are not limited to, a continuing obligation to assist the debtor by returning telephone calls,
                             answering questions and reviewing and sending correspondence.") }}</li>
                    </ol>
                </div>
                <div class="mt-2 mb-2">
                <p class="text_italic text-bold p_justify">{{ __("Additional services may be required but are not included in the guideline 'initial fees' of $4,600.
                     If necessary and when appropriate, the attorney, at the debtor's request and only with the debtor's 
                    cooperation, must provide the following services for \"additional fees\" described below :") }}</p>
                </div>
                <div class="">
                    <ol class="inner_text">
                        <li class="pl-3 pb-1 p_justify">{{ __("Prepare, file and serve necessary modifications to the plan post-confirmation, which may include suspending,
                            lowering or increasing plan payments.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Prepare, file and serve necessary motions to buy, sell or refinance real property and authorize use of
                            cash collateral or assume executory contracts or unexpired leases") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Object to improper or invalid claims.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Represent the debtor in motions for relief from stay.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Prepare, file and serve necessary motions to avoid liens on real or personal property.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Prepare, file and serve necessary oppositions to motions for dismissal of case.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide such other legal services as are necessary for the administration of the case before the Bankruptcy Court, which include but are not limited to,
                            presenting appropriate legal pleadings and making appropriate court appearances.") }}</li>
                    </ol>
                </div>
                <div class="mt-2 mb-2">
                <p class="text_italic text-bold p_justify">{{ __("Should additional services be provided and \"additional fees\" requested, the attorney must :") }}</p>
                </div>
                <div class="">
                    <ol class="inner_text">
                        <li class="pl-3 pb-1 p_justify">{{ __("Provide proper notice in accordance with Federal Rule of Bankruptcy Procedure 2002.") }}</li>
                        <li class="pl-3 pb-1 p_justify">{{ __("Advise the debtor of all \"additional fees\" requested and file a declaration with the 
                            court stating that counsel has so advised the debtor of the fees requested and the debtor has no objection to the requested fees.") }}</li>
                    </ol>
                </div>
                <p>{{ __("The \"Guidelines Regarding Chapter 13 Attorney Fees\" provide for \"additional fees\" within the United States Bankruptcy Court's parameters
                   for \"additional fees\" in the following amounts and include all court appearances required to pursue described actions.") }}</p>
                <div class="modify_plan pl-3 ml-3 row">
                    <div class="mb-2 col-md-8">
                        <h3 class="underline">Modified Plan (Post-Confirmation)<h3>
                    </div>
                    <div class=" mb-2 col-md-4">
                        <h3 class="">{{ __("$780") }}<h3>
                    </div>
                    <div class="col-md-12">
                        <p class="p_justify">{{ __("for fees and expenses for services rendered post-confirmation for opposing, preparing, filing, noticing,
                        and attending hearings on any motion to modify debtor's plan under section 1329 of the Bankruptcy Code
                        (including the preparation of amended income and expenses statements and providing proof of income).
                        (These fees should be less for modification due to clerical error or other administrative issues.)") }}</p>
                    </div>
                    <div class="mb-2 col-md-12">
                        <h3 class="underline">{{ __("Opposition to Motions for Relief from Stay") }}<h3>
                    </div>
                    <div class="col-md-2">
                        <span class="text-bold">{{ __("$580") }}</span>
                        <p class="text-bold">{{ __("$790") }}</p>
                    </div>
                    <div class="col-md-3">
                        <span class="text-bold">{{ __("(Personal property)") }}</span>
                        <p class="text-bold">{{ __("(Real property)") }}</p>
                    </div>
                    <div class="col-md-7">
                        <p>{{ __("for fees and expenses of all services rendered in opposition to motions to modify or vacate automatic stay.") }}</p>
                    </div>
                    <div class="col-md-12">
                        <h3 class="underline">{{ __("Obtaining Orders re : Sale or Refinance of Real Property") }}<h3>
                    </div>
                    <div class="col-md-2">
                        <span class="text-bold">{{ __("$655") }}</span>
                    </div>
                    <div class="col-md-3">
                        <span class="text-bold">{{ __("(By stipulation or noticed hearing)") }}</span>
                    </div>
                    <div class="col-md-7">
                        <p>{{ __("for fees and expenses of all services rendered for order authorizing the sale or refinancing of real
                        estate but not including loan modifications.") }}
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h3 class="underline">{{ __("Objections to Claim") }} <h3>
                    </div>
                    <div class="col-md-2">
                        <span class="text-bold">{{ __("$305") }}</span>
                        <p class="text-bold">{{ __("$460") }}</p>
                    </div>
                    <div class="col-md-3">
                    <span class="text-bold">{{ __("(Uncontested objections without hearing)") }}</span>
                        <p class="text-bold">{{ __("(Contented objections with a hearing)") }}</p>
                    </div>
                    <div class="col-md-7">
                        <p>{{ __("for fees and expenses of all services rendered in opposition to motions to modify or vacate automatic stay.") }}</p>
                    </div>
                    <div class="col-md-8">
                    <h3 class="underline">{{ __("Oppositions to Dismissal/Motions to Avoid Lien/ Loan Modifications/Other Routine Pleadings") }}<h3>
                    </div>
                    <div class="col-md-4">
                            <span class="text-bold">{{ __("$595") }}</span>
                    </div>
                    <div class="col-md-12">
                        <p class="mt-2">{{ __("for fees and expenses of all services rendered for preparing, filing, noticing, and attending hearings in opposition to a motion to dismiss the case,
                            for motions to avoid lien or to approve a loan modification, and for other routine pleadings.") }}</p>
                    </div>
                    <div class="col-md-8">
                        <h3 class="underline">{{ __("Motions to Value Real Property, Treat Claim as Unsecured and Avoid Junior Lien (Lien Strips)") }}<h3>
                    </div>
                    <div class="col-md-4">
                        <span class="text-bold">{{ __("$760") }}</span>
                    </div>
                    <div class="col-md-12">
                        <p class="mt-2">{{ __("for fees and expenses of all services rendered for preparing, filing, noticing,
                            and attending hearings when there is opposition to a motion to value real property, treat claim as unsecured and avoid junior lien.") }}</p>
                    </div>
                    <div class="col-md-12">
                        <h3 class="underline">{{ __("Motions to Impose/Extend Automatic Stay") }}<h3>
                    </div>
                    <div class="col-md-2">
                        <span class="text-bold">{{ __("$445") }}</span>
                        <p class="text-bold">{{ __("$660") }}</p>
                    </div>
                    <div class="col-md-3">
                        <span class="text-bold">{{ __("(Unopposed)") }}</span>
                        <p class="text-bold">{{ __("(Opposed)") }}</p>
                    </div>
                    <div class="col-md-7">
                        <p>{{ __("for fees and expenses of all services rendered in opposition to motions to modify or vacate automatic stay.") }}</p>
                    </div>
                    <div class="col-md-12 mb-2">
                        <h3 class="underline">{{ __("Novel and Complex Motions and Oppositions to Motions") }}<h3>
                    </div>
                    <div class="col-md-12 mb-2">
                        <p>{{ __("These types of motions and oppositions may be billed at hourly rates, and counsel
                            must file a fee application in compliance with Federal Rules of Bankruptcy Procedure
                            and Local Bankruptcy Rules 2002 and 2016.") }}</p>
                    </div>
            </div>
            <div class="mb-2">
                <p class="text_italic text-bold">{{ __("Requirements for a fee application:") }}</p>
            </div>
            <p class="p_justify">{{ __("Once the attorney receives any guideline fee in the case, a later fee application must be based on atypicality.
            That requires showing that the case presented issues more difficult than those faced by Chapter 13 practitioners
            on a regular basis. See Law Offices of David A. Boone v. Derham-Burk (In re Eliapo), 468 F.3d 592 (9th Cir. 2006).
            Filing a novel and complex motion, or opposing one, may meet that description. All fee applications must comply with applicable rules,
            including Federal Rules of Bankruptcy Procedure and Local Bankruptcy Rules 2002 and 2016, and all United States Trustee guidelines.") }}</p>
            <div class="mt-2 mb-2">
                <p class="text_italic text-bold">{{ __("Debtor's objection to a fee application:") }}</p>
            </div>
            <p class="p_justify">{{ __("The debtor has the right to timely object to a fee application and may be heard in connection with any other party's
                fee objection. If the debtor disputes the legal services provided or the fees charged by the attorney, the debtor
                may file an objection with the court and set the matter for hearing.") }}</p>
            <div class="mt-2 mb-2">
                <p class="text_italic text-bold">{{ __("Dismissal or withdrawal of the attorney:") }}</p>
            </div>
            <p class="p_justify">{{ __("Any change of debtor's attorney must be approved by court order. This requirement applies to all substitutions and 
                withdrawals of counsel, including where: (1) debtor seeks to discharge the attorney; (2) the attorney seeks permission 
                to withdraw as counsel; and (3) debtor and their attorney file a stipulation to substitute or withdraw counsel.") }}</p>
            <div class="mt-2 mb-2">
                <p class="text_italic text-bold">{{ __("Payment of fees:") }}</p>
            </div>
            <p class="p_justify">{{ __("By signing this document, debtor agrees that their attorney can be paid guideline fees in the amounts listed above,
                if guideline fees have been chosen. All post-filing fees will be paid through the plan unless either the court orders otherwise,
                or the attorney: (1) holds in their client trust account all additional fees paid by the debtor; (2) promptly discloses receipt
                of those fees; and (3) promptly seeks court approval. Such fees may be disbursed from the attorney's client trust account only
                after the court awards them. The bankruptcy judge has discretion in approving fees and may allow less than the requested amount.") }}</p>
            <p>The initial guideline fee may not exceed $4,600 in consumer cases. The initial fee charged in this case is $	<input type="text" name="<?php echo base64_encode('Text7'); ?>" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="ml-2 price-by-attorney price-field form-control width_auto"></p>
            <p class="pt-3">{{ __("I acknowledge the foregoing.") }}</p>
            <div class="row">
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label class="pt-2">{{ __("Dated:") }} </label>
                        <div class="pl-3">
                            <input name="<?php echo base64_encode('Text8'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <div class="w-100 pl-3">
                            <input name="<?php echo base64_encode('Text9'); ?>" value="<?php echo $debtor_sign ;?>" type="text" class="form-control">
                            <label>{{ __("Debtor 1") }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label class="pt-2">{{ __("Dated:") }} </label>
                        <div class="pl-3">
                            <input name="<?php echo base64_encode('Text10'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <div class="w-100 pl-3">
                            <input name="<?php echo base64_encode('Text11'); ?>" value="<?php echo $debtor2_sign ;?>" type="text" class="form-control">
                            <label>{{ __("Debtor 2") }}</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group d-flex">
                        <label class="pt-2">{{ __("Dated:") }} </label>
                        <div class="pl-3">
                            <input name="<?php echo base64_encode('Text12'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mt-3">
                    <div class="input-group">
                        <div class="w-100 pl-3">
                            <input name="<?php echo base64_encode('Text13'); ?>" value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
                            <label>{{ __("Attorney for Debtor(s)") }}</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        
    
    </div>
</section>
<style>
    h3.text-thick{
  font-weight: 500;
}
.rts .price-field{
  width: 12%;
}
ol.inner_text li{
    list-style: sans-serif !important;
    padding: 5px;
}
input.form-control.input-1 {
  width: 80%;
}
input.form-control.input-2 {
  width: 77%;
}
input.form-control.input-3 {
  width: 15%;
}
input.form-control.input-4 {
  width: 15%;
}
input.form-control.input-5 {
  width: 56%;
}
.number-list {
  padding-left: 14px;
}
span.float-left {
  float: right;
}
</style>
