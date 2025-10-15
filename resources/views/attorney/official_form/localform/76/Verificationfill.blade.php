<div class="text-center">
   <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
       {{ __('FOR THE SOUTHERN DISTRICT OF ALABAMA') }}</h3>
</div>
<div class="row my-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="inre"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
            <textarea name="<?php echo base64_encode('debtor'); ?>" type="text" value="" class="form-control mt-2" rows="2"></textarea>
        </div>
        <div class="col-md-6 border_1px p-3">
        <div>
                <x-officialForm.caseNo
                    labelText="Case No."
                    casenoNameField="caseno"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
    </div>
    <div class="text-center mt-3 mb-4 underline">
        <h3>{{ __('VERIFICATION OF OFFICIAL CREDITOR LIST (INITIAL OR SUPPLEMENTAL)') }}</h3>
    </div>
    <div class="row mt-3">
        <div class="col-md-4"></div>
        <div class="col-md-4"> 
           <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('org'); ?>" value="Yes">
           <label>{{ __('Original') }}</label>
           <div>
               <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('amd'); ?>" value="Yes">
               <label>{{ __('Amendment') }}</label>
           </div>
           <div class="pl-5">
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('add'); ?>" value="Yes">
                <label>{{ __('Adding') }}</label>
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('del'); ?>" value="Yes">
                <label>{{ __('Deleting') }}</label>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <div class="mt-3">
        <p><span class="pl-4"></span>{{ __('I hereby certify under penalty of perjury that the master mailing list of creditors attached and/or
        uploaded to the Electronic Case Filing System is true, correct and complete to the best of my knowledge.') }}</p>
        <p><span class="pl-4"></span>{{ __('I further acknowledge that (1) the accuracy and completeness of the creditor
        list are the shared responsibility of the debtor and the debtor’s attorney, (2) the court will rely on the creditor list for 
        all mailings, and (3) the various schedules and statements required by the Bankruptcy Rules are not used for mailing purposes.') }}</p>
        <p><span class="pl-4"></span>{{ __('If you are amending a previously-filed list of creditors, attach a list of') }} <span class="underline"> {{ __('only') }} </span> {{ __('the creditor being 
        added or deleted and indicate below only the number of creditors being added or deleted.') }}</p>
        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <input name="<?php echo base64_encode('cred1'); ?>" type="text" value="" class="form-control width_auto">
                <label>{{ __('creditor(s) (or if amended, number of creditors added), as shown on attached list') }}</label>
                <div class="mt-2">
                    <input name="<?php echo base64_encode('cred2'); ?>" type="text" value="" class="form-control width_auto">
                    <label>{{ __('creditor(s) to be deleted, as shown on attached list') }}</label>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>   
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
           <x-officialForm.signVertical
                labelText="Debtor Signature"
                signNameField="TextBox0"
                sign={{$debtor_sign}}
            ></x-officialForm.signVertical>
            <div class="mt-4">
                <x-officialForm.signVertical
                    labelText="Signature of Attorney"
                    signNameField="TextBox1"
                    sign={{$debtor2_sign}}
                ></x-officialForm.signVertical>
            </div>
        </div>
        <div class="col-md-6">
           <x-officialForm.signVertical
                labelText="Joint Debtor Signature"
                signNameField="TextBox2"
                sign={{$attorny_sign}}
            ></x-officialForm.signVertical>
            <div class="mt-4">
            <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
                <label class="text_italic text-bold">{{ __('[Check if applicable]') }}</label>
                <div class="mt-2">
                    <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('foreign'); ?>" value="Yes">
                    <label>{{ __('Creditors with foreign addresses included') }}</label>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
       <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
       {{ __('FOR THE SOUTHERN DISTRICT OF ALABAMA') }}</h3>
    </div>
    <div class="text-center mt-4 mb-4 underline">
        <h3>{{ __('OFFICIAL CREDITOR LIST GUIDELINES') }}</h3>
    </div>
    <p>{{ __('The Official Creditor List must be provided to the court in electronic format and meet the requirements
    below:') }}</p>
    <ul class="dot_list">
        <li>{{ __('The name and address of each creditor must be five lines or fewer') }}</li>
        <li>{{ __('Each line may contain no more than 40 characters including spaces') }}</li>
        <li>{{ __('Names and addresses should be left justified (no leading spaces) with only one column of creditors') }}</li>
        <li>{{ __('If attention lines are used, they should appear on the second line of the address') }}</li>
        <li>{{ __('City, state, and ZIP code must be on the last line') }}</li>
        <li>{{ __('All states must be two-letter abbreviations') }}</li>
        <li>{{ __('If a nine-digit ZIP code is used, a hyphen must separate the first five digits from the last four digit') }}</li>
        <li>{{ __('DO NOT include the following names on the mailing list because they will be retrieved
        automatically by the court’s computer system: debtor, joint debtor, attorney for
        debtor(s), Bankruptcy Administrator') }}</li>
    </ul>

    <p class="mb-0">{{ __('Attorney Filers') }}</p> 
    <p>{{ __('Most bankruptcy preparation software packages can save the creditor list electronically in the proper format.
    Please check with your software company to see if you have this option.') }}</p>

    <p class="mb-0">{{ __('Filers without an Attorney (Pro Se Debtors)') }}</p>
    <p>{{ __('Filers without an attorney may submit a list of creditors to the clerk’s office with the petition.') }}</p>
  
    <p class="mb-0">{{ __('Amendments') }}</p>
    <p>{{ __('Amendments to the Official Creditor List shall contain only names and addresses to be added to or
    deleted from the Official Creditor List and must comply with the requirements above.') }}</p>


  