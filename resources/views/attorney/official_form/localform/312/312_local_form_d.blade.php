<div class="row">
   <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF WYOMING') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
                debtorNameField="Text53"
                debtorname={{$debtorname}}
                rows="3">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="{{ __('Case No.') }}"
                casenoNameField="Case No"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <label >{{ __('CHAPTER 13') }}</label>
        </div>
    </div>
    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">
        {{ __('NOTICE OF DEADLINE FOR FILING OBJECTIONS TO CONFIRMATION OF CHAPTER 13') }}<br>
            {{ __('PLAN and/or APPLICATION FOR ATTORNEY’S FEES') }}<br>
            {{ __('Notice of Potential for Dismissal or Conversion') }}
        </h3>
    </div>
    <div class="col-md-12">
        <p><span class="pl-4"></span>
        {{ __('Enclosed is a copy of the chapter 13 plan proposed by the debtor. If you object to confirmation
            of the plan or a motion contained in the plan, or to payment of the attorney fees listed in the plan, you
            must file a written objection with the Clerk of the Court, United States Bankruptcy Court, 2120 Capitol
            Ave., Ste. 6004, Cheyenne, WY 82001, within 31 days after the date of the mailing of this notice and
            you must serve a copy of your objection on the debtor, whose address is') }} 
            <input type="text" name="<?php echo base64_encode('you must serve a copy of your objection on the debtor whose address is');?>" class=" form-control w-auto">, {{ __('the attorney
            for the debtor, whose name and address appear below, and the standing chapter 13 trustee, Mark
            Stewart, whose address is') }} 
            <input type="text" name="<?php echo base64_encode('Stewart whose address is');?>" class=" form-control w-auto">.
        </p>
        <p><span class="pl-4"></span>
            {{ __('In the absence of a written objection to the value of the collateral and/or the secured status
            asserted in the plan, the Court may accept the allegations of value of a secured creditor’s collateral
            stated, determine the value under 11 U.S.C. § 506(a), and confirm the plan without further notice or
            hearing.') }}
        </p>
        <p><span class="pl-4"></span>
            {{ __('If an objection is timely filed, the Court will set and hold a hearing. If the plan is not confirmed,
            the Court may consider dismissal or conversion of the case at that time.') }}
        </p>
        <p><span class="pl-4"></span>
           {{ __('If no objection is timely filed, the Court may enter an order confirming the plan without further notice or hearing.') }}
        </p>
        <p><span class="pl-4"></span>
            {{ __('Inquiries regarding this matter should be directed to the debtor’s attorney.') }}
        </p>
        <p><span class="pl-4"></span>
        {{ __('The undersigned certifies that a copy of this notice was served on all interested parties as shown on the attached mailing list on') }} 
            <input type="text" name="<?php echo base64_encode('on the attached mailing list on');?>" class=" form-control w-auto">.
        </p>
    </div>
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Attorney for debtor or pro se debtor') }}"
            inputFieldName="Attorney for debtor or pro se debtor"
            inputValue=""
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <label>{{ __('Address & telephone number') }}</labal>
            <textarea name="<?php echo base64_encode('Text54');?>"  value="" class=" form-control" rows="7"></textarea>
        </div>
    </div>
</div>