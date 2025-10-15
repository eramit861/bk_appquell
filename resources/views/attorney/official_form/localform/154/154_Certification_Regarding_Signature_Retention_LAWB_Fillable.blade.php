<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Western District of Louisiana') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text1"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Chapter:"
            casenoNameField="Text2"
            caseno={{$chapterNo}}>
        </x-officialForm.caseNo> 
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Case Number:"
                casenoNameField="Text3"
                caseno="{{$caseno}}">
            </x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-3">
         {{ __('CERTIFICATION REGARDING RETENTION OF DOCUMENTS') }}<br>{{ __('PURSUANT TO ARTICLE VII OF GENERAL ORDER 2020-4') }}
         </h3>
         <p class="mb-3 p_justify">
            I, <input type="text" name="<?php echo base64_encode('I'); ?>" class="form-control width_30percent" value="{{$attorney_name}}">
            {{ __(', counsel for the debtor(s) in the above captioned case, hereby certify under penalty of perjury that
            for any document filed on behalf of the debtor(s) in this case without having the original signature(s)
            in my possession at the time, pursuant to Article VII of the Court’s March 19, 2020 General Order 2020-4
            (“General Order Temporarily Modifying Article VII of This Court’s Administrative Procedures”), I:') }}
        </p>
        <div class="pl-4 mt-3">
            <p>{{ __('(i) transmitted the entire document to the debtor(s) for review and signature,') }}</p>
            <p>{{ __('(ii) communicated with the debtor(s) regarding the substance and purpose of the document,') }}</p>
            <p>{{ __('(iii) received express authorization from the debtor(s) to file the document, and') }}</p>
            <p>{{ __('(iv) have obtained a representation from the debtor(s) (either by text, email, facsimile orverbally) that the debtor(s) has (have) in fact signed the document.') }}</p>
        </div>
        <p class="p_justify mb-3">
            {{ __('Furthermore, I hereby certify that I have now received from the debtor(s) any document(s) bearing the original signature of the debtor(s)
            and will maintain such document(s) in accordance with Article VII of the Court’s Administrative Procedures.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <div class="d-flex">
            <label>/s/</label>
            <div class="w-100">
                <input type="text" name="<?php echo base64_encode('s'); ?>" class="form-control" value="{{$attorny_sign}}">
                <textarea name="<?php echo base64_encode('Text4'); ?>"  class="form-control mt-1" rows="8">{{$attorney_name}}
{{$attorney_state_bar_no}}
{{$attonryAddress1}}
{{$attonryAddress2}}
{{$attorney_city}} {{$attorney_state}}, {{$attorney_zip}}
{{$attorneyPhone}}
{{$attorney_email}}</textarea>
            </div>
        </div> 
    </div>

</div>