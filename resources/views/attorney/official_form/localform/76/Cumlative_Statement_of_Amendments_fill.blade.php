<div class="text-center">
   <h3>{{ __('IN THE UNITED STATES BANKRUPTCY COURT') }}<br>
       {{ __('FOR THE SOUTHERN DISTRICT OF ALABAMA') }}</h3>
</div>
<div class="row my-4">
       <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="inre"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
            <textarea name="<?php echo base64_encode('debtors'); ?>" type="text" value="" class="form-control mt-2" rows="2"></textarea>
        </div>
        <div class="col-md-6 border_1px p-3">
        <div>
                <x-officialForm.caseNo
                    labelText="Case No."
                    casenoNameField="case"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="chapter"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
    </div>
    <div class="text-center mt-3 mb-4 underline">
        <h3>{{ __('CUMULATIVE STATEMENT OF AMENDMENTS TO SCHEDULES') }}</h3>
    </div>
    <div class="col-mt-3">
    <p><span class="pl-4 ml-4"></span>{{ __('Pursuant to Local Bankruptcy Rule 1009-1(b), below is a description of') }} <span class="underline">all</span> {{ __('amendments to schedules filed by debtor(s) to date:') }}</p>
    <textarea name="<?php echo base64_encode('details'); ?>" type="text" value="" class="form-control mt-2" rows="10" cols="10"></textarea>

    <p><span class="pl-4 ml-4 mt-3"></span>{{ __('Pursuant to Local Bankruptcy Rule 1009-1(a), debtor(s) and their counsel represent that the claims of any added creditors arose prepetition.') }}</p>
    </div>
   <div>
   <div class="row mt-3">
        <div class="col-md-12">
            <x-officialForm.dateSingleHorizontal
            labelText="Dated:"
            dateNameField="date"
            currentDate={{$currentDate}}>
            </x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-12 mt-4">
            <div class="float_right">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Attorney for Debtor(s)"
                    inputFieldName="Attorney for Debtors"
                    inputValue="{{$attorny_sign}}"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
    </div>