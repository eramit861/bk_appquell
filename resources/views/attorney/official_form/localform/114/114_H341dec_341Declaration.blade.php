<div class="row">
    <div class="col-md-12 border_1px p-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT - DISTRICT OF HAWAII') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 bt-0 br-0">
        <label for="">Name of Debtor or Joint Debtor (<span class=" text_italic">{{ __('Complete for each individual') }}</span>):</label>
        <input type="text" name="<?php echo base64_encode('hib_1007-1b2-1')?>" class="form-control " value="{{$debtorname}}"> 
    </div>
    <div class="col-md-3 border_1px p-3 bt-0 br-0">
        <div class="row">
            <div class="col-md-4 pt-2">
                <label>{{ __('Case No.:') }} <br>(<span class=" text_italic">{{ __('if known') }}</span>)</label>
            </div>
            <div class="col-md-8">
                <input placeholder="" type="text" name="<?php echo base64_encode('Text1')?>" value="{{$caseno}}" class="w-auto form-control">
            </div>
        </div>
    </div>
    <div class="col-md-3 border_1px p-3 bt-0">
        <div class="row">
            <div class="col-md-4 pt-2">
                <label>{{ __('Chapter') }}</label>
            </div>
            <div class="col-md-8">
                <select name="<?php echo base64_encode('Chapter')?>" class="form-control w-auto">
                    <option value=""></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> >7</option>
                    <option value="11">11</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?>>13</option>
                    <option value="12">12</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 border_1px p-3 bt-0 text-center">
        <h3>
            {{ __('DEBTOR’S STATEMENT REGARDING') }}<br>
            {{ __('PAYMENT ADVICES, TAX RETURNS, AND DOMESTIC SUPPORT OBLIGATIONS') }}
        </h3>
        <p class=" text_italic mb-0">{{ __('Do not file this with the court. Complete and mail to trustee at least 7 days before your meeting with creditors.') }}</p>
    </div>
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-20')?>" value="Yes" class="form-control w-auto payment_received">
            <span class="text-bold">{{ __('Payment Advices') }}</span>    
            {{ __('Payment Advices (wage statements, pay stubs, etc.) are being submitted to trustee.') }}
        </p>
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-2')?>" value="Yes" class="form-control w-auto not_payment_received">
            {{ __('I am') }} 
            <span class="text-bold">not</span>    
             {{ __('submitting payment advices received from my employer during the 60 days before the date of filing of
            my bankruptcy petition because:.') }}
        </p>
        <p class="">
            <span class="pl-4"></span> 
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-3')?>" value="Yes" class="form-control w-auto">
            {{ __('I was not employed during these dates: from') }}: 
            <input type="text" name="<?php echo base64_encode('hib_1007-1b2-4')?>" class="form-control w-auto ">
            {{ __('to') }}: 
            <input type="text" name="<?php echo base64_encode('hib_1007-1b2-4a')?>" class="form-control w-auto ml-1">
        </p>
        <p class="">
            <span class="pl-4"></span> 
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-5')?>" value="Yes" class="form-control w-auto">
            {{ __('I was employed but have not received any payment advices or other evidence of payment from my
            employer during the 60-day period before filing my petition.') }}
        </p>
        <p class="">
            <span class="pl-4"></span> 
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-6')?>" value="Yes" class="form-control w-auto">
            {{ __('I am self-employed and do not receive any evidence of payment from an employer.') }}
        </p>
        <p class="">
            <span class="pl-4"></span> 
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-7')?>" value="Yes" class="form-control w-auto">
            {{ __('Other reason') }} [<span class="text_italic">{{ __('Attach explanation if more space needed') }}</span>]:
            <span class="">
                <textarea rows="4" name="<?php echo base64_encode('hib_1007-1b2-8')?>" class="ml-4 form-control width_90percent"></textarea>
            </span>
        </p>
    </div>
    
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-19')?>" value="Yes" class="form-control w-auto">
            <span class="text-bold">{{ __('Most Recent Federal Income Tax Return or Transcript') }}</span>    
            {{ __('is being submitted to trustee.') }}
        </p>
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-9')?>" value="Yes" class="form-control w-auto">
            {{ __('I am') }} 
            <span class="text-bold">not</span>    
            {{ __('submitting my federal income tax return or transcript for the most recent tax year ending
            immediately before the date of filing of my bankruptcy petition because:') }}
        </p>
        <p class="">
            <span class="pl-4"></span> 
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-10')?>" value="Yes" class="form-control w-auto">
            {{ __('I had insufficient gross income to require the filing of a federal tax return for tax year:') }}
            <input type="text" name="<?php echo base64_encode('hib_1007-1b2-11')?>" class="form-control w-auto ">
            <br>
            <span class="ml-4 pl-5"></span>
            {{ __('My income for that tax year was:') }} $ 
            <input type="text" name="<?php echo base64_encode('hib_1007-1b2-12')?>" class="form-control w-auto ml-1">
        </p>
        <p class="">
            <span class="pl-4"></span> 
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-13')?>" value="Yes" class="form-control w-auto">
            {{ __('Other reason') }} [<span class="text_italic">{{ __('Attach explanation if more space needed') }}</span>]:
            <span class="">
                <textarea name="<?php echo base64_encode('hib_1007-1b2-14')?>" rows="4" class="ml-4 form-control width_90percent"></textarea>
            </span>
        </p>
    </div>
    
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class="mb-0">
            <span class="text-bold underline">{{ __('Chapter 13 Only:') }}</span>
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-15')?>" value="Yes" class="form-control w-auto">
            {{ __('I have filed all returns for federal, state, and local taxes due for the 4 years before this case.') }}
        </p>
    </div>
    
    <div class="col-md-12 border_1px p-3 bt-0">
        <p class="">
            <input type="checkbox" name="<?php echo base64_encode('hib_1007-1b2-16')?>" value="Yes" class="form-control w-auto">
            {{ __('I have') }} 
            <span class="text-bold">{{ __('Domestic Support Obligations') }}</span>    
            {{ __('(child support, alimony, divorce obligations, etc.).') }}
        </p>
        
        <p class="text_italic">
            <span class="pl-4"></span>    
            {{ __('Provide the name and address of each individual or government payee here:') }}
        </p>

        <div class="row pl-4">
            <div class="col-md-6">
                <textarea name="<?php echo base64_encode('hib_1007-1b2-17.0')?>" rows="6" class="form-control"></textarea>
            </div>
            <div class="col-md-6">
                <textarea name="<?php echo base64_encode('hib_1007-1b2-17.1')?>" rows="6" class="form-control"></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-12 border_1px p-3 bt-0">
        
        <p class="">  
            {{ __('I declare under penalty of perjury that the foregoing information is true and correct.') }}
        </p>

        <div class="row">
            <div class="col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="hib_1007-1b2-18"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div>
            <div class="col-md-6">
                
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Signature of Debtor / Joint Debtor"
                    inputFieldName=""
                    inputValue={{$both_sign}}>
                </x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
    </div>
    
</div>