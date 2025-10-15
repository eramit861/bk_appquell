<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE EASTERN DISTRICT OF TEXAS') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor(s)"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="CaseNo"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>          
        </div>          
    </div>

    <div class="col-md-12 mb-3 mt-3">
        <h3 class="text-center">
        {{ __('DECLARATION FOR ELECTRONIC FILING OF AMENDED PETITION') }},<br>
            {{ __('ORIGINAL/AMENDED BANKRUPTCY STATEMENTS AND SCHEDULES,') }}<br>
            <span class="underline">{{ __('AND/OR AMENDED MASTER MAILING LIST (MATRIX)') }}</span>
        </h3>
    </div>

    <div class="col-md-12 mb-3">
        <p>
            <span class="pl-4"></span>
            {{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the
            corporation, partnership, or limited liability company named as the debtor in this case') }}, 
            <span class="text-bold text_italic">{{ __('I hereby declare under penalty of perjury') }}</span>
             {{ __('that I have read') }}
        </p>
        <div class="d-flex pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check1'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p>
                    {{ __('the original statements and schedules to be filed electronically in this case') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check2'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p>
                    {{ __('the voluntary petition as amended on the date indicated below and to be filed electronically
                    in this case') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check3'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p>
                    {{ __('the statements and schedules as amended on the date indicated below and to be filed
                    electronically in this case') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-4">
            <input type="checkbox" name="<?php echo base64_encode('Check4'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p>
                    {{ __('the master mailing list (matrix) as amended on the date indicated below and to be filed
                    electronically in this case') }}
                </p>
            </div>
        </div>
        <p>
            {{ __('and that the information provided therein is true and correct. I understand that this Declaration is to be
            filed with the Bankruptcy Court within seven (7) business days after such statements, schedules, and/or
            amended petition or matrix have been filed electronically. I understand that a failure to file the signed
            original of this Declaration as to any original statements and schedules will result in the dismissal of my
            case and that, as to any amended petition, statement, schedule or matrix, such failure may result in the
            striking of the amendment(s).') }}
        </p>
        <div class="d-flex">
            <input type="checkbox" name="<?php echo base64_encode('Check5'); ?>" class="form-control w-auto height_fit_content" value="Yes">
            <div class="pl-2">
                <p class="mb-0">
                <span class="text_italic">{{ __('[Only include if petitioner is a corporation, partnership or limited liability company]') }}</span> {{ __('-
                I hereby further declare under penalty of perjury that I have been authorized to file the statements,
                schedules, and/or amended petition or amended matrix on behalf of the debtor in this case.') }}
                </p>
            </div>
        </div>

    </div>

    <div class="col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="DateSigned"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>


  <?php


    $dssn = Helper::validate_key_value('security_number', $BasicInfoPartA);
            $dssn = $volPetData[base64_encode('Form101-Debtor1.SSNum')] ?? $dssn;

            $dssn2 = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
            $dssn2 = $volPetData[base64_encode('Form101-Debtor2 SSNum')] ?? $dssn2;



            ?> 



    <div class="col-md-8"></div>

    <div class="col-md-4"></div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('Text56'); ?>"  value="{{$debtor_sign ?? ''}}" class="form-control">
        <label class="float_right">{{ __(', Debtor') }}</label>
        <div class="mt-4 w-100 pl-1 text-bold">
            <x-officialForm.debtorSignVertical
                labelContent="Soc. Sec. No."
                inputFieldName="DbtrSSN"
                inputValue="{{$dssn ?? ''}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="w-100 text-center">
            <label class="">{{ __('OR') }}</label>
        </div>
        <div class="w-100">
            <label class="float_right">{{ __(', Position/Capacity') }}</label>
        </div>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('Text57'); ?>" value="{{$debtor2_sign ?? ''}}" class="form-control">
        <label class="float_right">{{ __(', Joint Debtor') }}</label>
        <div class="mt-4 w-100 pl-1 text-bold">
            <x-officialForm.debtorSignVertical
                labelContent="Soc. Sec. No. "
                inputFieldName="JDbtrSSN"
                inputValue="{{$dssn2 ?? ''}}"
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>