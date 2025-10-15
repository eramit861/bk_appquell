<div class="row">
    <div class="col-md-12 mb-3">
        <p class=" text-c-blue text-bold">{{ __('This form must be submitted directly to the Trustee within 14 days of filing your bankruptcy
schedules. DO NOT FILE this form with the Court.') }}</p>
    </div>
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF OKLAHOMA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
            debtorNameField="undefined"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case No"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="underline ">{{ __('AFFIDAVIT AND DISCLOSURE OF DOMESTIC SUPPORT OBLIGATIONS') }}</h3>
        <p>(<span class="">{{ __('Note: A separate form must be submitted to the Trustee for each debtor in a joint case') }}</span>)</p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <div class="text-center width_30percent text_italic">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="(Print Debtor's Name)"
                    inputFieldName="Debtor being first duly sworn under oath deposes and states"
                    inputValue=""
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="w-100">
                <p>{{ __(', Debtor, being first duly sworn under oath, deposes and states:') }}</p>
            </div>
        </div>
        <p class="text-bold mt-3 text_italic">{{ __('(Select One)') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box1');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>I do <span class="underline">not</span> {{ __('owe any person or entity a debt defined in 11 U.S.C. § 101(14A) as a "domestic support obligation."') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box2');?>" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p>I <span class="underline">do</span> {{ __('owe the following person(s) or entity(ies) a debt defined in 11 U.S.C. § 101(14A) as
                    a "domestic support obligation"') }} <span class="text_italic">{{ __("(attach all supporting documents that establish the terms of a
                    domestic support obligation (e.g., copy of debtor's divorce decree, orders establishing parent-
                    child relationship, and orders establishing or modifying child support)):") }}</span></p>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 table_sect">
        <table class="w-100">
            <tr>
                <td class="p-2 text-bold text-center">1.</td>
                <td class="p-2 text-bold">{{ __('Name of holder of claim for domestic support obligation') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Name of holder of claim for domestic support obligation');?>" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2"></td>
                <td class="p-2"><span class="text-bold">{{ __('Name of Service/Collection Agent') }} </span>{{ __('(if applicable)') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Name of ServiceCollection Agent if applicable');?>" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2"></td>
                <td class="p-2 text-bold">{{ __('Address') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Address');?>" class="form-control"></td>
            </tr>            
            <tr>
                <td class="p-2"></td>
                <td class="p-2 text-bold">{{ __('Telephone Number(s)') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Telephone Numbers');?>" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2 text-bold text-center">2.</td>
                <td class="p-2 text-bold">{{ __('Name of holder of claim for domestic support obligation') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Name of holder of claim for domestic support obligation_2');?>" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2"></td>
                <td class="p-2"><span class="text-bold">{{ __('Name of Service/Collection Agent') }} </span>{{ __('(if applicable)') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Name of ServiceCollection Agent if applicable_2');?>" class="form-control"></td>
            </tr>
            <tr>
                <td class="p-2"></td>
                <td class="p-2 text-bold">{{ __('Address') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Address_2');?>" class="form-control"></td>
            </tr>            
            <tr>
                <td class="p-2"></td>
                <td class="p-2 text-bold">{{ __('Telephone Number(s)') }}</td>
                <td class="p-1"><input type="text" value="" name="<?php echo base64_encode('Telephone Numbers_2');?>" class="form-control"></td>
            </tr>
        </table>
        <p class="text-center text_italic mt-2">{{ __('(Attach additional sheets, if necessary)') }}</p>
        <p class="text_italic">{{ __('If you owe a domestic support obligation, provide the following additional information.') }}</p>
        <p class="">{{ __('The name and address of my most recent employer(s) is as follows:') }}</p>
    </div>

    <div class="col-md-4 pt-2">
        <label class="float_right text_italic">{{ __('Employer Name :') }}</label><br>
        <label class="float_right text_italic mt-3">{{ __('Employer Address :') }}</label>
    </div>
    <div class="col-md-5">
        <input type="text" value="" name="<?php echo base64_encode('Employer Name 1');?>" class="form-control">
        <input type="text" value="" name="<?php echo base64_encode('Employer Address 1');?>" class="form-control mt-1">
        <input type="text" value="" name="<?php echo base64_encode('Employer Name 2');?>" class="form-control mt-1">
        <input type="text" value="" name="<?php echo base64_encode('Employer Address 2');?>" class="form-control mt-1">
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-4 pt-2 mt-3">
        <label class="float_right text_italic">{{ __('Employer Name :') }}</label><br>
        <label class="float_right text_italic mt-3">{{ __('Employer Address :') }}</label>
    </div>
    <div class="col-md-5 mt-3">
        <input type="text" value="" name="<?php echo base64_encode('Employer Name 1_2');?>" class="form-control">
        <input type="text" value="" name="<?php echo base64_encode('Employer Address 1_2');?>" class="form-control mt-1">
        <input type="text" value="" name="<?php echo base64_encode('Employer Name 2_2');?>" class="form-control mt-1">
        <input type="text" value="" name="<?php echo base64_encode('Employer Address 2_2');?>" class="form-control mt-1">
    </div>
    <div class="col-md-3 mt-3"></div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="s"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('Sworn to and subscribed before me this') }} 
            <input type="text" value="" name="<?php echo base64_encode('Sworn to and subscribed before me this');?>" class="form-control w-auto">    
            {{ __('day of') }}     
            <input type="text" value="" name="<?php echo base64_encode('day of');?>" class="form-control width_5percent">
             , 20
            <input type="text" value="" name="<?php echo base64_encode('TextBox0');?>" class="form-control width_5percent">
            .</p>
    </div>

    <div class="col-md-6 mt-3">
        <label for="">{{ __('[SEAL]') }}</label>
    </div>
    <div class="col-md-6 mt-3 text-center">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Notary Public"
            inputFieldName="Notary Public"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
</div>