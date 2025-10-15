<div class="row">
    
    <div class="district281 col-md-12 text-center">
        <div class="row">
            <div class="district281 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF TEXAS') }}</h2>
            </div>
            <div class="district281 col-md-4"></div>
            <div class="district281 col-md-3 text-center">
                <select name="<?php echo base64_encode('Combo Box1'); ?>" id="" class="form-control">
                    <option value="AUSTIN">{{ __('AUSTIN') }}</option>
                    <option value="EL PASO">{{ __('EL PASO') }}</option>
                    <option value="SAN ANTONIO">{{ __('SAN ANTONIO') }}</option>
                    <option value="WACO">{{ __('WACO') }}</option>
                    <option value="MIDLAND">{{ __('MIDLAND') }}</option>
                </select>
            </div>
            <div class="district281 col-md-1">
                <h2>{{ __('DIVISION') }}</h2>
            </div>
            <div class="district281 col-md-4"></div>
        </div>
    </div>
    <div class="district281 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district281 col-md-6 pt-3 pb-3" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('Text2'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                </div>
            </div>
            <div class="district281 col-md-6 pt-3 pb-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district281 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district281 col-md-9">
                        <input name="<?php echo base64_encode('Case No'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district281 col-md-3">
                        <label>{{ __('Chapter:') }}</label>
                    </div>
                    <div class="district281 col-md-9">
                        <input name="<?php echo base64_encode('Text3'); ?>" value="<?php echo $chapterNo; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district281 col-md-12">
        <div class="row">
            <div class="district281 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 >{{ __('LIST OF CREDITORS VERIFICATION') }}</h3> 
            </div>
            <div class="district281 col-md-12">
            <p>
                {{ __('The above named debtor(s) hereby verifies that the attached list of creditors is true and correct to the
                best of their knowledge.') }}
            </p>
            </div>
        </div>
    </div>
    <div class="district281 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('Debtor'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Debtor') }}</label>
        </div>
    </div>
    <div class="district281 col-md-5"></div>
    <div class="district281 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('undefined'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('DATED:') }}</label>
        </div>
    </div>
    <div class="district281 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('Joint Debtor'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Joint Debtor') }}</label>
        </div>
    </div>
    <div class="district281 col-md-5"></div>
    <div class="district281 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('Date'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('DATED:') }}</label>
        </div>
    </div>
    
    <div class="district281 col-md-12 mt-3">
         
    </div>   


</div>
