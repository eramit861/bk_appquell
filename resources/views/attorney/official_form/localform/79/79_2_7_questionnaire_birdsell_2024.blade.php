<div class="row">
    <div class="col-md-6">
        <span class="text-bold">Complete Name(s):</span>
        <input class="form-control w-auto" value="{{$onlyDebtor}}" type="text" name="<?php echo base64_encode('Text1'); ?>">
    </div>
    <div class="col-md-6">
        <span class="text-bold">Case Number:</span>
        <input class="form-control w-auto" value="{{$caseno}}" type="text" name="<?php echo base64_encode('Text2'); ?>">
    </div>
</div>
<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text3'); ?>">


<div class="col-md-12 text-center text-bold my-3">DEBTOR QUESTIONNAIRE</div>

<p>Please answer each question below, sign and date the form, and return to your trustee by the date indicated in the letter.</p>
<div class="d-flex">
    <div class="underline text-bold col-md-9">ALL QUESTIONS ARE REQUIRED:</div>
    <div class="col-md-3 justify-content-between ml-5">
        <span class="underline text-bold mr-5">YES</span>
        <span class="underline text-bold ml-2">NO</span>
    </div>
</div>

<div class="d-flex">
    <p class="col-md-9">1. Do you understand and acknowledge the requirement to turn over your 2019 refunds and any other tax refunds if received after your filing date?</p>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box1'
            fieldNameNo='Check Box2'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>     
</div>

<?php
    $q2r1Checked = $debtorClientType == 2 ? true : false;
        $q2r2Checked = $debtorClientType == 2 ? false : true;
        ?>

<div class="d-flex">
    <div class="col-md-9">
        <p>2. Are you currently married and filing bankruptcy individually? <p>
        <p>If yes, have you included all of your community property in your bankruptcy schedules?</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box3'
            fieldNameNo='Check Box4'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q2r1Checked"
            :r2Checked="$q2r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box5'
            fieldNameNo='Check Box6'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>     
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>3. Have you been divorced in the past 2 years? If yes, Please send a copy of your divorce decree, insuring you include the property settlement documentation.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box7'
            fieldNameNo='Check Box8'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>
<?php
            $q4HasData = Helper::validate_key_value('list_lawsuits', $financialaffairs_info, 'radio');
        $q4Data = Helper::validate_key_value('list_lawsuits_data', $financialaffairs_info);
        $q4CaseNature = '';
        $q4CaseNo = '';
        $q4r1Checked = false;
        if ($q4HasData == 1) {
            $q4r1Checked = true;
        }
        $q4r2Checked = $q4HasData == 0 ? true : false;
        ?>
<div class="d-flex">
    <div class="col-md-9">
        <p>4. Do you have a claim or could you file a claim (lawsuit) for money, property or person injury? If so, Claim Description
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text4'); ?>">
        Amount <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text5'); ?>">
        </p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box9'
            fieldNameNo='Check Box10'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q4r1Checked"
            :r2Checked="$q4r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>
<?php
            $q5Data = Helper::validate_key_value('inheritances', $financial_assests);
        $q5HasData = Helper::validate_key_value('type_value', $q5Data, 'radio');
        $q5r1Checked = $q5HasData == 1 ? true : false;
        $q5r2Checked = $q5HasData == 0 ? true : false;
        ?>
<div class="d-flex">
    <div class="col-md-9">
        <p>5. Are you the beneficiary in any trusts or estates? If so, please provide the name of the trust and a written explanation of your benefit interest in the trust.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box11'
            fieldNameNo='Check Box12'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q5r1Checked"
            :r2Checked="$q5r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>6. In the last 4 years, did you ever have the right to a trust or inheritance that you refused to accept?</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box13'
            fieldNameNo='Check Box14'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>7. Should you become entitled to receive an inheritance at any time within the next 6 months, it is property of the bankruptcy estate, and you will have to notify the trustee. Do you understand?</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box15'
            fieldNameNo='Check Box16'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>
<?php
            $q8HasData = Helper::validate_key_value('list_any_gifts', $financialaffairs_info, 'radio');
        $q8CaseNature = '';
        $q8CaseNo = '';
        $q8r1Checked = $q8HasData == 1 ? true : false;
        $q8r2Checked = $q8HasData == 0 ? true : false;
        ?>
<div class="d-flex">
    <div class="col-md-9">
        <p>8. In the 24 months prior to filing, did you give any gifts, payments, loans or transfers to any friends, family members, or persons close to you? If so, attach a supplemental schedule of such payments and to whom the payments were made to.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box17'
            fieldNameNo='Check Box18'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q8r1Checked"
            :r2Checked="$q8r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<?php
            $q9r1Checked = false;
        $q9r2Checked = !empty($propertyvehicle) ? false : true;
        $firstVehicle = [];
        if (!empty($propertyvehicle)) {
            $q9r1Checked = true;
            $firstVehicle = reset($propertyvehicle) ?? [];
        }

        ?>
