<div class="row">

    <div class="col-md-12 p-3">
        <h3 class="text-center">{{ __('LOCAL FORM 3') }}<br>{{ __('DOMESTIC SUPPORT OBLIGATION DISCLOSURE') }}</h3>
        <h3 class="text-center mt-3">{{ __('This form must be submitted directly to the Trustee within 14 days of filing your bankruptcy schedules. DO NOT FILE this form with the Court.') }}</h3>
        <h3 class="text-center mt-3">{{ __('IN THE UNITED STATES BANKRUPTCY COURT FOR THE') }}<br>{{ __('WESTERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text3"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text5"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text4"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div> 
    </div>

    <div class="col-md-12 text-center mt-3">
        <h3>{{ __('AFFIDAVIT AND DISCLOSURE OF DOMESTIC SUPPORT OBLIGATIONS') }}</h3>
        <p class="mt-2 text_italic">{{ __('(Note: A separate form must be submitted to the Trustee for each debtor in a joint case)') }}</p>
    </div>

    <div class="col-md-12 mt-3">
        <p class="mb-0">
            <span class="pl-4"></span>
            <input type="text" name="<?php echo base64_encode('Text6'); ?>" value="{{$onlyDebtor}}" class="form-control mt-1 width_30percent">
            {{ __(', Debtor, being first duly sworn under oath, deposes and states:') }}
        </p>
        <p class="text_italic"><span class="pl-4"></span>{{ __("(Print Debtor's Name)") }}</p>
        <p class="mt-3 text_italic">{{ __('(Select One)') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box7');?>" value="Yes">
            </div>
            <div class="w-100 pl-4">
                <p>{{ __('I do not owe any person or entity a debt defined in 11 U.S.C. § 101(14A) as a "domestic support obligation."') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" class="form-control height_fit_content w-auto" name="<?php echo base64_encode('Check Box8');?>" value="Yes">
            </div>
            <div class="w-100 pl-4">
                <p>
                    {{ __("I do owe the following person(s) or entity(ies) a debt defined in 11 U.S.C. § 101(14A) as
                    a “domestic support obligation” (attach all supporting documents that establish the terms
                    of a domestic support obligation (i.e. copy of debtor's divorce decree, orders establishing
                    parent- child relationship, and orders establishing or modifying child support)):") }}
                </p>
            </div>
        </div>

        <div class=" table_sect">
            <table class="w-100">
                <tr>
                    <td class="p-2 text-center width_5percent">1.</td>
                    <td class="p-2 w-45">{{ __('Name of holder of claim for Domestic Support Obligation') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text9');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2"></td>
                    <td class="p-2">{{ __('Name of service/collection agent (if applicable)') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text10');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2"></td>
                    <td class="p-2">{{ __('Address') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text26');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2"></td>
                    <td class="p-2">{{ __('Telephone Number') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text11');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2 text-center">2.</td>
                    <td class="p-2">{{ __('Name of holder of claim for Domestic Support Obligation') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text12');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2"></td>
                    <td class="p-2 underline">{{ __('Name of service/collection agent (if applicable)') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text13');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2"></td>
                    <td class="p-2 underline">{{ __('Address') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text14');?>" class="form-control"></td>
                </tr>
                <tr>
                    <td class="p-2"></td>
                    <td class="p-2 underline">{{ __('Telephone Number') }}</td>
                    <td class="p-1"><input type="text" name="<?php echo base64_encode('Text15');?>" class="form-control"></td>
                </tr>
            </table>
        </div>
        <p class="text_italic"><span class="pl-4"></span> {{ __('(Attach additional sheets if necessary)') }}</p>
        <p class="text_italic text-bold">{{ __('If you owe a domestic support obligation, provide the following additional information.') }}</p>
        <p>{{ __('The name and address of my most recent employer(s) is as follows:') }}</p>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-2 pt-2">
        <label for="">{{ __('Employer Name:') }}</label>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('Text16');?>" class="form-control">
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-2"></div>
    <div class="col-md-2 pt-2">
        <label for="">{{ __('Employer Address:') }}</label>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('Text17');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('Text18');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Text19');?>" class="form-control mt-1">
    </div>
    <div class="col-md-4"></div>
    
    <div class="col-md-2"></div>
    <div class="col-md-2 pt-2 mt-3">
        <label for="">{{ __('Employer Name:') }}</label>
    </div>
    <div class="col-md-4 mt-3">
        <input type="text" name="<?php echo base64_encode('Text20');?>" class="form-control">
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-2"></div>
    <div class="col-md-2 pt-2">
        <label for="">{{ __('Employer Address:') }}</label>
    </div>
    <div class="col-md-4">
        <input type="text" name="<?php echo base64_encode('Text21');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('Text22');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('Text23');?>" class="form-control mt-1">
    </div>
    <div class="col-md-4"></div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Text24"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Name"
            inputFieldName="Text25"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('Sworn to and subscribed before me this') }} 
            <input type="text" name="<?php echo base64_encode('Text28'); ?>" value="{{$currentMonth}}" class="form-control w-auto">
            {{ __('day of') }} 
            <input type="text" name="<?php echo base64_encode('Text27'); ?>" value="{{$currentDay}}" class="form-control width_5percent">
            , 20
            <input type="text" name="<?php echo base64_encode('Text29'); ?>" value="{{$currentYearShort}}" class="form-control width_5percent">
            .
        </p>
    </div>

    <div class="col-md-6 mt-3">
       <label for="">{{ __('[SEAL]') }}</label>
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group">
            <input name="" value="" type="text" class="form-control bg-none" disabled="true">
            <label>{{ __('Notary Public') }}</label>
        </div>
    </div>

    
</div>