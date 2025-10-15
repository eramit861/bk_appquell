<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE SOUTHERN DISTRICT OF WEST VIRGINIA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <div class="row">
            <div class="col-md-1">
                <label for="">{{ __('IN') }}&nbsp;{{ __('RE:') }}</label>
            </div>
            <div class="col-md-11 text-center">
                <textarea name="<?php echo base64_encode('Text1');?>" class="form-control" rows="4"><?php echo $debtorname ?? ''; ?></textarea>
                <label for="">{{ __('Debtor.') }}</label>
                <textarea name="<?php echo base64_encode('Text2');?>" class="form-control" rows="2"></textarea>
                <label for="">{{ __('Plaintiff,') }}</label>
            </div>
            <div class="col-md-1">
                <label for="">v.</label>
            </div>
            <div class="col-md-11 text-center">
                <textarea name="<?php echo base64_encode('Text3');?>" class="form-control" rows="4"></textarea>
                <label for="">{{ __('Defendant.') }}</label>
            </div>
        </div>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="BK NO."
                casenoNameField="Text4"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>    
        </div>
        <div class="mt-1">
            <x-officialForm.caseNo
                labelText="AP NO."
                casenoNameField="Text5"
                caseno=""
            ></x-officialForm.caseNo>    
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('CORPORATE OWNERSHIP STATEMENT [RULES 1007(a)(1) & 7007.1]') }}</h3>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            <span class="pl-4"></span>
            {{ __('Pursuant to Federal Rules of Bankruptcy Procedures 1007(a)(1) and 7007.1, the undersigned corporation') }}
            <input type="text" name="<?php echo base64_encode('name of corporation certifies that');?>" class="form-control width_50percent">
            {{ __('(name of corporation) certifies that:') }}
        </p>
    </div>

    <div class="col-md-12 mt-3">
        <p>
            1. <input type="checkbox" name="<?php echo base64_encode('Check Box6');?>" value="Yes" class="form-control width_auto"> {{ __('the following is a complete and accurate list of corporation(s) that directly or indirectly
            own(s) 10% or more of any class of its equity interests:') }}
        </p>
        <h3 class="text-center">{{ __('OR') }}</h3>
        <p class="mt-3">
            2. <input type="checkbox" name="<?php echo base64_encode('Check Box7');?>" value="Yes" class="form-control width_auto"> {{ __('there are no entities to report under FRBP 1007(a)(1) or 7007.1.') }}
        </p>
        <p>
            <span class="pl-4"></span>
            {{ __('The undersigned corporation further acknowledges its duty to file a supplemental statement
            promptly upon any change in circumstances that renders this Corporate Ownership Statement
            inaccurate.') }}
        </p>
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="Date"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Name of Corporation"
            inputFieldName="Name of Corporation"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="By:"
                inputFieldName="By"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="mt-1 pl-2">
            <x-officialForm.debtorSignVertical
                labelContent="Its:"
                inputFieldName="Its"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
    </div>

</div>