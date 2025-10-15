<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE WESTERN DISTRICT OF VIRGINIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="TextBox0"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-3 text-bold">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="TextBox1"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-3">
            <label class="text-bold">{{ __('Chapter 7') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center text-center">{{ __('NOTICE AND MOTION TO CONVERT FROM CHAPTER 7 TO CHAPTER 13') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('Comes now the above-named debtor(s), by counsel, and moves this honorable court to
            convert this case from chapter 7 to chapter 13.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('In support of said motion the debtor(s) further state that the reason the debtor(s) wish to
            convert their case is') }}: (<span class=" text-c-red text_italic text-bold">{{ __('SUMMARY OF REASONS FOR CONVERSION') }}</span>) .
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('The debtor(s) further state that') }} (<span class=" text-c-red text_italic text-bold">{{ __('STATE WHETHER CASE WAS PREVIOUSLY
            CONVERTED OR NOT') }}</span>).
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __("A copy of this motion is being served on the case trustee, the U. S. Trustee's Office, and all
            creditors.") }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="TextBox2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class="text-center">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Attorney for the Debtor(s)"
                inputFieldName="TextBox3"
                inputValue={{$attorny_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class="text-bold col-md-12 mt-3">
        <p>
        {{ __('IF THIS CASE HAS') }} <span class=" underline">{{ __('NOT') }}</span> {{ __('PREVIOUSLY BEEN CONVERTED:') }}<br><br>
            {{ __('The conversion of this case will be effective on the date of docketing of the Order of
            Conversion without necessity of a hearing unless timely objection to this motion is filed with
            the court and the objecting party schedules and notices a hearing pursuant to Local Rule
            1017-3.') }}
        </p>
    </div>

</div>