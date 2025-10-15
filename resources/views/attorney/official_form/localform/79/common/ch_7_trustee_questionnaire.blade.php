<div class="row">
    <div class="col-md-12 mt-3 text-center">
        <h3>CHAPTER 7 DEBTOR QUESTIONNAIRE</h3>
    </div>
    <div class="col-md-12 mt-3 text-bold">
        <p class="p_justify">
            <span class="pl-4"></span>
            All debtors must complete this Questionnaire and send it to their Chapter 7 trustee. Unless
            the Chapter 7 trustee requests otherwise, the completed Questionnaire shall be sent via U.S. Mail,
            postmarked no later than 14 days before the date set for the Meeting of Creditors/341 Hearing
            Date. If represented by an attorney, debtors should discuss their responses with their attorneys
            prior to sending their competed questionnaire to the Chapter 7 trustee.
        </p>
    </div>
    <div class="col-md-4">
        <label class="text-bold">{{ __('DEBTOR 1 NAME:') }}</label>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="<?php echo base64_encode('text1'); ?>" value="{{$onlyDebtor}}" class="form-control">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Phone:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('text2'); ?>" class="form-control" value="{{$debtorPhoneHome}}">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Email:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('text3'); ?>" class="form-control" value="{{$debtor_email}}">
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-4 mt-3">
        <label for=""><span class="text-bold">{{ __('DEBTOR 2 NAME') }}</span> {{ __('(if applicable):') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="<?php echo base64_encode('text4'); ?>" value="{{$spousename}}" class="form-control">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Phone:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('text5'); ?>" class="form-control" value="{{$spousePhoneHome}}">
            </div>
            <div class="col-md-4 mt-1">
                <label for="">{{ __('Email:') }}</label>
            </div>
            <div class="col-md-8 mt-1">
                <input type="text" name="<?php echo base64_encode('text6'); ?>" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-4 mt-3"></div>


    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('CASE NUMBER:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text7'); ?>" value="{{$caseno}}" class="form-control w-auto">
    </div>
    <div class="col-md-2 mt-3 pt-2">
        <label class="text-bold">{{ __('341 HEARING DATE:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('text8'); ?>" class="form-control w-auto">
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex pl-4">
            <div>
                <label for="">1.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you reviewed your Petition, Schedules, and Statement of Financial Affairs and do you
                    understand the information contained in them?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box1'
                    fieldNameNo='Check Box2'
                    r1Value='Yes'
                    r1Checked=true
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">2.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you reviewed the Bankruptcy Information Sheet and do you understand the information
                    contained in it?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box3'
                    fieldNameNo='Check Box4'
                    r1Value='Yes'
                    r1Checked=true
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        
        <?php
            $q3r1Checked = $debtorClientType == 2 ? true : false;
                $q3r2Checked = $debtorClientType == 2 ? false : true;

                $q3HasData = Helper::validate_key_value('living_domestic_partner', $financialaffairs_info, 'radio');
                $q3WifeName = '';
                if ($q3HasData == 1) {
                    $domestic_partner = Helper::validate_key_value('domestic_partner', $financialaffairs_info);
                    $q3WifeName = !empty($domestic_partner) && is_array($domestic_partner) ? reset($domestic_partner) : '';
                }
                ?>

        <div class="d-flex pl-4">
            <div>
                <label for="">3.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('For those filing individually, are you presently married?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box5'
                    fieldNameNo='Check Box6'
                    r1Value='Yes'
                    r2Value='Yes'
                    :r1Checked="$q3r1Checked"
                    :r2Checked="$q3r2Checked"
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
                <p class="mb-2">
                    {{ __('If you answered yes to this question, please provide the following information:') }}
                </p>
                <div class="row">
                    <div class="col-md-4 pt-2">
                        <label for="">{{ __('(a) Date married:') }}</label>
                    </div>
                    <div class="col-md-8">
                        <input type="text" name="<?php echo base64_encode('text9'); ?>" class="form-control w-auto">
                    </div>

                    <div class="col-md-4 pt-2 mt-1">
                        <label for="">{{ __('(b) Name of spouse:') }}</label>
                    </div>
                    <div class="col-md-8 mt-1">
                        <input type="text" name="<?php echo base64_encode('text10'); ?>" class="form-control w-auto" value="{{ $q3WifeName }}">
                    </div>
                </div>
                <p class=" p_justify mb-1 mt-2">
                    {{ __('(c) Are all of your, your spouse’s and your marital community’s assets listed on your schedules?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box7'
                    fieldNameNo='Check Box8'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">4.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you been divorced in the 2 years prior to your bankruptcy filing?') }}
                </p>
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
                    $q5Data = Helper::validate_key_value('brokerage_account', $financial_assests);
                $q5HasData = Helper::validate_key_value('type_value', $q5Data, 'radio');
                $q5r1Checked = $q5HasData == 1 ? true : false;
                $q5r2Checked = $q5HasData == 0 ? true : false;
                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">5.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you own any bitcoin or other cryptocurrency?') }}
                </p>
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
        <?php

                    $q6HasData = Helper::validate_key_value('list_lawsuits', $financialaffairs_info, 'radio');
                $q6CaseNature = '';
                $q6CaseNo = '';
                $q6r1Checked = $q6HasData == 1 ? true : false;
                $q6r2Checked = $q6HasData == 0 ? true : false;

                if ($q6HasData == 1) {
                    $q6Data = Helper::validate_key_value('list_lawsuits_data', $financialaffairs_info);
                    $case_nature = Helper::validate_key_value('case_nature', $q6Data);
                    $case_number = Helper::validate_key_value('case_number', $q6Data);
                    $q6CaseNature = !empty($case_nature) && is_array($case_nature) ? reset($case_nature) : '';
                    $q6CaseNo = !empty($case_number) && is_array($case_number) ? reset($case_number) : '';
                }

                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">6.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you involved in any lawsuit in which you are seeking to recover money or property from a
                    person or entity (such as a personal injury claim, automobile accident claim, or class action
                    claim)?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box13'
                    fieldNameNo='Check Box14'
                    r1Value='Yes'
                    r2Value='Yes'
                    :r1Checked="$q6r1Checked"
                    :r2Checked="$q6r2Checked"
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
                <p class="mb-2">
                    {{ __('If you answered yes to this question, please provide the following information:') }}
                </p>
                <p class="mb-2">
                    {{ __('(a) Nature of the lawsuit (example: personal injury/auto accident, class action, etc.):') }}
                </p>
                <input type="text" name="<?php echo base64_encode('text11'); ?>" class="form-control " value="{{ $q6CaseNature }}">
                <input type="text" name="<?php echo base64_encode('text12'); ?>" class="form-control mt-1">
                <div class="row">
                    <div class="col-md-4 pt-2 mt-1">
                        <label for="">{{ __('(b) Case number:') }}</label>
                    </div>
                    <div class="col-md-8 mt-1">
                        <input type="text" name="<?php echo base64_encode('text13'); ?>" class="form-control w-auto" value="{{ $q6CaseNo }}">
                    </div>
                </div>
                <p class=" p_justify mb-1 mt-2">
                    {{ __('(c) Name and telephone number of the attorney handling that lawsuit:') }}
                </p>
                <input type="text" name="<?php echo base64_encode('text14'); ?>" class="form-control ">
            </div>
        </div>
        <?php
                    $q7Data = Helper::validate_key_value('injury_claims', $financial_assests);
                $q7HasData = Helper::validate_key_value('type_value', $q7Data, 'radio');
                $q7r1Checked = false;
                $q7Nature = '';
                if ($q7HasData == 1) {
                    $q7r1Checked = true;
                    $description = Helper::validate_key_value('description', $q7Data);
                    $q7Nature = is_array($description) ? reset($description) : '';

                }
                $q7r2Checked = $q7r1Checked ? false : true;
                ?>
        <div class="d-flex pl-4 mt-3">
            <div>
                <label for="">7.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you aware of any') }} <span class=" text-bold text_italic">{{ __('potential') }}</span> {{ __('claim or right to payment that you may have against any person
                    or entity (such as personal injury claims, automobile accident claims, class action claims or
                    settlements)?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box15'
                    fieldNameNo='Check Box16'
                    r1Value='Yes'
                    r2Value='Yes'
                    :r1Checked="$q7r1Checked"
                    :r2Checked="$q7r2Checked"
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
                <p class="mb-2">
                    {{ __('If you answered yes to this question, please provide the following information:') }}
                </p>
                <div class="row">
                    <div class="col-md-4 pt-2 mt-1">
                        <label for="">{{ __('(a) Nature of your claim or right to payment:') }} </label>
                    </div>
                    <div class="col-md-7 mt-1">
                        <input type="text" name="<?php echo base64_encode('text15'); ?>" class="form-control" value="{{ $q7Nature }}">
                    </div>
                </div>
                <p class=" p_justify mb-1 mt-2">
                    {{ __('(b) Name and telephone number of the attorney handling that claim, if any:') }}
                </p>
                <input type="text" name="<?php echo base64_encode('text16'); ?>" class="form-control ">
            </div>
        </div>
        <?php

                $q8Data = Helper::validate_key_value('life_insurance', $financial_assests);
                $q8HasData = Helper::validate_key_value('type_value', $q8Data, 'radio');
                $q8r1Checked = false;
                $q8r2Checked = false;
                if ($q8HasData == 1) {
                    $account_type = Helper::validate_key_value('account_type', $q8Data);
                    if (is_array($account_type)) {
                        foreach ($account_type as $key => $value) {
                            if (in_array($value, ['Term', 'Whole', 'Universal'])) {
                                $q8r1Checked = true;
                            }
                        }
                    }
                    $q8r2Checked = $q8r1Checked ? false : true;
                }
                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">8.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you entitled to receive a death benefit under a will or insurance policy where the person has
                    already died?') }}
                </p>
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
                    $q9Data = Helper::validate_key_value('inheritances', $financial_assests);
                $q9HasData = Helper::validate_key_value('type_value', $q9Data, 'radio');
                $q9r1Checked = $q9HasData == 1 ? true : false;
                $q9r2Checked = $q9HasData == 0 ? true : false;
                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">9.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that you must report any rights to an inheritance or life insurance proceeds
                    that arise within 180 days after your bankruptcy filing by notifying your trustee and by filing
                    amended Schedules A/B and C with the court?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box19'
                    fieldNameNo='Check Box20'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <?php
                    $q10Data = Helper::validate_key_value('inheritances', $financial_assests);
                $q10HasData = Helper::validate_key_value('type_value', $q10Data, 'radio');
                $q10r1Checked = $q10HasData == 1 ? true : false;
                $q10r2Checked = $q10HasData == 0 ? true : false;
                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">10.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you the beneficiary of any estates or trusts?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box21'
                    fieldNameNo='Check Box22'
                    r1Value='Yes'
                    r2Value='Yes'
                    :r1Checked="$q10r1Checked"
                    :r2Checked="$q10r2Checked"
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">11.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Are you the trustee or settlor of any trusts?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box23'
                    fieldNameNo='Check Box24'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        
        <?php
                    $q12Data = Helper::validate_key_value('tax_refunds', $financial_assests);
                $q12HasData = Helper::validate_key_value('type_value', $q12Data, 'radio');
                $q12r1Checked = false;
                $q12Nature = '';
                if ($q12HasData == 1) {
                    $currentYear = (int)date('Y');
                    $targetYears = [
                        (string)($currentYear - 2),
                        (string)($currentYear - 3)
                    ];

                    $descriptionsToCheck = [
                        "Federal tax refund (IRS)",
                        "State tax refund"
                    ];

                    foreach ($descriptionsToCheck as $desc) {
                        $index = array_search($desc, $q12Data['description']);
                        if ($index !== false) {
                            $yearString = $q12Data['year'][$index];
                            $years = explode(' ', $yearString);

                            $foundYears = array_intersect($targetYears, $years);
                            if (!empty($foundYears)) {
                                $q12r1Checked = true;
                            }
                        }
                    }
                }
                $q12r2Checked = $q12r1Checked ? false : true;
                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">12.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you filed federal and state income tax returns for the 2 years before your bankruptcy filing?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box25'
                    fieldNameNo='Check Box26'
                    r1Value='Yes'
                    r2Value='Yes'
                    :r1Checked="$q12r1Checked"
                    :r2Checked="$q12r2Checked"
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">13.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that any tax refunds due to you at the time of your bankruptcy filing may be
                    required to be turned over to your Chapter 7 trustee?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box27'
                    fieldNameNo='Check Box28'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">14.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that you must provide your Chapter 7 trustee with a copy of your federal and
                    state tax returns for the tax year that includes the date of your bankruptcy filing? (Example: If
                    you filed your bankruptcy petition on February 2, 2022, you must provide copies of your 2022
                    federal and state tax returns when you file them in 2023)') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box29'
                    fieldNameNo='Check Box30'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">15.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Do you understand that any tax refund due to you for the year that includes the date of your
                    bankruptcy filing may be required to be turned over to your Chapter 7 trustee? Your trustee will
                    return to you any portion of the refund to which you are entitled.') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box31'
                    fieldNameNo='Check Box32'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">16.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('In the 12 months before filing your bankruptcy petition, did you fully or partially repay any
                    family members, friends, or relatives on any loans?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box33'
                    fieldNameNo='Check Box34'
                    r1Value='Yes'
                    r2Value='Yes'
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
            </div>
        </div>
        <div class="d-flex pl-4">
            <div>
                <label for="">17.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('In the 12 months before filing your bankruptcy petition, did you transfer any assets or money to
                    family members, friends, or relatives?') }}
                </p>
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
                    $q18r1Checked = !empty($propertyvehicle) ? true : false;
                $q18r2Checked = !empty($propertyvehicle) ? false : true;
                ?>
        <div class="d-flex pl-4">
            <div>
                <label for="">18.</label>
            </div>
            <div class="pl-3">
                <p class=" p_justify mb-1">
                    {{ __('Have you purchased a vehicle or refinanced a vehicle loan in the 6 months prior to your
                    bankruptcy filing?') }}
                </p>
                <x-officialForm.TrusteeFormCheckYesNo
                    fieldNameYes='Check Box37'
                    fieldNameNo='Check Box38'
                    r1Value='Yes'
                    r2Value='Yes'
                    :r1Checked="$q18r1Checked"
                    :r2Checked="$q18r2Checked"
                    >
                </x-officialForm.TrusteeFormCheckYesNo>
                <p class="mt-3 text-bold">{{ __('I declare under penalty of perjury that the above information is true and correct.') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-1 mt-3">
        <label class="mt-2">{{ __('Debtor 1:') }}</label>
    </div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="[Signature]"
            inputFieldName="text17"
            inputValue={{$debtor_sign}}></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="text18"
            currentDate={{$currentDate}}></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-1 mt-2">
        <label class="mt-2">{{ __('Debtor 2:') }}</label>
    </div>
    <div class="col-md-5 mt-2 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="[Signature]"
            inputFieldName="text19"
            inputValue={{$debtor2_sign}}></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-2">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="text20"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
</div>