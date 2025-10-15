<div class="row">

   
   <div class="district267 col-md-12 text-center">
        <div class="row">
            <div class="district267 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('NORTHERN DISTRICT OF TEXAS') }}</h2>
            </div>
        </div>
    </div>
    <div class="district267 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district267 col-md-6 p-3" style="border-right:1px solid #000;">
                <div class="input-group">
                    <x-officialForm.inReDebtorCustom
                        debtorNameField="Debtor(s)"
                        debtorname={{$debtorname}}
                        rows="3">
                    </x-officialForm.inReDebtorCustom>
                </div>
            </div>
            <div class="district267 col-md-6 p-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                <div class="district267 col-md-6">
                        <label>{{ __('Bankruptcy Case Number:') }}</label>
                    </div>
                    <div class="district267 col-md-6">
                        <input name="<?php echo base64_encode('Case_No'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district267 col-md-12">
        <div class="row">
            <div class="district267 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 >{{ __('VERIFICATION OF MAILING LIST') }}</h3> 
            </div>
            <div class="district267 col-md-12">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('The Debtor(s) certifies that the attached mailing list (') }}<i>{{ __('only one option may be selected per form') }}</i>):
                </p>
            </div>
            <div class="district267 col-md-12">
                <div class="row">
                    <div class="district267 col-md-2"></div>
                    <div class="district267 col-md-1">
                        <input name="<?php echo base64_encode('C1'); ?>" value="Yes"  placeholder="" type="checkbox" class=" form-control">
                    </div>
                    <div class="district267 col-md-9">
                        <p>
                            {{ __('is the first mail matrix in this case.') }}
                        </p>
                    </div>
                    <div class="district267 col-md-2"></div>
                    <div class="district267 col-md-1">
                        <input name="<?php echo base64_encode('C2'); ?>" value="Yes"  placeholder="" type="checkbox" class=" form-control">
                    </div>
                    <div class="district267 col-md-9">
                        <p>
                            {{ __('adds entities not listed on previously filed mailing list(s).') }}
                        </p>
                    </div>
                    <div class="district267 col-md-2"></div>
                    <div class="district267 col-md-1">
                        <input name="<?php echo base64_encode('C3'); ?>" value="Yes"  placeholder="" type="checkbox" class=" form-control">
                    </div>
                    <div class="district267 col-md-9">
                        <p>
                            {{ __('changes or corrects name(s) and address(es) on previously filed mailing list(s)changes or corrects name(s) and address(es) on previously filed mailing list(s).') }}
                        </p>
                    </div>
                    <div class="district267 col-md-2"></div>
                    <div class="district267 col-md-1">
                        <input name="<?php echo base64_encode('C4'); ?>" value="Yes"  placeholder="" type="checkbox" class=" form-control">
                    </div>
                    <div class="district267 col-md-9">
                        <p>
                            {{ __('deletes name(s) and address(es) on previously filed mailing list(s)deletes name(s) and address(es) on previously filed mailing list(s).') }}
                        </p>
                    </div>
                    <div class="district267 col-md-12">
                        <p>
                            {{ __('In accordance with N.D. TX L.B.R. 1007.1, the above named Debtor(s) hereby verifies that the attached list of creditors is true and correct.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district267 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('Date') }}</label>
        </div>
    </div>
    <div class="district267 col-md-5"></div>
    <div class="district267 col-md-4 mt-3">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode(''); ?>" value="<?php echo $attorny_sign;?>" type="text" class="form-control" readonly>
            <label>{{ __('Signature of Attorney (if applicable)') }}</label>
        </div>
    </div>
    <div class="district267 col-md-3 mt-3">
        <div class="input-group">
        <input name="<?php echo base64_encode(''); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control" readonly>
            <label for="">{{ __('Signature of Debtor') }}</label>
        </div>
    </div>
    <div class="district267 col-md-5"></div>
    <div class="district267 col-md-4 mt-3">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('Debtor_SSN'); ?>" value="{{$last_4_ssn_d1}}" type="text" class="form-control">
            <label>{{ __('Debtor’s Social Security') }}  (<i>{{ __('last four digits only') }}</i>) /{{ __('Tax ID No') }}.</label>
        </div>
    </div>
    <div class="district267 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode(''); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control"readonly>
            <label for="">{{ __('Signature of Joint Debtor (if applicable)') }}</label>
        </div>
    </div>
    <div class="district267 col-md-5"></div>
    <div class="district267 col-md-4 mt-3">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('Joint_Debtor_SSN'); ?>" value="{{$last_4_ssn_d2}}" type="text" class="form-control">
            <label>{{ __('Joint Debtor’s Social Security') }}  (<i>{{ __('last four digits only') }}</i>) /{{ __('Tax ID No') }}</label>
        </div>
    </div>

    <div class="district267 col-md-12 mt-3">
         
    </div>   


</div>
