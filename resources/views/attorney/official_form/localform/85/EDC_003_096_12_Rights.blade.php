<div class="container">
    <div class="row">
        <div class="col-md-6">
            <input name="<?php echo base64_encode('Text1'); ?>" type="text" value="<?php echo $attorney_company['state_bar'] ?? ''; ?>" class="form-control">
        </div>
        <div class="col-md-6">
            <p class="pt-2 text_italic">{{ __("[Name; State Bar ID No.]") }}</p>
        </div>
        <div class="col-md-6">
            <input name="<?php echo base64_encode('Text2'); ?>" type="text" value="<?php echo $attorney_company['attorney_address'] ?? ''; ?>" class="form-control">
        </div>
        <div class="col-md-6 ">
            <p class="pt-2 text_italic">{{ __("[Address]") }}</p>
        </div>
        <div class="col-md-6 ">
            <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="<?php echo $attorney_company['attorney_address2'] ?? ''; ?>" class="form-control">
        </div>
        <div class="col-md-6 mt-1">
            <p class="text_italic"></p>
        </div>
        <div class="col-md-6 mt-1">
            <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="<?php echo $attorney_company['attorney_city'] ?? '';
            echo isset($attorney_company['attorney_state']) ? ", ".$attorney_company['attorney_state'] : '';
            echo isset($attorney_company['attorney_zip']) ? ', '.$attorney_company['attorney_zip'] : '';?>" class="form-control">
        </div>
        <div class="col-md-6 mt-1">
            <p class="text_italic"></p>
        </div>
        <div class="col-md-6 mt-1">
            <input name="<?php echo base64_encode('Text3'); ?>" type="text" value="<?php echo $attorneyPhone; ?>" class="form-control">
            <label for="">{{ __("Attorney for Debtor(s)") }}</label>
        </div>
        <div class="col-md-6">
            <p class="pt-2 text_italic">{{ __("[Telephone]") }}</p>
        </div>
        <div class="col-md-12 mt-3 text-center">
            <h3>{{ __("UNITED STATES BANKRUPTCY COURT") }} <br> {{ __("EASTERN DISTRICT OF CALIFORNIA") }}</h3>
        </div>
        <div class="col-md-6 pb-2 mt-3 border_bottom_1px border_right_1px">
            <div class="input-grpup">
                <label>{{ __("In re:") }}</label>
                <textarea name="<?php echo base64_encode('Text6'); ?>"  class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div> 
            <label class="float_right">{{ __("Debtor(s).") }}</label>
        </div>
        <div class="col-md-6 mt-3 ">
            <div class="d-flex mb-3">
                <label class="pt-2">{{ __("CASE NO.:") }}</label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('Text7'); ?>" placeholder="" type="text" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" class=" form-control">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <h3 class="text-center underline mt-3">{{ __("RIGHTS AND RESPONSIBILITIES OF CHAPTER 13 DEBTORS AND THEIR ATTORNEYS") }}</h3>
            <p class="p_justify mt-3">{{ __("It is important for Debtors who file a chapter 13 bankruptcy case to understand their rights and responsibilities. It is also important for Debtors to know what their attorney's responsibilities are, and to understand the importance of communicating with their attorney to make the case successful. Debtors should also know that they may expect their attorney to perform certain services.") }} </p>
            <p class="p_justify">{{ __("Unless otherwise ordered by the Court, an attorney retained to represent a Debtor in a bankruptcy case is responsible for representing the Debtor for all purposes in the case other than adversary proceedings. When appropriate, the attorney may apply to the court for compensation additional to the maximum initial fees set forth below.") }} </p>
            <p class="p_justify">{{ __("In order to assure that Debtors and their attorneys understand their rights and responsibilities in the bankruptcy process, absent a contrary court order, Debtors and their attorneys agree as set forth below.") }}</p>
            <h3 class="underline mt-3">{{ __("BEFORE THE CASE IS FILED, THE DEBTOR AGREES TO:") }}</h3>
            <div class="d-flex mt-2">
                <label for="">1.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Discuss with the attorney the Debtor's objectives in filing the case.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">2.</label>
                <div class="pl-4">
                    <p class="p_justify">{{ __("Timely provide the attorney with accurate information, financial and otherwise, and all documentation requested by the attorney.") }}</p>
                </div>
            </div>
            <h3 class="underline mt-3">{{ __("BEFORE THE CASE IS FILED, THE ATTORNEY AGREES TO:") }}</h3>
            <div class="d-flex mt-2">
                <label for="">1.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Meet with the Debtor to review the Debtors debts, assets, liabilities, income, and expenses.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">2.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Counsel the Debtor regarding the advisability of filing either a chapter 13 or a chapter 7 case, discuss
                        both procedures with the Debtor, and answer the Debtor's questions.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">3.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Timely prepare and file the Debtor's petition, plan, lists, statements, schedules, required documents
                        and certificates.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">4.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Review with the Debtor the completed petition, plan, lists, statements, schedules, required documents
                        and certifications, as well as all amendments thereto, whether filed with petition or later.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">5.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Explain which payments will be made directly to creditors by the Debtor and which payments will be
                        made through the Debtor's chapter 13 plan, with particular attention to mortgage and vehicle loan or
                        lease payments.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">6.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Explain to the Debtor how, when, and where to make the chapter 13 plan payments.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">7.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Explain to the Debtor how, when, and where to make post-petition mortgage and vehicle loan or lease payments.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">8.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Explain to the Debtor that the attorney is being engaged to represent the Debtor for all purposes in the case, except adversary proceedings, pursuant to Local Bankruptcy Rule 2017-1(a)(1).") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">9.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Explain to the Debtor how and when the attorney’s fees and chapter 13 trustee's fees are determined and paid, and provide an executed copy of this document to the Debtor.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">10.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Advise the Debtor of the necessity to maintain appropriate insurance including homeowner’s insurance and liability, collision, and comprehensive insurance on vehicles securing loans or leases.") }}</p>
                </div>
            </div>
            <h3 class="underline mt-3">{{ __("AFTER THE CASE IS FILED, THE DEBTOR AGREES TO:") }}</h3>
            <div class="d-flex mt-2">
                <label for="">1.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">&nbsp;{{ __("Keep the chapter 13 trustee and attorney informed of the Debtor's current address and telephone number, and the Debtor’s employment status.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">2.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Inform the attorney of any change in the Debtor’s marital status, the commencement of any child or spousal support obligation, or a change in any existing child support or spousal support obligation.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">3.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Inform the attorney of any wage garnishments or liens or levies on assets that occur or continue after the filing of the case.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">4.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Contact the attorney promptly if the Debtor loses his/her job, encounters new or unexpected financial problems, if the Debtor’s income increases, or if the Debtor receives, or learns of the right to receive, money or other proceeds of an inheritance or legal action.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">5.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Contact the attorney promptly if the Debtor is sued during the case, or if the Debtor commences a lawsuit or intends to settle any dispute.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">6.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Inform the attorney if any tax refunds to which the Debtor is entitled are seized or not received when expected from the IRS or Franchise Tax Board.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">7.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Contact the attorney before transferring, selling, encumbering, refinancing, or otherwise disposing of any personal or real property with a value of $1,000 or more.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">8.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Contact the attorney before incurring new debt exceeding $1,000.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">9.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Pay directly to the attorney any filing fees.") }}</p>
                </div>
            </div>
            <h3 class="underline mt-3">{{ __("AFTER THE CASE IS FILED, THE ATTORNEY AGREES TO:") }}</h3>
            <div class="d-flex mt-2">
                <label for="">1.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">&nbsp;{{ __("Advise the Debtor of the requirement to attend the §341(a) meeting of the creditors and instruct the Debtor as to the date, time and place of the meeting. In joint cases, inform the Debtor that both spouses must appear.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">2.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Appear at the §341(a) meeting of creditors with the Debto.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">3.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Timely serve the Debtor’s plan on the chapter 13 trustee.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">4.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Timely provide to the chapter 13 trustee the") }} <span class="text_italic">{{ __("Domestic Support Obligation Checklist (form EDC 3-088), Class 1 Checklist") }}</span> (form EDC 3-086), and <span class="text_italic">{{ __("Authorization to Release Information to Trustee Regarding Secured Claims Being Paid By the Trustee") }}</span> {{ __("(form EDC 3-087) required by Local Bankruptcy Rule 3015-1(b)(6).") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">5.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Timely respond to objections to plan confirmation and, where necessary, prepare, file, and serve an amended plan.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">6.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Prepare, file, and serve necessary modifications to the plan which may include suspending, lowering, or increasing plan payments.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">7.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Prepare, file and serve any necessary amended statements and schedules and any change of address, in accordance with information provided by the Debtor.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">8.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Object to improper or invalid claims, if necessary, based upon documentation provided by the Debtor.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">9.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Prepare and file a proof of claim, when appropriate, if a creditor fails to do so.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">10.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Prepare, file, and serve motions to modify the plan after confirmation, when necessary.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">11.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Prepare, file, and serve motions to buy, sell, or refinance property, when appropriate.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">12.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Prepare, file, and serve any other motion that may be necessary to appropriately represent the Debtor
                        in the case.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">13.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Timely respond to all motions filed by the chapter 13 trustee, and represent the Debtor in response to other motions filed in the case including, but not limited to, motions for relief from stay.") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">14.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Where appropriate, prepare, file, serve, and set for hearing motions to avoid liens on real or personal property and motions to value the collateral of secured creditors as required by Local Bankruptcy Rule 3015-1(j).") }}</p>
                </div>
            </div>
            <div class="d-flex">
                <label for="">15.</label>
                <div class="pl-4">
                    <p class="p_justify mb-2">{{ __("Provide such other legal services as are necessary for the administration of the Debtor’s case before the Bankruptcy Court.") }}</p>
                </div>
            </div>
            <p class="p_justify mt-3">{{ __("The fee charged for a chapter 13 bankruptcy is a matter for negotiation between the attorney and the Debtor. While Local Bankruptcy Rule 2016-1(c)(1) permits an initial fee of up to $4,000.00 in non-business cases, and $6,000.00 in business cases, lesser fees may be negotiated. These initial fees may be paid, in whole or in part, directly by the Debtor prior to the filing of the petition. To the extent not paid by the Debtor before the filing of the petition, the fees must be paid through the plan by the chapter 13 trustee.") }}</p>
            <p class="p_justify mt-3">{{ __("Initial fees charged in this case are") }} $&nbsp;<input name="<?php echo base64_encode('Text8');?>" type="text" value="<?php echo Helper::validate_key_value('attorney_price', $savedData); ?>" class="price-field price-by-attorney form-control width_auto"> , and of this amount, $&nbsp;<input name="<?php echo base64_encode('Text9');?>" type="text" value="<?php echo ''; ?>" class="price-field form-control width_auto"> {{ __("was paid by the Debtor before the filing of the petition. While this initial fee should be sufficient to fully and fairly compensate counsel for all pre-confirmation services and most post-confirmation services rendered in the case, where substantial and unanticipated post-confirmation work is necessary, the attorney may request that the court approve additional fees. If additional fees are approved, they shall be paid through the plan by the chapter 13 trustee unless otherwise ordered. The attorney may not receive fees directly from the Debtor.") }}</p>
        </div>
        <div class="col-md-6 mt-3">
            <div class="input-group d-flex">
                <label class="pt-2">{{ __("DATED:") }} </label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('Text10'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="input-group text-center">
                <input name="<?php echo base64_encode('Text13.0'); ?>" value="<?php echo $debtor_sign ;?>" type="text" class="form-control">
                <label>{{ __("Debtor") }}</label>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="input-group d-flex">
                <label class="pt-2">{{ __("DATED:") }} </label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('Text11'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="input-group text-center">
                <input name="<?php echo base64_encode('Text13.1'); ?>" value="<?php echo $debtor2_sign ;?>" type="text" class="form-control">
                <label>{{ __("Joint Debtor") }}</label>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="input-group d-flex">
                <label class="pt-2">{{ __("DATED:") }} </label>
                <div class="pl-3">
                    <input name="<?php echo base64_encode('Text12'); ?>" placeholder="{{ __("MM/DD/YYYY") }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="input-group text-center">
                <input name="<?php echo base64_encode('Text13.2'); ?>" value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
                <label>{{ __("Attorney for Debtor(s)") }}</label>
            </div>
        </div>


        
    </div>
</div>

