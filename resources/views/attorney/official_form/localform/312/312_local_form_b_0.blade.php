<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('FOR THE DISTRICT OF WYOMING') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <x-officialForm.inReDebtorCustom
                debtorNameField="Text5"
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
            <label>{{ __('CHAPTER 13') }}</label>
        </div>
    </div>
    <div class="col-md-4 mt-3 mb-3">
        <p class="pt-2 mb-0">{{ __('CHAPTER 13 PLAN AND MOTIONS') }} </p>
    </div>
    <div class="col-md-2 mt-3 pt-2">
        <x-officialForm.inputCheckbox name="Check Box7" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label>{{ __('Original') }}</label>
    </div>
    <div class="col-md-2 mt-3 pt-2">
        <x-officialForm.inputCheckbox name="Check Box8" class="" value="Yes"></x-officialForm.inputCheckbox>
        <label>{{ __('Amended') }}</label>
    </div>
    <div class="col-md-2 mt-3">
        <div class="d-flex input-group">
            <div class="pt-2">
                <label for="">{{ __('Date') }}</label>
            </div>
            <div class="">
                <input name="<?php echo base64_encode('Date')?>" placeholder="MM/DD/YYYY" type="text" value="" class="date_filed width_auto form-control">
            </div>
        </div>
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-12">
        <p><span class="text-bold">{{ __('TAKE NOTICE:') }}</span> 
            {{ __('This plan contains evidentiary averments which, if not controverted, may be accepted by the Court as true. Any objection to those assertions, to the plan or to claim treatment must be filed in accordance with the Notice of Confirmation served separately. Absent any objection, the Court may accept the values and allegations contained in the plan, grant the motions, and confirm this plan without further notice or hearing') }}
        </p>
        <p>{{ __('The debtor proposes this plan and declares:') }}</p>
        <p><span class="text-bold underline">{{ __('Payments and Length of Plan.') }}</span>{{ __('The debtor shall pay to the Chapter l3 Trustee:') }}</p>
        <p><span class="pr-1 pl-4">{{ __('A.') }}</span> 
            $ <x-officialForm.inputText name="A" class="w-auto price-field" value=""></x-officialForm.inputText> 
            {{ __('per month for ') }}<x-officialForm.inputText name="per month for" class="w-auto" value=""></x-officialForm.inputText>
                {{ __('months, extended as necessary, for a total amount of not less than') }}
                    $<x-officialForm.inputText name="than" class="w-auto price-field" value=""></x-officialForm.inputText>;
                        {{ __('provided however, that the final payment may be adjusted to ensure that the plan pays as proposed.') }}
        </p>
        <p><span class="pr-1 pl-4">{{ __('B.') }}</span>{{ __('Collected and liquidated property proceeds of:') }}</p>
        <p><span class="pr-1 pl-4">{{ __('C.') }}</span>
            {{ __('All tax refunds to which the debtor is entitled during the period of the first') }}
            <x-officialForm.inputText name="C All tax refunds to which the debtor is entitled during the period of the first" class="w-auto" value=""></x-officialForm.inputText>
            {{ __('plan payments.') }}
        </p>
        <p><span class="pl-4"></span>
        {{ __('Any tax refunds received by the trustee shall be applied in reduction of claims to be paid through the plan thereby reducing the term of the plan to the extent permissible under the Bankruptcy Code.') }}
        </p>
        <p><span class="underline">{{ __('Claim Treatment:') }}</span>
            {{ __('Only filed and allowed claims will be paid. If a discrepancy exists between the amount of a secured claim as filed and the amount of the secured claim set forth in this plan, the plan will control, except under Class 4(A).') }}
        </p>
        <p>
            <span class="pr-1">1</span><span class="underline">{{ __('Administrative Expenses.') }}</span> 
                {{ __('The trustee will pay administrative expenses in full by equal deferred cashpayments as follows:') }}
        </p>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <p class="mb-0 pt-2 p-text-end">
                {{ __('Attorney fees -pre-petition payment') }} -
                </p>
                <p class="mb-0 pt-3 p-text-end">
                {{ __('to be paid by trustee') }} - 
                </p>
                <p class="mb-0 pt-3 p-text-end">
                {{ __('total fees & expenses') }} - 
                </p> 
            </div>
            <div class="col-md-3">
                <p class="mb-0">$<x-officialForm.inputText name="Attorney fees prepetition payment" class="w-auto price-field" value=""></x-officialForm.inputText></p>
                <p class="mb-0">$<x-officialForm.inputText name="to be paid by trustee" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
                <p class="mb-0">$<x-officialForm.inputText name="total fees  expenses" class="w-auto price-field mt-1" value=""></x-officialForm.inputText></p>
            </div>
            <div class="col-md-5"></div>
            <div class="col-md-1"></div>
            <div class="col-md-11 pl-4">
                <p class="pl-5">{{ __('Other') }}<x-officialForm.inputText name="Text50" class="width_80percent mt-1" value=""></x-officialForm.inputText></p>
            </div>
        </div>
        <p>
            <span class="pr-1">2.</span><span class="underline">{{ __('Priority Claims.') }}</span> 
                {{ __('The following priority claims will be paid in full, unless the holder of a particular claim agrees to different treatment under the plan, as follows:') }}
        </p>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text9" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Allowed Amount') }}</p>
                <x-officialForm.inputText name="Text10" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Monthly Payment') }}</p>
                <x-officialForm.inputText name="Text12" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p><span class="pl-4 underline">{{ __('DSO:') }}</span> 
            {{ __('The') }} 
            <x-officialForm.inputText name="due after filing of the petition as follows" class="mt-1 w-auto" value=""></x-officialForm.inputText>
            {{ __('(Trustee or Debtor) will pay Domestic Support Obligations that become due after filing of the petition as follows:') }}
        </p>
        <p>
            <span class="pr-1">3.</span><span class="underline">{{ __('Secured Claims') }}</span> 
        </p>
        <p>
            <span class="pl-4 pr-2">{{ __('a.') }}</span>
            <span class="underline">{{ __('Secured claims subject to § 506 and paid in full through the plan.') }}</span>
            {{ __("he debtor moves to value the collateral as indicated. The trustee will pay allowed secured claims at the amount of the claim or the value of the collateral to which the creditor's lien attaches, whichever is less. The creditor will retain its lien until the allowed secured portion of the claim is fully paid. The claimant will be deemed unsecured and will be paid as an unsecured creditor for any deficiency balance if the creditor files a timely claim for any deficiency balance remaining.") }} 
        </p>
        <div class="row mb-3">
            <div class="col-md-2">
                <p class="underline">{{ __('Creditor Rate') }}</p>
                <x-officialForm.inputText name="Text13" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Collateral') }}</p>
                <x-officialForm.inputText name="Text14" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Value') }}</p>
                <x-officialForm.inputText name="Text15" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Claim Amount') }}</p>
                <x-officialForm.inputText name="Text16" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Interest') }}</p>
                <x-officialForm.inputText name="Text17" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p>
            <span class="pl-4 pr-2">b.</span><span class="underline">{{ __('Secured claims not subject to § 506') }}</span>
            {{ __('The following debts either incurred within 910 days before the petition date and secured by a PMSI in a motor vehicle or incurred within one year before the petition date and secured by a PMSI in any other thing of value will be paid as follows:') }} 
        </p>
        <div class="row mb-3">
            <div class="col-md-2">
                <p class="underline">{{ __('Creditor') }} </p>
                <x-officialForm.inputText name="Text18" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Collateral') }} </p>
                <x-officialForm.inputText name="Text19" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Value') }} </p>
                <x-officialForm.inputText name="Text20" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Claim Amount') }}  </p>
                <x-officialForm.inputText name="Text21" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Interest Rate') }} </p>
                <x-officialForm.inputText name="Text22" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
         
        <p>
            <span class="pr-1">4.</span><span class="underline text-bold">{{ __('Defaults Cured.') }} </span> 
            {{ __('The trustee will pay these claims pro rata to cure a default or arrearage. Debtor shall timely pay the post-petition monthly payments to the creditor due under the contract.') }} 
        </p>
        <p>
            <span class="underline text-bold pl-4 pr-1">{{ __('Class 4(A)') }}</span> 
                {{ __("if none, indicate) - Claims secured by an interest in real property that is debtor's principal residence located at") }} 
            <x-officialForm.inputText name="Text48" class="mt-1 width_35percent" value=""></x-officialForm.inputText> 
            {{ __('Defaults shall be cured and regular payment shall be made:') }}
        </p>
        <div class="row mb-3">
            <div class="col-md-2">
                <p class="underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text23" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Collateral') }}</p>
                <x-officialForm.inputText name="Text24" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Arrearage') }}</p>
                <x-officialForm.inputText name="Text25" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Term') }}</p>
                <x-officialForm.inputText name="Text26" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Interest Rate') }}</p>
                <x-officialForm.inputText name="Text27" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p class="text-bold p_justify">
        {{ __('If a claim is allowed for a debt treated under Class 4(A) which exceeds the amount above, debtor shall file an amended or modified plan, as appropriate, within one year of the date of the filing of the case. Failure of debtor to file the appropriate amended or modified plan shall be grounds for dismissal.') }}
        </p>
        <p>
            <span class="underline text-bold pl-4 pr-1">{{ __('Class 4(B)') }}</span> 
                {{ __('(if none, indicate) -All other Class 4 claims. Full payment of the amount specified will cure the arrearage and cause any default to be waived notwithstanding the terms of any agreement between the parties to the contrary. In the absence of a written objection, the amount necessary to cure an arrearage and obtain waiver of default will be determined to be the amount stated.') }}
        </p>
        <div class="row mb-3">
            <div class="col-md-2">
                <p class="underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text28" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Collateral') }}</p>
                <x-officialForm.inputText name="Text29" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Arrearage') }}</p>
                <x-officialForm.inputText name="Text30" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Term') }}</p>
                <x-officialForm.inputText name="Text31" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-2">
                <p class="underline">{{ __('Interest Rate') }}</p>
                <x-officialForm.inputText name="Text32" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p>
            <span class="pr-1">5.</span><span class="underline text-bold"> {{ __('Secured Claims for Which Collateral is Surrendered') }}</span> 
            {{ __('The debtor will surrender the following collateral.The claimant is deemed unsecured and will be paid as an unsecured creditor if the creditor files a timely claim for any deficiency balance remaining.') }}
        </p>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text33" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-8">
                <p class="underline">{{ __('Collateral surrendered') }}</p>
                <x-officialForm.inputText name="Text34" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p>
            <span class="pr-1">6.</span><span class="underline text-bold">{{ __('Specially classified unsecured claims.') }}</span> 
        </p>
        <p><span class="pr-2">{{ __('Codebtor claims:') }}</span> {{ __('The trustee will pay these codebtor claims, together with interest:') }}</p>
        <div class="row mb-3">
            <div class="col-md-3">
                <p class="underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text35" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Amount') }}</p>
                <x-officialForm.inputText name="Text36" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-6">
                <p class="underline">{{ __('Interest Rate') }}</p>
                <x-officialForm.inputText name="Text37" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p>
            <span class="underline"> {{ __('Liens Avoided under§ 522(f):') }}</span> 
            {{ __('The debtor moves to avoid these liens that impair exemptions. The claims are deemed unsecured and are treated under Class 7 if the creditor files a timely proof of claim.') }}
        </p>
        <div class="row mb-1">
            <div class="col-md-3">
                <p class="underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text38" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-3">
                <p class="underline">{{ __('Collateral') }}</p>
                <x-officialForm.inputText name="Text39" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-6">
                <p class="underline">{{ __('Amount to be Avoided') }}</p>
                <x-officialForm.inputText name="Text40" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p>
            <span class="pr-1">7.</span><span class="underline text-bold">{{ __('Unsecured claims.') }}</span> 
                {{ __('All non-priority, unsecured claims will be paid pro rata from at least the total sum of') }}
            $<x-officialForm.inputText name="resulting in a distribution to unsecured creditors of approximately" class="w-auto price-field mt-1" value=""></x-officialForm.inputText>,
            {{ __('resulting in a distribution to unsecured creditors of approximately') }}
            <x-officialForm.inputText name="undefined" class="w-auto mt-1" value=""></x-officialForm.inputText> %.
        </p>
        <p class="pl-4"> 
        {{ __('The following nondischargeable unsecured debts will be paid interest at the rate of') }} 
            <x-officialForm.inputText name="during" class="w-auto mt-1" value=""></x-officialForm.inputText> %.
            {{ __('during the term of the plan and to the extent allowed under 11 U.S.C. § 1322(b)(I 0):') }}
        </p>
        <div class="row mb-3">
            <div class="col-md-3">
                <p class="undrline mb-0">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text41" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-9"></div>
        </div>
        <p>
            <span class="pr-1">8.</span><span class="underline text-bold">{{ __('Unmodified Claims.') }}</span> 
                {{ __('These creditors will be paid directly by the debtor in accordance with the contract terms, and will retain any and all interests in property of the debtor or the estate. This class also includes the following creditors paid under Class 4 of the plan:') }}
        </p>
        <div class="row mb-3">
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text42" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Collateral') }}</p>
                <x-officialForm.inputText name="Text43" class="mt-1" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Value') }}</p>
                <x-officialForm.inputText name="Text44" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
        <p>
            <span class="pr-1">9.</span><span class="underline text-bold">{{ __('Adequate Protection Payments and Payments to Lessors:') }}</span> 
                {{ __('The Trustee shall pay the following
            adequate protection payments or payments on leases of personal property, and shall receive the percentage
            fee due under the plan on the payments. Upon confirmation, the claims shall be treated under paragraph
            3(a) or 3(b) as indicated.') }}
        </p>
        <div class="row">
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Creditor') }}</p>
                <x-officialForm.inputText name="Text46" class="" value=""></x-officialForm.inputText>
            </div>
            <div class="col-md-4">
                <p class="mb-0 underline">{{ __('Amount of Monthly Payment') }}</p>
                <x-officialForm.inputText name="Text47" class="mt-1" value=""></x-officialForm.inputText>
            </div>
        </div>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('OTHER PROVISIONS') }}</h3>
        <p>
            <span class="pr-2"> {{ __('a.') }} </span><span class="text-bold">{{ __('Executory Contracts Rejected.') }}</span>
            {{ __('All executory contracts and unexpired leases are rejected and the collateral that is or may be the subject of the leases is abandoned, except the following, on which the debtor will cure all defaults and pay the claimant in accordance with the terms and conditions of the contract:') }}
        </p>
        <p>
            <span class="pr-2"> {{ __('b.') }}</span><span class="text-bold">{{ __('Vesting of Property of the Estate:') }}</span>
                {{ __('Property of the estate shall revest in the debtor:') }}
        </p>
        <p>
            <x-officialForm.inputText name="Upon confirmation of the plan" class=" w-auto mt-1" value=""></x-officialForm.inputText>
            {{ __('on confirmation of the plan') }}
            <x-officialForm.inputText name="Upon discharge or dismissal" class=" w-auto mt-1" value=""></x-officialForm.inputText>
            {{ __('Upon discharge or dismissal') }}
        </p>
        <p>
            <span class="pr-2"> {{ __('c.') }}</span><span class="text-bold">{{ __('Application of Proceeds to Debt:') }} </span>
                {{ __('In all cases where a creditor applies sale or insurance proceeds to a debt treated in this plan, the creditor must file an amended proof of claim within 14 days.') }}
        </p>
        <p>
            <span class="pr-2"> {{ __('d.') }} </span><span class="text-bold">{{ __('Order of Disbursements:') }}</span>
            {{ __('With the exception of adequate protection payments disbursed before confirmation, the trustee will disburse payments received under the plan first to administrative claims allowed under§§ 503(b) and 507(a)(l ) concurrently and pro rata; and then concurrently to all other classes of claims pro rata.') }}
        </p>
        <p>
            <span class="pr-2"> {{ __('e.') }} </span><span class="text-bold">{{ __('Lieu Retention:') }}</span>
            {{ __('Allowed secured claim holders shall retain liens until liens are released upon completion of all payments under the plan or the allowed secured claim is paid in full.') }}
        </p>
    </div>
    <div class="col-md-12 mt-3">
        <h3 class="text-center mb-3">{{ __('DECLARATION UNDER PENALTY OF PERJURY') }}</h3>
        <p><span class="pl-4"></span>
        {{ __('I (We), the undersigned debtor(s), declare under penalty of perjury that the statements contained in he foregoing Chapter 13 plan are true and correct to the best of my/our knowledge, infonnation, and belief.') }}</p>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="{{ __('Dated') }}"
            dateNameField="Dated"
            currentDate="{{$currentDate}}">
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Debtor') }}"
            inputFieldName="Debtor"
            inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="{{ __('Attorney for Debtor') }}"
            inputFieldName="Attorney for Debtor"
            inputValue="{{$spousename}}">
        </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
</div> 