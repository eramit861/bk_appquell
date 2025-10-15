<div class="row">

    <div class="district80_007 col-md-12 border_1px bb-0">
        <div class="row">
            <div class="district80_007 col-md-6 p-3">
                <x-officialForm.attorneyPartyName
                    attorneyDetails={{$attorneydetails}}
                ></x-officialForm.attorneyPartyName>
            </div>

            <div class="district80_007 col-md-6 p-3 border_left_1px">
                <span>{{ __('FOR COURT USE ONLY') }}</span>
            </div>
        </div>
    </div>
    <div class="district80_007 col-md-12 border_1px text-center p-3">
        <p class="mb-0"> {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF CALIFORNIA -') }} 
            <select  name="<?php echo base64_encode('Division'); ?>" class="division_select form-control w-auto">
                <option value="**SELECT DIVISION**" >{{ __('**SELECT DIVISION**') }}</option>
                <option value="LOS ANGELES DIVISION" >{{ __('LOS ANGELES DIVISION') }}</option>
                <option value="RIVERSIDE DIVISION" >{{ __('RIVERSIDE DIVISION') }}</option>
                <option value="SANTA ANA DIVISION" >{{ __('SANTA ANA DIVISION') }}</option>
                <option value="NORTHERN DIVISION" >{{ __('NORTHERN DIVISION') }}</option>
                <option value="SAN FERNANDO VALLEY DIVISION" >{{ __('SAN FERNANDO VALLEY DIVISION') }}</option>
            </select>
        </p>
    </div>
    <div class="district80_007 col-md-12 border_1px bt-0">
        <div class="row">
            <div class="district80_007 col-md-6 p-3 border_right_1px">
               <x-officialForm.inReDebtor
                    debtorname={{$debtorname}}
                ></x-officialForm.inReDebtor>
            </div>
            <div class="district80_007 col-md-6 p-3">
                <x-officialForm.caseNo
                    labelText="CASE NO.:"
                    casenoNameField="Case Number"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
                <div class="row mt-3">
                    <div class="col-md-3 pt-2">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="col-md-9">
                        <select name="<?php echo base64_encode('Chapter'); ?>" class="form-control w-auto">
                            <option value="**SELECT CASE #**">**SELECT CASE**</option>
                            <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> >7</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?> >13</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>
                <div class="district80_007 col-md-12 mt-3 p-3 text-center border_top_1px">
                    <h3 class="">{{ __('VERIFICATION OF MASTER') }} <br> MAILING LIST OF CREDITORS<br> {{ __('[LBR 1007-1(a)]') }}  </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="district80_007 col-md-12 mt-3">
        <x-officialForm.pursuant
creditorsCount={{$creditors_count}}
></x-officialForm.pursuant>
    </div>

    
    <div class="district80_007 col-md-3 mt-3">
        <x-officialForm.dateIssuedTwo
    currentDate={{$currentDate}}
></x-officialForm.dateIssuedTwo>
    </div>
    <div class="district80_007 col-md-1"></div>
    <div class="district80_007 col-md-8 mt-3">
        <x-officialForm.debtorSign
    debtorSign={{$debtor_sign}}
></x-officialForm.debtorSign>
    </div>

    <div class="district80_007 col-md-3 mt-3">
        <x-officialForm.issuedDateThree
    currentDate={{$currentDate}}
></x-officialForm.issuedDateThree>
    </div>
    <div class="district80_007 col-md-1"></div>
    <div class="district80_007 col-md-8 mt-3">
        <x-officialForm.spouseSign
    spouseSign={{$debtor2_sign}}
></x-officialForm.spouseSign>
    </div>


    <div class="district80_007 col-md-3 mt-3">
       <x-officialForm.dateIssued
    currentDate={{$currentDate}}
></x-officialForm.dateIssued>
    </div>
    <div class="district80_007 col-md-1"></div>
    <div class="district80_007 col-md-8 mt-3">
        <div class="input-group ml-30 d-flex">
            <label  style="width:205px;">{{ __('Signature of Attorney for Debtor (if applicable)') }}</label>
            <input name="<?php echo base64_encode('Attorney Sig'); ?>" value="<?php echo $attorny_sign ;?>" type="text" class="form-control">
        </div>
    </div>



    <div class="district80_007 col-md-12 mt-3">
 
</div>

</div>
