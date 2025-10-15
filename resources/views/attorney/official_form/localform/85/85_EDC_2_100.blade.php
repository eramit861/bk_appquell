<div class="row">
    
        <div class="col-md-12 mb-3">
            <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br> {{ __('EASTERN DISTRICT OF CALIFORNIA') }}</h3>
        </div>
        <div class="col-md-6 border_1px p-3 br-0">
            <div class="input-grpup">
                <label>{{ __('In re') }}</label>
                <textarea name="<?php echo base64_encode('DbName'); ?>" value="" class="form-control" rows="4" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div class=""> 
                <x-officialForm.caseNo
                    labelText="{{ __('Case No.') }}"
                    casenoNameField="CaseNo"
                    caseno={{$caseno}}>
                </x-officialForm.caseNo>
            </div>
        </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline">{{ __('VERIFICATION OF MASTER ADDRESS LIST') }}</h3>
    </div>
    
   <!-- NEW -->
    <div class="col-md-12 mt-3">
        <p class="mt-3 pl-4">{{ __('I (we) declare under penalty of perjury that the attached Master Address List is a true, correct, and 
            complete list of creditors and their addresses in this case.') }}</p>
        <p class="mt-3 pl-4">{{ __('I (we) acknowledge the following:') }}</p>
        <ul class="list-bullet">
            <li class="mt-3">{{ __('Filing a Master Address List with incomplete or incorrect addresses may mean that creditor(s) with 
            incomplete or incorrect address(es) may not receive notification of this Bankruptcy case.') }}</li>
            <li class="mt-3">{{ __('The debtor(s) and the debtor’s(s’) attorney or bankruptcy petition preparer, if any, share responsibility 
            for the accuracy and completeness of the attached Master Address.') }}</li>
            <li class="mt-3">{{ __('The Court will use the addresses on the attached Master Address List for all items that the Court mails, 
            and will not rely on other documents filed in this case (such as schedules and statements required by 
            the Bankruptcy Code and the Federal Rules of Bankruptcy Procedure) to obtain or verify the 
            addresses of creditors') }}</li>
        </ul>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ __('DATED:') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input name="<?php echo base64_encode('DATED'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                    </div>
                </div>
                <label></label>
            </div>
            <div class="col-md-6">
                <input readonly name="<?php echo base64_encode('Text1'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control">
                <label>{{ __('Debtor’s Signature') }}</label>
            </div>
        </div>
        <div class="input-group d-flex">
        <div class="col-md-6">
                <div class="row">
                    <div class="col-md-2">
                        <label>{{ __('DATED:') }}</label>
                    </div>
                    <div class="col-md-10">
                        <input name="<?php echo base64_encode('DATED_2'); ?>" placeholder="{{ __('MM/DD/YYYY') }}" type="text" value="{{$currentDate}}" class="date_filed form-control">
                    </div>
                </div>
                <label></label>
            </div>
            <div class="col-md-6">
                <input readonly name="<?php echo base64_encode('Text2'); ?>" value="<?php echo $debtor2_sign;?>" type="text" class="form-control">
                <label>{{ __('Joint Debtor’s (if any) signature') }}</label>
            </div>
        </div>
    </div>
    
    <div class="col-md-12 mt-3">
         
    </div>
</div>