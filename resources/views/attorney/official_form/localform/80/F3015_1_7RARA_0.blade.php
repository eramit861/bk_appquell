<div class="container">
<div class="row">
    <div class="col-md-12 " style="border:1px solid #000;border-bottom:none;">
    <div class="row">
    <div class="col-md-6 p-3" >
        <div class="input-grpup">
            <label>{{ __("Attorney or Party Name, Address, Telephone & FAX Nos., State Bar No. & Email Address") }}</label>
            <textarea name="<?php echo base64_encode('Text1'); ?>" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
        </div>
    </div>
    
    <div class="col-md-6 p-3" style="border-left:1px solid #000;">
        <span>{{ __("FOR COURT USE ONLY") }}</span>
    </div>
</div>
</div>

<div class="col-md-12 " style="border:1px solid #000;">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 text-center">
            <h3 class="pt-2">{{ __("UNITED STATES BANKRUPTCY COURT") }}</h3>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-4"></div>
        <div class="col-md-5">
            <div class="d-flex pt-1 pb-2">
                <h3 class="pt-1">CENTRAL&nbsp;{{ __("DISTRICT") }}&nbsp;{{ __("OF") }}&nbsp;CALIFORNIA&nbsp;-&nbsp;</h3>
                <div class=" float_left">
                    <select name="<?php echo base64_encode('Division'); ?>" class="division_select form-control width_auto">
                        <option name="<?php echo base64_encode('Division'); ?>" value="**SELECT DIVISION**" >{{ __("**SELECT DIVISION**") }}</option>
                        <option name="<?php echo base64_encode('Division'); ?>" value="LOS ANGELES DIVISION" >{{ __("LOS ANGELES DIVISION") }}</option>
                        <option name="<?php echo base64_encode('Division'); ?>" value="RIVERSIDE DIVISION" >{{ __("RIVERSIDE DIVISION") }}</option>
                        <option name="<?php echo base64_encode('Division'); ?>" value="SANTA ANA DIVISION" >{{ __("SANTA ANA DIVISION") }}</option>
                        <option name="<?php echo base64_encode('Division'); ?>" value="NORTHERN DIVISION" >{{ __("NORTHERN DIVISION") }}</option>
                        <option name="<?php echo base64_encode('Division'); ?>" value="SAN FERNANDO VALLEY DIVISION" >{{ __("SAN FERNANDO VALLEY DIVISION") }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<div class="col-md-12 " style="border:1px solid #000;border-top:none;">
    <div class="row">
   <div class="col-md-6 pt-3 pb-2" style="border-right:1px solid #000;">
      <div class="input-grpup">
         <label>{{ __("In re:") }}</label>
         <textarea name="<?php echo base64_encode('Text2'); ?>" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
      </div>
      {{ __("Debtor(s).") }}
   </div>
   <div class="col-md-6 pt-3 pl-0 pr-0">
      <div class="d-flex radio-primary pl-3 pr-3"> 
         <label class="pt-2">{{ __("CASE") }}&nbsp;{{ __("Number:") }}</label>	
         <input name="<?php echo base64_encode('Text4'); ?>"  placeholder="" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" class=" ml-3 form-control">												
      </div>
      <div class="d-flex radio-primary mt-3 pl-3 pr-3"> 
         <label>{{ __("CHAPTER 13") }}</label>												
      </div>
      <div class="col-md-12 mt-3 text-center" style="border-top:1px solid #000;">
         <h3 class="mt-3">{{ __("RIGHTS AND RESPONSIBILITIES
                AGREEMENT BETWEEN DEBTOR") }} <br>
                {{ __("AND ATTORNEY FOR DEBTOR IN") }} <br>
                {{ __("A CHAPTER 13 CASE") }} <br>
                {{ __("(RARA)") }}
         </h3>
         <h3 class="mt-3">{{ __("[LBR 3017-1(v)]") }}</h3>
      </div>
   </div>
   </div>
   </div>

   <div class="col-md-12 mt-3">
        <h3>{{ __("TO DEBTOR (INCLUDING BOTH DEBTOR 1 AND DEBTOR 2 IF THIS IS A JOINT CASE):") }}</h3>
         <p class="p_justify mt-2">{{ __("It is important for a Debtor who files a Chapter 13 bankruptcy case to understand his or her rights and responsibilities.
            It is also important for a Debtor to know what the attorney’s responsibilities are and to communicate carefully with the attorney to make the case successful. A Debtor is also entitled to expect certain services to be performed by the attorney.
            In order to assure that Debtor and the attorney understand their rights and responsibilities in the Chapter 13 process, the following rights and responsibilities have been adopted by the court.
            The signatures below indicate that the responsibilities outlined in the agreement have been accepted by Debtor(s) and the attorney. Nothing in this agreement is intended to modify, enlarge or abridge the rights and
            responsibilities of a “debt relief agency,” as that term is defined and used in 11 U.S.C. § 101, et seq.") }}
        </p>
          <p class="p_justify">{{ __("Once an attorney is retained to represent a Debtor in a Chapter 13 case, the attorney is responsible for 
            representing Debtor on all matters arising in the case, other than adversary proceedings,
            unless otherwise ordered by the court.
            (Once retained, the attorney is referred to as Attorney for Debtor, or Attorney.)
            Attorney may not withdraw absent consent of Debtor for withdrawal or substitution of counsel
            and/or approval by the court of a motion for withdrawal or substitution of counsel considered
             after notice and a hearing.When appropriate, Attorney may apply to the court for compensation additional to
                the maximum initial fees set forth below in this agreement.") }}
            </p>
            <div class="box text-center pb-1 pt-1"style="border:1px solid #111;  font-style: italic;">
                <span>{{ __("“Bankruptcy Code” and “11 U.S.C.” refer to the United States
                       Bankruptcy Code, Title 11 of the United States Code.") }}<br>
                       {{ __("“FRBP” refers to the Federal Rules of Bankruptcy Procedure.
                       “LBR” and “LBRs” refer to the Local Bankruptcy Rule(s) of this court.") }}
                </span>
            </div>
   </div>

   <div class="col-md-12 mt-3">
        <h3>{{ __("BEFORE THE CASE IS FILED, DEBTOR AGREES TO:") }}</h3>   
            <div class="mt-2">
                <p class="mb-2"><span class="mr-2">1.</span> {{ __("Discuss with Attorney why the case is being filed.") }}</p>  
                <p class="mb-2"><span class="mr-2">2.</span> {{ __("Timely provide Attorney with accurate information, financial") }}</p>
                <p class="mb-2"><span class="mr-2">3.</span> Timely provide Attorney with all documentation requested by Attorney, including but not limited to,
                   true and correct copies of the following documents*:</p>
            </div> 
            <!--need to alfabet-->  
            <ol class="inner_text ml-4 alphaol pl-3" type="A">
                 <li class="pl-3 pb-1">{{ __("Certificate of Credit Counseling, together with the debt repayment plan, if any,
                    prepared by the nonprofit budget and credit counseling agency that provided individual
                    counseling services to Debtor prior to bankruptcy.") }}
                </li>
                <li class="pl-3 pb-1 p_justify">{{ __("Proof of income from all sources received during the period of six (6) months 
                    before the date of the filing of the petition, including but not limited to paycheck stubs,
                    Social Security statements, worker’s compensation, rental, pension, disability, 
                    and self-employment income, and other payment advices. For businesses, Debtor should provide
                    report(s) disclosing monthly income and expenses for the period of 6 months before the date
                    of the filing of the bankruptcy petition for businesses with annualized gross income of less
                    than $120,000 and 12 months of monthly income and expenses for businesses with annualized 
                    gross income of $120,000 or more.") }}
                </li>
                <li class="pl-3 pb-1 p_justify">{{ __("Proof of ability to pay from any person contributing
                     financial assistance to Debtor in the case, including a declaration 
                    with copies of paystubs or other deposits or checks to show the person’s
                    ability to make the contribution.") }}
                </li>
                <li class="pl-3 pb-1 p_justify">{{ __("Federal and state income tax returns, or transcripts of such returns,
                 for the most recent tax year ending immediately before the commencement of the case.") }}
                </li>
                 <li class="pl-3 pb-1 p_justify">{{ __("Proof of debtor’s identity, including a driver’s license, passport,
                    or other document containing a photograph of Debtor.
                    Also proof of Debtor’s Social Security number or Individual
                    Tax Identification Number (ITIN).") }}
                </li>
                <li class="pl-3 pb-1 p_justify">{{ __("A record of Debtor’s interest, if any, in an educational
                    individual retirement account or under a qualified State tuition program.") }}
                </li>
                <li class="pl-3 pb-1 p_justify">{{ __("The name, address and telephone number of any person to whom Debtor owes back
                    child or spousal support, the name, address and telephone number of any person to whom Debtor makes current 
                    child or spousal support payments and all supporting documents for the child or spousal support payments.
                    Examples of supporting documents are a court order, declaration of voluntary
                    support payments, separation agreement, marital dissolution or divorce decree and a property settlement agreement.") }}
                </li>
                <li class="pl-3 pb-1 p_justify">{{ __("Insurance policies owned by Debtor, including homeowner’s insurance, business insurance,
                    automobile insurance, fire insurance, flood insurance, earthquake insurance, and credit life insurance.") }}</li>
            </ol>
            <p class="pl-3 ml-3 pb-1 p_justify mt-2"><span class="pr-3">*</span> {{ __("All documents submitted to Attorney must be copies as the documents will not be returned to Debtor.") }}</p>
   </div>
   <div class="col-md-12 ">
       <h3 class="mb-3">{{ __("AFTER THE CASE IS FILED, DEBTOR AGREES TO:") }}</h3>
       <div class="number-list">
            
            <ol class="inner_text decimalol pl-3">
                <li class="pl-3 pb-1">{{ __("Timely make the required monthly payments.") }}</li>
                <li class="pl-3 pb-1">{{ __("Comply with the Chapter 13 rules and procedures.") }}</li>
                <li class="pl-3 pb-1">{{ __("Keep the Chapter 13 Trustee and Attorney informed of Debtor’s current address and telephone number, and Debtor’s employment status.") }}</li>
                <li class="pl-3 pb-1">{{ __("Sign a payroll deduction order, if one is required.") }}</li>
                <li class="pl-3 pb-1">{{ __("Inform Attorney of any change in Debtor’s marital status, the commencement of any child support or spousal support obligation, or a change in any existing child support or spousal support obligation.") }}</li>
                <li class="pl-3 pb-1">{{ __("Inform Attorney of any wage garnishments or liens or levies on assets that occur or continue after the filing of the case.") }}</li>
                <li class="pl-3 pb-1">{{ __("Contact Attorney promptly if Debtor loses his or her job, encounters other new or unexpected financial problems, if Debtor’s income increases, or if Debtor receives, or learns of the right to receive, money or other proceeds of an inheritance or legal action.") }}</li>
                <li class="pl-3 pb-1">{{ __("Timely inform Attorney of any change in a creditor’s address or payment amount.") }}</li>
                <li class="pl-3 pb-1">{{ __("Keep records of all mortgage, vehicle and personal property payments made to all secured creditors during the case.") }}</li>
                <li class="pl-3 pb-1">{{ __("Provide Attorney with any federal tax returns or transcripts requested pursuant to 11 U.S.C. § 521(f).") }}</li>
                <li class="pl-3 pb-1">{{ __("Contact Attorney promptly if Debtor is sued during the case or if Debtor commences a lawsuit or intends to settle any dispute.") }}</li>
                <li class="pl-3 pb-1">{{ __("Inform Attorney if any tax refunds to which Debtor is entitled are seized or not received when expected by Debtor from the IRS or Franchise Tax Board.") }}</li>
                <li class="pl-3 pb-1">{{ __("Contact Attorney promptly before buying, refinancing, or selling real property, and before incurring substantial additional debt such as for the purchase of a car.") }}</li>
                <li class="pl-3 pb-1">{{ __("Pay directly to Attorney any court filing fees.") }}</li>
                <li class="pl-3 pb-1">{{ __("Cooperate with Attorney to identify and preserve electronically stored information (ESI).") }}</li>
            </ol>
        </div>
    </div>
    <div class="col-md-12 mt-3">
       <h3 class="mb-3 ">{{ __("BEFORE THE CASE IS FILED, ATTORNEY AGREES TO PROVIDE AT LEAST THE FOLLOWING LEGAL SERVICES FOR THE BASE FEE AGREED TO WITH DEBTOR:") }}</h3>
       <p class="p_justify">{{ __("As used herein, the term “Personally” means that the described service must be performed only by an attorney who is a member in good standing of the State Bar of California and admitted to practice before this court. The service must not be performed by a non-attorney even if such individual is employed by the attorney and under the direct supervision and control of such attorney.") }}</p>
       <div class="text-bold">
          <ol class="inner_text decimalol pl-3">
            <li class="pl-3 pb-1 p_justify">{{ __("Personally meet with Debtor to review Debtor's assets, liabilities, income, and expenses.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Personally counsel Debtor regarding the advisability of filing either a Chapter 13 or a Chapter 7 bankruptcy case, discuss both procedures with Debtor, and answer Debtor's questions.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Personally review with Debtor the completed bankruptcy petition, plan, statements, and schedules, as well as all amendments thereto, whether filed with the petition or later.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Personally explain to Debtor that Attorney is being engaged to represent Debtor on all matters arising in the case, as required by Local Bankruptcy Rule 3015-1(t).") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Personally explain to Debtor how and when Attorney’s fees and expenses and the Chapter 13 Trustee’s fees are determined and paid, and provide an executed copy of this RARA document to Debtor.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Timely prepare and file the Debtor’s bankruptcy petition, plan, statements, schedules, and required documents and certificates.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Explain to Debtor and confirm in writing which payments must be made directly to creditors by Debtor and which payments will be made through Debtor's Chapter 13 plan, with particular attention to mortgage and vehicle loan or lease payments.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Explain to Debtor and confirm in writing how, when, and where to make the Chapter 13 plan payments.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Explain to Debtor how, when, and where to make postpetition mortgage, mobile home, manufactured home, and vehicle loan and lease payments and confirm this information in writing.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Advise Debtor of the necessity to maintain appropriate insurance, including homeowner’s insurance and liability, collision and comprehensive insurance on vehicles securing loans or leases.") }}</li>  
            <li class="pl-3 pb-1 p_justify">{{ __("Meet with Debtor to determine the scope of Debtor’s duty to preserve electronically stored information (ESI) and to take reasonable steps (proportionate to the needs of the case) to identify and preserve potentially relevant ESI.") }}</li>  
          <ol>
       </div>
    </div>
<div class="col-md-12 mt-3">
    <h3 class="mb-3 p_justify">{{ __("AFTER THE CASE IS FILED, ATTORNEY AGREES TO PROVIDE AT LEAST THE FOLLOWING LEGAL SERVICES WHICH ARE COVERED BY THE BASE FEE AGREED TO WITH DEBTOR:") }}</h3>
    <div>
        <ol class="inner_text decimalol pl-3">
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Advise Debtor of the requirement to attend the 11 U.S.C. § 341(a) meeting of creditors, and instruct Debtor as to the date, time, and place of the meeting.
                 In a joint bankruptcy case, inform Debtor that both spouses must appear.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Inform Debtor that Debtor must be punctual for the 11 U.S.C. § 341(a) meeting of creditors. “Punctual” means that Attorney and Debtor(s) must be present on time for check-in. After checking in, if Attorney finds it necessary to request “second [calendar] call,” the attorney and Debtor(s) must be present for examination before the end of the calendar.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Attend the 11 U.S.C. § 341(a) meetings and any court hearing, either personally or through another attorney from Attorney’s firm or through an appearance attorney who has been adequately briefed on the case.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Advise Debtor if an appearance attorney will appear on Debtor’s behalf at the 11 U.S.C. §341(a) meeting or any court hearing, and explain to Debtor in advance, if possible, the role and identity of the appearance attorney. In any event, Attorney is responsible to prepare adequately the appearance attorney in a timely fashion and to furnish the appearance attorney with all necessary documents, hearing notes,
                 and other necessary information in sufficient time to allow for review of such information and proper representation of Debtor.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Timely serve the plan and mandatory notice on all creditors.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Timely – seven (7) days prior to the first scheduled 11 U.S.C. §341(a) meeting of creditors - submit to the Chapter 13 Trustee properly documented proof of all sources of income for Debtor, including business reports and supporting documentation required by Local Bankruptcy Rules.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Timely respond to objections to plan confirmation and, where necessary, prepare, file, and serve an amended plan.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Timely prepare, file, and serve any necessary amended statements and schedules and any change of address, in accordance with information provided by Debtor.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Monitor all incoming case information throughout the case (including, but not limited to, Order Confirming Plan, Notice of Intent to Pay Claims, and the Chapter 13 Trustee’s status reports) for accuracy and completeness.
                 Contact the Chapter 13 Trustee promptly regarding any discrepancies.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Review the claims register after expiration of the period during which claims may be timely filed.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Review the Chapter 13 Trustee’s notice of intent to pay claims after entry of a plan confirmation order.") }}</li>
            <li class="pl-3 pb-1 p_justify text-bold">{{ __("Timely prepare and file Debtor’s Certificate of Compliance under 11 U.S.C. §1328(a) and Application for Entry of Discharge (F 3015-1.8.DISCHARGE.APPLICATION)") }}</li>
            <h3 class="text-thick mt-3 mb-3 p_justify" style="font-weight: normal; margin-left: -1rem;">{{ __("AFTER THE CASE IS FILED, ATTORNEY IS RESPONSIBLE FOR PROVIDING THE FOLLOWING SERVICES AND MAY REQUEST APPROVAL OF ADDITIONAL COMPENSATION FOR THESE SERVICES FROM THE COURT:") }}</h3>
            <li class="pl-3 pb-1 p_justify">{{ __("File objections to improper or invalid claims, when appropriate.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Prepare and file a proof of claim, when appropriate, if a creditor fails to do so.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Prepare, file, and serve timely motions to modify the plan after confirmation, when necessary.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Prepare, file, and serve any other motion that may be necessary to appropriately represent Debtor in the case, including but not limited to, motions to impose or extend the automatic stay.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Timely respond to all motions filed by the Chapter 13 Trustee, and represent Debtor in response to all other motions filed in the case, including but not limited to, motions for relief from stay.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("When appropriate, prepare, file, and serve motions to avoid liens on real or personal property, and motions to value the collateral of secured creditors.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Be available to respond to Debtor’s questions throughout the term of the plan, and provide such other legal services as are necessary for the administration of the case before the bankruptcy court.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Represent Debtor at a discharge hearing, if required.") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("If a response to a Notice of Final Cure Payment is filed by a secured creditor and the response shows post-petition delinquencies, Attorney must contact Debtor and determine whether Debtor agrees with the") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("Notice as filed by the Creditor. If Debtor disagrees, Attorney must file a motion for determination of final cure and payment under the provisions of FRBP 3002.1(h).") }}</li>
            <li class="pl-3 pb-1 p_justify">{{ __("If not representing Debtor in adversary proceedings, confirm this fact in writing and refer Debtor to at least one attorney qualified to assist Debtor in any adversary proceeding filed in the case.") }}</li>
        </ol>
    </div>
</div>
<div class="col-md-12 mt-3">
    <h3>{{ __("ALLOWANCE AND PAYMENT OF ATTORNEYS’ FEES AND COSTS:") }}</h3>
</div>
<div class="col-md-12 mt-3 mb-3">
     <p class="p_justify">{{ __("The guidelines of this court for allowance and payment of attorneys’ fees and related expenses incurred
         for performing the services in Chapter 13 cases which are to be included in the Base Fee without a 
         detailed fee application provide for the following maximum Base Fee: $6,000
         (excluding the petition filing fee and with a maximum of $5,000 to be paid prior to Plan confirmation) 
         in cases where Debtor is engaged in a business; or $5,000 (excluding the petition filing fee) in all other cases.
         In this case, the parties agree that the Base Fee (excluding the petition filing fee) will be") }} 
         $<input name="<?php echo base64_encode('Text5'); ?>" type="text" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="price-by-attorney price-field form-control width_auto">.</p>
         <p class="mt-3">{{ __("Other than the initial retainer, Attorney may not receive fees directly from Debtor before Plan confirmation.
            All other fees due through confirmation must be paid through the Plan unless otherwise ordered by the court.") }}</p> 
         <p class="p_justify">{{ __("If Attorney performs tasks on behalf of Debtor for which Additional Fees may be awarded, Attorney may apply to the court for such Additional Fees and costs,
            but such applications will be reviewed by both the Chapter 13 Trustee and the court. Attorney agrees to charge for such additional services at the rate of") }}
            $<input name="<?php echo base64_encode('Text6'); ?>" type="text" value="<?php echo Helper::validate_key_value('attorney_hourly_rate', $savedData); ?>" class="price-hourly-attorney price-field form-control width_auto">{{ __("per hour.
            Attorney agrees to give Debtor written notice of any change in the hourly rate prior to rendering additional services. 
            Alternatively, Attorney may charge a reasonable flat fee for some specified service(s) consistent with § 2.9 of the Court Manual.
            In either event, Attorney must disclose to the court in the fee application any fees paid or costs reimbursed by Debtor and the source of those payments.
            Any fees received directly from Debtor must be deposited in the attorney’s client trust account until a fee application is approved by the court.") }}</p>
            <p class="p_justify">{{ __("If Debtor disputes the legal services provided or the fees or costs charged by the attorney, Debtor may file an objection with the court and request a hearing.
               Should the representation of Debtor create a hardship,
               Attorney may seek a court order allowing Attorney to withdraw from the case.
               Debtor may discharge Attorney at any time.") }}</p>
</div>

</div>
<div class="text-center"  style="border:5px solid #000;border-top:none; border-left:none; border-right:none">
            <h3>{{ __("*******IMPORTANT******") }}</h3>
        </div> 
        <div class="col-md-12 mt-3 mb-3">
            <p class="text-bold mb-0">{{ __("BY SIGNING THIS") }} (<span class="text_italic">{{ __("name of Debtor(s)") }}</span>) <input name="<?php echo base64_encode('Text9'); ?>"  type="text" value="{{$onlyDebtor}}" class="width_24percent form-control mb-2"></p>
            <p class="text-bold mb-0">{{ __("AGREES THAT ATTORNEY") }} (<span class="text_italic">{{ __("name of Attorney") }}</span>) <input name="<?php echo base64_encode('Text99'); ?>"  type="text" value="{{$atroneyName}}" class="width_24percent form-control mb-2"></p>
            <p class="text-bold mb-0">{{ __("WILL RECEIVE A BASE FEE OF") }} (<span class="text_italic">{{ __("amount") }}</span>) $<input name="<?php echo base64_encode('Text7'); ?>" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>"  type="text" class="price-by-attorney width_auto form-control mb-2 price-field">AND (<span class="text_italic">amount</span>) $ <input name="<?php echo base64_encode('Text8'); ?>" value="<?php echo Helper::validate_key_value('attorney_hourly_rate', $savedData); ?>" type="text" class="price-hourly-attorney width_auto form-control mb-2 price-field"> PER HOUR FOR ANY EXTRA WORK.</p>
        </div>

        <div class="row">  
            <div class="col-md-12 mb-3 ">  
                <p class="pl-3"><span class="underline mr-2">{{ __("Debtor's Signature.") }}</span>{{ __("Debtor's signature below certifies that Debtor has read, understands and agrees to the best
                    of his or her ability to carry out the terms of this agreement
                    agrees to the scope of this agreement, and has received a signed copy of this agreement.") }}</p>
                <p class="pl-3"><span class="underline mr-2">{{ __("Attorney’s Signature.") }}</span>{{ __("Attorney’s signature below certifies that before the case was filed, Attorney personally 
                    met with, counseled, and explained the foregoing matters to Debtor and verified the number and status of any 
                    prior bankruptcy case(s) filed by Debtor or any related entity, as set forth in Local Bankruptcy Rule 1015-2.  
                    This RARA agreement does not constitute the written fee agreement contemplated by the California Business 
                    & Professions Code.") }}</p>
            </div> 
            <div class="col-md-6 ">
                <div class="input-group pl-3">
                    <input name="<?php echo base64_encode('Text10'); ?>" value="<?php echo $debtor_sign ;?>" type="text" class="form-control">
                    <label>{{ __("Signature of Debtor 1") }}</label>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="input-group ">
                    <div class="">
                        <input name="<?php echo base64_encode('DATE1'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
                    </div>
                    <label class="pt-2">{{ __("Date") }} </label>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="input-group pl-3">
                    <input name="<?php echo base64_encode('Text11'); ?>" value="<?php echo $debtor2_sign ;?>" type="text" class="form-control">
                    <label>{{ __("Signature of Debtor 2") }}</label>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="input-group ">
                    <div class="">
                        <input name="<?php echo base64_encode('DATE2'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
                    </div>
                    <label class="pt-2">{{ __("Date") }} </label>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="input-group pl-3">
                    <input name="<?php echo base64_encode('Text12'); ?>" value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
                    <label>{{ __("Signature of Attorney") }}</label>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="input-group ">
                    <div class="">
                        <input name="<?php echo base64_encode('DATE3'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
                    </div>
                    <label class="pt-2">{{ __("Date") }} </label>
                </div>
            </div>



        </div>
</div>
