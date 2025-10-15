
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
        {{ __('DISTRICT OF RHODE ISLAND') }}</h3>  
    </div>
    <div class="row mt-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Debtor(s)"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="BK No."
                    casenoNameField="Case No"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
    </div>
    <div class="text-center mt-3 mb-3">
        <h3>{{ __('NOTICE TO ADDED CREDITORS OF PENDING BANKRUPTCY') }}<br>
        {{ __('AND APPLICABLE CASE DEADLINES AND CERTIFICATE OF SERVICE') }}</h3>  
    </div>
    <div class="mb-3">
        <p><strong>{{ __('NOTICE IS HEREBY GIVEN:') }} </strong>that on
        <input name="<?php echo base64_encode('TextBox0'); ?>" type="text" value="{{$currentDate}}" class="form-control ml-2 width_auto">
        {{ __('[date], you were added as a creditor in the above-referenced bankruptcy case.
         Pursuant to LBR 1009-1(c), a copy of the Notice of Section 341 Meeting of Creditors & Deadlines is enclosed and if applicable, a copy of the Notice to File Claims.') }}</p>
         <p>{{ __('Depending upon which chapter of the Bankruptcy Code the case is pending under (see above); please take note of the applicable deadlines below:') }}</p>
    </div>
    <div>
        <h3 class="mt-3 mb-3">{{ __('CHAPTER 7 CASES ONLY:') }}</h3>
        <p class="p_justify">{{ __('As an added creditor, you have a right to file a complaint under 11 U.S.C.
           §§ 523 and/or 727 objecting to the debtor’s discharge or the dischargeability of a particular debt, and/or to object to the debtor’s claim of exemptions,') }}
           <span class="underline">{{ __('within sixty (60) days of service of this notice as evidenced on the below certificate of service,') }}</span>
           {{ __('or within the time set for filing such complaints or objections by creditors previously scheduled, whichever is later (see deadlines listed on Section 341 Notice).') }}</p>
           <p>{{ __('In addition, if this is a Chapter 7 case where a Notice to File Claims has issued as evidenced by the enclosed Notice, the deadline to file a proof of claim is') }}
           <span class="underline">{{ __('ninety (90) days from the date of service of this notice, as stated on the below certificate of service.') }}</span></p>
    </div>
    <div>
        <h3 class="mt-3 mb-3">{{ __('CHAPTER 13 CASES ONLY:') }}</h3>
        <p>{{ __('The deadline to file a proof of claim in Chapter 13 is') }}
        <span class="underline">{{ __('seventy (70) days from the date of service of this notice, as stated on the below certificate of service.') }}</span>
        </p>
    </div>
    <div>
        <h3 class="mt-3 mb-3">{{ __('IN ALL CASES WHERE A CLAIMS DEADLINE APPLIES:') }}</h3>
        <p>{{ __('Creditors who do not file a proof of claim on or before the applicable deadline may not share in any distribution from the debtor(s) estate. If you have previously filed a claim in this case, you do not need to file a new one now.') }}</p>
           <p>{{ __('The proof of claim may be filed by regular mail or by using the Court’s electronic claims filing program, ePOC, available on its website') }}:<span class="underline"> {{ __('www.rib.uscourts.gov.') }}</span> {{ __('If you wish to receive proof of receipt by the bankruptcy court, you must enclose a photocopy of the proof of claim together with a stamped, self−addressed envelope when mailing the claim to the Court. There is no fee for filing a proof of claim.') }}</p>
    </div>
    <div>
        <h3 class="mt-3 text-center">{{ __('CERTIFICATE OF SERVICE') }}</h3>
       <p>I 
        <input name="<?php echo base64_encode('Name'); ?>" type="text" value="" class="form-control width_auto">
        {{ __('hereby certify that on') }} 
        <input name="<?php echo base64_encode('date'); ?>" type="text" value="" class="form-control width_auto">
         {{ __(', I caused true copies of the Notice to Added Creditors of Pending Bankruptcy and Applicable Case Deadline and Certificate of Service to be served through the Court’s CM/ECF system upon the following registered electronic filer(s) in this case, and that I caused true copies of the within notice to be served by first class mail, postage pre-paid, to the following non-CM/ECF participant(s):') }}</p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <label>{{ __('Electronic:') }}</label>
            <textarea name="<?php echo base64_encode('Electronic notice'); ?>" type="text" value="" class="form-control mt-2" rows="3"></textarea>
        </div> 
        <div class="col-md-12 mt-3">
            <label>{{ __('First Class Mail:') }}</label>
        </div> 
        <div class="col-md-6 mt-2">
        <textarea name="<?php echo base64_encode('Address'); ?>" type="text" value="" class="form-control" rows="15"></textarea>
        </div>
        <div class="col-md-6">
            <div class="row mt-2">
                <div class="col-md-3 pl-3 p-2">
                        <span class="mt-2">/s/</span>
                </div>
                <div class="col-md-9">
                        <input name="<?php echo base64_encode('Signature'); ?>" type="text" value="{{$debtor_sign}}" class="form-control">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3 pl-3 p-2">
                        <span class="mt-2">{{ __('Dated:') }}</span>
                </div>
                <div class="col-md-9">
                        <input name="<?php echo base64_encode('Date'); ?>" type="text" placeholder="{{ __('MM/DD/YYYY') }}" value="{{$currentDate}}" class="form-control date_filed w-auto">
                </div>
            </div>
        </div>
    </div>
