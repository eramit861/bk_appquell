<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF KENTUCKY') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="IN RE Debtors"
            debtorname={{$debtorname}}
            rows="5">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Case Number"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>
        <div class="row">
            <div class="col-md-12 pt-2">
                <label>{{ __('Chapter 13') }}</label>
                <p class="mt-3">{{ __('CERTIFICATION OF DEBTOR INFORMATION
                    REGARDING REQUEST FOR HARDSHIP
                    DISCHARGE') }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mt-3">
        <p>{{ __('The above-captioned debtor certifies under penalty of perjury that the following are true and correct:') }}</p>
        <div class=" d-flex">
            <label>1)</label>
            <div class="row pl-1">
                <div class="col-md-12">
                    <p class="pl-4"> 
                        {{ __('All of the requirements of 11 U.S.C. § 1328(b) have been met and the debtor is entitled to a hardship discharge.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class=" d-flex">
            <label>2)</label>
            <div class="row pl-1">
                <div class="col-md-12">
                    <p class="pl-4"> 
                        {{ __('Pursuant to 11 U.S.C. § 1328(a), all amounts payable for domestic support obligations
                        due on or before the date set forth below (including any amounts due before the filing of
                        the bankruptcy petition to the extent provided for by the plan) have been paid to:') }}
                    </p>
                    <div class="row pl-4">
                        <div class="col-md-2">
                            <label for="">{{ __('Name:') }}</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="<?php echo base64_encode('Name');?>" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">{{ __('Address:') }}</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="<?php echo base64_encode('Address');?>" class="form-control mt-1" rows="3"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="">{{ __('(repeat for multiple payees)') }}</label>
                        </div>
                        <div class="col-md-12 mt-2">
                            <label for="">{{ __('The debtor’s employer and address:') }}</label>
                        </div>
                        <div class="col-md-2">
                            <label for="">{{ __('Name:') }}</label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" name="<?php echo base64_encode('Employer Name');?>" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">{{ __('Address:') }}</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="<?php echo base64_encode('Employer Address');?>" class="form-control mt-1" rows="2"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" d-flex">
            <label>3)</label>
            <div class="row pl-1">
                <div class="col-md-12">
                    <p class="pl-4"> 
                        {{ __('The provisions of 11 U.S.C. § 522(q)(1) are not applicable to this case under 11 U.S.C. § 1328(h) and there are
                        no proceedings pending against the debtor of the kind described in 11 U.S.C. § 522(q)(1)(A) or 522(q)(1)(B).') }}
                    </p>
                </div>
            </div>
        </div>
        <div class=" d-flex">
            <label>4)</label>
            <div class="row pl-1">
                <div class="col-md-12">
                    <p class="pl-4"> 
                        {{ __('The debtor has not received a discharge in a case filed under 7, 11 or 12 of this title during the 4-year period
                        preceding the date of the order for relief under this Chapter, or in a case filed under Chapter 13 of this title during
                        the 2-year period preceding the date of such Order.') }}
                    </p>
                </div>
            </div>
        </div>
        <div class=" d-flex">
            <label>5)</label>
            <div class="row pl-1">
                <div class="col-md-12">
                    <p class="pl-4"> 
                        {{ __('The debtor has completed an instructional course concerning personal financial management described in 11
                        U.S.C. § 111 and has either previously filed Official Form 23 so certifying with the Court, or such certification
                        and accompanying documents are being contemporaneously filed herewith.') }}
                    </p>
                </div>
            </div>
        </div>
        <p>{{ __('The undersigned requests that a discharge be granted in accordance with 11 U.S.C. § 1328(b).') }}</p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="DATE:"
            dateNameField="Date"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6"></div>

    <div class="col-md-6 mt-2 pl-4">
        <x-officialForm.debtorSignVertical
            labelContent="Debtor"
            inputFieldName="Debtor 1 Name"
            inputValue={{$onlyDebtor}}
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-6 mt-2 pl-4">
       <x-officialForm.debtorSignVertical
            labelContent="Debtor:"
            inputFieldName="Debtor 2 Name"
            inputValue={{$spousename}}
        ></x-officialForm.debtorSignVertical>
    </div>

</div>