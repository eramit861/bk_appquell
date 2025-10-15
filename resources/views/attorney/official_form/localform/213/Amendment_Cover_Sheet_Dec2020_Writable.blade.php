<div class="text-center">
   <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
      {{ __('WESTERN DISTRICT OF NEW YORK') }}</h3>
   <h3 class="underline">{{ __('COVER SHEET FOR SCHEDULES, STATEMENTS, LISTS AND/OR AMENDMENTS') }}</h3>
</div>
<div class="row mt-2">
   <div class="col-md-6">
      <p>Case Name:<input name="<?php echo base64_encode('Case Name'); ?>" type="text" value="{{$debtorname}}" class="form-control width_85percent ml-3"> </p>
   </div>
   <div class="col-md-3">
      <x-officialForm.caseNo
         labelText="Case No."
         casenoNameField="Case No"
         caseno={{$caseno}}
      ></x-officialForm.caseNo>
   </div>
   <div class="col-md-3">
      <x-officialForm.caseNo
            labelText="Chapter:"
            casenoNameField="Chapter"
            caseno={{$chapterNo}}
      ></x-officialForm.caseNo>
   </div>
</div>
<div class="d-flex mt-2 mb-2">
   <span class="pr-2 text-bold">A.</span>
   <span class="text-bold underline">{{ __('IDENTIFY TYPE OF DOCUMENT BEING FILED:') }} </span>
   <span class="underline">{{ __('(Select either #1, #2 or #3)') }}</span>
</div>
<div class="pl-4">
   <div class="form-check">
      <p>
         <input type="checkbox" class="form-control w-auto " name="<?php echo base64_encode('Check Box66'); ?>" value="Yes">
         {{ __('#1--Amendment to Previously Filed Document (Go to Sec. B)') }}
      </p>
   </div>
   <div class="form-check">
      <p>
         <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box77'); ?>" value="Yes">
         {{ __('#2--Schedule/Statement Not Previously Filed (Go to Sec. B)') }}
      </p>
   </div>
   <div class="form-check">
      <p>
         <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box88'); ?>" value="Yes">
         {{ __('#3--Schedule of Post-Petition Debts (result of conversion-no fee due) (Go to Sec. D)') }}
      </p>
   </div>
</div>
<div class="d-flex mt-3 mb-2">
   <span class="pr-2 text-bold">B.</span>
   <p class="text-bold underline mb-0">{{ __('SUMMARIZE SPECIFICS OF DOCUMENT BEING FILED BY CHECKING APPLICABLE DATA ELEMENTS:') }}</p>
