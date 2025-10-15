<div class="row">
     <div class="district205 col-md-12 text-center">
        <div class="row">
            <div class="district205 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF NEW HAMPSHIRE') }}</h2>
            </div>
        </div>
    </div>
    <div class="district205 col-md-12 mt-3 border_1px">
        <div class="row">
            <div class="district205 col-md-6 p-3 border_right_1px">
                <x-officialForm.inReDebtorCustom
                    debtorNameField="Text1"
                    debtorname={{$debtorname}}
                    rows="3">
                </x-officialForm.inReDebtorCustom>
            </div>
            <div class="district205 col-md-6 p-3">
                <x-officialForm.caseNo
                    labelText="BK NO.:"
                    casenoNameField="Text2"
                    caseno={{$caseno}}>
                </x-officialForm.caseNo>
                <div class="mt-3">
                    <x-officialForm.caseNo
                        labelText="Chapter"
                        casenoNameField="Text3"
                        caseno={{$chapterNo}}>
                    </x-officialForm.caseNo>
                </div>
            </div>
        </div>
    </div>
    <div class="district205 col-md-12">
        <div class="row">
            <div class="district205 col-md-12 mt-3">
                <h3 class="text-center underline mb-3">{{ __('VERIFICATION OF CREDITOR MAILING LIST') }}</h3> 
                <p class="pl-3">
                {{ __('The above named debtor hereby certifies under penalty of perjury that the attached master mailing list of creditors, consisting of') }}
                <input name="<?php echo base64_encode('Text4'); ?>" value="<?php echo $creditors_count; ?>"  type="text" class="form-control width_5percent">
                {{ __('pages is complete, correct and consistent with the debtor’s schedules pursuant to LBRs and assumes all responsibility for errors and omissions.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district205 col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="DATED:"
            dateNameField="Text5"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="district205 col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName="Text6"
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Print Name"
                inputFieldName="Text7"
                inputValue="{{$onlyDebtor}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Address"
                inputFieldName="Text8"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
        <div class="row mt-2">
            <div class="col-md-4"></div>
            <div class="col-md-8"> 
                <x-officialForm.inputText name="Text9" class="" value=""></x-officialForm.inputText>      
            </div>
        </div>
        <div class="mt-2 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Tel. No."
                inputFieldName="Text10"
                inputValue="">
            </x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>
