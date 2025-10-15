    <div class="col-md-6">
        <span class="text-bold">PRINT NAME:</span>
        <input class="form-control w-auto" value="{{$onlyDebtor}}" type="text" name="<?php echo base64_encode('Text1'); ?>">
    </div>

    <div class="col-md-12 text-center text-bold my-3">DEBTOR QUESTIONNAIRE</div>

    <p class="col-md-12">Please answer each question below, sign and date the form, insert your case number and retun to your tustee by the date indicated on the instruction letter.</p>

    <div class="d-flex">
        <p class="col-md-9">1. Do you understand and acknowledge the requirement to turn over your 2018, 2019 & 2020 (and all preceding years) tax refunds which you receive after you filed bankruptcy?</p>
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
            <p>2. Are you presently married and filing bankruptcy individually?
            <p>
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
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>3. Have you been divorced in the past 2 years? If yes. please send a copy of your divorce decree including the property settlement documentation.</p>
        </div>
        <div class="col-md-3">
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
            <p>4. Have you been a plaintiff in any personal injury litigation in the past 3 years?</p>
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

    <div class="d-flex">
        <div class="col-md-9">
            <p>5. Do you have any pending personal injury or class action claim? If so, state whether litigation has begun? Who is your lawyer</p>
            <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text2'); ?>">
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box9'
                fieldNameNo='Check Box10'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>
    <?php
            $q6Data = Helper::validate_key_value('inheritances', $financial_assests);
        $q6HasData = Helper::validate_key_value('type_value', $q6Data, 'radio');
        $q6r1Checked = $q6HasData == 1 ? true : false;
        $q6r2Checked = $q6HasData == 0 ? true : false;
        ?>
    <div class="d-flex">
        <div class="col-md-9">
            <p>6. Are you the beneficiary of any estates trusts?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box11'
                fieldNameNo='Check Box12'
                r1Value='Yes'
                r2Value='Yes'
                :r1Checked="$q6r1Checked"
                :r2Checked="$q6r2Checked"
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>7. Have you ever filed a Bankruptcy using a different Social Security Number?</p>
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
            <p>8. Have you transferred any property to a trust or similar device in the last ten years?</p>
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

    <div class="d-flex">
        <div class="col-md-9">
            <p>9. Have you transferred any money to an attorney trust account during the past 12 months?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box17'
                fieldNameNo='Check Box18'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>10. Are you due any funds from any partnership, limited liabiity companies, corporations or from any investments?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box19'
                fieldNameNo='Check Box20'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>11. Have you been in a car accident in the last two years?</p>
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
            <p>12. Did you understand that you need to surrender to your bankruptcy trustee all monies received or expected to be received from a death or inheritance that occurs prior to your bankruptcy filing date OR 180 days AFTER your bankruptcy fling date?</p>
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
            <p>13. Have you contributed any money to a retirement plan in the past 4 months? If so, how much?</p>
            <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text3'); ?>">
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

    <?php
        $q14Data = Helper::validate_key_value('alimony_child_support', $financial_assests);
        $q14HasData = Helper::validate_key_value('type_value', $q14Data, 'radio');
        $q14r1Checked = false;
        $q14r2Checked = false;
        if ($q14HasData == 1) {
            $account_type = Helper::validate_key_value('account_type', $q14Data);
            if (is_array($account_type)) {
                foreach ($account_type as $key => $value) {
                    if (in_array($value, [ '1', '2', '3', '6', '7' ])) {
                        $q14r1Checked = true;
                    }
                }
            }
            $q14r2Checked = $q14r1Checked ? false : true;
        }
        ?>
    <div class="d-flex">
        <div class="col-md-9">
            <p>14. Do you owe child support, alimony or maintenance?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box27'
                fieldNameNo='Check Box28'
                r1Value='Yes'
                r2Value='Yes'
                :r1Checked="$q14r1Checked"
                :r2Checked="$q14r2Checked"
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>15. Is there any real estate in your name other than your residence? If yes, please send a copy of the deed (this includes timeshare Interests).</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box29'
                fieldNameNo='Check Box30'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>16. Have you sold or transferred title to any real property in the last year?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box31'
                fieldNameNo='Check Box32'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>17. Have you transferred any assets or paid back any loans to family members or friends during the past 24 months?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box33'
                fieldNameNo='Check Box34'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <div class="d-flex">
        <div class="col-md-9">
            <p>18. Have you engaged in any loan modification in the last three years? If so, state whether you still own the property.</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box35'
                fieldNameNo='Check Box36'
                r1Value='Yes'
                r2Value='Yes'
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>
    <?php
            $q19r1Checked = !empty($propertyvehicle) ? true : false;
        $q19r2Checked = !empty($propertyvehicle) ? false : true;
        ?>
    <div class="d-flex">
        <div class="col-md-9">
            <p>19. Have you purchased a vehicle in the last 6 months?</p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box37'
                fieldNameNo='Check Box38'
                r1Value='Yes'
                r2Value='Yes'
                :r1Checked="$q19r1Checked"
                :r2Checked="$q19r2Checked"
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>

    <?php

            $q20r1Checked = false;
        $filed_bankruptcy_case_last_8years = Helper::validate_key_value('filed_bankruptcy_case_last_8years', $BasicInfo_PartC, 'radio');
        $case_filed_state = '';
        $date_filed = '';
        if ($filed_bankruptcy_case_last_8years == 1) {
            $q20r1Checked = true;
            $case_filed_state = Helper::validate_key_value('case_filed_state', $BasicInfo_PartC);
            $case_filed_state = is_array($case_filed_state) ? reset($case_filed_state) : '';
            $date_filed = Helper::validate_key_value('date_filed', $BasicInfo_PartC);
            $date_filed = is_array($date_filed) ? reset($date_filed) : '';
        }
        $q20r2Checked = false;

        ?>
    <div class="d-flex">
        <div class="col-md-9">
            <p>20. Have you filed for bankruptcy in the past 8 years?</p>
            <p>If so, When?<input class="form-control w-auto" value="{{ $date_filed }}" type="text" name="<?php echo base64_encode('Text4'); ?>">
                Where? <input class="form-control w-auto" value="{{ $case_filed_state }}" type="text" name="<?php echo base64_encode('Text5'); ?>"></p>
        </div>
        <div class="col-md-3">
            <x-officialForm.TrusteeFormCheckYesNo
                fieldNameYes='Check Box39'
                fieldNameNo='Check Box40'
                r1Value='Yes'
                r2Value='Yes'
                :r1Checked="$q20r1Checked"
                :r2Checked="$q20r2Checked"
                >
            </x-officialForm.TrusteeFormCheckYesNo>
        </div>
    </div>


    <p>I declare under the penalty of perjury that the above information is true and to the best of my knowledge.</p>

    <div class="col-md-6 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Text6"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>

    <div class="d-flex">
        <div class="col-md-4 mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor's Signature"
                inputFieldName="Text7"
                inputValue={{$debtor_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>

        <div class="col-md-4 mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor's Signature"
                inputFieldName="Text8"
                inputValue={{$debtor2_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="d-flex col-md-12 mt-3">
        <div class="col-md-4">Case Number:<input class="form-control w-auto" value="{{$caseno}}" type="text" name="<?php echo base64_encode('Text9'); ?>"></div>
        <div class="col-md-4">Telephone number:<input class="form-control w-auto" value="{{$debtorPhoneHome}}" type="text" name="<?php echo base64_encode('Text10'); ?>"></div>
        <div class="col-md-4">Email Address:<input class="form-control w-auto" value="{{$debtor_email}}" type="text" name="<?php echo base64_encode('Text11'); ?>"></div>
    </div>

    <div class="text-bold col-md-12 text-center">PRINT CLEARLY</div>
    <div class="d-flex">
        <div class="text-bold col-md-4 text-center"></div>

        <div class="col-md-6">
            <div class="text-bold col-md-12">Mail to: Maureen Gaughan, Esq.</div>
            <div class="text-bold col-md-12 ml-5">Bankruptcy Trustee</div>
            <div class="text-bold col-md-12 ml-5">PO Box 6729</div>
            <div class="text-bold col-md-12 ml-5">Chandler, Arizona 85246</div>
        </div>
    </div>

    <div class="text-bold col-md-12 text-center mt-5">VEHICLE QUESTIONNAIRE</div>

    <div class="col-md-6">
        <span class="text-bold">PRINT NAME:</span>
        <input class="form-control w-auto" value="{{$onlyDebtor}}" type="text" name="<?php echo base64_encode('Text12'); ?>">
    </div>

    <div class="col-md-12 mt-2 d-flex align-items-center">
        <span class="text-bold">Number of vehicles:</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text13'); ?>">
        <span>(if more than 3, please put additional vehicle(s) on extra sheet of paper and attach to this questionnaire)</span>
    </div>
    <?php
            $vehicleIndex = 0;
        ?>
    <div class="d-flex">
        <?php for ($i = 1; $i <= 3; $i++) {
            $property = !empty(Helper::validate_key_value($vehicleIndex, $propertyvehicle)) ? Helper::validate_key_value($vehicleIndex, $propertyvehicle) : [];
            ?>
            <div class="col-md-4">
                <div>Vehicle # <?php echo $i ?></div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Date Purchased:<input class="form-control col-md-8 ml-4" value="" type="text" name="<?php echo base64_encode('Text' . (14 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div>Make<input class="form-control w-auto col-md-9" value="<?php echo Helper::validate_key_value('property_make', $property); ?>" type="text" name="<?php echo base64_encode('Text' . (15 + ($i - 1) * 16)); ?>"></div>
                    <div>Year<input class="form-control w-auto col-md-9" value="<?php echo Helper::validate_key_value('property_year', $property); ?>" type="text" name="<?php echo base64_encode('Text' . (16 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Model:<input class="form-control col-md-10 ml-3" value="<?php echo Helper::validate_key_value('property_model', $property); ?>" type="text" name="<?php echo base64_encode('Text' . (17 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Style:<input class="form-control col-md-10 ml-4" value="<?php echo Helper::validate_key_value('property_other_info', $property); ?>" type="text" name="<?php echo base64_encode('Text' . (18 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Miles:<input class="form-control col-md-10 ml-4" value="<?php echo Helper::validate_key_value('property_mileage', $property); ?>" type="text" name="<?php echo base64_encode('Text' . (19 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Color:<input class="form-control col-md-10 ml-4" value="" type="text" name="<?php echo base64_encode('Text' . (20 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">4/2 Doors:<input class="form-control col-md-9 ml-4" value="" type="text" name="<?php echo base64_encode('Text' . (21 + ($i - 1) * 16)); ?>"></div>
                </div>

                <div class="d-flex mt-5">
                    Trans: Automatic/Manual(circle one)
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Engine<input class="form-control col-md-9" value="" type="text" name="<?php echo base64_encode('Text' . (22 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Drive Train <input class="form-control col-md-8 ml-2" value="" type="text" name="<?php echo base64_encode('Text' . (23 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12">Condition<input class="form-control col-md-8 ml-3" value="" type="text" name="<?php echo base64_encode('Text' . (24 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2 col-md-12">(poor, good, fair, excellent)</div>

                <div class="d-flex mt-5">
                    Other Extras (Please circle)
                </div>
                <div class="d-flex mt-2">
                    <div>air conditioning</div>
                </div>
                <div class="d-flex mt-2">
                    <div>power windows/locks</div>
                </div>
                <div class="d-flex mt-2">
                    <div>stereo, cassette, cd </div>
                </div>
                <div class="d-flex mt-2">
                    <div>tilt wheel</div>
                </div>
                <div class="d-flex mt-2">
                    <div>cruise control</div>
                </div>
                <div class="d-flex mt-2">
                    <div>power seats</div>
                </div>
                <div class="d-flex mt-2">
                    <div>sun roof</div>
                </div>
                <div class="d-flex mt-2">
                    <div>convertible</div>
                </div>
                <div class="d-flex mt-2">
                    <div>leather seats</div>
                </div>
                <div class="d-flex mt-2">
                    <div>4x4</div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-md-12 pl-0">Bed length ( 6, 8 etc)<input class="form-control col-md-6 ml-3" value="" type="text" name="<?php echo base64_encode('Text' . (25 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div>Super Cab, Crew Cab, Double</div>
                </div>
                <div class="d-flex mt-2">
                    <div>Quad Cab, Extended Cab, Regular 1500; 2500; 3500, Diesel </div>
                </div>

                <div class="d-flex mt-5">
                    <div class="col-12">others<input class="form-control col-md-9" value="" type="text" name="<?php echo base64_encode('Text' . (26 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-12"><input class="form-control col-md-10" value="" type="text" name="<?php echo base64_encode('Text' . (27 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-12">Purchase amount $<input class="form-control ml-4 col-md-6" value="<?php echo Helper::validate_key_value('property_estimated_value', $property); ?>" type="text" name="<?php echo base64_encode('Text' . (28 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="d-flex mt-2">
                    <div class="col-12">current balance due $<input class="form-control ml-2 col-md-6" value="" type="text" name="<?php echo base64_encode('Text' . (29 + ($i - 1) * 16)); ?>"></div>
                </div>
                <div class="mt-2">(attach most recent statement)</div>
            </div>
        <?php $vehicleIndex++;
        } ?>
    </div>


    <div class="mt-5">
        <div class="text-center text-bold">MAUREEN GAUGHAN, ESQ.</div>
        <div class="text-center text-bold">BANKRUPTCY TRUSTEE</div>
        <div class="text-center">PO Box 6729</div>
        <div class="text-center">Chandler, Az. 85246</div>
        <div class="text-center">480-899-2036</div>
    </div>

    <div class="mt-5">
        <div class="text-center text-bold">AUTHORIZATION TO RELEASE FEDERAL INCOME TAX</div>
        <div class="text-center text-bold">REFUND TO BANKRUPTCY TRUSTEE</div>
    </div>

    <div class="col-md-6">
        <span class="text-bold">CASE NO:</span>
        <input class="form-control w-auto" value="{{$caseno}}" type="text" name="<?php echo base64_encode('Text62'); ?>">
    </div>

    <div class="col-md-6 mt-2">
        <span class="text-bold">CASE NAME:</span>
        <input class="form-control w-auto" value="" type="text" name="<?php echo base64_encode('Text63'); ?>">
    </div>

    <p>By my/our signature(s) below, I hereby authorize the Internal Revenue Service and State of Arizona to
        release and send my federal income tax refund check for the year 2018, 2019 and 2020 and all preceding
        years directly to Chapter 7 Trustee Maureen Gaughan at the address indicated above. I understand that tax
        refunds are property of the Bankruptcy Estate and must be surrendered to the Bankruptcy Trustee.</p>

    <p>I understand and hereby acknowledge that as soon as I receive my income tax refunds for 2018, 2019 and
        2020 and all preceding years, I am to turn them over to the Trustee. I understand and acknowledge that I
        may not deposit any refund or spend any refunds and must surrender the refunds directly to the Bankruptcy
        Trustee.</p>

    <p>By signing this document, I acknowledge that all tax refunds are assets of the bankruptcy estate. I
        understand that the refund for the year in which the bankruptcy case was filed, i.e. 2020, is also partially
        property of the Bankruptcy Estate. I understand that I must send the Bankruptcy Trustee a copy of my state
        and federal tax returns and ALL refunds as I receive them. Should it be warranted based upon the date of
        my bankruptcy petition was filed, I will receive a pro rata share of these refunds back from the Trustee.</p>

    <p>I understand that failure to comply with the Trustee's request for copies of tax returns and federal and state
        and surrender of tax refunds, could lead to a revocation of my bankruptcy discharge.</p>

    <div class="col-md-6 mt-2">
        <span class="text-bold">Dated</span>
        <input class="date_filed form-control w-auto" placeholder="MM/DD/YYYY" value="{{$currentDate}}" type="text" name="<?php echo base64_encode('Text64'); ?>">
    </div>

    <div class="col-md-12 d-flex">
        <div class="col-md-6">
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Debtor (sign)"
                    inputFieldName="Text65"
                    inputValue={{$debtor_sign}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Print name"
                    inputFieldName="Text66"
                    inputValue={{$onlyDebtor}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Social Security number"
                    inputFieldName="Text67"
                    inputValue={{$ssn1}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Street address"
                    inputFieldName="Text68"
                    inputValue="{{$debtoraddress}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="City, State, Zip Code"
                    inputFieldName="Text69"
                    inputValue="{{$debtorCity}},{{$debtorState}},{{$debtorzip}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>

        </div>
        <div class="col-md-6">
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Joint Debtor (sign)"
                    inputFieldName="Text70"
                    inputValue={{$debtor2_sign}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Print name"
                    inputFieldName="Text71"
                    inputValue={{$spousename}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Social Security number"
                    inputFieldName="Text72"
                    inputValue={{$ssn2}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Street address"
                    inputFieldName="Text73"
                    inputValue={{$spouseaddress}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="col-md-4 mt-2">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="City, State, Zip Code"
                    inputFieldName="Text74"
                    inputValue="{{$spouseCity}},{{$spouseState}},{{$spousezip}}">
                </x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
    </div>
