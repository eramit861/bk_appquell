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
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="form1[0].#subform[0].txtDebtors[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
        <p class="mt-1 mb-0">Re: CORRECTION OF SOCIAL SECURITY NUMBER NOTICE</p>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="form1[0].#subform[0].txtCaseno[0]"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="form1[0].#subform[0].TextField2[0]"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center">NOTICE OF CORRECTION OF DEBTOR SOCIAL SECURITY NUMBER</h3>
        <span class="mt-3 mb-1">TO:</span> 
        <div class="row mb-3">
            <div class="col-md-4">
                <span>Experian</span>
            </div>
            <div class="col-md-4">
                <span class="">Trans Union Corporation <span>
            </div>
            <div class="col-md-4">
                <span> Credit Information Services, Inc.</span>
            </div>
            <div class="col-md-2 mt-2 pt-2">
                <label>FROM:</label>
            </div>
            <div class="col-md-10 mt-2">
                <x-officialForm.inputText name="form1[0].#subform[0].txtFrom[0]" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2 mt-1 pt-2">
                <label>Date:</label>
            </div>
            <div class="col-md-10 mt-1">
                <x-officialForm.inputText name="form1[0].#subform[0].DateTimeField2[0]" class="w-auto date_filed" value="" extra='placeholder="MM/DD/YYYY"'></x-officialForm.inputText>
            </div>
        </div>
        <p>
            The Debtor originally filed the bankruptcy petition using the following incorrect social security number 
            <x-officialForm.inputText name="form1[0].#subform[0].Table1[0].Row2[0].Cell2[0]" class="w-auto" value=""></x-officialForm.inputText> .
            This social security number was not assigned to the Debtor and was inadvertently listed on the bankruptcy petition for
            <x-officialForm.inputText name="form1[0].#subform[0].Table2[0].Row1[0].Cell2[0]" class="width_40percent mt-1" value=""></x-officialForm.inputText>.
        </p>
        <p>
            Please correct your records to indicate that the individual whose social security number is
            <x-officialForm.inputText name="form1[0].#subform[0].Table3[0].Row3[0].Cell1[0]" class="w-auto" value=""></x-officialForm.inputText>
            has not filed bankruptcy in the Eastern District of North Carolina in reference to
            the above related bankruptcy.
        </p>
    </div> 
    <div class="col-md-2 mt-3 text-center">
        <x-officialForm.dateSingle
                labelText="Date :"
                dateNameField="form1[0].#subform[0].DateTimeField1[0]"
                currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor(s)/Debtor(s) Attorney"
            inputFieldName="form1[0].#subform[0].TimeField1[0]"
            inputValue="{{$debtor_sign}}, {{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>
