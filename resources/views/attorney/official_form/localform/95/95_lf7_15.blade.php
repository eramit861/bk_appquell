<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">
            {{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
            {{ __('NORTHERN DISTRICT OF FLORIDA') }}<br>
            <select name="<?php echo base64_encode('topmostSubform[0].Page1[0].Division[0]');?>" class="form-control w-auto">
                <option></option>
                <option value="GAINESVILLE">{{ __('GAINSVILLE') }}</option>
                <option value="TALLAHASSEE">{{ __('TALLAHASSEE') }}</option>
                <option value="PENSACOLA">{{ __('PENSACOLA') }}</option>
                <option value="PANAMA CITY">{{ __('PANAMA CITY') }}</option>
            </select>
            {{ __('DIVISION') }}
        </h3> 
    </div>

    <div class="col-md-6 border_1px p-3 br-0 text-bold">
        <x-officialForm.inReDebtorCustom
            debtorNameField="topmostSubform[0].Page1[0].DbtrNames[0]"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3 text-bold">
       <x-officialForm.caseNo
            labelText="Case No.:"
            casenoNameField="topmostSubform[0].Page1[0].CaseNo[0]"
            caseno="{{$caseno}}"
        ></x-officialForm.caseNo>
        <div class="mt-2">
            <label for="">{{ __('Chapter 7') }}</label>
        </div>
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3 mb-3">{{ __('CERTIFICATE AND AFFIDAVIT FOR ADDING CREDITORS IN A CLOSED CASE') }}</h3>
        <div class="d-flex">
            <div class="">
                <label for="">1.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">
                    {{ __('The undersigned pro se debtor(s) or the undersigned member of the bar of this Court who represents the debtor(s), hereby certifies that:') }}
                </p>
                <div class="d-flex">
                    <div class="">
                        <label for="">a.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('The above-captioned case was filed under or converted to a Chapter 7 of the Bankruptcy
                            Code ("Chapter 7") and remained a case under Chapter 7 until closing;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">b.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('After filing or conversion to Chapter 7, a notice of no dividend, contained in the Notice of
                            First Meeting of Creditors, was sent to the creditors listed on the schedules informing the
                            creditors they need not file claims in the above-captioned case;') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">c.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('The Chapter 7 Trustee has filed a Report of No Distribution and, subsequent to the filing of
                            that report, no assets of the estate have been recovered or administered; a discharge was
                            entered and the case was subsequently closed.') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">d.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                        The purpose of filing this Certificate is to amend the schedules to add only the pre-petition
                        creditor(s) listed <span class="underline">{{ __('on the attached sheet') }}</span>.
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">e.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('Due notice of items b and c above has been sent to such creditor(s) and no response has been
                            received from the creditor(s) within the thirty (30) day response period.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">2.</label>
            </div>
            <div class="pl-4">
                <p class="mb-2">
                    {{ __('The debtor(s) signing below, under penalty of perjury, further certifies that:') }}
                </p>
                <div class="d-flex">
                    <div class="">
                        <label for="">a.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('Such debtor(s) did not intentionally omit the creditor(s) listed on the attached sheet from the
                            schedules filed in the above-referenced case; and') }}
                        </p>
                    </div>
                </div>
                <div class="d-flex">
                    <div class="">
                        <label for="">b.</label>
                    </div>
                    <div class="pl-4">
                        <p class="mb-2">
                            {{ __('Such debtor(s) did not intend to hinder, delay or default said creditor(s).') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Attorney"
            inputFieldName="topmostSubform[0].Page1[0].AttySign[0]"
            inputValue="{{$attorny_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Printed Name of Attorney"
                inputFieldName="topmostSubform[0].Page1[0].AttyName[0]"
                inputValue="{{$attorney_name}}"
            ></x-officialForm.debtorSignVerticalOpp>    
        </div>   
        <div class="mt-1">
            <x-officialForm.dateSingle
                labelText="Date"
                dateNameField="topmostSubform[0].Page1[0].Date[0]"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingle>
        </div>       
    </div>        
    <div class=" col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="Signature of Debtor"
            inputFieldName="topmostSubform[0].Page1[0].DbSign[0]"
            inputValue="{{$debtor_sign}}"
        ></x-officialForm.debtorSignVerticalOpp>
        <div class="mt-1">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Signature of Joint Debtor"
                inputFieldName="topmostSubform[0].Page1[0].JtDbSign[0]"
                inputValue="{{$debtor2_sign}}"
            ></x-officialForm.debtorSignVerticalOpp>    
        </div>   
    </div>

</div>