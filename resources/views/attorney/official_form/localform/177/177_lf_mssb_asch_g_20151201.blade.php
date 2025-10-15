<div class="row">

    <div class="col-md-12 mb-3 text-center">
        <h3 class="mb-3 text-c-red">{{ __("Example") }}<br>
            {{ __("Notice of Amendment Schedule G: Executory Contracts and Unexpired Leases") }}</h3>
        <h3 class="">{{ __("United States Bankruptcy Court") }}
            <br> {{ __("Southern District of Mississippi") }}</h3>
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
                labelText='{{ __("Chapter") }}'
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <p><span class="text-bold pr-2">{{ __("To:") }}</span>
        <span class="text-bold">{{ __("Affected Party") }}</span>
            <span class="text_italic">[{{ __("List name & address of each affected party or attach a list containing the name & address of each affected party") }}]</span>
        </p>
        <p><span class="text-bold pl-4">{{ __("Case Trustee") }}</span> <span class="text_italic">[{{ __("Input Trustee's Name") }}]</span></p>
        <p class="text-bold"><span class="pl-4"></span>{{ __("U. S. Trustee") }}</p>
    </div>
    <div class="col-md-12 mt-3 mb-2">
        <h3 class="text-center underline mb-3">{{ __("Notice of Amendment of Schedule G") }}</h3>
        <p class="">
            <span class="text-bold pl-4"> {{ __("You are hereby notified") }} </span> 
                {{ __("above named debtor(s) has filed with the U.S. Bankruptcy Court an") }} 
            <span  class="text_italic">{{ __("Amended Schedule G: Executory Contracts and Unexpired Leases") }} </span>
             ({{ __("see attached amended schedule") }}).
        </p> 
        <p class="">
            <span class="text-bold pl-4">{{ __("You are further notified") }} </span>
                {{ __("that the debtor's(s) bankruptcy case was filed on") }}
            <input name="<?php echo base64_encode('date Documents filed in the case may be inspected at either location')?>" placeholder="MM/DD/YYYY" type="text" value="{{$currentDate}}" class="date_filed width_auto form-control">
            ({{ __("date") }}).
            {{ __("Documents filed in the case may be inspected at either location of the Clerk's office:") }}
        </p> 
    </div>
    <div class="col-md-6 mt-3">
        <p class="mb-0">{{ __("Clerk, U.S. Bankruptcy Court") }}</p>
        <p class="mb-0">{{ __("Dan M. Russell, Jr. U.S. Courthouse") }}</p>
        <p class="mb-0">{{ __("2012 15th Street, Suite 244") }}</p>
        <p class="mb-0">{{ __("Gulfport, MS 39501") }}</p>
    </div>
    <div class="col-md-6 mt-3">
        <p class="mb-0">{{ __("Clerk, U.S. Bankruptcy Court") }}</p>
        <p class="mb-0">{{ __("United States Courthouse") }}</p>
        <p class="mb-0">{{ __("501 East Court Street, Suite 2.300") }}</p>
        <p class="mb-0">{{ __("Jackson, MS 39201") }}</p>
        <div class="mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent='{{ __("Signature of Attorney for Debtor(s)") }}'
            inputFieldName="Text29"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

     <div class="col-md-12 mt-3"> 
        <h3 class="text-center underline mb-3">{{ __("Certificate of Service") }}</h3>
        <p> <span class="pl-4"></span>
            {{ __("I the undersigned attorney for the above referenced debtor(s) do hereby certify that I have this date served a true and correct copy of the") }} 
            <span class="text_italic"> {{ __("Notice of Amendment and Amended Schedule G: Executory Contracts and Unexpired Leases") }} </span> 
            {{ __("affected party(ies) via First Class U.S. Mail and the case trustee and U.S. Trustee via Notice of Electronic Filing (NEF) through the ECF system.") }}
        </p> 
     </div> 
     <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText='{{ __("Date") }}'
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
     </div>
     <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent='{{ __("Signature of Attorney for Debtor(s)") }}'
            inputFieldName="Text30"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
     </div>
     
    <div class="col-md-6 mt-3">
        <p class="mb-1">{{ __("Name of Attorney, MS Bar #") }}</p>
        <p class="mb-1">{{ __("Address") }}</p>
        <p class="mb-1">{{ __("City, State, Zip") }}</p>
        <p class="mb-1">{{ __("Telephone Number") }}</p>
        <p class="mb-1">{{ __("E-mail address") }}</p>
    </div>
    <div class="col-md-6 mt-3">
        <textarea name="<?php echo base64_encode('Text31')?>" value="" class="form-control" rows="5" cols="">{{$attorney_name}}, {{$attorney_state_bar_no}}
{{$attonryAddress1}}, {{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorney_email}}</textarea>
    </div>
</div>
