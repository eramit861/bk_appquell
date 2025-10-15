<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <div class="row">
            <div class="col-md-2 pt-2 pr-0">
                <label>{{ __('In Re:') }}</label>
            </div>
            <div class="col-md-10">
                <textarea name="<?php echo base64_encode('Text50')?>" class="form-control" rows="2">{{$debtorname}}</textarea>
                <label class="float_right">{{ __('Debtor') }}</label>
            </div>
            <div class="col-md-2 mt-3 pt-2 pr-0">
                <label>{{ __('Movant') }}</label>
            </div>
            <div class="col-md-10 mt-3">
                <x-officialForm.inputText name="Text51" class="" value=""></x-officialForm.inputText>
                <label>v.</label>
                <x-officialForm.inputText name="Text52" class="" value=""></x-officialForm.inputText>
                <label>{{ __('Respondent (if none, then “No Respondent”)') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
                labelText="Bankruptcy No."
                casenoNameField="Text53"
                caseno={{$caseno}}>
        </x-officialForm.caseNo>
        <div class="mt-1">
            <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text54"
                    caseno={{$chapterNo}}>
            </x-officialForm.caseNo>
        </div>
        <div class="row mt-1">
            <div class="col-md-3 pt-2 pr-0">
                <label>{{ __('Related to Document No.') }}</label>
            </div>
            <div class="col-md-9">
                <x-officialForm.inputText name="Text55" class="w-auto" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3 mt-1 pt-2 pr-0">
                <label>{{ __('Hearing Date and Time') }}</label>
            </div>
            <div class="col-md-9 mt-1">
                <x-officialForm.inputText name="Text56" class="" value=""></x-officialForm.inputText>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">
        {{ __('SUMMARY COVER SHEET AND NOTICE OF HEARING ON PROFESSIONAL FEES IN CHAPTERS 7, 12 AND 13 ON BEHALF OF') }}
            <x-officialForm.inputText name="IN CHAPTERS 7 12 AND 13 ON BEHALF OF" class="width_50percent" value=""></x-officialForm.inputText>
        </h3>
        <p>
            {{ __('To All Creditors and Parties in Interest:') }}
        </p>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">1.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                {{ __('Applicant represents') }}
                    <x-officialForm.inputText name="To All Creditors and Parties in Interest" class="width_50percent" value=""></x-officialForm.inputText>
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">2.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                    {{ __('This is (check one)') }}
                </p>
                <div class="pl-4">
                    <p class="mb-2">
                        <x-officialForm.inputCheckbox name="Check Box1" class="" value="Yes"></x-officialForm.inputCheckbox>
                        {{ __('a final application') }}
                    </p>
                    <p class="">
                        <x-officialForm.inputCheckbox name="Check Box2" class="" value="Yes"></x-officialForm.inputCheckbox>
                        {{ __('an interim application') }}
                    </p>
                    <p class="">
                    {{ __('for the period') }}
                        <x-officialForm.inputText name="an interim application" class="w-auto" value=""></x-officialForm.inputText>
                        {{ __('to') }}
                        <x-officialForm.inputText name="undefined" class="w-auto" value=""></x-officialForm.inputText>
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">3.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                {{ __('Previous retainer paid to Applicant') }}: $
                    <x-officialForm.inputText name="to" class="w-auto price-field" value=""></x-officialForm.inputText>
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">4.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                {{ __('Previous interim compensation allowed to Applicant') }}: $
                    <x-officialForm.inputText name="Previous interim compensation allowed to Applicant" class="w-auto price-field" value=""></x-officialForm.inputText>
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <label for="">5.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                    {{ __('Applicant requests additional:') }}
                </p>
                <div class="pl-4">
                    <p class="mb-2">
                    {{ __('Compensation of') }} $
                        <x-officialForm.inputText name="Applicant requests additional" class="w-auto price-field" value=""></x-officialForm.inputText>
                    </p>
                    <p class="">
                    {{ __('Reimbursement of Expenses of') }} $
                        <x-officialForm.inputText name="Reimbursement of Expenses of" class="w-auto price-field" value=""></x-officialForm.inputText>
                    </p>
                    <p class="">
                    {{ __('for the period') }}
                        <x-officialForm.inputText name="" class="w-auto" value=""></x-officialForm.inputText>
                        {{ __('to') }}
                        <x-officialForm.inputText name="" class="w-auto" value=""></x-officialForm.inputText>
                    </p>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">6.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                {{ __('A hearing on the Application will be held in Courtroom') }}
                    <x-officialForm.inputText value="" class="w-auto" name="undefined_2"></x-officialForm.inputText>
                    ,
                    <x-officialForm.inputText value="" class="w-auto" name="at"></x-officialForm.inputText>
                    , at
                    <x-officialForm.inputText value="" class="w-auto" name="m on"></x-officialForm.inputText>
                    .m., on
                    <x-officialForm.inputText value="" class="w-auto" name="A hearing on the Application will be held in Courtroom"></x-officialForm.inputText>
                    ,
                    <x-officialForm.inputText value="" class="w-auto" name="undefined_3"></x-officialForm.inputText>
                    .
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4 pt-2">
                <label for="">7.</label>
            </div>
            <div class="w-100 pl-3">
                <p>
                {{ __('Any written objections must be filed with the court and served on the Applicant on or before') }}
                    <x-officialForm.inputText name="7 Any written objections must be filed with the court and served on the Applicant on or before" class="w-auto" value=""></x-officialForm.inputText>
                    ,
                    <x-officialForm.inputText name="fourteen 14 days from the date of this notice plus an additional three 3 days" class="w-auto" value=""></x-officialForm.inputText>
                    {{ __(', (fourteen (14) days from the date of this notice plus an additional three (3) days
                    if served by mail). Copies of the application are available from the applicant.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-3"></div>

    <div class="col-md-6 mt-3">
        <div class="">
            <x-officialForm.dateSingleHorizontal
                labelText="Date of service: "
                dateNameField="Text172"
                currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Applicant or Attorney for Applicant"
                inputFieldName="Date of service"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Typed Name"
                inputFieldName="Text173"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent=""
                inputFieldName="Typed Name 1"
                inputValue="{{$attonryAddress1}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Address"
                inputFieldName="Typed Name 2"
                inputValue="{{$attonryAddress2}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Phone No."
                inputFieldName="Address"
                inputValue="{{$attorneyPhone}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="List Bar I.D. and State of Admission"
                inputFieldName="Phone No"
                inputValue="{{$attorney_state_bar_no}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>
