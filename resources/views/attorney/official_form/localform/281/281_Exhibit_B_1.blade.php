<div class="text-center">
    <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
    {{ __('FOR THE WESTERN DISTRICT OF TEXAS') }}</h3>
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
<div class="text-center mt-3 mb-4">
    <h3>{{ __('DECLARATION FOR ELECTRONIC FILING OF BANKRUPTCY') }}<br>
    <span class="underline">{{ __('PETITION, LISTS, STATEMENTS, AND SCHEDULES') }}</span></h3>
</div>
<p class="text-bold">{{ __('PART I: DECLARATION OF PETITIONER:') }}</p>
<p><span class="pl-5"></span>{{ __('As an individual debtor in this case, or as the individual authorized to act on behalf of the
    corporation, partnership, or limited liability company seeking bankruptcy relief in this case, I hereby
    request relief as, or on behalf of, the debtor in accordance with the chapter of title 11, United States Code,
    specified in the petition to be filed electronically in this case. I have read the information provided in the
    petition, lists, statements, and schedules to be filed electronically in this case and') }} <span class="text_italic text-bold">{{ __('I hereby declare under
    penalty of perjury') }} </span>{{ __('that the information provided therein, as well as the social security information
    disclosed in this document, is true and correct. I understand that this Declaration is to be filed with the
    Bankruptcy Court within seven (7) business days after the petition, lists, statements, and schedules have
    been filed electronically. I understand that a failure to file the signed original of this Declaration will result
    in the dismissal of my case.') }}</p>

<div class="d-flex mt-3">
    <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box1'); ?>" value="Yes">
    <div>
        <label><span class="text_italic">{{ __('[Only include for Chapter 7 individual petitioners whose debts are primarily consumerdebts] –') }}</span><br>
        {{ __('I am an individual whose debts are primarily consumer debts and who has chosen to file under
        chapter 7. I am aware that I may proceed under chapter 7, 11, 12, or 13 of title 11, United States
        Code, understand the relief available under each chapter, and choose to proceed under chapter 7.') }}</label>
    </div>
</div>
<div class="d-flex mt-3">
    <input type="checkbox" class="form-control w-auto height_fit_content mr-4" name="<?php echo base64_encode('Check Box2'); ?>" value="Yes">
    <div>
        <label><span class="text_italic">{{ __('[Only include if petitioner is a corporation, partnership or limited liability company] –') }}</span><br>
        {{ __('I hereby further declare under penalty of perjury that I have been authorized to file the petition,
        lists, statements, and schedules on behalf of the debtor in this case.') }}</label>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-4">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-4">
        <input name="<?php echo base64_encode('Text2'); ?>" type="text" value="{{$debtor_sign}}" class="form-control">
    </div>
    <div class="col-md-4">
         <input name="<?php echo base64_encode('Text3'); ?>" type="text" value="{{$debtor2_sign}}" class="form-control">
    </div>
</div>
<?php
    $dssn = Helper::validate_key_value('security_number', $BasicInfoPartA);
    $dssn = $volPetData[base64_encode('Form101-Debtor1.SSNum')] ?? $dssn;
    $dssn2 = Helper::validate_key_value('social_security_number', $BasicInfoPartB);
    $dssn2 = $volPetData[base64_encode('Form101-Debtor2 SSNum')] ?? $dssn2;
    ?>
<div class="row mt-3">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="row mt-3">
            <div class="col-md-6">
                <label>{{ __('Debtor') }}<br>
                {{ __('Soc. Sec. No.') }}</label>
            </div>
            <div class="col-md-6">
                <input name="<?php echo base64_encode('Soc Sec No'); ?>" type="text" value="{{$dssn ?? ''}}" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row mt-3">
            <div class="col-md-6">
                <label>{{ __('Joint Debtor') }}<br>
                {{ __('Soc. Sec. No.') }}</label>
            </div>
            <div class="col-md-6">
                <input name="<?php echo base64_encode('Soc Sec No_2'); ?>" type="text" value="{{$dssn2 ?? ''}}" class="form-control">
            </div>
        </div> 
    </div>
    <div class="col-md-4">
    </div>
</div>
<p class="text-bold">{{ __('PART II: DECLARATION OF ATTORNEY:') }}</p>
    <p><span class="pl-5"></span>{{ __('I declare') }} <span class="text_italic text-bold"> {{ __('under penalty of perjury') }} </span> {{ __('(1) I will give the debtor(s) a copy of all documents
    referenced by Part I herein which are filed with the United States Bankruptcy Court; and (2) I have
    informed the debtor(s), if an individual with primarily consumer debts, that he or she may proceed under
    chapter 7, 11, 12, or 13 of title 11, United States Code, and have explained the relief available under each
    such chapter.') }}</p>

<div class="row mt-3">
    <div class="col-md-12">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Date_2"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-3">
    </div>
    <div class="col-md-3">
    </div>
    <div class="col-md-3">
        <x-officialForm.signVertical
            labelText="Attorney for Debtor"
            signNameField="Text1"
             sign="{{$attorny_sign}}">
        </x-officialForm.signVertical>
    </div>
    <div class="col-md-3">
    </div>
</div>