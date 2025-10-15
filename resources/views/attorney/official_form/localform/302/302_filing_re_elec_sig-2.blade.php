<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('United States Bankruptcy Court') }}<br>{{ __('Northern District of West Virginia') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="">
            <label for="">{{ __('Debtor 1:') }}</label>
            <x-officialForm.inputText name="Text6" class="" value="{{$onlyDebtor}}"></x-officialForm.inputText>
        </div>
        <div class=" mt-2">
            <label for="">{{ __('Debtor 2 (if applicable):') }}</label>
            <x-officialForm.inputText name="Text7" class="" value="{{$spousename}}"></x-officialForm.inputText>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="row">
            <div class="col-md-5 pt-2">
                <p>{{ __('Social Security No.:') }} XXX‐XX‐</p>
                <div class="pt-2">
                    <p>{{ __('Social Security No.:') }} XXX‐XX‐</p>
                </div>
            </div>
            <div class="col-md-7">
                <x-officialForm.inputText name="Text4" class="w-auto" value="{{$ssn1}}"></x-officialForm.inputText>
                <x-officialForm.inputText name="Text5" class="mt-2 w-auto" value="{{$ssn2}}"></x-officialForm.inputText>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline">{{ __('DECLARATION OF FILING RE: ELECTRONIC SIGNATURES ') }}<sup> 1 </sup></h3>
        <p class="mt-3"><span class="pl-4"></span>
        {{ __("By my below physical, wet signature, I, Debtor 1 and Debtor 2 (as applicable), hereby swear under penalty of perjury pursuant to 28 U.S.C. § 1746, that I have reviewed the information contained in my bankruptcy petition, schedules and statements and I declare, to the best of my knowledge, information and belief that the information in my bankruptcy petition and schedules is true and correct. I hereby affirm the each of the electronic or typewritten signatures in my bankruptcy petition, schedules and statements as my own true signature.") }}
        </p> 
    </div>

    <div class="col-md-8 mt-2 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Debtor 1:"
            inputFieldName="Text1"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>
    
    <div class="col-md-8 mt-2 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Signature of Debtor 2:"
            inputFieldName="Text2"
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVertical>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date_2"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>

    <div class="col-md-8 mt-2 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Corporate Debtor: "
            inputFieldName="Text3"
            inputValue="">
        </x-officialForm.debtorSignVertical>
        <p class="mt-1 mb-0 text-center pl-5"><span class="pl-5 ml-2"></span>{{ __("Signature of authorized representative of the debtor") }}</p>
    </div>
    <div class="col-md-4 mt-2">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date_3"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingle>
    </div>

    <div class="col-md-8 mt-2 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Printed Name: "
            inputFieldName="Printed Name"
            inputValue="">
        </x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-4 mt-2"></div>
    <div class="col-md-4 border_1px mt-3 pl-0"></div>
    <div class="col-md-8 mt-3"></div>

    <div class="col-md-12 mt-3"> 
        <p> 
            <sup> 1 </sup> {{ __("Pro se parties using the Bankruptcy Clerk’s eSR (electronic Self‐Representation) program to complete the petition, schedules and statements must submit this document to the Bankruptcy Clerk’s Office, 1125 Chapline Street, Suite 314, PO Box 70, Wheeling, WV 26003.") }}
        </p>
        <p>
        {{ __("Attorneys electronically filing cases for debtors may, in lieu of having the debtor physically sign the petition schedules and statements, retain a signed copy of this Declaration in the debtor’s case file. This Declaration may be shown at the meeting of creditors as evidence of the debtor’s original signatures on the petition, schedules and statements. An attorney may, but is not required to, file this Declaration with the Bankruptcy Clerk.") }}
        </p>
    </div>

</div>
