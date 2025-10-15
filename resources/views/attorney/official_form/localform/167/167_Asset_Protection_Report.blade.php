<div class="row">
    
    <div class=" col-md-12 text-center mb-3">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('WESTERN DISTRICT OF MICHIGAN') }}</h3>
    </div>
    
    <div class="col-md-6 border_1px p-3 br-0">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Debtor(s)"
            debtorname={{$debtorname}}
            rows="2">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 border_1px p-3">
        <div class="mb-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Case No"
                caseno={{$caseno}}
            ></x-officialForm.caseNo>
        </div>
        <label >{{ __('Chapter 7') }}</label>
    </div> 

    <div class=" col-md-12 text-center mt-3">
        <h3>{{ __('ASSET PROTECTION REPORT') }}</h3>
    </div>

    <div class=" col-md-12 mt-3">
        <p class=" p_justify">
        {{ __('Pursuant to Local Bankruptcy Rule 1007-2(d), debtors filing a Chapter 7 petition and debtors in a case
            converting to Chapter 7 must file an Asset Protection Report. List below any property referenced on') }}
            <span class="text-bold">{{ __('Schedule D') }}</span> {{ __('(Creditors Holding Secured Claims); or') }} <span class="text-bold">{{ __('Schedule G') }}</span> {{ __('(Executory Contracts and Unexpired
            Leases); and') }} <span class="text-bold">{{ __('any insurable asset in which there is nonexempt equity.') }}</span> {{ __('For each asset listed, provide
            the following information regarding property damage or casualty insurance:') }}
        </p>
    </div>
    
    <div class="col-md-12 table_sect table_sect_head_border">
        <table class="w-100">
            <tr>
                <th class="p-2 text-bold">{{ __('INSURABLE ASSET') }}<br>{{ __('(from schedules)') }}</th>
                <th class="p-2 text-bold">{{ __('IS ASSET INSURED?') }}<br>{{ __('(Yes/No)') }}</th>
                <th class="p-2 text-bold">{{ __('NAME & ADDRESS OF AGENT OR INSURANCE CO.') }}</th>
                <th class="p-2 text-bold">{{ __('POLICY EXPIRATION DATE') }}<br>{{ __('(MM/YYYY)') }}</th>
                <th class="p-2 text-bold">{{ __('WILL DEBTOR RENEW INSURANCE ON EXPIRATION?') }}<br>{{ __('(Yes/No)') }}</th>
            </tr>
            <?php
                for ($k = 1 ; $k <= 8; $k++) {
                    ?>
                <tr>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode('INSURABLE ASSET from schedulesRow'.$k);?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode('IS ASSET INSURED YesNoRow'.$k);?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode('NAME  ADDRESS OF AGENT OR INSURANCE CORow'.$k);?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode('POLICY EXPIRATION DATE MMYYYYRow'.$k);?>" class="form-control">
                    </td>
                    <td class="p-1">
                        <input type="text" name="<?php echo base64_encode('WILL DEBTOR RENEW  INSURANCE ON EXPIRATION YesNoRow'.$k);?>" class="form-control">
                    </td>                    
                </tr>
            <?php
                }
            ?>
        </table>
    </div>

    <div class=" col-md-12 mt-3">
        <p class=" p_justify">
            {{ __('If the debtor is self-employed, does the debtor have general liability insurance for business activities?') }}
        </p>
        <p class="">
        {{ __('Yes') }} <input type="checkbox" name="<?php echo base64_encode('If the debtor is selfemployed does the debtor have general liability insurance for business activities');?>" value="On" class=" form-control w-auto height_fit_content mr-4"> 
        {{ __('No') }} <input type="checkbox" name="<?php echo base64_encode('No');?>" value="On" class=" form-control w-auto height_fit_content">
        </p>
        <p class=" p_justify">
            {{ __('I declare, under penalty of perjury, that the above information is true and accurate to the best of my
            knowledge. I intend to provide insurance protection for any exemptible interests in real or personal
            property of the estate, and I request that the trustee not expend estate funds to procure insurance
            coverage for my exemptible assets.') }}
        </p>
    </div>

    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 ">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Debtor"
                inputFieldName="Debtor"
                inputValue={{$onlyDebtor}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-6">
        <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="Dated_2"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 ">
        <div class="">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Joint Debtor (if any)"
                inputFieldName="Joint Debtor if any"
                inputValue={{$spousename}}
            ></x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>

    <div class=" col-md-12 mt-3">
        <p class=" p_justify">
            {{ __('Pursuant to LBR 1007-2(f), debtor is required to provide the trustee with a copy of the Declarations Page
            for any insurance policy covering an insurable asset at least 7 days before the date first set for the
            meeting of creditors.') }}
        </p>
    </div>

</div>    