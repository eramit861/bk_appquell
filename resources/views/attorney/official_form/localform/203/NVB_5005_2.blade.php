<div class="row">

    <div class="col-md-12 mt-3">
        <textarea name="<?php echo base64_encode('Attyname');?>" class="form-control" rows="7">
            {{$atroneyName}}
            {{$attonryAddress1}}, {{$attonryAddress2}}
            {{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
            Phone: {{$attorneyPhone}}, Fax No. {{$attorneyFax}} & Bar # {{$attorney_state_bar_no}}
            {{$attorney_email}}
    </textarea>
        <label for="">{{ __('Name, Address, Telephone No., Bar Number, Fax No. & E-mail address') }}</label>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEVADA') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re:') }}</label>
        <div class="input-group text-center">
            <textarea name="<?php echo base64_encode('Debtor');?>" value="" class=" form-control" rows="2" style="padding-right:5px;">{{$debtorname}}</textarea>
            <label class="">{{ __('Debtor.') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="">
            <x-officialForm.caseNo
                labelText="BK."
                casenoNameField="CaseNum"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="row mt-2">
            <div class="col-md-3 pt-2">
                <label>{{ __('Chapter:') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Chapter');?>" class="form-control w-auto">
                    <option value=""></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                </select>
            </div>
        </div>
        <div class="mt-3">
            <p class="text-bold mb-0">{{ __('DECLARATION RE: ELECTRONIC
            FILING OF PETITION, STATEMENTS 
            AND PLAN (if applicable)') }}</h3>
        </div>
    </div>

    <div class="mt-3 col-md-12">
        <h3>{{ __('PART I-DECLARATION OF PETITIONER') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify">
            I [We] 
            <input type="text" name="<?php echo base64_encode('Pet1');?>" value="{{$onlyDebtor}}" class="form-control width_30percent  ">
            and 
            <input type="text" name="<?php echo base64_encode('Pet2');?>" value="{{$spousename}}" class="form-control width_30percent  ">
            {{ __(', the
            undersigned debtor(s) hereby declare under penalty of perjury that the information I have given my
            attorney and the information provided in the electronically filed petition, statements, schedules,
            amendments and plan (if applicable) as indicated above is true and correct. I consent to my
            attorney filing my petition, this declaration, statements, schedules and plan (if applicable) as
            indicated above to the United States Bankruptcy Court. I understand that this DECLARATION:
            RE ELECTRONIC FILING is to be filed with the Clerk once all schedules have been filed
            electronically but, in no event, no later than 14 days following the date the petition was
            electronically filed. I understand that failure to file the signed original of this DECLARATION
            will cause my case to be dismissed pursuant to 11 U.S.C. § 707 (a)(3) without further notice.') }}
        </p>
        <p class="p_justify">
            <input type="checkbox" name="<?php echo base64_encode('check1');?>" value="Yes" class="form-control w-auto  ">
            {{ __('If petitioner is an individual whose debts are primarily consumer debts and has chosen to file
            under chapter 7 or 13. I am aware that I may proceed under chapter 7, 11, 12 or 13 of 11 United
            States Code, understand the relief available under each such chapter, and choose to proceed under
            chapter 7 or 13. I request relief in accordance with the chapter specified in this petition.') }}
        </p>
        <p class="p_justify">
            <input type="checkbox" name="<?php echo base64_encode('check2');?>" value="Yes" class="form-control w-auto  ">
            {{ __('[If petitioner is a corporation or partnership] I declare under penalty of perjury that the
            information provided in this petition is true and correct, and that I have been authorized to file this
            petition on behalf of the debtor. The debtor requests relief in accordance with the chapter specified
            in this petition.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-1 mt-3">
        <label for="">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Applicant"
            inputFieldName="Debtorsig"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-5 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Applicant"
            inputFieldName="JtDebtor"
            inputValue="{{$debtor2_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-1 mt-1"></div>

    <div class="mt-3 col-md-12">
        <h3>{{ __('PART II-DECLARATION OF ATTORNEY') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify">
            {{ __('I, the attorney for the petitioner named in the foregoing petition, declare that I have informed the
            petitioner that [he or she] may proceed under chapter 7, 11, 12, or 13 of 11 United States Code, and
            have explained the relief available under each such chapter.') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Attydate"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    
    <div class="col-md-1 mt-1">
        <label for="">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-5 mt-1 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor(s)"
            inputFieldName="AttySig"
            inputValue={{$attorny_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-1"></div>
</div>