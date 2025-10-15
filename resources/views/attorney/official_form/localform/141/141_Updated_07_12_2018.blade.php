<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF KANSAS') }}</h3>
    </div>

    <div class="col-md-5 border_1px p-3 br-0">
        <div class="input-group d-flex">
            <div class="">
                <label>{{ __('In') }}&nbsp;{{ __('re:') }}</label>
            </div>
            <div class="w-100 pl-3">
                <input type="text" name="<?php echo base64_encode('Debtor1');?>" value="{{$onlyDebtor}}" class="form-control">
                <input type="text" name="<?php echo base64_encode('Debtor2');?>" value="{{$spousename}}" class="form-control mt-1">
                <label class="">{{ __('Debtor(s) Name(s) and') }} </label>
            </div>
            
           
        </div>
    </div> 
    <div class="col-md-3 border_1px p-3 br-0 bl-0">
        <div class="input-group ">
            <input type="text" name="<?php echo base64_encode('SSN1');?>" class="form-control" value="{{$ssn1}}">
            <input type="text" name="<?php echo base64_encode('SSN2');?>" class="form-control mt-1" value="{{$ssn2}}">
            <label class="">{{ __('Full Social Security Number(s)') }}</label>
        </div>
    </div>
    <div class="col-md-4 border_1px p-3">
        <div class="">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center ">{{ __('DECLARATION RE: ELECTRONIC FILING') }}</h3>
    </div>
  
    <div class="col-md-12">
        <p class=" p_justify">
            I [We] 
            <input type="text" name="<?php echo base64_encode('Debtor1');?>" value="{{$onlyDebtor}}" class="form-control width_30percent">
            and 
            <input type="text" name="<?php echo base64_encode('Debtor2');?>" value="{{$spousename}}" class="form-control width_30percent">
             {{ __(', the undersigned debtor(s), corporate
            officer, partner, or member, hereby declare under penalty of perjury that I [we] have reviewed the information provided in the
            electronically filed petition, statements, and schedules, and the information is true and correct. I [We] further declare under
            penalty of perjury that the foregoing Social Security number(s) and/or Individual Taxpayer Identification Number(s) is [are]
            true and correct. I [We] consent to my [our] attorney filing my [our] petition, this declaration, statements, and schedules, and
            any future amendments of these documents with the United States Bankruptcy Court, United States Trustee, and Panel Trustee.') }}
        </p>
        <p class=" p_justify">
            <input type="checkbox" name="<?php echo base64_encode('ck1');?>" value="On" class="form-control w-auto">
            {{ __('I [We] declare under penalty of perjury that I [we] do not have either a Social Security Number or an Individual Taxpayer
            Identification Number.') }}
        </p> 
        <p class=" p_justify">
            <input type="checkbox" name="<?php echo base64_encode('ck2');?>" value="On" class="form-control w-auto">
            {{ __('[If petitioner is an individual whose debts are primarily consumer debts and has chosen to file under chapter 7:] I am aware
            that I may proceed under chapter 7, 11, 12, or 13 of 11 United States Code, understand the relief available under each such
            chapter, and choose to proceed under chapter 7. I request relief in accordance with the chapter specified in the petition.') }}
        </p> 
        <p class=" p_justify">
            <input type="checkbox" name="<?php echo base64_encode('ck3');?>" value="On" class="form-control w-auto">
            {{ __('[If petitioner is a corporation, partnership, or limited liability entity:] I declare under penalty of perjury that the information
            provided in this petition is true and correct, and that I have been authorized to file this petition on behalf of the debtor. The
            debtor requests relief in accordance with the chapter specified in this petition.') }}
        </p> 
    </div>
    
    <div class="col-md-1">
        <label class="text-bold">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 1"
            inputFieldName="Text1"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-4">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor 2"
            inputFieldName="Text2"
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
        <label class="text-bold">{{ __('(If joint case, both spouses must sign)') }}</label>
    </div>
    <div class="col-md-3"></div>

    
    <div class="col-md-5 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date1"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Authorized Corporate Officer, Partner, or Member"
            inputFieldName=""
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-3 mt-3"></div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">
            {{ __('Submitted by (complete this section if represented by an attorney):') }}
        </p>
    </div>

    <div class="col-md-6 mt-3 text-bold">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3 text-bold">
        <div class="">
            <x-officialForm.debtorSignVertical
                labelContent="Signed: "
                inputFieldName="Text3"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney for Debtor(s), Kansas Bar No.: "
                inputFieldName="KsBarNo"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney Address: "
                inputFieldName="AttyAddr1"
                inputValue="{{$attonryAddress1}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVertical
                labelContent=""
                inputFieldName="AttyAddr2"
                inputValue="{{$attonryAddress2}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVertical
                labelContent=""
                inputFieldName="AttyAddr3"
                inputValue="{{$clientCity}} {{$clientState}}, {{$clientZip}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney Phone No.: "
                inputFieldName="AttyTelNo"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class=" mt-1">
            <x-officialForm.debtorSignVertical
                labelContent="Attorney E-mail Address: "
                inputFieldName="AttyEmailAddr"
                inputValue="{{$attorney_email}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="mt-3">{{ __('IMPORTANT NOTICE AND FILING INSTRUCTIONS') }}</h3>
        <p class="mb-0 mt-1">{{ __('Sign this document manually, scan the signed document, and file this Declaration electronically under seal with the Court.') }}</p>
        <p class="mb-0 text_italic">In CM/ECF, use only the Bankruptcy > Other > {{ __('Declaration Re: Electronic Filing event.') }}</p>
        <p class="mb-0 ">{{ __('Failure to timely file this Declaration will cause the case to be dismissed without further notice.') }}</p>
    </div>

</div>