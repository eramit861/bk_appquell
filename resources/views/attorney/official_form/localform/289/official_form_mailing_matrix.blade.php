<div class="row">

    
    <div class="district289 col-md-12 text-center">
        <div class="row">
            <div class="district289 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF VIRGINIA') }}</h2>
            </div>
            <div class="district289 col-md-4"></div>
            <div class="district289 col-md-3 text-center">
                <input name="<?php echo base64_encode('DIV'); ?>" value=""  placeholder="" type="text" class=" form-control">
            </div>
            <div class="district289 col-md-1">
                <h2>{{ __('DIVISION') }}</h2>
            </div>
            <div class="district289 col-md-4"></div>
        </div>
    </div>
    <div class="district289 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district289 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('DEBTORNAME1'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <label style="text-align: right;">{{ __('Debtor(s)') }}</label>
                </div>
            </div>
            <div class="district289 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district289 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district289 col-md-9">
                        <input name="<?php echo base64_encode('CASENO'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district289 col-md-3">
                        <label>{{ __('Chapter:') }}</label>
                    </div>
                    <div class="district289 col-md-9">
                        <input name="<?php echo base64_encode('CHP'); ?>" value="<?php echo $chapterNo; ?>"  placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district289 col-md-12">
        <div class="row">
            <div class="district289 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 >{{ __('COVER SHEET FOR LIST OF CREDITORS') }}</h3> 
            </div>
            <div class="district289 col-md-12">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I hereby certify under penalty of perjury that the master mailing list of creditors submitted either on flash drive or by a typed hard copy in scannable format, with Request for Waiver attached, is a true, correct and complete listing to the best of my knowledge.') }}
                </p>
            </div>
            <div class="district289 col-md-12">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('I further acknowledge that (1) the accuracy and completeness in preparing the creditor listing are the shared responsibility of the debtor and the debtor’s attorney, (2) the court will rely on the creditor listing for all mailings, and (3) that the various schedules and statements required by the Bankruptcy Rules are not used for mailing purposes.') }}
                </p>
            </div>
            <div class="district289 col-md-12">
                <p>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Master mailing list of creditors submitted vi:') }}
                </p>
            </div>
            <div class="district289 col-md-2 pt-2" style="text-align: right;">
                <label>(a)</label>
            </div>
            <div class="district289 col-md-10">
                <p>
                    <input name="<?php echo base64_encode('BOX1'); ?>" value="Yes" type="checkbox" class="form-control" style="width:15px;">    
                    {{ __('flash drive listing a total of') }}
                    <input name="<?php echo base64_encode('BOX2'); ?>" value="<?php echo $countCreditors;?>" type="number" class="form-control" style="width:50px;">
                    {{ __('creditors; or') }}
                </p>
            </div>
            <div class="district289 col-md-2 pt-2" style="text-align: right;">
                <label>(b)</label>
            </div>
            <div class="district289 col-md-10">
                <p>
                    <input name="<?php echo base64_encode('BOX3'); ?>" value="Yes" type="checkbox" class="form-control" style="width:15px;">    
                    {{ __('scannable hard copy, with Request for Waiver attached, consisting of') }} 
                    <input name="<?php echo base64_encode('BOX4'); ?>" value="<?php echo $creditors_count;?>" type="number" class="form-control" style="width:50px;">
                    {{ __('pages, listing a total of') }}
                    <input name="<?php echo base64_encode('BOX5'); ?>" value="<?php echo $countCreditors;?>" type="number" class="form-control" style="width:50px;">
                    {{ __('creditors') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district289 col-md-8 mt-3"></div>
    <div class="district289 col-md-4 mt-3">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('db'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label class="text-center">{{ __('Debtor') }}</label>
        </div>
    </div>
    <div class="district289 col-md-8 mt-3"></div>
    <div class="district289 col-md-4 mt-3">
        <div class="input-group ml-30">
            <input name="<?php echo base64_encode('jdb'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label class="text-center">{{ __('Joint Debtor') }}</label>
        </div>
    </div>
    <div class="district289 col-md-3 mt-3">
        <div class="input-group">
            <input name="<?php echo base64_encode('DTE'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
            <label for="">{{ __('Date') }}</label>
        </div>
    </div>
    <div class="district289 col-md-5"></div>
    <div class="district289 col-md-4 mt-3">
        <div class="input-group ml-30">
            <p>
                <i>{{ __('[Check if applicable]') }}</i>
                <input name="<?php echo base64_encode('FORIN'); ?>" value="Yes" type="checkbox" class="form-control" style="width:15px;">    
                {{ __('Creditor(s) with foreign addresses included on flash drive/hard copy.') }} 
            </p>
        </div>
    </div>
    
    <div class="district289 col-md-12 mt-3">
         
    </div>   


</div>
