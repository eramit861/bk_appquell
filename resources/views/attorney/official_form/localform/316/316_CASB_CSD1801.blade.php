<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('1801Attorney'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
            </div>
            <div class="col-md-6 mt-3" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 text-center" style="border-top:3px solid #000;">
                <label><strong>{{ __('UNITED STATES BANKRUPTCY COURT') }}</strong></label><br>
                <label>{{ __('SOUTHERN DISTRICT OF CALIFORNIA') }}</label><br>
                <label>{{ __('325 West F Street, San Diego, California 92101-6991') }}</label>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000;">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6" style="border-top:3px solid #000; border-bottom:3px solid #000;">
                <label>{{ __('In Re') }}</label>
                <textarea style="margin-right:40px" name="<?php echo base64_encode('1801Debtor'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                <label style="" >{{ __('Debtor.') }}</label>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                    <label>{{ __('BANKRUPTCY NO.') }}</label>
                    <input name="<?php echo base64_encode('1801BkNo'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('DECLARATION RE: ELECTRONIC FILING OF') }} <br>{{ __('PETITION, SCHEDULES & STATEMENTS') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('PART I - DECLARATION OF PETITIONER') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        {{ __('I [We]') }}
            <input name="<?php echo base64_encode('1801Db'); ?>" value="{{$onlyDebtor}}" style="width: 40%;" type="text" class="form-control">
            {{ __('and') }}
            <input name="<?php echo base64_encode('1801JtDebtor'); ?>" value="{{$spousename}}" style="width: 40%;" type="text" class="form-control">
            , {{ __('the debtor(s)') }}, 
            <strong>{{ __('hereby declare under penalty of perjury') }}</strong> {{ __('that the information I have given my attorney and the information
            provided in the electronically filed petition, statements, and schedules is true and correct. I consent to my attorney sending
            my petition, this declaration, statements and schedules to the United States Bankruptcy Court. I understand that this') }}
            <strong>{{ __('Declaration Re: Electronic Filing') }}</strong> {{ __('is to be filed with the Clerk once all schedules have been filed electronically but, in no 
            event, no later than 14 days following the date the petition was electronically filed. I understand that failure to file the
            signed original of this') }} <strong>{{ __('Declaration') }}</strong> {{ __('will cause my case to be dismissed pursuant to 11 U.S.C. §707(a)(3) without further 
            notice.') }}
        </p>
    </div>
    <div class="col-md-12 mt-3">
        <p class="input-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="<?php echo base64_encode('1801ChBox1'); ?>" value="1" type="checkbox">
                {{ __('[If petitioner is an individual whose debts are primarily consumer debts and has chosen to file under chapter 
                7] I am aware that I may proceed under chapter 7, 11, 12 or 13 of 11 United States Code, understand the relief available
                under each such chapter, and choose to proceed under chapter 7. I request relief in accordance with the chapter
                specified in this petition.') }}
        </p>
    </div>
    <div class="col-md-12 mt-3">
        <p class="input-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input name="<?php echo base64_encode('1801ChBox1'); ?>" value="2" type="checkbox">
                {{ __('[If petitioner is a corporation or partnership] I declare under penalty of perjury that the information provided
                in this petition is true and correct, and that I have been authorized to file this petition on behalf of the debtor. The debtor
                requests relief in accordance with the chapter specified in this petition') }}
        </p>
    </div>
    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('1801Date1'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
        <div class="input-group col-md-6"></div>
    </div>
    <div class="row col-md-12 mt-10">
        <div class="input-group col-md-4"></div>
        <div class="input-group col-md-8 d-flex">
            <label>{{ __('Signed') }}</label>
            <div class="input-group col-md-6">
                <input readonly name="<?php echo base64_encode('Text7'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
                <label>{{ __('*(Debtor)') }}</label>
            </div>
            <div class="input-group col-md-6">
                <input readonly name="<?php echo base64_encode('Text8'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
                <label>{{ __('*(Joint Debtor)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <p class="text-center">
        {{ __('*If filed electronically, pursuant to LBR 5005-4(C), the original debtor
            signature(s) in a scanned format is required.') }}
        </p>
    </div>
    
    
    <div class="col-md-12 mt-3">
        <p class="input-group">
            {{ __('PART II - DECLARATION OF ATTORNEY') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="input-group">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            I <strong>{{ __('declare under penalty of perjury') }}</strong> {{ __('that I have informed the petitioner, if an individual, that [he or she] may proceed
            under chapter 7, 11, 12 or 13 of Title 11, United States Code, and have explained the relief available under each such
            chapter. I further certify that I have delivered to the debtor the notice required by 11 U.S.C. §342(b). In a case in which §
            707(b)(4)(D) applies, this signature also constitutes a certification that I have no knowledge after an inquiry that the 
            information in the schedules is incorrect.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('1801Date2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
        <div class="input-group col-md-6"></div>
    </div>
    <div class="row col-md-12 mt-10">
        <div class="input-group col-md-6"></div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('1801AttySign'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label>{{ __('Attorney for Debtor(s)') }}</label>
        </div>
    </div>    

    <div class="col-md-12 mt-3">
         
    </div>

</div>