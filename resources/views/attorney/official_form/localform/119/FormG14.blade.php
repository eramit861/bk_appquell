<div class="text-center">
   <h3>{{ __('UNITED STATES BANKRUPTCY COURT NORTHERN') }}<br>
   {{ __('DISTRICT OF ILLINOIS') }}<br>
       <select class="form-control w-auto p-1">
                <option>{{ __('Eastern Division') }}</option>
                <option>{{ __('Western Division') }}</option>
        </select><br>
    {{ __('CHANGE OF MAILING ADDRESS FOR DEBTOR(S)') }}</h3>
</div>
<div class="row pl-4 my-4">
       <div class="col-md-6 mt-2 border_1px p-3 br-0">
            <label>{{ __('Name of Debtor(s) listed on the bankruptcy case:') }}</label>
            <textarea name="<?php echo base64_encode('Text4'); ?>" type="text" value="" class="form-control mt-2" rows="3">{{$debtorname}}</textarea>
        </div>
        <div class="col-md-6 mt-2 border_1px p-3">
        <div>
            <x-officialForm.caseNo
                labelText="Case No."
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
    </div>
    <div class="row">
        <div class="col-md-4">
           <p class="mb-0"><span class="pr-2">1.</span>{{ __('This change of mailing address is requested by:') }}</p>
        </div>
        <div class="col-md-2">
            <!-- checked by default -->
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box4'); ?>" value="Yes" checked="true">
            <label>{{ __('Debtor') }}</label>
        </div>
        <div class="col-md-2">
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box5'); ?>" value="Yes">
            <label>{{ __('Joint Debtor') }}</label>
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <p class="mb-0 text-bold mt-3"><span class="pr-2">2.</span>{{ __('Old Address:') }}</p>
    <div class="row pl-4">
        <div class="col-md-8 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Name(s):"
                inputFieldName="Text6"
                inputValue="{{$debtorname}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-4 mt-2">
        </div>
    </div>
    <div class="row pl-4">
        <div class="col-md-8 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Mailing Address:"
                inputFieldName="Text7"
                inputValue="{{$clientAddress1}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-4 mt-2">
        </div>
    </div>
    <div class="row pl-4">
        <div class="col-md-8 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="City, State, Zip Code:"
                inputFieldName="Text8"
                inputValue="{{$clientCity}} {{$clientState}}, {{$clientZip}}"
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-4 mt-2">
        </div>
    </div>
    <p class="mb-0 mt-2 text-bold"><span class="pr-2">3.</span>{{ __('New Address:') }}</p>
    <div class="row pl-4">
        <div class="col-md-8 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="Mailing Address:"
                inputFieldName="Text9"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-4 mt-2">
        </div>
    </div>
    <div class="row pl-4">
        <div class="col-md-8 mt-2">
            <x-officialForm.debtorSignVertical
                labelContent="City, State, Zip Code:"
                inputFieldName="Text12"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-4 mt-2">
        </div>
    </div>
    <div class="d-flex">
        <span class="pr-2 mt-2">4.</span>
        <p class="mb-0 mt-2">
            <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box11'); ?>" value="Yes">
            {{ __('Check here if you are a Debtor or a Joint Debtor and you receive court orders and notices by email through the Debtor Electronic
            Notice program (DeBN) rather than by U.S. mail to your mailing address. Please provide your DeBN account number below (DeBN
            account numbers can be located in the subject line of all emailed court orders and notices).') }}
        </p> 
    </div>
    <div class="row mt-3 pl-4">
        <div class="col-md-9">
            <x-officialForm.debtorSignVertical
                labelContent="Debtor’s DeBN account number:"
                inputFieldName="Text13"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row mt-2 pl-4">
        <div class="col-md-9">
            <x-officialForm.debtorSignVertical
                labelContent="Joint Debtor’s DeBN account number:"
                inputFieldName="Text14"
                inputValue=""
            ></x-officialForm.debtorSignVertical>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="row mt-3">
        <div class="col-md-4">
           <x-officialForm.dateSingleHorizontal
                labelText="Dated:"
                dateNameField="Text15"
                currentDate={{$currentDate}}
            ></x-officialForm.dateSingleHorizontal>
        </div>
        <div class="col-md-6">
            <div class="">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Requestor’s printed name(s)"
                    inputFieldName="Text16"
                    inputValue="{{$attorney_name}}"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Requestor’s signature(s)"
                    inputFieldName="Text17"
                    inputValue="{{$attorny_sign}}"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
            <div class="mt-1">
                <x-officialForm.debtorSignVerticalOpp
                    labelContent="Title (if applicable, of corporate officer, partner or agent)"
                    inputFieldName="Text18"
                    inputValue="Attorney"
                ></x-officialForm.debtorSignVerticalOpp>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

    