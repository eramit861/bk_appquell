<div class="row">
    <div class="col-md-12 border_1px">
       <div class="row">
            <div class="col-md-6 border_right_1px border_bottom_1px p-3">
                <textarea name="<?php echo base64_encode('Text74');?>" value="" class=" form-control" rows="7"></textarea>
            </div>
            <div class="col-md-6 border_bottom_1px p-3">
                <p>{{ __('FOR COURT USE ONLY') }}</p>
            </div>
            <div class="col-md-12 border_bottom_1px p-3">
                <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('CENTRAL DISTRICT OF ILLINOIS') }}</h3>
            </div>
            <div class="col-md-6 border_right_1px p-3">
                <label>{{ __('Name of Debtor(s) listed on the bankruptcy case:') }}</label>
                <textarea name="<?php echo base64_encode('Name of Debtor(s)');?>" class=" form-control" rows="7">{{$debtorname}}</textarea>
            </div>
            <div class="col-md-6 p-0">
                <div class="mt-3 pr-3 pl-3">
                    <x-officialForm.caseNo
                        labelText="CASE NO.:"
                        casenoNameField="Case Number"
                        caseno="{{$caseno}}"
                    ></x-officialForm.caseNo> 
                </div>
                <div class="mt-2 pr-3 pl-3 pb-3 border_bottom_1px">
                    <x-officialForm.caseNo
                        labelText="CHAPTER:"
                        casenoNameField="Chapter"
                        caseno="{{$chapterNo}}"
                   ></x-officialForm.caseNo> 
                </div>
                <div class="text-center text-bold p-3">
                    <p class="pt-3">{{ __('CHANGE OF MAILING ADDRESS') }}</p>
                </div>
            </div>
       </div>
    </div>
    <div class="col-md-4 mt-3">
        <p><span class="pr-3">1.</span>{{ __('This change of mailing address is requested by:') }}</p>
    </div>
    <div class="col-md-2 mt-3">
        <p>
            <input name="<?php echo base64_encode('Check Box3');?>" value="Yes" type="checkbox" class="form-control w-auto">
            {{ __('Debtor') }}
        </p>
    </div>
    <div class="col-md-2 mt-3">
        <p>
            <input name="<?php echo base64_encode('Check Box4');?>" value="Yes" type="checkbox" class="form-control w-auto">
            {{ __('Joint-Debtor') }}
        </p>
    </div>
    <div class="col-md-2 mt-3">
        <p>
            <input name="<?php echo base64_encode('Check Box5');?>" value="Yes" type="checkbox" class="form-control w-auto">
            {{ __('Creditor') }}
        </p>
    </div>
    <div class="col-md-1"></div>

    <div class="col-md-12">
        <p><span class="pl-4"></span>{{ __('Attorneys who wish to make a change of mailing address must use CM/ECF.') }}</p>
    </div>
    <div class="col-md-12">
        <p><span class="pr-3">2.</span><span class="text-bold">{{ __('Old Address:') }}</span></p>
    </div>
    <div class="col-md-2 pt-2">
        <p class="mb-0"><span class="pl-4"></span>{{ __('Name(s):') }}</p>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('Text6');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-2 pt-2">
        <p class="mb-0"><span class="pl-4"></span>{{ __('Mailing Address:') }}</p>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('OLD mailing address');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-2 pt-2">
        <p class="mb-0"><span class="pl-4"></span>{{ __('City, State, Zip Code:') }}</p>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('OLD City State Zip');?>"  type="text" class="form-control mt-1">
    </div>

    <div class="col-md-12">
        <p><span class="pr-3">3.</span><span class="text-bold">{{ __('New Address:') }}</span></p>
    </div>
    <div class="col-md-2 pt-2">
        <p class="mb-0"><span class="pl-4"></span>{{ __('Mailing Address:') }}</p>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('NEW mailing address');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-2 pt-2">
        <p class="mb-0"><span class="pl-4"></span>{{ __('City, State, Zip Code:') }}</p>
    </div>
    <div class="col-md-10">
        <input name="<?php echo base64_encode('NEW City State Zip');?>"  type="text" class="form-control mt-1">
    </div>

    <div class="col-md-12 mt-3">
        <div class="d-flex">
            <span class="pr-2">4.</span> 
            <input name="<?php echo base64_encode('Check Box6');?>" value="Yes" type="checkbox" class="form-control w-auto height_fit_content">
            <div class="">
                <p class="p_justify">
                    {{ __('Check here if you are a Debtor or a Joint Debtor and you receive court orders and notices by email through the
                    Debtor Electronic Bankruptcy Noticing program (DeBN) rather than by U.S. mail to your mailing address. Please
                    provide your DeBN account number below (DeBN account numbers can be located in the subject title of all
                    emailed court orders and notices).') }}
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 pt-2">
        <p class="mb-2 pl-3">
            <span class="pl-4">&nbsp</span>{{ __('Debtor’s DeBN account number') }}
        </p>
    </div>
    <div class="col-md-4">
        <input name="<?php echo base64_encode('Debtor DeBN number');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-4 pt-2">
        <p class="mb-2 pl-3">
            <span class="pl-4">&nbsp</span>{{ __('Joint Debtor’s DeBN account number') }}
        </p>
    </div>
    <div class="col-md-4">   
        <input name="<?php echo base64_encode('Joint Debtor DeBN number');?>"  type="text" class="form-control mt-1">
    </div>
    <div class="col-md-4">
    </div>

    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingleHorizontal
            labelText="Date:"
            dateNameField="date"
            currentDate={{$currentDate}}>
        </x-officialForm.dateSingleHorizontal>
    </div>
    <div class="col-md-6 mt-3">
       <x-officialForm.debtorSignVerticalOpp
                labelContent="Requestor’s printed name(s)"
                inputFieldName="Requestor's printed name"
                inputValue="{{$onlyDebtor}}">
        </x-officialForm.debtorSignVerticalOpp>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Requestor’s signature(s)"
                inputFieldName=""
                inputValue="{{$debtor_sign}}">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
        <div class="mt-2">
            <x-officialForm.debtorSignVerticalOpp
                labelContent="Title (if applicable, of corporate officer, partner, or agent)"
                inputFieldName="Title of requestor"
                inputValue="">
            </x-officialForm.debtorSignVerticalOpp>
        </div>
    </div>
    <div class="col-md-12 border_bottom_1px mt-3"></div>
</div>