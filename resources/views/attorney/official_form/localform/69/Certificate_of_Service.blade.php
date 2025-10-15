<div>
    <div class="text-center">
        <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF ALABAMA') }}</h3>
    </div>
    <div class="row my-4">
        <div class="col-md-6 border_1px p-3 br-0">
            <x-officialForm.inReDebtorCustom
                debtorNameField="Text1"
                debtorname={{$debtorname}}
                rows="2">
            </x-officialForm.inReDebtorCustom>
        </div>
        <div class="col-md-6 border_1px p-3">
            <div>
                <x-officialForm.caseNo
                    labelText="Case Number."
                    casenoNameField="Text2"
                    caseno={{$caseno}}
                ></x-officialForm.caseNo>
            </div>
            <div class="mt-2">
                <x-officialForm.caseNo
                    labelText="Chapter"
                    casenoNameField="Text3"
                    caseno={{$chapterNo}}
                ></x-officialForm.caseNo>
            </div>
        </div>
        <div class="col-md-12 mt-20">
            <div class="text-center">
                <h3>{{ __('Certificate of Service') }}</h3>
            </div>
            <div class="mt-20">
                <p>I hereby certify that I have served a true and correct copy of
                <input name="<?php echo base64_encode('Text7'); ?>" type="text" value="" class="form-control width_30percent">
                <input name="<?php echo base64_encode('Text9'); ?>" type="text" value="" class="form-control width_30percent">
                {{ __('to all creditors and parties in interest by') }}
                <input name="<?php echo base64_encode('Text8'); ?>" type="text" value="" class="form-control width_30percent mt-1">.
            </p>
            <div class="mt-3">
                <p>{{ __('This the') }}
                    <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="{{$currentDay}}" class="form-control width_5percent">
                    {{ __('day of') }}
                    <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="{{$currentMonth}}" class="form-control w-auto">
                    ,
                    <input name="<?php echo base64_encode('Text6'); ?>" type="text" value="{{$currentYear}}" class="form-control width_5percent mt-1">
                    .
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row mt-20">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <textarea name="<?php echo base64_encode('Text10'); ?>" class="form-control" rows="6">{{$attorneydetails}}</textarea>
            </div>
            <div class="col-md-12">
                <p>{{ __('Attached: List of Parties Served') }}</p>
            </div>
        </div>
    </div>

</div>

