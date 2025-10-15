<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('1100Attorney'); ?>"  class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
            </div>
            <div class="col-md-6 mt-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center" style="border-top:3px solid #000;">
                <label><strong>{{ __('UNITED STATES BANKRUPTCY COURT') }}</strong></label><br>
                <label>{{ __('SOUTHERN DISTRICT OF CALIFORNIA') }}</label><br>
                <label>{{ __('325 West F Street, San Diego, California 92101-6991') }}</label>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="border-top:3px solid #000; border-bottom:3px solid #000;">
                <label>{{ __('In Re') }}</label>
                <textarea style="margin-right:40px" name="<?php echo base64_encode('1100Debtor'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                <div class="row">
                    <div class="col-md-8">
                        <label></label>
                    </div>
                    <div class="col-md-4">
                        <label>{{ __('Debtor.') }}</label>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                    <label>{{ __('BANKRUPTCY NO.') }}</label>
                    <input name="<?php echo base64_encode('1100CaseNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('AMENDMENT') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Presented are the original and one conformed copy of the following [Check one or more boxes as appropriate]:') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group d-flex ">
            <p>
                <input name="<?php echo base64_encode('1100ChBox24'); ?>" value="Yes" type="checkbox"> 
                {{ __('Voluntary Petition') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox2'); ?>" value="Yes" type="checkbox"> 
                {{ __('Attachment to Chapter 11 Voluntary Petition for Non-Individuals') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox3'); ?>" value="Yes" type="checkbox"> 
                {{ __('Exhibit C: Attachment to Voluntary Petition B 1') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox4'); ?>" value="Yes" type="checkbox"> 
                {{ __('Summary of Schedules (Includes Statistical Summary of Certain Liabilities)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox5'); ?>" value="Yes" type="checkbox"> 
                {{ __('Summary of Your Assets and Liabilities and Certain Statistical Information') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox6'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Real and/or Personal Property') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox7'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Property Claimed Exempt for Individuals') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <input name="<?php echo base64_encode('1100ChBox8'); ?>" value="Yes" type="checkbox"> 
            <p>
                {{ __('Creditors Holding Claims Secured by Property, Creditors Who Have Unsecured Priority and/or Non-priority Claims, 
                and/or Matrix, and/or list of Creditors or Equity Holders - REQUIRES COMPLIANCE WITH LOCAL RULE 1009') }}
            </p>
        </div>

        <div class="input-group d-flex">
            <div class="input-group col-md-2"></div>
            <div class="input-group col-md-10 d-flex">
                <input name="<?php echo base64_encode('1100ChBox9'); ?>" value="Yes" type="checkbox"> 
                <p>
                    {{ __('Adding or deleting creditors (electronic media), changing amounts owed or classification of debt - $32.00
                    fee required. See instructions on reverse side.') }}
                </p>
            </div>
        </div>

        <div class="input-group d-flex">
            <div class="input-group col-md-2"></div>
            <div class="input-group col-md-10 d-flex">
                <p>
                    <input name="<?php echo base64_encode('1100ChBox10'); ?>" value="Yes" type="checkbox"> 
                    {{ __('Correcting or deleting other information. See instructions on reverse side.') }} 
                </p>
            </div>
        </div>

        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox11'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Executory Contracts & Expired Leases') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox12'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Co-Debtor') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox13'); ?>" value="Yes" type="checkbox"> 
                {{ __('Income of Individual Debtor(s)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox14'); ?>" value="Yes" type="checkbox"> 
                {{ __('Expenses of Individual Debtor(s)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox15'); ?>" value="Yes" type="checkbox"> 
                {{ __('Expenses for Separate Household of Debtor 2') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox16'); ?>" value="Yes" type="checkbox"> 
                {{ __('Statement of Financial Affairs') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox17'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 7 Statement of Your Current Monthly Income') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox1'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 7 Statement of Exemption from Presumption of Abuse Under § 707(b)(2)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox19'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 7 Means Test Calculation') }}
            </p>
        </div>  
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox20'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 11 Statement of Your Current Monthly Income') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox21'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 13 Statement of Current Monthly Income and Calculation of Commitment Period:') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1100ChBox22'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 13 Calculation of Your Disposable Income') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <input name="<?php echo base64_encode('1100ChBox23'); ?>" value="Yes" type="checkbox"> 
            <p>
                {{ __('Other:') }} 
            </p>
            <input name="<?php echo base64_encode('1100Other'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Dated:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1100Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('Signed:') }}</label>
            </div>
            <div class="col-md-8">
                    <input name="<?php echo base64_encode('1100AttyDebt'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ __('I[We]') }} 
            <input name="<?php echo base64_encode('1100Debtor1'); ?>" value="<?php echo $onlyDebtor;?>" type="text" style="width:20%" class="form-control">
            {{ __('and') }}
            <input name="<?php echo base64_encode('1100Debtor2'); ?>" value="<?php echo $spousename;?>" type="text" style="width:20%" class="form-control">
            , {{ __('the debtor(s), hereby declare under penalty of perjury that the information set forth in the amendment attached hereto, consisting of') }}
            <input name="<?php echo base64_encode('1100Pages'); ?>" value="<?php echo $creditors_count;?>" type="text" style="width:10%" class="form-control">
            {{ __('pages, and on the creditor matrix electronic media, if any, is true and correct to the best of my [our] information and belief.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-4 mt-2">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('1100Date2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control ml-3 height_fit_content">
        </div>
        <div class="input-group mt-10 col-md-4 text-center">
            <input name="<?php echo base64_encode('Text11'); ?>" readonly value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('*Debtor') }}</label>
        </div>
        <div class="input-group mt-10 col-md-4 text-center">
            <input name="<?php echo base64_encode('Text12'); ?>" readonly value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label>{{ __('*Joint Debtor') }}</label>
        </div>
    </div>

    
    <div class="row col-md-12 mt-10">
        <div class="input-group mt-10 col-md-12 text-center">
            <p>* {{ __('If filed electronically, pursuant to LBR 5005-4(C), the original debtor signature(s) in a scanned format is required.') }}</p>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('INSTRUCTIONS') }}
        </h3>
    </div>

    <div class="row col-md-12 mt-3 d-flex">
        <div style="width:5%">
            <p>
                {{ __('A.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('Each amended page is to be in the same form as the original but is to contain') }} <strong>{{ __('only the information to be
                changed or added') }}</strong>{{ __('. Pages from the original document which are not affected by the change are not to be
                attached.') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p></p>
        </div>
        <div style="width:5%">
            <p>
                {{ __('1.') }}
            </p>
        </div>
        <div style="width:90%">
            <p>
                {{ __('Before each entry, specify the purpose of the amendment by inserting:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:10%">
            <p></p>
        </div>
        <div style="width:5%">
            <p>
                {{ __('a.') }}
            </p>
        </div>
        <div style="width:85%">
            <p>
                {{ __('"ADDED," if the information was missing from the previous document filed; or') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:10%">
            <p></p>
        </div>
        <div style="width:5%">
            <p>
                {{ __('b.') }}
            </p>
        </div>
        <div style="width:85%">
            <p>
                {{ __('"CORRECTED," if the information modifies previously listed information; or') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:10%">
            <p></p>
        </div>
        <div style="width:5%">
            <p>
                {{ __('c.') }}
            </p>
        </div>
        <div style="width:85%">
            <p>
                {{ __('"DELETED," if previously listed information is to be removed.') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p></p>
        </div>
        <div style="width:5%">
            <p>
                {{ __('2.') }}
            </p>
        </div>
        <div style="width:90%">
            <p>
                {{ __('At the bottom of each page, insert the word "AMENDED."') }}
            </p>
        </div>
    </div>
    
    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p></p>
        </div>
        <div style="width:5%">
            <p>
                {{ __('3.') }}
            </p>
        </div>
        <div style="width:90%">
            <p>
                {{ __("Attach all pages to the cover page and,") }} <i>{{ __('if a Chapter 7, 11, or 12 case') }}</i>{{ __(", serve a copy on the United States
                Trustee, trustee (if any) and/or the members of a creditors' committee.") }} <i>{{ __('If a Chapter 13 case') }}</i>, serve a copy on
                the trustee; <u style="border-bottom: 1px solid #000;">{{ __('DO NOT') }}</u> {{ __('serve a copy on the United States Trustee.') }}
            </p>
        </div>
    </div>


    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p>
                {{ __('B.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('Comply with Local Bankruptcy Rule 1009 when adding or correcting the names and/or addresses of creditors
                (electronic media required when Amendment submitted on paper) or if altering the status or amount of a claim.') }}
            </p>
        </div>
    </div>

    <div class="col-md-12 mt-3" style="border-bottom:3px solid #000; padding-bottom:10px;">
        <h3 class="text-center">
            {{ __('Amendments that fail to follow these instructions may be refused.') }}
        </h3>
        <h3 class="text-center">
            **Amendments filed <u>{{ __('after') }}</u> the case is closed are not entitled to a refund of fees**
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('PROOF OF SERVICE') }}
        </h3>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p></p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('I, whose address appears below, certify:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p></p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('That I am, and at all relevant times was, more than 18 years of age;') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p></p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('I served a true copy of this') }} <strong>{{ __('Balance of Schedules and/or Chapter 13 Plan') }}</strong> {{ __('on the following persons listed below 
                by the mode of service shown below:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p>1.</p>
        </div>
        <div style="width:95%">
            <p>
            <strong>{{ __('To Be Served by the Court via Notice of Electronic Filing (“NEF”)') }}</strong>:
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ __('Under controlling Local Bankruptcy Rules(s) (“LBR”), the document(s) listed above will be served by the court
                via NEF and hyperlink to the document. On') }}
                <input name="<?php echo base64_encode('1100Date3'); ?>" value="{{$currentDate}}" type="text" style="width:20%" class="form-control">
                {{ __(', I checked the CM/ECF docket for this
                bankruptcy case or adversary proceeding and determined that the following person(s) are on the Electronic Mail Notice 
                List to receive NEF transmission at the e-mail address(es) indicated and/or as checked below:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <textarea style="margin-right:40px" name="<?php echo base64_encode('1100ECF'); ?>" value="" class="form-control" rows="5" cols="" style="padding-right:5px;"></textarea>
    </div>

    <div class="row col-md-12 d-flex mt-3">
        <div style="width:3%">
            <input name="<?php echo base64_encode('1100ChBox25'); ?>" value="Yes" type="checkbox">
        </div>
        <div style="width:30%">
            <p>
                {{ __('Chapter 7 Trustee:') }}
            </p>
        </div>
        <div style="width:65%">
            <textarea style="margin-right:40px" name="<?php echo base64_encode('1100Ch7Tr'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </div>
    </div>

    <div class="row col-md-12 d-flex mt-3">
        <div class="d-flex " style="width:33%">
            <div>
                <input name="<?php echo base64_encode('1100ChBox26'); ?>" value="Yes" type="checkbox">
            </div>
            <div>
                <p>
                    {{ __('For Chpt. 7, 11, & 12 cases:') }}<br><br>
                    UNITED STATES TRUSTEE<br>
                    ustp.region15@usdoj.gov
                </p>
            </div>
        </div>
        <div class="d-flex " style="width:33%">
            <div>
                <input name="<?php echo base64_encode('1100ChBox27'); ?>" value="1" type="checkbox">
            </div>
            <div>
                <p>
                    {{ __('For ODD numbered Chapter 13 cases:') }}<br><br>
                    THOMAS H. BILLINGSLEA, JR., TRUSTEE<br>
                    Billingslea@thb.coxatwork.com
                </p>
            </div>
        </div>
        <div class="d-flex " style="width:33%">
            <div>
                <input name="<?php echo base64_encode('1100ChBox27'); ?>" value="2" type="checkbox">
            </div>
            <div>
                <p>
                    {{ __('For EVEN numbered Chapter 13 cases:') }}<br><br>
                    DAVID L. SKELTON, TRUSTEE<br>
                    admin@ch13.sdcoxmail.com<br>
                    dskelton13@ecf.epiqsystems.com
                </p>
            </div>
        </div>
    </div>
    
    <div class="row col-md-12 d-flex mt-3">
        <div style="width:5%">
            <p>2.</p>
        </div>
        <div style="width:95%">
            <p>
            <strong>{{ __('Served by United States Mail:') }}</strong>:
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                On
                <input name="<?php echo base64_encode('1100Date4'); ?>" value="{{$currentDate}}" type="text" style="width:20%" class="form-control">
                {{ __(', I served the following person(s) and/or entity(ies) at the last known address(es) 
                in this bankruptcy case or adversary proceeding by placing accurate copies in a sealed envelope in the United States 
                Mail via 1) first class, postage prepaid or 2) certified mail with receipt number, addressed as follows:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <textarea style="margin-right:40px" name="<?php echo base64_encode('1100USMail'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"></textarea>
    </div>

    <div class="row col-md-12 d-flex mt-3">
        <div style="width:5%">
            <p>3.</p>
        </div>
        <div style="width:95%">
            <p>
            <strong>{{ __('Served by Personal Delivery, Facsimile Transmission, Overnight Delivery, or Electronic Mail:') }}</strong>:
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div>
            <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ __('Under Fed.R.Civ.P.5 and controlling LBR, on') }}
                <input name="<?php echo base64_encode('1100Date5'); ?>" value="{{$currentDate}}" type="text" style="width:20%" class="form-control">
                {{ __(', I served the following person(s) and/or entity(ies) by personal delivery, or (for those who consented in writing to such service method) by facsimile transmission, by overnight delivery, and/or electronic mail as follows:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <textarea style="margin-right:40px" name="<?php echo base64_encode('1100Personal'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"></textarea>
    </div>

    <div class="row col-md-12 d-flex">
        <div>
            <p>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                {{ __('I declare under penalty of perjury under the laws of the United States of America that the statements made in this proof of service are true and correct.') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Executed on') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1100Date6'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                <label>{{ __('(Date)') }}</label>
            </div>
        </div>
        <div class="input-group col-md-6">
            <div class="input-group">
                <input name="<?php echo base64_encode('1100Signature'); ?>" value="{{$attorney_name}}" type="text" class="form-control">
                <label>{{ __('(Typed Name and Signature)') }}</label>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label></label>
            </div>
            <div class="col-md-8">
                <label></label>
            </div>
        </div>
        <div class="input-group col-md-6">
            <div class="input-group">
                <input name="<?php echo base64_encode('1100Address'); ?>" value="<?php echo $attonryAddress1.', '.$attonryAddress2;?>" type="text" class="form-control">
                <label>{{ __('(Address)') }}</label>
            </div>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label></label>
            </div>
            <div class="col-md-8">
                <label></label>
            </div>
        </div>
        <div class="input-group col-md-6">
            <div class="input-group">
                <input name="<?php echo base64_encode('1100City'); ?>" value="<?php echo $attorney_city.', '.$attorney_state.', '.$attorney_zip;?>" type="text" class="form-control">
                <label>{{ __('(City, State, ZIP Code)') }}</label>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
         
    </div>

</div>