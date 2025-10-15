<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">IN THE {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF KANSAS') }}</h3>
    </div>

    <div class="col-md-6 border_1px p-3 br-0">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Debtor');?>" value="" class=" form-control" rows="1">{{$onlyDebtor}} and</textarea>
            <textarea name="<?php echo base64_encode('Joint-Debtor');?>" value="" class=" form-control" rows="1">{{$spousename}}</textarea>
            <label class="float_right">{{ __('Debtor(s) Name(s)') }}</label>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="CaseNo"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>
    
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center underline">{{ __('DECLARATION REGARDING PAYMENT ADVICES') }}<br>{{ __('OR EVIDENCE OF PAYMENT UNDER 11 U.S.C. § 521(a)(1)(B)(iv)') }}</h3>
    </div>
  
    <div class="col-md-12">
        <p class="text-bold underline mb-2">{{ __('Debtor:') }}</p>
        <p>{{ __('Mark statement that applies to you:') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('deb-chk');?>" value="1" class="form-control w-auto height_fit_content not_payment_received">
            </div>
            <div class="w-100">
                <p>
                    {{ __('I have not been employed by any employer within the 60 days before the date of the filing of the
                    petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('deb-chk');?>" value="2" class="form-control w-auto height_fit_content payment_received">
            </div>
            <div class="w-100">
                <p class="mb-0">
                    {{ __('I have received payment advices or other evidence of payment within 60 days before the date I filed
                    my bankruptcy petition from any employer, and they are attached, except:') }}
                </p>
                <textarea name="<?php echo base64_encode('deb-except');?>" id="" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('deb-chk');?>" value="3" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p class="mb-0">
                    {{ __('I was employed by an employer within 60 days before the date I filed my bankruptcy petition, but I
                    have not received payment advices or other evidence of payment because:') }}
                </p>
                <textarea name="<?php echo base64_encode('deb-explain');?>" id="" class="form-control" rows="2"></textarea>
                <p class="mb-0">
                    {{ __('(Explanation)') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold underline mb-2">{{ __('Joint Debtor (if applicable):') }}</p>
        <p>{{ __('Mark statement that applies to you:') }}</p>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('jdeb-chk');?>" value="1" class="form-control w-auto height_fit_content spouse_not_payment_received ">
            </div>
            <div class="w-100">
                <p>
                    {{ __('I have not been employed by any employer within the 60 days before the date of the filing of the
                    petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('jdeb-chk');?>" value="2" class="form-control w-auto height_fit_content spouse_payment_received">
            </div>
            <div class="w-100">
                <p class="mb-0">
                    {{ __('I have received payment advices or other evidence of payment within 60 days before the date I filed
                    my bankruptcy petition from any employer, and they are attached, except:') }}
                </p>
                <textarea name="<?php echo base64_encode('jdeb-except');?>" id="" class="form-control" rows="2"></textarea>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="">
                <input type="radio" name="<?php echo base64_encode('jdeb-chk');?>" value="3" class="form-control w-auto height_fit_content">
            </div>
            <div class="w-100">
                <p class="mb-0">
                    {{ __('I was employed by an employer within 60 days before the date I filed my bankruptcy petition, but I
                    have not received payment advices or other evidence of payment because:') }}
                </p>
                <textarea name="<?php echo base64_encode('jdeb-explain');?>" id="" class="form-control" rows="2"></textarea>
                <p class="mb-0">
                    {{ __('(Explanation)') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('I declare (or certify, verify, or state) under penalty of perjury that the above is true and correct.') }}</p>
    </div>

    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor Signature"
            inputFieldName="deb-sig"
            inputValue={{$debtor_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    
    <div class="col-md-4 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Joint Debtor Signature (if applicable) "
            inputFieldName="jdeb-sig"
            inputValue={{$debtor2_sign}}
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-2 mt-3"></div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>

</div>