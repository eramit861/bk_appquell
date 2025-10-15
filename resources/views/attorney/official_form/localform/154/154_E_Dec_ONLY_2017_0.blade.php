<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF LOUISIANA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
       <label> {{ __('IN RE:') }} </label>
       <textarea name="<?php echo base64_encode('Text1'); ?>"  class="form-control mt-1" rows="3">{{$debtorname}}</textarea>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="BANKRUPTCY NO."
            casenoNameField="Text2"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-3">
         {{ __('DECLARATION RE: ELECTRONIC FILING') }}<br>{{ __('OF PETITION, SCHEDULES, & STATEMENTS') }}
         </h3>
         <p>
            {{ __('PART I - DECLARATION OF PETITIONER(S)') }}
        </p>
         <p class="mb-3 p_justify mt-2">
            <span class="pl-4"></sapn>
            {{ __('I [We]') }} <input type="text" name="<?php echo base64_encode('Text3'); ?>" value="{{$onlyDebtor}}" class="form-control width_30percent">
            {{ __('and') }} <input type="text" name="<?php echo base64_encode('Text4'); ?>" value="{{$spousename}}" class="form-control width_30percent">
            {{ __('the undersigned debtor(s)') }}, <span class="text-bold text_italic"> {{ __('hereby declare under penalty of perjury') }} </span> {{ __('that the information I have given my attorney and the information provided
            in the electronically filed petition, statements, and schedules is true and correct. I consent to my attorney sending my petition, this declaration,
            statements and schedules to the United States Bankruptcy Court. I understand that this DECLARATION RE: ELECTRONIC FILING is to be
            filed with the Clerk no later than forty-eight (48) hours following the date the petition was electronically filed, and all schedules and statements
            are to be filed no later than fourteen (14) days following the date the petition was electronically filed. I understand that the original of this
            DECLARATION RE: ELECTRONIC FILING OF PETITION, SCHEDULES, & STATEMENTS will be maintained by the Clerk of Court.
            I further understand that failure to file the signed original of the DECLARATION will cause my case to be dismissed pursuant to F.R.B.P.
            without further notice.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            <!-- checked by default -->
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" checked>
            {{ __('[If petitioner is an individual whose debts are primarily consumer debts and has chosen to file under chapter 7] I am aware that I
            may proceed under chapter 7, 11, 12 or 13 of 11 United States Code, understand the relief available under each such chapter, and choose to
            proceed under chapter 7. I request relief in accordance with the chapter specified in this petition.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
            {{ __('[If petitioner is a corporation or partnership] I declare under penalty of perjury that the information provided in this petition is
            true and correct, and that I have been authorized to file this petition on behalf of the debtor. The debtor requests relief in accordance with the
            chapter specified in this petition.') }}
        </p>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode(''); ?>" class="form-control"  value="{{$debtor_sign}}">
        <label>Signed:<span class="text-bold"> {{ __('Debtor') }} </span></label>
    </div>
    <div class="col-md-2 text-bold">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField=""
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode(''); ?>" class="form-control" value="{{$debtor2_sign}}">
        <label>Signed: <span class="text-bold"> {{ __('Joint Debtor') }} </span></label>
    </div>
    <div class="col-md-2 text-bold">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField=""
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>

    <div class="col-md-12 mt-4 mb-3">
        <p>{{ __('PART II - DECLARATION OF ATTORNEY') }}</p>
        <p><span class="pl-4"></span> I <span class="text_italic text-bold">{{ __('declare under penalty of perjury that') }}</span>
        {{ __('that I have reviewed the above debtor’s petition and that the information is complete and correct
        to the best of my knowledge. The debtor(s) will have signed this form before I submit the petition, schedules, and statements. I will give the
        debtor(s) a copy of all forms and information to be filed with the United States Bankruptcy Court. I further declare that I have examined the
        above debtor’s petition, schedules, and statements and, to the best of my knowledge and belief, they are true, correct, and complete. If an
        individual, I declare that I have informed the petitioner that [he, she or they] may proceed under chapter 7, 11, 12 or 13 of Title 11, United States
        Code, and have explained the relief available under each such chapter. This declaration is based on all information of which I have knowledge.') }}</p>
    </div>

    <div class="col-md-3">
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode(''); ?>" class="form-control" value="{{$attorny_sign}}">
        <label>Signed: <span class="text-bold"> {{ __('Attorney for Debtor(s)') }} </span></label>
    </div>
    <div class="col-md-2 text-bold">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField=""
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-12 mt-3">
       <p>{{ __('Joint debtors must provide information for both spouses. Penalty for making a false statement: Fine of up to $250,000 or up to 5
        years imprisonment or both. 18 U.S.C. §§ 152 and 3571.') }}</p>
    </div>

</div>