<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">UNITED STATES BANKRUPTCY COURT<br>NORTHERN DISTRICT OF MISSISSIPPI</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper">
       <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor Information"
            debtorname={{$debtorname}} 
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case Number"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 border_1px bt-0">
        <div class="d-flex pt-3 pb-3">
            <div class="pr-2">
                <label class="text-bold"> TO: </label>
            </div>
            <div class="row w-100 text-bold">
                <div class="col-md-2">
                    <label>AFFECTED CREDITORS:</label>
                </div>
                <div class="col-md-10">
                    <textarea name="<?php echo base64_encode('Affected Creditors Information')?>" class="form-control" value="" rows="3"></textarea>
                </div>
                <div class="col-md-2">
                    <label>CASE TRUSTEE:</label>
                </div>
                <div class="col-md-10">
                    <textarea name="<?php echo base64_encode('Case Trustee Information')?>" class="form-control mt-1" value="" rows="3"></textarea>
                </div>
                <div class="col-md-12">
                    <label>U. S. TRUSTEE</label>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">NOTICE TO ADDED CREDITOR(S), TRUSTEE AND U.S. TRUSTEE</h3>
        <p class="mt-3">
            PLEASE TAKE NOTICE that an amendment to the bankruptcy <span class="text-bold"> matrix and/or schedules </span> add one or more additional
            creditors has been filed by the debtor(s), and said amendment lists the creditor(s) noticed hereby as an additional creditor
            in the above captioned bankruptcy case.
        </p>
        <p>
            Within <span class="text-bold"> 21 days </span>  the date of this notice, each added creditor has the right to request of the U. S. Trustee, 501 East Court
            Street, Suite 6-430, Jackson, Mississippi 39201, an adjourned §341(a) creditors’ meeting if the added creditor wishes to
            examine the debtor(s) under oath. (See copy of original §341 meeting notice attached.)
        </p>
        <p>
            Each added creditor has <span class="text-bold"> 60 days </span> from the date of this notice to file a complaint objecting to the discharge of the debtor(s),
            or a complaint to determine the dischargeability of a debt, or to file a motion requesting an extension of time to file such a
            complaint, unless a longer period of time is provided by the Federal Rules of Bankruptcy Procedure.
        </p>
        <p>
            If this is a <span class="text-bold"> Chapter 7, 12 or 13 </span> case and the attached §341 meeting notice contains a Proof of Claim deadline, as an added
            creditor you have <span class="text-bold"> 70 days </span> from the date of this notice to file a Proof of Claim. However, if this is a <span class="text-bold"> Chapter 7 </span> case and the
            notice contains language “Please Do Not File a Proof of Claim Unless You Receive a Notice To Do So”, then, you do not
            need to file a claim at this time.
        </p>
        <p>
            If this is a <span class="text-bold"> Chapter 11 </span> case, you have the right to file a proof of claim by the bar date indicated on the attached §341 meeting
            notice or <span class="text-bold"> 30 days </span> from the date of this notice, whichever is later.
        </p>
        <p>
            PLEASE TAKE NOTICE ALSO that the undersigned debtor(s) or attorney for debtor(s) is required to send a copy of the
            amended matrix and/or schedule(s) to each added creditor.
        </p>
    </div>
    <div class="col-md-6 mt-2"></div>
    <div class="col-md-6 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="DEBTOR(S) OR ATTORNEY FOR DEBTOR(S)"
            inputFieldName=""
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-bold text-center mb-3">CERTIFICATE OF SERVICE</h3>
        <p>
            The undersigned Debtor(s) or Attorney for Debtor(s), do hereby certify that I have this date mailed a true and correct copy
            of the above Notice to Added Creditor(s), a copy of the §341 Meeting of Creditors Notice, and Amended Matrix and/or
            Amended Schedule(s) to the affected creditor(s) at the address listed above. The case trustee (if applicable) and U. S.
            Trustee were mailed true and correct copies (or served by NEF via the CM/ECF system).
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor(s) or Attorney for Debtor(s)"
            inputFieldName=""
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <textarea name="<?php echo base64_encode('TextBottom')?>" class="form-control mt-1" value="" rows="4"></textarea>
        </div>
    </div>
</div>