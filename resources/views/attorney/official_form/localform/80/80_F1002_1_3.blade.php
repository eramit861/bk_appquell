<div class="row">
    <div class="col-md-12 " style="border:1px solid #000;border-bottom:none;">
        <div class="row">
            <div class="col-md-6 p-3" style="height:200px">
                
            </div>
            <div class="col-md-6 p-3 border_left_1px" style="height:200px">
                <span>{{ __('FOR COURT USE ONLY') }}</span>
            </div>
        </div>
    </div>
    <div class="col-md-12 border_1px text-center p-3">
        <p class="mb-0">
        {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF CALIFORNIA -') }} 
            <select name="<?php echo base64_encode('Division'); ?>" class="division_select form-control w-auto">
                <option name="<?php echo base64_encode('Division'); ?>" value="**SELECT DIVISION**">{{ __('**SELECT DIVISION**') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="LOS ANGELES DIVISION">{{ __('LOS ANGELES DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="RIVERSIDE DIVISION">{{ __('RIVERSIDE DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="SANTA ANA DIVISION">{{ __('SANTA ANA DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="NORTHERN DIVISION">{{ __('NORTHERN DIVISION') }}</option>
                <option name="<?php echo base64_encode('Division'); ?>" value="SAN FERNANDO VALLEY DIVISION">{{ __('SAN FERNANDO VALLEY DIVISION') }}</option>
            </select>
        </p>
    </div>
    <div class="col-md-12 border_1px bt-0">
        <div class="row">
            <div class="col-md-6 p-3 border_right_1px" >
                <div class="input-grpup">
                    <label>{{ __('Name of Debtor(s) listed on the bankruptcy case:') }}</label>
                    <textarea name="<?php echo base64_encode('Name of Debtor(s)'); ?>" value="" class="form-control" rows="8" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="">
                    <x-officialForm.caseNo
                        labelText="CASE NO.:"
                        casenoNameField="Case Number"
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
                <div class="col-md-12 p-3 mt-3 text-center border_top_1px">
                    <h3 class="">{{ __('CHANGE OF MAILING ADDRESS') }} </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('1. This change of mailing address is requested by:') }}
        <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes"  checked type ="checkbox"><label>{{ __('Debtor') }}</label>
        <input name="<?php echo base64_encode('Check Box4'); ?>" value="Yes"  <?php if ($clentData['client_type'] == 3) {
            echo "checked";
        } ?> type ="checkbox"><label>{{ __('Joint-Debtor') }}</label>
        <input name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" type ="checkbox"><label>{{ __('Creditor') }}</label>
        </p>
        <p class="">{{ __('Attorneys who wish to make a change of mailing address must use CM/ECF.') }}</p>
    </div>

    <div class="col-md-12">2. <strong>{{ __('Old Address:') }}</strong></div>

    <div class="col-md-12">
        <div class="input-group d-flex">
            <label for="" style="width:180px;margin-top:6px;">
                {{ __('Name(s):') }}
            </label>
            <input name="<?php echo base64_encode('Text6'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group  d-flex">
            <label for=""  style="width:180px;margin-top:6px;">
                {{ __('Mailing Address:') }}
            </label>
            <input name="<?php echo base64_encode('OLD mailing address'); ?>" value="" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12">
        <div class="input-group  d-flex">
            <label for="" style="width:180px;margin-top:6px;">
                {{ __('City, State, Zip Code:') }} 
            </label>
            <input name="<?php echo base64_encode('OLD City State Zip'); ?>" value="" type="text" class="form-control">
        </div>
    </div>


    <div class="col-md-12">3. <strong>{{ __('New Address::') }}</strong></div>

<div class="col-md-12">
    <div class="input-group d-flex">
        <label for=""  style="width:180px;margin-top:6px;">{{ __('Mailing Address:') }}</label>
        <input name="<?php echo base64_encode('NEW mailing address'); ?>" value="" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12">
    <div class="input-group  d-flex">
        <label for="" style="width:180px;margin-top:6px;">{{ __('City, State, Zip Code:') }} </label>
        <input name="<?php echo base64_encode('NEW City State Zip'); ?>" type="text" class="form-control">
    </div>
</div>

<div class="col-md-12 mt-3"> <div class="input-group">4.
    <input name="<?php echo base64_encode('Check Box6'); ?>" value="Yes"  type="checkbox"><lanel>
     {{ __('Check here if you are a Debtor or a Joint Debtor and you receive court orders and notices by email through the 
Debtor Electronic Bankruptcy Noticing program (DeBN) rather than by U.S. mail to your mailing address. Please 
provide your DeBN account number below (DeBN account numbers can be located in the subject title of all 
emailed court orders and notices).') }}</label>
</div>
</div>

<div class="col-md-1"></div>
<div class="col-md-8 mt-3">
<div class="input-group d-flex">
       <label style="width:300px;">{{ __('Debtor’s DeBN account number') }}</label> 
       <input  name="<?php echo base64_encode('Debtor DeBN number'); ?>" value="" type="text" class="form-control">
</div>
</div>
<div class="col-md-3"></div>

<div class="col-md-1"></div>
<div class="col-md-8">
<div class="input-group d-flex">
       <label style="width:300px;">{{ __('Joint Debtor’s DeBN account number') }}</label> 
       <input name="<?php echo base64_encode('Joint Debtor DeBN number'); ?>" value="" type="text" class="form-control">
</div>
</div>
<div class="col-md-3"></div>


<div class="col-md-4 mt-3">
<div class="input-group d-flex">
    <label>{{ __('Date:') }}</label>
        <input name="<?php echo base64_encode('date'); ?>" value="{{$currentDate}}"  type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
    </div>
    </div>
    <div class="col-md-8  mt-3">
        <input name="<?php echo base64_encode("Requestor's printed name"); ?>" value=""  type="text" class="form-control">
        <br>{{ __('Requestor’s printed name(s)') }}
    </div>

    <div class="col-md-4">

    </div>
    <div class="col-md-8">
        <input name="<?php echo base64_encode('Text1'); ?>" value=""  type="text" class="form-control">
        <br>{{ __('Requestor’s signature(s)') }}
    </div>
    
    <div class="col-md-4">

</div>
<div class="col-md-8">
    <input name="<?php echo base64_encode('Title of requestor'); ?>" value=""  type="text" class="form-control">
    <br>{{ __('Title (if applicable, of corporate officer, partner, or agent)') }}
</div>




    
</div>
