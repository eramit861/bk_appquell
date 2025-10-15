<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE SOUTHERN DISTRICT OF TEXAS') }}<br>{{ __('HOUSTON DIVISION') }}</h3>
    </div>
    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text2"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div> 
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case Number."
                casenoNameField="Text1"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <label>{{ __('Chapter 7') }}</label>
        </div>
    </div>
    <div class="col-md-12">
        <h3 class="text-center mt-3">{{ __('341(a) MEETING QUESTIONNAIRE AND SWORN TESTIMONY') }}</h3>
        <p class="p_justify mt-3">{{ __("The answers and information provided by the Debtor(s) in this document are a part of the Debtor(s) sworn testimony given before the Chapter 7 Trustee or the Trustee's designated representative. Debtor(s), you must read the questions stated below and answer fully and completely (Singular tense shall be interpreted as Plural tense when the case is a joint filing).") }}</p>
        <p class="p_justify text-bold">
            {{ __('TO THE EXTENT THAT ANY OF THE FOLLOWING INFORMATION IS NOT SHOWN IN YOUR PETITION, SCHEDULES, OR STATEMENT OF FINANCIAL AFFAIRS OR') }} ,
            <span class=" underline">{{ __('IF ANY OF THIS INFORMATION IN THOSE DOCUMENTS HAS CHANGED, PLEASE ANSWER THE FOLLOWING AND IMMEDIATELY AMEND YOUR PETITION, SCHEDULES, OR STATEMENT OF FINANCIAL AFFAIRS HIGHLIGHTING THE INFORMATION THAT HAS BEEN ADDED, CHANGED, OR DELETED') }}:</span>
        </p>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-5">
        <p class="text-center text-bold mb-2">{{ __('Debtor') }}</p>
    </div>
    <div class="col-md-5">
        <p class="text-center text-bold mb-2">{{ __('Joint Debtor') }}</p>
    </div>
    
    <div class="col-md-2 pt-2">
        <label>{{ __("Name(s)") }}:</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text3" class="" value="{{$onlyDebtor}}"/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text11" class="" value="{{$spousename}}"/>
    </div>

    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __('Address:') }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text4" class="mt-1" value="{{$debtoraddress}}"/>
        <x-officialForm.inputText name="Text5" class="mt-1" value="{{$debtorCity}} {{$debtorState}}, {{$debtorzip}}"/>
        <x-officialForm.inputText name="Text6" class="mt-1" value=""/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text12" class="mt-1" value="{{$spouseaddress}}"/>
        <x-officialForm.inputText name="Text13" class="mt-1" value="{{$spouseCity}} {{$spouseState}}, {{$spousezip}}"/>
        <x-officialForm.inputText name="Text14" class="mt-1" value=""/>
    </div>

    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Telephone (home):") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text7" class="mt-1" value="{{$debtorPhoneHome}}"/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text15" class="mt-1" value="{{$spousePhoneHome}}"/>
    </div>
    
    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Employer(s):") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text8" class="mt-1" value="{{$debtorEmployer}}"/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text16" class="mt-1" value="{{$spouseEmployer}}"/>
    </div>
    
    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Address:") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text9" class="mt-1" value="{{$d1EmployerAddressLine1}}"/>
        <x-officialForm.inputText name="Text19" class="mt-1" value="{{$d1EmployerAddressLine2}}"/>
        <x-officialForm.inputText name="Text20" class="mt-1" value="{{$d1EmployerCity}} {{$d1EmployerState}}, {{$d1EmployerZip}}"/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text17" class="mt-1" value="{{$d2EmployerAddressLine1}}"/>
        <x-officialForm.inputText name="Text18" class="mt-1" value="{{$d2EmployerAddressLine2}}"/>
        <x-officialForm.inputText name="Text22" class="mt-1" value="{{$d2EmployerCity}} {{$d2EmployerState}}, {{$d2EmployerZip}}"/>
    </div>

    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Telephone (work):") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text21" class="mt-1" value=""/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text23" class="mt-1" value=""/>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-5">
        <p class="text-center text-bold mb-2 mt-3">{{ __("Non-Filing Spouse") }}</p>
    </div>
    <div class="col-md-5"></div>

    <div class="col-md-2 pt-2">
        <label>{{ __("Name:") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text24" class="" value=""/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text30" class="" value=""/>
    </div>

    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Address:") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text25" class="mt-1" value=""/>
        <x-officialForm.inputText name="Text26" class="mt-1" value=""/>
        <x-officialForm.inputText name="Text27" class="mt-1" value=""/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text31" class="mt-1" value=""/>
        <x-officialForm.inputText name="Text32" class="mt-1" value=""/>
        <x-officialForm.inputText name="Text33" class="mt-1" value=""/>
    </div>

    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Telephone (home):") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text28" class="mt-1" value=""/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text34" class="mt-1" value=""/>
    </div>
    
    <div class="col-md-2 pt-2">
        <label class="mt-1">{{ __("Telephone (work):") }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text29" class="mt-1" value=""/>
    </div>
    <div class="col-md-5">
        <x-officialForm.inputText name="Text35" class="mt-1" value=""/>
    </div>

    <div class="col-md-12 mt-3">
        <!-- 5 column * rows -->
        <table class="w-100">
            <!-- R1 -->
            <tr>   
                <td colspan=""></td>             
                <td colspan="2" class=" pb-2"><h3>{{ __("GENERAL INFORMATION") }}</h3></td>
                <td colspan="" class="text-bold  pb-2">{{ __("Debtor") }}</td>
                <td colspan="" class="text-bold width_15percent pb-2">{{ __("Joint Debtor") }}</td>
            </tr>
            <!-- R2 Line 1 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-1 width_2percent">1.</td>
                <td colspan="2">{{ __("Have you ever filed bankruptcy before?") }}</td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box41" class="" value="Yes" checked="{{Helper::validate_key_toggle('filed_bankruptcy_case_last_8years',$BasicInfo_PartC,1)}}"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box42" class="ml-4" value="Yes" checked="{{Helper::validate_key_toggle('filed_bankruptcy_case_last_8years',$BasicInfo_PartC,0)}}"/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box43" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box44" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R3 -->
            <?php $inputWhere = isset($BasicInfo_PartC['case_filed_state']) ? Helper::validate_key_loop_value('case_filed_state', $BasicInfo_PartC, 0) : "";?>
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2 width_2percent">a.</td>
                <td colspan="">
                    <p class="mb-0">
                        {{ __("If") }} <span class="text-bold">{{ __("yes") }}</span>, {{ __("when") }}? 
                        <select name="<?php echo base64_encode('Dropdown40');?>" class="form-control w-auto ml-3 mr-3">
                            <option value="Yes" <?php if ($BasicInfo_PartC['filed_bankruptcy_case_last_8years'] == 1) { ?> selected <?php } ?>>{{ __("Yes") }}</option>
                            <option value="No" <?php if ($BasicInfo_PartC['filed_bankruptcy_case_last_8years'] == 0) { ?> selected <?php } ?>>{{ __("No") }}</option>
                        </select>
                        {{ __("Where") }}?
                        <x-officialForm.inputText name="Text38" class=" width_40percent ml-3" value="{{$inputWhere}}"/>
                    </p>
                </td>
                <td colspan=""></td>
                <td colspan=""></td>
            </tr>
            <!-- R4 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">b.</td>
                <td colspan="">
                    <p class="mb-0">
                        {{ __("Chapter") }}?
                        <select name="<?php echo base64_encode('Dropdown39');?>" class="form-control w-auto ml-3 mr-3">
                            <option value="7">7</option>
                            <option value="13">13</option>
                            <option value="11">11</option>
                        </select>
                        {{ __("Did you receive a discharge") }}?
                    </p>
                </td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box45" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box47" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box48" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box49" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R5 Line 2 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">2.</td>
                <td colspan="4" class=" pt-2">{{ __("I have the following outstanding liabilities:") }}</td>
            </tr>
            <!-- R6 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="" class="pt-2">{{ __("Child Support") }} (<span class="text_italic">{{ __("See") }}</span> {{ __("Question No. 44") }})</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box46" class="child_support_yes" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box1" class="ml-4 child_support_no" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box2" class=" child_support_yes_d2" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box3" class="ml-4 child_support_no_d2" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R7 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">b.</td>
                <td colspan="" class="pt-2">{{ __("Student Loans") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box4" class=" student_loan_yes" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box5" class="ml-4 student_loan_no" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box7" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box8" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R8 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">c.</td>
                <td colspan="" class="pt-2">{{ __("Taxes") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box6" class=" taxes_other_debts_yes" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box11" class="ml-4 taxes_other_debts_no" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box10" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box9" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R9 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">d.</td>
                <td colspan="" class="pt-2">{{ __("Claims for death or personal injury") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box32" class=" death_personal_claim_yes" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box34" class="ml-4 death_personal_claim_no" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box36" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box38" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R10 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">e.</td>
                <td colspan="" class="pt-2">{{ __("Obligations to pension or profit sharing") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box33" class=" pension_or_profit_yes" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box35" class="ml-4 pension_or_profit_no" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box37" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box39" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R11 -->
            <tr>     
                <td colspan="" class="pt-3 pb-2"></td>           
                <td colspan="4" class="pt-3 pb-2"><h3>{{ __("KNOWLEDGE OF IMPORTANT BANKRUPTCY ISSUES") }}</h3></td>
            </tr>
            <!-- R12 Line 3 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-1">3.</td>
                <td colspan="3">
                    {{ __("I am an individual debtor. I know my case will be dismissed on the 46 th day after I filed this bankruptcy if certain documents are not timely filed.") }}
                </td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box13" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box12" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R13 Line 4 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">4.</td>
                <td colspan="4" class=" pt-2">{{ __("I have provided my attorney or the Trustee with the following documents:") }}</td>
            </tr>
            <!-- R14 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="pt-2"><x-officialForm.inputCheckbox name="Check Box18" class="" value="Yes" checked=""/></td>
                <td colspan="3" class="pt-2">{{ __("All bank statements for the three months prior to the bankruptcy filing") }}</td>
            </tr>
            <!-- R15 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="pt-2"><x-officialForm.inputCheckbox name="Check Box61" class="" value="Yes" checked="checked"/></td>
                <td colspan="3" class="pt-2">{{ __("Last two years tax returns") }}</td>
            </tr>
            <!-- R16 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="pt-2"><x-officialForm.inputCheckbox name="Check Box62" class="" value="Yes" checked=""/></td>
                <td colspan="3" class="pt-2">{{ __("Disabled Veteran’s letter (if applicable)") }}</td>
            </tr>
            <!-- R17 Line 5 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">5.</td>
                <td colspan="3" class="pt-2">{{ __("The majority of my debts were incurred primarily for personal, family or household purposes.") }}</td>
                <td colspan="" class=" pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box14" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box15" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R18 Line 6 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">6.</td>
                <td colspan="3" class="pt-2">{{ __("I understand that I must provide to my attorney or the Trustee all bank statements for the month of filing.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box16" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box17" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R19 Line 7 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">7.</td>
                <td colspan="3" class="pt-2">{{ __("I received, read, and understand my duty to comply with the Duties and Responsibilities of a Debtor Under Chapter 7.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box31" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box19" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R20 Line 8 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">8.</td>
                <td colspan="3" class="pt-2">{{ __("I received, read, and understand the Statement of Information required by 11 U.S.C. § 341 prepared by the Office of the United States Trustee.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box20" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box21" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R21 Line 9 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">9.</td>
                <td colspan="3" class="pt-2">{{ __("I read and signed the Bankruptcy Petition, Schedules, and Statement of Financial Affairs before these documents were filed with the Court.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box22" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box23" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R22 Line 10 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">10.</td>
                <td colspan="3" class="pt-2">{{ __("I understand the questions and information contained in my Bankruptcy Petition, Schedules, Statement of Financial Affairs and this written Sworn Testimony.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box24" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box25" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R23 Line 11 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">11.</td>
                <td colspan="3" class="pt-2">{{ __("I personally signed my Bankruptcy Petition, Bankruptcy Schedules and Statement of Financial Affairs, and Means Test before these documents were filed with the Court.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box26" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box27" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R24 Line 12 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">12.</td>
                <td colspan="3" class="pt-2">{{ __("I understand that all property owned by me may be liable for my domestic support obligations.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box28" class=" domestic_support_yes" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box29" class="ml-4 domestic_support_no" value="Yes" checked=""/>{{ __("No") }}
                        <x-officialForm.inputCheckbox name="Check Box30" class="ml-4 domestic_support_na" value="Yes" checked=""/>{{ __("n/a") }}
                    </p>
                </td>
            </tr>
            <!-- R25 Line 13 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2 ">13.</td>
                <td colspan="3" class="pt-2">{{ __("I understand that within thirty days of my initial meeting of creditors I must reach an agreement with my secured creditor(s) (with purchase money collateral) and either surrender the asset, redeem the asset or reaffirm the debt or the automatic stay will terminate.") }} </td>
                <td colspan="" class="v-align-top pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box40" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box50" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R26 -->
            <tr>     
                <td colspan="" class="pt-3 pb-2"></td>           
                <td colspan="4" class="pt-3 pb-2"><h3>{{ __("QUESTIONS RELATED TO ASSETS") }}</h3></td>
            </tr>
            <!-- R27 Line 14 -->
            <tr>
                <td colspan="" class="text-bold v-align-top ">14.</td>
                <td colspan="3">{{ __("In my Bankruptcy Schedules, I have accurately listed everything that I own including real estate, personal property and money.") }}</td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box51" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box52" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R28 Line 15 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">15.</td>
                <td colspan="3" class="pt-2">{{ __("I understand that any unreceived tax refund for this and any prior tax years is an asset of the bankruptcy estate and that I must tell my Trustee when I receive these refunds if such funds exceed the amount reflected in my schedules or are not listed in my Schedules. (Please refer to the debtor's Duties and Responsibilities). ") }}</td>
                <td colspan="" class="pt-2 v-align-top">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box53" class="" value="Yes" checked="checked"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box54" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R29 Line 16 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">16.</td>
                <td colspan="3" class="pt-2">{{ __("I have lived in Texas for the last 730 days (2 years).") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box55" class="" value="Yes" checked="{{Helper::validate_key_toggle('list_every_address',$financialaffairs_info,0)}}"/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box56" class="ml-4" value="Yes" checked="{{Helper::validate_key_toggle('list_every_address',$financialaffairs_info,1)}}"/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R30 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3" class="pt-2">{{ __("If") }} <span class="text-bold">{{ __("no") }}</span>, {{ __("list the States you resided in the last 730 days (2 years):") }}</td>
                </td>
            </tr>
            <!-- R31 -->
            <?php
                $stateValue1 = Helper::validate_key_loop_value("creditor_state", $financialaffairs_info['prev_address'], 0);
            $fromValue1 = Helper::validate_key_loop_value("from", $financialaffairs_info['prev_address'], 0);
            $toValue1 = Helper::validate_key_loop_value("to", $financialaffairs_info['prev_address'], 0);
            $stateValue1 = !empty($stateValue1) ? $stateValue1 : "";
            $fromValue1 = !empty($fromValue1) ? $fromValue1 : "";
            $toValue1 = !empty($toValue1) ? $toValue1 : "";
            $stateValue2 = Helper::validate_key_loop_value("creditor_state", $financialaffairs_info['prev_address'], 1);
            $fromValue2 = Helper::validate_key_loop_value("from", $financialaffairs_info['prev_address'], 1);
            $toValue2 = Helper::validate_key_loop_value("to", $financialaffairs_info['prev_address'], 1);
            $stateValue2 = !empty($stateValue2) ? $stateValue2 : "";
            $fromValue2 = !empty($fromValue2) ? $fromValue2 : "";
            $toValue2 = !empty($toValue2) ? $toValue2 : "";
            ?>
            <tr>
                <td colspan="" class="pt-1"></td>
                <td colspan="4" class="text-bold pt-1">
                    <p class="mb-0">
                        {{ __("State") }}:
                        <x-officialForm.inputText name="Text63" class="w-auto" value="<?php echo AddressHelper::getSelectedStateName($stateValue1); ?>"/>
                        {{ __("From") }}: 
                        <x-officialForm.inputText name="Text65" class="w-auto" value="{{$fromValue1}}"/>
                        {{ __("To") }}:
                        <x-officialForm.inputText name="Text68" class="w-auto" value="{{$toValue1}}"/>
                    </p>
                </td>
            </tr>
            <!-- R32 -->
            <tr>
                <td colspan="" class="pt-1"></td>
                <td colspan="4" class="text-bold pt-1">
                    <p class="mb-0">
                        {{ __("State") }}:
                        <x-officialForm.inputText name="Text64" class="w-auto" value="<?php echo AddressHelper::getSelectedStateName($stateValue2); ?>"/>
                        {{ __("From") }}: 
                        <x-officialForm.inputText name="Text67" class="w-auto" value="{{$fromValue2}}"/>
                        {{ __("To") }}:
                        <x-officialForm.inputText name="Text69" class="w-auto" value="{{$toValue2}}"/>
                    </p>
                </td>
            </tr>
            <!-- R32 Line 17 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">17.</td>
                <td colspan="3" class="pt-2">{{ __("I have listed, on Schedule C, real estate located in Texas:") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box57" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box58" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R33 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="2" class="pt-2">{{ __("If") }} <span class="text-bold">{{ __("yes") }}</span>, {{ __("were you living there on the date of your bankruptcy filing?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box59" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box60" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R34 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">b.</td>
                <td colspan="2" class="pt-2">{{ __("Is it within the city limits?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box76" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box77" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R35 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">c.</td>
                <td colspan="3"><p class="mb-0">{{ __("If it is located outside the city limits, how many acres is it?") }}<x-officialForm.inputText name="Text70" class="w-auto" value=""/></p></td>
            </tr>
            <!-- R36 -->
            <tr>
                <td colspan="" class="pt-1"></td>
                <td colspan="" class="text-bold v-align-top pt-1">d.</td>
                <td colspan="2" class="pt-1">{{ __("Is the equity in the property in excess of $146,450.00?") }}</td>
                <td colspan="" class="pt-1">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box78" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box79" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R37 Line 18 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">18.</td>
                <td colspan="3" class=" pt-2">{{ __("Did you purchase your home during the four years before filing this bankruptcy?") }}</td>
                <td colspan="" class=" pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box80" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box81" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R38 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3">{{ __("If") }} <span class="text-bold">{{ __("yes") }}</span>, {{ __("state the date the property was acquired:") }}<x-officialForm.inputText name="Text71" class="w-auto" value=""/></td>
            </tr>
            <!-- R39 Line 19 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">19.</td>
                <td colspan="3" class=" pt-2">{{ __("Have you, within the last 10 years, owned any interest in real estate anywhere that is") }} <span class="text-bold">{{ __("NOT") }}</span> {{ __("listed in your schedules?") }}</td>
                <td colspan="" class=" pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box82" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box83" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R40 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="2">
                    {{ __("With respect to any real estate not listed in Schedule A, has it been sold or foreclosed?") }}
                    <x-officialForm.inputCheckbox name="Check Box73" class="" value="Yes" checked=""/>
                    {{ __("Foreclosed") }}
                    <x-officialForm.inputCheckbox name="Check Box74" class="ml-4" value="Yes" checked=""/> 
                    {{ __("Sold") }}
                    <span class="ml-4"></span>
                    {{ __("When?") }}
                    <x-officialForm.inputText name="Text72" class="w-auto" value=""/>
                </td>
                <td colspan="">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box84" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box85" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R41 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">b.</td>
                <td colspan="2" class="pt-2"><span class="text-bold">{{ __("If sold") }}</span>, {{ __("were you paid in full at closing?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box86" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box87" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R42 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">c.</td>
                <td colspan="2" class="pt-2"><span class="text-bold">{{ __("If sold") }}</span>, {{ __("did you sell it to a friend or relative or family member?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box88" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box89" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R43 Line 20 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">20.</td>
                <td colspan="3" class="pt-2">{{ __("Do you receive or are you entitled to receive any payments from a loan of any kind (such as a contract for deed, promissory note, personal loan, etc.)?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box90" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box91" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R44 Line 21 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">21.</td>
                <td colspan="3" class="pt-2">{{ __("Do you currently have any nonbanking deposit accounts such as PayPal, Amazon, online gambling, casinos, etc?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box92" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box98" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R45 Line 22 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">22.</td>
                <td colspan="3" class="pt-2">{{ __("Do you have any unused reward points, gift cards, gift certificates, or airline tickets?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box94" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box95" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R46 Line 23 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">23.</td>
                <td colspan="3" class="pt-2">{{ __("Do you own any rental property?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box96" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box97" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R47 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3"><p class="mb-0">{{ __("If yes, what are the rental payments?") }} <x-officialForm.inputText name="Text75" class="w-auto" value=""/>.</p></td>
            </tr>
            <!-- R48 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">b.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("If there is a lien against the rental property, how much is the monthly payment?") }}
                        <x-officialForm.inputText name="Text130" class="w-auto" value=""/>
                        {{ __("Lender:") }}
                        <x-officialForm.inputText name="Text131" class="w-auto" value=""/>
                        {{ __("Lien Amount:") }}
                        <x-officialForm.inputText name="Text132" class="w-auto" value=""/>
                    </p>
                </td>
            </tr>
            <!-- R49 Line 24 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">24.</td>
                <td colspan="3" class="pt-2">{{ __("Have you operated a business during the last six years?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box99" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box100" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R50 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("If ") }}
                        <span class="text-bold">
                            {{ __("yes") }}
                        </span>, 
                        {{ __("state the name of the business(es):") }}
                        <x-officialForm.inputText name="Text133" class=" width_30percent" value=""/>.
                    </p>
                </td>
            </tr>
            <!-- R51 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top">b.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("State the amount of gross revenues to each business:") }}"
                        <br>
                        {{ __("This year:") }}"
                        <x-officialForm.inputText name="Text134" class="w-auto" value=""/>
                        {{ __("Last year:") }}"
                        <x-officialForm.inputText name="Text135" class="w-auto" value=""/>
                    </p>
                </td>
            </tr>
            <!-- R52 -->
            <tr>
                <td colspan="" class="pt-2"></td>
                <td colspan="" class="text-bold v-align-top pt-2">c.</td>
                <td colspan="2" class="pt-2">{{ __("Do you intend to continue operating the business(es)?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box101" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box102" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R53 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("If ") }}
                            <span class="text-bold">
                                {{ __("yes") }}
                            </span>
                        {{ __("please list which business(es):") }}
                        <x-officialForm.inputText name="Text136" class=" width_30percent" value=""/>.
                    </p>
                </td>
            </tr>
            <!-- R54 Line 25 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">25.</td>
                <td colspan="3" class="pt-2">{{ __("Is all non-exempt property insured, other than cash on hand?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box103" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box104" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                        <x-officialForm.inputCheckbox name="Check Box105" class="ml-4" value="Yes" checked=""/>{{ __("n/a") }}
                    </p>
                </td>
            </tr>
            <!-- R55 Line 26 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">26.</td>
                <td colspan="3" class="pt-2">{{ __("Did you transfer, sell or convey any real or personal property with a fair market value of more than $2,500 in the last four (4) years?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box106" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box107" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R56 Line 27 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">27.</td>
                <td colspan="3" class="pt-2">{{ __("Have you ever been the trustee, beneficiary or settlor of a trust?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box108" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box109" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R57 Line 28 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">28.</td>
                <td colspan="3" class="pt-2">{{ __("Have you transferred anything into a trust within the last ten (10) year from the filing date?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box110" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box111" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R58 Line 29 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">29.</td>
                <td colspan="3" class="pt-2">
                    <p class="mb-0">
                        {{ __("Is anyone holding any of your property?") }}
                        <br>
                        {{ __("Name:") }}
                        <x-officialForm.inputText name="Text137" class=" width_30percent" value=""/>
                        {{ __("Address:") }}
                        <x-officialForm.inputText name="Text145" class=" width_30percent" value=""/>
                    </p>
                </td>
                <td colspan="" class="pt-2 v-align-top">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box112" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box113" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R59 Line 30 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">30.</td>
                <td colspan="3" class="pt-2">{{ __("Do you have any type of retirement account or plan?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box114" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box115" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R60 Line 31 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">31.</td>
                <td colspan="3" class="pt-2">{{ __("Have you ever made a contribution to a retirement account or plan that is greater than the amount allowed under the IRS tax code to be made with pre-tax dollars?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box116" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box117" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R61 Line 32 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">32.</td>
                <td colspan="3" class="pt-2">{{ __("Have you placed money in an educational individual retirement account or state tuition fund within one year prior to the filing of this bankruptcy?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box118" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box119" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R62 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("If ") }}
                        <span class="text-bold">
                            {{ __("yes") }}
                        </span>, 
                        {{ __("How much?") }}
                        <x-officialForm.inputText name="Text141" class=" w-auto" value=""/>
                        {{ __("When?") }}
                        <x-officialForm.inputText name="Text142" class=" w-auto" value=""/>
                    </p>
                </td>
            </tr>
            <!-- R63 Line 33 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">33.</td>
                <td colspan="3" class="pt-2">{{ __("Did you lose in excess of $2,500 gambling in the last year?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box120" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box121" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R64 -->
            <tr>     
                <td colspan="" class="pt-3 pb-2"></td>           
                <td colspan="4" class="pt-3 pb-2"><h3 class="underline">{{ __("QUESTIONS RELATING TO CREDITORS") }}</h3></td>
            </tr>
            <!-- R65 Line 34 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">34.</td>
                <td colspan="3" class="pt-2">{{ __("I have listed, in my Bankruptcy Schedules, everyone to whom I owed money on the date I filed this bankruptcy, including friends and relatives.") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box122" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box123" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R66 Line 35 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">35.</td>
                <td colspan="3" class="pt-2">{{ __("Have you made payments to the IRS greater than necessary to pay taxes currently due, e.g. have you prepaid any taxes?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box124" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box125" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R67 Line 36 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">36.</td>
                <td colspan="3" class="pt-2">{{ __("Within the last four (4) years, have you asked the IRS to apply any tax overpayments to a subsequent tax year?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box126" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box127" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R68 Line 37 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">37.</td>
                <td colspan="3" class="pt-2">{{ __("In the last year, did you make payments on your mortgage or to any other creditor of more than $1,000.00 greater than the regularly required payment?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box128" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box129" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R69 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("If ") }}
                        <span class="text-bold">
                            {{ __("yes") }}
                        </span>: 
                        {{ __("To whom:") }}
                        <x-officialForm.inputText name="Text143" class=" w-auto" value=""/>
                        {{ __("How much:") }}
                        <x-officialForm.inputText name="Text144" class=" w-auto" value=""/>
                    </p>
                </td>
            </tr>
            <!-- R70 Line 38 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">38.</td>
                <td colspan="3" class="pt-2">{{ __("Do any of the claims against you arise from a violation of the Federal Securities Laws?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box155" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box156" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R71 Line 39 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">39.</td>
                <td colspan="3" class="pt-2">{{ __("Are any of the claims against you based on an alleged claim of fraud, deceit or manipulation in a fiduciary capacity or in the purchase or sale of any security?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box157" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box158" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R72 Line 40 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">40.</td>
                <td colspan="3" class="pt-2">{{ __("Do any of the claims against you arise from any alleged criminal act or intentional tort or willful or reckless misconduct that caused serious physical injury or death to any individual within the last five years?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box159" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box160" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R73 Line 41 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">41.</td>
                <td colspan="3" class="pt-2">{{ __("Has anyone sued you for death or personal injury resulting from the operation of a motor vehicle, vessel or airplane?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box161" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box162" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R74 Line 42 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">42.</td>
                <td colspan="3" class="pt-2">{{ __("In the last two years, did you repay any money borrowed from your relatives or in-laws?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box163" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box164" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R74.1 -->
            <tr>
                <td colspan=""></td>
                <td colspan="" class="text-bold v-align-top pt-2">a.</td>
                <td colspan="3">
                    <p class="mb-0">
                        {{ __("If ") }}
                        <span class="text-bold">
                            {{ __("yes") }}
                        </span>, 
                        {{ __("Name:") }}&nbsp;
                        <x-officialForm.inputText name="Text167" class=" width_30percent" value=""/>
                        {{ __("Relation:") }}
                        <x-officialForm.inputText name="Text168" class=" w-auto" value=""/>
                        <br>
                        <span class="ml-4 pl-3"></span>
                        {{ __("When") }}?
                        <x-officialForm.inputText name="Text169" class=" w-auto mt-1" value=""/>
                        {{ __("How much?") }}
                        <x-officialForm.inputText name="Text170" class=" w-auto mt-1" value=""/>
                    </p>
                </td>
            </tr>
            <!-- R75 Line 43 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">43.</td>
                <td colspan="3" class="pt-2">{{ __("In the last year did you make payments on loans from your pension or savings loan?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box165" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box166" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R76 Line 44 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">44.</td>
                <td colspan="3" class="pt-2">{{ __("If you owe child support payments or other domestic support obligations, list the full name and last known address of the party to whom the CSO/DSO is due and the name of the agency the support payment is paid through (if applicable).") }}</td>
                <td colspan=""></td>
            </tr>
            <!-- R77 -->
            <tr>
                <td colspan="5" class="text-bold pt-2">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-5 text-center">
                            <p class="mb-2 text-bold">
                                {{ __("Party to whom CSO/DSO is due ") }}"
                                <br>
                                {{ __("(if more than one, please list on back)") }}"
                            </p>
                        </div>
                        <div class="col-md-5 text-center">
                            <p class="mb-2 text-bold">
                                {{ __("Agency support payment is paid through ") }}"
                                <br>
                                {{ __("(if more than one, please list on back)") }}"
                            </p>
                        </div>
                        <div class="col-md-2 pt-2">
                            <label>{{ __("Name:") }}</label>
                        </div>
                        <div class="col-md-5">
                            <x-officialForm.inputText name="Text171" class="" value=""/>
                        </div>
                        <div class="col-md-5">
                            <x-officialForm.inputText name="Text177" class="" value=""/>
                        </div>

                        <div class="col-md-2 pt-2">
                            <label class="mt-1">{{ __("Address:") }}</label>
                        </div>
                        <div class="col-md-5">
                            <x-officialForm.inputText name="Text172" class="mt-1" value=""/>
                            <x-officialForm.inputText name="Text173" class="mt-1" value=""/>
                            <x-officialForm.inputText name="Text174" class="mt-1" value=""/>
                        </div>
                        <div class="col-md-5">
                            <x-officialForm.inputText name="Text178" class="mt-1" value=""/>
                            <x-officialForm.inputText name="Text179" class="mt-1" value=""/>
                            <x-officialForm.inputText name="Text180" class="mt-1" value=""/>
                        </div>

                        <div class="col-md-2 pt-2">
                            <label class="mt-1">{{ __("Telephone (home):") }}</label>
                        </div>
                        <div class="col-md-5">
                            <x-officialForm.inputText name="Text175" class="mt-1" value=""/>
                        </div>
                        <div class="col-md-5">
                            <x-officialForm.inputText name="Text181" class="mt-1" value=""/>
                        </div>
                        
                    </div>
                </td>
            </tr>
             <!-- R77 -->
            <tr>
                <td colspan="5" class="text-bold pt-2">
                    {{ __("Number of Depend") }}ents:
                    <x-officialForm.inputText name="Text176" class="w-auto" value=""/>
                </td>
            </tr>
            <!-- R78 -->
            <tr>     
                <td colspan="" class="pt-3 pb-2"></td>           
                <td colspan="4" class="pt-3 pb-2"><h3>{{ __("QUESTIONS RELATING TO LITIGATION OR CLAIMS") }}</h3></td>
            </tr>
            <!-- R79 Line 45 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">45.</td>
                <td colspan="3" class="pt-2">{{ __("Do you have any claims or potential claims or lawsuits against anyone whether or not a lawsuit has been filed?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box63" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box66" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R80 Line 46 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">46.</td>
                <td colspan="3" class="pt-2">{{ __("Within the year prior to filing, have you conferred with an attorney other than your bankruptcy attorney regarding any claims, potential claims, or lawsuits against anyone?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box64" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box67" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
            <!-- R81 Line 47 -->
            <tr>
                <td colspan="" class="text-bold v-align-top pt-2">47.</td>
                <td colspan="3" class="pt-2">{{ __("Are you presently involved in a divorce proceeding or have you been involved in a divorce proceeding within the last four years?") }}</td>
                <td colspan="" class="pt-2">
                    <p class="mb-0">
                        <x-officialForm.inputCheckbox name="Check Box65" class="" value="Yes" checked=""/>{{ __("Yes") }}
                        <x-officialForm.inputCheckbox name="Check Box68" class="ml-4" value="Yes" checked=""/>{{ __("No") }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p class=" p_justify text-bold ml-5 mr-5">{{ __("YOU HAVE A LEGAL OBLIGATION TO PROVIDE THE TRUSTEE WITH TRUTHFUL, CORRECT, AND COMPLETE INFORMATION REGARDING YOUR CASE INCLUDING THE INFORMATION PROVIDED IN THE SCHEDULES, STATEMENT OF FINANCIAL AFFAIRS, THE FOREGOING QUESTIONS AND YOUR TESTIMONY AT THE 341 MEETING. IF YOU DISCOVER, LEARN OR REALIZE THAT ANY OF THE ANSWERS OR INFORMATION THAT YOU PROVIDED IS INCOMPLETE OR INCORRECT IN ANY WAY, YOU MUST IMMEDIATELY AMEND YOUR SCHEDULES ON THE APPROPRIATE FORM HIGHLIGHTING THE INFORMATION THAT HAS BEEN ADDED, CHANGED, OR DELETED.") }}</p>
        <p class=" p_justify text-bold ml-5 mr-5">{{ __("IN ADDITION, IF YOU RECEIVE MONEY OR PROPERTY THAT SHOULD HAVE BEEN BUT WAS NOT LISTED IN YOUR SCHEDULES, STATEMENT OF FINANCIAL AFFAIRS OR IN ANSWER TO THE QUESTIONS ABOVE, YOU MUST NOTIFY THE TRUSTEE IMMEDIATELY IN WRITING AND PRESERVE THE MONEY OR PROPERTY UNTIL THE TRUSTEE DIRECTS YOU TO TAKE A SPECIFIC ACTION. YOU MUST NOT USE OR OTHERWISE DISPOSE OF IT WITHOUT THE TRUSTEE'S PERMISSION.") }}</p>
        <p class=" p_justify text-bold ml-5 mr-5">{{ __("IF YOU HAVE A QUESTION OR NEED INFORMATION REGARDING YOUR CASE AND ARE REPRESENTED BY AN ATTORNEY, PLEASE CONTACT YOUR ATTORNEY. IF YOUR ATTORNEY DOES NOT RESPOND, YOU MAY CONTACT THE TRUSTEE IN WRITING BUT SEND A COPY OF SUCH CORRESPONDENCE TO YOUR ATTORNEY. IF YOU DO NOT HAVE AN ATTORNEY, PLEASE REQUEST INFORMATION IN WRITING. NEITHER THE TRUSTEE NOR THE TRUSTEE'S EMPLOYEES CAN PROVIDE YOU WITH LEGAL ADVICE OR REPRESENTATION.") }}</p>
        <p class=" p_justify text-bold ml-5 mr-5">{{ __("QUESTIONS REGARDING YOUR DISCHARGE SHOULD BE DIRECTED TO YOUR ATTORNEY OR TO THE BANKRUPTCY CLERK'S OFFICE.") }}</p>
        <p class=" p_justify ">{{ __("I have read the foregoing and understand the questions. If represented by an attorney, I have reviewed the questions and answers with my attorney. The answers to the questions are mine. The answers are based on my personal knowledge and are true and correct.") }}</p>
        <p>
            {{ __("Dated this ") }}
            <x-officialForm.inputText name="Text149" class="w-auto" value="{{$currentMonth}}"/>
            {{ __("day of ") }}
            <x-officialForm.inputText name="Text150" class=" width_5percent" value="{{$currentDay}}"/>
            20
            <x-officialForm.inputText name="Text148" class=" width_5percent" value="{{$currentYearShort}}"/>
            .
        </p>
    </div>
    <div class="col-md-6 mt-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Print Name:"
            inputFieldName="Text152"
            inputValue={{$onlyDebtor}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Print Name:"
            inputFieldName="Text153"
            inputValue={{$spousename}}>
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="underline text-center">{{ __("ATTORNEY ACKNOWLEDGMENT") }}</h3>
        <p class="mt-3 p_justify">{{ __("As the attorney of record, I have reviewed and discussed the contents of this document with the Debtor(s). I am not aware of any contrary information. Furthermore, the contents of this document have not been altered from the form provided by the Panel Trustees.") }}</p>
    </div>
    
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3 text-bold">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="ATTORNEY FOR DEBTOR(S)"
            inputFieldName="Text154"
            inputValue="{{$atroneyName}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

</div>

<script>



    $(document).ready(function() {
        // ef_domestic_support_obligation
        if($('.ef_domestic_support_obligation').is(':checked') == true){
            $('.child_support_yes').attr( 'checked', true );
        }
        if($('.ef_domestic_support_obligation').is(':checked') == false){
            $('.child_support_no').attr( 'checked', true );
        }
        // ef_taxes_other_debts
        if($('.ef_taxes_other_debts').is(':checked') == true){
            $('.taxes_other_debts_yes').attr( 'checked', true );
        }
        if($('.ef_taxes_other_debts').is(':checked') == false){
            $('.taxes_other_debts_no').attr( 'checked', true );
        }
        // ef_death_personal_claim
        if($('.ef_death_personal_claim').is(':checked') == true){
            $('.death_personal_claim_yes').attr( 'checked', true );
        }
        if($('.ef_death_personal_claim').is(':checked') == false){
            $('.death_personal_claim_no').attr( 'checked', true );
        }
        // ef_student_loan
        if($('.ef_student_loan').is(':checked') == true){
            $('.student_loan_yes').attr( 'checked', true );
        }
        if($('.ef_student_loan').is(':checked') == false){
            $('.student_loan_no').attr( 'checked', true );
        }
        // ef_pension_or_profit
    
        if($('.ef_pension_or_profit').is(':checked') == true){
            $('.pension_or_profit_yes').attr( 'checked', true );
        }
        if($('.ef_pension_or_profit').is(':checked') == false){
            $('.pension_or_profit_no').attr( 'checked', true );
        }
        // for true que 12
        if($('.child_support_yes').is(':checked') == true && $('.child_support_yes_d2').is(':checked') == true){
            $('.domestic_support_yes').attr( 'checked', true );
        }
        if($('.child_support_no').is(':checked') == true && $('.child_support_no_d2').is(':checked') == true){
            $('.domestic_support_na').attr( 'checked', true );
        }
        // for false que 12
        if($('.child_support_yes').is(':checked') == false || $('.child_support_yes_d2').is(':checked') == false){
            $('.domestic_support_yes').attr( 'checked', false );
        }
        if($('.child_support_no').is(':checked') == false || $('.child_support_no_d2').is(':checked') == false){
            $('.domestic_support_na').attr( 'checked', false );
        }

    });

    $(document).on('change', 'input', function() {
        // ef_domestic_support_obligation
        if($('.ef_domestic_support_obligation').is(':checked') == true){
            $('.child_support_yes').attr( 'checked', true );
        }
        if($('.ef_domestic_support_obligation').is(':checked') == false){
            $('.child_support_no').attr( 'checked', true );
        }
        // ef_taxes_other_debts
        if($('.ef_taxes_other_debts').is(':checked') == true){
            $('.taxes_other_debts_yes').attr( 'checked', true );
        }
        if($('.ef_taxes_other_debts').is(':checked') == false){
            $('.taxes_other_debts_no').attr( 'checked', true );
        }
        // ef_death_personal_claim
        if($('.ef_death_personal_claim').is(':checked') == true){
            $('.death_personal_claim_yes').attr( 'checked', true );
        }
        if($('.ef_death_personal_claim').is(':checked') == false){
            $('.death_personal_claim_no').attr( 'checked', true );
        }
        // ef_student_loan
        if($('.ef_student_loan').is(':checked') == true){
            $('.student_loan_yes').attr( 'checked', true );
        }
        if($('.ef_student_loan').is(':checked') == false){
            $('.student_loan_no').attr( 'checked', true );
        }
        // ef_pension_or_profit
    
        if($('.ef_pension_or_profit').is(':checked') == true){
            $('.pension_or_profit_yes').attr( 'checked', true );
        }
        if($('.ef_pension_or_profit').is(':checked') == false){
            $('.pension_or_profit_no').attr( 'checked', true );
        }
        // for true que 12
        if($('.child_support_yes').is(':checked') == true && $('.child_support_yes_d2').is(':checked') == true){
            $('.domestic_support_yes').attr( 'checked', true );
        }
        if($('.child_support_no').is(':checked') == true && $('.child_support_no_d2').is(':checked') == true){
            $('.domestic_support_na').attr( 'checked', true );
        }
        // for false que 12
        if($('.child_support_yes').is(':checked') == false || $('.child_support_yes_d2').is(':checked') == false){
            $('.domestic_support_yes').attr( 'checked', false );
        }
        if($('.child_support_no').is(':checked') == false || $('.child_support_no_d2').is(':checked') == false){
            $('.domestic_support_na').attr( 'checked', false );
        }
    });

</script>
