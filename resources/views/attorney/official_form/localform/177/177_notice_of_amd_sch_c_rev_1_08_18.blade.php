<div class="row">

    <div class="col-md-12 mb-3 text-center pl-0 pr-0">
        <h3 class="mb-3 text-c-red border_bottom_1px pb-2">{{ __("Example") }}<br> {{ __("Ch. 7 – No Asset - Notice of Amendment (Amend Schedules & List of Creditors") }})</h3>
        <h3 class="">{{ __("United States Bankruptcy Court") }}<br> {{ __("Southern District of Mississippi") }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <div class="input-group">
            <label>{{ __("In re:") }}</label>
            <textarea name="<?php echo base64_encode('In re')?>" value="" class="form-control" rows="1" cols="">{{$onlyDebtor}}</textarea>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
        <x-officialForm.caseNo
            labelText='{{ __("Case No.") }}'
            casenoNameField="Case No"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText='{{ __("Chapter:") }}'
                casenoNameField="Chapter"
                caseno="{{$chapterNo}}">
            </x-officialForm.caseNo> 
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p>
            <span class="pr-2">{{ __("To:") }}</span>
            <span class="pr-1"> {{ __("Affected Party [attach copy of the Court's mailing matrix") }}] </span>
        </p>
        <p><span class="pl-4">{{ __("Case Trustee [Name of Trustee") }}]</span></p>
        <p><span class="pl-4"></span>{{ __("United States Trustee") }}</p>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline mb-3">{{ __("Notice of Amendment of Schedule C") }}</h3>
        <p class="">
            <span class="text-bold pl-4">{{ __("You are hereby notified") }}</span> 
                {{ __("the above named debtor(s) has filed with the U.S. Bankruptcy Court an") }} 
            <span class="text_italic">{{ __("Amended Schedule C: The Property You Claim as Exempt") }} </span>
            ({{ __("see attached amended schedule") }}).
        </p> 
        <p>
            <span class="text-bold pl-4">{{ __("You are further notified") }} </span> 
            {{ __("that any objection or other response to the list of property claimed as exempt must be filed with the U. S. Bankruptcy Court; a copy thereof served to the United States Trustee, Case Trustee, and Counsel for the Debtor(s), within 30 days after the conclusion of the meeting of creditors or within 30 days after service of this notice of amendment, whichever is later.") }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Signature of Attorney for Debtor(s)') }}"
            inputFieldName="Text8"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline mb-3">{{ __("Certificate of Service") }}</h3>
        <p class="">
            <span class="pl-4"></span> 
            {{ __("I, the undersigned attorney for the above referenced debtor(s), do hereby certify that I have this date served a true and correct copy of the") }} 
            <span class="text_italic"> {{ __("Notice of Amendment and Amended Schedule C: The Property You Claim as Exempt") }} </span> 
            {{ __("to all creditors via First Class U.S. Mail and the case trustee and U.S. Trustee via Notice of Electronic Filing (NEF) through the ECF system") }}
        </p> 
    </div>

    <div class="col-md-6 mt-3 pl-5">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Date') }}"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Signature of Attorney for Debtor(s)') }}"
            inputFieldName="Text9"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    
    <div class="col-md-6 mt-3">
        <p class="mb-1"> <span class="pl-4"></span> {{ __("Name of Attorney, MS Bar #") }}</p>
        <p class="mb-1"> <span class="pl-4"></span> {{ __("Address") }}</p>
        <p class="mb-1"> <span class="pl-4"></span> {{ __("City, State, Zip") }}</p>
        <p class="mb-1"> <span class="pl-4"></span> {{ __("Telephone Number") }}</p>
        <p class="mb-1"> <span class="pl-4"></span> {{ __("E-mail address") }}</p>
    </div>
    <div class="col-md-6 mt-3">
        <textarea name="<?php echo base64_encode('Text10')?>" value="" class="form-control" rows="5" cols="">{{$attorney_name}}, {{$attorney_state_bar_no}}
{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorney_email}}</textarea>
    </div>

</div>