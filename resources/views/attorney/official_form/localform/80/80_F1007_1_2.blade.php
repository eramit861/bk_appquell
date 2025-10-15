<div class="row">
    <div class="col-md-12 " style="border:1px solid #000;border-bottom:none;">
        <div class="row">
            <div class="col-md-6 p-3">
                <div class="input-grpup">
                    <label>{{ __('Attorney or Party Name, Address, Telephone & FAX Nos., State Bar No. & Email Address') }}</label>
                    <textarea name="<?php echo base64_encode('TextPg1a'); ?>" value="" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
                </div>
                <div class="input-group">
                    <input name="<?php echo base64_encode('Group1'); ?>" value="Choice1" type="checkbox">
                    <label for="">
                        <i>{{ __('Debtor(s) appearing without attorney') }}</i>
                    </label>
                </div>
                <div class="input-group">
                    <input name="<?php echo base64_encode('Group1'); ?>" checked="checked" value="1" type="checkbox">
                    <label for="">
                        <i>{{ __('Attorney for Debtor') }}</i>
                    </label>
                </div>
            </div>
            <div class="col-md-6 p-3" style="border-left:1px solid #000;">
                <span>{{ __('FOR COURT USE ONLY') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12 p-3 text-center" style="border:1px solid #000;">
        <p class="mb-0"> {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF CALIFORNIA -') }} 
            <select name="<?php echo base64_encode('Dropdown1'); ?>" value="" class="division_select form-control w-auto">
                <option name="<?php echo base64_encode('Dropdown1'); ?>" value="**SELECT DIVISION**">{{ __('**SELECT DIVISION**') }}</option>
                <option name="<?php echo base64_encode('Dropdown1'); ?>" value="LOS ANGELES DIVISION">{{ __('LOS ANGELES DIVISION') }}</option>
                <option name="<?php echo base64_encode('Dropdown1'); ?>" value="RIVERSIDE DIVISION">{{ __('RIVERSIDE DIVISION') }}</option>
                <option name="<?php echo base64_encode('Dropdown1'); ?>" value="SANTA ANA DIVISION">{{ __('SANTA ANA DIVISION') }}</option>
                <option name="<?php echo base64_encode('Dropdown1'); ?>" value="NORTHERN DIVISION">{{ __('NORTHERN DIVISION') }}</option>
                <option name="<?php echo base64_encode('Dropdown1'); ?>" value="SAN FERNANDO VALLEY DIVISION">{{ __('SAN FERNANDO VALLEY DIVISION') }}</option>
            </select>
        </p>
    </div>
    <div class="col-md-12 " style="border:1px solid #000;border-top:none;">
        <div class="row">
            <div class="col-md-6 p-3" style="border-right:1px solid #000;">
                <div class="input-grpup">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextPg1b'); ?>" value="" class="form-control" rows="10" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                </div> {{ __('Debtor(s).') }}
            </div>
            <div class="col-md-6 p-3">
                <div class="">
                    <x-officialForm.caseNo
                        labelText="CASE NO.:"
                        casenoNameField="Case"
                        caseno={{$caseno}}
                    ></x-officialForm.caseNo>
                </div>
                <div class="mt-2">
                    <x-officialForm.caseNo
                        labelText="CHAPTER:"
                        casenoNameField="Chapter"
                        caseno={{$chapterNo}}
                    ></x-officialForm.caseNo>
                </div>
                <div class="col-md-12 p-3 mt-3 text-center border_top_1px " >
                    <h3 class="">{{ __('AMENDED STATEMENT OF SOCIAL') }} <br> {{ __('SECURITY NUMBER(S) OR INDIVIDUAL') }} <br> {{ __('TAXPAYER IDENTIFICATION NUMBER(S)') }}
<br> {{ __('[LBR 1007-1(c)]') }} </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>{{ __('Check the appropriate box(s) and, if applicable, provide the required information') }}</p>
    </div>

    <div class="col-md-12">
        <div class="input-group d-flex">
            <label style="width:50%;">{{ __('1. Name of Debtor(specify first, middle, and last name):') }}</label>
            <input name="<?php echo base64_encode('Text10DEBTOR'); ?>" value="{{$onlyDebtor}}" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6 mt-3">
        <div class="input-group">
        <span>a.</span><input name="<?php echo base64_encode('Check Box10a'); ?>" value="Yes" type="checkbox"> <label style="width:50%;">{{ __('Debtor’s incorrect Social Security Number as originally provided:') }}</label>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group d-flex">
            <input name="<?php echo base64_encode('Text11a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text11b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text11c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6">
        <label style="">{{ __('Debtor’s incorrect Social Security Number as originally provided:') }}</label>
    </div>    
    <div class="col-md-6">
        <div class="d-flex  input-group">
            <input name="<?php echo base64_encode('Text12a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text12b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text12c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>


    <div class="col-md-6 ">
        <div class="input-group">
        <span>b.</span><input name="<?php echo base64_encode('Check Box10b'); ?>" value="Yes" type="checkbox"> <label style="width:50%;">{{ __('Debtor’s incorrect Individual Taxpayer-Identification Number:') }}</label>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="input-group d-flex">
            <input name="<?php echo base64_encode('Text13a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text13b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text13c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6 ">
        <label style="">{{ __('Debtor’s amended Individual Taxpayer-Identification Number:') }}</label>
    </div>    
    <div class="col-md-6">
        <div class="d-flex  input-group">
            <input name="<?php echo base64_encode('Text14a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text14b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text14c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    

    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">c.
            <input name="<?php echo base64_encode('Check Box10c'); ?>" value="Yes" type="checkbox"> <label style="width:50%;">{{ __('Correct as originally provided.') }}</label>
        </div>    
    </div>
    


    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">
            <label style="width:70%;">2. {{ __('Name of Joint Debtor') }} <i>{{ __('(specify first, middle, and last name)') }}</i>:</label>
            <input name="<?php echo base64_encode('Text10JOINT'); ?>" value="{{$spousename}}" type="text" class="form-control">
        </div>
    </div>

    
    <div class="col-md-6 mt-3">
        <div class="input-group">
        <span>a.</span><input name="<?php echo base64_encode('Check Box10d'); ?>" value="Yes" type="checkbox"> <label style="width:50%;">{{ __('Joint Debtor’s incorrect Social Security Number as originally provided:') }}</label>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group d-flex">
            <input name="<?php echo base64_encode('Text15a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text15b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text15c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6">
        <label style="">{{ __('Joint Debtor’s amended Social Security Number:') }}
</label>
    </div>    
    <div class="col-md-6">
        <div class="d-flex  input-group">
            <input name="<?php echo base64_encode('Text16a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text16b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text16c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>


    <div class="col-md-6 ">
        <div class="input-group">
        <span>b.</span><input name="<?php echo base64_encode('Check Box10e'); ?>" value="Yes" type="checkbox"> <label style="width:50%;">{{ __('Joint Debtor’s incorrect Individual Taxpayer-Identification Number:') }}</label>
        </div>
    </div>
    <div class="col-md-6 ">
        <div class="input-group d-flex">
            <input name="<?php echo base64_encode('Text17a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text17b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text17c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-6 ">
        <label style="">{{ __('Joint Debtor’s amended Individual Taxpayer-Identification Number:') }}</label>
    </div>    
    <div class="col-md-6">
        <div class="d-flex  input-group">
            <input name="<?php echo base64_encode('Text18a'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text18b'); ?>" value="" type="text" class="form-control"> - 
            <input name="<?php echo base64_encode('Text18c'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    

    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">c.
            <input name="<?php echo base64_encode('Check Box10f'); ?>" value="Yes" type="checkbox"> <label style="width:50%;">{{ __('Correct as originally provided.') }}</label>
        </div>    
    </div>



<div class="col-md-12">
    <p>{{ __('I declare under penalty of perjury under the laws of the United States that the foregoing is true and correct') }}</p>
</div>

    
    <div class="col-md-3 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('DatePg1a'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-8 mt-3">
        <div class="input-group ml-30 d-flex">
            <label  style="width:205px;">{{ __('Signature of Debtor') }}</label>
            <input name="<?php echo base64_encode('DebtorSignature'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-3 mt-3">
        <div class="input-group d-flex">
            <label for="">{{ __('Date:') }}</label>
            <input name="<?php echo base64_encode('DateJtDebtor'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-8 mt-3">
        <div class="input-group ml-30 d-flex">
            <label style="width:205px;">{{ __('Signature of Joint Debtor') }} </label>
            <input name="<?php echo base64_encode('Co-DebtorSignature'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
        </div>
    </div>
    

    <div class="col-md-12 mt-3">
 
</div>

</div>
