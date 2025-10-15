<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('1099Attorney'); ?>" class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
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
                <textarea style="margin-right:40px" name="<?php echo base64_encode('1099Debtor'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
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
                    <input name="<?php echo base64_encode('1099CaseNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">
            {{ __('BALANCE OF SCHEDULES, STATEMENTS, AND/OR CHAPTER 13 PLAN') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ __('Presented are the original with the number of copies required by CSD 1800 Administrative Procedures of the following') }}
        </p>
        <p>
            {{ __('[Check one or more boxes as appropriate]:') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group d-flex ">
            <p>
                <input name="<?php echo base64_encode('1099ChBox1'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedules A/B - J') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox2'); ?>" value="Yes" type="checkbox"> 
                {{ __('Statement of Financial Affairs') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox3'); ?>" value="Yes" type="checkbox"> 
                {{ __('Summary of Schedules (Includes Statistical Summary of Certain Liabilities)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox4'); ?>" value="Yes" type="checkbox"> 
                {{ __('Summary of Your Assets and Liabilities and Certain Statistical Information Schedules') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox5'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 7 Statement of Current Monthly Income') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox6'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 7 Statement of Exemption from Presumption of Abuse Under § 707(b)(2)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox7'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 7 Means Test Calculation') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox8'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 11 Statement of Your Current Monthly Income') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox9'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 13 Statement of Your Current Monthly Income and Calculation of Commitment Period') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox10'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 13 Calculation of Your Disposable Income') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox11'); ?>" value="Yes" type="checkbox"> 
                {{ __('Chapter 13 Plan') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox12'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Real and/or Personal Property') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox13'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Property Claimed Exempt') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox14'); ?>" value="Yes" type="checkbox"> 
                {{ __('Creditors Holding Secured Claims by Property') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox15'); ?>" value="Yes" type="checkbox"> 
                {{ __('Creditors Holding Unsecured Priority and/or Non-priority Claims:') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox16'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Executory Contracts & Unexpired Leases') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox17'); ?>" value="Yes" type="checkbox"> 
                {{ __('Schedule of Co-Debtors') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox18'); ?>" value="Yes" type="checkbox"> 
                {{ __('Income of Individual Debtor(s)') }}
            </p>
        </div>  
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox19'); ?>" value="Yes" type="checkbox"> 
                {{ __('Expenses of Individual Debtor(s)') }}
            </p>
        </div>
        <div class="input-group d-flex">
            <p>
                <input name="<?php echo base64_encode('1099ChBox20'); ?>" value="Yes" type="checkbox"> 
                {{ __('Expenses for Separate Household of Debtor 2') }}
            </p>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <label>
            <strong>
                {{ __('If additional creditors are added at this time, the following are required:') }}
            </strong>
        </label>
    </div>

    <div class="row col-md-12 mt-3 d-flex">
        <div style="width:5%">
            <p>
                {{ __('1.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                If additional creditors are added at this time, the following are required:
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p>
                {{ __('2.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('Local Form CSD1101,') }} <i>{{ __('Notice to Creditors of This Debtor Added by Amendment or Balance of Schedules.') }}</i> {{ __('See instructions on reverse side.') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <div class="col-md-4">
                <label>{{ __('Dated:') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('1099Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            </div>
        </div>
        <div class="input-group d-flex col-md-6">
        <div class="col-md-4">
                <label>{{ __('Signed:') }}</label>
            </div>
            <div class="col-md-8">
                    <input name="<?php echo base64_encode('1099AttyDebt'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            {{ __('I[We]') }} 
            <input name="<?php echo base64_encode('1099Debtor1'); ?>" value="<?php echo $onlyDebtor;?>" type="text" style="width:20%" class="form-control">
            {{ __('and') }}
            <input name="<?php echo base64_encode('1099Debtor2'); ?>" value="<?php echo $spousename;?>" type="text" style="width:20%" class="form-control">
            , {{ __('the debtor(s), hereby declare under penalty of perjury that the information set forth 
            in the balance of schedules and/or chapter 13 plan attached here to, consisting of') }}
            <input name="<?php echo base64_encode('1099Pages'); ?>" value="<?php echo $creditors_count;?>" type="text" style="width:10%" class="form-control">
            {{ __('pages, and on the creditor matrix, if any, is true and correct.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('1099Date2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
        <div class="input-group d-flex col-md-6">
            
            <div>
                
            </div>
        </div>
    </div>


    <div class="row col-md-12 mt-10">
        <div class="input-group mt-10 col-md-6 text-center">
            <input name="<?php echo base64_encode('Text9'); ?>" readonly value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label>{{ __('*Debtor') }}</label>
        </div>
        <div class="input-group mt-10 col-md-6 text-center">
            <input name="<?php echo base64_encode('Text10'); ?>" readonly value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
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
                {{ __('1.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('Local Form CSD 1101,') }} <i>{{ __('Notice to Creditors of The Above-Named Debtor Added by Amendment or Balance of
                Schedules') }}</i>{{ __(', may be used to notify any added entity. When applicable, copies of the following notices must accompany
                the notice: Order for and Notice of Section 341(a) Meeting, Discharge of Debtor, Notice of Order Confirming Plan,
                and Proof of Claim.') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p>
                {{ __('2.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('If not filed previously and this is an ECF case, the') }} <i>{{ __('Declaration Re: Electronic Filing of Petition, Schedules &
                Statements') }}</i> {{ __('(Local Form CSD 1801) must be filed in accordance with LBR 5005-4(c).') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <div style="width:5%">
            <p>
                {{ __('3.') }}
            </p>
        </div>
        <div style="width:95%">
            <p>
                {{ __('If this is a Chapter 11 case, each member of any committee appointed must be served this Balance of Schedules.') }}
            </p>
        </div>
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
                <input name="<?php echo base64_encode('1099Date3'); ?>" value="{{$currentDate}}" type="text" style="width:20%" class="form-control">
                {{ __(', I checked the CM/ECF docket for this bankruptcy case or adversary proceeding and determined that the following
                person(s) are on the Electronic Mail Notice List to receive NEF transmission at the e-mail address(es) indicated and/or as checked below:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <textarea style="margin-right:40px" name="<?php echo base64_encode('1099NEF'); ?>" value="" class="form-control" rows="5" cols="" style="padding-right:5px;"></textarea>
    </div>

    <div class="row col-md-12 d-flex mt-3">
        <div style="width:3%">
            <input name="<?php echo base64_encode('1099ChBox23'); ?>" value="3" type="checkbox">
        </div>
        <div style="width:30%">
            <p>
                {{ __('Chapter 7 Trustee:') }}
            </p>
        </div>
        <div style="width:65%">
            <textarea style="margin-right:40px" name="<?php echo base64_encode('1099Ch7Trustee'); ?>" value="" class="form-control" rows="1" cols="" style="padding-right:5px;"></textarea>
        </div>
    </div>

    <div class="row col-md-12 d-flex mt-3">
        <div class="d-flex " style="width:33%">
            <div>
                <input name="<?php echo base64_encode('1099ChBox22'); ?>" value="Yes" type="checkbox">
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
                <input name="<?php echo base64_encode('1099ChBox23'); ?>" value="1" type="checkbox">
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
                <input name="<?php echo base64_encode('1099ChBox23'); ?>" value="2" type="checkbox">
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
                <input name="<?php echo base64_encode('1099Date4'); ?>" value="{{$currentDate}}" type="text" style="width:20%" class="form-control">
                {{ __(', I served the following person(s) and/or entity(ies) at the last known address(es) 
                in this bankruptcy case or adversary proceeding by placing accurate copies in a sealed envelope in the United States 
                Mail via 1) first class, postage prepaid or 2) certified mail with receipt number, addressed as follows:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <textarea style="margin-right:40px" name="<?php echo base64_encode('1099USMail'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"></textarea>
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
                <input name="<?php echo base64_encode('1099Date5'); ?>" value="{{$currentDate}}" type="text" style="width:20%" class="form-control">
                {{ __(', I served the following person(s) 
                and/or entity(ies) by personal delivery, or (for those who consented in writing to such service method) by facsimile 
                transmission, by overnight delivery, and/or electronic mail as follows:') }}
            </p>
        </div>
    </div>

    <div class="row col-md-12 d-flex">
        <textarea style="margin-right:40px" name="<?php echo base64_encode('1099PersDel'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"></textarea>
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
                <input name="<?php echo base64_encode('1099Date6'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                <label>{{ __('(Date)') }}</label>
            </div>
        </div>
        <div class="input-group col-md-6">
            <div class="input-group">
                <input name="<?php echo base64_encode('1099Signature'); ?>" value="{{$attorney_name}}" type="text" class="form-control">
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
                <input name="<?php echo base64_encode('1099Address'); ?>" value="<?php echo $attonryAddress1.', '.$attonryAddress2;?>" type="text" class="form-control">
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
                <input name="<?php echo base64_encode('1099City'); ?>" value="<?php echo $attorney_city.', '.$attorney_state.', '.$attorney_zip;?>" type="text" class="form-control">
                <label>{{ __('(City, State, ZIP Code)') }}</label>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
         
    </div>

</div>