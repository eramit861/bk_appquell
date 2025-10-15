<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW MEXICO') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text134');?>" value="" class=" form-control" rows="2">{{ __('Condi X Testcase and Cary X Testcase') }}</textarea>
            <label>{{ __('Debtor.') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text133"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-3">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
        <p class="mb-0"><span class="pl-4"></span>
            {{ __('Pursuant to Fed. R. Bankr. P. 1007(a)(1) and Fed. R. Bankr. P. 7007.1(a), the debtor
            identifies the following corporations (other than governmental units), that directly or indirectly
            own 10% or more of any class of the undersigned’s equity interests:') }}
        </p>
        <p><span class="pl-4"></span>[<span class="text_italic"> {{ __('names of corporations here, or state NONE') }}</span>]</p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-2 pt-3">
        <p class="mb-0">{{ __('DEBTOR NAME') }}</p>
    </div>
    <div class="col-md-6 mt-3"></div>
    <div class="col-md-6 mt-3">
        <div class="pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="By:"
                inputFieldName="By"
                inputValue="{{$debtor_sign}}">
            </x-officialForm.debtorSignVertical>
            <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-8">
            <p class="mb-0">{{ __('Signature') }}</p>
            </div>
        </div>
        </div>
        <div class="pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Name:"
                inputFieldName="Name"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-3">
            <x-officialForm.debtorSignVertical
                labelContent="Title:"
                inputFieldName="Title"
                inputValue="{{$suffix_d1}}">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>
