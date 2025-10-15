<div class="row">
    
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-12 mb-3">
               <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br> {{ __('EASTERN DISTRICT OF CALIFORNIA') }}</h3>
         </div>
         <div class="col-md-6 border_1px p-3 br-0">
            <div class="input-grpup">
                  <label>{{ __('In re') }}</label>
                  <textarea name="<?php echo base64_encode('Db'); ?>" value="" class="form-control" rows="3" cols="" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
            </div>
         </div>
         
         <div class="col-md-6 border_1px p-3">
            <x-officialForm.caseNo
               labelText="{{ __('Case No.') }}"
               casenoNameField="Case No"
               caseno={{$caseno}}>
            </x-officialForm.caseNo>
            <h3 class="underline mt-3">{{ __('AMENDMENT COVER SHEET') }}</h3>
         </div>
      </div>
   </div>


   <div class="col-md-12 mt-3">
      <p> <strong>{{ __('This form shall not be used to amend or modify plans.') }}</strong></p>
      <p class="mt-3">{{ __('I am amending the following documents:') }}</p>
   </div>

   <div class="col-md-6">
      <div class="input-group pl-4">
         <input name="<?php echo base64_encode('Check Box3'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('Petition') }}</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box26'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('Statement of Financial Affairs') }}</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="input-group pl-4">
         <input name="<?php echo base64_encode('Check Box4'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('Creditor Matrix') }}</label>
      </div>
    </div>
    <div class="col-md-6">
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box27'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('Statement of Intention') }}</label>
      </div>
    </div>

    <div class="col-md-6">
      <div class="input-group pl-4">
         <input name="<?php echo base64_encode('Check Box5'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('List of 20 Largest Unsecured Creditors') }}</label>
      </div>
    </div>

    <div class="col-md-6">
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box28'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('List of Equity Security Holders') }}</label>
      </div>
    </div>
    <div class="col-md-12">
      <div class="input-group pl-4">
         <input name="<?php echo base64_encode('Check Box6'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('Schedules (check appropriate boxes).') }}</label>
      </div>
      <div class="input-group d-flex ml-30">
      <div class="input-group pl-3">
         <input name="<?php echo base64_encode('Check Box9'); ?>" value="Yes" type="checkbox">
         <label for="">A/B</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box10'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">C</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box11'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">D</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box12'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">E/F</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box13'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">G</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box15'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">H</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box16'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">I</label>
      </div>
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box17'); ?>" value="Yes" type="checkbox" class="ml-30 height_fit_content w-auto">
         <label for="">J</label>
      </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="input-group">
         <input name="<?php echo base64_encode('Check Box8'); ?>" value="Yes" type="checkbox">
         <label for="">{{ __('Summary of Schedules of Assets and Liabilities') }}</label>
      </div>
    </div>

    <div class="col-md-12 mt-3">
        <p><strong>{{ __('A fee of $32 is required for:') }}</strong></p>
        <ul class="list-bullet">
            <li>{{ __('An amendment that adds or deletes creditors;') }}</li>
            <li>{{ __('An amendment that changes amounts owed to a creditor; or') }}</li>
            <li>{{ __('An amendment that changes the classification of a debt.') }}</li>
        </ul>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline font-weight-normal">{{ __('NOTICE OF AMENDMENT TO AFFECTED PARTIES') }}</h3>
         <p class="mt-3 pl-4"> {{ __('I certify that I have notified the trustee in the case (if any) that I have filed or intend to file the amended or supplemental document(s) listed above, and that I have notified all parties affected by the amendment, as required by Federal Rule of Bankruptcy Procedure 1009.') }}*</p>
    </div>

    <div class="col-md-12 mt-3">
        <div class="input-group d-flex">
            <label style="width:7%;">{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('Date'); ?>" value="<?php echo $currentDate;?>" style="width:20%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
            <label style="width:33%;">{{ __("Attorney's or Pro Se Debtor's Signature:") }}</label>
            <input name="<?php echo base64_encode('Signature'); ?>" value="<?php echo $attorny_sign;?>" style="width:40%;" type="text" class="form-control">
        </div>

        <div class="input-group d-flex">
            <label style="width:47%;"></label>
            <label style="width:13%;">{{ __('Printed Name:') }}</label>
            <input name="<?php echo base64_encode('Name'); ?>" value="<?php echo $attorney_name;?>" style="width:40%;" type="text" class="form-control">
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center underline font-weight-normal">{{ __('DECLARATION BY DEBTOR') }}</h3>
         <p class="mt-3 pl-4">{{ __('I(We), the undersigned debtor(s), hereby declare under penalty of perjury that the information set forth in the amendment(s)
         attached hereto, consisting of') }} 
         <input name="<?php echo base64_encode('No. of Pages'); ?>" value="" type="text" style="width:50px;" class="form-control"> {{ __('pages, is true and correct.') }}</p>
    </div>


     <div class="col-md-6 mt-3">
        <div class="input-group d-flex">
            <label>{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('Date2'); ?>" value="<?php echo $currentDate;?>" style="width:60%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        </div>
     </div>

     <div class="col-md-6 mt-3">
        <div class="input-group d-flex">
            <label>{{ __('Dated:') }}</label>
            <input name="<?php echo base64_encode('Date3'); ?>" value="<?php echo $currentDate;?>" style="width:60%;" type="text" placeholder="{{ __('MM/DD/YYYY') }}" class="date_filed form-control">
        </div>
     </div>

     <div class="col-md-5 mt-3">
        <div class="input-group">
         <input name="<?php echo base64_encode('DbSignature'); ?>" value="<?php echo $debtor_sign;?>" type="text" class="form-control"><br>
         <label >{{ __("Debtor's Signature:") }}</label>
        </div>
     </div>
     <div class="col-md-1 mt-3"></div>
     <div class="col-md-6 mt-3">
        <div class="input-group">
         <input name="<?php echo base64_encode('JDbSignature'); ?>" value="<?php echo $debtor2_sign;?>"  type="text" class="form-control"><br>
         <label>{{ __("Joint Debtor's Signature") }}</label>
        </div>
     </div>
    
   <div class="col-md-12 mt-3">
       <h3 class="text-center underline">{{ __('INSTRUCTIONS') }}</h3>
   </div>
   <div class="col-md-12 mt-3">
        <h3 class="text-center underline font-weight-normal">{{ __('DECLARATION BY DEBTOR') }}</h3>
         <p class="mt-3 pl-4">{{ __('Attach each amended document to this form. If there is a box on the form to indicate that the form is amended or supplemental, check the box. Otherwise, write the word “Amended” or “Supplemental” at the top of the form.') }}</p>
         <p class="mt-3 pl-4">{{ __('If you are amending Schedules A/B, D, E/F, I, or J, you must also file an Amended Summary of Schedules of Assets and Liabilities in order to ensure that the totals are amended for statistical purposes. This form can be found on our website.') }}</p>
  <ul class="list-bullet">
      <li>{{ __("To") }} <strong>{{ __('add') }}</strong> {{ __('creditors, write or type an “A” next to the creditors you are adding on any amended schedule you file. Additionally, (or, in the event that you are only amending the creditor matrix) attach a list of all creditors with their addresses in .txt format.') }}</li>
      <li>{{ __("To") }} <strong>{{ __('correct') }}</strong> {{ __('the names or addresses of creditors that appear on any schedule, use our Change of Address Form (EDC 2-085) instead of filing this form, any amended schedule or an amended master address list.') }}</li>
      <li>{{ __("To") }} <strong>{{ __('delete') }}</strong> {{ __('creditors, write or type a “D” next to the creditors you are deleting on any amended schedule you file . Do not submit a .txt file of creditors to be deleted. Only creditors who have not filed a proof of claim in the case will be deleted .') }}</li>
  </ul>
  <p class="mt-3 pl-4">*{{ __("Federal Rule of Bankruptcy Procedure 1009 requires the debtor to give notice of an amendment.") }} 
   <strong>{{ __("Notice of the amendment will not be given by the Clerk's Office.") }}</strong>
   {{ __("To comply with this requirement, the debtor's attorney or Pro Se debtor must give notice to the trustee and any party affected by the amendment by serving the amendment and all previous court notices including, but not limited to, the notice of meeting of creditors, discharge of debtor, etc. A proof of service, indicating that service has been made, must be filed with the court.") }}
   </p>
  <p class="mt-3 text-center">{{ __('Checks and money orders should be payable to Clerk, U.S. Bankruptcy Court.') }}
    <strong>{{ __('(NOTE: No personal checks will be accepted.)') }}</strong></p>
</div>

</div>