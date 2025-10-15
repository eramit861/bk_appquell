<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF NEW YORK') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text1'); ?>" value="" class=" form-control" rows="5"><?php echo $debtorname ?? ''; ?></textarea>
            <p class="text-center mb-0">{{ __('Debtor.') }}</p>
        </div> 
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text2"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="row">
            <div class="col-md-3 pt-2">
                <label>{{ __('Chapter') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Dropdown3'); ?>" class="form-control width_auto mt-2">
                    <option value=""></option>
                    <option <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> value="7">7</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?> value="13">13</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CERTIFICATE OF SERVICE') }}</h3>
    </div>
    <div class="col-md-2 pr-0 mt-3">
        <p>{{ __('The undersigned certifies that on.') }}</p>
    </div>
    <div class="col-md-3 mt-3 text-center">
        <input value="{{$currentDate}}" name="<?php echo base64_encode('The undersigned certifies that on');?>" type="text" class="form-control">
        <label>{{ __('(Date of Service/Mailing)') }}</label>
    </div>
    <div class="col-md-7 mt-3">
        <p>{{ __(', a copy of') }}</p>
    </div>

    <div class="col-md-11 mt-2 text-center">
        <input name="<?php echo base64_encode('undefined');?>" type="text" class="form-control">
        <label>{{ __('(Title of Document(s) served)') }}</label>
    </div>
    <div class="col-md-1 mt-2">
        <p class="pt-2">,</p>
    </div>
    
    <div class="col-md-12 mt-2">
        <p>{{ __('was deposited in an enclosed, properly addressed postage-paid envelope, and served by') }}</p>
    </div>

    <div class="col-md-11 text-center">
        <input name="<?php echo base64_encode('Method of Delivery eg Federal Express Overnight US Post Office Priority Mail');?>" type="text" class="form-control">
        <label>{{ __('(Method of Delivery, e.g., Federal Express Overnight, U.S. Post Office Priority Mail.....)') }}</label>
    </div>
    <div class="col-md-1"></div>

    <div class="col-md-12 mt-2">
        <p>{{ __('upon the following') }} <span class="text_italic text-bold">{{ __('[below specify the name and mailing address of each party served]') }}</span>:</p>
    </div>
    
    <div class="col-md-12 mt-2">
        <textarea name="<?php echo base64_encode('Text4');?>" class="form-control" rows="17"></textarea>
    </div>
    
    <div class="col-md-12 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated: "
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="pl-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature"
                inputFieldName=""
                inputValue={{$attorny_sign}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="pl-3 mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Print name"
                inputFieldName="Print name"
                inputValue={{$atroneyName}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-3 mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Address:"
                inputFieldName="Address"
                inputValue={{$attonryAddress1}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="row mt-1">
            <div class="col-md-4"></div>
            <div class="col-md-8 pl-4">       
                 <input name="<?php echo base64_encode('undefined_2');?>" type="text" value="{{$attonryAddress2}}" class="form-control">
            </div>
        </div>
        <div class="pl-3 mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Phone:"
                inputFieldName="Phone"
                inputValue={{$attorneyPhone}}
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="pl-3 mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Email:"
                inputFieldName="Email"
                inputValue={{$attorney_email}}
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>
</div>