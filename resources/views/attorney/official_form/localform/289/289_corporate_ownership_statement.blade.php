<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
        {{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF VIRGINIA') }}<br>
            <input type="text" name="<?php echo base64_encode('DIV'); ?>" class="form-control w-auto mr-1">
            {{ __('Division') }}
        </h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re') }}</label>
        <input type="text" name="<?php echo base64_encode('DEBTOR1'); ?>" class="form-control" value="{{$onlyDebtor}}">
        <div class="text-center">
            <input type="text" name="<?php echo base64_encode('DEBTOR2'); ?>" class="form-control mt-1" value="{{$spousename}}">
            <label>{{ __('Debtor(s)') }}</label>
        </div>
        <div class="input-group mt-2 text-center">
            <textarea name="<?php echo base64_encode('PLTF'); ?>" value="" class="form-control" rows="2" style="padding-right:5px;"></textarea>
            <label class="">{{ __('Plaintiff(s)') }}</label>
        </div>
        <label class="mt-2">v.</label>
        <div class="input-group text-center">
            <textarea name="<?php echo base64_encode('DFT'); ?>" value="" class="form-control" rows="2" style="padding-right:5px;"></textarea>
            <label class="">{{ __('Defendant(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="CASENO"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="CHP"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Adversary No."
                casenoNameField="APNO"
                caseno=""
            ></x-officialForm.caseNo>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
    </div>
    
    <div class="col-md-12">
        <p class="mt-3">
        {{ __('Pursuant to FRBP 1007(a)(1), or FRBP 7007.1(a) the undersigned counsel for the
            following corporate entity') }}:
            <textarea name="<?php echo base64_encode('PARTIES'); ?>" class="form-control" rows="2"></textarea>
            {{ __('in the above captioned case or adversary proceeding certifies that the following
            corporation(s), other than a governmental unit, directly or indirectly owns 10% or more
            of any class of the corporation’s equity interest, or states that there are no entities to
            report under FRBP 1007(a)(1), or FRBP 7007.1(a)') }}:
            <textarea name="<?php echo base64_encode('ENTITY'); ?>" class="form-control" rows="5"></textarea>
        </p>
        <p>
            <input type="checkbox" name="<?php echo base64_encode('BX1'); ?>" class="form-control height_fit_content w-auto" value="Yes">
            {{ __('No entities to report under FRBP 1007(a)(1), or FRBP 7007.1(a)') }} [<span class=" text_italic">{{ __('Check if applicable') }}</span>]
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingle
            labelText="Date:"
            dateNameField="DATE"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6">
        <div>
            <input type="text" name="<?php echo base64_encode('ATTYSIGN'); ?>" value="{{$attorny_sign}}"  class="form-control">
            <label for=""> {{ __('Signature of Debtor’s Counsel or Party in Adversary Proceeding') }}</label>
        </div>
    </div>
</div>