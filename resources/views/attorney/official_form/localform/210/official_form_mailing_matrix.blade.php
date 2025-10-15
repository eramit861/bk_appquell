<div class="row">
    

    <div class="district210 col-md-12 text-center">
        <div class="row">
            <div class="district210 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF NEW YORK') }}</h2>
            </div>
        </div>
    </div>
    <div class="district210 col-md-12 border_1px mt-3">
        <div class="row">
            <div class="district210 col-md-6 p-3 border_right_1px">
                <x-officialForm.inReDebtorCustom
                    debtorNameField="Text1"
                    debtorname={{$debtorname}}
                    rows="3">
                </x-officialForm.inReDebtorCustom>
            </div>
            <div class="district210 col-md-6 p-3">
                <x-officialForm.caseNo
                    labelText="Case Number."
                    casenoNameField="Text5"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
                <div class="row mt-3">
                    <div class="district210 col-md-3">
                        <label>{{ __('Chapter:') }}</label>
                    </div>
                    <div class="district210 col-md-9">
                        <select class="w-auto form-control" name="<?php echo base64_encode('Chapter'); ?>">
                           <option value=" "></option>
                            <option <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?>  value="7">7</option>
                            <option value="9">9</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option  <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>  value="13">13</option>
                            <option value="15">15</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district210 col-md-12">    
        <h3 class="underline text-center mt-3 mb-3">{{ __('VERIFICATION OF CREDITOR MATRIX/LIST OF CREDITORS') }}</h3> 
        <p class="pl-4">{{ __('The undersigned debtor(s) or attorney for the debtor(s) hereby verifies that the creditor matrix/list of creditors submitted herein is true and correct to the best of his or her knowledge.') }}</p>
    </div>
    <div class="district210 col-md-12 mt-3">
        <select class="form-control ml-5 mb-3 width_fit_content" name="<?php echo base64_encode('Court Location'); ?>">
            <option value=" "></option>
            <option value="Brooklyn, New York">Brooklyn, New York</option>
            <option value="Central Islip, New York">Central Islip, New York</option>
        </select>
        <x-officialForm.dateSingleHorizontal
            labelText="DATED:"
            dateNameField="Text7" 
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

    <div class="district210 col-md-4 mt-3">
    </div>
    <div class="district210 col-md-4 mt-3">
      
    </div>
    <div class="district210 col-md-4 mt-3">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor"
                inputFieldName="Text2"
                inputValue="{{$onlyDebtor}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor"
                inputFieldName="Text3"
                inputValue="{{$spousename}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney for Debtor"
                inputFieldName="Text4"
                inputValue="{{$spousename}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div> 
