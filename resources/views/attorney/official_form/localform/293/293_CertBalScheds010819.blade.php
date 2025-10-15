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
        <h3 class="text-center underline">{{ __('CERTIFICATION REGARDING BALANCE OF SCHEDULES') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="pl-4">
            On 
            <input type="text" name="<?php echo base64_encode('TextBox2');?>" class="form-control w-auto" value="{{$attorneyDate}}">
            {{ __(', the Debtor(s) filed the balance of schedules pursuant to FRBP 1007(c) and Local Rule 1007-1. I have reviewed the balance of schedules and certify that (check the applicable box below):') }} 
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox0');?>" class="form-control height_fit_content w-auto" value="YES">
            {{ __('These schedules do not list any creditors or parties not listed on the matrix originally filed with the petition in this case.') }}
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('CheckBox1');?>" class="form-control height_fit_content w-auto" value="YES">
            {{ __('These schedules do list creditors who are not contained on the original matrix filed with the petition, and') }}
        </p>
        <p class="pl-4">
            {{ __("I have filed a notice of amendment to debtor's schedules of creditors and/or matrix to add
            these creditors to the matrix; and") }}
        </p>
        <p class="pl-4">
            {{ __('I have paid the filing fee to add these creditors to the matrix; and') }}
        </p>
        <p class="pl-4">
            {{ __('I have sent a copy of the Notice of Bankruptcy and § 341 Meeting to these creditors.  The
            names and method of service are described as follows (add extra pages if necessary):') }} 
        </p>
    </div>

    <div class="col-md-8 pl-4">
        <label class="text-bold">{{ __('Creditor Name') }}</label>
        <input type="text" name="<?php echo base64_encode('TextBox3');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox4');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox5');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox6');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox7');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox8');?>" class="form-control mt-1">
    </div>
    <div class="col-md-4">
        <label class="text-bold">{{ __('Method of Service') }}</label>
        <input type="text" name="<?php echo base64_encode('TextBox10');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox11');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox12');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox13');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox14');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox15');?>" class="form-control mt-1">
    </div>

    <div class="col-md-12">
        <p>{{ __('I hereby certify that the foregoing is true and correct.') }} </p>
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
        <p>{{ __('I hereby certify under penalty of perjury that the foregoing is true and correct.') }} </p>
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