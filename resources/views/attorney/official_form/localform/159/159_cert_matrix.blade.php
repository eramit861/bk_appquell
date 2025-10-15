<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center mb-3">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF MAINE') }}</h3>
    </div>
     
    <div class="col-md-6 border_1px br-0 p-3">
        <textarea name="<?php echo base64_encode('undefined');?>" class="form-control" rows="2">{{$debtorname}}</textarea>
        <label class="float_right">Debtor</label>
    </div>
    <div class="col-md-6 p-3 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Case #:"
                casenoNameField="Case"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter:"
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 ">
        <h3 class="text-center underline">{{ __('CERTIFICATION OF CREDITOR MATRIX') }}</h3>
        <p class="mt-3"><span class="pl-4"></span>
        {{ __('I hereby certify that the attached matrix, consisting of') }} 
        <input type="text" class="form-control width_5percent ml-2" name="<?php echo base64_encode('I hereby certify that the attached matrix consisting of');?>" value="{{$creditors_count}}">
        {{ __('pages, includes the names and
        addresses of all creditors listed on the debtor’s schedules.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Attorney for Debtor, or Debtor if pro se"
            inputFieldName="Attorney for Debtor or Debtor if pro se"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>

</div>
