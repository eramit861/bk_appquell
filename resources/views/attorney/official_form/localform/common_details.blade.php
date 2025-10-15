<div class="cdet col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;"> 
        <div class="cdet row">
            <div class="cdet col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="cdet commonl input-group mb-3">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox0'); ?>>" value="" class="commonl form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="cdet col-md-6 mt-3 d-flex">
                <div class="cdet row" style="margin-top: 14px;">
                    <div class="cdet col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="cdet col-md-9">
                        <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="cdet col-md-3">
                        <label>{{ __('CHAPTER:') }}</label>
                    </div>
                    <div class="cdet col-md-9">
                        <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo $chapterNo; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>