<div class="d-flex">
    <div class="col-md-9">
        <p>9. Have you financed a vehicle in the last 4 months? If so, list the vehicle year, make model and date financed.
            Year <input class="form-control w-auto" value="{{ Helper::validate_key_value('property_year', $firstVehicle) }}" type="text" name="<?php echo base64_encode('Text6'); ?>">
            Make <input class="form-control w-auto" value="{{ Helper::validate_key_value('property_make', $firstVehicle) }}" type="text" name="<?php echo base64_encode('Text7'); ?>">
            Model <input class="form-control w-auto" value="{{ Helper::validate_key_value('property_model', $firstVehicle) }}" type="text" name="<?php echo base64_encode('Text8'); ?>">
            Date <input class="date_filed form-control w-auto" value="" placeholder="MM/DD/YYYY" type="text" name="<?php echo base64_encode('Text9'); ?>"> 
        </p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box19'
            fieldNameNo='Check Box20'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q9r1Checked"
            :r2Checked="$q9r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>10. Have you contributed any money to a retirement plan in the past 6 months?</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box21'
            fieldNameNo='Check Box22'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>11. Have you purchased or made a down payment, or do you hold any season tickets for any future sporting events and/or concerts or plays? If so, list on seperate schedule.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box23'
            fieldNameNo='Check Box24'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>12. Have you purchased or made any deposits for future travel?</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box25'
            fieldNameNo='Check Box26'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex">
    <div class="col-md-9">
        <p>13. Do you have any rewards accounts? If so, list accounts and balances on seperate schedule.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box27'
            fieldNameNo='Check Box28'
            r1Value='Yes'
            r2Value='Yes'
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>
<?php
            $venmo_paypal_cash = Helper::validate_key_value('venmo_paypal_cash', $financial_assests);
        $brokerage_account = Helper::validate_key_value('brokerage_account', $financial_assests);
        $venmo_paypal_cash_has_data = Helper::validate_key_value('type_value', $venmo_paypal_cash, 'radio');
        $brokerage_account_has_data = Helper::validate_key_value('type_value', $brokerage_account, 'radio');
        $q14r1Checked = ($venmo_paypal_cash_has_data == 1 || $venmo_paypal_cash_has_data == 1) ? true : false;
        $q14r2Checked = ($venmo_paypal_cash_has_data == 0 && $venmo_paypal_cash_has_data == 0) ? true : false;
        ?>
<div class="d-flex">
    <div class="col-md-9">
        <p>14. Do you have any Paypal or Bit Coin/Crypto currency accounts? If so, provide statements for the last 6 months.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box29'
            fieldNameNo='Check Box30'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q14r1Checked"
            :r2Checked="$q14r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>
<?php
            $q15Data = Helper::validate_key_value('retirement_pension', $financial_assests);
        $q15HasData = Helper::validate_key_value('type_value', $q15Data, 'radio');
        $q15r1Checked = false;
        $q15r2Checked = false;
        if ($q15HasData == 1) {
            $type_of_account = Helper::validate_key_value('type_of_account', $q15Data);
            if (is_array($type_of_account)) {
                foreach ($type_of_account as $key => $value) {
                    if (in_array($value, ['3'])) {
                        $q15r1Checked = true;
                    }
                }
            }
            $q15r2Checked = $q15r1Checked ? false : true;
        }
        ?>
<div class="d-flex">
    <div class="col-md-9">
        <p>15. Do you have any IRA's? Explain if inherited or self-directed on additional paper.</p>
    </div>
    <div class="col-md-3">
        <x-officialForm.TrusteeFormCheckYesNo
            fieldNameYes='Check Box31'
            fieldNameNo='Check Box32'
            r1Value='Yes'
            r2Value='Yes'
            :r1Checked="$q15r1Checked"
            :r2Checked="$q15r2Checked"
            >
        </x-officialForm.TrusteeFormCheckYesNo>
    </div>
</div>

<div class="d-flex col-md-12 mt-3">
    <div class="col-md-4">Home Phone:<input class="form-control w-auto" value="{{$debtorPhoneHome}}" type="text" name="<?php echo base64_encode('Text10'); ?>"></div>
    <div class="col-md-4">Mobile Phone:<input class="form-control w-auto" value="{{$debtorPhoneCell}}" type="text" name="<?php echo base64_encode('Text11'); ?>"></div>
    <div class="col-md-4">Email:<input class="form-control w-auto" value="{{$debtor_email}}" type="text" name="<?php echo base64_encode('Text12'); ?>"></div>
</div>

<div class="ml-5">(if different from mobile)</div>

<div class="text-bold mt-3">I declare under penalty of perjury that the information I have provided in this questionnaire is accurate and true.</div>

<div class="d-flex">

    <div class="col-md-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor's Signature"
            inputFieldName="Text13"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-3 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text14"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>

    <div class="col-md-3 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor's Signature"
            inputFieldName="Text15"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-3 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Text16"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>

</div>

<div class="text-bold col-md-12 text-center mt-5">VEHICLE QUESTIONNAIRE</div>

<p class="col-md-12 text-center mt-2 text-c-red text-bold">(If more than three vehicles, include information on additional sheets)</p>

<?php
            $vehicleIndex = 0;
        ?>


