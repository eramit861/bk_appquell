<div class="row">
    <div class="col-md-12 mb-3">
         <h3 class="text-center">{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>{{ __('DISTRICT OF UTAH') }}</h3>
    </div>
    <div class="col-md-6 border_1px p-3 br-0 ">
        <div class="input-group ">
            <label>{{ __('In re:') }}</label>
            <textarea name="<?php echo base64_encode('Text75');?>" class=" form-control" rows="2" style="padding-right:5px;">{{$debtorname}}</textarea>
        </div>
        <p class="text-center">
            {{ __('Debtor(s)') }} 
        </p>
    </div>
    <div class="col-md-6 border_1px p-3 ">
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Case No."
                casenoNameField="Text76"
                caseno="{{$caseno}}"
            ></x-officialForm.caseNo> 
        </div>
        <div class="mt-3">
            <x-officialForm.caseNo
                labelText="Chapter"
                casenoNameField="Text77"
                caseno="{{$chapterNo}}"
            ></x-officialForm.caseNo> 
        </div>    
        <div class="mt-3">
            <div class="row">
                <div class="col-md-3 pt-2">
                    <label>{{ __('Trustee') }}</label>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text78');?>" type="text" value="" class="form-control">
                </div>
            </div>
        </div>    
    </div>

    <div class="col-md-12 mt-3 text-center">
        <h3 class="">
            {{ __('AMENDED MATRIX') }}
        </h3>
    </div>

    <div class="col-md-12 mt-3">
        <p class="text-center text-bold">{{ __('$32 Fee Required') }}</p>
        <p class="text-center text-bold">{{ __('IFP Waiver') }}</p>
        <p class="p_justify">
            <span class="text-bold">{{ __('File amended matrix with') }} <span class="underline">{{ __('ONLY') }}</span> {{ __('the amended creditors. File separate change of address form to change the debtor’s address.
            Fee required except for change of address or adding attorney for listed creditor. Conversion? (13 to 7)') }}</span> {{ __('Yes or No') }}
        </p>
        <p class="p_justify">
            <span class="text-bold">{{ __('It is the debtor’s responsibility to notify additional creditors by sending a 341 notice and/or Discharge Order to the creditors added.') }}</span> 
            A certificate of mailing should be filed with the Clerk’s office (see below).
            <span class="text-bold underline">{{ __('If adding more than eight (8) creditors, attach a scannable
                list to this cover sheet rather than beginning the list on this page. The scannable list needs to be in Courier 10 pitch, Prestige Elite
                or Letter Gothic fonts and contain no more than four (4) lines per creditor address.') }}</span> 
        </p>
    </div>

    <div class="col-md-12 border_top_1px pt-3">
        <p>
        {{ __('Matrix') }}: 
            <span class="pl-4"></span>
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box81');?>" value="Yes">
            {{ __('Adding') }} 
            <span class="pl-4"></span>
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box80');?>" value="Yes">
            {{ __('Correcting') }} 
            <span class="pl-4"></span>
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box79');?>" value="Yes">
            {{ __('Deleting') }}
        </p>
        <p>
            {{ __('Please type the creditors’ address(es) changes/additions below:') }}
        </p>
    </div>

    <div class="col-md-6">
        <div class="d-flex">
            <div class="">
                <label for="">1)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text82');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="">
                <label for="">3)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text84');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="">
                <label for="">5)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text86');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="">
                <label for="">7)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text88');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="d-flex">
            <div class="">
                <label for="">2)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text83');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="">
                <label for="">4)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text85');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="">
                <label for="">6)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text87');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="d-flex mt-2">
            <div class="">
                <label for="">8)</label>
            </div>
            <div class="w-100 pl-3">
                <textarea name="<?php echo base64_encode('Text89');?>" class="form-control" rows="4"></textarea>
            </div>
        </div>
    </div>

    <div class="col-md-12 border_top_1px mt-3 text-center pt-3">
        <h3>{{ __('CERTIFICATE OF MAILING') }}</h3>
    </div>
    
    <div class="col-md-12 text-center mt-3">
        <p class="p_justify">{{ __('I hereby certify that a true and correct copy of the foregoing was mailed, postage prepaid, to the creditors added to this estate
as follows (please mark the appropriate line(s):') }}</p>
    </div>

    <div class="col-md-3">
        <label class=" float_right">{{ __('341 Notice') }}</label>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-3">
        <p>
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box91');?>" value="Yes">
            {{ __('Discharge Notice') }}
        </p>
    </div>
    <div class="col-md-3">
        <p>
            <input type="checkbox" class="form-control w-auto height_fit_content" name="<?php echo base64_encode('Check Box90');?>" value="Yes">
            {{ __('Plan/Amended Plan') }}
        </p>
    </div>
    <div class="col-md-2"></div>


    <div class="col-md-6 mt-3">
        <x-officialForm.dateSingle
            labelText="DATE"
            dateNameField="Text92"
            currentDate={{$currentDate}}
        ></x-officialForm.dateSingle>
    </div>
    <div class="col-md-6 mt-3">
        <x-officialForm.debtorSignVerticalOpp
            labelContent="ATTORNEY FOR DEBTOR(S)"
            inputFieldName="Text93"
            inputValue="{{$attorney_name}}"
        ></x-officialForm.debtorSignVerticalOpp>
    </div>
</div>