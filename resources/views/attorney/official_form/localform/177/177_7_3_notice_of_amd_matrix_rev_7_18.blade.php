<div class="row">

    <div class="col-md-12 mb-3 text-center pr-0 pl-0">
        <h3 class="mb-3 text-c-red  border_bottom_1px pb-2">{{ __("Example") }}<br>{{ __("Ch. 7 Notice Adding Creditor(s) to Matrix ONLY (No Amended Schedules") }})</h3>
        <h3 class="">{{ __("United States Bankruptcy Court") }}<br> {{ __("Southern District of Mississippi") }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <div class="input-group">
            <label>In re:</label>
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
           <label for="">{{ __("Chapter 7") }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p><span class="text-bold pr-2">{{ __("To:") }}</span><span class="text-bold">{{ __("Affected Party") }}</span>
            <span class="text_italic text-c-gray pr-1"> [{{ __("List name & address of each affected creditor or attach a list containing the name & address of each affected creditor") }}]</span>
        </p>
        <p class="text-bold"><span class="pl-4"></span>{{ __("U. S. Trustee") }}</p>
        <p><span class="text-bold pl-4">{{ __("Case Trustee") }}</span> <span class="text_italic text-c-gray pr-1">[{{ __("Input Trustee's Name") }}]</span></p>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline mb-3">{{ __("Notice of Amendment to Debtor's List of Creditors/Mailing Matrix") }}</h3>
        <p class="">
            <span class="text-bold pl-4">{{ __("Please take notice") }}</span>
            {{ __("the debtor(s) named above filed with the Bankruptcy Court an amended List of Creditors/Mailing Matrix adding one or more creditors.") }}
        </p> 
        <p class="">
            <span class=" pl-4"></span>
            {{ __("If the affected creditor wishes to examine the debtor(s) under oath, the creditor has the right to request an adjourned § 341(a) creditor's meeting. The request must be made with the U.S. Trustee, 501 East Court St., Ste. 6-430, Jackson, MS 39201, within") }} 
            <span class="text-bold"> {{ __("21 days") }} </span>
            {{ __("from the date of this notice. (See copy of the original") }}  
            <span class="text_italic">{{ __("Notice  of Chapter 7 Bankruptcy Case") }} </span>
           ( “{{ __('§ 341 Meeting of Creditors Notice') }}  ”)
            {{ __('attached.') }})
        </p> 
        <p><span class="pl-4"></span>
            {{ __("The affected creditor has") }} 
            <span class="text-bold"> {{ __("60 days") }} </span>  
            {{ __("from the date of this notice to file, with the U.S. Bankruptcy Court, a complaint objecting to the debtor's discharge under § 727(a) of the Bankruptcy Code, a complaint to determine the dischargeability of a debt under § 523(c) of the Bankruptcy Code, a motion objecting to discharge under §§ 727(a)(8) or (a)(9) of the Bankruptcy Code, or to file a motion to seek an extension of time for filing a complaint or a motion objecting to discharge, unless a longer period of time is provided by Rules 4004, 4007, and 9006, of the Federal Rules of Bankruptcy Procedure") }}
        </p>
        <p><span class="pl-4"></span>
            {{ __("The affected creditor is given") }}
            <span class="text-bold">{{ __("30 days") }} </span>
            {{ __("from the conclusion of the meeting of creditors or") }} 
            <span class="text-bold"> {{ __("30 days") }} </span>
            {{ __("from the date of this notice, whichever is later, to file with the U.S. Bankruptcy Court an objection to the list of property claimed as exempt.") }}
        </p>
        <p><span class="pl-4"></span>
            {{ __('If the attached § 341 Meeting of Creditors Notice contains language') }} 
                 “  {{ __('Please do not file a proof of claim unless you receive notice to do so. ') }} ” , 
                    {{ __('then, you do not need to file a claim at this time. However, if the notice contains a Proof of Claim deadline, you have') }} 
            <span class="text-bold"> {{ __("70 days") }} </span>
            {{ __("from the date of this notice to file a Proof of Claim with the U.S. Bankruptcy Court. A Proof of Claim form (Official Form 410) may be obtained at") }}
            <a href="#"><span class="underline text-c-blue">{{ __("www.uscourts.gov") }} </span></a>  
            {{ __("or any bankruptcy clerk's office.") }}
        </p>
        <p><span class="pl-4"></span>{{ __("Address of the U.S. Bankruptcy Court is provided on the attached § 341 Meeting of Creditors Notice.") }}</p>
    </div>

    <div class="col-md-6 mt-3 pl-5">
        <x-officialForm.dateSingleHorizontal
            labelText='{{ __("Date") }}'
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent='{{ __("Signature of Attorney for Debtor(s)") }}'
            inputFieldName="Text17"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline mb-3">{{ __("Certificate of Services") }}</h3>
        <p class="">
            <span class="pl-4"></span> 
            {{ __("I, the undersigned attorney for the above referenced debtor(s), do hereby certify that I have this date served a true and correct copy of the notice of amendment and the § 341 Meeting of Creditors Notice to the affected creditor(s) via First Class U.S. Mail and the case trustee and U.S. Trustee via Notice of Electronic Filing (NEF) through the ECF system.") }}
        </p> 
    </div>
    <div class="col-md-6 mt-3 pl-5">
        <x-officialForm.dateSingleHorizontal
            labelText='{{ __("Date") }}'
            dateNameField="Date_2"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent='{{ __("Signature of Attorney for Debtor(s)") }}'
            inputFieldName="Text18"
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
        <textarea name="<?php echo base64_encode('Text19')?>" value="" class="form-control" rows="5" cols="">{{$attorney_name}}, {{$attorney_state_bar_no}}
{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorney_email}}</textarea>
    </div>
</div>