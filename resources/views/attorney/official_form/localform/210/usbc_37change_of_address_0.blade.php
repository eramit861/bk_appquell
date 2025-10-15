<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF NEW YORK') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="In re"
            debtorname={{$debtorname}}
            rows="3">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case Number"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="row mt-2">
            <div class="col-md-3 pt-2">
                <label>{{ __('Chapter') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Chapter'); ?>" class="form-control width_auto mt-2">
                    <option value=""></option>
                    <option <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>  value="7">7</option>
                    <option value="9">9</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>  value="13">13</option>
                    <option value="15">15</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CHANGE OF DEBTOR(S) ADDRESS') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('Sir / Madam:') }}</p>
    </div>

    <div class="col-md-12">
        <p class="text-center">{{ __('Please amend the Court’s records to reflect my change of address as follows:') }}</p>
    </div>

    <div class="col-md-3 mt-2">
        <label class="text-bold ">{{ __('DEBTOR’S NAME:') }}</label>
    </div>
    
    <div class="col-md-9 mt-2">
        <input type="text" name="<?php echo base64_encode('DEBTORS NAME');?>" value="{{$onlyDebtor}}" class="form-control">
    </div>
    
    <div class="col-md-3 mt-2">
        <label class="text-bold ">{{ __('JOINT DEBTOR’S NAME:') }}</label>
    </div>
    
    <div class="col-md-9 mt-2">
        <input type="text" name="<?php echo base64_encode('JOINT DEBTORS NAME');?>" value="{{$spousename}}" class="form-control">
    </div>

    <div class="col-md-3 mt-2">
        <label class="text-bold ">{{ __('OLD ADDRESS:') }}</label>
    </div>
    
    <div class="col-md-9 mt-2">
        <input type="text" name="<?php echo base64_encode('OLD ADDRESS 1');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('OLD ADDRESS 2');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('OLD ADDRESS 3');?>" class="form-control mt-1">
    </div>

    <div class="col-md-3 mt-2">
        <label class="text-bold ">{{ __('NEW ADDRESS:') }}</label>
    </div>

    <div class="col-md-9 mt-2">
        <input type="text" name="<?php echo base64_encode('NEW ADDRESS 1');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('NEW ADDRESS 2');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('NEW ADDRESS 3');?>" class="form-control mt-1">
    </div>
    
    <div class="col-md-3 mt-2">
        <label class="text-bold ">{{ __('EMAIL ADDRESS:') }}</label>
    </div>
    <div class="col-md-3 mt-2">
        <input type="text" name="<?php echo base64_encode('EMAIL ADDRESS');?>" class="form-control">
    </div>
    <div class="col-md-6 mt-2"></div>

    <div class="col-md-3 mt-2">
        <label class="text-bold ">{{ __('PHONE NUMBER:') }}</label>
    </div>
    <div class="col-md-3 mt-2">
        <input type="text" name="<?php echo base64_encode('PHONE NUMBER');?>" class="form-control">
    </div>
    <div class="col-md-6 mt-2"></div>
    
    <div class="col-md-12 mt-2">
        <p class="mb-0 text-bold">DO THE DEBTOR(S) HAVE A DeBN ACCOUNT? 
            <input type="checkbox" class="form-control width_auto " name="<?php echo base64_encode('Check Box5');?>" value="Yes"> YES 
            <input type="checkbox" class="form-control width_auto " name="<?php echo base64_encode('Check Box6');?>" value="Yes"> {{ __('NO') }}
        </p>
    </div>
    <div class="col-md-12 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-6"></div>
    <div class="col-md-6 text-center text_italic text-bold">
            <x-officialForm.signVertical
                labelText="Debtor’s Signature"
                signNameField="Text1"
                sign={{$debtor_sign}}
            ></x-officialForm.signVertical>
        <div>
            <x-officialForm.signVertical
                labelText="Joint Debtor’s Signature"
                signNameField="Text2"
                sign={{$debtor2_sign}}
            ></x-officialForm.signVertical>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">NOTE: <span class="text_italic">{{ __('This does') }} <span class="underline">{{ __('NOT') }}</span> {{ __('reflect a change in caption.
         Any change to the caption must be done by Order and Application to the Court.') }}</span></p>
    </div>
</div>