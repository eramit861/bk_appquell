<div class="row">
    <div class="col-md-12">
        <h3 class="text-center">{{ __('Secured Claim Worksheet') }} <br>
        {{ __('(For secured claims, other than a mortgage claim)') }}</h3>
    </div>
    
    <div class="col-md-6 mt-3"> 
        <div class="row">
            <div class="col-md-4 pt-2">
                <label class="text-bold">{{ __('Case Name:') }}</label>
            </div>
            <div class="col-md-8">
            <input name="<?php echo base64_encode('CaseName'); ?>"  type="text" class="form-control">
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3 text-bold">
        <x-officialForm.caseNo
            labelText="{{ __('Case Number:') }}"
            casenoNameField="CaseNumber"
            caseno={{$caseno}}>
        </x-officialForm.caseNo>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-bold">{{ __('Instructions:') }}</p>
        <div class="d-flex">
            <span class="pr-2">1.</span>
            <div class="w-100">
                <p>
                    {{ __('Attach this Worksheet to the proof of claim, which should conform to Official Form 410. (This
                    Worksheet is not to be used for claims secured by the debtor’s principal residence. Use Official Form
                    410A for those claims.)') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <p class="pr-2">2.</p>
            <div class="w-100">
                <p>
                     {{ __('Compute the claim as of the date on which the Debtor filed the petition initiating the case.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <p class="pr-2">3.</p>
            <div class="w-100">
                <p><span class="text-bold">
                    {{ __('Do NOT include interest or charges that accrue after the Petition Date (the date on which the
                    petition initiating the case was filed) in the computation of the debt due on the Petition Date.') }}</span>
                    A claim that accrues interest <span class="text-bold"> {{ __('after the Petition') }} </span>Date for payments on secured debt not made when due
                    after the petition date should be presented in a <span class="text-bold"> {{ __('separate') }} </span> {{ __('proof of claim dealing only with post-petition
                    claims.') }}
                </p>
            </div>
        </div>
        <div class="d-flex">
            <p class="pr-2">4.</p>
            <div class="w-100">
                <p>
                    Provide information on computation of claim <span class="text-bold"> {{ __('as of Petition Date') }} </span> in the blanks below. Principal
                    Balance and Accrued Interest <span class="text-bold"> {{ __('MUST NOT') }} </span> {{ __('include unearned interest. The completion and filing of this
                    form does not prejudice a creditor’s right to contest whether the creditor’s interest in property of the
                    estate is adequately protected by payments made post-petition.') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12 table_sect table_sect_head_border">
        <table class="w-100">
           <tr>
               <td class="text-center p-2">A</td>
               <td class="p-2">{{ __('Principal Balance') }}</td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('PrincipalBal'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
           <tr>
               <td class="text-center p-2">B</td>
               <td class="p-2">{{ __('Accrued Earned Interest As of Date of Filing Petition') }} </td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('AccruedInterest'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
           <tr>
               <td class="text-center p-2">C</td>
               <td class="p-2">{{ __('Late Charges') }}</td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('LateCharges'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
           <tr>
               <td class="text-center p-2">D</td>
               <td class="p-2">
                   <p class="mb-0">{{ __('Forced Placed Insurance') }}</p>  
               </td>
               <td class="p-2 text-center">
                   <p class="mb-0">$
                       <input name="<?php echo base64_encode('ForcedInsurance'); ?>"  type="text" class="form-control w-auto"> 
                    </p>
                </td>
           </tr>
           <tr style="border-bottom: 0px !important;">
               <td class="text-center p-2 pb-0" style="border-bottom: 0px !important;">E</td>
               <td class="p-2 pb-0" style="border-bottom: 0px !important;">{{ __('Other Charges (itemize)') }}</td>
               <td class="p-2 text-center pb-0" style="border-bottom: 0px !important;"></td>
           </tr>
           
           <tr style="border-top: 0px !important;">
               <td class="text-center p-2 pt-0" style="border-top: 0px !important;"></td>
               <td class="p-2 pt-0" style="border-top: 0px !important;">
                   <div class="mt-1">
                       <input name="<?php echo base64_encode('ItemizeOther1'); ?>"  type="text" class="form-control w-auto mt-1">
                   </div>
                   <div class="mt-1">
                        <input name="<?php echo base64_encode('ItemizeOther2'); ?>"  type="text" class="form-control w-auto">
                    </div> 
                    <div class="mt-1">
                        <input name="<?php echo base64_encode('ItemizeOther3'); ?>"  type="text" class="form-control w-auto">
                    </div>
               </td>
               <td class="p-2 text-center pt-0" style="border-top: 0px !important;">
                    <p class="mb-0">$<input name="<?php echo base64_encode('OtherCharge1'); ?>"  type="text" class="form-control w-auto"></p> 
                    <p class="mb-0">$<input name="<?php echo base64_encode('OtherCharge2'); ?>"  type="text" class="form-control w-auto mt-1"></p>
                    <p class="mb-0">$<input name="<?php echo base64_encode('OtherCharge3'); ?>"  type="text" class="form-control w-auto mt-1"></p>
                </td>
           </tr>

           <tr>
               <td class="text-center p-2">F</td>
               <td class="p-2">{{ __('Total Claim as of Petition Date (Sum of A-E) - Copy to Block 7 on Official Form 410') }}</td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('TotalClaim'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
           <tr>
               <td class="text-center p-2">G</td>
               <td class="p-2">{{ __('Amount necessary to cure any default as of the date of the petition') }}</td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('CureDefault'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
           <tr>
               <td class="text-center p-2">H</td>
               <td class="p-2">{{ __('Montdly Payment') }}</td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('MonthlyPayment'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
           <tr>
               <td class="text-center p-2">I</td>
               <td class="p-2">{{ __('No. of Installments Past Due on Petition Date') }}</td>
               <td class="p-2 text-center"><input name="<?php echo base64_encode('InstallmentsPastDue'); ?>"  type="text" class="form-control w-auto"></td>
           </tr>
           <tr>
               <td class="text-center p-2">J</td>
               <td class="p-2">{{ __('Contractual Annual Interest Rate (APR)') }} </td>
               <td class="p-2 text-center"><p class="mb-0"><input name="<?php echo base64_encode('InterestRate'); ?>"  type="text" class="form-control w-auto">%</p></td>
           </tr>
           <tr>
               <td class="text-center p-2">K</td>
               <td class="p-2">{{ __('Value of Collateral-Copy to Block 9 on Official Form 410') }}</td>
               <td class="p-2 text-center"><p class="mb-0">$<input name="<?php echo base64_encode('CollateralValue'); ?>"  type="text" class="form-control w-auto"> </p></td>
           </tr>
        </table>
    </div>

</div>