<?php for ($i = 1; $i <= 3; $i++) {
    $property = !empty(Helper::validate_key_value($vehicleIndex, $propertyvehicle)) ? Helper::validate_key_value($vehicleIndex, $propertyvehicle) : [];
    ?>
    <div class="d-flex mt-3">
        <div class="text-bold mr-5">Vehicle <?php echo $i ?>:</div>
        <p>Transmission: Automatic or Manual (circle one)</p>
    </div>
    <div class="d-flex">
        <div class="d-flex align-items-center col-md-2">Make<input class="form-control w-auto" value="<?php echo Helper::validate_key_value('property_make', $property); ?>" type="text" name="<?php echo base64_encode('Text'.(17 + ($i - 1) * 7)); ?>"></div>
        <div class="d-flex align-items-center col-md-2">Model<input class="form-control w-auto" value="<?php echo Helper::validate_key_value('property_model', $property); ?>" type="text" name="<?php echo base64_encode('Text'.(18 + ($i - 1) * 7)); ?>"></div>
        <div class="d-flex align-items-center col-md-2">Year<input class="form-control w-auto" value="<?php echo Helper::validate_key_value('property_year', $property); ?>" type="text" name="<?php echo base64_encode('Text'.(19 + ($i - 1) * 7)); ?>"></div>
        <div class="d-flex align-items-center col-md-2">Miles<input class="form-control w-auto" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>" type="text" name="<?php echo base64_encode('Text'.(20 + ($i - 1) * 7)); ?>"></div>
        <div class="d-flex align-items-center col-md-3"># of Doors<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text'.(21 + ($i - 1) * 7)); ?>"></div>
    </div>

    <div class="d-flex mt-3">
        <div class="mr-4 ml-3">Circle applicable specifications:</div>
        <div class="mr-4">cruise control power seats</div>
        <div class="mr-4">air conditioning sun roof</div>
        <div class="mr-4">power windows/locks convertible</div>
        <div class="mr-4">stereo, cassette, cd leather seats</div>
        <div class="mr-4">tilt wheel abs brakes</div>
        <div class="mr-4">4x4 airbag</div>
    </div>

    <?php
        $loanamount = '';
    $vehicle_car_loan = Helper::validate_key_value('vehicle_car_loan', $property);
    $vehicle_car_loan = !empty($vehicle_car_loan) ? json_decode($vehicle_car_loan, true) : [];
    $loanamount = Helper::validate_key_value('amount_own', $vehicle_car_loan);
    ?>

    <div class="d-flex mt-3">
        <div class="col-md-6">Condition<input class="form-control col-md-10" value="" type="text" name="<?php echo base64_encode('Text'.(22 + ($i - 1) * 7)); ?>"></div>
        <div class="col-md-6">Lien amount $<input class="form-control w-auto" value="{{ $loanamount }}" type="text" name="<?php echo base64_encode('Text'.(23 + ($i - 1) * 7)); ?>">(current balance due) 
        <span class="text-bold">attach most recent statement</span></div>
    </div>
<?php $vehicleIndex++;
} ?>


<div class="text-bold col-md-12 text-center mt-5">LIFE INSURANCE POLICY QUESTIONNAIRE</div>

<p class="col-md-12 text-center mt-2 text-c-red text-bold">(If more than three policies, include information on additional sheets)</p>

<?php for ($i = 1; $i <= 3; $i++) { ?>
    <div class="d-flex mt-3">
        <div class="d-flex col-md-4">
            <div class="d-flex text-bold mt-2 mr-2">Policy # <?php echo $i ?>:</div>
            <div>Insurance Co.<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text'.(38 + ($i - 1) * 5)); ?>"></div>
        </div>
        <div class="d-flex col-md-4">
            <div class="d-flex align-items-center mr-2">Face amount Of Insurance Policy:</div>
            <div class="align-items-center">$<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text'.(39 + ($i - 1) * 5)); ?>"></div>
        </div>
        <div class="d-flex col-md-4 align-items-center">
            <div class="mr-1">Age of person Insured:</div>
            <div class="align-items-center"><input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text'.(40 + ($i - 1) * 5)); ?>"></div>
        </div>
    </div>
    <div class="d-flex mt-3">
        <div class="d-flex col-md-4 ">
            <div class="mr-4">Kind of Policy:</div>
            <div class="mr-4">Term</div>
            <div class="mr-4">cash value</div>
            <div class="mr-4">(circle)</div>
        </div>
        <div class="d-flex col-md-4">
            <div class="d-flex align-items-center mr-4">Cash surrender value of policy:</div>
            <div class="align-items-center">$<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text'.(41 + ($i - 1) * 5)); ?>"></div>
        </div>
        <div class="d-flex col-md-4">
            <div class="d-flex align-items-center mr-3">Loans Against CSV:</div>
            <div class="align-items-center">$<input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text'.(42 + ($i - 1) * 5)); ?>"></div>
        </div>
    </div>
<?php } ?>

<p class="mt-3 col-md-12">If your life insurance is through your employer, the trustee understands that you may not be able to provide a copy of a policy. Please note
any policy that is provided by through an employer. Please be prepared to provide the trustee with a copy of any insurance policies held by
you at the Trustee's request.</p>