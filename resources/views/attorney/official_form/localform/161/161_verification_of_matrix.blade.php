<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('District of Massachusetts') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text5');?>" class=" form-control" rows="2" style="padding-right:5px;">{{ __('Condi X Testcase and Cary X Testcase') }}</textarea>
            <p class="text-center mb-0">{{ __('Debtor') }}</p>
        </div>
    </div>
    <div class="col-md-6 p-3 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No:"
            casenoNameField="Text6"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo> 
        <div class="mt-2">
        <x-officialForm.caseNo
            labelText="Chapter:"
            casenoNameField="Text7"
            caseno="{{$chapterNo}}">
        </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('VERIFICATION OF MATRIX') }}</h3>
        <p>
            <span class="pl-3"></span>
            {{ __('The above‐named debtor(s) verify(ies) under penalty of perjury that the attached List of
            Creditors, which consists of') }}  <input name="<?php echo base64_encode('and complete to the best of my knowledge');?>"  type="text" class="form-control mt-1 w-auto"> pages and a total of 
            <input name="<?php echo base64_encode('pages and a total of');?>"  type="text" class="form-control mt-1 w-auto"> {{ __('creditors, is true, correct
            and complete to the best of my knowledge.') }}
        </p>
    </div>
    
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-3">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor"
                inputFieldName="Joint Debtor"
                inputValue="{{$spousename}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>