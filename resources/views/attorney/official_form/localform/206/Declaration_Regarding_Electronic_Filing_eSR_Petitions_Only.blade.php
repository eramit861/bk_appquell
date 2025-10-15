<div class="row">
    <div class="col-md-12 border_1px bb-0 p-2 pl-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW JERSEY') }}</h3>
    </div>

    <div class="col-md-6 border_1px bb-0 p-3 br-0">
        <div class="row">
            <div class="col-md-4 p-2 pl-3">
                <label>{{ __('Name of Debtor(s):') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('Debtor1');?>" type="text" class="form-control" value="{{$onlyDebtor}}">
                <input name="<?php echo base64_encode('Debtor2');?>" type="text" class="form-control mt-1" value="{{$spousename}}">
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px bb-0 p-3">
        <div class="row">
            <div class="col-md-4">
                <label for="">{{ __('Case Number (If known):') }}</label>
            </div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('Case number1');?>" type="text" class="form-control w-auto" value="{{$caseno}}"> 
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-md-4">
                <label for="">{{ __('Chapter:') }}</label>
            </div>
            <div class="col-md-8">
                <select name="<?php echo base64_encode('Chapter');?>" class="form-control width_auto">
                    <option value=" "></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-6 border_1px bt-0 p-3 br-0">
        <label class="float_right">{{ __('Debtor(s).') }}</label>
    </div>
    <div class="col-md-6 border_1px p-3">
        <h3 class="text-center">DECLARATION REGARDING<br>{{ __('ELECTRONIC FILING') }}<br>{{ __('(SELF-REPRESENTED INDIVIDUAL)') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <label>1.</label>
            <div class="pl-3">
                <p>{{ __('I (we) have completed the following documents using the Court’s Electronic Filing program for self-represented debtors:') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-3">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box1');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Voluntary Petition for Individuals Filing for Bankruptcy (Official Form B101)') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box2');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Chapter 7 Statement of Your Current Monthly Income (Official Form B122A-1)') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-3">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box3');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Your Statement of Financial Affairs for Individuals Filing for Bankruptcy (Official Form B107)') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box4');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Statement of Exemption from Presumption of Abuse Under §707(b)(2) (Chapter 7 only) (Official Form B122A-1Supp)') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-3">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box5');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __("Declaration About an Individual Debtor's Schedules (Official Form B106)") }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box6');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Chapter 7 Means Test (Official Form B122A-2)') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-3">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box7');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Statement of Intention for Individuals Filing Under Chapter 7 (Official Form B108)') }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box8');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Chapter 13 Statement of Your Current Monthly Income and Calculation of Commitment (Official Form B122C-1)') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6 pl-3"></div>
    <div class="col-md-6">
        <div class="d-flex pl-3">
            <span><input name="<?php echo base64_encode('Check Box9');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
            <div class="pl-3">
                <p>{{ __('Chapter 13 Calculation of Your Disposable Income (Official Form B122C-2)') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="d-flex">
            <label>2.</label>
            <div class="pl-3">
                <p>{{ __('Declaration of Petitioner:') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="d-flex pl-4">
            <span>a.</span>
            <div class="pl-3">
                <p>{{ __('To be completed in all cases.') }}</p>
            </div>
        </div>
        <p class="p_justify">
            {{ __('I(we), the undersigned Debtor(s) hereby declare under penalty of perjury that: (1) I(we) have read and understand the above-
            referenced document(s) being filed electronically (“Voluntary Petition”); (2) the information contained in the petition, statements
            and schedules, lists, and disclosures is true and correct, to the best of my knowledge and belief; and (3) I (we) have authorized
            the electronic filing of the Voluntary Petition with the United States Bankruptcy Court District of New Jercsey .
            I further declare under penalty of perjury that I (we) have completed and signed Your Statement about Your Social Security
            Number(s) (Official Form B121) and provided the signed original(s) to the Clerk. I (we) understand that this DECLARATION
            Regarding Electronic Filing must be filed with the Clerk in addition to the petition.') }}
        </p>
        <div class="d-flex pl-4">
            <span>b.</span>
            <div class="pl-3">
                <p> {{ __('To be checked and applicable only if the petitioner is an individual (or individuals) whose debts are primarily
                    consumer debts and who has (or have) chosen to file under chapter 7.') }}</p>
                <div class="d-flex">
                    <span><input name="<?php echo base64_encode('Check Box10');?>" value="Yes" type="checkbox" class="form-control width_auto"></span>
                    <div class="pl-3">
                        <p> {{ __('To be checked and applicable only if the petitioner is an individual (or individuals) whose debts are primarily
                            consumer debts and who has (or have) chosen to file under chapter 7.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <p class="p_justify">
        {{ __('I understand that failure to file the signed original of this Declaration is grounds for dismissal of my case pursuant to 11 U.S.C. §§ 707(a) and 105.') }}
        </p>
    </div>

    <div class="col-md-4">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date1"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor's Name"
            inputFieldName="Debtor1"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor's Signature"
            inputFieldName="txt2.1"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-4 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor's Name"
            inputFieldName="Debtor2"
            inputValue={{$spousename}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor's Signature"
            inputFieldName="txt2.2"
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>


</div>