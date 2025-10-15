<div class="row">
    <div class="col-md-12 mb-3 text-center">
        <h3 class="">UNITED STATES BANKRUPTCY COURT<br>NORTHERN DISTRICT OF MISSISSIPPII</h3>
        <h3 class="mt-3">CONFIDENTIAL<br>NOTICE TO CREDITORS REGARDING CORRECTED<br>SOCIAL SECURITY NUMBER IN BANKRUPTCY CASE</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="row">
            <div class="col-md-5 pt-2">
                    <label>Debtor:</label>
            </div>
            <div class="col-md-7">
                <x-officialForm.inputText name="Debtor" class="" value="{{$onlyDebtor}}"></x-officialForm.inputText>
            </div>
            <div class="col-md-5 pt-2 mt-2">
                <label>Case No.</label>
            </div>
            <div class="col-md-7 mt-2">
                <x-officialForm.inputText name="Case Number" class="" value="{{$caseno}}"></x-officialForm.inputText>
            </div>
            <div class="col-md-5 pt-2 mt-2">
                <label>Incorrect Social Security No.:</label>
            </div>
            <div class="col-md-7 mt-2">
                <x-officialForm.inputText name="Incorrect Social Security No" class="" value=""></x-officialForm.inputText>
            </div>
    
            <div class="col-md-5 pt-2 mt-2">
                <label>Correct Social Security No.:</label>
            </div>
            <div class="col-md-7 mt-2">
                <x-officialForm.inputText name="Correct Social Security No" class="" value="{{$ssn1}}"></x-officialForm.inputText>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="row">
            <div class="col-md-5 pt-2">
                <label>Joint Debtor
            </div>
            <div class="col-md-7">
                <x-officialForm.inputText name="Joint Debtor" class="" value="{{$spousename}}"></x-officialForm.inputText>
            </div>
            <div class="col-md-5 pt-2 mt-2">
                <label>Case No.</label>
            </div>
            <div class="col-md-7 mt-2">
                <x-officialForm.inputText name="Case Number_2" class="" value="{{$caseno}}"></x-officialForm.inputText>
            </div>
       
            <div class="col-md-5 pt-2 mt-2">
                <label>Incorrect Social Security No.:</label>
            </div>
            <div class="col-md-7 mt-2">
                <x-officialForm.inputText name="Incorrect Social Security No_2" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-5 pt-2 mt-2">
                <label>Correct Social Security No.:</label>
            </div>
            <div class="col-md-7 mt-2">
                <x-officialForm.inputText name="Correct Social Security No_2" class="" value="{{$ssn2}}"></x-officialForm.inputText>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">VERIFICATION OF MATRIX</h3>
        <p class="mt-3 mb-3">
           To: All Creditors and other interested parties, U.S. Trustee, case trustee.
        </p>
        <p class="p_justify">
           Either no Social Security Number or an incorrect Social Security Number was provided to the U.S. Bankruptcy Court when this case was filed.
           In either event, the correct Social Security Number is shown above, and we are providing the Clerk of the U.S. Bankruptcy Court, under oath,
           Official Form B 121, showing such correct Social Security Number, as required by the Federal Privacy Act.
        </p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor’s Attorney or Pro Se Debtor"
            inputFieldName="Text28"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Joint Debtor’s Attorney or Pro Se Joint Debtor"
            inputFieldName="Text29"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date_2"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>
</div>
