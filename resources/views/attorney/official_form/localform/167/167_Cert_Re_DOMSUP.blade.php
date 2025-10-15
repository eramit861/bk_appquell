<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MICHIGAN') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <label>{{ __('In re:') }}</label>
        <textarea name="<?php echo base64_encode('undefined');?>"  class="form-control" rows="3">{{$debtorname}}</textarea>
        <label class="float_right">{{ __('Debtor(s).') }}</label>
    </div>
    <div class="col-md-6 border_1px p-3">
       <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text2"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="row mt-3">
            <div class="col-md-3">
               <label>{{ __('Chapter') }}</label>
            </div>
            <div class="col-md-9">
                <select name="<?php echo base64_encode('Dropdown1');?>" class="form-control w-auto">
                    <option></option>
                    <option value="7" <?php if ($editorCh == 'chapter7') { ?> selected <?php } ?> >7</option>
                    <option value="12" >12</option>
                    <option value="13" <?php if ($editorCh == 'chapter13') { ?> selected <?php } ?> >13</option>
                </select>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
         <h3 class="text-center mb-3">
         {{ __("DEBTOR'S CERTIFICATION REGARDING") }}<br>{{ __('DOMESTIC SUPPORT OBLIGATIONS') }}
         </h3>
         <p class="mb-3">
         {{ __('The debtor in the above-referenced matter certifies as follows:') }}
        </p>
        <div class="row mt-3">
            <div class="col-md-1 text-center">
                <div class="text-bold">
                    <label>{{ __('Debtor') }}</label>
                </div>
                <div class="mt-1">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('1');?>" class="form-control height_fit_content w-auto" name="<?php echo base64_encode(''); ?>" value="">
                </div>
            </div>
            <div class="col-md-1 text-center"> 
                <div class="text-bold">
                    <label>{{ __('Spouse') }}</label>
                </div>
                <div class="mt-1">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('2');?>" class="form-control height_fit_content w-auto" name="<?php echo base64_encode(''); ?>" value="">
                </div>
            </div>
            <div class="col-md-10">
                <p class="p_justify mb-0">
                    {{ __('I have not been required by a judicial or administrative order, or by statute,
                    to pay any Domestic Support Obligation as defined in 1 U.S.C. 5 101(14A),
                    either before this proceeding was filed, or at any time after the date of filing.') }}
                </p>
            </div>
        </div>
        <div class="col-md-12 text-center text-bold mb-3 mt-3">
            <label>{{ __('-OR-') }}</label>
        </div>
        <div class="row mt-2">
            <div class="col-md-1 text-center">
                <div class="text-bold">
                    <label>{{ __('Debtor') }}</label>
                </div>
                <div class="mt-1">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('3');?>" class="form-control height_fit_content w-auto" name="<?php echo base64_encode(''); ?>" value="">
                </div>
            </div>
            <div class="col-md-1 text-center"> 
                <div class="text-bold">
                    <label>{{ __('Spouse') }}</label>
                </div>
                <div class="mt-1">
                    <input type="checkbox" value="Yes" name="<?php echo base64_encode('4');?>" class="form-control height_fit_content w-auto" name="<?php echo base64_encode(''); ?>" value="">
                </div>
            </div>
            <div class="col-md-10">
                <p class="p_justify mb-0">
                    {{ __('I have paid all amounts that I am required to pay under any judicial or
                    administrative order, or statute, for a Domestic Support Obligation as defined in
                    11 U.S.C.S 101 (14A), including all amounts that came due after the petition
                    was filed and pre-petition arrears to the extent provided for in the plan.') }}
                </p>
            </div>
        </div>
    </div>
   <div class="col-md-12">
       <p>{{ __('I declare under penalty of perjury that the information provided in this Certificate is true and correct.') }}</p>
   </diV>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        <div class="mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="Date_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
        </div>
    </div>
    <div class="col-md-6 mt-3">
        <input type="text" name="<?php echo base64_encode('Debtor_2'); ?>" class="form-control" value="{{$onlyDebtor}}">
        <label class="float_right">{{ __('Debtor') }}</label>
        <div class="mt-2">
            <input type="text" name="<?php echo base64_encode('Joint Debtor if applicable'); ?>" class="form-control" value="{{$spousename}}">
            <label class="float_right">{{ __('Joint Debtor (if applicable)') }}</label>
        </div>
    </div>

</div>