<div class="row">
    <div class="col-md-12 " style="border:1px solid #000;border-bottom:none;">
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-grpup">
                    <label>{{ __('Attorney or Party Name, Address, Telephone & FAX Nos., State Bar No. & Email Address') }}</label>
                    <textarea name="<?php echo base64_encode('TextPg1a'); ?>" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
                </div>
                <div class="input-group">
                    <input name="<?php echo base64_encode('Group1'); ?>" value="0" type="checkbox">
                    <label for="">
                        <i>{{ __('Individual appearing without attorney') }}</i>
                    </label>
                </div>
                <div class="input-group d-flex">
                    <input name="<?php echo base64_encode('Group1'); ?>" checked="checked" value="Choice1" type="checkbox">
                    <label for="" style="width:170px;margin-top:6px;">
                        <i>{{ __('Attorney for Debtor') }}</i>
                    </label>
                    <input name="<?php echo base64_encode('Attorney'); ?>" type="text" class="form-control">
                </div>
            </div>
            <div class="col-md-6 p-3 border_left_1px">
                <span>{{ __('FOR COURT USE ONLY') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12 border_1px p-3 text-center">
        <p class="mb-0"> {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF CALIFORNIA -') }} 
            <select  name="<?php echo base64_encode('Dropdown1'); ?>" class="division_select form-control w-auto">
                <option value="**SELECT DIVISION**" >{{ __('**SELECT DIVISION**') }}</option>
                <option value="LOS ANGELES DIVISION" >{{ __('LOS ANGELES DIVISION') }}</option>
                <option value="RIVERSIDE DIVISION" >{{ __('RIVERSIDE DIVISION') }}</option>
                <option value="SANTA ANA DIVISION" >{{ __('SANTA ANA DIVISION') }}</option>
                <option value="NORTHERN DIVISION" >{{ __('NORTHERN DIVISION') }}</option>
                <option value="SAN FERNANDO VALLEY DIVISION" >{{ __('SAN FERNANDO VALLEY DIVISION') }}</option>
            </select>
        </p>
    </div>
    <div class="col-md-12 border_1px bt-0">
        <div class="row">
            <div class="col-md-6 p-3 border_right_1px">
                <div class="input-grpup">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextPg1b'); ?>"  class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                </div> {{ __('Debtor(s).') }}
            </div>
            <div class="col-md-6 p-3">
                <x-officialForm.caseNo
                    labelText="CASE NO.:"
                    casenoNameField="Case"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
                <div class="row mt-3">
                    <div class="col-md-3 pt-2">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="col-md-9">
                        <select name="<?php echo base64_encode('Dropdown2'); ?>" class="form-control w-auto">
                            <option value="**SELECT CASE #**">**SELECT CASE**</option>
                            <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> >7</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?> >13</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 mt-3 text-center border_top_1px">
                    <h3 class="mt-3">{{ __('SUMMARY OF AMENDED SCHEDULES') }}, <br> {{ __('MASTER MAILING LIST,') }} <br> {{ __('AND/OR STATEMENTS') }} <br> {{ __('[LBR 1007-1(c)]') }} </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('A filing fee is required to amend Schedules D or E/F (see') }} <a href="http://www.cacb.uscourts.gov/filing-fees" target="_blank">{{ __('Abbreviated Fee Schedule') }}</a> on the Court’s website <a href="http://www.cacb.uscourts.gov" target="_blank"> www.cacb.uscourts.gov</a>{{ __('). A supplemental master mailing list (do not repeat any creditors on the original) is required as an attachment if creditors are being added to the Schedule D or E/F.') }} </p>
        <p class="">
        {{ __('Are one or more creditors being added?') }} 
            <input name="<?php echo base64_encode('Group2'); ?>" value="0" type="checkbox">{{ __('Yes') }}  
            <input name="<?php echo base64_encode('Group2'); ?>" value="1" type="checkbox">{{ __('No') }} 
        </p>
    </div>
    <div class="col-md-12">{{ __('The following schedules, master mailing list or statements (check all that apply) are being amended:') }}</div>
    <div class="col-md-12 float-left">
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule A/B') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box4'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule C') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule D') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box6'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule E/F') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box7'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule G') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box8'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule H') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box9'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule I') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box10'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule J') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box11'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Schedule J-2') }}</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('Check Box12'); ?>" value="Yes" type="checkbox">
            <label for="" style="font-size:11px"> {{ __('Statement of Financial Affairs') }}</label>
        </div>
        <div class="input-group" style="width:40%">
            <input name="<?php echo base64_encode('Check Box13'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Statement About Your Social Security Numbers') }}</label>
        </div>
        <div class="input-group" style="width:20%">
            <input name="<?php echo base64_encode('Check Box14'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Statement of Intention') }}</label>
        </div>
        <div class="input-group" style="width:40%">
            <input name="<?php echo base64_encode('Check Box15'); ?>" value="Yes" type="checkbox">
            <label for="">{{ __('Master Mailing List') }} </label>
        </div>
        <div class="input-group d-flex" style="width:100%">
            <input name="<?php echo base64_encode('Check Box16'); ?>" value="Yes" type="checkbox">
            <label for="" style="width:180px;margin-top:7px;">{{ __('Other (specify)') }} </label>
            <input name="<?php echo base64_encode('Other'); ?>"  type="text" class=" form-control">
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p class="">{{ __('I/we declare under penalty of perjury under the laws of the United States that the amended schedules, master mailing list, and or statements are true and correct') }}</p>
    </div>
    <div class="col-md-3">
        <div class="input-group">
            <label for="">{{ __('Date:') }}</label>
            <input value="{{$currentDate}}" name="<?php echo base64_encode('DatePg1a'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" class="date_filed form-control">
        </div>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('SignaturePg1a'); ?>" type="text" class="form-control" value="<?php echo $debtor_sign;?>">
            <br>
            <label>{{ __('Debtor 1 Signature') }}</label>
        </div>
        <div class="input-group ml-30 w100">
            <input name="<?php echo base64_encode('SignaturePg1b'); ?>" type="text" class="form-control" value="<?php echo $debtor2_sign;?>">
            </br>
            <label>{{ __('Debtor 2 (Joint Debtor) Signature (if applicable)') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <strong>{{ __('NOTE:') }}</strong> {{ __('It is the responsibility of the Debtor, or the Debtor’s attorney, to serve copies of all amendments on all creditors listed in this Summary of Amended Schedules, Master Mailing List, and/or Statements, and to complete and file the attached Proof of Service of Document') }}
    </div>
    <div class="col-md-12 mt-3 text-center">
        <h3>{{ __('PROOF OF SERVICE OF DOCUMENT') }}</h3>
    </div>
    <div class="col-md-12 mt-3">
        <p class="mt-3">{{ __('I am over the age of 18 and not a party to this bankruptcy case or adversary proceeding. My business address is:') }}</p>
        <textarea name="<?php echo base64_encode('Address'); ?> "rows="5" class="form-control"></textarea>
        <p>{{ __('A true and correct copy of the foregoing document entitled (specify):') }} <strong>{{ __('SUMMARY OF AMENDED SCHEDULES, MASTER MAILING LIST, AND/OR STATEMENTS [LBR 1007-1(c)]') }}</strong> {{ __('will be served or was served (a) on the judge in chambers in the form and manner required by LBR 5005-2(d); and (b) in the manner stated below:') }} </p>
        <p class="mt-3 d-inline">
            <strong>1. <span class="underline">{{ __('TO BE SERVED BY THE COURT VIA NOTICE OF ELECTRONIC FILING (NEF):') }}</span>
            </strong> {{ __("Pursuant to controlling General Orders and LBR, the foregoing document will be served by the court via NEF and hyperlink to the document. On") }}<i>{{ __("(date)") }}</i>
            <input name="<?php echo base64_encode('POS Date 1'); ?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" value="{{$currentDate}}" style="width:152px;" class="form-control date-filed  mw100">{{ __(', I checked the CM/ECF docket for this bankruptcy case or adversary proceeding and determined that the following persons are on the Electronic Mail Notice List to receive NEF transmission at the email addresses stated below:') }}
        </p>
        <textarea name="<?php echo base64_encode('Emails'); ?>"  rows="6" class="form-control"></textarea>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-5">
        <div class="input-group">
            <input name="<?php echo base64_encode('POS1a'); ?>" value="Yes" type="checkbox" class="">
            <label>{{ __('Service information continued on attached page') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>
            <strong>2. <span class="underline"> {{ __('SERVED BY UNITED STATES MAIL:') }}</span>
            </strong> On <i>{{ __('(date)') }}</i>
            <input name="<?php echo base64_encode('POS Date 2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" value="{{$currentDate}}"  type="text" style="width:152px;" class="form-control date-filed  mw100">, I served the following persons and/or entities at the last known addresses in this bankruptcy case or adversary proceeding by placing a true and correct copy thereof in a sealed envelope in the United States mail, first class, postage prepaid, and addressed as follows. Listing the judge here constitutes a declaration that mailing to the judge <span class="underline">{{ __('will be completed') }}</span> {{ __('no later than 24 hours after the document is filed.') }}
        </p>
        <textarea name="<?php echo base64_encode('Judge'); ?>"  rows="6" class="form-control"></textarea>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-5">
        <div class="input-group">
            <input name="<?php echo base64_encode('POS2a'); ?>" value="Yes" type="checkbox" class="">
            <label>{{ __('Service information continued on attached page') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>
            <strong>3. <span class="underline"> {{ __('SERVED BY PERSONAL DELIVERY, OVERNIGHT MAIL, FACSIMILE TRANSMISSION OR EMAIL') }}</span>
            </strong>
            <span class="underline"> {{ __('(state method for each person or entity served)') }}:</span> {{ __('Pursuant to F.R.Civ.P. 5 and/or controlling LBR, on') }} <i>{{ __('(date)') }}</i>
            <input name="<?php echo base64_encode('POS date 3'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" value="{{$currentDate}}" type="text" style="width:152px;" class="form-control date-filed mw100">, {{ __('I served the following persons and/or entities by personal delivery, overnight mail service, or (for those who consented in writing to such service method), by facsimile transmission and/or email as follows. Listing the judge here constitutes a declaration that personal delivery on, or overnight mail to, the judge') }} <span class="underline">{{ __('will be completed') }}</span> {{ __('no later than 24 hours after the document is filed.') }}
        </p>
        <textarea name="<?php echo base64_encode('Persons'); ?>"  rows="6" class="form-control"></textarea>
    </div>
    <div class="col-md-7"></div>
    <div class="col-md-5">
        <div class="input-group">
            <input name="<?php echo base64_encode('POS3a'); ?>" value="Yes" type="checkbox" class="">
            <label>{{ __('Service information continued on attached page') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('I declare under penalty of perjury under the laws of the United States that the foregoing is true and correct.') }}</p>
    </div>
    <div class="col-md-2">
        <input name="<?php echo base64_encode('POS date 4'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        <br>{{ __('Date') }}
    </div>
    <div class="col-md-5">
        <input name="<?php echo base64_encode('Printed NamePg12'); ?>" type="text" class="form-control" value="<?php echo $onlyDebtor;?>">
        <br>{{ __('Printed Name') }}
    </div>
    <div class="col-md-5">
        <input name="<?php echo base64_encode('SignaturePg12'); ?>" type="text" class="form-control" value="<?php echo $debtor_sign;?>">
        <br>{{ __('Signature') }}
    </div>



    <div class="col-md-12 mt-3">
 
</div>

</div>
