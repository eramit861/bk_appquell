<div class="text-center">
    <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
    {{ __('FOR THE WESTERN DISTRICT OF TEXAS') }}  </h3>
</div>
<div class="row my-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="IN RE"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
                <x-officialForm.caseNo
                    labelText="Case No."
                    casenoNameField="Case No"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
    </div>
    <div class="text-center mt-3 mb-3">
        <h3>{{ __('DECLARATION FOR ELECTRONIC FILING OF AMENDED PETITION,') }}<br>
            ORIGINAL/AMENDED BANKRUPTCY STATEMENTS AND SCHEDULES,<br>
        <span class="underline">{{ __('AND/OR AMENDED MASTER MAILING LIST (MATRIX)') }}</span></h3>
    </div>

    <p><span class="pl-5"></span>{{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the
       corporation, partnership, or limited liability company named as the debtor in this case') }} <span class="text_italic text-bold"> {{ __('I hereby declare
       under penalty of perjury') }} </span> {{ __('that I have read') }}</p>
    <div class="d-flex mt-3 pl-4">
        <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes">
        <div>
            <label>{{ __('the original statements and schedules to be filed electronically in this case') }}</label>
        </div>
    </div>
    <div class="d-flex mt-3 pl-4">
        <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box6'); ?>" value="Yes">
        <div>
          <label>{{ __('the voluntary petition as amended on the date indicated below and to be filed electronically in this case') }}</label>
        </div>
    </div>
    <div class="d-flex mt-3 pl-4">
        <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box7'); ?>" value="Yes">
        <div>
            <label>{{ __('the statements and schedules as amended on the date indicated below and to be filed electronically in this case') }}</label>
        </div>
    </div>
    <div class="d-flex mt-3 pl-4">
        <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box8'); ?>" value="Yes">
        <div>
          <label>{{ __('the master mailing list (matrix) as amended on the date indicated below and to be filed electronically in this case') }}</label>
        </div>
    </div>

    <p class="mt-3">{{ __('and that the information provided therein is true and correct. I understand that this Declaration is to be
    filed with the Bankruptcy Court within seven (7) business days after such statements, schedules, and/or
    amended petition or matrix have been filed electronically. I understand that a failure to file the signed
    original of this Declaration as to any original statements and schedules will result in the dismissal of my
    case and that, as to any amended petition, statement, schedule or matrix, such failure may result in the
    striking of the amendment(s).') }}</p>

    <div class="d-flex mt-3">
        <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box9'); ?>" value="Yes">
        <div>
          <label><span class="text_italic">{{ __('[Only include if petitioner is a corporation, partnership or limited liability company] –') }}</span><br>
          {{ __('I hereby further declare under penalty of perjury that I have been authorized to file the statements, schedules, and/or amended petition or amended matrix on behalf of the debtor in this case.') }}</label>
        </div>
    </div>

<div class="row mt-3">
    <div class="col-md-12">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="undefined"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <x-officialForm.signVertical
            labelText="Debtor"
            signNameField="Text1"
           sign="{{$debtor_sign ?? ''}}">
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-4">
        <x-officialForm.signVertical
            labelText="Joint Debtor"
            signNameField="Text2"
           sign="{{$debtor2_sign ?? ''}}">
        </x-officialForm.signVertical>
    </div>
</div>
 