</div>
<div class="pl-4 row">
   <div class="col-md-6">
      <div class="row">
         <div class="col-md-3 pl-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box99'); ?>" value="Yes">
            <span>{{ __('Official Form 101:') }}</span>
         </div>
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box67'); ?>" value="Yes">
            <span>{{ __('Part 1') }}</span>
         </div>
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box68'); ?>" value="Yes">
            <span>{{ __('Part 2') }}</span>
         </div>
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box69'); ?>" value="Yes">
            <span>{{ __('Part 3') }}</span>
         </div>
      </div>
   </div>
   <div class="col-md-6">
      <div class="row">
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box70'); ?>" value="Yes">
            <span>{{ __('Part 4') }}</span>
         </div>
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box71'); ?>" value="Yes">
            <span>{{ __('Part 5') }}</span>
         </div>
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box72'); ?>" value="Yes">
            <span>{{ __('Part 6') }}</span>
         </div>
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box83'); ?>" value="Yes">
            <span>{{ __('Part 7') }}</span>
         </div>
      </div>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box84'); ?>" value="Yes">
      <span>{{ __('Official Form 106Sum: Summary of Your Assets and Liabilities and Certain Statistical Information') }}</span>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box91'); ?>" value="Yes">
      <span>{{ __("Official Form 106Dec: Declaration About an Individual Debtor's Schedules") }}</span>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box92'); ?>" value="Yes">
      <span>{{ __('Official Form 108: Chapter 7 Statement of Intention for Individuals') }}</span>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box93'); ?>" value="Yes">
      <span>{{ __('Schedules: (Please check schedules attached)') }}</span>
   </div>
   <div class="col-md-12">
      <div class="row pl-4" >
         <div class="col-md-3">
            <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box94'); ?>" value="Yes">
               <span>{{ __('Schedule A/B') }}</span>
            </div>
            <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box98'); ?>" value="Yes">
               <span>{{ __('Schedule G') }}</span>
            </div>
         </div>
         <div class="col-md-3">
         <div class="form-check">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box95'); ?>" value="Yes">
            <span>{{ __('Schedule C') }}</span>
         </div>
         <div class="form-check">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box33'); ?>" value="Yes">
            <span>{{ __('Schedule H') }}</span>
         </div>
         </div>
         <div class="col-md-3">
         <div class="form-check">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box96'); ?>" value="Yes">
            <span>{{ __('Schedule D (Go to Sec. C)') }}</span>
         </div>
         <div class="form-check">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box34'); ?>" value="Yes">
            <span>{{ __('Schedule I') }}</span>
         </div>
         </div>
         <div class="col-md-3">
            <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box97'); ?>" value="Yes">
               <span>{{ __('Schedule E/F (Go to Sec. C)') }}</span>
            </div>
            <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box35'); ?>" value="Yes">
               <span>{{ __('Schedule J') }}</span>
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box36'); ?>" value="Yes">
               <span>{{ __('Schedule J-2') }}</span>
            </div>
         </div>
      </div>
   </div>
   
   <div class="col-md-12">
      <div class="row mt-2">
         <div class="col-md-3">
            <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box37'); ?>" value="Yes">
            <label>{{ __('Statement of Financial Affairs:') }}</label>
         </div>
         <div class="col-md-9">
            <input name="<?php echo base64_encode('SOFA'); ?>" type="text" value="" class="form-control">
         </div>
      </div>
   </div>

   <div class=" col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box38'); ?>" value="Yes">
      <span>{{ __('Statement Pursuant to Rule 2016(b)') }}</span>
   </div>

   <div class="col-md-12 mt-2">
      <div class="row">
         <div class="col-md-2">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box39'); ?>" value="Yes">
               <span>{{ __('Official Form 201:') }}</span>
            </div>
         </div>
         <div class="col-md-2">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box11'); ?>" value="Yes">
               <span>{{ __("Debtor's Name") }}</span>
            </div>
         </div>
         <div class="col-md-2">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box12'); ?>" value="Yes">
               <span>{{ __("Debtor's Address") }}</span>
            </div>
         </div>
         <div class="col-md-2">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box 13'); ?>" value="Yes">
               <span>{{ __("Debtor's EIN") }}</span>
            </div>
         </div>
         <div class="col-md-4">
            <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box14'); ?>" value="Yes">
               <span>{{ __('Other Names used by the Debtor') }}</span>
            </div>
         </div>
      </div>
   </div>
   
   <div class="col-md-12">
      <div class="row mt-2">
         <div class="col-md-2"></div>
         <div class="col-md-2">
            <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box15'); ?>" value="Yes">
               <span>{{ __('Other:') }}</span>
            </div>
         </div>
         <div class="col-md-8">
            <input name="<?php echo base64_encode('Please indicate the Question  from Form 201 that is being amended and a brief description'); ?>" type="text" value="" class="form-control">
            <span>{{ __('(Please indicate the Question # from Form 201 that is being amended and a brief description)') }}</span>
         </div>
      </div>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box16'); ?>" value="Yes">
      <span>{{ __('Official Form 201A: Ch. 11 Attachment to Voluntary Petition for Non-Individuals') }}</span>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box17'); ?>" value="Yes">
      <span>{{ __('Official Form 202: Declaration Under Penalty of Perjury for Non-Individual Debtors') }}</span>
   </div>
   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box18'); ?>" value="Yes">
      <span>{{ __('Creditor Matrix') }}</span>
   </div>


   <div class="col-md-12 mt-2">
      <div class="row">
         <div class="col-md-3">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box19'); ?>" value="Yes">
               <span>{{ __('Chapter 13 Plan (Pre-confirmation):') }}</span>
            </div>
         </div>
         <div class="col-md-3">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box21'); ?>" value="Yes">
               <span>{{ __('Decrease Payments') }}</span>
            </div>
         </div>
         <div class="col-md-3">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box777'); ?>" value="Yes">
               <span>{{ __('Increase Payments') }}</span>
            </div>
         </div>
         <div class="col-md-3">
         <div class="form-check">
               <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box888'); ?>" value="Yes">
               <span>{{ __('increases Length of Plan') }}</span>
            </div>
         </div>
      </div>
   </div>

   <div class="col-md-12 form-check mt-2">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box222'); ?>" value="Yes">
      <span>{{ __('Other') }}:<input name="<?php echo base64_encode('Other'); ?>" type="text" value="" class="form-control width_90percent"></span>
   </div>
</div>
<div class="col-md-12 text_italic text-bold text-center mt-3">
   <p>{{ __('FOR CHANGES AFFECTING SCHEDULES D, E/F, THE LIST OF CREDITORS, MATRIX OR MAILING LIST,') }}<br>
   {{ __("PROCEED TO SECTION 'C' OF THIS FORM. OTHERWISE, PROCEED TO SECTION 'D'.") }}</p>
</div>
<div class="col-md-12 d-flex mt-2 mb-2">
   <span class="pr-2 text-bold">C.</span>
   <span class="text-bold underline">{{ __('CREDITOR/SCHEDULE INFORMATION:') }}</span>
   <span class="text-bold">{{ __('(Select either #1, #2 or #3)') }}</span>
