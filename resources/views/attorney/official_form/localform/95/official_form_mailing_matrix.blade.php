<div class="row">
    <div class="district95 col-md-12 text-center">
        <div class="row">
            <div class="district95 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('NORTHERN DISTRICT OF FLORIDA') }}</h2>
            </div>
            <div class="district95 col-md-4"></div>
            <div class="district95 col-md-3 text-center">
                <select name="<?php echo base64_encode('topmostSubform[0].Page1[0].Division[0]'); ?>" id="" class="form-control">
                    <option value="GAINESVILLE">{{ __('GAINESVILLE') }}</option>
                    <option value="TALLAHASSEE">{{ __('TALLAHASSEE') }}</option>
                    <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
                    <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
                </select>
            </div>
            <div class="district95 col-md-1">
                <h2>{{ __('DIVISION') }}</h2>
            </div>
            <div class="district95 col-md-4"></div>
        </div>
    </div>
    <div class="district95 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district95 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('topmostSubform[0].Page1[0].DbtrNames[0]'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district95 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                <div class="district95 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district95 col-md-9">
                        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].CaseNo[0]'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district95 col-md-3">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="district95 col-md-9">
                        <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Chapter[0]'); ?>" value="<?php echo $chapterName; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district95 col-md-12">
        <div class="row">
            <div class="district95 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 >{{ __('VERIFICATION OF CREDITOR MAILING MATRIX') }}</h3> 
            </div>
            <div class="district95 col-md-12">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I/We, the above named debtor(s), do hereby verify under penalty of perjury that the mailing matrix (list of creditors) attached or previously filed in this case is true and correct to the best of my/our knowledge.') }}
            </p>
            </div>
        </div>
    </div>
    <div class="district95 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Signature[0]'); ?>" value="<?php echo $debtor_sign;?>" type="text" placeholder="" class="form-control" readonly>
            <label for="">{{ __("Debtor's Signature:") }}</label>
        </div>
    </div>
    <div class="2district95 col-md-5"></div>
    <div class="2district95 col-md-4 mt-3">
        <div class="2district95 input-group">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Date[0]'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('Dated:') }}</label>
        </div>
    </div>
    <div class="2district95 col-md-3 mt-3">
        <div class="2district95 input-group">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Signature[1]'); ?>" value="<?php echo $onlyDebtor;?>" type="text" class="2district95 form-control">
            <label style="width:205px;">{{ __('Printed Name of Debtor') }} </label>
        </div>
    </div>
    <div class="2district95 col-md-9"></div>
    <div class="2district95 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Signature[2]'); ?>" value="<?php echo $debtor2_sign;?>" type="text" placeholder="" class="form-control" readonly>
            <label class="district95" for="">{{ __("Debtor's Signature:") }}</label>
        </div>
    </div>
    <div class="district95 col-md-5"></div>
    <div class="district95 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Date[1]'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('Dated:') }}</label>
        </div>
    </div>
    <div class="3district95 col-md-3 mt-3">
        <div class="3district95 input-group">
            <input name="<?php echo base64_encode('topmostSubform[0].Page1[0].Signature[3]'); ?>" value="<?php echo $spousename;?>" type="text" class="form-control 3district95">
            <label style="width:205px;">{{ __('Printed Name of Joint Debtor') }} </label>
        </div>
    </div>
    
    <div class="district95 col-md-9"></div>

    <div class="district95 col-md-12 mt-3">
         
    </div>   

</div>
