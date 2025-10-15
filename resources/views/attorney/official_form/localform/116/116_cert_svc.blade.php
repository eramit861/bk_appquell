<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('U.S. BANKRUPTCY COURT') }}<br>{{ __('Central District of Illinois') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="debtor"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
    </div> 
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="{{ __('Case Number.') }}"
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline mb-2">{{ __('CERTIFICATE OF SERVICE') }}</h3>

        <p class="mt-4">
        {{ __('I hereby certify that on') }}  
            <input name="<?php echo base64_encode('service date'); ?>"  type="text" value="" class="w-auto form-control">
            <span class="text_italic">{{ __('(date)') }}</span>, {{ __('a copy of the following') }}:
            <input name="<?php echo base64_encode('document'); ?>"  type="text" value="" class="width_50percent form-control">
            <input name="<?php echo base64_encode('document line 2'); ?>"  type="text" value="" class="form-control mt-1">
            <span class="text_italic">{{ __('(document name)') }}</span>
            {{ __('was mailed by first-class U.S. mail, postage prepaid, and properly addressed to the following:') }}
        </p>
        <p class="text_italic text-center">
            {{ __('(List the name and address of each party served exactly as addressed on the envelope.)') }}
        </p>
    </div>
    <?php
            for ($i = 1; $i <= 6; $i++) {
                ?>
    <div class="col-md-6 mt-3">
        <input name="<?php echo base64_encode($i.'A-'.$i); ?>"  type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode($i.'B-'.$i); ?>"  type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode($i.'C-'.$i); ?>"  type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode($i.'D-'.$i); ?>"  type="text" value="" class="form-control mt-1">
        <input name="<?php echo base64_encode($i.'E-'.$i); ?>"  type="text" value="" class="form-control mt-1">
    </div>
    <?php } ?>

    <div class="col-md-12 mt-3">
        <p class="text_italic text-center">{{ __('(Attach additional addresses on a separate sheet.)') }}</p>
    </div>
    <div class="col-md-2 mt-3 text-center text_italic">
        <x-officialForm.dateSingle
            labelText="({{ __('Dated') }})"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingle>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-6 mt-3 text-center text_italic">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="({{ __('Signature') }})"
            inputFieldName="Text1"
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
</div>