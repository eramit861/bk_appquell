<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF WISCONSIN') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="form1[0].#subform[0].TextField1[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="form1[0].#subform[0].TextField2[0]"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="form1[0].#subform[0].TextField3[0]"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div> 

    <div class="col-md-12 mt-3 text-center">
        <h3>
            {{ __('Corporate Ownership Statement') }}
        </h3>
    </div>

    <div class="col-md-12 pl-4 mt-3">
        <p>{{ __('Pursuant to Fed. R. Bankr. P. 1007(a)(1), and to enable the Judge to evaluate possible disqualification or recusal, the Debtor states that:') }}</p>
    </div>

    <div class="col-md-12">
        <div class="d-flex mb-3">
            <div class="">
                <input type="checkbox" value="1" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox1[0]');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-4">
                <p>{{ __("the following corporations directly or indirectly own 10% or more of any class of the Debtor's equity interests:") }}</p>
                <textarea name="<?php echo base64_encode('form1[0].#subform[0].TextField4[0]');?>" id="" class="form-control" rows="5"></textarea>
            </div>
        </div>
        <p class="">{{ __('OR') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="1" name="<?php echo base64_encode('form1[0].#subform[0].CheckBox2[0]');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('there are no such entities to report.') }}</p>
                <p>I,
                    <input type="text" name="<?php echo base64_encode('form1[0].#subform[0].TextField5[0]');?>" class="form-control width_30percent">
                    , of
                    <input type="text" name="<?php echo base64_encode('form1[0].#subform[0].TextField10[0]');?>" class="form-control width_50percent">
                    {{ __('declare under penalty of perjury that I have read the foregoing statement and that it is true and
                    correct to the best of my information and belief.') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="form1[0].#subform[0].TextField8[0]"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <div class=" pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="By:"
                inputFieldName="Text1"
                inputValue="{{$attorny_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name and Title"
                inputFieldName="form1[0].#subform[0].TextField9[0]"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

</div>