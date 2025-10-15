<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 p-3 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('Text1'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
            </div>
            <div class="col-md-6 p-3 mt-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3 text-center" style="border-top:3px solid #000;">
                <label><strong>{{ __('UNITED STATES BANKRUPTCY COURT') }}</strong></label><br>
                <label>{{ __('SOUTHERN DISTRICT OF CALIFORNIA') }}</label><br>
                <label>{{ __('325 West F Street, San Diego, California 92101-6991') }}</label>
            </div>
            <div class="col-md-6 p-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 p-3" style="border-top:3px solid #000; border-bottom:3px solid #000;">
                <label>{{ __('In Re') }}</label>
                <textarea style="margin-right:40px" name="<?php echo base64_encode('Text2'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                <div class="row">
                    <div class="col-md-8">
                        <label style="" >{{ __('Last four digits of Soc.Sec. or') }}</label><br>
                        <label>{{ __('Individual-Taxpayer I.D.(ITIN)/Complete EIN:') }}</label>
                    </div>
                    <div class="col-md-4">
                        <label style="" >{{ __('Debtor.') }} </label>
                        <input name="<?php echo base64_encode('Text4'); ?>" value="{{$last_4_ssn_d1}}" type="text" class=" form-control">
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-3" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                    <label>{{ __('BANKRUPTCY NO.') }}</label>
                    <input name="<?php echo base64_encode('Text3'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
        {{ __('UNITED STATES BANKRUPTCY COURT') }} <br>
            {{ __('SOUTHERN DISTRICT OF CALIFORNIA') }} <br>
            {{ __('RIGHTS AND RESPONSIBILITIES OF CHAPTER 7 DEBTORS') }} <br>
            {{ __('AND THEIR ATTORNEY') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('In order for debtors and their attorneys to understand their rights and responsibilities in the
            bankruptcy process, the following terms of engagement are hereby agreed to by the parties.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('Nothing in this agreement should be construed to excuse an attorney from any ethical duties or
            responsibilities under Federal Rule of Bankruptcy Procedure 9011 and the Local Bankruptcy
            Rules.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            I. <br>
            {{ __('Services Included in the Initial Fee Charged') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('The following are services that an attorney must provide as part of the initial fee charged for
            representation in a Chapter 7 case:') }}
        </p>
    </div>

    <div class="row mt-10">
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">1.</p>
                <p> {{ __("Meet with the debtor to review the debtor's assets, liabilities, income and expenses.") }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">2.</p>
                <p> {{ __('Analyze the debtor’s financial situation, and render advice to the debtor in determining
                    whether to file a petition in bankruptcy') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">3.</p>
                <p> {{ __('Describe the purpose, benefits, and costs of the Chapters the debtor may file, counsel the
                    debtor regarding the advisability of filing either a Chapter 7, 11 or 13 case, and answer the
                    debtor’s questions') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">4.</p>
                <p> {{ __('Advise the debtor of the requirement to attend the Section 341(a) Meeting of Creditors, and
                    instruct the debtor as to the date, time and place of the meeting') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">5.</p>
                <p> {{ __('Advise the debtor of the necessity of maintaining liability, collision and comprehensive
                    insurance on vehicles securing loans or leases') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">6.</p>
                <p> {{ __('Timely prepare, file and serve, as required, the debtor’s petition, schedules, Statement of
                    Financial Affairs, and any necessary amendments to Schedule C.') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">7.</p>
                <p> {{ __('Provide documents pursuant to the Trustee Guidelines and any other information
                    requested by the Chapter 7 Trustee or the Office of the United States Trustee') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">8.</p>
                <p> {{ __('Provide an executed copy of the Rights and Responsibilities of Chapter 7 Debtors and
                    their Attorneys to the debtor') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">9.</p>
                <p> {{ __('Appear and represent the debtor at the Section 341(a) Meeting of Creditors, and any
                    continued meeting, except as further set out in Section II') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">10.</p>
                <p> {{ __('File the Certificate of Debtor Education if completed by the debtor and provided to the
                    attorney before the case is closed.') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">11.</p>
                <p> {{ __('Attorney shall have a continuing obligation to assist the debtor by returning telephone
                    calls, answering questions and reviewing and sending correspondence') }}
                </p>
            </div>
        </div><br>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">12.</p>
                <p> {{ __('Respond to and defend objections to claim(s) of exemption arising from attorney error(s) in
                    Schedule C.') }}
                </p>
            </div>
        </div>

    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            II. <br>
            {{ __('Services Included as Part of Chapter 7 Representation,') }} <br>
            {{ __('Subject to an Additional Fee') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('The following are services, included as part of the representation of the debtor, for which the
            attorney may charge additional fees:') }}
        </p>
    </div>

    <div class="row mt-10">
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">1.</p>
                <p> {{ __('Representation at any continued meeting of creditors due to client’s failure to appear or
                    failure to provide required documents or acceptable identification;') }}
                </p>
        </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">2.</p>
                <p> {{ __('Amendments, except that no fee shall be charged for any amendment to Schedule C that
                    may be required as a result of attorney error') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">3.</p>
                <p> {{ __('Opposing Motions for Relief from Stay;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">4.</p>
                <p> {{ __('Reaffirmation Agreements and hearings on Reaffirmation Agreements;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">5.</p>
                <p> {{ __('Redemption Motions and hearings on Redemption Motions;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">6.</p>
                <p> {{ __('Preparing, filing, or objecting to Proof of Claims, when appropriate, and if applicable;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">7.</p>
                <p> {{ __('Representation in a Motion to Dismiss or Convert debtor’s case;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">8.</p>
                <p> {{ __('Motions to Reinstate or Extend the Automatic Stay;') }} 
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">9.</p>
                <p> {{ __('Negotiations with Chapter 7 Trustee in aid of resolving nonexempt asset, turnover or
                    asset administration issues') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            III. <br>
            {{ __('Additional Services Not Included in the Initial Fee Which Will Require a') }}<br>
            {{ __('Separate Fee Agreement') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('The following services are not included as part of the representation in a Chapter 7 case, unless
            the attorney and debtor negotiate representation in these post-filing matters at mutually agreed
            upon terms in advance of any obligation of the attorney to render services. Unless a new fee
            agreement is negotiated between debtor and attorney, attorney will not be required to represent
            the debtor in these matters:') }}
        </p>
    </div>

    <div class="row mt-10">
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">1.</p>
                <p>  {{ __('Defense of Complaint to Determine Non-Dischargeability of a Debt or filing Complaint
                    to Determine Dischargeability of Debt;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">2.</p>
                <p> {{ __('Defense of a Complaint objecting to discharge;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">3.</p>
                <p> {{ __('Objections to Claim of Exemption, except where an objection arises due to an error on
                    Schedule C;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">4.</p>
                <p> {{ __('Sheriff levy releases;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">5.</p>
                <p> {{ __('Section 522(f) Lien Avoidance Motions;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">6.</p>
                <p> {{ __('Opposing a request for, or appearing at a 2004 examination;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">7.</p>
                <p> {{ __('All other Motions or Applications in the case, including to Buy, Sell, or Refinance Real
                    or other Property;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">8.</p>
                <p> {{ __('Motions or other proceedings to enforce the automatic stay or discharge injunction;') }} 
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">9.</p>
                <p> {{ __('Filing or responding to an appeal;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">10.</p>
                <p> {{ __('An audit of the debtor’s case conducted by a contract auditor pursuant to 28 U.S.C.
                    Section 586(f).') }} 
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            IV. <br>
            {{ __('Duties and Responsibilities of the Debtor') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('As the debtor filing for a Chapter 7 bankruptcy, you must:') }}
        </p>
    </div>

    <div class="row mt-10">
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">1.</p>
                <p> {{ __('Fully disclose everything you own, lease, or otherwise believe you have a right or interest
 in prior to filing the case;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">2.</p>
                <p> {{ __('List everyone to whom you owe money, including your friends, relatives or someone you
want to repay after the bankruptcy is filed;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">3.</p>
                <p> {{ __('Provide accurate and complete financial information;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">4.</p>
                <p> {{ __('Provide all requested information and documentation in a timely manner, in accordance
with the Chapter 7 Trustee Guidelines;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">5.</p>
                <p> {{ __('Cooperate and communicate with your attorney;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">6.</p>
                <p> {{ __('Discuss the objectives of the case with your attorney before you file;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">7.</p>
                <p> {{ __('Keep the attorney updated with any changes in contact information, including email
                    address;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">8.</p>
                <p> {{ __('Keep the attorney updated on any and all collection activities by any creditor, including
                    lawsuits, judgments, garnishments, levies and executions on debtor’s property;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">9.</p>
                <p> {{ __('Keep the attorney updated on any changes in the household income and expenses;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">10.</p>
                <p> {{ __('Timely file all statutorily required tax returns;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">11.</p>
                <p> {{ __('Inform the attorney if there are any pending lawsuits or rights to pursue any lawsuits;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">12.</p>
                <p> {{ __('Appear at the Section 341(a) Meeting of Creditors, and any continued Meeting of
                    Creditors;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">13.</p>
                <p> {{ __('Bring proof of social security number and government issued photo identification to the
                    Section 341(a) Meeting of Creditors;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">14.</p>
                <p> {{ __('Provide date-of-filing bank statements to the attorney no later than 7 days after filing of
                    your case;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">15.</p>
                <p> {{ __('Pay all required fees prior to the filing of the case;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">16.</p>
                <p> {{ __('Promptly pay all required fees in the event post filing fees are incurred;') }}
                </p>
            </div>
        </div>
        <div class="row col-md-12">            
            <div class="d-flex">
                <p style="width:20px;">17.</p>
                <p> {{ __('Debtor must not direct, compel or demand their attorney to take a legal position or
                    oppose a motion in violation of any Ethical Rule, any Rule of Professional Conduct, or
                    Federal Rule that is not well grounded in fact or law.') }}
                </p>
            </div>
        </div>

    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Text5'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control height_fit_content">
        </div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('Text6'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('Debtor') }}</label>
        </div>
    </div>
       
    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Text7'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control height_fit_content">
        </div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('Text8'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label>{{ __('Debtor') }}</label>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Text9'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control height_fit_content">
        </div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('Text10'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label>{{ __('Attorney for Debtor(s)') }}</label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
         
    </div>

</div>