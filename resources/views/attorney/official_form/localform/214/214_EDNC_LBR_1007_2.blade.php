<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">UNITED STATES BANKRUPTCY COURT <br>
        EASTERN DISTRICT OF NORTH CAROLINA<br>
            <select class="form-control w-auto text-bold" name="<?php echo base64_encode('form1[0].#subform[0].Division[0]')?>">
                <option value=""></option>
                <option value="Fayetteville">Fayetteville</option>
                <option value="Greenville">Greenville</option>
                <option value="New Bern">New Bern</option>
                <option value="Raleigh">Raleigh</option>
                <option value="Wilmington">Wilmington</option>
                <option value="Wilson">Wilson</option>
            </select> Division
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 t-upper">
        <x-officialForm.inReDebtorCustom
            debtorNameField="form1[0].#subform[0].RE[0]"
            debtorname={{$debtorname}}
            rows="3">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="form1[0].#subform[0].CaseNo[0]"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center">CERTIFICATION OF MAILING MATRIX <br> REQUIRED BY E.D.N.C. LBR 1007-2</h3>
        <p class="mt-3">
            I hereby certify under penalty of perjury that the attached list of creditors which has been prepared in the format required by
            the clerk is true and accurate to the best of my knowledge and includes all creditors scheduled in the petition.
        </p> 
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="form1[0].#subform[0].Dated[0]"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor or Attorney for Debtor"
            inputFieldName=""
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>
