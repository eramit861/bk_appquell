<div class="row">

    <div class="district128 col-md-12 text-center">
        <div class="row">
            <div class="district128 col-md-12 text-center">
                <h2>{{ __('UNITED STATES BANKRUPTCY COURT') }} <br> {{ __('Southern District of Indiana') }} </h2>
            </div>
        </div>
    </div>
    <div class="district128 col-md-12 " style="border:1px solid #000; margin-top: 1rem !important;">
        <div class="row">
            <div class="district128 col-md-6 mt-3 p-5" style="border-right:1px solid #000;">
                <div class="input-group">
                    <label>{{ __('In re:') }}</label>
                    <textarea name="<?php echo base64_encode('TextBox0'); ?>>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
                    <p style="font-style: italic;">{{ __('[Name of Debtor(s)]') }}</p>
                    <input name="<?php echo base64_encode('TextBox1'); ?>" value="<?php echo $chapterName; ?>"  placeholder="" type="text" class=" form-control">
                    <p style="text-align: right;">{{ __('Debtor(s)') }}</p>
                </div>
            </div>
            <div class="district128 col-md-6 mt-3 d-flex">
                <div class="row" style="margin-top: 14px;">
                    <div class="district128 col-md-3">
                        <label>{{ __('CASE NO.:') }}</label>
                    </div>
                    <div class="district128 col-md-9">
                        <input name="<?php echo base64_encode('TextBox2'); ?>" value="<?php echo isset($savedData['case_number']) ? $savedData['case_number'] : ''; ?>" placeholder="" type="text" class=" form-control">
                    </div>
                    <div class="district128 col-md-1">
                        <input name="<?php echo base64_encode('CheckBox0'); ?>" value="YES"  placeholder="" type="checkbox" class=" form-control">
                    </div>
                    <div class="district128 col-md-9">
                        <label>{{ __('Check if this form is submitted with an amended creditor list.') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="district128 col-md-12">
        <div class="row">
            <div class="district128 col-md-12 text-center" style="margin-top: 1rem !important;">
                <h3 style="text-decoration: underline;">{{ __('VERIFICATION OF CREDITOR LIST') }}</h3> 
            </div>
            <div class="district128 col-md-12">
                <p>
                    {{ __('I(I/We) declare under penalty of perjury that all entities included or to be included in Schedules D, E/F, G, and H are listed in the creditor list submitted with this verification. This includes all creditors, parties to leases and executory contracts, and codebtors.') }}
                </p>
            </div>
            <div class="district128 col-md-12">
                <p>
                    {{ __('(I/We) declare that the names and addresses of the listed entities are true and correct to the best of (my/our) knowledge.') }}
                </p>
            </div>
            <div class="district128 col-md-12">
                <p>
                {{ __('(I/We) understand that (I/we) must file an amended creditor list and pay an amendment fee if there are entities listed on (my/our) schedules that are not included in the creditor list submitted with this verification.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="district128 col-md-3 mt-3">
        <div class="ds128 input-group d-flex">
            <label for="ds128">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('TextBox4'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" id="ds128" class="date_filed form-control">
        </div>
    </div>
    <div class="district128 col-md-5"></div>
    <div class="district128 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <input name="<?php echo base64_encode('TextBox5'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Debtor') }}</label>
        </div>
    </div>
    <div class="district128 col-md-3 mt-3">
        <div class="input-group">
        </div>
    </div>
    <div class="district128 col-md-5"></div>
    <div class="district128 col-md-4 mt-3">
        <div class="input-group ml-30 text-center">
            <input name="<?php echo base64_encode('TextBox6'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
            <label style="width:205px;">{{ __('Signature of Joint Debtor') }}</label>
        </div>
    </div>

    <div class="district128 col-md-12 mt-3">
         
    </div>   


</div>
