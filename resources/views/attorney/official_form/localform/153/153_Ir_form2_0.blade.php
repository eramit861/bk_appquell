<div class="row">

    <div class="col-md-12 mt-3 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('MIDDLE DISTRICT OF LOUISIANA') }}<br>{{ __('(Local Form 2)') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3 t-upper">
        <x-officialForm.inReDebtorCustom
            debtorNameField="Text72"
            debtorname={{$debtorname}}
            rows="1">
        </x-officialForm.inReDebtorCustom>
    </div>
    <div class="col-md-6 p-3 border_1px p-3 t-upper">
        <x-officialForm.caseNo
            labelText="Case No."
            casenoNameField="Text71"
            caseno="{{$caseno}}">
        </x-officialForm.caseNo> 
    </div>

    <div class="col-md-12">
        <h3 class="text-center mt-3">{{ __('DECLARATION REGARDING ELECTRONIC FILING') }}</h3>
        <div class="d-flex mt-3">
            <div class="">
                <label for="">&nbsp;&nbsp;</label>
            </div>
            <div class="pl-4 w-100">
                <h3 class="ml-4">{{ __('PART I: PETITIONER’S DECLARATION') }}</h3>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="pr-3">
                <label class="mr-1">(1)</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('I am the debtor in this case.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="">
                <label for="">{{ __('(1)(a)') }}</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('[If the debtor is a corporation, partnership or limited liability company] I am a
                    representative of the debtor and I am authorized to sign this declaration on behalf of the
                    debtor.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-1">(2)</label>
            </div>
            <div class="pl-1">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box69');?>" class="form-control">
            </div>
            <div class="pl-3 w-100">
                <p class="mb-0">{{ __('I have authorized my attorney to electronically file documents in this case or any proceeding related to this case.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-3">&nbsp;&nbsp;</label>
            </div>
            <div class="pl-3 w-100">
                <p class="ml-4 pl-1 mb-0">{{ __('OR') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-3">&nbsp;&nbsp;</label>
            </div>
            <div class="pl-1">
                <input type="checkbox" value="Yes" name="<?php echo base64_encode('Check Box70');?>" class="form-control">
            </div>
            <div class="pl-3 w-100">
                <p><span class="text-bold">{{ __('[If the debtor is not represented by an attorney]') }}</span> {{ __('I will file documents on my own behalf in this case or any proceeding related to this case.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-1">(3)</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('My electronic signature on any documents bearing a signature designation (“s/____”) filed
                    in this case or any proceeding related to this case is my signature for all purposes authorized
                    or required by law. My electronic signature on such documents shall have the same effect
                    as my signature on the original documents.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-1">(4)</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('The image of my signature on any document bearing my original signature is my signature
                    for all purposes authorized or required by law.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-1">(5)</label>
            </div>
            <div class="pl-3 w-100">
                <p><span class="text-bold">[If the debtor is not represented by an attorney]</span> {{ __('I agree that I shall retain all original,
                    signed documents filed in this case or any proceeding related to this case for five years after
                    the closing of the case or proceeding in which the documents are filed.') }}</p>
            </div>
        </div>
        <p class="text-bold">
        {{ __('I certify under penalty of perjury that the foregoing is true and correct.
            Signed on') }}
            <input type="text" name="<?php echo base64_encode("I certify under penalty of perjury that the foregoing is true and correct"); ?>" class="w-auto form-control" value="{{$currentDay}} {{$currentMonth}}">
            , 20
            <input type="text" name="<?php echo base64_encode("Text20"); ?>" class=" width_5percent form-control" value="{{$currentYearShort}}">
            .
        </p>
    </div>

   
    <div class="col-md-1">
        <label for="">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="(Debtor)"
            signNameField="Signed"
            sign={{$debtor_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVertical
            labelContent="Social Security Number:"
            inputFieldName="Social Security Number"
            inputValue="{{$ssn1}}"
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-1">
        <label for=""></label>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="(Joint Debtor)"
            signNameField="Joint Debtor"
            sign={{$debtor2_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVertical
            labelContent="Social Security Number:"
            inputFieldName="Social Security Number_2"
            inputValue="{{$ssn2}}"
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-12">
        <div class="d-flex mt-3">
            <div class="">
                <label for="">&nbsp;&nbsp;</label>
            </div>
            <div class="pl-4 w-100">
                <h3 class="ml-4">{{ __('PART II: DECLARATION OF ATTORNEY') }}</h3>
            </div>
        </div>
        <div class="d-flex mt-3">
            <div class="pr-3">
                <label class="mr-1">(1)</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('I am the attorney for the debtor.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-1">(2)</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('The debtor or representative of the debtor signed this declaration.') }}</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="pr-3">
                <label class="mr-1">(3)</label>
            </div>
            <div class="pl-3 w-100">
                <p>{{ __('I acknowledge and accept the responsibility to maintain all original, signed documents filed
                    in this case or any proceeding related to this case for five years after the closing of the case
                    or proceeding in which the documents are filed.') }}</p>
            </div>
        </div>
        <p class="text-bold">
        {{ __('I certify under penalty of perjury that the foregoing are true and correct.
            Signed on') }}
            <input type="text" name="<?php echo base64_encode("I certify under penalty of perjury that the foregoing are true and correct"); ?>" class="w-auto form-control" value="{{$currentDay}} {{$currentMonth}}">
            , 20
            <input type="text" name="<?php echo base64_encode("20_2"); ?>" class=" width_5percent form-control" value="{{$currentYearShort}}">
            .
        </p>
    </div>

    
    <div class="col-md-1">
        <label for="">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="(Attorney for Debtor)"
            signNameField="Signed_2"
            sign={{$attorny_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6"></div>

</div>