</div>
<div class="col-md-12 pl-4">
   <div class="form-check">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box547'); ?>" value="Yes">
      <span>{{ __('#1 – Creditors are being added or deleted by this amendment/schedule, AND') }}</span>
   </div>
   <div class="pl-4">
      <div class="form-check mt-2">
         <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box741'); ?>" value="Yes">
         <label>{{ __('The $32.00 amendment fee is attached') }}</label>
      </div>
      <div class="form-check mt-2">
         <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box336'); ?>" value="Yes">
         <label>{{ __('A matrix in the format prescribed by the Clerk with the complete names and addresses of the parties added is attached.') }}</label>
         <p class="mt-2">{{ __("Note: Do not repeat creditor information from a previously filed matrix. The Clerk's office will not delete creditors
            unless a motion to delete creditors is granted.") }}</p>
      </div>
   </div>
   <div class="form-check">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box338'); ?>" value="Yes">
      <span>{{ __('#2 – Schedule(s) of creditors (Schedules D, E/F), list of creditors, matrix or mailing list is being amended for purposes other
      than adding or deleting creditors.') }}</span>
   </div>
   <div class="pl-4">
      <div class="form-check mt-2">
         <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box339'); ?>" value="Yes">
         <label>{{ __('The $32.00 fee is attached for this amendment [e.g. changing amount of a debt or classification of a debt].') }}</label>
      </div>
      <div class="form-check mt-2">
         <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box3577'); ?>" value="Yes">
         <label>The $32.00 <span class="underline">{{ __('fee does not apply') }} </span>{{ __('for this amendment [e.g. change of address of a creditor or change of attorney].') }}</label>
      </div>
   </div>
   <div class="form-check mt-3">
      <input type="checkbox" class=" form-control w-auto" name="<?php echo base64_encode('Check Box5874'); ?>" value="Yes">
      <label>#3 –<span class="text-bold">{{ __('No Creditors') }} </span> {{ __('are being added or deleted.') }}</label>
   </div>
</div>
<div class="col-md-12 d-flex mt-2 mb-2">
   <span class="pr-2 text-bold">D.</span>
   <span class="text-bold underline">{{ __("CERTIFICATION OF SERVICE, ATTORNEY'S DECLARATION AND DEBTOR'S UNSWORN DECLARATION") }}</span>
</div>
   <p><span class="underline text-bold">{{ __('CERTIFICATION OF SERVICE:') }}</span>{{ __('Attach an "Affidavit of Service" listing each party served with a copy of the referenced document(s), this
   cover sheet and a copy of the §341 Meeting Notice (if applicable). Be sure to include the U.S. Trustee and the Case Trustee.') }}</p>

   <p><span class="underline text-bold">{{ __('DECLARATION OF ATTORNEY') }} </span><span class="text-bold">[Attorney or debtor(s), if pro se, must sign.]:</span>
   {{ __('I declare that the above information contained on this cover sheet may be relied upon by the Clerk of 
   Court as a complete and accurate summary of the information contained in the documents attached.') }}</p>

   
<div class="col-md-12">
   <div class="row">
      <div class="col-md-5">
      <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}>
         </x-officialForm.dateSingleHorizontal>
      </div>
      <div class="col-md-5">
         <x-officialForm.debtorSignVertical
            labelContent="Signature:"
            inputFieldName="Text5"
            inputValue={{$debtor_sign}}> 
         </x-officialForm.debtorSignVertical>
      </div>
      <div class="col-md-2"></div>
   </div>
</div>
<p class="mt-3">
   <span class="underline text-bold">{{ __('DECLARATION OF DEBTOR(S):') }}</span>
   {{ __('[Required if declaration is not completed on the document(s) itself or by separate instrument.] I declare
   under penalty of perjury that I have read this cover sheet and the attached schedules, lists, statements, etc., consisting of') }}
   <input name="<?php echo base64_encode('under penalty of perjury that I have read this cover sheet and the attached schedules lists statements etc consisting of'); ?>" type="text" value="" class="form-control w-auto">
   {{ __('sheets,numbered 1 through') }}<input name="<?php echo base64_encode('numbered 1 through'); ?>" type="text" value="" class="form-control w-auto">{{ __(',
   and that they are true and correct to the best of my knowledge, information and belief.') }}
</p>
<div class="row mt-3">
   <div class="col-md-5">
   <x-officialForm.dateSingleHorizontal
         labelText="Dated:"
         dateNameField="Dated_2"
         currentDate={{$currentDate}}>
      </x-officialForm.dateSingleHorizontal>
      <div class="mt-2">
      <x-officialForm.dateSingleHorizontal
         labelText="Dated:"
         dateNameField="Dated_3"
         currentDate={{$currentDate}}>
      </x-officialForm.dateSingleHorizontal>
      </div>
   </div>
   <div class="col-md-5">
      <x-officialForm.debtorSignVertical
            labelContent="Signature:"
            inputFieldName="Text6"
            inputValue={{$debtor_sign}}> 
      </x-officialForm.debtorSignVertical>
      <div class="mt-2">
         <x-officialForm.debtorSignVertical
            labelContent="Signature:"
            inputFieldName="Text7"
            inputValue={{$debtor2_sign}}> 
         </x-officialForm.debtorSignVertical>
      </div>
   </div>
   <div class="col-md-2 pt-4">
         <p class="mt-3">{{ __('(debtor)') }}</p>
         <p class="mt-3">{{ __('(joint debtor, if any)') }}</p>
      </div>
</div>