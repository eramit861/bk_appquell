<div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('Northern District of Illinois') }}</h3>
    </div>
<div class="row border_1px bb-0 mt-3">
    <div class="col-md-6 border_right_1px">
        <div class="row mt-3">
            <div class="col-md-3">
                <label>{{ __('Name of Debtor(s):') }}</label>
            </div>
            <div class="col-md-9">
                <input name="<?php echo base64_encode('Debtor1'); ?>" type="text" value="{{$onlyDebtor}}" class="form-control">
                <input name="<?php echo base64_encode('Debtor2'); ?>" type="text" value="{{$spousename}}" class="form-control mt-2">
            </div>
        </div> 
    </div>
    <div class="col-md-6">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case number (If known):"
                casenoNameField="Case number1"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="row mb-3">
            <div class="col-md-3 pt-3">
                <label>{{ __('Chapter:') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Chapter'); ?>" class="form-control width_auto mt-2">
                    <option value="Yes"></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                </select>
            </div>
        </div>
    </div>
</div>
<div class="row border_1px bt-0">
    <div class="col-md-6 border_right_1px">
        <p class="float_right">{{ __('Debtor(s).') }}</p>
    </div>
    <div class="col-md-6 border_top_1px">
       <div class="text-bold text-center pt-3">
            <p>{{ __('DECLARATION REGARDING') }}<br>
            ELECTRONIC FILING<br>
            {{ __('(SELF-REPRESENTED INDIVIDUAL)') }}</p>
        </div>
    </div>
</div>

<div class="pt-3">
   <p><span class="pr-2">1.</span>{{ __('I (we) have completed the following documents using the Court’s Electronic Filing program for self-representeddebtors:') }}</p>
</div>

<div class="row">
   <div class="col-md-6">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
        <label>{{ __('Voluntary Petition for Individuals Filing for Bankruptcy (Official Form B101)') }}</label>
    </div>
    <div class="col-md-6">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box2'); ?>" value="Yes">
        <label>{{ __('Chapter 7 Statement of Your Current Monthly Income (Official Form B122A-1)') }}</label>
    </div>
</div>
<div class="row">
   <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box3'); ?>" value="Yes">
        <label>{{ __('Statement of Financial Affairs for Individuals Filing for Bankruptcy (Official Form B107)') }}</label>
    </div>
    <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box4'); ?>" value="Yes">
        <label>{{ __('Statement of Exemption from Presumption of Abuse Under §707(b)(2) (Chapter 7 only) (Official Form B122A-1Supp)') }}</label>
    </div>
</div>
<div class="row">
   <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes">
        <label>{{ __('Declaration About an Individual Debtor’s Schedules (Official Form B106)') }}</label>
    </div>
    <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
        <label>{{ __('Chapter 7 Means Test (Official Form B122A-2)') }}</label>
    </div>
</div>
<div class="row">
   <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
        <label>{{ __('Statement of Intention for Individuals Filing Under Chapter 7 (Official Form B108)') }}</label>
    </div>
    <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box8'); ?>" value="Yes">
        <label>{{ __('Chapter 13 Statement of Your Current Monthly Income and Calculation of Commitment (Official Form B122C-1)') }}</label>
    </div>
</div>
<div class="row">
   <div class="col-md-6 mt-2">
    </div>
    <div class="col-md-6 mt-2">
        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box9'); ?>" value="Yes">
        <label>{{ __('Chapter 13 Calculation of Your Disposable Income (Official Form B122C-2)') }}</label>
    </div>
</div>
<div class="pt-3">
   <p><span class="pr-2">2.</span>{{ __('Declaration of Petitioner:') }}</p>
</div>     
<div class="d-flex pt-3 pl-5">
   <span class="pr-2">a.</span>
    <div>
       <p>{{ __('To be completed in all cases.') }}</p>
    </div>
</div>
<p>{{ __('I(we), the undersigned Debtor(s) hereby declare under penalty of perjury that: (1) I(we) have read and understand the above-referenced document(s) being filed electronically (“Voluntary Petition”); (2) the information contained in the petition, statements and schedules, lists, and disclosures is true and correct, to the best of my knowledge and belief; and (3) I (we) have authorized the electronic filing of the Voluntary Petition with the United States Bankruptcy Court, Northern District of Illinois. I further declare under penalty of perjury that I (we) have completed and signed Statement About Your Social Security Number(s) (Official Form B121) and provided the signed original(s) to the Clerk. 
   I (we) understand that this DECLARATION Regarding Electronic Filing must be filed with the Clerk in addition to the petition.') }}</p>
<div class="d-flex pt-3 pl-5">
    <span class="pr-2">b.</span>
    <div>
        <p>{{ __('To be checked and applicable only if the petitioner is an individual (or individuals) whose debts are primarilyconsumer debts and who has (or have) chosen to file under chapter 7.') }}</p>
        <div class="d-flex">
            <!-- checked by default -->
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box10'); ?>" value="Yes" checked="true">
            <div>
                <label>{{ __('I(we) am (are) aware that I(we) may proceed under chapter 7, 11, 12, or 13 of Title 11 United States Code; I(we) understand the relief available under each such chapter; I(we) choose to proceed under chapter 7; and I(we) request relief in accordance with chapter 7.') }}</label>
            </div>
        </div>
    </div>
</div> 
<div class="mt-3">
    <p>{{ __('I understand that failure to file the signed original of this Declaration is grounds for dismissal of my case pursuant to 11
    U.S.C. §§ 707(a) and 105') }}</p>
</div>
<div class="row mt-3">
    <div class="col-md-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date1"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle> 
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="Debtor’s Name"
            signNameField="Debtor1"
            sign={{$onlyDebtor}}>
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="Debtor’s Signature"
            signNameField="Text1"
            sign={{$debtor_sign}}>
        </x-officialForm.signVertical>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle> 
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="Joint Debtor’s Name"
            signNameField="Debtor2"
            sign={{$spousename}}>
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="Joint Debtor’s Signature"
            signNameField="Text2"
            sign={{$debtor2_sign}}>
        </x-officialForm.signVertical>
    </div>
</div>