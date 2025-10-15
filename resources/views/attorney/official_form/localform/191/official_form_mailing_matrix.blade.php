<div class="row">

    <div class="district191 col-md-12 text-center">
        <div class="row">
            <div class="district191 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}  <br> {{ __('DISTRICT OF NEBRASKA') }} </h2> 
            </div> 
        </div>
    </div>
    
    @include("attorney.official_form.localform.common_details")

    <div class="district191 col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('VERIFICATION OF CREDITOR MATRIX') }}</h3> 
        <p class="pl-3">{{ __('The above-named Debtor(s) hereby verifies that the attached list of creditors is true and correct to the best of their knowledge.') }}</p>
    </div>
   
    <div class="district203 col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="TextBox3"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="1district203 col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="TextBox7"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    
    <div class="district203 col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="TextBox4"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="district203 col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="TextBox8"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>  

</div>
