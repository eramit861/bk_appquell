<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('Southern District of Indiana') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <input type="text" name="<?php echo base64_encode('form1[0].#subform[0].TextField1[0]');?>" value="{{$onlyDebtor}}" class="form-control">
            <input type="text" name="<?php echo base64_encode('form1[0].#subform[0].TextField1[1]');?>" value="{{$spousename}}" class="form-control mt-1">
        </div> 
        <label class="float_right">{{ __('Debtor(s).') }}</label>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="form1[0].#subform[0].TextField1[2]"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class=" underline">{{ __('CORPORATE OWNERSHIP STATEMENT') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="">
            {{ __('As required by Fed.R.Bankr.P. 1007(a)(1), the debtor now files this Corporate Ownership Statement
            and reports as follows:') }}
        </p>
        <p>{{ __('(Check one box only.)') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('form1[0].#subform[0].RadioButtonList[0]');?>" class="form-control height_fit_content w-auto" value="0">
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('Debtor is not a “corporation” as defined in 11 U.S.C. §101(9).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('form1[0].#subform[0].RadioButtonList[0]');?>" class="form-control height_fit_content w-auto" value="2">
            </div>
            <div class="w-100 pl-3">
                <p>{{ __('Debtor is a “corporation” as defined in 11 U.S.C. §101(9) but has no entities to report under Fed.R.Bankr.P. 1007(a)(1).') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('form1[0].#subform[0].RadioButtonList[0]');?>" class="form-control height_fit_content w-auto" value="1">
            </div>
            <div class="w-100 pl-3">
                <p>
                    {{ __("Debtor is a “corporation” as defined in 11 U.S.C. §101(9), and the following corporations directly
                    or indirectly own 10% or more of any class of the debtor's equity interests: (List corporations
                    below.)") }}
                </p>
                <textarea name="<?php echo base64_encode('form1[0].#subform[0].TextField2[0]');?>" class="form-control" rows="9"></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __("The debtor declares under penalty of perjury that this Corporate Ownership Statement is true and correct.") }}</p>
    </div>
    
    <div class="col-md-6 mt-3">
    </div>
    <div class="col-md-6 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField1[3]');?>" value="{{$debtor_sign}}" type="text" class="form-control">
            <label class="text_italic">(Signature of Authorized Individual)*</label>
        </div>
        <div class="input-group">
            <input name="<?php echo base64_encode('form1[0].#subform[0].TextField1[4]');?>" value="{{$debtor2_sign}}" type="text" class="form-control">
            <label class="text_italic">{{ __('(Printed Name of Authorized Individual)') }}</label>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text_italic">*Note: If filing electronically, use the /s/ electronic signature per our Administrative Procedures Manual.</p>
    </div>

</div>