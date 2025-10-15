<div class="row">

    <div class="col-md-12 border_bottom_1px">
        <h3 class="text-center mb-3">{{ __('DOMESTIC SUPPORT OBLIGATION QUESTIONNAIRE') }}<br>{{ __('(To be completed by individuals in a Chapter 13 bankruptcy case)') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="p_justify">{{ __('Domestic support obligations are generally defined as debts owed to a spouse, former spouse or
        child for alimony, maintenance or support, including such debts owed to a governmental
        collection agency such as the Office of Recovery Services.') }}</p>
        <p class="p_justify">{{ __('The Trustee is required to provide certain notices to the holders of domestic support obligations
        and to any governmental child support collection agency that may be assisting the individual
        claim holder.') }}</p>
        <p class="text-center underline text-bold">{{ __('Please fill out the form below and bring the completed form to the first meeting of creditors.') }}<br>
        {{ __('Failure to do so could ultimately lead to the dismissal of your bankruptcy case.') }}</p>
        <p class="text-bold">{{ __('Check Applicable Statement:') }}</p>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('CheckBox0');?>" value="YES" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-3">
                <p class="mb-2">{{ __('I do') }} <span class="underline text-bold">{{ __('not') }}</span> {{ __('owe a domestic support obligation') }} <span class="underline">{{ __('(If this box is checked, you may
                sign this questionnaire without completing the remaining questions.)') }}</span></p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pl-4">
                <input type="checkbox" name="<?php echo base64_encode('CheckBox1');?>" value="YES" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('I do owe a domestic support obligation') }} <span class="underline">{{ __('(If this box is checked, please
                complete the rest of this questionnaire with a separate entry for each domestic
                support obligation owed and sign below.)') }}</span></p>
            </div>
        </div>
        <p class="p_justify">{{ __('Name of individual or entity to whom domestic support obligation is owed and last known
        address and telephone number of such person:') }}</p>
    </div>

    <div class="col-md-3"></div>
    <div class="col-md-6">
        <input type="text" name="<?php echo base64_encode('TextBox0');?>" class="form-control">
        <input type="text" name="<?php echo base64_encode('TextBox1');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox2');?>" class="form-control mt-1">
        <input type="text" name="<?php echo base64_encode('TextBox3');?>" class="form-control mt-1">
    </div>
    <div class="col-md-3"></div>

    <div class="col-md-12">
        <p class="mb-0">{{ __('If a joint case, identify which of the two debtors owes this obligation:') }}</p>
        <input type="text" name="<?php echo base64_encode('TextBox4');?>" class="form-control mt-1">
        <p class="p_justify">{{ __('If you owe a domestic support obligation to more than one person, please list the information requested above for each claim holder on an attached sheet.') }}</p>
        <p class="p_justify">{{ __('I/we declare under penalty of perjury that the answers to the above questions/statements
            concerning domestic support obligations are true, complete and correct to the best of my/our
            knowledge, information and belief.') }}</p>
    </div>

    <div class="col-md-6 mt-3">
        <div class="pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Debtor 1 Signature:"
                inputFieldName="TextBox5"
                inputValue="{{$debtor_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="TextBox6"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="pl-2 mt-3">
            <x-officialForm.debtorSignVertical
                labelContent="Debtor 2 Signature:"
                inputFieldName="TextBox7"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1">
            <x-officialForm.dateSingleHorizontal
            labelText="Date"
            dateNameField="TextBox8"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>
    <div class="col-md-6 mt-3"></div>
    
    <div class="col-md-12 mt-3">
        <p class="p_justify text-bold underline">{{ __('If you have any questions as to what is a domestic support obligation, whether you owe a
            domestic support obligation, or how to answer any of the questions on this form, please talk
            to your attorney') }}</p>
    </div>
</div>