<div class="row">
    <div class="col-md-12 ">
        <div class="row">
            <div class="col-md-6 mt-3">
                <label>{{ __('Name, Address, Telephone No. & I.D. No.') }}</label><br>
                <textarea name="<?php echo base64_encode('Text1'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo htmlentities($attorneydetails); ?></textarea>
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
                    <div class="input-group d-flex">
                        <textarea style="margin-right:40px" name="<?php echo base64_encode('Text2'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                        <label style="position:absolute; right:0px; bottom:0px;">{{ __('Debtor.') }}</label>
                    </div>
            </div>
            <div class="col-md-6" style="border-left:3px solid #000; border-top:3px solid #000; border-bottom:3px solid #000;">
                <div class="input-group d-flex mt-20">
                    <label>{{ __('BANKRUPTCY NO.') }}</label>
                    <input name="<?php echo base64_encode('Text3'); ?>" value="<?php echo Helper::validate_key_value('case_number', $savedData); ?>" type="text" class="form-control">
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h2 class="text-center">{{ __('DISCLOSURE OF COMPENSATION OF ATTORNEY FOR DEBTOR') }}</h2>
    </div>
    
    <div class="col-md-12 mt-3">
        <p>{{ __('1. Pursuant to 11 U.S.C. § 329(a) and Federal Rule of Bankruptcy Procedure 2016(b), I certify that I am the attorney for the above-named
            debtor(s) and that compensation paid to me within one year before the filing of the petition in bankruptcy, or agreed to be paid to me, for
            services rendered or to be rendered on behalf of the debtor(s) in contemplation of or in connection with the bankruptcy case is as follows:') }}
        </p>
    </div>

    <div class="col-md-12">
        <div class="row align_center sub-child">
            <div class="col-md-9">
                <div class="input-group horizontal_dotted_line">
                    <label>{{ __('For legal services, I have agreed to accept') }}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group d-flex">
                <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
                    <p><input name="<?php echo base64_encode('Text4'); ?>" value="<?php echo Helper::priceFormtWithComma(Helper::validate_key_value('attorney_price', $savedData));?>"  type="text" class="price-field form-control"></p> </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row align_center sub-child">
            <div class="col-md-9">
                <div class="input-group horizontal_dotted_line">
                    <label>{{ __('Prior to the filing of this statement I have received') }}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group d-flex">
                <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
                    <p><input name="<?php echo base64_encode('Text5'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>"  type="text" value="" class="price-field form-control"></p> </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row align_center sub-child">
            <div class="col-md-9">
                <div class="input-group horizontal_dotted_line">
                    <label>{{ __('Balance Due') }}</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="input-group d-flex">
                <div class="input-group-append"> <span class="input-group-text ">$</span> </div>
                    <p><input name="<?php echo base64_encode('Text6'); ?>" value="<?php echo Helper::priceFormtWithComma('');?>"  type="text" value="" class="price-field form-control"></p> </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <p>{{ __('2. The source of the compensation paid to me was:') }}</p>
        <div class="d-flex">
            <div class="input-group" style="width:100px;">
                <input name="<?php echo base64_encode('7a'); ?>" value="1" type="checkbox"><label>{{ __('Debtor') }}</label>
            </div>
            <div class="input-group" >
                <input name="<?php echo base64_encode('7a'); ?>" value="2" type="checkbox"><label>{{ __('Other (specify)') }}</label>
            </div>
        </div>
        <div class="d-flex">
            <input name="<?php echo base64_encode('Text8'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('3. The source of compensation to be paid to me is:') }}</p>
        <div class="d-flex">
            <div class="input-group" style="width:100px;">
                <input name="<?php echo base64_encode('9a'); ?>" value="1" type="checkbox"><label>{{ __('Debtor') }}</label>
            </div>
            <div class="input-group" >
                <input name="<?php echo base64_encode('9a'); ?>" value="2" type="checkbox"><label>{{ __('Other (specify)') }}</label>
            </div>
        </div>
        <div class="d-flex">
            <input name="<?php echo base64_encode('Text10'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group">
            <p>4. <input name="<?php echo base64_encode('11a'); ?>" value="1" type="checkbox"> {{ __('I have not agreed to share the above-disclosed compensation with any other person unless they are members and associates of my law firm.') }}<br>
            &nbsp;&nbsp;<input name="<?php echo base64_encode('11a'); ?>" value="2" class="ml-10" type="checkbox"> {{ __('I have agreed to share the above-disclosed compensation with a person or persons who are not members or associates of my law firm.
                            A copy of the agreement, together with a list of the names of the people sharing in the compensation, is attached.') }}</p>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('5. In return for the above-disclosed fee, I have agreed to render legal service for all aspects of the bankruptcy case, including:') }}</p>
        <p class="ml-10">{{ __('a. Analysis of the debtor’s financial situation, and rendering advice to the debtor in determining whether to file a petition in bankruptcy;') }}</p>
        <p class="ml-10"> {{ __('b. Preparation and filing of any petition, schedules, statement of affairs and plan which may be required;') }}</p>
        <p class="ml-10"> {{ __('c. Representation of the debtor at the meeting of creditors and confirmation hearing, and any adjourned hearings thereof;') }}</p>
        <p class="ml-10"> {{ __('d. Representation of the debtor in adversary proceedings and other contested bankruptcy matters;') }}</p>
        <p class="ml-10"> {{ __('e. [Other provisions as needed]') }}</p>

        <table style="width:100%;">
            <tr>
                <td style="height:30px;">
                    <textarea name="<?php echo base64_encode('Text12'); ?>" value="" class="form-control" rows="5" cols="" style="padding-right:5px;"></textarea>
                </td>
            </tr>
        </table>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('6. By agreement with the debtor(s), the above-disclosed fee does not include the following services:') }}</p>
        <table style="width:100%;">
            <tr>
                <td style="height:30px;">
                    <textarea name="<?php echo base64_encode('Text13'); ?>" value="" class="form-control" rows="5" cols="" style="padding-right:5px;"></textarea>
                </td>
            </tr>
        </table>
    </div>
    
    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CERTIFICATION') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I certify that the foregoing is a complete statement of any agreement or arrangement for payment to me for representation of the debtor(s) in this bankruptcy proceeding.') }}
        </p>
    </div>

    <div class="row col-md-12 mt-10">
        <div class="input-group d-flex col-md-6">
            <label>{{ __('DATED:') }}</label>
            <input name="<?php echo base64_encode('Text14'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
        </div>
        <div class="input-group col-md-6"></div>
    </div>
    <div class="row col-md-12 mt-10">
        <div class="input-group col-md-6"></div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('Text15'); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control">
            <label>{{ __('(Typed Name and Signature)') }}</label>
        </div>
    </div>
    <div class="row col-md-12 mt-10">
        <div class="input-group col-md-6"></div>
        <div class="input-group col-md-6">
            <input name="<?php echo base64_encode('Text16'); ?>" value="<?php echo $atroneyName;?>" type="text" class="form-control">
            <label>{{ __('(Name of Law Firm)') }}</label>
        </div>
    </div>
    

    <div class="col-md-12 mt-3">
         
    </div>

</div>