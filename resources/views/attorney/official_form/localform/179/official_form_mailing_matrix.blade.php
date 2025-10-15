<div class="row">

    <div class="district179 col-md-12 text-center">
        <div class="row">
            <div class="district179 col-md-12 text-center">   
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF MISSOURI') }}</h2>
            </div>
        </div>
    </div>
    @include("attorney.official_form.localform.common_details")
    <div class="district179 col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3>
        <p class="pl-3">
            
            {{ __('The above named debtor(s) hereby certifies/certify under penalty of perjury that the attached list
            containing the names and addresses of my creditors (Matrix), consisting of') }}
            <input name="<?php echo base64_encode('TextBox3'); ?>" value="<?php echo $creditors_count; ?>" type="text" class="form-control width_5percent">
            {{ __('page(s) and is true, correct
            and complete.') }}
        </p>  
    </div>
    <div class="district179 col-md-4 mt-3"></div>
    <div class="district179 col-md-4 mt-3"></div>
    <div class="district179 col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName="TextBox4"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-3">
            <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="TextBox7"
                currentDate="{{$currentDate}}">
            </x-officialForm.dateSingleHorizontal>
        </div>
    </div>

</div>
