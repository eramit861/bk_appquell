<div class="row">

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.caseNo
            labelText="Case Number"
            casenoNameField="Case Number"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.debtorSignVertical
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVertical>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Co-Debtor"
                inputFieldName="CoDebtor"
                inputValue="{{$spousename}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney"
                inputFieldName="Attorney"
                inputValue="{{$attorney_name}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="underline">BANKRUPTCY QUESTIONNAIRE & DOCUMENT REQUEST</h3>
        <p class="underline">(TO BE COMPLETED BY EACH DEBTOR AND PROVIDED TO THE TRUSTEE ALONG WITH REQUIRED DOCUMENTS <br> ON OR BEFORE SEVEN DAYS PRIOR TO THE MEETING OF CREDITORS )</p>
    </div>

    <div class="mt-3 col-md-12">
        <h3 class="text-center underline">PART I – INTRODUCTION AND INSTRUCTIONS</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify">
            <span class="text-bold ">REQUIREMENTS OF THE BANKRUPTCY LAW:</span>
            THE BANKRUPTCY LAW HAS PLACED NUMEROUS REQUIREMENTS ON THE
            DEBTORS , THEIR ATTORNEY , AND THE BANKRUPTCY TRUSTEE . TO MEET THESE REQUIREMENTS, YOU MUST COMPLETE AND
            RETURN THIS BANKRUPTCY QUESTIONNAIRE TO YOUR TRUSTEE ON OR
            <span class="text-bold underline">BEFORE SEVEN (7) DAYS</span>
            PRIOR TO THE FIRST MEETING OF CREDITORS .
            <span class="underline"> YOU MUST ALSO ATTEND THE MEETING OF CREDITORS . FAILURE TO COMPLETE AND RETURN THIS QUESTIONNAIRE
            AND / OR ATTEND THE MEETING OF CREDITORS MAY RESULT IN THE DISMISSAL OF YOUR CASE .</span>
        </p>

        <p class="text-bold">THE NAME AND ADDRESS OF THE TRUSTEE IS SHOWN ON THE “NOTICE OF CHAPTER 7 BANKRUPTCY CASE , MEETING OF CREDITORS , & DEADLINES ” THAT YOU RECEIVED FROM THE COURT .</p>

        <p class="p_justify">
            <span class="text-bold">YOU HAVE A DUTY TO COOPERATE WITH TRUSTEE: </span>
                AS PART OF YOUR BANKRUPTCY, THE TRUSTEE MUST EXAMINE AND INVESTIGATE YOUR FINANCIAL AFFAIRS AND RELATED INFORMATION. 
            <span class="underline">
                UNDER THE LAW , IT IS YOUR DUTY TO FULLY COOPERATE WITH AND ASSIST THE TRUSTEE IN THIS INVESTIGATION.
                THESE ARE STANDARD QUESTIONS AND DOCUMENTS THAT EACH DEBTOR MUST ANSWER AND PROVIDE TO THE TRUSTEE . 
            </span>
            YOU MAY RECEIVE FURTHER REQUESTS FOR ADDITIONAL DOCUMENTS FROM THE TRUSTEE . 
            THE TRUSTEE MAY CONDUCT FURTHER INVESTIGATION AS NEEDED .
            YOU ARE OBLIGATED TO PROVIDE THIS ADDITIONAL INFORMATION AND DOCUMENTS AS WELL.
           
        </p>

        <p class="p_justify">
            <span class="text-bold ">YOUR ANSWERS MUST BE TRUE, COMPLETE AND ACCURATE: </span>
            IT IS IMPORTANT THAT ALL YOUR ANSWERS TO THE QUESTIONS ARE TRUE , COMPLETE AND ACCURATE . IF YOU HAVE MADE ANY MISTAKES IN YOUR BANKRUPTCY DOCUMENTS , IT IS ABSOLUTELY
            ESSENTIAL THAT YOU INFORM YOUR TRUSTEE BY CORRECTING THOSE MISTAKES NOW. FAILURE TO DO SO MAY RESULT IN SEVERE CONSEQUENCES . 
            <span class="text-bold text_italic">IT IS A FEDERAL CRIME TO INTENTIONALLY GIVE FALSE OR MISLEADNG INFORMATION AND TESTIMONY TO THE BANKRUPTCY TRUSTEE.</span>
        </p>
       
        <p class="p_justify">
            <span class="text-bold">ALL OF YOUR PROPERTY IS NOW THE PROPERTY OF THE BANKRUPTCY ESTATE:</span>
            PLEASE UNDERSTAND THAT JUST BECAUSE THE DISCHARGE HAS BEEN ISSUED, THIS DOES NOT NECESSARILY MEAN THAT YOUR CASE IF OVER AND WILL BE CLOSED
            RIGHT AWAY. UNTIL THE CASE IS CLOSED, THE TRUSTEE OWNS ALL OF THE PROPERTY OF THE BANKRUPTCY ESTATE . THAT MEANS
            THAT THE TRUSTEE OWNS YOUR HOUSE, YOUR CARS , YOUR PERSONAL PROPERTY AND ALL OF YOUR INVESTMENTS . MUCH OF THE
            PROPERTY MAY BE “ EXEMPT”, MEANING THAT YOU MAY GET TO KEEP IT FOR YOURSELF. IN SOME CASES , “ EXEMPT” PROPERTY MAY
            BE SOLD TO SATISFY CERTAIN TAXES AND/ OR DOMESTIC SUPPORT OBLIGATIONS. IF THE TRUSTEE BELIEVES THAT THERE ARE NON-
            EXEMPT ASSETS THAT CAN BE SOLD FOR THE BENEFIT OF YOUR CREDITORS, THE TRUSTEE WILL FILE A REPORT WITH THE C OURT
            DESIGNATING THE CASE AS AN “ ASSET CASE ”. AN ASSET CASE WILL NOT BE CLOSED RIGHT AWAY. PLEASE NOTE THAT IF YOU
            BECOME ENTITLED TO AN INHERITANCE WITHIN 180 DAYS OF THE FILING OF YOUR PETITION YOU MUST INFORM YOUR TRUSTEE IN
            WRITING OF SUCH INHERITANCE . 
            <span class="text-bold text_italic">
            UNTIL YOUR CASE IS CLOSED, YOU MAY NOT BE ABLE TO SELL, REFINANCE , OR FURTHER
            ENCUMBER ANY OF YOUR PROPERTY – EVEN IF YOU HAVE CLAIMED IT AS EXEMPT AND EVEN IF YOU HAVE ALREADY RECEIVED YOUR DISCHARGE 
            </span>
        </p>

        <p class="p_justify">
           <span class="text-bold"> THE D ISCHARGE.</span> 
            IF DEBTORS HAVE SATISFIED ALL OF THEIR DUTIES , AND NO OBJECTION TO THE DISCHARGE HAS BEEN FILED, THE
            DISCHARGE WILL BE ISSUED BY THE BANKRUPTCY C OURT A FEW MONTHS AFTER THE MEETING OF C REDITORS . THE DISCHARGE
            WILLL NOT BE ISSUED UNTIL THE CERTIFICATE OF COMPLETION OF THE FINANCIAL MANAGEMENT COURSE HAS BEEN FILED WITH THE COURT.
        </p>

        <p class="p_justify">
           <span class="text-bold"> IF YOU HAVE ANY QUESTIONS:</span> 
           IF YOU HAVE ANY QUESTIONS OR REQUIRE FURTHER INFORMATION, YOU SHOULD CONSULT WITH YOUR ATTORNEY OR OTHER LEGAL SOURCES, AS THE TRUSTEE CANNOT PROVIDE YOU LEGAL ADVICE.
        </p>
     
    </div>
    <div class="mt-3 col-md-12">
        <h3 class="text-center underline">PART II – STATEMENT OF BASIC FACTS</h3>
    </div>
    <?php
        $enableSpouse = false;
    if ($debtorClientType === 3) {
        $enableSpouse = true;
    }
    ?>
    <div class="col-md-6 mt-3">
        <h3 class="text-center underline">Debtor</h3> 
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MY NAME IS"
                inputFieldName="MY NAME IS"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MY PHYSICAL ADDRESS IS"
                inputFieldName="MY PHYSICAL ADDRESS IS 1"
                inputValue="{{$debtoraddress}}">
            </x-officialForm.debtorSignVertical>
            <x-officialForm.inputText name="MY PHYSICAL ADDRESS IS 2" class="mt-1" value="{{ $debtorCity }}, {{ $debtorState }}, {{ $debtorzip }}"></x-officialForm.inputText>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MY PHONE NUMBERS ARE (HM)"
                inputFieldName="MY PHONE NUMBERS ARE HM"
                inputValue="{{$debtorPhoneHome}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="(WK)"
                inputFieldName="WK"
                inputValue="{{$debtorPhoneCell}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="CELL"
                inputFieldName="CELL"
                inputValue="{{$debtorPhoneCell}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="EMAIL:"
                inputFieldName="EMAIL"
                inputValue="{{$debtor_email}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <?php
        $mStatus = '';
    switch ($debtorClientType) {
        case '1': $mStatus = 'SINGLE';
            break;
        case '2': $mStatus = 'MARRIED';
            break;
        case '3': $mStatus = 'MARRIED';
            break;
        default: break;
    }?>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MARITAL STATUS IS :"
                inputFieldName="MARITAL STATUS IS"
                inputValue="{{$mStatus}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-2">
            <label for="" class="">(PLEASE SPECIFY, SINGLE , MARRIED, DIVORCED , WIDOWED)</label>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">NO. OF DEPENDENTS CLAIMED ON LAST TAX RETURN :</label>
            </div>
           <div class="col-md-6 ">
                <x-officialForm.inputText name="NO OF DEPENDENTS CLAIMED ON LAST TAX RETURN" class=" mt-1" value="{{$householdSize}}"></x-officialForm.inputText>
           </div>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">FILING STATUS ON TAX RETURN</label>
            </div>
           <div class="col-md-6 ">
                <x-officialForm.inputText name="FILING STATUS ON TAX RETURN" class=" mt-1" value=""></x-officialForm.inputText>
           </div>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">HOW MANY DEPENDENTS LIVE WITH YOU NOW ?</label>
            </div>
           <div class="col-md-6 ">
                <x-officialForm.inputText name="HOW MANY DEPENDENTS LIVE WITH YOU NOW" class=" mt-1" value="{{$householdSize}}"></x-officialForm.inputText>
           </div>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">THE NUMBER OF PEOPLE LIVING AT YOUR ADDRESS:</label>
            </div>
           <div class="col-md-6">
                <x-officialForm.inputText name="THE NUMBER OF PEOPLE LIVING AT YOUR ADDRESS" class=" mt-1" value="{{$householdSize}}"></x-officialForm.inputText>
           </div>
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <h3 class="text-center underline">Co-Debtor</h3>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MY NAME IS"
                inputFieldName="MY NAME IS_2"
                inputValue="{{$enableSpouse?$spousename:''}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MY PHYSICAL ADDRESS IS"
                inputFieldName="MY PHYSICAL ADDRESS IS 1_2"
                inputValue="{{$enableSpouse?$spouseaddress:''}}">
            </x-officialForm.debtorSignVertical>
            <x-officialForm.inputText name="MY PHYSICAL ADDRESS IS 2_2" class="mt-1" value="{{$enableSpouse?$spouseCity.', '.$spouseState.', '.$spousezip:''}}"></x-officialForm.inputText>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MY PHONE NUMBERS ARE (HM)"
                inputFieldName="MY PHONE NUMBERS AREHM"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="(WK)"
                inputFieldName="WK_2"
                inputValue="{{$enableSpouse?$spousePhoneHome:''}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="CELL"
                inputFieldName="CELL_2"
                inputValue="{{$enableSpouse?$spousePhoneHome:''}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="EMAIL:"
                inputFieldName="EMAIL_2"
                inputValue="{{$enableSpouse?Helper::validate_key_value('email', $BasicInfoPartB):''}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="MARITAL STATUS IS :"
                inputFieldName="MARITAL STATUS IS_2"
                inputValue="{{$enableSpouse?$mStatus:''}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-2">
            <label for="" class="">(PLEASE SPECIFY, SINGLE , MARRIED, DIVORCED , WIDOWED)</label>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">NO. OF DEPENDENTS CLAIMED ON LAST TAX RETURN :</label>
            </div>
           <div class="col-md-6 ">
                <x-officialForm.inputText name="NO OF DEPENDENTS CLAIMED ON LAST TAX RETURN_2" class=" mt-1" value=""></x-officialForm.inputText>
           </div>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">FILING STATUS ON TAX RETURN</label>
            </div>
           <div class="col-md-6 ">
                <x-officialForm.inputText name="FILING STATUS ON TAX RETURN_2" class=" mt-1" value=""></x-officialForm.inputText>
           </div>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">HOW MANY DEPENDENTS LIVE WITH YOU NOW ?</label>
            </div>
           <div class="col-md-6 ">
                <x-officialForm.inputText name="HOW MANY DEPENDENTS LIVE WITH YOU NOW_2" class=" mt-1" value=""></x-officialForm.inputText>
           </div>
        </div>
        <div class="row mt-1 pl-2">
           <div class="col-md-6 p-2">
                <label for="">THE NUMBER OF PEOPLE LIVING AT YOUR ADDRESS:</label>
            </div>
           <div class="col-md-6">
                <x-officialForm.inputText name="THE NUMBER OF PEOPLE LIVING AT YOUR ADDRESS_2" class=" mt-1" value=""></x-officialForm.inputText>
           </div>
        </div> 
    </div>
    <div class="col-md-12 mt-3">
        <x-officialForm.inputText name="PART III" class="" value=""></x-officialForm.inputText>
    </div>

    <div class="mt-3 col-md-12 text-center">
        <h3>PART III - STANDARD QUESTIONS</h3>
        <p class="underline">(THIS SECTION MUST BE ANSWERED BY BOTH THE DEBTOR AND THE CO-DEBTOR , WHERE APPLICABLE . IF AN ANSWER TO A
        QUESTION REQUIRES FURTHER EXPLANATION , ATTACH A SEPARATE SHEET OF PAPER AND SUPPORTING DOCUMENTATION )</p>
    </div>


    <div class="col-md-8 mt-3"></div>
    <div class="col-md-2 mt-3">  <p class="text-bold text-center underline">Debtor</p></div>
    <div class="col-md-2 mt-3">  <p class="text-bold text-center underline">Co-Debtor</p></div>

    <?php
    $checkedCheckbox = '';
    $ownedBy = '';
    $priorYes = '';
    $priorNo = '';
    $propertyAll = '';
    $debtorState = $BasicInfoPartA['state'] ?? '';
    $q4Yes = '';
    $q4No = 'checked';
    $q8Yes = '';
    $q8No = '';
    $q9Yes = '';
    $q9No = '';
    $q10And11Yes = '';
    $q10And11No = '';
    $q12Yes = '';
    $q12No = '';
    $q13Yes = '';
    $q13No = '';
    $q21Date = '';
    // for q4
    if (isset($BasicInfoPartA['state']) && $BasicInfoPartA['state'] == 'NV') {
        $q4Yes = 'checked';
        $q4No = '';
    }
    if (isset($BasicInfoPartA['state']) && $BasicInfoPartA['state'] !== 'NV') {
        if (isset($financialaffairs_info['list_every_address']) && $financialaffairs_info['list_every_address'] == 0) {
            $prev_address = $financialaffairs_info['prev_address'];
            if (isset($prev_address) && in_array('NV', $prev_address['creditor_state'])) {
                $q4Yes = 'checked';
                $q4No = '';
            }
        }
    }

    if (isset($propertyresident) && !empty($propertyresident)) {
        $firstPropertyResident = reset($propertyresident);
        // 1 own 0 rent
        $ownedBy = '';
        if (isset($firstPropertyResident['currently_lived']) && $firstPropertyResident['currently_lived'] === 1) {
            $ownedBy = $firstPropertyResident['currently_lived'];
            if ($firstPropertyResident['loan_own_type_property'] === 1) {
                $loan = json_decode($firstPropertyResident['home_car_loan'], true);
                $q21Date = $loan['debt_incurred_date'] ?? '';
            }
        }
        // for q8
        if ($ownedBy === 1) {
            $q8Yes = 'checked';
            $q8No = '';
        }
        if ($ownedBy === 0) {
            if (isset($financialaffairs_info['Property_all']) && $financialaffairs_info['Property_all'] === 1) {
                $q8Yes = 'checked';
            }
            if (isset($financialaffairs_info['Property_all']) && $financialaffairs_info['Property_all'] === 0) {
                $q8No = 'checked';
            }
        }
    }
    if ($debtorClientType !== 1) {
        $checkedCheckbox = "checked";
    }

    $prior1 = $BasicInfo_PartC['filed_bankruptcy_case_last_8years'] ?? '';
    $prior2 = $BasicInfo_PartC['any_bankruptcy_cases_pending'] ?? '';
    $prior3 = $BasicInfo_PartC['bankruptcy_filed_before'] ?? '';

    if ($prior1 === 1 || $prior2 === 1 || $prior3 === 1) {
        $priorYes = "checked";
    }
    if ($prior1 === 0 && $prior2 === 0 && $prior3 === 0) {
        $priorNo = "checked";
    }

    // for q9 , q10, q11, q12, q13
    if (isset($financialassets) && !empty($financialassets)) {
        $unpaid_wages = null;
        $injury_claims = null;
        $inheritances = null;
        foreach ($financialassets as $element) {
            if (isset($element['type']) && $element['type'] === "unpaid_wages") {
                $unpaid_wages = $element;
            }
            if (isset($element['type']) && $element['type'] === "injury_claims") {
                $injury_claims = $element;
            }
            if (isset($element['type']) && $element['type'] === "inheritances") {
                $inheritances = $element;
            }
            if (isset($element['type']) && $element['type'] === "insurance_policies") {
                $insurance_policies = $element;
            }
        }
        // for q9
        if ($unpaid_wages !== null) {
            if ($unpaid_wages['type_value'] === 1) {
                $q9Yes = 'checked';
            }
            if ($unpaid_wages['type_value'] === 0) {
                $q9No = 'checked';
            }
        }
        // for q10, q11
        if ($injury_claims !== null) {
            if ($injury_claims['type_value'] === 1) {
                $q10And11Yes = 'checked';
            }
            if ($injury_claims['type_value'] === 0) {
                $q10And11No = 'checked';
            }
        }
        // for q12
        if ($injury_claims !== null) {
            if ($injury_claims['type_value'] === 1) {
                $q12Yes = 'checked';
            }
            if ($injury_claims['type_value'] === 0) {
                $q12No = 'checked';
            }
        }
        // for q13
        if ($insurance_policies !== null) {
            if ($insurance_policies['type_value'] === 1) {
                $q13Yes = 'checked';
            }
            if ($insurance_policies['type_value'] === 0) {
                $q13No = 'checked';
            }
        }
    }
    ?>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">1.</div>
            <div class="">
                <p>DID YOU <span class="text-bold"> PERSONALLY REVIEW AND THEN SIGN </span> THE PETITION, SCHEDULES AND OTHER DOCUMENTS FILED WITH THE COURT?</p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box1" class="" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box2" class="ml-3" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box3" class="" value="Yes" checked="{{$enableSpouse?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box4" class="ml-3" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">2.</div>
            <div class="">
                <p>IS THE INFORMATION CONTAINED IN ALL THESE DOCUMENTS <span class="text-bold">TRUE , COMPLETE AND ACCURATE ?</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box8" class="" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box7" class="ml-3" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box6" class="" value="Yes" checked="{{$enableSpouse?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box5" class="ml-3" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">3.</div>
            <div class="">
                <p>HAVE YOU <span class="text-bold"> LISTED EVERYTHING YOU OWN IN THESE </span> SCHEDULES?</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box9" class="" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box24" class="ml-3" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box25" class="" value="Yes" checked="{{$enableSpouse?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box40" class="ml-3" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">4.</div>
            <div class="">
                <p>HAVE YOU LIVED IN <span class="text-bold">NEVADA</span> 
                    CONTINUOUSLY FOR THE LAST TWO YEARS ? 
                    IF NOT, PLEASE LIST ALL YOUR ADDRESS DURING THE LAST
                    THREE YEARS ON A SEPARATE SHEET OF PAPER AND ATTACH TO
                    <span class="text-bold">THIS QUESTIONNAIRE . </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box10" class="" value="Yes" checked="{{$q4Yes}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box23" class="ml-3" value="Yes" checked="{{$q4No}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box26" class="" value="Yes" checked="{{$enableSpouse?$q4Yes:''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box39" class="ml-3" value="Yes" checked="{{$enableSpouse?$q4No:''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">5.</div>
            <div class="">
                <p> DO YOU HAVE <span class="text-bold"> ANY OWNERSHIP INTEREST </span> ( PRESENT, FUTURE , CONTINGENT OR DISPUTED) IN ANY R EAL PROPERTY,
                    PERSONAL PROPERTY OR LIFE INSURANCE POLICIES THAT ARE NOT <span class="text-bold"> LISTED IN THESE DOCUMENTS ? </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box11" class="" value="Yes" checked=""></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box22" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box27" class="" value="Yes" checked=""></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box38" class="ml-3" value="Yes" checked="{{$enableSpouse?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">6.</div>
            <div class="">
                <p> <span class="text-bold">HAVE YOU </span> <span class="text-bold text_italic">EVER</span> FILED BANKRUPTCY BEFORE? 
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box12" class="" value="Yes" checked="{{$priorYes}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box21" class="ml-3" value="Yes" checked="{{$priorNo}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box28" class="" value="Yes" checked="{{$enableSpouse?$priorYes:''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box37" class="ml-3" value="Yes" checked="{{$enableSpouse?$priorNo:''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">7.</div>
            <div class="">
                <p> HAVE YOU <span class="text-bold">TRANSFERRED , SOLD OR GIVEN AWAY </span> ANY THING TO ANYONE DURING THE LAST ONE YEAR? 
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box13" class="" value="Yes" checked="{{$financialaffairs_info['Property_all']==1?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box20" class="ml-3" value="Yes" checked="{{$financialaffairs_info['Property_all']==0?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box29" class="" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['Property_all']==1?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box36" class="ml-3" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['Property_all']==0?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">8.</div>
            <div class="">
                <p>HAVE YOU <span class="text-bold">OWNED, SOLD OR TRANSFERRED ANY REAL ESTATE PROPERTY </span> DURING THE LAST FOUR (4) YEARS ? </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box14" class="" value="Yes" checked="{{ $q8Yes }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box19" class="ml-3" value="Yes" checked="{{ $q8No }}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box30" class="" value="Yes" checked="{{ $enableSpouse?$q8Yes:'' }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box35" class="ml-3" value="Yes" checked="{{ $enableSpouse?$q8No :''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">9.</div>
            <div class="">
                <p> DOES ANYONE <span class="text-bold"> OWE YOU ANY MONEY</span> FOR ANY REASON ?</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box15" class="" value="Yes" checked="{{ $q9Yes }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box18" class="ml-3" value="Yes" checked="{{ $q9No }}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box31" class="" value="Yes" checked="{{ $enableSpouse?$q9Yes:'' }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box34" class="ml-3" value="Yes" checked="{{ $enableSpouse?$q9No :''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">10.</div>
            <div class="">
                <p> DO YOU HAVE <span class="text-bold"> CLAIMS AGAINST</span> ANYONE THAT IS NOT LISTED IN YOUR PETITION AND THE SCHEDULES ? </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box16" class="" value="Yes" checked="{{ $q10And11Yes }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box17" class="ml-3" value="Yes" checked="{{ $q10And11No }}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box32" class="" value="Yes" checked="{{ $enableSpouse?$q10And11Yes:'' }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box33" class="ml-3" value="Yes" checked="{{ $enableSpouse?$q10And11No :''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>  
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">11.</div>
            <div class="">
                <p> HAVE YOU <span class="text-bold">FILED OR HAVE A REASON TO FILE ANY LAWSUIT</span> AGAINST ANY ONE FOR ANY REASON? </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box44" class="" value="Yes" checked="{{ $q10And11Yes }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box45" class="ml-3" value="Yes" checked="{{ $q10And11No }}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box46" class="" value="Yes" checked="{{ $enableSpouse?$q10And11Yes:'' }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box47" class="ml-3" value="Yes" checked="{{ $enableSpouse?$q10And11No :''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">12.</div>
            <div class="">
                <p>ARE YOU A <span class="text-bold"> BENEFICIARY OF ANY WILL , TRUST OR ESTATE ? </span></p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box48" class="" value="Yes" checked="{{ $q12Yes }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box49" class="ml-3" value="Yes" checked="{{ $q12No }}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box50" class="" value="Yes" checked="{{ $enableSpouse?$q12Yes:'' }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box51" class="ml-3" value="Yes" checked="{{ $enableSpouse?$q12No :''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

  
     <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">13.</div>
            <div class="">
                <p>ARE YOU NOW ENTITLED TO ANY 
                    <span class="text-bold"> LIFE INSURANCE PROCEEDS </span> AN INHERITANCE 
                    <span class="text-bold">AS A RESULT OF SOMEONE’ S DEATH? </span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box52" class="" value="Yes" checked="{{ $q13Yes }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box53" class="ml-3" value="Yes" checked="{{ $q13No }}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box54" class="" value="Yes" checked="{{ $enableSpouse?$q13Yes:'' }}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box55" class="ml-3" value="Yes" checked="{{ $enableSpouse?$q13No :''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">14.</div>
            <div class="">
                <p> HAS THERE BEEN A <span class="text-bold"> CHANGE IN YOUR FINANCIAL SITUATION </span> SINCE THE FILING OF THE BANKRUPTCY?</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box56" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box57" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box58" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box59" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">15.</div>
            <div class="">
                <p> DID YOU MAKE <span class="text-bold">ANY PAYMENTS TOTALING OVER $600, </span>
                    ANY UNSECURED CREDITOR , DURING THE LAST 90 DAYS PRIOR TO FILING BANKRUPTCY? 
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box60" class="" value="Yes" checked="{{$financialaffairs_info['primarily_consumer_debets']==1?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box61" class="ml-3" value="Yes" checked="{{$financialaffairs_info['primarily_consumer_debets']==0?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box62" class="" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['primarily_consumer_debets']==1?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box63" class="ml-3" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['primarily_consumer_debets']==0?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">16.</div>
            <div class="">
                <p> DID YOU <span class="text-bold"> REARRANGE YOUR FINANCIAL AFFAIRS </span> IN ANY WAY
                    <span> PREPARATION FOR FILING THIS BANKRUPTCY </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box64" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box65" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box66" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box67" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">17.</div>
            <div class="">
                <p> HAVE YOU <span class="text-bold">TRANSFERRED ANY CREDIT CARD BALANCES</span> ONE TO ANOTHER DURING THE LAST SIX MONTHS? </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box71" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box70" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box69" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box68" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>

    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">18.</div>
            <div class="">
                <p>IS ANYONE <span class="text-bold">HOLDING OR STORING ANYTHING</span> ON YOUR BEHALF? </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box72" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box73" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box74" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box75" class="ml-3" value="Yes" checked="checked"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">19.</div>
            <div class="">
                <p> DO YOU HAVE <span class="text-bold">ANY SAFE - DEPOSIT BOX</span> OR A <span class="text-bold">SELF- STORAGE UNIT?</span> (IF YES , PLEASE PROVIDE ITS LOCATION AND LIST OF ITS CONTENTS) </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box79" class="" value="Yes" checked="{{$financialaffairs_info['list_safe_deposit']==1?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box78" class="ml-3" value="Yes" checked="{{$financialaffairs_info['list_safe_deposit']==0?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box77" class="" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['list_safe_deposit']==1?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box76" class="ml-3" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['list_safe_deposit']==0?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">20.</div>
            <div class="">
                <p> HAVE YOU <span class="text-bold"> REPAID ANY LOANS</span> TO ANY FRIENDS AND/ OR RELATIVES DURING THE PAST YEAR? </p>
            </div>
        </div>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box80" class="" value="Yes" checked="{{$financialaffairs_info['payment_past_one_year']==1?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box81" class="ml-3" value="Yes" checked="{{$financialaffairs_info['payment_past_one_year']==0?'checked':''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-2 text-center">
        <x-officialForm.inputCheckbox name="Check Box82" class="" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['payment_past_one_year']==1?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">Yes</label>
        <x-officialForm.inputCheckbox name="Check Box83" class="ml-3" value="Yes" checked="{{$enableSpouse?($financialaffairs_info['payment_past_one_year']==0?'checked':''):''}}"></x-officialForm.inputCheckbox>
        <label for="">No</label>
    </div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">21.</div>
            <div class="">
                <p> IF YOU OWN YOUR HOME , WHEN DID YOU PURCHASE IT? </p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <x-officialForm.inputText name="undefined" class="mt-1" value="{{$q21Date}}"></x-officialForm.inputText>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="d-flex">
            <div class="pr-3">22.</div>
            <div class="">
                <p> WHAT WAS THE PURCHASE PRICE ?</p>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <x-officialForm.priceFieldInput inputFieldName="undefined_2" inputValue=""> </x-officialForm.priceFieldInput>
    </div>
    <div class="col-md-2"></div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">PART IV – DOCUMENTS TO BE SUBMITTED WITH THIS QUESTIONNAIRE</h3>
        <p class="text-bold mt-3">THE FOLLOWING DOCUMENTS MUST BE SUBMITTD TO THE TRUSTEE ALONG WITH THIS QUESTIONNAIRE UNLESS PREVIOUSLY FILED WITH THE COURT WITH YOUR BANKRUPTCY PAPERS:</p>
    </div>

    <div class="col-md-12">
        <div class="d-flex">
            <div class="pr-3">1.</div>
            <p class="p_justify">
                <span class="text-bold">COPY OF THE TAX RETURN </span>
                FOR THE YEAR ENDING IMMEDIATELY PREDEDING THE BANKRUPTCY FILING. 
                MUST BE DELIVERED TO THE TRUSTEE'S OFFICE AT LEAST SEVEN (7) DAYS PRIOR TO THE MEETING OF CREDITORS . 
                FOR BANKKRUPTCIES FILED BETWEEN JANUARY 1 <sup>ST</sup>AND APRIL 15<sup>TH</sup>
                WHERE PREPARATION OF THE TAX RETURN IS STILL PENDING ON THE DATE OF THE
                MEETING OF CREDITORS , THE RETURN MUST BE DELIVERED TO THE TRUSTEE'S OFFICE WITHIN 10 DAYS AFTER THE RETURN IS
                PREPARED, BUT NO LATER THAN APRIL 15<sup>TH</sup>. 
                THE COPY MUST BE DELIVERED IN PERSON OR BY MAIL. DO NOT FAX THE TAX RETURN COPY.
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">2.</div>
            <p class="p_justify"> <span class="text-bold">STATEMENTS ON ALL FINANCIAL ACCOUNTS,</span>
                I.E . CHECKING ACCOUNTS , SAVINGS ACCOUNTS , MONEY MARKET ACCOUNTS , IRA’S , ROTH IRA’S , EDUCATIONAL IRA’S , PENSIONS , BROKERAGE ACCOUNTS , MUTUAL FUNDS , LIFE INSURANCE , ETC.,
                THAT YOU OWN OR THAT YOU CO- SIGN ON WITH ANYONE ELSE, COVERING THE DATE THE PETITION WAS FILED.
                BRING THIS INFORMATION TO THE MEETING OF CREDITORS. 
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">3.</div>
            <p class="p_justify"> <span class="text-bold">EVIDENCE OF CURRENT INCOME </span> TATEMENTS ON ALL FINANCIAL ACCOUNTS. </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">4.</div>
            <p class="p_justify"> 
                <span class="text-bold">PICTURE I.D. ESTABLISHING IDENTITY, </span>
                 SUCH A DRIVER’S LICENSE OR PASSPORT, WORK CARD , HEARLTH CARD , OR MILITARY I.D. BRING TO THE MEETING OF CREDITORS. 
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">5.</div>
            <p class="p_justify"> 
                <span class="text-bold">SOCIAL SECURITY VERIFICATION  </span>
                IN THE FORM OF A DOCUMENT ESTABLISHING THE SOCIAL SECURITY NUMBER SUCH AS A SOCIAL SECURITY CARD , W-2 OR MILITARY I.D. BRING TO THE MEETING OF CREDITORS . 
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">6.</div>
            <p class="p_justify"> 
                <span class="text-bold">COPY OF THE CREDIT COUNSELING CERTIFICATE </span>
                REQUIRED PRIOR TO FILING THE BANKKRUPTCY. BRING TO THE MEETING OF CREDITORS . 
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">7.</div>
            <p class="p_justify"> 
                <span class="text-bold">COPY OF THE FINANCIAL MANAGEMENT CERTIFICATE</span>
                REQUIRED TO OBTAIN THE DISCHARGE . MAIL THE TRUSTEE WHEN COMPLETED. 
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">8.</div>
            <p class="p_justify"> 
                <span class="text-bold">OBLIGATION FOR CHILD SUPPORT/ALIMONY : </span>
                IF YOU HAVE ANY OBLIGATION FOR <span class="text-bold">CHILD SUPPORT/ALIMONY PAYMENTS </span>
                PROVIDE (A) THE NAME, THE LAST- KNOWN ADDRESS AND TELEPHONE NUMBER OF THE ADULT RECEIVING OR SUPPOSED TO BE
                RECEIVING SUCH PAYMENTS , AND (B) DOCUMENTATION TO SUPPORT THESE OBLIGATION SUCH AS MARITAL SETTLEMENT
                AGREEMENT, SEPARATION OR DIVORCE A GREEMENT OR A COURT O RDER . IF YOU ARE UNABLE TO PROVIDE THIS INFORMATION OR
                THE DOCUMENTS PLEASE ATTACH A WRITTEN EXPLANATION. IF YOU HAVE SUCH AN OBLIGATION TO MORE THAN ONE PARTY, PLEASE
                ATTACH A SEPARATE SHEET OF PAPER SHOWING THE FOLLOWING INFORMATION FOR ADDITIONAL PARTIES. 
            </p>
        </div>
    </div>
    <?php
        $dsName1 = '';
    $dsAddress1 = '';
    $dsCityStateZip1 = '';
    $dsName2 = '';
    $dsAddress2 = '';
    $dsCityStateZip2 = '';
    if ($final_debtstax['domestic_support'] == 1) {
        $domestic_tax = Helper::validate_key_value('domestic_tax', $final_debtstax) ?? [];
        if (isset($domestic_tax) && !empty($domestic_tax)) {
            $first_domestic_tax = reset($domestic_tax);
            $dsName1 = Helper::validate_key_value('domestic_support_name', $first_domestic_tax);
            $dsAddress1 = Helper::validate_key_value('domestic_support_address', $first_domestic_tax);
            $dsCityStateZip1 = Helper::validate_key_value('domestic_support_city', $first_domestic_tax);
            $dsCityStateZip1 .= (!empty($dsCityStateZip1) ? ', '.Helper::validate_key_value('creditor_state', $first_domestic_tax) : '');
            $dsCityStateZip1 .= (!empty($dsCityStateZip1) ? ' '.Helper::validate_key_value('domestic_support_zipcode', $first_domestic_tax) : '');
            if (count($domestic_tax) >= 2) {
                $second_domestic_tax = $domestic_tax[1];
                $dsName2 = Helper::validate_key_value('domestic_support_name', $second_domestic_tax);
                $dsAddress2 = Helper::validate_key_value('domestic_support_address', $second_domestic_tax);
                $dsCityStateZip2 = Helper::validate_key_value('domestic_support_city', $second_domestic_tax);
                $dsCityStateZip2 .= (!empty($dsCityStateZip1) ? ', '.Helper::validate_key_value('creditor_state', $second_domestic_tax) : '');
                $dsCityStateZip2 .= (!empty($dsCityStateZip1) ? ' '.Helper::validate_key_value('domestic_support_zipcode', $second_domestic_tax) : '');
            }
        }

    }
    ?>
    <div class="col-md-6 pl-3">
        <div class="pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="NAME"
                inputValue="{{$dsName1}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="TELEPHONE NO."
                inputFieldName="TELEPHONE NO"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="ADDRESS:"
                inputFieldName="ADDRESS"
                inputValue="{{$dsAddress1}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="CITY, STATE, ZIP:"
                inputFieldName="CITYSTATE ZIP"
                inputValue="{{$dsCityStateZip1}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="NAME_2"
                inputValue="{{$dsName2}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="TELEPHONE NO."
                inputFieldName="TELEPHONE NO_2"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="ADDRESS:"
                inputFieldName="ADDRESS_2"
                inputValue="{{$dsAddress2}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-5">
            <x-officialForm.debtorSignVertical
                labelContent="CITY, STATE, ZIP:"
                inputFieldName="CITYSTATE ZIP_2"
                inputValue="{{$dsCityStateZip2}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <div class="pr-3">9.</div>
            <p class="p_justify"> 
                <span class="text-bold">SELF EMPLOYMENT INCOME: </span>
                IF YOU EARN ANY <span class="text-bold"> INCOME FROM SELF EMPLOYMENT,</span> PLEASE PROVIDE THE FOLLOWING:
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3 pl-4">(a.)</div>
            <p class="p_justify"> 
                <span class="underline">PROFIT AND LOSS STATEMENT  </span>
                INDICATING YOUR INCOME AND/OR LOSS FOR THE SIXTY DAYS PRIOR TO FILING OF THE BANKRUPTCY PETITION DULY CERTIFIED BY YOU OR AN OFFICER REPRESENTING THE BUSINESS.
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3 pl-4">(b.)</div>
            <p class="p_justify"> 
                <span class="underline">A COPY OF THE REGULATION P</span>
                OR P RIVACY S TATEMENT, IF ONE HAS BEEN PREPARED.
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3 pl-4">(c.)</div>
            <p class="p_justify"> 
                <span class="underline">A COPY OF THE BENEFIT PLAN DOCUMENTS </span>, IF ANY, I F YOU HAVE EMPLOYEES.
            </p>
        </div>
        <div class="d-flex">
            <div class="pr-3">9.</div>
            <p class="p_justify text-bold"> LIST OF DOCUMENTS BEING SUBMITTED WITH THIS QUESTIONNAIRE:</p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="pr-3 pt-2 pl-4">1.</div>
                      <x-officialForm.inputText name="doc1" class="mt-1" value="{{($debtor_operation_business === 1)?'6 months profit/loss':''}}"></x-officialForm.inputText>
                </div>
                <div class="d-flex">
                    <div class="pr-3 pt-2 pl-4">2.</div>
                      <x-officialForm.inputText name="doc2" class="mt-1" value="{{($debtor_operation_business === 1)?'6 months bank statements':''}}"></x-officialForm.inputText>
                </div>
                <div class="d-flex">
                    <div class="pr-3 pt-2 pl-4">3.</div>
                      <x-officialForm.inputText name="doc3" class="mt-1" value="{{($debtor_operation_business === 1)?'':''}}"></x-officialForm.inputText>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex">
                    <div class="pr-3 pt-2 pl-4">4.</div>
                      <x-officialForm.inputText name="doc4" class="mt-1" value="{{($debtor_operation_business === 1)?'':''}}"></x-officialForm.inputText>
                </div>
                <div class="d-flex">
                    <div class="pr-3 pt-2 pl-4">5.</div>
                      <x-officialForm.inputText name="doc5" class="mt-1" value="{{($debtor_operation_business === 1)?'':''}}"></x-officialForm.inputText>
                </div>
                <div class="d-flex">
                    <div class="pr-3 pt-2 pl-4">6.</div>
                      <x-officialForm.inputText name="doc6" class="mt-1" value="{{($debtor_operation_business === 1)?'':''}}"></x-officialForm.inputText>
                </div>
            </div>
        </div>
        <x-officialForm.inputText name="partv_disc" class="mt-1" value=""></x-officialForm.inputText>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">PART V – DECLARATION UNDER PENALTY OF PERJURY</h3>
        <p class="p_justify mt-3">
            I DECLARE UNDER PENALTY OF PERJURY THAT I HAVE PERSONALLY READ THIS QUESTIONNAIRE AND
            TRUTHFULLY ANSWERED ALL THE QUESTIONS. I FURTHER DECLARE THAT THE INFORMATION AND
            DOCUMENTS PROVIDED WITH THIS QUESTIONNAIRE ARE ALSO TRUE, COMPLETE AND ACCURATE TO THE
            BEST OF MY KNOWLEDGE AND BELIEF.
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATE"
            dateNameField="DATE"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        <div class="mt-1">
            <x-officialForm.dateSingleHorizontal
                labelText="DATE"
                dateNameField="DATE 1"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVertical
            labelContent="DEBTOR"
            inputFieldName="DEBTOR"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVertical>
        <div class="mt-1">
        <x-officialForm.debtorSignVertical
            labelContent="CO-DEBTOR"
            inputFieldName="CODEBTOR"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVertical>
        </div>
    </div>
    <div class="col-md-12">
        <x-officialForm.inputText name="DATE 2" class="mt-1" value=""></x-officialForm.inputText>
    </div>
    
</div>