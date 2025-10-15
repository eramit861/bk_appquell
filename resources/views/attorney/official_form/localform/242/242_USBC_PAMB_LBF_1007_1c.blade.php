<div class="row">
    <div class=" col-md-12 text-center mb-3">
        <h3 class="underline">{{ __('LOCAL BANKRUPTCY FORM 1007-1(c)') }}</h3>
        <h3 class="mt-3">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE MIDDLE DISTRICT OF PENNSYLVANIA') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtors"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="CHAPTER"
                casenoNameField="Chapter"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label>{{ __('CASE NO.') }}</label>
                </div>
                <div class="col-md-9">
                    <p>
                        <input type="text" name="<?php echo base64_encode('Office Number'); ?>" class="form-control width_10percent">
                        -
                        <input type="text" name="<?php echo base64_encode('Case Year'); ?>" class="form-control width_20percent">
                        -bk-
                        <input type="text" name="<?php echo base64_encode('Case Number'); ?>" class="form-control w-auto" value="{{$chapterNo}}">
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class=" col-md-12 text-center mb-3 mt-3">
        <h3 class="">{{ __('CERTIFICATION OF NO PAYMENT ADVICES') }}<br>{{ __('pursuant to 11 U.S.C. § 521(a)(1)(B)(iv)') }}</h3>
    </div>
    <div class=" col-md-12">
        <p>
            <span class="pl-4"></span>
            I 
            <input type="text" name="<?php echo base64_encode('Name'); ?>" class="form-control width_30percent" value="{{$onlyDebtor}}">
            , {{ __('hereby certify that within sixty (60) days before the date of filing
            the above-captioned bankruptcy petition, I did not receive payment advices (e.g. “pay stubs”), as
            contemplated by 11 U.S.C. § 521(a)(1)(B)(iv)') }}, <span class="text-bold">{{ __('from any source of employment') }}</span>{{ __('. I further certify that I
            received no payment advices during that period because:') }}
        </p>
    </div>
    
    <div class=" col-md-12 pl-4">
        <div class="d-flex pl-2">
            <input type="checkbox" name="<?php echo base64_encode('Unable to Work'); ?>" value="Yes" class="w-auto form-control height_fit_content">
            <div class="pl-2">
                <p>
                    {{ __('I have been unable to work due to a disability throughout the sixty (60) days immediately
                    preceding the date of the above-captioned petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <input type="checkbox" name="<?php echo base64_encode('No regular income'); ?>" value="Yes" class="w-auto form-control height_fit_content">
            <div class="pl-2">
                <p>
                    {{ __('I have received no regular income other than Social Security payments throughout the
                    sixty (60) days immediately preceding the date of the above-captioned petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <input type="checkbox" name="<?php echo base64_encode('Self-employment'); ?>" value="Yes" class="w-auto form-control height_fit_content">
            <div class="pl-2">
                <p>
                    {{ __('My sole source of regular employment income throughout the sixty (60) days
                    immediately preceding the date of the above-captioned petition has been through self-
                    employment from which I do not receive evidence of wages or a salary at fixed intervals.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <input type="checkbox" name="<?php echo base64_encode('Unemployed'); ?>" value="Yes" class="w-auto form-control height_fit_content">
            <div class="pl-2">
                <p>
                    {{ __('I have been unemployed throughout the sixty (60) days immediately preceding the date
                    of the above-captioned petition.') }}
                </p>
            </div>
        </div>
        <div class="d-flex pl-2">
            <input type="checkbox" name="<?php echo base64_encode('Did not receive payment advices'); ?>" value="Yes" class="w-auto form-control height_fit_content">
            <div class="pl-2 w-100">
                <p>
                    {{ __('I did not receive payment advices due to factors other than those listed above. (Please
                    explain).') }}
                </p>
                <textarea name="<?php echo base64_encode('Explanation why you did not receive payment advices'); ?>" class="form-control" rows="3"></textarea>
            </div>
        </div>
        <p class="mt-3">
            <span class="pl-3"></span>
            {{ __('I certify under penalty of perjury that the information provided in this certification is true and
            correct to the best of my knowledge and belief.') }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="DATE:"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Debtor"
            inputFieldName="Debtor"
            inputValue={{$debtor_sign}}> 
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor"
                inputFieldName="Joint Debtor"
                inputValue={{$debtor2_sign}}>
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    
</div>