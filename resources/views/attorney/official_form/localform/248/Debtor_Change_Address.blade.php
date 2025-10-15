
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('DISTRICT OF RHODE ISLAND') }}</h3>  
    </div>
    <div class="row mt-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text1"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="BK No."
                    casenoNameField="Text2"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <?php $chapisland = $chapterName;
                $nochapterisland = str_replace("Chapter ", "", $chapisland); ?>
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text3"
                    caseno={!!$nochapterisland!!}
                ></x-officialForm.caseNo>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <h3>{{ __('DEBTOR CHANGE OF ADDRESS FORM') }}</h3>
    </div>
    <div class="row">
        <div class="col-md-3">
           <label class="p-2"><span class="pr-2">1.</span><strong>{{ __('Name of Debtor(s):') }}</strong></label>
        </div>
        <div class="col-md-9">
        <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="{{$onlyDebtor}}" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-4">
           <label class="p-2"><span class="pr-2">2.</span><strong>{{ __('Debtor’s Tax ID or SSN Number: (last 4 digits only):') }}</strong></label>
        </div>
        <div class="col-md-8">
        <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="{{$last_4_ssn_d1}}" class="form-control width_auto">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <label class="p-2"><span class="pr-2">3.</span><strong>{{ __('Old Address:') }}</strong></label>
        </div>
        <div class="col-md-1 mt-2"></div>
        <div class="col-md-2 mt-2">
            <label class="p-2">{{ __('Names(s):') }}</label>
        </div>
        <div class="col-md-9 mt-2">
            <input name="<?php echo base64_encode('Text6'); ?>" type="text" value="" class="form-control ">
        </div>
        <div class="col-md-1 mt-2"></div>
        <div class="col-md-2 mt-2">
            <label class="p-2">{{ __('Mailing Address:') }}</label>
        </div>
        <div class="col-md-9 mt-2">
            <input name="<?php echo base64_encode('Text7'); ?>" type="text" value="" class="form-control ">
        </div>
        <div class="col-md-1 mt-2"></div>
        <div class="col-md-2 mt-2">
            <x-singlelabel class="p-2" label="City, State, Zip Code:" />
        </div>
        <div class="col-md-9 mt-2">
            <input name="<?php echo base64_encode('Text8'); ?>" type="text" value="" class="form-control ">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <label class="p-2"><span class="pr-2">4.</span><strong>{{ __('New Address:') }}</strong></label>
        </div>
        <div class="col-md-1 mt-2"></div>
        <div class="col-md-2 mt-2">
            <label class="p-2">{{ __('Mailing Address:') }}</label>
        </div>
        <div class="col-md-9 mt-2">
            <input name="<?php echo base64_encode('Text9'); ?>" type="text" value="" class="form-control ">
        </div>
        <div class="col-md-1 mt-2"></div>
        <div class="col-md-2 mt-2">
            <x-singlelabel class="p-2" label="City, State, Zip Code:" />
        </div>
        <div class="col-md-9 mt-2">
            <input name="<?php echo base64_encode('Text10'); ?>" type="text" value="" class="form-control">
        </div>
    </div>
    <div>
        <div class="mt-3 text-bold">
           <p>{{ __('Check all that apply (you must check one):') }}</p>
        </div>
        <div class="form-check mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box11'); ?>" value="Yes" checked>
            <label>{{ __('I am listed as a debtor in the above referenced case.') }} </label>
        </div>
        <div class="form-check mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box12'); ?>" value="Yes">
            <label>{{ __('I am the debtor’s authorized agent (attach copy of power of attorney or statement of authority, if any).') }}</label>
        </div>
        <div class="form-check mt-2">
            <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box13'); ?>" value="Yes">
            <label>{{ __('I am the Attorney representing the debtor in this case.') }}</label>
        </div>
        <div class="mt-3 pl-2">
            <p> I <input name="<?php echo base64_encode('Text14'); ?>" type="text" value="{{$atroneyName}}" class="form-control width_auto">{{ __('hereby declare under penalty of perjury that the foregoing is true and correct.') }}</p>
        </div>
    </div>
    <div class="row mt-20">
        <div class="col-md-6">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Text15"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div> 
        <div class="col-md-6">
            <x-officialForm.debtorSignVertical
                labelContent="Signature:"
                inputFieldName="Text16"
                inputValue={{$attorny_sign}}
            ></x-officialForm.debtorSignVertical>
            <div class="mt-1">
                <x-officialForm.debtorSignVertical
                    labelContent="Print Name:"
                    inputFieldName="Text17"
                    inputValue={{$atroneyName}}
                ></x-officialForm.debtorSignVertical> 
            </div>
            <div class="mt-1">
                <x-officialForm.debtorSignVertical
                    labelContent="Telephone Number:"
                    inputFieldName="Text18"
                    inputValue={{$attorneyPhone}}
                ></x-officialForm.debtorSignVertical> 
            </div>
            <div class="mt-1">
                <x-officialForm.debtorSignVertical
                    labelContent="Email Address:"
                    inputFieldName="Text19"
                    inputValue={{$attorney_email}}
                ></x-officialForm.debtorSignVertical> 
            </div>
        </div> 
    </div>
