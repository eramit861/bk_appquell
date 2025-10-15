<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF VIRGINIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox0"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        
        <div class="row">
            <div class="col-md-3 pt-2">
                <label>{{ __('Chapter.') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Dropdown1');?>" class="form-control w-auto">
                    <option value=""></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>>7</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>

        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="TextBox1"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('CERTIFICATION REGARDING AMENDED SCHEDULES OR STATEMENTS') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p>
            On 
            <input type="text" name="<?php echo base64_encode('TextBox2');?>" class="form-control w-auto" value="{{$attorneyDate}}">
            {{ __(', the Debtor(s) filed amended schedules or statements (check the applicable box below):') }} 
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox0');?>" value="YES" class="form-control height_fit_content w-auto">
            {{ __('These amended schedules or statements do not list any creditors or parties not listed on the matrix originally filed with the petition in this case.') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox1');?>" value="YES" class="form-control height_fit_content w-auto">
            {{ __('These amended schedules or statements do add creditors but the creditors are listed on the mailing matrix previously filed with this Court. I have paid the related filing fee for adding these creditors.  As of the date of this certification the mailing matrix in this case includes all creditors listed on the bankruptcy schedules, as amended.') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox2');?>" value="YES" class="form-control height_fit_content w-auto">
            {{ __('These amended schedules or statements do add creditors, and the creditors were not listed on the mailing matrix previously filed with this Court. Accordingly I have taken the following actions: (a) I have updated the mailing matrix to add all creditors not previously listed on the mailing matrix, and as of the date of this certification the mailing matrix in this case includes all creditors listed on the bankruptcy schedules, as amended, (b) I have paid the related filing fee for adding these creditors, and (c) on') }}
            <input type="text" name="<?php echo base64_encode('TextBox3');?>" class="form-control w-auto">
            {{ __(", I sent the Notice of Bankruptcy and §341 (a) creditors' meeting notice to the following creditors in the manner described as follows (add extra pages if necessary):") }}
        </p>
    </div>

    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('TextBox6');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('TextBox7');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox8');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox9');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox10');?>" class="form-control mt-1">
    </div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('TextBox11');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('TextBox12');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox13');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox14');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox15');?>" class="form-control mt-1">
    </div>

    <div class="col-md-12">
        <p>{{ __('I hereby certify that the foregoing is true and correct.') }}</p>
    </div>
    
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="TextBox16"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Counsel for Debtor(s)"
                inputFieldName="TextBox17"
                inputValue="{{$attorny_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('I hereby certify under penalty of perjury that the foregoing is true and correct.') }}</p>
    </div>
    
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor (if applicable)"
                inputFieldName="TextBox18"
                inputValue={{$debtor_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor (if applicable)"
                inputFieldName="TextBox19"
                inputValue={{$debtor2_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>