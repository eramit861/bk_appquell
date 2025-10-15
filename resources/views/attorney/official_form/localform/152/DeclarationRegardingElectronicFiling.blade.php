<div class="row">
    <div class="col-md-12 mb-3">
        <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('EASTERN DISTRICT OF LOUISIANA') }}</h3>
    </div>

    <div class="col-md-6 border_1px br-0 p-3">
        <label>{{ __('In re:') }}</label>
        <textarea name="<?php echo base64_encode("Text1"); ?>" value="" class=" form-control" rows="3" style="padding-right:5px;"><?php echo $debtorname ?? ''; ?></textarea>
    </div>
    <div class="col-md-6 border_1px p-3">
        <x-officialForm.caseNo
            labelText="CASE NO."
            casenoNameField="Text2"
            caseno={{$caseno}}
        ></x-officialForm.caseNo>   
    </div>

    <div class="col-md-12 mt-3">
        <h3 class="text-center">{{ __('DECLARATION REGARDING ELECTRONIC FILING') }}</h3>
    </div>
    
    <div class="col-md-12 mt-3">
        <div class="row">
            <div class="col-md-1 mb-3"></div>
            <div class="col-md-11 mb-3">
                <label class="text-bold">{{ __('PART I: PETITIONER’S DECLARATION') }}</label>
            </div>

            <div class="col-md-1">
                <label for="">(1)</label>
            </div>
            <div class="col-md-11">
                <p>
                    {{ __('I am the debtor in this case.') }}
                </p>
            </div>

            <div class="col-md-1">
                <label for="">{{ __('(1)(a)') }}</label>
            </div>
            <div class="col-md-11">
                <p>
                    <span class="text-bold">{{ __('[If the debtor is a corporation, partnership or limited liability company]') }}</span> {{ __('I am a
                    representative of the debtor and I am authorized to sign this declaration on behalf of the
                    debtor.') }}
                </p>
            </div>

            <div class="col-md-1">
                <label for="">(2)</label>
            </div>
            <div class="col-md-11 d-flex">
                <div>
                    <input type="checkbox" name="<?php echo base64_encode("Check Box3"); ?>" class="form-control w-auto ml-0" value="Yes" checked="true">
                </div>
                <div>
                    <p>
                        {{ __('I have authorized my attorney to electronically file documents in this case or any
                        proceeding related to this case.') }}
                    </p>
                    <p>
                        {{ __('OR') }}
                    </p>
                </div>
            </div>

            <div class="col-md-1">
                <label for=""></label>
            </div>
            <div class="col-md-11 d-flex">
                <div>
                    <input type="checkbox" name="<?php echo base64_encode("Check Box4"); ?>" class="form-control w-auto ml-0" value="Yes">
                </div>
                <div>
                    <p>
                        <span class="text-bold">{{ __('[If the debtor is not represented by an attorney]') }}</span> {{ __('I will file documents on my
                        own behalf in this case or any proceeding related to this case.') }}
                    </p>
                </div>
            </div>

            <div class="col-md-1 p-2 pl-3">
                <label for="">(3)</label>
            </div>
            <div class="col-md-11">
                <p>
                {{ __('My electronic signature on any documents bearing a signature designation
                (“s/') }}
                <input type="text" name="<?php echo base64_encode("Text5"); ?>" value="<?php echo $debtorname ?? ''; ?>" class="form-control width_40percent">
                {{ __('”) filed in this case or any proceeding related to this
                case is my signature for all purposes authorized or required by law. My electronic signature
                on such documents shall have the same effect as my signature on the original documents.') }}
                </p>
            </div>
            
            <div class="col-md-1">
                <label for="">(4)</label>
            </div>
            <div class="col-md-11">
                <p>
                    {{ __('The image of my signature on any document bearing my original signature is my signature
                    for all purposes authorized or required by law.') }}
                </p>
            </div>
            
            <div class="col-md-1">
                <label for="">(5)</label>
            </div>
            <div class="col-md-11">
                <p>
                    <span class="text-bold">{{ __('[If the debtor is not represented by an attorney]') }}</span>
                    {{ __('I agree that I shall retain all original,
                    signed documents filed in this case or any proceeding related to this case for five years after
                    the closing of the case or proceeding in which the documents are filed.') }}
                </p>
                <p>
                    {{ __('I agree that I shall provide a self-addressed, stamped envelope with any original
                    document that I send by mail to the Clerk for entry in the court’s electronic filing') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <p class="text-bold">
        {{ __('I certify under penalty of perjury that the foregoing is true and correct. Signed on') }}
            <input type="text" name="<?php echo base64_encode("Text6"); ?>" class="w-auto form-control" value="{{$currentMonthNumerical}}/{{$currentDay}}">
            , 20
            <input type="text" name="<?php echo base64_encode("Text7"); ?>" class=" width_5percent form-control" value="{{$currentYearShort}}">
            .
        </p>
    </div>

    <div class="col-md-1">
        <label for="">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="(Debtor)"
            signNameField="Text10"
            sign={{$debtor_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVertical
            labelContent="Social Security Number:"
            inputFieldName="Text8"
            inputValue="{{$ssn1}}"
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-1">
        <label for=""></label>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="(Joint Debtor)"
            signNameField="Text11"
            sign={{$debtor2_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6">
        <x-officialForm.debtorSignVertical
            labelContent="Social Security Number:"
            inputFieldName="Text9"
            inputValue="{{$ssn2}}"
        ></x-officialForm.debtorSignVertical>
    </div>

    <div class="col-md-12 mt-3">
        <label class="text-bold">{{ __('PART II: DECLARATION OF ATTORNEY') }}</label>
    </div>

    <div class="col-md-12 mt-3">
        <div class="row">

            <div class="col-md-1">
                <label for="">(1)</label>
            </div>
            <div class="col-md-11">
                <p>
                    {{ __('I am the attorney for the debtor.') }}
                </p>
            </div>

            <div class="col-md-1">
                <label for="">(2)</label>
            </div>
            <div class="col-md-11">
                <p>
                    {{ __('The debtor or representative of the debtor signed this declaration') }}
                </p>
            </div>
           
            <div class="col-md-1 p-2 pl-3">
                <label for="">(3)</label>
            </div>
            <div class="col-md-11">
                <p>
                    {{ __('I acknowledge and accept the responsibility to maintain all original, signed documents
                    filed in this case or any proceeding related to this case for five years after the closing of
                    the case or proceeding in which the documents are filed.') }}
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-12 mb-3">
        <p class="text-bold">
        {{ __('I certify under penalty of perjury that the foregoing are true and correct. Signed on') }}
            <input type="text" name="<?php echo base64_encode("Text13"); ?>" class="w-auto form-control" value="{{$currentMonthNumerical}}/{{$currentDay}}">
            , 20
            <input type="text" name="<?php echo base64_encode("Text14"); ?>" class=" width_5percent form-control" value="{{$currentYearShort}}">
            .
        </p>
    </div>
    
    <div class="col-md-1">
        <label for="">{{ __('Signed:') }}</label>
    </div>
    <div class="col-md-5">
        <x-officialForm.signVertical
            labelText="(Attorney for Debtor)"
            signNameField="Text12"
            sign={{$attorny_sign}}
        ></x-officialForm.signVertical>
    </div>
    <div class="col-md-6"></div>

</div>