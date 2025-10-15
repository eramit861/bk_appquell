
       <h3>{{ __('UNITED STATES BANKRUPTCY COURT') }}<br>
       <span  class="underline">{{ __('NORTHERN DISTRICT OF NEW YORK') }}</span></h3>
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
    <div class="col-md-12 mt-2">
        <div class="text-center">
            <h3>{{ __('Change of Address Form pursuant to L.B.R. 4002-1(a)1 and 4002-2') }}</h3>
        </div>
        <div class="mt-2">
            <p><span class="pr-2">1.</span>{{ __('This form is being filed by (check box):') }}</p>
        </div>
        <div class="mt-2">
            <div class="form-check">
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box13'); ?>" value="Yes" checked="true">
                <span>{{ __('Debtor to change address') }}</span>
            </div>
            <div class="row">
                <div class="col-md-3 pt-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box14'); ?>" value="Yes">
                        <span>{{ __("Debtor to change a creditor's address") }}</span>
                    </div>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text4'); ?>" type="text" value="" class="form-control"> 
                    <div class="text-center">
                        <p class="mb-1">{{ __('(Name of Creditor)') }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 pt-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box15'); ?>" value="Yes">
                        <span>{{ __('Party in Interest to change address') }}</span>
                    </div>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text5'); ?>" type="text" value="" class="form-control"> 
                    <div class="text-center">
                        <p class="mb-1">{{ __('(Name of Party in Interest)') }}</p>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3 p-2 pl-3">
                    <p class=""><span class="pr-2">2.</span>{{ __('Provide your telephone number:') }}</p>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text6'); ?>" type="text" value="" class="form-control"> 
                </div>
            </div>
            <div class="mt-2">
                <p class="mb-0"><span class="pr-2">3.</span>{{ __('Is there another case or adversary proceeding related to this case?') }}</p>
            </div>
            <div class="">
            <div class="form-check">
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box16'); ?>" value="Yes">
                <span>{{ __('No') }}</span>
                <input type="checkbox" class="form-control w-auto" name="<?php echo base64_encode('Check Box17'); ?>" value="Yes">
                <label>{{ __('Yes') }}<span class="pl-2">{{ __('– If yes, provide the related case or adversary proceeding number AND 
                file this form on the dockets of the related proceeding(s) as well as thedocket of this Case.') }}</span></label>
                <input name="<?php echo base64_encode('Text7'); ?>" type="text" value="" class="form-control w-auto">
            </div>
            <div class="row mt-2">
                <div class="col-md-3 p-2 pl-3">
                <p class="mb-0"><span class="pr-2">4.</span>{{ __('Original Address:') }}</p>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text8'); ?>" type="text" value="" class="form-control"> 
                </div>
                <div class="col-md-12 mt-1">
                    <input name="<?php echo base64_encode('Text9'); ?>" type="text" value="" class="form-control"> 
                </div>
            </div>
            <div class="row mt-3">
                <div class=" col-md-3 p-2 pl-3">
                <p class="mb-0"><span class="pr-2">5.</span>{{ __('Current Address:') }}</p>
                </div>
                <div class="col-md-9">
                    <input name="<?php echo base64_encode('Text10'); ?>" type="text" value="" class="form-control"> 
                </div>
                <div class="col-md-12 mt-1">
                    <input name="<?php echo base64_encode('Text11'); ?>" type="text" value="" class="form-control"> 
                </div>
            </div>
            <div class="mt-3">
               <p>{{ __('I hereby certify under penalty of perjury that the above information is true.') }}</p>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <x-officialForm.dateSingleHorizontal
                    labelText="Dated:"
                    dateNameField="Date18_af_date"
                    currentDate={{$currentDate}}
                ></x-officialForm.dateSingleHorizontal>
            </div> 
            <div class="col-md-6">
                <x-officialForm.debtorSignVertical
                    labelContent="Signature:"
                    inputFieldName="Text12"
                    inputValue="{{$attorny_sign}}"> 
                </x-officialForm.debtorSignVertical>
                <div class="mt-1">
                    <x-officialForm.debtorSignVertical
                        labelContent="Print Name:"
                        inputFieldName="Text20"
                        inputValue="{{$attorney_name}}">
                    </x-officialForm.debtorSignVertical>
                </div>
            </div> 
            <div class="col-md-4 border_top_1px mt-3 pt-3"> 
            <p class="pl-3">{{ __("1 To change the address of debtor's counsel, see LBR 4002-1(b).") }}</p>
            </div>
            <div class="col-md-6"> 
            </div>
        </div>
    </div>
</div>
