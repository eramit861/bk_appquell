<div class="row">
    <div class="district211 col-md-12 text-center">
        <div class="row">
            <div class="district211 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('NORTHERN DISTRICT OF NEW YORK') }} </h2>
            </div>
        </div>
    </div>
    <div class="district211 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district211 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group mb-3">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('in re'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="font-style:italic;">{{ __('[Set forth here all names including married, maiden, and trade names used by debtor within last 8 years.]') }}</p>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                    <div class="row" style="border-top:1px solid #000; padding-top: 1rem !important;" >
                        <div class="district211 col-md-8">
                            <label>{{ __('Last four digits of Social Security No(s):') }}</label>
                        </div>
                        <div class="district211 col-md-4">
                            <input name="<?php echo base64_encode('ss'); ?>" value="" placeholder="" type="number" class=" form-control">
                        </div>
                        <div class="district211 col-md-8 mt-3">
                            <label>{{ __('Employer Tax Identification (EIN) No(s). (if any):') }}</label>
                        </div>
                        <div class="district211 col-md-4 mt-3">
                            <input name="<?php echo base64_encode('ein1'); ?>" value="" placeholder="" type="number" class=" form-control">
                        </div>
                    </div> 
                </div>
            </div>
            <div class="district211 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district211 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district211 col-md-9">
                        <input name="<?php echo base64_encode('number'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district211 col-md-3">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="district211 col-md-9">
                        <input name="<?php echo base64_encode('ch'); ?>" value="<?php echo $chapterName; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district211 col-md-12">
        <div class="row">
            <div class="district211 col-md-12 text-center mb-3" style="margin-top: 1rem !important;">
                <h3 style="text-decoration:underline;">{{ __('CERTIFICATION OF MAILING MATRIX') }}</h3> 
            </div>
            <div class="district211 col-md-12 mt-3">
                <p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    I (we),
                    <input name="<?php echo base64_encode('we'); ?>" value="<?php echo $atroneyName; ?>" placeholder="" type="text" style="width:300px;" class=" form-control">
                    {{ __(', the attorney for the
                    debtor/petitioner (or, if appropriate, the debtor(s) or petitioner(s)) hereby certify under
                    the penalties of perjury that the above/attached mailing matrix has been compared to
                    and contains the names, addresses zip codes and, if required, account numbers in
                    redacted form, of all persons and entities, as they appear on the schedules of
                    liabilities/list of creditors/list of equity security holders, or any amendment thereto filed
                    herewith.') }}
                </p> 
            </div>
        </div>
    </div>
    <div class="district211 col-md-3 mt-3">
        <div class="district211 input-group d-flex">
            <label class="district211" for="">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('date'); ?>" value="<?php echo $currentDate;?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" style="margin-left: 10px;" class="district211 date_filed form-control">
            
        </div>
    </div>
    <div class="district211 col-md-5 mt-3"></div>
    <div class="district211 col-md-4 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('petitioner'); ?>" value="<?php echo $attorney_name;?>" type="text" class="form-control">
            <div class="text-center">
                <label>{{ __('Attorney for Debtor/Petitioner') }}<br>{{ __('Debtor(s)/Petitioner(s)') }}</label>
            </div>
        </div>
    </div>

    <div class="district211 col-md-12 mt-3">
         
    </div>   


</div>
