<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF GEORGIA') }}<br>
            <select class="w-auto form-control" name="<?php echo base64_encode('Combo Box4'); ?>">
                <option value="ATLANTA DIVISION" selected="true"> {{ __('ATLANTA DIVISION') }}</option>
                <option value="GAINESVILLE DIVISION">{{ __('GAINESVILLE DIVISION') }}</option>
                <option value="NEWNAN DIVISION">{{ __('NEWNAN DIVISION') }}</option>
                <option value="ROME DIVISION">{{ __('ROME DIVISION') }}</option>
            </select>
        </h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3 mt-3">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text5"
            debtorname={{$debtorname}}
            rows="4">
        </x-officialForm.inReDebtorCustom>
        <div class="mt-1">
           <textarea name="<?php echo base64_encode(""); ?>" class="form-control" rows="4"></textarea>
        </div>
    </div> 
    <div class="col-md-6 border_1px p-3 mt-3">
        <div>
            <x-officialForm.caseNo
                labelText="{{ __('Case No:') }}"
                casenoNameField="Text6"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <div class="mt-2">
            <x-officialForm.caseNo
                labelText="{{ __('Chapter') }}"
                casenoNameField="Text7"
                caseno={{$chapterNo}}
            ></x-officialForm.caseNo>
        </div>
    </div>

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('VERIFICATION OF OFFICIAL CREDITOR LIST (INITIAL OR SUPPLEMENTAL)') }}</h3>
    </div> 
    <div class="col-md-12">
        <div class="">
            <input type="checkbox" value="" name="<?php echo base64_encode(''); ?>" class=" form-control w-auto">
            <label>{{ __('Original') }}</label>                      
        </div>
        <div class="">
            <input type="checkbox" value="" name="<?php echo base64_encode(''); ?>" class=" form-control w-auto">
            <label>{{ __('Amendment') }}</label>                      
        </div>
        <div class="">
            <input type="checkbox" value="" name="<?php echo base64_encode(''); ?>" class=" form-control w-auto">
            <label>{{ __('Adding') }}</label>                      
        </div>
        <div class="">
            <input type="checkbox" value="" name="<?php echo base64_encode(''); ?>" class=" form-control w-auto">
            <label>Deleting<input name="<?php echo base64_encode(''); ?>"  type="text" class="form-control width_40percent ml-1"></label>                      
        </div>
        <p class="mt-3">
            {{ __('I hereby certify under penalty of perjury that the master mailing list of creditors attached and/or uploaded to 
            the Electronic Case Filing System is true, correct and complete to the best of my knowledge.') }} 
        </p>
        <p>
            {{ __('I further acknowledge that (1) the accuracy and completeness of the creditor list are the shared responsibility of the debtor
            and the debtor’s attorney, (2) the court will rely on the creditor list for all mailings, and (3) the various schedules and 
            statements required by the Bankruptcy Rules are not used for mailing purposes.') }} 
        </p>
        <p>
            {{ __('If you are amending a previously-filed list of creditors, attach a list of only the creditor being added or deleted and
            indicate below only the number of creditors being added or deleted.') }}
        </p>
        <p>
            <input name="<?php echo base64_encode(''); ?>"  type="text" class="form-control w-auto"> 
            {{ __('creditor(s) (or if amended, number of creditors added), as shown on attached list') }} 
        </p>
        <p>
            <input name="<?php echo base64_encode(''); ?>"  type="text" class="form-control w-auto">
            {{ __('creditor(s) to be deleted, as shown on attached list') }}
        </p>
    </div>
  
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Debtor Signature') }}"
            inputFieldName=""
            inputValue="{{$debtor_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Joint Debtor Signature') }}"
            inputFieldName=""
            inputValue="{{$debtor2_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3 mb-3">
       <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Signature of Attorney') }}"
            inputFieldName=""
            inputValue="{{$attorny_sign}}">
        </x-officialForm.debtorSignVerticalOpp>
    </div>
    <div class="col-md-6 mt-3 mb-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated:') }}"
            dateNameField="Date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
        <div>
            <p class="text_italic">{{ __('[Check if applicable]') }}</p>
        </div>
        <div class="d-flex">
        <input type="checkbox" value="" name="<?php echo base64_encode(''); ?>" class=" form-control w-auto">
        <div>
            <label>{{ __('Creditors with foreign addresses included') }}</label>
        </div>
            
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3 text-center">
        <h3>
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('FOR THE SOUTHERN DISTRICT OF ALABAMA') }}
        </h3>
        <p class="underline text-bold mt-3 mb-1">
            {{ __('OFFICIAL CREDITOR LIST GUIDELINES') }}
        </p>
    </div>
    <div class="col-md-12">
        <p class="mb-2">{{ __('The Official Creditor List must be provided to the court in electronic format and meet the requirements below:') }} </p>
        <ul class="dot_list">
            <li class="pl-2">
                {{ __('The name and address of each creditor must be five lines or fewer') }}
            </li>
            <li class="pl-2">
                {{ __('Each line may contain no more than 40 characters including spaces') }}
            </li>
            <li class="pl-2">
                {{ __('Names and addresses should be left justified (no leading spaces) with only one column of creditors') }}
            </li>
            <li class="pl-2">
                {{ __('If attention lines are used, they should appear on the second line of the address') }}
            </li>
            <li class="pl-2">
                {{ __('City, state, and ZIP code must be on the last line') }}
            </li>
            <li class="pl-2">
                {{ __('All states must be two-letter abbreviations') }}
            </li>
            <li class="pl-2">
                {{ __('If a nine-digit ZIP code is used, a hyphen must separate the first five digits from the last four digits') }}
            </li>
            <li class="pl-2">
                {{ __('DO NOT include the following names on the mailing list because they will be retrieved automatically by the
                court’s computer system: debtor, joint debtor, attorney for debtor(s), Bankruptcy Administrator') }}
            </li>
        </ul>
        <p class="mb-2">
            Attorney Filers<br>
            {{ __('Most bankruptcy preparation software packages can save the creditor list electronically in the proper format.
            Please check with your software company to see if you have this option.') }}  
        </p>
        <p class="mb-2">Filers without an Attorney (Pro Se Debtors)<br>
          {{ __('Filers without an attorney may submit a list of creditors to the clerk’s office with the petition.') }}</p>
        <p class="mb-2">Verification of Official Creditor List (LBF 1007)<br>
           {{ __('The initial or supplemental of an official creditor list shall be accompanied by a Verification 
           of Official Creditor List in the format provided by the Clerk.') }}
        </p>
        <p class="mb-2">Amendments<br>
           {{ __('Amendments to the Official Creditor List shall contain only names and addresses to be added to or 
           deleted from the Official Creditor List and must comply with the requirements above.') }}
        </p>
    </div>
</div>